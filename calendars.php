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

require 'load.php';

Header::factory( 'calendars' );
?>
	<div class="card-panel">
		<p><?php _e("Cerca il tuo nominativo all'interno dei corsi nazionali (scrivi almeno 3 caratteri nei campi nome e cognome):") ?></p>
		<form class="row" method="post" action="<?php echo ROOT . '/calendars-search-subscribed.php' ?>">
			<div class="col s12 m6 input-field">
				<input type="text" name="calendarioiscritto_nome" id="calendarioiscritto_nome" />
				<label for="calendarioiscritto_nome"><?php _e("Nome (es: Mario)") ?></label>
			</div>
			<div class="col s12 m6 input-field">
				<input type="text" name="calendarioiscritto_cognome" id="calendarioiscritto_cognome" />
				<label for="calendarioiscritto_cognome"><?php _e("Cognome (es: Rossi)") ?></label>
			</div>
			<div class="col s12 m6">
				<button type="submit" class="btn"><?php _e("Cerca nominativo") ?></button>
			</div>
		</form>
	</div>

	<?php BackendNav::spawn() ?>

	<script>
	$(document).ready(function() {
		$("select").material_select();
	});
	</script>

<?php
Footer::factory();
