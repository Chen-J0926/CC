/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50037
Source Host           : localhost:3306
Source Database       : jju_book

Target Server Type    : MYSQL
Target Server Version : 50037
File Encoding         : 65001

Date: 2019-03-28 23:44:36
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tb_book`
-- ----------------------------
DROP TABLE IF EXISTS `tb_book`;
CREATE TABLE `tb_book` (
  `id` int(11) NOT NULL auto_increment,
  `bookName` varchar(255) default NULL,
  `bookTypeId` int(11) NOT NULL,
  `bookCaseId` int(11) NOT NULL,
  `bookPressId` int(11) NOT NULL,
  `bookAuthor` varchar(255) default NULL,
  `bookPrice` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_book
-- ----------------------------
INSERT INTO tb_book VALUES ('1', 'php实战', '1', '1', '1', '于广', '62');
INSERT INTO tb_book VALUES ('2', 'java数据结构', '2', '2', '2', '小光', '56.9');

-- ----------------------------
-- Table structure for `tb_bookborrow`
-- ----------------------------
DROP TABLE IF EXISTS `tb_bookborrow`;
CREATE TABLE `tb_bookborrow` (
  `id` int(11) NOT NULL auto_increment,
  `readerId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `borrowData` date NOT NULL,
  `returnFlag` int(1) NOT NULL,
  `returnData` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_bookborrow
-- ----------------------------
INSERT INTO tb_bookborrow VALUES ('1', '1', '1', '2019-03-21', '1', '2019-03-30');
INSERT INTO tb_bookborrow VALUES ('2', '2', '2', '2019-03-08', '0', '2019-04-07');
INSERT INTO tb_bookborrow VALUES ('3', '2', '1', '2019-03-14', '1', '2019-03-22');

-- ----------------------------
-- Table structure for `tb_booktype`
-- ----------------------------
DROP TABLE IF EXISTS `tb_booktype`;
CREATE TABLE `tb_booktype` (
  `id` int(11) NOT NULL auto_increment,
  `typeName` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_booktype
-- ----------------------------
INSERT INTO tb_booktype VALUES ('1', '程序语言设计');
INSERT INTO tb_booktype VALUES ('2', '数据结构');

-- ----------------------------
-- Table structure for `tb_case`
-- ----------------------------
DROP TABLE IF EXISTS `tb_case`;
CREATE TABLE `tb_case` (
  `id` int(11) NOT NULL auto_increment,
  `caseName` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_case
-- ----------------------------
INSERT INTO tb_case VALUES ('1', 'php');
INSERT INTO tb_case VALUES ('2', 'java');

-- ----------------------------
-- Table structure for `tb_library`
-- ----------------------------
DROP TABLE IF EXISTS `tb_library`;
CREATE TABLE `tb_library` (
  `id` int(11) NOT NULL,
  `libraryName` varchar(255) default NULL,
  `curator` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `URL` varchar(255) default NULL,
  `introduce` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_library
-- ----------------------------
INSERT INTO tb_library VALUES ('1', '天天', '小天', '江西', '1234', 'www.tt', '尚学');

-- ----------------------------
-- Table structure for `tb_logintype`
-- ----------------------------
DROP TABLE IF EXISTS `tb_logintype`;
CREATE TABLE `tb_logintype` (
  `id` int(11) NOT NULL auto_increment,
  `typeName` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_logintype
-- ----------------------------
INSERT INTO tb_logintype VALUES ('1', '学生');
INSERT INTO tb_logintype VALUES ('2', '教师');
INSERT INTO tb_logintype VALUES ('3', '管理员');

-- ----------------------------
-- Table structure for `tb_permission`
-- ----------------------------
DROP TABLE IF EXISTS `tb_permission`;
CREATE TABLE `tb_permission` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL,
  `manager` int(1) default NULL,
  `caseInfo` int(1) default NULL,
  `readerType` int(1) default NULL,
  `readerInfo` int(1) default NULL,
  `bookType` int(1) default NULL,
  `bookInfo` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_permission
-- ----------------------------
INSERT INTO tb_permission VALUES ('2', '2', '0', '0', '0', '1', '0', '0');
INSERT INTO tb_permission VALUES ('3', '3', '1', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for `tb_press`
-- ----------------------------
DROP TABLE IF EXISTS `tb_press`;
CREATE TABLE `tb_press` (
  `id` int(11) NOT NULL auto_increment,
  `pressName` varchar(255) default NULL,
  `pressAddress` varchar(255) default NULL,
  `pressPhone` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_press
-- ----------------------------
INSERT INTO tb_press VALUES ('1', '九江学院出版社', '江西九江', '123');
INSERT INTO tb_press VALUES ('2', '北京大学出版社', '北京', '456');

-- ----------------------------
-- Table structure for `tb_stock`
-- ----------------------------
DROP TABLE IF EXISTS `tb_stock`;
CREATE TABLE `tb_stock` (
  `id` int(11) NOT NULL auto_increment,
  `bookSum` int(11) default NULL,
  `bookId` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_stock
-- ----------------------------
INSERT INTO tb_stock VALUES ('1', '80', '1');
INSERT INTO tb_stock VALUES ('2', '35', '2');

-- ----------------------------
-- Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `password` varchar(255) default NULL,
  `loginTypeId` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO tb_user VALUES ('1', '小明', '123', '1');
INSERT INTO tb_user VALUES ('2', '魏老师', '234', '2');
INSERT INTO tb_user VALUES ('3', 'admin', '345', '3');
