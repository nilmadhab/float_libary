-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2014 at 05:16 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hawking`
--

-- --------------------------------------------------------

--
-- Table structure for table `ebills`
--

CREATE TABLE IF NOT EXISTS `ebills` (
  `bill_id` int(32) NOT NULL AUTO_INCREMENT,
  `bill_comp_id` varchar(32) NOT NULL,
  `bill_user_id` char(32) NOT NULL,
  `bill_amt` double(64,0) NOT NULL,
  `bill_transac_id` varchar(64) DEFAULT NULL,
  `bill_status` varchar(10) DEFAULT NULL,
  `bill_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sno` int(8) NOT NULL,
  `particulars` varchar(64) DEFAULT NULL,
  `quantity` int(8) NOT NULL,
  `amount` double(64,0) NOT NULL,
  `bill_type` int(8) NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=585 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
