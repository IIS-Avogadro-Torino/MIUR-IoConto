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

has_permission('EDIT_ALL_POLE_SCHOOLS')
	and http_redirect( URL . '/all-pole-school.php' );

require_permission('EDIT_HIS_POLE_SCHOOL');

Header::factory( 'single-pole-school' );

$scuola = get_scuola( get_user('scuola_ID') );

empty($scuola) and
	require_permission('unexisting-permission');
?>
	<p><?php printf(
		_("In seguito tutte le azioni relative alla scuola polo <b>%s</b> di <b>%s</b> (<code>%s</code>)."),
		$scuola->scuola_nome,
		$scuola->comune_name,
		$scuola->scuola_meccanografico
	) ?></p>
<?php

print_menu('single-pole-school', 0, [
	'max-level' => 0
] );

Footer::factory();
