USE onelink;

CREATE TABLE IF NOT EXISTS `onelink`.`user_details` ( `user_id` BIGINT NOT NULL AUTO_INCREMENT ,  `username` VARCHAR(255) NOT NULL ,  `email` VARCHAR(255) NOT NULL ,  `password` VARCHAR(255) NOT NULL ,  `last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,    PRIMARY KEY  (`user_id`),    UNIQUE  (`username`)) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `onelink`.`url_table` ( `url_id` BIGINT NOT NULL AUTO_INCREMENT , `user_id` BIGINT NOT NULL , `username` VARCHAR(255) NOT NULL , `title` VARCHAR(255) NOT NULL , `url` TEXT NOT NULL , `visibility` BOOLEAN NOT NULL , `last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`url_id`), INDEX (`user_id`), INDEX (`username`)) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `onelink`.`analytics` ( `analytic_id` BIGINT NOT NULL AUTO_INCREMENT , `url_id` BIGINT NOT NULL , `platform` VARCHAR(255) NOT NULL , `browser` VARCHAR(255) NOT NULL , `time_visited` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`analytic_id`), INDEX (`url_id`)) ENGINE = InnoDB;
