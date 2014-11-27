-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2011 at 08:31 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `payroll3`
--

-- --------------------------------------------------------

--
-- Table structure for table `benefit`
--

CREATE TABLE IF NOT EXISTS `benefit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `damt` decimal(10,2) NOT NULL,
  `descr` text NOT NULL,
  `perc` tinyint(1) NOT NULL DEFAULT '0',
  `deduct` tinyint(1) NOT NULL DEFAULT '0',
  `taxable` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `benefit`
--

INSERT INTO `benefit` (`id`, `name`, `damt`, `descr`, `perc`, `deduct`, `taxable`, `active`) VALUES
(5, 'Travel Expenses', '10000.00', 'N/A', 0, 1, 0, 1),
(6, 'Child Allowance', '10.00', 'N/A', 1, 0, 0, 0),
(9, 'Housing Allowance', '10000.00', 'N/A', 0, 0, 1, 1),
(11, 'NHIF', '320.00', 'N/A', 0, 1, 0, 1),
(12, 'NSSF', '200.00', 'N/A', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `descr`) VALUES
(1, 'HR', 'Human Resource Department'),
(3, 'FIN', 'Finance Department'),
(4, 'IT', 'Information Technology and Support');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(100) NOT NULL DEFAULT '',
  `surname` varchar(100) NOT NULL DEFAULT '',
  `othernames` varchar(100) NOT NULL DEFAULT '',
  `post` int(11) NOT NULL DEFAULT '0',
  `address1` varchar(255) NOT NULL DEFAULT '',
  `address2` varchar(255) NOT NULL DEFAULT '',
  `phone1` varchar(100) NOT NULL DEFAULT '',
  `phone2` varchar(100) NOT NULL DEFAULT '',
  `email1` varchar(100) NOT NULL DEFAULT '',
  `email2` varchar(100) NOT NULL DEFAULT '',
  `nssf` varchar(100) NOT NULL DEFAULT '',
  `nhif` varchar(100) NOT NULL DEFAULT '',
  `pin` varchar(100) NOT NULL DEFAULT '',
  `gender` varchar(1) NOT NULL DEFAULT 'M',
  `country` varchar(100) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `dob` date NOT NULL DEFAULT '1970-01-01',
  `start` date NOT NULL DEFAULT '1970-01-01',
  `end` date NOT NULL DEFAULT '1970-01-01',
  `status` varchar(100) NOT NULL DEFAULT '',
  `bankacc` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_sequence` (`post`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `no`, `surname`, `othernames`, `post`, `address1`, `address2`, `phone1`, `phone2`, `email1`, `email2`, `nssf`, `nhif`, `pin`, `gender`, `country`, `city`, `dob`, `start`, `end`, `status`, `bankacc`, `active`) VALUES
