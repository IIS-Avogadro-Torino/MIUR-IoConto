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

class InputText {

	const TEXT = 'text';
	const EMAIL = 'email';

	static $id = 0;

	static function id() {
		printf("input-text-%d", self::$id);
	}

	/**
	 * @param $title string Placeholder
	 * @param $name string Input name
	 * @param $value string Input value
	 */
	static function spawn($title, $name, $value = '', $type = null, $other='') {
		self::$id++;
		if(! $type ) {
			$type = self::TEXT;
		}
		if($other) {
			$other = " $other";
		}
		?>
		<input type="<?php echo $type ?>" name="<?php echo $name ?>" value="<?php _esc_attr($value) ?>" class="validate" id="<?php self::id() ?>"<?php echo $other ?> />
		<label for="<?php self::id() ?>"><?php _esc_attr($title) ?></label>
		<?php
	}
}
