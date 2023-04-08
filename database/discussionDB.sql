-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 06:51 AM
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
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `email`, `code`, `expire`) VALUES
(0, 'yoo@gmail.com', '19786', 1680921905),
(0, 'yoo@gmail.com', '50322', 1680922048),
(0, 'yoo@gmail.com', '61444', 1680922154);

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
(42, 'yes', '2023-03-21 22:02:27', 2, 12, 0),
(43, 'yeehh', '2023-03-22 20:34:46', 2, 12, 0),
(44, 'hello', '2023-03-23 01:29:38', 2, 7, 0),
(47, '33e', '2023-03-25 02:24:37', 2, 15, 0),
(48, 'yeah', '2023-03-26 06:59:39', 28, 19, 2),
(49, 'the new one', '2023-03-26 07:01:59', 28, 20, 0),
(50, 'nice', '2023-04-06 07:54:20', 33, 19, 0),
(51, 'wow', '2023-04-06 09:56:44', 28, 30, 0),
(52, 'nice', '2023-04-06 09:56:48', 28, 30, 0),
(53, 'true', '2023-04-06 09:56:51', 28, 30, 0),
(54, 'yep', '2023-04-06 09:56:53', 28, 30, 0),
(55, 'oh yeah', '2023-04-06 10:00:02', 28, 28, 1),
(56, 'nice', '2023-04-06 10:00:06', 28, 28, 0),
(57, 'cheese', '2023-04-06 10:00:11', 28, 28, 0),
(58, 'ye', '2023-04-06 10:11:45', 28, 28, 0),
(59, 'i agree', '2023-04-06 10:11:57', 28, 29, 0),
(60, 'Oh no', '2023-04-06 10:12:01', 28, 29, 0),
(61, 'ye', '2023-04-06 10:12:05', 28, 29, 0),
(62, 'no', '2023-04-08 02:16:33', 34, 15, 2),
(63, 'he likes bruce', '2023-04-08 03:10:11', 34, 32, -1);

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
(5, 'Sports', 'Community for everything sports related'),
(6, 'Plants', 'Plant lovers unite'),
(7, 'Dragons', 'dragons wooo'),
(8, 'Computer Science', 'For computer people'),
(9, 'Cats', 'for the cat lovers'),
(10, 'akash ', 'likes harsh'),
(11, 'chickens', 'best chickens'),
(12, 'chickens', 'best chickens'),
(13, 'kelowna', 'best city?'),
(14, 'Gaming', 'games');

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
  `score` int(11) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `content`, `created_at`, `created_by`, `community_id`, `title`, `score`, `image`) VALUES
