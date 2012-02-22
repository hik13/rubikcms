CREATE TABLE `catalog` (
  `catalog_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_name` varchar(256) DEFAULT NULL,
  `catalog_status_id` int(11) DEFAULT NULL,
  `catalog_version_id` int(11) DEFAULT NULL,
  `catalog_display_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`catalog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_dimension` (
  `dimension_id` int(11) NOT NULL AUTO_INCREMENT,
  `dimension_group_id` int(11) NOT NULL,
  `dimension_name` varchar(200) DEFAULT NULL,
  `dimension_cut` varchar(10) DEFAULT NULL,
  `dimension_coefficient` float(9,4) DEFAULT NULL,
  `dimension_base` tinyint(4) NOT NULL,
  PRIMARY KEY (`dimension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_dimension_group` (
  `dimension_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `dimension_group_locale_id` int(11) DEFAULT NULL,
  `dimension_group_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`dimension_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_item_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `image_name` varchar(84) DEFAULT NULL,
  `image_order` int(11) DEFAULT NULL,
  `image_main` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` text NOT NULL,
  `manufacturer_letter` varchar(10) NOT NULL,
  PRIMARY KEY (`manufacturer_id`),
  FULLTEXT KEY `manufacturer_name` (`manufacturer_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_parameter_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_essence_id` int(11) NOT NULL,
  `group_name` varchar(300) NOT NULL,
  `group_order` int(11) NOT NULL,
  `group_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_parameter_master_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter_id` int(11) DEFAULT NULL,
  `master_value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_selectable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parameter` int(11) DEFAULT NULL,
  `selectable_literal` varchar(256) DEFAULT NULL,
  `selectable_numerical` float(11,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_value_boolean` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `parameter_id` int(11) DEFAULT NULL,
  `value` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_value_common` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `parameter_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_value_literal_uniq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `parameter_id` int(11) DEFAULT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `catalog_value_numerical_uniq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `parameter_id` int(11) DEFAULT NULL,
  `value` float(11,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;