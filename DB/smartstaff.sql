-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Paź 15, 2024 at 07:03 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartstaff`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dania`
--

CREATE TABLE `dania` (
  `ID_DANIA` smallint(6) NOT NULL,
  `NAZWA` varchar(30) DEFAULT NULL,
  `TYP` varchar(15) DEFAULT NULL,
  `CENA` decimal(5,2) DEFAULT NULL,
  `ZDJ` varchar(100) DEFAULT NULL,
  `SPRZ_SZTUK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dania`
--

INSERT INTO `dania` (`ID_DANIA`, `NAZWA`, `TYP`, `CENA`, `ZDJ`, `SPRZ_SZTUK`) VALUES
(1, 'Gorąca czekolada', 'napoj', 8.90, 'uploaded_zdj/dania/IMG-6338288c77c1e1.32646122.png', 0),
(2, 'Sushi', 'danie_glowne', 35.40, 'uploaded_zdj/dania/IMG-633828e74694d4.79139853.png', 0),
(3, 'Coca-cola', 'napoj', 5.60, 'uploaded_zdj/dania/IMG-633828fc726fb5.85839376.png', 0),
(4, 'Ciasto czekoladowe', 'deser', 12.90, 'uploaded_zdj/dania/IMG-63382911e32457.27439443.png', 0),
(5, 'Mojito', 'napoj', 11.50, 'uploaded_zdj/dania/IMG-63382922d50fa4.65101234.png', 0),
(6, 'Kawa czarna', 'napoj', 4.90, 'uploaded_zdj/dania/IMG-6338298b37cd19.11151684.png', 0),
(7, 'Babeczka czekoladowa', 'deser', 8.70, 'uploaded_zdj/dania/IMG-63382a8fd6cad2.75212922.png', 0),
(8, 'Krewetki', 'danie_glowne', 24.50, 'uploaded_zdj/dania/IMG-63382ab5f12679.85455264.png', 0),
(9, 'Łosoś z makaronem', 'danie_glowne', 28.90, 'uploaded_zdj/dania/IMG-63382ac96f7e48.73556516.png', 0),
(10, 'Shake czekoladowy', 'deser', 13.40, 'uploaded_zdj/dania/IMG-63382ae1734722.23350253.png', 0),
(11, 'Krążki  cebulowe', 'danie_glowne', 9.90, 'uploaded_zdj/dania/IMG-63382af7233402.50213051.png', 0),
(12, 'Makaron z warzywami', 'danie_glowne', 18.90, 'uploaded_zdj/dania/IMG-63382b070cc2e0.42229187.png', 0),
(13, 'Ciasto wiśniowe', 'deser', 11.90, 'uploaded_zdj/dania/IMG-63382b1964aaa9.41438341.png', 0),
(14, 'Pizza Carbonara', 'danie_glowne', 24.90, 'uploaded_zdj/dania/IMG-63382b630544f1.74099560.png', 0),
(15, 'Sałatka grecka', 'danie_glowne', 13.60, 'uploaded_zdj/dania/IMG-63382b70ae62e2.14496699.png', 0),
(16, 'Szaszłyki wieprzowe', 'danie_glowne', 26.70, 'uploaded_zdj/dania/IMG-63382b7eeee0b3.94580552.png', 0),
(17, 'Zupa gulaszowa', 'danie_glowne', 9.90, 'uploaded_zdj/dania/IMG-63382b9612eb82.78190547.png', 0),
(18, 'Żeberka pieczone', 'danie_glowne', 27.90, 'uploaded_zdj/dania/IMG-63382ba68a6384.42073706.png', 0),
(19, 'Wino czerwone', 'napoj', 12.90, 'uploaded_zdj/dania/IMG-63382bc9518898.08338936.png', 0),
(20, 'Herbata', 'napoj', 7.80, 'uploaded_zdj/dania/default.png', 0),
(21, 'Rogal z polewą', 'deser', 11.50, 'uploaded_zdj/dania/IMG-63c87eb834e2b5.72436287.png', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logowanie`
--

CREATE TABLE `logowanie` (
  `ID_PRAC` smallint(6) NOT NULL,
  `LOGIN` varchar(10) DEFAULT NULL,
  `HASLO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logowanie`
--

INSERT INTO `logowanie` (`ID_PRAC`, `LOGIN`, `HASLO`) VALUES
(1, 'matwis70', '$2y$10$.AA1e6Ep54ATvqOb7PFhPeWuSryNe8Ffvw9lfT5lAhDBQgjspBEJ2'),
(2, 'janko85', '$2y$10$u17yG8ytBDZh.MC0kSMsCuw27lMzTPwLo6/WVTaiyH5f.FaSVlYqG'),
(3, 'katno80', '$2y$10$BdeqZePm6Cj9ehEWw0OjQ.pzfue2npFb3RnXNxg41CcA.IaoJpYUa'),
(4, 'rysmie99', '$2y$10$i3XgV3keOtfgs55e2BZX7.QZodcfHhXjPUyj5k.wlcbDi0uWpy7Na'),
(5, 'marpta92', '$2y$10$8wHhLKRE1ghXt1FtCJ/bGu7X98/.pqEao9O2m7CWT/eXFmpcotXxS'),
(6, 'jakpta90', '$2y$10$FtxbI9PamyY3Kc5DiFJK0.tzwlHkMulm5O9Cg3PBD0s7KBQF6Z49a'),
(7, 'annwie85', '$2y$10$pcF5aIekh1BV35bXBROlcuZG/hFlJ6l22/Wo41c.tAHkz5.t0gCOq'),
(8, 'zdzosi80', '$2y$10$XV8sapsn1tOA2l8uNAHFUOq6uXMdnehud4v0gX19UBe601YdpWciy'),
(9, 'tommul89', '$2y$10$2m.iWHSiZFK4CmIRrvxKCeP2ZJH9FS4Z8ImLQI.uM3dCPK5WplYD2'),
(10, 'adanow87', '$2y$10$aL8L2T8Z5X9gcBx5XW8KOO66OopFu2/lS9ine6RZ9yI8O8QGzBw4q');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `ID_PRAC` smallint(6) NOT NULL,
  `IMIE` varchar(15) DEFAULT NULL,
  `NAZWISKO` varchar(15) DEFAULT NULL,
  `DATA_ZATR` date DEFAULT NULL,
  `PESEL` char(11) DEFAULT NULL,
  `TYP` varchar(20) DEFAULT NULL,
  `PENSJA` mediumint(9) DEFAULT NULL,
  `STAT` int(11) NOT NULL DEFAULT 0,
  `zdj` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pracownicy`
--

INSERT INTO `pracownicy` (`ID_PRAC`, `IMIE`, `NAZWISKO`, `DATA_ZATR`, `PESEL`, `TYP`, `PENSJA`, `STAT`, `zdj`) VALUES
(1, 'Mateusz', 'Wiśniewski', '2015-07-08', '70091284683', 'szef', NULL, 0, 'uploaded_zdj/pracownicy/default.png'),
(2, 'Jan', 'Kowalski', '2021-06-10', '85120173392', 'kelner', 3500, 0, 'uploaded_zdj/pracownicy/default.png'),
(3, 'Katarzyna', 'Nowak', '2022-01-05', '80031265907', 'kucharz', 3800, 0, 'uploaded_zdj/pracownicy/default.png'),
(4, 'Ryszard', 'Mieszalski', '2022-03-11', '99090867235', 'barman', 2900, 0, 'uploaded_zdj/pracownicy/IMG-62e53127d80004.46488347.png'),
(5, 'Marcin', 'Ptak', '2020-06-13', '92030375635', 'kucharz', 4000, 0, 'uploaded_zdj/pracownicy/IMG-62e53168b91876.19859141.png'),
(6, 'Jakub', 'Ptak', '2020-06-20', '90090976876', 'kucharz', 3700, 0, 'uploaded_zdj/pracownicy/IMG-62e531958680c8.65500600.png'),
(7, 'Anna', 'Wieczorek', '2021-05-08', '85020274536', 'kelner', 3300, 0, 'uploaded_zdj/pracownicy/IMG-62e532778b38b7.20897647.png'),
(8, 'Zdzisław', 'Osieczko', '2022-05-11', '80090975674', 'barman', 3000, 0, 'uploaded_zdj/pracownicy/default.png'),
(9, 'Tomasz', 'Mulek', '2022-10-03', '89091274585', 'kelner', 3200, 0, 'uploaded_zdj/pracownicy/IMG-63386a79e8f634.16830094.png'),
(10, 'Adam', 'Nowak', '2023-01-19', '87090986767', 'kelner', 3500, 0, 'uploaded_zdj/pracownicy/default.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stat_dania_arch`
--

CREATE TABLE `stat_dania_arch` (
  `LP` int(11) NOT NULL,
  `ID_DANIA` smallint(6) DEFAULT NULL,
  `MIESIAC` date DEFAULT NULL,
  `STAT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stat_dania_arch`
--

INSERT INTO `stat_dania_arch` (`LP`, `ID_DANIA`, `MIESIAC`, `STAT`) VALUES
(22, 1, '2022-10-17', 1),
(23, 2, '2022-10-17', 6),
(24, 3, '2022-10-17', 3),
(25, 4, '2022-10-17', 0),
(26, 5, '2022-10-17', 1),
(27, 6, '2022-10-17', 1),
(28, 7, '2022-10-17', 1),
(29, 8, '2022-10-17', 3),
(30, 9, '2022-10-17', 54),
(31, 10, '2022-10-17', 0),
(32, 11, '2022-10-17', 0),
(33, 12, '2022-10-17', 3),
(34, 13, '2022-10-17', 0),
(35, 14, '2022-10-17', 3),
(36, 15, '2022-10-17', 1),
(37, 16, '2022-10-17', 4),
(38, 17, '2022-10-17', 2),
(39, 18, '2022-10-17', 3),
(40, 19, '2022-10-17', 2),
(41, 20, '2022-10-17', 1),
(42, 1, '2022-11-07', 0),
(43, 2, '2022-11-07', 0),
(44, 3, '2022-11-07', 0),
(45, 4, '2022-11-07', 0),
(46, 5, '2022-11-07', 0),
(47, 6, '2022-11-07', 0),
(48, 7, '2022-11-07', 0),
(49, 8, '2022-11-07', 0),
(50, 9, '2022-11-07', 43),
(51, 10, '2022-11-07', 0),
(52, 11, '2022-11-07', 0),
(53, 12, '2022-11-07', 0),
(54, 13, '2022-11-07', 0),
(55, 14, '2022-11-07', 0),
(56, 15, '2022-11-07', 0),
(57, 16, '2022-11-07', 0),
(58, 17, '2022-11-07', 0),
(59, 18, '2022-11-07', 0),
(60, 19, '2022-11-07', 0),
(61, 20, '2022-11-07', 0),
(63, 1, '2022-12-18', 0),
(64, 2, '2022-12-18', 4),
(65, 3, '2022-12-18', 0),
(66, 4, '2022-12-18', 0),
(67, 5, '2022-12-18', 0),
(68, 6, '2022-12-18', 0),
(69, 7, '2022-12-18', 0),
(70, 8, '2022-12-18', 2),
(71, 9, '2022-12-18', 13),
(72, 10, '2022-12-18', 0),
(73, 11, '2022-12-18', 1),
(74, 12, '2022-12-18', 4),
(75, 13, '2022-12-18', 0),
(76, 14, '2022-12-18', 4),
(77, 15, '2022-12-18', 4),
(78, 16, '2022-12-18', 2),
(79, 17, '2022-12-18', 2),
(80, 18, '2022-12-18', 2),
(81, 19, '2022-12-18', 0),
(82, 20, '2022-12-18', 0),
(83, 1, '2023-01-02', 0),
(84, 2, '2023-01-02', 0),
(85, 3, '2023-01-02', 0),
(86, 4, '2023-01-02', 1),
(87, 5, '2023-01-02', 0),
(88, 6, '2023-01-02', 0),
(89, 7, '2023-01-02', 1),
(90, 8, '2023-01-02', 1),
(91, 9, '2023-01-02', 1),
(92, 10, '2023-01-02', 0),
(93, 11, '2023-01-02', 0),
(94, 12, '2023-01-02', 0),
(95, 13, '2023-01-02', 0),
(96, 14, '2023-01-02', 1),
(97, 15, '2023-01-02', 0),
(98, 16, '2023-01-02', 0),
(99, 17, '2023-01-02', 0),
(100, 18, '2023-01-02', 0),
(101, 19, '2023-01-02', 0),
(102, 20, '2023-01-02', 0),
(103, 21, '2023-01-02', 1),
(104, 1, '2023-11-27', 0),
(105, 2, '2023-11-27', 0),
(106, 3, '2023-11-27', 0),
(107, 4, '2023-11-27', 0),
(108, 5, '2023-11-27', 0),
(109, 6, '2023-11-27', 0),
(110, 7, '2023-11-27', 0),
(111, 8, '2023-11-27', 0),
(112, 9, '2023-11-27', 0),
(113, 10, '2023-11-27', 0),
(114, 11, '2023-11-27', 0),
(115, 12, '2023-11-27', 0),
(116, 13, '2023-11-27', 0),
(117, 14, '2023-11-27', 0),
(118, 15, '2023-11-27', 0),
(119, 16, '2023-11-27', 0),
(120, 17, '2023-11-27', 0),
(121, 18, '2023-11-27', 0),
(122, 19, '2023-11-27', 0),
(123, 20, '2023-11-27', 0),
(124, 21, '2023-11-27', 0),
(125, 1, '2024-01-16', 0),
(126, 2, '2024-01-16', 2),
(127, 3, '2024-01-16', 1),
(128, 4, '2024-01-16', 0),
(129, 5, '2024-01-16', 0),
(130, 6, '2024-01-16', 0),
(131, 7, '2024-01-16', 1),
(132, 8, '2024-01-16', 1),
(133, 9, '2024-01-16', 0),
(134, 10, '2024-01-16', 0),
(135, 11, '2024-01-16', 0),
(136, 12, '2024-01-16', 0),
(137, 13, '2024-01-16', 0),
(138, 14, '2024-01-16', 1),
(139, 15, '2024-01-16', 0),
(140, 16, '2024-01-16', 0),
(141, 17, '2024-01-16', 0),
(142, 18, '2024-01-16', 0),
(143, 19, '2024-01-16', 0),
(144, 20, '2024-01-16', 0),
(145, 21, '2024-01-16', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stat_firmy`
--

CREATE TABLE `stat_firmy` (
  `LP` int(11) NOT NULL,
  `MIESIAC` date DEFAULT NULL,
  `PRZYCHOD` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stat_firmy`
--

INSERT INTO `stat_firmy` (`LP`, `MIESIAC`, `PRZYCHOD`) VALUES
(1, '2024-10-14', 0.00),
(9, '2022-09-01', 42.50),
(10, '2022-08-01', 50.76),
(12, '2022-10-17', 0.00),
(13, '2022-11-07', 0.00),
(14, '2022-12-18', 0.00),
(15, '2023-01-02', 0.00),
(16, '2023-11-27', 0.00),
(17, '2024-01-16', 0.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stat_prac_arch`
--

CREATE TABLE `stat_prac_arch` (
  `LP` int(11) NOT NULL,
  `ID_PRAC` smallint(6) DEFAULT NULL,
  `MIESIAC` date DEFAULT NULL,
  `STAT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stat_prac_arch`
--

INSERT INTO `stat_prac_arch` (`LP`, `ID_PRAC`, `MIESIAC`, `STAT`) VALUES
(222, 1, '2022-09-01', 0),
(223, 2, '2022-09-01', 0),
(224, 3, '2022-09-01', 1),
(225, 4, '2022-09-01', 98),
(226, 5, '2022-09-01', 1),
(227, 6, '2022-09-01', 10),
(228, 7, '2022-09-01', 2),
(229, 8, '2022-09-01', 22),
(230, 9, '2022-09-01', 0),
(231, 1, '2022-08-01', 0),
(232, 2, '2022-08-01', 2),
(233, 3, '2022-08-01', 8),
(234, 4, '2022-08-01', 65),
(235, 5, '2022-08-01', 5),
(236, 6, '2022-08-01', 0),
(237, 7, '2022-08-01', 0),
(238, 8, '2022-08-01', 0),
(239, 9, '2022-08-01', 0),
(248, 8, '2022-10-10', 4),
(249, 9, '2022-10-10', 0),
(250, 1, '2022-10-10', 0),
(251, 2, '2022-10-10', 0),
(252, 3, '2022-10-10', 0),
(253, 4, '2022-10-10', 0),
(254, 5, '2022-10-10', 0),
(255, 6, '2022-10-10', 0),
(256, 7, '2022-10-10', 0),
(257, 8, '2022-10-10', 0),
(258, 9, '2022-10-10', 0),
(259, 1, '2022-10-17', 0),
(260, 2, '2022-10-17', 34),
(261, 3, '2022-10-17', 9),
(262, 4, '2022-10-17', 5),
(263, 5, '2022-10-17', 10),
(264, 6, '2022-10-17', 6),
(265, 7, '2022-10-17', 1),
(266, 8, '2022-10-17', 5),
(267, 9, '2022-10-17', 0),
(268, 1, '2022-11-07', 0),
(269, 2, '2022-11-07', 0),
(270, 3, '2022-11-07', 0),
(271, 4, '2022-11-07', 0),
(272, 5, '2022-11-07', 0),
(273, 6, '2022-11-07', 0),
(274, 7, '2022-11-07', 0),
(275, 8, '2022-11-07', 0),
(276, 9, '2022-11-07', 0),
(277, 1, '2022-12-18', 0),
(278, 2, '2022-12-18', 28),
(279, 3, '2022-12-18', 11),
(280, 4, '2022-12-18', 0),
(281, 5, '2022-12-18', 10),
(282, 6, '2022-12-18', 7),
(283, 7, '2022-12-18', 0),
(284, 8, '2022-12-18', 0),
(285, 9, '2022-12-18', 0),
(286, 1, '2023-01-02', 0),
(287, 2, '2023-01-02', 2),
(288, 3, '2023-01-02', 1),
(289, 4, '2023-01-02', 2),
(290, 5, '2023-01-02', 0),
(291, 6, '2023-01-02', 2),
(292, 7, '2023-01-02', 0),
(293, 8, '2023-01-02', 1),
(294, 9, '2023-01-02', 0),
(295, 10, '2023-01-02', 4),
(296, 1, '2023-11-27', 0),
(297, 2, '2023-11-27', 0),
(298, 3, '2023-11-27', 0),
(299, 4, '2023-11-27', 0),
(300, 5, '2023-11-27', 0),
(301, 6, '2023-11-27', 0),
(302, 7, '2023-11-27', 0),
(303, 8, '2023-11-27', 0),
(304, 9, '2023-11-27', 0),
(305, 10, '2023-11-27', 0),
(306, 1, '2024-01-16', 0),
(307, 2, '2024-01-16', 6),
(308, 3, '2024-01-16', 1),
(309, 4, '2024-01-16', 1),
(310, 5, '2024-01-16', 1),
(311, 6, '2024-01-16', 2),
(312, 7, '2024-01-16', 0),
(313, 8, '2024-01-16', 1),
(314, 9, '2024-01-16', 0),
(315, 10, '2024-01-16', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wykonawcy`
--

CREATE TABLE `wykonawcy` (
  `ID` int(11) NOT NULL,
  `ID_PRAC` smallint(6) DEFAULT NULL,
  `ID_ZAM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wykonawcy`
--

INSERT INTO `wykonawcy` (`ID`, `ID_PRAC`, `ID_ZAM`) VALUES
(876, 2, 1),
(877, 6, 1),
(878, 2, 2),
(880, 2, 3),
(882, 2, 4),
(886, 2, 6),
(888, 2, 7),
(889, 6, 7),
(890, 2, 8),
(892, 2, 9),
(894, 2, 10),
(896, 2, 11),
(897, 6, 11),
(898, 7, 12),
(918, 2, 14),
(919, 6, 14),
(920, 2, 15),
(922, 2, 16),
(930, 2, 17),
(931, 8, 17),
(932, 2, 18),
(933, 4, 18),
(934, 2, 19),
(935, 4, 19),
(936, 2, 20),
(937, 8, 20),
(938, 2, 21),
(939, 4, 21),
(940, 2, 22),
(941, 8, 22),
(942, 2, 23),
(943, 4, 23),
(944, 2, 24),
(945, 8, 24),
(946, 2, 25),
(947, 5, 25),
(950, 2, 26),
(951, 5, 26),
(952, 2, 27),
(953, 3, 27),
(954, 2, 28),
(955, 3, 28),
(956, 2, 29),
(957, 3, 29),
(958, 2, 30),
(959, 5, 30),
(960, 2, 31),
(961, 5, 31),
(962, 2, 32),
(963, 3, 32),
(964, 2, 33),
(965, 6, 33),
(966, 2, 34),
(967, 3, 34),
(968, 2, 35),
(969, 5, 35),
(970, 2, 36),
(971, 6, 36),
(972, 2, 37),
(973, 3, 37),
(974, 2, 38),
(975, 5, 38),
(976, 2, 39),
(977, 5, 39),
(978, 2, 40),
(979, 3, 40),
(980, 2, 41),
(981, 6, 41),
(982, 2, 42),
(983, 6, 42),
(984, 2, 43),
(985, 3, 43),
(986, 2, 44),
(987, 5, 44),
(988, 2, 45),
(989, 6, 45),
(990, 2, 46),
(991, 5, 46),
(992, 2, 47),
(993, 3, 47),
(994, 2, 48),
(995, 5, 48),
(996, 2, 49),
(997, 6, 49),
(998, 2, 50),
(999, 3, 50),
(1000, 2, 51),
(1001, 6, 51),
(1002, 2, 52),
(1003, 5, 52),
(1004, 2, 53),
(1005, 3, 53),
(1006, 2, 54),
(1007, 3, 54),
(1008, 2, 55),
(1009, 5, 55),
(1046, 2, 56),
(1047, 6, 56),
(1048, 2, 57),
(1049, 5, 57),
(1050, 2, 58),
(1051, 3, 58),
(1052, 2, 59),
(1053, 6, 59),
(1054, 2, 60),
(1055, 4, 60),
(1056, 2, 61),
(1057, 8, 61);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamówienia`
--

CREATE TABLE `zamówienia` (
  `ID_ZAM` int(11) NOT NULL,
  `NR_STOLIKA` tinyint(4) DEFAULT NULL,
  `ID_DANIA` smallint(6) DEFAULT NULL,
  `KOMENTARZ` varchar(100) DEFAULT NULL,
  `KUCHARZ_CHECK` tinyint(1) DEFAULT NULL,
  `KELNER_CHECK` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamówienia`
--

INSERT INTO `zamówienia` (`ID_ZAM`, `NR_STOLIKA`, `ID_DANIA`, `KOMENTARZ`, `KUCHARZ_CHECK`, `KELNER_CHECK`) VALUES
(1, 6, 2, NULL, NULL, NULL),
(2, 6, 12, NULL, 1, 1),
(3, 6, 18, NULL, 1, 1),
(4, 6, 14, NULL, 1, 1),
(6, 5, 8, NULL, 1, 1),
(7, 5, 14, NULL, NULL, NULL),
(8, 5, 12, NULL, 1, 1),
(9, 5, 17, NULL, 1, 1),
(10, 5, 15, NULL, 1, 1),
(11, 5, 16, NULL, NULL, 0),
(12, 6, 8, NULL, 1, NULL),
(14, 37, 2, NULL, 0, 0),
(15, 37, 2, NULL, 1, 1),
(16, 37, 2, NULL, 1, 1),
(17, 5, 1, NULL, NULL, NULL),
(18, 5, 3, NULL, NULL, NULL),
(19, 5, 20, NULL, NULL, NULL),
(20, 5, 19, NULL, NULL, NULL),
(21, 5, 5, NULL, NULL, NULL),
(22, 7, 6, NULL, NULL, NULL),
(23, 7, 19, NULL, NULL, NULL),
(24, 7, 3, NULL, NULL, NULL),
(25, 7, 2, NULL, NULL, NULL),
(26, 7, 18, NULL, NULL, NULL),
(27, 7, 2, NULL, NULL, NULL),
(28, 25, 9, NULL, NULL, NULL),
(29, 25, 15, NULL, NULL, NULL),
(30, 25, 2, NULL, NULL, NULL),
(31, 25, 2, NULL, NULL, NULL),
(32, 25, 12, NULL, NULL, NULL),
(33, 25, 14, NULL, NULL, NULL),
(34, 25, 15, NULL, NULL, NULL),
(35, 25, 16, NULL, NULL, NULL),
(36, 25, 11, NULL, NULL, NULL),
(37, 25, 9, NULL, NULL, NULL),
(38, 25, 8, NULL, NULL, NULL),
(39, 25, 14, NULL, NULL, NULL),
(40, 25, 15, NULL, NULL, NULL),
(41, 25, 12, NULL, NULL, NULL),
(42, 25, 2, NULL, NULL, NULL),
(43, 25, 17, NULL, NULL, NULL),
(44, 25, 18, NULL, NULL, NULL),
(45, 25, 14, NULL, NULL, NULL),
(46, 25, 15, NULL, NULL, NULL),
(47, 25, 16, NULL, NULL, NULL),
(48, 25, 9, NULL, NULL, NULL),
(49, 25, 8, NULL, NULL, NULL),
(50, 25, 12, NULL, NULL, NULL),
(51, 25, 14, NULL, NULL, NULL),
(52, 25, 2, NULL, NULL, NULL),
(53, 25, 18, NULL, NULL, NULL),
(54, 25, 17, NULL, NULL, NULL),
(55, 25, 12, NULL, NULL, NULL),
(56, 8, 2, NULL, NULL, NULL),
(57, 4, 2, NULL, NULL, NULL),
(58, 4, 8, NULL, NULL, NULL),
(59, 4, 14, NULL, NULL, NULL),
(60, 4, 3, NULL, NULL, NULL),
(61, 4, 7, NULL, NULL, NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dania`
--
ALTER TABLE `dania`
  ADD PRIMARY KEY (`ID_DANIA`);

--
-- Indeksy dla tabeli `logowanie`
--
ALTER TABLE `logowanie`
  ADD PRIMARY KEY (`ID_PRAC`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`ID_PRAC`);

--
-- Indeksy dla tabeli `stat_dania_arch`
--
ALTER TABLE `stat_dania_arch`
  ADD PRIMARY KEY (`LP`),
  ADD KEY `ID_DANIA` (`ID_DANIA`);

--
-- Indeksy dla tabeli `stat_firmy`
--
ALTER TABLE `stat_firmy`
  ADD PRIMARY KEY (`LP`);

--
-- Indeksy dla tabeli `stat_prac_arch`
--
ALTER TABLE `stat_prac_arch`
  ADD PRIMARY KEY (`LP`),
  ADD KEY `ID_PRAC` (`ID_PRAC`);

--
-- Indeksy dla tabeli `wykonawcy`
--
ALTER TABLE `wykonawcy`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PRAC` (`ID_PRAC`),
  ADD KEY `ID_ZAM` (`ID_ZAM`);

--
-- Indeksy dla tabeli `zamówienia`
--
ALTER TABLE `zamówienia`
  ADD PRIMARY KEY (`ID_ZAM`),
  ADD KEY `ID_DANIA` (`ID_DANIA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stat_dania_arch`
--
ALTER TABLE `stat_dania_arch`
  MODIFY `LP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `stat_firmy`
--
ALTER TABLE `stat_firmy`
  MODIFY `LP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stat_prac_arch`
--
ALTER TABLE `stat_prac_arch`
  MODIFY `LP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `wykonawcy`
--
ALTER TABLE `wykonawcy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1062;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stat_dania_arch`
--
ALTER TABLE `stat_dania_arch`
  ADD CONSTRAINT `stat_dania_arch_ibfk_1` FOREIGN KEY (`ID_DANIA`) REFERENCES `dania` (`ID_DANIA`);

--
-- Constraints for table `stat_prac_arch`
--
ALTER TABLE `stat_prac_arch`
  ADD CONSTRAINT `stat_prac_arch_ibfk_1` FOREIGN KEY (`ID_PRAC`) REFERENCES `pracownicy` (`ID_PRAC`);

--
-- Constraints for table `wykonawcy`
--
ALTER TABLE `wykonawcy`
  ADD CONSTRAINT `wykonawcy_ibfk_1` FOREIGN KEY (`ID_PRAC`) REFERENCES `pracownicy` (`ID_PRAC`),
  ADD CONSTRAINT `wykonawcy_ibfk_2` FOREIGN KEY (`ID_ZAM`) REFERENCES `zamówienia` (`ID_ZAM`);

--
-- Constraints for table `zamówienia`
--
ALTER TABLE `zamówienia`
  ADD CONSTRAINT `zamówienia_ibfk_1` FOREIGN KEY (`ID_DANIA`) REFERENCES `dania` (`ID_DANIA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
