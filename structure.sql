-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.23-0ubuntu0.20.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table AlgoTel.bookings
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` date NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pending',
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `customer_notes` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cancelled_at` datetime DEFAULT NULL,
  `cancellation_notes` text,
  `staff_notes` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_bookings_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table AlgoTel.booking_items
DROP TABLE IF EXISTS `booking_items`;
CREATE TABLE IF NOT EXISTS `booking_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `booking_id` int NOT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_booking_items_rooms` (`room_id`),
  KEY `FK_booking_items_bookings` (`booking_id`),
  CONSTRAINT `FK_booking_items_bookings` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `FK_booking_items_rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table AlgoTel.rooms
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `max_children` int NOT NULL DEFAULT '0',
  `room_capacity_id` int NOT NULL,
  `room_type_id` int NOT NULL,
  `extra_description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `price_config` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gallery` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `FK_rooms_room_capacities` (`room_capacity_id`),
  KEY `FK_rooms_room_types` (`room_type_id`),
  CONSTRAINT `FK_rooms_room_capacities` FOREIGN KEY (`room_capacity_id`) REFERENCES `room_capacities` (`id`),
  CONSTRAINT `FK_rooms_room_types` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table AlgoTel.room_capacities
DROP TABLE IF EXISTS `room_capacities`;
CREATE TABLE IF NOT EXISTS `room_capacities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `capacity` int NOT NULL,
  `position` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table AlgoTel.room_types
DROP TABLE IF EXISTS `room_types`;
CREATE TABLE IF NOT EXISTS `room_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table AlgoTel.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'customer',
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
