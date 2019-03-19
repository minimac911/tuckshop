-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2019 at 09:15 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtuckshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice_bridge`
--

CREATE TABLE `invoice_bridge` (
  `idInvoice` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `idCategory` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetExpires` datetime NOT NULL,
  `pwdResetSelector` varchar(255) NOT NULL,
  `pwdResetToken` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblchildren`
--

CREATE TABLE `tblchildren` (
  `idChild` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `firstNameChild` text NOT NULL,
  `lastNameChild` text NOT NULL,
  `classChild` text NOT NULL,
  `gradeChild` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblchildren`
--

INSERT INTO `tblchildren` (`idChild`, `idUser`, `firstNameChild`, `lastNameChild`, `classChild`, `gradeChild`) VALUES
(1, 1, 'Gavin', 'McAlpine', 'R', '6');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE `tblinvoice` (
  `idInvoice` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `datePaid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `idOrder` int(11) NOT NULL,
  `totalPrice` double NOT NULL,
  `dateOrdered` datetime NOT NULL,
  `dueDate` datetime NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `idChild` int(11) NOT NULL,
  `idParent` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_cart`
--

CREATE TABLE `tblorder_cart` (
  `idOrder` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_days`
--

CREATE TABLE `tblorder_days` (
  `idOrderDay` int(11) NOT NULL,
  `grade` varchar(5) NOT NULL,
  `day` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblshopitems`
--

CREATE TABLE `tblshopitems` (
  `categoryItem` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `isGr3AndUpItems` tinyint(4) NOT NULL,
  `isGrRRItem` tinyint(4) NOT NULL,
  `isGrRTo2Items` tinyint(4) NOT NULL,
  `nameItem` varchar(255) NOT NULL,
  `priceItem` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `emailUsers` varchar(255) NOT NULL,
  `idUser` int(11) NOT NULL,
  `numChildren` int(11) NOT NULL,
  `pwdUsers` varchar(255) NOT NULL,
  `usernameUsers` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`emailUsers`, `idUser`, `numChildren`, `pwdUsers`, `usernameUsers`) VALUES
('homegmax@gmail.com', 1, 1, '$2y$10$.b9Zs5hZfyaIR1r24HWjHeI3bV6Q.JvrxZ4Z429G56tHif24YWX2q', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_bridge`
--
ALTER TABLE `invoice_bridge`
  ADD PRIMARY KEY (`idInvoice`,`idOrder`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `tblchildren`
--
ALTER TABLE `tblchildren`
  ADD PRIMARY KEY (`idChild`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`idInvoice`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`idOrder`);

--
-- Indexes for table `tblorder_days`
--
ALTER TABLE `tblorder_days`
  ADD PRIMARY KEY (`idOrderDay`);

--
-- Indexes for table `tblshopitems`
--
ALTER TABLE `tblshopitems`
  ADD PRIMARY KEY (`idItem`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblchildren`
--
ALTER TABLE `tblchildren`
  MODIFY `idChild` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `idInvoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblorder_days`
--
ALTER TABLE `tblorder_days`
  MODIFY `idOrderDay` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblshopitems`
--
ALTER TABLE `tblshopitems`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
