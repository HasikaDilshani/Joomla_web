CREATE TABLE IF NOT EXISTS `#__sunfw_styles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `style_id` int(11) DEFAULT NULL,
  `template` varchar(250) DEFAULT '',
  `layout_builder_data` longtext,
  `mega_menu_data` longtext,
  `appearance_data` longtext,
  `system_data` longtext,
  `cookie_law_data` longtext,
   PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;
