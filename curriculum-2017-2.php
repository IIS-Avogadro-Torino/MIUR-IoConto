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

ModelView::enqueue();

// $scuola = get_scuola();

HeaderCurriculum::spawn('curriculum-2017', [
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
	<form method="post">

		<!-- Informazioni personali -->
		<div class="card-panel">
			<?php $heading( _("Informazioni personali") ) ?>
			<p><?php _e("Informazioni basilari da compilare prima di procedere con il questionario vero e proprio.") ?></p>

			<?php Modal::start() ?>
				<p><?php InputText::spawn( _("Nome"),            'name',    null ) ?></p>
				<p><?php InputText::spawn( _("Cognome"),         'surname', null ) ?></p>
				<p><?php InputText::spawn( _("Via e n° civico"), 'address', null ) ?></p>
				<p><?php InputText::spawn( _("CAP"), 'cap', null ) ?></p>
				<p><?php InputText::spawn( _("Città"), 'city', null ) ?></p>
				<p><?php InputText::spawn( _("Cellulare"), 'phone', null ) ?></p>
				<p><?php InputText::spawn( _("E-mail personale"), 'e-mail', null ) ?></p>
				<p><?php InputText::spawn( _("Sito web / blog"), 'blog', null ) ?></p>
				<p><?php InputText::spawn( _("Altri contatti"), 'others', null ) ?></p>
				<p><?php Modal::close() ?>
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
					$options = [
						'0-5'   => _("Anzianità > 15 anni"),
						'5-10'  => _("5 anni < anzianità <= 10 anni"),
						'10-15' => _("10 anni < anzianità <= 15 anni"),
						'15+'   => _("anzianità > 15")
					];
					InputSelect::spawn(InputSelect::SINGLE, 'experience_years', null, $options);
					?>
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
						<p>Titoli di studio</p>
						<div class="row">
							<div class="col s12 input-field">
								<?php InputSelect::spawn(InputSelect::SINGLE, 'study', null, [
									'degree-1' => _("Laurea triennale"),
									'degree-2' => _("Laurea magistrale / V.O / specialistica"),
									'master-1' => _("Master di I livello"),
									'master-2' => _("Master di II livello (o biennale)"),
									'degree-3' => _("Dottorato / seconda laurea")
								] ) ?>
							</div>
							<div class="col s12 input-field">
								<?php Textarea::spawn( _("Dettaglia il tuo percorso accademico"), 'studies_desc', null) ?>
							</div>
						</div>
					</div>
					<!-- /Titoli di studio section -->

					<!-- Corsi di formazione seguiti -->
					<div class="card-panel">
						<p><?php _e("N. corsi di formazione seguiti in qualità di discente su tematiche attinenti alle materie del percorso di aggiornamento professionale del progetto Io Conto") ?></p>
						<div class="input-field">
							<?php InputSelect::spawn(InputSelect::SINGLE, 'course_followed', null, [
								'0'   => _("Nessun corso"),
								'1-2' => _("0 < corsi <= 2"),
								'3-4' => _("2 < corsi <= 4"),
								'5-6' => _("4 < corsi <= 6"),
								'6+'  => _("corsi > 6"),
								'11+' => _("corsi > 10")
							] ) ?>
						</div>
						<div class="row">
							<div class="col s12">
								<div class="input-field">
								<?php Textarea::spawn( _("Inserisci più informazioni possibili a proposito di ognuno dei corsi seguiti"), 'course_followed_desc', null) ?>
								</div>
							</div>
						</div>
					</div>
					<!-- /Corsi di formazione seguiti -->

					<!-- Pubblicazioni -->
					<div class="card-panel model-view-container">
						<p><?php _e("N. pubblicazioni su tematiche attinenti alle materie del percorso di aggiornamento professionale Io Conto") ?></p>
						<div class="row">
							<div class="col s12 input-field">
								<?php InputSelect::spawn(InputSelect::SINGLE, 'publications[n]', null, [
									'0'   => _("Nessuna pubblicazione su articoli o riviste specializzate"),
									'1-3' => _("da uno a tre pubblicazioni"),
									'4-5' => _("meno di sei pubblicazioni"),
									'6+'  => _("sei pubblicazioni o più"),
								] ) ?>
							</div>
							<div class="col s12 input-field">
								<?php Textarea::spawn( _("Per ogni pubblicazione scrivi autore, anno di pubblicazione, editore, ISBN..."), 'publications[][desc]', null) ?>
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
					<p><?php _e("N. corsi di formazione organizzati e/o erogati in qualità di docente su tematiche attinenti alle materie del percorso di aggiornamento professionale del progetto Io Conto") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, 'course_erogated', null, [
							'0'   => _("Nessun corso"),
							'1-2' => _("0 < corsi <= 2"),
							'3-4' => _("2 < corsi <= 4"),
							'5-6' => _("4 < corsi <= 6"),
							'7+'  => _("corsi > 6")
						] ) ?>
					</div>
					<div class="row">
						<div class="col s12 input-field">
							<?php Textarea::spawn( _("Inserisci più informazioni possibili a proposito di ognuno dei corsi erogati"), 'course_erogated_desc', null) ?>
						</div>
					</div>
				</div>

				<div class="card-panel">
					<p><?php _e("N. corsi di formazione organizzati e/o erogati in qualità di docente su tematiche NON attinenti alle materie del percorso di aggiornamento professionale del progetto Io Conto") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, 'course_erogated', null, [
							'0'   => _("Nessun corso"),
							'1-2' => _("0 < corsi <= 2"),
							'3-4' => _("2 < corsi <= 4"),
							'5-6' => _("4 < corsi <= 6"),
							'7+'  => _("corsi > 6")
						] ) ?>
					</div>
					<div class="row">
						<div class="col s12 input-field">
							<?php Textarea::spawn( _("Dettaglia i corsi"), 'course_erogated_desc', null) ?>
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
						<?php InputSelect::spawn(InputSelect::SINGLE, 'urs_miur_tasks', null, [
							'3' => _("Incarichi (più di 5)"),
							'5' => _("Incarichi (fino a 3)")
						] ) ?>
					</div>
					<div class="input-field">
						<?php Textarea::spawn( _("Dettaglia gli incarichi"), 'urs_miur_tasks_desc', null) ?>
					</div>
				</div>

				<div class="card-panel">
					<p><?php _e("Appartenenza a gruppi di lavoro istituzionali regionali e/o centrali gruppo di lavoro, cabine di regia, comitati paritetici (indicare nome ed estremi)") ?></p>
					<div class="input-field">
						<?php InputSelect::spawn(InputSelect::SINGLE, 'general_tasks', null, [
							'3' => _("Gruppi di lavoro, tavoli tecnici ecc. Amministrazione centrale e/o periferica (più di 3)"),
							'5' => _("Incarichi reggenza (più di 5)"),
						] ) ?>
					</div>
					<div class="input-field">
						<?php Textarea::spawn( _("Dettaglia"), 'general_tasks_desc', null) ?>
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
						<input name="computer" type="checkbox" id="computer" />
						<label for="computer"><?php _e("Patente europea del computer") ?></label>
					</p>
					<p>
						<input name="languages" type="checkbox" id="languages" />
						<label for="languages"><?php _e("Corsi di lingua") ?></label>
					</p>
				</div>
				<div class="card-panel">
					<p><?php _e("Realizzazione di progetti o iniziative di innovazione organizzativa.") ?></p>
					<p>
						<input name="collaborated" type="radio" id="collaborated_yes" />
						<label for="collaborated_yes"><?php _e("Sì") ?></label>
					</p>
					<p>
						<input name="collaborated" type="radio" id="collaborated_no" />
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
				<p><?php _e("Compilando e salvando il questionario accetti il trattamento dei tuoi dati personali ai sensi della legge 196/03.") ?></p>
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

$(document).ready( function () {
	updateGUI();
	$('.modal').modal();
} );
</script>


<?php
FooterCurriculum::spawn();
