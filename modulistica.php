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

require 'load.php';

require_permission('VIEW_SCHOOL_RELATED_RESOURCES');

Header::factory( 'modulistica' );
?>
	<p><?php _e("Elenco dei moduli:") ?></p>
	<ul class="collection">
		<?php collection_icon( HTML::a(
			UPLOADS_URL . '/Elenco-iscritti-def.xlsx',
			_("Elenco iscritti per scuola polo")
		)) ?>
		<?php collection_icon( HTML::a(
			UPLOADS_URL . '/DB-Esperti.xlsx',
			_("DB Esperti")
		) ) ?>
		<?php collection_icon( HTML::a(
			UPLOADS_URL . '/All.3_Modello-incarico-esperti.doc',
			_("Modello incarico esperti")
		) ) ?>
		<?php collection_icon( HTML::a(
			UPLOADS_URL . '/All.4_Foglio-firme.docx',
			_("Foglio firme discenti")
		) ) ?>
		<?php collection_icon( HTML::a(
			UPLOADS_URL . '/All.5_Questionario-gradimento.docx',
			_("Questionario gradimento")
		) ) ?>
		<?php collection_icon( HTML::a(
			UPLOADS_URL . '/All.6_Format-attestato-partecipazione.pptx',
			_("Format attestato partecipazione")
		) ) ?>
		<?php collection_icon( HTML::a(
			UPLOADS_URL . '/All.7_Modulo-rimborso.docx',
			_("Modulo rimborso spese esperti")
		) ) ?>
		<?php collection_icon( HTML::a(
			UPLOADS_URL . '/prospetto-quote-rimborso-editori-importi-aggiornati.docx',
			_("Prospetto quote rimborso editori importi aggiornati")
		) ) ?>
		<?php collection_icon(
			HTML::a(
				UPLOADS_URL . '/IoConto-Info-Formazione-su-Territorio.xls',
				_("Info formazione su territorio")
			) . '<br /> ' .
			HTML::tag('span',
				sprintf(
					_("Da inviare mensilmente a <b>%s</b> a cura delle scuole polo."),
					ADMIN_EMAIL
				)
			)
		) ?>
	</ul>
<?php
BackendNav::spawn();

Footer::factory();
