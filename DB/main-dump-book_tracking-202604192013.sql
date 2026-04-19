/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.2.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: book_tracking
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `anon`
--

DROP TABLE IF EXISTS `anon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `anon` (
  `username` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_seen_datetime` datetime DEFAULT NULL,
  `joined_datetime` datetime DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `ip_addr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anon`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `anon` WRITE;
/*!40000 ALTER TABLE `anon` DISABLE KEYS */;
/*!40000 ALTER TABLE `anon` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `book_metadata`
--

DROP TABLE IF EXISTS `book_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `views` int(11) DEFAULT NULL,
  `requests` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_metadata`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `book_metadata` WRITE;
/*!40000 ALTER TABLE `book_metadata` DISABLE KEYS */;
INSERT INTO `book_metadata` VALUES
(1,50,5,NULL);
/*!40000 ALTER TABLE `book_metadata` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `desc` varchar(100) NOT NULL,
  `status` enum('available','requested','unavailable') NOT NULL,
  `requested_user_id` int(11) DEFAULT NULL,
  `added_by_user_id` int(11) DEFAULT NULL,
  `id_metadata` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_users_FK` (`requested_user_id`),
  KEY `books_users_FK_1` (`added_by_user_id`),
  KEY `books_book_metadata_FK` (`id_metadata`),
  KEY `books_categories_FK` (`id_category`),
  CONSTRAINT `books_book_metadata_FK` FOREIGN KEY (`id_metadata`) REFERENCES `book_metadata` (`id`),
  CONSTRAINT `books_categories_FK` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  CONSTRAINT `books_users_FK` FOREIGN KEY (`requested_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `books_users_FK_1` FOREIGN KEY (`added_by_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES
(4,'ewqqweqweq','qweqweweqwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww','unavailable',NULL,4,NULL,1),
(7,'teeest','gggggggg','available',4,3,1,1),
(8,'test','123123123','unavailable',NULL,4,NULL,1),
(9,'sdfsdfds','dsffsdsfd','unavailable',NULL,4,NULL,4),
(10,'alalalala','213010100101sdflksldf\r\n','available',5,4,NULL,4),
(11,'azzzaaaa','2dddddddddd','available',4,4,NULL,1),
(12,'ffffffffff13231','wqeqwe','available',NULL,4,NULL,1),
(13,'orrrr','rew','available',NULL,4,NULL,3),
(14,'fewsfesrsgg','eskuyui','available',NULL,4,NULL,2),
(15,'anyway','this is is is','available',NULL,4,NULL,2),
(16,'adding boring data','DATADATADATADATA','available',NULL,4,NULL,1),
(17,'buildings','buildingbuildingbuildingbuilding','unavailable',5,4,NULL,3),
(18,'book made by me','i am t','available',5,5,NULL,1);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Fantasy'),
(2,'Romance'),
(3,'Horror'),
(4,'History'),
(5,'Unknown');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_anon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_anon_FK` (`id_anon`),
  CONSTRAINT `users_anon_FK` FOREIGN KEY (`id_anon`) REFERENCES `anon` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(2,'test','test@gmail.com','$2y$12$glPIiZZtAxX5xD33Td0sxuB/j3a2ze5eFGqro1g0slxKkLjGpd2AK',NULL),
(3,'eko','eko','$2y$12$Qbrey7BFYpOXWUqdabYeyOj1n31tRIjLZHiWEKvkrqMVI.bQiG3qu',NULL),
(4,'1','1','$2y$12$AA8.1W/dsh0fLXWx1B1iN.2ujmdNH9.KFMAhfmpaHT2vB1RbOtCuq',NULL),
(5,'t','t','$2y$12$TtCzxCA7V6TFPb1pWOlqt.HzvCHhhq7kQ2R6lB28CXYQaqZOAlHI2',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Dumping routines for database 'book_tracking'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-04-19 20:13:12
