-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2026 at 02:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surapia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktas`
--

CREATE TABLE `aktas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_kelahiran_id` bigint(20) UNSIGNED NOT NULL,
  `no_akta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_terbit` date NOT NULL,
  `file_akta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktas`
--

INSERT INTO `aktas` (`id`, `pengajuan_kelahiran_id`, `no_akta`, `tgl_terbit`, `file_akta`, `created_at`, `updated_at`) VALUES
(1, 6, '1231h12312j12j312321', '2026-06-03', NULL, '2026-06-06 00:41:05', '2026-06-06 00:41:05'),
(2, 5, '7318-LU-06062026-0001', '2026-06-06', NULL, '2026-06-06 00:50:40', '2026-06-06 00:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1780733908),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1780733908;', 1780733908),
('laravel-cache-77de68daecd823babbb58edb1c8e14d7106e83bb', 'i:5;', 1780841253),
('laravel-cache-77de68daecd823babbb58edb1c8e14d7106e83bb:timer', 'i:1780841253;', 1780841253),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:4;', 1780063276),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1780063276;', 1780063276),
('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:1;', 1780839177),
('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1780839177;', 1780839177),
('laravel-cache-livewire-rate-limiter:f75392eaabbe3ab8fe9f506eb1abf7dc2d2eb82c', 'i:1;', 1780734830),
('laravel-cache-livewire-rate-limiter:f75392eaabbe3ab8fe9f506eb1abf7dc2d2eb82c:timer', 'i:1780734830;', 1780734830);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faskes`
--

