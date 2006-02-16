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
);


INSERT INTO `chapters` (`id`, `pid`, `type`, `sortorder`, `title`, `subtitle`, `url`, `text`, `time`, `ctime`, `lmtime`, `sid`, `keywords`, `description`, `state`, `article`, `menu`) VALUES (1, 0, -1, 1, 'Home', '', 'index', '  \r\n', 1084305600, 1084345401, 1123219087, 'a50db0dbb45d7e6310f143b16b864b65', 'Главная', '', 1, 0, 0);


DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `cid` smallint(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `descr` text,
  `text` text,
  PRIMARY KEY  (`cid`)
) PACK_KEYS=0;


INSERT INTO `config` (`cid`, `name`, `descr`, `text`) VALUES (1, 'site_name', 'Site name', 'SiteXS');
INSERT INTO `config` (`cid`, `name`, `descr`, `text`) VALUES (2, 'email', 'E-mail', 'sample@example.org');
INSERT INTO `config` (`cid`, `name`, `descr`, `text`) VALUES (8, 'charset', 'Charset', 'utf-8');


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
);


INSERT INTO `menus` (`id`, `name`, `level`, `type`, `main_tpl`, `node_tpl`, `opennode_tpl`, `curnode_tpl`) VALUES (1, 'Main menu', 0, 1, '<table cellspacing="0" cellpadding="0">\r\n<tr>\r\n$menuNodes\r\n</tr>\r\n</table>\r\n', '<td><a href="/$data[url]">$data[title]</a></td>', '<td><a href="/$data[url]">$data[titlesel]</a></td>', '<td>$data[titlesel]</td>');
INSERT INTO `menus` (`id`, `name`, `level`, `type`, `main_tpl`, `node_tpl`, `opennode_tpl`, `curnode_tpl`) VALUES (2, 'Secondary menu', 0, 1, '$menuNodes\r\n', '<td><a href="/$data[url]">$data[title]</a></td>', '<td><a href="/$data[url]"><b>$data[title]</b></a></td>', '<td>$data[title]</td>');


DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `time` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  `matID` int(14) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);


DROP TABLE IF EXISTS `subs_config`;
CREATE TABLE `subs_config` (
  `test_email` varchar(150) default NULL,
  `text` text,
  `html` text,
  `url` varchar(255) NOT NULL default '',
  `confirm` text NOT NULL,
  `email_from` varchar(255) NOT NULL default ''
);



