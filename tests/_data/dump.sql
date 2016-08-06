-- MySQL dump 10.13  Distrib 5.7.12, for Linux (x86_64)
--
-- Host: localhost    Database: marvel
-- ------------------------------------------------------
-- Server version	5.7.12

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `series_id` int(10) unsigned NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marvel_list_items`
--

DROP TABLE IF EXISTS `marvel_list_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marvel_list_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` int(10) unsigned NOT NULL,
  `series_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `reread_value` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `started_at` date DEFAULT NULL,
  `finished_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marvel_list_items_list_id_foreign` (`list_id`),
  CONSTRAINT `marvel_list_items_list_id_foreign` FOREIGN KEY (`list_id`) REFERENCES `marvel_lists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marvel_list_items`
--

LOCK TABLES `marvel_list_items` WRITE;
/*!40000 ALTER TABLE `marvel_list_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `marvel_list_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marvel_lists`
--

DROP TABLE IF EXISTS `marvel_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marvel_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marvel_lists_user_id_foreign` (`user_id`),
  CONSTRAINT `marvel_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marvel_lists`
--

LOCK TABLES `marvel_lists` WRITE;
/*!40000 ALTER TABLE `marvel_lists` DISABLE KEYS */;
INSERT INTO `marvel_lists` VALUES (1,1,'I have read...','All comic books that you have read in the past','','58481661ab590d3b3d17867a8ba3be87','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(2,1,'I will read...','All comic books that you plan on reading in the future','','085675a6b3e828952a6118a00eb5972c','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(3,1,'I am reading...','All comic books that you are currently reading','','4dc251b6dd88fbece635924894ce5864','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(4,1,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','2ae0487716b91120a861558b66fc34f7','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(5,2,'I have read...','All comic books that you have read in the past','','8b1eaffd676821370a0dcc04137a6b92','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(6,2,'I will read...','All comic books that you plan on reading in the future','','03657e4ffee146cc03ac96dae443e99f','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(7,2,'I am reading...','All comic books that you are currently reading','','c70ae0b8fabb6db391bc37d708a96528','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(8,2,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','6ee8ec6d3b5183fed6d610fbf83fa6f5','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(9,3,'I have read...','All comic books that you have read in the past','','55db955747ecf33d5f7679864052a85d','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(10,3,'I will read...','All comic books that you plan on reading in the future','','c6e90f6be1f01670b0e39fe76fdcb5da','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(11,3,'I am reading...','All comic books that you are currently reading','','4f4474d4c19244a5402001ec61a80221','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(12,3,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','680bc29e3a65c68919adeb3088518cd0','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(13,4,'I have read...','All comic books that you have read in the past','','2389f9675d73be576bdc44134388b9d9','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(14,4,'I will read...','All comic books that you plan on reading in the future','','0922c5553b6931f621e769cd58be6f8c','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(15,4,'I am reading...','All comic books that you are currently reading','','aae212b499679806c083755548acebe8','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(16,4,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','0143d5afb198119f88470dd49554b03a','2016-08-06 15:47:14','2016-08-06 15:47:14',NULL),(17,5,'I have read...','All comic books that you have read in the past','','bf631f97004ae2867b53d9763d1507fb','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(18,5,'I will read...','All comic books that you plan on reading in the future','','da500f305069e00a63b282197e432200','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(19,5,'I am reading...','All comic books that you are currently reading','','0886c783c3e8a3f4309038d6545af310','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(20,5,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','f59a6ec56e26df74d5ef3fedf3cccedd','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(21,6,'I have read...','All comic books that you have read in the past','','ca0aed23061bf23e5591c35af60b10f8','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(22,6,'I will read...','All comic books that you plan on reading in the future','','c338dafd4eabcdf4ce4e6e2b07e69562','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(23,6,'I am reading...','All comic books that you are currently reading','','8d56e6e3865d0d5055986c7750408e10','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(24,6,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','1e1c26991e265e346a6de2f2b674adbf','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(25,7,'I have read...','All comic books that you have read in the past','','f9950617a9bbd48401fb861038ab54f7','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(26,7,'I will read...','All comic books that you plan on reading in the future','','1a133f8d64facc3de31dcc577ea1b34e','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(27,7,'I am reading...','All comic books that you are currently reading','','2afd198b912c0f6833b5266746b9b4bc','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(28,7,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','7b91e403ee9a5ee36db0bbd7f57bcb9c','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(29,8,'I have read...','All comic books that you have read in the past','','969a5c03bad456bc0d5104eb3ec5189f','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(30,8,'I will read...','All comic books that you plan on reading in the future','','f9cff4a7d25ab620850a4902994e070d','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(31,8,'I am reading...','All comic books that you are currently reading','','3d26e75d968c397dcd8f255cf1a352fe','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(32,8,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','06d8b668e1c1beba1cd83c2a8995ec13','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(33,9,'I have read...','All comic books that you have read in the past','','14f101365acc69be91d35f9290d23841','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(34,9,'I will read...','All comic books that you plan on reading in the future','','4bce15e25d98d8bea98967ab63cb5cd4','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(35,9,'I am reading...','All comic books that you are currently reading','','3473f4ead80f3b51128a739ad9d44779','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(36,9,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','7c0b1fb9f8cd583c089a7ea9f4ee0101','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(37,10,'I have read...','All comic books that you have read in the past','','1abb0dc12ad376166346d907a148c247','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(38,10,'I will read...','All comic books that you plan on reading in the future','','4399bd56687e047e2393cb7068d11b5e','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(39,10,'I am reading...','All comic books that you are currently reading','','72ca1c7ccb28463962ede84338d09b4d','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL),(40,10,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','9eebf1be42ced1575d003b2a0a14c482','2016-08-06 15:47:15','2016-08-06 15:47:15',NULL);
/*!40000 ALTER TABLE `marvel_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_05_26_152154_create_user_profiles_table',1),('2016_06_03_153457_create_lists_tables',1),('2016_07_10_173718_create_roles_tables',1),('2016_07_13_200126_create_comments',1),('2016_07_28_204334_create_static_pages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','2016-08-06 15:47:14','2016-08-06 15:47:14'),(2,'user','User','2016-08-06 15:47:14','2016-08-06 15:47:14');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_pages`
--

DROP TABLE IF EXISTS `static_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `static_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(10) unsigned NOT NULL,
  `last_updated_by` int(10) unsigned DEFAULT NULL,
  `url_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `static_pages_created_by_foreign` (`created_by`),
  KEY `static_pages_last_updated_by_foreign` (`last_updated_by`),
  CONSTRAINT `static_pages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `static_pages_last_updated_by_foreign` FOREIGN KEY (`last_updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_pages`
--

LOCK TABLES `static_pages` WRITE;
/*!40000 ALTER TABLE `static_pages` DISABLE KEYS */;
INSERT INTO `static_pages` VALUES (1,1,1,'about-us','','About us','<p>This is the about-us page 1</p>\r\n','2016-08-06 17:19:14','2016-08-06 17:19:39',NULL);
/*!40000 ALTER TABLE `static_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `real_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about_me` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Anna Hamill','walker.walter@cole.com','$2y$10$vx4t9ZpNdRMpgaaCygCZl.kIgv.ITk.N8z6nNMaxo91G7Dnx4imAa','wr0NnGYwcSMUXXWZ8fy81V73lj4kbORjkttm1LhacPHWiZybY6m3YW95oDIk','2016-08-06 15:47:14','2016-08-06 15:48:36'),(2,'Miss Sierra Stroman','augusta33@hotmail.com','$2y$10$TUlfYwIRR3G028F5fj4cHOHI7rFws91FFmOZ6K3GHEW63KX3BgP3a',NULL,'2016-08-06 15:47:14','2016-08-06 15:47:14'),(3,'Prof. Bruce Sipes','sonya.botsford@yahoo.com','$2y$10$MtumAqZfh/JzvuQ0Gwpq4ODmHNx.OnL4ozG/RsX942PDavty3THFW',NULL,'2016-08-06 15:47:14','2016-08-06 15:47:14'),(4,'Dr. Noble Harber','yhaag@yahoo.com','$2y$10$NpEvNewg.ehtvSxhFJUfu.X40mL36/mGxVnqZquHtcgo/5ftvGWWy',NULL,'2016-08-06 15:47:14','2016-08-06 15:47:14'),(5,'Elta Lehner','darrin.hodkiewicz@hotmail.com','$2y$10$hhBZy6JZE3b/FJcDLVfg.OoZvG3XfOGWuPPv7ocStcAbkUupJaNm2',NULL,'2016-08-06 15:47:15','2016-08-06 15:47:15'),(6,'Billy Kutch','adams.cyrus@langosh.com','$2y$10$C3DbJEkeB97vsZlOu7Lmpum5bNRmdfkt4.SgoErpovaKS39k7THXK','xkDALRNLmwMK6CYPKFwGtRchUwIcpsvGQFUcluSwnaPQuBZGdP5TeWpx4amc','2016-08-06 15:47:15','2016-08-06 15:48:56'),(7,'Ms. Amely Boehm','rvandervort@gmail.com','$2y$10$XimWEDvaIlwLh0oAb8lUxu/Bm0S6d1dOgikv.3M4LHHMPN4tkbFqC',NULL,'2016-08-06 15:47:15','2016-08-06 15:47:15'),(8,'Prof. Janis Carter V','owilliamson@hotmail.com','$2y$10$bArat8FAVpVfkslAdixFlurWUObctE/9OtH/q/T2usbLiqtSlTJsW',NULL,'2016-08-06 15:47:15','2016-08-06 15:47:15'),(9,'Toy Hilpert','donald27@yahoo.com','$2y$10$nv1EvqSwNjGNcXYrL4YaWuZmffXT/Hx2xeH6eXzUUU0cl92Tl87Lm',NULL,'2016-08-06 15:47:15','2016-08-06 15:47:15'),(10,'Anissa Roob','schowalter.electa@yahoo.com','$2y$10$eNPRyi5S6PYAPVaoG2571.3IpkEED.xUJ.VlSMGasax2esk59UKZC',NULL,'2016-08-06 15:47:15','2016-08-06 15:47:15');
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

-- Dump completed on 2016-08-06 22:28:27
