<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Felix Pfeiffer : Neue Medien 2007 - 2012
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 * @license    CC-A 2.0
 * @filesource
 */


/**
 * Form fields
 */
$GLOBALS['TL_LANG']['FFL']['formcolstart']    = array('Column set start', 'The opening element of a column set');
$GLOBALS['TL_LANG']['FFL']['formcolpart']    = array('Column set part element', 'The element between two columns.');
$GLOBALS['TL_LANG']['FFL']['formcolend']    = array('Column set end element', 'The last element of a column set.');


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_form_field']['fsc_type']           = array('Columns set', 'Select the type of the column set.');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_name']           = array('Name', 'Please enter a name for the columns set. If you don\'t enter a name, contao will create it by himself.');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_gapuse']           = array('Use a gap', 'Do you want to use a gap between two columns?');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_gap']           = array('Gap', 'Enter the gap between to columns in px. The standard value is 12px.');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_equalize']           = array('Equal heights', 'Check this box to use the calss equal heights for this columns set.');

/**
 * Legend
**/
$GLOBALS['TL_LANG']['tl_form_field']['colsettings_legend'] = 'Columns Settings';

?>