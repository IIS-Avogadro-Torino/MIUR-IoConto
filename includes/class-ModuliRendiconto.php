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
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

class ModuliRendiconto {
	private $modules = [];

	function __construct() {
		$this->add( new ModuloRendiconto('a', 'A', 'blue lighten-5',   _("Acquisti di beni e servizi") ) );
		$this->add( new ModuloRendiconto('b', 'B', 'green lighten-5',  _("Bilancio, programmazione e scritture contabili") ) );
		$this->add( new ModuloRendiconto('n', 'N', 'orange lighten-5', _("Acquisizione nuovi obblighi normativi") ) );
	}

	function add($module) {
		$this->modules[] = $module;
	}

	function get() {
		return $this->modules;
	}
}

class ModuloRendiconto {
	var $id;
	var $txt;
	var $bg;
	var $desc;

	function __construct($id, $txt, $bg, $desc) {
		$this->id   = $id;
		$this->txt  = $txt;
		$this->bg   = $bg;
		$this->desc = $desc;
	}
}
