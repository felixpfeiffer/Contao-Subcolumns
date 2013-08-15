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
 * This is the subcolumns configuration file.
 *
 * PHP version 5
 * @copyright  Felix Pfeiffer : Neue Medien 2007 - 2012
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 * @license    CC-A 2.0
 * @filesource
 */
 
/**
 * -------------------------------------------------------------------------
 * CONTENT ELEMENTS
 * -------------------------------------------------------------------------
 */

$GLOBALS['TL_CTE']['subcolumn'] = array(
	'colsetStart' => 'Subcolumns\\colsetStart',
	'colsetPart' => 'Subcolumns\\colsetPart',
	'colsetEnd' => 'Subcolumns\\colsetEnd'
);


array_insert($GLOBALS['FE_MOD']['application'], 4, array
(
	'subcolumns' => 'Subcolumns\\ModuleSubcolumns'
));

/**
 * Form fields
 */
$GLOBALS['TL_FFL']['formcolstart'] = 'Subcolumns\\FormColStart';
$GLOBALS['TL_FFL']['formcolpart'] = 'Subcolumns\\FormColPart';
$GLOBALS['TL_FFL']['formcolend'] = 'Subcolumns\\FormColEnd';

/**
 * Hooks
 */
#$GLOBALS['TL_HOOKS']['clipboardContentTitle'][] = array('SemanticHTML5Helper', 'clipboardContentTitle');
$GLOBALS['TL_HOOKS']['clipboardCopy'][] = array('tl_content_sc', 'clipboardCopy');
$GLOBALS['TL_HOOKS']['clipboardCopyAll'][] = array('tl_subcolumnsCallback', 'clipboardCopyAll');


/**
 * Einrücken von Elementen
 */
$GLOBALS['TL_WRAPPERS']['start'][] = 'colsetStart';
$GLOBALS['TL_WRAPPERS']['seperator'][] = 'colsetPart';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'colsetEnd';



/**
 * Spaltensets
 **/
