CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(128) NOT NULL,
  `banner_desc` varchar(512) DEFAULT NULL,
  `banner_position_id` int(11) NOT NULL,
  `banner_pattern` varchar(512) DEFAULT '{banner}',
  `banner_url` varchar(128) DEFAULT NULL,
  `banner_type` int(2) DEFAULT NULL,
  `banner_order` int(11) DEFAULT NULL,
  `banner_created` int(11) DEFAULT NULL,
  `banner_creator_id` bigint(12) DEFAULT NULL,
  `banner_edition` int(11) DEFAULT NULL,
  `banner_editor_id` bigint(12) DEFAULT NULL,
  `banner_date_to` bigint(12) DEFAULT NULL,
  `banner_priority` int(12) NOT NULL DEFAULT '1',
  `banner_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `block` (
  `block_id` int(11) NOT NULL AUTO_INCREMENT,
  `block_name` varchar(128) NOT NULL,
  `block_desk` varchar(512) DEFAULT NULL,
  `block_position_id` int(11) NOT NULL,
  `block_content` text,
  `block_dependies` text,
  `block_order` int(11) DEFAULT NULL,
  `created` bigint(12) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `edition` bigint(12) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `block_system` tinyint(4) DEFAULT NULL,
  `block_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `block_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_code` varchar(64) NOT NULL,
  `position_desk` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`position_id`),
  UNIQUE KEY `position_code` (`position_code`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `content_block_relation` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `relation_content_id` int(11) DEFAULT NULL,
  `relation_block_id` int(11) DEFAULT NULL,
  `relation_block_type` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`relation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;