-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2021 at 05:43 PM
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
(1, 'master', 'admin', '$2y$10$63wfXBI8UMXeUs6uQtscoOzgbjtwOFAhZMG2G.GqTQA5WiWrW2IuO', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, 'W1TLPzo38UpQ62R9FVlMax5s5XNqbIDHwELOtfslFOPnkNaeB1UR7W0YbmrVjquu', '1');

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
(1, 'BS1.1301211', 1, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-13 10:05:40', '2021-01-15 07:00:05', NULL),
(2, 'BS2.1301211', 2, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-13 10:39:41', '2021-01-15 07:00:05', NULL),
(3, 'BS4.1401211', 4, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-14 17:03:40', '2021-01-14 17:03:40', '2021-01-15 18:47:37'),
(4, 'BS5.1401211', 5, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-14 18:18:38', '2021-01-15 07:00:05', NULL),
(5, 'BS6.1401211', 6, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-14 18:27:04', '2021-01-15 07:00:05', NULL),
(6, 'BS7.1401211', 7, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-14 18:44:26', '2021-01-15 07:00:05', NULL),
(7, 'BS8.1501211', 8, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-15 00:09:23', '2021-01-15 00:09:23', '2021-01-15 21:43:05'),
(8, 'BS9.1501211', 9, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-15 09:27:02', '2021-01-15 09:43:37', NULL),
(9, 'BS10.1501211', 10, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-15 11:36:55', '2021-01-15 11:36:55', '2021-01-15 22:49:34'),
(10, 'BS11.1501211', 11, '3.0000', '54100000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 20:34:41', '2021-01-15 20:34:41', '2021-01-15 20:37:39'),
(11, 'BS11.1501212', 11, '3.0000', '54100000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 20:34:59', '2021-01-15 20:34:59', '2021-01-15 20:37:19'),
(12, 'BS11.1501213', 11, '3.0000', '54100000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 20:38:35', '2021-01-15 20:38:35', '2021-01-15 21:42:07'),
(13, 'BS11.1501214', 11, '3.0000', '54000000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 20:41:51', '2021-01-15 20:41:51', '2021-01-15 21:42:14'),
(14, 'BS8.1501212', 8, '3.0000', '54000000.0000', '0.015', '150.0000', 'menunggu_transfer', NULL, '2021-01-15 21:17:41', '2021-01-15 21:17:41', '2021-01-15 21:42:41'),
(15, 'BS8.1501213', 8, '1100.0000', '16500000.0000', '5.5', '55000.0000', 'menunggu_transfer', NULL, '2021-01-15 21:41:42', '2021-01-15 21:41:42', '2021-01-15 21:42:52'),
(16, 'BS8.1501214', 8, '3600.0000', '54100000.0000', '18', '180000.0000', 'menunggu_transfer', NULL, '2021-01-15 21:43:31', '2021-01-15 21:43:31', '2021-01-15 21:49:21'),
(17, 'BS11.1501215', 11, '3300.0000', '49600000.0000', '16.5', '165000.0000', 'aktif', NULL, '2021-01-15 21:51:31', '2021-01-15 22:48:27', NULL);

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
(35, 10, 9, 'delete investment', '100.0000', '1000000.0000', 'BS10.1501211', 'Investment Dibatalkan', '2021-01-15 22:49:34');

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
(1, 'BT2.1301211', 2, 'aktif', NULL, '2021-01-13 22:21:23', '2021-01-15 07:00:05', NULL);

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
(3, 2, 1, 'profit', 'BT2.1301211', NULL, 'Distribusi Profit Sebesar Rp.3000', '2021-01-15 07:00:05');

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
(14, 14, '<pre>\n\n</pre>', '2021-01-15 22:00:00');

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
(1, 'Nurhasan', 'tebe.inside@gmail.com', '081288611126', '$2y$10$F.jKs2E2aR3oNmabxeE0U.S9v.dysch5PaeHmS20AAgOKOo3aC06W', '060606', NULL, 'aktif', 'Pf8g2Ih1lSD5GOPiOqnFxGwUfMnvyuc5KeMtzAvI7kj1HdbT7s9FrlosZ6UpL2rW', '1', '2021-01-13 10:04:55', '2021-01-15 07:00:05', NULL),
(2, 'Abdul khaer', 'abdulkhaer321@gmail.com', '081219869989', '$2y$10$DekKRUziVXv0vhmljkW5lukojGeA.GMdwQUtFuKUvse9gw6J4df9G', '321598', NULL, 'aktif', 'ucsPQ4IDSNZDblHd9xi27jGld0MU5zEEkrtC6jig8k2zKw3TuMvFbtnOrhxYmyGh', '1', '2021-01-13 10:38:42', '2021-01-16 00:09:05', NULL),
(3, 'Mohamad sopiyan', 'sopiyanmohamad10@gmail.com', '085715556746', '$2y$10$N7GU5l0T4RhOe4AzLF6HheifitiUpNcFMBx1xMDqMuKPB/y3ryFAe', '121314', NULL, 'aktif', 'PYwtkByyptiT6Gozx6E3Jv0QVHD7Z4s5lOvu8jG921FpXERa5jrmq19UeghWr2DA', '0', '2021-01-14 16:20:24', '2021-01-14 16:40:29', NULL),
(4, 'Burhan', 'burhannudinsyabil7@gmail.com', '087788388914', '$2y$10$4ZVHUMI0Kd4cct5di1eRCeqMOnHqoBAZiInzchRFwee3T7HGUMAla', '051209', NULL, 'aktif', 'e1BRJwF5plPT76vDOepOtYEW27wjfn9lLiIhKs0iaLq3gN0VuAc9UCcHW4nborxS', '0', '2021-01-14 17:00:52', '2021-01-14 17:08:08', NULL),
(5, 'Anisah Andeani', 'andeani77@gmail.com', '081289520105', '$2y$10$2yWub//8STua0oH82YqVtucw6hDs5c9lrqCum/9/nfR6HFCQx7UKK', '160414', NULL, 'aktif', 'm2PLUX5bFNKSxI1rbXY4qoE97xGaVsn8eu3wzckVQJ4FZaTdrRg8gPBWytkZoShe', '1', '2021-01-14 18:16:32', '2021-01-15 07:00:05', NULL),
(6, 'Muhammad Malik Abdul Azis', 'azis12194@gmail.com', '081289361822', '$2y$10$ipcUVPfW16X08SU8wMjWnevZHWMAT4z3sqbq2e8SY5P/4zI3LiaCa', '121945', 5, 'aktif', NULL, '0', '2021-01-14 18:25:06', '2021-01-15 09:47:18', NULL),
(7, 'Endang', 'endang.bioner@gmail.com', '081315159897', '$2y$10$DJKel3f8I1JLcT9TTSaqrO8cPMWWlBWwLyGdaDSyS2kQBg7Z6OXU.', '040871', 5, 'aktif', '4GrD8HmB0W7a9PZR1pC1GuHUgfiIhbdMAjENOcxpX2IisNawZMyqQ2vhQUVgJPLv', '1', '2021-01-14 18:42:44', '2021-01-15 07:00:05', NULL),
(8, 'Adam', 'adam.pm77@gmail.com', '082114578976', '$2y$10$8UPDO4reGim2sdfCv3xQpuIHNJp5Mx0eBPglh.yX3LcUif02IchOy', '591990', NULL, 'aktif', 'brIHnAxW8lbRcRo8aJDTfU6kIBmGXtqsL7CFqPhpVCav94prejYUg4tGy1QDm3lf', '0', '2021-01-14 20:54:14', '2021-01-15 22:36:04', NULL),
(9, 'Satria Utama', 'satriau20@gmail.com', '089622314346', '$2y$10$5Io693ghnQhRrE4U8Jd0fe4ReE9ZXmBEG5Mszl6r6vgVf37IHMZZm', '141414', 6, 'aktif', NULL, '0', '2021-01-15 09:24:53', '2021-01-15 09:25:07', NULL),
(10, 'Abdul malik', 'abdulmalikm.2984@gmail.com', '085899844765', '$2y$10$i52vjAoyJ/OL.L.Wiqvr2OV/jOWgul2uB5uKYjya1E.EyRZHnr2Pa', '171717', NULL, 'aktif', 'eURnChflGa94d15CAuNS8TgKmkx2ATjmiLW36XgUuJv5JYRDti7vNV7BIPQEw3VF', '1', '2021-01-15 11:32:41', '2021-01-15 11:34:29', NULL),
(11, 'Patulloh SE', 'alfathiezpatulloh@gmail.com', '081314659380', '$2y$10$0OoSTvCo7FrjxeMjuMnQueRZg2E1V2zfiP9yyTDKrf0z3mZGlpYzm', '130506', NULL, 'aktif', 'Q46aUL2DRXnByBJ1FIGQUHWkNqusxYYuKp9KVIVa0Eww2fd5X6cAJxvhShj78d7Z', '0', '2021-01-15 20:32:06', '2021-01-16 00:41:48', NULL),
(12, 'Indra', 'indradiani142@gmail.com', '081211236896', '$2y$10$EFefBaHKKL5uDl.cMHb8qeMc/9lfF2x5RaV4vCMdHuANs3ajgUaJm', '081176', NULL, 'aktif', 'i719c8Hpo3ZBXhYGxyuz6RpqgqDrX4iI30tDLEAQSmnutFb6sQbNZh2aIHTfPfy4', '1', '2021-01-15 20:56:15', '2021-01-15 20:56:43', NULL),
(13, 'Nana95', 'jaysnana95@gmail.com', '085694000092', '$2y$10$zk/W62TynMJRtO0lvLsCeeA2vjwk3GRZe4nSvcDDHr2rb0QX2irFG', '170583', NULL, 'aktif', NULL, '0', '2021-01-15 21:01:49', '2021-01-15 21:02:22', NULL);

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
(1, 1, '1.0000', '100.0000', '2021-01-13 10:04:55', '2021-01-15 07:00:05', NULL),
(2, 2, '10.0000', '100.0000', '2021-01-13 10:38:42', '2021-01-15 20:21:59', NULL),
(3, 3, '0.0000', '0.0000', '2021-01-14 16:20:24', '2021-01-14 16:20:24', NULL),
(4, 4, '0.0000', '0.0000', '2021-01-14 17:00:52', '2021-01-15 18:47:37', NULL),
(5, 5, '20.5000', '100.0000', '2021-01-14 18:16:32', '2021-01-15 07:00:05', NULL),
(6, 6, '10.5000', '100.0000', '2021-01-14 18:25:06', '2021-01-15 09:43:37', NULL),
(7, 7, '0.5000', '100.0000', '2021-01-14 18:42:44', '2021-01-15 07:00:05', NULL),
(8, 8, '20.0000', '0.0000', '2021-01-14 20:54:14', '2021-01-15 21:49:21', NULL),
(9, 9, '0.0000', '100.0000', '2021-01-15 09:24:53', '2021-01-15 09:43:37', NULL),
(10, 10, '0.0000', '0.0000', '2021-01-15 11:32:41', '2021-01-15 22:49:34', NULL),
(11, 11, '0.0000', '3300.0000', '2021-01-15 20:32:06', '2021-01-15 22:48:27', NULL),
(12, 12, '0.0000', '0.0000', '2021-01-15 20:56:15', '2021-01-15 20:56:15', NULL),
(13, 13, '0.0000', '0.0000', '2021-01-15 21:01:49', '2021-01-15 21:01:49', NULL),
(14, 14, '0.0000', '0.0000', '2021-01-15 22:01:14', '2021-01-15 22:01:14', NULL);

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
(2, 2, '6000.0000', 'tidak', '2021-01-13 10:38:42', '2021-01-15 07:00:05', NULL),
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
(14, 14, '0.0000', 'tidak', '2021-01-15 22:01:14', '2021-01-15 22:01:14', NULL);

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
(8, 11, '8720535581', 53, 'Patulloh SE', '2021-01-15 22:17:21', '2021-01-15 22:17:21', NULL);

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
(4, 8, 7, NULL, 'BSW8.1501211', NULL, '20.0000', '200000.0000', 'pending', '2021-01-15 21:48:23', '2021-01-15 21:48:23', '2021-01-15 21:48:48');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bioner_stacking_logs`
--
ALTER TABLE `bioner_stacking_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `bioner_trade`
--
ALTER TABLE `bioner_trade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bioner_trade_logs`
--
ALTER TABLE `bioner_trade_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_email_signup`
--
ALTER TABLE `log_email_signup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `param_banks`
--
ALTER TABLE `param_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tb_test`
--
ALTER TABLE `tb_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_bioner_stacking`
--
ALTER TABLE `users_bioner_stacking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_bioner_trade`
--
ALTER TABLE `users_bioner_trade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_banks`
--
ALTER TABLE `user_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_bioner_stacking_withdraw`
--
ALTER TABLE `user_bioner_stacking_withdraw`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
