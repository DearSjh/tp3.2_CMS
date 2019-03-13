/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : cms1

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-08-09 15:50:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jkd_ad`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_ad`;
CREATE TABLE `jkd_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_explain` varchar(60) NOT NULL COMMENT '广告说明',
  `ad_img_src` varchar(255) NOT NULL COMMENT '广告图片地址',
  `ad_img_width` varchar(30) NOT NULL COMMENT '广告(宽)',
  `ad_img_height` varchar(30) NOT NULL COMMENT '广告(高) ',
  `ad_img_alt` varchar(30) NOT NULL COMMENT 'alt 属性',
  `ad_url` varchar(255) NOT NULL COMMENT '跳转链接',
  `click` int(11) NOT NULL COMMENT '点击量',
  `sort` int(11) NOT NULL COMMENT '排序',
  `publish_time` int(10) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='广告表';

-- ----------------------------
-- Records of jkd_ad
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_admin`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_admin`;
CREATE TABLE `jkd_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '管理员帐号',
  `email` varchar(60) NOT NULL,
  `password` char(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一次登录时间',
  `loginip` char(20) NOT NULL DEFAULT '' COMMENT '上一次登录的IP',
  `uplock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1:锁定   0:未锁定',
  `question_id` tinyint(1) NOT NULL COMMENT '问题ID',
  `question_answer` varchar(30) NOT NULL COMMENT '问题答案',
  PRIMARY KEY (`id`),
  KEY `account` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of jkd_admin
-- ----------------------------
INSERT INTO `jkd_admin` VALUES ('1', 'admin', '', '287403a02beae2cd647232f187301b69', '1470728631', '0.0.0.0', '0', '4', 'php0225');

-- ----------------------------
-- Table structure for `jkd_admin_nav`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_admin_nav`;
CREATE TABLE `jkd_admin_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(30) NOT NULL COMMENT '导航名',
  `nav_type` tinyint(1) NOT NULL COMMENT '所属导航',
  `nav_url` varchar(255) NOT NULL COMMENT '字段名称',
  `sort` smallint(5) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:隐藏1:显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台导航表';

-- ----------------------------
-- Records of jkd_admin_nav
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_article`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_article`;
CREATE TABLE `jkd_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '这是我自己弄得跟你没关系',
  `keywords` varchar(100) DEFAULT NULL COMMENT '文章关键字',
  `description` varchar(200) DEFAULT NULL COMMENT '文章描述',
  `status` tinyint(1) DEFAULT '0' COMMENT '文章状态',
  `summary` varchar(255) DEFAULT NULL COMMENT '文章摘要',
  `published` int(10) DEFAULT NULL COMMENT '发布时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `content` text COMMENT '文章内容',
  `lang` char(5) NOT NULL DEFAULT 'zh-cn' COMMENT '语言包',
  `click` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `is_m` tinyint(1) DEFAULT '1' COMMENT '手机端状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of jkd_article
-- ----------------------------
INSERT INTO `jkd_article` VALUES ('1', '10', '/cms1/public/upload/image/article/20160809/20160809094800_86747.png', 'sdffdsfasd', '', 'dsfaf', '0', 'sdfdsf', '1470728922', null, '<p>sdfdsf</p>', 'zh-cn', '986', '1');
INSERT INTO `jkd_article` VALUES ('2', '10', '/cms1/public/upload/image/article/20160809/20160809094800_86747.png', 'sdffdsfasd_这是我复制的', '', 'dsfaf', '0', 'sdfdsf', '1470728950', null, '<p>sdfdsf</p>', 'zh-cn', '986', '1');

-- ----------------------------
-- Table structure for `jkd_article_extend_fields`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_article_extend_fields`;
CREATE TABLE `jkd_article_extend_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_explain` varchar(80) NOT NULL COMMENT '表单说明',
  `field_name` varchar(250) NOT NULL COMMENT '字段名称',
  `field_type` int(11) DEFAULT NULL COMMENT '0:单行文本1:多行文本2:编辑器3:下拉列表4:radio 5:多选列表6:多选按钮7:文件上传',
  `set_option` mediumtext NOT NULL COMMENT '显示文本|值',
  `default_option` varchar(255) NOT NULL COMMENT '表单默认值',
  `sort` smallint(5) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:隐藏1:显示',
  `css` varchar(255) NOT NULL DEFAULT '' COMMENT 'css样式控制',
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章模型表';

-- ----------------------------
-- Records of jkd_article_extend_fields
-- ----------------------------
INSERT INTO `jkd_article_extend_fields` VALUES ('2', '标题', 'title', '0', '', '这是我自己弄得跟你没关系', '0', '1', '');

