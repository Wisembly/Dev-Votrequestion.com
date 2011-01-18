-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 18 Janvier 2011 à 15:26
-- Version du serveur: 5.1.44
-- Version de PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `balloon_presencelist`
--

-- --------------------------------------------------------

--
-- Structure de la table `presencelist_action`
--

CREATE TABLE `presencelist_action` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(9) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hotesse_id` mediumint(9) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT 'Check =1 /UnCheck =0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `presencelist_action`
--


-- --------------------------------------------------------

--
-- Structure de la table `presencelist_hotesse`
--

CREATE TABLE `presencelist_hotesse` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `real_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `presencelist_hotesse`
--

INSERT INTO `presencelist_hotesse` VALUES(1, 'toto', 'toto');

-- --------------------------------------------------------

--
-- Structure de la table `presencelist_main`
--

CREATE TABLE `presencelist_main` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nb_participants` mediumint(6) NOT NULL,
  `nb_arrive` mediumint(6) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `presencelist_main`
--

INSERT INTO `presencelist_main` VALUES(1, 0, 0, 'presence_list_test', 'ceci est un test');

-- --------------------------------------------------------

--
-- Structure de la table `presencelist_status`
--

CREATE TABLE `presencelist_status` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `value` varchar(32) NOT NULL,
  `class_css` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `presencelist_status`
--


-- --------------------------------------------------------

--
-- Structure de la table `presencelist_user`
--

CREATE TABLE `presencelist_user` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `presencelist_id` mediumint(9) NOT NULL,
  `hotesse_id` mediumint(9) DEFAULT NULL,
  `status_id` mediumint(9) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `has_checked` tinyint(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `presencelist_user`
--

INSERT INTO `presencelist_user` VALUES(1, 1, NULL, 1, 'philipp', 'nicolas', 0, '2011-01-18 15:26:27');
INSERT INTO `presencelist_user` VALUES(2, 1, NULL, 1, 'nova', 'mamie', 0, '2011-01-18 15:26:27');
INSERT INTO `presencelist_user` VALUES(3, 1, NULL, 1, 'vador', 'dark', 0, '2011-01-18 15:26:27');
INSERT INTO `presencelist_user` VALUES(4, 1, NULL, 1, 'durand', 'christophe', 0, '2011-01-18 15:26:27');
