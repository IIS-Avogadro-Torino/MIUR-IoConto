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

class UserNavbar {
	static function spawn() {

		inject_in_module('footer', function() { ?>
			<script>
			$(document).ready(function() {
				$(".button-collapse").sideNav();
			});
			</script>
			<?php
		} );

		?>
<nav>
	<div class="nav-wrapper">
		<div class="left hide-on-small-only">
			<img alt="<?php _esc_html( SITE_NAME ) ?>" src="<?php echo IMAGE_URL . '/formazione-MIUR-Io-Conto-logo-landscape.png' ?>" height="45" />
		</div>
		<ul id="nav-mobile" class="right">
			<li><a href="http://www.formazionemiur.it"><?php _e("Area pubblica") ?></a></li>

			<?php if( has_permission('EDIT_HIS_POLE_SCHOOL') ): ?>
				<li><?php echo HTML::a( ROOT . '/single-pole-school.php' , _("Menù scuola polo") ) ?></li>
			<?php endif ?>

			<?php if( has_permission('EDIT_ALL_POLE_SCHOOLS') ): ?>
				<li><?php echo HTML::a( ROOT . '/all-pole-school.php' , _("Gestisci scuole polo") ) ?></li>
			<?php endif ?>

			<?php if( !is_logged() ): ?>
				<li><?php echo HTML::a( ROOT . '/login.php' , _("Autenticati") ) ?></li>
			<?php endif ?>

			<?php if( is_logged() ): ?>
				<li><?php echo HTML::a( ROOT . '/login.php?logout' , _("Esci") ) ?></li>
			<?php endif ?>
		</ul>
	</div>
</nav>
<?php } }
