-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 jun 2023 om 16:06
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vos`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bedrijven`
--

CREATE TABLE `bedrijven` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `adres` varchar(100) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `plaats` varchar(50) NOT NULL,
  `telefoon` varchar(20) NOT NULL,
  `bedrijftype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bedrijven`
--

INSERT INTO `bedrijven` (`id`, `naam`, `adres`, `postcode`, `plaats`, `telefoon`, `bedrijftype`) VALUES
(1, 'Braat Auto\'s', 'Raadhuisstraat 11', '5161BD', 'Sprang-Capelle', '0416272753', 'Garage'),
(2, 'ZLM Verzekeringen', 'Cereshof 2', '4463XH', 'Goes', '0113238880', 'Verzekeringsmaatschappij');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tankinformatie`
--

CREATE TABLE `tankinformatie` (
  `id` int(11) NOT NULL,
  `voertuig_id` int(11) DEFAULT NULL,
  `datum` varchar(10) DEFAULT NULL,
  `tijd` time DEFAULT NULL,
  `liter` decimal(8,2) DEFAULT NULL,
  `prijs` decimal(8,2) DEFAULT NULL,
  `kilometerstand` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `voertuigen`
--

CREATE TABLE `voertuigen` (
  `id` int(11) NOT NULL,
  `kenteken` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `uitvoering` varchar(50) NOT NULL,
  `brandstof` varchar(50) NOT NULL,
  `kleur` varchar(50) NOT NULL,
  `carrosserie` varchar(50) NOT NULL,
  `bouwjaar` int(11) NOT NULL,
  `apk_datum` date NOT NULL,
  `aankoop_datum` date NOT NULL,
  `aankoop_kmstand` int(11) NOT NULL,
  `aankoop_bedrijf` varchar(50) NOT NULL,
  `bandenmaat_voor` varchar(50) NOT NULL,
  `bandenmaat_achter` varchar(50) NOT NULL,
  `bandenspanning_voor` int(11) NOT NULL,
  `bandenspanning_achter` int(11) NOT NULL,
  `olie` varchar(50) NOT NULL,
  `belasting_per_maand` decimal(10,2) NOT NULL,
  `verzekering_per_maand` decimal(10,2) NOT NULL,
  `verzekeringsmaatschappij` varchar(50) NOT NULL,
  `verzekerings_type` varchar(50) NOT NULL,
  `polisnummer` varchar(50) NOT NULL,
  `energielabel` varchar(50) NOT NULL,
  `emissieklasse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `voertuigen`
--

INSERT INTO `voertuigen` (`id`, `kenteken`, `merk`, `model`, `uitvoering`, `brandstof`, `kleur`, `carrosserie`, `bouwjaar`, `apk_datum`, `aankoop_datum`, `aankoop_kmstand`, `aankoop_bedrijf`, `bandenmaat_voor`, `bandenmaat_achter`, `bandenspanning_voor`, `bandenspanning_achter`, `olie`, `belasting_per_maand`, `verzekering_per_maand`, `verzekeringsmaatschappij`, `verzekerings_type`, `polisnummer`, `energielabel`, `emissieklasse`) VALUES
(1, '3-xxk-65', 'Opel', 'moka', '1.4 T edition', 'Benzine', 'wit', 'MPV', 11, '0000-00-00', '0000-00-00', 107420, '1', '215/rrr18', '215/rrr18', 3, 3, 'sae 5w-30', 56.00, 30.00, 'ZLM', 'WA', '', '', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bedrijven`
--
ALTER TABLE `bedrijven`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tankinformatie`
--
ALTER TABLE `tankinformatie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voertuig_id` (`voertuig_id`);

--
-- Indexen voor tabel `voertuigen`
--
ALTER TABLE `voertuigen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bedrijven`
--
ALTER TABLE `bedrijven`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `tankinformatie`
--
ALTER TABLE `tankinformatie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `voertuigen`
--
ALTER TABLE `voertuigen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tankinformatie`
--
ALTER TABLE `tankinformatie`
  ADD CONSTRAINT `tankinformatie_ibfk_1` FOREIGN KEY (`voertuig_id`) REFERENCES `voertuigen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
