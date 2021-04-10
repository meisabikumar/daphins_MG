-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2021 at 07:39 PM
-- Server version: 10.4.15-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u467066974_mgdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cricket_contests`
--

CREATE TABLE `cricket_contests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contest_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_remaining_entry` int(11) DEFAULT NULL,
  `entry_per_user` int(11) DEFAULT NULL,
  `entry_fee` int(11) DEFAULT NULL,
  `min_entry` int(11) DEFAULT NULL,
  `max_entry` int(11) DEFAULT NULL,
  `admin_per` double(8,2) DEFAULT NULL,
  `admin_amt` double(8,2) DEFAULT NULL,
  `winning_amt` double(8,2) DEFAULT NULL,
  `is_free` tinyint(1) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL,
  `game_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_confirmed` tinyint(1) DEFAULT NULL,
  `is_cancelled` tinyint(1) DEFAULT NULL,
  `breakdown` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`breakdown`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cricket_fixtures`
--

CREATE TABLE `cricket_fixtures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fixture_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `league_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localteam_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localteam_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`localteam_data`)),
  `visitorteam_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitorteam_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`visitorteam_data`)),
  `starting_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `live` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toss_won_team_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `winner_team_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `draw_noresult` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `man_of_match_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `man_of_series_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_overs_played` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elected` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `super_over` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_on` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localteam_dl_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`localteam_dl_data`)),
  `visitorteam_dl_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`visitorteam_dl_data`)),
  `rpc_overs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rpc_target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weather_report` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`weather_report`)),
  `active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cricket_fixture_player_credits_by_admins`
--

CREATE TABLE `cricket_fixture_player_credits_by_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `player_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `player_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cricket_fixture_teams`
--

CREATE TABLE `cricket_fixture_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixture_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `players` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`players`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `fixture`
--

