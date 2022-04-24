-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2019 at 03:16 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrenter`
--

-- --------------------------------------------------------

--
-- Table structure for table `Clerk`
--

CREATE TABLE `Clerk` (
  `Cusername` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Clerk`
--

INSERT INTO `Clerk` (`Cusername`, `password`) VALUES
('Amy', 'amy'),
('Violet', '199829');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `driverLiscense` int(10) NOT NULL,
  `fName` varchar(30) NOT NULL,
  `lName` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`driverLiscense`, `fName`, `lName`, `password`, `address`) VALUES
(123456, 'Violet', 'Liu', '123456', '2205 Lower Mall, Vancouver, BC'),
(432143, 'Amy', 'Zhu', '432143', '6335 Thunderbird Crescent, Vancouver, BC'),
(987654, 'David', 'Kim', '987654', '5960 Student Union Blvd, Vancouver, BC');

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `location` varchar(40) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `lc` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`location`, `city`, `lc`) VALUES
('1120 Homer Street', 'Vancouver', '1120 Homer Street,Vancouver'),
('13500 Commerce Pkwy', 'Richmond', '13500 Commerce Pkwy,Richmond'),
('5276 Kingsway', 'Burnaby', '5276 Kingsway,Burnaby'),
('8289 Granville Street', 'Vancouver', '8289 Granville Street,Vancouver');

-- --------------------------------------------------------

--
-- Table structure for table `Rentals`
--

