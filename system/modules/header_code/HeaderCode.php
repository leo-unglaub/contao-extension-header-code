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
 * Class HeaderCode
 * Contain methods to handle the the header code
 */
class HeaderCode extends Controller
{
	/**
	 * Add the Header Code to the Site (Hook landing)
	 *
	 * @param	string	$strContent		The content of the template.
	 * @param	string	$strTemplate	The name of the template.
	 * @return	string					The content of the template.
	 */
	public function addHeaderCode($strContent, $strTemplate)
	{
		// make HC running only one time
		if ($GLOBALS['header_code_stop'] === true || TL_MODE != 'FE')
		{
			return $strContent;
		}

		global $objPage;
		$this->crawlTlPage($objPage->id);

		return $strContent;
	}

	/**
	 * crawl the page tree to find parrent entry's
	 *
	 * @param	int		$intId	The if of the page that should be parsed.
	 * @return	void			This method returns nothing.
	 */
	private function crawlTlPage($intId)
	{
		// import some libs
		// DON'T remove this import, the Controller class will fail
		// without this import
		$this->import('Database');

		// define some variables
		$intOldId = $intId;
		$strBufferHead = '';
		$strBufferFoot = '';


		// walk thru every page until we hit 0
		while ($intId > 0)
		{
			$objRow = $this->getPageDetails($intId);

			// if the actual page has header code
			if ((strlen($objRow->hc_code) || strlen($objRow->hc_footer_code)) && $intOldId == $objRow->id)
			{
				if ($objRow->hc_mode == 1)
				{
					$strBufferHead .= PHP_EOL . $objRow->hc_code;
					$strBufferFoot .= PHP_EOL . $objRow->hc_footer_code;
				}
				else
				{
					$strBufferHead = $objRow->hc_code;
					$strBufferFoot = $objRow->hc_footer_code;

					// the user want's no inheritance code, so we break the while
					break;
				}
			}

			// check the parents
			if ((strlen($objRow->hc_code) || strlen($objRow->hc_footer_code)) && $intOldId !== $objRow->id && $objRow->hc_inheritance == 1)
			{
				if (count($objRow->hc_code))
				{
					$strBufferHead .= PHP_EOL . $objRow->hc_code;
				}

				if (count($objRow->hc_footer_code))
				{
					$strBufferFoot .= PHP_EOL . $objRow->hc_footer_code;
				}
			}

			// set the id to the next level to get the data from the parrent entry
			$intId = $objRow->pid;
		}


		// add the code to the right channel
		$GLOBALS['TL_HEAD'][] = $strBufferHead;
		$GLOBALS['TL_MOOTOOLS'][] = $strBufferFoot;


		// after the first run the code is in the header so we can skip all other templates
		$GLOBALS['header_code_stop'] = true;
	}
}

?>