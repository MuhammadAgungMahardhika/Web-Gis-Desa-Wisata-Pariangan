-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: pariangan
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `atraction`
--

DROP TABLE IF EXISTS `atraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atraction` (
  `id` varchar(2) NOT NULL,
  `name` varchar(40) NOT NULL,
  `category_atraction_id` varchar(2) NOT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `price` int DEFAULT NULL,
  `employe` varchar(25) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `description` text,
  `video_url` varchar(30) DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `geom_area` geometry DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attraction_category_attraction1_idx` (`category_atraction_id`),
  CONSTRAINT `fk_attraction_category_attraction1` FOREIGN KEY (`category_atraction_id`) REFERENCES `category_atraction` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atraction`
--

LOCK TABLES `atraction` WRITE;
/*!40000 ALTER TABLE `atraction` DISABLE KEYS */;
INSERT INTO `atraction` VALUES ('01','Kuburan Panjang','1','06:00:00','18:00:00',NULL,'Pokdarwis Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0ò9^žY@e/ÎŒ]Ý¿',NULL),('02','Batu Agam','1','00:00:00','23:59:00',NULL,'Pokdarwis Pariangan','082284978004',NULL,NULL,_binary '\0\0\0\0\0\0\0Œa€Y@‘$ôLRÝ¿',NULL),('03','Batu 50 Kota','1','00:00:00','23:59:00',NULL,'Pokdarwis Pariangan','082284978004',NULL,NULL,_binary '\0\0\0\0\0\0\08š+œ‡Y@¨‚›Ö·]Ý¿',NULL),('04','Batu Tanah Datar','1','00:00:00','23:59:00',NULL,'Pokdarwis Pariangan','082284978004',NULL,NULL,_binary '\0\0\0\0\0\0\0\éõ\Ä\Æ~Y@ À}\Ç^Ý¿',NULL),('05','Masjid Islah','1','03:00:00','21:00:00',NULL,'Nagari Tuo Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0öJ“1‚Y@@­X²VÝ¿',NULL),('06','Tabuah Larangan','2','00:00:00','23:59:00',NULL,'Nagari Tuo Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0\î‘rœ€Y@»i\n\ÏZÝ¿',NULL),('07','Panorama Pariangan','2','06:00:00','22:00:00',NULL,'Nagari Tuo Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0Aa’Y@¿d¡¥„Ü¿',NULL),('08','Surau Bandaro Kayo','2','03:00:00','21:00:00',NULL,'Nagari Tuo Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0*w\Ë~Y@³¸fUÝ¿',NULL),('09','Surau Sampono Kayo','2','03:00:00','21:00:00',NULL,'Nagari Tuo Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0\é5\ê\ß}Y@\á—úySQÝ¿',NULL),('10','Surau Suri Maharajo','2','03:00:00','21:00:00',NULL,'Nagari Tuo Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0\â;”Y@öl\Ê\ÓÁSÝ¿',NULL),('11','Surau Melayu','2','03:00:00','21:00:00',NULL,'Nagari Tuo Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0°ˆ\Î~Y@÷\ÛÇŸ\âWÝ¿',NULL),('12','Surau Inyiak Janna','2','03:00:00','21:00:00',NULL,'Nagari Tuo Pariangan',NULL,NULL,NULL,_binary '\0\0\0\0\0\0\0_*Ó»zY@\ï8fU[\\Ý¿',NULL);
/*!40000 ALTER TABLE `atraction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atraction_gallery`
--

DROP TABLE IF EXISTS `atraction_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atraction_gallery` (
  `id` varchar(2) NOT NULL,
  `atraction_id` varchar(2) NOT NULL,
  `url` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attraction_gallery_attraction1_idx` (`atraction_id`),
  CONSTRAINT `fk_attraction_gallery_attraction1` FOREIGN KEY (`atraction_id`) REFERENCES `atraction` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atraction_gallery`
--

LOCK TABLES `atraction_gallery` WRITE;
/*!40000 ALTER TABLE `atraction_gallery` DISABLE KEYS */;
INSERT INTO `atraction_gallery` VALUES ('01','02','1691412113_448d9537c4ba3fe007c1.jpg','2023-08-07 12:41:56','2023-08-07 12:41:56'),('02','02','1691412112_359abd9f0231a4d0c77c.jpg','2023-08-07 12:41:56','2023-08-07 12:41:56'),('03','02','1691412100_1ee76b29ea00f0eeda62.jpg','2023-08-07 12:41:56','2023-08-07 12:41:56'),('04','03','1691412207_1b0b73c70a2fd3cbc219.jpg','2023-08-07 12:43:46','2023-08-07 12:43:46'),('05','03','1691412199_f9556c19ef11a7e9e8cb.jpg','2023-08-07 12:43:46','2023-08-07 12:43:46'),('06','03','1691412195_667d4e3f17ccef1b9c35.jpg','2023-08-07 12:43:46','2023-08-07 12:43:46'),('07','04','1691412315_ab421bab26b337882727.jpg','2023-08-07 12:45:42','2023-08-07 12:45:42'),('08','04','1691412306_b9a48c080db31a54d870.jpg','2023-08-07 12:45:42','2023-08-07 12:45:42'),('09','04','1691412302_c6bfa0b205744e164d78.jpg','2023-08-07 12:45:42','2023-08-07 12:45:42'),('10','05','1692055922_007a45c1d233ff7a8919.jpg','2023-08-14 23:32:19','2023-08-14 23:32:19'),('11','05','1692055917_d5d388cbc801a3110b1c.jpg','2023-08-14 23:32:19','2023-08-14 23:32:19'),('12','05','1692055909_bbf8f25d78a890cc78af.jpg','2023-08-14 23:32:19','2023-08-14 23:32:19'),('13','06','1692056207_b142a923bdadea03e9e4.jpg','2023-08-14 23:36:56','2023-08-14 23:36:56'),('14','06','1692056207_80f64c921479997b1266.jpg','2023-08-14 23:36:56','2023-08-14 23:36:56'),('15','07','1692056283_685cd5d959a2f186e393.jpg','2023-08-14 23:38:22','2023-08-14 23:38:22'),('16','07','1692056285_536adad70f31f3b21e01.jpg','2023-08-14 23:38:22','2023-08-14 23:38:22'),('17','08','1692084082_1c7ccf4a484492462697.jpg','2023-08-15 07:21:43','2023-08-15 07:21:43'),('18','08','1692084082_2fee6dc0d0a9f3fe6c5e.jpg','2023-08-15 07:21:43','2023-08-15 07:21:43'),('20','10','1692084339_0760f2d85a4a5748172a.jpg','2023-08-15 07:26:27','2023-08-15 07:26:27'),('21','11','1692084617_2bb7a5549801d4735f3d.jpg','2023-08-15 07:30:35','2023-08-15 07:30:35'),('22','11','1692084616_443fc4eefb5dc5522a43.jpg','2023-08-15 07:30:35','2023-08-15 07:30:35'),('23','12','1692084742_a09151aac44b3beb8005.jpg','2023-08-15 07:32:30','2023-08-15 07:32:30'),('24','12','1692084727_d6fc904eba70102c94f5.jpg','2023-08-15 07:32:30','2023-08-15 07:32:30'),('25','09','1692085853_acd350f44c83cb2dedcb.jpg','2023-08-15 07:51:07','2023-08-15 07:51:07');
/*!40000 ALTER TABLE `atraction_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atraction_video`
--

DROP TABLE IF EXISTS `atraction_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atraction_video` (
  `id` varchar(8) NOT NULL,
  `atraction_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `atraction_video_atraction_id_foreign` (`atraction_id`),
  CONSTRAINT `atraction_video_atraction_id_foreign` FOREIGN KEY (`atraction_id`) REFERENCES `atraction` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atraction_video`
--

LOCK TABLES `atraction_video` WRITE;
/*!40000 ALTER TABLE `atraction_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `atraction_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_activation_attempts`
--

DROP TABLE IF EXISTS `auth_activation_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_activation_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_activation_attempts`
--

LOCK TABLES `auth_activation_attempts` WRITE;
/*!40000 ALTER TABLE `auth_activation_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_activation_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups`
--

DROP TABLE IF EXISTS `auth_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups`
--

LOCK TABLES `auth_groups` WRITE;
/*!40000 ALTER TABLE `auth_groups` DISABLE KEYS */;
INSERT INTO `auth_groups` VALUES (1,'admin','Site Administrator'),(2,'user','Reguler User');
/*!40000 ALTER TABLE `auth_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups_permissions`
--

DROP TABLE IF EXISTS `auth_groups_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_groups_permissions` (
  `group_id` int unsigned NOT NULL DEFAULT '0',
  `permission_id` int unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`),
  CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups_permissions`
--

LOCK TABLES `auth_groups_permissions` WRITE;
/*!40000 ALTER TABLE `auth_groups_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_groups_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_groups_users` (
  `group_id` int unsigned NOT NULL DEFAULT '0',
  `user_id` int unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`),
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups_users`
--

LOCK TABLES `auth_groups_users` WRITE;
/*!40000 ALTER TABLE `auth_groups_users` DISABLE KEYS */;
INSERT INTO `auth_groups_users` VALUES (1,1),(1,2),(2,3);
/*!40000 ALTER TABLE `auth_groups_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_logins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_logins`
--

LOCK TABLES `auth_logins` WRITE;
/*!40000 ALTER TABLE `auth_logins` DISABLE KEYS */;
INSERT INTO `auth_logins` VALUES (1,'::1','fauzanpiliang13@gmail.com',1,'2023-07-26 07:33:01',1),(2,'::1','fauzanpiliang13@gmail.com',1,'2023-07-27 09:28:51',1),(3,'::1','fauzanpiliang13@gmail.com',1,'2023-07-27 17:19:54',1),(4,'::1','  piliang13',NULL,'2023-08-04 22:16:11',0),(5,'::1','Piliang13',NULL,'2023-08-04 22:16:49',0),(6,'::1','fauzanpiliang13@gmail.com',1,'2023-08-04 22:17:42',1),(7,'::1','fauzanpiliang13@gmail.com',1,'2023-08-07 07:09:13',1),(8,'::1','fauzanpiliang13@gmail.com',1,'2023-08-07 12:34:51',1),(9,'::1','fauzanpiliang13@gmail.com',1,'2023-08-14 23:23:42',1),(10,'::1','fauzanpiliang13@gmail.com',1,'2023-08-15 07:15:36',1),(11,'::1','fauzanpiliang13@gmail.com',1,'2023-08-16 18:05:45',1),(12,'::1','admin',NULL,'2023-10-21 03:21:36',0),(13,'::1','m.agungmahardika12@gmail.com',2,'2023-10-21 03:22:11',1),(14,'::1','m.agungmahardika12@gmail.com',2,'2023-10-21 03:49:15',1),(15,'::1','m.agungmahardika12@gmail.com',2,'2023-10-21 03:50:14',1),(16,'::1','m.agungmahardika12@gmail.com',2,'2023-10-21 09:18:18',1),(17,'::1','m.agungmahardika12@gmail.com',2,'2023-10-22 05:50:36',1),(18,'::1','m.agungmahardika12@gmail.com',2,'2023-10-23 00:11:01',1),(19,'::1','m.agungmahardika12@gmail.com',2,'2023-10-23 04:28:36',1),(20,'::1','user@gmail.com',3,'2023-10-23 04:29:28',1),(21,'::1','admin',NULL,'2023-10-24 07:55:31',0),(22,'::1','admin',NULL,'2023-10-24 07:55:38',0),(23,'::1','m.agungmahardika12@gmail.com',NULL,'2023-10-24 07:55:55',0),(24,'::1','m.agungmahardika12@gmail.com',2,'2023-10-24 07:56:04',1),(25,'::1','user@gmail.com',NULL,'2023-10-24 07:58:15',0),(26,'::1','user@gmail.com',NULL,'2023-10-24 08:01:51',0),(27,'::1','user@gmail.com',NULL,'2023-10-24 08:09:56',0),(28,'::1','user@gmail.com',NULL,'2023-10-24 08:10:05',0),(29,'::1','user@gmail.com',NULL,'2023-10-24 08:10:18',0),(30,'::1','user@gmail.com',NULL,'2023-10-24 08:10:28',0),(31,'::1','user@gmail.com',NULL,'2023-10-24 08:11:56',0),(32,'::1','user@gmail.com',3,'2023-10-24 08:12:05',1),(33,'::1','m.agungmahardika12@gmail.com',NULL,'2023-10-24 11:34:43',0),(34,'::1','m.agungmahardika12@gmail.com',2,'2023-10-24 11:34:55',1),(35,'::1','m.agungmahardika12@gmail.com',2,'2023-10-24 16:51:57',1),(36,'::1','user@gmail.com',3,'2023-10-24 16:52:28',1),(37,'::1','user@gmail.com',3,'2023-10-25 03:03:20',1),(38,'::1','m.agungmahardika12@gmail.com',2,'2023-10-25 03:10:47',1),(39,'::1','m.agungmahardika12@gmail.com',2,'2023-10-25 10:14:39',1),(40,'::1','user@gmail.com',3,'2023-10-25 10:15:22',1),(41,'::1','m.agungmahardika12@gmail.com',2,'2023-10-25 10:37:26',1),(42,'::1','m.agungmahardika12@gmail.com',2,'2023-10-26 00:40:44',1),(43,'::1','m.agungmahardika12@gmail.com',2,'2023-10-26 01:08:30',1);
/*!40000 ALTER TABLE `auth_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_permissions`
--

DROP TABLE IF EXISTS `auth_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_permissions`
--

LOCK TABLES `auth_permissions` WRITE;
/*!40000 ALTER TABLE `auth_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_reset_attempts`
--

DROP TABLE IF EXISTS `auth_reset_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_reset_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_reset_attempts`
--

LOCK TABLES `auth_reset_attempts` WRITE;
/*!40000 ALTER TABLE `auth_reset_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_reset_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int unsigned NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`),
  CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_tokens`
--

LOCK TABLES `auth_tokens` WRITE;
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_users_permissions`
--

DROP TABLE IF EXISTS `auth_users_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_users_permissions` (
  `user_id` int unsigned NOT NULL DEFAULT '0',
  `permission_id` int unsigned NOT NULL DEFAULT '0',
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`),
  CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_users_permissions`
--

LOCK TABLES `auth_users_permissions` WRITE;
/*!40000 ALTER TABLE `auth_users_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_users_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_atraction`
--

DROP TABLE IF EXISTS `category_atraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_atraction` (
  `id` varchar(2) NOT NULL,
  `category` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_atraction`
--

LOCK TABLES `category_atraction` WRITE;
/*!40000 ALTER TABLE `category_atraction` DISABLE KEYS */;
INSERT INTO `category_atraction` VALUES ('1','uniq'),('2','ordinary');
/*!40000 ALTER TABLE `category_atraction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culinary_place`
--

DROP TABLE IF EXISTS `culinary_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `culinary_place` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `culinary_placecol` varchar(45) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `owner` varchar(25) DEFAULT NULL,
  `description` text,
  `geom` geometry DEFAULT NULL,
  `geom_area` geometry DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='									';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culinary_place`
--

LOCK TABLES `culinary_place` WRITE;
/*!40000 ALTER TABLE `culinary_place` DISABLE KEYS */;
INSERT INTO `culinary_place` VALUES ('01','Kadai Ni Rosi',NULL,NULL,'08:00:00','19:00:00','Uni Rosi',NULL,_binary '\0\0\0\0\0\0\0\Z\ã?´Y@©Ñ³r’ZÝ¿',NULL),('02','Kadai Rafli',NULL,NULL,'08:00:00','19:00:00','Rafli',NULL,_binary '\0\0\0\0\0\0\0O—AŒ‚Y@)öÁ\ÇZÝ¿',NULL),('03','Kadai Hadis',NULL,NULL,'08:00:00','19:00:00','Hadis',NULL,_binary '\0\0\0\0\0\0\0\áñ\í]ƒY@x{1[Ý¿',NULL),('04','Kadai Ulan',NULL,NULL,'08:00:00','19:00:00','Ulan',NULL,_binary '\0\0\0\0\0\0\0c(H\è~Y@nm\áy©XÝ¿',NULL),('05','Kadai Gudester',NULL,NULL,'08:00:00','19:00:00',NULL,NULL,_binary '\0\0\0\0\0\0\0\Ú\ÊlY@šˆ«˜Ü¿',NULL),('06','Kadai Tanjuang Indah',NULL,NULL,'08:00:00','19:00:00',NULL,NULL,_binary '\0\0\0\0\0\0\0{\èq\ÎþY@iü%V‡Ü¿',NULL),('07','Kadai Tanjuang Putuih',NULL,NULL,'09:00:00','19:00:00',NULL,NULL,_binary '\0\0\0\0\0\0\0ö‡Y@\ÚOJ1Õ†Ü¿',NULL),('08','Kawan Daun Puncak Mortir',NULL,NULL,'09:00:00','19:00:00',NULL,NULL,_binary '\0\0\0\0\0\0\0UÌ…Y@(\Ý+-‚Ü¿',NULL),('09','Palanta Kawa Daun A&F',NULL,NULL,'09:00:00','19:00:00',NULL,NULL,_binary '\0\0\0\0\0\0\0\n@\íY@)‘\éu0‡Ü¿',NULL);
/*!40000 ALTER TABLE `culinary_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culinary_place_gallery`
--

DROP TABLE IF EXISTS `culinary_place_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `culinary_place_gallery` (
  `id` varchar(2) NOT NULL,
  `culinary_place_id` varchar(2) NOT NULL,
  `url` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_culinary_place_gallery_culinary_place1_idx` (`culinary_place_id`),
  CONSTRAINT `fk_culinary_place_gallery_culinary_place1` FOREIGN KEY (`culinary_place_id`) REFERENCES `culinary_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culinary_place_gallery`
--

LOCK TABLES `culinary_place_gallery` WRITE;
/*!40000 ALTER TABLE `culinary_place_gallery` DISABLE KEYS */;
INSERT INTO `culinary_place_gallery` VALUES ('01','01','1690452360_46531b1009a9213d9edf.jpg','2023-07-27 10:06:05','2023-07-27 10:06:05'),('02','01','1690452359_bd6daf60cf7c42630b23.jpg','2023-07-27 10:06:05','2023-07-27 10:06:05'),('03','01','1690452362_8f98f14585b2d3c17b38.jpg','2023-07-27 10:06:05','2023-07-27 10:06:05'),('04','02','1690452669_31557ba4be709eea0279.jpg','2023-07-27 10:11:26','2023-07-27 10:11:26'),('05','03','1690478453_c964c2d8a296a5bed5c4.jpg','2023-07-27 17:21:10','2023-07-27 17:21:10'),('06','03','1690478453_e37c573fe2c46858bbbc.jpg','2023-07-27 17:21:10','2023-07-27 17:21:10'),('07','04','1690478519_ca8e5f226af69a0f0099.jpg','2023-07-27 17:22:11','2023-07-27 17:22:11'),('08','04','1690478518_f97b7fa4630f02ab6b02.jpg','2023-07-27 17:22:11','2023-07-27 17:22:11'),('09','05','1690478610_2e236b3bfe9c2d2f3645.jpg','2023-07-27 17:23:52','2023-07-27 17:23:52'),('10','05','1690478611_2a267a42578e5036f728.jpg','2023-07-27 17:23:52','2023-07-27 17:23:52'),('11','06','1690478699_cf1eb74f831ab961087f.jpg','2023-07-27 17:25:22','2023-07-27 17:25:22'),('12','06','1690478700_f3d2f7e670f5fa18f3b2.jpg','2023-07-27 17:25:22','2023-07-27 17:25:22'),('13','06','1690478703_25be47d9a82c1eb8e8ca.jpg','2023-07-27 17:25:22','2023-07-27 17:25:22'),('14','07','1690478786_e03b41f0f229829b220f.jpg','2023-07-27 17:26:43','2023-07-27 17:26:43'),('15','07','1690478785_b778336f41d1e60e0776.jpg','2023-07-27 17:26:43','2023-07-27 17:26:43'),('16','07','1690478788_e06df0c4b5248d9b5806.jpg','2023-07-27 17:26:43','2023-07-27 17:26:43'),('17','08','1690478944_b51851a0cb6e07ecf03f.jpg','2023-07-27 17:29:16','2023-07-27 17:29:16'),('18','08','1690478945_bd40e47b543354a58e18.jpg','2023-07-27 17:29:16','2023-07-27 17:29:16'),('19','09','1690479006_fbf347b7f2c7605877dd.jpg','2023-07-27 17:30:14','2023-07-27 17:30:14'),('20','09','1690479007_1acfb4f70a18895824de.jpg','2023-07-27 17:30:14','2023-07-27 17:30:14');
/*!40000 ALTER TABLE `culinary_place_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culinary_place_video`
--

DROP TABLE IF EXISTS `culinary_place_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `culinary_place_video` (
  `id` varchar(8) NOT NULL,
  `culinary_place_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `culinary_place_video_culinary_place_id_foreign` (`culinary_place_id`),
  CONSTRAINT `culinary_place_video_culinary_place_id_foreign` FOREIGN KEY (`culinary_place_id`) REFERENCES `culinary_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culinary_place_video`
--

LOCK TABLES `culinary_place_video` WRITE;
/*!40000 ALTER TABLE `culinary_place_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `culinary_place_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_menu`
--

DROP TABLE IF EXISTS `detail_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_menu` (
  `id` varchar(8) NOT NULL,
  `menu_id` varchar(8) NOT NULL,
  `culinary_place_id` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_menu_menu_id_foreign` (`menu_id`),
  KEY `detail_menu_culinary_place_id_foreign` (`culinary_place_id`),
  CONSTRAINT `detail_menu_culinary_place_id_foreign` FOREIGN KEY (`culinary_place_id`) REFERENCES `culinary_place` (`id`),
  CONSTRAINT `detail_menu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_menu`
--

LOCK TABLES `detail_menu` WRITE;
/*!40000 ALTER TABLE `detail_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_package`
--

DROP TABLE IF EXISTS `detail_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_package` (
  `id_package` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_day` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `activity` varchar(2) NOT NULL,
  `activity_type` varchar(1) DEFAULT NULL,
  `id_object` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id_package`,`id_day`,`activity`),
  KEY `fk_detail_package_package_day1_idx` (`id_package`,`id_day`),
  CONSTRAINT `fk_detail_package_package_day1` FOREIGN KEY (`id_package`, `id_day`) REFERENCES `package_day` (`id_package`, `day`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_package`
--

LOCK TABLES `detail_package` WRITE;
/*!40000 ALTER TABLE `detail_package` DISABLE KEYS */;
INSERT INTO `detail_package` VALUES ('01','6','10','','A01','Kuburan Panjang'),('01','6','11','','A02','Batu AGam'),('01','7','12','','C01','Sarapan pagi'),('01','7','13','','A06','Tabuah larangan'),('01','7','14','','A11','Sholat ashar berjamaah'),('01','7','15','','C08','Minum kawah daun malam malam'),('03','4','06','','A01','asdsa'),('03','4','07','','C02','Makan Siang'),('03','5','08','','A01','okee'),('03','5','09','','C03','Makan Siang');
/*!40000 ALTER TABLE `detail_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_product`
--

DROP TABLE IF EXISTS `detail_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_product` (
  `id` varchar(8) NOT NULL,
  `product_id` varchar(8) NOT NULL,
  `souvenir_place_id` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_product_product_id_foreign` (`product_id`),
  KEY `detail_product_souvenir_place_id_foreign` (`souvenir_place_id`),
  CONSTRAINT `detail_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `detail_product_souvenir_place_id_foreign` FOREIGN KEY (`souvenir_place_id`) REFERENCES `souvenir_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_product`
--

LOCK TABLES `detail_product` WRITE;
/*!40000 ALTER TABLE `detail_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_service_package`
--

DROP TABLE IF EXISTS `detail_service_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_service_package` (
  `id_service_package` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_package` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_service_package`,`id_package`),
  KEY `fk_detail_service_package_package1_idx` (`id_package`),
  CONSTRAINT `fk_detail_service_package_package1` FOREIGN KEY (`id_package`) REFERENCES `package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_service_package_service_package` FOREIGN KEY (`id_service_package`) REFERENCES `service_package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_service_package`
--

LOCK TABLES `detail_service_package` WRITE;
/*!40000 ALTER TABLE `detail_service_package` DISABLE KEYS */;
INSERT INTO `detail_service_package` VALUES ('01','01',NULL),('01','03',NULL),('02','01',NULL),('02','03',NULL);
/*!40000 ALTER TABLE `detail_service_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `price` int DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `description` text,
  `geom` geometry DEFAULT NULL,
  `geom_area` geometry DEFAULT NULL,
  `video_url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES ('01','tess',10000,'','2023-10-21','2023-10-24','08:00:00','18:00:00','this is a comment',_binary '\0\0\0\0\0\0\0º¬ºõ7Y@V\æ\Ö9@OÝ¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0Xd¿=Y@™|ñ.Ý¿Yd¿\í0Y@\íx·gÝ¿Yd¿cY@YˆÏcÝ¿Xd¿=Y@™|ñ.Ý¿',NULL);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_gallery`
--

DROP TABLE IF EXISTS `event_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_gallery` (
  `id` varchar(2) NOT NULL,
  `event_id` varchar(2) NOT NULL,
  `url` text,
  PRIMARY KEY (`id`),
  KEY `fk_event_gallery_event1_idx` (`event_id`),
  CONSTRAINT `fk_event_gallery_event1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_gallery`
--

LOCK TABLES `event_gallery` WRITE;
/*!40000 ALTER TABLE `event_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_video`
--

DROP TABLE IF EXISTS `event_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_video` (
  `id` varchar(8) NOT NULL,
  `event_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_video_event_id_foreign` (`event_id`),
  CONSTRAINT `event_video_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_video`
--

LOCK TABLES `event_video` WRITE;
/*!40000 ALTER TABLE `event_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facility`
--

DROP TABLE IF EXISTS `facility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facility` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `area_size` int DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `geom_area` geometry DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facility`
--

LOCK TABLES `facility` WRITE;
/*!40000 ALTER TABLE `facility` DISABLE KEYS */;
INSERT INTO `facility` VALUES ('02','Parking Area 1',100,_binary '\0\0\0\0\0\0\0ùs\ár‚Y@B\Þ­9YÝ¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0tG…ÄY@ŠgðŠ\âWÝ¿sGÍ€Y@q{gˆYÝ¿tGENƒY@ß…,¥¡ZÝ¿sGEÕƒY@\ÆK\çžYÝ¿sG…ÿ‚Y@÷±\èDYÝ¿sGpƒY@@P\É)oXÝ¿tG…ÄY@ŠgðŠ\âWÝ¿','05:00:00','21:00:00','Area parkir yang tersedia di sekitar Masjid Tuo Nagari Pariangan'),('03','Parking Area 2',60,_binary '\0\0\0\0\0\0\0\r‰½HY@H‰À—–Ü¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\É4\ÚVY@>\í$Y–Ü¿\É4z=Y@\ê\Ú1 H˜Ü¿\È4ºƒY@Ø¨k¡ª—Ü¿\É4z\ÄY@‘]:EÁ•Ü¿\É4\ÚVY@>\í$Y–Ü¿','08:00:00','19:00:00','Area Parkir yang disediakan di sekitar Kadai Guidester'),('04','Lapangan Bola Suthan Suri',7000,_binary '\0\0\0\0\0\0\0BÏ…Y@­ú\ZQó8Ý¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\ßFÂŸ€Y@@~(\Ï3Ý¿\ÞFBÿ‚Y@ƒ”`<?Ý¿\ÝF‚™ŠY@\ÉõiK\Ñ<Ý¿\ßF\rˆY@M`\Î\àˆ2Ý¿\ßFÂŸ€Y@@~(\Ï3Ý¿','08:00:00','19:00:00','Lapangan bola yang terletak di jalan utama Nagari Tuo Pariangan'),('05','Pemandian Rangek Rajo',18,_binary '\0\0\0\0\0\0\0„FœxY@\ÏÊ¬”T\\Ý¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0\îQ\ÏUwY@\å\ãi–F[Ý¿\ìQ\ïwY@?^Ó¹\\Ý¿\íQ#yY@‰Q‰]Ý¿\íQ\ÏDyY@´uö@[Ý¿\îQ\ÏUwY@\å\ãi–F[Ý¿','05:00:00','19:00:00','Pemandian Rangek Rajo khusus bagi wisatawan yang ingin berenang air hangat'),('06','Pemandian Air Panas',20,_binary '\0\0\0\0\0\0\0z/„Y@žt“\\Ý¿',NULL,'04:00:00','21:00:00','Pemandian gratis bagi wisatawan yang ingin menikmati hangatnya  air dari Nagari Tuo Pariangan'),('07','Toilet Umum',8,_binary '\0\0\0\0\0\0\0($ƒY@\r;\ÝýZÝ¿',NULL,'04:00:00','21:00:00','Toilet umum yang ada di sekitaran Masjid Tuo Pariangan');
/*!40000 ALTER TABLE `facility` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facility_gallery`
--

DROP TABLE IF EXISTS `facility_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facility_gallery` (
  `id` varchar(2) NOT NULL,
  `facility_id` varchar(2) NOT NULL,
  `url` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_facility_gallery_facility1_idx` (`facility_id`),
  CONSTRAINT `fk_facility_gallery_facility1` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facility_gallery`
--

LOCK TABLES `facility_gallery` WRITE;
/*!40000 ALTER TABLE `facility_gallery` DISABLE KEYS */;
INSERT INTO `facility_gallery` VALUES ('03','03','1691188982_b8c665b11be9634fab8c.jpg','2023-08-04 22:43:48','2023-08-04 22:43:48'),('04','02','1691189103_18e6ab4401a474115407.jpg','2023-08-04 22:45:04','2023-08-04 22:45:04'),('05','02','1691189103_c5f4f273a30e49c945ff.jpg','2023-08-04 22:45:04','2023-08-04 22:45:04'),('06','04','1691189529_03441815c78e4867f623.jpg','2023-08-04 22:52:14','2023-08-04 22:52:14'),('07','04','1691189531_c35efc7b5963f6280cf4.jpg','2023-08-04 22:52:14','2023-08-04 22:52:14'),('08','04','1691189528_5064f5c0ccde82e5b0ba.jpg','2023-08-04 22:52:14','2023-08-04 22:52:14'),('09','05','1691191254_85cb2184414fbf8a648b.jpg','2023-08-04 23:22:02','2023-08-04 23:22:02'),('10','06','1691191445_0d0b2ec1b883cd4aedff.jpg','2023-08-04 23:25:01','2023-08-04 23:25:01'),('11','06','1691191446_8bfb1abf2af3425e7ee0.jpg','2023-08-04 23:25:01','2023-08-04 23:25:01'),('12','06','1691191448_162af295fdbac0feaa96.jpg','2023-08-04 23:25:01','2023-08-04 23:25:01'),('13','07','1691191674_48fde928b3f4a7ddff15.jpg','2023-08-04 23:28:33','2023-08-04 23:28:33'),('14','07','1691191674_abf5fdc9ad35adbf444f.jpg','2023-08-04 23:28:33','2023-08-04 23:28:33');
/*!40000 ALTER TABLE `facility_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facility_video`
--

DROP TABLE IF EXISTS `facility_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facility_video` (
  `id` varchar(8) NOT NULL,
  `facility_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facility_video_facility_id_foreign` (`facility_id`),
  CONSTRAINT `facility_video_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facility_video`
--

LOCK TABLES `facility_video` WRITE;
/*!40000 ALTER TABLE `facility_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `facility_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homestay`
--

DROP TABLE IF EXISTS `homestay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homestay` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `area_size` varchar(50) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `geom_area` geometry DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homestay`
--

LOCK TABLES `homestay` WRITE;
/*!40000 ALTER TABLE `homestay` DISABLE KEYS */;
INSERT INTO `homestay` VALUES ('01','Homestay 1 tesaa','10','09:00:00','17:00:00','asdas',_binary '\0\0\0\0\0\0\0\Î@<}ŠY@\Ï\ÖEú‚PÝ¿',NULL,NULL,NULL);
/*!40000 ALTER TABLE `homestay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homestay_gallery`
--

DROP TABLE IF EXISTS `homestay_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homestay_gallery` (
  `id` varchar(8) NOT NULL,
  `homestay_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `homestay_gallery_homestay_id_foreign` (`homestay_id`),
  CONSTRAINT `homestay_gallery_homestay_id_foreign` FOREIGN KEY (`homestay_id`) REFERENCES `homestay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homestay_gallery`
--

LOCK TABLES `homestay_gallery` WRITE;
/*!40000 ALTER TABLE `homestay_gallery` DISABLE KEYS */;
INSERT INTO `homestay_gallery` VALUES ('01','01','1698281602_acd153b6ab65f30ecbd4.png','2023-10-25 17:53:45','2023-10-25 17:53:45'),('02','01','1698281602_4782ee1113cf36bcef31.png','2023-10-25 17:53:45','2023-10-25 17:53:45');
/*!40000 ALTER TABLE `homestay_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `menu_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017-11-20-223112','Myth\\Auth\\Database\\Migrations\\CreateAuthTables','default','Myth\\Auth',1690214058,1),(2,'2022-07-13-025921','App\\Database\\Migrations\\Pariangan','default','App',1690214058,1),(3,'2022-07-13-025948','App\\Database\\Migrations\\Event','default','App',1690214058,1),(4,'2022-07-13-030025','App\\Database\\Migrations\\CulinaryPlace','default','App',1690214058,1),(5,'2022-07-13-030048','App\\Database\\Migrations\\SouvenirPlace','default','App',1690214058,1),(6,'2022-07-13-030112','App\\Database\\Migrations\\WorshipPlace','default','App',1690214058,1),(7,'2022-07-13-030132','App\\Database\\Migrations\\Facility','default','App',1690214058,1),(8,'2022-07-13-030159','App\\Database\\Migrations\\Atraction','default','App',1690214058,1),(9,'2022-07-13-032655','App\\Database\\Migrations\\ParianganGallery','default','App',1690214058,1),(10,'2022-07-13-032926','App\\Database\\Migrations\\ParianganVideo','default','App',1690214058,1),(11,'2022-07-13-033252','App\\Database\\Migrations\\AtractionGallery','default','App',1690214058,1),(12,'2022-07-13-033459','App\\Database\\Migrations\\AtractionVideo','default','App',1690214058,1),(13,'2022-07-13-033634','App\\Database\\Migrations\\EventGallery','default','App',1690214058,1),(14,'2022-07-13-033742','App\\Database\\Migrations\\EventVideo','default','App',1690214058,1),(15,'2022-07-13-033829','App\\Database\\Migrations\\FacilityGallery','default','App',1690214058,1),(16,'2022-07-13-033839','App\\Database\\Migrations\\FacilityVideo','default','App',1690214058,1),(17,'2022-07-13-033936','App\\Database\\Migrations\\WorshipPlaceGallery','default','App',1690214058,1),(18,'2022-07-13-033956','App\\Database\\Migrations\\WorshipPlaceVideo','default','App',1690214058,1),(19,'2022-07-13-034414','App\\Database\\Migrations\\CulinaryPlaceGallery','default','App',1690214058,1),(20,'2022-07-13-034423','App\\Database\\Migrations\\CulinaryPlaceVideo','default','App',1690214058,1),(21,'2022-07-13-034537','App\\Database\\Migrations\\SouvenirPlaceGallery','default','App',1690214058,1),(22,'2022-07-13-034547','App\\Database\\Migrations\\SouvenirPlaceVideo','default','App',1690214058,1),(23,'2022-07-13-034817','App\\Database\\Migrations\\Product','default','App',1690214058,1),(24,'2022-07-13-035312','App\\Database\\Migrations\\DetailProduct','default','App',1690214058,1),(25,'2022-07-13-035640','App\\Database\\Migrations\\Menu','default','App',1690214058,1),(26,'2022-07-13-035731','App\\Database\\Migrations\\DetailMenu','default','App',1690214058,1),(27,'2022-07-18-040720','App\\Database\\Migrations\\ReviewAtraction','default','App',1690214058,1),(28,'2022-08-14-022634','App\\Database\\Migrations\\Comment','default','App',1690214058,1),(29,'2023-10-23-041428','App\\Database\\Migrations\\Reservation','default','App',1698034506,2),(30,'2023-10-23-041559','App\\Database\\Migrations\\ReservationStatus','default','App',1698034570,3),(31,'2023-10-24-130707','App\\Database\\Migrations\\Reservation','default','App',1698152838,4),(32,'2023-10-24-130939','App\\Database\\Migrations\\Reservation','default','App',1698152984,5),(33,'2023-10-26-001131','App\\Database\\Migrations\\Homestay','default','App',1698279621,6),(34,'2023-10-26-001152','App\\Database\\Migrations\\HomestayGallery','default','App',1698279621,6),(35,'2023-10-26-004717','App\\Database\\Migrations\\HomestayGallery','default','App',1698281248,7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `package` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `date` date DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `cp` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text,
  `url` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` VALUES ('01','Paket wisata tes 1',NULL,10,'6281373517899','','1698242182_a8076fe792e3bb144ae7.png',100000),('03','tes',NULL,10,'1','',NULL,1);
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_day`
--

DROP TABLE IF EXISTS `package_day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `package_day` (
  `id_package` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `day` varchar(2) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_package`,`day`),
  KEY `fk_package_day_package1_idx` (`id_package`),
  CONSTRAINT `fk_package_day_package1` FOREIGN KEY (`id_package`) REFERENCES `package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_day`
--

LOCK TABLES `package_day` WRITE;
/*!40000 ALTER TABLE `package_day` DISABLE KEYS */;
INSERT INTO `package_day` VALUES ('01','6',NULL),('01','7',NULL),('03','4',NULL),('03','5',NULL);
/*!40000 ALTER TABLE `package_day` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pariangan`
--

DROP TABLE IF EXISTS `pariangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pariangan` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `type_of_tourism` varchar(50) DEFAULT NULL,
  `address` text,
  `ticket_price` varchar(25) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `description` text,
  `video_url` text,
  `geom` geometry DEFAULT NULL,
  `geom_area` geometry DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `youtube` varchar(50) DEFAULT NULL,
  `tiktok` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pariangan`
--

LOCK TABLES `pariangan` WRITE;
/*!40000 ALTER TABLE `pariangan` DISABLE KEYS */;
INSERT INTO `pariangan` VALUES ('1','Nagari Tuo Pariangan','kontol','06:00:00','18:00:00','Eco Tourism, Education, Nature','Kec. Pariangan, Kab. Tanah Datar, Prov. Sumatera Barat','-','082218141289','Nagari Tuo Pariangan merupakan salah satu nagari/desa yang ada di Kabupaten Tanah Datar. Terletak di lereng gunung merapi Kecamatan Pariangan Kabupaten Tanah Datar. Nagari Tuo Pariangan berada di antara Kota Batusangkar dan Kota Padang Panjang, Nagari Tuo Pariangan berjarak 95 kilometer dari utara Kota Padang dan 35 kilometer dari Kota Bukittinggi dan nagari ini memiliki luas 17,97 kilometer persegi.\r\nSecara geografis, Nagari Tuo Pariangan terletak dilereng Gunung Marapi yang masih aktif hingga saat ini. Rumah Gadang yang dijadikan tempat tinggal oleh penduduk di Nagari Tuo Pariangan juga tidak biasa. Meskipun terlihat tua, rumah-rumah tersebut masih terlihat apik dan khas karena motif-motif minang. Uniknya, masyarakat desa membangun rumah-rumah tersebut secara tradisional dan tanpa menggunakan paku. \r\nNagari Tuo Pariangan merupakan nagari yang memiliki keistimewaan tersendiri bagi masyarakat Minangkabau. Dalam catatan sejarah yang terekam dalam tambo Minang menunjukkan bahwa Nagari Tuo Pariangan adalah nagari asal suku Minangkabau yang oleh masyarakat setempat disebut sebagai Tampuk Tangkai Alam Minangkabau. Artinya, nagari ini dipercaya sebagai tempat pertama munculnya kehidupan di Alam Minangkabau ratusan tahun silam.\r\n',NULL,_binary '\0\0\0\0\0\0\0Yd¿4Y@B,öò–Ý¿',_binary '\æ\0\0\0\0\0\0\0\0\r\0\0\0K¾\×\ÎY@WJCC¨`Ü¿J¾w\ÔY@\Æ6Ÿ|\ÄÜ¿K¾\'\èY@x–C/6fÝ¿L¾?ýY@U\Ï|ue½Ý¿K¾Y@&—5\í\ÚÝ¿K¾\Ï\ÕY@®Ëœ«Ý¿L¾G Y@$Ý«¤Ý¿K¾—þY@\îA\Æ]Ý¿K¾O\ìY@\Îy…°V(Ý¿K¾¯¹Y@üÕ­\çž\rÝ¿L¾-Y@1Z\Î^˜RÜ¿K¾g Y@²\ÉL˜5Ü¿K¾\×\ÎY@WJCC¨`Ü¿',NULL,'pokdarwis.pariangan',NULL,'pokdarwis.pariangan');
/*!40000 ALTER TABLE `pariangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pariangan_gallery`
--

DROP TABLE IF EXISTS `pariangan_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pariangan_gallery` (
  `id` varchar(2) NOT NULL,
  `pariangan_id` varchar(2) NOT NULL,
  `url` text,
  PRIMARY KEY (`id`),
  KEY `fk_pariangan_gallery_pariangan1_idx` (`pariangan_id`),
  CONSTRAINT `fk_pariangan_gallery_pariangan1` FOREIGN KEY (`pariangan_id`) REFERENCES `pariangan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pariangan_gallery`
--

LOCK TABLES `pariangan_gallery` WRITE;
/*!40000 ALTER TABLE `pariangan_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `pariangan_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pariangan_video`
--

DROP TABLE IF EXISTS `pariangan_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pariangan_video` (
  `id` varchar(8) NOT NULL,
  `pariangan_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pariangan_video_pariangan_id_foreign` (`pariangan_id`),
  CONSTRAINT `pariangan_video_pariangan_id_foreign` FOREIGN KEY (`pariangan_id`) REFERENCES `pariangan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pariangan_video`
--

LOCK TABLES `pariangan_video` WRITE;
/*!40000 ALTER TABLE `pariangan_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `pariangan_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `product_category_id` varchar(2) NOT NULL,
  `price` int DEFAULT NULL,
  `brosur_url` text,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `fk_product_product_category1_idx` (`product_category_id`),
  CONSTRAINT `fk_product_product_category1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES ('01','Kawa Daun','1',5000,'1690227163_b8e2f1411fad1d3edcc0.png','Minuman dari daun kopi yang diseduh seperti teh . Daun kopi lokal pilihan awalnya dikeringkan dengan cara disangrai selama 12 jam. Saat akan diminum, daun kering ini dicampur dengan air dingin, lalu diseduh dengan air mendidih.'),('02','Dakak-Dakak','1',13000,'1690227228_3b568a3e3f1a268d7ec2.jpg','Sejenis panganan ringan khas Pariangan yang terbuat dari tepung beras. Rasanya gurih dan renyah sehingga bisa membuat siapa pun yang mencicipinya ketagihan.'),('03','Batik Pariangan','2',100000,'1690227308_db1e8769ec7f1a783c36.jpg','Batik Khas dari Pariangan, dan memiliki corak khas dari Pariangan');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_category` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES ('1','Culinery'),('2','Souvenir');
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `id` varchar(50) NOT NULL,
  `id_user` int unsigned NOT NULL,
  `id_package` varchar(50) NOT NULL,
  `id_reservation_status` varchar(50) NOT NULL,
  `request_date` date NOT NULL,
  `number_people` int DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_id_user_foreign` (`id_user`),
  KEY `reservation_id_package_foreign` (`id_package`),
  KEY `reservation_id_reservation_status_foreign` (`id_reservation_status`),
  CONSTRAINT `reservation_id_package_foreign` FOREIGN KEY (`id_package`) REFERENCES `package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_id_reservation_status_foreign` FOREIGN KEY (`id_reservation_status`) REFERENCES `reservation_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES ('RS01',3,'01','2','2023-10-26',10,NULL,NULL,NULL,'2023-10-25 03:37:09','2023-10-25 03:59:59'),('RS02',1,'01','3','2023-10-26',-1,NULL,NULL,NULL,'2023-10-25 03:38:29','2023-10-25 03:59:25'),('RS03',3,'03','2','2023-10-27',10,NULL,NULL,NULL,'2023-10-25 04:10:01','2023-10-25 04:10:01'),('RS04',3,'01','1','2023-10-28',10,NULL,NULL,NULL,'2023-10-25 05:26:32','2023-10-25 05:26:32'),('RS05',3,'01','1','2023-10-30',10,NULL,NULL,NULL,'2023-10-25 06:57:36','2023-10-25 06:57:36'),('RS06',3,'01','1','2024-06-30',10,NULL,NULL,NULL,'2023-10-25 07:01:56','2023-10-25 07:01:56');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation_status`
--

DROP TABLE IF EXISTS `reservation_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation_status` (
  `id` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation_status`
--

LOCK TABLES `reservation_status` WRITE;
/*!40000 ALTER TABLE `reservation_status` DISABLE KEYS */;
INSERT INTO `reservation_status` VALUES ('1','pending','2023-10-22 21:21:26','2023-10-22 21:21:26'),('2','confirmed','2023-10-22 21:21:26','2023-10-22 21:21:26'),('3','cancel','2023-10-22 21:21:26','2023-10-22 21:21:26');
/*!40000 ALTER TABLE `reservation_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review_atraction`
--

DROP TABLE IF EXISTS `review_atraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review_atraction` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `atraction_id` varchar(8) DEFAULT NULL,
  `event_id` varchar(8) DEFAULT NULL,
  `comment` text,
  `rating` int NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `review_atraction_user_id_foreign` (`user_id`),
  KEY `review_atraction_atraction_id_foreign` (`atraction_id`),
  KEY `review_event_user_id_foreign_idx` (`event_id`),
  CONSTRAINT `review_atraction_atraction_id_foreign` FOREIGN KEY (`atraction_id`) REFERENCES `atraction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `review_atraction_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `review_event_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review_atraction`
--

LOCK TABLES `review_atraction` WRITE;
/*!40000 ALTER TABLE `review_atraction` DISABLE KEYS */;
INSERT INTO `review_atraction` VALUES (1,2,NULL,'01','oke mantap',5,'2023-10-21 11:19:17','2023-10-23 10:31:30'),(2,2,'01',NULL,'Mantap ini atraksinya',5,'2023-10-21 11:21:46','2023-10-23 09:33:02'),(3,2,'03',NULL,NULL,5,'2023-10-21 11:22:43','2023-10-21 11:22:43'),(16,3,'01',NULL,'Oke mantap',5,'2023-10-24 15:12:16','2023-10-25 19:05:38');
/*!40000 ALTER TABLE `review_atraction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_package`
--

DROP TABLE IF EXISTS `service_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_package` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_package`
--

LOCK TABLES `service_package` WRITE;
/*!40000 ALTER TABLE `service_package` DISABLE KEYS */;
INSERT INTO `service_package` VALUES ('01','Tes'),('02','tes2');
/*!40000 ALTER TABLE `service_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `souvenir_gallery`
--

DROP TABLE IF EXISTS `souvenir_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `souvenir_gallery` (
  `id` varchar(2) NOT NULL,
  `souvenir_place_id` varchar(2) NOT NULL,
  `url` text,
  PRIMARY KEY (`id`),
  KEY `fk_souvenir_gallery_souvenir_place1_idx` (`souvenir_place_id`),
  CONSTRAINT `fk_souvenir_gallery_souvenir_place1` FOREIGN KEY (`souvenir_place_id`) REFERENCES `souvenir_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `souvenir_gallery`
--

LOCK TABLES `souvenir_gallery` WRITE;
/*!40000 ALTER TABLE `souvenir_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `souvenir_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `souvenir_place`
--

DROP TABLE IF EXISTS `souvenir_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `souvenir_place` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `owner` varchar(25) DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `geom_area` geometry DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `souvenir_place`
--

LOCK TABLES `souvenir_place` WRITE;
/*!40000 ALTER TABLE `souvenir_place` DISABLE KEYS */;
INSERT INTO `souvenir_place` VALUES ('01','Gallery Seni',NULL,'Pokdarwis Pariangan',_binary '\0\0\0\0\0\0\0uòu[šY@\0K\×\á\"VÝ¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0¸€ôšY@e“½ÁVÝ¿·€”šY@<![VÝ¿·€TlšY@•5$\áOVÝ¿·€»šY@ŽšG?VÝ¿¶€Ô¯šY@¹¾\'\"\ÔUÝ¿¸€ôšY@e“½ÁVÝ¿','09:00:00','19:00:00','Galery seni yang di sediakan oleh pihak pokdarwis pariangan kepada wisatawan yang ingin berbelanja souvenir khas dari Nagati Tuo Pariangan'),('02','Rumah Batik ','082218141289',NULL,_binary '\0\0\0\0\0\0\0šy“[jY@]Z\ä	\nÝ¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0¾øûiY@´KŽ*	Ý¿¿x^iY@	(\è6\nÝ¿¾ø\íhY@ªs\Úf\Ô\nÝ¿¿¸\âhY@k\ä4Ý¿¾¸wjY@\éj$Ý¿¿­kY@tn´\È\í	Ý¿¾øûiY@´KŽ*	Ý¿','09:00:00','18:00:00','Rumah Batilk Pariangan menyuguhkan wisatawan untuk mempelajari pembuatan batik dan menyediakan batik yang bisa dibeli oleh wisatawan.');
/*!40000 ALTER TABLE `souvenir_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `souvenir_place_gallery`
--

DROP TABLE IF EXISTS `souvenir_place_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `souvenir_place_gallery` (
  `id` varchar(8) NOT NULL,
  `souvenir_place_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `souvenir_place_gallery_souvenir_place_id_foreign` (`souvenir_place_id`),
  CONSTRAINT `souvenir_place_gallery_souvenir_place_id_foreign` FOREIGN KEY (`souvenir_place_id`) REFERENCES `souvenir_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `souvenir_place_gallery`
--

LOCK TABLES `souvenir_place_gallery` WRITE;
/*!40000 ALTER TABLE `souvenir_place_gallery` DISABLE KEYS */;
INSERT INTO `souvenir_place_gallery` VALUES ('01','01','1690363851_afab95768b3d7a928094.jpg','2023-07-26 09:34:37','2023-07-26 09:34:37'),('02','01','1690363851_9f3a1b650e14a9b500dc.jpg','2023-07-26 09:34:37','2023-07-26 09:34:37'),('03','01','1690363855_cc2a831fdbfe92bd11ba.jpg','2023-07-26 09:34:37','2023-07-26 09:34:37'),('04','02','1690450368_4dcf3f33af84e2f5fc00.jpg','2023-07-27 09:33:34','2023-07-27 09:33:34'),('05','02','1690450347_85b3f4f4917edd4a63d2.jpg','2023-07-27 09:33:34','2023-07-27 09:33:34'),('06','02','1690450330_ae9c93542e36a4a32b80.jpg','2023-07-27 09:33:34','2023-07-27 09:33:34');
/*!40000 ALTER TABLE `souvenir_place_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `souvenir_place_video`
--

DROP TABLE IF EXISTS `souvenir_place_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `souvenir_place_video` (
  `id` varchar(8) NOT NULL,
  `souvenir_place_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `souvenir_place_video_souvenir_place_id_foreign` (`souvenir_place_id`),
  CONSTRAINT `souvenir_place_video_souvenir_place_id_foreign` FOREIGN KEY (`souvenir_place_id`) REFERENCES `souvenir_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `souvenir_place_video`
--

LOCK TABLES `souvenir_place_video` WRITE;
/*!40000 ALTER TABLE `souvenir_place_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `souvenir_place_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` int DEFAULT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'default.svg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'fauzanpiliang13@gmail.com','piliang13',NULL,NULL,NULL,'default.svg','$2y$10$QysUxU6DHFbQT0/wvUR.7O.wePPStPJWIwF5QU5kR9wIIA97yjqwe',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-07-24 15:56:31','2023-07-24 15:56:31',NULL),(2,'m.agungmahardika12@gmail.com','agung','','',0,'1697858634_0f095bf2625470496fb2.png','$2y$10$hCY/AcGKsIGOLp8ZTyTi5u5tAxtFvRpw3I1EsA3tHyqUNHh.S/bs6',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-10-21 03:22:06','2023-10-21 03:22:06',NULL),(3,'user@gmail.com','agung123','','',0,'1698236330_5e5ce48eaa836432af97.jpg','$2y$10$NT0X7LvN2xBlmBzSj9FO5eUzmJlNhPwhHbpF1/DBta0mWlNBgNt6S',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-10-23 04:29:20','2023-10-23 04:29:20',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worship_place`
--

DROP TABLE IF EXISTS `worship_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `worship_place` (
  `id` varchar(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `category` varchar(25) DEFAULT NULL,
  `building_size` int DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `geom_area` geometry DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worship_place`
--

LOCK TABLES `worship_place` WRITE;
/*!40000 ALTER TABLE `worship_place` DISABLE KEYS */;
INSERT INTO `worship_place` VALUES ('01','Masjid Islah','Masjid',400,200,_binary '\0\0\0\0\0\0\0‚,vÁY@ËŸoVÝ¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0N¿9Õ€Y@v\èð\æTÝ¿N¿y\ÒY@ \Ú\ì\ÕVÝ¿O¿¹ü~Y@\Ñi\Ë\è\ÄXÝ¿†\0\éƒY@™\Ã]\ä\àZÝ¿†Àd„Y@\Û\Ðc$[Ý¿†@†Y@½\Ô4¬$WÝ¿†€g…Y@ h®­pVÝ¿N¿9Õ€Y@v\èð\æTÝ¿','Salah satu masjid tertua di Sumatra Barat yang berlokasi di Pariangan, Kabupaten Tanah Datar, Sumatra Barat. Letaknya berlokasikan 50 kilometer dari jalan utama Padang Panjang-Batusangkar'),('02','Masjid Taqwa Guguak','Masjid',344,160,_binary '\0\0\0\0\0\0\0usY@û^¿7¸zÜ¿',_binary '\æ\0\0\0\0\0\0\0\0\0\0\0€\'VY@YUV¹\ZzÜ¿\'–\ÆY@;\åÑ´c|Ü¿\'V‹Y@p­*Vµ{Ü¿\'–\âY@\Þ\Ók»yÜ¿\'–lY@aº“yÜ¿€\'VY@YUV¹\ZzÜ¿','Salah Satu Masjid yang terletak di Panorama Pariangan');
/*!40000 ALTER TABLE `worship_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worship_place_gallery`
--

DROP TABLE IF EXISTS `worship_place_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `worship_place_gallery` (
  `id` varchar(2) NOT NULL,
  `worship_place_id` varchar(2) NOT NULL,
  `url` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_worship_place_gallery_worship_place1_idx` (`worship_place_id`),
  CONSTRAINT `fk_worship_place_gallery_worship_place1` FOREIGN KEY (`worship_place_id`) REFERENCES `worship_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worship_place_gallery`
--

LOCK TABLES `worship_place_gallery` WRITE;
/*!40000 ALTER TABLE `worship_place_gallery` DISABLE KEYS */;
INSERT INTO `worship_place_gallery` VALUES ('01','01','1690362734_65bd52fd98844d8f0641.jpg','2023-07-26 09:12:16','2023-07-26 09:12:16'),('02','01','1690362729_4ebf8309e7e1c09f6d71.jpg','2023-07-26 09:12:16','2023-07-26 09:12:16'),('03','01','1690362723_5dd7c81575956da9f9a5.jpg','2023-07-26 09:12:16','2023-07-26 09:12:16'),('04','02','1690362876_abbd4b9a87fb7fa013dd.jpg','2023-07-26 09:15:05','2023-07-26 09:15:05'),('05','02','1690362877_2243368bf8765cf8b2d1.jpg','2023-07-26 09:15:05','2023-07-26 09:15:05'),('06','02','1690362879_d2a9f2c5d869c746e87f.jpg','2023-07-26 09:15:05','2023-07-26 09:15:05');
/*!40000 ALTER TABLE `worship_place_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worship_place_video`
--

DROP TABLE IF EXISTS `worship_place_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `worship_place_video` (
  `id` varchar(8) NOT NULL,
  `worship_place_id` varchar(8) NOT NULL,
  `url` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `worship_place_video_worship_place_id_foreign` (`worship_place_id`),
  CONSTRAINT `worship_place_video_worship_place_id_foreign` FOREIGN KEY (`worship_place_id`) REFERENCES `worship_place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worship_place_video`
--

LOCK TABLES `worship_place_video` WRITE;
/*!40000 ALTER TABLE `worship_place_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `worship_place_video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-26  8:19:27
