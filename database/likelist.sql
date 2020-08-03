/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : testlar

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 17/10/2019 22:05:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for likelist
-- ----------------------------
DROP TABLE IF EXISTS `likelist`;
CREATE TABLE `likelist`  (
  `IDBV` int(255) NULL DEFAULT NULL,
  `IDNL` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_vietnamese_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
