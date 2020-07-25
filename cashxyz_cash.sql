-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2020 at 07:50 AM
-- Server version: 5.7.30-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `role`, `username`, `password`, `email`, `full_name`, `phone`, `photo`, `address`, `city`, `state`, `country`, `bio`, `status`, `ip`, `last_login_ip`, `date_added`, `last_login`, `updated_date`) VALUES
(1, 'Administrator', 'admin', '$2y$10$3oftPaBZaaqakgQ8vF5k9.h2.B9SpdnnAcSQ7hKys35ScTye7gMv6', 'administrator@mysite.com', 'Ojaola Limited', '08059915730', '../img/admin/4262f51c185869d12b4bf7fe33b73f1e.png', '12, Olawaiye Street, Anifowoshe', 'Ikeja', 'Lagos', 'Nigeria', 'Enter information about yourself here.', 1, 1, 197211, '2016-03-20 00:00:00', '2020-07-25 08:11:03', '0000-00-00 00:00:00'),
(4, 'Editor', 'dovetech', '$2y$10$TCMwPXlpIEDtIgaRV7rvquSHNU6.u3xR0BIIUcHQvJQ9/G2dZXfAa', 'abayomid01@gmail.com', 'abayomi daniel', '08109645630', '', 'kogistate nigeria', 'kabba', 'kogi state', 'Nigeria', '', 1, 0, 0, '2020-07-25 03:28:59', '2020-07-25 02:28:59', '0000-00-00 00:00:00');

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

--
-- Dumping data for table `admin_login_activity`
--

