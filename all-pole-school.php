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

require 'load.php';

require_permission('EDIT_ALL_POLE_SCHOOLS');

Header::factory( 'all-pole-school' );

?>
	<p><?php _e("In seguito tutte le azioni relative alle scuole polo.") ?></p>
<?php

print_menu('all-pole-school', 0, [
	'max-level' => 1
] );

Footer::factory();
