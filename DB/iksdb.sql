/*
 Navicat Premium Data Transfer

 Source Server         : Laragon MySql
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : iksdb

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 18/11/2020 14:52:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int(191) NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` enum('master_admin','marketing') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `cookies` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remember` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'Adam PM', 'adam.pm77@gmail.com', '$2y$10$KtHGXdMg4m4H23pzBi6D9OQMTB1m43Rg0BPEGdSAADlr1NhsTdIiq', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, '6ZCplDKmrxGhIYjsW80JPOJ3D8g13BSRQiLubk4noRjhayatT1ZCMu9vgv2LXc5Q', '1');
INSERT INTO `admins` VALUES (2, 'M. Nunu', 'nunu@gmail.com', '$2y$10$KtHGXdMg4m4H23pzBi6D9OQMTB1m43Rg0BPEGdSAADlr1NhsTdIiq', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, NULL, '0');
INSERT INTO `admins` VALUES (3, 'Nasrul', 'nasrul@gmail.com', '$2y$10$KtHGXdMg4m4H23pzBi6D9OQMTB1m43Rg0BPEGdSAADlr1NhsTdIiq', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, NULL, '0');
INSERT INTO `admins` VALUES (4, 'Nana', 'nana@gmail.com', '$2y$10$KtHGXdMg4m4H23pzBi6D9OQMTB1m43Rg0BPEGdSAADlr1NhsTdIiq', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, NULL, '0');
INSERT INTO `admins` VALUES (5, 'Yudi', 'yudi@gmail.com', '$2y$10$KtHGXdMg4m4H23pzBi6D9OQMTB1m43Rg0BPEGdSAADlr1NhsTdIiq', 'marketing', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, NULL, '0');
INSERT INTO `admins` VALUES (6, 'Fira', 'fira@gmail.com', '$2y$10$KtHGXdMg4m4H23pzBi6D9OQMTB1m43Rg0BPEGdSAADlr1NhsTdIiq', 'marketing', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, NULL, '0');

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_vendor` int(11) NULL DEFAULT NULL,
  `id_jenis_barang` int(11) NULL DEFAULT NULL,
  `spesifikasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hpp` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES (1, 'Iphone 12', 1, 1, 1, 'Spesifikasi Iphone 12', 12000000, '2020-11-08 01:53:04', 1, '2020-11-08 01:53:04', 1, NULL, NULL);
INSERT INTO `barang` VALUES (2, 'Iphone 12 Mini', 1, 1, 1, 'Spesifikasi Iphone 12 Mini', 11000000, '2020-11-08 02:23:08', 1, '2020-11-08 02:54:03', 1, NULL, NULL);

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_ktp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alias` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `hubungan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penjamin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp_penjamin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sumber_pendapatan` enum('gaji_tetap','honor','bonus','hasil_usaha','hasil_alam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `penghasilan_perbulan` int(11) NULL DEFAULT NULL,
  `foto_ktp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, '123456789', 'Nurul AL', NULL, '1992-11-05', 'Jl. Raya A no. 1 Rt.1 Rw. 2 Bogor', '08123456789', 'nurul@gmail.com', 1, 'Teman', 'Adam PM', '08123456789', 'gaji_tetap', 11000000, NULL, 1, '2020-10-15 23:05:48', 1, '2020-11-17 04:48:18', NULL, NULL);
INSERT INTO `customers` VALUES (2, '123456789', 'Inara AL', NULL, '2017-05-16', 'Jl. Raya A no. 2 Rt.1 Rw. 2 Bogor', '08123456789', 'inara@gmail.com', 2, 'Teman', 'Adam PM', '08123456789', 'gaji_tetap', 20000000, NULL, 1, '2020-10-15 23:05:48', 1, '2020-11-14 00:22:51', NULL, NULL);
INSERT INTO `customers` VALUES (3, '123456789', 'Aghnia AS', NULL, '2019-09-06', 'Jl. Raya A no. 3 Rt.1 Rw. 2 Bogor', '08123456789', 'aghnia@gmail.com', 3, 'Teman', 'Adam PM', '08123456789', 'gaji_tetap', 30000000, NULL, 1, '2020-10-15 23:05:48', 1, '2020-10-15 23:05:48', NULL, NULL);

-- ----------------------------
-- Table structure for jenis_barang
-- ----------------------------
DROP TABLE IF EXISTS `jenis_barang`;
CREATE TABLE `jenis_barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vendor` int(11) NULL DEFAULT NULL,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_barang
-- ----------------------------
INSERT INTO `jenis_barang` VALUES (1, 1, 'Handphone', 1, '2020-10-22 02:15:17', 1, '2020-10-22 02:15:20', NULL, NULL);
INSERT INTO `jenis_barang` VALUES (2, 2, 'Handphone', 1, '2020-11-07 21:39:27', 1, '2020-11-07 21:39:27', NULL, NULL);
INSERT INTO `jenis_barang` VALUES (3, 3, 'Handphone', 1, '2020-11-07 21:39:46', 1, '2020-11-07 21:39:46', NULL, NULL);
INSERT INTO `jenis_barang` VALUES (4, 3, 'Watch123', 1, '2020-11-07 21:40:25', 1, '2020-11-07 21:40:25', 1, '2020-11-07 22:03:17');

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Elektronik', 1, '2020-10-22 01:08:04', 1, '2020-10-22 01:08:09', NULL, NULL);
INSERT INTO `kategori` VALUES (2, 'Furniture', 1, '2020-10-22 01:08:04', 1, '2020-10-22 01:08:09', NULL, NULL);

-- ----------------------------
-- Table structure for pekerjaans
-- ----------------------------
DROP TABLE IF EXISTS `pekerjaans`;
CREATE TABLE `pekerjaans`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pekerjaans
-- ----------------------------
INSERT INTO `pekerjaans` VALUES (1, 'Karyawan', NULL, NULL);
INSERT INTO `pekerjaans` VALUES (2, 'Wiraswasta', NULL, NULL);
INSERT INTO `pekerjaans` VALUES (3, 'Buruh', NULL, NULL);
INSERT INTO `pekerjaans` VALUES (4, 'Petani', NULL, NULL);
INSERT INTO `pekerjaans` VALUES (5, 'Pedagang', NULL, NULL);
INSERT INTO `pekerjaans` VALUES (6, 'Test1', 1, '2020-11-07 01:08:43');
INSERT INTO `pekerjaans` VALUES (7, 'Handphone', NULL, NULL);

-- ----------------------------
-- Table structure for pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE `pengajuan`  (
  `no_kredit` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_marketing` int(11) NULL DEFAULT NULL,
  `id_customer` int(11) NULL DEFAULT NULL,
  `alamat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_pekerjaan` int(11) NULL DEFAULT NULL,
  `hubungan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_penjamin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telp_penjamin` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_angsuran` int(11) NULL DEFAULT NULL,
  `terbayarkan` int(11) NULL DEFAULT NULL,
  `status` enum('pengajuan','belum lunas','lunas','tertunggak','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_pengajuan` date NULL DEFAULT NULL,
  `tanggal_aktif` date NULL DEFAULT NULL,
  `tanggal_jatuh_tempo` date NULL DEFAULT NULL,
  `angsuran_ke` int(1) NULL DEFAULT NULL,
  `tanggal_lunas` date NULL DEFAULT NULL,
  `tanggal_ditolak` date NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `id_aktif` int(11) NULL DEFAULT NULL,
  `id_tolak` int(11) NULL DEFAULT NULL,
  `alasan_tolak` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sequence` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`no_kredit`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuan
-- ----------------------------
INSERT INTO `pengajuan` VALUES ('112002', 5, 1, 'Jl. Raya A no. 1 Rt.1 Rw. 2 Bogor', '08123456789', 'nurul@gmail.com', 1, 'Teman', 'Adam PM', '08123456789', 15600000, 0, 'pengajuan', '2020-11-17', NULL, NULL, 0, NULL, NULL, '2020-11-17 04:48:18', 1, '2020-11-17 04:48:18', 1, NULL, NULL, NULL, NULL, NULL, 2);

-- ----------------------------
-- Table structure for pengajuan_barang
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan_barang`;
CREATE TABLE `pengajuan_barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_kredit` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_barang` int(11) NULL DEFAULT NULL,
  `id_jenis_barang` int(11) NULL DEFAULT NULL,
  `id_vendor` int(11) NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `nama_barang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `spesifikasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `hpp_pengajuan` int(11) NULL DEFAULT NULL,
  `hpp` int(11) NULL DEFAULT NULL,
  `potongan` int(11) NULL DEFAULT NULL,
  `uang_muka` int(11) NULL DEFAULT NULL,
  `tenor` enum('6','8','10') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pokok_pengajuan` int(11) NULL DEFAULT NULL,
  `pokok` int(11) NULL DEFAULT NULL,
  `margin_persen_pengajuan` int(2) NULL DEFAULT NULL,
  `margin_persen` int(2) NULL DEFAULT NULL,
  `margin_rp_pengajuan` int(11) NULL DEFAULT NULL,
  `margin_rp` int(11) NULL DEFAULT NULL,
  `harga_jual_pengajuan` int(11) NULL DEFAULT NULL,
  `harga_jual` int(11) NULL DEFAULT NULL,
  `angsuran_pengajuan` int(11) NULL DEFAULT NULL,
  `angsuran` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuan_barang
-- ----------------------------
INSERT INTO `pengajuan_barang` VALUES (2, '112002', 1, 1, 1, 1, 'Iphone 12', 'Spesifikasi Iphone 12', 12000000, 0, 0, 0, '8', 12000000, 0, 30, 0, 3600000, 0, 15600000, 0, 1950000, 0, '2020-11-17 04:48:18', 1, '2020-11-17 04:48:18', 1, NULL, NULL);

-- ----------------------------
-- Table structure for vendor
-- ----------------------------
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vendor
-- ----------------------------
INSERT INTO `vendor` VALUES (1, 1, 'Apple', 1, '2020-10-22 01:06:26', 1, '2020-10-22 01:06:30', NULL, NULL);
INSERT INTO `vendor` VALUES (2, 1, 'OPPO', 1, '2020-10-22 02:38:21', 1, '2020-10-22 02:38:24', NULL, NULL);
INSERT INTO `vendor` VALUES (3, 1, 'Xiaomi', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `vendor` VALUES (4, 1, 'Test', NULL, NULL, NULL, NULL, 1, '2020-10-25 20:36:42');

SET FOREIGN_KEY_CHECKS = 1;
