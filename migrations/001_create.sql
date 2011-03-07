CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL auto_increment,
  `attachment_thread_id` int(11) default NULL,
  `local_file_name` varchar(500) NOT NULL,
  `original_file_name` varchar(500) NOT NULL,
  `mime_type` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=198 ;

