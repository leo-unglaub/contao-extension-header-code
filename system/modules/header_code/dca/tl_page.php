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
 * @copyright  Leo Unglaub 2011
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    header_code
 * @license    LGPL
 * @filesource
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular']	= str_replace('guests;', 'guests,hc_code,hc_footer_code,hc_inheritance,hc_mode;', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);
$GLOBALS['TL_DCA']['tl_page']['palettes']['root']		= str_replace('includeChmod;', 'includeChmod;{expert_legend:hide},hc_code,hc_footer_code,hc_inheritance,hc_mode;', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['hc_code'] = array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_page']['hc_code'],
	'exclude'		=> true,
	'inputType'     => 'textarea',
	'eval'			=> array('tl_class'=>'long clr', 'preserveTags'=>true, 'decodeEntities'=>false, 'allowHtml'=>true, 'style'=>'height:200px')
);

$GLOBALS['TL_DCA']['tl_page']['fields']['hc_footer_code'] = array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_page']['hc_footer_code'],
	'exclude'		=> true,
	'inputType'     => 'textarea',
	'eval'			=> array('tl_class'=>'long clr', 'preserveTags'=>true, 'decodeEntities'=>false, 'allowHtml'=>true, 'style'=>'height:200px')
);

$GLOBALS['TL_DCA']['tl_page']['fields']['hc_inheritance'] = array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_page']['hc_inheritance'],
	'exclude'		=> true,
	'default'       => 1,
	'inputType'     => 'select',
	'options'  		=> array(1=>$GLOBALS['TL_LANG']['MSC']['yes'], 0=>$GLOBALS['TL_LANG']['MSC']['no']),
	'eval'			=> array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_page']['fields']['hc_mode'] = array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_page']['hc_mode'],
	'exclude'		=> true,
	'default'       => 1,
	'inputType'     => 'select',
	'options'  		=> array(1=>$GLOBALS['TL_LANG']['tl_page']['hc_mode_add'], 0=>$GLOBALS['TL_LANG']['tl_page']['hc_mode_override']),
	'eval'			=> array('tl_class'=>'w50')
);


?>