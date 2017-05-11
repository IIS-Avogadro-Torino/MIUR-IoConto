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

require 'load.php';

Header::spawn('curriculum-home', [
	'toolbar-login' => true
] );
?>

<div class="card-panel">
	<?php /*
	<div class="video-container">
		<iframe width="853" height="480" src="https://www.youtube.com/embed/FuwiWEiv8_Y" frameborder="0" allowfullscreen></iframe>
	</div>
	*/ ?>
	<p><?php _e("Sarà scaricabile un breve manuale.") ?></p>
</div>

<?php
Footer::spawn();
