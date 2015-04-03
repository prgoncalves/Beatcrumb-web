CREATE TABLE `beatcrumb`.`audit_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(256) NULL,
  `date` DATETIME NULL,
  `ip` VARCHAR(45) NULL,
  `action` VARCHAR(245) NULL,
  `message` VARCHAR(245) NULL,
  `data` TEXT NULL,
  PRIMARY KEY (`id`));
