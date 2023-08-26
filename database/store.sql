-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 10:17 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_name`, `product_price`, `product_image`, `quantity`, `total_price`, `product_code`) VALUES
(56, 'Acoustica Series A05, Electric Acoustic Guitar, Zebra Wood with Pickup, Inbuilt tuner\r\n', '7499', 'https://i.postimg.cc/rwjFwwDD/Acoustic.jpg\r\n', 2, '14998', 'p002');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `catname` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `catname`, `image`, `filename`) VALUES
(1, 'Guitars\r\n', 'https://media.musiciansfriend.com/is/image/MMGS7/Les-Paul-Studio-Electric-Guitar-Wine-Red/L54490000001000-00-500x500.jpg', 'guitars.php'),
(2, 'Drums\r\n', 'https://media.sweetwater.com/images/items/750/IP52KP10VTR-large.jpg?v=f5d0b13da4bf6d27', 'drums.php'),
(3, 'Piano\r\n', 'https://5.imimg.com/data5/TB/LR/LR/SELLER-24018011/black-keyboard-piano-500x500.jpg', 'piano.php'),
(4, 'Amplifiers\r\n', 'https://i.postimg.cc/R0BypSx9/61g1-L3-Dper-L-AC-SL1500.jpg', 'amplifiers.php'),
(5, 'Music Records\r\n', 'https://350927.smushcdn.com/1388247/wp-content/uploads/2020/12/Destiny-Album-Cover-PP-2.jpg?lossy=0&strip=1&webp=1', 'musicrecords.php');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pimage` varchar(255) NOT NULL,
  `pcode` varchar(100) NOT NULL,
  `pprice` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `catid`, `pname`, `pimage`, `pcode`, `pprice`) VALUES
(1, 1, 'Classical Guitar Nylon Strings Acoustic Guitar with Truss Rod for Beginners\r\n', 'https://i.postimg.cc/fR2L6JWt/download.jpg\r\n\r\n', 'p001', 6499),
(2, 1, 'Acoustica Series A05, Electric Acoustic Guitar, Zebra Wood with Pickup, Inbuilt tuner\r\n', 'https://i.postimg.cc/rwjFwwDD/Acoustic.jpg\r\n', 'p002', 7499),
(3, 1, 'Bullet Fat Stratocaster 6-Strings Electric Guitar, Black, Rosewood Fretboard\r\n', 'https://i.postimg.cc/DyM3j44d/Electric.jpg\r\n', 'p003', 11999),
(4, 2, 'Pearl, Drum Set, 5 Pcs, Roadshow, With Stands & Cymbals-Charcoal Metallic\r\n', 'https://i.postimg.cc/SKQ2F705/81vs-GIA7i-LL-SL1500.jpg\r\n', 'p004', 43108),
(5, 2, 'Mapex-Tornado 5-Piece Drum Kit with Stands, Hardware and Cymbals\r\n', 'https://i.postimg.cc/c1RDX0mJ/2.jpg\r\n', 'p005', 32499),
(6, 2, 'Rock-Jam Eight-Piece Electric Drum Set with Adjustable Mesh Heads, 30 Kits\r\n', 'https://i.postimg.cc/9MYwv80v/81-YGYFbqeu-L-AC-SL1500.jpg\r\n', 'p006', 129199),
(7, 3, 'Electronic Keyboard Piano LED Display, Music Stands\r\n', 'https://i.postimg.cc/mkg51CNz/VAU-CAESARMK2-1-1024x1024.jpg\r\n', 'p007', 87999),
(8, 3, 'Yamaha DGX-670 Digital Piano\r\n', 'https://i.postimg.cc/t4gZYTx1/dgx-670-2.jpg\r\n', 'p008', 47499),
(9, 3, 'Yamaha P-121B Digital Piano Stereophonic Optimizer\r\n', 'https://i.postimg.cc/DZh74jMC/p-121.jpg\r\n', 'p009', 48999),
(10, 4, 'Denon AVR-S760H 7.2-Channel Home Theater\r\n', 'https://i.postimg.cc/65yMQL3P/51j-VL7u-Lxp-L-AC-SL1220.jpg\r\n', 'p010', 48998),
(11, 4, 'Onkyo TX-SR393 5.2 Channel A/V\r\n', 'https://i.postimg.cc/3r65ZZkX/71y55ptwqw-S-AC-SL1500.jpg\r\n', 'p011', 57999),
(12, 4, 'YAMAHA RX-A2A AVENTAGE 7.2-Channel Music-Cast\r\n', 'https://i.postimg.cc/R0BypSx9/61g1-L3-Dper-L-AC-SL1500.jpg\r\n', 'p012', 129599),
(13, 5, 'Angus Macrae (Original Sound Track)\r\n', 'https://i.postimg.cc/MHgJWn0k/fa69ea23529355-5635981b43d91.jpg\r\n', 'p013', 499),
(14, 5, 'Deep House (Original Sound Track)\r\n', 'https://i.postimg.cc/nVmJkknp/Deep-House-pp2.jpg\r\n', 'p014', 299),
(15, 5, 'Summer With Me (Original Sound Track)\r\n', 'https://i.postimg.cc/t4ZtZYhS/Summer-Art.jpg\r\n', 'p015', 799),
(16, 5, 'Renegade Waves (Original Sound Track)\r\n', 'https://i.postimg.cc/FHVWsfmM/1607683655-18636030655fd34e47b07374-25817064.jpg\r\n', 'p016', 599),
(17, 5, 'HyperDrive-Expore The Void (Original Sound Track)\r\n', 'https://i.postimg.cc/Bnz8FpqH/hyperdrive-album-cover-design-final.jpg\r\n', 'p017', 299),
(18, 5, 'Kodevs (Original Sound Track)\r\n', 'https://i.postimg.cc/50LpTjPK/large.jpg\r\n', 'p018', 199);

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `username`, `email`, `password`) VALUES
(11, 'admin', 'aaaa@gmail.com', '$2y$10$/8WW2H7dKFnIpPWQGhC6QeyPvf1O33aDBzYYX65girovbsNDOQQ1i'),
(12, 'bbbb', 'bbbb@gmail.com', '$2y$10$470xck3AbWkEDfpLIWLUoehsTfCsDJuDR93CSWjugBDRC8BxZ8Cb.'),
(13, 'cccc', 'cccc@gmail.com', '$2y$10$sZRwuGUBYVdN2oZGDDAXeOdEKrEFzT6PpEuBCPmHGFNjvrtpZW1fC'),
(14, 'dddd', 'dddd@gmail.com', '$2y$10$B4EZcfjNjTcx2Amhj8Ix9OzStiYszpa/N7fI6IY.Tuehrhd4jt0w.'),
(15, 'admin', 'admin@gmail.com', '$2y$10$nmZiV3mG3YRotsD.FrM7qO9NvQRYQB9SRS8m7v6Yk/fdq8K6g9XB6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `Category_con` (`catid`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Category_con` FOREIGN KEY (`catid`) REFERENCES `category` (`catid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
