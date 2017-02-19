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

trait UserTrait {
	function getUserID() {
		return $this->nonnull('user_ID');
	}

	function getUserEmail() {
		return $this->getUserUID();
	}

	function getUserUID() {
		return $this->nonnull('user_uid');
	}

	function isUserActive() {
		return $this->get('user_active');
	}

	function getUserScuolaID() {
		return $this->get('scuola_ID');
	}

	function userHasScuola() {
		return $this->getUserScuolaID();
	}

	private function queryUserScuola() {
		return ScuolaFull::queryByID( $this->getUserScuolaID() );
	}
}

class_exists('Queried');

class User extends Sessionuser {
	use QueriedTrait;
	use userTrait;

	const T   = 'user';
	const ID  = 'user.user_ID';
	const UID = 'user_uid';

	static function forceHavingSchool() {
		if( is_logged() && get_user()->userHasScuola() ) {
			return get_user()->queryUserScuola();
		}
		die_asking_permissions();
	}
}
