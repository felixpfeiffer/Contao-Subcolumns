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

namespace FelixPfeiffer\Subcolumns;

/**
 * Class ModuleSubcolumns 
 *
 * @copyright  Felix Pfeiffer : Neue Medien 2010
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 */
class ModuleSubcolumns extends \Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_subcolumns';

	/**
	 * Set-Type
	 */
	protected $strSet;

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		$this->strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
		
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### MODULE SUBCOLUMNS ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'typolight/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile()
	{
		
		/**
		 * CSS Code in das Pagelayout einfügen
		 */
        $mainCSS = $GLOBALS['TL_SUBCL'][$this->strSet]['files']['css'] ? $GLOBALS['TL_SUBCL'][$this->strSet]['files']['css'] : '';
		$IEHacksCSS = $GLOBALS['TL_SUBCL'][$this->strSet]['files']['ie'] ? $GLOBALS['TL_SUBCL'][$this->strSet]['files']['ie'] : false;
		
		$GLOBALS['TL_CSS']['subcolumns'] = $mainCSS;
		$GLOBALS['TL_HEAD']['subcolumns'] = $IEHacksCSS ? '<!--[if lte IE 7]><link href="'.$IEHacksCSS.'" rel="stylesheet" type="text/css" /><![endif]--> ' : '';
		
		$arrSet = $GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->sc_type];
		$useGap = $GLOBALS['TL_SUBCL'][$this->strSet]['gap'];
		$equalize = $GLOBALS['TL_SUBCL'][$this->strSet]['equalize'] && $this->sc_equalize ? $GLOBALS['TL_SUBCL'][$this->strSet]['equalize'] . ' ' : '';
		
		$arrColumns = unserialize($this->sc_modules);
		
		if($this->sc_gapdefault == 1 && $useGap)
		{
			$gap_value = $this->sc_gap != "" ? $this->sc_gap : '12';
			$gap_unit = 'px';
			
			if(count($arrSet) == 2)
			{
				$arrSet[0][] = array('right'=>ceil(0.5*$gap_value).$gap_unit);
				$arrSet[1][] = array('left'=>floor(0.5*$gap_value).$gap_unit);
			}
			elseif (count($arrSet) == 3)
			{
				$arrSet[0][] = array('right'=>ceil(0.666*$gap_value).$gap_unit);
				$arrSet[1][] = array('right'=>floor(0.333*$gap_value).$gap_unit,'left'=>floor(0.333*$gap_value).$gap_unit);
				$arrSet[2][] = array('left'=>ceil(0.666*$gap_value).$gap_unit);
			}
			elseif (count($arrSet) == 4)
			{
				$arrSet[0][] = array('right'=>ceil(0.75*$gap_value).$gap_unit);
				$arrSet[1][] = array('right'=>floor(0.5*$gap_value).$gap_unit,'left'=>floor(0.25*$gap_value).$gap_unit);
				$arrSet[2][] = array('right'=>floor(0.25*$gap_value).$gap_unit,'left'=>ceil(0.5*$gap_value).$gap_unit);
				$arrSet[3][] = array('left'=>ceil(0.75*$gap_value).$gap_unit);
			}
			elseif (count($arrSet) == 5)
			{
				$arrSet[0][] = array('right'=>ceil(0.8*$gap_value).$gap_unit);
				$arrSet[1][] = array('right'=>floor(0.6*$gap_value).$gap_unit,'left'=>floor(0.2*$gap_value).$gap_unit);
				$arrSet[2][] = array('right'=>floor(0.4*$gap_value).$gap_unit,'left'=>ceil(0.4*$gap_value).$gap_unit);
				$arrSet[3][] = array('right'=>floor(0.2*$gap_value).$gap_unit,'left'=>ceil(0.6*$gap_value).$gap_unit);
				$arrSet[4][] = array('left'=>ceil(0.8*$gap_value).$gap_unit);
			}
		}
		
		foreach($arrColumns as $row)
		{
		
			$strMod = $this->getFrontendModule($row['module']);
			
			switch($row['column'])
			{
				
				case 'first':
					$arrSet[0]['modules'][] = $strMod;
					break;
					
				case 'second':
					$arrSet[1]['modules'][] = $strMod;
					break;
					
				case 'third':
					$arrSet[2]['modules'][] = $strMod;
					break;
					
				case 'fourth':
					$arrSet[3]['modules'][] = $strMod;
					break;
					
				case 'fifth':
					$arrSet[4]['modules'][] = $strMod;
					break;
				
			}
		
		}

        /* Add class "first" and "last" to the corresponding tables */
        $i=0;
        $l= count($arrSet);
        foreach($arrSet as $k=>$v)
        {
            $arrSet[$k][0] = $v[0] . ($i++==0 ? ' first' : '') . ' col_' . ($i) . ($i == $l ? ' last' : '');
        }

		$this->Template->intCols = count($arrSet);
		$this->Template->inside = $container[0][1];
		$this->Template->arrSet = $arrSet;
		$this->Template->scclass = $equalize . $GLOBALS['TL_SUBCL'][$this->strSet]['scclass'] . ' colcount_' . $l  . ' ' . $this->strSet . ' col-' . $this->sc_type;
		$this->Template->useInside = $GLOBALS['TL_SUBCL'][$this->strSet]['inside'];
		
	}
}
?>