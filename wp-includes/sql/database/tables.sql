

DROP TABLE IF EXISTS `wp_image`;
CREATE TABLE `wp_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `wp_child`;
CREATE TABLE `wp_child` (
  `child_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_description` tinytext NOT NULL,
  `long_description` longtext NOT NULL,
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
  `image_id` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`orphanage_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `orphanage_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `wp_image` (`image_id`) ON DELETE SET NULL
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