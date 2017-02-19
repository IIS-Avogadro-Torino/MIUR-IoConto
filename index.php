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

require_permission('VIEW_SCHOOL_RELATED_RESOURCES');

Header::factory('home');
?>

	<p><?php printf(
	_("Benvenuto <b>%s</b>."),
		esc_html( get_user('user_name') )
	) ?></p>

	<?php BackendNav::spawn() ?>

<?php
Footer::factory();
