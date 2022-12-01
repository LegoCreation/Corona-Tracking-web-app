-- MariaDB dump 10.19  Distrib 10.5.15-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: seteam20
-- ------------------------------------------------------
-- Server version	10.5.15-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','pass123');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospital`
--

LOCK TABLES `hospital` WRITE;
/*!40000 ALTER TABLE `hospital` DISABLE KEYS */;
INSERT INTO `hospital` VALUES (2,'Big Hospital','bighospital','$2y$10$JH9osPH8euaMHpatCTG7JetZxWXMODvkIpJONBBRa7D2IiVzgCOBe','1234','savu@a.com','accepted'),(3,'Narnia Hospital','narnia','$2y$10$njYZqWnRQ2OW7JkAboezMe0LY8s/mLUGtWLXm0Eljm0mmlfpBkZmG','1234','narnia@narnia','accepted'),(4,'New Hospital','newhospital','$2y$10$RQmaQbsEUhRJ2YQwMb9YMeZ.qqI9uvEoxWOzo1lMNFfBF0SrWrIwO','12345678','new@gmail.com','rejected'),(5,'abc hospital','abc','$2y$10$I.A.1eN7I9K2KdVnhoPe3OpYeRziX6tyPyv4JoBEoBro1zsj72Gfi','223','a@abc.com','accepted'),(7,'antonia hospital','antonia','$2y$10$Smafp4yPzaIyv5sf4V02HuMhfbce2iCBp0OKzhPrDUor3UJUdeD2.','244234','anto@gmail.com','accepted'),(8,'default','htest','$2y$10$56oAGTI/CJfVH.MFJYPKyut46IkDf9cwaG3P9x3vXwRqZamnBv9Uu','124246','htest@email.com','accepted');
/*!40000 ALTER TABLE `hospital` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipCode` varchar(50) NOT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
INSERT INTO `place` VALUES (2,'f','f','f','2','','f'),(3,'aasfa','sfwefuh','dsifuheiush','1232','23324','hello@gmail.com');
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitor`
--

DROP TABLE IF EXISTS `visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `phoneNumber` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `deviceId` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitor`
--

LOCK TABLES `visitor` WRITE;
/*!40000 ALTER TABLE `visitor` DISABLE KEYS */;
INSERT INTO `visitor` VALUES (1,'antonia','s','college','bremen',287,123456789,'a@savu.com','$2y$10$cLMNaf3qvDDrMFjHOhJzze.r5epbG3Vg90eOxt.Uf2SLFzUX21yky',NULL,'uninfected'),(2,'john','doe','college','bremen',1234,123456,'john@doe.com','$2y$10$U8Cx9D.Gk5oLBBmnCsyRGuNdYJQWyDeVFgCcc44mXeLodi0S8hPq2',NULL,'infected'),(3,'final','F','G','jj',89,88,'final@gmail.com','$2y$10$Jd.i5Kh2MWvSxNVN0WGbG.7UnvHU4bGMyKyRnYdwCr.igalq27gIO',NULL,'uninfected'),(4,'a','b','c','d',1,123,'bb','$2y$10$0VfrnPZtQbTFHDS8qaXvoebLwMGXv.AQV3uB3fWkz8u5hd10j4zQq',NULL,'uninfected'),(5,'a','b','c','d',1,123,'bb@a.com','$2y$10$oBwZFQk63/2WUyjk3bCNtuirVhZ5wqN/CehtLTSVOYUJjRqtxwydS',NULL,'uninfected'),(6,'john','doe','street 1','bremen',12345,1579111315,'jdoe@email.com','$2y$10$WSgSfMZxFerC5s5nF.qlRO5md/D8mKpiloKOx2CMckaGw6kAwS2Ma',NULL,'uninfected');
/*!40000 ALTER TABLE `visitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitorToPlace`
--

DROP TABLE IF EXISTS `visitorToPlace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitorToPlace` (
  `citizen_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_date` date DEFAULT NULL,
  `entry_time` time DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `exit_time` time DEFAULT NULL,
  PRIMARY KEY (`visit_id`),
  KEY `citizen_id` (`citizen_id`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `visitorToPlace_ibfk_1` FOREIGN KEY (`citizen_id`) REFERENCES `visitor` (`id`),
  CONSTRAINT `visitorToPlace_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitorToPlace`
--

LOCK TABLES `visitorToPlace` WRITE;
/*!40000 ALTER TABLE `visitorToPlace` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitorToPlace` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-22 14:54:57
