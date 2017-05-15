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

isset( $_GET['logout'] )
	and logout();

$status = null;
empty( $_POST )
	or login($status);

if( is_logged() ) {
	if( ! empty( $_GET['redirect'] ) && filter_var($redirect, FILTER_VALIDATE_URL) !== false ) {
		http_redirect( $_GET['redirect'] );
	}
	http_redirect(URL);
}

Header::spawn('login');

var_dump($status);

?>

	<?php if( $status === Session::LOGIN_FAILED): ?>
		<?php MessageBox::spawn( _("Nome utente o password errati."), MessageBox::WARNING ) ?>
	<?php elseif( $status === Session::USER_DISABLED ): ?>
		<?php MessageBox::spawn( _("Utente disabilitato."), MessageBox::WARNING ) ?>
	<?php endif ?>

	<?php MessageBox::spawn( sprintf(
		_("Le istruzioni per l'accesso all'area riservata sono state trasmesse via email alle scuole. Chi non le avesse ricevute segnali a <b>%s</b>"),
		ADMIN_EMAIL
	) ) ?>

	<div class="card-panel">
		<p><?php _e("Esegui l'accesso:") ?></p>
		<div class="row">
			<form class="col s12" method="post" action="<?php echo URL  . '/login.php' ?>">
				<?php
				// Start hidden redirect link
				$redirect = null;
				if( !empty($_POST['redirect']) ) {
					$redirect = $_POST['redirect'];
				} elseif( !empty($_GET['redirect']) ) {
					$redirect = $_GET['redirect'];
				}
				?>

				<?php if( ! filter_var($redirect, FILTER_VALIDATE_URL) === false ): ?>
					<input type="hidden" name="redirect" value="<?php echo $redirect ?>" />
				<?php endif ?>

				<div class="row">
					<div class="input-field col s12 m6">
						<i class="mdi-action-account-circle prefix"></i>
						<input name="user_uid" id="user_uid" type="text" class="validate"<?php echo HTML::property('value', @$_REQUEST['user_uid']) ?>>
						<label for="user_uid"><?php _esc_attr( _("Nome utente") ) ?></label>
					</div>
					<div class="input-field col s12 m6">
						<i class="mdi-action-lock prefix"></i>
							<input name="user_password" id="user_password" type="password" class="validate">
					<label for="user_password"><?php _esc_attr( _("Password") ) ?></label>
					</div>
				</div>
				<button class="btn waves-effect waves-light light-blue darken-1" type="submit" name="action"><?php _e("Accedi") ?><?php echo m_icon() ?></button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m6">
			<div class="card-panel">
				<p><?php _e("Password dimenticata?") ?></p>
				<p><?php print_menu_link('password-recovery', null, 'btn waves-effect light-blue darken-1') ?></p>
			</div>
		</div>
	</div>
<?php

Footer::spawn();
