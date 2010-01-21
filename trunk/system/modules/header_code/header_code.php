<?php //if (!defined('TL_ROOT')) die('You can not access this file directly!');

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

class header_code extends Frontend {
		
	/**
	 * Add the Header Code to the Site (Hook landing)
	 */
	public function addHeaderCode($strContent, $strTemplate) {	
		// make HC running only one time
		if ($GLOBALS['header_code_stop']) 
		{
			return $strContent;
		}

		global $objPage;
		$this->crawlTlPage($objPage->id);
		return $strContent;
	}
	
	/**
	 * crawl the page tree to find parrent entry's
	 * @param int $intId
	 */
	private function crawlTlPage($intId) {
		$this->Import('Database');
		$intOldPageId = $intId;

		while ($intId > 0) {
			$objPage = $this->Database->prepare('SELECT id,pid,hc_descent,hc_code FROM tl_page WHERE id=?')
									  ->limit(1)
									  ->execute($intId);
			
			// if the actuell page has header code
			if (strlen($objPage->hc_code) and $intOldPageId == $objPage->id) 
			{
				$GLOBALS['TL_HEAD'][] = $objPage->hc_code;
			}
			
			//print_r($objPage);
			
			// check the parrents
			if (strlen($objPage->hc_code) and $intOldPageId !== $objPage->id and $objPage->hc_descent == 1) 
			{
				$GLOBALS['TL_HEAD'][] = $objPage->hc_code;
				break;
			}

			$intId = $objPage->pid;			
		}
		// after the first run the code is in the header so we cann skip all other templates
		$GLOBALS['header_code_stop'] = 'true';
	}
}
 
?>