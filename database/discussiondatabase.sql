-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2023 at 04:48 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_80772049`
--

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE IF NOT EXISTS `codes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(1, 'jossw7@gmail.com', '66698', 1679811600);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `content` varchar(180) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(5) NOT NULL,
  `post_id` int(5) NOT NULL,
  `comment_score` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `created_at`, `created_by`, `post_id`, `comment_score`) VALUES
(1, 'hello', '2023-03-26 06:01:39', 27, 8, 0),
(32, 'Oh no', '2023-03-19 22:10:29', 6, 7, 0),
(33, 'That sucks', '2023-03-19 22:10:37', 6, 7, 0),
(34, 'Look in the sky!', '2023-03-19 22:10:49', 6, 7, 0),
(35, 'Great dog', '2023-03-19 22:17:01', 6, 5, 2),
(36, 'shaken espresso!', '2023-03-20 04:17:31', 6, 9, 0),
(37, 'nice', '2023-03-20 06:41:46', 6, 6, 1),
(42, 'yes', '2023-03-21 22:02:27', 2, 12, 0),
(43, 'yeehh', '2023-03-22 20:34:46', 2, 12, 0),
(44, 'hello', '2023-03-23 01:29:38', 2, 7, 0),
(45, 'me too', '2023-03-23 02:04:26', 2, 5, -1),
(46, 'yeh', '2023-03-23 02:06:55', 2, 5, 0),
(47, 'Have you tried Bright Jenny? it is one of the best in kelowna :)', '2023-03-26 06:04:52', 27, 15, 0),
(48, 'the dark roast is so good ', '2023-03-26 06:05:31', 27, 15, 0),
(49, 'No.Whooping crane', '2023-03-26 06:06:27', 27, 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE IF NOT EXISTS `communities` (
  `community_id` int(11) NOT NULL,
  `community_name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`community_id`, `community_name`, `description`) VALUES
(0, 'Hyundai', 'Community for hyundai drivers'),
(1, 'birds', 'community fo rbird lovers'),
(2, 'ferrari', 'Community for ferrari enthusiasts'),
(3, 'dog', 'community for dog lovers'),
(4, 'Coffee', 'Community about coffee'),
(5, 'Sports', 'Community for everything sports related');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(5) NOT NULL,
  `community_id` int(5) NOT NULL,
  `title` varchar(40) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `content`, `created_at`, `created_by`, `community_id`, `title`, `score`) VALUES
(5, 'This is my dog', '2023-03-19 05:00:14', 6, 3, 'I love dogs', 2),
(6, 'My new ferrari', '2023-03-19 05:00:26', 6, 2, 'Vroom', 2),
(8, 'yesss', '2023-03-19 06:32:52', 6, 3, 'Collie dogs are the best', 0),
(9, 'What are the best?', '2023-03-20 03:16:34', 6, 4, 'Best starbucks drinks', 1),
(15, 'yeh', '2023-03-21 06:03:10', 2, 4, 'I like coffee', 0),
(20, 'I cant decide. There are so many great options to choose from. Ferrari continue to innovate and excel in the supercar field', '2023-03-23 00:51:19', 2, 2, 'What is your favourite ferrari', 0),
(21, 'I think it is a pelican', '2023-03-26 05:46:20', 26, 1, 'What is the coolest bird?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `profile` blob NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`, `isAdmin`, `profile`) VALUES
(2, 'joss', 'joss@gmail.com', 'Test1234', '2023-03-14 23:14:23', 0, ''),
(4, 'cat', 'cat@gmail.com', '$2y$10$UwHjRTdWv8pWS', '2023-03-14 23:45:25', 0, ''),
(6, 'test', 'test@hotmail.com', '$2y$10$Rq8wHun5YmP.f', '2023-03-14 23:48:57', 0, ''),
(17, 'aryan1', 'a@gmail.com', '$2y$10$mMnfWpQdY4JqQ', '2023-03-15 21:49:52', 0, ''),
(18, 'test6', 't@gmail.com', '$2y$10$/ZGh5Re3l37pE', '2023-03-15 22:04:11', 0, ''),
(19, 'aaa', 'aaa@ma.com', '111111', '2023-03-15 22:22:29', 0, ''),
(20, 'aaa', 'aaa@ma.com', '111111', '2023-03-16 01:17:47', 0, ''),
(21, 't', 't@gmail.com', 'Test1234', '2023-03-16 19:42:44', 0, ''),
(22, 't', 't@gmail.com', 'Test1234', '2023-03-16 19:43:57', 0, ''),
(23, 't2', 't2@gmail.com', 'Test1234', '2023-03-16 19:44:23', 0, ''),
(24, 't6', 't@gmail.com', 'Test1234', '2023-03-16 19:50:58', 0, ''),
(25, 'b', 'b@gmail.com', '$2y$10$DQzvY7HqwsN69', '2023-03-16 22:15:22', 0, ''),
(26, 'joss24', 'jossw7@gmail.com', '$2y$10$8cXLpfKzI2vWky7DsIAOtOVWtbdAIIJXLT3kDmGxC/47HME0mTfK6', '2023-03-26 05:45:08', 1, ''),
(27, 'millybibs', 'm.bibs@mail.com', '$2y$10$XC22KqEQyYkCYAY2tidxrupQCRWDXCnYlPEkhuONZu.IMcXzNBV6K', '2023-03-26 05:52:41', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_community`
--

CREATE TABLE IF NOT EXISTS `user_community` (
  `user_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_community`
--

INSERT INTO `user_community` (`user_id`, `community_id`, `join_date`) VALUES
(2, 2, '2023-03-23 20:35:37'),
(2, 3, '2023-03-23 20:42:18'),
(2, 0, '2023-03-23 20:42:59'),
(2, 5, '2023-03-23 20:43:08'),
(2, 4, '2023-03-23 20:43:16'),
(2, 1, '2023-03-23 20:43:20'),
(24, 0, '2023-03-23 20:44:07'),
(24, 4, '2023-03-23 20:44:11'),
(21, 4, '2023-03-23 20:44:40'),
(26, 2, '2023-03-26 05:45:34'),
(26, 4, '2023-03-26 05:45:41'),
(27, 1, '2023-03-26 05:54:56'),
(27, 4, '2023-03-26 05:55:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `created_by FK to user_id (USERS TABLE)` (`created_by`),
  ADD KEY `post_id` (`post_id`);

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
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
