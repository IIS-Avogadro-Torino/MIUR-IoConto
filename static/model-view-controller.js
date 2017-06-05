/**************************************************************************
 * Generic JS Model-View Controller
 * Copyright (C) 2017 ITIS Avogadro, Ivan Bertotto, Valerio Bozzolan
 **************************************************************************
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Super speed implementation.
 */

$(document).ready( function () {
	$_modelViewControllerAdded = $_modelViewControllerAdded || function () {};

	$('.model-view-container .model-container').hide();

	/**
	 * Replicate the model
	 */
	var $_modelViewAutoincrement = 0;
	$(document).on('click', '.model-view-container .view-add', function () {
		var $cont  = $(this).closest('.model-view-container');
		var $model = $cont.find('.model-container').children().clone();

		$model.find('input').each(function () {
			var name = $(this).prop('name');
			name = name.replace('[]', '[' + $_modelViewAutoincrement + ']');
			$(this).prop('name', name);
		} );
		$_modelViewAutoincrement++;

		$model.addClass('view').hide();
		$cont.find('.view-container').append($model);
		$model.show('fast', $_modelViewControllerAdded );
	} );

	/**
	 * Delete the replicated model
	 */
	$(document).on('click', '.model-view-container .view-remove', function () {
		$(this).closest('.view').hide('slow', function () {
			$(this).remove();
		} );
	} );

	$('form').submit( function () {
		$('.model-view-container .model-container').remove();
	} );
} );
