/*
Navicat MySQL Data Transfer

Source Server         : localhost8.0
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : xnadmin_v2.0

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2024-03-23 15:23:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xn_admin
-- ----------------------------
DROP TABLE IF EXISTS `xn_admin`;
CREATE TABLE `xn_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `email_code` varchar(60) DEFAULT NULL COMMENT '激活码',
  `phone` bigint(11) unsigned DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态 0：禁用； 1：正常',
  `register_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xn_admin
-- ----------------------------
INSERT INTO `xn_admin` VALUES ('1', 'admin', '24026eee8538c996f677ee775d316013', '', '', '', '13888888888', '1', '1449199996', '', '0', '小牛Admin后台管理系统，官网 xnadmin.cn');

-- ----------------------------
-- Table structure for xn_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `xn_admin_log`;
CREATE TABLE `xn_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `url` varchar(512) DEFAULT '',
  `remark` varchar(512) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `method` varchar(10) DEFAULT NULL,
  `param` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xn_admin_log
-- ----------------------------

-- ----------------------------
-- Table structure for xn_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `xn_auth_group`;
CREATE TABLE `xn_auth_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text COMMENT '规则id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of xn_auth_group
-- ----------------------------
INSERT INTO `xn_auth_group` VALUES ('1', '超级管理员', '1', '1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,14');

-- ----------------------------
-- Table structure for xn_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `xn_auth_group_access`;
CREATE TABLE `xn_auth_group_access` (
  `admin_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`admin_id`,`group_id`),
  KEY `uid` (`admin_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- ----------------------------
-- Records of xn_auth_group_access
-- ----------------------------
INSERT INTO `xn_auth_group_access` VALUES ('1', '1');

-- ----------------------------
-- Table structure for xn_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `xn_auth_rule`;
CREATE TABLE `xn_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT '0' COMMENT '父级id',
  `name` char(80) DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `is_menu` tinyint(1) unsigned DEFAULT '0' COMMENT '菜单显示',
  `condition` char(100) DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `type` tinyint(1) DEFAULT '1',
  `sort` int(5) DEFAULT '999',
  `icon` varchar(40) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of xn_auth_rule
-- ----------------------------
INSERT INTO `xn_auth_rule` VALUES ('1', '15', 'admin/auth/index', '权限控制', '1', '1', '', '1', '50', 'layui-icon-auz');
INSERT INTO `xn_auth_rule` VALUES ('2', '1', 'admin/auth/index', '权限管理', '1', '1', '', '1', '1', null);
INSERT INTO `xn_auth_rule` VALUES ('3', '2', 'admin/auth/add', '添加', '1', '0', '', '1', '2', null);
INSERT INTO `xn_auth_rule` VALUES ('4', '2', 'admin/auth/edit', '编辑', '1', '0', '', '1', '3', null);
INSERT INTO `xn_auth_rule` VALUES ('5', '2', 'admin/auth/delete', '删除', '1', '0', '', '1', '4', null);
INSERT INTO `xn_auth_rule` VALUES ('6', '1', 'admin/auth_group/index', '用户组管理', '1', '1', '', '1', '999', '');
INSERT INTO `xn_auth_rule` VALUES ('7', '6', 'admin/auth_group/add', '添加', '1', '0', '', '1', '999', '');
INSERT INTO `xn_auth_rule` VALUES ('8', '6', 'admin/auth_group/edit', '编辑', '1', '0', '', '1', '999', '');
INSERT INTO `xn_auth_rule` VALUES ('9', '6', 'admin/auth_group/delete', '删除', '1', '0', '', '1', '39', '');
INSERT INTO `xn_auth_rule` VALUES ('10', '1', 'admin/admin/index', '后台管理员', '1', '1', '', '1', '3', '');
INSERT INTO `xn_auth_rule` VALUES ('11', '10', 'admin/admin/add', '添加', '1', '0', '', '1', '999', null);
INSERT INTO `xn_auth_rule` VALUES ('12', '10', 'admin/admin/edit', '编辑', '1', '0', '', '1', '999', null);
INSERT INTO `xn_auth_rule` VALUES ('13', '10', 'admin/admin/delete', '删除', '1', '0', '', '1', '999', null);
INSERT INTO `xn_auth_rule` VALUES ('14', '0', 'admin/index/home', '管理首页', '1', '1', '', '1', '1', 'layui-icon-home');
INSERT INTO `xn_auth_rule` VALUES ('15', '0', 'admin/system', '系统管理', '1', '1', '', '1', '2000', 'layui-icon-set');
INSERT INTO `xn_auth_rule` VALUES ('16', '21', 'admin/config/base', '基本设置', '1', '0', '', '1', '999', '');
INSERT INTO `xn_auth_rule` VALUES ('17', '21', 'admin/config/upload', '上传配置', '1', '0', '', '1', '999', '');
INSERT INTO `xn_auth_rule` VALUES ('18', '0', 'admin/upload_files/index', '上传管理', '1', '1', '', '1', '1000', 'layui-icon-picture');
INSERT INTO `xn_auth_rule` VALUES ('19', '18', 'admin/upload_files/delete', '删除文件', '1', '0', '', '1', '999', '');
INSERT INTO `xn_auth_rule` VALUES ('21', '15', 'admin/config/index', '配置管理', '1', '1', '', '1', '999', '');
INSERT INTO `xn_auth_rule` VALUES ('22', '15', 'admin/admin_log/index', '日志管理', '1', '1', '', '1', '999', '');

-- ----------------------------
-- Table structure for xn_upload_class
-- ----------------------------
DROP TABLE IF EXISTS `xn_upload_class`;
CREATE TABLE `xn_upload_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xn_upload_class
-- ----------------------------
INSERT INTO `xn_upload_class` VALUES ('1', '分类1');
INSERT INTO `xn_upload_class` VALUES ('2', '分类2');

-- ----------------------------
-- Table structure for xn_upload_files
-- ----------------------------
DROP TABLE IF EXISTS `xn_upload_files`;
CREATE TABLE `xn_upload_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT '0' COMMENT '分类ID',
  `storage` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '存储位置',
  `app` smallint(4) DEFAULT '0' COMMENT '来自应用 0前台 1后台',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '根据app类型判断用户类型',
  `file_name` varchar(100) DEFAULT '',
  `file_size` int(11) DEFAULT '0',
  `extension` varchar(10) DEFAULT '' COMMENT '文件后缀',
  `url` varchar(500) DEFAULT '' COMMENT '图片路径',
  `create_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xn_upload_files
-- ----------------------------
INSERT INTO `xn_upload_files` VALUES ('4', '0', 'local', '1', '1', 'logo2.png', '9451', 'png', '/uploads/file/20240315/da57598f373af92b5494f9a6dc715fbe.png', '1710438952');
