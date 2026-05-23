
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
DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `area_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_branch_id_foreign` (`branch_id`),
  CONSTRAINT `areas_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,1,'Kicukiro',NULL,NULL),(2,1,'Nyarugenge',NULL,NULL),(3,1,'Gasabo',NULL,NULL),(4,1,'Nyamirambo',NULL,NULL),(5,1,'Kimironko',NULL,NULL),(6,1,'Remera',NULL,NULL),(7,1,'Gisozi',NULL,NULL),(8,1,'Kanombe',NULL,NULL),(9,3,'Kicukiro',NULL,NULL),(10,3,'Nyarugenge',NULL,NULL),(11,3,'Gasabo',NULL,NULL),(12,3,'Nyamirambo',NULL,NULL),(13,3,'Kimironko',NULL,NULL),(14,3,'Remera',NULL,NULL),(15,3,'Gisozi',NULL,NULL),(16,3,'Kanombe',NULL,NULL),(17,5,'Kicukiro',NULL,NULL),(18,5,'Nyarugenge',NULL,NULL),(19,5,'Gasabo',NULL,NULL),(20,5,'Nyamirambo',NULL,NULL),(21,5,'Kimironko',NULL,NULL),(22,5,'Remera',NULL,NULL),(23,5,'Gisozi',NULL,NULL),(24,5,'Kanombe',NULL,NULL);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `assign_waiter_to_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assign_waiter_to_tables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `table_id` bigint(20) unsigned NOT NULL,
  `waiter_id` bigint(20) unsigned DEFAULT NULL,
  `backup_waiter_id` bigint(20) unsigned DEFAULT NULL,
  `assigned_by` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `effective_from` date NOT NULL,
  `effective_to` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assign_waiter_to_tables_waiter_id_foreign` (`waiter_id`),
  KEY `assign_waiter_to_tables_backup_waiter_id_foreign` (`backup_waiter_id`),
  KEY `assign_waiter_to_tables_assigned_by_foreign` (`assigned_by`),
  KEY `assign_waiter_to_tables_table_id_waiter_id_index` (`table_id`,`waiter_id`),
  KEY `assign_waiter_to_tables_is_active_index` (`is_active`),
  CONSTRAINT `assign_waiter_to_tables_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assign_waiter_to_tables_backup_waiter_id_foreign` FOREIGN KEY (`backup_waiter_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `assign_waiter_to_tables_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assign_waiter_to_tables_waiter_id_foreign` FOREIGN KEY (`waiter_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `assign_waiter_to_tables` WRITE;
/*!40000 ALTER TABLE `assign_waiter_to_tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `assign_waiter_to_tables` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `branch_delivery_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch_delivery_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `max_radius` decimal(8,2) NOT NULL DEFAULT 5.00,
  `unit` enum('km','miles') NOT NULL DEFAULT 'km',
  `fee_type` varchar(191) NOT NULL DEFAULT 'fixed',
  `fixed_fee` decimal(8,2) DEFAULT NULL,
  `per_distance_rate` decimal(8,2) DEFAULT NULL,
  `free_delivery_over_amount` decimal(8,2) DEFAULT NULL,
  `free_delivery_within_radius` double DEFAULT NULL,
  `delivery_schedule_start` time DEFAULT NULL,
  `delivery_schedule_end` time DEFAULT NULL,
  `prep_time_minutes` int(11) NOT NULL DEFAULT 20,
  `additional_eta_buffer_time` int(11) DEFAULT NULL,
  `avg_delivery_speed_kmh` int(11) NOT NULL DEFAULT 30,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_delivery_settings_branch_id_foreign` (`branch_id`),
  CONSTRAINT `branch_delivery_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `branch_delivery_settings` WRITE;
/*!40000 ALTER TABLE `branch_delivery_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `branch_delivery_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `branch_operational_shifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch_operational_shifts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `shift_name` varchar(191) DEFAULT NULL COMMENT 'Optional name for the shift (e.g., Morning Shift, Evening Shift)',
  `start_time` time NOT NULL COMMENT 'Start time of the shift (e.g., 09:00 for 9 AM)',
  `end_time` time NOT NULL COMMENT 'End time of the shift (e.g., 14:00 for 2 PM or 01:00 for 1 AM next day)',
  `day_of_week` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`day_of_week`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT 'Display order for shifts',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_operational_shifts_branch_id_is_active_index` (`branch_id`,`is_active`),
  KEY `branch_operational_shifts_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `branch_operational_shifts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `branch_operational_shifts_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `branch_operational_shifts` WRITE;
/*!40000 ALTER TABLE `branch_operational_shifts` DISABLE KEYS */;
/*!40000 ALTER TABLE `branch_operational_shifts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unique_hash` varchar(64) DEFAULT NULL,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `cloned_branch_name` varchar(191) DEFAULT NULL,
  `cloned_branch_id` varchar(191) DEFAULT NULL,
  `is_menu_clone` tinyint(1) NOT NULL DEFAULT 0,
  `is_item_categories_clone` tinyint(1) NOT NULL DEFAULT 0,
  `is_menu_items_clone` tinyint(1) NOT NULL DEFAULT 0,
  `is_item_modifiers_clone` tinyint(1) NOT NULL DEFAULT 0,
  `is_clone_reservation_settings` tinyint(1) NOT NULL DEFAULT 0,
  `is_clone_delivery_settings` tinyint(1) NOT NULL DEFAULT 0,
  `is_clone_kot_setting` tinyint(1) NOT NULL DEFAULT 0,
  `is_modifiers_groups_clone` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(191) DEFAULT NULL,
  `cr_number` varchar(191) DEFAULT NULL,
  `vat_number` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lat` decimal(10,7) DEFAULT NULL,
  `lng` decimal(10,7) DEFAULT NULL,
  `count_orders` int(11) NOT NULL DEFAULT 0,
  `total_orders` int(11) NOT NULL DEFAULT -1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_unique_hash_unique` (`unique_hash`),
  KEY `branches_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `branches_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'b525962229f0c764bdcb',1,'North Emelie',NULL,NULL,0,0,0,0,0,0,0,0,'10416 Effertz Prairie\nLake Assuntachester, NH 77610-7523',NULL,NULL,'2026-05-23 15:17:55','2026-05-23 15:17:57',NULL,NULL,9,-1),(2,'b5ac94ee9c112cdd63f2',1,'North Edisonland',NULL,NULL,0,0,0,0,0,0,0,0,'4856 Christian Way Apt. 449\nWest Zoey, NY 11551',NULL,NULL,'2026-05-23 15:17:55','2026-05-23 15:17:55',NULL,NULL,0,-1),(3,'0750f83653e82e7e4dfa',2,'Jackelinehaven',NULL,NULL,0,0,0,0,0,0,0,0,'3277 Dickinson Light\nEast Lurline, MN 45265-7649',NULL,NULL,'2026-05-23 15:17:55','2026-05-23 15:17:59',NULL,NULL,9,-1),(4,'87c46a5ac744c8bf9c65',2,'Hoseaside',NULL,NULL,0,0,0,0,0,0,0,0,'623 Shields Bypass Suite 743\nNew Clarissaberg, VA 58287',NULL,NULL,'2026-05-23 15:17:56','2026-05-23 15:17:56',NULL,NULL,0,-1),(5,'461b5b660208f73360bc',3,'Jacobimouth',NULL,NULL,0,0,0,0,0,0,0,0,'226 Hayley Squares Apt. 196\nPort Cloyd, NJ 52878-9783',NULL,NULL,'2026-05-23 15:17:56','2026-05-23 15:18:00',NULL,NULL,9,-1),(6,'d17b5e6c8f24f5d7d5e6',3,'East Ellenmouth',NULL,NULL,0,0,0,0,0,0,0,0,'50740 Shad Flat\nLynchborough, IN 13273-6371',NULL,NULL,'2026-05-23 15:17:56','2026-05-23 15:17:56',NULL,NULL,0,-1);
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cart_header_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_header_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cart_header_setting_id` bigint(20) unsigned NOT NULL,
  `image_path` varchar(191) NOT NULL,
  `alt_text` varchar(191) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_header_images_cart_header_setting_id_foreign` (`cart_header_setting_id`),
  CONSTRAINT `cart_header_images_cart_header_setting_id_foreign` FOREIGN KEY (`cart_header_setting_id`) REFERENCES `cart_header_settings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cart_header_images` WRITE;
/*!40000 ALTER TABLE `cart_header_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_header_images` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cart_header_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_header_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `header_type` enum('text','image') NOT NULL DEFAULT 'text',
  `header_text` text DEFAULT NULL,
  `is_header_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_header_settings_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `cart_header_settings_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cart_header_settings` WRITE;
/*!40000 ALTER TABLE `cart_header_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_header_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cart_item_modifier_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_item_modifier_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cart_item_id` bigint(20) unsigned DEFAULT NULL,
  `modifier_option_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_item_modifier_options_cart_item_id_foreign` (`cart_item_id`),
  KEY `cart_item_modifier_options_modifier_option_id_foreign` (`modifier_option_id`),
  CONSTRAINT `cart_item_modifier_options_cart_item_id_foreign` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_item_modifier_options_modifier_option_id_foreign` FOREIGN KEY (`modifier_option_id`) REFERENCES `modifier_options` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cart_item_modifier_options` WRITE;
/*!40000 ALTER TABLE `cart_item_modifier_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_item_modifier_options` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cart_session_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `menu_item_id` bigint(20) unsigned DEFAULT NULL,
  `menu_item_variation_id` bigint(20) unsigned DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `tax_amount` decimal(16,2) DEFAULT NULL,
  `tax_percentage` decimal(8,4) DEFAULT NULL,
  `tax_breakup` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tax_breakup`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_session_id_foreign` (`cart_session_id`),
  KEY `cart_items_branch_id_foreign` (`branch_id`),
  KEY `cart_items_menu_item_id_foreign` (`menu_item_id`),
  KEY `cart_items_menu_item_variation_id_foreign` (`menu_item_variation_id`),
  CONSTRAINT `cart_items_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_cart_session_id_foreign` FOREIGN KEY (`cart_session_id`) REFERENCES `cart_sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_menu_item_variation_id_foreign` FOREIGN KEY (`menu_item_variation_id`) REFERENCES `menu_item_variations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cart_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_sessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(191) NOT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `order_type_id` bigint(20) unsigned DEFAULT NULL,
  `placed_via` enum('pos','shop','kiosk') DEFAULT NULL,
  `order_type` varchar(191) NOT NULL,
  `sub_total` decimal(16,2) NOT NULL,
  `total` decimal(16,2) NOT NULL,
  `total_tax_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `tax_mode` enum('order','item') NOT NULL DEFAULT 'order',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_sessions_branch_id_foreign` (`branch_id`),
  KEY `cart_sessions_order_id_foreign` (`order_id`),
  KEY `cart_sessions_order_type_id_foreign` (`order_type_id`),
  CONSTRAINT `cart_sessions_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_sessions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_sessions_order_type_id_foreign` FOREIGN KEY (`order_type_id`) REFERENCES `order_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cart_sessions` WRITE;
/*!40000 ALTER TABLE `cart_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_setting_id` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `contact_company` varchar(191) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_language_setting_id_foreign` (`language_setting_id`),
  CONSTRAINT `contacts_language_setting_id_foreign` FOREIGN KEY (`language_setting_id`) REFERENCES `language_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,1,'support@example.com','Bond Hobbs Inc',NULL,'957 Jamie Station, Lamontborough, SD 27319-9459','2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `countries_code` char(2) NOT NULL,
  `countries_name` varchar(191) NOT NULL,
  `phonecode` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_countries_code_index` (`countries_code`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AF','Afghanistan','93'),(2,'AX','├àland Islands','358'),(3,'AL','Albania','355'),(4,'DZ','Algeria','213'),(5,'AS','American Samoa','1684'),(6,'AD','Andorra','376'),(7,'AO','Angola','244'),(8,'AI','Anguilla','1264'),(9,'AQ','Antarctica','0'),(10,'AG','Antigua and Barbuda','1268'),(11,'AR','Argentina','54'),(12,'AM','Armenia','374'),(13,'AW','Aruba','297'),(14,'AU','Australia','61'),(15,'AT','Austria','43'),(16,'AZ','Azerbaijan','994'),(17,'BS','Bahamas','1242'),(18,'BH','Bahrain','973'),(19,'BD','Bangladesh','880'),(20,'BB','Barbados','1246'),(21,'BY','Belarus','375'),(22,'BE','Belgium','32'),(23,'BZ','Belize','501'),(24,'BJ','Benin','229'),(25,'BM','Bermuda','1441'),(26,'BT','Bhutan','975'),(27,'BO','Bolivia, Plurinational State of','591'),(28,'BQ','Bonaire, Sint Eustatius and Saba','599'),(29,'BA','Bosnia and Herzegovina','387'),(30,'BW','Botswana','267'),(31,'BV','Bouvet Island','0'),(32,'BR','Brazil','55'),(33,'IO','British Indian Ocean Territory','246'),(34,'BN','Brunei Darussalam','673'),(35,'BG','Bulgaria','359'),(36,'BF','Burkina Faso','226'),(37,'BI','Burundi','257'),(38,'KH','Cambodia','855'),(39,'CM','Cameroon','237'),(40,'CA','Canada','1'),(41,'CV','Cape Verde','238'),(42,'KY','Cayman Islands','1345'),(43,'CF','Central African Republic','236'),(44,'TD','Chad','235'),(45,'CL','Chile','56'),(46,'CN','China','86'),(47,'CX','Christmas Island','61'),(48,'CC','Cocos (Keeling) Islands','672'),(49,'CO','Colombia','57'),(50,'KM','Comoros','269'),(51,'CG','Congo','242'),(52,'CD','Congo, the Democratic Republic of the','242'),(53,'CK','Cook Islands','682'),(54,'CR','Costa Rica','506'),(55,'CI','C├┤te d\'Ivoire','225'),(56,'HR','Croatia','385'),(57,'CU','Cuba','53'),(58,'CW','Cura├ºao','599'),(59,'CY','Cyprus','357'),(60,'CZ','Czech Republic','420'),(61,'DK','Denmark','45'),(62,'DJ','Djibouti','253'),(63,'DM','Dominica','1767'),(64,'DO','Dominican Republic','1809'),(65,'EC','Ecuador','593'),(66,'EG','Egypt','20'),(67,'SV','El Salvador','503'),(68,'GQ','Equatorial Guinea','240'),(69,'ER','Eritrea','291'),(70,'EE','Estonia','372'),(71,'ET','Ethiopia','251'),(72,'FK','Falkland Islands (Malvinas)','500'),(73,'FO','Faroe Islands','298'),(74,'FJ','Fiji','679'),(75,'FI','Finland','358'),(76,'FR','France','33'),(77,'GF','French Guiana','594'),(78,'PF','French Polynesia','689'),(79,'TF','French Southern Territories','0'),(80,'GA','Gabon','241'),(81,'GM','Gambia','220'),(82,'GE','Georgia','995'),(83,'DE','Germany','49'),(84,'GH','Ghana','233'),(85,'GI','Gibraltar','350'),(86,'GR','Greece','30'),(87,'GL','Greenland','299'),(88,'GD','Grenada','1473'),(89,'GP','Guadeloupe','590'),(90,'GU','Guam','1671'),(91,'GT','Guatemala','502'),(92,'GG','Guernsey','44'),(93,'GN','Guinea','224'),(94,'GW','Guinea-Bissau','245'),(95,'GY','Guyana','592'),(96,'HT','Haiti','509'),(97,'HM','Heard Island and McDonald Islands','0'),(98,'VA','Holy See (Vatican City State)','39'),(99,'HN','Honduras','504'),(100,'HK','Hong Kong','852'),(101,'HU','Hungary','36'),(102,'IS','Iceland','354'),(103,'IN','India','91'),(104,'ID','Indonesia','62'),(105,'IR','Iran, Islamic Republic of','98'),(106,'IQ','Iraq','964'),(107,'IE','Ireland','353'),(108,'IM','Isle of Man','44'),(109,'IL','Israel','972'),(110,'IT','Italy','39'),(111,'JM','Jamaica','1876'),(112,'JP','Japan','81'),(113,'JE','Jersey','44'),(114,'JO','Jordan','962'),(115,'KZ','Kazakhstan','7'),(116,'KE','Kenya','254'),(117,'KI','Kiribati','686'),(118,'KP','Korea, Democratic People\'s Republic of','850'),(119,'KR','Korea, Republic of','82'),(120,'KW','Kuwait','965'),(121,'KG','Kyrgyzstan','996'),(122,'LA','Lao People\'s Democratic Republic','856'),(123,'LV','Latvia','371'),(124,'LB','Lebanon','961'),(125,'LS','Lesotho','266'),(126,'LR','Liberia','231'),(127,'LY','Libya','218'),(128,'LI','Liechtenstein','423'),(129,'LT','Lithuania','370'),(130,'LU','Luxembourg','352'),(131,'MO','Macao','853'),(132,'MK','Macedonia, the Former Yugoslav Republic of','389'),(133,'MG','Madagascar','261'),(134,'MW','Malawi','265'),(135,'MY','Malaysia','60'),(136,'MV','Maldives','960'),(137,'ML','Mali','223'),(138,'MT','Malta','356'),(139,'MH','Marshall Islands','692'),(140,'MQ','Martinique','596'),(141,'MR','Mauritania','222'),(142,'MU','Mauritius','230'),(143,'YT','Mayotte','269'),(144,'MX','Mexico','52'),(145,'FM','Micronesia, Federated States of','691'),(146,'MD','Moldova, Republic of','373'),(147,'MC','Monaco','377'),(148,'MN','Mongolia','976'),(149,'ME','Montenegro','382'),(150,'MS','Montserrat','1664'),(151,'MA','Morocco','212'),(152,'MZ','Mozambique','258'),(153,'MM','Myanmar','95'),(154,'NA','Namibia','264'),(155,'NR','Nauru','674'),(156,'NP','Nepal','977'),(157,'NL','Netherlands','31'),(158,'NC','New Caledonia','687'),(159,'NZ','New Zealand','64'),(160,'NI','Nicaragua','505'),(161,'NE','Niger','227'),(162,'NG','Nigeria','234'),(163,'NU','Niue','683'),(164,'NF','Norfolk Island','672'),(165,'MP','Northern Mariana Islands','1670'),(166,'NO','Norway','47'),(167,'OM','Oman','968'),(168,'PK','Pakistan','92'),(169,'PW','Palau','680'),(170,'PS','Palestine, State of','970'),(171,'PA','Panama','507'),(172,'PG','Papua New Guinea','675'),(173,'PY','Paraguay','595'),(174,'PE','Peru','51'),(175,'PH','Philippines','63'),(176,'PN','Pitcairn','0'),(177,'PL','Poland','48'),(178,'PT','Portugal','351'),(179,'PR','Puerto Rico','1787'),(180,'QA','Qatar','974'),(181,'RE','R├⌐union','262'),(182,'RO','Romania','40'),(183,'RU','Russian Federation','7'),(184,'RW','Rwanda','250'),(185,'BL','Saint Barth├⌐lemy','590'),(186,'SH','Saint Helena, Ascension and Tristan da Cunha','290'),(187,'KN','Saint Kitts and Nevis','1869'),(188,'LC','Saint Lucia','1758'),(189,'MF','Saint Martin (French part)','590'),(190,'PM','Saint Pierre and Miquelon','508'),(191,'VC','Saint Vincent and the Grenadines','1784'),(192,'WS','Samoa','684'),(193,'SM','San Marino','378'),(194,'ST','Sao Tome and Principe','239'),(195,'SA','Saudi Arabia','966'),(196,'SN','Senegal','221'),(197,'RS','Serbia','381'),(198,'SC','Seychelles','248'),(199,'SL','Sierra Leone','232'),(200,'SG','Singapore','65'),(201,'SX','Sint Maarten (Dutch part)','1'),(202,'SK','Slovakia','421'),(203,'SI','Slovenia','386'),(204,'SB','Solomon Islands','677'),(205,'SO','Somalia','252'),(206,'ZA','South Africa','27'),(207,'GS','South Georgia and the South Sandwich Islands','0'),(208,'SS','South Sudan','211'),(209,'ES','Spain','34'),(210,'LK','Sri Lanka','94'),(211,'SD','Sudan','249'),(212,'SR','Suriname','597'),(213,'SJ','Svalbard and Jan Mayen','47'),(214,'SZ','Swaziland','268'),(215,'SE','Sweden','46'),(216,'CH','Switzerland','41'),(217,'SY','Syrian Arab Republic','963'),(218,'TW','Taiwan, Province of China','886'),(219,'TJ','Tajikistan','992'),(220,'TZ','Tanzania, United Republic of','255'),(221,'TH','Thailand','66'),(222,'TL','Timor-Leste','670'),(223,'TG','Togo','228'),(224,'TK','Tokelau','690'),(225,'TO','Tonga','676'),(226,'TT','Trinidad and Tobago','1868'),(227,'TN','Tunisia','216'),(228,'TR','Turkey','90'),(229,'TM','Turkmenistan','7370'),(230,'TC','Turks and Caicos Islands','1649'),(231,'TV','Tuvalu','688'),(232,'UG','Uganda','256'),(233,'UA','Ukraine','380'),(234,'AE','United Arab Emirates','971'),(235,'GB','United Kingdom','44'),(236,'US','United States','1'),(237,'UM','United States Minor Outlying Islands','1'),(238,'UY','Uruguay','598'),(239,'UZ','Uzbekistan','998'),(240,'VU','Vanuatu','678'),(241,'VE','Venezuela, Bolivarian Republic of','58'),(242,'VN','Viet Nam','84'),(243,'VG','Virgin Islands, British','1284'),(244,'VI','Virgin Islands, U.S.','1340'),(245,'WF','Wallis and Futuna','681'),(246,'EH','Western Sahara','212'),(247,'YE','Yemen','967'),(248,'ZM','Zambia','260'),(249,'ZW','Zimbabwe','263');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `currency_name` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `currency_symbol` varchar(191) NOT NULL,
  `currency_position` enum('left','right','left_with_space','right_with_space') NOT NULL DEFAULT 'left',
  `no_of_decimal` int(10) unsigned NOT NULL DEFAULT 2,
  `thousand_separator` varchar(191) DEFAULT ',',
  `decimal_separator` varchar(191) DEFAULT '.',
  `exchange_rate` decimal(16,2) DEFAULT NULL,
  `usd_price` decimal(16,2) DEFAULT NULL,
  `is_cryptocurrency` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `currencies_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `currencies_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,1,'Rwanda Franc','RWF','FRw','left',2,',','.',NULL,NULL,'no'),(2,1,'Dollars','USD','$','left',2,',','.',NULL,NULL,'no'),(3,1,'Euros','EUR','Γé¼','left',2,',','.',NULL,NULL,'no'),(4,1,'Pounds','GBP','┬ú','left',2,',','.',NULL,NULL,'no'),(5,2,'Rwanda Franc','RWF','FRw','left',2,',','.',NULL,NULL,'no'),(6,2,'Dollars','USD','$','left',2,',','.',NULL,NULL,'no'),(7,2,'Euros','EUR','Γé¼','left',2,',','.',NULL,NULL,'no'),(8,2,'Pounds','GBP','┬ú','left',2,',','.',NULL,NULL,'no'),(9,3,'Rwanda Franc','RWF','FRw','left',2,',','.',NULL,NULL,'no'),(10,3,'Dollars','USD','$','left',2,',','.',NULL,NULL,'no'),(11,3,'Euros','EUR','Γé¼','left',2,',','.',NULL,NULL,'no'),(12,3,'Pounds','GBP','┬ú','left',2,',','.',NULL,NULL,'no');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `custom_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(191) NOT NULL,
  `menu_slug` varchar(191) NOT NULL,
  `menu_content` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `position` enum('header','footer') NOT NULL DEFAULT 'header',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `custom_menus_menu_slug_unique` (`menu_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `custom_menus` WRITE;
/*!40000 ALTER TABLE `custom_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_menus` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `customer_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `label` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lat` decimal(10,7) DEFAULT NULL,
  `lng` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_addresses_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `customer_addresses` WRITE;
/*!40000 ALTER TABLE `customer_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_addresses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `phone_code` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_otp` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_restaurant_email_unique` (`restaurant_id`,`email`),
  UNIQUE KEY `customers_email_restaurant_unique` (`email`,`restaurant_id`),
  CONSTRAINT `customers_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,1,'Bo Bins',NULL,NULL,'ubatz@example.com',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','32394 Germaine Groves\nNorth Coralie, TX 86100-2648'),(2,1,'Oceane Heathcote',NULL,NULL,'albina.yundt@example.org',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','557 Willms Hills Apt. 556\nEdwinbury, OH 36073'),(3,1,'Aron Gutkowski',NULL,NULL,'gerhold.theodora@example.net',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','847 Efren Estate\nEast Jorge, IL 15740-6474'),(4,1,'Zane Gutmann',NULL,NULL,'xbraun@example.org',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','579 Mae Canyon Apt. 166\nPort Wyattmouth, IN 00849-0832'),(5,1,'Braxton Gutmann',NULL,NULL,'jakubowski.camren@example.com',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','7763 Lowe Course\nSouth Jamarcus, KS 56360'),(6,1,'Fausto Graham',NULL,NULL,'dhoeger@example.com',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','57900 Camilla Trafficway\nGeovanniville, CO 86135-8259'),(7,1,'Susana Emard',NULL,NULL,'woodrow.deckow@example.net',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','6539 Luettgen Union\nLake Eloisa, TN 73561-6360'),(8,1,'Kiara McDermott',NULL,NULL,'austin.champlin@example.org',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','91938 Julius Square Apt. 120\nBrennonview, IA 26292'),(9,1,'Gabriel Gleichner',NULL,NULL,'lhessel@example.com',NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','76093 Carli Drive Suite 360\nEast Serenaport, SC 72694-5854'),(10,2,'Easton Erdman',NULL,NULL,'dgutkowski@example.com',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','8760 Naomi Viaduct Apt. 508\nWest Candice, SC 12914-8872'),(11,2,'Ole Hettinger',NULL,NULL,'qmertz@example.com',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','254 Johnston Extensions\nNew Toni, OK 17713'),(12,2,'Christelle Cassin',NULL,NULL,'marcelino29@example.net',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','37361 Raynor Ford\nNew Kimchester, IL 35814'),(13,2,'Felicity Erdman',NULL,NULL,'lauriane.feil@example.com',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','3605 Jacey Haven\nColemouth, TX 78663'),(14,2,'Palma Prohaska',NULL,NULL,'britney53@example.com',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','6474 O\'Kon Alley Suite 900\nWest Linniemouth, CT 72146'),(15,2,'Jed Gleason',NULL,NULL,'gjakubowski@example.com',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','57521 Elenora Spurs Suite 658\nWest Erniechester, WY 33074'),(16,2,'Emie Mueller',NULL,NULL,'general97@example.net',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','1476 Kautzer Dam\nRebekahstad, GA 86835'),(17,2,'Grace Bednar',NULL,NULL,'willa.maggio@example.org',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','4107 Witting Manor Apt. 319\nNorth Carmelo, TN 79770-0072'),(18,2,'Micheal Purdy',NULL,NULL,'xstoltenberg@example.net',NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','936 Weissnat Corners\nJordaneton, OR 36311'),(19,3,'Major Hyatt',NULL,NULL,'reina94@example.net',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','115 Janie Court Suite 824\nNorth Carmelafort, CA 59843-0526'),(20,3,'Salma Ziemann',NULL,NULL,'rfay@example.com',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','26299 Kub Creek Apt. 379\nLake Luciennetown, UT 56144-0054'),(21,3,'Karina Cremin',NULL,NULL,'haley.araceli@example.net',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','81082 Conn Mountains Suite 692\nClintonport, IA 21170-1959'),(22,3,'Fannie Schuster',NULL,NULL,'yolanda.gibson@example.org',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','874 Daniel Crossing Apt. 894\nHeathcotefurt, NY 98035-7624'),(23,3,'Emery Romaguera',NULL,NULL,'emie85@example.org',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','3309 Chauncey Knoll Suite 252\nLorenamouth, NE 80396'),(24,3,'Lura Gerlach',NULL,NULL,'solon56@example.net',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','701 Wallace Circles Apt. 880\nAuershire, IN 36257'),(25,3,'Kim Prosacco',NULL,NULL,'ctremblay@example.com',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','91661 Wunsch Keys\nWest Efrenhaven, VT 54557-4885'),(26,3,'Reyna Price',NULL,NULL,'terry.dillon@example.com',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','8686 Alexandria Heights\nLake Carleyborough, PA 25672-6999'),(27,3,'Lewis McDermott',NULL,NULL,'ljohns@example.com',NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00','783 Tremblay Drive Suite 056\nTalonfort, DE 37164');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `delivery_cash_settlement_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_cash_settlement_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `settlement_id` bigint(20) unsigned NOT NULL,
  `order_cash_collection_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dcsi_settlement_collection_unique` (`settlement_id`,`order_cash_collection_id`),
  KEY `delivery_cash_settlement_items_order_cash_collection_id_foreign` (`order_cash_collection_id`),
  KEY `delivery_cash_settlement_items_order_id_foreign` (`order_id`),
  CONSTRAINT `delivery_cash_settlement_items_order_cash_collection_id_foreign` FOREIGN KEY (`order_cash_collection_id`) REFERENCES `order_cash_collections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `delivery_cash_settlement_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `delivery_cash_settlement_items_settlement_id_foreign` FOREIGN KEY (`settlement_id`) REFERENCES `delivery_cash_settlements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `delivery_cash_settlement_items` WRITE;
/*!40000 ALTER TABLE `delivery_cash_settlement_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_cash_settlement_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `delivery_cash_settlements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_cash_settlements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `delivery_executive_id` bigint(20) unsigned NOT NULL,
  `settlement_number` varchar(191) DEFAULT NULL,
  `submitted_amount` decimal(16,2) NOT NULL,
  `verified_amount` decimal(16,2) DEFAULT NULL,
  `status` enum('submitted','approved','rejected') NOT NULL DEFAULT 'submitted',
  `notes` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `delivery_cash_settlements_settlement_number_unique` (`settlement_number`),
  KEY `delivery_cash_settlements_branch_id_foreign` (`branch_id`),
  KEY `dcs_exec_status_idx` (`delivery_executive_id`,`status`),
  CONSTRAINT `delivery_cash_settlements_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `delivery_cash_settlements_delivery_executive_id_foreign` FOREIGN KEY (`delivery_executive_id`) REFERENCES `delivery_executives` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `delivery_cash_settlements` WRITE;
/*!40000 ALTER TABLE `delivery_cash_settlements` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_cash_settlements` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `delivery_executives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_executives` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `unique_code` varchar(191) DEFAULT NULL,
  `phone_code` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `status` enum('available','on_delivery','inactive') NOT NULL DEFAULT 'available',
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `delivery_executives_email_unique` (`email`),
  KEY `delivery_executives_branch_id_foreign` (`branch_id`),
  CONSTRAINT `delivery_executives_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `delivery_executives` WRITE;
/*!40000 ALTER TABLE `delivery_executives` DISABLE KEYS */;
INSERT INTO `delivery_executives` VALUES (1,1,'Jean Claude Habimana','de1.branch1@hyamii.rw','07818000000','KNJ31','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,'Alice Mukamana','de2.branch1@hyamii.rw','07818000001','WGW42','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,'Patrick Niyonzima','de3.branch1@hyamii.rw','07818000002','UHZT3','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,'Diane Uwimana','de4.branch1@hyamii.rw','07818000003','CPXP4','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,1,'Eric Mugisha','de5.branch1@hyamii.rw','07818000004','GL3F5','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,1,'Grace Nyiraneza','de6.branch1@hyamii.rw','07818000005','BIGT6','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,1,'Emmanuel Nkusi','de7.branch1@hyamii.rw','07818000006','SEB67','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(8,1,'Chantal Mukeshimana','de8.branch1@hyamii.rw','07818000007','IQQM8','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(9,1,'David Ndagijimana','de9.branch1@hyamii.rw','07818000008','2LFE9','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(10,1,'Joseline Ingabire','de10.branch1@hyamii.rw','07818000009','KE1G10','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(11,1,'Olivier Hategekimana','de11.branch1@hyamii.rw','07818000010','EGNW11','250',NULL,'available',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(12,3,'Jean Claude Habimana','de1.branch3@hyamii.rw','07838000000','XPET12','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(13,3,'Alice Mukamana','de2.branch3@hyamii.rw','07838000001','KQGN13','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(14,3,'Patrick Niyonzima','de3.branch3@hyamii.rw','07838000002','KFBD14','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(15,3,'Diane Uwimana','de4.branch3@hyamii.rw','07838000003','U6B915','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(16,3,'Eric Mugisha','de5.branch3@hyamii.rw','07838000004','IUTO16','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(17,3,'Grace Nyiraneza','de6.branch3@hyamii.rw','07838000005','LKD517','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(18,3,'Emmanuel Nkusi','de7.branch3@hyamii.rw','07838000006','ETMR18','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(19,3,'Chantal Mukeshimana','de8.branch3@hyamii.rw','07838000007','5LWS19','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(20,3,'David Ndagijimana','de9.branch3@hyamii.rw','07838000008','ITBK20','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(21,3,'Joseline Ingabire','de10.branch3@hyamii.rw','07838000009','EY2M21','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(22,3,'Olivier Hategekimana','de11.branch3@hyamii.rw','07838000010','4A5G22','250',NULL,'available',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(23,5,'Jean Claude Habimana','de1.branch5@hyamii.rw','07858000000','GXEQ23','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(24,5,'Alice Mukamana','de2.branch5@hyamii.rw','07858000001','WI3J24','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(25,5,'Patrick Niyonzima','de3.branch5@hyamii.rw','07858000002','WTS825','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(26,5,'Diane Uwimana','de4.branch5@hyamii.rw','07858000003','RRVP26','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(27,5,'Eric Mugisha','de5.branch5@hyamii.rw','07858000004','FYSK27','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(28,5,'Grace Nyiraneza','de6.branch5@hyamii.rw','07858000005','OUEX28','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(29,5,'Emmanuel Nkusi','de7.branch5@hyamii.rw','07858000006','2GD329','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(30,5,'Chantal Mukeshimana','de8.branch5@hyamii.rw','07858000007','PNLY30','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(31,5,'David Ndagijimana','de9.branch5@hyamii.rw','07858000008','AAPI31','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(32,5,'Joseline Ingabire','de10.branch5@hyamii.rw','07858000009','BGB832','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(33,5,'Olivier Hategekimana','de11.branch5@hyamii.rw','07858000010','E4SL33','250',NULL,'available',0,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `delivery_executives` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `delivery_fee_tiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_fee_tiers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `min_distance` double DEFAULT NULL,
  `max_distance` double DEFAULT NULL,
  `fee` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_fee_tiers_branch_id_foreign` (`branch_id`),
  CONSTRAINT `delivery_fee_tiers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `delivery_fee_tiers` WRITE;
/*!40000 ALTER TABLE `delivery_fee_tiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_fee_tiers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `delivery_platforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_platforms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `commission_type` enum('percent','fixed') NOT NULL DEFAULT 'percent',
  `commission_value` decimal(16,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_platforms_branch_id_foreign` (`branch_id`),
  CONSTRAINT `delivery_platforms_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `delivery_platforms` WRITE;
/*!40000 ALTER TABLE `delivery_platforms` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_platforms` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `desktop_mobile_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desktop_mobile_application` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `windows_file_path` varchar(191) DEFAULT NULL,
  `mac_file_path` varchar(191) DEFAULT NULL,
  `linux_file_path` varchar(191) DEFAULT NULL,
  `partner_app_ios` varchar(191) DEFAULT NULL,
  `partner_app_android` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `desktop_mobile_application` WRITE;
/*!40000 ALTER TABLE `desktop_mobile_application` DISABLE KEYS */;
INSERT INTO `desktop_mobile_application` VALUES (1,'https://envato.froid.works/app/download/windows','https://envato.froid.works/app/download/macos','https://envato.froid.works/app/download/linux','https://apps.apple.com/in/app/tabletrack-rider/id6759326050','https://play.google.com/store/apps/details?id=com.delivery.tabletrack&hl=en_IN',NULL,'2026-05-23 15:17:53');
/*!40000 ALTER TABLE `desktop_mobile_application` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `email_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mail_from_name` varchar(191) DEFAULT NULL,
  `mail_from_email` varchar(191) DEFAULT NULL,
  `enable_queue` enum('yes','no') NOT NULL DEFAULT 'no',
  `mail_driver` enum('mail','smtp') NOT NULL DEFAULT 'mail',
  `smtp_host` varchar(191) DEFAULT NULL,
  `smtp_port` varchar(191) DEFAULT NULL,
  `smtp_encryption` varchar(191) DEFAULT NULL,
  `mail_username` varchar(191) DEFAULT NULL,
  `mail_password` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `email_settings` WRITE;
/*!40000 ALTER TABLE `email_settings` DISABLE KEYS */;
INSERT INTO `email_settings` VALUES (1,'Hyamii','from@email.com','no','smtp','smtp.gmail.com','465','ssl','myemail@gmail.com',NULL,'2026-05-23 15:17:56','2026-05-23 15:17:56',0,0);
/*!40000 ALTER TABLE `email_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `epay_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epay_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `epay_payment_id` varchar(191) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_error_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_error_response`)),
  `epay_invoice_id` varchar(191) DEFAULT NULL,
  `epay_secret_hash` varchar(191) DEFAULT NULL,
  `epay_access_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `epay_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `epay_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `epay_payments` WRITE;
/*!40000 ALTER TABLE `epay_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `epay_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `expense_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_categories_branch_id_foreign` (`branch_id`),
  CONSTRAINT `expense_categories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `expense_categories` WRITE;
/*!40000 ALTER TABLE `expense_categories` DISABLE KEYS */;
INSERT INTO `expense_categories` VALUES (1,1,'Rent','Monthly rent for restaurant space',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,'Utilities','Electricity, water, gas, and other utilities',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,1,'Salaries','Employee salaries and wages',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,1,'Ingredients','Food ingredients and raw materials',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(5,1,'Equipment','Kitchen equipment and appliances',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(6,1,'Marketing','Advertising and promotional expenses',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(7,1,'Insurance','Business insurance and liability coverage',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(8,1,'Maintenance','Repairs and maintenance costs',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(9,1,'Licenses','Business licenses and permits',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(10,1,'Miscellaneous','Other miscellaneous expenses',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(11,2,'Rent','Monthly rent for restaurant space',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(12,2,'Utilities','Electricity, water, gas, and other utilities',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(13,2,'Salaries','Employee salaries and wages',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(14,2,'Ingredients','Food ingredients and raw materials',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(15,2,'Equipment','Kitchen equipment and appliances',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(16,2,'Marketing','Advertising and promotional expenses',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(17,2,'Insurance','Business insurance and liability coverage',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(18,2,'Maintenance','Repairs and maintenance costs',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(19,2,'Licenses','Business licenses and permits',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(20,2,'Miscellaneous','Other miscellaneous expenses',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(21,3,'Rent','Monthly rent for restaurant space',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(22,3,'Utilities','Electricity, water, gas, and other utilities',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(23,3,'Salaries','Employee salaries and wages',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(24,3,'Ingredients','Food ingredients and raw materials',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(25,3,'Equipment','Kitchen equipment and appliances',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(26,3,'Marketing','Advertising and promotional expenses',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(27,3,'Insurance','Business insurance and liability coverage',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(28,3,'Maintenance','Repairs and maintenance costs',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(29,3,'Licenses','Business licenses and permits',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(30,3,'Miscellaneous','Other miscellaneous expenses',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(31,4,'Rent','Monthly rent for restaurant space',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(32,4,'Utilities','Electricity, water, gas, and other utilities',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(33,4,'Salaries','Employee salaries and wages',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(34,4,'Ingredients','Food ingredients and raw materials',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(35,4,'Equipment','Kitchen equipment and appliances',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(36,4,'Marketing','Advertising and promotional expenses',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(37,4,'Insurance','Business insurance and liability coverage',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(38,4,'Maintenance','Repairs and maintenance costs',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(39,4,'Licenses','Business licenses and permits',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(40,4,'Miscellaneous','Other miscellaneous expenses',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(41,5,'Rent','Monthly rent for restaurant space',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(42,5,'Utilities','Electricity, water, gas, and other utilities',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(43,5,'Salaries','Employee salaries and wages',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(44,5,'Ingredients','Food ingredients and raw materials',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(45,5,'Equipment','Kitchen equipment and appliances',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(46,5,'Marketing','Advertising and promotional expenses',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(47,5,'Insurance','Business insurance and liability coverage',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(48,5,'Maintenance','Repairs and maintenance costs',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(49,5,'Licenses','Business licenses and permits',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(50,5,'Miscellaneous','Other miscellaneous expenses',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(51,6,'Rent','Monthly rent for restaurant space',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(52,6,'Utilities','Electricity, water, gas, and other utilities',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(53,6,'Salaries','Employee salaries and wages',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(54,6,'Ingredients','Food ingredients and raw materials',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(55,6,'Equipment','Kitchen equipment and appliances',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(56,6,'Marketing','Advertising and promotional expenses',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(57,6,'Insurance','Business insurance and liability coverage',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(58,6,'Maintenance','Repairs and maintenance costs',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(59,6,'Licenses','Business licenses and permits',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(60,6,'Miscellaneous','Other miscellaneous expenses',1,'2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `expense_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `expense_category_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned NOT NULL,
  `expense_title` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expense_date` date NOT NULL,
  `payment_status` varchar(191) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_due_date` date DEFAULT NULL,
  `payment_method` varchar(191) DEFAULT NULL,
  `receipt_path` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_expense_category_id_foreign` (`expense_category_id`),
  KEY `expenses_branch_id_foreign` (`branch_id`),
  CONSTRAINT `expenses_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `file_storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_storage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `path` varchar(191) NOT NULL,
  `filename` varchar(191) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `size` int(10) unsigned NOT NULL,
  `storage_location` enum('local','aws_s3','digitalocean','wasabi','minio') NOT NULL DEFAULT 'local',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `file_storage_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `file_storage_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `file_storage` WRITE;
/*!40000 ALTER TABLE `file_storage` DISABLE KEYS */;
INSERT INTO `file_storage` VALUES (1,1,'qrcodes','qrcode-branch-1-1.png','image/png',2803,'local','2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,'qrcodes','qrcode-branch-1-1.png','image/png',2803,'local','2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,1,'qrcodes','qrcode-branch-2-1.png','image/png',2782,'local','2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,1,'qrcodes','qrcode-branch-2-1.png','image/png',2782,'local','2026-05-23 15:17:55','2026-05-23 15:17:55'),(5,2,'qrcodes','qrcode-branch-3-2.png','image/png',2788,'local','2026-05-23 15:17:55','2026-05-23 15:17:55'),(6,2,'qrcodes','qrcode-branch-3-2.png','image/png',2784,'local','2026-05-23 15:17:56','2026-05-23 15:17:56'),(7,2,'qrcodes','qrcode-branch-4-2.png','image/png',2773,'local','2026-05-23 15:17:56','2026-05-23 15:17:56'),(8,2,'qrcodes','qrcode-branch-4-2.png','image/png',2773,'local','2026-05-23 15:17:56','2026-05-23 15:17:56'),(9,3,'qrcodes','qrcode-branch-5-3.png','image/png',2773,'local','2026-05-23 15:17:56','2026-05-23 15:17:56'),(10,3,'qrcodes','qrcode-branch-5-3.png','image/png',2773,'local','2026-05-23 15:17:56','2026-05-23 15:17:56'),(11,3,'qrcodes','qrcode-branch-6-3.png','image/png',2759,'local','2026-05-23 15:17:56','2026-05-23 15:17:56'),(12,3,'qrcodes','qrcode-branch-6-3.png','image/png',2759,'local','2026-05-23 15:17:56','2026-05-23 15:17:56'),(13,1,'qrcodes','qrcode-1-t-1.png','image/png',4365,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(14,1,'qrcodes','qrcode-1-t-2.png','image/png',4637,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(15,1,'qrcodes','qrcode-1-t-3.png','image/png',4606,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(16,1,'qrcodes','qrcode-1-t-4.png','image/png',4453,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(17,1,'qrcodes','qrcode-1-t-5.png','image/png',4572,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(18,1,'qrcodes','qrcode-1-t-6.png','image/png',4774,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(19,1,'qrcodes','qrcode-1-t-7.png','image/png',4471,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(20,1,'qrcodes','qrcode-1-t-8.png','image/png',4673,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(21,1,'qrcodes','qrcode-1-t-9.png','image/png',4752,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(22,1,'qrcodes','qrcode-1-t-10.png','image/png',4798,'local','2026-05-23 15:17:57','2026-05-23 15:17:57'),(23,2,'qrcodes','qrcode-3-t-1.png','image/png',4378,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(24,2,'qrcodes','qrcode-3-t-2.png','image/png',4646,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(25,2,'qrcodes','qrcode-3-t-3.png','image/png',4630,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(26,2,'qrcodes','qrcode-3-t-4.png','image/png',4468,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(27,2,'qrcodes','qrcode-3-t-5.png','image/png',4595,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(28,2,'qrcodes','qrcode-3-t-6.png','image/png',4721,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(29,2,'qrcodes','qrcode-3-t-7.png','image/png',4456,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(30,2,'qrcodes','qrcode-3-t-8.png','image/png',4733,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(31,2,'qrcodes','qrcode-3-t-9.png','image/png',4726,'local','2026-05-23 15:17:58','2026-05-23 15:17:58'),(32,2,'qrcodes','qrcode-3-t-10.png','image/png',4861,'local','2026-05-23 15:17:59','2026-05-23 15:17:59'),(33,3,'qrcodes','qrcode-5-t-1.png','image/png',4371,'local','2026-05-23 15:17:59','2026-05-23 15:17:59'),(34,3,'qrcodes','qrcode-5-t-2.png','image/png',4620,'local','2026-05-23 15:18:00','2026-05-23 15:18:00'),(35,3,'qrcodes','qrcode-5-t-3.png','image/png',4629,'local','2026-05-23 15:18:00','2026-05-23 15:18:00'),(36,3,'qrcodes','qrcode-5-t-4.png','image/png',4503,'local','2026-05-23 15:18:00','2026-05-23 15:18:00'),(37,3,'qrcodes','qrcode-5-t-5.png','image/png',4621,'local','2026-05-23 15:18:00','2026-05-23 15:18:00'),(38,3,'qrcodes','qrcode-5-t-6.png','image/png',4766,'local','2026-05-23 15:18:00','2026-05-23 15:18:00'),(39,3,'qrcodes','qrcode-5-t-7.png','image/png',4509,'local','2026-05-23 15:18:00','2026-05-23 15:18:00'),(40,3,'qrcodes','qrcode-5-t-8.png','image/png',4666,'local','2026-05-23 15:18:00','2026-05-23 15:18:00'),(41,3,'qrcodes','qrcode-5-t-9.png','image/png',4698,'local','2026-05-23 15:18:00','2026-05-23 15:18:00'),(42,3,'qrcodes','qrcode-5-t-10.png','image/png',4807,'local','2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `file_storage` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `file_storage_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_storage_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filesystem` varchar(191) NOT NULL,
  `auth_keys` text DEFAULT NULL,
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'disabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `file_storage_settings` WRITE;
/*!40000 ALTER TABLE `file_storage_settings` DISABLE KEYS */;
INSERT INTO `file_storage_settings` VALUES (1,'local',NULL,'enabled','2026-05-23 15:17:42','2026-05-23 15:17:42');
/*!40000 ALTER TABLE `file_storage_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `flags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `capital` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `continent` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=267 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `flags` WRITE;
/*!40000 ALTER TABLE `flags` DISABLE KEYS */;
INSERT INTO `flags` VALUES (1,'Kabul','af','Asia','Afghanistan'),(2,'Mariehamn','ax','Europe','Aland Islands'),(3,'Tirana','al','Europe','Albania'),(4,'Algiers','dz','Africa','Algeria'),(5,'Pago Pago','as','Oceania','American Samoa'),(6,'Andorra la Vella','ad','Europe','Andorra'),(7,'Luanda','ao','Africa','Angola'),(8,'The Valley','ai','North America','Anguilla'),(9,'','aq','','Antarctica'),(10,'St. John\'s','ag','North America','Antigua and Barbuda'),(11,'Buenos Aires','ar','South America','Argentina'),(12,'Yerevan','am','Asia','Armenia'),(13,'Oranjestad','aw','South America','Aruba'),(14,'Georgetown','ac','Africa','Ascension Island'),(15,'Canberra','au','Oceania','Australia'),(16,'Vienna','at','Europe','Austria'),(17,'Baku','az','Asia','Azerbaijan'),(18,'Nassau','bs','North America','Bahamas'),(19,'Manama','bh','Asia','Bahrain'),(20,'Dhaka','bd','Asia','Bangladesh'),(21,'Bridgetown','bb','North America','Barbados'),(22,'Minsk','by','Europe','Belarus'),(23,'Brussels','be','Europe','Belgium'),(24,'Belmopan','bz','North America','Belize'),(25,'Porto-Novo','bj','Africa','Benin'),(26,'Hamilton','bm','North America','Bermuda'),(27,'Thimphu','bt','Asia','Bhutan'),(28,'Sucre','bo','South America','Bolivia'),(29,'Kralendijk','bq','South America','Bonaire, Sint Eustatius and Saba'),(30,'Sarajevo','ba','Europe','Bosnia and Herzegovina'),(31,'Gaborone','bw','Africa','Botswana'),(32,'','bv','','Bouvet Island'),(33,'Bras├¡lia','br','South America','Brazil'),(34,'Diego Garcia','io','Asia','British Indian Ocean Territory'),(35,'Bandar Seri Begawan','bn','Asia','Brunei Darussalam'),(36,'Sofia','bg','Europe','Bulgaria'),(37,'Ouagadougou','bf','Africa','Burkina Faso'),(38,'Bujumbura','bi','Africa','Burundi'),(39,'Praia','cv','Africa','Cabo Verde'),(40,'Phnom Penh','kh','Asia','Cambodia'),(41,'Yaound├⌐','cm','Africa','Cameroon'),(42,'Ottawa','ca','North America','Canada'),(43,'','ic','','Canary Islands'),(44,'','es-ct','','Catalonia'),(45,'George Town','ky','North America','Cayman Islands'),(46,'Bangui','cf','Africa','Central African Republic'),(47,'','cefta','','Central European Free Trade Agreement'),(48,'','ea','','Ceuta & Melilla'),(49,'N\'Djamena','td','Africa','Chad'),(50,'Santiago','cl','South America','Chile'),(51,'Beijing','cn','Asia','China'),(52,'Flying Fish Cove','cx','Asia','Christmas Island'),(53,'','cp','','Clipperton Island'),(54,'West Island','cc','Asia','Cocos (Keeling) Islands'),(55,'Bogot├í','co','South America','Colombia'),(56,'Moroni','km','Africa','Comoros'),(57,'Avarua','ck','Oceania','Cook Islands'),(58,'San Jos├⌐','cr','North America','Costa Rica'),(59,'Zagreb','hr','Europe','Croatia'),(60,'Havana','cu','North America','Cuba'),(61,'Willemstad','cw','South America','Cura├ºao'),(62,'Nicosia','cy','Europe','Cyprus'),(63,'Prague','cz','Europe','Czech Republic'),(64,'Yamoussoukro','ci','Africa','C├┤te d\'Ivoire'),(65,'Kinshasa','cd','Africa','Democratic Republic of the Congo'),(66,'Copenhagen','dk','Europe','Denmark'),(67,'','dg','','Diego Garcia'),(68,'Djibouti','dj','Africa','Djibouti'),(69,'Roseau','dm','North America','Dominica'),(70,'Santo Domingo','do','North America','Dominican Republic'),(71,'Quito','ec','South America','Ecuador'),(72,'Cairo','eg','Africa','Egypt'),(73,'San Salvador','sv','North America','El Salvador'),(74,'London','gb-eng','Europe','England'),(75,'Malabo','gq','Africa','Equatorial Guinea'),(76,'Asmara','er','Africa','Eritrea'),(77,'Tallinn','ee','Europe','Estonia'),(78,'Lobamba, Mbabane','sz','Africa','Eswatini'),(79,'Addis Ababa','et','Africa','Ethiopia'),(80,'','eu','','Europe'),(81,'Stanley','fk','South America','Falkland Islands'),(82,'T├│rshavn','fo','Europe','Faroe Islands'),(83,'Palikir','fm','Oceania','Federated States of Micronesia'),(84,'Suva','fj','Oceania','Fiji'),(85,'Helsinki','fi','Europe','Finland'),(86,'Paris','fr','Europe','France'),(87,'Cayenne','gf','South America','French Guiana'),(88,'Papeete','pf','Oceania','French Polynesia'),(89,'Saint-Pierre, R├⌐union','tf','Africa','French Southern Territories'),(90,'Libreville','ga','Africa','Gabon'),(91,'','es-ga','','Galicia'),(92,'Banjul','gm','Africa','Gambia'),(93,'Tbilisi','ge','Asia','Georgia'),(94,'Berlin','de','Europe','Germany'),(95,'Accra','gh','Africa','Ghana'),(96,'Gibraltar','gi','Europe','Gibraltar'),(97,'Athens','gr','Europe','Greece'),(98,'Nuuk','gl','North America','Greenland'),(99,'St. George\'s','gd','North America','Grenada'),(100,'Basse-Terre','gp','North America','Guadeloupe'),(101,'Hag├Ñt├▒a','gu','Oceania','Guam'),(102,'Guatemala City','gt','North America','Guatemala'),(103,'Saint Peter Port','gg','Europe','Guernsey'),(104,'Conakry','gn','Africa','Guinea'),(105,'Bissau','gw','Africa','Guinea-Bissau'),(106,'Georgetown','gy','South America','Guyana'),(107,'Port-au-Prince','ht','North America','Haiti'),(108,'','hm','','Heard Island and McDonald Islands'),(109,'Vatican City','va','Europe','Holy See'),(110,'Tegucigalpa','hn','North America','Honduras'),(111,'Hong Kong','hk','Asia','Hong Kong'),(112,'Budapest','hu','Europe','Hungary'),(113,'Reykjavik','is','Europe','Iceland'),(114,'New Delhi','in','Asia','India'),(115,'Jakarta','id','Asia','Indonesia'),(116,'Tehran','ir','Asia','Iran'),(117,'Baghdad','iq','Asia','Iraq'),(118,'Dublin','ie','Europe','Ireland'),(119,'Douglas','im','Europe','Isle of Man'),(120,'Jerusalem','il','Asia','Israel'),(121,'Rome','it','Europe','Italy'),(122,'Kingston','jm','North America','Jamaica'),(123,'Tokyo','jp','Asia','Japan'),(124,'Saint Helier','je','Europe','Jersey'),(125,'Amman','jo','Asia','Jordan'),(126,'Astana','kz','Asia','Kazakhstan'),(127,'Nairobi','ke','Africa','Kenya'),(128,'South Tarawa','ki','Oceania','Kiribati'),(129,'Pristina','xk','Europe','Kosovo'),(130,'Kuwait City','kw','Asia','Kuwait'),(131,'Bishkek','kg','Asia','Kyrgyzstan'),(132,'Vientiane','la','Asia','Laos'),(133,'Riga','lv','Europe','Latvia'),(134,'Beirut','lb','Asia','Lebanon'),(135,'Maseru','ls','Africa','Lesotho'),(136,'Monrovia','lr','Africa','Liberia'),(137,'Tripoli','ly','Africa','Libya'),(138,'Vaduz','li','Europe','Liechtenstein'),(139,'Vilnius','lt','Europe','Lithuania'),(140,'Luxembourg City','lu','Europe','Luxembourg'),(141,'Macau','mo','Asia','Macau'),(142,'Antananarivo','mg','Africa','Madagascar'),(143,'Lilongwe','mw','Africa','Malawi'),(144,'Kuala Lumpur','my','Asia','Malaysia'),(145,'Mal├⌐','mv','Asia','Maldives'),(146,'Bamako','ml','Africa','Mali'),(147,'Valletta','mt','Europe','Malta'),(148,'Majuro','mh','Oceania','Marshall Islands'),(149,'Fort-de-France','mq','North America','Martinique'),(150,'Nouakchott','mr','Africa','Mauritania'),(151,'Port Louis','mu','Africa','Mauritius'),(152,'Mamoudzou','yt','Africa','Mayotte'),(153,'Mexico City','mx','North America','Mexico'),(154,'Chi╚Öin─âu','md','Europe','Moldova'),(155,'Monaco','mc','Europe','Monaco'),(156,'Ulaanbaatar','mn','Asia','Mongolia'),(157,'Podgorica','me','Europe','Montenegro'),(158,'Little Bay, Brades, Plymouth','ms','North America','Montserrat'),(159,'Rabat','ma','Africa','Morocco'),(160,'Maputo','mz','Africa','Mozambique'),(161,'Naypyidaw','mm','Asia','Myanmar'),(162,'Windhoek','na','Africa','Namibia'),(163,'Yaren District','nr','Oceania','Nauru'),(164,'Kathmandu','np','Asia','Nepal'),(165,'Amsterdam','nl','Europe','Netherlands'),(166,'Noum├⌐a','nc','Oceania','New Caledonia'),(167,'Wellington','nz','Oceania','New Zealand'),(168,'Managua','ni','North America','Nicaragua'),(169,'Niamey','ne','Africa','Niger'),(170,'Abuja','ng','Africa','Nigeria'),(171,'Alofi','nu','Oceania','Niue'),(172,'Kingston','nf','Oceania','Norfolk Island'),(173,'Pyongyang','kp','Asia','North Korea'),(174,'Skopje','mk','Europe','North Macedonia'),(175,'Belfast','gb-nir','Europe','Northern Ireland'),(176,'Saipan','mp','Oceania','Northern Mariana Islands'),(177,'Oslo','no','Europe','Norway'),(178,'Muscat','om','Asia','Oman'),(179,'Islamabad','pk','Asia','Pakistan'),(180,'Ngerulmud','pw','Oceania','Palau'),(181,'Panama City','pa','North America','Panama'),(182,'Port Moresby','pg','Oceania','Papua New Guinea'),(183,'Asunci├│n','py','South America','Paraguay'),(184,'Lima','pe','South America','Peru'),(185,'Manila','ph','Asia','Philippines'),(186,'Adamstown','pn','Oceania','Pitcairn'),(187,'Warsaw','pl','Europe','Poland'),(188,'Lisbon','pt','Europe','Portugal'),(189,'San Juan','pr','North America','Puerto Rico'),(190,'Doha','qa','Asia','Qatar'),(191,'Brazzaville','cg','Africa','Republic of the Congo'),(192,'Bucharest','ro','Europe','Romania'),(193,'Moscow','ru','Europe','Russia'),(194,'Kigali','rw','Africa','Rwanda'),(195,'Saint-Denis','re','Africa','R├⌐union'),(196,'Gustavia','bl','North America','Saint Barth├⌐lemy'),(197,'Jamestown','sh','Africa','Saint Helena, Ascension and Tristan da Cunha'),(198,'Basseterre','kn','North America','Saint Kitts and Nevis'),(199,'Castries','lc','North America','Saint Lucia'),(200,'Marigot','mf','North America','Saint Martin'),(201,'Saint-Pierre','pm','North America','Saint Pierre and Miquelon'),(202,'Kingstown','vc','North America','Saint Vincent and the Grenadines'),(203,'Apia','ws','Oceania','Samoa'),(204,'San Marino','sm','Europe','San Marino'),(205,'S├úo Tom├⌐','st','Africa','Sao Tome and Principe'),(206,'Riyadh','sa','Asia','Saudi Arabia'),(207,'Edinburgh','gb-sct','Europe','Scotland'),(208,'Dakar','sn','Africa','Senegal'),(209,'Belgrade','rs','Europe','Serbia'),(210,'Victoria','sc','Africa','Seychelles'),(211,'Freetown','sl','Africa','Sierra Leone'),(212,'Singapore','sg','Asia','Singapore'),(213,'Philipsburg','sx','North America','Sint Maarten'),(214,'Bratislava','sk','Europe','Slovakia'),(215,'Ljubljana','si','Europe','Slovenia'),(216,'Honiara','sb','Oceania','Solomon Islands'),(217,'Mogadishu','so','Africa','Somalia'),(218,'Pretoria','za','Africa','South Africa'),(219,'King Edward Point','gs','Antarctica','South Georgia and the South Sandwich Islands'),(220,'Seoul','kr','Asia','South Korea'),(221,'Juba','ss','Africa','South Sudan'),(222,'Madrid','es','Europe','Spain'),(223,'Sri Jayawardenepura Kotte, Colombo','lk','Asia','Sri Lanka'),(224,'Ramallah','ps','Asia','State of Palestine'),(225,'Khartoum','sd','Africa','Sudan'),(226,'Paramaribo','sr','South America','Suriname'),(227,'Longyearbyen','sj','Europe','Svalbard and Jan Mayen'),(228,'Stockholm','se','Europe','Sweden'),(229,'Bern','ch','Europe','Switzerland'),(230,'Damascus','sy','Asia','Syria'),(231,'Taipei','tw','Asia','Taiwan'),(232,'Dushanbe','tj','Asia','Tajikistan'),(233,'Dodoma','tz','Africa','Tanzania'),(234,'Bangkok','th','Asia','Thailand'),(235,'Dili','tl','Asia','Timor-Leste'),(236,'Lom├⌐','tg','Africa','Togo'),(237,'Nukunonu, Atafu,Tokelau','tk','Oceania','Tokelau'),(238,'Nuku╩╗alofa','to','Oceania','Tonga'),(239,'Port of Spain','tt','South America','Trinidad and Tobago'),(240,'','ta','','Tristan da Cunha'),(241,'Tunis','tn','Africa','Tunisia'),(242,'Ankara','tr','Asia','Turkey'),(243,'Ashgabat','tm','Asia','Turkmenistan'),(244,'Cockburn Town','tc','North America','Turks and Caicos Islands'),(245,'Funafuti','tv','Oceania','Tuvalu'),(246,'Kampala','ug','Africa','Uganda'),(247,'Kiev','ua','Europe','Ukraine'),(248,'Abu Dhabi','ae','Asia','United Arab Emirates'),(249,'London','gb','Europe','United Kingdom'),(250,'','un','','United Nations'),(251,'Washington, D.C.','um','North America','United States Minor Outlying Islands'),(252,'Washington, D.C.','us','North America','United States of America'),(253,'','xx','','Unknown'),(254,'Montevideo','uy','South America','Uruguay'),(255,'Tashkent','uz','Asia','Uzbekistan'),(256,'Port Vila','vu','Oceania','Vanuatu'),(257,'Caracas','ve','South America','Venezuela'),(258,'Hanoi','vn','Asia','Vietnam'),(259,'Road Town','vg','North America','Virgin Islands (British)'),(260,'Charlotte Amalie','vi','North America','Virgin Islands (U.S.)'),(261,'Cardiff','gb-wls','Europe','Wales'),(262,'Mata-Utu','wf','Oceania','Wallis and Futuna'),(263,'Laayoune','eh','Africa','Western Sahara'),(264,'Sana\'a','ye','Asia','Yemen'),(265,'Lusaka','zm','Africa','Zambia'),(266,'Harare','zw','Africa','Zimbabwe');
/*!40000 ALTER TABLE `flags` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `flutterwave_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flutterwave_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `flutterwave_payment_id` varchar(191) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_error_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_error_response`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `flutterwave_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `flutterwave_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `flutterwave_payments` WRITE;
/*!40000 ALTER TABLE `flutterwave_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `flutterwave_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `front_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `front_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_setting_id` bigint(20) unsigned DEFAULT NULL,
  `header_title` varchar(200) DEFAULT NULL,
  `header_description` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `feature_with_image_heading` varchar(191) DEFAULT NULL,
  `review_heading` varchar(191) DEFAULT NULL,
  `feature_with_icon_heading` varchar(191) DEFAULT NULL,
  `comments_heading` varchar(191) DEFAULT NULL,
  `price_heading` varchar(191) DEFAULT NULL,
  `price_description` varchar(191) DEFAULT NULL,
  `faq_heading` varchar(191) DEFAULT NULL,
  `faq_description` text DEFAULT NULL,
  `contact_heading` text DEFAULT NULL,
  `footer_copyright_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `front_details_language_setting_id_foreign` (`language_setting_id`),
  CONSTRAINT `front_details_language_setting_id_foreign` FOREIGN KEY (`language_setting_id`) REFERENCES `language_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `front_details` WRITE;
/*!40000 ALTER TABLE `front_details` DISABLE KEYS */;
INSERT INTO `front_details` VALUES (1,1,'Restaurant POS software made simple!','Easily manage orders, menus, and tables in one place. Save time, reduce errors, and grow your business faster',NULL,'Take Control of Your Restaurant','What Restaurant Owners Are Saying','Powerful Features Built to Elevate Your Restaurant Operations',NULL,'Simple, Transparent Pricing','Get everything you need to manage your restaurant with one affordable plan.','Your questions, answered','Answers to the most frequently asked questions.','Contact','┬⌐ 2025 Hyamii. All Rights Reserved.','2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `front_details` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `front_faq_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `front_faq_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_setting_id` bigint(20) unsigned DEFAULT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `front_faq_settings_language_setting_id_foreign` (`language_setting_id`),
  CONSTRAINT `front_faq_settings_language_setting_id_foreign` FOREIGN KEY (`language_setting_id`) REFERENCES `language_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `front_faq_settings` WRITE;
/*!40000 ALTER TABLE `front_faq_settings` DISABLE KEYS */;
INSERT INTO `front_faq_settings` VALUES (1,1,'How can I contact customer support 1?','Our dedicated support team is available via email to assist you with any questions or technical issues.',NULL,NULL),(2,1,'How can I contact customer support?','Our dedicated support team is available via email to assist you with any questions or technical issues.',NULL,NULL),(3,1,'How can I contact customer support?','Our dedicated support team is available via email to assist you with any questions or technical issues.',NULL,NULL),(4,1,'How can I contact customer support?','Our dedicated support team is available via email to assist you with any questions or technical issues.',NULL,NULL),(5,1,'How can I contact customer support?','Our dedicated support team is available via email to assist you with any questions or technical issues.',NULL,NULL),(6,1,'How can I contact customer support?','Our dedicated support team is available via email to assist you with any questions or technical issues.',NULL,NULL);
/*!40000 ALTER TABLE `front_faq_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `front_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `front_features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_setting_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `icon` longtext DEFAULT NULL,
  `type` enum('image','icon','task','bills','team','apps') NOT NULL DEFAULT 'image',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `front_features_language_setting_id_foreign` (`language_setting_id`),
  CONSTRAINT `front_features_language_setting_id_foreign` FOREIGN KEY (`language_setting_id`) REFERENCES `language_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `front_features` WRITE;
/*!40000 ALTER TABLE `front_features` DISABLE KEYS */;
INSERT INTO `front_features` VALUES (1,1,'Streamline Order Management','Never lose track of an order again. All your customer ordersΓÇöfrom dine-in to takeoutΓÇöare organized and easily accessible in one place.\n                                Speed up service and keep your kitchen running smoothly.',NULL,NULL,'image',NULL,NULL),(2,1,'Optimize Table Reservations','Maximize seating efficiency with real-time table tracking and reservations. Reduce wait times and ensure no table sits empty during peak hours, improving customer experience and turnover.',NULL,NULL,'image',NULL,NULL),(3,1,'Effortless Menu Management','Easily add, edit, or remove items from your menu on the go. Highlight specials, update prices, and keep everything in sync across all platforms, so your staff and customers always see the latest offerings.',NULL,NULL,'image',NULL,NULL),(4,1,'QR Code Menu','Contactless Ordering Made Easy','<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\"\n                            class=\"bi bi-qr-code-scan text-skin-base dark:text-skin-base size-6\" viewBox=\"0 0 16 16\">\n                            <path\n                                d=\"M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z\" />\n                            <path d=\"M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z\" />\n                            <path d=\"M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z\" />\n                            <path\n                                d=\"M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z\" />\n                            <path d=\"M12 9h2V8h-2z\" />\n                        </svg>','bi-qr-code','icon',NULL,NULL),(5,1,'Payment Gateway Integration','Fast, Secure, and Flexible Payments using Stripe and Razorpay','<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\"\n                        class=\"bi bi-qr-code-scan text-skin-base dark:text-skin-base size-6\" viewBox=\"0 0 16 16\">\n                        <path\n                            d=\"M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.226 5.385c-.584 0-.937.164-.937.593 0 .468.607.674 1.36.93 1.228.415 2.844.963 2.851 2.993C11.5 11.868 9.924 13 7.63 13a7.7 7.7 0 0 1-3.009-.626V9.758c.926.506 2.095.88 3.01.88.617 0 1.058-.165 1.058-.671 0-.518-.658-.755-1.453-1.041C6.026 8.49 4.5 7.94 4.5 6.11 4.5 4.165 5.988 3 8.226 3a7.3 7.3 0 0 1 2.734.505v2.583c-.838-.45-1.896-.703-2.734-.703\" />\n                    </svg>','bi-credit-card','icon',NULL,NULL),(6,1,'Staff Management','Separate login for every staff role with different permissions.','<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\"\n                        class=\"bi bi-qr-code-scan text-skin-base dark:text-skin-base size-6\" viewBox=\"0 0 16 16\">\n                        <path\n                            d=\"M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4\" />\n                    </svg>','bi-people','icon',NULL,NULL),(7,1,'POS (Point of Sale)','Complete POS Integration','<svg class=\"size-6 transition duration-75 text-skin-base dark:text-skin-base\" fill=\"currentColor\"\n                        viewBox=\"0 -0.5 25 25\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">\n                        <g id=\"SVGRepo_bgCarrier\" stroke-width=\"0\"></g>\n                        <g id=\"SVGRepo_tracerCarrier\" stroke-linecap=\"round\" stroke-linejoin=\"round\"></g>\n                        <g id=\"SVGRepo_iconCarrier\">\n                            <path fill-rule=\"evenodd\"\n                                d=\"M16,6 L20,6 C21.1045695,6 22,6.8954305 22,8 L22,16 C22,17.1045695 21.1045695,18 20,18 L16,18 L16,19.9411765 C16,21.0658573 15.1177541,22 14,22 L4,22 C2.88224586,22 2,21.0658573 2,19.9411765 L2,4.05882353 C2,2.93414267 2.88224586,2 4,2 L14,2 C15.1177541,2 16,2.93414267 16,4.05882353 L16,6 Z M20,11 L16,11 L16,16 L20,16 L20,11 Z M14,19.9411765 L14,4.05882353 C14,4.01396021 13.9868154,4 14,4 L4,4 C4.01318464,4 4,4.01396021 4,4.05882353 L4,19.9411765 C4,19.9860398 4.01318464,20 4,20 L14,20 C13.9868154,20 14,19.9860398 14,19.9411765 Z M5,19 L5,17 L7,17 L7,19 L5,19 Z M8,19 L8,17 L10,17 L10,19 L8,19 Z M11,19 L11,17 L13,17 L13,19 L11,19 Z M5,16 L5,14 L7,14 L7,16 L5,16 Z M8,16 L8,14 L10,14 L10,16 L8,16 Z M11,16 L11,14 L13,14 L13,16 L11,16 Z M13,5 L13,13 L5,13 L5,5 L13,5 Z M7,7 L7,11 L11,11 L11,7 L7,7 Z M20,9 L20,8 L16,8 L16,9 L20,9 Z\">\n                            </path>\n                        </g>\n                    </svg>','bi-pos','icon',NULL,NULL),(8,1,'Custom Floor Plans','Design Your Restaurants Layout.','<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\"\n                        class=\"bi bi-qr-code-scan text-skin-base dark:text-skin-base size-6\" viewBox=\"0 0 16 16\">\n                        <path\n                            d=\"M8.235 1.559a.5.5 0 0 0-.47 0l-7.5 4a.5.5 0 0 0 0 .882L3.188 8 .264 9.559a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882L12.813 8l2.922-1.559a.5.5 0 0 0 0-.882zm3.515 7.008L14.438 10 8 13.433 1.562 10 4.25 8.567l3.515 1.874a.5.5 0 0 0 .47 0zM8 9.433 1.562 6 8 2.567 14.438 6z\" />\n                    </svg>','bi-grid-3x3-gap','icon',NULL,NULL),(9,1,'Kitchen Order Tickets (KOT)','Efficient Kitchen Workflow.','<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\"\n                        class=\"bi bi-qr-code-scan text-skin-base dark:text-skin-base size-6\" viewBox=\"0 0 16 16\">\n                        <path\n                            d=\"M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z\" />\n                        <path\n                            d=\"M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z\" />\n                    </svg>','bi-receipt','icon',NULL,NULL),(10,1,'Bill Printing','Quick and Accurate Billing.','<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\"\n                        class=\"bi bi-qr-code-scan text-skin-base dark:text-skin-base size-6\" viewBox=\"0 0 16 16\">\n                        <path d=\"M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1\" />\n                        <path\n                            d=\"M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1\" />\n                    </svg>','bi-printer','icon',NULL,NULL),(11,1,'Reports','Data-Driven Decisions.','<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-qr-code-scan text-skin-base dark:text-skin-base size-6\" viewBox=\"0 0 16 16\">\n                    <path fill-rule=\"evenodd\" d=\"M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5\"></path>\n                    </svg>','bi-arrow-right-circle-fill','icon',NULL,NULL);
/*!40000 ALTER TABLE `front_features` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `front_review_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `front_review_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_setting_id` bigint(20) unsigned DEFAULT NULL,
  `reviews` text DEFAULT NULL,
  `reviewer_name` varchar(191) DEFAULT NULL,
  `reviewer_designation` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `front_review_settings_language_setting_id_foreign` (`language_setting_id`),
  CONSTRAINT `front_review_settings_language_setting_id_foreign` FOREIGN KEY (`language_setting_id`) REFERENCES `language_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `front_review_settings` WRITE;
/*!40000 ALTER TABLE `front_review_settings` DISABLE KEYS */;
INSERT INTO `front_review_settings` VALUES (1,1,'\" It has completely transformed how we operate. Managing orders, tables, and staff all from one platform has reduced our workload and made everything run more smoothly. \"','John Martin','Owner of Riverbend Bistro',NULL,NULL),(2,1,'\" The QR Code menu and payment integration have made a huge difference for us, especially after the pandemic. Customers love the ease, and weΓÇÖve seen faster table turnover.\"','Emily Thompson','Manager at Lakeside Grill',NULL,NULL),(3,1,'\" We are able to track every order in real time, keep our menu updated, and quickly manage payments. It is like having an extra set of hands in the restaurant.\"','Michael Scott','Owner of Downtown Eats',NULL,NULL);
/*!40000 ALTER TABLE `front_review_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `global_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(191) NOT NULL,
  `currency_symbol` varchar(191) NOT NULL,
  `currency_code` varchar(191) NOT NULL,
  `exchange_rate` decimal(16,2) DEFAULT NULL,
  `usd_price` decimal(16,2) DEFAULT NULL,
  `is_cryptocurrency` enum('yes','no') NOT NULL DEFAULT 'no',
  `currency_position` enum('left','right','left_with_space','right_with_space') NOT NULL DEFAULT 'left',
  `no_of_decimal` int(10) unsigned NOT NULL DEFAULT 2,
  `thousand_separator` varchar(191) DEFAULT NULL,
  `decimal_separator` varchar(191) DEFAULT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `global_currencies` WRITE;
/*!40000 ALTER TABLE `global_currencies` DISABLE KEYS */;
INSERT INTO `global_currencies` VALUES (1,'Rwanda Franc','FRw','RWF',NULL,NULL,'no','left',0,',','.','enable','2026-05-23 15:17:41','2026-05-23 15:17:41',NULL),(2,'Dollars','$','USD',NULL,NULL,'no','left',2,',','.','enable','2026-05-23 15:17:41','2026-05-23 15:17:41',NULL),(3,'Euros','Γé¼','EUR',NULL,NULL,'no','left',2,',','.','enable','2026-05-23 15:17:41','2026-05-23 15:17:41',NULL),(4,'Pounds','┬ú','GBP',NULL,NULL,'no','left',2,',','.','enable','2026-05-23 15:17:41','2026-05-23 15:17:41',NULL);
/*!40000 ALTER TABLE `global_currencies` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `global_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `currency_id` bigint(20) unsigned DEFAULT NULL,
  `package_id` bigint(20) unsigned DEFAULT NULL,
  `global_subscription_id` bigint(20) unsigned DEFAULT NULL,
  `offline_method_id` bigint(20) unsigned DEFAULT NULL,
  `signature` varchar(191) DEFAULT NULL,
  `token` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `reference_id` varchar(191) DEFAULT NULL,
  `event_id` varchar(191) DEFAULT NULL,
  `package_type` varchar(191) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `billing_frequency` varchar(191) DEFAULT NULL,
  `billing_interval` varchar(191) DEFAULT NULL,
  `recurring` enum('yes','no') DEFAULT NULL,
  `plan_id` varchar(191) DEFAULT NULL,
  `subscription_id` varchar(191) DEFAULT NULL,
  `invoice_id` varchar(191) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `stripe_invoice_number` varchar(191) DEFAULT NULL,
  `pay_date` datetime DEFAULT NULL,
  `next_pay_date` datetime DEFAULT NULL,
  `gateway_name` varchar(191) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `m_payment_id` varchar(191) DEFAULT NULL,
  `pf_payment_id` varchar(191) DEFAULT NULL,
  `payfast_plan` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `global_invoices_restaurant_id_foreign` (`restaurant_id`),
  KEY `global_invoices_currency_id_foreign` (`currency_id`),
  KEY `global_invoices_package_id_foreign` (`package_id`),
  KEY `global_invoices_global_subscription_id_foreign` (`global_subscription_id`),
  KEY `global_invoices_offline_method_id_foreign` (`offline_method_id`),
  CONSTRAINT `global_invoices_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `global_currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `global_invoices_global_subscription_id_foreign` FOREIGN KEY (`global_subscription_id`) REFERENCES `global_subscriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `global_invoices_offline_method_id_foreign` FOREIGN KEY (`offline_method_id`) REFERENCES `offline_payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `global_invoices_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `global_invoices_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `global_invoices` WRITE;
/*!40000 ALTER TABLE `global_invoices` DISABLE KEYS */;
INSERT INTO `global_invoices` VALUES (1,1,1,5,1,NULL,NULL,NULL,'QXOIA726QJQ1RX8',NULL,NULL,'trial',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 17:17:55','2026-06-22 17:17:55','offline','active','2026-05-23 15:17:55','2026-05-23 15:17:55',NULL,NULL,NULL),(2,2,1,5,2,NULL,NULL,NULL,'BSPXIRX1SCJ9HP9',NULL,NULL,'trial',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 17:17:55','2026-06-22 17:17:55','offline','active','2026-05-23 15:17:55','2026-05-23 15:17:55',NULL,NULL,NULL),(3,3,1,5,3,NULL,NULL,NULL,'H6C8NPYK7CIHX9H',NULL,NULL,'trial',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 17:17:56','2026-06-22 17:17:56','offline','active','2026-05-23 15:17:56','2026-05-23 15:17:56',NULL,NULL,NULL);
/*!40000 ALTER TABLE `global_invoices` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `global_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_code` varchar(80) DEFAULT NULL,
  `supported_until` timestamp NULL DEFAULT NULL,
  `last_license_verified_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `privacy_policy_link` varchar(191) DEFAULT NULL,
  `show_privacy_consent_checkbox` tinyint(1) NOT NULL DEFAULT 0,
  `show_support_ticket` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `theme_hex` varchar(191) DEFAULT NULL,
  `theme_rgb` varchar(191) DEFAULT NULL,
  `locale` varchar(191) NOT NULL DEFAULT 'en',
  `license_type` varchar(191) DEFAULT NULL,
  `hide_cron_job` tinyint(1) NOT NULL DEFAULT 0,
  `last_cron_run` timestamp NULL DEFAULT NULL,
  `system_update` tinyint(1) NOT NULL DEFAULT 1,
  `purchased_on` timestamp NULL DEFAULT NULL,
  `timezone` varchar(191) DEFAULT 'Asia/Kolkata',
  `time_format` varchar(191) NOT NULL DEFAULT 'h:i A',
  `date_format` varchar(191) NOT NULL DEFAULT 'd/m/Y',
  `disable_landing_site` tinyint(1) NOT NULL DEFAULT 0,
  `landing_type` varchar(191) NOT NULL DEFAULT 'dynamic',
  `landing_site_type` enum('theme','custom') NOT NULL DEFAULT 'theme',
  `landing_site_url` varchar(191) DEFAULT NULL,
  `installed_url` tinytext DEFAULT NULL,
  `requires_approval_after_signup` tinyint(1) NOT NULL DEFAULT 0,
  `facebook_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `yelp_link` varchar(255) DEFAULT NULL,
  `google_business_link` varchar(255) DEFAULT NULL,
  `default_currency_id` bigint(20) unsigned DEFAULT NULL,
  `show_logo_text` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `upload_fav_icon_android_chrome_192` varchar(191) DEFAULT NULL,
  `upload_fav_icon_android_chrome_512` varchar(191) DEFAULT NULL,
  `upload_fav_icon_apple_touch_icon` varchar(191) DEFAULT NULL,
  `upload_favicon_16` varchar(191) DEFAULT NULL,
  `upload_favicon_32` varchar(191) DEFAULT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `hash` varchar(191) DEFAULT NULL,
  `webmanifest` varchar(191) DEFAULT NULL,
  `is_pwa_install_alert_show` varchar(191) NOT NULL DEFAULT '0',
  `google_map_api_key` varchar(191) DEFAULT NULL,
  `session_driver` enum('file','database') NOT NULL DEFAULT 'database',
  `enable_stripe` tinyint(1) NOT NULL DEFAULT 1,
  `enable_razorpay` tinyint(1) NOT NULL DEFAULT 1,
  `enable_flutterwave` tinyint(1) NOT NULL DEFAULT 1,
  `enable_payfast` tinyint(1) NOT NULL DEFAULT 1,
  `enable_paypal` tinyint(1) NOT NULL DEFAULT 1,
  `enable_paystack` tinyint(1) NOT NULL DEFAULT 1,
  `enable_xendit` tinyint(1) NOT NULL DEFAULT 1,
  `enable_paddle` tinyint(1) NOT NULL DEFAULT 1,
  `enable_epay` tinyint(1) NOT NULL DEFAULT 1,
  `vapid_public_key` varchar(191) DEFAULT NULL,
  `vapid_private_key` varchar(191) DEFAULT NULL,
  `vapid_subject` varchar(191) NOT NULL DEFAULT 'mailto:admin@example.com',
  `enable_mollie` tinyint(1) NOT NULL DEFAULT 1,
  `enable_tap` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `global_settings_default_currency_id_foreign` (`default_currency_id`),
  CONSTRAINT `global_settings_default_currency_id_foreign` FOREIGN KEY (`default_currency_id`) REFERENCES `global_currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `global_settings` WRITE;
/*!40000 ALTER TABLE `global_settings` DISABLE KEYS */;
INSERT INTO `global_settings` VALUES (1,NULL,NULL,NULL,NULL,NULL,0,1,'2026-05-23 15:17:54','2026-05-23 15:17:54','Hyamii',NULL,'#A78BFA','167, 139, 250','en',NULL,0,NULL,1,NULL,'Africa/Kigali','h:i A','d/m/Y',0,'dynamic','theme',NULL,'http://localhost:8080',0,'https://www.facebook.com/','https://www.instagram.com/','https://www.twitter.com/',NULL,'https://business.google.com/',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'db8cf83ffbdfe270d754f090e0ce6f06',NULL,'0',NULL,'database',1,1,1,1,1,1,1,1,1,NULL,NULL,'mailto:admin@example.com',1,1);
/*!40000 ALTER TABLE `global_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `global_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `package_id` bigint(20) unsigned DEFAULT NULL,
  `currency_id` bigint(20) unsigned DEFAULT NULL,
  `package_type` varchar(191) DEFAULT NULL,
  `plan_type` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `user_id` varchar(191) DEFAULT NULL,
  `quantity` varchar(191) DEFAULT NULL,
  `token` varchar(191) DEFAULT NULL,
  `razorpay_id` varchar(191) DEFAULT NULL,
  `razorpay_plan` varchar(191) DEFAULT NULL,
  `stripe_id` varchar(191) DEFAULT NULL,
  `stripe_status` varchar(191) DEFAULT NULL,
  `stripe_price` varchar(191) DEFAULT NULL,
  `gateway_name` varchar(191) DEFAULT NULL,
  `trial_ends_at` varchar(191) DEFAULT NULL,
  `subscription_status` enum('active','inactive') DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `subscribed_on_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subscription_id` varchar(191) DEFAULT NULL,
  `customer_id` varchar(191) DEFAULT NULL,
  `flutterwave_id` varchar(191) DEFAULT NULL,
  `flutterwave_payment_ref` varchar(191) DEFAULT NULL,
  `flutterwave_status` varchar(191) DEFAULT NULL,
  `flutterwave_customer_id` varchar(191) DEFAULT NULL,
  `payfast_plan` varchar(191) DEFAULT NULL,
  `payfast_status` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `global_subscriptions_restaurant_id_foreign` (`restaurant_id`),
  KEY `global_subscriptions_package_id_foreign` (`package_id`),
  KEY `global_subscriptions_currency_id_foreign` (`currency_id`),
  CONSTRAINT `global_subscriptions_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `global_currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `global_subscriptions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `global_subscriptions_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `global_subscriptions` WRITE;
/*!40000 ALTER TABLE `global_subscriptions` DISABLE KEYS */;
INSERT INTO `global_subscriptions` VALUES (1,1,5,1,'trial',NULL,'QXOIA726QJQ1RX8',NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,'offline','2026-06-22 17:17:55','active','2026-06-22 17:17:55','2026-05-23 17:17:55','2026-05-23 15:17:55','2026-05-23 15:17:55',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,2,5,1,'trial',NULL,'BSPXIRX1SCJ9HP9',NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,'offline','2026-06-22 17:17:55','active','2026-06-22 17:17:55','2026-05-23 17:17:55','2026-05-23 15:17:55','2026-05-23 15:17:55',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,3,5,1,'trial',NULL,'H6C8NPYK7CIHX9H',NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,'offline','2026-06-22 17:17:56','active','2026-06-22 17:17:56','2026-05-23 17:17:56','2026-05-23 15:17:56','2026-05-23 15:17:56',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `global_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `item_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `category_name` text DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_categories_branch_id_foreign` (`branch_id`),
  CONSTRAINT `item_categories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `item_categories` WRITE;
/*!40000 ALTER TABLE `item_categories` DISABLE KEYS */;
INSERT INTO `item_categories` VALUES (1,1,'{\"en\":\"Starters (Ibyokurya by\'Ubusa)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,'{\"en\":\"Main Course (Indyo Nyamukuru)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,'{\"en\":\"Grills & Brochettes (Ibyokurya bikaranze)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,'{\"en\":\"Sides (Inyamibwa)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,1,'{\"en\":\"Beverages (Ibinyobwa)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,1,'{\"en\":\"Snacks (Ibyokurya byoroheje)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,3,'{\"en\":\"Starters (Ibyokurya by\'Ubusa)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(8,3,'{\"en\":\"Main Course (Indyo Nyamukuru)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(9,3,'{\"en\":\"Grills & Brochettes (Ibyokurya bikaranze)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(10,3,'{\"en\":\"Sides (Inyamibwa)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(11,3,'{\"en\":\"Beverages (Ibinyobwa)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(12,3,'{\"en\":\"Snacks (Ibyokurya byoroheje)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(13,5,'{\"en\":\"Starters (Ibyokurya by\'Ubusa)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(14,5,'{\"en\":\"Main Course (Indyo Nyamukuru)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(15,5,'{\"en\":\"Grills & Brochettes (Ibyokurya bikaranze)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(16,5,'{\"en\":\"Sides (Inyamibwa)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(17,5,'{\"en\":\"Beverages (Ibinyobwa)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(18,5,'{\"en\":\"Snacks (Ibyokurya byoroheje)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `item_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `item_modifiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_modifiers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` bigint(20) unsigned DEFAULT NULL,
  `menu_item_variation_id` bigint(20) unsigned DEFAULT NULL,
  `modifier_group_id` bigint(20) unsigned DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `allow_multiple_selection` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_modifiers_menu_item_id_foreign` (`menu_item_id`),
  KEY `item_modifiers_modifier_group_id_foreign` (`modifier_group_id`),
  KEY `item_modifiers_menu_item_variation_id_foreign` (`menu_item_variation_id`),
  CONSTRAINT `item_modifiers_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_modifiers_menu_item_variation_id_foreign` FOREIGN KEY (`menu_item_variation_id`) REFERENCES `menu_item_variations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_modifiers_modifier_group_id_foreign` FOREIGN KEY (`modifier_group_id`) REFERENCES `modifier_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `item_modifiers` WRITE;
/*!40000 ALTER TABLE `item_modifiers` DISABLE KEYS */;
INSERT INTO `item_modifiers` VALUES (1,16,NULL,2,0,0,NULL,NULL),(2,17,NULL,1,0,0,NULL,NULL),(3,17,NULL,2,0,0,NULL,NULL),(4,33,NULL,4,0,0,NULL,NULL),(5,34,NULL,3,0,0,NULL,NULL),(6,34,NULL,4,0,0,NULL,NULL),(7,50,NULL,6,0,0,NULL,NULL),(8,51,NULL,5,0,0,NULL,NULL),(9,51,NULL,6,0,0,NULL,NULL);
/*!40000 ALTER TABLE `item_modifiers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `kot_cancel_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kot_cancel_reasons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `reason` varchar(191) NOT NULL,
  `cancel_order` tinyint(1) NOT NULL DEFAULT 0,
  `cancel_kot` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kot_cancel_reasons_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `kot_cancel_reasons_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `kot_cancel_reasons` WRITE;
/*!40000 ALTER TABLE `kot_cancel_reasons` DISABLE KEYS */;
INSERT INTO `kot_cancel_reasons` VALUES (1,1,'Customer changed their mind',1,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,'Customer requested to cancel',1,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,'Payment issues',1,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,'Customer no longer wants the order',1,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,1,'Ingredient not available',0,1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,1,'Preparation time too long',0,1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,1,'Quality issue with ingredients',0,1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(8,1,'System error/Technical issue',1,1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(9,1,'Restaurant closing early',1,1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(10,1,'Other',1,1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(11,2,'Customer changed their mind',1,0,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(12,2,'Customer requested to cancel',1,0,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(13,2,'Payment issues',1,0,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(14,2,'Customer no longer wants the order',1,0,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(15,2,'Ingredient not available',0,1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(16,2,'Preparation time too long',0,1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(17,2,'Quality issue with ingredients',0,1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(18,2,'System error/Technical issue',1,1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(19,2,'Restaurant closing early',1,1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(20,2,'Other',1,1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(21,3,'Customer changed their mind',1,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(22,3,'Customer requested to cancel',1,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(23,3,'Payment issues',1,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(24,3,'Customer no longer wants the order',1,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(25,3,'Ingredient not available',0,1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(26,3,'Preparation time too long',0,1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(27,3,'Quality issue with ingredients',0,1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(28,3,'System error/Technical issue',1,1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(29,3,'Restaurant closing early',1,1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(30,3,'Other',1,1,'2026-05-23 15:17:59','2026-05-23 15:17:59');
/*!40000 ALTER TABLE `kot_cancel_reasons` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `kot_item_modifier_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kot_item_modifier_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kot_item_id` bigint(20) unsigned NOT NULL,
  `modifier_option_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kot_item_modifier_options_kot_item_id_foreign` (`kot_item_id`),
  KEY `kot_item_modifier_options_modifier_option_id_foreign` (`modifier_option_id`),
  CONSTRAINT `kot_item_modifier_options_kot_item_id_foreign` FOREIGN KEY (`kot_item_id`) REFERENCES `kot_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kot_item_modifier_options_modifier_option_id_foreign` FOREIGN KEY (`modifier_option_id`) REFERENCES `modifier_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `kot_item_modifier_options` WRITE;
/*!40000 ALTER TABLE `kot_item_modifier_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `kot_item_modifier_options` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `kot_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kot_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kot_id` bigint(20) unsigned NOT NULL,
  `order_item_id` bigint(20) unsigned DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `menu_item_id` bigint(20) unsigned NOT NULL,
  `menu_item_variation_id` bigint(20) unsigned DEFAULT NULL,
  `note` text DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(16,2) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `is_free_item_from_stamp` tinyint(1) NOT NULL DEFAULT 0,
  `stamp_rule_id` bigint(20) unsigned DEFAULT NULL,
  `discount_amount` decimal(16,2) DEFAULT 0.00,
  `is_discounted` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('pending','cooking','ready','cancelled') DEFAULT NULL,
  `cancel_reason_id` bigint(20) unsigned DEFAULT NULL,
  `cancel_reason_text` text DEFAULT NULL,
  `cancelled_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kot_items_menu_item_variation_id_foreign` (`menu_item_variation_id`),
  KEY `kot_items_cancel_reason_id_foreign` (`cancel_reason_id`),
  KEY `idx_kot_items_kot_status` (`kot_id`,`status`),
  KEY `idx_kot_items_menu_variation_qty` (`menu_item_id`,`menu_item_variation_id`,`quantity`),
  KEY `idx_kot_items_order_item` (`order_item_id`),
  KEY `kot_items_cancelled_by_foreign` (`cancelled_by`),
  CONSTRAINT `kot_items_cancel_reason_id_foreign` FOREIGN KEY (`cancel_reason_id`) REFERENCES `kot_cancel_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kot_items_cancelled_by_foreign` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `kot_items_kot_id_foreign` FOREIGN KEY (`kot_id`) REFERENCES `kots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kot_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kot_items_menu_item_variation_id_foreign` FOREIGN KEY (`menu_item_variation_id`) REFERENCES `menu_item_variations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kot_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `kot_items` WRITE;
/*!40000 ALTER TABLE `kot_items` DISABLE KEYS */;
INSERT INTO `kot_items` VALUES (1,1,NULL,NULL,6,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,NULL,NULL,8,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,NULL,NULL,10,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,NULL,NULL,11,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,1,NULL,NULL,14,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,2,NULL,NULL,4,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,2,NULL,NULL,11,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(8,3,NULL,NULL,3,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(9,4,NULL,NULL,2,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(10,4,NULL,NULL,8,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(11,4,NULL,NULL,11,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(12,4,NULL,NULL,14,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(13,4,NULL,NULL,16,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(14,5,NULL,NULL,7,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(15,5,NULL,NULL,10,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(16,5,NULL,NULL,12,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(17,6,NULL,NULL,5,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(18,6,NULL,NULL,11,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(19,6,NULL,NULL,14,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(20,6,NULL,NULL,16,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(21,7,NULL,NULL,5,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(22,7,NULL,NULL,6,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(23,7,NULL,NULL,12,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(24,8,NULL,NULL,13,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(25,8,NULL,NULL,17,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(26,9,NULL,NULL,1,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(27,9,NULL,NULL,2,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(28,9,NULL,NULL,8,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(29,9,NULL,NULL,14,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(30,10,NULL,NULL,18,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(31,10,NULL,NULL,23,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(32,10,NULL,NULL,24,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(33,10,NULL,NULL,29,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(34,10,NULL,NULL,32,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(35,11,NULL,NULL,20,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(36,11,NULL,NULL,22,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(37,11,NULL,NULL,25,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(38,11,NULL,NULL,26,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(39,11,NULL,NULL,29,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(40,12,NULL,NULL,18,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(41,12,NULL,NULL,21,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(42,12,NULL,NULL,23,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(43,12,NULL,NULL,24,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(44,12,NULL,NULL,33,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(45,13,NULL,NULL,18,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(46,13,NULL,NULL,19,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(47,13,NULL,NULL,28,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(48,13,NULL,NULL,29,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(49,14,NULL,NULL,18,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(50,14,NULL,NULL,28,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(51,15,NULL,NULL,18,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(52,15,NULL,NULL,19,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(53,15,NULL,NULL,22,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(54,15,NULL,NULL,23,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(55,15,NULL,NULL,33,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(56,16,NULL,NULL,23,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(57,16,NULL,NULL,25,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(58,16,NULL,NULL,27,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(59,16,NULL,NULL,28,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(60,17,NULL,NULL,25,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(61,17,NULL,NULL,28,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(62,17,NULL,NULL,31,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(63,18,NULL,NULL,22,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(64,19,NULL,NULL,38,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(65,19,NULL,NULL,42,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(66,19,NULL,NULL,44,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(67,19,NULL,NULL,48,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(68,19,NULL,NULL,49,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(69,20,NULL,NULL,48,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(70,20,NULL,NULL,51,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(71,21,NULL,NULL,35,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(72,21,NULL,NULL,42,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(73,21,NULL,NULL,48,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(74,21,NULL,NULL,51,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(75,22,NULL,NULL,38,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(76,22,NULL,NULL,42,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(77,22,NULL,NULL,44,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(78,22,NULL,NULL,50,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(79,22,NULL,NULL,51,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(80,23,NULL,NULL,46,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(81,23,NULL,NULL,48,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(82,24,NULL,NULL,36,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(83,24,NULL,NULL,38,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(84,24,NULL,NULL,46,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(85,25,NULL,NULL,37,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(86,25,NULL,NULL,39,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(87,25,NULL,NULL,45,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(88,25,NULL,NULL,46,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(89,26,NULL,NULL,40,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(90,27,NULL,NULL,36,NULL,NULL,2,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(91,27,NULL,NULL,37,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(92,27,NULL,NULL,41,NULL,NULL,1,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(93,27,NULL,NULL,43,NULL,NULL,3,NULL,NULL,0,NULL,0.00,0,NULL,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `kot_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `kot_places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kot_places` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `printer_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kot_places_branch_id_foreign` (`branch_id`),
  KEY `kot_places_printer_id_foreign` (`printer_id`),
  CONSTRAINT `kot_places_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kot_places_printer_id_foreign` FOREIGN KEY (`printer_id`) REFERENCES `printers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `kot_places` WRITE;
/*!40000 ALTER TABLE `kot_places` DISABLE KEYS */;
INSERT INTO `kot_places` VALUES (1,1,1,'Default Kitchen','food',1,1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,2,2,'Default Kitchen','food',1,1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,3,3,'Default Kitchen','food',1,1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,4,4,'Default Kitchen','food',1,1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(5,5,5,'Default Kitchen','food',1,1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(6,6,6,'Default Kitchen','food',1,1,'2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `kot_places` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `kot_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kot_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `default_status_pos` enum('pending','cooking') DEFAULT 'pending',
  `default_status_customer` enum('pending','cooking') NOT NULL DEFAULT 'pending',
  `enable_item_level_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kot_settings_branch_id_foreign` (`branch_id`),
  CONSTRAINT `kot_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `kot_settings` WRITE;
/*!40000 ALTER TABLE `kot_settings` DISABLE KEYS */;
INSERT INTO `kot_settings` VALUES (1,1,'pending','pending',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,'pending','pending',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,2,'pending','pending',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,2,'pending','pending',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(5,3,'pending','pending',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(6,3,'pending','pending',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(7,4,'pending','pending',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(8,4,'pending','pending',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(9,5,'pending','pending',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(10,5,'pending','pending',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(11,6,'pending','pending',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(12,6,'pending','pending',1,'2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `kot_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `kots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kots` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `kot_number` varchar(191) NOT NULL,
  `token_number` int(10) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `order_type_id` bigint(20) unsigned DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` enum('pending_confirmation','in_kitchen','food_ready','served','cancelled') NOT NULL DEFAULT 'in_kitchen',
  `cancel_reason_id` bigint(20) unsigned DEFAULT NULL,
  `cancel_reason_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kots_cancel_reason_id_foreign` (`cancel_reason_id`),
  KEY `kots_order_type_id_foreign` (`order_type_id`),
  KEY `idx_kots_order_status` (`order_id`,`status`),
  KEY `idx_kots_branch` (`branch_id`),
  CONSTRAINT `kots_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kots_cancel_reason_id_foreign` FOREIGN KEY (`cancel_reason_id`) REFERENCES `kot_cancel_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kots_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kots_order_type_id_foreign` FOREIGN KEY (`order_type_id`) REFERENCES `order_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `kots` WRITE;
/*!40000 ALTER TABLE `kots` DISABLE KEYS */;
INSERT INTO `kots` VALUES (1,1,'1',NULL,1,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,'2',NULL,2,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,'3',NULL,3,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,'4',NULL,4,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,1,'5',NULL,5,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,1,'6',NULL,6,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,1,'7',NULL,7,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(8,1,'8',NULL,8,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(9,1,'9',NULL,9,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(10,3,'10',NULL,10,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(11,3,'11',NULL,11,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(12,3,'12',NULL,12,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(13,3,'13',NULL,13,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(14,3,'14',NULL,14,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(15,3,'15',NULL,15,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(16,3,'16',NULL,16,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(17,3,'17',NULL,17,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(18,3,'18',NULL,18,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(19,5,'19',NULL,19,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(20,5,'20',NULL,20,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(21,5,'21',NULL,21,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(22,5,'22',NULL,22,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(23,5,'23',NULL,23,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(24,5,'24',NULL,24,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(25,5,'25',NULL,25,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(26,5,'26',NULL,26,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(27,5,'27',NULL,27,NULL,NULL,NULL,'pending_confirmation',NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `kots` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `language_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_code` varchar(191) NOT NULL,
  `language_name` varchar(191) NOT NULL,
  `flag_code` varchar(191) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_rtl` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `language_settings` WRITE;
/*!40000 ALTER TABLE `language_settings` DISABLE KEYS */;
INSERT INTO `language_settings` VALUES (1,'en','English','gb',1,0,NULL,NULL),(2,'ar','Arabic','sa',0,1,NULL,NULL),(3,'de','German','de',0,0,NULL,NULL),(4,'es','Spanish','es',0,0,NULL,NULL),(5,'et','Estonian','et',0,0,NULL,NULL),(6,'fa','Farsi','ir',0,1,NULL,NULL),(7,'fr','French','fr',0,0,NULL,NULL),(8,'el','Greek','gr',0,0,NULL,NULL),(9,'it','Italian','it',0,0,NULL,NULL),(10,'nl','Dutch','nl',0,0,NULL,NULL),(11,'pl','Polish','pl',0,0,NULL,NULL),(12,'pt','Portuguese','pt',0,0,NULL,NULL),(13,'pt-br','Portuguese (Brazil)','br',0,0,NULL,NULL),(14,'ro','Romanian','ro',0,0,NULL,NULL),(15,'ru','Russian','ru',0,0,NULL,NULL),(16,'tr','Turkish','tr',0,0,NULL,NULL),(17,'zh-CN','Chinese (S)','cn',0,0,NULL,NULL),(18,'zh-TW','Chinese (T)','cn',0,0,NULL,NULL);
/*!40000 ALTER TABLE `language_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ltm_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ltm_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT 0,
  `locale` varchar(191) NOT NULL,
  `group` varchar(191) NOT NULL,
  `key` text NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ltm_translations` WRITE;
/*!40000 ALTER TABLE `ltm_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ltm_translations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menu_item_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_item_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` bigint(20) unsigned NOT NULL,
  `order_type_id` bigint(20) unsigned NOT NULL,
  `delivery_app_id` bigint(20) unsigned DEFAULT NULL,
  `menu_item_variation_id` bigint(20) unsigned DEFAULT NULL,
  `calculated_price` decimal(16,2) NOT NULL,
  `override_price` decimal(16,2) DEFAULT NULL,
  `final_price` decimal(16,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_item_prices_delivery_app_id_foreign` (`delivery_app_id`),
  KEY `menu_item_prices_menu_item_variation_id_foreign` (`menu_item_variation_id`),
  KEY `idx_prices_item_status_variation_type_app` (`menu_item_id`,`status`,`menu_item_variation_id`,`order_type_id`,`delivery_app_id`),
  KEY `idx_prices_item_status_type_app` (`menu_item_id`,`status`,`order_type_id`,`delivery_app_id`),
  KEY `idx_prices_type_app_status` (`order_type_id`,`delivery_app_id`,`status`),
  KEY `idx_prices_menu_item_id` (`menu_item_id`),
  CONSTRAINT `menu_item_prices_delivery_app_id_foreign` FOREIGN KEY (`delivery_app_id`) REFERENCES `delivery_platforms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_item_prices_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_item_prices_menu_item_variation_id_foreign` FOREIGN KEY (`menu_item_variation_id`) REFERENCES `menu_item_variations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_item_prices_order_type_id_foreign` FOREIGN KEY (`order_type_id`) REFERENCES `order_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menu_item_prices` WRITE;
/*!40000 ALTER TABLE `menu_item_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_item_prices` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menu_item_tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_item_tax` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` bigint(20) unsigned NOT NULL,
  `tax_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_item_tax_menu_item_id_foreign` (`menu_item_id`),
  KEY `menu_item_tax_tax_id_foreign` (`tax_id`),
  CONSTRAINT `menu_item_tax_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_item_tax_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menu_item_tax` WRITE;
/*!40000 ALTER TABLE `menu_item_tax` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_item_tax` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menu_item_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_item_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) NOT NULL,
  `item_name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_item_translations_menu_item_id_locale_unique` (`menu_item_id`,`locale`),
  KEY `menu_item_translations_locale_index` (`locale`),
  CONSTRAINT `menu_item_translations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menu_item_translations` WRITE;
/*!40000 ALTER TABLE `menu_item_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_item_translations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menu_item_variations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_item_variations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `variation` varchar(191) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `menu_item_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_item_variations_menu_item_id_foreign` (`menu_item_id`),
  CONSTRAINT `menu_item_variations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menu_item_variations` WRITE;
/*!40000 ALTER TABLE `menu_item_variations` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_item_variations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `kot_place_id` bigint(20) unsigned DEFAULT NULL,
  `item_name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` enum('veg','non-veg','egg','drink','other','halal') DEFAULT NULL,
  `price` decimal(16,2) DEFAULT NULL,
  `menu_id` bigint(20) unsigned NOT NULL,
  `item_category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `preparation_time` int(11) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `show_on_customer_site` tinyint(1) NOT NULL DEFAULT 1,
  `in_stock` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `tax_inclusive` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_branch_available` (`branch_id`,`is_available`),
  KEY `idx_menu_items_category` (`item_category_id`),
  KEY `idx_menu_items_menu` (`menu_id`),
  KEY `idx_menu_items_menu_category` (`menu_id`,`item_category_id`),
  CONSTRAINT `menu_items_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,1,'Ugali na Isombe','ugali-isombe.webp','Maize porridge served with cassava leaves cooked in groundnut sauce.','veg',2500.00,1,2,NULL,NULL,18,1,1,1,0,0),(2,1,1,'Ibihaza (Pumpkin in Peanut Sauce)','ibihaza.webp','Fresh pumpkin simmered in a rich peanut sauce with local spices.','veg',3000.00,1,2,NULL,NULL,17,1,1,1,0,0),(3,1,1,'Agatogo (Plantain Stew)','agatogo.webp','Green plantains cooked in a savory tomato and vegetable stew.','veg',2800.00,1,2,NULL,NULL,17,1,1,1,0,0),(4,1,1,'Ibijumba (Sweet Potatoes)','ibijumba.webp','Rwandan orange-fleshed sweet potatoes, boiled to perfection.','veg',1500.00,1,4,NULL,NULL,27,1,1,1,0,0),(5,1,1,'Kigali Special Brochettes (Mixed)','brochettes-mixed.webp','Skewered mix of beef, goat and chicken, grilled over charcoal with Rwandan spices.','non-veg',5000.00,1,3,NULL,NULL,17,1,1,1,0,0),(6,1,1,'Akabenz (Fried Pork)','akabenz.webp','Crispy fried pork belly marinated in garlic, ginger and local herbs.','non-veg',4500.00,2,2,NULL,NULL,29,1,1,1,0,0),(7,1,1,'Sambaza (Fried Small Fish)','sambaza.webp','Crispy lake Tanganyika sardines fried with chili and lemon.','non-veg',2000.00,2,1,NULL,NULL,25,1,1,1,0,0),(8,1,1,'Grilled Tilapia','grilled-tilapia.webp','Whole tilapia from Lake Kivu, grilled with herbs and served with piri-piri sauce.','non-veg',4000.00,2,3,NULL,NULL,14,1,1,1,0,0),(9,1,1,'Ugali (Maize Cake)','ugali.webp','Traditional stiff maize porridge, the staple of East Africa.','veg',1000.00,2,4,NULL,NULL,29,1,1,1,0,0),(10,1,1,'Ikinyiga (Rwandan Pumpkin Stew)','ikinyiga.webp','Traditional pumpkin stew cooked with beans and leafy greens.','veg',2500.00,2,2,NULL,NULL,22,1,1,1,0,0),(11,1,1,'Kawa y\'u Rwanda (Rwandan Coffee)','rwandan-coffee.webp','Single-origin Arabica from the hills of Rwanda, freshly brewed.','veg',1500.00,3,5,NULL,NULL,28,1,1,1,0,0),(12,1,1,'Ikivuguto (Fermented Milk)','ikivuguto.webp','Traditional Rwandan fermented yogurt-like drink.','veg',1200.00,3,5,NULL,NULL,16,1,1,1,0,0),(13,1,1,'Urwagwa (Banana Beer)','urwagwa.webp','Traditional banana beer, a beloved Rwandan brew.','veg',2000.00,3,5,NULL,NULL,22,1,1,1,0,0),(14,1,1,'Fanta Orange','fanta-orange.webp','Chilled Fanta Orange, a local favorite.','veg',1000.00,3,5,NULL,NULL,19,1,1,1,0,0),(15,1,1,'Mandazi (Fried Dough)','mandazi.webp','Lightly sweetened triangular fried dough, perfect with coffee.','veg',500.00,3,6,NULL,NULL,29,1,1,1,0,0),(16,1,1,'Sambusa (Beef Samosa)','sambusa.webp','Crispy triangle pastries filled with spiced minced beef.','non-veg',800.00,3,6,NULL,NULL,19,1,1,1,0,0),(17,1,1,'Mizuzu (Fried Plantains)','mizuzu.webp','Ripe plantains deep-fried to golden perfection.','veg',1000.00,3,6,NULL,NULL,29,1,1,1,0,0),(18,3,3,'Ugali na Isombe','ugali-isombe.webp','Maize porridge served with cassava leaves cooked in groundnut sauce.','veg',2500.00,4,8,NULL,NULL,29,1,1,1,0,0),(19,3,3,'Ibihaza (Pumpkin in Peanut Sauce)','ibihaza.webp','Fresh pumpkin simmered in a rich peanut sauce with local spices.','veg',3000.00,4,8,NULL,NULL,16,1,1,1,0,0),(20,3,3,'Agatogo (Plantain Stew)','agatogo.webp','Green plantains cooked in a savory tomato and vegetable stew.','veg',2800.00,4,8,NULL,NULL,17,1,1,1,0,0),(21,3,3,'Ibijumba (Sweet Potatoes)','ibijumba.webp','Rwandan orange-fleshed sweet potatoes, boiled to perfection.','veg',1500.00,4,10,NULL,NULL,14,1,1,1,0,0),(22,3,3,'Kigali Special Brochettes (Mixed)','brochettes-mixed.webp','Skewered mix of beef, goat and chicken, grilled over charcoal with Rwandan spices.','non-veg',5000.00,4,9,NULL,NULL,16,1,1,1,0,0),(23,3,3,'Akabenz (Fried Pork)','akabenz.webp','Crispy fried pork belly marinated in garlic, ginger and local herbs.','non-veg',4500.00,5,8,NULL,NULL,24,1,1,1,0,0),(24,3,3,'Sambaza (Fried Small Fish)','sambaza.webp','Crispy lake Tanganyika sardines fried with chili and lemon.','non-veg',2000.00,5,7,NULL,NULL,15,1,1,1,0,0),(25,3,3,'Grilled Tilapia','grilled-tilapia.webp','Whole tilapia from Lake Kivu, grilled with herbs and served with piri-piri sauce.','non-veg',4000.00,5,9,NULL,NULL,15,1,1,1,0,0),(26,3,3,'Ugali (Maize Cake)','ugali.webp','Traditional stiff maize porridge, the staple of East Africa.','veg',1000.00,5,10,NULL,NULL,28,1,1,1,0,0),(27,3,3,'Ikinyiga (Rwandan Pumpkin Stew)','ikinyiga.webp','Traditional pumpkin stew cooked with beans and leafy greens.','veg',2500.00,5,8,NULL,NULL,26,1,1,1,0,0),(28,3,3,'Kawa y\'u Rwanda (Rwandan Coffee)','rwandan-coffee.webp','Single-origin Arabica from the hills of Rwanda, freshly brewed.','veg',1500.00,6,11,NULL,NULL,20,1,1,1,0,0),(29,3,3,'Ikivuguto (Fermented Milk)','ikivuguto.webp','Traditional Rwandan fermented yogurt-like drink.','veg',1200.00,6,11,NULL,NULL,27,1,1,1,0,0),(30,3,3,'Urwagwa (Banana Beer)','urwagwa.webp','Traditional banana beer, a beloved Rwandan brew.','veg',2000.00,6,11,NULL,NULL,14,1,1,1,0,0),(31,3,3,'Fanta Orange','fanta-orange.webp','Chilled Fanta Orange, a local favorite.','veg',1000.00,6,11,NULL,NULL,11,1,1,1,0,0),(32,3,3,'Mandazi (Fried Dough)','mandazi.webp','Lightly sweetened triangular fried dough, perfect with coffee.','veg',500.00,6,12,NULL,NULL,11,1,1,1,0,0),(33,3,3,'Sambusa (Beef Samosa)','sambusa.webp','Crispy triangle pastries filled with spiced minced beef.','non-veg',800.00,6,12,NULL,NULL,24,1,1,1,0,0),(34,3,3,'Mizuzu (Fried Plantains)','mizuzu.webp','Ripe plantains deep-fried to golden perfection.','veg',1000.00,6,12,NULL,NULL,12,1,1,1,0,0),(35,5,5,'Ugali na Isombe','ugali-isombe.webp','Maize porridge served with cassava leaves cooked in groundnut sauce.','veg',2500.00,7,14,NULL,NULL,11,1,1,1,0,0),(36,5,5,'Ibihaza (Pumpkin in Peanut Sauce)','ibihaza.webp','Fresh pumpkin simmered in a rich peanut sauce with local spices.','veg',3000.00,7,14,NULL,NULL,21,1,1,1,0,0),(37,5,5,'Agatogo (Plantain Stew)','agatogo.webp','Green plantains cooked in a savory tomato and vegetable stew.','veg',2800.00,7,14,NULL,NULL,10,1,1,1,0,0),(38,5,5,'Ibijumba (Sweet Potatoes)','ibijumba.webp','Rwandan orange-fleshed sweet potatoes, boiled to perfection.','veg',1500.00,7,16,NULL,NULL,12,1,1,1,0,0),(39,5,5,'Kigali Special Brochettes (Mixed)','brochettes-mixed.webp','Skewered mix of beef, goat and chicken, grilled over charcoal with Rwandan spices.','non-veg',5000.00,7,15,NULL,NULL,22,1,1,1,0,0),(40,5,5,'Akabenz (Fried Pork)','akabenz.webp','Crispy fried pork belly marinated in garlic, ginger and local herbs.','non-veg',4500.00,8,14,NULL,NULL,11,1,1,1,0,0),(41,5,5,'Sambaza (Fried Small Fish)','sambaza.webp','Crispy lake Tanganyika sardines fried with chili and lemon.','non-veg',2000.00,8,13,NULL,NULL,12,1,1,1,0,0),(42,5,5,'Grilled Tilapia','grilled-tilapia.webp','Whole tilapia from Lake Kivu, grilled with herbs and served with piri-piri sauce.','non-veg',4000.00,8,15,NULL,NULL,25,1,1,1,0,0),(43,5,5,'Ugali (Maize Cake)','ugali.webp','Traditional stiff maize porridge, the staple of East Africa.','veg',1000.00,8,16,NULL,NULL,25,1,1,1,0,0),(44,5,5,'Ikinyiga (Rwandan Pumpkin Stew)','ikinyiga.webp','Traditional pumpkin stew cooked with beans and leafy greens.','veg',2500.00,8,14,NULL,NULL,13,1,1,1,0,0),(45,5,5,'Kawa y\'u Rwanda (Rwandan Coffee)','rwandan-coffee.webp','Single-origin Arabica from the hills of Rwanda, freshly brewed.','veg',1500.00,9,17,NULL,NULL,24,1,1,1,0,0),(46,5,5,'Ikivuguto (Fermented Milk)','ikivuguto.webp','Traditional Rwandan fermented yogurt-like drink.','veg',1200.00,9,17,NULL,NULL,20,1,1,1,0,0),(47,5,5,'Urwagwa (Banana Beer)','urwagwa.webp','Traditional banana beer, a beloved Rwandan brew.','veg',2000.00,9,17,NULL,NULL,15,1,1,1,0,0),(48,5,5,'Fanta Orange','fanta-orange.webp','Chilled Fanta Orange, a local favorite.','veg',1000.00,9,17,NULL,NULL,27,1,1,1,0,0),(49,5,5,'Mandazi (Fried Dough)','mandazi.webp','Lightly sweetened triangular fried dough, perfect with coffee.','veg',500.00,9,18,NULL,NULL,24,1,1,1,0,0),(50,5,5,'Sambusa (Beef Samosa)','sambusa.webp','Crispy triangle pastries filled with spiced minced beef.','non-veg',800.00,9,18,NULL,NULL,28,1,1,1,0,0),(51,5,5,'Mizuzu (Fried Plantains)','mizuzu.webp','Ripe plantains deep-fried to golden perfection.','veg',1000.00,9,18,NULL,NULL,20,1,1,1,0,0);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menu_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_table` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `table_id` bigint(20) unsigned NOT NULL,
  `menu_id` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_table_table_id_menu_id_unique` (`table_id`,`menu_id`),
  KEY `menu_table_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_table_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_table_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menu_table` WRITE;
/*!40000 ALTER TABLE `menu_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_table` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `menu_name` text DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_branch_id_foreign` (`branch_id`),
  CONSTRAINT `menus_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,1,'{\"en\":\"Amakuru y\'Igihugu (Flavors of the Land)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,'{\"en\":\"Indumburwa z\'Abanyarwanda (Rwandan Specialties)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,'{\"en\":\"Ibinyobwa n\'Indyo (Drinks & Snacks)\"}',0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,3,'{\"en\":\"Amakuru y\'Igihugu (Flavors of the Land)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(5,3,'{\"en\":\"Indumburwa z\'Abanyarwanda (Rwandan Specialties)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(6,3,'{\"en\":\"Ibinyobwa n\'Indyo (Drinks & Snacks)\"}',0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(7,5,'{\"en\":\"Amakuru y\'Igihugu (Flavors of the Land)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(8,5,'{\"en\":\"Indumburwa z\'Abanyarwanda (Rwandan Specialties)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(9,5,'{\"en\":\"Ibinyobwa n\'Indyo (Drinks & Snacks)\"}',0,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2014_04_02_193005_create_translations_table',1),(5,'2024_01_01_create_printers_table',1),(6,'2024_03_13_000002_create_expense_categories_table',1),(7,'2024_07_01_060651_add_two_factor_columns_to_users_table',1),(8,'2024_07_01_060707_create_personal_access_tokens_table',1),(9,'2024_07_02_064204_create_menus_table',1),(10,'2024_07_12_070634_create_areas_table',1),(11,'2024_07_16_103816_create_orders_table',1),(12,'2024_07_21_083459_add_user_type_column',1),(13,'2024_07_24_131631_create_payments_table',1),(14,'2024_07_31_081306_add_email_otp_column',1),(15,'2024_08_02_061808_create_countries_table',1),(16,'2024_08_02_071637_create_restaurant_settings_table',1),(17,'2024_08_04_104258_create_razorpay_payments_table',1),(18,'2024_08_05_092258_create_stripe_payments_table',1),(19,'2024_08_05_110157_create_payment_gateway_credentials_table',1),(20,'2024_08_13_033139_create_global_settings_table',1),(21,'2024_08_13_073129_update_settings_add_envato_key',1),(22,'2024_08_13_073129_update_settings_add_support_key',1),(23,'2024_08_14_073129_update_settings_add_email',1),(24,'2024_08_14_073129_update_settings_add_last_verified_key',1),(25,'2024_09_13_081726_create_modules_table',1),(26,'2024_09_14_130619_create_permission_tables',1),(27,'2024_09_27_071339_create_reservations_table',1),(28,'2024_10_02_090924_create_email_settings_table',1),(29,'2024_10_03_073837_create_notification_settings_table',1),(30,'2024_10_11_100539_create_branches_table',1),(31,'2024_10_14_121135_create_onboarding_steps_table',1),(32,'2024_10_15_071238_add_restaurant_hash_column',1),(33,'2024_10_15_071238_storage',1),(34,'2024_10_15_100639_create_restaurant_payments_table',1),(35,'2024_10_27_101326_create_packages_table',1),(36,'2024_11_02_112920_create_language_settings_table',1),(37,'2024_11_02_120314_create_flags_table',1),(38,'2024_11_02_120314_email_settings_table',1),(39,'2024_11_08_071617_add_customer_login_required_column',1),(40,'2024_11_08_093032_create_superadmin_payment_gateways_table',1),(41,'2024_11_08_133506_add_stripe_column_for_license',1),(42,'2024_11_12_055119_create_delivery_executives_table',1),(43,'2024_11_12_055632_add_order_types_column',1),(44,'2024_11_12_060500_create_order_histories_table',1),(45,'2024_11_12_060500_global_license_type_table',1),(46,'2024_11_12_060500_global_purchase_on_table',1),(47,'2024_11_12_060500_global_setting_timezone_table',1),(48,'2024_11_17_052707_currency_position',1),(49,'2024_11_17_052707_move_qr_code',1),(50,'2024_11_19_113852_add_is_active_to_restaurants_table',1),(51,'2024_11_20_114816_add_staff_welcome_email_notification',1),(52,'2024_11_25_061322_create_pusher_settings_table',1),(53,'2024_11_26_090216_create_global_currencies_table',1),(54,'2024_12_03_085842_add_about_us_column',1),(55,'2024_12_03_104817_add_currency_id_packages',1),(56,'2024_12_04_080223_add_allow_customer_delivery_orders',1),(57,'2024_12_04_115601_add_preparation_time_column',1),(58,'2024_12_11_110000_create_tables_for_subscription_table',1),(59,'2024_12_11_131225_add_disable_landing_site_columns',1),(60,'2024_12_12_090840_create_waiter_requests_table',1),(61,'2024_12_13_090840_add_domain_global_setting',1),(62,'2024_12_16_080201_create_lifetime_subscriptions_for_paid_restaurants',1),(63,'2024_12_23_124452_add_payment_enabled_columns_to_payment_settings_table',1),(64,'2024_12_27_054246_add_table_reservation_default_status_to_restaurants_table',1),(65,'2024_12_30_074018_create_split_orders_table',1),(66,'2024_12_30_200942_create_restaurant_settings_table',1),(67,'2025_01_03_050139_add_social_media_links_to_reataurants_table',1),(68,'2025_01_03_093938_add_social_media_links_to_global_settings_table',1),(69,'2025_01_06_111550_create_receipt_settings_table',1),(70,'2025_01_09_073145_generate_qr_codes_for_existing_branches',1),(71,'2025_01_09_115652_update_receipt_settings_for_existing_restaurants',1),(72,'2025_01_10_064103_add_table_required_column_to_customer_settings_table',1),(73,'2025_01_10_100552_insert_to_file_storage_settings_default_values',1),(74,'2025_01_11_063817_add_default_currency_column',1),(75,'2025_01_14_099999_create_whatsapp_global_settings_table',1),(76,'2025_01_15_000000_create_cart_header_settings_table',1),(77,'2025_01_15_000000_create_whatsapp_module_entry',1),(78,'2025_01_15_000001_create_cart_header_images_table',1),(79,'2025_01_15_000001_create_whatsapp_settings_table',1),(80,'2025_01_15_000002_create_whatsapp_template_mappings_table',1),(81,'2025_01_15_000003_create_whatsapp_template_definitions_table',1),(82,'2025_01_15_000004_create_whatsapp_notification_logs_table',1),(83,'2025_01_15_000005_rename_business_phone_number_to_verify_token_in_whatsapp_settings_table',1),(84,'2025_01_15_000006_create_whatsapp_notification_preferences_table',1),(85,'2025_01_15_000007_create_whatsapp_automated_schedules_table',1),(86,'2025_01_15_000008_create_whatsapp_report_schedules_table',1),(87,'2025_01_16_000000_add_is_header_disabled_to_cart_header_settings_table',1),(88,'2025_01_16_125322_add_is_enabled_to_menu_items_table',1),(89,'2025_01_16_131100_regenrate_qr_codes',1),(90,'2025_01_20_000000_add_restaurant_id_to_roles',1),(91,'2025_01_20_071544_add_branch_limit_to_packages_table',1),(92,'2025_01_20_091630_update_item_type',1),(93,'2025_01_20_125429_add_discount_columns_to_orders_table',1),(94,'2025_01_21_064139_add_show_logo_text_column',1),(95,'2025_01_21_064256_add_offline_payment',1),(96,'2025_01_21_132218_fix_user_roles',1),(97,'2025_01_22_114720_add_show_tax_to_receipt_setting',1),(98,'2025_01_23_065746_create_modifier_groups_table',1),(99,'2025_01_23_085333_create_restaurant_taxes_table',1),(100,'2025_01_23_090554_create_modifier_options_table',1),(101,'2025_01_23_094318_create_item_modifiers_table',1),(102,'2025_01_23_121154_create_order_item_modifier_options_table',1),(103,'2025_01_27_065822_add_balance_column_to_payment',1),(104,'2025_01_28_111039_add_allow_dine_in_orders_to_restaurant',1),(105,'2025_01_30_050755_add_yelp_icon_to_global_settings',1),(106,'2025_01_30_055744_add_yelp_link_to_restaurants',1),(107,'2025_01_30_100556_fix_package_price_length',1),(108,'2025_01_30_104043_add_meta_data_to_global_settings',1),(109,'2025_01_31_000001_create_predefined_amounts_table',1),(110,'2025_02_03_062109_add_is_cash_payment_enabled_to_payment',1),(111,'2025_02_04_140538_add_transaction_id_kot',1),(112,'2025_02_15_121956_add_hide_new_orders_option_to_restaurant',1),(113,'2025_02_17_052801_create_restaurant_charges_settings_table',1),(114,'2025_02_17_093729_add_favicon_to_restaurant',1),(115,'2025_02_19_091730_update_menu_name_to_json',1),(116,'2025_02_20_095321_add_waiter_request_options_to_restaurant',1),(117,'2025_02_21_051534_add_hash_to_global_settings_table',1),(118,'2025_02_21_102116_add_column_to_settings',1),(119,'2025_02_24_063827_add_payment_qr_to_receipt_settings',1),(120,'2025_02_24_111946_add_permissions_to_customers',1),(121,'2025_03_04_114535_add_is_enabled_to_restaurant_charges',1),(122,'2025_03_10_055100_add_tip_column_to_orders_table',1),(123,'2025_03_10_100727_add_is_pwa_intall_alert_show_column_in_restaurants_table',1),(124,'2025_03_17_090450_add_meta_title_to_global_settings',1),(125,'2025_03_18_044410_create_expenses_table',1),(126,'2025_03_19_092459_create_custom_menus_table',1),(127,'2025_03_19_103047_update_additional_modules',1),(128,'2025_03_24_084350_add_show_payments_column_to_receipt_settings_table',1),(129,'2025_04_01_050059_add_branch_id_to_expense_category',1),(130,'2025_04_01_051356_add_branch_id_to_expenses',1),(131,'2025_04_02_071911_update_kot_status_enum',1),(132,'2025_04_07_112351_add_payment_recived_status_to_orders_table',1),(133,'2025_04_08_063624_update_meta_keywords',1),(134,'2025_04_10_065753_add_flutterwave_payment_gateway_columns_and_tables',1),(135,'2025_04_15_084543_create_front_details_table',1),(136,'2025_04_22_065157_create_front_reviews_setting_table',1),(137,'2025_04_22_091055_create_branch_delivery_settings_table',1),(138,'2025_04_22_091146_create_customer_addresses_table',1),(139,'2025_04_22_091223_create_delivery_fee_tiers_table',1),(140,'2025_04_22_091258_add_delivery_columns_to_orders_table',1),(141,'2025_04_29_102014_add_landing_type_column_in_global_settings_table',1),(142,'2025_04_29_114538_add_front_data_in_front_details_table',1),(143,'2025_05_14_094039_update_printers_settings_columns_to_printers_table',1),(144,'2025_05_15_071027_create_kot_places_table',1),(145,'2025_05_23_124746_add_in_stock_column',1),(146,'2025_05_26_105151_relocate_map_api_key_to_superadmin_settings',1),(147,'2025_05_26_114443_modify_kot_places_table',1),(148,'2025_05_30_081624_add_show_item_on_customer_site_to_menu_items',1),(149,'2025_06_02_081928_add_session_driver_column_to_global_settings',1),(150,'2025_06_02_112147_add_columns_to_superadmin_payment_gateways_table',1),(151,'2025_06_02_112903_add_paypal_payment_column_to_payment_gateway_credentials',1),(152,'2025_06_02_113108_create_paypal_payments_table',1),(153,'2025_06_02_114326_add_paypal_payment_in_payment_method_to_payments',1),(154,'2025_06_03_095923_add_status_column_kot_item',1),(155,'2025_06_04_065130_add_columns_payfast_in_superadmin_payment_gateways_table',1),(156,'2025_06_05_063256_add_sort_order_columns_in_menu_and_items',1),(157,'2025_06_05_112055_create_kot_settings_table',1),(158,'2025_06_06_050159_add_payfast_payment_column_to_payment_gateway_credentials',1),(159,'2025_06_06_051204_create_payfast_payments_table',1),(160,'2025_06_10_093131_change_delete_cascade_for_orders',1),(161,'2025_06_11_061716_add_uuid_to_orders_table',1),(162,'2025_06_11_062354_add_columns_paystack_in_superadmin_payment_gateways_table',1),(163,'2025_06_13_112612_add_phone_to_users',1),(164,'2025_06_13_113200_add_column_paystack_payments_to_payment_gateway_credentials',1),(165,'2025_06_13_113240_create_paystack_payments_table',1),(166,'2025_06_16_104533_add_note_columns_to_kot_items_and_order_items',1),(167,'2025_06_18_112425_add_payment_gateways_to_restaurants_table',1),(168,'2025_06_19_070518_add_position_to_custom_menus_table',1),(169,'2025_06_20_060452_add_columns_to_branch_table',1),(170,'2025_06_20_092521_add_others_type_to_payments_table',1),(171,'2025_06_23_101041_create_kot_cancel_reasons_table',1),(172,'2025_06_23_120021_update_kot_place_id_in_menu_items',1),(173,'2025_06_24_092521_disable_printer',1),(174,'2025_06_24_092811_add_column_cancel_kot_reason_to_kots_table',1),(175,'2025_06_24_102830_update_enum_status_to_kots_table',1),(176,'2025_06_25_094311_add_column_cancellation_reason_to_orders_table',1),(177,'2025_06_26_060831_add_custom_delivery_options_to_restaurants_table',1),(178,'2025_06_27_084541_insert_sample_kot_cancel_reasons_data',1),(179,'2025_07_01_112529_create_print_jobs_table',1),(180,'2025_07_01_133114_add_placed_via_column_orders_table',1),(181,'2025_07_02_090709_create_order_types_table',1),(182,'2025_07_02_105440_add_translations_columns_for_modifier_group',1),(183,'2025_07_02_114040_add_unique_hash_to_branches_table',1),(184,'2025_07_03_123829_update_kot_place_id_for_cloned_menu_items',1),(185,'2025_07_04_064350_update_order_type_id_in_orders',1),(186,'2025_07_04_081809_add_tax_mode_to_restaurants_table',1),(187,'2025_07_04_131541_create_desktop_applications_table',1),(188,'2025_07_07_070122_add_pusher_broadcast_to_pusher_settings_table',1),(189,'2025_07_07_110131_create_menu_item_taxes_table',1),(190,'2025_07_14_082950_add_columns_to_restaurants_table',1),(191,'2025_07_14_124125_add_pick_up_date_range_in_restaurants_table',1),(192,'2025_07_17_122331_create_order_number_settings',1),(193,'2025_07_29_063129_modify_item_type_in-menus',1),(194,'2025_07_29_082605_add_show_halal_and_veg_option_to_restaurants',1),(195,'2025_07_30_125616_add_tax_mode_to_orders',1),(196,'2025_08_01_114055_add_reservation_column_to_restaurants_table',1),(197,'2025_08_04_131541_create_desktop_applications_update_table',1),(198,'2025_08_05_081541_modify_split_orders_table_add_bank_transfer',1),(199,'2025_08_06_065323_change_payment_method_to_string_in_payments_table',1),(200,'2025_08_07_033322_add_column_disable_slot_minutes_to_restaurants_table',1),(201,'2025_08_08_115502_add_variation_id_to_item_modifiers',1),(202,'2025_08_12_133228_change_package_description_length',1),(203,'2025_08_13_060315_rename_payfast_columns_in_superadmin_payment_gateways_table',1),(204,'2025_08_13_110934_add_default_expense_categories_to_existing_branches',1),(205,'2025_08_16_110310_add_slot_time_difference_to_reservations',1),(206,'2025_08_19_071639_fix_tax_percent_to_unlimited_decimal',1),(207,'2025_08_19_131541_create_desktop_applications_mac_update_table',1),(208,'2025_08_20_000001_add_quantity_to_split_order_items',1),(209,'2025_08_21_100452_add_html_content_print_job',1),(210,'2025_08_25_050939_add_hide_menu_item_image_columns_to_restaurants_table',1),(211,'2025_08_25_060934_add_xendit_payment_gateway_to_payment_gateway_credentials_table',1),(212,'2025_08_25_061405_add_xendit_to_global_settings_table',1),(213,'2025_08_25_061500_create_xendit_payments_table',1),(214,'2025_08_25_062000_add_xendit_webhook_verification_tokens',1),(215,'2025_08_29_091315_add_phone_code_to_customers_table',1),(216,'2025_09_02_085025_add_xendit_payment_column_to_superadmin_payment_gateways_table',1),(217,'2025_09_02_113846_add_xendit_payments_column_to_packages_table',1),(218,'2025_09_02_130000_create_otps_table',1),(219,'2025_09_11_094443_remove_phone_unique',1),(220,'2025_09_15_100452_remove_extra_content_print_job',1),(221,'2025_09_17_094034_create_cart_session_tables',1),(222,'2025_09_18_051324_add_limit_columns_to_packages_table',1),(223,'2025_09_18_083624_add_table_lock_columns_and_settings',1),(224,'2025_09_23_062535_add_cancel_functionality_to_kot_items_table',1),(225,'2025_09_25_063220_add_xendit_webhook_token_to_superadmin_payment_gateways',1),(226,'2025_09_26_115847_add_token_number_to_orders_table',1),(227,'2025_09_26_115854_add_enable_token_number_to_order_types_table',1),(228,'2025_09_29_095519_create_delivery_platforms_table',1),(229,'2025_10_01_064424_create_menu_item_prices_table',1),(230,'2025_10_07_070000_add_reference_id_to_payment_tables',1),(231,'2025_10_07_094006_add_token_number_to_kots_table',1),(232,'2025_10_07_094018_remove_token_number_from_orders_table',1),(233,'2025_10_08_095954_add_columns_paddle_payment_keys_to_superadmin_payment_gateways',1),(234,'2025_10_08_102000_add_paddle_client_token_columns_to_superadmin_payment_gateways',1),(235,'2025_10_09_041734_add_enable_paddle_to_global_settings_table',1),(236,'2025_10_09_065853_remove_payload_from_print_jobs',1),(237,'2025_10_09_084200_add_package_id_to_restaurant_payments_table',1),(238,'2025_10_09_091500_add_paddle_price_ids_to_packages_table',1),(239,'2025_10_10_100000_add_paddle_webhook_secret_to_superadmin_payment_gateways',1),(240,'2025_10_10_122321_add_privacy_policy_link_to_global_settings_table',1),(241,'2025_10_14_000001_create_modifier_option_prices_table',1),(242,'2025_10_14_071228_add_consent_fields_to_users_table',1),(243,'2025_10_14_105354_add_order_item_id_to_kot_items_table',1),(244,'2025_10_15_045419_sms_count_packages',1),(245,'2025_10_17_074528_add_delivery_app_id_orders_table',1),(246,'2025_10_27_065853_add_from_printer_type',1),(247,'2025_10_28_065738_add_discount_permission_to_existing_roles',1),(248,'2025_10_28_081340_add_multipos_limit_to_packages_table',1),(249,'2025_10_30_055800_add_qr_order_location_columns_to_restaurants_table',1),(250,'2025_11_03_065853_add_from_printer_enum',1),(251,'2025_11_07_065319_add_disable_order_type_popup_to_restaurants_table',1),(252,'2025_11_10_000000_add_show_customer_phone_to_receipt_settings_table',1),(253,'2025_11_10_000001_add_show_payment_status_to_receipt_settings_table',1),(254,'2025_11_10_100652_add_added_by_to_orders_table',1),(255,'2025_11_12_081126_create_table_epay_payments_table',1),(256,'2025_11_13_060849_add_cancelled_by_to_orders_table',1),(257,'2025_11_18_083606_add_modifier_option_prices_column_to_table',1),(258,'2025_11_21_092424_add_time_format_to_restaurants_table',1),(259,'2025_11_21_095021_add_date_format_to_restaurants_table',1),(260,'2025_11_21_111459_change_recipients_to_roles_in_whatsapp_report_schedules_table',1),(261,'2025_11_21_164300_add_time_format_and_date_format_to_global_settings_table',1),(262,'2025_11_25_145100_seed_whatsapp_template_definitions',1),(263,'2025_11_27_082212_create_push_notifications_table',1),(264,'2025_11_27_084813_allow_duplicate_customer_email_per_restaurant',1),(265,'2025_12_01_061505_add_columns_to_restaurants_table',1),(266,'2025_12_03_055406_change_column_into_orders_table',1),(267,'2025_12_03_063129_add_cancel_time_to_orders_table',1),(268,'2025_12_03_090241_add_phone_code_to_delivery_executives_table',1),(269,'2025_12_03_101309_add_disable_from_customer_site_to_order_types_table',1),(270,'2025_12_04_094322_add_roles_to_whatsapp_automated_schedules_table',1),(271,'2025_12_05_120000_update_customer_email_unique_per_restaurant',1),(272,'2025_12_10_040806_add_order_confirmed_notification_to_existing_restaurants',1),(273,'2025_12_12_063203_add_enable_mollie_to_global_settings_table',1),(274,'2025_12_12_063224_add_mollie_payment_gateway_to_payment_gateway_credentials_table',1),(275,'2025_12_12_071258_create_mollie_payments_table',1),(276,'2025_12_15_022410_add_show_support_ticket_to_global_settings_table',1),(277,'2025_12_15_100000_add_webhook_fields_to_whatsapp_settings_table',1),(278,'2025_12_16_170214_add_indexes_for_pos_queries',1),(279,'2025_12_18_072141_add_mollie_webhook_secret_to_payment_gateway_credentials_table',1),(280,'2025_12_19_042834_add_loyalty_columns_to_orders_table',1),(281,'2025_12_20_000000_add_cancelled_by_to_kot_items_table',1),(282,'2025_12_21_000001_create_refund_reasons_table',1),(283,'2025_12_24_075701_create_assign_waiter_to_tables_table',1),(284,'2025_12_31_063109_add_cascade_delete_to_split_orders_order_id',1),(285,'2025_12_31_081636_create_branch_operational_shifts_table',1),(286,'2025_12_31_093806_add_restaurant_id_and_update_day_of_week_to_branch_operational_shifts_table',1),(287,'2025_12_31_100538_change_day_of_week_from_enum_to_string_in_branch_operational_shifts_table',1),(288,'2026_01_02_052013_change_day_of_week_to_json_in_branch_operational_shifts_table',1),(289,'2026_01_07_120000_add_mollie_columns_to_superadmin_payment_gateways_table',1),(290,'2026_01_16_112054_create_menu_table_pivot_table',1),(291,'2026_01_20_000001_add_schedule_fields_to_notification_settings_table',1),(292,'2026_01_21_000001_update_kot_settings_default_status_columns',1),(293,'2026_01_21_120000_add_superadmin_modules_and_permissions_for_existing_installs',1),(294,'2026_01_22_000000_add_ai_monthly_request_limit_to_packages_table',1),(295,'2026_01_22_061911_add_menu_pdf_sent_notification_to_existing_restaurants',1),(296,'2026_01_22_102923_add_include_charges_in_tax_base_to_settings_table',1),(297,'2026_01_27_110718_add_columns_to_superadmin_payment_gateways_table_for_tap_table',1),(298,'2026_01_27_110905_create_tap_payment_gateway_tables',1),(299,'2026_02_03_063404_add_is_due_and_due_amount_received_to_payments_table',1),(300,'2026_02_03_105222_sync_cash_and_bank_transfer_to_offline_payment_methods',1),(301,'2026_02_04_000001_add_unique_code_to_delivery_executives_table',1),(302,'2026_02_05_072241_update_menu_table_is_active_column',1),(303,'2026_02_10_091859_add_payer_details_to_split_orders_table',1),(304,'2026_02_11_120000_add_order_note_to_orders_table',1),(305,'2026_02_16_095800_add_and_update_columns_to_restaurants_table',1),(306,'2026_02_16_215609_assign_export_menu_item_permission_to_existing_roles',1),(307,'2026_02_19_000001_add_show_order_number_on_board_to_order_types_table',1),(308,'2026_02_19_164315_add_waiter_response_to_orders_table',1),(309,'2026_02_20_000000_add_cr_vat_to_branches_table',1),(310,'2026_02_23_000001_add_branch_id_to_receipt_settings_table',1),(311,'2026_02_23_100000_add_branch_id_to_taxes_table',1),(312,'2026_02_26_000001_add_open_close_settings_to_restaurants_table',1),(313,'2026_02_27_000002_add_manual_open_close_type_to_restaurants_table',1),(314,'2026_02_27_000004_replace_restaurant_open_close_permissions',1),(315,'2026_03_05_000000_rename_desktop_applications_to_desktop_mobile_application',1),(316,'2026_03_06_000001_seed_default_whatsapp_notification_preferences',1),(317,'2026_03_09_000001_add_email_to_delivery_executives_table',1),(318,'2026_03_09_110642_add_refund_payments_permission_table',1),(319,'2026_03_10_000000_add_google_business_link_to_restaurants',1),(320,'2026_03_10_000001_add_google_business_link_to_global_settings',1),(321,'2026_03_12_120000_create_order_cash_collections_table',1),(322,'2026_03_12_160000_create_delivery_cash_settlements_tables',1),(323,'2026_03_16_000002_create_order_notification_settings_table',1),(324,'2026_03_17_000002_update_operations_summary_template_definition',1),(325,'2026_03_17_000003_update_reservation_notification_button_url',1),(326,'2026_03_17_000004_update_operations_summary_button_url',1),(327,'2026_03_17_000005_update_staff_and_kitchen_template_descriptions',1),(328,'2026_03_17_000006_update_staff_notification_description',1),(329,'2026_03_18_000001_add_staff_new_order_alert_preference',1),(330,'2026_03_19_000001_backfill_delivery_executive_online_status',1),(331,'2026_05_22_000001_add_indexes_for_report_queries',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(4,'App\\Models\\User',3),(6,'App\\Models\\User',4),(8,'App\\Models\\User',5),(10,'App\\Models\\User',6),(12,'App\\Models\\User',7);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `modifier_group_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modifier_group_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `modifier_group_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modifier_group_translations_modifier_group_id_locale_unique` (`modifier_group_id`,`locale`),
  KEY `modifier_group_translations_locale_index` (`locale`),
  CONSTRAINT `modifier_group_translations_modifier_group_id_foreign` FOREIGN KEY (`modifier_group_id`) REFERENCES `modifier_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modifier_group_translations` WRITE;
/*!40000 ALTER TABLE `modifier_group_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `modifier_group_translations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `modifier_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modifier_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modifier_groups_branch_id_foreign` (`branch_id`),
  CONSTRAINT `modifier_groups_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modifier_groups` WRITE;
/*!40000 ALTER TABLE `modifier_groups` DISABLE KEYS */;
INSERT INTO `modifier_groups` VALUES (1,'Inyangamugayo (Extra Toppings)',NULL,1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,'Ibyohereza (Dips & Sauces)',NULL,1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,'Inyangamugayo (Extra Toppings)',NULL,3,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(4,'Ibyohereza (Dips & Sauces)',NULL,3,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(5,'Inyangamugayo (Extra Toppings)',NULL,5,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(6,'Ibyohereza (Dips & Sauces)',NULL,5,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `modifier_groups` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `modifier_option_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modifier_option_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `modifier_group_id` bigint(20) unsigned NOT NULL,
  `modifier_option_id` bigint(20) unsigned DEFAULT NULL,
  `order_type_id` bigint(20) unsigned DEFAULT NULL,
  `delivery_app_id` bigint(20) unsigned DEFAULT NULL,
  `calculated_price` decimal(16,2) NOT NULL,
  `override_price` decimal(16,2) DEFAULT NULL,
  `final_price` decimal(16,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modifier_option_prices_modifier_group_id_foreign` (`modifier_group_id`),
  KEY `modifier_option_prices_modifier_option_id_foreign` (`modifier_option_id`),
  KEY `modifier_option_prices_order_type_id_foreign` (`order_type_id`),
  KEY `modifier_option_prices_delivery_app_id_foreign` (`delivery_app_id`),
  CONSTRAINT `modifier_option_prices_delivery_app_id_foreign` FOREIGN KEY (`delivery_app_id`) REFERENCES `delivery_platforms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `modifier_option_prices_modifier_group_id_foreign` FOREIGN KEY (`modifier_group_id`) REFERENCES `modifier_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `modifier_option_prices_modifier_option_id_foreign` FOREIGN KEY (`modifier_option_id`) REFERENCES `modifier_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `modifier_option_prices_order_type_id_foreign` FOREIGN KEY (`order_type_id`) REFERENCES `order_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modifier_option_prices` WRITE;
/*!40000 ALTER TABLE `modifier_option_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `modifier_option_prices` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `modifier_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modifier_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `modifier_group_id` bigint(20) unsigned NOT NULL,
  `name` text DEFAULT NULL,
  `price` decimal(16,2) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_preselected` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modifier_options_modifier_group_id_foreign` (`modifier_group_id`),
  CONSTRAINT `modifier_options_modifier_group_id_foreign` FOREIGN KEY (`modifier_group_id`) REFERENCES `modifier_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modifier_options` WRITE;
/*!40000 ALTER TABLE `modifier_options` DISABLE KEYS */;
INSERT INTO `modifier_options` VALUES (1,1,'{\"en\":\"Extra Cheese\"}',500.00,1,0,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,'{\"en\":\"Extra Sauce\"}',300.00,1,0,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,'{\"en\":\"Grilled Onions\"}',400.00,1,0,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,2,'{\"en\":\"Akabanga (Rwandan Hot Sauce)\"}',200.00,1,0,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,2,'{\"en\":\"Kachumbari (African Salsa)\"}',300.00,1,0,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,2,'{\"en\":\"Piri-Piri Sauce\"}',250.00,1,0,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,2,'{\"en\":\"Mint Chutney\"}',200.00,1,0,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(8,2,'{\"en\":\"Tamarind Sauce\"}',300.00,1,0,0,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(9,3,'{\"en\":\"Extra Cheese\"}',500.00,1,0,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(10,3,'{\"en\":\"Extra Sauce\"}',300.00,1,0,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(11,3,'{\"en\":\"Grilled Onions\"}',400.00,1,0,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(12,4,'{\"en\":\"Akabanga (Rwandan Hot Sauce)\"}',200.00,1,0,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(13,4,'{\"en\":\"Kachumbari (African Salsa)\"}',300.00,1,0,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(14,4,'{\"en\":\"Piri-Piri Sauce\"}',250.00,1,0,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(15,4,'{\"en\":\"Mint Chutney\"}',200.00,1,0,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(16,4,'{\"en\":\"Tamarind Sauce\"}',300.00,1,0,0,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(17,5,'{\"en\":\"Extra Cheese\"}',500.00,1,0,0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(18,5,'{\"en\":\"Extra Sauce\"}',300.00,1,0,0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(19,5,'{\"en\":\"Grilled Onions\"}',400.00,1,0,0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(20,6,'{\"en\":\"Akabanga (Rwandan Hot Sauce)\"}',200.00,1,0,0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(21,6,'{\"en\":\"Kachumbari (African Salsa)\"}',300.00,1,0,0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(22,6,'{\"en\":\"Piri-Piri Sauce\"}',250.00,1,0,0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(23,6,'{\"en\":\"Mint Chutney\"}',200.00,1,0,0,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(24,6,'{\"en\":\"Tamarind Sauce\"}',300.00,1,0,0,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `modifier_options` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `is_superadmin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'Whatsapp',0,'2026-05-23 15:17:43','2026-05-23 15:17:43'),(2,'Restaurants',1,'2026-05-23 15:17:53','2026-05-23 15:17:54'),(3,'Superadmin Payment',1,'2026-05-23 15:17:53','2026-05-23 15:17:54'),(4,'Packages',1,'2026-05-23 15:17:53','2026-05-23 15:17:54'),(5,'Billing',1,'2026-05-23 15:17:53','2026-05-23 15:17:54'),(6,'Offline Request',1,'2026-05-23 15:17:53','2026-05-23 15:17:54'),(7,'SuperAdmin',1,'2026-05-23 15:17:53','2026-05-23 15:17:54'),(8,'Landing Site',1,'2026-05-23 15:17:53','2026-05-23 15:17:54'),(9,'Superadmin Settings',1,'2026-05-23 15:17:53','2026-05-23 15:17:54'),(10,'Menu',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(11,'Menu Item',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(12,'Item Category',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(13,'Area',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(14,'Table',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(15,'Reservation',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(16,'KOT',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(17,'Order',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(18,'Customer',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(19,'Staff',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(20,'Report',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(21,'Delivery Executive',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(22,'Waiter Request',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(23,'Expense',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(24,'Payment',0,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(25,'Settings',0,'2026-05-23 15:17:54','2026-05-23 15:17:54');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `mollie_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mollie_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mollie_payment_id` varchar(191) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_error_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_error_response`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mollie_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `mollie_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `mollie_payments` WRITE;
/*!40000 ALTER TABLE `mollie_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `mollie_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `notification_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(191) NOT NULL,
  `send_email` tinyint(1) NOT NULL DEFAULT 1,
  `send_time` time DEFAULT NULL,
  `last_sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_settings_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `notification_settings_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `notification_settings` WRITE;
/*!40000 ALTER TABLE `notification_settings` DISABLE KEYS */;
INSERT INTO `notification_settings` VALUES (1,1,'order_received',1,NULL,NULL,NULL,NULL),(2,1,'reservation_confirmed',1,NULL,NULL,NULL,NULL),(3,1,'new_reservation',1,NULL,NULL,NULL,NULL),(4,1,'order_bill_sent',1,NULL,NULL,NULL,NULL),(5,1,'staff_welcome',1,NULL,NULL,NULL,NULL),(6,2,'order_received',1,NULL,NULL,NULL,NULL),(7,2,'reservation_confirmed',1,NULL,NULL,NULL,NULL),(8,2,'new_reservation',1,NULL,NULL,NULL,NULL),(9,2,'order_bill_sent',1,NULL,NULL,NULL,NULL),(10,2,'staff_welcome',1,NULL,NULL,NULL,NULL),(11,3,'order_received',1,NULL,NULL,NULL,NULL),(12,3,'reservation_confirmed',1,NULL,NULL,NULL,NULL),(13,3,'new_reservation',1,NULL,NULL,NULL,NULL),(14,3,'order_bill_sent',1,NULL,NULL,NULL,NULL),(15,3,'staff_welcome',1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `notification_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_restaurant_id_foreign` (`restaurant_id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  CONSTRAINT `notifications_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `offline_payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offline_payment_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offline_payment_methods_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `offline_payment_methods_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `offline_payment_methods` WRITE;
/*!40000 ALTER TABLE `offline_payment_methods` DISABLE KEYS */;
INSERT INTO `offline_payment_methods` VALUES (1,1,'cash',NULL,'inactive','2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,'bank_transfer',NULL,'inactive','2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,2,'cash',NULL,'inactive','2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,2,'bank_transfer',NULL,'inactive','2026-05-23 15:17:55','2026-05-23 15:17:55'),(5,3,'cash',NULL,'inactive','2026-05-23 15:17:56','2026-05-23 15:17:56'),(6,3,'bank_transfer',NULL,'inactive','2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `offline_payment_methods` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `offline_plan_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offline_plan_changes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `package_id` bigint(20) unsigned NOT NULL,
  `package_type` varchar(191) NOT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `next_pay_date` date DEFAULT NULL,
  `invoice_id` bigint(20) unsigned DEFAULT NULL,
  `offline_method_id` bigint(20) unsigned DEFAULT NULL,
  `file_name` varchar(191) DEFAULT NULL,
  `status` enum('verified','pending','rejected') NOT NULL DEFAULT 'pending',
  `remark` text DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offline_plan_changes_restaurant_id_foreign` (`restaurant_id`),
  KEY `offline_plan_changes_package_id_foreign` (`package_id`),
  KEY `offline_plan_changes_invoice_id_foreign` (`invoice_id`),
  KEY `offline_plan_changes_offline_method_id_foreign` (`offline_method_id`),
  CONSTRAINT `offline_plan_changes_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `global_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `offline_plan_changes_offline_method_id_foreign` FOREIGN KEY (`offline_method_id`) REFERENCES `offline_payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `offline_plan_changes_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `offline_plan_changes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `offline_plan_changes` WRITE;
/*!40000 ALTER TABLE `offline_plan_changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `offline_plan_changes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `onboarding_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `onboarding_steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `add_area_completed` tinyint(1) NOT NULL DEFAULT 0,
  `add_table_completed` tinyint(1) NOT NULL DEFAULT 0,
  `add_menu_completed` tinyint(1) NOT NULL DEFAULT 0,
  `add_menu_items_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onboarding_steps_branch_id_foreign` (`branch_id`),
  CONSTRAINT `onboarding_steps_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `onboarding_steps` WRITE;
/*!40000 ALTER TABLE `onboarding_steps` DISABLE KEYS */;
INSERT INTO `onboarding_steps` VALUES (1,1,1,1,1,1,'2026-05-23 15:17:55','2026-05-23 15:17:58'),(2,1,1,1,1,1,'2026-05-23 15:17:55','2026-05-23 15:17:58'),(3,2,0,0,0,0,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,2,0,0,0,0,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(5,3,1,1,1,1,'2026-05-23 15:17:55','2026-05-23 15:17:59'),(6,3,1,1,1,1,'2026-05-23 15:17:56','2026-05-23 15:17:59'),(7,4,0,0,0,0,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(8,4,0,0,0,0,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(9,5,1,1,1,1,'2026-05-23 15:17:56','2026-05-23 15:18:00'),(10,5,1,1,1,1,'2026-05-23 15:17:56','2026-05-23 15:18:00'),(11,6,0,0,0,0,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(12,6,0,0,0,0,'2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `onboarding_steps` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_cash_collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_cash_collections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `delivery_executive_id` bigint(20) unsigned DEFAULT NULL,
  `expected_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `collected_amount` decimal(16,2) DEFAULT NULL,
  `status` enum('pending_collection','collected','partial','not_collected','submitted','settled') NOT NULL DEFAULT 'pending_collection',
  `notes` text DEFAULT NULL,
  `recorded_at` timestamp NULL DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `settled_at` timestamp NULL DEFAULT NULL,
  `settled_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_cash_collections_order_id_foreign` (`order_id`),
  KEY `occ_exec_status_idx` (`delivery_executive_id`,`status`),
  KEY `occ_branch_status_idx` (`branch_id`,`status`),
  CONSTRAINT `order_cash_collections_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_cash_collections_delivery_executive_id_foreign` FOREIGN KEY (`delivery_executive_id`) REFERENCES `delivery_executives` (`id`) ON DELETE SET NULL,
  CONSTRAINT `order_cash_collections_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_cash_collections` WRITE;
/*!40000 ALTER TABLE `order_cash_collections` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_cash_collections` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `charge_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_charges_order_id_foreign` (`order_id`),
  KEY `order_charges_charge_id_foreign` (`charge_id`),
  CONSTRAINT `order_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `restaurant_charges` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_charges_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_charges` WRITE;
/*!40000 ALTER TABLE `order_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_charges` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_histories_order_id_foreign` (`order_id`),
  CONSTRAINT `order_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_histories` WRITE;
/*!40000 ALTER TABLE `order_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_histories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_item_modifier_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_modifier_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `modifier_option_id` bigint(20) unsigned DEFAULT NULL,
  `modifier_option_name` text DEFAULT NULL,
  `modifier_option_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_item_modifier_options_order_item_id_foreign` (`order_item_id`),
  KEY `order_item_modifier_options_modifier_option_id_foreign` (`modifier_option_id`),
  CONSTRAINT `order_item_modifier_options_modifier_option_id_foreign` FOREIGN KEY (`modifier_option_id`) REFERENCES `modifier_options` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `order_item_modifier_options_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_item_modifier_options` WRITE;
/*!40000 ALTER TABLE `order_item_modifier_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_item_modifier_options` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `menu_item_id` bigint(20) unsigned NOT NULL,
  `menu_item_variation_id` bigint(20) unsigned DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_free_item_from_stamp` tinyint(1) NOT NULL DEFAULT 0,
  `stamp_rule_id` bigint(20) unsigned DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `tax_amount` decimal(15,2) DEFAULT NULL,
  `tax_percentage` decimal(8,4) DEFAULT NULL,
  `tax_breakup` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tax_breakup`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_menu_item_id_foreign` (`menu_item_id`),
  KEY `order_items_menu_item_variation_id_foreign` (`menu_item_variation_id`),
  KEY `order_items_branch_id_foreign` (`branch_id`),
  KEY `idx_order_items_order_menu_variation` (`order_id`,`menu_item_id`,`menu_item_variation_id`),
  KEY `idx_order_items_order_id` (`order_id`),
  CONSTRAINT `order_items_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_menu_item_variation_id_foreign` FOREIGN KEY (`menu_item_variation_id`) REFERENCES `menu_item_variations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,NULL,6,NULL,NULL,0,NULL,2,4500.00,9000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,1,NULL,8,NULL,NULL,0,NULL,2,4000.00,8000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,1,NULL,10,NULL,NULL,0,NULL,3,2500.00,7500.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,1,NULL,11,NULL,NULL,0,NULL,3,1500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,1,1,NULL,14,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,1,2,NULL,4,NULL,NULL,0,NULL,3,1500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,1,2,NULL,11,NULL,NULL,0,NULL,3,1500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(8,1,3,NULL,3,NULL,NULL,0,NULL,3,2800.00,8400.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(9,1,4,NULL,2,NULL,NULL,0,NULL,3,3000.00,9000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(10,1,4,NULL,8,NULL,NULL,0,NULL,1,4000.00,4000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(11,1,4,NULL,11,NULL,NULL,0,NULL,3,1500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(12,1,4,NULL,14,NULL,NULL,0,NULL,1,1000.00,1000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(13,1,4,NULL,16,NULL,NULL,0,NULL,1,800.00,800.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(14,1,5,NULL,7,NULL,NULL,0,NULL,1,2000.00,2000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(15,1,5,NULL,10,NULL,NULL,0,NULL,2,2500.00,5000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(16,1,5,NULL,12,NULL,NULL,0,NULL,3,1200.00,3600.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(17,1,6,NULL,5,NULL,NULL,0,NULL,2,5000.00,10000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(18,1,6,NULL,11,NULL,NULL,0,NULL,1,1500.00,1500.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(19,1,6,NULL,14,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(20,1,6,NULL,16,NULL,NULL,0,NULL,2,800.00,1600.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(21,1,7,NULL,5,NULL,NULL,0,NULL,2,5000.00,10000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(22,1,7,NULL,6,NULL,NULL,0,NULL,3,4500.00,13500.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(23,1,7,NULL,12,NULL,NULL,0,NULL,3,1200.00,3600.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(24,1,8,NULL,13,NULL,NULL,0,NULL,1,2000.00,2000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(25,1,8,NULL,17,NULL,NULL,0,NULL,2,1000.00,2000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(26,1,9,NULL,1,NULL,NULL,0,NULL,3,2500.00,7500.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(27,1,9,NULL,2,NULL,NULL,0,NULL,1,3000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(28,1,9,NULL,8,NULL,NULL,0,NULL,1,4000.00,4000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(29,1,9,NULL,14,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(30,3,10,NULL,18,NULL,NULL,0,NULL,3,2500.00,7500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(31,3,10,NULL,23,NULL,NULL,0,NULL,1,4500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(32,3,10,NULL,24,NULL,NULL,0,NULL,1,2000.00,2000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(33,3,10,NULL,29,NULL,NULL,0,NULL,3,1200.00,3600.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(34,3,10,NULL,32,NULL,NULL,0,NULL,3,500.00,1500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(35,3,11,NULL,20,NULL,NULL,0,NULL,1,2800.00,2800.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(36,3,11,NULL,22,NULL,NULL,0,NULL,1,5000.00,5000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(37,3,11,NULL,25,NULL,NULL,0,NULL,1,4000.00,4000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(38,3,11,NULL,26,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(39,3,11,NULL,29,NULL,NULL,0,NULL,2,1200.00,2400.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(40,3,12,NULL,18,NULL,NULL,0,NULL,1,2500.00,2500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(41,3,12,NULL,21,NULL,NULL,0,NULL,2,1500.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(42,3,12,NULL,23,NULL,NULL,0,NULL,2,4500.00,9000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(43,3,12,NULL,24,NULL,NULL,0,NULL,2,2000.00,4000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(44,3,12,NULL,33,NULL,NULL,0,NULL,3,800.00,2400.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(45,3,13,NULL,18,NULL,NULL,0,NULL,2,2500.00,5000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(46,3,13,NULL,19,NULL,NULL,0,NULL,2,3000.00,6000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(47,3,13,NULL,28,NULL,NULL,0,NULL,2,1500.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(48,3,13,NULL,29,NULL,NULL,0,NULL,3,1200.00,3600.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(49,3,14,NULL,18,NULL,NULL,0,NULL,3,2500.00,7500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(50,3,14,NULL,28,NULL,NULL,0,NULL,2,1500.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(51,3,15,NULL,18,NULL,NULL,0,NULL,3,2500.00,7500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(52,3,15,NULL,19,NULL,NULL,0,NULL,3,3000.00,9000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(53,3,15,NULL,22,NULL,NULL,0,NULL,1,5000.00,5000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(54,3,15,NULL,23,NULL,NULL,0,NULL,3,4500.00,13500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(55,3,15,NULL,33,NULL,NULL,0,NULL,3,800.00,2400.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(56,3,16,NULL,23,NULL,NULL,0,NULL,1,4500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(57,3,16,NULL,25,NULL,NULL,0,NULL,2,4000.00,8000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(58,3,16,NULL,27,NULL,NULL,0,NULL,3,2500.00,7500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(59,3,16,NULL,28,NULL,NULL,0,NULL,3,1500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(60,3,17,NULL,25,NULL,NULL,0,NULL,3,4000.00,12000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(61,3,17,NULL,28,NULL,NULL,0,NULL,2,1500.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(62,3,17,NULL,31,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(63,3,18,NULL,22,NULL,NULL,0,NULL,3,5000.00,15000.00,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(64,5,19,NULL,38,NULL,NULL,0,NULL,3,1500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(65,5,19,NULL,42,NULL,NULL,0,NULL,2,4000.00,8000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(66,5,19,NULL,44,NULL,NULL,0,NULL,1,2500.00,2500.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(67,5,19,NULL,48,NULL,NULL,0,NULL,1,1000.00,1000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(68,5,19,NULL,49,NULL,NULL,0,NULL,2,500.00,1000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(69,5,20,NULL,48,NULL,NULL,0,NULL,1,1000.00,1000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(70,5,20,NULL,51,NULL,NULL,0,NULL,1,1000.00,1000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(71,5,21,NULL,35,NULL,NULL,0,NULL,1,2500.00,2500.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(72,5,21,NULL,42,NULL,NULL,0,NULL,2,4000.00,8000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(73,5,21,NULL,48,NULL,NULL,0,NULL,1,1000.00,1000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(74,5,21,NULL,51,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(75,5,22,NULL,38,NULL,NULL,0,NULL,3,1500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(76,5,22,NULL,42,NULL,NULL,0,NULL,3,4000.00,12000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(77,5,22,NULL,44,NULL,NULL,0,NULL,1,2500.00,2500.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(78,5,22,NULL,50,NULL,NULL,0,NULL,3,800.00,2400.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(79,5,22,NULL,51,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(80,5,23,NULL,46,NULL,NULL,0,NULL,1,1200.00,1200.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(81,5,23,NULL,48,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(82,5,24,NULL,36,NULL,NULL,0,NULL,2,3000.00,6000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(83,5,24,NULL,38,NULL,NULL,0,NULL,2,1500.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(84,5,24,NULL,46,NULL,NULL,0,NULL,1,1200.00,1200.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(85,5,25,NULL,37,NULL,NULL,0,NULL,1,2800.00,2800.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(86,5,25,NULL,39,NULL,NULL,0,NULL,2,5000.00,10000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(87,5,25,NULL,45,NULL,NULL,0,NULL,3,1500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(88,5,25,NULL,46,NULL,NULL,0,NULL,1,1200.00,1200.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(89,5,26,NULL,40,NULL,NULL,0,NULL,1,4500.00,4500.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(90,5,27,NULL,36,NULL,NULL,0,NULL,2,3000.00,6000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(91,5,27,NULL,37,NULL,NULL,0,NULL,3,2800.00,8400.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(92,5,27,NULL,41,NULL,NULL,0,NULL,1,2000.00,2000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(93,5,27,NULL,43,NULL,NULL,0,NULL,3,1000.00,3000.00,NULL,NULL,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_notification_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_notification_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `hide_new_order_notification` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_notification_restaurant_role_unique` (`restaurant_id`,`role_id`),
  KEY `order_notification_settings_role_id_foreign` (`role_id`),
  CONSTRAINT `order_notification_settings_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_notification_settings_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_notification_settings` WRITE;
/*!40000 ALTER TABLE `order_notification_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_notification_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_number_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_number_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `enable_feature` tinyint(1) NOT NULL DEFAULT 0,
  `prefix` varchar(191) NOT NULL DEFAULT 'ORD',
  `digits` tinyint(3) unsigned NOT NULL DEFAULT 3,
  `separator` varchar(191) NOT NULL DEFAULT '-',
  `include_date` tinyint(1) NOT NULL DEFAULT 0,
  `show_year` tinyint(1) NOT NULL DEFAULT 0,
  `show_month` tinyint(1) NOT NULL DEFAULT 0,
  `show_day` tinyint(1) NOT NULL DEFAULT 0,
  `show_time` tinyint(1) NOT NULL DEFAULT 0,
  `reset_daily` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_number_settings_branch_id_foreign` (`branch_id`),
  CONSTRAINT `order_number_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_number_settings` WRITE;
/*!40000 ALTER TABLE `order_number_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_number_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_places` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `printer_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_places_branch_id_foreign` (`branch_id`),
  KEY `order_places_printer_id_foreign` (`printer_id`),
  CONSTRAINT `order_places_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_places_printer_id_foreign` FOREIGN KEY (`printer_id`) REFERENCES `printers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_places` WRITE;
/*!40000 ALTER TABLE `order_places` DISABLE KEYS */;
INSERT INTO `order_places` VALUES (1,NULL,1,'Default POS Terminal','vegetarian',1,1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,NULL,2,'Default POS Terminal','vegetarian',1,1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,NULL,3,'Default POS Terminal','vegetarian',1,1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,NULL,4,'Default POS Terminal','vegetarian',1,1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(5,NULL,5,'Default POS Terminal','vegetarian',1,1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(6,NULL,6,'Default POS Terminal','vegetarian',1,1,'2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `order_places` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_taxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `tax_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_taxes_order_id_foreign` (`order_id`),
  KEY `order_taxes_tax_id_foreign` (`tax_id`),
  CONSTRAINT `order_taxes_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_taxes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_taxes` WRITE;
/*!40000 ALTER TABLE `order_taxes` DISABLE KEYS */;
INSERT INTO `order_taxes` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,3),(11,11,3),(12,12,3),(13,13,3),(14,14,3),(15,15,3),(16,16,3),(17,17,3),(18,18,3),(19,19,5),(20,20,5),(21,21,5),(22,22,5),(23,23,5),(24,24,5),(25,25,5),(26,26,5),(27,27,5);
/*!40000 ALTER TABLE `order_taxes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `order_type_name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `enable_token_number` tinyint(1) NOT NULL DEFAULT 0,
  `show_order_number_on_board` tinyint(1) NOT NULL DEFAULT 0,
  `enable_from_customer_site` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_types_branch_id_foreign` (`branch_id`),
  CONSTRAINT `order_types_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_types` WRITE;
/*!40000 ALTER TABLE `order_types` DISABLE KEYS */;
INSERT INTO `order_types` VALUES (1,1,'Dine In','dine_in',1,1,0,0,1,'dine_in','2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,'Delivery','delivery',1,1,0,0,1,'delivery','2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,1,'Pickup','pickup',1,1,0,0,1,'pickup','2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,2,'Dine In','dine_in',1,1,0,0,1,'dine_in','2026-05-23 15:17:55','2026-05-23 15:17:55'),(5,2,'Delivery','delivery',1,1,0,0,1,'delivery','2026-05-23 15:17:55','2026-05-23 15:17:55'),(6,2,'Pickup','pickup',1,1,0,0,1,'pickup','2026-05-23 15:17:55','2026-05-23 15:17:55'),(7,3,'Dine In','dine_in',1,1,0,0,1,'dine_in','2026-05-23 15:17:55','2026-05-23 15:17:55'),(8,3,'Delivery','delivery',1,1,0,0,1,'delivery','2026-05-23 15:17:55','2026-05-23 15:17:55'),(9,3,'Pickup','pickup',1,1,0,0,1,'pickup','2026-05-23 15:17:55','2026-05-23 15:17:55'),(10,4,'Dine In','dine_in',1,1,0,0,1,'dine_in','2026-05-23 15:17:56','2026-05-23 15:17:56'),(11,4,'Delivery','delivery',1,1,0,0,1,'delivery','2026-05-23 15:17:56','2026-05-23 15:17:56'),(12,4,'Pickup','pickup',1,1,0,0,1,'pickup','2026-05-23 15:17:56','2026-05-23 15:17:56'),(13,5,'Dine In','dine_in',1,1,0,0,1,'dine_in','2026-05-23 15:17:56','2026-05-23 15:17:56'),(14,5,'Delivery','delivery',1,1,0,0,1,'delivery','2026-05-23 15:17:56','2026-05-23 15:17:56'),(15,5,'Pickup','pickup',1,1,0,0,1,'pickup','2026-05-23 15:17:56','2026-05-23 15:17:56'),(16,6,'Dine In','dine_in',1,1,0,0,1,'dine_in','2026-05-23 15:17:56','2026-05-23 15:17:56'),(17,6,'Delivery','delivery',1,1,0,0,1,'delivery','2026-05-23 15:17:56','2026-05-23 15:17:56'),(18,6,'Pickup','pickup',1,1,0,0,1,'pickup','2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `order_types` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `order_number` varchar(191) DEFAULT NULL,
  `formatted_order_number` varchar(191) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `table_id` bigint(20) unsigned DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `number_of_pax` int(11) DEFAULT NULL,
  `order_note` text DEFAULT NULL,
  `waiter_id` bigint(20) unsigned DEFAULT NULL,
  `waiter_response` enum('pending','accepted','declined') NOT NULL DEFAULT 'pending',
  `waiter_notification_sent_at` timestamp NULL DEFAULT NULL,
  `waiter_response_at` timestamp NULL DEFAULT NULL,
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `cancelled_by` bigint(20) unsigned DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `status` enum('draft','kot','billed','paid','canceled','payment_due','ready','out_for_delivery','delivered','pending_verification') NOT NULL DEFAULT 'kot',
  `placed_via` enum('pos','shop') DEFAULT NULL,
  `sub_total` decimal(16,2) NOT NULL,
  `tip_amount` decimal(16,2) DEFAULT 0.00,
  `total_tax_amount` decimal(16,2) DEFAULT 0.00,
  `tax_base` decimal(16,2) DEFAULT NULL,
  `tax_mode` varchar(191) DEFAULT NULL,
  `tip_note` text DEFAULT NULL,
  `total` decimal(16,2) NOT NULL,
  `amount_paid` decimal(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_type_id` bigint(20) unsigned DEFAULT NULL,
  `delivery_app_id` bigint(20) unsigned DEFAULT NULL,
  `custom_order_type_name` varchar(191) DEFAULT NULL,
  `order_type` varchar(191) DEFAULT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `delivery_executive_id` bigint(20) unsigned DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `estimated_delivery_time` datetime DEFAULT NULL,
  `split_type` enum('even','custom','items') DEFAULT NULL,
  `discount_type` varchar(191) DEFAULT NULL,
  `discount_value` decimal(16,2) DEFAULT NULL,
  `discount_amount` decimal(16,2) DEFAULT NULL,
  `order_status` varchar(191) NOT NULL DEFAULT 'placed',
  `delivery_fee` decimal(8,2) NOT NULL DEFAULT 0.00,
  `customer_lat` decimal(10,7) DEFAULT NULL,
  `customer_lng` decimal(10,7) DEFAULT NULL,
  `is_within_radius` tinyint(1) NOT NULL DEFAULT 0,
  `delivery_started_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `estimated_eta_min` int(11) DEFAULT NULL,
  `estimated_eta_max` int(11) DEFAULT NULL,
  `cancel_reason_id` bigint(20) unsigned DEFAULT NULL,
  `cancel_reason_text` varchar(191) DEFAULT NULL,
  `reservation_id` bigint(20) unsigned DEFAULT NULL,
  `loyalty_points_redeemed` int(11) NOT NULL DEFAULT 0,
  `loyalty_discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stamp_discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_uuid_unique` (`uuid`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  KEY `orders_delivery_executive_id_foreign` (`delivery_executive_id`),
  KEY `orders_waiter_id_foreign` (`waiter_id`),
  KEY `orders_cancel_reason_id_foreign` (`cancel_reason_id`),
  KEY `idx_branch_date` (`branch_id`,`date_time`),
  KEY `orders_reservation_id_foreign` (`reservation_id`),
  KEY `orders_added_by_foreign` (`added_by`),
  KEY `orders_cancelled_by_foreign` (`cancelled_by`),
  KEY `idx_orders_branch_table_status` (`branch_id`,`table_id`,`status`),
  KEY `idx_orders_table_branch_status` (`table_id`,`branch_id`,`status`),
  KEY `idx_orders_status_branch` (`status`,`branch_id`),
  KEY `idx_orders_order_type_branch` (`order_type_id`,`branch_id`),
  KEY `idx_orders_delivery_app` (`delivery_app_id`),
  KEY `idx_orders_branch_date_customer` (`branch_id`,`date_time`,`customer_id`),
  KEY `idx_orders_branch_date_status` (`branch_id`,`date_time`,`status`),
  CONSTRAINT `orders_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_cancel_reason_id_foreign` FOREIGN KEY (`cancel_reason_id`) REFERENCES `kot_cancel_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_cancelled_by_foreign` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `orders_delivery_app_id_foreign` FOREIGN KEY (`delivery_app_id`) REFERENCES `delivery_platforms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_delivery_executive_id_foreign` FOREIGN KEY (`delivery_executive_id`) REFERENCES `delivery_executives` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_order_type_id_foreign` FOREIGN KEY (`order_type_id`) REFERENCES `order_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_waiter_id_foreign` FOREIGN KEY (`waiter_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'f562d057-d8fd-467f-aff7-2815def4a4fc',1,'1',NULL,'2026-05-23 17:17:57',1,1,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',32000.00,0.00,0.00,NULL,NULL,NULL,37760.00,37760.00,'2026-05-23 15:17:57','2026-05-23 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(2,'d4e8586a-2673-4dc8-a827-2ca66305a2fc',1,'2',NULL,'2026-05-23 17:17:57',3,2,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',9000.00,0.00,0.00,NULL,NULL,NULL,10620.00,10620.00,'2026-05-23 15:17:57','2026-05-23 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(3,'af7bcd23-8c57-408f-a433-b456bd42d08e',1,'3',NULL,'2026-05-23 17:17:57',1,3,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',8400.00,0.00,0.00,NULL,NULL,NULL,9912.00,9912.00,'2026-05-23 15:17:57','2026-05-23 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(4,'b49006bf-f1cb-47c1-85dd-3fecfc0b3c36',1,'4',NULL,'2026-05-23 17:17:57',7,4,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',19300.00,0.00,0.00,NULL,NULL,NULL,22774.00,22774.00,'2026-05-23 15:17:57','2026-05-23 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(5,'2f65498f-6632-437a-9750-cfd12ab99233',1,'5',NULL,'2026-05-23 17:17:57',1,5,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',10600.00,0.00,0.00,NULL,NULL,NULL,12508.00,12508.00,'2026-05-23 15:17:57','2026-05-23 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(6,'fc19a4fa-0182-4ff6-bd1a-b0aa901b7921',1,'6',NULL,'2026-05-20 17:17:57',5,6,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',16100.00,0.00,0.00,NULL,NULL,NULL,18998.00,18998.00,'2026-05-23 15:17:57','2026-05-23 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(7,'07d4282d-19f2-416f-b9b1-607a94b3ff19',1,'7',NULL,'2026-05-22 17:17:57',7,7,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',27100.00,0.00,0.00,NULL,NULL,NULL,31978.00,31978.00,'2026-05-23 15:17:57','2026-05-23 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(8,'3aebba2a-f91b-4795-a4f0-0af106a24726',1,'8',NULL,'2026-05-20 17:17:57',7,8,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',4000.00,0.00,0.00,NULL,NULL,NULL,4720.00,4720.00,'2026-05-23 15:17:57','2026-05-23 15:17:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(9,'6a5efbd7-253e-48b3-8412-3003b22ad474',1,'9',NULL,'2026-05-21 17:17:57',6,9,NULL,NULL,3,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',17500.00,0.00,0.00,NULL,NULL,NULL,20650.00,20650.00,'2026-05-23 15:17:57','2026-05-23 15:17:58',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(10,'de79623b-08f2-4090-b563-95875abbe560',3,'1',NULL,'2026-05-23 17:17:59',16,10,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',19100.00,0.00,0.00,NULL,NULL,NULL,22538.00,22538.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(11,'b6956a1d-ad9b-42c0-bce4-6b7e01c53403',3,'2',NULL,'2026-05-23 17:17:59',20,11,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',17200.00,0.00,0.00,NULL,NULL,NULL,20296.00,20296.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(12,'9dd8a110-fb57-496b-8d69-51c8bd4f5377',3,'3',NULL,'2026-05-23 17:17:59',20,12,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',20900.00,0.00,0.00,NULL,NULL,NULL,24662.00,24662.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(13,'18212371-8b10-43c7-a629-41db7f794d09',3,'4',NULL,'2026-05-23 17:17:59',18,13,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',17600.00,0.00,0.00,NULL,NULL,NULL,20768.00,20768.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(14,'49a0cf9b-c9ad-4e48-a758-534ba162d108',3,'5',NULL,'2026-05-23 17:17:59',18,14,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',10500.00,0.00,0.00,NULL,NULL,NULL,12390.00,12390.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(15,'933e1510-0123-4dd3-8a40-ddaebee15b80',3,'6',NULL,'2026-05-21 17:17:59',14,15,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',37400.00,0.00,0.00,NULL,NULL,NULL,44132.00,44132.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(16,'64874390-2f9c-45da-ada3-c8df1a1e27b2',3,'7',NULL,'2026-05-20 17:17:59',14,16,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',24500.00,0.00,0.00,NULL,NULL,NULL,28910.00,28910.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(17,'14da9e86-0a24-44a3-9eca-8463c5983bc6',3,'8',NULL,'2026-05-21 17:17:59',16,17,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',18000.00,0.00,0.00,NULL,NULL,NULL,21240.00,21240.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(18,'1aa12480-1413-4075-9918-df67bb285f53',3,'9',NULL,'2026-05-22 17:17:59',16,18,NULL,NULL,5,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',15000.00,0.00,0.00,NULL,NULL,NULL,17700.00,17700.00,'2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(19,'052ea83e-422f-4cdc-ac34-6ebfc051d871',5,'1',NULL,'2026-05-23 17:18:00',28,19,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',17000.00,0.00,0.00,NULL,NULL,NULL,20060.00,20060.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(20,'f5f27652-c84e-4ec4-a4d1-ef5ff2210804',5,'2',NULL,'2026-05-23 17:18:00',25,20,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',2000.00,0.00,0.00,NULL,NULL,NULL,2360.00,2360.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(21,'b162e562-ad46-4e23-90c6-45e5475a4f8b',5,'3',NULL,'2026-05-23 17:18:00',21,21,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',14500.00,0.00,0.00,NULL,NULL,NULL,17110.00,17110.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(22,'59b8097c-36f8-4cad-84a6-f35f6de28bb3',5,'4',NULL,'2026-05-23 17:18:00',27,22,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',24400.00,0.00,0.00,NULL,NULL,NULL,28792.00,28792.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(23,'4b56c04c-bb59-4972-ad1f-81d26f10f4d2',5,'5',NULL,'2026-05-23 17:18:00',29,23,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',4200.00,0.00,0.00,NULL,NULL,NULL,4956.00,4956.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(24,'32098703-b304-4224-b4fb-5d711a4e494b',5,'6',NULL,'2026-05-21 17:18:00',21,24,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',10200.00,0.00,0.00,NULL,NULL,NULL,12036.00,12036.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(25,'34075bcc-9eb2-4bcf-8896-a3edf3869fdf',5,'7',NULL,'2026-05-22 17:18:00',23,25,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',18500.00,0.00,0.00,NULL,NULL,NULL,21830.00,21830.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(26,'3ff92e74-8216-46a8-8dc9-0aa3f47a548d',5,'8',NULL,'2026-05-22 17:18:00',22,26,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',4500.00,0.00,0.00,NULL,NULL,NULL,5310.00,5310.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00),(27,'23989bd5-8d3f-414d-bc43-4a903e856ec8',5,'9',NULL,'2026-05-21 17:18:00',25,27,NULL,NULL,7,'pending',NULL,NULL,NULL,NULL,NULL,'paid','pos',19400.00,0.00,0.00,NULL,NULL,NULL,22892.00,22892.00,'2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placed',0.00,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0.00,0.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `otps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'login',
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `otps_identifier_type_index` (`identifier`,`type`),
  KEY `otps_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `otps` WRITE;
/*!40000 ALTER TABLE `otps` DISABLE KEYS */;
/*!40000 ALTER TABLE `otps` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `package_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` bigint(20) unsigned DEFAULT NULL,
  `module_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_modules_package_id_foreign` (`package_id`),
  KEY `package_modules_module_id_foreign` (`module_id`),
  CONSTRAINT `package_modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `package_modules_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `package_modules` WRITE;
/*!40000 ALTER TABLE `package_modules` DISABLE KEYS */;
INSERT INTO `package_modules` VALUES (1,1,1,NULL,NULL),(2,1,10,NULL,NULL),(3,1,11,NULL,NULL),(4,1,12,NULL,NULL),(5,1,13,NULL,NULL),(6,1,14,NULL,NULL),(7,1,15,NULL,NULL),(8,1,16,NULL,NULL),(9,1,17,NULL,NULL),(10,1,18,NULL,NULL),(11,1,19,NULL,NULL),(12,1,20,NULL,NULL),(13,1,21,NULL,NULL),(14,1,22,NULL,NULL),(15,1,23,NULL,NULL),(16,1,24,NULL,NULL),(17,1,25,NULL,NULL),(18,2,1,NULL,NULL),(19,2,10,NULL,NULL),(20,2,11,NULL,NULL),(21,2,12,NULL,NULL),(22,2,13,NULL,NULL),(23,2,14,NULL,NULL),(24,2,15,NULL,NULL),(25,2,16,NULL,NULL),(26,2,17,NULL,NULL),(27,2,18,NULL,NULL),(28,2,19,NULL,NULL),(29,2,20,NULL,NULL),(30,2,21,NULL,NULL),(31,2,22,NULL,NULL),(32,2,23,NULL,NULL),(33,2,24,NULL,NULL),(34,2,25,NULL,NULL),(35,3,1,NULL,NULL),(36,3,10,NULL,NULL),(37,3,11,NULL,NULL),(38,3,12,NULL,NULL),(39,3,13,NULL,NULL),(40,3,14,NULL,NULL),(41,3,15,NULL,NULL),(42,3,16,NULL,NULL),(43,3,17,NULL,NULL),(44,3,18,NULL,NULL),(45,3,19,NULL,NULL),(46,3,20,NULL,NULL),(47,3,21,NULL,NULL),(48,3,22,NULL,NULL),(49,3,23,NULL,NULL),(50,3,24,NULL,NULL),(51,3,25,NULL,NULL),(52,4,1,NULL,NULL),(53,4,10,NULL,NULL),(54,4,11,NULL,NULL),(55,4,12,NULL,NULL),(56,4,13,NULL,NULL),(57,4,14,NULL,NULL),(58,4,15,NULL,NULL),(59,4,16,NULL,NULL),(60,4,17,NULL,NULL),(61,4,18,NULL,NULL),(62,4,19,NULL,NULL),(63,4,20,NULL,NULL),(64,4,21,NULL,NULL),(65,4,22,NULL,NULL),(66,4,23,NULL,NULL),(67,4,24,NULL,NULL),(68,4,25,NULL,NULL),(69,5,1,NULL,NULL),(70,5,10,NULL,NULL),(71,5,11,NULL,NULL),(72,5,12,NULL,NULL),(73,5,13,NULL,NULL),(74,5,14,NULL,NULL),(75,5,15,NULL,NULL),(76,5,16,NULL,NULL),(77,5,17,NULL,NULL),(78,5,18,NULL,NULL),(79,5,19,NULL,NULL),(80,5,20,NULL,NULL),(81,5,21,NULL,NULL),(82,5,22,NULL,NULL),(83,5,23,NULL,NULL),(84,5,24,NULL,NULL),(85,5,25,NULL,NULL);
/*!40000 ALTER TABLE `package_modules` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_name` varchar(191) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` bigint(20) unsigned DEFAULT NULL,
  `description` text NOT NULL,
  `annual_price` decimal(16,2) DEFAULT NULL,
  `monthly_price` decimal(16,2) DEFAULT NULL,
  `monthly_status` varchar(191) DEFAULT '1',
  `annual_status` varchar(191) DEFAULT '1',
  `stripe_annual_plan_id` varchar(191) DEFAULT NULL,
  `stripe_monthly_plan_id` varchar(191) DEFAULT NULL,
  `razorpay_annual_plan_id` varchar(191) DEFAULT NULL,
  `razorpay_monthly_plan_id` varchar(191) DEFAULT NULL,
  `flutterwave_annual_plan_id` varchar(191) DEFAULT NULL,
  `flutterwave_monthly_plan_id` varchar(191) DEFAULT NULL,
  `paystack_annual_plan_id` varchar(191) DEFAULT NULL,
  `paystack_monthly_plan_id` varchar(191) DEFAULT NULL,
  `xendit_annual_plan_id` varchar(191) DEFAULT NULL,
  `xendit_monthly_plan_id` varchar(191) DEFAULT NULL,
  `paddle_annual_price_id` varchar(191) DEFAULT NULL,
  `paddle_monthly_price_id` varchar(191) DEFAULT NULL,
  `paddle_lifetime_price_id` varchar(191) DEFAULT NULL,
  `stripe_lifetime_plan_id` varchar(191) DEFAULT NULL,
  `razorpay_lifetime_plan_id` varchar(191) DEFAULT NULL,
  `billing_cycle` tinyint(3) unsigned DEFAULT NULL,
  `sort_order` int(10) unsigned DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `is_free` tinyint(1) NOT NULL DEFAULT 0,
  `is_recommended` tinyint(1) NOT NULL DEFAULT 0,
  `package_type` varchar(191) NOT NULL DEFAULT 'standard',
  `trial_status` tinyint(1) DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL,
  `trial_notification_before_days` int(11) DEFAULT NULL,
  `trial_message` varchar(191) DEFAULT NULL,
  `additional_features` longtext DEFAULT NULL,
  `branch_limit` int(11) DEFAULT -1,
  `multipos_limit` int(11) DEFAULT -1,
  `menu_items_limit` int(11) NOT NULL DEFAULT -1,
  `order_limit` int(11) NOT NULL DEFAULT -1,
  `staff_limit` int(11) NOT NULL DEFAULT -1,
  `ai_monthly_token_limit` int(11) NOT NULL DEFAULT -1,
  `sms_count` int(11) NOT NULL DEFAULT 0,
  `carry_forward_sms` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `packages_currency_id_foreign` (`currency_id`),
  CONSTRAINT `packages_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `global_currencies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (1,'Default',0.00,'2026-05-23 15:17:54','2026-05-23 15:17:54',1,'Its a default package and cannot be deleted',NULL,NULL,'0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,12,1,0,1,0,'default',NULL,NULL,NULL,NULL,NULL,-1,-1,-1,-1,-1,-1,0,0),(2,'Subscription Package',0.00,'2026-05-23 15:17:54','2026-05-23 15:17:54',1,'This is a subscription package',130000.00,13000.00,'1','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,10,2,0,0,1,'standard',NULL,NULL,NULL,NULL,NULL,-1,-1,-1,-1,-1,-1,0,0),(3,'Life Time',259000.00,'2026-05-23 15:17:54','2026-05-23 15:17:54',1,'This is a lifetime access package',NULL,NULL,'0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,3,0,0,1,'lifetime',NULL,NULL,NULL,NULL,'[\"Change Branch\",\"Export Report\",\"Table Reservation\",\"Payment Gateway Integration\",\"Theme Setting\",\"Customer Display\"]',-1,-1,-1,-1,-1,-1,0,0),(4,'Private Package',0.00,'2026-05-23 15:17:54','2026-05-23 15:17:54',1,'This is a private package',65000.00,6500.00,'1','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,12,4,1,0,0,'standard',NULL,NULL,NULL,NULL,NULL,-1,-1,-1,-1,-1,-1,0,0),(5,'Trial Package',0.00,'2026-05-23 15:17:54','2026-05-23 15:17:54',1,'This is a trial package',NULL,NULL,'0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0,1,0,'trial',1,30,5,'30 Days Free Trial','[\"Change Branch\",\"Export Report\",\"Table Reservation\",\"Payment Gateway Integration\",\"Theme Setting\",\"Customer Display\"]',-1,-1,-1,-1,-1,-1,0,0);
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `payfast_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payfast_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payfast_payment_id` varchar(191) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_error_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_error_response`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payfast_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payfast_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `payfast_payments` WRITE;
/*!40000 ALTER TABLE `payfast_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payfast_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `payment_gateway_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_gateway_credentials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `razorpay_key` text DEFAULT NULL,
  `razorpay_secret` text DEFAULT NULL,
  `razorpay_status` tinyint(1) NOT NULL DEFAULT 0,
  `stripe_key` text DEFAULT NULL,
  `stripe_secret` text DEFAULT NULL,
  `stripe_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_dine_in_payment_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_delivery_payment_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_pickup_payment_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_cash_payment_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_qr_payment_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_offline_payment_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `offline_payment_detail` varchar(191) DEFAULT NULL,
  `qr_code_image` varchar(191) DEFAULT NULL,
  `flutterwave_status` tinyint(1) NOT NULL DEFAULT 0,
  `flutterwave_mode` enum('test','live') NOT NULL DEFAULT 'test',
  `test_flutterwave_key` varchar(191) DEFAULT NULL,
  `test_flutterwave_secret` varchar(191) DEFAULT NULL,
  `test_flutterwave_hash` varchar(191) DEFAULT NULL,
  `live_flutterwave_key` varchar(191) DEFAULT NULL,
  `live_flutterwave_secret` varchar(191) DEFAULT NULL,
  `live_flutterwave_hash` varchar(191) DEFAULT NULL,
  `flutterwave_webhook_secret_hash` varchar(191) DEFAULT NULL,
  `paypal_client_id` varchar(191) DEFAULT NULL,
  `paypal_secret` varchar(191) DEFAULT NULL,
  `paypal_status` tinyint(1) NOT NULL DEFAULT 0,
  `paypal_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `sandbox_paypal_client_id` varchar(191) DEFAULT NULL,
  `sandbox_paypal_secret` varchar(191) DEFAULT NULL,
  `payfast_merchant_id` varchar(191) DEFAULT NULL,
  `payfast_merchant_key` varchar(191) DEFAULT NULL,
  `payfast_passphrase` varchar(191) DEFAULT NULL,
  `payfast_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `payfast_status` tinyint(1) NOT NULL DEFAULT 0,
  `test_payfast_merchant_id` varchar(191) DEFAULT NULL,
  `test_payfast_merchant_key` varchar(191) DEFAULT NULL,
  `test_payfast_passphrase` varchar(191) DEFAULT NULL,
  `paystack_key` varchar(191) DEFAULT NULL,
  `paystack_secret` varchar(191) DEFAULT NULL,
  `paystack_merchant_email` varchar(191) DEFAULT NULL,
  `paystack_status` tinyint(1) NOT NULL DEFAULT 0,
  `paystack_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `test_paystack_key` varchar(191) DEFAULT NULL,
  `test_paystack_secret` varchar(191) DEFAULT NULL,
  `test_paystack_merchant_email` varchar(191) DEFAULT NULL,
  `paystack_payment_url` varchar(191) DEFAULT 'https://api.paystack.co',
  `xendit_status` tinyint(1) NOT NULL DEFAULT 0,
  `xendit_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `test_xendit_public_key` varchar(191) DEFAULT NULL,
  `test_xendit_secret_key` varchar(191) DEFAULT NULL,
  `live_xendit_public_key` varchar(191) DEFAULT NULL,
  `live_xendit_secret_key` varchar(191) DEFAULT NULL,
  `test_xendit_webhook_token` varchar(191) DEFAULT NULL,
  `live_xendit_webhook_token` varchar(191) DEFAULT NULL,
  `epay_status` tinyint(1) NOT NULL DEFAULT 0,
  `epay_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `epay_client_id` varchar(191) DEFAULT NULL,
  `epay_client_secret` varchar(191) DEFAULT NULL,
  `epay_terminal_id` varchar(191) DEFAULT NULL,
  `test_epay_client_id` varchar(191) DEFAULT NULL,
  `test_epay_client_secret` varchar(191) DEFAULT NULL,
  `test_epay_terminal_id` varchar(191) DEFAULT NULL,
  `mollie_status` tinyint(1) NOT NULL DEFAULT 0,
  `mollie_mode` enum('test','live') NOT NULL DEFAULT 'test',
  `test_mollie_key` varchar(191) DEFAULT NULL,
  `live_mollie_key` varchar(191) DEFAULT NULL,
  `mollie_webhook_secret` varchar(191) DEFAULT NULL,
  `tap_status` tinyint(1) NOT NULL DEFAULT 0,
  `tap_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `tap_merchant_id` varchar(191) DEFAULT NULL,
  `live_tap_secret_key` text DEFAULT NULL,
  `live_tap_public_key` text DEFAULT NULL,
  `test_tap_secret_key` text DEFAULT NULL,
  `test_tap_public_key` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_gateway_credentials_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `payment_gateway_credentials_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `payment_gateway_credentials` WRITE;
/*!40000 ALTER TABLE `payment_gateway_credentials` DISABLE KEYS */;
INSERT INTO `payment_gateway_credentials` VALUES (1,1,NULL,NULL,0,NULL,NULL,0,'2026-05-23 15:17:55','2026-05-23 15:17:55',0,0,0,0,0,0,NULL,NULL,0,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,'sandbox',0,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,'https://api.paystack.co',0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,0,'test',NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL),(2,2,NULL,NULL,0,NULL,NULL,0,'2026-05-23 15:17:55','2026-05-23 15:17:55',0,0,0,0,0,0,NULL,NULL,0,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,'sandbox',0,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,'https://api.paystack.co',0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,0,'test',NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL),(3,3,NULL,NULL,0,NULL,NULL,0,'2026-05-23 15:17:56','2026-05-23 15:17:56',0,0,0,0,0,0,NULL,NULL,0,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,'sandbox',0,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,'https://api.paystack.co',0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,0,'test',NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `payment_gateway_credentials` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `payment_method` varchar(191) NOT NULL DEFAULT 'cash',
  `amount` decimal(16,2) NOT NULL,
  `is_due` tinyint(1) NOT NULL DEFAULT 0,
  `due_amount_received` decimal(16,2) DEFAULT NULL,
  `balance` decimal(16,2) DEFAULT 0.00,
  `transaction_id` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`),
  KEY `payments_branch_id_foreign` (`branch_id`),
  CONSTRAINT `payments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,1,'upi',37760.00,0,NULL,0.00,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,2,'upi',10620.00,0,NULL,0.00,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,3,'cash',9912.00,0,NULL,0.00,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,4,'card',22774.00,0,NULL,0.00,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,1,5,'upi',12508.00,0,NULL,0.00,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,1,6,'upi',18998.00,0,NULL,0.00,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,1,7,'card',31978.00,0,NULL,0.00,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(8,1,8,'card',4720.00,0,NULL,0.00,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(9,1,9,'card',20650.00,0,NULL,0.00,NULL,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(10,3,10,'cash',22538.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(11,3,11,'cash',20296.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(12,3,12,'cash',24662.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(13,3,13,'upi',20768.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(14,3,14,'cash',12390.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(15,3,15,'card',44132.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(16,3,16,'card',28910.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(17,3,17,'cash',21240.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(18,3,18,'card',17700.00,0,NULL,0.00,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(19,5,19,'card',20060.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(20,5,20,'upi',2360.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(21,5,21,'cash',17110.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(22,5,22,'cash',28792.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(23,5,23,'card',4956.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(24,5,24,'upi',12036.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(25,5,25,'card',21830.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(26,5,26,'cash',5310.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(27,5,27,'upi',22892.00,0,NULL,0.00,NULL,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `paypal_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paypal_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paypal_payment_id` varchar(191) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_error_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_error_response`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paypal_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `paypal_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `paypal_payments` WRITE;
/*!40000 ALTER TABLE `paypal_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `paypal_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `paystack_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paystack_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paystack_payment_id` varchar(191) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_error_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_error_response`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paystack_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `paystack_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `paystack_payments` WRITE;
/*!40000 ALTER TABLE `paystack_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `paystack_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `module_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  KEY `permissions_module_id_foreign` (`module_id`),
  CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Create Restaurant','web',2,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(2,'Show Restaurant','web',2,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(3,'Update Restaurant','web',2,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(4,'Delete Restaurant','web',2,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(5,'Show Superadmin Payments','web',3,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(6,'Create Package','web',4,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(7,'Show Package','web',4,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(8,'Update Package','web',4,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(9,'Delete Package','web',4,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(10,'Show Billing','web',5,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(11,'Show Offline Request','web',6,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(12,'Create SuperAdmin','web',7,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(13,'Show SuperAdmin','web',7,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(14,'Update SuperAdmin','web',7,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(15,'Delete SuperAdmin','web',7,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(16,'Show Landing Site','web',8,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(17,'Manage Superadmin Settings','web',9,'2026-05-23 15:17:53','2026-05-23 15:17:53'),(18,'Create Menu','web',10,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(19,'Show Menu','web',10,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(20,'Update Menu','web',10,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(21,'Delete Menu','web',10,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(22,'Create Menu Item','web',11,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(23,'Show Menu Item','web',11,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(24,'Update Menu Item','web',11,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(25,'Delete Menu Item','web',11,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(26,'Export Menu Item','web',11,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(27,'Create Item Category','web',12,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(28,'Show Item Category','web',12,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(29,'Update Item Category','web',12,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(30,'Delete Item Category','web',12,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(31,'Create Area','web',13,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(32,'Show Area','web',13,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(33,'Update Area','web',13,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(34,'Delete Area','web',13,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(35,'Create Table','web',14,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(36,'Show Table','web',14,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(37,'Update Table','web',14,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(38,'Delete Table','web',14,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(39,'Create Reservation','web',15,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(40,'Show Reservation','web',15,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(41,'Update Reservation','web',15,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(42,'Delete Reservation','web',15,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(43,'Manage KOT','web',16,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(44,'Create Order','web',17,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(45,'Show Order','web',17,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(46,'Update Order','web',17,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(47,'Delete Order','web',17,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(48,'Add Discount on POS','web',17,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(49,'Create Customer','web',18,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(50,'Show Customer','web',18,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(51,'Update Customer','web',18,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(52,'Delete Customer','web',18,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(53,'Create Staff Member','web',19,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(54,'Show Staff Member','web',19,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(55,'Update Staff Member','web',19,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(56,'Delete Staff Member','web',19,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(57,'Create Delivery Executive','web',21,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(58,'Show Delivery Executive','web',21,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(59,'Update Delivery Executive','web',21,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(60,'Delete Delivery Executive','web',21,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(61,'Show Payments','web',24,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(62,'Refund Payments','web',24,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(63,'Show Reports','web',20,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(64,'Manage Settings','web',25,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(65,'Show Restaurant Open/Close','web',25,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(66,'Manage Waiter Request','web',22,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(67,'Create Expense','web',23,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(68,'Show Expense','web',23,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(69,'Update Expense','web',23,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(70,'Delete Expense','web',23,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(71,'Create Expense Category','web',23,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(72,'Show Expense Category','web',23,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(73,'Update Expense Category','web',23,'2026-05-23 15:17:54','2026-05-23 15:17:54'),(74,'Delete Expense Category','web',23,'2026-05-23 15:17:54','2026-05-23 15:17:54');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `predefined_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `predefined_amounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `predefined_amounts_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `predefined_amounts_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `predefined_amounts` WRITE;
/*!40000 ALTER TABLE `predefined_amounts` DISABLE KEYS */;
INSERT INTO `predefined_amounts` VALUES (1,1,50.00,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,100.00,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,1,500.00,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,1,1000.00,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(5,2,50.00,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(6,2,100.00,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(7,2,500.00,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(8,2,1000.00,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(9,3,50.00,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(10,3,100.00,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(11,3,500.00,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(12,3,1000.00,'2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `predefined_amounts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `print_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `print_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `printer_id` bigint(20) unsigned DEFAULT NULL,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `status` enum('done','failed','printing','pending') DEFAULT 'pending',
  `error` text DEFAULT NULL,
  `response_printer` varchar(191) DEFAULT NULL,
  `image_filename` varchar(191) DEFAULT NULL,
  `printed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `print_jobs_printer_id_foreign` (`printer_id`),
  KEY `print_jobs_restaurant_id_foreign` (`restaurant_id`),
  KEY `print_jobs_branch_id_foreign` (`branch_id`),
  CONSTRAINT `print_jobs_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `print_jobs_printer_id_foreign` FOREIGN KEY (`printer_id`) REFERENCES `printers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `print_jobs_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `print_jobs` WRITE;
/*!40000 ALTER TABLE `print_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `print_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `printers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `printing_choice` varchar(191) DEFAULT NULL,
  `print_type` enum('image','pdf') NOT NULL DEFAULT 'image',
  `kots` text DEFAULT NULL,
  `orders` text DEFAULT NULL,
  `print_format` varchar(191) DEFAULT NULL,
  `invoice_qr_code` int(11) DEFAULT NULL,
  `open_cash_drawer` enum('yes','no') DEFAULT NULL,
  `share_name` varchar(191) DEFAULT NULL,
  `type` enum('network','windows','linux','default') DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `printer_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `printers_restaurant_id_foreign` (`restaurant_id`),
  KEY `printers_branch_id_foreign` (`branch_id`),
  CONSTRAINT `printers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `printers_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `printers` WRITE;
/*!40000 ALTER TABLE `printers` DISABLE KEYS */;
INSERT INTO `printers` VALUES (1,1,1,'Default Printer','browserPopupPrint','image','[1]','[1]',NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,2,'Default Printer','browserPopupPrint','image','[2]','[2]',NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,2,3,'Default Printer','browserPopupPrint','image','[3]','[3]',NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,2,4,'Default Printer','browserPopupPrint','image','[4]','[4]',NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(5,3,5,'Default Printer','browserPopupPrint','image','[5]','[5]',NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(6,3,6,'Default Printer','browserPopupPrint','image','[6]','[6]',NULL,NULL,NULL,NULL,NULL,1,1,NULL,'2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `printers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `push_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `endpoint` varchar(191) NOT NULL,
  `public_key` text DEFAULT NULL,
  `auth_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `push_notifications_endpoint_unique` (`endpoint`),
  KEY `push_notifications_restaurant_id_foreign` (`restaurant_id`),
  KEY `push_notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `push_notifications_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `push_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `push_notifications` WRITE;
/*!40000 ALTER TABLE `push_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_notifications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pusher_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pusher_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `beamer_status` tinyint(1) NOT NULL DEFAULT 0,
  `instance_id` varchar(191) DEFAULT NULL,
  `beam_secret` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pusher_broadcast` tinyint(1) NOT NULL DEFAULT 0,
  `pusher_app_id` varchar(191) DEFAULT NULL,
  `pusher_key` varchar(191) DEFAULT NULL,
  `pusher_secret` varchar(191) DEFAULT NULL,
  `pusher_cluster` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pusher_settings` WRITE;
/*!40000 ALTER TABLE `pusher_settings` DISABLE KEYS */;
INSERT INTO `pusher_settings` VALUES (1,0,NULL,NULL,'2026-05-23 15:17:41','2026-05-23 15:17:41',0,NULL,NULL,NULL,NULL),(2,0,NULL,NULL,'2026-05-23 15:17:56','2026-05-23 15:17:56',0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `pusher_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `razorpay_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `razorpay_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `payment_status` enum('pending','requested','declined','completed') NOT NULL DEFAULT 'pending',
  `payment_error_response` text DEFAULT NULL,
  `razorpay_order_id` varchar(191) DEFAULT NULL,
  `razorpay_payment_id` varchar(191) DEFAULT NULL,
  `razorpay_signature` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `razorpay_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `razorpay_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `razorpay_payments` WRITE;
/*!40000 ALTER TABLE `razorpay_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `razorpay_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `receipt_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipt_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `show_customer_name` tinyint(1) NOT NULL DEFAULT 0,
  `show_customer_address` tinyint(1) NOT NULL DEFAULT 0,
  `show_customer_phone` tinyint(1) NOT NULL DEFAULT 0,
  `show_table_number` tinyint(1) NOT NULL DEFAULT 0,
  `payment_qr_code` varchar(191) DEFAULT NULL,
  `show_payment_qr_code` tinyint(1) NOT NULL DEFAULT 0,
  `show_waiter` tinyint(1) NOT NULL DEFAULT 0,
  `show_total_guest` tinyint(1) NOT NULL DEFAULT 0,
  `show_restaurant_logo` tinyint(1) NOT NULL DEFAULT 0,
  `show_restaurant_name` tinyint(1) NOT NULL DEFAULT 1,
  `show_branch_name` tinyint(1) NOT NULL DEFAULT 0,
  `show_branch_address` tinyint(1) NOT NULL DEFAULT 0,
  `show_cr_number` tinyint(1) NOT NULL DEFAULT 0,
  `show_vat_number` tinyint(1) NOT NULL DEFAULT 0,
  `show_tax` tinyint(1) NOT NULL DEFAULT 0,
  `show_payment_details` tinyint(1) NOT NULL DEFAULT 1,
  `show_payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `show_order_type` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipt_settings_restaurant_id_foreign` (`restaurant_id`),
  KEY `receipt_settings_branch_id_foreign` (`branch_id`),
  CONSTRAINT `receipt_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `receipt_settings_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `receipt_settings` WRITE;
/*!40000 ALTER TABLE `receipt_settings` DISABLE KEYS */;
INSERT INTO `receipt_settings` VALUES (1,1,1,0,0,0,0,NULL,0,0,0,0,1,0,0,0,0,0,1,0,0,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,2,0,0,0,0,NULL,0,0,0,0,1,0,0,0,0,0,1,0,0,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,2,3,0,0,0,0,NULL,0,0,0,0,1,0,0,0,0,0,1,0,0,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,2,4,0,0,0,0,NULL,0,0,0,0,1,0,0,0,0,0,1,0,0,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(5,3,5,0,0,0,0,NULL,0,0,0,0,1,0,0,0,0,0,1,0,0,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(6,3,6,0,0,0,0,NULL,0,0,0,0,1,0,0,0,0,0,1,0,0,'2026-05-23 15:17:56','2026-05-23 15:17:56');
/*!40000 ALTER TABLE `receipt_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `refund_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refund_reasons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `refund_reasons_branch_id_foreign` (`branch_id`),
  CONSTRAINT `refund_reasons_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `refund_reasons` WRITE;
/*!40000 ALTER TABLE `refund_reasons` DISABLE KEYS */;
INSERT INTO `refund_reasons` VALUES (1,1,'The item was prepared but returned by the customer.','2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,'The item was delivered but rejected.','2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,'A mistake in the order.','2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,'Product quality issue.','2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,3,'The item was prepared but returned by the customer.','2026-05-23 15:17:58','2026-05-23 15:17:58'),(6,3,'The item was delivered but rejected.','2026-05-23 15:17:58','2026-05-23 15:17:58'),(7,3,'A mistake in the order.','2026-05-23 15:17:58','2026-05-23 15:17:58'),(8,3,'Product quality issue.','2026-05-23 15:17:58','2026-05-23 15:17:58'),(9,5,'The item was prepared but returned by the customer.','2026-05-23 15:17:59','2026-05-23 15:17:59'),(10,5,'The item was delivered but rejected.','2026-05-23 15:17:59','2026-05-23 15:17:59'),(11,5,'A mistake in the order.','2026-05-23 15:17:59','2026-05-23 15:17:59'),(12,5,'Product quality issue.','2026-05-23 15:17:59','2026-05-23 15:17:59');
/*!40000 ALTER TABLE `refund_reasons` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `refunds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refunds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `payment_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `delivery_app_id` bigint(20) unsigned DEFAULT NULL,
  `refund_reason_id` bigint(20) unsigned DEFAULT NULL,
  `refund_type` enum('full','partial','waste') NOT NULL DEFAULT 'full',
  `partial_refund_type` enum('half','fixed','custom') DEFAULT NULL,
  `amount` decimal(16,2) NOT NULL,
  `commission_adjustment` decimal(16,2) DEFAULT NULL,
  `status` enum('pending','processed','failed','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `processed_by` bigint(20) unsigned DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `refunds_branch_id_foreign` (`branch_id`),
  KEY `refunds_payment_id_foreign` (`payment_id`),
  KEY `refunds_order_id_foreign` (`order_id`),
  KEY `refunds_delivery_app_id_foreign` (`delivery_app_id`),
  KEY `refunds_refund_reason_id_foreign` (`refund_reason_id`),
  KEY `refunds_processed_by_foreign` (`processed_by`),
  CONSTRAINT `refunds_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `refunds_delivery_app_id_foreign` FOREIGN KEY (`delivery_app_id`) REFERENCES `delivery_platforms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `refunds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `refunds_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `refunds_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `refunds_refund_reason_id_foreign` FOREIGN KEY (`refund_reason_id`) REFERENCES `refund_reasons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `refunds` WRITE;
/*!40000 ALTER TABLE `refunds` DISABLE KEYS */;
/*!40000 ALTER TABLE `refunds` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `reservation_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `time_slot_start` time NOT NULL,
  `time_slot_end` time NOT NULL,
  `time_slot_difference` int(11) NOT NULL,
  `slot_type` enum('Breakfast','Lunch','Dinner') NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_settings_branch_id_foreign` (`branch_id`),
  CONSTRAINT `reservation_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `reservation_settings` WRITE;
/*!40000 ALTER TABLE `reservation_settings` DISABLE KEYS */;
INSERT INTO `reservation_settings` VALUES (1,1,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(2,1,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(3,1,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(4,1,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(5,1,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(6,1,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(7,1,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(8,1,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(9,1,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(10,1,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(11,1,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(12,1,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(13,1,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(14,1,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(15,1,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(16,1,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(17,1,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(18,1,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(19,1,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(20,1,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(21,1,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(22,2,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(23,2,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(24,2,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(25,2,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(26,2,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(27,2,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(28,2,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(29,2,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(30,2,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(31,2,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(32,2,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(33,2,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(34,2,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(35,2,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(36,2,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(37,2,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(38,2,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(39,2,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(40,2,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(41,2,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(42,2,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(43,3,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(44,3,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(45,3,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(46,3,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(47,3,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(48,3,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(49,3,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(50,3,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(51,3,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(52,3,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(53,3,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(54,3,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(55,3,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(56,3,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(57,3,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(58,3,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(59,3,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(60,3,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(61,3,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(62,3,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(63,3,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:55','2026-05-23 15:17:55'),(64,4,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(65,4,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(66,4,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(67,4,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(68,4,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(69,4,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(70,4,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(71,4,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(72,4,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(73,4,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(74,4,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(75,4,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(76,4,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(77,4,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(78,4,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(79,4,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(80,4,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(81,4,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(82,4,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(83,4,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(84,4,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(85,5,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(86,5,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(87,5,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(88,5,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(89,5,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(90,5,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(91,5,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(92,5,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(93,5,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(94,5,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(95,5,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(96,5,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(97,5,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(98,5,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(99,5,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(100,5,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(101,5,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(102,5,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(103,5,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(104,5,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(105,5,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(106,6,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(107,6,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(108,6,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(109,6,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(110,6,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(111,6,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(112,6,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(113,6,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(114,6,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(115,6,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(116,6,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(117,6,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(118,6,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(119,6,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(120,6,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(121,6,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(122,6,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(123,6,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(124,6,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(125,6,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(126,6,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:56','2026-05-23 15:17:56'),(127,1,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(128,1,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(129,1,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(130,1,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(131,1,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(132,1,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(133,1,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(134,1,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(135,1,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(136,1,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(137,1,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(138,1,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(139,1,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(140,1,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(141,1,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(142,1,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(143,1,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(144,1,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(145,1,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(146,1,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(147,1,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(148,3,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(149,3,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(150,3,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(151,3,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(152,3,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(153,3,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(154,3,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(155,3,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(156,3,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(157,3,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(158,3,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(159,3,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(160,3,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(161,3,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(162,3,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(163,3,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(164,3,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(165,3,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(166,3,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(167,3,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(168,3,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(169,5,'Monday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(170,5,'Monday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(171,5,'Monday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(172,5,'Tuesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(173,5,'Tuesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(174,5,'Tuesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(175,5,'Wednesday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(176,5,'Wednesday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(177,5,'Wednesday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(178,5,'Thursday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(179,5,'Thursday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(180,5,'Thursday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(181,5,'Friday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(182,5,'Friday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(183,5,'Friday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(184,5,'Saturday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(185,5,'Saturday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(186,5,'Saturday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(187,5,'Sunday','08:00:00','11:00:00',30,'Breakfast',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(188,5,'Sunday','12:00:00','17:00:00',60,'Lunch',1,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(189,5,'Sunday','18:00:00','22:00:00',60,'Dinner',1,'2026-05-23 15:17:59','2026-05-23 15:17:59');
/*!40000 ALTER TABLE `reservation_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `table_id` bigint(20) unsigned DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `reservation_date_time` datetime NOT NULL,
  `party_size` int(11) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `reservation_status` enum('Pending','Confirmed','Checked_In','Cancelled','No_Show') NOT NULL DEFAULT 'Confirmed',
  `reservation_slot_type` enum('Breakfast','Lunch','Dinner') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slot_time_difference` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_table_id_foreign` (`table_id`),
  KEY `reservations_customer_id_foreign` (`customer_id`),
  KEY `reservations_branch_id_foreign` (`branch_id`),
  CONSTRAINT `reservations_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `reservations_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `restaurant_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `charge_name` varchar(191) NOT NULL,
  `charge_type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `charge_value` decimal(16,2) DEFAULT NULL,
  `order_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Supported order types: DineIn, Delivery, PickUp' CHECK (json_valid(`order_types`)),
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_charges_restaurant_id_foreign` (`restaurant_id`),
  KEY `restaurant_charges_charge_name_index` (`charge_name`),
  CONSTRAINT `restaurant_charges_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `restaurant_charges` WRITE;
/*!40000 ALTER TABLE `restaurant_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_charges` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `restaurant_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `payment_source` enum('official_site','app_sumo') NOT NULL DEFAULT 'official_site',
  `razorpay_order_id` varchar(191) DEFAULT NULL,
  `razorpay_payment_id` varchar(191) DEFAULT NULL,
  `razorpay_signature` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `reference_id` varchar(191) DEFAULT NULL,
  `payment_date_time` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_payment_intent` varchar(191) DEFAULT NULL,
  `stripe_session_id` text DEFAULT NULL,
  `package_id` bigint(20) unsigned DEFAULT NULL,
  `package_type` varchar(191) DEFAULT NULL,
  `currency_id` varchar(191) DEFAULT NULL,
  `flutterwave_transaction_id` varchar(191) DEFAULT NULL,
  `flutterwave_payment_ref` varchar(191) DEFAULT NULL,
  `paypal_payment_id` varchar(191) DEFAULT NULL,
  `mollie_payment_id` varchar(191) DEFAULT NULL,
  `mollie_customer_id` varchar(191) DEFAULT NULL,
  `mollie_subscription_id` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_payments_restaurant_id_foreign` (`restaurant_id`),
  KEY `restaurant_payments_package_id_foreign` (`package_id`),
  CONSTRAINT `restaurant_payments_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restaurant_payments_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `restaurant_payments` WRITE;
/*!40000 ALTER TABLE `restaurant_payments` DISABLE KEYS */;
INSERT INTO `restaurant_payments` VALUES (1,1,130000.00,'paid','official_site',NULL,NULL,NULL,NULL,NULL,'2026-05-23 17:17:58','2026-05-23 15:17:58','2026-05-23 15:17:58',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,2,130000.00,'paid','official_site',NULL,NULL,NULL,NULL,NULL,'2026-05-23 17:17:59','2026-05-23 15:17:59','2026-05-23 15:17:59',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,3,130000.00,'paid','official_site',NULL,NULL,NULL,NULL,NULL,'2026-05-23 17:18:00','2026-05-23 15:18:00','2026-05-23 15:18:00',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `restaurant_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `restaurant_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_taxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `tax_id` varchar(191) DEFAULT NULL,
  `tax_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_taxes_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `restaurant_taxes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `restaurant_taxes` WRITE;
/*!40000 ALTER TABLE `restaurant_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_taxes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `hash` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `phone_code` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `timezone` varchar(191) NOT NULL,
  `time_format` varchar(191) NOT NULL DEFAULT 'h:i A',
  `date_format` varchar(191) NOT NULL DEFAULT 'd/m/Y',
  `theme_hex` varchar(191) NOT NULL,
  `theme_rgb` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `hide_new_orders` tinyint(1) NOT NULL DEFAULT 0,
  `hide_new_reservations` tinyint(1) NOT NULL DEFAULT 0,
  `hide_new_waiter_request` tinyint(1) NOT NULL DEFAULT 0,
  `currency_id` bigint(20) unsigned DEFAULT NULL,
  `license_type` enum('free','paid') NOT NULL DEFAULT 'free',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_login_required` tinyint(1) NOT NULL DEFAULT 0,
  `about_us` longtext DEFAULT NULL,
  `allow_customer_delivery_orders` tinyint(1) NOT NULL DEFAULT 1,
  `allow_customer_pickup_orders` tinyint(1) NOT NULL DEFAULT 1,
  `pickup_days_range` int(11) DEFAULT 7,
  `allow_customer_orders` tinyint(1) NOT NULL DEFAULT 1,
  `allow_dine_in_orders` tinyint(1) NOT NULL DEFAULT 1,
  `show_veg` tinyint(1) NOT NULL DEFAULT 1,
  `show_halal` tinyint(1) NOT NULL DEFAULT 0,
  `package_id` bigint(20) unsigned DEFAULT NULL,
  `package_type` varchar(191) DEFAULT NULL,
  `status` enum('active','inactive','license_expired') NOT NULL DEFAULT 'active',
  `license_expire_on` datetime DEFAULT NULL,
  `trial_ends_at` datetime DEFAULT NULL,
  `license_updated_at` datetime DEFAULT NULL,
  `subscription_updated_at` datetime DEFAULT NULL,
  `stripe_id` varchar(191) DEFAULT NULL,
  `pm_type` varchar(191) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `is_waiter_request_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `default_table_reservation_status` varchar(191) NOT NULL DEFAULT 'Confirmed',
  `disable_slot_minutes` int(11) NOT NULL DEFAULT 30,
  `approval_status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Approved',
  `rejection_reason` text DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `yelp_link` varchar(255) DEFAULT NULL,
  `google_business_link` varchar(255) DEFAULT NULL,
  `wifi_name` varchar(191) DEFAULT NULL,
  `wifi_password` varchar(191) DEFAULT NULL,
  `show_wifi_icon` tinyint(1) NOT NULL DEFAULT 0,
  `table_required` tinyint(1) NOT NULL DEFAULT 0,
  `show_logo_text` tinyint(1) NOT NULL DEFAULT 1,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `upload_fav_icon_android_chrome_192` varchar(191) DEFAULT NULL,
  `upload_fav_icon_android_chrome_512` varchar(191) DEFAULT NULL,
  `upload_fav_icon_apple_touch_icon` varchar(191) DEFAULT NULL,
  `upload_favicon_16` varchar(191) DEFAULT NULL,
  `upload_favicon_32` varchar(191) DEFAULT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `is_waiter_request_enabled_on_desktop` tinyint(1) NOT NULL DEFAULT 1,
  `is_waiter_request_enabled_on_mobile` tinyint(1) NOT NULL DEFAULT 1,
  `is_waiter_request_enabled_open_by_qr` tinyint(1) NOT NULL DEFAULT 0,
  `webmanifest` varchar(191) DEFAULT NULL,
  `enable_tip_shop` tinyint(1) NOT NULL DEFAULT 1,
  `enable_tip_pos` tinyint(1) NOT NULL DEFAULT 1,
  `is_pwa_install_alert_show` tinyint(1) NOT NULL DEFAULT 0,
  `auto_confirm_orders` tinyint(1) NOT NULL DEFAULT 0,
  `auto_confirm_orders_before_payment` tinyint(1) NOT NULL DEFAULT 0,
  `auto_confirm_orders_after_payment` tinyint(1) NOT NULL DEFAULT 0,
  `restrict_qr_order_by_location` tinyint(1) NOT NULL DEFAULT 0,
  `qr_order_radius_meters` int(10) unsigned DEFAULT NULL,
  `show_order_type_options` tinyint(1) NOT NULL DEFAULT 1,
  `disable_order_type_popup` tinyint(1) NOT NULL DEFAULT 0,
  `restaurant_open_close_mode` enum('auto','manual') NOT NULL DEFAULT 'auto',
  `restaurant_manual_open_close_type` enum('time','toggle') NOT NULL DEFAULT 'time',
  `manual_open_time` time DEFAULT NULL,
  `manual_close_time` time DEFAULT NULL,
  `is_temporarily_closed` tinyint(1) NOT NULL DEFAULT 0,
  `default_order_type_id` bigint(20) unsigned DEFAULT NULL,
  `hide_menu_item_image_on_pos` tinyint(1) NOT NULL DEFAULT 0,
  `hide_menu_item_image_on_customer_site` tinyint(1) NOT NULL DEFAULT 0,
  `tax_mode` enum('order','item') NOT NULL DEFAULT 'order',
  `tax_inclusive` tinyint(1) NOT NULL DEFAULT 0,
  `include_charges_in_tax_base` tinyint(1) NOT NULL DEFAULT 0,
  `customer_site_language` varchar(191) DEFAULT NULL,
  `enable_admin_reservation` tinyint(1) NOT NULL DEFAULT 1,
  `enable_customer_reservation` tinyint(1) NOT NULL DEFAULT 1,
  `minimum_party_size` int(11) NOT NULL DEFAULT 1,
  `table_lock_timeout_minutes` int(11) NOT NULL DEFAULT 10,
  `mollie_customer_id` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_settings_country_id_foreign` (`country_id`),
  KEY `restaurant_settings_currency_id_foreign` (`currency_id`),
  KEY `restaurants_package_id_foreign` (`package_id`),
  KEY `restaurants_default_order_type_id_foreign` (`default_order_type_id`),
  CONSTRAINT `restaurant_settings_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restaurant_settings_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restaurants_default_order_type_id_foreign` FOREIGN KEY (`default_order_type_id`) REFERENCES `order_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `restaurants_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (1,'Demo Restaurant','demo-restaurant','8840 Champlin Ports Suite 543\nWest Danaside, GA 57088-8594','+14406808522',NULL,'demo.restaurant@example.com','America/New_York','h:i A','d/m/Y','#A78BFA','167, 139, 250',NULL,236,0,0,0,1,'paid',1,'2026-05-23 15:17:55','2026-05-23 15:17:58',0,'<p class=\"text-lg text-gray-600 mb-6\">\n          Welcome to our restaurant, where great food and good vibes come together! We\'re a local, family-owned spot that loves bringing people together over delicious meals and unforgettable moments. Whether you\'re here for a quick bite, a family dinner, or a celebration, we\'re all about making your time with us special.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          Our menu is packed with dishes made from fresh, quality ingredients because we believe food should taste as\n          good as it makes you feel. From our signature dishes to seasonal specials, there\'s always something to excite\n          your taste buds.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          But we\'re not just about the foodΓÇöwe\'re about community. We love seeing familiar faces and welcoming new ones.\n          Our team is a fun, friendly bunch dedicated to serving you with a smile and making sure every visit feels like\n          coming home.\n        </p>\n        <p class=\"text-lg text-gray-600\">\n          So, come on in, grab a seat, and let us take care of the rest. We can\'t wait to share our love of food with\n          you!\n        </p>\n        <p class=\"text-lg text-gray-800 font-semibold mt-6\">See you soon! ≡ƒì╜∩╕ÅΓ£¿</p>',1,1,7,1,1,1,0,5,'trial','active','2026-06-22 17:17:55','2026-06-22 17:17:55','2026-05-23 17:17:55','2026-05-23 17:17:55',NULL,NULL,NULL,1,'Confirmed',30,'Approved',NULL,'https://www.facebook.com/','https://www.instagram.com/','https://www.twitter.com/',NULL,'https://business.google.com/',NULL,NULL,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,0,NULL,1,1,0,0,0,0,0,NULL,1,0,'auto','time',NULL,NULL,0,NULL,0,0,'order',0,0,'en',1,1,1,10,NULL),(2,'Spice Symphony','spice-symphony','898 Hintz Streets\nNew Susanna, DE 06571','+19087151682',NULL,'spice.symphony@example.com','America/New_York','h:i A','d/m/Y','#A78BFA','167, 139, 250',NULL,236,0,0,0,5,'paid',1,'2026-05-23 15:17:55','2026-05-23 15:17:59',0,'<p class=\"text-lg text-gray-600 mb-6\">\n          Welcome to our restaurant, where great food and good vibes come together! We\'re a local, family-owned spot that loves bringing people together over delicious meals and unforgettable moments. Whether you\'re here for a quick bite, a family dinner, or a celebration, we\'re all about making your time with us special.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          Our menu is packed with dishes made from fresh, quality ingredients because we believe food should taste as\n          good as it makes you feel. From our signature dishes to seasonal specials, there\'s always something to excite\n          your taste buds.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          But we\'re not just about the foodΓÇöwe\'re about community. We love seeing familiar faces and welcoming new ones.\n          Our team is a fun, friendly bunch dedicated to serving you with a smile and making sure every visit feels like\n          coming home.\n        </p>\n        <p class=\"text-lg text-gray-600\">\n          So, come on in, grab a seat, and let us take care of the rest. We can\'t wait to share our love of food with\n          you!\n        </p>\n        <p class=\"text-lg text-gray-800 font-semibold mt-6\">See you soon! ≡ƒì╜∩╕ÅΓ£¿</p>',1,1,7,1,1,1,0,5,'trial','active','2026-06-22 17:17:55','2026-06-22 17:17:55','2026-05-23 17:17:55','2026-05-23 17:17:55',NULL,NULL,NULL,1,'Confirmed',30,'Approved',NULL,'https://www.facebook.com/','https://www.instagram.com/','https://www.twitter.com/',NULL,'https://business.google.com/',NULL,NULL,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,0,NULL,1,1,0,0,0,0,0,NULL,1,0,'auto','time',NULL,NULL,0,NULL,0,0,'order',0,0,'en',1,1,1,10,NULL),(3,'Bombay Delight','bombay-delight','55067 Schimmel Viaduct Apt. 310\nArmstrongstad, RI 93506-2546','+13526687918',NULL,'bombay.delight@example.com','America/New_York','h:i A','d/m/Y','#A78BFA','167, 139, 250',NULL,236,0,0,0,9,'paid',1,'2026-05-23 15:17:56','2026-05-23 15:18:00',0,'<p class=\"text-lg text-gray-600 mb-6\">\n          Welcome to our restaurant, where great food and good vibes come together! We\'re a local, family-owned spot that loves bringing people together over delicious meals and unforgettable moments. Whether you\'re here for a quick bite, a family dinner, or a celebration, we\'re all about making your time with us special.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          Our menu is packed with dishes made from fresh, quality ingredients because we believe food should taste as\n          good as it makes you feel. From our signature dishes to seasonal specials, there\'s always something to excite\n          your taste buds.\n        </p>\n        <p class=\"text-lg text-gray-600 mb-6\">\n          But we\'re not just about the foodΓÇöwe\'re about community. We love seeing familiar faces and welcoming new ones.\n          Our team is a fun, friendly bunch dedicated to serving you with a smile and making sure every visit feels like\n          coming home.\n        </p>\n        <p class=\"text-lg text-gray-600\">\n          So, come on in, grab a seat, and let us take care of the rest. We can\'t wait to share our love of food with\n          you!\n        </p>\n        <p class=\"text-lg text-gray-800 font-semibold mt-6\">See you soon! ≡ƒì╜∩╕ÅΓ£¿</p>',1,1,7,1,1,1,0,5,'trial','active','2026-06-22 17:17:56','2026-06-22 17:17:56','2026-05-23 17:17:56','2026-05-23 17:17:56',NULL,NULL,NULL,1,'Confirmed',30,'Approved',NULL,'https://www.facebook.com/','https://www.instagram.com/','https://www.twitter.com/',NULL,'https://business.google.com/',NULL,NULL,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,0,NULL,1,1,0,0,0,0,0,NULL,1,0,'auto','time',NULL,NULL,0,NULL,0,0,'order',0,0,'en',1,1,1,10,NULL);
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,2),(18,3),(18,6),(18,7),(18,10),(18,11),(19,2),(19,3),(19,6),(19,7),(19,10),(19,11),(20,2),(20,3),(20,6),(20,7),(20,10),(20,11),(21,2),(21,3),(21,6),(21,7),(21,10),(21,11),(22,2),(22,3),(22,6),(22,7),(22,10),(22,11),(23,2),(23,3),(23,6),(23,7),(23,10),(23,11),(24,2),(24,3),(24,6),(24,7),(24,10),(24,11),(25,2),(25,3),(25,6),(25,7),(25,10),(25,11),(26,2),(26,3),(26,6),(26,7),(26,10),(26,11),(27,2),(27,3),(27,6),(27,7),(27,10),(27,11),(28,2),(28,3),(28,6),(28,7),(28,10),(28,11),(29,2),(29,3),(29,6),(29,7),(29,10),(29,11),(30,2),(30,3),(30,6),(30,7),(30,10),(30,11),(31,2),(31,3),(31,6),(31,7),(31,10),(31,11),(32,2),(32,3),(32,6),(32,7),(32,10),(32,11),(33,2),(33,3),(33,6),(33,7),(33,10),(33,11),(34,2),(34,3),(34,6),(34,7),(34,10),(34,11),(35,2),(35,3),(35,6),(35,7),(35,10),(35,11),(36,2),(36,3),(36,6),(36,7),(36,10),(36,11),(37,2),(37,3),(37,6),(37,7),(37,10),(37,11),(38,2),(38,3),(38,6),(38,7),(38,10),(38,11),(39,2),(39,3),(39,6),(39,7),(39,10),(39,11),(40,2),(40,3),(40,6),(40,7),(40,10),(40,11),(41,2),(41,3),(41,6),(41,7),(41,10),(41,11),(42,2),(42,3),(42,6),(42,7),(42,10),(42,11),(43,2),(43,3),(43,6),(43,7),(43,10),(43,11),(44,2),(44,3),(44,6),(44,7),(44,10),(44,11),(45,2),(45,3),(45,6),(45,7),(45,10),(45,11),(46,2),(46,3),(46,6),(46,7),(46,10),(46,11),(47,2),(47,3),(47,6),(47,7),(47,10),(47,11),(48,2),(48,3),(48,6),(48,7),(48,10),(48,11),(49,2),(49,3),(49,6),(49,7),(49,10),(49,11),(50,2),(50,3),(50,6),(50,7),(50,10),(50,11),(51,2),(51,3),(51,6),(51,7),(51,10),(51,11),(52,2),(52,3),(52,6),(52,7),(52,10),(52,11),(53,2),(53,3),(53,6),(53,7),(53,10),(53,11),(54,2),(54,3),(54,6),(54,7),(54,10),(54,11),(55,2),(55,3),(55,6),(55,7),(55,10),(55,11),(56,2),(56,3),(56,6),(56,7),(56,10),(56,11),(57,2),(57,3),(57,6),(57,7),(57,10),(57,11),(58,2),(58,3),(58,6),(58,7),(58,10),(58,11),(59,2),(59,3),(59,6),(59,7),(59,10),(59,11),(60,2),(60,3),(60,6),(60,7),(60,10),(60,11),(61,2),(61,3),(61,6),(61,7),(61,10),(61,11),(62,2),(62,3),(62,6),(62,7),(62,10),(62,11),(63,2),(63,3),(63,6),(63,7),(63,10),(63,11),(64,2),(64,3),(64,6),(64,7),(64,10),(64,11),(65,2),(65,3),(65,6),(65,7),(65,10),(65,11),(66,2),(66,3),(66,6),(66,7),(66,10),(66,11),(67,2),(67,3),(67,6),(67,7),(67,10),(67,11),(68,2),(68,3),(68,6),(68,7),(68,10),(68,11),(69,2),(69,3),(69,6),(69,7),(69,10),(69,11),(70,2),(70,3),(70,6),(70,7),(70,10),(70,11),(71,2),(71,3),(71,6),(71,7),(71,10),(71,11),(72,2),(72,3),(72,6),(72,7),(72,10),(72,11),(73,2),(73,3),(73,6),(73,7),(73,10),(73,11),(74,2),(74,3),(74,6),(74,7),(74,10),(74,11);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `display_name` varchar(191) DEFAULT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`),
  KEY `roles_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `roles_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','Super Admin','web','2026-05-23 15:17:54','2026-05-23 15:17:54',NULL),(2,'Admin_1','Admin','web','2026-05-23 15:17:56','2026-05-23 15:17:56',1),(3,'Branch Head_1','Branch Head','web','2026-05-23 15:17:56','2026-05-23 15:17:56',1),(4,'Waiter_1','Waiter','web','2026-05-23 15:17:56','2026-05-23 15:17:56',1),(5,'Chef_1','Chef','web','2026-05-23 15:17:56','2026-05-23 15:17:56',1),(6,'Admin_2','Admin','web','2026-05-23 15:17:58','2026-05-23 15:17:58',2),(7,'Branch Head_2','Branch Head','web','2026-05-23 15:17:58','2026-05-23 15:17:58',2),(8,'Waiter_2','Waiter','web','2026-05-23 15:17:58','2026-05-23 15:17:58',2),(9,'Chef_2','Chef','web','2026-05-23 15:17:58','2026-05-23 15:17:58',2),(10,'Admin_3','Admin','web','2026-05-23 15:17:59','2026-05-23 15:17:59',3),(11,'Branch Head_3','Branch Head','web','2026-05-23 15:17:59','2026-05-23 15:17:59',3),(12,'Waiter_3','Waiter','web','2026-05-23 15:17:59','2026-05-23 15:17:59',3),(13,'Chef_3','Chef','web','2026-05-23 15:17:59','2026-05-23 15:17:59',3);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('KnjKDXEUGtQUCnR6deGcB2qUaC7wO1ZC9EFgREjv',NULL,'::1','curl/8.19.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOTgwSWdMbVpCS2R0V092MFphZWtvb051TE9IZFBsNXU4NXYzZVAwZSI7czoyMDoiY2hlY2tfbWlncmF0ZV9zdGF0dXMiO3M6NDoiR29vZCI7czoxNToiY3VzdG9tZXJfaXNfcnRsIjtpOjA7czo0OiJ1c2VyIjtOO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwODAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779556691);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `split_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `split_order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `split_order_id` bigint(20) unsigned NOT NULL,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `split_order_items_split_order_id_foreign` (`split_order_id`),
  KEY `split_order_items_order_item_id_foreign` (`order_item_id`),
  CONSTRAINT `split_order_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `split_order_items_split_order_id_foreign` FOREIGN KEY (`split_order_id`) REFERENCES `split_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `split_order_items` WRITE;
/*!40000 ALTER TABLE `split_order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `split_order_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `split_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `split_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `payment_method` enum('cash','upi','card','bank_transfer','due','stripe','razorpay') NOT NULL DEFAULT 'cash',
  `payer_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `split_orders_order_id_foreign` (`order_id`),
  CONSTRAINT `split_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `split_orders` WRITE;
/*!40000 ALTER TABLE `split_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `split_orders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `stripe_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stripe_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `payment_status` enum('pending','requested','declined','completed') NOT NULL DEFAULT 'pending',
  `payment_error_response` text DEFAULT NULL,
  `stripe_payment_intent` varchar(191) DEFAULT NULL,
  `stripe_session_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stripe_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `stripe_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `stripe_payments` WRITE;
/*!40000 ALTER TABLE `stripe_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `stripe_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `superadmin_payment_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `superadmin_payment_gateways` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `razorpay_type` enum('test','live') NOT NULL DEFAULT 'test',
  `test_razorpay_key` text DEFAULT NULL,
  `test_razorpay_secret` text DEFAULT NULL,
  `razorpay_test_webhook_key` text DEFAULT NULL,
  `live_razorpay_key` text DEFAULT NULL,
  `live_razorpay_secret` text DEFAULT NULL,
  `razorpay_live_webhook_key` text DEFAULT NULL,
  `razorpay_status` tinyint(1) NOT NULL DEFAULT 0,
  `stripe_type` enum('test','live') NOT NULL DEFAULT 'test',
  `test_stripe_key` text DEFAULT NULL,
  `test_stripe_secret` text DEFAULT NULL,
  `stripe_test_webhook_key` text DEFAULT NULL,
  `live_stripe_key` text DEFAULT NULL,
  `live_stripe_secret` text DEFAULT NULL,
  `stripe_live_webhook_key` text DEFAULT NULL,
  `stripe_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `flutterwave_status` tinyint(1) NOT NULL DEFAULT 0,
  `flutterwave_type` enum('test','live') NOT NULL DEFAULT 'test',
  `test_flutterwave_key` text DEFAULT NULL,
  `test_flutterwave_secret` text DEFAULT NULL,
  `test_flutterwave_hash` text DEFAULT NULL,
  `flutterwave_test_webhook_key` text DEFAULT NULL,
  `live_flutterwave_key` text DEFAULT NULL,
  `live_flutterwave_secret` text DEFAULT NULL,
  `live_flutterwave_hash` text DEFAULT NULL,
  `flutterwave_live_webhook_key` text DEFAULT NULL,
  `live_paypal_client_id` varchar(191) DEFAULT NULL,
  `live_paypal_secret` varchar(191) DEFAULT NULL,
  `test_paypal_client_id` varchar(191) DEFAULT NULL,
  `test_paypal_secret` varchar(191) DEFAULT NULL,
  `paypal_status` tinyint(1) NOT NULL DEFAULT 0,
  `paypal_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `live_payfast_merchant_id` varchar(191) DEFAULT NULL,
  `live_payfast_merchant_key` varchar(191) DEFAULT NULL,
  `live_payfast_passphrase` varchar(191) DEFAULT NULL,
  `test_payfast_merchant_id` varchar(191) DEFAULT NULL,
  `test_payfast_merchant_key` varchar(191) DEFAULT NULL,
  `test_payfast_passphrase` varchar(191) DEFAULT NULL,
  `payfast_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `payfast_status` tinyint(1) NOT NULL DEFAULT 0,
  `live_paystack_key` varchar(191) DEFAULT NULL,
  `live_paystack_secret` varchar(191) DEFAULT NULL,
  `live_paystack_merchant_email` varchar(191) DEFAULT NULL,
  `test_paystack_key` varchar(191) DEFAULT NULL,
  `test_paystack_secret` varchar(191) DEFAULT NULL,
  `test_paystack_merchant_email` varchar(191) DEFAULT NULL,
  `paystack_payment_url` varchar(191) DEFAULT 'https://api.paystack.co',
  `paystack_status` tinyint(1) NOT NULL DEFAULT 0,
  `paystack_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `xendit_status` tinyint(1) NOT NULL DEFAULT 0,
  `xendit_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `test_xendit_public_key` varchar(191) DEFAULT NULL,
  `test_xendit_secret_key` varchar(191) DEFAULT NULL,
  `live_xendit_public_key` varchar(191) DEFAULT NULL,
  `live_xendit_secret_key` varchar(191) DEFAULT NULL,
  `test_xendit_webhook_token` varchar(191) DEFAULT NULL,
  `live_xendit_webhook_token` varchar(191) DEFAULT NULL,
  `paddle_status` tinyint(1) NOT NULL DEFAULT 0,
  `paddle_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  `test_paddle_vendor_id` varchar(191) DEFAULT NULL,
  `test_paddle_api_key` text DEFAULT NULL,
  `test_paddle_public_key` varchar(191) DEFAULT NULL,
  `test_paddle_client_token` text DEFAULT NULL,
  `live_paddle_vendor_id` varchar(191) DEFAULT NULL,
  `live_paddle_api_key` text DEFAULT NULL,
  `live_paddle_public_key` varchar(191) DEFAULT NULL,
  `live_paddle_client_token` text DEFAULT NULL,
  `paddle_webhook_secret` text DEFAULT NULL,
  `mollie_status` tinyint(1) NOT NULL DEFAULT 0,
  `mollie_mode` enum('test','live') NOT NULL DEFAULT 'test',
  `test_mollie_key` text DEFAULT NULL,
  `live_mollie_key` text DEFAULT NULL,
  `tap_merchant_id` varchar(191) DEFAULT NULL,
  `live_tap_secret_key` varchar(191) DEFAULT NULL,
  `live_tap_public_key` varchar(191) DEFAULT NULL,
  `test_tap_secret_key` varchar(191) DEFAULT NULL,
  `test_tap_public_key` varchar(191) DEFAULT NULL,
  `tap_status` tinyint(1) NOT NULL DEFAULT 0,
  `tap_mode` enum('sandbox','live') NOT NULL DEFAULT 'sandbox',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `superadmin_payment_gateways` WRITE;
/*!40000 ALTER TABLE `superadmin_payment_gateways` DISABLE KEYS */;
INSERT INTO `superadmin_payment_gateways` VALUES (1,'test',NULL,NULL,NULL,NULL,NULL,NULL,0,'test',NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-05-23 15:17:41','2026-05-23 15:17:41',0,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,'sandbox',0,NULL,NULL,NULL,NULL,NULL,NULL,'https://api.paystack.co',0,'sandbox',0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox'),(2,'test',NULL,NULL,NULL,NULL,NULL,NULL,0,'test',NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-05-23 15:17:56','2026-05-23 15:17:56',0,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,'sandbox',0,NULL,NULL,NULL,NULL,NULL,NULL,'https://api.paystack.co',0,'sandbox',0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'sandbox');
/*!40000 ALTER TABLE `superadmin_payment_gateways` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `table_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_sessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `table_id` bigint(20) unsigned NOT NULL,
  `locked_by_user_id` bigint(20) unsigned DEFAULT NULL,
  `locked_at` datetime DEFAULT NULL,
  `last_activity_at` datetime DEFAULT NULL,
  `session_token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table_sessions_session_token_unique` (`session_token`),
  KEY `table_sessions_branch_id_foreign` (`branch_id`),
  KEY `table_sessions_locked_by_user_id_foreign` (`locked_by_user_id`),
  KEY `table_sessions_table_id_locked_by_user_id_index` (`table_id`,`locked_by_user_id`),
  KEY `table_sessions_last_activity_at_index` (`last_activity_at`),
  CONSTRAINT `table_sessions_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `table_sessions_locked_by_user_id_foreign` FOREIGN KEY (`locked_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `table_sessions_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `table_sessions` WRITE;
/*!40000 ALTER TABLE `table_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `table_code` varchar(191) NOT NULL,
  `hash` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `available_status` enum('available','reserved','running') NOT NULL DEFAULT 'available',
  `area_id` bigint(20) unsigned NOT NULL,
  `seating_capacity` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tables_area_id_foreign` (`area_id`),
  KEY `idx_tables_branch_code` (`branch_id`,`table_code`),
  KEY `idx_tables_branch_status` (`branch_id`,`available_status`),
  CONSTRAINT `tables_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tables_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES (1,1,'T-1','764dabb64435c5ce550174d3b403bec3','active','available',6,5,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(2,1,'T-2','b640857d2864e3ed5dccfebe782bd9aa','active','available',8,4,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(3,1,'T-3','d5a3fa22553571fd113aa795aadd9130','active','available',7,7,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(4,1,'T-4','1f5a8de61d6265d994a5e258cd2b522a','active','available',8,7,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(5,1,'T-5','ea8cc07669488252461b8c12f0524e74','active','available',1,3,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(6,1,'T-6','47dc342c0b5b1770350702f3e1b44003','active','available',5,3,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(7,1,'T-7','5d2817f621f254418bdfbde7453224a0','active','available',1,3,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(8,1,'T-8','bf4c0b35111479df152f8451ec2a53d6','active','available',3,8,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(9,1,'T-9','ce72d5e84d9afac66d7898a719ab1266','active','available',4,5,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(10,1,'T-10','24c9eb6b58e1d56a6c87f302f7663aab','active','available',5,3,'2026-05-23 15:17:57','2026-05-23 15:17:57'),(11,3,'T-1','e098623dcb51b5e539a7e29715dba533','active','available',8,8,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(12,3,'T-2','43616b14966e0fb3dc569a5846bc24d4','active','available',7,5,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(13,3,'T-3','72083a75660b01f91d7d29a2bf4fb2f1','active','available',6,7,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(14,3,'T-4','9ba96f5db7ffb6f10b1ffbb43ccfb6be','active','available',13,8,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(15,3,'T-5','2b0c1ea403af20eef6919c47c72204a6','active','available',16,5,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(16,3,'T-6','34cfcfdc3bd0640c4f4db700a57adc07','active','available',7,8,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(17,3,'T-7','b1485f265b2150931509704fbb0ca332','active','available',4,6,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(18,3,'T-8','f8f5999d2f33ba49a2fe498b797d81c3','active','available',9,5,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(19,3,'T-9','d2527dcbf1f0c55d5c5f6fe1e137d2c8','active','available',6,3,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(20,3,'T-10','66b1c933f81903a08b90c2c5ff2c2402','active','available',1,3,'2026-05-23 15:17:58','2026-05-23 15:17:58'),(21,5,'T-1','050df7c057d74af45d5abb9d47124f8e','active','available',7,4,'2026-05-23 15:17:59','2026-05-23 15:17:59'),(22,5,'T-2','ee949432de9e22e5934efb325cc7852e','active','available',21,4,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(23,5,'T-3','b7b1c66f883959a0b8dbe6dfb4a7120f','active','available',4,4,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(24,5,'T-4','41311a88eee1056e029eb115e380c39a','active','available',17,4,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(25,5,'T-5','0f08b77e07f501914c882db8b746737c','active','available',21,5,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(26,5,'T-6','459df1f50ba77a584a490b650c5e41ca','active','available',3,8,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(27,5,'T-7','4bedb7266c0de53de45938de7994099d','active','available',6,7,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(28,5,'T-8','66068174d440c2c6778c98c7c6eb14c8','active','available',12,3,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(29,5,'T-9','fe5312541cf368f99c4a197c02333611','active','available',20,6,'2026-05-23 15:18:00','2026-05-23 15:18:00'),(30,5,'T-10','69e297be4ac85c2252a4e15b3666ed3f','active','available',10,7,'2026-05-23 15:18:00','2026-05-23 15:18:00');
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tap_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tap_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tap_payment_id` varchar(191) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_error_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_error_response`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tap_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `tap_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tap_payments` WRITE;
/*!40000 ALTER TABLE `tap_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tap_payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `tax_name` varchar(191) NOT NULL,
  `tax_percent` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `taxes_restaurant_id_foreign` (`restaurant_id`),
  KEY `taxes_branch_id_foreign` (`branch_id`),
  CONSTRAINT `taxes_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `taxes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `taxes` WRITE;
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
INSERT INTO `taxes` VALUES (1,1,1,'VAT','18','2026-05-23 15:17:56','2026-05-23 15:17:56'),(2,1,2,'VAT','18','2026-05-23 15:17:56','2026-05-23 15:17:56'),(3,2,3,'VAT','18','2026-05-23 15:17:58','2026-05-23 15:17:58'),(4,2,4,'VAT','18','2026-05-23 15:17:58','2026-05-23 15:17:58'),(5,3,5,'VAT','18','2026-05-23 15:17:59','2026-05-23 15:17:59'),(6,3,6,'VAT','18','2026-05-23 15:17:59','2026-05-23 15:17:59');
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `phone_code` varchar(191) DEFAULT NULL,
  `terms_and_privacy_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `marketing_emails_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(191) NOT NULL DEFAULT 'en',
  `stripe_id` varchar(191) DEFAULT NULL,
  `pm_type` varchar(191) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_restaurant_id_foreign` (`restaurant_id`),
  KEY `users_stripe_id_index` (`stripe_id`),
  KEY `idx_branch_email` (`branch_id`,`email`),
  CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,NULL,'Emma Holden','superadmin@example.com',NULL,NULL,0,0,NULL,'$2y$12$QDRYi0LFTuDmNQGo0PuomuGhYHGQwBHAm7gLxXOiGdCrzrxU2Rzve',NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 15:17:55','2026-05-23 15:17:55','en',NULL,NULL,NULL,NULL),(2,1,NULL,'John Doe','admin@example.com',NULL,NULL,0,0,NULL,'$2y$12$xumQ9Gwq084iuDGDMzrpoO8Otc4V1tyswcinxEmpcXRoSogOPrLZe',NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 15:17:56','2026-05-23 15:17:56','en',NULL,NULL,NULL,NULL),(3,1,1,'Jaquelyn Battle','waiter@example.com',NULL,NULL,0,0,NULL,'$2y$12$FgzVEW0RuvbpLNRWZbqAqOcpnRgJiw9x6zSbucptZaClSMKjH989.',NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 15:17:57','2026-05-23 15:17:57','en',NULL,NULL,NULL,NULL),(4,2,NULL,'Zane Purdy','spice.symphony@example.com',NULL,NULL,0,0,NULL,'$2y$12$q12d697vp3OwYLT8Dx3zXepHrruIwGrYc7zrxfR9r548R0gOaZa6i',NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 15:17:58','2026-05-23 15:17:58','en',NULL,NULL,NULL,NULL),(5,2,3,'Lilian Hills','jondricka@example.net',NULL,NULL,0,0,NULL,'$2y$12$r39gU5Zld5n9XpvkCYHfWuJCEnfvRfAdFjRoYE37y.Lo8LWjlhN96',NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 15:17:58','2026-05-23 15:17:58','en',NULL,NULL,NULL,NULL),(6,3,NULL,'Alexys Goldner','bombay.delight@example.com',NULL,NULL,0,0,NULL,'$2y$12$tRgAt38GEaQY3gTtfo7L0.hJmhtgcMqXUBf5lKp/oOchiwJXM.I1W',NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','en',NULL,NULL,NULL,NULL),(7,3,5,'Eveline Mraz','marty90@example.net',NULL,NULL,0,0,NULL,'$2y$12$gvVVdrQL96JYcJ4ZH.I0XeSemHsB27h7ZvL59kJdoDVg.684uBAFm',NULL,NULL,NULL,NULL,NULL,NULL,'2026-05-23 15:17:59','2026-05-23 15:17:59','en',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `waiter_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `waiter_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `table_id` bigint(20) unsigned NOT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `waiter_requests_branch_id_foreign` (`branch_id`),
  KEY `waiter_requests_table_id_foreign` (`table_id`),
  CONSTRAINT `waiter_requests_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `waiter_requests_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `waiter_requests` WRITE;
/*!40000 ALTER TABLE `waiter_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `waiter_requests` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `whatsapp_automated_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whatsapp_automated_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `notification_type` varchar(191) NOT NULL COMMENT 'e.g., low_stock_alert, birthday_wish, etc.',
  `schedule_type` varchar(191) NOT NULL COMMENT 'cron, daily, weekly, monthly',
  `cron_expression` varchar(191) DEFAULT NULL COMMENT 'For cron type: e.g., 0 9 * * *',
  `scheduled_time` time DEFAULT NULL COMMENT 'For daily/weekly/monthly: e.g., 09:00',
  `scheduled_day` varchar(191) DEFAULT NULL COMMENT 'For weekly: monday, tuesday, etc. For monthly: 1-31',
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of role IDs to send notifications to' CHECK (json_valid(`roles`)),
  `is_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `last_sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wa_auto_sched_rest_notif_idx` (`restaurant_id`,`notification_type`),
  CONSTRAINT `whatsapp_automated_schedules_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `whatsapp_automated_schedules` WRITE;
/*!40000 ALTER TABLE `whatsapp_automated_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `whatsapp_automated_schedules` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `whatsapp_global_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whatsapp_global_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_code` varchar(191) DEFAULT NULL,
  `supported_until` timestamp NULL DEFAULT NULL,
  `purchased_on` timestamp NULL DEFAULT NULL,
  `license_type` varchar(20) DEFAULT NULL,
  `notify_update` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `whatsapp_global_settings` WRITE;
/*!40000 ALTER TABLE `whatsapp_global_settings` DISABLE KEYS */;
INSERT INTO `whatsapp_global_settings` VALUES (1,NULL,NULL,NULL,NULL,1,'2026-05-23 15:17:42','2026-05-23 15:17:42');
/*!40000 ALTER TABLE `whatsapp_global_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `whatsapp_notification_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whatsapp_notification_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `notification_type` varchar(100) NOT NULL,
  `recipient_phone` varchar(20) NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `variables` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Variables sent with template' CHECK (json_valid(`variables`)),
  `status` enum('sent','failed','pending') NOT NULL DEFAULT 'pending',
  `whatsapp_message_id` varchar(191) DEFAULT NULL COMMENT 'Message ID from WhatsApp API',
  `error_message` text DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `whatsapp_notification_logs_restaurant_id_index` (`restaurant_id`),
  KEY `whatsapp_notification_logs_notification_type_index` (`notification_type`),
  KEY `whatsapp_notification_logs_status_index` (`status`),
  KEY `whatsapp_notification_logs_sent_at_index` (`sent_at`),
  CONSTRAINT `whatsapp_notification_logs_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `whatsapp_notification_logs` WRITE;
/*!40000 ALTER TABLE `whatsapp_notification_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `whatsapp_notification_logs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `whatsapp_notification_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whatsapp_notification_preferences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `notification_type` varchar(191) NOT NULL COMMENT 'e.g., order_confirmation, order_status_update, etc.',
  `recipient_type` varchar(191) NOT NULL COMMENT 'customer, admin, staff, delivery',
  `is_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_restaurant_notification` (`restaurant_id`,`notification_type`,`recipient_type`),
  CONSTRAINT `whatsapp_notification_preferences_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `whatsapp_notification_preferences` WRITE;
/*!40000 ALTER TABLE `whatsapp_notification_preferences` DISABLE KEYS */;
/*!40000 ALTER TABLE `whatsapp_notification_preferences` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `whatsapp_report_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whatsapp_report_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `report_type` varchar(191) NOT NULL COMMENT 'e.g., daily_sales, weekly_sales, monthly_sales, etc.',
  `frequency` varchar(191) NOT NULL COMMENT 'daily, weekly, monthly',
  `scheduled_time` time NOT NULL COMMENT 'Time to send report, e.g., 09:00',
  `scheduled_day` varchar(191) DEFAULT NULL COMMENT 'For weekly: monday, tuesday, etc. For monthly: 1-31',
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of role IDs to send reports to' CHECK (json_valid(`roles`)),
  `is_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `last_sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wa_report_sched_rest_report_idx` (`restaurant_id`,`report_type`),
  CONSTRAINT `whatsapp_report_schedules_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `whatsapp_report_schedules` WRITE;
/*!40000 ALTER TABLE `whatsapp_report_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `whatsapp_report_schedules` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `whatsapp_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whatsapp_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Null for superadmin global settings',
  `waba_id` varchar(191) DEFAULT NULL COMMENT 'WhatsApp Business Account ID',
  `access_token` text DEFAULT NULL COMMENT 'Encrypted API access token',
  `phone_number_id` varchar(191) DEFAULT NULL COMMENT 'Phone number ID from WhatsApp',
  `verify_token` varchar(191) DEFAULT NULL COMMENT 'WhatsApp webhook verify token',
  `webhook_url` varchar(191) DEFAULT NULL COMMENT 'WhatsApp webhook callback URL',
  `webhook_verified_at` timestamp NULL DEFAULT NULL COMMENT 'When webhook was last verified',
  `is_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `whatsapp_settings_restaurant_id_unique` (`restaurant_id`),
  CONSTRAINT `whatsapp_settings_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `whatsapp_settings` WRITE;
/*!40000 ALTER TABLE `whatsapp_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `whatsapp_settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `whatsapp_template_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whatsapp_template_definitions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(100) NOT NULL COMMENT 'e.g., order_confirmation',
  `template_name` varchar(100) NOT NULL COMMENT 'Standard template name',
  `category` varchar(50) NOT NULL COMMENT 'customer/admin/staff/delivery/automated',
  `description` text DEFAULT NULL,
  `template_json` text NOT NULL COMMENT 'JSON structure for WhatsApp Portal',
  `sample_variables` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Sample variables for testing' CHECK (json_valid(`sample_variables`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `whatsapp_template_definitions_notification_type_unique` (`notification_type`),
  KEY `whatsapp_template_definitions_category_index` (`category`),
  KEY `whatsapp_template_definitions_notification_type_index` (`notification_type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `whatsapp_template_definitions` WRITE;
/*!40000 ALTER TABLE `whatsapp_template_definitions` DISABLE KEYS */;
INSERT INTO `whatsapp_template_definitions` VALUES (1,'order_notifications','Order Notification','customer','Unified template for all order-related notifications (confirmed, status update)','{\n    \"name\": \"order_notifications\",\n    \"language\": \"en\",\n    \"category\": \"MARKETING\",\n    \"components\": [\n        {\n            \"type\": \"HEADER\",\n            \"format\": \"TEXT\",\n            \"text\": \"Order Alert\"\n        },\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Hello {{1}}, \\n\\nWe would like to inform you that {{2}}\\n\\nOrder number #{{3}}.\\n\\nOrder details:\\n\\n{{4}}\\n\\nAdditional information:\\n\\n{{5}}.\\n\\nThank you for your order.\"\n        },\n        {\n            \"type\": \"FOOTER\",\n            \"text\": \"Thank you for choosing us!\"\n        },\n        {\n            \"type\": \"BUTTONS\",\n            \"buttons\": [\n                {\n                    \"type\": \"URL\",\n                    \"text\": \"View Order\",\n                    \"url\": \"https:\\/\\/example.com\\/order\\/{{1}}\",\n                    \"example\": [\n                        \"https:\\/\\/example.com\\/order\\/12345\"\n                    ]\n                }\n            ]\n        }\n    ]\n}','[\"Body 1: Customer name\",\"Body 2: Main message (e.g., \\\"your order has been confirmed\\\", \\\"order status updated to\\\", \\\"order has been cancelled\\\", \\\"your bill is ready\\\")\",\"Body 3: Order number\",\"Body 4: Details line 1 (Order type\\/Status\\/Reason\\/Amount)\",\"Body 5: Details line 2 (Estimated time\\/Additional info\\/Refund status\\/Payment method)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:51'),(2,'payment_notification','Payment Notification','customer','Unified template for payment confirmation and payment reminders','{\n    \"name\": \"payment_notification\",\n    \"language\": \"en\",\n    \"category\": \"UTILITY\",\n    \"components\": [\n        {\n            \"type\": \"HEADER\",\n            \"format\": \"TEXT\",\n            \"text\": \"Payment Notification\"\n        },\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Hello {{1}},\\n\\n{{2}} for order: #{{3}} has been successfully received.\\n\\nOrder type: {{4}},\\n\\nCustomer name: {{5}},\\n\\nTotal amount: {{6}}.\\n\\nThank you for choosing our services!\"\n        },\n        {\n            \"type\": \"FOOTER\",\n            \"text\": \"Thank you!\"\n        },\n        {\n            \"type\": \"BUTTONS\",\n            \"buttons\": [\n                {\n                    \"type\": \"URL\",\n                    \"text\": \"View Order\",\n                    \"url\": \"https:\\/\\/yourdomain.com\\/order\\/{{1}}\",\n                    \"example\": [\n                        \"https:\\/\\/yourdomain.com\\/order\\/123\"\n                    ]\n                }\n            ]\n        }\n    ]\n}','[\"Body 1: Customer name\",\"Body 2: Message type (Payment\\/Pending payment)\",\"Body 3: Order number\",\"Body 4: Order type\",\"Body 5: Customer name\",\"Body 6: Total amount\",\"Button URL: Order number (for View Order button)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:51'),(3,'reservation_notification','Reservation Notification','customer','Unified template for reservation confirmation, status updates (Confirmed, Cancelled, Pending), and followup messages','{\n    \"name\": \"reservation_notification\",\n    \"language\": \"en\",\n    \"category\": \"UTILITY\",\n    \"components\": [\n        {\n            \"type\": \"HEADER\",\n            \"format\": \"TEXT\",\n            \"text\": \"Status: {{1}}\"\n        },\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Hello {{1}}, we are pleased to confirm that {{2}} for a party of {{3}} guests. Your reservation has been scheduled for the date of {{4}} at the time of {{5}}. Here are some additional important details regarding your reservation: {{6}}. We are excited to welcome you and look forward to providing you with an excellent dining experience!\"\n        },\n        {\n            \"type\": \"FOOTER\",\n            \"text\": \"We look forward to serving you!\"\n        },\n        {\n            \"type\": \"BUTTONS\",\n            \"buttons\": [\n                {\n                    \"type\": \"URL\",\n                    \"text\": \"View Booking\",\n                    \"url\": \"http:\\/\\/localhost:8080\\/restaurant\\/my-bookings\\/\",\n                    \"example\": [\n                        \"http:\\/\\/localhost:8080\\/restaurant\\/my-bookings\\/demo-restaurant\"\n                    ]\n                }\n            ]\n        }\n    ]\n}','[\"Header: Header text (Reservation Confirmed\\/Reservation Cancelled\\/Reservation Pending\\/Thank You)\",\"Body 1: Customer name\",\"Body 2: Message type (your reservation is confirmed\\/your reservation status has been confirmed\\/cancelled\\/set to pending\\/thank you for visiting)\",\"Body 3: Number of guests\",\"Body 4: Date\",\"Body 5: Time\",\"Body 6: Additional details (Table number\\/Status\\/Feedback link\\/Restaurant name)\",\"Button URL: Restaurant hash\\/slug (for View Booking button)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:54'),(4,'new_order_alert','New Order Alert','all','Unified template for new order alerts to admin','{\n    \"name\": \"new_order_alert\",\n    \"language\": \"en\",\n    \"category\": \"MARKETING\",\n    \"components\": [\n        {\n            \"type\": \"HEADER\",\n            \"format\": \"TEXT\",\n            \"text\": \"New Order\"\n        },\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Hello {{1}},\\n\\n{{2}} order with order number {{3}} has been successfully received.\\n\\nThe order type: {{4}}.\\n\\nCustomer name: {{5}}.\\n\\nAmount for this order is {{6}}.\\n\\nThank you for choosing our services!\"\n        },\n        {\n            \"type\": \"FOOTER\",\n            \"text\": \"Thank you!\"\n        },\n        {\n            \"type\": \"BUTTONS\",\n            \"buttons\": [\n                {\n                    \"type\": \"URL\",\n                    \"text\": \"View Order\",\n                    \"url\": \"https:\\/\\/yourdomain.com\\/order\\/{{1}}\",\n                    \"example\": [\n                        \"https:\\/\\/yourdomain.com\\/order\\/123\"\n                    ]\n                }\n            ]\n        }\n    ]\n}','[\"Body 1: Recipient name (Admin name\\/Customer name\\/Staff name)\",\"Body 2: Message context (New\\/Your)\",\"Body 3: Order number\",\"Body 4: Order type\",\"Body 5: Customer name (or \\\"You\\\" for customer)\",\"Body 6: Amount\",\"Button URL: Order number (for View Order button)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:51'),(5,'delivery_notification','Delivery Notification','delivery','Unified template for delivery-related notifications (assignment, ready for pickup, completion)','{\n    \"name\": \"delivery_notification\",\n    \"language\": \"en\",\n    \"category\": \"UTILITY\",\n    \"components\": [\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Hello {{1}},\\n\\nWe are notifying you that {{2}} for order #{{3}}.\\n\\nCustomer name: {{4}},\\n\\nCustomer phone number {{5}},\\n\\nCustomer address and amount: {{6}}.\\n\\nPlease proceed with the delivery process as soon as possible.\\n\\nThank you for your dedication!\"\n        }\n    ]\n}','[\"Body 1: Delivery executive name\",\"Body 2: Message (e.g., \\\"order is ready for pickup\\\", \\\"new delivery assigned\\\")\",\"Body 3: Order number (numeric part, used with # in template)\",\"Body 4: Customer name\",\"Body 5: Customer phone number\",\"Body 6: Customer address and amount (combined)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:51'),(6,'kitchen_notification','Kitchen Notification','staff','Unified template for kitchen-related notifications (new KOT items to prepare).','{\n    \"name\": \"kitchen_notification\",\n    \"language\": \"en\",\n    \"category\": \"UTILITY\",\n    \"components\": [\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Hello {{1}},\\n\\n\\n\\nWe have received {{2}} with order number {{3}}.\\n\\nTable number: {{4}}.\\n\\nOrder type: {{5}}.\\n\\nList of items that need to be prepared: {{6}}.\\n\\nPlease prepare all items accordingly and ensure timely service.\\n\\nWe appreciate your hard work.\"\n        },\n        {\n            \"type\": \"BUTTONS\",\n            \"buttons\": [\n                {\n                    \"type\": \"URL\",\n                    \"text\": \"View Order\",\n                    \"url\": \"https:\\/\\/yourdomain.com\\/order\\/{{1}}\",\n                    \"example\": [\n                        \"https:\\/\\/yourdomain.com\\/order\\/123\"\n                    ]\n                }\n            ]\n        }\n    ]\n}','[\"Body 1: Staff name (Chef\\/Waiter)\",\"Body 2: Notification type (New KOT\\/Order ready to serve\\/Order has been modified)\",\"Body 3: Order number\",\"Body 4: Table number\",\"Body 5: Order type\",\"Body 6: List of items that need to be prepared\",\"Button URL: Order number (numeric part, for View Order button)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:54'),(7,'staff_notification','Staff Notification','staff','Unified template for staff-related notifications (table assignment, waiter request, waiter acknowledgment)','{\n    \"name\": \"staff_notification\",\n    \"language\": \"en\",\n    \"category\": \"UTILITY\",\n    \"components\": [\n        {\n            \"type\": \"HEADER\",\n            \"format\": \"TEXT\",\n            \"text\": \"Status: {{1}}\"\n        },\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Hello {{1}},\\n\\nWe are sending you this notification regarding {{2}} for {{3}}.\\n\\nHere is the important detail: \\n{{4}}.\\n\\n Please take necessary action. Thank you!\"\n        },\n        {\n            \"type\": \"FOOTER\",\n            \"text\": \"Thank you!\"\n        }\n    ]\n}','[\"Header: Header text (Payment Request\\/Table Assigned\\/Table Status\\/Waiter Request)\",\"Body 1: Staff name\",\"Body 2: Notification type (payment requested\\/table assigned\\/table status changed\\/waiter request received)\",\"Body 3: Target (table number\\/reservation number)\",\"Body 4: Details (single detail)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:54'),(8,'sales_report','Sales Report','staff','Unified template for all sales reports (daily, weekly, monthly)','{\n    \"name\": \"sales_report\",\n    \"language\": \"en\",\n    \"category\": \"UTILITY\",\n    \"components\": [\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Here is your comprehensive {{1}} Sales Report for the reporting period of {{2}}. The total number of orders processed during this period is {{3}}, the total revenue generated is {{4}}, the net revenue after all deductions is {{5}}, and here are the combined tax and discount details: {{6}}. This report has been generated successfully and is ready for your review and analysis!\"\n        },\n        {\n            \"type\": \"FOOTER\",\n            \"text\": \"Generated automatically\"\n        },\n        {\n            \"type\": \"BUTTONS\",\n            \"buttons\": [\n                {\n                    \"type\": \"URL\",\n                    \"text\": \"View Report\",\n                    \"url\": \"http:\\/\\/localhost:8080\\/reports\\/sales-report\",\n                    \"example\": [\n                        \"http:\\/\\/localhost:8080\\/reports\\/sales-report\"\n                    ]\n                }\n            ]\n        }\n    ]\n}','[\"Body 1: Period type (Daily\\/Weekly\\/Monthly)\",\"Body 2: Period (Date\\/Date Range\\/Month)\",\"Body 3: Total orders\",\"Body 4: Total revenue\",\"Body 5: Net revenue\",\"Body 6: Tax and Discount (combined)\",\"Button URL: Sales report URL (static, no variables)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:51'),(9,'operations_summary','Daily Operations Summary','staff','End-of-day operations summary for admin','{\n    \"name\": \"operations_summary\",\n    \"language\": \"en\",\n    \"category\": \"UTILITY\",\n    \"components\": [\n        {\n            \"type\": \"HEADER\",\n            \"format\": \"DOCUMENT\"\n        },\n        {\n            \"type\": \"BODY\",\n            \"text\": \"Here is the daily operations summary for branch {{1}} on the date of {{2}}. The total number of orders processed today is {{3}}, the total revenue generated for today is {{4}}, the total number of reservations handled today is {{5}}, and here are the combined staff on duty and peak hours information: {{6}}. The end of day summary has been completed successfully and is ready for review!\"\n        },\n        {\n            \"type\": \"FOOTER\",\n            \"text\": \"End of day summary\"\n        },\n        {\n            \"type\": \"BUTTONS\",\n            \"buttons\": [\n                {\n                    \"type\": \"URL\",\n                    \"text\": \"View Report\",\n                    \"url\": \"http:\\/\\/localhost:8080\\/reports\\/sales-report\",\n                    \"example\": [\n                        \"http:\\/\\/localhost:8080\\/reports\\/sales-report\"\n                    ]\n                }\n            ]\n        }\n    ]\n}','[\"Branch name\",\"Date\",\"Total orders\",\"Total revenue\",\"Total reservations\",\"Staff on duty and Peak hours (combined)\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:54'),(10,'inventory_alert','Low Stock Alert','staff','Alert when inventory items are below threshold','{\n    \"name\": \"inventory_alert\",\n    \"language\": \"en\",\n    \"category\": \"UTILITY\",\n    \"components\": [\n        {\n            \"type\": \"HEADER\",\n            \"format\": \"TEXT\",\n            \"text\": \"Low Stock Alert\"\n        },\n        {\n            \"type\": \"BODY\",\n            \"text\": \"We are sending you this important low stock alert notification. There are currently {{1}} items that have fallen below the minimum threshold level. Here is the complete list of items that need immediate attention: {{2}}. This alert is for restaurant location: {{3}}. Please take immediate action to restock these items as soon as possible to avoid any service disruptions. Thank you for your prompt attention to this matter!\"\n        },\n        {\n            \"type\": \"FOOTER\",\n            \"text\": \"Please restock soon\"\n        }\n    ]\n}','[\"Body 1: Item count\",\"Body 2: Item names\",\"Body 3: Restaurant name\"]',1,'2026-05-23 15:17:51','2026-05-23 15:17:51');
/*!40000 ALTER TABLE `whatsapp_template_definitions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `whatsapp_template_mappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whatsapp_template_mappings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` bigint(20) unsigned NOT NULL,
  `notification_type` varchar(100) NOT NULL COMMENT 'e.g., order_confirmation, reservation_confirmation',
  `template_name` varchar(100) NOT NULL COMMENT 'Actual template name in WhatsApp Business Portal',
  `template_id` varchar(191) DEFAULT NULL COMMENT 'WhatsApp template ID for reference',
  `language_code` varchar(10) NOT NULL DEFAULT 'en',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_restaurant_template` (`restaurant_id`,`notification_type`,`language_code`),
  KEY `whatsapp_template_mappings_restaurant_id_index` (`restaurant_id`),
  KEY `whatsapp_template_mappings_notification_type_index` (`notification_type`),
  CONSTRAINT `whatsapp_template_mappings_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `whatsapp_template_mappings` WRITE;
/*!40000 ALTER TABLE `whatsapp_template_mappings` DISABLE KEYS */;
/*!40000 ALTER TABLE `whatsapp_template_mappings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `xendit_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xendit_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `payment_status` enum('pending','requested','declined','completed') NOT NULL DEFAULT 'pending',
  `payment_error_response` text DEFAULT NULL,
  `xendit_payment_id` varchar(191) DEFAULT NULL,
  `xendit_invoice_id` varchar(191) DEFAULT NULL,
  `xendit_external_id` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `xendit_payments_order_id_foreign` (`order_id`),
  CONSTRAINT `xendit_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `xendit_payments` WRITE;
/*!40000 ALTER TABLE `xendit_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `xendit_payments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

