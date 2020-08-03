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

 Date: 17/10/2019 22:05:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `IDBV` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDND` bigint(20) UNSIGNED NOT NULL,
  `Content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `CLike` int(255) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`IDBV`, `IDND`) USING BTREE,
  INDEX `IDND`(`IDND`) USING BTREE,
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`IDND`) REFERENCES `account` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc0.jpeg', 2, '2019-10-08 22:25:48', '2019-10-13 15:25:42');
INSERT INTO `news` VALUES (2, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc1.jpeg', 2, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (3, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc2.jpeg', 8, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (4, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc3.jpeg', 7, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (5, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc4.jpeg', 5, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (6, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc5.jpeg', 112, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (7, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc6.jpeg', 35, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (8, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc7.jpeg', 8, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (9, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc8.jpeg', 45, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (10, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc9.jpeg', 78, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (11, 3, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc10.jpeg', 99, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (12, 3, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc11.jpeg', 27, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (13, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc12.jpeg', 46, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (14, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc13.jpeg', 58, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (15, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc14.jpeg', 92, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (16, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc15.jpeg', 34, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (17, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc16.jpeg', 3, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (18, 3, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc17.jpeg', 8, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (19, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc18.jpeg', 25, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (20, 3, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc19.jpeg', 77, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (21, 3, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc20.jpeg', 66, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (22, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc21.jpeg', 125, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (23, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc22.jpeg', 94, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (24, 3, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc23.jpeg', 78, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (25, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc24.jpeg', 94, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (26, 3, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc25.jpeg', 20, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (27, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc26.jpeg', 45, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (28, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc27.jpeg', 58, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (29, 2, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc28.jpeg', 59, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (30, 3, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc29.jpeg', 61, '2019-10-08 22:25:48', '2019-10-08 22:25:48');
INSERT INTO `news` VALUES (31, 1, 'xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga', '/FLRV-CH/local/public/assets/img/newi/abc30.jpeg', 77, '2019-10-08 22:25:48', '2019-10-08 22:25:48');

SET FOREIGN_KEY_CHECKS = 1;
