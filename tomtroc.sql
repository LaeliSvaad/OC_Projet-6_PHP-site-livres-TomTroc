-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 18 juin 2025 à 16:39
-- Version du serveur : 5.7.44
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

CREATE TABLE `author` (
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `pseudo` varchar(40) DEFAULT NULL,
  `id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`firstname`, `lastname`, `pseudo`, `id`) VALUES
('Friedrich', 'Nietzsche', NULL, 1),
('Donatien Alphonse François', 'de Sade', 'Marquis de Sade', 2);

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `title` varchar(180) NOT NULL,
  `description` text,
  `picture` varchar(180) DEFAULT NULL,
  `author_id` smallint(5) UNSIGNED NOT NULL,
  `id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`title`, `description`, `picture`, `author_id`, `id`) VALUES
('Le gai savoir', 'Le Gai Savoir est un ouvrage de Friedrich Nietzsche, publié en 1882, sous le titre original Die fröhliche Wissenschaft, la gaya scienza. Le titre fait référence aux troubadours, l\'expression Gai Saber de laquelle dérive la gaya scienza étant une façon de dénommer en occitan l\'art de composer des poésies lyriques. L\'expression (« gai sçavoir ») fut très tôt reprise dans la littérature, par Rabelais dans Gargantua et Pantagruel', NULL, 1, 1),
('Ainsi parlait Zarathoustra', 'Ainsi parlait Zarathoustra ou Ainsi parla Zarathoustra, sous-titré « Un livre pour tous et pour personne » (en allemand : Also sprach Zarathustra. Ein Buch für Alle und Keinen), est un poème philosophique de Friedrich Nietzsche, publié en plusieurs volumes entre 1883 et 1885. ', NULL, 1, 2),
('La philosophie dans le boudoir', 'L’ouvrage se présente comme une série de dialogues retraçant l’éducation érotique et sexuelle d’une jeune fille de 15 ans.\r\n\r\nUne libertine, Mme de Saint-Ange, veut initier Eugénie de Mistival « dans les plus secrets mystères de Vénus ».\r\n\r\nElle est aidée en cela par son frère (le chevalier de Mirvel), un ami de son frère (Dolmancé) et par son jardinier (Augustin). ', NULL, 2, 3),
('Généalogie de la morale', ' Nietzsche se donne pour objectif de montrer d\'où proviennent les valeurs morales contemporaines et pourquoi nous devrions en changer pour des valeurs plus saines.', NULL, 1, 4),
('Justine ou les Malheurs de la vertu', 'Justine, ou les Malheurs de la vertu est un roman français du marquis de Sade publié de façon anonyme en 1791 à Paris, un an après que son auteur a été rendu à la liberté par la Révolution et l’abolition des lettres de cachet. ', NULL, 2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id_user_1` smallint(5) UNSIGNED NOT NULL,
  `id_user_2` smallint(5) UNSIGNED NOT NULL,
  `id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `library`
--

CREATE TABLE `library` (
  `book_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `status` enum('available','not available','reserved','') NOT NULL DEFAULT 'not available',
  `id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `library`
--

INSERT INTO `library` (`book_id`, `user_id`, `status`, `id`) VALUES
(1, 3, 'available', 1),
(2, 3, 'available', 2),
(3, 4, 'available', 3),
(4, 4, 'available', 4),
(5, 3, 'available', 5);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seen_by_recipient` tinyint(1) NOT NULL DEFAULT '0',
  `id_sender` smallint(5) UNSIGNED NOT NULL,
  `id_chat` smallint(5) UNSIGNED NOT NULL,
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `nickname` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(180) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`nickname`, `email`, `password`, `picture`, `registration_date`, `id`) VALUES
('Lisa', 'lisa.valade@hotmail.fr', '$2y$10$jx6YJ6nEwA0yKkUnNt3gVebV9Ip2y7bWwZj/e7E6A2aE8CVKaqlVC', NULL, '2025-06-04', 3),
('Lissaaaaaa', 'lisa.valade@orange.fr', '$2y$10$HbZIqZ84tshUME8H2AHe1.x/waMwBoGyaVbahwW7vMNoOZEJ5NmNm', NULL, '2025-06-04', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `author`
--
ALTER TABLE `author`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `library`
--
ALTER TABLE `library`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
