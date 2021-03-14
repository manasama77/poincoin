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

 Date: 20/02/2021 20:04:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for log_email_trade
-- ----------------------------
DROP TABLE IF EXISTS `log_email_trade`;
CREATE TABLE `log_email_trade`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int UNSIGNED NULL DEFAULT NULL,
  `log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
