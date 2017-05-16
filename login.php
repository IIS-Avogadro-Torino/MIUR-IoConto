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

?>

	<?php if( $status === Session::LOGIN_FAILED): ?>
		<?php MessageBox::spawn( _("Nome utente o password errati."), MessageBox::WARNING ) ?>
	<?php elseif( $status === Session::USER_DISABLED ): ?>
		<?php MessageBox::spawn( _("Utente disabilitato."), MessageBox::WARNING ) ?>
	<?php endif ?>

	<div class="card-panel">
		<p>
			Gentile DS, <br />
			Gentile DSGA, <br />
			Cliccando sul pulsante <em>Accedi</em> verrai indirizzato alla pagina <em>Crea il tuo curriculum online</em>.

			<?php /*
			ad una pagina nella quale inserire le informazioni necessarie a valutare la tua candidatura per il ruolo di "formatore esperto" nel progetto Io conto seconda edizione.
			Come avrai modo di vedere si tratta di una procedura rapida che serve solo ad avere un quadro delle competenze che possiedi.<br />

			Si tratta di selezionare da un menù a tendina le proprie esperienze professionali e di dettagliarle (obbligatoriamente) in un campo di testo (ad esempio devi mettere per esteso il titolo delle pubblicazioni).<br />
			Si precisa che è necessario compilare <em>tutti</em> i campi per completare la procedura di candidatura.
			*/ ?>
		</p>

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
	<?php /*
	<div class="row">
		<div class="col s12 m6">
			<div class="card-panel">
				<p><?php _e("Password dimenticata?") ?></p>
				<p><?php print_menu_link('password-recovery', null, 'btn waves-effect light-blue darken-1') ?></p>
			</div>
		</div>
	</div>
	*/ ?>
	<div class="row">
		<div class="col s12 m6">
			<div class="card-panel">
				<p><?php _e("Richiedi registrazione (solo la prima volta che accedi).") ?></p>
				<p><?php print_menu_link('request-access', null, 'btn waves-effect orange') ?></p>
			</div>
		</div>
	</div>
<?php

Footer::spawn();
