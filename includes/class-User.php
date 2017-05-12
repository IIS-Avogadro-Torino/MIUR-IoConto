<?php
# Formazione MIUR content management system
# Copyright (C) 2015, 2016, 2017 Valerio Bozzolan, Ivan Bertotto, ITIS Avogadro
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

trait UserTrait {
	function getUserID() {
		return $this->nonnull(User::ID);
	}

	function getUserUID() {
		return $this->nonnull(User::UID);
	}

	function getUserEmail() {
		return $this->get(User::EMAIL);
	}

	function isUserActive() {
		return $this->get(User::ACTIVE);
	}

	function hasNotPersonalEmail() {
		return $this->getUserEmail() !== $this->get(User::EMAIL_OFFICIAL);
	}

	function getUserOrganicoID() {
		return $this->get(User::ORGANICO);
	}

	function userHasOrganico() {
		return $this->getUserOrganicoID();
	}

	function updateUser($fields) {
		query_update(User::T, $fields, sprintf(
			'%s = %d',
			User::ID, $this->getUserID()
		) );
	}
}

class User extends Sessionuser {
	use userTrait;

	const T   = 'user';
	const ID  = 'user_ID';
	const UID = 'user_uid';
	const ORGANICO = 'organico_ID';
	const ACTIVE = 'user_active';
	const TOKEN = 'user_token';
	const PASSWORD = 'user_password';
	const EMAIL = 'user_email';
	const EMAIL_OFFICIAL = 'user_email_official';

	const ID_       = self::T . DOT . self::ID;
	const ORGANICO_ = self::T . DOT . self::ORGANICO;

	const FIRM = 'user_firm';

	function __construct() {
		$this->integers(self::ID, self::ORGANICO);
	}

	static function factory() {
		return Query::factory(__CLASS__)->from(self::T);
	}

	static function factoryByUID($uid) {
		return self::factory()->whereStr(self::UID, $uid);
	}
}
