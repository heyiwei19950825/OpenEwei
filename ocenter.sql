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

 Date: 07/12/2018 18:07:55
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
INSERT INTO `oc_admin` VALUES (1, '1', 1, 'admin', 'd6ed47988e380b96982211580b9b28d5', 'admin@admin.com', '15201222936', 1544146604, 2130706433, 1544060605, 1);

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
INSERT INTO `oc_admin_auth_group` VALUES (1, 0, 'admin', 1, '超级管理员', '至高无上', 1, '12,13,14,1,2,3,4,5,6,7,8,9,10,11,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34', 1999958400, 1544060605, 1544171058);
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
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Compact;

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
INSERT INTO `oc_admin_auth_rule` VALUES (15, 0, 'admin', 'admin/user', '用户管理', '', '', 1, '', 1, 1, 0, 0, 140);
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
INSERT INTO `oc_admin_auth_rule` VALUES (28, 0, 'admin', 'admin/setting', '常规设置', '', '系统配置|邮件配置|字典库|个人配置', 1, '', 1, 1, 1544150760, 1544151601, 174);
INSERT INTO `oc_admin_auth_rule` VALUES (29, 28, 'admin', 'admin/setting/system', '系统配置', '', '', 1, '', 1, 1, 1544151648, 0, 175);
INSERT INTO `oc_admin_auth_rule` VALUES (30, 28, 'admin', 'admin/setting/personage', '个人配置', '', '个人信息配置', 1, '', 1, 1, 1544151754, 1544151764, 176);
INSERT INTO `oc_admin_auth_rule` VALUES (31, 0, 'admin', 'admin/html', '页面管理', 'layui-icon-fonts-html', '自定义页面', 1, '', 1, 1, 1544168824, 1544168846, 177);
INSERT INTO `oc_admin_auth_rule` VALUES (32, 31, 'admin', 'admin/html/index', '页面列表', '', '', 1, '', 1, 1, 1544170321, 1544171088, 179);
INSERT INTO `oc_admin_auth_rule` VALUES (33, 31, 'admin', 'admin/html/material', '页面物料', '', '页面素材库', 1, '', 1, 1, 1544170534, 1544171120, 180);
INSERT INTO `oc_admin_auth_rule` VALUES (34, 31, 'admin', 'admin/html/template', '网站模板', '', '网站模板管理', 1, '', 1, 1, 1544171046, 1544171100, 178);

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
) ENGINE = InnoDB AUTO_INCREMENT = 10547 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员日志表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_admin_log
-- ----------------------------
INSERT INTO `oc_admin_log` VALUES (10000, 1, 'admin', 'admin', '/admin/login/login', '{\"data\":{\"username\":\"admin\",\"password\":\"123123\",\"vercode\":\"f3xg\",\"remember\":\"on\"}}', '登录', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084455);
INSERT INTO `oc_admin_log` VALUES (10001, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084457);
INSERT INTO `oc_admin_log` VALUES (10002, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084457);
INSERT INTO `oc_admin_log` VALUES (10003, 1, 'admin', 'admin', '/admin/user/registerconfig', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084631);
INSERT INTO `oc_admin_log` VALUES (10004, 1, 'admin', 'admin', '/admin/user/userlist', '', '用户列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084632);
INSERT INTO `oc_admin_log` VALUES (10005, 1, 'admin', 'admin', '/admin/user/userlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084633);
INSERT INTO `oc_admin_log` VALUES (10006, 1, 'admin', 'admin', '/admin/user/userrole', '', '用户角色列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084634);
INSERT INTO `oc_admin_log` VALUES (10007, 1, 'admin', 'admin', '/admin/user/userrole?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户角色列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084634);
INSERT INTO `oc_admin_log` VALUES (10008, 1, 'admin', 'admin', '/admin/user/userauth', '', '用户权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084634);
INSERT INTO `oc_admin_log` VALUES (10009, 1, 'admin', 'admin', '/admin/user/userauth?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084635);
INSERT INTO `oc_admin_log` VALUES (10010, 1, 'admin', 'admin', '/admin/user/userlog', '', '用户日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084635);
INSERT INTO `oc_admin_log` VALUES (10011, 1, 'admin', 'admin', '/admin/user/userlog?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544084636);
INSERT INTO `oc_admin_log` VALUES (10012, 1, 'admin', 'admin', '/admin/login/login', '', '登录', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146604);
INSERT INTO `oc_admin_log` VALUES (10013, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146604);
INSERT INTO `oc_admin_log` VALUES (10014, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146605);
INSERT INTO `oc_admin_log` VALUES (10015, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146610);
INSERT INTO `oc_admin_log` VALUES (10016, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146610);
INSERT INTO `oc_admin_log` VALUES (10017, 1, 'admin', 'admin', '/admin/action/actionlimit', '', '用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146613);
INSERT INTO `oc_admin_log` VALUES (10018, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146614);
INSERT INTO `oc_admin_log` VALUES (10019, 1, 'admin', 'admin', '/admin/action/actionlimitform', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146616);
INSERT INTO `oc_admin_log` VALUES (10020, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146636);
INSERT INTO `oc_admin_log` VALUES (10021, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544146636);
INSERT INTO `oc_admin_log` VALUES (10022, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147492);
INSERT INTO `oc_admin_log` VALUES (10023, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147493);
INSERT INTO `oc_admin_log` VALUES (10024, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147582);
INSERT INTO `oc_admin_log` VALUES (10025, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147583);
INSERT INTO `oc_admin_log` VALUES (10026, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147610);
INSERT INTO `oc_admin_log` VALUES (10027, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147611);
INSERT INTO `oc_admin_log` VALUES (10028, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147629);
INSERT INTO `oc_admin_log` VALUES (10029, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147629);
INSERT INTO `oc_admin_log` VALUES (10030, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147656);
INSERT INTO `oc_admin_log` VALUES (10031, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147657);
INSERT INTO `oc_admin_log` VALUES (10032, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147731);
INSERT INTO `oc_admin_log` VALUES (10033, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147732);
INSERT INTO `oc_admin_log` VALUES (10034, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147780);
INSERT INTO `oc_admin_log` VALUES (10035, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147780);
INSERT INTO `oc_admin_log` VALUES (10036, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147781);
INSERT INTO `oc_admin_log` VALUES (10037, 1, 'admin', 'admin', '/admin/admin/adminauthform', '', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147784);
INSERT INTO `oc_admin_log` VALUES (10038, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"state\":\"0\"}', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147850);
INSERT INTO `oc_admin_log` VALUES (10039, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=%E6%B5%8B%E8%AF%95&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\\u6d4b\\u8bd5\",\"state\":\"0\"}', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544147865);
INSERT INTO `oc_admin_log` VALUES (10040, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=%E6%B5%8B%E8%AF%95&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\\u6d4b\\u8bd5\",\"state\":\"0\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148205);
INSERT INTO `oc_admin_log` VALUES (10041, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=%E6%B5%8B%E8%AF%95&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\\u6d4b\\u8bd5\",\"state\":\"0\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148345);
INSERT INTO `oc_admin_log` VALUES (10042, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=%E6%B5%8B%E8%AF%95&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\\u6d4b\\u8bd5\",\"state\":\"0\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148501);
INSERT INTO `oc_admin_log` VALUES (10043, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"state\":\"0\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148507);
INSERT INTO `oc_admin_log` VALUES (10044, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"state\":\"0\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148515);
INSERT INTO `oc_admin_log` VALUES (10045, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148518);
INSERT INTO `oc_admin_log` VALUES (10046, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148519);
INSERT INTO `oc_admin_log` VALUES (10047, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148542);
INSERT INTO `oc_admin_log` VALUES (10048, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148543);
INSERT INTO `oc_admin_log` VALUES (10049, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148547);
INSERT INTO `oc_admin_log` VALUES (10050, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148547);
INSERT INTO `oc_admin_log` VALUES (10051, 1, 'admin', 'admin', '/admin/index/theme', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148574);
INSERT INTO `oc_admin_log` VALUES (10052, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148576);
INSERT INTO `oc_admin_log` VALUES (10053, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148576);
INSERT INTO `oc_admin_log` VALUES (10054, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148578);
INSERT INTO `oc_admin_log` VALUES (10055, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148579);
INSERT INTO `oc_admin_log` VALUES (10056, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148586);
INSERT INTO `oc_admin_log` VALUES (10057, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148587);
INSERT INTO `oc_admin_log` VALUES (10058, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"state\":\"0\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148589);
INSERT INTO `oc_admin_log` VALUES (10059, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=a&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"a\",\"state\":\"0\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148617);
INSERT INTO `oc_admin_log` VALUES (10060, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=a123123&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"a123123\",\"state\":\"0\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148619);
INSERT INTO `oc_admin_log` VALUES (10061, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=a123123&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"a123123\",\"state\":\"0\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148657);
INSERT INTO `oc_admin_log` VALUES (10062, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=a&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"a\",\"state\":\"0\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148659);
INSERT INTO `oc_admin_log` VALUES (10063, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=%40&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"@\",\"state\":\"0\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148663);
INSERT INTO `oc_admin_log` VALUES (10064, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=&state=0', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"state\":\"0\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148666);
INSERT INTO `oc_admin_log` VALUES (10065, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=&state=2', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"state\":\"2\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148673);
INSERT INTO `oc_admin_log` VALUES (10066, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148734);
INSERT INTO `oc_admin_log` VALUES (10067, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148743);
INSERT INTO `oc_admin_log` VALUES (10068, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148764);
INSERT INTO `oc_admin_log` VALUES (10069, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148774);
INSERT INTO `oc_admin_log` VALUES (10070, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148784);
INSERT INTO `oc_admin_log` VALUES (10071, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148793);
INSERT INTO `oc_admin_log` VALUES (10072, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148857);
INSERT INTO `oc_admin_log` VALUES (10073, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148882);
INSERT INTO `oc_admin_log` VALUES (10074, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148883);
INSERT INTO `oc_admin_log` VALUES (10075, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148888);
INSERT INTO `oc_admin_log` VALUES (10076, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148889);
INSERT INTO `oc_admin_log` VALUES (10077, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148923);
INSERT INTO `oc_admin_log` VALUES (10078, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148924);
INSERT INTO `oc_admin_log` VALUES (10079, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148933);
INSERT INTO `oc_admin_log` VALUES (10080, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148933);
INSERT INTO `oc_admin_log` VALUES (10081, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148936);
INSERT INTO `oc_admin_log` VALUES (10082, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148937);
INSERT INTO `oc_admin_log` VALUES (10083, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148948);
INSERT INTO `oc_admin_log` VALUES (10084, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148949);
INSERT INTO `oc_admin_log` VALUES (10085, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=&status=2', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"status\":\"2\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148975);
INSERT INTO `oc_admin_log` VALUES (10086, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20&keyword=&status=1', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"status\":\"1\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148978);
INSERT INTO `oc_admin_log` VALUES (10087, 1, 'admin', 'admin', '/admin/admin/adminform?id=1', '{\"id\":\"1\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544148994);
INSERT INTO `oc_admin_log` VALUES (10088, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149009);
INSERT INTO `oc_admin_log` VALUES (10089, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149009);
INSERT INTO `oc_admin_log` VALUES (10090, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149016);
INSERT INTO `oc_admin_log` VALUES (10091, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149016);
INSERT INTO `oc_admin_log` VALUES (10092, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149042);
INSERT INTO `oc_admin_log` VALUES (10093, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149043);
INSERT INTO `oc_admin_log` VALUES (10094, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149057);
INSERT INTO `oc_admin_log` VALUES (10095, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149057);
INSERT INTO `oc_admin_log` VALUES (10096, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149128);
INSERT INTO `oc_admin_log` VALUES (10097, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149128);
INSERT INTO `oc_admin_log` VALUES (10098, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149134);
INSERT INTO `oc_admin_log` VALUES (10099, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149134);
INSERT INTO `oc_admin_log` VALUES (10100, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149140);
INSERT INTO `oc_admin_log` VALUES (10101, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149140);
INSERT INTO `oc_admin_log` VALUES (10102, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149146);
INSERT INTO `oc_admin_log` VALUES (10103, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149146);
INSERT INTO `oc_admin_log` VALUES (10104, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149152);
INSERT INTO `oc_admin_log` VALUES (10105, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149153);
INSERT INTO `oc_admin_log` VALUES (10106, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149315);
INSERT INTO `oc_admin_log` VALUES (10107, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149315);
INSERT INTO `oc_admin_log` VALUES (10108, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149348);
INSERT INTO `oc_admin_log` VALUES (10109, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149349);
INSERT INTO `oc_admin_log` VALUES (10110, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149350);
INSERT INTO `oc_admin_log` VALUES (10111, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149350);
INSERT INTO `oc_admin_log` VALUES (10112, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&field=sort&order=asc', '{\"page\":\"1\",\"limit\":\"20\",\"field\":\"sort\",\"order\":\"asc\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149418);
INSERT INTO `oc_admin_log` VALUES (10113, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149445);
INSERT INTO `oc_admin_log` VALUES (10114, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149445);
INSERT INTO `oc_admin_log` VALUES (10115, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149447);
INSERT INTO `oc_admin_log` VALUES (10116, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149448);
INSERT INTO `oc_admin_log` VALUES (10117, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149449);
INSERT INTO `oc_admin_log` VALUES (10118, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149449);
INSERT INTO `oc_admin_log` VALUES (10119, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=&state=1', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"state\":\"1\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149452);
INSERT INTO `oc_admin_log` VALUES (10120, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20&keyword=&state=2', '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\",\"state\":\"2\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149454);
INSERT INTO `oc_admin_log` VALUES (10121, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149494);
INSERT INTO `oc_admin_log` VALUES (10122, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149495);
INSERT INTO `oc_admin_log` VALUES (10123, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149507);
INSERT INTO `oc_admin_log` VALUES (10124, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149507);
INSERT INTO `oc_admin_log` VALUES (10125, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149533);
INSERT INTO `oc_admin_log` VALUES (10126, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149533);
INSERT INTO `oc_admin_log` VALUES (10127, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149550);
INSERT INTO `oc_admin_log` VALUES (10128, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149555);
INSERT INTO `oc_admin_log` VALUES (10129, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149598);
INSERT INTO `oc_admin_log` VALUES (10130, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149599);
INSERT INTO `oc_admin_log` VALUES (10131, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149600);
INSERT INTO `oc_admin_log` VALUES (10132, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149628);
INSERT INTO `oc_admin_log` VALUES (10133, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149628);
INSERT INTO `oc_admin_log` VALUES (10134, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149629);
INSERT INTO `oc_admin_log` VALUES (10135, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149667);
INSERT INTO `oc_admin_log` VALUES (10136, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149683);
INSERT INTO `oc_admin_log` VALUES (10137, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149683);
INSERT INTO `oc_admin_log` VALUES (10138, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149685);
INSERT INTO `oc_admin_log` VALUES (10139, 1, 'admin', 'admin', '/admin/admin/adminform', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149691);
INSERT INTO `oc_admin_log` VALUES (10140, 1, 'admin', 'admin', '/admin/admin/adminform', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149693);
INSERT INTO `oc_admin_log` VALUES (10141, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149703);
INSERT INTO `oc_admin_log` VALUES (10142, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149703);
INSERT INTO `oc_admin_log` VALUES (10143, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149705);
INSERT INTO `oc_admin_log` VALUES (10144, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149706);
INSERT INTO `oc_admin_log` VALUES (10145, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149729);
INSERT INTO `oc_admin_log` VALUES (10146, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149730);
INSERT INTO `oc_admin_log` VALUES (10147, 1, 'admin', 'admin', '/admin/admin/adminlog', '', '管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149737);
INSERT INTO `oc_admin_log` VALUES (10148, 1, 'admin', 'admin', '/admin/admin/adminlog?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149737);
INSERT INTO `oc_admin_log` VALUES (10149, 1, 'admin', 'admin', '/admin/admin/adminlog', '', '管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149778);
INSERT INTO `oc_admin_log` VALUES (10150, 1, 'admin', 'admin', '/admin/admin/adminlog?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149779);
INSERT INTO `oc_admin_log` VALUES (10151, 1, 'admin', 'admin', '/admin/admin/adminlog', '', '管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149799);
INSERT INTO `oc_admin_log` VALUES (10152, 1, 'admin', 'admin', '/admin/admin/adminlog?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544149800);
INSERT INTO `oc_admin_log` VALUES (10153, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150099);
INSERT INTO `oc_admin_log` VALUES (10154, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150100);
INSERT INTO `oc_admin_log` VALUES (10155, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform', '', '管理员权限分组表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150101);
INSERT INTO `oc_admin_log` VALUES (10156, 1, 'admin', 'admin', '/admin/admin/getadminauthtree', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150101);
INSERT INTO `oc_admin_log` VALUES (10157, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150134);
INSERT INTO `oc_admin_log` VALUES (10158, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150135);
INSERT INTO `oc_admin_log` VALUES (10159, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform?id=2', '{\"id\":\"2\"}', '管理员权限分组表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150135);
INSERT INTO `oc_admin_log` VALUES (10160, 1, 'admin', 'admin', '/admin/admin/getadminauthtree/id/2', '{\"id\":\"2\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150136);
INSERT INTO `oc_admin_log` VALUES (10161, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150179);
INSERT INTO `oc_admin_log` VALUES (10162, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150180);
INSERT INTO `oc_admin_log` VALUES (10163, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform?id=2', '{\"id\":\"2\"}', '管理员权限分组表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150180);
INSERT INTO `oc_admin_log` VALUES (10164, 1, 'admin', 'admin', '/admin/admin/getadminauthtree/id/2', '{\"id\":\"2\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150181);
INSERT INTO `oc_admin_log` VALUES (10165, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform?id=2', '{\"id\":\"2\"}', '管理员权限分组表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150432);
INSERT INTO `oc_admin_log` VALUES (10166, 1, 'admin', 'admin', '/admin/admin/getadminauthtree/id/2', '{\"id\":\"2\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150432);
INSERT INTO `oc_admin_log` VALUES (10167, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150486);
INSERT INTO `oc_admin_log` VALUES (10168, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150487);
INSERT INTO `oc_admin_log` VALUES (10169, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150502);
INSERT INTO `oc_admin_log` VALUES (10170, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150502);
INSERT INTO `oc_admin_log` VALUES (10171, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform?id=1', '{\"id\":\"1\"}', '管理员权限分组表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150534);
INSERT INTO `oc_admin_log` VALUES (10172, 1, 'admin', 'admin', '/admin/admin/getadminauthtree/id/1', '{\"id\":\"1\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150535);
INSERT INTO `oc_admin_log` VALUES (10173, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform', '{\"id\":\"1\",\"title\":\"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\",\"module\":\"admin\",\"pid\":\"0\",\"description\":\"\\u81f3\\u9ad8\\u65e0\\u4e0a\",\"end_time\":\"2033-05-18\",\"rules\":\"12,13,14,1,2,3,4,5,6,7,8,9,10,11,15,16,17,18,19,20,21,22,23,24,25,26,27\",\"status\":\"on\"}', '编辑分组权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150537);
INSERT INTO `oc_admin_log` VALUES (10174, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150538);
INSERT INTO `oc_admin_log` VALUES (10175, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150540);
INSERT INTO `oc_admin_log` VALUES (10176, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150558);
INSERT INTO `oc_admin_log` VALUES (10177, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=1', '{\"id\":\"1\",\"title\":\"\\u7ba1\\u7406\\u5458\\u7ba1\\u7406\",\"module\":\"admin\",\"name\":\"admin\\/admin\",\"pid\":\"0\",\"icon\":\"\",\"remark\":\"\",\"sort\":\"100\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '编辑管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150559);
INSERT INTO `oc_admin_log` VALUES (10178, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150559);
INSERT INTO `oc_admin_log` VALUES (10179, 1, 'admin', 'admin', '/admin/user/registerconfig', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150567);
INSERT INTO `oc_admin_log` VALUES (10180, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150674);
INSERT INTO `oc_admin_log` VALUES (10181, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150675);
INSERT INTO `oc_admin_log` VALUES (10182, 1, 'admin', 'admin', '/admin/admin/adminauthform', '', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150677);
INSERT INTO `oc_admin_log` VALUES (10183, 1, 'admin', 'admin', '/admin/admin/adminauthform', '{\"id\":\"\",\"title\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"module\":\"admin\",\"name\":\"admin\\/setting\",\"pid\":\"0\",\"icon\":\"layui-icon-set\",\"remark\":\"\\u7cfb\\u7edf\\u914d\\u7f6e\",\"sort\":\"174\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '新增管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150760);
INSERT INTO `oc_admin_log` VALUES (10184, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150760);
INSERT INTO `oc_admin_log` VALUES (10185, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150765);
INSERT INTO `oc_admin_log` VALUES (10186, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150766);
INSERT INTO `oc_admin_log` VALUES (10187, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150767);
INSERT INTO `oc_admin_log` VALUES (10188, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150768);
INSERT INTO `oc_admin_log` VALUES (10189, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150768);
INSERT INTO `oc_admin_log` VALUES (10190, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150769);
INSERT INTO `oc_admin_log` VALUES (10191, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150771);
INSERT INTO `oc_admin_log` VALUES (10192, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150772);
INSERT INTO `oc_admin_log` VALUES (10193, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150775);
INSERT INTO `oc_admin_log` VALUES (10194, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150775);
INSERT INTO `oc_admin_log` VALUES (10195, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150778);
INSERT INTO `oc_admin_log` VALUES (10196, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150778);
INSERT INTO `oc_admin_log` VALUES (10197, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150783);
INSERT INTO `oc_admin_log` VALUES (10198, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150793);
INSERT INTO `oc_admin_log` VALUES (10199, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150793);
INSERT INTO `oc_admin_log` VALUES (10200, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150797);
INSERT INTO `oc_admin_log` VALUES (10201, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150798);
INSERT INTO `oc_admin_log` VALUES (10202, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150802);
INSERT INTO `oc_admin_log` VALUES (10203, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150802);
INSERT INTO `oc_admin_log` VALUES (10204, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150805);
INSERT INTO `oc_admin_log` VALUES (10205, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150832);
INSERT INTO `oc_admin_log` VALUES (10206, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150833);
INSERT INTO `oc_admin_log` VALUES (10207, 1, 'admin', 'admin', '/admin/admin/adminform?id=1', '{\"id\":\"1\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150838);
INSERT INTO `oc_admin_log` VALUES (10208, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150841);
INSERT INTO `oc_admin_log` VALUES (10209, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150841);
INSERT INTO `oc_admin_log` VALUES (10210, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform?id=1', '{\"id\":\"1\"}', '管理员权限分组表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150842);
INSERT INTO `oc_admin_log` VALUES (10211, 1, 'admin', 'admin', '/admin/admin/getadminauthtree/id/1', '{\"id\":\"1\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150843);
INSERT INTO `oc_admin_log` VALUES (10212, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform', '{\"id\":\"1\",\"title\":\"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\",\"module\":\"admin\",\"pid\":\"0\",\"description\":\"\\u81f3\\u9ad8\\u65e0\\u4e0a\",\"end_time\":\"2033-05-18\",\"rules\":\"12,13,14,1,2,3,4,5,6,7,8,9,10,11,15,16,17,18,19,20,21,22,23,24,25,26,27,28\",\"status\":\"on\"}', '编辑分组权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150846);
INSERT INTO `oc_admin_log` VALUES (10213, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150846);
INSERT INTO `oc_admin_log` VALUES (10214, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150849);
INSERT INTO `oc_admin_log` VALUES (10215, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150850);
INSERT INTO `oc_admin_log` VALUES (10216, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150994);
INSERT INTO `oc_admin_log` VALUES (10217, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544150995);
INSERT INTO `oc_admin_log` VALUES (10218, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151003);
INSERT INTO `oc_admin_log` VALUES (10219, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=28', '{\"id\":\"28\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151005);
INSERT INTO `oc_admin_log` VALUES (10220, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=28', '{\"id\":\"28\",\"title\":\"\\u5e38\\u89c4\\u8bbe\\u7f6e\",\"module\":\"admin\",\"name\":\"admin\\/setting\",\"pid\":\"0\",\"icon\":\"\",\"remark\":\"\\u7cfb\\u7edf\\u914d\\u7f6e\",\"sort\":\"174\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151012);
INSERT INTO `oc_admin_log` VALUES (10221, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=28', '{\"id\":\"28\",\"title\":\"\\u5e38\\u89c4\\u8bbe\\u7f6e\",\"module\":\"admin\",\"name\":\"admin\\/setting\",\"pid\":\"0\",\"icon\":\"\",\"remark\":\"\\u7cfb\\u7edf\\u914d\\u7f6e\",\"sort\":\"174\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151386);
INSERT INTO `oc_admin_log` VALUES (10222, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=28', '{\"id\":\"28\",\"title\":\"\\u5e38\\u89c4\\u8bbe\\u7f6e\",\"module\":\"admin\",\"name\":\"admin\\/setting\",\"pid\":\"0\",\"icon\":\"\",\"remark\":\"\\u7cfb\\u7edf\\u914d\\u7f6e\",\"sort\":\"174\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '编辑管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151571);
INSERT INTO `oc_admin_log` VALUES (10223, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151571);
INSERT INTO `oc_admin_log` VALUES (10224, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=28', '{\"id\":\"28\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151578);
INSERT INTO `oc_admin_log` VALUES (10225, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=28', '{\"id\":\"28\",\"title\":\"\\u5e38\\u89c4\\u8bbe\\u7f6e\",\"module\":\"admin\",\"name\":\"admin\\/setting\",\"pid\":\"0\",\"icon\":\"\",\"remark\":\"\\u7cfb\\u7edf\\u914d\\u7f6e|\\u90ae\\u4ef6\\u914d\\u7f6e|\\u5b57\\u5178\\u5e93|\\u4e2a\\u4eba\\u914d\\u7f6e\",\"sort\":\"174\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '编辑管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151601);
INSERT INTO `oc_admin_log` VALUES (10226, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151602);
INSERT INTO `oc_admin_log` VALUES (10227, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=28', '{\"id\":\"28\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151609);
INSERT INTO `oc_admin_log` VALUES (10228, 1, 'admin', 'admin', '/admin/admin/adminauthform', '', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151611);
INSERT INTO `oc_admin_log` VALUES (10229, 1, 'admin', 'admin', '/admin/admin/adminauthform', '{\"id\":\"\",\"title\":\"\\u7cfb\\u7edf\\u914d\\u7f6e\",\"module\":\"admin\",\"name\":\"admin\\/setting\\/system\",\"pid\":\"28\",\"icon\":\"\",\"remark\":\"\",\"sort\":\"175\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '新增管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151648);
INSERT INTO `oc_admin_log` VALUES (10230, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151649);
INSERT INTO `oc_admin_log` VALUES (10231, 1, 'admin', 'admin', '/admin/admin/adminauthform', '', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151652);
INSERT INTO `oc_admin_log` VALUES (10232, 1, 'admin', 'admin', '/admin/admin/adminauthform', '{\"id\":\"\",\"title\":\"\\u4e2a\\u4eba\\u914d\\u7f6e\",\"module\":\"admin\",\"name\":\"admin\\/setting\\/personage\",\"pid\":\"0\",\"icon\":\"\",\"remark\":\"\\u4e2a\\u4eba\\u4fe1\\u606f\\u914d\\u7f6e\",\"sort\":\"176\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '新增管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151754);
INSERT INTO `oc_admin_log` VALUES (10233, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151754);
INSERT INTO `oc_admin_log` VALUES (10234, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=30', '{\"id\":\"30\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151761);
INSERT INTO `oc_admin_log` VALUES (10235, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=30', '{\"id\":\"30\",\"title\":\"\\u4e2a\\u4eba\\u914d\\u7f6e\",\"module\":\"admin\",\"name\":\"admin\\/setting\\/personage\",\"pid\":\"28\",\"icon\":\"\",\"remark\":\"\\u4e2a\\u4eba\\u4fe1\\u606f\\u914d\\u7f6e\",\"sort\":\"176\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '编辑管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151764);
INSERT INTO `oc_admin_log` VALUES (10236, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151764);
INSERT INTO `oc_admin_log` VALUES (10237, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151770);
INSERT INTO `oc_admin_log` VALUES (10238, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151771);
INSERT INTO `oc_admin_log` VALUES (10239, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform?id=1', '{\"id\":\"1\"}', '管理员权限分组表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151773);
INSERT INTO `oc_admin_log` VALUES (10240, 1, 'admin', 'admin', '/admin/admin/getadminauthtree/id/1', '{\"id\":\"1\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151773);
INSERT INTO `oc_admin_log` VALUES (10241, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform', '{\"id\":\"1\",\"title\":\"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\",\"module\":\"admin\",\"pid\":\"0\",\"description\":\"\\u81f3\\u9ad8\\u65e0\\u4e0a\",\"end_time\":\"2033-05-18\",\"rules\":\"12,13,14,1,2,3,4,5,6,7,8,9,10,11,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30\",\"status\":\"on\"}', '编辑分组权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151778);
INSERT INTO `oc_admin_log` VALUES (10242, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151778);
INSERT INTO `oc_admin_log` VALUES (10243, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151781);
INSERT INTO `oc_admin_log` VALUES (10244, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544151781);
INSERT INTO `oc_admin_log` VALUES (10245, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544153954);
INSERT INTO `oc_admin_log` VALUES (10246, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544153955);
INSERT INTO `oc_admin_log` VALUES (10247, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544154477);
INSERT INTO `oc_admin_log` VALUES (10248, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544154478);
INSERT INTO `oc_admin_log` VALUES (10249, 1, 'admin', 'admin', '/admin/user/registerconfig', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166163);
INSERT INTO `oc_admin_log` VALUES (10250, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166269);
INSERT INTO `oc_admin_log` VALUES (10251, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166307);
INSERT INTO `oc_admin_log` VALUES (10252, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166377);
INSERT INTO `oc_admin_log` VALUES (10253, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166462);
INSERT INTO `oc_admin_log` VALUES (10254, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166497);
INSERT INTO `oc_admin_log` VALUES (10255, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166544);
INSERT INTO `oc_admin_log` VALUES (10256, 1, 'admin', 'admin', '/admin/user/registerconfig', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166556);
INSERT INTO `oc_admin_log` VALUES (10257, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166584);
INSERT INTO `oc_admin_log` VALUES (10258, 1, 'admin', 'admin', '/admin/adv/pos', '', '广告位列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166609);
INSERT INTO `oc_admin_log` VALUES (10259, 1, 'admin', 'admin', '/admin/adv/pos?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '获取广告位列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166610);
INSERT INTO `oc_admin_log` VALUES (10260, 1, 'admin', 'admin', '/admin/adv/adv?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '广告管理', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166610);
INSERT INTO `oc_admin_log` VALUES (10261, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166672);
INSERT INTO `oc_admin_log` VALUES (10262, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166677);
INSERT INTO `oc_admin_log` VALUES (10263, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166685);
INSERT INTO `oc_admin_log` VALUES (10264, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166686);
INSERT INTO `oc_admin_log` VALUES (10265, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166690);
INSERT INTO `oc_admin_log` VALUES (10266, 1, 'admin', 'admin', '/admin/adv/pos', '', '广告位列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166697);
INSERT INTO `oc_admin_log` VALUES (10267, 1, 'admin', 'admin', '/admin/adv/pos?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '获取广告位列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166697);
INSERT INTO `oc_admin_log` VALUES (10268, 1, 'admin', 'admin', '/admin/adv/adv?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '广告管理', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166698);
INSERT INTO `oc_admin_log` VALUES (10269, 1, 'admin', 'admin', '/admin/user/registerconfig', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166702);
INSERT INTO `oc_admin_log` VALUES (10270, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166759);
INSERT INTO `oc_admin_log` VALUES (10271, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166809);
INSERT INTO `oc_admin_log` VALUES (10272, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166831);
INSERT INTO `oc_admin_log` VALUES (10273, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166852);
INSERT INTO `oc_admin_log` VALUES (10274, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544166964);
INSERT INTO `oc_admin_log` VALUES (10275, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544167053);
INSERT INTO `oc_admin_log` VALUES (10276, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544167271);
INSERT INTO `oc_admin_log` VALUES (10277, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544167323);
INSERT INTO `oc_admin_log` VALUES (10278, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168048);
INSERT INTO `oc_admin_log` VALUES (10279, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168096);
INSERT INTO `oc_admin_log` VALUES (10280, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168103);
INSERT INTO `oc_admin_log` VALUES (10281, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168116);
INSERT INTO `oc_admin_log` VALUES (10282, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168208);
INSERT INTO `oc_admin_log` VALUES (10283, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168216);
INSERT INTO `oc_admin_log` VALUES (10284, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168245);
INSERT INTO `oc_admin_log` VALUES (10285, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168312);
INSERT INTO `oc_admin_log` VALUES (10286, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168754);
INSERT INTO `oc_admin_log` VALUES (10287, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168755);
INSERT INTO `oc_admin_log` VALUES (10288, 1, 'admin', 'admin', '/admin/admin/adminauthform', '', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168757);
INSERT INTO `oc_admin_log` VALUES (10289, 1, 'admin', 'admin', '/admin/admin/adminauthform', '{\"id\":\"\",\"title\":\"\\u9875\\u9762\\u7ba1\\u7406\",\"module\":\"admin\",\"name\":\"admin\\/html\",\"pid\":\"0\",\"icon\":\"\",\"remark\":\"\\u81ea\\u5b9a\\u4e49\\u9875\\u9762\",\"sort\":\"178\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '新增管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168824);
INSERT INTO `oc_admin_log` VALUES (10290, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168824);
INSERT INTO `oc_admin_log` VALUES (10291, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168828);
INSERT INTO `oc_admin_log` VALUES (10292, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=31', '{\"id\":\"31\"}', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168831);
INSERT INTO `oc_admin_log` VALUES (10293, 1, 'admin', 'admin', '/admin/admin/adminauthform?id=31', '{\"id\":\"31\",\"title\":\"\\u9875\\u9762\\u7ba1\\u7406\",\"module\":\"admin\",\"name\":\"admin\\/html\",\"pid\":\"0\",\"icon\":\"layui-icon-fonts-html\",\"remark\":\"\\u81ea\\u5b9a\\u4e49\\u9875\\u9762\",\"sort\":\"177\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '编辑管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168846);
INSERT INTO `oc_admin_log` VALUES (10294, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168846);
INSERT INTO `oc_admin_log` VALUES (10295, 1, 'admin', 'admin', '/admin/admin/adminlist', '', '管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168848);
INSERT INTO `oc_admin_log` VALUES (10296, 1, 'admin', 'admin', '/admin/admin/adminlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168848);
INSERT INTO `oc_admin_log` VALUES (10297, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist', '', '管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168848);
INSERT INTO `oc_admin_log` VALUES (10298, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168849);
INSERT INTO `oc_admin_log` VALUES (10299, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform?id=1', '{\"id\":\"1\"}', '管理员权限分组表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168850);
INSERT INTO `oc_admin_log` VALUES (10300, 1, 'admin', 'admin', '/admin/admin/getadminauthtree/id/1', '{\"id\":\"1\"}', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168850);
INSERT INTO `oc_admin_log` VALUES (10301, 1, 'admin', 'admin', '/admin/admin/adminauthgroupform', '{\"id\":\"1\",\"title\":\"\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458\",\"module\":\"admin\",\"pid\":\"0\",\"description\":\"\\u81f3\\u9ad8\\u65e0\\u4e0a\",\"end_time\":\"2033-05-18\",\"rules\":\"12,13,14,1,2,3,4,5,6,7,8,9,10,11,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31\",\"status\":\"on\"}', '编辑分组权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168852);
INSERT INTO `oc_admin_log` VALUES (10302, 1, 'admin', 'admin', '/admin/admin/adminauthgrouplist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限分组列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168853);
INSERT INTO `oc_admin_log` VALUES (10303, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168855);
INSERT INTO `oc_admin_log` VALUES (10304, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544168855);
INSERT INTO `oc_admin_log` VALUES (10305, 1, 'admin', 'admin', '/admin/setting/system', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169549);
INSERT INTO `oc_admin_log` VALUES (10306, 1, 'admin', 'admin', '/admin/adv/pos', '', '广告位列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169554);
INSERT INTO `oc_admin_log` VALUES (10307, 1, 'admin', 'admin', '/admin/adv/pos?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '获取广告位列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169554);
INSERT INTO `oc_admin_log` VALUES (10308, 1, 'admin', 'admin', '/admin/adv/adv?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '广告管理', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169554);
INSERT INTO `oc_admin_log` VALUES (10309, 1, 'admin', 'admin', '/admin/action/actionlimit', '', '用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169566);
INSERT INTO `oc_admin_log` VALUES (10310, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169566);
INSERT INTO `oc_admin_log` VALUES (10311, 1, 'admin', 'admin', '/admin/adv/pos', '', '广告位列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169570);
INSERT INTO `oc_admin_log` VALUES (10312, 1, 'admin', 'admin', '/admin/adv/pos?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '获取广告位列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169570);
INSERT INTO `oc_admin_log` VALUES (10313, 1, 'admin', 'admin', '/admin/adv/adv?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '广告管理', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544169570);
INSERT INTO `oc_admin_log` VALUES (10314, 1, 'admin', 'admin', '/admin/admin/adminauthlist', '', '管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544170251);
INSERT INTO `oc_admin_log` VALUES (10315, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544170252);
INSERT INTO `oc_admin_log` VALUES (10316, 1, 'admin', 'admin', '/admin/admin/adminauthform', '', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544170253);
INSERT INTO `oc_admin_log` VALUES (10317, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544170276);
INSERT INTO `oc_admin_log` VALUES (10318, 1, 'admin', 'admin', '/admin/admin/adminauthform', '', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544170280);
INSERT INTO `oc_admin_log` VALUES (10319, 1, 'admin', 'admin', '/admin/admin/adminauthform', '{\"id\":\"\",\"title\":\"\\u9875\\u9762\\u5217\\u8868\",\"module\":\"admin\",\"name\":\"admin\\/html\\/list\",\"pid\":\"31\",\"icon\":\"\",\"remark\":\"\",\"sort\":\"178\",\"is_menu\":\"on\",\"is_show\":\"on\",\"status\":\"on\"}', '新增管理员权限成功', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544170321);
INSERT INTO `oc_admin_log` VALUES (10320, 1, 'admin', 'admin', '/admin/admin/adminauthlist?page=2&limit=20', '{\"page\":\"2\",\"limit\":\"20\"}', '获取管理员权限列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544170321);
INSERT INTO `oc_admin_log` VALUES (10321, 1, 'admin', 'admin', '/admin/admin/adminauthform', '', '管理员权限表单', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544170322);
INSERT INTO `oc_admin_log` VALUES (10482, 1, 'admin', 'admin', '/admin/admin/adminlog?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172592);
INSERT INTO `oc_admin_log` VALUES (10483, 1, 'admin', 'admin', '/admin/admin/deladminlog', '{\"id\":[\"10481\",\"10480\",\"10479\",\"10338\",\"10337\",\"10336\",\"10335\",\"10334\",\"10333\",\"10332\",\"10331\",\"10330\",\"10329\",\"10328\",\"10327\",\"10326\",\"10325\",\"10324\",\"10323\",\"10322\"]}', '删除管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172595);
INSERT INTO `oc_admin_log` VALUES (10484, 1, 'admin', 'admin', '/admin/admin/adminlog?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取管理日志', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172595);
INSERT INTO `oc_admin_log` VALUES (10485, 1, 'admin', 'admin', '/admin/html/template', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172613);
INSERT INTO `oc_admin_log` VALUES (10486, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172615);
INSERT INTO `oc_admin_log` VALUES (10487, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172615);
INSERT INTO `oc_admin_log` VALUES (10488, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172656);
INSERT INTO `oc_admin_log` VALUES (10489, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172656);
INSERT INTO `oc_admin_log` VALUES (10490, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172659);
INSERT INTO `oc_admin_log` VALUES (10491, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172659);
INSERT INTO `oc_admin_log` VALUES (10492, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172692);
INSERT INTO `oc_admin_log` VALUES (10493, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172767);
INSERT INTO `oc_admin_log` VALUES (10494, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172767);
INSERT INTO `oc_admin_log` VALUES (10495, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172790);
INSERT INTO `oc_admin_log` VALUES (10496, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172791);
INSERT INTO `oc_admin_log` VALUES (10497, 1, 'admin', 'admin', '/admin/html/material', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172808);
INSERT INTO `oc_admin_log` VALUES (10498, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172835);
INSERT INTO `oc_admin_log` VALUES (10499, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172835);
INSERT INTO `oc_admin_log` VALUES (10500, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172871);
INSERT INTO `oc_admin_log` VALUES (10501, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172909);
INSERT INTO `oc_admin_log` VALUES (10502, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172913);
INSERT INTO `oc_admin_log` VALUES (10503, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172924);
INSERT INTO `oc_admin_log` VALUES (10504, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172947);
INSERT INTO `oc_admin_log` VALUES (10505, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172954);
INSERT INTO `oc_admin_log` VALUES (10506, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172955);
INSERT INTO `oc_admin_log` VALUES (10507, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172962);
INSERT INTO `oc_admin_log` VALUES (10508, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172962);
INSERT INTO `oc_admin_log` VALUES (10509, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172973);
INSERT INTO `oc_admin_log` VALUES (10510, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172973);
INSERT INTO `oc_admin_log` VALUES (10511, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172992);
INSERT INTO `oc_admin_log` VALUES (10512, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172992);
INSERT INTO `oc_admin_log` VALUES (10513, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172994);
INSERT INTO `oc_admin_log` VALUES (10514, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172994);
INSERT INTO `oc_admin_log` VALUES (10515, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544172996);
INSERT INTO `oc_admin_log` VALUES (10516, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173012);
INSERT INTO `oc_admin_log` VALUES (10517, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173033);
INSERT INTO `oc_admin_log` VALUES (10518, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173048);
INSERT INTO `oc_admin_log` VALUES (10519, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173065);
INSERT INTO `oc_admin_log` VALUES (10520, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173076);
INSERT INTO `oc_admin_log` VALUES (10521, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173092);
INSERT INTO `oc_admin_log` VALUES (10522, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173108);
INSERT INTO `oc_admin_log` VALUES (10523, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173108);
INSERT INTO `oc_admin_log` VALUES (10524, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173120);
INSERT INTO `oc_admin_log` VALUES (10525, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173122);
INSERT INTO `oc_admin_log` VALUES (10526, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173232);
INSERT INTO `oc_admin_log` VALUES (10527, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173233);
INSERT INTO `oc_admin_log` VALUES (10528, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173242);
INSERT INTO `oc_admin_log` VALUES (10529, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173244);
INSERT INTO `oc_admin_log` VALUES (10530, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173720);
INSERT INTO `oc_admin_log` VALUES (10531, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544173721);
INSERT INTO `oc_admin_log` VALUES (10532, 1, 'admin', 'admin', '/admin/index/index', '', '后台首页', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544174550);
INSERT INTO `oc_admin_log` VALUES (10533, 1, 'admin', 'admin', '/admin/index/console', '', '仪表盘', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544174550);
INSERT INTO `oc_admin_log` VALUES (10534, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544174551);
INSERT INTO `oc_admin_log` VALUES (10535, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544174553);
INSERT INTO `oc_admin_log` VALUES (10536, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544174582);
INSERT INTO `oc_admin_log` VALUES (10537, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544174584);
INSERT INTO `oc_admin_log` VALUES (10538, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544174732);
INSERT INTO `oc_admin_log` VALUES (10539, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544174734);
INSERT INTO `oc_admin_log` VALUES (10540, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544176355);
INSERT INTO `oc_admin_log` VALUES (10541, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544176358);
INSERT INTO `oc_admin_log` VALUES (10542, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544176399);
INSERT INTO `oc_admin_log` VALUES (10543, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544176401);
INSERT INTO `oc_admin_log` VALUES (10544, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544177147);
INSERT INTO `oc_admin_log` VALUES (10545, 1, 'admin', 'admin', '/admin/html/index', '', '', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544177149);
INSERT INTO `oc_admin_log` VALUES (10546, 1, 'admin', 'admin', '/admin/action/actionlimit?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '获取用户行为限制列表', '', 2130706433, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Safari/537.36 Core/1.63.6756.400 QQBrowser/10.3.2565.400', 1544177150);

-- ----------------------------
-- Table structure for oc_common_adv
-- ----------------------------
DROP TABLE IF EXISTS `oc_common_adv`;
CREATE TABLE `oc_common_adv`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告名称',
  `pos_id` int(11) NOT NULL COMMENT '广告位置',
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片地址',
  `click_count` int(11) NOT NULL COMMENT '点击量',
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '链接地址',
  `sort` int(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '状态（0：禁用，1：正常）',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '开始时间',
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) UNSIGNED DEFAULT 0 COMMENT '结束时间',
  `target` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '_blank',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10000 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '广告表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oc_common_adv_pos
-- ----------------------------
DROP TABLE IF EXISTS `oc_common_adv_pos`;
CREATE TABLE `oc_common_adv_pos`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告位置名称',
  `path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '所在路径 模块/控制器/方法',
  `type` int(11) UNSIGNED NOT NULL DEFAULT 1 COMMENT '广告位类型 \r\n1.单图\r\n2.多图\r\n3.文字链接\r\n4.代码',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '状态（0：禁用，1：正常）',
  `data` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '额外的数据',
  `width` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告位置宽度',
  `height` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告位置高度',
  `margin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '边缘',
  `padding` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '留白',
  `theme` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'all' COMMENT '适用主题，默认为all，通用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10000 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '广告位置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oc_common_config
-- ----------------------------
DROP TABLE IF EXISTS `oc_common_config`;
CREATE TABLE `oc_common_config`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配置名称',
  `module` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块名',
  `controller` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '控制器名',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '配置类型',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '配置分组',
  `extra` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置说明',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '配置值',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 500 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `config_name`(`module`, `controller`, `name`) USING BTREE,
  INDEX `type`(`type`) USING BTREE,
  INDEX `group`(`group`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '配置表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_common_config
-- ----------------------------
INSERT INTO `oc_common_config` VALUES (1, 'register_type', 'admin', 'user', 0, '', 0, '', '', 0, 0, 1, 'normal', 0);
INSERT INTO `oc_common_config` VALUES (2, 'reg_switch', 'admin', 'user', 0, '', 0, '', '', 0, 0, 1, 'email,mobile', 0);
INSERT INTO `oc_common_config` VALUES (3, 'email_verify_type', 'admin', 'user', 0, '', 0, '', '', 0, 0, 1, '0', 0);
INSERT INTO `oc_common_config` VALUES (4, 'mobile_verify_type', 'admin', 'user', 0, '', 0, '', '', 0, 0, 1, '0', 0);

-- ----------------------------
-- Table structure for oc_common_ip_black_list
-- ----------------------------
DROP TABLE IF EXISTS `oc_common_ip_black_list`;
CREATE TABLE `oc_common_ip_black_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID',
  `ip` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'IP',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `ip`(`ip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'IP黑名单表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_common_picture
-- ----------------------------
DROP TABLE IF EXISTS `oc_common_picture`;
CREATE TABLE `oc_common_picture`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '状态',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `width` int(11) NOT NULL DEFAULT 0,
  `height` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_user
-- ----------------------------
DROP TABLE IF EXISTS `oc_user`;
CREATE TABLE `oc_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户组ID',
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `amount` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '余额',
  `reg_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册时间',
  `reg_ip` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册IP',
  `reg_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '注册终端',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `last_login_ip` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录IP',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1为用户名注册，2为邮箱注册，3为手机注册',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `username`(`username`) USING BTREE,
  INDEX `email`(`email`) USING BTREE,
  INDEX `mobile`(`mobile`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_user_action_limit
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_action_limit`;
CREATE TABLE `oc_user_action_limit`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `rule_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户权限id',
  `frequency` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '频率',
  `time_number` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '时间数量',
  `time_unit` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '时间单位类型 1-秒 2-分钟 3-小时 4-天 5-周 6-月 7-年',
  `punish_type` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '处罚类型 1-警告并禁止 2-强制退出登录 3-封停账户 4-封IP',
  `if_message` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否发送消息 0-否 1-是',
  `message_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '消息提示内容',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 -1-删除 0-禁用 1-启用',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rule_id`(`rule_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '行为限制表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_user_action_log
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_action_log`;
CREATE TABLE `oc_user_action_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `action_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '行为id',
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  `action_ip` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'ip',
  `model` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '触发行为的数据id',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '日志备注',
  `is_score` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否添加积分',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `action_ip`(`action_ip`) USING BTREE,
  INDEX `action_id`(`action_id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '行为日志表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_user_count
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_count`;
CREATE TABLE `oc_user_count`  (
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  `score1` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分1',
  `score2` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分2',
  `score3` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分3',
  `score4` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分4',
  `score5` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分5',
  `score6` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分6',
  `score7` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分7',
  `score8` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分8',
  `score9` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分9',
  `score10` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '积分10',
  PRIMARY KEY (`uid`) USING BTREE,
  INDEX `score1`(`score1`) USING BTREE,
  INDEX `score2`(`score2`) USING BTREE,
  INDEX `score3`(`score3`) USING BTREE,
  INDEX `score4`(`score4`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户统计表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_user_log
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_log`;
CREATE TABLE `oc_user_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `module` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块名',
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '方法名',
  `param` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '参数 json',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '日志标题',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `ip` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'IP',
  `user_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'User-Agent',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `username`(`username`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户日志表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_user_role
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_role`;
CREATE TABLE `oc_user_role`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '角色名',
  `title` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `rules` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限节点',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户角色表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_user_role
-- ----------------------------
INSERT INTO `oc_user_role` VALUES (1, 0, '普通用户', '普通用户', '普通用户', '1,2,3', 0, 1544060605, 1544060605, 1);
INSERT INTO `oc_user_role` VALUES (2, 0, '游客', '游客', '游客', '', 0, 1544060605, 1544060605, 1);

-- ----------------------------
-- Table structure for oc_user_rule
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_rule`;
CREATE TABLE `oc_user_rule`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父ID',
  `module` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '规则所属module',
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文标题',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `condition` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 100 COMMENT '排序，默认升序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE,
  INDEX `remark`(`remark`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户权限表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_user_rule
-- ----------------------------
INSERT INTO `oc_user_rule` VALUES (1, 0, 'weibo', 'weibo/index/index', '微博首页', '', 1, '', 0, 1538288731, 100);
INSERT INTO `oc_user_rule` VALUES (2, 1, 'weibo', 'weibo/index/add', '发布微博', '', 1, '', 0, 0, 101);
INSERT INTO `oc_user_rule` VALUES (3, 1, 'weibo', 'weibo/index/sendlong', '发布长微博', '', 1, '', 0, 0, 102);

-- ----------------------------
-- Table structure for oc_user_score_log
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_score_log`;
CREATE TABLE `oc_user_score_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID',
  `ip` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'IP',
  `score_type` tinyint(2) UNSIGNED NOT NULL DEFAULT 1 COMMENT '积分类型 1-积分',
  `value` double NOT NULL DEFAULT 0 COMMENT '积分变动',
  `finally_value` double unsigned NOT NULL COMMENT '变更后积分',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `model` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模块名',
  `rule_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '权限id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `rule_id`(`rule_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户积分变动表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_user_score_rule
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_score_rule`;
CREATE TABLE `oc_user_score_rule`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `rule_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户权限id',
  `change_num` tinyint(3) NOT NULL DEFAULT 0 COMMENT '积分变动数量',
  `change_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '变动方式 1-加 2-减',
  `score_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '积分类型',
  `frequency` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '频率',
  `time_unit` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '时间单位类型 1-秒 2-分钟 3-小时 4-天 5-周 6-月 7-年',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 -1-删除 0-禁用 1-启用',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rule_id`(`rule_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '积分规则表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oc_user_score_type
-- ----------------------------
DROP TABLE IF EXISTS `oc_user_score_type`;
CREATE TABLE `oc_user_score_type`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 -1-删除 0-禁用 1-启用',
  `unit` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '单位',
  `intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '积分类型表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oc_user_score_type
-- ----------------------------
INSERT INTO `oc_user_score_type` VALUES (1, '积分', 1, '分', '用户的主积分，可用于兑换奖励，可增可减');
INSERT INTO `oc_user_score_type` VALUES (2, '威望', 1, '点', '代表用户在社区中的影响力，可增可减');
INSERT INTO `oc_user_score_type` VALUES (3, '经验值', 1, '点', '代表用户在社区中的贡献，可增可减');
INSERT INTO `oc_user_score_type` VALUES (4, '贡献', 1, '点', '用户累计的经验，用于统计用户的等级，一般只增不减');

SET FOREIGN_KEY_CHECKS = 1;
