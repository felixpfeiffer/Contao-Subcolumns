<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
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
 *
 * PHP version 5
 * @copyright  Felix Pfeiffer : Neue Medien 2007 - 2012
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 * @license    CC-A 2.0
 * @filesource
 */


/**
 * Table tl_content 
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_name'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_name'],
	'inputType'	=> 'text',
	'save_callback' => array(array('tl_content_sc','setColsetName')),
	'eval'		=> array('maxlength'=>'255','unique'=>true,'spaceToUnderscore'=>true),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_gap'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_gap'],
    'default'   => ($GLOBALS['TL_CONFIG']['subcolumns_gapdefault'] != '' ? $GLOBALS['TL_CONFIG']['subcolumns_gapdefault'] : 0),
	'inputType'	=> 'text',
	'eval'		=> array('maxlength'=>'4','regxp'=>'digit', 'tl_class'=>'w50'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_type'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_type'],
	'inputType'	=> 'select',
	'options_callback'=> array('tl_content_sc','getAllTypes'),
	'eval'		=> array('includeBlankOption'=>true, 'mandatory'=>true, 'tl_class'=>'w50'),
    'sql'       => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_gapdefault'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_gapdefault'],
	'default'	=> 1,
	'inputType'	=> 'checkbox',
	'eval'		=> array('tl_class'=>'clr m12 w50'),
    'sql'       => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_equalize'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_equalize'],
	'inputType'	=> 'checkbox',
	'eval'		=> array(),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_color'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_color'],
    'inputType' => 'text',
    'eval'      => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
    'sql'       => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_parent'] = array
(
    'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_parent'],
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_childs'] = array
(
    'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_childs'],
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['sc_sortid'] = array
(
    'label'		=> &$GLOBALS['TL_LANG']['tl_content']['sc_sortid'],
    'sql'       => "int(2) unsigned NOT NULL default '0'"
);

/* Extend existing fields with additional functionality */

$GLOBALS['TL_DCA']['tl_content']['fields']['invisible']['save_callback'][] = array('tl_content_sc','toggleAdditionalElements');

/* hidden fields */

/*$GLOBALS['TL_DCA']['tl_content']['fields']['sc_parent'] = array
(
	'inputType'	=> 'text',	
);
$GLOBALS['TL_DCA']['tl_content']['fields']['sc_childs'] = array
(
	'inputType'	=> 'text',	
);
$GLOBALS['TL_DCA']['tl_content']['fields']['sc_sortid'] = array
(
	'inputType'	=> 'text',	
); */

$GLOBALS['TL_DCA']['tl_content']['palettes']['colsetPart'] = 'cssID';
$GLOBALS['TL_DCA']['tl_content']['palettes']['colsetEnd'] = $GLOBALS['TL_DCA']['tl_content']['palettes']['default'];

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_sc','createPalette');
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('tl_content_sc','scUpdate');
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('tl_content_sc','setElementProperties');
$GLOBALS['TL_DCA']['tl_content']['config']['ondelete_callback'][] = array('tl_content_sc','scDelete');
$GLOBALS['TL_DCA']['tl_content']['config']['oncopy_callback'][] = array('tl_content_sc','scCopy');

/**
 * Operations
**/
$arrModules = $this->Config->getActiveModules();
if(!in_array('ce-access',$arrModules))
{
	$GLOBALS['TL_DCA']['tl_content']['list']['operations']['edit']['button_callback'] = array('tl_content_sc','showEditOperation'); 
	$GLOBALS['TL_DCA']['tl_content']['list']['operations']['copy']['button_callback'] = array('tl_content_sc','showCopyOperation'); 
	#$GLOBALS['TL_DCA']['tl_content']['list']['operations']['delete']['button_callback'] = array('tl_content_sc','showDeleteOperation'); 
	#$GLOBALS['TL_DCA']['tl_content']['list']['operations']['toggle']['button_callback'] = array('tl_content_sc','toggleIcons'); 
}


/**
 * Erweiterung für die tl_conten-Klasse
 */
