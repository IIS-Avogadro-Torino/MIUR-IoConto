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

class InputSelect {
	const SINGLE   = 'single';
	const MULTIPLE = 'multiple';

	/**
	 * @param $title string self::SINGLE or self::MULTIPLE
	 * @param $value string|null
	 * @param $options array [ $option_value => $title ]
	 */
	static function spawn($type, $name, $value, $options = [] ) {
		?>
		<select name="<?php echo $name ?>" class="validate"<?php $type === self::MULTIPLE and printf(' multiple') ?>>
			<?php if($type === self::SINGLE): ?>
				<option disabled selected><?php _e("Scegli l'opzione più specifica") ?></option>
			<?php else: ?>
				<option disabled selected><?php _e("Seleziona tutte le opzioni corrispondenti") ?></option>
			<?php endif ?>

			<?php foreach($options as $option_value => $option_title): ?>
				<?php self::option($option_title, $option_value, $value) ?>
			<?php endforeach ?>
		</select>
		<?php
	}

	/**
	 * @param $option_title string
	 * @param $option_value string
	 * @param $value string
	 */
	private static function option($option_title, $option_value, $value = null) {
		?>
		<option value="<?php echo $option_value ?>"<?php _selected($option_value, $value) ?>><?php _esc_html($option_title) ?></option>
		<?php
	}
}
