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

class LoginToolbar {
	static function spawn() {
		if( is_logged() ) return;
	?>

	<!-- right -->
	<aside class="col hide-on-small-only m3 l2">
		<form method="post" class="card-panel" action="<?php echo menu_url('login') ?>">
			<div class="row">
				<div class="col s12 input-field">
					<input type="text" name="user_uid" id="user_uid" />
					<label for="user_uid"><?php _e("Nome utente") ?></label>
				</div>
				<div class="col s12 input-field">
					<input type="password" name="user_password" id="user_password" />
					<label for="user_password"><?php _e("Password") ?></label>
				</div>
				<div class="col s12 input-field">
					<button type="submit" class="btn light-blue darken-1 waves-effect"><?php _e("Login") ?> <?php echo m_icon() ?></button>
				</div>
			</div>
		</form>
	</aside>
	<!-- right -->

<?php } }
