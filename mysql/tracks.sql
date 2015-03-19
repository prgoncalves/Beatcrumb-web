CREATE TABLE `beatcrumb`.`tracks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `artist_id` INT NULL,
  `filename` VARCHAR(256) NULL,
  `plays` INT NULL,
  `shares` INT NULL,
  PRIMARY KEY (`id`));