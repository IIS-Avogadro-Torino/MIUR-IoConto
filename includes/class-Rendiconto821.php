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

trait Rendiconto821Trait {
	function getRendiconto821ID() {
		return $this->nonnull(Rendiconto821::ID);
	}

	function isRendiconto821Readonly() {
		return $this->nonnull(Rendiconto821::READONLY);
	}

	function getRendiconto821Protocollo() {
		return $this->get(Rendiconto821::PROTOCOLLO);
	}

	function getRendiconto821Impegno() {
		return $this->get(Rendiconto821::IMPEGNO);
	}

	/**
	 * @TODO: not really used
	 */
	function getRendiconto821Description() {
		return $this->get(Rendiconto821::DESCRIPTION);
	}

	function getRendiconto821ImportoExtraDescription() {
		return $this->get(Rendiconto821::IMPORTO_EXTRA_DESCRIPTION);
	}

	function getRendiconto821ImportoPagato1() {
		return $this->get(Rendiconto821::IMPORTO_PAGATO_1);
	}

	function getRendiconto821ImportoPagato2() {
		return $this->get(Rendiconto821::IMPORTO_PAGATO_2);
	}

	function getRendiconto821ImportoPagato3() {
		return $this->get(Rendiconto821::IMPORTO_PAGATO_3);
	}

	function getRendiconto821ImportoPagatoLeonardo() {
		return $this->get(Rendiconto821::IMPORTO_PAGATO_LEONARDO);
	}

	function getRendiconto821ImportoPagatoExtra() {
		return $this->get(Rendiconto821::IMPORTO_PAGATO_EXTRA);
	}

	function getRendiconto821ImportoImpegnato1() {
		return $this->get(Rendiconto821::IMPORTO_IMPEGNATO_1);
	}

	function getRendiconto821ImportoImpegnato2() {
		return $this->get(Rendiconto821::IMPORTO_IMPEGNATO_2);
	}

	function getRendiconto821ImportoImpegnato3() {
		return $this->get(Rendiconto821::IMPORTO_IMPEGNATO_3);
	}

	function getRendiconto821ImportoImpegnatoLeonardo() {
		return $this->get(Rendiconto821::IMPORTO_IMPEGNATO_LEONARDO);
	}

	function getRendiconto821ImportoImpegnatoExtra() {
		return $this->get(Rendiconto821::IMPORTO_IMPEGNATO_EXTRA);
	}

	function getRendiconto821EdizioniPreviste() {
		return $this->get(Rendiconto821::EDIZIONI_PREVISTE);
	}

	function getRendiconto821EdizioniRealizzate() {
		return $this->get(Rendiconto821::EDIZIONI_REALIZZATE);
	}

	function getRendiconto821EdizioniRealizzare() {
		return $this->get(Rendiconto821::EDIZIONI_REALIZZARE);
	}

	function getRendiconto821Revisore() {
		return $this->get(Rendiconto821::REVISORE);
	}

	function getRendiconto821ImportoTotaleSum() {
		return	$this->getRendiconto821ImportoPagato1()           +
			$this->getRendiconto821ImportoPagato2()           +
			$this->getRendiconto821ImportoPagato3()           +
			$this->getRendiconto821ImportoPagatoLeonardo()    +
			$this->getRendiconto821ImportoPagatoExtra()       +
			$this->getRendiconto821ImportoImpegnato1()        +
			$this->getRendiconto821ImportoImpegnato2()        +
			$this->getRendiconto821ImportoImpegnatoLeonardo() +
			$this->getRendiconto821ImportoImpegnatoExtra();
	}

	function normalizeRendiconto821() {
		$this->integers(
			Rendiconto821::ID,
			Rendiconto821::EDIZIONI_PREVISTE,
			Rendiconto821::EDIZIONI_REALIZZATE,
			Rendiconto821::EDIZIONI_REALIZZARE
		);
		$this->booleans(Rendiconto821::READONLY);
		$this->floats(
			Rendiconto821::IMPORTO_PAGATO_1,
			Rendiconto821::IMPORTO_PAGATO_2,
			Rendiconto821::IMPORTO_PAGATO_3,
			Rendiconto821::IMPORTO_PAGATO_LEONARDO,
			Rendiconto821::IMPORTO_PAGATO_EXTRA,
			Rendiconto821::IMPORTO_IMPEGNATO_1,
			Rendiconto821::IMPORTO_IMPEGNATO_2,
			Rendiconto821::IMPORTO_IMPEGNATO_3,
			Rendiconto821::IMPORTO_IMPEGNATO_LEONARDO,
			Rendiconto821::IMPORTO_IMPEGNATO_EXTRA
		);
	}
}

class_exists('Scuola');

class Rendiconto821 extends Queried {
	use Rendiconto821Trait;
	use ScuolaTrait;

	const T                          = 'rendiconto821';
	const ID                         = 'rendiconto_ID';
	const READONLY                   = 'rendiconto_readonly';
	const PROTOCOLLO                 = 'rendiconto_protocollo';
	const IMPEGNO                    = 'rendiconto_impegno';
	const DESCRIPTION                = 'rendiconto_description';
	const IMPORTO_EXTRA_DESCRIPTION  = 'rendiconto_importo_extra_description';
	const IMPORTO_PAGATO_1           = 'rendiconto_importo_pagato_1';
	const IMPORTO_PAGATO_2           = 'rendiconto_importo_pagato_2';
	const IMPORTO_PAGATO_3           = 'rendiconto_importo_pagato_3';
	const IMPORTO_PAGATO_LEONARDO    = 'rendiconto_importo_pagato_leonardo';
	const IMPORTO_PAGATO_EXTRA       = 'rendiconto_importo_pagato_extra';
	const IMPORTO_IMPEGNATO_1        = 'rendiconto_importo_impegnato_1';
	const IMPORTO_IMPEGNATO_2        = 'rendiconto_importo_impegnato_2';
	const IMPORTO_IMPEGNATO_3        = 'rendiconto_importo_impegnato_3';
	const IMPORTO_IMPEGNATO_LEONARDO = 'rendiconto_importo_impegnato_leonardo';
	const IMPORTO_IMPEGNATO_EXTRA    = 'rendiconto_importo_impegnato_extra';
	const EDIZIONI_PREVISTE          = 'rendiconto_edizioni_previste';
	const EDIZIONI_REALIZZATE        = 'rendiconto_edizioni_realizzate';
	const EDIZIONI_REALIZZARE        = 'rendiconto_edizioni_realizzare';
	const REVISORE                   = 'rendiconto_revisore';
	const SCUOLA                     = 'scuola_ID';

	const ID_                        = self::T . DOT . self::ID;
	const SCUOLA_                    = self::T . DOT . self::SCUOLA;

	function __construct() {
		$this->normalizeRendiconto821();
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
