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

required_permission('do-my-curriculum');

$curriculum = Curriculum::factoryByOrganico()
	->queryRow();

if( ! empty( $_POST )  ) {

	$fields = [
		Curriculum::SURNAME => 's',
		Curriculum::NAME => 's',
		Curriculum::STATUS => 's',
		Curriculum::ROLE => 's',
		Curriculum::CITY => 's',
		Curriculum::CAP => 's',
		Curriculum::PHONE => 's',
		Curriculum::EMAIL => 's',
		Curriculum::YEARS => 's',
		Curriculum::YEARS_DESC => 's',
		Curriculum::STUDY => 's',
		Curriculum::STUDY_DESC => 's',
		Curriculum::COURSES_FOLLOWED => 's',
		Curriculum::COURSES_FOLLOWED_DESC => 's',
		Curriculum::PUBLICATIONS => 's',
		Curriculum::PUBLICATIONS_DESC => 's',
		Curriculum::COURSES_ORGANIZED_SPECIALIZED => 's',
		Curriculum::COURSES_ORGANIZED_SPECIALIZED_DESC => 's',
		Curriculum::COURSES_ORGANIZED_GENERIC => 's',
		Curriculum::COURSES_ORGANIZED_GENERIC_DESC => 's',
		Curriculum::USRMIUR_TASKS => 's',
		Curriculum::USRMIUR_TASKS_DESC => 's',
		Curriculum::REGIONAL_TASK => 's',
		Curriculum::REGIONAL_TASK_DESC => 's',
		Curriculum::ECDL => 'd',
		Curriculum::EXTRALANGUAGE => 'd',
		Curriculum::EXPERT => 'd'
	];
	$dbfields = [];
	foreach($fields as $field => $type) {
		$v = @ $_POST[$field];
		$v = luser_input($v, 5000);
		$dbfields[] = new DBCol($field, $v, $type);
	}

	if( $curriculum ) {
		$curriculum->update($dbfields);
	} else {
		$dbfields[] = new DBCol(Curriculum::ORGANICO, organico_ID(), 'd');
		insert_row(Curriculum::T, $dbfields);
	}

	$what = $curriculum ? _("aggiornato") : _("salvato");
	Email::send(
		get_user()->getUserEmail(),
		sprintf(
			_("Curriculum %s"),
			$what
		),
		sprintf(
			_(
				"Con la presente per informarla che ha %s con successo il suo curriculum.\n ".
				"Torna al curriculum:\n ".
				"%s"
			),
			$what,
			menu_url('curriculum-2017')
		)
	);

	$curriculum = Curriculum::factoryByOrganico()
		->queryRow();
}

Header::spawn('curriculum-2017', [
	'toolbar-upload' => true
] );

$heading = function ($s) {
	printf("<p class='flow-text'>%s</p>\n", $s);
};
$label = function ($s) {
	printf("<div class='input-field col s12 m2'><p>%s</p></div>\n", $s);
};
$container_start = function () {
	echo "<div class='input-field col s12 m9 push-m1 model-view-container'>\n";
};
$container_end = function () {
	echo "</div><!-- / input-field col s12 m9 push-m1 -->\n";
};
$modal_open = function () {
	echo '<p>';
	Modal::open();
	echo '</p>';
};

