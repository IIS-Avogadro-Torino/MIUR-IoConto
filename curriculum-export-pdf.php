<?php
# Formazione MIUR content management system
# Copyright (C) 2017 ITIS Avogadro, Ivan Bertotto, Valerio Bozzolan
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published
# by the Free Software Foundation, either version 3 of the License,
# or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

require 'load.php';

isset( $_GET['o'], $_GET['token'] )
	|| exit;

if( $_GET['token'] !== PDF_TOKEN ) {
	error_die("Wrong token");
}

$organico = Organico::factoryByID( $_GET['o'] )
	->select( [
		Organico::ID_,
		Organico::SCUOLA_,
		Organico::ROLE
	] )
	->queryRow();

$organico
	|| error_die("Unknown");

$school = Scuola::factoryByID( $organico->get(Organico::SCUOLA) )
	->queryRow();

$curriculum = Curriculum::factoryByOrganico( $organico->get(Organico::ID) )
	->queryRow();

$curriculum
	|| error_die("Missing curriculum");

$user = User::factory()
	->whereInt(User::ORGANICO_, $organico->get(Organico::ID) )
	->queryRow();

$user
	|| error_die("Missign user");

$pdf = new CurriculumPDF();
$pdf->setOrganico($organico);
$pdf->setCurriculum($curriculum);
$pdf->SetFont('Arial', '', 10);
$pdf->AliasNbPages();
$pdf->AddPage();

$intros = [
	_("ruolo")          => $organico->get(Organico::ROLE),
	_("meccanografico") => $school->get(Scuola::MECCANOGRAFICO),
	_("e-mail")         => $user->getUserEmail()
];

foreach($intros as $label => $value) {
	$pdf->Cell(50, 0, "$label: ");
	$pdf->Ln();
	$pdf->MultiCell(0, 9, $value );
	$pdf->Ln();
}

$sum = 0;

$labelled_fields = CurriculumFields::get();
foreach($labelled_fields as $labelled_field) {
	$v = utf8_decode( $labelled_field->getTitle() );
	$pdf->Cell(50, 0, "$v: ");

	if( $labelled_field->isCountable() ) {
		$points = $labelled_field->getPoints( $curriculum );
		$pdf->Cell(80);
		$pdf->Cell(0, 0, "$points punti" );
		$sum += $points;
	}

	$pdf->Ln();

	$v = utf8_decode( $labelled_field->getHumanValue( $curriculum ) );
	$pdf->MultiCell(0, 9, $v );
	$pdf->Ln();
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 0, "TOTALE: $sum");

$pdf->Output( sprintf("%s-%s-%s.pdf",
	$school->get(Scuola::MECCANOGRAFICO),
	$curriculum->get(Curriculum::SURNAME),
	$organico->get(Organico::ROLE)
), 'I');