CREATE TABLE `faskes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_faskes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_faskes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` enum('RS','Puskesmas','Klinik') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faskes`
--

INSERT INTO `faskes` (`id`, `nama_faskes`, `kode_faskes`, `tipe`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'RSUD Lakipadada', 'RS-001', 'RS', 'Jl. Pongtiku No. 2, Makale, Tana Toraja', '2026-05-20 04:24:20', '2026-05-20 04:24:20'),
(2, 'Puskesmas Makale', 'PKM-001', 'Puskesmas', 'Kecamatan Makale, Tana Toraja', '2026-05-20 04:24:20', '2026-05-20 04:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"188eb88b-57f7-42d7-beee-14b9f2030dcb\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:64:\\\"Ada catatan revisi dari Disdukcapil untuk bayi rs baco: perbaiki\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:29:\\\"heroicon-o-exclamation-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"warning\\\";s:6:\\\"status\\\";s:7:\\\"warning\\\";s:5:\\\"title\\\";s:24:\\\"Permintaan Revisi Berkas\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"e01fc5a8-b136-44b7-aaad-01eca1ce5a02\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1780063776,\"delay\":null}', 0, NULL, 1780063776, 1780063776),
(2, 'default', '{\"uuid\":\"79f2d9a9-c0c2-4b44-9880-de1cd88bd463\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";N;s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";N;s:9:\\\"iconColor\\\";N;s:6:\\\"status\\\";N;s:5:\\\"title\\\";s:4:\\\"test\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"402e939a-cb4d-4acf-866e-6483033ddf11\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1780064109,\"delay\":null}', 0, NULL, 1780064109, 1780064109),
(3, 'default', '{\"uuid\":\"0a8d15f7-5ea3-4aa8-b668-96e40f533797\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";N;s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";N;s:9:\\\"iconColor\\\";N;s:6:\\\"status\\\";N;s:5:\\\"title\\\";s:1:\\\"x\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"d30204d1-184a-4368-86da-f14829ea3bd2\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1780064184,\"delay\":null}', 0, NULL, 1780064184, 1780064184);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_28_080442_create_faskes_table', 1),
(5, '2026_04_28_080442_create_pengajuan_kelahiran_table', 1),
(6, '2026_04_28_085533_create_aktas_table', 1),
(7, '2026_05_20_093805_update_status_on_pengajuan_kelahiran_table', 1),
(8, '2026_05_20_122107_add_role_and_faskes_id_to_users_table', 1),
(9, '2026_05_20_153010_add_ktp_kk_to_pengajuan_kelahirans_table', 2),
(10, '2026_05_20_153537_change_file_ktp_to_json_in_pengajuan_kelahiran_table', 3),
(11, '2026_05_21_053433_add_file_akta_to_aktas_table', 4),
(12, '2026_05_22_001900_add_siak_fields_to_pengajuan_kelahiran_table', 5),
(13, '2026_05_26_045836_add_file_akta_lahir_to_pengajuan_kelahiran_table', 6),
(14, '2026_05_29_140303_create_notifications_table', 7),
(16, '2026_06_06_072611_add_saksi_fields_to_pengajuan_kelahiran_table', 8),
(17, '2026_06_06_073510_add_file_buku_nikah_to_pengajuan_kelahiran_table', 9),
(18, '2026_06_06_074043_add_agama_rt_rw_to_pengajuan_kelahiran_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('044e387b-d58a-4508-8494-a6c2b27d08e0', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 3, '{\"actions\":[],\"body\":\"Pengajuan untuk bayi ZULFIKAR TANDIRERUNG telah divalidasi dan sedang diproses SIAK.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Berkas Terverifikasi\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 01:42:14', '2026-06-06 01:42:14'),
('06027283-f704-4e0e-9a5a-d578257f6cf7', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 2, '{\"actions\":[],\"body\":\"Pengajuan untuk bayi rs baco telah divalidasi dan sedang diproses SIAK.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Berkas Terverifikasi\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 00:35:55', '2026-06-06 00:35:55'),
('1bca3b38-a5dd-40ba-bf9a-8eeb6c8791fc', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 4, '{\"actions\":[],\"body\":\"Pengajuan baru dari Puskesmas Makale untuk bayi beso\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-information-circle\",\"iconColor\":\"info\",\"status\":\"info\",\"title\":\"Pengajuan Kelahiran Baru\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-07 06:07:02', '2026-06-07 06:07:02'),
('2f035a06-306e-4efa-8e50-623a3dac18a5', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 4, '{\"actions\":[],\"body\":\"Faskes Puskesmas Makale telah mengirimkan ulang berkas revisi untuk bayi ZULFIKAR TANDIRERUNG\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-information-circle\",\"iconColor\":\"info\",\"status\":\"info\",\"title\":\"Pengajuan Ulang Kelahiran\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 01:41:33', '2026-06-06 01:41:33'),
('33d5e325-8f52-4ee4-bfae-46b6524c4e71', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 1, '{\"actions\":[],\"body\":null,\"color\":null,\"duration\":\"persistent\",\"icon\":null,\"iconColor\":null,\"status\":null,\"title\":\"x\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-05-29 06:20:03', '2026-05-29 06:20:03'),
('53488fee-45ec-4696-981b-63b32bebcdbb', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 1, '{\"actions\":[],\"body\":\"Pengajuan baru dari Puskesmas Makale untuk bayi ZULFIKAR\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-information-circle\",\"iconColor\":\"info\",\"status\":\"info\",\"title\":\"Pengajuan Kelahiran Baru\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 01:37:57', '2026-06-06 01:37:57'),
('5b7eefa5-09e1-4cf2-960c-2e48c00d6693', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 3, '{\"actions\":[],\"body\":\"Akta Lahir untuk bayi ALIF telah diterbitkan. Silakan cetak & serahkan ke ortu.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Akta Lahir Selesai\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 00:17:31', '2026-06-06 00:17:31'),
('8f78e97f-7fa3-4ee4-8498-84a6cbc374c5', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 4, '{\"actions\":[],\"body\":\"Pengajuan baru dari Puskesmas Makale untuk bayi ZULFIKAR\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-information-circle\",\"iconColor\":\"info\",\"status\":\"info\",\"title\":\"Pengajuan Kelahiran Baru\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 01:37:57', '2026-06-06 01:37:57'),
('acf84df4-fdbd-4a22-b6e1-ec5bfbc3fe66', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 1, '{\"actions\":[],\"body\":\"Faskes Puskesmas Makale telah mengirimkan ulang berkas revisi untuk bayi ZULFIKAR TANDIRERUNG\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-information-circle\",\"iconColor\":\"info\",\"status\":\"info\",\"title\":\"Pengajuan Ulang Kelahiran\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 01:41:33', '2026-06-06 01:41:33'),
('e7326962-6918-497f-9889-72b731333146', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 3, '{\"actions\":[],\"body\":\"Ada catatan revisi dari Disdukcapil untuk bayi beso: coba\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Permintaan Revisi Berkas\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-07 06:12:34', '2026-06-07 06:12:34'),
('e934a31f-03df-4f6a-bc5a-18af86cefa24', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 1, '{\"actions\":[],\"body\":\"Pengajuan baru dari Puskesmas Makale untuk bayi beso\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-information-circle\",\"iconColor\":\"info\",\"status\":\"info\",\"title\":\"Pengajuan Kelahiran Baru\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-07 06:07:02', '2026-06-07 06:07:02'),
('ee9b4de6-4797-46af-813e-d1ef3229a350', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 1, '{\"actions\":[],\"body\":\"Pengajuan baru dari Puskesmas Makale untuk bayi ALIF\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-information-circle\",\"iconColor\":\"info\",\"status\":\"info\",\"title\":\"Pengajuan Kelahiran Baru\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 00:09:36', '2026-06-06 00:09:36'),
('fd0cfaf6-2c91-4ac0-820e-9e552338d9fa', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 3, '{\"actions\":[],\"body\":\"Pengajuan untuk bayi ALIF telah divalidasi dan sedang diproses SIAK.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Berkas Terverifikasi\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 00:16:01', '2026-06-06 00:16:01'),
('fd2ab1fe-2d39-4f77-ae0a-6ef238ccca0c', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 3, '{\"actions\":[],\"body\":\"Ada catatan revisi dari Disdukcapil untuk bayi ZULFIKAR: NAMA BAYI TIDAK BISA 1 KATA\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-exclamation-circle\",\"iconColor\":\"warning\",\"status\":\"warning\",\"title\":\"Permintaan Revisi Berkas\",\"view\":null,\"viewData\":[],\"format\":\"filament\"}', NULL, '2026-06-06 01:40:25', '2026-06-06 01:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_kelahiran`
--

