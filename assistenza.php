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

required_permission('do-my-curriculum');

$sent = false;

if( isset( $_POST['name'], $_POST['surname'], $_POST['subject'], $_POST['message'] ) ) {

	$small_fields = ['name', 'surname', 'subject'];
	foreach($small_fields as $field) {
		$_POST[$small_field] = luser_input( $_POST[$field], 100 );
		$_POST[$small_field] = strip_tags(  $_POST[$field] );
	}
	$_POST['message'] = luser_input( $_POST['message'], 10000 );

	$email = get_user()->getUserEmail();

	$msg = sprintf(
		"Nome: %s\n " .
		"Cognome: %s\n " .
		"Email: %s\n " .
		"Oggetto: %s\n " .
		"Messagggio:\n\n%s",

		$_POST['name'   ],
		$_POST['surname'],
		$email,
		$_POST['subject'],
		$_POST['message']
	);

	Email::send(ADMIN_EMAIL, _("Richiesta di assistenza"), $msg);
	Email::send($email , _("Copia del messaggio di assistenza"), sprintf(
		_("Di seguito una copia del messaggio che hai trasmesso:\n %s.\n\n".
		  "Riceverai al più presto una risposta."),
		$msg
	) );

	$sent = true;
}

Header::spawn('assistenza');

?>

<?php if($sent): ?>
	<div class="card-panel">
		<p><?php _e("Messaggio inviato!") ?></p>
		<p><?php _e("Puoi chiudere questa finestra o usare i link sulla sinistra.") ?></p>
	</div>
<?php else: ?>
	<p class="flow-text"><?php _e("Hai bisogno di assistenza? Utilizza questo modulo, risponderemo il prima possibile.") ?></p>

	<form method="post" class="card-panel">
		<div class="row">
			<div class="col s12 m6 input-field">
				<?php InputText::spawn( _("Nome"), 'name', null, null, 'required="required"') ?>
			</div>
			<div class="col s12 m6 input-field">
				<?php InputText::spawn( _("Cognome"), 'surname', null, null, 'required="required"') ?>
			</div>
			<div class="col s12 input-field">
				<?php $s = _("Assistenza per selezione esperti formatori") ?>
				<?php InputSelect::spawn(InputSelect::SINGLE, 'subject', null, [
					$s => sprintf("Oggetto: %s", $s)
				] ) ?>
			</div>
			<div class="col s12 input-text">
				<?php Textarea::spawn( _("Inserisci il messaggio") , 'message', null, 'required="required"' ) ?>
			</div>
			<div class="col s12">
				<small><?php printf(
					_("Una copia del messaggio ti sarà spedita al tuo indirizzo: <em>%s</em>"),
					get_user()->getUserEmail()
				) ?></small>
			</div>
			<div class="col s12">
				<button type="submit" class="btn waves-effect light-blue darken-1"><?php _e("Invia richiesta"); echo m_icon() ?></button>
			</div>
		</div>
	</form>

	<script>
	$(document).ready( function () {
		$('select').material_select();
	} );
	</script>

<?php endif ?>

<?php Footer::spawn();
