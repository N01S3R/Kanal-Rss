-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Wrz 2020, 23:18
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `rss`
--
CREATE DATABASE IF NOT EXISTS `rss` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rss`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rss_added`
--

CREATE TABLE `rss_added` (
  `rss_id` int(11) NOT NULL,
  `rss_title` varchar(150) NOT NULL,
  `rss_desc` longtext NOT NULL,
  `rss_date` datetime NOT NULL,
  `rss_link` varchar(255) NOT NULL,
  `rss_added` datetime NOT NULL DEFAULT current_timestamp(),
  `rss_dir` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `rss_added`
--
ALTER TABLE `rss_added`
  ADD PRIMARY KEY (`rss_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `rss_added`
--
ALTER TABLE `rss_added`
  MODIFY `rss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