CREATE TABLE `Rentals` (
  `rid` int(100) NOT NULL,
  `vlicence` varchar(4) NOT NULL,
  `driverLiscense` int(10) NOT NULL,
  `fdatetime` varchar(40) NOT NULL,
  `edatetime` varchar(40) NOT NULL,
  `cardType` varchar(4) NOT NULL,
  `cardNo` char(16) NOT NULL,
  `ExpDate` varchar(8) NOT NULL,
  `cvv` int(3) NOT NULL,
  `confNum` int(4) DEFAULT NULL,
  `odemeter` int(10) DEFAULT NULL,
  `rdatetime` varchar(40) DEFAULT NULL,
  `fulltank` varchar(3) DEFAULT NULL,
  `cost` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rentals`
--

INSERT INTO `Rentals` (`rid`, `vlicence`, `driverLiscense`, `fdatetime`, `edatetime`, `cardType`, `cardNo`, `ExpDate`, `cvv`, `confNum`, `odemeter`, `rdatetime`, `fulltank`, `cost`) VALUES
(8, '009', 123456, '2019-11-18 00:12:00', '2019-11-22 00:00:00', 'VISA', '4321432112341234', '2021-12', 234, 7, 120, '2019-11-22 00:00:00', 'yes', 5010),
(15, '002', 432143, '2019-11-19 10:36:16', '2019-11-22 00:20:00', 'MSTR', '5431123456788754', '2020-06', 513, NULL, 41, '2019-11-22 00:20:00', 'yes', 1780),
(16, '001', 123456, '2019-11-21 00:12', '2019-11-28 13:21:00', 'VISA', '4321432112341234', '2021-12', 234, 8, NULL, NULL, NULL, NULL),
(17, '013', 123456, '2019-11-22 00:23:00', '2019-11-30 02:13:00', 'AMEX', '3214123423453456', '2022-05', 768, 9, NULL, NULL, NULL, NULL),
(18, '018', 123456, '2019-11-22 04:32:00', '2019-12-01 04:53:00', 'MSTR', '5432234565433456', '2021-09', 341, 10, NULL, NULL, NULL, NULL),
(19, '004', 432143, '2019-11-22 11:13:19', '2019-11-26 14:13:00', 'VISA', '4321123456788765', '2022-11', 421, NULL, NULL, NULL, NULL, NULL),
(20, '051', 432143, '2019-11-22 11:15:10', '2019-11-26 14:13:00', 'VISA', '4321123456788765', '2022-11', 421, NULL, NULL, NULL, NULL, NULL),
(21, '052', 432143, '2019-11-22 11:15:22', '2019-11-26 14:13:00', 'VISA', '4321123456788765', '2022-11', 421, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE `Reservation` (
  `confNum` int(4) NOT NULL,
  `driverLiscense` int(10) NOT NULL,
  `fdatetime` varchar(40) NOT NULL,
  `edatetime` varchar(40) NOT NULL,
  `lc` varchar(60) NOT NULL,
  `vtname` varchar(20) NOT NULL,
  `rdate` varchar(40) NOT NULL,
  `cardType` varchar(4) NOT NULL,
  `cardNo` varchar(16) NOT NULL,
  `ExpDate` varchar(8) NOT NULL,
  `cvv` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reservation`
--

INSERT INTO `Reservation` (`confNum`, `driverLiscense`, `fdatetime`, `edatetime`, `lc`, `vtname`, `rdate`, `cardType`, `cardNo`, `ExpDate`, `cvv`) VALUES
(7, 123456, '2019-11-18 00:12:00', '2019-11-30 13:21:00', '1120 Homer Street,Vancouver', 'Economy', '2019-11-16 03:38:02', 'VISA', '4321432112341234', '2021-12', '234'),
(8, 123456, '2019-11-21 00:12:00', '2019-11-28 13:21:00', '1120 Homer Street,Vancouver', 'Economy', '2019-11-20 03:38:02', 'VISA', '4321432112341234', '2021-12', '234'),
(9, 123456, '2019-11-21 00:23:00', '2019-11-30 02:13:00', '1120 Homer Street,Vancouver', 'SUV', '2019-11-21 09:56:04', 'AMEX', '3214123423453456', '2022-05', '768'),
(10, 123456, '2019-11-21 04:32:00', '2019-12-01 04:53:00', '8289 Granville Street,Vancouver', 'Standard', '2019-11-21 09:56:50', 'MSTR', '5432234565433456', '2021-09', '341'),
(11, 123456, '2019-11-27 12:31:00', '2019-12-01 12:31:00', '1120 Homer Street,Vancouver', 'Economy', '2019-11-24 06:10:35', 'VISA', '4321543265437654', '2021-12', '745'),
(12, 123456, '2019-11-29 06:53:00', '2019-11-30 06:54:00', '8289 Granville Street,Vancouver', 'Standard', '2019-11-24 06:11:17', 'MSTR', '5476345212349876', '2020-08', '425');

-- --------------------------------------------------------

--
-- Table structure for table `Vehicles`
--

CREATE TABLE `Vehicles` (
  `vlicence` varchar(4) NOT NULL,
  `make` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `odemeter` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `lc` varchar(60) NOT NULL,
  `vtname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vehicles`
--

INSERT INTO `Vehicles` (`vlicence`, `make`, `model`, `year`, `odemeter`, `status`, `color`, `lc`, `vtname`) VALUES
('001', 'Toyota', 'Camry', 2000, 4000, 'rented', 'Black', '1120 Homer Street,Vancouver', 'Economy'),
('002', 'Audi', 'Q7', 2010, 400, 'available', 'White', '1120 Homer Street,Vancouver', 'Economy'),
('003', 'Audi', 'Q5', 2011, 3000, 'available', 'Green', '1120 Homer Street,Vancouver', 'Economy'),
('004', 'BMW', 'X5', 2009, 10000, 'rented', 'Blue', '8289 Granville Street,Vancouver', 'Economy'),
('005', ' Ford', 'Fiesta', 2011, 3020, 'available', 'Red', '13500 Commerce Pkwy,Richmond', 'SUV'),
('006', ' Hyundai', 'Palisade', 2011, 7789, 'available', 'Red', '5276 Kingsway,Burnaby', 'Standard'),
('007', ' Jeep', 'Renegade', 2019, 10, 'available', 'Grey', '13500 Commerce Pkwy,Richmond', 'Truck'),
('008', ' Jeep', 'Renegade', 2010, 100, 'rented', 'Black', '13500 Commerce Pkwy,Richmond', 'Truck'),
('009', 'Audi', 'Q6', 2011, 400, 'available', 'Red', '1120 Homer Street,Vancouver', 'Economy'),
('010', 'Audi', 'Q6', 2011, 400, 'available', 'Red', '1120 Homer Street,Vancouver', 'Economy'),
('011', 'BWM', 'X2', 2012, 233, 'available', 'White', '8289 Granville Street,Vancouver', 'SUV'),
('012', 'BWM', 'X1', 2014, 3241, 'available', 'Black', '8289 Granville Street,Vancouver', 'SUV'),
('013', 'Chevrolet', 'Traverse', 2019, 564, 'rented', 'Black', '1120 Homer Street,Vancouver', 'SUV'),
('014', 'Ford', 'Escape', 2013, 12864, 'available', 'Grey', '1120 Homer Street,Vancouver', 'SUV'),
('015', 'Ford', 'Explorer', 2011, 14380, 'available', 'Blue', '8289 Granville Street,Vancouver', 'SUV'),
('016', 'Chevrolet', 'Bolt', 2017, 9830, 'available', 'Orange', '1120 Homer Street,Vancouver', 'Standard'),
('017', 'Chevrolet', 'Spark', 2018, 830, 'available', 'Purple', '1120 Homer Street,Vancouver', 'Standard'),
('018', 'Fiat', '500L', 2018, 6789, 'rented', 'Black', '8289 Granville Street,Vancouver', 'Standard'),
('019', 'Honda', 'Crosstour', 2012, 3446, 'available', 'Blue', '8289 Granville Street,Vancouver', 'Mid-size'),
('020', 'Honda', 'Fit', 2015, 10044, 'available', 'Blue', '8289 Granville Street,Vancouver', 'Mid-size'),
('021', 'Kia', 'Niro', 2017, 14034, 'available', 'Blue', '8289 Granville Street,Vancouver', 'SUV'),
('022', 'Kia', 'Rio', 2018, 7044, 'available', 'White', '8289 Granville Street,Vancouver', 'Standard'),
('023', 'Mercedes-Benz', 'Fit', 2015, 9742, 'available', 'Blue', '8289 Granville Street,Vancouver', 'SUV'),
('024', 'Mercedes-Benz', 'Fit', 2015, 10214, 'available', 'White', '1120 Homer Street,Vancouver', 'Economy'),
('025', 'Mercedes-Benz', 'E-Class', 2017, 12324, 'available', 'Blue', '5276 Kingsway,Burnaby', 'Economy'),
('026', 'Honda', 'Fit', 2015, 22344, 'available', 'Blue', '5276 Kingsway,Burnaby', 'Economy'),
('027', 'Toyota', 'C-HR', 2017, 9814, 'available', 'Black', '1120 Homer Street,Vancouver', 'SUV'),
('028', 'Toyota', 'C-HR', 2017, 10214, 'available', 'Black', '1120 Homer Street,Vancouver', 'SUV'),
('029', 'Toyota', 'Matrix', 2009, 20214, 'available', 'White', '1120 Homer Street,Vancouver', 'Economy'),
('030', 'Toyota', 'Matrix', 2009, 16214, 'available', 'White', '1120 Homer Street,Vancouver', 'Mid-size'),
('031', 'Toyota', 'Prius', 2016, 18314, 'available', 'Blue', '1120 Homer Street,Vancouver', 'Standard'),
('032', 'Toyota', 'Fit', 2015, 10214, 'available', 'White', '1120 Homer Street,Vancouver', 'Economy'),
('033', 'Dodge', 'Dakota', 2005, 13242, 'available', 'White', '1120 Homer Street,Vancouver', 'Truck'),
('034', 'Ford', 'Explorer', 2007, 28714, 'available', 'Black', '8289 Granville Street,Vancouver', 'Truck'),
('035', 'Mercedes-Benz', 'Fit', 2015, 9214, 'available', 'White', '1120 Homer Street,Vancouver', 'Economy'),
('036', 'Ford', 'F-150', 2015, 9874, 'available', 'Black', '8289 Granville Street,Vancouver', 'Truck'),
('037', 'Ford', 'Ranger', 2019, 2214, 'available', 'White', '1120 Homer Street,Vancouver', 'Truck'),
('038', 'Ford', 'Ranger', 2019, 5214, 'available', 'White', '1120 Homer Street,Vancouver', 'Truck'),
('039', 'Ford', 'Ranger', 2019, 8214, 'available', 'White', '1120 Homer Street,Vancouver', 'Truck'),
('040', 'GMC', 'Canyon', 2015, 9254, 'available', 'Black', '8289 Granville Street,Vancouver', 'Truck'),
('041', 'GMC', 'Canyon', 2015, 13241, 'available', 'Black', '1120 Homer Street,Vancouver', 'Truck'),
('042', 'Dodge', 'Dart', 2013, 9234, 'available', 'White', '1120 Homer Street,Vancouver', 'Mid-size'),
('043', 'Dodge', 'Dart', 2013, 10234, 'available', 'Orange', '8289 Granville Street,Vancouver', 'Mid-size'),
('044', 'Dodge', 'Dart', 2013, 8232, 'available', 'White', '8289 Granville Street,Vancouver', 'Mid-size'),
('045', 'Dodge', 'Dart', 2013, 9234, 'available', 'Black', '1120 Homer Street,Vancouver', 'Mid-size'),
('046', 'Mercedes-Benz', 'Fit', 2015, 25214, 'available', 'White', '1120 Homer Street,Vancouver', 'Economy'),
('047', 'Fiat', '500L', 2014, 9344, 'available', 'White', '8289 Granville Street,Vancouver', 'Mid-size'),
('048', 'Fiat', '500L', 2014, 7623, 'available', 'White', '8289 Granville Street,Vancouver', 'Mid-size'),
('049', 'Fiat', '500L', 2014, 9821, 'available', 'White', '8289 Granville Street,Vancouver', 'Mid-size'),
('050', 'Fiat', '500L', 2014, 12414, 'available', 'White', '5276 Kingsway,Burnaby', 'Mid-size'),
('051', 'Mercedes-Benz', 'Fit', 2015, 23424, 'rented', 'White', '8289 Granville Street,Vancouver', 'Economy'),
('052', 'Honda', 'Civic', 2016, 2124, 'rented', 'Black', '8289 Granville Street,Vancouver', 'Economy'),
('053', 'Honda', 'Civic', 2016, 13424, 'available', 'Black', '8289 Granville Street,Vancouver', 'Economy'),
('054', 'Honda', 'Civic', 2016, 54424, 'available', 'White', '5276 Kingsway,Burnaby', 'Economy'),
('055', 'Audi', 'Q5', 2018, 12314, 'available', 'White', '5276 Kingsway,Burnaby', 'SUV'),
('056', 'Audi', 'Q5', 2018, 6424, 'available', 'Black', '5276 Kingsway,Burnaby', 'SUV'),
('057', 'Audi', 'Q5', 2018, 7674, 'available', 'Black', '8289 Granville Street,Vancouver', 'SUV'),
('058', 'Ford', 'Ranger', 2017, 8624, 'available', 'Blue', '1120 Homer Street,Vancouver', 'Truck'),
('059', 'Ford', 'Ranger', 2017, 9424, 'available', 'Blue', '8289 Granville Street,Vancouver', 'Truck'),
('060', 'Ford', 'R-350', 2019, 5424, 'available', 'Blue', '1120 Homer Street,Vancouver', 'Truck'),
('061', 'Toyota', 'Matrix', 2009, 20214, 'available', 'White', '13500 Commerce Pkwy,Richmond', 'Economy'),
('062', 'Toyota', 'Matrix', 2009, 16214, 'available', 'White', '13500 Commerce Pkwy,Richmond', 'Mid-size'),
('063', 'Ford', 'Ranger', 2017, 9424, 'available', 'Blue', '13500 Commerce Pkwy,Richmond', 'Truck'),
('064', 'Ford', 'Ranger', 2017, 9424, 'available', 'Blue', '5276 Kingsway,Burnaby', 'Truck');

-- --------------------------------------------------------

--
-- Table structure for table `Vtype`
--

CREATE TABLE `Vtype` (
  `vtname` varchar(30) NOT NULL,
  `weekRate` int(5) DEFAULT NULL,
  `dayRate` int(5) DEFAULT NULL,
  `hourRate` int(5) DEFAULT NULL,
  `kiloRate` int(5) DEFAULT NULL,
  `winsRate` int(5) DEFAULT NULL,
  `hinsRate` int(5) DEFAULT NULL,
  `dinsRate` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vtype`
--

INSERT INTO `Vtype` (`vtname`, `weekRate`, `dayRate`, `hourRate`, `kiloRate`, `winsRate`, `hinsRate`, `dinsRate`) VALUES
('Economy', 500, 70, 20, 40, 100, 50, 190),
('Fullsize', 500, 70, 20, 35, 100, 50, 130),
('Mid-size', 500, 70, 60, 45, 100, 50, 190),
('Standard', 500, 40, 20, 76, 100, 50, 190),
('SUV', 500, 70, 20, 55, 180, 50, 190),
('Truck', 440, 70, 20, 75, 100, 50, 190);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Clerk`
--
ALTER TABLE `Clerk`
  ADD PRIMARY KEY (`Cusername`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`driverLiscense`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`lc`);

--
-- Indexes for table `Rentals`
--
ALTER TABLE `Rentals`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `confNum` (`confNum`),
  ADD KEY `vlicence` (`vlicence`),
  ADD KEY `driverLiscense` (`driverLiscense`);

--
-- Indexes for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`confNum`),
  ADD KEY `vtname` (`vtname`),
  ADD KEY `driverLiscense` (`driverLiscense`);

--
-- Indexes for table `Vehicles`
--
ALTER TABLE `Vehicles`
  ADD PRIMARY KEY (`vlicence`),
  ADD KEY `lc` (`lc`),
  ADD KEY `vtname` (`vtname`);

--
-- Indexes for table `Vtype`
--
ALTER TABLE `Vtype`
  ADD PRIMARY KEY (`vtname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Rentals`
--
ALTER TABLE `Rentals`
  MODIFY `rid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `confNum` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Rentals`
--
ALTER TABLE `Rentals`
  ADD CONSTRAINT `Rentals_ibfk_1` FOREIGN KEY (`confNum`) REFERENCES `Reservation` (`confNum`),
  ADD CONSTRAINT `Rentals_ibfk_2` FOREIGN KEY (`vlicence`) REFERENCES `Vehicles` (`vlicence`),
  ADD CONSTRAINT `Rentals_ibfk_3` FOREIGN KEY (`driverLiscense`) REFERENCES `Customer` (`driverLiscense`);

--
-- Constraints for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `Reservation_ibfk_1` FOREIGN KEY (`vtname`) REFERENCES `Vtype` (`vtname`),
  ADD CONSTRAINT `Reservation_ibfk_2` FOREIGN KEY (`driverLiscense`) REFERENCES `Customer` (`driverLiscense`);

--
-- Constraints for table `Vehicles`
--
ALTER TABLE `Vehicles`
  ADD CONSTRAINT `Vehicles_ibfk_1` FOREIGN KEY (`lc`) REFERENCES `Location` (`lc`),
  ADD CONSTRAINT `Vehicles_ibfk_2` FOREIGN KEY (`vtname`) REFERENCES `Vtype` (`vtname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
