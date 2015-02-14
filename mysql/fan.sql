CREATE TABLE `fan` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `terms` tinyint(1) DEFAULT NULL,
  `activated` ENUM('Yes','No') NULL DEFAULT 'No',
  `uuid` VARCHAR(128) NULL,   
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8