class tl_content_sc extends tl_content
{
	/* 
	 * Get the colsets depending on the selection from the settings
	 */
	public function getAllTypes()
	{
		$strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
		
		return array_keys($GLOBALS['TL_SUBCL'][$strSet]['sets']);
	}
	
	/*
	 * Create the palette for the startelement
	 */
	public function createPalette(DataContainer $dc)
	{	
		$strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
			
		$strGap = $GLOBALS['TL_SUBCL'][$strSet]['gap'] ? ',sc_gapdefault,sc_gap' : '';
		$strEquilize = $GLOBALS['TL_SUBCL'][$strSet]['equalize'] ? '{colheight_legend:hide},sc_equalize;' : '';
			
		$GLOBALS['TL_DCA']['tl_content']['palettes']['colsetStart'] = '{type_legend},type;{colset_legend},sc_name,sc_type,sc_color'.$strGap.';'.$strEquilize.'{protected_legend:hide},protected;{expert_legend:hide},guests,invisible,cssID,space';
		
	}
	
	
	/**
	 * Autogenerate an name for the colset if it has not been set yet
	 * @param mixed
	 * @param object
	 * @return string
	 */
	public function setColsetName($varValue, DataContainer $dc)
	{
		$autoName = false;
		
		// Generate alias if there is none
		if (!strlen($varValue))
		{	
			$autoName = true;
			$varValue = 'colset.' . $dc->id;
		}

		return $varValue;
	}
	
	/**
	 * Write the other Sets
	 * @param object
	 */
	public function scUpdate(DC_Table $dc)
	{
		
		if($dc->activeRecord->type != 'colsetStart' || $dc->activeRecord->sc_type == "") return '';
		
		$strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
		
		$sc_type = $dc->activeRecord->sc_type;

		$arrColset = $GLOBALS['TL_SUBCL'][$strSet]['sets'][$sc_type];
		
		$arrChilds = $dc->activeRecord->sc_childs != "" ? unserialize($dc->activeRecord->sc_childs) : "";
		
		return $this->createColset($dc->activeRecord,$sc_type,$arrColset,$arrChilds);
		
	}
	
