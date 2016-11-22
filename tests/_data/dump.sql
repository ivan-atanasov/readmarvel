-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: marvel
-- ------------------------------------------------------
-- Server version	5.7.12-0ubuntu1.1

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
INSERT INTO `marvel_lists` VALUES (1,1,'I have read...','All comic books that you have read in the past','','909f2ea543386bb23ebd25bbfb6387ff','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(2,1,'I will read...','All comic books that you plan on reading in the future','','c7eb0cf28eb73afb08943633c0560d2f','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(3,1,'I am reading...','All comic books that you are currently reading','','00c839c0f4c021427c16c229bcfe0672','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(4,1,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','31c0dd0d401c9eceaeacd1d0694dfeed','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(5,2,'I have read...','All comic books that you have read in the past','','a68fc4f8732a1e9468861e3798371836','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(6,2,'I will read...','All comic books that you plan on reading in the future','','8a56d6a13a0f81a6b6677fa5723f281e','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(7,2,'I am reading...','All comic books that you are currently reading','','3801004d758bf0272c3c815471f1bbff','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(8,2,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','cab7176c7f16f59ad1798c37d33f1c50','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(9,3,'I have read...','All comic books that you have read in the past','','c3887848cc413e323490903ff5420d4d','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(10,3,'I will read...','All comic books that you plan on reading in the future','','e59103da46d4feec44b2b7d1f33ffeb7','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(11,3,'I am reading...','All comic books that you are currently reading','','f53b0f7df6605874d7a2b78d86a199a0','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(12,3,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','8465e485d9391a54af96d6545dab9229','2016-11-22 11:17:58','2016-11-22 11:17:58',NULL),(13,4,'I have read...','All comic books that you have read in the past','','66254877be9cf7c10a08a91911d8739e','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(14,4,'I will read...','All comic books that you plan on reading in the future','','e1e1fe12b37ff34e7044448d6214351d','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(15,4,'I am reading...','All comic books that you are currently reading','','3ffbbe30c7cf5c8a315cda0db1b83076','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(16,4,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','bccb920ba5d3ab4e3f9ed363c2be2881','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(17,5,'I have read...','All comic books that you have read in the past','','12d04c0f998a7b4e59d0ada6500b9b27','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(18,5,'I will read...','All comic books that you plan on reading in the future','','1baca8593dd39fa131fe6633dd417d02','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(19,5,'I am reading...','All comic books that you are currently reading','','4215a882a549998d900396deb9fef1f0','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(20,5,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','cee1a948d89c19319e3d144afe91feed','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(21,6,'I have read...','All comic books that you have read in the past','','e2b07b2cc921d26d775a6bb7f1f3a422','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(22,6,'I will read...','All comic books that you plan on reading in the future','','b8d24947f58d18c566d81a7d5b221315','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(23,6,'I am reading...','All comic books that you are currently reading','','1d0b513ba6561ce55aeae347d4cf0cc9','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(24,6,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','4b11c28bdf6a9370cc753a141e52edf4','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(25,7,'I have read...','All comic books that you have read in the past','','43a483e4a144720be29bcd393659b128','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(26,7,'I will read...','All comic books that you plan on reading in the future','','fe7d0a8f6ca9bc6b103a159edaecb0c0','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(27,7,'I am reading...','All comic books that you are currently reading','','66f30a68c4094efedca0bb9f4a4a05e9','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(28,7,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','8faa308ffa0bb8999f5d4b3a902f46a2','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(29,8,'I have read...','All comic books that you have read in the past','','c20b4e6369991b5e78ba6acf98efff6f','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(30,8,'I will read...','All comic books that you plan on reading in the future','','21be5ea15b9fb12144e1e87d50f537e7','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(31,8,'I am reading...','All comic books that you are currently reading','','cd345b0ba3e6ec6634a3fc4b285f085d','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(32,8,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','8d7585f1976f35b9e793bfa2e3bb8874','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(33,9,'I have read...','All comic books that you have read in the past','','7bdab17ea2709180a4edc554a0d8efa8','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(34,9,'I will read...','All comic books that you plan on reading in the future','','ccee4d0ac87621aa889f4d9eb3e03a49','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(35,9,'I am reading...','All comic books that you are currently reading','','73cee62d7d1215bf7f8ba833ce6e8239','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(36,9,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','9e74c3dd8f86cd2fb1f57d433d80c026','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(37,10,'I have read...','All comic books that you have read in the past','','6c1d1d30b68ccc270d4d82d6c89e8d29','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(38,10,'I will read...','All comic books that you plan on reading in the future','','c2b7926cb6aaf360fd137e7a447fb8c9','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(39,10,'I am reading...','All comic books that you are currently reading','','c3327dc9284833c25a948122932c15f1','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL),(40,10,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','6f7f5142f0f577c7cf8863e63832ef5d','2016-11-22 11:17:59','2016-11-22 11:17:59',NULL);
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_05_26_152154_create_user_profiles_table',1),('2016_06_03_153457_create_lists_tables',1),('2016_07_10_173718_create_roles_tables',1),('2016_07_13_200126_create_comments',1),('2016_07_28_204334_create_static_pages_table',1),('2016_10_24_190003_create_table_users_to_characters',1);
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
INSERT INTO `roles` VALUES (1,'admin','Admin','2016-11-22 11:17:58','2016-11-22 11:17:58'),(2,'user','User','2016-11-22 11:17:58','2016-11-22 11:17:58');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_pages`
--

LOCK TABLES `static_pages` WRITE;
/*!40000 ALTER TABLE `static_pages` DISABLE KEYS */;
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
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `users` VALUES (1,'Brendon Mante','Dr. Lauren Langworth DVM','theo14@gmail.com','$2y$10$ZSlZYgqyTeMCsweCmjhG9eoPlyFNoYQLr.T2ZRBePbwEaNU79zzCm',NULL,'2016-11-22 11:17:58','2016-11-22 11:17:58'),(2,'Stephan Howell','Cleo Wintheiser','whitney91@yahoo.com','$2y$10$x94ceZcqofTjzFC4l6is.u27k2g920UqB4lcoWEN8JDseZ3AWyEPS',NULL,'2016-11-22 11:17:58','2016-11-22 11:17:58'),(3,'Luna Kling','Rickie Quitzon','jovan.bernier@hotmail.com','$2y$10$DYbkITZYLuWEe9RbZ0ShtOyePoB3SmxABlmJeP/nVADFvr8NkXzD.',NULL,'2016-11-22 11:17:58','2016-11-22 11:17:58'),(4,'Brenden Kautzer','Mrs. Beth Wisoky III','boris00@bahringer.org','$2y$10$qiov8ZHmKFKt.2hq.RuD7eX3enffr7O9JWk11bj2oe.KtgJMIyTIq',NULL,'2016-11-22 11:17:59','2016-11-22 11:17:59'),(5,'Myrtis Langosh II','Cayla Bechtelar','kayli95@gmail.com','$2y$10$GLL9l3bJrBXJsXs1mNE/Gecr6ItYpr2OhJ8h70OiuIwm8LsN8vSLK',NULL,'2016-11-22 11:17:59','2016-11-22 11:17:59'),(6,'Friedrich Fay','Greg Anderson','mmann@sipes.info','$2y$10$iPyHPf6Ah5KmTfAV3uN7Yu2jVdc7Xul08uSlqoFJHDQUYgCtiA8jO',NULL,'2016-11-22 11:17:59','2016-11-22 11:17:59'),(7,'Richmond Corwin','Jess Pfannerstill','watsica.jean@witting.com','$2y$10$XYz9YuEX4HQLGf2o/y419uEMQVT.URRbkppNAawxzEjlRj0RSlxSu',NULL,'2016-11-22 11:17:59','2016-11-22 11:17:59'),(8,'Dianna Thompson III','Meda Zulauf','muller.karen@haag.net','$2y$10$vVXwCnEw2EYbHM/RaMpb6.vRqq7XUrdF29yt7Zesryb9.I/xXhbmq',NULL,'2016-11-22 11:17:59','2016-11-22 11:17:59'),(9,'Hermina Kub','Dr. Judson Abbott III','bailey.gracie@collins.com','$2y$10$2FJWxEZiuTAxpKuzT7fy5.l3CxcPoRyumDfspp3BRe1FbuCmiPi1K',NULL,'2016-11-22 11:17:59','2016-11-22 11:17:59'),(10,'Elda Yost','Lula Mosciski III','bahringer.denis@goldner.com','$2y$10$n7R5/7qW8mSo4qdRbJHu/uQ7vTnfDYieT6eor1HFukSUya9/zUjbi',NULL,'2016-11-22 11:17:59','2016-11-22 11:17:59');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_to_characters`
--

DROP TABLE IF EXISTS `users_to_characters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_to_characters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `character_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_to_characters_user_id_foreign` (`user_id`),
  CONSTRAINT `users_to_characters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_to_characters`
--

LOCK TABLES `users_to_characters` WRITE;
/*!40000 ALTER TABLE `users_to_characters` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_to_characters` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-22 11:18:34
