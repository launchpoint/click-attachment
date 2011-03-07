CREATE TABLE IF NOT EXISTS `attachment_threads` (
  `id` int(11) NOT NULL auto_increment,
  `object_type` varchar(50) NOT NULL,
  `object_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `object_type` (`object_type`,`object_id`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;
