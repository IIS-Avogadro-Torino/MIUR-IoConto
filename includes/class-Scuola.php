<?php
# Formazione MIUR content management system
# Copyright (C) 2016, 2017 Valerio Bozzolan, Ivan Bertotto, ITIS AVogadro
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

	function normalizeScuola() {
		$this->integers(Scuola::ID);
	}

	function getSchoolToken() {
		$s = sha1( $this->get(Scuola::MECCANOGRAFICO) . "formazionemiur2017");
		return substr($s, 0, 10);
	}

	function getSchoolRegisterURL($role = null) {
		$args = [
			'token' => $this->getSchoolToken(),
			'uid'   => $this->get(Scuola::MECCANOGRAFICO)
		];
		if($role) {
			$args['role'] = $role;
		}
		return URL . '/register.php?' . http_build_query($args);
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
	const COMUNE               = 'comune_ID';

	const ID_                  = self::T . DOT . self::ID;
	const COMUNE_              = self::T . DOT . self::COMUNE;

	function __construct() {
		$this->normalizeScuola();
	}

	static function factory($c = __CLASS__ ) {
		return Query::factory($c)->from(self::T);
	}

	static function factoryByID($ID) {
		return self::factory()->whereInt(self::ID, $ID);
	}

	static function factoryByMeccanografico($meccanografico) {
		return self::factory()->whereStr(self::MECCANOGRAFICO, $meccanografico);
	}
}
