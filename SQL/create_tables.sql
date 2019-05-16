-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql.entsorgungskalenderanzeige.christianpetri.ch
-- Erstellungszeit: 16. Mai 2019 um 00:07
-- Server-Version: 5.7.25-log
-- PHP-Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `entsorgungskalen_ch_pe`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `circle`
--

CREATE TABLE `circle` (
                          `circle_id` int(11) NOT NULL,
                          `circle_description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `circle`
--

INSERT INTO `circle` (`circle_id`, `circle_description`) VALUES
(1, '1'),
(2, '1a'),
(3, '1b'),
(4, '2'),
(5, '3'),
(6, '4'),
(7, '5'),
(8, '6'),
(9, '7'),
(10, '8'),
(11, '9');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `garbage_type`
--

CREATE TABLE `garbage_type` (
                                `garbage_type_id` int(11) NOT NULL,
                                `garbage_type_description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `garbage_type`
--

INSERT INTO `garbage_type` (`garbage_type_id`, `garbage_type_description`) VALUES
(1, 'Grüngut'),
(2, 'Karton'),
(3, 'Kehricht und Sperrgut'),
(4, 'Metall'),
(5, 'Papier');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `circle`
--
ALTER TABLE `circle`
    ADD PRIMARY KEY (`circle_id`);

--
-- Indizes für die Tabelle `garbage_type`
--
ALTER TABLE `garbage_type`
    ADD PRIMARY KEY (`garbage_type_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `circle`
--
ALTER TABLE `circle`
    MODIFY `circle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
