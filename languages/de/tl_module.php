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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['sc_modules'] = array('Eingebundene Module', 'Wenn JavaScript deaktiviert ist, speichern Sie unbedingt Ihre Änderungen, bevor Sie die Reihenfolge ändern.');
$GLOBALS['TL_LANG']['tl_module']['sc_gap'] = array('Spaltenabstand', 'Der Spaltenabstand gibt in Pixel an, wie viel Platz zwischen zwei Spalten sein soll. Der Standartwert ist auf 12px gesetzt.');
$GLOBALS['TL_LANG']['tl_module']['sc_gapdefault'] = array('Spaltenabstand nutzen', 'Soll ein Spaltenabstand gesetzt werden?');
$GLOBALS['TL_LANG']['tl_module']['sc_type'] = array('Spaltenset Typ', 'Wieviele Spalten, mit welchen Breiten soll es geben?<br />Die Zahlen geben die Breite in % an: 25x75 => erste Spalte 25%, zweit Spalte 75% des umschliessenden Containers.');
$GLOBALS['TL_LANG']['tl_module']['sc_equalize'] = array('gleiche Spaltenhöhe', 'Diese Option setzt alle Spalten auf die Höhe der längsten Spalte. Dies kann sinnvoll genutzt werden, wenn man z.B. Hintergrundgrafiken nutzen möchte.<br />Ein Beispiel findet man auf den Seiten des <a href="http://www.yaml.de/fileadmin/examples/06_layouts_advanced/equal_height_boxes.html" onclick="window.open(this.href); return false;" title="YAML-Framework">YAML-Frameworks</a>.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_module']['subcolumns_legend']   = 'Spaltenset Auswahl';
$GLOBALS['TL_LANG']['tl_module']['subcolumns_settings_legend'] = 'Spaltenset Einstellungen';
$GLOBALS['TL_LANG']['tl_module']['module']       = array('Modul','');
$GLOBALS['TL_LANG']['tl_module']['column']       = array('Spalte','');
?>