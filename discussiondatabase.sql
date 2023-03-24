-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 02:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `discussiondatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `content` varchar(180) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(5) NOT NULL,
  `post_id` int(5) NOT NULL,
  `comment_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `created_at`, `created_by`, `post_id`, `comment_score`) VALUES
(32, 'Oh no', '2023-03-19 22:10:29', 6, 7, 0),
(33, 'That sucks', '2023-03-19 22:10:37', 6, 7, 0),
(34, 'Look in the sky!', '2023-03-19 22:10:49', 6, 7, 0),
(35, 'Great dog', '2023-03-19 22:17:01', 6, 5, 2),
(36, 'shaken espresso!', '2023-03-20 04:17:31', 6, 9, 0),
(37, 'nice', '2023-03-20 06:41:46', 6, 6, 0),
(38, 'yehh', '2023-03-21 07:06:39', 6, 16, 0),
(40, 'i do too', '2023-03-21 07:09:45', 2, 16, 0),
(41, 'me three', '2023-03-21 07:10:08', 24, 16, 0),
(42, 'yes', '2023-03-21 22:02:27', 2, 12, 0),
(43, 'yeehh', '2023-03-22 20:34:46', 2, 12, 0),
(44, 'hello', '2023-03-23 01:29:38', 2, 7, 0),
(45, 'me too', '2023-03-23 02:04:26', 2, 5, -1),
(46, 'yeh', '2023-03-23 02:06:55', 2, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `community_id` int(11) NOT NULL,
  `community_name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`community_id`, `community_name`, `description`) VALUES
(1, 'birds', 'community fo rbird lovers'),
(2, 'ferrari', 'Community for ferrari enthusiasts'),
(3, 'dog', 'community for dog lovers'),
(4, 'Coffee', 'Community about coffee'),
(5, 'Sports', 'Community for everything sports related');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(5) NOT NULL,
  `community_id` int(5) NOT NULL,
  `title` varchar(40) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `content`, `created_at`, `created_by`, `community_id`, `title`, `score`) VALUES
(5, 'This is my dog', '2023-03-18 22:00:14', 6, 3, 'I love dogs', 2),
(6, 'My new ferrari', '2023-03-18 22:00:26', 6, 2, 'Vroom', 0),
(8, 'yesss', '2023-03-18 23:32:52', 6, 3, 'Collie dogs are the best', 0),
(9, 'What are the best?', '2023-03-19 20:16:34', 6, 4, 'Best starbucks drinks', 1),
(15, 'yeh', '2023-03-20 23:03:10', 2, 4, 'I like coffee', 0),
(16, 'i love birds', '2023-03-20 23:03:44', 24, 1, 'YEAHH', 0),
(19, 'dogsss', '2023-03-22 17:50:18', 2, 3, 'h ah aha', 0),
(20, 'I cant decide. There are so many great options to choose from. Ferrari continue to innovate and excel in the supercar field', '2023-03-22 17:51:19', 2, 2, 'What is your favourite ferrari', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'arnold', 'arnold@gmail.com', '$2y$10$MOq2dRwWHnxMB', '2023-03-14 23:13:56'),
(2, 'joss', 'joss@gmail.com', 'Test1234', '2023-03-14 23:14:23'),
(3, 'cheese', 'cheese@gmail.com', '$2y$10$DPhzJCC7Y.a5c', '2023-03-14 23:15:20'),
(4, 'cat', 'cat@gmail.com', '$2y$10$UwHjRTdWv8pWS', '2023-03-14 23:45:25'),
(6, 'test', 'test@hotmail.com', '$2y$10$Rq8wHun5YmP.f', '2023-03-14 23:48:57'),
(8, 'aryan', 'aryan@gmail.com', '$2y$10$H9ueoQLbtX/FB', '2023-03-14 23:52:36'),
(10, 'sam', 'sam@gmail.com', '$2y$10$5X6S5q6s2UqMw', '2023-03-15 01:09:02'),
(13, 'jossw', 'jossw@gmail.com', '$2y$10$QdorxrovAnIrg', '2023-03-15 06:28:21'),
(15, 'test5', 'test5@gmail.com', '$2y$10$mxd.5SbzmvYxv', '2023-03-15 21:25:08'),
(16, 'samlly', 'samlly@gmail.com', '$2y$10$REkU6yff.ymWq', '2023-03-15 21:44:16'),
(17, 'aryan1', 'a@gmail.com', '$2y$10$mMnfWpQdY4JqQ', '2023-03-15 21:49:52'),
(18, 'test6', 't@gmail.com', '$2y$10$/ZGh5Re3l37pE', '2023-03-15 22:04:11'),
(19, 'aaa', 'aaa@ma.com', '111111', '2023-03-15 22:22:29'),
(20, 'aaa', 'aaa@ma.com', '111111', '2023-03-16 01:17:47'),
(21, 't', 't@gmail.com', 'Test1234', '2023-03-16 19:42:44'),
(22, 't', 't@gmail.com', 'Test1234', '2023-03-16 19:43:57'),
(23, 't2', 't2@gmail.com', 'Test1234', '2023-03-16 19:44:23'),
(24, 't6', 't@gmail.com', 'Test1234', '2023-03-16 19:50:58'),
(25, 'b', 'b@gmail.com', '$2y$10$DQzvY7HqwsN69', '2023-03-16 22:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_community`
--

CREATE TABLE `user_community` (
  `user_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_community`
--

INSERT INTO `user_community` (`user_id`, `community_id`, `join_date`) VALUES
(2, 1, '2023-03-21 14:39:41'),
(2, 2, '2023-03-21 17:23:17'),
(2, 1, '2023-03-21 17:28:57'),
(2, 3, '2023-03-21 17:30:12'),
(24, 3, '2023-03-21 18:00:24'),
(21, 3, '2023-03-21 18:00:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id FK to post_id (POST TABLE)` (`post_id`),
  ADD KEY `created_by FK to user_id (USERS TABLE)` (`created_by`);

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`community_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `created_ by FK to user_id` (`created_by`),
  ADD KEY `community_id FK to community_id (COMMUNITITES TABLE` (`community_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_community`
--
ALTER TABLE `user_community`
  ADD KEY `user_id FK to user_id in USERS` (`user_id`),
  ADD KEY `community_id FK to community_id in COMMUNITIES` (`community_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `community_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `created_by FK to user_id (USERS TABLE)` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `post_id FK to post_id (POST TABLE)` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `community_id FK to community_id (COMMUNITITES TABLE` FOREIGN KEY (`community_id`) REFERENCES `communities` (`community_id`),
  ADD CONSTRAINT `created_ by FK to user_id` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_community`
--
ALTER TABLE `user_community`
  ADD CONSTRAINT `community_id FK to community_id in COMMUNITIES` FOREIGN KEY (`community_id`) REFERENCES `communities` (`community_id`),
  ADD CONSTRAINT `user_id FK to user_id in USERS` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
