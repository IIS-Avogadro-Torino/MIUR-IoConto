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
	static function factory($uid, $args = []) {

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
			'complete-site-name' => true
		], $args);

		switch( $args['pre-template'] ) {
			case 'print':
				enqueue_css('materialize-post-style');
				enqueue_css('print-mode');
				break;

			case 'default':
				enqueue_css('materialize');
				enqueue_css('materialize-icons');
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
	<meta name="author" content="Valerio Bozzolan" />
	<meta name="generator" content="DIY PHP - MariaDB - MaterializeCSS - GNU Nano :^)" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /><?php load_module('header') ?>

</head>
<body>

<?php $args['pre-template'] !== 'print'
	and UserNavbar::spawn() ?>

<div class="container" style="clear: both">
	<div class="row valign-wrapper">
		<div class="col s11 m8">
			<?php if($args['permalink']) : ?>
				<h2><?php echo HTML::a(
					site_page( $menuEntry->url, ROOT ),
					$title,
					$complete_title
				) ?></h2>
			<?php else :?>
				<h2><?php _esc_html($title) ?></h2>
			<?php endif ?>
		</div>
		<div class="col s1 m4">
			<img alt="<?php _esc_attr(SITE_NAME) ?>" src="<?php echo IMAGE_URL . '/formazione-MIUR-Io-Conto.png' ?>" id="io-conto-logo" />
		</div>
	</div>
</div>

<!-- Start header container -->
<div class="container">
<?php } }
