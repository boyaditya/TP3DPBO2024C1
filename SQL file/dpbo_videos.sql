-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 05:14 AM
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
-- Database: `dpbo_videos`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'United States'),
(2, 'Indonesia'),
(4, 'South Korea'),
(5, 'Japan'),
(8, 'United Kingdom');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(1, 'Actions'),
(2, 'Adventure'),
(4, 'Anime'),
(5, 'Drama'),
(6, 'Fantasy'),
(7, 'Science Fiction'),
(8, 'Crime'),
(9, 'Thriller'),
(10, 'Mystery'),
(11, 'Biography'),
(12, 'History'),
(13, 'Comedy'),
(14, 'Horror'),
(15, 'Animation'),
(19, 'Family');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movies_id` int(11) NOT NULL,
  `movies_title` varchar(255) NOT NULL,
  `movies_director` varchar(255) NOT NULL,
  `movies_cast` varchar(255) NOT NULL,
  `movies_duration` int(11) NOT NULL,
  `movies_released_year` year(4) NOT NULL,
  `movies_synopsis` text NOT NULL,
  `movies_genre` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `movies_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movies_id`, `movies_title`, `movies_director`, `movies_cast`, `movies_duration`, `movies_released_year`, `movies_synopsis`, `movies_genre`, `country_id`, `movies_image`) VALUES
(1, 'Avengers: Endgame', 'Anthony Russo, Joe Russo', 'Robert Downey Jr., Chris Evans, Mark Ruffalo', 181, '2019', 'After the devastating events of Avengers: Infinity War, the universe is in ruins due to the efforts of the Mad Titan, Thanos. With the help of remaining allies, the Avengers must assemble once more in order to undo Thanos’ actions and restore order to the universe once and for all, no matter what consequences may be in store.', 'Adventure, Drama', 1, '662c630d0e694.jpg'),
(6, 'Oppenheimer', 'Christopher Nolan', 'Cillian Murphy, Emily Blunt, Matt Damon', 181, '2023', 'The story of J. Robert Oppenheimer’s role in the development of the atomic bomb during World War II.', 'Drama, History', 1, '662c59a822087.jpg'),
(7, 'Parasite', 'Bong Joon Ho', 'Song Kang-ho, Lee Sun-kyun, Cho Yeo-jeong', 132, '2019', 'All unemployed, Ki-taek’s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.', 'Drama, Thriller, Comedy', 4, '662c59ea5c330.jpg'),
(8, 'The Conjuring', 'James Wan', 'Patrick Wilson, Vera Farmiga, Ron Livingston', 112, '2013', 'Paranormal investigators Ed and Lorraine Warren work to help a family terrorized by a dark presence in their farmhouse. Forced to confront a powerful entity, the Warrens find themselves caught in the most terrifying case of their lives.', 'Thriller, Horror', 1, '662c5a5986ddd.jpg'),
(9, 'Suzume', 'Makoto Shinkai', 'Nanoka Hara, Hokuto Matsumura, Eri Fukatsu', 123, '2022', 'Suzume, 17, lost her mother as a little girl. On her way to school, she meets a mysterious young man. But her curiosity unleashes a calamity that endangers the entire population of Japan, and so Suzume embarks on a journey to set things right.', 'Adventure, Anime, Drama, Fantasy, Animation', 5, '662c5a74aa142.jpg'),
(11, 'Interstellar', 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 169, '2014', 'Interstellar chronicles the adventures of a group of explorers who make use of a newly discovered wormhole to surpass the limitations on human space travel and conquer the vast distances involved in an interstellar voyage.', 'Adventure, Drama, Science Fiction', 1, '662c5a932d93c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `series_id` int(11) NOT NULL,
  `series_title` varchar(255) NOT NULL,
  `series_creator` varchar(255) NOT NULL,
  `series_cast` varchar(255) NOT NULL,
  `series_seasons` int(11) NOT NULL,
  `series_episodes` int(11) NOT NULL,
  `series_average_duration` int(11) NOT NULL,
  `series_first_air_date` date NOT NULL,
  `series_last_air_date` date NOT NULL,
  `series_synopsis` text NOT NULL,
  `series_network` varchar(255) NOT NULL,
  `series_genre` varchar(255) NOT NULL,
  `series_image` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`series_id`, `series_title`, `series_creator`, `series_cast`, `series_seasons`, `series_episodes`, `series_average_duration`, `series_first_air_date`, `series_last_air_date`, `series_synopsis`, `series_network`, `series_genre`, `series_image`, `country_id`) VALUES
(1, 'Breaking Bad', 'Vince Gilligan', 'Bryan Cranston, Aaron Paul, Anna Gunn', 5, 62, 45, '2008-01-20', '2013-09-29', 'When Walter White, a New Mexico chemistry teacher, is diagnosed with Stage III cancer and given a prognosis of only two years left to live. He becomes filled with a sense of fearlessness and an unrelenting desire to secure his family’s financial future at any cost as he enters the dangerous world of drugs and crime.', 'AMC', 'Drama, Crime, Thriller', '662c5ab888f86.jpg', 1),
(7, 'The Last of Us', 'Neil Druckmann, Craig Mazin', 'Pedro Pascal, Bella Ramsey, Anna Torv', 1, 9, 59, '2023-01-15', '2023-03-05', 'Twenty years after modern civilization has been destroyed. Joel, a hardened survivor, is hired to smuggle Ellie, a 14-year-old girl, out of an oppressive quarantine zone. What starts as a small job soon becomes a brutal, heartbreaking journey, as they both must traverse the U.S. and depend on each other for survival.', 'HBO', 'Actions, Adventure, Drama, Fantasy, Science Fiction', '662c5ae77cf4a.jpg', 1),
(8, 'Alice in Borderland', 'Haro Aso', 'Kento Yamazaki, Tao Tsuchiya, Nijirô Murakami', 2, 16, 48, '2020-12-10', '2022-12-22', 'With his two friends, a video-game-obsessed young man finds himself in a strange version of Tokyo where they must compete in dangerous games to win.', 'Netflix', 'Actions, Adventure, Drama, Fantasy, Science Fiction, Mystery', '662c5b16f0417.jpg', 5),
(9, 'The Walking Dead', 'Frank Darabont', 'Andrew Lincoln, Norman Reedus, Melissa McBride', 11, 177, 42, '2010-10-31', '2022-10-22', 'Sheriff’s deputy Rick Grimes awakens from a coma to find a post-apocalyptic world dominated by flesh-eating zombies. He sets out to find his family and encounters many other survivors along the way.', 'AMC', 'Actions, Adventure, Drama, Fantasy, Science Fiction', '662c5b880fad9.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movies_id`) USING BTREE,
  ADD KEY `fk_movies_country` (`country_id`) USING BTREE;

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`series_id`),
  ADD KEY `fk_series_country` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `series_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `fk_movies_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `fk_series_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
