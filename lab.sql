-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 09:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `age` int(11) NOT NULL,
  `id` int(255) NOT NULL,
  `date` date DEFAULT current_timestamp(),
  `gender` enum('male','female') NOT NULL DEFAULT 'male'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`name`, `age`, `id`, `date`, `gender`) VALUES
('هدي محمد احمد', 20, 202406241, '2024-06-24', 'female'),
('اسلام احمد محمود', 50, 202406242, '2024-06-24', 'male'),
('عبدالرحمن مراد', 24, 202409141, '2024-09-14', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `patients_tests`
--

CREATE TABLE `patients_tests` (
  `patient_ID` int(255) DEFAULT NULL,
  `testName` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  `status` varchar(11) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_tests`
--

INSERT INTO `patients_tests` (`patient_ID`, `testName`, `value`, `date`, `status`) VALUES
(202406241, 'Free T3', NULL, '2024-06-24', 'new'),
(202406241, 'Free T4', NULL, '2024-06-24', 'new'),
(202406241, 'TSH', NULL, '2024-06-24', 'new'),
(202406242, 'PTH', '150', '2024-06-24', 'complete'),
(202409141, 'Free T3', NULL, '2024-09-14', 'new'),
(202409141, 'Free T4', NULL, '2024-09-14', 'new'),
(202409141, 'TSH', NULL, '2024-09-14', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `testName` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `HostID` int(11) NOT NULL,
  `unit` varchar(11) NOT NULL,
  `tube` varchar(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `RefRange` varchar(300) NOT NULL,
  `unitTest` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`testName`, `id`, `HostID`, `unit`, `tube`, `price`, `amount`, `RefRange`, `unitTest`) VALUES
('CEA', 11, 0, 'hormones', 'EDITA', 60, 100, 'non smokers<3<br>smokers<5', 'ng/ml'),
('E2 Estrogen', 10, 0, 'hormones', 'EDITA', 50, 100, 'childern 10-36<br>Adult male <=56<br>female 57-22', 'Pg/mL'),
('Free T3', 1, 0, 'hormones', 'EDITA', 40, 91, '1.8-4.6', 'Pg/mL'),
('Free T4', 2, 0, 'hormones', 'EDITA', 40, 91, '0.9-1.8', 'ng/dl'),
('FSH', 6, 0, 'hormones', 'EDITA', 40, 100, 'male 0.95-11.95<br>female<br> follicular phase 3.3-8.8<br>mid cycle phase 2.55-16.69<br>luteal 1.38-5.47<br>menopausal 26.7-133.4', 'mIU/mL'),
('Progestrone', 9, 0, 'hormones', 'EDITA', 50, 100, 'male:0.27-0.90<br>female<br>follicular phase:0.10-1.60<br>luteal:2.50-32.0<br>post menopausal:0.06-1.60<br>pregnancy:>250', 'ng/ml'),
('Prolactin', 7, 0, 'hormones', 'EDITA', 35, 100, 'male 2.58-18.12<br>female 1.2-29.93', 'ng/mL'),
('PTH', 4, 0, 'hormones', 'EDITA', 100, 94, '12.0-72.0', 'Pg/mL'),
('Testosterone', 8, 0, 'hormones', 'EDITA', 45, 100, '3-8', 'ng/mL'),
('TSH', 3, 0, 'hormones', 'EDITA', 35, 91, '0.20-4.40', 'uIU/ml'),
('V.D', 5, 0, 'hormones', 'EDITA', 220, 97, 'severe Def:<10<br> modertae Def: 10-20<br> insufficiency: 21-29<br> sufficiency:30-100', 'ng/ml');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `unit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `unit`) VALUES
(3, 'admin', 'admin', 'admin'),
(2, 'AZZA', 'AZZA', 'hormones'),
(4, 'nurse', 'nurse', 'registration'),
(1, 'saif', 'saif1', 'hormones');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients_tests`
--
ALTER TABLE `patients_tests`
  ADD KEY `patient_ID` (`patient_ID`),
  ADD KEY `testName` (`testName`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`testName`,`unit`),
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`,`password`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patients_tests`
--
ALTER TABLE `patients_tests`
  ADD CONSTRAINT `patients_tests_ibfk_1` FOREIGN KEY (`patient_ID`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `patients_tests_ibfk_2` FOREIGN KEY (`testName`) REFERENCES `tests` (`testName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
