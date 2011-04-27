
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- session
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `session`;


CREATE TABLE `session`
(
	`id` VARCHAR(40)  NOT NULL,
	`data` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `event`;


CREATE TABLE `event`
(
	`title` VARCHAR(255)  NOT NULL,
	`description` TEXT  NOT NULL,
	`ispublic` TINYINT default 0 NOT NULL,
	`start` DATETIME  NOT NULL,
	`end` DATETIME  NOT NULL,
	`email` VARCHAR(255)  NOT NULL,
	`key` VARCHAR(255)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
