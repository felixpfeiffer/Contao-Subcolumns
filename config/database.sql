-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `sc_name` varchar(255) NOT NULL default '',
  `sc_type` varchar(14) NOT NULL default '',
  `sc_parent` int(10) unsigned NOT NULL default '0'
  `sc_childs` varchar(255) NOT NULL default '',
  `sc_sortid` int(2) unsigned NOT NULL default '0',
  `sc_container` varchar(255) NOT NULL default '',
  `sc_gap` varchar(255) NOT NULL default '',
  `sc_gapdefault` char(1) NOT NULL default '1',
  `sc_equalize` char(1) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table `tl_module`
--

CREATE TABLE `tl_module` (
  `sc_type` varchar(14) NOT NULL default '',
  `sc_modules` text NULL,
  `sc_gap` varchar(255) NOT NULL default '',
  `sc_gapdefault` char(1) NOT NULL default '1',
  `sc_equalize` char(1) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Table `tl_form_field`
-- 

CREATE TABLE `tl_form_field` (
  `fsc_name` varchar(255) NOT NULL default '',
  `fsc_type` varchar(14) NOT NULL default '',
  `fsc_parent` int(10) unsigned NOT NULL default '0'
  `fsc_childs` varchar(255) NOT NULL default '',
  `fsc_sortid` int(2) unsigned NOT NULL default '0',
  `fsc_gapuse` char(1) NOT NULL default '',
  `fsc_gap` varchar(255) NOT NULL default '',
  `fsc_equalize` char(1) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;