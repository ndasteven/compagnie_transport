-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 09 mai 2023 à 02:32
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `compagnie_TP`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE `appartenir` (
  `id_vehicule` bigint(20) NOT NULL,
  `id_gare` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Destination`
--

CREATE TABLE `Destination` (
  `id_destination` bigint(20) NOT NULL,
  `depart_Ticket` varchar(100) DEFAULT NULL,
  `arrive_Destination` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Destination`
--

INSERT INTO `Destination` (`id_destination`, `depart_Ticket`, `arrive_Destination`) VALUES
(1, 'ABIDJAN', 'YAMOUSSOUKRO'),
(2, 'BOUAKE', 'KATIOLA');

-- --------------------------------------------------------

--
-- Structure de la table `Gare`
--

CREATE TABLE `Gare` (
  `id_gare` bigint(20) NOT NULL,
  `nom_Gare` varchar(200) DEFAULT NULL,
  `situation_geographique_Gare` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Gare`
--

INSERT INTO `Gare` (`id_gare`, `nom_Gare`, `situation_geographique_Gare`) VALUES
(1, 'UTB_COMPAGNIE', 'ABIDJAN'),
(2, 'MT_TRANSPORT', 'ABIDJAN');

-- --------------------------------------------------------

--
-- Structure de la table `Ticket`
--

CREATE TABLE `Ticket` (
  `id_ticket` bigint(20) NOT NULL,
  `date_Ticket` datetime DEFAULT NULL,
  `numero_Ticket` bigint(20) DEFAULT NULL,
  `code_Ticket` varchar(100) DEFAULT NULL,
  `prix_Ticket` double DEFAULT NULL,
  `id_utilisateurs` bigint(20) DEFAULT NULL,
  `id_destination` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Ticket`
--

INSERT INTO `Ticket` (`id_ticket`, `date_Ticket`, `numero_Ticket`, `code_Ticket`, `prix_Ticket`, `id_utilisateurs`, `id_destination`) VALUES
(1, '2023-05-08 19:53:56', 1, '0505', 5000, 1, 1),
(2, '2023-05-08 23:41:10', 2, '0512', 3000, 2, 1),
(3, '2023-05-08 23:43:11', 3, '0984', 4000, 1, 2),
(4, '2023-05-08 23:43:11', 2313, 'ZETZ', 3000, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `id_utilisateurs` bigint(20) NOT NULL,
  `nom_Utilisateurs` varchar(100) DEFAULT NULL,
  `prenom_Utilisateurs` varchar(100) DEFAULT NULL,
  `date_naissance_Utilisateurs` date DEFAULT NULL,
  `login_Utilisateurs` varchar(50) DEFAULT NULL,
  `password_Utilisateurs` varchar(50) DEFAULT NULL,
  `tel_Utilisateurs` varchar(20) NOT NULL,
  `id_gare` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`id_utilisateurs`, `nom_Utilisateurs`, `prenom_Utilisateurs`, `date_naissance_Utilisateurs`, `login_Utilisateurs`, `password_Utilisateurs`, `tel_Utilisateurs`, `id_gare`) VALUES
(1, 'N\'GUESSAN', 'STEVEN', '1960-05-05', 'ndasteven', '05050505', '0707070707', 1),
(2, 'kouakou', 'boris', '2023-05-03', 'kouakou', '00000000', '07070707', 2),
(3, 'kouassi', 'stephane', '2023-05-13', 'kouass', '0000000', '0707070707', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Vehicule`
--

CREATE TABLE `Vehicule` (
  `id_vehicule` bigint(20) NOT NULL,
  `matricule_Vehicule` varchar(100) DEFAULT NULL,
  `modele_Vehicule` varchar(200) DEFAULT NULL,
  `marque_Vehicule` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`id_vehicule`,`id_gare`),
  ADD KEY `FK_appartenir_id_gare` (`id_gare`);

--
-- Index pour la table `Destination`
--
ALTER TABLE `Destination`
  ADD PRIMARY KEY (`id_destination`);

--
-- Index pour la table `Gare`
--
ALTER TABLE `Gare`
  ADD PRIMARY KEY (`id_gare`);

--
-- Index pour la table `Ticket`
--
ALTER TABLE `Ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `FK_Ticket_id_utilisateurs` (`id_utilisateurs`),
  ADD KEY `FK_Ticket_id_destination` (`id_destination`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`id_utilisateurs`),
  ADD KEY `FK_Utilisateurs_id_gare` (`id_gare`);

--
-- Index pour la table `Vehicule`
--
ALTER TABLE `Vehicule`
  ADD PRIMARY KEY (`id_vehicule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appartenir`
--
ALTER TABLE `appartenir`
  MODIFY `id_vehicule` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Destination`
--
ALTER TABLE `Destination`
  MODIFY `id_destination` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Gare`
--
ALTER TABLE `Gare`
  MODIFY `id_gare` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Ticket`
--
ALTER TABLE `Ticket`
  MODIFY `id_ticket` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `id_utilisateurs` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Vehicule`
--
ALTER TABLE `Vehicule`
  MODIFY `id_vehicule` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `FK_appartenir_id_gare` FOREIGN KEY (`id_gare`) REFERENCES `Gare` (`id_gare`),
  ADD CONSTRAINT `FK_appartenir_id_vehicule` FOREIGN KEY (`id_vehicule`) REFERENCES `Vehicule` (`id_vehicule`);

--
-- Contraintes pour la table `Ticket`
--
ALTER TABLE `Ticket`
  ADD CONSTRAINT `FK_Ticket_id_destination` FOREIGN KEY (`id_destination`) REFERENCES `Destination` (`id_destination`),
  ADD CONSTRAINT `FK_Ticket_id_utilisateurs` FOREIGN KEY (`id_utilisateurs`) REFERENCES `Utilisateurs` (`id_utilisateurs`);

--
-- Contraintes pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD CONSTRAINT `FK_Utilisateurs_id_gare` FOREIGN KEY (`id_gare`) REFERENCES `Gare` (`id_gare`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
