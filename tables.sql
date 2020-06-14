CREATE TABLE `soilyze`.`users` ( `id` BIGINT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `username` VARCHAR(50) NOT NULL , `password` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `soilyze`.`crops` ( `id` BIGINT NOT NULL AUTO_INCREMENT , `name` VARCHAR(200) NOT NULL , `type` VARCHAR(200) NOT NULL , `ph_low` FLOAT NOT NULL , `ph_high` FLOAT NOT NULL , `n` VARCHAR(200) NOT NULL , `p` VARCHAR(200) NOT NULL , `k` VARCHAR(200) NOT NULL , `description` TEXT NOT NULL , `fertilizer` TEXT NOT NULL , `external_link` VARCHAR(400) NOT NULL , `image_src` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;