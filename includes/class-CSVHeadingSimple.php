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

class CSVHeadingSimple extends CSVHeading {
	var $constName;

	function __construct($is_countable, $is_multiple, $is_long_description, $const_name, $title = null, $callback_value = null ) {
		$this->constName = $const_name;

		if(! $callback_value && $is_countable && $is_multiple) {
			$callback_value = function () {
				return call_user_func( $this->constName );
			};
		}

		parent::__construct(
			$is_countable,
			$is_multiple,
			$is_long_description,
			$title ? $title : call_user_func( $const_name ),
			constant($const_name),
			$callback_value
		);
	}
}
