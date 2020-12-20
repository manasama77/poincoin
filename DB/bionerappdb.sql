/*
 Navicat Premium Data Transfer

 Source Server         : MariaDB
 Source Server Type    : MariaDB
 Source Server Version : 100325
 Source Host           : localhost:3306
 Source Schema         : bionerappdb

 Target Server Type    : MariaDB
 Target Server Version : 100325
 File Encoding         : 65001

 Date: 21/12/2020 00:33:50
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
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
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
INSERT INTO `admins` VALUES (1, 'master', 'manasama', '$2y$10$KtHGXdMg4m4H23pzBi6D9OQMTB1m43Rg0BPEGdSAADlr1NhsTdIiq', 'master_admin', '2020-10-15 23:05:48', '2020-10-15 23:05:48', NULL, '6ZCplDKmrxGhIYjsW80JPOJ3D8g13BSRQiLubk4noRjhayatT1ZCMu9vgv2LXc5Q', '0');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_referal` int(11) NULL DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cash_balance` decimal(15, 2) NULL DEFAULT NULL,
  `profit_balance` decimal(15, 2) NULL DEFAULT NULL,
  `bonus_balance` decimal(15, 2) NULL DEFAULT NULL,
  `total_investment` decimal(15, 2) NULL DEFAULT NULL,
  `cookies` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remember` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'adam', 'adam.pm77@gmail.com', 'adam', '$2y$10$rNH1n8oj8MA7KUcPUFPHxOQsw4Ltlo.SDWYLQSn5tSTY3YYb4fzim', NULL, 'aktif', 0.00, 0.00, 0.00, 0.00, NULL, '0', '2020-12-19 21:44:40', '2020-12-21 00:33:31', NULL);
INSERT INTO `users` VALUES (3, 'joe', 'joe@gmail.com', 'joe', '$2y$10$VQRRRenzKpIJPRPZdjPSIuBn9xFKB93GZK2ftVQpA6lWO67vw3tG2', 1, 'aktif', 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2020-12-20 19:32:25', '2020-12-20 19:32:25', NULL);

SET FOREIGN_KEY_CHECKS = 1;
