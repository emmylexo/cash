-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2020 at 08:58 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `best`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `status` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `last_login_ip` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `role`, `username`, `password`, `email`, `full_name`, `phone`, `photo`, `address`, `city`, `state`, `country`, `bio`, `status`, `ip`, `last_login_ip`, `date_added`, `last_login`, `updated_date`) VALUES
(1, 'Administrator', 'administrator', '$2y$10$3oftPaBZaaqakgQ8vF5k9.h2.B9SpdnnAcSQ7hKys35ScTye7gMv6', 'administrator@mysite.com', 'Ojaola Limited', '08059915730', '../img/admin/4262f51c185869d12b4bf7fe33b73f1e.png', '12, Olawaiye Street, Anifowoshe', 'Ikeja', 'Lagos', 'Nigeria', 'Enter information about yourself here.', 1, 1, 197211, '2016-03-20 00:00:00', '2020-06-13 18:49:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_activity`
--

CREATE TABLE `admin_login_activity` (
  `id` int(11) NOT NULL,
  `admin` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `last_access` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------



--
-- Table structure for table `bank_info`
--

CREATE TABLE `bank_info` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `cashname` varchar(100) NOT NULL,
  `cashnumber` varchar(100) NOT NULL,
  `cashbank` varchar(100) NOT NULL,
  `cashtel` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `signup_bonus` int(11) NOT NULL,
  `referral_bonus` double NOT NULL,
  `min_referral_payout` double NOT NULL,
  `creditbility` int(11) NOT NULL,
  `min_credit_payout` double NOT NULL,
  `credit_pop_upload` int(11) NOT NULL,
  `credit_pop_confirm` int(11) NOT NULL,
  `credit_profile_photo` int(11) NOT NULL,
  `credit_testimony` int(11) NOT NULL,
  `credit_video_testimony` int(11) NOT NULL,
  `credit_referral` int(11) NOT NULL,
  `ph_percentage` int(11) NOT NULL,
  `down_pay` int(11) NOT NULL,
  `min_ph` double NOT NULL,
  `max_ph` double NOT NULL,
  `min_gh` double NOT NULL,
  `max_gh` double NOT NULL,
  `ph_maturity` varchar(100) NOT NULL,
  `ph_timer` varchar(100) NOT NULL,
  `ph_auto_merge_timer` varchar(100) NOT NULL,
  `pay_instructions` text NOT NULL,
  `pay_confirmation_instr` varchar(255) NOT NULL,
  `pop_confirm` varchar(100) NOT NULL,
  `auto_merge` varchar(100) NOT NULL,
  `recommit_perc` int(11) NOT NULL,
  `recommit_perc_opt` int(11) NOT NULL,
  `recommit_bonus` int(11) NOT NULL,
  `email_note` varchar(100) NOT NULL,
  `sms_note` varchar(100) NOT NULL,
  `sms_sender` varchar(100) NOT NULL,
  `sms_port` varchar(100) NOT NULL,
  `sms_gateway_url` varchar(255) NOT NULL,
  `sms_gateway_user` varchar(100) NOT NULL,
  `sms_gateway_pass` varchar(100) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `signup_bonus`, `referral_bonus`, `min_referral_payout`, `creditbility`, `min_credit_payout`, `credit_pop_upload`, `credit_pop_confirm`, `credit_profile_photo`, `credit_testimony`, `credit_video_testimony`, `credit_referral`, `ph_percentage`, `down_pay`, `min_ph`, `max_ph`, `min_gh`, `max_gh`, `ph_maturity`, `ph_timer`, `ph_auto_merge_timer`, `pay_instructions`, `pay_confirmation_instr`, `pop_confirm`, `auto_merge`, `recommit_perc`, `recommit_perc_opt`, `recommit_bonus`, `email_note`, `sms_note`, `sms_sender`, `sms_port`, `sms_gateway_url`, `sms_gateway_user`, `sms_gateway_pass`, `last_updated`) VALUES
(1, 0, 2.5, 10000, 100, 0, 10, 10, 10, 5, 10, 10, 50, 20, 100, 5000, 100, 5, '7 days', '+24 hours', '+30 minutes', 'We\'ve found a sponsor for you, ensure you donate the allocated amount to the sponsor within 24 Hours, otherwise, your account would be blocked!', 'Please conform this payment within 6 hours else it will be automatically confirmed.', '+6 hours', 'Enabled', 20, 70, 5, 'Enabled', 'Enabled', 'Royacle', '8080', '121.241.242.114/', 'userxxxxx', 'passxxxxx', '2017-08-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `ctn_id` int(11) NOT NULL,
  `abt_title` varchar(225) NOT NULL,
  `about` longtext NOT NULL,
  `terms_title` varchar(225) NOT NULL,
  `terms` longtext NOT NULL,
  `policy_title` varchar(225) NOT NULL,
  `policy` longtext NOT NULL,
  `biz_fb` varchar(255) NOT NULL,
  `biz_twitter` varchar(255) NOT NULL,
  `biz_linkedin` varchar(255) NOT NULL,
  `biz_g_plus` varchar(255) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`ctn_id`, `abt_title`, `about`, `terms_title`, `terms`, `policy_title`, `policy`, `biz_fb`, `biz_twitter`, `biz_linkedin`, `biz_g_plus`, `last_updated`) VALUES
(1, 'About us', '<p>Royal Empire is a social financial platform that has been designed for communities to donate money to each other directly, in a peer to peer method, where a large community of people donates money to each other, in order to help each other fulfil projects or personal obligations. Royal Empire is not a bank. Royal Empire does not collect your money. Royal Empire is not an online business, HYIP or MLM program because it does not have a central bank account into which all users give money into. Instead, users are paired together with other users on the platform, and they donate to each other directly, of their own free will.<br /><br />After making such donation a participant receives up to 100% bonus for whatever they donate every 10 days. We give you a technical basic program, which helps millions of participants worldwide to find those who NEED help, and those who are ready to PROVIDE help for FREE no lenders &amp; no debtors. There are no lenders and no debtors. Everything is very simple: one participant asks for help &ndash; another one helps. When you provide help to a member, another will provide help to you with 100% Increase in 10 days maximum after RECOMMITTING to provide another help to keep the Empire healthy. <br /><br />All funds transferred to other participants are help given at your own<br />good to another participant, absolutely gratis</p>', 'How it Works', '<p>Summarily, you declare the willingness to Provide Help by making a pledge. The Help provided will start growing from the moment you make the pledge (at the rate of 100% in 10days). Within 5 days of making your pledge you will be paired to make donation directly to a participant (or participants) whose details are given to you. These details includes; recipient&rsquo;s name, recipient&rsquo;s bank account details and recipient&rsquo;s contact detail. After making the said payment to the recipient, then you indicate that the payment has been made by uploading your proof of payment (POP). <br /><br />Upon receiving the said amount, the recipient indicates that the donation has been received. Within the next 10daysfrom your PH date, your maturity time is completed and you are due to receive payment of your initial investment and incentive (100%) after recommitting atleast 50% of your matured investment within the 11th and 12th day. E.g. you have announced willingness to assist with $100, the yield amount will immediately start growing! 10days later, this $100 will become $200, but you will have to provide another help of atleast $100 again within the 11th and 12th day before you can receive your matured investment ($200), this is to keep the Empire strong and healthy. <br /><br />That is how it works.</p>', 'Credibility Score Index', '<p>none</p>', '#', '#', '#', '#', '2017-10-04 13:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `c_id` int(11) NOT NULL,
  `c_default` int(11) NOT NULL,
  `c_country` varchar(100) NOT NULL,
  `c_code` varchar(5) NOT NULL,
  `c_symbol` text NOT NULL,
  `c_added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`c_id`, `c_default`, `c_country`, `c_code`, `c_symbol`, `c_added_date`) VALUES
(6, 0, 'United States', 'USD', '$', '2017-04-29 21:33:36'),
(7, 0, 'United Kingdom', 'GBP', 'Â£', '2017-04-29 21:34:02'),
(8, 0, 'Spain', 'EUR', 'â‚¬', '2017-04-29 21:34:45'),
(10, 0, 'Nigeria', 'NGN', 'â‚¦', '2017-07-17 17:48:08'),
(12, 1, 'Ghana', 'GHS', 'â‚µ', '2017-09-03 22:24:52'),
(13, 0, 'Ghana', 'GHS', 'â‚µ', '2018-03-01 21:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_graph`
--

CREATE TABLE `facebook_graph` (
  `id` int(11) NOT NULL,
  `app_id` varchar(225) NOT NULL,
  `app_secret` varchar(255) NOT NULL,
  `page_access_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `get_help`
--

CREATE TABLE `get_help` (
  `gh_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `g_amount` double NOT NULL,
  `g_withdrawn` double NOT NULL,
  `g_status` varchar(100) NOT NULL,
  `req_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `slide_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`slide_id`, `title`, `url`, `banner`, `descr`, `status`) VALUES
(5, 'BEST THEMES DESIGN', '#', '../img/slider/ccb6ac731b6422b7e1dcbdf06bcbad94.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod ut laoreet dolore magna aliquam erat volutpat.', 1),
(6, 'BEST ADVERTISING', '', '../img/slider/7a7b6b1af7b3c765f4791356d3d345dd.png', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod ut laoreet dolore magna aliquam erat volutpat.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messaging`
--

CREATE TABLE `messaging` (
  `msg_id` int(11) NOT NULL,
  `msg_number` double NOT NULL,
  `admin_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `time_frame` varchar(100) NOT NULL,
  `budget` double NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `hidden_by` varchar(100) NOT NULL,
  `date_read` varchar(100) NOT NULL,
  `date_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `admin` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `readers` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `admin` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `readers` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `action_url` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `ph_id` int(11) NOT NULL,
  `gh_id` int(11) NOT NULL,
  `payer_id` int(11) NOT NULL,
  `payee_id` int(11) NOT NULL,
  `ord_amount` double NOT NULL,
  `pop` varchar(255) NOT NULL,
  `ord_status` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `flag_date` varchar(100) NOT NULL,
  `period_timer` varchar(100) NOT NULL,
  `pop_date` varchar(100) NOT NULL,
  `date_paid` varchar(100) NOT NULL,
  `ord_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `provide_help`
--

CREATE TABLE `provide_help` (
  `ph_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `plan` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `interest` double NOT NULL,
  `bonus` double NOT NULL,
  `paid` double NOT NULL,
  `gh_amount` double NOT NULL,
  `ph_control` int(11) NOT NULL,
  `ph_on` int(11) NOT NULL,
  `request_amt` double NOT NULL,
  `ph_status` varchar(100) NOT NULL,
  `gh_status` int(11) NOT NULL,
  `matured_date` datetime NOT NULL,
  `ph_auto_merge_timer` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `last_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `id` int(11) NOT NULL,
  `ph_id` int(11) NOT NULL,
  `referree_id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `ph_amount` double NOT NULL,
  `bonus` double NOT NULL,
  `pay_status` int(11) NOT NULL,
  `credit_status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `video` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `ord_id`, `login_id`, `content`, `video`, `status`, `date_added`) VALUES
(8, 0, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '', 1, '2017-09-02 12:25:02'),
(9, 0, 52, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '', 1, '2017-09-04 00:45:03'),
(13, 25, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '', 1, '2017-10-04 00:39:54'),
(17, 0, 51, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '', 1, '2017-10-04 13:22:16'),
(18, 0, 55, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '', 1, '2017-10-04 13:42:03'),
(19, 27, 51, 'Please write Letter of Happiness to continue\r\n', '', 0, '2017-10-04 14:39:15'),
(20, 34, 51, 'ease write Letter of Happiness to continue\r\n', '', 1, '2017-10-04 14:44:22'),
(21, 16, 1, 'rite Letter of Happiness to continue', '', 0, '2017-10-12 14:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `login_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `referral` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `creditbility` double NOT NULL,
  `email_code` varchar(100) NOT NULL,
  `sms_code` varchar(100) NOT NULL,
  `email_verify` int(11) NOT NULL,
  `sms_verify` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `signup_ip` varchar(100) NOT NULL,
  `signup_date` datetime NOT NULL,
  `last_login_ip` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`login_id`, `email`, `password`, `first_name`, `last_name`, `phone`, `gender`, `referral`, `photo`, `location`, `bio`, `creditbility`, `email_code`, `sms_code`, `email_verify`, `sms_verify`, `status`, `signup_ip`, `signup_date`, `last_login_ip`, `last_login`, `last_updated`) VALUES
(63, 'globalmoneymax@yahoo.com', '$2y$10$0pDQEzdmxf0k6fuLRiI2z.s3L0dyh9rYOJOpbjLROMNSps8Ju83o6', 'Globalmoneymax', 'Francis', '08059915730', 'Male', 62, '', ' , ', '', 0, 'GL3TUM', 'WFEZ9J', 0, 0, 'Blockd', '154.120.108.66', '2018-03-01 20:44:29', '', '2018-03-01 21:25:46', '2018-03-01 20:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_credibility`
--

CREATE TABLE `user_credibility` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `score` double NOT NULL,
  `credit_status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_login_activity`
--

CREATE TABLE `user_login_activity` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `last_access` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `action_url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `website` varchar(255) NOT NULL,
  `curr_version` varchar(255) NOT NULL,
  `version_date` datetime NOT NULL,
  `client_host` varchar(255) NOT NULL,
  `client_addr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `website`, `curr_version`, `version_date`, `client_host`, `client_addr`) VALUES
(1, 'Ojaolawebsolution', 'www.ojaolawebsolution.com', '2.6', '2020-04-12 00:00:00', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `isp` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `os` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `v_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` int(11) NOT NULL,
  `biz_name` varchar(255) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `site_title` varchar(100) NOT NULL,
  `site_description` varchar(255) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `favicon_url` varchar(225) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `biz_addr` varchar(225) NOT NULL,
  `biz_city` varchar(100) NOT NULL,
  `biz_state` varchar(100) NOT NULL,
  `biz_country` varchar(100) NOT NULL,
  `biz_phone` double NOT NULL,
  `chat_code` text NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `biz_name`, `site_name`, `site_title`, `site_description`, `site_url`, `favicon_url`, `logo_url`, `biz_addr`, `biz_city`, `biz_state`, `biz_country`, `biz_phone`, `chat_code`, `last_modified`) VALUES
(1, 'Ojaola multipurpose Ltd', 'Royacle', 'Welcome to Royacle', 'Here is my default site description.....', 'www.ojaolawebsolution.com', '../images/6bbb860bc90326d162752565df3199fc.png', '../images/a0912863278a4138e1c18f7b42ed9e2d.png', '12, Olawaiye Street, Anifowoshe', 'Ikeja', 'Lagos', 'Nigeria', 2348000000000, '<!--Start of Tawk.to Script-->\r\n<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5970bab20d1bb37f1f7a5144/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>\r\n<!--End of Tawk.to Script-->', '2020-10-03 10:50:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_login_activity`
--
ALTER TABLE `admin_login_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_info`
--
ALTER TABLE `bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`ctn_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `facebook_graph`
--
ALTER TABLE `facebook_graph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `get_help`
--
ALTER TABLE `get_help`
  ADD PRIMARY KEY (`gh_id`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `messaging`
--
ALTER TABLE `messaging`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`);

--
-- Indexes for table `provide_help`
--
ALTER TABLE `provide_help`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ph_id` (`ph_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `user_credibility`
--
ALTER TABLE `user_credibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login_activity`
--
ALTER TABLE `user_login_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_login_activity`
--
ALTER TABLE `admin_login_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `ctn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `facebook_graph`
--
ALTER TABLE `facebook_graph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `get_help`
--
ALTER TABLE `get_help`
  MODIFY `gh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messaging`
--
ALTER TABLE `messaging`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `provide_help`
--
ALTER TABLE `provide_help`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `user_credibility`
--
ALTER TABLE `user_credibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_login_activity`
--
ALTER TABLE `user_login_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
