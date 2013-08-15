<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Subcolumns
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'FelixPfeiffer',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'FelixPfeiffer\Subcolumns\colsetEnd'        => 'system/modules/Subcolumns/elements/colsetEnd.php',
	'FelixPfeiffer\Subcolumns\colsetPart'       => 'system/modules/Subcolumns/elements/colsetPart.php',
	'FelixPfeiffer\Subcolumns\colsetStart'      => 'system/modules/Subcolumns/elements/colsetStart.php',

	// Forms
	'FelixPfeiffer\Subcolumns\FormColEnd'       => 'system/modules/Subcolumns/forms/FormColEnd.php',
	'FelixPfeiffer\Subcolumns\FormColPart'      => 'system/modules/Subcolumns/forms/FormColPart.php',
	'FelixPfeiffer\Subcolumns\FormColStart'     => 'system/modules/Subcolumns/forms/FormColStart.php',

	// Modules
	'FelixPfeiffer\Subcolumns\ModuleSubcolumns' => 'system/modules/Subcolumns/modules/ModuleSubcolumns.php',
	'tl_subcolumnsCallback'                     => 'system/modules/Subcolumns/tl_subcolumnsCallback.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_subcolumns'  => 'system/modules/Subcolumns/templates',
	'ce_colsetEnd'   => 'system/modules/Subcolumns/templates',
	'ce_colsetPart'  => 'system/modules/Subcolumns/templates',
	'ce_colsetStart' => 'system/modules/Subcolumns/templates',
	'form_colset'    => 'system/modules/Subcolumns/templates',
	'mod_subcolumns' => 'system/modules/Subcolumns/templates',
));
