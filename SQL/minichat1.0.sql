-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 24 Juillet 2017 à 04:08
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `minichat`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `moment` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`id`, `pseudo`, `msg`, `moment`) VALUES
(1, 'YaatSuka', 'Hello World', '11/07/2017 11:06'),
(2, 'root', 'Hey you !', '11/07/2017 11:30'),
(3, 'admin1', 'Il est bon?', '11/07/2017 11:50'),
(4, 'admin2', 'I\'m new here !', '11/07/2017 11:56'),
(5, 'root', 'Coucou !', '11/07/2017 14:13'),
(6, 'root', 'jjj', '11/07/2017 14:13'),
(7, 'root', 'llll', '11/07/2017 14:13'),
(8, 'root', 'llll', '11/07/2017 14:13'),
(9, 'root', 'merde', '11/07/2017 14:14'),
(10, 'root', 'de la merde', '11/07/2017 14:14'),
(11, 'root', 'kjkjkj', '11/07/2017 14:14'),
(12, 'KidLover', 'j\'aime les enfants', '13/07/2017 13:58'),
(13, 'PretreDeNotreDame', 'Moi auss', '13/07/2017 13:58'),
(14, 'PretreDeNotreDame', 'i', '13/07/2017 13:58'),
(15, 'NotACop', 'Je peux avoir vos adresses?', '13/07/2017 13:59'),
(16, 'g11ans', 'qui a des bonbons?', '13/07/2017 14:00'),
(17, 'YaatSuka', 'Yoooooooooooo', '13/07/2017 15:54'),
(18, 'YaatSuka', 'Na piki ai aki le la akau na fai atu kua ave e le matagi                      ', '13/07/2017 15:54'),
(19, 'YaatSuka', 'yoo', '13/07/2017 16:25'),
(20, 'YaatSuka', 'hello ', '13/07/2017 16:28'),
(21, 'YaatSuka', 'yoo ', '13/07/2017 16:28'),
(22, 'YaatSuka', 'Test ', '13/07/2017 16:28'),
(23, 'root', 'Yooo', '24/07/2017 14:30');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `id_usr` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `path`, `id_usr`) VALUES
(1, './CSS/Images/avatars/2.png', 2),
(2, './CSS/Images/avatars/1.png', 1),
(3, './CSS/Images/avatars/3.jpg', 3),
(4, './CSS/Images/avatars/4.jpg', 4),
(5, './CSS/Images/avatars/6.png', 6),
(6, './CSS/Images/avatars/5.png', 5),
(7, './CSS/Images/avatars/7.png', 7),
(8, './CSS/Images/avatars/8.png', 8),
(9, './CSS/Images/avatars/9.png', 9),
(10, './CSS/Images/avatars/10.png', 10);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `mdp`) VALUES
(1, 'YaatSuka', '29051998'),
(2, 'root', 'root'),
(3, 'admin1', 'admin1'),
(4, 'admin2', 'admin2'),
(5, 'KidLover', '27081996k'),
(6, 'PretreDeNotreDame', '27081996'),
(7, 'NotACop', '2708'),
(8, 'g11ans', '2708'),
(9, 'test', 'test'),
(10, 'toto', 'toto');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
