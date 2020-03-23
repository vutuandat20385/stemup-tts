/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50621
 Source Host           : localhost:3306
 Source Schema         : quiz

 Target Server Type    : MySQL
 Target Server Version : 50621
 File Encoding         : 65001

 Date: 27/06/2019 09:30:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for savsoft_category_news
-- ----------------------------
DROP TABLE IF EXISTS `savsoft_category_news`;
CREATE TABLE `savsoft_category_news`  (
  `id` int(2) NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `category_url_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of savsoft_category_news
-- ----------------------------
INSERT INTO `savsoft_category_news` VALUES (0, 'Tin thời sự', 'tin-thoi-su');
INSERT INTO `savsoft_category_news` VALUES (2, 'Tin Stemup', 'tin-stemup');
INSERT INTO `savsoft_category_news` VALUES (3, 'Tin sự kiện', 'tin-su-kien');
INSERT INTO `savsoft_category_news` VALUES (4, 'Hướng dẫn', 'huong-dan');

SET FOREIGN_KEY_CHECKS = 1;
