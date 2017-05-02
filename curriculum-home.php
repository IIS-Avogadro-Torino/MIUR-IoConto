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

HeaderCurriculum::spawn('curriculum-home', [
	'toolbar-login' => true
] );

?>
	<center>
		<img src="http://www.ioconto.itisavogadro.org/media/k2/items/cache/ada9a09acea936d776a6f55c82778c43_XL.jpg" width="150" />
	</center>
	<ul class="collection">
		<li class="collection-item">
			<?php print_menu_link('curriculum-2017', _("Crea il tuo Curriculum online") . m_icon('edit'), 'btn light-blue darken-1 waves-effect') ?>
		</li>
		<li class="collection-item">
			<?php _e("Modello e istruzioni") ?>
		</li>
		<li class="collection-item">
			<?php _e("Esempi") ?>
		</li>
	</ul>
<?php

FooterCurriculum::spawn();
