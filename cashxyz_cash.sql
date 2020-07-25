-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2020 at 05:22 AM
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
-- Database: `cashxyz_cash`
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
(1, 'Administrator', 'administrator', '$2y$10$3oftPaBZaaqakgQ8vF5k9.h2.B9SpdnnAcSQ7hKys35ScTye7gMv6', 'Info@cash360.com.ng', 'CAsh360', '+2340000000000', '../img/admin/576776c9423f44af7021b61e9c6b160a.jpg', 'Ikeja', 'Ikeja', 'Lagos', 'Nigeria', 'Enter information about yourself here.', 1, 1, 197211, '2016-03-20 00:00:00', '2020-07-16 01:40:22', '0000-00-00 00:00:00'),
(4, 'Editor', 'admin', '$2y$10$WK56L6qDjUJTAejDpiielu.LfXigBXt/QottJJeaA.9IZWMw.gwPy', 'emmanuelakarawak@gmail.com', 'King Akarawak ', '08059372268', '', 'Km3 Elements/Akpajo Expressway, Port Harcourt', 'Ikeja', 'Lagos', 'Nigeria', '', 1, 0, 0, '2020-07-21 04:20:56', '2020-07-21 03:20:56', '0000-00-00 00:00:00');

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
(128, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-16 00:47:12'),
(129, 'administrator', '129.205.113.84', 'Chrome', 'Windows 10', '2020-07-16 04:18:55'),
(130, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-16 14:58:42'),
(131, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-16 15:28:26'),
(132, 'administrator', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-17 01:57:45'),
(133, 'administrator', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-17 01:59:35'),
(134, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-17 21:21:55'),
(135, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-17 21:24:51'),
(136, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-17 21:38:25'),
(137, 'administrator', '129.205.124.85', 'Chrome', 'Windows 10', '2020-07-18 05:45:06'),
(138, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-19 00:11:21'),
(139, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-19 14:15:05'),
(140, 'administrator', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-19 15:31:51'),
(141, 'administrator', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-19 20:06:08'),
(142, 'administrator', '129.205.124.85', 'Handheld Browser', 'Android', '2020-07-19 21:19:26'),
(143, 'administrator', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-19 22:09:56'),
(144, 'administrator', '129.205.113.94', 'Chrome', 'Windows 10', '2020-07-19 22:40:03'),
(145, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-19 22:48:35'),
(146, 'administrator', '197.210.227.244', 'Handheld Browser', 'Android', '2020-07-19 23:39:52'),
(147, 'administrator', '197.210.226.100', 'Handheld Browser', 'Android', '2020-07-20 05:53:42'),
(148, 'administrator', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-20 18:04:25'),
(149, 'administrator', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-20 19:41:57'),
(150, 'administrator', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-20 20:28:28'),
(151, 'administrator', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-21 04:20:56'),
(152, 'administrator', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-21 17:44:27'),
(153, 'administrator', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-22 05:58:26');

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
(2, 'Akarawak Emmanuel Bassey', '2153289819', 'UBA', '07065793290', 0, 0),
(3, 'Akarawak O. Bassey', '3089533124', 'First Bank', '09072003781', 1, 0),
(4, 'Grace Bassey', '0022613230', 'Access Bank', '08131208262', 0, 0),
(5, 'Akarawak Emmanuel Bassey', '2117169067', 'Zenith Bank', '08164993708', 0, 0),
(6, 'Clement A. Akadu', '0016813196', 'Diamond bank', '07030858915', 0, 0),
(7, 'Clement A. Akadu', '0039183737', 'GT Bank', '08096962384', 0, 0),
(8, 'Clement A. Akadu', '2175810666', 'Zenith Bank', '08023491458', 0, 0),
(9, 'Clement A. Akadu', '3074808651', 'First Bank', '08073860126', 0, 0),
(10, 'Nyiam Dorathy Etta', '0117804428', 'GTB', '07065793290', 0, 0),
(11, 'Nyiam Dorathy Etta', '0067218478 ', 'Sterling bank', '08023397745', 0, 0),
(12, 'Nyiam Dorathy Etta', '4806956027', 'FCMB', '07037678209', 0, 0),
(13, 'Kenneth Nyiam', '2035081814', 'UBA', '07030912572', 0, 0),
(14, 'Stankey Otu Kejuo', '3035535967', 'First Bank', '07037678209', 0, 0),
(15, 'John Inalegwu', '2190562672', 'Zenith Bank', '07080782202', 0, 0),
(16, 'Israel Providence Akozor', '0072659518', 'Sterling Bank', '09097387834', 0, 0),
(17, 'Nseobong uwechi', '0039054558', 'GTB', '09065348605', 0, 0),
(18, 'Kingsley Ubong Okon-udo', '0093546053', 'Access (Diamond)', '08099899233', 0, 0);

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
  `date_added` datetime NOT NULL,
  `cashname` text NOT NULL,
  `cashacc` text NOT NULL,
  `cashbank` text NOT NULL,
  `cashtel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `login_id`, `account_name`, `account_number`, `bank`, `date_added`, `cashname`, `cashacc`, `cashbank`, `cashtel`) VALUES
(17, 70, 'Abayomi Adebayonle Daniel ', '0037132870 ', 'diamond bank', '2020-07-16 03:51:38', '', '', '', ''),
(18, 71, 'AKARAWAK EMMANUEL BASSEY', '2117169067', 'ZENITH BANK', '2020-07-16 14:33:47', '', '', '', ''),
(19, 81, 'Clement Asuquo', '0016813196', 'Diamond Bank', '2020-07-17 22:04:54', '', '', '', ''),
(20, 82, 'AKARAWAK EMMANUEL BASSEY', 'Pqpqoquqyqtqtwtw', 'With ggshsksk', '2020-07-19 00:21:22', '', '', '', ''),
(21, 83, 'Dorathy Nyiam', '4806956027', 'FCMB', '2020-07-19 15:24:41', '', '', '', ''),
(22, 85, 'Clement Asuquo', '0039183737', 'GT Bank', '2020-07-19 22:53:15', '', '', '', ''),
(23, 86, 'Nyiam Dorathy Etta', '4806956010', 'FCMB', '2020-07-19 23:04:13', '', '', '', ''),
(24, 87, 'Akarawak Emmanuel Bassey', '2096821073', 'UBA', '2020-07-20 06:58:54', '', '', '', ''),
(25, 89, 'Ekomobong Finbarr', '0026887372', 'Access Bank', '2020-07-20 11:49:48', '', '', '', ''),
(26, 88, 'JUstfdzfddf', '1232545436', 'Zenith', '2020-07-20 17:09:06', '', '', '', ''),
(27, 90, 'AKARAWAK EMMANUEL BASSEY', '000000000077', 'All lsbsjs', '2020-07-20 18:50:28', '', '', '', ''),
(28, 91, 'Akarawak Emmanuel Bassey', '2153289819', 'UBA', '2020-07-21 04:26:33', '', '', '', ''),
(29, 95, 'AKARAWAK EMMANUEL BASSEY', '2096821073', 'United Bank For Africa', '2020-07-22 03:46:29', '', '', '', ''),
(30, 96, 'NAOMI RICHARD', '0056713168', 'Sterling Bank', '2020-07-22 06:31:28', '', '', '', ''),
(31, 98, 'ABAYOMI DANIEL ADEBAYONLE', '0037132870', 'Access Bank (Diamond)', '2020-07-22 07:03:15', '', '', '', ''),
(32, 99, 'OKOCHA, CHUKWUEMEKA', '0164549426', 'Guaranty Trust Bank', '2020-07-22 07:24:43', '', '', '', ''),
(33, 101, 'LEELEE CHARITY', '0077435285', 'Sterling Bank', '2020-07-22 11:21:19', '', '', '', ''),
(34, 94, 'INYANG  BERNARD CHRISTOPHER', '0558806261', 'Guaranty Trust Bank', '2020-07-22 11:31:17', '', '', '', ''),
(35, 102, 'INALEGWU   JOHN', '2190562672', 'Zenith Bank', '2020-07-22 22:57:41', '', '', '', ''),
(36, 103, 'EMMANUEL BASSEY AKARAWAK', '2153289819', 'United Bank For Africa', '2020-07-22 23:31:06', '', '', '', ''),
(38, 105, 'OBI,CHINONSO', '0040421631', 'Guaranty Trust Bank', '2020-07-24 10:03:18', '', '', '', '');

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
  `last_updated` datetime NOT NULL,
  `cashname` text NOT NULL,
  `cashacc` text NOT NULL,
  `cashbank` text NOT NULL,
  `cashtel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `signup_bonus`, `referral_bonus`, `min_referral_payout`, `creditbility`, `min_credit_payout`, `credit_pop_upload`, `credit_pop_confirm`, `credit_profile_photo`, `credit_testimony`, `credit_video_testimony`, `credit_referral`, `ph_percentage`, `down_pay`, `min_ph`, `max_ph`, `min_gh`, `max_gh`, `ph_maturity`, `ph_timer`, `ph_auto_merge_timer`, `pay_instructions`, `pay_confirmation_instr`, `pop_confirm`, `auto_merge`, `recommit_perc`, `recommit_perc_opt`, `recommit_bonus`, `email_note`, `sms_note`, `sms_sender`, `sms_port`, `sms_gateway_url`, `sms_gateway_user`, `sms_gateway_pass`, `last_updated`, `cashname`, `cashacc`, `cashbank`, `cashtel`) VALUES
(1, 0, 5, 1000, 100, 0, 5, 5, 0, 5, 15, 0, 50, 20, 100, 5000, 100, 5, '+5 days', '+12 hours', '+30 minutes', 'We\'ve found a sponsor for you, ensure you donate the allocated amount to the sponsor within 12 Hours, otherwise, your account would be penalized!', 'Please conform this payment within 12 hours. A donor just uploaded a POP.', '+144 hours', 'Enabled', 115, 70, 5, 'Disabled', 'Disabled', 'Cash360', '2775', '35.230.140.209', 'sqvr8528', '1wSBIUeT', '2017-08-26 00:00:00', 'Clememnt Asuquo Akadu', '0016813196', 'Diamond Bank', '07030858915');

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
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cashname` text NOT NULL,
  `cashacc` text NOT NULL,
  `cashbank` text NOT NULL,
  `cashtel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`ctn_id`, `abt_title`, `about`, `terms_title`, `terms`, `policy_title`, `policy`, `biz_fb`, `biz_twitter`, `biz_linkedin`, `biz_g_plus`, `last_updated`, `cashname`, `cashacc`, `cashbank`, `cashtel`) VALUES
(1, 'About us', '<h1 style=\"color: #ff0000; text-align: left;\">&nbsp;We Are:</h1>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>Cash360 perfectly describes our all-encompassing approach to providing a superlative peer to peer donation platform with topnotch cyber security and very robust interest rate for all your cash donations with us alongside other unique services tailor made for you. </strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>Cash360 is more than just a peer to peer donation platform, it is what you require and you can do a lot with this platform. We are a genuinely nationwide business with an experienced workforce focusing on the needs of our customers to</strong></span><br /><span style=\"color: #3366ff;\"><strong>deliver solutions others may be unable to. We help you make income online using your smart phones, laptops or other electronic gadgets. </strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>Note: Referral plan is available for mouthwatering bonuses but it\'s however not compulsory. You advertise and refer your friends for your benefits. Periodic draws will be made for huge wins. Watch out!</strong></span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<h1 style=\"color: #ff0000; text-align: left;\"><span style=\"color: #ff0000;\"><strong><strong>OUR SERVICE:</strong></strong></span></h1>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong><strong>Regular Donation and Profit: Our Regular donation Plan gives a nationwide service, it allows participants have a simple way to build wealth by direct donation into a quality peer to peer funding system ranging from N5,000 to N1,000,000 maximum. There is an activation policy before gaining access to donate on our platform. Mind you that it takes 5 days for our regular donation to mature for withdrawal. All you need do is to get registered, pay your activation fee of N1000 and then give a donation depending on your capacity and once you are confirmed, your donation starts growing and matures for withdrawal after 5 days.</strong></strong></span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<h1 style=\"color: #ff0000; text-align: left;\">REGISTRATION PROCESS SUMMARIZED:</h1>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>1. Register:</strong></span><br /><span style=\"color: #3366ff;\"><strong>https://cash360.com.ng/user/register</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>2. Pay in an ACTIVATION FEE of â‚¦1,000 into the account details matched to&nbsp;</strong><strong>your dashboard and upload your proof of payment.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>3. After uploading your POP (Proof of Payment Screenshot), wait to be&nbsp;</strong><strong>confirmed</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>4. After confirmation, Click on&nbsp;DONATE and Give Donation with the&nbsp;</strong><strong>amount of your choice not less than â‚¦5,000 (Ranging from N5000 to&nbsp;</strong><strong>N1,000,000).</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>5. You will be automatically matched to pay to another user, get the person&rsquo;s&nbsp;</strong><strong>details from your dashboard and make payment.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>6. Upload your proof of payment and wait to be confirmed</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>7. Once your transaction has been confirmed, go to monitor&nbsp;donation and&nbsp;</strong><strong>watch your donation grow for the next 5 days</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #ff0000;\"><strong>Note: You are advised to have more than one donation in the system at a time on your&nbsp;</strong><strong>dashboard so as to be able to withdraw any due for withdrawal and&nbsp;</strong><strong>you are also advised to use Mobile Banking App, Internet Banking, Bank&nbsp;</strong><strong>Deposits to make transactions on this platform. Do not pay in cash or use ATM</strong>&nbsp;<strong>transfers.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #ff0000;\"><strong>DAILY MATCHING SCHEDULES - Due to our daily activities:</strong></span><br /><span style=\"color: #3366ff;\"><strong>1st Round: 10am &ndash; 12pm</strong></span><br /><span style=\"color: #3366ff;\"><strong>2nd Round: 4pm&nbsp; -&nbsp; 6pm</strong></span><br /><span style=\"color: #3366ff;\"><strong>3rd Round: 8pm&nbsp; &nbsp;- 10pm</strong></span></p>\r\n<p style=\"text-align: left;\"><br /><span style=\"color: #ff0000;\"><strong>OUR STRICT OPERATIONAL RULES:</strong></span><br /><span style=\"color: #3366ff;\"><strong>1. You are not allowed to pledge a donation less than your previous donations in the&nbsp;</strong><strong>platform.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>2. You are required to make a minimum of 15% increment on your previous donation</strong><strong>&nbsp;after every cashout.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>3. If you need to make any complain, please contact either the customer care,&nbsp;</strong><strong>technical support team or the administrators.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>4. You should endeavour to coordinate your downlines, if they break any of&nbsp;</strong><strong>our rules, it may delay withdrawals.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>5. After receiving payment, it is mandatory to donate into the platform to ensure&nbsp;</strong><strong>continuity and quick withdrawals.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>6. You are only to pay to the account on your dashboard; don\'t make any&nbsp;</strong><strong>payment to any other account.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>7. No fake pop, else your account will be totally deleted from the system&nbsp;</strong><strong>because our system will detect it.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>8. Use the complaint form for any complaints and call the customer care line or&nbsp;</strong><strong>chat us up on WhatsApp and Telegram or send an email to the email&nbsp;</strong><strong>addresses on the contact us.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>9. Testimonials are recommended and after each cash out as they serve as a&nbsp;</strong><strong>form of advertisement.</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"color: #3366ff;\"><strong>10. Video Testimonials are for advert purposes only and they come with some form of&nbsp;</strong><strong>incentives to appreciate our loyal customers, however, this is not compulsory.</strong></span></p>', 'How it Works', '<h1 style=\"color: #ff0000;\">OUR OPERATIONAL OFFER:</h1>\r\n<p><br /><span style=\"color: #3366ff;\"><strong>1. 50% returns on all donations in 5 days.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>2. 5% referral bonus on every investment of your referrals.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>3. Recommitment of at least 100% of initial investment is mandatory before</strong></span><br /><span style=\"color: #3366ff;\"><strong>withdrawal. Subsequent withdrawal will precede a 15% minimum increment</strong></span><br /><span style=\"color: #3366ff;\"><strong>of previous investment.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>4. â‚¦5,000 minimum donation.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>5. â‚¦1,000,000 maximum donation.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>6. 12 hours period to make payment of your give donation to avoid being</strong></span><br /><span style=\"color: #3366ff;\"><strong>blocked by the system.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>time as red alert time for payment, making it a total of 12 hours to make</strong></span><br /><span style=\"color: #3366ff;\"><strong>payment.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>7. Be rest assured that you are&nbsp;donating&nbsp;on one of the most secured online</strong></span><br /><span style=\"color: #3366ff;\"><strong>pair to pair platform... (your donations are fully secured)</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>8. Unlimited number of Donations at the same time is not allowed on your</strong></span><br /><span style=\"color: #3366ff;\"><strong>Dashboard. You can only recommit when your maturity period is due.</strong></span></p>\r\n<p><span style=\"color: #3366ff;\"><strong>PLEASE NOTE: For every MATCH, you have maximum of 12 hours to make</strong></span><br /><span style=\"color: #3366ff;\"><strong>payment and upload your proof of payment, else your account would be</strong></span><br /><span style=\"color: #3366ff;\"><strong>automatically penalized (You will be required to pay a fine of â‚¦2,000 in order to</strong></span><br /><span style=\"color: #3366ff;\"><strong>keep using our platform)</strong></span></p>', 'Credibility Score Index', '<p><strong>You have been awarded a credibility score for your absolute adherence to our policies.</strong></p>', '#', '#', '#', '#', '2020-07-19 21:27:59', 'Clement Asuquo Akadu', '0016813196', 'Diamond Bank', '07030858915');

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
  `c_added_date` datetime NOT NULL,
  `cashname` text NOT NULL,
  `cashacc` text NOT NULL,
  `cashbank` text NOT NULL,
  `cashtel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`c_id`, `c_default`, `c_country`, `c_code`, `c_symbol`, `c_added_date`, `cashname`, `cashacc`, `cashbank`, `cashtel`) VALUES
(6, 0, 'United States', 'USD', '$', '2017-04-29 21:33:36', '', '', '', ''),
(7, 0, 'United Kingdom', 'GBP', 'Â£', '2017-04-29 21:34:02', '', '', '', ''),
(8, 0, 'Spain', 'EUR', 'â‚¬', '2017-04-29 21:34:45', '', '', '', ''),
(10, 1, 'Nigeria', 'NGN', 'â‚¦', '2017-07-17 17:48:08', '', '', '', ''),
(12, 0, 'Ghana', 'GHS', 'â‚µ', '2017-09-03 22:24:52', '', '', '', ''),
(13, 0, 'Ghana', 'GHS', 'â‚µ', '2018-03-01 21:27:00', '', '', '', '');

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

--
-- Dumping data for table `messaging`
--

INSERT INTO `messaging` (`msg_id`, `msg_number`, `admin_id`, `sender_id`, `receiver_id`, `subject`, `message`, `attachment`, `time_frame`, `budget`, `role`, `status`, `hidden_by`, `date_read`, `date_sent`) VALUES
(64, 433571643, 0, 70, 0, 'Account Suspended issue', '<p><img src=\"data:image/jpeg;base64,/9j/4QZuRXhpZgAATU0AKgAAAAgAEAEOAAIAAAAOAAABLgEPAAIAAAAFAAABPgEQAAIAAAALAAABRgESAAMAAAABAAAAAAEaAAUAAAABAAABUgEbAAUAAAABAAABWgEoAAMAAAABAAIAAAExAAIAAAAYAAABYgEyAAIAAAAUAAABegE7AAIAAAANAAABjgITAAMAAAABAAEAAAEAAAQAAAABAAAMwAEBAAQAAAABAAAJkIKYAAIAAAAaAAABnodpAAQAAAABAAABuoglAAQAAAABAAAE6gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABFeGlmX0pQRUdfNDIwAAAAaXRlbAAAAABpdGVsIFc2MDAyAAAAAABIAAAAAQAAAEgAAAABU29mdHdhcmUgVmVyc2lvbiB2MS4xLjAAMjAyMDowNzowMSAwNjowOTo1MQBBcnRpc3QtZnJlZWQAAAAAQ29weXJpZ2h0LFNwcmVhZHRydW0sMjAxMQAAAAAcgpoABQAAAAEAAARugp0ABQAAAAEAAAR2iCcAAwAAAAEAUAAAkAAABwAAAAQwMjIwkAMAAgAAABQAAAR+kAQAAgAAABQAAASSkQEABwAAAAQBAgMAkgIABQAAAAEAAASmkgMACgAAAAEAAASukgUABQAAAAEAAAS2kggAAwAAAAEAAAAAkgkAAwAAAAEAAAAAkgoABQAAAAEAAAS+kpAAAgAAAAMxMAAAkpEAAgAAAAQxMDAAkpIAAgAAAAMyMAAAoAAABwAAAAQwMTAwoAEAAwAAAAEAAQAAoAIABAAAAAEAAAzAoAMABAAAAAEAAAmQoAYABAAAAAEAAAAApAEAAwAAAAEAAQAApAMAAwAAAAEAAAAApAYAAwAAAAEAAAAApAgAAwAAAAEAAAAApAkAAwAAAAEAAAAApA0AAwAAAAEAAQAApCAAAgAAACEAAATGAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD6AAAgi4AAAAUAAAACjIwMjA6MDc6MDEgMDY6MDk6NTEAMjAyMDowNzowMSAwNjowOTo1MQAAAAAUAAAACgAAAAAAAAAAAAAAFAAAAAoAAAsOAAAD6ElNQUdFIDIwMjA6MDc6MDEgMDY6MDk6NTEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/+AAEEpGSUYAAQEAAAEAAQAA/9sAQwABAQEBAQIDAwEBAQEBAwMDAQEBAQIDBAMBAQECAwUEAwEBAgMEBgYEAQIDBAQGBgUDBAQFBgcHBgQFBQUGBQYF/9sAQwEBAQEDBQUFBQEBAQQFBQUFAQEDBQUFBQUDBAUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUF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', '', '', 0, '', 1, '', '', '2020-07-16 03:53:58');
INSERT INTO `messaging` (`msg_id`, `msg_number`, `admin_id`, `sender_id`, `receiver_id`, `subject`, `message`, `attachment`, `time_frame`, `budget`, `role`, `status`, `hidden_by`, `date_read`, `date_sent`) VALUES
(65, 1433780018, 1, 0, 80, 'Account Suspended issue', '<p>your acount will be suspended</p>', '', '', 0, '', 1, '', '', '2020-07-17 21:38:25'),
(66, 658762390, 0, 85, 0, 'Check', '<p><br></p>', '', '', 0, '', 0, '', '', '2020-07-20 22:47:23');

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `admin`, `action`, `readers`, `type`, `action_url`, `status`, `date_added`) VALUES
(242, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-16 00:45:10'),
(243, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-16 01:01:18'),
(244, 'administrator', 'administrator, has unblocked user account', '', 'Account unrestricted', 'customer-summary?uid=63', 0, '2020-07-16 01:13:52'),
(245, 'administrator', 'administrator has changed his profile picture!', '', 'Profile Update', 'admin-profile?admu=administrator', 0, '2020-07-16 01:59:23'),
(246, 'administrator', 'administrator has changed his profile picture!', '', 'Profile Update', 'admin-profile?admu=administrator', 0, '2020-07-16 02:40:21'),
(247, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=65', 0, '2020-07-16 02:48:06'),
(248, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=65', 0, '2020-07-16 02:56:20'),
(249, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=66', 0, '2020-07-16 02:56:26'),
(250, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=66', 0, '2020-07-16 03:09:50'),
(251, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=67', 0, '2020-07-16 03:10:49'),
(252, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=67', 0, '2020-07-16 03:11:54'),
(253, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=68', 0, '2020-07-16 03:25:17'),
(254, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=68', 0, '2020-07-16 03:30:04'),
(255, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=69', 0, '2020-07-16 03:30:38'),
(256, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=69', 0, '2020-07-16 03:45:41'),
(257, '', 'abayomi daniel has created customer account!', 'administrator', 'A New Customer Account Created', 'customer-summary?uid=70', 1, '2020-07-16 03:46:40'),
(258, 'administrator', 'administrator, has unblocked user account', '', 'Account unrestricted', 'customer-summary?uid=70', 0, '2020-07-16 03:47:30'),
(259, '', 'A new message from the abayomi daniel', 'administrator', 'New Message', 'message?msgid=64', 1, '2020-07-16 03:53:58'),
(260, '', 'king Akarawak has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=71', 0, '2020-07-16 14:32:20'),
(261, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-16 14:51:28'),
(262, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=70', 0, '2020-07-16 14:53:48'),
(263, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=72', 0, '2020-07-16 14:56:51'),
(264, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=72', 0, '2020-07-16 14:58:10'),
(265, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=73', 0, '2020-07-16 14:59:12'),
(266, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-16 15:27:25'),
(267, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=73', 0, '2020-07-16 15:28:25'),
(268, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=74', 0, '2020-07-16 15:28:47'),
(269, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-17 01:52:49'),
(270, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=74', 0, '2020-07-17 01:56:24'),
(271, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=75', 0, '2020-07-17 01:56:48'),
(272, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=75', 0, '2020-07-17 01:57:45'),
(273, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=76', 0, '2020-07-17 01:58:58'),
(274, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-17 01:59:35'),
(275, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=77', 0, '2020-07-17 20:55:15'),
(276, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-17 21:01:27'),
(277, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=78', 0, '2020-07-17 21:09:01'),
(278, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=78', 0, '2020-07-17 21:21:54'),
(279, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-17 21:22:42'),
(280, '', 'abayomi dove has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=79', 0, '2020-07-17 21:23:47'),
(281, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-17 21:25:50'),
(282, 'administrator', 'administrator, has unblocked user account', '', 'Account unrestricted', 'customer-summary?uid=79', 0, '2020-07-17 21:26:02'),
(283, '', 'rika dika has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=80', 0, '2020-07-17 21:26:53'),
(284, '', 'Clement Thomas has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=81', 0, '2020-07-17 22:04:03'),
(285, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-18 05:41:55'),
(286, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 00:09:50'),
(287, '', 'ahssh dahwhwh has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=82', 0, '2020-07-19 00:20:30'),
(288, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 13:49:36'),
(289, '', 'Dorathy  Praise has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=83', 0, '2020-07-19 15:14:38'),
(290, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 15:29:48'),
(291, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 19:58:56'),
(292, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 20:52:42'),
(293, 'administrator', 'administrator. has approved submitted Testimonial!', '', 'Testimonial Approval', 'testimonial?tsid=21', 0, '2020-07-19 21:03:45'),
(294, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=77', 0, '2020-07-19 21:04:28'),
(295, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=63', 0, '2020-07-19 21:04:45'),
(296, 'administrator', 'administrator, has deleted user account', '', 'Account deleted', 'customer-summary?uid=76', 0, '2020-07-19 21:04:57'),
(297, 'administrator', 'administrator. has approved submitted Testimonial!', '', 'Testimonial Approval', 'testimonial?tsid=20', 0, '2020-07-19 21:05:47'),
(298, 'administrator', 'administrator. has approved submitted Testimonial!', '', 'Testimonial Approval', 'testimonial?tsid=19', 0, '2020-07-19 21:07:32'),
(299, 'administrator', 'administrator. has approved submitted Testimonial!', '', 'Testimonial Approval', 'testimonial?tsid=18', 0, '2020-07-19 21:09:21'),
(300, 'administrator', 'administrator. has approved submitted Testimonial!', '', 'Testimonial Approval', 'testimonial?tsid=17', 0, '2020-07-19 21:12:03'),
(301, 'administrator', 'administrator. has approved submitted Testimonial!', '', 'Testimonial Approval', 'testimonial?tsid=13', 0, '2020-07-19 21:14:14'),
(302, 'administrator', 'administrator. has approved submitted Testimonial!', '', 'Testimonial Approval', 'testimonial?tsid=9', 0, '2020-07-19 21:15:46'),
(303, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 21:42:59'),
(304, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 22:16:21'),
(305, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 22:40:09'),
(306, '', 'test test has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=84', 0, '2020-07-19 22:45:01'),
(307, '', 'Clement Praise has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=85', 0, '2020-07-19 22:47:17'),
(308, '', 'Dora Praise has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=86', 0, '2020-07-19 22:56:53'),
(309, '', 'Emmanuel Akarawak has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=87', 0, '2020-07-19 23:05:54'),
(310, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-19 23:39:42'),
(311, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-20 05:52:34'),
(312, 'administrator', 'administrator has logged out!', '', 'Logout', 'admin-profile?admu=administrator', 0, '2020-07-20 05:53:42'),
(313, '', 'Justin Obi has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=88', 0, '2020-07-20 10:28:09'),
(314, '', 'Ekomobong Finbarr has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=89', 0, '2020-07-20 11:41:41'),
(315, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-20 17:56:45'),
(316, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=90', 0, '2020-07-20 18:49:54'),
(317, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-20 19:41:57'),
(318, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-20 20:28:27'),
(319, '', 'A new message from the Clement Praise', '', 'New Message', 'message?msgid=66', 0, '2020-07-20 22:47:23'),
(320, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-21 04:05:21'),
(321, '', 'Emmanuel Akarawak has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=91', 0, '2020-07-21 04:24:09'),
(322, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-21 17:42:08'),
(323, '', 'Justin Obi has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=92', 0, '2020-07-21 23:39:58'),
(324, '', 'Justin Obi has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=93', 0, '2020-07-21 23:47:25'),
(325, '', 'Bernard Inyang has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=94', 0, '2020-07-22 00:31:39'),
(326, '', 'Emmanuel Akarawak has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=95', 0, '2020-07-22 03:44:58'),
(327, 'administrator', 'administrator has logged in!', '', 'Login', 'admin-profile?admu=administrator', 0, '2020-07-22 05:55:46'),
(328, '', 'Naomi Richard has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=96', 0, '2020-07-22 06:30:49'),
(329, '', 'abayomi daniel has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=98', 0, '2020-07-22 07:02:43'),
(330, '', 'Chukwuemeka Okocha has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=99', 0, '2020-07-22 07:24:19'),
(331, '', 'Emmanuel Akarawak has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=100', 0, '2020-07-22 10:19:57'),
(332, '', 'Leelee Manson has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=101', 0, '2020-07-22 11:20:12'),
(333, '', 'Inalegwu John has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=102', 0, '2020-07-22 22:56:42'),
(334, '', 'Cash Donation has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=103', 0, '2020-07-22 23:29:36'),
(335, '', 'Justin Obi has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=104', 0, '2020-07-24 03:51:57'),
(336, '', 'Justin Obi has created customer account!', '', 'A New Customer Account Created', 'customer-summary?uid=105', 0, '2020-07-24 04:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `ph_id` int(11) NOT NULL,
  `gh_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
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
(3, 'Akarawak O. Bassey', '3089533124', 'First Bank', '09072003781', '', '', '');

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
(30, 70, 'Platinum', 200000, 100000, 0, 0, 0, 1, 0, 300000, 'Pending', 0, '2020-07-21 03:52:00', '', '2020-07-16 03:52:00', '2020-07-16 03:52:00'),
(31, 83, 'Copper', 100000, 50000, 0, 0, 0, 1, 0, 150000, 'Pending', 0, '2020-07-24 15:39:58', '', '2020-07-19 15:39:57', '2020-07-19 15:39:57'),
(32, 82, 'Copper', 50000000, 25000000, 0, 0, 0, 1, 0, 75000000, 'Pending', 0, '2020-07-24 19:20:14', '', '2020-07-19 19:20:14', '2020-07-19 19:20:14'),
(33, 86, 'Copper', 5000, 2500, 0, 0, 0, 1, 0, 7500, 'Pending', 0, '2020-07-24 23:13:33', '', '2020-07-19 23:13:33', '2020-07-19 23:13:33'),
(34, 90, 'Copper', 1000000, 500000, 0, 0, 0, 1, 0, 1500000, 'Pending', 0, '2020-07-25 18:50:56', '', '2020-07-20 18:50:56', '2020-07-20 18:50:56'),
(35, 88, 'Copper', 55, 27.5, 0, 0, 0, 1, 0, 82.5, 'Pending', 0, '2020-07-25 21:24:34', '', '2020-07-20 21:24:34', '2020-07-20 21:24:34'),
(36, 85, 'Copper', 100000, 50000, 0, 0, 0, 1, 0, 150000, 'Pending', 0, '2020-07-25 22:42:34', '', '2020-07-20 22:42:34', '2020-07-20 22:42:34'),
(37, 95, 'Copper', 50000, 25000, 0, 0, 0, 1, 0, 75000, 'Pending', 0, '2020-07-27 03:49:19', '', '2020-07-22 03:49:19', '2020-07-22 03:49:19'),
(38, 96, 'Copper', 10000, 5000, 0, 0, 0, 1, 0, 15000, 'Pending', 0, '2020-07-27 06:33:09', '', '2020-07-22 06:33:09', '2020-07-22 06:33:09'),
(39, 98, 'Copper', 10000, 5000, 0, 0, 0, 1, 0, 15000, 'Pending', 0, '2020-07-27 07:04:06', '', '2020-07-22 07:04:06', '2020-07-22 07:04:06'),
(40, 99, 'Copper', 10000, 5000, 0, 0, 0, 1, 0, 15000, 'Pending', 0, '2020-07-27 07:25:11', '', '2020-07-22 07:25:11', '2020-07-22 07:25:11'),
(41, 101, 'Copper', 0, 0, 0, 0, 0, 1, 0, 0, 'Pending', 0, '2020-07-27 14:19:51', '', '2020-07-22 14:19:51', '2020-07-22 14:19:51'),
(42, 101, 'Copper', 10000, 5000, 0, 0, 0, 1, 0, 15000, 'Pending', 0, '2020-07-27 14:20:19', '', '2020-07-22 14:20:19', '2020-07-22 14:20:19'),
(43, 103, 'Copper', 4000, 2000, 0, 0, 0, 1, 0, 6000, 'Pending', 0, '2020-07-27 23:32:03', '', '2020-07-22 23:32:03', '2020-07-22 23:32:03');

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
(18, 30, 70, 63, 200000, 10000, 0, 0, '2020-07-16 03:52:00'),
(19, 31, 83, 77, 100000, 5000, 0, 0, '2020-07-19 15:39:57'),
(20, 32, 82, 77, 50000000, 2500000, 0, 0, '2020-07-19 19:20:14'),
(21, 33, 86, 82, 5000, 250, 0, 0, '2020-07-19 23:13:33'),
(22, 34, 90, 82, 1000000, 50000, 0, 0, '2020-07-20 18:50:56'),
(23, 35, 88, 82, 55, 2.75, 0, 0, '2020-07-20 21:24:34'),
(24, 36, 85, 82, 100000, 5000, 0, 0, '2020-07-20 22:42:34'),
(25, 37, 95, 0, 50000, 2500, 0, 0, '2020-07-22 03:49:19'),
(26, 38, 96, 0, 10000, 500, 0, 0, '2020-07-22 06:33:09'),
(27, 39, 98, 0, 10000, 500, 0, 0, '2020-07-22 07:04:06'),
(28, 40, 99, 0, 10000, 500, 0, 0, '2020-07-22 07:25:11'),
(29, 41, 101, 0, 0, 0, 0, 0, '2020-07-22 14:19:51'),
(30, 43, 103, 0, 4000, 200, 0, 0, '2020-07-22 23:32:03');

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
(9, 0, 52, 'Operation join and earn with Cash360. Get 50% profit on all your donations in 5 days', '', 1, '2017-09-04 00:45:03'),
(13, 25, 2, 'We love you team Cash360. Thank you all for having we the masses in heart. God bless you. Cash360 all the way', '', 1, '2017-10-04 00:39:54'),
(17, 0, 51, 'Cash360 is obviously the best paying peer to peer donation platform. I am making my own profit. Cool cash', '', 1, '2017-10-04 13:22:16'),
(18, 0, 55, 'I was scared at first of joining but on joining Cash360, I haven\'t had any reason to regret. Thank you all for making Cash360 very secure and reliable', '', 1, '2017-10-04 13:42:03'),
(19, 27, 51, 'I just got paid ooo. 3 gbosa for Cash360. I know you guys won\'t fail us\r\n', '', 1, '2017-10-04 14:39:15'),
(20, 34, 51, 'Cash360 is paying ooo. Come and join and stop doubting', '', 1, '2017-10-04 14:44:22'),
(21, 16, 1, 'Cash360 is the real deal. Donate with Cash360 and make cool profit ', '', 1, '2017-10-12 14:17:47');

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
(82, 'optional', '$2y$10$8tPUYCSwifUsrSQ9uRJF/.Zv04wyVsf7XknXSmtvwnIGBz71hXbkK', 'Login', 'Cash360', '08109645639', 'Male', 77, '', 'Suleja Niger State, Nigeria', '', 0, '4VTNS1', 'GIWUZY', 0, 0, 'Active', '197.211.57.135', '2020-07-19 00:20:30', '', '2020-07-19 19:22:03', '2020-07-19 22:41:12'),
(84, 'dove', '$2y$10$q/DjELVops/HN3RCOFj4AO6OzqekArIOqpxWWaaR62XWpkmXSrSDS', 'test', 'test', '+230000000000', 'Male', 82, '', 'Suleja Niger State, Nigeria', '', 0, 'O3BS7Z', 'BQPME1', 0, 0, 'Blocked', '197.211.57.135', '2020-07-19 22:45:01', '', '2020-07-19 22:50:18', '2020-07-19 22:45:01'),
(85, 'Dazzle', '$2y$10$LdkJx6YKiAQfSoH/CKNEL.ILD.AvBYJWhZCMBuZQ7S3YEloi7shlG', 'Clement', 'Praise', '07030858915', 'Male', 82, '', 'Port Harcourt Rivers State, Nigeria', '', 0, 'VL0IFN', 'KNLVOT', 0, 0, 'Active', '160.152.17.44', '2020-07-19 22:47:17', '', '2020-07-22 17:59:06', '2020-07-19 22:47:17'),
(86, 'DeePee', '$2y$10$QPbADXL7Rd1vPUluJiRP1.3vgbs3TlDHl4Iye0Ea4Uqjh0r.M6NX6', 'Dora', 'Praise', '07065793290', 'Male', 82, '', ' , South Africa', '', 0, 'NQRY5X', '29CI0A', 0, 0, 'Active', '141.0.12.28', '2020-07-19 22:56:53', '', '2020-07-22 23:55:19', '2020-07-19 22:56:53'),
(87, 'kingakarawak', '$2y$10$FmoaoV4nU0C6/9id1JEki.AoNRADzTgjh8Q9gq1r.2uXZ5u3voboy', 'Emmanuel', 'Akarawak', '08059372268', 'Male', 82, '', 'Lagos Lagos, Nigeria', '', 0, 'ROHG93', 'N16IJL', 0, 0, 'Blocked', '197.210.227.244', '2020-07-19 23:05:54', '', '2020-07-21 04:22:08', '2020-07-19 23:05:54'),
(89, 'ekfinbarr', '$2y$10$u2wlkByhkeu17qlmqnjeVOTF.mv77VT01TZtdjgM7ZnpIXo.18EZC', 'Ekomobong', 'Finbarr', '+2347056216063', 'Male', 82, '', 'Lagos Lagos, Nigeria', '', 0, 'F6NT5E', 'XPF7DM', 0, 0, 'Blocked', '129.205.112.210', '2020-07-20 11:41:41', '', '2020-07-20 11:49:49', '2020-07-20 11:41:41'),
(90, 'Test', '$2y$10$awvy76Vsm50gYfNGR8qHnOzPlfBvCvLUxOWZ/X5eYQvK55Lz6Z4be', 'abayomi', 'daniel', '08109645632', 'Male', 82, '', 'Suleja Niger State, Nigeria', '', 0, '8T7SF6', 'MDBR8S', 0, 0, 'Active', '197.211.57.135', '2020-07-20 18:49:54', '', '2020-07-21 17:46:03', '2020-07-20 18:49:54'),
(91, 'emmanuelking', '$2y$10$i5feDO2ZQSKzMS2Y415USOlfJDwgRYgdsYfTSzcPk72uuRMgSV70K', 'Emmanuel', 'Akarawak', '07066860765', 'Male', 82, '', 'Lagos Lagos, Nigeria', '', 0, 'JR4QPV', 'S1K8HO', 0, 0, 'Blocked', '129.205.113.94', '2020-07-21 04:24:09', '', '2020-07-21 04:28:27', '2020-07-21 04:24:09'),
(94, 'bernardinyang.bci@gmail.com', '$2y$10$qbb9KT0kqvpNWnw5hJIWNeeVRTKtluOz6Uz6oDzLKZGC29ketCiu2', 'Bernard', 'Inyang', '08118547173', 'Male', 0, '', ' , Nigeria', '', 0, 'U1BRFZ', '9UZISP', 0, 0, 'Blocked', '197.210.84.248', '2020-07-22 00:31:39', '', '2020-07-22 11:31:27', '2020-07-22 00:31:39'),
(95, 'emmyking', '$2y$10$hwF03fQJeZbP7pMI8UbFfe.Q9oBuKvYpwKjJ1j1eJtbuH/T66TpgG', 'Emmanuel', 'Akarawak', '07080000000', 'Male', 0, '', 'Lagos Lagos, Nigeria', '', 0, '1X0OR7', 'BAYV0I', 0, 0, 'Active', '129.205.113.94', '2020-07-22 03:44:58', '', '2020-07-22 03:55:53', '2020-07-22 03:44:58'),
(96, 'Sugarland', '$2y$10$Mttj3/pkp9YQPX4Kj2c2suZaaF1qCLFaz8t4EcQyWRYxSizVGsErW', 'Naomi', 'Richard', '+2348095537065', 'Male', 0, '../uploads/users/b5451cab23c5edd3c0a9b4e684bcfaf3.jpg', 'Lagos Lagos, Nigeria', '', 0, 'LEMFVG', 'L61MQN', 0, 0, 'Active', '197.210.226.76', '2020-07-22 06:30:49', '', '2020-07-24 01:05:00', '2020-07-22 06:30:49'),
(98, 'Ok', '$2y$10$58ueRqdZzuRvV974v7613eaaWFNkgvcbEku1PebcvsECSyCniu3He', 'abayomi', 'daniel', '07057145095', 'Male', 0, '', 'Suleja Niger State, Nigeria', '', 0, 'CHGMXB', 'MPOD6F', 0, 0, 'Active', '197.211.57.135', '2020-07-22 07:02:43', '', '2020-07-22 07:29:32', '2020-07-22 07:02:43'),
(99, 'emmiblinks56@gmail.com', '$2y$10$DOEA8iFVyOoB3iSLxJNPhe5jRyrLw7LsJjWE5sUUb0/aeRdYjfqRO', 'Chukwuemeka', 'Okocha', '08060088973', 'Male', 0, '', 'Lagos Lagos, Nigeria', '', 0, '3RF8TQ', 'ZLJT6A', 0, 0, 'Active', '105.112.51.84', '2020-07-22 07:24:19', '', '2020-07-22 07:26:30', '2020-07-22 07:24:19'),
(100, 'emma', '$2y$10$.1JnHK3M33Gqcca9/L0.7O06sapOpyzCvWHSNeE/ASG/5tri7ocka', 'Emmanuel', 'Akarawak', '08070000000', 'Male', 0, '', 'Lagos Lagos, Nigeria', '', 0, 'VDGZJH', 'TLGX5S', 0, 0, 'Active', '129.205.113.94', '2020-07-22 10:19:57', '', '2020-07-22 10:24:36', '2020-07-22 10:19:57'),
(101, 'Leedam', '$2y$10$JiNRnhR53I2Qka5B.UKEj.BexXJC4st0soVSXixM99IWfbLHJBrOG', 'Leelee', 'Manson', '+2348160438555', 'Male', 0, '', ' , Nigeria', '', 0, 'I1M3VP', 'VSHGOA', 0, 0, 'Active', '197.210.84.177', '2020-07-22 11:20:12', '', '2020-07-22 21:01:31', '2020-07-22 11:20:12'),
(102, 'JPraise', '$2y$10$1q3CztUem.9wmSJI.yhAA.NZotjwtpHRGhiBtn9c4yHRdN31qYVIG', 'Inalegwu', 'John', '08183805860', 'Male', 0, '', ' , Nigeria', '', 0, 'S72FM3', 'GVKZCN', 0, 0, 'Active', '197.210.84.73', '2020-07-22 22:56:42', '', '2020-07-23 18:37:37', '2020-07-22 22:56:42'),
(103, 'cash', '$2y$10$lZ3PyWtWJLSFlHG6O2Z/DeUMUzNIs.IDiyS5UYXeajZc5yf6S5T3S', 'Cash', 'Donation', '09070000000', 'Male', 0, '', 'Lagos Lagos, Nigeria', '', 0, '8NQHWT', 'HTO8ZR', 0, 0, 'Active', '129.205.113.94', '2020-07-22 23:29:36', '', '2020-07-22 23:32:03', '2020-07-22 23:29:36'),
(105, 'cjustinobi@gmail.com', '$2y$10$2WeZqepvTdaC3vUjs9n7tenR/gdIJisBxFDpCBr35se.Xi7w.ZD1S', 'Justin', 'Obi', '+2348064152319', 'Male', 0, '', 'Lagos Lagos, Nigeria', '', 0, 'DMGEFZ', '3CTUHW', 0, 0, 'Active', '129.205.113.91', '2020-07-24 04:02:33', '', '2020-07-24 10:04:18', '2020-07-24 04:02:33');

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

--
-- Dumping data for table `user_credibility`
--

INSERT INTO `user_credibility` (`id`, `login_id`, `action`, `score`, `credit_status`, `date_added`) VALUES
(31, 1, 'Reward for submitting Letter of happiness in the community', 5, 0, '2020-07-19 21:03:45'),
(32, 51, 'Reward for submitting Letter of happiness in the community', 5, 0, '2020-07-19 21:07:32');

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
(72, 70, 'abayomid01@gmail.com', '197.211.57.135', 'Handheld Browser', 'Android', '2020-07-16 04:11:25'),
(73, 81, 'Dazzle', '197.210.85.94', 'Handheld Browser', 'Android', '2020-07-18 06:12:32'),
(74, 81, 'Dazzle', '197.210.85.94', 'Handheld Browser', 'Android', '2020-07-18 07:21:24'),
(75, 81, 'Dazzle', '197.210.227.142', 'Handheld Browser', 'Android', '2020-07-18 21:29:46'),
(76, 83, 'DeePee', '82.145.222.206', 'Handheld Browser', 'Android', '2020-07-19 16:15:33'),
(77, 83, 'DeePee', '82.145.220.137', 'Handheld Browser', 'Android', '2020-07-19 17:01:55'),
(78, 82, 'Mika', '197.211.57.135', 'Handheld Browser', 'Android', '2020-07-19 19:22:03'),
(79, 85, 'Dazzle', '160.152.17.44', 'Handheld Browser', 'Android', '2020-07-19 23:20:35'),
(80, 85, 'Dazzle', '197.210.85.128', 'Handheld Browser', 'Android', '2020-07-20 00:08:39'),
(81, 85, 'Dazzle', '169.159.85.10', 'Handheld Browser', 'Android', '2020-07-20 03:51:20'),
(82, 85, 'Dazzle', '169.159.85.10', 'Handheld Browser', 'Android', '2020-07-20 05:05:06'),
(83, 87, 'kingakarawak', '197.210.227.74', 'Handheld Browser', 'Android', '2020-07-20 06:22:55'),
(84, 87, 'kingakarawak', '197.210.226.80', 'Handheld Browser', 'Android', '2020-07-20 07:00:00'),
(85, 85, 'Dazzle', '197.210.227.98', 'Handheld Browser', 'Android', '2020-07-20 10:31:27'),
(86, 88, 'cjustinobi@gmail.com', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-20 17:54:16'),
(87, 87, 'kingakarawak', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-20 18:58:18'),
(88, 87, 'kingakarawak', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-20 19:36:26'),
(89, 88, 'cjustinobi@gmail.com', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-20 19:51:37'),
(90, 87, 'kingakarawak', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-20 20:28:06'),
(91, 87, 'kingakarawak', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-20 20:57:19'),
(92, 90, 'Test', '197.211.57.135', 'Handheld Browser', 'Android', '2020-07-20 21:04:26'),
(93, 88, 'cjustinobi@gmail.com', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-20 21:25:02'),
(94, 85, 'Dazzle', '154.66.21.65', 'Handheld Browser', 'Android', '2020-07-20 22:49:22'),
(95, 85, 'Dazzle', '154.66.21.65', 'Handheld Browser', 'Android', '2020-07-20 23:00:47'),
(96, 85, 'Dazzle', '169.159.111.90', 'Handheld Browser', 'Android', '2020-07-21 00:29:51'),
(97, 87, 'Kingakarawak', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-21 04:22:08'),
(98, 86, 'DeePee', '82.145.221.243', 'Handheld Browser', 'Android', '2020-07-21 07:32:02'),
(99, 85, 'Dazzle', '169.159.110.184', 'Handheld Browser', 'Android', '2020-07-21 07:41:17'),
(100, 88, 'cjustinobi@gmail.com', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-21 10:34:35'),
(101, 85, 'Dazzle', '197.210.227.78', 'Handheld Browser', 'Android', '2020-07-21 16:21:25'),
(102, 90, 'test', '197.211.57.135', 'Chrome', 'Windows 10', '2020-07-21 17:46:03'),
(103, 88, 'cjustinobi@gmail.com', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-21 23:29:27'),
(104, 88, 'cjustinobi@gmail.com', '129.205.113.87', 'Handheld Browser', 'Android', '2020-07-21 23:33:19'),
(105, 93, 'cjustinobi@gmail.com', '129.205.113.89', 'Chrome', 'Windows 10', '2020-07-22 02:47:46'),
(106, 85, 'Dazzle', '197.210.85.129', 'Handheld Browser', 'Android', '2020-07-22 03:02:33'),
(107, 85, 'Dazzle', '169.159.69.254', 'Handheld Browser', 'Android', '2020-07-22 03:37:32'),
(108, 85, 'Dazzle', '169.159.69.254', 'Handheld Browser', 'Android', '2020-07-22 04:26:37'),
(109, 85, 'Dazzle', '169.159.69.254', 'Handheld Browser', 'Android', '2020-07-22 05:30:20'),
(110, 85, 'Dazzle', '197.210.226.225', 'Handheld Browser', 'Android', '2020-07-22 06:15:38'),
(111, 96, 'Sugarland', '197.210.226.76', 'Handheld Browser', 'Android', '2020-07-22 08:29:51'),
(112, 98, 'Ok', '197.211.57.135', 'Handheld Browser', 'Android', '2020-07-22 07:29:32'),
(113, 85, 'Dazzle', '197.210.226.225', 'Handheld Browser', 'Android', '2020-07-22 08:00:01'),
(114, 96, 'Sugarland', '197.210.85.7', 'Handheld Browser', 'Android', '2020-07-22 09:43:34'),
(115, 85, 'Dazzle', '197.210.226.225', 'Handheld Browser', 'Android', '2020-07-22 09:40:30'),
(116, 93, 'cjustinobi@gmail.com', '129.205.113.87', 'Handheld Browser', 'Android', '2020-07-22 10:14:05'),
(117, 93, 'cjustinobi@gmail.com', '129.205.113.94', 'Handheld Browser', 'Android', '2020-07-22 10:55:35'),
(118, 96, 'Sugarland', '197.210.84.177', 'Handheld Browser', 'Android', '2020-07-22 11:15:12'),
(119, 94, 'bernardinyang.bci@gmail.com', '197.210.226.36', 'Chrome', 'Windows 10', '2020-07-22 11:31:27'),
(120, 96, 'Sugarland', '197.210.84.177', 'Handheld Browser', 'Android', '2020-07-22 11:51:29'),
(121, 85, 'Dazzle', '197.210.226.251', 'Handheld Browser', 'Android', '2020-07-22 13:16:41'),
(122, 101, 'Leedam', '197.210.226.120', 'Handheld Browser', 'Android', '2020-07-22 14:20:34'),
(123, 96, 'Sugarland', '197.210.226.120', 'Handheld Browser', 'Android', '2020-07-22 14:21:35'),
(124, 96, 'Sugarland', '197.210.84.71', 'Handheld Browser', 'Android', '2020-07-22 15:33:36'),
(125, 96, 'Sugarland', '197.210.84.71', 'Handheld Browser', 'Android', '2020-07-22 15:33:39'),
(126, 96, 'Sugarland', '197.210.84.71', 'Handheld Browser', 'Android', '2020-07-22 15:33:38'),
(127, 96, 'Sugarland', '197.210.227.55', 'Handheld Browser', 'Android', '2020-07-22 16:53:19'),
(128, 85, 'Dazzle', '197.210.227.52', 'Handheld Browser', 'Android', '2020-07-22 17:59:06'),
(129, 96, 'Sugarland', '197.210.84.212', 'Handheld Browser', 'Android', '2020-07-22 19:00:28'),
(130, 96, 'Sugarland', '197.210.227.180', 'Handheld Browser', 'Android', '2020-07-22 21:00:02'),
(131, 101, 'Leedam', '197.210.227.180', 'Handheld Browser', 'Android', '2020-07-22 21:01:31'),
(132, 96, 'Sugarland', '197.210.85.92', 'Handheld Browser', 'Android', '2020-07-22 22:24:37'),
(133, 86, 'DeePee', '82.145.221.111', 'Handheld Browser', 'Android', '2020-07-22 23:55:19'),
(134, 96, 'Sugarland', '197.210.84.41', 'Handheld Browser', 'Android', '2020-07-23 00:22:35'),
(135, 96, 'Sugarland', '197.210.227.204', 'Handheld Browser', 'Android', '2020-07-23 06:14:39'),
(136, 96, 'Sugarland', '197.210.84.101', 'Handheld Browser', 'Android', '2020-07-23 10:57:37'),
(137, 96, 'Sugarland', '197.210.227.210', 'Handheld Browser', 'Android', '2020-07-23 18:08:03'),
(138, 102, 'JPraise', '197.210.85.162', 'Handheld Browser', 'Android', '2020-07-23 18:37:37'),
(139, 96, 'Sugarland', '197.210.227.104', 'Handheld Browser', 'Android', '2020-07-23 22:49:37'),
(140, 96, 'Sugarland', '197.210.227.104', 'Handheld Browser', 'Android', '2020-07-23 22:49:38'),
(141, 96, 'Sugarland', '197.210.84.136', 'Handheld Browser', 'Android', '2020-07-24 01:05:00'),
(142, 93, 'cjustinobi@gmail.com', '129.205.124.30', 'Chrome', 'Windows 10', '2020-07-24 03:47:34'),
(143, 93, 'cjustinobi@gmail.com', '129.205.124.30', 'Chrome', 'Windows 10', '2020-07-24 03:47:41'),
(144, 93, 'cjustinobi@gmail.com', '129.205.124.30', 'Chrome', 'Windows 10', '2020-07-24 03:48:16'),
(145, 93, 'cjustinobi@gmail.com', '129.205.124.30', 'Chrome', 'Windows 10', '2020-07-24 03:48:36'),
(146, 105, 'cjustinobi@gmail.com', '129.205.124.30', 'Chrome', 'Windows 10', '2020-07-24 10:03:32'),
(147, 105, 'cjustinobi@gmail.com', '129.205.124.30', 'Chrome', 'Windows 10', '2020-07-24 10:03:52'),
(148, 105, 'cjustinobi@gmail.com', '129.205.124.30', 'Chrome', 'Windows 10', '2020-07-24 10:04:18');

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
(109, 63, 'The administrator has Unblocked your account!', 'Account Unblocked', 'user/', 0, '2020-07-16 01:13:52'),
(110, 70, 'The administrator has Unblocked your account!', 'Account Unblocked', 'user/', 0, '2020-07-16 03:47:30'),
(111, 79, 'The administrator has Unblocked your account!', 'Account Unblocked', 'user/', 0, '2020-07-17 21:26:02'),
(112, 80, 'You have recieved a new message from the administrator', 'New Message', 'user/message?msgid=65', 1, '2020-07-17 21:38:25'),
(113, 1, 'The administrator has approved your testimony!', 'Testimony Approval', 'user/user-testimonials', 0, '2020-07-19 21:03:45'),
(114, 51, 'The administrator has approved your testimony!', 'Testimony Approval', 'user/user-testimonials', 0, '2020-07-19 21:05:47'),
(115, 51, 'The administrator has approved your testimony!', 'Testimony Approval', 'user/user-testimonials', 0, '2020-07-19 21:07:32'),
(116, 55, 'The administrator has approved your testimony!', 'Testimony Approval', 'user/user-testimonials', 0, '2020-07-19 21:09:21'),
(117, 51, 'The administrator has approved your testimony!', 'Testimony Approval', 'user/user-testimonials', 0, '2020-07-19 21:12:03'),
(118, 2, 'The administrator has approved your testimony!', 'Testimony Approval', 'user/user-testimonials', 0, '2020-07-19 21:14:14'),
(119, 52, 'The administrator has approved your testimony!', 'Testimony Approval', 'user/user-testimonials', 0, '2020-07-19 21:15:46');

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
(1, 'DoveTech | BlueIce', 'www.dovetech.org.ng', '2.6', '2020-04-12 00:00:00', '0', '');

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
(251, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 00:04:22'),
(252, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 00:25:12'),
(253, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-16 00:25:46'),
(254, '64.227.35.75', '', 'Chrome', '', 'Mac OS X', 'England, United Kingdom', '2020-07-16 00:27:13'),
(255, '64.227.35.75', '', 'Chrome', '', 'Mac OS X', 'England, United Kingdom', '2020-07-16 00:27:13'),
(256, '64.227.35.75', '', 'Firefox', '', 'Windows XP', 'England, United Kingdom', '2020-07-16 00:27:14'),
(257, '62.210.83.78', '', 'Chrome', '', 'Windows 10', ', France', '2020-07-16 00:48:15'),
(258, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 01:36:16'),
(259, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-16 01:36:17'),
(260, '66.249.93.73', '', 'Chrome', '', 'Linux', ', ', '2020-07-16 01:50:28'),
(261, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-16 01:57:49'),
(262, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-16 01:58:03'),
(263, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 02:26:30'),
(264, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 02:33:15'),
(265, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 02:34:45'),
(266, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 02:42:50'),
(267, '121.36.137.19', '', 'Chrome', '', 'Windows 10', ', China', '2020-07-16 02:44:43'),
(268, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 02:50:54'),
(269, '66.249.93.71', '', 'Chrome', '', 'Linux', ', ', '2020-07-16 03:02:52'),
(270, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-16 03:06:28'),
(271, '66.249.93.71', '', 'Chrome', '', 'Linux', ', ', '2020-07-16 03:07:17'),
(272, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 03:10:06'),
(273, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 03:10:28'),
(274, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 03:24:24'),
(275, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 03:30:12'),
(276, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 03:46:15'),
(277, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 03:50:54'),
(278, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-16 04:04:05'),
(279, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 04:17:51'),
(280, '121.36.137.19', '', 'Chrome', '', 'Windows 10', ', China', '2020-07-16 05:26:50'),
(281, '202.184.119.128', '', 'Chrome', '', 'Windows 10', 'Selangor, Malaysia', '2020-07-16 05:31:57'),
(282, '128.90.147.250', '', 'Firefox', '', 'Ubuntu', 'Brussels Capital, Belgium', '2020-07-16 06:30:48'),
(283, '31.10.158.160', '', 'Internet Explorer', '', 'Windows 7', 'Zurich, Switzerland', '2020-07-16 06:47:01'),
(284, '121.36.137.19', '', 'Chrome', '', 'Windows 10', ', China', '2020-07-16 06:49:45'),
(285, '221.229.218.152', '', 'Unknown Browser', '', 'iPhone', ', China', '2020-07-16 07:55:13'),
(286, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-16 08:16:04'),
(287, '128.90.147.250', '', 'Firefox', '', 'Ubuntu', 'Brussels Capital, Belgium', '2020-07-16 08:32:41'),
(288, '188.87.161.30', '', 'Handheld Browser', '', 'Android', 'Catalonia, Spain', '2020-07-16 08:34:45'),
(289, '37.28.185.101', '', 'Chrome', '', 'Windows 7', 'St.-Petersburg, Russia', '2020-07-16 08:54:11'),
(290, '37.28.185.101', '', 'Handheld Browser', '', 'Android', 'St.-Petersburg, Russia', '2020-07-16 08:54:21'),
(291, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-16 09:42:17'),
(292, '138.197.160.158', '', 'Chrome', '', 'Windows 8.1', 'Ontario, Canada', '2020-07-16 09:46:16'),
(293, '138.197.173.88', '', 'Chrome', '', 'Unknown OS Platform', 'Ontario, Canada', '2020-07-16 09:46:17'),
(294, '165.227.35.253', '', 'Chrome', '', 'Linux', 'Ontario, Canada', '2020-07-16 09:46:17'),
(295, '138.197.128.76', '', 'Chrome', '', 'Unknown OS Platform', 'Ontario, Canada', '2020-07-16 09:46:17'),
(296, '212.83.166.62', '', 'Firefox', '', 'Windows 7', ', France', '2020-07-16 10:21:23'),
(297, '3.17.210.127', '', 'Firefox', '', 'Windows 10', 'Ohio, United States', '2020-07-16 10:53:33'),
(298, '121.36.137.19', '', 'Chrome', '', 'Windows XP', ', China', '2020-07-16 11:02:38'),
(299, '161.69.99.11', '', 'Firefox', '', 'Windows 7', ', United States', '2020-07-16 11:08:59'),
(300, '34.216.174.121', '', 'Chrome', '', 'Windows 10', 'Oregon, United States', '2020-07-16 11:09:19'),
(301, '34.212.214.31', '', 'Chrome', '', 'Linux', 'Oregon, United States', '2020-07-16 11:09:20'),
(302, '161.69.99.11', '', 'Firefox', '', 'Windows 7', ', United States', '2020-07-16 11:15:06'),
(303, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 12:10:15'),
(304, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-16 12:10:16'),
(305, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-16 12:10:18'),
(306, '109.69.66.101', '', 'Unknown Browser', '', 'Unknown OS Platform', ', Germany', '2020-07-16 13:04:48'),
(307, '46.4.33.48', '', 'Unknown Browser', '', 'Windows XP', ', Germany', '2020-07-16 14:03:21'),
(308, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 14:28:38'),
(309, '141.0.13.163', '', 'Opera', '', 'Android', ', South Africa', '2020-07-16 14:31:00'),
(310, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 14:50:44'),
(311, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 14:58:55'),
(312, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 15:28:31'),
(313, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 15:58:41'),
(314, '54.167.106.34', '', 'Handheld Browser', '', 'iPhone', 'Virginia, United States', '2020-07-16 16:03:22'),
(315, '3.86.42.160', '', 'Handheld Browser', '', 'iPhone', 'Virginia, United States', '2020-07-16 16:03:23'),
(316, '51.158.111.94', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-16 16:59:19'),
(317, '51.158.111.94', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-16 16:59:22'),
(318, '51.158.111.94', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-16 16:59:24'),
(319, '51.158.111.94', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-16 16:59:25'),
(320, '51.158.111.94', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-16 16:59:25'),
(321, '51.158.79.185', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-16 17:02:36'),
(322, '51.158.79.185', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-16 17:02:36'),
(323, '51.158.79.185', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-16 17:02:36'),
(324, '51.158.125.87', '', 'Chrome', '', 'Linux', 'ÃŽle-de-France, France', '2020-07-16 17:10:17'),
(325, '51.158.125.87', '', 'Chrome', '', 'Linux', 'ÃŽle-de-France, France', '2020-07-16 17:10:30'),
(326, '51.158.125.87', '', 'Chrome', '', 'Linux', 'ÃŽle-de-France, France', '2020-07-16 17:10:32'),
(327, '51.158.125.87', '', 'Chrome', '', 'Linux', 'ÃŽle-de-France, France', '2020-07-16 17:10:32'),
(328, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 17:14:48'),
(329, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-16 17:23:37'),
(330, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-16 17:24:26'),
(331, '34.83.154.172', '', 'Firefox', '', 'Windows 10', ', United States', '2020-07-16 17:30:21'),
(332, '35.230.58.15', '', 'Firefox', '', 'Windows 10', ', United States', '2020-07-16 17:30:21'),
(333, '134.209.80.37', '', 'Firefox', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-16 17:31:54'),
(334, '134.209.80.37', '', 'Firefox', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-16 17:31:54'),
(335, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 17:31:56'),
(336, '91.103.66.206', '', 'Firefox', '', 'Windows 7', 'Moscow, Russia', '2020-07-16 17:36:33'),
(337, '91.103.66.206', '', 'Safari', '', 'Linux', 'Moscow, Russia', '2020-07-16 17:36:34'),
(338, '198.41.144.145', '', 'Internet Explorer', '', 'Windows XP', 'Oregon, United States', '2020-07-16 17:37:00'),
(339, '198.41.144.145', '', 'Internet Explorer', '', 'Windows XP', 'Oregon, United States', '2020-07-16 17:37:00'),
(340, '172.69.28.149', '', 'Chrome', '', 'Linux', 'California, United States', '2020-07-16 17:47:44'),
(341, '172.69.28.149', '', 'Chrome', '', 'Linux', 'California, United States', '2020-07-16 17:47:44'),
(342, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:47:52'),
(343, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:47:53'),
(344, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:47:54'),
(345, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:47:54'),
(346, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:47:58'),
(347, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:48:10'),
(348, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:17'),
(349, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:48:18'),
(350, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:20'),
(351, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:20'),
(352, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:48:21'),
(353, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:23'),
(354, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:26'),
(355, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:48:33'),
(356, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:34'),
(357, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:48:37'),
(358, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:48:44'),
(359, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:45'),
(360, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:48'),
(361, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:51'),
(362, '34.73.185.108', '', 'Chrome', '', 'Linux', 'Virginia, United States', '2020-07-16 17:48:53'),
(363, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:57'),
(364, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:48:59'),
(365, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:49:04'),
(366, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:49:13'),
(367, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:49:19'),
(368, '34.73.185.108', '', 'Handheld Browser', '', 'Android', 'Virginia, United States', '2020-07-16 17:49:28'),
(369, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-16 17:50:02'),
(370, '66.102.6.49', '', 'Chrome', '', 'Linux', 'Ohio, United States', '2020-07-16 17:56:34'),
(371, '107.178.194.174', '', 'Internet Explorer', '', 'Unknown OS Platform', 'Virginia, United States', '2020-07-16 17:56:35'),
(372, '204.13.201.138', '', 'Internet Explorer', '', 'Windows 7', 'Illinois, United States', '2020-07-16 17:56:35'),
(373, '208.87.233.140', '', 'Internet Explorer', '', 'Windows XP', ', United States', '2020-07-16 17:56:35'),
(374, '197.210.226.50', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-16 17:56:43'),
(375, '197.210.227.9', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-16 17:57:29'),
(376, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 18:01:37'),
(377, '83.28.170.196', '', 'Chrome', '', 'Windows 10', 'Podlasie, Poland', '2020-07-16 18:16:04'),
(378, '95.49.99.16', '', 'Chrome', '', 'Windows 8.1', 'Mazovia, Poland', '2020-07-16 18:16:04'),
(379, '95.49.99.16', '', 'Chrome', '', 'Windows 10', 'Mazovia, Poland', '2020-07-16 18:16:15'),
(380, '128.90.147.250', '', 'Firefox', '', 'Ubuntu', 'Brussels Capital, Belgium', '2020-07-16 18:20:23'),
(381, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-16 18:53:52'),
(382, '54.201.40.73', '', 'Chrome', '', 'Windows 7', 'Oregon, United States', '2020-07-16 19:00:06'),
(383, '69.25.58.61', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-16 19:06:17'),
(384, '69.25.58.61', '', 'Chrome', '', 'Unknown OS Platform', ', United States', '2020-07-16 19:10:52'),
(385, '69.25.58.61', '', 'Chrome', '', 'Unknown OS Platform', ', United States', '2020-07-16 19:10:52'),
(386, '45.120.49.72', '', 'Chrome', '', 'Windows 10', 'Tokyo, Japan', '2020-07-16 19:18:58'),
(387, '23.19.5.140', '', 'Chrome', '', 'Windows 10', 'California, United States', '2020-07-16 19:21:40'),
(388, '69.25.58.61', '', 'Chrome', '', 'Unknown OS Platform', ', United States', '2020-07-16 19:24:59'),
(389, '38.108.182.5', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-16 19:26:56'),
(390, '38.108.182.5', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-16 19:27:07'),
(391, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 19:27:52'),
(392, '72.13.46.6', '', 'Unknown Browser', '', 'Unknown OS Platform', ', United States', '2020-07-16 19:27:55'),
(393, '45.59.31.227', '', 'Chrome', '', 'Windows 10', 'Florida, United States', '2020-07-16 19:33:47'),
(394, '195.141.89.149', '', 'Unknown Browser', '', 'Windows 7', 'Basel-City, Switzerland', '2020-07-16 19:37:45'),
(395, '195.141.89.150', '', 'Edge', '', 'Windows 10', 'Basel-City, Switzerland', '2020-07-16 19:37:45'),
(396, '142.93.116.114', '', 'Unknown Browser', '', 'Windows 8.1', 'New Jersey, United States', '2020-07-16 19:37:57'),
(397, '142.93.116.114', '', 'Unknown Browser', '', 'Windows 8.1', 'New Jersey, United States', '2020-07-16 19:37:57'),
(398, '89.44.201.105', '', 'Chrome', '', 'Windows 10', 'Constanta, Romania', '2020-07-16 19:38:00'),
(399, '3.85.123.41', '', 'Unknown Browser', '', 'Windows 8.1', 'Virginia, United States', '2020-07-16 19:38:02'),
(400, '3.85.123.41', '', 'Unknown Browser', '', 'Windows 8.1', 'Virginia, United States', '2020-07-16 19:38:02'),
(401, '185.189.161.22', '', 'Chrome', '', 'Windows 7', ', Hong Kong', '2020-07-16 19:38:56'),
(402, '185.189.161.22', '', 'Chrome', '', 'Windows 10', ', Hong Kong', '2020-07-16 19:38:56'),
(403, '185.189.161.22', '', 'Firefox', '', 'Windows 10', ', Hong Kong', '2020-07-16 19:38:56'),
(404, '185.189.161.22', '', 'Firefox', '', 'Windows 10', ', Hong Kong', '2020-07-16 19:38:56'),
(405, '185.189.160.152', '', 'Chrome', '', 'Linux', 'Central and Western District, Hong Kong', '2020-07-16 19:39:00'),
(406, '185.189.161.22', '', 'Chrome', '', 'Linux', ', Hong Kong', '2020-07-16 19:39:00'),
(407, '185.189.160.194', '', 'Chrome', '', 'Linux', 'Central and Western District, Hong Kong', '2020-07-16 19:39:00'),
(408, '185.189.160.194', '', 'Chrome', '', 'Linux', 'Central and Western District, Hong Kong', '2020-07-16 19:39:02'),
(409, '179.43.169.182', '', 'Firefox', '', 'Linux', 'Zurich, Switzerland', '2020-07-16 19:39:03'),
(410, '179.43.169.182', '', 'Firefox', '', 'Linux', 'Zurich, Switzerland', '2020-07-16 19:39:04'),
(411, '142.93.116.114', '', 'Unknown Browser', '', 'Windows 8.1', 'New Jersey, United States', '2020-07-16 19:39:12'),
(412, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-16 19:39:14'),
(413, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-16 19:39:14'),
(414, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-16 19:39:14'),
(415, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-16 19:39:14'),
(416, '185.189.161.22', '', 'Firefox', '', 'Windows 7', ', Hong Kong', '2020-07-16 19:39:33'),
(417, '185.189.161.22', '', 'Chrome', '', 'Windows 7', ', Hong Kong', '2020-07-16 19:39:33'),
(418, '3.85.123.41', '', 'Unknown Browser', '', 'Windows 8.1', 'Virginia, United States', '2020-07-16 19:39:36'),
(419, '185.189.161.22', '', 'Chrome', '', 'Linux', ', Hong Kong', '2020-07-16 19:39:37'),
(420, '185.189.160.152', '', 'Chrome', '', 'Linux', 'Central and Western District, Hong Kong', '2020-07-16 19:39:37'),
(421, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-16 19:40:14'),
(422, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-16 19:40:14'),
(423, '38.108.182.5', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-16 19:41:40'),
(424, '38.108.182.5', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-16 19:41:44'),
(425, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-16 19:41:54'),
(426, '38.147.115.216', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-16 19:45:58'),
(427, '149.7.107.149', '', 'Firefox', '', 'Windows Vista', 'ÃŽle-de-France, France', '2020-07-16 19:52:40'),
(428, '91.201.143.126', '', 'Firefox', '', 'Windows Vista', 'England, United Kingdom', '2020-07-16 19:53:20'),
(429, '43.241.70.137', '', 'Unknown Browser', '', 'Unknown OS Platform', ', India', '2020-07-16 19:59:31'),
(430, '43.241.70.137', '', 'Unknown Browser', '', 'Unknown OS Platform', ', India', '2020-07-16 20:01:15'),
(431, '43.241.70.137', '', 'Unknown Browser', '', 'Unknown OS Platform', ', India', '2020-07-16 20:02:36'),
(432, '3.85.123.41', '', 'Unknown Browser', '', 'Windows 8.1', 'Virginia, United States', '2020-07-16 20:06:36'),
(433, '197.210.226.240', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-16 20:12:36'),
(434, '197.210.226.240', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Lagos, Nigeria', '2020-07-16 20:14:19'),
(435, '43.241.70.137', '', 'Unknown Browser', '', 'Unknown OS Platform', ', India', '2020-07-16 20:19:13'),
(436, '197.210.227.109', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-16 20:20:43'),
(437, '43.241.70.137', '', 'Unknown Browser', '', 'Unknown OS Platform', ', India', '2020-07-16 20:21:12'),
(438, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-16 20:29:14'),
(439, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-16 20:29:14'),
(440, '197.210.226.73', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-16 20:31:20'),
(441, '72.12.194.92', '', 'Chrome', '', 'Windows 10', 'Indiana, United States', '2020-07-16 20:32:44'),
(442, '197.210.226.38', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-16 20:36:04'),
(443, '54.80.221.24', '', 'Handheld Browser', '', 'iPhone', 'Virginia, United States', '2020-07-16 20:57:14'),
(444, '54.80.221.24', '', 'Handheld Browser', '', 'iPhone', 'Virginia, United States', '2020-07-16 20:57:14'),
(445, '100.26.182.12', '', 'Handheld Browser', '', 'iPhone', 'Virginia, United States', '2020-07-16 21:03:42'),
(446, '100.26.182.12', '', 'Handheld Browser', '', 'iPhone', 'Virginia, United States', '2020-07-16 21:03:42'),
(447, '67.205.165.53', '', 'Unknown Browser', '', 'Unknown OS Platform', 'New Jersey, United States', '2020-07-16 21:37:04'),
(448, '67.205.165.53', '', 'Unknown Browser', '', 'Unknown OS Platform', 'New Jersey, United States', '2020-07-16 21:37:04'),
(449, '163.172.131.136', '', 'Handheld Browser', '', 'Android', ', United Kingdom', '2020-07-16 22:12:29'),
(450, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-16 22:15:08'),
(451, '64.225.123.136', '', 'Chrome', '', 'Windows 7', 'California, United States', '2020-07-16 22:20:09'),
(452, '197.210.227.246', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-16 22:24:36'),
(453, '197.210.226.105', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-16 22:52:43'),
(454, '185.128.178.66', '', 'Chrome', '', 'Mac OS X', ', United Kingdom', '2020-07-16 22:55:18'),
(455, '197.210.84.99', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-17 00:38:16'),
(456, '73.218.181.110', '', 'Unknown Browser', '', 'Windows 8.1', 'Massachusetts, United States', '2020-07-17 01:06:12'),
(457, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-17 01:11:59'),
(458, '62.115.15.146', '', 'Firefox', '', 'Unknown OS Platform', ', ', '2020-07-17 01:19:10'),
(459, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-17 01:30:56'),
(460, '167.71.79.24', '', 'Firefox', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-17 01:32:32'),
(461, '167.71.79.24', '', 'Firefox', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-17 01:32:36'),
(462, '27.125.142.57', '', 'Firefox', '', 'Windows 10', ', Singapore', '2020-07-17 01:48:22'),
(463, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-17 01:56:15'),
(464, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-17 01:57:49'),
(465, '109.69.66.101', '', 'Unknown Browser', '', 'Unknown OS Platform', ', Germany', '2020-07-17 04:32:15'),
(466, '73.218.181.110', '', 'Unknown Browser', '', 'Windows 8.1', 'Massachusetts, United States', '2020-07-17 05:04:19'),
(467, '40.114.34.127', '', 'Chrome', '', 'Windows 10', 'Virginia, United States', '2020-07-17 05:15:55'),
(468, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-17 05:47:59'),
(469, '2.58.29.156', '', 'Chrome', '', 'Windows 10', 'England, United Kingdom', '2020-07-17 07:41:39'),
(470, '74.125.212.67', '', 'Chrome', '', 'Linux', ', United States', '2020-07-17 07:54:49'),
(471, '163.172.70.242', '', 'Firefox', '', 'Ubuntu', ', United Kingdom', '2020-07-17 09:03:32'),
(472, '195.154.62.232', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 09:03:34'),
(473, '62.210.5.253', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 09:29:47'),
(474, '62.210.10.77', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 09:29:49'),
(475, '163.172.70.242', '', 'Firefox', '', 'Ubuntu', ', United Kingdom', '2020-07-17 09:42:44'),
(476, '163.172.70.242', '', 'Firefox', '', 'Ubuntu', ', United Kingdom', '2020-07-17 09:42:45'),
(477, '195.154.62.232', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 09:47:45'),
(478, '163.172.70.242', '', 'Firefox', '', 'Ubuntu', ', United Kingdom', '2020-07-17 09:47:45'),
(479, '163.172.70.242', '', 'Firefox', '', 'Ubuntu', ', United Kingdom', '2020-07-17 09:47:48'),
(480, '62.210.5.253', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 09:47:49'),
(481, '159.138.142.161', '', 'Unknown Browser', '', 'Unknown OS Platform', ', Singapore', '2020-07-17 10:20:27'),
(482, '37.28.185.101', '', 'Chrome', '', 'Windows 7', 'St.-Petersburg, Russia', '2020-07-17 10:29:57'),
(483, '37.28.185.101', '', 'Handheld Browser', '', 'Android', 'St.-Petersburg, Russia', '2020-07-17 10:30:07'),
(484, '89.238.137.41', '', 'Firefox', '', 'Linux', ', United Kingdom', '2020-07-17 10:41:54'),
(485, '150.143.163.102', '', 'Handheld Browser', '', 'iPhone', 'England, United Kingdom', '2020-07-17 10:41:54'),
(486, '5.62.41.112', '', 'Firefox', '', 'Windows 10', 'Hesse, Germany', '2020-07-17 10:41:54'),
(487, '5.62.61.63', '', 'Handheld Browser', '', 'iPhone', 'Lagos, Nigeria', '2020-07-17 10:41:54'),
(488, '89.238.137.41', '', 'Firefox', '', 'Linux', ', United Kingdom', '2020-07-17 10:41:55'),
(489, '150.143.163.102', '', 'Handheld Browser', '', 'iPhone', 'England, United Kingdom', '2020-07-17 10:41:55'),
(490, '5.62.41.112', '', 'Firefox', '', 'Windows 10', 'Hesse, Germany', '2020-07-17 10:41:55'),
(491, '5.62.61.63', '', 'Handheld Browser', '', 'iPhone', 'Lagos, Nigeria', '2020-07-17 10:41:56'),
(492, '121.36.137.19', '', 'Chrome', '', 'Windows 7', ', China', '2020-07-17 10:46:46'),
(493, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-17 11:43:48'),
(494, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-17 12:30:54'),
(495, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-17 12:50:54'),
(496, '52.10.202.68', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Oregon, United States', '2020-07-17 13:07:29'),
(497, '52.10.202.68', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Oregon, United States', '2020-07-17 13:07:29'),
(498, '34.253.145.226', '', 'Safari', '', 'Linux', 'Leinster, Ireland', '2020-07-17 13:12:06'),
(499, '197.210.226.238', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-17 13:33:55'),
(500, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-17 13:35:33'),
(501, '129.205.113.84', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-17 14:42:03'),
(502, '2.58.29.156', '', 'Chrome', '', 'Windows 10', 'England, United Kingdom', '2020-07-17 14:46:42'),
(503, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-17 15:53:45'),
(504, '197.210.227.160', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-17 17:25:09'),
(505, '165.22.200.133', '', 'Firefox', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-17 17:32:11'),
(506, '165.22.200.133', '', 'Firefox', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-17 17:32:12'),
(507, '197.210.226.126', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-17 18:19:28'),
(508, '195.154.63.222', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 18:53:49'),
(509, '195.154.62.232', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 18:53:53'),
(510, '62.210.10.77', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 18:54:33'),
(511, '195.154.63.222', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 18:54:36'),
(512, '62.210.10.77', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 19:09:50'),
(513, '62.210.10.77', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 19:09:51'),
(514, '62.210.5.253', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 19:20:39'),
(515, '195.154.63.222', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 19:20:41'),
(516, '62.210.5.253', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 19:34:12'),
(517, '195.154.62.232', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 19:34:14'),
(518, '195.154.63.222', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 19:37:10'),
(519, '195.154.63.222', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 19:37:11'),
(520, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-17 20:41:31'),
(521, '95.49.99.16', '', 'Firefox', '', 'Windows 7', 'Mazovia, Poland', '2020-07-17 20:58:18'),
(522, '83.28.170.196', '', 'Chrome', '', 'Windows 10', 'Podlasie, Poland', '2020-07-17 20:58:19'),
(523, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-17 21:00:42'),
(524, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-17 21:22:00'),
(525, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-17 21:25:07'),
(526, '197.210.226.128', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-17 21:40:41'),
(527, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-17 21:55:09'),
(528, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-17 22:20:52'),
(529, '163.172.70.242', '', 'Firefox', '', 'Ubuntu', ', United Kingdom', '2020-07-17 23:02:09'),
(530, '195.154.63.222', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 23:02:10'),
(531, '62.210.5.253', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 23:06:31'),
(532, '195.154.63.222', '', 'Firefox', '', 'Ubuntu', ', France', '2020-07-17 23:06:32'),
(533, '34.220.146.148', '', 'Firefox', '', 'Mac OS X', 'Oregon, United States', '2020-07-17 23:47:18'),
(534, '64.225.123.136', '', 'Chrome', '', 'Windows 7', 'California, United States', '2020-07-18 00:08:58'),
(535, '2.236.112.207', '', 'Chrome', '', 'Windows 10', 'Latium, Italy', '2020-07-18 00:47:37'),
(536, '2.236.112.207', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Latium, Italy', '2020-07-18 00:47:37'),
(537, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-18 01:47:17'),
(538, '204.101.161.19', '', 'Internet Explorer', '', 'Windows XP', ', Canada', '2020-07-18 02:22:07'),
(539, '212.102.63.70', '', 'Chrome', '', 'Windows 10', ', United Kingdom', '2020-07-18 03:24:19'),
(540, '167.114.209.38', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Quebec, Canada', '2020-07-18 04:39:28'),
(541, '167.114.209.38', '', 'Handheld Browser', '', 'Android', 'Quebec, Canada', '2020-07-18 04:39:38'),
(542, '51.77.129.159', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-18 04:39:47'),
(543, '129.205.124.85', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-18 05:24:25'),
(544, '129.205.124.85', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-18 05:40:36'),
(545, '197.210.85.94', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-18 06:12:08'),
(546, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-18 07:03:48'),
(547, '197.210.85.94', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-18 07:21:03'),
(548, '197.210.85.94', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-18 08:33:15'),
(549, '185.212.168.144', '', 'Chrome', '', 'Windows 10', 'England, United Kingdom', '2020-07-18 11:08:48'),
(550, '185.73.217.201', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Sao Paulo, Brazil', '2020-07-18 11:18:54'),
(551, '121.36.137.19', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-18 12:26:21'),
(552, '104.248.124.93', '', 'Internet Explorer', '', 'Windows XP', 'New York, United States', '2020-07-18 15:22:22'),
(553, '40.118.68.242', '', 'Chrome', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-18 15:26:26'),
(554, '165.22.200.133', '', 'Firefox', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-18 17:32:09'),
(555, '165.22.200.133', '', 'Firefox', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-18 17:32:09'),
(556, '216.41.148.238', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-18 18:11:41'),
(557, '73.218.181.110', '', 'Unknown Browser', '', 'Windows 8.1', 'Massachusetts, United States', '2020-07-18 19:29:09'),
(558, '197.210.227.142', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-18 21:29:38'),
(559, '129.205.112.210', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-18 22:24:46'),
(560, '147.147.220.28', '', 'Internet Explorer', '', 'Windows XP', 'England, United Kingdom', '2020-07-18 22:32:15'),
(561, '51.75.141.254', '', 'Handheld Browser', '', 'iPhone', ', France', '2020-07-18 22:32:15'),
(562, '159.65.210.36', '', 'Chrome', '', 'Linux', 'England, United Kingdom', '2020-07-18 22:32:16'),
(563, '5.62.61.62', '', 'Handheld Browser', '', 'Android', 'Jigawa State, Nigeria', '2020-07-18 22:32:17'),
(564, '51.75.141.254', '', 'Handheld Browser', '', 'iPhone', ', France', '2020-07-18 22:32:18'),
(565, '159.65.210.36', '', 'Chrome', '', 'Linux', 'England, United Kingdom', '2020-07-18 22:32:18'),
(566, '147.147.220.28', '', 'Internet Explorer', '', 'Windows XP', 'England, United Kingdom', '2020-07-18 22:32:21'),
(567, '5.62.61.62', '', 'Handheld Browser', '', 'Android', 'Jigawa State, Nigeria', '2020-07-18 22:32:21'),
(568, '147.147.220.28', '', 'Internet Explorer', '', 'Windows XP', 'England, United Kingdom', '2020-07-18 22:40:07'),
(569, '185.206.225.139', '', 'Handheld Browser', '', 'iPhone', 'Oslo County, Norway', '2020-07-18 22:40:07'),
(570, '147.147.220.28', '', 'Internet Explorer', '', 'Windows XP', 'England, United Kingdom', '2020-07-18 22:40:08'),
(571, '5.62.61.62', '', 'Handheld Browser', '', 'iPhone', 'Jigawa State, Nigeria', '2020-07-18 22:40:08'),
(572, '74.81.88.34', '', 'Handheld Browser', '', 'iPhone', 'Texas, United States', '2020-07-18 22:40:09'),
(573, '5.62.61.62', '', 'Handheld Browser', '', 'iPhone', 'Jigawa State, Nigeria', '2020-07-18 22:40:09'),
(574, '185.206.225.139', '', 'Handheld Browser', '', 'iPhone', 'Oslo County, Norway', '2020-07-18 22:40:09'),
(575, '74.81.88.34', '', 'Handheld Browser', '', 'iPhone', 'Texas, United States', '2020-07-18 22:40:13'),
(576, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-19 00:09:26'),
(577, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-19 00:11:42'),
(578, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-19 00:12:07'),
(579, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-19 00:13:30'),
(580, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-19 00:16:57'),
(581, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-19 00:19:13'),
(582, '73.218.181.110', '', 'Unknown Browser', '', 'Windows 8.1', 'Massachusetts, United States', '2020-07-19 00:40:31'),
(583, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-19 00:44:23'),
(584, '147.78.120.40', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Riga, Latvia', '2020-07-19 00:51:19'),
(585, '147.78.120.40', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Riga, Latvia', '2020-07-19 00:51:31'),
(586, '18.138.22.83', '', 'Unknown Browser', '', 'Unknown OS Platform', ', Singapore', '2020-07-19 01:10:38'),
(587, '18.138.22.83', '', 'Unknown Browser', '', 'Unknown OS Platform', ', Singapore', '2020-07-19 01:10:40'),
(588, '138.128.99.12', '', 'Chrome', '', 'Mac OS X', 'Florida, United States', '2020-07-19 04:56:44'),
(589, '68.183.88.182', '', 'Firefox', '', 'Windows 8.1', 'Karnataka, India', '2020-07-19 04:56:59'),
(590, '34.245.78.20', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Leinster, Ireland', '2020-07-19 05:49:17'),
(591, '34.71.9.136', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-19 10:22:47'),
(592, '72.13.62.43', '', 'Unknown Browser', '', 'Unknown OS Platform', ', United States', '2020-07-19 12:37:52'),
(593, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 13:44:21'),
(594, '197.210.227.38', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 13:52:39'),
(595, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-19 14:14:22'),
(596, '197.210.227.38', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 15:08:43'),
(597, '197.210.226.172', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 15:11:18'),
(598, '197.210.227.38', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 15:23:45'),
(599, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 15:28:51'),
(600, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 15:28:52'),
(601, '178.171.78.48', '', 'Unknown Browser', '', 'Unknown OS Platform', ', Japan', '2020-07-19 16:06:53'),
(602, '178.171.78.48', '', 'Unknown Browser', '', 'Unknown OS Platform', ', Japan', '2020-07-19 16:06:59'),
(603, '178.171.78.48', '', 'Unknown Browser', '', 'Unknown OS Platform', ', Japan', '2020-07-19 16:07:05'),
(604, '82.145.222.206', '', 'Handheld Browser', '', 'Android', ', South Africa', '2020-07-19 16:10:12'),
(605, '82.145.222.206', '', 'Handheld Browser', '', 'Android', ', South Africa', '2020-07-19 16:10:23'),
(606, '197.210.227.113', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 16:36:54'),
(607, '82.145.223.111', '', 'Handheld Browser', '', 'Android', 'Gauteng, South Africa', '2020-07-19 16:36:55'),
(608, '129.205.113.94', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Lagos, Nigeria', '2020-07-19 16:45:07'),
(609, '129.205.113.94', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Lagos, Nigeria', '2020-07-19 16:45:07'),
(610, '129.205.113.94', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Lagos, Nigeria', '2020-07-19 16:45:11'),
(611, '129.205.113.94', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Lagos, Nigeria', '2020-07-19 16:45:11'),
(612, '129.205.113.94', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Lagos, Nigeria', '2020-07-19 16:45:14'),
(613, '129.205.113.94', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Lagos, Nigeria', '2020-07-19 16:45:14'),
(614, '129.205.113.94', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Lagos, Nigeria', '2020-07-19 16:45:23'),
(615, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 16:46:17'),
(616, '197.210.227.189', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 16:53:01'),
(617, '197.210.226.105', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 16:53:36'),
(618, '129.205.124.85', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-19 18:13:16'),
(619, '129.205.124.85', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-19 18:19:40'),
(620, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-19 19:17:29'),
(621, '121.36.137.19', '', 'Chrome', '', 'Windows Server 2003/XP x64', ', China', '2020-07-19 19:18:06'),
(622, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-19 19:25:11'),
(623, '35.224.168.194', '', 'Chrome', '', 'Windows 10', 'Virginia, United States', '2020-07-19 19:51:56'),
(624, '129.205.124.85', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-19 20:50:35'),
(625, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 21:49:37'),
(626, '129.205.113.94', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-19 22:24:21'),
(627, '51.158.109.172', '', 'Chrome', '', 'Linux', 'ÃŽle-de-France, France', '2020-07-19 22:38:45'),
(628, '51.158.109.172', '', 'Chrome', '', 'Linux', 'ÃŽle-de-France, France', '2020-07-19 22:38:45'),
(629, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-19 22:39:55'),
(630, '160.152.17.44', '', 'Handheld Browser', '', 'Android', 'Rivers State, Nigeria', '2020-07-19 22:40:46'),
(631, '141.0.12.28', '', 'Handheld Browser', '', 'Android', ', South Africa', '2020-07-19 22:40:47'),
(632, '160.152.17.44', '', 'Handheld Browser', '', 'Android', 'Rivers State, Nigeria', '2020-07-19 22:46:43'),
(633, '160.152.17.44', '', 'Handheld Browser', '', 'Android', 'Rivers State, Nigeria', '2020-07-19 22:52:39'),
(634, '202.184.119.161', '', 'Chrome', '', 'Windows 10', 'Selangor, Malaysia', '2020-07-19 23:03:21'),
(635, '197.210.227.244', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-19 23:05:22'),
(636, '197.210.85.128', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-20 00:08:32'),
(637, '197.210.226.236', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 00:29:39'),
(638, '197.210.226.236', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 01:13:01'),
(639, '34.219.247.242', '', 'Chrome', '', 'Linux', 'Oregon, United States', '2020-07-20 01:13:54'),
(640, '51.158.109.172', '', 'Chrome', '', 'Linux', 'ÃŽle-de-France, France', '2020-07-20 01:30:07'),
(641, '169.159.85.10', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 03:49:30'),
(642, '207.102.138.19', '', 'Internet Explorer', '', 'Windows XP', 'British Columbia, Canada', '2020-07-20 04:36:26'),
(643, '169.159.85.10', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-20 05:01:37'),
(644, '169.159.85.10', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 05:03:33'),
(645, '197.210.227.74', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 05:49:54'),
(646, '197.210.226.191', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 06:57:50'),
(647, '119.3.24.235', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-20 07:59:29'),
(648, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-20 10:13:55'),
(649, '129.205.124.8', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-20 10:24:17'),
(650, '197.210.227.98', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 10:31:13'),
(651, '129.205.112.210', '', 'Chrome', '', 'Linux', 'Lagos, Nigeria', '2020-07-20 11:21:00'),
(652, '94.128.254.7', '', 'Chrome', '', 'Windows 10', 'Al Asimah, Kuwait', '2020-07-20 11:21:32'),
(653, '37.28.185.101', '', 'Chrome', '', 'Windows 7', 'St.-Petersburg, Russia', '2020-07-20 11:58:07'),
(654, '37.28.185.101', '', 'Handheld Browser', '', 'Android', 'St.-Petersburg, Russia', '2020-07-20 11:58:20'),
(655, '129.205.124.7', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-20 12:31:47'),
(656, '51.158.113.192', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-20 13:26:39'),
(657, '51.158.113.192', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-20 13:26:40'),
(658, '51.158.113.192', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-20 13:26:42'),
(659, '51.158.113.192', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-20 13:26:42'),
(660, '51.158.113.192', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-20 13:26:43'),
(661, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-20 16:46:46'),
(662, '3.15.229.16', '', 'Chrome', '', 'Linux', 'Ohio, United States', '2020-07-20 17:05:16'),
(663, '119.3.24.235', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-20 18:30:58'),
(664, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-20 18:49:05'),
(665, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 18:50:33'),
(666, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 19:35:08'),
(667, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-20 19:40:43'),
(668, '129.205.112.210', '', 'Chrome', '', 'Linux', 'Lagos, Nigeria', '2020-07-20 20:27:07'),
(669, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 20:27:40'),
(670, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 20:56:40'),
(671, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-20 21:04:10'),
(672, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-20 21:09:53'),
(673, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-20 21:23:56'),
(674, '2.236.112.207', '', 'Chrome', '', 'Windows 10', 'Latium, Italy', '2020-07-20 21:30:05'),
(675, '2.236.112.207', '', 'Chrome', '', 'Windows 10', 'Latium, Italy', '2020-07-20 21:44:38'),
(676, '2.236.112.207', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Latium, Italy', '2020-07-20 21:44:39'),
(677, '2.236.112.207', '', 'Chrome', '', 'Windows 10', 'Latium, Italy', '2020-07-20 22:03:29'),
(678, '2.236.112.207', '', 'Chrome', '', 'Windows 10', 'Latium, Italy', '2020-07-20 22:16:07'),
(679, '2.236.112.207', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Latium, Italy', '2020-07-20 22:16:08'),
(680, '2.236.112.207', '', 'Chrome', '', 'Windows 10', 'Latium, Italy', '2020-07-20 22:27:09'),
(681, '2.236.112.207', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Latium, Italy', '2020-07-20 22:27:10'),
(682, '154.66.21.65', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 22:42:03'),
(683, '2.236.112.207', '', 'Chrome', '', 'Windows 10', 'Latium, Italy', '2020-07-20 22:45:01'),
(684, '2.236.112.207', '', 'Chrome', '', 'Windows 10', 'Latium, Italy', '2020-07-20 22:45:25'),
(685, '154.66.21.65', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-20 22:49:22'),
(686, '38.145.88.169', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-20 22:56:50'),
(687, '169.159.111.90', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-21 00:16:09'),
(688, '38.135.122.36', '', 'Chrome', '', 'Windows 10', ', United States', '2020-07-21 00:24:47'),
(689, '119.3.24.235', '', 'Chrome', '', 'Windows 10', ', China', '2020-07-21 00:49:31'),
(690, '129.205.113.82', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-21 03:18:17'),
(691, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 04:00:46'),
(692, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 04:22:09'),
(693, '129.205.112.210', '', 'Chrome', '', 'Linux', 'Lagos, Nigeria', '2020-07-21 04:42:28'),
(694, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 05:59:57'),
(695, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 06:00:12'),
(696, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 06:00:14'),
(697, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 06:03:18'),
(698, '58.30.141.60', '', 'Chrome', '', 'Android', ', China', '2020-07-21 06:48:02'),
(699, '197.210.227.246', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 07:18:36'),
(700, '197.210.227.99', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 07:21:26'),
(701, '82.145.221.243', '', 'Handheld Browser', '', 'Android', ', South Africa', '2020-07-21 07:21:27'),
(702, '197.149.127.196', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-21 07:24:22'),
(703, '169.159.110.184', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 07:40:24'),
(704, '119.3.24.235', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-21 07:57:11'),
(705, '89.108.88.240', '', 'Internet Explorer', '', 'Windows XP', 'Moscow Oblast, Russia', '2020-07-21 08:03:05'),
(706, '89.108.88.240', '', 'Firefox', '', 'Windows 7', 'Moscow Oblast, Russia', '2020-07-21 08:03:06'),
(707, '197.210.226.49', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 09:15:11'),
(708, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-21 10:07:16'),
(709, '119.3.24.235', '', 'Chrome', '', 'Windows 10', ', China', '2020-07-21 10:16:31'),
(710, '150.249.214.249', '', 'Unknown Browser', '', 'Windows 8.1', 'Tokyo, Japan', '2020-07-21 10:24:48'),
(711, '150.249.214.249', '', 'Unknown Browser', '', 'Windows 8.1', 'Tokyo, Japan', '2020-07-21 10:24:50'),
(712, '37.28.185.101', '', 'Chrome', '', 'Windows 7', 'St.-Petersburg, Russia', '2020-07-21 11:54:50'),
(713, '37.28.185.101', '', 'Handheld Browser', '', 'Android', 'St.-Petersburg, Russia', '2020-07-21 11:55:15'),
(714, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-21 13:03:36'),
(715, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 13:04:04'),
(716, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 14:16:42'),
(717, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 14:46:58'),
(718, '185.132.196.98', '', 'Safari', '', 'Mac OS X', 'St.-Petersburg, Russia', '2020-07-21 15:44:45'),
(719, '184.94.240.92', '', 'Firefox', '', 'Windows 10', ', United States', '2020-07-21 15:55:22'),
(720, '197.210.227.78', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 16:20:57'),
(721, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 16:48:59'),
(722, '129.205.112.210', '', 'Chrome', '', 'Linux', 'Lagos, Nigeria', '2020-07-21 16:50:09'),
(723, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 17:04:21'),
(724, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 17:04:22'),
(725, '95.216.15.49', '', 'Handheld Browser', '', 'iPhone', ', Germany', '2020-07-21 17:08:42'),
(726, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-21 17:27:28'),
(727, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 17:38:03'),
(728, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 17:38:19'),
(729, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-21 17:40:29'),
(730, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 18:19:07'),
(731, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 18:19:23'),
(732, '116.233.172.173', '', 'Chrome', '', 'Windows 7', 'Shanghai, China', '2020-07-21 18:51:24'),
(733, '119.3.24.235', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-21 20:05:07'),
(734, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-21 20:42:40'),
(735, '199.127.56.236', '', 'Chrome', '', 'Windows 10', 'Nevada, United States', '2020-07-21 21:01:16'),
(736, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 21:19:00'),
(737, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-21 21:19:10'),
(738, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 21:19:12');
INSERT INTO `visitors` (`id`, `ip`, `isp`, `client`, `device`, `os`, `location`, `v_date`) VALUES
(739, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 21:37:13'),
(740, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-21 21:37:56'),
(741, '197.210.84.236', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-21 22:30:52'),
(742, '197.210.227.187', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 22:37:19'),
(743, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-21 22:48:26'),
(744, '197.210.84.236', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-21 23:01:20'),
(745, '129.205.113.87', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-21 23:30:09'),
(746, '80.233.168.68', '', 'Chrome', '', 'Windows 10', 'Riga, Latvia', '2020-07-21 23:31:26'),
(747, '211.1.149.7', '', 'Chrome', '', 'Windows 10', 'Okayama, Japan', '2020-07-21 23:31:28'),
(748, '45.33.15.94', '', 'Chrome', '', 'Mac OS X', 'Texas, United States', '2020-07-21 23:37:09'),
(749, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-21 23:38:56'),
(750, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-21 23:45:30'),
(751, '54.244.194.71', '', 'Firefox', '', 'Mac OS X', 'Oregon, United States', '2020-07-22 00:22:03'),
(752, '197.210.84.248', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-22 00:30:27'),
(753, '119.3.24.235', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-22 00:50:02'),
(754, '129.205.113.89', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-22 02:47:23'),
(755, '197.210.85.129', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 03:01:29'),
(756, '169.159.69.254', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 03:30:58'),
(757, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 03:41:09'),
(758, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 03:55:54'),
(759, '167.99.102.248', '', 'Internet Explorer', '', 'Windows 7', 'California, United States', '2020-07-22 04:06:06'),
(760, '167.99.102.248', '', 'Firefox', '', 'Windows XP', 'California, United States', '2020-07-22 04:06:06'),
(761, '169.159.69.254', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 04:25:55'),
(762, '119.3.24.235', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-22 04:57:56'),
(763, '169.159.69.254', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 05:13:02'),
(764, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 05:52:54'),
(765, '197.210.226.225', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 06:15:32'),
(766, '197.210.71.209', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 06:17:44'),
(767, '197.210.227.76', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 06:28:30'),
(768, '197.210.226.186', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 06:36:00'),
(769, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-22 06:58:21'),
(770, '84.17.46.249', '', 'Unknown Browser', '', 'Unknown OS Platform', 'North Holland, Netherlands', '2020-07-22 07:09:17'),
(771, '105.112.51.84', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 07:23:07'),
(772, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-22 07:28:41'),
(773, '197.211.57.135', '', 'Handheld Browser', '', 'Android', 'Niger State, Nigeria', '2020-07-22 07:29:33'),
(774, '34.220.176.217', '', 'Chrome', '', 'Windows 10', 'Oregon, United States', '2020-07-22 07:35:15'),
(775, '34.220.176.217', '', 'Chrome', '', 'Windows 10', 'Oregon, United States', '2020-07-22 07:35:42'),
(776, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-22 07:58:08'),
(777, '197.210.226.225', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 07:59:50'),
(778, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-22 08:10:13'),
(779, '197.210.53.200', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 08:17:34'),
(780, '208.80.194.42', '', 'Internet Explorer', '', 'Windows XP', ', United States', '2020-07-22 08:33:12'),
(781, '136.243.104.222', '', 'Chrome', '', 'Windows 10', ', Germany', '2020-07-22 08:54:18'),
(782, '197.210.85.7', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 09:36:15'),
(783, '197.210.226.225', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 09:40:00'),
(784, '129.205.113.87', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 10:12:32'),
(785, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 10:17:16'),
(786, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 10:26:46'),
(787, '192.35.168.160', '', 'Unknown Browser', '', 'Unknown OS Platform', ', United States', '2020-07-22 10:43:53'),
(788, '197.210.84.177', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 11:12:48'),
(789, '197.210.84.177', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 11:12:48'),
(790, '197.210.84.177', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 11:15:12'),
(791, '184.94.240.92', '', 'Firefox', '', 'Windows 10', ', United States', '2020-07-22 11:21:13'),
(792, '197.210.227.102', '', 'Chrome', '', 'Windows 10', 'Lagos, Nigeria', '2020-07-22 11:30:29'),
(793, '197.210.84.177', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 11:51:21'),
(794, '129.205.112.122', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 11:55:21'),
(795, '129.205.112.122', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 12:29:10'),
(796, '129.205.112.122', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 12:29:12'),
(797, '119.3.24.235', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-22 12:45:54'),
(798, '54.162.155.109', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Virginia, United States', '2020-07-22 12:59:21'),
(799, '143.215.247.104', '', 'Chrome', '', 'Mac OS X', 'Georgia, United States', '2020-07-22 13:08:15'),
(800, '143.215.247.104', '', 'Chrome', '', 'Mac OS X', 'Georgia, United States', '2020-07-22 13:08:16'),
(801, '197.210.227.82', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 13:15:59'),
(802, '208.80.194.32', '', 'Internet Explorer', '', 'Windows 7', ', United States', '2020-07-22 13:49:03'),
(803, '192.35.168.128', '', 'Unknown Browser', '', 'Unknown OS Platform', ', United States', '2020-07-22 13:51:45'),
(804, '197.210.226.120', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 14:19:12'),
(805, '197.210.226.120', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 14:20:35'),
(806, '84.17.46.248', '', 'Unknown Browser', '', 'Unknown OS Platform', 'North Holland, Netherlands', '2020-07-22 14:24:37'),
(807, '95.216.0.185', '', 'Chrome', '', 'Windows 10', ', Germany', '2020-07-22 14:39:24'),
(808, '161.69.99.11', '', 'Unknown Browser', '', 'Unknown OS Platform', ', United States', '2020-07-22 15:00:33'),
(809, '197.210.84.71', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 15:33:21'),
(810, '197.210.84.71', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 15:33:21'),
(811, '197.210.227.182', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 16:52:52'),
(812, '129.205.124.19', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 17:18:21'),
(813, '197.210.227.52', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 17:58:57'),
(814, '46.4.33.48', '', 'Unknown Browser', '', 'Windows XP', ', Germany', '2020-07-22 18:31:38'),
(815, '197.210.84.212', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 18:59:36'),
(816, '197.210.84.212', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 18:59:36'),
(817, '105.112.70.66', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 19:34:17'),
(818, '129.205.113.87', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 19:42:22'),
(819, '105.112.70.66', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 20:34:18'),
(820, '95.142.120.27', '', 'Chrome', '', 'Windows 10', 'New York, United States', '2020-07-22 20:46:44'),
(821, '197.210.227.60', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 20:58:07'),
(822, '197.210.227.180', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 21:00:02'),
(823, '172.245.107.8', '', 'Firefox', '', 'Windows 7', ', United States', '2020-07-22 21:32:41'),
(824, '119.3.24.235', '', 'Chrome', '', 'Windows 8', ', China', '2020-07-22 21:50:16'),
(825, '208.80.194.27', '', 'Firefox', '', 'Mac OS X', ', United States', '2020-07-22 22:04:33'),
(826, '197.210.85.92', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 22:24:17'),
(827, '45.79.38.68', '', 'Chrome', '', 'Mac OS X', 'Texas, United States', '2020-07-22 22:28:26'),
(828, '197.210.84.73', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-22 22:49:33'),
(829, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 23:19:40'),
(830, '129.205.113.94', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 23:28:22'),
(831, '54.213.9.17', '', 'Chrome', '', 'Windows 10', 'Oregon, United States', '2020-07-22 23:30:24'),
(832, '54.213.9.17', '', 'Chrome', '', 'Windows 10', 'Oregon, United States', '2020-07-22 23:30:25'),
(833, '154.66.21.77', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 23:45:11'),
(834, '154.66.21.77', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 23:48:10'),
(835, '154.66.21.77', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-22 23:53:52'),
(836, '46.4.33.48', '', 'Unknown Browser', '', 'Windows XP', ', Germany', '2020-07-23 00:09:28'),
(837, '197.210.84.41', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-23 00:17:06'),
(838, '197.210.227.180', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-23 00:24:17'),
(839, '54.245.164.252', '', 'Chrome', '', 'Windows 10', 'Oregon, United States', '2020-07-23 00:28:42'),
(840, '54.245.164.252', '', 'Chrome', '', 'Windows 10', 'Oregon, United States', '2020-07-23 00:28:43'),
(841, '3.236.30.194', '', 'Chrome', '', 'Windows 10', 'Virginia, United States', '2020-07-23 00:35:40'),
(842, '3.236.30.194', '', 'Chrome', '', 'Windows 10', 'Virginia, United States', '2020-07-23 00:35:42'),
(843, '45.148.10.180', '', 'Edge', '', 'Windows 10', 'North Holland, Netherlands', '2020-07-23 00:50:33'),
(844, '202.133.247.208', '', 'Unknown Browser', '', 'Linux', ', Taiwan', '2020-07-23 02:11:16'),
(845, '42.236.10.93', '', 'Handheld Browser', '', 'Android', 'Jiangsu, China', '2020-07-23 03:10:10'),
(846, '42.236.10.78', '', 'Handheld Browser', '', 'Android', 'Jiangsu, China', '2020-07-23 03:10:13'),
(847, '119.3.24.235', '', 'Chrome', '', 'Unknown OS Platform', ', China', '2020-07-23 03:54:07'),
(848, '208.80.194.27', '', 'Internet Explorer', '', 'Windows XP', ', United States', '2020-07-23 04:32:04'),
(849, '54.162.155.109', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Virginia, United States', '2020-07-23 04:43:08'),
(850, '40.77.167.202', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Virginia, United States', '2020-07-23 05:03:34'),
(851, '197.210.227.204', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-23 06:14:23'),
(852, '84.17.46.245', '', 'Unknown Browser', '', 'Unknown OS Platform', 'North Holland, Netherlands', '2020-07-23 08:22:15'),
(853, '129.205.124.29', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-23 08:51:28'),
(854, '181.215.50.85', '', 'Handheld Browser', '', 'iPad', 'Arizona, United States', '2020-07-23 09:15:49'),
(855, '5.62.63.82', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Bucuresti, Romania', '2020-07-23 10:36:19'),
(856, '197.210.84.101', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-23 10:57:01'),
(857, '197.210.84.101', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-23 10:57:01'),
(858, '192.35.168.32', '', 'Unknown Browser', '', 'Unknown OS Platform', ', United States', '2020-07-23 11:20:19'),
(859, '51.158.125.26', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-23 11:31:57'),
(860, '51.158.125.26', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-23 11:32:02'),
(861, '51.158.125.26', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-23 11:32:04'),
(862, '51.158.125.26', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-23 11:32:05'),
(863, '51.158.125.26', '', 'Chrome', '', 'Mac OS X', 'ÃŽle-de-France, France', '2020-07-23 11:32:05'),
(864, '143.215.247.104', '', 'Chrome', '', 'Mac OS X', 'Georgia, United States', '2020-07-23 13:08:31'),
(865, '143.215.247.104', '', 'Chrome', '', 'Mac OS X', 'Georgia, United States', '2020-07-23 13:08:31'),
(866, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-23 13:32:52'),
(867, '208.80.194.32', '', 'Chrome', '', 'Mac OS X', ', United States', '2020-07-23 13:49:12'),
(868, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-23 14:12:35'),
(869, '164.132.240.9', '', 'Unknown Browser', '', 'Unknown OS Platform', ', France', '2020-07-23 14:13:05'),
(870, '192.35.168.144', '', 'Unknown Browser', '', 'Unknown OS Platform', ', United States', '2020-07-23 14:18:38'),
(871, '197.210.226.46', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-23 14:46:42'),
(872, '161.69.99.11', '', 'Unknown Browser', '', 'Unknown OS Platform', ', United States', '2020-07-23 15:02:50'),
(873, '54.162.155.109', '', 'Unknown Browser', '', 'Unknown OS Platform', 'Virginia, United States', '2020-07-23 15:30:00'),
(874, '69.164.111.198', '', 'Unknown Browser', '', 'Windows 8.1', ', United States', '2020-07-23 16:30:52'),
(875, '41.190.31.206', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-23 17:23:12'),
(876, '197.210.85.162', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-23 17:28:32'),
(877, '197.210.227.210', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-23 18:06:10'),
(878, '197.210.85.162', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-23 18:36:06'),
(879, '69.164.208.8', '', 'Unknown Browser', '', 'Unknown OS Platform', 'New Jersey, United States', '2020-07-23 19:04:42'),
(880, '69.164.208.8', '', 'Chrome', '', 'Linux', 'New Jersey, United States', '2020-07-23 19:04:42'),
(881, '148.72.152.67', '', 'Firefox', '', 'Mac OS X', ', United States', '2020-07-23 19:05:42'),
(882, '172.69.34.22', '', 'Unknown Browser', '', 'Unknown OS Platform', 'California, United States', '2020-07-23 21:01:07'),
(883, '129.205.124.29', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-23 21:01:53'),
(884, '197.210.227.104', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-23 22:49:24'),
(885, '129.205.124.29', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-23 22:54:20'),
(886, '46.4.33.48', '', 'Unknown Browser', '', 'Windows XP', ', Germany', '2020-07-24 00:23:47'),
(887, '197.211.57.135', '', 'Chrome', '', 'Windows 10', 'Niger State, Nigeria', '2020-07-24 00:43:54'),
(888, '208.80.194.29', '', 'Firefox', '', 'Windows 7', ', United States', '2020-07-24 00:44:22'),
(889, '197.210.84.136', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-24 01:04:31'),
(890, '197.210.85.234', '', 'Handheld Browser', '', 'Android', ', Nigeria', '2020-07-24 02:38:38'),
(891, '129.205.124.23', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 02:39:17'),
(892, '51.15.242.22', '', 'Chrome', '', 'Linux', ', France', '2020-07-24 03:15:21'),
(893, '51.15.242.22', '', 'Chrome', '', 'Linux', ', France', '2020-07-24 03:15:22'),
(894, '150.129.8.30', '', 'Chrome', '', 'Windows 10', 'Provincie Flevoland, Netherlands', '2020-07-24 03:40:54'),
(895, '58.30.141.60', '', 'Chrome', '', 'Android', ', China', '2020-07-24 03:46:51'),
(896, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 03:47:29'),
(897, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 03:47:35'),
(898, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 03:47:42'),
(899, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 03:48:17'),
(900, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 03:48:37'),
(901, '129.205.113.91', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-24 04:02:15'),
(902, '138.246.253.15', '', 'Chrome', '', 'Windows 7', 'Bavaria, Germany', '2020-07-24 05:19:47'),
(903, '197.210.226.240', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-24 05:39:40'),
(904, '84.17.46.204', '', 'Unknown Browser', '', 'Unknown OS Platform', 'North Holland, Netherlands', '2020-07-24 05:46:11'),
(905, '197.210.227.76', '', 'Handheld Browser', '', 'Android', 'Lagos, Nigeria', '2020-07-24 08:11:00'),
(906, '82.145.221.111', '', 'Handheld Browser', '', 'Android', ', South Africa', '2020-07-24 08:23:04'),
(907, '88.99.137.13', '', 'Chrome', '', 'Windows 10', ', Germany', '2020-07-24 09:16:55'),
(908, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 09:29:38'),
(909, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 10:02:48'),
(910, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 10:03:32'),
(911, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 10:03:52'),
(912, '129.205.124.30', '', 'Chrome', '', 'Windows 10', ', Nigeria', '2020-07-24 10:04:09');

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
(1, 'Cash360.com.ng', 'Cash360', 'Welcome to Cash360', 'Who We Are:\r\nCash360 perfectly describes our all-encompassing approach to providing a superlative donation platform with topnotch cyber security and very robust interest rate for all your cash donations with us alongside other unique services', 'www.cash360.com.ng', '../images/6b004faa696c775c2d4c4fcca842cf9b.png', '../images/0f46d44950afaea0506f27249c01c593.png', '12, Olawaiye Street, Anifowoshe', 'Ikeja', 'Lagos', 'Nigeria', 2348000000000, '<script src=\"//code.jivosite.com/widget/Cv6r1oGcVz\" async></script>', '2020-07-18 23:11:21');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `admin_turns`
--
ALTER TABLE `admin_turns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payment_pairs`
--
ALTER TABLE `payment_pairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provide_help`
--
ALTER TABLE `provide_help`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user_credibility`
--
ALTER TABLE `user_credibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_login_activity`
--
ALTER TABLE `user_login_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=913;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
