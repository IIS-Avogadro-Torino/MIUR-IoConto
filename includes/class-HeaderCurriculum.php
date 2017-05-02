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

class HeaderCurriculum {
	static function spawn($title, $args = []) {
		$args = merge_args_defaults($args, [
			'user-navbar'    => false,
			'container'      => false,
			'header'         => false,
			'toolbar-upload' => false
		] );
		Header::factory($title, $args);
		?>

<div class="row">
	<!-- left -->
	<aside class="col s12 m3 l2 light-blue darken-1">
		<div>
			<img class="responsive-img" src="<?php echo IMAGE_URL ?>/formazione-MIUR-Io-Conto-logo-landscape.png" alt="logo Formazione MIUR" />
		</div>
		<div class="hide-on-small-only">
			<img class="responsive-img ioconto-img" src="<?php echo IMAGE_URL ?>/formazione-MIUR-Io-Conto.png" alt="logo Io Conto" />
		</div>
		<p class="flow-text red-text white margin-right-negative"><?php echo Header::$args['title'] ?></p>
		<footer class="hide-on-small-only">
			<ul>
				<li><?php print_menu_link('curriculum-home', _("Home"), 'white-text') ?></li>
				<li><a class="white-text" href="#">Il progetto</a></li>
				<li><a class="white-text" href="#">Istruzioni</a></li>
				<li><a class="white-text" href="#">Vai a Io Conto</a></li>
				<li><a class="white-text" href="#">Esempi</a></li>
				<li><a class="white-text" href="#">Area riservata</a></li>
				<li><a class="white-text" href="#">News</a></li>
			</ul>
		</footer>
	</aside>
	<!-- /left -->

	<!-- main -->
	<div class="section col s12 m6 l8">

<?php } }
