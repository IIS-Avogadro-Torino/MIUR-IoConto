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
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

function luser_float($v) {
	$v = str_replace(',', '.', trim( $v ) );
	$v = str_replace(' ', '', $v);
	if( strrpos($v, '.') !== false ) {
		return floatval($v);
	}
	$v = (int) $v;
	return "$v.0";
}

function m_icon($icon = null, $position = 'right', $title = null) {
	if($icon === null) {
		$icon = 'send';
	}
	$position = HTML::spaced($position);
	return HTML::tag('i', $icon,
		HTML::property('class', 'material-icons ' . $position) .
		HTML::property('title', $title)
	);
}

function collection($s) {
	echo "<li class=\"collection-item\">$s</li>\n";
}
function collection_icon($s, $icon = 'attach_file') {
	collection( HTML::tag('div',
		'<i class="material-icons">' . $icon . '</i> ' . $s
	) );
}

function get_codice_corso($uid, $progressivo) {
	return sprintf(
		_("%s%02d"),
		$uid,
		$progressivo
	);
}

function print_menu($uid = null, $level = 0, $args = array() ) {
	$args = merge_args_defaults($args, [
		'max-level' => 99
	] );
	if( $level > $args['max-level'] ) {
		return;
	}
	$menuEntries = get_children_menu_entries($uid);
	if( ! $menuEntries ) {
		return;
	}
	?>
		<ul<?php if($level === 0): ?> class="collection"<?php endif ?>>
		<?php foreach($menuEntries as $menuEntry): ?>
			<li class="collection-item">
				<?php echo HTML::a($menuEntry->url, $menuEntry->name) ?>
				<?php print_menu($menuEntry->uid, $level + 1, $args) ?>
			</li>
			<?php endforeach ?>
		</ul>

	<?php
}

function print_menu_link($uid, $text = null, $classes = null, $other = null) {
	$menu = get_menu_entry($uid);
	if( ! $menu ) {
		return null;
	}
	echo HTML::a(
		$menu->url,
		($text) ? $text : $menu->name,
		( @$menu->extra['title'] ) ? $menu->extra['title'] : $menu->name,
		$classes,
		$other
	);
}

if( ! function_exists('_isSelected') ) {
	function _isSelected($value1, $value2, $force = false) {
       		if($force === true || $value1 == $value2) {
       	        	return HTML::property('selected', 'selected');
		}
		return '';
	}
}

function _print_link($url) {
	echo HTML::a(
		$url,
		'<i class="material-icons">print</i> ' . _("Stampa"),
		_("Vista stampa"),
		null,
		'target="_blank"'
	);
}

/**
 * Shortcut
 *
 * @param int $scuola_ID
 * @return ScuolaFull
 */
function get_scuola($scuola_ID = null) {
	if( $scuola_ID === null ) {
		return User::forceHavingSchool();
	}
	$scuola = ScuolaFull::queryByID($scuola_ID);
	$scuola or die_asking_permissions();
	return $scuola;
}

function die_asking_permissions() {
	require_permission('indefined-permission');
	exit; //
}

function euro($v) {
	return money_format('%.2n', $v);
}

function _euro($v) {
	echo euro($v);
}
