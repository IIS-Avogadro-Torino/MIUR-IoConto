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

#
# Copy-pasted a document as-is
#

require_permission('EDIT_HIS_POLE_SCHOOL');

Header::factory( 'single-pole-school-reporting' );
?>
<style>
p {
    text-align: justify;
    text-justify: inter-word;
}
</style>
<h5>Note per la compilazione (estratto dalla nota 11896 del 31 luglio 2015 – Gestione e rendicontazione delle spese connesse alla formazione sul territorio)</h5>
<p>Ciascuna Scuola "Polo" deve indicare il numero dalle edizioni espletate rispetto ai numero delle edizioni pianificale ed è tenuta a produrre la rendicontazione per tutte le edizioni pianificate, indicando nel prospetto riepilogativo le speso sostenute, nonché le somme impegnate al fini del completamento della formazione.</p>
<p>
	Devono essere predisposte due rendicontazioni distinte, una a valere sui finanziamenti del D M n 821 del 2013 e una a valere sui finanziamenti del DM n. 762 del 2014. <br />
	Le Scuole "Polo" devono conservare la documentazione necessaria ad attestare i pagamenti effettuali, nonché la documentazione necessaria a certificare la previsione di spesa connessa alle somme impegnate anche ai fini degli opportuni controlli da parte di uno o di entrambi i revisori dei conti.
</p>
<p>
	Almeno un revisore dovrà unitamente alla firma del DS apporre la propria firma a valle del rendiconto sotto la seguente frase "Si attesta la regolarità amministrativo-contabile relativamente ai titoli di spesa, agli impegni assunti e alle procedure adottate con riferimento a quanto oggetto di rendiconto del presente documento".
</p>
<p>
	Tipologie di spesa consentite di seguito descritte ed ammissibili ai fini della rendicontazione:
</p>
<ul>
	<li>
		<p>Spese per l'erogazione della formazione in aula: per ogni ora di formazione erogata da ciascun esperto incaricato dalle Scuole Polo dovrà essere corrisposto un rimborso pari a € 41.32 (cfr. Decreto Interministeriale 12 ottobre 1995 n. 326) a cui devono essere aggiunti gli oneri di legge a carico dello Stato, per un totale di € 44.83.</p>
	</li>
	<li>
		<p>
		Spese di trasferimento, vitto ed eventuale alloggio degli esperti: sarà cura delle Scuole Polo rimborsare a ciascun esperto incaricato le spese sostenute per i trasferimenti in arrivo e in partenza dall'Istituzione Scolastica presso la quale si terrà la formazione e le spese per il vitto durante le giornate di formazione. Solo ed esclusivamente nei casi in cui si renda necessario (casi eccezionali di trasferimenti di lunga distanza), è previsto anche il rimborso dell'alloggio degli esperti. Gli importi e le modalità dovranno essere preventivamente concordate tra i singoli esperti e le Scuole Polo interessate ad incaricare gli stessi. <br>
		I costi di trasferimento, vitto e alloggio saranno rimborsati previa presentazione da parte degli esperti della documentazione giustificativa delle spese sostenute (ad esempio: scontrini, biglietti treno, ecc.); sarà cura delle Scuole Polo conservare tale documentazione ai fini degli opportuni controlli da parte dei Revisori dei conti 
		</p>
	</li>
	<li>
		<p>Spese per attività amministrative / organizzative svolte per la pianificazione e l'erogazione della formazione: per ciascuna edizione del corso le Scuole "Polo" potranno rendicontare le ore delle attività amministrative / organizzative ad un costo di € 21.90 (media costi lordo stato DSGA e Assistente Amministrativo CCNL 2009) omnicomprensivi.</p>
	</li>
