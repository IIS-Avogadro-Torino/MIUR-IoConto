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

trait ComuneTrait {
	function getComuneID() {
		return $this->nonnull(Comune::ID);
	}

	function getComuneName() {
		return $this->get(Comune::NAME);
	}

	function normalizeComune() {
		$this->integers(Comune::ID);
	}
}

class Comune extends Queried {
	use ComuneTrait;

	const T          = 'comune';
	const ID         = 'comune_ID';
	const UID        = 'comune_uid';
	const NAME       = 'comune_name';
	const PROVINCIA  = 'provincia_ID';

	const ID_        = self::T . DOT . self::ID;
	const PROVINCIA_ = self::T . DOT . self::PROVINCIA;

	function __construct() {
		$this->normalizeComune();
	}
}
