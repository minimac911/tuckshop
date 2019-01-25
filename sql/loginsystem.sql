-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2019 at 01:35 PM
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
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblchildren`
--

CREATE TABLE `tblchildren` (
  `idChild` int(11) NOT NULL,
  `firstNameChild` text NOT NULL,
  `lastNameChild` text NOT NULL,
  `gradeChild` text NOT NULL,
  `classChild` text NOT NULL,
  `idUsers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblchildren`
--

INSERT INTO `tblchildren` (`idChild`, `firstNameChild`, `lastNameChild`, `gradeChild`, `classChild`, `idUsers`) VALUES
(1, 'testFirstName', 'testLastName', 'RR', 'red', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `usernameUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `usernameUsers`, `emailUsers`, `pwdUsers`) VALUES
(1, 'a', 'thomasmcalpine77@gmail.com', '$2y$10$M/49wQwFsiCOtywyj1NYU.eSz4Ie5y6CbnVxWg6xpt40Tiw/fCL46'),
(2, 'ron', 'homegmax@gmail.com', '$2y$10$jdRlSo.3Qy5u4aFbyH745OrxMuGr2JtNEpfl6w2BBSeGc.goLdOay'),
(3, 'b', 'thomasmcalpine77@gmail.com', '$2y$10$OKa10coKlVp50yDl2QNoA.eucok9kyfFZNHQVNxGyGviUNEe5ZuPG'),
(4, 'thomas', 'thomasmcalpine77@gmail.com', '$2y$10$d9E/efGycULtd5ZkbG7Jc.SDAr5xM8qyaUEl0R9F5tK/RYINC0etu'),
(5, 'qq', 'thomasmcalpine77@gmail.com', '$2y$10$5NhTaPynsKvxdmLd7TCWke2TuULP81d6NLcx8vwypU0HzKh9V1.ca'),
(6, 'gavin', 'homegmax@gmail.com', '$2y$10$s5wGH.BLeNujyiYRomjbY.lDh5wsbGXMbMhvR6v5HcpnYocsdxMXC'),
(7, 'r', 'thomasmcalpine77@gmail.com', '$2y$10$PFEZsYE/yiTRkHduOOJNwuC95KZejbwCA38SNVfMjNOuvms5UZUlW');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblchildren`
--
ALTER TABLE `tblchildren`
  MODIFY `idChild` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
