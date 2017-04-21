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
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

require 'load.php';

require_permission('EDIT_HIS_POLE_SCHOOL');

$scuola = get_scuola();

Header::factory( 'single-pole-school-edit-fields' );

$saved = false;

if( ! empty($_POST) ) {
	$_POST[Scuola::FISCALE]              = luser_input( @$_POST[Scuola::FISCALE],              11);
	$_POST[Scuola::RESPONSABILE_NAME]    = luser_input( @$_POST[Scuola::RESPONSABILE_NAME],    32);
	$_POST[Scuola::RESPONSABILE_SURNAME] = luser_input( @$_POST[Scuola::RESPONSABILE_SURNAME], 32);
	$_POST[Scuola::RESPONSABILE_EMAIL]   = luser_input( @$_POST[Scuola::RESPONSABILE_EMAIL],   254);
	$_POST[Scuola::RESPONSABILE_PHONE]   = luser_input( @$_POST[Scuola::RESPONSABILE_PHONE],   32);
	$_POST[Scuola::ADDRESS]              = luser_input( @$_POST[Scuola::ADDRESS],              128);
	$_POST[Scuola::TESORERIA_CODICE]     = luser_input( @$_POST[Scuola::TESORERIA_CODICE],     Scuola::TESORERIA_CODICE_MAXLEN);
	$_POST[Scuola::TESORERIA_CONTO]      = luser_input( @$_POST[Scuola::TESORERIA_CONTO],      Scuola::TESORERIA_CONTO_MAXLEN);

	if( ! filter_var($_POST[Scuola::RESPONSABILE_EMAIL], FILTER_VALIDATE_EMAIL) ) {
		MessageBox::spawn( _("Inserisci una email valida."), MessageBox::WARNING);
	} elseif( strlen( $_POST[Scuola::FISCALE] ) !== 11 ) {
		MessageBox::spawn( sprintf(
			_("Il codice fiscale della scuola deve essere di <b>%d</b> caratteri."),
			11
		), MessageBox::WARNING);
	} else {
		$scuola->updateScuola( [
			new DBCol(Scuola::FISCALE,              $_POST[Scuola::FISCALE],              's'),
			new DBCol(Scuola::RESPONSABILE_NAME,    $_POST[Scuola::RESPONSABILE_NAME],    's'),
			new DBCol(Scuola::RESPONSABILE_SURNAME, $_POST[Scuola::RESPONSABILE_SURNAME], 's'),
			new DBCol(Scuola::RESPONSABILE_EMAIL,   $_POST[Scuola::RESPONSABILE_EMAIL],   's'),
			new DBCol(Scuola::RESPONSABILE_PHONE,   $_POST[Scuola::RESPONSABILE_PHONE],   's'),
			new DBCol(Scuola::ADDRESS,              $_POST[Scuola::ADDRESS],              's'),
			new DBCol(Scuola::TESORERIA_CODICE,     $_POST[Scuola::TESORERIA_CODICE],     's'),
			new DBCol(Scuola::TESORERIA_CONTO,      $_POST[Scuola::TESORERIA_CONTO],      'd')
		] );

		$scuola = get_scuola();

		$saved = true;

		MessageBox::spawn("Dati salvati!");
	}
}
?>
	<p><?php printf(
		_("Puoi cambiare alcune informazioni relative alla scuola polo <b>%s</b> di <b>%s</b> (<code>%s</code>)."),
		$scuola->getScuolaName(),
		$scuola->getComuneName(),
		$scuola->getScuolaMeccanografico()
	) ?></p>

	<form action="<?php echo site_page( basename( __FILE__ ) ) ?>" method="post">
		<p><?php _e("Informazioni sul responsabile:") ?></p>
		<div class="row">
			<?php
			InputField::spawn('text',
				Scuola::RESPONSABILE_NAME,
				_("Nome del responsabile"),
				$scuola->getScuolaResponsabileName(),
				'mdi-action-account-circle'
			);
			InputField::spawn('text',
				Scuola::RESPONSABILE_SURNAME,
				_("Cognome del responsabile"),
				$scuola->getScuolaResponsabileSurname(),
				'mdi-action-account-circle'
			);
			?>
		</div>
		<div class="row">
			<?php
			InputField::spawn('email',
				Scuola::RESPONSABILE_EMAIL,
				_("Email del responsabile"),
				$scuola->getScuolaResponsabileEmail(),
				'mdi-communication-email'
			);
			InputField::spawn('text',
				Scuola::RESPONSABILE_PHONE,
				_("Telefono del responsabile"),
				$scuola->getScuolaResponsabilePhone(),
				'mdi-communication-phone'
			);
			?>
		</div>

		<p><?php _e("Informazioni sulla scuola:") ?></p>
		<div class="row">
			<?php
			InputField::spawn('text',
				Scuola::FISCALE,
				_("Codice fiscale della scuola"),
				$scuola->getScuolaCodicefiscale(),
				'mdi-action-perm-identity'
			);
			InputField::spawn('text',
				Scuola::ADDRESS,
				_("Indirizzo della scuola"),
				$scuola->getScuolaAddress(),
				'mdi-action-perm-identity'
			);
			?>
		</div>

		<p><?php _e("Informazioni sulla tesoreria:") ?></p>
		<div class="row">
			<?php
			InputField::spawn(
				'text',
				Scuola::TESORERIA_CODICE,
				sprintf(
					_("Codice tesoreria <small>(%d caratteri numerici </small>"),
					Scuola::TESORERIA_CODICE_MAXLEN
				),
				$scuola->getScuolaTesoreriaCodice(),
				'mdi-editor-attach-money',
				HTML::property('maxlength', Scuola::TESORERIA_CODICE_MAXLEN)
			);
			InputField::spawn(
				'text',
				Scuola::TESORERIA_CONTO,
				sprintf(
					_("Conto tesoreria <small>(%d caratteri numerici </small>"),
					Scuola::TESORERIA_CONTO_MAXLEN
				),
				$scuola->getScuolaTesoreriaConto(),
				'mdi-editor-attach-money',
				HTML::property('maxlength', Scuola::TESORERIA_CONTO_MAXLEN)
			)
			?>
		</div>

		<div class="row">
			<div class="col s12 m6">
				<button type="submit" class="btn">
					<?php $saved and _e("Aggiorna dati") or _e("Salva tutto") ?>
				</button>
			</div>
			<div class="col s12 m6">
			<?php $saved and BackendNav::spawn() ?>
			</div>
		</div>
	</form>
<?php
Footer::factory();
