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
 * @copyright  Leo Unglaub 2013
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @package    header_code
 * @license    LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_page']['hc_code']			= array('individual header code', 'Place here any header code. This may be META data, .js or .css code.');
$GLOBALS['TL_LANG']['tl_page']['hc_footer_code']	= array('individual footer code', 'Place here any footer code.  The footer code is placed before the closing div container from #wrapper.');
$GLOBALS['TL_LANG']['tl_page']['hc_inheritance']	= array('inherit code', 'Select Yes if you want to inheritance the header/footer code to every subpage. Select No to show this code only in the actual page.');
$GLOBALS['TL_LANG']['tl_page']['hc_mode']			= array('Select the display mode', 'Here you can select if you want to add the code from the actual site only or every code element witch is marked as inheritance.');


/**
 * Legend
 */
$GLOBALS['TL_LANG']['tl_page']['header_code_legend']= 'Header Code';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_page']['hc_mode_add']		= 'all (also inheritanced code)';
$GLOBALS['TL_LANG']['tl_page']['hc_mode_override']	= 'only the code from this site (no inheritance)';

?>