(5, 'EMP1', 'Charles', 'Nderitu', 3, 'P. O. Box 12312\nPostal Code 122\nNBI\nKenya', 'n/a 2', '987-3475-983-479', '254-4444-555-666', 'swa@gmail.com', 'saw@ymail.com', 'nssf8734682346', 'nhif7826348', 'pinqw687234', 'M', 'Kenya', 'NBI SAM', '1993-05-02', '2011-05-17', '2013-06-30', 'married', 'n/a bank acc', 0),
(9, 'EMP2', 'George', 'Oyier', 1, '', '', '254---', '254---', '', '', '', '', '', 'M', '', '', '1993-05-17', '2011-05-31', '2011-05-25', 'single', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nhif`
--

CREATE TABLE IF NOT EXISTS `nhif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lbound` decimal(10,2) NOT NULL,
  `ubound` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `nhif`
--

INSERT INTO `nhif` (`id`, `lbound`, `ubound`, `amount`) VALUES
(1, '0.00', '5999.00', '150.00'),
(2, '6001.00', '7999.00', '300.00'),
(3, '8000.00', '22222.00', '400.00'),
(4, '12000.00', '14999.00', '500.00'),
(5, '15000.00', '22222.00', '600.00'),
(6, '20000.00', '24999.00', '750.00'),
(7, '25000.00', '29999.00', '850.00'),
(8, '30000.00', '49999.00', '1000.00'),
(9, '50000.00', '99999.00', '1500.00'),
(10, '100000.00', '99999999.99', '2000.00');

-- --------------------------------------------------------

--
-- Table structure for table `paye`
--

CREATE TABLE IF NOT EXISTS `paye` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mlbound` decimal(10,2) NOT NULL,
  `mubound` decimal(10,2) NOT NULL,
  `albound` decimal(10,2) NOT NULL,
  `aubound` decimal(10,2) NOT NULL,
  `rate` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `paye`
--

INSERT INTO `paye` (`id`, `mlbound`, `mubound`, `albound`, `aubound`, `rate`) VALUES
(1, '0.00', '10164.00', '0.00', '121968.00', '10'),
(2, '10165.00', '19740.00', '121969.00', '236880.00', '15'),
(3, '19741.00', '29316.00', '236881.00', '351792.00', '20'),
(4, '29317.00', '38892.00', '351793.00', '466704.00', '25'),
(5, '38893.00', '10000000.00', '466704.00', '10000000.00', '30');

-- --------------------------------------------------------

--
-- Table structure for table `pay_benefit`
--

CREATE TABLE IF NOT EXISTS `pay_benefit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_details` int(11) NOT NULL,
  `benefit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`pay_details`),
  KEY `benefit` (`benefit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `pay_benefit`
--

INSERT INTO `pay_benefit` (`id`, `pay_details`, `benefit`) VALUES
(47, 5, 11),
(48, 5, 12),
(49, 4, 11),
(50, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pay_details`
--

CREATE TABLE IF NOT EXISTS `pay_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `gross_salary` decimal(10,2) NOT NULL,
  `has_nhif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pay_details`
--

INSERT INTO `pay_details` (`id`, `employee`, `gross_salary`, `has_nhif`) VALUES
(4, 5, '100000.00', 0),
(5, 9, '100000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pay_nhif`
--

CREATE TABLE IF NOT EXISTS `pay_nhif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_slip` int(11) NOT NULL,
  `nhif` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_slip` (`pay_slip`),
  KEY `nhif` (`nhif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pay_nhif`
--


-- --------------------------------------------------------

--
-- Table structure for table `pay_nssf`
--

CREATE TABLE IF NOT EXISTS `pay_nssf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_slip` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_slip` (`pay_slip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pay_nssf`
--


-- --------------------------------------------------------

--
-- Table structure for table `pay_relief`
--

CREATE TABLE IF NOT EXISTS `pay_relief` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_slip` int(11) NOT NULL,
  `relief` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_slip` (`pay_slip`,`relief`),
  KEY `relief` (`relief`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pay_relief`
--


-- --------------------------------------------------------

--
-- Table structure for table `pay_slip`
--

CREATE TABLE IF NOT EXISTS `pay_slip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `paye` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`,`period`),
  KEY `period` (`period`),
  KEY `paye` (`paye`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pay_slip`
--


-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE IF NOT EXISTS `period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `cby` int(11) NOT NULL,
  `mby` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `mdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`id`, `start`, `end`, `status`, `active`, `cby`, `mby`, `cdate`, `mdate`) VALUES
(9, '2011-05-19', '2011-06-19', 'New-Period', 1, 5, 5, '2011-05-19 00:34:11', '2011-05-19 00:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `department_sequence` (`department`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `department`, `name`, `descr`) VALUES
(1, 1, 'HR Manager', 'Human Resource Managers'),
(3, 3, 'Finance Manager', 'Finance Head');

-- --------------------------------------------------------

--
-- Table structure for table `relief`
--

CREATE TABLE IF NOT EXISTS `relief` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `monthly` decimal(10,2) NOT NULL,
  `annual` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `relief`
--

INSERT INTO `relief` (`id`, `name`, `monthly`, `annual`) VALUES
(1, 'Personal Relief', '1162.00', '13944.00'),
(2, 'Insurance Relief', '5000.00', '60000.00'),
(3, 'Allowable Pension Fund Contribution', '20000.00', '240000.00'),
(4, 'Allowable HOSP Contribution', '4000.00', '48000.00'),
(5, 'Owner Occupier Interest', '12500.00', '150000.00');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `descr`) VALUES
(1, 'Administrator', 'Super Administrator\nRoot User'),
(2, 'Payroll Administrator', 'Payroll Administrator\nPayroll Manager'),
(4, 'Payroll User', 'Normal User\nPayroll User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `role_sequence` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'dkokello', 'd237a441598813f3c5e0d9266b984821781cbcb4', 2),
(4, 'goyier', '93dd8dac0fd4f956472bde4b49a0509a8d29cb47', 1),
(5, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_post_post_id` FOREIGN KEY (`post`) REFERENCES `post` (`id`);

--
-- Constraints for table `pay_benefit`
--
ALTER TABLE `pay_benefit`
  ADD CONSTRAINT `pay_benefit_ibfk_1` FOREIGN KEY (`pay_details`) REFERENCES `pay_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay_benefit_ibfk_2` FOREIGN KEY (`benefit`) REFERENCES `benefit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_details`
--
ALTER TABLE `pay_details`
  ADD CONSTRAINT `pay_details_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_nhif`
--
ALTER TABLE `pay_nhif`
  ADD CONSTRAINT `pay_nhif_ibfk_1` FOREIGN KEY (`pay_slip`) REFERENCES `pay_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay_nhif_ibfk_2` FOREIGN KEY (`nhif`) REFERENCES `nhif` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_nssf`
--
ALTER TABLE `pay_nssf`
  ADD CONSTRAINT `pay_nssf_ibfk_1` FOREIGN KEY (`pay_slip`) REFERENCES `pay_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_relief`
--
ALTER TABLE `pay_relief`
  ADD CONSTRAINT `pay_relief_ibfk_1` FOREIGN KEY (`pay_slip`) REFERENCES `pay_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay_relief_ibfk_2` FOREIGN KEY (`relief`) REFERENCES `relief` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_slip`
--
ALTER TABLE `pay_slip`
  ADD CONSTRAINT `pay_slip_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay_slip_ibfk_2` FOREIGN KEY (`period`) REFERENCES `period` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay_slip_ibfk_3` FOREIGN KEY (`paye`) REFERENCES `paye` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_department_department_id` FOREIGN KEY (`department`) REFERENCES `department` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_role_id` FOREIGN KEY (`role`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
