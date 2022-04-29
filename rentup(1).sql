-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 29 avr. 2022 à 13:36
-- Version du serveur : 8.0.28
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rentup`
--

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `id_property` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `property_type_id` int NOT NULL,
  `seller_id` int NOT NULL,
  PRIMARY KEY (`id_property`),
  KEY `id_property_type_idx` (`property_type_id`),
  KEY `id_seller_idx` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id_property`, `name`, `street`, `city`, `postal_code`, `state`, `country`, `price`, `status`, `create_time`, `image`, `property_type_id`, `seller_id`) VALUES
(1, 'Red Carpet', 'Zirak Road', 'Toronto', '2109', 'Otawa', 'Canada', 86534, 'A louer', '2022-04-10 13:40:20', 'CMDR6873.JPG', 2, 2),
(2, 'La legalette', '8 rue de la soif', 'La Gravelle', '53410', 'Mswdcsw&lt;sq', 'France', 102000, 'A louer', '2022-04-11 13:40:20', 'FDMM5392.JPG', 2, 2),
(102, 'sqdsqdsqdqsd', 'Eius blanditiis alia', 'Soluta esse ut quo ', 'Beatae qui amet nul', 'Ex aut assumenda lab', 'Repudiandae ullamco ', 314, 'A louer', '2022-04-29 13:01:20', 'IKXJ9125.JPG', 2, 3),
(106, 'Barrett Bass', 'Eos dolorum aut ani', 'Sunt enim in tenetur', 'Aut ex ipsum repudia', 'Ab minima aut dicta ', 'Sequi similique et q', 496, 'A louer', '2022-04-29 13:31:14', 'EDZZ9339.JPG', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `propertytype`
--

DROP TABLE IF EXISTS `propertytype`;
CREATE TABLE IF NOT EXISTS `propertytype` (
  `id_property_type` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` int NOT NULL DEFAULT '0',
  `picto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_property_type`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `propertytype`
--

INSERT INTO `propertytype` (`id_property_type`, `name`, `value`, `picto`) VALUES
(1, 'Maison', 200, 'fa fa-home'),
(2, 'Appartement', 310, 'fa fa-building'),
(3, 'Villa', 80, 'fa fa-briefcase');

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `id_seller` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_seller`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `seller`
--

INSERT INTO `seller` (`id_seller`, `first_name`, `last_name`, `location`, `email`, `password`, `phone`, `profile_picture`) VALUES
(1, 'Anne K.', 'Young', '2272 Briarwood, Drive ', 'aky@gmail.com', '1234', '0685913221', './images/team-2.jpg'),
(2, 'Harijeet M.', 'Siller', '498 Have Square, Canada', 'hms@gmail.com', '5678', '0621549104', './images/team-1.jpg'),
(3, 'Sargam S. ', 'Singh', '13 Brian Rive, Canada', 'sss@gmail.com', '91011', '0627985639', './images/team-4.jpg'),
(4, 'John', 'Durburg', '228 Krake Hope, Berlin', 'JD@gmail.com', '12134', '0689522681', './images/team-3.jpg'),
(5, 'Brian', 'Smith', '235 Belive View, New Jersey', 'bs@gmail.com', 'azer', '0698745924', './images/team-5.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `id_property_type` FOREIGN KEY (`property_type_id`) REFERENCES `propertytype` (`id_property_type`),
  ADD CONSTRAINT `id_seller` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id_seller`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
