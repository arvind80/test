/**
 * @package		Discuss!
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *  
 * Discuss! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

CREATE TABLE IF NOT EXISTS`#__discuss_configs` (     
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,     
	`name` VARCHAR(100) ,     
	`params` TEXT ,     
	PRIMARY KEY (`id`)  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discuss_posts` (
  `id` bigint(20) UNSIGNED NOT NULL auto_increment,
  `title` text NULL,
  `alias` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NULL DEFAULT '0000-00-00 00:00:00',
  `replied` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` longtext NOT NULL,
  `published` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `ordering` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `vote` int(11) UNSIGNED DEFAULT '0',
  `hits` int(11) UNSIGNED DEFAULT '0',
  `islock` TINYINT(1) UNSIGNED DEFAULT '0',
  `featured` TINYINT(1) UNSIGNED DEFAULT '0',
  `isresolve` TINYINT(1) UNSIGNED DEFAULT '0',
  `isreport` TINYINT(1) UNSIGNED DEFAULT '0',
  `answered` TINYINT(1) UNSIGNED DEFAULT '0',
  `user_id` bigint(20) UNSIGNED DEFAULT '0', 
  `parent_id` bigint(20) UNSIGNED DEFAULT '0',
  `user_type` varchar(255) NOT NULL,
  `poster_name` varchar(255) NOT NULL,
  `poster_email` varchar(255) NOT NULL,
  `num_likes` int(11) NULL default 0,
  `num_negvote` int(11) NULL default 0,
  `sum_totalvote` int(11) NULL default 0,
  `category_id` bigint( 20 ) UNSIGNED NOT NULL DEFAULT 1,
  `params` TEXT NOT NULL,
  `password` TEXT NULL,
  PRIMARY KEY  (`id`),
  KEY `discuss_post_published` (`published`),
  KEY `discuss_post_user_id` (`user_id`) ,
  KEY `discuss_post_vote` (`vote`),
  KEY `discuss_post_parentid` (`parent_id`),
  KEY `discuss_post_isreport` (`isreport`),
  KEY `discuss_post_answered` (`answered`),
  KEY `discuss_post_category` (`category_id`),
  KEY `discuss_post_query1` (`published`, `parent_id`, `answered`, `id`),
  KEY `discuss_post_query2` (`published`, `parent_id`, `answered`, `replied`),
  KEY `discuss_post_query3` (`published`, `parent_id`, `category_id`, `created`),
  KEY `discuss_post_query4` (`published`, `parent_id`, `category_id`, `id`),
  KEY `discuss_post_query5` (`published`, `parent_id`, `created`),
  KEY `discuss_post_query6` (`published`, `parent_id`, `id`),
  FULLTEXT `discuss_post_titlecontent` (`title`, `content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discuss_comments` (
  `id` bigint(20) UNSIGNED NOT NULL auto_increment,
  `comment` text NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `ip` varchar(255) DEFAULT '',  
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',  
  `published` tinyint(1) UNSIGNED DEFAULT '0',
  `ordering` tinyint(1) UNSIGNED DEFAULT '0',
  `post_id` bigint(20) UNSIGNED ,
  `user_id` INT(11) UNSIGNED DEFAULT '0',
  PRIMARY KEY  (`id`),
  KEY `discuss_comment_postid` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS`#__discuss_tags` (
	`id` BIGINT( 20 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
	`title` VARCHAR( 100 ) NOT NULL ,
	`alias` VARCHAR( 100 ) NOT NULL ,
	`created` DATETIME NOT NULL ,
	`published` TINYINT( 1 ) UNSIGNED DEFAULT '0',
	`user_id` INT( 11 ) UNSIGNED,
	PRIMARY KEY (`id`) ,
	KEY `discuss_tags_alias` (`alias`) ,
	KEY `discuss_tags_user_id` (`user_id`) ,
	KEY `discuss_tags_published` (`published`),
	KEY `discuss_tags_query1` (`published`, `id`),
	FULLTEXT `discuss_tags_title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discuss_posts_tags` (     
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,     
	`post_id` BIGINT(20) UNSIGNED ,     
	`tag_id` BIGINT(20) UNSIGNED ,     
	PRIMARY KEY (`id`) ,
	KEY `discuss_posts_tags_tagid` (`tag_id`) ,
	KEY `discuss_posts_tags_postid` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discuss_votes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `ipaddress` varchar(15) DEFAULT NULL,
  `value` TINYINT(2) DEFAULT '0' NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_user_post` (`user_id`, `post_id`),
  KEY `discuss_post_id` (`post_id`),
  KEY `discuss_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_likes` (
	`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`type` VARCHAR( 20 ) NOT NULL ,
	`content_id` INT( 11 ) NOT NULL ,
  	`created_by` bigint(20) unsigned NULL DEFAULT 0,
  	`created` datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY  (`id`),
	KEY `discuss_content_type` (`type`, `content_id`),
	KEY `discuss_contentid` (`content_id`),
	KEY `discuss_createdby` (`created_by`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_reports` (
	`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`post_id` INT( 11 ) NOT NULL ,
	`reason` text NULL,
  	`created_by` bigint(20) unsigned NULL DEFAULT 0,
  	`created` datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY  (`id`),
	KEY `discuss_reports_post` (`post_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_mailq` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mailfrom` varchar(255) NULL,
  `fromname` varchar(255) NULL,
  `recipient` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ashtml` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `discuss_mailq_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discuss_users` (
  `id` bigint(20) unsigned NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` text,
  `url` varchar(255) DEFAULT NULL,
  `params` text,
  `alias` varchar(255) DEFAULT NULL,
  `points` BIGINT DEFAULT '0' NOT NULL,
  `latitude` VARCHAR( 255 ) NULL DEFAULT NULL,
  `longitude` VARCHAR( 255 ) NULL DEFAULT NULL,
  `location` TEXT NOT NULL,
  `signature` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_users_alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_subscription` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `member` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(100) NOT NULL DEFAULT 'daily',
  `cid` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `interval` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `sent_out` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_attachments` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `path` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  `mime` text NOT NULL,
  `size` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__discuss_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT '',
  `alias` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `private` int(11) unsigned NOT NULL DEFAULT '0',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `level` int(11) NULL,
  `lft` int(11) NULL,
  `rgt` int(11) NULL,
  `params` TEXT NOT NULL,
  `container` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `discuss_cat_published` (`published`),
  KEY `discuss_cat_parentid` (`parent_id`),
  KEY `discuss_cat_mod_categories1` (`published`, `private`, `id`),
  KEY `discuss_cat_mod_categories2` (`published`, `private`, `ordering`),
  KEY `discuss_cat_acl` (`parent_id`, `published`, `ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discuss_acl` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `discuss_post_acl_action` (`action`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_acl_group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint(20) unsigned NOT NULL,
  `acl_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_post_acl_content_type` (`content_id`,`type`),
  KEY `discuss_post_acl` (`acl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_hashkeys` (
  `id` bigint(11) NOT NULL auto_increment,
  `uid` bigint(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `key` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `cid` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `target` bigint(20) NOT NULL,
  `author` bigint(20) NOT NULL,
  `permalink` text NOT NULL,
  `state` tinyint(4) NOT NULL,
  `favicon` TEXT NOT NULL,
  `component` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_notification_created` (`created`),
  KEY `discuss_notification` (`target`, `state`, `cid`, `created`, `id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__discuss_category_acl_item` (
  `id` bigint(20) NOT NULL auto_increment,
  `action` varchar(255) NOT NULL,
  `description` text,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `default` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__discuss_category_acl_map` (
  `id` bigint(20) NOT NULL auto_increment,
  `category_id` bigint(20) NOT NULL,
  `acl_id` bigint(20) NOT NULL,
  `type` varchar(25) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `status` tinyint(1) default 0,
  PRIMARY KEY  (`id`),
  KEY `discuss_category_acl` (`category_id`),
  KEY `discuss_category_acl_id` (`acl_id`),
  KEY `discuss_content_type` (`content_id`, `type`),
  KEY `discuss_category_content_type` (`category_id`, `content_id`, `type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__discuss_badges` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rule_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `alias` VARCHAR( 255 ) NOT NULL,
  `description` text NOT NULL,
  `avatar` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  `rule_limit` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_badges_alias` (`alias`),
  KEY `discuss_badges_published` (`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_badges_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `command` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_badges_rules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `command` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `callback` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_badges_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `badge_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `badge_id` (`badge_id`,`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discuss_points` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rule_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  `rule_limit` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_points_rule` (`rule_id`),
  KEY `discuss_points_published` (`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_rules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `command` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `callback` text NOT NULL,
  `created` datetime NOT NULL,
  `published` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_rules_command` ( `command` (255) )
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_users_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `command` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_ranks` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `start` bigint(20) NOT NULL default 0,
  `end` bigint(20) NOT NULL default 0,
  PRIMARY KEY (`id`),
  KEY `discuss_ranks_range` ( `start`, `end` )
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_oauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `request_token` text NOT NULL,
  `access_token` text NOT NULL,
  `message` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discuss_oauth_type` ( `type` )
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_oauth_posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `oauth_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_migrators` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `internal_id` bigint(20) NOT NULL,
  `external_id` bigint(20) NOT NULL,
  `component` text NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_views` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `hash` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__discuss_polls` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `#__discuss_polls_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `poll_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`,`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__discuss_posts_references` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `reference_id` bigint(20) NOT NULL,
  `extension` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`,`reference_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discuss_ranks_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rank_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ranks_users` (`rank_id`,`user_id`),
  KEY `ranks_id` (`rank_id`),
  KEY `ranks_userid` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

/* default category acl type */
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('1', 'select', 'can select the category during question creation', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('2', 'view', 'can view the category posts.', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';
INSERT INTO `#__discuss_category_acl_item` (`id`, `action`, `description`, `published`, `default`) values ('3', 'reply', 'can reply to category posts', 1, 1) ON DUPLICATE KEY UPDATE `default` = '1';

/* default ranks */
INSERT INTO `#__discuss_ranks` (`id`, `title`, `start`, `end` ) values ('1', 'New Member', '1', '50') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_ranks` (`id`, `title`, `start`, `end` ) values ('2', 'Junior Member', '51', '150') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_ranks` (`id`, `title`, `start`, `end` ) values ('3', 'Senior Member', '151', '350') ON DUPLICATE KEY UPDATE `id` = `id`;
INSERT INTO `#__discuss_ranks` (`id`, `title`, `start`, `end` ) values ('4', 'Expert Member', '351', '600') ON DUPLICATE KEY UPDATE `id` = `id`;
