-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 09:13 PM
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
-- Database: `adventura`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(50) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(0, 'brenda@gmail.com', '$2y$10$7PWuFTtNjQV.gW.VdVFjmuC5RoEoNw54/kfJBuHkyRb', '2024-08-09 14:49:56', '2024-08-09 14:49:56'),
(0, 'joon@gmail.com', '$2y$10$45Hzvv6sUwCXxTBMc9qxneecPvERdt9pFQKwO3KtZO1', '2024-08-09 18:28:26', '2024-08-09 18:28:26'),
(0, 'christian@gmail.com', '$2y$10$ViDOFOp9/952gatMLzY/heGVsXBorBUOBJ6d4ZX9U10', '2024-08-09 21:35:29', '2024-08-09 21:35:29'),
(0, 'wanjiku@gmail.com', '$2y$10$jnF75PiUESrTnGX/mqJGpuhMwm0dgB4pakSnzaBfhj3', '2024-08-11 18:35:31', '2024-08-11 18:35:31'),
(0, 'jimin@gmail.com', '$2y$10$uTi4EDg40iU9IJ0DxWI37ufv1Qm/HNchH2tLJSE.lPS', '2024-08-11 19:05:19', '2024-08-11 19:05:19'),
(0, 'software@gmail.com', '$2y$10$E4LBjG0u4StfyP9jj5Nb4.ye.Ig.N/lZbuKLXJeR2dA', '2024-08-12 13:55:46', '2024-08-12 13:55:46'),
(0, 'suga@gmail.com', '$2y$10$3n/fxpmKpYjs2y4ZBSp2FOH0QavJgbQ5xtqUfceXTri', '2024-08-22 20:58:55', '2024-08-22 20:58:55'),
(0, 'curtain@gmail.com', '$2y$10$HDpHRP.NslPBPKaHv20Oje594XJgN5hcWqz3IjaGNYR', '2024-08-23 10:26:49', '2024-08-23 10:26:49'),
(0, 'university@gmail.com', '$2y$10$B7kq1G9r1sgrZ1MPfJKJf.s1PBPN4ck2046qdMG/7Qy', '2024-08-23 10:52:06', '2024-08-23 10:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `package_type` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `number_of_rooms` int(11) NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `confirmed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `userid`, `name`, `email`, `arrival_date`, `departure_date`, `package_type`, `room_type`, `number_of_rooms`, `total_price`, `created_at`, `updated_at`, `confirmed`) VALUES
(1, NULL, 'Wanjiku', 'wanjiku@gmail.com', '2024-08-12', '0000-00-00', '2', '2', 2, 0.00, '2024-08-11 17:42:23', '2024-08-11 17:42:23', 0),
(2, NULL, 'Brenda', 'brenda@gmail.com', '2024-08-21', '0000-00-00', '2', '3', 3, 0.00, '2024-08-11 17:46:09', '2024-08-11 17:46:09', 0),
(6, NULL, 'Chris Thuo', 'thuo@gmail.com', '2024-08-25', '0000-00-00', '2', '2', 2, 0.00, '2024-08-22 18:44:52', '2024-08-22 18:44:52', 0),
(7, NULL, 'Kim joon', 'joon@gmail.com', '2024-08-25', '0000-00-00', '3', '2', 3, 0.00, '2024-08-22 18:48:15', '2024-08-22 18:48:15', 0),
(9, NULL, 'Chris Thuo', 'thuo@gmail.com', '2024-08-26', '0000-00-00', '2', '2', 2, 0.00, '2024-08-22 20:04:19', '2024-08-22 20:04:19', 0),
(10, NULL, 'Chris Thuo', 'thuo@gmail.com', '2024-08-26', '0000-00-00', '2', '2', 2, 98000.00, '2024-08-22 20:16:57', '2024-08-22 20:16:57', 0),
(11, NULL, 'Kim Namjoon', 'namjoon@gmail.com', '2024-08-23', '0000-00-00', '6', '2', 5, 245000.00, '2024-08-22 20:18:21', '2024-08-22 20:18:21', 0),
(12, NULL, 'Julius', 'julius@gmail.com', '2024-08-26', '0000-00-00', '1', '1', 2, 79000.00, '2024-08-23 10:58:13', '2024-08-23 10:58:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `package_title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `inclusions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_title`, `description`, `price`, `image`, `created_at`, `updated_at`, `inclusions`) VALUES
(1, 'Wellness and Beach Fitness Package', 'Revitalize your mind, body, and soul with our Wellness and Beach Fitness Package.', 32000.00, 'wellness.jpg', '2024-08-10 23:20:10', '2024-08-10 23:42:43', 'Personal training sessions tailored to your fitness goals; Wellness and spa treatments for relaxation and rejuvenation; Healthy and nutritious cuisine options; Beach workouts and sports activities.'),
(2, 'Water Sports Adventure Package', 'Dive into a world of exhilarating aquatic thrills and adrenaline-pumping adventures with our Water Sports Adventure Package.', 40000.00, 'water-sports.jpg', '2024-08-10 23:20:10', '2024-08-10 23:20:10', 'Jet skiing on the crystal-clear waters; Snorkeling expeditions to discover colorful coral reefs; Stand-up paddleboarding for a fun and active water activity; Guided fishing trips to catch the big one.'),
(3, 'Relaxation and Leisure Package', 'Indulge in ultimate relaxation and leisure with our Relaxation and Leisure Package.', 30000.00, 'relaxation.jpg', '2024-08-10 23:20:10', '2024-08-10 23:20:10', 'Relaxation lounges with comfortable seating and breathtaking ocean view; Hot tubs for soothing hydrotherapy sessions; Access to spacious pools for refreshing dips; Tranquil gardens and outdoor spaces for leisurely strolls.'),
(4, 'Beach Party and Nightlife Package', 'Immerse yourself in the vibrant beachside atmosphere with access to beach clubs, bars, and entertainment venues, organized beach parties, sunset cocktails.', 30000.00, 'beach-party.jpg', '2024-08-10 23:20:10', '2024-08-10 23:20:10', 'Access to trendy beach clubs and bars; Sunset cocktail events with stunning ocean views; Access to beachside dining options and late-night snacks; Entrance to entertainment venues with live music and DJs.'),
(5, 'Family Beach Vacation Package', 'Create cherished family memories with our package designed for families seeking a beach holiday.', 35000.00, 'family-vacation.jpg', '2024-08-10 23:20:10', '2024-08-10 23:20:10', 'Accommodation options suitable for families; Beach games, sandcastle building competitions, and treasure hunts; Opportunity for family-friendly water sports and beach activities; Access to family-friendly dining options and menus; Special amenities for families, such as strollers or cribs.'),
(6, 'Romantic Beach Retreat Package', 'Indulge in a dreamy escape meticulously designed for couples.', 40000.00, 'romantic-retreat.jpg', '2024-08-10 23:20:10', '2024-08-10 23:20:10', 'Private beachfront accommodations or honeymoon suites; Candlelit dinners by the beach or private beachside picnics; Optional sunset cruises or yacht excursions; Intimate dining experiences with personalized service and exquisite cuisine.'),
(10, 'Maasai Mara', 'A relaxation point', -5000.00, 'https://dummyimage.com/300x200/000/fff', '2024-08-23 10:54:30', '2024-08-23 10:54:30', 'ertyuidfghj,rtyudfghdfg,rtyudfghjdfg,');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_title`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Standard Room', 'Comfortable queen or king-sized bed with high-quality linens; Complimentary high-speed Wi-Fi access; Individually controlled air conditioning; 24-hour room service; Daily housekeeping and turndown service.', 7500.00, 'Standardroom.jpg', '2024-08-11 01:18:58', '2024-08-11 02:09:40'),
(2, 'Deluxe Room', 'Spacious and elegantly furnished room with upgraded decor; Panoramic views of the city skyline or gardens; Luxurious en-suite bathroom with a deep soaking tub and separate shower; Mini bar stocked with refreshments; Access to exclusive lounge or VIP amenities.', 9000.00, 'deluxeroom.jpg', '2024-08-11 01:18:58', '2024-08-11 01:18:58'),
(3, 'Suite', 'Spacious separate living area with comfortable seating; Private bedroom with a king-sized bed; Expansive en-suite bathroom with designer toiletries; Exclusive access to a private balcony; Fully equipped kitchenette.', 10000.00, 'Suiteroom.jpg', '2024-08-11 01:18:58', '2024-08-11 01:18:58'),
(4, 'Family Room', 'Multiple bedding options including a queen-sized bed and twin beds; En-suite bathroom with a bathtub/shower combination; Mini refrigerator and microwave; 24-hour room service; Childproofing features.', 12000.00, 'familyroom.jpg', '2024-08-11 01:18:58', '2024-08-11 01:18:58'),
(5, 'Twin Room', 'Comfortable room with two twin beds; En-suite bathroom with a refreshing shower; Complimentary high-speed Wi-Fi access; 24-hour room service; Individually controlled air conditioning.', 8500.00, 'twinroom.jpg', '2024-08-11 01:18:58', '2024-08-11 01:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `first_name`, `last_name`, `email`, `password`) VALUES
(8, 'Ann', 'Ciku', 'ciku@gmail.com', '$2y$10$49f1mYa7pH3MvYywFFm0wuUvhUVfypL9Zj0P.USftvJ/VymX6sOTO'),
(9, 'Michelle', 'odhiambo', 'odhiambomichelle8@gmail.com', '$2y$10$8uAv.vI6Xj/b0MQOb/AlMO5Qj5LswD73Pjl.F5Hmd4UZMnA3Eg5q6'),
(11, 'Kim', 'Namjoon', 'namjoon@gmail.com', '$2y$10$oAx1.yaz20kYsJR4Dh.YJ.VFrdhRMeg29EqUemizc7NU0DbQvopTq'),
(12, 'Vero', 'Kijala', 'kijala@gmail.com', '$2y$10$4TKWfH7pJJgR9eZUZLjW0euEYfKHKKV/rQC97NrfVe2BlOO2twEVG'),
(14, 'Jeon', 'Jungkook', 'jungkook@gmail.com', '$2y$10$ucAY5p4n5ZZUWbGBJDhqRec/xGKX.7zIkRqnJpe8pNzte2VAda.p2'),
(15, 'Chris', 'Thuo', 'thuo@gmail.com', '$2y$10$Xk5KrS9ts5wSxRmyVcAu9OIMSBI2UBVRFit2izzD2/wq1IHtA59eG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_userid` (`userid`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
