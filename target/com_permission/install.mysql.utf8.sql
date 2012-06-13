
-- --------------------------------------------------------

--
-- Table structure for table `tcl_group`
--

CREATE TABLE IF NOT EXISTS `tcl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tcl_group`
--


-- --------------------------------------------------------

--
-- Table structure for table `tcl_permission`
--

CREATE TABLE IF NOT EXISTS `tcl_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tcl_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `tlc_group_permission_links`
--

CREATE TABLE IF NOT EXISTS `tlc_group_permission_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_permission_id_links` (`permission_id`),
  KEY `fk_group_id_links` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tlc_group_permission_links`
--


-- --------------------------------------------------------

--
-- Table structure for table `tlc_user_permission_links`
--

CREATE TABLE IF NOT EXISTS `tlc_user_permission_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  KEY `fk_permission_id` (`permission_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

