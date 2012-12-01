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
 * Class colsetStart 
 *
 * @copyright  Felix Pfeiffer : Neue Medien 2010
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 */
class colsetStart extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_colsetStart';
	
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
            $GLOBALS['TL_CSS']['subcolumns'] = 'system/modules/Subcolumns/assets/be_style.css';

            $intCountContainers = count($GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->sc_type]);
            $strWidth = 100/$intCountContainers;
            $arrMiniSet = array();
            for($i=0;$i<$intCountContainers;$i++)
            {
                $strClass = 'colset_column' . ($i==0 ? ' colset_active' : '');
                $arrMiniSet[] = '<span class="'.$strClass.'" style="width:'.$strWidth.'%;">'.($i+1).'</span>';
            }

            $this->Template = new \BackendTemplate('be_wildcard');
			$this->Template->wildcard = '### COLUMNSET START '.$this->sc_type.' <strong>'.$this->sc_name.'</strong> ### ' . '<span class="colset_wrapper">' . implode($arrMiniSet) . '</span><br><br>' . sprintf($GLOBALS['TL_LANG']['MSC']['contentAfter'],$GLOBALS['TL_LANG']['MSC']['sc_first']);
			
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
		/**
		 * CSS Code in das Pagelayout einfügen
		 */
		$mainCSS = $GLOBALS['TL_SUBCL'][$this->strSet]['files']['css'];
		$IEHacksCSS = $GLOBALS['TL_SUBCL'][$this->strSet]['files']['ie'] ? $GLOBALS['TL_SUBCL'][$this->strSet]['files']['ie'] : false;
		
		$GLOBALS['TL_CSS']['subcolumns'] = $mainCSS;
		$GLOBALS['TL_HEAD']['subcolumns'] = $IEHacksCSS ? '<!--[if lte IE 7]><link href="'.$IEHacksCSS.'" rel="stylesheet" type="text/css" /><![endif]--> ' : '';
		
		$container = $GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->sc_type];
		$useGap = $GLOBALS['TL_SUBCL'][$this->strSet]['gap'];
		$equalize = $GLOBALS['TL_SUBCL'][$this->strSet]['equalize'] && $this->sc_equalize ? $GLOBALS['TL_SUBCL'][$this->strSet]['equalize'] . ' ' : '';
		
		if($this->sc_gapdefault == 1 && $useGap)
		{
			$gap_value = $this->sc_gap != "" ? $this->sc_gap : '12';
			$gap_unit = 'px';
			
			if(count($container) == 2)
			{
				$this->Template->gap = array('right'=>ceil(0.5*$gap_value).$gap_unit);
			}
			elseif (count($container) == 3)
			{
				$this->Template->gap = array('right'=>ceil(0.666*$gap_value).$gap_unit);

			}
			elseif (count($container) == 4)
			{
				$this->Template->gap = array('right'=>ceil(0.75*$gap_value).$gap_unit);
			}
			elseif (count($container) == 5)
			{
				$this->Template->gap = array('right'=>ceil(0.8*$gap_value).$gap_unit);
			}
		}
		
		#$container = unserialize($this->sc_container);
        $this->Template->useInside = $GLOBALS['TL_SUBCL'][$this->strSet]['inside'];
        $this->Template->scclass = $equalize . $GLOBALS['TL_SUBCL'][$this->strSet]['scclass'] . ' colcount_' . count($container);
		$this->Template->column = $container[0][0] . ' col_1' . ' first';
		$this->Template->inside = $this->Template->useInside ? $container[0][1] : '';

	}
}

?>