-- ----------------------------
-- Table structure for `jkd_article_extend_show`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_article_extend_show`;
CREATE TABLE `jkd_article_extend_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '栏目ID',
  `field_id` int(11) DEFAULT NULL COMMENT '扩展字段ID',
  `is_show` tinyint(11) DEFAULT '0' COMMENT '0:不显示1：显示',
  `sort` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章模型状态表';

-- ----------------------------
-- Records of jkd_article_extend_show
-- ----------------------------
INSERT INTO `jkd_article_extend_show` VALUES ('2', '10', '2', '0', '0');

-- ----------------------------
-- Table structure for `jkd_banner`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_banner`;
CREATE TABLE `jkd_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `explain` varchar(60) NOT NULL COMMENT '广告说明',
  `type` smallint(5) NOT NULL COMMENT '所属分类',
  `img_src` varchar(255) NOT NULL COMMENT '广告图片地址',
  `img_alt` varchar(30) NOT NULL COMMENT 'alt 属性',
  `url` varchar(255) NOT NULL COMMENT '跳转链接',
  `sort` int(11) NOT NULL COMMENT '排序',
  `publish_time` int(10) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='轮播表';

-- ----------------------------
-- Records of jkd_banner
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_banner_menu`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_banner_menu`;
CREATE TABLE `jkd_banner_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) DEFAULT NULL COMMENT '分类名',
  `pid` int(10) DEFAULT NULL COMMENT '父级分类ID',
  `sort` smallint(5) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='轮播分类表';

-- ----------------------------
-- Records of jkd_banner_menu
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_friendlink`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_friendlink`;
CREATE TABLE `jkd_friendlink` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `sort` tinyint(3) NOT NULL COMMENT '排序',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `url` varchar(255) NOT NULL COMMENT 'url',
  `description` mediumtext NOT NULL COMMENT '解释说明',
  `logo` varchar(255) NOT NULL COMMENT 'logo',
  `type` tinyint(3) NOT NULL COMMENT '分组',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Records of jkd_friendlink
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_menu`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_menu`;
CREATE TABLE `jkd_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) DEFAULT NULL COMMENT '栏目名',
  `pid` int(10) DEFAULT NULL COMMENT '父级分类ID',
  `sort` smallint(5) DEFAULT NULL COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '导航显示',
  `lang` char(5) NOT NULL DEFAULT 'zh-cn' COMMENT '语言',
  `target` tinyint(1) NOT NULL DEFAULT '1' COMMENT '打开方式',
  `content_model` varchar(30) NOT NULL COMMENT '内容模型',
  `show_default_fields` varchar(80) NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of jkd_menu
-- ----------------------------
INSERT INTO `jkd_menu` VALUES ('8', '分类一', '0', '100', '1', 'zh-cn', '1', 'article', '1|1|1|1|1|1|1|1|1', '', '', '');
INSERT INTO `jkd_menu` VALUES ('9', '分类二', '0', '100', '1', 'zh-cn', '1', '', '', '', '', '');
INSERT INTO `jkd_menu` VALUES ('10', '子2', '8', '100', '1', 'zh-cn', '1', 'article', '1|1|1|1|1|1|1|1|1|1', '', '', '');
INSERT INTO `jkd_menu` VALUES ('11', '子1', '8', '100', '1', 'zh-cn', '1', '', '', '', '', '');
INSERT INTO `jkd_menu` VALUES ('12', '孙子2', '10', '100', '1', 'zh-cn', '1', '', '', '', '', '');
INSERT INTO `jkd_menu` VALUES ('13', '孙子1', '10', '100', '1', 'zh-cn', '1', '', '', '', '', '');

-- ----------------------------
-- Table structure for `jkd_message`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_message`;
CREATE TABLE `jkd_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '姓名',
  `tel` varchar(32) NOT NULL COMMENT '电话',
  `content` text NOT NULL COMMENT '留言内容',
  `published` int(10) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言表';

-- ----------------------------
-- Records of jkd_message
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_message_extend_fields`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_message_extend_fields`;
CREATE TABLE `jkd_message_extend_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_explain` varchar(80) NOT NULL COMMENT '表单说明',
  `field_name` varchar(250) NOT NULL COMMENT '字段名称',
  `field_type` int(11) DEFAULT NULL COMMENT '0:单行文本1:多行文本2:编辑器3:下拉列表4:radio 5:多选列表6:多选按钮7:文件上传',
  `set_option` mediumtext NOT NULL COMMENT '显示文本|值',
  `default_option` varchar(255) NOT NULL COMMENT '表单默认值',
  `sort` smallint(5) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:隐藏1:显示',
  `css` varchar(255) NOT NULL DEFAULT '' COMMENT 'css样式控制',
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言模型表';

