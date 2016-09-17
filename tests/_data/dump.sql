-- MySQL dump 10.13  Distrib 5.7.12, for Linux (x86_64)
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
INSERT INTO `marvel_lists` VALUES (1,1,'I have read...','All comic books that you have read in the past','','3d6126566fc2175f72ab456f8e127aac','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(2,1,'I will read...','All comic books that you plan on reading in the future','','226ea7c2ee1cef1bb7731ee948ed4b99','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(3,1,'I am reading...','All comic books that you are currently reading','','b11ce781ac3469cbb34ef89835f08a1b','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(4,1,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','38a535153535d7e9f51b6fa703a04f62','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(5,2,'I have read...','All comic books that you have read in the past','','fb7c73316cd1a4a54e20b7845844f5dc','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(6,2,'I will read...','All comic books that you plan on reading in the future','','18ccdc654333442ac896e1ec1b359908','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(7,2,'I am reading...','All comic books that you are currently reading','','e1e4583c44b82016e3fee42f9127563c','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(8,2,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','8ee05e1e8e6b1865994bfe9a91861f38','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(9,3,'I have read...','All comic books that you have read in the past','','ee7fec6cb5490528139a787a01040b55','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(10,3,'I will read...','All comic books that you plan on reading in the future','','660813e221944a1c6efa155ecc07734a','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(11,3,'I am reading...','All comic books that you are currently reading','','4233b260abe278d8c7501878b89b56eb','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(12,3,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','c5a89e7c49627b60a66f0f872da9aedd','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(13,4,'I have read...','All comic books that you have read in the past','','68339ae6240c4a4e7ddd0da7e246bbe7','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(14,4,'I will read...','All comic books that you plan on reading in the future','','0eab82d1bd2b6f1eb0b8941d42e9e065','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(15,4,'I am reading...','All comic books that you are currently reading','','2a830ec71d7cdbe660a0468f5711ffb2','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(16,4,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','e2d62e00e45e0f375c16cea8fc8fd8a7','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(17,5,'I have read...','All comic books that you have read in the past','','c28503243df8f2ddb13b7253feaf0d75','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(18,5,'I will read...','All comic books that you plan on reading in the future','','de87ee4e8d4e493da098c47d1c7f603e','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(19,5,'I am reading...','All comic books that you are currently reading','','dd2aacf7a61bdd2f68df8b93b89fbc90','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(20,5,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','cf5e704090eedb23b4bac081d215bc16','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(21,6,'I have read...','All comic books that you have read in the past','','83a0cab565677c1fd1946c2fd780eea7','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(22,6,'I will read...','All comic books that you plan on reading in the future','','0037bf12577b23a7a1543deda44f17f6','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(23,6,'I am reading...','All comic books that you are currently reading','','d4ec411a2fe81d6424b2547cc8fba781','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(24,6,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','b1790554a27765739fb9a30bccf765df','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(25,7,'I have read...','All comic books that you have read in the past','','f754b1cbad236e41952acd172c459d7b','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(26,7,'I will read...','All comic books that you plan on reading in the future','','4b6c20742219c7bc95af14e66e12b6cc','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(27,7,'I am reading...','All comic books that you are currently reading','','327ce90ab9bd1037e3a4137ca3ae7f63','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(28,7,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','534611c3fa18b6a2584e0a84826b4c0f','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(29,8,'I have read...','All comic books that you have read in the past','','332489c96a885562bef97eb1ce403cdc','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(30,8,'I will read...','All comic books that you plan on reading in the future','','f84f6a20340df6cd87400918cfe4b8e4','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(31,8,'I am reading...','All comic books that you are currently reading','','37a89e6d8bf01fe6a128fc4e69404908','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(32,8,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','b714993e7df3c2ffe1c3543a20392bc6','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(33,9,'I have read...','All comic books that you have read in the past','','18abd780fc2d021966f01b56fb57b609','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(34,9,'I will read...','All comic books that you plan on reading in the future','','6518ad15eb0d510a57de7396465da025','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(35,9,'I am reading...','All comic books that you are currently reading','','f5c10e1df3b79011e17cac1692267ae9','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(36,9,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','7539e0ba530045a7b8a54d919cbaef8e','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(37,10,'I have read...','All comic books that you have read in the past','','585ea17d95d0fed0cc922e7de49432c5','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(38,10,'I will read...','All comic books that you plan on reading in the future','','c226ea080d2bf2b69862e6ca2e188b38','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(39,10,'I am reading...','All comic books that you are currently reading','','a17298dd94587d3c75c0575c43553768','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL),(40,10,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','991336c3b423ba01ddf2be36aba3c4e2','2016-09-17 20:30:37','2016-09-17 20:30:37',NULL);
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
INSERT INTO `roles` VALUES (1,'admin','Admin','2016-09-17 20:30:37','2016-09-17 20:30:37'),(2,'user','User','2016-09-17 20:30:37','2016-09-17 20:30:37');
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
INSERT INTO `users` VALUES (1,'Dale Smitham','Mr. David Runte','erdman.cary@yahoo.com','$2y$10$Pse3Rsd5o2Tpg2jesin8Vulfkz9QIjUepjEUXFNeAO3thuOccs/yi',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(2,'Kadin Toy','Prof. Ayden Tremblay MD','madonna.franecki@abshire.com','$2y$10$pB8JggomqrhZMcKthUrKcOxercx52qQsOxlO1KSB.r16.eyjJEhDq',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(3,'Mr. Tate Gerlach','Rafael Schowalter','gdietrich@collier.com','$2y$10$3Ncb/oksehEJKDqGuPMfAObOY5i0okB0K2G1oZlZHv7AGg9u2z6le',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(4,'Miss Christy Zieme','Mr. Haley Brakus','lacy.schuster@gmail.com','$2y$10$XyVN.3Fu0W.sC7BGGHPKoeKAzqah43YgdPwzQw8J/H3tHkPKsgUV2',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(5,'Myrtice Batz','Elizabeth Deckow DVM','dannie50@gmail.com','$2y$10$1fyzXNJCgshcHP50HG181ewrX1hmvV3LA7.foXZLdUF63NpKyVvw2',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(6,'Elvera Ondricka','Prof. Ashly Thompson','vspencer@reinger.com','$2y$10$7Gy8G6BjD0EWG4nUlIYSEetaNa6WeX8v76U253.ZAsmUdfJTWn4vu',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(7,'Richard Stehr','Ms. Trudie Kuhn','fatima.turner@hotmail.com','$2y$10$KUoz7hPQ5Ykhfouav6KyuOSkFtMkEAVKspcgVaVq.igOUt7tJj5vu',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(8,'Leopold VonRueden','Miss Gladys Stokes','effertz.arnoldo@mclaughlin.com','$2y$10$AvFGDJlt56bTL.WGxvWPQuXUKlPEe.hO0.yDgytuy0jW6VCx5/GHC',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(9,'Jovan Pouros','Akeem Jakubowski','fwatsica@gmail.com','$2y$10$2VpJ4p5VuHoGqllKIQsD1OvNoD1PWmF8hl/oPmm0jHpUh0kkTvoLK',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37'),(10,'Ms. Margret Lebsack','Dr. Newell Cummings','leann.feest@hotmail.com','$2y$10$173Z3GXUqZxRY.pbluKZ7eEzwRnn169nJ2uMSES6mkhNcmjdioidi',NULL,'2016-09-17 20:30:37','2016-09-17 20:30:37');
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

-- Dump completed on 2016-09-17 20:32:13
