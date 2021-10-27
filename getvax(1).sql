-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2021 at 03:21 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getvax`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `healthcarecenters` varchar(100) NOT NULL,
  `username` varchar(55) NOT NULL,
  `pass` varchar(55) NOT NULL,
  `fullname` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `staffid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `healthcarecenters`, `username`, `pass`, `fullname`, `email`, `staffid`) VALUES
(1, 'HBMFamilyClinic', 'ahmed', '12345', 'ahmed omar', 'ahmed@gmail.com', 11111);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batchNo` int(11) NOT NULL,
  `expiryDate` date NOT NULL,
  `numberOfPendingAppointment` int(100) DEFAULT NULL,
  `quantityAvailable` int(100) NOT NULL,
  `quantityAdministered` int(100) DEFAULT NULL,
  `vaccineID` int(11) NOT NULL,
  `centreName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batchNo`, `expiryDate`, `numberOfPendingAppointment`, `quantityAvailable`, `quantityAdministered`, `vaccineID`, `centreName`) VALUES
(1, '2021-10-30', 2, 100, NULL, 2, 'BMC Hospital'),
(2, '2021-11-03', NULL, 22, NULL, 2, 'BMC Hospital'),
(3, '2021-11-10', NULL, 21, NULL, 1, 'BMC Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_centre`
--

CREATE TABLE `healthcare_centre` (
  `centreName` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `healthcare_centre`
--

INSERT INTO `healthcare_centre` (`centreName`, `address`) VALUES
('BMC Hospital', 'Jalan 1 Cheras'),
('CherryHos', 'Taman 2 Gobbo');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `pass` varchar(55) NOT NULL,
  `ic` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `username`, `pass`, `ic`) VALUES
(1, 'ahmeddeeb', '12345', 12345678),
(2, 'ali', '123', 123);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `vaccinationID` int(11) NOT NULL,
  `appointmentDate` date NOT NULL,
  `status` char(20) NOT NULL,
  `remark` char(200) NOT NULL,
  `userID` int(11) NOT NULL,
  `batchNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`vaccinationID`, `appointmentDate`, `status`, `remark`, `userID`, `batchNo`) VALUES
(1, '2021-10-30', 'PENDING', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `vaccineID` int(11) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `vaccineName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`vaccineID`, `manufacturer`, `vaccineName`) VALUES
(1, 'BMC-H', 'Phizer'),
(2, 'TestVac', 'Kinc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batchNo`),
  ADD KEY `centreName` (`centreName`),
  ADD KEY `vaccineID` (`vaccineID`);

--
-- Indexes for table `healthcare_centre`
--
ALTER TABLE `healthcare_centre`
  ADD PRIMARY KEY (`centreName`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`vaccinationID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `batchNo` (`batchNo`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`vaccineID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `vaccinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `vaccineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`centreName`) REFERENCES `healthcare_centre` (`centreName`),
  ADD CONSTRAINT `batch_ibfk_2` FOREIGN KEY (`vaccineID`) REFERENCES `vaccine` (`vaccineID`);

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `vaccination_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `vaccination_ibfk_2` FOREIGN KEY (`batchNo`) REFERENCES `batch` (`batchNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
