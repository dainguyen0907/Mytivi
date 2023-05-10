-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 02:55 AM
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
-- Database: `mytivi`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `LayLink` (IN `id_schedules` INT(11))   BEGIN
	SELECT link_program 
    from programs pro, schedule sch 
    WHERE pro.id_program=sch.id_program and sch.id_schedule=id_schedules;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sua_user` (IN `user_ids` INT(50), IN `user_names` VARCHAR(50))   BEGIN
	UPDATE user
    SET user_name=user_names where user_id=user_ids;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `them_user` (IN `user_names` VARCHAR(50), IN `user_passwords` VARCHAR(50), IN `user_emails` VARCHAR(50))   BEGIN
	DECLARE isExists int DEFAULT -1;
    SELECT COUNT(*) INTO isExists FROM user where user_name=user_names OR user_email=user_emails;
    
    IF (isExists > 0) THEN
      	SELECT 'Tài khoản hoặc mail đã tồn tại !';
    ELSE
        INSERT INTO user(user_name,user_password,user_email)
    	VALUES(user_names,user_passwords,user_emails);
    	IF(row_count()>0) THEN	
    		SELECT 'Đã đăng ký thành công !';
    	ELSE
    		SELECT 'SOMETHING WRONG !!!';
    	END IF;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_login` (IN `pr_username` VARCHAR(50), IN `pr_password` VARCHAR(50))   BEGIN	
    
    DECLARE isExists INT DEFAULT -1;  

    SELECT COUNT(*) INTO isExists FROM user WHERE user_name=pr_username AND user_password=pr_password;
    
    IF(isExists >0) THEN
        SELECT 'Đăng nhập thành công !';
    ELSE
	SELECT 'Tên đăng nhập hoặc mật khẩu không đúng !';
    END IF;
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `catalogue`
--

CREATE TABLE `catalogue` (
  `id_catalogue` int(11) NOT NULL,
  `name_catalogue` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `catalogue`
--

INSERT INTO `catalogue` (`id_catalogue`, `name_catalogue`) VALUES
(1, 'Bảng tin'),
(2, 'Lịch học'),
(4, 'Giới thiệu'),
(5, 'Quảng cáo'),
(6, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id_program` int(11) NOT NULL,
  `id_catalogue` int(11) NOT NULL,
  `name_program` varchar(300) DEFAULT NULL,
  `link_program` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id_program`, `id_catalogue`, `name_program`, `link_program`) VALUES
(1, 2, 'Lịch học từ 24/4/2023 đến 28/4/2023', NULL),
(2, 4, 'Giới thiệu EVN', NULL),
(3, 5, 'Tiết kiệm điện', NULL),
(4, 4, 'Giới thiệu cao đẳng điện lực', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL,
  `id_program` int(11) NOT NULL,
  `time_start` time NOT NULL DEFAULT current_timestamp(),
  `time_end` time NOT NULL DEFAULT current_timestamp(),
  `priority` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'admin', '', 'Hepc@0554'),
(2, 'dainq.hepc', 'dainq.hepc@evnspc.vn', 'Hepc@0554');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalogue`
--
ALTER TABLE `catalogue`
  ADD PRIMARY KEY (`id_catalogue`),
  ADD KEY `id_catalogue` (`id_catalogue`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id_program`),
  ADD KEY `id_program` (`id_program`),
  ADD KEY `id_catalogue` (`id_catalogue`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_schedule` (`id_schedule`),
  ADD KEY `id_program` (`id_program`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalogue`
--
ALTER TABLE `catalogue`
  MODIFY `id_catalogue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`id_catalogue`) REFERENCES `catalogue` (`id_catalogue`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`id_program`) REFERENCES `programs` (`id_program`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
