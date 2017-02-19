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

class_exists('Scuola');
class_exists('Regione');
class_exists('Provincia');
class_exists('Comune');

class ScuolaFull extends Queried {
	use ScuolaTrait;
	use RegioneTrait;
	use ProvinciaTrait;
	use ComuneTrait;

	function __construct() {
		$this->normalizeScuola();
		$this->normalizeRegione();
		$this->normalizeProvincia();
		$this->normalizeComune();
	}

	static function factory() {
		return Scuola::factory(__CLASS__)
			->from( [
				Comune   ::T,
				Provincia::T,
				Regione  ::T
			] )
			->equals(Scuola::COMUNE_,     Comune   ::ID_)
			->equals(Comune::PROVINCIA_,  Provincia::ID_)
			->equals(Provincia::REGIONE_, Regione  ::ID_);
	}

	static function factoryByID($ID) {
		return self::factory()->whereInt(Scuola::ID_,  $ID);
	}

	static function factoryByUID($uid) {
		return self::factory()->whereStr(Scuola::UID, $uid);
	}

	static function queryByID($ID) {
		return self::factoryByID($ID)
			->select( [
				Scuola::T . DOT . STAR,
				Regione  ::NAME,
				Provincia::NAME,
				Comune   ::NAME
			] )
			->queryRow();
	}
}
