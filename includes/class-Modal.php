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

/**
 * MaterializeCSS modal.
 *
 * @see http://materializecss.com/modals.html
 */
class Modal {
	static $i = 0;

	static function start() {
		printf('<div id="modal%d" class="modal modal-large">', ++self::$i);
		echo '<div class="modal-content">';

		return self::$i;
	}

	static function end() {
		echo "</div></div><!-- /end modal -->";
	}

	static function open($title = null, $icon = 'add', $id = null) {
		$title = $title ? $title : _("compila");

		printf('<a class="btn waves-effect light-blue darken-1" href="#%s">%s %s</a>',
			$id ? $id : self::id(),
			$title,
			m_icon($icon)
		);
	}

	static function close($title = null, $icon = 'done') {
		$title = $title ? $title : _("OK");

		printf('<a class="btn waves-effect modal-close light-blue darken-1">%s %s</a>',
			$title,
			m_icon($icon)
		);
	}

	private static function id($increment = false) {
		if($increment) {
			self::$i++;
		}
		return sprintf('modal%d', self::$i);
	}
}
