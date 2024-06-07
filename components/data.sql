-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.37 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for vivaaluth
CREATE DATABASE IF NOT EXISTS `vivaaluth` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `vivaaluth`;

-- Dumping structure for table vivaaluth.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_admin_product1_idx` (`product_id`),
  CONSTRAINT `fk_admin_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.admin: ~0 rows (approximately)
INSERT INTO `admin` (`fname`, `lname`, `email`, `password`, `product_id`) VALUES
	('Kavitha', 'Kanchana', 'kavithakgb2003@gmail.com', 'Kavitha@#2003', 0);

-- Dumping structure for table vivaaluth.all_orders
CREATE TABLE IF NOT EXISTS `all_orders` (
  `id` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `order_status_id` int NOT NULL,
  KEY `fk_all_orders_user1_idx` (`user_email`),
  KEY `fk_all_orders_order_status1_idx` (`order_status_id`),
  CONSTRAINT `fk_all_orders_order_status1` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`),
  CONSTRAINT `fk_all_orders_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.all_orders: ~1 rows (approximately)
INSERT INTO `all_orders` (`id`, `user_email`, `order_status_id`) VALUES
	('0k3q0i3x', 'kavithakgb2003@gmail.com', 3),
	('0bso75w6', 'kavithakgb2003@gmail.com', 3),
	('dam39w50', 'kavithakgb2003@gmail.com', 3),
	('ju7a3z33', 'kavithakgb2003@gmail.com', 3),
	('9q3vv36p', 'kavithakgb2003@gmail.com', 2),
	('nc3kc376', 'kavithakgb2003@gmail.com', 1);

-- Dumping structure for table vivaaluth.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `b_id` int NOT NULL AUTO_INCREMENT,
  `b_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.brand: ~2 rows (approximately)
INSERT INTO `brand` (`b_id`, `b_name`) VALUES
	(4, 'Moose'),
	(5, 'Adidas');

-- Dumping structure for table vivaaluth.brand_has_category
CREATE TABLE IF NOT EXISTS `brand_has_category` (
  `category_c_id` int NOT NULL,
  `brand_b_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_category_has_brand_brand1_idx` (`brand_b_id`),
  KEY `fk_category_has_brand_category1_idx` (`category_c_id`),
  CONSTRAINT `fk_category_has_brand_brand1` FOREIGN KEY (`brand_b_id`) REFERENCES `brand` (`b_id`),
  CONSTRAINT `fk_category_has_brand_category1` FOREIGN KEY (`category_c_id`) REFERENCES `category` (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.brand_has_category: ~0 rows (approximately)

-- Dumping structure for table vivaaluth.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cqty` varchar(45) DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.cart: ~3 rows (approximately)
INSERT INTO `cart` (`id`, `cqty`, `product_id`, `user_email`) VALUES
	(58, '2', 16, 'mrjester2003@gmail.com');

-- Dumping structure for table vivaaluth.cashondel_invoice_cart_product
CREATE TABLE IF NOT EXISTS `cashondel_invoice_cart_product` (
  `invoice_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `del_fee` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`) USING BTREE,
  KEY `fk_cashondel_invoice_cart_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_cashondel_invoice_cart_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.cashondel_invoice_cart_product: ~2 rows (approximately)
INSERT INTO `cashondel_invoice_cart_product` (`invoice_id`, `user_email`, `price`, `del_fee`, `date`) VALUES
	('0bso75w6', 'kavithakgb2003@gmail.com', '3500', '                   700', '2024-06-07 16:43:13'),
	('0k3q0i3x', 'kavithakgb2003@gmail.com', '3500', '                   700', '2024-06-07 16:42:41'),
	('dam39w50', 'kavithakgb2003@gmail.com', '3500', '                   700', '2024-06-07 16:47:28'),
	('t5j8s4r6', 'kavithakgb2003@gmail.com', '3500', '                   700', '2024-06-07 16:42:26');

-- Dumping structure for table vivaaluth.cashondel_invoice_single_product
CREATE TABLE IF NOT EXISTS `cashondel_invoice_single_product` (
  `invoice_id` varchar(15) NOT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `del_fee` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_cashondel_invoice_single_product_product1_idx` (`product_id`),
  KEY `fk_cashondel_invoice_single_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_cashondel_invoice_single_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cashondel_invoice_single_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.cashondel_invoice_single_product: ~0 rows (approximately)
INSERT INTO `cashondel_invoice_single_product` (`invoice_id`, `product_id`, `user_email`, `price`, `del_fee`, `date`) VALUES
	('9q3vv36p', 8, 'kavithakgb2003@gmail.com', '750', '500 ', '2024-06-07 16:50:47'),
	('ju7a3z33', 8, 'kavithakgb2003@gmail.com', '750', '500 ', '2024-06-07 16:48:45'),
	('nc3kc376', 8, 'kavithakgb2003@gmail.com', '750', '500 ', '2024-06-07 16:50:57');

-- Dumping structure for table vivaaluth.category
CREATE TABLE IF NOT EXISTS `category` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.category: ~2 rows (approximately)
INSERT INTO `category` (`c_id`, `c_name`) VALUES
	(3, 'Men'),
	(4, 'Women');

-- Dumping structure for table vivaaluth.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) DEFAULT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district1_idx` (`district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.city: ~2 rows (approximately)
INSERT INTO `city` (`id`, `city_name`, `district_id`) VALUES
	(1, 'Nawalapitiya', 1),
	(2, 'Colombo', 2),
	(3, 'Hapugasthalawa', 3);

-- Dumping structure for table vivaaluth.color
CREATE TABLE IF NOT EXISTS `color` (
  `clr_id` int NOT NULL AUTO_INCREMENT,
  `clr_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`clr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.color: ~2 rows (approximately)
INSERT INTO `color` (`clr_id`, `clr_name`) VALUES
	(4, 'Black'),
	(5, 'Red');

-- Dumping structure for table vivaaluth.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province1_idx` (`province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.district: ~2 rows (approximately)
INSERT INTO `district` (`id`, `district_name`, `province_id`) VALUES
	(1, 'Kandy', 1),
	(2, 'Colombo', 2),
	(3, 'Nuwaraeliya', 1);

-- Dumping structure for table vivaaluth.full_address
CREATE TABLE IF NOT EXISTS `full_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `line1` varchar(45) DEFAULT NULL,
  `line2` varchar(45) DEFAULT NULL,
  `city_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `district_id` int NOT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_full_address_city1_idx` (`city_id`),
  KEY `fk_full_address_user1_idx` (`user_email`),
  KEY `fk_full_address_district1_idx` (`district_id`),
  KEY `fk_full_address_province1_idx` (`province_id`),
  CONSTRAINT `fk_full_address_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_full_address_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_full_address_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `fk_full_address_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.full_address: ~2 rows (approximately)
INSERT INTO `full_address` (`id`, `line1`, `line2`, `city_id`, `user_email`, `district_id`, `province_id`) VALUES
	(1, 'awfas ff sfs fd', 'eg rfhgdf hdfhg', 2, 'mrjester2003@gmail.com', 2, 2),
	(4, '868 Deercove Drive', 'wwww', 1, 'kavithakgb2003@gmail.com', 2, 1);

-- Dumping structure for table vivaaluth.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table vivaaluth.men
CREATE TABLE IF NOT EXISTS `men` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_men_product1_idx` (`product_id`),
  CONSTRAINT `fk_men_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.men: ~6 rows (approximately)
INSERT INTO `men` (`id`, `product_id`) VALUES
	(1, 12),
	(2, 13),
	(3, 14),
	(4, 15),
	(5, 16),
	(6, 17);

-- Dumping structure for table vivaaluth.order_status
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.order_status: ~0 rows (approximately)
INSERT INTO `order_status` (`id`, `status`) VALUES
	(1, 'Order Placed'),
	(2, 'Processing'),
	(3, 'Delevered');

-- Dumping structure for table vivaaluth.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `discription` varchar(150) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `aded_date` date DEFAULT NULL,
  `del_fee_col` double DEFAULT NULL,
  `del_fee_other` double DEFAULT NULL,
  `color_clr_id` int NOT NULL,
  `category_c_id` int NOT NULL,
  `brand_b_id` int NOT NULL,
  `status_s_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_color1_idx` (`color_clr_id`),
  KEY `fk_product_category1_idx` (`category_c_id`),
  KEY `fk_product_brand1_idx` (`brand_b_id`),
  KEY `fk_product_status1_idx` (`status_s_id`),
  CONSTRAINT `fk_product_brand1` FOREIGN KEY (`brand_b_id`) REFERENCES `brand` (`b_id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_c_id`) REFERENCES `category` (`c_id`),
  CONSTRAINT `fk_product_color1` FOREIGN KEY (`color_clr_id`) REFERENCES `color` (`clr_id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_s_id`) REFERENCES `status` (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.product: ~18 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `discription`, `title`, `aded_date`, `del_fee_col`, `del_fee_other`, `color_clr_id`, `category_c_id`, `brand_b_id`, `status_s_id`) VALUES
	(1, '1000', '20', 'Girl\'s Hoodie', 'Girls Hoodie', '2024-05-30', 500, 700, 4, 4, 4, 1),
	(2, '1500', '20', 'Top opened Girl\'s Hoodie', 'Top opened Girl\'s Hoodie', '2024-05-30', 500, 700, 4, 4, 5, 1),
	(3, '1200', '20', 'Top', 'Girl\'s Top', '2024-05-30', 500, 700, 4, 4, 5, 1),
	(4, '1000', '20', 'Top', 'Girls Blows', '2024-05-30', 500, 700, 4, 4, 4, 1),
	(5, '1000', '20', 'chuti kalismak ane', 'Chuti kalisama', '2024-05-30', 500, 700, 4, 4, 4, 1),
	(6, '1000', '20', 'mokuth na adan duwannth puluwn echcharai', 'kellage chuti kalisama', '2024-05-30', 500, 700, 4, 4, 4, 1),
	(7, '1200', '20', 'nana kalisamak hlow', 'jundi kalisama', '2024-05-30', 500, 700, 4, 4, 4, 1),
	(8, '750', '20', 'nidiyana kalisama', 'Podda kalisama', '2024-05-30', 500, 700, 5, 4, 4, 1),
	(9, '1350', '20', 'Halalooya kalisama', 'Halalooya', '2024-05-30', 500, 700, 5, 4, 4, 1),
	(10, '3000', '20', 'Full kit for girl\'s', 'Full kit for girl\'s', '2024-05-30', 500, 700, 4, 4, 4, 1),
	(11, '3400', '20', 'Girl Full kit', 'Girl Full kit', '2024-05-30', 500, 700, 4, 4, 5, 1),
	(12, '1300', '20', 'Hoodie for boys', 'Boys Hoodie', '2024-05-30', 500, 700, 4, 3, 5, 1),
	(13, '1500', '20', 'Jean Grey', 'Jean Grey', '2024-05-30', 500, 700, 4, 3, 5, 1),
	(14, '1500', '20', 'Lite Black Jean', 'Lite Black Jean', '2024-05-30', 500, 700, 4, 3, 4, 1),
	(15, '1400', '20', 'Jean for boy', 'Jean for boy', '2024-05-30', 500, 700, 4, 3, 5, 1),
	(16, '1700', '20', 'Coat for boy', 'Coat for boy', '2024-05-30', 500, 700, 5, 3, 4, 1),
	(17, '2000', '20', 'Shirt for boys', 'Shirt for boys', '2024-05-30', 500, 700, 4, 3, 5, 1),
	(20, '1500', '20', 'Girl kalisama', 'Girl kalisama', '2024-06-07', 500, 700, 5, 3, 5, 1);

-- Dumping structure for table vivaaluth.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `path` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.product_img: ~18 rows (approximately)
INSERT INTO `product_img` (`path`, `product_id`) VALUES
	('components/cloth_img/w-1.jpg', 1),
	('components/cloth_img/w-2.jpg', 2),
	('components/cloth_img/w-3.jpg', 3),
	('components/cloth_img/w-4.jpg', 4),
	('components/cloth_img/w-5.jpg', 5),
	('components/cloth_img/w-6.jpg', 6),
	('components/cloth_img/w-7.jpg', 7),
	('components/cloth_img/w-8.jpg', 8),
	('components/cloth_img/w-9.jpg', 9),
	('components/cloth_img/w-10.jpg', 10),
	('components/cloth_img/w-11.jpg', 11),
	('components/cloth_img/m-1.jpg', 12),
	('components/cloth_img/m-2.jpg', 13),
	('components/cloth_img/m-3.jpg', 14),
	('components/cloth_img/m-4.jpg', 15),
	('components/cloth_img/m-5.jpg', 16),
	('components/cloth_img/m-6.jpg', 17),
	('components/cloth_img/Girl kalisama_6662ef2d959c7.jpeg', 20);

-- Dumping structure for table vivaaluth.profile_img
CREATE TABLE IF NOT EXISTS `profile_img` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.profile_img: ~0 rows (approximately)

-- Dumping structure for table vivaaluth.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.province: ~8 rows (approximately)
INSERT INTO `province` (`id`, `province_name`) VALUES
	(1, 'Central'),
	(2, 'Western'),
	(3, 'Eastern'),
	(4, 'North Central'),
	(5, 'Northern'),
	(6, 'North Western'),
	(7, 'Southern'),
	(8, 'Uva');

-- Dumping structure for table vivaaluth.status
CREATE TABLE IF NOT EXISTS `status` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `s_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.status: ~2 rows (approximately)
INSERT INTO `status` (`s_id`, `s_name`) VALUES
	(1, 'Avalable'),
	(2, 'Out Of Stock');

-- Dumping structure for table vivaaluth.trending
CREATE TABLE IF NOT EXISTS `trending` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trending_product1_idx` (`product_id`),
  CONSTRAINT `fk_trending_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.trending: ~4 rows (approximately)
INSERT INTO `trending` (`id`, `product_id`) VALUES
	(2, 5),
	(3, 7),
	(5, 8),
	(4, 9);

-- Dumping structure for table vivaaluth.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `gender_id` int NOT NULL,
  `joined_date` date DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.user: ~2 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile`, `status`, `gender_id`, `joined_date`) VALUES
	('Kavitha', 'Kanchana', 'kavithakgb2003@gmail.com', 'Kavitha@#2003', '0716538198', 1, 1, '2024-06-06'),
	('Kavitha', 'Kanchana', 'mrjester2003@gmail.com', 'Kavitha@#2003', '0702011540', 1, 1, '2024-06-06');

-- Dumping structure for table vivaaluth.wishlist
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wishlist_product1_idx` (`product_id`),
  KEY `fk_wishlist_user1_idx` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.wishlist: ~1 rows (approximately)

-- Dumping structure for table vivaaluth.women
CREATE TABLE IF NOT EXISTS `women` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_women_product1_idx` (`product_id`),
  CONSTRAINT `fk_women_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table vivaaluth.women: ~11 rows (approximately)
INSERT INTO `women` (`id`, `product_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6),
	(7, 7),
	(8, 8),
	(9, 9),
	(10, 10),
	(11, 11);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
