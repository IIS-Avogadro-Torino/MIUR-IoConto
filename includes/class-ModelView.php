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

class ModelView {
	static function enqueue() {
		enqueue_js('model-view-controller');
	}

	static function model() {
		echo '<div class="model-container">';
	}

	static function endmodel() {
		echo "</div>";
	}

	static function remove() { ?>
		<button class="view-remove btn-floating waves-effect red" type="button" title="<?php _e("Rimuovi") ?>"><?php echo m_icon('remove') ?></button>
	<?php }

	static function add($title = null, $icon = 'add') {
		$title = $title ? $title : _("Aggiungi");
		?>
		<button class="view-add btn waves-effect light-blue darken-1" type="button" title="<?php echo $title ?>"><?php echo $title . m_icon($icon) ?></button>
		<?php
	}
}
