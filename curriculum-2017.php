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

Header::spawn('curriculum-2017', [
	'toolbar-upload' => true
] );

$curriculum = Curriculum::factoryByOrganico()
	->queryRow();

if( $curriculum && $curriculum->isCurriculumFinalized() ) {
	MessageBox::spawn( _("Curriculum già inviato.") );
	Footer::spawn();
	exit;
}

if( ! empty( $_POST )  ) {

	$fields = [
		Curriculum::SURNAME => 's',
		Curriculum::NAME => 's',
		Curriculum::CITY => 's',
		Curriculum::CAP => 's',
		Curriculum::PHONE => 's',
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
		Curriculum::NATIONAL_TASK => 's',
		Curriculum::NATIONAL_TASK_DESC => 's',
		Curriculum::ECDL => 'd',
		Curriculum::EXPERT => 'd',
		Curriculum::FINALIZED => 'd'
	];
	$dbfields = [];
	foreach($fields as $field => $type) {
		$v = @ $_POST[$field];
		$v = luser_input($v, 1500);
		$dbfields[] = new DBCol($field, $v, $type);
	}

	if( $curriculum ) {
		$curriculum->updateCurriculum($dbfields);
	} else {
		Curriculum::insert($dbfields);
	}

	$labelled_fields = CurriculumFields::get();

	$curriculum = Curriculum::factoryByOrganico()
		->queryRow();

	$human_fields = '';
	foreach($labelled_fields as $labelled_field) {
		if($human_fields) {
			$human_fields .= "\n\n ";
		}
		$human_fields .= sprintf(
			"%s:\n ".
			"%s",
			$labelled_field->getTitle(),
			$labelled_field->getHumanValue( $curriculum )
		);
	}

	$what = $curriculum ? _("aggiornato") : _("salvato");
	if( $curriculum->isCurriculumFinalized() ) {
		$what = _("finalizzato");
	}

	Email::send(
		get_user()->getUserEmail(),
		sprintf(
			_("Curriculum %s"),
			$what
		),
		sprintf(
			_(
				"Con la presente per informarla che ha %s con successo il suo curriculum.\n ".
				"Campi del curriculum:\n\n ".
				"%s\n\n ".
				"Torna al curriculum:\n ".
				"%s"
			),
			$what,
			$human_fields,
			menu_url('curriculum-2017')
		)
	);
}

if( $curriculum && $curriculum->isCurriculumFinalized() ) {
	MessageBox::spawn( _("Procedura conclusa con successo. Il curriculum sarà validato.") );
	Footer::spawn();
	exit;
}

