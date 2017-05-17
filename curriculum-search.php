<?php
# Formazione MIUR content management system
# Copyright (C) 2017 Ivan Bertotto, Valerio Bozzolan, ITIS Avogadro
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

required_permission('see-all-curriculums');

Header::spawn('curriculum-search');

$searched = isset( $_POST['name'] )
        ||  isset( $_POST['surname'] );

$curriculums = [];

if($searched) {
	$searched = true;

	$name    = luser_input( $_POST['name'],    64 );
	$surname = luser_input( $_POST['surname'], 64 );

	$curriculums = Curriculum::factory();
	if( $name ) {
		$name_esc = esc_sql_like($name);
		$curriculums->where( sprintf(
			"%s LIKE '%s'",
			Curriculum::NAME,
			"%$name_esc%"
		) );
	}
	if( $surname ) {
		$surname_esc = esc_sql_like($surname);
		$curriculums->where( sprintf(
			"%s LIKE '%s'",
			Curriculum::SURNAME,
			"%$surname_esc%"
		) );
	}

	$curriculums = $curriculums
		->limit(100)
		->queryResults();
}
?>


<div class="card-panel">
	<p class="flow-text"><?php _e("Inserisci parte del nome o del cognome.") ?></p>
	<div class="row">
		<form method="post">
			<div class="col s12 m6 input-field">
				<input type="text" name="name" id="name" />
				<label for="name"><?php _e("Nome") ?></label>
			</div>
			<div class="col s12 m6 input-field">
				<input type="text" name="surname" id="surname" />
				<label for="surname"><?php _e("Cognome") ?></label>
			</div>
			<div class="col s12 m6 input-field">
				<button type="submit" class="btn waves-effect light-blue darken-1"><?php _e("Cerca"); echo m_icon('search'); ?></button>
			</div>
		</form>
	</div>
</div>

<div class="card-panel">
	<?php if($searched): ?>
		<?php if($curriculums): ?>
			<p><?php _e("Risultati trovati:") ?></p>
			<table class="responsive-table">
				<?php foreach($curriculums as $curriculum): ?>
					<?php
					$name      = esc_html($name);
					$surname   = esc_html($surname);

					$c_name    = $curriculum->get(Curriculum::NAME);
					$c_surname = $curriculum->get(Curriculum::SURNAME);

					$c_name    = esc_html($c_name);
					$c_surname = esc_html($c_surname);

					$c_name    = enfatize_substr($c_name,    $name);
					$c_surname = enfatize_substr($c_surname, $surname);
					?>
					<tr>
						<td><?php echo $c_name ?></td>
						<td><?php echo $c_surname ?></td>
						<td><a href="<?php echo $curriculum->getCurriculumPDFURL() ?>" class="btn waves-effect light-blue darken-1" target="_blank"><?php
							_e("PDF");
							echo m_icon('file_download');
						?></a></td>
					</tr>
				<?php endforeach ?>
			</table>
		<?php else: ?>
			<?php MessageBox::spawn( _("La ricerca non ha prodotto risultati"), MessageBox::WARNING ) ?>
		<?php endif ?>

	<?php else: ?>
		<?php
		$n = Curriculum::factory()
			->select('COUNT(*) as count')
			->queryValue('count');
		?>
		<p class="flow-text"><?php printf(
			_("In questo momento ci sono %s curriculum."),
			"<strong>$n</strong>"
		) ?></p>
	<?php endif ?>
</div>

<?php
Footer::spawn();
