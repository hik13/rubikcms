CREATE TABLE `content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status_id` smallint(6) NOT NULL DEFAULT '1',
  `locale_id` smallint(6) NOT NULL,
  `created` bigint(12) NOT NULL,
  `creator_id` smallint(6) NOT NULL,
  `edition` bigint(12) NOT NULL,
  `editor_id` smallint(6) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `meta_keywords` varchar(1024) DEFAULT NULL,
  `meta_text` varchar(1024) DEFAULT NULL,
  `content` mediumtext,
  `textlink` varchar(255) NOT NULL,
  `not_show_in_menu` tinyint(1) DEFAULT NULL,
  `empty_link` tinyint(4) DEFAULT NULL,
  `content_order` int(11) NOT NULL,
  `main_page` tinyint(4) DEFAULT NULL,
  `content_nonstructur` tinyint(4) NOT NULL DEFAULT '0',
  `content_hone` varchar(512) NOT NULL,
  `content_redirectlink` varchar(256) NOT NULL,
  PRIMARY KEY (`content_id`),
  UNIQUE KEY `textlink` (`textlink`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `content_module_relation` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `relation_content_id` int(11) NOT NULL,
  `relation_module_id` varchar(20) NOT NULL,
  `relation_module_object_id` int(11) NOT NULL,
  `relation_module_condition` text,
  PRIMARY KEY (`relation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `related_content` (
  `related_content_0` int(11) NOT NULL,
  `related_content_1` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `locale` (
  `locale_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `locale_description` varchar(128) NOT NULL,
  `locale_code` varchar(16) NOT NULL,
  `locale_default` tinyint(4) DEFAULT '0',
  `locale_status` tinyint(4) DEFAULT NULL,
  `locale_order` tinyint(4) DEFAULT NULL,
  `locale_prefix_version` tinyint(1) DEFAULT '1',
  `locale_domen_version` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`locale_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;