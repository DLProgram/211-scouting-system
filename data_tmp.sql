-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2016 at 02:53 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `211`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_tmp`
--

CREATE TABLE IF NOT EXISTS `data_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_num` int(5) NOT NULL,
  `team_num` varchar(10) COLLATE armscii8_bin NOT NULL,
  `lift` tinyint(1) NOT NULL,
  `lifted` tinyint(1) NOT NULL,
  `auto` int(3) NOT NULL,
  `drive` int(3) NOT NULL,
  `team_num2` varchar(10) COLLATE armscii8_bin NOT NULL,
  `lift2` tinyint(1) NOT NULL,
  `lifted2` tinyint(1) NOT NULL,
  `auto2` int(3) NOT NULL,
  `drive2` int(3) NOT NULL,
  `user` varchar(10) COLLATE armscii8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `data_tmp`
--

INSERT INTO `data_tmp` (`id`, `match_num`, `team_num`, `lift`, `lifted`, `auto`, `drive`, `team_num2`, `lift2`, `lifted2`, `auto2`, `drive2`, `user`) VALUES
(5, 2, '1509B', 1, 0, 30, 70, '9599', 0, 1, 70, 30, 'test'),
(6, 3, '6060A', 0, 0, 0, 100, '3314D', 0, 0, 100, 0, 'test');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
