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
 * Class HeaderCode
 * Contain methods to handle the the header code
 */
class HeaderCode extends Frontend
{
	/**
	 * Add the Header Code to the Site (Hook landing)
	 * 
	 * @param string $strContent
	 * @param string $strTemplate
	 * @return string
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
	 * @param int $intId
	 * @return void
	 */
	private function crawlTlPage($intId)
	{
		$this->import('Database');
		$intOldId = $intId;
		$strBufferHead = '';
		$strBufferFoot = '';

		while ($intId > 0)
		{
			$objRow = $this->Database->prepare('SELECT id,pid,hc_code,hc_footer_code,hc_inheritance,hc_mode FROM tl_page WHERE id=?')
									 ->limit(1)
									 ->execute($intId);

			// if the actual page has header code
			if ((strlen($objRow->hc_code) || strlen($objRow->hc_footer_code)) && $intOldId == $objRow->id)
			{
				if ($objRow->hc_mode == 1)
				{
					$strBufferHead .= "\n" . $objRow->hc_code;
					$strBufferFoot .= "\n" . $objRow->hc_footer_code;
				}
				else
				{
					$strBufferHead = $objRow->hc_code;
					$strBufferFoot = $objRow->hc_footer_code;
					
					// the user want's no inheritance code, so we break the while
					break;
				}
			}

			// check the parrents
			if ((strlen($objRow->hc_code) || strlen($objRow->hc_footer_code)) && $intOldId !== $objRow->id && $objRow->hc_inheritance == 1)
			{
				if (count($objRow->hc_code))
				{
					$strBufferHead .= "\n" . $objRow->hc_code;
				}

				if (count($objRow->hc_footer_code))
				{
					$strBufferFoot .= "\n" . $objRow->hc_footer_code;
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