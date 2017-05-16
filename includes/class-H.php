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

class H {
	static function _1($title) {
		echo self::generic(1, $title);
	}

	static function _2($title) {
		echo self::generic(2, $title);
	}

	static function _3($title) {
		echo self::generic(3, $title);
	}

	static function _4($title) {
		echo self::generic(4, $title);
	}

	static function generic($level, $title, $anchor = null) {
		$anchor = $anchor ? $anchor : generate_slug($title);
		printf('<span id="%s"></span>', $anchor);
		echo "<h$level>$title</h$level>";
	}
}
