CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_role_id` int(11) DEFAULT NULL,
  `user_login` varchar(32) DEFAULT NULL,
  `user_password` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `date_registr` bigint(12) DEFAULT NULL,
  `date_lastUpdate` bigint(12) DEFAULT NULL,
  `user_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `user_group_role` (
  `group_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_role_name` varchar(128) DEFAULT NULL,
  `group_permission` text NOT NULL,
  `group_desk` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`group_role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



