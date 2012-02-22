CREATE TABLE `seo` (
  `seo_id` int(11) NOT NULL AUTO_INCREMENT,
  `seo_key` varchar(256) DEFAULT NULL,
  `seo_text` text,
  PRIMARY KEY (`seo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



INSERT INTO `seo` (`seo_id`, `seo_key`, `seo_text`) VALUES 
  (1,'seoMainMetaKeyword',''),
  (2,'seoMainMetaDescription',''),
  (3,'seoCounters','');