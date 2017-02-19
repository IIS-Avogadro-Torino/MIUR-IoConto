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

class BackendNav {
	static function spawn() { ?>

	<?php if( has_permission('EDIT_ALL_POLE_SCHOOLS') ): ?>
	<p>
		<?php echo HTML::a(
			ROOT . '/all-pole-school.php',
			_("Torna a gestisci scuole polo"),
			_("Menù gestisci scuola polo"),
			'btn waves-effect'
		) ?>
	</p>
	<?php endif ?>

	<?php if( has_permission('EDIT_HIS_POLE_SCHOOL') ): ?>
	<p>
		<?php echo HTML::a(
			ROOT . '/single-pole-school.php',
			_("Torna al menù scuola polo"),
			_("Menù scuola polo"),
			'btn waves-effect'
		) ?>
	</p>
	<?php endif ?>

<?php } }
