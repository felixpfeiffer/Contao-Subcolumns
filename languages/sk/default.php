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
 * Default language file (sk).
 *
 * PHP version 5
 * @copyright  2008
 * @author     Martin Kacvinsky <kacvinsky@bintree.sk>
 * @package    subcolumns v 0.6 
 * @license    GPL 
 * @filesource
 */



/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['CTE']['subcolumn'] = 'Stĺpce';
$GLOBALS['TL_LANG']['CTE']['subcolumns'] = array('Stĺpce','<img src="system/modules/Subcolumns/assets/example_de.png" alt="Example for Column-Sets" style="float:right;" />Stĺpce ponúkajú možnosť formátovať obsah do stĺpcov.');
$GLOBALS['TL_LANG']['CTE']['colsetStart'] = array('Stĺpce - Začiatok','Začiatočný element definuje celé zoskupenie stĺpcov.<br />Ak zmeníte nastavenie, alebo počet stĺpcov u tohto elementu, automaticky sa vygenerujú všetky ďaľšie potrebné predelovače.');
$GLOBALS['TL_LANG']['CTE']['colsetPart'] = array('Stĺpce - Predelovač','Nemá žiadne nastavenia, znázorňuje predelovač stĺpcov.<br />UPOZORNENIE: AK ZMAŽETE TENTO ELEMENT, ZMAŽÚ SA AJ VŠETKY OSTATNĚ ELEMENTY NALINKOVANÉ NA TENTO.');
$GLOBALS['TL_LANG']['CTE']['colsetEnd'] = array('Stĺpce - Koniec','Nemá žiadne nastavenia, znázorňuje ukončenie stĺpcov.<br /> UPOZORNENIE: AK ZMAŽETE TENTO ELEMENT, ZMAŽÚ SA AJ VŠETKY OSTATNĚ ELEMENTY NALINKOVANÉ NA TENTO.');

$GLOBALS['TL_LANG']['MSC']['contentAfter'] = 'Vložte všetok obsah %s stĺpca za tento element.';

$GLOBALS['TL_LANG']['MSC']['sc_first'] = 'prvého';
$GLOBALS['TL_LANG']['MSC']['sc_second'] = 'druhého';
$GLOBALS['TL_LANG']['MSC']['sc_third'] = 'tretieho';
$GLOBALS['TL_LANG']['MSC']['sc_fourth'] = 'štvrtého';
$GLOBALS['TL_LANG']['MSC']['sc_fifth'] = 'piaty';
?>