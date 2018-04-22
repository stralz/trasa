-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 05:43 PM
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
  `naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

INSERT INTO `fakture` (`id`, `racun_broj`, `datum_izdavanja`, `valuta_placanja`, `datum_prometa`, `mesto_prometa`, `mesto_izdavanja_racuna`, `broj_naloga1`, `broj_naloga2`, `od1`, `od2`, `do1`, `do2`, `cmr1`, `cmr2`, `mesto_utovara1`, `mesto_utovara2`, `mesto_istovara1`, `mesto_istovara2`, `tezina1`, `tezina2`, `fk_tegljac`, `fk_prikolica`, `iznos1`, `iznos2`, `iznos`, `iznosEUR`, `kursEUR`, `sablon`, `fk_nalogodavac`, `lokacija`) VALUES
(153, '123', '22.04.2018', '21.05.2018', '05.04.2018', 'Mesto prometa', 'Mesto izdavanja', 0, 0, 'Beograd', '', 'Kragujevac', '', '123', '', 'Almex d.o.o.', '', 'Cartiera Di Bosco Marengo S.p.A.', '', '123', '', 34, 52, '1237.00', 'NaN', '123.00', '1.04', '118.1377', 'DinarskiSablon1Tura', 11, '');

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
(1, 11, 1, 54),
(2, 11, 27, 42),
(3, 11, 28, 40),
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
(17, 27, 28, 11, 12),
(18, 27, 1, 11, 1),
(19, 1, 28, 11, 11),
(20, 28, 28, 11, 1),
(21, 28, 27, 11, 3),
(22, 35, 1, 13, 1),
(23, 2, 36, 13, 1),
(24, 36, 2, 13, 1),
(25, 2, 35, 13, 1),
(26, 1, 1, 17, 1),
(27, 27, 27, 11, 1),
(28, 28, 1, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pregledi`
--

CREATE TABLE `pregledi` (
  `id` int(11) NOT NULL,
  `tip_pregleda` varchar(50) NOT NULL,
  `datum_izdavanja_isprave` date NOT NULL,
  `fk_tegljac` int(11) DEFAULT NULL,
  `fk_prikolica` int(11) DEFAULT NULL
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
-- Table structure for table `putarine`
--

CREATE TABLE `putarine` (
  `id` int(11) NOT NULL,
  `zemlja` varchar(50) NOT NULL,
  `iznos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recenice`
--

CREATE TABLE `recenice` (
  `id` int(11) NOT NULL,
  `sadrzaj` varchar(50) NOT NULL
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
(11, 23, 23),
(11, 24, 20),
(11, 22, 18),
(11, 20, 19),
(13, 23, 5),
(13, 24, 3),
(13, 22, 3),
(13, 20, 1),
(11, 21, 5),
(11, 25, 3),
(12, 20, 1),
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
  `uverenje` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vozaci`
--

INSERT INTO `vozaci` (`id`, `ime`, `prezime`, `br_pasosa`, `procenat`, `uverenje`) VALUES
(1, 'Vlada', 'Milutinovic', '011807899', 14, 'Da'),
(2, 'Zoran', 'Lukac', '007227223', 14, 'Da'),
(3, 'Dejan', 'Dakic', '012582397', 14, 'Da'),
(4, 'Predrag', 'Beric', '013300873', 14, 'Da'),
(5, 'Perica', 'Sladovic', '012363761', 14, 'Da'),
(6, 'Ivan', 'Ilic', '012704148', 13, 'Da'),
(7, 'Radenko', 'Uskokovic', '011092398', 12, 'Da'),
(8, 'Nikola', 'Stojanovic', '012829041', 13, 'Da'),
(9, 'Dejan', 'Mrckovic', '006793173', 11, 'Da'),
(10, 'Zeljko', 'Popovic', '012396926', 12, 'Da');

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
-- Indexes for table `cmrovi`
--
ALTER TABLE `cmrovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakture`
--
ALTER TABLE `fakture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakture_nalogodavac_FK` (`fk_nalogodavac`),
  ADD KEY `fakture_tegljac_FK` (`fk_tegljac`),
  ADD KEY `fakture_prikolica_FK` (`fk_prikolica`);

--
-- Indexes for table `gradovi`
--
ALTER TABLE `gradovi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ime` (`ime`);

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
-- Indexes for table `pregledi`
--
ALTER TABLE `pregledi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tegljac` (`fk_tegljac`),
  ADD KEY `fk_prikolica` (`fk_prikolica`);

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
-- Indexes for table `recenice`
--
ALTER TABLE `recenice`
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
-- Indexes for table `uvoznici_izvoznici`
--
ALTER TABLE `uvoznici_izvoznici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u_i_nalogodavac`
--
ALTER TABLE `u_i_nalogodavac`
  ADD KEY `nalogdavac_FK` (`fk_nalogodavac`),
  ADD KEY `u_i_FK` (`fk_u_i`);

--
-- Indexes for table `vozaci`
--
ALTER TABLE `vozaci`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakture`
--
ALTER TABLE `fakture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `gradovi`
--
ALTER TABLE `gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `nalogodavci_gradovi`
--
ALTER TABLE `nalogodavci_gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `nalogodavci_relacije`
--
ALTER TABLE `nalogodavci_relacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `relacije`
--
ALTER TABLE `relacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uvoznici_izvoznici`
--
ALTER TABLE `uvoznici_izvoznici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- Constraints for table `kompleti`
--
ALTER TABLE `kompleti`
  ADD CONSTRAINT `kompleti_ibfk_2` FOREIGN KEY (`fk_prikolica`) REFERENCES `prikolice` (`id`),
  ADD CONSTRAINT `kompleti_ibfk_4` FOREIGN KEY (`fk_tegljac`) REFERENCES `tegljaci` (`id`);

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
  ADD CONSTRAINT `nalogodavci_relacije_ibfk_2` FOREIGN KEY (`fk_nalogodavac`) REFERENCES `nalogodavci` (`id`),
  ADD CONSTRAINT `nalogodavci_relacije_od_FK` FOREIGN KEY (`fk_od`) REFERENCES `gradovi` (`id`);

--
-- Constraints for table `pregledi`
--
ALTER TABLE `pregledi`
  ADD CONSTRAINT `pregledi_ibfk_1` FOREIGN KEY (`fk_tegljac`) REFERENCES `tegljaci` (`id`),
  ADD CONSTRAINT `pregledi_ibfk_2` FOREIGN KEY (`fk_prikolica`) REFERENCES `prikolice` (`id`);

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
  ADD CONSTRAINT `nalogdavac_FK` FOREIGN KEY (`fk_nalogodavac`) REFERENCES `nalogodavci` (`id`),
  ADD CONSTRAINT `u_i_FK` FOREIGN KEY (`fk_u_i`) REFERENCES `uvoznici_izvoznici` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
