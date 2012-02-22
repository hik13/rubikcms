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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

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


CREATE TABLE `feeds_object_value` (
  `feed_object_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_object_id` int(11) DEFAULT NULL,
  `field_feed_id` int(11) DEFAULT NULL,
  `field_feed_value` text,
  PRIMARY KEY (`feed_object_value_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



CREATE TABLE `field_feeds` (
  `field_feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) DEFAULT NULL,
  `field_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`field_feed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `field_feeds_value` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_feed_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `field_value` text,
  PRIMARY KEY (`field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `field_type` (
  `field_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`field_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



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
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;



INSERT INTO `field_type` (`field_type_id`, `field_description`) VALUES 
  (1,'feedmanager_fieldtype_input'),
  (2,'feedmanager_fieldtype_textarea'),
  (3,'feedmanager_fieldtype_date'),
  (4,'feedmanager_fieldtype_picture'),
  (5,'feedmanager_fieldtype_file');
  (6,'feedmanager_fieldtype_listdata'),
  (7,'feedmanager_fieldtype_galery');
COMMIT;


INSERT INTO `field_type_property` (`property_id`, `property_name_id`, `field_type_id`, `property_name`, `default_values`, `type_input`, `order_field`, `class`) VALUES 
  (1,'name',1,'feedmanagerNameField',NULL,'textField',1,NULL),
  (2,'template_name',1,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),  
  (3,'link_to_full',1,'feedmanagerLinkOnFull','0','checkBox',3,'checkbox'),
  (4,'name',2,'feedmanagerNameField',NULL,'textField',1,NULL),
  (5,'template_name',2,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (6,'editor',2,'feedmanagerBuildedEditor','1','checkBox',3,'checkbox'),
  (7,'tiezer',2,'feedmanagerTiser','0','checkBox',4,'checkbox'),
  (8,'name',3,'feedmanagerNameField',NULL,'textField',1,NULL),
  (9,'template_name',3,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (10,'time_format',3,'feedmanagerFormatTime','a:3:{s:5:\"Y-m-d\";s:10:\"YYYY-MM-DD\";s:5:\"d-m-Y\";s:10:\"DD-MM-YYYY\";s:13:\"Y-m-d - H:i:s\";s:21:\"DD-MM-YYYY - HH:MM:SS\";}','dropDownList',3,NULL),
  (11,'name',4,'feedmanagerNameField',NULL,'textField',1,NULL),  
  (12,'template_name',4,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),  
  (13,'imagewidth',4,'feedmanagerImageWidth',NULL,'textField',3,NULL),
  (14,'imageheight',4,'feedmanagerImageHeight',NULL,'textField',4,NULL),
  (15,'name',5,'feedmanagerNameField',NULL,'textField',1,NULL),
  (16,'template_name',5,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),  
  (17,'file_size',5,'feedmanagerFileSize',NULL,'textField',3,NULL),
  (18,'file_name_link',5,'feedmanagerFileNameLink',NULL,'textField',4,NULL);
  (19,'name',6,'feedmanagerNameField',NULL,'textField',1,NULL),
  (20,'list_data_add',6,'feedmanagerListData',NULL,'getListData',3,NULL),
  (21,'template_name',6,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (22,'name',7,'feedmanagerNameField',NULL,'textField',1,NULL),
  (23,'template_name',7,'feedmanagerTitleForShablon',NULL,'textField',2,NULL),
  (24,'image_galery_add',7,'feedmanagerImageGalery',NULL,'getImageSize',3,NULL);
COMMIT;
