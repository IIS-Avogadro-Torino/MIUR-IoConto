<?php
# Formazione MIUR content management system
# Copyright (C) 2015 Valerio Bozzolan
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published
# by the Free Software Foundation, either version 3 of the License,
# or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

class_exists('HTML');

class InputField {

	/**
	 * @param string $type Input type
	 * @param string $name Input name and Input ID
	 * @param string $label Label text
	 * @param string $value Default value
	 * @param string $icon Material Design icon from https://material.io/icons/
	 * @param string $input_intag Custom input properties
	 */
	static function spawn($type, $name, $label, $value, $icon, $input_intag = null) { ?>
		<div class="col s12 m6 input-field">
			<?php echo m_icon($icon, 'prefix') ?>
			<?php echo Form::input($type, $name, $value,
				HTML::property('id', "inputfield_$name") .
				HTML::property('class', 'validate') .
				HTML::spaced($input_intag)
			) ?>
			<?php echo Form::label("inputfield_$name", $label) ?>
		</div>
<?php } }
