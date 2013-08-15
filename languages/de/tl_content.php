<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 *
 * The TYPOlight webCMS is an accessible web content management system that 
 * specializes in accessibility and generates W3C-compliant HTML code. It 
 * provides a wide range of functionality to develop professional websites 
 * including a built-in search engine, form generator, file and user manager, 
 * CSS engine, multi-language support and many more. For more information and 
 * additional TYPOlight applications like the TYPOlight MVC Framework please 
 * visit the project website http://www.typolight.org.
 *
 * Language file for table tl_content (de).
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
$GLOBALS['TL_LANG']['tl_content']['sc_name'] = array('Spaltenset Name', 'Darüber werden die Teile des Spaltensets einander zugeordnet.');
$GLOBALS['TL_LANG']['tl_content']['sc_gap'] = array('Spaltenabstand', 'Der Spaltenabstand gibt in Pixel an, wie viel Platz zwischen zwei Spalten sein soll. Der Standartwert ist auf 12px gesetzt.');
$GLOBALS['TL_LANG']['tl_content']['sc_gapdefault'] = array('Spaltenabstand nutzen', 'Soll ein Spaltenabstand gesetzt werden?');
$GLOBALS['TL_LANG']['tl_content']['sc_type'] = array('Spaltenset Typ', 'Wieviele Spalten, mit welchen Breiten soll es geben?<br />Die Zahlen geben die Breite in % an: 25x75 => erste Spalte 25%, zweit Spalte 75% des umschliessenden Containers.');
$GLOBALS['TL_LANG']['tl_content']['sc_equalize'] = array('gleiche Spaltenhöhe', 'Diese Option setzt alle Spalten auf die Höhe der längsten Spalte. Dies kann sinnvoll genutzt werden, wenn man z.B. Hintergrundgrafiken nutzen möchte.<br />Ein Beispiel findet man auf den Seiten des <a href="http://www.yaml.de/fileadmin/examples/06_layouts_advanced/equal_height_boxes.html" onclick="window.open(this.href); return false;" title="YAML-Framework">YAML-Frameworks</a>.');
$GLOBALS['TL_LANG']['tl_content']['sc_color'] = array('Backend-Farbe', 'Sie können eine Signalfarbe wählen, mit der alle Elemente dieses Spaltensets in der Backendansicht farblich gekennzeichnet werden.');
$GLOBALS['TL_LANG']['tl_content']['sc_parent'] = array('Elternelement', '');
$GLOBALS['TL_LANG']['tl_content']['sc_childs'] = array('Kindelemente', '');
$GLOBALS['TL_LANG']['tl_content']['sc_sortid'] = array('Sortierung im Spaltenset', '');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['colset_legend']      = 'Spaltenset Einstellungen';
$GLOBALS['TL_LANG']['tl_content']['colheight_legend']      = 'Spaltenhöhe';



?>