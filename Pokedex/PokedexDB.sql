-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2023 at 10:10 PM
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
(25, 'charizard', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png', '[\"mega-punch\",\"fire-punch\",\"thunder-punch\",\"scratch\",\"swords-dance\",\"cut\",\"wing-attack\",\"fly\",\"mega-kick\",\"headbutt\",\"body-slam\",\"take-down\",\"double-edge\",\"leer\",\"growl\",\"roar\",\"ember\",\"flamethrower\",\"hyper-beam\",\"submission\",\"counter\",\"seismic-toss\",\"strength\",\"solar-beam\",\"dragon-rage\",\"fire-spin\",\"earthquake\",\"fissure\",\"dig\",\"toxic\",\"rage\",\"mimic\",\"double-team\",\"smokescreen\",\"defense-curl\",\"reflect\",\"bide\",\"fire-blast\",\"swift\",\"skull-bash\",\"fury-swipes\",\"rest\",\"rock-slide\",\"slash\",\"substitute\",\"snore\",\"curse\",\"protect\",\"scary-face\",\"mud-slap\",\"outrage\",\"sandstorm\",\"endure\",\"false-swipe\",\"swagger\",\"fury-cutter\",\"steel-wing\",\"attract\",\"sleep-talk\",\"return\",\"frustration\",\"dynamic-punch\",\"dragon-breath\",\"iron-tail\",\"metal-claw\",\"hidden-power\",\"twister\",\"sunny-day\",\"crunch\",\"rock-smash\",\"beat-up\",\"heat-wave\",\"will-o-wisp\",\"facade\",\"focus-punch\",\"helping-hand\",\"brick-break\",\"secret-power\",\"blaze-kick\",\"blast-burn\",\"weather-ball\",\"air-cutter\",\"overheat\",\"rock-tomb\",\"aerial-ace\",\"dragon-claw\",\"dragon-dance\",\"roost\",\"natural-gift\",\"tailwind\",\"fling\",\"flare-blitz\",\"air-slash\",\"dragon-pulse\",\"focus-blast\",\"giga-impact\",\"shadow-claw\",\"fire-fang\",\"defog\",\"captivate\",\"ominous-wind\",\"hone-claws\",\"flame-burst\",\"flame-charge\",\"round\",\"echoed-voice\",\"sky-drop\",\"incinerate\",\"acrobatics\",\"inferno\",\"fire-pledge\",\"bulldoze\",\"dragon-tail\",\"work-up\",\"heat-crash\",\"hurricane\",\"confide\",\"mystical-fire\",\"power-up-punch\",\"brutal-swing\",\"breaking-swipe\",\"scale-shot\",\"dual-wingbeat\",\"scorching-sands\",\"tera-blast\"]', '[\"fire\",\"flying\"]'),
(37, 'ivysaur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/2.png', '[\"swords-dance\",\"cut\",\"bind\",\"vine-whip\",\"headbutt\",\"tackle\",\"body-slam\",\"take-down\",\"double-edge\",\"growl\",\"strength\",\"mega-drain\",\"leech-seed\",\"growth\",\"razor-leaf\",\"solar-beam\",\"poison-powder\",\"sleep-powder\",\"string-shot\",\"toxic\",\"rage\",\"mimic\",\"double-team\",\"defense-curl\",\"light-screen\",\"reflect\",\"bide\",\"amnesia\",\"flash\",\"rest\",\"substitute\",\"snore\",\"curse\",\"protect\",\"sludge-bomb\",\"mud-slap\",\"outrage\",\"giga-drain\",\"endure\",\"charm\",\"false-swipe\",\"swagger\",\"fury-cutter\",\"attract\",\"sleep-talk\",\"return\",\"frustration\",\"safeguard\",\"sweet-scent\",\"synthesis\",\"hidden-power\",\"sunny-day\",\"rock-smash\",\"facade\",\"nature-power\",\"helping-hand\",\"knock-off\",\"secret-power\",\"weather-ball\",\"bullet-seed\",\"magical-leaf\",\"natural-gift\",\"worry-seed\",\"seed-bomb\",\"energy-ball\",\"leaf-storm\",\"power-whip\",\"captivate\",\"grass-knot\",\"venoshock\",\"round\",\"echoed-voice\",\"grass-pledge\",\"work-up\",\"grassy-terrain\",\"confide\",\"grassy-glide\"]', '[\"grass\",\"poison\"]'),
(39, 'bulbasaur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png', '[\"razor-wind\",\"swords-dance\",\"cut\",\"bind\",\"vine-whip\",\"headbutt\",\"tackle\",\"body-slam\",\"take-down\",\"double-edge\",\"growl\",\"strength\",\"mega-drain\",\"leech-seed\",\"growth\",\"razor-leaf\",\"solar-beam\",\"poison-powder\",\"sleep-powder\",\"petal-dance\",\"string-shot\",\"toxic\",\"rage\",\"mimic\",\"double-team\",\"defense-curl\",\"light-screen\",\"reflect\",\"bide\",\"sludge\",\"skull-bash\",\"amnesia\",\"flash\",\"rest\",\"substitute\",\"snore\",\"curse\",\"protect\",\"sludge-bomb\",\"mud-slap\",\"outrage\",\"giga-drain\",\"endure\",\"charm\",\"false-swipe\",\"swagger\",\"fury-cutter\",\"attract\",\"sleep-talk\",\"return\",\"frustration\",\"safeguard\",\"sweet-scent\",\"synthesis\",\"hidden-power\",\"sunny-day\",\"rock-smash\",\"facade\",\"nature-power\",\"helping-hand\",\"ingrain\",\"knock-off\",\"secret-power\",\"weather-ball\",\"grass-whistle\",\"bullet-seed\",\"magical-leaf\",\"natural-gift\",\"worry-seed\",\"seed-bomb\",\"energy-ball\",\"leaf-storm\",\"power-whip\",\"captivate\",\"grass-knot\",\"venoshock\",\"round\",\"echoed-voice\",\"grass-pledge\",\"work-up\",\"grassy-terrain\",\"confide\",\"grassy-glide\"]', '[\"grass\",\"poison\"]'),
(41, 'metapod', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/11.png', '[\"string-shot\",\"harden\",\"iron-defense\",\"bug-bite\",\"electroweb\"]', '[\"bug\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
