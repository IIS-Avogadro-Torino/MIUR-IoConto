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

trait ProvinciaTrait {
	function getProvinciaID() {
		return $this->nonnull('provincia_ID');
	}

	function normalizeProvincia() {
		return $this->integers('provincia_ID');
	}
}

class Provincia extends Queried {
	use ProvinciaTrait;

	const T       = 'provincia';
	const ID      = 'provincia_ID';
	const NAME    = 'provincia_name';
	const REGIONE = 'regione_ID';

	const ID_      = self::T . DOT . self::ID;
	const REGIONE_ = self::T . DOT . self::REGIONE;

	function __construct() {
		$this->normalizeProvincia();
	}
}
