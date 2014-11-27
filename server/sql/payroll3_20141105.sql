-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: payroll3
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `benefit`
--

DROP TABLE IF EXISTS `benefit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benefit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `damt` decimal(10,2) NOT NULL,
  `descr` text NOT NULL,
  `perc` tinyint(1) NOT NULL DEFAULT '0',
  `deduct` tinyint(1) NOT NULL DEFAULT '0',
  `taxable` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benefit`
--

LOCK TABLES `benefit` WRITE;
/*!40000 ALTER TABLE `benefit` DISABLE KEYS */;
INSERT INTO `benefit` VALUES (5,'Travel Expenses',10000.00,'N/A',0,1,0,1),(6,'Child Allowance',10.00,'N/A',1,0,0,0),(9,'Housing Allowance',10000.00,'N/A',0,0,1,1),(11,'NHIF',320.00,'N/A',0,1,0,1),(12,'NSSF',200.00,'N/A',0,1,0,1);
/*!40000 ALTER TABLE `benefit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'HR','Human Resource Department'),(3,'FIN','Finance Department'),(4,'IT','Information Technology and Support');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
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
  KEY `post_sequence` (`post`),
  CONSTRAINT `employee_post_post_id` FOREIGN KEY (`post`) REFERENCES `post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (5,'EMP1','Charles','Nderitu',3,'P. O. Box 12312\nPostal Code 122\nNBI\nKenya','n/a 2','987-3475-983-479','254-4444-555-666','swa@gmail.com','saw@ymail.com','nssf8734682346','nhif7826348','pinqw687234','M','Kenya','NBI SAM','1993-05-02','2011-05-17','2013-06-30','married','n/a bank acc',0),(9,'EMP2','George','Oyier',1,'','','254---','254---','','','','','','M','','','1993-05-17','2011-05-31','2011-05-25','single','',1);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhif`
--

DROP TABLE IF EXISTS `nhif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lbound` decimal(10,2) NOT NULL,
  `ubound` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhif`
--

LOCK TABLES `nhif` WRITE;
/*!40000 ALTER TABLE `nhif` DISABLE KEYS */;
INSERT INTO `nhif` VALUES (1,0.00,5999.00,150.00),(2,6001.00,7999.00,300.00),(3,8000.00,22222.00,400.00),(4,12000.00,14999.00,500.00),(5,15000.00,22222.00,600.00),(6,20000.00,24999.00,750.00),(7,25000.00,29999.00,850.00),(8,30000.00,49999.00,1000.00),(9,50000.00,99999.00,1500.00),(10,100000.00,99999999.99,2000.00);
/*!40000 ALTER TABLE `nhif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_benefit`
--

DROP TABLE IF EXISTS `pay_benefit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_benefit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_details` int(11) NOT NULL,
  `benefit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`pay_details`),
  KEY `benefit` (`benefit`),
  CONSTRAINT `pay_benefit_ibfk_1` FOREIGN KEY (`pay_details`) REFERENCES `pay_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pay_benefit_ibfk_2` FOREIGN KEY (`benefit`) REFERENCES `benefit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_benefit`
--

LOCK TABLES `pay_benefit` WRITE;
/*!40000 ALTER TABLE `pay_benefit` DISABLE KEYS */;
INSERT INTO `pay_benefit` VALUES (47,5,11),(48,5,12),(49,4,11),(50,4,12);
/*!40000 ALTER TABLE `pay_benefit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_details`
--

DROP TABLE IF EXISTS `pay_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `gross_salary` decimal(10,2) NOT NULL,
  `has_nhif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`),
  CONSTRAINT `pay_details_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_details`
--

LOCK TABLES `pay_details` WRITE;
/*!40000 ALTER TABLE `pay_details` DISABLE KEYS */;
INSERT INTO `pay_details` VALUES (4,5,100000.00,0),(5,9,100000.00,1);
/*!40000 ALTER TABLE `pay_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_nhif`
--

DROP TABLE IF EXISTS `pay_nhif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_nhif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_slip` int(11) NOT NULL,
  `nhif` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_slip` (`pay_slip`),
  KEY `nhif` (`nhif`),
  CONSTRAINT `pay_nhif_ibfk_1` FOREIGN KEY (`pay_slip`) REFERENCES `pay_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pay_nhif_ibfk_2` FOREIGN KEY (`nhif`) REFERENCES `nhif` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_nhif`
--

LOCK TABLES `pay_nhif` WRITE;
/*!40000 ALTER TABLE `pay_nhif` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_nhif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_nssf`
--

DROP TABLE IF EXISTS `pay_nssf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_nssf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_slip` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_slip` (`pay_slip`),
  CONSTRAINT `pay_nssf_ibfk_1` FOREIGN KEY (`pay_slip`) REFERENCES `pay_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_nssf`
--

LOCK TABLES `pay_nssf` WRITE;
/*!40000 ALTER TABLE `pay_nssf` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_nssf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_relief`
--

DROP TABLE IF EXISTS `pay_relief`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_relief` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_slip` int(11) NOT NULL,
  `relief` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_slip` (`pay_slip`,`relief`),
  KEY `relief` (`relief`),
  CONSTRAINT `pay_relief_ibfk_1` FOREIGN KEY (`pay_slip`) REFERENCES `pay_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pay_relief_ibfk_2` FOREIGN KEY (`relief`) REFERENCES `relief` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_relief`
--

LOCK TABLES `pay_relief` WRITE;
/*!40000 ALTER TABLE `pay_relief` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_relief` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_slip`
--

DROP TABLE IF EXISTS `pay_slip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_slip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `paye` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`,`period`),
  KEY `period` (`period`),
  KEY `paye` (`paye`),
  CONSTRAINT `pay_slip_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pay_slip_ibfk_2` FOREIGN KEY (`period`) REFERENCES `period` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pay_slip_ibfk_3` FOREIGN KEY (`paye`) REFERENCES `paye` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_slip`
--

LOCK TABLES `pay_slip` WRITE;
/*!40000 ALTER TABLE `pay_slip` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_slip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paye`
--

DROP TABLE IF EXISTS `paye`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paye` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mlbound` decimal(10,2) NOT NULL,
  `mubound` decimal(10,2) NOT NULL,
  `albound` decimal(10,2) NOT NULL,
  `aubound` decimal(10,2) NOT NULL,
  `rate` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paye`
--

LOCK TABLES `paye` WRITE;
/*!40000 ALTER TABLE `paye` DISABLE KEYS */;
INSERT INTO `paye` VALUES (1,0.00,10164.00,0.00,121968.00,'10'),(2,10165.00,19740.00,121969.00,236880.00,'15'),(3,19741.00,29316.00,236881.00,351792.00,'20'),(4,29317.00,38892.00,351793.00,466704.00,'25'),(5,38893.00,10000000.00,466704.00,10000000.00,'30');
/*!40000 ALTER TABLE `paye` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `period`
--

DROP TABLE IF EXISTS `period`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `period` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `period`
--

LOCK TABLES `period` WRITE;
/*!40000 ALTER TABLE `period` DISABLE KEYS */;
INSERT INTO `period` VALUES (9,'2011-05-19','2011-06-19','New-Period',1,5,5,'2011-05-19 00:34:11','2011-05-19 00:34:11');
/*!40000 ALTER TABLE `period` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `department_sequence` (`department`),
  CONSTRAINT `post_department_department_id` FOREIGN KEY (`department`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1,'HR Manager','Human Resource Managers'),(3,3,'Finance Manager','Finance Head');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relief`
--

DROP TABLE IF EXISTS `relief`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relief` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `monthly` decimal(10,2) NOT NULL,
  `annual` decimal(10,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relief`
--

LOCK TABLES `relief` WRITE;
/*!40000 ALTER TABLE `relief` DISABLE KEYS */;
INSERT INTO `relief` VALUES (1,'Personal Relief',1162.00,13944.00,1),(2,'Insurance Relief',5000.00,60000.00,1),(3,'Allowable Pension Fund Contribution',20000.00,240000.00,1),(4,'Allowable HOSP Contribution',4000.00,48000.00,1),(5,'Owner Occupier Interest',12500.00,150000.00,1);
/*!40000 ALTER TABLE `relief` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Administrator','Super Administrator\nRoot User'),(2,'Payroll Administrator','Payroll Administrator\nPayroll Manager'),(4,'Payroll User','Normal User\nPayroll User');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `role_sequence` (`role`),
  CONSTRAINT `user_role_role_id` FOREIGN KEY (`role`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'dkokello','d237a441598813f3c5e0d9266b984821781cbcb4',2),(4,'goyier','93dd8dac0fd4f956472bde4b49a0509a8d29cb47',1),(5,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-05 16:53:16
