-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 03:07 PM
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

--
-- Dumping data for table `brojevi`
--

INSERT INTO `brojevi` (`id`, `prvi`, `drugi`) VALUES
(1, 22, 22);

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
(16, 'Autotrasporti Cambianica s.r.l.', 'San Paolo D’ Argon', 'Via Bergamo 12', 24060, 'IT 00 231 300 161', '', '0'),
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
-- Table structure for table `relacije`
--

CREATE TABLE `relacije` (
  `id` int(11) NOT NULL,
  `fk_od` int(11) NOT NULL,
  `fk_do` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `gorivo`
--
ALTER TABLE `gorivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gradovi`
--
ALTER TABLE `gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kip`
--
ALTER TABLE `kip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
  ADD CONSTRAINT `benzninska_stanica_FK` FOREIGN KEY (`fk_benzinska_stanica`) REFERENCES `benzinske_stanice` (`id`);

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
