-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 05:05 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dasystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `doctorname` varchar(200) NOT NULL,
  `doctorspeciality` varchar(200) NOT NULL,
  `doctorschedulestarts` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentid`, `userid`, `username`, `doctorid`, `doctorname`, `doctorspeciality`, `doctorschedulestarts`) VALUES
(14, 4, 'asifsyed487', 27, 'Dr. Hannan', 'Psychiatrist', '8.00'),
(15, 2, 'aavian086', 22, 'Dr. Chondromukhi', 'Allergy and Immunology', '7.30');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorid` int(11) NOT NULL,
  `doctorname` varchar(200) NOT NULL,
  `doctorspeciality` varchar(200) NOT NULL,
  `doctorjoindate` date NOT NULL,
  `doctorschedulestarts` varchar(50) NOT NULL,
  `doctorscheduleends` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorid`, `doctorname`, `doctorspeciality`, `doctorjoindate`, `doctorschedulestarts`, `doctorscheduleends`) VALUES
(21, 'Dr. Nasim', 'Allergy and Immunology', '2021-05-05', '7.30', '9.00'),
(22, 'Dr. Chondromukhi', 'Allergy and Immunology', '2021-05-08', '7.30', '9.30'),
(26, 'Dr. Bindu', 'Surgeon', '2021-05-02', '7.00', '10.00'),
(27, 'Dr. Hannan', 'Psychiatrist', '2021-05-16', '8.00', '9.30'),
(28, 'Dr. Hamim', 'Surgeon', '2021-05-01', '7.00', '11.00');

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE `speciality` (
  `specialityid` int(11) NOT NULL,
  `specialityname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`specialityid`, `specialityname`) VALUES
(1, 'Pediatrician'),
(2, 'Surgeon'),
(5, 'Psychiatrist'),
(7, 'Cardiologist'),
(8, 'Neurologist'),
(11, 'Allergy and Immunology');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `userphone` varchar(20) NOT NULL,
  `userpassword` varchar(200) NOT NULL,
  `userrole` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `userphone`, `userpassword`, `userrole`) VALUES
(2, 'aavian086', '+8801536109574', 'aavian123', 'admin'),
(4, 'asifsyed487', '+8801711544153', 'asif123', 'user'),
(9, 'asifsyed487', '+8801998126567', 'asif123', 'user'),
(10, 'asifsyed487', '+8801971544153', 'asif123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorid`);

--
-- Indexes for table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`specialityid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `specialityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
