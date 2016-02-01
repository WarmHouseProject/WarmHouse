

DROP TABLE IF EXISTS `wp_image`;
CREATE TABLE `wp_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `original_image_link` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `wp_child`;
CREATE TABLE `wp_child` (
  `child_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_description` tinytext NOT NULL,
  `long_description` longtext NOT NULL,
  `purpose` varchar(255) NOT NULL DEFAULT "",
  `contact_info` varchar(255) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`child_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `child_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `wp_image` (`image_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `wp_orphanage`;
CREATE TABLE `wp_orphanage` (
  `orphanage_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_description` tinytext NOT NULL,
  `long_description` longtext NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL DEFAULT "",
  `image_id` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`orphanage_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `orphanage_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `wp_image` (`image_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `wp_child_settings`;
CREATE TABLE `wp_child_settings` (
  `child_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `show_stat` TINYINT DEFAULT 0,
  PRIMARY KEY (`child_settings_id`),
  KEY `child_id` (`child_id`),
  CONSTRAINT `child_settings_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `wp_child` (`child_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `wp_orphanage_settings`;
CREATE TABLE `wp_orphanage_settings` (
  `orphanage_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `orphanage_id` int(11) NOT NULL,
  `show_stat` TINYINT DEFAULT 0,
  PRIMARY KEY (`orphanage_settings_id`),
  KEY `orphanage_id` (`orphanage_id`),
  CONSTRAINT `orphanage_settings_ibfk_1` FOREIGN KEY (`orphanage_id`) REFERENCES `wp_orphanage` (`orphanage_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `wp_stock`;
CREATE TABLE `wp_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `wp_image` (`image_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;