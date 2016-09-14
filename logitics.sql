/*
Navicat MySQL Data Transfer

Source Server         : lawrence
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : logitics

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2016-09-14 19:07:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT '自增ID',
  `username` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '9uU0F31m6tC634iszYo3pe4WOAwJLzex', '$2y$13$/iEQ8KvYutwiRQhxDVIpHOxTrtL1cMPl3rl700D4T4Vk1OxY47Rna', null, 'admin@123.com', '10', '10', '1468741013', '1468741013');
INSERT INTO `admin` VALUES ('2', 'admin1', 'IgA6MdMhdNw1Xl88l-XmonUisVEZ3XhU', '$2y$13$BjqGLzFycuN7ZbQE5rCpKORULvevR2klOeZl1ChVPN7bmIlKG1h02', null, '', '10', '10', '0', '0');

-- ----------------------------
-- Table structure for `an_users`
-- ----------------------------
DROP TABLE IF EXISTS `an_users`;
CREATE TABLE `an_users` (
  `userid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` char(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `level` int(11) DEFAULT NULL,
  `password` char(64) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of an_users
-- ----------------------------
INSERT INTO `an_users` VALUES ('1', 'admin', '10', '9ad1049472de186ecda9d84cdea617e090ce092f');

-- ----------------------------
-- Table structure for `auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(64) COLLATE utf8_bin NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('人资经理', '1', '1468756997');

-- ----------------------------
-- Table structure for `auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_bin,
  `rule_name` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `data` text COLLATE utf8_bin,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/admin/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/assignment/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/assignment/assign', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/assignment/index', '2', null, null, null, '1468743031', '1468743031');
INSERT INTO `auth_item` VALUES ('/admin/assignment/revoke', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/assignment/view', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/default/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/default/index', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/menu/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/menu/create', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/menu/delete', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/menu/index', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/menu/update', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/menu/view', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/permission/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/permission/assign', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/permission/create', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/permission/delete', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/permission/index', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/permission/remove', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/permission/update', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/permission/view', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/role/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/role/assign', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/role/create', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/role/delete', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/role/index', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/role/remove', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/role/update', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/role/view', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/route/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/route/assign', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/route/create', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/route/index', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/route/refresh', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/route/remove', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/rule/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/rule/create', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/rule/delete', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/rule/index', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/rule/update', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/rule/view', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/*', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/activate', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/change-password', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/delete', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/index', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/login', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/logout', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/request-password-reset', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/reset-password', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/signup', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/admin/user/view', '2', null, null, null, '1468744124', '1468744124');
INSERT INTO `auth_item` VALUES ('/user/*', '2', null, null, null, '1468756804', '1468756804');
INSERT INTO `auth_item` VALUES ('/user/create', '2', null, null, null, '1468756804', '1468756804');
INSERT INTO `auth_item` VALUES ('/user/delete', '2', null, null, null, '1468756804', '1468756804');
INSERT INTO `auth_item` VALUES ('/user/index', '2', null, null, null, '1468756804', '1468756804');
INSERT INTO `auth_item` VALUES ('/user/update', '2', null, null, null, '1468756804', '1468756804');
INSERT INTO `auth_item` VALUES ('/user/view', '2', null, null, null, '1468756804', '1468756804');
INSERT INTO `auth_item` VALUES ('人资经理', '1', 0xE58FAFE4BBA5E6938DE4BD9CE794A8E688B7, null, null, '1468756932', '1468765045');
INSERT INTO `auth_item` VALUES ('添加管理员', '2', 0xE6B7BBE58AA0E7AEA1E79086E59198, null, null, '1468750140', '1468750140');
INSERT INTO `auth_item` VALUES ('用户管理', '2', 0xE794A8E688B7E7AEA1E79086, null, null, '1468756847', '1468756847');

-- ----------------------------
-- Table structure for `auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_bin NOT NULL,
  `child` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/default/index');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/permission/*');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/permission/assign');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/permission/create');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/permission/delete');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/permission/index');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/permission/remove');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/permission/update');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/permission/view');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/role/*');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/role/assign');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/role/create');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/role/delete');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/role/index');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/role/remove');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/role/update');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/admin/role/view');
INSERT INTO `auth_item_child` VALUES ('添加管理员', '/admin/user/*');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/user/*');
INSERT INTO `auth_item_child` VALUES ('用户管理', '/user/*');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/user/create');
INSERT INTO `auth_item_child` VALUES ('用户管理', '/user/create');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/user/delete');
INSERT INTO `auth_item_child` VALUES ('用户管理', '/user/delete');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/user/index');
INSERT INTO `auth_item_child` VALUES ('用户管理', '/user/index');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/user/update');
INSERT INTO `auth_item_child` VALUES ('用户管理', '/user/update');
INSERT INTO `auth_item_child` VALUES ('人资经理', '/user/view');
INSERT INTO `auth_item_child` VALUES ('用户管理', '/user/view');
INSERT INTO `auth_item_child` VALUES ('人资经理', '用户管理');

-- ----------------------------
-- Table structure for `auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for `brand`
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(32) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `model_name` varchar(32) DEFAULT NULL,
  `p_id` int(11) DEFAULT '0' COMMENT '所属的品牌id',
  `cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='商品品牌表';

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('6', 'iphone', '1', null, '0', '1');
INSERT INTO `brand` VALUES ('7', null, '2', 'iphone 6', '6', '1');
INSERT INTO `brand` VALUES ('8', null, '2', 'iphone 6s', '6', '1');
INSERT INTO `brand` VALUES ('9', '复仇者', '1', null, '0', '2');
INSERT INTO `brand` VALUES ('10', null, '2', 'small', '9', '2');
INSERT INTO `brand` VALUES ('11', null, '2', 'large', '9', '2');
INSERT INTO `brand` VALUES ('12', 'Sungxing', '1', null, '0', '1');
INSERT INTO `brand` VALUES ('13', null, '2', 'Galaxy Note 7', '12', '1');
INSERT INTO `brand` VALUES ('14', null, '2', 'Galaxy 6', '12', '1');
INSERT INTO `brand` VALUES ('15', '蜡笔小新', '1', null, '0', '2');
INSERT INTO `brand` VALUES ('16', null, '2', 'M', '15', '2');
INSERT INTO `brand` VALUES ('17', null, '2', 'L', '15', '2');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(32) DEFAULT NULL,
  `p_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '手机壳', '0');
INSERT INTO `category` VALUES ('2', 'T恤衫', '0');
INSERT INTO `category` VALUES ('3', '化妆品', '0');

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(32) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `brand_id` varchar(64) DEFAULT NULL,
  `model_id` varchar(64) DEFAULT NULL COMMENT '适用的型号id,以逗号链接',
  `group` varchar(20) DEFAULT NULL COMMENT '适用人群，男人或者女人',
  `goods_sn` int(8) unsigned zerofill DEFAULT NULL COMMENT '商品编号',
  `logo` varchar(64) DEFAULT NULL COMMENT '商品图片',
  `created_time` int(11) DEFAULT '0',
  `updated_time` int(11) DEFAULT '0',
  `cat_id` int(11) DEFAULT NULL,
  `goods_number` int(11) DEFAULT NULL,
  `price` decimal(10,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_time` (`created_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '复仇者系列手机壳1', '复仇者1', '复仇者1', '复仇者复仇者复仇者11', '6,12', '7,8,14', '1,0', '00010709', 'uploads/20160913/14737362051807.jpg', '1473390429', '1473841562', '1', '201', '5.00');
INSERT INTO `goods` VALUES ('2', '钢铁侠', '复仇者', '复仇者', '复仇者', '6,12', '7,14,13', '0,1', '00020818', 'uploads/20160909/14733904984733.jpg', '1473390498', null, '1', '25', '5.00');
INSERT INTO `goods` VALUES ('3', '复仇手机壳', '复仇', '复仇', '复仇', '6,12', '8,7,13,14', '0', '100011046', 'uploads/20160909/14733906466745.jpg', '1473390646', '1473756577', '1', '25', '5.00');
INSERT INTO `goods` VALUES ('4', '钢铁侠', '钢铁侠', '钢铁侠', '钢铁侠钢铁侠', '6', '7', '0', '100021147', 'uploads/20160909/14733907072097.jpg', '1473390707', null, '1', '23', '5.00');
INSERT INTO `goods` VALUES ('5', '复仇者系列手机壳11', '复仇者11', '复仇者11', '钢铁侠11', '6,12', '8,13', '1', '200031359', 'uploads/20160909/14734180218207.jpg', '1473390839', '1473418021', '1', '23', '5.00');
INSERT INTO `goods` VALUES ('6', '复仇者T恤', '复仇者T恤', '复仇者T恤', '复仇者T恤复仇者T恤复仇者T恤', '9', '10,11', '0,1', '00063620', 'uploads/20160909/14734173809725.jpg', '1473417380', null, '2', '45', '5.00');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '权限管理', null, '/admin/default/index', '1', null);
INSERT INTO `menu` VALUES ('3', '添加权限', '1', '/admin/permission/create', '2', null);
INSERT INTO `menu` VALUES ('4', '角色管理', null, '/admin/role/assign', '1', '{\"icon\": \"fa fa-user\", \"visible\":false}');
INSERT INTO `menu` VALUES ('5', '添加角色', '4', '/admin/role/create', '2', null);
INSERT INTO `menu` VALUES ('6', '修改权限', '1', '/admin/permission/update', '2', null);

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_bin NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1468768847');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(20) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT 'A2' COMMENT '产品代码，默认4PX标准',
  `des_country` varchar(20) DEFAULT NULL COMMENT '目的地国家',
  `buyer_id` smallint(6) DEFAULT NULL COMMENT '买家id',
  `tracking_id` varchar(64) DEFAULT NULL COMMENT '用户订阅时产生的tracking_id',
  `consignee` varchar(60) DEFAULT NULL COMMENT '收货人',
  `street` varchar(255) DEFAULT NULL COMMENT '收货人所在街道',
  `post` varchar(30) DEFAULT NULL COMMENT '邮编',
  `city` varchar(60) DEFAULT NULL COMMENT '收货人所在城市',
  `province` varchar(60) DEFAULT NULL COMMENT '收货人所在省份/州',
  `tel` int(11) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL COMMENT '收货人邮箱',
  `ename` varchar(250) DEFAULT NULL COMMENT '海关申报英文品名',
  `track_content` varchar(250) DEFAULT NULL COMMENT '追踪内容信息',
  `track_code` varchar(32) DEFAULT '未发货' COMMENT '订单状态',
  `tracking_number` varchar(120) DEFAULT NULL COMMENT '4PX返回的追踪码',
  `created_time` int(11) DEFAULT NULL COMMENT '订单创建时间',
  `updated_time` int(11) DEFAULT NULL COMMENT '订单修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '订单删除的时间',
  PRIMARY KEY (`id`),
  KEY `tracking_id` (`tracking_id`),
  KEY `create_time` (`created_time`),
  KEY `updated_time` (`updated_time`),
  KEY `delete_time` (`delete_time`),
  KEY `buyer_id` (`buyer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', '2009051291133', 'B1', 'US', '56', null, 'james', '2301 Briarcrest United States', '73533', 'Duncan', 'Oklahoma', '425684', 'james@gmail.com', 'PEN', '货物电子信息已经收到 Shipment information received', 'IR', 'RF172507568SG', '1473302720', null, null);

-- ----------------------------
-- Table structure for `order_goods`
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `goods_number` smallint(6) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品订单表';

-- ----------------------------
-- Records of order_goods
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '9uU0F31m6tC634iszYo3pe4WOAwJLzex', '$2y$13$/iEQ8KvYutwiRQhxDVIpHOxTrtL1cMPl3rl700D4T4Vk1OxY47Rna', null, 'admin@123.com', '10', '10', '1468741013', '1468741013');
INSERT INTO `user` VALUES ('2', 'admin1', 'IgA6MdMhdNw1Xl88l-XmonUisVEZ3XhU', '$2y$13$BjqGLzFycuN7ZbQE5rCpKORULvevR2klOeZl1ChVPN7bmIlKG1h02', null, 'azhuwc0914@qq.com', '10', '10', '1473179345', '1473179345');
