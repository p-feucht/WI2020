-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 31. Okt 2020 um 15:58
-- Server-Version: 10.3.22-MariaDB-1:10.3.22+maria~stretch
-- PHP-Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `workerbees_db1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Angebot`
--

CREATE TABLE `Angebot` (
  `ATitel` varchar(15) DEFAULT NULL,
  `ABeschreibung` text DEFAULT NULL,
  `Vorname` varchar(20) DEFAULT NULL,
  `Nachname` varchar(30) DEFAULT NULL,
  `Straße` varchar(15) DEFAULT NULL,
  `Hausnummer` int(4) DEFAULT NULL,
  `PLZ` char(5) DEFAULT NULL,
  `Ort` varchar(25) DEFAULT NULL,
  `Bild` blob DEFAULT NULL,
  `username Ersteller` varchar(15) DEFAULT NULL,
  `AngebotID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tab. mit Spalten die alle Angebotskategorien besitzen';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `AngebotWerkstatt`
--

CREATE TABLE `AngebotWerkstatt` (
  `ATitel` varchar(15) DEFAULT NULL,
  `AZeitraum` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ABeschreibung` text DEFAULT NULL,
  `Vorname` varchar(20) DEFAULT NULL,
  `Nachname` varchar(30) DEFAULT NULL,
  `Strasse` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Hausnummer` int(4) DEFAULT NULL,
  `PLZ` char(5) DEFAULT NULL,
  `Ort` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bild` mediumblob DEFAULT NULL,
  `username Ersteller` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Werkstatt_ID` int(11) NOT NULL,
  `PreisProTag` decimal(6,2) DEFAULT NULL,
  `BezInBier` tinyint(1) DEFAULT NULL,
  ` A1_Bohr` tinyint(1) DEFAULT NULL,
  `A2_Drechsel` tinyint(1) DEFAULT NULL,
  `A3_Schleif` tinyint(1) DEFAULT NULL,
  `A4_Säge` tinyint(1) DEFAULT NULL,
  `A5_Kleinteil` tinyint(1) DEFAULT NULL,
  `Erstellzeitpunkt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `AngebotWerkzeug`
--

CREATE TABLE `AngebotWerkzeug` (
  `ATitel` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `AZeitraum` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ABeschreibung` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Vorname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nachname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Strasse` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Hausnummer` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PLZ` char(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Ort` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bild` mediumblob DEFAULT NULL,
  `username Ersteller` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Werkzeug_ID` int(11) NOT NULL,
  `PreisProTag` decimal(6,2) DEFAULT NULL,
  `BezInBier` tinyint(1) NOT NULL,
  `Erstellzeitpunkt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `AngebotWerkzeug`
--

INSERT INTO `AngebotWerkzeug` (`ATitel`, `AZeitraum`, `ABeschreibung`, `Vorname`, `Nachname`, `Strasse`, `Hausnummer`, `PLZ`, `Ort`, `Bild`, `username Ersteller`, `Werkzeug_ID`, `PreisProTag`, `BezInBier`, `Erstellzeitpunkt`) VALUES
('Hello', '0.000155586987623762', 'This is me...', 'he', 'ggeGR', 'GAWGREG sTR:', '', '34234', 'Erding', NULL, NULL, 1, '0.00', 1, NULL),
('hhhhhh', '0.000397807637623762', '                        ', '', '', '', '', '', '', NULL, NULL, 2, '0.00', 0, NULL),
('hhhhhh', '0.000397807637623762', '                        ', '', '', '', '', '', '', NULL, NULL, 3, '0.00', 0, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Dienstleistung`
--

CREATE TABLE `Dienstleistung` (
  `ATitel` varchar(15) NOT NULL,
  `AZeitraum` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ABeschreibung` text NOT NULL,
  `Vorname` varchar(20) NOT NULL,
  `Nachname` varchar(30) NOT NULL,
  `Strasse` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Hausnummer` varchar(5) NOT NULL,
  `PLZ` char(5) NOT NULL,
  `Ort` varchar(25) NOT NULL,
  `Bild` mediumblob NOT NULL,
  `username Ersteller` varchar(15) NOT NULL,
  `ID` int(11) NOT NULL,
  `Preisart` varchar(10) NOT NULL,
  `Preis` decimal(6,2) NOT NULL,
  `BezInBier` tinyint(1) NOT NULL,
  `Erstellzeitpunkt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `User`
--

CREATE TABLE `user` (
  'id' int(11) primary AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci
  )

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Angebot`
--
ALTER TABLE `Angebot`
  ADD PRIMARY KEY (`AngebotID`);

--
-- Indizes für die Tabelle `AngebotWerkstatt`
--
ALTER TABLE `AngebotWerkstatt`
  ADD PRIMARY KEY (`Werkstatt_ID`);

--
-- Indizes für die Tabelle `AngebotWerkzeug`
--
ALTER TABLE `AngebotWerkzeug`
  ADD PRIMARY KEY (`Werkzeug_ID`);

--
-- Indizes für die Tabelle `Dienstleistung`
--
ALTER TABLE `Dienstleistung`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Angebot`
--
ALTER TABLE `Angebot`
  MODIFY `AngebotID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `AngebotWerkstatt`
--
ALTER TABLE `AngebotWerkstatt`
  MODIFY `Werkstatt_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `AngebotWerkzeug`
--
ALTER TABLE `AngebotWerkzeug`
  MODIFY `Werkzeug_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `Dienstleistung`
--
ALTER TABLE `Dienstleistung`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
