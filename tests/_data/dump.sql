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
INSERT INTO `marvel_lists` VALUES (1,1,'I have read...','All comic books that you have read in the past','','f9a7623574bd718008d48ad3634f8b1f','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(2,1,'I will read...','All comic books that you plan on reading in the future','','3c216682536e4b36c26c22ddc50313b0','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(3,1,'I am reading...','All comic books that you are currently reading','','dedd9fb1ff005e46c242225c2550c317','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(4,1,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','180197ca6917f325680c1ca6bd78e1a6','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(5,2,'I have read...','All comic books that you have read in the past','','b971f22084c57858e642bd748112a1d9','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(6,2,'I will read...','All comic books that you plan on reading in the future','','9d3610fdc8a8aa490c0827abbe40458a','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(7,2,'I am reading...','All comic books that you are currently reading','','b33fc8d664205bbde790489139b31f3e','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(8,2,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','e0234752dc7f6ed3a71f84b3129cc3cf','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(9,3,'I have read...','All comic books that you have read in the past','','dd4c74510ad08702669933a6fb14e0e8','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(10,3,'I will read...','All comic books that you plan on reading in the future','','40aceb1b1e6f7bf9b5c937b83d3ea65f','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(11,3,'I am reading...','All comic books that you are currently reading','','8a44131ce51ca31104f19a3d977fb7fd','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(12,3,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','89b800233154eb5184fba0e29b20cd7d','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(13,4,'I have read...','All comic books that you have read in the past','','1096e7ae0fe9e958e7e033bbf50871b0','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(14,4,'I will read...','All comic books that you plan on reading in the future','','43f7db9c806a7d6255818cb1acdaf12e','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(15,4,'I am reading...','All comic books that you are currently reading','','0e356a0f7aca83980a48caec0644af7b','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(16,4,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','b29ba5f8f9a666f0831fa5d4a7a4ce9f','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(17,5,'I have read...','All comic books that you have read in the past','','fb07d8358b6eb680405fd158f7ba45e0','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(18,5,'I will read...','All comic books that you plan on reading in the future','','ae4e2682e1a09cfb9346d8d66ba97a38','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(19,5,'I am reading...','All comic books that you are currently reading','','743a79d47fd2cab1895b87f3ccea6a08','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(20,5,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','248a9c8306f813c71be4ed7e7848c84a','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(21,6,'I have read...','All comic books that you have read in the past','','90ed51a01654d084ca9e4d7f5fbfdc1a','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(22,6,'I will read...','All comic books that you plan on reading in the future','','9a0e2da6576c402c62d9b8488b3ee454','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(23,6,'I am reading...','All comic books that you are currently reading','','6e9f2817ca71486a7bb1348344a1887c','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(24,6,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','74105b70dc30a757f968291f7f158ce9','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(25,7,'I have read...','All comic books that you have read in the past','','5f724b9dc085a441878e6556ee2b09ce','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(26,7,'I will read...','All comic books that you plan on reading in the future','','1419db291780768436291f3cfae9ce36','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(27,7,'I am reading...','All comic books that you are currently reading','','f3c25082d5bf1f926bf4fb6b187ba7df','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(28,7,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','30e3d2e0951e303fb85bd2c69bc6a571','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(29,8,'I have read...','All comic books that you have read in the past','','56d711e90560161927d7c2998910a61d','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(30,8,'I will read...','All comic books that you plan on reading in the future','','bd167c9d43e660bff13edf44c336c32b','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(31,8,'I am reading...','All comic books that you are currently reading','','849892733e5fec5b247ab3a56917b27d','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(32,8,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','9992f8ab01231f6b20d9b49cfbeca6f2','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(33,9,'I have read...','All comic books that you have read in the past','','3e985641bb215ef40c8f0fe06e308832','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(34,9,'I will read...','All comic books that you plan on reading in the future','','b631d3d3ee4300393c26c7771c63dd3d','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(35,9,'I am reading...','All comic books that you are currently reading','','875d3160b3605bb6d9b217177f2ecc78','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(36,9,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','a1f1a37702e26ac24cc0b2fcebd3ad67','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(37,10,'I have read...','All comic books that you have read in the past','','a3d295dcc3b9d122d8e5ce7ffa558813','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(38,10,'I will read...','All comic books that you plan on reading in the future','','b1b695e8570983197f1e2886d32fa528','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(39,10,'I am reading...','All comic books that you are currently reading','','a0281a71f8f94f513eee2acabc45bec7','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL),(40,10,'I started but dropped...','All comic books that you started reading, but you dropped for some reason','','f83850d68d0c6e204ec6d1924a111287','2016-07-17 13:55:38','2016-07-17 13:55:38',NULL);
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_05_26_152154_create_user_profiles_table',1),('2016_06_03_153457_create_lists_tables',1),('2016_07_10_173718_create_roles_tables',1),('2016_07_13_200126_create_comments',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
INSERT INTO `users` VALUES (1,'Shaniya Hermann','sean68@gmail.com','$2y$10$fexg0ODswziwaCklzev4wOdLRkPVMxK6twu6yzdyVGTbBz1Gri78C',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(2,'Velva Parisian','iboyle@gmail.com','$2y$10$nQYt5CR8emfv11IE.WdS7.5MpxIOs7ND1otbr7s81h3K10XQhANNi',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(3,'Leanna Turcotte','ida.kautzer@feest.com','$2y$10$pV1I2yX2f4VPwC0ozAHGOe9kPHz28wjpLABXV.n5VaWYJ6ut8UZxS',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(4,'Josefina Harris','mterry@daugherty.net','$2y$10$tUb9fYUSYLUR8jsuL0HbVeYBB3Yd.e7KDsnQ4nyTDxF3Ye.GG/9/u',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(5,'Lizeth Schmidt','ymckenzie@hotmail.com','$2y$10$b13VSaa5eyk4iy0KwWJxBuKMdWHmqF5GEru4Rs.p1yiAG5rcf1fwi',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(6,'Miss Kylee Anderson DDS','mosciski.koby@gmail.com','$2y$10$I3EPs6.UqsLn8S3ZXICy.OZBlW7J8kuC2ziaXZzYZsnBSmxJbBk2y',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(7,'Elizabeth Sanford','emily.jaskolski@vandervort.org','$2y$10$wA7ir.UC8O9yqDoTRwvjReRTr4/e1zy6IbhaKmrXw2MLdAFbKiMB.',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(8,'Vivianne Rowe','elmer.gleason@schneider.biz','$2y$10$rX7FmYqIAGzDLziy5491u.XXp0S28i7fN5XSyKWE.J98qJDn7uNt2',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(9,'Emie Nikolaus Sr.','murray.phyllis@sauer.com','$2y$10$dUyeAROa8e.pSlXKThEC2.Jpq5crj5NGNjBVf6azHuCKCbuB/uG2e',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38'),(10,'Quincy Abshire','aharris@yahoo.com','$2y$10$cgcuzbL/SlpQMZmn1M05SuboNtL8Em4TQB..1LMo18IPtVIlVDnVq',NULL,'2016-07-17 13:55:38','2016-07-17 13:55:38');
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

-- Dump completed on 2016-07-17 13:58:49
