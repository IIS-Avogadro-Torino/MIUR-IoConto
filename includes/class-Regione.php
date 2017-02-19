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

trait RegioneTrait {
	function getRegioneID() {
		return $this->nonnull(Regione::ID);
	}

	function normalizeRegione() {
		$this->integers(Regione::ID);
	}
}

class Regione extends Queried {
	use RegioneTrait;

	const T    = 'regione';
	const ID   = 'regione_ID';
	const NAME = 'regione_name';

	const ID_  = self::T . DOT . self::ID;

	function __construct() {
		$this->normalizeRegione();
	}
}
