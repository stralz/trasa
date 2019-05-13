-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2019 at 06:22 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

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
  `naziv` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brojevi`
--

CREATE TABLE `brojevi` (
  `id` int(11) NOT NULL,
  `prvi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brojevi`
--

INSERT INTO `brojevi` (`id`, `prvi`) VALUES
(1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `fakture`
--

CREATE TABLE `fakture` (
  `id` int(11) NOT NULL,
  `racun_broj` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `komplet_racun_broj` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `datum_izdavanja` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `valuta_placanja` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `datum_prometa` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mesto_prometa` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `mesto_izdavanja_racuna` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `broj_naloga` int(25) NOT NULL,
  `od` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `do` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `cmr` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `mesto_utovara` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `mesto_istovara` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `tezina` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `vrsta_robe` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_tegljac` int(11) DEFAULT NULL,
  `fk_prikolica` int(11) DEFAULT NULL,
  `ang_tegljac` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ang_prikolica` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iznos` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `iznosEUR` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `kursEUR` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sablon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fk_nalogodavac` int(11) NOT NULL,
  `lokacija` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fakture`
--

INSERT INTO `fakture` (`id`, `racun_broj`, `komplet_racun_broj`, `datum_izdavanja`, `valuta_placanja`, `datum_prometa`, `mesto_prometa`, `mesto_izdavanja_racuna`, `broj_naloga`, `od`, `do`, `cmr`, `mesto_utovara`, `mesto_istovara`, `tezina`, `vrsta_robe`, `fk_tegljac`, `fk_prikolica`, `ang_tegljac`, `ang_prikolica`, `iznos`, `iznosEUR`, `kursEUR`, `sablon`, `fk_nalogodavac`, `lokacija`) VALUES
(40, '27/AK/19', '27/AK/19', '12.05.2019', '30.07.2019', '03.05.2019', 'San Paolo D` Argon', 'Vidikovac', 123, 'Beograd', 'Genova', '123', '', '', '123', '123', NULL, NULL, '123', '213', '100', '0.85', '117.97', 'DevizniSablon1Tura', 16, ''),
(41, '28/AK/19', '28/AK/19', '12.05.2019', '30.07.2019', '10.05.2019', 'San Paolo D` Argon', 'Vidikovac', 64537, 'Beograd', 'Genova', '6647', '', '', '19761', 'Kukuruz i bicikle', NULL, NULL, 'FSDF', 'SFS', '1400', '11.87', '117.97', 'DevizniSablon1Tura', 16, ''),
(42, '29/AK/19', '29/AK/19', '12.05.2019', '11.05.2019', '10.05.2019', 'Novi Beograd', 'Vidikovac', 0, '123', '321', '123', '', '', '52353', 'kukuruz i kajmak', NULL, NULL, 'TELGHJAC', 'MARA', '369', '3.00', '123.00', 'DinarskiSablon1Tura', 13, ''),
(43, '29/34-52/19', '29/34-52/19', '12.05.2019', '12.06.2019', '16.05.2019', 'Lozovik', 'Vidikovac', 0, '456', '654', '123', '', '', '123', '123', 34, 52, '', '', '123', '1.04', '117.97', 'DinarskiSablon1Tura', 11, ''),
(44, '30/34-52/19', '30/34-52/19', '12.05.2019', '12.06.2019', '11.05.2019', 'Lozovik', 'Vidikovac', 0, '789', '978', '123', '', '', '123', '123', 34, 52, '', '', '123', '1.04', '117.97', 'DinarskiSablon1Tura', 11, '');

-- --------------------------------------------------------

--
-- Table structure for table `fakture_gorivo`
--

