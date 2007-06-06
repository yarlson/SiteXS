-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-2ubuntu1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 06, 2007 at 04:23 PM
-- Server version: 5.0.38
-- PHP Version: 4.4.2-1.1
-- 
-- Database: `sitexs`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `chapters`
-- 

DROP TABLE IF EXISTS `chapters`;
CREATE TABLE IF NOT EXISTS `chapters` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `type` int(11) NOT NULL default '0',
  `sortorder` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `subtitle` text NOT NULL,
  `url` varchar(100) default NULL,
  `text` text NOT NULL,
  `time` int(11) NOT NULL default '0',
  `ctime` int(11) NOT NULL default '0',
  `lmtime` int(11) NOT NULL default '0',
  `sid` varchar(150) NOT NULL default '',
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `state` tinyint(4) NOT NULL default '0',
  `article` int(11) NOT NULL default '0',
  `menu` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `type` (`type`),
  KEY `sortorder` (`sortorder`),
  KEY `title` (`title`),
  KEY `url` (`url`),
  KEY `time` (`time`),
  KEY `ctime` (`ctime`),
  KEY `lmtime` (`lmtime`),
  KEY `sid` (`sid`),
  KEY `visible` (`state`),
  KEY `state` (`state`),
  KEY `article` (`article`),
  KEY `menu` (`menu`),
  FULLTEXT KEY `subtitle` (`subtitle`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `chapters`
-- 

INSERT INTO `chapters` (`id`, `pid`, `type`, `sortorder`, `title`, `subtitle`, `url`, `text`, `time`, `ctime`, `lmtime`, `sid`, `keywords`, `description`, `state`, `article`, `menu`) VALUES 
(1, 0, -1, 1, 'Home', '', 'index', '<h1>sfsdfsdfsdf</h1>   ', 1084305600, 1084345401, 1181129019, 'a50db0dbb45d7e6310f143b16b864b65', 'Ð“Ð»Ð°Ð²Ð½Ð°Ñ', '', 1, 0, 1),
(2, 0, 1, 2, 'sdfsd', '', 'sdfsdf', '', 1181073600, 1181128070, 1181130373, '3bfd0f536c58e48f07505b9722ef7269', '', '', 1, 0, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `config`
-- 

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `cid` smallint(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `descr` text,
  `text` text,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `config`
-- 

INSERT INTO `config` (`cid`, `name`, `descr`, `text`) VALUES 
(1, 'site_name', 'Site name', 'SiteXS'),
(2, 'email', 'E-mail', 'sample@example.org'),
(8, 'charset', 'Charset', 'utf-8');

-- --------------------------------------------------------

-- 
-- Table structure for table `menus`
-- 

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `level` int(11) NOT NULL default '0',
  `type` int(11) NOT NULL default '0',
  `main_tpl` text NOT NULL,
  `node_tpl` text NOT NULL,
  `opennode_tpl` text NOT NULL,
  `curnode_tpl` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `menus`
-- 

INSERT INTO `menus` (`id`, `name`, `level`, `type`, `main_tpl`, `node_tpl`, `opennode_tpl`, `curnode_tpl`) VALUES 
(1, 'Main menu', 0, 1, '<ul>\r\n$menuNodes\r\n</ul>', '<li><a href="/$data[url]">$data[title]</a></li>', '<li class="sel"><a href="/$data[url]">$data[title]</a></sel>', '<li class="sel">$data[title]</li>'),
(2, 'Secondary menu', 0, 1, '$menuNodes\r\n', '<td><a href="/$data[url]">$data[title]</a></td>', '<td><a href="/$data[url]"><b>$data[title]</b></a></td>', '<td>$data[title]</td>');

-- --------------------------------------------------------

-- 
-- Table structure for table `news`
-- 

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL auto_increment,
  `time` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  `matID` int(14) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `news`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `subs_config`
-- 

DROP TABLE IF EXISTS `subs_config`;
CREATE TABLE IF NOT EXISTS `subs_config` (
  `test_email` varchar(150) default NULL,
  `text` text,
  `html` text,
  `url` varchar(255) NOT NULL default '',
  `confirm` text NOT NULL,
  `email_from` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `subs_config`
-- 

INSERT INTO `subs_config` (`test_email`, `text`, `html`, `url`, `confirm`, `email_from`) VALUES 
('support@m-2.ru', 'Ð â€”Ð Ò‘Ð¡Ð‚Ð Â°Ð Ð†Ð¡ÐƒÐ¡â€šÐ Ð†Ð¡Ñ“Ð â„–Ð¡â€šÐ Âµ%COMMA_NAME%!\r\n\r\n%TXT%\r\n\r\nÐ â€Ð Â»Ð¡Ð Ð Ñ‘Ð Â·Ð Ñ˜Ð ÂµÐ Ð…Ð ÂµÐ Ð…Ð Ñ‘Ð¡Ð Ð Ñ—Ð Â°Ð¡Ð‚Ð Â°Ð Ñ˜Ð ÂµÐ¡â€šÐ¡Ð‚Ð Ñ•Ð Ð† Ð Ñ—Ð Ñ•Ð Ò‘Ð Ñ—Ð Ñ‘Ð¡ÐƒÐ Ñ”Ð Ñ‘ Ð Ð…Ð Â°Ð Â¶Ð Ñ˜Ð Ñ‘Ð¡â€šÐ Âµ Ð¡ÐƒÐ Â»Ð ÂµÐ Ò‘Ð¡Ñ“Ð¡Ð‹Ð¡â€°Ð¡Ñ“Ð¡Ð‹ Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð¡Ñ“\r\n%CHANGE_URL%\r\n\r\nÐ â€Ð Â»Ð¡Ð Ð¡â€šÐ Ñ•Ð Ñ–Ð Ñ•, Ð¡â€¡Ð¡â€šÐ Ñ•Ð Â±Ð¡â€¹ Ð Ð†Ð Â°Ð¡? Ð Â°Ð Ò‘Ð¡Ð‚Ð ÂµÐ¡Ðƒ Ð Â±Ð¡â€¹Ð Â» Ð¡Ñ“Ð Ò‘Ð Â°Ð Â»Ð ÂµÐ Ð… Ð Ñ‘Ð Â· Ð Ð…Ð Â°Ð¡?Ð ÂµÐ â„– Ð¡Ð‚Ð Â°Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð Ñ‘ Ð Ð…Ð Â°Ð Â¶Ð Ñ˜Ð Ñ‘Ð¡â€šÐ Âµ Ð¡ÐƒÐ Â»Ð ÂµÐ Ò‘Ð¡Ñ“Ð¡Ð‹Ð¡â€°Ð¡Ñ“Ð¡Ð‹ Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð¡Ñ“\r\n%REMOVE_URL%\r\n\r\nÐ ÐŽ Ð¡Ñ“Ð Ð†Ð Â°Ð Â¶Ð ÂµÐ Ð…Ð Ñ‘Ð ÂµÐ Ñ˜,\r\nÐ¡ÐƒÐ Â»Ð¡Ñ“Ð Â¶Ð Â±Ð Â° Ð¡Ð‚Ð Â°Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð Ñ‘ ', '<P><FONT face=Verdana size=2>Ð â€”Ð Ò‘Ð¡Ð‚Ð Â°Ð Ð†Ð¡ÐƒÐ¡â€šÐ Ð†Ð¡Ñ“Ð â„–Ð¡â€šÐ Âµ%COMMA_NAME%!</FONT></P>\r\n<P><FONT face=Verdana size=2></FONT></P><FONT face=Verdana size=2>\r\n<HR SIZE=1>\r\n</FONT>\r\n<P><FONT face=Verdana size=2>%HTML%</FONT></P>\r\n<P><FONT face=Verdana size=2></FONT></P><FONT face=Verdana size=2>\r\n<HR SIZE=1>\r\n</FONT>\r\n<P><FONT face=Verdana size=2>Ð ÐŽ Ð¡Ñ“Ð Ð†Ð Â°Ð Â¶Ð ÂµÐ Ð…Ð Ñ‘Ð ÂµÐ Ñ˜,<BR>Ð ÐŽÐ Â»Ð¡Ñ“Ð Â¶Ð Â±Ð Â° Ð¡Ð‚Ð Â°Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð Ñ‘ </FONT></P>\r\n<DIV><FONT face=Verdana size=2></FONT></DIV>\r\n<UL>\r\n<LI><A href="%CHANGE_URL%" target=_blank><FONT face=Verdana size=2>Ð ?Ð Â·Ð Ñ˜Ð ÂµÐ Ð…Ð Ñ‘Ð¡â€šÐ¡ÐŠ Ð Ñ—Ð Ñ•Ð Ò‘Ð Ñ—Ð Ñ‘Ð¡ÐƒÐ Ñ”Ð¡Ñ“</FONT></A><FONT face=Verdana size=2> </FONT>\r\n<LI><A href="%REMOVE_URL%" target=_blank><FONT face=Verdana size=2>Ð ÐˆÐ Ò‘Ð Â°Ð Â»Ð Ñ‘Ð¡â€šÐ¡ÐŠ Ð Â°Ð Ò‘Ð¡Ð‚Ð ÂµÐ¡Ðƒ Ð Ñ‘Ð Â· Ð¡Ð‚Ð Â°Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð Ñ‘</FONT></A><FONT face=Verdana size=2> <BR></FONT></LI></UL>', '/subscribe/', '<P>&nbsp;</P>\r\n<P>Ð â€”Ð Ò‘Ð¡Ð‚Ð Â°Ð Ð†Ð¡ÐƒÐ¡â€šÐ Ð†Ð¡Ñ“Ð â„–Ð¡â€šÐ Âµ!</P>\r\n<P>Ð ÑŸÐ Ñ•Ð¡ÐƒÐ¡â€šÐ¡Ñ“Ð Ñ—Ð Ñ‘Ð Â» Ð Â·Ð Â°Ð Ñ—Ð¡Ð‚Ð Ñ•Ð¡Ðƒ Ð Ð…Ð Â° Ð Ò‘Ð Ñ•Ð Â±Ð Â°Ð Ð†Ð Â»Ð ÂµÐ Ð…Ð Ñ‘Ð Âµ Ð Ñ—Ð Ñ•Ð¡â€¡Ð¡â€šÐ Ñ•Ð Ð†Ð Ñ•Ð Ñ–Ð Ñ• Ð Â°Ð Ò‘Ð¡Ð‚Ð ÂµÐ¡ÐƒÐ Â° <A href="mailto:%EMAIL%" target=_self>%EMAIL%</A> Ð Ð† Ð Ð…Ð Â°Ð¡? Ð¡ÐƒÐ Ñ—Ð Ñ‘Ð¡ÐƒÐ Ñ•Ð Ñ” Ð¡Ð‚Ð Â°Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð Ñ‘.</P>\r\n<UL>\r\n<LI>Ð â€Ð Â°, <A href="%CONFIRM_URL%" target=_self>Ð¡Ð Ð¡â€¦Ð Ñ•Ð¡â€¡Ð¡Ñ“ Ð Ñ—Ð Ñ•Ð Â»Ð¡Ñ“Ð¡â€¡Ð Â°Ð¡â€šÐ¡ÐŠ Ð Ò‘Ð Â°Ð Ð…Ð Ð…Ð¡Ñ“Ð¡Ð‹ Ð¡Ð‚Ð Â°Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð¡Ñ“</A></LI>\r\n<LI>Ð ÑœÐ ÂµÐ¡â€š, <A href="%REGRET_URL%" target=_self>Ð¡Ð Ð Ð…Ð Âµ Ð¡â€¦Ð Ñ•Ð¡â€¡Ð¡Ñ“ Ð Ñ—Ð Ñ•Ð Â»Ð¡Ñ“Ð¡â€¡Ð Â°Ð¡â€šÐ¡ÐŠ Ð Ò‘Ð Â°Ð Ð…Ð Ð…Ð¡Ñ“Ð¡Ð‹ Ð¡Ð‚Ð Â°Ð¡ÐƒÐ¡ÐƒÐ¡â€¹Ð Â»Ð Ñ”Ð¡Ñ“</A></LI></UL>', 'support@m-2.ru');

-- --------------------------------------------------------

-- 
-- Table structure for table `subs_lists`
-- 

DROP TABLE IF EXISTS `subs_lists`;
CREATE TABLE IF NOT EXISTS `subs_lists` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(250) default NULL,
  `period` varchar(150) default NULL,
  `description` text,
  `lastsend` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `subs_lists`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `subs_messages`
-- 

DROP TABLE IF EXISTS `subs_messages`;
CREATE TABLE IF NOT EXISTS `subs_messages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `lid` int(11) unsigned default '0',
  `subj` varchar(150) default NULL,
  `text` mediumtext,
  `html` mediumtext,
  `date_sent` int(10) unsigned NOT NULL default '0',
  `file` varchar(150) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `subs_messages`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `subs_subscribed`
-- 

DROP TABLE IF EXISTS `subs_subscribed`;
CREATE TABLE IF NOT EXISTS `subs_subscribed` (
  `lid` int(11) unsigned default NULL,
  `sid` int(11) unsigned default NULL,
  KEY `lid` (`lid`,`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `subs_subscribed`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `subs_users`
-- 

DROP TABLE IF EXISTS `subs_users`;
CREATE TABLE IF NOT EXISTS `subs_users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` char(150) default NULL,
  `email` char(150) default NULL,
  `city` char(150) default NULL,
  `country` char(150) default NULL,
  `salt` char(255) default NULL,
  `approved` set('0','1') default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `salt` (`salt`),
  KEY `approved` (`approved`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `subs_users`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `types`
-- 

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(150) NOT NULL default '',
  `title` varchar(150) NOT NULL default '',
  `root` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `root` (`root`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `types`
-- 

INSERT INTO `types` (`id`, `name`, `title`, `root`) VALUES 
(-1, 'index', 'Home page', 0),
(1, 'news', 'News', 1),
(2, 'sitemap', 'Sitemap', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(20) default NULL,
  `pass` varchar(150) default NULL,
  `name` varchar(150) default NULL,
  `email` varchar(150) default NULL,
  `description` text,
  `admin` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` (`id`, `login`, `pass`, `name`, `email`, `description`, `admin`) VALUES 
(1, 'admin', '537d6ff009a2be9e8af2ac2f55ae2f6d', 'admin', NULL, NULL, 1);
