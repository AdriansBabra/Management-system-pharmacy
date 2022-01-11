-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: phpdarbs
-- ------------------------------------------------------
-- Server version	5.7.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin@admin.com','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deleteduser`
--

DROP TABLE IF EXISTS `deleteduser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deleteduser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleteduser`
--

LOCK TABLES `deleteduser` WRITE;
/*!40000 ALTER TABLE `deleteduser` DISABLE KEYS */;
INSERT INTO `deleteduser` VALUES (1,'test','2022-01-11 18:33:12'),(2,'test','2022-01-11 18:35:29'),(3,'test','2022-01-11 18:35:31'),(4,'test','2022-01-11 18:36:47'),(5,'test2','2022-01-11 18:36:49'),(6,'test2','2022-01-11 18:37:11'),(7,'test2','2022-01-11 18:37:16'),(8,'test2','2022-01-11 18:37:27'),(9,'test2','2022-01-11 18:38:11'),(10,'test2','2022-01-11 18:38:45'),(11,'Ibumentin','2022-01-11 20:41:13');
/*!40000 ALTER TABLE `deleteduser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `feedbackdata` varchar(500) NOT NULL,
  `attachment` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,'test2','Admin','test','test',' '),(2,'test@test.com','Admin','sd','',' '),(3,'test@test.com','Admin','sd','',' '),(4,'test@test.com','Admin','sd','',' '),(5,'test@test.com','Admin','sd','',' '),(6,'test@test.com','Admin','sd','',' '),(7,'test@test.com','Admin','sd','',' ');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medics`
--

DROP TABLE IF EXISTS `medics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `producer` varchar(45) DEFAULT NULL,
  `quantity` varchar(10) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medics`
--

LOCK TABLES `medics` WRITE;
/*!40000 ALTER TABLE `medics` DISABLE KEYS */;
INSERT INTO `medics` VALUES (3,'JAUNAIS','test22','23','test test','44'),(4,'ibumentim','francija','55','jaunas zales pret covid','33'),(5,'test','test','5455','teessss','22'),(6,'test455','test55','324','tessssss','2'),(7,'TESTERS','2424','1111','124','12'),(8,'TESTERS','2424','1111','124','12');
/*!40000 ALTER TABLE `medics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notiuser` varchar(50) NOT NULL,
  `notireciver` varchar(50) NOT NULL,
  `notitype` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (18,'test','Admin','Create Account','2022-01-05 13:41:51'),(19,'test2','Admin','Create Account','2022-01-05 13:53:19'),(20,'test2','Admin','Create Account','2022-01-10 09:31:44'),(21,'test2','Admin','Create Account','2022-01-10 09:32:10'),(22,'test3','Admin','Create Account','2022-01-10 09:43:09'),(23,'test2','Admin','Create Account','2022-01-10 09:45:04'),(24,'test2','Admin','Send Feedback','2022-01-10 10:04:05'),(25,'test@test.com','Admin','Create Account','2022-01-10 11:51:30'),(26,'test@test.com','Admin','Send Feedback','2022-01-10 12:46:47'),(27,'test@test.com','Admin','Send Feedback','2022-01-10 12:47:20'),(28,'test@test.com','Admin','Send Feedback','2022-01-10 12:47:27'),(29,'test@test.com','Admin','Send Feedback','2022-01-10 12:48:00'),(30,'test@test.com','Admin','Send Feedback','2022-01-10 12:48:11'),(31,'test@test.com','Admin','Send Feedback','2022-01-10 12:49:04'),(32,'test@test.com','Admin','Send Feedback','2022-01-10 12:56:19'),(33,'test@test.com','Admin','Send Feedback','2022-01-10 12:57:40'),(34,'test@test.com','Admin','Send Feedback','2022-01-10 12:57:54'),(35,'test@test.com','Admin','Send Feedback','2022-01-10 12:58:12'),(36,'test@test.com','Admin','Send Feedback','2022-01-10 12:58:45'),(37,'test@test.com','Admin','Send Feedback','2022-01-10 12:59:41'),(38,'test@test.com','Admin','Send Feedback','2022-01-10 13:01:23'),(39,'test@test.com','Admin','Create Account','2022-01-10 19:58:49'),(40,'test@test.com','Admin','Send Feedback','2022-01-10 19:59:36'),(41,'Admin','test2','Send Message','2022-01-11 19:33:09'),(42,'Admin','test2','Send Message','2022-01-11 19:33:09'),(43,'Admin','test2','Send Message','2022-01-11 19:33:10'),(44,'Admin','test2','Send Message','2022-01-11 19:33:10'),(45,'Admin','test2','Send Message','2022-01-11 19:33:11'),(46,'Admin','test2','Send Message','2022-01-11 19:33:11'),(47,'Admin','test2','Send Message','2022-01-11 19:33:11'),(48,'Admin','test2','Send Message','2022-01-11 19:33:12'),(49,'Admin','test2','Send Message','2022-01-11 19:33:12'),(50,'Admin','test2','Send Message','2022-01-11 19:33:12'),(51,'Admin','test2','Send Message','2022-01-11 19:33:12'),(52,'Admin','test2','Send Message','2022-01-11 19:33:13'),(53,'Admin','test2','Send Message','2022-01-11 19:33:13'),(54,'Admin','test2','Send Message','2022-01-11 19:33:13'),(55,'Admin','test2','Send Message','2022-01-11 19:33:13'),(56,'Admin','test2','Send Message','2022-01-11 19:33:14'),(57,'Admin','test2','Send Message','2022-01-11 19:33:14'),(58,'Admin','test2','Send Message','2022-01-11 19:33:14'),(59,'Admin','test2','Send Message','2022-01-11 19:33:14'),(60,'Admin','test2','Send Message','2022-01-11 19:33:14'),(61,'Admin','test2','Send Message','2022-01-11 19:33:15'),(62,'Admin','test2','Send Message','2022-01-11 19:33:15'),(63,'Admin','test2','Send Message','2022-01-11 19:33:15'),(64,'Admin','test2','Send Message','2022-01-11 19:33:16'),(65,'Admin','test2','Send Message','2022-01-11 19:33:16'),(66,'Admin','test2','Send Message','2022-01-11 19:33:16'),(67,'Admin','test2','Send Message','2022-01-11 19:33:16'),(68,'Admin','test2','Send Message','2022-01-11 19:33:16'),(69,'Admin','test2','Send Message','2022-01-11 19:33:17'),(70,'Admin','test2','Send Message','2022-01-11 19:33:17'),(71,'Admin','test2','Send Message','2022-01-11 19:33:17'),(72,'Admin','test2','Send Message','2022-01-11 19:33:18'),(73,'Admin','test2','Send Message','2022-01-11 19:33:18'),(74,'Admin','test2','Send Message','2022-01-11 19:33:18'),(75,'Admin','test2','Send Message','2022-01-11 19:33:18'),(76,'Admin','test2','Send Message','2022-01-11 19:33:19'),(77,'Admin','test2','Send Message','2022-01-11 19:33:19'),(78,'Admin','test2','Send Message','2022-01-11 19:33:19'),(79,'Admin','test2','Send Message','2022-01-11 19:33:21'),(80,'test55@test.com','Admin','Create Account','2022-01-11 21:18:32');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (22,'test2asdasd','test2@test','098f6bcd4621d373cade4e832627b4f6','Male','214124124',0),(23,'test2','test2','098f6bcd4621d373cade4e832627b4f6','Male','214214',1),(24,'test3','test3','098f6bcd4621d373cade4e832627b4f6','Male','5214124',1),(25,'test2','test2','ad0234829205b9033196ba818f7a872b','Male','214124',1),(26,'Adrians','test@test.com','098f6bcd4621d373cade4e832627b4f6','Male','22222',1),(27,'test','test@test.com','098f6bcd4621d373cade4e832627b4f6','Male','4124124',1),(28,'test55','test55@test.com','7e39cfce74d155294619613f42484f18','Male','4242',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-12  0:39:17
