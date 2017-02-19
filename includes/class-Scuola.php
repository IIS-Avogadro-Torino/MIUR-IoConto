<?php
# Formazione MIUR content management system
# Copyright (C) 2015 Valerio Bozzolan
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published
# by the Free Software Foundation, either version 3 of the License,
# or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

trait ScuolaTrait {
	function getScuolaID() {
		return $this->nonnull(Scuola::ID);
	}

	function getScuolaName() {
		return $this->get(Scuola::NAME);
	}

	function getScuolaEmail() {
		return $this->get(Scuola::EMAIL);
	}

	function getScuolaPhone() {
		return $this->get(Scuola::PHONE);
	}

	function getScuolaAddress() {
		return $this->get(Scuola::ADDRESS);
	}

	function getScuolaSededir() {
		return $this->get(Scuola::SEDEDIR);
	}

	function isScuolaPolo() {
		return $this->get(Scuola::POLO);
	}

	function getScuolaMeccanografico() {
		return $this->nonnull(Scuola::MECCANOGRAFICO);
	}

	function getScuolaResponsabileName() {
		return $this->get(Scuola::RESPONSABILE_NAME);
	}

	function getScuolaResponsabileSurname() {
		return $this->get(Scuola::RESPONSABILE_SURNAME);
	}

	function getScuolaResponsabileEmail() {
		return $this->get(Scuola::RESPONSABILE_EMAIL);
	}

	function getScuolaResponsabilePhone() {
		return $this->get(Scuola::RESPONSABILE_PHONE);
	}

	function getScuolaCodicefiscale() {
		return $this->get(Scuola::FISCALE);
	}

	function getScuolaTesoreriaCodice() {
		return $this->get(Scuola::TESORERIA_CODICE);
	}

	function getScuolaTesoreriaConto() {
		return $this->get(Scuola::TESORERIA_CONTO);
	}

	function getScuolaAmbitiProvinciali() {
		return $this->get(Scuola::AMBITI_PROVINCIALI);
	}

	function isScuolaNotFull() {
		return	empty( $this->getScuolaResponsabileName() )    ||
			empty( $this->getScuolaResponsabileSurname() ) ||
			empty( $this->getScuolaResponsabileEmail() )   ||
			empty( $this->getScuolaResponsabilePhone() )   ||
			empty( $this->getScuolaTesoreriaCodice() )     ||
			empty( $this->getScuolaTesoreriaConto() );
	}

	/**
	 * @param $cols DBCol[]
	 */
	function updateScuola($cols) {
		query_update(Scuola::T, $cols, sprintf(
			'%s = %d',
			Scuola::ID,
			$this->getScuolaID()
		) );
	}

	/**
	 * @return Rendiconto762
	 */
	function queryRendiconto762() {
		return Rendiconto762::queryByScuola( $this->getScuolaID() );
	}

	/**
	 * @return Rendiconto821
	 */
	function queryRendiconto821() {
		return Rendiconto821::queryByScuola( $this->getScuolaID() );
	}

	function normalizeScuola() {
		$this->integers(Scuola::ID)
		     ->booleans(Scuola::POLO, Scuola::SEDEDIR);
	}
}

class Scuola extends Queried {
	use ScuolaTrait;

	const T                    = 'scuola';
	const ID                   = 'scuola_ID';
	const POLO                 = 'scuola_polo';
	const NAME                 = 'scuola_nome';
	const MECCANOGRAFICO       = 'scuola_meccanografico';
	const EMAIL                = 'scuola_email';
	const FISCALE              = 'scuola_codice_fiscale';
	const PHONE                = 'scuola_telefono';
	const ADDRESS              = 'scuola_indirizzo';
	const SEDEDIR              = 'scuola_sededir';
	const RESPONSABILE_NAME    = 'scuola_polo_responsabile_nome';
	const RESPONSABILE_SURNAME = 'scuola_polo_responsabile_cognome';
	const RESPONSABILE_EMAIL   = 'scuola_polo_responsabile_email';
	const RESPONSABILE_PHONE   = 'scuola_polo_responsabile_telefono';
	const COMUNE               = 'comune_ID';

	const TESORERIA_CODICE     = 'scuola_tesoreria_codice';
	const TESORERIA_CONTO      = 'scuola_tesoreria_conto';

	const ID_                  = self::T . DOT . self::ID;
	const COMUNE_              = self::T . DOT . self::COMUNE;

	const TESORERIA_CODICE_MAXLEN = 3;
	const TESORERIA_CONTO_MAXLEN  = 6;

	function __construct() {
		$this->normalizeScuola();
	}

	static function factory($c = __CLASS__ ) {
		return Query::factory($c)->from(self::T);
	}

	static function factoryByID($ID) {
		return self::factory()->whereInt(self::ID, $ID);
	}
}
