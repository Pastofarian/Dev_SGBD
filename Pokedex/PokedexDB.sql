-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2023 at 04:46 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PokedexDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `sprite` varchar(255) NOT NULL,
  `moves` text,
  `type` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pokemons`
--

INSERT INTO `pokemons` (`id`, `name`, `sprite`, `moves`, `type`) VALUES
(21, 'bulbasaur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png', '[\"razor-wind\",\"swords-dance\",\"cut\",\"bind\",\"vine-whip\",\"headbutt\",\"tackle\",\"body-slam\",\"take-down\",\"double-edge\",\"growl\",\"strength\",\"mega-drain\",\"leech-seed\",\"growth\",\"razor-leaf\",\"solar-beam\",\"poison-powder\",\"sleep-powder\",\"petal-dance\",\"string-shot\",\"toxic\",\"rage\",\"mimic\",\"double-team\",\"defense-curl\",\"light-screen\",\"reflect\",\"bide\",\"sludge\",\"skull-bash\",\"amnesia\",\"flash\",\"rest\",\"substitute\",\"snore\",\"curse\",\"protect\",\"sludge-bomb\",\"mud-slap\",\"outrage\",\"giga-drain\",\"endure\",\"charm\",\"false-swipe\",\"swagger\",\"fury-cutter\",\"attract\",\"sleep-talk\",\"return\",\"frustration\",\"safeguard\",\"sweet-scent\",\"synthesis\",\"hidden-power\",\"sunny-day\",\"rock-smash\",\"facade\",\"nature-power\",\"helping-hand\",\"ingrain\",\"knock-off\",\"secret-power\",\"weather-ball\",\"grass-whistle\",\"bullet-seed\",\"magical-leaf\",\"natural-gift\",\"worry-seed\",\"seed-bomb\",\"energy-ball\",\"leaf-storm\",\"power-whip\",\"captivate\",\"grass-knot\",\"venoshock\",\"round\",\"echoed-voice\",\"grass-pledge\",\"work-up\",\"grassy-terrain\",\"confide\",\"grassy-glide\"]', '[\"grass\",\"poison\"]'),
(22, 'charmander', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png', '[\"mega-punch\",\"fire-punch\",\"thunder-punch\",\"scratch\",\"swords-dance\",\"cut\",\"wing-attack\",\"mega-kick\",\"headbutt\",\"body-slam\",\"take-down\",\"double-edge\",\"leer\",\"bite\",\"growl\",\"ember\",\"flamethrower\",\"submission\",\"counter\",\"seismic-toss\",\"strength\",\"dragon-rage\",\"fire-spin\",\"dig\",\"toxic\",\"rage\",\"mimic\",\"double-team\",\"smokescreen\",\"defense-curl\",\"reflect\",\"bide\",\"fire-blast\",\"swift\",\"skull-bash\",\"fury-swipes\",\"rest\",\"rock-slide\",\"slash\",\"substitute\",\"snore\",\"curse\",\"protect\",\"scary-face\",\"belly-drum\",\"mud-slap\",\"outrage\",\"endure\",\"false-swipe\",\"swagger\",\"fury-cutter\",\"attract\",\"sleep-talk\",\"return\",\"frustration\",\"dynamic-punch\",\"dragon-breath\",\"iron-tail\",\"metal-claw\",\"hidden-power\",\"sunny-day\",\"crunch\",\"ancient-power\",\"rock-smash\",\"beat-up\",\"heat-wave\",\"will-o-wisp\",\"facade\",\"focus-punch\",\"helping-hand\",\"brick-break\",\"secret-power\",\"weather-ball\",\"air-cutter\",\"overheat\",\"rock-tomb\",\"aerial-ace\",\"dragon-claw\",\"dragon-dance\",\"natural-gift\",\"fling\",\"flare-blitz\",\"dragon-pulse\",\"dragon-rush\",\"focus-blast\",\"shadow-claw\",\"fire-fang\",\"captivate\",\"hone-claws\",\"flame-burst\",\"flame-charge\",\"round\",\"echoed-voice\",\"incinerate\",\"acrobatics\",\"inferno\",\"fire-pledge\",\"dragon-tail\",\"work-up\",\"confide\",\"power-up-punch\",\"tera-blast\"]', '[\"fire\"]');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
