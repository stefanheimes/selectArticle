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
class SelectArticleModule extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'sa_default';

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### SELECTARTICLE ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate module
     */
    public function compile()
    {
        $arrPage = $GLOBALS['objPage']->fetchAllAssoc();
        $intID = $arrPage[0]['id'];

        $arrColumn = $this->Database->
                prepare("SELECT COUNT(*) as count FROM tl_article WHERE pid = ? AND inColumn = ? AND published = 1")
                ->execute($intID, $this->sa_column);

        if ($arrColumn->count > 0)
        {
            return;
        }

        $this->Template->content = $this->sa_fallback;
    }

}

?>