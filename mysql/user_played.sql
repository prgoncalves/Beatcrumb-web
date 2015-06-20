CREATE TABLE `user_played` (
  `uuid` VARCHAR(512) NULL,
  `track_id` INT(11),
  `plays` INT(11),
  `shares` INT(11),
  `playable` ENUM('Yes','No') NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8