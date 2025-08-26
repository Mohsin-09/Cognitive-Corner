-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 12:46 PM
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
-- Database: `cognitive_corner_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `cognitive_corner_orders`
--

CREATE TABLE `cognitive_corner_orders` (
  `id` int(11) NOT NULL,
  `order_number` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment_method` enum('COD') NOT NULL DEFAULT 'COD',
  `total_price` decimal(10,2) NOT NULL,
  `order_status` enum('Pending','Shipped','Delivered','Cancelled') NOT NULL DEFAULT 'Pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cognitive_corner_orders`
--

INSERT INTO `cognitive_corner_orders` (`id`, `order_number`, `user_id`, `name`, `address`, `phone`, `payment_method`, `total_price`, `order_status`, `order_date`) VALUES
(11, 281333, 102, 'Muhammed Mohsin', 'sharah e faisal fb area block 6\r\nflat no 202', '03152801587', 'COD', 3545.00, 'Pending', '2025-03-16 15:36:54'),
(12, 918308, 102, 'Muhammed Mohsin', 'sharah e faisal fb area block 6\r\nflat no 202', '03152801587', 'COD', 1048.00, 'Pending', '2025-03-16 15:40:39'),
(13, 776853, 102, 'Muhammed Mohsin', 'sharah e faisal fb area block 6\r\nflat no 202', '03152801587', 'COD', 1048.00, 'Pending', '2025-03-16 16:44:40'),
(14, 486866, 103, 'Muhammed Mohsin', 'sharah e faisal fb area block 6\r\nflat no 202', '03152801587', 'COD', 549.00, 'Pending', '2025-03-17 12:48:23'),
(15, 860303, 103, 'Muhammed Mohsin', 'fb area block 6\r\nfalak galaxy flat no 202', '03152801587', 'COD', 5442.00, 'Pending', '2025-03-20 09:17:41'),
(16, 119018, 103, 'Muhammed Mohsin', 'fb area block 6\r\nfalak galaxy flat no 1202', '03152801587', 'COD', 5988.00, 'Pending', '2025-03-20 09:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `cognitive_corner_order_items`
--

CREATE TABLE `cognitive_corner_order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(50) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cognitive_corner_order_items`
--

INSERT INTO `cognitive_corner_order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(15, 11, 1, 1, 500.00),
(16, 11, 2, 1, 549.00),
(17, 11, 3, 1, 499.00),
(18, 11, 6, 1, 799.00),
(19, 11, 8, 1, 649.00),
(20, 11, 9, 1, 549.00),
(21, 12, 2, 1, 549.00),
(22, 12, 3, 1, 499.00),
(23, 13, 2, 1, 549.00),
(24, 13, 3, 1, 499.00),
(25, 486866, 2, 1, 549.00),
(26, 15, 1, 1, 500.00),
(27, 15, 2, 1, 549.00),
(28, 15, 3, 1, 499.00),
(29, 15, 4, 1, 599.00),
(30, 15, 5, 1, 699.00),
(31, 15, 6, 1, 799.00),
(32, 15, 7, 1, 599.00),
(33, 15, 8, 1, 649.00),
(34, 15, 9, 1, 549.00),
(35, 16, 3, 12, 499.00);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date_created`) VALUES
(102, 'crist beast', 'muhammedmukarram10@gmail.com', '$2y$10$HnEgAbqeaFN/xQoHRYCWnORz5wxre.ey6idEsMn6oaxGQlUqjeG8S', '2025-03-06 14:18:37'),
(103, 'Mohsin', 'm.mohsind3v3loper@gmail.com', '$2y$10$3Y9YbE25ZdefoT6XLI48EuT892.8YfkEBUQTPk6rwMRpurSsPvWue', '2025-03-17 12:47:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cognitive_corner_orders`
--
ALTER TABLE `cognitive_corner_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cognitive_corner_order_items`
--
ALTER TABLE `cognitive_corner_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cognitive_corner_orders`
--
ALTER TABLE `cognitive_corner_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cognitive_corner_order_items`
--
ALTER TABLE `cognitive_corner_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cognitive_corner_orders`
--
ALTER TABLE `cognitive_corner_orders`
  ADD CONSTRAINT `cognitive_corner_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cognitive_corner_order_items`
--
ALTER TABLE `cognitive_corner_order_items`
  ADD CONSTRAINT `cognitive_corner_order_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
