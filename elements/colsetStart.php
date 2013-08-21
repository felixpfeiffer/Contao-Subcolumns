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

            $arrColor = unserialize($this->sc_color);

            if(!$GLOBALS['TL_SUBCL'][$this->strSet]['files']['css'])
            {
                $this->Template = new \BackendTemplate('be_subcolumns');
                $this->Template->setColor = $this->compileColor($arrColor);
                $this->Template->colsetTitle = '### COLUMNSET START '.$this->sc_type.' <strong>'.$this->sc_name.'</strong> ###';
                $this->Template->hint = sprintf($GLOBALS['TL_LANG']['MSC']['contentAfter'],$GLOBALS['TL_LANG']['MSC']['sc_first']);

                return $this->Template->parse();
            }

            $GLOBALS['TL_CSS']['subcolumns'] = 'system/modules/Subcolumns/assets/be_style.css';
            $GLOBALS['TL_CSS']['subcolumns_set'] = $GLOBALS['TL_SUBCL'][$this->strSet]['files']['css'] ? $GLOBALS['TL_SUBCL'][$this->strSet]['files']['css'] : false;

            $arrColset = $GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->sc_type];
            $strSCClass = $GLOBALS['TL_SUBCL'][$this->strSet]['scclass'];
            $blnInside = $GLOBALS['TL_SUBCL'][$this->strSet]['inside'];

            $intCountContainers = count($GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->sc_type]);

            $strMiniset = '';

            if($GLOBALS['TL_CSS']['subcolumns_set'])
            {
                $strMiniset = '<div class="colsetexample '.$strSCClass.'">';

                for($i=0;$i<$intCountContainers;$i++)
                {
                    $arrPresentColset = $arrColset[$i];
                    $strMiniset .= '<div class="'.$arrPresentColset[0].($i==0 ? ' active' : '').'">'.($blnInside ? '<div class="'.$arrPresentColset[1].'">' : '').($i+1).($blnInside ? '</div>' : '').'</div>';
                }

                $strMiniset .= '</div>';
            }

            $this->Template = new \BackendTemplate('be_subcolumns');
            $this->Template->setColor = $this->compileColor($arrColor);
            $this->Template->colsetTitle = '### COLUMNSET START '.$this->sc_type.' <strong>'.$this->sc_name.'</strong> ###';
            $this->Template->visualSet = $strMiniset;
            $this->Template->hint = sprintf($GLOBALS['TL_LANG']['MSC']['contentAfter'],$GLOBALS['TL_LANG']['MSC']['sc_first']);

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
		$mainCSS = $GLOBALS['TL_SUBCL'][$this->strSet]['files']['css'] ? $GLOBALS['TL_SUBCL'][$this->strSet]['files']['css'] : false;
		$IEHacksCSS = $GLOBALS['TL_SUBCL'][$this->strSet]['files']['ie'] ? $GLOBALS['TL_SUBCL'][$this->strSet]['files']['ie'] : false;

        if($mainCSS) $GLOBALS['TL_CSS']['subcolumns'] = $mainCSS;
		if($IEHacksCSS) $GLOBALS['TL_HEAD']['subcolumns'] = '<!--[if lte IE 7]><link href="'.$IEHacksCSS.'" rel="stylesheet" type="text/css" /><![endif]--> ';
		
		$container = $GLOBALS['TL_SUBCL'][$this->strSet]['sets'][$this->sc_type];
		$useGap = $GLOBALS['TL_SUBCL'][$this->strSet]['gap'];
		$equalize = $GLOBALS['TL_SUBCL'][$this->strSet]['equalize'] && $this->sc_equalize ? $GLOBALS['TL_SUBCL'][$this->strSet]['equalize'] . ' ' : '';
		
		if($this->sc_gapdefault == 1 && $useGap)
		{
			$gap_value = $this->sc_gap != "" ? $this->sc_gap : ($GLOBALS['TL_CONFIG']['subcolumns_gapdefault'] ? $GLOBALS['TL_CONFIG']['subcolumns_gapdefault'] : 12);
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
        $this->Template->scclass = $equalize . $GLOBALS['TL_SUBCL'][$this->strSet]['scclass'] . ' colcount_' . count($container) . ' ' . $this->strSet . ' col-' . $this->sc_type;
		$this->Template->column = $container[0][0] . ' col_1' . ' first';
		$this->Template->inside = $this->Template->useInside ? $container[0][1] : '';

	}

    /**
     * Compile a color value and return a hex or rgba color
     * @param mixed
     * @param boolean
     * @param array
     * @return string
     */
    protected function compileColor($color)
    {
        if (!is_array($color))
        {
            return '#' . $this->shortenHexColor($color);
        }
        elseif (!isset($color[1]) || empty($color[1]))
        {
            return '#' . $this->shortenHexColor($color[0]);
        }
        else
        {
            return 'rgba(' . implode(',', $this->convertHexColor($color[0], $blnWriteToFile, $vars)) . ','. ($color[1] / 100) .')';
        }
    }

    /**
     * Try to shorten a hex color
     * @param string
     * @return string
     */
    protected function shortenHexColor($color)
    {
        if ($color[0] == $color[1] && $color[2] == $color[3] && $color[4] == $color[5])
        {
            return $color[0] . $color[2] . $color[4];
        }

        return $color;
    }


    /**
     * Convert hex colors to rgb
     * @param string
     * @param boolean
     * @param array
     * @return array
     * @see http://de3.php.net/manual/de/function.hexdec.php#99478
     */
    protected function convertHexColor($color, $blnWriteToFile=false, $vars=array())
    {
        // Support global variables
        if (strncmp($color, '$', 1) === 0)
        {
            if (!$blnWriteToFile)
            {
                return array($color);
            }
            else
            {
                $color = str_replace(array_keys($vars), array_values($vars), $color);
            }
        }

        $rgb = array();

        // Try to convert using bitwise operation
        if (strlen($color) == 6)
        {
            $dec = hexdec($color);
            $rgb['red'] = 0xFF & ($dec >> 0x10);
            $rgb['green'] = 0xFF & ($dec >> 0x8);
            $rgb['blue'] = 0xFF & $dec;
        }

        // Shorthand notation
        elseif (strlen($color) == 3)
        {
            $rgb['red'] = hexdec(str_repeat(substr($color, 0, 1), 2));
            $rgb['green'] = hexdec(str_repeat(substr($color, 1, 1), 2));
            $rgb['blue'] = hexdec(str_repeat(substr($color, 2, 1), 2));
        }

        return $rgb;
    }
}
?>