-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 04, 2021 at 07:21 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gs_bm`
--

-- --------------------------------------------------------

--
-- Table structure for table `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `url` varchar(128) NOT NULL,
  `comment` text,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `name`, `url`, `comment`, `indate`) VALUES
(7, 'プログラミング入門', 'programming.com', 'プログラミング最高！', '2021-06-27 11:00:57'),
(8, 'デザイン経営②', 'design.com', '面白かった！', '2021-07-04 14:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, '俊則', 'test1', '$2y$10$45n03mTrYGZH7M40MUMgFuA7C7O7Oxh99CrtSj25fY1r/0oaSPVN.', 1, 0),
(2, 'としのり', 'test2', '$2y$10$/ih68QEu1QyfmCWPqqkuCuHsYZFvEMqNvl.jw/DWYs8mhS9dzcZdq', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