$heading = function ($s) {
	printf("<p class='flow-text'>%s</p>\n", $s);
};
$label = function ($s) {
	printf("<div class='input-field col s12 m2'><p>%s<br /><span class=\"small-progress-counter\"></span></p></div>\n", $s);
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
		<p><?php _e("Ricordati di compilare tutti i campi (sotto ogni modulo deve apparire il simbolo <em>100%</em> verde, altrimenti non sarà possibile finalizzare ed inviare il curriculum).") ?></p>
	</div>
	<?php endif ?>
	<form method="post">

		<!-- Informazioni personali -->
		<div class="card-panel">
			<?php $heading( _("Informazioni personali") ) ?>
			<p><?php _e("Informazioni basilari da compilare prima di procedere con il questionario vero e proprio.") ?></p>

			<?php Modal::start() ?>
				<div class="card-panel">
					<?php $fields = ['SURNAME', 'NAME', 'CAP', 'CITY', 'PHONE'] ?>
					<?php foreach($fields as $field): ?>
						<?php $const_value = constant("Curriculum::$field"); ?>
						<p class="input-field"><?php InputText::spawn(
							Curriculum::{$field}(),
							$const_value,
							$curriculum ? $curriculum->get($const_value) : null
						) ?></p>
					<?php endforeach ?>
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
			<p><?php printf(
				_("Si ricorda che è obbligatorio inserire tutti i campi di testo che sono limitati a %d caratteri."),
				1500
			) ?></p>

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

			<?php ModalInstructions::start( _("Valutare il livello di preparazione dell'esperto considerando il suo percorso accademico e formativo") ) ?>

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
						<p><?php _e("N. corsi di formazione seguiti in qualità di discente su tematiche attinenti alle materie amministrativo contabili (Bilancio, obblighi normativi, acquisizione di beni e servizi).") ?></p>
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
						<p><?php _e("N. pubblicazioni su tematiche attinenti alle materie del percorso di aggiornamento professionale Io Conto.") ?></p>
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

					<div class="card-panel">
						<p><?php _e("La patente europea del computer garantisce la conoscenza degli strumenti informatici utilizzati nel progetto Io Conto.") ?></p>
						<p><?php _e("Sei in possesso della patente europea?") ?></p>
						<p>
							<input name="<?php echo Curriculum::ECDL ?>" type="radio" id="ecdl_yes" value="1"<?php $curriculum and _checked( $curriculum->get(Curriculum::ECDL), true ) ?> />
							<label for="ecdl_yes"><?php _e("Sì") ?></label>
						</p>
						<p>
							<input name="<?php echo Curriculum::ECDL ?>" type="radio" id="ecdl_no" value="0"<?php $curriculum and _checked( $curriculum->get(Curriculum::ECDL), false ) ?> />
							<label for="ecdl_no"><?php _e("No") ?></label>
						</p>
					</div>

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

				<div class="card-panel">
					<p><?php _e("Aver partecipato alla prima edizione del progetto Io Conto in qualità di esperto formatore garantisce una consolidata conoscenza delle materie amministrativo-contabili.") ?></p>
					<p><?php _e("Hai partecipato alla prima edizione del progetto Io Conto in qualità di esperto formatore?") ?></p>
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
					<p><?php _e("Appartenenza a gruppi di lavoro istituzionali regionali e/o centrali, cabine di regia, comitati paritetici (indicare nome ed estremi).") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::REGIONAL_TASK, $curriculum ? $curriculum->get(Curriculum::REGIONAL_TASK) : null, Curriculum::REGIONAL_TASK() ) ?>
					</div>
					<div class="input-field">
						<?php Textarea::spawn( _("Dettaglia"), Curriculum::REGIONAL_TASK_DESC, $curriculum ? $curriculum->get(Curriculum::REGIONAL_TASK_DESC) : null ) ?>
					</div>
				</div>

				<div class="card-panel">
					<p><?php _e("Incarichi di reggenza presso Istituzioni scolastiche statali") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, Curriculum::NATIONAL_TASK, $curriculum ? $curriculum->get(Curriculum::NATIONAL_TASK) : null, Curriculum::NATIONAL_TASK() ) ?>
					</div>
					<div class="input-field">
						<?php Textarea::spawn( _("Dettaglia"), Curriculum::NATIONAL_TASK_DESC, $curriculum ? $curriculum->get(Curriculum::NATIONAL_TASK_DESC) : null ) ?>
					</div>
				</div>
			<?php ModalInstructions::end() ?>

			<div class="row">
				<?php $label( _("Collaborazioni con Amm. centrale, UUSSRR e istituzioni scolastiche") ) ?>
				<?php $container_start() ?>
					<p><?php ModalInstructions::open() ?></p>
				<?php $container_end() ?>
			</div>
			<!-- /Campi blu -->
		</div>

		<div class="row">
			<div class="col s12 m6">
				<p><?php _e("Compilando e salvando il questionario Autorizzo espressamente il trattamento dei miei dati personali ai sensi del Decreto Legislativo 30 giugno 2003, n. 196 \"Codice in materia di protezione dei dati personali\" per la selezione per Esperto Formatore del progetto Io conto seconda edizione.") ?></p>
			</div>
			<div class="col s12 m6 input-field">
				<button type="submit" class="btn waves-effect light-blue darken-1"><?php _e("Salva") ?><?php echo m_icon() ?></button>
			</div>
			<div class="col s12 m6 input-field">
				<button type="button" class="btn waves-effect yellow black-text finalize"><?php _e("Finalizza") ?><?php echo m_icon('close') ?></button>
			</div>
		</div>


		<div id="are-you-sure" class="modal">
			<div class="modal-content">
				<h4><?php _e("Invio definitivo") ?></h4>
				<p class="flow-text"><?php _e(
					"Attenzione! Stai per inviare la tua candidatura alla selezione per esperto formatore del progetto io conto seconda edizione. ".
					"Proseguendo <strong>non sarà più possibile</strong> modificare il curriculum e la candidatura risulterà acquisita per la successiva selezione."
				) ?></p>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><?php _e("No, indietro") ?></a>
				<button type="submit" class="btn waves-effect yellow black-text modal-action" name="<?php echo Curriculum::FINALIZED ?>" value="1"><?php _e("Sì, conferma") ?></a>
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
	var $textareas  = $('textarea');
	var $texts      = $('input[type=text]:not(.select-dropdown)');
	var $radios     = $('input[type=radio]');
	//var $checkboxes = $('input[type=checkbox]');
	var $selects    = $('select');

	var radio_names = {};
	$radios.each( function () {
		radio_names[ $(this).attr('name') ] = 1;
	} );

	var n_radios = Object.keys(radio_names).length;

	var sum = $texts.length + n_radios + $selects.length + $textareas.length;

	var $textareas_ok = $textareas.filter( function () {
		return $(this).val().length > 0;
	} );
	var $texts_ok = $texts.filter( function () {
		return $(this).val().length > 0;
	} );
	var $radios_ok     = $radios.filter(':checked');
	//var $checkboxes_ok = $checkboxes.filter(':checked');
	var $selects_ok    = $selects.filter( function () {
		return $(this).val().length < 15;
	} );

	var sum_ok = $texts_ok.length + $radios_ok.length + $selects_ok.length + $textareas_ok.length;

	var v = Math.floor( sum_ok / sum * 100 );

	var $smallCounters = $('.small-progress-counter');
	$smallCounters.each( function () {
		var $a = $(this).closest('.row');
		var href = $a.find('a').attr('href');
		var $modal = $(href);

		var textareas    = 0;
		var textareas_ok = 0;

		function countChild($selector) {
			var n = 0;
			$selector.each( function () {
				var is = $.contains($modal[0], $(this)[0] );
				if(is) {
					n++;
				}
			} );
			return n;
		}

		var radio_names_child = {};
		$modal.find($radios).each( function () {
			radio_names_child[ $(this).attr('name') ] = 1;
		} );

		console.log("child fields " + href);
		textareas    = countChild($textareas);
		textareas_ok = countChild($textareas_ok);
		texts        = countChild($texts);
		texts_ok     = countChild($texts_ok);
		radios       = Object.keys(radio_names_child).length;
		radios_ok    = countChild($radios_ok);
		selects      = countChild($selects);
		selects_ok   = countChild($selects_ok);
		console.log(textareas);
		console.log(textareas_ok);
		console.log(texts);
		console.log(texts_ok);
		console.log(radios);
		console.log(radios_ok);
		console.log(selects);
		console.log(selects_ok);
		console.log("/child fields");

		var sum_child    = textareas    + texts    + radios    + selects;
		var sum_child_ok = textareas_ok + texts_ok + radios_ok + selects_ok;

		var sum_percentage_child = Math.floor( sum_child_ok / sum_child * 100 );

		var color = sum_percentage_child >= 100 ? 'green' : 'yellow';
		$(this).html( $("<span>").addClass(color).html(sum_percentage_child + "%") );
	} );

	console.log("fields");
	console.log($textareas.length);
	console.log($textareas_ok.length);

	console.log($texts.length);
	console.log($texts_ok.length);

	console.log(n_radios);
	console.log($radios_ok.length);

	console.log($selects.length);
	console.log($selects_ok.length);

	console.log(sum);
	console.log(sum_ok);
	console.log("/fields");

	window.formPercentage = v;

	$('.form-percentage').html(v);

	<?php if( $curriculum && $curriculum->isCurriculumFinalized() ): ?>
		$('.form-percentage').parent().hide();
	<?php endif ?>
}

$(document).ready( function () {
	$('.form-percentage-parent').show();

	updateGUI();
	$('.modal').modal();
	$('.modal').append(
		'<button class="modal-close btn-flat" style="position:absolute;top:0;right:0;">X</button>'
	);

	update_form_percentage();
	$('input').change(update_form_percentage);
	$('select').change(update_form_percentage);
	$('textarea').change(update_form_percentage);

	$('button.finalize').click( function (event) {
		if( window.formPercentage < 100 ) {
			Materialize.toast('<?php _e("Completa tutti i campi.") ?>', 4000);
			event.preventDefault();
		} else {
			$("#are-you-sure").modal('open');
		}
	} );
} );
</script>


<?php
Footer::spawn();
