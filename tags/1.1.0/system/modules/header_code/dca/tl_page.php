<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  LU-Hosting 2009
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    header_code
 * @license    LGPL
 * @filesource
 */

// the palette changes in 2.8 so we check to support 2.7 and 2.8
if (version_compare(2.8, VERSION,'<=')) {
    $GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace('{expert_legend:hide},cssClass,sitemap,hide,guests;', '{expert_legend:hide},cssClass,sitemap,hide,guests,hc_code,hc_descent;', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);
} else {
    $GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace('{expert_legend:hide},cssClass,hide,guests;', '{expert_legend:hide},cssClass,hide,guests,hc_code,hc_descent;', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);
}

$GLOBALS['TL_DCA']['tl_page']['fields']['hc_code'] = 
array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_page']['hc_code'],
	'inputType'     => 'textarea',
	'eval'			=> array('tl_class' => 'long clr', 'preserveTags' => true, 'decodeEntities' => false, 'allowHtml' => true)
);
		
$GLOBALS['TL_DCA']['tl_page']['fields']['hc_descent'] = 
array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_page']['hc_descent'],
	'default'       => 0,
	'inputType'     => 'select',
	'options'  		=> array(1 => $GLOBALS['TL_LANG']['MSC']['yes'], 0 => $GLOBALS['TL_LANG']['MSC']['no']),
	'eval'			=> array('tl_class' => 'w50')
);

?>