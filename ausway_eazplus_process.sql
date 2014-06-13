-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2014 at 04:19 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ausway`
--

-- --------------------------------------------------------

--
-- Table structure for table `ausway_eazplus_process`
--

CREATE TABLE IF NOT EXISTS `ausway_eazplus_process` (
  `process_unique_id` int(10) NOT NULL AUTO_INCREMENT,
  `process_id` int(10) NOT NULL,
  `process_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`process_unique_id`),
  UNIQUE KEY `process_id` (`process_id`),
  KEY `process_id_2` (`process_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `ausway_eazplus_process`
--

INSERT INTO `ausway_eazplus_process` (`process_unique_id`, `process_id`, `process_name`) VALUES
(19, 1, 'Start to prepare documents'),
(20, 2, 'Publishing Ads'),
(21, 3, 'Sporonship Prepare'),
(22, 4, 'Sporonship Submitted'),
(23, 5, 'Sporonship Docuemtns Required'),
(24, 6, 'Sporonship Approval'),
(25, 7, 'Sporonship Failed'),
(26, 8, 'Nomination prepare'),
(27, 9, 'Nomination submitted'),
(28, 10, 'Nomination Docuemtns Required'),
(29, 11, 'Nomination approval'),
(30, 12, 'Nomination Failed'),
(31, 13, 'Visa Application Prepare'),
(32, 14, 'Visa Application Submit'),
(33, 15, 'Visa Application Docuemtns Required'),
(34, 16, 'Visa Application Approval'),
(35, 17, 'Visa Application Failed'),
(36, 18, 'Deal Closed');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/*

INSERT INTO `aus_eazplus_process`(`process_id`, `process_name`) VALUES 
(1, 'Start to prepare documents'),
(2, 'Publishing Ads'),
(3, 'Sporonship Prepare'),
(4, 'Sporonship Submitted'),
(5, 'Sporonship Docuemtns Required'),
(6, 'Sporonship Approval'),
(7, 'Sporonship Failed'),
(8, 'Nomination prepare'),
(9, 'Nomination submitted'),
(10, 'Nomination Docuemtns Required'),
(11, 'Nomination approval'),
(12, 'Nomination Failed'),
(13, 'Visa Application Prepare'),
(14, 'Visa Application Submit'),
(15, 'Visa Application Docuemtns Required'),
(16, 'Visa Application Approval'),
(17, 'Visa Application Failed'),
(18, 'Deal Closed');

*/