-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 62.108.32.160:3306
-- Erstellungszeit: 27. Nov 2024 um 09:25
-- Server-Version: 10.11.10-MariaDB-deb12
-- PHP-Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `yjutbppv_testquiz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fs-testquiz-result`
--

CREATE TABLE `fs-testquiz-result` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `result` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fs-testquiz-result`
--
ALTER TABLE `fs-testquiz-result`
  ADD PRIMARY KEY (`result_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fs-testquiz-result`
--
ALTER TABLE `fs-testquiz-result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
