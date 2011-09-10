<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
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
 * PHP version 5
 * @copyright  MEN AT WORK 2011
 * @package    selectArticle
 * @license    GNU/LGPL
 * @filesource
 */

class SelectArticleHook extends Frontend
{

    public function insertTag($strTag)
    {
        $arrTag = explode("::", $strTag);

        if ($arrTag[0] == "sa" && $arrTag[1] == "current_alias")
        {
            $arrLanguage = array_keys($this->getLanguages());
            $arrPage = $GLOBALS['objPage']->fetchAllAssoc();  
            
            // Search for a language tag and remove it
            $arrPageAlias = explode("/", $arrPage[0]['alias']);            
            foreach ($arrPageAlias as $key => $value)
            {                
                if($value == "")
                    continue;
                
                if(in_array($value, $arrLanguage))
                    unset ($arrPageAlias[$key]);
            }      
            
            // Return clear aliase
            return strtolower(implode("/", $arrPageAlias));
        }
        else
        {
            return false;
        }
    }

}

?>
