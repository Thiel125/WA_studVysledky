-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 05. kvě 2023, 18:53
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `databaze_skola`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `absence`
--

CREATE TABLE `absence` (
  `ID_absence` int(11) NOT NULL,
  `popis` text NOT NULL,
  `stav` set('neomluveno','omluveno') NOT NULL,
  `ID_hodina` int(11) NOT NULL,
  `ID_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `absence`
--

INSERT INTO `absence` (`ID_absence`, `popis`, `stav`, `ID_hodina`, `ID_student`) VALUES
(34, '', 'omluveno', 6, 1),
(35, '', 'omluveno', 6, 3),
(36, '', 'omluveno', 6, 1),
(37, '', 'omluveno', 6, 3),
(38, '', 'omluveno', 5, 1),
(39, '', 'omluveno', 5, 3),
(40, '', 'omluveno', 4, 1),
(41, '', 'omluveno', 4, 3),
(42, 'chyběla', 'omluveno', 4, 1),
(43, 'chyběla', 'omluveno', 4, 3),
(44, 'chyběla', 'omluveno', 5, 1),
(45, 'chyběla', 'omluveno', 5, 3),
(46, '', 'omluveno', 4, 1),
(47, '', 'omluveno', 13, 1),
(48, '', 'omluveno', 13, 3),
(49, '', 'omluveno', 4, 1),
(50, '', 'omluveno', 4, 3),
(51, '', 'omluveno', 5, 1),
(52, '', 'omluveno', 5, 3),
(53, 'ddd', 'omluveno', 5, 1),
(54, 'ddd', 'omluveno', 5, 3),
(55, 'chyběla', 'omluveno', 4, 1),
(56, '', 'omluveno', 9, 1),
(57, '', 'omluveno', 31, 488),
(58, '', 'omluveno', 31, 489),
(59, '', 'omluveno', 32, 488),
(60, '', 'omluveno', 32, 489),
(61, '', 'omluveno', 33, 488),
(62, '', 'omluveno', 33, 489),
(63, '', 'omluveno', 32, 488),
(64, '', 'omluveno', 32, 489),
(65, '', 'omluveno', 31, 488),
(66, '', 'omluveno', 31, 489),
(67, '', 'omluveno', 54, 490),
(68, '', 'omluveno', 54, 491),
(69, '', 'omluveno', 5, 1),
(70, '', 'omluveno', 5, 3),
(71, '', 'omluveno', 91, 493),
(72, '', 'omluveno', 91, 494),
(73, '', 'omluveno', 91, 493),
(74, '', 'omluveno', 91, 494),
(75, 'nemoc', 'omluveno', 4, 1),
(76, 'nemoc', 'omluveno', 4, 3),
(77, 'aktivita', 'omluveno', 4, 1),
(78, 'aktivita', 'omluveno', 4, 3),
(79, '', 'omluveno', 4, 1),
(80, '', 'omluveno', 4, 3),
(81, 'dsada', 'omluveno', 4, 1),
(82, 'dsada', 'omluveno', 4, 3),
(83, 'dsadasdas', 'omluveno', 4, 1),
(84, 'dsadasdas', 'omluveno', 4, 3),
(85, 'chyběl', 'omluveno', 5, 1),
(86, 'chyběl', 'omluveno', 5, 3),
(87, 'chyběl', 'omluveno', 5, 495),
(88, 'chyběl', 'omluveno', 5, 496),
(89, 'chyběl', 'omluveno', 5, 497),
(90, '', 'omluveno', 18, 1),
(91, '', 'omluveno', 18, 3),
(92, '', 'omluveno', 18, 495),
(93, '', 'omluveno', 18, 1),
(94, '', 'omluveno', 18, 3),
(95, '', 'omluveno', 18, 496),
(96, 'dasdsa', 'omluveno', 4, 1),
(97, 'dasdsa', 'omluveno', 4, 3),
(98, 'dasdsa', 'omluveno', 4, 495),
(99, 'dasdsa', 'omluveno', 4, 496),
(100, 'dasdsa', 'omluveno', 4, 497),
(101, 'chyběla', 'omluveno', 4, 1),
(102, 'chyběla', 'omluveno', 4, 3),
(103, 'chyběla', 'omluveno', 4, 495),
(104, 'chyběla', 'omluveno', 4, 496),
(105, 'chyběla', 'omluveno', 4, 497);

-- --------------------------------------------------------

--
-- Struktura tabulky `admin`
--

CREATE TABLE `admin` (
  `ID_admin` int(11) NOT NULL,
  `jmeno` varchar(20) NOT NULL,
  `heslo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `admin`
--

INSERT INTO `admin` (`ID_admin`, `jmeno`, `heslo`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabulky `hodina`
--

CREATE TABLE `hodina` (
  `ID_hodina` int(11) NOT NULL,
  `den` set('Pondělí','Úterý','Středa','Čtvrtek','Pátek') NOT NULL,
  `od` set('8:00','9:00','10:00','11:00','12:00','13:00','14:00','15:00') NOT NULL,
  `do` set('8:45','9:45','10:45','11:45','12:45','13:45','14:45','15:45') NOT NULL,
  `ID_trida` int(11) NOT NULL,
  `ID_predmet` int(11) NOT NULL,
  `ID_ucitel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `hodina`
--

INSERT INTO `hodina` (`ID_hodina`, `den`, `od`, `do`, `ID_trida`, `ID_predmet`, `ID_ucitel`) VALUES
(4, 'Pondělí', '8:00', '8:45', 1, 2, 1),
(5, 'Pondělí', '9:00', '9:45', 1, 12, 1),
(6, 'Pondělí', '10:00', '10:45', 1, 2, 1),
(7, 'Pondělí', '11:00', '11:45', 1, 11, 1),
(8, 'Úterý', '8:00', '8:45', 1, 2, 1),
(9, 'Úterý', '9:00', '9:45', 1, 1, 1),
(10, 'Úterý', '10:00', '10:45', 1, 2, 1),
(11, 'Úterý', '11:00', '11:45', 1, 13, 1),
(12, 'Středa', '8:00', '8:45', 1, 2, 1),
(13, 'Středa', '9:00', '9:45', 1, 1, 1),
(14, 'Středa', '10:00', '10:45', 1, 12, 1),
(15, 'Středa', '11:00', '11:45', 1, 2, 1),
(16, 'Čtvrtek', '8:00', '8:45', 1, 2, 1),
(17, 'Čtvrtek', '9:00', '9:45', 1, 1, 1),
(18, 'Čtvrtek', '10:00', '10:45', 1, 13, 1),
(19, 'Čtvrtek', '11:00', '11:45', 1, 10, 1),
(20, 'Pátek', '8:00', '8:45', 1, 2, 1),
(21, 'Pátek', '9:00', '9:45', 1, 1, 1),
(22, 'Pátek', '10:00', '10:45', 1, 2, 1),
(23, 'Pátek', '11:00', '11:45', 1, 11, 1),
(30, 'Pondělí', '8:00', '8:45', 16, 2, 2),
(31, 'Pondělí', '9:00', '9:45', 16, 1, 2),
(32, 'Pondělí', '10:00', '10:45', 16, 13, 2),
(33, 'Pondělí', '11:00', '11:45', 16, 2, 2),
(34, 'Úterý', '8:00', '8:45', 16, 2, 2),
(35, 'Úterý', '9:00', '9:45', 16, 1, 2),
(37, 'Úterý', '10:00', '10:45', 16, 14, 2),
(38, 'Úterý', '11:00', '11:45', 16, 2, 2),
(39, 'Úterý', '12:00', '12:45', 16, 10, 2),
(40, 'Středa', '8:00', '8:45', 16, 1, 2),
(41, 'Středa', '9:00', '9:45', 16, 2, 2),
(42, 'Středa', '10:00', '10:45', 16, 13, 2),
(43, 'Středa', '12:00', '12:45', 16, 2, 2),
(44, 'Čtvrtek', '8:00', '8:45', 16, 2, 2),
(45, 'Čtvrtek', '9:00', '9:45', 16, 1, 2),
(46, 'Čtvrtek', '10:00', '10:45', 16, 2, 2),
(47, 'Čtvrtek', '11:00', '11:45', 16, 12, 2),
(48, 'Čtvrtek', '12:00', '12:45', 16, 12, 2),
(49, 'Pátek', '8:00', '8:45', 16, 1, 2),
(50, 'Pátek', '9:00', '9:45', 16, 2, 2),
(51, 'Pátek', '10:00', '10:45', 16, 11, 2),
(52, 'Pátek', '11:00', '11:45', 16, 2, 2),
(53, 'Pondělí', '8:00', '8:45', 17, 3, 3),
(54, 'Pondělí', '9:00', '9:45', 17, 2, 3),
(55, 'Pondělí', '10:00', '10:45', 17, 1, 3),
(56, 'Pondělí', '11:00', '11:45', 17, 2, 3),
(57, 'Úterý', '8:00', '8:45', 17, 2, 3),
(58, 'Úterý', '9:00', '9:45', 17, 1, 3),
(59, 'Úterý', '10:00', '10:45', 17, 10, 3),
(60, 'Úterý', '11:00', '11:45', 17, 2, 3),
(61, 'Úterý', '12:00', '12:45', 17, 3, 10),
(62, 'Středa', '8:00', '8:45', 17, 2, 3),
(63, 'Středa', '9:00', '9:45', 17, 1, 3),
(64, 'Středa', '10:00', '10:45', 17, 13, 3),
(65, 'Středa', '11:00', '11:45', 17, 2, 3),
(66, 'Středa', '12:00', '12:45', 17, 14, 3),
(67, 'Čtvrtek', '8:00', '8:45', 17, 2, 3),
(68, 'Čtvrtek', '9:00', '9:45', 17, 1, 3),
(69, 'Čtvrtek', '10:00', '10:45', 17, 3, 10),
(70, 'Čtvrtek', '11:00', '11:45', 17, 12, 3),
(71, 'Čtvrtek', '12:00', '12:45', 17, 12, 3),
(72, 'Pátek', '8:00', '8:45', 17, 2, 3),
(73, 'Pátek', '9:00', '9:45', 17, 1, 3),
(74, 'Pátek', '10:00', '10:45', 17, 13, 3),
(75, 'Pátek', '11:00', '11:45', 17, 2, 3),
(76, 'Pátek', '12:00', '12:45', 17, 11, 3),
(77, 'Pondělí', '8:00', '8:45', 29, 2, 11),
(78, 'Pondělí', '9:00', '9:45', 29, 3, 11),
(79, 'Pondělí', '10:00', '10:45', 29, 14, 12),
(80, 'Pondělí', '12:00', '12:45', 29, 1, 11),
(81, 'Pondělí', '13:00', '13:45', 29, 7, 11),
(82, 'Úterý', '8:00', '8:45', 29, 2, 11),
(83, 'Úterý', '9:00', '9:45', 29, 1, 11),
(84, 'Úterý', '10:00', '10:45', 29, 3, 11),
(85, 'Úterý', '11:00', '11:45', 29, 4, 11),
(86, 'Úterý', '12:00', '12:45', 29, 2, 11),
(87, 'Středa', '8:00', '8:45', 29, 2, 11),
(88, 'Středa', '9:00', '9:45', 29, 1, 11),
(89, 'Středa', '10:00', '10:45', 29, 7, 11),
(90, 'Středa', '11:00', '11:45', 29, 2, 11),
(91, 'Středa', '12:00', '12:45', 29, 15, 13),
(92, 'Čtvrtek', '8:00', '8:45', 29, 2, 11),
(93, 'Čtvrtek', '9:00', '9:45', 29, 4, 11),
(94, 'Čtvrtek', '10:00', '10:45', 29, 1, 11),
(95, 'Čtvrtek', '11:00', '11:45', 29, 12, 14),
(96, 'Čtvrtek', '12:00', '12:45', 29, 12, 14),
(97, 'Pátek', '8:00', '8:45', 29, 3, 11),
(98, 'Pátek', '9:00', '9:45', 29, 10, 15),
(99, 'Pátek', '10:00', '10:45', 29, 10, 15),
(100, 'Pátek', '11:00', '11:45', 29, 1, 11),
(101, 'Pátek', '12:00', '12:45', 29, 2, 11);

-- --------------------------------------------------------

--
-- Struktura tabulky `predmet`
--

CREATE TABLE `predmet` (
  `ID_predmet` int(11) NOT NULL,
  `nazev` varchar(20) NOT NULL,
  `zkratka` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `predmet`
--

INSERT INTO `predmet` (`ID_predmet`, `nazev`, `zkratka`) VALUES
(1, 'Matematika', 'M'),
(2, 'Český jazyk', 'Čj'),
(3, 'Anglický jazyk', 'Aj'),
(4, 'Biologie', 'B'),
(5, 'Chemie', 'CH'),
(6, 'Fyzika', 'F'),
(7, 'Dějepis', 'D'),
(8, 'Zeměpis', 'Z'),
(9, 'Občanská výchova', 'Ov'),
(10, 'Výtvarná výchova', 'Vv'),
(11, 'Hudební výchova', 'Hv'),
(12, 'Tělesná výchova', 'Tv'),
(13, 'Prvouka', 'Prv'),
(14, 'Pracovní činnosti', 'Pč'),
(15, 'Informatika', 'I');

-- --------------------------------------------------------

--
-- Struktura tabulky `student`
--

CREATE TABLE `student` (
  `ID_student` int(11) NOT NULL,
  `jmeno` varchar(20) NOT NULL,
  `prijmeni` varchar(20) NOT NULL,
  `datum_narozeni` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `heslo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `student`
--

INSERT INTO `student` (`ID_student`, `jmeno`, `prijmeni`, `datum_narozeni`, `email`, `heslo`) VALUES
(1, 'Kateřina', 'Novotná', '2016-09-16', 'katerina.novotna@email.com', 'katerinanovotna'),
(2, 'Petr ', 'Svoboda', '2015-03-01', 'petr.svoboda@email.com', 'petrsvoboda'),
(3, 'Lucie', 'Hájková', '2016-09-14', 'lucie.hajkova@email.com', 'luciehajkova'),
(488, 'Filip ', 'Král', '2015-03-02', 'filip.kral@email.com', 'filipkral'),
(489, 'Tereza ', 'Novotná', '2015-04-14', 'tereza.novotna@email.com', 'terezanovotna'),
(490, 'Martin', 'Novák', '2014-08-17', 'martin.novak@email.com', 'martinnovak'),
(491, 'Eliška', 'Svobodová', '2014-05-24', 'eliska.svobodova@email.com', 'eliskasvobodova'),
(493, 'David', 'Vlček', '2013-05-21', 'david.vlcek@email.com', 'davidvlcek'),
(494, 'Kristýna', 'Nová', '2013-06-29', 'kristyna.nova@email.com', 'kristynanova'),
(495, 'Lukáš', 'Novák', '2016-06-14', 'lukas.novak@email.com', 'lukasnovak'),
(496, 'Monika', 'Vlčková', '2016-09-14', 'monika.vlckova@email.com', 'monikavlckova'),
(497, 'David', 'Obrman', '2016-11-01', 'david.obrman@email.com', 'davidobrman');

-- --------------------------------------------------------

--
-- Struktura tabulky `trida`
--

CREATE TABLE `trida` (
  `ID_trida` int(11) NOT NULL,
  `rocnik` set('první','druhý','třetí','čtvrtý','pátý','šestý','sedmý','osmý','devátý') NOT NULL,
  `skolni_rok` varchar(9) NOT NULL,
  `oznaceni_ucebny` varchar(4) NOT NULL,
  `ID_tridni_ucitel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `trida`
--

INSERT INTO `trida` (`ID_trida`, `rocnik`, `skolni_rok`, `oznaceni_ucebny`, `ID_tridni_ucitel`) VALUES
(1, 'první', '2022/2023', 'U100', 1),
(16, 'druhý', '2022/2023', 'U110', 2),
(17, 'třetí', '2022/2023', 'U120', 3),
(29, 'čtvrtý', '2022/2023', 'U130', 11);

-- --------------------------------------------------------

--
-- Struktura tabulky `trida_seznam_studentu`
--

CREATE TABLE `trida_seznam_studentu` (
  `ID` int(11) NOT NULL,
  `ID_trida` int(11) NOT NULL,
  `ID_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `trida_seznam_studentu`
--

INSERT INTO `trida_seznam_studentu` (`ID`, `ID_trida`, `ID_student`) VALUES
(1, 1, 1),
(2, 1, 3),
(18, 16, 488),
(19, 16, 489),
(20, 17, 490),
(21, 17, 491),
(22, 29, 493),
(23, 29, 494),
(24, 1, 495),
(25, 1, 496),
(26, 1, 497);

-- --------------------------------------------------------

--
-- Struktura tabulky `ucitel`
--

CREATE TABLE `ucitel` (
  `ID_ucitel` int(11) NOT NULL,
  `jmeno` varchar(20) NOT NULL,
  `prijmeni` varchar(20) NOT NULL,
  `datum_narozeni` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `heslo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `ucitel`
--

INSERT INTO `ucitel` (`ID_ucitel`, `jmeno`, `prijmeni`, `datum_narozeni`, `email`, `heslo`) VALUES
(1, 'Markéta', 'Kovaříková', '1993-09-10', 'marketa.kovarikova@email.com', 'marketakovarikova'),
(2, 'Tomáš', 'Vacek', '1990-07-11', 'tomas.vacek@email.com', 'tomasvacek'),
(3, 'Petra', 'Králová', '1997-03-19', 'petra.kralova@email.com', 'petrakralova'),
(10, 'Pavel ', 'Jiří', '1992-04-14', 'pavel.jiri@email.com', 'paveljiri'),
(11, 'Jan', 'Novotný', '1984-05-08', 'jan.novotny@email.com', 'jannovotny'),
(12, 'Lukáš', 'Obrman', '1985-07-23', 'lukas.obrman@email.com', 'lukasobrman'),
(13, 'Nikola', 'Břecká', '1995-02-24', 'nikola.brecka@email.com', 'nikolabrecka'),
(14, 'Milan', 'Koval', '1990-06-29', 'milan.koval@email.com', 'milankoval'),
(15, 'Jan', 'Soška', '1977-12-22', 'jan.soska@email.com', 'jansoska');

-- --------------------------------------------------------

--
-- Struktura tabulky `znamka`
--

CREATE TABLE `znamka` (
  `ID_znamka` int(11) NOT NULL,
  `hodnoceni` float(2,1) DEFAULT NULL,
  `popis` text NOT NULL,
  `poznamka` text NOT NULL,
  `datum` date NOT NULL,
  `ID_student` int(11) NOT NULL,
  `ID_predmet` int(11) NOT NULL,
  `ID_trida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `znamka`
--

INSERT INTO `znamka` (`ID_znamka`, `hodnoceni`, `popis`, `poznamka`, `datum`, `ID_student`, `ID_predmet`, `ID_trida`) VALUES
(1, 1.0, 'aktivita', '', '0000-00-00', 1, 2, 1),
(163, 1.0, 'skok', '', '2023-03-09', 1, 12, 1),
(167, 2.0, 'test', '', '2023-04-06', 1, 2, 1),
(179, 1.0, 'písemka', '', '2023-04-12', 493, 2, 29),
(187, 1.5, 'pisemka', '', '2023-04-19', 1, 13, 1),
(188, 1.5, 'pisemka', '', '2023-04-19', 3, 13, 1),
(189, 1.0, 'zpěv', '', '2023-04-12', 1, 11, 1),
(190, 1.5, 'zpěv', '', '2023-04-12', 3, 11, 1),
(191, 2.0, 'písemka', 'dsadsa', '2023-04-12', 1, 2, 1),
(192, 3.0, 'písemka', 'fdsads', '2023-04-12', 3, 2, 1),
(195, 1.0, 'písemka', 'výborné', '2023-04-20', 1, 10, 1),
(196, 2.0, 'písemka', 'pár chybiček', '2023-04-20', 3, 10, 1),
(197, 4.0, 'písemka', 'jen tak tak', '2023-04-20', 495, 10, 1),
(198, 1.5, 'písemka', '', '2023-04-20', 496, 10, 1),
(199, 0.0, 'písemka', 'chyběl;nehodnoceno', '2023-04-20', 497, 10, 1),
(220, 0.0, 'aktivita', '', '2023-04-06', 1, 2, 1),
(221, 0.0, 'aktivita', '', '2023-04-06', 3, 2, 1),
(222, 0.0, 'aktivita', '', '2023-04-06', 495, 2, 1),
(223, 0.0, 'aktivita', '', '2023-04-06', 496, 2, 1),
(224, 0.0, 'aktivita', '', '2023-04-06', 497, 2, 1),
(225, 0.0, 'skok', '', '2023-04-20', 1, 12, 1),
(226, 0.0, 'skok', '', '2023-04-20', 3, 12, 1),
(227, 0.0, 'skok', '', '2023-04-20', 495, 12, 1),
(228, 0.0, 'skok', '', '2023-04-20', 496, 12, 1),
(229, 0.0, 'skok', '', '2023-04-20', 497, 12, 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`ID_absence`),
  ADD KEY `ID_hodina` (`ID_hodina`),
  ADD KEY `ID_student` (`ID_student`);

--
-- Indexy pro tabulku `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_admin`);

--
-- Indexy pro tabulku `hodina`
--
ALTER TABLE `hodina`
  ADD PRIMARY KEY (`ID_hodina`),
  ADD KEY `ID_trida` (`ID_trida`),
  ADD KEY `ID_predmet` (`ID_predmet`),
  ADD KEY `ID_ucitel` (`ID_ucitel`);

--
-- Indexy pro tabulku `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`ID_predmet`);

--
-- Indexy pro tabulku `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID_student`),
  ADD KEY `prijmeni` (`prijmeni`);

--
-- Indexy pro tabulku `trida`
--
ALTER TABLE `trida`
  ADD PRIMARY KEY (`ID_trida`),
  ADD UNIQUE KEY `skolni_rok` (`skolni_rok`,`ID_tridni_ucitel`),
  ADD KEY `ID_tridni_ucitel` (`ID_tridni_ucitel`);

--
-- Indexy pro tabulku `trida_seznam_studentu`
--
ALTER TABLE `trida_seznam_studentu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_trida` (`ID_trida`),
  ADD KEY `ID_student` (`ID_student`);

--
-- Indexy pro tabulku `ucitel`
--
ALTER TABLE `ucitel`
  ADD PRIMARY KEY (`ID_ucitel`);

--
-- Indexy pro tabulku `znamka`
--
ALTER TABLE `znamka`
  ADD PRIMARY KEY (`ID_znamka`),
  ADD KEY `ID_student` (`ID_student`),
  ADD KEY `ID_predmet` (`ID_predmet`),
  ADD KEY `ID_trida` (`ID_trida`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `absence`
--
ALTER TABLE `absence`
  MODIFY `ID_absence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT pro tabulku `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `hodina`
--
ALTER TABLE `hodina`
  MODIFY `ID_hodina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT pro tabulku `predmet`
--
ALTER TABLE `predmet`
  MODIFY `ID_predmet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `student`
--
ALTER TABLE `student`
  MODIFY `ID_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT pro tabulku `trida`
--
ALTER TABLE `trida`
  MODIFY `ID_trida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pro tabulku `trida_seznam_studentu`
--
ALTER TABLE `trida_seznam_studentu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pro tabulku `ucitel`
--
ALTER TABLE `ucitel`
  MODIFY `ID_ucitel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `znamka`
--
ALTER TABLE `znamka`
  MODIFY `ID_znamka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`ID_student`) REFERENCES `student` (`ID_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absence_ibfk_2` FOREIGN KEY (`ID_hodina`) REFERENCES `hodina` (`ID_hodina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `hodina`
--
ALTER TABLE `hodina`
  ADD CONSTRAINT `hodina_ibfk_1` FOREIGN KEY (`ID_predmet`) REFERENCES `predmet` (`ID_predmet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hodina_ibfk_2` FOREIGN KEY (`ID_trida`) REFERENCES `trida` (`ID_trida`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hodina_ibfk_3` FOREIGN KEY (`ID_ucitel`) REFERENCES `ucitel` (`ID_ucitel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `trida`
--
ALTER TABLE `trida`
  ADD CONSTRAINT `trida_ibfk_1` FOREIGN KEY (`ID_tridni_ucitel`) REFERENCES `ucitel` (`ID_ucitel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `trida_seznam_studentu`
--
ALTER TABLE `trida_seznam_studentu`
  ADD CONSTRAINT `trida_seznam_studentu_ibfk_1` FOREIGN KEY (`ID_student`) REFERENCES `student` (`ID_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trida_seznam_studentu_ibfk_2` FOREIGN KEY (`ID_trida`) REFERENCES `trida` (`ID_trida`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `znamka`
--
ALTER TABLE `znamka`
  ADD CONSTRAINT `znamka_ibfk_1` FOREIGN KEY (`ID_trida`) REFERENCES `trida` (`ID_trida`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `znamka_ibfk_2` FOREIGN KEY (`ID_student`) REFERENCES `student` (`ID_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `znamka_ibfk_3` FOREIGN KEY (`ID_predmet`) REFERENCES `predmet` (`ID_predmet`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