INSERT INTO `admin_login_activity` (`id`, `admin`, `ip`, `browser`, `os`, `last_access`) VALUES
(1, 'admin', '129.205.124.95', 'Chrome', 'Windows 10', '2020-07-25 09:22:29'),
(2, 'admin', '129.205.124.95', 'Chrome', 'Windows 10', '2020-07-25 09:58:56'),
(3, 'admin', '197.210.84.54', 'Handheld Browser', 'Android', '2020-07-25 10:25:22'),
(4, 'admin', '197.210.84.54', 'Handheld Browser', 'Android', '2020-07-25 10:38:35'),
(5, 'admin', '129.205.113.85', 'Chrome', 'Windows 10', '2020-07-25 12:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `admin_turns`
--

CREATE TABLE `admin_turns` (
  `id` int(11) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `next` tinyint(1) NOT NULL DEFAULT '0',
  `times_paid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_turns`
--

INSERT INTO `admin_turns` (`id`, `account_name`, `account_number`, `bank_name`, `phone_number`, `next`, `times_paid`) VALUES
(1, 'Akarawak Emmanuel Bassey', '2096821073', 'UBA', '08059372268', 0, 0),
(2, 'Akarawak Emmanuel Bassey', '2153289819', 'UBA', '07082015673', 0, 0),
(3, 'Akarawak O. Bassey', '3089533124', 'First Bank', '09072003781', 0, 0),
(4, 'Grace Bassey', '0022613230', 'Access Bank', '08131208262', 0, 0),
(5, 'Akarawak Emmanuel Bassey', '2117169067', 'Zenith Bank', '08164993708', 0, 0),
(6, 'Clement A. Akadu', '0016813196', 'Diamond bank', '07030858915', 0, 0),
(7, 'Clement A. Akadu', '0039183737', 'GT Bank', '', 1, 0),
(8, 'Clement A. Akadu', '2175810666', 'Zenith Bank', '', 0, 0),
(9, 'Clement A. Akadu', '3074808651', 'First Bank', '', 0, 0),
(10, 'Nyiam Dorathy Etta', '0117804428', 'GTB', '07065793290', 0, 0),
(11, 'Nyiam Dorathy Etta', '0067218478 ', 'Sterling bank', '07065793290', 0, 0);

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

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `login_id`, `account_name`, `account_number`, `bank`, `cashname`, `cashnumber`, `cashbank`, `cashtel`, `date_added`) VALUES
(1, 1, 'LEELEE CHARITY', '0077435285', 'Sterling Bank', '', '', '', '', '2020-07-25 09:20:43'),
(2, 2, 'CLEMENT ASUQUO AKADU', '0016813196', 'Access Bank (Diamond)', '', '', '', '', '2020-07-25 09:26:04'),
(3, 3, 'AKARAWAK EMMANUEL BASSEY', '2096821073', 'United Bank For Africa', '', '', '', '', '2020-07-25 09:28:45'),
(4, 4, 'INYANG  BERNARD CHRISTOPHER', '0558806261', 'Guaranty Trust Bank', '', '', '', '', '2020-07-25 09:50:17'),
(5, 5, 'OMORUYI OSARHIEMEN OSAHENVBAHIHE', '3140835150', 'First Bank of Nigeria', '', '', '', '', '2020-07-25 10:24:46'),
(6, 6, 'OBI,CHINONSO', '0040421631', 'Guaranty Trust Bank', '', '', '', '', '2020-07-25 10:37:45');

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
(1, 0, 5, 10000, 100, 0, 10, 10, 0, 5, 15, 0, 50, 20, 100, 5000, 100, 5, '+5 days', '+12 hours', '+30 minutes', 'We\'ve found a sponsor for you, ensure you donate the allocated amount to the sponsor within 12 Hours, otherwise, your account would be penalized!', 'Please confirm this payment within 12 hours. Thank you for being a part of Cash360', '+144 hours', 'Enabled', 100, 70, 5, '', 'Enabled', 'Cash360', '8080', '121.241.242.114/', 'userxxxxx', 'passxxxxx', '2017-08-26 00:00:00');

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
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`ctn_id`, `abt_title`, `about`, `terms_title`, `terms`, `policy_title`, `policy`, `biz_fb`, `biz_twitter`, `biz_linkedin`, `biz_g_plus`, `last_updated`) VALUES
(1, 'About us', '<h1 style=\"color: #ff0000;\"><strong>Who We Are</strong></h1>\r\n<p><span style=\"color: #3366ff;\"><strong>Cash360 perfectly describes our all-encompassing approach to providing a superlative donation platform with topnotch cyber security and very robust interest rate for all your cash donations with us alongside other unique services tailor made for you. Cash360 is more than just a peer to peer donation platform, it is what you require and you can do a lot with this platform. We are a genuinely nationwide business with an experienced workforce focusing on the needs of our customers to deliver solutions others may be unable to. We help you make income online using your smart phones, laptops or other electronic gadgets.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>Note: Referral plan is available for mouthwatering bonuses but it\'s however not compulsory. You advertise and refer your friends for your benefits. Periodic draws will be made for huge wins. Watch out!</strong></span></p>\r\n<p>&nbsp;</p>\r\n<h1 style=\"color: #ff0000;\"><strong>OUR SERVICE:</strong></h1>\r\n<p><strong><span style=\"color: #3366ff;\">Regular Donation: Our <a style=\"color: #3366ff;\" href=\"https://www.rl360.com/row/products/regular-savings-plan/\">Regular Donation Plan</a> gives a nationwide service, it allows participants have a simple way to build wealth by direct investment into a quality peer to peer funding system ranging from N5,000 to N1,000,000 maximum. There is an activation policy before gaining access to invest on our platform. Mind you that it takes 5 days for our regular&nbsp;donation to mature for withdrawal. All you need do is to get registered, pay your activation fee of N1000 and then give a donation depending on your capacity and once you are confirmed, your investment starts growing and matures for withdrawal after 5 days.</span></strong></p>\r\n<p>&nbsp;</p>\r\n<h1 style=\"color: #ff0000;\"><strong>OUR OPERATIONAL OFFER:</strong></h1>\r\n<ol>\r\n<li><strong><span style=\"color: #3366ff;\">50% returns on donations in 5 days.</span></strong></li>\r\n<li><strong><span style=\"color: #3366ff;\">5% referral bonus on every donation of your referrals</span></strong></li>\r\n<li><strong><span style=\"color: #3366ff;\">Recommitment of at least 100% of initial donation is mandatory before withdrawal. Subsequent withdrawal will precede a 15% minimum increment of previous donation.</span></strong></li>\r\n<li><strong><span style=\"color: #3366ff;\">â‚¦5,000 minimum donation.</span></strong></li>\r\n<li><strong><span style=\"color: #3366ff;\">â‚¦1,000,000 maximum donation.</span></strong></li>\r\n<li><strong><span style=\"color: #3366ff;\">12 hours period to make payment of your pledged donation to avoid being penalized by the system. System will automatically deduct N2,000 fine from any user&rsquo;s account that defaults.</span></strong></li>\r\n<li><strong><span style=\"color: #3366ff;\">Be rest assured that you are donating on one of the most secured online donation platform... (your investments are fully secured)</span></strong></li>\r\n<li><strong><span style=\"color: #3366ff;\">Unlimited number of Donations at the same time is not allowed on your Dashboard until your donation reaches its maturity period then you can recommit.</span></strong></li>\r\n</ol>\r\n<p><strong><span style=\"color: #3366ff;\"><span style=\"color: #ff0000;\">PLEASE NOTE:</span>&nbsp; For every MATCH, you have maximum of 12 hours to make payment and upload your proof of payment, else your account would be automatically penalized (You will be required to pay a fine of â‚¦2,000 for the penalty)</span></strong></p>\r\n<h1 style=\"color: #ff0000;\">&nbsp;</h1>', 'How it Works', '<h1 style=\"color: #ff0000;\">&nbsp;</h1>\r\n<h1 style=\"color: #ff0000;\">&nbsp;<strong>REGISTRATION PROCESS SUMMARIZED</strong></h1>\r\n<ol>\r\n<li><span style=\"color: #3366ff;\">Register: https://cash360.com.ng/user/register</span></li>\r\n<li><span style=\"color: #3366ff;\">Pay in an ACTIVATION FEE of â‚¦1,000 into the account details matched to your dashboard and upload your proof of payment.</span></li>\r\n<li><span style=\"color: #3366ff;\">After uploading your POP (Proof of Payment Screenshot), wait to be confirmed</span></li>\r\n<li><span style=\"color: #3366ff;\">After confirmation, Click on DONATE and Give Donation with the amount of your choice not less than â‚¦5,000 (Ranging from N5000 to N1,000,000).</span></li>\r\n<li><span style=\"color: #3366ff;\">You will be automatically matched to pay to another user, get the person&rsquo;s details from your dashboard and make payment.</span></li>\r\n<li><span style=\"color: #3366ff;\">Upload your proof of payment and wait to be confirmed</span></li>\r\n<li><span style=\"color: #3366ff;\">Once your transaction has been confirmed, go to monitor investment and watch your investment grow for the next 5days</span></li>\r\n</ol>\r\n<p><span style=\"color: #3366ff;\"><span style=\"color: #ff0000;\"><strong>Note:</strong></span> <strong>You are advised to have more than one investment at a time on your dashboard so as to be able to withdraw any due for withdrawal.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\">Please you are advised to use Mobile Banking App, Internet Banking, Bank Deposits to make transactions on this platform. Do not pay in cash or use ATM transfers.</span></p>\r\n<h1 style=\"color: #ff0000;\"><strong>OUR STRICT OPERATIONAL RULES:</strong></h1>\r\n<ol>\r\n<li><span style=\"color: #3366ff;\">You are not allowed to recommit less than your previous donation in the platform.</span></li>\r\n<li><span style=\"color: #3366ff;\">You are required to make a 15% increment on your previous donation after every cashout.</span></li>\r\n<li><span style=\"color: #3366ff;\">If you need to make any complain, please contact either the customer care, technical support team or the administrators.</span></li>\r\n<li><span style=\"color: #3366ff;\">You should endeavour to coordinate your downlines, if they break any of our rules, it may delay withdrawals.</span></li>\r\n<li><span style=\"color: #3366ff;\">Before receiving payment, it is mandatory to recommit in the platform to ensure continuity and quick withdrawals.</span></li>\r\n<li><span style=\"color: #3366ff;\">You are only to pay to the account on your dashboard; don\'t make any payment to any other account.</span></li>\r\n<li><span style=\"color: #3366ff;\">No fake pop, else your account will be penalized by the system to pay a fine of N2,000 because our system will detect it</span></li>\r\n<li><span style=\"color: #3366ff;\">Use the complaint form for any complaints or chat the customer care center on our live chat or chat us up on WhatsApp and Telegram or send an email to the email addresses on the contact us.</span></li>\r\n<li><span style=\"color: #3366ff;\">Testimonials are recommended and after each cash out as they serve as a form of advertisement.</span></li>\r\n<li><span style=\"color: #3366ff;\">Video Testimonials are for advert purposes only and they come with some form of incentives to appreciate our loyal customers, however, this is not compulsory.</span></li>\r\n</ol>', 'Credibility Score Index', '<p>You have been awarded credibility score for your commitment to Cash360</p>', '#', '#', '#', '#', '2020-07-25 01:55:18');

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
(12, 0, 'Ghana', 'GHS', 'â‚µ', '2017-09-03 22:24:52'),
(13, 0, 'Ghana', 'GHS', 'â‚µ', '2018-03-01 21:27:00'),
(14, 1, 'Nigeria', 'NGN', 'â‚¦', '2020-07-25 00:39:21');

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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `admin`, `subject`, `content`, `readers`, `status`, `date_added`) VALUES
(4, 'administrator', '15% compulsory incremental donation', '<p><span style=\"color: #ff0000; background-color: #ccffff;\">Please note that after every successful donation and recommitment, you are expected to do an increment of your initial donation by 15% after donation and recommitment. This is for our sustainity and any defaults will be fined. Thank you</span></p>', ', 85, 2', 1, '2020-07-25 02:27:14');

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `admin`, `action`, `readers`, `type`, `action_url`, `status`, `date_added`) VALUES
(1, 'admin', 'admin has logged in!', '', 'Login', 'admin-profile?admu=admin', 0, '2020-07-25 09:18:51'),
(2, '', 'Naomi Richard has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=1', 0, '2020-07-25 09:20:24'),
(3, '', 'Naomi Richard. has uploaded POP for Donate order', '', 'POP Submitted', 'approve?ordid=1', 0, '2020-07-25 09:21:06'),
(4, 'admin', 'admin has logged out!', '', 'Logout', 'admin-profile?admu=admin', 0, '2020-07-25 09:22:29'),
(5, '', 'Clement  Akadu has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=2', 0, '2020-07-25 09:22:58'),
(6, '', 'Clement  Akadu. has uploaded POP for Donate order', '', 'POP Submitted', 'approve?ordid=2', 0, '2020-07-25 09:28:07'),
(7, '', 'Emmanuel Akarawak has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=3', 0, '2020-07-25 09:28:16'),
(8, 'admin', 'admin has logged in!', '', 'Login', 'admin-profile?admu=admin', 0, '2020-07-25 09:42:11'),
(9, '', 'Bernard Inyang has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=4', 0, '2020-07-25 09:50:03'),
(10, '', 'Bernard Inyang. has uploaded POP for Donate order', '', 'POP Submitted', 'approve?ordid=4', 0, '2020-07-25 09:50:32'),
(11, 'admin', 'admin has logged in!', '', 'Login', 'admin-profile?admu=admin', 0, '2020-07-25 10:22:37'),
(12, '', 'Bernard Inyang has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=5', 0, '2020-07-25 10:24:18'),
(13, '', 'Bernard Inyang. has uploaded POP for Donate order', '', 'POP Submitted', 'approve?ordid=5', 0, '2020-07-25 10:24:58'),
(14, 'admin', 'admin, has Activated user account', '', 'Account unrestricted', 'customer-summary?uid=5', 0, '2020-07-25 10:25:22'),
(15, '', 'Justin Obi has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=6', 0, '2020-07-25 10:37:30'),
(16, 'admin', 'admin has logged in!', '', 'Login', 'admin-profile?admu=admin', 0, '2020-07-25 10:37:33'),
(17, '', 'Justin Obi. has uploaded POP for Donate order', '', 'POP Submitted', 'approve?ordid=6', 0, '2020-07-25 10:38:22'),
(18, 'admin', 'admin, has Activated user account', '', 'Account unrestricted', 'customer-summary?uid=6', 0, '2020-07-25 10:38:34'),
(19, 'admin', 'admin has logged in!', '', 'Login', 'admin-profile?admu=admin', 0, '2020-07-25 12:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `ph_id` int(11) DEFAULT NULL,
  `gh_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `payer_id` int(11) DEFAULT NULL,
  `payee_id` int(11) DEFAULT NULL,
  `ord_amount` double DEFAULT NULL,
  `pop` varchar(255) DEFAULT NULL,
  `ord_status` int(11) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `flag_date` varchar(100) DEFAULT NULL,
  `period_timer` varchar(100) DEFAULT NULL,
  `pop_date` varchar(100) DEFAULT NULL,
  `date_paid` varchar(100) DEFAULT NULL,
  `ord_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ph_id`, `gh_id`, `admin_id`, `payer_id`, `payee_id`, `ord_amount`, `pop`, `ord_status`, `flag`, `flag_date`, `period_timer`, `pop_date`, `date_paid`, `ord_date`) VALUES
(1, NULL, NULL, 1, 1, NULL, 1000, '../uploads/pop/8d1a23293b4faf75f74223b36612e275.png', 2, NULL, NULL, 'Jul 25, 2020 21:20:43', '2020-07-31 09:21:06', NULL, '2020-07-25 09:20:43'),
(2, NULL, NULL, 2, 2, NULL, 1000, '../uploads/pop/a2dc396a9868111a77de8d1be974f241.jpg', 1, NULL, NULL, 'Jul 25, 2020 21:26:05', '2020-07-31 09:28:07', NULL, '2020-07-25 09:26:05'),
(3, NULL, NULL, 3, 3, NULL, 1000, NULL, 0, NULL, NULL, 'Jul 25, 2020 21:28:45', NULL, NULL, '2020-07-25 09:28:45'),
(4, NULL, NULL, 4, 4, NULL, 1000, '../uploads/pop/a5882bcbe7932e1191c4a58038604053.jpg', 2, NULL, NULL, 'Jul 25, 2020 21:50:17', '2020-07-31 09:50:32', NULL, '2020-07-25 09:50:17'),
(5, NULL, NULL, 5, 5, NULL, 1000, '../uploads/pop/472c0ef9324fc32ea8b85a49663a988c.jpg', 1, NULL, NULL, 'Jul 25, 2020 22:24:46', '2020-07-31 10:24:58', NULL, '2020-07-25 10:24:46'),
(6, NULL, NULL, 6, 6, NULL, 1000, '../uploads/pop/a89d0cf8daa2eb58d3c69b1540628460.jpg', 1, NULL, NULL, 'Jul 25, 2020 22:37:45', '2020-07-31 10:38:22', NULL, '2020-07-25 10:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `payment_pairs`
--

CREATE TABLE `payment_pairs` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_account_number` varchar(255) NOT NULL,
  `admin_bank_name` varchar(255) NOT NULL,
  `admin_mobile` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_account_number` varchar(255) NOT NULL,
  `user_bank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_pairs`
--

INSERT INTO `payment_pairs` (`id`, `admin_name`, `admin_account_number`, `admin_bank_name`, `admin_mobile`, `user_name`, `user_account_number`, `user_bank_name`) VALUES
(1, 'Akarawak Emmanuel Bassey', '2096821073', 'UBA', '08059372268', 'LEELEE CHARITY', '0077435285', 'Sterling Bank'),
(2, 'Akarawak Emmanuel Bassey', '2153289819', 'UBA', '07065793290', 'CLEMENT ASUQUO AKADU', '0016813196', 'Access Bank (Diamond)'),
(3, 'Akarawak O. Bassey', '3089533124', 'First Bank', '09072003781', 'AKARAWAK EMMANUEL BASSEY', '2096821073', 'United Bank For Africa'),
(4, 'Grace Bassey', '0022613230', 'Access Bank', '08131208262', 'INYANG  BERNARD CHRISTOPHER', '0558806261', 'Guaranty Trust Bank'),
(5, 'Akarawak Emmanuel Bassey', '2117169067', 'Zenith Bank', '08164993708', 'OMORUYI OSARHIEMEN OSAHENVBAHIHE', '3140835150', 'First Bank of Nigeria'),
(6, 'Clement A. Akadu', '0016813196', 'Diamond bank', '07030858915', 'OBI,CHINONSO', '0040421631', 'Guaranty Trust Bank');

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

--
-- Dumping data for table `provide_help`
--

INSERT INTO `provide_help` (`ph_id`, `login_id`, `plan`, `amount`, `interest`, `bonus`, `paid`, `gh_amount`, `ph_control`, `ph_on`, `request_amt`, `ph_status`, `gh_status`, `matured_date`, `ph_auto_merge_timer`, `date_added`, `last_modified`) VALUES
(1, 2, 'Copper', 100000, 50000, 0, 0, 0, 1, 0, 150000, 'Pending', 0, '2020-07-30 10:32:07', '', '2020-07-25 10:32:07', '2020-07-25 10:32:07'),
(2, 6, 'Copper', 5000, 2500, 0, 0, 0, 1, 0, 7500, 'Pending', 0, '2020-07-30 10:39:01', '', '2020-07-25 10:39:01', '2020-07-25 10:39:01');

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

--
-- Dumping data for table `referral`
--

INSERT INTO `referral` (`id`, `ph_id`, `referree_id`, `referral_id`, `ph_amount`, `bonus`, `pay_status`, `credit_status`, `date_added`) VALUES
(18, 30, 72, 0, 7000, 175, 0, 0, '2020-07-21 17:18:00'),
(19, 31, 81, 0, 50000, 1250, 0, 0, '2020-07-24 21:26:48'),
(20, 32, 81, 0, 70000, 1750, 0, 0, '2020-07-24 23:21:36'),
(21, 33, 81, 0, 0, 0, 0, 0, '2020-07-24 23:26:33'),
(22, 34, 81, 0, 40000, 1000, 0, 0, '2020-07-24 23:30:34'),
(23, 35, 87, 0, 5000, 250, 0, 0, '2020-07-25 03:22:00'),
(24, 1, 2, 0, 100000, 5000, 0, 0, '2020-07-25 10:32:07'),
(25, 2, 6, 0, 5000, 250, 0, 0, '2020-07-25 10:39:01');

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
(8, 0, 1, 'Invite and refer your friends and family and earn 5% referral bonus', '', 1, '2017-09-02 12:25:02'),
(9, 0, 52, 'Cash360 is so secure and fast in it\'s system of matching and paying', '', 1, '2017-09-04 00:45:03'),
(13, 25, 2, 'Stop stopping yourself from earning. Join Cash360 today and start earning big time', '', 1, '2017-10-04 00:39:54'),
(17, 0, 51, 'Cash360 all the way. You guys are so super cool', '', 1, '2017-10-04 13:22:16'),
(18, 0, 55, 'Peer to peer has never been better. Thank you guys team Cash360', '', 1, '2017-10-04 13:42:03'),
(19, 27, 51, 'Stop doubting and come join Cash360. It is the best so far\r\n', '', 1, '2017-10-04 14:39:15'),
(20, 34, 51, 'Hurry and join ooo. Cash360 is real ooo', '', 1, '2017-10-04 14:44:22'),
(21, 16, 1, 'Cash360 just paid me and I didn\'t even believe it will work. Thank you guys', '', 1, '2017-10-12 14:17:47');

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
(1, 'Naomirichie', '$2y$10$OCEjM4utNiiRk0EQ9alkk.l3YsbREaGcinehaChU72YjUFkQ4Ihl6', 'Naomi', 'Richard', '07032506455', 'Male', 0, '', 'Lagos Lagos, Nigeria', '', 0, 'HGJM2U', 'DHZ52V', 0, 0, 'Pending', '197.210.226.193', '2020-07-25 09:20:24', '', '2020-07-25 12:10:14', '2020-07-25 09:20:24'),
(2, 'Diamond ', '$2y$10$1SbK61gHgiNkMEPvlFUqYOj72UMvFuizfLhDms1yc.bwoH/s5GaTK', 'Clement ', 'Akadu', '07030858915', 'Male', 0, '', 'Lagos Lagos, Nigeria', '', 0, 'NWPG0E', 'L2C7IW', 0, 0, 'Active', '197.210.226.192', '2020-07-25 09:22:58', '', '2020-07-25 12:50:10', '2020-07-25 09:22:58'),
(3, 'kingakarawak', '$2y$10$1gEL2/MgPdhIdHIIkPJ5au8iZMSwTULqbECn1.YF.a550XIgcjToC', 'Emmanuel', 'Akarawak', '08059372268', 'Male', 0, '', ' , Nigeria', '', 0, '2506FJ', '7L8X6N', 0, 0, 'Pending', '129.205.124.91', '2020-07-25 09:28:16', '', '2020-07-25 10:33:25', '2020-07-25 09:28:16'),
(4, 'bernardinyang.bci@gmail.com', '$2y$10$ClsrXqbvJHVsNUbDiZnrh.p3xP2TyEfB2l75EX9PL3rFFKiQGqOUG', 'Bernard', 'Inyang', '08169517978', 'Male', 0, '', ' , Nigeria', '', 0, 'ZNP6IT', 'BO5Q61', 0, 0, 'Pending', '197.210.84.54', '2020-07-25 09:50:03', '', '2020-07-25 09:50:34', '2020-07-25 09:50:03'),
(5, 'bernardinyang.bci@yahoo.com', '$2y$10$oeI8eAkLw88IDEowIJqM8evR18t9p9xsT5FvwaFrPGWE7GpvJQHvO', 'Bernard', 'Inyang', '08118547173', 'Male', 0, '', ' , Nigeria', '', 0, 'VDGCNH', 'EFN2CI', 0, 0, 'Active', '197.210.84.54', '2020-07-25 10:24:18', '', '2020-07-25 10:40:26', '2020-07-25 10:24:18'),
(6, 'cjustinobi@gmail.com', '$2y$10$eOA6NAcahTYsj4j1xxcTme2ayk22kC9.InrH3rZDzyV2/cN24i4BW', 'Justin', 'Obi', '+2348064152319', 'Male', 0, '', 'Lagos Lagos, Nigeria', '', 0, '07OJBN', '9K6ET3', 0, 0, 'Active', '129.205.113.85', '2020-07-25 10:37:30', '', '2020-07-25 10:44:19', '2020-07-25 10:37:30');

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

--
-- Dumping data for table `user_login_activity`
--

INSERT INTO `user_login_activity` (`id`, `login_id`, `username`, `ip`, `browser`, `os`, `last_access`) VALUES
(1, 3, 'kingakarawak', '129.205.124.91', 'Handheld Browser', 'Android', '2020-07-25 10:33:25'),
(2, 2, 'Diamond ', '197.210.226.125', 'Handheld Browser', 'Android', '2020-07-25 11:28:07'),
(3, 6, 'cjustinobi@gmail.com', '129.205.113.85', 'Chrome', 'Windows 10', '2020-07-25 10:44:19'),
(4, 5, 'bernardinyang.bci@yahoo.com', '197.210.84.54', 'Handheld Browser', 'Android', '2020-07-25 10:40:26'),
(5, 1, 'Naomirichie', '197.210.227.127', 'Handheld Browser', 'Android', '2020-07-25 12:10:14'),
(6, 2, 'Diamond ', '197.210.226.44', 'Handheld Browser', 'Android', '2020-07-25 12:50:10');

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

--
-- Dumping data for table `user_notification`
--

INSERT INTO `user_notification` (`id`, `login_id`, `action`, `type`, `action_url`, `status`, `date_added`) VALUES
(1, 1, 'Naomi R. had uploaded POP for your Receive order', 'POP Submitted', 'user/approve?ordid=1', 0, '2020-07-25 09:21:06'),
(2, 2, 'Clement  A. had uploaded POP for your Receive order', 'POP Submitted', 'user/approve?ordid=2', 0, '2020-07-25 09:28:07'),
(3, 4, 'Bernard I. had uploaded POP for your Receive order', 'POP Submitted', 'user/approve?ordid=4', 0, '2020-07-25 09:50:32'),
(4, 5, 'Bernard I. had uploaded POP for your Receive order', 'POP Submitted', 'user/approve?ordid=5', 0, '2020-07-25 10:24:58'),
(5, 5, 'The administrator has Activated your account!', 'Account Activated', 'user/', 0, '2020-07-25 10:25:22'),
(6, 6, 'Justin O. had uploaded POP for your Receive order', 'POP Submitted', 'user/approve?ordid=6', 0, '2020-07-25 10:38:22'),
(7, 6, 'The administrator has Activated your account!', 'Account Activated', 'user/', 0, '2020-07-25 10:38:34');

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

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip`, `isp`, `client`, `device`, `os`, `location`, `v_date`) VALUES
(1, '197.210.226.132', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-25 09:19:42'),
(2, '129.205.124.95', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-25 09:21:31'),
(3, '197.210.226.125', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-25 09:22:18'),
(4, '129.205.113.91', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-25 09:49:17'),
(5, '197.210.84.54', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-25 09:49:30'),
(6, '77.125.42.15', '', 'Chrome', '', 'Windows 10', 'Central District, Israel', '2020-07-25 09:55:16'),
(7, '77.125.42.15', '', 'Chrome', '', 'Windows 10', 'Central District, Israel', '2020-07-25 09:55:17'),
(8, '77.125.42.15', '', 'Chrome', '', 'Windows 10', 'Central District, Israel', '2020-07-25 09:55:17'),
(9, '77.125.42.15', '', 'Chrome', '', 'Windows 10', 'Central District, Israel', '2020-07-25 09:55:18'),
(10, '180.163.220.66', '', 'Handheld Browser', '', 'Android', ', China', '2020-07-25 09:58:45'),
(11, '42.236.10.117', '', 'Handheld Browser', '', 'Android', 'Jiangsu, China', '2020-07-25 09:59:29'),
(12, '42.236.10.125', '', 'Handheld Browser', '', 'Android', 'Jiangsu, China', '2020-07-25 09:59:30'),
(13, '42.236.10.75', '', 'Handheld Browser', '', 'Android', 'Jiangsu, China', '2020-07-25 09:59:32'),
(14, '129.205.124.91', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-25 10:15:21'),
(15, '197.210.84.54', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-25 10:18:08'),
(16, '42.236.10.117', '', 'Handheld Browser', '', 'Android', 'Jiangsu, China', '2020-07-25 10:27:11'),
(17, '180.163.220.68', '', 'Handheld Browser', '', 'Android', ', China', '2020-07-25 10:28:19'),
(18, '197.210.227.110', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-25 10:30:37'),
(19, '197.210.84.54', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-25 10:30:49'),
(20, '129.205.113.85', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-25 10:39:09'),
(21, '129.205.113.84', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-25 10:40:51'),
(22, '197.210.227.127', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-25 12:02:03'),
(23, '197.210.226.44', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-25 12:50:01');

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
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `biz_name`, `site_name`, `site_title`, `site_description`, `site_url`, `favicon_url`, `logo_url`, `biz_addr`, `biz_city`, `biz_state`, `biz_country`, `biz_phone`, `chat_code`, `last_modified`) VALUES
(1, 'cash360.com.ng', 'Cash360', 'Welcome to Cash360', 'Cash360 is more than just a peer to peer donation platform, it is what you require and you can do a lot with this platform. We are a genuinely nationwide business with an experienced workforce focusing on the needs of our customers to deliver solutions ot', 'www.cash360.com', '../images/b3520907b96fdfa6cbf0b69b4710253f.jpg', '../images/a0912863278a4138e1c18f7b42ed9e2d.png', 'Ileje Street', 'Ikeja', 'Lagos', 'Nigeria', 2348000000000, '<!--Start of Tawk.to Script-->\r\n<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5970bab20d1bb37f1f7a5144/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>\r\n<!--End of Tawk.to Script-->', '2020-07-25 01:09:26');

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
-- Indexes for table `admin_turns`
--
ALTER TABLE `admin_turns`
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
-- Indexes for table `payment_pairs`
--
ALTER TABLE `payment_pairs`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_login_activity`
--
ALTER TABLE `admin_login_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_turns`
--
ALTER TABLE `admin_turns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `facebook_graph`
--
ALTER TABLE `facebook_graph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `get_help`
--
ALTER TABLE `get_help`
  MODIFY `gh_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_pairs`
--
ALTER TABLE `payment_pairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `provide_help`
--
ALTER TABLE `provide_help`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_credibility`
--
ALTER TABLE `user_credibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login_activity`
--
ALTER TABLE `user_login_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
