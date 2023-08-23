-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2020 at 12:38 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_gestus`
--

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`id`, `nom`, `prenom`, `username`, `password`, `statut`) VALUES
(1, 'ggg', 'fffg', 'admin', 'admin', 'admin'),
(2, 'KOKO', 'MALO', 'consultant', '1234', 'consultant'),
(3, 'Husseine', 'Ouedraogo', 'Sena', '1234', 'Supper Admin');

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `numIfu` varchar(254) NOT NULL,
  `NomEntreprise` varchar(254) DEFAULT NULL,
  `DirectionE` varchar(254) DEFAULT NULL,
  `RegimeFiscal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`numIfu`, `NomEntreprise`, `DirectionE`, `RegimeFiscal`) VALUES
('B789', 'SONABEL', 'DRH', 'RSI'),
('N99779', 'ONEA OUAGA', 'Technique', 'RAS'),
('V778990H', 'Personel', 'Informatique', 'XXX');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `MllePersonnel` varchar(254) NOT NULL,
  `IdService` int(11) NOT NULL,
  `NomPersonnel` varchar(254) DEFAULT NULL,
  `PrenomPersonnel` varchar(254) DEFAULT NULL,
  `Emploie` varchar(254) DEFAULT NULL,
  `Categorie` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`MllePersonnel`, `IdService`, `NomPersonnel`, `PrenomPersonnel`, `Emploie`, `Categorie`) VALUES
('GGI5678', 1, 'Ouedraogo', 'Ousseni', 'Technicien', 'Senior'),
('JO345678', 1, 'Ouompeba', 'Salam', 'Comptable', 'Senior');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `IdService` int(11) NOT NULL,
  `NomService` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`IdService`, `NomService`) VALUES
(1, 'Service d\'hygÃ¨ne'),
(675, 'Impot');

-- --------------------------------------------------------

--
-- Table structure for table `visite`
--

CREATE TABLE `visite` (
  `idVisites` int(11) NOT NULL,
  `Idservice` int(11) NOT NULL,
  `MllePersonnel` varchar(254) DEFAULT NULL,
  `numCnib` varchar(254) DEFAULT NULL,
  `DateVisite` date DEFAULT NULL,
  `DebutVisites` time DEFAULT NULL,
  `FinVisites` time DEFAULT '00:00:00',
  `TypeVisites` varchar(254) DEFAULT NULL,
  `ObsVisites` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visite`
--

INSERT INTO `visite` (`idVisites`, `Idservice`, `MllePersonnel`, `numCnib`, `DateVisite`, `DebutVisites`, `FinVisites`, `TypeVisites`, `ObsVisites`) VALUES
(19, 1, 'GGI5678', '99K56678', '2020-04-28', '12:25:00', '15:08:17', 'Confidentielle de merde', 'RAS RAS'),
(20, 1, 'GGI5678', '99K56678', '2020-04-30', '10:16:00', '10:25:54', 'Confidentielle', 'RSI'),
(21, 675, 'GGI5678', '99K56678', '2020-04-30', '15:54:00', '17:52:19', 'RAS', 'XXXXXX'),
(22, 1, 'GGI5678', '99K56678', '2020-06-01', '18:05:00', '19:44:28', 'XXXXX', 'RAS RAS'),
(23, 1, 'GGI5678', '99K56678', '2020-06-01', '19:39:00', '19:45:20', 'Courtoisie', 'RAS'),
(24, 675, 'JO345678', 'B7789908', '2020-06-03', '14:40:00', '00:00:00', 'CCC', 'CCC'),
(25, 675, 'GGI5678', 'B7789908', '2020-08-07', '15:51:00', '00:00:00', 'Courtoisie', 'RAS'),
(26, 1, 'GGI5678', '99K56678', '2020-10-20', '01:30:00', '00:00:00', 'jkkjjkjk', 'njhhjhjhj'),
(27, 1, 'GGI5678', '99K56678', '2020-10-20', '01:30:00', '00:00:00', 'jkkjjkjk', 'njhhjhjhj');

-- --------------------------------------------------------

--
-- Table structure for table `visiteurs`
--

CREATE TABLE `visiteurs` (
  `numCnib` varchar(254) NOT NULL,
  `numIfu` varchar(254) DEFAULT NULL,
  `NomVisiteurs` varchar(254) DEFAULT NULL,
  `PrenomVisiteurs` varchar(254) DEFAULT NULL,
  `TelVisiteurs` int(11) DEFAULT NULL,
  `PhotoVisiteur` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visiteurs`
--

INSERT INTO `visiteurs` (`numCnib`, `numIfu`, `NomVisiteurs`, `PrenomVisiteurs`, `TelVisiteurs`, `PhotoVisiteur`) VALUES
('99K56678', 'B789', 'Fall', 'Halidou', 45678908, '../../font/photos/99K56678photo.jpg'),
('B7789908', 'N99779', 'Sanfo', 'Abdallah', 45689023, '../../font/photos/B7789908photo.jpg'),
('B88901', 'N99779', 'Ouedraogo', 'Husseine', 61346554, '../../font/photos/B88901photo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`numIfu`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`MllePersonnel`),
  ADD KEY `FK_Association_3` (`IdService`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`IdService`);

--
-- Indexes for table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`idVisites`),
  ADD KEY `FK_Association_2` (`numCnib`),
  ADD KEY `FK_Association_4` (`MllePersonnel`);

--
-- Indexes for table `visiteurs`
--
ALTER TABLE `visiteurs`
  ADD PRIMARY KEY (`numCnib`),
  ADD KEY `FK_Association_1` (`numIfu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visite`
--
ALTER TABLE `visite`
  MODIFY `idVisites` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `FK_Association_3` FOREIGN KEY (`IdService`) REFERENCES `service` (`IdService`);

--
-- Constraints for table `visite`
--
ALTER TABLE `visite`
  ADD CONSTRAINT `FK_Association_2` FOREIGN KEY (`numCnib`) REFERENCES `visiteurs` (`numCnib`),
  ADD CONSTRAINT `FK_Association_4` FOREIGN KEY (`MllePersonnel`) REFERENCES `personnel` (`MllePersonnel`);

--
-- Constraints for table `visiteurs`
--
ALTER TABLE `visiteurs`
  ADD CONSTRAINT `FK_Association_1` FOREIGN KEY (`numIfu`) REFERENCES `entreprises` (`numIfu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