INSERT INTO `subs_config` (`test_email`, `text`, `html`, `url`, `confirm`, `email_from`) VALUES ('support@m-2.ru', 'Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ%COMMA_NAME%!\r\n\r\n%TXT%\r\n\r\nР”Р»СЏ РёР·РјРµРЅРµРЅРёСЏ РїР°СЂР°РјРµС‚СЂРѕРІ РїРѕРґРїРёСЃРєРё РЅР°Р¶РјРёС‚Рµ СЃР»РµРґСѓСЋС‰СѓСЋ СЃСЃС‹Р»РєСѓ\r\n%CHANGE_URL%\r\n\r\nР”Р»СЏ С‚РѕРіРѕ, С‡С‚РѕР±С‹ РІР°С? Р°РґСЂРµСЃ Р±С‹Р» СѓРґР°Р»РµРЅ РёР· РЅР°С?РµР№ СЂР°СЃСЃС‹Р»РєРё РЅР°Р¶РјРёС‚Рµ СЃР»РµРґСѓСЋС‰СѓСЋ СЃСЃС‹Р»РєСѓ\r\n%REMOVE_URL%\r\n\r\nРЎ СѓРІР°Р¶РµРЅРёРµРј,\r\nСЃР»СѓР¶Р±Р° СЂР°СЃСЃС‹Р»РєРё ', '<P><FONT face=Verdana size=2>Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ%COMMA_NAME%!</FONT></P>\r\n<P><FONT face=Verdana size=2></FONT></P><FONT face=Verdana size=2>\r\n<HR SIZE=1>\r\n</FONT>\r\n<P><FONT face=Verdana size=2>%HTML%</FONT></P>\r\n<P><FONT face=Verdana size=2></FONT></P><FONT face=Verdana size=2>\r\n<HR SIZE=1>\r\n</FONT>\r\n<P><FONT face=Verdana size=2>РЎ СѓРІР°Р¶РµРЅРёРµРј,<BR>РЎР»СѓР¶Р±Р° СЂР°СЃСЃС‹Р»РєРё </FONT></P>\r\n<DIV><FONT face=Verdana size=2></FONT></DIV>\r\n<UL>\r\n<LI><A href="%CHANGE_URL%" target=_blank><FONT face=Verdana size=2>Р?Р·РјРµРЅРёС‚СЊ РїРѕРґРїРёСЃРєСѓ</FONT></A><FONT face=Verdana size=2> </FONT>\r\n<LI><A href="%REMOVE_URL%" target=_blank><FONT face=Verdana size=2>РЈРґР°Р»РёС‚СЊ Р°РґСЂРµСЃ РёР· СЂР°СЃСЃС‹Р»РєРё</FONT></A><FONT face=Verdana size=2> <BR></FONT></LI></UL>', '/subscribe/', '<P>&nbsp;</P>\r\n<P>Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ!</P>\r\n<P>РџРѕСЃС‚СѓРїРёР» Р·Р°РїСЂРѕСЃ РЅР° РґРѕР±Р°РІР»РµРЅРёРµ РїРѕС‡С‚РѕРІРѕРіРѕ Р°РґСЂРµСЃР° <A href="mailto:%EMAIL%" target=_self>%EMAIL%</A> РІ РЅР°С? СЃРїРёСЃРѕРє СЂР°СЃСЃС‹Р»РєРё.</P>\r\n<UL>\r\n<LI>Р”Р°, <A href="%CONFIRM_URL%" target=_self>СЏ С…РѕС‡Сѓ РїРѕР»СѓС‡Р°С‚СЊ РґР°РЅРЅСѓСЋ СЂР°СЃСЃС‹Р»РєСѓ</A></LI>\r\n<LI>РќРµС‚, <A href="%REGRET_URL%" target=_self>СЏ РЅРµ С…РѕС‡Сѓ РїРѕР»СѓС‡Р°С‚СЊ РґР°РЅРЅСѓСЋ СЂР°СЃСЃС‹Р»РєСѓ</A></LI></UL>', 'support@m-2.ru');

-- --------------------------------------------------------


DROP TABLE IF EXISTS `subs_lists`;
CREATE TABLE `subs_lists` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(250) default NULL,
  `period` varchar(150) default NULL,
  `description` text,
  `lastsend` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
);


DROP TABLE IF EXISTS `subs_messages`;
CREATE TABLE `subs_messages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `lid` int(11) unsigned default '0',
  `subj` varchar(150) default NULL,
  `text` mediumtext,
  `html` mediumtext,
  `date_sent` int(10) unsigned NOT NULL default '0',
  `file` varchar(150) default NULL,
  PRIMARY KEY  (`id`)
) ;


DROP TABLE IF EXISTS `subs_subscribed`;
CREATE TABLE `subs_subscribed` (
  `lid` int(11) unsigned default NULL,
  `sid` int(11) unsigned default NULL,
  KEY `lid` (`lid`,`sid`)
);


DROP TABLE IF EXISTS `subs_users`;
CREATE TABLE `subs_users` (
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
);


DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(150) NOT NULL default '',
  `title` varchar(150) NOT NULL default '',
  `root` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `root` (`root`)
);


INSERT INTO `types` (`id`, `name`, `title`, `root`) VALUES (-1, 'index', 'Home page', 0);
INSERT INTO `types` (`id`, `name`, `title`, `root`) VALUES (1, 'news', 'News', 1);
INSERT INTO `types` (`id`, `name`, `title`, `root`) VALUES (2, 'sitemap', 'Sitemap', 0);

 

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
) ;


INSERT INTO `users` (`id`, `login`, `pass`, `name`, `email`, `description`, `admin`) VALUES (1, 'yarlson', '2b9c19c2b6740bbcdebd1a044e543b5c', 'Yar Kravtsov', 'kravtsovyar@mail.ru', '', 1);
INSERT INTO `users` (`id`, `login`, `pass`, `name`, `email`, `description`, `admin`) VALUES (2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, NULL, 1);
