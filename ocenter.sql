/*
 Navicat Premium Data Transfer

 Source Server         : 本地环境
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : 127.0.0.1:3306
 Source Schema         : ocenter

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 17/12/2018 18:03:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for oc_article
-- ----------------------------
DROP TABLE IF EXISTS `oc_article`;
CREATE TABLE `oc_article`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `cid` smallint(5) UNSIGNED NOT NULL COMMENT '分类ID',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `introduction` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '简介',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '内容',
  `author` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '作者',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态 0 待审核  1 审核',
  `reading` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '阅读量',
  `thumb` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '缩略图',
  `photo` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '图集',
  `is_top` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否置顶  0 不置顶  1 置顶',
  `is_recommend` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否推荐  0 不推荐  1 推荐',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `publish_time` int(11) NOT NULL COMMENT '发布时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `type` enum('1','2','3') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '展示方式 1,2,3',
  `update_time` int(11) DEFAULT NULL COMMENT '跟新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '文章表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_article_category
-- ----------------------------
DROP TABLE IF EXISTS `oc_article_category`;
CREATE TABLE `oc_article_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `alias` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '导航别名',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '分类内容',
  `thumb` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '缩略图集',
  `icon` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '分类图标',
  `list_template` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '分类列表模板',
  `detail_template` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '分类详情模板',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '分类类型  1  列表  2 单页',
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类ID',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '路径',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '分类表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_article_category
-- ----------------------------
INSERT INTO `oc_article_category` VALUES (26, '关注', '', NULL, '', '', '', '', 1, 999, 0, '', 0);
INSERT INTO `oc_article_category` VALUES (28, '推荐', '', NULL, 'a:3:{i:0;s:45:\"/uploads/images/20181217/1545020714108362.jpg\";i:1;s:45:\"/uploads/images/20181217/1545019250898202.jpg\";i:2;s:45:\"/uploads/images/20181217/1545019218169717.jpg\";}', '', '', '', 1, 998, 0, '0,', 0);
INSERT INTO `oc_article_category` VALUES (29, '热点', '', NULL, '', '', '', '', 1, 997, 0, '', 0);
INSERT INTO `oc_article_category` VALUES (30, '体育', '', NULL, '', '', '', '', 1, 996, 0, '', 0);
INSERT INTO `oc_article_category` VALUES (31, '美女', '', NULL, '', '', '', '', 1, 995, 0, '', 0);
INSERT INTO `oc_article_category` VALUES (32, '掘金', '', NULL, '', '', '', '', 1, 994, 0, '', 0);

SET FOREIGN_KEY_CHECKS = 1;
