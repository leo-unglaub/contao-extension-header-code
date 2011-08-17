-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- 
-- Table `tl_page`
-- 

CREATE TABLE `tl_page` (
  `hc_code` blob NULL,
  `hc_footer_code` blob NULL,
  `hc_inheritance` char(1) NOT NULL default '',
  `hc_mode` char(1) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
