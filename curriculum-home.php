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

Header::spawn('curriculum-home', [
	'toolbar-login' => true
] );

?>
	<div class="card-panel">
	Gentile DS, <br />
	Gentile DSGA, <br />
	Cliccando sul pulsante <em>Crea il tuo curriculum</em> accederai ad una pagina nella quale inserire le informazioni necessarie a valutare la tua candidatura per il ruolo di "formatore esperto" nel progetto Io conto seconda edizione.
	Come avrai modo di vedere si tratta di una procedura rapida che serve solo ad avere un quadro delle competenze che hai.<br />

	Si tratta di selezionare da un menù a tendina le proprie qualifiche e poi di dettagliarle (se lo si ritiene necessario) in un campo di testo (ad esempio è possibile mettere per esteso il titolo delle proprie pubblicazioni).<br />

	Alla fine è possibile stampare il proprio cv e inserire una fotografia.<br />

	Dopo avere cliccato il pulsante <em>Salva</em>, una serie di popup avvertono che si sta per inviare e concludere la procedura e che dopo l'invio NON sarà più possibile modificare quanto inviato.
	</div>

	<ul class="collection">
		<li class="collection-item">
			<?php print_menu_link('curriculum-2017', _("Crea il tuo Curriculum online") . m_icon('edit'), 'btn light-blue darken-1 waves-effect') ?>
		</li>
		<li class="collection-item">
			<?php _e("Modello e istruzioni") ?>
		</li>
		<li class="collection-item">
			<?php _e("Esempi") ?>
		</li>
	</ul>
<?php

Footer::spawn();
