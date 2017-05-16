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

/**
 * MaterializeCSS modal with some instructions on the right.
 *
 * @see http://materializecss.com/modals.html
 */
class ModalInstructions extends Modal {
	static $instructions;

	/**
	 * @param string $instructions
	 */
	static function start($instructions) {
		self::$instructions = $instructions;
		$i = parent::start(); ?>
			<div class="row">
				<div class="col s12">
					<blockquote>
						<?php _e("Scopo:") ?><br />
						<?php echo self::$instructions ?>
					</blockquote>
				</div>
				<div class="col s12">
		<?php
		return $i;
	}

	static function end() { ?>
					<p><?php parent::close() ?></p>
				</div>
			</div>
		<?php parent::end();
	}
}
