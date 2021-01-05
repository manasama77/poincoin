/*
 Navicat Premium Data Transfer

 Source Server         : mysql local
 Source Server Type    : MySQL
 Source Server Version : 100416
 Source Host           : localhost:3306
 Source Schema         : bionerappdb

 Target Server Type    : MySQL
 Target Server Version : 100416
 File Encoding         : 65001

 Date: 05/01/2021 21:52:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` enum('master_admin','marketing') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `cookies` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remember` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'master', 'admin', '$2y$10$p.QWC7tMC7xxhS2.tWwMH.ajI8Shd.9VinnL6i3C43.TYddog03Wi', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, 'EwmkR5XUqjReWHYiKfj21rMTN6iB3bvzqcrTOv4bxDZNSYoCxGgDp9QPW8IKFLpg', '0');

-- ----------------------------
-- Table structure for bioner_stacking
-- ----------------------------
DROP TABLE IF EXISTS `bioner_stacking`;
CREATE TABLE `bioner_stacking`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'ID_USER.DDMMYY.##',
  `id_user` int NULL DEFAULT NULL,
  `total_investment` decimal(15, 2) NULL DEFAULT NULL,
  `total_transfer` decimal(15, 2) NULL DEFAULT NULL,
  `profit_perhari_b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `profit_perhari_rp` decimal(15, 2) NULL DEFAULT NULL,
  `status` enum('aktif','menunggu_transfer','menunggu_verifikasi','tidak_aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bukti_transfer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bioner_stacking
-- ----------------------------
INSERT INTO `bioner_stacking` VALUES (1, '1.0501211', 1, 100.00, 1600000.00, '0.5', 5000.00, 'aktif', NULL, '2021-01-05 20:00:22', '2021-01-05 20:02:42', NULL);

-- ----------------------------
-- Table structure for bioner_stacking_logs
-- ----------------------------
DROP TABLE IF EXISTS `bioner_stacking_logs`;
CREATE TABLE `bioner_stacking_logs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `id_bioner_stacking` int NULL DEFAULT NULL,
  `type` enum('investment','profit','withdraw','bonus','delete investment','return withdraw') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nominal_b` decimal(15, 2) NULL DEFAULT NULL,
  `nominal_rp` decimal(15, 2) NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'kode withdraw / kode investment',
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bioner_stacking_logs
-- ----------------------------
INSERT INTO `bioner_stacking_logs` VALUES (1, 1, 1, 'investment', 100.00, 1000000.00, '1.0501211', 'Investment sebesar 100.00 Bioner', '2021-01-05 20:00:47');
INSERT INTO `bioner_stacking_logs` VALUES (2, 1, 1, 'profit', 0.50, 5000.00, '1.0501211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-05 20:01:43');
INSERT INTO `bioner_stacking_logs` VALUES (3, 1, 1, 'profit', 0.50, 5000.00, '1.0501211', 'Distribusi Profit Sebesar 0.5 Bioner', '2021-01-05 20:02:42');
INSERT INTO `bioner_stacking_logs` VALUES (4, 1, NULL, 'withdraw', 0.50, 5000.00, 'W1.0501211', 'Withdraw sebesar 0.5 Bioner', '2021-01-05 21:33:26');
INSERT INTO `bioner_stacking_logs` VALUES (5, 1, NULL, 'withdraw', 0.50, 5000.00, 'W1.0501212', 'Withdraw sebesar 0.5 Bioner', '2021-01-05 21:33:38');
INSERT INTO `bioner_stacking_logs` VALUES (6, 1, NULL, 'return withdraw', 0.50, 5000.00, 'W1.0501212', 'Return Withdraw sebesar 0.50 Bioner to Profit - By Admin', '2021-01-05 21:35:32');
INSERT INTO `bioner_stacking_logs` VALUES (7, 1, NULL, 'return withdraw', 0.50, 5000.00, 'W1.0501211', 'Return Withdraw sebesar 0.50 Bioner to Profit - By Admin', '2021-01-05 21:35:40');
INSERT INTO `bioner_stacking_logs` VALUES (8, 1, NULL, 'withdraw', 0.50, 5000.00, 'W1.0501213', 'Withdraw sebesar 0.5 Bioner', '2021-01-05 21:36:30');
INSERT INTO `bioner_stacking_logs` VALUES (9, 1, NULL, 'withdraw', 0.50, 5000.00, 'W1.0501214', 'Withdraw sebesar 0.5 Bioner', '2021-01-05 21:36:39');

-- ----------------------------
-- Table structure for param_banks
-- ----------------------------
DROP TABLE IF EXISTS `param_banks`;
CREATE TABLE `param_banks`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of param_banks
-- ----------------------------
INSERT INTO `param_banks` VALUES (1, 'Bank Jabar', '110');
INSERT INTO `param_banks` VALUES (2, 'Bank DKI', '111');
INSERT INTO `param_banks` VALUES (3, 'Bank BPD DIY', '112');
INSERT INTO `param_banks` VALUES (4, 'Bank Jateng', '113');
INSERT INTO `param_banks` VALUES (5, 'Bank Jatim', '114');
INSERT INTO `param_banks` VALUES (6, 'Bank BPD Jambi', '115');
INSERT INTO `param_banks` VALUES (7, 'Bank BPD Aceh', '116');
INSERT INTO `param_banks` VALUES (8, 'Bank Sumut', '117');
INSERT INTO `param_banks` VALUES (9, 'Bank Nagari', '118');
INSERT INTO `param_banks` VALUES (10, 'Bank Riau', '119');
INSERT INTO `param_banks` VALUES (11, 'Bank Sumsel', '120');
INSERT INTO `param_banks` VALUES (12, 'Bank Lampung', '121');
INSERT INTO `param_banks` VALUES (13, 'Bank Kalsel', '122');
INSERT INTO `param_banks` VALUES (14, 'Bank BPD Kaltim', '124');
INSERT INTO `param_banks` VALUES (15, 'Bank BPD Kalteng', '125');
INSERT INTO `param_banks` VALUES (16, 'Bank Sulsel', '126');
INSERT INTO `param_banks` VALUES (17, 'Bank Sulut', '127');
INSERT INTO `param_banks` VALUES (18, 'Bank BPD NTB', '128');
INSERT INTO `param_banks` VALUES (19, 'Bank BPD Bali', '129');
INSERT INTO `param_banks` VALUES (20, 'Bank NTT', '130');
INSERT INTO `param_banks` VALUES (21, 'Bank Maluku', '131');
INSERT INTO `param_banks` VALUES (22, 'Bank Papua', '132');
INSERT INTO `param_banks` VALUES (23, 'Bank Bengkulu', '133');
INSERT INTO `param_banks` VALUES (24, 'Bank Sultra', '135');
INSERT INTO `param_banks` VALUES (25, 'Bank Nusantara Parahyangan', '145');
INSERT INTO `param_banks` VALUES (26, 'Bank Swadesi', '146');
INSERT INTO `param_banks` VALUES (27, 'Bank Muamalat', '147');
INSERT INTO `param_banks` VALUES (28, 'Bank Mestika', '151');
INSERT INTO `param_banks` VALUES (29, 'Bank Maspion', '157');
INSERT INTO `param_banks` VALUES (30, 'Bank Ganesha', '161');
INSERT INTO `param_banks` VALUES (31, 'Bank Kesawan', '167');
INSERT INTO `param_banks` VALUES (32, 'Bank Saudara HS 1906', '212');
INSERT INTO `param_banks` VALUES (33, 'Bank Mega', '426');
INSERT INTO `param_banks` VALUES (34, 'Bank Jasa Jakarta', '427');
INSERT INTO `param_banks` VALUES (35, 'Bank Bukopin', '441');
INSERT INTO `param_banks` VALUES (36, 'Bank Syariah Mandiri', '451');
INSERT INTO `param_banks` VALUES (37, 'Bank Bumiputera', '485');
INSERT INTO `param_banks` VALUES (38, 'Bank Agroniaga', '494');
INSERT INTO `param_banks` VALUES (39, 'Bank Syariah Mega Indonesia', '506');
INSERT INTO `param_banks` VALUES (40, 'Bank Ina Perdana', '513');
INSERT INTO `param_banks` VALUES (41, 'Bank UIB', '536');
INSERT INTO `param_banks` VALUES (42, 'Bank Artos Indonesia', '542');
INSERT INTO `param_banks` VALUES (43, 'Bank Mayora', '553');
INSERT INTO `param_banks` VALUES (44, 'Bank Eksekutif', '558');
INSERT INTO `param_banks` VALUES (45, 'BPR KS', '558');
INSERT INTO `param_banks` VALUES (46, 'Bank Harda', '567');
INSERT INTO `param_banks` VALUES (47, 'Bank Commonwealth', '950');
INSERT INTO `param_banks` VALUES (48, 'Bank BRI', '002');
INSERT INTO `param_banks` VALUES (49, 'Bank Mandiri', '008');
INSERT INTO `param_banks` VALUES (50, 'Bank BNI', '009');
INSERT INTO `param_banks` VALUES (51, 'Bank Danamon', '011');
INSERT INTO `param_banks` VALUES (52, 'Bank Permata', '013');
INSERT INTO `param_banks` VALUES (53, 'Bank BCA', '014');
INSERT INTO `param_banks` VALUES (54, 'Bank BII', '016');
INSERT INTO `param_banks` VALUES (55, 'Bank Panin', '019');
INSERT INTO `param_banks` VALUES (56, 'Bank Arta Niaga Kencana', '020');
INSERT INTO `param_banks` VALUES (57, 'Bank Niaga', '022');
INSERT INTO `param_banks` VALUES (58, 'Bank UOB Buana', '023');
INSERT INTO `param_banks` VALUES (59, 'LippoBank', '026');
INSERT INTO `param_banks` VALUES (60, 'Bank NISP', '028');
INSERT INTO `param_banks` VALUES (61, 'Bank Artha Graha', '037');
INSERT INTO `param_banks` VALUES (62, 'Standard Chartered Bank', '050');
INSERT INTO `param_banks` VALUES (63, 'Bank ABN AMRO', '052');
INSERT INTO `param_banks` VALUES (64, 'Bank Bumi Arta', '076');
INSERT INTO `param_banks` VALUES (65, 'Bank Ekonomi', '087');
INSERT INTO `param_banks` VALUES (66, 'Bank Haga', '089');
INSERT INTO `param_banks` VALUES (67, 'Bank IFI', '093');
INSERT INTO `param_banks` VALUES (68, 'Bank Mayapada', '097');

-- ----------------------------
-- Table structure for user_banks
-- ----------------------------
DROP TABLE IF EXISTS `user_banks`;
CREATE TABLE `user_banks`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int UNSIGNED NULL DEFAULT NULL,
  `no_rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_bank` int UNSIGNED NULL DEFAULT NULL,
  `atas_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_banks
-- ----------------------------
INSERT INTO `user_banks` VALUES (1, 1, '123', 63, 'aa', '2021-01-05 19:47:12', '2021-01-05 19:47:12', NULL);

-- ----------------------------
-- Table structure for user_bioner_stacking_withdraw
-- ----------------------------
DROP TABLE IF EXISTS `user_bioner_stacking_withdraw`;
CREATE TABLE `user_bioner_stacking_withdraw`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int UNSIGNED NULL DEFAULT NULL,
  `id_user_bank` int UNSIGNED NULL DEFAULT NULL,
  `id_user_wallet` int NULL DEFAULT NULL,
  `kode_withdraw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'W.ID_USER.DDMMYY.##',
  `withdraw_b` decimal(15, 2) UNSIGNED NULL DEFAULT NULL,
  `withdraw_rp` decimal(15, 2) UNSIGNED NULL DEFAULT NULL,
  `status` enum('pending','success','reject') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_bioner_stacking_withdraw
-- ----------------------------
INSERT INTO `user_bioner_stacking_withdraw` VALUES (1, 1, 1, 1, 'W1.0501211', 0.50, 5000.00, 'pending', '2021-01-05 21:33:26', '2021-01-05 21:33:26', '2021-01-05 21:35:40');
INSERT INTO `user_bioner_stacking_withdraw` VALUES (2, 1, NULL, NULL, 'W1.0501212', 0.50, 5000.00, 'pending', '2021-01-05 21:33:38', '2021-01-05 21:33:38', '2021-01-05 21:35:32');
INSERT INTO `user_bioner_stacking_withdraw` VALUES (3, 1, 1, NULL, 'W1.0501213', 0.50, 5000.00, 'success', '2021-01-05 21:36:30', '2021-01-05 21:47:20', NULL);
INSERT INTO `user_bioner_stacking_withdraw` VALUES (4, 1, NULL, 1, 'W1.0501214', 0.50, 5000.00, 'pending', '2021-01-05 21:36:39', '2021-01-05 21:36:39', NULL);

-- ----------------------------
-- Table structure for user_wallets
-- ----------------------------
DROP TABLE IF EXISTS `user_wallets`;
CREATE TABLE `user_wallets`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int UNSIGNED NULL DEFAULT NULL,
  `no_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_wallets
-- ----------------------------
INSERT INTO `user_wallets` VALUES (1, 1, '12345', '2021-01-05 19:49:31', '2021-01-05 20:00:11', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_referal` int NULL DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cookies` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remember` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'adam', 'adam.pm77@gmail.com', 'adam', '$2y$10$DceRNzrpuYxJJIbi7Njvie7zRTW/PjBYhnyTQo38.aOHl6giPa7aC', NULL, 'aktif', NULL, '0', '2021-01-05 19:19:34', '2021-01-05 20:02:42', NULL);

-- ----------------------------
-- Table structure for users_bioner_stacking
-- ----------------------------
DROP TABLE IF EXISTS `users_bioner_stacking`;
CREATE TABLE `users_bioner_stacking`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `profit` decimal(15, 2) UNSIGNED NULL DEFAULT NULL,
  `total_investment` decimal(15, 2) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users_bioner_stacking
-- ----------------------------
INSERT INTO `users_bioner_stacking` VALUES (1, 1, 0.00, 100.00, '2021-01-05 19:19:34', '2021-01-05 21:36:39', NULL);

SET FOREIGN_KEY_CHECKS = 1;
