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
?>

<div class="row">
	<!-- left -->
	<aside class="col s3 l2 light-blue darken-1">
		<div class="section">
			<div id="logo"><img class="responsive-img" src="<?php echo IMAGE_URL ?>/formazione-MIUR-Io-Conto-logo-landscape.png"></div>
				<div class="">
					<img class="responsive-img ioconto-img" src="<?php echo IMAGE_URL ?>/formazione-MIUR-Io-Conto.png" />
				</div>
				<p class="flow-text red-text white expand">Curriculum Vitae</p>
				<footer class="menu-laterale">
				<ul class="menu" class="browser-default">
					<li><a class="white-text" href="index.html">Home</a></li>
					<li><a class="white-text" href="#">Il progetto</a></li>
					<li><a class="white-text" href="#">Istruzioni</a></li>
					<li><a class="white-text" href="#">Vai a Io Conto</a></li>
					<li><a class="white-text" href="#">Esempi</a></li>
					<li><a class="white-text" href="#">Area riservata</a></li>
					<li><a class="white-text" href="#">News</a></li>
				</ul>
			</footer>
		</div>
	</aside>
	<!-- /left -->

	<!-- main -->
	<section class="col s6 l8">
		<form method="post">
			<div class="row">
				<div class="input-field col s2">
					<label for="informazioni_personali">Informazioni personali</label>
				</div>
				<div class="input-field col s9 push-s1">
					<input placeholder="Informazioni personali" id="informazioni-personali" type="text" class="validate">
					<p class="valign-wrapper compila"><?php Modal::open() ?></p>
				</div>
			 
			</div>
			<div class="row">
				<div class="input-field col s2">
					<label for="experience_years"><?php _e("Esperienza Professionale") ?></label>
				</div>
				<div class="input-field col s9 push-s1">
					<?php
					$options = [];
					for($i = 5; $i<16; $i += 5) {
						$options[$i] = sprintf( _("Ho %d (o meno) anni di esperienza"), $i);
					}
					InputSelect::spawn(InputSelect::SINGLE, 'experience_years', null, $options);
					?>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s2"> <label for="first_name">Conoscenze di base</label></div>
				<div class="input-field col s9 push-s1"><input placeholder="Conoscenze di base" id="first_name" type="text" class="validate">
				 <p class="valign-wrapper compila"><?php Modal::open() ?></div>
			</div>
			<div class="row">
				<div class="input-field col s2"> <label for="first_name">Conoscenze specifiche</label></div>
				<div class="input-field col s9 push-s1"><input placeholder="Conoscenze specifiche" id="first_name" type="text" class="validate">
				 <p class="valign-wrapper compila"><?php Modal::open() ?></div>
			</div>
		
			<div class="row">
				<div class="input-field col s2"> <label for="first_name">Esperienza in qualità di docente</label></div>
				<div class="input-field col s9 push-s1"><input placeholder="Esperienza in qualità di docente" id="first_name" type="text" class="validate">
				<p class="valign-wrapper compila"><?php Modal::open() ?></p>
			</div>
			<div class="row">
				<div class="input-field col s2"> <label for="first_name">Collaborazioni con USR e Istituzioni Scolastiche</label></div>
				<div class="input-field col s9 push-s1"><input placeholder="Collaborazioni con USR e Istituzioni Scolastiche" id="first_name" type="text" class="validate">
				<p class="valign-wrapper compila"><?php Modal::open() ?></div>
			</div>

			<div class="row">
				<div class="input-field col s2"><label><?php _e("Titoli di studio") ?></label></div>
				<div class="input-field col s9 push-s1 model-view-container">
					<?php Modal::start() ?>
						<div class="row view-container"></div>
						<p><?php ModelView::add() ?></p>
						<p><?php Modal::close() ?></p>
					<?php Modal::end() ?>

					<?php ModelView::model() ?>
						<?php $study = function ($level = null, $school = null) { ?>
						<div class="col s12 m6">
							<div class="card-panel">
								<div class="row">
									<div class="col s11 input-field">
										<?php InputSelect::spawn(InputSelect::SINGLE, 'studies[][level]', $level, [
											'degree-1' => _("Laurea triennale"),
											'degree-2' => _("Laurea magistrale / V.O / specialistica"),
											'master-1' => _("Master di I livello"),
											'master-2' => _("Master di II livello (o biennale)"),
											'degree-3' => _("Dottorato / seconda laurea")
										] ) ?>
									</div>
									<div class="col s1">
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

					<p><?php Modal::open() ?></p>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s2">
					<label><?php _e("Corsi seguiti") ?></label>
				</div>
				<div class="input-field col s9 push-s1">
					<?php InputSelect::spawn(InputSelect::SINGLE, 'studies', null, [
						'0'   => _("Nessun corso"),
						'1-2' => _("meno di tre corsi"),
						'3-4' => _("meno di cinque corsi"),
						'5-6' => _("meno di sei corsi"),
						'6+'  => _("sei corsi, o più"),
						'10+' => _("dieci corsi, o più")
					] ) ?>
				</div>
			</div>
			<!-- / corsi seguiti -->

			<div class="row">
				<div class="input-field col s2">
					<label><?php _e("Pubblicazioni") ?></label>
				</div>
				<div class="input-field col s9 push-s1">
					<p><?php Modal::open() ?></p>
					<?php Modal::start() ?>
						<div class="row view-container"></div>
						<p><?php ModelView::add() ?></p>
						<p><?php Modal::close() ?></p>

						<?php ModelView::model() ?>
							<?php $pubblicazione = function($title = null, $year = null, $author = null, $published = null, $isbn = null) { ?>
							<div class="col s12 m6">
								<div class="card-panel">
									<div class="row">
										<div class="col s11">
											<?php InputText::spawn(_("Titolo della pubblicazione"), 'publication[][title]', $title) ?>
										</div>
										<div class="col s1">
											<?php ModelView::remove() ?>
										</div>
									</div>
									<div class="row">
										<div class="col s12 m6">
											<?php InputText::spawn( _("Autore"), 'publication[][author]', $author) ?>
										</div>
										<div class="col s12 m6">
											<?php InputYear::spawn( _("Anno di pubblicazione"), 'publication[][year]', $year) ?>
										</div>
									</div>
									<div class="row">
										<div class="col s12 m6">
											<?php InputText::spawn( _("Editore"), 'publication[][published]', $published) ?>
										</div>
										<div class="col s12 m6">
											<?php InputISBN::spawn('publication[][isbn]', $isbn) ?>
										</div>
									</div>
								</div>
							</div>
							<?php }; ?>
							<?php $pubblicazione() ?>
						<?php ModelView::endmodel() ?>
					<?php Modal::end() ?>
				</div>
				<!-- / pubblicazioni -->
			</div>

			<p>
				<button type="submit" class="btn waves-effect light-blue darken-1"><?php _e("Salva tutto") ?><?php echo m_icon() ?></button>
			</p>

			<script>
			function updateGUI () {
				$('select').not('.model-container select').material_select();
			}

			$(document).ready( function () {
				updateGUI();
				$('.modal').modal();

			} );
			$_modelViewControllerAdded = updateGUI;
			</script>

		</form>

	</section>
	<!-- main -->

	<!-- right -->
	<aside class="col s3 l2">
		<section>
			<p><a href="#" class="btn waves-effect light-blue darken-1">Importare <?php echo m_icon('cloud_upload') ?></a></p>
			<p class="flow-text">Campi Complementari</p>
			<p><a class="btn-floating btn waves-effect waves-light red"><?php echo m_icon('photo_camera') ?></a> Foto</p>
			<p><a href="#" class="btn waves-effect yellow black-text">Anteprima <?php echo m_icon('spellcheck') ?></a></p>
			<p><a href="#" class="btn waves-effect red">Scarica <?php echo m_icon('file_download') ?></a></p>
		</section>
	</aside>
	<!-- right -->

</div>
<!-- /row -->

<script>
	/**
	 * Sidebar animation
	 */
	$(document).ready( function () {
		var $aside = $('aside');
		$aside.css('transition', 'padding-top 1s ease')
		      .css('min-height', $(document).height() + 'px');
		$aside.parent()
			  .css('margin-bottom', 0);
		var timeout;
		$(window).scroll( function () {
			timeout && window.clearTimeout(timeout);
			timeout = setTimeout( function () {
				$aside.css('padding-top', window.pageYOffset + 'px')
			}, 200 );
		} );
	} );
</script>


<?php

Footer::factory([
	'footer' => false
]);
