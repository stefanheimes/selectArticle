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
 * @copyright  MEN AT WORK 2012
 * @package    selectArticle
 * @license    GNU/LGPL
 * @filesource
 */
 
/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['selectarticle'] = '{title_legend},name,type;{config_legend},sa_column,sa_fallback';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['sa_column'] = array
    (
    'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['sa_column'],
    'exclude' 			=> true,
    'inputType' 		=> 'select',
    'options_callback' 	=> array('SelectArticle', 'options_callback'),
    'eval' 				=> array('mandatory' => true),
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sa_fallback'] = array
    (
    'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['sa_fallback'],
    'exclude' 			=> true,
    'inputType' 		=> 'textarea',    
	'eval'				=> array('allowHtml'=>true, 'class'=>'monospace', 'helpwizard'=>true),
	'explanation'		=> 'insertTags'	
);

// Set rte if we have a contao version 2.10
if(version_compare(VERSION, "2.10", ">="))
{
    $GLOBALS['TL_DCA']['tl_module']['fields']['sa_fallback']['eval']['rte'] = 'codeMirror|html';
}

class SelectArticle extends Backend
{

    public function __construct()
    {
        parent::__construct();

        $this->import("Database");
    }

    public function options_callback()
    {
        $arrCustomSections = trimsplit(',', $GLOBALS['TL_CONFIG']['customSections']);
        $arrSections = array('header', 'left', 'right', 'main', 'footer');

        $arrColumn = array_merge($arrSections, $arrCustomSections);

        foreach ($arrColumn as $value)
        {
            $arrReturn[$value] = ucfirst($value);
        }

        return $arrReturn;
    }

}

?>