	private function createColset($objElement,$sc_type,$arrColset,$arrChilds='')
	{
		$intColcount = count($arrColset) - 2;
		
		$this->log('ID= ' . $objElement->id, 'SpaltensetHilfe createColset()', TL_ACCESS);
		
		/* Neues Spaltenset anlegen */
		if($arrChilds=='')
		{
			$arrChilds = array();
			$this->moveRows($objElement->pid,$objElement->ptable,$objElement->sorting,128 * ( count($arrColset) + 1 ));
			
			$arrSet = array('pid' => $objElement->pid,
                            'ptable' => $objElement->ptable,
							'tstamp' => time(),
							'sorting'=>0,
							'type' => 'colsetPart',
							'sc_name'=> '',		
							'sc_type'=>$sc_type,
							'sc_parent'=>$objElement->id,
							'sc_sortid'=>0,
							'sc_gap' => $objElement->sc_gap,
							'sc_gapdefault' => $objElement->sc_gapdefault,
							'sc_color' => $objElement->sc_color
							);

            if(in_array('GlobalContentelements',$this->Config->getActiveModules()))
            {
                $arrSet['do'] = $this->Input->get('do');
            }
			
			for($i=1;$i<=$intColcount+1;$i++)
			{
				
				$arrSet['sorting'] = $objElement->sorting+($i+1)*64;
				$arrSet['sc_name'] = $objElement->sc_name.'-Part-'.($i);
				$arrSet['sc_sortid'] = $i;
				
				$insertElement = $this->Database->prepare("INSERT INTO tl_content %s")
												->set($arrSet)
												->execute()
												->insertId;
				
				$arrChilds[] = $insertElement;
			}
			
			$arrSet['sorting'] = $objElement->sorting+($i+1)*64;
			$arrSet['type'] = 'colsetEnd';
			$arrSet['sc_name'] = $objElement->sc_name.'-End';
			$arrSet['sc_sortid'] = $intColcount+2;
			
			$insertElement = $this->Database->prepare("INSERT INTO tl_content %s")
											->set($arrSet)
											->execute()
											->insertId;
			
			$arrChilds[] = $insertElement;
			
			$insertElement = $this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set(array('sc_childs'=>$arrChilds,'sc_parent'=>$objElement->id,))
											->execute($objElement->id);
			
			return true;
		
		}
		
		/* Gleiche Spaltenzahl */
		if(count($arrChilds) == count($arrColset))
		{
			$intLastElement = array_pop($arrChilds);
			
			$i = 1;
			foreach($arrChilds as $v)
			{
				$arrSet = array(
								'sc_type'=>$sc_type,
								'sc_gap' => $objElement->sc_gap,
								'sc_gapdefault' => $objElement->sc_gapdefault,
								'sc_sortid' => $i,
								'sc_name' => $objElement->sc_name.'-Part-'.($i++),
								'sc_color' => $objElement->sc_color

				);
				
				$this->Database->prepare("UPDATE tl_content %s WHERE id=".$v)
											->set($arrSet)
											->execute();
			}
			
			$arrSet = array(
							'sc_type'=>$sc_type,
							'sc_gap' => $objElement->sc_gap,
							'sc_sortid' => $i,
							'sc_name' => $objElement->sc_name.'-End',
                            'sc_color' => $objElement->sc_color
			);
			
			$this->Database->prepare("UPDATE tl_content %s WHERE id=".$intLastElement)
										->set($arrSet)
										->execute();
			
			
			
			return true;
			
		}
		
		/* Weniger Spalten */
		if(count($arrChilds) > count($arrColset))
		{
		
			$intDiff = count($arrChilds) - count($arrColset);
			
			for($i=1;$i<=$intDiff;$i++)
			{
				$intChildId = array_pop($arrChilds);
				$this->Database->prepare("DELETE FROM tl_content WHERE id=?")
											->execute($intChildId);
				
			}
			
			$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set(array('sc_childs'=>$arrChilds))
											->execute($objElement->id);
			
			/* Andere Daten im Colset anpassen - Spaltenabstand und SpaltenSet-Typ */
			$arrSet = array(
							'sc_type'=>$sc_type,
							'sc_gap' => $objElement->sc_gap,
							'sc_gapdefault' => $objElement->sc_gapdefault,
							'sc_color' => $objElement->sc_color
							);
			
			foreach($arrChilds as $value)
			{
			
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set($arrSet)
											->execute($value);
			
			}
			
			/*  Den Typ des letzten Elements auf End-ELement umsetzen und FSC-namen anpassen */
			$intChildId = array_pop($arrChilds);
			
			$arrSet['sc_name'] = $objElement->sc_name.'-End';
			$arrSet['type'] = 'colsetEnd';
			
			$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set($arrSet)
											->execute($intChildId);
			
			return true;
		}
		
		/* Mehr Spalten */
		if(count($arrChilds) < count($arrColset))
		{
		
			$intDiff = count($arrColset) - count($arrChilds);
			
			$objEnd = $this->Database->prepare("SELECT id,sorting,sc_sortid FROM tl_content WHERE id=?")->execute($arrChilds[count($arrChilds)-1]);
			
			$this->moveRows($objElement->pid,$objElement->ptable,$objEnd->sorting,64 * ( $intDiff) );
			
			/*  Den Typ des letzten Elements auf End-ELement umsetzen und SC-namen anpassen */
			$intChildId	= count($arrChilds);
			$arrSet['sc_name'] = $objElement->sc_name.'-Part-'.($intChildId);
			$arrSet['type'] = 'colsetPart';
			
			$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set($arrSet)
											->execute($objEnd->id);
			
			
			
			$intFscSortId = $objEnd->sc_sortid;
			$intSorting = $objEnd->sorting;
			
			$arrSet = array('type' => 'colsetPart',
							'pid' => $objElement->pid,
                            'ptable' => $objElement->ptable,
							'tstamp' => time(),
							'sorting' => 0,
							'sc_name' => '',
							'sc_type'=>$sc_type,
							'sc_parent' => $objElement->id,
							'sc_sortid' => 0,
							'sc_gap' => $objElement->sc_gap,
							'sc_gapdefault' => $objElement->sc_gapdefault,
							'sc_color' => $objElement->sc_color
							);

            if(in_array('GlobalContentelements',$this->Config->getActiveModules()))
            {
                $arrSet['do'] = $this->Input->get('do');
            }
			
			if($intDiff>0)
			{
				
				/* Andere Daten im Colset anpassen - Spaltenabstand und SpaltenSet-Typ */				
				for($i=1;$i<$intDiff;$i++)
				{
					++$intChildId;
					++$intFscSortId;
					$intSorting += 64;
					$arrSet['sc_name'] = $objElement->sc_name.'-Part-'.($intChildId);
					$arrSet['sc_sortid'] = $intFscSortId;
					$arrSet['sorting'] = $intSorting;
					
					$objInsertElement = $this->Database->prepare("INSERT INTO tl_content %s")
											->set($arrSet)
											->execute();
					
					$insertElement = $objInsertElement->insertId;
			
					$arrChilds[] = $insertElement;
					
				}
				
				
			}
			
			/* Andere Daten im Colset anpassen - Spaltenabstand und SpaltenSet-Typ */
			$arrData = array(
							'sc_type'=>$sc_type,
							'sc_gap' => $objElement->sc_gap,
							'sc_gapdefault' => $objElement->sc_gapdefault,
							'sc_color' => $objElement->sc_color
							);
			
			foreach($arrChilds as $value)
			{
			
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set($arrData)
											->execute($value);
			
			}
			
			/* Neues End-element erzeugen */
			$arrSet['sorting'] = $intSorting + 64;
			$arrSet['type'] = 'colsetEnd';
			$arrSet['sc_name'] = $objElement->sc_name.'-End';
			$arrSet['sc_sortid'] = ++$intFscSortId;
			
			$insertElement = $this->Database->prepare("INSERT INTO tl_content %s")
											->set($arrSet)
											->execute()
											->insertId;
			
			$arrChilds[] = $insertElement;
			
			/* Kindelemente in Startelement schreiben */
			$insertElement = $this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set(array('sc_childs'=>$arrChilds))
											->execute($objElement->id);
			
			return true;
			
		}
	
	}
	
	
	/**
	 * Write the other Sets
	 * @param mixed
	 * @param object
	 * @return string
	 */
	public function setElementProperties(DC_Table $dc)
	{
	
		if($dc->activeRecord->type != 'colsetStart' || $dc->activeRecord->sc_type == "") return '';
	
		$objEnd = $this->Database->prepare("SELECT sorting FROM tl_content WHERE sc_name=?")->execute($dc->activeRecord->sc_name . '-End');
		
		$arrSet = array(
			'protected' => $dc->activeRecord->protected,
			'groups' => $dc->activeRecord->groups,
			'guests' => $dc->activeRecord->guests
		);
		
		$this->Database->prepare("UPDATE tl_content %s WHERE pid=? AND sorting > ? AND sorting <= ?")->set($arrSet)->execute($dc->activeRecord->pid,$dc->activeRecord->sorting,$objEnd->sorting);
		
	
	}
	
