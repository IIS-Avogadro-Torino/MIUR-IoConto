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
	static function factory($args = []) { ?>

<?php if( Header::$args['container'] ): ?>
</div>
<!-- End header container -->
<?php endif ?>

<?php if( @ $args['footer'] !== false ): ?>

<footer class="page-footer">
	<div class="container white-text">
		<?php if( ! @$args['print-mode'] ): ?>

		<p><?php _esc_html(SITE_DESCRIPTION) ?></p>
		<p><?php printf(
			_("A cura di %s."),
			HTML::a(URL . '/about.php',
				'ITIS Avogadro di Torino',
				_('Ulteriori informazioni sul team e sulle tecnologie'),
				'orange-text text-lighten-4'
			)
		) ?></p>
		<p>
			<small><?php printf(
				_("Pagina generata in %s secondi, con %s query al database."),
				get_page_load(),
				get_num_queries()
			) ?><br /> <?php _e("Questo sito non utilizza cookie di terze parti perchè non tracciamo gli utenti. I cookie tecnici vengono richiesti solo dopo l'accesso, per mantenere la sessione.") ?></small>
		</p>
		<?php endif ?>
	</div>
	<div class="footer-copyright">
		<?php if( @$args['print-mode'] ): ?>

		<p>
			&copy; <?php echo date('Y') ?> <?php _esc_html(SITE_NAME) ?> - Area riservata <em><?php echo URL ?></em>
		</p>
		<?php else: ?>

		<div class="container">
			<p>&copy; <?php echo date('Y') ?> <?php _esc_html(SITE_NAME) ?> - <a class="white-text" href="<?php _e('http://creativecommons.org/licenses/by-sa/4.0/deed.it') ?>" title="<?php _e('Creative Commons 4.0 Internazionale') ?>" target="_blank"><?php _e('Alcuni diritti riservati') ?></a></p>
		</div>
		<?php endif ?>

	</div>
</footer>
<?php endif ?>

<?php load_module('footer') ?>
</body>
</html><?php } }
