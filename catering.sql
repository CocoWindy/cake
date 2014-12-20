-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 12 月 20 日 03:19
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `catering`
--
CREATE DATABASE IF NOT EXISTS `catering` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `catering`;

-- --------------------------------------------------------

--
-- 表的结构 `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sum` float NOT NULL,
  `pay_method` int(11) DEFAULT NULL,
  `pay_status` int(11) NOT NULL,
  `pay_sum` float NOT NULL,
  `pay_change` float NOT NULL,
  `remark` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `bills`
--

INSERT INTO `bills` (`id`, `number`, `room_id`, `time`, `sum`, `pay_method`, `pay_status`, `pay_sum`, `pay_change`, `remark`) VALUES
(1, 123456, 1, '0000-00-00 00:00:00', 0, NULL, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `head_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `dishs`
--

CREATE TABLE IF NOT EXISTS `dishs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `type` int(11) NOT NULL,
  `unit` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `dishs`
--

INSERT INTO `dishs` (`id`, `number`, `name`, `type`, `unit`, `price`, `discount`, `duration`, `status`) VALUES
(1, NULL, '剁椒鱼头', 0, NULL, 0, NULL, NULL, 0),
(2, NULL, '白灼虾', 0, NULL, 0, NULL, NULL, 0),
(3, NULL, '北京烤鸭', 0, NULL, 0, NULL, NULL, 0),
(4, NULL, '糖醋排骨哦', 0, NULL, 0, NULL, NULL, 0),
(5, NULL, '水煮鱼', 0, NULL, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `drinks`
--

CREATE TABLE IF NOT EXISTS `drinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `type` int(11) NOT NULL,
  `unit` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `drinks`
--

INSERT INTO `drinks` (`id`, `number`, `name`, `type`, `unit`, `price`, `discount`, `status`) VALUES
(1, NULL, '橙汁', 0, NULL, 0, NULL, 0),
(2, NULL, '椰汁', 0, NULL, 0, NULL, 0),
(3, NULL, '青岛纯生', 0, NULL, 0, NULL, 0),
(4, NULL, '香蕉牛奶', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `category` int(11) NOT NULL,
  `unit` varchar(20) CHARACTER SET utf8 NOT NULL,
  `count` int(11) NOT NULL,
  `upper_limit` int(11) DEFAULT NULL,
  `lower_limit` int(11) DEFAULT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `count` int(11) NOT NULL,
  `payrolls` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `drink_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `bill_id`, `dish_id`, `drink_id`, `count`, `status`, `time`, `worker_id`, `remark`) VALUES
(1, 1, 2, NULL, 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 1, NULL, 4, 0, 0, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operation` tinyint(4) NOT NULL,
  `number` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `good_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `count` int(11) NOT NULL,
  `unit` varchar(20) CHARACTER SET utf8 NOT NULL,
  `amount` float NOT NULL,
  `worker_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` date NOT NULL,
  `remark` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `rooms`
--

INSERT INTO `rooms` (`id`, `number`, `name`, `type`, `status`) VALUES
(1, 1, NULL, 0, 0),
(2, 2, NULL, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `store_records`
--

CREATE TABLE IF NOT EXISTS `store_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `change_count` int(11) NOT NULL,
  `operation` tinyint(4) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `worker_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `remark` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `category` int(11) NOT NULL,
  `linkman` varchar(20) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `address` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `workers`
--

CREATE TABLE IF NOT EXISTS `workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `birth` date NOT NULL,
  `id_number` varchar(20) CHARACTER SET utf8 NOT NULL,
  `address` varchar(20) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `job_id` int(11) NOT NULL,
  `entry_time` date NOT NULL,
  `remark` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
