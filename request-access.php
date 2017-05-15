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

Header::spawn('password-recovery');

$sent = false;
if( isset( $_POST['uid'] ) ) {
	$uid = luser_input( $_POST['uid'], 20 );

	$school = Scuola::factoryByMeccanografico( $uid )
		->select( [
			Scuola::ID_,
			Scuola::EMAIL,
			Scuola::MECCANOGRAFICO
		] )
		->queryRow();

	if( $school ) {

		// Sanitized
		$school_ID       = $school->get(Scuola::ID);
		$school_register = $school->getSchoolRegisterURL();
		$school_email    = $school->get(Scuola::EMAIL);

		$organico = Organico::factory()
			->select( [
				Organico::ID_
			] )
			->whereInt(Organico::SCUOLA_, $school_ID)
			->queryResults();

		if( count( $organico ) === 0 ) {
			$msg = sprintf(
				"Caro DS, caro DSGA,\n ".
				"Ecco a voi gli indirizzi per richiedere gli accessi personali in Formazione MIUR.\n\n ".
				"Per il DS:\n %s \n\n" .
				"Per il DSGA:\n %s \n\n"
				,
				$school->getSchoolRegisterURL(Organico::DS),
				$school->getSchoolRegisterURL(Organico::DSGA)
			);

			Email::send( $school_email, _("Accesso alla piattaforma per DS e DSGA"), $msg );

			$sent = true;
		} else {
			MessageBox::spawn( sprintf(
				_("Questa procedura non può essere eseguita due volte. Per favore contatta l'assistenza: %s."),
				'http://assistenza'
			), MessageBox::WARNING );
		}
	} else {
		MessageBox::spawn( sprintf(
			_("Questo meccanografico non è previso. Per favore, richiedi assistenza: %s."),
			'http://assistenza'
		), MessageBox::WARNING );
	}
}

?>
	<div class="card-panel">
		<?php if($sent): ?>
			<p class="flow-text"><?php _e("E-mail inviata con successo!") ?></p>
			<p><?php _e("Segui le istruzioni ricevute via e-mail all'indirizzo istituzionale della scuola. Puoi chiudere questa finestra.") ?></p>
		<?php else: ?>
		<p class="flow-text"><?php _e("Inserisci il codice meccanografico per richiedere gli accessi per il DS ed il DSGA.") ?></p>
		<form method="post">
			<div class="row">
				<div class="col s12">
					<input type="text" name="uid" id="uid" class="validate" required />
					<label for="uid"><?php _e("Inserisci codice meccanografico") ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<button type="submit" class="btn light-blue darken-1 waves-effect"><?php _e("Invia istruzioni"); echo m_icon() ?></button>
				</div>
			</div>
		</form>
		<?php endif ?>
	</div>
<?php

Footer::spawn();
