-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2021 at 04:53 PM
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
(1, 'master', 'admin', '$2y$10$63wfXBI8UMXeUs6uQtscoOzgbjtwOFAhZMG2G.GqTQA5WiWrW2IuO', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, '3u6l8ypqgQHmJKWSAiZg0ksPVi19y7hoDq2BmHXFVNTF93eoracP4Ln5b4XYJ5Ww', '0');

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
(1, 'BS1.1101211', 1, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_verifikasi', '2021-01-11_04_32_25.jpg', '2021-01-11 04:03:44', '2021-01-11 04:32:25', '2021-01-11 08:56:06'),
(2, 'BS3.1101211', 3, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-11 08:39:17', '2021-01-11 08:48:45', '2021-01-11 08:56:13'),
(3, 'BS1.1101212', 1, '100.0000', '1600000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-11 09:04:44', '2021-01-11 09:04:44', '2021-01-11 13:28:56'),
(4, 'BS1.1101213', 1, '100.0000', '1500000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-11 09:08:38', '2021-01-11 09:08:38', '2021-01-11 13:29:04'),
(5, 'BS4.1101211', 4, '100.0000', '1600000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-11 10:20:42', '2021-01-12 08:40:07', NULL),
(6, 'BS4.1101212', 4, '100.0000', '1500000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-11 16:51:32', '2021-01-12 08:40:07', NULL),
(7, 'BS4.1201211', 4, '100.0000', '1500000.0000', '0.5', '5000.0000', 'aktif', NULL, '2021-01-12 11:34:40', '2021-01-12 16:06:07', NULL),
(8, 'BS4.1201212', 4, '100.0000', '1500000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-12 17:16:53', '2021-01-12 17:16:53', '2021-01-12 20:17:48'),
(9, 'BS4.1201213', 4, '100.0000', '1500000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-12 17:57:45', '2021-01-12 17:57:45', '2021-01-12 20:17:55'),
(10, 'BS4.1201214', 4, '100.0000', '1500000.0000', '0.5', '5000.0000', 'menunggu_transfer', NULL, '2021-01-12 19:53:41', '2021-01-12 19:53:41', '2021-01-12 20:18:02');

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
(1, 3, 2, 'investment', '100.0000', '1000000.0000', 'BS3.1101211', 'Investment sebesar 100.0000 Bioner', '2021-01-11 08:48:45'),
(2, 1, 1, 'delete investment', '100.0000', '1000000.0000', 'BS1.1101211', 'Investment Dibatalkan', '2021-01-11 08:56:06'),
(3, 3, 2, 'delete investment', '100.0000', '1000000.0000', 'BS3.1101211', 'Investment Dibatalkan', '2021-01-11 08:56:13'),
(4, 4, 5, 'investment', '100.0000', '1000000.0000', 'BS4.1101211', 'Investment sebesar 100.0000 Bioner', '2021-01-11 10:27:05'),
(5, 1, 3, 'delete investment', '100.0000', '1000000.0000', 'BS1.1101212', 'Investment Dibatalkan', '2021-01-11 13:28:56'),
(6, 1, 4, 'delete investment', '100.0000', '1000000.0000', 'BS1.1101213', 'Investment Dibatalkan', '2021-01-11 13:29:04'),
(7, 4, 6, 'investment', '100.0000', '1000000.0000', 'BS4.1101212', 'Investment sebesar 100.0000 Bioner', '2021-01-11 23:29:35'),
(8, 4, 5, 'profit', '0.5000', '5000.0000', 'BS4.1101211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-12 08:40:07'),
(9, 4, 6, 'profit', '0.5000', '5000.0000', 'BS4.1101212', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-12 08:40:07'),
(10, 4, 7, 'investment', '100.0000', '1000000.0000', 'BS4.1201211', 'Investment sebesar 100.0000 Bioner', '2021-01-12 16:06:07'),
(11, 4, NULL, 'withdraw', '1.0000', '10000.0000', 'BSW4.1201211', 'Withdraw sebesar 1 Bioner', '2021-01-12 16:45:14'),
(12, 4, NULL, 'return withdraw', '1.0000', '10000.0000', 'BSW4.1201211', 'Return Withdraw sebesar 1.0000 Bioner to Profit', '2021-01-12 16:46:03'),
(13, 4, 8, 'delete investment', '100.0000', '1000000.0000', 'BS4.1201212', 'Investment Dibatalkan', '2021-01-12 20:17:48'),
(14, 4, 9, 'delete investment', '100.0000', '1000000.0000', 'BS4.1201213', 'Investment Dibatalkan', '2021-01-12 20:17:55'),
(15, 4, 10, 'delete investment', '100.0000', '1000000.0000', 'BS4.1201214', 'Investment Dibatalkan', '2021-01-12 20:18:02');

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
(1, 1, '<pre>\n\n</pre>', '2021-01-11 04:03:16'),
(2, 1, '<pre>\n\n</pre>', '2021-01-11 04:39:50'),
(3, 1, '<pre>\n\n</pre>', '2021-01-11 04:44:24'),
(4, 2, '<pre>\n\n</pre>', '2021-01-11 08:36:45'),
(5, 3, '<pre>\n\n</pre>', '2021-01-11 08:38:03'),
(6, 4, '<pre>\n\n</pre>', '2021-01-11 10:18:52'),
(7, 5, '<pre>\n\n</pre>', '2021-01-12 07:01:28'),
(8, 6, '<pre>\n\n</pre>', '2021-01-12 23:00:00'),
(9, 7, '<pre>\n\n</pre>', '2021-01-12 23:00:00');

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
(1, 'Adam PM', 'adam.pm777@gmail.com', '082114578976', '$2y$10$KjR/rApx0uPIr3eKoWnBWuSM705MMU8APYiqrFCPUHX4L7YD8E8me', '591990', NULL, 'aktif', 'a7hWIWaUlOt5igOJP9VVkzP7CRFdLoZycDE2NTnd4eNZHpQkxIsXg4hEYKu9r2Gv', '1', '2021-01-11 04:44:24', '2021-01-12 23:15:22', NULL),
(2, 'nurul', 'nurul.aulia.latifah@gmail.com', '082114578976', '$2y$10$iI41.PZ9xwdamxUdL32Uwe.qY0FsAJYUOUX.o39DbjNcg3rMJLqNO', '123456', NULL, 'aktif', NULL, NULL, '2021-01-11 08:36:45', '2021-01-11 08:36:45', NULL),
(3, 'Nurhasan', 'tebe.inside@gmail.com', '08128867789', '$2y$10$V02wPZeRafpKr7jv/D/kf.cgtgdIT.2iG49PFSDd0b8ORcqFCsPYW', '060606', NULL, 'aktif', 'o2FMABIUmAmaC9duif78SrUzjXTSM64w3qLC1s9DpZgeDJPab2cyy3Wf4OVlNJbc', '0', '2021-01-11 08:37:59', '2021-01-11 13:25:53', NULL),
(4, 'Abdul khaer', 'abdulkhaer321@gmail.com', '081219869989', '$2y$10$EHSxdY9mnK6tLa3SA43N3uEqyPf.L0hZ6n0kW5wbIr7L38n/ObcPu', '321598', NULL, 'aktif', '9xBLz2cWIyJ6RhO4NfpuPHTpoDAqNh51ZyEM4i3r0vQDUdR3fjb7xnmw5SB8wkYS', '1', '2021-01-11 10:18:52', '2021-01-12 22:03:10', NULL),
(5, 'Syaiful Bahri', 'ipung979@gmail.com', '081288518042', '$2y$10$i9nwOmohFyKXszs47PrFs.Obd8i8/EShxlbXq6MNcoGszPZ35ihY6', '202079', NULL, 'aktif', 'CTQN0DE2d79iIUKSGwZC6L7DfmikWkZq0HVRYKo8SJuX1zBqX6GEAzO34jclF5hJ', '0', '2021-01-12 07:01:27', '2021-01-12 07:21:30', NULL),
(6, 'Adam', 'adam.pm7777@gmail.com', '082114578976', '$2y$10$KSLcWrpZi4h5UIM9hFBsAuAQX37.YRKtjUqDux6IycAIY/CQ2yJyS', '123456', NULL, 'aktif', NULL, NULL, '2021-01-12 23:20:08', '2021-01-12 23:20:08', NULL),
(7, 'Adam', 'adam.pm77@gmail.com', '082114578976', '$2y$10$gE1Nq0hjAhX1I/vuJL9WE.aI/wmkeBRJgxrjsCavhjvlryzWoXd2K', '123456', NULL, 'aktif', 'aBxbNx46IZLVEcr0eAKssmvOJonJOiuGtPjv2PeAgZhRw0QXfETW1TDF4w28qqgN', '1', '2021-01-12 23:42:30', '2021-01-12 23:47:19', NULL);

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
(1, 1, '300.0000', '0.0000', '2021-01-11 04:03:15', '2021-01-11 13:29:04', NULL),
(4, 2, '0.0000', '0.0000', '2021-01-11 08:36:45', '2021-01-11 08:36:45', NULL),
(5, 3, '100.0000', '0.0000', '2021-01-11 08:37:59', '2021-01-11 08:56:13', NULL),
(6, 4, '1.0000', '0.0000', '2021-01-11 10:18:52', '2021-01-12 20:18:02', NULL),
(7, 5, '0.0000', '0.0000', '2021-01-12 07:01:27', '2021-01-12 07:01:27', NULL),
(8, 6, '0.0000', '0.0000', '2021-01-12 23:20:08', '2021-01-12 23:20:08', NULL),
(9, 7, '0.0000', '0.0000', '2021-01-12 23:42:30', '2021-01-12 23:42:30', NULL);

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
(1, 1, '0.0000', 'tidak', '2021-01-11 04:03:15', '2021-01-11 04:03:15', NULL),
(2, 1, '0.0000', 'tidak', '2021-01-11 04:39:50', '2021-01-11 04:39:50', NULL),
(3, 1, '0.0000', 'tidak', '2021-01-11 04:44:24', '2021-01-11 04:44:24', NULL),
(4, 2, '0.0000', 'tidak', '2021-01-11 08:36:45', '2021-01-11 08:36:45', NULL),
(5, 3, '0.0000', 'tidak', '2021-01-11 08:37:59', '2021-01-11 08:37:59', NULL),
(6, 4, '0.0000', 'tidak', '2021-01-11 10:18:52', '2021-01-11 10:18:52', NULL),
(7, 5, '0.0000', 'tidak', '2021-01-12 07:01:27', '2021-01-12 07:01:27', NULL),
(8, 6, '0.0000', 'tidak', '2021-01-12 23:20:08', '2021-01-12 23:20:08', NULL),
(9, 7, '0.0000', 'tidak', '2021-01-12 23:42:30', '2021-01-12 23:42:30', NULL);

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
(1, 5, '0953961315', 53, 'SYAIFUL BAHRI', '2021-01-12 07:17:42', '2021-01-12 07:17:42', NULL),
(2, 4, '8720231248', 53, 'Abdul khaer', '2021-01-12 16:43:43', '2021-01-12 16:43:43', NULL);

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
(1, 4, 2, NULL, 'BSW4.1201211', NULL, '1.0000', '10000.0000', 'pending', '2021-01-12 16:45:14', '2021-01-12 16:45:14', '2021-01-12 16:46:03');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bioner_stacking_logs`
--
ALTER TABLE `bioner_stacking_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bioner_trade`
--
ALTER TABLE `bioner_trade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bioner_trade_logs`
--
ALTER TABLE `bioner_trade_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_email_signup`
--
ALTER TABLE `log_email_signup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `param_banks`
--
ALTER TABLE `param_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_bioner_stacking`
--
ALTER TABLE `users_bioner_stacking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_bioner_trade`
--
ALTER TABLE `users_bioner_trade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_banks`
--
ALTER TABLE `user_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_bioner_stacking_withdraw`
--
ALTER TABLE `user_bioner_stacking_withdraw`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
