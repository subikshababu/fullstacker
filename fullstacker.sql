-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2019 at 09:15 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fullstacker`
--

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `slider_id` int(20) NOT NULL,
  `tab_id` int(10) NOT NULL,
  `slider_title` varchar(100) NOT NULL,
  `slider_description` text NOT NULL,
  `slider_img` varchar(200) NOT NULL,
  `slider_img_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`slider_id`, `tab_id`, `slider_title`, `slider_description`, `slider_img`, `slider_img_path`) VALUES
(14, 31, 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'DL-Communication_DjGCBgazUW.jpg', './img/DL-Communication_DjGCBgazUW.jpg'),
(15, 31, 'Lorem Ipsum has been the industry\'s standard', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'DL-Learning-1_eAhQbmESrG.jpg', './img/DL-Learning-1_eAhQbmESrG.jpg'),
(16, 32, 'when an unknown printer took ', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'DL-Learning-1_rTxpUblEDk.jpg', './img/DL-Learning-1_rTxpUblEDk.jpg'),
(17, 32, 'It has survived not only five centuries', 'It has survived not only five centuries, but also the leap into electronic ', 'DL-Communication_sfGAFelvDV.jpg', './img/DL-Communication_sfGAFelvDV.jpg'),
(18, 32, 'typesetting, remaining essentially unchanged', 'typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release', 'DL-Technology_uDVlNaKFIG.jpg', './img/DL-Technology_uDVlNaKFIG.jpg'),
(32, 33, 'Lorem Ipsum', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical', 'DL-Learning-1_orTIQhPeqt.jpg', './img/DL-Learning-1_orTIQhPeqt.jpg'),
(33, 33, 'Lorem Ipsum generators', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet', 'DL-Technology_oBOKwaqbmh.jpg', './img/DL-Technology_oBOKwaqbmh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE `tabs` (
  `tab_id` int(10) NOT NULL,
  `tab_name` varchar(100) NOT NULL,
  `tab_icon` varchar(200) NOT NULL,
  `tab_icon_path` varchar(200) NOT NULL,
  `no_of_slider` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs`
--

INSERT INTO `tabs` (`tab_id`, `tab_name`, `tab_icon`, `tab_icon_path`, `no_of_slider`) VALUES
(31, 'Learning', 'DL-learning_AqVrutsBIE.svg', './icons/DL-learning_AqVrutsBIE.svg', 2),
(32, 'Technology', 'DL-technology_fyWsibFumX.svg', './icons/DL-technology_fyWsibFumX.svg', 3),
(33, 'Communicatiom', 'DL-communication_ahmdeKDpLP.svg', './icons/DL-communication_ahmdeKDpLP.svg', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tabs`
--
ALTER TABLE `tabs`
  ADD PRIMARY KEY (`tab_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `slider_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tabs`
--
ALTER TABLE `tabs`
  MODIFY `tab_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
