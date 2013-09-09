<?php

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
 * Add selectors to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][] = array('tl_module_sc','createPalette');


/**
 * Add fields to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['sc_type'] = array
(
	'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['sc_type'],
	'exclude'       	=> true,
	'inputType'     	=> 'select',
	'options_callback'	=> array('tl_module_sc','getAllTypes'),
	'eval'          	=> array('submitOnChange'=>true),
    'sql'               => "varchar(14) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sc_modules'] = array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_module']['sc_modules'],
	'exclude'       => true,
	'inputType'     => 'multiColumnWizard',
	'eval'			=> array(
		'columnFields'	=> array(
			'module'	=> array
			(
				'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['module'],
				'exclude'       	=> true,
				'inputType'     	=> 'select',
				'options_callback'	=> array('tl_module_sc','getAllModules')
			),
			'column'	=> array
			(
				'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['column'],
				'exclude'       	=> true,
				'inputType'     	=> 'select',
				'options_callback'	=> array('tl_module_sc','getColumns')
			)
		)
	),
    'sql'               => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sc_gap'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_module']['sc_gap'],
	'inputType'	=> 'text',
    'default'   => ($GLOBALS['TL_CONFIG']['subcolumns_gapdefault'] != '' ? $GLOBALS['TL_CONFIG']['subcolumns_gapdefault'] : 0),
	'eval'		=> array('maxlength'=>'4','regxp'=>'digit', 'tl_class'=>'w50'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sc_gapdefault'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_module']['sc_gapdefault'],
	'default'	=> 1,
	'inputType'	=> 'checkbox',
	'eval'		=> array('tl_class'=>'w50'),
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sc_equalize'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_module']['sc_equalize'],
	'inputType'	=> 'checkbox',
	'eval'		=> array('tl_class'=>'clr'),
    'sql'       => "char(1) NOT NULL default ''"
);

/**
 * Erweiterung für die tl_module-Klasse
 */
class tl_module_sc extends tl_module
{
	/*
	 * Create the palette for the startelement
	 */
	public function createPalette(DataContainer $dc)
	{	
		$strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
			
		$strGap = $GLOBALS['TL_SUBCL'][$strSet]['gap'] ? ',sc_gapdefault,sc_gap' : false;
		$strEquilize = $GLOBALS['TL_SUBCL'][$strSet]['equalize'] ? ',sc_equalize;' : false;
		
		$GLOBALS['TL_DCA']['tl_module']['palettes']['subcolumns'] = '{title_legend},name,headline,type;{subcolumns_legend},sc_type,sc_modules;'.($strGap || $strEquilize ? '{subcolumns_settings_legend}'.$strGap.$strEquilize.';':'').'{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
	}
	
	/* 
	 * Get the colsets depending on the selection from the settings
	 */
	public function getAllTypes()
	{
		$strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
		
		return array_keys($GLOBALS['TL_SUBCL'][$strSet]['sets']);
	}
	
	/* 
	 * Get all modules included in the same theme
	 */
	public function getAllModules()
	{
		$arrModules = array();
		$objModules = $this->Database->prepare("SELECT id, name FROM tl_module WHERE pid=(SELECT pid FROM tl_module WHERE id=?) AND id!=? ORDER BY name")->execute($this->Input->get('id'),$this->Input->get('id'));

		while ($objModules->next())
		{
			$arrModules[$objModules->id] = $objModules->name . ' (ID ' . $objModules->id . ')';
		}

		return $arrModules;
		
	}
	
	/* 
	 * Get possible columns
	 */
	public function getColumns($dc)
	{
		$objTypes = $this->Database->prepare("SELECT sc_type FROM tl_module WHERE id=?")->execute($this->Input->get('id'));
		
		$cols = array();
		$count = count(explode('x',$objTypes->sc_type));

		switch ($count)
		{
			case '2':
				$cols['first'] = $GLOBALS['TL_LANG']['MSC']['sc_first'];
				$cols['second'] = $GLOBALS['TL_LANG']['MSC']['sc_second'];
				break;

			case '3':
				$cols['first'] = $GLOBALS['TL_LANG']['MSC']['sc_first'];
				$cols['second'] = $GLOBALS['TL_LANG']['MSC']['sc_second'];
				$cols['third'] = $GLOBALS['TL_LANG']['MSC']['sc_third'];
				break;

			case '4':
				$cols['first'] = $GLOBALS['TL_LANG']['MSC']['sc_first'];
				$cols['second'] = $GLOBALS['TL_LANG']['MSC']['sc_second'];
				$cols['third'] = $GLOBALS['TL_LANG']['MSC']['sc_third'];
				$cols['fourth'] = $GLOBALS['TL_LANG']['MSC']['sc_fourth'];
				break;
			
			case '5':
				$cols['first'] = $GLOBALS['TL_LANG']['MSC']['sc_first'];
				$cols['second'] = $GLOBALS['TL_LANG']['MSC']['sc_second'];
				$cols['third'] = $GLOBALS['TL_LANG']['MSC']['sc_third'];
				$cols['fourth'] = $GLOBALS['TL_LANG']['MSC']['sc_fourth'];
				$cols['fifth'] = $GLOBALS['TL_LANG']['MSC']['sc_fifth'];
				break;
		}
		
		return $cols;
	}
}
?>