(15, 'yeh', '2023-03-20 23:03:10', 2, 4, 'I like coffee', 19, ''),
(19, 'dogsss', '2023-03-22 17:50:18', 2, 3, 'h ah aha', 7, ''),
(20, 'I cant decide. There are so many great options to choose from. Ferrari continue to innovate and excel in the supercar field', '2023-03-22 17:51:19', 2, 2, 'What is your favourite ferrari', 3, ''),
(21, 'Which is better', '2023-03-25 22:04:29', 28, 3, 'Dogs vs Cats', -1, ''),
(22, 'Who should buy man utd?', '2023-03-25 22:07:23', 28, 5, 'Man Utd', 1, ''),
(23, 'I think it is the whooping crane', '2023-03-25 22:09:56', 28, 1, 'What is the coolest bird?', 0, ''),
(24, 'Not a fan', '2023-04-05 22:14:05', 33, 3, 'Collie dogs are the worst', 0, ''),
(25, 'Barking dog', '2023-04-05 22:54:52', 33, 3, 'woof woof', 1, ''),
(28, 'please work', '2023-04-06 00:38:16', 33, 9, 'MY CAT', 4, 0x6361742e6a7067),
(29, 'it is', '2023-04-06 00:48:16', 28, 5, 'Soccer best sport', 0, ''),
(30, 'Seaguls like it here', '2023-04-06 00:48:43', 28, 1, 'Vancouver', 0, 0x76616e30312e6a706567),
(31, 'best website logo ever', '2023-04-06 15:15:08', 34, 8, 'This is the website logo', 0, 0x6c6f676f2e6a7067),
(32, 'yeehaw i like dogs', '2023-04-07 18:09:48', 34, 10, 'akash likes dogs', 0, ''),
(33, 'in kelowna?', '2023-04-07 18:13:44', 34, 3, 'dog food', 0, ''),
(34, 'yeehaw downtown kelowna', '2023-04-07 19:12:40', 34, 13, 'I think kelowna is the best', 0, ''),
(35, '', '2023-04-07 21:41:49', 34, 5, 'Best ball player is lebron', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `profile` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`, `isAdmin`, `profile`) VALUES
(1, 'arnold', 'arnold@gmail.com', '$2y$10$MOq2dRwWHnxMB', '2023-03-14 23:13:56', 0, ''),
(2, 'joss', 'joss@gmail.com', 'Test1234', '2023-03-14 23:14:23', 1, ''),
(4, 'cat', 'cat@gmail.com', '$2y$10$UwHjRTdWv8pWS', '2023-03-14 23:45:25', 0, ''),
(10, 'sam', 'sam@gmail.com', '$2y$10$5X6S5q6s2UqMw', '2023-03-15 01:09:02', 0, ''),
(13, 'jossw', 'jossw@gmail.com', '$2y$10$QdorxrovAnIrg', '2023-03-15 06:28:21', 0, ''),
(15, 'test5', 'test5@gmail.com', '$2y$10$mxd.5SbzmvYxv', '2023-03-15 21:25:08', 0, ''),
(18, 'test6', 't@gmail.com', '$2y$10$/ZGh5Re3l37pE', '2023-03-15 22:04:11', 0, ''),
(19, 'aaa', 'aaa@ma.com', '111111', '2023-03-15 22:22:29', 0, ''),
(20, 'aaa', 'aaa@ma.com', '111111', '2023-03-16 01:17:47', 0, ''),
(21, 't', 't@gmail.com', 'Test1234', '2023-03-16 19:42:44', 0, ''),
(22, 't', 't@gmail.com', 'Test1234', '2023-03-16 19:43:57', 0, ''),
(23, 't2', 't2@gmail.com', 'Test1234', '2023-03-16 19:44:23', 0, ''),
(24, 't6', 't@gmail.com', 'Test1234', '2023-03-16 19:50:58', 0, ''),
(25, 'b', 'b@gmail.com', '$2y$10$DQzvY7HqwsN69', '2023-03-16 22:15:22', 0, ''),
(26, 'jake', 'jake@gmail.com', '$2y$10$4GtQcZRFcTuDL', '2023-03-25 22:05:51', 0, ''),
(27, 'ben', 'ben@gmail.com', '$2y$10$es4EmGYaJDgIYf2cY.4Sn.Vk12DhLNVKwfxJ2pswr2nVdn3ZqYxja', '2023-03-25 22:17:08', 0, ''),
(28, 'joss24', 'jossw7@gmail.com', '$2y$10$7pzjA3ltVgGfgfbnRqJgkeSvz607dkOMPhYrTYsQ6KjZutvd9syu2', '2023-03-25 22:24:46', 1, ''),
(29, 'joss999', 'jo@gmail.com', '$2y$10$zdGDLK7VwlQUJk33FY2fFutkpLSnPF9m/PwuEo6AugQevWCfdWT9m', '2023-03-26 17:34:22', 0, ''),
(30, 'karl', 'karl@gmail.com', '$2y$10$Q1TjU6tLyYYrEkN6btvow.oAQ5vrADQj2XjzP/4lBJv13qtAeYjdm', '2023-03-26 17:39:35', 0, ''),
(31, 'jenk', 'jenk@gmail.com', '$2y$10$e/zqg3/6mIxbQJ2bD3pWB.sUNCxQQSHLANZdVDekuaAZeZojKmZyW', '2023-03-26 18:38:41', 0, 0x674a6f6c7a6b592e6a7067),
(32, 'arnold1', 'a1@gmail.com', '$2y$10$NZLGsrTghhfgUPBH36akOeXmLuM.iFfoptPV0CdbNIfixKuepy99G', '2023-03-27 04:39:40', 0, 0x76616e30312e6a706567),
(33, 'red', 'red@gmail.com', '$2y$10$qvSYZag3QrNsIsGhM0wpDecXGZpAXsO5WIBSqdfFa5w49DtW0beca', '2023-03-27 05:30:24', 0, 0x6361742e6a7067),
(34, 'rainy2', 'yoo@gmail.com', '$2y$10$hZuni9j.dcBkANYB8G1pV.41ad1DByNoMEtCGMTiNMhedjYbRDLfG', '2023-04-06 22:12:59', 1, 0x696d6167652e6a7067);

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
(21, 3, '2023-03-21 18:00:48'),
(28, 5, '2023-03-25 22:11:48'),
(32, 6, '2023-03-26 22:10:54'),
(33, 1, '2023-04-05 22:57:03'),
(33, 3, '2023-04-05 22:59:32'),
(33, 7, '2023-04-05 23:00:54'),
(28, 1, '2023-04-06 10:08:16'),
(34, 1, '2023-04-07 21:23:58'),
(34, 4, '2023-04-07 21:37:57');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `community_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
