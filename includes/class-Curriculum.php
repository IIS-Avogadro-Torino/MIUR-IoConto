<?php
# Formazione MIUR content management system
# Copyright (C) 2017 Valerio Bozzolan, Ivan Bertotto, ITIS Avogadro
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

trait CurriculumTrait {
	function getOrganicoID() {
		return $this->nonnull(Curriculum::ORGANICO);
	}

	function update($fields) {
		query_update(Curriculum::T, $fields, sprintf(
			 "%s = '%d'",
			Curriculum::ORGANICO,
			$this->getOrganicoID()
		) );
	}
}

class Curriculum extends Queried {
	use CurriculumTrait;

	const T = 'curriculum';

	// External keys
	const ORGANICO                      = 'organico_ID';

	const SURNAME = 'curriculum_surname';
	const NAME    = 'curriculum_name';
	const CITY    = 'curriculum_city';
	const CAP     = 'curriculum_cap';
	const PHONE   = 'curriculum_phone';
	const EMAIL   = 'curriculum_email';
	const STATUS  = 'curriculum_status';
	const ROLE    = 'curriculum_role';

	// Fields
	const YEARS                         = 'curriculum_years';
	const YEARS_DESC                    = 'curriculum_years_desc';
	const STUDY                         = 'curriculum_study';
	const STUDY_DESC                    = 'curriculum_study_desc';
	const COURSES_FOLLOWED              = 'curriculum_courses_followed';
	const COURSES_FOLLOWED_DESC         = 'curriculum_courses_followed_desc';
	const PUBLICATIONS                  = 'curriculum_publications';
	const PUBLICATIONS_DESC             = 'curriculum_publications_desc';
	const COURSES_ORGANIZED_SPECIALIZED = 'curriculum_coursesorganized_specialized';
	const COURSES_ORGANIZED_SPECIALIZED_DESC
	                                    = 'curriculum_coursesorganized_specialized_desc';
	const COURSES_ORGANIZED_GENERIC     = 'curriculum_coursesorganized_generic';
	const COURSES_ORGANIZED_GENERIC_DESC= 'curriculum_coursesorganized_generic_desc';
	const USRMIUR_TASKS                 = 'curriculum_usrmiurtasks';
	const USRMIUR_TASKS_DESC            = 'curriculum_usrmiurtasks_desc';
	const REGIONAL_TASK                 = 'curriculum_regionaltask';
	const REGIONAL_TASK_DESC            = 'curriculum_regionaltask_desc';
	const NATIONAL_TASK                 = 'curriculum_nationaltask';
	const NATIONAL_TASK_DESC            = 'curriculum_nationaltask_desc';
	const ECDL                          = 'curriculum_ecdl';
	const EXTRALANGUAGE                 = 'curriculum_extralanguage';
	const EXPERT                        = 'curriculum_expertioconto';

	// Complete external keys
	const ORGANICO_ = self::T . DOT . self::ORGANICO;

	function __construct() {
		$this->integers(self::ORGANICO);
		$this->booleans(self::ECDL, self::EXTRALANGUAGE, self::EXPERT);
	}

	static function factory() {
		return Query::factory(__CLASS__)->from(self::T);
	}

	static function factoryByOrganico($organico_ID = null) {
		if( ! $organico_ID ) {
			$organico_ID = organico_ID();
		}
		return self::factory()->whereInt( self::ORGANICO_, $organico_ID );
	}

	static function SURNAME() {
		return _("cognome");
	}

	static function NAME() {
		return _("nome");
	}

	static function CITY() {
		return _("città");
	}

	static function CAP() {
		return _("CAP");
	}

	static function PHONE() {
		return _("telefono cellulare");
	}

	static function EMAIL() {
		return _("e-mail personale");
	}

	static function ROLE() {
		return [
			'ds'   => _("DS"),
			'dsga' => _("DSGA")
		];
	}

	static function STATUS() {
		return  [
			'titolare' => _("titolare"),
			'reggente' => _("reggente"),
			'altro'    => _("altro")
		];
	}

	static function YEARS() {
		return [
			5  => _("anzianità < 5 anni"),
			10 => _("5 anni < anzianità <= 10 anni"),
			15 => _("10 anni < anzianità <= 15 anni"),
			20 => _("anzianità > 15")
		];
	}

	static function STUDY() {
		return [
			3  => _("Laurea triennale"),
			5  => _("Laurea magistrale / V.O / specialistica"),
			8  => _("Master di I livello"),
			10 => _("Master di II livello (o biennale)"),
			15 => _("Dottorato / seconda laurea")
		];
	}

	static function COURSES_FOLLOWED() {
		return [
			0  => _("Nessun corso"),
			2  => _("0 < corsi <= 2"),
			4  => _("2 < corsi <= 4"),
			6  => _("4 < corsi <= 6"),
			8  => _("corsi > 6"),
			10 => _("corsi > 10")
		];
	}

	static function PUBLICATIONS() {
		return [
			0  => _("Nessuna pubblicazione su articoli o riviste specializzate"),
			3  => _("da uno a tre pubblicazioni"),
			5  => _("meno di sei pubblicazioni"),
			10 => _("sei pubblicazioni o più")
		];
	}

	static function COURSES_ORGANIZED_SPECIALIZED() {
		return [
			0 =>  _("Nessun corso"),
			5 =>  _("0 < corsi <= 2"),
			10 => _("2 < corsi <= 4"),
			15 => _("4 < corsi <= 6"),
			20 => _("corsi > 6")
		];
	}

	static function COURSES_ORGANIZED_GENERIC() {
		return [
			0 =>  _("Nessun corso"),
			5 =>  _("0 < corsi <= 2"),
			10 => _("2 < corsi <= 4"),
			15 => _("4 < corsi <= 6"),
			20 => _("corsi > 6")
		];
	}

	static function USRMIUR_TASKS() {
		return [
			3 => _("Fino a 3 incarichi"),
			5 => _("Più di 5 incarichi")
		];
	}

	static function REGIONAL_TASK() {
		return [
			3 => _("Gruppi di lavoro (più di 3)"),
			5 => _("Incarichi di reggenza (più di 3)")
		];
	}

	static function NATIONAL_TASK() {
		return self::REGIONAL_TASK();
	}
}
