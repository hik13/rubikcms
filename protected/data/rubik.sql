# SQL Manager 2007 for MySQL 4.1.1.3
# ---------------------------------------
# Host     : qvm-lsh.qulix.com
# Port     : 3306
# Database : rubik


SET FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS `rubik`;

CREATE DATABASE `rubik`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `rubik`;

#
# Structure for the `content_css` table : 
#

CREATE TABLE `content_css` (
  `relationship_id` int(11) NOT NULL AUTO_INCREMENT,
  `razdel_id` int(11) NOT NULL,
  `css_id` int(11) NOT NULL,
  PRIMARY KEY (`relationship_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Structure for the `content_java` table : 
#

CREATE TABLE `content_java` (
  `relationship_id` int(11) NOT NULL AUTO_INCREMENT,
  `razdel_id` int(11) NOT NULL,
  `java_id` int(11) NOT NULL,
  PRIMARY KEY (`relationship_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

#
# Structure for the `content_module` table : 
#

CREATE TABLE `content_module` (
  `relationship_id` int(11) NOT NULL AUTO_INCREMENT,
  `razdel_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `module_order` int(11) NOT NULL,
  `module_position` int(11) DEFAULT NULL,
  PRIMARY KEY (`relationship_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Structure for the `css` table : 
#

CREATE TABLE `css` (
  `css_id` int(11) NOT NULL AUTO_INCREMENT,
  `css_name` varchar(128) NOT NULL,
  `css_link` varchar(256) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`css_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Structure for the `image_status` table : 
#

CREATE TABLE `image_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_deskription` varchar(64) DEFAULT NULL,
  `status_tdesk` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Structure for the `java` table : 
#

CREATE TABLE `java` (
  `java_id` int(11) NOT NULL AUTO_INCREMENT,
  `java_name` varchar(64) NOT NULL,
  `java_src` varchar(256) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`java_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

#
# Structure for the `locale_translation` table : 
#

CREATE TABLE `locale_translation` (
  `translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `locale_id` int(11) NOT NULL,
  `locale_version` varchar(10) NOT NULL,
  `locale_desk` text NOT NULL,
  PRIMARY KEY (`translation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

#
# Structure for the `mobile_extension` table : 
#

CREATE TABLE `mobile_extension` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `extension_name` varchar(64) DEFAULT NULL,
  `extension_heigth` int(11) DEFAULT NULL,
  `extension_width` int(11) DEFAULT NULL,
  `extension_style` tinyint(4) DEFAULT NULL,
  `extension_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Structure for the `module` table : 
#

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(64) NOT NULL,
  `module_link` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Structure for the `modules_orientation` table : 
#

CREATE TABLE `modules_orientation` (
  `orient_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_uid` int(11) NOT NULL,
  `desk_uid` int(11) NOT NULL,
  `desk` int(11) NOT NULL,
  PRIMARY KEY (`orient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `portfolio_image` table : 
#

CREATE TABLE `portfolio_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `work_id` int(11) NOT NULL,
  `type_images` tinyint(4) NOT NULL DEFAULT '1',
  `just_portfolio` tinyint(4) NOT NULL DEFAULT '0',
  `slider_portfolio` tinyint(4) DEFAULT '0',
  `slider_main` tinyint(4) NOT NULL DEFAULT '0',
  `order_image` tinyint(4) NOT NULL DEFAULT '0',
  `name_image` varchar(128) DEFAULT NULL,
  `image_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=922 DEFAULT CHARSET=utf8;

#
# Structure for the `portfolio_work` table : 
#

CREATE TABLE `portfolio_work` (
  `work_id` int(11) NOT NULL AUTO_INCREMENT,
  `work_type_id` tinyint(4) DEFAULT NULL,
  `order_all` smallint(6) DEFAULT NULL,
  `order_type` smallint(6) DEFAULT NULL,
  `work_name_ru` varchar(150) NOT NULL,
  `work_name_desk_ru` varchar(200) DEFAULT NULL,
  `work_deskription_ru` varchar(400) DEFAULT NULL,
  `work_name_en` varchar(150) DEFAULT NULL,
  `work_name_desk_en` varchar(200) DEFAULT NULL,
  `work_deskription_en` varchar(400) DEFAULT NULL,
  `work_link` varchar(100) DEFAULT NULL,
  `work_link_en` varchar(100) DEFAULT NULL,
  `work_link_desk` varchar(100) DEFAULT NULL,
  `work_link_desk_en` varchar(100) DEFAULT NULL,
  `work_version` tinyint(4) DEFAULT NULL,
  `work_meta_deskription` varchar(300) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

#
# Structure for the `position_module` table : 
#

CREATE TABLE `position_module` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_deskription` varchar(128) NOT NULL,
  `position_mindesk` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Structure for the `razdel` table : 
#

CREATE TABLE `razdel` (
  `razdel_id` int(11) NOT NULL AUTO_INCREMENT,
  `razdel_link` varchar(64) NOT NULL,
  `razdel_class` varchar(64) DEFAULT NULL,
  `razdel_order` smallint(6) NOT NULL,
  PRIMARY KEY (`razdel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Structure for the `razdel_localization` table : 
#

CREATE TABLE `razdel_localization` (
  `localization_id` int(11) NOT NULL AUTO_INCREMENT,
  `razdel_id` int(11) NOT NULL,
  `version_id` tinyint(4) NOT NULL,
  `razdel_title` varchar(256) NOT NULL,
  `razdel_name` varchar(256) NOT NULL,
  `razdel_meta_desk` varchar(256) DEFAULT NULL,
  `razdel_meta_keyw` varchar(256) DEFAULT NULL,
  `razdel_h1` varchar(256) DEFAULT NULL,
  `razdel_content` text NOT NULL,
  `razdel_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`localization_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Structure for the `razdel_test` table : 
#

CREATE TABLE `razdel_test` (
  `razdel_id` int(11) NOT NULL AUTO_INCREMENT,
  `razdel_link` varchar(64) NOT NULL,
  `razdel_class` varchar(64) DEFAULT NULL,
  `razdel_order` smallint(6) NOT NULL,
  PRIMARY KEY (`razdel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Structure for the `settings` table : 
#

CREATE TABLE `settings` (
  `setings_id` int(11) NOT NULL AUTO_INCREMENT,
  `setings_name` varchar(64) DEFAULT NULL,
  `setings_value` varchar(256) DEFAULT NULL,
  `desk` varchar(16) NOT NULL,
  PRIMARY KEY (`setings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Structure for the `table_localization` table : 
#

CREATE TABLE `table_localization` (
  `id_lokale_field` int(11) NOT NULL AUTO_INCREMENT,
  `locale_name_field` varchar(128) NOT NULL,
  `locale_className` varchar(128) DEFAULT NULL,
  `locale_type_field` smallint(6) NOT NULL,
  PRIMARY KEY (`id_lokale_field`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Structure for the `user_login` table : 
#

CREATE TABLE `user_login` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(30) NOT NULL,
  `pasword` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_info` text,
  `user_icon` varchar(100) DEFAULT NULL,
  `user_email` varchar(40) DEFAULT NULL,
  `user_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login` (`user_login`),
  UNIQUE KEY `password` (`pasword`),
  UNIQUE KEY `pasword` (`pasword`),
  UNIQUE KEY `user_login` (`user_login`),
  UNIQUE KEY `login_user` (`user_login`),
  UNIQUE KEY `user_login_2` (`user_login`),
  UNIQUE KEY `user_pasword` (`pasword`),
  UNIQUE KEY `user_password` (`pasword`),
  UNIQUE KEY `pasword_2` (`pasword`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

#
# Structure for the `user_type` table : 
#

CREATE TABLE `user_type` (
  `user_type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `user_type_desk` varchar(64) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Structure for the `version` table : 
#

CREATE TABLE `version` (
  `id_version` tinyint(4) NOT NULL AUTO_INCREMENT,
  `desk_version` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_version`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Structure for the `work_type` table : 
#

CREATE TABLE `work_type` (
  `work_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `work_desk` varchar(35) DEFAULT NULL,
  `work_desk_en` varchar(35) NOT NULL,
  `work_order` int(11) DEFAULT NULL,
  `work_status` int(11) NOT NULL,
  `work_minidesk` varchar(35) NOT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

#
# Data for the `content_css` table  (LIMIT 0,500)
#

INSERT INTO `content_css` (`relationship_id`, `razdel_id`, `css_id`) VALUES 
  (1,2,1),
  (2,4,2),
  (3,4,1),
  (4,1,2),
  (5,1,1);

COMMIT;

#
# Data for the `content_java` table  (LIMIT 0,500)
#

INSERT INTO `content_java` (`relationship_id`, `razdel_id`, `java_id`) VALUES 
  (4,1,8),
  (9,4,8),
  (10,4,13),
  (15,2,8),
  (19,3,8);

COMMIT;

#
# Data for the `content_module` table  (LIMIT 0,500)
#

INSERT INTO `content_module` (`relationship_id`, `razdel_id`, `module_id`, `module_order`, `module_position`) VALUES 
  (1,1,1,1,2),
  (2,1,2,2,2),
  (3,2,3,1,2),
  (4,4,4,1,1);

COMMIT;

#
# Data for the `css` table  (LIMIT 0,500)
#

INSERT INTO `css` (`css_id`, `css_name`, `css_link`, `priority`) VALUES 
  (1,'CSS for FancyBox','/scripts/fancybox/jquery.fancybox-1.3.3.css',2),
  (2,'CSS for Jnice','/scripts/jnite/jniceit.css',2);

COMMIT;

#
# Data for the `image_status` table  (LIMIT 0,500)
#

INSERT INTO `image_status` (`status_id`, `status_deskription`, `status_tdesk`) VALUES 
  (1,'Новое','new'),
  (2,'Удаленное','del'),
  (3,'В работе','work');

COMMIT;

#
# Data for the `java` table  (LIMIT 0,500)
#

INSERT INTO `java` (`java_id`, `java_name`, `java_src`, `priority`) VALUES 
  (1,'Jquery.V-1.4.2','/scripts/jquery-1.4.2.js',1),
  (2,'Методы сглаживания движения','/scripts/jquery.easing.1.3.js',2),
  (3,'продвинутые Субмиты Формы Jquery ','/scripts/jquery.form.js',2),
  (4,'D''n''D таблиц ','/scripts/jquery.tablednd_0_5.js',2),
  (5,'Функции для сортировки таблиц','/scripts/js1.js',2),
  (6,'livequery for Jquery','/scripts/livequery.js',2),
  (7,'Сортировка для таблиц ','/scripts/tablesort.js',2),
  (8,'Пользовательские функции Jquery Общие ','/scripts/my_script.js',3),
  (9,'Администраторские функции Jqyery Общие ','/scripts/main_admin.js',3),
  (10,'Функции для управления юзерами','/scripts/adm_us.js',3),
  (11,'Функции для управления портфолио','/scripts/adm_pfl.js',3),
  (18,'Swf object','/scripts/swfobject.js',2),
  (13,'YandexMap weblink','http://api-maps.yandex.ru/1.1/index.xml?key=AMJkc04BAAAAxe-UWgMAkjTiFa8-3fKi0fwwcmsmdg4W4u0AAAAAAAAAAACXELcu5cUWnRSWn_dSwfK2ptEs5g==~AIpmc04BAAAA5QTeTwMAt_loWRQRiENLw6mNgEl3_3o8DIQAAAAAAAAAAACRas1QTFb4tMjq-O96vwAtyIjI0Q==',2),
  (14,'Кастомизация Input ','/scripts/jnite/jniceit.js',2),
  (15,'Попап fancybox ','/scripts/fancybox/jquery.fancybox-1.3.3.pack.js',2);

COMMIT;

#
# Data for the `locale_translation` table  (LIMIT 0,500)
#

INSERT INTO `locale_translation` (`translation_id`, `locale_id`, `locale_version`, `locale_desk`) VALUES 
  (16,8,'1','Студия веб-дизайна «Qulix Arts»'),
  (3,2,'1','Qulix Arts — студия веб-дизайна, 2011'),
  (5,2,'2','Qulix Arts – a web-design studio, 2011'),
  (6,3,'1','Студия «Qulix Arts» является <br/>структурным подразделением компании <a href=\"http://www.qulix.ru\">«Qulix Systems»</a>'),
  (7,3,'2','Qulix Arts is a <br/> business unit of the <a href=\"http://www.qulix.com\">«Qulix Systems»</a> company'),
  (17,8,'2','Design studio QulixArts');

COMMIT;

#
# Data for the `mobile_extension` table  (LIMIT 0,500)
#

INSERT INTO `mobile_extension` (`extension_id`, `extension_name`, `extension_heigth`, `extension_width`, `extension_style`, `extension_size`) VALUES 
  (2,'mobile_240_320',320,240,NULL,1),
  (3,'iphone_252_364',364,252,NULL,1),
  (1,'none',NULL,NULL,NULL,NULL),
  (5,'safary',NULL,NULL,1,NULL),
  (6,'flash_banner',NULL,NULL,NULL,NULL);

COMMIT;

#
# Data for the `module` table  (LIMIT 0,500)
#

INSERT INTO `module` (`module_id`, `module_name`, `module_link`) VALUES 
  (1,'Слайдер на главной','modules/main_slider/index.php'),
  (2,'Нижнее меню на главной','modules/minisitemap/index.php'),
  (3,'Модуль портфолио','modules/portfolio/index.php'),
  (4,'Форма отправки','modules/formSend/index.php');

COMMIT;

#
# Data for the `portfolio_image` table  (LIMIT 0,500)
#

INSERT INTO `portfolio_image` (`image_id`, `work_id`, `type_images`, `just_portfolio`, `slider_portfolio`, `slider_main`, `order_image`, `name_image`, `image_status`) VALUES 
  (626,54,1,1,0,0,1,'143bd1f19d3b9c4ab2803134507c198e',3),
  (627,54,1,1,0,0,2,'ddbfbbb28a36ab8a223e1728751ad337',3),
  (628,54,1,1,0,0,3,'ea3f45a5f75317433aa4bbd6c3460144',3),
  (630,54,1,0,0,1,0,'98b81fecdd72fc5d182de2058072ba2d',3),
  (704,57,1,1,0,0,10,'548d548fe53d1e4c788e047acc2ce1e3',3),
  (634,55,1,1,0,0,1,'43a90643122038e4e5e57921c8461393',3),
  (635,55,1,1,0,0,2,'f065dff70be7118b54107d7c5cbeaf86',3),
  (636,55,1,1,0,0,3,'a5132febef266de8fd1e3dd740c578af',3),
  (637,55,1,0,1,0,0,'44fe81d769ec4949f45366c3797b6903',3),
  (638,56,1,1,0,0,1,'6d1865b5c283199a698c14aa41cecc39',3),
  (639,56,1,1,0,0,2,'2e5accf1564a28e60d10ae3e0a99a398',3),
  (640,56,1,1,0,0,3,'3e91b300dbe922a9545bbcfefef1f3da',3),
  (641,56,1,1,0,0,4,'5feb262f4fd547f52bb2cb2f61ed7fbc',3),
  (642,56,1,0,1,0,0,'4166f7f4a71f8d729707e15b211f6532',3),
  (710,62,1,0,1,0,0,'4227118e3be5ac651ecab33194a52af6',3),
  (709,62,1,1,0,0,3,'8574ccfd3608236ff10b1fce92c2c259',3),
  (707,62,1,1,0,0,1,'f814a6f93241c798589c49a7561d0ed4',3),
  (708,62,1,1,0,0,2,'f16455787a8a7cc220b20423f32a21b7',3),
  (659,57,1,0,1,0,0,'465ea1188b17e5a39dd3c429e82089ba',3),
  (669,56,1,0,0,1,0,'1016d1b686f31fe934146720f4d862ec',3),
  (668,57,1,0,0,1,0,'ed8bded9fa9804b34a4ebff160ecf884',3),
  (831,69,3,1,NULL,0,8,'fe134942d41a265b8b1f61fb1930cce5',3),
  (794,68,3,1,NULL,0,5,'9d7b7d0c8de1a1ec2024d0288af8f6ec',3),
  (830,69,3,1,NULL,0,7,'549b0d2e64be500cc446e4397b51b965',3),
  (799,60,5,1,NULL,0,1,'ca87a1be6061729c5d6e302a76ac0161',3),
  (687,60,1,1,0,0,3,'bcbc44add28a8ed7d93ba9397c3c36ed',3),
  (688,60,1,1,0,0,2,'2048979a0d1f2d122294c5a564a30d03',3),
  (689,60,1,0,1,0,0,'4f4a4002355c49acbb1b5254ed24c8b7',3),
  (691,61,2,1,0,0,1,'302aff1c7c727a04eb53a430f84f2f7d',3),
  (692,61,2,1,0,0,2,'a5a1bac6ef27f89cb1053b78b5d4ed12',3),
  (693,61,2,1,0,0,3,'5e8f4e53851e6080446f7c28b8fba94e',3),
  (694,61,2,1,0,0,5,'621e5405ddf43282c30dd1959f456854',3),
  (695,61,2,1,0,0,4,'4bdfc67cd4726f6bc5aac12c16654afe',3),
  (696,61,1,0,1,0,0,'f660667df19dd6bf906dcb420880d54e',3),
  (829,69,3,1,NULL,0,6,'38122dcc7e65fdc0fbef6042ec9a4b3d',3),
  (703,54,1,0,1,0,0,'e85636ea5e38928e85d11bafc98f2a10',3),
  (705,57,1,1,0,0,11,'4a713ba6215d309730d8504e3e885a86',3),
  (706,57,1,1,0,0,12,'b32e7fd8c1b6e51a1f2cc92b6bbd652d',3),
  (715,63,1,1,0,0,1,'cc632900c62520289adbe4d04bce5ba6',3),
  (716,63,1,1,0,0,2,'5513bb291a39590e676729e75dca4739',3),
  (717,63,1,1,0,0,3,'a9f8498e4c9b6b1074d8544ead49634e',3),
  (714,63,1,0,1,0,0,'b8acf6c6d09348d6bcd508ba54792dee',3),
  (755,67,1,1,NULL,0,3,'1ac95416599a8f7c878815dc97c2b2a2',3),
  (754,67,1,1,NULL,0,2,'9f37f13f1999a8c8ef785683e10a75b3',3),
  (742,66,1,1,NULL,0,5,'59f6423f1412dbe37270f217aac03925',3),
  (721,64,1,0,1,0,0,'bfae6c1a0fe697ad6775a8c46e43f3ca',3),
  (722,64,1,1,NULL,0,4,'9e8e04588f79a39d3d5518cd96cff1aa',3),
  (723,64,1,1,NULL,0,5,'22ae4df819e60126f83b67f5de428753',3),
  (724,64,1,1,NULL,0,6,'b04c2a839913e13110298bb08fdd6080',3),
  (735,65,1,1,NULL,0,9,'d134a39faa924fe92f5ee906b57fc857',3),
  (752,65,1,0,1,0,0,'5422b871bbe7ad93e371e3ec4fec567f',3),
  (734,65,1,1,NULL,0,7,'9acedb158fd18edee13c4ec919476e82',3),
  (731,65,1,1,NULL,0,8,'b9fe798a1e6fcba7457b4a670811700b',3),
  (732,65,1,1,NULL,0,6,'173658ef715c5690c0bbcab5790a1252',3),
  (739,66,1,0,1,0,0,'7b8dc2ae299ebd15a7d10ea5b6532d92',3),
  (750,66,1,0,0,1,0,'f7a0dc0275fcea937068a55e16ad6dc8',3),
  (753,67,1,1,NULL,0,1,'18004071f47bea91fa1ec9ebdd9ef7e2',3),
  (743,66,1,1,NULL,0,6,'e4ceffe506241e3244a859f2f74bbaba',3),
  (744,66,1,1,NULL,0,7,'7d0e50d1e02471b20670883bbdd831e3',3),
  (756,67,1,0,1,0,0,'d1549f564a9a46270ac4fcbce76f200f',3),
  (839,76,1,1,NULL,0,2,'3387490960d80488847ed10b7b1018c3',3),
  (838,75,1,0,1,0,0,'79c48687f77b992752c17dbef2e67bb7',3),
  (818,74,1,0,1,0,0,'faa695a5d8d9d2a42565edc0d3a4110d',3),
  (837,75,5,1,NULL,0,3,'df64eef7b8bf76342c23949525433678',3),
  (766,68,1,0,1,0,0,'4855688fe57b6078b57e2bc098de85e7',3),
  (817,74,5,1,NULL,0,4,'f6e9ad29a91b81a05933e849f9ffb92a',3),
  (816,74,5,1,NULL,0,3,'8cb0b6bb61efecdd7fa8994095d3a81c',3),
  (815,74,5,1,NULL,0,2,'4b0ca2cb113bd208f9b046e4e646c412',3),
  (835,75,5,1,NULL,0,2,'fdb11078ab41ab41ba1aae088b2275f2',3),
  (834,75,5,1,NULL,0,1,'57fc74c7723e52aec5ab1414c0485b59',3),
  (773,69,1,0,1,0,0,'7faa8fffae58df31eca62cf8a676d8ae',3),
  (774,59,1,0,1,0,0,'95af83ae92e7bb7a3df594885cf67135',3),
  (775,70,1,0,1,0,0,'a460e93f6a7aed770fdf67a681bb0a26',3),
  (776,70,5,1,NULL,0,1,'90731b4687e7381e3a039b3f393040bd',3),
  (777,70,5,1,NULL,0,2,'3b28c17bba089897f18a582f2e2f284d',3),
  (778,70,5,1,NULL,0,3,'e39d60a2818be2e779fae6c80a40325e',3),
  (796,68,3,1,NULL,0,7,'a8cb9c625f126928a08d59b9f30df794',3),
  (905,82,1,0,1,0,0,'e4ac5482daf936897690355379af40c2',3),
  (795,68,3,1,NULL,0,6,'2b7d70e39eded7ca355a66a9bfba7830',3),
  (792,72,1,0,1,0,0,'25e580d4e48b5c5def365cc3f9f9317c',3),
  (894,59,3,1,0,0,19,'79ddd55f6882fa219b23e91e0389be16',3),
  (893,59,3,1,0,0,18,'a8cfec73e162f737362b20565dfd3900',3),
  (892,59,3,1,0,0,17,'62a593cf6524dba48c897f9656cdac30',3),
  (891,59,3,1,0,0,16,'d9095e008723fd2b22f5a4c31bb2540b',3),
  (797,68,3,1,NULL,0,8,'3deb5ad18b1dbcfeb5eb9a59485cbfdb',3),
  (804,73,1,0,1,0,0,'aa7c6b281a18dbe11264a0796c4c390f',3),
  (805,73,3,1,NULL,0,5,'c3404b42eb019bee40d69b1d0de49062',3),
  (806,73,3,1,NULL,0,6,'d205ebf2548b7535ca1c9c4494cab0e1',3),
  (807,73,3,1,NULL,0,7,'fab17c030b87e5a535ffa8dd85cec129',3),
  (808,73,3,1,NULL,0,8,'aeb1179e2e4850b617a0fc4b29db407f',3),
  (814,74,5,1,NULL,0,1,'64bcf94fbede768a465f3c9b0179fe10',3),
  (819,72,3,1,NULL,0,9,'1245df337042e89585138e2273fb4acc',3),
  (820,72,3,1,NULL,0,10,'065fea4517a12bdfc7cfa93cfaab5c40',3),
  (821,72,3,1,NULL,0,11,'f465f9bed01c15792cdbbba1b9c65a69',3),
  (822,72,3,1,NULL,0,12,'81df3bf68fac1b16a63fd0d72553de3e',3),
  (890,59,3,1,0,0,15,'63c2b0659fcbbccec52b0ffafca833d0',3),
  (832,69,3,1,NULL,0,9,'93f8fb8e1fcc1d18aea073784ea76738',3),
  (833,69,3,1,NULL,0,10,'7306d3756375d65250932b34f828b823',3),
  (840,76,1,1,NULL,0,1,'fec8686ca49fdf8f13b88fccbab73209',3),
  (841,76,1,1,NULL,0,3,'a5dff2315d2e30e706b0eca4aba03ba9',3),
  (842,76,1,0,1,0,0,'e4e4205367e4130ff734c752be054ca7',3),
  (843,63,1,0,NULL,1,0,'15841a74977c2e16abc42981a2f1554e',3),
  (844,70,1,0,NULL,1,0,'a54c80808fd463972eef18950e7893f1',3),
  (845,77,3,1,NULL,0,1,'5b822b1cb60748b62b97ef4db0c7a11e',3),
  (846,77,3,1,NULL,0,2,'92ad1f1ba3c0f9b5fe937b63ec26ac51',3),
  (847,77,3,1,NULL,0,3,'a123541924e1c1fb43384f1767a89799',3),
  (848,77,3,1,NULL,0,4,'be937edaaea5a0ac290a23c76113f665',3),
  (849,77,3,1,NULL,0,5,'f2749b598c1ca1616f14e5416439c864',3),
  (850,77,3,1,NULL,0,6,'be5331f562ec536d192aa1730fecbc7e',3),
  (851,77,1,0,1,0,0,'cc929df8e14c5d2f73f07b11b593c609',3),
  (852,77,1,0,NULL,1,0,'67e3938e3f327d62f47de9b8e3bcce29',3),
  (853,78,5,1,NULL,0,1,'b4a2ffa526fd3879ef4fb65b56f4a5ce',3),
  (854,78,5,1,NULL,0,2,'fd02e866f09307eea117110d50fd0efa',3),
  (855,78,5,1,NULL,0,3,'513ee90bbf986b3521b2478fbaaa5ea8',3),
  (856,78,1,0,1,0,0,'855577b9d4f635c7a3e031c8802e93bd',3),
  (857,79,1,1,NULL,0,1,'23820b241ed27f8c1274240a6e0bbdd3',3),
  (858,79,1,1,NULL,0,2,'d9442d742599f1bb532147cba4bf93c3',3),
  (859,79,1,1,NULL,0,3,'2ebe51574d629b5604716d373fa0951f',3),
  (861,79,1,0,1,0,0,'49bbf265bc7076fefc74c21efabbe9c4',3),
  (907,59,1,0,0,1,0,'875279da6659f1f9c77ae1574b39e992',3),
  (906,82,1,0,0,1,0,'b96435e8805072a2e258e5833fcc4f96',3),
  (904,82,3,1,0,0,4,'e26a147ecef5a17ed06090195b46fca8',3),
  (903,82,3,1,0,0,2,'1074eaed5ef6277dac7ef57ffa1e4a63',3),
  (902,82,3,1,0,0,3,'15bfb00059a0549cc8eaf1a2378e0436',3),
  (901,82,3,1,0,0,1,'6f865d71b49f2fa3eef25f128625b643',3),
  (910,83,5,1,0,0,1,'7e31e2653b544d2e303107324564aaec',3),
  (911,83,5,1,0,0,2,'2d9729417b4c7b14fa3d6c1fbbfea094',3),
  (912,83,5,1,0,0,3,'c5f13522cc905fc90c2e362333728d67',3),
  (913,83,1,0,1,0,0,'ab4c2b78119c125931d1f9b3406dbbc8',3),
  (914,83,1,0,0,1,0,'36f7b4848485e325aa1bf004ad325e21',3),
  (915,84,5,1,0,0,1,'1e5f9f5cdf90d4879aefa18b0c5230f3',3),
  (916,84,5,1,0,0,2,'9b5a058dde17b3283058fdf4c0493a51',3),
  (917,84,5,1,0,0,4,'365f2dc76ed6717b47c4e7abb12a9a2c',3),
  (918,84,5,1,0,0,3,'6b57b79b24e0ea1a2ee8890c95dec038',3),
  (919,84,1,0,1,0,0,'113980b238b45c6842164e1ddc530dc9',3),
  (920,84,1,0,0,1,0,'58b13279982f1d26fc5f95520b84117b',3);

COMMIT;

#
# Data for the `portfolio_work` table  (LIMIT 0,500)
#

INSERT INTO `portfolio_work` (`work_id`, `work_type_id`, `order_all`, `order_type`, `work_name_ru`, `work_name_desk_ru`, `work_deskription_ru`, `work_name_en`, `work_name_desk_en`, `work_deskription_en`, `work_link`, `work_link_en`, `work_link_desk`, `work_link_desk_en`, `work_version`, `work_meta_deskription`, `data`, `login`) VALUES 
  (55,1,5,4,'Qulix QA','Дизайн и разработка сайта','Сайт, посвященный услугам по тестированию от компании Qulix Systems. Удобный и функциональный, он позволяет ознакомиться с предоставляемыми услугами и возможностями, а также  сделать правильный выбор в сфере услуг тестирования программного обеспечения.','Qulix QA','Website','The site features a variety of software testing services provided by Qulix Systems. Easy-to-use and functional, it offers a comprehensive description of company services and expertise and assists in making the right choice when it comes to QA issues.','http://www.qa.qulix.ru/','http://www.qa.qulix.com/','www.qa.qulix.ru','www.qa.qulix.com',NULL,NULL,'2011-02-03','katarina'),
  (56,2,6,1,'Дизайнер интерьера','Флеш-модуль для подбора дверей','Подобрать дверь к любому интерьеру можно легко и просто! Специально для этого и был разработан наш флеш-модуль, который включает несколько видов дизайна интерьера, а также  возможность изменения обоев и напольных покрытий.   Для удобства администрирования каталог дверей легко можно пополнить новыми образцами.','Interior Designer','Flash application','Finding a door to match any interior is nice and easy! Our flash module has been especially created for that purpose. The module incorporates a number of different interior design styles with an option to choose wallpaper and flooring. The catalogue may be easily expanded with new door-samples.','/demo/interiorDesigner/constructor.html','/demo/interiorDesigner/constructor.html','Флеш-версия','Flash-version',NULL,NULL,'2011-02-03','katarina'),
  (54,1,3,3,'Pocket Hotel','Промосайт для iPhone-приложения','Мобильный гид по гостинице у Вас в кармане - так можно охарактеризовать приложение «Pocket Hotel Assistant». Сайт же позволяет подробно ознакомиться со всеми достоинствами данного продукта, и с помощью интерактивных вставок, разработанных нашей студией, продемонстрировать его функциональную часть.','Pocket Hotel','Promotion website','Pocket Hotel Assistant is a hotel guide solution for mobile phones. The site provides a detailed description of product advantages and points out application features through the help of interactive media created by our design studio.','/demo/pocketHotel/pocketHotelRu.html','/demo/pocketHotel/index.html','www.pockethotel.com','www.pockethotel.com',NULL,NULL,'2011-02-03','katarina'),
  (57,2,10,2,'Открытка для компании «ОМА»','Дизайн, флеш-разработка','Лаконичное новогоднее поздравление для клиентов и сотрудников компании «Ома», призывающее разморозить зимнюю сказку. ','New Year Postcard','Design, flash','A nice New Year greeting for OMA workers and customers urging to unfreeze the winter''s tale.','/demo/omapostcard2011/index.html','/demo/omapostcard2011/index.html','Флеш-версия','Flash version',NULL,NULL,'2011-02-03','katarina'),
  (59,5,8,2,'Мобильный гид компании «МТС»','Дизайн iPhone-приложения','Дизайн iPhone-приложения для компании «МТС». Приложение позволяет получить быстрый доступ к таким услугам как:<br>\n— смена тарифных планов;<br>\n— оплата услуг ;<br>\n— поиск на карте ближайшего отделения или магазина компании;<br>\n— новости о скидках, акциях и новых сервисах компании.\n','МТS Mobile Guide','Design of iPhone application interface','iPhone app design for MTS. The application provides fast access to the following services:<br>\n— changing subscriber price plans<br>\n— making service payments<br>\n— searching for nearest company offices<br>\n— catching up on news of discounts, promotions and new company services<br>','','','','',NULL,NULL,'2011-02-22','ka30'),
  (60,1,11,5,'Squirrels','Разработка логотипа и дизайн сайта','Комплексная разработка фирменного стиля компании «Squirrels», включая сам логотип и дизайн сайта компании.','Squirrels','Logo & site design','Complex corporate identity design for Squirrels Development Ltd., including the logo and corporate website design.','','','','',NULL,NULL,'2011-02-03','katarina'),
  (61,5,12,6,'NewsLine','Дизайн java-приложения','Разработка дизайна интерфейса, в том числе пользовательских иконок, для мобильного приложения, позволяющего быть в курсе самых последних новостей.','NewsLine','Java-application design','Interface design (including user icons) for a mobile application that helps its users to catch up on the latest news.','','','','',NULL,NULL,'2011-02-16','katarina'),
  (62,2,13,4,'Министерство культуры РБ','Флеш-презентация','<p>Флеш-презентация для Министерства культуры Республики Беларусь.</p> \n<p>Она создавалась с целью того, чтобы рассказать о Беларуси как о самобытной стране, со своей богатой историей, традициями и архитектурой. Мы рады тому, что можем посодействовать в развитии культурных ценностей нашей страны.</p>\n','Ministry of Culture presentation','Flash-presentation','The flash presentation for the Ministry of Culture of the Republic of Belarus was created with the idea to graphically portray Belarus as the country with its rich and fascinating history, traditions and architecture. We are happy to help promote cultural values of our country.','','','','',NULL,NULL,'2011-02-04','katarina'),
  (63,1,14,6,'iSphere Labs','Сайт-визитка','Сайт-визитка, созданный специально для команды разработчиков мобильных приложений. Содержит портфолио проектов для всех современных платформ.','iSphere Labs','Website','This business website was specially created for the team of mobile developers and contains project portfolio featuring all state-of-the-art mobile platforms.','http://www.mobile.qulix.ru/','http://www.mobile.qulix.com/','www.ispherelabs.com','www.ispherelabs.com',NULL,NULL,'2011-10-13','ka30'),
  (64,3,15,3,'Choice Teachers','Дизайн пользовательского интерфейса','Основное пользователи приложения – это преподаватели, которые с помощью данного приложения имеют возможность управлять своим рабочим расписанием: планировать время занятий, резервировать свободное время, выбирать факультеты, составлять необходимые отчеты и т.д.','Choice Teachers','The design of a user interface for the desktop application','The application helps teachers manage their work schedule – set out class timetable and free time, select departments, file reports, etc.','','','','',NULL,NULL,'2011-02-04','katarina'),
  (65,3,16,2,'МЕЛОРИНГ','Интерфейс онлайн-сервиса','Нами разработан дизайн сервиса МЕЛОРИНГ для сайта компании «life:)». Услуга «life:) МЕЛОРИНГ» позволяет заменить обычный сигнал соединения на песню, музыкальное произведение или шутку.','MELORING','Design of the interface','We created the design for the ''MeloRing'' service offered by the Life:) mobile network operator. The ''MeloRing'' service enables its users to replace the standard connecting tone with a song, a music piece or humorous sound effects.','http://meloring.life.com.by/Crbt/Content/Default.aspx','http://meloring.life.com.by/Crbt/Content/Default.aspx','www.meloring.life.com.by','www.meloring.life.com.by',NULL,NULL,'2011-02-04','katarina'),
  (66,2,9,3,'GeoSam','Флеш-сайт','Промо-сайт, разработанный нашей командой для 3d-аниматора, позволяет  on-line  ознакомиться с галереей выполненных работ.','GeoSam','Flash site','Our team built this promo website for a 3D animator. The site allows users to view the online project gallery.','/demo/geosam/index.html','/demo/geosam/index.html','www.geosam.by','www.geosam.by',NULL,NULL,'2011-02-04','katarina'),
  (67,3,17,1,'DNV Navigator','Разработка шаблона дизайна','Для компании «DNV» были разработаны шаблоны для браузерного приложения «DNV Navigator». Приложение предназначено для предоставления своевременной информации морским судам о месторасположении портов, о документах и требованиях, необходимых для возможности пришвартоваться.','DNV navigator','Design of the interface','We created templates design for the DNV Navigator – a browser application of the DNV risk management company. The app provides timely information on the location of ports and harbours, on documents and requirements necessary for mooring to marine vessels.','','','','',NULL,NULL,'2011-02-04','katarina'),
  (68,5,18,4,'LifeStyle','Дизайн iPhone-приложения','Нашей командой разработан дизайн мобильного интернет-магазина, позволяющего пользователям получать всю интересующую информацию о предлагаемых товарах, участвовать в акциях, находить ближайшие филиалы магазинов, узнавать о наличии желаемых экземпляров и многое другое. ','LifeStyle','Design of iPhone-application','Our team created the design for the mobile online store where users can find all the necessary information about the offered goods, take part in sales promotion programs, search for nearest branch stores, learn about the items wanted, and many more.','','','','',NULL,NULL,'2011-02-14','katarina'),
  (69,5,19,5,'Мобильный банк для «Nationwide»','Дизайн iPhone-приложения','<p>Предлагаем к Вашему вниманию дизайн мобильного банка для одного из крупнейших банков Европы -  «Nationwide».</p> \n<p>Мобильный банк - это сервис нового поколения, который позволяет клиентам банка удаленно получать всю необходимую информацию, а также пользоваться многочисленными услугами с помощью своего мобильного телефона.</p>','Nationwide','Design of iPhone-application','<p>We are delighted to present the design of the mobile bank solution for Nationwide – one of the largest banks in Europe.\n<p>Mobile banking is a next-generation service that helps bank clients find all the necessary reference information as well as providing mobile access to numerous banking services.','','','','',NULL,NULL,'2011-02-16','katarina'),
  (70,3,20,4,'Balancing UI','Дизайн интерфейса приложения','Balancing UI представляет собой сильверлайт-приложение для редактирования иерархических данных и временных диаграмм. Основное преимущество - возможность визуального редактирования графиков.','Balancing UI','Design of application','Balancing UI is a Silverlight application for editing hierarchical data and time sheets. Its major advantage is that users can use visual editing tools for editing diagrams.','','','','',NULL,NULL,'2011-02-15','katarina'),
  (72,5,21,3,'Dream Hotel','Дизайн iPhone-приложения','Нашей командой разработан шаблон дизайна iPhone-приложения для программы «PocketHotel». Программа предназначена для взаимодействия с посетителями гостиницы и позволяет получать доступ к её сервисам с помощью мобильного телефона. С номерами отеля и окрестными достопримечательностями можно ознакомиться посредством виртуального тура.','Dream Hotel','Design of iPhone application','Our team created templates design for the PocketHotel iPhone application. The solution is used for interaction with hotel guests and offers mobile access to standard hotel services. Users can take a virtual tour of hotel rooms and local places of interest.','','','','',NULL,NULL,'2011-02-15','katarina'),
  (73,5,22,7,'TV To Go!','Дизайн iPhone-приложения','Разработка дизайна приложения  TV2GO, пользователи которого имеют возможность смотреть более 40 бесплатных и платных независимых TB-каналов – ТВ-развлечения, киноновинки, актуальные новости и другое.','TV To Go!','','Application design development for TV2GO. Application users can watch over 40 free and independent pay TV channels – TV entertainment, new movie releases, hot news and more.','','','','',NULL,NULL,'2011-02-15','katarina'),
  (74,3,23,5,'Единый реестр правовых актов','Дизайн интерфейса приложения','Нашей командой разработан дизайн интерфейса и набор иконок единого реестра правовых актов СНГ.\nДанная программа предназначена для регистрации, ведения и официального опубликования в электронном виде правовых актов и других документов, принятых в рамках Содружества.','Единый реестр правовых актов','none','We created interface design and a set of icons for the Unified Register of Legal Acts and Other Documents of the CIS.\nThe solution is used for registration, filing and official publication of electronic legal acts and other documents executed within the CIS framework.','','','','',NULL,NULL,'2011-02-15','katarina'),
  (75,3,7,6,'MTS Guide Server','Дизайн интерфейса приложения','Мы разработали дизайн для браузерного приложения, предназначенного для администрирования мобильного гида компании «МТС».','MTS Guide Server','Design of the web application','We created the design for the browser app used for the administration of the MTS Mobile Guide.','','','','',NULL,NULL,'2011-02-03','katarina'),
  (76,2,24,5,'Открытка для компании «Qulix Systems»','Дизайн, флеш-разработка','Новогодняя открытка для компании Qulix Systems с пожеланиями для клиентов и партнеров от руководящих лиц.','New Year Postcard','Design, flash','A New Year greetings card from Qulix Systems management team sending best wishes to customers and partners of the company.','/demo/qulixpostcard2010/index.html','/demo/qulixpostcard2010/index.html','Посмотреть','Flash version',NULL,NULL,'2011-02-16','katarina'),
  (77,5,25,8,'Мобильный банк «ВТБ 24»','Дизайн iPhone-приложения','<p>Разработка дизайна мобильного банка для одного из ведущих банков СНГ - ВТБ.</p>\n<p>Мобильный банк - это сервис нового поколения, который позволяет клиентам банка удаленно получать всю необходимую информацию, а также пользоваться многочисленными услугами с помощью своего мобильного телефона.</p>','Mobile bank «VTB 24»','Design of the iPhone application','<p>Mobile bank solution design development for VTB – one of the top CIS banks.<p>\n<p>Mobile banking is a next-generation service that helps bank clients find all the necessary reference information as well as providing mobile access to numerous banking services.<p>','','','','',NULL,NULL,'2011-02-16','katarina'),
  (78,1,26,7,'ItSolutions','Сайт-визитка','Фирменный сайт с описанием предоставляемых услуг, созданный специально для команды java-разработчиков.','ItSolutions','Website','This corporate website featuring the list of offered services was especially created for the team of java-developers.','','','','',NULL,NULL,'2011-02-16','katarina'),
  (79,2,27,6,'MobiFly','дизайн, флеш-разработка','Флеш-презентация для демонстрации преимуществ одного из мобильных решений компании Qulix Systems - MobiFly.','MobiFly','Design, flash','A flash presentation for demonstration of the advantages of MobiFly – one of the mobile solutions offered by Qulix Systems.','/demo/mobifly_presentation/index.html','/demo/mobifly_presentation/index.html','Флеш-версия','Flash-version',NULL,NULL,'2011-02-16','katarina'),
  (82,5,4,1,'Matches Puzzles','Игра для iPhone','Наша команда разработала интерфейс и дизайн для iPhone-игры. Если вы любите проводить свободное время разгадывая головоломки, то эта игра займет вас на несколько часов интересными загадками.','Matches Puzzles','iPhone Game','Our team created the interface and design for the iPhone game. If you like to spend your leisure time solving puzzles this game will entertain you with a whole lot of such tasks.','','','','',NULL,NULL,'2011-03-14','katarina'),
  (83,1,2,1,'Сентро Сервис','Дизайн сайта','Нами разработан дизайн и иллюстрации для корпоративного сайта компании «Сентро Сервис». Через удобные сервисы, реализованные на сайте, клиенты могут заказывать билеты в любую точку мира, оплачивать их и получать консультацию у специалистов компании.','Sentro Service','Web design','We created the design and illustrations for the Centro Service corporate website. The handy online service allows customers to book flights to anywhere in the world, make payments and get help from the company representatives.','','','','',NULL,NULL,'2011-03-14','katarina'),
  (84,1,1,2,'Gidro2K','Дизайн сайта','Нами разработан дизайн и иллюстрации для промосайта Gidro2K. Системы отопления, водоснобжения, системы водоотчистки, автомотические системы полива: теперь подобрать нехватающие элементы для комфорта вашего дома легче с сайтом компании Gidro2K.','Gidro2K','Web design','Our team created the design and illustrations for the Gidro2K promo website. The Gidro2K company sells and installs heating, water supply, sewerage, water treatment and watering systems.','','','','',NULL,NULL,'2011-03-14','katarina');

COMMIT;

#
# Data for the `position_module` table  (LIMIT 0,500)
#

INSERT INTO `position_module` (`position_id`, `position_deskription`, `position_mindesk`) VALUES 
  (1,'В блоке  контента до контента','BCBC'),
  (2,'В блоке контента после контента','BCAC');

COMMIT;

#
# Data for the `razdel` table  (LIMIT 0,500)
#

INSERT INTO `razdel` (`razdel_id`, `razdel_link`, `razdel_class`, `razdel_order`) VALUES 
  (1,'index/','home',1),
  (2,'portfolio/','portfolio',2),
  (3,'about/','about',3),
  (4,'contacts/','contacts',4);

COMMIT;

#
# Data for the `razdel_localization` table  (LIMIT 0,500)
#

INSERT INTO `razdel_localization` (`localization_id`, `razdel_id`, `version_id`, `razdel_title`, `razdel_name`, `razdel_meta_desk`, `razdel_meta_keyw`, `razdel_h1`, `razdel_content`, `razdel_status`) VALUES 
  (1,1,1,'- Разработка и дизайн сайтов, дизайн мобильных приложений','Стартовая','','Дизайн-студия,студия web-дизайна,создание сайтов','','<div class=\"mainPageContentContainer\">\r\n<div id=\"slide\">\r\n<div class=\"mainPageBanner Banner1\" id=\"1\">\r\n<div class=\"mainPageBannerColorBg\">\r\n<div class=\"mainBannerCenter\">\r\n<div class=\"mainBannerTxt\">\r\n<h1>Современный дизайн<br />мобильных приложений</h1>\r\n<p>Компания Qulix Arts занимается разработкой и дизайном пользовательских интерефейсов для различных мобильных платформ уже много лет.</p>\r\n<a class=\"projectButton\" href=\"/portfolio/mobile/\"><span class=\"projectButtonLeft\">&nbsp;</span><span class=\"projectButtonCenter\">ПЕРЕЙТИ К ПРОЕКТАМ</span><span class=\"projectButtonRight\">&nbsp;</span></a></div>\r\n<div class=\"MainBannerImg\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"mainPageBanner Banner2\" id=\"2\">\r\n<div class=\"mainPageBannerColorBg\">\r\n<div class=\"mainBannerCenter\">\r\n<div class=\"mainBannerTxt\">\r\n<h1>Динамичный и удобный<br /> дизайн интерфейсов</h1>\r\n<p>Разрабатывая очередной пользовательский интерфейс, мы всегда ставим себя на место пользователей и стараемся создать максимально удобное приложение, способное эффективно выполнять свою задачу.</p>\r\n<a class=\"projectButton\" href=\"/portfolio/interfaces/\"><span class=\"projectButtonLeft\">&nbsp;</span><span class=\"projectButtonCenter\">ПЕРЕЙТИ К ПРОЕКТАМ</span><span class=\"projectButtonRight\">&nbsp;</span></a></div>\r\n<div class=\"MainBannerImg\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"mainPageBanner Banner3\" id=\"3\">\r\n<div class=\"mainPageBannerColorBg\">\r\n<div class=\"mainBannerCenter\">\r\n<div class=\"mainBannerTxt\">\r\n<h1>Разработка сайтов<br /> любой сложности</h1>\r\n<p>Наша компания занимается разработкой и дизайном сайтов любой сложности. Создать яркий, функциональный и запоминающийся сайт &mdash; это наши цели в каждом проекте.</p>\r\n<a class=\"projectButton\" href=\"/portfolio/sites/\"><span class=\"projectButtonLeft\">&nbsp;</span><span class=\"projectButtonCenter\">ПЕРЕЙТИ К ПРОЕКТАМ</span><span class=\"projectButtonRight\">&nbsp;</span></a></div>\r\n<div class=\"MainBannerImg\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"mainPageBanner Banner4\" id=\"4\">\r\n<div class=\"mainPageBannerColorBg\">\r\n<div class=\"mainBannerCenter\">\r\n<div class=\"mainBannerTxt\">\r\n<h1>Интерактивные<br />Flash-приложения</h1>\r\n<p>Технология FLASH &mdash; прекрасная возможность добавить интерактивности и динамики вашему сайту, презентации или баннеру.</p>\r\n<a class=\"projectButton\" href=\"/portfolio/flash/\"><span class=\"projectButtonLeft\">&nbsp;</span><span class=\"projectButtonCenter\">ПЕРЕЙТИ К ПРОЕКТАМ</span><span class=\"projectButtonRight\">&nbsp;</span></a></div>\r\n<div class=\"MainBannerImg\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"mainBannerShadow\"></div>\r\n<div class=\"bannerPaging\">\r\n<ul>\r\n<li><a id=\"1\" class=\"btn-banner-1 active-banner\">&nbsp;</a></li>\r\n<li><a id=\"2\" class=\"btn-banner-2\">&nbsp;</a></li>\r\n<li><a id=\"3\" class=\"btn-banner-3\">&nbsp;</a></li>\r\n<li class=\"last-child\"><a id=\"4\" class=\"btn-banner-4\">&nbsp;</a></li>\r\n</ul>\r\n</div>\r\n</div>',1),
  (2,1,2,'Start Page','Start Page','','Websites,Web Design Studio','','<div class=\"mainPageContentContainer\">\r\n<div id=\"slide\">\r\n<div id=\"1\" class=\"mainPageBanner Banner1\">\r\n<div class=\"mainPageBannerColorBg\">\r\n<div class=\"mainBannerCenter\">\r\n<div class=\"mainBannerTxt\">\r\n<h1>Cutting-Edge<br /> Mobile App Design</h1>\r\n<p>Qulix Arts specializes in user interface design and development for various mobile platforms. We create trendy, attractive, and user-friendly interfaces for all your mobile apps.</p>\r\n<a class=\"projectButton\" href=\"/portfolio/mobile/\"><span class=\"projectButtonLeft\">&nbsp;</span><span class=\"projectButtonCenter\">OUR PROJECTS</span><span class=\"projectButtonRight\">&nbsp;</span></a></div>\r\n<div class=\"MainBannerImg\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"2\" class=\"mainPageBanner Banner2\">\r\n<div class=\"mainPageBannerColorBg\">\r\n<div class=\"mainBannerCenter\">\r\n<div class=\"mainBannerTxt\">\r\n<h1>Dynamic And User-Friendly<br /> Interface Design</h1>\r\n<p>When creating another user interface we always think what it must feel like for a user and try to develop the most user-friendly app that can effectively do its task.</p>\r\n<a class=\"projectButton\" href=\"/portfolio/interfaces/\"><span class=\"projectButtonLeft\">&nbsp;</span><span class=\"projectButtonCenter\">OUR PROJECTS</span><span class=\"projectButtonRight\">&nbsp;</span></a></div>\r\n<div class=\"MainBannerImg\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"3\" class=\"mainPageBanner Banner3\">\r\n<div class=\"mainPageBannerColorBg\">\r\n<div class=\"mainBannerCenter\">\r\n<div class=\"mainBannerTxt\">\r\n<h1>Web Design <br /> Of Any Complexity</h1>\r\n<p>Our company is experienced in building websites of any complexity. The goal we pursue in every project is to create a bright, memorable, and fully-functional website.</p>\r\n<a class=\"projectButton\" href=\"/portfolio/sites/\"><span class=\"projectButtonLeft\">&nbsp;</span><span class=\"projectButtonCenter\">OUR PROJECTS</span><span class=\"projectButtonRight\">&nbsp;</span></a></div>\r\n<div class=\"MainBannerImg\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"4\" class=\"mainPageBanner Banner4\">\r\n<div class=\"mainPageBannerColorBg\">\r\n<div class=\"mainBannerCenter\">\r\n<div class=\"mainBannerTxt\">\r\n<h1>Interactive <br />Flash Applications</h1>\r\n<p>Flash Technology is a good way of making your website, presentation or banner more interactive and dynamic.</p>\r\n<a class=\"projectButton\" href=\"/portfolio/flash/\"><span class=\"projectButtonLeft\">&nbsp;</span><span class=\"projectButtonCenter\">OUR PROJECTS</span><span class=\"projectButtonRight\">&nbsp;</span></a></div>\r\n<div class=\"MainBannerImg\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"mainBannerShadow\"></div>\r\n<div class=\"bannerPaging\">\r\n<ul>\r\n<li><a id=\"1\" class=\"btn-banner-1 active-banner\">&nbsp;</a></li>\r\n<li><a id=\"2\" class=\"btn-banner-2\">&nbsp;</a></li>\r\n<li><a id=\"3\" class=\"btn-banner-3\">&nbsp;</a></li>\r\n<li class=\"last-child\"><a id=\"4\" class=\"btn-banner-4\">&nbsp;</a></li>\r\n</ul>\r\n</div>\r\n</div>',1),
  (3,2,1,'Портфолио','Портфолио','','Проекты, сайты, интрефейсы,мобильные интрефейсы, Flash, дизайн для Iphone',NULL,'',1),
  (4,2,2,'Portfolio','Portfolio','','Projects,Sites,Flash,Interfaces,Mobile Interfaces,design for Iphone  \n',NULL,'',1),
  (6,3,2,'About our studia','About Us','','',NULL,'<div class=\"typicalFullWidthContainer\">\r\n<div class=\"typicalWidthContainer\">\r\n<h1>About Us</h1>\r\n<div class=\"textFormContainer\">\r\n<div class=\"textFormHeader\">\r\n<div class=\"textFormTop_left\"></div>\r\n<div class=\"textFormTop_right\"></div>\r\n</div>\r\n<div class=\"textFormCenter\">\r\n<div class=\"textFormBlock\">\r\n<h2>Who we are</h2>\r\n<span style=\"font-size:9.0pt;font-family: Arial;mso-fareast-font-family:\" lang=\"EN-US\">Qulix Arts is a team of talented designers who came together to do what they like. We produce the design for your websites and software applications in accordance with the latest web design trends.&nbsp;<br /> <br /> Our customers from all over the world know us by our professional high-quality design services.<br /> <br /></span>\r\n<div><span style=\"font-family: Arial; font-size: 12px; \">We are the help you seek if you want to make your customers remember you</span>.</div>\r\n</div>\r\n<div class=\"textFormBlock\">\r\n<h2>What we do</h2>\r\n<div><span style=\"font-family: Arial; font-size: 12px; \">Need a nice interesting website or a presentation to promote your services or goods? Want a dynamic user-friendly interface for your software? Seeking higher profits from your mobile app by making its design more attractive and trendy</span>? <br /><br /><span style=\"font-size:9.0pt;font-family: Arial;mso-fareast-font-family:\" lang=\"EN-US\">Call us for help. We bring your most extraordinary ideas to life</span>.</div>\r\n</div>\r\n<div class=\"textFormBlock\">\r\n<h2>Why us</h2>\r\n<div><span style=\"font-family: Arial; font-size: 12px;\">Our creative potential and rich imagination always work for you&nbsp;&ndash; so why not turn our experience and professionalism to your advantage?</span></div>\r\n<div>&nbsp;<br /><span style=\"font-size: 9.0pt; font-family: Arial; mso-fareast-font-family: \" lang=\"EN-US\">Thanks to our flexibility and good turnaround time we can satisfy even the most demanding and hard-to-please clients</span>. <br /><br /><span style=\"font-family: Arial; font-size: 12px;\">Everyone promises s</span><span style=\"font-size: 9.0pt; font-family: Arial; mso-fareast-font-family: \" lang=\"EN-US\">hort timeframe and low prices. We do not promise&nbsp;</span><span style=\"color: #333333; font-size: 15px;\"><span style=\"font-family: arial, helvetica, sans-serif;\">&ndash;</span></span><span style=\"font-size: 9.0pt; font-family: Arial; mso-fareast-font-family: \" lang=\"EN-US\">&nbsp;we just do our work</span>.</div>\r\n</div>\r\n</div>\r\n<div class=\"textFormFooter\">\r\n<div class=\"textFormBottom_left\"></div>\r\n<div class=\"textFormBottom_right\"></div>\r\n</div>\r\n</div>\r\n<div class=\"photosImageBox\"><img src=\"/images/foto_default_en.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n<div id=\"_mcePaste\" style=\"position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow: hidden;\">\r\n<h2>we</h2>\r\n</div>',1),
  (5,3,1,'О нашей студии ','О нас ','','Дизайн студия Rubik Arts, наша web-cтудия, о нас, наши услуги ',NULL,'<div class=\"typicalFullWidthContainer\">\r\n<div class=\"typicalWidthContainer\">\r\n<h1>О нас</h1>\r\n<div class=\"textFormContainer\">\r\n<div class=\"textFormHeader\">\r\n<div class=\"textFormTop_left\"></div>\r\n<div class=\"textFormTop_right\"></div>\r\n</div>\r\n<div class=\"textFormCenter\">\r\n<div class=\"textFormBlock\">\r\n<h2>Кто мы?</h2>\r\n<div>Компания &laquo;Qulix Arts&raquo; &ndash; это команда талантливых дизайнеров, которые объединились, чтобы делать свое любимое дело. Создавая дизайн вашего программного приложения или веб-сайта, мы учитываем самые последние технологические тенденции.&nbsp;<br /><br />Наши клиенты из различных стран мира знают нас как надежных профессионалов, которые оказывают высококачественные услуги.<br /><br />Мы те, кто помогает вашим клиентам запомнить вас.</div>\r\n</div>\r\n<div class=\"textFormBlock\">\r\n<h2>Что делаем?</h2>\r\n<div>Вам нужен интересный и красивый веб-сайт или презентация для продвижения ваших услуг или продуктов? Вы хотите, чтобы интерфейс вашего приложения был динамичным и удобным в использовании? Вы считаете, что дизайн вашего мобильного приложения уже устарел?&nbsp;<br /><br />Свяжитесь с нами, и мы поможем вам! Мы работаем для того, чтобы превращать все ваши самые необычные идеи в жизнь.</div>\r\n</div>\r\n<div class=\"textFormBlock\">\r\n<h2>Почему мы?</h2>\r\n<div>\r\n<p>Наш творческий потенциал и фантазия всегда работают на вас&nbsp;&ndash; используйте наш опыт и профессионализм в своих интересах.<br /><br />Благодаря своей гибкости и быстрой реакции на запросы мы способны удовлетворить даже самых строгих и требовательных клиентов. <br /><br />Сжатые сроки и низкие цены обещают многие. Мы не обещаем невозможного, мы просто делаем свою работу.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"textFormFooter\">\r\n<div class=\"textFormBottom_left\"></div>\r\n<div class=\"textFormBottom_right\"></div>\r\n</div>\r\n</div>\r\n<div class=\"photosImageBox\"><img src=\"/images/foto_default_ru.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>',1),
  (7,4,1,'Контакты','Контакты','','Rubik Arts, контакты , свяжитесь с нами ',NULL,'<div id=\"map\" class=\"typicalFullWidthContainer\">\r\n<div class=\"typicalWidthContainer\">\r\n<h1>Контакты</h1>\r\n<div id=\"YMapsID\" class=\"contactsMapBlock\"></div>\r\n<div class=\"contactsTextBlock\"><a id=\"frame\" class=\"openContactForm\" onclick=\"javascript:_gaq. push([''_trackPageview'',''/writeToUs'']);\" href=\"/modules/formSend/index.php?getForm=true\">Написать письмо</a>\r\n<h3>Наш адрес</h3>\r\n<div>Республика Беларусь,<br /> Минск, 220004,ул. Мельникайте 4,<br /> офис 607.</div>\r\n<h3>С нами можно связаться</h3>\r\n<div><span style=\"color: #ffffff;\"><strong>+375 (17) 222-62-51</strong></span> (<em>факс</em>)<br /> <span style=\"color: #ffffff;\"><strong>+375 (29) 665-11-18</strong></span> <em>(GSM)</em><br /> <a id=\"rubik_mail\">email</a><br /> <a href=\"skype:yulia.migalenya\">Skype</a></div>\r\n</div>\r\n</div>\r\n</div>',1),
  (8,4,2,'Contacts','Contacts','','',NULL,'<div class=\"typicalFullWidthContainer\" id=\"map\">\r\n<div class=\"typicalWidthContainer\">\r\n<h1>Contacts</h1>\r\n<div class=\"contactsMapBlock\" id=\"YMapsID\"></div>\r\n<div class=\"contactsTextBlock\"><a id=\"frame\" class=\"openContactForm\" onclick=\"javascript:_gaq. push([''_trackPageview'',''/writeToUs'']);\" href=\"/modules/formSend/index.php?getForm=true\">Write to us</a>\r\n<h3>Our location</h3>\r\n<div>4 Melnikayte Str. office 607,<br /> Minsk 220004,<br /> Belarus</div>\r\n<h3>You can contact us</h3>\r\n<div><span style=\"color: #ffffff;\"><strong>+375 (17) 222-62-51</strong></span> (<em>fax</em>)<br /> <span style=\"color: #ffffff;\"><strong>+375 (29) 665-11-18</strong></span> <em>(GSM)</em><br /> <a id=\"rubik_mail\">email</a><br /> <a href=\"skype:yulia.migalenya\">Skype</a></div>\r\n</div>\r\n</div>\r\n</div>',1);

COMMIT;

#
# Data for the `razdel_test` table  (LIMIT 0,500)
#

INSERT INTO `razdel_test` (`razdel_id`, `razdel_link`, `razdel_class`, `razdel_order`) VALUES 
  (1,'index/','home',1),
  (2,'portfolio/','portfolio',2),
  (3,'about/','about',3),
  (4,'contacts/','contacts',4);

COMMIT;

#
# Data for the `settings` table  (LIMIT 0,500)
#

INSERT INTO `settings` (`setings_id`, `setings_name`, `setings_value`, `desk`) VALUES 
  (1,'E-mail Админа ','PVrublevsky@qulix.com,DLazovsky@qulix.com','email'),
  (2,'Количество отоброжаемых работ','5','colwonp');

COMMIT;

#
# Data for the `table_localization` table  (LIMIT 0,500)
#

INSERT INTO `table_localization` (`id_lokale_field`, `locale_name_field`, `locale_className`, `locale_type_field`) VALUES 
  (2,'Поле копирайта','copyrigt',1),
  (3,'Поле дочерней компании','children',1),
  (8,'Title страниц','title',1);

COMMIT;

#
# Data for the `user_login` table  (LIMIT 0,500)
#

INSERT INTO `user_login` (`user_id`, `user_login`, `pasword`, `user_name`, `user_info`, `user_icon`, `user_email`, `user_status`) VALUES 
  (12,'ka30','733ad9387b5795bcb6e7c944f0263447','Лазовский Дмитрий',NULL,NULL,NULL,1),
  (13,'liza','1d0258c2440a8d19e716292b231e3190','Лиза   Ярмолкевич',NULL,NULL,NULL,2),
  (14,'test','098f6bcd4621d373cade4e832627b4f6','Test administrator',NULL,NULL,NULL,2),
  (11,'su','c51ce410c124a10e0db5e4b97fc2af39','СуперЮзер',NULL,NULL,NULL,1),
  (15,'katarina','64803a84db40d60238b558639b41c2a8','Мельникова Екатерина',NULL,NULL,NULL,2),
  (16,'tolik','43f45e5f13f67d2232b58d9e924963a4','Анатолий Околович',NULL,NULL,NULL,1),
  (17,'evelina','bc6943b9aaacf67c1e8c9cf12631101b','Эвелина Тананаева',NULL,NULL,NULL,1);

COMMIT;

#
# Data for the `user_type` table  (LIMIT 0,500)
#

INSERT INTO `user_type` (`user_type_id`, `user_type_desk`) VALUES 
  (1,'Администратор'),
  (2,'Контент-менеджер');

COMMIT;

#
# Data for the `version` table  (LIMIT 0,500)
#

INSERT INTO `version` (`id_version`, `desk_version`) VALUES 
  (1,'ru'),
  (2,'en');

COMMIT;

#
# Data for the `work_type` table  (LIMIT 0,500)
#

INSERT INTO `work_type` (`work_id`, `work_desk`, `work_desk_en`, `work_order`, `work_status`, `work_minidesk`) VALUES 
  (1,'Сайты','Sites',1,1,'sites'),
  (2,'Флеш','Flash',2,1,'flash'),
  (3,'Интерфейсы','Interfaces',3,1,'interfaces'),
  (4,'3D','3D',5,0,'3d'),
  (5,'Мобильные','Mobile',4,1,'mobile');

COMMIT;

