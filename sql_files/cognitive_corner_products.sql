-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 12:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cognitive_corner_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'Emojify IT!', 'Cards with emojis that represent phrases, movies, or words. Players guess the meaning.', 500.00, 'image/game1.jpg', 'Cards'),
(2, 'Equation Blitz', 'Cards with random numbers and operations. Players solve equations the fastest.', 549.00, 'image/game2.jpg', 'Cards'),
(3, 'Lexicon Crafter', 'Cards with syllables or letters. Combine them to form the longest word possible.', 499.00, 'image/game3A.jpg', 'Cards'),
(4, 'Maze Mastery', 'A dynamic grid filled with paths and obstacles, where players must strategically navigate using logical moves to reach their goal.', 599.00, 'image/game4.jpg', 'Board Games'),
(5, 'Twist Tells', 'Players move across the board, drawing prompt cards to build a collaborative story filled with surprises and turns.', 699.00, 'image/game5.jpg', 'Board Games'),
(6, 'Pathogen Panic', 'Spread or stop a deadly virus in this fast-paced board game, where every decision you make determines the fate of humanity.', 799.00, 'image/game6.jpg', 'Board Games'),
(7, 'Jigsaw (Car Edition)', 'A +140 piece puzzle showcasing a collection of iconic classic cars.', 599.00, 'image/game7.jpg', 'Puzzles'),
(8, 'Jigsaw (Cartoon Edition)', 'A +140 piece puzzle showcasing a collection of iconic classic cartoons of childhood.', 649.00, 'image/game8.jpg', 'Puzzles'),
(9, 'Jigsaw (Space Edition)', 'A +140 piece puzzle showcasing a collection of cosmic bodies.', 549.00, 'image/game9.jpg', 'Puzzles');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
