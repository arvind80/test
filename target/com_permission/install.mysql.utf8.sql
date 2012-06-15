
-- --------------------------------------------------------

--
-- Table structure for table `tlc_group`
--

CREATE TABLE IF NOT EXISTS `tlc_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255),
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE(`name`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tlc_group`
--


-- --------------------------------------------------------

--
-- Table structure for table `tlc_permission`
--

CREATE TABLE IF NOT EXISTS `tlc_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255),
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE(`name`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tlc_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `tlc_group_permission_links`
--

CREATE TABLE IF NOT EXISTS `tlc_group_permission_links` (
  
  `permission_id` int(11) ,
  `group_id` int(11) ,UNIQUE(`permission_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tlc_group_permission_links`
--


-- --------------------------------------------------------

--
-- Table structure for table `tlc_user_permission_links`
--

CREATE TABLE IF NOT EXISTS `tlc_user_permission_links` (
 
  `user_id` int(11) ,
  `permission_id` int(11) ,UNIQUE(`permission_id`,`user_id`)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


CREATE TABLE IF NOT EXISTS `tlc_users_groups_links` (
 
  `user_id` int(11) ,
  `group_id` int(11) ,UNIQUE(`group_id`,`user_id`)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;