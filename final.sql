-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 06:38 PM
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
-- Database: `vpmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 7898799798, 'tester1@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-07-04 22:38:23'),
(4, 'fariz', 'fariz', 811, 'fariz', '098f6bcd4621d373cade4e832627b4f6', '2024-06-04 10:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `tblregusers`
--

CREATE TABLE `tblregusers` (
  `ID` int(5) NOT NULL,
  `FirstName` varchar(250) DEFAULT NULL,
  `LastName` varchar(250) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblregusers`
--

INSERT INTO `tblregusers` (`ID`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Password`, `RegDate`) VALUES
(2, 'Anuj', 'Kumar', 1234567890, 'ak@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2022-05-10 11:05:56'),
(3, 'Fariz', 'Falakh', 811, 'fariz', '098f6bcd4621d373cade4e832627b4f6', '2024-06-04 09:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `tblriwayat`
--

CREATE TABLE `tblriwayat` (
  `ID_Riwayat` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `nomorTiket` int(11) NOT NULL,
  `metodePembayaran` varchar(11) NOT NULL,
  `jumlahPembayaran` int(11) NOT NULL,
  `waktuPembayaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblriwayat`
--

INSERT INTO `tblriwayat` (`ID_Riwayat`, `UserID`, `nomorTiket`, `metodePembayaran`, `jumlahPembayaran`, `waktuPembayaran`, `status_bayar`) VALUES
(50, 3, 4, 'GoPay', 20000, '2024-06-04 15:50:11', 0),
(51, 3, 91, 'GoPay', 10000, '2024-06-04 15:52:43', 0),
(52, 3, 3, 'GoPay', 10000, '2024-06-04 15:55:10', 0),
(53, 3, 3, 'GoPay', 10000, '2024-06-04 15:56:07', 0),
(54, 3, 3, 'GoPay', 30000, '2024-06-04 15:59:25', 0),
(55, 3, 3, 'GoPay', 30000, '2024-06-04 15:59:57', 0),
(56, 3, 3, 'GoPay', 30000, '2024-06-04 16:00:32', 0),
(57, 3, 3, 'GoPay', 30000, '2024-06-04 16:01:29', 0),
(58, 3, 12, 'GoPay', 10000, '2024-06-04 16:03:21', 0),
(59, 3, 12, 'GoPay', 10000, '2024-06-04 16:04:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsaldo`
--

CREATE TABLE `tblsaldo` (
  `ID` int(11) NOT NULL,
  `GoPay` int(11) NOT NULL,
  `DANA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsaldo`
--

INSERT INTO `tblsaldo` (`ID`, `GoPay`, `DANA`) VALUES
(3, 20000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltickets`
--

CREATE TABLE `tbltickets` (
  `ID_tickets` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ticketNumber` varchar(11) NOT NULL,
  `waktuMasuk` timestamp NOT NULL DEFAULT current_timestamp(),
  `nomor_plat` varchar(15) NOT NULL,
  `jenis_kendaraan` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltickets`
--

INSERT INTO `tbltickets` (`ID_tickets`, `UserID`, `ticketNumber`, `waktuMasuk`, `nomor_plat`, `jenis_kendaraan`) VALUES
(1, 4, '122', '2024-06-04 11:09:26', '', ''),
(2, 5, '422', '2024-06-04 11:09:26', '', ''),
(3, 4, '122', '2024-06-04 11:09:32', '', ''),
(4, 5, '422', '2024-06-04 11:09:32', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbltiketdigital`
--

CREATE TABLE `tbltiketdigital` (
  `ID_TiketDigital` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ticketNumber` int(11) NOT NULL,
  `digitalTicket` varchar(8) NOT NULL,
  `expTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sudahBayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblregusers`
--
ALTER TABLE `tblregusers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MobileNumber` (`MobileNumber`);

--
-- Indexes for table `tblriwayat`
--
ALTER TABLE `tblriwayat`
  ADD PRIMARY KEY (`ID_Riwayat`);

--
-- Indexes for table `tblsaldo`
--
ALTER TABLE `tblsaldo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD PRIMARY KEY (`ID_tickets`);

--
-- Indexes for table `tbltiketdigital`
--
ALTER TABLE `tbltiketdigital`
  ADD PRIMARY KEY (`ID_TiketDigital`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblregusers`
--
ALTER TABLE `tblregusers`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblriwayat`
--
ALTER TABLE `tblriwayat`
  MODIFY `ID_Riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `ID_tickets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbltiketdigital`
--
ALTER TABLE `tbltiketdigital`
  MODIFY `ID_TiketDigital` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
