-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2026 at 06:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pakar_motor`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gejalas`
--

CREATE TABLE `gejalas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_gejala` varchar(255) NOT NULL,
  `nama_gejala` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gejalas`
--

INSERT INTO `gejalas` (`id`, `kode_gejala`, `nama_gejala`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'G001', 'Mesin Tidak Bisa Dihidupkan', 'Motor tidak bisa dinyalakan sama sekali', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(2, 'G002', 'Mesin Mogok Saat Berjalan', 'Motor tiba-tiba mati saat dijalankan', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(3, 'G003', 'Busi Menyala Lemah', 'Percikan api pada busi tidak kuat', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(4, 'G004', 'Bensin Bocor dari Karburator', 'Bahan bakar keluar dari karburator', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(5, 'G005', 'Oli Berkurang', 'Oli mesin terus berkurang meskipun baru diganti', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(6, 'G006', 'Mesin Panas Berlebihan', 'Suhu mesin melebihi normal', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(7, 'G007', 'Baterai Lemah', 'Baterai tidak mampu menghidupkan motor', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(8, 'G008', 'Koil Rusak', 'Koil tidak menghasilkan tegangan', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(9, 'G009', 'Filter Udara Kotor', 'Filter udara penuh dengan debu', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(10, 'G010', 'Knalpot Mengeluarkan Asap Berlebihan', 'Asap keluar terlalu banyak dari knalpot', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(11, 'G011', 'Rantai Motor Melompat', 'Rantai melompat saat motor berjalan', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(12, 'G012', 'Rem Tidak Responsif', 'Rem tidak berfungsi dengan baik', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(13, 'G013', 'Ban Kempes', 'Ban tidak memiliki angin yang cukup', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(14, 'G014', 'Piston Mati', 'Piston tidak bergerak', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(15, 'G015', 'Knalpot Penyok', 'Knalpot mengalami kerusakan fisik', '2025-12-31 23:12:47', '2025-12-31 23:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kerusakans`
--

CREATE TABLE `kerusakans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kerusakan` varchar(255) NOT NULL,
  `nama_kerusakan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `solusi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kerusakans`
--

INSERT INTO `kerusakans` (`id`, `kode_kerusakan`, `nama_kerusakan`, `deskripsi`, `solusi`, `created_at`, `updated_at`) VALUES
(1, 'K001', 'Baterai Lemah', 'Baterai motor tidak mampu menghidupkan mesin', 'Ganti baterai dengan yang baru atau charge baterai ke tukang service', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(2, 'K002', 'Koil Rusak', 'Koil tidak dapat menghasilkan tegangan untuk busi', 'Ganti koil dengan yang baru di bengkel resmi', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(3, 'K003', 'Busi Kotor/Rusak', 'Busi tidak dapat menghasilkan percikan api', 'Bersihkan atau ganti busi dengan yang baru', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(4, 'K004', 'Karburator Tersumbat', 'Bensin tidak dapat mengalir dengan lancar', 'Buka karburator dan bersihkan saringan bensin', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(5, 'K005', 'Sistem Pendingin Tidak Berfungsi', 'Mesin panas berlebihan karena pendingin tidak bekerja', 'Periksa radiator dan bersihkan, ganti coolant jika perlu', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(6, 'K006', 'Seal Oli Bocor', 'Oli mesin bocor dari seal', 'Ganti seal oli dengan yang baru di bengkel', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(7, 'K007', 'Filter Udara Kotor', 'Filter udara penuh debu dan menghambat aliran udara', 'Bersihkan atau ganti filter udara', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(8, 'K008', 'Piston Aus', 'Piston mengalami keausan dan tidak berfungsi optimal', 'Ganti piston di bengkel dengan teknisi berpengalaman', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(9, 'K009', 'Rantai Motor Longgar', 'Rantai motor terlalu longgar dan sering melompat', 'Kencangkan rantai motor atau ganti jika sudah rusak', '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(10, 'K010', 'Kampas Rem Aus', 'Kampas rem sudah habis dan perlu diganti', 'Ganti kampas rem dengan yang baru', '2025-12-31 23:12:47', '2025-12-31 23:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasis`
--

