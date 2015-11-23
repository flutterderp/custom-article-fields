CREATE TABLE IF NOT EXISTS `#__content_extras` (
	`id` int(10) unsigned NOT NULL DEFAULT '0',
	`site_share` int(3) NOT NULL DEFAULT '0',
	`extra1` varchar(255) NOT NULL DEFAULT '',
	`extra2` varchar(255) NOT NULL DEFAULT '',
	`extra3` varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 ENGINE=InnoDB AUTO_INCREMENT=1;