CREATE TABLE `fixture` (
  `id` int(10) UNSIGNED NOT NULL,
  `fixture_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `league_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aggregate_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referee_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localteam_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitorteam_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `winner_team_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentaries` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendance` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pitch` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neutral_venue` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leg` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `football_contests`
--

CREATE TABLE `football_contests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contest_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_remaining_entry` int(11) DEFAULT NULL,
  `entry_per_user` int(11) DEFAULT NULL,
  `entry_fee` int(11) DEFAULT NULL,
  `min_entry` int(11) DEFAULT NULL,
  `max_entry` int(11) DEFAULT NULL,
  `admin_per` double(8,2) DEFAULT NULL,
  `admin_amt` double(8,2) DEFAULT NULL,
  `winning_amt` double(8,2) DEFAULT NULL,
  `is_free` tinyint(1) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL,
  `game_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_confirmed` tinyint(1) DEFAULT NULL,
  `is_cancelled` tinyint(1) DEFAULT NULL,
  `breakdown` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`breakdown`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `football_match_player_credits_by_admins`
--

CREATE TABLE `football_match_player_credits_by_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `player_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `player_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(67, '2014_10_12_000000_create_users_table', 2),
(68, '2014_10_12_100000_create_password_resets_table', 2),
(69, '2019_08_19_000000_create_failed_jobs_table', 2),
(70, '2021_03_02_185551_create_temp_users_table', 2),
(71, '2021_03_04_121200_fixture', 2),
(72, '2021_03_05_124019_teams', 2),
(73, '2021_03_09_095642_players', 2),
(74, '2021_03_22_015152_create_cricket_fixtures_table', 2),
(75, '2021_03_22_015155_create_cricket_fixture_teams_table', 2),
(76, '2021_03_22_230332_create_cricket_contests_table', 2),
(77, '2021_03_22_230356_create_football_contests_table', 2),
(78, '2021_03_23_003937_create_roanuz_recent_tournaments_table', 2),
(79, '2021_03_23_005907_create_roanuz_tournament_rounds_table', 2),
(80, '2021_03_23_013128_create_roanuz_matchs_table', 2),
(81, '2021_03_23_015209_create_roanuz_match_teams_table', 2),
(82, '2021_03_23_030730_create_unique_matchs_table', 2),
(83, '2021_03_23_030823_create_unique_teams_table', 2),
(84, '2021_03_25_000935_create_sportsmonk_fixtures_table', 2),
(85, '2021_03_25_005256_create_sportsmonk_match_teams_table', 2),
(86, '2021_03_25_015352_create_sportsmonk_matchs_table', 2),
(87, '2021_03_27_184828_create_user_contests_table', 2),
(88, '2021_03_27_185028_create_user_wallet_transactions_table', 2),
(89, '2021_04_04_040355_create_football_match_player_credits_by_admins_table', 2),
(90, '2021_04_04_040611_create_cricket_fixture_player_credits_by_admins_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `msisdn`
--

CREATE TABLE `msisdn` (
  `id` int(11) NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `msisdn`
--

INSERT INTO `msisdn` (`id`, `mobile`, `datetime`) VALUES
(1, '81', '2021-04-08 19:53:53'),
(2, '81', '2021-04-08 19:55:59'),
(3, '123456789', '2021-04-08 19:57:39'),
(4, 'N', '2021-04-08 20:07:53'),
(5, 'Number', '2021-04-08 20:07:56'),
(6, 'Mobile', '2021-04-08 20:08:01'),
(7, 'Mobile', '2021-04-08 20:08:39'),
(8, 'Mobile', '2021-04-09 02:06:03'),
(9, 'Mobile', '2021-04-09 06:41:06'),
(10, 'Mobile', '2021-04-09 07:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('07e8f0b02b430fca8d81efb3637124d1f7a126287da0c3ce29b0cb07c6a99141de89c09f9332ab4b', 4, 1, 'Personal Access Token', '[]', 0, '2021-04-02 22:53:22', '2021-04-02 22:53:22', '2022-04-02 22:53:22'),
('0a159d9ae8a5e299f5847a6b19d8d231600459d9b65029a503b6dd613bb2bc4bfcadef5b1549c86a', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 15:38:37', '2021-04-02 15:38:37', '2022-04-02 15:38:37'),
('0c5e8e225409bcd47a42f3f087c5429fa5dbaffd98169caf837255808a3b54d00a17cb1fe815dfb3', 10, 1, 'authToken', '[]', 0, '2021-04-02 17:21:07', '2021-04-02 17:21:07', '2022-04-02 17:21:07'),
('0fb82f05903ef0b455b0497ca4e645f320eea2ff00b117dd5bf094852fa4d616248341d879ff98c5', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 12:33:20', '2021-04-02 12:33:20', '2022-04-02 12:33:20'),
('20ad1ad1d46e880d9c535f31f7ad67b54202670181e5f641dd5c0a21982be6946a5e2431ebff7862', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 16:24:16', '2021-04-02 16:24:16', '2022-04-02 16:24:16'),
('26e79544b982f013f206e37b903262c15c0516abe21d3e07d8c8bc80f5ba5fd449d8f46c6371af98', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 16:21:07', '2021-04-02 16:21:07', '2022-04-02 16:21:07'),
('2abab6fab4cbfac25fafab2cde7e3b8207fbc3c66854b4ba228da40ea39345c85080db88d06789ed', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 02:07:57', '2021-04-02 02:07:57', '2022-04-02 02:07:57'),
('2b12f5f27a2ad411f0e7fa9eedb6dc53d894d7e44a94280d7f4d8c89320c2304da2e46b0fc892d40', 11, 1, 'Personal Access Token', '[]', 0, '2021-04-02 21:32:29', '2021-04-02 21:32:29', '2022-04-02 21:32:29'),
('34491c6c3cce36df8b391cc31de5e056a74556864b5413df7b4366f264457ff1d4dbb66e62ef56de', 11, 1, 'authToken', '[]', 0, '2021-04-02 21:29:26', '2021-04-02 21:29:26', '2022-04-02 21:29:26'),
('416e266b4d91b75dfaf0d25c12975f28b05a597769661eb8a9b0d6bb77ac789c7da8545bb4257add', 11, 1, 'Personal Access Token', '[]', 0, '2021-04-05 15:16:08', '2021-04-05 15:16:08', '2022-04-05 15:16:08'),
('4857e8f98330aaeb44b7ffd2f71375bb33c7d3207bda49cfb6b758dd8e6b624bb98fc93e10be3f0f', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 12:47:06', '2021-04-02 12:47:06', '2022-04-02 12:47:06'),
('577c0ae5f3b18e046127410a0a4e04a78e21ed5919f5ed811144b07a9751aaf533d21b1074b5abeb', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 12:47:29', '2021-04-02 12:47:29', '2022-04-02 12:47:29'),
('59eadc30640f09bc5ce402b10f41e8919c953c0b20eced3f3cd7a5813da3b1317a464977841efa2e', 3, 1, 'Personal Access Token', '[]', 0, '2021-04-02 20:47:35', '2021-04-02 20:47:35', '2022-04-02 20:47:35'),
('622347b0f7185560bc36aad840c363e1dd7d7e95a9747afc8554d9507ab6c500b4821d5520e4a7f7', 3, 1, 'Personal Access Token', '[]', 0, '2021-04-02 12:46:24', '2021-04-02 12:46:24', '2022-04-02 12:46:24'),
('6f8fd4c7a72de49caa475bb28a2c800a74bc61a517119c92443d7af3e2bd84a9f4e653a44302880a', 2, 1, 'authToken', '[]', 0, '2021-04-02 12:31:16', '2021-04-02 12:31:16', '2022-04-02 12:31:16'),
('770c3c0d98d8386977d7b765986530061908941f3cfd8a58c48eeaef74148a641c2a4aeca21379e0', 5, 1, 'authToken', '[]', 0, '2021-04-02 17:14:41', '2021-04-02 17:14:41', '2022-04-02 17:14:41'),
('7a630f643de0725cc619a863ddcb18e7380737d2def85d01841a031d613ba5b53fc45d0e2a568f18', 4, 1, 'Personal Access Token', '[]', 0, '2021-04-02 17:13:15', '2021-04-02 17:13:15', '2022-04-02 17:13:15'),
('802001ee8a9a2d18eccaef90862d3b837c2d053b6c1194f4365e32c1e3474942570b84e5f38dde74', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 15:49:23', '2021-04-02 15:49:23', '2022-04-02 15:49:23'),
('8b78c2404c4675659822ba8924bc77c848eb531ded9ee9a074ce8a1cb03f7f59481be583b47fd105', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 12:32:31', '2021-04-02 12:32:31', '2022-04-02 12:32:31'),
('90d201ce9cc0b8b194f7d9c60e826971bff36d6272885caec10fb4ee875b81d12239fdeaad9617be', 4, 1, 'Personal Access Token', '[]', 0, '2021-04-02 18:11:29', '2021-04-02 18:11:29', '2022-04-02 18:11:29'),
('939ce22c618698ff0121fa9c01eb1bce1917ccf42fe47a7f1cb60014423bb802932b0f049a7bee05', 6, 1, 'Personal Access Token', '[]', 0, '2021-04-02 17:18:28', '2021-04-02 17:18:28', '2022-04-02 17:18:28'),
('9e0717bc2a3eafba6429f14cf44ae62340ad3f3f70a4bc7ad88d94f7873b41785bccae5d43d68532', 7, 1, 'authToken', '[]', 0, '2021-04-02 17:17:47', '2021-04-02 17:17:47', '2022-04-02 17:17:47'),
('a0704d87cc597be98aad101741a58cd26d6ff309d1d0c6393b0ed003388e08034eabc0dcc972afb5', 6, 1, 'authToken', '[]', 0, '2021-04-02 17:16:15', '2021-04-02 17:16:15', '2022-04-02 17:16:15'),
('a8ddd4ab5c116114caadf57b8fb1f89a9436570c72603189805e9596550add94bd03ea3256b1a155', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 12:33:55', '2021-04-02 12:33:55', '2022-04-02 12:33:55'),
('b2a128365ae25d50247577038b704da798b99b687c99f8329dc5916ba5f72583dbb3d8393c186e2b', 4, 1, 'Personal Access Token', '[]', 0, '2021-04-02 22:48:48', '2021-04-02 22:48:48', '2022-04-02 22:48:48'),
('b3f357cb3cd7268d8b33ef50901e8ebdd0d7f3f03387bbd4ec5ab5af8da15a52081c6066c3e19175', 4, 1, 'Personal Access Token', '[]', 0, '2021-04-05 22:59:48', '2021-04-05 22:59:48', '2022-04-05 22:59:48'),
('b3f71f4dc58f6bc7c76ecc0e8d52d01cb8e6260b37a03a0cec70f60fc98596757bc2e297f9bd37e7', 1, 1, 'Personal Access Token', '[]', 0, '2021-04-02 01:55:28', '2021-04-02 01:55:28', '2022-04-02 01:55:28'),
('b856565abb3b470bc72ec7c4c270b45df4792f62888c1619de354337a87ece15f67720bbae115916', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 12:48:20', '2021-04-02 12:48:20', '2022-04-02 12:48:20'),
('baeb958b8a82e577fca62f18682213e86f3146094717bb851d6416110a527f39d56e9bfa1fbb25d0', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 16:12:53', '2021-04-02 16:12:53', '2022-04-02 16:12:53'),
('be02217847d1b09883528ad8a1ce0553453e21e4efa89c042e9bd3a46d1d153094be67c5e69b9a6d', 11, 1, 'Personal Access Token', '[]', 0, '2021-04-02 21:31:14', '2021-04-02 21:31:14', '2022-04-02 21:31:14'),
('ca1f7f26dd7dcb14fede72ed29c754b17e01a7d5ff14007e4458b77d41503a3ecc1c658a228a54c8', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 13:29:52', '2021-04-02 13:29:52', '2022-04-02 13:29:52'),
('d418e435f099b91735161066c4cca52535282684093df3e50763b84b21b59ecad4004017e388c81d', 3, 1, 'authToken', '[]', 0, '2021-04-02 12:45:33', '2021-04-02 12:45:33', '2022-04-02 12:45:33'),
('d5d883c7a0326cb3349a9c7afe111611b9445bedb75937c0b49ed43d4426c0f9042546dee8e6e2a2', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 16:34:45', '2021-04-02 16:34:45', '2022-04-02 16:34:45'),
('da277888f209ddd0f3135f2509f967bc08a39ec3a3a1f000814c707145d92b88ccf2a236719b0d18', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 13:32:40', '2021-04-02 13:32:40', '2022-04-02 13:32:40'),
('de482e46c267a0d7ac6b1157a957a32a4f2e97615421e251f67814c35f468a1c9f65df844324b4b3', 2, 1, 'authToken', '[]', 0, '2021-04-02 02:05:16', '2021-04-02 02:05:16', '2022-04-02 02:05:16'),
('e0696090dffb421e6ad198ab60460713f4ccfe33c001e81543b7cecf41f0cb8231e4384293cb6887', 2, 1, 'Personal Access Token', '[]', 0, '2021-04-02 16:36:14', '2021-04-02 16:36:14', '2022-04-02 16:36:14'),
('ea0be1414f701ea589b3a1d179a9a9ef692b9fb8f6a0bb135be641fa48f991a640c06a7269c9c16f', 11, 1, 'Personal Access Token', '[]', 0, '2021-04-06 01:20:42', '2021-04-06 01:20:42', '2022-04-06 01:20:42'),
('eaef9fe4cb1286fec24990a61eaacb0d0f8425e0aecbfb1282be029c344f58eb950a1b3c850c665f', 4, 1, 'authToken', '[]', 0, '2021-04-02 17:11:56', '2021-04-02 17:11:56', '2022-04-02 17:11:56'),
('ef0e1d23f254a3201fc33cc8fd9366ba0586fbdb630e80b7934509d9057e98e4c6081fb8f8a08fda', 6, 1, 'Personal Access Token', '[]', 0, '2021-04-02 17:17:08', '2021-04-02 17:17:08', '2022-04-02 17:17:08'),
('f33cf097d6e4d622dd44f5cfce5d155cf7f9e536799b9db3c4c69ef525da2060fe850cfd22d8cc74', 11, 1, 'Personal Access Token', '[]', 0, '2021-04-05 22:57:09', '2021-04-05 22:57:09', '2022-04-05 22:57:09'),
('fb55e538e7b211abdcd1567f534ce9a27040fdcf2660f8587621a0dcd67033c0f08a5ddd01aad208', 9, 1, 'authToken', '[]', 0, '2021-04-02 17:20:08', '2021-04-02 17:20:08', '2022-04-02 17:20:08'),
('fb5f79a1069093b2092393139da9a92b722c51ec00e48ff893198786e53adc2f39a4a7ee7f5fec58', 8, 1, 'authToken', '[]', 0, '2021-04-02 17:19:17', '2021-04-02 17:19:17', '2022-04-02 17:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'kelsVbtTy8KToGSP3cbbmO1NMAyfJoJmhaC6MsPZ', NULL, 'http://localhost', 1, 0, 0, '2021-04-01 20:17:43', '2021-04-01 20:17:43'),
(2, NULL, 'Laravel Password Grant Client', 'E6qLW0b8cJmywSoHuLJpOEXwHilA7Rn620trP0O1', 'users', 'http://localhost', 0, 1, 0, '2021-04-01 20:17:43', '2021-04-01 20:17:43');

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

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-04-01 20:17:43', '2021-04-01 20:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(10) UNSIGNED NOT NULL,
  `player_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `common_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthcountry` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthplace` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roanuz_matchs`
--

CREATE TABLE `roanuz_matchs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_away_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_home_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groups` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`groups`)),
  `stadium` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stadium`)),
  `round_teams` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`round_teams`)),
  `tournament_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_legal_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roanuz_match_teams`
--

CREATE TABLE `roanuz_match_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `players` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`players`)),
  `tournament_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_legal_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roanuz_recent_tournaments`
