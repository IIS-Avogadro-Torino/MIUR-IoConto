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

class Header {
	static $args = [];

	static function spawn($uid, $args = []) {

		self::$args = $args;
		$args = & self::$args;

		$menuEntry = get_menu_entry($uid);
		$menuEntry || error_die( sprintf(
			_("Il menu '%s' non esiste"),
			$uid
		) );

		// Default arguments
		$args = array_replace( [
			'title'        => $menuEntry->name,
			'permalink'    => true,
			'meta-title'   => true,
			'pre-enqueue'  => 'default',
			'pre-template' => 'default',
			'complete-site-name' => true,
			'user-navbar'  => false,
			'container'    => false,
			'header'       => true,
			'toolbar-upload' => false
		], $args);

		switch( $args['pre-template'] ) {
			case 'print':
				enqueue_css('materialize-post-style');
				enqueue_css('print-mode');
				break;

			case 'default':
				enqueue_css('materialize');
				enqueue_css('materialize-icons');
				enqueue_css('materialize-patch');
				enqueue_js('jquery');
				enqueue_js('materialize');
				break;

			default:
				error_die("Missing template");
		}

		$title          = $args['title'];
		$complete_title = ( $args['complete-site-name'] ) ? "$title - " . SITE_NAME : $title;

		?>
<!DOCTYPE html>
<html>
<head>
	<title><?php _esc_html( $complete_title ) ?></title>
	<link rel="icon" type="image/png" href="<?php echo IMAGE_URL . '/formazione-MIUR-Io-Conto-favicon.png' ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET ?>" />
	<meta name="author" content="ITIS Avogadro, Valerio Bozzolan, Ivan Bertotto" />
	<meta name="generator" content="DIY PHP - MariaDB - MaterializeCSS - GNU Nano :^)" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /><?php load_module('header') ?>

</head>
<body>

<?php $args['pre-template'] !== 'print' and $args['user-navbar']
	and UserNavbar::spawn() ?>


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
				<li><?php print_menu_link('torna-a-io-conto', null, 'white-text') ?></li>
				<li><?php print_menu_link('istruzioni-compilazione', null, 'white-text') ?></li>
				<li><?php print_menu_link('assistenza', null, 'white-text') ?></li>
				<?php if( is_logged() ): ?>
				<li><?php print_menu_link('logout', null, 'white-text') ?></li>
				<?php else: ?>
				<li><?php print_menu_link('login', null, 'white-text') ?></li>
				<?php endif ?>
			</ul>
		</footer>
	</aside>
	<!-- /left -->

	<!-- main -->
	<div class="section col s12 m6 l8">

<?php } }
