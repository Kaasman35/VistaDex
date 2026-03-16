-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 mrt 2026 om 09:13
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokedexdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`) VALUES
(1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(2) DEFAULT NULL,
  `dex_number` int(3) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `type1` varchar(8) DEFAULT NULL,
  `type2` varchar(8) DEFAULT NULL,
  `image_path` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `pokemon`
--

INSERT INTO `pokemon` (`id`, `dex_number`, `name`, `type1`, `type2`, `image_path`) VALUES
(1, 25, 'Pikachu', 'Electric', '', 'images/25.png'),
(2, 6, 'Charizard', 'Fire', 'Flying', 'images/6.png'),
(3, 9, 'Blastoise', 'Water', '', 'images/9.png'),
(4, 3, 'Venusaur', 'Grass', 'Poison', 'images/3.png'),
(5, 94, 'Gengar', 'Ghost', 'Poison', 'images/94.png'),
(6, 59, 'Arcanine', 'Fire', '', 'images/59.png'),
(7, 130, 'Gyarados', 'Water', 'Flying', 'images/130.png'),
(8, 131, 'Lapras', 'Water', 'Ice', 'images/131.png'),
(9, 149, 'Dragonite', 'Dragon', 'Flying', 'images/149.png'),
(10, 65, 'Alakazam', 'Psychic', '', 'images/65.png'),
(11, 68, 'Machamp', 'Fighting', '', 'images/68.png'),
(12, 71, 'Victreebel', 'Grass', 'Poison', 'images/71.png'),
(13, 76, 'Golem', 'Rock', 'Ground', 'images/76.png'),
(14, 45, 'Vileplume', 'Grass', 'Poison', 'images/45.png'),
(15, 62, 'Poliwrath', 'Water', 'Fighting', 'images/62.png'),
(16, 91, 'Cloyster', 'Water', 'Ice', 'images/91.png'),
(17, 34, 'Nidoking', 'Poison', 'Ground', 'images/34.png'),
(18, 31, 'Nidoqueen', 'Poison', 'Ground', 'images/31.png'),
(19, 57, 'Primeape', 'Fighting', '', 'images/57.png'),
(20, 28, 'Sandslash', 'Ground', '', 'images/28.png'),
(21, 53, 'Persian', 'Normal', '', 'images/53.png'),
(22, 115, 'Kangaskhan', 'Normal', '', 'images/115.png'),
(23, 122, 'Mr. Mime', 'Psychic', 'Fairy', 'images/122.png'),
(24, 124, 'Jynx', 'Ice', 'Psychic', 'images/124.png'),
(25, 125, 'Electabuzz', 'Electric', '', 'images/125.png'),
(26, 126, 'Magmar', 'Fire', '', 'images/126.png'),
(27, 127, 'Pinsir', 'Bug', '', 'images/127.png'),
(28, 128, 'Tauros', 'Normal', '', 'images/128.png'),
(29, 143, 'Snorlax', 'Normal', '', 'images/143.png'),
(30, 142, 'Aerodactyl', 'Rock', 'Flying', 'images/142.png'),
(31, 141, 'Kabutops', 'Rock', 'Water', 'images/141.png'),
(32, 139, 'Omastar', 'Rock', 'Water', 'images/139.png'),
(33, 121, 'Starmie', 'Water', 'Psychic', 'images/121.png'),
(34, 112, 'Rhydon', 'Ground', 'Rock', 'images/112.png'),
(35, 110, 'Weezing', 'Poison', '', 'images/110.png'),
(36, 103, 'Exeggutor', 'Grass', 'Psychic', 'images/103.png'),
(37, 101, 'Electrode', 'Electric', '', 'images/101.png'),
(38, 99, 'Kingler', 'Water', '', 'images/99.png'),
(39, 97, 'Hypno', 'Psychic', '', 'images/97.png'),
(40, 95, 'Onix', 'Rock', 'Ground', 'images/95.png'),
(41, 93, 'Haunter', 'Ghost', 'Poison', 'images/93.png'),
(42, 89, 'Muk', 'Poison', '', 'images/89.png'),
(43, 87, 'Dewgong', 'Water', 'Ice', 'images/87.png'),
(44, 85, 'Dodrio', 'Normal', 'Flying', 'images/85.png'),
(45, 82, 'Magneton', 'Electric', 'Steel', 'images/82.png'),
(46, 80, 'Slowbro', 'Water', 'Psychic', 'images/80.png'),
(47, 78, 'Rapidash', 'Fire', '', 'images/78.png'),
(48, 73, 'Tentacruel', 'Water', 'Poison', 'images/73.png'),
(49, 70, 'Weepinbell', 'Grass', 'Poison', 'images/70.png'),
(50, 64, 'Kadabra', 'Psychic', '', 'images/64.png'),
(NULL, 759, 'Stufful', 'Normal', 'Fighting', 'images/0759.pn'),
(NULL, 129, 'Magikarp', 'Water', NULL, 'images/129.png');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
