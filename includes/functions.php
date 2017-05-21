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
		site_page($menu->url, ROOT),
		($text) ? $text : $menu->name,
		( @$menu->extra['title'] ) ? $menu->extra['title'] : $menu->name,
		$classes,
		$other
	);
}

function menu_url($uid) {
	return site_page( get_menu_entry($uid)->url );
}

function get_organic_ID() {
	$die = false;

	is_logged()
		or die_asking_permissions();

	$organico_ID = get_user()->get(User::ORGANICO);

	isset($organico_ID)
		or die_asking_permissions();

	return $organico_ID;
}

function organico_ID() {
	is_logged()
		or die_asking_permissions();

	$organico_ID = get_user()->get(User::ORGANICO);

	isset($organico_ID)
		or die_asking_permissions();

	return $organico_ID;
}

function required_permission($permission) {
	if( ! is_logged() ) {
		$url = site_page( get_menu_entry('login')->url );
		http_redirect( $url );
	} elseif( ! has_permission($permission) ) {
		PermissionError::spawn();
		Footer::spawn();
		exit; // Yes!
	}
}

function die_asking_permissions() {
	required_permission('indefined-permission');
	Footer::spawn();
	exit;
}

function login_url($user_uid = null) {
	$url = menu_url('login');
	if($user_uid) {
		$url .= '?' . http_build_query( [
			'user_uid' => $user_uid
		] );
	}
	return $url;
}

/**
 * @author Stephen Watkins
 * @license CC BY SA 3.0
 * @see https://stackoverflow.com/questions/4356289/php-random-string-generator/4356295#4356295
 */
function generate_random_string($length = 10) {
	$dictionary = '23456789abcdefghlmnpqrstuvz';
	$n = strlen($dictionary);
	$s = '';
	for($i = 0; $i < $length; $i++) {
		$j = rand(0, $n - 1);
		$s .= $dictionary[ $j ];
	}
	return $s;
}

function assist_link($title = null) {
	if( ! $title ) {
		$title = _("assistenza");
	}
	return sprintf(
		'<a href="%s">%s</a>',
		'http://www.formazionemiur.it/assistenza/',
		$title
	);
}

function yep_nope() {
	return [
		true  => _("si'"), // Lasciare senza accento
		false => _("no")
	];
}
