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

class MessageBox {
	const INFO = 1;
	const SUCCESS = 2;
	const WARNING = 3;
	const ERROR = 4;

	static function spawn($message, $type = null) {
		$icon = '';
		$colors = '';
		switch($type) {
			case MessageBox::SUCCESS:
				$colors = 'green lighten-4';
				$icon = 'mdi-action-verified-user';
				break;
			case MessageBox::WARNING:
				$colors = 'lime accent-2';
				$icon = 'mdi-alert-warning';
				break;
			case MessageBox::ERROR:
				$colors = 'orange darken-3';
				$icon = 'mdi-alert-error';
				break;
			case MessageBox::INFO:
			default:
				$colors = 'green lighten-4';
				$icon = 'mdi-action-info';
		}

		echo "<div class=\"card-panel $colors\"><i class=\"$icon\"></i> $message</div>\n";
	}
}
