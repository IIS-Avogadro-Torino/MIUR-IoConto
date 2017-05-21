<?php
# Formazione MIUR content management system
# Copyright (C) 2015, 2016, 2017 Valerio Bozzolan, Ivan Bertotto, ITIS Avogadro
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

Header::spawn('home', [
	'title'     => _("Pagina non trovata"),
	'permalink' => false
] );

?>
	<p class="flow-text"><?php _e("Questa pagina non esiste, o non è più disponibile. Puoi tornare alla homepage:") ?></p>
	<p><?php echo HTML::a(
		URL,
		_("Torna alla home"),
		_("Torna alla pagina principale"),
		'btn'
	) ?></p>
<?php

Footer::spawn();
