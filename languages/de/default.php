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
 * Default language file (de).
 *
 * PHP version 5
 * @copyright  Felix Pfeiffer : Neue Medien 2007 - 2012
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 * @license    CC-A 2.0
 * @filesource
 */


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['CTE']['subcolumn'] = 'Spaltenset';
$GLOBALS['TL_LANG']['CTE']['subcolumns'] = array('Spaltenset','<img src="system/modules/Subcolumns/assets/example_de.png" alt="Beispiel für Spaltensets" style="float:right;" />Spaltensets ermöglichen es mehrere Spalten in das Layout einzufügen. Diese können dabei auch ineinander verschachtelt sein.');
$GLOBALS['TL_LANG']['CTE']['colsetStart'] = array('Spaltenset Start','Über das Startelement werden die Spaltensets definiert.<br />Beim Ändern der Spaltenzahl bzw. -breite, wird diese automatisch auf die Kindelemente übertragen.<br />Wird von einem zweispaltigen auf das Dreispaltige Layout gewechselt, wird automatisch ein Container hinzugefügt. Wird vom dreispaltigen auf ein zweispaltiges Layout gewechselt, wird autopmatisch ein Container gelöscht und der Inhalt des letzten Containers unter dem Spaltenset dargestellt.');
$GLOBALS['TL_LANG']['CTE']['colsetPart'] = array('Spaltenset Trennelemente','Hier können Sie keine Änderungen am Spaltenset vornehmen.<br /> WICHTIG: WIRD DIESES ELEMENT GELÖSCHT; WIRD AUCH DAS GESAMTE SPALTENSET GELÖSCHT!!');
$GLOBALS['TL_LANG']['CTE']['colsetEnd'] = array('Spaltenset Endelement','Hier können Sie keine Änderungen am Spaltenset vornehmen.<br /> WICHTIG: WIRD DIESES ELEMENT GELÖSCHT; WIRD AUCH DAS GESAMTE SPALTENSET GELÖSCHT!!');

$GLOBALS['TL_LANG']['MSC']['contentAfter'] = 'Inhalt für die %s Spalte nach diesem Element einfügen.';

$GLOBALS['TL_LANG']['MSC']['sc_first'] = 'erste';
$GLOBALS['TL_LANG']['MSC']['sc_second'] = 'zweite';
$GLOBALS['TL_LANG']['MSC']['sc_third'] = 'dritte';
$GLOBALS['TL_LANG']['MSC']['sc_fourth'] = 'vierte';
$GLOBALS['TL_LANG']['MSC']['sc_fifth'] = 'fünfte';


$GLOBALS['TL_LANG']['MSC']['sets']['yaml3'] = 'YAML3';
$GLOBALS['TL_LANG']['MSC']['sets']['yaml4'] = 'YAML4';

?>