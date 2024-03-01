-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220616.7a6bd9eb57
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 04:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puubu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cont_details`
--

CREATE TABLE `cont_details` (
  `cont_id` int(11) NOT NULL,
  `cont_indentification` varchar(10) NOT NULL,
  `cont_fname` varchar(100) NOT NULL,
  `cont_lname` varchar(100) NOT NULL,
  `cont_gender` varchar(10) NOT NULL,
  `cont_position` varchar(500) NOT NULL,
  `election_name` int(11) NOT NULL,
  `cont_profile` text NOT NULL,
  `del_cont` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cont_details`
--

INSERT INTO `cont_details` (`cont_id`, `cont_indentification`, `cont_fname`, `cont_lname`, `cont_gender`, `cont_position`, `election_name`, `cont_profile`, `del_cont`) VALUES
(1, 'B12', 'hamza', 'nuhu', 'male', '1', 1, '62935a548098c1.97993788.jpg', 'no'),
(2, 'B13', 'wadud', 'husein', 'female', '2', 1, '62935a74be2d68.03338471.jpg', 'no'),
(3, 'B12 ', 'bamba', 'fati', 'male', '4', 3, '629a1fcd588af9.04948391.jpg', 'yes'),
(4, 'B13', 'kadr', 'zubr', 'female', '4', 3, '629a2127f2d7f9.88540438.jpg', 'no'),
(5, 'fms/111', 'edward', 'satah', 'male', '1', 1, '629bce13eed8a3.99082896.jpg', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `eid` int(11) NOT NULL,
  `election_name` varchar(225) NOT NULL,
  `election_by` varchar(255) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `stop_timer` timestamp NULL DEFAULT NULL,
  `election_manual_stop_time` datetime DEFAULT NULL,
  `session` tinyint(4) NOT NULL,
  `etrash` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`eid`, `election_name`, `election_by`, `added_date`, `stop_timer`, `election_manual_stop_time`, `session`, `etrash`) VALUES
(1, 'src', 'genge', '2022-05-29 12:33:44', NULL, '2022-07-02 21:48:54', 2, 0),
(2, 'Tumi', 'tono', '2022-05-29 23:30:12', '2022-06-03 15:38:39', '2022-06-03 17:38:39', 2, 0),
(3, 'Mis Malikas', 'Romans', '2022-06-02 09:59:47', NULL, NULL, 0, 0),
(4, 'CKT SRC', 'ddf', '2022-06-03 15:53:47', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(1000) NOT NULL,
  `election_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`, `election_id`) VALUES
(1, 'presitdent', 1),
(2, 'pro', 1),
(4, 'captain', 3),
(5, 'tresu', 4),
(6, 'boos', 4);

-- --------------------------------------------------------

--
-- Table structure for table `puubu_admin`
--