?>
	<?php if( $curriculum && ! empty( $_POST ) ): ?>
	<div class="card-panel yellow">
		<p class="flow-text"><?php _e("Curriculum salvato con successo!") ?></p>
		<p><?php _e("Ricontrolla di aver compilato tutti i campi.") ?></p>
	</div>
	<?php endif ?>
	<form method="post">

		<!-- Informazioni personali -->
		<div class="card-panel">
			<?php $heading( _("Informazioni personali") ) ?>
			<p><?php _e("Informazioni basilari da compilare prima di procedere con il questionario vero e proprio.") ?></p>

			<?php Modal::start() ?>
				<div class="card-panel">
					<?php $fields = ['SURNAME', 'NAME', 'CAP', 'CITY', 'PHONE', 'EMAIL'] ?>
					<?php foreach($fields as $field): ?>
						<?php $const_value = constant("Curriculum::$field"); ?>
						<p class="input-field"><?php InputText::spawn(
							Curriculum::{$field}(),
							$const_value,
							$curriculum ? $curriculum->get($const_value) : null
						) ?></p>
					<?php endforeach ?>
				</div>
				<div class="card-panel">
					<p><?php _e("Seleziona il tuo ruolo ed il tuo stato:") ?></p>
					<div class="row">
						<div class="col s12 m6 input-field">
							<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::ROLE,   $curriculum ? $curriculum->get(Curriculum::ROLE)   : null, Curriculum::ROLE() ) ?>
						</div>
						<div class="col s12 m6 input-field">
							<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::STATUS, $curriculum ? $curriculum->get(Curriculum::STATUS) : null, Curriculum::STATUS() ) ?>
						</div>
					</div>
				</div>
				<?php Modal::close() ?>
			<?php Modal::end() ?>

			<div class="row">
				<?php $label( _("Informazioni personali") ) ?>
				<?php $container_start() ?>
					<?php $modal_open() ?>
				<?php $container_end() ?>
			</div>
		</div>
		<!-- /Informazioni personali -->

		<!-- Conoscenze di base e specifiche -->
		<div class="card-panel">
			<?php $heading( _("Compilazione curriculum") ) ?>

			<?php ModalInstructions::start( _("Valutare l'esperienza professionale dell'esperto considerando il ruolo e l'anzianità di servizio") ) ?>
				<p><?php _e("Anni di anzianità o di servizio continuativi nel ruolo di DS o DSGA") ?></p>
				<div class="input-field">
					<?php
					InputSelect::spawn(InputSelect::SINGLE, Curriculum::YEARS, $curriculum ? $curriculum->get(Curriculum::YEARS) : null, Curriculum::YEARS() );
					?>
				</div>
				<div class="input-field">
					<?php Textarea::spawn( _("Inserire le scuole presso cui si è prestato servizio e gli anni"), Curriculum::YEARS_DESC, $curriculum ? $curriculum->get(Curriculum::YEARS_DESC) : null) ?>
				</div>
			<?php ModalInstructions::end() ?>

			<div class="row">
				<?php $label( _("Esperienza professionale") ) ?>
				<?php $container_start() ?>
					<p><?php ModalInstructions::open() ?></p>
				<?php $container_end() ?>
			</div>

			<?php ModalInstructions::start( _("Valutare il livello di preparazione dell'esperto considerando il suo percorso accademico formativo") ) ?>

					<!-- Titoli di studio -->
					<div class="card-panel">
						<p><?php _e("Titoli di studio") ?></p>
						<div class="row">
							<div class="col s12 input-field">
								<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::STUDY, $curriculum ? $curriculum->get(Curriculum::STUDY) : null, Curriculum::STUDY() ) ?>
							</div>
							<div class="col s12 input-field">
								<?php Textarea::spawn( _("Dettaglia il tuo percorso accademico"), Curriculum::STUDY_DESC, $curriculum ? $curriculum->get(Curriculum::STUDY_DESC) : null ) ?>
							</div>
						</div>
					</div>
					<!-- /Titoli di studio section -->

					<!-- Corsi di formazione seguiti -->
					<div class="card-panel">
						<p><?php _e("N. corsi di formazione seguiti in qualità di discente su tematiche attinenti alle materie amministrativo contabili (Bilancio, obblighi normativi, acquisizione di beni e servizi)") ?></p>
						<div class="input-field">
							<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::COURSES_FOLLOWED, $curriculum ? $curriculum->get(Curriculum::COURSES_FOLLOWED) : null, Curriculum::COURSES_FOLLOWED() ) ?>
						</div>
						<div class="row">
							<div class="col s12">
								<div class="input-field">
								<?php Textarea::spawn( _("Inserisci più informazioni possibili a proposito di ognuno dei corsi seguiti"), Curriculum::COURSES_FOLLOWED_DESC, $curriculum ? $curriculum->get(Curriculum::COURSES_FOLLOWED_DESC) : null) ?>
								</div>
							</div>
						</div>
					</div>
					<!-- /Corsi di formazione seguiti -->

					<!-- Pubblicazioni -->
					<div class="card-panel">
						<p><?php _e("N. pubblicazioni su tematiche attinenti alle materie del percorso di aggiornamento professionale Io Conto") ?></p>
						<div class="row">
							<div class="col s12 input-field">
								<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::PUBLICATIONS, $curriculum ? $curriculum->get(Curriculum::PUBLICATIONS) : null, Curriculum::PUBLICATIONS() ) ?>
							</div>
							<div class="col s12 input-field">
								<?php Textarea::spawn( _("Per ogni pubblicazione scrivi autore, anno di pubblicazione, editore, ISBN..."), Curriculum::PUBLICATIONS_DESC, $curriculum ? $curriculum->get(Curriculum::PUBLICATIONS_DESC) : null ) ?>
							</div>
						</div>
					</div>
					<!-- /Pubblicazioni -->

			<?php ModalInstructions::end() ?>

			<div class="row">
				<?php $label( _("Conoscenze di base e specifiche") ) ?>
				<?php $container_start() ?>
					<p><?php ModalInstructions::open() ?></p>
				<?php $container_end() ?>
			</div>

			<?php ModalInstructions::start( _("Valutare eventuali esperienze di docenza dell'esperto") ) ?>
				<div class="card-panel">
					<p><?php _e("N. corsi di formazione organizzati e/o erogati in qualità di docente su tematiche attinenti alle materie amministrativo contabili (Bilancio, obblighi normativi, acquisizione di beni e servizi)") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::COURSES_ORGANIZED_SPECIALIZED, $curriculum ? $curriculum->get(Curriculum::COURSES_ORGANIZED_SPECIALIZED) : null, Curriculum::COURSES_ORGANIZED_SPECIALIZED() ) ?>
					</div>
					<div class="row">
						<div class="col s12 input-field">
							<?php Textarea::spawn( _("Inserisci più informazioni possibili a proposito di ognuno dei corsi erogati"), Curriculum::COURSES_ORGANIZED_SPECIALIZED_DESC, $curriculum ? $curriculum->get(Curriculum::COURSES_ORGANIZED_SPECIALIZED_DESC) : null ) ?>
						</div>
					</div>
				</div>

				<div class="card-panel">
					<p><?php _e("N. corsi di formazione organizzati e/o erogati in qualità di docente su tematiche NON attinenti alle materie attinenti alle materie amministrativo contabili (Bilancio, obblighi normativi, acquisizione di beni e servizi)") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::COURSES_ORGANIZED_GENERIC, $curriculum ? $curriculum->get(Curriculum::COURSES_ORGANIZED_GENERIC) : null, Curriculum::COURSES_ORGANIZED_GENERIC() ) ?>
					</div>
					<div class="row">
						<div class="col s12 input-field">
							<?php Textarea::spawn( _("Dettaglia i corsi"), Curriculum::COURSES_ORGANIZED_GENERIC_DESC,  $curriculum ? $curriculum->get(Curriculum::COURSES_ORGANIZED_GENERIC_DESC) : null ) ?>
						</div>
					</div>
				</div>
			<?php ModalInstructions::end() ?>

			<div class="row">
				<?php $label( _("Esperienza in qualità di docente") ) ?>
				<?php $container_start() ?>
					<p><?php ModalInstructions::open() ?></p>
				<?php $container_end() ?>
			</div>


			<!-- Campi blu -->
			<?php ModalInstructions::start( _("Valutare la collaborazione con le diverse direzioni regionali e con altre scuole del contesto regionale e nazionale") ) ?>
				<div class="card-panel">
					<p><?php _e("Incarichi ispettivi per conto USR / MIUR") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::USRMIUR_TASKS, $curriculum ? $curriculum->get(Curriculum::USRMIUR_TASKS) : null, Curriculum::USRMIUR_TASKS() ) ?>
					</div>
					<div class="input-field">
						<?php Textarea::spawn( _("Dettaglia gli incarichi"), Curriculum::USRMIUR_TASKS_DESC, $curriculum ? $curriculum->get(Curriculum::USRMIUR_TASKS_DESC) : null ) ?>
					</div>
				</div>

				<div class="card-panel">
					<p><?php _e("Appartenenza a gruppi di lavoro istituzionali regionali e/o centrali gruppo di lavoro, cabine di regia, comitati paritetici (indicare nome ed estremi)") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::REGIONAL_TASK, null, Curriculum::REGIONAL_TASK() ) ?>
					</div>
					<div class="input-field">
						<?php Textarea::spawn( _("Dettaglia"), Curriculum::REGIONAL_TASK_DESC, null) ?>
					</div>
				</div>

				<div class="card-panel">
					<p><?php _e("Incarichi di reggenza presso Istituzioni scolastiche statali") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, 'government_tasks', null, [
							'3' => _("Gruppi di lavoro, tavoli tecnici ecc. Amministrazione centrale e/o periferica (più di 3)"),
							'5' => _("Incarichi reggenza (più di 3)"),
						] ) ?>
					</div>
					<div class="input-field">
						<?php Textarea::spawn( _("Dettaglia"), 'government_tasks_desc', null) ?>
					</div>
				</div>
			<?php ModalInstructions::end() ?>

			<div class="row">
				<?php $label( _("Collaborazioni con UUSSRR e istituzioni scolastiche") ) ?>
				<?php $container_start() ?>
					<p><?php ModalInstructions::open() ?></p>
				<?php $container_end() ?>
			</div>
			<!-- /Campi blu -->

			<!-- Campi rosa -->
			<?php ModalInstructions::start( _("Valutare la presenza di eventuali esperienze professionali aggiuntive che attestino una conoscenza dell'esperto nelle materie del percorso di aggiornamento professionale del progetto Io Conto") ) ?>
				<div class="card-panel">
					<p><?php _e("Ulteriori qualifiche professionali (ad esempio patente europea del computer)") ?></p>
					<p>
						<input name="<?php echo Curriculum::ECDL ?>" type="checkbox" id="computer" value="1"<?php $curriculum and _checked( $curriculum->get(Curriculum::ECDL), true ) ?> />
						<label for="computer"><?php _e("Hai la patente europea del computer?") ?></label>
					</p>
					<p>
						<input name="<?php echo Curriculum::EXTRALANGUAGE ?>" type="checkbox" id="languages" value="1"<?php $curriculum and _checked( $curriculum->get(Curriculum::EXTRALANGUAGE), true ) ?> />
						<label for="languages"><?php _e("Hai la conoscenza di una lingua straniera?") ?></label>
					</p>
				</div>
				<div class="card-panel">
					<p><?php _e("hai partecipato alla prima edizione del progetto Io conto in qualità di esperto?") ?></p>
					<p>
						<input name="<?php echo Curriculum::EXPERT ?>" type="radio" id="collaborated_yes" value="1"<?php $curriculum and _checked( $curriculum->get(Curriculum::EXPERT), true ) ?> />
						<label for="collaborated_yes"><?php _e("Sì") ?></label>
					</p>
					<p>
						<input name="<?php echo Curriculum::EXPERT ?>" type="radio" id="collaborated_no" value="0"<?php $curriculum and _checked( $curriculum->get(Curriculum::EXPERT), false ) ?> />
						<label for="collaborated_no"><?php _e("No") ?></label>
					</p>
				</div>
			<?php ModalInstructions::end() ?>

			<div class="row">
				<?php $label( _("Ulteriori esperienze") ) ?>
				<?php $container_start() ?>
					<p><?php ModalInstructions::open() ?></p>
				<?php $container_end() ?>
			</div>
			<!-- /Campi rosa 2 -->
		</div>

		<div class="row">
			<div class="col s12 m6">
				<p><?php _e("Compilando e salvando il questionario Autorizzo espressamente il trattamento dei miei dati personali ai sensi del Decreto Legislativo 30 giugno 2003, n. 196 \"Codice in materia di protezione dei dati personali\" per la selezione per Esperto Formatore del progetto Io conto seconda edizione.") ?></p>
			</div>
			<div class="col s12 m6 input-field">
				<button type="submit" class="btn waves-effect light-blue darken-1"><?php _e("Salva tutto") ?><?php echo m_icon() ?></button>
			</div>
		</div>
	</form>

