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
 * Language file for table tl_content (en).
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
$GLOBALS['TL_LANG']['tl_content']['sc_name'] = array('Columnset Name', 'This name is used to link the parts of the colse together.');
$GLOBALS['TL_LANG']['tl_content']['sc_gap'] = array('Column gap', 'The column gap defines the space between two clumns in px. The default value is set to 12px.');
$GLOBALS['TL_LANG']['tl_content']['sc_gapdefault'] = array('Use column gap', 'Do you want to use a gap between the columns?');
$GLOBALS['TL_LANG']['tl_content']['sc_type'] = array('Columnset type', 'How many columns and what widths should be created?<br />The numbers give the width in percent: 25x75 => first column 25%, second column 75% of the parent-container.');
$GLOBALS['TL_LANG']['tl_content']['sc_equalize'] = array('Equal heights', 'This options sets all columns in a set to the height of the longest one. So you can use background images or borders.<br />An example for this feature can be found on the webpage of the <a href="http://www.yaml.de/fileadmin/examples/06_layouts_advanced/equal_height_boxes.html" onclick="window.open(this.href); return false;" title="YAML-Framework">YAML-framework</a>.');
$GLOBALS['TL_LANG']['tl_content']['sc_parent'] = array('Parent element', '');
$GLOBALS['TL_LANG']['tl_content']['sc_childs'] = array('Child elements', '');
$GLOBALS['TL_LANG']['tl_content']['sc_sortid'] = array('Sorting in the columnset', '');
/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['colset_legend']      = 'Columnset settings';
$GLOBALS['TL_LANG']['tl_content']['colheight_legend']      = 'Column height';

?>