	public function scDelete(DC_Table $dc)
	{
		
		$delRecord = $this->Database->prepare("SELECT * FROM tl_content WHERE id=?")
												->execute($dc->id)
												->fetchAssoc();
		
		
		if($delRecord['type'] == 'colsetStart' || $delRecord['type'] == 'colsetPart' || $delRecord['type'] == 'colsetEnd')
		{
			
			/**
			 * Wird ein Startelement gelöscht, werden alle Kindelemente in ein Array geschrieben 
			 * und ebenfalls gelöscht
			 */
			if($delRecord['type'] == 'colsetStart') $eraseArray = $delRecord['sc_childs'] != "" ? unserialize($delRecord['sc_childs']) : array();
			
			/**
			 * Wird ein Teiler oder das Endelement gelöscht
			 */
			if($delRecord['type'] == 'colsetPart' || $delRecord['type'] == 'colsetEnd')
			{
				$parent = $this->Database->prepare("SELECT sc_childs FROM tl_content WHERE id=?")
										  ->execute($delRecord['sc_parent'])
										  ->fetchAssoc();
				$childs = $parent['sc_childs'] != "" ? unserialize($parent['sc_childs']) : array();
				
				$eraseArray[] = $delRecord['sc_parent'];
				
				foreach($childs as $wert)
				{
					if($wert != $delRecord['id']) $eraseArray[] = $wert;
				}
			}
			
			if(count($eraseArray) > 0)
			{
								
				for($i = 0;$i < count($eraseArray); $i++)
				{
					$this->Database->prepare("DELETE FROM tl_content WHERE id=?")
										  ->execute($eraseArray[$i]);
				}
				
			}
			
		}
		
	}
	
