CREATE TABLE `module` (
  `module_id` varchar(20) NOT NULL,
  `module_name` varchar(265) NOT NULL,
  `defaultCntrl` varchar(256) DEFAULT NULL,
  `class` varchar(36) DEFAULT NULL,
  `module_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `user_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` varchar(20) NOT NULL,
  `access` varchar(128) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;