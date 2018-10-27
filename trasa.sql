-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2018 at 03:04 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `banke`
--

CREATE TABLE `banke` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `racun_broj` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banke`
--

INSERT INTO `banke` (`id`, `ime`, `racun_broj`) VALUES
(1, 'Banka1', '123414');

-- --------------------------------------------------------

--
-- Table structure for table `benzinske_stanice`
--

CREATE TABLE `benzinske_stanice` (
  `id` int(11) NOT NULL,
  `naziv` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brojevi`
--

CREATE TABLE `brojevi` (
  `id` int(11) NOT NULL,
  `prvi` int(11) NOT NULL,
  `drugi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fakture`
--

CREATE TABLE `fakture` (
  `id` int(11) NOT NULL,
  `racun_broj` varchar(15) NOT NULL,
  `komplet_racun_broj` varchar(30) NOT NULL,
  `datum_izdavanja` varchar(15) NOT NULL,
  `valuta_placanja` varchar(15) NOT NULL,
  `datum_prometa` varchar(15) NOT NULL,
  `mesto_prometa` varchar(25) NOT NULL,
  `mesto_izdavanja_racuna` varchar(25) NOT NULL,
  `broj_naloga1` int(25) NOT NULL,
  `broj_naloga2` int(25) DEFAULT NULL,
  `od1` varchar(25) NOT NULL,
  `od2` varchar(25) DEFAULT NULL,
  `do1` varchar(25) NOT NULL,
  `do2` varchar(25) DEFAULT NULL,
  `cmr1` varchar(25) NOT NULL,
  `cmr2` varchar(25) DEFAULT NULL,
  `mesto_utovara1` varchar(90) NOT NULL,
  `mesto_utovara2` varchar(90) DEFAULT NULL,
  `mesto_istovara1` varchar(90) NOT NULL,
  `mesto_istovara2` varchar(90) DEFAULT NULL,
  `tezina1` varchar(25) NOT NULL,
  `tezina2` varchar(25) DEFAULT NULL,
  `fk_tegljac` int(11) NOT NULL,
  `fk_prikolica` int(11) NOT NULL,
  `iznos1` varchar(25) NOT NULL,
  `iznos2` varchar(25) DEFAULT NULL,
  `iznos` varchar(25) NOT NULL,
  `iznosEUR` varchar(25) NOT NULL,
  `kursEUR` varchar(10) NOT NULL,
  `sablon` varchar(50) NOT NULL,
  `fk_nalogodavac` int(11) NOT NULL,
  `ime_banke` varchar(50) NOT NULL,
  `racun_broj_banke` varchar(50) NOT NULL,
  `lokacija` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakture`
--

INSERT INTO `fakture` (`id`, `racun_broj`, `komplet_racun_broj`, `datum_izdavanja`, `valuta_placanja`, `datum_prometa`, `mesto_prometa`, `mesto_izdavanja_racuna`, `broj_naloga1`, `broj_naloga2`, `od1`, `od2`, `do1`, `do2`, `cmr1`, `cmr2`, `mesto_utovara1`, `mesto_utovara2`, `mesto_istovara1`, `mesto_istovara2`, `tezina1`, `tezina2`, `fk_tegljac`, `fk_prikolica`, `iznos1`, `iznos2`, `iznos`, `iznosEUR`, `kursEUR`, `sablon`, `fk_nalogodavac`, `ime_banke`, `racun_broj_banke`, `lokacija`) VALUES
(5, '', '1', '25.10.2018', '25.11.2018', '13.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Pristina', '', 'Napoli', '', '1234', '', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '1234', '', 34, 52, '12543.43', 'NaN', '12543.43', '105.83', '118.52', 'DinarskiSablon1Tura', 11, 'Banka1', '5434', ''),
(6, '', '1', '25.10.2018', '25.11.2018', '13.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Beograd', '', 'Milano', '', '1234', '', 'Hbis Group Serbia Iron & Steel d.o.o.', '', 'Bcube S.p.A.', '', '1234', '', 34, 52, '12345.00', 'NaN', '12345.00', '104.16', '118.52', 'DinarskiSablon1Tura', 11, 'Banka1', '5434', ''),
(7, '', '1', '25.10.2018', '25.11.2018', '20.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Beograd', '', 'Milano', '', '1234', '', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '1234', '', 34, 52, '12345.00', 'NaN', '12345.00', '104.16', '118.52', 'DinarskiSablon1Tura', 11, 'Banka1', '5434', ''),
(8, '', '4', '25.10.2018', '25.11.2018', '12.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Beograd', 'Napoli', 'Napoli', 'Milano', '1234', '1234', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '1234', '1234', 36, 44, '12345.00', '1234.67', '13579.67', '114.58', '118.52', 'DinarskiSablon2Ture', 11, 'Banka1', '5434', ''),
(9, '', '6', '25.10.2018', '25.11.2018', '19.10.2018', 'Beograd', 'Vidikovac', 0, 0, 'Beograd', 'Milano', 'Napoli', 'Beograd', '1234', '2134', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '1234', '1234', 32, 42, '12345.00', '12345.00', '24690.00', '208.32', '118.52', 'DinarskiSablon2Ture', 15, 'Banka1', '5434', ''),
(10, '', '1', '25.10.2018', '25.11.2018', '19.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Beograd', 'Milano', 'Napoli', 'Milano', '1234', '1234', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '1234', '1234', 34, 52, '1234.00', '12345.00', '13579.00', '114.57', '118.52', 'DinarskiSablon2Ture', 11, 'Banka1', '5434', ''),
(11, '', '9', '25.10.2018', '24.00.2019', '24.10.2018', 'Beograd', 'Vidikovac', 0, 0, 'Beograd', 'Milano', 'Milano', 'Napoli', '1234', '1234', 'Hbis Group Serbia Iron & Steel d.o.o.', '', 'Bcube S.p.A.', '', '1234', '12434', 38, 48, '1234.00', '1234.00', '2468.00', '20.82', '118.52', 'DinarskiSablon2Ture', 14, 'Banka1', '5434', ''),
(12, '', '1', '25.10.2018', '25.11.2018', '11.10.2018', 'Beograd', 'Vidikovac', 0, 0, 'Milano', 'Milano', 'Napoli', 'Beograd', '1234', '1234', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '1234', '1234', 34, 52, '12345.00', '12345.00', '24690.00', '208.32', '118.52', 'DinarskiSablon2Ture', 15, 'Banka1', '5434', ''),
(13, '', '1', '25.10.2018', '24.00.2019', '13.10.2018', 'Novi Beograd', 'Vidikovac', 0, 0, 'Milano', 'Beograd', 'Beograd', 'Napoli', '1234', '1234', 'Almex d.o.o.', '', 'Cartiera Dell\' Adda s.r.l.', '', '1234', '1234', 34, 52, '1234.00', '12345.00', '13579.00', '114.57', '118.52', 'DinarskiSablon2Ture', 13, 'Banka1', '5434', ''),
(14, '', '7', '25.10.2018', '24.00.2019', '02.10.2018', 'Novi Beograd', 'Vidikovac', 0, 0, 'Milano', 'Milano', 'Napoli', 'Napoli', '1234', '1234', 'Hbis Group Serbia Iron & Steel d.o.o.', '', 'Bcube S.p.A.', '', '1234', '1234', 35, 50, '12345.00', '12345.00', '24690.00', '208.32', '118.52', 'DinarskiSablon2Ture', 13, 'Banka1', '5434', ''),
(15, '', '3', '25.10.2018', '24.00.2019', '19.10.2018', 'Subotica', 'Vidikovac', 0, 0, 'Beograd', 'Milano', 'Milano', 'Napoli', '1234', '1234', 'Hbis Group Serbia Iron & Steel d.o.o.', 'Fas d.o.o.', 'Bcube S.p.A.', 'Fas d.o.o.', '1234', '1234', 30, 46, '12345.00', '12345.00', '24690.00', '208.32', '118.52', 'DinarskiSablon2Ture', 12, 'Banka1', '5434', ''),
(16, '', '1', '27.10.2018', '27.11.2018', '13.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Beograd', '', 'Milano', '', '3123123', '', 'Hbis Group Serbia Iron & Steel d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '12312312', '', 34, 52, '31241.00', 'NaN', '31241.00', '263.77', '118.44', 'DinarskiSablon1Tura', 11, 'Banka1', '123414', ''),
(17, '', '1', '27.10.2018', '27.11.2018', '13.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Beograd', '', 'Milano', '', '3123123', '', 'Hbis Group Serbia Iron & Steel d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '12312312', '', 34, 52, '31241.00', 'NaN', '31241.00', '263.77', '118.44', 'DinarskiSablon1Tura', 11, 'Banka1', '123414', ''),
(18, '', '5', '27.10.2018', '26.00.2019', '04.10.2018', 'Novi Beograd', 'Vidikovac', 0, 0, 'Milano', '', 'Milano', '', '312312', '', 'Fas d.o.o.', '', 'Bcube S.p.A.', '', '312312', '', 31, 40, '31241412.00', 'NaN', '31241412.00', '263774.16', '118.44', 'DinarskiSablon1Tura', 13, 'Banka1', '123414', ''),
(19, '', '4', '27.10.2018', '26.00.2019', '26.10.2018', 'Subotica', 'Vidikovac', 0, 0, 'Beograd', '', 'Milano', '', '132', '', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '132312', '', 36, 44, '41241.00', 'NaN', '41241.00', '348.20', '118.44', 'DinarskiSablon1Tura', 12, 'Banka1', '123414', ''),
(20, '', '7', '27.10.2018', '27.11.2018', '03.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Beograd', '', 'Milano', '', '12341', '', 'Almex d.o.o.', '', 'Bcube S.p.A.', '', '423423', '', 35, 50, '432423.00', 'NaN', '432423.00', '3650.99', '118.44', 'DinarskiSablon1Tura', 11, 'Banka1', '123414', ''),
(21, '', '2', '27.10.2018', '27.11.2018', '11.10.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Milano', '', 'Napoli', '', '12312312', '', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '3123123', '', 33, 51, '12414.00', 'NaN', '12414.00', '104.81', '118.44', 'DinarskiSablon1Tura', 11, 'Banka1', '123414', ''),
(22, '', '8', '27.10.2018', '26.00.2019', '13.10.2018', 'Novi Beograd', 'Vidikovac', 0, 0, 'Beograd', '', 'Napoli', '', '123414', '', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '124124', '', 37, 45, '31241.00', 'NaN', '31241.00', '263.77', '118.44', 'DinarskiSablon1Tura', 13, 'Banka1', '123414', '');

-- --------------------------------------------------------

--
-- Table structure for table `fakture_gorivo`
--

CREATE TABLE `fakture_gorivo` (
  `fk_fakture` int(11) NOT NULL,
  `fk_gorivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fakture_troskovi`
--

CREATE TABLE `fakture_troskovi` (
  `fk_fakture` int(11) NOT NULL,
  `fk_troskovi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gorivo`
--

CREATE TABLE `gorivo` (
  `id` int(11) NOT NULL,
  `datum` varchar(12) NOT NULL,
  `kilometraza` int(11) NOT NULL,
  `kolicina_litara` varchar(11) NOT NULL,
  `cena_po_litru` varchar(11) NOT NULL,
  `iznos` varchar(20) NOT NULL,
  `fk_benzinska_stanica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradovi`
--

CREATE TABLE `gradovi` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `drzava` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradovi`
--

INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES
(1, 'Beograd', 'SRB'),
(2, 'Milano', 'ITA'),
(3, 'Napoli', 'ITA');

-- --------------------------------------------------------

--
-- Table structure for table `kip`
--

CREATE TABLE `kip` (
  `id` int(11) NOT NULL,
  `fk_fakture` int(11) NOT NULL,
  `pocetna_kilometraza` int(11) NOT NULL,
  `zavrsna_kilometraza` int(11) NOT NULL,
  `potrosnja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kompleti`
--

CREATE TABLE `kompleti` (
  `id` int(11) NOT NULL,
  `fk_tegljac` int(11) NOT NULL,
  `fk_prikolica` int(11) NOT NULL,
  `broj` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompleti`
--

INSERT INTO `kompleti` (`id`, `fk_tegljac`, `fk_prikolica`, `broj`) VALUES
(60, 30, 46, 3),
(61, 31, 40, 5),
(62, 32, 42, 6),
(63, 33, 51, 2),
(64, 34, 52, 1),
(65, 36, 44, 4),
(66, 35, 50, 7),
(67, 38, 48, 9),
(68, 37, 45, 8),
(69, 39, 49, 10);

-- --------------------------------------------------------

--
-- Table structure for table `nalogodavci`
--

CREATE TABLE `nalogodavci` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `mesto` varchar(50) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `postanski_broj` int(11) NOT NULL,
  `pib` varchar(50) NOT NULL,
  `pak` varchar(50) NOT NULL,
  `rok_placanja` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nalogodavci`
--

INSERT INTO `nalogodavci` (`id`, `ime`, `mesto`, `adresa`, `postanski_broj`, `pib`, `pak`, `rok_placanja`) VALUES
(11, 'Todorovic company d.o.o.', 'Lozovik', 'JNA 110', 11317, '101177833', '', '30'),
(12, 'Kontinental Logistika d.o.o.', 'Subotica', 'Maksima Gorkog 31', 24000, '108475152', '', '60'),
(13, 'Milsped d.o.o.', 'Novi Beograd', 'Bulevar Zorana Djindjica 121', 11000, '100423446', '', '60'),
(14, 'Maverick Logistic Solutions d.o.o.', 'Beograd', 'Urosa Martinovica 19/3', 11070, '109647276', '', '60'),
(15, 'Kolibri Oil d.o.o.', 'Beograd', 'Mokroluska 32', 11000, '100372851', '', '30'),
(16, 'Autotrasporti Cambianica s.r.l.', 'San Paolo D’ Argon', 'Via Bergamo 12', 24060, 'IT 00 231 300 161', '', '60'),
(17, 'Ubv Torino s.r.l.', 'San Mauro Torinese', 'Corso Piemonte 19/21', 10099, 'IT 10 593 090 011', '', '60');

-- --------------------------------------------------------

--
-- Table structure for table `nalogodavci_banke`
--

CREATE TABLE `nalogodavci_banke` (
  `id` int(11) NOT NULL,
  `fk_nalogodavac` int(11) NOT NULL,
  `fk_banke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nalogodavci_banke`
--

INSERT INTO `nalogodavci_banke` (`id`, `fk_nalogodavac`, `fk_banke`) VALUES
(16, 11, 1),
(17, 11, 1),
(18, 13, 1),
(19, 12, 1),
(20, 11, 1),
(21, 11, 1),
(22, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pregledi_prikolice`
--

CREATE TABLE `pregledi_prikolice` (
  `id` int(11) NOT NULL,
  `fk_prikolica` int(11) NOT NULL,
  `registracija` varchar(30) NOT NULL,
  `sertifikat` varchar(30) NOT NULL,
  `sesto_mesecni` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pregledi_tegljaci`
--

CREATE TABLE `pregledi_tegljaci` (
  `id` int(11) NOT NULL,
  `fk_tegljac` int(11) NOT NULL,
  `fk_vozac` int(11) NOT NULL,
  `registracija` varchar(30) NOT NULL,
  `sertifikat` varchar(30) NOT NULL,
  `sesto_mesecni` varchar(30) NOT NULL,
  `tahograf` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prikolice`
--

CREATE TABLE `prikolice` (
  `id` int(11) NOT NULL,
  `broj_registracije` varchar(50) DEFAULT NULL,
  `marka` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prikolice`
--

INSERT INTO `prikolice` (`id`, `broj_registracije`, `marka`) VALUES
(40, 'AB-625-BG', 'Krone'),
(41, 'AB-082-BG', 'Krone'),
(42, 'ADJ-828-BG', 'Krone'),
(43, 'AT-170-BG', 'Krone'),
(44, 'AU-025-BG', 'Krone'),
(45, 'AU-237-BG', 'Krone'),
(46, 'AV-316-BG', 'Schmitz Cargobull'),
(47, 'AV-317-BG', 'Sscmitz Cargobull'),
(48, 'AZ-204-BG', 'Berger'),
(49, 'AZ-680-BG', 'Berger'),
(50, 'AC-17855', 'Schwarzmuller'),
(51, 'AD-33066', 'Schwarzmuller'),
(52, 'AA-28083', 'Schwarzmuller');

-- --------------------------------------------------------

--
-- Table structure for table `sleperi_vozaci`
--

CREATE TABLE `sleperi_vozaci` (
  `fk_komplet` int(11) NOT NULL,
  `od` date DEFAULT NULL,
  `do` date DEFAULT NULL,
  `fk_vozac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sleperi_vozaci`
--

INSERT INTO `sleperi_vozaci` (`fk_komplet`, `od`, `do`, `fk_vozac`) VALUES
(60, NULL, NULL, 7),
(61, NULL, NULL, 9),
(62, NULL, NULL, 6),
(63, NULL, NULL, 3),
(64, NULL, NULL, 4),
(65, NULL, NULL, 1),
(66, NULL, NULL, 2),
(67, NULL, NULL, 8),
(68, NULL, NULL, 5),
(69, NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tegljaci`
--

CREATE TABLE `tegljaci` (
  `id` int(11) NOT NULL,
  `broj_registracije` varchar(50) DEFAULT NULL,
  `marka` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `tip_tahografa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tegljaci`
--

INSERT INTO `tegljaci` (`id`, `broj_registracije`, `marka`, `model`, `tip_tahografa`) VALUES
(30, 'BG-253-MT', 'Daf', 'XF 105', 'Analogni'),
(31, 'BG-468-AE', 'Daf', 'XF 105', 'Analogni'),
(32, 'BG-499-CZ', 'Daf', 'XF 105', 'Analogni'),
(33, 'BG-849-IH', 'Iveco', 'Stralis', 'Analogni'),
(34, 'BG-976-XZ', 'Daf', 'XF 105', 'Analogni'),
(35, 'BG-1052-CN', 'Renault', 'T11', 'Digitalni'),
(36, 'BG-1052-BO', 'Renault', 'T11', 'Digitalni'),
(37, 'BG-1082-MI', 'Scania', 'R410', 'Digitalni'),
(38, 'BG-1082-MH', 'Scania', 'R410', 'Digitalni'),
(39, 'BG-1116-GK', 'Scania', 'R410', 'Digitalni');

-- --------------------------------------------------------

--
-- Table structure for table `troskovi`
--

CREATE TABLE `troskovi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(40) NOT NULL,
  `datum` varchar(10) NOT NULL,
  `iznos` float NOT NULL,
  `valuta` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uvoznici_izvoznici`
--

CREATE TABLE `uvoznici_izvoznici` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `u_i` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uvoznici_izvoznici`
--

INSERT INTO `uvoznici_izvoznici` (`id`, `ime`, `u_i`) VALUES
(20, 'Almex d.o.o.', 'Izvoznik'),
(21, 'Cartiera Dell\' Adda s.r.l.', 'Uvoznik'),
(22, 'Cartiera Di Bosco Marengo S.p.A.', 'Uvoznik'),
(23, 'Hbis Group Serbia Iron & Steel d.o.o.', 'Izvoznik'),
(24, 'Bcube S.p.A.', 'Oba'),
(25, 'Fas d.o.o.', 'Oba');

-- --------------------------------------------------------

--
-- Table structure for table `u_i_nalogodavac`
--

CREATE TABLE `u_i_nalogodavac` (
  `fk_nalogodavac` int(11) NOT NULL,
  `fk_u_i` int(11) NOT NULL,
  `broj` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `u_i_nalogodavac`
--

INSERT INTO `u_i_nalogodavac` (`fk_nalogodavac`, `fk_u_i`, `broj`) VALUES
(11, 20, 8),
(11, 22, 8),
(11, 23, 3),
(11, 24, 4),
(15, 20, 2),
(15, 23, 1),
(15, 22, 3),
(14, 23, 1),
(14, 20, 1),
(14, 24, 1),
(14, 25, 1),
(15, 25, 1),
(15, 21, 1),
(13, 20, 3),
(13, 25, 2),
(13, 21, 1),
(13, 22, 2),
(13, 23, 1),
(13, 24, 3),
(12, 23, 1),
(12, 25, 2),
(12, 24, 1),
(11, 0, 10),
(11, 25, 1),
(13, 0, 4),
(12, 20, 1),
(12, 0, 2),
(12, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vozaci`
--

CREATE TABLE `vozaci` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `br_pasosa` varchar(50) NOT NULL,
  `procenat` int(11) DEFAULT NULL,
  `uverenje` char(10) NOT NULL,
  `lekarsko` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vozaci`
--

INSERT INTO `vozaci` (`id`, `ime`, `prezime`, `br_pasosa`, `procenat`, `uverenje`, `lekarsko`) VALUES
(1, 'Vlada', 'Milutinovic', '011807899', 14, 'Da', ''),
(2, 'Zoran', 'Lukac', '007227223', 14, 'Da', ''),
(3, 'Dejan', 'Dakic', '012582397', 14, 'Da', ''),
(4, 'Predrag', 'Beric', '013300873', 14, 'Da', ''),
(5, 'Perica', 'Sladovic', '012363761', 14, 'Da', ''),
(6, 'Ivan', 'Ilic', '012704148', 13, 'Da', ''),
(7, 'Radenko', 'Uskokovic', '011092398', 12, 'Da', ''),
(8, 'Nikola', 'Stojanovic', '012829041', 13, 'Da', ''),
(9, 'Dejan', 'Mrckovic', '006793173', 11, 'Da', ''),
(10, 'Zeljko', 'Popovic', '012396926', 12, 'Da', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banke`
--
ALTER TABLE `banke`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benzinske_stanice`
--
ALTER TABLE `benzinske_stanice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brojevi`
--
ALTER TABLE `brojevi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakture`
--
ALTER TABLE `fakture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakture_tegljac_FK` (`fk_tegljac`),
  ADD KEY `fakture_nalogodavac_FK` (`fk_nalogodavac`),
  ADD KEY `fakture_prikolica_FK` (`fk_prikolica`);

--
-- Indexes for table `fakture_gorivo`
--
ALTER TABLE `fakture_gorivo`
  ADD KEY `FK_fakture` (`fk_fakture`),
  ADD KEY `FK_gorivo` (`fk_gorivo`);

--
-- Indexes for table `fakture_troskovi`
--
ALTER TABLE `fakture_troskovi`
  ADD KEY `fakture_FK` (`fk_fakture`),
  ADD KEY `troskovi_FK` (`fk_troskovi`);

--
-- Indexes for table `gorivo`
--
ALTER TABLE `gorivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `benzninska_stanica_FK` (`fk_benzinska_stanica`);

--
-- Indexes for table `gradovi`
--
ALTER TABLE `gradovi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ime` (`ime`);

--
-- Indexes for table `kip`
--
ALTER TABLE `kip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kompleti`
--
ALTER TABLE `kompleti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prikolica` (`fk_prikolica`),
  ADD KEY `fk_tegljac` (`fk_tegljac`);

--
-- Indexes for table `nalogodavci`
--
ALTER TABLE `nalogodavci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nalogodavci_banke`
--
ALTER TABLE `nalogodavci_banke`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banka_FK` (`fk_banke`),
  ADD KEY `FK_nalogodavac` (`fk_nalogodavac`);

--
-- Indexes for table `pregledi_prikolice`
--
ALTER TABLE `pregledi_prikolice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prikolica_FK` (`fk_prikolica`);

--
-- Indexes for table `pregledi_tegljaci`
--
ALTER TABLE `pregledi_tegljaci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregled_tegljac_FK` (`fk_tegljac`),
  ADD KEY `pregled_vozac_FK` (`fk_vozac`);

--
-- Indexes for table `prikolice`
--
ALTER TABLE `prikolice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sleperi_vozaci`
--
ALTER TABLE `sleperi_vozaci`
  ADD PRIMARY KEY (`fk_komplet`,`fk_vozac`),
  ADD KEY `fk_vozac` (`fk_vozac`);

--
-- Indexes for table `tegljaci`
--
ALTER TABLE `tegljaci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `troskovi`
--
ALTER TABLE `troskovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uvoznici_izvoznici`
--
ALTER TABLE `uvoznici_izvoznici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u_i_nalogodavac`
--
ALTER TABLE `u_i_nalogodavac`
  ADD KEY `u_i_FK` (`fk_u_i`),
  ADD KEY `nalogodavac_FK` (`fk_nalogodavac`);

--
-- Indexes for table `vozaci`
--
ALTER TABLE `vozaci`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banke`
--
ALTER TABLE `banke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `benzinske_stanice`
--
ALTER TABLE `benzinske_stanice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brojevi`
--
ALTER TABLE `brojevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakture`
--
ALTER TABLE `fakture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `gorivo`
--
ALTER TABLE `gorivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradovi`
--
ALTER TABLE `gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kip`
--
ALTER TABLE `kip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nalogodavci`
--
ALTER TABLE `nalogodavci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nalogodavci_banke`
--
ALTER TABLE `nalogodavci_banke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pregledi_prikolice`
--
ALTER TABLE `pregledi_prikolice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pregledi_tegljaci`
--
ALTER TABLE `pregledi_tegljaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prikolice`
--
ALTER TABLE `prikolice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tegljaci`
--
ALTER TABLE `tegljaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `troskovi`
--
ALTER TABLE `troskovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uvoznici_izvoznici`
--
ALTER TABLE `uvoznici_izvoznici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vozaci`
--
ALTER TABLE `vozaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fakture`
--
ALTER TABLE `fakture`
  ADD CONSTRAINT `fakture_nalogodavac_FK` FOREIGN KEY (`fk_nalogodavac`) REFERENCES `nalogodavci` (`id`),
  ADD CONSTRAINT `fakture_prikolica_FK` FOREIGN KEY (`fk_prikolica`) REFERENCES `prikolice` (`id`),
  ADD CONSTRAINT `fakture_tegljac_FK` FOREIGN KEY (`fk_tegljac`) REFERENCES `tegljaci` (`id`);

--
-- Constraints for table `fakture_gorivo`
--
ALTER TABLE `fakture_gorivo`
  ADD CONSTRAINT `FK_fakture` FOREIGN KEY (`fk_fakture`) REFERENCES `fakture` (`id`),
  ADD CONSTRAINT `FK_gorivo` FOREIGN KEY (`fk_gorivo`) REFERENCES `gorivo` (`id`);

--
-- Constraints for table `fakture_troskovi`
--
ALTER TABLE `fakture_troskovi`
  ADD CONSTRAINT `fakture_FK` FOREIGN KEY (`fk_fakture`) REFERENCES `fakture` (`id`),
  ADD CONSTRAINT `troskovi_FK` FOREIGN KEY (`fk_troskovi`) REFERENCES `troskovi` (`id`);

--
-- Constraints for table `gorivo`
--
ALTER TABLE `gorivo`
  ADD CONSTRAINT `benzninska_stanica_FK` FOREIGN KEY (`fk_benzinska_stanica`) REFERENCES `benzinske_stanice` (`id`);

--
-- Constraints for table `kompleti`
--
ALTER TABLE `kompleti`
  ADD CONSTRAINT `kompleti_prikolica_fk` FOREIGN KEY (`fk_prikolica`) REFERENCES `prikolice` (`id`),
  ADD CONSTRAINT `kompleti_tegljac_fk` FOREIGN KEY (`fk_tegljac`) REFERENCES `tegljaci` (`id`);

--
-- Constraints for table `nalogodavci_banke`
--
ALTER TABLE `nalogodavci_banke`
  ADD CONSTRAINT `banke_FK` FOREIGN KEY (`fk_banke`) REFERENCES `banke` (`id`),
  ADD CONSTRAINT `nalogodavac_FK` FOREIGN KEY (`fk_nalogodavac`) REFERENCES `nalogodavci` (`id`);

--
-- Constraints for table `pregledi_prikolice`
--
ALTER TABLE `pregledi_prikolice`
  ADD CONSTRAINT `prikolica_FK` FOREIGN KEY (`fk_prikolica`) REFERENCES `prikolice` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
