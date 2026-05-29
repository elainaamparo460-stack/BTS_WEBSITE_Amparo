-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2026 at 06:36 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bts_website_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `release_year` year(4) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `spotify_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `title`, `release_year`, `cover_image`, `spotify_link`, `created_at`) VALUES
(7, 'DARK & WILD', 2014, '1779993955_8543.jpg', 'https://open.spotify.com/album/5W1XY5ucNATjTULERvXx9j?si=-KNmni7OQT63OuNB7XkkRQ', '2026-05-28 18:45:55'),
(8, 'WINGS', 2016, '1779994001_1286.webp', 'https://open.spotify.com/album/6al2VdKbb6FIz9d7lU7WRB?si=DpmTRcgXSVG0Onu8hv1fiw', '2026-05-28 18:46:41'),
(9, 'SKOOL LUV AFFAIR', 2014, '1779994036_7640.jpg', 'https://open.spotify.com/album/43wFM1HquliY3iwKWzPN4y?si=r_6jHGlJT56euMVOAE7JEQ', '2026-05-28 18:47:16'),
(10, 'LOVE YOURSELF 結 ‘Answer’', 2018, '1779994100_6957.jpg', 'https://open.spotify.com/track/3XYRV7ZSHqIRDG87DKTtry?si=522a1b3a850043b7', '2026-05-28 18:48:20'),
(11, 'MAP OF THE SOUL : PERSONA', 2019, '1779994295_4932.jpg', 'https://open.spotify.com/album/7cvsViO3Tg4w5ixs5Aq7mS?si=IK0O_WobRESbjW3i3pbvAQ', '2026-05-28 18:51:35'),
(12, 'YOU NEVER WALK ALONE', 2017, '1779994341_8638.png', 'https://open.spotify.com/track/1hciAV5LrrTkRV0g0StZ6h?si=abc6bd9cb401495c', '2026-05-28 18:52:21'),
(13, 'WINGS', 2016, '1779994371_8351.jpg', 'https://open.spotify.com/track/5IAESfJjmOYu7cHyX557kz?si=90429da4d7804d88', '2026-05-28 18:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `stage_name` varchar(100) NOT NULL,
  `real_name` varchar(150) NOT NULL,
  `position` varchar(100) NOT NULL,
  `birthday` date DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `stage_name`, `real_name`, `position`, `birthday`, `image`, `created_at`) VALUES
(1, 'RM', 'Kim Namjoon', 'Leader, Rapper', '1994-09-12', '1779810455_1779809573_BTS_RM_PTD_On_Stage_Live_29.jpg', '2026-05-26 15:45:32'),
(2, 'Jin', 'Kim Seokjin', 'Vocalist', '1992-12-04', '1779810467_1779809792_BTS_Jin_PTD_On_Stage_Live_29.jpg', '2026-05-26 15:45:32'),
(3, 'SUGA', 'Min Yoongi', 'Rapper', '1993-03-09', '1779810504_1779809846_BTS_Suga_PTD_On_Stage_Live_29.jpg', '2026-05-26 15:45:32'),
(4, 'J-Hope', 'Jung Hoseok', 'Rapper, Dancer', '1994-02-18', '1779810524_BTS_J-hope_PTD_On_Stage_Live_29.jpg', '2026-05-26 15:45:32'),
(5, 'Jimin', 'Park Jimin', 'Vocalist, Dancer', '1995-10-13', '1779810536_BTS_Jimin_PTD_On_Stage_Live_29.jpg', '2026-05-26 15:45:32'),
(6, 'V', 'Kim Taehyung', 'Vocalist', '1995-12-30', '1779810550_BTS_V_PTD_On_Stage_Live_29.jpg', '2026-05-26 15:45:32'),
(7, 'Jungkook', 'Jeon Jungkook', 'Main Vocalist, Dancer', '1997-09-01', '1779810558_BTS_Jungkook_PTD_On_Stage_Live_29.jpg', '2026-05-26 15:45:32'),
(12, 'ELAI', 'ela', 'Leader / Rapper', '2026-05-20', '1779952918_9298.jpg', '2026-05-28 03:27:10'),
(13, 'ANEL', 'JANELLE AGUILO', 'Vocalist', '2026-05-13', '1779952465_7750.jpg', '2026-05-28 07:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `member_album`
--

CREATE TABLE `member_album` (
  `album_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_album`
--

INSERT INTO `member_album` (`album_id`, `image`, `created_at`) VALUES
(5, '1779996113_3723.jpg', '2026-05-28 19:21:53'),
(6, '1779996469_3302.jpg', '2026-05-28 19:27:49'),
(7, '1779996476_2155.jpg', '2026-05-28 19:27:56'),
(8, '1779996484_5199.jpg', '2026-05-28 19:28:04'),
(9, '1779996512_1172.jpg', '2026-05-28 19:28:32'),
(10, '1779996517_8769.jpg', '2026-05-28 19:28:37'),
(11, '1779996545_7277.jpg', '2026-05-28 19:29:05'),
(12, '1780000783_2384.jpg', '2026-05-28 20:39:43'),
(13, '1780000797_4468.png', '2026-05-28 20:39:57'),
(14, '1780000824_9793.jpg', '2026-05-28 20:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `tinytan`
--

CREATE TABLE `tinytan` (
  `id` int(11) NOT NULL,
  `character_name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '''default.png''',
  `description` varchar(255) NOT NULL DEFAULT 'TinyTAN Character'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tinytan`
--

INSERT INTO `tinytan` (`id`, `character_name`, `image`, `description`) VALUES
(5, 'RM', '1779951884_9893.png', 'UNBREAKABLE CUTENESS'),
(6, 'JIN', '1779951906_3319.png', 'WORLDWIDE CUTIE'),
(7, 'ANEL', '1779951959_5378.png', 'MOST CUTE'),
(8, 'SUGA', '1779952004_4373.png', 'SWEETIE SWAGGER'),
(9, 'J-HOPE', '1779952034_8774.png', 'LITTLE HOPE'),
(10, 'JIMIN', '1779952055_7815.png', 'LOVELY LITTLE ONE'),
(11, 'V', '1779952073_9396.png', 'PRECIOUS SOUL'),
(12, 'JK', '1779952092_2455.png', 'GOLDEN MAKNAE'),
(14, 'elai', '1779989211_3854.jpg', 'Worldwide Cutie');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `mname`) VALUES
(3, 'elai_ash', '$2y$10$.SYExLK4sSzuEYTCd3awdOUw2BrFKIIzvb9XBRHpjbIrBtx8w86ge', 'Elaina', 'Amparo', 'Hermosa'),
(4, 'mamad143', '$2y$10$7JTrc.8.tPFYdkIEe52bQ.m1P5D/39s.zzl32coL0V9eHQOCKgQ22', 'Mohammed', 'Bamba', '');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `year` varchar(50) NOT NULL,
  `youtube_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `category`, `year`, `youtube_url`) VALUES
