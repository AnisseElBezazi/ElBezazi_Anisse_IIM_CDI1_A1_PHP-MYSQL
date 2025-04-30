-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 30 avr. 2025 à 19:45
-- Version du serveur : 8.0.42
-- Version de PHP : 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `library`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `idbook` int NOT NULL,
  `title` varchar(75) NOT NULL,
  `author` varchar(75) NOT NULL,
  `date_publication` date NOT NULL,
  `category_idcategory` int NOT NULL,
  `disponible` int NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`idbook`, `title`, `author`, `date_publication`, `category_idcategory`, `disponible`) VALUES
(11, 'Sapiens', 'Yuval Noah Harari', '2011-01-01', 1, 10),
(12, 'L\'Alchimiste', 'Paulo Coelho', '1988-01-01', 1, 10),
(13, '1984', 'George Orwell', '1949-01-01', 1, 10),
(14, 'Le Petit Prince', 'Antoine de Saint-Exupéry', '1943-01-01', 1, 10),
(15, 'Père riche, père pauvre', 'Robert T. Kiyosaki', '1997-01-01', 1, 10),
(16, 'Thinking, Fast and Slow', 'Daniel Kahneman', '2011-01-01', 1, 10),
(17, 'La Peste', 'Albert Camus', '1947-01-01', 1, 10),
(18, 'Atomic Habits', 'James Clear', '2018-01-01', 1, 10),
(19, 'Crime et Châtiment', 'Fiodor Dostoïevski', '1866-01-01', 1, 10),
(20, 'Le Prophète', 'Khalil Gibran', '1923-01-01', 1, 10),
(24, 'Le rouge et le noir', 'Standall', '1945-01-01', 1, 10),
(25, 'One piece', 'Oda', '1975-01-01', 1, 10),
(29, 'Le Horla', 'Guy de Maupassant', '1987-01-01', 1, 10),
(32, 'aaza', 'zaza', '2025-05-09', 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `idcategory` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`idcategory`, `name`, `description`) VALUES
(1, 'Général', 'Catégorie par défaut pour les livres');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `Pseudo` varchar(20) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `Pseudo`, `email`, `password`) VALUES
(14, 'Anisse', 'anisse.elbezazi@gmail.com', '$2y$10$MA0xgH8eBaJXT5n81q76r.KBpwbuK2lVdKukS6gFAHgTQC9F/UcV.'),
(15, 'azertyuiop', 'Bonjour@gmail.com', '$2y$10$766pvEJes2wNfxHUd0tbde1IgfZKM7FCgRYWjCTO2D6ii7G.EM93S');

-- --------------------------------------------------------

--
-- Structure de la table `user_cartes`
--

CREATE TABLE `user_cartes` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `image` text,
  `type` varchar(50) DEFAULT NULL,
  `pv` int DEFAULT NULL,
  `capacite1` varchar(100) DEFAULT NULL,
  `description1` text,
  `capacite2` varchar(100) DEFAULT NULL,
  `description2` text,
  `favori` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user_cartes`
--

INSERT INTO `user_cartes` (`id`, `id_user`, `nom`, `image`, `type`, `pv`, `capacite1`, `description1`, `capacite2`, `description2`, `favori`) VALUES
(68, 14, 'wimpod', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/767.png', 'bug', 25, 'wimp-out', 'This Pokémon automatically switches out when its HP drops below half.', '', '', 0),
(69, 14, 'giratina-altered', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/487.gif', 'ghost', 150, 'pressure', 'Increases the PP cost of moves targetting the Pokémon by one.', 'telepathy', 'Protects against friendly Pokémon\'s damaging moves.', 0),
(71, 14, 'greninja', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/658.png', 'water', 72, 'torrent', 'Strengthens water moves to inflict 1.5× damage at 1/3 max HP or less.', 'protean', 'Changes the bearer\'s type to match each move it uses.', 1),
(72, 14, 'scraggy', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/559.gif', 'dark', 50, 'shed-skin', 'Has a 33% chance of curing any major status ailment after each turn.', 'moxie', 'Raises Attack one stage upon KOing a Pokémon.', 0),
(73, 14, 'ferrothorn', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/598.gif', 'grass', 74, 'iron-barbs', 'Damages attacking Pokémon for 1/8 their max HP on contact.', 'anticipation', 'Notifies all trainers upon entering battle if an opponent has a super-effective move, self destruct, explosion, or a one-hit KO move.', 0),
(74, 14, 'exeggutor', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/103.gif', 'grass', 95, 'chlorophyll', 'Doubles Speed during strong sunlight.', 'harvest', 'Has a 50% chance of restoring a used Berry after each turn if the Pokémon has held no items in the meantime.', 0),
(75, 14, 'mismagius', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/429.gif', 'ghost', 60, 'levitate', 'Evades ground moves.', '', '', 0),
(76, 14, 'salandit', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/757.png', 'poison', 48, 'corrosion', 'This Pokémon can inflict poison on Poison and Steel Pokémon.', 'oblivious', 'Prevents infatuation and protects against captivate.', 0),
(77, 15, 'chespin', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/650.png', 'grass', 56, 'overgrow', 'Strengthens grass moves to inflict 1.5× damage at 1/3 max HP or less.', 'bulletproof', 'Protects against bullet, ball, and bomb-based moves.', 0),
(81, 15, 'gengar', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/94.gif', 'ghost', 60, 'cursed-body', 'Has a 30% chance of Disabling any move that hits the Pokémon.', '', '', 1),
(82, 15, 'servine', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/496.gif', 'grass', 60, 'overgrow', 'Strengthens grass moves to inflict 1.5× damage at 1/3 max HP or less.', 'contrary', 'Inverts stat changes.', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`idbook`),
  ADD KEY `fk_book_category_idx` (`category_idcategory`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idcategory`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `user_cartes`
--
ALTER TABLE `user_cartes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `idbook` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `idcategory` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `user_cartes`
--
ALTER TABLE `user_cartes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_category` FOREIGN KEY (`category_idcategory`) REFERENCES `category` (`idcategory`);

--
-- Contraintes pour la table `user_cartes`
--
ALTER TABLE `user_cartes`
  ADD CONSTRAINT `user_cartes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
