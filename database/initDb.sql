-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Létrehozva',
  `name` varchar(250) CHARACTER SET latin1 NOT NULL COMMENT 'Név',
  `desc` text CHARACTER SET latin1 COMMENT 'Megjegyzés',
  `filling_name` varchar(250) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Kitöltő neve',
  `result` json NOT NULL COMMENT 'Eredmény',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT 'Felhasználónév',
  `password` varchar(200) NOT NULL COMMENT 'Jelszó',
  `email` varchar(400) NOT NULL COMMENT 'E-mail',
  `realname` varchar(500) NOT NULL COMMENT 'Név',
  `enabled` int(11) NOT NULL DEFAULT '1' COMMENT 'Engedélyezve',
  `created` date NOT NULL COMMENT 'Regisztrálva',
  `authkey` varchar(400) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '10',
  `lastlogin` datetime DEFAULT NULL COMMENT 'Utoljára bejelentkezve',
  `rfid` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `realname`, `enabled`, `created`, `authkey`, `role`, `lastlogin`, `rfid`) VALUES
(1, 'admin',  '$2y$13$d7SuGeaiOQn343GDL.DpD.BOIs7wtUuPmCtTyZo5hJfjDfQege.0u', 'admin@devop.hu', 'Admin',  1,  '2019-05-12', '7e8a6fb5-d864-11e7-94c8-843a4b64218c', 100,  '2019-05-12 11:05:26',  '');

-- 2019-05-14 19:21:13
