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

$scuola = null;
if( has_permission('EDIT_ALL_POLE_SCHOOLS') ) {
	$scuola = get_scuola( @$_GET['scuola_ID'] );
} else {
	$scuola = get_scuola();
}

$rendiconto = $scuola->queryRendiconto762();

Header::factory( 'single-pole-school-reporting-dm762', [
	'pre-template' => 'print'
] );
?>
<?php if( $scuola->isScuolaNotFull() ): ?>
<p>
	Prima di procedere, completa i campi della scuola polo: <br />
	<?php print_menu_link('single-pole-school-edit-fields', null, 'btn') ?>
</p>
<?php else: ?>

<div>
	<div style="float:left; max-width:300px">
		<p>Prot. nr. <b><?php $rendiconto and _esc_html( $rendiconto->getRendiconto762Protocollo() ) ?></b></p>
	</div>
	<div style="float:right; max-width:200px">
		<p><strong>Direttore Generale</strong><br />
		Direzione Generale per le risorse umane e finanziarie<br />
		Viale Trastevere 76/A - ROMA<br /><br />

		p.c. <strong>Direttore Generale</strong><br />
		Direzione del personale scolastico
		</p>
	</div>
</div>
<div style="clear:both"></div>

<h2>Oggetto:</h2>
<p>
	Rendicontazione fondi erogati con decreto n. 762 del 2 ottobre 2014 approvato con DDG della Direzione Generale per le risorse umane e finanziarie n.351-352-353-354 dell 11 dicembre 2014.
</p>
<p>
	Con riferimento al decreto della Direzione Generale per le risorse umane e finanziarie di cui all'oggetto, con il quale è stato disposto un impegno di euro:
	<b><?php $rendiconto and _euro( $rendiconto->getRendiconto762Impegno() ) ?></b> si provvede alla rendicontazione dei titoli relativi alle spese sostenute al fine di ottenere l'erogazione.
</p>

<h2>Scuola polo</h2>
<table border="1">
	<thead>
		<tr>
			<th>Meccanografico</th>
			<th>Codice Fiscale</th>
			<th>Conto e Sezione</th>
			<th>Responsabile</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<?php _esc_html( $scuola->getScuolaMeccanografico() ) ?><br />
				<?php _esc_html( $scuola->getScuolaName() ) ?><br />
				<?php _esc_html( $scuola->getComuneName() ) ?>
			</td>
			<td><?php _esc_html( $scuola->getScuolaCodicefiscale() ) ?></td>
			<td>
				Codice: <?php _esc_html( $scuola->getScuolaTesoreriaCodice() ) ?><br />
				Conto: <?php  _esc_html( $scuola->getScuolaTesoreriaConto() ) ?>
			</td>
			<td>
				<?php _esc_html( $scuola->getScuolaResponsabileName() ) ?>
				<?php _esc_html( $scuola->getScuolaResponsabileSurname() ) ?><br />
				<?php _esc_html( $scuola->getScuolaResponsabileEmail() ) ?><br />
				<?php _esc_html( $scuola->getScuolaResponsabilePhone() ) ?>
			</td>
		</tr>
	</tbody>
</table>

<h2>Voci di spesa</h2>
<table border="1">
	<thead>
		<tr>
			<th>
			</th>
			<th>Voce di spesa</th>
			<th>Importo totale</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>
				Spese per l'erogazione della formazione in aula - costo orario per esperto (44.83 euro per ora )<br />
				<small>(Voce non modificabile)</small>
			</td>
			<td>
				<?php $rendiconto and _euro( $rendiconto->getRendiconto762ImportoTotale1() ) ?>
			</td>
		</tr>
		<tr>
			<td>2</td>
			<td>
				Spese di trasferimento, vitto ed eventuale alloggio esperti<br />
			</td>
			<td>
				<?php $rendiconto and _euro( $rendiconto->getRendiconto762ImportoTotale2() ) ?>
			</td>
		</tr>
		<tr>
			<td>3</td>
			<td>
				Spese attività organizzativo e amministrativo svolte per la pianificazione e l'erogazione della formazione
				(ivi compresi i costi sostenuti per la partecipazione alle riunioni indette dal MIUR nella fase di avvio del progetto)<br />
			</td>
			<td>
				<?php $rendiconto and _euro( $rendiconto->getRendiconto762ImportoTotale3() ) ?>
			</td>
		</tr>
		<tr>
			<td>4</td>
			<td>
				Importi inviati al Leonardo da Vinci per rimborso editori<br />
			</td>
			<td>
				<?php $rendiconto and _euro( $rendiconto->getRendiconto762ImportoTotaleVinci() ) ?>
			</td>
		</tr>
		<tr>
			<td>5</td>
			<td>
				<p>Eventuali altre spese (dettagliare):</p>
				<p><?php $rendiconto and _esc_html( $rendiconto->getRendiconto762ImportoTotaleExtraDescription() ) ?></p>
			</td>
			<td>
				<?php $rendiconto and _euro( $rendiconto->getRendiconto762ImportoTotaleExtra() ) ?>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>TOTALE</td>
			<td id="totale">
				<?php if($rendiconto): ?>
					<b><?php $rendiconto and _euro( $rendiconto->getRendiconto762ImportoTotaleSum() ) ?></b>
				<?php else: ?>
				/ /
				<?php endif ?>
			</td>
		</tr>
	</tbody>
</table>
</div>

<p>I documenti giustificativi relativi alle spese sostenute sono custodite presso questo Istituto e collazionate al Conto Consuntivo 2015 a disposizione degli organi di controllo.</p>
<p><em>Si attesta la regolarità amministrativo - contabile relativamente ai titoli di spesa, agli impegni assunti e alle procedure adottate con riferimento a quanto oggetto di rendiconto del presente documento.</em></p>
<div style="float:right;min-width:300px">
	<p>Il revisore dei Conti:</p>
	<?php $rendiconto and _esc_html( $rendiconto->getRendiconto762Revisore() ) ?>
	<br /><br /><br /><br /><hr />
</div>
<div style="float:right;margin-right:20px;min-width:300px">
	<p>Il Dirigente Scolastico:</p>
	<br /><br /><br /><br /><hr />
</div>
<div style="clear:both"></div>
<script>
(function() {
	if(window.print) {
		window.print();
	} else {
		alert("Ora puoi salvare questa pagina per la stampa");
	}
})();
</script>
<?php endif ?>

<?php Footer::factory( [ 'print-mode' => true ] );
