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

require_once FPDF_PATH;

class CurriculumPDF extends FPDF {
	var $organico;
	var $curriculum;

	function Header() {
		$this->Image('content/images/formazione-MIUR-Io-Conto-logo-landscape.png', 10, 6, 30);
		$this->SetFont('Arial', 'B', 15);
		$this->Cell(40);
		$this->Cell(
			0,
			0,
			sprintf(
				_("Curriculum di %s %s"),
				$this->curriculum->get(Curriculum::NAME),
				$this->curriculum->get(Curriculum::SURNAME)
			)
		);
		$this->Ln(20);
	}

	function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0, 10, 'Page '. $this->PageNo() . '/{nb}', 0, 0, 'C');
	}

	function setOrganico($organico) {
		$this->organico = $organico;
	}

	function setCurriculum($curriculum) {
		$this->curriculum = $curriculum;
	}
}
