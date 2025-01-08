-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 03:19 PM
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
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `item_name` varchar(200) NOT NULL,
  `rating` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`item_name`, `rating`) VALUES
('            chaana', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(21, 'Pratik Maharjan', 'phantom', '25969fd10cffdec58ea8fc18de76281af086d2cc'),
(22, 'krinesh', 'kree', '832de947d262b172904ed883b08f00e8d4b2fed3'),
(23, 'John Tamang', 'messi', 'a51dda7c7ff50b61eaea0444371f4a6a9301e501');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(255) NOT NULL,
  `active` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(19, 'Non-Veg', 'chicken.jpg', 'Yes', 'Yes'),
(20, 'Veg', 'chana.jpg', 'Yes', 'Yes'),
(21, 'Hot Drinks', 'tea.jpg', 'Yes', 'Yes'),
(22, 'Cold Drinks', 'coke.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(200) NOT NULL,
  `active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(16, '            chaana', 'khjkhhatraimithooochaaavjldj', 60.00, 'chana.jpg', 20, 'Yes', 'Yes'),
(18, '     Paratha', 'wow', 50.00, 'paratha.jpg', 19, 'Yes', 'Yes'),
(20, ' Milk Tea', 'tato tato dudh chiya', 35.00, 'milktea.jpg', 21, 'Yes', 'Yes'),
(22, ' Black Tea', 'kalo chiya', 20.00, 'tea.jpg', 21, 'Yes', 'Yes'),
(23, 'Syabhale', 'tasteeeeeeeyyy', 500.00, 'syafaley.jpg', 19, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_contact` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`) VALUES
(1, 'Black Tea', 20.00, 1, 20.00, 2024, 'Cancelled', 'Ram kumar', '9843635685', 'ram@gmail.com'),
(2, 'Burger', 250.00, 2, 500.00, 2024, 'Delivered', 'krinesh maharjan', '9874563275', 'krinesh@gmail.com'),
(3, 'Matka Tea', 65.00, 2, 130.00, 24, 'Ordered', 'Pratik Maharjan', '9874124578', 'pratik@gmail.com'),
(4, '  chaana', 40.00, 1, 40.00, 24, 'On Delivery', 'shyam lal', '9874563214', 'shyam@gmail.com'),
(5, 'coffee', 160.00, 2, 320.00, 2024, 'On Delivery', 'hari lal', '9851000036', 'hari@gmail.com'),
(6, 'Matka Tea', 65.00, 2, 130.00, 2024, 'Cancelled', 'Pratik Maharjan', '9874124578', 'pratik@gmail.com'),
(7, '            chaana', 60.00, 1, 60.00, 2024, 'Ordered', 'dasd', 'asdasd', 'asdasd@asd.dfs'),
(8, '            chaana', 60.00, 1, 60.00, 2024, 'Ordered', 'dasd', 'sad', 'sad@dfsd');

-- --------------------------------------------------------

--
-- Table structure for table `userdb`
--

CREATE TABLE `userdb` (
  `Username` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Role` varchar(100) NOT NULL,
  `Phone` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdb`
--

INSERT INTO `userdb` (`Username`, `Password`, `Role`, `Phone`, `Email`) VALUES
('ram', 'e17e5425a021224b63e91499ff8ac491c87567db', 'on', '9860820021', 'ram@gmail.com'),
('sita', 'b0aeb81edeb946afc3e304838c35b76ff1d0146b', 'on', '9841635584', 'sita12@gmail.com'),
('kree12', '70851149680838acce5d5cbcf4bf5d1611b77c99', 'on', '9808210800', 'kreemhn@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
