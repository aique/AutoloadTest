/*
MySQL Data Transfer
Source Host: localhost
Source Database: autoload
Target Host: localhost
Target Database: autoload
Date: 16/04/2012 11:57:34
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
) ENGINE=InnoDB AUTO_INCREMENT=615 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'juan', 'a9af13d55077b7ef35b7ffe4beb7b816', 'admin', '', '0', '0', '');
INSERT INTO `user` VALUES ('5', 'juan1', 'a9af13d55077b7ef35b7ffe4beb7b816', 'guest', 'juan@mail.com', '0', '0', 'Empleado');
INSERT INTO `user` VALUES ('6', 'juan2', 'a9af13d55077b7ef35b7ffe4beb7b816', 'guest', 'juan@mail.com', '0', '0', 'Empleado');
INSERT INTO `user` VALUES ('8', 'jaun3', 'a9af13d55077b7ef35b7ffe4beb7b816', 'guest', 'juan@mail.com', '0', '0', 'Empleado');
INSERT INTO `user` VALUES ('9', 'juan3', 'a9af13d55077b7ef35b7ffe4beb7b816', 'guest', 'juan@mail.com', '0', '0', 'Empleado');
INSERT INTO `user` VALUES ('10', 'juan4', 'a9af13d55077b7ef35b7ffe4beb7b816', 'guest', 'juan', '0', '0', 'Empleado');
INSERT INTO `user` VALUES ('11', 'juan5', 'a9af13d55077b7ef35b7ffe4beb7b816', 'guest', 'juan@mail.com', '0', '0', 'Empleado');
INSERT INTO `user` VALUES ('12', 'juan6', 'a9af13d55077b7ef35b7ffe4beb7b816', 'guest', 'juan@mail.com', '0', '0', 'Empleado');
INSERT INTO `user` VALUES ('13', 'juan7', 'a9af13d55077b7ef35b7ffe4beb7b816', 'guest', 'juan@mail.com', '0', '0', 'Empleado');
INSERT INTO `user` VALUES ('605', 'paco', 'd739565e2c9f10787aeb219bb29a086c', 'guest', 'paco@gmail.com', '1', '2', 'Fontanero');
INSERT INTO `user` VALUES ('614', 'elena', '6113e9fcb5a187786e2813cb4d6f61eb', 'guest', 'elena@mail.com', '1', '1', 'Secretaria');
