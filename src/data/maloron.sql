/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50615
 Source Host           : localhost
 Source Database       : maloron

 Target Server Type    : MySQL
 Target Server Version : 50615
 File Encoding         : utf-8

*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `categorie_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `categorie` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `categories`
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES ('1', 'Desserts'), ('2', 'Entrées'), ('3', 'Plats');
COMMIT;

-- ----------------------------
--  Table structure for `commentaires`
-- ----------------------------
DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE `commentaires` (
  `commentaire_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recette_id` int(11) unsigned NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` tinyint(3) unsigned DEFAULT NULL,
  `commentateur` varchar(30) DEFAULT NULL,
  `commentaire` text,
  PRIMARY KEY (`commentaire_id`),
  KEY `note` (`note`),
  KEY `date_creation` (`date_creation`),
  KEY `recette_id` (`recette_id`),
  KEY `note_2` (`note`),
  KEY `date_creation_2` (`date_creation`),
  KEY `recette_id_2` (`recette_id`),
  CONSTRAINT `fk_recettes_commentaires` FOREIGN KEY (`recette_id`) REFERENCES `recettes` (`recette_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `difficulte`
-- ----------------------------
DROP TABLE IF EXISTS `difficulte`;
CREATE TABLE `difficulte` (
  `difficulte_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `difficulte` varchar(20) NOT NULL,
  PRIMARY KEY (`difficulte_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `difficulte`
-- ----------------------------
BEGIN;
INSERT INTO `difficulte` VALUES ('1', 'très facile'), ('2', 'facile'), ('3', 'moyen'), ('4', 'difficile'), ('5', 'très difficile');
COMMIT;

-- ----------------------------
--  Table structure for `ingredients`
-- ----------------------------
DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE `ingredients` (
  `ingredient_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ingredient` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `recette_ingredients`
-- ----------------------------
DROP TABLE IF EXISTS `recette_ingredients`;
CREATE TABLE `recette_ingredients` (
  `recette_id` int(11) unsigned NOT NULL,
  `ingredient_id` int(11) unsigned NOT NULL,
  `qt` smallint(6) DEFAULT NULL,
  `unite_id` smallint(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`recette_id`,`ingredient_id`),
  KEY `ingredient_id` (`ingredient_id`),
  KEY `unite_id` (`unite_id`),
  KEY `unite_id_2` (`unite_id`),
  CONSTRAINT `fk_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredient_id`),
  CONSTRAINT `fk_recette` FOREIGN KEY (`recette_id`) REFERENCES `recettes` (`recette_id`),
  CONSTRAINT `fk_unite` FOREIGN KEY (`unite_id`) REFERENCES `unites` (`unite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `recettes`
-- ----------------------------
DROP TABLE IF EXISTS `recettes`;
CREATE TABLE `recettes` (
  `recette_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recette` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `difficulte_id` tinyint(4) unsigned NOT NULL,
  `categorie_id` smallint(5) unsigned NOT NULL,
  `nb_personnes` tinyint(4) NOT NULL,
  PRIMARY KEY (`recette_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `difficulte` (`difficulte_id`),
  CONSTRAINT `fk_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`),
  CONSTRAINT `fk_difficulte` FOREIGN KEY (`difficulte_id`) REFERENCES `difficulte` (`difficulte_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `recettes`
-- ----------------------------
BEGIN;
INSERT INTO `recettes` VALUES ('1', 'test', 'aaa', '1', '1', '3'), ('2', 'test', 'aaaa', '1', '1', '4'), ('3', 'test', 'aaa', '1', '1', '4'), ('4', 'test', 'aaa', '1', '1', '4');
COMMIT;

-- ----------------------------
--  Table structure for `unites`
-- ----------------------------
DROP TABLE IF EXISTS `unites`;
CREATE TABLE `unites` (
  `unite_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(5) DEFAULT NULL,
  `unite` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`unite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password_hash` varchar(64) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  View structure for `vue_recettes`
-- ----------------------------
DROP VIEW IF EXISTS `vue_recettes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_recettes` AS select `recettes`.`recette_id` AS `recette_id`,`recettes`.`recette` AS `recette`,`recettes`.`description` AS `description`,`recettes`.`nb_personnes` AS `nb_personnes`,`categories`.`categorie` AS `categorie`,`difficulte`.`difficulte` AS `difficulte` from ((`recettes` join `difficulte` on((`recettes`.`difficulte_id` = `difficulte`.`difficulte_id`))) join `categories` on((`recettes`.`categorie_id` = `categories`.`categorie_id`)));

SET FOREIGN_KEY_CHECKS = 1;
