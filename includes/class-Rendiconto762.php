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

trait Rendiconto762Trait {
	function getRendiconto762ID() {
		return $this->nonnull(Rendiconto762::ID);
	}

	function isRendiconto762Readonly() {
		return $this->nonnull(Rendiconto762::READONLY);
	}

	function getRendiconto762Protocollo() {
		return $this->get(Rendiconto762::PROTOCOLLO);
	}

	function getRendiconto762Impegno() {
		return $this->get(Rendiconto762::IMPEGNO);
	}

	function getRendiconto762ImportoTotale1() {
		return $this->get(Rendiconto762::IMPORTO_TOT_1);
	}

	function getRendiconto762ImportoTotale2() {
		return $this->get(Rendiconto762::IMPORTO_TOT_2);
	}

	function getRendiconto762ImportoTotale3() {
		return $this->get(Rendiconto762::IMPORTO_TOT_3);
	}

	function getRendiconto762ImportoTotaleVinci() {
		return $this->get(Rendiconto762::IMPORTO_TOT_VINCI);
	}

	function getRendiconto762ImportoTotaleExtra() {
		return $this->get(Rendiconto762::IMPORTO_TOT_EXTRA);
	}

	function getRendiconto762ImportoTotaleExtraDescription() {
		return $this->get(Rendiconto762::IMPORTO_TOT_EXTRA_DESC);
	}

	function getRendiconto762Revisore() {
		return $this->get(Rendiconto762::REVISORE);
	}

	function getRendiconto762ImportoTotaleSum() {
		return	$this->getRendiconto762ImportoTotale1() +
			$this->getRendiconto762ImportoTotale2() +
			$this->getRendiconto762ImportoTotale3() +
			$this->getRendiconto762ImportoTotaleVinci() +
			$this->getRendiconto762ImportoTotaleExtra();
	}

	function normalizeRendiconto762() {
		$this->integers(Rendiconto762::ID);
		$this->booleans(Rendiconto762::READONLY);
		$this->floats(
			Rendiconto762::IMPEGNO,
			Rendiconto762::IMPORTO_TOT_1,
			Rendiconto762::IMPORTO_TOT_2,
			Rendiconto762::IMPORTO_TOT_3,
			Rendiconto762::IMPORTO_TOT_VINCI,
			Rendiconto762::IMPORTO_TOT_EXTRA
		);
	}
}

class_exists('Scuola');

class Rendiconto762 extends Queried {
	use Rendiconto762Trait;
	use ScuolaTrait;

	const T                      = 'rendiconto762';

	const ID                     = 'rendiconto_ID';
	const NAME                   = 'rendiconto_name';
	const READONLY               = 'rendiconto_readonly';
	const PROTOCOLLO             = 'rendiconto_protocollo';
	const IMPEGNO                = 'rendiconto_impegno';
	const IMPORTO_TOT_1          = 'rendiconto_importo_totale_1';
	const IMPORTO_TOT_2          = 'rendiconto_importo_totale_2';
	const IMPORTO_TOT_3          = 'rendiconto_importo_totale_3';
	const IMPORTO_TOT_VINCI      = 'rendiconto_importo_totale_vinci';
	const IMPORTO_TOT_EXTRA      = 'rendiconto_importo_totale_extra';
	const IMPORTO_TOT_EXTRA_DESC = 'rendiconto_importo_totale_extra_description';
	const REVISORE               = 'rendiconto_revisore';

	const SCUOLA                 = 'scuola_ID';

	const ID_                    = self::T . DOT . self::ID;
	const SCUOLA_                = self::T . DOT . self::SCUOLA;

	function __construct() {
		$this->normalizeRendiconto762();
		$this->normalizeScuola();
	}

	static function factory() {
		return Query::factory( __CLASS__ )->from(self::T);
	}

	static function factoryByScuola($scuola_ID) {
		return self::factory()->whereInt(self::SCUOLA_, $scuola_ID);
	}

	static function queryByScuola($scuola_ID) {
		return self::factoryByScuola($scuola_ID)->queryRow();
	}
}
