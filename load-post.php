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

#
# This file is called after Boz-PHP initialization.
# This describe this CMS.
#

defined('BOZ_PHP') or exit;

defined('INCLUDES')
	or define('INCLUDES', 'includes');

defined('CONTENT')
	or define('CONTENT', 'content');

// Debian distribution
defined('JQUERY')
	or define('JQUERY', '/javascript/jquery/jquery.min.js');

defined('JQUERY_UID')
	or define('JQUERY_UI', '/javascript/jquery-ui/jquery-ui.min.js');

define('UPLOADS',   CONTENT . '/uploads');

define('SITE_NAME',        _("Io Conto") );
define('SITE_DESCRIPTION', _("Area riservata scuole polo progetto formativo MIUR - Io Conto") );

// Attachments
define('UPLOADS_URL',  ROOT . _ . UPLOADS );

// Static images
define('IMAGE_URL',    ROOT . _ . CONTENT . '/images');

// CSS and JS frameworks
define('MEDIA_URL',    ROOT . _ . CONTENT . '/media' );

// Custom CSS-JS patches
define('THEME_URL',    ROOT . _ . CONTENT . '/themes/materialize' );

// Classes dynamically requiredo
spl_autoload_register( function($c) {
	$path = ABSPATH . __ . INCLUDES . __ ."class-$c.php";
	if( is_file( $path ) ) {
		require $path;
	}
} );

// Custom Boz-PHP user class
define('SESSIONUSER_CLASS', 'User');

// Permissions
register_permissions('VISITOR', 'VIEW_SITE');
inherit_permissions( 'MANAGE_SINGLE_POLE_SCHOOL', 'VISITOR');
register_permissions('MANAGE_SINGLE_POLE_SCHOOL', 'VIEW_SCHOOL_RELATED_RESOURCES');
register_permissions('MANAGE_SINGLE_POLE_SCHOOL', 'EDIT_HIS_POLE_SCHOOL');
inherit_permissions( 'MANAGE_POLE_SCHOOLS',       'VISITOR');
register_permissions('MANAGE_POLE_SCHOOLS',       'VIEW_SCHOOL_RELATED_RESOURCES');
register_permissions('MANAGE_POLE_SCHOOLS',       'EDIT_ALL_POLE_SCHOOLS');

// Javascript and CSS resources
register_js('jquery',                   JQUERY);
register_js('jquery-ui',                JQUERY_UI);
register_js('jquery-ui-custom',         MEDIA_URL . '/jquery-ui-1.11.4.custom/jquery-ui.min.js');
register_js('materialize',              MEDIA_URL . '/materialize/js/materialize.min.js', JS::FOOTER);
register_js('datepicker-settings',      MEDIA_URL . '/datepicker-settings.js');
register_js('model-view-controller',    ROOT . '/static/model-view-controller.js');
register_css('jquery-ui-custom',        MEDIA_URL . '/jquery-ui-1.11.4.custom/jquery-ui.min.css');
register_css('materialize',             MEDIA_URL . '/materialize/css/materialize.min.css');
register_css('materialize-icons',      'https://fonts.googleapis.com/icon?family=Material+Icons');
register_css('materialize-post-style',  THEME_URL . '/post-style.css');
register_css('materialize-patch',       ROOT . '/static/materialize.patch.css');
register_css('print-mode',              THEME_URL . '/print-mode.css');

// Menu entries
add_menu_entries( [
	new MenuEntry('home',                                     '',                                              _("Home") ),
	new MenuEntry('login',                                    '/login.php',                                    _("Autenticati") ),
	new MenuEntry('logout',                                   '/login.php?logout',                             _("Esci") ),
	new MenuEntry('about',                                    '/about.php',                                    _("Crediti") ),
	new MenuEntry('404',                                      '/404.php',                                      _("Pagina non trovata!"),               'hidden' ),
	new MenuEntry('curriculum-2017',                          'curriculum-2017-2.php',                         _("Il tuo Curriculum"),                 '2017'),
	new MenuEntry('curriculum-home',                          'curriculum-home.php',                           _("Home"),                              '2017'),
	new MenuEntry('news',                                     'http://www.ioconto.itisavogadro.org/index.php/news', _("News"),                         '2017')
] );

// Global objects dynamically instantiated
register_expected('moduliRendiconto', 'ModuliRendiconto');

// PHP twicks
date_default_timezone_set('Europe/Rome');
setlocale(LC_MONETARY, 'it_IT');

// Shortcuts
require 'includes/functions.php';
