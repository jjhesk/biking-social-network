-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: 192.168.1.182
-- 生成日期: 2013 年 02 月 05 日 03:12
-- 服务器版本: 5.1.66
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `2012_fansliving_production`
--

-- --------------------------------------------------------

--
-- 表的结构 `activity_data`
--

create database 2012_ibike;
use 2012_ibike;

CREATE TABLE IF NOT EXISTS `activity_data` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_inhouse_id` double DEFAULT NULL,
  `app_id` int(11) DEFAULT NULL,
  `password` text NOT NULL COMMENT 'app identification code',
  `mode` varchar(250) NOT NULL,
  `title` text,
  `description` text,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'cannot be auto updated because prev/next activity ids will be dynamic',
  `has_ended` tinyint(1) NOT NULL DEFAULT '1',
  `coordinates_json` mediumtext,
  `avg_speed` float DEFAULT NULL,
  `max_speed` float DEFAULT NULL,
  `avg_temperature` float DEFAULT NULL,
  `avg_heart_rate` float DEFAULT NULL,
  `max_heart_rate` float DEFAULT NULL,
  `total_distance` text,
  `elapse_time` text,
  `elapse_time_sec` text,
  `total_calories` float DEFAULT NULL,
  `custom_data_json` mediumtext,
  `kml_path` text,
  `kml_checkpoints` text,
  `prev_activity_id` int(11) DEFAULT NULL,
  `next_activity_id` int(11) DEFAULT NULL,
  `privacy` text,
  `ip` text,
  `app_users_data_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `activity_search_for_input` (`user_inhouse_id`,`app_id`),
  KEY `mode` (`mode`,`app_users_data_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2415 ;

-- --------------------------------------------------------

--
-- 表的结构 `activity_photo`
--

CREATE TABLE IF NOT EXISTS `activity_photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo_description` text,
  `thumb_url` text,
  `full_url` text,
  `original_url` text,
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=742 ;

-- --------------------------------------------------------

--
-- 表的结构 `user_inhouse_data`
--

CREATE TABLE IF NOT EXISTS `user_inhouse_data` (
  `user_inhouse_id` int(32) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_privacy` tinyint(1) NOT NULL DEFAULT '1',
  `language` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `del` enum('y','n') NOT NULL DEFAULT 'n',
  `career` varchar(255) DEFAULT NULL,
  `profile_image` text,
  `gender` varchar(10) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `height_privacy` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'visible=1, hidden=0',
  `weight` int(11) DEFAULT NULL,
  `weight_privacy` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'visible=1, hidden=0',
  `birthday` date DEFAULT NULL,
  `birthday_privacy` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'visible=1, hidden=0',
  `apps_installed` text COMMENT 'move to table app_users, to remove ASAP.',
  `default_privacy` varchar(255) NOT NULL DEFAULT 'public',
  `social_media_publication` text,
  `photo_publication` text,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `customize_edit_count` int(11) DEFAULT NULL COMMENT 'record how many times the user change their data',
  `phone` text,
  `testing_field` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_inhouse_id`),
  KEY `our_id` (`user_inhouse_id`,`del`),
  KEY `privacy` (`default_privacy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=157 ;

-- --------------------------------------------------------

--
-- 表的结构 `user_oauth`
--

CREATE TABLE IF NOT EXISTS `user_oauth` (
  `user_oauth_id` double NOT NULL AUTO_INCREMENT,
  `oauth_server_id` text,
  `oauth_server_name` varchar(255) DEFAULT NULL COMMENT 'will be facebook, google, or some server',
  `user_inhouse_id` double DEFAULT NULL,
  `oauth_update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `session_time` datetime DEFAULT NULL,
  `code` text,
  PRIMARY KEY (`user_oauth_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- 表的结构 `user_openid`
--

CREATE TABLE IF NOT EXISTS `user_openid` (
  `user_openid_id` double NOT NULL AUTO_INCREMENT,
  `identity` text,
  `server` varchar(255) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `user_inhouse_id` double DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `avator` varchar(255) DEFAULT NULL,
  `gender` enum('m','f') DEFAULT NULL,
  PRIMARY KEY (`user_openid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=189 ;

-- --------------------------------------------------------

--
-- 表的结构 `user_relation`
--

CREATE TABLE IF NOT EXISTS `user_relation` (
  `subject_user_id` int(11) NOT NULL COMMENT 'myself',
  `object_user_id` int(11) NOT NULL COMMENT 'himself',
  `request` tinyint(1) NOT NULL COMMENT 'request from subject: 1 pending, 0 accepted',
  `block` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'block from subject',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
