<?php
# Formazione MIUR content management system
# Copyright (C) 2017 Valerio Bozzolan
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

Header::spawn('stats');

$n_ds = Organico::factory()
	->select('COUNT(*) as count')
	->whereStr( Organico::ROLE, Organico::DS )
	->queryValue('count');

$n_dsga = Organico::factory()
	->select('COUNT(*) as count')
	->whereStr( Organico::ROLE, Organico::DSGA )
	->queryValue('count');

$n_curriculum = Curriculum::factory()
	->select('COUNT(*) as count')
	->whereInt( Curriculum::FINALIZED, 1 )
	->queryValue('count');

?>
	<?php $b = function ($s) { return "<b>$s</b>"; }; ?>
	<div class="card-panel">
		<p class="flow-text"><?php printf(
			_("In questo momento ci sono %s DS e %s DSGA registrati. I curriculum già finalizzati sono %s."),
			$b( $n_ds ),
			$b( $n_dsga ),
			$b( $n_curriculum )
		) ?></p>
	</div>
<?php

Footer::spawn();
