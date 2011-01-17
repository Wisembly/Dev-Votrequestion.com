-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 17 Janvier 2011 à 10:24
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `balloon_presencelist`
--

-- --------------------------------------------------------

--
-- Structure de la table `presencelist_hotesse`
--

CREATE TABLE `presencelist_hotesse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `real_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `presencelist_hotesse`
--


-- --------------------------------------------------------

--
-- Structure de la table `presencelist_main`
--

CREATE TABLE `presencelist_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nb_participants` mediumint(6) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `presencelist_main`
--


-- --------------------------------------------------------

--
-- Structure de la table `presencelist_status`
--

CREATE TABLE `presencelist_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `presencelist_id` int(11) NOT NULL,
  `hotesse_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(54) NOT NULL,
  `has_checked` int(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `presencelist_user`
--