--

CREATE TABLE `roanuz_recent_tournaments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tournament_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competition_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competition_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competition_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roanuz_tournament_rounds`
--

CREATE TABLE `roanuz_tournament_rounds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `round_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groups` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`groups`)),
  `round_teams` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`round_teams`)),
  `tournament_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_legal_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pointing_system` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competition_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`competition_data`)),
  `tournament_teams` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tournament_teams`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sportsmonk_fixtures`
--

CREATE TABLE `sportsmonk_fixtures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fixture_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `league_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `league_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `league_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `league_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aggregate_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localteam_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localteam_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`localteam_data`)),
  `visitorteam_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitorteam_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`visitorteam_data`)),
  `winner_team_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weather_report` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`weather_report`)),
  `commentaries` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pitch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neutral_venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `winning_odds_calculated` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`formations`)),
  `scores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`scores`)),
  `coaches` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`coaches`)),
  `standings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`standings`)),
  `assistants` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`assistants`)),
  `leg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`colors`)),
  `deleted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sportsmonk_matchs`
--

CREATE TABLE `sportsmonk_matchs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fixture_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_away_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_home_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_start_date_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `league_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sportsmonk_match_teams`
--

CREATE TABLE `sportsmonk_match_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixture_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legacy_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `founded` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_season_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_placeholder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `players` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`players`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `teamId` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legacy_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_team` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `founded` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_season_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE `temp_users` (
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_users`
--

