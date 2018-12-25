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

 Date: 22/12/2018 11:12:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for oc_admin
-- ----------------------------
DROP TABLE IF EXISTS `oc_admin`;
CREATE TABLE `oc_admin`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_id` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '管理员权限组id，多个用,分隔',
  `current_group` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '当前分组',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户手机',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `last_login_ip` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录IP',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_admin
-- ----------------------------
INSERT INTO `oc_admin` VALUES (1, '1', 1, 'admin', 'd6ed47988e380b96982211580b9b28d5', 'admin@admin.com', '15201222936', 1545192348, 2130706433, 1544060605, 1);

-- ----------------------------
-- Table structure for oc_admin_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `oc_admin_auth_group`;
CREATE TABLE `oc_admin_auth_group`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父组别',
  `module` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限组所属模块',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '组类型',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限组中文名称',
  `description` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '权限组状态：为1正常，为0禁用,-1为删除',
  `rules` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限组拥有的规则id，多个规则 , 隔开',
  `end_time` int(11) UNSIGNED NOT NULL DEFAULT 2000000000 COMMENT '有效期',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员权限组表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_admin_auth_group
-- ----------------------------
INSERT INTO `oc_admin_auth_group` VALUES (1, 0, 'admin', 1, '超级管理员', '至高无上', 1, '12,13,14,1,2,3,4,5,6,7,8,9,10,11,15,16,17,18,19,20,21,22,23,37,24,25,26,27,28,29,30,31,34,32,33,35,36,38', 1999958400, 1544060605, 1545192694);
INSERT INTO `oc_admin_auth_group` VALUES (2, 1, 'admin', 1, '管理员', '一人之下，万人之上', 1, '', 2000000000, 1544060605, 1544060605);

-- ----------------------------
-- Table structure for oc_admin_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `oc_admin_auth_rule`;
CREATE TABLE `oc_admin_auth_rule`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父ID',
  `module` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '规则所属module',
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文标题',
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图标',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `condition` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `is_menu` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否菜单 0-不是 1-是',
  `is_show` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否显示 0-不是 1-是',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 100 COMMENT '排序，默认升序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE,
  INDEX `remark`(`remark`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_admin_auth_rule
-- ----------------------------
INSERT INTO `oc_admin_auth_rule` VALUES (1, 0, 'admin', 'admin/admin', '管理员管理', '', '', 1, '', 1, 1, 0, 1544150559, 100);
INSERT INTO `oc_admin_auth_rule` VALUES (2, 1, 'admin', 'admin/admin/adminList', '管理员列表', '', '', 1, '', 1, 1, 0, 0, 101);
INSERT INTO `oc_admin_auth_rule` VALUES (3, 2, 'admin', 'admin/admin/deladmin', '删除管理员', '', '', 1, '', 0, 0, 0, 0, 102);
INSERT INTO `oc_admin_auth_rule` VALUES (4, 2, 'admin', 'admin/admin/adminform', '管理员表单', '', '', 1, '', 0, 0, 0, 0, 103);
INSERT INTO `oc_admin_auth_rule` VALUES (5, 1, 'admin', 'admin/admin/adminauthlist', '管理权限', '', '', 1, '', 1, 1, 0, 0, 111);
INSERT INTO `oc_admin_auth_rule` VALUES (6, 5, 'admin', 'admin/admin/deladminauth', '删除管理权限', '', '', 1, '', 0, 0, 0, 0, 112);
INSERT INTO `oc_admin_auth_rule` VALUES (7, 5, 'admin', 'admin/admin/adminauthform', '管理权限表单', '', '', 1, '', 0, 0, 0, 0, 113);
INSERT INTO `oc_admin_auth_rule` VALUES (8, 1, 'admin', 'admin/admin/adminauthgrouplist', '管理分组', '', '', 1, '', 1, 1, 0, 0, 121);
INSERT INTO `oc_admin_auth_rule` VALUES (9, 8, 'admin', 'admin/admin/adminauthgroupform', '管理权限分组表单', '', '', 1, '', 0, 0, 0, 0, 122);
INSERT INTO `oc_admin_auth_rule` VALUES (10, 8, 'admin', 'admin/admin/deladminauthgroup', '删除管理权限分组', '', '', 1, '', 0, 0, 0, 0, 123);
INSERT INTO `oc_admin_auth_rule` VALUES (11, 1, 'admin', 'admin/admin/adminlog', '管理日志', '', '', 1, '', 1, 1, 0, 0, 130);
INSERT INTO `oc_admin_auth_rule` VALUES (12, 0, 'admin', 'admin/index/index', '主页', 'layui-icon-home', '', 1, '', 1, 1, 0, 0, 10);
INSERT INTO `oc_admin_auth_rule` VALUES (13, 12, 'admin', 'admin/index/console', '控制台', '', '', 1, '', 1, 1, 0, 0, 11);
INSERT INTO `oc_admin_auth_rule` VALUES (14, 12, 'admin', 'admin/index/homepage', '仪表盘', '', '', 1, '', 0, 0, 0, 0, 12);
INSERT INTO `oc_admin_auth_rule` VALUES (15, 0, 'admin', 'admin/user', '用户管理', 'layui-icon-username', '', 1, '', 1, 1, 0, 1545120081, 140);
INSERT INTO `oc_admin_auth_rule` VALUES (16, 15, 'admin', 'admin/user/registerconfig', '注册配置', '', '', 1, '', 1, 1, 0, 0, 141);
INSERT INTO `oc_admin_auth_rule` VALUES (17, 15, 'admin', 'admin/user/userlist', '用户管理', '', '', 1, '', 1, 1, 0, 0, 142);
INSERT INTO `oc_admin_auth_rule` VALUES (18, 15, 'admin', 'admin/user/userrole', '用户角色', '', '', 1, '', 1, 1, 0, 0, 143);
INSERT INTO `oc_admin_auth_rule` VALUES (19, 15, 'admin', 'admin/user/userauth', '用户权限', '', '', 1, '', 1, 1, 0, 0, 144);
INSERT INTO `oc_admin_auth_rule` VALUES (20, 15, 'admin', 'admin/user/userlog', '用户日志', '', '', 1, '', 1, 1, 0, 0, 145);
INSERT INTO `oc_admin_auth_rule` VALUES (21, 0, 'admin', 'admin/operation', '运营', 'layui-icon-fire', '', 1, '', 1, 1, 0, 0, 160);
INSERT INTO `oc_admin_auth_rule` VALUES (22, 21, 'admin', 'admin/adv/pos', '广告位置', '', '', 1, '', 1, 1, 0, 0, 161);
INSERT INTO `oc_admin_auth_rule` VALUES (23, 21, 'admin', 'admin/score/typelist', '积分管理', '', '', 1, '', 1, 1, 0, 0, 162);
INSERT INTO `oc_admin_auth_rule` VALUES (24, 0, 'admin', 'admin/safe', '安全', 'layui-icon-vercode', '', 1, '', 1, 1, 0, 0, 170);
INSERT INTO `oc_admin_auth_rule` VALUES (25, 24, 'admin', 'admin/action/actionlimit', '行为限制', '', '', 1, '', 1, 1, 0, 0, 171);
INSERT INTO `oc_admin_auth_rule` VALUES (26, 24, 'admin', 'admin/action/actionlimitform', '行为限制表单', '', '', 1, '', 0, 0, 0, 0, 172);
INSERT INTO `oc_admin_auth_rule` VALUES (27, 24, 'admin', 'admin/action/delactionlimit', '删除行为限制', '', '', 1, '', 0, 0, 0, 0, 173);
INSERT INTO `oc_admin_auth_rule` VALUES (28, 0, 'admin', 'admin/setting', '常规设置', 'layui-icon-set', '系统配置|邮件配置|字典库|个人配置', 1, '', 1, 1, 1544150760, 1545120101, 174);
INSERT INTO `oc_admin_auth_rule` VALUES (29, 28, 'admin', 'admin/setting/system', '系统配置', '', '', 1, '', 1, 1, 1544151648, 0, 175);
INSERT INTO `oc_admin_auth_rule` VALUES (30, 28, 'admin', 'admin/setting/personage', '个人配置', '', '个人信息配置', 1, '', 1, 1, 1544151754, 1544151764, 176);
INSERT INTO `oc_admin_auth_rule` VALUES (31, 0, 'admin', 'admin/html', '页面管理', 'layui-icon-fonts-html', '自定义页面', 1, '', 1, 1, 1544168824, 1544168846, 177);
INSERT INTO `oc_admin_auth_rule` VALUES (32, 31, 'admin', 'admin/html/index', '页面列表', '', '', 1, '', 1, 1, 1544170321, 1544171088, 179);
INSERT INTO `oc_admin_auth_rule` VALUES (33, 31, 'admin', 'admin/html/material', '页面物料', '', '页面素材库', 1, '', 1, 1, 1544170534, 1544171120, 180);
INSERT INTO `oc_admin_auth_rule` VALUES (34, 31, 'admin', 'admin/html/template', '网站模板', '', '网站模板管理', 1, '', 1, 1, 1544171046, 1544171100, 178);
INSERT INTO `oc_admin_auth_rule` VALUES (35, 0, 'admin', 'admin/admin/content', '内容管理', '', '', 1, '', 1, 1, 1544757585, 1544757668, 179);
INSERT INTO `oc_admin_auth_rule` VALUES (36, 35, 'admin', 'admin/article/index', '文章管理', '', '', 1, '', 1, 1, 1544757627, 1545192662, 180);
INSERT INTO `oc_admin_auth_rule` VALUES (37, 21, 'admin', 'admin/nav/index', '菜单管理', '', '前台菜单管理', 1, '', 1, 1, 1545120153, 1545192674, 181);
INSERT INTO `oc_admin_auth_rule` VALUES (38, 35, 'admin', 'admin/collect/index', '采集内容', '', '根据URL和规则采集页面内容', 1, '', 1, 1, 1545192636, 1545203595, 182);

-- ----------------------------
-- Table structure for oc_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `oc_admin_log`;
CREATE TABLE `oc_admin_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '管理员ID',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '管理员名字',
  `module` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块名',
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '方法名',
  `param` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '参数 json',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '日志标题',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `ip` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'IP',
  `user_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'User-Agent',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `username`(`username`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员日志表' ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