	private function moveRows($pid,$ptable,$sorting,$ammount=128)
	{
		$this->Database->prepare("UPDATE tl_content SET sorting = sorting + ? WHERE pid=? AND ptable=? AND sorting > ?")
									->execute($ammount,$pid,$ptable,$sorting);
		
		
	}
	
	/* Bearbeiten-Icon für Trenn- und Endelemente ausblenden */
	public function showEditOperation($arrRow, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
	{
		
		#return '<a href="typolight/main.php?do=form&table=tl_form_field&act=paste&mode=copy&id=7" title="Das Feld ID 7 duplizieren" onclick="Backend.getScrollOffset();"><img src="system/themes/default/images/copy.gif" width="14" height="16" alt="Feld duplizieren" /></a>';
		if($arrRow['type'] != 'colsetPart' && $arrRow['type'] != 'colsetEnd')
		{
			$href .= '&id='.$arrRow['id'];
			return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
		}
	
	}
	
	/* Kopier-Icon für Trenn- und Endelemente ausblenden */
	public function showCopyOperation($arrRow, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
	{
	
		if($arrRow['type'] != 'colsetPart' && $arrRow['type'] != 'colsetEnd')
		{
			$href .= '&id='.$arrRow['id'];
			return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
		}
	
	}
	
	/* Kopier-Icon für Trenn- und Endelemente ausblenden */
	public function showDeleteOperation($arrRow, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
	{
	
		if($arrRow['type'] != 'colsetPart' && $arrRow['type'] != 'colsetEnd')
		{
			$href .= '&id='.$arrRow['id'];
			return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
		}
	
	}
	
	/* Kopier-Icon für Trenn- und Endelemente ausblenden */
	public function toggleIcons($arrRow, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
	{
	
		if($arrRow['type'] != 'colsetPart' && $arrRow['type'] != 'colsetEnd')
		{
			return parent::toggleIcon($arrRow, $href, $label, $title, $icon, $attributes);
		}
	
	}
	
	/* Toggle-Status auf Trenn und End-elemente anwenden */
	public function toggleAdditionalElements($varValue,$dc)
	{
		$objEntry = $this->Database->prepare("UPDATE tl_content SET tstamp=". time() .", invisible='" . ( $varValue ? 1 : '') . "' WHERE sc_parent=? AND type!=?")->execute($dc->id,'colsetStart');
		
		return $varValue;
	
	}
	
	public function scCopy($intId,DataContainer $dc)
	{
		$dc->activeRecord = $this->Database->prepare("SELECT * FROM tl_content WHERE id=?")->execute($intId)->first();

        if($dc->activeRecord->type != 'colsetStart' && $dc->activeRecord->type != 'colsetPart' && $dc->activeRecord->type != 'colsetEnd')
        {
            return;
        }

		if($this->Input->get('act') == 'copy')
		{
			if($dc->activeRecord->type == 'colsetStart')
			{
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
							->set(array('sc_parent'=>'','sc_childs'=>''))
							->execute($intId);
			}
		}
		
		if($this->Input->get('act') == 'copyAll')
		{
			
			// Startelement mit aktuellen Daten besetzen und Session mit alten Daten füllen
			if($dc->activeRecord->type == 'colsetStart')
			{
				
				$arrSession = array(
					'parentId' 	=> $intId,
					'count'		=> 1,
					'childs'	=> array()
				);
				
				#$this->Session->set('sc'.$dc->activeRecord->sc_parent,$arrSession);
                $GLOBALS['scglobal']['sc'.$dc->activeRecord->sc_parent] = $arrSession;
				
				$arrSet = array(
					'sc_name'	=> 'colset.' . $intId,
					'sc_parent' => $intId
				);
				
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set($arrSet)
											->execute($intId);
			}
			
			if($dc->activeRecord->type == 'colsetPart')
			{
				//$arrSession = $this->Session->get('sc'.$dc->activeRecord->sc_parent);
				$arrSession = $GLOBALS['scglobal']['sc'.$dc->activeRecord->sc_parent];

				$intNewParent = $arrSession['parentId'];
				$intCount = $arrSession['count'];
				$arrChilds = $arrSession['childs'];
				
				
				$arrSet = array(
					'sc_name'	=> 'colset.' . $intNewParent . '-Part-' . $intCount,
					'sc_parent' => $intNewParent
				);
				
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set($arrSet)
											->execute($intId);
				
				$arrChilds[] = $intId;
				
				$arrSession['count'] = ++$intCount;
				$arrSession['childs'] = $arrChilds;
				
				//$this->Session->set('sc'.$dc->activeRecord->sc_parent,$arrSession);
                $GLOBALS['scglobal']['sc'.$dc->activeRecord->sc_parent] = $arrSession;

			}
			
			if($dc->activeRecord->type == 'colsetEnd')
			{
				
				//$arrSession = $this->Session->get('sc'.$dc->activeRecord->sc_parent);
				$arrSession = $GLOBALS['scglobal']['sc'.$dc->activeRecord->sc_parent];

				$intNewParent = $arrSession['parentId'];
				$intCount = $arrSession['count'];
				$arrChilds = $arrSession['childs'];
				
				$arrSet = array(
					'sc_name'	=> 'colset.' . $intNewParent . '-End',
					'sc_parent' => $intNewParent
				);
				
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set($arrSet)
											->execute($intId);
				
				$arrChilds[] = $intId;
				
				$arrSet = array(
					'sc_childs' => $arrChilds
				);
				
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set($arrSet)
											->execute($intNewParent);

				
			
			}
			
			
			
		}
	}
	
	/**
     * 
     * HOOK: $GLOBALS['TL_HOOKS']['clipboardCopy']
     * 
     * @param integer $intId
     * @param datacontainer $dc
     * @param boolean $isGrouped
     */
    public function clipboardCopy($intId, DataContainer $dc, $isGrouped)
    {
        if(!$isGrouped)
        {
			$objActiveRecord = $this->Database
                    ->prepare("SELECT * FROM tl_content WHERE id = ?")
                    ->executeUncached($intId);
			
			if($objActiveRecord->type == 'colsetStart')
			{
				
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
                            ->set(array('sc_childs'=>'','sc_parent'=>'','sc_name'=>'colset.'.$objActiveRecord->id))
                            ->execute($intId);

                $objContent = $this->Database
                            ->prepare("Select * FROM tl_content WHERE id=?")
                            ->execute($intId);
				
				$strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
			
				$sc_type = $objContent->sc_type;

				$arrColset = $GLOBALS['TL_SUBCL'][$strSet]['sets'][$sc_type];
				
				$this->log('Values: sc-Type='.$sc_type . ' Values: sc-Colset-Count='.count($arrColset), 'SpaltensetHilfe clipboardCopy()', TL_ACCESS);
		
				$this->createColset($objContent,$sc_type,$arrColset);
			}
		}
		
	}
}
?>