-- ----------------------------
-- Records of jkd_message_extend_fields
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_page`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_page`;
CREATE TABLE `jkd_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `title` varchar(255) DEFAULT NULL COMMENT '单页标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '单页关键字',
  `description` varchar(200) DEFAULT NULL COMMENT '单页描述',
  `published` int(10) DEFAULT NULL COMMENT '发布时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `content` text COMMENT '单页内容',
  `lang` char(5) NOT NULL DEFAULT 'zh-cn' COMMENT '语言包',
  `click` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='单页表';

-- ----------------------------
-- Records of jkd_page
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_page_extend_fields`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_page_extend_fields`;
CREATE TABLE `jkd_page_extend_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_explain` varchar(80) NOT NULL COMMENT '表单说明',
  `field_name` varchar(250) NOT NULL COMMENT '字段名称',
  `field_type` int(11) DEFAULT NULL COMMENT '0:单行文本1:多行文本2:编辑器3:下拉列表4:radio 5:多选列表6:多选按钮7:文件上传',
  `set_option` mediumtext NOT NULL COMMENT '显示文本|值',
  `default_option` varchar(255) NOT NULL COMMENT '表单默认值',
  `sort` smallint(5) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:隐藏1:显示',
  `css` varchar(255) NOT NULL DEFAULT '' COMMENT 'css样式控制',
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='单页模型表';

-- ----------------------------
-- Records of jkd_page_extend_fields
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_page_extend_show`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_page_extend_show`;
CREATE TABLE `jkd_page_extend_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '栏目ID',
  `field_id` int(11) DEFAULT NULL COMMENT '扩展字段ID',
  `is_show` tinyint(11) DEFAULT '0' COMMENT '0:不显示1：显示',
  `sort` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='单页模型状态表';

-- ----------------------------
-- Records of jkd_page_extend_show
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_product`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_product`;
CREATE TABLE `jkd_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `img` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '产品标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '产品关键字',
  `description` varchar(200) DEFAULT NULL COMMENT '产品描述',
  `status` tinyint(1) DEFAULT '0' COMMENT '产品状态',
  `summary` varchar(255) DEFAULT NULL COMMENT '产品摘要',
  `published` int(10) DEFAULT NULL COMMENT '发布时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `content` text COMMENT '产品内容',
  `lang` char(5) NOT NULL DEFAULT 'zh-cn' COMMENT '语言包',
  `click` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `is_m` tinyint(1) DEFAULT '1' COMMENT '手机端状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品表';

-- ----------------------------
-- Records of jkd_product
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_product_extend_fields`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_product_extend_fields`;
CREATE TABLE `jkd_product_extend_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_explain` varchar(80) NOT NULL COMMENT '表单说明',
  `field_name` varchar(250) NOT NULL COMMENT '字段名称',
  `field_type` int(11) DEFAULT NULL COMMENT '0:单行文本1:多行文本2:编辑器3:下拉列表4:radio 5:多选列表6:多选按钮7:文件上传',
  `set_option` mediumtext NOT NULL COMMENT '显示文本|值',
  `default_option` varchar(255) NOT NULL COMMENT '表单默认值',
  `sort` smallint(5) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:隐藏1:显示',
  `css` varchar(255) NOT NULL DEFAULT '' COMMENT 'css样式控制',
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品模型表';

-- ----------------------------
-- Records of jkd_product_extend_fields
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_product_extend_show`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_product_extend_show`;
CREATE TABLE `jkd_product_extend_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '栏目ID',
  `field_id` int(11) DEFAULT NULL COMMENT '扩展字段ID',
  `is_show` tinyint(11) DEFAULT '0' COMMENT '0:不显示1：显示',
  `sort` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品模型状态表';

-- ----------------------------
-- Records of jkd_product_extend_show
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_site_conf_extend_fields`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_site_conf_extend_fields`;
CREATE TABLE `jkd_site_conf_extend_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_explain` varchar(80) NOT NULL COMMENT '表单说明',
  `field_name` varchar(250) NOT NULL COMMENT '字段名称',
  `field_type` int(11) DEFAULT NULL COMMENT '0:单行文本1:多行文本2:编辑器3:下拉列表4:radio 5:多选列表6:多选按钮7:文件上传',
  `set_option` mediumtext NOT NULL COMMENT '显示文本|值',
  `default_option` varchar(255) NOT NULL COMMENT '表单默认值',
  `sort` smallint(5) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:隐藏1:显示',
  `css` varchar(255) NOT NULL DEFAULT '' COMMENT 'css样式控制',
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='站点配置模型表';

-- ----------------------------
-- Records of jkd_site_conf_extend_fields
-- ----------------------------

-- ----------------------------
-- Table structure for `jkd_tag`
-- ----------------------------
DROP TABLE IF EXISTS `jkd_tag`;
CREATE TABLE `jkd_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `unique_id` char(20) NOT NULL,
  `content` text NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
-- Records of jkd_tag
-- ----------------------------