CREATE TABLE `fakture_gorivo` (
  `fk_fakture` int(11) NOT NULL,
  `fk_gorivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakture_troskovi`
--

CREATE TABLE `fakture_troskovi` (
  `fk_fakture` int(11) NOT NULL,
  `fk_troskovi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gorivo`
--

CREATE TABLE `gorivo` (
  `id` int(11) NOT NULL,
  `datum` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `kilometraza` int(11) NOT NULL,
  `kolicina_litara` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `cena_po_litru` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `iznos` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fk_benzinska_stanica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gradovi`
--

CREATE TABLE `gradovi` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `drzava` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gradovi`
--

INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES
(1, 'Beograd', 'SRB'),
(2, 'Milano', 'I'),
(3, 'Napoli', 'I'),
(4, 'Gornji Milanovac', 'SRB'),
(5, 'Genova', 'I'),
(6, '123', 'SRB'),
(7, '321', 'ITA'),
(8, '456', 'I'),
(9, '654', 'SRB'),
(10, '789', 'SRB'),
(11, '978', 'I');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kompleti`
--

CREATE TABLE `kompleti` (
  `id` int(11) NOT NULL,
  `fk_tegljac` int(11) NOT NULL,
  `fk_prikolica` int(11) NOT NULL,
  `broj` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mesto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `postanski_broj` int(11) NOT NULL,
  `pib` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pak` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rok_placanja` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nalogodavci`
--

INSERT INTO `nalogodavci` (`id`, `ime`, `mesto`, `adresa`, `postanski_broj`, `pib`, `pak`, `rok_placanja`) VALUES
(11, 'Todorovic company d.o.o.', 'Lozovik', 'JNA 110', 11317, '101177833', '', '30'),
(12, 'Kontinental Logistika d.o.o.', 'Subotica', 'Maksima Gorkog 31', 24000, '108475152', '', '60'),
(13, 'Milsped d.o.o.', 'Novi Beograd', 'Bulevar Zorana Djindjica 121', 11000, '100423446', '', '60'),
(14, 'Maverick Logistic Solutions d.o.o.', 'Beograd', 'Urosa Martinovica 19/3', 11070, '109647276', '', '60'),
(15, 'Kolibri Oil d.o.o.', 'Beograd', 'Mokroluska 32', 11000, '100372851', '', '30'),
(16, 'Autotrasporti Cambianica s.r.l', 'San Paolo D` Argon', 'Via Bergamo 12', 24060, 'IT 00 231 300 161', '', '60'),
(17, 'Ubv Torino s.r.l.', 'San Mauro Torinese', 'Corso Piemonte 19/21', 10099, 'IT 10 593 090 011', '', '60');

-- --------------------------------------------------------

--
-- Table structure for table `pregledi_prikolice`
--

CREATE TABLE `pregledi_prikolice` (
  `id` int(11) NOT NULL,
  `fk_prikolica` int(11) NOT NULL,
  `registracija` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sertifikat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sesto_mesecni` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pregledi_tegljaci`
--

CREATE TABLE `pregledi_tegljaci` (
  `id` int(11) NOT NULL,
  `fk_tegljac` int(11) NOT NULL,
  `fk_vozac` int(11) NOT NULL,
  `registracija` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sertifikat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sesto_mesecni` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tahograf` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prikolice`
--

CREATE TABLE `prikolice` (
  `id` int(11) NOT NULL,
  `broj_registracije` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marka` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `broj_registracije` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marka` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tip_tahografa` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `naziv` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `datum` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `iznos` float NOT NULL,
  `valuta` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vozaci`
--

CREATE TABLE `vozaci` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `br_pasosa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `procenat` int(11) DEFAULT NULL,
  `uverenje` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `lekarsko` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brojevi`
--
ALTER TABLE `brojevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fakture`
--
ALTER TABLE `fakture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `gorivo`
--
ALTER TABLE `gorivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradovi`
--
ALTER TABLE `gradovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `pregledi_prikolice`
--
ALTER TABLE `pregledi_prikolice`
  ADD CONSTRAINT `prikolica_FK` FOREIGN KEY (`fk_prikolica`) REFERENCES `prikolice` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
