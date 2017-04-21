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

require_permission('EDIT_HIS_POLE_SCHOOL');

Header::factory( 'single-pole-school-reporting-budget' );

#
# Documento copia-incolla così come me l'hanno dato.
# Beautificato con GNU Emacs.
#
?>
<style>
p {
    text-align: justify;
    text-justify: inter-word;
}
</style>
<h5>Si riporta il testo della mail del 23 settembre 2015 relativa al prospetto per i rimborsi degli editori. <br> Si ricorda che queste spese vanno imputate alla voce "soldi inviati al Leonardo Da Vinci per rimborso editori" nei prospetti rendicontativi</h5>
<p>
	<em>Con riferimento alla Nota MIUR n. 0011896 del 31/07/2015, si trasmette in allegato il file rettificato relativo al contributo per il rimborso editori che ciascuna Scuola “Polo” è chiamata a versare, in proporzione al budget assegnato.
	<br />
	Si precisa che la ripartizione delle quote di rimborso ha subito delle modifiche poiché è stato aggiunto al numero degli editori, come definito nel DDG n. 233 del 26 giugno 2014, un membro supplente che ha contribuito alle attività progettuali in qualità di editore a pieno titolo, come da dichiarazione del coordinatore del gruppo di lavoro. <br>
	Pertanto le Scuole che avessero già provveduto a pagare l’importo all’Istituto Leonardo Da Vinci così come indicato dall’Allegato 8 alla suddetta Nota, sono tenute a versare la differenza indicata nella colonna “Eventuale differenza da versare” del file allegato alla presente; le Scuole che ancora non avessero effettuato il pagamento dovranno versare l’intera quota pari all’importo presente nella colonna “Ripartizione importo rimborso editori integrato ” dello stesso file.<br>
	Si ricorda che, ai fini del pagamento, ciascuna Scuola “Polo” dovrà trasferire, entro il 30 settembre la quota di pertinenza, sul Conto corrente bancario intestato all’Istituto Superiore Leonardo da Vinci di Firenze, presso Banca d’Italia – Tesoreria Unica, IBAN: IT38S0100003245311300311929. Conto di Tesoreria 311929. <br>
	L’Istituto Superiore Leonardo da Vinci provvederà, successivamente, ad effettuare il rimborso agli editori a seguito dell’acquisizione di apposita relazione del coordinatore sul gruppo di lavoro degli editori di ciascuna area tematica (cfr Allegato 9 alla Nota MIUR n. 0011896 del 31/07/2015).
	<br /><br />
	Cordiali saluti,<br /><br />
	Segreteria Io Conto
	</em>
