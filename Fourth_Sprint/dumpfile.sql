-- To call this file (On CLAMV or locally):
-- cd into this dir
-- log into mysql with "mysql -u [your user] -p"
-- enter your password
-- run "mysql> source dumpfile.sql"


CREATE DATABASE IF NOT EXISTS `seteam20`;
USE `seteam20`;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Agent default credentials: Email: "admin" Password: "pass123"
INSERT INTO `admin` VALUES (1,'admin','pass123');

DROP TABLE IF EXISTS `hospital`;
CREATE TABLE `hospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Hospital default credentials: Username: "htest" Password: "htest"
INSERT INTO `hospital` VALUES (8,'default','htest','$2y$10$56oAGTI/CJfVH.MFJYPKyut46IkDf9cwaG3P9x3vXwRqZamnBv9Uu','124246','htest@email.com','accepted'),(2,'Big Hospital','bighospital','$2y$10$JH9osPH8euaMHpatCTG7JetZxWXMODvkIpJONBBRa7D2IiVzgCOBe','1234','savu@a.com','accepted'),(3,'Narnia Hospital','narnia','$2y$10$njYZqWnRQ2OW7JkAboezMe0LY8s/mLUGtWLXm0Eljm0mmlfpBkZmG','1234','narnia@narnia','accepted'),(4,'New Hospital','newhospital','$2y$10$RQmaQbsEUhRJ2YQwMb9YMeZ.qqI9uvEoxWOzo1lMNFfBF0SrWrIwO','12345678','new@gmail.com','rejected'),(5,'abc hospital','abc','$2y$10$I.A.1eN7I9K2KdVnhoPe3OpYeRziX6tyPyv4JoBEoBro1zsj72Gfi','223','a@abc.com','pending'),(7,'antonia hospital','antonia','$2y$10$Smafp4yPzaIyv5sf4V02HuMhfbce2iCBp0OKzhPrDUor3UJUdeD2.','244234','anto@gmail.com','accepted');

DROP TABLE IF EXISTS `place`;
CREATE TABLE `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipCode` varchar(50) NOT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `place` VALUES (2,'f','f','f','2','','f', '$2y$10$56oAGTI/CJfVH.MFJYPKyut46IkDf9cwaG3P9x3vXwRqZamnBv9Uu'),(3,'aasfa','sfwefuh','dsifuheiush','1232','23324','hello@gmail.com', '$2y$10$56oAGTI/CJfVH.MFJYPKyut46IkDf9cwaG3P9x3vXwRqZamnBv9Uu');

DROP TABLE IF EXISTS `visitor`;
CREATE TABLE `visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `phoneNumber` int(11) DEFAULT NULL,   -- phoneNumber allowed to be null
  `email` varchar(50) DEFAULT NULL,     -- email allowed to be null
  `password` varchar(100) NOT NULL,
  `deviceId` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Visitor default credentials: Email: "jdoe@email.com" Password: "password"
INSERT INTO `visitor` VALUES (1,'antonia','s','college','bremen',287,123456789,'a@savu.com','$2y$10$cLMNaf3qvDDrMFjHOhJzze.r5epbG3Vg90eOxt.Uf2SLFzUX21yky',NULL,'infected'),(2,'john','doe','street 1','bremen',12345,1579111315,'jdoe@email.com','$2y$10$WSgSfMZxFerC5s5nF.qlRO5md/D8mKpiloKOx2CMckaGw6kAwS2Ma',NULL,'uninfected');

DROP TABLE IF EXISTS `visitorToPlace`;
CREATE TABLE `visitorToPlace` (
  `citizen_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_date` date DEFAULT NULL,
  `entry_time` TIME DEFAULT NULL,
  `exit_date` date DEFAULT NULL, -- Exit date and time are NULL until data is given. Entry d&t should never be null but are allowed to be as they may be updated at different times. 
  `exit_time` TIME DEFAULT NULL,
  PRIMARY KEY (`visit_id`),
  FOREIGN KEY (`citizen_id`) REFERENCES `visitor` (`id`),
  FOREIGN KEY (`place_id`) REFERENCES `place` (`id`)
);