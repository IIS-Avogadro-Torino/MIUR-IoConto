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

Header::spawn('register');

$invalidate = function ($s) {
	MessageBox::spawn( sprintf(
		"%s. Contatta l'assistenza: %s.",
		$s,
		'http://assistenza'
	), MessageBox::WARNING );
	Footer::spawn();
};

$uid   = @ $_GET['uid'];
$token = @ $_GET['token'];
$role  = @ $_GET['role'];

empty( $uid ) or empty( $token ) or empty( $role )
	and http_redirect('request-access');

if( $role !== Organico::DS && $role !== Organico::DSGA ) {
	error_die("Unknown role");
}

$school = Scuola::factoryByMeccanografico( $uid )
	->select( [
		Scuola::ID_,
		Scuola::MECCANOGRAFICO,
		Scuola::EMAIL
	] )
	->queryRow();

$school or
	$invalidate( _("Questa scuola non è prevista") );

$school_token = $school->getSchoolToken();

if( $token !== $school_token ) {
	$invalidate( _("Il token non è valido") );
}

$school_ID    = $school->get(Scuola::ID);
$school_mecc  = $school->get(Scuola::MECCANOGRAFICO);
$school_email = $school->get(Scuola::EMAIL);

$organicos = Organico::factory()
	->whereInt(Organico::SCUOLA_, $school_ID)
	->queryResults();

foreach($organicos as $organico) {
	if( $organico->get(Organico::ROLE) === $role ) {
		$invalidate( sprintf(
			_("Un %s è già registrato"),
			esc_html($role)
		) );
	}
}

$email = null;
$register = false;
if( isset( $_POST['email'] ) ) {

	$email = luser_input( $_POST['email'], 100 );

	if( filter_var($email, FILTER_VALIDATE_EMAIL) === false ) {
		error_die("Invalid email format");
	}

	$emailExists = User::factory()
		->whereStr( User::UID, $email )
		->queryRow();

	if( $emaiExists ) {
		error_die("L'email esiste già");
	}

	$pass = generate_random_string(10);
	$pass_enc = Session::encryptUserPassword( $pass );

	insert_row(Organico::T, [
		new DBCol(Organico::ROLE,   $role,       's'),
		new DBCol(Organico::SCUOLA, $school_ID,  'd')
	] );
	$organico_ID = last_inserted_ID();

	insert_row(User::T, [
		new DBCol(User::UID,       $email,       's'),
		new DBCol(User::PASSWORD,  $pass_enc,    's'),
		new DBCol(User::ORGANICO,  $organico_ID, 'd'),
		new DBCol('user_role',     'user',       's'),
		new DBCol(User::ACTIVE,    1,            'd')
	] );

	Email::send( $email , _("Credenziali di accesso"), sprintf(
		_(
			"Con la presente per comunicarle le credenziali per il %s della scuola %s per la selezione a esperti formatori del progetto Io Conto seconda edizione:\n\n ". // $role, $school_mecc

			"Nome utente:\n ".
			"%s\n\n ". // $email

			"Password:\n ".
			"%s\n\n ". // $pass

			"Indirizzo per l'accesso:\n ".
			"%s" // login_url()
		),
		$role,
		$school_mecc,
		$email,
		$pass,
		login_url( $email )
	) );

	Email::send( $school_email, _("Notifica registrazione"), sprintf(
		_(
			"Con la presente per informarvi che il %s ha registrato con successo la seguente email personale per la selezione a esperti formatori del progetto Io Conto seconda edizione:\n ".
			"%s.\n\n ". // $email
			"Le prossime comunicazioni relative a questo singolo utente avverranno attraverso l'email appena specificata."
		),
		$role,
		$email
	) );

	$register = true;
}

?>

	<?php $yesno = function () { ?>
	<div class="answers">
		<button type="button" class="yes btn waves-effect light-blue darken-1"><?php _e("Sì") ?></button>
		<button type="button" class="no  btn waves-effect light-blue darken-1"><?php _e("No") ?></button>
	</div>
	<?php }; ?>


	<div class="card-panel">
		<?php if($register): ?>
			<p class="flow-text"><?php printf(
				_("Ottimo! Riceverai a breve un'email all'indirizzo %s con le istruzioni per l'accesso."),
				"<code>" . esc_html( $email ) . "</code>"
			) ?></p>
			<p><?php _e("Puoi chiudere questa finestra.") ?></p>
		<?php else: ?>

		<div class="question question-1" data-activator=".question-2">
			<p class="flow-text"><?php printf(
				_("Sei il %s della scuola %s?"),
				esc_html($role),
				esc_html($school_mecc)
			) ?></p>

			<?php $yesno() ?>
			<p class="wrong-answer flow-text"><?php _e("La procedura termina qui.") ?></p>
		</div>

		<div class="question question-2" data-activator=".sure-sure-sure">
			<p class="flow-text"><?php printf(
				_("Sei il %s titolare?"),
				esc_html($role)
			) ?></p>

			<?php $yesno() ?>

			<p class="wrong-answer flow-text"><?php _e("Devi essere un DS titolare o un DSGA titolare.") ?></p>
		</div>

		<form method="post" class="sure-sure-sure">
			<p class="flow-text"><?php
				_e("Ora puoi impostare la tua email personale.")
			?></p>
			<div class="row">
				<div class="col s12 m6 input-field">
					<input type="email" name="email" id="email" class="validate" required />
					<label for="email"><?php _e("E-mail personale") ?></label>
				</div>
				<div class="col s12 m6 input-field">
					<input type="email" name="email_repeat" id="email-repeat" class="validate" required />
					<label for="email-repeat"><?php _e("Ripeti la tua e-mail personale") ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6">
					<button type="submit" class="btn light-blue darken-1 waves-effect"><?php _e("Ricevi istruzioni"); echo m_icon() ?></button>
				</div>
			</div>
		</form>
		<?php endif ?>

		<script>
		$(document).ready( function () {
			$('form').submit( function (event) {
				var $email  = $('input[name=email]');
				var $email2 = $('input[name=email_repeat]');
				if( $email.val() !== $email2.val() ) {
					$email2.val('');
					Materialize.toast('<?php _e("Ri-controlla la tua e-mail") ?>', 4000);
					event.preventDefault();
				}
			} );

			$('.question .yes').click( function () {
				var v = $(this).closest('.question').hide().data('activator');
				$(v).show();
			} );

			$('.question .no').click( function () {
				$(this).closest('.answers').hide();
				$(this).closest('.question').find('.wrong-answer').show();
			} );

			$('.sure-sure-sure, .question-2, .wrong-answer').hide();
		} );
		</script>
	</div>

<?php

Footer::spawn();
