<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * Class FormColPart
 *
 * Form field "explanation".
 * @copyright  Felix Pfeiffer : Neue Medien 2010
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 */
class FormColPart extends Widget
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'form_colset';
	protected $strColTemplate = 'ce_colsetPart';


	/**
	 * Do not validate
	 */
	public function validate()
	{
		return;
	}


	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		$this->strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
		
		
		if (TL_MODE == 'BE')
		{
			switch($this->fsc_sortid)
			{
				case 1:
					$colID = $GLOBALS['TL_LANG']['MSC']['sc_second'];
					break;
				case 2:
					$colID = $GLOBALS['TL_LANG']['MSC']['sc_third'];
					break;
				case 3:
					$colID = $GLOBALS['TL_LANG']['MSC']['sc_fourth'];
					break;
				case 4:
					$colID = $GLOBALS['TL_LANG']['MSC']['sc_fifth'];
					break;
			}
			
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### COLUMNSET PART <strong>'.$this->fsc_name.'</strong> ### <br><br>' . sprintf($GLOBALS['TL_LANG']['MSC']['contentAfter'],$colID);
			return $objTemplate->parse();
		}
		
		$arrCounts = array('1'=>'second','2'=>'third','3'=>'fourth','4'=>'fifth');
		$container = $GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->fsc_type];
		
		$objTemplate = new FrontendTemplate($this->strColTemplate);
		
		if($this->fsc_gapuse == 1)
		{
			$gap_value = $this->fsc_gap != "" ? $this->fsc_gap : '12';
			$gap_unit = 'px';
			
			if(count($container) == 2)
			{
				$objTemplate->gap = array('left'=>floor(0.5*$gap_value).$gap_unit);
			}
			elseif (count($container) == 3)
			{
				switch($this->fsc_sortid)
				{
					case 1:
						$objTemplate->gap = array('right'=>floor(0.333*$gap_value).$gap_unit,'left'=>floor(0.333*$gap_value).$gap_unit);
						break;
					case 2:
						$objTemplate->gap = array('left'=>ceil(0.666*$gap_value).$gap_unit);
						break;
				}
			}
			elseif (count($container) == 4)
			{
				switch($this->fsc_sortid)
				{
					case 1:
						$objTemplate->gap = array('right'=>floor(0.5*$gap_value).$gap_unit,'left'=>floor(0.25*$gap_value).$gap_unit);
						break;
					case 2:
						$objTemplate->gap = array('right'=>floor(0.25*$gap_value).$gap_unit,'left'=>ceil(0.5*$gap_value).$gap_unit);
						break;
					case 3:
						$objTemplate->gap = array('left'=>ceil(0.75*$gap_value).$gap_unit);
						break;
				}
			}
			elseif (count($container) == 5)
			{
				switch($this->fsc_sortid)
				{
					case 1:
						$objTemplate->gap = array('right'=>floor(0.6*$gap_value).$gap_unit,'left'=>floor(0.2*$gap_value).$gap_unit);
						break;
					case 2:
						$objTemplate->gap = array('right'=>floor(0.4*$gap_value).$gap_unit,'left'=>ceil(0.4*$gap_value).$gap_unit);
						break;
					case 3:
						$objTemplate->gap = array('right'=>floor(0.2*$gap_value).$gap_unit,'left'=>ceil(0.6*$gap_value).$gap_unit);
						break;
					case 4:
						$objTemplate->gap = array('left'=>ceil(0.8*$gap_value).$gap_unit);
						break;
				}
			}
		}
		
		$objTemplate->column = $container[$this->fsc_sortid][0] . ' col_' . ($this->fsc_sortid+1) . (($this->fsc_sortid == count($container)-1) ? ' last' : '');
		$objTemplate->inside = $container[$this->fsc_sortid][1];
		$objTemplate->useInside = $GLOBALS['TL_SUBCL'][$this->strSet]['inside'];

		return $objTemplate->parse();
	}
}

?>