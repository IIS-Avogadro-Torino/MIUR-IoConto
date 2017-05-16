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

$sent = ! empty( $_POST['uid'] );

$uid = null;

if( isset( $_POST['uid'] ) ) {
	$uid = $_POST['uid'];

	$user = User::factoryByUID( $uid )
		->queryRow();

	if($user) {
		$token = str_truncate( sha1( rand() . DOT . rand() ), 20 );
		$url =  menu_url('password-change') . '?';
		$url .= http_build_query( [
			'uid'   => $uid,
			'token' => $token
		] );
		$user->updateUser( new DBCol(User::TOKEN, $token, 's' ) );
		Email::send( $user->getUserEmail() , _("Procedura di reset password"), sprintf(
			_("Recupero password:\n %s"),
			$url
		) );

		if( $user->get(User::EMAIL) !== $user->get(User::EMAIL_OFFICIAL) ) {
			Email::send( $user->getUserEmail() , _("Notifica procedura di reset password"), sprintf(
				_("Con la presente per informarla che l'utente %s sta effettuando la procedura di recupero password e la riceverà alla email: %s."),
				$user->getUserUID(),
				$user->getUserEmail()
			) );
		}
	} else {
		error("Utente non esistente");
	}
}

Header::spawn('password-recovery');

?>
	<div class="card-panel">
		<?php if($sent): ?>
			<p class="flow-text"><?php _e("E-mail inviata con successo!") ?></p>
			<p><?php _e("Segui le istruzioni ricevute via E-mail. Puoi chiudere questa finestra.") ?></p>
		<?php else: ?>
		<p class="flow-text"><?php _e("Inserisci la tua email personale. Riceverai le istruzioni per e-mail.") ?></p>
		<form method="post">
			<div class="row">
				<div class="col s12 m6">
					<input type="email" name="uid" id="uid" class="validate" required />
					<label for="uid"><?php _e("Inserisci la tua email personale") ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6">
					<button type="submit" class="btn light-blue darken-1 waves-effect"><?php _e("Invia istruzioni"); echo m_icon() ?></button>
				</div>
			</div>
		</form>
		<?php endif ?>
	</div>
<?php

Footer::spawn();
