-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 23, 2020 at 07:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dharmawan_books`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `price`, `image`) VALUES
(3, 'JQuery', 'Dennis Hutten', 102000, 'jquery.jpg'),
(10, 'Learn Linux in 3 Days', 'Jason Cannon', 90000, 'linux.jpg'),
(12, 'Ang-book', 'Team', 120000, 'angular.jpg'),
(13, 'Learn C# in one day', 'Author', 130000, 'C.jpg'),
(14, 'Introducing Elixir', 'Laurent & Eisenberg', 105000, 'elixir.jpg'),
(15, 'Go Bootcamp', 'Matt Aimoneti', 125000, 'go.png'),
(16, 'Programming With Java', 'E Balagurusamy', 130000, 'java.jpg'),
(17, 'Learning Java Script', 'Ethan Brown', 120000, 'js.jpg'),
(18, 'Kontlin for Android Developers', 'Antonio Leiva', 130000, 'kotlin.png'),
(19, 'Machine Learnong fof Beginers', 'Chrish Sebastian', 140000, 'ml.jpg'),
(20, 'Build Web Apps Node JS', 'Piya De', 120000, 'node.jpg'),
(21, 'Programming PHP', 'Author', 130000, 'php.png'),
(22, 'The Python Book', 'Author', 130000, 'python.jpg'),
(23, 'R for Data Science', 'Wickham & Grolemund', 135000, 'R.png'),
(24, 'React', 'Lionel Lopez', 110000, 'react.jpg'),
(25, 'The Ruby On Rails Tutorial', 'Michael Hartl', 130000, 'ruby.png'),
(26, 'Learning Swift', 'Team', 140000, 'swift.jpg'),
(27, 'Vue', 'Lionel Lopez', 120000, 'vue.jpg'),
(28, 'Mastering Bash', 'Giorgio Zarrelli', 120000, 'bash.jpg'),
(30, 'Blockchain The Technology Revolution', 'Devan Hansel', 130000, 'bc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed`
--

CREATE TABLE `borrowed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowed`
--

INSERT INTO `borrowed` (`id`, `user_id`, `book_id`, `date`, `time`) VALUES
(1, 2, 3, 1579653948, 2),
(2, 2, 3, 1579655210, 2),
(3, 2, 10, 1579655575, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `delivery_status` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `shipping_address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `book_id`, `date`, `payment_status`, `delivery_status`, `total`, `shipping_address_id`) VALUES
(78, 2, 10, 1579648587, 'pending', 'on proccess', 90000, 24);

-- --------------------------------------------------------

--
-- Table structure for table `payment_confirmation`
--

CREATE TABLE `payment_confirmation` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `file` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_confirmation`
--

INSERT INTO `payment_confirmation` (`id`, `orders_id`, `file`) VALUES
(1, 78, 'postman.jpg'),
(2, 80, 'screen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `sub_district` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`id`, `user_id`, `user_email`, `address`, `sub_district`, `city`, `province`, `country`, `phone`) VALUES
(19, 1, 'risqidharmawan@gmail.com', 'Kelurahan Branjang', 'Kecamata Ungaran Barat', 'Kabupaten Semarang', 'Jawa Tengah', 'Indonesia', '087575788888'),
(24, 2, 'user@gmail.com', 'Jl. Yos Sudarso no. 21', 'Gunungpati', 'Semarang', 'Jawa Tengah', 'Indonesia', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Muhammad Risqi Dharmawan', 'risqidharmawan@gmail.com', 'mpic.jpg', '$2y$10$VTs8l3MHocwFOivYvYZq3Ojl4TjuThsqGji2dwxeq6WeIAcxqpRLK', 1, 1, 1575564790),
(2, 'User', 'user@gmail.com', 'default.png', '$2y$10$MIGnlFfGujH5aPs9m3vOh.GPl12xv4iWF01Wgc5b8waqJnDygwyCq', 2, 1, 1575400000);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(6, 2, 3),
(15, 1, 3),
(16, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Administrator'),
(2, 'Home'),
(3, 'User'),
(4, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `submenu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `submenu`, `url`, `icon`, `is_active`) VALUES
(2, 2, 'Books', 'home', 'fas fa-fw fa-book-open', 1),
(3, 3, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(4, 3, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(5, 4, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(8, 1, 'Role', 'administrator/role', 'fas fa-fw fa-user-tie', 1),
(9, 3, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(10, 1, 'Book Management', 'administrator', 'fas fa-fw fa-book', 1),
(34, 4, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(39, 2, 'My Order', 'home/myorder', 'fas fa-fw fa-shopping-cart', 1),
(40, 1, 'Order Management', 'administrator/order', 'fas fa-fw fa-shipping-fast', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowed`
--
ALTER TABLE `borrowed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_confirmation`
--
ALTER TABLE `payment_confirmation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `borrowed`
--
ALTER TABLE `borrowed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `payment_confirmation`
--
ALTER TABLE `payment_confirmation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
