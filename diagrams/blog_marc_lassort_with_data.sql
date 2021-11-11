-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 10 nov. 2021 à 20:24
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_marc_lassort`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `content` longtext NOT NULL,
  `creation_date` datetime NOT NULL,
  `is_valid` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `username`, `content`, `creation_date`, `is_valid`, `user_id`, `post_id`) VALUES
(6, 'nabulione', 'Cet article répondait à une de mes interrogations.', '2021-09-24 14:21:29', '0', 34, 1),
(8, 'marc.lassort', 'Ce n\'est pas exactement comme cela que je voyais la chose. ', '2021-09-24 14:26:38', '0', 22, 1),
(10, 'nabulione', 'Il y a d\'autres possibilités, cependant.', '2021-09-25 16:45:11', '0', 34, 1),
(11, 'nabulione', 'Ce commentaire a vocation à être détruit dans cinq secondes.', '2021-09-25 16:47:29', '0', 34, 1),
(12, 'nabulione', 'Il est certain que vous avez soulevé un point intéressant. ', '2021-10-01 16:33:12', '0', 34, 1),
(13, 'marc.lassort', 'Je voudrais vous signifier que je suis parfaitement d\'accord avec votre propos dans cet article.', '2021-10-08 15:26:27', '1', 22, 2),
(14, 'marc.lassort', 'Je voudrais vous signifier mon accord.', '2021-10-08 15:29:26', '1', 22, 2),
(16, 'marc.lassort', 'Je voudrais vous signifier mon accord avec le contenu de cet article.', '2021-10-08 15:34:11', '1', 22, 2),
(17, 'marc.lassort', 'Je soumets un commentaire pour vous accorder mon approbation. ', '2021-10-08 15:36:15', '1', 22, 3),
(20, 'thibaut.gruffy', 'Je me permets de vous apporter une légère contradiction : Lorem non ipsum dolor sit amet, consectetur adipiscing elit. ', '2021-11-10 21:15:55', '', 35, 6),
(22, 'thibaut.gruffy', 'Une métaphore pour ainsi dire tout à fait surprenante ! Merci pour ce beau moment de littérature !', '2021-11-10 21:19:11', '', 35, 5);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `author` varchar(45) NOT NULL,
  `creation_date` datetime NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `email_address` varchar(45) NOT NULL,
  `is_handled` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `author`, `creation_date`, `subject`, `content`, `email_address`, `is_handled`, `user_id`) VALUES
(8, 'Marc Lassort', '2021-11-07 18:41:17', 'Votre blog', 'J\'ai trouvé votre blog formidable. Bravo à vous. ', 'marc.lassort@gmail.com', '1', 22),
(11, 'Thibaut Gruffy', '2021-11-10 20:44:34', 'Vocation du site', 'Bonjour à vous,\r\nJe m\'interrogeais sur la vocation de votre blog professionnel : a-t-il pour but d\'attirer des employeurs potentiels, ou est-ce simplement un simple portfolio à destination de tout un chacun ? \r\nJe vous remercie par avance de votre réponse. ', 'marc.lassort01@gmail.com', '0', 22),
(12, 'Jean Daniel', '2021-11-10 20:47:00', 'Interrogation sur votre CV', 'Cher Monsieur,\r\nJ\'ai lu dans votre CV que vous étiez à la fois un développeur web, un community manager et un rédacteur de contenu. Je m\'interrogeais s\'il existait un terme qui permettrait de réunir ces trois parcours professionnels différents, et de savoir votre ambition professionnelle au-delà de ce détail.\r\nMerci à vous. ', 'marc.lassort@me.com', '0', 22);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `url` longtext NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `url`, `alt_text`, `name`, `post_id`) VALUES
(1, 'cabin.png', 'Cabin', 'Cabin', 1),
(2, 'cake.png', 'Cake', 'Cake', 2),
(3, 'circus.png', 'Circus', 'Circus', 3),
(4, 'game.png', 'Game', 'Game', 4),
(5, 'safe.png', 'Safe', 'Safe', 5),
(6, 'submarine.png', 'Submarine', 'Submarine', 6);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `blurb` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modif_date` datetime DEFAULT NULL,
  `content` longtext NOT NULL,
  `author` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `imageName` varchar(255) DEFAULT NULL,
  `imageAlt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `blurb`, `creation_date`, `modif_date`, `content`, `author`, `user_id`, `imageName`, `imageAlt`) VALUES
(1, 'Devenir un développeur PHP', 'Cet article vous explique tous les avantages à devenir un développeur PHP pour assurer votre insertion sur le marché du travail.', '2021-08-27 12:23:36', '2021-10-15 12:29:34', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '22', 22, 'cabin.png', 'Cabin'),
(2, 'Deuxième article', 'Le deuxième article', '2021-08-27 12:23:36', '2021-10-15 12:29:41', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '22', 22, 'cake.png', 'Cake'),
(3, 'Troisième article', 'Le troisième article', '2021-08-27 12:27:07', '2021-10-22 10:42:12', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '22', 22, 'circus.png', 'Circus'),
(4, 'Quatrième article', 'Le quatrième article', '2021-08-27 12:27:07', '2021-10-22 10:42:22', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '22', 22, 'game.png', 'Game'),
(5, 'Cinquième article', 'Le cinquième article', '2021-08-27 12:28:27', '2021-10-22 10:42:25', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '22', 22, 'safe.png', 'Safe'),
(6, 'Sixième article', 'Le sixième article', '2021-08-27 12:28:27', '2021-10-22 10:42:29', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '22', 22, 'submarine.png', 'Submarine');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `phone_number`, `email`, `password`, `role`, `token`, `isActive`, `image`) VALUES
(22, 'marc.lassort', 'Marc', 'Lassort', '0625341049', 'marc.lassort@gmail.com', '$2y$10$TuTeeHn8IFqAUo1lXCmlsu4c15eC5lGgPhZjkCQ3Tt6MqKt7wyW0y', 1, NULL, 1, 'avataaars.png'),
(34, 'nabulione', 'Jean', 'Daniel', '0625341049', 'marc.lassort@me.com', '$2y$10$4RXm.3/j/75HrJnX/KZDceDdwQg70eFyRRYsccIcSKCRmHvr.08wu', 0, 'ee7eb8f7-7b04-4f6b-8800-1995f7a1a436', 1, 'avataaars.png'),
(35, 'thibaut.gruffy', 'Thibaut', 'Gruffy', '0611111111', 'marc.lassort+01@gmail.com', '$2y$10$U4Ux82cEQarntitf5IKh0OP16UkjqGViKGON8OwJM.V.cjDQJmTcO', 1, 'a3258f90-d3e1-4326-9305-06297bbe48f4', 1, 'avataaars.png'),
(37, 'Marc', 'Marc', 'Lassort', '0625341049', 'marc.lassort@icloud.com', '$2y$10$v4dTlotZ4dZR71aSt5hHA.5q30/obWYzgY/DbqqwhdelDAwdfNgA6', 0, NULL, 1, 'avataaars.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment_user_idx` (`user_id`) USING BTREE,
  ADD KEY `fk_comment_post_idx` (`post_id`) USING BTREE;

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact_user1_idx` (`user_id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image_post1_idx` (`post_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_user_idx` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
