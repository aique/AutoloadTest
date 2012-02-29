/*
MySQL Data Transfer
Source Host: localhost
Source Database: autoload_test
Target Host: localhost
Target Database: autoload_test
Date: 29/02/2012 11:09:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'ana');
INSERT INTO `user` VALUES ('2', 'manuel');
INSERT INTO `user` VALUES ('3', 'antonio');
