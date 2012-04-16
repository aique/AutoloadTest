/*
MySQL Data Transfer
Source Host: localhost
Source Database: autoload_test
Target Host: localhost
Target Database: autoload_test
Date: 16/04/2012 11:56:22
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(40) CHARACTER SET utf8 NOT NULL,
  `role` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'guest',
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `married` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `childNum` enum('4','3','2','1','0') NOT NULL DEFAULT '0',
  `jobDesc` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'juan', 'a9af13d55077b7ef35b7ffe4beb7b816', 'admin', '', '0', '0', 'Administrador');
INSERT INTO `user` VALUES ('2', 'paco', 'd739565e2c9f10787aeb219bb29a086c', 'guest', 'paco@gmail.com', '1', '2', 'Mecánico');
INSERT INTO `user` VALUES ('3', 'ana', '741d5ee67d7943f973e50379cddaaf02', 'guest', 'ana@mail.com', '0', '0', 'Administrativa');
INSERT INTO `user` VALUES ('4', 'maria', '0a5c122e35a1eefd9daf0e165713b857', 'admin', 'maria.perez@mail.com', '1', '2', 'Administradora');
