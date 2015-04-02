CREATE DATABASE  IF NOT EXISTS `beatcrumb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `beatcrumb`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: beatcrumb
-- ------------------------------------------------------
-- Server version	5.5.28

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
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `artist_name` varchar(255) DEFAULT NULL,
  `terms` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist`
--

LOCK TABLES `artist` WRITE;
/*!40000 ALTER TABLE `artist` DISABLE KEYS */;
INSERT INTO `artist` VALUES (4,'DJ-CJ','5f4dcc3b5aa765d61d8327deb882cf99','other@improvewithchris.com','DJ-CJ',1),(5,'rerrer','1d9b15769c35ded64b2e5d0cabf1132b','d@d.com','Cder',1),(6,'rchernin','9c707d43dc9de9e69580bb7cf3aa2fbf','rchernin92@gmail.com','Ross',1);
/*!40000 ALTER TABLE `artist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_archives`
--

DROP TABLE IF EXISTS `fuel_archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_archives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` int(10) unsigned NOT NULL,
  `table_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `version` smallint(5) unsigned NOT NULL,
  `version_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `archived_user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_archives`
--

LOCK TABLES `fuel_archives` WRITE;
/*!40000 ALTER TABLE `fuel_archives` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_archives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_blocks`
--

DROP TABLE IF EXISTS `fuel_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_blocks` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view` text COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `date_added` datetime DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_blocks`
--

LOCK TABLES `fuel_blocks` WRITE;
/*!40000 ALTER TABLE `fuel_blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_categories`
--

DROP TABLE IF EXISTS `fuel_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `slug` varchar(100) NOT NULL DEFAULT '',
  `context` varchar(100) NOT NULL DEFAULT '',
  `precedence` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_categories`
--

LOCK TABLES `fuel_categories` WRITE;
/*!40000 ALTER TABLE `fuel_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_logs`
--

DROP TABLE IF EXISTS `fuel_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_logs`
--

LOCK TABLES `fuel_logs` WRITE;
/*!40000 ALTER TABLE `fuel_logs` DISABLE KEYS */;
INSERT INTO `fuel_logs` VALUES (1,'2014-12-18 14:58:39',1,'Successful login by \'admin\' from 86.27.21.148','debug'),(2,'2014-12-18 14:59:17',1,'Password reset from CMS for \'admin\' from 86.27.21.148','debug'),(3,'2014-12-18 19:07:06',0,'Failed login by \'admin\' from 146.115.187.205, login attempts:   1','debug'),(4,'2014-12-18 19:07:23',0,'Failed login by \'admin\' from 146.115.187.205, login attempts:   2','debug'),(5,'2014-12-18 19:07:25',0,'Account lockout for \'admin\' from 146.115.187.205','debug'),(6,'2014-12-18 19:10:01',0,'Failed login by \'admin\' from 146.115.187.205, login attempts:   1','debug'),(7,'2014-12-18 19:10:03',0,'Failed login by \'admin\' from 146.115.187.205, login attempts:   2','debug'),(8,'2014-12-18 23:08:11',0,'Failed login by \'admin\' from 86.27.21.148, login attempts:   1','debug'),(9,'2014-12-18 23:08:49',0,'Failed login by \'admin\' from 86.27.21.148, login attempts:   2','debug'),(10,'2014-12-18 23:09:09',1,'Successful login by \'admin\' from 86.27.21.148','debug'),(11,'2014-12-19 06:22:11',1,'Successful login by \'admin\' from 136.167.198.112','debug'),(12,'2014-12-28 12:59:14',0,'Failed login by \'admin\' from 86.27.21.148, login attempts:   1','debug'),(13,'2014-12-28 12:59:40',0,'Failed login by \'admin\' from 86.27.21.148, login attempts:   2','debug'),(14,'2014-12-28 12:59:59',0,'Account lockout for \'admin\' from 86.27.21.148','debug');
/*!40000 ALTER TABLE `fuel_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_navigation`
--

DROP TABLE IF EXISTS `fuel_navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_navigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The part of the path after the domain name that you want the link to go to (e.g. comany/about_us)',
  `group_id` int(5) unsigned NOT NULL DEFAULT '1',
  `nav_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The nav key is a friendly ID that you can use for setting the selected state. If left blank, a default value will be set for you.',
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name you want to appear in the menu',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Used for creating menu hierarchies. No value means it is a root level menu item',
  `precedence` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The higher the number, the greater the precedence and farther up the list the navigational element will appear',
  `attributes` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Extra attributes that can be used for navigation implementation',
  `selected` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The pattern to match for the active state. Most likely you leave this field blank',
  `hidden` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'A hidden value can be used in rendering the menu. In some areas, the menu item may not want to be displayed',
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'Determines whether the item is displayed or not',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id_nav_key_language` (`group_id`,`nav_key`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_navigation`
--

LOCK TABLES `fuel_navigation` WRITE;
/*!40000 ALTER TABLE `fuel_navigation` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_navigation_groups`
--

DROP TABLE IF EXISTS `fuel_navigation_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_navigation_groups` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_navigation_groups`
--

LOCK TABLES `fuel_navigation_groups` WRITE;
/*!40000 ALTER TABLE `fuel_navigation_groups` DISABLE KEYS */;
INSERT INTO `fuel_navigation_groups` VALUES (1,'main','yes');
/*!40000 ALTER TABLE `fuel_navigation_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_page_variables`
--

DROP TABLE IF EXISTS `fuel_page_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_page_variables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('string','int','boolean','array') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'string',
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_id` (`page_id`,`name`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_page_variables`
--

LOCK TABLES `fuel_page_variables` WRITE;
/*!40000 ALTER TABLE `fuel_page_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_page_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_pages`
--

DROP TABLE IF EXISTS `fuel_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Add the part of the url after the root of your site (usually after the domain name). For the homepage, just put the word ''home''',
  `layout` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the template to associate with this page',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'A ''yes'' value will display the page and an ''no'' value will give a 404 error message',
  `cache` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'Cache controls whether the page will pull from the database or from a saved file which is more effeicent. If a page has content that is dynamic, it''s best to set cache to ''no''',
  `date_added` datetime DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location` (`location`),
  KEY `layout` (`layout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_pages`
--

LOCK TABLES `fuel_pages` WRITE;
/*!40000 ALTER TABLE `fuel_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_permissions`
--

DROP TABLE IF EXISTS `fuel_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'In most cases, this should be the name of the module (e.g. news)',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_permissions`
--

LOCK TABLES `fuel_permissions` WRITE;
/*!40000 ALTER TABLE `fuel_permissions` DISABLE KEYS */;
INSERT INTO `fuel_permissions` VALUES (1,'Pages','pages','yes'),(2,'Pages: Create','pages/create','yes'),(3,'Pages: Edit','pages/edit','yes'),(4,'Pages: Publish','pages/publish','yes'),(5,'Pages: Delete','pages/delete','yes'),(6,'Blocks','blocks','yes'),(7,'Blocks: Create','blocks/create','yes'),(8,'Blocks: Edit','blocks/edit','yes'),(9,'Blocks: Publish','blocks/publish','yes'),(10,'Blocks: Delete','blocks/delete','yes'),(11,'Navigation','navigation','yes'),(12,'Navigation: Create','navigation/create','yes'),(13,'Navigation: Edit','navigation/edit','yes'),(14,'Navigation: Publish','navigation/publish','yes'),(15,'Navigation: Delete','navigation/delete','yes'),(16,'Categories','categories','yes'),(17,'Categories: Create','categories/create','yes'),(18,'Categories: Edit','categories/edit','yes'),(19,'Categories: Publish','categories/publish','yes'),(20,'Categories: Delete','categories/delete','yes'),(21,'Tags','tags','yes'),(22,'Tags: Create','tags/create','yes'),(23,'Tags: Edit','tags/edit','yes'),(24,'Tags: Publish','tags/publish','yes'),(25,'Tags: Delete','tags/delete','yes'),(26,'Site Variables','sitevariables','yes'),(27,'Assets','assets','yes'),(28,'Site Documentation','site_docs','yes'),(29,'Users','users','yes'),(30,'Permissions','permissions','yes'),(31,'Manage','manage','yes'),(32,'Cache','manage/cache','yes'),(33,'Logs','logs','yes'),(34,'Settings','settings','yes'),(35,'Generate Code','generate','yes');
/*!40000 ALTER TABLE `fuel_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_relationships`
--

DROP TABLE IF EXISTS `fuel_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_relationships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_table` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `candidate_key` int(11) NOT NULL,
  `foreign_table` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_table` (`candidate_table`,`candidate_key`),
  KEY `foreign_table` (`foreign_table`,`foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_relationships`
--

LOCK TABLES `fuel_relationships` WRITE;
/*!40000 ALTER TABLE `fuel_relationships` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_settings`
--

DROP TABLE IF EXISTS `fuel_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module` (`module`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_settings`
--

LOCK TABLES `fuel_settings` WRITE;
/*!40000 ALTER TABLE `fuel_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_site_variables`
--

DROP TABLE IF EXISTS `fuel_site_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_site_variables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'leave blank if you want the variable to be available to all pages',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_site_variables`
--

LOCK TABLES `fuel_site_variables` WRITE;
/*!40000 ALTER TABLE `fuel_site_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_site_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_tags`
--

DROP TABLE IF EXISTS `fuel_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `precedence` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_tags`
--

LOCK TABLES `fuel_tags` WRITE;
/*!40000 ALTER TABLE `fuel_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_users`
--

DROP TABLE IF EXISTS `fuel_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `reset_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `super_admin` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_users`
--

LOCK TABLES `fuel_users` WRITE;
/*!40000 ALTER TABLE `fuel_users` DISABLE KEYS */;
INSERT INTO `fuel_users` VALUES (1,'admin','313c41e3c4d9908de1992f58430e7eb1e74c7ea0','dave_gill@blueyonder.co.uk','Dave','Gill','english','','b76ea210fe019ba404048ad186a0a21c','yes','yes');
/*!40000 ALTER TABLE `fuel_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-28 19:08:22