</ul>
<h5>
	È stato definito un costo medio per edizione pari a € 1.913,94, composto da una voce fissa (Erogazione della formazione in aula) e due voci variabili (Trasferimento, vitto ed eventuale alloggio degli esperti e Attività amministrative / organizzative svolte per la pianificazione e l'erogazione della formazione).
</h5>
<hr />
<table class="bordered responsive-table">
	<thead>
	<tr>
		<td colspan="4" nowrap>
			Costo medio edizione
		</td>
	</tr>
	<tr>
		<th>VOCE</th>
		<th>QUANTITÀ</th>
		<th>COSTO UNITARIO (euro)</th>
		<th>TOTALE (euro)</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>Erogazione della formazione in aula</td>
		<td>18 ore</td>
		<td>44.83</td>
		<td>806.94</td>
	</tr>
	<tr>
		<td>Trasferimento, vitto ed eventuale alloggio degli esperti</td>
		<td>3 giorni</td>
		<td>150</td>
		<td>450.00</td>
	</tr>
	<tr>
		<td>Attività amministrative/organizzative svolte per la pianificazione e l'erogazione della formazione</td>
		<td>30 ore</td>
		<td>21.90</td>
		<td>657.00</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><b>Totale: (euro)</b></td>
		<td><b>1913.94</b></td>
	</tr>
	</tbody>
</table>
<p>
	Il costo medio per singola edizione rappresenta un valore di riferimento, rispetto al quale le Scuole Polo, in funzione delle esigenze organizzative, potranno discostarsi, in aumento o diminuzione, rispetto alle due voci variabili (trasferimento, vitto ed eventuale alloggio degli esperti e attività amministrative / organizzative svolte per la pianificazione e l'erogazione della formazione).
</p>
<p>
	Resta inteso che la spesa complessiva per l'organizzazione e l'erogazione delle edizioni pianificate da ogni Scuola Polo non potrà in nessun caso superare l'Importo economico assegnatale, al netto delle seguenti ulteriori spese:
</p>
<ul>
	<li>spese per viaggi connessi alla collaborazione fra Scuole Polo e MIUR </li>
	<li>spesa per compenso degli editori (come individuati da DDG n 233 del 26 giugno 2014)</li>
</ul>
<p>
	Con riferimento al secondo punto, ciascuna Scuola Polo è chiamata a contribuire al rimborso degli editori versando una quota, definita in proporzione al <a href="<?php echo ROOT . '/single-pole-school-reporting-budget.php' ?>">budget assegnato</a> che dovrà essere trasferita sul conto corrente bancario dell'istituto Superiore Leonardo da Vinci, presso Banca d'Italia - Tesoreria Unica, IBAN: IT38S0100003245311300311929 - Conto di Tesoreria 311929, che  procederà successivamente ad effettuare il rimborso agli editori a seguito dell'acquisizione di apposita relazione del coordinatore sul gruppo di lavoro degli editori di ciascuna area tematica.
</p>
<p>
	I decreti 762/2014 e 821/2013 vengono rendicontati secondo modalità differenti: il D.M. 762/2014, data l'esiguità della somma imputata a ciascuna scuola polo, prevede una sola rendicontazione nella quale l'importo assegnato è prioritariamente e completamente speso e rendicontato.
	Questa rendicontazione deve essere inviata alla direzione competente (DG per il personale scolastico) entro e non oltre il 16 Novembre 2015.
	La scheda rendicontativa relativa al D.M. 762/2014 si raggiunge cliccando <?php print_menu_link('single-pole-school-reporting-dm762', 'qui') ?>.
</p>
<p>
	Il decreto 821/2013 prevede una rendicontazione suddivisa in due fasi; una prima fase (rendicontazione intermedia) da completare entro il 16 novembre 2015 e una seconda fase (rendicontazione finale) da completare entro febbraio 2016.<br />
	La scheda rendicontativa relativa al D.M. 821/2013 si raggiunge cliccando <?php print_menu_link('single-pole-school-reporting-dm821', 'qui') ?>.
</p>
<p>
	<em>Fase uno</em><br />
	La rendicontazione intermedia relativa al D.M. 821/2013 comprende gli importi effettivamente spesi e quelli effettivamente impegnati al fine di poter completare correttamente il piano di formazione.
</p>
<p>
	<em>Fase due</em><br />
	Alla conclusione dei corsi, al momento di presentare la rendicontazione finale ogni scuola polo aggiornerà il rendiconto con le cifre effettivamente spese; di conseguenza si definiranno le eventuali economie effettive finalizzate agli obiettivi del progetto.
</p>
<h5>Modalità di invio</h5>
<p>Di seguito si riportano le istruzioni in sintesi per la rendicontazione e il successivo inoltro alla DGRUF.</p>
<ol class="collection">
	<li>Compilare il form, renderlo permanente e stamparlo;</li>
	<li>Farlo firmare al revisore e al dirigente e apporre il timbro dell'istruzione scolastica;</li>
	<li>Scansionarlo in formato .pdf e denominarlo <code>codice_mecc_CM821</code> o <code>codice_mecc_DM762</code>. Es: <code>TOIS05100C_DM821</code></li>
	<li>Inviarlo alla e-mail <a href="mailto:<?php echo ADMIN_EMAIL ?>"><?php echo ADMIN_EMAIL ?></a> con oggetto: "Rendiconto DM 762/2014 (oppure DM821/2013) cod. mecc.: xxxxxxxxxx"</li>
	<li>Nel corpo  della e-mail INSERIRE nome, qualifica e recapito telefonico (possibilmente cellulare) del referente.</li>
</ol>

<?php
print_menu('single-pole-school-reporting', 0, ['max-level' => 0]);

Footer::factory();
