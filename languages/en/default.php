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
 * Default language file (en).
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
$GLOBALS['TL_LANG']['CTE']['subcolumn'] = 'Column-Set';
$GLOBALS['TL_LANG']['CTE']['subcolumns'] = array('Column-Set','<img src="system/modules/Subcolumns/assets/example_de.png" alt="Example for Column-Sets" style="float:right;" />Column-Sets offer the possibility to add a set of columns into your layout. These can even be cascading sets.');
$GLOBALS['TL_LANG']['CTE']['colsetStart'] = array('Column-Set Start','The start-element is definig the colset.<br />If you change the number of columns or the width of them, these options will be automatically added to the other elements linked to this colset.<br />If you change the number of columns - i.e. from two to three - a second part-element will be added. When changing from three to two columns, the last element will be erased and the content of the third column will be displayed under the colset.');
$GLOBALS['TL_LANG']['CTE']['colsetPart'] = array('Column-Set Part-element','You can\'t change any option of the colset within this content-element.<br /> IMPORTANT: IF YOU ERASE THIS CONTENT-ELEMENT, THE OTHER ELEMENTS LINKED WITH THIS COLUMN-SET WILL BE ERASED ASWELL!!');
$GLOBALS['TL_LANG']['CTE']['colsetEnd'] = array('Column-Set End-element','You can\'t change any option of the colset within this content-element.<br /> IMPORTANT: IF YOU ERASE THIS CONTENT-ELEMENT, THE OTHER ELEMENTS LINKED WITH THIS COLUMN-SET WILL BE ERASED ASWELL!!');

$GLOBALS['TL_LANG']['MSC']['contentAfter'] = 'Place all content for the %s column after this element.';

$GLOBALS['TL_LANG']['MSC']['sc_first'] = 'first';
$GLOBALS['TL_LANG']['MSC']['sc_second'] = 'second';
$GLOBALS['TL_LANG']['MSC']['sc_third'] = 'third';
$GLOBALS['TL_LANG']['MSC']['sc_fourth'] = 'fourth';
$GLOBALS['TL_LANG']['MSC']['sc_fifth'] = 'fifth';
?>