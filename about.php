<?php
# Formazione MIUR content management system
# Copyright (C) 2015, 2016, 2017 Valerio Bozzolan
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

Header::spawn( 'about' );
?>
	<div class="card-panel hoverable">
		<div class="row valign-wrapper">
			<div class="col s11 m9">
				<p class="flow-text"><?php _e("Piattaforma realizzata a cura dell'ITIS Avogadro di Torino.") ?></p>
				<p><?php echo HTML::a(
					'http://www.itisavogadro.it',
					_("ITIS Avogadro di Torino"),
					_("ITIS Amedeo Avogadro di Torino"),
					'btn'
				) ?></p>
			</div>
			<div class="s1 m3">
				<img src="<?php echo IMAGE_URL . '/logo-avogadro.png' ?>" alt="Logo Avogadro" class="responsive-img" style="max-width:100px" />
			</div>
		</div>
	</div>

	<h2><?php _e("Task force") ?></h2>
	<div class="row">
		<div class="col s12 m6">
			<div class="card hoverable">
				<div class="card-content">
					<div class="row valign-wrapper">
						<div class="col s2">
							<img src="<?php echo get_gravatar('gmail.com') ?>" alt="Leonardo Filippone" class="circle responsive-img" />
						</div>
						<div class="col s10">
							<b>Leonardo Filippone</b><br />Supervisor.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col s12 m6">
			<div class="card hoverable">
				<div class="card-content">
					<div class="row valign-wrapper">
						<div class="col s2">
							<img src="<?php echo URL . '/content/images/ulisse-fabiani.png' ?>" alt="Ulisse Fabiani" class="circle responsive-img" />
						</div>
						<div class="col s10">
							<b>Ulisse Fabiani</b><br />Lui.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col s12 m6">
			<div class="card hoverable">
				<div class="card-content">
					<div class="row valign-wrapper">
						<div class="col s2">
							<img src="<?php echo get_gravatar('ivan.bertotto@gmail.com') ?>" alt="Ivan Bertotto" class="circle responsive-img" />
						</div>
						<div class="col s10">
							<b>Ivan Bertotto</b><br />Joomla! Senior. Now tagliato fuori / inchiappettato.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col s12 m6">
			<div class="card hoverable">
				<div class="card-content">
					<div class="row valign-wrapper">
						<div class="col s2">
							<img src="<?php echo get_gravatar('gnu@linux.it') ?>" alt="Valerio Bozzolan" class="circle responsive-img" />
						</div>
						<div class="col s10">
							<b><a href="https://boz.reyboz.it">Valerio Bozzolan</a></b><br />Fa ancora cose, ma sarà inchiappettato come Ivan.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<h2>Software libero</h2>
	<div class="card-panel">
		<p class="flow-text">Per il totale rispetto della tua privacy questo sito è stato realizzato utilizzando esclusivamente <strong>software libero</strong>:</p>
		<ul class="collection">
			<li class="collection-item">
				Framework lato-server:<br />
				<a class="red-text" href="https://launchpad.net/boz-php-another-php-framework" title="Boz-PHP">Boz-PHP</a> <small>(Another PHP framework)</small> di <a href="https://boz.reyboz.it" title="Get in touch with Valerio Bozzolan">Valerio Bozzolan</a>.<br />
				<small>Licenza GNU AGPL</small>
			</li>
			<li class="collection-item">
				<a class="red-text" href="http://jquery.com">jQuery</a> + <a class="red-text" href="https://jqueryui.com/">jQuery UI</a><br />
				<small>Licenza MIT</small>
			</li>
			<li class="collection-item">
				Tema del sito:<br />
				<a class="red-text" href="http://materializecss.com" title="Materialize">Materialize</a><br />
				<small>Licenza MIT</small>
			</li>
		</ul>

		<p>Stack di sistema:</p>
		<ul class="collection">
			<li class="collection-item">
				<a class="red-text" href="https://www.debian.org" title="Debian">Debian GNU/Linux</a><br />
				<small>Licenza GNU GPL</small>
			</li>
			<li class="collection-item">
				<a class="red-text" href="http://apache.org" title="Apache HTTP server">Apache</a><br />
				<small>Licenza Apache</small>
			</li>
			<li class="collection-item">
				<a class="red-text" href="http://php.net" title="PHP">PHP</a><br />
				<small>Licenza PHP</small>
			</li>
			<li class="collection-item">
				<a class="red-text" href="http://www.mysql.it" title="MySQL - DBMS">MySQL</a><br />
				<small>Licenza GNU GPL</small>
			</li>
		</ul>
	</div>

	<h2></h2>
<?php

BackendNav::spawn();

Footer::spawn();
