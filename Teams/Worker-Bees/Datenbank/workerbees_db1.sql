-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 24. Okt 2020 um 17:43
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
CREATE DATABASE IF NOT EXISTS `workerbees_db1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `workerbees_db1`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Angebot`
--

DROP TABLE IF EXISTS `Angebot`;
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
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tab. mit Spalten die alle Angebotskategorien besitzen';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `AngebotWerkstatt`
--

DROP TABLE IF EXISTS `AngebotWerkstatt`;
CREATE TABLE `AngebotWerkstatt` (
  `ATitel` varchar(15) DEFAULT NULL,
  `ABeschreibung` text DEFAULT NULL,
  `Vorname` varchar(20) DEFAULT NULL,
  `Nachname` varchar(30) DEFAULT NULL,
  `Straße` varchar(15) DEFAULT NULL,
  `Hausnummer` int(4) DEFAULT NULL,
  `PLZ` char(5) DEFAULT NULL,
  `Ort` varchar(25) DEFAULT NULL,
  `Bild` mediumblob DEFAULT NULL,
  `username Ersteller` varchar(15) DEFAULT NULL,
  `Werkstatt_ID` int(11) NOT NULL,
  `Preis/Tag` decimal(6,2) DEFAULT NULL,
  `Ausstattung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `AngebotWerkzeug`
--

DROP TABLE IF EXISTS `AngebotWerkzeug`;
CREATE TABLE `AngebotWerkzeug` (
  `ATitel` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ABeschreibung` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Vorname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nachname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Straße` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Hausnummer` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PLZ` char(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Ort` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bild` mediumblob DEFAULT NULL,
  `username Ersteller` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Werkzeug_ID` int(11) NOT NULL,
  `Preis/Tag` decimal(6,2) DEFAULT NULL,
  `BezInBier` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Dienstleistung`
--

DROP TABLE IF EXISTS `Dienstleistung`;
CREATE TABLE `Dienstleistung` (
  `ATitel` varchar(15) NOT NULL,
  `ABeschreibung` text NOT NULL,
  `Vorname` varchar(20) NOT NULL,
  `Nachname` varchar(30) NOT NULL,
  `Straße` varchar(15) NOT NULL,
  `Hausnummer` varchar(5) NOT NULL,
  `PLZ` char(5) NOT NULL,
  `Ort` varchar(25) NOT NULL,
  `Bild` mediumblob NOT NULL,
  `username Ersteller` varchar(15) NOT NULL,
  `ID` int(11) NOT NULL,
  `Preisart (pro Stunde oder DL)` tinyint(1) NOT NULL,
  `Preis` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `Username` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Username',
  `Passwort` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'eindeutige Email Adresse'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Angebot`
--
ALTER TABLE `Angebot`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `AngebotWerkstatt`
--
ALTER TABLE `AngebotWerkstatt`
  MODIFY `Werkstatt_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `AngebotWerkzeug`
--
ALTER TABLE `AngebotWerkzeug`
  MODIFY `Werkzeug_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `Dienstleistung`
--
ALTER TABLE `Dienstleistung`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
