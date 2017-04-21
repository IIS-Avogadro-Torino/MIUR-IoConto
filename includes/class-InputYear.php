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

class InputYear {

	/**
	 * @param $title string Placeholder
	 * @param $name string Input name
	 * @param $value string Input value
	 */
	static function spawn($title, $name, $value) {
		$y = (int) date('Y');
		?>
		<input type="number" name="<?php echo $name ?>" min="<?php echo $y - 150 ?>" max="<?php echo $y ?>" placeholder="<?php _esc_attr($title) ?>" value="<?php $value and _esc_attr($value) ?>" class="validate" />
		<?php
	}
}
