<?php
# Formazione MIUR content management system
# Copyright (C) 2017 Valerio Bozzolan
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

trait OrganicoTrait {
	function getOrganicoID() {
		return $this->nonnull(Organico::ID);
	}
}

class Organico extends Queried {
	use OrganicoTrait;

	const T = 'organico';

	const ID      = 'organico_ID';
	const SCUOLA  = 'scuola_ID';
	const ROLE    = 'organico_ruolo';

	const ID_     = self::T . DOT . self::ID;
	const SCUOLA_ = self::T . DOT . self::SCUOLA;

	const DS = 'DS';
	const DSGA = 'DSGA';

	static $ROLES = [
		self::DS,
		self::DSGA
	];

	static function factory() {
		return Query::factory(__CLASS__)->from(self::T);
	}

	static function factoryByID($ID) {
		return self::factory()->whereInt(self::ID_, $ID);
	}

	static function getTokenByRole($mecc, $role) {
		return sha1("$mecc.$role");
	}
}
