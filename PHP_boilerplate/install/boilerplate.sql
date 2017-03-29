
--
-- Database: `boilerplate`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authentications`
--

CREATE TABLE IF NOT EXISTS `authentications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'refer to users.id',
  `provider` varchar(100) NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provider_uid` (`provider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  `custom_field_structure_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `custom_field_structure`
--

CREATE TABLE IF NOT EXISTS `custom_field_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `field_group_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '0=text',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `field_groups`
--

CREATE TABLE IF NOT EXISTS `field_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` int(1) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `redirect` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `email`, `title`, `redirect`) VALUES
(1, 0, 'Admin', '/'),
(2, 0, 'Free', '');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` ( `page_name`, `group_id`) VALUES
( 'admin_footer', 1),
( 'admin_settings', 1),
( 'admin_settings_alert', 1),
( 'admin_settings_general', 1),
( 'admin_settings_group', 1),
( 'admin_settings_groups', 1),
( 'admin_settings_permissions', 1),
( 'admin_settings_profile', 1),
( 'admin_settings_subscription', 1),
( 'admin_settings_subscriptions', 1),
( 'admin_settings_users', 1),
( 'billing', 1),
( 'billing', 2),
( 'billing', 3),
( 'dashboard', 3),
( 'left', 1),
( 'protected', 1),
( 'protected', 3);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `default_permission` int(1) NOT NULL,
  `public_profiles` tinyint(1) NOT NULL DEFAULT '1',
  `allow_register` tinyint(1) NOT NULL DEFAULT '1',
  `login_message` text NOT NULL,
  `restricted_message` text NOT NULL,
  `terms_conditions` text NOT NULL,
  `stripe_secret_key` varchar(100) NOT NULL,
  `stripe_public_key` varchar(100) NOT NULL,
  `mandrill_key` varchar(100) NOT NULL,
  `default_plan` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `social_settings`
--

CREATE TABLE IF NOT EXISTS `social_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(50) NOT NULL,
  `id_key` varchar(200) NOT NULL,
  `secret_key` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `social_settings`
--

INSERT INTO `social_settings` (`id`, `provider`, `id_key`, `secret_key`, `status`) VALUES
(1, 'AOL', '', '', 0),
(2, 'Yahoo', '', '', 0),
(3, 'OpenID', '', '', 0),
(4, 'Google', '', '', 0),
(5, 'Facebook', '', '', 0),
(6, 'Twitter', '', '', 0),
(7, 'Live', '', '', 0),
(8, 'LinkedIn', '', '', 0),
(9, 'Foursquare', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stripe_customer_id` varchar(50) NOT NULL,
  `update_billing` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL COMMENT '0=unpaid, 1=paid, 2=trial, 3=basic',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE IF NOT EXISTS `subscription_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stripe_plan_id` varchar(100) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `act_code` varchar(100) NOT NULL,
  `reset` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

