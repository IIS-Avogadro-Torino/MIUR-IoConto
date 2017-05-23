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

is_logged()
	and http_redirect(URL);

$sent = false;

Header::spawn('password-recovery');

if( isset( $_REQUEST[ User::UID ] ) ) {
	$user = User::factoryByUID( $_REQUEST[ User::UID ] )
		->queryRow();

	if($user) {

		$user_token = $user->get(User::RECOVERY_TOKEN);
		$user_email = $user->get(User::EMAIL);

		if( isset( $_REQUEST['token'] ) ) {
			$token = $_REQUEST['token'];

			if( $user_token && $token === $user_token ) {
				$pass = generate_random_string(10);
				$pass_enc = Session::encryptUserPassword( $pass );

				$user->updateUser( [
					new DBCol(User::RECOVERY_TOKEN, null,      null ),
					new DBCol(User::PASSWORD,       $pass_enc, 's'),
				] );

				Email::send( $user->getUserEmail() , _("Password resettata"), sprintf(
					_(
						"Come da Lei richiesto in seguito le nuove credenziali di accesso per la piattaforma Io Conto seconda edizione:\n\n ".

						"Nome utente:\n ".
						"%s\n\n ". // $user->getUserUID()

						"Password:\n ".
						"%s\n\n ". // $pass

						"Indirizzo per l'accesso:\n ".
						"%s" // login_url()
					),
					$user->getUserUID(),
					$pass,
					login_url( $user->getUserEmail() )
				) );

				$sent = true;

				MessageBox::spawn( sprintf(
					 _("Procedura di recupero password completata. Riceverai all'indirizzo <b>%s</b> le nuove credenziali di accesso.<br /> Puoi chiudere questa finestra."),
					esc_html( $user->getUserEmail() )
				) );

			} else {
				MessageBox::spawn( _("Token già utilizzato. Se hai ancora bisogno di recuperare la tua password, ri-esegui le istruzioni in questa pagina."), MessageBox::WARNING );
			}

		} else {
			$token = str_truncate( sha1( rand() . DOT . rand() ), 20 );
			$url =  menu_url('password-recovery') . '?';
			$url .= http_build_query( [
				User::UID => $user->getUserUID(),
				'token'   => $token
			] );
			$user->updateUser( new DBCol(User::RECOVERY_TOKEN, $token, 's' ) );
			Email::send( $user->getUserEmail() , _("Procedura di reset password"), sprintf(
				_("Hai richiesto il recupero password per la piattaforma Io Conto seconda edizione?\n Clicca sul seguente link per confermare:\n %s"),
				$url
			) );
			$sent = true;

			MessageBox::spawn( sprintf(
				_("Segui le istruzioni ricevute via e-mail all'indirizzo <b>%s</b>. Puoi chiudere questa finestra."),
				esc_html( $user->getUserEmail() )
			) );
		}
	} else {
		MessageBox::spawn(
			sprintf(
				_("Questa e-mail sembra non essere registrata. Puoi richiedere assistenza: %s."),
				assist_link()
			),
			MessageBox::WARNING
		);
	}
}
?>

<?php if( ! $sent ): ?>
	<div class="card-panel">
		<p class="flow-text"><?php _e("Se hai smarrito la password che ti è stata trasmessa via e-mail, puoi richiederne un'altra. Per procedere, inserisci il tuo indirizzo e-mail personale.") ?></p>
		<form method="post" action="<?php echo menu_url('password-recovery') ?>">
			<div class="row">
				<div class="col s12 input-field">
					<input type="email" name="<?php echo User::UID ?>" id="uid" class="validate" required />
					<label for="uid"><?php _e("Inserisci la tua email personale") ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<button type="submit" class="btn light-blue darken-1 waves-effect"><?php _e("Procedi"); echo m_icon() ?></button>
				</div>
			</div>
		</form>
	</div>
<?php endif ?>

<?php
Footer::spawn();
