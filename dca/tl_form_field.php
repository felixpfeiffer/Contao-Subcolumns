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
 * Table tl_form_field
 */
/**
 * Config
**/
$GLOBALS['TL_DCA']['tl_form_field']['config']['onsubmit_callback'][] = array('tl_form_subcols','scWrite');
$GLOBALS['TL_DCA']['tl_form_field']['config']['ondelete_callback'][] = array('tl_form_subcols','scDelete');
$GLOBALS['TL_DCA']['tl_form_field']['config']['oncopy_callback'][] = array('tl_form_subcols','scCopy');

/**
 * Operations
**/
$GLOBALS['TL_DCA']['tl_form_field']['list']['operations']['edit']['button_callback'] = array('tl_form_subcols','showEditOperation'); 
$GLOBALS['TL_DCA']['tl_form_field']['list']['operations']['copy']['button_callback'] = array('tl_form_subcols','showCopyOperation'); 
$GLOBALS['TL_DCA']['tl_form_field']['list']['operations']['delete']['button_callback'] = array('tl_form_subcols','showDeleteOperation'); 
$GLOBALS['TL_DCA']['tl_form_field']['list']['operations']['toggle']['button_callback'] = array('tl_form_subcols','toggleIcons'); 

/**
 * Palettes
**/
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] = 'fsc_gapuse';

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['formcolstart'] = '{type_legend},type;{colsettings_legend},fsc_type,fsc_color,fsc_name,fsc_equalize,fsc_gapuse;{expert_legend:hide},class';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['formcolpart'] = '{type_legend},type;{colsettings_legend},fsc_type';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['formcolend'] = '{type_legend},type;{colsettings_legend},fsc_type';

/**
 * Subpalettes
**/
$GLOBALS['TL_DCA']['tl_form_field']['subpalettes']['fsc_gapuse'] = 'fsc_gap';

/**
 * Fields
**/
$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_type'] = array(
	'label'         => &$GLOBALS['TL_LANG']['tl_form_field']['fsc_type'],
	'exclude'       => true,
	'inputType'     => 'select',
	'options_callback'=> array('tl_form_subcols','getAllTypes'),
	'eval'          => array('tl_class'=>'w50'),
    'sql'               => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_name'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['tl_form_field']['fsc_name'],
	'exclude'	=> true,
	'inputType'	=> 'text',
	'save_callback' => array(array('tl_form_subcols','setColsetName')),
	'eval'		=> array('maxlength'=>'255','unique'=>true,'spaceToUnderscore'=>true,'tl_class'=>'w50'),
    'sql'               => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_gapuse'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['tl_form_field']['fsc_gapuse'],
	'exclude'	=> true,
	'inputType'	=> 'checkbox',
	'eval'		=> array('submitOnChange'=>true,'tl_class'=>'clr'),
    'sql'               => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_gap'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['tl_form_field']['fsc_gap'],
	'exclude'	=> true,
	'inputType'	=> 'text',
    'default'   => ($GLOBALS['TL_CONFIG']['subcolumns_gapdefault'] != '' ? $GLOBALS['TL_CONFIG']['subcolumns_gapdefault'] : 0),
	'eval'		=> array('maxlength'=>'4','regxp'=>'digit'),
    'sql'               => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_equalize'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['tl_form_field']['fsc_equalize'],
	'inputType'	=> 'checkbox',
	'eval'		=> array('tl_class'=>'clr'),
    'sql'               => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_color'] = array
