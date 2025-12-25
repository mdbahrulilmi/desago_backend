/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `app_akun_desa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_akun_desa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_akun_desa_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_biodata_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_biodata_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `desa_id` bigint unsigned NOT NULL,
  `nomor_kk` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `golongan_darah` enum('A','B','AB','O','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perkawinan` enum('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_hubungan_dalam_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cacat_fisik_mental` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ibu` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu_kandung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_ayah` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_sebelumnya` text COLLATE utf8mb4_unicode_ci,
  `alamat_sekarang` text COLLATE utf8mb4_unicode_ci,
  `memiliki_akta_kelahiran` tinyint DEFAULT NULL,
  `nomor_akta_kelahiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memiliki_akta_perkawinan` tinyint DEFAULT NULL,
  `nomor_akta_perkawinan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_perkawinan` date DEFAULT NULL,
  `memiliki_akta_perceraian` tinyint DEFAULT NULL,
  `nomor_akta_perceraian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidik_jari` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iris_mata` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanda_tangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_wajah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_biodata_user_nik_unique` (`nik`),
  KEY `app_biodata_user_user_id_foreign` (`user_id`),
  KEY `app_biodata_user_nomor_kk_index` (`nomor_kk`),
  KEY `app_biodata_user_nama_lengkap_index` (`nama_lengkap`),
  KEY `app_biodata_user_desa_id_index` (`desa_id`),
  CONSTRAINT `app_biodata_user_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `app_akun_desa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_biodata_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `app_password_reset_tokens_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_profil_desa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_profil_desa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `akun_desa_id` bigint unsigned NOT NULL,
  `nama_desa` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_desa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepala_desa` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci,
  `misi` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_profil_desa_akun_desa_id_foreign` (`akun_desa_id`),
  KEY `app_profil_desa_provinsi_id_foreign` (`provinsi_id`),
  KEY `app_profil_desa_kabupaten_id_foreign` (`kabupaten_id`),
  KEY `app_profil_desa_kecamatan_id_foreign` (`kecamatan_id`),
  CONSTRAINT `app_profil_desa_akun_desa_id_foreign` FOREIGN KEY (`akun_desa_id`) REFERENCES `app_akun_desa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_profil_desa_kabupaten_id_foreign` FOREIGN KEY (`kabupaten_id`) REFERENCES `regencies` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `app_profil_desa_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `districts` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `app_profil_desa_provinsi_id_foreign` FOREIGN KEY (`provinsi_id`) REFERENCES `provinces` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_socialmedias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_socialmedias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_socialmedias_user_id_foreign` (`user_id`),
  CONSTRAINT `app_socialmedias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_users_email_unique` (`email`),
  UNIQUE KEY `app_users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `districts` (
  `id` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency_id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `districts_regency_id_foreign` (`regency_id`),
  KEY `districts_id_index` (`id`),
  CONSTRAINT `districts_regency_id_foreign` FOREIGN KEY (`regency_id`) REFERENCES `regencies` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provinces` (
  `id` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `provinces_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `regencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regencies` (
  `id` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `regencies_province_id_foreign` (`province_id`),
  KEY `regencies_id_index` (`id`),
  CONSTRAINT `regencies_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `villages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `villages` (
  `id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `villages_district_id_foreign` (`district_id`),
  KEY `villages_id_index` (`id`),
  CONSTRAINT `villages_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (4,'2017_05_02_140432_create_provinces_tables',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (5,'2017_05_02_140444_create_regencies_tables',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (6,'2017_05_02_142019_create_districts_tables',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (7,'2017_05_02_143454_create_villages_tables',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (8,'2025_02_11_031541_create_social_media_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (9,'2025_02_11_072314_update_phone_in_users_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (10,'2025_02_26_081516_change_app_user_id_to_user_id_in_app_socialmedias',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (11,'2025_02_27_071849_add_avatar_to_app_users',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (12,'2025_02_28_032540_create_app_akun_desa_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (13,'2025_02_28_032554_create_app_profile_desa_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (14,'2025_02_28_032618_create_app_biodata_user_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (15,'2025_03_01_185106_update_field_default_nullable_from_app_biodata_user_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (16,'2025_12_08_062322_create_users_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (17,'2025_12_08_074759_create_app_password_reset_tokens_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (18,'2025_12_08_084046_update_default_nullable_name_users_table',1);
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES (19,'2025_12_10_131538_add_remember_token_to_users_table',2);
