CREATE TABLE `beatcrumb`.`inbox` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `track_id` INT NULL,
  `uuid` VARCHAR(512) NULL,
  `available` ENUM('yes','no') NULL DEFAULT 'no',
  `shared` INT NULL,
  `read` ENUM('yes','no') NULL DEFAULT 'no',
  `timestamp` TIMESTAMP NULL,
  `message` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));