(
    'label'		=> &$GLOBALS['TL_LANG']['tl_form_field']['fsc_color'],
    'inputType' => 'text',
    'eval'      => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
    'sql'       => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_parent'] = array
(
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_childs'] = array
(
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['fsc_sortid'] = array
(
    'sql'       => "int(2) unsigned NOT NULL default '0'"
);

 
 


/**
 * Erweiterung für die tl_conten-Klasse
 */
class tl_form_subcols extends tl_form_field
{
	/* 
	 * Get the colsets depending on the selection from the settings
	 */
	public function getAllTypes()
	{
		$strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
		
		return array_keys($GLOBALS['TL_SUBCL'][$strSet]['sets']);
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
	 * @param mixed
	 * @param object
	 * @return string
	 */
	public function scWrite(DC_Table $dc)
	{
		
		if($dc->activeRecord->type != 'formcolstart' || $dc->activeRecord->fsc_type == "") return '';
		
		$strSet = $GLOBALS['TL_CONFIG']['subcolumns'] ? $GLOBALS['TL_CONFIG']['subcolumns'] : 'yaml3';
		
		$id = $dc->id;
					
		$sorting = $dc->activeRecord->sorting;
		
		$arrColset = $GLOBALS['TL_SUBCL'][$strSet]['sets'][$dc->activeRecord->fsc_type];
		
		$arrChilds = $dc->activeRecord->fsc_childs != "" ? unserialize($dc->activeRecord->fsc_childs) : "";
		
		if($dc->activeRecord->fsc_gapuse == 1)
		{
			$gap_value = $dc->activeRecord->fsc_gap != "" ? $dc->activeRecord->fsc_gap : '12';
		}
		
		$intColcount = count($arrColset) - 2;
		
		
		
		/* Neues Spaltenset anlegen */
		if($arrChilds == '')
		{
			
			$arrChilds = array();
			
			$this->moveRows($dc->activeRecord->pid,$dc->activeRecord->sorting,128 * ( count($arrColset) + 1 ));
			
			$arrSet = array('pid' => $dc->activeRecord->pid,
							'tstamp' => time(),
							'sorting'=>0,
							'type' => 'formcolpart',
							'fsc_name'=> '',
							'fsc_type'=>$dc->activeRecord->fsc_type,
							'fsc_parent'=>$dc->activeRecord->id,
							'fsc_sortid'=>0,
							'fsc_gapuse' => $dc->activeRecord->fsc_gapuse,
							'fsc_gap' => $dc->activeRecord->fsc_gap,
							'fsc_color' => $dc->activeRecord->fsc_color
							);
			
			for($i=1;$i<=$intColcount+1;$i++)
			{
				
				$arrSet['sorting'] = $dc->activeRecord->sorting+($i+1)*64;
				$arrSet['fsc_name'] = $dc->activeRecord->fsc_name.'-Part-'.($i);
				$arrSet['fsc_sortid'] = $i;
				
				$insertElement = $this->Database->prepare("INSERT INTO tl_form_field %s")
												->set($arrSet)
												->execute()
												->insertId;
				
				$arrChilds[] = $insertElement;
			}
			
			$arrSet['sorting'] = $dc->activeRecord->sorting+($i+1)*64;
			$arrSet['type'] = 'formcolend';
			$arrSet['fsc_name'] = $dc->activeRecord->fsc_name.'-End';
			$arrSet['fsc_sortid'] = $intColcount+2;
			
			$insertElement = $this->Database->prepare("INSERT INTO tl_form_field %s")
											->set($arrSet)
											->execute()
											->insertId;
			
			$arrChilds[] = $insertElement;
			
			$insertElement = $this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set(array('fsc_childs'=>$arrChilds,'fsc_parent'=>$dc->activeRecord->id,))
											->execute($dc->id);
			
			return true;
		
		}
		
		/* Gleiche Spaltenzahl */
		if(count($arrChilds) == count($arrColset))
		{
			$intLastElement = array_pop($arrChilds);
			
			$i = 1;
			foreach($arrChilds as $v)
			{
				$arrSet = array('fsc_type' => $dc->activeRecord->fsc_type,
								'fsc_gapuse' => $dc->activeRecord->fsc_gapuse,
								'fsc_gap' => $dc->activeRecord->fsc_gap,
								'fsc_name' => $dc->activeRecord->fsc_name.'-Part-'.($i++),
                                'fsc_color' => $dc->activeRecord->fsc_color
				);
				
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=".$v)
											->set($arrSet)
											->execute();
			}
			
			$arrSet = array('fsc_type' => $dc->activeRecord->fsc_type,
							'fsc_gapuse' => $dc->activeRecord->fsc_gapuse,
							'fsc_gap' => $dc->activeRecord->fsc_gap,
							'fsc_name' => $dc->activeRecord->fsc_name.'-End',
                            'fsc_color' => $dc->activeRecord->fsc_color
			);
			
			$this->Database->prepare("UPDATE tl_form_field %s WHERE id=".$intLastElement)
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
				$this->Database->prepare("DELETE FROM tl_form_field WHERE id=?")
											->execute($intChildId);
				
			}
			
			$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set(array('fsc_childs'=>$arrChilds))
											->execute($dc->id);
			
			/* Andere Daten im Colset anpassen - Spaltenabstand und SpaltenSet-Typ */
			$arrSet = array('fsc_type' => $dc->activeRecord->fsc_type,
							'fsc_gapuse' => $dc->activeRecord->fsc_gapuse,
							'fsc_gap' => $dc->activeRecord->fsc_gap,
                            'fsc_color' => $dc->activeRecord->fsc_color
							);
			
			foreach($arrChilds as $value)
			{
			
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set($arrSet)
											->execute($value);
			
			}
			
			/*  Den Typ des letzten Elements auf End-ELement umsetzen und FSC-namen anpassen */
			$intChildId = array_pop($arrChilds);
			
			$arrSet['fsc_name'] = $dc->activeRecord->fsc_name.'-End';
			$arrSet['type'] = 'formcolend';
			
			$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set($arrSet)
											->execute($intChildId);
			
			return true;
		}
		
		/* Mehr Spalten */
		if(count($arrChilds) < count($arrColset))
		{
		
			$intDiff = count($arrColset) - count($arrChilds);
			
			$objEnd = $this->Database->prepare("SELECT id,sorting,fsc_sortid FROM tl_form_field WHERE id=?")->execute($arrChilds[count($arrChilds)-1]);
			
			$this->moveRows($dc->activeRecord->pid,$objEnd->sorting,64 * ( $intDiff) );
			
			/*  Den Typ des letzten Elements auf End-ELement umsetzen und FSC-namen anpassen */
			$intChildId	= count($arrChilds);
			$arrSet['fsc_name'] = $dc->activeRecord->fsc_name.'-Part-'.($intChildId);
			$arrSet['type'] = 'formcolpart';
			
			$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set($arrSet)
											->execute($objEnd->id);
			
			
			
			$intFscSortId = $objEnd->fsc_sortid;
			$intSorting = $objEnd->sorting;
			
			$arrSet = array('type' => 'formcolpart',
							'pid' => $dc->activeRecord->pid,
							'tstamp' => time(),
							'sorting' => 0,
							'fsc_name' => '',
							'fsc_type' => $dc->activeRecord->fsc_type,
							'fsc_parent' => $dc->id,
							'fsc_sortid' => 0,
							'fsc_gapuse' => $dc->activeRecord->fsc_gapuse,
							'fsc_gap' => $dc->activeRecord->fsc_gap,
                            'fsc_color' => $dc->activeRecord->fsc_color
							);
			
			$intDiff;
			
			if($intDiff>0)
			{
				
				/* Andere Daten im Colset anpassen - Spaltenabstand und SpaltenSet-Typ */				
				for($i=1;$i<$intDiff;$i++)
				{
					++$intChildId;
					++$intFscSortId;
					$intSorting += 64;
					$arrSet['fsc_name'] = $dc->activeRecord->fsc_name.'-Part-'.($intChildId);
					$arrSet['fsc_sortid'] = $intFscSortId;
					$arrSet['sorting'] = $intSorting;
					
					$objInsertElement = $this->Database->prepare("INSERT INTO tl_form_field %s")
											->set($arrSet)
											->execute();
					
					$insertElement = $objInsertElement->insertId;
			
					$arrChilds[] = $insertElement;
					
				}
				
				
			}
			
			/* Andere Daten im Colset anpassen - Spaltenabstand und SpaltenSet-Typ */
			$arrData = array('fsc_type' => $dc->activeRecord->fsc_type,
							'fsc_gapuse' => $dc->activeRecord->fsc_gapuse,
							'fsc_gap' => $dc->activeRecord->fsc_gap,
                            'fsc_color' => $dc->activeRecord->fsc_color
							);
			
			foreach($arrChilds as $value)
			{
			
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set($arrData)
											->execute($value);
			
			}
			
			/* Neues End-element erzeugen */
			$arrSet['sorting'] = $intSorting + 64;
			$arrSet['type'] = 'formcolend';
			$arrSet['fsc_name'] = $dc->activeRecord->fsc_name.'-End';
			$arrSet['fsc_sortid'] = ++$intFscSortId;
			
			$insertElement = $this->Database->prepare("INSERT INTO tl_form_field %s")
											->set($arrSet)
											->execute()
											->insertId;
			
			$arrChilds[] = $insertElement;
			
			/* Kindelemente in Startelement schreiben */
			$insertElement = $this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set(array('fsc_childs'=>$arrChilds))
											->execute($dc->id);
			
			return true;
			
		}
		
		
		
	}
	
	public function scDelete(DC_Table $dc)
	{
		if($dc->activeRecord->type != 'formcolstart' || $dc->activeRecord->fsc_childs == '') return '';
		
		$arrChilds = unserialize($dc->activeRecord->fsc_childs);
		
		$this->Database->prepare("DELETE FROM tl_form_field WHERE id IN (".implode(',',$arrChilds).")")->execute();
		
		
	}
	
	/* Alle folgenden Zeilen verschieben */
	private function moveRows($pid,$sorting,$ammount=128)
	{
		$this->Database->prepare("UPDATE tl_form_field SET sorting = sorting + ? WHERE pid=? AND sorting > ?")
									->execute($ammount,$pid,$sorting);
		
		
	}
	
	/* Bearbeiten-Icon für Trenn- und Endelemente ausblenden */
	public function showEditOperation($arrRow, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
	{
	
		#return '<a href="typolight/main.php?do=form&amp;table=tl_form_field&amp;act=paste&amp;mode=copy&amp;id=7" title="Das Feld ID 7 duplizieren" onclick="Backend.getScrollOffset();"><img src="system/themes/default/images/copy.gif" width="14" height="16" alt="Feld duplizieren" /></a>';
		if($arrRow['type'] != 'formcolpart' && $arrRow['type'] != 'formcolend')
		{
			$href .= '&amp;id='.$arrRow['id'];
			return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
		}
	
	}
	
	/* Kopier-Icon für Trenn- und Endelemente ausblenden */
	public function showCopyOperation($arrRow, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
	{
	
		if($arrRow['type'] != 'formcolpart' && $arrRow['type'] != 'formcolend')
		{
			$href .= '&amp;id='.$arrRow['id'];
			return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
		}
	
	}
	
	/* Kopier-Icon für Trenn- und Endelemente ausblenden */
	public function showDeleteOperation($arrRow, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
	{
	
		if($arrRow['type'] != 'formcolpart' && $arrRow['type'] != 'formcolend')
		{
			$href .= '&amp;id='.$arrRow['id'];
			return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
		}
	
	}
	
	/* Kopier-Icon für Trenn- und Endelemente ausblenden */
	public function toggleIcons($arrRow, $href, $label, $title, $icon, $attributes, $strTable, $arrRootIds, $arrChildRecordIds, $blnCircularReference, $strPrevious, $strNext)
	{
	
		if($arrRow['type'] != 'formcolpart' && $arrRow['type'] != 'formcolend')
		{
			return parent::toggleIcon($arrRow, $href, $label, $title, $icon, $attributes);
		}
	
	}
	
	public function scCopy($intId,DataContainer $dc)
	{
		
		if($this->Input->get('act') == 'copy')
		{
			if($objActiveRecord->type == 'formcolstart')
			{
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
							->set(array('fsc_parent'=>'','fsc_childs'=>''))
							->execute($intId);
			}
		}
		
		if($this->Input->get('act') == 'copyAll')
		{
			
			$objActiveRecord = $this->Database->prepare("SELECT * FROM tl_form_field WHERE id=?")->execute($intId);
			
			if($objActiveRecord->type != 'formcolstart' && $objActiveRecord->type != 'formcolpart' && $objActiveRecord->type != 'formcolend')
			{	
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")->set(array('fsc_name'=>''))->execute($intId);
			}
			
			// Startelement mit aktuellen Daten besetzen und Session mit alten Daten füllen
			if($objActiveRecord->type == 'formcolstart')
			{
				
				$arrSession = array(
					'parentId' 	=> $intId,
					'count'		=> 1,
					'childs'	=> array()
				);
				
				$this->Session->set('sc'.$objActiveRecord->fsc_parent,$arrSession);
				
				$arrSet = array(
					'fsc_name'	=> 'colset.' . $intId,
					'fsc_parent' => $intId
				);
				
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set($arrSet)
											->execute($intId);
			}
			
			if($objActiveRecord->type == 'formcolpart')
			{
				$arrSession = $this->Session->get('sc'.$objActiveRecord->fsc_parent);
				
				$intNewParent = $arrSession['parentId'];
				$intCount = $arrSession['count'];
				$arrChilds = $arrSession['childs'];
				
				
				$arrSet = array(
					'fsc_name'	=> 'colset.' . $intNewParent . '-Part-' . $intCount,
					'fsc_parent' => $intNewParent
				);
				
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set($arrSet)
											->execute($intId);
				
				$arrChilds[] = $intId;
				
				$arrSession['count'] = ++$intCount;
				$arrSession['childs'] = $arrChilds;
				
				$this->Session->set('sc'.$objActiveRecord->fsc_parent,$arrSession);
			
			}
			
			if($objActiveRecord->type == 'formcolend')
			{
				
				$arrSession = $this->Session->get('sc'.$objActiveRecord->fsc_parent);
				
				$intNewParent = $arrSession['parentId'];
				$intCount = $arrSession['count'];
				$arrChilds = $arrSession['childs'];
				
				$arrSet = array(
					'fsc_name'	=> 'colset.' . $intNewParent . '-End',
					'fsc_parent' => $intNewParent
				);
				
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set($arrSet)
											->execute($intId);
				
				$arrChilds[] = $intId;
				
				$arrSet = array(
					'fsc_childs' => $arrChilds
				);
				
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
											->set($arrSet)
											->execute($intNewParent);
				
				
			
			}
			
			
			
		}
	}
	
}

?>