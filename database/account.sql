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

 Date: 17/10/2019 22:03:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account`  (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `SDT` int(11) NULL DEFAULT NULL,
  `Dob` date NULL DEFAULT NULL,
  `Avt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES (1, 'nhavbnm', '$2y$10$07eZWrnrEVADnwJ2sMsPI.gZawkzdrmmpzw0yiD2fo70Op.PBbkbW', 'Nguyen Hai Nhan', 339898292, '2000-06-03', '.', '2019-09-30 10:12:09', '2019-10-05 16:37:23', NULL);
INSERT INTO `account` VALUES (2, 'abc', '$2y$10$UYrsRo8vGkpPbbSvzhPMa.Uke5Pjzh8dENkqiTrNXMF549T2g7W5u', 'nhan2', 339898292, '2000-06-03', NULL, '2019-10-04 17:49:06', '2019-10-05 16:21:32', NULL);
INSERT INTO `account` VALUES (3, 'abc2', '$2y$10$h44RcVzWFj38bdvbfKg16eGT4gtOc1OLYYmkXSV1P8mrx1xgzPHA6', 'nhan2', 339898292, '2000-06-03', NULL, '2019-10-04 17:49:36', '2019-10-04 17:49:36', NULL);

SET FOREIGN_KEY_CHECKS = 1;
