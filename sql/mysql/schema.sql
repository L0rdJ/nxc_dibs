CREATE TABLE IF NOT EXISTS `nxc_dibs_transactions` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `status` tinyint(3) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `user_ip` bigint(20) NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `changed` int(11) unsigned NOT NULL,
  `settings_file` varchar(255) NOT NULL,
  `extra_data` text default NULL,
  `merchant` varchar(255) NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `currency` int(3) unsigned NOT NULL,
  `order_id` int(11) unsigned default NULL,
  `payment_type` varchar(255) default NULL,
  `unique_order_id` tinyint(3) unsigned default NULL,
  `account` varchar(255) default NULL,
  `capture_now` tinyint(3) unsigned default NULL,
  `test` tinyint(3) unsigned default NULL,
  `language` char(2) default NULL,
  `color` char(6) default NULL,
  `calc_fee` varchar(255) default NULL,
  `order_text` text default NULL,
  `md5_key` char(32) default NULL,
  `accept_url` varchar(255) NOT NULL,
  `cancel_url` varchar(255) NOT NULL,
  `callback_url` varchar(255) NOT NULL,
  `transaction_id` varchar(255) default NULL,
  `auth_key` char(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `nxc_dibs_log_messages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `transaction_id`int(11) NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;