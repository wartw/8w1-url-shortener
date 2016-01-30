-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Feb 20, 2009, 04:02 AM
-- 伺服器版本: 5.0.45
-- PHP 版本: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `8w1link`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `admin`
-- 

CREATE TABLE `admin` (
  `n` int(11) NOT NULL auto_increment,
  `id` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `nsme` varchar(255) NOT NULL,
  `ck` varchar(255) default NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY  (`n`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 列出以下資料庫的數據： `admin`
-- 

INSERT INTO `admin` VALUES (1, 'admin', 'admin', 'å…«è¬ä¸€çŸ­ç¶²å€', 'å…è²»ç°¡å–®çš„çŸ­ç¶²å€', '', 'http://127.0.0.1/');

-- --------------------------------------------------------

-- 
-- 資料表格式： `link`
-- 

CREATE TABLE `link` (
  `n` int(11) NOT NULL auto_increment,
  `url` varchar(255) NOT NULL,
  `pw` varchar(255) default NULL,
  `id` varchar(255) NOT NULL,
  PRIMARY KEY  (`n`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `link`
-- 

