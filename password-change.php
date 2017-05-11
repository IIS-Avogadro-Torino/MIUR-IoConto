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

$invalidate = function () {
	http_redirect( menu_url('password-recovery') );
};

$uid   = @ $_REQUEST['uid'];
$token = @ $_REQUEST['token'];

empty( $uid ) ||
empty( $token )
	and $invalidate();

$user = User::factoryByUID( $uid )
	->queryRow();

$user	or  $invalidate();

$user_token = $user->get(User::TOKEN);

empty($user_token)
	and $invalidate();

$token_wrong = strlen($token) < 5 || $token !== $user_token;

$token_wrong
	and $invalidate();

$reset = false;
if( isset( $_POST['password'] ) ) {
	$pass = Session::encryptUserPassword( $_POST['password'] );
	$user->updateUser( [
		new DBCol(User::TOKEN,    null, null),
		new DBCol(User::PASSWORD, $pass, 's')
	] );
	$url = menu_url('login');
	Email::send( $user->getUserEmail() , _("Password resettata!"), _("Con la presente per informarla che la password è stata re-impostata.") );
	$reset = true;
}

Header::spawn('password-change');

?>

	<div class="card-panel">
		<?php if($reset): ?>
			<p class="flow-text"><?php _e("Ottimo! Ora effetua l'accesso con le credenziali appena create:") ?></p>
			<p><?php print_menu_link('login', null, 'btn waves-effect light-blue darken-1') ?></p>
		<?php else: ?>
		<p class="flow-text"><?php printf(
			_("Ora crea una nuova password associata alla tua email <strong>%s</strong> da usare per entrare nel sistema Io Conto:"),
			$uid
		) ?></p>
		<form method="post">
			<input type="hidden" name="uid" value="<?php   _esc_attr($uid) ?>" />
			<input type="hidden" name="token" value="<?php _esc_attr($token) ?>" />
			<div class="row">
				<div class="col s12 m6">
					<input type="password" name="password" id="password" class="validate" required />
					<label for="password"><?php _e("Inserisci la tua nuova password") ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6">
					<input type="password" name="password2" id="password2" class="validate" required />
					<label for="password2"><?php _e("Ripeti la tua nuova password") ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6">
					<button type="submit" class="btn light-blue darken-1 waves-effect"><?php _e("Salva password"); echo m_icon() ?></button>
				</div>
			</div>
		</form>
		<?php endif ?>

		<script>
		$(document).ready( function () {
			$('form').submit(function (e) {
				var $p1 = $('input[name=password]').val();
				var $p2 = $('input[name=password2]').val();
				if( $p1 !== $p2 ) {
					Materialize.toast('<?php _e("Le password non combaciano!") ?>', 4000);
					e.preventDefault();
				}
			});
		} );
		</script>
	</div>

<?php

Footer::spawn();