INSERT INTO `temp_users` (`mobile`, `otp`, `created_at`, `updated_at`) VALUES
('+919667439675', '2464', '2021-04-07 00:27:07', '2021-04-07 00:27:07'),
('+919667676054', '8311', '2021-04-08 19:16:55', '2021-04-08 19:16:55'),
('9', '2207', '2021-04-07 00:25:02', '2021-04-07 00:25:02'),
('96667676054', '3236', '2021-04-07 00:07:03', '2021-04-07 00:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `unique_matchs`
--

CREATE TABLE `unique_matchs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_away_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_home_team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tournament_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `API` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unique_teams`
--

CREATE TABLE `unique_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `players` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`players`)),
  `API` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` bigint(20) DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DOB` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` double(5,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_contests`
--

CREATE TABLE `user_contests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `contest_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `match_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_fee` double(5,2) NOT NULL,
  `players` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`players`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet_transactions`
--

CREATE TABLE `user_wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `contest_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `match_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cricket_contests`
--
ALTER TABLE `cricket_contests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cricket_fixtures`
--
ALTER TABLE `cricket_fixtures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cricket_fixture_player_credits_by_admins`
--
ALTER TABLE `cricket_fixture_player_credits_by_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cricket_fixture_teams`
--
ALTER TABLE `cricket_fixture_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fixture`
--
ALTER TABLE `fixture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `football_contests`
--
ALTER TABLE `football_contests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `football_match_player_credits_by_admins`
--
ALTER TABLE `football_match_player_credits_by_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msisdn`
--
ALTER TABLE `msisdn`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roanuz_matchs`
--
ALTER TABLE `roanuz_matchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roanuz_match_teams`
--
ALTER TABLE `roanuz_match_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roanuz_recent_tournaments`
--
ALTER TABLE `roanuz_recent_tournaments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roanuz_tournament_rounds`
--
ALTER TABLE `roanuz_tournament_rounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sportsmonk_fixtures`
--
ALTER TABLE `sportsmonk_fixtures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sportsmonk_matchs`
--
ALTER TABLE `sportsmonk_matchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sportsmonk_match_teams`
--
ALTER TABLE `sportsmonk_match_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_users`
--
ALTER TABLE `temp_users`
  ADD PRIMARY KEY (`mobile`);

--
-- Indexes for table `unique_matchs`
--
ALTER TABLE `unique_matchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unique_teams`
--
ALTER TABLE `unique_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_contests`
--
ALTER TABLE `user_contests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet_transactions`
--
ALTER TABLE `user_wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cricket_contests`
--
ALTER TABLE `cricket_contests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cricket_fixtures`
--
ALTER TABLE `cricket_fixtures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cricket_fixture_player_credits_by_admins`
--
ALTER TABLE `cricket_fixture_player_credits_by_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cricket_fixture_teams`
--
ALTER TABLE `cricket_fixture_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fixture`
--
ALTER TABLE `fixture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `football_contests`
--
ALTER TABLE `football_contests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `football_match_player_credits_by_admins`
--
ALTER TABLE `football_match_player_credits_by_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `msisdn`
--
ALTER TABLE `msisdn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roanuz_matchs`
--
ALTER TABLE `roanuz_matchs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roanuz_match_teams`
--
ALTER TABLE `roanuz_match_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roanuz_recent_tournaments`
--
ALTER TABLE `roanuz_recent_tournaments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roanuz_tournament_rounds`
--
ALTER TABLE `roanuz_tournament_rounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sportsmonk_fixtures`
--
ALTER TABLE `sportsmonk_fixtures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sportsmonk_matchs`
--
ALTER TABLE `sportsmonk_matchs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sportsmonk_match_teams`
--
ALTER TABLE `sportsmonk_match_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unique_matchs`
--
ALTER TABLE `unique_matchs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unique_teams`
--
ALTER TABLE `unique_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_contests`
--
ALTER TABLE `user_contests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_wallet_transactions`
--
ALTER TABLE `user_wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
