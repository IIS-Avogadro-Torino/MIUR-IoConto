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

Header::factory('curriculum-2017', [
	'user-navbar' => false,
	'container'   => false,
	'header'      => false
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

<div class="row">
	<!-- left -->
	<aside class="col s12 m3 l2 light-blue darken-1">
		<div>
			<img class="responsive-img" src="<?php echo IMAGE_URL ?>/formazione-MIUR-Io-Conto-logo-landscape.png" alt="logo Formazione MIUR" />
		</div>
		<div class="hide-on-small-only">
			<img class="responsive-img ioconto-img" src="<?php echo IMAGE_URL ?>/formazione-MIUR-Io-Conto.png" alt="logo Io Conto" />
		</div>
		<p class="flow-text red-text white expand">Curriculum Vitae</p>
		<footer class="hide-on-small-only">
			<ul>
				<li><a class="white-text" href="index.html">Home</a></li>
				<li><a class="white-text" href="#">Il progetto</a></li>
				<li><a class="white-text" href="#">Istruzioni</a></li>
				<li><a class="white-text" href="#">Vai a Io Conto</a></li>
				<li><a class="white-text" href="#">Esempi</a></li>
				<li><a class="white-text" href="#">Area riservata</a></li>
				<li><a class="white-text" href="#">News</a></li>
			</ul>
		</footer>
	</aside>
	<!-- /left -->

	<!-- main -->
	<div class="section col s12 m6 l8">
		<form method="post">

			<!-- Informazioni personali -->
			<div class="card-panel">
				<?php $heading( _("Informazioni personali") ) ?>
				<p><?php _e("Informazioni basilari da compilare prima di procedere con il questionario vero e proprio.") ?></p>

				<?php Modal::start() ?>
						<p><?php InputText::spawn( _("Nome"),            'name',    null ) ?></p>
						<p><?php InputText::spawn( _("Cognome"),         'surname', null ) ?></p>
						<p><?php InputText::spawn( _("Via e n° civico"), 'surname', null ) ?></p>
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
						$options = [];
						for($i = 5; $i<16; $i += 5) {
							$options[$i] = sprintf( _("Ho %d (o meno) anni di esperienza"), $i);
						}
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
						<div class="card-panel model-view-container">
							<p>Titoli di studio</p>
							<div class="row view-container"></div>
							<p><?php ModelView::add() ?></p>

							<?php ModelView::model() ?>
								<?php $study = function ($level = null, $school = null) { ?>
								<div class="col s12">
									<div class="card-panel">
										<div class="row">
											<div class="col s10 input-field">
												<?php InputSelect::spawn(InputSelect::SINGLE, 'studies[][level]', $level, [
													'degree-1' => _("Laurea triennale"),
													'degree-2' => _("Laurea magistrale / V.O / specialistica"),
													'master-1' => _("Master di I livello"),
													'master-2' => _("Master di II livello (o biennale)"),
													'degree-3' => _("Dottorato / seconda laurea")
												] ) ?>
											</div>
											<div class="col s2">
												<?php ModelView::remove() ?>
											</div>
										</div>
										<div class="row">
											<div class="col s12">
												<?php InputText::spawn( _("Nome istituto, Luogo"), 'studies[][school]', $school) ?>
											</div>
										</div>
									</div>
								</div>
								<?php }; ?>

								<?php $study() ?>
							<?php ModelView::endmodel() ?>
						</div>
						<!-- /Titoli di studio section -->

						<div class="divider"></div>

						<!-- Corsi di formazione seguiti -->
						<div class="card-panel">
							<p><?php _e("Corsi di formazione seguiti") ?></p>
							<p>
								<?php InputSelect::spawn(InputSelect::SINGLE, 'course_followed', null, [
									'0'   => _("Nessun corso"),
									'1-2' => _("meno di tre corsi"),
									'3-4' => _("meno di cinque corsi"),
									'5-6' => _("meno di sei corsi"),
									'6+'  => _("sei corsi, o più"),
									'10+' => _("dieci corsi, o più")
								] ) ?>
							</p>
						</div>
						<!-- /Corsi di formazione seguiti -->

						<!-- Pubblicazioni -->
						<div class="card-panel model-view-container">
							<p><?php _e("N. pubblicazioni su tematiche attinenti alle materie del percorso di aggiornamento professionale Io Conto") ?></p>
							<div class="row">
								<div class="col s12 m6 input-field">
									<?php InputSelect::spawn(InputSelect::SINGLE, 'publications[n]', null, [
										'0'   => _("Nessuna pubblicazione su articoli o riviste specializzate"),
										'1-3' => _("da uno a tre pubblicazioni"),
										'4-5' => _("meno di sei pubblicazioni"),
										'6+'  => _("sei pubblicazioni o più"),
									] ) ?>
								</div>
								<div class="col s12 m6 input-field">
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
						<p><?php _e("Corsi di formazione organizzati/erogati") ?></p>
						<div class="input-field">
							<?php InputSelect::spawn(InputSelect::SINGLE, 'course_erogated', null, [
								'0'   => _("Nessun corso"),
								'1-2' => _("meno di tre corsi"),
								'3-4' => _("meno di cinque corsi"),
								'5-6' => _("meno di sei corsi"),
								'6+'  => _("sei corsi, o più")
							] ) ?>
						</div>
					</div>
				<?php ModalInstructions::end() ?>

				<div class="row">
					<?php $label( _("Esperienza in qualità di docente") ) ?>
					<?php $container_start() ?>
						<p><?php ModalInstructions::open() ?></p>
					<?php $container_end() ?>
				</div>
			</div>

			<div class="row">
				<div class="col s12 m6">
					<p><?php _e(
						"Compilando e salvando il questionario accetti il trattamento dei tuoi dati personali ai sensi della legge 196/03."
					) ?></p>
				</div>
				<div class="col s12 m6 input-field">
					<button type="submit" class="btn waves-effect light-blue darken-1"><?php _e("Salva tutto") ?><?php echo m_icon() ?></button>
				</div>
			</div>
		</form>
	</div>
	<!-- main -->

	<!-- right -->
	<aside class="col hide-on-small-only m3 l2">
		<p><a href="#" class="btn waves-effect light-blue darken-1">Importare <?php echo m_icon('cloud_upload') ?></a></p>
		<p class="flow-text">Campi Complementari</p>
		<p><a class="btn-floating btn waves-effect waves-light red"><?php echo m_icon('photo_camera') ?></a> Foto</p>
		<p><a href="#" class="btn waves-effect yellow black-text">Anteprima <?php echo m_icon('spellcheck') ?></a></p>
		<p><a href="#" class="btn waves-effect red">Scarica <?php echo m_icon('file_download') ?></a></p>
	</aside>
	<!-- right -->

</div>
<!-- /row -->

<script>
/**
 * Modal fix
 */
var updateGUI = function () {
	$('select').not('.model-container select').material_select();
};
$_modelViewControllerAdded = updateGUI;

$(document).ready( function () {
	/**
	 * Sidebar animation
	 */
	var $aside = $('aside');
	$aside.css('transition', 'padding-top 1s ease');
	if( $(document).width() > 600 ) {
			$aside.css('min-height', $(document).height() + 'px');
			$aside.parent().css('margin-bottom', 0);
	}

	var timeout;
	$(window).scroll( function () {
		if( $(document).width() > 600 ) {
			timeout && window.clearTimeout(timeout);
			timeout = setTimeout( function () {
				$aside.css('padding-top', window.pageYOffset + 'px')
			}, 200 );
		} else {
			$aside.css('padding-top', 'inherit')
				.css('min-height', 0)
		}
	} );

	updateGUI();
	$('.modal').modal();
} );
</script>


<?php

Footer::factory([
	'footer' => false
]);
