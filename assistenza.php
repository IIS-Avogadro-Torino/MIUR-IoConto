<?php
# Formazione MIUR content management system
# Copyright (C) 2017 Valerio Bozzolan, Ivan Bertotto, ITIS Avogadro
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

Header::spawn('assistenza');

?>
<form method="post" class="card-panel">
	<div class="row">
		<div class="col s12 m6 input-field">
			<?php InputText::spawn( _("Nome"), 'name') ?>
		</div>
		<div class="col s12 m6 input-field">
			<?php InputText::spawn( _("Cognome"), 'name') ?>
		</div>
		<div class="col s12 m6 input-field">
			<?php InputText::spawn( _("E-mail"), 'email' ) ?>
		</div>
		<div class="col s12 m6 input-field">
			<?php $s = _("Assistenza per selezione esperti formatori") ?>
			<?php InputSelect::spawn(InputSelect::SINGLE, _("Oggetto"), 'subject', [
				$s => sprintf("Oggetto: %s", $s)
			] ) ?>
		</div>
		<div class="col s12 input-text">
			<?php TextArea::spawn( _("Corpo del messaggio") , 'message' ) ?>
		</div>
	</div>
</form>

<script>
$(document).ready( function () {
	$('select').material_select();
} );
</script>

<?php

Footer::spawn();
