-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 10, 2007 at 09:08 AM
-- Server version: 4.1.16
-- PHP Version: 4.4.4
-- 
-- Database: `dev_sitexs`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `articles`
-- 

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL auto_increment,
  `time` int(11) NOT NULL default '0',
  `ctime` int(11) NOT NULL default '0',
  `lmtime` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `subtitle` text NOT NULL,
  `url` varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `state` set('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `state` (`state`),
  KEY `url` (`url`),
  KEY `time` (`time`),
  FULLTEXT KEY `title` (`title`,`text`,`subtitle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `articles`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `chapters`
-- 

DROP TABLE IF EXISTS `chapters`;
CREATE TABLE `chapters` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `chapters`
-- 

INSERT INTO `chapters` VALUES (1, 0, -1, 3, 'Home', '', 'index', '<h3>Welcome to SiteXS</h3><p><a href="/adm/">Click to manage content</a> &nbsp;</p>   ', 1084305600, 1084345401, 1181829697, 'a50db0dbb45d7e6310f143b16b864b65', 'sitexs,cms,opensource', 'SiteXS - OpenSource CMS', 1, 0, 1);
INSERT INTO `chapters` VALUES (2, 0, 0, 4, 'About', '', 'about', '<p>SiteXS CMS</p><p><img src="/images/sitexs.png" border="0" alt=" " width="436" height="300" /></p>', 1181073600, 1181128070, 1191218153, '3bfd0f536c58e48f07505b9722ef7269', '', '', 1, 0, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `config`
-- 

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `cid` smallint(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `descr` text,
  `text` text,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `config`
-- 

INSERT INTO `config` VALUES (1, 'site_name', 'Site name', 'SiteXS default web-site');
INSERT INTO `config` VALUES (2, 'email', 'E-mail', 'sample@example.org');
INSERT INTO `config` VALUES (8, 'charset', 'Charset', 'utf-8');

-- --------------------------------------------------------

-- 
-- Table structure for table `menus`
-- 

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `menus`
-- 

INSERT INTO `menus` VALUES (1, 'Main menu', 0, 1, '<ul>\r\n$menuNodes\r\n</ul>', '<li><a href="/$data[url]">$data[title]</a></li>', '<li class="sel"><a href="/$data[url]">$data[title]</a></sel>', '<li class="sel">$data[title]</li>');
INSERT INTO `menus` VALUES (2, 'Secondary menu', 0, 1, '$menuNodes\r\n', '<td><a href="/$data[url]">$data[title]</a></td>', '<td><a href="/$data[url]"><b>$data[title]</b></a></td>', '<td>$data[title]</td>');

-- --------------------------------------------------------

-- 
-- Table structure for table `types`
-- 

DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(150) NOT NULL default '',
  `title` varchar(150) NOT NULL default '',
  `root` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `root` (`root`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `types`
-- 

INSERT INTO `types` VALUES (-1, 'index', 'Home page', 0);
INSERT INTO `types` VALUES (1, 'news', 'News', 1);
INSERT INTO `types` VALUES (2, 'sitemap', 'Sitemap', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(20) default NULL,
  `pass` varchar(150) default NULL,
  `name` varchar(150) default NULL,
  `email` varchar(150) default NULL,
  `description` text,
  `admin` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'admin', '2b9c19c2b6740bbcdebd1a044e543b5c', 'admin', '', '', 1);