(12, 'Life Goes On Forest', 'OFFICIAL MV', '2020', 'https://youtu.be/RvcP6V4h_q4?si=JrOp3q0hHtpvm5vx'),
(13, 'Butter MV', 'OFFICIAL MV', '2021', 'https://youtu.be/WMweEpGlu_U?si=0-p_P6KbVEEfqsOh'),
(14, 'LIVE STAGE', 'LIVE STAGE', '2020', 'https://youtu.be/HbkBVxU5K5A?si=xRrgv0xYawO7D8oW'),
(15, 'Birthday Party', 'EPISODE', '2014', 'https://youtu.be/RhJqNFQCU_Q?si=waHWIHJ4rBwSUdgm'),
(16, 'INTERVIEW', 'INTERVIEW', '2021', 'https://youtu.be/qsobCAGiuRU?si=BdgpbJ_JjGlsVj_d'),
(17, 'BTS 2.0', 'OFFICIAL MV', '2026', 'https://youtu.be/_gyultVTesk?si=TmHreT_Ilqqjp670'),
(18, 'EPISODE', 'EPISODE', '2023', 'https://youtu.be/0Dc6tHgXp88?si=0wbwZZ7e2P7fuqi9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_album`
--
ALTER TABLE `member_album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `tinytan`
--
ALTER TABLE `tinytan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `member_album`
--
ALTER TABLE `member_album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tinytan`
--
ALTER TABLE `tinytan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