<script>
/**
 * Modal fix
 */
var updateGUI = function () {
	$('select').not('.model-container select').material_select();
};
$_modelViewControllerAdded = updateGUI;

function update_form_percentage() {
	var $texts      = $('input[type=text]:not(.select-dropdown)');
	var $radios     = $('input[type=radio]');
	//var $checkboxes = $('input[type=checkbox]');
	var $selects    = $('select');

	var radio_names = {};
	$radios.each( function () {
		radio_names[ $(this).attr('name') ] = 1;
	} );

	console.log(radio_names);

	var n_radios = Object.keys(radio_names).length;

	var sum = $texts.length + n_radios + $selects.length;

	var $texts_ok = $texts.filter( function () {
		return $(this).val().length > 0;
	} );
	var $radios_ok     = $radios.filter(':checked');
	//var $checkboxes_ok = $checkboxes.filter(':checked');
	var $selects_ok    = $selects.filter( function () {
		return $(this).val().length < 15;
	} );

	var sum_ok = $texts_ok.length + $radios_ok.length + $selects_ok.length;

	var v = Math.floor( sum_ok / sum * 100 );

	console.log($texts.length);
	console.log($texts_ok.length);

	console.log(n_radios);
	console.log($radios_ok.length);

	console.log($selects.length);
	console.log($selects_ok.length);

	console.log(sum);
	console.log(sum_ok);

	$('.form-percentage').html(v);
}

$(document).ready( function () {
	updateGUI();
	$('.modal').modal();
	$('.modal').append(
		'<button class="modal-close btn-flat" style="position:absolute;top:0;right:0;">X</button>'
	);

	update_form_percentage();
	$('input').change(update_form_percentage);
	$('select').change(update_form_percentage);
} );
</script>


<?php
Footer::spawn();
