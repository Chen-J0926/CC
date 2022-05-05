/*
Navicat MySQL Data Transfer

Source Server         : abc
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : scores

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-04-21 11:08:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for score
-- ----------------------------
DROP TABLE IF EXISTS `score`;
CREATE TABLE `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Sno` int(11) DEFAULT NULL,
  `Tno` int(11) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of score
-- ----------------------------
INSERT INTO `score` VALUES ('1', '1001', '1', '81', '大学计算机基础', '大学计算机基础', '大一上');

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `Sno` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT '123',
  `sex` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1001', '学生1', '大二', '123', '女', '计算机');

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `Tno` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Tno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('1', '123');
