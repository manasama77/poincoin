-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2021 at 05:50 AM
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
-- Database: `u505220122_bionerappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `role` enum('master_admin','marketing') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `cookies` varchar(100) DEFAULT NULL,
  `remember` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `username`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`, `cookies`, `remember`) VALUES
(1, 'master', 'admin', '$2y$10$63wfXBI8UMXeUs6uQtscoOzgbjtwOFAhZMG2G.GqTQA5WiWrW2IuO', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, 'xNoIxSc9EdQCLLhYUrkZz2dPJDbAXkWtDMBQ6SG8fAyH1Vn3OpO4qWazTE8lJbqR', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bioner_stacking`
--

CREATE TABLE `bioner_stacking` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(255) DEFAULT NULL COMMENT 'ID_USER.DDMMYY.##',
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `total_investment` decimal(15,4) UNSIGNED DEFAULT NULL,
  `total_transfer` decimal(15,4) UNSIGNED DEFAULT NULL,
  `profit_perhari_b` varchar(255) DEFAULT NULL,
  `profit_perhari_rp` decimal(15,4) UNSIGNED DEFAULT NULL,
  `status` enum('aktif','menunggu_transfer','menunggu_verifikasi','tidak_aktif') DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bioner_stacking`
--

INSERT INTO `bioner_stacking` (`id`, `kode`, `id_user`, `total_investment`, `total_transfer`, `profit_perhari_b`, `profit_perhari_rp`, `status`, `bukti_transfer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BS1.1301211', 1, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-13 10:05:40', '2021-01-18 07:00:05', NULL),
(2, 'BS2.1301211', 2, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-13 10:39:41', '2021-01-18 07:00:05', NULL),
(3, 'BS4.1401211', 4, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-14 17:03:40', '2021-01-14 17:03:40', '2021-01-15 18:47:37'),
(4, 'BS5.1401211', 5, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-14 18:18:38', '2021-01-18 07:00:05', NULL),
(5, 'BS6.1401211', 6, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-14 18:27:04', '2021-01-18 07:00:05', NULL),
(6, 'BS7.1401211', 7, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-14 18:44:26', '2021-01-18 07:00:05', NULL),
(7, 'BS8.1501211', 8, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-15 00:09:23', '2021-01-15 00:09:23', '2021-01-15 21:43:05'),
(8, 'BS9.1501211', 9, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-15 09:27:02', '2021-01-18 07:00:05', NULL),
(9, 'BS10.1501211', 10, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-15 11:36:55', '2021-01-15 11:36:55', '2021-01-15 22:49:34'),
(10, 'BS11.1501211', 11, '3.0000', '54100000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 20:34:41', '2021-01-15 20:34:41', '2021-01-15 20:37:39'),
(11, 'BS11.1501212', 11, '3.0000', '54100000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 20:34:59', '2021-01-15 20:34:59', '2021-01-15 20:37:19'),
(12, 'BS11.1501213', 11, '3.0000', '54100000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 20:38:35', '2021-01-15 20:38:35', '2021-01-15 21:42:07'),
(13, 'BS11.1501214', 11, '3.0000', '54000000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 20:41:51', '2021-01-15 20:41:51', '2021-01-15 21:42:14'),
(14, 'BS8.1501212', 8, '3.0000', '54000000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 21:17:41', '2021-01-15 21:17:41', '2021-01-15 21:42:41'),
(15, 'BS8.1501213', 8, '1100.0000', '16500000.0000', '5.5', '55000.0000', 'menunggu_transfer', NULL, '2021-01-15 21:41:42', '2021-01-15 21:41:42', '2021-01-15 21:42:52'),
(16, 'BS8.1501214', 8, '3600.0000', '54100000.0000', '18', '180000.0000', 'menunggu_transfer', NULL, '2021-01-15 21:43:31', '2021-01-15 21:43:31', '2021-01-15 21:49:21'),
(17, 'BS11.1501215', 11, '3300.0000', '49600000.0000', '16.5', '165000.0000', 'aktif', NULL, '2021-01-15 21:51:31', '2021-01-18 07:00:05', NULL),
(18, 'BS1.1601211', 1, '100.0000', '1500000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-16 02:24:16', '2021-01-18 07:00:05', NULL),
(19, 'BS5.1601211', 5, '21.0000', '315000.0000', '0.105', '1050.0000', 'aktif', NULL, '2021-01-16 05:28:45', '2021-01-18 07:00:05', NULL),
(20, 'BS17.1601211', 17, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-16 08:49:47', '2021-01-18 07:00:05', NULL),
(21, 'BS18.1601211', 18, '1500.0000', '22600000.0000', '7.5', '75000.0000', 'aktif', NULL, '2021-01-16 09:59:00', '2021-01-18 07:00:05', NULL),
(22, 'BS20.1601211', 20, '1400.0000', '21100000.0000', '7', '70000.0000', 'aktif', NULL, '2021-01-16 10:19:20', '2021-01-18 07:00:05', NULL),
(23, 'BS23.1601211', 23, '400.0000', '6100000.0000', '2', '20000.0000', 'aktif', NULL, '2021-01-16 10:57:53', '2021-01-18 07:00:05', NULL),
(24, 'BS19.1601211', 19, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-16 11:14:58', '2021-01-18 07:00:05', NULL),
(25, 'BS26.1601211', 26, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-16 11:36:45', '2021-01-18 07:00:05', NULL),
(26, 'BS16.1601211', 16, '400.0000', '6100000.0000', '2', '20000.0000', 'aktif', NULL, '2021-01-16 11:54:51', '2021-01-18 07:00:05', NULL),
(27, 'BS27.1601211', 27, '2600.0000', '39100000.0000', '13', '130000.0000', 'aktif', NULL, '2021-01-16 12:32:20', '2021-01-18 07:00:05', NULL),
(28, 'BS28.1601211', 28, '2700.0000', '40600000.0000', '13.5', '135000.0000', 'aktif', NULL, '2021-01-16 12:42:55', '2021-01-18 07:00:05', NULL),
(29, 'BS31.1601211', 31, '1000.0000', '15100000.0000', '5', '50000.0000', 'aktif', NULL, '2021-01-16 17:38:33', '2021-01-18 07:00:05', NULL),
(30, 'BS34.1601211', 34, '1800.0000', '27100000.0000', '9', '90000.0000', 'aktif', NULL, '2021-01-16 17:54:57', '2021-01-18 07:00:05', NULL),
(31, 'BS37.1601211', 37, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-16 17:57:17', '2021-01-18 07:00:05', NULL),
(32, 'BS36.1601211', 36, '600.0000', '9100000.0000', '3', '30000.0000', 'aktif', NULL, '2021-01-16 18:03:00', '2021-01-18 07:00:05', NULL),
(33, 'BS34.1601212', 34, '200.0000', '3000000.0000', '1', '10000.0000', 'aktif', NULL, '2021-01-16 18:10:09', '2021-01-18 07:00:05', NULL),
(34, 'BS32.1601211', 32, '3700.0000', '55600000.0000', '18.5', '185000.0000', 'aktif', NULL, '2021-01-16 18:45:44', '2021-01-18 07:00:05', NULL),
(35, 'BS48.1601211', 48, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-16 18:49:05', '2021-01-18 07:00:05', NULL),
(36, 'BS49.1601211', 49, '400.0000', '6100000.0000', '2', '20000.0000', 'aktif', NULL, '2021-01-16 19:02:45', '2021-01-18 07:00:05', NULL),
(37, 'BS53.1601211', 53, '1600.0000', '24100000.0000', '8', '80000.0000', 'aktif', NULL, '2021-01-16 19:03:49', '2021-01-18 07:00:05', NULL),
(38, 'BS54.1601211', 54, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-16 19:08:03', '2021-01-16 19:08:03', NULL),
(39, 'BS55.1601211', 55, '700.0000', '10600000.0000', '3.5', '35000.0000', 'aktif', NULL, '2021-01-16 19:18:47', '2021-01-18 07:00:05', NULL),
(40, 'BS57.1601211', 57, '1500.0000', '22600000.0000', '7.5', '75000.0000', 'aktif', NULL, '2021-01-16 20:11:25', '2021-01-18 07:00:05', NULL),
(41, 'BS59.1601211', 59, '200.0000', '3100000.0000', '1', '10000.0000', 'aktif', NULL, '2021-01-16 20:53:07', '2021-01-18 07:00:05', NULL),
(42, 'BS61.1601211', 61, '1100.0000', '16600000.0000', '5.5', '55000.0000', 'aktif', NULL, '2021-01-16 21:08:00', '2021-01-18 07:00:05', NULL),
(43, 'BS62.1601211', 62, '900.0000', '13600000.0000', '4.5', '45000.0000', 'aktif', NULL, '2021-01-16 21:12:15', '2021-01-18 07:00:05', NULL),
(44, 'BS3.1701211', 3, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-17 07:32:21', '2021-01-18 07:00:05', NULL),
(45, 'BS65.1701211', 65, '300.0000', '4600000.0000', '1.5', '15000.0000', 'aktif', NULL, '2021-01-17 09:19:50', '2021-01-18 07:00:05', NULL),
(46, 'BS71.1701211', 71, '700.0000', '10600000.0000', '3.5', '35000.0000', 'aktif', NULL, '2021-01-17 09:49:39', '2021-01-18 07:00:05', NULL),
(47, 'BS68.1701211', 68, '200.0000', '3100000.0000', '1', '10000.0000', 'aktif', NULL, '2021-01-17 10:03:43', '2021-01-18 07:00:05', NULL),
(48, 'BS9.1701211', 9, '100.0000', '1500000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-17 10:43:16', '2021-01-17 10:43:16', '2021-01-17 21:01:41'),
(49, 'BS74.1701211', 74, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-17 10:49:12', '2021-01-18 07:00:05', NULL),
(50, 'BS81.1701211', 81, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-17 11:08:07', '2021-01-18 07:00:05', NULL),
(51, 'BS77.1701211', 77, '200.0000', '3100000.0000', '1', '10000.0000', 'aktif', NULL, '2021-01-17 11:15:17', '2021-01-18 07:00:05', NULL),
(52, 'BS80.1701211', 80, '2000.0000', '30100000.0000', '10', '100000.0000', 'aktif', NULL, '2021-01-17 11:18:24', '2021-01-18 07:00:05', NULL),
(53, 'BS83.1701211', 83, '300.0000', '4600000.0000', '1.5', '15000.0000', 'aktif', NULL, '2021-01-17 11:37:20', '2021-01-18 07:00:05', NULL),
(54, 'BS86.1701211', 86, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-17 12:20:24', '2021-01-18 07:00:05', NULL),
(55, 'BS87.1701211', 87, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-17 12:33:15', '2021-01-18 07:00:05', NULL),
(56, 'BS89.1701211', 89, '900.0000', '13600000.0000', '4.5', '45000.0000', 'aktif', NULL, '2021-01-17 13:24:11', '2021-01-18 07:00:05', NULL),
(57, 'BS90.1701211', 90, '400.0000', '6100000.0000', '2', '20000.0000', 'aktif', NULL, '2021-01-17 13:48:28', '2021-01-18 07:00:05', NULL),
(58, 'BS92.1701211', 92, '400.0000', '6100000.0000', '2', '20000.0000', 'aktif', NULL, '2021-01-17 14:28:11', '2021-01-18 07:00:05', NULL),
(59, 'BS91.1701211', 91, '400.0000', '6100000.0000', '2', '20000.0000', 'aktif', NULL, '2021-01-17 14:44:35', '2021-01-18 07:00:05', NULL),
(60, 'BS94.1701211', 94, '1500.0000', '22600000.0000', '7.5', '75000.0000', 'aktif', NULL, '2021-01-17 14:56:07', '2021-01-18 07:00:05', NULL),
(61, 'BS97.1701211', 97, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-17 15:11:38', '2021-01-18 07:00:05', NULL),
(62, 'BS99.1701211', 99, '300.0000', '4600000.0000', '1.5', '15000.0000', 'aktif', NULL, '2021-01-17 15:30:47', '2021-01-18 07:00:05', NULL),
(63, 'BS100.1701211', 100, '200.0000', '3100000.0000', '1', '10000.0000', 'aktif', NULL, '2021-01-17 15:46:40', '2021-01-18 07:00:05', NULL),
(64, 'BS100.1701212', 100, '100.0000', '1500000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-17 15:47:22', '2021-01-18 07:00:05', NULL),
(65, 'BS101.1701211', 101, '1900.0000', '28600000.0000', '9.5', '95000.0000', 'aktif', NULL, '2021-01-17 16:52:32', '2021-01-18 07:00:05', NULL),
(66, 'BS102.1701211', 102, '1600.0000', '24100000.0000', '8', '80000.0000', 'aktif', NULL, '2021-01-17 17:10:29', '2021-01-18 07:00:05', NULL),
(67, 'BS105.1701211', 105, '400.0000', '6100000.0000', '2', '20000.0000', 'aktif', NULL, '2021-01-17 18:15:51', '2021-01-18 07:00:05', NULL),
(68, 'BS82.1701211', 82, '400.0000', '6100000.0000', '2', '20000.0000', 'aktif', NULL, '2021-01-17 18:31:25', '2021-01-18 07:00:05', NULL),
(69, 'BS78.1701211', 78, '700.0000', '10600000.0000', '3.5', '35000.0000', 'aktif', NULL, '2021-01-17 19:37:06', '2021-01-18 07:00:05', NULL),
(70, 'BS75.1701211', 75, '500.0000', '7600000.0000', '2.5', '25000.0000', 'aktif', NULL, '2021-01-17 19:59:31', '2021-01-18 07:00:05', NULL),
(71, 'BS110.1701211', 110, '400.0000', '6100000.0000', '2', '20000.0000', 'menunggu_transfer', NULL, '2021-01-17 20:05:46', '2021-01-17 20:05:46', NULL),
(72, 'BS111.1701211', 111, '400.0000', '6100000.0000', '2', '20000.0000', 'menunggu_transfer', NULL, '2021-01-17 20:08:39', '2021-01-17 20:08:39', NULL),
(73, 'BS109.1701211', 109, '800.0000', '12100000.0000', '4', '40000.0000', 'aktif', NULL, '2021-01-17 20:33:19', '2021-01-18 07:00:05', NULL),
(74, 'BS109.1701212', 109, '800.0000', '12000000.0000', '4', '40000.0000', 'menunggu_transfer', NULL, '2021-01-17 20:50:29', '2021-01-17 20:50:29', '2021-01-17 20:50:51'),
(75, 'BS115.1701211', 115, '700.0000', '10600000.0000', '3.5', '35000.0000', 'aktif', NULL, '2021-01-17 21:00:23', '2021-01-18 07:00:05', NULL),
(76, 'BS11.1701211', 11, '49.5000', '742500.0000', '0.2475', '2475.0000', 'aktif', NULL, '2021-01-17 22:40:32', '2021-01-18 07:00:05', NULL),
(77, 'BS10.1801211', 10, '600.0000', '9100000.0000', '3', '30000.0000', 'menunggu_transfer', NULL, '2021-01-18 10:52:42', '2021-01-18 10:52:42', '2021-01-18 10:58:09'),
(78, 'BS10.1801212', 10, '700.0000', '10600000.0000', '3.5', '35000.0000', 'aktif', NULL, '2021-01-18 10:59:08', '2021-01-18 10:59:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bioner_stacking_logs`
--

CREATE TABLE `bioner_stacking_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `id_bioner_stacking` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('investment','profit','withdraw','bonus','delete investment','return withdraw') DEFAULT NULL,
  `nominal_b` decimal(15,4) UNSIGNED DEFAULT NULL,
  `nominal_rp` decimal(15,4) UNSIGNED DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL COMMENT 'kode withdraw / kode investment',
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bioner_stacking_logs`
--

INSERT INTO `bioner_stacking_logs` (`id`, `id_user`, `id_bioner_stacking`, `type`, `nominal_b`, `nominal_rp`, `kode`, `keterangan`, `created_at`) VALUES
(1, 1, 1, 'investment', '100.0000', '1000000.0000', 'BS1.1301211', 'Investment sebesar 100.0000 Bioner', '2021-01-13 10:09:22'),
(2, 2, 2, 'investment', '100.0000', '1000000.0000', 'BS2.1301211', 'Investment sebesar 100.0000 Bioner', '2021-01-13 10:40:52'),
(3, 1, 1, 'profit', '0.5000', '5000.0000', 'BS1.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-14 07:00:05'),
(4, 2, 2, 'profit', '0.5000', '5000.0000', 'BS2.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-14 07:00:05'),
(5, 5, 4, 'investment', '100.0000', '1000000.0000', 'BS5.1401211', 'Investment sebesar 100.0000 Bioner', '2021-01-14 18:21:23'),
(6, 5, NULL, 'bonus', '10.0000', '100000.0000', 'BS6.1401211', 'Bonus Referral sebesar 10 Bioner dari user Muhammad Malik Abdul Azis', '2021-01-14 18:31:41'),
(7, 6, 5, 'investment', '100.0000', '1000000.0000', 'BS6.1401211', 'Investment sebesar 100.0000 Bioner', '2021-01-14 18:31:41'),
(8, 5, NULL, 'bonus', '10.0000', '100000.0000', 'BS7.1401211', 'Bonus Referral sebesar 10 Bioner dari user Endang', '2021-01-14 19:01:32'),
(9, 7, 6, 'investment', '100.0000', '1000000.0000', 'BS7.1401211', 'Investment sebesar 100.0000 Bioner', '2021-01-14 19:01:32'),
(10, 2, NULL, 'withdraw', '0.5000', '5000.0000', 'BSW2.1401211', 'Withdraw sebesar 0.5 Bioner', '2021-01-14 19:06:44'),
(11, 2, NULL, 'return withdraw', '0.5000', '5000.0000', 'BSW2.1401211', 'Return Withdraw sebesar 0.5000 Bioner to Profit', '2021-01-14 19:07:28'),
(12, 1, 1, 'profit', '0.5000', '5000.0000', 'BS1.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-15 07:00:05'),
(13, 2, 2, 'profit', '0.5000', '5000.0000', 'BS2.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-15 07:00:05'),
(14, 5, 4, 'profit', '0.5000', '5000.0000', 'BS5.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-15 07:00:05'),
(15, 6, 5, 'profit', '0.5000', '5000.0000', 'BS6.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-15 07:00:05'),
(16, 7, 6, 'profit', '0.5000', '5000.0000', 'BS7.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-15 07:00:05'),
(17, 6, NULL, 'bonus', '10.0000', '100000.0000', 'BS9.1501211', 'Bonus Referral sebesar 10 Bioner dari user Satria Utama', '2021-01-15 09:43:37'),
(18, 9, 8, 'investment', '100.0000', '1000000.0000', 'BS9.1501211', 'Investment sebesar 100.0000 Bioner', '2021-01-15 09:43:37'),
(19, 2, NULL, 'withdraw', '1.0000', '10000.0000', 'BSW2.1501211', 'Withdraw sebesar 1 Bioner', '2021-01-15 11:11:59'),
(20, 2, NULL, 'return withdraw', '1.0000', '10000.0000', 'BSW2.1501211', 'Return Withdraw sebesar 1.0000 Bioner to Profit', '2021-01-15 11:12:44'),
(21, 4, 3, 'delete investment', '100.0000', '1000000.0000', 'BS4.1401211', 'Investment Dibatalkan', '2021-01-15 18:47:37'),
(22, 2, NULL, 'withdraw', '1.0000', '10000.0000', 'BSW2.1501212', 'Withdraw sebesar 1 Bioner', '2021-01-15 20:21:07'),
(23, 2, NULL, 'return withdraw', '1.0000', '10000.0000', 'BSW2.1501212', 'Return Withdraw sebesar 1.0000 Bioner to Profit', '2021-01-15 20:21:59'),
(24, 11, 11, 'delete investment', '3.0000', '30000.0000', 'BS11.1501212', 'Investment Dibatalkan', '2021-01-15 20:37:19'),
(25, 11, 10, 'delete investment', '3.0000', '30000.0000', 'BS11.1501211', 'Investment Dibatalkan', '2021-01-15 20:37:39'),
(26, 11, 12, 'delete investment', '3.0000', '30000.0000', 'BS11.1501213', 'Investment Dibatalkan', '2021-01-15 21:42:07'),
(27, 11, 13, 'delete investment', '3.0000', '30000.0000', 'BS11.1501214', 'Investment Dibatalkan', '2021-01-15 21:42:14'),
(28, 8, 14, 'delete investment', '3.0000', '30000.0000', 'BS8.1501212', 'Investment Dibatalkan', '2021-01-15 21:42:41'),
(29, 8, 15, 'delete investment', '1100.0000', '11000000.0000', 'BS8.1501213', 'Investment Dibatalkan', '2021-01-15 21:42:52'),
(30, 8, 7, 'delete investment', '100.0000', '1000000.0000', 'BS8.1501211', 'Investment Dibatalkan', '2021-01-15 21:43:05'),
(31, 8, NULL, 'withdraw', '20.0000', '200000.0000', 'BSW8.1501211', 'Withdraw sebesar 20 Bioner', '2021-01-15 21:48:23'),
(32, 8, NULL, 'return withdraw', '20.0000', '200000.0000', 'BSW8.1501211', 'Return Withdraw sebesar 20.0000 Bioner to Profit', '2021-01-15 21:48:48'),
(33, 8, 16, 'delete investment', '3600.0000', '36000000.0000', 'BS8.1501214', 'Investment Dibatalkan', '2021-01-15 21:49:21'),
(34, 11, 17, 'investment', '3300.0000', '33000000.0000', 'BS11.1501215', 'Investment sebesar 3300.0000 Bioner', '2021-01-15 22:48:27'),
(35, 10, 9, 'delete investment', '100.0000', '1000000.0000', 'BS10.1501211', 'Investment Dibatalkan', '2021-01-15 22:49:34'),
(36, 1, 1, 'profit', '0.5000', '5000.0000', 'BS1.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 00:57:43'),
(37, 2, 2, 'profit', '0.5000', '5000.0000', 'BS2.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 00:57:43'),
(38, 5, 4, 'profit', '0.5000', '5000.0000', 'BS5.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 00:57:43'),
(39, 6, 5, 'profit', '0.5000', '5000.0000', 'BS6.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 00:57:43'),
(40, 7, 6, 'profit', '0.5000', '5000.0000', 'BS7.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 00:57:43'),
(41, 9, 8, 'profit', '0.5000', '5000.0000', 'BS9.1501211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 00:57:43'),
(42, 11, 17, 'profit', '16.5000', '165000.0000', 'BS11.1501215', 'Distribusi Profit Sebesar 16.5 Bioner', '2021-01-16 00:57:43'),
(43, 5, 19, 'investment', '21.0000', '315000.0000', 'BS5.1601211', 'Investment sebesar 21 Bioner dari Profit', '2021-01-16 05:28:45'),
(44, 5, 19, 'withdraw', '21.0000', '0.0000', 'BSW5.1601211', 'Withdraw sebesar 21 Bioner Untuk Investment BS5.1601211', '2021-01-16 05:28:45'),
(45, 1, 1, 'profit', '0.5000', '5000.0000', 'BS1.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 07:00:11'),
(46, 2, 2, 'profit', '0.5000', '5000.0000', 'BS2.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 07:00:11'),
(47, 5, 4, 'profit', '0.5000', '5000.0000', 'BS5.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 07:00:11'),
(48, 6, 5, 'profit', '0.5000', '5000.0000', 'BS6.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 07:00:11'),
(49, 7, 6, 'profit', '0.5000', '5000.0000', 'BS7.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 07:00:11'),
(50, 9, 8, 'profit', '0.5000', '5000.0000', 'BS9.1501211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-16 07:00:11'),
(51, 11, 17, 'profit', '16.5000', '165000.0000', 'BS11.1501215', 'Distribusi Profit Sebesar 16.5 Bioner', '2021-01-16 07:00:11'),
(52, 5, 19, 'profit', '0.1050', '1050.0000', 'BS5.1601211', 'Distribusi Profit Sebesar 0.105 Bioner', '2021-01-16 07:00:11'),
(53, 17, 20, 'investment', '100.0000', '1000000.0000', 'BS17.1601211', 'Investment sebesar 100.0000 Bioner', '2021-01-16 08:50:52'),
(54, 18, 21, 'investment', '1500.0000', '15000000.0000', 'BS18.1601211', 'Investment sebesar 1500.0000 Bioner', '2021-01-16 09:59:41'),
(55, 20, 22, 'investment', '1400.0000', '14000000.0000', 'BS20.1601211', 'Investment sebesar 1400.0000 Bioner', '2021-01-16 10:19:41'),
(56, 23, 23, 'investment', '400.0000', '4000000.0000', 'BS23.1601211', 'Investment sebesar 400.0000 Bioner', '2021-01-16 10:59:45'),
(57, 19, 24, 'investment', '100.0000', '1000000.0000', 'BS19.1601211', 'Investment sebesar 100.0000 Bioner', '2021-01-16 11:15:42'),
(58, 1, 18, 'investment', '100.0000', '1000000.0000', 'BS1.1601211', 'Investment sebesar 100.0000 Bioner', '2021-01-16 11:21:53'),
(59, 26, 25, 'investment', '100.0000', '1000000.0000', 'BS26.1601211', 'Investment sebesar 100.0000 Bioner', '2021-01-16 11:37:02'),
(60, 16, 26, 'investment', '400.0000', '4000000.0000', 'BS16.1601211', 'Investment sebesar 400.0000 Bioner', '2021-01-16 11:55:17'),
(61, 27, 27, 'investment', '2600.0000', '26000000.0000', 'BS27.1601211', 'Investment sebesar 2600.0000 Bioner', '2021-01-16 12:33:00'),
(62, 28, 28, 'investment', '2700.0000', '27000000.0000', 'BS28.1601211', 'Investment sebesar 2700.0000 Bioner', '2021-01-16 12:43:25'),
(63, 2, NULL, 'withdraw', '11.0000', '110000.0000', 'BSW2.1601211', 'Withdraw sebesar 11 Bioner', '2021-01-16 14:46:10'),
(64, 2, NULL, 'return withdraw', '11.0000', '110000.0000', 'BSW2.1601211', 'Return Withdraw sebesar 11.0000 Bioner to Profit', '2021-01-16 14:46:44'),
(65, 31, 29, 'investment', '1000.0000', '10000000.0000', 'BS31.1601211', 'Investment sebesar 1000.0000 Bioner', '2021-01-16 17:39:04'),
(66, 34, 30, 'investment', '1800.0000', '18000000.0000', 'BS34.1601211', 'Investment sebesar 1800.0000 Bioner', '2021-01-16 17:56:18'),
(67, 36, 32, 'investment', '600.0000', '6000000.0000', 'BS36.1601211', 'Investment sebesar 600.0000 Bioner', '2021-01-16 18:03:56'),
(68, 34, 33, 'investment', '200.0000', '2000000.0000', 'BS34.1601212', 'Investment sebesar 200.0000 Bioner', '2021-01-16 18:17:16'),
(69, 37, 31, 'investment', '100.0000', '1000000.0000', 'BS37.1601211', 'Investment sebesar 100.0000 Bioner', '2021-01-16 18:17:32'),
(70, 32, 34, 'investment', '3700.0000', '37000000.0000', 'BS32.1601211', 'Investment sebesar 3700.0000 Bioner', '2021-01-16 18:46:04'),
(71, 48, 35, 'investment', '100.0000', '1000000.0000', 'BS48.1601211', 'Investment sebesar 100.0000 Bioner', '2021-01-16 18:49:21'),
(72, 49, 36, 'investment', '400.0000', '4000000.0000', 'BS49.1601211', 'Investment sebesar 400.0000 Bioner', '2021-01-16 19:03:06'),
(73, 53, 37, 'investment', '1600.0000', '16000000.0000', 'BS53.1601211', 'Investment sebesar 1600.0000 Bioner', '2021-01-16 19:04:05'),
(74, 55, 39, 'investment', '700.0000', '7000000.0000', 'BS55.1601211', 'Investment sebesar 700.0000 Bioner', '2021-01-16 19:19:12'),
(75, 57, 40, 'investment', '1500.0000', '15000000.0000', 'BS57.1601211', 'Investment sebesar 1500.0000 Bioner', '2021-01-16 20:11:51'),
(76, 59, 41, 'investment', '200.0000', '2000000.0000', 'BS59.1601211', 'Investment sebesar 200.0000 Bioner', '2021-01-16 20:53:56'),
(77, 61, 42, 'investment', '1100.0000', '11000000.0000', 'BS61.1601211', 'Investment sebesar 1100.0000 Bioner', '2021-01-16 21:08:56'),
(78, 62, 43, 'investment', '900.0000', '9000000.0000', 'BS62.1601211', 'Investment sebesar 900.0000 Bioner', '2021-01-16 21:12:43'),
(79, 1, 1, 'profit', '0.5000', '5000.0000', 'BS1.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(80, 2, 2, 'profit', '0.5000', '5000.0000', 'BS2.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(81, 5, 4, 'profit', '0.5000', '5000.0000', 'BS5.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(82, 6, 5, 'profit', '0.5000', '5000.0000', 'BS6.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(83, 7, 6, 'profit', '0.5000', '5000.0000', 'BS7.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(84, 9, 8, 'profit', '0.5000', '5000.0000', 'BS9.1501211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(85, 11, 17, 'profit', '16.5000', '165000.0000', 'BS11.1501215', 'Distribusi Profit Sebesar 16.5 Bioner', '2021-01-17 07:00:12'),
(86, 1, 18, 'profit', '0.5000', '5000.0000', 'BS1.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(87, 5, 19, 'profit', '0.1050', '1050.0000', 'BS5.1601211', 'Distribusi Profit Sebesar 0.105 Bioner', '2021-01-17 07:00:12'),
(88, 17, 20, 'profit', '0.5000', '5000.0000', 'BS17.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(89, 18, 21, 'profit', '7.5000', '75000.0000', 'BS18.1601211', 'Distribusi Profit Sebesar 7.5 Bioner', '2021-01-17 07:00:12'),
(90, 20, 22, 'profit', '7.0000', '70000.0000', 'BS20.1601211', 'Distribusi Profit Sebesar 7 Bioner', '2021-01-17 07:00:12'),
(91, 23, 23, 'profit', '2.0000', '20000.0000', 'BS23.1601211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-17 07:00:12'),
(92, 19, 24, 'profit', '0.5000', '5000.0000', 'BS19.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(93, 26, 25, 'profit', '0.5000', '5000.0000', 'BS26.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(94, 16, 26, 'profit', '2.0000', '20000.0000', 'BS16.1601211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-17 07:00:12'),
(95, 27, 27, 'profit', '13.0000', '130000.0000', 'BS27.1601211', 'Distribusi Profit Sebesar 13 Bioner', '2021-01-17 07:00:12'),
(96, 28, 28, 'profit', '13.5000', '135000.0000', 'BS28.1601211', 'Distribusi Profit Sebesar 13.5 Bioner', '2021-01-17 07:00:12'),
(97, 31, 29, 'profit', '5.0000', '50000.0000', 'BS31.1601211', 'Distribusi Profit Sebesar 5 Bioner', '2021-01-17 07:00:12'),
(98, 34, 30, 'profit', '9.0000', '90000.0000', 'BS34.1601211', 'Distribusi Profit Sebesar 9 Bioner', '2021-01-17 07:00:12'),
(99, 37, 31, 'profit', '0.5000', '5000.0000', 'BS37.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(100, 36, 32, 'profit', '3.0000', '30000.0000', 'BS36.1601211', 'Distribusi Profit Sebesar 3 Bioner', '2021-01-17 07:00:12'),
(101, 34, 33, 'profit', '1.0000', '10000.0000', 'BS34.1601212', 'Distribusi Profit Sebesar 1 Bioner', '2021-01-17 07:00:12'),
(102, 32, 34, 'profit', '18.5000', '185000.0000', 'BS32.1601211', 'Distribusi Profit Sebesar 18.5 Bioner', '2021-01-17 07:00:12'),
(103, 48, 35, 'profit', '0.5000', '5000.0000', 'BS48.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-17 07:00:12'),
(104, 49, 36, 'profit', '2.0000', '20000.0000', 'BS49.1601211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-17 07:00:12'),
(105, 53, 37, 'profit', '8.0000', '80000.0000', 'BS53.1601211', 'Distribusi Profit Sebesar 8 Bioner', '2021-01-17 07:00:12'),
(106, 55, 39, 'profit', '3.5000', '35000.0000', 'BS55.1601211', 'Distribusi Profit Sebesar 3.5 Bioner', '2021-01-17 07:00:12'),
(107, 57, 40, 'profit', '7.5000', '75000.0000', 'BS57.1601211', 'Distribusi Profit Sebesar 7.5 Bioner', '2021-01-17 07:00:12'),
(108, 59, 41, 'profit', '1.0000', '10000.0000', 'BS59.1601211', 'Distribusi Profit Sebesar 1 Bioner', '2021-01-17 07:00:12'),
(109, 61, 42, 'profit', '5.5000', '55000.0000', 'BS61.1601211', 'Distribusi Profit Sebesar 5.5 Bioner', '2021-01-17 07:00:12'),
(110, 62, 43, 'profit', '4.5000', '45000.0000', 'BS62.1601211', 'Distribusi Profit Sebesar 4.5 Bioner', '2021-01-17 07:00:12'),
(111, 28, NULL, 'withdraw', '10.0000', '100000.0000', 'BSW28.1701211', 'Withdraw sebesar 10 Bioner', '2021-01-17 08:48:22'),
(112, 65, 45, 'investment', '300.0000', '3000000.0000', 'BS65.1701211', 'Investment sebesar 300.0000 Bioner', '2021-01-17 09:21:48'),
(113, 71, 46, 'investment', '700.0000', '7000000.0000', 'BS71.1701211', 'Investment sebesar 700.0000 Bioner', '2021-01-17 09:50:24'),
(114, 68, 47, 'investment', '200.0000', '2000000.0000', 'BS68.1701211', 'Investment sebesar 200.0000 Bioner', '2021-01-17 10:04:24'),
(115, 74, 49, 'investment', '100.0000', '1000000.0000', 'BS74.1701211', 'Investment sebesar 100.0000 Bioner', '2021-01-17 10:49:57'),
(116, 81, 50, 'investment', '100.0000', '1000000.0000', 'BS81.1701211', 'Investment sebesar 100.0000 Bioner', '2021-01-17 11:08:23'),
(117, 77, 51, 'investment', '200.0000', '2000000.0000', 'BS77.1701211', 'Investment sebesar 200.0000 Bioner', '2021-01-17 11:15:34'),
(118, 80, 52, 'investment', '2000.0000', '20000000.0000', 'BS80.1701211', 'Investment sebesar 2000.0000 Bioner', '2021-01-17 11:18:38'),
(119, 83, 53, 'investment', '300.0000', '3000000.0000', 'BS83.1701211', 'Investment sebesar 300.0000 Bioner', '2021-01-17 11:38:23'),
(120, 86, 54, 'investment', '100.0000', '1000000.0000', 'BS86.1701211', 'Investment sebesar 100.0000 Bioner', '2021-01-17 12:20:54'),
(121, 87, 55, 'investment', '100.0000', '1000000.0000', 'BS87.1701211', 'Investment sebesar 100.0000 Bioner', '2021-01-17 12:33:42'),
(122, 89, 56, 'investment', '900.0000', '9000000.0000', 'BS89.1701211', 'Investment sebesar 900.0000 Bioner', '2021-01-17 13:24:45'),
(123, 90, 57, 'investment', '400.0000', '4000000.0000', 'BS90.1701211', 'Investment sebesar 400.0000 Bioner', '2021-01-17 13:48:56'),
(124, 92, 58, 'investment', '400.0000', '4000000.0000', 'BS92.1701211', 'Investment sebesar 400.0000 Bioner', '2021-01-17 14:29:06'),
(125, 91, 59, 'investment', '400.0000', '4000000.0000', 'BS91.1701211', 'Investment sebesar 400.0000 Bioner', '2021-01-17 14:45:10'),
(126, 94, 60, 'investment', '1500.0000', '15000000.0000', 'BS94.1701211', 'Investment sebesar 1500.0000 Bioner', '2021-01-17 14:56:48'),
(127, 97, 61, 'investment', '100.0000', '1000000.0000', 'BS97.1701211', 'Investment sebesar 100.0000 Bioner', '2021-01-17 15:11:58'),
(128, 99, 62, 'investment', '300.0000', '3000000.0000', 'BS99.1701211', 'Investment sebesar 300.0000 Bioner', '2021-01-17 15:31:16'),
(129, 3, 44, 'investment', '100.0000', '1000000.0000', 'BS3.1701211', 'Investment sebesar 100.0000 Bioner', '2021-01-17 15:37:20'),
(130, 100, 63, 'investment', '200.0000', '2000000.0000', 'BS100.1701211', 'Investment sebesar 200.0000 Bioner', '2021-01-17 15:47:03'),
(131, 100, 64, 'investment', '100.0000', '1000000.0000', 'BS100.1701212', 'Investment sebesar 100.0000 Bioner', '2021-01-17 15:47:33'),
(132, 101, 65, 'investment', '1900.0000', '19000000.0000', 'BS101.1701211', 'Investment sebesar 1900.0000 Bioner', '2021-01-17 16:53:02'),
(133, 102, 66, 'investment', '1600.0000', '16000000.0000', 'BS102.1701211', 'Investment sebesar 1600.0000 Bioner', '2021-01-17 17:10:44'),
(134, 105, 67, 'investment', '400.0000', '4000000.0000', 'BS105.1701211', 'Investment sebesar 400.0000 Bioner', '2021-01-17 18:16:17'),
(135, 78, 69, 'investment', '700.0000', '7000000.0000', 'BS78.1701211', 'Investment sebesar 700.0000 Bioner', '2021-01-17 19:38:04'),
(136, 75, 70, 'investment', '500.0000', '5000000.0000', 'BS75.1701211', 'Investment sebesar 500.0000 Bioner', '2021-01-17 19:59:56'),
(137, 82, 68, 'investment', '400.0000', '4000000.0000', 'BS82.1701211', 'Investment sebesar 400.0000 Bioner', '2021-01-17 20:15:11'),
(138, 109, 74, 'delete investment', '800.0000', '8000000.0000', 'BS109.1701212', 'Investment Dibatalkan', '2021-01-17 20:50:51'),
(139, 109, 73, 'investment', '800.0000', '8000000.0000', 'BS109.1701211', 'Investment sebesar 800.0000 Bioner', '2021-01-17 20:51:10'),
(140, 9, 48, 'delete investment', '100.0000', '1000000.0000', 'BS9.1701211', 'Investment Dibatalkan', '2021-01-17 21:01:41'),
(141, 11, 76, 'investment', '49.5000', '742500.0000', 'BS11.1701211', 'Investment sebesar 49.5 Bioner dari Profit', '2021-01-17 22:40:32'),
(142, 11, 76, 'withdraw', '49.5000', '0.0000', 'BSW11.1701211', 'Withdraw sebesar 49.5 Bioner Untuk Investment BS11.1701211', '2021-01-17 22:40:32'),
(143, 115, 75, 'investment', '700.0000', '7000000.0000', 'BS115.1701211', 'Investment sebesar 700.0000 Bioner', '2021-01-18 06:23:30'),
(144, 1, 1, 'profit', '0.5000', '5000.0000', 'BS1.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(145, 2, 2, 'profit', '0.5000', '5000.0000', 'BS2.1301211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(146, 5, 4, 'profit', '0.5000', '5000.0000', 'BS5.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(147, 6, 5, 'profit', '0.5000', '5000.0000', 'BS6.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(148, 7, 6, 'profit', '0.5000', '5000.0000', 'BS7.1401211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(149, 9, 8, 'profit', '0.5000', '5000.0000', 'BS9.1501211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(150, 11, 17, 'profit', '16.5000', '165000.0000', 'BS11.1501215', 'Distribusi Profit Sebesar 16.5 Bioner', '2021-01-18 07:00:05'),
(151, 1, 18, 'profit', '0.5000', '5000.0000', 'BS1.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(152, 5, 19, 'profit', '0.1050', '1050.0000', 'BS5.1601211', 'Distribusi Profit Sebesar 0.105 Bioner', '2021-01-18 07:00:05'),
(153, 17, 20, 'profit', '0.5000', '5000.0000', 'BS17.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(154, 18, 21, 'profit', '7.5000', '75000.0000', 'BS18.1601211', 'Distribusi Profit Sebesar 7.5 Bioner', '2021-01-18 07:00:05'),
(155, 20, 22, 'profit', '7.0000', '70000.0000', 'BS20.1601211', 'Distribusi Profit Sebesar 7 Bioner', '2021-01-18 07:00:05'),
(156, 23, 23, 'profit', '2.0000', '20000.0000', 'BS23.1601211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-18 07:00:05'),
(157, 19, 24, 'profit', '0.5000', '5000.0000', 'BS19.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(158, 26, 25, 'profit', '0.5000', '5000.0000', 'BS26.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(159, 16, 26, 'profit', '2.0000', '20000.0000', 'BS16.1601211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-18 07:00:05'),
(160, 27, 27, 'profit', '13.0000', '130000.0000', 'BS27.1601211', 'Distribusi Profit Sebesar 13 Bioner', '2021-01-18 07:00:05'),
(161, 28, 28, 'profit', '13.5000', '135000.0000', 'BS28.1601211', 'Distribusi Profit Sebesar 13.5 Bioner', '2021-01-18 07:00:05'),
(162, 31, 29, 'profit', '5.0000', '50000.0000', 'BS31.1601211', 'Distribusi Profit Sebesar 5 Bioner', '2021-01-18 07:00:05'),
(163, 34, 30, 'profit', '9.0000', '90000.0000', 'BS34.1601211', 'Distribusi Profit Sebesar 9 Bioner', '2021-01-18 07:00:05'),
(164, 37, 31, 'profit', '0.5000', '5000.0000', 'BS37.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(165, 36, 32, 'profit', '3.0000', '30000.0000', 'BS36.1601211', 'Distribusi Profit Sebesar 3 Bioner', '2021-01-18 07:00:05'),
(166, 34, 33, 'profit', '1.0000', '10000.0000', 'BS34.1601212', 'Distribusi Profit Sebesar 1 Bioner', '2021-01-18 07:00:05'),
(167, 32, 34, 'profit', '18.5000', '185000.0000', 'BS32.1601211', 'Distribusi Profit Sebesar 18.5 Bioner', '2021-01-18 07:00:05'),
(168, 48, 35, 'profit', '0.5000', '5000.0000', 'BS48.1601211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(169, 49, 36, 'profit', '2.0000', '20000.0000', 'BS49.1601211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-18 07:00:05'),
(170, 53, 37, 'profit', '8.0000', '80000.0000', 'BS53.1601211', 'Distribusi Profit Sebesar 8 Bioner', '2021-01-18 07:00:05'),
(171, 55, 39, 'profit', '3.5000', '35000.0000', 'BS55.1601211', 'Distribusi Profit Sebesar 3.5 Bioner', '2021-01-18 07:00:05'),
(172, 57, 40, 'profit', '7.5000', '75000.0000', 'BS57.1601211', 'Distribusi Profit Sebesar 7.5 Bioner', '2021-01-18 07:00:05'),
(173, 59, 41, 'profit', '1.0000', '10000.0000', 'BS59.1601211', 'Distribusi Profit Sebesar 1 Bioner', '2021-01-18 07:00:05'),
(174, 61, 42, 'profit', '5.5000', '55000.0000', 'BS61.1601211', 'Distribusi Profit Sebesar 5.5 Bioner', '2021-01-18 07:00:05'),
(175, 62, 43, 'profit', '4.5000', '45000.0000', 'BS62.1601211', 'Distribusi Profit Sebesar 4.5 Bioner', '2021-01-18 07:00:05'),
(176, 3, 44, 'profit', '0.5000', '5000.0000', 'BS3.1701211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(177, 65, 45, 'profit', '1.5000', '15000.0000', 'BS65.1701211', 'Distribusi Profit Sebesar 1.5 Bioner', '2021-01-18 07:00:05'),
(178, 71, 46, 'profit', '3.5000', '35000.0000', 'BS71.1701211', 'Distribusi Profit Sebesar 3.5 Bioner', '2021-01-18 07:00:05'),
(179, 68, 47, 'profit', '1.0000', '10000.0000', 'BS68.1701211', 'Distribusi Profit Sebesar 1 Bioner', '2021-01-18 07:00:05'),
(180, 74, 49, 'profit', '0.5000', '5000.0000', 'BS74.1701211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(181, 81, 50, 'profit', '0.5000', '5000.0000', 'BS81.1701211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(182, 77, 51, 'profit', '1.0000', '10000.0000', 'BS77.1701211', 'Distribusi Profit Sebesar 1 Bioner', '2021-01-18 07:00:05'),
(183, 80, 52, 'profit', '10.0000', '100000.0000', 'BS80.1701211', 'Distribusi Profit Sebesar 10 Bioner', '2021-01-18 07:00:05'),
(184, 83, 53, 'profit', '1.5000', '15000.0000', 'BS83.1701211', 'Distribusi Profit Sebesar 1.5 Bioner', '2021-01-18 07:00:05'),
(185, 86, 54, 'profit', '0.5000', '5000.0000', 'BS86.1701211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(186, 87, 55, 'profit', '0.5000', '5000.0000', 'BS87.1701211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(187, 89, 56, 'profit', '4.5000', '45000.0000', 'BS89.1701211', 'Distribusi Profit Sebesar 4.5 Bioner', '2021-01-18 07:00:05'),
(188, 90, 57, 'profit', '2.0000', '20000.0000', 'BS90.1701211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-18 07:00:05'),
(189, 92, 58, 'profit', '2.0000', '20000.0000', 'BS92.1701211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-18 07:00:05'),
(190, 91, 59, 'profit', '2.0000', '20000.0000', 'BS91.1701211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-18 07:00:05'),
(191, 94, 60, 'profit', '7.5000', '75000.0000', 'BS94.1701211', 'Distribusi Profit Sebesar 7.5 Bioner', '2021-01-18 07:00:05'),
(192, 97, 61, 'profit', '0.5000', '5000.0000', 'BS97.1701211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(193, 99, 62, 'profit', '1.5000', '15000.0000', 'BS99.1701211', 'Distribusi Profit Sebesar 1.5 Bioner', '2021-01-18 07:00:05'),
(194, 100, 63, 'profit', '1.0000', '10000.0000', 'BS100.1701211', 'Distribusi Profit Sebesar 1 Bioner', '2021-01-18 07:00:05'),
(195, 100, 64, 'profit', '0.5000', '5000.0000', 'BS100.1701212', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-18 07:00:05'),
(196, 101, 65, 'profit', '9.5000', '95000.0000', 'BS101.1701211', 'Distribusi Profit Sebesar 9.5 Bioner', '2021-01-18 07:00:05'),
(197, 102, 66, 'profit', '8.0000', '80000.0000', 'BS102.1701211', 'Distribusi Profit Sebesar 8 Bioner', '2021-01-18 07:00:05'),
(198, 105, 67, 'profit', '2.0000', '20000.0000', 'BS105.1701211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-18 07:00:05'),
(199, 82, 68, 'profit', '2.0000', '20000.0000', 'BS82.1701211', 'Distribusi Profit Sebesar 2 Bioner', '2021-01-18 07:00:05'),
(200, 78, 69, 'profit', '3.5000', '35000.0000', 'BS78.1701211', 'Distribusi Profit Sebesar 3.5 Bioner', '2021-01-18 07:00:05'),
(201, 75, 70, 'profit', '2.5000', '25000.0000', 'BS75.1701211', 'Distribusi Profit Sebesar 2.5 Bioner', '2021-01-18 07:00:05'),
(202, 109, 73, 'profit', '4.0000', '40000.0000', 'BS109.1701211', 'Distribusi Profit Sebesar 4 Bioner', '2021-01-18 07:00:05'),
(203, 115, 75, 'profit', '3.5000', '35000.0000', 'BS115.1701211', 'Distribusi Profit Sebesar 3.5 Bioner', '2021-01-18 07:00:05'),
(204, 11, 76, 'profit', '0.2475', '2475.0000', 'BS11.1701211', 'Distribusi Profit Sebesar 0.2475 Bioner', '2021-01-18 07:00:05'),
(205, 10, 77, 'delete investment', '600.0000', '6000000.0000', 'BS10.1801211', 'Investment Dibatalkan', '2021-01-18 10:58:09'),
(206, 10, 78, 'investment', '700.0000', '7000000.0000', 'BS10.1801212', 'Investment sebesar 700.0000 Bioner', '2021-01-18 10:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `bioner_trade`
--

CREATE TABLE `bioner_trade` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('pending','aktif','tidak aktif','menunggu verifikasi') DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bioner_trade`
--

INSERT INTO `bioner_trade` (`id`, `kode`, `id_user`, `status`, `bukti_transfer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BT2.1301211', 2, 'aktif', NULL, '2021-01-13 22:21:23', '2021-01-18 07:00:05', NULL),
(2, 'BT69.1801211', 69, 'pending', NULL, '2021-01-18 11:54:51', '2021-01-18 11:54:51', NULL),
(3, 'BT69.1801211', 69, 'pending', NULL, '2021-01-18 12:42:57', '2021-01-18 12:42:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bioner_trade_logs`
--

CREATE TABLE `bioner_trade_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `id_bioner_trade` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('investment','profit','withdraw','delete investment','return withdraw') DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nominal_rp` decimal(15,4) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bioner_trade_logs`
--

INSERT INTO `bioner_trade_logs` (`id`, `id_user`, `id_bioner_trade`, `type`, `kode`, `nominal_rp`, `keterangan`, `created_at`) VALUES
(1, 2, 1, 'investment', 'BT2.1301211', NULL, 'Pembukaan Bioner Trade BT2.1301211 sebanyak 1 Lot', '2021-01-13 22:22:16'),
(2, 2, 1, 'profit', 'BT2.1301211', NULL, 'Distribusi Profit Sebesar Rp.3000', '2021-01-14 07:00:06'),
(3, 2, 1, 'profit', 'BT2.1301211', NULL, 'Distribusi Profit Sebesar Rp.3000', '2021-01-15 07:00:05'),
(4, 2, 1, 'profit', 'BT2.1301211', NULL, 'Distribusi Profit Sebesar Rp.3000', '2021-01-16 00:56:50'),
(5, 2, 1, 'profit', 'BT2.1301211', NULL, 'Distribusi Profit Sebesar Rp.3000', '2021-01-16 07:00:10'),
(6, 2, 1, 'profit', 'BT2.1301211', NULL, 'Distribusi Profit Sebesar Rp.3000', '2021-01-17 07:00:12'),
(7, 2, 1, 'profit', 'BT2.1301211', NULL, 'Distribusi Profit Sebesar Rp.3000', '2021-01-18 07:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `log_email_signup`
--

CREATE TABLE `log_email_signup` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `log` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `log_email_signup`
--

INSERT INTO `log_email_signup` (`id`, `id_user`, `log`, `created_at`) VALUES
(1, 1, '<pre>\n\n</pre>', '2021-01-13 10:00:00'),
(2, 2, '<pre>\n\n</pre>', '2021-01-13 10:00:00'),
(3, 3, '<pre>\n\n</pre>', '2021-01-14 16:00:00'),
(4, 4, '<pre>\n\n</pre>', '2021-01-14 17:00:00'),
(5, 5, '<pre>\n\n</pre>', '2021-01-14 18:00:00'),
(6, 6, '<pre>\n\n</pre>', '2021-01-14 18:00:00'),
(7, 7, '<pre>\n\n</pre>', '2021-01-14 18:00:00'),
(8, 8, '<pre>\n\n</pre>', '2021-01-14 20:00:00'),
(9, 9, '<pre>\n\n</pre>', '2021-01-15 09:00:00'),
(10, 10, '<pre>\n\n</pre>', '2021-01-15 11:00:00'),
(11, 11, '<pre>\n\n</pre>', '2021-01-15 20:00:00'),
(12, 12, '<pre>\n\n</pre>', '2021-01-15 20:00:00'),
(13, 13, '<pre>\n\n</pre>', '2021-01-15 21:00:00'),
(14, 14, '<pre>\n\n</pre>', '2021-01-15 22:00:00'),
(15, 15, '<pre>\n\n</pre>', '2021-01-16 08:00:00'),
(16, 16, '<pre>\n\n</pre>', '2021-01-16 08:00:00'),
(17, 17, '<pre>\n\n</pre>', '2021-01-16 08:00:00'),
(18, 18, '<pre>\n\n</pre>', '2021-01-16 09:00:00'),
(19, 19, '<pre>\n\n</pre>', '2021-01-16 10:00:00'),
(20, 20, '<pre>\n\n</pre>', '2021-01-16 10:00:00'),
(21, 21, '<pre>\n\n</pre>', '2021-01-16 10:00:00'),
(22, 22, '<pre>\n\n</pre>', '2021-01-16 10:00:00'),
(23, 23, '<pre>\n\n</pre>', '2021-01-16 10:00:00'),
(24, 24, '<pre>\n\n</pre>', '2021-01-16 10:00:00'),
(25, 25, '<pre>\n\n</pre>', '2021-01-16 10:00:00'),
(26, 26, '<pre>\n\n</pre>', '2021-01-16 11:00:00'),
(27, 27, '<pre>\n\n</pre>', '2021-01-16 12:00:00'),
(28, 28, '<pre>\n\n</pre>', '2021-01-16 12:00:00'),
(29, 29, '<pre>\n\n</pre>', '2021-01-16 14:00:00'),
(30, 30, '<pre>\n\n</pre>', '2021-01-16 16:00:00'),
(31, 31, '<pre>\n\n</pre>', '2021-01-16 16:00:00'),
(32, 32, '<pre>\n\n</pre>', '2021-01-16 17:00:00'),
(33, 33, '<pre>\n\n</pre>', '2021-01-16 17:00:00'),
(34, 34, '<pre>\n\n</pre>', '2021-01-16 17:00:00'),
(35, 35, '<pre>\n\n</pre>', '2021-01-16 17:00:00'),
(36, 36, '<pre>\n\n</pre>', '2021-01-16 17:00:00'),
(37, 37, '<pre>\n\n</pre>', '2021-01-16 17:00:00'),
(38, 38, '<pre>\n\n</pre>', '2021-01-16 17:00:00'),
(39, 39, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(40, 40, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(41, 41, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(42, 42, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(43, 43, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(44, 44, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(45, 45, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(46, 46, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(47, 47, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(48, 48, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(49, 49, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(50, 50, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(51, 51, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(52, 52, '<pre>\n\n</pre>', '2021-01-16 18:00:00'),
(53, 53, '<pre>\n\n</pre>', '2021-01-16 19:00:00'),
(54, 54, '<pre>\n\n</pre>', '2021-01-16 19:00:00'),
(55, 55, '<pre>\n\n</pre>', '2021-01-16 19:00:00'),
(56, 56, '<pre>\n\n</pre>', '2021-01-16 19:00:00'),
(57, 57, '220 ESMTP smtp.hostinger.com\r\n<br /><pre>hello: 250-nl-srv-smtpout3.hostinger.io\r\n250-PIPELINING\r\n250-SIZE 35651584\r\n250-ETRN\r\n250-STARTTLS\r\n250-AUTH PLAIN LOGIN\r\n250-ENHANCEDSTATUSCODES\r\n250-8BITMIME\r\n250-DSN\r\n250 SMTPUTF8\r\n</pre>Failed to send AUTH LOGIN command. Error: 454 4.7.0 Temporary authentication failure: Connection lost to authentication server\r\n<br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br /><pre>Date: Sat, 16 Jan 2021 19:59:42 +0700\r\nFrom: &quot;System Bioner&quot; &lt;system@bioner.online&gt;\r\nReturn-Path: &lt;system@bioner.online&gt;\r\nTo: muhamadsuheri1202@gmail.com\r\nSubject: =?UTF-8?Q?Bioner=20Signup=20Detail?=\r\nReply-To: &lt;system@bioner.online&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: system@bioner.online\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;6002e33e92114@bioner.online&gt;\r\nMime-Version: 1.0\r\n\n\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_6002e33e92131&quot;\r\n\r\nThis is a multi-part message in MIME format.\r\nYour email application may not support this format.\r\n\r\n--B_ALT_6002e33e92131\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\nNama\r\n :\r\n\r\n Heri202\r\n\r\n\r\n Email\r\n :\r\n\r\n muhamadsuheri1202@gmail.com\r\n\r\n\r\n No Handphone\r\n :\r\n\r\n 081285656584\r\n\r\n\r\n Password\r\n :\r\n\r\n 021228\r\n\r\n\r\n PIN Transaksi\r\n :\r\n\r\n 281202\r\n\r\n\r\n\r\n Pastikan kamu menjaga informasi akun kamu, jangan sampai data seperti PIN\r\ntransaksi tersebar dan disalahgunakan\r\n Terima KasihIni adalah email otomatis, diharapkan jangan membalas email\r\nini.\r\n https://bioner.online\r\n 081219869989 - Admin Bioner\r\n\r\n\r\n--B_ALT_6002e33e92131\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n=3C=21doctype html=3E\n=3Chtml lang=3D=22en=22=3E\n\n=3Chead=3E\n =3C=21-- Required meta tags --=3E\n =3Cmeta charset=3D=22utf-8=22=3E\n =3Cmeta name=3D=22viewport=22 content=3D=22width=3Ddevice-width, initial-s=\ncale=3D1, shrink-to-fit=3Dno=22=3E\n\n =3C=21-- Bootstrap CSS --=3E\n =3Clink rel=3D=22stylesheet=22 href=3D=22https://bioner.online/public/css/=\nbootstrap.min.css=22=3E\n =3Clink href=3D\'http://fonts.googleapis.com/css?family=3DMontserrat:400,30=\n0,700\' rel=3D\'stylesheet\' type=3D\'text/css\'=3E\n =3Clink rel=3D=22stylesheet=22 href=3D=22https://cdn.jsdelivr.net/gh/fancy=\napps/fancybox=403.5.7/dist/jquery.fancybox.min.css=22 /=3E\n =3Clink rel=3D=22stylesheet=22 href=3D=22https://bioner.online/vendor/fort=\nawesome/font-awesome/css/all.min.css=22=3E\n =3Clink rel=3D=22stylesheet=22 href=3D=22https://bioner.online/public/css/=\nmain.css=22=3E\n\n=3C/head=3E\n\n=3Cbody=3E\n =3Cdiv class=3D=22container=22=3E\n =3Cimg src=3D=22https://bioner.online/public/img/favicon-96x96.png=22 widt=\nh=3D=2296px=3B=22=3E\n =3Ctable class=3D=22table table-bordered=22=3E\n =3Ctbody=3E\n =3Ctr=3E\n =3Cth=3ENama=3C/th=3E\n =3Cth=3E:=3C/th=3E\n =3Ctd=3E\n Heri202 =3C/td=3E\n =3C/tr=3E\n =3Ctr=3E\n =3Cth=3EEmail=3C/th=3E\n =3Cth=3E:=3C/th=3E\n =3Ctd=3E\n muhamadsuheri1202=40gmail.com =3C/td=3E\n =3C/tr=3E\n =3Ctr=3E\n =3Cth=3ENo Handphone=3C/th=3E\n =3Cth=3E:=3C/th=3E\n =3Ctd=3E\n 081285656584 =3C/td=3E\n =3C/tr=3E\n =3Ctr=3E\n =3Cth=3EPassword=3C/th=3E\n =3Cth=3E:=3C/th=3E\n =3Ctd=3E\n 021228 =3C/td=3E\n =3C/tr=3E\n =3Ctr=3E\n =3Cth=3EPIN Transaksi=3C/th=3E\n =3Cth=3E:=3C/th=3E\n =3Ctd=3E\n 281202 =3C/td=3E\n =3C/tr=3E\n =3C/tbody=3E\n =3C/table=3E\n =3Ch4=3EPastikan kamu menjaga informasi akun kamu, jangan sampai data sepe=\nrti PIN transaksi tersebar dan disalahgunakan=3C/h4=3E\n =3Ch5=3ETerima Kasih=3Cbr=3E=3Csmall=3EIni adalah email otomatis, diharapk=\nan jangan membalas email ini.=3C/small=3E=3C/h5=3E\n =3Ca href=3D=22https://bioner.online=22 target=3D=22=5Fblank=22=3Ehttps://=\nbioner.online=3C/a=3E=3Cbr=3E\n =3Ca href=3D=22https://wa.me/6281219869989=22 target=3D=22=5Fblank=22=3E08=\n1219869989 - Admin Bioner=3C/a=3E\n =3C/div=3E\n\n=3C/body=3E\r\n\r\n--B_ALT_6002e33e92131--</pre>', '2021-01-16 19:00:00'),
(58, 58, '<pre>\n\n</pre>', '2021-01-16 20:00:00'),
(59, 59, '<pre>\n\n</pre>', '2021-01-16 20:00:00'),
(60, 60, '<pre>\n\n</pre>', '2021-01-16 21:00:00'),
(61, 61, '<pre>\n\n</pre>', '2021-01-16 21:00:00'),
(62, 62, '<pre>\n\n</pre>', '2021-01-16 21:00:00'),
(63, 63, '<pre>\n\n</pre>', '2021-01-16 22:00:00'),
(64, 64, '<pre>\n\n</pre>', '2021-01-17 05:00:00'),
(65, 65, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(66, 66, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(67, 67, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(68, 68, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(69, 69, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(70, 70, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(71, 71, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(72, 72, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(73, 73, '<pre>\n\n</pre>', '2021-01-17 09:00:00'),
(74, 74, '<pre>\n\n</pre>', '2021-01-17 10:00:00'),
(75, 75, '<pre>\n\n</pre>', '2021-01-17 10:00:00'),
(76, 76, '<pre>\n\n</pre>', '2021-01-17 10:00:00'),
(77, 77, '<pre>\n\n</pre>', '2021-01-17 10:00:00'),
(78, 78, '<pre>\n\n</pre>', '2021-01-17 10:00:00'),
(79, 79, '<pre>\n\n</pre>', '2021-01-17 10:00:00'),
(80, 80, '<pre>\n\n</pre>', '2021-01-17 10:00:00'),
(81, 81, '<pre>\n\n</pre>', '2021-01-17 10:00:00'),
(82, 82, '<pre>\n\n</pre>', '2021-01-17 11:00:00'),
(83, 83, '<pre>\n\n</pre>', '2021-01-17 11:00:00'),
(84, 84, '<pre>\n\n</pre>', '2021-01-17 11:00:00'),
(85, 85, '<pre>\n\n</pre>', '2021-01-17 11:00:00'),
(86, 86, '<pre>\n\n</pre>', '2021-01-17 12:00:00'),
(87, 87, '<pre>\n\n</pre>', '2021-01-17 12:00:00'),
(88, 88, '<pre>\n\n</pre>', '2021-01-17 12:00:00'),
(89, 89, '<pre>\n\n</pre>', '2021-01-17 12:00:00'),
(90, 90, '<pre>\n\n</pre>', '2021-01-17 12:00:00'),
(91, 91, '<pre>\n\n</pre>', '2021-01-17 12:00:00'),
(92, 92, '<pre>\n\n</pre>', '2021-01-17 12:00:00'),
(93, 93, '<pre>\n\n</pre>', '2021-01-17 13:00:00'),
(94, 94, '<pre>\n\n</pre>', '2021-01-17 13:00:00'),
(95, 95, '<pre>\n\n</pre>', '2021-01-17 14:00:00'),
(96, 96, '<pre>\n\n</pre>', '2021-01-17 14:00:00'),
(97, 97, '<pre>\n\n</pre>', '2021-01-17 15:00:00'),
(98, 98, '<pre>\n\n</pre>', '2021-01-17 15:00:00'),
(99, 99, '<pre>\n\n</pre>', '2021-01-17 15:00:00'),
(100, 100, '<pre>\n\n</pre>', '2021-01-17 15:00:00'),
(101, 101, '<pre>\n\n</pre>', '2021-01-17 16:00:00'),
(102, 102, '<pre>\n\n</pre>', '2021-01-17 16:00:00'),
(103, 103, '<pre>\n\n</pre>', '2021-01-17 16:00:00'),
(104, 104, '<pre>\n\n</pre>', '2021-01-17 17:00:00'),
(105, 105, '<pre>\n\n</pre>', '2021-01-17 18:00:00'),
(106, 106, '<pre>\n\n</pre>', '2021-01-17 18:00:00'),
(107, 107, '<pre>\n\n</pre>', '2021-01-17 18:00:00'),
(108, 108, '<pre>\n\n</pre>', '2021-01-17 18:00:00'),
(109, 109, '<pre>\n\n</pre>', '2021-01-17 19:00:00'),
(110, 110, '<pre>\n\n</pre>', '2021-01-17 19:00:00'),
(111, 111, '<pre>\n\n</pre>', '2021-01-17 19:00:00'),
(112, 112, '<pre>\n\n</pre>', '2021-01-17 19:00:00'),
(113, 113, '<pre>\n\n</pre>', '2021-01-17 20:00:00'),
(114, 114, '<pre>\n\n</pre>', '2021-01-17 20:00:00'),
(115, 115, '<pre>\n\n</pre>', '2021-01-17 20:00:00'),
(116, 116, '<pre>\n\n</pre>', '2021-01-17 22:00:00'),
(117, 117, '<pre>\n\n</pre>', '2021-01-18 06:00:00'),
(118, 118, '<pre>\n\n</pre>', '2021-01-18 08:00:00'),
(119, 119, '<pre>\n\n</pre>', '2021-01-18 08:00:00'),
(120, 120, '<pre>\n\n</pre>', '2021-01-18 10:00:00'),
(121, 121, '<pre>\n\n</pre>', '2021-01-18 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `param_banks`
--

CREATE TABLE `param_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `kode_bank` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `param_banks`
--

INSERT INTO `param_banks` (`id`, `nama_bank`, `kode_bank`) VALUES
(1, 'Bank Jabar', '110'),
(2, 'Bank DKI', '111'),
(3, 'Bank BPD DIY', '112'),
(4, 'Bank Jateng', '113'),
(5, 'Bank Jatim', '114'),
(6, 'Bank BPD Jambi', '115'),
(7, 'Bank BPD Aceh', '116'),
(8, 'Bank Sumut', '117'),
(9, 'Bank Nagari', '118'),
(10, 'Bank Riau', '119'),
(11, 'Bank Sumsel', '120'),
(12, 'Bank Lampung', '121'),
(13, 'Bank Kalsel', '122'),
(14, 'Bank BPD Kaltim', '124'),
(15, 'Bank BPD Kalteng', '125'),
(16, 'Bank Sulsel', '126'),
(17, 'Bank Sulut', '127'),
(18, 'Bank BPD NTB', '128'),
(19, 'Bank BPD Bali', '129'),
(20, 'Bank NTT', '130'),
(21, 'Bank Maluku', '131'),
(22, 'Bank Papua', '132'),
(23, 'Bank Bengkulu', '133'),
(24, 'Bank Sultra', '135'),
(25, 'Bank Nusantara Parahyangan', '145'),
(26, 'Bank Swadesi', '146'),
(27, 'Bank Muamalat', '147'),
(28, 'Bank Mestika', '151'),
(29, 'Bank Maspion', '157'),
(30, 'Bank Ganesha', '161'),
(31, 'Bank Kesawan', '167'),
(32, 'Bank Saudara HS 1906', '212'),
(33, 'Bank Mega', '426'),
(34, 'Bank Jasa Jakarta', '427'),
(35, 'Bank Bukopin', '441'),
(36, 'Bank Syariah Mandiri', '451'),
(37, 'Bank Bumiputera', '485'),
(38, 'Bank Agroniaga', '494'),
(39, 'Bank Syariah Mega Indonesia', '506'),
(40, 'Bank Ina Perdana', '513'),
(41, 'Bank UIB', '536'),
(42, 'Bank Artos Indonesia', '542'),
(43, 'Bank Mayora', '553'),
(44, 'Bank Eksekutif', '558'),
(45, 'BPR KS', '558'),
(46, 'Bank Harda', '567'),
(47, 'Bank Commonwealth', '950'),
(48, 'Bank BRI', '002'),
(49, 'Bank Mandiri', '008'),
(50, 'Bank BNI', '009'),
(51, 'Bank Danamon', '011'),
(52, 'Bank Permata', '013'),
(53, 'Bank BCA', '014'),
(54, 'Bank BII', '016'),
(55, 'Bank Panin', '019'),
(56, 'Bank Arta Niaga Kencana', '020'),
(57, 'Bank Niaga', '022'),
(58, 'Bank UOB Buana', '023'),
(59, 'LippoBank', '026'),
(60, 'Bank NISP', '028'),
(61, 'Bank Artha Graha', '037'),
(62, 'Standard Chartered Bank', '050'),
(63, 'Bank ABN AMRO', '052'),
(64, 'Bank Bumi Arta', '076'),
(65, 'Bank Ekonomi', '087'),
(66, 'Bank Haga', '089'),
(67, 'Bank IFI', '093'),
(68, 'Bank Mayapada', '097');

-- --------------------------------------------------------

--
-- Table structure for table `tb_test`
--

CREATE TABLE `tb_test` (
  `id` int(11) NOT NULL,
  `test` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_test`
--

INSERT INTO `tb_test` (`id`, `test`) VALUES
(1, '2021-01-16 00:47:50'),
(2, '2021-01-16 00:50:02'),
(3, '2021-01-16 00:51:02'),
(4, '2021-01-16 00:52:02'),
(5, '2021-01-16 00:53:02'),
(6, '2021-01-16 00:54:02'),
(7, '2021-01-16 00:55:01'),
(8, '2021-01-16 00:56:01'),
(9, '2021-01-16 00:57:01'),
(10, '2021-01-16 00:58:02'),
(11, '2021-01-16 00:59:02'),
(12, '2021-01-16 01:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pin` varchar(6) DEFAULT NULL,
  `id_referal` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') DEFAULT NULL,
  `cookies` varchar(255) DEFAULT NULL,
  `remember` enum('0','1') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `no_hp`, `password`, `pin`, `id_referal`, `status`, `cookies`, `remember`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nurhasan', 'tebe.inside@gmail.com', '081288611126', '$2y$10$F.jKs2E2aR3oNmabxeE0U.S9v.dysch5PaeHmS20AAgOKOo3aC06W', '060606', NULL, 'aktif', 'Pf8g2Ih1lSD5GOPiOqnFxGwUfMnvyuc5KeMtzAvI7kj1HdbT7s9FrlosZ6UpL2rW', '1', '2021-01-13 10:04:55', '2021-01-18 07:00:05', NULL),
(2, 'Abdul khaer', 'abdulkhaer321@gmail.com', '081219869989', '$2y$10$DekKRUziVXv0vhmljkW5lukojGeA.GMdwQUtFuKUvse9gw6J4df9G', '321598', NULL, 'aktif', 'UBEN28MKjipBLcF34NydOJHs5qc1VIXvhxSwdZu1bx75au0YaXbFO2RjQ9MtiWvR', '1', '2021-01-13 10:38:42', '2021-01-18 07:00:05', NULL),
(3, 'Mohamad sopiyan', 'sopiyanmohamad10@gmail.com', '085715556746', '$2y$10$N7GU5l0T4RhOe4AzLF6HheifitiUpNcFMBx1xMDqMuKPB/y3ryFAe', '121314', NULL, 'aktif', 'PYwtkByyptiT6Gozx6E3Jv0QVHD7Z4s5lOvu8jG921FpXERa5jrmq19UeghWr2DA', '0', '2021-01-14 16:20:24', '2021-01-18 12:07:06', NULL),
(4, 'Burhan', 'burhannudinsyabil7@gmail.com', '087788388914', '$2y$10$4ZVHUMI0Kd4cct5di1eRCeqMOnHqoBAZiInzchRFwee3T7HGUMAla', '051209', NULL, 'aktif', 'e1BRJwF5plPT76vDOepOtYEW27wjfn9lLiIhKs0iaLq3gN0VuAc9UCcHW4nborxS', '0', '2021-01-14 17:00:52', '2021-01-17 14:21:21', NULL),
(5, 'Anisah Andeani', 'andeani77@gmail.com', '081289520105', '$2y$10$2yWub//8STua0oH82YqVtucw6hDs5c9lrqCum/9/nfR6HFCQx7UKK', '160414', NULL, 'aktif', 'm2PLUX5bFNKSxI1rbXY4qoE97xGaVsn8eu3wzckVQJ4FZaTdrRg8gPBWytkZoShe', '1', '2021-01-14 18:16:32', '2021-01-18 07:00:05', NULL),
(6, 'Muhammad Malik Abdul Azis', 'azis12194@gmail.com', '081289361822', '$2y$10$ipcUVPfW16X08SU8wMjWnevZHWMAT4z3sqbq2e8SY5P/4zI3LiaCa', '121945', 5, 'aktif', NULL, '0', '2021-01-14 18:25:06', '2021-01-18 10:29:56', NULL),
(7, 'Endang', 'endang.bioner@gmail.com', '081315159897', '$2y$10$DJKel3f8I1JLcT9TTSaqrO8cPMWWlBWwLyGdaDSyS2kQBg7Z6OXU.', '040871', 5, 'aktif', '4GrD8HmB0W7a9PZR1pC1GuHUgfiIhbdMAjENOcxpX2IisNawZMyqQ2vhQUVgJPLv', '1', '2021-01-14 18:42:44', '2021-01-18 07:00:05', NULL),
(8, 'Adam', 'adam.pm77@gmail.com', '082114578976', '$2y$10$8UPDO4reGim2sdfCv3xQpuIHNJp5Mx0eBPglh.yX3LcUif02IchOy', '591990', NULL, 'aktif', 'brIHnAxW8lbRcRo8aJDTfU6kIBmGXtqsL7CFqPhpVCav94prejYUg4tGy1QDm3lf', '0', '2021-01-14 20:54:14', '2021-01-16 20:17:22', NULL),
(9, 'Satria Utama', 'satriau20@gmail.com', '089622314346', '$2y$10$5Io693ghnQhRrE4U8Jd0fe4ReE9ZXmBEG5Mszl6r6vgVf37IHMZZm', '141414', 6, 'aktif', 'o2HImyFx2ynJuIEBqtQgzN06PrzpcK87sLbPbfrD5oje43Zdl19AJ91WglahCakS', '1', '2021-01-15 09:24:53', '2021-01-18 07:00:05', NULL),
(10, 'Abdul malik', 'abdulmalikm.2984@gmail.com', '085899844765', '$2y$10$i52vjAoyJ/OL.L.Wiqvr2OV/jOWgul2uB5uKYjya1E.EyRZHnr2Pa', '171717', NULL, 'aktif', 'eURnChflGa94d15CAuNS8TgKmkx2ATjmiLW36XgUuJv5JYRDti7vNV7BIPQEw3VF', '1', '2021-01-15 11:32:41', '2021-01-15 11:34:29', NULL),
(11, 'Patulloh SE', 'alfathiezpatulloh@gmail.com', '081314659380', '$2y$10$0OoSTvCo7FrjxeMjuMnQueRZg2E1V2zfiP9yyTDKrf0z3mZGlpYzm', '130506', NULL, 'aktif', 'Q46aUL2DRXnByBJ1FIGQUHWkNqusxYYuKp9KVIVa0Eww2fd5X6cAJxvhShj78d7Z', '0', '2021-01-15 20:32:06', '2021-01-18 09:35:05', NULL),
(12, 'Indra', 'indradiani142@gmail.com', '081211236896', '$2y$10$EFefBaHKKL5uDl.cMHb8qeMc/9lfF2x5RaV4vCMdHuANs3ajgUaJm', '081176', NULL, 'aktif', 'i719c8Hpo3ZBXhYGxyuz6RpqgqDrX4iI30tDLEAQSmnutFb6sQbNZh2aIHTfPfy4', '1', '2021-01-15 20:56:15', '2021-01-15 20:56:43', NULL),
(13, 'Nana95', 'jaysnana95@gmail.com', '085694000092', '$2y$10$zk/W62TynMJRtO0lvLsCeeA2vjwk3GRZe4nSvcDDHr2rb0QX2irFG', '170583', NULL, 'aktif', 'ZJH7B8JxWwaXHp4OiIGjmr1vOv1odP2X5q0yjzPbEkILNBM6eofApYch9TuK3VRT', '1', '2021-01-15 21:01:49', '2021-01-16 10:51:27', NULL),
(15, 'Abdul basit', 'basit010397@gmail.com', '085881153733', '$2y$10$JaZA0.u3jDkSF1Ra1LiszOs5nZcRU6xiA88EAeIAyn0j1EOYOBsJC', '131997', NULL, 'aktif', NULL, '0', '2021-01-16 08:44:08', '2021-01-17 11:10:14', NULL),
(16, 'Maulana yusup', 'wariorfcclub1997@gmail.com', '087874360020', '$2y$10$bQguj0dbWHKsCsKvyJx6m.8U7Nh3/38swuFHbq5z4RbZo6HSCa3hK', '884488', NULL, 'aktif', '0Tj1g1RiS8d5lEk3DpEfMHita6CVFU80PKoGF7srZl2CXjGkeAIoubMq4JmZyzOp', '1', '2021-01-16 08:44:40', '2021-01-18 08:56:36', NULL),
(17, 'Nelis solihat', 'ghehilzha02@gmail.com', '081563295051', '$2y$10$XVeqB8lvH/snCkJRcMG79uvBNfCl1UqBVQ5aa/5uLhdcJY4kPBjEW', '121212', NULL, 'aktif', 'mSAbwOHORH1rgYFd3UbTl40yJLKauG58KWYulSZhwt1Mq6RkVB0Xnr7PXTGkfj7x', '1', '2021-01-16 08:46:03', '2021-01-18 07:00:05', NULL),
(18, 'Lia Mariya Ulfa', 'azkachairil36@gmail.com', '082129144806', '$2y$10$py9CoBO1UguMA/WFapv5yuwNbYzX1fMAZQo7Xs.F4ICBVRD9RnJx6', '161616', NULL, 'aktif', '7Xz8965S4trkUJDyLtmVsoXeQFsFQjyvNLcBZOcauRNmqR0i2w7P5fB1nqMWGgrT', '1', '2021-01-16 09:42:36', '2021-01-18 07:00:05', NULL),
(19, 'Gusti Ferial Luthviano', 'ferialgusti@gmail.com', '085715303168', '$2y$10$1tMhw2vsps0rxeO5Fw7rI.04B0fQ9rEif3e1xUPu8J6GoZV1MW9uW', '242431', NULL, 'aktif', NULL, '0', '2021-01-16 10:04:33', '2021-01-18 07:00:05', NULL),
(20, 'Rian Afrianto', 'rianafrianto495@gmail.com', '083184935877', '$2y$10$qg9hRLz1L5fo9RtI4Fa6mO2ZEnTepVo.c5uc0yhp7XeY471v4fm7e', '180490', NULL, 'aktif', NULL, '0', '2021-01-16 10:05:32', '2021-01-18 07:00:05', NULL),
(21, 'Yenih Suhernih', 'suherniy555@gmail.com', '085770308148', '$2y$10$uPdW8zjV5GXJJpcAyoRDoO2eK5r9D45BfEE76dEcNEZ3y17e7SFtC', '545455', NULL, 'aktif', 'qaz5LGIqlvrJmHCXtcZuhpDn4ds4yTo6SgbY1keWyuGwjRZmPsEo7CPRF9KWfxa1', '1', '2021-01-16 10:06:31', '2021-01-16 10:07:27', NULL),
(22, 'Amirullah', 'amirllah142@gmail.com', '085710741273', '$2y$10$TVoiEFAqVXvj/qjtiTFaEuVD8l8pQ9iQQ.8H88LaZi69qDpL8xlpK', '147605', NULL, 'aktif', NULL, '0', '2021-01-16 10:07:44', '2021-01-16 10:17:53', NULL),
(23, 'Rini budiarsih', 'vanyaqirana@gmail.com', '085715210121', '$2y$10$/mT2fElNR7U5Rp8j6Xqklu40zLnYnk89T/4i9MM9918qVf61xAxAG', '220584', NULL, 'aktif', 'kh80gX76ziIMC8URuuQF4efA12pqfGEZgEa1zQDJ3YSDxUwJBnYFPKyVIcHvLlLZ', '0', '2021-01-16 10:14:22', '2021-01-18 07:00:05', NULL),
(24, 'daday hidayatullah', 'adjiedodo3@gmail.c', '082213539109', '$2y$10$ywzJZOQUn6Mg8yAeT16K8eDP7TrZAbaISe856K0wdh53Rg1W9qAcG', '080808', NULL, 'aktif', NULL, NULL, '2021-01-16 10:28:18', '2021-01-16 10:28:18', NULL),
(25, 'daday hidayatullah', 'adjiedodo3@gmail.com', '082213539109', '$2y$10$tlwmk..E3sE2ce7ldQ2cS.idnupCbpD5xn9VTmpkqYWp40hBMCQQK', '080808', NULL, 'aktif', 'nFnVmTqeVfCfigj6GdrKh4upl4SWLxX659Z8tD2F1BZNcExmlaYrsgWOO01zb90I', '1', '2021-01-16 10:33:15', '2021-01-16 10:34:08', NULL),
(26, 'Muhamad abdul aziz', 'apit.scg06@icloud.com', '085880020651', '$2y$10$2eVNBNRj4G5y6SZjrPIUP.J.Xh/fhuIjoeqe4f/vt5IyKiQlouQV.', '051297', NULL, 'aktif', '4eyZB6MoLVzw8EZLaagArmWT1CJvuknPiUj25s0gDq7HcNlRXMdfS0fc6vGmjKRI', '1', '2021-01-16 11:29:15', '2021-01-18 07:00:05', NULL),
(27, 'Deni Hafiya Utama', 'denihafiya4@gmail.com', '085776122787', '$2y$10$wAaYBw26ESHMJU5YAJ95v.DQjlW7KtTBM8PtSIW0q6esRVbnNgFQW', '100691', NULL, 'aktif', NULL, '0', '2021-01-16 12:27:48', '2021-01-18 07:00:05', NULL),
(28, 'musthofa', 'musthofamus023@gmail.com', '081617867495', '$2y$10$lbS7PMIl07yfRlzcTCg3pOPVXTzdonGnQy1mM7cg1bPezcxZqfuBq', '112233', NULL, 'aktif', 'gdibdfhiwR5P06zEWCmGcstCBnXwxRFXv0lerkKgZo8H8pUN5VqOmToNDucI2JaI', '0', '2021-01-16 12:36:35', '2021-01-18 10:52:11', NULL),
(29, 'Firda Herlina', 'firda.herlina.fh@gmail.com', '081285942066', '$2y$10$7.SzalEQEeYzfWQHOnjIaeuoXHgdwMMj0p42mIOZgrSx9RatdhPKW', '160997', NULL, 'aktif', 'ezkZ2grGS066OCByWzwom2bSJHNutxLTcY8TQjLFcQejbUnYWvORMNIG7pDKXAIZ', '1', '2021-01-16 14:50:13', '2021-01-16 14:50:26', NULL),
(30, 'ujiturmuji', 'mujiturmuji4@gmail.com', '081413059658', '$2y$10$Mf/5su5/ECaTMI3LsuZ9EOip0Bb.9CGUJeIj0pfIwjpUcg5b4Z58m', '221982', NULL, 'aktif', 'NaIhhk3gMeu0qjW2n64sraLwMSEvsxAFYOrHCdR9tPSZdinWbOYJc1eXwogLTQR4', '1', '2021-01-16 16:37:57', '2021-01-16 17:10:08', NULL),
(31, 'Teguh Santoso', 'santosoteguh0331@gmail.com', '081318573572', '$2y$10$MOI3ihfwilyPVnTMeboBYuI9RT2CQeaL7LvV2M70amAG5Y7UeyhgK', '241121', NULL, 'aktif', 'A1TN28jJw5NPWrZMSbFjM9x7sEtuQKEAZcgRzq6g3JGk2HSaVOYXid14LIfal57c', '0', '2021-01-16 16:46:56', '2021-01-18 07:00:05', NULL),
(32, 'Agya01', 'mobilagya458@gmail.com', '089636212525', '$2y$10$lccpo.y2QRu6INKSKiOep.wlKQk6yK40X8VkNHvSMnDjBaSlF69l2', '252525', NULL, 'aktif', 'p3HRXNSNqSxUuX9lMsYA5HPvqyulpg62TB7MFRgohIjzGecnZVr8v3tw4i9Krdf0', '1', '2021-01-16 17:03:45', '2021-01-18 07:00:05', NULL),
(33, 'Elkautsar', 'teguhtegal1984@gmail.com', '081318573572', '$2y$10$hINKZuLyGMmQPtULhhnKKuZuFdazdXx9lHCG9kINpFaQ1R1tfcoYu', '243171', NULL, 'aktif', NULL, '0', '2021-01-16 17:45:00', '2021-01-17 06:32:47', NULL),
(34, 'LASTUTI', 'tutilastuti3@gmail.com', '081218844834', '$2y$10$OqKXWEnLaD8XBC6ta9npBOllXe3DLKlSQ1n2NWYT0ovyFHyiffHUa', '745678', NULL, 'aktif', 'iTGLOYexN0HWAy4SyB6DIh7AP4RQr95zL7ZrdhjucQvejuMkZzCKIVUq2E0sTR16', '0', '2021-01-16 17:47:19', '2021-01-18 07:55:25', NULL),
(35, 'Silmi', 'hikmahbioner@gmail.com', '081318573572', '$2y$10$Y9TOqiAoyaPSeuqW7yPnS.xpk2chMFzNp6HlhlX0EdFvqMrbt3Ciy', '114931', NULL, 'aktif', NULL, NULL, '2021-01-16 17:48:50', '2021-01-16 17:48:50', NULL),
(36, 'Ade Handono', 'adehan1977@gmail.com', '089531868611', '$2y$10$Nr.KyYh9T1sL6dJITslZMeVC70hLgSy7t/s3686oHSGuckgNDdw/m', '123123', NULL, 'aktif', NULL, '0', '2021-01-16 17:49:38', '2021-01-18 07:00:05', NULL),
(37, 'm soleh sonhaji', 'msolehhaji471@gmail.com', '081386746587', '$2y$10$uihKMQJ0vRmV58bfUbkP..erqHKGRqh2ZaPsFIda5T.hiygx1tS82', '040798', NULL, 'aktif', 'GyD9xpiCaIp8a3rgs2hNtkRfofnbE3ON9R4VwtCjEZdxWlJbTK6jqqMgTQ4X5V5M', '1', '2021-01-16 17:54:16', '2021-01-18 07:00:05', NULL),
(38, 'Abimhaikal', 'aayasir0108@gmail.com', '083893684078', '$2y$10$mGyXsbaFoW9UEFGL/3bJhO3ClbR9JQUBMhKq9lofHKi4dQ0wMCedC', '131471', NULL, 'aktif', NULL, '0', '2021-01-16 17:56:01', '2021-01-17 19:53:10', NULL),
(39, 'Chialhita', 'wohtun@gmail.com', '083185359818', '$2y$10$9JDfXX.aDp.00WV63ycFrOmt0LSs6nFfIiSOSdw40jT.fKi5RG492', '162621', NULL, 'aktif', NULL, NULL, '2021-01-16 18:01:57', '2021-01-16 18:01:57', NULL),
(40, 'Yachya Supriadi', 'yachya841k@gmail.com', '081283790984', '$2y$10$NVHLEbeTT5ysnNmfUaeJwe3raYcaaOZRLItUEjCj0YSaUc55MdyhO', '090180', NULL, 'aktif', NULL, '0', '2021-01-16 18:03:00', '2021-01-17 05:12:08', NULL),
(41, 'Worohastuti', 'hastutiworo4@gmail.com', '082135147571', '$2y$10$xYXONbP83eI6ydDlM/RX6.yxO36GB9ok7LZzOQeYNgjy0AcHszhJ.', '159111', NULL, 'aktif', NULL, NULL, '2021-01-16 18:05:10', '2021-01-16 18:05:10', NULL),
(42, 'Ninunopianti', 'ninuahmad@gmail.com', '088224626180', '$2y$10$hjNLz3jh9Aw1.Jq/Qb6P4uM5q4s/fypaTiGvPjkzEV4GL47OENAhm', '269411', NULL, 'aktif', '0RrqdgBKfEV56O37BktxgzTWrwxNAHazvvCjeoH8IcmNGjO1k9sEq3wCSsMlPFSX', '1', '2021-01-16 18:09:35', '2021-01-17 23:03:56', NULL),
(43, 'Nengsih', 'nengsihriki395@gmail.com', '083875961447', '$2y$10$.MDi740F5JK78LwUNllgEOG5/7bZ1KrwG1/6E3maW0afZLmctxWBu', '633951', NULL, 'aktif', NULL, NULL, '2021-01-16 18:12:13', '2021-01-16 18:12:13', NULL),
(44, 'Ekaputri', 'ekaputrim651@gmail.com', '0895617675608', '$2y$10$pa/RITiBXYiI0ts6n9ePaORMAGuovCqrxnLS9b6/PF37ez6heRh/O', '297251', NULL, 'aktif', NULL, NULL, '2021-01-16 18:15:56', '2021-01-16 18:15:56', NULL),
(45, 'Abdullahfirdaus', 'miaabdullah13@gmail.com', '081290741014', '$2y$10$EjgkZniVM7cHdTZ4Y74Wd.2XPyxVOys8Eqvq9/vTvTueJTl6yWjPq', '419641', NULL, 'aktif', NULL, NULL, '2021-01-16 18:20:01', '2021-01-16 18:20:01', NULL),
(46, 'Vivinovianti', 'noviantiv562@gmail.com', '081318573572', '$2y$10$UXvG8bGB6jV1GsUjXu8TneuE0zcOhx7GeaFDEbLrijGTAvWN8NX.i', '240611', NULL, 'aktif', NULL, NULL, '2021-01-16 18:22:35', '2021-01-16 18:22:35', NULL),
(47, 'Nurdin', 'nurdinnazwan@gmail.com', '081585792940', '$2y$10$Psklg4dqwFJraE08yTy9mu4DqivMb4VvZCTRHokRNwVxnM80e5K/.', '452671', NULL, 'aktif', NULL, NULL, '2021-01-16 18:26:22', '2021-01-16 18:26:22', NULL),
(48, 'Yuli priyono', 'yulipriyono99@gmail.com', '081389005593', '$2y$10$uLDMITf6F2boMs1LMYwxbuHdSxaTD4ddywBeXPSrPnMIU.hryPOUy', '778106', NULL, 'aktif', '1yWqPofp5IQ3OCUQD0vEThGnP5xyr4ukeFBcWhMDaFq7XGYLIb6tK7vgNRCL83fn', '1', '2021-01-16 18:27:33', '2021-01-18 07:00:05', NULL),
(49, 'Saipul bahri', 'ipoenk05@gmail.com', '081283104999', '$2y$10$8nqD5gimKSHviJY0.HcqyefgFVs5FVvbQ7d.G.Z/O9IHhoMyhyXfy', '060377', NULL, 'aktif', 'Tm5f8QYijNsOJXMGtSDBYT6khBHWm3e9Du07RlcUadCMQEAxWHL40ZrjrR8iqE13', '1', '2021-01-16 18:28:35', '2021-01-18 07:00:05', NULL),
(50, 'Hanafie', 'hanafigojali@gmail.com', '089638373730', '$2y$10$8ojAvkodcO9VE9nuUcL11ukb8UqHxGomZmVnHKPGXqlIoIy0czRtO', '472641', NULL, 'aktif', NULL, NULL, '2021-01-16 18:29:19', '2021-01-16 18:29:19', NULL),
(51, 'Elka18', 'nurnurhikmah410@gmail.com', '089638373730', '$2y$10$H0gcxypk47rOfdCWC3yqYufK2FqfTSdtmbSHGxkzcNu2G8GU3TYX6', '274433', NULL, 'aktif', NULL, '0', '2021-01-16 18:36:49', '2021-01-16 18:37:13', NULL),
(52, 'Mukhtari92', 'mukhtariadep@gmail.com', '085773155083', '$2y$10$Z8jaGxfamN9oI.G4NggFeuxIOVsU1WlWA/yEUSVwZzwN/GB7LRCeq', '252525', NULL, 'aktif', 'R3VyYjc5qiJazdFVXNWcp8MYhEC5bsFCnZ6eH42vtT9x2OwuDngS4S0DpA7k1QRP', '1', '2021-01-16 18:49:38', '2021-01-16 18:50:15', NULL),
(53, 'rikki fahrezi', 'khiieroesoeh18@gmail.com', '081224171488', '$2y$10$fcsdny71wXhtc92JA8KIBuajPakaJggHCrQsCubEIpAhAqtlZheYe', '524115', NULL, 'aktif', 'GOfgqaXaJqeUj1WXIMNdwQPUc6ySBLP6zyJTC4VC7BKZD3R9booAn0rEZFOL3smR', '1', '2021-01-16 19:00:00', '2021-01-18 07:00:05', NULL),
(54, 'Arif Fadilah', 'arieffadillah000@gmail.com', '081290900109', '$2y$10$dN9pbiBMj1lhff70eQii/O2ZYtJiLcmCrt.1OG/Gr5l6pBi6SxSz6', '112233', 49, 'aktif', 'aOJpxePHj63mXtB5h1bCyhZTjNIxPsQ0yocuv7QdLDGnt8Xf4gwSRkEWArsUUunc', '1', '2021-01-16 19:05:52', '2021-01-16 19:06:14', NULL),
(55, 'Tubagus idrus', 'bogoridrus4@gmail.com', '085975338998', '$2y$10$YtjHS6jywJLcEa8sZLDlU.EVEZK8DpTKRKBT2xk9wuoPTn58bx1y2', '131313', NULL, 'aktif', 'e2vlQd0rhFZMzQUIJ4Cox83uaYG9jOsnRSyXekWnVXi7a5zPC4pgiR2qvHNpbKEw', '1', '2021-01-16 19:12:37', '2021-01-18 07:00:05', NULL),
(56, 'Naura', 'aliyandranaura@gmail.com', '085711134504', '$2y$10$GNxQF7XD6KIEgsvAk5PNI.1PI4Ha1O1V3ZXM8mr3IjYLowC6WhZq.', '180312', NULL, 'aktif', 'IqYkU1xhNjB4ccDvoRsk7yUj96mXWJVpCnx3rfwK2JvRtPqO0a2hCzodZfLs3DbA', '1', '2021-01-16 19:42:49', '2021-01-16 19:53:48', NULL),
(57, 'Heri202', 'muhamadsuheri1202@gmail.com', '081285656584', '$2y$10$hig9TpPkei5JEVvAn2qj9uYtwf4eGfuIS9CU9OzZxoKZcUATSn.9i', '281202', NULL, 'aktif', '0VgMeHCPwEvIKm5BO7C1TbdiXrFZJqaAXfMxNgltYko3oxcBSIquw2LQQAFSslYJ', '1', '2021-01-16 19:59:42', '2021-01-18 07:00:05', NULL),
(58, 'Yadi Mulyadi', 'yadimlyadi2404@gmail.com', '085771520479', '$2y$10$2qeiMpBOi0KVNd/wlHxn4OouKwKWEXeISBMDit8xLu0pfJiu2lWNe', '240479', NULL, 'aktif', NULL, '0', '2021-01-16 20:04:23', '2021-01-16 20:04:59', NULL),
(59, 'Dewi purnama', 'dpurnama826@gmail.com', '081519840585', '$2y$10$mnnjj9PDuVzdTCTIGViX1O7r.EDhhV83JY3LM3b94ezdmiJuZDuCS', '131313', NULL, 'aktif', 'GLWB2xcflzD0T6M6CQmkXU7wErJudqzVMxvrg4hb1Wt81sjPFSyepAgZFI3yiRDH', '1', '2021-01-16 20:49:43', '2021-01-18 07:00:05', NULL),
(60, 'Encep05', 'encepahmad29@gmail.com', '085217154171', '$2y$10$S4HNC6.1txCRtsywBUkbqu9FE.hrSW4k7KZkik2akVXHK8WPIitw.', '295183', NULL, 'aktif', 't5FAcrFRIkHqCDhp7MQSGOqa6uVOXSPWQ0gvRJd8XKsfl1uV0YDdCymZhNoB4HTG', '1', '2021-01-16 21:00:30', '2021-01-16 21:08:13', NULL),
(61, 'Erni Puspita Dewi', 'meisya.280512@gmail.com', '081288789712', '$2y$10$Pp5kGXITbysfSd07/IOcxeP6RmBC3JIYL1P5gOvPbBRm1T1.Vt/Ua', '280512', NULL, 'aktif', 'Ds6KdwFdq5Ubuc7Z3P9lMoVLzkLf5ABKm6qIn7oAlibxge8Nxn1CMg4UytYET39Z', '1', '2021-01-16 21:05:01', '2021-01-18 07:00:05', NULL),
(62, 'Yusuf Ali Nurbagja', 'abagjayusuf@gmail.com', '082122656625', '$2y$10$xQ2Lm2Mo9xL141bXqYUim.H4iYbQv8h160trXhNXMTaGvPM30ivCC', '141520', NULL, 'aktif', '9sY857dg4ZZGh3Qi0N9B5pLdnrAvKYmfJHqwX2EtcWIUoV6hJ1BxosSzHuObgDMc', '1', '2021-01-16 21:06:52', '2021-01-18 07:15:40', NULL),
(63, 'Siti Nurfadilah', '1305fadhma@gmail.com', '081290812095', '$2y$10$BOuxJ.KMIviZVK8Ba/yCr.Dyq190P3/HV/chvaP/pHoN.STNPbcaK', '130511', NULL, 'aktif', 'YkKbzQrCLishlPRMptdvYMmZgKA5XS5rsXkTE6EIBHd2ncaI9JoLfVWwuptycAUu', '1', '2021-01-16 22:10:15', '2021-01-16 22:10:37', NULL),
(64, 'Euis sri hartini SE', 'cutefathia8@gmail.com', '0895364617796', '$2y$10$8YULGClHsC6GTpFSr9GgJeuNi.RFPCe1maVjKMR7LGU3st7v7SlKm', '130506', NULL, 'aktif', NULL, '0', '2021-01-17 05:39:39', '2021-01-17 08:27:51', NULL),
(65, 'Isak', 'jodisak7@gmail.com', '081511366485', '$2y$10$MISrtcJSb3.nKSfcbVFHn.dB/T6LubSz6icLPzAkjx/8E7kZZkv5O', '231671', NULL, 'aktif', 'G8qy9WihBkpId8mmLabXcluU9oFgROtrNkAOegnECCGU5VxJh4sQ72afE6yxPc3d', '1', '2021-01-17 09:18:27', '2021-01-18 07:00:05', NULL),
(66, 'Muhamad Sauqi', 'baswedanmsauqi@gmail.com', '081281020522', '$2y$10$Gn3Lu7ZkytR/lUMZuS3ELuENeZbSWVAd3t.w2P.np67Wg8x5NaMQe', '151778', 34, 'aktif', NULL, '0', '2021-01-17 09:25:27', '2021-01-17 09:25:53', NULL),
(67, 'Kiki lesmana', 'kikilesmana880@gmail.com', '08567080813', '$2y$10$WkqhVO7hczJLkP/WcnJ9QuLu/LsuwMcen02gpvyf8DgfksUNw9mHi', '201003', NULL, 'aktif', '4v6L8BzYiGhkb6IargJuOybjI9FXVE5ZOx3nRoMWYX1ucfdPLd0qUxrSQJkiSP7h', '1', '2021-01-17 09:33:30', '2021-01-17 11:53:37', NULL),
(68, 'Mohammad deva taufik amansyah', 'devaalamsyah86@gmail.com', '085889314658', '$2y$10$9KKlgltj9yLfzt1fKsYXsu3hgUBXDJodepAxPgV1ySa5jcc4n/BZy', '231123', NULL, 'aktif', NULL, '0', '2021-01-17 09:36:29', '2021-01-18 07:00:05', NULL),
(69, 'waone79', 'andarakirana07@gmail.com', '085887940006', '$2y$10$DRhjyA4I/7uhBp2woogCY.9wmBXO/fmbXKyY9t7lmS7gxzmsuHKGG', '150879', NULL, 'aktif', '6zKath4EV5x2qSCMjJnnIhfOyv2RBz0g3orNmaFSTGv8dxQlIBb0OrJAV4MHkucC', '0', '2021-01-17 09:37:55', '2021-01-18 11:39:02', NULL),
(70, 'Dedy wahyudi', 'dedycoank88@gmail.com', '081310045440', '$2y$10$DPEhTUvjNQNwpGuHUP.AV.vtsya5U3OwgRCwK1WX4SCSjrRKBgLR6', '137920', NULL, 'aktif', 'J0fglrNbSCTh9Eiaz8qyAoiBXg87Nms34W2LV3V1mvRQZeIzTLBPZFnQjRl4XMSp', '1', '2021-01-17 09:38:10', '2021-01-17 11:55:28', NULL),
(71, 'Ridwan', 'ridwanbogor022@gmail.com', '085697924827', '$2y$10$jQQqms43n/P4RML/ocNQvOh9yb63IrT2Cd3Z2tta18qo24cfSY52i', '334455', NULL, 'aktif', NULL, '0', '2021-01-17 09:48:16', '2021-01-18 12:01:29', NULL),
(72, 'fathan17', 'maulanashi224@gmail.com', '088213743536', '$2y$10$lIS1PxvJ97jFrix5XNdYfe3fk5cYBehsepCq/4se55W6xmiaKszmC', '247165', NULL, 'aktif', 'S6fln75RAx5feip34crzehMRN6ma1wGE8DYZICbmEil7U9Kdqda4cXtLM0UBOyPQ', '1', '2021-01-17 09:49:25', '2021-01-17 09:50:18', NULL),
(73, 'Rohmah', 'ustmustofa0@gmail.com', '085751663790', '$2y$10$pB5eRi7IXfCRXVwXJTXjBu9h3ZWfgUcjgb5D1o1W89x8sIe06qWNK', '040693', NULL, 'aktif', NULL, '0', '2021-01-17 09:59:37', '2021-01-17 10:00:16', NULL),
(74, 'Kamaludin78', 'kamaludin6532@gmail.com', '085782229519', '$2y$10$tn1mgvtr49dlUqtnvfw.uujrweKoQFpkKQhqJ1tDqqcjbyNeXUCOe', '556677', NULL, 'aktif', 'lS9yWJlFhMWNw76pPZnBH1eKxI0MmKPariU58OvV3AbXG7XEgUDTkuZidkJ0Op6z', '1', '2021-01-17 10:20:48', '2021-01-18 07:00:05', NULL),
(75, 'bawing', 'bawing3003@gmail.com', '085782234445', '$2y$10$f11veQ/4fgtCayh4iu.tm.QQ27EZvc61xTbZuQ4YSAf2Xj0jiFqS.', '769188', NULL, 'aktif', NULL, '0', '2021-01-17 10:31:34', '2021-01-18 07:00:05', NULL),
(76, 'Mulyadi', 'mulyadi71079@gmail.com', '085778573917', '$2y$10$NY5pdUkfZ8M/K71qHT9oRuaxVHtsGbEqzlzwW2/LeFScjRUlrJ2sy', '222333', NULL, 'aktif', 'tsdUycsjY44u30XME6AapBSn5Ho37T2pFQCgogWkVrORYf8OFWP8JNIr7UJZtVQm', '1', '2021-01-17 10:32:36', '2021-01-18 06:58:57', NULL),
(77, 'Romli s', 'setiawankeisha072@gmail.com', '081563518966', '$2y$10$jeGuAhwuUALm..w9vUghyeNAChGcykw.vjDQhJ0iQ1SOEkk26jHBO', '123456', NULL, 'aktif', NULL, '0', '2021-01-17 10:37:31', '2021-01-18 07:00:05', NULL),
(78, 'janah15', 'sitinurjanah1115@gmail.com', '085889314658', '$2y$10$b.H0zgNlSJCcYqEoJg/Q/ecn78ZsziExzIqe1IclPgqDX5LZJrPQK', '145422', NULL, 'aktif', NULL, '0', '2021-01-17 10:43:53', '2021-01-18 07:00:05', NULL),
(79, 'nana85', 'fathan080517@gmail.com', '088213743536', '$2y$10$oL8GKqo5I7A6PXcvR05Se.WviygY1F7vh9V.fNGXsgTvlfpc/TH46', '429176', NULL, 'aktif', 'kxSPDpvgTO0oyIbYyHsOfdkgpTQqziV8JjG4KHe6w1RmF5CacnBb9zWCFGDB6P7e', '1', '2021-01-17 10:47:23', '2021-01-17 10:48:23', NULL),
(80, 'Elma91', 'elmasuhelma17@gmail.com', '088213743536', '$2y$10$WrYav9EIl59Xs1VxfN2pQ.v7TWp7oFMwnoRQnvn950fKG2XU.c3ce', '163177', NULL, 'aktif', 'yodpmaybxHFf6jDSrEJIzBRq87f2J4rjKT3LltWXAecDOC3huvEKFnZG805isqSd', '1', '2021-01-17 10:54:52', '2021-01-18 07:00:05', NULL),
(81, 'Ajat', 'alfiefthea@gmail.com', '085719590876', '$2y$10$8BQFbtfWT8/eLraTP.VNEu560F1554rTIC1oJH21WIwAk9UO2bntC', '379111', NULL, 'aktif', NULL, '0', '2021-01-17 10:59:20', '2021-01-18 07:00:05', NULL),
(82, 'Muhammad Zaini', 'zaini10zaini@gmail.comy', '085216489808', '$2y$10$eAKmjS2KnCHiBTi5aN4Ac.NEUGjWjDAGFnhfV5vFC8iPsPSVvXaMO', '111222', NULL, 'aktif', 'g0tiuCFVYUDmPiBtOQAPuRx6J2f39DEMngqoR7Uqsz8Q4MZlXJLfSncCTaYN3bEh', '1', '2021-01-17 11:10:16', '2021-01-18 07:00:05', NULL),
(83, 'Asep Wijaya', 'asepwijayagrab84@gmail.com', '082112844534', '$2y$10$ivuDyQ7KjIRCrWBKvVsVIumIYPjplRLhhEDZrR3I7vcmanbB3O7ai', '040709', NULL, 'aktif', 'wrmzzU70XMLvnSNZfIWq4KL2DWPGQpktO8HJo5e1hwFsuR7s8aprTVxh9CVbSQBj', '0', '2021-01-17 11:31:25', '2021-01-18 10:18:10', NULL),
(84, 'Pardan gina', 'fardangina93@gmail.com', '085156035519', '$2y$10$ko.0eg6VpUt1wp3rCpC1e.ON7SrW/.LfF1crXqYBgaaplANGD42YK', '120398', NULL, 'aktif', 'SCzGKdw6YvxQpyk09E5MFE43ggrAHwnPACN42sORtbInU8XojiXbKOhTNa7qvDfB', '1', '2021-01-17 11:39:04', '2021-01-17 11:42:18', NULL),
(85, 'Nur soleh', 'noersoleh93@gmail.com', '081224206493', '$2y$10$cAmYOiyZXu6gi7KOOzB7weXNL91xQqBugp69DvvGGMu3T3A8BqpqC', '040130', NULL, 'aktif', NULL, '0', '2021-01-17 11:50:45', '2021-01-17 11:51:15', NULL),
(86, 'Dian rusdiana', 'dianrusdiana6485@gmail.com', '081283317481', '$2y$10$BvtOpC.YgZp4nTQ14mOxSuR.7K8FN/BSAq1l8PInhtjeCcMuDN87W', '342627', NULL, 'aktif', NULL, '0', '2021-01-17 12:04:40', '2021-01-18 07:00:05', NULL),
(87, 'kalbadriyudin', 'badrisayyidsayyidbadri@gmail.com', '089630218950', '$2y$10$op9XHbQ5lYAOXNXsMDKCLu7b0jyCi10Vkaqnq0BB/LoD6KABtG7GC', '123456', NULL, 'aktif', '06xRgjSsiZ7QzklOqUvvLeI4ub63EYTAyfKwx4NyCzBdZ9Fhb1LJJhmWMFcoTADB', '1', '2021-01-17 12:11:33', '2021-01-18 07:00:05', NULL),
(88, 'amengall', 'amengall79@gmail.com', '081387892053', '$2y$10$.48EHKZrYcQB6A2ujPXcW.w04n6A6mLj2FOWSGsZT6GPe.gKojqvK', '157750', NULL, 'aktif', 'UJOqYra5p1cWtg1XFTDbSQEak6KFbvpZ8ImIBxcCs40DvnjzEKd2XdAkHM9RzJW3', '1', '2021-01-17 12:17:03', '2021-01-17 12:17:32', NULL),
(89, 'Reizjordan82', 'reizmyns1982@gmail.com', '085693941982', '$2y$10$YXN4bLVqfnj4RFsEVfjgw.gzZEUaQXiOm8YlqN24onlN/MbDpNHmO', '281982', NULL, 'aktif', 'K94N3XBbUWtFwVxeg2nIbHLknjB3AJJudiDtYiGhK0PUOoYHDR1Mo8mfQTac8RzL', '1', '2021-01-17 12:40:29', '2021-01-18 07:00:05', NULL),
(90, 'Maya Sari', 'wildancaca66@gmail.com', '0895351047755', '$2y$10$vyf2l.U54UmpsUVWW8rz1OVLhuxgRPDLHs0Xa2ZVq6naXYM6rNiBy', '792013', NULL, 'aktif', NULL, '0', '2021-01-17 12:54:42', '2021-01-18 07:00:05', NULL),
(91, 'Dede Dzikri Mauludin', 'deziknaminasae@gmail.com', '085695219762', '$2y$10$DUaBXBZz3676xwgL2t8f7eRJDeGx.dgzC5PK2PqaolZE3rFlyRRp.', '100383', NULL, 'aktif', 'k6Vd4WmgEQlH1ersXjxTQf9rZ079tUA6PBKKpDjIvhOLolcDuR1di4OhAgTfGa8C', '1', '2021-01-17 12:55:11', '2021-01-18 07:00:05', NULL),
(92, 'Ahmad Yazid', 'ahmadyazid369@gmail.com', '081319642610', '$2y$10$Tqv1demvsmtMAHleezOBjOe3hbFwFe7BoXCFpmfUzIANiz38um3j.', '030609', NULL, 'aktif', NULL, '0', '2021-01-17 12:55:19', '2021-01-18 11:16:45', NULL),
(93, 'Meli Amelia', 'meliamelia24@gmail.com', '081584324430', '$2y$10$8IXQQoH4JmaDYLHJQ72/pOQ0oR.TGImDGr0mB1HDQWSFeOGJR1Gqy', '100383', NULL, 'aktif', 'kvoslyPQ0xXt1oF8rijED4TmjunI39GEKJYffh7WA8M2RdOaZZqC4gcpACaDlPLw', '1', '2021-01-17 13:25:27', '2021-01-17 13:25:37', NULL),
(94, 'Meli Amelia', 'meliamelia2404@gmail.com', '081584324430', '$2y$10$oSJQNUq93sgPDwhb0GZifuNhD76qpLk4BV/Vy4RNHLXJn/C2S3FJe', '100383', NULL, 'aktif', 'JR1MClp9hkLh1vV4ngu2XPfsgA5N63JetzCBynzZMKswSdxaoX9mQFeGD4TNFU0U', '1', '2021-01-17 13:37:13', '2021-01-18 07:00:05', NULL),
(95, 'Taufik hidayat', 'ebesdikahfi@gmail.com', '085817899741', '$2y$10$xlKvglxJ6YwgfgX9Z6kkTeRZsLN2Cl0fcssxrRWHtcLKZqOoYVB9y', '654321', NULL, 'aktif', NULL, '0', '2021-01-17 14:44:27', '2021-01-17 14:44:45', NULL),
(96, 'Aden Jabar Rosadi', 'ajabarosadi@gmail.com', '081511164640', '$2y$10$RSXfY1OzIE.9v.Ii28y.puOkFKY78yv8MLDdO0WMrW.v1PGhDJUBa', '656565', NULL, 'aktif', NULL, NULL, '2021-01-17 14:53:50', '2021-01-17 14:53:50', NULL),
(97, 'Rifan apriana', 'rifanapriana@gmail.com', '087870002025', '$2y$10$RDyxUjcK8qV8bs0woIbmX.BVl5/bBwAwzATVScw0dnPjAAouI2JWi', '454321', NULL, 'aktif', 'f4gBeTnXpapOWKAct7JkCyZshJFATyVbedC6QxINPUQqUNgm1dbocnzD2uPXlo8O', '1', '2021-01-17 15:11:03', '2021-01-18 07:00:05', NULL),
(98, 'Suryadi', 'suryadidoang836@gmail.com', '085884085993', '$2y$10$v3WSoOUy/z2g8XLMETAPk.TTANAjHxfAD0xItL/pHwszTv1pqOsGa', '235689', NULL, 'aktif', NULL, '0', '2021-01-17 15:21:43', '2021-01-18 10:18:17', NULL),
(99, 'Istikhori', 'khoriboji@gmail.com', '081282044924', '$2y$10$jmB29MzOrD6qwatwS5tUf.D7TkmTCexhQ1xARPOqObKxUo1Q.bakS', '897632', NULL, 'aktif', 'SbTjwHAKgpCx354oX7TFhDr1Uy3YzufdSo0mqW9ILl65vM8QebBWkYEEGl2nIi8a', '0', '2021-01-17 15:30:05', '2021-01-18 07:00:05', NULL),
(100, 'Elah nurlaelah', 'elahnurlaelah172@gmail.com', '081519515056', '$2y$10$/wCyNy8iY8TPb19fx8buqunFxm3S4A3BifbSlggLyLOV2Ru65a4kW', '343434', NULL, 'aktif', 'c8JnAmyHOI03kfIjDQyUqZfQpN2JqZedweV7uhSunmWvLxL1HSi72FP5hBg8lwsC', '0', '2021-01-17 15:46:10', '2021-01-18 11:55:52', NULL),
(101, 'Helmiyanti', 'helmiyanti521@gmail.com', '081217728217', '$2y$10$DPi3KH1iL15fiMvnSHZHc.OUmwlqYRdiua45w7CWh/Kb0KeviOkPq', '290614', NULL, 'aktif', 'zBHDcNVhmFPILBPqCgpWwS6nr2UOhU4xWE0iObSMe8tEkR4dcnzGdta8p97DyqsN', '1', '2021-01-17 16:31:33', '2021-01-18 07:00:05', NULL),
(102, 'Endeh', 'endehendeh128@gmail.com', '082260716519', '$2y$10$ifHbg.wWtS4WKA6qSU/3GOJ5Tl1sGFFwSoU8nUO1YUjGkaXBH1PVS', '221234', NULL, 'aktif', 'L7e2Do3AhuVvFIvZEJqH0c7XSxlMGurDawmiO1QVQGz0PoNcbC3dBankrpFfyUZw', '0', '2021-01-17 16:47:38', '2021-01-18 07:06:10', NULL),
(103, 'chemong60', 'cemongabidin60@gmail.com', '085817070364', '$2y$10$bbgrT4tv05gqRKUaEWtDZO.0FAEtpG.nkuCHqPpw8CW7vLRqJHiFG', '111424', NULL, 'aktif', 'KIEv1zzausjmqCDIOJ5grNTXOPZq1xFkPteYbG36cc3YBUA8aVdH9DLFbxkmXrf2', '0', '2021-01-17 16:58:31', '2021-01-17 19:32:53', NULL),
(104, 'Siti kodriarul maptuhah', 'siti.kodriatu@gmail.com', '082125993650', '$2y$10$d921ats3QlyZRxLOd/ZVhuKlZ7.O/V68/5b1O8IopWpY2iOFEXZUW', '119898', NULL, 'aktif', NULL, '0', '2021-01-17 17:37:59', '2021-01-17 17:38:33', NULL),
(105, 'Siti evi alfiah', 'sitievialfiah16@gmail.com', '081398443745', '$2y$10$LrBfLjcNJSRsDgyrVC7od.c/tyEtbD0XA6vN43HH39pSCqSpsopBu', '119898', NULL, 'aktif', NULL, '0', '2021-01-17 18:06:28', '2021-01-18 07:00:05', NULL),
(106, 'Siti manhusaniah', 'sitimanhusania@gmail.com', '085781183823', '$2y$10$hhlZxAjuIbn8uyaZBpihaegUeSwsC7uz267RG7/zR9ZUMY5mCAnt6', '119898', NULL, 'aktif', 'Zh3QFKkQvuCyE05nsC2MABaXpdu5PJcTHSmd07irDyU8Xn6MtOcgVHSwABmjhwZ4', '0', '2021-01-17 18:06:44', '2021-01-17 19:16:51', NULL),
(107, 'Solehudin', 'solehudinpurnamaanom@gmail.com', '0895339157995', '$2y$10$dehAat9TFj459thU6kUZTuvwFL6Z.8QrVZY84jKhtLtGZXfs2MdgO', '199696', NULL, 'aktif', NULL, '0', '2021-01-17 18:06:52', '2021-01-18 11:52:35', NULL),
(108, 'Nurdinhidayat', 'nurdinhidayat288@gmail.com', '083149864541', '$2y$10$KjGkDx3Y95aUvhYTdqGkb.vV8jced09s/o4RjIoiGC4.ZJYr7P6mC', '123456', NULL, 'aktif', NULL, '0', '2021-01-17 18:30:09', '2021-01-17 18:30:30', NULL),
(109, 'Baehaki', 'beyiskandarwww@gmail.com', '081211705089', '$2y$10$aTSrJPpTgYN/lWytk2ZbSu/BQDKklGeonqUkf8v3uOoMywZZBZIiG', '272756', NULL, 'aktif', 'jNxvn2uEWfEdaTUemgMB7K5SBGGwPQIHUAhDt2f4QZxwyOHq1k1m3zDLOj5VpYeL', '1', '2021-01-17 19:14:05', '2021-01-18 11:22:13', NULL),
(110, 'Riska Ekawati', 'riskaekawati7953@gmail.com', '081517160214', '$2y$10$RHI3w1BuiZcZYV72POViP.iUYhMMLf6znOq.KLC1ZQq4GMDuFNXGu', '271186', NULL, 'aktif', NULL, '0', '2021-01-17 19:25:10', '2021-01-17 19:26:10', NULL),
(111, 'Sukron Husnul Yaqin', 'shyriska.fahrizio@gmail.com', '082125212672', '$2y$10$AsXcF.89w2NYwDuN6gxIMupBxBa/FSQqy6cEvRXPv9GPWb9Q75lBy', '801486', NULL, 'aktif', 'UohBtwGIudOjMR2GE5lWkAeqc4nJa9pt5BJv06i4XxNpLY8gXiPRb3ZHYzQxuQoE', '1', '2021-01-17 19:26:05', '2021-01-17 19:26:36', NULL),
(112, 'Yani Andriani', 'ayangbabe@gmail.com', '087785013019', '$2y$10$T03l9FCb5CRIKtI.WXbXl.ms0vcM7V24wXAFd2YuWGlA0Fez3Q9hq', '040496', NULL, 'aktif', 'KCt39i4wfVwoRFmkGdUXTnG7Hxm52jIEL0gix8SOj65tMBv4MlN9uJa3yPVrdYNW', '1', '2021-01-17 19:58:31', '2021-01-17 19:58:57', NULL),
(113, 'asep saepuloh', 'asepsaefullah1009@gmail.com', '08111114961', '$2y$10$Rol2KERGzZoGUxzYCuCvyOM6IQYGypleC5i77h7kzcCx0/489htzm', '109797', NULL, 'aktif', NULL, '0', '2021-01-17 20:32:24', '2021-01-17 20:32:40', NULL),
(114, 'KHAIRUL FAZRI', 'kfazri10@gmail.com', '085885481713', '$2y$10$zp67AbmIdRBUWIWFScLCcu4iCoE3hWYUUM.EXjGgLEKtv9y4yju/e', '123456', NULL, 'aktif', NULL, '0', '2021-01-17 20:38:23', '2021-01-18 09:19:01', NULL),
(115, 'Yogi', 'sunantoyogi59@gmail.com', '085885565238', '$2y$10$ISL.pY6GFZytsl2S755cr.9Rl8daG7f/uV22u2orL4FfBvyuEOPGa', '704177', NULL, 'aktif', 'ODZco53sCRnubJJj147vfPvIeSEwUmYUFig2d8L6mqXYgzsdhxP0bC79HaFhSfoI', '1', '2021-01-17 20:58:15', '2021-01-18 07:00:05', NULL),
(116, 'Muhamad Sidiq Nurohim', 'bangbend18894@gmail.com', '081413222505', '$2y$10$WNcyRoZTyKuixR8LLd6IU.pN/BAY2mjEGwpXH8LeYQVfP5GBz2BKu', '180894', NULL, 'aktif', NULL, '0', '2021-01-17 22:18:20', '2021-01-17 22:18:33', NULL),
(117, 'Kurniyanah', 'kurnianah@gmail.com', '085284034437', '$2y$10$23zpb4x8jkIx9XTiVyNWQODr3lL9jLOG1iAhDuiUx18ME5eTc1mWG', '202079', NULL, 'aktif', 'diNCV1zrEna89TKvY6c0NtysMfiIkF76SacBl2jmD7DGzWUplOZXObmKEARjH9h0', '1', '2021-01-18 06:39:04', '2021-01-18 06:39:29', NULL),
(118, 'Khaerul Falah Sazili', 'kaffa06@gmail.com', '08561164420', '$2y$10$EAXQ7EYdUlubqbZti3mRv.gnUIgNSWCEys1h/I4xyoWs5Z4WifIy6', '282828', NULL, 'aktif', 'Huo3e6xnMlJKAG7XdRdDCQ52SgW7eJLMbaOjQ0of0EN1twAXVytDYIG4V18Wsgma', '0', '2021-01-18 08:37:06', '2021-01-18 08:50:21', NULL),
(119, 'mumuh', 'mumuhmiller@gmail.com', '085775131685', '$2y$10$G8Q8NE3rSeGS7uJo/c0GyeDNmJ6ak0UDrrH5yk7ZudP8LfkS5/KAW', '232627', NULL, 'aktif', NULL, '0', '2021-01-18 08:53:25', '2021-01-18 08:53:45', NULL),
(120, 'muhammadraevan05', 'muhammadraevan05@gmail.com', '085697498710', '$2y$10$hWqHt9aAJkGMlfCef55kReL7mwXBsiThlm3HfXJcszqSE7T8xbv5u', '102025', 16, 'aktif', NULL, '0', '2021-01-18 10:51:05', '2021-01-18 10:52:36', NULL),
(121, 'SUHADI', 'suhadi250388@gmail.com', '085838133117', '$2y$10$P0SF.j2fkM4lyA92oU.YX.JQIMfRe9qug1f0u0wON7eTHCLdGJXBm', '123456', NULL, 'aktif', 'G1ZM27x8gyaFWUtZqqGrFIVbN9zei7yDIdQm0JCBl5SfuiHBU2D1RdxRa9LVkKTz', '1', '2021-01-18 11:39:56', '2021-01-18 11:40:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_bioner_stacking`
--

CREATE TABLE `users_bioner_stacking` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `profit` decimal(15,4) UNSIGNED DEFAULT NULL,
  `total_investment` decimal(15,4) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users_bioner_stacking`
--

INSERT INTO `users_bioner_stacking` (`id`, `id_user`, `profit`, `total_investment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '4.0000', '200.0000', '2021-01-13 10:04:55', '2021-01-18 07:00:05', NULL),
(2, 2, '12.0000', '100.0000', '2021-01-13 10:38:42', '2021-01-18 07:00:05', NULL),
(3, 3, '0.5000', '100.0000', '2021-01-14 16:20:24', '2021-01-18 07:00:05', NULL),
(4, 4, '0.0000', '0.0000', '2021-01-14 17:00:52', '2021-01-15 18:47:37', NULL),
(5, 5, '1.8150', '121.0000', '2021-01-14 18:16:32', '2021-01-18 07:00:05', NULL),
(6, 6, '12.5000', '100.0000', '2021-01-14 18:25:06', '2021-01-18 07:00:05', NULL),
(7, 7, '2.5000', '100.0000', '2021-01-14 18:42:44', '2021-01-18 07:00:05', NULL),
(8, 8, '20.0000', '0.0000', '2021-01-14 20:54:14', '2021-01-15 21:49:21', NULL),
(9, 9, '2.0000', '0.0000', '2021-01-15 09:24:53', '2021-01-18 07:00:05', NULL),
(10, 10, '0.0000', '700.0000', '2021-01-15 11:32:41', '2021-01-18 10:59:23', NULL),
(11, 11, '16.7475', '3349.5000', '2021-01-15 20:32:06', '2021-01-18 07:00:05', NULL),
(12, 12, '0.0000', '0.0000', '2021-01-15 20:56:15', '2021-01-15 20:56:15', NULL),
(13, 13, '0.0000', '0.0000', '2021-01-15 21:01:49', '2021-01-15 21:01:49', NULL),
(14, 14, '0.0000', '0.0000', '2021-01-15 22:01:14', '2021-01-15 22:01:14', NULL),
(15, 15, '0.0000', '0.0000', '2021-01-16 08:44:08', '2021-01-16 08:44:08', NULL),
(16, 16, '4.0000', '400.0000', '2021-01-16 08:44:40', '2021-01-18 07:00:05', NULL),
(17, 17, '1.0000', '100.0000', '2021-01-16 08:46:03', '2021-01-18 07:00:05', NULL),
(18, 18, '15.0000', '1500.0000', '2021-01-16 09:42:36', '2021-01-18 07:00:05', NULL),
(19, 19, '1.0000', '100.0000', '2021-01-16 10:04:33', '2021-01-18 07:00:05', NULL),
(20, 20, '14.0000', '1400.0000', '2021-01-16 10:05:32', '2021-01-18 07:00:05', NULL),
(21, 21, '0.0000', '0.0000', '2021-01-16 10:06:31', '2021-01-16 10:06:31', NULL),
(22, 22, '0.0000', '0.0000', '2021-01-16 10:07:44', '2021-01-16 10:07:44', NULL),
(23, 23, '4.0000', '400.0000', '2021-01-16 10:14:22', '2021-01-18 07:00:05', NULL),
(24, 24, '0.0000', '0.0000', '2021-01-16 10:28:18', '2021-01-16 10:28:18', NULL),
(25, 25, '0.0000', '0.0000', '2021-01-16 10:33:15', '2021-01-16 10:33:15', NULL),
(26, 26, '1.0000', '100.0000', '2021-01-16 11:29:15', '2021-01-18 07:00:05', NULL),
(27, 27, '26.0000', '2600.0000', '2021-01-16 12:27:48', '2021-01-18 07:00:05', NULL),
(28, 28, '17.0000', '2700.0000', '2021-01-16 12:36:35', '2021-01-18 07:00:05', NULL),
(29, 29, '0.0000', '0.0000', '2021-01-16 14:50:13', '2021-01-16 14:50:13', NULL),
(30, 30, '0.0000', '0.0000', '2021-01-16 16:37:57', '2021-01-16 16:37:57', NULL),
(31, 31, '10.0000', '1000.0000', '2021-01-16 16:46:56', '2021-01-18 07:00:05', NULL),
(32, 32, '37.0000', '3700.0000', '2021-01-16 17:03:45', '2021-01-18 07:00:05', NULL),
(33, 33, '0.0000', '0.0000', '2021-01-16 17:45:00', '2021-01-16 17:45:00', NULL),
(34, 34, '20.0000', '2000.0000', '2021-01-16 17:47:19', '2021-01-18 07:00:05', NULL),
(35, 35, '0.0000', '0.0000', '2021-01-16 17:48:50', '2021-01-16 17:48:50', NULL),
(36, 36, '6.0000', '600.0000', '2021-01-16 17:49:38', '2021-01-18 07:00:05', NULL),
(37, 37, '1.0000', '100.0000', '2021-01-16 17:54:16', '2021-01-18 07:00:05', NULL),
(38, 38, '0.0000', '0.0000', '2021-01-16 17:56:01', '2021-01-16 17:56:01', NULL),
(39, 39, '0.0000', '0.0000', '2021-01-16 18:01:57', '2021-01-16 18:01:57', NULL),
(40, 40, '0.0000', '0.0000', '2021-01-16 18:03:00', '2021-01-16 18:03:00', NULL),
(41, 41, '0.0000', '0.0000', '2021-01-16 18:05:10', '2021-01-16 18:05:10', NULL),
(42, 42, '0.0000', '0.0000', '2021-01-16 18:09:35', '2021-01-16 18:09:35', NULL),
(43, 43, '0.0000', '0.0000', '2021-01-16 18:12:13', '2021-01-16 18:12:13', NULL),
(44, 44, '0.0000', '0.0000', '2021-01-16 18:15:56', '2021-01-16 18:15:56', NULL),
(45, 45, '0.0000', '0.0000', '2021-01-16 18:20:01', '2021-01-16 18:20:01', NULL),
(46, 46, '0.0000', '0.0000', '2021-01-16 18:22:35', '2021-01-16 18:22:35', NULL),
(47, 47, '0.0000', '0.0000', '2021-01-16 18:26:22', '2021-01-16 18:26:22', NULL),
(48, 48, '1.0000', '100.0000', '2021-01-16 18:27:33', '2021-01-18 07:00:05', NULL),
(49, 49, '4.0000', '400.0000', '2021-01-16 18:28:35', '2021-01-18 07:00:05', NULL),
(50, 50, '0.0000', '0.0000', '2021-01-16 18:29:19', '2021-01-16 18:29:19', NULL),
(51, 51, '0.0000', '0.0000', '2021-01-16 18:36:49', '2021-01-16 18:36:49', NULL),
(52, 52, '0.0000', '0.0000', '2021-01-16 18:49:38', '2021-01-16 18:49:38', NULL),
(53, 53, '16.0000', '1600.0000', '2021-01-16 19:00:00', '2021-01-18 07:00:05', NULL),
(54, 54, '0.0000', '0.0000', '2021-01-16 19:05:52', '2021-01-16 19:05:52', NULL),
(55, 55, '7.0000', '700.0000', '2021-01-16 19:12:37', '2021-01-18 07:00:05', NULL),
(56, 56, '0.0000', '0.0000', '2021-01-16 19:42:49', '2021-01-16 19:42:49', NULL),
(57, 57, '15.0000', '1500.0000', '2021-01-16 19:59:42', '2021-01-18 07:00:05', NULL),
(58, 58, '0.0000', '0.0000', '2021-01-16 20:04:23', '2021-01-16 20:04:23', NULL),
(59, 59, '2.0000', '200.0000', '2021-01-16 20:49:43', '2021-01-18 07:00:05', NULL),
(60, 60, '0.0000', '0.0000', '2021-01-16 21:00:30', '2021-01-16 21:00:30', NULL),
(61, 61, '11.0000', '1100.0000', '2021-01-16 21:05:01', '2021-01-18 07:00:05', NULL),
(62, 62, '9.0000', '900.0000', '2021-01-16 21:06:52', '2021-01-18 07:00:05', NULL),
(63, 63, '0.0000', '0.0000', '2021-01-16 22:10:15', '2021-01-16 22:10:15', NULL),
(64, 64, '0.0000', '0.0000', '2021-01-17 05:39:39', '2021-01-17 05:39:39', NULL),
(65, 65, '1.5000', '300.0000', '2021-01-17 09:18:27', '2021-01-18 07:00:05', NULL),
(66, 66, '0.0000', '0.0000', '2021-01-17 09:25:27', '2021-01-17 09:25:27', NULL),
(67, 67, '0.0000', '0.0000', '2021-01-17 09:33:30', '2021-01-17 09:33:30', NULL),
(68, 68, '1.0000', '200.0000', '2021-01-17 09:36:29', '2021-01-18 07:00:05', NULL),
(69, 69, '0.0000', '0.0000', '2021-01-17 09:37:55', '2021-01-17 09:37:55', NULL),
(70, 70, '0.0000', '0.0000', '2021-01-17 09:38:10', '2021-01-17 09:38:10', NULL),
(71, 71, '3.5000', '700.0000', '2021-01-17 09:48:16', '2021-01-18 07:00:05', NULL),
(72, 72, '0.0000', '0.0000', '2021-01-17 09:49:25', '2021-01-17 09:49:25', NULL),
(73, 73, '0.0000', '0.0000', '2021-01-17 09:59:37', '2021-01-17 09:59:37', NULL),
(74, 74, '0.5000', '100.0000', '2021-01-17 10:20:48', '2021-01-18 07:00:05', NULL),
(75, 75, '2.5000', '500.0000', '2021-01-17 10:31:34', '2021-01-18 07:00:05', NULL),
(76, 76, '0.0000', '0.0000', '2021-01-17 10:32:36', '2021-01-17 10:32:36', NULL),
(77, 77, '1.0000', '200.0000', '2021-01-17 10:37:31', '2021-01-18 07:00:05', NULL),
(78, 78, '3.5000', '700.0000', '2021-01-17 10:43:53', '2021-01-18 07:00:05', NULL),
(79, 79, '0.0000', '0.0000', '2021-01-17 10:47:23', '2021-01-17 10:47:23', NULL),
(80, 80, '10.0000', '2000.0000', '2021-01-17 10:54:52', '2021-01-18 07:00:05', NULL),
(81, 81, '0.5000', '100.0000', '2021-01-17 10:59:20', '2021-01-18 07:00:05', NULL),
(82, 82, '2.0000', '400.0000', '2021-01-17 11:10:16', '2021-01-18 07:00:05', NULL),
(83, 83, '1.5000', '300.0000', '2021-01-17 11:31:25', '2021-01-18 07:00:05', NULL),
(84, 84, '0.0000', '0.0000', '2021-01-17 11:39:04', '2021-01-17 11:39:04', NULL),
(85, 85, '0.0000', '0.0000', '2021-01-17 11:50:45', '2021-01-17 11:50:45', NULL),
(86, 86, '0.5000', '100.0000', '2021-01-17 12:04:40', '2021-01-18 07:00:05', NULL),
(87, 87, '0.5000', '100.0000', '2021-01-17 12:11:33', '2021-01-18 07:00:05', NULL),
(88, 88, '0.0000', '0.0000', '2021-01-17 12:17:03', '2021-01-17 12:17:03', NULL),
(89, 89, '4.5000', '900.0000', '2021-01-17 12:40:29', '2021-01-18 07:00:05', NULL),
(90, 90, '2.0000', '400.0000', '2021-01-17 12:54:42', '2021-01-18 07:00:05', NULL),
(91, 91, '2.0000', '400.0000', '2021-01-17 12:55:11', '2021-01-18 07:00:05', NULL),
(92, 92, '2.0000', '400.0000', '2021-01-17 12:55:19', '2021-01-18 07:00:05', NULL),
(93, 93, '0.0000', '0.0000', '2021-01-17 13:25:27', '2021-01-17 13:25:27', NULL),
(94, 94, '7.5000', '1500.0000', '2021-01-17 13:37:13', '2021-01-18 07:00:05', NULL),
(95, 95, '0.0000', '0.0000', '2021-01-17 14:44:27', '2021-01-17 14:44:27', NULL),
(96, 96, '0.0000', '0.0000', '2021-01-17 14:53:50', '2021-01-17 14:53:50', NULL),
(97, 97, '0.5000', '100.0000', '2021-01-17 15:11:03', '2021-01-18 07:00:05', NULL),
(98, 98, '0.0000', '0.0000', '2021-01-17 15:21:43', '2021-01-17 15:21:43', NULL),
(99, 99, '1.5000', '300.0000', '2021-01-17 15:30:05', '2021-01-18 07:00:05', NULL),
(100, 100, '1.5000', '300.0000', '2021-01-17 15:46:10', '2021-01-18 07:00:05', NULL),
(101, 101, '9.5000', '1900.0000', '2021-01-17 16:31:33', '2021-01-18 07:00:05', NULL),
(102, 102, '8.0000', '1600.0000', '2021-01-17 16:47:38', '2021-01-18 07:00:05', NULL),
(103, 103, '0.0000', '0.0000', '2021-01-17 16:58:31', '2021-01-17 16:58:31', NULL),
(104, 104, '0.0000', '0.0000', '2021-01-17 17:37:59', '2021-01-17 17:37:59', NULL),
(105, 105, '2.0000', '400.0000', '2021-01-17 18:06:28', '2021-01-18 07:00:05', NULL),
(106, 106, '0.0000', '0.0000', '2021-01-17 18:06:44', '2021-01-17 18:06:44', NULL),
(107, 107, '0.0000', '0.0000', '2021-01-17 18:06:52', '2021-01-17 18:06:52', NULL),
(108, 108, '0.0000', '0.0000', '2021-01-17 18:30:09', '2021-01-17 18:30:09', NULL),
(109, 109, '4.0000', '800.0000', '2021-01-17 19:14:05', '2021-01-18 07:00:05', NULL),
(110, 110, '0.0000', '0.0000', '2021-01-17 19:25:10', '2021-01-17 19:25:10', NULL),
(111, 111, '0.0000', '0.0000', '2021-01-17 19:26:05', '2021-01-17 19:26:05', NULL),
(112, 112, '0.0000', '0.0000', '2021-01-17 19:58:31', '2021-01-17 19:58:31', NULL),
(113, 113, '0.0000', '0.0000', '2021-01-17 20:32:24', '2021-01-17 20:32:24', NULL),
(114, 114, '0.0000', '0.0000', '2021-01-17 20:38:23', '2021-01-17 20:38:23', NULL),
(115, 115, '3.5000', '700.0000', '2021-01-17 20:58:15', '2021-01-18 07:00:05', NULL),
(116, 116, '0.0000', '0.0000', '2021-01-17 22:18:20', '2021-01-17 22:18:20', NULL),
(117, 117, '0.0000', '0.0000', '2021-01-18 06:39:04', '2021-01-18 06:39:04', NULL),
(118, 118, '0.0000', '0.0000', '2021-01-18 08:37:06', '2021-01-18 08:37:06', NULL),
(119, 119, '0.0000', '0.0000', '2021-01-18 08:53:25', '2021-01-18 08:53:25', NULL),
(120, 120, '0.0000', '0.0000', '2021-01-18 10:51:05', '2021-01-18 10:51:05', NULL),
(121, 121, '0.0000', '0.0000', '2021-01-18 11:39:56', '2021-01-18 11:39:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_bioner_trade`
--

CREATE TABLE `users_bioner_trade` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `balance_saldo` decimal(15,4) UNSIGNED DEFAULT NULL,
  `trigger_ask` enum('ya','tidak') DEFAULT 'tidak',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users_bioner_trade`
--

INSERT INTO `users_bioner_trade` (`id`, `id_user`, `balance_saldo`, `trigger_ask`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '0.0000', 'tidak', '2021-01-13 10:04:55', '2021-01-13 10:04:55', NULL),
(2, 2, '18000.0000', 'tidak', '2021-01-13 10:38:42', '2021-01-18 07:00:05', NULL),
(3, 3, '0.0000', 'tidak', '2021-01-14 16:20:24', '2021-01-14 16:20:24', NULL),
(4, 4, '0.0000', 'tidak', '2021-01-14 17:00:52', '2021-01-14 17:00:52', NULL),
(5, 5, '0.0000', 'tidak', '2021-01-14 18:16:32', '2021-01-14 18:16:32', NULL),
(6, 6, '0.0000', 'tidak', '2021-01-14 18:25:06', '2021-01-14 18:25:06', NULL),
(7, 7, '0.0000', 'tidak', '2021-01-14 18:42:44', '2021-01-14 18:42:44', NULL),
(8, 8, '0.0000', 'tidak', '2021-01-14 20:54:14', '2021-01-14 20:54:14', NULL),
(9, 9, '0.0000', 'tidak', '2021-01-15 09:24:53', '2021-01-15 09:24:53', NULL),
(10, 10, '0.0000', 'tidak', '2021-01-15 11:32:41', '2021-01-15 11:32:41', NULL),
(11, 11, '0.0000', 'tidak', '2021-01-15 20:32:06', '2021-01-15 20:32:06', NULL),
(12, 12, '0.0000', 'tidak', '2021-01-15 20:56:15', '2021-01-15 20:56:15', NULL),
(13, 13, '0.0000', 'tidak', '2021-01-15 21:01:49', '2021-01-15 21:01:49', NULL),
(14, 14, '0.0000', 'tidak', '2021-01-15 22:01:14', '2021-01-15 22:01:14', NULL),
(15, 15, '0.0000', 'tidak', '2021-01-16 08:44:08', '2021-01-16 08:44:08', NULL),
(16, 16, '0.0000', 'tidak', '2021-01-16 08:44:40', '2021-01-16 08:44:40', NULL),
(17, 17, '0.0000', 'tidak', '2021-01-16 08:46:03', '2021-01-16 08:46:03', NULL),
(18, 18, '0.0000', 'tidak', '2021-01-16 09:42:36', '2021-01-16 09:42:36', NULL),
(19, 19, '0.0000', 'tidak', '2021-01-16 10:04:33', '2021-01-16 10:04:33', NULL),
(20, 20, '0.0000', 'tidak', '2021-01-16 10:05:32', '2021-01-16 10:05:32', NULL),
(21, 21, '0.0000', 'tidak', '2021-01-16 10:06:31', '2021-01-16 10:06:31', NULL),
(22, 22, '0.0000', 'tidak', '2021-01-16 10:07:44', '2021-01-16 10:07:44', NULL),
(23, 23, '0.0000', 'tidak', '2021-01-16 10:14:22', '2021-01-16 10:14:22', NULL),
(24, 24, '0.0000', 'tidak', '2021-01-16 10:28:18', '2021-01-16 10:28:18', NULL),
(25, 25, '0.0000', 'tidak', '2021-01-16 10:33:15', '2021-01-16 10:33:15', NULL),
(26, 26, '0.0000', 'tidak', '2021-01-16 11:29:15', '2021-01-16 11:29:15', NULL),
(27, 27, '0.0000', 'tidak', '2021-01-16 12:27:48', '2021-01-16 12:27:48', NULL),
(28, 28, '0.0000', 'tidak', '2021-01-16 12:36:35', '2021-01-16 12:36:35', NULL),
(29, 29, '0.0000', 'tidak', '2021-01-16 14:50:13', '2021-01-16 14:50:13', NULL),
(30, 30, '0.0000', 'tidak', '2021-01-16 16:37:57', '2021-01-16 16:37:57', NULL),
(31, 31, '0.0000', 'tidak', '2021-01-16 16:46:56', '2021-01-16 16:46:56', NULL),
(32, 32, '0.0000', 'tidak', '2021-01-16 17:03:45', '2021-01-16 17:03:45', NULL),
(33, 33, '0.0000', 'tidak', '2021-01-16 17:45:00', '2021-01-16 17:45:00', NULL),
(34, 34, '0.0000', 'tidak', '2021-01-16 17:47:19', '2021-01-16 17:47:19', NULL),
(35, 35, '0.0000', 'tidak', '2021-01-16 17:48:50', '2021-01-16 17:48:50', NULL),
(36, 36, '0.0000', 'tidak', '2021-01-16 17:49:38', '2021-01-16 17:49:38', NULL),
(37, 37, '0.0000', 'tidak', '2021-01-16 17:54:16', '2021-01-16 17:54:16', NULL),
(38, 38, '0.0000', 'tidak', '2021-01-16 17:56:01', '2021-01-16 17:56:01', NULL),
(39, 39, '0.0000', 'tidak', '2021-01-16 18:01:57', '2021-01-16 18:01:57', NULL),
(40, 40, '0.0000', 'tidak', '2021-01-16 18:03:00', '2021-01-16 18:03:00', NULL),
(41, 41, '0.0000', 'tidak', '2021-01-16 18:05:10', '2021-01-16 18:05:10', NULL),
(42, 42, '0.0000', 'tidak', '2021-01-16 18:09:35', '2021-01-16 18:09:35', NULL),
(43, 43, '0.0000', 'tidak', '2021-01-16 18:12:13', '2021-01-16 18:12:13', NULL),
(44, 44, '0.0000', 'tidak', '2021-01-16 18:15:56', '2021-01-16 18:15:56', NULL),
(45, 45, '0.0000', 'tidak', '2021-01-16 18:20:01', '2021-01-16 18:20:01', NULL),
(46, 46, '0.0000', 'tidak', '2021-01-16 18:22:35', '2021-01-16 18:22:35', NULL),
(47, 47, '0.0000', 'tidak', '2021-01-16 18:26:22', '2021-01-16 18:26:22', NULL),
(48, 48, '0.0000', 'tidak', '2021-01-16 18:27:33', '2021-01-16 18:27:33', NULL),
(49, 49, '0.0000', 'tidak', '2021-01-16 18:28:35', '2021-01-16 18:28:35', NULL),
(50, 50, '0.0000', 'tidak', '2021-01-16 18:29:19', '2021-01-16 18:29:19', NULL),
(51, 51, '0.0000', 'tidak', '2021-01-16 18:36:49', '2021-01-16 18:36:49', NULL),
(52, 52, '0.0000', 'tidak', '2021-01-16 18:49:38', '2021-01-16 18:49:38', NULL),
(53, 53, '0.0000', 'tidak', '2021-01-16 19:00:00', '2021-01-16 19:00:00', NULL),
(54, 54, '0.0000', 'tidak', '2021-01-16 19:05:52', '2021-01-16 19:05:52', NULL),
(55, 55, '0.0000', 'tidak', '2021-01-16 19:12:37', '2021-01-16 19:12:37', NULL),
(56, 56, '0.0000', 'tidak', '2021-01-16 19:42:49', '2021-01-16 19:42:49', NULL),
(57, 57, '0.0000', 'tidak', '2021-01-16 19:59:42', '2021-01-16 19:59:42', NULL),
(58, 58, '0.0000', 'tidak', '2021-01-16 20:04:23', '2021-01-16 20:04:23', NULL),
(59, 59, '0.0000', 'tidak', '2021-01-16 20:49:43', '2021-01-16 20:49:43', NULL),
(60, 60, '0.0000', 'tidak', '2021-01-16 21:00:30', '2021-01-16 21:00:30', NULL),
(61, 61, '0.0000', 'tidak', '2021-01-16 21:05:01', '2021-01-16 21:05:01', NULL),
(62, 62, '0.0000', 'tidak', '2021-01-16 21:06:52', '2021-01-16 21:06:52', NULL),
(63, 63, '0.0000', 'tidak', '2021-01-16 22:10:15', '2021-01-16 22:10:15', NULL),
(64, 64, '0.0000', 'tidak', '2021-01-17 05:39:39', '2021-01-17 05:39:39', NULL),
(65, 65, '0.0000', 'tidak', '2021-01-17 09:18:27', '2021-01-17 09:18:27', NULL),
(66, 66, '0.0000', 'tidak', '2021-01-17 09:25:27', '2021-01-17 09:25:27', NULL),
(67, 67, '0.0000', 'tidak', '2021-01-17 09:33:30', '2021-01-17 09:33:30', NULL),
(68, 68, '0.0000', 'tidak', '2021-01-17 09:36:29', '2021-01-17 09:36:29', NULL),
(69, 69, '0.0000', 'tidak', '2021-01-17 09:37:55', '2021-01-17 09:37:55', NULL),
(70, 70, '0.0000', 'tidak', '2021-01-17 09:38:10', '2021-01-17 09:38:10', NULL),
(71, 71, '0.0000', 'tidak', '2021-01-17 09:48:16', '2021-01-17 09:48:16', NULL),
(72, 72, '0.0000', 'tidak', '2021-01-17 09:49:25', '2021-01-17 09:49:25', NULL),
(73, 73, '0.0000', 'tidak', '2021-01-17 09:59:37', '2021-01-17 09:59:37', NULL),
(74, 74, '0.0000', 'tidak', '2021-01-17 10:20:48', '2021-01-17 10:20:48', NULL),
(75, 75, '0.0000', 'tidak', '2021-01-17 10:31:34', '2021-01-17 10:31:34', NULL),
(76, 76, '0.0000', 'tidak', '2021-01-17 10:32:36', '2021-01-17 10:32:36', NULL),
(77, 77, '0.0000', 'tidak', '2021-01-17 10:37:31', '2021-01-17 10:37:31', NULL),
(78, 78, '0.0000', 'tidak', '2021-01-17 10:43:53', '2021-01-17 10:43:53', NULL),
(79, 79, '0.0000', 'tidak', '2021-01-17 10:47:23', '2021-01-17 10:47:23', NULL),
(80, 80, '0.0000', 'tidak', '2021-01-17 10:54:52', '2021-01-17 10:54:52', NULL),
(81, 81, '0.0000', 'tidak', '2021-01-17 10:59:20', '2021-01-17 10:59:20', NULL),
(82, 82, '0.0000', 'tidak', '2021-01-17 11:10:16', '2021-01-17 11:10:16', NULL),
(83, 83, '0.0000', 'tidak', '2021-01-17 11:31:25', '2021-01-17 11:31:25', NULL),
(84, 84, '0.0000', 'tidak', '2021-01-17 11:39:04', '2021-01-17 11:39:04', NULL),
(85, 85, '0.0000', 'tidak', '2021-01-17 11:50:45', '2021-01-17 11:50:45', NULL),
(86, 86, '0.0000', 'tidak', '2021-01-17 12:04:40', '2021-01-17 12:04:40', NULL),
(87, 87, '0.0000', 'tidak', '2021-01-17 12:11:33', '2021-01-17 12:11:33', NULL),
(88, 88, '0.0000', 'tidak', '2021-01-17 12:17:03', '2021-01-17 12:17:03', NULL),
(89, 89, '0.0000', 'tidak', '2021-01-17 12:40:29', '2021-01-17 12:40:29', NULL),
(90, 90, '0.0000', 'tidak', '2021-01-17 12:54:42', '2021-01-17 12:54:42', NULL),
(91, 91, '0.0000', 'tidak', '2021-01-17 12:55:11', '2021-01-17 12:55:11', NULL),
(92, 92, '0.0000', 'tidak', '2021-01-17 12:55:19', '2021-01-17 12:55:19', NULL),
(93, 93, '0.0000', 'tidak', '2021-01-17 13:25:27', '2021-01-17 13:25:27', NULL),
(94, 94, '0.0000', 'tidak', '2021-01-17 13:37:13', '2021-01-17 13:37:13', NULL),
(95, 95, '0.0000', 'tidak', '2021-01-17 14:44:27', '2021-01-17 14:44:27', NULL),
(96, 96, '0.0000', 'tidak', '2021-01-17 14:53:50', '2021-01-17 14:53:50', NULL),
(97, 97, '0.0000', 'tidak', '2021-01-17 15:11:03', '2021-01-17 15:11:03', NULL),
(98, 98, '0.0000', 'tidak', '2021-01-17 15:21:43', '2021-01-17 15:21:43', NULL),
(99, 99, '0.0000', 'tidak', '2021-01-17 15:30:05', '2021-01-17 15:30:05', NULL),
(100, 100, '0.0000', 'tidak', '2021-01-17 15:46:10', '2021-01-17 15:46:10', NULL),
(101, 101, '0.0000', 'tidak', '2021-01-17 16:31:33', '2021-01-17 16:31:33', NULL),
(102, 102, '0.0000', 'tidak', '2021-01-17 16:47:38', '2021-01-17 16:47:38', NULL),
(103, 103, '0.0000', 'tidak', '2021-01-17 16:58:31', '2021-01-17 16:58:31', NULL),
(104, 104, '0.0000', 'tidak', '2021-01-17 17:37:59', '2021-01-17 17:37:59', NULL),
(105, 105, '0.0000', 'tidak', '2021-01-17 18:06:28', '2021-01-17 18:06:28', NULL),
(106, 106, '0.0000', 'tidak', '2021-01-17 18:06:44', '2021-01-17 18:06:44', NULL),
(107, 107, '0.0000', 'tidak', '2021-01-17 18:06:52', '2021-01-17 18:06:52', NULL),
(108, 108, '0.0000', 'tidak', '2021-01-17 18:30:09', '2021-01-17 18:30:09', NULL),
(109, 109, '0.0000', 'tidak', '2021-01-17 19:14:05', '2021-01-17 19:14:05', NULL),
(110, 110, '0.0000', 'tidak', '2021-01-17 19:25:10', '2021-01-17 19:25:10', NULL),
(111, 111, '0.0000', 'tidak', '2021-01-17 19:26:05', '2021-01-17 19:26:05', NULL),
(112, 112, '0.0000', 'tidak', '2021-01-17 19:58:31', '2021-01-17 19:58:31', NULL),
(113, 113, '0.0000', 'tidak', '2021-01-17 20:32:24', '2021-01-17 20:32:24', NULL),
(114, 114, '0.0000', 'tidak', '2021-01-17 20:38:23', '2021-01-17 20:38:23', NULL),
(115, 115, '0.0000', 'tidak', '2021-01-17 20:58:15', '2021-01-17 20:58:15', NULL),
(116, 116, '0.0000', 'tidak', '2021-01-17 22:18:20', '2021-01-17 22:18:20', NULL),
(117, 117, '0.0000', 'tidak', '2021-01-18 06:39:04', '2021-01-18 06:39:04', NULL),
(118, 118, '0.0000', 'tidak', '2021-01-18 08:37:06', '2021-01-18 08:37:06', NULL),
(119, 119, '0.0000', 'tidak', '2021-01-18 08:53:25', '2021-01-18 08:53:25', NULL),
(120, 120, '0.0000', 'tidak', '2021-01-18 10:51:05', '2021-01-18 10:51:05', NULL),
(121, 121, '0.0000', 'tidak', '2021-01-18 11:39:56', '2021-01-18 11:39:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_banks`
--

CREATE TABLE `user_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `no_rekening` varchar(255) DEFAULT NULL,
  `id_bank` int(10) UNSIGNED DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_banks`
--

INSERT INTO `user_banks` (`id`, `id_user`, `no_rekening`, `id_bank`, `atas_nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '8720231248', 53, 'Abdul khaer', '2021-01-13 10:42:26', '2021-01-13 10:42:26', NULL),
(2, 6, '1740068608', 53, 'Muhammad Malik Abdul Azis', '2021-01-14 18:34:30', '2021-01-14 18:34:30', NULL),
(3, 7, '0155709021', 50, 'Endang muriwati', '2021-01-14 19:04:43', '2021-01-14 19:04:43', NULL),
(4, 4, '0953898681', 53, 'Burhannudin', '2021-01-14 23:25:29', '2021-01-14 23:25:29', NULL),
(5, 9, '0312604904', 53, 'Satria Utama', '2021-01-15 10:29:41', '2021-01-15 10:29:41', NULL),
(6, 5, '0953526619', 53, 'Anisah Andeani', '2021-01-15 13:14:45', '2021-01-15 13:14:45', NULL),
(7, 8, '1988415841', 53, 'adam', '2021-01-15 21:47:31', '2021-01-15 21:47:31', NULL),
(8, 11, '8720535581', 53, 'Patulloh SE', '2021-01-15 22:17:21', '2021-01-15 22:17:21', NULL),
(9, 15, '8720580404', 53, 'Abdul basit', '2021-01-16 08:49:03', '2021-01-16 08:49:03', NULL),
(10, 16, '8720557933', 53, 'Maulana yusup', '2021-01-16 08:50:08', '2021-01-16 08:50:08', NULL),
(11, 18, '725690046', 50, 'Lia Mariya Ulfa', '2021-01-16 10:01:10', '2021-01-16 10:01:10', NULL),
(12, 28, '6820919325', 53, 'Musthofa', '2021-01-16 12:54:07', '2021-01-16 12:54:07', NULL),
(13, 29, '7098418967', 36, 'Firda herlina', '2021-01-16 14:56:40', '2021-01-16 14:56:40', NULL),
(14, 34, '1740294101', 53, 'Lastuti', '2021-01-16 17:58:37', '2021-01-16 17:58:37', NULL),
(15, 40, '7039881718', 36, 'Yachya Supriadi', '2021-01-16 18:05:42', '2021-01-16 18:05:42', NULL),
(16, 36, '6821036566', 53, 'Ade Handono', '2021-01-16 18:09:23', '2021-01-16 18:09:23', NULL),
(17, 32, '8720481155', 53, 'Harun Rudiansyah', '2021-01-16 18:47:28', '2021-01-16 18:47:28', NULL),
(18, 56, '6820774963', 53, 'Ridwan fauzi', '2021-01-16 19:52:10', '2021-01-16 19:52:10', NULL),
(19, 58, '7041178048', 36, 'Yadi Mulyadi', '2021-01-16 20:10:17', '2021-01-16 20:10:17', NULL),
(20, 57, '0140019928', 53, 'KRISNA MUKTI', '2021-01-16 20:14:36', '2021-01-16 20:14:36', NULL),
(21, 59, '4270087154', 53, 'Dewi purnama', '2021-01-16 20:55:58', '2021-01-16 20:55:58', NULL),
(22, 60, '6820802061', 53, 'Encep ahmad sujai', '2021-01-16 21:04:27', '2021-01-16 21:04:27', NULL),
(23, 61, '8720998743', 53, 'Erni Puspita Dewi', '2021-01-16 21:12:09', '2021-01-16 21:12:09', NULL),
(24, 62, '7380319823', 53, 'Yusup Ali N', '2021-01-16 21:15:22', '2021-01-16 21:15:22', NULL),
(25, 63, '5721081967', 53, 'Siti Nurfadilah', '2021-01-16 22:13:20', '2021-01-16 22:13:20', NULL),
(26, 3, '7560056651', 53, 'Mohamad sopiyan', '2021-01-17 07:35:47', '2021-01-17 07:35:47', NULL),
(27, 82, '8720247969', 53, 'Muhammad Zaini', '2021-01-17 11:19:57', '2021-01-17 11:19:57', NULL),
(28, 83, '1740331953', 53, 'Asep Wijaya', '2021-01-17 11:42:34', '2021-01-17 11:42:34', NULL),
(29, 69, '6821006047', 53, 'endang nuryawan', '2021-01-17 11:54:48', '2021-01-17 11:54:48', NULL),
(30, 80, '1740370576', 53, 'Maulana SHI', '2021-01-17 11:56:47', '2021-01-17 11:56:47', NULL),
(31, 67, '0710237492', 53, 'Kiki lesmana', '2021-01-17 11:57:40', '2021-01-17 11:57:40', NULL),
(32, 74, '081001037476534', 48, 'Enih Rofikoh', '2021-01-17 12:51:10', '2021-01-17 12:51:10', NULL),
(33, 91, '1740376671', 53, 'Dede Dzikri Mauludin', '2021-01-17 14:38:17', '2021-01-17 14:38:17', NULL),
(34, 102, '8720617006', 53, 'Endeh', '2021-01-17 16:58:20', '2021-01-17 16:58:20', NULL),
(35, 112, '8720573661', 53, 'Yani andriani', '2021-01-17 20:03:24', '2021-01-17 20:03:24', NULL),
(36, 113, '0904512366', 50, 'asep saepuloh', '2021-01-17 20:39:05', '2021-01-17 20:39:05', NULL),
(37, 105, '479601034055531', 48, 'Siti evi alfiah', '2021-01-18 06:51:11', '2021-01-18 06:51:11', NULL),
(38, 114, '1330016085474', 49, 'KHAIRUL FAZRI', '2021-01-18 09:21:55', '2021-01-18 09:21:55', NULL),
(39, 121, '4061177731', 53, 'SUHADI', '2021-01-18 11:42:50', '2021-01-18 11:42:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_bioner_stacking_withdraw`
--

CREATE TABLE `user_bioner_stacking_withdraw` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `id_user_bank` int(10) UNSIGNED DEFAULT NULL,
  `id_user_wallet` int(10) UNSIGNED DEFAULT NULL,
  `kode_withdraw` varchar(255) DEFAULT NULL COMMENT 'W.ID_USER.DDMMYY.##',
  `kode_invest` varchar(255) DEFAULT NULL,
  `withdraw_b` decimal(15,4) UNSIGNED DEFAULT NULL,
  `withdraw_rp` decimal(15,4) UNSIGNED DEFAULT NULL,
  `status` enum('pending','success','reject') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_bioner_stacking_withdraw`
--

INSERT INTO `user_bioner_stacking_withdraw` (`id`, `id_user`, `id_user_bank`, `id_user_wallet`, `kode_withdraw`, `kode_invest`, `withdraw_b`, `withdraw_rp`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, NULL, 'BSW2.1401211', NULL, '0.5000', '5000.0000', 'pending', '2021-01-14 19:06:44', '2021-01-14 19:06:44', '2021-01-14 19:07:28'),
(2, 2, 1, NULL, 'BSW2.1501211', NULL, '1.0000', '10000.0000', 'pending', '2021-01-15 11:11:59', '2021-01-15 11:11:59', '2021-01-15 11:12:44'),
(3, 2, 1, NULL, 'BSW2.1501212', NULL, '1.0000', '10000.0000', 'pending', '2021-01-15 20:21:07', '2021-01-15 20:21:07', '2021-01-15 20:21:59'),
(4, 8, 7, NULL, 'BSW8.1501211', NULL, '20.0000', '200000.0000', 'pending', '2021-01-15 21:48:23', '2021-01-15 21:48:23', '2021-01-15 21:48:48'),
(5, 5, NULL, NULL, 'BSW5.1601211', 'BS5.1601211', '21.0000', '0.0000', 'success', '2021-01-16 05:28:45', '2021-01-16 05:28:45', NULL),
(6, 2, 1, NULL, 'BSW2.1601211', NULL, '11.0000', '110000.0000', 'pending', '2021-01-16 14:46:10', '2021-01-16 14:46:10', '2021-01-16 14:46:44'),
(7, 28, 12, NULL, 'BSW28.1701211', NULL, '10.0000', '100000.0000', 'success', '2021-01-17 08:48:22', '2021-01-17 17:13:25', NULL),
(8, 11, NULL, NULL, 'BSW11.1701211', 'BS11.1701211', '49.5000', '0.0000', 'success', '2021-01-17 22:40:32', '2021-01-17 22:40:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_bioner_trade_withdraw`
--

CREATE TABLE `user_bioner_trade_withdraw` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `id_user_bank` int(10) UNSIGNED DEFAULT NULL,
  `kode_withdraw` varchar(255) DEFAULT NULL,
  `kode_invest` varchar(255) DEFAULT NULL,
  `withdraw_rp` decimal(15,4) UNSIGNED DEFAULT NULL,
  `status` enum('pending','success','reject') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `user_wallets`
--

CREATE TABLE `user_wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `no_wallet` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `bioner_stacking`
--
ALTER TABLE `bioner_stacking`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `bioner_stacking_logs`
--
ALTER TABLE `bioner_stacking_logs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `bioner_trade`
--
ALTER TABLE `bioner_trade`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `bioner_trade_logs`
--
ALTER TABLE `bioner_trade_logs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `log_email_signup`
--
ALTER TABLE `log_email_signup`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `param_banks`
--
ALTER TABLE `param_banks`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_test`
--
ALTER TABLE `tb_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users_bioner_stacking`
--
ALTER TABLE `users_bioner_stacking`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users_bioner_trade`
--
ALTER TABLE `users_bioner_trade`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_banks`
--
ALTER TABLE `user_banks`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_bioner_stacking_withdraw`
--
ALTER TABLE `user_bioner_stacking_withdraw`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_bioner_trade_withdraw`
--
ALTER TABLE `user_bioner_trade_withdraw`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_wallets`
--
ALTER TABLE `user_wallets`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bioner_stacking`
--
ALTER TABLE `bioner_stacking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `bioner_stacking_logs`
--
ALTER TABLE `bioner_stacking_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `bioner_trade`
--
ALTER TABLE `bioner_trade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bioner_trade_logs`
--
ALTER TABLE `bioner_trade_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log_email_signup`
--
ALTER TABLE `log_email_signup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `param_banks`
--
ALTER TABLE `param_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tb_test`
--
ALTER TABLE `tb_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `users_bioner_stacking`
--
ALTER TABLE `users_bioner_stacking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `users_bioner_trade`
--
ALTER TABLE `users_bioner_trade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `user_banks`
--
ALTER TABLE `user_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_bioner_stacking_withdraw`
--
ALTER TABLE `user_bioner_stacking_withdraw`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_bioner_trade_withdraw`
--
ALTER TABLE `user_bioner_trade_withdraw`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_wallets`
--
ALTER TABLE `user_wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
