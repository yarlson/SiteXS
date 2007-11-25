-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-3
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Июн 14 2007 г., 17:53
-- Версия сервера: 5.0.32
-- Версия PHP: 4.4.4-8+etch3
-- 
-- База данных: `sitexs`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `news`
-- 

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `time` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  `matID` int(14) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `news`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `subs_config`
-- 

DROP TABLE IF EXISTS `subs_config`;
CREATE TABLE `subs_config` (
  `test_email` varchar(150) default NULL,
  `text` text,
  `html` text,
  `url` varchar(255) NOT NULL default '',
  `confirm` text NOT NULL,
  `email_from` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Дамп данных таблицы `subs_config`
-- 

INSERT INTO `subs_config` (`test_email`, `text`, `html`, `url`, `confirm`, `email_from`) VALUES 
('support@m-2.ru', 'ÃÂ Ã¢â‚¬â€ÃÂ Ã’â€˜ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ Ãâ€ ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ãâ€ ÃÂ¡Ã‘â€œÃÂ Ã¢â€žâ€“ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ã‚Âµ%COMMA_NAME%!\r\n\r\n%TXT%\r\n\r\nÃÂ Ã¢â‚¬ÂÃÂ Ã‚Â»ÃÂ¡ÃÂ ÃÂ Ã‘â€˜ÃÂ Ã‚Â·ÃÂ Ã‘ËœÃÂ Ã‚ÂµÃÂ Ãâ€¦ÃÂ Ã‚ÂµÃÂ Ãâ€¦ÃÂ Ã‘â€˜ÃÂ¡ÃÂ ÃÂ Ã‘â€”ÃÂ Ã‚Â°ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ Ã‘ËœÃÂ Ã‚ÂµÃÂ¡Ã¢â‚¬Å¡ÃÂ¡Ãâ€šÃÂ Ã‘â€¢ÃÂ Ãâ€  ÃÂ Ã‘â€”ÃÂ Ã‘â€¢ÃÂ Ã’â€˜ÃÂ Ã‘â€”ÃÂ Ã‘â€˜ÃÂ¡ÃÆ’ÃÂ Ã‘â€ÃÂ Ã‘â€˜ ÃÂ Ãâ€¦ÃÂ Ã‚Â°ÃÂ Ã‚Â¶ÃÂ Ã‘ËœÃÂ Ã‘â€˜ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ã‚Âµ ÃÂ¡ÃÆ’ÃÂ Ã‚Â»ÃÂ Ã‚ÂµÃÂ Ã’â€˜ÃÂ¡Ã‘â€œÃÂ¡Ãâ€¹ÃÂ¡Ã¢â‚¬Â°ÃÂ¡Ã‘â€œÃÂ¡Ãâ€¹ ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ¡Ã‘â€œ\r\n%CHANGE_URL%\r\n\r\nÃÂ Ã¢â‚¬ÂÃÂ Ã‚Â»ÃÂ¡ÃÂ ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ã‘â€¢ÃÂ Ã‘â€“ÃÂ Ã‘â€¢, ÃÂ¡Ã¢â‚¬Â¡ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ã‘â€¢ÃÂ Ã‚Â±ÃÂ¡Ã¢â‚¬Â¹ ÃÂ Ãâ€ ÃÂ Ã‚Â°ÃÂ¡? ÃÂ Ã‚Â°ÃÂ Ã’â€˜ÃÂ¡Ãâ€šÃÂ Ã‚ÂµÃÂ¡ÃÆ’ ÃÂ Ã‚Â±ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â» ÃÂ¡Ã‘â€œÃÂ Ã’â€˜ÃÂ Ã‚Â°ÃÂ Ã‚Â»ÃÂ Ã‚ÂµÃÂ Ãâ€¦ ÃÂ Ã‘â€˜ÃÂ Ã‚Â· ÃÂ Ãâ€¦ÃÂ Ã‚Â°ÃÂ¡?ÃÂ Ã‚ÂµÃÂ Ã¢â€žâ€“ ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ Ã‘â€˜ ÃÂ Ãâ€¦ÃÂ Ã‚Â°ÃÂ Ã‚Â¶ÃÂ Ã‘ËœÃÂ Ã‘â€˜ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ã‚Âµ ÃÂ¡ÃÆ’ÃÂ Ã‚Â»ÃÂ Ã‚ÂµÃÂ Ã’â€˜ÃÂ¡Ã‘â€œÃÂ¡Ãâ€¹ÃÂ¡Ã¢â‚¬Â°ÃÂ¡Ã‘â€œÃÂ¡Ãâ€¹ ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ¡Ã‘â€œ\r\n%REMOVE_URL%\r\n\r\nÃÂ ÃÅ½ ÃÂ¡Ã‘â€œÃÂ Ãâ€ ÃÂ Ã‚Â°ÃÂ Ã‚Â¶ÃÂ Ã‚ÂµÃÂ Ãâ€¦ÃÂ Ã‘â€˜ÃÂ Ã‚ÂµÃÂ Ã‘Ëœ,\r\nÃÂ¡ÃÆ’ÃÂ Ã‚Â»ÃÂ¡Ã‘â€œÃÂ Ã‚Â¶ÃÂ Ã‚Â±ÃÂ Ã‚Â° ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ Ã‘â€˜ ', '<P><FONT face=Verdana size=2>ÃÂ Ã¢â‚¬â€ÃÂ Ã’â€˜ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ Ãâ€ ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ãâ€ ÃÂ¡Ã‘â€œÃÂ Ã¢â€žâ€“ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ã‚Âµ%COMMA_NAME%!</FONT></P>\r\n<P><FONT face=Verdana size=2></FONT></P><FONT face=Verdana size=2>\r\n<HR SIZE=1>\r\n</FONT>\r\n<P><FONT face=Verdana size=2>%HTML%</FONT></P>\r\n<P><FONT face=Verdana size=2></FONT></P><FONT face=Verdana size=2>\r\n<HR SIZE=1>\r\n</FONT>\r\n<P><FONT face=Verdana size=2>ÃÂ ÃÅ½ ÃÂ¡Ã‘â€œÃÂ Ãâ€ ÃÂ Ã‚Â°ÃÂ Ã‚Â¶ÃÂ Ã‚ÂµÃÂ Ãâ€¦ÃÂ Ã‘â€˜ÃÂ Ã‚ÂµÃÂ Ã‘Ëœ,<BR>ÃÂ ÃÅ½ÃÂ Ã‚Â»ÃÂ¡Ã‘â€œÃÂ Ã‚Â¶ÃÂ Ã‚Â±ÃÂ Ã‚Â° ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ Ã‘â€˜ </FONT></P>\r\n<DIV><FONT face=Verdana size=2></FONT></DIV>\r\n<UL>\r\n<LI><A href="%CHANGE_URL%" target=_blank><FONT face=Verdana size=2>ÃÂ ?ÃÂ Ã‚Â·ÃÂ Ã‘ËœÃÂ Ã‚ÂµÃÂ Ãâ€¦ÃÂ Ã‘â€˜ÃÂ¡Ã¢â‚¬Å¡ÃÂ¡ÃÅ  ÃÂ Ã‘â€”ÃÂ Ã‘â€¢ÃÂ Ã’â€˜ÃÂ Ã‘â€”ÃÂ Ã‘â€˜ÃÂ¡ÃÆ’ÃÂ Ã‘â€ÃÂ¡Ã‘â€œ</FONT></A><FONT face=Verdana size=2> </FONT>\r\n<LI><A href="%REMOVE_URL%" target=_blank><FONT face=Verdana size=2>ÃÂ ÃË†ÃÂ Ã’â€˜ÃÂ Ã‚Â°ÃÂ Ã‚Â»ÃÂ Ã‘â€˜ÃÂ¡Ã¢â‚¬Å¡ÃÂ¡ÃÅ  ÃÂ Ã‚Â°ÃÂ Ã’â€˜ÃÂ¡Ãâ€šÃÂ Ã‚ÂµÃÂ¡ÃÆ’ ÃÂ Ã‘â€˜ÃÂ Ã‚Â· ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ Ã‘â€˜</FONT></A><FONT face=Verdana size=2> <BR></FONT></LI></UL>', '/subscribe/', '<P>&nbsp;</P>\r\n<P>ÃÂ Ã¢â‚¬â€ÃÂ Ã’â€˜ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ Ãâ€ ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ãâ€ ÃÂ¡Ã‘â€œÃÂ Ã¢â€žâ€“ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ã‚Âµ!</P>\r\n<P>ÃÂ Ã‘Å¸ÃÂ Ã‘â€¢ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Å¡ÃÂ¡Ã‘â€œÃÂ Ã‘â€”ÃÂ Ã‘â€˜ÃÂ Ã‚Â» ÃÂ Ã‚Â·ÃÂ Ã‚Â°ÃÂ Ã‘â€”ÃÂ¡Ãâ€šÃÂ Ã‘â€¢ÃÂ¡ÃÆ’ ÃÂ Ãâ€¦ÃÂ Ã‚Â° ÃÂ Ã’â€˜ÃÂ Ã‘â€¢ÃÂ Ã‚Â±ÃÂ Ã‚Â°ÃÂ Ãâ€ ÃÂ Ã‚Â»ÃÂ Ã‚ÂµÃÂ Ãâ€¦ÃÂ Ã‘â€˜ÃÂ Ã‚Âµ ÃÂ Ã‘â€”ÃÂ Ã‘â€¢ÃÂ¡Ã¢â‚¬Â¡ÃÂ¡Ã¢â‚¬Å¡ÃÂ Ã‘â€¢ÃÂ Ãâ€ ÃÂ Ã‘â€¢ÃÂ Ã‘â€“ÃÂ Ã‘â€¢ ÃÂ Ã‚Â°ÃÂ Ã’â€˜ÃÂ¡Ãâ€šÃÂ Ã‚ÂµÃÂ¡ÃÆ’ÃÂ Ã‚Â° <A href="mailto:%EMAIL%" target=_self>%EMAIL%</A> ÃÂ Ãâ€  ÃÂ Ãâ€¦ÃÂ Ã‚Â°ÃÂ¡? ÃÂ¡ÃÆ’ÃÂ Ã‘â€”ÃÂ Ã‘â€˜ÃÂ¡ÃÆ’ÃÂ Ã‘â€¢ÃÂ Ã‘â€ ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ Ã‘â€˜.</P>\r\n<UL>\r\n<LI>ÃÂ Ã¢â‚¬ÂÃÂ Ã‚Â°, <A href="%CONFIRM_URL%" target=_self>ÃÂ¡ÃÂ ÃÂ¡Ã¢â‚¬Â¦ÃÂ Ã‘â€¢ÃÂ¡Ã¢â‚¬Â¡ÃÂ¡Ã‘â€œ ÃÂ Ã‘â€”ÃÂ Ã‘â€¢ÃÂ Ã‚Â»ÃÂ¡Ã‘â€œÃÂ¡Ã¢â‚¬Â¡ÃÂ Ã‚Â°ÃÂ¡Ã¢â‚¬Å¡ÃÂ¡ÃÅ  ÃÂ Ã’â€˜ÃÂ Ã‚Â°ÃÂ Ãâ€¦ÃÂ Ãâ€¦ÃÂ¡Ã‘â€œÃÂ¡Ãâ€¹ ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ¡Ã‘â€œ</A></LI>\r\n<LI>ÃÂ Ã‘Å“ÃÂ Ã‚ÂµÃÂ¡Ã¢â‚¬Å¡, <A href="%REGRET_URL%" target=_self>ÃÂ¡ÃÂ ÃÂ Ãâ€¦ÃÂ Ã‚Âµ ÃÂ¡Ã¢â‚¬Â¦ÃÂ Ã‘â€¢ÃÂ¡Ã¢â‚¬Â¡ÃÂ¡Ã‘â€œ ÃÂ Ã‘â€”ÃÂ Ã‘â€¢ÃÂ Ã‚Â»ÃÂ¡Ã‘â€œÃÂ¡Ã¢â‚¬Â¡ÃÂ Ã‚Â°ÃÂ¡Ã¢â‚¬Å¡ÃÂ¡ÃÅ  ÃÂ Ã’â€˜ÃÂ Ã‚Â°ÃÂ Ãâ€¦ÃÂ Ãâ€¦ÃÂ¡Ã‘â€œÃÂ¡Ãâ€¹ ÃÂ¡Ãâ€šÃÂ Ã‚Â°ÃÂ¡ÃÆ’ÃÂ¡ÃÆ’ÃÂ¡Ã¢â‚¬Â¹ÃÂ Ã‚Â»ÃÂ Ã‘â€ÃÂ¡Ã‘â€œ</A></LI></UL>', 'support@m-2.ru');

-- --------------------------------------------------------

-- 
-- Структура таблицы `subs_lists`
-- 

DROP TABLE IF EXISTS `subs_lists`;
CREATE TABLE `subs_lists` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(250) default NULL,
  `period` varchar(150) default NULL,
  `description` text,
  `lastsend` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `subs_lists`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `subs_messages`
-- 

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `subs_messages`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `subs_subscribed`
-- 

DROP TABLE IF EXISTS `subs_subscribed`;
CREATE TABLE `subs_subscribed` (
  `lid` int(11) unsigned default NULL,
  `sid` int(11) unsigned default NULL,
  KEY `lid` (`lid`,`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Дамп данных таблицы `subs_subscribed`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `subs_users`
-- 

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `subs_users`
-- 

