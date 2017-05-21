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

class Footer {
	static function spawn() { ?>

	</div>
	<!-- /main -->

	<?php load_module('footer') ?>

	<?php Header::$args['toolbar-upload']
		and UploadToolbar::spawn() ?>

	<?php Header::$args['toolbar-login']
		and LoginToolbar::spawn() ?>

</div>
<!-- /row -->

<script>
$(document).ready( function () {
	/**
	 * Sidebar animation
	 */
	var $aside = $('aside');
	$aside.css('transition', 'padding-top 1s ease');
	if( $(document).width() > 600 ) {
			$aside.css('min-height', $(document).height() + 'px');
			$aside.parent().css('margin-bottom', 0);
	}

	var timeout;
	$(window).scroll( function () {
		if( $(document).width() > 600 ) {
			timeout && window.clearTimeout(timeout);
			timeout = setTimeout( function () {
				$aside.css('padding-top', window.pageYOffset + 'px')
			}, 200 );
		} else {
			$aside.css('padding-top', 'inherit')
				.css('min-height', 0)
		}
	} );
} );
</script>

<footer class="page-footer hide-on-med-and-up light-blue darken-1">
	<div class="container">
		<ul>
			<li><?php print_menu_link('home', _("Torna alla home"), 'white-text') ?></li>
			<li><?php print_menu_link('istruzioni-compilazione', null, 'white-text') ?></li>
			<?php if( is_logged() ): ?>
			<li><?php print_menu_link('assistenza', null, 'white-text') ?></li>
			<?php endif ?>
			<li><?php print_menu_link('torna-a-io-conto', null, 'white-text') ?></li>
			<?php if( is_logged() ): ?>
			<li><?php print_menu_link('logout', null, 'white-text') ?></li>
			<?php else: ?>
			<li><?php print_menu_link('login', null, 'white-text') ?></li>
			<?php endif ?>
		</ul>
	</div>
</footer>

<!-- <?php printf(
	_("Pagina generata in %s secondi, con %s query al database."),
	get_page_load(),
	get_num_queries()
     ) ?> -->

</body>
</html><?php } }
