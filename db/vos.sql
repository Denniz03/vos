-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 07 jun 2023 om 06:44
-- Serverversie: 10.4.21-MariaDB
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
  `straat` varchar(100) NOT NULL,
  `huisnummer` varchar(10) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `plaats` varchar(50) NOT NULL,
  `land` varchar(255) NOT NULL,
  `telefoon` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `bedrijfstype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bedrijven`
--

INSERT INTO `bedrijven` (`id`, `naam`, `straat`, `huisnummer`, `postcode`, `plaats`, `land`, `telefoon`, `email`, `website`, `bedrijfstype`) VALUES
(1, 'Braat Auto\'s', 'Raadhuisstraat 11', '', '5161BD', 'Sprang-Capelle', '', '0416272753', '', '', 'Garage'),
(2, 'ZLM Verzekeringen', 'Cereshof 2', '', '4463XH', 'Goes', '', '0113238880', '', '', 'Verzekeringsmaatschappij'),
(3, 'John van Eck Auto&#039;s', 'Edisonstraat', '20', '4004JL', 'Tiel', 'Nederland', '0344626626', '', '', 'Dealer');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `bouwjaar` varchar(7) NOT NULL,
  `apk_datum` varchar(10) NOT NULL,
  `aankoop_datum` varchar(10) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `voertuigen`
--

INSERT INTO `voertuigen` (`id`, `kenteken`, `merk`, `model`, `uitvoering`, `brandstof`, `kleur`, `carrosserie`, `bouwjaar`, `apk_datum`, `aankoop_datum`, `aankoop_kmstand`, `aankoop_bedrijf`, `bandenmaat_voor`, `bandenmaat_achter`, `bandenspanning_voor`, `bandenspanning_achter`, `olie`, `belasting_per_maand`, `verzekering_per_maand`, `verzekeringsmaatschappij`, `verzekerings_type`, `polisnummer`, `energielabel`, `emissieklasse`) VALUES
(3, '3-XXK-65', 'opel', 'mokka', '1.4 T Edition', 'Benzine', 'wit', 'MPV', '11-2014', '19-11-2023', '25-10-2021', 107420, '1', '215/55 R18', '215/55 R18', 3, 3, 'SAE 5W-30', 56.00, 30.00, '2', 'WA Beperkt Casco', '', 'E', 'Euro 6'),
(4, '43-MBTT', 'KTM', 'Duke', '125cc', 'Benzine', 'zwart', 'Motorfiets', '09-2012', '01-09-2030', '20-11-2022', 31002, '3', '110/70 R17', '150/60 R17', 2, 2, 'SAE 10W-40', 11.00, 13.90, '2', 'WA Volledig Casco', '', '', 'Euro 5'),
(5, '83-SFZ-1', 'Toyota', 'Aygo', '1.0 12V Comfort Navigator', 'Benzine', 'Grijs', 'Hatchback', '09-2011', '15-07-2023', '22-09-2021', 320345, '1', '155/65 R14', '155/65 R14', 2, 2, 'SAE 5W-30', 19.67, 20.77, '2', 'WA+', '', 'A', 'Euro 5'),
(6, '47-SPB-9', 'seat', 'ibiza', '1.2 TDI Style Ecomotive', 'Diesel', 'blauw', 'Stationwagen', '11-2011', '13-12-2021', '25-01-2016', 161000, '1', '', '', 2, 2, 'SAE 5W-30', 0.00, 0.00, '2', '', '', 'A', 'Euro 3');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `tankinformatie`
--
ALTER TABLE `tankinformatie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `voertuigen`
--
ALTER TABLE `voertuigen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
