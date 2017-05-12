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

Header::spawn('password-recovery');

if( isset( $_POST['uid'] ) ) {
	$uid = luser_input( $_POST['uid'], 20 );

	$users = User::factory( $uid )
		->where( sprintf(
			"%s LIKE '%s'",
			"$uid%"
		) )
		->queryResults();

	if( count( $users ) < 2 ) {
		MessageBox::spawn( sprintf(
			_("Per favore, richiedi l'assistenza. Il meccanografico non è previsto: %s."),
			'http://assistenza'
		) );
	} else {
		$msg = sprintf(
			"Caro DS, caro DSGA,\n ".
			"Ecco a voi i due link: ".
			"asd"
		);
		Email::send( $user->getUserEmail(), _("Accesso alla piattaforma per DS e DSGA"), $msg );
	}
}

?>
	<div class="card-panel">
		<?php if($sent): ?>
			<p class="flow-text"><?php _e("E-mail inviata con successo!") ?></p>
			<p><?php _e("Segui le istruzioni ricevute via E-mail. Puoi chiudere questa finestra.") ?></p>
		<?php else: ?>
		<p class="flow-text"><?php _e("Inserisci il codice meccanografico per richiedere gli accessi per il DS ed il DSGA.") ?></p>
		<form method="post">
			<div class="row">
				<div class="col s12">
					<input type="email" name="uid" id="uid" class="validate" required />
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
