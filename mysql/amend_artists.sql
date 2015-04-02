ALTER TABLE `beatcrumb`.`artist` 
ADD COLUMN `activated` ENUM('Yes','No') NULL DEFAULT 'No' AFTER `terms`,
ADD COLUMN `uuid` VARCHAR(128) NULL AFTER `activated`;