$GLOBALS['TL_SUBCL'] = array(
	'yaml3' => array(
		'label'		=> 'YAML 3 Standard', // Label for the selectmenu
		'scclass' 	=> 'subcolumns', // Class for the wrapping container
		'equalize' 	=> 'equalize', // Is a equilize heights class included and what is it's name?
		'inside' 	=> true, // Are inside containers used?
		'gap' 		=> true, // A gap between the columns can be entered in backend
		'files' 	=> array( // Enter the location of the css files
			'css'		=> 'system/modules/Subcolumns/assets/yaml3/subcols.css',
			'ie'		=> 'system/modules/Subcolumns/assets/yaml3/subcolsIEHacks.css'
		), 
		/*
		 * Define the sets that can be used as an array.
		 * Each array contains two or more arrays with the definition for the single columns.
		 * The key is used as the label in the select menu.
		 * Example: '50x50' => array(array([class(es) for the first column],[optional classes for the inside container]),array([class(es) for the second column],[optional classes for the inside container]))
		 */
		'sets'		=> array(
			'20x20x20x20x20' => array(array('c20l','subcl'),array('c20l','subc'),array('c20l','subc'),array('c20l','subc'),array('c20r','subcr')),
			'25x25x25x25' => array(array('c25l','subcl'),array('c25l','subc'),array('c25l','subc'),array('c25r','subcr')),
			'50x16x16x16' => array(array('c50l','subcl'),array('c16l','subc'),array('c16l','subc'),array('c16r','subcr')),
			'33x33x33' => array(array('c33l','subcl'),array('c33l','subc'),array('c33r','subcr')),
			'50x25x25' => array(array('c50l','subcl'),array('c25l','subc'),array('c25r','subcr')),
			'25x50x25' => array(array('c25l','subcl'),array('c50l','subc'),array('c25r','subcr')),
			'25x25x50' => array(array('c25l','subcl'),array('c25l','subc'),array('c50r','subcr')),
			'40x30x30' => array(array('c40l','subcl'),array('c30l','subc'),array('c30r','subcr')),
			'30x40x30' => array(array('c30l','subcl'),array('c40l','subc'),array('c30r','subcr')),
			'30x30x40' => array(array('c30l','subcl'),array('c30l','subc'),array('c40r','subcr')),
			'20x40x40' => array(array('c20l','subcl'),array('c40l','subc'),array('c40r','subcr')),
			'40x20x40' => array(array('c40l','subcl'),array('c20l','subc'),array('c40r','subcr')),
			'40x40x20' => array(array('c40l','subcl'),array('c40l','subc'),array('c20r','subcr')),
			'85x15' => array(array('c85l','subcl'),array('c15r','subcr')),
			'80x20' => array(array('c80l','subcl'),array('c20r','subcr')),
			'75x25' => array(array('c75l','subcl'),array('c25r','subcr')),
			'70x30' => array(array('c70l','subcl'),array('c30r','subcr')),
			'66x33' => array(array('c66l','subcl'),array('c33r','subcr')),
			'62x38' => array(array('c62l','subcl'),array('c38r','subcr')),
			'60x40' => array(array('c60l','subcl'),array('c40r','subcr')),
			'55x45' => array(array('c55l','subcl'),array('c45r','subcr')),
			'50x50' => array(array('c50l','subcl'),array('c50r','subcr')),
			'45x55' => array(array('c45l','subcl'),array('c55r','subcr')),
			'40x60' => array(array('c40l','subcl'),array('c60r','subcr')),
			'38x62' => array(array('c38l','subcl'),array('c62r','subcr')),
			'33x66' => array(array('c33l','subcl'),array('c66r','subcr')),
			'30x70' => array(array('c30l','subcl'),array('c70r','subcr')),
			'25x75' => array(array('c25l','subcl'),array('c75r','subcr')),
			'20x80' => array(array('c20l','subcl'),array('c80r','subcr')),
			'15x85' => array(array('c15l','subcl'),array('c85r','subcr'))
		)
	),
	'yaml3_additional' => array(
		'label'		=> 'YAML 3 Erweitert',
		'scclass' 	=> 'subcolumns',
		'equalize' 	=> 'equalize',
		'inside' 	=> true,
		'gap' 		=> true,
		'files' 	=> array(
			'css'		=> 'system/modules/Subcolumns/assets/yaml3/subcols_extended.css',
			'ie'		=> 'system/modules/Subcolumns/assets/yaml3/subcolsIEHacks_extended.css'
		),
		'sets'		=> array(
			'20x20x20x20x20' => array(array('c20l','subcl'),array('c20l','subc'),array('c20l','subc'),array('c20l','subc'),array('c20r','subcr')),
			'25x25x25x25' => array(array('c25l','subcl'),array('c25l','subc'),array('c25l','subc'),array('c25r','subcr')),
			'50x16x16x16' => array(array('c50l','subcl'),array('c16l','subc'),array('c16l','subc'),array('c16r','subcr')),
			'33x33x33' => array(array('c33l','subcl'),array('c33l','subc'),array('c33r','subcr')),
			'50x25x25' => array(array('c50l','subcl'),array('c25l','subc'),array('c25r','subcr')),
			'25x50x25' => array(array('c25l','subcl'),array('c50l','subc'),array('c25r','subcr')),
			'25x25x50' => array(array('c25l','subcl'),array('c25l','subc'),array('c50r','subcr')),
			'40x30x30' => array(array('c40l','subcl'),array('c30l','subc'),array('c30r','subcr')),
			'30x40x30' => array(array('c30l','subcl'),array('c40l','subc'),array('c30r','subcr')),
			'30x30x40' => array(array('c30l','subcl'),array('c30l','subc'),array('c40r','subcr')),
			'20x40x40' => array(array('c20l','subcl'),array('c40l','subc'),array('c40r','subcr')),
			'40x20x40' => array(array('c40l','subcl'),array('c20l','subc'),array('c40r','subcr')),
			'40x40x20' => array(array('c40l','subcl'),array('c40l','subc'),array('c20r','subcr')),
			'85x15' => array(array('c85l','subcl'),array('c15r','subcr')),
			'80x20' => array(array('c80l','subcl'),array('c20r','subcr')),
			'75x25' => array(array('c75l','subcl'),array('c25r','subcr')),
			'70x30' => array(array('c70l','subcl'),array('c30r','subcr')),
			'66x33' => array(array('c66l','subcl'),array('c33r','subcr')),
			'62x38' => array(array('c62l','subcl'),array('c38r','subcr')),
			'60x40' => array(array('c60l','subcl'),array('c40r','subcr')),
			'55x45' => array(array('c55l','subcl'),array('c45r','subcr')),
			'50x50' => array(array('c50l','subcl'),array('c50r','subcr')),
			'45x55' => array(array('c45l','subcl'),array('c55r','subcr')),
			'40x60' => array(array('c40l','subcl'),array('c60r','subcr')),
			'38x62' => array(array('c38l','subcl'),array('c62r','subcr')),
			'33x66' => array(array('c33l','subcl'),array('c66r','subcr')),
			'30x70' => array(array('c30l','subcl'),array('c70r','subcr')),
			'25x75' => array(array('c25l','subcl'),array('c75r','subcr')),
			'20x80' => array(array('c20l','subcl'),array('c80r','subcr')),
			'15x85' => array(array('c15l','subcl'),array('c85r','subcr'))
		)
	),
	'yaml4' => array(
		'label'		=> 'YAML 4 Standard',
		'scclass' => 'ym-grid',
		'equalize' => 'ym-equalize',
		'inside' => true,
		'gap' => true,
		'files' => array(
			'css'		=> 'system/modules/Subcolumns/assets/yaml4/subcols.css',
			'ie'		=> 'system/modules/Subcolumns/assets/yaml4/subcolsIEHacks.css'
		),
		'sets'=> array(
			'20x20x20x20x20' => array(array('ym-g20 ym-gl','ym-gbox-left'),array('ym-g20 ym-gl','ym-gbox'),array('ym-g20 ym-gl','ym-gbox'),array('ym-g20 ym-gl','ym-gbox'),array('ym-g20 ym-gr','ym-gbox-right')),
			'50x16x16x16' => array(array('ym-g50 ym-gl','ym-gbox-left'),array('ym-g16 ym-gl','ym-gbox'),array('ym-g16 ym-gl','ym-gbox'),array('ym-g16 ym-gr','ym-gbox-right')),
			'25x25x25x25' => array(array('ym-g25 ym-gl','ym-gbox-left'),array('ym-g25 ym-gl','ym-gbox'),array('ym-g25 ym-gl','ym-gbox'),array('ym-g25 ym-gr','ym-gbox-right')),
			'25x25x50' => array(array('ym-g25 ym-gl','ym-gbox-left'),array('ym-g25 ym-gl','ym-gbox'),array('ym-g50 ym-gr','ym-gbox-right')),
			'25x50x25' => array(array('ym-g25 ym-gl','ym-gbox-left'),array('ym-g50 ym-gl','ym-gbox'),array('ym-g25 ym-gr','ym-gbox-right')),
			'50x25x25' => array(array('ym-g50 ym-gl','ym-gbox-left'),array('ym-g25 ym-gl','ym-gbox'),array('ym-g25 ym-gr','ym-gbox-right')),
			'40x40x20' => array(array('ym-g40 ym-gl','ym-gbox-left'),array('ym-g40 ym-gl','ym-gbox'),array('ym-g20 ym-gr','ym-gbox-right')),
			'40x20x40' => array(array('ym-g40 ym-gl','ym-gbox-left'),array('ym-g20 ym-gl','ym-gbox'),array('ym-g40 ym-gr','ym-gbox-right')),
			'20x40x40' => array(array('ym-g20 ym-gl','ym-gbox-left'),array('ym-g40 ym-gl','ym-gbox'),array('ym-g40 ym-gr','ym-gbox-right')),
			'33x33x33' => array(array('ym-g33 ym-gl','ym-gbox-left'),array('ym-g33 ym-gl','ym-gbox'),array('ym-g33 ym-gr','ym-gbox-right')),
			'85x15' => array(array('ym-g85 ym-gl','ym-gbox-left'),array('ym-g15 ym-gr','ym-gbox-right')),
			'80x20' => array(array('ym-g80 ym-gl','ym-gbox-left'),array('ym-g20 ym-gr','ym-gbox-right')),
			'75x25' => array(array('ym-g75 ym-gl','ym-gbox-left'),array('ym-g25 ym-gr','ym-gbox-right')),
			'70x30' => array(array('ym-g70 ym-gl','ym-gbox-left'),array('ym-g30 ym-gr','ym-gbox-right')),
			'66x33' => array(array('ym-g66 ym-gl','ym-gbox-left'),array('ym-g33 ym-gr','ym-gbox-right')),
			'65x35' => array(array('ym-g65 ym-gl','ym-gbox-left'),array('ym-g35 ym-gr','ym-gbox-right')),
			'60x40' => array(array('ym-g60 ym-gl','ym-gbox-left'),array('ym-g40 ym-gr','ym-gbox-right')),
			'55x45' => array(array('ym-g55 ym-gl','ym-gbox-left'),array('ym-g45 ym-gr','ym-gbox-right')),
			'50x50' => array(array('ym-g50 ym-gl','ym-gbox-left'),array('ym-g50 ym-gr','ym-gbox-right')),
			'45x55' => array(array('ym-g45 ym-gl','ym-gbox-left'),array('ym-g55 ym-gr','ym-gbox-right')),
			'40x60' => array(array('ym-g40 ym-gl','ym-gbox-left'),array('ym-g60 ym-gr','ym-gbox-right')),
			'35x65' => array(array('ym-g35 ym-gl','ym-gbox-left'),array('ym-g65 ym-gr','ym-gbox-right')),
			'33x66' => array(array('ym-g33 ym-gl','ym-gbox-left'),array('ym-g66 ym-gr','ym-gbox-right')),
			'30x70' => array(array('ym-g30 ym-gl','ym-gbox-left'),array('ym-g70 ym-gr','ym-gbox-right')),
			'25x75' => array(array('ym-g25 ym-gl','ym-gbox-left'),array('ym-g75 ym-gr','ym-gbox-right')),
			'20x80' => array(array('ym-g20 ym-gl','ym-gbox-left'),array('ym-g80 ym-gr','ym-gbox-right')),
			'15x85' => array(array('ym-g15 ym-gl','ym-gbox-left'),array('ym-g85 ym-gr','ym-gbox-right'))
		)
	),
	'yaml4_additional' => array(
		'label'		=> 'YAML 4 Erweitert',
		'scclass' => 'ym-grid',
		'equalize' => 'ym-equalize',
		'inside' => true,
		'gap' => true,
		'files' => array(
			'css'		=> 'system/modules/Subcolumns/assets/yaml4/subcols_extended.css'
		),
		'sets'=> array(
            '20x20x20x20x20' => array(array('ym-g20 ym-gl','ym-gbox-left'),array('ym-g20 ym-gl','ym-gbox'),array('ym-g20 ym-gl','ym-gbox'),array('ym-g20 ym-gl','ym-gbox'),array('ym-g20 ym-gr','ym-gbox-right')),
            '50x16x16x16' => array(array('ym-g50 ym-gl','ym-gbox-left'),array('ym-g16 ym-gl','ym-gbox'),array('ym-g16 ym-gl','ym-gbox'),array('ym-g16 ym-gr','ym-gbox-right')),
            '25x25x25x25' => array(array('ym-g25 ym-gl','ym-gbox-left'),array('ym-g25 ym-gl','ym-gbox'),array('ym-g25 ym-gl','ym-gbox'),array('ym-g25 ym-gr','ym-gbox-right')),
            '25x25x50' => array(array('ym-g25 ym-gl','ym-gbox-left'),array('ym-g25 ym-gl','ym-gbox'),array('ym-g50 ym-gr','ym-gbox-right')),
            '25x50x25' => array(array('ym-g25 ym-gl','ym-gbox-left'),array('ym-g50 ym-gl','ym-gbox'),array('ym-g25 ym-gr','ym-gbox-right')),
            '50x25x25' => array(array('ym-g50 ym-gl','ym-gbox-left'),array('ym-g25 ym-gl','ym-gbox'),array('ym-g25 ym-gr','ym-gbox-right')),
            '40x40x20' => array(array('ym-g40 ym-gl','ym-gbox-left'),array('ym-g40 ym-gl','ym-gbox'),array('ym-g20 ym-gr','ym-gbox-right')),
            '40x20x40' => array(array('ym-g40 ym-gl','ym-gbox-left'),array('ym-g20 ym-gl','ym-gbox'),array('ym-g40 ym-gr','ym-gbox-right')),
            '20x40x40' => array(array('ym-g20 ym-gl','ym-gbox-left'),array('ym-g40 ym-gl','ym-gbox'),array('ym-g40 ym-gr','ym-gbox-right')),
            '33x33x33' => array(array('ym-g33 ym-gl','ym-gbox-left'),array('ym-g33 ym-gl','ym-gbox'),array('ym-g33 ym-gr','ym-gbox-right')),
            '85x15' => array(array('ym-g85 ym-gl','ym-gbox-left'),array('ym-g15 ym-gr','ym-gbox-right')),
            '80x20' => array(array('ym-g80 ym-gl','ym-gbox-left'),array('ym-g20 ym-gr','ym-gbox-right')),
            '75x25' => array(array('ym-g75 ym-gl','ym-gbox-left'),array('ym-g25 ym-gr','ym-gbox-right')),
            '70x30' => array(array('ym-g70 ym-gl','ym-gbox-left'),array('ym-g30 ym-gr','ym-gbox-right')),
            '66x33' => array(array('ym-g66 ym-gl','ym-gbox-left'),array('ym-g33 ym-gr','ym-gbox-right')),
            '65x35' => array(array('ym-g65 ym-gl','ym-gbox-left'),array('ym-g35 ym-gr','ym-gbox-right')),
            '60x40' => array(array('ym-g60 ym-gl','ym-gbox-left'),array('ym-g40 ym-gr','ym-gbox-right')),
            '55x45' => array(array('ym-g55 ym-gl','ym-gbox-left'),array('ym-g45 ym-gr','ym-gbox-right')),
            '50x50' => array(array('ym-g50 ym-gl','ym-gbox-left'),array('ym-g50 ym-gr','ym-gbox-right')),
            '45x55' => array(array('ym-g45 ym-gl','ym-gbox-left'),array('ym-g55 ym-gr','ym-gbox-right')),
            '40x60' => array(array('ym-g40 ym-gl','ym-gbox-left'),array('ym-g60 ym-gr','ym-gbox-right')),
            '35x65' => array(array('ym-g35 ym-gl','ym-gbox-left'),array('ym-g65 ym-gr','ym-gbox-right')),
            '33x66' => array(array('ym-g33 ym-gl','ym-gbox-left'),array('ym-g66 ym-gr','ym-gbox-right')),
            '30x70' => array(array('ym-g30 ym-gl','ym-gbox-left'),array('ym-g70 ym-gr','ym-gbox-right')),
            '25x75' => array(array('ym-g25 ym-gl','ym-gbox-left'),array('ym-g75 ym-gr','ym-gbox-right')),
            '20x80' => array(array('ym-g20 ym-gl','ym-gbox-left'),array('ym-g80 ym-gr','ym-gbox-right')),
            '15x85' => array(array('ym-g15 ym-gl','ym-gbox-left'),array('ym-g85 ym-gr','ym-gbox-right'))
		)
	)
);
?>