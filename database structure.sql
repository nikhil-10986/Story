-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 03, 2019 at 11:48 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `story`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `user_id`, `password`, `salt`, `last_login`, `status`, `date_added`) VALUES
(1, 'Nikhil Gupta', 'nikhil', 'e10adc3949ba59abbe56e057f20f883e', '987654', '2019-07-03 16:29:02', 1, '2019-07-02 17:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` text NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0-Draft,1-Published',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_status` int(11) NOT NULL DEFAULT '0' COMMENT '0-Unread,1-Read',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `heading`, `description`, `author_id`, `status`, `date_added`, `date_modified`, `read_status`) VALUES
(1, 'Test', 'Testing', 1, 1, '2019-07-03 11:25:43', '2019-07-03 11:25:43', 0),
(2, 'Test latest', 'Testing again', 1, 1, '2019-07-03 13:11:35', '2019-07-03 14:23:31', 0),
(3, 'Test2', 'Testinig  aadfdsfsdfs', 1, 1, '2019-07-03 14:20:45', '2019-07-03 14:20:45', 0),
(5, 'Test 1', 'Testing again', 1, 1, '2019-07-03 13:11:35', '2019-07-03 14:23:31', 0),
(6, 'Test2', 'Testinig  aadfdsfsdfs', 1, 1, '2019-07-03 14:20:45', '2019-07-03 14:20:45', 0),
(7, 'Test', 'Testing', 1, 1, '2019-07-03 11:25:43', '2019-07-03 11:25:43', 0),
(8, 'Test 1', 'Testing again', 1, 1, '2019-07-03 13:11:35', '2019-07-03 14:23:31', 0),
(9, 'Test 1', 'Testing again', 1, 1, '2019-07-03 13:11:35', '2019-07-03 14:23:30', 0),
(10, 'Test', 'Testing', 1, 1, '2019-07-03 11:25:43', '2019-07-03 11:25:43', 0),
(11, 'Test Oldest', 'Testing', 1, 1, '2019-07-03 11:25:43', '2019-07-03 11:25:43', 0),
(12, 'Test2', 'Testinig  aadfdsfsdfs', 1, 1, '2019-07-03 14:20:45', '2019-07-03 14:20:45', 0),
(13, 'Test older', 'Testinig  aadfdsfsdfs', 1, 1, '2019-07-03 14:20:45', '2019-07-03 14:20:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `story_history`
--

DROP TABLE IF EXISTS `story_history`;
CREATE TABLE IF NOT EXISTS `story_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) NOT NULL,
  `heading` text NOT NULL,
  `description` text NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
