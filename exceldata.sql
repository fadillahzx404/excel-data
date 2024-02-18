-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name_category`, `created_at`, `updated_at`) VALUES
(1,	'Data Baru',	'2024-02-04 04:12:08',	'2024-02-04 04:12:08'),
(2,	'Data Lama 1',	'2024-02-04 04:15:16',	'2024-02-04 04:17:34'),
(3,	'Data Designer',	'2024-02-18 06:49:46',	'2024-02-18 06:49:46');

DROP TABLE IF EXISTS `coloring_data_col`;
CREATE TABLE `coloring_data_col` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_details_id` bigint unsigned NOT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_col` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `data_details_id` (`data_details_id`),
  CONSTRAINT `coloring_data_col_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `coloring_data_col_ibfk_3` FOREIGN KEY (`data_details_id`) REFERENCES `data_details` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `coloring_data_col` (`id`, `data_details_id`, `header`, `color_col`, `user_id`, `created_at`, `updated_at`) VALUES
(30,	3,	'ID',	'#b36565',	1,	'2024-02-11 07:06:11',	'2024-02-11 07:06:11'),
(33,	5,	'ID',	'#d79393',	2,	'2024-02-18 06:55:27',	'2024-02-18 06:55:27');

DROP TABLE IF EXISTS `coloring_data_row`;
CREATE TABLE `coloring_data_row` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_details_id` bigint unsigned NOT NULL,
  `index_row` int NOT NULL,
  `color_row` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_details_id` (`data_details_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `coloring_data_row_ibfk_1` FOREIGN KEY (`data_details_id`) REFERENCES `data_details` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `coloring_data_row_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `coloring_data_row` (`id`, `data_details_id`, `index_row`, `color_row`, `user_id`, `created_at`, `updated_at`) VALUES
(12,	3,	1,	'#000000',	4,	'2024-02-11 07:04:19',	'2024-02-11 07:04:19');

DROP TABLE IF EXISTS `data_details`;
CREATE TABLE `data_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `datas_id` int unsigned DEFAULT NULL,
  `header_table` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `value_table` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `data_details_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `data_details` (`id`, `datas_id`, `header_table`, `value_table`, `user_id`, `created_at`, `updated_at`) VALUES
(3,	143,	'[\"ID\",\"Nama\"]',	'[[\"aa\",null],[null,null],[null,\"dd\"],[null,null],[null,\"cc\"]]',	NULL,	'2024-02-08 03:04:47',	'2024-02-08 03:04:47'),
(4,	145,	'[\"ID\",\"NAMA\",\"ALAMAT\"]',	'[[null,null,null],[null,null,null],[null,null,null],[null,null,null],[null,null,null]]',	NULL,	'2024-02-10 06:34:06',	'2024-02-10 06:34:06'),
(5,	146,	'[\"ID\",\"Nama\",\"Alamat\",\"Email\"]',	'[[\"1\",\"aaa\",null,null],[\"aaaaa\",\"aaa\",null,null],[\"bbbb\",null,null,null],[\"aaa\",null,null,null],[\"ggg\",null,null,null]]',	NULL,	'2024-02-18 06:50:52',	'2024-02-18 07:10:38'),
(6,	147,	'[\"Kolom 1\",\"kolom 2\",\"kolom 3\"]',	'[[null,null,null],[null,null,null],[null,null,null],[null,null,null],[null,null,null]]',	NULL,	'2024-02-18 07:13:00',	'2024-02-18 07:13:00'),
(7,	148,	'[\"Kolom 1\",\"Kolom 2\"]',	'[[null,null],[null,null],[null,null],[null,null],[null,null]]',	NULL,	'2024-02-18 07:19:48',	'2024-02-18 07:19:48'),
(8,	149,	'[\"id\"]',	'[[\"aaa\"],[null],[null],[null],[null],[null],[null],[null],[null],[null]]',	NULL,	'2024-02-18 07:23:36',	'2024-02-18 07:23:36'),
(9,	150,	'[\"ID 1\"]',	'[[\"ID1\"],[null],[null],[null],[null],[null],[null],[null],[null],[],[],[null]]',	NULL,	'2024-02-18 07:24:04',	'2024-02-18 07:24:04'),
(10,	151,	'[\"1\"]',	'[[null],[null],[null],[null],[null],[null],[null],[null],[null],[null]]',	NULL,	'2024-02-18 07:24:41',	'2024-02-18 07:24:41'),
(11,	152,	'[\"Kolom 1\"]',	'[[\"ID1\"],[null],[null],[null],[null],[null],[null],[null],[null],[null]]',	NULL,	'2024-02-18 07:25:16',	'2024-02-18 07:25:16'),
(12,	153,	'[\"AA\"]',	'[[\"ID1\"],[null],[null],[null],[null],[null],[null],[null],[null],[],[],[],[null]]',	NULL,	'2024-02-18 07:26:24',	'2024-02-18 07:26:24');

DROP TABLE IF EXISTS `datas`;
CREATE TABLE `datas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `datas_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `datas` (`id`, `nama_data`, `category_id`, `created_at`, `updated_at`) VALUES
(143,	'Test',	1,	'2024-02-08 03:04:47',	'2024-02-08 03:04:47'),
(146,	'Test 2',	1,	'2024-02-18 06:50:52',	'2024-02-18 07:10:38'),
(147,	'Baru 1',	1,	'2024-02-18 07:13:00',	'2024-02-18 07:13:00'),
(148,	'Hal 1',	1,	'2024-02-18 07:19:48',	'2024-02-18 07:19:48');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2014_10_12_200000_add_two_factor_columns_to_users_table',	1),
(4,	'2019_08_19_000000_create_failed_jobs_table',	1),
(5,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(6,	'2024_01_29_071732_create_sessions_table',	1),
(7,	'2024_01_29_075357_add_datas_table',	2),
(8,	'2024_02_04_101604_add_category_data_table',	3),
(9,	'2024_02_05_164639_add_table_datas_details',	4),
(10,	'2024_02_07_120034_add_table_datas_value_table',	5),
(11,	'2024_02_09_185549_add_coloring_col_data_table',	6);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Adm8xl2jBIhktAojWIexZImiE7xQh1qKTl4Nw0km',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',	'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzBkRm5CNVpDZUFETWtpRGVKcURDamw2YjFDSVphbFZqcGFLMktGOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9leGNlbC1kYXRhLnRlc3QiO319',	1708266953),
('HVdPBwjzlJDKrXW8daqKfhBC4znoLO0ktxirQVba',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',	'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSnBxTmVEcVdmSHRqU01RYmZWZnlTdFVCUExLb3ZUdkhZVDcwT0N3TSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cDovL2V4Y2VsLWRhdGEudGVzdC9kYXRhcyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vZXhjZWwtZGF0YS50ZXN0L2RhdGFzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',	1708263797);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `roles`) VALUES
(1,	'admin',	'admin@gmail.com',	NULL,	'$2y$12$9ncuRbq7zTKcFDQ36YhFbO3xJUwjptmtuioUw8UH30tvMDksXINKy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2024-01-29 00:26:15',	'2024-01-29 00:26:15',	'ADMIN'),
(2,	'Roni',	'design@gmail.com',	NULL,	'$2y$12$pT2au7UR/kfnp1nX.8WpAOJAlt.W54Hsqqxj2ZAKcfrR1ImWjZg2W',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2024-02-08 11:06:39',	'2024-02-08 11:06:39',	'DESIGNER'),
(4,	'Doni',	'operator@gmail.com',	NULL,	'$2y$12$JaoOMt3YdzGiR3bVQy/rf.2r8sGqC/1rntE3s8pR0W1Q5RK7T7xJW',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2024-02-11 06:45:12',	'2024-02-11 06:45:12',	'OPERATOR');

-- 2024-02-18 15:11:05
