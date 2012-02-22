

DROP TABLE IF EXISTS `banner`;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `block`;

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



DROP TABLE IF EXISTS `block_position`;

CREATE TABLE `block_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_code` varchar(64) NOT NULL,
  `position_desk` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`position_id`),
  UNIQUE KEY `position_code` (`position_code`),
  UNIQUE KEY `position_code_2` (`position_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog`;

CREATE TABLE `catalog` (
  `catalog_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_name` varchar(256) DEFAULT NULL,
  `catalog_status_id` int(11) DEFAULT NULL,
  `catalog_version_id` int(11) DEFAULT NULL,
  `catalog_display_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`catalog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_category`;

CREATE TABLE `catalog_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_catalog_id` int(11) NOT NULL,
  `category_parent_id` int(11) NOT NULL,
  `category_locale_id` tinyint(4) NOT NULL,
  `category_status_id` tinyint(4) NOT NULL,
  `category_parent_visible` tinyint(1) DEFAULT NULL,
  `category_name` varchar(256) NOT NULL,
  `category_description` varchar(256) DEFAULT NULL,
  `category_meta_description` varchar(300) DEFAULT NULL,
  `category_meta_keywords` varchar(300) DEFAULT NULL,
  `category_page_title` varchar(300) DEFAULT NULL,
  `created` bigint(12) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `edition` bigint(12) NOT NULL,
  `editor_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_dimension`;

CREATE TABLE `catalog_dimension` (
  `dimension_id` int(11) NOT NULL AUTO_INCREMENT,
  `dimension_group_id` int(11) NOT NULL,
  `dimension_name` varchar(200) DEFAULT NULL,
  `dimension_cut` varchar(10) DEFAULT NULL,
  `dimension_coefficient` float(9,4) DEFAULT NULL,
  `dimension_base` tinyint(4) NOT NULL,
  PRIMARY KEY (`dimension_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_dimension_group`;

CREATE TABLE `catalog_dimension_group` (
  `dimension_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `dimension_group_locale_id` int(11) DEFAULT NULL,
  `dimension_group_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`dimension_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_essence`;

CREATE TABLE `catalog_essence` (
  `essence_id` int(11) NOT NULL AUTO_INCREMENT,
  `essence_catalog_id` int(11) NOT NULL,
  `essence_parent_id` int(11) NOT NULL,
  `essence_locale_id` tinyint(4) NOT NULL,
  `essence_status_id` tinyint(4) NOT NULL,
  `essence_parent_visible` tinyint(1) DEFAULT NULL,
  `essence_name` varchar(256) NOT NULL,
  `essence_description` varchar(256) DEFAULT NULL,
  `essence_meta_description` varchar(300) DEFAULT NULL,
  `essence_meta_keywords` varchar(300) DEFAULT NULL,
  `essence_page_title` varchar(300) DEFAULT NULL,
  `essence_order` int(11) DEFAULT NULL,
  `created` bigint(12) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `edition` bigint(12) NOT NULL,
  `editor_id` int(11) NOT NULL,
  PRIMARY KEY (`essence_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_item`;

CREATE TABLE `catalog_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_parent_id` int(11) NOT NULL,
  `item_manufacturer_id` int(11) DEFAULT NULL,
  `item_locale_id` tinyint(4) NOT NULL,
  `item_status_id` tinyint(4) NOT NULL,
  `item_name` varchar(256) NOT NULL,
  `item_short_description` varchar(256) DEFAULT NULL,
  `item_full_description` varchar(1500) DEFAULT NULL,
  `item_description` varchar(256) DEFAULT NULL,
  `item_meta_description` varchar(300) DEFAULT NULL,
  `item_meta_keywords` varchar(300) DEFAULT NULL,
  `item_page_title` varchar(300) DEFAULT NULL,
  `item_rating` varchar(300) DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  `created` bigint(12) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `edition` bigint(12) NOT NULL,
  `editor_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_item_images`;

CREATE TABLE `catalog_item_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `image_name` varchar(84) DEFAULT NULL,
  `image_order` int(11) DEFAULT NULL,
  `image_main` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_manufacturer`;

CREATE TABLE `catalog_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` text NOT NULL,
  `manufacturer_letter` varchar(10) NOT NULL,
  PRIMARY KEY (`manufacturer_id`),
  FULLTEXT KEY `manufacturer_name` (`manufacturer_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_parameter`;

CREATE TABLE `catalog_parameter` (
  `parameter_id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter_group_id` int(11) NOT NULL,
  `parameter_essence_id` int(11) NOT NULL,
  `parameter_type_id` tinyint(4) NOT NULL,
  `parameter_number_id` tinyint(4) NOT NULL,
  `parameter_work_id` tinyint(4) NOT NULL,
  `parameter_name` varchar(300) NOT NULL,
  `parameter_short_name` varchar(100) DEFAULT NULL,
  `parameter_description` varchar(2000) NOT NULL,
  `parameter_order` int(11) NOT NULL,
  `parameter_key_sort` tinyint(1) DEFAULT '0',
  `parameter_primary_sort` tinyint(1) DEFAULT '0',
  `parameter_joint_id` int(11) DEFAULT NULL,
  `parameter_slave_id` int(11) DEFAULT NULL,
  `parameter_dimension_id` int(11) DEFAULT NULL,
  `parameter_separator` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`parameter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_parameter_group`;

CREATE TABLE `catalog_parameter_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_essence_id` int(11) NOT NULL,
  `group_name` varchar(300) NOT NULL,
  `group_order` int(11) NOT NULL,
  `group_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_parameter_master_value`;

CREATE TABLE `catalog_parameter_master_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter_id` int(11) DEFAULT NULL,
  `master_value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_selectable`;

CREATE TABLE `catalog_selectable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parameter` int(11) DEFAULT NULL,
  `selectable_literal` varchar(256) DEFAULT NULL,
  `selectable_numerical` float(11,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS `catalog_value_boolean`;

CREATE TABLE `catalog_value_boolean` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `parameter_id` int(11) DEFAULT NULL,
  `value` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_value_common`;

CREATE TABLE `catalog_value_common` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `parameter_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_value_literal_uniq`;

CREATE TABLE `catalog_value_literal_uniq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `parameter_id` int(11) DEFAULT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `catalog_value_numerical_uniq`;

CREATE TABLE `catalog_value_numerical_uniq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `parameter_id` int(11) DEFAULT NULL,
  `value` float(11,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `content`;

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



DROP TABLE IF EXISTS `content_block_relation`;

CREATE TABLE `content_block_relation` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `relation_content_id` int(11) DEFAULT NULL,
  `relation_block_id` int(11) DEFAULT NULL,
  `relation_block_type` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`relation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `content_module_relation`;

CREATE TABLE `content_module_relation` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `relation_content_id` int(11) NOT NULL,
  `relation_module_id` varchar(20) NOT NULL,
  `relation_module_object_id` int(11) NOT NULL,
  `relation_module_condition` text,
  PRIMARY KEY (`relation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `feeds`;

CREATE TABLE `feeds` (
  `feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_name` varchar(256) DEFAULT NULL,
  `category` varchar(1024) DEFAULT NULL,
  `template` text,
  `on_page` int(11) NOT NULL,
  `sort_by` varchar(64) NOT NULL,
  `feed_rss` text,
  `feed_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`feed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `feeds_object`;

CREATE TABLE `feeds_object` (
  `feed_object_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `locale_id` int(11) NOT NULL,
  `feed_object_name` varchar(256) NOT NULL,
  `created` bigint(12) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `edition` bigint(12) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `feed_object_category` text,
  `object_order` int(11) NOT NULL,
  PRIMARY KEY (`feed_object_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `feeds_object_value`;

CREATE TABLE `feeds_object_value` (
  `feed_object_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_object_id` int(11) DEFAULT NULL,
  `field_feed_id` int(11) DEFAULT NULL,
  `field_feed_value` text,
  PRIMARY KEY (`feed_object_value_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `field_feeds`;

CREATE TABLE `field_feeds` (
  `field_feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `field_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`field_feed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `field_feeds_value`;

CREATE TABLE `field_feeds_value` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_feed_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `field_value` text,
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `field_type`;

CREATE TABLE `field_type` (
  `field_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`field_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `field_type_property`;

CREATE TABLE `field_type_property` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_name_id` varchar(36) DEFAULT NULL,
  `field_type_id` int(11) NOT NULL,
  `property_name` varchar(256) DEFAULT NULL,
  `default_values` text,
  `type_input` varchar(64) DEFAULT NULL,
  `order_field` int(11) DEFAULT NULL,
  `class` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `locale`;

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



DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `module_id` varchar(20) NOT NULL,
  `module_name` varchar(265) NOT NULL,
  `defaultCntrl` varchar(256) DEFAULT NULL,
  `class` varchar(36) DEFAULT NULL,
  `module_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `related_content`;

CREATE TABLE `related_content` (
  `related_content_0` int(11) NOT NULL,
  `related_content_1` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `seo`;

CREATE TABLE `seo` (
  `seo_id` int(11) NOT NULL AUTO_INCREMENT,
  `seo_key` varchar(256) DEFAULT NULL,
  `seo_text` text,
  PRIMARY KEY (`seo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `system_property`;

CREATE TABLE `system_property` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_key` varchar(128) DEFAULT NULL,
  `property_value` text,
  PRIMARY KEY (`property_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `user_group_role`;

CREATE TABLE `user_group_role` (
  `group_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_role_name` varchar(128) DEFAULT NULL,
  `group_permission` text NOT NULL,
  `group_desk` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`group_role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `user_permission`;

CREATE TABLE `user_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` varchar(20) NOT NULL,
  `access` varchar(128) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `user_table`;

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

INSERT INTO `locale` (`locale_id`, `locale_description`, `locale_code`, `locale_default`,`locale_status`, `locale_order`) VALUES 
  (1,'English','en',1,1,1);
COMMIT;

INSERT INTO `system_property` (`property_id`, `property_key`,`property_value`) VALUES 
  (1,'defaultLocaleId',1),
  (2,'defaultLocaleCode','en');
COMMIT;

INSERT INTO `field_type_property` (`property_id`, `property_name_id`, `field_type_id`, `property_name`, `default_values`, `type_input`, `order_field`, `class`) VALUES 
  (1,'editor',2,'feedmanagerBuildedEditor','1','checkBox',3,'checkbox'),
  (2,'imagewidth',4,'feedmanagerImageWidth',NULL,'textField',3,NULL),
  (3,'imageheight',4,'feedmanagerImageHeight',NULL,'textField',4,NULL),
  (4,'file_size',5,'feedmanagerFileSize',NULL,'textField',3,NULL),
  (5,'name',1,'feedmanagerNameField',NULL,'textField',1,NULL),
  (6,'name',2,'feedmanagerNameField',NULL,'textField',1,NULL),
  (7,'name',3,'feedmanagerNameField',NULL,'textField',1,NULL),
  (8,'name',4,'feedmanagerNameField',NULL,'textField',1,NULL),
  (9,'name',5,'feedmanagerNameField',NULL,'textField',1,NULL),
  (10,'template_name',2,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (11,'template_name',3,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (12,'template_name',4,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (13,'template_name',1,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (14,'template_name',5,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (15,'link_to_full',1,'feedmanagerLinkOnFull','0','checkBox',3,'checkbox'),
  (16,'tiezer',2,'feedmanagerTiser','0','checkBox',4,'checkbox'),
  (17,'time_format',3,'feedmanagerFormatTime','a:3:{s:5:\"Y-m-d\";s:10:\"YYYY-MM-DD\";s:5:\"d-m-Y\";s:10:\"DD-MM-YYYY\";s:13:\"Y-m-d - H:i:s\";s:21:\"DD-MM-YYYY - HH:MM:SS\";}','dropDownList',3,NULL),
  (18,'file_name_link',5,'feedmanagerFileNameLink',NULL,'textField',4,NULL);
COMMIT;

INSERT INTO `field_type` (`field_type_id`, `field_description`) VALUES 
  (1,'feedmanager_fieldtype_input'),
  (2,'feedmanager_fieldtype_textarea'),
  (3,'feedmanager_fieldtype_date'),
  (4,'feedmanager_fieldtype_picture'),
  (5,'feedmanager_fieldtype_file');


COMMIT;