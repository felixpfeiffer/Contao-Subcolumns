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
	'FelixPfeiffer\Subcolumns\colsetEnd'        => 'system/modules/Subcolumns/colsetEnd.php',
	'FelixPfeiffer\Subcolumns\colsetPart'       => 'system/modules/Subcolumns/colsetPart.php',
	'FelixPfeiffer\Subcolumns\colsetStart'      => 'system/modules/Subcolumns/colsetStart.php',
	'FormColEnd'                                => 'system/modules/Subcolumns/FormColEnd.php',
	'FormColPart'                               => 'system/modules/Subcolumns/FormColPart.php',
	'FormColStart'                              => 'system/modules/Subcolumns/FormColStart.php',
	'FelixPfeiffer\Subcolumns\ModuleSubcolumns' => 'system/modules/Subcolumns/ModuleSubcolumns.php',
	'tl_subcolumnsCallback'                     => 'system/modules/Subcolumns/tl_subcolumnsCallback.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_colsetEnd'   => 'system/modules/Subcolumns/templates',
	'ce_colsetPart'  => 'system/modules/Subcolumns/templates',
	'ce_colsetStart' => 'system/modules/Subcolumns/templates',
	'form_colset'    => 'system/modules/Subcolumns/templates',
	'mod_subcolumns' => 'system/modules/Subcolumns/templates',
));