CREATE TABLE `pengajuan_kelahiran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faskes_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_bayi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_dilahirkan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `jam_lahir` time NOT NULL,
  `kelahiran_ke` int(11) DEFAULT NULL,
  `jenis_kelahiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penolong_kelahiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat_bayi` int(11) NOT NULL,
  `panjang_bayi` int(11) DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ibu` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ayah` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kepala_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ktp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`file_ktp`)),
  `file_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ket_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_akta_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pengajuan_dikirim',
  `keterangan_status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_saksi_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_saksi_1` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_saksi_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik_saksi_2` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_buku_nikah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_kelahiran`
--

INSERT INTO `pengajuan_kelahiran` (`id`, `faskes_id`, `user_id`, `nama_bayi`, `jenis_kelamin`, `tempat_lahir`, `tempat_dilahirkan`, `tgl_lahir`, `jam_lahir`, `kelahiran_ke`, `jenis_kelahiran`, `penolong_kelahiran`, `berat_bayi`, `panjang_bayi`, `nama_ibu`, `nik_ibu`, `nama_ayah`, `nik_ayah`, `no_kk`, `nama_kepala_keluarga`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`, `file_ktp`, `file_kk`, `file_ket_lahir`, `file_akta_lahir`, `status`, `keterangan_status`, `created_at`, `updated_at`, `nama_saksi_1`, `nik_saksi_1`, `nama_saksi_2`, `nik_saksi_2`, `file_buku_nikah`, `agama`, `rt`, `rw`) VALUES
(1, 2, 3, 'anak', 'P', NULL, NULL, '2026-05-13', '10:10:10', NULL, NULL, NULL, 350, NULL, 'indo', '1234567890453453', 'ambe', '1232343534645756', NULL, NULL, NULL, NULL, NULL, NULL, '[\"kelahiran-files\\/01KS30MG3BCJE9JN2FZZDB5YTN.png\",\"kelahiran-files\\/01KS30MG3DXQ9NMTJ7P7MF9SKN.png\"]', 'kelahiran-files/01KS30MG3E5GMBAZRKH29TZMQ0.png', 'kelahiran-files/01KS2RD422BZ3AD67H02H8XNBW.png', NULL, 'selesai', 'data kurang', '2026-05-20 05:15:07', '2026-05-21 15:40:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 3, 'becce', 'P', NULL, NULL, '2026-05-21', '11:01:11', NULL, NULL, NULL, 100, NULL, 'indo', '1234567891356223', 'ambe', '1435788276278222', NULL, NULL, NULL, NULL, NULL, NULL, '[\"kelahiran-files\\/01KS5BDHZQTBKZ9F9J5C1G7V29.png\",\"kelahiran-files\\/01KS5BDHZRNV7HSRM2S1FGJDDM.png\"]', 'kelahiran-files/01KS5BDHZSGXPZY6YS1HMXVDC4.png', 'kelahiran-files/01KS5BDHZT9CBSZPY9WNN89C1B.png', NULL, 'selesai_tte', 'kurang berkas', '2026-05-21 05:25:53', '2026-05-25 20:43:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 3, 'becce lai', 'P', 'torah', 'Puskesmas', '2026-05-26', '11:11:11', 1, 'Tunggal', 'Bidan', 340, 60, 'lai', '1234325435645756', 'baco', '4234235346457546', '1234567890113124', 'aco', 'sulawesi selatan', 'Tana Toraja', 'toraja', 'toraja', '[\"kelahiran-files\\/01KSHA4KFDH7324S4G2PJTGSB2.png\",\"kelahiran-files\\/01KSHA4KFERGHZTF8CM27FSDM0.png\"]', 'kelahiran-files/01KSHA4KFFSZ97YV12HY6KDAY7.png', 'kelahiran-files/01KSHA4KFFSZ97YV12HY6KDAY8.png', 'akta-lahir-files/01KSHAR3G7VQZ3CFC59RE25CBF.png', 'selesai_tte', NULL, '2026-05-25 20:54:24', '2026-05-25 21:05:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 3, 'laso', 'L', 'torah', 'Puskesmas', '2026-05-26', '11:11:11', 10, 'Kembar 2', 'Bidan', 100, 30, 'becce', '1241242345234523', 'baco', '3423423423423423', '1242353456464575', 'bapak', 'Sulawesi Selatan', 'Tana Toraja', 'toraja', 'toraja', '[\"kelahiran-files\\/01KSHRASMFNRWG7VVT8MYY01TG.png\",\"kelahiran-files\\/01KSSXR4QCXSFQXR7FK2ZCV4KQ.png\"]', 'kelahiran-files/01KSSXQEPTN25A7EFXCA7PNW2S.png', 'kelahiran-files/01KSSXSSFEDDS2CENZG553771P.png', 'akta-lahir-files/01KSSXV4ZR1RT0XRYR06QJY9Q5.png', 'selesai', NULL, '2026-05-26 01:00:58', '2026-05-29 05:15:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 2, 'rs baco', 'P', 'torah', 'RS', '2026-05-29', '11:11:11', 1, 'Tunggal', 'Dokter', 100, 10, 'rsu', '1231234234524564', 'rush', '3423434543654645', '1232345346457564', 'soe', 'Sulawesi Selatan', 'Tana Toraja', 'menggkendek', 'mengkendek', '[\"kelahiran-files\\/01KST0JS62AD2F4T949HTYYZF3.png\",\"kelahiran-files\\/01KST0JS63PR52PGVZGV8EXJRK.png\"]', 'kelahiran-files/01KST0JS63PR52PGVZGV8EXJRM.png', 'kelahiran-files/01KST0JS64551CXQWGQZRNZ8HT.png', NULL, 'diproses_siak', NULL, '2026-05-29 06:00:33', '2026-06-06 00:35:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 3, 'ALIF', 'L', 'TANA TORAJA', 'RS', '2026-06-05', '12:00:00', 2, 'Tunggal', 'Dokter', 3000, 45, 'BECCE', '7318252524212737', 'BACO', '7318635363726282', '7318736373637363', 'BACO', 'Sulawesi Selatan', 'Tana Toraja', 'MAKALE', 'TARONGKO', '[\"kelahiran-files\\/01KTDZNXYFS8DAM62D5JQ1P8RT.png\",\"kelahiran-files\\/01KTDZNXYGSFZMC0S8QWJ8XBSD.png\"]', 'kelahiran-files/01KTDZNXYHC8K754M211VH2R2D.png', 'kelahiran-files/01KTDZNXYHC8K754M211VH2R2E.png', 'akta-lahir-files/01KTE04E726PV9KK5CPX969VA2.png', 'selesai', NULL, '2026-06-06 00:09:36', '2026-06-06 00:20:12', 'ASNI', '7326737837383738', 'ZUL', '7318637363783737', 'kelahiran-files/01KTDZNXYJVW0YJ2CBS82WT07M.png', 'Kristen', '1', '2'),
(7, 2, 3, 'ZULFIKAR TANDIRERUNG', 'L', 'TANA TORAJA', 'RS', '2026-06-04', '12:00:00', 2, 'Tunggal', 'Dokter', 3000, 45, 'ZAENAB', '7318094847463836', 'ZAINUDDIN', '7318028238383983', '7318098242742947', 'ZAINUDDIN', 'Sulawesi Selatan', 'Tana Toraja', 'MAKALE', 'TONDON MAMULLU', '[\"kelahiran-files\\/01KTE4QPDJ5D80RSNQ2A7NHW59.jpg\",\"kelahiran-files\\/01KTE4QPDMH8DCB0T6WQJ0R6JP.jpg\"]', 'kelahiran-files/01KTE4QPDMH8DCB0T6WQJ0R6JQ.jpg', 'kelahiran-files/01KTE4QPDNKX80X2GYRQ7CNW3Z.webp', NULL, 'diproses_siak', NULL, '2026-06-06 01:37:57', '2026-06-06 01:42:14', 'ASNI', '7326905984739383', 'MARDIN', '7318373737383566', 'kelahiran-files/01KTE4QPDNKX80X2GYRQ7CNW40.jpg', 'Islam', '1', '1'),
(8, 2, 3, 'beso', 'L', 'palee', 'RS', '2026-06-07', '11:11:00', 1, 'Tunggal', 'Dokter', 100, 100, 'bece', '1231232343534534', 'beso', '1231231231231231', '1231243234534534', 'best', 'Sulawesi Selatan', 'Tana Toraja', 'makale', 'makale', '[\"kelahiran-files\\/01KTH6H4NGT9ZCWA220PTYT8NF.png\",\"kelahiran-files\\/01KTH6H4NHE3N1QZA38T6NNJ1F.png\"]', 'kelahiran-files/01KTH6H4NJMHK609XQ1ND89T8N.png', 'kelahiran-files/01KTH6H4NJMHK609XQ1ND89T8P.png', NULL, 'revisi_faskes', 'coba', '2026-06-07 06:07:02', '2026-06-07 06:12:34', 'bes', '1231234123412312', 'bess', '1231231231231231', 'kelahiran-files/01KTH6H4NK3SPWB0JGZGEW0PPR.png', 'Kristen', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8FUYDLRHkncHBN5Q9QPupC16WM37jSEZg49uxXcO', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJPOHJkYzdMUWd4ekFKSU1wRGFoaDJKdUt0T3lZR0FFbHdyY1JOU0RpIiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780863353),
('9WnzOgq6N2IQwWwcKi37TiXsEYh82bNmREiG234c', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI3UE5FMmhrZHBCVzlUbTZMaFp1YXBOUGdYelpCSXhuc2h5cjA5RnQzIiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780871868),
('C5W1zoHNVbKfsmRilqZHMozK5mYhRDfcAwoR2qOj', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJIcm9YbmRrVERzZUNCZjFjN0V0ZWtpaUJhVjFsczlQY3RVTGV5d0U2IiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780896910),
('kNXdaQAAjwQl5ns35PBlrgOODkmIGZKFQLGXdk3Z', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJGOFJOTEtJMHJUd0hQcDllVjh3ZzVCc1RMZ0RoV3lhZFp5YVFoR0RhIiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780975696),
('KRnn2TaUq8yLZXuaPM4R0GOWa2qHv5lIdOLvUVCx', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJUbXNxV0xjNTJhSlAxUHZTakJqVnhTdEtlNmlyUk5QV1h2ZFFJN1FYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcGVuZ2FqdWFuLWtlbGFoaXJhbnMiLCJyb3V0ZSI6ImZpbGFtZW50LmFkbWluLnJlc291cmNlcy5wZW5nYWp1YW4ta2VsYWhpcmFucy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6IjFjMzIzOGE4ZmFhNGJlZGRmN2I1NWU1MTA0YzgyOWFjYTc5M2FlMTg2YjU3YTI4NGZlYWVjYzliOWM5ZWRmODIiLCJ0YWJsZXMiOnsiZGIwZDVkNmY3NzFkNzcyOWRhZDFkYmU0Y2MyYmI1MzFfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1hX2JheWkiLCJsYWJlbCI6Ik5hbWEgQW5hayIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0Z2xfbGFoaXIiLCJsYWJlbCI6IlRhbmdnYWwgTGFoaXIiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtYV9pYnUiLCJsYWJlbCI6Ik9yYW5nIFR1YSAoSWJ1KSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJmYXNrZXMubmFtYV9mYXNrZXMiLCJsYWJlbCI6IlJ1bWFoIFNha2l0IFwvIEZhc2tlcyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGF0dXMiLCJsYWJlbCI6IlN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiYzRhYjY5ZThmY2E1NmM2NWQ4MjM0NjI4OTY1YmQyZmJfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1lIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImVtYWlsIiwibGFiZWwiOiJFbWFpbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJDcmVhdGVkIGF0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOmZhbHNlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6dHJ1ZX1dLCJiNWViZmJmOTNlOTE2YTVmMDlkZTMzMjRmMmY2NTQ2ZF9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5vX2FrdGEiLCJsYWJlbCI6Ik5vIGFrdGEiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGVuZ2FqdWFuS2VsYWhpcmFuLm5hbWFfYmF5aSIsImxhYmVsIjoiTmFtYSBCYXlpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRnbF90ZXJiaXQiLCJsYWJlbCI6IlRnbCB0ZXJiaXQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiQ3JlYXRlZCBhdCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9XSwiOTVkZTcyMTVkN2VjODg5NTdlM2ZjZjQwNjY4ZDZiZDVfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1hX2JheWkiLCJsYWJlbCI6Ik5hbWEgYmF5aSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJmYXNrZXMubmFtYV9mYXNrZXMiLCJsYWJlbCI6IkZhc2tlcyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0Z2xfbGFoaXIiLCJsYWJlbCI6IlRnbCBsYWhpciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGF0dXMiLCJsYWJlbCI6IlN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJDcmVhdGVkIGF0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOmZhbHNlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6dHJ1ZX1dfX0=', 1780851864),
('YQbfrPdalUE7b9bxgZZjfGEk40cFcDQtpkH0V8gq', 3, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Safari/605.1.15', 'eyJfdG9rZW4iOiJCQ3RTUzRrb1RnMnlLbUNzZ3lZeVFpRHdBWGFoSWlBQWRLOXkyMFpWIiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjMsInBhc3N3b3JkX2hhc2hfd2ViIjoiNDEzMDE0ZGZmNGI1ODAwYzM5MDA5NjA5ODExMmIzOWQzZjAwNGQwMmJkZmNkMDg4NzUzMWM2NWI0M2I4ZDdhZSIsInRhYmxlcyI6eyI5NWRlNzIxNWQ3ZWM4ODk1N2UzZmNmNDA2NjhkNmJkNV9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWFfYmF5aSIsImxhYmVsIjoiTmFtYSBiYXlpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImZhc2tlcy5uYW1hX2Zhc2tlcyIsImxhYmVsIjoiRmFza2VzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRnbF9sYWhpciIsImxhYmVsIjoiVGdsIGxhaGlyIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InN0YXR1cyIsImxhYmVsIjoiU3RhdHVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IkNyZWF0ZWQgYXQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfV19LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9wZW5nYWp1YW4ta2VsYWhpcmFuc1wvOCIsInJvdXRlIjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnBlbmdhanVhbi1rZWxhaGlyYW5zLnZpZXcifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJmaWxhbWVudCI6W119', 1780841567);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin_disdukcapil',
  `faskes_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `faskes_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Disdukcapil', 'admin@disdukcapil.com', NULL, '$2y$12$DMvrHP7KpIcjCbx0lslXcO54lOdkNPfLICp2y1pM74riYTeOpQasi', 'admin_disdukcapil', NULL, 'lpVbKmJ7F3wBFFacqG2iM3emPihcVOxypKBSV22YT4GTivurPnIaDg1N3cEZ', '2026-05-20 04:24:21', '2026-06-07 05:30:19'),
(2, 'Petugas RSUD', 'faskes@rsud.com', NULL, '$2y$12$G.9BYq70yPbNoSLvGV7cpOFacGYFhtD2C8SVwEEzm69QXHwy9WDVa', 'petugas_faskes', 1, NULL, '2026-05-20 04:24:21', '2026-05-29 05:40:51'),
(3, 'Petugas PKM', 'faskes@pkm.com', NULL, '$2y$12$MDrqQJ7XbxzR8rTEfUFnB.e.T5K0WF1bgmYcNkbuaaZPbJuCQCBCW', 'petugas_faskes', 2, 'B1yxKJOMUyx9eBSGv4MnoPo8YKDbSlWgxVh2RiQwfhaM0qQxtI1pHGWuvC0h', '2026-05-20 04:24:21', '2026-06-05 23:15:41'),
(4, 'risal', 'risal@surapia.com', NULL, '$2y$12$ikeVNNDqVnLmKWIQhB76NOkCRZbrQnyXXh5wBYBKNjyi6GSX2VP3C', 'admin_disdukcapil', NULL, NULL, '2026-06-06 00:31:38', '2026-06-07 05:30:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktas`
--
ALTER TABLE `aktas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aktas_no_akta_unique` (`no_akta`),
  ADD KEY `aktas_pengajuan_kelahiran_id_foreign` (`pengajuan_kelahiran_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faskes`
--
ALTER TABLE `faskes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faskes_kode_faskes_unique` (`kode_faskes`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengajuan_kelahiran`
--
ALTER TABLE `pengajuan_kelahiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_kelahiran_faskes_id_foreign` (`faskes_id`),
  ADD KEY `pengajuan_kelahiran_user_id_foreign` (`user_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_faskes_id_foreign` (`faskes_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktas`
--
ALTER TABLE `aktas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faskes`
--
ALTER TABLE `faskes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pengajuan_kelahiran`
--
ALTER TABLE `pengajuan_kelahiran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktas`
--
ALTER TABLE `aktas`
  ADD CONSTRAINT `aktas_pengajuan_kelahiran_id_foreign` FOREIGN KEY (`pengajuan_kelahiran_id`) REFERENCES `pengajuan_kelahiran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_kelahiran`
--
ALTER TABLE `pengajuan_kelahiran`
  ADD CONSTRAINT `pengajuan_kelahiran_faskes_id_foreign` FOREIGN KEY (`faskes_id`) REFERENCES `faskes` (`id`),
  ADD CONSTRAINT `pengajuan_kelahiran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_faskes_id_foreign` FOREIGN KEY (`faskes_id`) REFERENCES `faskes` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
