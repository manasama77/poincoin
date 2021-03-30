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

 Date: 31/03/2021 01:17:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ratio
-- ----------------------------
DROP TABLE IF EXISTS `ratio`;
CREATE TABLE `ratio`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `trx` smallint NULL DEFAULT NULL,
  `bnr` smallint NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
