-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2024 at 03:01 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car rental systme`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_name` varchar(50) NOT NULL,
  `car_model` varchar(50) NOT NULL,
  `car_year` int(11) DEFAULT NULL,
  `costPerDay` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `status` enum('available','rented') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_name`, `car_model`, `car_year`, `costPerDay`, `image_path`, `status`) VALUES
(1, 'BMW X5', 'X Series', 2021, '150$', 'images/car-images/BMW X5.avif', 'available'),
(2, 'BMW 3 Series', '3 Series', 2022, '120$', 'images/car-images/BMW 3 Series.jpg', 'available'),
(3, 'BMW 7 Series', '7 Series', 2023, '200$', 'images/car-images/BMW 7-series.jpg', 'available'),
(4, 'Mercedes-Benz E-Class', 'E350', 2022, '$120', 'images/car-images/Mercedes-Benz E-Class.jpg', 'available'),
(5, 'Mercedes-Benz GLC', 'GLC 300', 2021, '$110', 'images/car-images/Mercedes-Benz GLC.jpg', 'available'),
(6, 'Mercedes-Benz S-Class', 'S550', 2023, '$150', 'images/car-images/Mercedes-Benz S-Class.jpeg', 'available'),
(7, 'Toyota Camry', 'XLE', 2022, '$100', 'images/car-images/Toyota Camry.avif', 'available'),
(8, 'Ford Mustang', 'GT Premium', 2021, '$130', 'images/car-images/Ford Mustang.webp', 'available'),
(9, 'Audi A4', 'Premium Plus', 2023, '$140', 'images/car-images/Audi A4.jpeg', 'available'),
(10, 'Chevrolet Camaro', 'SS', 2022, '$180', 'images/car-images/Chevrolet Camaro.jpeg', 'available'),
(11, 'Nissan Altima', 'SL', 2023, '$110', 'images/car-images/Nissan Altima.jpeg', 'available'),
(12, 'Honda Accord', 'Touring 2.0T', 2021, '$120', 'images/car-images/Honda Accord.jpeg', 'available'),
(13, 'Volkswagen Golf', 'GTI', 2022, '$130', 'images/car-images/Volkswagen Golf.webp', 'available'),
(14, 'Jeep Wrangler', 'Sahara', 2023, '$150', 'images/car-images/Jeep Wrangler.jpeg', 'available'),
(15, 'Hyundai Sonata', 'Limited', 2022, '$100', 'images/car-images/Hyundai Sonata.jpeg', 'available'),
(16, 'Audi A6', 'A6', 2022, '$130', 'images/car-images/Audi A6.jpeg', 'available'),
(17, 'Ford Escape', 'Escape', 2021, '$115', 'images/car-images/Ford Escape.jpeg', 'available'),
(18, 'Honda CR-V', 'CR-V', 2023, '$110', 'images/car-images/Honda CR-V.jpeg', 'available'),
(19, 'Chevrolet Corvette', 'Corvette', 2022, '$180', 'images/car-images/Chevrolet Corvette.jpg', 'available'),
(20, 'Chevrolet Equinox', 'Equinox', 2021, '$120', 'images/car-images/Chevrolet Equinox.avif', 'available'),
(21, 'Nissan Rogue', 'Rogue', 2022, '$110', 'images/car-images/Nissan Rogue.jpg', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userID` varchar(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `has_rented` tinyint(1) DEFAULT '0',
  `rented_car_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO users (id, userID, username, first_name, last_name, email, password, admin, has_rented, rented_car_id) VALUES
(2, '134678245901', 'samantharay', 'Samantha', 'Ray', 'samantha.ray@example.com', 'pass456', 0, 0, NULL),
(3, '894561237980', 'davidsmith', 'David', 'Smith', 'david.smith@example.com', 'pass789', 0, 0, NULL),
(4, '543210987654', 'mariagarcia', 'Maria', 'Garcia', 'maria.garcia@example.com', 'pass101', 0, 0, NULL),
(5, '876543210987', 'robertlee', 'Robert', 'Lee', 'robert.lee@example.com', 'pass111', 0, 0, NULL),
(6, '234567890123', 'emilyjones', 'Emily', 'Jones', 'emily.jones@example.com', 'pass222', 0, 0, NULL),
(7, '345678901234', 'johndoe', 'John', 'Doe', 'john.doe@example.com', 'pass333', 0, 0, NULL),
(8, '456789012345', 'janelopez', 'Jane', 'Lopez', 'jane.lopez@example.com', 'pass444', 0, 0, NULL),
(9, '567890123456', 'michaelking', 'Michael', 'King', 'michael.king@example.com', 'pass555', 0, 0, NULL),
(10, '678901234567', 'lisawong', 'Lisa', 'Wong', 'lisa.wong@example.com', 'pass666', 0, 0, NULL),
(11, '789012345678', 'jamesdean', 'James', 'Dean', 'james.dean@example.com', 'pass777', 0, 0, NULL),
(12, '890123456789', 'sarahhill', 'Sarah', 'Hill', 'sarah.hill@example.com', 'pass888', 0, 0, NULL),
(13, '901234567890', 'brianmoss', 'Brian', 'Moss', 'brian.moss@example.com', 'pass999', 0, 0, NULL),
(14, '012345678901', 'aliceford', 'Alice', 'Ford', 'alice.ford@example.com', 'pass000', 0, 0, NULL),
(15, '123456789012', 'tomclark', 'Tom', 'Clark', 'tom.clark@example.com', 'pass123', 0, 0, NULL),
(16, '234567890123', 'nancyrogers', 'Nancy', 'Rogers', 'nancy.rogers@example.com', 'pass234', 0, 0, NULL),
(17, '345678901234', 'kevinbrown', 'Kevin', 'Brown', 'kevin.brown@example.com', 'pass345', 0, 0, NULL), 
(18, '456789012345', 'charlottemiller', 'Charlotte', 'Miller', 'charlotte.miller@example.com', 'pass456', 0, 0, NULL),
(19, '567890123456', 'larrymoore', 'Larry', 'Moore', 'larry.moore@example.com', 'pass567', 0, 0, NULL),
(20, '678901234567', 'juliewilson', 'Julie', 'Wilson', 'julie.wilson@example.com', 'pass678', 0, 0, NULL),
(21, '789012345678', 'garydavis', 'Gary', 'Davis', 'gary.davis@example.com', 'pass789', 0, 0, NULL); 

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rented_car_id` (`rented_car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rented_car_id`) REFERENCES `cars` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
