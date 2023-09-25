-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2023 at 05:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-g0s45`
--

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_invoice` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pengiriman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rekening_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_invoice` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `konfirmasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `kode_invoice`, `user_id`, `pengiriman_id`, `rekening_id`, `total_invoice`, `status`, `konfirmasi`, `created_at`, `updated_at`) VALUES
(1, 'INV180920237M179', 3, 1, 2, '1137000', 4, 1, '2023-09-17 20:31:16', '2023-09-18 01:52:41'),
(2, 'INV18092023WZSLE', 3, 1, 2, '412000', 5, 0, '2023-09-18 00:51:59', '2023-09-18 01:09:45'),
(3, 'INV18092023H6YK9', 3, 1, 2, '92000', 1, 0, '2023-09-18 01:59:37', '2023-09-18 01:59:48'),
(4, 'INV18092023ADGQM', 3, 1, 2, '92000', 4, 1, '2023-09-18 02:00:50', '2023-09-18 02:16:18'),
(5, 'INV18092023LPYEV', 3, 1, 2, '380000', 1, 0, '2023-09-18 03:13:50', '2023-09-18 03:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produks`
--

CREATE TABLE `kategori_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_produks`
--

INSERT INTO `kategori_produks` (`id`, `kategori`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Fresh Fruit', 'images/Kategori-Produk-Fresh-Fruit6MfOQ.jpg', '2023-09-16 23:53:18', '2023-09-16 23:53:18'),
(2, 'Dried Fruit', 'images/Kategori-Produk-Dried-FruitMlZhq.jpg', '2023-09-16 23:53:40', '2023-09-16 23:53:40'),
(3, 'Drink Fruit', 'images/Kategori-Produk-Drink-FruitCaWci.jpg', '2023-09-16 23:54:03', '2023-09-16 23:54:03'),
(4, 'Vegetables', 'images/Kategori-Produk-VegetablesRpIOL.jpg', '2023-09-16 23:54:17', '2023-09-16 23:54:17');

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
(1, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(12, '2019_08_19_000000_create_failed_jobs_table', 2),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(14, '2023_09_16_215650_create_settings_table', 2),
(15, '2023_09_16_215936_create_profiles_table', 2),
(16, '2023_09_16_220630_create_kategori_produks_table', 2),
(17, '2023_09_16_220736_create_produks_table', 2),
(18, '2023_09_16_221057_create_rekenings_table', 2),
(19, '2023_09_16_221241_create_pengirimen_table', 2),
(20, '2023_09_16_221327_create_invoices_table', 2),
(21, '2023_09_16_221448_create_transaksis_table', 2),
(22, '2023_09_16_221517_create_pembayarans_table', 2),
(23, '2023_09_16_222002_add_field_google_map_to_settings', 3),
(24, '2023_09_17_062532_add_field_user_id_to_produks', 4),
(25, '2023_09_17_063651_add_field_judul_header_home_to_settings', 5),
(26, '2023_09_17_070424_create_tentangs_table', 6),
(27, '2023_09_18_050000_delete_field_user_id_in_rekenings', 7),
(28, '2023_09_18_083035_add_field_biaya_admin_to_settings', 8);

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
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `invoice_id`, `bukti`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/Bukti-Pembayaran-INV180920237M17902sRa.jpg', '2023-09-17 23:10:59', '2023-09-17 23:10:59'),
(2, 4, 'images/Bukti-Pembayaran-INV18092023ADGQM2b8Dq.jpg', '2023-09-18 02:01:13', '2023-09-18 02:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `pengirimen`
--

CREATE TABLE `pengirimen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pengiriman` varchar(255) NOT NULL,
  `biaya` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengirimen`
--

INSERT INTO `pengirimen` (`id`, `nama_pengiriman`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 'JNE', '12000', '2023-09-17 21:43:21', '2023-09-17 21:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kategoriproduk_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `gambar_1` varchar(255) DEFAULT NULL,
  `gambar_2` varchar(255) DEFAULT NULL,
  `gambar_3` varchar(255) DEFAULT NULL,
  `gambar_4` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `user_id`, `kategoriproduk_id`, `nama`, `slug`, `harga`, `stok`, `deskripsi`, `gambar`, `gambar_1`, `gambar_2`, `gambar_3`, `gambar_4`, `created_at`, `updated_at`) VALUES
(2, 4, 1, 'Crab Pool Security', 'crab-pool-security', '80000', 10, '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', 'images/Produk-Crab-Pool-Securitym254e.jpg', NULL, NULL, NULL, NULL, '2023-09-17 19:01:37', '2023-09-17 19:01:37'),
(3, 4, 1, 'Manggo', 'manggo', '75000', 1, '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', 'images/Produk-ManggoIlCP5.jpg', NULL, NULL, NULL, NULL, '2023-09-17 19:14:47', '2023-09-18 01:52:41'),
(4, 4, 1, 'Paket Buah', 'paket-buah', '300000', 2, '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', 'images/Produk-Paket-BuahBwcB5.jpg', 'images/Produk-1-Paket-BuahUiX6Z.jpg', 'images/Produk-2-Paket-Buah2Ui0E.jpg', 'images/Produk-3-Paket-BuahuFn5k.jpg', NULL, '2023-09-17 19:40:23', '2023-09-18 01:52:41'),
(5, 5, 4, 'Kangkung', 'kangkung', '80000', 9, '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br></span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', 'images/Produk-KangkungzYa3l.jpg', NULL, NULL, NULL, NULL, '2023-09-18 00:51:36', '2023-09-18 02:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tmpt_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` enum('L','P') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `no_telp`, `alamat`, `tmpt_lahir`, `tgl_lahir`, `jns_kelamin`, `foto`, `created_at`, `updated_at`) VALUES
(1, 3, '08982918281', '<p>Kp. Jauh RT 01/02<br>Kec. Dekat - DIMANA</p>', 'Bogor', '2001-01-01', 'L', 'images/Profile-Randy-SalimFDpch.jpg', '2023-09-16 23:11:10', '2023-09-17 23:37:11'),
(2, 4, '0898371277881', '<p>Bogor</p>', 'Bogor', '2001-01-01', 'L', 'images/Profile-Petani-1yaEkR.jpg', '2023-09-17 01:28:57', '2023-09-17 01:34:47'),
(3, 5, '08982918133', '<p>Jakarta</p>', 'Bogor', '2001-01-01', 'P', 'images/Profile-Petani-2sjT6w.jpg', '2023-09-18 00:48:38', '2023-09-18 00:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `rekenings`
--

CREATE TABLE `rekenings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_rekening` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekenings`
--

INSERT INTO `rekenings` (`id`, `nama_rekening`, `no_rekening`, `bank`, `created_at`, `updated_at`) VALUES
(2, 'Ogani', '829138181', 'BCA', '2023-09-17 22:04:12', '2023-09-17 22:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `google_maps` text NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `judul_header_home` text NOT NULL,
  `bg_header_home` varchar(255) NOT NULL,
  `bg_header_page` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_website`, `biaya_admin`, `saldo`, `email`, `no_telp`, `alamat`, `logo`, `favicon`, `google_maps`, `facebook`, `twitter`, `instagram`, `youtube`, `judul_header_home`, `bg_header_home`, `bg_header_page`, `created_at`, `updated_at`) VALUES
(1, 'Ogani', 10, 120500, 'ogani@example.com', '0898291828', '<p>60-49 Road 11378 New York<br></p>', 'images/Logo-OganijVTOm.png', 'images/Favicon-OganiUNwCk.png', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28228578955!2d106.74711702884997!3d-6.229569453132603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1694912181709!5m2!1sid!2sid', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instagram.com/', 'https://www.youtube.com/', 'Vegetable 100% Organic', 'images/BG-Header-Home-OganikJC5q.jpg', 'images/BG-Header-Page-OganiFAFS7.jpg', NULL, '2023-09-18 02:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `tentangs`
--

CREATE TABLE `tentangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tentangs`
--

INSERT INTO `tentangs` (`id`, `judul`, `gambar`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Tentang Ogani', 'images/Tentang-Tentang-OganiLdUZp.jpg', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><br></p>', '2023-09-17 00:18:18', '2023-09-17 00:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `invoice_id`, `produk_id`, `jumlah`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 3, '900000', '2023-09-17 20:31:16', '2023-09-17 20:48:49'),
(2, 1, 3, 3, '225000', '2023-09-17 20:31:21', '2023-09-17 21:11:02'),
(4, 2, 5, 5, '400000', '2023-09-18 00:51:59', '2023-09-18 00:51:59'),
(5, 3, 2, 1, '80000', '2023-09-18 01:59:37', '2023-09-18 01:59:37'),
(6, 4, 5, 1, '80000', '2023-09-18 02:00:50', '2023-09-18 02:00:50'),
(7, 5, 5, 1, '80000', '2023-09-18 03:13:50', '2023-09-18 03:13:50'),
(8, 5, 4, 1, '300000', '2023-09-18 03:13:53', '2023-09-18 03:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petani','pelanggan') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'admin@example.com', NULL, '$2y$10$UG8jLO3N1GCbMDyKYoNfSe91GE5xwrP21E3EZSmlvCkGPtVP9CJO6', 'admin', NULL, '2023-09-16 22:46:19', '2023-09-16 22:46:19'),
(3, 'Randy Salim', 'randysalim', 'randy@example.com', NULL, '$2y$10$foKIfjt93Fo0PpNMRja02OZJUpSF8r7QIFGwBZ6zvSzfdtu6yYIvG', 'pelanggan', NULL, '2023-09-16 23:11:10', '2023-09-16 23:11:10'),
(4, 'Petani 1', 'petani1', 'petani1@gmail.com', NULL, '$2y$10$cDhcB7wryH5Rs3LhewZzu.P9lH/3a1oD8wgQVSwAfgvHOxyMKcBrW', 'petani', NULL, '2023-09-17 01:28:57', '2023-09-17 01:28:57'),
(5, 'Petani 2', 'petani2', 'petani2@gmail.com', NULL, '$2y$10$UpKDc/C19te48NDrljN3munx7xzTydjTsaM5yOlzzwAMQawaQhXQO', 'petani', NULL, '2023-09-18 00:48:38', '2023-09-18 00:48:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_kode_invoice_unique` (`kode_invoice`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_pengiriman_id_foreign` (`pengiriman_id`),
  ADD KEY `invoices_rekening_id_foreign` (`rekening_id`);

--
-- Indexes for table `kategori_produks`
--
ALTER TABLE `kategori_produks`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `pengirimen`
--
ALTER TABLE `pengirimen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produks_kategoriproduk_id_foreign` (`kategoriproduk_id`),
  ADD KEY `produks_user_id_foreign` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_no_telp_unique` (`no_telp`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tentangs`
--
ALTER TABLE `tentangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_invoice_id_foreign` (`invoice_id`),
  ADD KEY `transaksis_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
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
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_produks`
--
ALTER TABLE `kategori_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengirimen`
--
ALTER TABLE `pengirimen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekenings`
--
ALTER TABLE `rekenings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tentangs`
--
ALTER TABLE `tentangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_pengiriman_id_foreign` FOREIGN KEY (`pengiriman_id`) REFERENCES `pengirimen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_rekening_id_foreign` FOREIGN KEY (`rekening_id`) REFERENCES `rekenings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_kategoriproduk_id_foreign` FOREIGN KEY (`kategoriproduk_id`) REFERENCES `kategori_produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
