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
$GLOBALS['TL_LANG']['FFL']['formcolstart']    = array('Spaltenset-Startelement', 'Startelement eines Spalten-Sets.');
$GLOBALS['TL_LANG']['FFL']['formcolpart']    = array('Spaltenset-Trennelement', 'Trennelement zwischen zwei Spalten.');
$GLOBALS['TL_LANG']['FFL']['formcolend']    = array('Spaltenset-Endelement', 'Endelement des Spaltensets.');


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_form_field']['fsc_type']        = array('Spaltenset', 'Bitte wählen Sie die Spaltenaufteilung.');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_name']        = array('Spaltenset-Name', 'Bitte geben Sie einen internen Namen für das Spaltenset ein. Alternativ wird dieser vom System erzeugt.');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_gapuse']      = array('Spaltenabstand nutzen', 'Möchten Sie einen Abstand zwischen den Spalten verwenden?');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_gap']         = array('Spaltenabstand', 'Geben Sie einen Spaltenabstand in Pixeln ein (die Einheit px nicht angeben). Der Standard-Wert ist 12px.');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_equalize']    = array('Gleich hohe Spalten', 'Wählen Sie, ob die Spalten die gleiche Höhe haben sollen (z.B. beim Einsatz von Hintergrundfarben).');
$GLOBALS['TL_LANG']['tl_form_field']['fsc_color']       = array('Backend-Farbe', 'Sie können eine Signalfarbe wählen, mit der alle Elemente dieses Spaltensets in der Backendansicht farblich gekennzeichnet werden.');

/**
 * Legend
**/
$GLOBALS['TL_LANG']['tl_form_field']['colsettings_legend'] = 'Spalten-Einstellungen';

?>