</p>
<table class="bordered striped responsive-table">
    <tbody>
        <tr>
            <td widthxxx="91" nowrap="">
                <p align="center">
                    <strong>
                        Codice
                        <br/>
                        Meccanografico
                    </strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="">
                <p align="center">
                    <strong>Denominazione Scuola Polo</strong>
                </p>
            </td>
            <td widthxxx="92">
                <p align="center">
                    <strong>Ripartizion</strong>
                    <strong>e importo rimborso editori come indicato nella Nota n. 0011896 del 31/07/2015 (€)</strong>
                </p>
            </td>
            <td widthxxx="99">
                <p align="center">
                    <strong>Ripartizione importo rimborso editori </strong>
                    <strong>integrato (€)</strong>
                </p>
            </td>
            <td widthxxx="65">
                <p align="center">
                    <strong>Eventuale differenza da versare (€)</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>ANIS014007</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.I.S. VOLTERRA - ELIA
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    1.289,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    1342,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    54,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>ANIS019000A</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    A. PANZINI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    185,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    193,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    8,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>AQIS007009</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.I.S. "LEONARDO DA VINCI"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    200,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    209,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    8,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>BATD050006</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    GIULIO CESARE
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    608,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    633,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    25,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>BGIS03200C</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    "GIULIO NATTA"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    227,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    236,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    9,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>BSIS03400L</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    RC "GIOVANNI FALCONE"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    676,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    704,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    28,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>CRIS00300A</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    "A. GHISLERI"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    124,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    129,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    5,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>CSIS06300D</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    IIS TREBISACCE "IPSIA- ITI"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    207,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    215,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    9,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>CTRH05000N</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    ROCCO CHINNICI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    485,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    505,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    20,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>CZVC01000A</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    CATANZARO CONVITTO NAZIONALE "GALLUPPI"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    148,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    154,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    6,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>FGIS021009</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    PIETRO GIANNONE
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    57,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    60,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    2,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>FGPS010008</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    ALESSANDRO VOLTA
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    155,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    161,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    6,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>FIIS01700A</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    IS LEONARDO DA VINCI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    309,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    322,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    13,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>FRTF020002</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.T.I.S. "E. MAJORANA" CASSINO
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    123,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    128,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    5,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>LEIS00600N</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    ANTONIO MEUCCI CASARANO
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    248,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    259,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    10,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>LEIS017004</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    F. BOTTAZZI CASARANO
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    202,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    210,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    8,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>LUIS01200P</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.S.I. "S. Pertini"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    154,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    160,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    6,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>MCTD01000V</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    "A. GENTILI" MACERATA
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    147,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    153,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    6,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>MSIC80900N</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    AVENZA - GINO MENCONI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    97,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    102,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    4,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>NAIS078002</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    IST. D'ISTRUZIONE SUPERIORE "EUROPA"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    244,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    255,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    10,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>NAIS11600G</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.S. L.C. ITCG "ROSMINI" PALMA CAMPANIA-
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    787,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    819,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    33,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>NATF130009</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    ITI L.GALVANI-GIUGLIANO-
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    447,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    466,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    19,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>NATF24000R</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    ITI "FERMI - GADDA" NAPOLI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    87,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    91,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    4,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>PEPS03000N</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    Liceo Scientifico G. “Galilei”
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    54,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    56,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    2,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>PETD07000X</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.T.C.G. ' ATERNO - MANTHONE'
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    155,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    161,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    6,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>PVIC834008</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    ISTITUTO COMPRENSIVO DI VIA ANGELINI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    105,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    110,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    4,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>RCPM02000L</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    "G.MAZZINI" LOCRI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    53,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    55,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    2,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>RCPS010001</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    LICEO SCIENTIFICO "L. DA VINCI"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    151,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    157,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    6,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>RMPC250005</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    TASSO
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    265,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    276,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    11,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>RMPS19000T</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    LICEO SCIENTIFICO KEPLERO
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    232,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    242,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    10,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>RMPS29000P</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    VITO VOLTERRA
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    344,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    359,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    14,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>SRIC828009</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    III I.C. "S. LUCIA" SIRACUSA
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    595,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    620,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    25,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>SRIC84000X</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I ISTITUTO COMPRENSIVO MELILLI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    283,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    295,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    12,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>SSIC850002</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    MONTE ROSELLO BASSO
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    413,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    430,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    17,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>TOIS05100C</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.I.S. "Avogadro"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    1.058,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    1102,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    44,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>TRIC811001</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.C. TERNI A.DE FILIS
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    262,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    273,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    11,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>VAIC830005</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.C. CUVEGLIO - D. ALIGHIERI
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    208,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    217,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    9,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>VRPS03000R</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    GIROLAMO FRACASTORO
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    517,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    538,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    22,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>SIRH030008</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
                <p>
                    I.I.S. "Pellegrino Artusi"
                </p>
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    99,00
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    103,00
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    4,00
                </p>
            </td>
        </tr>
        <tr>
            <td widthxxx="91" nowrap="" valign="top">
                <p>
                    <strong>Totale complessivo</strong>
                </p>
            </td>
            <td widthxxx="157" nowrap="" valign="top">
            </td>
            <td widthxxx="92" nowrap="" valign="top">
                <p align="right">
                    <strong>12.000,00</strong>
                </p>
            </td>
            <td widthxxx="99" nowrap="" valign="top">
                <p align="right">
                    <strong>12.500,00</strong>
                </p>
            </td>
            <td widthxxx="65" nowrap="" valign="top">
                <p align="right">
                    <strong>500,00</strong>
                </p>
            </td>
        </tr>
    </tbody>
</table>
<p>
	<?php print_menu_link('single-pole-school-reporting', _("Torna a Rendicontazione"), 'btn') ?>
</p>
<?php

Footer::factory();
