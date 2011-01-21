-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 21 Janvier 2011 à 12:37
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

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
  `time` int(11) NOT NULL,
  `hotesse_id` mediumint(9) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT 'Check =1 /UnCheck =0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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

-- --------------------------------------------------------

--
-- Structure de la table `presencelist_user`
--

CREATE TABLE `presencelist_user` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `presencelist_id` mediumint(9) NOT NULL,
  `status_id` mediumint(9) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `has_checked` tinyint(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
