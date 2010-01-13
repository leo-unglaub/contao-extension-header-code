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
	
	public function addHeaderCode($strContent, $strTemplate) {	
		$intActSite = $this->replaceInsertTags('{{env::page_id}}');
		$this->crawlTlPage($intActSite);

		return $strContent;
	}
	
	/**
	 * crawl the page tree to find parrent entry's
	 * @param int $intId
	 */
	private function crawlTlPage($intId) {
		$this->Import('Database');
		$intActPageId = $intId;

		while ($intActPageId > 0) {
			$objPage = $this->Database->prepare('SELECT id,pid,hc_descent,hc_code FROM tl_page WHERE id=?')
									  ->limit(1)
									  ->execute($intActPageId);
			
			// if the actuell page has header code
			if (strlen($objPage->hc_code) and $intId == $objPage->id) {
				$GLOBALS['TL_HEAD'][] = $objPage->hc_code;
			}
			
			// check the parrents
			if (strlen($objPage->hc_code) and $intId !== $objPage->id and $objPage->hc_descent == 1) {
				$GLOBALS['TL_HEAD'][] = $objPage->hc_code;
				$intActPageId = 0;
			}

			$intActPageId = $objPage->pid;			
		}		
	}
}
 
?>