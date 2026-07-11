-- RRA EBM Module - Raw SQL Migrations
-- Run when MySQL is available: mysql -u root hyamii < Modules/RraEbm/Database/migrate.sql

-- 1. rra_ebm_settings table
CREATE TABLE IF NOT EXISTS `rra_ebm_settings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_id` BIGINT UNSIGNED NOT NULL,
  `enabled` TINYINT(1) NOT NULL DEFAULT 0,
  `tin_number` VARCHAR(20) NULL,
  `branch_id_rra` VARCHAR(20) NULL,
  `server_url` VARCHAR(255) NULL,
  `app_name` VARCHAR(255) NULL,
  `device_serial_no` VARCHAR(255) NULL,
  `machine_reference_code` VARCHAR(255) NULL,
  `security_key` VARCHAR(255) NULL,
  `auto_sync_products` TINYINT(1) NOT NULL DEFAULT 1,
  `submit_on_pos_complete` TINYINT(1) NOT NULL DEFAULT 1,
  `submit_on_online_order` TINYINT(1) NOT NULL DEFAULT 0,
  `submit_on_kiosk` TINYINT(1) NOT NULL DEFAULT 0,
  `last_initialized_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rra_ebm_settings_branch_id_unique` (`branch_id`),
  CONSTRAINT `rra_ebm_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. rra_ebm_receipt_signatures table
CREATE TABLE IF NOT EXISTS `rra_ebm_receipt_signatures` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` BIGINT UNSIGNED NOT NULL,
  `receipt_number` VARCHAR(255) NOT NULL,
  `internal_data` TEXT NULL,
  `receipt_signature` TEXT NOT NULL,
  `total_receipt_number` VARCHAR(255) NULL,
  `vsdc_receipt_publish_date` VARCHAR(255) NULL,
  `sdc_id` VARCHAR(255) NULL,
  `mrc_number` VARCHAR(255) NULL,
  `invoice_number` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `rra_ebm_receipt_signatures_order_id_index` (`order_id`),
  INDEX `rra_ebm_receipt_signatures_receipt_number_index` (`receipt_number`),
  CONSTRAINT `rra_ebm_receipt_signatures_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. rra_ebm_invoice_sequences table
CREATE TABLE IF NOT EXISTS `rra_ebm_invoice_sequences` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_id` BIGINT UNSIGNED NOT NULL,
  `last_number` BIGINT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rra_ebm_invoice_sequences_branch_id_unique` (`branch_id`),
  CONSTRAINT `rra_ebm_invoice_sequences_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Add RRA EBM columns to orders table
ALTER TABLE `orders`
  ADD COLUMN IF NOT EXISTS `rra_ebm_submitted` TINYINT(1) NOT NULL DEFAULT 0 AFTER `amount_paid`,
  ADD COLUMN IF NOT EXISTS `rra_ebm_submitted_at` TIMESTAMP NULL AFTER `rra_ebm_submitted`,
  ADD COLUMN IF NOT EXISTS `rra_ebm_attempts` INT NOT NULL DEFAULT 0 AFTER `rra_ebm_submitted_at`,
  ADD COLUMN IF NOT EXISTS `rra_ebm_error` TEXT NULL AFTER `rra_ebm_attempts`,
  ADD COLUMN IF NOT EXISTS `rra_ebm_queued` TINYINT(1) NOT NULL DEFAULT 0 AFTER `rra_ebm_error`;
