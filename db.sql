-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 12, 2013 at 01:37 PM
-- Server version: 5.1.65
-- PHP Version: 5.3.25

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `greenher_002`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities_log`
--

CREATE TABLE IF NOT EXISTS `activities_log` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `act_date` date DEFAULT NULL,
  `act_time` time DEFAULT NULL,
  `service_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user` (`user_code`),
  KEY `idx_sv` (`service_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `activities_log`
--

INSERT INTO `activities_log` (`id`, `user_code`, `result`, `act_date`, `act_time`, `service_code`) VALUES
(70, 'USR-0001', 'เปลียน RAM ใหม่', '2013-03-14', '22:57:03', 'SRV-5603-000006'),
(71, 'USR-0002', 'ติดตั้งระบบปฏิบัติการใหม่', '2013-03-14', '23:11:43', 'SRV-5603-000006'),
(72, 'USR-0002', 'เปลี่ยนสถานะ -> รอซ่อม', '2013-03-14', '23:15:20', 'SRV-5603-000006'),
(73, 'USR-0001', 'จำหน่ายรายการ --> วันที่จำหน่าย 15/03/2556', '2013-03-15', '10:34:21', NULL),
(74, 'USR-0001', 'จำหน่ายรายการ --> วันที่จำหน่าย 15/03/2556', '2013-03-15', '10:34:59', 'SRV-5603-000006'),
(75, 'USR-0001', 'จำหน่ายรายการ --> วันที่จำหน่าย 15/03/2556', '2013-03-15', '10:35:52', 'SRV-5603-000006'),
(76, 'USR-0001', 'จำหน่ายรายการ --> วันที่จำหน่าย 15/03/2556', '2013-03-15', '10:36:13', 'SRV-5603-000006'),
(77, 'USR-0001', 'จำหน่ายรายการ --> วันที่จำหน่าย 15/03/2556', '2013-03-15', '10:37:46', 'SRV-5603-000006'),
(78, 'USR-0003', 'แก้ไขข้อมูลการลงทะเบียน', '2013-03-15', '14:34:42', NULL),
(79, 'USR-0003', 'แก้ไขข้อมูลการลงทะเบียน', '2013-03-15', '14:36:18', 'SRV-5603-000006'),
(80, 'USR-0003', 'แก้ไขข้อมูลการลงทะเบียน', '2013-03-15', '14:38:30', 'SRV-5603-000006'),
(81, 'USR-0003', 'แก้ไขข้อมูลการลงทะเบียน', '2013-03-15', '14:40:18', 'SRV-5603-000006'),
(82, 'USR-0003', 'แก้ไขข้อมูลการลงทะเบียน', '2013-03-15', '14:42:42', 'SRV-5603-000006'),
(83, 'USR-0002', 'เปลี่ยนสถานะ -> กำลังซ่อม', '2013-03-15', '15:50:36', 'SRV-5603-000007'),
(84, 'USR-0002', 'เปลี่ยนสถานะ -> รอซ่อม', '2013-03-15', '15:50:58', 'SRV-5603-000007'),
(85, 'USR-0002', 'เปลี่ยนสถานะ -> กำลังซ่อม', '2013-03-16', '22:06:38', 'SRV-5603-000006'),
(86, 'USR-0003', 'ส่งซ่อม -> ร้าน มาย คอมพิวเตอร์', '2013-03-18', '21:59:25', 'SRV-5603-000006'),
(87, 'USR-0003', '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '21:59:25', 'SRV-5603-000006'),
(88, 'USR-0003', 'ส่งซ่อม -> ร้าน มาย คอมพิวเตอร์', '2013-03-18', '22:02:04', 'SRV-5603-000006'),
(89, 'USR-0003', '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '22:02:04', 'SRV-5603-000006'),
(90, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-18', '22:51:44', 'SRV-5603-000006'),
(91, 'USR-0003', 'รับกลับ -> ลบข้อมูล', '2013-03-18', '22:58:23', 'SRV-5603-000006'),
(92, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-18', '22:59:13', 'SRV-5603-000006'),
(93, 'USR-0003', 'รับกลับ -> ลบข้อมูล', '2013-03-18', '22:59:34', 'SRV-5603-000006'),
(94, NULL, 'รับกลับ -> ลบรายการ', '2013-03-18', '22:59:50', 'SRV-5603-000006'),
(95, 'USR-0003', 'ส่งซ่อม -> ร้าน มาย คอมพิวเตอร์', '2013-03-18', '23:02:54', 'SRV-5603-000007'),
(96, 'USR-0003', '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '23:02:54', 'SRV-5603-000007'),
(97, NULL, 'รับกลับ -> ลบรายการ', '2013-03-18', '23:03:00', '0'),
(98, 'USR-0003', 'ส่งซ่อม -> บริษัท MBC Computer จำกัด', '2013-03-18', '23:07:40', 'SRV-5603-000006'),
(99, 'USR-0003', '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '23:07:40', 'SRV-5603-000006'),
(100, 'USR-0003', 'รับกลับ -> ลบรายการ', '2013-03-18', '23:07:43', 'SRV-5603-000006'),
(101, 'USR-0003', 'ส่งซ่อม -> ร้าน มาย คอมพิวเตอร์', '2013-03-18', '23:20:08', 'SRV-5603-000007'),
(102, 'USR-0003', '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '23:20:08', 'SRV-5603-000007'),
(103, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-18', '23:20:45', 'SRV-5603-000007'),
(104, 'USR-0003', 'ส่งซ่อม -> ร้าน มาย คอมพิวเตอร์', '2013-03-18', '23:43:53', 'SRV-5603-000007'),
(105, 'USR-0003', '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '23:43:53', 'SRV-5603-000007'),
(106, NULL, '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '23:44:29', 'SRV-5603-000007'),
(107, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-18', '23:45:51', 'SRV-5603-000007'),
(108, 'USR-0003', 'รับกลับ -> ลบข้อมูล', '2013-03-18', '23:46:42', 'SRV-5603-000007'),
(109, NULL, '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '23:47:38', 'SRV-5603-000007'),
(110, NULL, '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-03-18', '23:48:35', 'SRV-5603-000007'),
(111, 'USR-0003', 'แก้ไขข้อมูลการลงทะเบียน', '2013-03-18', '23:49:12', 'SRV-5603-000007'),
(112, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-19', '00:06:50', 'SRV-5603-000007'),
(113, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-19', '00:07:40', 'SRV-5603-000007'),
(114, 'USR-0003', 'รับกลับ -> ลบข้อมูล', '2013-03-19', '00:07:49', 'SRV-5603-000007'),
(115, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-19', '00:07:58', 'SRV-5603-000007'),
(116, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-19', '00:08:08', 'SRV-5603-000007'),
(117, 'USR-0003', 'รับกลับ -> ลบข้อมูล', '2013-03-19', '00:08:12', 'SRV-5603-000007'),
(118, 'USR-0003', 'รับกลับ -> ส่งซ่อม', '2013-03-19', '00:08:19', 'SRV-5603-000007'),
(119, 'USR-0003', 'ลงทะเบียนรับซ่อม', '2013-03-21', '15:43:31', 'SRV-5603-000008'),
(120, 'USR-0003', 'ลงทะเบียนรับซ่อม', '2013-03-25', '09:47:09', 'SRV-5603-000009'),
(121, 'USR-0002', 'กำหนดช่าง -> นายวัฒนา ฉิมพลี', '2013-03-25', '09:54:43', 'SRV-5603-000008'),
(122, 'USR-0002', 'เปลี่ยนสถานะ -> กำลังซ่อม', '2013-03-25', '09:59:17', 'SRV-5603-000008'),
(123, 'USR-0002', 'Hard disk เสีย\nติดตั้งระบบปฏิบัติการใหม่', '2013-03-25', '10:04:50', 'SRV-5603-000009'),
(124, 'USR-0002', 'จำหน่ายรายการ --> วันที่จำหน่าย 26/03/2556', '2013-03-25', '10:11:16', 'SRV-5603-000009'),
(125, 'USR-0003', 'ส่งซ่อม -> ร้าน มาย คอมพิวเตอร์', '2013-04-11', '23:56:34', 'SRV-5603-000007'),
(126, 'USR-0003', '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม', '2013-04-11', '23:56:34', 'SRV-5603-000007'),
(127, 'USR-0002', 'จำหน่ายรายการ --> วันที่จำหน่าย 26/03/3099', '2013-04-12', '01:47:14', 'SRV-5603-000009'),
(128, 'USR-0003', 'ส่งซ่อม -> ร้าน มาย คอมพิวเตอร์', '2013-04-12', '01:48:08', 'SRV-5603-000009'),
(129, 'USR-0003', 'รับกลับ -> ลบข้อมูล', '2013-04-12', '01:48:20', 'SRV-5603-000007'),
(130, 'USR-0003', 'รับกลับ -> ลบรายการ', '2013-04-12', '01:48:25', 'SRV-5603-000007'),
(131, 'USR-0002', 'กำหนดช่าง -> นายวัฒนา ฉิมพลี', '2013-04-14', '22:59:15', 'SRV-5603-000009'),
(132, 'USR-0002', 'เปลี่ยนสถานะ -> กำลังซ่อม', '2013-04-14', '22:59:26', 'SRV-5603-000009'),
(133, 'USR-0002', 'เปลี่ยนสถานะ -> ซ่อมเสร็จ', '2013-04-15', '00:14:30', 'SRV-5603-000009'),
(134, 'USR-0002', 'เปลี่ยนสถานะ -> รอซ่อม', '2013-04-15', '00:16:58', 'SRV-5603-000006'),
(135, 'USR-000001', 'นายวัฒนา ฉิมพลี กำหนดช่าง -> xxxxxxx xxxx', '2013-04-15', '00:37:49', 'SRV-5603-000006'),
(136, 'USR-0004', 'นายวัฒนา ฉิมพลี กำหนดช่าง -> พรชัย ทวะศรี', '2013-04-15', '00:38:15', 'SRV-5603-000008'),
(137, 'USR-0004', 'เปลี่ยนสถานะ -> พักการซ่อม', '2013-05-29', '13:35:59', 'SRV-5603-000008');

-- --------------------------------------------------------

--
-- Table structure for table `charge_items`
--

CREATE TABLE IF NOT EXISTS `charge_items` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`,`code`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `charge_items`
--

INSERT INTO `charge_items` (`id`, `code`, `name`, `price`) VALUES
(1, 'ITM-001', 'ขาเก้าอี้', 250.00),
(3, 'ITM-003', 'ผ้าปูโต๊ะ', 540.00),
(6, 'ITM-004', 'HDD 80 GB', 500.00),
(7, 'ITM-005', 'RAM 2 GB', 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `tax_code` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `telephone`, `fax`, `email`, `url`, `tax_code`) VALUES
(1, 'บริษัท abc จำกัด', '123 หมู่ 1 ต.เมือง อ.เมือง จ.กาฬสินธุ์', '043789112', '0347778983', 'my@abc.com', 'http://www.abc.com', 'xxx-xxxx-xxxx');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `contact_name` varchar(150) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `code`, `contact_name`, `address`, `telephone`, `fax`, `email`) VALUES
(1, 'ร้านอีสานเฟอร์นิเจอร์ กาฬสินธุ์', 'OWN-001', 'สถิตย์ เรียนพิศ', '123 หมู่ 1 ต.เมือง อ.เมือง จ.กาฬสินธุ์', '043789112', '', ''),
(2, 'โรงพยาบาลมหาสารคาม [ศูนย์ข้อมูล]', 'OWN-002', 'พรประสิทธิ์ มีโชค', 'อาคารพละศึกษา ชั้น 4', '3333333', '', ''),
(3, 'คุณพรทวี ชัยเมือง', 'OWN-003', 'ใจดี พรไพรวัลย์', '11 ต.ในเมือง อ.กันทรวิชัย จ.มหาสารคาม', '', '', ''),
(4, 'ร้านมงคล การเกษตร', 'OWN-004', 'นฤมล ใจมั่น', '-', '', '', ''),
(5, '555eretrte', 'CUS-000002', 'sss', 'fsfsds', 'fdsfdsf', 'dsfdsf', 'ssss');

-- --------------------------------------------------------

--
-- Table structure for table `other_devices`
--

CREATE TABLE IF NOT EXISTS `other_devices` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`code`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `other_devices`
--

INSERT INTO `other_devices` (`id`, `code`, `name`) VALUES
(1, 'ITM-001', 'สายไฟ'),
(2, 'ITM-002', 'ปลั๊กไฟ'),
(3, 'ITM-003', 'กระเป๋าโน็ตบุค'),
(6, 'ITM-004', 'External Hard Disk'),
(7, 'ITM-005', 'Handy drive'),
(8, 'ITM-006', 'แผ่นซีดี/ดีวีดี'),
(10, 'ITM-008', 'อะแด็ปเตอร์');

-- --------------------------------------------------------

--
-- Table structure for table `other_items`
--

CREATE TABLE IF NOT EXISTS `other_items` (
  `id` int(12) NOT NULL DEFAULT '0',
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE IF NOT EXISTS `priorities` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `name`) VALUES
(1, 'ปกติ'),
(2, 'ด่วน'),
(3, 'ด่วนมาก');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `product_serial` varchar(50) DEFAULT NULL,
  `purchase_price` double(12,2) DEFAULT NULL,
  `brand_code` varchar(50) DEFAULT NULL,
  `model_code` varchar(50) DEFAULT NULL,
  `customer_code` varchar(50) DEFAULT NULL,
  `type_code` varchar(50) DEFAULT NULL,
  `color_code` varchar(50) DEFAULT NULL,
  `supplier_code` varchar(50) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `spec` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_code` (`code`),
  KEY `idx_model` (`model_code`),
  KEY `idx_type` (`type_code`),
  KEY `idx_brand` (`brand_code`),
  KEY `idx_owner` (`customer_code`),
  KEY `idx_supplier` (`supplier_code`),
  KEY `idx_color` (`color_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=17614 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `product_serial`, `purchase_price`, `brand_code`, `model_code`, `customer_code`, `type_code`, `color_code`, `supplier_code`, `purchase_date`, `spec`) VALUES
(17608, 'PRD-000001', 'SN099990', 26656.00, 'BND-0002', 'MDL-0002', 'OWN-001', 'PDT-0003', 'CLO-003', 'SUP-0001', '2012-12-30', 'HDD 500 GB'),
(17610, 'PRD-000003', 'PN2323232', 3500.00, 'BND-0001', 'MDL-0001', 'OWN-001', 'PDT-0002', 'CLO-001', 'SUP-0001', '2012-12-30', '-'),
(17611, 'PRD-000004', 'PN1111211', 1244.00, 'BND-0002', 'MDL-0002', 'OWN-002', 'PDT-0002', 'CLO-004', 'SUP-0002', '2012-12-30', '-'),
(17612, 'PRD-000005', 'sfsdffsf', 3444.00, 'BND-0001', 'MDL-0001', 'OWN-001', 'PDT-0003', 'CLO-004', 'SUP-0002', '2012-12-03', '-'),
(17613, 'PRD-000006', '''''""<@--', 24.70, 'BND-0001', '', 'OWN-004', 'PDT-0001', 'CLO-004', 'SUP-0002', '0000-00-00', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE IF NOT EXISTS `product_brands` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`code`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=960 ;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `code`, `name`) VALUES
(952, 'BND-0001', 'Acer'),
(953, 'BND-0002', 'HP'),
(954, 'BND-0003', 'Lenovo'),
(955, 'BND-0004', 'IBM'),
(957, 'BND-0006', 'Apple'),
(958, 'BND-000001', 'Toshiba'),
(959, 'BND-000002', 'ASUS');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE IF NOT EXISTS `product_colors` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `code`, `name`) VALUES
(1, 'CLO-001', 'แดง'),
(2, 'CLO-002', 'เหลือง'),
(3, 'CLO-003', 'น้ำเงิน'),
(4, 'CLO-004', 'ขาว'),
(5, 'CLO-005', 'ดำ');

-- --------------------------------------------------------

--
-- Table structure for table `product_models`
--

CREATE TABLE IF NOT EXISTS `product_models` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `brand_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`code`),
  KEY `idx_code` (`code`),
  KEY `idx_brand` (`brand_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2036 ;

--
-- Dumping data for table `product_models`
--

INSERT INTO `product_models` (`id`, `code`, `name`, `brand_code`) VALUES
(2032, 'MDL-0001', 'PL11051', 'BND-0003'),
(2033, 'MDL-0002', 'AV01421', 'BND-0002'),
(2034, 'MDL-000001', 'VP11109', 'BND-000002'),
(2035, 'MDL-000002', 'sdfdsf', 'BND-000002');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE IF NOT EXISTS `product_types` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`code`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=362 ;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `code`, `name`) VALUES
(355, 'PDT-0001', 'คอมพิวเตอร์ (Computer)'),
(356, 'PDT-0002', 'เครื่องพิมพ์ (Printer)'),
(357, 'PDT-0003', 'เครื่องสำรองไฟ (UPS)'),
(359, 'PDT-0005', 'จอภาพ (Monitor)'),
(360, 'PDT-000002', 'เครื่องถ่ายเอกสาร'),
(361, 'PDT-000003', 'ฮาร์ดดิสก์');

-- --------------------------------------------------------

--
-- Table structure for table `send_claims`
--

CREATE TABLE IF NOT EXISTS `send_claims` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(50) NOT NULL,
  `claim_code` varchar(50) NOT NULL,
  `claim_date` date NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `claim_status` char(1) NOT NULL DEFAULT '0',
  `user_code` varchar(50) NOT NULL,
  `get_user_code` varchar(50) DEFAULT NULL,
  `get_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `send_claims`
--

INSERT INTO `send_claims` (`id`, `service_code`, `claim_code`, `claim_date`, `company_code`, `claim_status`, `user_code`, `get_user_code`, `get_date`) VALUES
(6, 'SRV-5603-000007', 'CLM-5603-000002', '2013-03-20', 'SUP-0001', '1', 'USR-0003', 'USR-0003', '2013-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `send_services`
--

CREATE TABLE IF NOT EXISTS `send_services` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(50) NOT NULL,
  `send_code` varchar(50) NOT NULL,
  `send_date` date NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `send_status` char(1) NOT NULL DEFAULT '0',
  `user_code` varchar(50) NOT NULL,
  `get_user_code` varchar(50) DEFAULT NULL,
  `get_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `send_services`
--

INSERT INTO `send_services` (`id`, `service_code`, `send_code`, `send_date`, `company_code`, `send_status`, `user_code`, `get_user_code`, `get_date`) VALUES
(5, 'SRV-5603-000007', 'SSV-000006', '2013-03-18', 'SUP-0002', '1', 'USR-0003', 'USR-0003', '2013-03-19'),
(7, 'SRV-5603-000009', 'SSV-5604-000002', '2013-04-12', 'SUP-0002', '0', 'USR-0003', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `serials`
--

CREATE TABLE IF NOT EXISTS `serials` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `th_name` varchar(50) DEFAULT NULL,
  `sr_type` varchar(50) NOT NULL DEFAULT '',
  `sr_no` int(10) DEFAULT NULL,
  `sr_y` varchar(4) DEFAULT NULL,
  `sr_m` varchar(2) DEFAULT NULL,
  `prefix` varchar(4) DEFAULT NULL,
  `chk_date` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`,`sr_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `serials`
--

INSERT INTO `serials` (`id`, `th_name`, `sr_type`, `sr_no`, `sr_y`, `sr_m`, `prefix`, `chk_date`) VALUES
(1, 'รหัสสินค้า (Product)', 'PRODUCT', 7, '56', '01', 'PRD', '0'),
(2, 'รหัสลูกค้า (Customer)', 'CUSTOMER', 3, '56', '01', 'CUS', NULL),
(3, 'รหัสร้านค้า (Supplier)', 'SUPPLIER', 4, '56', '01', 'SUP', NULL),
(4, 'รหัสชนิด (Type)', 'PRODUCT_TYPE', 5, '56', '01', 'TTY', NULL),
(5, 'รหัสยี่ห้อ (Brand)', 'PRODUCT_BRAND', 4, '56', '01', 'BRN', '0'),
(6, 'รหัสรุ่น (Model)', 'PRODUCT_MODEL', 3, '56', '01', 'MDL', NULL),
(7, 'รหัสใบแจ้งซ่อม (Service Code)', 'SERVICE', 10, '56', '03', 'SRV', '1'),
(8, 'รหัสส่งซ่อม (Send Service)', 'SEND_SERVICE', 3, '56', '04', 'SSV', '1'),
(9, 'รหัสส่งเคลม (Claim Service)', 'CLAIM_SERVICE', 3, '56', '03', 'CLM', '1'),
(10, 'รหัสอุปกรณ์อื่นๆ (Other devices)', 'OTHER_DEVICE', 1, '56', '03', 'OTD', NULL),
(11, 'รหัสค่าใช้จ่าย (Charge items)', 'CHARGE_ITEM', 1, '56', '03', 'CIT', NULL),
(12, 'รหัสค่าใช้จ่าย', 'OTHER_ITEM', 5, '56', '04', 'ITM', NULL),
(13, 'รหัสผู้ใช้งาน (User)', 'USER', 2, '56', '04', 'USR', NULL),
(14, 'รหัสร้องขอรับบริการ (Request)', 'REQUEST', 8, '56', '04', 'REQ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `serial_configs`
--

CREATE TABLE IF NOT EXISTS `serial_configs` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `sr_type` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_srtype` (`sr_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `serial_configs`
--

INSERT INTO `serial_configs` (`id`, `sr_type`, `prefix`) VALUES
(1, 'PRODUCT_MODEL', NULL),
(2, 'SEND_SERVICE', 'SSV'),
(3, 'OTHER_item', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `serial_defaults`
--

CREATE TABLE IF NOT EXISTS `serial_defaults` (
  `sr_type` varchar(50) NOT NULL DEFAULT '',
  `prefix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sr_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serial_defaults`
--

INSERT INTO `serial_defaults` (`sr_type`, `prefix`) VALUES
('ACCESSORY', 'ASS'),
('CUSTOMER', 'CUS'),
('INVOICE', 'INV'),
('OWNER', 'OWN'),
('PRODUCT', 'PRD'),
('SEND_CLAIM', 'CLM'),
('SEND_SERVICE', 'SSV'),
('SERVICE', 'SRV'),
('SUPPLIER', 'SUP');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(50) NOT NULL DEFAULT '',
  `product_code` varchar(50) DEFAULT NULL,
  `date_serv` date DEFAULT NULL,
  `cause` text,
  `service_status` char(1) DEFAULT '1',
  `technician_code` varchar(50) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_telephone` varchar(50) DEFAULT NULL,
  `customer_code` varchar(50) DEFAULT NULL,
  `priority` int(3) DEFAULT NULL,
  `register_by` varchar(50) DEFAULT NULL,
  `service_result` varchar(255) DEFAULT NULL,
  `discharge_status` char(1) DEFAULT 'N',
  `discharge_date` date DEFAULT NULL,
  `discharge_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`service_code`),
  KEY `idx_sv` (`service_code`),
  KEY `idx_product` (`product_code`),
  KEY `idx_date` (`date_serv`),
  KEY `idx_status` (`service_status`),
  KEY `idx_tech` (`technician_code`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_code`, `product_code`, `date_serv`, `cause`, `service_status`, `technician_code`, `contact_name`, `contact_telephone`, `customer_code`, `priority`, `register_by`, `service_result`, `discharge_status`, `discharge_date`, `discharge_user`) VALUES
(6, 'SRV-5603-000006', 'PRD-000005', '2013-03-13', 'เปิดไม่ติด หรือติดบ้างไม่ติดบ้าง', '1', 'USR-000001', 'นายสถิตย์ เรียนพิศ', '09899909988', 'OWN-001', 3, 'USR-0003', 'ติดไวรัส แสกนไวรัสเรียบร้อยแล้ว', 'Y', '2013-03-15', 'USR-0001'),
(7, 'SRV-5603-000007', 'PRD-000004', '2013-03-13', 'เปิดไม่ติด', '5', 'USR-0002', 'นายสถิตย์ เรียนพิศ', '0810538180', 'OWN-003', 2, 'USR-0003', NULL, 'N', NULL, NULL),
(8, 'SRV-5603-000008', 'PRD-000001', '2013-03-21', 'เปิดไม่ติด', '3', 'USR-0004', 'พรทวี มีโชค', '0897778987', 'OWN-001', 1, 'USR-0003', NULL, 'N', NULL, NULL),
(9, 'SRV-5603-000009', 'PRD-000003', '2013-03-25', 'เครื่องพิมพ์ไม่ตอบสนองการสั่งงาน\nขึ้นไฟกระพริบตลอดเวลา', '7', 'USR-0002', 'คุณธวัช กิจมงคล', '08900000989', 'OWN-004', 1, 'USR-0003', 'Hard disk เสีย\nเปลี่ยนตัวใหม่\nติดตั้งระบบปฏิบัติการใหม่', 'Y', '2013-03-26', 'USR-0002');

-- --------------------------------------------------------

--
-- Table structure for table `service_charge_items`
--

CREATE TABLE IF NOT EXISTS `service_charge_items` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(50) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `qty` int(3) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_sv` (`service_code`),
  KEY `idx_code` (`item_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `service_charge_items`
--

INSERT INTO `service_charge_items` (`id`, `service_code`, `item_code`, `qty`, `price`) VALUES
(5, 'SRV-5603-000007', 'ITM-004', 2, 1250.00),
(8, 'SRV-5603-000006', 'ITM-005', 1, 1000.00),
(9, 'SRV-5603-000006', 'ITM-001', 1, 250.00),
(10, 'SRV-5603-000009', 'ITM-004', 1, 500.00),
(11, 'SRV-5603-000009', 'ITM-005', 2, 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `service_discharges`
--

CREATE TABLE IF NOT EXISTS `service_discharges` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(50) DEFAULT NULL,
  `discharge_date` date DEFAULT NULL,
  `user_code` varchar(50) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_logs`
--

CREATE TABLE IF NOT EXISTS `service_logs` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(50) DEFAULT NULL,
  `user_id` int(12) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `log_time` time DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_other_devices`
--

CREATE TABLE IF NOT EXISTS `service_other_devices` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(50) NOT NULL DEFAULT '',
  `item_code` varchar(50) DEFAULT NULL,
  `item_qty` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`,`service_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `service_other_devices`
--

INSERT INTO `service_other_devices` (`id`, `service_code`, `item_code`, `item_qty`) VALUES
(17, 'SRV-5603-000006', 'ITM-001', 1),
(18, 'SRV-5603-000006', 'ITM-003', 2),
(19, 'SRV-5603-000006', 'ITM-007', 1),
(20, 'SRV-5603-000007', 'ITM-003', 1),
(21, 'SRV-5603-000008', 'ITM-002', 1),
(22, 'SRV-5603-000008', 'ITM-004', 2),
(23, 'SRV-5603-000009', 'ITM-002', 1),
(24, 'SRV-5603-000009', 'ITM-005', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE IF NOT EXISTS `service_requests` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `customer` varchar(150) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `status_code` char(5) DEFAULT NULL,
  `user_code` varchar(50) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `req_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `code`, `customer`, `contact`, `telephone`, `status_code`, `user_code`, `detail`, `req_date`) VALUES
(3, 'REQ-5604-000005', 'ghgf', 'hfhfh', 'fhgfh', '-1', 'USR-0001', 'ghgf', '2013-04-16'),
(4, 'REQ-5604-000006', 'sdfsdf', 'sdfsdsadasdsdf', 'asdfasdf', '1', 'USR-0002', 'sdfsdf', '2013-04-16'),
(5, 'REQ-5604-000007', 'sdfdsfdsfa f dsfdsfsfdsfdsf', 'sdfdsfdsfdsfd dsfdsfdsf', 'sfdsfdfdsff', '-1', 'USR-0001', 'fsdafdsfdsf sfdsf dsfdsfdsf dsfdas fs fd ff \nfdsfdsaf dafdasf\n sdfds dsfds afds fasfsdfds fdsaf adsf', '2013-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `status_logs`
--

CREATE TABLE IF NOT EXISTS `status_logs` (
  `id` int(12) DEFAULT NULL,
  `service_code` varchar(50) DEFAULT NULL,
  `change_date` date DEFAULT NULL,
  `chagne_time` time DEFAULT NULL,
  `old_status` char(1) DEFAULT NULL,
  `new_status` char(1) DEFAULT NULL,
  `user_id` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`code`),
  KEY `idx_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=913 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `code`, `name`, `address`, `contact_name`, `telephone`, `fax`, `email`) VALUES
(911, 'SUP-0001', 'บริษัท MBC Computer จำกัด', '191 หมู่ 3 ต.ตลาด อ.เมือง จ.มหาสารคาม33', 'คุณพรนภา มุ่งเจิรญ33', '043777898, 0819090878', '04378922333', 'mbc@mbc.com33'),
(912, 'SUP-0002', 'ร้าน มาย คอมพิวเตอร์', '123 หมู่ 5 ต.นาสีนวน อ.กันทรวิชัย จ.มหาสารคาม', 'คุณนครินทร์ ใจมั่น', '043789334', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `user_type` char(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `user_status` char(1) DEFAULT '2',
  `owner_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_code`,`username`),
  KEY `idx_username` (`username`) USING BTREE,
  KEY `idx_owner` (`owner_code`),
  KEY `idx_user_code` (`user_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_code`, `username`, `password`, `fullname`, `user_type`, `last_login`, `user_status`, `owner_code`) VALUES
(1, 'USR-0001', 'monalisa', 'e10adc3949ba59abbe56e057f20f883e', 'นายไวพจน์ นามวงศ์', '1', NULL, '1', NULL),
(2, 'USR-0002', 'satit', 'e10adc3949ba59abbe56e057f20f883e', 'นายพิทักษ์พงษ์ บุตราช', '2', NULL, '1', NULL),
(3, 'USR-0003', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'นายวัฒนา ฉิมพลี', '3', NULL, '1', NULL),
(21, 'USR-0004', 'pornchai', 'e10adc3949ba59abbe56e057f20f883e', 'พรชัย ทวะศรี', '2', NULL, '1', NULL),
(22, 'USR-000001', 'xxxx', 'e10adc3949ba59abbe56e057f20f883e', 'xxxxxxx xxxx', '2', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `type_code` int(3) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`type_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`type_code`, `type_name`) VALUES
(1, 'ทั่วไป'),
(2, 'ช่างเทคนิค'),
(3, 'ผู้ดูแลระบบ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