CREATE TABLE `puubu_admin` (
  `c_aid` int(11) NOT NULL,
  `cfname` varchar(100) NOT NULL,
  `clname` varchar(100) NOT NULL,
  `cemail` varchar(100) NOT NULL,
  `ckey` varchar(100) NOT NULL,
  `joined_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `trash` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `puubu_admin`
--

INSERT INTO `puubu_admin` (`c_aid`, `cfname`, `clname`, `cemail`, `ckey`, `joined_date`, `last_login`, `trash`) VALUES
(1, 'mohammed', 'inuwa', 'inuwa@puubu.com', '$2y$10$RSgpoOFGTDy7uR.fLI4djuhvIC0iYlnY4RmFlSI9348WDAkh8UuPq', '2020-02-21 21:01:31', '2022-07-02 21:37:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `puubu_election_logs`
--

CREATE TABLE `puubu_election_logs` (
  `puubu_election_logs_id` int(11) NOT NULL,
  `election_logs_election_id` int(11) DEFAULT NULL,
  `puubu_election_logs_datetime` datetime DEFAULT current_timestamp(),
  `election_logs_description` text NOT NULL,
  `election_logs_page` varchar(500) DEFAULT NULL,
  `election_logs_referrer` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registrars`
--

CREATE TABLE `registrars` (
  `id` int(11) NOT NULL,
  `std_id` varchar(12) NOT NULL,
  `std_password` varchar(30) NOT NULL,
  `std_fname` varchar(30) NOT NULL,
  `std_lname` varchar(30) NOT NULL,
  `std_email` varchar(200) NOT NULL,
  `vote` enum('no','yes') NOT NULL,
  `election_type` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrars`
--

INSERT INTO `registrars` (`id`, `std_id`, `std_password`, `std_fname`, `std_lname`, `std_email`, `vote`, `election_type`, `status`) VALUES
(1, 'fms/001', 'lmv6iASU', 'tija i', 'mioro', 'tjhackx111@gmail.com', 'no', 1, 1),
(2, 'fms/12', 'QfHO9htk', 'bamabd', 'batu', 'tj@email.com', 'no', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `voted_for`
--

CREATE TABLE `voted_for` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `voted_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `voted_location` varchar(255) NOT NULL,
  `voted_ip` varchar(100) NOT NULL,
  `trash` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voted_for`
--

INSERT INTO `voted_for` (`id`, `voter_id`, `election_id`, `position_id`, `candidate_id`, `voted_datetime`, `voted_location`, `voted_ip`, `trash`) VALUES
(67, 1, 1, 1, 1, '2022-06-05 00:45:40', '', '', 0),
(68, 1, 1, 2, 2, '2022-06-05 00:45:40', '', '', 0),
(69, 1, 1, 1, 5, '2022-06-29 11:58:34', '', '', 0),
(70, 1, 1, 2, 2, '2022-06-29 11:58:34', '', '', 0),
(71, 1, 1, 1, 5, '2022-06-29 11:59:20', '', '', 0),
(72, 1, 1, 2, 2, '2022-06-29 11:59:21', '', '', 0),
(73, 1, 1, 1, 1, '2022-06-29 12:00:09', '', '', 0),
(74, 1, 1, 2, 2, '2022-06-29 12:00:09', '', '', 0),
(75, 1, 1, 1, 1, '2022-06-29 12:56:07', '', '', 0),
(76, 1, 1, 2, 2, '2022-06-29 12:56:07', '', '', 0),
(77, 1, 1, 1, 1, '2022-07-02 03:37:53', '', '', 0),
(78, 1, 1, 2, 2, '2022-07-02 03:37:53', '', '', 0),
(79, 1, 1, 1, 5, '2022-07-02 03:54:07', '', '', 0),
(80, 1, 1, 2, 2, '2022-07-02 03:54:08', '', '', 0),
(81, 1, 1, 1, 5, '2022-07-02 03:54:32', '', '', 0),
(82, 1, 1, 2, 2, '2022-07-02 03:54:32', '', '', 0),
(83, 1, 1, 1, 5, '2022-07-02 03:54:56', '', '', 0),
(84, 1, 1, 2, 2, '2022-07-02 03:54:57', '', '', 0),
(85, 1, 1, 1, 1, '2022-07-02 04:17:28', 'Accra, GH', '41.66.239.63', 0),
(86, 1, 1, 2, 2, '2022-07-02 04:17:28', 'Accra, GH', '41.66.239.63', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voterhasdone`
--

CREATE TABLE `voterhasdone` (
  `vhd_id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `voterhasdone_time` datetime DEFAULT current_timestamp(),
  `voterhasdone_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voterhasdone`
--

INSERT INTO `voterhasdone` (`vhd_id`, `voter_id`, `election_id`, `voterhasdone_time`, `voterhasdone_status`) VALUES
(41, 1, 1, '2022-07-02 04:17:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `voter_login_details`
--

CREATE TABLE `voter_login_details` (
  `voter_login_details_id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `voter_login_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `voter_logout_datetime` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `voter_login_details_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voter_login_details`
--

INSERT INTO `voter_login_details` (`voter_login_details_id`, `voter_id`, `voter_login_datetime`, `voter_logout_datetime`, `voter_login_details_status`) VALUES
(1, 1, '2022-06-29 13:56:54', '2022-06-29 15:57:15', 0),
(2, 1, '2022-06-29 13:59:32', '2022-06-29 13:59:56', 1),
(3, 1, '2022-07-02 01:49:06', '2022-07-02 03:38:19', 1),
(4, 1, '2022-07-02 03:53:23', '2022-07-02 04:16:52', 1),
(5, 1, '2022-07-02 04:17:05', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vote_counts`
--

CREATE TABLE `vote_counts` (
  `id` int(11) NOT NULL,
  `results` int(11) NOT NULL,
  `results_no` int(11) NOT NULL,
  `cont_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vote_counts`
--

INSERT INTO `vote_counts` (`id`, `results`, `results_no`, `cont_id`, `position_id`, `election_id`) VALUES
(1, 27, 1, 1, 1, 1),
(2, 15, 28, 2, 2, 1),
(3, 0, 0, 3, 4, 3),
(4, 0, 0, 4, 4, 3),
(5, 15, 0, 5, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cont_details`
--
ALTER TABLE `cont_details`
  ADD PRIMARY KEY (`cont_id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `puubu_admin`
--
ALTER TABLE `puubu_admin`
  ADD PRIMARY KEY (`c_aid`);

--
-- Indexes for table `puubu_election_logs`
--
ALTER TABLE `puubu_election_logs`
  ADD PRIMARY KEY (`puubu_election_logs_id`);

--
-- Indexes for table `registrars`
--
ALTER TABLE `registrars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_type` (`election_type`);

--
-- Indexes for table `voted_for`
--
ALTER TABLE `voted_for`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`),
  ADD KEY `election_id` (`election_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- Indexes for table `voterhasdone`
--
ALTER TABLE `voterhasdone`
  ADD PRIMARY KEY (`vhd_id`);

--
-- Indexes for table `voter_login_details`
--
ALTER TABLE `voter_login_details`
  ADD PRIMARY KEY (`voter_login_details_id`);

--
-- Indexes for table `vote_counts`
--
ALTER TABLE `vote_counts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cont_details`
--
ALTER TABLE `cont_details`
  MODIFY `cont_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `puubu_admin`
--
ALTER TABLE `puubu_admin`
  MODIFY `c_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `puubu_election_logs`
--
ALTER TABLE `puubu_election_logs`
  MODIFY `puubu_election_logs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrars`
--
ALTER TABLE `registrars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `voted_for`
--
ALTER TABLE `voted_for`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `voterhasdone`
--
ALTER TABLE `voterhasdone`
  MODIFY `vhd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `voter_login_details`
--
ALTER TABLE `voter_login_details`
  MODIFY `voter_login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vote_counts`
--
ALTER TABLE `vote_counts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



