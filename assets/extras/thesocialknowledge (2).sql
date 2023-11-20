-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 10:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesocialknowledge`
--

-- --------------------------------------------------------

--
-- Table structure for table `codinganswers`
--

CREATE TABLE `codinganswers` (
  `answer_id` int(11) NOT NULL,
  `question_id` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` longtext NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `test_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codinganswers`
--

INSERT INTO `codinganswers` (`answer_id`, `question_id`, `user_id`, `filename`, `correct`, `test_id`, `date`) VALUES
(29, '[\"13\"]', 43, '[\"answers/13php6f93baa.php\"]', 1, 8, '2023-11-20 04:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `codingquestions`
--

CREATE TABLE `codingquestions` (
  `code_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `inputOutput` longtext NOT NULL,
  `test_id` int(11) NOT NULL,
  `organiser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codingquestions`
--

INSERT INTO `codingquestions` (`code_id`, `question`, `inputOutput`, `test_id`, `organiser_id`) VALUES
(1, ' Hii i am aditya mishra ', '[{\"input\":\"dsa\",\"expected_output\":\"ads\"},{\"input\":\"ads\",\"expected_output\":\"das\"},{\"input\":\"ads\",\"expected_output\":\"asd\"}]', 7, 44),
(4, 'Write a program to add two numbers', '[{\"input\":\"1,2\",\"expected_output\":\"3\"},{\"input\":\"3,5\",\"expected_output\":\"8\"}]', 6, 43),
(5, 'Write a program to subtract two numbers', '[{\"input\":\"5,2\",\"expected_output\":\"3\"},{\"input\":\"1,2\",\"expected_output\":\"-1\"},{\"input\":\"6,0\",\"expected_output\":\"6\"}]', 6, 43),
(7, 'Write a program to multiply two number', '[{\"input\":\"4,5\",\"expected_output\":\"20\"},{\"input\":\"3,2\",\"expected_output\":\"6\"}]', 6, 43),
(8, 'Write a program to add two numbers.', '[{\"input\":\"5,8\",\"expected_output\":\"13\"},{\"input\":\"5,6\",\"expected_output\":\"11\"},{\"input\":\"9,1\",\"expected_output\":\"10\"}]', 8, 43),
(9, 'Write a program to subtract two numbers.', '[{\"input\":\"5,1\",\"expected_output\":\"4\"},{\"input\":\"9,1\",\"expected_output\":\"8\"},{\"input\":\"7,6\",\"expected_output\":\"1\"}]', 8, 43),
(10, 'Write a program to multiply two numbers', '[{\"input\":\"5,6\",\"expected_output\":\"30\"},{\"input\":\"2,4\",\"expected_output\":\"8\"}]', 8, 43),
(11, 'Concatenate two strings together', '[{\"input\":\"aditya, mishra\",\"expected_output\":\"aditya mishra\"}]', 8, 43),
(13, 'Write a program to divide two numbers', '[{\"input\":\"2,2\",\"expected_output\":\"1\"},{\"input\":\"4,2\",\"expected_output\":\"2\"},{\"input\":\"9,3\",\"expected_output\":\"3\"}]', 8, 43);

-- --------------------------------------------------------

--
-- Table structure for table `codingtest`
--

CREATE TABLE `codingtest` (
  `test_id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timefortest` int(11) NOT NULL,
  `heldfrom` datetime NOT NULL,
  `heldtill` datetime NOT NULL,
  `usersfortest` longtext NOT NULL,
  `organiser_id` int(11) NOT NULL,
  `displayed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codingtest`
--

INSERT INTO `codingtest` (`test_id`, `heading`, `description`, `timefortest`, `heldfrom`, `heldtill`, `usersfortest`, `organiser_id`, `displayed`) VALUES
(6, 'C++ programming', 'Hii this is the first test', 10, '2023-11-01 09:43:00', '2023-11-30 09:43:00', '', 43, 0),
(7, 'JavaScript Programming', 'Hii this is the second test', 10, '2023-11-01 10:19:00', '2023-11-30 10:19:00', '', 44, 0),
(8, 'PHP programming', 'This is the third test', 40, '2023-11-15 08:54:00', '2023-11-30 08:54:00', '', 43, 0),
(9, 'PHP Programming', 'php test', 10, '2023-11-13 09:54:00', '2023-11-22 09:54:00', '', 43, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codinganswers`
--
ALTER TABLE `codinganswers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `codingquestions`
--
ALTER TABLE `codingquestions`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `codingtest`
--
ALTER TABLE `codingtest`
  ADD PRIMARY KEY (`test_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codinganswers`
--
ALTER TABLE `codinganswers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `codingquestions`
--
ALTER TABLE `codingquestions`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `codingtest`
--
ALTER TABLE `codingtest`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
