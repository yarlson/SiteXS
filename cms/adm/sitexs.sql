-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 14, 2007 at 06:03 PM
-- Server version: 5.0.32
-- PHP Version: 4.4.4-8+etch3
-- 
-- Database: `sitexs`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `chapters`
-- 

INSERT INTO `chapters` (`id`, `pid`, `type`, `sortorder`, `title`, `subtitle`, `url`, `text`, `time`, `ctime`, `lmtime`, `sid`, `keywords`, `description`, `state`, `article`, `menu`) VALUES 
(1, 0, -1, 1, 'Home', '', 'index', '<h3>Welcome to SiteXS</h3><p><a href="/adm/">Click to manage content</a> &nbsp;</p>   ', 1084305600, 1084345401, 1181829697, 'a50db0dbb45d7e6310f143b16b864b65', 'sitexs,cms,opensource', 'SiteXS - OpenSource CMS', 1, 0, 1),
(2, 0, 0, 2, 'About', '', 'about', '<p>SiteXS CMS</p><p><img src="/images/sitexs.png" border="0" alt=" " width="436" height="300" /></p>', 1181073600, 1181128070, 1181829620, '3bfd0f536c58e48f07505b9722ef7269', '', '', 1, 0, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `config`
-- 

INSERT INTO `config` (`cid`, `name`, `descr`, `text`) VALUES 
(1, 'site_name', 'Site name', 'SiteXS default web-site'),
(2, 'email', 'E-mail', 'sample@example.org'),
(8, 'charset', 'Charset', 'utf8_general_ci');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `menus`
-- 

INSERT INTO `menus` (`id`, `name`, `level`, `type`, `main_tpl`, `node_tpl`, `opennode_tpl`, `curnode_tpl`) VALUES 
(1, 'Main menu', 0, 1, '<ul>\r\n$menuNodes\r\n</ul>', '<li><a href="/$data[url]">$data[title]</a></li>', '<li class="sel"><a href="/$data[url]">$data[title]</a></sel>', '<li class="sel">$data[title]</li>'),
(2, 'Secondary menu', 0, 1, '$menuNodes\r\n', '<td><a href="/$data[url]">$data[title]</a></td>', '<td><a href="/$data[url]"><b>$data[title]</b></a></td>', '<td>$data[title]</td>');

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

INSERT INTO `types` (`id`, `name`, `title`, `root`) VALUES 
(-1, 'index', 'Home page', 0),
(1, 'news', 'News', 1),
(2, 'sitemap', 'Sitemap', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` (`id`, `login`, `pass`, `name`, `email`, `description`, `admin`) VALUES 
(1, 'admin', '2b9c19c2b6740bbcdebd1a044e543b5c', 'admin', NULL, NULL, 1);
