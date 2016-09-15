-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Aug 2016 um 09:53
-- Server-Version: 10.1.13-MariaDB
-- PHP-Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `BlueBacon`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Beacon`
--

CREATE TABLE `Beacon` (
  `BeaconID` int(11) NOT NULL,
  `UUID` varchar(32) NOT NULL,
  `Major` int(4) NOT NULL,
  `Minor` int(4) NOT NULL,
  `PositionX` double NOT NULL,
  `PositionY` double NOT NULL,
  `MachineID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Maschine`
--

CREATE TABLE `Maschine` (
  `MachineID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Description` varchar(60) CHARACTER SET utf8mb4 NOT NULL,
  `Productionstatus` varchar(40) NOT NULL,
  `Maintenancestatus` varchar(40) NOT NULL,
  `Geadded` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Beacon`
--
ALTER TABLE `Beacon`
  ADD PRIMARY KEY (`BeaconID`),
  ADD UNIQUE KEY `BeaconID` (`BeaconID`);

--
-- Indizes für die Tabelle `Maschine`
--
ALTER TABLE `Maschine`
  ADD PRIMARY KEY (`MachineID`),
  ADD UNIQUE KEY `MachineID` (`MachineID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Beacon`
--
ALTER TABLE `Beacon`
  MODIFY `BeaconID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `Maschine`
--
ALTER TABLE `Maschine`
  MODIFY `MachineID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
