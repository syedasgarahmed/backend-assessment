-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 10:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eav_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$ygHvIpjDy6028XqWkBlJDuqxUOocI3Aobu.QDN7mFnl2c9eQaqNza', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'department', 'text', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(2, 'start_date', 'date', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(3, 'end_date', 'date', '2025-03-10 10:16:06', '2025-03-10 10:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2025_03_10_143425_create_projects_table', 1),
(11, '2025_03_10_161528_add_role_to_users_table', 2),
(12, '2025_03_11_062055_create_admins_table', 3),
(13, '2025_03_11_135726_add_column_timesheet_status_table', 4),
(14, '2025_03_12_065408_add_column_department_project_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Admin', 1, 'AdminToken', '4b91e7bc9b4769369ef5f290fc7b72d6bf400e6acc5d7b4ea1e3bffec87d10ab', '[\"*\"]', NULL, NULL, '2025-03-11 01:21:31', '2025-03-11 01:21:31'),
(2, 'App\\Models\\Admin', 1, 'AdminToken', '8b751e65be271f1768390fb7932d00c38f2c981d127ee99cb487faccc932909f', '[\"*\"]', NULL, NULL, '2025-03-11 01:31:51', '2025-03-11 01:31:51'),
(3, 'App\\Models\\Admin', 1, 'AdminToken', '81778a45f9cefa95a9100115145c773e0c80bca25f4fd4f1730deccee2fa44e3', '[\"*\"]', NULL, NULL, '2025-03-11 01:32:49', '2025-03-11 01:32:49'),
(4, 'App\\Models\\Admin', 1, 'AdminToken', '2795b60df89ff2492d05ea81d1476f862eece52627ff56b4701119a01f9230ee', '[\"*\"]', NULL, NULL, '2025-03-11 01:35:04', '2025-03-11 01:35:04'),
(5, 'App\\Models\\Admin', 1, 'AdminToken', '08ac629c03df7026b1ff1c70bcadfd74d49a503136e0ad9f14cd151f75c8d536', '[\"*\"]', NULL, NULL, '2025-03-11 01:38:27', '2025-03-11 01:38:27'),
(6, 'App\\Models\\Admin', 1, 'AdminToken', '16968a201b884e531983c12d193da168f45d9b0c4427387da8893d9afdcb4984', '[\"*\"]', NULL, NULL, '2025-03-11 03:26:17', '2025-03-11 03:26:17'),
(7, 'App\\Models\\Admin', 1, 'AdminToken', '0007dc339c026ae361daa3bac98387293fb6ebb90291df36c6b2f6319cab8ed7', '[\"*\"]', NULL, NULL, '2025-03-11 03:36:00', '2025-03-11 03:36:00'),
(8, 'App\\Models\\User', 27, 'UserToken', 'cf2e1a571028f69052a0c4624af911bc6ed8fbfed03dc3459ade9f93a0545eb6', '[\"*\"]', NULL, NULL, '2025-03-11 04:01:01', '2025-03-11 04:01:01'),
(9, 'App\\Models\\Admin', 1, 'AdminToken', '91192fd3c9229005846cb340c1105c6955019b6845b2df0a780f991d92ff5aaa', '[\"*\"]', NULL, NULL, '2025-03-11 05:07:03', '2025-03-11 05:07:03'),
(10, 'App\\Models\\User', 27, 'UserToken', '49000f8fc63e647a1cb16a41c4c3c512437a82444039792b923bc9e69f3f2484', '[\"*\"]', NULL, NULL, '2025-03-11 05:08:05', '2025-03-11 05:08:05'),
(11, 'App\\Models\\User', 29, 'UserToken', '6ba4c8f8a5129121070216e8b3282880cd1c9ffd05ba3133c84eb15e4d25a218', '[\"*\"]', NULL, NULL, '2025-03-11 05:39:54', '2025-03-11 05:39:54'),
(12, 'App\\Models\\User', 29, 'UserToken', 'fa44d29f3eaa58e32aaf62c21a7578f64495fcf430c20a00f4f147802e85a49d', '[\"*\"]', NULL, NULL, '2025-03-11 05:58:05', '2025-03-11 05:58:05'),
(13, 'App\\Models\\User', 31, 'UserToken', '4e28544ad7da5308653ba174e4bdfd48b540ec059a7d496d697ae5ed2b8bd301', '[\"*\"]', NULL, NULL, '2025-03-11 06:05:17', '2025-03-11 06:05:17'),
(14, 'App\\Models\\User', 31, 'UserToken', '94ac03f5b1d9ddda81158334fdcf91a9d9898171716dd872c12c8c9e49315361', '[\"*\"]', NULL, NULL, '2025-03-11 07:18:39', '2025-03-11 07:18:39'),
(15, 'App\\Models\\User', 27, 'UserToken', '4402140a14e8620605881248262588341dc2b33dcb63f4519fe0b69c0a39f706', '[\"*\"]', NULL, NULL, '2025-03-11 08:54:20', '2025-03-11 08:54:20'),
(16, 'App\\Models\\User', 31, 'UserToken', 'ef65d1eab270d4a8898505d0063352fc553817eeee3a1dd09936c88246554de7', '[\"*\"]', NULL, NULL, '2025-03-11 08:55:02', '2025-03-11 08:55:02'),
(17, 'App\\Models\\Admin', 1, 'AdminToken', '0748892a6c7df38493b9075e2fe9dbe79bbaba0730e5178324703d868127e3cb', '[\"*\"]', NULL, NULL, '2025-03-11 08:58:39', '2025-03-11 08:58:39'),
(18, 'App\\Models\\Admin', 1, 'AdminToken', '29e5bebcb97be63e595ac8e2506d1b10a45f898241ae722dc050e748ef378235', '[\"*\"]', NULL, NULL, '2025-03-11 22:59:48', '2025-03-11 22:59:48'),
(19, 'App\\Models\\User', 27, 'UserToken', '8681dd2ed62a0de101040f22bb72d9b73a4b0728e96ebdb3de7c98dd908851ec', '[\"*\"]', NULL, NULL, '2025-03-12 02:08:48', '2025-03-12 02:08:48'),
(20, 'App\\Models\\Admin', 1, 'AdminToken', '5cb13eec6266a39398ea9854dd8187d4d3113d2c6917b0bcea527d225008d20c', '[\"*\"]', NULL, NULL, '2025-03-12 02:15:17', '2025-03-12 02:15:17'),
(21, 'App\\Models\\User', 27, 'UserToken', 'd912dd9d227e9f9953381dab37e493f5489d29f86a8a93360b752ebd38436c37', '[\"*\"]', NULL, NULL, '2025-03-12 02:16:36', '2025-03-12 02:16:36'),
(22, 'App\\Models\\Admin', 1, 'AdminToken', '00c9ccf03e73ff8bdc6cd9fa89a2431a14e26d4ed039f9057832778ba23c0f20', '[\"*\"]', NULL, NULL, '2025-03-12 02:16:52', '2025-03-12 02:16:52'),
(23, 'App\\Models\\User', 32, 'UserToken', '6bb2ec6fa2fa010d36c9b07aeadfaa38ad2128b3390f47ebce9f6f1bd93122c5', '[\"*\"]', NULL, NULL, '2025-03-12 02:21:09', '2025-03-12 02:21:09'),
(24, 'App\\Models\\User', 33, 'UserToken', '82371b253a249b109a2062085d8b986e3380926cdc9cd74bb65b6d1f6536ae7e', '[\"*\"]', NULL, NULL, '2025-03-12 02:22:57', '2025-03-12 02:22:57'),
(25, 'App\\Models\\Admin', 1, 'AdminToken', '9aa49a1e24b0cf8543eb951bca4a14e4d3af3662f7c4e1d646e1854adcba07ed', '[\"*\"]', NULL, NULL, '2025-03-12 02:24:01', '2025-03-12 02:24:01'),
(26, 'App\\Models\\User', 27, 'UserToken', '30477a2342c49740764db8f34b1118c2bc1b824e02b9700f5dd6cad697ef4032', '[\"*\"]', NULL, NULL, '2025-03-12 03:15:53', '2025-03-12 03:15:53'),
(27, 'App\\Models\\User', 27, 'UserToken', 'e6fc23ac25e15a85b159a1b70161ba8c84305a7fdc087c50beface2f14a0308a', '[\"*\"]', NULL, NULL, '2025-03-12 03:18:20', '2025-03-12 03:18:20'),
(28, 'App\\Models\\Admin', 1, 'AdminToken', '5430a0736821959c80332fcd54175b7483bfc4ee1dc9d75d330fd1870f762873', '[\"*\"]', NULL, NULL, '2025-03-12 03:22:09', '2025-03-12 03:22:09'),
(29, 'App\\Models\\User', 27, 'UserToken', '6d23fb296a331a37a9716ce76664e72f9f6b405f70cf02391f82ff1dcbf7ccd6', '[\"*\"]', NULL, NULL, '2025-03-12 03:51:02', '2025-03-12 03:51:02'),
(30, 'App\\Models\\Admin', 1, 'AdminToken', '654166bc1a6393097ff96b9460f69adf563a04d7f97dc5bce19b8615834c2b7c', '[\"*\"]', NULL, NULL, '2025-03-12 03:54:14', '2025-03-12 03:54:14'),
(31, 'App\\Models\\Admin', 1, 'AdminToken', '358ea3ce1ba1a10ddd594c56cb6d275d79fd3e6e4bcc66af6716c3069993db33', '[\"*\"]', NULL, NULL, '2025-03-12 03:57:39', '2025-03-12 03:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL DEFAULT 'sales',
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `department`, `status`, `created_at`, `updated_at`) VALUES
(1, 'consequatur', 'sales', 'ongoing', '2025-03-10 10:08:59', '2025-03-10 10:08:59'),
(2, 'facilis', 'sales', 'ongoing', '2025-03-10 10:08:59', '2025-03-10 10:08:59'),
(3, 'ratione', 'sales', 'ongoing', '2025-03-10 10:08:59', '2025-03-10 10:08:59'),
(4, 'eius', 'sales', 'ongoing', '2025-03-10 10:10:10', '2025-03-10 10:10:10'),
(5, 'sit', 'sales', 'ongoing', '2025-03-10 10:10:10', '2025-03-10 10:10:10'),
(6, 'aliquid', 'sales', 'Ongoing', '2025-03-10 10:10:10', '2025-03-11 11:28:09'),
(7, 'ad', 'sales', 'New', '2025-03-10 10:16:06', '2025-03-12 01:57:17'),
(8, 'soluta', 'sales', 'ongoing', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(9, 'pariatur', 'sales', 'ongoing', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(10, 'Ecom-cart', 'sales', 'Ongoing', '2025-03-11 01:05:43', '2025-03-11 23:23:47'),
(11, 'qaqa', 'sales', 'New', '2025-03-11 11:09:45', '2025-03-11 11:09:45'),
(12, 'qqqq', 'sales', 'New', '2025-03-12 01:38:21', '2025-03-12 01:38:21'),
(13, 'afsdf', 'sales', 'New', '2025-03-12 01:38:46', '2025-03-12 01:38:46'),
(14, 'jjj', 'sales', 'New', '2025-03-12 01:57:37', '2025-03-12 01:57:37'),
(15, 'ooo', 'ooo', 'New', '2025-03-12 02:07:23', '2025-03-12 02:07:37'),
(16, 'qwade cart', 'sales', 'New', '2025-03-12 03:59:26', '2025-03-12 03:59:26'),
(17, 'Migrate Bcart', 'sales', 'New', '2025-03-12 03:59:56', '2025-03-12 03:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`) VALUES
(7, 10, 31),
(8, 10, 25),
(9, 10, 26),
(10, 10, 27),
(12, 7, 6),
(13, 15, 5),
(14, 15, 6);

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `hours` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timesheets`
--

INSERT INTO `timesheets` (`id`, `user_id`, `project_id`, `task_name`, `date`, `hours`, `status`, `created_at`, `updated_at`) VALUES
(2, 16, 7, 'Voluptatem provident sapiente qui repellendus aut hic illum.', '1982-11-24', 6, 'pending', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(6, 12, 8, 'Maxime quia quam sunt sit natus.', '1997-06-07', 1, 'pending', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(7, 6, 8, 'Consequuntur iure facere quo quasi aspernatur.', '1974-01-14', 7, 'In Progress', '2025-03-10 10:16:06', '2025-03-12 00:28:28'),
(8, 24, 8, 'Vel labore nam repellat eos et perferendis.', '1984-01-31', 7, 'pending', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(9, 15, 8, 'Minima autem voluptates doloribus voluptatibus.', '1977-11-30', 4, 'pending', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(10, 8, 8, 'Beatae voluptates est libero iste ut minus.', '1980-10-05', 3, 'pending', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(11, 5, 9, 'In et atque perspiciatis qui quia.', '2009-12-28', 3, 'Pending', '2025-03-10 10:16:06', '2025-03-12 00:48:15'),
(12, 19, 9, 'Sint cumque necessitatibus et.', '2018-05-06', 6, 'pending', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(13, 31, 9, 'Facilis omnis harum rerum.', '1980-08-15', 4, 'pending', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(14, 14, 9, 'Fuga animi praesentium sunt maxime praesentium sed temporibus.', '1978-07-15', 1, 'pending', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(15, 31, 9, 'Fugiat tempore dolores autem non.', '1998-12-04', 4, 'In Progress', '2025-03-10 10:16:06', '2025-03-11 08:45:47'),
(16, 31, 10, 'test', '2025-03-12', 2, 'pending', '2025-03-12 00:44:45', '2025-03-12 00:44:45'),
(17, 26, 10, 'asasas', '2025-03-27', 22, 'pending', '2025-03-12 00:50:27', '2025-03-12 00:50:27'),
(18, 27, 10, 'asasas', '2025-03-27', 22, 'pending', '2025-03-12 00:50:27', '2025-03-12 00:50:27'),
(19, 31, 10, 'asasas', '2025-03-27', 22, 'pending', '2025-03-12 00:50:27', '2025-03-12 00:50:27'),
(20, 26, 10, 'asasas', '2025-03-27', 22, 'pending', '2025-03-12 00:50:27', '2025-03-12 00:50:27'),
(21, 27, 10, 'asasas', '2025-03-27', 22, 'In Progress', '2025-03-12 00:50:27', '2025-03-12 02:10:54'),
(22, 31, 10, 'asasas', '2025-03-27', 22, 'pending', '2025-03-12 00:50:27', '2025-03-12 00:50:27'),
(23, 26, 10, 'qaqa', '2025-03-12', 1, 'pending', '2025-03-12 00:52:26', '2025-03-12 00:52:26'),
(24, 27, 10, 'qaqa', '2025-03-12', 1, 'pending', '2025-03-12 00:52:26', '2025-03-12 00:52:26'),
(25, 31, 10, 'qaqa', '2025-03-12', 1, 'pending', '2025-03-12 00:52:26', '2025-03-12 00:52:26'),
(26, 26, 10, 'qaqa', '2025-03-12', 1, 'pending', '2025-03-12 00:52:26', '2025-03-12 00:52:26'),
(27, 27, 10, 'qaqa', '2025-03-12', 1, 'pending', '2025-03-12 00:52:26', '2025-03-12 00:52:26'),
(28, 31, 10, 'qaqa', '2025-03-12', 1, 'pending', '2025-03-12 00:52:26', '2025-03-12 00:52:26'),
(29, 4, 2, 'qwerty', '2025-03-12', 2, 'In Progress', '2025-03-12 01:16:52', '2025-03-12 01:22:37'),
(30, 5, 2, 'qwerty', '2025-03-12', 2, 'pending', '2025-03-12 01:16:52', '2025-03-12 01:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(4, 'aa', 'ss', 'houston.rutherford@example.com', '$2y$12$G4bRMpnHFQxPeEEiekj5.uNOasq6TV1aPmBJ.Z4NidyUPzZTlp2k2', '2025-03-10 10:02:39', '2025-03-11 10:58:24'),
(5, 'Retha', 'Grant', 'brady38@example.com', '$2y$12$vvlL7bsUcyXFlaFC.lkrCu1/jP5fOIK4OFeI7RbSNmzWuIcm/DHsq', '2025-03-10 10:02:39', '2025-03-10 10:02:39'),
(6, 'Clarissa', 'Veum', 'terry.mustafa@example.org', '$2y$12$ZdP1Mpg07fy/9QdwLoyKJeEg8HRpKjwQ3xakP1PN8gcPf.jQ5yGWC', '2025-03-10 10:07:46', '2025-03-10 10:07:46'),
(7, 'Demarcus', 'Waelchi', 'jettie.kihn@example.com', '$2y$12$SoTqB4xgAt3U4DdKbVgj1eio0hPTEpyt/.2akqw1LBlOn25ijDNyK', '2025-03-10 10:07:46', '2025-03-10 10:07:46'),
(8, 'Leatha', 'Koch', 'oreichel@example.net', '$2y$12$J2yBd.vF.h41hRHcKfHsxOvkaRhqXs5jQPOhJpynGJJpy/hp6rswS', '2025-03-10 10:07:46', '2025-03-10 10:07:46'),
(9, 'Madyson', 'Wiegand', 'rylan31@example.org', '$2y$12$noQ.C7tmkzlzkm9WsdUL0O6suSnSJdJTCDpDfeEOxGw8WoUGkQQFW', '2025-03-10 10:07:46', '2025-03-10 10:07:46'),
(10, 'Bradly', 'Cro', 'xblanda@example.com', '$2y$12$OhN4c40IvhPGRQIAMlXMtOj1.Jlhfy8i3xmWNB/qTHZZpXv.PiPvW', '2025-03-10 10:07:46', '2025-03-11 23:28:12'),
(11, 'Carroll', 'Halvorson', 'helga.wisoky@example.com', '$2y$12$hN.6DlLV3fh8gjs9Cw4tUuNLzPkN5Yco0xXn85tprlltH0udJTOhG', '2025-03-10 10:08:59', '2025-03-10 10:08:59'),
(12, 'Jazmyn', 'Goldner', 'morar.nicolas@example.com', '$2y$12$AJg7XdZxFGajwWInjnMpceJUGFabm290dic2b0qVZRt7.ZjvquJ22', '2025-03-10 10:08:59', '2025-03-10 10:08:59'),
(13, 'Sherman', 'Nitzsche', 'fay.zechariah@example.org', '$2y$12$x7ZYXL7MN95.W5u8CS4kZO5YCx62wVwffMn/H0z/nM4vBzdOQTftW', '2025-03-10 10:08:59', '2025-03-10 10:08:59'),
(14, 'Vidal', 'Upton', 'rowan12@example.net', '$2y$12$bxKH/HlkkSNAyhov0MXVX.QBJ/QKhBGMD/TJ9U3nkS2QS32/uADIa', '2025-03-10 10:08:59', '2025-03-10 10:08:59'),
(15, 'Sonya', 'Waters', 'ddurgan@example.net', '$2y$12$eNsW9UxJFLDs3vChsKBeU.OPYt467keuxe9aqOUlaTzWXGBc7jk8a', '2025-03-10 10:08:59', '2025-03-10 10:08:59'),
(16, 'Wilton', 'Swift', 'laney58@example.net', '$2y$12$i8l1Sv4nOFRJzmzI4Diwn.7.fIKsKq6MG.Jx.Z3z87/J7EUfxQJD6', '2025-03-10 10:10:10', '2025-03-10 10:10:10'),
(17, 'Ciara', 'Hane', 'wdouglas@example.net', '$2y$12$tAVDYTmZ8CWpe2uvBnrRausDthJTWqYiJfE61lykseznP4HsG9HN6', '2025-03-10 10:10:10', '2025-03-10 10:10:10'),
(18, 'Angus', 'Jacobi', 'dreichert@example.com', '$2y$12$p/JmJ5isR9lKbkmMkxHTMeDoYLq/FXgy2Zs.BqA3D1dFh0oSgOdE2', '2025-03-10 10:10:10', '2025-03-10 10:10:10'),
(19, 'Keyon', 'Murazik', 'ulesch@example.com', '$2y$12$6wP/GBqmr0u1OfS0Noc9d.xQjJ9MlCjHJjfGTh2sJKL9uP.GWwOvu', '2025-03-10 10:10:10', '2025-03-10 10:10:10'),
(20, 'Maggie', 'Jerde', 'usmitham@example.org', '$2y$12$9YEnH..An.lNIaOe1C/Bw.84ZOIkqTDgevsHPpyLJJ5v9nOLDIFPW', '2025-03-10 10:10:10', '2025-03-10 10:10:10'),
(21, 'Hans', 'Koelpin', 'hilda.parker@example.org', '$2y$12$OBhPt9fforNc6chGC71s5e3OakW5dun0rQWVF8XQCXTIx5U5lDRum', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(22, 'Mohammed', 'Prohaska', 'tracy53@example.com', '$2y$12$jNghb7nwwfd9KO3.S63tFOv7B.KkqCVyvadei.crrIeLzIIJYK7Ee', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(23, 'Anjali', 'Hills', 'doug.bashirian@example.com', '$2y$12$LP9RwA/IR2BDBEwm8aPwieCzwgt4boVXAbF0/uf1A2jh2x1kgn4Pq', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(24, 'Jolie', 'Beatty', 'everette77@example.org', '$2y$12$iDOMbY4yIJz5uXEefe5QdOs1NNjrkcPMLzTKs.18NSOJ66CYFyJA.', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(25, 'Jameson', 'Schamberger', 'werner54@example.net', '$2y$12$5lJ5Lcc4DUxBW.UghOgLZujQcNPWURAwlfnJuy0UfHD.T6HFk0ozS', '2025-03-10 10:16:06', '2025-03-10 10:16:06'),
(26, 'Admin', 'User', 'admin@gmail.com', '$2y$10$ygHvIpjDy6028XqWkBlJDuqxUOocI3Aobu.QDN7mFnl2c9eQaqNza', '2025-03-10 10:55:37', '2025-03-10 10:55:37'),
(27, 'John', 'Doe', 'user@gmail.com', '$2y$10$ygHvIpjDy6028XqWkBlJDuqxUOocI3Aobu.QDN7mFnl2c9eQaqNza', '2025-03-10 10:55:37', '2025-03-10 10:55:37'),
(31, 'Syed Asgar', 'Ahmed', 'syedasgarahmed11@gmail.com', '$2y$12$momVTcC7UcyvwX/pZ89iYu2pdhLDBMMHnfEizZ6VjK7o2Cgux7CX2', '2025-03-11 06:01:47', '2025-03-11 06:01:47'),
(32, 'Syed Asgar', 'Ahmed', 'syedasgarahmed@gmail.com', '$2y$12$iqPnSN1B4HgSRebDzy5RMe9aORd7Dn/8mvPt/o9e8LDr2cYFjsKfO', '2025-03-12 02:20:51', '2025-03-12 02:20:51'),
(33, 'Syed Asgar', 'Ahmed', 'syed@gmail.com', '$2y$12$wHs493rh9TfKeR0Pc2wSn.1JzTlrNuiEvmMO8OHwEBczCt8N0COb6', '2025-03-12 02:22:39', '2025-03-12 02:22:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `entity_id` (`entity_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_values_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD CONSTRAINT `timesheets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timesheets_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
