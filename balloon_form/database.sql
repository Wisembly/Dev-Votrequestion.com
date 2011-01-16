-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 16 Janvier 2011 à 18:00
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `balloon_form`
--

-- --------------------------------------------------------

--
-- Structure de la table `form`
--

CREATE TABLE `form` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `form`
--

INSERT INTO `form` (`id`, `nom`, `description`) VALUES(1, 'Test 1', 'Premier test');

-- --------------------------------------------------------

--
-- Structure de la table `form_answer`
--

CREATE TABLE `form_answer` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(9) NOT NULL,
  `token` varchar(32) COLLATE utf8_bin NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Contenu de la table `form_answer`
--


-- --------------------------------------------------------

--
-- Structure de la table `form_item`
--

CREATE TABLE `form_item` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(9) NOT NULL,
  `type` varchar(15) COLLATE utf8_bin NOT NULL,
  `label` varchar(150) COLLATE utf8_bin NOT NULL,
  `is_required` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `form_item`
--

INSERT INTO `form_item` (`id`, `form_id`, `type`, `label`, `is_required`) VALUES(1, 1, 'text', 'Hello World!', 0);

-- --------------------------------------------------------

--
-- Structure de la table `form_item_answer`
--

CREATE TABLE `form_item_answer` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(9) NOT NULL,
  `form_item_id` mediumint(9) NOT NULL,
  `value` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Contenu de la table `form_item_answer`
--


-- --------------------------------------------------------

--
-- Structure de la table `form_item_option`
--

CREATE TABLE `form_item_option` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_form_item` mediumint(9) NOT NULL,
  `label` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Contenu de la table `form_item_option`
--