CREATE TABLE `konsultasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kerusakan_id` bigint(20) UNSIGNED NOT NULL,
  `gejala_dipilih` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`gejala_dipilih`)),
  `confidence` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konsultasis`
--

INSERT INTO `konsultasis` (`id`, `user_id`, `kerusakan_id`, `gejala_dipilih`, `confidence`, `created_at`, `updated_at`) VALUES
(1, NULL, 4, '[2,4,9]', 88, '2025-12-31 23:31:47', '2025-12-31 23:31:47'),
(2, NULL, 10, '[1,2,4,10,12,14]', 96, '2025-12-31 23:33:17', '2025-12-31 23:33:17'),
(3, NULL, 4, '[4]', 29.33, '2025-12-31 23:34:23', '2025-12-31 23:34:23'),
(4, NULL, 7, '[1,6,9,10]', 91, '2026-01-01 02:17:13', '2026-01-01 02:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '0001_01_01_000000_create_users_table', 1),
(9, '0001_01_01_000001_create_cache_table', 1),
(10, '0001_01_01_000002_create_jobs_table', 1),
(11, '2025_12_31_062023_create_gejalas_table', 1),
(12, '2025_12_31_062228_create_kerusakans_table', 1),
(13, '2025_12_31_062344_create_rules_table', 1),
(14, '2025_12_31_065239_create_rule_gejala_table', 1),
(15, '2026_01_01_000000_create_konsultasis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kerusakan_id` bigint(20) UNSIGNED NOT NULL,
  `gejala_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`gejala_ids`)),
  `certainty_factor` double NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `kerusakan_id`, `gejala_ids`, `certainty_factor`, `created_at`, `updated_at`) VALUES
(1, 1, '\"[\\\"1\\\",\\\"2\\\",\\\"3\\\",\\\"7\\\"]\"', 0.95, '2025-12-31 23:12:47', '2026-01-01 02:57:16'),
(2, 2, '\"[1,3,8]\"', 0.9, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(3, 3, '\"[2,3]\"', 0.85, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(4, 4, '\"[2,4,9]\"', 0.88, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(5, 5, '\"[2,6]\"', 0.92, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(6, 6, '\"[5,6]\"', 0.89, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(7, 7, '\"[9,10]\"', 0.91, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(8, 8, '\"[2,5,6]\"', 0.87, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(9, 9, '\"[2,11]\"', 0.93, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(10, 10, '\"[12]\"', 0.96, '2025-12-31 23:12:47', '2025-12-31 23:12:47'),
(11, 9, '[\"11\"]', 1, '2026-01-01 02:29:08', '2026-01-01 02:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `rule_gejala`
--

CREATE TABLE `rule_gejala` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rule_id` bigint(20) UNSIGNED NOT NULL,
  `gejala_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aTF0KpAxPhBshP39MyiPda3IGKvpZykGg5eojaZ7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkJGbG42S1BDbGdHRlFmZW13NG9jN09EeW0wQktwYWxDMHZKTjlvdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1768025500),
('c6jSvXPMTF8UxHfzhfiCZUhQnCrlOeKFunpt2CLe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDl2bHN4TlpYUVRzaDVHQXhsMUVneGlYc1ZYa1A5cUlOR0duR2lpZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1768025830);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(4, 'Pras', 'prasetiodamarpuspoalam@gmail.com', NULL, '$2y$12$wvhamOrvvP/eCqrDSj4O9O.mgyVHMnvZnQKaQoYNYMBX5DtqzzU4C', NULL, '2026-01-01 06:20:50', '2026-01-01 06:20:50', NULL),
(5, 'root', 'root@system.com', NULL, '$2y$12$24TMg.1tuQobrvTOvYz19OoDu3DnlnmUcGz9ZsQ.jO0g8GxM1Fv5q', NULL, '2026-01-01 06:23:29', '2026-01-01 06:23:29', 'admin'),
(6, 'Tri', 'tri@gmail.com', NULL, '$2y$12$sMutltXjJ7Mm7pIDbNDFUeuNrzcUE1eQehJeSXaPTsUKHRgljXSJ6', NULL, '2026-01-01 06:39:36', '2026-01-01 06:39:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gejalas`
--
ALTER TABLE `gejalas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gejalas_kode_gejala_unique` (`kode_gejala`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerusakans`
--
ALTER TABLE `kerusakans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kerusakans_kode_kerusakan_unique` (`kode_kerusakan`);

--
-- Indexes for table `konsultasis`
--
ALTER TABLE `konsultasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konsultasis_user_id_foreign` (`user_id`),
  ADD KEY `konsultasis_kerusakan_id_foreign` (`kerusakan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rules_kerusakan_id_foreign` (`kerusakan_id`);

--
-- Indexes for table `rule_gejala`
--
ALTER TABLE `rule_gejala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rule_gejala_rule_id_foreign` (`rule_id`),
  ADD KEY `rule_gejala_gejala_id_foreign` (`gejala_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gejalas`
--
ALTER TABLE `gejalas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kerusakans`
--
ALTER TABLE `kerusakans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `konsultasis`
--
ALTER TABLE `konsultasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rule_gejala`
--
ALTER TABLE `rule_gejala`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konsultasis`
--
ALTER TABLE `konsultasis`
  ADD CONSTRAINT `konsultasis_kerusakan_id_foreign` FOREIGN KEY (`kerusakan_id`) REFERENCES `kerusakans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `konsultasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_kerusakan_id_foreign` FOREIGN KEY (`kerusakan_id`) REFERENCES `kerusakans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rule_gejala`
--
ALTER TABLE `rule_gejala`
  ADD CONSTRAINT `rule_gejala_gejala_id_foreign` FOREIGN KEY (`gejala_id`) REFERENCES `gejalas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rule_gejala_rule_id_foreign` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
