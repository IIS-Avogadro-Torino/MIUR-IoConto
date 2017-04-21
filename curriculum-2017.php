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

Header::factory('curriculum-2017');

?>

	<div class="card-panel">
		<p class="flow-text"><?php printf(
			_("Sei autenticato come <b>%s</b>."),
			// $scuola->getScuolaMeccanografico()
			"Anonimo"
		) ?></p>
	</div>

	<form method="post">
		<!-- esperienza professionale -->
		<div class="card-panel">
			<?php H::_3( _("Esperienza professionale") ) ?>
			<div class="row">
				<div class="col s12 l6 input-field">
					<?php
					$options = [];
					for($i = 5; $i<16; $i += 5) {
						$options[$i] = sprintf( _("Ho %d (o meno) anni di esperienza"), $i);
					}
					InputSelect::spawn(InputSelect::SINGLE, 'experience_years', null, $options);
					?>
				</div>
			</div>
		</div>
		<!-- / esperienza professionale -->

		<!-- titolo di studio -->
		<div class="card-panel model-view-container">
			<?php H::_3( _("Titolo di studio") ) ?>
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

			<div class="row view-container"></div>
			<div class="row">
				<div class="col s12">
					<?php ModelView::add() ?>
				</div>
			</div>
		</div>
		<!-- / titolo di studio -->

		<!-- corsi seguiti -->
		<div class="card-panel">
			<?php H::_3( _("Corsi di formazione seguiti") ) ?>
			<div class="row">
				<div class="col s12 l6 input-field">
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
		</div>
		<!-- / corsi seguiti -->

		<!-- pubblicazioni -->
		<div class="card-panel model-view-container">
			<?php H::_3( _("Pubblicazioni") ) ?>

			<?php Modal::start() ?>

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

				<div class="row view-container"></div>
				<p><?php ModelView::add() ?></p>
				<p><?php Modal::close() ?></p>

			<?php Modal::end() ?>

			<?php Modal::open() ?>

		</div>
		<!-- / pubblicazioni -->

		<p>
			<button type="submit" class="btn waves-effect"><?php _e("Salva") ?><?php echo m_icon() ?></button>
		</p>
	</form>

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

<?php

Footer::factory();
