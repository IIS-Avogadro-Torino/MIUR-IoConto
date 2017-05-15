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

class CSVHeading {
	var $isCountable;
	var $isLongDesc;
	var $multiple;

	function __construct($is_countable, $multiple, $is_long_desc, $title, $field, $callback_value = null, $callback_points = null) {
		$this->isCountable = $is_countable;
		$this->multiple    = $multiple;
		$this->isLongDesc  = $is_long_desc;
		$this->title = $title;
		$this->field = $field;
		$this->callbackValue = $callback_value;
		$this->callbackPoints = $callback_points;
	}

	function isLongDescription() {
		return $this->isLongDesc;
	}

	function isCountable() {
		return $this->isCountable;
	}

	function isMultiple() {
		return $this->multiple;
	}

	function getValue(Queried $obj) {
		return $obj->get( $this->field );
	}

	function getPoints($obj) {
		$value = $this->getValue($obj);

		if( ! $this->callbackPoints ) {
			return $value;
		}

		// Not a function, only a value assigned in case of a boolean value
		if( is_integer( $this->callbackPoints ) && is_bool($value) ) {
			return $value ? $this->callbackPoints : 0;
		}

		return $this->callbackPoints( $value );
	}

	function getHumanValue(Queried $obj) {
		$value = $this->getValue($obj);

		if( $this->callbackValue ) {
			// Return the select elements
			$values = is_string( $this->callbackValue )
				? call_user_func($this->callbackValue)
				: $this->callbackValue->__invoke();

			if( is_array( $values ) ) {
				// Set of labels
				if( isset( $values[$value] ) ) {
					return $values[$value];
				}
				return _("n.d.");
			} else {
				// It's only a label?
				return empty( $values ) ? _("n.d.") : $values;
			}
		}

		return empty( $value ) ? _("n.d.") : $value;
	}

	function getTitle() {
		return $this->title;
	}
}
