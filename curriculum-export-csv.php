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

class CSVHeading {
	var $isCountable;
	var $multiple;

	function __construct($is_countable, $multiple, $title, $field, $callback_value = null, $callback_points = null) {
		$this->isCountable = $is_countable;
		$this->multiple    = $multiple;
		$this->title = $title;
		$this->field = $field;
		$this->callbackValue = $callback_value;
		$this->callbackPoints = $callback_points;
	}

	function isCountable() {
		return $this->isCountable;
	}

	function isMultiple() {
		return $this->multiple;
	}

	function getValue(Queried $obj) {
		return $obj->get( $this->field );
	}

	function getPoints($obj) {
		$value = $this->getValue($obj);

		if( ! $this->callbackPoints ) {
			return $value;
		}

		// Not a function, only a value assigned in case of a boolean value
		if( is_integer( $this->callbackPoints ) && is_bool($value) ) {
			return $value ? $this->callbackPoints : 0;
		}

		return $this->callbackPoints( $value );
	}

	function getHumanValue(Queried $obj) {
		$value = $this->getValue($obj);

		if( $this->callbackValue ) {
			// Return the select elements
			$values = is_string( $this->callbackValue )
				? call_user_func($this->callbackValue)
				: $this->callbackValue->__invoke();

			if( is_array( $values ) ) {
				// Set of labels
				if( isset( $values[$value] ) ) {
					return $values[$value];
				}
				return _("n.d.");
			} else {
				// It's only a label?
				return $values;
			}
		}

		return $value;
	}

	function getTitle() {
		return $this->title;
	}
}

class CSVHeadingSimple extends CSVHeading {
	var $constName;

	function __construct($is_countable, $is_multiple, $const_name, $title = null, $callback_value = null ) {
		$this->constName = $const_name;

		if(! $callback_value && $is_countable && $is_multiple) {
			$callback_value = function () {
				return call_user_func( $this->constName );
			};
		}

		parent::__construct(
			$is_countable,
			$is_multiple,
			$title ? $title : call_user_func( $const_name ),
			constant($const_name),
			$callback_value
		);
	}
}

function yep_nope() {
	return [
		true  => _("si'"), // Lasciare senza accento
		false => _("no")
	];
}

$extra_info = _("Extra info");

if( ! empty( $_POST ) ) {
	$CSVHeadings = [
		new CSVHeadingSimple(0, 0, 'Curriculum::SURNAME',                            _("cognome") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::NAME',                               _("nome") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::CITY',                               _("città") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::CAP',                                _("CAP") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::PHONE',                              _("telefono") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::EMAIL',                              _("e-mail") ),
		new CSVHeadingSimple(1, 0, 'Curriculum::YEARS',                              _("esperienza") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::YEARS_DESC',                         $extra_info ),
		new CSVHeadingSimple(1, 1, 'Curriculum::STUDY',                              _("titoli di studio") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::STUDY_DESC',                         $extra_info ),
		new CSVHeadingSimple(1, 1, 'Curriculum::COURSES_FOLLOWED',                   _("corsi seguiti") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::COURSES_FOLLOWED_DESC',              $extra_info ),
		new CSVHeadingSimple(1, 1, 'Curriculum::PUBLICATIONS',                       _("pubblicazioni") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::PUBLICATIONS_DESC',                  $extra_info),
		new CSVHeadingSimple(1, 1, 'Curriculum::COURSES_ORGANIZED_SPECIALIZED',      _("Corsi specialistici organizzati") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::COURSES_ORGANIZED_SPECIALIZED_DESC', $extra_info),
		new CSVHeadingSimple(1, 1, 'Curriculum::COURSES_ORGANIZED_GENERIC',          _("Corsi generici organizzati") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::COURSES_ORGANIZED_GENERIC_DESC',     $extra_info),
		new CSVHeadingSimple(1, 0, 'Curriculum::USRMIUR_TASKS',                      _("Compiti USR/MIUR") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::USRMIUR_TASKS_DESC',                 $extra_info),
		new CSVHeadingSimple(1, 0, 'Curriculum::REGIONAL_TASK',                      _("Compiti regionali/provinciali") ),
		new CSVHeadingSimple(0, 0, 'Curriculum::REGIONAL_TASK_DESC',                 $extra_info),
		new CSVHeadingSimple(1, 1, 'Curriculum::ECDL',                               _("patente computer"), 'yep_nope',     1 ),
		new CSVHeadingSimple(1, 1, 'Curriculum::EXTRALANGUAGE',                      _("lingua straniera"), 'yep_nope',     1 ),
		new CSVHeadingSimple(1, 1, 'Curriculum::EXPERT',                             _("ex-esperto"),       'yep_nope',     3 ),
	];

	$headings = [];
	foreach($CSVHeadings as $heading) {
		$headings[] = $heading->getTitle();
		if( $heading->isCountable() ) {
			$headings[] = sprintf("Punteggio %s", $heading->getTitle() );
		}
	}
	$headings[] = _("PUNTEGGIO TOTALE");

	$curriculums = Curriculum::factory()
		->select(Curriculum::T . DOT . STAR)
		->select(Organico  ::T . DOT . STAR)

		->from(Organico::T)
		->equals(Curriculum::ORGANICO_, Organico::ID_)

		->from(Scuola::T)
		->equals(Organico::SCUOLA_, Scuola::ID_)

		->orderBy(Scuola::MECCANOGRAFICO)

		->queryResults();

	foreach($curriculums as $curriculum) {
		$values = [];
		$points = 0;
		foreach($CSVHeadings as $heading) {
			$values[] = $heading->getHumanValue( $curriculum );
			if( $heading->isCountable() ) {
				$row_points = $heading->getPoints( $curriculum );
				$values[] = $row_points;
				$points += $row_points;
			}
		}
		$values[] = $points;
	}

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=generated-export-curriculums.csv');

	echo implode(CSV_GLUE, $headings);
	echo "\n";
	echo implode(CSV_GLUE, $values);
	echo "\n";

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
