<?php

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
 * PHP version 5
 * @copyright  Felix Pfeiffer : Neue Medien 2007 - 2012
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 * @license    CC-A 2.0
 * @filesource
 */

namespace FelixPfeiffer\Subcolumns;

/**
 * Class colsetPart 
 *
 * @copyright  Felix Pfeiffer : Neue Medien 2010
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 */
class colsetPart extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_colsetPart';
	
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
			
			switch($this->sc_sortid)
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

            $intCountContainers = count($GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->sc_type]);
            $strWidth = 100/$intCountContainers;
            $arrMiniSet = array();
            for($i=0;$i<$intCountContainers;$i++)
            {
                $strClass = 'colset_column' . ($i == $this->sc_sortid ? ' colset_active' : '');
                $arrMiniSet[] = '<span class="'.$strClass.'" style="width:'.$strWidth.'%;">'.($i+1).'</span>';
            }
			
			$this->Template = new \BackendTemplate('be_subcolumns');
			$this->Template->colsetTitle = '### COLUMNSET PART <strong>'.$this->sc_name.'</strong> ###';
            $this->Template->visualSet = '<span class="colset_wrapper">' . implode($arrMiniSet) . '</span>';
            $this->Template->hint = sprintf($GLOBALS['TL_LANG']['MSC']['contentAfter'],$colID);

			return $this->Template->parse();
		}

		return parent::generate();
	}
	
	/**
	 * Generate content element
	 * @return string
	 */
	protected function compile()
	{
		$arrCounts = array('1'=>'second','2'=>'third','3'=>'fourth','4'=>'fifth');
		$container = $GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->sc_type];
		
		if($this->sc_gapdefault == 1)
		{
			$gap_value = $this->sc_gap != "" ? $this->sc_gap : '12';
			$gap_unit = 'px';
			
			if(count($container) == 2)
			{
				$this->Template->gap = array('left'=>floor(0.5*$gap_value).$gap_unit);
			}
			elseif (count($container) == 3)
			{
				switch($this->sc_sortid)
				{
					case 1:
						$this->Template->gap = array('right'=>floor(0.333*$gap_value).$gap_unit,'left'=>floor(0.333*$gap_value).$gap_unit);
						break;
					case 2:
						$this->Template->gap = array('left'=>ceil(0.666*$gap_value).$gap_unit);
						break;
				}
			}
			elseif (count($container) == 4)
			{
				switch($this->sc_sortid)
				{
					case 1:
						$this->Template->gap = array('right'=>floor(0.5*$gap_value).$gap_unit,'left'=>floor(0.25*$gap_value).$gap_unit);
						break;
					case 2:
						$this->Template->gap = array('right'=>floor(0.25*$gap_value).$gap_unit,'left'=>ceil(0.5*$gap_value).$gap_unit);
						break;
					case 3:
						$this->Template->gap = array('left'=>ceil(0.75*$gap_value).$gap_unit);
						break;
				}
			}
			elseif (count($container) == 5)
			{
				switch($this->sc_sortid)
				{
					case 1:
						$this->Template->gap = array('right'=>floor(0.6*$gap_value).$gap_unit,'left'=>floor(0.2*$gap_value).$gap_unit);
						break;
					case 2:
						$this->Template->gap = array('right'=>floor(0.4*$gap_value).$gap_unit,'left'=>ceil(0.4*$gap_value).$gap_unit);
						break;
					case 3:
						$this->Template->gap = array('right'=>floor(0.2*$gap_value).$gap_unit,'left'=>ceil(0.6*$gap_value).$gap_unit);
						break;
					case 4:
						$this->Template->gap = array('left'=>ceil(0.8*$gap_value).$gap_unit);
						break;
				}
			}
		}

        $this->Template->colID = $arrCounts[$this->sc_sortid];
        $this->Template->useInside = $GLOBALS['TL_SUBCL'][$this->strSet]['inside'];
		$this->Template->column = $container[$this->sc_sortid][0] . ' col_' . ($this->sc_sortid+1) . (($this->sc_sortid == count($container)-1) ? ' last' : '');
		$this->Template->inside = $this->Template->useInside ? $container[$this->sc_sortid][1] : '';

	}
}

?>