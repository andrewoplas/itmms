-- -------------------------------------------------------------
-- TablePlus 5.9.6(546)
--
-- https://tableplus.com/
--
-- Database: itmms
-- Generation Time: 2024-04-03 09:02:04.4080
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE `classrooms` (
  `classroom_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cluster_id` int(11) NOT NULL,
  PRIMARY KEY (`classroom_id`),
  KEY `room_id` (`room_id`),
  KEY `cluster_id` (`cluster_id`),
  CONSTRAINT `classrooms_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE,
  CONSTRAINT `classrooms_ibfk_2` FOREIGN KEY (`cluster_id`) REFERENCES `clusters` (`cluster_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `clusters`;
CREATE TABLE `clusters` (
  `cluster_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `cluster_code` varchar(255) NOT NULL,
  `cluster_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`cluster_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `clusters_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `computer_designation`;
CREATE TABLE `computer_designation` (
  `computer_id` int(11) NOT NULL,
  `designation_type` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `workstation_no` int(11) NOT NULL,
  `assigned_to` varchar(255) NOT NULL,
  `date_assigned` varchar(255) NOT NULL,
  PRIMARY KEY (`computer_id`),
  CONSTRAINT `computer_designation_ibfk_1` FOREIGN KEY (`computer_id`) REFERENCES `computers` (`computer_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `computer_parts`;
CREATE TABLE `computer_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `computer_id` int(11) NOT NULL,
  `parts_name` varchar(255) NOT NULL,
  `parts_type` varchar(255) NOT NULL,
  `depreciation_value` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `computer_part` (`computer_id`),
  CONSTRAINT `computer_part` FOREIGN KEY (`computer_id`) REFERENCES `computers` (`computer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `computer_resources`;
CREATE TABLE `computer_resources` (
  `resource_id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `order` int(11) NOT NULL,
  PRIMARY KEY (`resource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `computers`;
CREATE TABLE `computers` (
  `computer_id` int(11) NOT NULL AUTO_INCREMENT,
  `computer_name` varchar(255) NOT NULL,
  `computer_type` varchar(255) NOT NULL,
  `brand_clone_name` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`computer_id`),
  UNIQUE KEY `computer_name` (`computer_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `itmms_sessions`;
CREATE TABLE `itmms_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` int(11) NOT NULL,
  `computer_name` varchar(255) NOT NULL,
  `activities` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `service_order`;
CREATE TABLE `service_order` (
  `ref_no` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `cluster_id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `complaint_resource_id` int(11) NOT NULL,
  `complaint_details` varchar(255) NOT NULL,
  `computer_name` varchar(255) NOT NULL,
  `if_pulled_out` tinyint(1) NOT NULL,
  `is_urgent` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ref_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `service_order_acceptance`;
CREATE TABLE `service_order_acceptance` (
  `ref_no` int(11) NOT NULL,
  `received_by` varchar(255) DEFAULT NULL,
  `assigned_to` int(255) NOT NULL,
  `designate_to` int(225) DEFAULT NULL,
  `date_reported` varchar(255) NOT NULL,
  `time_reported` varchar(255) NOT NULL,
  PRIMARY KEY (`ref_no`),
  CONSTRAINT `service_order_acceptance_ibfk_1` FOREIGN KEY (`ref_no`) REFERENCES `service_order` (`ref_no`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `service_order_completion`;
CREATE TABLE `service_order_completion` (
  `ref_no` int(11) NOT NULL,
  `date_finished` varchar(255) DEFAULT NULL,
  `time_finished` varchar(255) DEFAULT NULL,
  `date_replaced` varchar(2555) NOT NULL,
  `time_replaced` varchar(255) NOT NULL,
  `completed_by` int(11) NOT NULL,
  `unit_status` varchar(255) NOT NULL DEFAULT 'under repair',
  `action_taken` varchar(255) DEFAULT NULL,
  `returned_to` varchar(255) DEFAULT NULL,
  `property_clerk` varchar(255) DEFAULT NULL,
  `property_date_received` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'received',
  `part_id` int(11) DEFAULT NULL COMMENT 'ID of the part that is replaced',
  `part_name` varchar(255) DEFAULT NULL,
  `epr_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ref_no`),
  KEY `part_id` (`part_id`),
  CONSTRAINT `service_order_completion_ibfk_1` FOREIGN KEY (`ref_no`) REFERENCES `service_order` (`ref_no`) ON DELETE CASCADE,
  CONSTRAINT `service_order_completion_ibfk_2` FOREIGN KEY (`part_id`) REFERENCES `computer_parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `service_order_timeline`;
CREATE TABLE `service_order_timeline` (
  `ref_no` int(11) NOT NULL,
  `if_inverted` tinyint(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ref_no`),
  CONSTRAINT `service_order_timeline_ibfk_1` FOREIGN KEY (`ref_no`) REFERENCES `service_order` (`ref_no`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `access_rights` varchar(255) DEFAULT NULL,
  `cluster_id` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'assets/images/avatars/default_profile.png',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `contact_no` varchar(255) DEFAULT NULL,
  `last_login` varchar(255) DEFAULT NULL,
  `if_pass_changed` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `users` (`id`, `emp_id`, `password`, `firstname`, `lastname`, `user_type`, `access_rights`, `cluster_id`, `avatar`, `status`, `contact_no`, `last_login`, `if_pass_changed`, `date_added`) VALUES
(1, 'CIT1041', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Jonathan ', 'Pacana', 'superadmin', 'ultimate_control', '1', 'assets/images/avatars/default_profile.png', 'active', '111', '2024-04-03 01:52:44', 0, '2018-02-16 22:49:27'),
(2, 'CIT101', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Tsg', 'Test', 'viewer', 'view', '1', 'assets/images/avatars/default_profile.png', 'active', '111', '2024-03-16 12:08:20', 0, '2016-10-18 04:52:40'),
(3, 'CIT123', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Ethan', 'Pacana', 'encoder', 'add', '1', 'assets/images/avatars/default_profile.png', 'active', '111', '2024-03-16 12:07:53', 0, '2020-03-03 19:10:40'),
(4, 'CIT1318', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Bebeth', 'Ricardel', 'encoder', 'add', '2', 'assets/images/avatars/default_profile.png', 'active', '178', NULL, 0, '2024-03-14 10:49:57'),
(5, 'CIT1708', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Madelline', 'Rico', 'encoder', 'add', '3', 'assets/images/avatars/default_profile.png', 'active', '136', '2024-03-14 04:40:35', 0, '2024-03-14 11:07:03'),
(6, 'CIT1057', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Dexter', 'Cabije', 'administrator', 'full_control', '1', 'assets/images/avatars/default_profile.png', 'active', '111', NULL, 0, '2024-03-14 11:27:22'),
(7, 'CIT1043', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Brian', 'Ferolino', 'administrator', 'full_control', '1', 'assets/images/avatars/default_profile.png', 'active', '193', NULL, 0, '2024-03-14 11:28:06'),
(8, 'CIT1056', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Angelo', 'Ilagan', 'administrator', 'full_control', '1', 'assets/images/avatars/default_profile.png', 'active', '193', NULL, 0, '2024-03-14 11:28:40'),
(9, 'CIT1873', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Celso', 'Luspoc', 'administrator', 'full_control', '1', 'assets/images/avatars/default_profile.png', 'active', '111', NULL, 0, '2024-03-14 11:29:10'),
(10, 'CIT225', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Rolando', 'Tindoy', 'administrator', 'full_control', '1', 'assets/images/avatars/default_profile.png', 'active', '111', NULL, 0, '2024-03-14 11:29:28'),
(11, 'CIT2019', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Gabriel', 'Sopsop', 'administrator', 'full_control', '1', 'assets/images/avatars/default_profile.png', 'active', '111', NULL, 0, '2024-03-14 11:29:58');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;