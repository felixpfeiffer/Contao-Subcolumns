<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 */


/**
 * Class tl_subcolumnsCallback
 *
 * Provides a callback function for copying articles or pages
 * @copyright  Felix Pfeiffer : Neue Medien 2010
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Subcolumns
 * 
 */
class tl_subcolumnsCallback extends Backend
{
	/*
	 * Get all sets from the configuration array
	 */
	public function getSets()
	{
		$arrSets = array();
		
		foreach($GLOBALS['TL_SUBCL'] as $k=>$v)
		{
			$arrSets[$k] = $v['label'];
		}
		
		return $arrSets;
	}
	
	
	public function pageCheck($intId=0)
	{
		if($intId==0) return '';
		
		if(!$this->Input->get('childs'))
		{
			$objArticle = $this->Database->prepare("SELECT id FROM tl_article WHERE pid=?")
										 ->execute($intId);
			if($objArticle->numRows > 0)
			{
				while($objArticle->next())
				{
					$this->copyCheck($objArticle->id);
				}
			}
		}
		else if($this->Input->get('childs') == 1)
		{
			$arrPages = $this->getChildRecords($intId,'tl_page');
			
			foreach($arrPages as $id)
			{
				$objArticle = $this->Database->prepare("SELECT id FROM tl_article WHERE pid=?")
										 ->execute($id);
				
				if($objArticle->numRows > 0)
				{
					while($objArticle->next())
					{
						$this->copyCheck($objArticle->id);
					}
				}
			}
			
		}
	}

	public function articleCheck($intId=0)
	{
		if($intId==0) return '';
		$this->copyCheck($intId);
		
	}
	
	/**
     * 
     * HOOK: $GLOBALS['TL_HOOKS']['clipboardCopyAll']
     * 
     * @param array $arrIds
     */
    public function clipboardCopyAll($arrIds)
    {
        $arrIds = array_keys(array_flip($arrIds));
		
		$objDb = $this->Database->execute("SELECT DISTINCT pid FROM tl_content WHERE id IN (".implode(',',$arrIds).")");
		
		if($objDb->numRows > 0)
		{
			while($objDb->next())
			{
				$this->copyCheck($objDb->pid);
			}
		}
		
    }
	
	
	/**
     * Copy a colset
     * 
     * @param integer $pid
     */
	public function copyCheck($pid)
	{
			
		$objColstarts = $this->Database->prepare("SELECT id,sc_childs FROM tl_content WHERE pid=? AND type=? ORDER BY sorting")
												->execute($pid,'colsetStart');
		
		if($objColstarts->numRows > 0)
		{
			$parent = 0;
			$childs = array();
			$parents = array();
			while($objColstarts->next())
			{
				$sc_name = 'colset.' . $objColstarts->id;
				$sc_parent = $objColstarts->id;
				$parent = $objColstarts->id;
				$oldChilds = unserialize($objColstarts->sc_childs);
				$oldChildParent = $this->Database->prepare("SELECT sc_parent FROM tl_content WHERE id=?")
											    ->limit(1)
												->execute($oldChilds[0]);
				
				$newChilds = $this->Database->prepare("SELECT id,type FROM tl_content WHERE pid=? AND sc_parent=? AND type != 'colsetStart'")
												->execute($pid,$oldChildParent->sc_parent);
				$i=1;
				while($newChilds->next())
				{
					$childs[$parent]['sc_childs'][] = $newChilds->id;
					$parents[$newChilds->id]['sc_parent'] = $parent;
					$parents[$newChilds->id]['sc_name'] = $sc_name . ($newChilds->type=="colsetPart" ? '-Part-' . $i : '-End');
					$parents[$newChilds->id]['sc_sortid'] = $i;
					$i++;
				}
				$childs[$parent]['sc_parent'] = $sc_parent;
				$childs[$parent]['sc_name'] = $sc_name;
				sort($childs[$parent]['sc_childs']);
				
			}
			
			foreach($childs as $key=>$child)
			{
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set(array('sc_parent'=>$child['sc_parent'],'sc_childs'=>$child['sc_childs'],'sc_name'=>$child['sc_name']))
											->execute($key);
			}
			
			foreach($parents as $key=>$parent)
			{
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set(array('sc_parent'=>$parent['sc_parent'],'sc_name'=>$parent['sc_name'],'sc_sortid'=>$parent['sc_sortid']))
											->execute($key);
			}
			
			
			
			
			
			/*$parent = 0;
			$childs = array();
			$parents = array();
			while($newColset->next())
			{
				$id = $newColset->id;
				if($newColset->type == "colsetStart")
				{
					$parent = $id;
					$childs[$parent] = array();
				}
				else if($newColset->type == "colsetPart" || $newColset->type == "colsetEnd")
				{
					$childs[$parent][] = $id;
					$parents[$id] = $parent;
				}
			}
			
			foreach($childs as $key=>$value)
			{
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set(array('sc_childs'=>$value))
											->execute($key);
			}
			
			foreach($parents as $key=>$value)
			{
				$this->Database->prepare("UPDATE tl_content %s WHERE id=?")
											->set(array('sc_parent'=>$value))
											->execute($key);
			}*/
			
		}
			
	}
	
	public function formCheck($intId,DataContainer $dc)
	{
		if($intId==0) return '';
		
		$objElements = $this->Database->prepare("SELECT id,fsc_parent FROM tl_form_field WHERE pid=? AND type=?")->execute($intId,'formcolstart');
		
		if($objElements->numRows == 0) return '';
		
		while($objElements->next())
		{
			$strName = 'colset.' . $objElements->id;
			$this->Database->prepare("UPDATE tl_form_field %s WHERE pid=? AND fsc_parent=?")
						   ->set(array('fsc_parent'=>$objElements->id,'fsc_name'=>$strName))
						   ->execute($intId,$objElements->fsc_parent);
			
			$objParts = $this->Database->prepare("SELECT * FROM tl_form_field WHERE fsc_parent=? AND type!=? ORDER BY fsc_sortid")->execute($objElements->id,'formcolstart');
			
			$arrChilds= array();
			
			while($objParts->next())
			{
				
				$strName = $objParts->type == 'formcolend' ? 'colset.' . $objElements->id . '-End' : 'colset.' . $objElements->id . '-Part-' . $objParts->fsc_sortid;
				$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
						   ->set(array('fsc_name'=>$strName))
						   ->execute($objParts->id);
				
				$arrChilds[] = $objParts->id;
			}
			
			$this->Database->prepare("UPDATE tl_form_field %s WHERE id=?")
						   ->set(array('fsc_childs'=>$arrChilds))
						   ->execute($objElements->id);
		
		}
	
	}

}

?>