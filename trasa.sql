-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2018 at 07:45 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
  `naziv` varchar(50) NOT NULL,
  `broj racuna` varchar(50) DEFAULT NULL,
  `tip racuna` varchar(50) DEFAULT NULL,
  `adresa` varchar(50) DEFAULT NULL,
  `mesto` varchar(50) NOT NULL,
  `drzava` varchar(50) NOT NULL,
  `swift` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `benzinske_stanice`
--

CREATE TABLE `benzinske_stanice` (
  `id` int(11) NOT NULL,
  `naziv` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `benzinske_stanice`
--

INSERT INTO `benzinske_stanice` (`id`, `naziv`) VALUES
(1, 'Dobre Vode'),
(2, 'MOL - Zrenjanin'),
(3, 'MOL - SLO');

-- --------------------------------------------------------

--
-- Table structure for table `brojevi`
--

CREATE TABLE `brojevi` (
  `id` int(11) NOT NULL,
  `prvi` int(11) NOT NULL,
  `drugi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brojevi`
--

INSERT INTO `brojevi` (`id`, `prvi`, `drugi`) VALUES
(1, 21, 21);

-- --------------------------------------------------------

--
-- Table structure for table `cmrovi`
--

CREATE TABLE `cmrovi` (
  `id` int(11) NOT NULL,
  `tip` varchar(50) NOT NULL,
  `vrednost` varchar(50) DEFAULT NULL
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
  `lokacija` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakture`
--

INSERT INTO `fakture` (`id`, `racun_broj`, `komplet_racun_broj`, `datum_izdavanja`, `valuta_placanja`, `datum_prometa`, `mesto_prometa`, `mesto_izdavanja_racuna`, `broj_naloga1`, `broj_naloga2`, `od1`, `od2`, `do1`, `do2`, `cmr1`, `cmr2`, `mesto_utovara1`, `mesto_utovara2`, `mesto_istovara1`, `mesto_istovara2`, `tezina1`, `tezina2`, `fk_tegljac`, `fk_prikolica`, `iznos1`, `iznos2`, `iznos`, `iznosEUR`, `kursEUR`, `sablon`, `fk_nalogodavac`, `lokacija`) VALUES
(191, '1', '19-1/19', '24.06.2018', '23.07.2018', '23.06.2018', 'Mesto prometa', 'Mesto izdavanja', 0, 0, '213', '', 'Grad', '', '12341', '', 'Almex d.o.o.', '', 'Bcube S.p.A.', '', '1234', '', 34, 52, '12345.53', 'NaN', '12345.53', '104.53', '118.1074', 'DinarskiSablon1Tura', 11, ''),
(192, '1', '20-1/20', '24.06.2018', '23.07.2018', '23.06.2018', 'Lozovik', 'Vidikovac', 0, 0, 'Cittie tittie', '', 'Dobanovci', '', '123', '', 'Hbis Group Serbia Iron & Steel d.o.o.', '', 'Fas d.o.o.', '', '1234', '', 34, 52, '12345.53', 'NaN', '12345.53', '104.53', '118.1074', 'DinarskiSablon1Tura', 11, '');

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

--
-- Dumping data for table `gorivo`
--

INSERT INTO `gorivo` (`id`, `datum`, `kilometraza`, `kolicina_litara`, `cena_po_litru`, `iznos`, `fk_benzinska_stanica`) VALUES
(8, '07.06.2018', 1343, '434.00', '123.00', '53382.00 RSD', 1),
(9, '15.06.2018', 1324, '123.00', '123.00', '15129.00 RSD', 1),
(12, '08.06.2018', 41234, '411.00', '123.00', '50553.00 RSD', 1),
(13, '08.06.2018', 43214, '4231.00', '1.00', '4231.00 RSD', 2),
(15, '08.06.2018', 42314, '1233.00', '123.00', '151659.00 ', 3),
(16, '14.06.2018', 4234, '43.00', '12.00', '516.00 RSD', 3),
(18, '15.06.2018', 43242, '432.00', '23.00', '9936.00 RSD', 1),
(19, '22.06.2018', 3413, '3232.00', '43.00', '138976.00 RSD', 2),
(20, '14.06.2018', 1234, '1234.00', '43.00', '53062.00 RSD', 1),
(21, '16.06.2018', 12345, '1234.00', '12.00', '14808.00 ', 1),
(24, '21.06.2018', 154235, '434.00', '1.00', '434.00 RSD', 1),
(26, '29.06.2018', 1234, '134.00', '213.00', '28542.00 RSD', 1);

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
(3, 'Napoli', 'ITA'),
(4, 'Rim', 'ITA'),
(5, 'Dobanovci', 'SRB'),
(6, 'Kraljevo', 'SRB'),
(27, 'Kragujevac', 'SRB'),
(28, 'Polomilica', 'ITA'),
(29, 'Grad', 'SRB'),
(30, 'Cittie tittie', 'ITA'),
(35, 'DDD', 'SRB'),
(36, 'SSS', 'ITA'),
(37, 'KRANJEVAC:DD', 'SRB'),
(38, '213', 'SRB'),
(39, '123', 'SRB');

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

--
-- Dumping data for table `kip`
--

INSERT INTO `kip` (`id`, `fk_fakture`, `pocetna_kilometraza`, `zavrsna_kilometraza`, `potrosnja`) VALUES
(4, 0, 1234, 1235, 213432);

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
(16, 'Autotrasporti Cambianica s.r.l.', 'San Paolo D’ Argon', 'Via Bergamo 12', 24060, 'IT 00 231 300 161', '', '30'),
(17, 'Ubv Torino s.r.l.', 'San Mauro Torinese', 'Corso Piemonte 19/21', 10099, 'IT 10 593 090 011', '', '60');

-- --------------------------------------------------------

--
-- Table structure for table `nalogodavci_gradovi`
--

CREATE TABLE `nalogodavci_gradovi` (
  `id` int(11) NOT NULL,
  `fk_nalogodavac` int(11) NOT NULL,
  `fk_grad` int(11) NOT NULL,
  `broj` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nalogodavci_gradovi`
--

INSERT INTO `nalogodavci_gradovi` (`id`, `fk_nalogodavac`, `fk_grad`, `broj`) VALUES
(1, 11, 1, 56),
(2, 11, 27, 43),
(3, 11, 28, 43),
(4, 16, 2, 25),
(5, 16, 3, 12),
(6, 12, 29, 6),
(9, 15, 29, 1),
(10, 15, 30, 1),
(21, 17, 1, 5),
(22, 17, 2, 3),
(24, 13, 35, 11),
(25, 13, 36, 11),
(28, 13, 1, 12),
(29, 13, 2, 14),
(32, 12, 37, 5);

-- --------------------------------------------------------

--
-- Table structure for table `nalogodavci_relacije`
--

CREATE TABLE `nalogodavci_relacije` (
  `id` int(11) NOT NULL,
  `fk_od` int(11) NOT NULL,
  `fk_do` int(11) NOT NULL,
  `fk_nalogodavac` int(11) NOT NULL,
  `broj` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nalogodavci_relacije`
--

INSERT INTO `nalogodavci_relacije` (`id`, `fk_od`, `fk_do`, `fk_nalogodavac`, `broj`) VALUES
(6, 27, 28, 12, 1),
(8, 29, 30, 15, 1),
(10, 1, 2, 17, 3),
(11, 2, 1, 17, 2),
(12, 35, 36, 13, 5),
(13, 1, 2, 13, 11),
(14, 29, 37, 12, 5),
(15, 1, 27, 11, 12),
(16, 1, 1, 11, 1),
(17, 27, 28, 11, 13),
(18, 27, 1, 11, 1),
(19, 1, 28, 11, 13),
(20, 28, 28, 11, 1),
(21, 28, 27, 11, 4),
(22, 35, 1, 13, 1),
(23, 2, 36, 13, 1),
(24, 36, 2, 13, 1),
(25, 2, 35, 13, 1),
(26, 1, 1, 17, 1),
(27, 27, 27, 11, 1),
(28, 28, 1, 11, 2),
(29, 39, 30, 16, 2),
(30, 39, 38, 11, 1),
(31, 39, 38, 17, 1),
(32, 39, 35, 11, 1),
(33, 38, 37, 11, 1),
(34, 37, 28, 11, 1),
(35, 30, 27, 11, 2),
(36, 1, 37, 11, 1),
(37, 5, 2, 13, 1),
(38, 5, 29, 12, 1),
(39, 27, 27, 14, 1),
(40, 1, 5, 11, 4),
(41, 27, 37, 11, 1),
(42, 30, 35, 12, 1),
(43, 35, 29, 11, 1),
(44, 35, 37, 12, 1),
(45, 30, 6, 11, 1),
(46, 5, 27, 13, 1),
(47, 35, 5, 11, 3),
(48, 30, 29, 11, 4),
(49, 30, 29, 12, 1),
(50, 2, 3, 12, 1),
(51, 30, 27, 17, 1),
(52, 27, 29, 11, 1),
(53, 6, 3, 11, 1),
(54, 35, 29, 14, 1),
(55, 5, 29, 11, 1),
(56, 1, 6, 17, 1),
(57, 1, 27, 17, 1),
(58, 3, 6, 17, 1),
(59, 38, 29, 11, 1),
(60, 30, 5, 11, 1);

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

--
-- Dumping data for table `pregledi_prikolice`
--

INSERT INTO `pregledi_prikolice` (`id`, `fk_prikolica`, `registracija`, `sertifikat`, `sesto_mesecni`) VALUES
(1, 41, '12.06.2018', '23.03.2018', '16.09.2017');

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

--
-- Dumping data for table `pregledi_tegljaci`
--

INSERT INTO `pregledi_tegljaci` (`id`, `fk_tegljac`, `fk_vozac`, `registracija`, `sertifikat`, `sesto_mesecni`, `tahograf`) VALUES
(1, 30, 9, '16.03.2018', '23.03.2018', '16.09.2017', '20.09.2018');

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
-- Table structure for table `putarine`
--

CREATE TABLE `putarine` (
  `id` int(11) NOT NULL,
  `zemlja` varchar(50) NOT NULL,
  `iznos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `relacije`
--

CREATE TABLE `relacije` (
  `id` int(11) NOT NULL,
  `fk_od` int(11) NOT NULL,
  `fk_do` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relacije`
--

INSERT INTO `relacije` (`id`, `fk_od`, `fk_do`) VALUES
(1, 1, 2),
(2, 5, 4),
(3, 6, 3);

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

--
-- Dumping data for table `troskovi`
--

INSERT INTO `troskovi` (`id`, `naziv`, `datum`, `iznos`, `valuta`) VALUES
(16, 'ninja', '04.05.2018', 123, 'EUR'),
(18, 'ninja', '03.05.2018', 123, 'EUR'),
(20, 'terminalka', '03.05.2018', 1000, 'RSD'),
(31, 'terminalka', '11.05.2018', 123, 'EUR'),
(32, 'terminalka', '10.05.2018', 123, 'EUR'),
(33, 'terminalka', '11.05.2018', 123, 'EUR'),
(35, 'ninja', '03.05.2018', 123.123, 'EUR'),
(36, 'ninja', '11.05.2018', 123, 'EUR'),
(40, 'terminalka', '18.05.2018', 123.9, 'EUR'),
(41, 'terminalka', '11.05.2018', 123, 'KN'),
(42, 'terminalka', '11.05.2018', 123, 'EUR'),
(44, 'terminalka', '17.05.2018', 2345, 'EUR'),
(45, 'ninja', '04.05.2018', 123412, 'KN'),
(46, 'terminalka', '10.05.2018', 1234, 'EUR'),
(47, 'terminalka', '11.05.2018', 123412, 'KN'),
(48, 'terminalka', '09.05.2018', 43433, 'EUR'),
(49, 'ninja', '09.06.2018', 1234, 'RSD'),
(50, 'terminalka', '22.06.2018', 500, 'EUR'),
(51, 'terminalka', '14.06.2018', 1000, 'EUR'),
(52, 'ninja', '22.06.2018', 123, 'KN'),
(53, 'ninja', '08.06.2018', 1234, 'EUR'),
(54, 'terminalka', '08.06.2018', 1234, 'RSD');

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
(11, 23, 37),
(11, 24, 45),
(11, 22, 22),
(11, 20, 26),
(13, 23, 7),
(13, 24, 4),
(13, 22, 3),
(13, 20, 1),
(11, 21, 10),
(11, 25, 8),
(12, 20, 1),
(12, 22, 3),
(13, 21, 1),
(12, 25, 1),
(12, 24, 5),
(14, 24, 1),
(14, 25, 2),
(12, 23, 2),
(14, 22, 1);

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
-- Indexes for table `cmrovi`
--
ALTER TABLE `cmrovi`
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
  ADD KEY `FK_benzinska_stanica` (`fk_benzinska_stanica`);

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
-- Indexes for table `nalogodavci_gradovi`
--
ALTER TABLE `nalogodavci_gradovi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nalogodavac` (`fk_nalogodavac`),
  ADD KEY `fk_grad` (`fk_grad`);

--
-- Indexes for table `nalogodavci_relacije`
--
ALTER TABLE `nalogodavci_relacije`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nalogodavac` (`fk_nalogodavac`),
  ADD KEY `nalogodavci_relacije_od_FK` (`fk_od`),
  ADD KEY `nalogodavci_relacije_do_FK` (`fk_do`);

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
-- Indexes for table `putarine`
--
ALTER TABLE `putarine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relacije`
--
ALTER TABLE `relacije`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gradovi1_FK` (`fk_od`),
  ADD KEY `gradovi2_FK` (`fk_do`);

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
-- AUTO_INCREMENT for table `benzinske_stanice`
--
ALTER TABLE `benzinske_stanice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brojevi`
--
ALTER TABLE `brojevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fakture`
--
ALTER TABLE `fakture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `gorivo`
--
ALTER TABLE `gorivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `gradovi`
--
ALTER TABLE `gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kip`
--
ALTER TABLE `kip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nalogodavci`
--
ALTER TABLE `nalogodavci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nalogodavci_gradovi`
--
ALTER TABLE `nalogodavci_gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `nalogodavci_relacije`
--
ALTER TABLE `nalogodavci_relacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pregledi_prikolice`
--
ALTER TABLE `pregledi_prikolice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pregledi_tegljaci`
--
ALTER TABLE `pregledi_tegljaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prikolice`
--
ALTER TABLE `prikolice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `relacije`
--
ALTER TABLE `relacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tegljaci`
--
ALTER TABLE `tegljaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `troskovi`
--
ALTER TABLE `troskovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  ADD CONSTRAINT `FK_benzinska_stanica` FOREIGN KEY (`fk_benzinska_stanica`) REFERENCES `benzinske_stanice` (`id`);

--
-- Constraints for table `kompleti`
--
ALTER TABLE `kompleti`
  ADD CONSTRAINT `kompleti_prikolica_fk` FOREIGN KEY (`fk_prikolica`) REFERENCES `prikolice` (`id`),
  ADD CONSTRAINT `kompleti_tegljac_fk` FOREIGN KEY (`fk_tegljac`) REFERENCES `tegljaci` (`id`);

--
-- Constraints for table `nalogodavci_gradovi`
--
ALTER TABLE `nalogodavci_gradovi`
  ADD CONSTRAINT `nalogodavci_gradovi_grad_FK` FOREIGN KEY (`fk_grad`) REFERENCES `gradovi` (`id`),
  ADD CONSTRAINT `nalogodavci_gradovi_nalogodavac_FK` FOREIGN KEY (`fk_nalogodavac`) REFERENCES `nalogodavci` (`id`);

--
-- Constraints for table `nalogodavci_relacije`
--
ALTER TABLE `nalogodavci_relacije`
  ADD CONSTRAINT `nalogodavci_relacije_do_FK` FOREIGN KEY (`fk_do`) REFERENCES `gradovi` (`id`),
  ADD CONSTRAINT `nalogodavci_relacije_nalogodavac_FK` FOREIGN KEY (`fk_nalogodavac`) REFERENCES `nalogodavci` (`id`),
  ADD CONSTRAINT `nalogodavci_relacije_od_FK` FOREIGN KEY (`fk_od`) REFERENCES `gradovi` (`id`);

--
-- Constraints for table `pregledi_prikolice`
--
ALTER TABLE `pregledi_prikolice`
  ADD CONSTRAINT `prikolica_FK` FOREIGN KEY (`fk_prikolica`) REFERENCES `prikolice` (`id`);

--
-- Constraints for table `pregledi_tegljaci`
--
ALTER TABLE `pregledi_tegljaci`
  ADD CONSTRAINT `pregled_tegljac_FK` FOREIGN KEY (`fk_tegljac`) REFERENCES `tegljaci` (`id`),
  ADD CONSTRAINT `pregled_vozac_FK` FOREIGN KEY (`fk_vozac`) REFERENCES `vozaci` (`id`);

--
-- Constraints for table `relacije`
--
ALTER TABLE `relacije`
  ADD CONSTRAINT `gradovi1_FK` FOREIGN KEY (`fk_od`) REFERENCES `gradovi` (`id`),
  ADD CONSTRAINT `gradovi2_FK` FOREIGN KEY (`fk_do`) REFERENCES `gradovi` (`id`);

--
-- Constraints for table `sleperi_vozaci`
--
ALTER TABLE `sleperi_vozaci`
  ADD CONSTRAINT `sleperi_vozaci_ibfk_1` FOREIGN KEY (`fk_komplet`) REFERENCES `kompleti` (`id`),
  ADD CONSTRAINT `sleperi_vozaci_ibfk_2` FOREIGN KEY (`fk_vozac`) REFERENCES `vozaci` (`id`);

--
-- Constraints for table `u_i_nalogodavac`
--
ALTER TABLE `u_i_nalogodavac`
  ADD CONSTRAINT `nalogodavac_FK` FOREIGN KEY (`fk_nalogodavac`) REFERENCES `nalogodavci` (`id`),
  ADD CONSTRAINT `u_i_FK` FOREIGN KEY (`fk_u_i`) REFERENCES `uvoznici_izvoznici` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
