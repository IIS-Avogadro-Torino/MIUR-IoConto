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

class CurriculumFields {
	static function get() {
		static $fields = null;

		if($fields) {
			return $fields;
		}

		$extra_info = _("informazioni aggiuntive");

		$fields = [
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
			new CSVHeadingSimple(1, 1, 'Curriculum::COURSES_ORGANIZED_SPECIALIZED',      _("corsi specialistici organizzati") ),
			new CSVHeadingSimple(0, 0, 'Curriculum::COURSES_ORGANIZED_SPECIALIZED_DESC', $extra_info),
			new CSVHeadingSimple(1, 1, 'Curriculum::COURSES_ORGANIZED_GENERIC',          _("corsi generici organizzati") ),
			new CSVHeadingSimple(0, 0, 'Curriculum::COURSES_ORGANIZED_GENERIC_DESC',     $extra_info),
			new CSVHeadingSimple(1, 0, 'Curriculum::USRMIUR_TASKS',                      _("gruppi lavoro USR/MIUR") ),
			new CSVHeadingSimple(0, 0, 'Curriculum::USRMIUR_TASKS_DESC',                 $extra_info),
			new CSVHeadingSimple(1, 0, 'Curriculum::REGIONAL_TASK',                      _("gruppi lavoro regionali/provinciali") ),
			new CSVHeadingSimple(0, 0, 'Curriculum::REGIONAL_TASK_DESC',                 $extra_info),
			new CSVHeadingSimple(1, 0, 'Curriculum::NATIONAL_TASK',                      _("punteggio incarichi reggenza") ),
			new CSVHeadingSimple(0, 0, 'Curriculum::NATIONAL_TASK_DESC',                 $extra_info),
			new CSVHeadingSimple(1, 1, 'Curriculum::ECDL',                               _("patente computer"), 'yep_nope',     1 )
		];
		return $fields;
	}
}
