-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 04:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_service_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `vehicleNumber` varchar(20) NOT NULL,
  `vehicleType` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `serviceStation` varchar(50) NOT NULL,
  `servicesString` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `vehicleNumber`, `vehicleType`, `date`, `time`, `serviceStation`, `servicesString`) VALUES
(1, 'CBE-3143', 'car', '2025-02-09', '22:54:00', 'Panadura', 'interiorCleaning, radiatorCoolantChange'),
(2, 'CBE-3143', 'car', '2025-02-09', '22:54:00', 'Panadura', 'oilFilterChange, interiorCleaning, radiatorCoolantChange'),
(3, 'CBE-3143', 'suv', '2025-02-21', '22:58:00', 'Gampola', 'fullService'),
(4, 'CBE-3143', 'suv', '2025-02-22', '23:08:00', 'Gampola', 'totalTreatment, radiatorCoolantChange'),
(5, 'CBE-3143', 'car', '2025-02-21', '12:41:00', 'Gampola', 'exteriorCutPolish, radiatorCoolantChange, brakeOilChange'),
(6, 'CBE-3143', 'car', '2025-02-14', '12:54:00', 'Gampola', 'exteriorCutPolish, totalTreatment');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `messageId` int(5) NOT NULL,
  `message` varchar(100) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`messageId`, `message`, `firstName`, `lastName`, `email`, `phone`) VALUES
(1, 'dhwijdqwofqow', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '0704313535'),
(2, 'dhwijdqwofqow', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '0704313535'),
(3, 'dgwe', 'binithi', 'elvitigala', 'wjpq8454@outlook.com', '0704313535'),
(4, 'sckmka', 'binithi', 'elvitigala', 'wjpq8454@outlook.com', '0704313535'),
(5, 'svmafa', 'binithi', 'elvitigala', 'wjpq8454@outlook.com', '0704313535'),
(6, 'mnk', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '070431353'),
(7, 'mnk', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '0704313'),
(8, 'kjol', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '070431353'),
(9, 'hnik', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '07043135'),
(10, 'cnaK', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '0704313535'),
(11, 'fwefcdfqe', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '0704313535'),
(12, 'hiiiiiiiiii', 'binithi', 'elvitigala', 'wjpq8454@outlook.com', '0704313535'),
(13, 'bj', 'binithi', 'elvitigala', 'binithi.vihanga@gmail.com', '0704313535');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(5) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `userId` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `phone`, `userId`) VALUES
(1, 'Binithi', 'Elvitigala', 'binithi.vihanga@gmail.com', '0704313535', 1),
(4, 'binithi', 'elvitigala', 'dantha@gmail.com', '0704313535', 4),
(19, 'fcwq', 'vqe', 'binie2@efjiw.com', '0704313535', 19);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`) VALUES
(1, 'binithi.vihanga@gmail.com', 'biniEl2*'),
(4, 'dantha@gmail.com', 'danE@123'),
(19, 'binie2@efjiw.com', 'BINeI856@/+');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `fk_userId` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `messageId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
