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

required_permission('see-all-curriculums');

function sanitize_csv_value(& $s) {
	$s = str_replace("\n", ' ', $s);
	$s = str_replace("\r", ' ', $s);
	$s = str_replace(CSV_GLUE, ' ', $s);
	return $s;
}

if( ! empty( $_POST ) ) {
	$CSVHeadings = CurriculumFields::get();

	$curriculums = Curriculum::factory()
		->select(Curriculum::T . DOT . STAR)
		->select(Organico  ::T . DOT . STAR)

		->from(Organico::T)
		->equals(Curriculum::ORGANICO_, Organico::ID_)

		->select(Scuola::MECCANOGRAFICO)
		->from(Scuola::T)
		->equals(Organico::SCUOLA_, Scuola::ID_)

		->orderBy(Scuola::MECCANOGRAFICO)

		->queryResults();

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=generated-export-curriculums.csv');

	$headings = [
		_("ruolo"),
		_("meccanografico"),
		_("email")
	];
	foreach($CSVHeadings as $heading) {
		if( $heading->isLongDescription() ) {
			continue;
		}

		$headings[] = $heading->getTitle();
		if( $heading->isCountable() ) {
			$headings[] = sprintf("Punteggio %s", $heading->getTitle() );
		}
	}
	$headings[] = _("PUNTEGGIO TOTALE");

	echo implode(CSV_GLUE, $headings);
	echo "\n";

	foreach($curriculums as $curriculum) {
		$user = User::factory()
			->whereInt(User::ORGANICO_, $curriculum->get(Organico::ID) )
			->queryRow();

		$user || error_die("Unexisting user?");

		$values = [
			$curriculum->get(Organico::ROLE),
			$curriculum->get(Scuola::MECCANOGRAFICO),
			$user->getUserEmail(),
		];
		$points = 0;
		foreach($CSVHeadings as $heading) {
			if( $heading->isLongDescription() ) {
				continue;
			}

			$values[] = $heading->getHumanValue( $curriculum );
			if( $heading->isCountable() ) {
				$row_points = $heading->getPoints( $curriculum );
				$values[] = $row_points;
				$points += $row_points;
			}
		}
		$values[] = $points;

		array_walk($values, 'sanitize_csv_value');
		echo implode(CSV_GLUE, $values);
		echo "\n";
	}

	exit;
}

Header::spawn('home');
?>

	<div class="card-panel">
		<form method="post">
			<input type="hidden" name="do" value="1" />
			<p><?php _e("L'operazione potrebbe richiedere del tempo.") ?></p>
			<button type="submit" class="btn"><?php _e("Esporta tutti i curriculum") ?></button>
		</form>
	</div>

<?php
Footer::spawn();
