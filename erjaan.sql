-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 07:43 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erjaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `cityName` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `isActive` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `cityName`, `isActive`, `created_at`) VALUES
(3, 'Bhavnager', 1, '2019-06-12 11:33:31'),
(4, 'Surat', 1, '2019-07-09 07:29:37'),
(5, 'Ahebdabad', 1, '2019-07-12 00:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `complain_notification`
--

CREATE TABLE `complain_notification` (
  `id` int(11) NOT NULL,
  `status_template` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `sms_template` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `customer_sms_template` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email_template` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `customer_email_template` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `users` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `send_to_customer` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 = ''In active'',1 = ''active''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `complain_notification`
--

INSERT INTO `complain_notification` (`id`, `status_template`, `sms_template`, `customer_sms_template`, `email_template`, `customer_email_template`, `users`, `send_to_customer`, `status`, `created_at`, `updated_at`) VALUES
(1, 'both', '<p>dssfsd</p>', '<p>this is sms customer.</p>', '<p>this is test email.</p>\r\n\r\n<p>(survey_2)</p>\r\n\r\n<p>(survey_36)</p>', '<p>this is customer email. (survey_2) (survey_36)</p>', '11', 'yes', 1, '2019-06-13 06:15:11', '2019-07-12 14:42:29'),
(2, 'email', NULL, NULL, '<p>hi {var_user_name}</p>\r\n\r\n<p>email : {var_user_email}</p>\r\n\r\n<p>your status is in progress.</p>\r\n\r\n<p>please fill survey on this link.</p>\r\n\r\n<p>(survey_36)</p>', '<p>hi {var_customer_name}</p>\r\n\r\n<p>email : {var_customer_email}</p>\r\n\r\n<p>your status is in progress.</p>\r\n\r\n<p>please fill survey on this link.</p>\r\n\r\n<p>(survey_36)</p>', '', 'yes', 1, '2019-06-13 10:20:51', '2019-06-20 07:05:19'),
(3, 'email', NULL, NULL, 'this is resolve,', 'this is for customer and status is resolve.', '40,54', 'yes', 1, '2019-06-13 10:21:04', '2019-06-18 05:18:14'),
(4, 'email', NULL, NULL, '<p>this is late.</p>', '<p>this is for customer and status is late.</p>', '11', 'yes', 1, '2019-06-13 10:21:07', '2019-07-09 15:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `dial_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Country code'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `dial_code`) VALUES
(1, 'AF', 'Afghanistan', '93'),
(2, 'AL', 'Albania', '355'),
(3, 'DZ', 'Algeria', '213'),
(4, 'AS', 'AmericanSamoa', '1684'),
(5, 'AD', 'Andorra', '376'),
(6, 'AO', 'Angola', '244'),
(7, 'AI', 'Anguilla', '1264'),
(8, 'AQ', 'Antarctica', '672'),
(9, 'AG', 'Antigua and Barbuda', '1268'),
(10, 'AR', 'Argentina', '54'),
(11, 'AM', 'Armenia', '374'),
(12, 'AW', 'Aruba', '297'),
(13, 'AU', 'Australia', '61'),
(14, 'AT', 'Austria', '43'),
(15, 'AZ', 'Azerbaijan', '994'),
(16, 'BS', 'Bahamas', '1242'),
(17, 'BH', 'Bahrain', '973'),
(18, 'BD', 'Bangladesh', '880'),
(19, 'BB', 'Barbados', '1246'),
(20, 'BY', 'Belarus', '375'),
(21, 'BE', 'Belgium', '32'),
(22, 'BZ', 'Belize', '501'),
(23, 'BJ', 'Benin', '229'),
(24, 'BM', 'Bermuda', '1441'),
(25, 'BT', 'Bhutan', '975'),
(26, 'BO', 'Bolivia, Plurinational State of', '591'),
(27, 'BA', 'Bosnia and Herzegovina', '387'),
(28, 'BW', 'Botswana', '267'),
(29, 'BV', 'Bouvet Island', '01147'),
(30, 'BR', 'Brazil', '55'),
(31, 'IO', 'British Indian Ocean Territory', '246'),
(32, 'BN', 'Brunei Darussalam', '673'),
(33, 'BG', 'Bulgaria', '359'),
(34, 'BF', 'Burkina Faso', '226'),
(35, 'BI', 'Burundi', '257'),
(36, 'KH', 'Cambodia', '855'),
(37, 'CM', 'Cameroon', '237'),
(38, 'CA', 'Canada', '1'),
(39, 'CV', 'Cape Verde', '238'),
(40, 'KY', 'Cayman Islands', ' 345'),
(41, 'CF', 'Central African Republic', '236'),
(42, 'TD', 'Chad', '235'),
(43, 'CL', 'Chile', '56'),
(44, 'CN', 'China', '86'),
(45, 'CX', 'Christmas Island', '61'),
(46, 'CC', 'Cocos (Keeling) Islands', '61'),
(47, 'CO', 'Colombia', '57'),
(48, 'KM', 'Comoros', '269'),
(49, 'CG', 'Congo', '242'),
(50, 'CD', 'Congo, The Democratic Republic of the', '243'),
(51, 'CK', 'Cook Islands', '682'),
(52, 'CR', 'Costa Rica', '506'),
(53, 'CI', 'Cote d\'Ivoire', '225'),
(54, 'HR', 'Croatia', '385'),
(55, 'CU', 'Cuba', '53'),
(56, 'CY', 'Cyprus', '537'),
(57, 'CZ', 'Czech Republic', '420'),
(58, 'DK', 'Denmark', '45'),
(59, 'DJ', 'Djibouti', '253'),
(60, 'DM', 'Dominica', '1767'),
(61, 'DO', 'Dominican Republic', '1849'),
(62, 'TP', 'East Timor', '670'),
(63, 'EC', 'Ecuador', '593'),
(64, 'EG', 'Egypt', '20'),
(65, 'SV', 'El Salvador', '503'),
(66, 'GQ', 'Equatorial Guinea', '240'),
(67, 'ER', 'Eritrea', '291'),
(68, 'EE', 'Estonia', '372'),
(69, 'ET', 'Ethiopia', '251'),
(70, 'XA', 'External Territories of Australia', ''),
(71, 'FK', 'Falkland Islands (Malvinas)', '500'),
(72, 'FO', 'Faroe Islands', '298'),
(73, 'FJ', 'Fiji', '679'),
(74, 'FI', 'Finland', '358'),
(75, 'FR', 'France', '33'),
(76, 'GF', 'French Guiana', '594'),
(77, 'PF', 'French Polynesia', '689'),
(78, 'TF', 'French Southern Territories', ''),
(79, 'GA', 'Gabon', '241'),
(80, 'GM', 'Gambia', '220'),
(81, 'GE', 'Georgia', '995'),
(82, 'DE', 'Germany', '49'),
(83, 'GH', 'Ghana', '233'),
(84, 'GI', 'Gibraltar', '350'),
(85, 'GR', 'Greece', '30'),
(86, 'GL', 'Greenland', '299'),
(87, 'GD', 'Grenada', '1473'),
(88, 'GP', 'Guadeloupe', '590'),
(89, 'GU', 'Guam', '1671'),
(90, 'GT', 'Guatemala', '502'),
(91, 'XU', 'Guernsey and Alderney', '01481'),
(92, 'GN', 'Guinea', '224'),
(93, 'GW', 'Guinea-Bissau', '245'),
(94, 'GY', 'Guyana', '595'),
(95, 'HT', 'Haiti', '509'),
(96, 'HM', 'Heard and McDonald Islands', ''),
(97, 'HN', 'Honduras', '504'),
(98, 'HK', 'Hong Kong', '852'),
(99, 'HU', 'Hungary', '36'),
(100, 'IS', 'Iceland', '354'),
(101, 'IN', 'India', '91'),
(102, 'ID', 'Indonesia', '62'),
(103, 'IR', 'Iran, Islamic Republic of', '98'),
(104, 'IQ', 'Iraq', '964'),
(105, 'IE', 'Ireland', '353'),
(106, 'IL', 'Israel', '972'),
(107, 'IT', 'Italy', '39'),
(108, 'JM', 'Jamaica', '1876'),
(109, 'JP', 'Japan', '81'),
(110, 'XJ', 'Jersey', '441534'),
(111, 'JO', 'Jordan', '962'),
(112, 'KZ', 'Kazakhstan', '7 7'),
(113, 'KE', 'Kenya', '254'),
(114, 'KI', 'Kiribati', '686'),
(115, 'KP', 'Korea, Democratic People\'s Republic of', '850'),
(116, 'KR', 'Korea, Republic of', '82'),
(117, 'KW', 'Kuwait', '965'),
(118, 'KG', 'Kyrgyzstan', '996'),
(119, 'LA', 'Lao People\'s Democratic Republic', '856'),
(120, 'LV', 'Latvia', '371'),
(121, 'LB', 'Lebanon', '961'),
(122, 'LS', 'Lesotho', '266'),
(123, 'LR', 'Liberia', '231'),
(124, 'LY', 'Libyan Arab Jamahiriya', '218'),
(125, 'LI', 'Liechtenstein', '423'),
(126, 'LT', 'Lithuania', '370'),
(127, 'LU', 'Luxembourg', '352'),
(128, 'MO', 'Macao', '853'),
(129, 'MK', 'Macedonia, The Former Yugoslav Republic of', '389'),
(130, 'MG', 'Madagascar', '261'),
(131, 'MW', 'Malawi', '265'),
(132, 'MY', 'Malaysia', '60'),
(133, 'MV', 'Maldives', '960'),
(134, 'ML', 'Mali', '223'),
(135, 'MT', 'Malta', '356'),
(136, 'XM', 'Man (Isle of)', ''),
(137, 'MH', 'Marshall Islands', '692'),
(138, 'MQ', 'Martinique', '596'),
(139, 'MR', 'Mauritania', '222'),
(140, 'MU', 'Mauritius', '230'),
(141, 'YT', 'Mayotte', '262'),
(142, 'MX', 'Mexico', '52'),
(143, 'FM', 'Micronesia, Federated States of', '691'),
(144, 'MD', 'Moldova, Republic of', '373'),
(145, 'MC', 'Monaco', '377'),
(146, 'MN', 'Mongolia', '976'),
(147, 'MS', 'Montserrat', '1664'),
(148, 'MA', 'Morocco', '212'),
(149, 'MZ', 'Mozambique', '258'),
(150, 'MM', 'Myanmar', '95'),
(151, 'NA', 'Namibia', '264'),
(152, 'NR', 'Nauru', '674'),
(153, 'NP', 'Nepal', '977'),
(154, 'AN', 'Netherlands Antilles', '599'),
(155, 'NL', 'Netherlands', '31'),
(156, 'NC', 'New Caledonia', '687'),
(157, 'NZ', 'New Zealand', '64'),
(158, 'NI', 'Nicaragua', '505'),
(159, 'NE', 'Niger', '227'),
(160, 'NG', 'Nigeria', '234'),
(161, 'NU', 'Niue', '683'),
(162, 'NF', 'Norfolk Island', '672'),
(163, 'MP', 'Northern Mariana Islands', '1670'),
(164, 'NO', 'Norway', '47'),
(165, 'OM', 'Oman', '968'),
(166, 'PK', 'Pakistan', '92'),
(167, 'PW', 'Palau', '680'),
(168, 'PS', 'Palestinian Territory, Occupied', '970'),
(169, 'PA', 'Panama', '507'),
(170, 'PG', 'Papua New Guinea', '675'),
(171, 'PY', 'Paraguay', '595'),
(172, 'PE', 'Peru', '51'),
(173, 'PH', 'Philippines', '63'),
(174, 'PN', 'Pitcairn', '872'),
(175, 'PL', 'Poland', '48'),
(176, 'PT', 'Portugal', '351'),
(177, 'PR', 'Puerto Rico', '1939'),
(178, 'QA', 'Qatar', '974'),
(179, 'RE', 'Réunion', '262'),
(180, 'RO', 'Romania', '40'),
(181, 'RU', 'Russia', '7'),
(182, 'RW', 'Rwanda', '250'),
(183, 'SH', 'Saint Helena, Ascension and Tristan Da Cunha', '290'),
(184, 'KN', 'Saint Kitts and Nevis', '1869'),
(185, 'LC', 'Saint Lucia', '1758'),
(186, 'PM', 'Saint Pierre and Miquelon', '508'),
(187, 'VC', 'Saint Vincent and the Grenadines', '1784'),
(188, 'WS', 'Samoa', '685'),
(189, 'SM', 'San Marino', '378'),
(190, 'ST', 'Sao Tome and Principe', '239'),
(191, 'SA', 'Saudi Arabia', '966'),
(192, 'SN', 'Senegal', '221'),
(193, 'RS', 'Serbia', '381'),
(194, 'SC', 'Seychelles', '248'),
(195, 'SL', 'Sierra Leone', '232'),
(196, 'SG', 'Singapore', '65'),
(197, 'SK', 'Slovakia', '421'),
(198, 'SI', 'Slovenia', '386'),
(199, 'XG', 'Smaller Territories of the UK', ''),
(200, 'SB', 'Solomon Islands', '677'),
(201, 'SO', 'Somalia', '252'),
(202, 'ZA', 'South Africa', '27'),
(203, 'GS', 'South Georgia and the South Sandwich Islands', '500'),
(204, 'SS', 'South Sudan', '211'),
(205, 'ES', 'Spain', '34'),
(206, 'LK', 'Sri Lanka', '94'),
(207, 'SD', 'Sudan', '249'),
(208, 'SR', 'Suriname', '597'),
(209, 'SJ', 'Svalbard and Jan Mayen', '47'),
(210, 'SZ', 'Swaziland', '268'),
(211, 'SE', 'Sweden', '46'),
(212, 'CH', 'Switzerland', '41'),
(213, 'SY', 'Syrian Arab Republic', '963'),
(214, 'TW', 'Taiwan, Province of China', '886'),
(215, 'TJ', 'Tajikistan', '992'),
(216, 'TZ', 'Tanzania, United Republic of', '255'),
(217, 'TH', 'Thailand', '66'),
(218, 'TG', 'Togo', '228'),
(219, 'TK', 'Tokelau', '690'),
(220, 'TO', 'Tonga', '676'),
(221, 'TT', 'Trinidad and Tobago', '1868'),
(222, 'TN', 'Tunisia', '216'),
(223, 'TR', 'Turkey', '90'),
(224, 'TM', 'Turkmenistan', '993'),
(225, 'TC', 'Turks and Caicos Islands', '1649'),
(226, 'TV', 'Tuvalu', '688'),
(227, 'UG', 'Uganda', '256'),
(228, 'UA', 'Ukraine', '380'),
(229, 'AE', 'United Arab Emirates', '971'),
(230, 'GB', 'United Kingdom', '44'),
(231, 'US', 'United States', '1'),
(232, 'UM', 'United States Minor Outlying Islands', '1'),
(233, 'UY', 'Uruguay', '598'),
(234, 'UZ', 'Uzbekistan', '998'),
(235, 'VU', 'Vanuatu', '678'),
(236, 'VA', 'Holy See (Vatican City State)', '379'),
(237, 'VE', 'Venezuela, Bolivarian Republic of', '58'),
(238, 'VN', 'Viet Nam', '84'),
(239, 'VG', 'Virgin Islands, British', '1284'),
(240, 'VI', 'Virgin Islands, U.S.', '1340'),
(241, 'WF', 'Wallis and Futuna', '681'),
(242, 'EH', 'Western Sahara', '212'),
(243, 'YE', 'Yemen', '967'),
(244, 'YU', 'Yugoslavia', '38'),
(245, 'ZM', 'Zambia', '260'),
(246, 'ZW', 'Zimbabwe', '263');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `driving_license` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_country` int(10) NOT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0 COMMENT '''0'':''active'',''1'':deleted''',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `customer_email`, `driving_license`, `customer_phone`, `customer_mobile`, `customer_address`, `customer_postcode`, `customer_city`, `customer_state`, `customer_country`, `organization`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'seeta', '', '', '', '', '', '', '', '', '', 101, '', 0, 0, '2018-02-15 06:48:16', '2018-02-15 13:13:56'),
(2, '', '', '', '', '', '', '', '', '', '', 101, '', 0, 0, '2018-02-15 06:48:31', '2018-02-15 13:13:54'),
(3, 'gaurav', 'roy', 'ram@gmail.com', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-15 06:57:11', '2018-02-15 02:28:30'),
(4, 'raj', '12', 'ram@gmail.com', '', '8103172052', '08103172052', 'marimata, square', '452006', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-02-15 07:03:20', '2018-02-15 02:10:08'),
(5, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', '452006', 'indore', 'indiana', 101, 'ciss', 0, 0, '2018-02-15 07:03:31', '2018-02-15 02:01:38'),
(6, 'maddy', 'lara', 'maddylara@mailinator.com', 'asd546864s', '', '', 'xyz', '784566', 'indore', '', 101, 'cis', 0, 0, '2018-02-15 10:33:04', '2018-02-15 05:03:04'),
(7, 'b', 'c', 'brejesh@hotmail.com', '234567890', '3456789', '4567890', '', '', '', '', 0, '', 0, 0, '2018-02-16 10:48:28', '2018-02-16 05:18:28'),
(8, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-16 11:18:27', '2018-02-16 05:48:27'),
(9, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-17 11:29:52', '2018-02-17 05:59:52'),
(10, 'raj', 'roy', 'ram@gmail.com', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-17 12:30:52', '2018-02-17 07:21:31'),
(11, 'lokendra', 'singh', 'lokendra@mailinator.com', '7897979798', '8103172052', '08103172052', 'marimata, square', '452006', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-02-17 12:57:50', '2018-02-17 07:27:50'),
(12, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-17 13:08:31', '2018-02-17 07:38:31'),
(13, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-17 13:08:41', '2018-02-17 07:38:41'),
(14, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-17 13:29:42', '2018-02-17 07:59:42'),
(15, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-17 13:31:02', '2018-02-17 08:01:02'),
(16, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-17 13:38:20', '2018-02-17 08:08:20'),
(17, 'h', 'garchay', 'garchay@me.com', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-17 14:40:05', '2018-02-17 09:10:05'),
(18, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 09:46:12', '2018-02-20 04:16:12'),
(19, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:01:50', '2018-02-20 04:31:50'),
(20, 'test', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:03:30', '2018-02-20 04:33:30'),
(21, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:13:47', '2018-02-20 04:43:47'),
(22, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:13:56', '2018-02-20 04:43:56'),
(23, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:14:38', '2018-02-20 04:44:38'),
(24, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:15:50', '2018-02-20 04:45:50'),
(25, 'test', 'sdfsfda', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:33:01', '2018-02-20 05:03:01'),
(26, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:35:23', '2018-02-20 05:05:23'),
(27, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 10:36:39', '2018-02-20 05:06:39'),
(28, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 11:17:27', '2018-02-20 05:47:27'),
(29, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 11:18:15', '2018-02-20 05:48:15'),
(30, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 11:19:44', '2018-02-20 05:49:44'),
(31, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 11:19:53', '2018-02-20 05:49:53'),
(32, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 11:28:51', '2018-02-20 05:58:51'),
(33, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-20 11:30:49', '2018-02-20 06:00:49'),
(34, 'brej', 'chauhan', 'brej@blackbeltdefence.com', '', '07766000822', '07766000822', '', '', '', '', 0, '', 0, 0, '2018-02-21 12:30:53', '2018-02-21 07:00:53'),
(35, 'jack', 'singh', 'jack@mailinator.com', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-21 14:53:40', '2018-02-21 09:23:40'),
(36, 'jack', 'roy', 'jack@mailinator.com', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-21 14:57:11', '2018-02-21 09:27:11'),
(37, 'jack', 'singh', 'jack@mailinator.com', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-21 15:06:41', '2018-02-21 09:36:41'),
(38, 'rajeshwari', 'sharma', 'maddylara@mailinator.com', '', '', '', '120', '32004', 'santa calra', 'florida', 0, '', 0, 0, '2018-02-21 15:10:34', '2018-02-21 09:40:34'),
(39, 'h', 'garchay', 'harby@blackbeltdefence.com', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 09:59:26', '2018-02-22 04:29:26'),
(40, 'raj', 'roy', 'ram@mailinator.com', '7897979798', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-22 10:36:24', '2018-02-22 05:06:24'),
(41, 'raj', 'roy', 'ram@mailinator.com', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-22 10:39:07', '2018-02-22 05:09:07'),
(42, 'raj', 'roy', 'ram', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-22 10:39:59', '2018-02-22 05:09:59'),
(43, 'raj', 'roy', 'ram@gmail.com', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-22 10:40:22', '2018-02-22 05:10:22'),
(44, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 10:40:48', '2018-02-22 05:10:48'),
(45, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 10:41:01', '2018-02-22 05:11:01'),
(46, 'raj', 'roy', 'ram@gmail.com', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-22 10:41:18', '2018-02-22 05:11:18'),
(47, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 10:41:40', '2018-02-22 05:11:40'),
(48, 'raj', 'roy', 'ram@gmail.com', '', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-22 10:42:42', '2018-02-22 05:12:42'),
(49, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 10:43:03', '2018-02-22 05:13:03'),
(50, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 10:44:19', '2018-02-22 05:14:19'),
(51, 'raj', 'roy', 'ram@gmail.com', '7897979798', '8103172052', '08103172052', 'test', '45646', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-02-22 10:44:33', '2018-02-22 05:14:33'),
(52, 'lokendra', 'singh', 'lokendra@mailinator.com', '7897979798', '8103172052', '08103172052', 'marimata, square', '452006', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-02-22 10:44:47', '2018-02-22 05:14:47'),
(53, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', '452006', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-02-22 10:45:14', '2018-02-22 05:15:14'),
(54, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', '452006', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-02-22 10:45:40', '2018-02-22 05:15:40'),
(55, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 11:00:06', '2018-02-22 05:30:06'),
(56, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', '452006', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-02-22 11:00:14', '2018-02-22 05:30:14'),
(57, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', '452006', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-02-22 11:00:42', '2018-02-22 05:30:42'),
(58, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 11:01:22', '2018-02-22 05:31:22'),
(59, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 11:55:35', '2018-02-22 06:25:35'),
(60, 't', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-02-22 12:03:56', '2018-03-15 02:53:31'),
(61, 'test', 'test', 'test@mailinator.com', '', '1234567890', '01234567890', 'indore', '123456', 'indore', 'madhya pradesh', 101, 'test', 0, 0, '2018-03-17 10:44:45', '2018-03-17 05:14:45'),
(62, 'test', 'test', 'test@mailinator.com', '', '1234567890', '01234567890', 'indore', '123456', 'indore', 'madhya pradesh', 101, 'test', 0, 0, '2018-03-17 10:45:57', '2018-03-17 05:15:57'),
(63, 'jen', 'test', 'jentest@bb.com', '', '', '9046542324', '123 test ave', '32226', 'jacksonville', 'florida', 223, 'jen trade in', 0, 0, '2018-03-19 18:58:20', '2018-03-19 13:28:20'),
(64, 'test', 'test', 'test@mailinator.com', '', '1234567890', '01234567890', 'indore', '123456', 'indore', 'madhya pradesh', 101, 'test', 0, 0, '2018-03-20 06:57:11', '2018-03-20 01:27:11'),
(65, 'test', 'test', 'test@mailinator.com', '', '1234567890', '01234567890', 'indore', '123456', 'indore', 'madhya pradesh', 101, 'test', 0, 0, '2018-03-20 13:13:13', '2018-03-20 07:43:13'),
(66, 'test', 'test', 'test@mailinator.com', '', '1234567890', '01234567890', 'indore', '123456', 'indore', 'madhya pradesh', 101, 'test', 0, 0, '2018-03-20 13:17:20', '2018-03-20 07:47:20'),
(67, 'test', 'test', 'test@mailinator.com', '', '1234567890', '01234567890', 'indore', '123456', 'indore', 'madhya pradesh', 101, 'test', 0, 0, '2018-03-20 13:18:21', '2018-03-20 07:48:21'),
(68, 'test', 'test', 'test@mailinator.com', '', '1234567890', '01234567890', 'indore', '123456', 'indore', 'madhya pradesh', 101, 'test', 0, 0, '2018-03-20 13:30:40', '2018-03-20 08:00:40'),
(69, '', '', '', '', '', '', '', 'ab10', '', '', 0, '', 0, 0, '2018-04-16 08:12:47', '2018-04-16 02:42:47'),
(70, '', '', '', '', '', '', '', 'ab10', '', '', 0, '', 0, 0, '2018-04-16 08:15:31', '2018-04-16 02:45:31'),
(71, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-04-16 08:15:53', '2018-04-16 02:45:53'),
(72, '', '', 'sfdasdf@gmail.com', '', '', '23234324', '', '', '', '', 0, '', 0, 0, '2018-04-18 10:36:59', '2018-04-18 05:06:59'),
(73, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '918103172052', '918103172052', 'marimata, square', 'ab10', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-04-19 10:02:28', '2018-04-19 04:32:28'),
(74, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '918103172052', 'marimata, square', 'ab10', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-04-19 10:05:03', '2018-04-19 04:35:03'),
(75, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '918103172052', 'marimata, square', 'ab10', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-04-19 10:06:17', '2018-04-19 04:36:17'),
(76, '', '', 'raj@mailinator.com', '', '8103172052', '917089306333', '', 'ab10', '', '', 0, '', 0, 0, '2018-04-19 10:13:36', '2018-04-19 04:43:36'),
(77, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '+918103172052', 'marimata, square', 'ab10', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-04-19 10:31:00', '2018-04-19 05:01:00'),
(78, '45', '45', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', 'ab10', 'indore', 'mp', 101, '', 0, 0, '2018-04-19 10:50:57', '2018-04-19 05:20:57'),
(79, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', 'ab10', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-04-19 10:52:31', '2018-04-19 05:22:31'),
(80, 'jack', 'singh', 'jack@mailinator.com', '', '8103172052', '08103172052', 'test', 'ab10', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-04-19 10:59:25', '2018-04-19 05:29:25'),
(81, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-04-20 10:48:13', '2018-04-20 05:18:13'),
(82, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-04-20 10:48:34', '2018-04-20 05:18:34'),
(83, '', '', '', '', '', '', '', '', '', '', 0, '', 0, 0, '2018-04-20 10:58:42', '2018-04-20 05:28:42'),
(84, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', 'ab10', 'indore', 'indiana', 0, 'cis', 0, 0, '2018-04-20 11:02:05', '2018-04-20 05:32:05'),
(85, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', 'ab10', 'indore', 'indiana', 0, 'cis', 0, 0, '2018-04-20 11:02:33', '2018-04-20 05:32:33'),
(86, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '917089306333', 'marimata, square', 'ab10', 'indore', 'indiana', 0, 'cis', 0, 0, '2018-04-20 11:05:37', '2018-04-20 05:35:37'),
(87, 'raj', 'roy', 'ram@gmail.com', '', '8103172052', '08103172052', 'test', '', '3r3242', 'mp', 101, 'cis', 0, 0, '2018-04-20 11:10:05', '2018-04-20 05:40:05'),
(88, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', '', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-04-20 11:10:48', '2018-04-20 05:40:48'),
(89, 'lokendra', 'singh', 'lokendra@mailinator.com', '', '8103172052', '08103172052', 'marimata, square', '', 'indore', 'indiana', 101, 'cis', 0, 0, '2018-04-20 11:11:36', '2018-04-20 05:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_complains`
--

CREATE TABLE `feedback_complains` (
  `id` int(11) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `user_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `comment` longtext CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `status` enum('new','in_progress','resolved','late') NOT NULL DEFAULT 'new',
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_complains`
--

INSERT INTO `feedback_complains` (`id`, `user_id`, `user_city`, `name`, `email`, `mobile`, `comment`, `status`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 10, NULL, 'sandeep', 'sandeep.d9ithub@gmail.com', '987654', 'test', 'in_progress', NULL, '2019-06-18 04:59:17', '2019-07-12 16:57:40'),
(2, 10, NULL, 'amit', 'sandeep.d9ithub@gmail.com', '987', 'test', 'in_progress', NULL, '2019-06-18 05:03:46', '2019-07-12 13:44:59'),
(3, 10, NULL, 'amit', 'kandarp.d9ithub@gmail.com', NULL, 'sdf', 'resolved', NULL, '2019-06-18 05:05:31', '2019-07-12 16:57:57'),
(4, 10, NULL, 'j', 'admin@mailinator.com', NULL, 'hjgj', 'late', NULL, '2019-06-18 05:06:18', '2019-07-09 15:33:42'),
(5, 10, NULL, 'sdf', 'admin@mailinator.com', 'sdf', 'sdfsdf', 'new', NULL, '2019-06-18 05:06:59', '2019-06-18 05:06:59'),
(6, 1, NULL, NULL, 'admin@mailinator.com', NULL, 'amit', 'in_progress', NULL, '2019-06-20 05:10:15', '2019-07-12 13:42:47'),
(7, 1, NULL, NULL, 'amit.d9ithub@gmail.com', NULL, 'test', 'resolved', NULL, '2019-06-20 05:21:45', '2019-07-12 16:58:42'),
(8, 1, NULL, NULL, 'sandeep.d9ithub@gmail.com', NULL, 'srdgf', 'new', NULL, '2019-06-20 05:25:35', '2019-06-20 05:25:35'),
(9, 1, NULL, NULL, 'amit.d9ithub@gmail.com', NULL, 'terst', 'late', NULL, '2019-06-20 05:27:55', '2019-07-12 13:45:07'),
(10, NULL, NULL, 'amit solanki', 'amit.d9ithub@gmail.com', '3213213', 'test', 'new', NULL, '2019-08-05 11:28:59', '2019-08-05 11:28:59'),
(11, 10, NULL, 'محمد حسين الماجد', 'mohammed.almajed.1987@gmail.com', '0543644494', 'يلتزم الطرف الثاني بدفع قيمة العقد نقديا او خدمات للنادي كما هو متفق عليه\nيلتزم الطرف الثاني بمسؤولية كاملة عن متابعة وتأمين المواد التجارية المزمع أعلانها من خلال وسائل الاعلان الثابتة والمتحركة المتاحة من خلال هذه الاتفاقية والتي تمكنه من مباشرة كافة حقوقه كراعي مشارك والمنصوص عليها بالبند السابق.', 'in_progress', NULL, '2019-09-01 10:56:43', '2019-09-02 12:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_question`
--

CREATE TABLE `feedback_question` (
  `id` int(11) NOT NULL,
  `feedback_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `emoji_rating` varchar(255) DEFAULT NULL,
  `emoji_rating_5` varchar(255) DEFAULT NULL,
  `emoji_name_5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `emoji_rating_4` varchar(255) DEFAULT NULL,
  `emoji_name_4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `emoji_rating_3` varchar(255) DEFAULT NULL,
  `emoji_name_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `emoji_rating_2` varchar(255) DEFAULT NULL,
  `emoji_name_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `emoji_rating_1` varchar(255) DEFAULT NULL,
  `emoji_name_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `is_selected` int(10) NOT NULL DEFAULT 0,
  `question_font_size` varchar(255) DEFAULT NULL,
  `question_title_color` varchar(255) DEFAULT NULL,
  `question_order` int(255) DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_question`
--

INSERT INTO `feedback_question` (`id`, `feedback_id`, `question`, `emoji_rating`, `emoji_rating_5`, `emoji_name_5`, `emoji_rating_4`, `emoji_name_4`, `emoji_rating_3`, `emoji_name_3`, `emoji_rating_2`, `emoji_name_2`, `emoji_rating_1`, `emoji_name_1`, `is_selected`, `question_font_size`, `question_title_color`, `question_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'How is our service today', 'emoji', 'emoji/img/1f60b.png', 'good', 'emoji/img/1f61b.png', 'excellent', 'emoji/img/1f60a.png', 'average', 'emoji/img/1f62a.png', 'poor', 'emoji/img/1f62c.png', 'very poor', 0, '38px', '#71261f', 1, '2019-06-13 12:08:52.416927', '2019-09-12 10:50:12.684889'),
(2, 1, 'test', 'rating', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '30px', '#ffffff', 10, '2019-06-18 05:49:46.411636', '2019-09-12 10:50:16.407733'),
(3, 1, 'is everything is wonderful with you visit today', 'rating', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '33px', NULL, NULL, '2019-08-18 05:17:10.231457', '2019-09-12 10:50:20.852432'),
(4, 1, 'how are we today', 'rating', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '34px', NULL, NULL, '2019-08-18 05:17:33.821952', '2019-09-12 10:50:25.437259'),
(5, 1, 'كيف كانت زيارتك لنا اليوم', 'rating', 'emoji/img/1f60b.png', NULL, 'emoji/img/1f61b.png', NULL, 'emoji/img/1f49a.png', NULL, 'emoji/img/1f62a.png', NULL, 'emoji/img/1f62c.png', NULL, 1, '50px', NULL, NULL, '2019-08-18 05:17:54.587831', '2019-09-12 15:07:28.966571'),
(6, 2, 'كيف كانت زيارتك لنا اليوم', 'emoji', 'emoji/img/1f60b.png', 'emoji 1', 'emoji/img/1f61b.png', 'emoji 2', 'emoji/img/1f49a.png', 'emoji 3', 'emoji/img/1f62a.png', 'emoji 4', 'emoji/img/1f62c.png', 'emoji 5', 1, '35px', '#1d3e86', 7, '2019-08-18 05:17:54.587831', '2019-09-05 09:03:33.302619'),
(7, 0, 'Just check Question', 'rating', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '12px', '#308870', NULL, '2019-09-05 08:53:37.973489', '2019-09-05 10:04:13.975138'),
(8, 2, 'adasd', 'emoji', 'emoji/img/1f324.png', 'emoji 6', 'emoji/img/1f613.png', 'emoji 7', 'emoji/img/1f608.png', 'emoji 8', 'emoji/img/1f621.png', 'emoji 9', 'emoji/img/1f618.png', 'emoji 10', 1, '30px', '#d5d322', 2, '2019-09-05 08:55:06.803226', '2019-09-09 04:01:19.514806'),
(9, 1, 'What is my rank', 'rating', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '13px', '#2e37ac', NULL, '2019-09-05 10:02:30.367663', '2019-09-12 10:50:28.848004'),
(10, 3, 'What is mark', 'emoji', 'emoji/img/1f47e.png', 'emoji 1', 'emoji/img/1f603.png', 'emoji 2', 'emoji/img/1f497.png', 'emoji 3', 'emoji/img/1f619.png', 'emoji 4', 'emoji/img/1f62b.png', 'emoji 5', 1, '22px', '#45a5b6', NULL, '2019-09-05 10:03:31.236784', '2019-09-06 10:27:35.105562'),
(11, 4, 'What your nick name', 'emoji', 'emoji/img/1f47c.png', 'emoji 1', 'emoji/img/1f601.png', 'emoji 2', 'emoji/img/1f634.png', 'emoji 3', 'emoji/img/1f915.png', 'emoji 4', 'emoji/img/1f617.png', 'emoji 5', 1, '46px', '#1c9550', NULL, '2019-09-06 05:05:25.021438', '2019-09-06 05:06:38.995383'),
(12, 5, 'What a favorite goal?', 'emoji', 'emoji/img/1f62c.png', 'emoji 6', 'emoji/img/1f610.png', 'emoji 7', 'emoji/img/1f630.png', 'emoji 8', 'emoji/img/1f640.png', 'emoji 9', 'emoji/img/1f327.png', 'emoji 10', 1, '48px', '#b95b2c', NULL, '2019-09-06 09:41:00.010429', '2019-09-06 09:42:15.540020'),
(13, 2, 'What your rank?', 'rating', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '36px', 'rgba(55,231,226,0.53)', 6, '2019-09-06 10:20:40.680387', '2019-09-06 10:20:52.820387'),
(14, 3, 'What your nick name ?', 'rating', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '97px', '#414fac', NULL, '2019-09-06 10:28:18.453099', '2019-09-06 10:28:18.453099');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_rating`
--

CREATE TABLE `feedback_rating` (
  `id` int(11) NOT NULL,
  `feedback_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_city` varchar(255) DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_rating`
--

INSERT INTO `feedback_rating` (`id`, `feedback_id`, `question_id`, `user_id`, `user_city`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 10, NULL, 'waiting time is very very long and i hate waiting', '2019-06-14 05:24:41', '2019-06-14 05:24:41'),
(2, 1, NULL, 10, NULL, 'waiting time is very very long and i hate waiting', '2019-06-17 11:13:21', '2019-06-17 11:13:21'),
(3, 1, NULL, 10, '3', 'waiting time is very very long and i hate waiting', '2019-06-17 11:14:35', '2019-06-17 11:14:35'),
(4, 1, NULL, 10, '3', 'waiting time is very very long and i hate waiting', '2019-06-17 12:14:44', '2019-06-17 12:14:44'),
(5, 1, NULL, 10, '3', 'you staff are not friendly and they are angry', '2019-06-17 12:14:48', '2019-06-17 12:14:48'),
(6, 1, NULL, 1, '', 'your menu is poor i wish o went to Buffia', '2019-06-20 04:32:59', '2019-06-20 04:32:59'),
(7, 1, NULL, 10, '0', 'waiting time is very very long and i hate waiting', '2019-07-12 17:16:05', '2019-07-12 17:16:05'),
(8, 1, NULL, 10, '0', 'you staff are not friendly and they are angry', '2019-07-12 17:16:17', '2019-07-12 17:16:17'),
(9, 1, NULL, 10, '0', 'your menu is poor i wish o went to Buffia', '2019-07-12 17:16:59', '2019-07-12 17:16:59'),
(10, 1, NULL, 10, '0', 'waiting time is very very long and i hate waiting', '2019-07-17 10:31:36', '2019-07-17 10:31:36'),
(11, 1, NULL, 10, '0', 'you staff are not friendly and they are angry', '2019-07-17 10:37:34', '2019-07-17 10:37:34'),
(12, 1, NULL, 10, '0', 'you staff are not friendly and they are angry', '2019-07-17 10:38:23', '2019-07-17 10:38:23'),
(13, 1, NULL, 10, '0', 'waiting time is very very long and i hate waiting', '2019-08-25 09:24:40', '2019-08-25 09:24:40'),
(14, 2, NULL, 10, NULL, 'waiting time is very very long and i hate waiting', '2019-06-14 05:24:41', '2019-06-14 05:24:41'),
(15, 3, NULL, 10, '0', 'Good', '2019-09-05 06:51:05', '2019-09-05 06:51:05'),
(19, 3, NULL, 10, '0', 'Good', '2019-09-05 07:01:12', '2019-09-05 07:01:12'),
(20, 4, NULL, 10, '0', 'What\'s your demand?', '2019-09-06 00:03:05', '2019-09-06 00:03:05'),
(21, 4, NULL, 10, '0', 'Just save', '2019-09-06 00:21:32', '2019-09-06 00:21:32'),
(22, 4, NULL, 10, '0', 'Whats your demand?', '2019-09-06 00:21:53', '2019-09-06 00:21:53'),
(23, 4, NULL, 10, '0', 'Just save', '2019-09-06 03:43:44', '2019-09-06 03:43:44'),
(24, 5, NULL, 10, '0', 'Waiting you', '2019-09-06 04:19:44', '2019-09-06 04:19:44'),
(25, NULL, NULL, 10, '0', 'جودة المنتج تحتاج الى تحسين', '2019-09-06 15:13:36', '2019-09-06 15:13:36'),
(26, NULL, NULL, 10, '0', 'Good', '2019-09-06 15:18:52', '2019-09-06 15:18:52'),
(27, 3, NULL, 10, '0', 'just say', '2019-09-06 15:29:30', '2019-09-06 15:29:30'),
(28, 3, NULL, 10, '0', 'just say', '2019-09-06 15:48:01', '2019-09-06 15:48:01'),
(29, 4, NULL, 10, '0', 'Whats your demand?', '2019-09-06 15:53:01', '2019-09-06 15:53:01'),
(30, 5, NULL, 10, '0', 'Waiting you', '2019-09-06 15:56:30', '2019-09-06 15:56:30'),
(31, 5, NULL, 10, '0', 'Some one is important', '2019-09-06 17:49:12', '2019-09-06 17:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_reason`
--

CREATE TABLE `feedback_reason` (
  `id` int(50) NOT NULL,
  `feedback_id` int(11) DEFAULT NULL,
  `feedback_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_reason`
--

INSERT INTO `feedback_reason` (`id`, `feedback_id`, `feedback_reason`, `created_at`, `updated_at`) VALUES
(53, 4, 'Whats your demand?', '2019-09-06 00:02:42', '2019-09-06 05:48:16'),
(54, 4, 'Just save', '2019-09-06 00:02:42', '2019-09-06 00:02:42'),
(66, 1, 'وقت الأنتظار طويل جدا', '2019-09-17 03:33:57', '2019-09-17 03:33:57'),
(67, 1, 'الموظف لم يكن متعاون معي', '2019-09-17 03:33:57', '2019-09-17 03:33:57'),
(68, 1, 'جودة المنتج تحتاج الى تحسين', '2019-09-17 03:33:57', '2019-09-17 03:33:57'),
(69, 2, 'وقت الأنتظار طويل جدا', '2019-09-17 03:34:29', '2019-09-17 03:34:29'),
(70, 2, 'Good', '2019-09-17 03:34:29', '2019-09-17 03:34:29'),
(71, 2, 'waiting time is very very long and i hate waiting', '2019-09-17 03:34:29', '2019-09-17 03:34:29'),
(75, 3, 'just say', '2019-09-17 03:35:02', '2019-09-17 03:35:02'),
(76, 5, 'Waiting you', '2019-09-17 03:38:39', '2019-09-17 03:38:39'),
(77, 5, 'Some one is important', '2019-09-17 03:38:39', '2019-09-17 03:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_survey`
--

CREATE TABLE `feedback_survey` (
  `id` int(50) NOT NULL,
  `feedback_id` int(11) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `user_city` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `question_id` int(50) DEFAULT NULL,
  `rating` int(50) DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_survey`
--

INSERT INTO `feedback_survey` (`id`, `feedback_id`, `user_id`, `user_city`, `question_id`, `rating`, `comments`, `name`, `email`, `mobile`, `created_at`) VALUES
(1, 1, 10, '3', 1, 2, NULL, NULL, NULL, NULL, '2019-06-13 12:09:09'),
(2, 1, 10, '3', 1, 4, NULL, NULL, NULL, NULL, '2019-06-13 12:09:28'),
(3, 1, 10, '3', 1, 1, NULL, NULL, NULL, NULL, '2019-06-13 12:09:46'),
(4, 1, 10, '3', 1, 1, NULL, NULL, NULL, NULL, '2019-06-13 12:09:49'),
(5, 1, 10, '3', 1, 2, NULL, NULL, NULL, NULL, '2019-06-14 05:24:40'),
(6, 1, 10, '3', 1, 2, NULL, NULL, NULL, NULL, '2019-06-17 11:13:20'),
(7, 1, 10, '3', 1, 2, NULL, NULL, NULL, NULL, '2019-06-17 11:13:58'),
(8, 1, 10, '3', 1, 2, NULL, NULL, NULL, NULL, '2019-06-17 11:14:34'),
(9, 1, 10, '3', 1, 3, NULL, NULL, NULL, NULL, '2019-06-17 12:04:20'),
(10, 1, 10, '3', 1, 4, NULL, NULL, NULL, NULL, '2019-06-17 12:14:30'),
(11, 1, 10, '3', 1, 3, NULL, NULL, NULL, NULL, '2019-06-17 12:14:42'),
(12, 1, 10, '3', 1, 2, NULL, NULL, NULL, NULL, '2019-06-17 12:14:47'),
(13, 1, 1, '', 2, 2, NULL, NULL, NULL, NULL, '2019-06-19 06:50:19'),
(14, 1, 1, '', 1, 2, NULL, NULL, NULL, NULL, '2019-06-19 06:50:19'),
(15, 1, 1, '', 2, 2, NULL, NULL, NULL, NULL, '2019-06-19 06:50:37'),
(16, 1, 1, '', 1, 2, NULL, NULL, NULL, NULL, '2019-06-19 06:50:37'),
(17, 1, 1, '', 2, 1, NULL, NULL, NULL, NULL, '2019-06-19 06:51:17'),
(18, 1, 1, '', 1, 1, NULL, NULL, NULL, NULL, '2019-06-19 06:51:18'),
(19, 1, 1, '', 2, 1, NULL, NULL, NULL, NULL, '2019-06-19 06:51:48'),
(20, 1, 1, '', 1, 1, NULL, NULL, NULL, NULL, '2019-06-19 06:51:48'),
(21, 1, 1, '', 2, 1, NULL, NULL, NULL, NULL, '2019-06-19 06:51:56'),
(22, 1, 1, '', 1, 1, NULL, NULL, NULL, NULL, '2019-06-19 06:51:56'),
(23, 1, 1, '', 2, 1, NULL, NULL, NULL, NULL, '2019-06-19 06:53:00'),
(24, 1, 1, '', 1, 1, NULL, NULL, NULL, NULL, '2019-06-19 06:53:00'),
(25, 1, 1, '', 2, 1, NULL, NULL, NULL, NULL, '2019-06-20 04:32:56'),
(26, 1, 1, '', 1, 2, NULL, NULL, NULL, NULL, '2019-06-20 04:32:57'),
(27, 1, 10, '', 2, 5, NULL, NULL, NULL, NULL, '2019-07-09 10:33:12'),
(28, 1, 10, '', 2, 5, NULL, NULL, NULL, NULL, '2019-07-09 10:33:50'),
(29, 1, 10, '', 2, 5, NULL, NULL, NULL, NULL, '2019-07-09 10:35:42'),
(30, 1, 10, '0', 2, 4, NULL, NULL, NULL, NULL, '2019-07-12 12:15:30'),
(31, 1, 10, '0', 1, 1, NULL, NULL, NULL, NULL, '2019-07-12 12:16:03'),
(32, 1, 10, '0', 2, 3, NULL, NULL, NULL, NULL, '2019-07-12 12:16:14'),
(33, 1, 10, '0', 1, 1, NULL, NULL, NULL, NULL, '2019-07-12 12:16:15'),
(34, 1, 10, '0', 2, 2, NULL, NULL, NULL, NULL, '2019-07-12 12:16:57'),
(35, 1, 10, '0', 1, 2, NULL, NULL, NULL, NULL, '2019-07-12 12:16:58'),
(36, 1, 10, '0', 2, 4, NULL, NULL, NULL, NULL, '2019-07-12 12:17:23'),
(37, 1, 10, '0', 1, 4, NULL, NULL, NULL, NULL, '2019-07-12 12:17:23'),
(38, 1, 10, '0', 2, 3, NULL, NULL, NULL, NULL, '2019-07-17 05:31:31'),
(39, 1, 10, '0', 1, 3, NULL, NULL, NULL, NULL, '2019-07-17 05:31:34'),
(40, 1, 10, '0', 1, 3, NULL, NULL, NULL, NULL, '2019-07-17 05:34:16'),
(41, 1, 10, '0', 1, 3, NULL, NULL, NULL, NULL, '2019-07-17 05:37:29'),
(42, 1, 10, '0', 1, 5, NULL, NULL, NULL, NULL, '2019-07-17 05:38:15'),
(43, 1, 10, '0', 1, 3, NULL, NULL, NULL, NULL, '2019-07-17 05:38:19'),
(44, 1, 10, '0', 2, 2, NULL, NULL, NULL, NULL, '2019-07-17 06:08:04'),
(45, 1, 10, '0', 5, 3, NULL, NULL, NULL, NULL, '2019-08-18 05:18:52'),
(46, 1, 10, '0', 4, 4, NULL, NULL, NULL, NULL, '2019-08-18 05:18:54'),
(47, 1, 10, '0', 2, 4, NULL, NULL, NULL, NULL, '2019-08-18 05:18:59'),
(48, 1, 10, '0', 3, 4, NULL, NULL, NULL, NULL, '2019-08-18 05:19:00'),
(49, 1, 10, '0', 2, 5, NULL, NULL, NULL, NULL, '2019-08-18 05:22:48'),
(50, 1, 10, '0', 3, 4, NULL, NULL, NULL, NULL, '2019-08-18 05:22:49'),
(51, 1, 10, '0', 4, 4, NULL, NULL, NULL, NULL, '2019-08-18 05:22:53'),
(52, 1, 10, '0', 5, 5, NULL, NULL, NULL, NULL, '2019-08-18 05:22:57'),
(53, 1, 10, '0', 2, 4, NULL, NULL, NULL, NULL, '2019-08-18 05:23:06'),
(54, 1, 10, '0', 3, 3, NULL, NULL, NULL, NULL, '2019-08-18 05:23:09'),
(55, 1, 10, '0', 4, 4, NULL, NULL, NULL, NULL, '2019-08-18 05:23:10'),
(56, 1, 10, '0', 5, 5, NULL, NULL, NULL, NULL, '2019-08-18 05:24:48'),
(57, 1, 10, '0', 5, 5, NULL, NULL, NULL, NULL, '2019-08-25 04:22:38'),
(58, 1, 10, '0', 5, 1, NULL, NULL, NULL, NULL, '2019-08-25 04:24:36'),
(59, 1, 10, '0', 5, 2, NULL, NULL, NULL, NULL, '2019-08-28 07:48:09'),
(60, 1, 10, '0', 5, 1, NULL, NULL, NULL, NULL, '2019-08-28 07:48:13'),
(61, 1, 10, '0', 5, 1, NULL, NULL, NULL, NULL, '2019-08-28 07:51:11'),
(62, 1, 10, '0', 5, 1, NULL, NULL, NULL, NULL, '2019-08-28 07:52:02'),
(63, 1, 10, '0', 5, 1, NULL, NULL, NULL, NULL, '2019-08-28 07:53:45'),
(64, 1, 10, '0', 1, 2, NULL, NULL, NULL, NULL, '2019-08-28 07:59:58'),
(65, 1, 10, '0', 1, 1, NULL, NULL, NULL, NULL, '2019-08-28 08:00:04'),
(66, 1, 10, '0', 1, 1, NULL, NULL, NULL, NULL, '2019-08-28 08:00:35'),
(67, 1, 10, '0', 5, 1, NULL, NULL, NULL, NULL, '2019-08-28 08:17:53'),
(68, 1, 10, '0', 5, 2, NULL, NULL, NULL, NULL, '2019-08-28 08:18:26'),
(69, 1, 10, '0', 5, 1, NULL, NULL, NULL, NULL, '2019-08-28 08:18:57'),
(70, 1, 10, '0', 5, 2, NULL, NULL, NULL, NULL, '2019-09-01 07:03:26'),
(71, 2, 10, '0', 6, 2, NULL, NULL, NULL, NULL, '2019-09-01 07:03:26'),
(72, 2, 10, '0', 6, 2, NULL, NULL, NULL, NULL, '2019-09-01 07:03:26'),
(73, 3, 10, '0', 10, 4, NULL, NULL, NULL, NULL, '2019-09-05 10:07:08'),
(74, 3, 10, '0', 10, 4, NULL, NULL, NULL, NULL, '2019-09-05 10:38:28'),
(75, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 10:57:51'),
(76, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 10:58:02'),
(77, 3, 10, '0', 10, 4, NULL, NULL, NULL, NULL, '2019-09-05 10:58:18'),
(86, 2, 10, '0', 1, 3, NULL, NULL, NULL, NULL, '2019-09-05 11:25:54'),
(92, 2, 10, '0', 1, 4, NULL, NULL, NULL, NULL, '2019-09-05 11:26:23'),
(98, 1, 10, '0', 1, 4, NULL, NULL, NULL, NULL, '2019-09-05 11:27:53'),
(99, 1, 10, '0', 2, 5, NULL, NULL, NULL, NULL, '2019-09-05 11:32:42'),
(100, 1, 10, '0', 3, 4, NULL, NULL, NULL, NULL, '2019-09-05 11:32:49'),
(101, 1, 10, '0', 4, 4, NULL, NULL, NULL, NULL, '2019-09-05 11:32:51'),
(102, 1, 10, '0', 5, 4, NULL, NULL, NULL, NULL, '2019-09-05 11:32:52'),
(103, 1, 10, '0', 9, 4, NULL, NULL, NULL, NULL, '2019-09-05 11:32:54'),
(104, 1, 10, '0', 1, 4, NULL, NULL, NULL, NULL, '2019-09-05 11:32:54'),
(111, 2, 10, '0', 8, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:14:06'),
(112, 2, 10, '0', 6, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:14:07'),
(113, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:14:39'),
(114, 3, 10, '0', 10, 2, NULL, NULL, NULL, NULL, '2019-09-05 12:16:42'),
(115, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:20:06'),
(116, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:20:54'),
(117, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:21:04'),
(118, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:21:23'),
(119, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:21:56'),
(120, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:26:59'),
(121, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:27:08'),
(122, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:27:38'),
(123, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:28:03'),
(124, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:28:26'),
(125, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:29:37'),
(126, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:30:21'),
(127, 3, 10, '0', 10, 3, NULL, NULL, NULL, NULL, '2019-09-05 12:31:11'),
(128, 3, 10, '0', 11, 4, NULL, NULL, NULL, NULL, '2019-09-06 05:07:30'),
(129, 4, 10, '0', 11, 3, NULL, NULL, NULL, NULL, '2019-09-06 05:27:48'),
(130, 4, 10, '0', 11, 3, NULL, NULL, NULL, NULL, '2019-09-06 05:33:02'),
(131, 4, 10, '0', 11, 5, NULL, NULL, NULL, NULL, '2019-09-06 05:51:15'),
(132, 4, 10, '0', 11, 1, NULL, NULL, NULL, NULL, '2019-09-06 05:51:30'),
(133, 4, 10, '0', 11, 3, NULL, NULL, NULL, NULL, '2019-09-06 05:51:52'),
(134, 4, 10, '0', 11, 3, NULL, NULL, NULL, NULL, '2019-09-06 09:13:41'),
(135, 5, 10, '0', 12, 4, NULL, NULL, NULL, NULL, '2019-09-06 09:43:11'),
(136, 5, 10, '0', 12, 1, NULL, NULL, NULL, NULL, '2019-09-06 09:44:36'),
(137, 5, 10, '0', 12, 1, NULL, NULL, NULL, NULL, '2019-09-06 09:49:43'),
(138, 1, 10, '0', 4, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:13:21'),
(139, 1, 10, '0', 5, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:13:22'),
(140, 1, 10, '0', 9, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:13:23'),
(141, 1, 10, '0', 1, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:13:24'),
(142, 1, 10, '0', 2, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:13:25'),
(143, 1, 10, '0', 3, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:13:32'),
(144, 2, 10, '0', 8, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:18:50'),
(145, 2, 10, '0', 6, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:18:51'),
(146, 3, 10, '0', 10, 2, NULL, NULL, NULL, NULL, '2019-09-06 10:28:56'),
(147, 3, 10, '0', 14, 2, NULL, NULL, NULL, NULL, '2019-09-06 10:28:58'),
(148, 3, 10, '0', 10, 2, NULL, NULL, NULL, NULL, '2019-09-06 10:29:27'),
(149, 3, 10, '0', 14, 2, NULL, NULL, NULL, NULL, '2019-09-06 10:29:29'),
(150, 3, 10, '0', 10, 2, NULL, NULL, NULL, NULL, '2019-09-06 10:47:58'),
(151, 3, 10, '0', 14, 2, NULL, NULL, NULL, NULL, '2019-09-06 10:47:59'),
(152, 4, 10, '0', 11, 2, NULL, NULL, NULL, NULL, '2019-09-06 10:52:46'),
(153, 5, 10, '0', 12, 2, NULL, NULL, NULL, NULL, '2019-09-06 10:56:28'),
(154, 5, 10, '0', 12, 3, NULL, NULL, NULL, NULL, '2019-09-06 10:56:55'),
(155, 5, 10, '0', 12, 3, NULL, NULL, NULL, NULL, '2019-09-06 12:49:10'),
(156, 1, 10, '0', 3, 1, NULL, NULL, NULL, NULL, '2019-09-09 03:57:29'),
(157, 1, 10, '0', 4, 1, NULL, NULL, NULL, NULL, '2019-09-09 03:57:30'),
(158, 1, 10, '0', 5, 1, NULL, NULL, NULL, NULL, '2019-09-09 03:57:30'),
(159, 1, 10, '0', 9, 1, NULL, NULL, NULL, NULL, '2019-09-09 03:57:30'),
(160, 1, 10, '0', 1, 2, NULL, NULL, NULL, NULL, '2019-09-09 03:57:31'),
(161, 1, 10, '0', 2, 1, NULL, NULL, NULL, NULL, '2019-09-09 03:57:32'),
(162, 1, 10, '0', 5, 2, NULL, NULL, NULL, NULL, '2019-09-12 15:10:21'),
(163, 1, 10, '0', 5, 2, NULL, NULL, NULL, NULL, '2019-09-12 15:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `reset_sms_email`
--

CREATE TABLE `reset_sms_email` (
  `id` int(20) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reset_sms_email`
--

INSERT INTO `reset_sms_email` (`id`, `type`, `time`, `created_at`, `updated_at`) VALUES
(1, 'sms', '2019-07-09 17:07:12', '2018-09-14 12:45:08', '2019-07-09 12:28:12'),
(2, 'email', '2019-07-09 17:07:30', '2018-09-14 12:45:27', '2019-07-09 12:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `selected_feedback_question`
--

CREATE TABLE `selected_feedback_question` (
  `id` int(255) NOT NULL,
  `feedback_id` int(11) DEFAULT NULL,
  `question_background_color` varchar(255) DEFAULT NULL,
  `question_form_background` varchar(255) DEFAULT NULL,
  `question_form_background_mobile` varchar(225) DEFAULT NULL,
  `question_form_logo` varchar(255) DEFAULT NULL,
  `logo_size` int(255) DEFAULT NULL,
  `rating_pop_up` int(50) DEFAULT NULL,
  `name_label` varchar(255) DEFAULT NULL,
  `name_label_ar` varchar(255) CHARACTER SET utf32 COLLATE utf32_swedish_ci DEFAULT NULL,
  `email_label` varchar(255) DEFAULT NULL,
  `email_label_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `number_label` varchar(255) DEFAULT NULL,
  `number_label_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `comment_label` varchar(255) DEFAULT NULL,
  `comment_label_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `thank_you_message` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `complain_button` int(50) NOT NULL DEFAULT 1,
  `complain_button_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `complain_button_text_size` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `complain_button_text_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `complain_button_color` varchar(255) DEFAULT NULL,
  `complain_header_color` varchar(255) DEFAULT NULL,
  `question_sequence` int(50) NOT NULL DEFAULT 0,
  `emoji_and_rating_size` varchar(255) DEFAULT NULL,
  `complain_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `fullscreen_button` int(11) DEFAULT NULL,
  `complain_status_day` int(11) DEFAULT NULL,
  `reason_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `label_language` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `reason_appear` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `reason_font_size` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `reason_text_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `reason_text_style` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `high_rating_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `low_rating_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selected_feedback_question`
--

INSERT INTO `selected_feedback_question` (`id`, `feedback_id`, `question_background_color`, `question_form_background`, `question_form_background_mobile`, `question_form_logo`, `logo_size`, `rating_pop_up`, `name_label`, `name_label_ar`, `email_label`, `email_label_ar`, `number_label`, `number_label_ar`, `comment_label`, `comment_label_ar`, `thank_you_message`, `complain_button`, `complain_button_name`, `complain_button_text_size`, `complain_button_text_color`, `complain_button_color`, `complain_header_color`, `question_sequence`, `emoji_and_rating_size`, `complain_title`, `fullscreen_button`, `complain_status_day`, `reason_title`, `label_language`, `reason_appear`, `reason_font_size`, `reason_text_color`, `reason_text_style`, `high_rating_name`, `low_rating_name`) VALUES
(1, 1, '#323998', 'uploads/question/about-us-background-images-for-website-hd_1567774856.jpg', 'uploads/question/img22_1567596126.jpg', 'uploads/question/Erjaan_New-Logo_1568285493.png', 150, 3, 'Name', 'اسم', 'Email', 'البريد الإلكتروني', 'Number', 'رقم', 'Comment', 'تعليق', 'thank you for your feedback.', 1, 'لدي شكوة او اقتراح', '30px', '#2c3610', '#4e8c43', '#479a48', 1, 'large', 'شكوة او مقترح جديد', 0, 2, 'نأسف لعدم الحصول على رضاك التام, الرجاء اخبارنا عن السبب ليتم معالجتة', 'arabic', 'right', '30px', '#1a810d', NULL, 'High', 'Low'),
(2, 5, '#8ff6a3', 'uploads/question/about-us-background-images-for-website-hd_1567774925.jpg', NULL, 'uploads/question/logo_1566980000.png', 150, 3, 'Name', 'اسم', 'E-mail', 'البريد الإلكتروني', 'Number', 'رقم', 'Comment', 'تعليق', 'thank you for your feedback.', 1, 'لدي شكوة او اقتراح', '30px', '#2c3610', '#4e8c43', '#479a48', 0, 'small', 'شكوة او مقترح جديد', 0, 2, 'نأسف لعدم الحصول على رضاك التام, الرجاء اخبارنا عن السبب ليتم معالجتة', 'arabic', 'left', '30px', '#1a810d', NULL, 'High', 'Low'),
(3, 3, '#8ff6a3', 'uploads/question/about-us-background-images-for-website-hd_1567774986.jpg', 'uploads/question/img22_1567596126.jpg', 'uploads/question/logo_1566980000.png', 250, 3, 'Name', 'اسم', 'Email', 'البريد الإلكتروني', 'Number', 'رقم', 'Comment', 'تعليق', 'thank you for your feedback.', 1, 'لدي شكوة او اقتراح', '30px', '#2c3610', '#4e8c43', '#479a48', 1, 'small', 'شكوة او مقترح جديد', 0, 2, 'نأسف لعدم الحصول على رضاك التام, الرجاء اخبارنا عن السبب ليتم معالجتة', 'arabic', 'center', '30px', '#1a810d', NULL, 'High', 'Low'),
(4, 4, '#323998', 'uploads/question/background_1567767151.png', 'uploads/question/img22_1567596126.jpg', 'uploads/question/logo_1566980000.png', 150, 3, 'Name', 'اسم', 'Email', 'البريد الإلكتروني', 'Number', 'رقم', 'Comment', 'تعليق', 'thank you for your feedback.', 1, 'لدي شكوة او اقتراح', '30px', '#2c3610', '#4e8c43', '#479a48', 0, 'small', 'شكوة او مقترح جديد', 0, 2, 'نأسف لعدم الحصول على رضاك التام, الرجاء اخبارنا عن السبب ليتم معالجتة', 'arabic', 'center', '30px', '#1a810d', NULL, 'High', 'Low'),
(5, 5, '#323998', 'uploads/question/about-us-background-images-for-website-hd_1567775054.jpg', 'uploads/question/img22_1567596126.jpg', 'uploads/question/logo_1566980000.png', 150, 3, 'Name', 'اسم', 'Email', 'البريد الإلكتروني', 'Number', 'رقم', 'Comment', 'تعليق', 'thank you for your feedback.', 1, 'لدي شكوة او اقتراح', '30px', '#2c3610', '#4e8c43', '#479a48', 0, 'small', 'شكوة او مقترح جديد', 0, 2, 'نأسف لعدم الحصول على رضاك التام, الرجاء اخبارنا عن السبب ليتم معالجتة', 'arabic', 'center', '30px', '#1a810d', NULL, 'High', 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auto_trigger_setting`
--

CREATE TABLE `tbl_auto_trigger_setting` (
  `id` int(11) NOT NULL,
  `email_templ_id` int(11) NOT NULL,
  `sending_method` int(11) NOT NULL COMMENT 'By Email/SMS',
  `form_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `send_to` int(11) NOT NULL COMMENT 'Send to on behalf or participant',
  `waiting_hours` varchar(155) DEFAULT NULL,
  `immediately` int(11) DEFAULT NULL,
  `trigger_time` varchar(155) DEFAULT NULL,
  `waiting_time_formate` varchar(155) NOT NULL,
  `trigger_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `trigger_event` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: For Created Participant, 2: For Updated Participant',
  `type` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `group` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_auto_trigger_setting`
--

INSERT INTO `tbl_auto_trigger_setting` (`id`, `email_templ_id`, `sending_method`, `form_id`, `user_id`, `send_to`, `waiting_hours`, `immediately`, `trigger_time`, `waiting_time_formate`, `trigger_name`, `trigger_event`, `type`, `category`, `group`, `created_at`, `updated_at`) VALUES
(54, 8, 2, 0, 10, 0, NULL, 1, NULL, '0', 'update participant', 2, '3', NULL, NULL, '2019-05-31 15:03:57', '2019-07-12 11:38:18'),
(55, 18, 1, 0, 10, 0, NULL, 1, NULL, '0', 'test 123', 1, '2,3', '1,3', '1,20', '2019-07-09 11:34:46', '2019-07-09 16:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `category_name` varchar(155) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: In-Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: Not Deleted, 1: Deleted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `parent_id`, `category_name`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 0, 'Survey Category', 1, 0, '2018-05-02 18:30:00', '2018-05-03 06:28:11'),
(2, 1, 'Sub Category test', 1, 0, '2018-05-02 18:30:00', '2018-05-03 10:14:44'),
(3, 1, 'Second Sub category', 1, 0, '2018-05-02 18:30:00', '2018-05-03 05:29:23'),
(17, 1, 'test second', 1, 1, '2018-05-02 18:30:00', '2018-05-03 06:27:43'),
(18, 1, 'Sub Category test dsfdsaf', 1, 0, '2018-05-02 18:30:00', '2018-05-03 06:23:57'),
(19, 1, 'Sub Category test hello', 1, 0, '2018-05-02 18:30:00', '2018-05-03 06:27:37'),
(20, 0, 'TEst', 1, 0, '2018-05-04 18:30:00', '2018-05-05 04:01:29'),
(21, 1, 'sdfsdfasf', 1, 0, '2018-05-04 18:30:00', '2018-05-05 04:05:11'),
(22, 20, 'last test sfsd', 1, 0, '2018-05-04 18:30:00', '2018-05-05 04:06:05'),
(23, 0, 'Choice', 1, 0, '2019-07-09 05:00:00', '2019-07-09 17:29:55'),
(24, 20, 'My Rushi', 1, 0, '2019-07-09 05:00:00', '2019-07-09 18:04:48'),
(25, 1, 'fgdggfdgfddfdfgdg111', 1, 1, '2019-07-09 05:00:00', '2019-07-09 18:39:59'),
(26, 23, 'test', 1, 1, '2019-07-10 05:00:00', '2019-07-10 08:30:32'),
(27, 0, 'Sub Category 1', 1, 1, '2019-07-12 05:00:00', '2019-07-12 11:09:29'),
(28, 27, 'Sub Category 2', 1, 1, '2019-07-12 05:00:00', '2019-07-12 11:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_template`
--

CREATE TABLE `tbl_email_template` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_email_template`
--

INSERT INTO `tbl_email_template` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Third Email Template', '<p>Loreum Ipsum,</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>dollarjk</p>', '2018-05-10 00:00:00', '2018-05-15 07:49:31'),
(3, 'Second Email Template', '<p>Hello fdgdfg</p>', '2018-05-11 08:11:03', '2018-05-15 07:49:15'),
(4, 'First Email Template', '<p>ndfg</p>', '2018-05-11 10:35:04', '2018-05-15 07:49:04'),
(5, 'RJ email', '<p>RJ email content</p>\r\n\r\n<p>(participant_name)</p>\r\n\r\n<p>(survey_5)</p>', '2018-05-18 15:09:17', '2018-09-06 14:21:10'),
(6, 'email send new', '<p>hello&nbsp;(participant_name),</p>\r\n\r\n<p>1&gt; (survey_2)</p>\r\n\r\n<p>2&gt;&nbsp;(survey_10)</p>\r\n\r\n<p>3&gt;&nbsp;(survey_24)</p>', '2018-09-01 14:37:27', '2018-09-06 14:21:10'),
(7, 'Test DV', '<p>(survey_12)</p>', '2018-09-06 12:06:50', '2018-09-13 18:13:54'),
(8, 'تقييم الدورة التدريبية', '<p>&nbsp;</p>\r\n\r\n<p>المشترك في الدورة التدريبية&nbsp;(participant_name) عزيزنا&nbsp;</p>\r\n\r\n<p>نسعد بخدمتك و تقديم ما هو افضل لكم ولضمان تطوير الدورات التدريبية في مركز سماء النخبة نود سماع ارائكم و الحصول على تقييمكم للدورة التدريبية على الرابط التالي&nbsp;</p>\r\n\r\n<p>(survey_35)</p>\r\n\r\n<p>نشكر وقتكم الثمين&nbsp;<br />\r\n<br />\r\nمركز سماء النخبة للتدريب</p>', '2018-09-08 19:14:04', '2018-09-09 01:14:04'),
(9, 'restaurant', '<p>(participant_name)</p>\r\n\r\n<p>&nbsp;(survey_12)</p>', '2018-09-17 15:37:45', '2018-09-17 21:37:45'),
(10, 'clean template', '<p>(participant_name)</p>\r\n\r\n<p>(survey_38)</p>\r\n\r\n<p>&nbsp;(survey_2)</p>\r\n\r\n<p>(survey_12)</p>', '2018-09-18 11:39:33', '2018-09-21 19:51:54'),
(11, 'Villa Saraya Service Evaluatio', '<p>مرحبا يا خبيبي&nbsp;(participant_name)&nbsp;<br />\r\n<br />\r\nلا تبخل علينا يا حمار و عب الأستبيان</p>\r\n\r\n<p>(survey_36)</p>', '2018-09-20 06:57:16', '2018-09-20 12:57:16'),
(12, 'new', '<p>&nbsp;(survey_5)</p>', '2018-09-21 14:07:24', '2019-06-05 06:33:34'),
(13, 'ايميل تقييم', '<p>مرحبا يا&nbsp;(participant_name)&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ممكن تكرمنا اللة يبيح دمك&nbsp;</p>\r\n\r\n<p>وتققيم الست هاذي</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(survey_46)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>شكرا يا الخنيث</p>', '2019-06-08 16:47:35', '2019-08-07 14:47:17'),
(14, 'test email', '<p>(survey_46)</p>', '2019-08-29 04:39:02', '2019-08-29 09:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE `tbl_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: In-Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: Not Deleted, 1: Deleted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_groups`
--

INSERT INTO `tbl_groups` (`id`, `user_id`, `group_name`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 10, 'Friends', 1, 0, '2018-05-02 18:30:00', '2018-05-04 06:56:18'),
(2, 10, 'test for delete', 1, 1, '2018-05-02 18:30:00', '2018-05-03 07:28:40'),
(3, 10, 'Family', 1, 0, '2018-05-04 18:30:00', '2018-05-05 03:37:08'),
(4, 10, 'Test', 1, 0, '2019-07-09 05:00:00', '2019-07-09 17:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kpi`
--

CREATE TABLE `tbl_kpi` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `question_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_data` int(50) DEFAULT NULL,
  `kpi_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minimum_value` int(11) NOT NULL,
  `maximum_value` int(11) NOT NULL,
  `status` int(2) NOT NULL COMMENT '''0'':''Active'',''1'':''Inactive''',
  `type_id` int(50) DEFAULT NULL,
  `group_id` int(50) DEFAULT NULL,
  `category_id` int(50) DEFAULT NULL,
  `sub_category_id` int(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_kpi`
--

INSERT INTO `tbl_kpi` (`id`, `form_id`, `question_id`, `user_data`, `kpi_name`, `minimum_value`, `maximum_value`, `status`, `type_id`, `group_id`, `category_id`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(2, 10, '174,170', NULL, '123456', 0, 28, 0, NULL, NULL, NULL, NULL, '2018-06-19 09:43:17', '2018-06-19 09:43:17'),
(4, 10, '170,174,171', NULL, '5564', 0, 11, 0, NULL, NULL, NULL, NULL, '2018-06-19 09:44:49', '2018-06-19 09:44:49'),
(7, 5, '178,179', NULL, 'Second Kpi', 0, 8, 0, NULL, NULL, NULL, NULL, '2018-06-25 08:59:02', '2018-06-25 08:59:02'),
(8, 7, '91,92', NULL, 'All', 0, 33, 0, NULL, NULL, NULL, NULL, '2018-06-26 02:04:08', '2018-06-26 02:04:08'),
(9, 7, '91,92', NULL, 'Course Evaluation Satisfaction KPI', 0, 10, 0, NULL, NULL, NULL, NULL, '2018-06-27 00:31:55', '2018-06-27 00:31:55'),
(10, 12, '197,199', NULL, 'Food Quality', 0, 10, 0, NULL, NULL, NULL, NULL, '2018-08-13 13:36:27', '2018-08-13 13:36:27'),
(11, 7, '91,92', NULL, 'Overall happiness', 0, 10, 0, NULL, NULL, NULL, NULL, '2018-08-16 19:46:30', '2018-08-16 19:46:30'),
(13, 12, '197,199,198', NULL, 'Resturant evaluation', 0, 15, 0, NULL, NULL, NULL, NULL, '2018-08-24 16:31:02', '2018-08-24 16:31:02'),
(15, 2, '216,217', NULL, 'test', 0, 9, 0, NULL, NULL, NULL, NULL, '2018-09-01 12:45:08', '2018-09-01 12:45:08'),
(16, 5, '178', NULL, 'Test', 0, 4, 0, 2, 0, 0, 0, '2018-09-04 12:55:24', '2018-09-04 12:55:24'),
(18, 12, '197,198', 40, 'EE', 0, 10, 0, NULL, 0, 0, 0, '2018-09-04 20:41:15', '2018-09-04 20:41:15'),
(19, 12, '197,198,199', 38, 'DD', 0, 15, 0, NULL, 0, 0, 0, '2018-09-04 20:41:39', '2018-09-04 20:41:39'),
(20, 6, '81,82', 42, 'kandarp', 0, 10, 0, 2, 1, 1, 2, '2018-09-05 12:46:54', '2018-09-05 12:46:54'),
(21, 12, '197,198', 43, 'kandarp', 0, 10, 0, 2, 1, 1, 2, '2018-09-05 13:02:08', '2018-09-05 13:02:08'),
(22, 12, '197,199,198', 40, 'test', 0, 15, 0, 2, 1, 1, 2, '2018-09-05 19:48:02', '2018-09-05 19:48:02'),
(24, 12, '197', 40, 'test1', 0, 5, 0, 2, 1, 1, 2, '2018-09-05 21:25:03', '2018-09-05 21:25:03'),
(25, 12, '198', 40, 'test2', 0, 5, 0, 2, 3, 1, 3, '2018-09-05 21:25:52', '2018-09-05 21:25:52'),
(26, 12, '197,198', 40, 'test3', 0, 10, 0, 3, 1, 1, 18, '2018-09-05 21:26:27', '2018-09-05 21:26:27'),
(27, 12, '197', 36, 'Admins', 0, 5, 0, NULL, 0, 0, 0, '2018-09-05 21:35:46', '2018-09-05 21:35:46'),
(28, 12, '197,199', 10, 'Test', 0, 10, 0, NULL, 0, 0, 0, '2018-09-05 21:38:39', '2018-09-05 21:38:39'),
(29, 5, '178,179', 40, 'amittest', 0, 8, 0, 2, 1, 1, 2, '2018-09-06 14:26:35', '2018-09-06 14:26:35'),
(30, 5, '179', 40, 'amittest1', 0, 4, 0, 3, 3, 1, 3, '2018-09-06 14:27:04', '2018-09-06 14:27:04'),
(31, 2, '217,218', 33, 'Second KPI', 0, 9, 0, NULL, 0, 0, 0, '2018-09-15 14:11:12', '2018-09-15 14:11:12'),
(32, 2, '216,217', 34, 'third KPI', 0, 9, 0, NULL, 0, 0, 0, '2018-09-15 14:12:24', '2018-09-15 14:12:24'),
(35, 12, '197,199,198', 40, 'new kpi', 0, 15, 0, 2, 1, 1, 2, '2018-09-17 21:34:30', '2018-09-17 21:34:30'),
(39, 2, '216', NULL, 'Test', 0, 5, 0, NULL, 0, 0, 0, '2018-09-18 19:02:16', '2018-09-18 19:02:16'),
(42, 12, '197,198,199', 45, 'dv re', 0, 15, 0, NULL, 0, 0, 0, '2018-09-19 18:50:59', '2018-09-19 18:50:59'),
(43, 12, '197,198,199', 45, 'kandarp cate', 0, 15, 0, NULL, 0, 20, 0, '2018-09-19 18:53:52', '2018-09-19 18:53:52'),
(44, 12, '197,198,199', 45, 'no cate', 0, 15, 0, NULL, 0, 0, 0, '2018-09-19 18:54:42', '2018-09-19 18:54:42'),
(45, 12, '197,199,198', 45, 'KP No Cat', 0, 15, 0, NULL, 0, 2, 0, '2018-09-19 18:55:38', '2018-09-19 18:55:38'),
(46, 12, '197,199,198', 10, 'test kpi', 0, 15, 0, 2, 1, 1, 2, '2018-09-20 15:25:37', '2018-09-20 15:25:37'),
(51, 38, '444', 10, 'amit cate', 0, 5, 0, 3, 0, 20, 0, '2018-09-20 21:06:40', '2018-09-20 21:06:40'),
(52, 38, '444', 10, 'test new', 0, 5, 0, 0, 0, 1, 0, '2018-09-20 21:12:57', '2018-09-20 21:12:57'),
(55, 36, '445', 46, 'Employee Evaluation', 0, 5, 0, NULL, 0, 0, 0, '2018-09-21 14:57:09', '2018-09-21 14:57:09'),
(56, 36, '445', 47, 'Employee Evaluation', 0, 5, 0, NULL, 0, 0, 0, '2018-09-21 14:57:33', '2018-09-21 14:57:33'),
(57, 36, '445', 48, 'Employee Evaluation', 0, 5, 0, NULL, 0, 0, 0, '2018-09-21 14:57:57', '2018-09-21 14:57:57'),
(58, 36, '445', 49, 'Employee Evaluation', 0, 5, 0, NULL, 0, 0, 0, '2018-09-21 14:58:17', '2018-09-21 14:58:17'),
(59, 38, '444', 50, 'Dhruv\'s KPI', 0, 5, 0, 2, 1, 1, 2, '2018-09-21 15:29:44', '2018-09-21 15:29:44'),
(60, 38, '444', 45, 'only user', 0, 5, 0, NULL, 0, 0, 0, '2018-09-21 17:51:54', '2018-09-21 17:51:54'),
(62, 12, '197,199', 40, 'fitler test', 0, 10, 0, 2, 3, 1, 3, '2018-09-24 16:09:24', '2018-09-24 16:09:24'),
(63, 12, '197,198', 40, 'Amit\'s latest surevey\'s KPI', 0, 10, 0, 2, 1, 1, 2, '2018-09-24 17:14:22', '2018-09-24 17:14:22'),
(65, 2, '216,217', 10, 'sffd', 0, 9, 0, NULL, 0, 0, 0, '2018-10-06 19:02:49', '2018-10-06 19:02:49'),
(66, 2, '216,217,218', 10, 'Without select user KPI', 0, 14, 0, NULL, 0, 0, 0, '2018-10-06 19:11:16', '2018-10-06 19:11:16'),
(67, 2, '216,217', 10, 'This Kpi is my', 0, 9, 0, 2, 1, 1, 3, '2019-07-12 10:03:52', '2019-07-12 10:03:52'),
(68, 2, '216,217,218,219', 10, 'Rushi purohit kpi', 0, 19, 0, 2, 1, 1, 2, '2019-07-12 11:01:37', '2019-07-12 11:01:37'),
(69, 2, '216,217,220', 10, 'Test ravi', 0, 14, 0, 2, 1, 1, 18, '2019-07-12 12:02:12', '2019-07-12 12:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_participants`
--

CREATE TABLE `tbl_participants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dial_code` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_behalf_first_name` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_behalf_last_name` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_behalf_email` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_behalf_mobile` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` int(5) DEFAULT NULL,
  `dob` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: In-Active',
  `is_updated` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: For Created Participant, 2: For Updated Participant',
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: Not Deleted, 1: Deleted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_participants`
--

INSERT INTO `tbl_participants` (`id`, `user_id`, `first_name`, `last_name`, `email`, `dial_code`, `mobile`, `on_behalf_first_name`, `on_behalf_last_name`, `on_behalf_email`, `on_behalf_mobile`, `gender`, `dob`, `comment`, `category_id`, `sub_category_id`, `location_id`, `group_id`, `type_id`, `status`, `is_updated`, `is_deleted`, `created_at`, `updated_at`) VALUES
(61, 10, 'Kandarp', 'Pandya', 'kandarp.d9ithub+12@gmail.com', '91', '9427986091', NULL, NULL, NULL, NULL, 1, '2019-01-01', 'sdrg', 1, 3, 971, 3, 2, 0, 1, 1, '2019-01-18 18:30:00', '2019-04-25 12:08:37'),
(62, 10, 'Pandit', 'Arjun', 'pandit@gmail.com', '91', '9876543219', NULL, NULL, NULL, NULL, 1, '1992-01-01', 'kandarp pabdya', 1, 3, 971, 3, 2, 0, 1, 1, '2019-01-22 02:56:54', '2019-04-25 12:02:13'),
(63, 10, NULL, 'Pandya', NULL, '91', '9427986091', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 101, NULL, NULL, 1, 1, 1, '2019-01-30 05:23:00', '2019-01-30 05:53:35'),
(64, 10, 'test', 'test', 'tse@test.com', '971', '9876543210', 'test', 'tset', 'tset@test.com', '9879879879', 1, '1992-02-15', 'test', 1, 18, 229, 1, 1, 1, 1, 1, '2019-04-25 12:00:37', '2019-04-25 12:02:15'),
(65, 10, 'test', 'test', 'tseee@test.com', '971', '9876543210', 'test', 'tset', 'tset@test.com', '9879879879', 1, '1992-02-15', 'test', 1, 18, 229, 1, 2, 1, 1, 1, '2019-04-25 12:01:54', '2019-04-25 12:02:18'),
(66, 10, 'Kandarp', 'Pandya', 'palak.d9ithub@gmail.com', '23', '9427986091', 'Kandarp', 'Pandya', 'palak.d9ithub@gmail.com', '9427986091', 1, '1992-02-15', 'tesing data', 20, 22, 229, 1, 2, 0, 2, 0, '2019-04-25 12:09:18', '2019-07-16 15:20:07'),
(67, 10, 'Dhruv', 'Patel', 'd9ithub@gmail.com', '91', '9879879871', NULL, NULL, NULL, NULL, 1, '1990-04-14', 'test', 1, 3, 971, 1, 2, 0, 1, 0, '2019-04-25 12:45:45', '2019-04-26 06:40:15'),
(68, 10, 'amit', 'solanki', 'amit@gmail.com', '91', '9427986091', 'amit', 'solanki', 'amit@gmail.com', '94656654654', 0, '2019-05-02', 'test', 1, 3, 101, 1, 2, 1, 2, 0, '2019-05-17 23:35:17', '2019-06-05 23:06:14'),
(69, 54, 'Rushi', 'Purohit', 'rushi.d9ithub@gmail.com', '91', '8866768701', NULL, NULL, NULL, NULL, 0, '2019-06-10', 'asdfsadf', 1, 3, 101, 1, 2, 1, 2, 0, '2019-05-18 00:32:43', '2019-07-12 16:43:05'),
(70, 10, 'محمد', 'الماجد', 'mohammed.almajed.1987@gmail.com', '966', '543644494', NULL, NULL, NULL, NULL, 1, '2019-05-23', 'cmcaskl', 0, 1, 191, 0, 3, 1, 2, 0, '2019-05-31 22:04:25', '2019-05-31 22:06:01'),
(71, 10, 'Kandarp1', 'Pandya1', 'kandarp.d9ithub@gmail.com1', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986091', 1, '1992-02-15', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(72, 10, 'Kandarp2', 'Pandya2', 'kandarp.d9ithub@gmail.com2', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986092', 1, '1992-02-16', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(73, 10, 'Kandarp3', 'Pandya3', 'kandarp.d9ithub@gmail.com3', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986093', 1, '1992-02-17', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(74, 10, 'Kandarp4', 'Pandya4', 'kandarp.d9ithub@gmail.com4', '966', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986094', 0, '1992-02-18', 'tesing data', 1, 18, NULL, 1, 2, 0, 2, 0, '2019-06-11 18:03:40', '2019-07-09 16:03:26'),
(75, 10, 'Kandarp5', 'Pandya5', 'kandarp.d9ithub@gmail.com5', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986095', 1, '1992-02-19', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(76, 10, 'Kandarp6', 'Pandya6', 'kandarp.d9ithub@gmail.com6', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986096', 1, '1992-02-20', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(77, 10, 'Kandarp7', 'Pandya7', 'kandarp.d9ithub@gmail.com7', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986097', 1, '1992-02-21', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(78, 10, 'Kandarp8', 'Pandya8', 'kandarp.d9ithub@gmail.com8', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986098', 1, '1992-02-22', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(79, 10, 'Kandarp9', 'Pandya9', 'kandarp.d9ithub@gmail.com9', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986099', 1, '1992-02-23', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(80, 10, 'Kandarp10', 'Pandya10', 'kandarp.d9ithub@gmail.com10', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986100', 1, '1992-02-24', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(81, 10, 'Kandarp11', 'Pandya11', 'kandarp.d9ithub@gmail.com11', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986101', 1, '1992-02-25', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(82, 10, 'Kandarp12', 'Pandya12', 'kandarp.d9ithub@gmail.com12', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986102', 1, '1992-02-26', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(83, 10, 'Kandarp13', 'Pandya13', 'kandarp.d9ithub@gmail.com13', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986103', 1, '1992-02-27', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(84, 10, 'Kandarp14', 'Pandya14', 'kandarp.d9ithub@gmail.com14', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986104', 1, '1992-02-28', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(85, 10, 'Kandarp15', 'Pandya15', 'kandarp.d9ithub@gmail.com15', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986105', 1, '1992-02-29', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(86, 10, 'Kandarp16', 'Pandya16', 'kandarp.d9ithub@gmail.com16', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986106', 1, '1992-02-30', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(87, 10, 'Kandarp17', 'Pandya17', 'kandarp.d9ithub@gmail.com17', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986107', 1, '1992-02-31', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(88, 10, 'Kandarp18', 'Pandya18', 'kandarp.d9ithub@gmail.com18', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986108', 1, '1992-02-32', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(89, 10, 'Kandarp19', 'Pandya19', 'kandarp.d9ithub@gmail.com19', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986109', 1, '1992-02-33', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(90, 10, 'Kandarp20', 'Pandya20', 'kandarp.d9ithub@gmail.com20', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986110', 1, '1992-02-34', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(91, 10, 'Kandarp21', 'Pandya21', 'kandarp.d9ithub@gmail.com21', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986111', 1, '1992-02-35', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(92, 10, 'Kandarp22', 'Pandya22', 'kandarp.d9ithub@gmail.com22', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986112', 1, '1992-02-36', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(93, 10, 'Kandarp23', 'Pandya23', 'kandarp.d9ithub@gmail.com23', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986113', 1, '1992-02-37', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(94, 10, 'Kandarp24', 'Pandya24', 'kandarp.d9ithub@gmail.com24', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986114', 1, '1992-02-38', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(95, 10, 'Kandarp25', 'Pandya25', 'kandarp.d9ithub@gmail.com25', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986115', 1, '1992-02-39', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(96, 10, 'Kandarp26', 'Pandya26', 'kandarp.d9ithub@gmail.com26', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986116', 1, '1992-02-40', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(97, 10, 'Kandarp27', 'Pandya27', 'kandarp.d9ithub@gmail.com27', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986117', 1, '1992-02-41', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(98, 10, 'Kandarp28', 'Pandya28', 'kandarp.d9ithub@gmail.com28', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986118', 1, '1992-02-42', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(99, 10, 'Kandarp29', 'Pandya29', 'kandarp.d9ithub@gmail.com29', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986119', 1, '1992-02-43', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(100, 10, 'Kandarp30', 'Pandya30', 'kandarp.d9ithub@gmail.com30', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986120', 1, '1992-02-44', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(101, 10, 'Kandarp31', 'Pandya31', 'kandarp.d9ithub@gmail.com31', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986121', 1, '1992-02-45', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(102, 10, 'Kandarp32', 'Pandya32', 'kandarp.d9ithub@gmail.com32', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986122', 1, '1992-02-46', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(103, 10, 'Kandarp33', 'Pandya33', 'kandarp.d9ithub@gmail.com33', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986123', 1, '1992-02-47', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(104, 10, 'Kandarp34', 'Pandya34', 'kandarp.d9ithub@gmail.com34', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986124', 1, '1992-02-48', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(105, 10, 'Kandarp35', 'Pandya35', 'kandarp.d9ithub@gmail.com35', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986125', 1, '1992-02-49', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(106, 10, 'Kandarp36', 'Pandya36', 'kandarp.d9ithub@gmail.com36', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986126', 1, '1992-02-50', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(107, 10, 'Kandarp37', 'Pandya37', 'kandarp.d9ithub@gmail.com37', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986127', 1, '1992-02-51', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(108, 10, 'Kandarp38', 'Pandya38', 'kandarp.d9ithub@gmail.com38', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986128', 1, '1992-02-52', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(109, 10, 'Kandarp39', 'Pandya39', 'kandarp.d9ithub@gmail.com39', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986129', 1, '1992-02-53', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(110, 10, 'Kandarp40', 'Pandya40', 'kandarp.d9ithub@gmail.com40', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986130', 1, '1992-02-54', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(111, 10, 'Kandarp41', 'Pandya41', 'kandarp.d9ithub@gmail.com41', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986131', 1, '1992-02-55', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(112, 10, 'Kandarp42', 'Pandya42', 'kandarp.d9ithub@gmail.com42', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986132', 1, '1992-02-56', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(113, 10, 'Kandarp43', 'Pandya43', 'kandarp.d9ithub@gmail.com43', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986133', 1, '1992-02-57', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(114, 10, 'Kandarp44', 'Pandya44', 'kandarp.d9ithub@gmail.com44', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986134', 1, '1992-02-58', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(115, 10, 'Kandarp45', 'Pandya45', 'kandarp.d9ithub@gmail.com45', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986135', 1, '1992-02-59', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(116, 10, 'Kandarp46', 'Pandya46', 'kandarp.d9ithub@gmail.com46', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986136', 1, '1992-02-60', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(117, 10, 'Kandarp47', 'Pandya47', 'kandarp.d9ithub@gmail.com47', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986137', 1, '1992-02-61', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(118, 10, 'Kandarp48', 'Pandya48', 'kandarp.d9ithub@gmail.com48', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986138', 1, '1992-02-62', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:40', '2019-06-11 18:03:40'),
(119, 10, 'Kandarp49', 'Pandya49', 'kandarp.d9ithub@gmail.com49', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986139', 1, '1992-02-63', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(120, 10, 'Kandarp50', 'Pandya50', 'kandarp.d9ithub@gmail.com50', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986140', 1, '1992-02-64', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(121, 10, 'Kandarp51', 'Pandya51', 'kandarp.d9ithub@gmail.com51', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986141', 1, '1992-02-65', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(122, 10, 'Kandarp52', 'Pandya52', 'kandarp.d9ithub@gmail.com52', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986142', 1, '1992-02-66', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(123, 10, 'Kandarp53', 'Pandya53', 'kandarp.d9ithub@gmail.com53', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986143', 1, '1992-02-67', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(124, 10, 'Kandarp54', 'Pandya54', 'kandarp.d9ithub@gmail.com54', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986144', 1, '1992-02-68', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(125, 10, 'Kandarp55', 'Pandya55', 'kandarp.d9ithub@gmail.com55', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986145', 1, '1992-02-69', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(126, 10, 'Kandarp56', 'Pandya56', 'kandarp.d9ithub@gmail.com56', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986146', 1, '1992-02-70', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(127, 10, 'Kandarp57', 'Pandya57', 'kandarp.d9ithub@gmail.com57', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986147', 1, '1992-02-71', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(128, 10, 'Kandarp58', 'Pandya58', 'kandarp.d9ithub@gmail.com58', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986148', 1, '1992-02-72', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(129, 10, 'Kandarp59', 'Pandya59', 'kandarp.d9ithub@gmail.com59', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986149', 1, '1992-02-73', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(130, 10, 'Kandarp60', 'Pandya60', 'kandarp.d9ithub@gmail.com60', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986150', 1, '1992-02-74', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(131, 10, 'Kandarp61', 'Pandya61', 'kandarp.d9ithub@gmail.com61', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986151', 1, '1992-02-75', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(132, 10, 'Kandarp62', 'Pandya62', 'kandarp.d9ithub@gmail.com62', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986152', 1, '1992-02-76', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(133, 10, 'Kandarp63', 'Pandya63', 'kandarp.d9ithub@gmail.com63', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986153', 1, '1992-02-77', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(134, 10, 'Kandarp64', 'Pandya64', 'kandarp.d9ithub@gmail.com64', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986154', 1, '1992-02-78', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(135, 10, 'Kandarp65', 'Pandya65', 'kandarp.d9ithub@gmail.com65', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986155', 1, '1992-02-79', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(136, 10, 'Kandarp66', 'Pandya66', 'kandarp.d9ithub@gmail.com66', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986156', 1, '1992-02-80', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(137, 10, 'Kandarp67', 'Pandya67', 'kandarp.d9ithub@gmail.com67', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986157', 1, '1992-02-81', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(138, 10, 'Kandarp68', 'Pandya68', 'kandarp.d9ithub@gmail.com68', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986158', 1, '1992-02-82', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(139, 10, 'Kandarp69', 'Pandya69', 'kandarp.d9ithub@gmail.com69', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986159', 1, '1992-02-83', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(140, 10, 'Kandarp70', 'Pandya70', 'kandarp.d9ithub@gmail.com70', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986160', 1, '1992-02-84', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(141, 10, 'Kandarp71', 'Pandya71', 'kandarp.d9ithub@gmail.com71', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986161', 1, '1992-02-85', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(142, 10, 'Kandarp72', 'Pandya72', 'kandarp.d9ithub@gmail.com72', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986162', 1, '1992-02-86', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(143, 10, 'Kandarp73', 'Pandya73', 'kandarp.d9ithub@gmail.com73', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986163', 1, '1992-02-87', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(144, 10, 'Kandarp74', 'Pandya74', 'kandarp.d9ithub@gmail.com74', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986164', 1, '1992-02-88', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(145, 10, 'Kandarp75', 'Pandya75', 'kandarp.d9ithub@gmail.com75', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986165', 1, '1992-02-89', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(146, 10, 'Kandarp76', 'Pandya76', 'kandarp.d9ithub@gmail.com76', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986166', 1, '1992-02-90', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(147, 10, 'Kandarp77', 'Pandya77', 'kandarp.d9ithub@gmail.com77', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986167', 1, '1992-02-91', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(148, 10, 'Kandarp78', 'Pandya78', 'kandarp.d9ithub@gmail.com78', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986168', 1, '1992-02-92', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(149, 10, 'Kandarp79', 'Pandya79', 'kandarp.d9ithub@gmail.com79', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986169', 1, '1992-02-93', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(150, 10, 'Kandarp80', 'Pandya80', 'kandarp.d9ithub@gmail.com80', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986170', 1, '1992-02-94', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(151, 10, 'Kandarp81', 'Pandya81', 'kandarp.d9ithub@gmail.com81', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986171', 1, '1992-02-95', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(152, 10, 'Kandarp82', 'Pandya82', 'kandarp.d9ithub@gmail.com82', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986172', 1, '1992-02-96', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(153, 10, 'Kandarp83', 'Pandya83', 'kandarp.d9ithub@gmail.com83', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986173', 1, '1992-02-97', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(154, 10, 'Kandarp84', 'Pandya84', 'kandarp.d9ithub@gmail.com84', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986174', 1, '1992-02-98', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(155, 10, 'Kandarp85', 'Pandya85', 'kandarp.d9ithub@gmail.com85', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986175', 1, '1992-02-99', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(156, 10, 'Kandarp86', 'Pandya86', 'kandarp.d9ithub@gmail.com86', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986176', 1, '1992-02-100', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(157, 10, 'Kandarp87', 'Pandya87', 'kandarp.d9ithub@gmail.com87', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986177', 1, '1992-02-101', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(158, 10, 'Kandarp88', 'Pandya88', 'kandarp.d9ithub@gmail.com88', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986178', 1, '1992-02-102', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(159, 10, 'Kandarp89', 'Pandya89', 'kandarp.d9ithub@gmail.com89', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986179', 1, '1992-02-103', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(160, 10, 'Kandarp90', 'Pandya90', 'kandarp.d9ithub@gmail.com90', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986180', 1, '1992-02-104', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(161, 10, 'Kandarp91', 'Pandya91', 'kandarp.d9ithub@gmail.com91', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986181', 1, '1992-02-105', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(162, 10, 'Kandarp92', 'Pandya92', 'kandarp.d9ithub@gmail.com92', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986182', 1, '1992-02-106', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(163, 10, 'Kandarp93', 'Pandya93', 'kandarp.d9ithub@gmail.com93', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986183', 1, '1992-02-107', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(164, 10, 'Kandarp94', 'Pandya94', 'kandarp.d9ithub@gmail.com94', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986184', 1, '1992-02-108', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(165, 10, 'Kandarp95', 'Pandya95', 'kandarp.d9ithub@gmail.com95', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986185', 1, '1992-02-109', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(166, 10, 'Kandarp96', 'Pandya96', 'kandarp.d9ithub@gmail.com96', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986186', 1, '1992-02-110', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(167, 10, 'Kandarp97', 'Pandya97', 'kandarp.d9ithub@gmail.com97', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986187', 1, '1992-02-111', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(168, 10, 'Kandarp98', 'Pandya98', 'kandarp.d9ithub@gmail.com98', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986188', 1, '1992-02-112', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(169, 10, 'Kandarp99', 'Pandya99', 'kandarp.d9ithub@gmail.com99', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986189', 1, '1992-02-113', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(170, 10, 'Kandarp100', 'Pandya100', 'kandarp.d9ithub@gmail.com100', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986190', 1, '1992-02-114', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(171, 10, 'Kandarp101', 'Pandya101', 'kandarp.d9ithub@gmail.com101', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986191', 1, '1992-02-115', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(172, 10, 'Kandarp102', 'Pandya102', 'kandarp.d9ithub@gmail.com102', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986192', 1, '1992-02-116', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(173, 10, 'Kandarp103', 'Pandya103', 'kandarp.d9ithub@gmail.com103', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986193', 1, '1992-02-117', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(174, 10, 'Kandarp104', 'Pandya104', 'kandarp.d9ithub@gmail.com104', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986194', 1, '1992-02-118', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(175, 10, 'Kandarp105', 'Pandya105', 'kandarp.d9ithub@gmail.com105', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986195', 1, '1992-02-119', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(176, 10, 'Kandarp106', 'Pandya106', 'kandarp.d9ithub@gmail.com106', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986196', 1, '1992-02-120', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(177, 10, 'Kandarp107', 'Pandya107', 'kandarp.d9ithub@gmail.com107', '971', '9427986091', 'Kandarp', 'Pandya', 'kandarp.d9ithub@gmail.com', '9427986197', 1, '1992-02-121', 'tesing data', 1, 3, 971, 1, 2, 0, 1, 0, '2019-06-11 18:03:41', '2019-06-11 18:03:41'),
(178, 10, 'amit', 'solanki', 'amit.d9ithub@gmail.com', '91', '65488754', 'amit', 'solanki', 'amit.d9ithub@gmail.com', '97654654', 0, '2019-06-10', 'tedst', 1, 3, 101, 1, 2, 1, 2, 0, '2019-06-12 09:29:09', '2019-06-17 11:42:39'),
(179, 1, NULL, 'solanki', NULL, '91', '9876546', NULL, NULL, NULL, NULL, NULL, '2000-25-25', NULL, 1, NULL, 101, NULL, 2, 1, 1, 0, '2019-06-21 05:06:56', '2019-06-21 05:06:56'),
(180, 10, NULL, NULL, NULL, '966', '4564665646665', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 191, NULL, NULL, 1, 1, 0, '2019-07-12 16:35:37', '2019-07-12 16:35:37'),
(181, 10, NULL, NULL, NULL, '966', '456456465', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 191, NULL, NULL, 1, 1, 0, '2019-07-12 16:39:28', '2019-07-12 16:39:28'),
(182, 10, 'Rushi', 'Purohit', 'rushi.d9ithub@gmail.com', '51', '787987987979797', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 172, NULL, NULL, 1, 1, 0, '2019-07-12 16:42:49', '2019-07-12 16:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quick_add_setting`
--

CREATE TABLE `tbl_quick_add_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `location` varchar(32) DEFAULT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `dob` varchar(32) DEFAULT NULL,
  `gender` varchar(32) DEFAULT NULL,
  `category` varchar(32) DEFAULT NULL,
  `sub_category` varchar(32) DEFAULT NULL,
  `group` varchar(32) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `comment` varchar(32) DEFAULT NULL,
  `quick_add_button` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_quick_add_setting`
--

INSERT INTO `tbl_quick_add_setting` (`id`, `name`, `first_name`, `last_name`, `email`, `location`, `mobile`, `dob`, `gender`, `category`, `sub_category`, `group`, `type`, `comment`, `quick_add_button`, `created_at`, `updated_at`) VALUES
(1, NULL, '1', '1', '1', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-16 04:59:41', '2019-09-18 11:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(11) NOT NULL,
  `schedule_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `schedule_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_of_times` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fitler_select_type_id` int(11) NOT NULL,
  `fitler_group_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `filter_category_id` int(11) NOT NULL,
  `filter_sub_category_id` int(11) NOT NULL,
  `filter_location_id` int(11) NOT NULL,
  `filter_gender` int(11) NOT NULL,
  `filter_search_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `survey_form_id` int(11) NOT NULL,
  `survey_sendto_method` int(11) NOT NULL,
  `survey_email_sms_sending_method` int(11) NOT NULL,
  `survey_template_type` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1 COMMENT '''1'':''Active'',''2'':''In-Active''',
  `send_all` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `schedule_title`, `schedule_type`, `schedule_date`, `end_date`, `schedule_time`, `number_of_times`, `fitler_select_type_id`, `fitler_group_id`, `user_id`, `filter_category_id`, `filter_sub_category_id`, `filter_location_id`, `filter_gender`, `filter_search_value`, `survey_form_id`, `survey_sendto_method`, `survey_email_sms_sending_method`, `survey_template_type`, `status`, `send_all`, `created_at`, `updated_at`) VALUES
(1, 'My First Schedule', 'halfyearly', '2018-07-27', NULL, '4:45 PM', NULL, 0, 0, NULL, 0, 0, 0, 0, '', 12, 2, 1, 4, 2, 0, '2018-07-30 15:13:03', '2018-09-09 05:36:38'),
(2, 'My Second Schedule', 'annually', '2018-07-27', NULL, '4:45 PM', NULL, 0, 0, NULL, 0, 0, 0, 0, '', 13, 2, 1, 4, 2, 0, '2018-07-30 13:07:19', '2018-09-09 05:36:35'),
(3, 'test2', 'one_time', '2018-09-07', NULL, '12:20 PM', NULL, 0, 0, NULL, 0, 0, 0, 0, '', 0, 2, 1, 12, 2, 0, '2018-09-07 06:47:35', '2018-09-09 05:36:32'),
(4, 'test3', 'one_time', '2018-09-07', NULL, '12:20 PM', NULL, 0, 0, NULL, 0, 0, 0, 0, '', 0, 2, 2, 7, 2, 0, '2018-09-07 06:48:44', '2018-09-09 05:36:29'),
(5, 'TEST22', 'one_time', '2018-09-07', NULL, '8:15 PM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 6, 2, 0, '2018-09-07 14:09:25', '2018-09-09 05:36:24'),
(6, 'Test Schdeule ', 'monthly', '2038-03-09', '2019-01-30', '10:00 AM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 16, 1, 1, '2018-09-09 05:38:13', '2019-02-04 13:49:55'),
(7, 'Hourly', 'hourly', '2018-09-12', NULL, '02:44 PM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 7, 1, 0, '2018-09-12 07:03:24', '2018-09-12 11:45:18'),
(8, 'newa', 'hourly', '2018-09-12', NULL, '4:18 PM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 7, 1, 0, '2018-09-12 11:07:23', '2018-09-12 13:16:01'),
(9, 'test', 'hourly', '2018-09-12', NULL, '4:17 PM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 8, 1, 0, '2018-09-12 12:16:06', '2018-09-12 13:15:53'),
(10, 'Kandarp Pandya', 'one_time', '2019-01-29', NULL, '11:38 AM', NULL, 3, 3, 10, 20, 3, 101, 2, '9427986091', 0, 2, 1, 1, 1, 0, '2019-01-29 05:50:08', '2019-01-29 06:08:28'),
(11, 'teststsett', 'hourly', '2019-01-29', NULL, '11:42 AM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 4, 1, 0, '2019-01-29 06:10:40', '2019-01-29 06:10:40'),
(12, 'dsgsgsdf', 'one_time', '2019-01-29', NULL, '03:50 PM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 14, 2, 0, '2019-01-29 06:56:56', '2019-02-01 05:18:56'),
(13, 'testsststetetsetset', 'hourly', '2019-01-29', NULL, '02:58 PM', NULL, 2, 3, 10, 1, 3, 101, 1, '', 0, 2, 1, 13, 2, 0, '2019-01-29 09:22:24', '2019-02-01 05:18:51'),
(14, '30jan2019', 'hourly', '2019-01-30', NULL, '10:30 AM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 13, 2, 0, '2019-01-30 04:56:06', '2019-02-01 05:18:42'),
(15, 'klags', 'hourly', '2019-02-13', '2019-02-15', '02:40 PM', '3', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 1, '2019-01-30 06:42:33', '2019-02-01 05:18:37'),
(16, 'jhjkh', 'hourly', '2019-01-30', '2019-01-31', '03:15 PM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 1, '2019-01-30 09:38:57', '2019-02-01 05:18:35'),
(17, 'ghjkhjgh', 'hourly', '2019-01-30', '2019-02-01', '03:10 PM', '3', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 1, '2019-01-30 09:40:27', '2019-02-01 05:18:34'),
(18, 'fdgdfg', 'hourly', '2019-01-29', '2019-02-07', '03:11 PM', '3', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 1, '2019-01-30 09:41:51', '2019-02-01 05:18:31'),
(19, 'sdfsf', 'hourly', '2019-01-30', '2019-02-01', '03:12 PM', '3', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 0, '2019-01-30 09:42:35', '2019-02-01 05:18:29'),
(20, 'fhgfgh', 'hourly', '2019-01-30', '2019-01-31', '03:26 PM', '5', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 1, '2019-01-30 09:56:26', '2019-02-01 05:18:26'),
(21, 'tets', 'hourly', '2019-01-30', '2019-01-31', '04:15 PM', '6', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 1, '2019-01-30 11:32:18', '2019-07-12 04:16:21'),
(22, 'schedule', 'hourly', '2019-01-30', '2019-02-07', '05:03 PM', '6', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 1, '2019-01-30 11:34:09', '2019-02-01 05:18:24'),
(23, 'test', 'hourly', '2019-01-31', '2019-02-07', '09:47 AM', '5', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 1, 18, 2, 0, '2019-01-31 04:20:40', '2019-02-01 05:18:22'),
(24, 'sdfdsf', 'hourly', '2019-02-09', '2019-02-09', '10:40 AM', '1', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 12, 1, 0, '2019-02-01 05:10:48', '2019-02-01 05:10:48'),
(25, 'tyrt', 'monthly', '2024-04-01', '2019-02-01', '04:02 PM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 12, 1, 0, '2019-02-01 05:29:54', '2019-02-04 13:49:55'),
(26, 'yoyo', 'monthly', '2021-10-01', '2019-02-01', '05:55 PM', '10', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 10, 1, 0, '2019-02-01 10:37:04', '2019-02-04 13:49:55'),
(27, 'tsetset', 'hourly', '2019-02-05', '2019-02-09', '06:04 PM', '10', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 12, 1, 0, '2019-02-04 10:53:09', '2019-02-05 11:34:56'),
(28, 'teststtets', 'hourly', '2019-04-26', '2019-04-27', '11:47 AM', NULL, 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 11, 1, 1, '2019-04-26 05:15:30', '2019-04-26 05:17:10'),
(29, 'testsetsetstsetse', 'hourly', '2019-04-26', '2019-04-30', '05:47 PM', '5', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 5, 1, 1, '2019-04-26 11:15:03', '2019-07-09 12:22:03'),
(30, 'now', 'hourly', '2019-05-31', '2019-06-05', '03:08 PM', '3', 0, 0, 10, 0, 0, 0, 0, '', 0, 2, 2, 8, 1, 0, '2019-05-31 09:40:10', '2019-07-12 06:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scheduled_participant`
--

CREATE TABLE `tbl_scheduled_participant` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1 COMMENT '''1'':''active'',''2'':''Inactive''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_scheduled_participant`
--

INSERT INTO `tbl_scheduled_participant` (`id`, `schedule_id`, `participant_id`, `status`, `created_at`, `updated_at`) VALUES
(140, 2, 8, 1, '2018-07-24 11:17:22', '2018-07-24 11:17:22'),
(139, 2, 5, 1, '2018-07-24 11:17:22', '2018-07-24 11:17:22'),
(136, 1, 11, 1, '2018-07-21 10:49:55', '2018-07-21 10:49:55'),
(135, 1, 10, 1, '2018-07-21 10:49:55', '2018-07-21 10:49:55'),
(134, 1, 9, 1, '2018-07-21 10:49:55', '2018-07-21 10:49:55'),
(133, 1, 8, 1, '2018-07-21 10:49:55', '2018-07-21 10:49:55'),
(132, 1, 5, 1, '2018-07-21 10:49:55', '2018-07-21 10:49:55'),
(131, 1, 4, 1, '2018-07-21 10:49:55', '2018-07-21 10:49:55'),
(141, 2, 3, 1, '2018-07-24 11:17:22', '2018-07-24 11:17:22'),
(147, 3, 13, 1, '2018-09-07 06:49:30', '2018-09-07 06:49:30'),
(143, 4, 13, 1, '2018-09-07 06:48:44', '2018-09-07 06:48:44'),
(144, 4, 27, 1, '2018-09-07 06:48:44', '2018-09-07 06:48:44'),
(145, 4, 13, 1, '2018-09-07 06:48:44', '2018-09-07 06:48:44'),
(146, 4, 14, 1, '2018-09-07 06:48:44', '2018-09-07 06:48:44'),
(148, 3, 14, 1, '2018-09-07 06:49:30', '2018-09-07 06:49:30'),
(149, 3, 27, 1, '2018-09-07 06:49:30', '2018-09-07 06:49:30'),
(150, 5, 13, 1, '2018-09-07 14:09:25', '2018-09-07 14:09:25'),
(187, 21, 62, 1, '2019-01-30 11:32:18', '2019-01-30 11:32:18'),
(186, 21, 61, 1, '2019-01-30 11:32:18', '2019-01-30 11:32:18'),
(185, 19, 61, 1, '2019-01-30 09:42:35', '2019-01-30 09:42:35'),
(163, 7, 13, 1, '2018-09-12 11:26:22', '2018-09-12 11:26:22'),
(164, 8, 13, 1, '2018-09-12 11:46:18', '2018-09-12 11:46:18'),
(166, 9, 13, 1, '2018-09-12 12:16:37', '2018-09-12 12:16:37'),
(168, 10, 61, 1, '2019-01-29 06:04:25', '2019-01-29 06:04:25'),
(169, 11, 61, 1, '2019-01-29 06:10:40', '2019-01-29 06:10:40'),
(171, 12, 61, 1, '2019-01-29 09:03:39', '2019-01-29 09:03:39'),
(172, 13, 61, 1, '2019-01-29 09:22:24', '2019-01-29 09:22:24'),
(173, 14, 61, 1, '2019-01-30 04:56:06', '2019-01-30 04:56:06'),
(184, 15, 61, 1, '2019-01-30 09:37:16', '2019-01-30 09:37:16'),
(188, 22, 61, 1, '2019-01-30 11:34:09', '2019-01-30 11:34:09'),
(189, 22, 62, 1, '2019-01-30 11:34:09', '2019-01-30 11:34:09'),
(190, 23, 61, 1, '2019-01-31 04:20:41', '2019-01-31 04:20:41'),
(191, 24, 61, 1, '2019-02-01 05:10:48', '2019-02-01 05:10:48'),
(198, 25, 61, 1, '2019-02-01 12:15:14', '2019-02-01 12:15:14'),
(200, 26, 61, 1, '2019-02-01 12:18:22', '2019-02-01 12:18:22'),
(206, 27, 61, 1, '2019-02-05 11:34:54', '2019-02-05 11:34:54'),
(207, 28, 66, 1, '2019-04-26 05:15:30', '2019-04-26 05:15:30'),
(208, 28, 67, 1, '2019-04-26 05:15:30', '2019-04-26 05:15:30'),
(209, 29, 66, 1, '2019-04-26 11:15:03', '2019-04-26 11:15:03'),
(210, 29, 67, 1, '2019-04-26 11:15:03', '2019-04-26 11:15:03'),
(213, 30, 70, 1, '2019-07-12 06:48:46', '2019-07-12 06:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_count`
--

CREATE TABLE `tbl_schedule_count` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_At` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schedule_count`
--

INSERT INTO `tbl_schedule_count` (`id`, `schedule_id`, `participant_id`, `created_at`, `updated_At`) VALUES
(1, 24, 61, '2019-02-01 12:57:08', NULL),
(2, 24, 61, '2019-02-01 12:57:51', NULL),
(3, 26, 61, '2019-02-01 12:57:52', NULL),
(4, 24, 61, '2019-02-01 12:57:59', NULL),
(5, 26, 61, '2019-02-01 12:57:59', NULL),
(6, 24, 61, '2019-02-01 12:58:06', NULL),
(7, 26, 61, '2019-02-01 12:58:06', NULL),
(8, 24, 61, '2019-02-01 12:58:15', NULL),
(9, 26, 61, '2019-02-01 12:58:15', NULL),
(10, 26, 61, '2019-02-01 13:00:09', NULL),
(11, 26, 61, '2019-02-01 13:00:18', NULL),
(12, 26, 61, '2019-02-01 13:04:32', NULL),
(13, 26, 61, '2019-02-01 13:04:46', NULL),
(14, 26, 61, '2019-02-01 13:05:01', NULL),
(15, 26, 61, '2019-02-01 13:05:12', NULL),
(16, 27, 61, '2019-02-04 11:09:44', NULL),
(17, 27, 61, '2019-02-04 11:10:15', NULL),
(18, 27, 61, '2019-02-04 11:11:02', NULL),
(19, 27, 61, '2019-02-04 12:18:01', NULL),
(20, 27, 61, '2019-02-04 12:20:55', NULL),
(21, 27, 61, '2019-02-05 10:26:33', NULL),
(22, 27, 61, '2019-02-05 11:26:02', NULL),
(23, 27, 61, '2019-02-05 11:33:17', NULL),
(24, 27, 61, '2019-02-05 11:34:56', NULL),
(25, 29, 67, '2019-04-26 11:17:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_reminder`
--

CREATE TABLE `tbl_schedule_reminder` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `reminder_type_id` int(11) NOT NULL,
  `reminder_template_id` int(11) NOT NULL,
  `rotation_number` int(11) NOT NULL,
  `rotation_type` int(11) NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_schedule_reminder`
--

INSERT INTO `tbl_schedule_reminder` (`id`, `schedule_id`, `reminder_type_id`, `reminder_template_id`, `rotation_number`, `rotation_type`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 3, 4, NULL, '2019-02-06 18:30:00', '2019-01-30 04:58:47'),
(3, 2, 1, 8, 9, 2, NULL, '2018-07-30 06:00:00', '2018-08-16 06:00:00'),
(4, 6, 2, 7, 5, 1, NULL, '2018-09-14 06:00:00', '2018-09-12 21:00:04'),
(5, 12, 1, 13, 10, 8, NULL, '2019-01-28 18:30:00', '2019-01-28 18:30:00'),
(6, 13, 1, 16, 3, 1, '2019-01-31', '2019-01-28 18:30:00', '2019-01-29 18:30:00'),
(7, 14, 1, 17, 3, 8, NULL, '2019-01-29 18:30:00', '2019-01-29 18:30:00'),
(8, 30, 2, 7, 6, 8, NULL, '2019-05-31 07:00:00', '2019-05-31 09:40:44'),
(9, 29, 2, 7, 8, 8, NULL, '2019-07-09 05:00:00', '2019-07-09 12:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_reminder_count`
--

CREATE TABLE `tbl_schedule_reminder_count` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_schedule_reminder_count`
--

INSERT INTO `tbl_schedule_reminder_count` (`id`, `schedule_id`, `participant_id`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '2018-08-04 15:34:02', '2018-08-04 15:34:02'),
(2, 1, 8, '2018-08-04 15:34:02', '2018-08-04 15:34:02'),
(3, 1, 5, '2018-08-04 15:34:02', '2018-08-04 15:34:02'),
(4, 1, 4, '2018-08-04 15:34:03', '2018-08-04 15:34:03'),
(5, 1, 10, '2018-08-08 21:00:04', '2018-08-08 21:00:04'),
(6, 1, 8, '2018-08-08 21:00:04', '2018-08-08 21:00:04'),
(7, 1, 5, '2018-08-08 21:00:05', '2018-08-08 21:00:05'),
(8, 1, 4, '2018-08-08 21:00:05', '2018-08-08 21:00:05'),
(9, 4, 14, '2018-09-09 05:51:03', '2018-09-09 05:51:03'),
(10, 4, 13, '2018-09-09 05:51:03', '2018-09-09 05:51:03'),
(11, 4, 27, '2018-09-09 05:51:04', '2018-09-09 05:51:04'),
(12, 4, 13, '2018-09-09 05:51:05', '2018-09-09 05:51:05'),
(13, 4, 14, '2018-09-09 21:00:04', '2018-09-09 21:00:04'),
(14, 4, 13, '2018-09-09 21:00:05', '2018-09-09 21:00:05'),
(15, 4, 27, '2018-09-09 21:00:06', '2018-09-09 21:00:06'),
(16, 4, 13, '2018-09-09 21:00:06', '2018-09-09 21:00:06'),
(17, 4, 14, '2018-09-10 21:00:05', '2018-09-10 21:00:05'),
(18, 4, 13, '2018-09-10 21:00:06', '2018-09-10 21:00:06'),
(19, 4, 27, '2018-09-10 21:00:06', '2018-09-10 21:00:06'),
(20, 4, 14, '2018-09-11 21:00:05', '2018-09-11 21:00:05'),
(21, 4, 27, '2018-09-11 21:00:06', '2018-09-11 21:00:06'),
(22, 4, 14, '2018-09-12 21:00:04', '2018-09-12 21:00:04'),
(23, 4, 27, '2018-09-12 21:00:05', '2018-09-12 21:00:05'),
(24, 13, 61, '2019-01-29 11:43:07', '2019-01-29 11:43:07'),
(25, 12, 61, '2019-01-29 11:43:08', '2019-01-29 11:43:08'),
(26, 13, 61, '2019-01-29 12:36:28', '2019-01-29 12:36:28'),
(27, 13, 61, '2019-01-29 12:51:04', '2019-01-29 12:51:04'),
(28, 12, 61, '2019-01-29 12:51:04', '2019-01-29 12:51:04'),
(29, 12, 61, '2019-01-29 12:51:16', '2019-01-29 12:51:16'),
(30, 12, 61, '2019-01-29 12:51:18', '2019-01-29 12:51:18'),
(31, 12, 61, '2019-01-29 12:51:21', '2019-01-29 12:51:21'),
(32, 12, 61, '2019-01-29 12:55:06', '2019-01-29 12:55:06'),
(33, 12, 61, '2019-01-29 12:55:18', '2019-01-29 12:55:18'),
(34, 12, 61, '2019-01-29 12:56:08', '2019-01-29 12:56:08'),
(35, 12, 61, '2019-01-29 14:04:24', '2019-01-29 14:04:24'),
(36, 12, 61, '2019-01-29 14:04:37', '2019-01-29 14:04:37'),
(37, 14, 61, '2019-01-30 04:58:47', '2019-01-30 04:58:47'),
(38, 14, 61, '2019-01-30 05:00:11', '2019-01-30 05:00:11'),
(39, 15, 61, '2019-01-30 13:52:15', '2019-01-30 13:52:15'),
(40, 15, 61, '2019-01-30 13:54:29', '2019-01-30 13:54:29'),
(41, 15, 61, '2019-01-30 13:55:50', '2019-01-30 13:55:50'),
(42, 15, 61, '2019-01-31 04:21:21', '2019-01-31 04:21:21'),
(43, 23, 61, '2019-01-31 04:21:22', '2019-01-31 04:21:22'),
(44, 15, 61, '2019-02-01 04:45:21', '2019-02-01 04:45:22'),
(45, 15, 61, '2019-02-01 04:52:58', '2019-02-01 04:52:58'),
(46, 15, 61, '2019-02-01 04:53:15', '2019-02-01 04:53:15'),
(47, 15, 61, '2019-02-01 04:55:04', '2019-02-01 04:55:04'),
(48, 15, 61, '2019-02-01 05:11:06', '2019-02-01 05:11:06'),
(49, 24, 61, '2019-02-01 05:11:06', '2019-02-01 05:11:06'),
(50, 15, 61, '2019-02-01 05:12:45', '2019-02-01 05:12:45'),
(51, 24, 61, '2019-02-01 05:12:45', '2019-02-01 05:12:45'),
(52, 15, 61, '2019-02-01 05:13:08', '2019-02-01 05:13:08'),
(53, 24, 61, '2019-02-01 05:13:10', '2019-02-01 05:13:10'),
(54, 24, 61, '2019-02-01 05:19:00', '2019-02-01 05:19:00'),
(55, 24, 61, '2019-02-01 05:19:44', '2019-02-01 05:19:44'),
(56, 24, 61, '2019-02-01 05:22:20', '2019-02-01 05:22:20'),
(57, 24, 61, '2019-02-01 05:29:59', '2019-02-01 05:29:59'),
(58, 24, 61, '2019-02-01 05:30:21', '2019-02-01 05:30:21'),
(59, 24, 61, '2019-02-01 05:31:46', '2019-02-01 05:31:46'),
(60, 24, 61, '2019-02-01 05:32:37', '2019-02-01 05:32:37'),
(61, 24, 61, '2019-02-01 05:32:57', '2019-02-01 05:32:57'),
(62, 24, 61, '2019-02-01 05:33:12', '2019-02-01 05:33:12'),
(63, 24, 61, '2019-02-01 05:33:44', '2019-02-01 05:33:44'),
(64, 24, 61, '2019-02-01 05:33:56', '2019-02-01 05:33:56'),
(65, 24, 61, '2019-02-01 05:38:25', '2019-02-01 05:38:25'),
(66, 24, 61, '2019-02-01 06:28:41', '2019-02-01 06:28:41'),
(67, 24, 61, '2019-02-01 06:29:01', '2019-02-01 06:29:01'),
(68, 24, 61, '2019-02-01 08:56:14', '2019-02-01 08:56:14'),
(69, 24, 61, '2019-02-01 08:56:25', '2019-02-01 08:56:25'),
(70, 24, 61, '2019-02-01 08:56:26', '2019-02-01 08:56:26'),
(71, 24, 61, '2019-02-01 09:39:16', '2019-02-01 09:39:16'),
(72, 24, 61, '2019-02-01 09:39:17', '2019-02-01 09:39:17'),
(73, 24, 61, '2019-02-01 09:39:17', '2019-02-01 09:39:17'),
(74, 24, 61, '2019-02-01 09:39:17', '2019-02-01 09:39:17'),
(75, 24, 61, '2019-02-01 09:39:18', '2019-02-01 09:39:18'),
(76, 24, 61, '2019-02-01 09:39:19', '2019-02-01 09:39:19'),
(77, 24, 61, '2019-02-01 10:21:56', '2019-02-01 10:21:56'),
(78, 24, 61, '2019-02-01 10:22:33', '2019-02-01 10:22:33'),
(79, 24, 61, '2019-02-01 10:25:06', '2019-02-01 10:25:06'),
(80, 24, 61, '2019-02-01 10:27:29', '2019-02-01 10:27:29'),
(81, 24, 61, '2019-02-01 10:28:25', '2019-02-01 10:28:25'),
(82, 24, 61, '2019-02-01 10:28:26', '2019-02-01 10:28:26'),
(83, 24, 61, '2019-02-01 10:28:26', '2019-02-01 10:28:26'),
(84, 24, 61, '2019-02-01 10:28:26', '2019-02-01 10:28:26'),
(85, 24, 61, '2019-02-01 10:28:27', '2019-02-01 10:28:27'),
(86, 24, 61, '2019-02-01 10:28:28', '2019-02-01 10:28:28'),
(87, 24, 61, '2019-02-01 10:28:32', '2019-02-01 10:28:32'),
(88, 24, 61, '2019-02-01 10:28:32', '2019-02-01 10:28:32'),
(89, 24, 61, '2019-02-01 10:28:33', '2019-02-01 10:28:33'),
(90, 24, 61, '2019-02-01 10:28:33', '2019-02-01 10:28:33'),
(91, 24, 61, '2019-02-01 10:28:33', '2019-02-01 10:28:33'),
(92, 24, 61, '2019-02-01 10:28:34', '2019-02-01 10:28:34'),
(93, 24, 61, '2019-02-01 10:28:35', '2019-02-01 10:28:35'),
(94, 24, 61, '2019-02-01 10:28:37', '2019-02-01 10:28:37'),
(95, 24, 61, '2019-02-01 10:28:37', '2019-02-01 10:28:37'),
(96, 24, 61, '2019-02-01 10:28:37', '2019-02-01 10:28:37'),
(97, 24, 61, '2019-02-01 10:28:38', '2019-02-01 10:28:38'),
(98, 24, 61, '2019-02-01 10:28:38', '2019-02-01 10:28:38'),
(99, 24, 61, '2019-02-01 10:28:39', '2019-02-01 10:28:39'),
(100, 24, 61, '2019-02-01 10:28:39', '2019-02-01 10:28:39'),
(101, 24, 61, '2019-02-01 10:28:39', '2019-02-01 10:28:39'),
(102, 24, 61, '2019-02-01 10:28:39', '2019-02-01 10:28:39'),
(103, 24, 61, '2019-02-01 10:28:40', '2019-02-01 10:28:40'),
(104, 24, 61, '2019-02-01 10:28:40', '2019-02-01 10:28:40'),
(105, 24, 61, '2019-02-01 10:28:41', '2019-02-01 10:28:41'),
(106, 24, 61, '2019-02-01 10:28:42', '2019-02-01 10:28:42'),
(107, 24, 61, '2019-02-01 10:28:42', '2019-02-01 10:28:42'),
(108, 24, 61, '2019-02-01 10:28:43', '2019-02-01 10:28:43'),
(109, 24, 61, '2019-02-01 10:28:44', '2019-02-01 10:28:44'),
(110, 24, 61, '2019-02-01 10:28:44', '2019-02-01 10:28:44'),
(111, 24, 61, '2019-02-01 10:28:44', '2019-02-01 10:28:44'),
(112, 24, 61, '2019-02-01 10:28:45', '2019-02-01 10:28:45'),
(113, 24, 61, '2019-02-01 10:28:45', '2019-02-01 10:28:45'),
(114, 24, 61, '2019-02-01 10:28:45', '2019-02-01 10:28:45'),
(115, 24, 61, '2019-02-01 10:28:46', '2019-02-01 10:28:46'),
(116, 24, 61, '2019-02-01 10:28:46', '2019-02-01 10:28:46'),
(117, 24, 61, '2019-02-01 10:28:47', '2019-02-01 10:28:47'),
(118, 24, 61, '2019-02-01 10:29:02', '2019-02-01 10:29:02'),
(119, 24, 61, '2019-02-01 10:29:03', '2019-02-01 10:29:03'),
(120, 24, 61, '2019-02-01 10:32:01', '2019-02-01 10:32:01'),
(121, 24, 61, '2019-02-01 10:32:18', '2019-02-01 10:32:18'),
(122, 24, 61, '2019-02-01 10:32:21', '2019-02-01 10:32:21'),
(123, 24, 61, '2019-02-01 10:32:21', '2019-02-01 10:32:21'),
(124, 24, 61, '2019-02-01 10:32:21', '2019-02-01 10:32:21'),
(125, 24, 61, '2019-02-01 10:32:47', '2019-02-01 10:32:47'),
(126, 24, 61, '2019-02-01 10:32:48', '2019-02-01 10:32:48'),
(127, 24, 61, '2019-02-01 10:37:07', '2019-02-01 10:37:07'),
(128, 26, 61, '2019-02-01 10:37:07', '2019-02-01 10:37:07'),
(129, 24, 61, '2019-02-01 10:37:08', '2019-02-01 10:37:08'),
(130, 26, 61, '2019-02-01 10:37:08', '2019-02-01 10:37:08'),
(131, 24, 61, '2019-02-01 10:37:08', '2019-02-01 10:37:08'),
(132, 26, 61, '2019-02-01 10:37:08', '2019-02-01 10:37:08'),
(133, 24, 61, '2019-02-01 10:37:08', '2019-02-01 10:37:08'),
(134, 26, 61, '2019-02-01 10:37:08', '2019-02-01 10:37:08'),
(135, 24, 61, '2019-02-01 10:37:09', '2019-02-01 10:37:09'),
(136, 26, 61, '2019-02-01 10:37:09', '2019-02-01 10:37:09'),
(137, 24, 61, '2019-02-01 10:37:09', '2019-02-01 10:37:09'),
(138, 26, 61, '2019-02-01 10:37:09', '2019-02-01 10:37:09'),
(139, 24, 61, '2019-02-01 10:37:44', '2019-02-01 10:37:44'),
(140, 26, 61, '2019-02-01 10:37:44', '2019-02-01 10:37:44'),
(141, 24, 61, '2019-02-01 10:39:09', '2019-02-01 10:39:09'),
(142, 26, 61, '2019-02-01 10:39:09', '2019-02-01 10:39:09'),
(143, 24, 61, '2019-02-01 10:48:07', '2019-02-01 10:48:07'),
(144, 26, 61, '2019-02-01 10:48:07', '2019-02-01 10:48:07'),
(145, 24, 61, '2019-02-01 10:48:08', '2019-02-01 10:48:08'),
(146, 26, 61, '2019-02-01 10:48:08', '2019-02-01 10:48:08'),
(147, 24, 61, '2019-02-01 10:48:08', '2019-02-01 10:48:08'),
(148, 26, 61, '2019-02-01 10:48:08', '2019-02-01 10:48:08'),
(149, 24, 61, '2019-02-01 10:48:08', '2019-02-01 10:48:08'),
(150, 26, 61, '2019-02-01 10:48:08', '2019-02-01 10:48:08'),
(151, 24, 61, '2019-02-01 10:48:08', '2019-02-01 10:48:08'),
(152, 26, 61, '2019-02-01 10:48:08', '2019-02-01 10:48:08'),
(153, 24, 61, '2019-02-01 10:51:22', '2019-02-01 10:51:22'),
(154, 26, 61, '2019-02-01 10:51:22', '2019-02-01 10:51:22'),
(155, 24, 61, '2019-02-01 10:52:39', '2019-02-01 10:52:39'),
(156, 26, 61, '2019-02-01 10:52:39', '2019-02-01 10:52:39'),
(157, 24, 61, '2019-02-01 10:53:58', '2019-02-01 10:53:58'),
(158, 26, 61, '2019-02-01 10:53:58', '2019-02-01 10:53:58'),
(159, 24, 61, '2019-02-01 10:54:27', '2019-02-01 10:54:27'),
(160, 26, 61, '2019-02-01 10:54:27', '2019-02-01 10:54:27'),
(161, 24, 61, '2019-02-01 11:01:20', '2019-02-01 11:01:20'),
(162, 26, 61, '2019-02-01 11:01:20', '2019-02-01 11:01:20'),
(163, 24, 61, '2019-02-01 11:01:21', '2019-02-01 11:01:21'),
(164, 26, 61, '2019-02-01 11:01:21', '2019-02-01 11:01:21'),
(165, 24, 61, '2019-02-01 11:01:21', '2019-02-01 11:01:21'),
(166, 26, 61, '2019-02-01 11:01:21', '2019-02-01 11:01:21'),
(167, 24, 61, '2019-02-01 11:01:21', '2019-02-01 11:01:21'),
(168, 26, 61, '2019-02-01 11:01:21', '2019-02-01 11:01:21'),
(169, 24, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(170, 26, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(171, 24, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(172, 26, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(173, 24, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(174, 26, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(175, 24, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(176, 26, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(177, 24, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(178, 26, 61, '2019-02-01 11:01:22', '2019-02-01 11:01:22'),
(179, 24, 61, '2019-02-01 11:01:23', '2019-02-01 11:01:23'),
(180, 26, 61, '2019-02-01 11:01:23', '2019-02-01 11:01:23'),
(181, 24, 61, '2019-02-01 11:01:23', '2019-02-01 11:01:23'),
(182, 26, 61, '2019-02-01 11:01:23', '2019-02-01 11:01:23'),
(183, 24, 61, '2019-02-01 12:01:36', '2019-02-01 12:01:36'),
(184, 26, 61, '2019-02-01 12:01:36', '2019-02-01 12:01:36'),
(185, 24, 61, '2019-02-01 12:15:49', '2019-02-01 12:15:49'),
(186, 26, 61, '2019-02-01 12:15:49', '2019-02-01 12:15:49'),
(187, 24, 61, '2019-02-01 12:15:51', '2019-02-01 12:15:51'),
(188, 26, 61, '2019-02-01 12:15:51', '2019-02-01 12:15:51'),
(189, 24, 61, '2019-02-01 12:15:52', '2019-02-01 12:15:52'),
(190, 26, 61, '2019-02-01 12:15:52', '2019-02-01 12:15:52'),
(191, 24, 61, '2019-02-01 12:16:47', '2019-02-01 12:16:47'),
(192, 26, 61, '2019-02-01 12:16:47', '2019-02-01 12:16:47'),
(193, 24, 61, '2019-02-01 12:16:51', '2019-02-01 12:16:51'),
(194, 26, 61, '2019-02-01 12:16:51', '2019-02-01 12:16:51'),
(195, 24, 61, '2019-02-01 12:16:59', '2019-02-01 12:16:59'),
(196, 26, 61, '2019-02-01 12:16:59', '2019-02-01 12:16:59'),
(197, 24, 61, '2019-02-01 12:18:00', '2019-02-01 12:18:00'),
(198, 26, 61, '2019-02-01 12:18:00', '2019-02-01 12:18:00'),
(199, 24, 61, '2019-02-01 12:18:25', '2019-02-01 12:18:25'),
(200, 26, 61, '2019-02-01 12:18:25', '2019-02-01 12:18:25'),
(201, 24, 61, '2019-02-01 12:18:26', '2019-02-01 12:18:26'),
(202, 26, 61, '2019-02-01 12:18:26', '2019-02-01 12:18:26'),
(203, 24, 61, '2019-02-01 12:18:26', '2019-02-01 12:18:26'),
(204, 26, 61, '2019-02-01 12:18:26', '2019-02-01 12:18:26'),
(205, 24, 61, '2019-02-01 12:18:33', '2019-02-01 12:18:33'),
(206, 26, 61, '2019-02-01 12:18:33', '2019-02-01 12:18:33'),
(207, 24, 61, '2019-02-01 12:18:41', '2019-02-01 12:18:41'),
(208, 26, 61, '2019-02-01 12:18:41', '2019-02-01 12:18:41'),
(209, 24, 61, '2019-02-01 12:24:08', '2019-02-01 12:24:08'),
(210, 26, 61, '2019-02-01 12:24:08', '2019-02-01 12:24:08'),
(211, 24, 61, '2019-02-01 12:24:10', '2019-02-01 12:24:10'),
(212, 26, 61, '2019-02-01 12:24:10', '2019-02-01 12:24:10'),
(213, 24, 61, '2019-02-01 12:24:10', '2019-02-01 12:24:10'),
(214, 26, 61, '2019-02-01 12:24:10', '2019-02-01 12:24:10'),
(215, 24, 61, '2019-02-01 12:24:11', '2019-02-01 12:24:11'),
(216, 26, 61, '2019-02-01 12:24:11', '2019-02-01 12:24:11'),
(217, 24, 61, '2019-02-01 12:24:11', '2019-02-01 12:24:11'),
(218, 26, 61, '2019-02-01 12:24:11', '2019-02-01 12:24:11'),
(219, 24, 61, '2019-02-01 12:24:15', '2019-02-01 12:24:15'),
(220, 26, 61, '2019-02-01 12:24:15', '2019-02-01 12:24:15'),
(221, 24, 61, '2019-02-01 12:24:16', '2019-02-01 12:24:16'),
(222, 26, 61, '2019-02-01 12:24:16', '2019-02-01 12:24:16'),
(223, 24, 61, '2019-02-01 12:24:17', '2019-02-01 12:24:17'),
(224, 26, 61, '2019-02-01 12:24:17', '2019-02-01 12:24:17'),
(225, 24, 61, '2019-02-01 12:24:18', '2019-02-01 12:24:18'),
(226, 26, 61, '2019-02-01 12:24:18', '2019-02-01 12:24:18'),
(227, 24, 61, '2019-02-01 12:24:20', '2019-02-01 12:24:20'),
(228, 26, 61, '2019-02-01 12:24:20', '2019-02-01 12:24:20'),
(229, 24, 61, '2019-02-01 12:24:22', '2019-02-01 12:24:22'),
(230, 26, 61, '2019-02-01 12:24:22', '2019-02-01 12:24:22'),
(231, 24, 61, '2019-02-01 12:24:23', '2019-02-01 12:24:23'),
(232, 26, 61, '2019-02-01 12:24:23', '2019-02-01 12:24:23'),
(233, 24, 61, '2019-02-01 12:24:24', '2019-02-01 12:24:24'),
(234, 26, 61, '2019-02-01 12:24:24', '2019-02-01 12:24:24'),
(235, 24, 61, '2019-02-01 12:24:25', '2019-02-01 12:24:25'),
(236, 26, 61, '2019-02-01 12:24:25', '2019-02-01 12:24:25'),
(237, 24, 61, '2019-02-01 12:24:25', '2019-02-01 12:24:25'),
(238, 26, 61, '2019-02-01 12:24:25', '2019-02-01 12:24:25'),
(239, 24, 61, '2019-02-01 12:24:26', '2019-02-01 12:24:26'),
(240, 26, 61, '2019-02-01 12:24:26', '2019-02-01 12:24:26'),
(241, 24, 61, '2019-02-01 12:24:26', '2019-02-01 12:24:26'),
(242, 26, 61, '2019-02-01 12:24:26', '2019-02-01 12:24:26'),
(243, 24, 61, '2019-02-01 12:24:26', '2019-02-01 12:24:26'),
(244, 26, 61, '2019-02-01 12:24:26', '2019-02-01 12:24:26'),
(245, 24, 61, '2019-02-01 12:24:27', '2019-02-01 12:24:27'),
(246, 26, 61, '2019-02-01 12:24:27', '2019-02-01 12:24:27'),
(247, 24, 61, '2019-02-01 12:24:27', '2019-02-01 12:24:27'),
(248, 26, 61, '2019-02-01 12:24:27', '2019-02-01 12:24:27'),
(249, 24, 61, '2019-02-01 12:50:46', '2019-02-01 12:50:46'),
(250, 26, 61, '2019-02-01 12:50:46', '2019-02-01 12:50:46'),
(251, 24, 61, '2019-02-01 12:52:42', '2019-02-01 12:52:42'),
(252, 26, 61, '2019-02-01 12:52:42', '2019-02-01 12:52:42'),
(253, 24, 61, '2019-02-01 12:53:45', '2019-02-01 12:53:45'),
(254, 26, 61, '2019-02-01 12:53:45', '2019-02-01 12:53:45'),
(255, 24, 61, '2019-02-01 12:54:04', '2019-02-01 12:54:04'),
(256, 26, 61, '2019-02-01 12:54:04', '2019-02-01 12:54:04'),
(257, 24, 61, '2019-02-01 12:55:44', '2019-02-01 12:55:44'),
(258, 26, 61, '2019-02-01 12:55:44', '2019-02-01 12:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `setting_value` text CHARACTER SET utf8 NOT NULL,
  `for_setting_type` tinyint(1) NOT NULL COMMENT '1: For SMS Setting, 2: Email Contact us Settings',
  `status` int(1) NOT NULL DEFAULT 1,
  `survey_question_chart` longtext DEFAULT NULL COMMENT 'questionID_chartID',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `setting_key`, `setting_value`, `for_setting_type`, `status`, `survey_question_chart`, `created_at`, `updated_at`) VALUES
(1, 'user_account', '966597424440', 1, 1, NULL, '2018-05-22 11:53:55', '2019-08-16 10:41:33'),
(2, 'user_password', 'mobily@12', 1, 1, NULL, '2018-05-22 11:53:55', '2019-08-16 10:41:33'),
(3, 'sender_id', '0597424440', 1, 1, NULL, '2018-05-22 12:45:41', '2019-08-16 10:41:33'),
(4, 'admin_contact_email', 'admin@mailinator.com', 2, 1, NULL, '2018-05-24 21:36:06', '2019-08-16 10:41:33'),
(5, 'survey_form_id', '2', 0, 1, '219_1,218_1,217_1,216_1,220_1', '2018-08-16 06:00:00', '2019-08-16 10:41:33'),
(6, 'Thankyou_message', 'شكرا عزيزى الفاضل نتمنى لك يوم سعييد لأنك تستاهل', 1, 1, NULL, '2018-09-21 11:51:22', '2019-08-16 10:41:33'),
(7, 'on_behalf_of', '0', 3, 1, NULL, '2019-08-16 04:15:52', '2019-08-16 10:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_template`
--

CREATE TABLE `tbl_sms_template` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_sms_template`
--

INSERT INTO `tbl_sms_template` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'New SMS Template', 'Loreum Ipsum', '2018-05-10 00:00:00', '2018-05-15 07:50:31'),
(3, 'Old SMS Template', 'Hello fdgdfg', '2018-05-11 08:11:03', '2018-05-15 07:50:13'),
(4, 'First SMS Template', 'This is the survey url you have to fill out this\r\nand update us.', '2018-05-11 10:36:21', '2018-08-08 18:46:48'),
(5, 'رسالة مستوى الخدمة', 'نشكر تعاملك معنا و نتمنى ان نكون  عند حسن ضنك\r\nالاستبيان التالي لتجسين اخدمة', '2018-07-06 06:16:23', '2018-07-06 00:46:23'),
(6, '1', 'Hello \r\n\r\nplease take the below survey to help us improve the service\r\n\r\n\r\n\r\nthanks', '2018-08-08 06:05:45', '2018-08-08 12:05:45'),
(7, '3', 'Dear \r\n\r\nplease fill below survey for improving the service \r\n\r\n\r\nthanks', '2018-08-09 07:02:00', '2018-08-09 13:02:00'),
(8, 'مرحبا', 'عميلا العزيز \r\n\r\nنشكر تسوقك معنا و نتمنى ان نكون حصلنا على رضاك . الرجاء تعبئة الأستبيان \r\n\r\nشكرا', '2018-08-09 07:09:44', '2018-08-09 13:09:44'),
(9, 'test2', 'hello (participant_name),\r\n this is test message.\r\nthanks.', '2018-08-21 07:28:28', '2018-08-21 13:28:28'),
(10, 'مرحباي', '(participant_name)  عزيزي العميل \r\n\r\nنشكر تسوقك معنا و نتمنا ان تكون خصلت على تجربة ممتعهة مع الهبي \r\nالرابط تحت عشان عيونك يا قمر', '2018-08-21 08:38:49', '2018-08-21 14:38:49'),
(11, 'test', 'hello (participant_name),\r\nthis is test sms\r\nsurvey 1: - (survey_2)\r\nsurvey 2:- (survey_21)\r\nsurvey 3:- (survey_6)', '2018-08-21 13:50:40', '2018-08-21 20:37:47'),
(12, 'two surveys template', '(participant_name)  مرحبا\r\n\r\nنتمنى ان نكون عند حسن ضنك , كما نرجو دقسقة من وقتك اتقييم الخدمة و مساعدتنا على تطوير تجربتكم \r\n\r\n (survey_7)\r\n\r\nو حال وجود شكوى مستعجلة الرجاء اخبرنا بها على الرابط التالى \r\n\r\n (survey_12)\r\n\r\nشاكرين تعونك معنا', '2018-08-22 13:30:46', '2018-08-22 19:30:46'),
(13, 'قالب شركة الأرجان', '(participant_name) عزيزنا العميل \r\n\r\nنأمل ان تكون تجربتك معنا مثمرة و لاننا في شركة الأرجان تطمح لتطوير و تحسين تجربتك معنا و استمراراك في التعامل معنا. \r\nنود الأخذ من وقتك دقيقة واحدة لتقييم تعاملك معنا على الرابط التالي\r\n(survey_27)\r\n\r\nنشكر وقتك الثمين', '2018-09-05 09:10:05', '2018-09-05 15:10:05'),
(14, 'قالب مركز سماء النخبة', '(participant_name)  المشترك \r\nنشكر حضورك الدورة التدريبية في مركز سماء النخبة \r\n\r\n ونتمنى للأستفادة القصوى من الدورة التدريبية \r\nولأننا نطمح ان نكون الأفضل في تقديم الدورات التدريبية نتمنى سماع ارائكم و تقييم الدورة التدريبية على الرابط التالي \r\n(survey_35)\r\n\r\nنشكر وقتكم الثمين', '2018-09-08 15:39:32', '2018-09-08 21:39:32'),
(15, 'SAMANTC', 'Dear (participant_name) \r\n\r\nthanks , please fill survey\r\n(survey_35)\r\n\r\nWarm Regards\r\nSama NTC Training Center', '2018-09-09 16:38:37', '2018-09-09 22:38:37'),
(16, 'فلا سرايا', 'عميلنا العزيز (participant_name)\r\n\r\nنشكر تعاملك معنا و نتمنى ان نكون عند حسن اختيارك \r\nولأننا نطمح ان نكون الأفضل نود تقييم تجربتك معنا على الرابط التالي \r\n\r\n(survey_36)\r\n\r\nفلا سرايا \r\nفريق خدمة العملاء', '2018-09-09 19:03:19', '2018-09-10 01:03:19'),
(17, 'clean template', '(participant_name)\r\n\r\n(survey_38)', '2018-09-18 12:37:20', '2018-09-21 12:37:29'),
(18, 'new', '<p>(survey_36)</p>', '2018-09-24 12:06:51', '2019-07-12 12:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_count`
--

CREATE TABLE `tbl_survey_count` (
  `id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `trigger_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sms_email` int(11) DEFAULT NULL COMMENT 'sms = 1 and email = 2',
  `is_submitted_send` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Is Sent Survey Link, 2: Submitted Survey Form',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_survey_count`
--

INSERT INTO `tbl_survey_count` (`id`, `participant_id`, `form_id`, `trigger_id`, `token`, `user_id`, `sms_email`, `is_submitted_send`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 0, '76032055b3581c1ab1fb0c4e8f316881', NULL, NULL, 2, '2018-06-02 11:14:04', '2018-06-02 05:58:14'),
(2, 3, 2, 0, '4e97338dc2f5aa611ee4a3629f214ccd', NULL, NULL, 2, '2018-06-02 11:14:08', '2018-06-02 05:57:42'),
(3, 1, 2, 0, '1f74153407f9fb7f20116763a983fbf4', NULL, NULL, 2, '2018-06-02 11:14:11', '2018-07-12 10:20:43'),
(4, 1, 2, 0, '1f74153407f9fb7f20116763a983fbf4', NULL, NULL, 2, '2018-06-02 11:26:59', '2018-07-12 10:20:43'),
(5, 3, 2, 0, '4e97338dc2f5aa611ee4a3629f214ccd', NULL, NULL, 2, '2018-06-02 11:27:03', '2018-06-02 05:57:42'),
(6, 6, 2, 0, '76032055b3581c1ab1fb0c4e8f316881', NULL, NULL, 2, '2018-06-02 11:27:06', '2018-06-02 05:58:14'),
(7, 6, 7, 0, '8460677a0132254b7db4327683ed31f6', NULL, NULL, 2, '2018-06-03 17:10:20', '2018-06-03 11:44:52'),
(8, 6, 7, 0, '1837b10a5555f1dc53e1bd1cd2ee37d1', NULL, NULL, 1, '2018-06-03 17:25:09', '2018-06-03 11:55:09'),
(9, 1, 2, 0, '1f74153407f9fb7f20116763a983fbf4', NULL, NULL, 1, '2018-07-02 13:39:09', '2018-07-12 10:20:43'),
(10, 7, 13, 2, '57e7db5ffc6ab0a1009ccf1a3c3c929d', NULL, NULL, 1, '2018-07-06 11:43:54', '2018-07-06 06:13:54'),
(11, 7, 12, 3, '3955c8772f18c5c6d83551a042b29803', NULL, NULL, 1, '2018-07-06 11:43:57', '2018-07-06 06:13:57'),
(12, 7, 11, 0, 'e6851ede48166575df9c4ea99d40f0fc', NULL, NULL, 1, '2018-07-06 11:47:07', '2018-07-12 00:18:28'),
(13, 8, 13, 2, 'a12a75807c886851be369cc49ff632dc', NULL, NULL, 1, '2018-07-06 17:34:59', '2018-07-24 13:10:51'),
(14, 8, 12, 3, '87d8342a91ec4e69355c6c515906ddc9', NULL, NULL, 1, '2018-07-06 17:35:02', '2018-08-08 21:00:04'),
(15, 8, 10, 0, '3f76036ad0daf38650dbbe4d370a0020', NULL, NULL, 1, '2018-07-06 17:35:33', '2018-07-12 08:09:40'),
(16, 5, 7, 0, '50e2860048a572d49bdb80e8e1729f7d', NULL, NULL, 1, '2018-07-12 05:44:52', '2018-07-12 11:44:52'),
(17, 9, 7, 2, '35125432ea2bf108f69851d82c3516dd', NULL, NULL, 1, '2018-07-13 23:47:05', '2018-07-23 03:42:11'),
(18, 9, 8, 3, 'd958d260e49976c66530743942596b35', NULL, NULL, 1, '2018-07-13 23:47:06', '2018-07-14 05:47:06'),
(19, 9, 10, 4, 'f34a61400ca358338905ec9bddede9e9', NULL, NULL, 1, '2018-07-13 23:47:06', '2018-08-21 15:19:02'),
(20, 10, 7, 2, '5fc291abf95bf540a401e53363139b5a', NULL, NULL, 1, '2018-07-13 23:48:22', '2018-08-21 05:40:19'),
(21, 10, 8, 3, '7102fe62de51c1933dea8e6b917f92aa', NULL, NULL, 1, '2018-07-13 23:48:22', '2018-08-21 05:40:19'),
(22, 10, 10, 4, '44b21529c8e5520ca52ab8e402f5631f', NULL, NULL, 1, '2018-07-13 23:48:23', '2018-08-21 05:38:02'),
(23, 9, 12, 0, '15463672780e842869ce80366a122896', NULL, NULL, 2, '2018-07-13 23:53:59', '2018-08-13 04:34:10'),
(24, 4, 10, 0, '68b400ff7d197221f0954da7b9d817cc', NULL, NULL, 1, '2018-07-16 05:22:15', '2018-07-16 13:12:55'),
(25, 8, 7, 0, '2472e0ded9b561be33fedd4259b55162', NULL, NULL, 1, '2018-07-16 06:47:27', '2018-07-16 13:55:04'),
(26, 5, 10, 0, '68b400ff7d197221f0954da7b9d817cc', NULL, NULL, 1, '2018-07-16 07:09:52', '2018-07-16 13:12:56'),
(27, 4, 7, 0, '1a6a7b547a9f31507db94fd021c78d98', NULL, NULL, 1, '2018-07-16 07:43:53', '2018-07-16 13:55:03'),
(28, 4, 8, 0, 'b18325e32ccedce2323224cfc49444d7', NULL, NULL, 1, '2018-07-16 07:46:35', '2018-07-16 13:55:04'),
(29, 8, 8, 0, 'b18325e32ccedce2323224cfc49444d7', NULL, NULL, 1, '2018-07-16 07:46:36', '2018-07-16 13:55:04'),
(30, 11, 10, 5, '7812167759b448f9a10ab2b4b115d719', NULL, NULL, 1, '2018-07-17 07:11:10', '2018-07-17 13:11:12'),
(31, 11, 7, 2, '54bafc44f835559f9ebe602da9684737', NULL, NULL, 1, '2018-07-17 07:11:31', '2018-08-17 05:48:02'),
(32, 11, 8, 3, '97cb428125eff504c9be83471feeab9f', NULL, NULL, 1, '2018-07-17 07:11:32', '2018-08-16 20:48:04'),
(33, 9, 12, 0, '15463672780e842869ce80366a122896', NULL, NULL, 1, '2018-07-22 23:30:28', '2018-08-13 04:34:10'),
(34, 3, 13, 0, 'a12a75807c886851be369cc49ff632dc', NULL, NULL, 1, '2018-07-24 05:17:28', '2018-07-24 13:10:50'),
(35, 5, 13, 0, 'e221eb9b1a6d5f78c8c645b1126c7ed3', NULL, NULL, 1, '2018-07-24 05:17:29', '2018-07-24 13:10:51'),
(36, 11, 12, 0, '189a3d052ab8d262e68c490f7275499e', NULL, NULL, 1, '2018-07-24 07:10:14', '2018-08-08 09:47:17'),
(37, 10, 12, 0, '15463672780e842869ce80366a122896', NULL, NULL, 1, '2018-07-24 07:10:15', '2018-08-13 04:34:11'),
(38, 5, 12, 0, '87d8342a91ec4e69355c6c515906ddc9', NULL, NULL, 1, '2018-07-24 07:10:15', '2018-08-08 21:00:05'),
(39, 4, 12, 0, '56b2301dedb6ee4ac7484776e27d56a1', NULL, NULL, 1, '2018-07-24 07:10:16', '2018-08-08 21:00:05'),
(40, 3, 5, 0, 'd75b01b0ce4a0a8b0018b7b5f1b0c86d', NULL, NULL, 2, '2018-07-27 03:16:41', '2018-07-27 09:17:44'),
(41, 11, 5, 0, '177631fe55a0482a8c36248d2affa0cb', NULL, NULL, 2, '2018-07-27 03:16:42', '2018-07-27 09:17:26'),
(42, 11, 13, 0, '279edeec4e5e3e73d180c3b96fc55418', NULL, NULL, 1, '2018-07-27 04:01:19', '2018-07-27 14:44:30'),
(43, 11, 2, 0, '9198a6e08b5e63bed65e8c3ff89efd87', NULL, NULL, 2, '2018-07-27 05:30:30', '2019-09-01 05:56:46'),
(44, 11, 21, 0, 'c4307640318a20426e6cc61b173de83f', NULL, NULL, 2, '2018-07-30 04:05:57', '2018-07-30 10:06:20'),
(45, 11, 21, 0, '7392f3e09044a351ccccdedf67d008ad', NULL, NULL, 1, '2018-08-04 09:33:47', '2018-08-04 15:33:47'),
(46, 11, 2, 0, '9198a6e08b5e63bed65e8c3ff89efd87', NULL, NULL, 1, '2018-08-04 09:35:22', '2019-09-01 05:56:46'),
(47, 12, 10, 5, '6bb1a1407df9d9649d782f4c6114133e', NULL, NULL, 1, '2018-08-15 00:40:17', '2018-09-01 12:07:27'),
(48, 12, 12, 6, 'ffc3edfc88d9abee6f1d6105a37dcb76', NULL, NULL, 1, '2018-08-15 00:40:20', '2018-09-04 06:13:00'),
(49, 13, 13, 0, '44bf2a7ea6dd8bbdb33ce30a999c72f0', NULL, NULL, 1, '2018-08-20 22:25:33', '2018-08-21 04:25:33'),
(50, 13, 21, 0, 'ad84213ab83660f0a04ba7c81faa4bb9', NULL, NULL, 1, '2018-08-20 22:29:03', '2018-09-01 11:38:44'),
(51, 13, 12, 0, '8c6d5f66c4aa7e73fb67cdaa4897ff59', NULL, NULL, 2, '2018-08-23 22:41:18', '2018-09-19 09:51:35'),
(52, 14, 12, 0, '0e03549c4aa06ae29b8b656d69aa14e1', NULL, NULL, 2, '2018-08-23 22:41:19', '2018-09-04 06:13:02'),
(53, 15, 12, 6, '4ec9a7fb123c917336f6ef8335e0ebb1', NULL, NULL, 2, '2018-08-29 02:38:08', '2018-09-04 06:13:03'),
(54, 15, 12, 0, '4ec9a7fb123c917336f6ef8335e0ebb1', NULL, NULL, 2, '2018-08-29 02:42:06', '2018-09-04 06:13:03'),
(55, 14, 12, 0, '0e03549c4aa06ae29b8b656d69aa14e1', NULL, NULL, 1, '2018-08-29 23:20:05', '2018-09-04 06:13:02'),
(56, 12, 6, 0, '8e90180c7055b75f3a4fd28fea0a4e42', NULL, NULL, 1, '2018-08-31 02:12:04', '2018-09-01 11:38:44'),
(57, 14, 6, 0, 'ad84213ab83660f0a04ba7c81faa4bb9', NULL, NULL, 1, '2018-08-31 02:12:04', '2018-09-01 11:38:44'),
(58, 16, 12, 0, 'ce270021d672016d534c12380321e8ee', NULL, NULL, 1, '2018-08-31 10:38:02', '2018-08-31 17:19:02'),
(59, 17, 12, 0, '0c9a9a7e48919637785583853c68d712', NULL, NULL, 1, '2018-08-31 11:19:02', '2018-08-31 18:00:03'),
(60, 13, 25, 0, 'a6c72723f8e7e673bd49961a6644d621', NULL, NULL, 1, '2018-08-31 21:35:48', '2018-09-01 03:35:48'),
(61, 13, 2, 0, 'bbf2304298ceedde79b7d355a306478d', NULL, NULL, 2, '2018-09-01 05:37:51', '2018-09-12 10:13:31'),
(62, 13, 10, 0, '0bd171eb9cc573845b0eb8fecdafff1e', NULL, NULL, 1, '2018-09-01 05:37:51', '2018-09-06 05:21:21'),
(63, 15, 2, 0, '8667c367e57ab9d9368d52a6c90a5e8f', NULL, NULL, 1, '2018-09-01 05:37:52', '2018-09-01 12:07:32'),
(64, 15, 10, 0, '8667c367e57ab9d9368d52a6c90a5e8f', NULL, NULL, 1, '2018-09-01 05:37:52', '2018-09-01 12:07:32'),
(65, 15, 12, 0, '4ec9a7fb123c917336f6ef8335e0ebb1', NULL, NULL, 1, '2018-09-01 05:37:52', '2018-09-04 06:13:03'),
(66, 12, 2, 0, '6bb1a1407df9d9649d782f4c6114133e', NULL, NULL, 1, '2018-09-01 05:38:44', '2018-09-01 12:07:27'),
(67, 12, 21, 0, '8e90180c7055b75f3a4fd28fea0a4e42', NULL, NULL, 1, '2018-09-01 05:38:44', '2018-09-01 11:38:44'),
(68, 13, 6, 0, 'ad84213ab83660f0a04ba7c81faa4bb9', NULL, NULL, 1, '2018-09-01 05:38:44', '2018-09-01 11:38:44'),
(69, 14, 2, 0, '68ed3d6b3a9c67b0504c3f81c25057ea', NULL, NULL, 1, '2018-09-01 05:38:44', '2018-09-01 12:07:30'),
(70, 14, 21, 0, 'ad84213ab83660f0a04ba7c81faa4bb9', NULL, NULL, 1, '2018-09-01 05:38:44', '2018-09-01 11:38:44'),
(71, 13, 7, 0, '1ac43774f7945aaabce3f6235f3463d1', NULL, NULL, 1, '2018-09-01 05:42:37', '2018-09-04 06:13:01'),
(72, 15, 7, 0, '4ec9a7fb123c917336f6ef8335e0ebb1', NULL, NULL, 1, '2018-09-01 05:42:37', '2018-09-04 06:13:03'),
(73, 12, 7, 0, 'ffc3edfc88d9abee6f1d6105a37dcb76', NULL, NULL, 1, '2018-09-01 05:52:57', '2018-09-04 06:13:00'),
(74, 14, 7, 0, '0e03549c4aa06ae29b8b656d69aa14e1', NULL, NULL, 1, '2018-09-01 05:52:58', '2018-09-04 06:13:02'),
(75, 14, 10, 0, '68ed3d6b3a9c67b0504c3f81c25057ea', NULL, NULL, 1, '2018-09-01 06:06:08', '2018-09-01 12:07:30'),
(76, 18, 7, 0, '57f2e3d93bf9e0f67130b09ee5614640', NULL, NULL, 1, '2018-09-01 09:17:06', '2018-09-01 15:17:06'),
(77, 18, 12, 0, '1588539618e68618c89ccc3fb9dbd4a4', NULL, NULL, 1, '2018-09-01 09:17:06', '2018-09-01 16:38:02'),
(78, 18, 0, 0, '1588539618e68618c89ccc3fb9dbd4a4', NULL, NULL, 1, '2018-09-01 09:57:02', '2018-09-01 16:38:02'),
(79, 19, 12, 0, 'f68d486be73d0179785f7195b338db57', NULL, NULL, 1, '2018-09-01 17:19:02', '2018-09-02 00:00:03'),
(80, 20, 12, 0, 'f68d486be73d0179785f7195b338db57', NULL, NULL, 1, '2018-09-01 17:19:02', '2018-09-02 00:00:03'),
(81, 19, 0, 0, 'f68d486be73d0179785f7195b338db57', NULL, NULL, 1, '2018-09-01 17:19:03', '2018-09-02 00:00:03'),
(82, 20, 0, 0, 'f68d486be73d0179785f7195b338db57', NULL, NULL, 1, '2018-09-01 17:19:03', '2018-09-02 00:00:04'),
(83, 21, 12, 0, 'f898eafcb2e7fcc7affcb6e18d0f259c', NULL, NULL, 1, '2018-09-02 15:38:03', '2018-09-02 22:19:02'),
(84, 21, 0, 0, '368e519e7c134e9043b2d688351edfd4', NULL, NULL, 1, '2018-09-02 15:38:03', '2018-09-02 22:19:02'),
(85, 22, 12, 0, '54449adbb507710345f360ed1119d7e1', NULL, NULL, 1, '2018-09-02 15:57:02', '2018-09-02 22:38:02'),
(86, 22, 0, 0, '586237edc122ea9321dbbd467f850001', NULL, NULL, 1, '2018-09-02 15:57:03', '2018-09-02 22:38:02'),
(87, 12, 27, 0, 'a8cca7c4919e927bb9c92baa0d7c1f3f', NULL, NULL, 1, '2018-09-05 00:10:38', '2018-09-06 03:49:01'),
(88, 27, 27, 0, '69eaef2b83e46f6676c26bfce112711e', NULL, NULL, 1, '2018-09-05 00:10:38', '2018-09-05 06:10:38'),
(89, 27, 12, 0, '0ace3553c69e5ca734e8f0b78db4b773', NULL, NULL, 1, '2018-09-05 10:00:04', '2018-09-05 16:57:01'),
(90, 27, 0, 0, 'ef3a6a7689b8afdf1026c3f471c853bc', NULL, NULL, 1, '2018-09-05 10:00:04', '2018-09-12 21:00:05'),
(91, 18, 27, 0, 'f43c7c6c9b0c736759e9e68060718dfd', NULL, NULL, 1, '2018-09-05 22:09:03', '2018-09-06 07:20:01'),
(92, 13, 24, 0, '0bd171eb9cc573845b0eb8fecdafff1e', NULL, NULL, 1, '2018-09-05 23:21:21', '2018-09-06 05:21:21'),
(93, 13, 5, 0, 'c907cf6c031e04e65a7370579dda802e', NULL, NULL, 2, '2018-09-05 23:21:39', '2018-09-17 10:37:06'),
(94, 16, 5, 0, '4b1686a6a6691bb148799bcb5441b73c', NULL, NULL, 2, '2018-09-05 23:21:40', '2018-09-06 05:24:45'),
(95, 13, 28, 0, '5591a055023751900cb0965439fdee06', NULL, NULL, 1, '2018-09-06 03:07:07', '2018-09-06 09:07:07'),
(96, 13, 29, 0, '25b4d5ff52bde1e2ec439a647e272ba0', NULL, NULL, 2, '2018-09-06 07:49:06', '2018-09-08 14:09:41'),
(97, 8, 0, 12, '43f2a6536b9022735c98225cb9ea36d7', NULL, NULL, 1, '2018-09-07 07:26:14', '2018-09-07 13:26:14'),
(98, 5, 0, 12, '56826876f0220c86f0fe12456c5739e2', NULL, NULL, 1, '2018-09-07 07:26:53', '2018-09-07 13:26:53'),
(99, 11, 0, 12, '7f63e3fea70940a012d880fc21c5ed39', NULL, NULL, 1, '2018-09-07 07:27:10', '2018-09-07 13:27:10'),
(100, 9, 0, 12, 'e78709512c5c75061e76f33e3c62ba7a', NULL, NULL, 1, '2018-09-07 07:27:25', '2018-09-07 13:27:25'),
(101, 4, 0, 12, '54e99587bd5b71d29f2c87dcf62d76ea', NULL, NULL, 1, '2018-09-07 07:27:40', '2018-09-07 13:27:40'),
(102, 3, 0, 12, 'ebe790d12984baec5b37e6aacf52fc04', NULL, NULL, 1, '2018-09-07 07:27:54', '2018-09-07 13:28:13'),
(103, 13, 29, 0, '25b4d5ff52bde1e2ec439a647e272ba0', 10, 2, 2, '2018-09-07 08:04:15', '2018-09-08 14:09:41'),
(104, 18, 35, 0, 'e2a5fbf023158876603d1735e0805c73', 10, 1, 1, '2018-09-08 06:39:58', '2018-09-08 16:05:53'),
(105, 13, 29, 0, '25b4d5ff52bde1e2ec439a647e272ba0', 10, 2, 1, '2018-09-08 07:24:44', '2018-09-08 14:09:41'),
(106, 13, 2, 0, 'bbf2304298ceedde79b7d355a306478d', 10, 2, 2, '2018-09-08 08:07:15', '2018-09-12 10:13:31'),
(107, 13, 10, 0, 'a8ab5b693ad268a03b17ea2098a78efa', 10, 2, 1, '2018-09-08 08:07:15', '2018-09-08 14:07:15'),
(108, 13, 24, 0, 'a8ab5b693ad268a03b17ea2098a78efa', 10, 2, 1, '2018-09-08 08:07:15', '2018-09-08 14:07:15'),
(109, 13, 35, 0, '25b4d5ff52bde1e2ec439a647e272ba0', 10, 2, 1, '2018-09-08 08:09:41', '2018-09-08 14:09:41'),
(110, 27, 35, 0, '45ff4236671e0a3340216ea17066aa71', 10, 1, 1, '2018-09-08 10:06:40', '2018-09-08 16:06:40'),
(111, 27, 35, 0, '61ad24d2cc4c0b5cade9871d7c617a7b', 10, 2, 1, '2018-09-08 10:14:27', '2018-09-08 16:14:27'),
(112, 28, 35, 0, '8d587883949b576857aa152f936c6d06', 10, 2, 2, '2018-09-08 10:16:43', '2018-09-09 13:43:14'),
(113, 14, 0, 0, 'cc2bb9d020c0792f777ef4fe06364e7a', NULL, NULL, 1, '2018-09-08 23:51:03', '2018-09-12 21:00:04'),
(114, 13, 0, 42, 'a09fae05a4416f52a4f314093d11b97c', NULL, NULL, 1, '2018-09-08 23:51:03', '2018-09-19 07:15:15'),
(115, 31, 35, 0, 'bd2ff002d4048ce5fd96ac9c4d4725f9', 10, 1, 1, '2018-09-09 03:44:11', '2018-09-09 11:04:34'),
(116, 30, 35, 0, '8d587883949b576857aa152f936c6d06', 10, 1, 1, '2018-09-09 03:44:57', '2018-09-09 13:39:56'),
(117, 29, 35, 0, 'e4061a175644891d41e8ec9002ece8e0', 10, 1, 1, '2018-09-09 03:46:26', '2018-09-09 09:46:26'),
(118, 28, 35, 0, '8d587883949b576857aa152f936c6d06', 10, 1, 2, '2018-09-09 05:06:51', '2018-09-09 13:43:14'),
(119, 32, 36, 0, '27550cca816bd926b8c508cdf1d11e1e', 10, 1, 1, '2018-09-09 10:05:48', '2018-09-09 16:10:59'),
(120, 33, 36, 0, '4d7ee36677ded4ce8272e859d44aa26e', 10, 1, 1, '2018-09-09 10:10:10', '2018-09-09 16:10:10'),
(121, 29, 36, 0, 'e1f3f270d3c2e9b0c3b188b91f4f2b56', 10, 1, 1, '2018-09-09 21:07:18', '2018-09-10 03:07:18'),
(122, 34, 22, 8, '526942eaf91bdce57332b4a60213c0ae', NULL, NULL, 1, '2018-09-11 22:43:14', '2018-09-12 04:43:14'),
(123, 34, 0, 17, 'f5242cf42882db0717f2eb090c07f6cd', NULL, NULL, 1, '2018-09-11 22:43:14', '2018-09-12 04:43:17'),
(124, 35, 22, 8, '61cb7375bb1ab6b6b0d708e07c4f0241', NULL, NULL, 1, '2018-09-11 22:51:44', '2018-09-12 04:51:44'),
(125, 35, 0, 17, 'e92795448e7a4460a546874b619e1ce2', NULL, NULL, 1, '2018-09-11 22:51:44', '2018-09-12 04:51:47'),
(126, 36, 22, 8, '714afac73d935b8039852388f14dc95c', NULL, NULL, 1, '2018-09-11 22:59:25', '2018-09-12 04:59:25'),
(127, 36, 0, 17, '2439c1934a46d3059c895835fcc90d9e', NULL, NULL, 1, '2018-09-11 22:59:25', '2018-09-12 04:59:28'),
(128, 37, 22, 8, '8991dd458a22510a192776364899ecce', NULL, NULL, 1, '2018-09-11 23:48:32', '2018-09-12 05:48:32'),
(129, 37, 0, 17, '20dc9735ef5dbbb04525ba9034765068', NULL, NULL, 1, '2018-09-11 23:48:32', '2018-09-12 05:48:35'),
(130, 38, 22, 8, '556bc72aff186a6b374a62cbcf144d78', NULL, NULL, 1, '2018-09-11 23:51:21', '2018-09-12 05:51:21'),
(131, 38, 0, 19, '87d59ce1bb561488f59425be549b6ded', NULL, NULL, 1, '2018-09-11 23:51:21', '2018-09-12 06:03:27'),
(132, 13, 0, 42, 'a09fae05a4416f52a4f314093d11b97c', 10, 2, 1, '2018-09-12 02:38:03', '2018-09-19 07:15:15'),
(133, 38, 2, 0, '5f8bc670f14265b78e87478d3f0585f6', 10, 2, 2, '2018-09-12 04:01:25', '2018-09-12 10:02:33'),
(134, 38, 12, 0, 'fc0f090e06ca8a982c975795aebb0ad9', 10, 2, 2, '2018-09-13 03:14:10', '2018-09-13 09:14:38'),
(135, 39, 36, 0, '8c8b20e47bed2e9bd882adb0f035fabe', 44, 1, 1, '2018-09-15 00:05:00', '2018-09-15 06:05:00'),
(136, 40, 22, 8, 'c44180c47817127c283686069a456363', NULL, NULL, 1, '2018-09-15 00:06:17', '2018-09-15 06:06:17'),
(137, 40, 0, 24, '45aa64b28d9ab85804a8d935b26d0882', NULL, NULL, 1, '2018-09-15 00:06:17', '2018-09-15 06:06:21'),
(149, 13, 12, 0, '8c6d5f66c4aa7e73fb67cdaa4897ff59', 40, 2, 2, '2018-09-17 06:38:19', '2018-09-19 09:51:35'),
(150, 13, 12, 0, '8c6d5f66c4aa7e73fb67cdaa4897ff59', 40, 2, 2, '2018-09-17 06:40:24', '2018-09-19 09:51:35'),
(151, 43, 36, 0, 'f0ed2c596d94ab55a4097fc96eaaea9d', 10, 1, 1, '2018-09-17 06:41:40', '2018-09-17 12:41:40'),
(152, 44, 0, 39, '7c911ab9b4fabbb8617bd6859f33db6e', NULL, NULL, 1, '2018-09-17 07:53:37', '2018-09-17 13:53:37'),
(153, 45, 0, 39, '8224b3de3d0bd40f3405f81f8134eb6c', NULL, NULL, 1, '2018-09-17 07:54:13', '2018-09-17 13:54:13'),
(154, 45, 35, 0, '1621d10749248f52d0d82feac40ab7d1', 10, 2, 1, '2018-09-17 07:54:16', '2018-09-17 13:54:16'),
(165, 38, 38, 0, '726b41a53d1a6d49146af772ce404afb', 10, 2, 2, '2018-09-18 03:56:28', '2018-09-18 10:03:07'),
(166, 44, 38, 0, '8911d1cfbde17b17820a6c89eaa651f3', 10, 2, 2, '2018-09-18 03:56:31', '2018-09-18 09:56:53'),
(167, 45, 38, 0, '25f23eb94aed7b60fa483f837b19a573', 10, 2, 2, '2018-09-18 03:56:33', '2018-09-18 09:57:08'),
(168, 45, 37, 0, '5c33584bf7b562542dd28711aca81dbd', 10, 1, 1, '2018-09-18 06:52:56', '2018-09-18 12:52:56'),
(169, 50, 37, 0, '085c79f6ef633d23f36af1f8acd4c3f7', 10, 1, 1, '2018-09-18 21:50:43', '2018-09-19 03:50:43'),
(170, 50, 36, 0, 'c84e3fe81c287e890599bf93e5ad09b0', 10, 1, 1, '2018-09-18 22:15:48', '2018-09-19 04:15:48'),
(171, 52, 0, 39, '995a2e48b541fdae6e5e001ce046e787', NULL, NULL, 1, '2018-09-18 22:27:28', '2018-09-19 04:27:28'),
(172, 52, 35, 0, '995a2e48b541fdae6e5e001ce046e787', 10, 2, 1, '2018-09-18 22:27:30', '2018-09-19 04:27:30'),
(173, 53, 0, 39, 'df683e82282837f0ae7b40463bc20e96', NULL, NULL, 1, '2018-09-18 22:31:18', '2018-09-19 04:31:18'),
(174, 53, 35, 0, '3f185da7cf65d8c09117aaa7d86342dc', 10, 2, 1, '2018-09-18 22:31:20', '2018-09-19 04:31:20'),
(175, 54, 0, 39, '91ab10b2a6a78d1c2180f388ec4d8b8f', NULL, NULL, 1, '2018-09-18 22:58:03', '2018-09-19 04:58:03'),
(176, 59, 0, 39, '55f5cea79ff74597d1bd8e956e375008', NULL, NULL, 1, '2018-09-18 23:27:18', '2018-09-19 05:27:18'),
(177, 60, 0, 39, '137e695f7b68de50d9aea3dbdbea8e26', NULL, NULL, 1, '2018-09-18 23:28:56', '2018-09-19 05:28:56'),
(178, 61, 0, 39, '37a6b419e3533df52692e01f05822c89', NULL, NULL, 1, '2018-09-18 23:32:08', '2019-02-05 11:35:01'),
(183, 63, 0, 42, 'bbdb590e415fe38f1ffcd3a8e7674ead', NULL, NULL, 1, '2018-09-19 00:19:44', '2018-09-19 06:19:44'),
(184, 13, 38, 0, '23442ada7076b67780e17c94c798115f', 40, 2, 2, '2018-09-19 00:20:57', '2018-09-20 12:22:36'),
(185, 65, 0, 42, '0ad93e703db14d7a91ac607a13acceb5', NULL, NULL, 1, '2018-09-19 00:36:34', '2018-09-19 06:36:34'),
(189, 70, 0, 42, '4c8b1df1386d0873aa5b94d9488aaed1', NULL, NULL, 1, '2018-09-19 01:26:31', '2018-09-19 07:26:31'),
(190, 71, 0, 42, 'cf19c35b601d517fabb67cd36e2dc414', NULL, NULL, 1, '2018-09-19 01:27:02', '2018-09-19 07:27:03'),
(191, 72, 0, 42, '27caf9015fbe03863b25fc0b7759212b', NULL, NULL, 1, '2018-09-19 01:27:05', '2018-09-19 07:27:05'),
(192, 73, 0, 42, '88b2fbe2ab0dc9e186a55ac046405761', NULL, NULL, 1, '2018-09-19 01:34:21', '2018-09-19 07:34:22'),
(193, 74, 0, 42, '9d0c88867a24d2a4c4719eba7ad45234', NULL, NULL, 1, '2018-09-19 02:40:42', '2018-09-19 08:40:42'),
(194, 75, 0, 42, '6c4220590d12dd615dcd3aa5da178db4', NULL, NULL, 1, '2018-09-19 03:41:14', '2018-09-19 09:41:14'),
(195, 13, 12, 0, '8c6d5f66c4aa7e73fb67cdaa4897ff59', 45, 2, 2, '2018-09-19 03:49:02', '2018-09-19 09:51:35'),
(196, 76, 0, 42, 'ebc7d85d28a49e90028ce4917369ad84', NULL, NULL, 1, '2018-09-19 03:56:10', '2018-09-19 09:56:10'),
(197, 77, 0, 42, '0892487d959db7a13bad6bb942d141ca', NULL, NULL, 1, '2018-09-19 21:45:47', '2018-09-20 03:45:47'),
(198, 78, 36, 0, 'fbb23af374ec503b2d6b0bd75be21ba5', 10, 2, 2, '2018-09-19 21:58:05', '2018-09-20 04:00:24'),
(199, 79, 36, 0, '8bc1bb7b87277ef151b9e65725cdba6d', 10, 2, 1, '2018-09-19 21:58:38', '2018-09-20 03:58:38'),
(201, 72, 12, 0, '2665a103e263b540952c0ec69e317adb', 40, 2, 2, '2018-09-20 00:37:04', '2018-09-20 08:42:28'),
(205, 72, 12, 0, '2665a103e263b540952c0ec69e317adb', 40, 2, 2, '2018-09-20 02:40:41', '2018-09-20 08:42:28'),
(207, 72, 38, 0, 'a1ef401a7d095bc8e466d8966c310b98', 10, 2, 2, '2018-09-20 06:13:30', '2018-09-21 06:08:46'),
(208, 13, 38, 0, '23442ada7076b67780e17c94c798115f', 10, 2, 2, '2018-09-20 06:20:15', '2018-09-20 12:22:36'),
(209, 72, 38, 0, 'a1ef401a7d095bc8e466d8966c310b98', 10, 1, 2, '2018-09-20 21:37:43', '2018-09-21 06:08:46'),
(210, 71, 38, 0, 'e4b2fb24262db623aad4864284c87ecd', 10, 1, 2, '2018-09-20 21:38:53', '2018-09-21 03:39:43'),
(211, 71, 38, 0, '608a7ea5ab163f354250750106e79a3a', 10, 1, 1, '2018-09-20 21:43:35', '2018-09-21 03:43:35'),
(212, 72, 38, 0, 'a1ef401a7d095bc8e466d8966c310b98', 10, 2, 2, '2018-09-20 23:59:05', '2018-09-21 06:08:46'),
(213, 81, 0, 42, '87157e93ef608651d8a239cc486ecfb9', NULL, NULL, 1, '2018-09-21 00:02:09', '2018-09-21 06:02:09'),
(214, 82, 0, 42, 'af1923ac7f17900396ceffe0c2c25598', NULL, NULL, 1, '2018-09-21 00:03:58', '2018-09-21 06:03:58'),
(215, 83, 0, 42, '9a10b3df17af5ff30e0d9b567ba44b10', NULL, NULL, 1, '2018-09-21 00:05:05', '2018-09-21 06:05:05'),
(216, 84, 0, 42, '3307397e16771ed643b2d3e433de9521', NULL, NULL, 1, '2018-09-21 00:26:48', '2018-09-21 06:26:48'),
(219, 85, 0, 42, 'a02dec83d623b72470e4b698fb512a1c', NULL, NULL, 1, '2018-09-21 00:38:45', '2018-09-21 06:38:45'),
(220, 86, 0, 42, 'f2e77d1f34aabe44ae42cf047af5aa9c', NULL, NULL, 1, '2018-09-21 00:47:06', '2018-09-21 06:47:06'),
(221, 87, 0, 42, '6e508e6c102b3daa47e122f9fcec9c48', NULL, NULL, 1, '2018-09-21 02:48:06', '2018-09-21 08:48:06'),
(222, 84, 38, 0, '4b45181e61dda58859d2efa1e6f3460e', 50, 2, 2, '2018-09-21 02:52:43', '2018-09-21 08:55:34'),
(223, 84, 38, 0, '4b45181e61dda58859d2efa1e6f3460e', 50, 1, 2, '2018-09-21 02:54:32', '2018-09-21 08:55:34'),
(224, 84, 38, 0, '88fcfc1acf356d2a1c7e09efc264cb19', 50, 1, 1, '2018-09-21 02:56:43', '2018-09-21 08:56:43'),
(225, 88, 0, 42, '04c77cef6a49232a35b1f587bb1722fc', NULL, NULL, 1, '2018-09-21 02:57:24', '2018-09-21 08:57:24'),
(226, 80, 36, 0, 'd66505501b93b731240b17f5f5d67868', 51, 1, 2, '2018-09-21 02:59:51', '2018-09-21 09:00:42'),
(227, 89, 0, 42, '84765eaf80dfab6409ac41722cb7f2c7', NULL, NULL, 1, '2018-09-21 03:09:14', '2018-09-21 09:09:14'),
(228, 90, 38, 42, '75d5ef7aaa83c65e6538f70b4d1656fb', 10, 1, 1, '2018-09-21 03:25:53', '2018-09-21 09:29:49'),
(229, 91, 38, 0, '4f2873fd52c404ae713275dcbbdcb4dc', 45, 1, 2, '2018-09-21 04:38:13', '2018-09-21 10:39:09'),
(230, 92, 38, 0, '1fc663f1952dd7220cdf6ed8c8198422', 45, 1, 2, '2018-09-21 04:45:30', '2018-09-21 11:43:26'),
(231, 92, 38, 0, '1fc663f1952dd7220cdf6ed8c8198422', 45, 1, 2, '2018-09-21 04:48:38', '2018-09-21 11:43:26'),
(232, 92, 38, 0, '1fc663f1952dd7220cdf6ed8c8198422', 10, 2, 2, '2018-09-21 04:52:47', '2018-09-21 11:43:26'),
(233, 92, 2, 0, '1934bc30eb2e70cedd0b016204ad55fe', 10, 2, 2, '2018-09-21 04:52:47', '2018-09-21 11:00:15'),
(234, 92, 12, 0, 'd90d8751e5c9bbdbfe1c6a96a6e036f2', 10, 2, 2, '2018-09-21 04:52:47', '2018-09-21 11:55:35'),
(235, 92, 39, 0, 'dea735ae4fa6bc28f40d70d9762f1b46', 10, 2, 2, '2018-09-21 05:07:46', '2018-09-21 11:08:14'),
(236, 92, 38, 0, '1fc663f1952dd7220cdf6ed8c8198422', 10, 2, 2, '2018-09-21 05:42:23', '2018-09-21 11:43:26'),
(237, 92, 2, 0, '1fc663f1952dd7220cdf6ed8c8198422', 10, 2, 1, '2018-09-21 05:42:23', '2018-09-21 11:42:23'),
(238, 92, 12, 0, 'd90d8751e5c9bbdbfe1c6a96a6e036f2', 10, 2, 2, '2018-09-21 05:48:05', '2018-09-21 11:55:35'),
(239, 92, 12, 0, 'd90d8751e5c9bbdbfe1c6a96a6e036f2', 10, 2, 2, '2018-09-21 05:55:21', '2018-09-21 11:55:35'),
(240, 94, 36, 0, '788f46d30744ef28286ce2bcc3888a40', 47, 1, 2, '2018-09-22 00:19:02', '2018-09-22 06:20:40'),
(241, 95, 36, 0, 'cb25faf84f06b182ec32a7e0da46786c', 47, 1, 2, '2018-09-22 00:21:22', '2018-09-22 06:22:32'),
(242, 96, 36, 0, 'a129e8f16ae72e3a2a072f647b99e0bc', 47, 1, 2, '2018-09-22 00:24:27', '2018-09-22 06:26:48'),
(243, 97, 36, 0, '02d837352294d2d7eb1415daa1f00896', 48, 1, 2, '2018-09-22 00:29:46', '2018-09-22 06:30:24'),
(244, 98, 36, 0, '1a90bd13c80aa1bcdada3b82f1ce04fe', 48, 1, 2, '2018-09-22 00:31:05', '2018-09-22 06:31:44'),
(245, 99, 36, 0, '40ee52a5ede8466ade7d6061b5d09d7a', 10, 1, 2, '2018-09-22 02:30:01', '2018-09-22 08:31:20'),
(246, 100, 36, 0, 'c1b365f134edf9b7979ad10015a5338f', 10, 1, 1, '2018-09-22 02:30:16', '2018-09-22 08:30:16'),
(247, 101, 36, 0, 'b6e1b980e5ab9c336045e8ffc29a209d', 47, 1, 2, '2018-09-22 02:59:28', '2018-09-22 09:08:52'),
(248, 102, 36, 0, 'ada9e4ff1b4af183af841ca538cb741d', 47, 1, 2, '2018-09-22 03:04:28', '2018-10-06 07:28:53'),
(249, 103, 36, 0, 'd0126aa8101d19bb969437e0b2d40127', 47, 1, 2, '2018-09-22 03:07:08', '2018-09-22 09:14:02'),
(250, 104, 36, 0, 'b924611d52188fc58bc3fa06b9b1f770', 48, 1, 2, '2018-09-22 03:17:08', '2018-09-25 07:48:36'),
(251, 105, 36, 0, '9dbe996e7ff7cf52a15e04f8eb867415', 49, 1, 2, '2018-09-22 09:03:19', '2018-09-22 15:04:44'),
(252, 106, 36, 0, '5f78bcb4cc3fcdec1a9448285d5c07a0', 49, 1, 2, '2018-09-22 09:05:14', '2018-09-22 15:06:07'),
(253, 107, 36, 0, '34b585ebe3727ec52b1a73db4002b47c', 46, 1, 2, '2018-09-22 09:08:55', '2018-09-22 15:11:47'),
(254, 108, 36, 0, '9f8d670a00c871c5f66e50b15d5242eb', 46, 1, 2, '2018-09-22 09:09:11', '2018-09-22 15:12:49'),
(255, 109, 36, 0, '6fc1a74fcca2e0cad7790a8d17fcf9a7', 10, 1, 1, '2018-09-23 02:25:36', '2018-09-23 08:25:36'),
(256, 110, 36, 0, 'e0e00229128770651cc6dcd23dd856b9', 10, 1, 2, '2018-09-23 02:26:00', '2018-09-23 08:49:55'),
(257, 111, 36, 0, 'c1e892e14452e257b8cdc5444673700f', 10, 1, 2, '2018-09-23 02:26:20', '2018-09-23 09:04:40'),
(258, 84, 41, 0, 'da3150f1c1b1a5a75d9b60781c82f7a8', 10, 1, 2, '2018-09-24 03:10:03', '2018-09-24 09:12:21'),
(259, 112, 36, 0, '98b021adb6bdfb13b958df52d1aa36a6', 10, 1, 2, '2018-09-24 23:17:56', '2018-09-25 05:19:49'),
(260, 113, 36, 0, 'bf5ece22646e61750e065f5846a7605b', 10, 1, 1, '2018-09-24 23:23:01', '2018-09-25 05:23:01'),
(261, 92, 36, 0, '73ef3106c750520fcb085459e27f3e6e', 10, 2, 2, '2018-09-25 01:25:47', '2018-10-06 10:23:58'),
(262, 103, 36, 0, '0a6a186f36ac939135ca008157c1c7f3', 10, 1, 1, '2018-09-25 01:35:55', '2018-09-25 07:35:55'),
(263, 71, 36, 0, '639aa80f18b7ff5cf95ffbbb277403c9', 10, 2, 2, '2018-09-25 01:45:11', '2018-09-25 07:45:39'),
(264, 104, 36, 0, 'b924611d52188fc58bc3fa06b9b1f770', 10, 1, 2, '2018-09-25 01:47:38', '2018-09-25 07:48:36'),
(265, 114, 36, 0, '3bd5d0cb66472bcea9284e9ae083370d', 10, 1, 1, '2018-09-30 23:59:48', '2018-10-01 05:59:48'),
(266, 101, 36, 0, '6636dd1439105386f12e92c486f03e99', 10, 1, 1, '2018-10-01 03:08:42', '2018-10-01 09:08:42'),
(267, 92, 36, 0, '73ef3106c750520fcb085459e27f3e6e', 10, 2, 1, '2018-10-01 03:10:19', '2018-10-06 10:23:58'),
(268, 115, 36, 0, 'e17c8ed3422caee6612a086741a35f15', 10, 1, 2, '2018-10-02 03:17:10', '2019-01-10 05:54:28'),
(269, 115, 36, 0, 'e17c8ed3422caee6612a086741a35f15', 10, 2, 1, '2018-10-02 03:29:41', '2019-01-10 05:54:28'),
(270, 115, 36, 0, 'e17c8ed3422caee6612a086741a35f15', 10, 1, 1, '2018-10-02 03:41:28', '2019-01-10 05:54:28'),
(271, 116, 36, 0, 'eec91425a9a1c4877e53fe557a559efb', 10, 1, 1, '2018-10-03 02:21:53', '2018-10-03 08:21:53'),
(272, 117, 36, 0, '37338f4815d285846fc74cdd9b98ad22', 10, 1, 1, '2018-10-03 02:28:40', '2018-10-03 08:28:40'),
(273, 118, 36, 0, 'ec00f1a93dee8c1110782b9e52c2a2e8', 10, 1, 2, '2018-10-06 02:18:28', '2018-10-06 07:23:52'),
(274, 118, 36, 0, 'ec00f1a93dee8c1110782b9e52c2a2e8', 10, 2, 2, '2018-10-06 02:22:31', '2018-10-06 07:23:52'),
(275, 102, 36, 0, 'ada9e4ff1b4af183af841ca538cb741d', 10, 1, 2, '2018-10-06 02:26:16', '2018-10-06 07:28:53'),
(276, 72, 36, 0, 'dd2067d4f5a9d7b289dab3ae7549aaa9', 10, 1, 2, '2018-10-06 02:30:56', '2018-10-08 09:27:55'),
(277, 119, 36, 0, '4e195710a6b28dd4f31e37f62bcfc221', 10, 1, 2, '2018-10-06 02:37:33', '2018-10-17 11:39:05'),
(278, 119, 36, 0, '4e195710a6b28dd4f31e37f62bcfc221', 10, 1, 2, '2018-10-06 02:39:30', '2018-10-17 11:39:05'),
(279, 119, 36, 0, '4e195710a6b28dd4f31e37f62bcfc221', 10, 1, 1, '2018-10-06 05:22:53', '2018-10-17 11:39:05'),
(280, 119, 36, 0, '4e195710a6b28dd4f31e37f62bcfc221', 10, 2, 1, '2018-10-06 05:23:21', '2018-10-17 11:39:05'),
(281, 120, 36, 0, '24d6602b1f79453685663e75c115849b', 10, 1, 1, '2018-10-07 03:24:00', '2018-10-17 11:39:05'),
(282, 60, 36, 0, '52c68e583269ee964d467fb92114a690', 10, 2, 2, '2018-10-08 01:41:20', '2018-10-08 09:26:07'),
(283, 72, 36, 0, 'dd2067d4f5a9d7b289dab3ae7549aaa9', 10, 2, 2, '2018-10-08 04:27:38', '2018-10-08 09:27:55'),
(284, 121, 36, 0, 'c058e4b3712d338dc8866492db2b0382', 52, 1, 2, '2018-10-08 04:34:37', '2018-10-08 09:42:32'),
(285, 121, 36, 0, 'c058e4b3712d338dc8866492db2b0382', 52, 2, 2, '2018-10-08 04:34:56', '2018-10-08 09:42:32'),
(286, 121, 36, 0, 'c058e4b3712d338dc8866492db2b0382', 52, 2, 2, '2018-10-08 04:41:27', '2018-10-08 09:42:32'),
(287, 29, 0, 0, '94b01d4815ca4065eac24aba7c63025a', 10, 2, 1, '2018-10-09 02:00:05', '2019-01-09 07:00:05'),
(288, 30, 0, 0, 'f5123e39587b341c7837e2c345c74fdf', 10, 2, 1, '2018-10-09 02:00:07', '2019-01-09 07:00:06'),
(289, 31, 0, 0, 'e29cd7c4fd75a2cc4614b396aa4341d8', 10, 2, 1, '2018-10-09 02:00:09', '2019-01-09 07:00:09'),
(290, 122, 36, 0, '8cf7fec487315437f2b7da4b34f8b3fe', 10, 1, 1, '2018-10-11 01:25:56', '2018-10-11 06:25:56'),
(291, 123, 36, 0, 'c59f025d201d8e7ec1dad1f915414a14', 10, 1, 2, '2018-10-17 06:09:04', '2018-10-17 12:04:43'),
(292, 40, 36, 0, '81add0a15a4b45dd8d5f86c3ed6894bf', 10, 1, 1, '2018-10-17 06:39:04', '2018-10-17 11:39:04'),
(293, 124, 36, 0, '9abc74fa17c50cd9a58d2fa1f4f04c09', 10, 1, 1, '2018-10-17 07:14:58', '2018-10-17 12:14:58'),
(294, 125, 36, 0, '1e2958debecc77fb34bb120d369918c9', 10, 1, 1, '2018-10-24 01:19:26', '2018-10-24 06:19:26'),
(295, 126, 36, 0, 'f34f4c8a2994f9803696cb6fb5b51eea', 10, 1, 1, '2018-10-24 01:20:20', '2018-10-24 06:20:20'),
(296, 127, 36, 0, '65c2e37be4a07100bcc9062c3b514517', 10, 1, 1, '2018-10-30 02:40:24', '2018-10-30 07:40:24'),
(297, 128, 36, 0, 'd76bfb73285e8208b02fe2f1f32b650b', 10, 1, 1, '2018-12-13 01:20:47', '2018-12-13 07:20:47'),
(298, 129, 36, 0, '80ccea9354aacb07a4c119291504427e', 10, 1, 1, '2019-01-07 23:00:47', '2019-01-08 05:00:47'),
(299, 130, 36, 0, 'e3e42ffb17a1a1b9d04786322c1119a9', 10, 1, 1, '2019-01-07 23:02:23', '2019-01-08 05:02:23'),
(300, 131, 36, 0, 'ec0634de841a975e09a0f6b5f4ba482e', 10, 1, 1, '2019-01-07 23:04:33', '2019-01-08 05:04:33'),
(301, 131, 35, 0, '5041b0b0f66a376eef1ef809d5f2420e', 10, 1, 1, '2019-01-07 23:04:34', '2019-01-08 05:04:34'),
(302, 132, 36, 0, '9fdaf1bb27ee7403552f6de12b6d9989', 10, 1, 1, '2019-01-10 11:27:08', '2019-01-10 05:57:08'),
(303, 27, 36, 0, '51cf9e18d8a90e30e0653465b14056fe', 10, 1, 1, '2019-01-10 11:51:10', '2019-01-18 09:40:26'),
(304, 14, 36, 0, '3e340c09591bb16f8f88d7ae2e6ca962', 10, 1, 1, '2019-01-10 12:13:36', '2019-01-10 06:52:07'),
(305, 133, 36, 0, '2ce01869e317a2bf0ef66614191345d6', 10, 1, 1, '2019-01-10 12:19:37', '2019-01-10 07:07:34'),
(306, 134, 36, 0, '1576993d301d3aa98d0edb9173d0157d', 10, 1, 1, '2019-01-10 12:20:50', '2019-01-10 06:50:50'),
(307, 135, 36, 0, '90a76bfdbde4534f8dd30ae63b907e4b', 10, 1, 1, '2019-01-10 12:39:39', '2019-01-10 07:21:29'),
(308, 136, 36, 0, '372cdc95e4c9d99d38c6a3b2df39620c', 10, 1, 1, '2019-01-10 12:40:13', '2019-01-10 07:30:40'),
(309, 137, 36, 0, '0791a20846e094c280ee6c2017991e65', 10, 1, 1, '2019-01-10 13:01:02', '2019-01-10 07:31:02'),
(310, 138, 36, 0, '589978ed145d80e3b303166af16d6b93', 10, 1, 1, '2019-01-10 14:40:34', '2019-01-10 09:10:34'),
(311, 139, 36, 0, '2b8c241bad87b7f7e4d9341a4e536d61', 10, 1, 1, '2019-01-10 14:41:14', '2019-01-10 09:11:14'),
(312, 140, 36, 0, '15a23401e01f2a3c02f12e4e62fea569', 10, 1, 1, '2019-01-10 14:42:27', '2019-01-10 09:12:27'),
(313, 141, 36, 0, 'a3d8b7475404df99af3b0714d9def382', 10, 1, 1, '2019-01-10 14:42:44', '2019-01-10 09:12:44'),
(314, 142, 36, 0, 'd42690e2961cf26fb75624f368c259d6', 10, 1, 1, '2019-01-10 14:43:09', '2019-01-10 09:13:09'),
(315, 143, 36, 0, '83dbb5f6efda343e87a7aa3b74e02905', 10, 1, 1, '2019-01-10 14:54:40', '2019-01-10 09:24:40'),
(316, 191, 36, 0, '595846448c9cb4d98b9f4cced397444c', 10, 1, 1, '2019-01-10 16:01:47', '2019-01-10 10:31:47'),
(317, 200, 36, 0, 'd7698ca87898dfc826c7052360e9ce3f', 10, 1, 1, '2019-01-10 16:08:32', '2019-01-10 10:38:32'),
(318, 201, 36, 0, 'dbf30d0078942766b78de92271d1b9c7', 10, 1, 1, '2019-01-10 16:13:01', '2019-01-10 10:43:01'),
(319, 206, 36, 0, 'fe7e34660eb5bd24530bf76b42810243', 10, 1, 1, '2019-01-16 12:26:11', '2019-01-16 06:56:11'),
(320, 207, 36, 0, '12293eb10ffbed144eef0bc6ed741702', 10, 1, 1, '2019-01-16 12:27:29', '2019-01-16 06:57:29'),
(321, 208, 36, 0, '3035a8ad4e4e384863d935cad767cbd0', 10, 1, 1, '2019-01-16 12:31:18', '2019-01-16 07:01:18'),
(322, 1, 36, 0, '25f266de64d970cc1e81e1c0ed75ec5a', 10, 1, 1, '2019-01-16 15:59:21', '2019-01-16 10:29:21'),
(323, 37, 36, 0, '1c97e1f2a6c8fcf3ede5ef76963c6fb6', 10, 1, 1, '2019-01-18 18:04:10', '2019-01-18 12:34:10'),
(324, 38, 36, 0, '1448118e3541797137e9ca101f9bf420', 10, 1, 1, '2019-01-18 18:09:20', '2019-01-18 12:39:20'),
(325, 44, 36, 0, '29cb87ac633e97914a578c3ca9280f08', 10, 1, 1, '2019-01-19 10:11:59', '2019-01-19 04:41:59'),
(326, 51, 36, 0, '2390d557e36719791983fa5b0ea1d6ae', 10, 1, 1, '2019-01-19 11:51:10', '2019-01-19 06:21:10'),
(327, 52, 36, 0, '18921252e52ac51c5fcba2a70e436e69', 10, 1, 1, '2019-01-19 12:07:41', '2019-01-19 06:37:41'),
(328, 53, 36, 0, 'a23b4a2b44d2b8e0fd9fac11fe6047f2', 10, 1, 1, '2019-01-19 12:19:16', '2019-01-19 06:49:16'),
(329, 54, 36, 0, '5e4732c858595870e75ab1d05f718a43', 10, 1, 1, '2019-01-19 12:33:28', '2019-01-19 07:03:28'),
(330, 55, 36, 0, 'f7ba7c1f862a629cac9a8c9749c21bae', 10, 1, 1, '2019-01-19 12:38:15', '2019-01-19 07:08:15'),
(331, 58, 36, 0, '458fbe31a2821e681afd6aae7e5b3cd5', 10, 1, 1, '2019-01-19 12:45:19', '2019-01-19 07:15:19'),
(332, 61, 36, 0, 'ba8942ff6c7a9b560a14e2635f4b478c', 10, 1, 1, '2019-01-19 12:53:41', '2019-02-01 05:13:10'),
(333, 61, 35, 0, '74ffadcffe1825bc29aae7c934702c86', 10, 1, 1, '2019-01-29 12:28:38', '2019-01-29 06:58:38'),
(334, 61, 16, 0, '9111beb3b43e3d008b79878991466813', NULL, NULL, 1, '2019-01-29 18:06:27', '2019-01-29 12:51:04'),
(335, 61, 13, 0, '916a32befbaea2e0f410438719c99de1', NULL, NULL, 1, '2019-01-29 18:25:06', '2019-01-29 12:55:18'),
(336, 61, 27, 0, '3676e74737f43dd60fc9e0941ac076e5', 10, 1, 1, '2019-01-30 10:30:04', '2019-01-30 13:55:50'),
(337, 63, 36, 0, '8c7604f06a26f013670367ad01a6b3d7', 10, 1, 1, '2019-01-30 10:53:01', '2019-01-30 05:23:01'),
(338, 61, 0, 0, '37a6b419e3533df52692e01f05822c89', 10, 2, 1, '2019-02-01 10:43:15', '2019-02-05 11:35:01'),
(339, 65, 36, 0, '7a4c925e654e7e4e2922a6ef46ab896a', 10, 1, 1, '2019-04-25 17:31:55', '2019-04-25 12:01:56'),
(340, 66, 36, 0, '2a32f5a08924ec3e8f0071471678e04b', 10, 1, 1, '2019-04-25 17:39:19', '2019-04-25 12:09:20'),
(341, 67, 36, 0, 'd2dbc3fdc142006b4fd68c96d4ac4519', 10, 1, 1, '2019-04-25 18:15:47', '2019-04-25 12:45:48'),
(342, 67, 0, 0, 'cd276b235fbe3a630ddc10350321ec6e', 10, 2, 1, '2019-04-26 10:47:15', '2019-04-26 11:17:08'),
(343, 66, 0, 0, '22d87f5803cd5c700694f935a404926d', 10, 2, 1, '2019-04-26 10:47:19', '2019-04-26 11:17:12'),
(344, 66, 38, 0, '7d41997293340cdc4e06beee60d2918a', 10, 2, 1, '2019-04-26 15:18:57', '2019-04-26 09:48:57'),
(345, 66, 2, 0, '7d41997293340cdc4e06beee60d2918a', 10, 2, 1, '2019-04-26 15:18:57', '2019-04-26 09:48:57'),
(346, 66, 12, 0, 'a5a3b48c763672d377fb09bef5b13c17', 10, 2, 1, '2019-04-26 15:18:58', '2019-07-12 04:10:05'),
(347, 66, 35, 0, '3d511ab33a2bf637f26922e306cfb410', 10, 2, 1, '2019-04-26 15:25:57', '2019-04-26 10:04:42'),
(348, 69, 12, 0, '91a2e22e69ea6b3219b73d4bac05acf6', 10, 2, 1, '2019-06-05 11:56:47', '2019-06-05 06:26:47'),
(349, 70, 46, 0, 'f3bd5313a0a4df74515edcae7a58e741', 10, 2, 2, '2019-06-08 06:17:59', '2019-09-02 06:22:32'),
(350, 66, 5, 0, 'f963007d5be37abd0fb3e4dff373eee2', 10, 2, 1, '2019-06-12 14:58:04', '2019-06-12 09:28:04'),
(351, 178, 5, 0, '46b0c0feabe763f91355fed251e6b1be', 10, 2, 1, '2019-06-12 15:00:30', '2019-06-12 09:30:30'),
(352, 178, 46, 0, '3a860ade9e97be6d489fad273c398150', 10, 2, 2, '2019-06-12 15:09:29', '2019-07-16 10:34:22'),
(353, 178, 12, 0, '7ca081a39a4da3ba330026938c86bf5d', 10, 2, 1, '2019-06-17 17:12:43', '2019-06-17 11:42:43'),
(354, 2, 36, 0, '298240304cb7a86f8e0a16e0e7e914d4', 10, 2, 1, '2019-07-09 05:32:17', '2019-07-12 08:44:59'),
(355, 3, 36, 0, '9380633009fe8b2bb07a41f8c284bc60', 10, 2, 1, '2019-07-09 05:33:40', '2019-07-09 10:33:40'),
(356, 74, 12, 0, '9360fb66fed674b9977b76a659236c33', 10, 2, 1, '2019-07-09 06:03:28', '2019-07-09 11:03:28'),
(357, 9, 36, 0, '418df1795a3a324fbe50d03f587b9b60', 10, 2, 1, '2019-07-12 03:39:44', '2019-07-12 08:39:44'),
(358, 6, 36, 0, 'b29fd515531257bd29d055e231fbb050', 10, 2, 1, '2019-07-12 03:42:48', '2019-07-12 08:42:48'),
(359, 180, 36, 0, '8270cb9e807185c49ec14c234f093b94', 10, 1, 1, '2019-07-12 06:35:38', '2019-07-12 11:35:38'),
(360, 181, 36, 0, '16c4aa42b2b81d7ae7d2c52c1f88476c', 10, 1, 1, '2019-07-12 06:39:28', '2019-07-12 11:39:28'),
(361, 182, 36, 0, 'abf8aa42397f5fc31f205d2be3a00923', 10, 1, 1, '2019-07-12 06:42:50', '2019-07-12 11:42:50'),
(362, 1, 36, 0, '1f5506489476feca62dc86f659a73a1e', 10, 2, 1, '2019-07-12 06:57:41', '2019-07-12 11:57:41'),
(363, 182, 46, 0, '486713153c7bcbbc9f00ef7869aa5bc8', 10, 2, 1, '2019-07-16 03:44:20', '2019-08-29 10:10:06'),
(364, 66, 46, 0, 'b1d535268fa8cf838c47f063008fee55', 10, 2, 1, '2019-07-16 05:20:59', '2019-07-16 10:20:59'),
(365, 178, 46, 0, '3a860ade9e97be6d489fad273c398150', 10, 2, 2, '2019-07-16 05:26:51', '2019-07-16 10:34:22'),
(366, 67, 46, 0, '0f70df07927860162209c6cf5abc3f5b', 10, 2, 1, '2019-08-06 05:49:17', '2019-08-09 11:10:00'),
(367, 70, 46, 0, 'f3bd5313a0a4df74515edcae7a58e741', 10, 2, 2, '2019-08-17 23:57:25', '2019-09-02 06:22:32'),
(368, 70, 46, 0, 'f3bd5313a0a4df74515edcae7a58e741', 10, 2, 2, '2019-08-27 00:44:16', '2019-09-02 06:22:32'),
(369, 70, 46, 0, 'f3bd5313a0a4df74515edcae7a58e741', 10, 2, 2, '2019-08-28 06:23:37', '2019-09-02 06:28:20'),
(370, 178, 46, 0, '04945420cb3733b330c01fbf7fd64805', 10, 2, 1, '2019-08-28 23:39:41', '2019-08-29 04:39:41'),
(371, 11, 2, 0, '9198a6e08b5e63bed65e8c3ff89efd87', 10, 2, 1, '2019-09-01 00:56:43', '2019-09-01 05:56:46'),
(372, 11, 36, 0, '46cf187e4a02c3fc3be521124a709bba', 10, 2, 1, '2019-09-01 00:56:43', '2019-09-02 07:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_form`
--

CREATE TABLE `tbl_survey_form` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_language_type` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: For English, 2: Arabic',
  `survey_form_title` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `survey_title_background_color` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_form_header` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `survey_form_footer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `survey_form_logo` text CHARACTER SET latin1 NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: In-Active',
  `survey_title_font_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_header_font_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_footer_font_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_title_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_header_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_footer_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_background_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_background_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_question_font_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_question_font_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1: Deleted, 0: Not Deleted',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_survey_form`
--

INSERT INTO `tbl_survey_form` (`id`, `user_id`, `form_language_type`, `survey_form_title`, `survey_title_background_color`, `survey_form_header`, `survey_form_footer`, `survey_form_logo`, `status`, `survey_title_font_size`, `survey_header_font_size`, `survey_footer_font_size`, `survey_title_color`, `survey_header_color`, `survey_footer_color`, `survey_background_image`, `survey_background_color`, `survey_question_font_size`, `survey_question_font_color`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, 10, 1, 'New Survey', NULL, 'New Header', 'New Footer', 'public/uploads/survey_form_logo/Screenshotfrom2018-04-0514-27-25-6520180505140542.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-05-05 14:05:42', '2018-05-17 00:37:23'),
(2, 10, 2, 'Nagar Nigam Survey Form', NULL, 'Nagar Nigam Survey header', 'Nagar Nigam Survey footer', 'public/uploads/survey_form_logo/india-map-picture8-4720180502140524.gif', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-05-01 13:42:40', '2018-07-02 14:16:32'),
(4, 10, 1, 'Test', NULL, 'New test header', 'new test footer', 'public/uploads/survey_form_logo/fotopay-3920180505141134.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-05-05 14:11:34', '2018-05-28 05:33:34'),
(5, 10, 1, 'New survery', NULL, 'survery', 'Footer', 'public/uploads/survey_form_logo/download(1)-4920180505153934.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-05-05 15:39:34', '2018-05-05 10:09:34'),
(6, 10, 1, 'Customer Satisfaction', NULL, 'Help us to offer better service', 'Thanks, this is the end', 'public/uploads/survey_form_logo/CreatingSurveyError-8420180506060818.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-05-06 06:08:18', '2018-05-06 00:38:18'),
(7, 10, 1, 'Course Evaluation', NULL, 'Please rate our course', 'Thanks', 'public/uploads/survey_form_logo/CreatingSurveyError-5720180509064556.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-05-09 06:45:56', '2018-05-09 01:15:56'),
(8, 10, 1, 'Test', NULL, 'New test header', 'new test footer', 'public/uploads/survey_form_logo/Screenshotfrom2018-04-0514-27-25-6720180509103707.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-05-09 10:37:07', '2018-05-28 05:33:45'),
(9, 10, 1, 'Testing', NULL, 'Testing', 'Testing', 'public/uploads/survey_form_logo/Screenshotfrom2018-04-0514-27-25-6820180509104838.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-05-09 10:48:38', '2018-05-28 05:33:55'),
(10, 10, 1, 'New Digital Survey', NULL, 'New Survey Header', 'New Survey Footer', 'public/uploads/survey_form_logo/logo-4120180519105144.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-05-18 10:51:45', '2018-05-19 05:21:44'),
(11, 10, 2, '??? ????? ???????? - ??????? ??? ??????', NULL, '???? ?? ????? ????? ?????? . ???? ???????', '????', 'public/uploads/survey_form_logo/Tahsily-420180706061149.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-07-06 06:11:49', '2018-07-06 00:41:49'),
(12, 10, 2, 'Restaurant Eva', NULL, '. نتمنى ان نكةن عند حسن اخيركم لنا الرجاء تقييم التالي', 'شكرا على وقتكم الثمين', 'public/uploads/survey_form_logo/yoo-3720180714055323.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-07-14 05:53:23', '2018-07-14 11:53:23'),
(13, 10, 1, 'My live survey', NULL, 'Indias', 'Arebic', 'public/uploads/survey_form_logo/hero-banner-8320180717161006.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-07-17 16:10:06', '2018-07-17 22:10:15'),
(14, 10, 1, 'My FINALE SURVEY', NULL, 'FINALE', 'FINALE', 'public/uploads/survey_form_logo/ads-300x250-3920180730124348.gif', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-07-30 12:43:48', '2018-07-30 18:51:26'),
(15, 10, 1, 'Clemotion', NULL, 'Ind', 'Ind', 'public/uploads/survey_form_logo/ads-300x250-3220180730124756.gif', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-07-30 12:47:56', '2018-07-30 18:51:10'),
(16, 10, 1, 'Hard Core', NULL, 'Hard Core', 'Hard Core', 'public/uploads/survey_form_logo/MobileEducationStoreLogo-8220180730125104.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-07-30 12:51:04', '2018-07-30 18:51:19'),
(17, 10, 1, 'Clemotion', NULL, 'Indias', 'Ind', 'public/uploads/survey_form_logo/MobileEducationStoreLogo-8920180730125145.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-07-30 12:51:45', '2018-07-30 19:03:48'),
(18, 10, 1, 'Clemotion', NULL, 'Indias', 'Ind', 'public/uploads/survey_form_logo/MobileEducationStoreLogo-4420180730125547.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-07-30 12:55:47', '2018-07-30 19:03:44'),
(19, 10, 1, 'Clemotion', NULL, 'Indias', 'Ind', 'public/uploads/survey_form_logo/signupbnr-8420180730125948.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-07-30 12:59:48', '2018-07-30 19:03:39'),
(20, 10, 1, 'Clemotion', NULL, 'Indias', 'Ind', 'public/uploads/survey_form_logo/viewlogo-6320180730130309.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-07-30 13:03:09', '2018-07-30 19:03:33'),
(21, 10, 1, 'Clemotions', NULL, 'Indias', 'Ind', 'public/uploads/survey_form_logo/MobileEducationStoreLogo-6720180730130453.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-07-30 13:04:53', '2018-08-16 16:03:35'),
(22, 10, 1, 'test', NULL, 'test', 'test', 'public/uploads/survey_form_logo/beauty-bloom-blue-67636-7420180824082211.jpg', 1, '20px', '25px', '27px', '#2142f2', '#ebb018', '#e611aa', NULL, NULL, NULL, NULL, 0, '2018-08-24 08:22:11', '2018-08-24 14:27:03'),
(23, 10, 2, 'الرجاء تعبئة الستبيانة', NULL, 'نتمنى ان نكون عند حن ضنك بنا', 'شكرا يا حبيبي', 'public/uploads/survey_form_logo/Erjaan_New-Logo-2420180824102245.png', 1, '15px', '11px', '18px', '#fa9963', '#f24812', '#e88614', NULL, NULL, NULL, NULL, 0, '2018-08-24 10:22:45', '2018-08-24 16:22:45'),
(24, 10, 1, 'Kandarp', NULL, 'D9ithub', 'D9ithub', 'public/uploads/survey_form_logo/lion-420180827165006.jpg', 1, '18px', '16px', '14px', '#1426c9', '#09ad68', '#09993a', 'public/uploads/survey_form_logo/Joker-8920180827165006.jpg', '#eb2e72', '21px', '#780d9e', 0, '2018-08-27 16:50:06', '2018-08-27 22:50:06'),
(25, 10, 2, 'تقييم رضى العميل', NULL, '. نتمنى ان نكةن عند حسن اخيركم لنا الرجاء تقييم التالي', 'شكرا يا حبيبي', 'public/uploads/survey_form_logo/Erjaan_New-Logo-5920180828121153.png', 1, '38px', '18px', '10px', '#21f00f', '#5be058', '#5be058', NULL, '#f5b91e', '15px', '#f09427', 0, '2018-08-28 12:11:53', '2018-08-28 18:12:38'),
(26, 10, 2, 'برنامج التقييم المستمر لعملاء الأرجان', NULL, 'شركاء الأرجان هم مصدر فخر لنا و خدمتهم اولوية لهاذا نحرص على سماع اراء و مقترحات شركاء الأرحان', 'نشكر لكم هاذا التعاون', 'public/uploads/survey_form_logo/Erjaan_New-Logo-9320180901091135.png', 1, '20px', '15px', '15px', '#2377f5', NULL, NULL, 'public/uploads/survey_form_logo/testbackground-5220180901091135.png', NULL, '50px', NULL, 0, '2018-09-01 09:11:35', '2018-09-01 15:14:31'),
(27, 10, 2, 'استبيان شركة الأرجان', NULL, 'الرجاء تعبئة الأستبيان للحصول على كود الخصم', 'شكرا يا الأبقر', 'public/uploads/survey_form_logo/Erjaan_New-Logo-2720180905090646.png', 1, '33px', '24px', '50px', '#c4305c', '#6b4d5f', '#1f7885', 'public/uploads/survey_form_logo/s_025_gun_48_front-1120180906120402.jpg', NULL, '13px', NULL, 0, '2018-09-05 09:06:46', '2018-09-06 19:02:53'),
(28, 10, 1, 'DV', NULL, 'DV Header', 'DV Footer', 'public/uploads/survey_form_logo/cover_logo-6020180908162526.png', 1, '10px', '10px', '10px', '#b0127a', '#721b9c', '#7a1717', 'public/uploads/survey_form_logo/inner_bc2-8220180906124918.jpg', NULL, '6px', '#e02e84', 0, '2018-09-06 12:05:31', '2018-09-08 22:25:26'),
(29, 10, 1, 'kandarp', NULL, 'pandya', 'Ahmedabad', 'public/uploads/survey_form_logo/superman-8920180908162959.jpg', 1, '13px', '18px', '15px', '#114a9e', '#1f12b5', '#115180', 'public/uploads/survey_form_logo/inner_bc2-8020180906164043.jpg', NULL, NULL, NULL, 0, '2018-09-06 16:40:43', '2018-09-08 22:29:59'),
(30, 10, 1, 'S- Title1', NULL, 'S- Header1', 'S- Footer1', 'public/uploads/survey_form_logo/02-A-520180906171201.jpg', 1, '38px', '38px', '38px', '#1436eb', '#afc719', '#a3119d', 'public/uploads/survey_form_logo/AWWmaze-5020180906171201.jpg', NULL, NULL, NULL, 0, '2018-09-06 17:12:01', '2018-09-06 23:17:22'),
(31, 10, 1, 'Form- Title', NULL, 'Form- Header', 'Form-Footer', 'public/uploads/survey_form_logo/D9ITHub-Logo-01A-1420180907095007.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-09-07 09:50:07', '2018-09-07 15:55:07'),
(32, 10, 1, 'Form- Title', NULL, 'Form- Header', 'Form-Footer', 'public/uploads/survey_form_logo/D9ITHub-Logo-01A-8420180907095436.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'public/uploads/survey_form_logo/aoisos-1420180907095436.jpg', NULL, NULL, NULL, 1, '2018-09-07 09:54:36', '2018-09-07 15:55:25'),
(33, 10, 1, 'Form- Title-1', NULL, 'Form- Header-1', 'Form-Footer-1', 'public/uploads/survey_form_logo/bennettwine-8920180907100221.jpg', 1, '18px', '18px', '18px', '#ed0f87', '#1f0ede', '#24d3de', 'public/uploads/survey_form_logo/02-A-6720180907100221.jpg', '#0df7f7', NULL, NULL, 0, '2018-09-07 09:56:34', '2018-09-07 16:22:03'),
(34, 10, 2, 'RTL-TITLE-12', NULL, 'RTL-HEADER-12', 'RTL-FOOTER-12', 'public/uploads/survey_form_logo/Logo-AriseGroup-160217-8420180907102720.jpg', 1, '18px', '18px', '18px', '#ebf00f', '#65e005', '#e711eb', 'public/uploads/survey_form_logo/B-06-3120180907102720.jpg', '#0d0c0c', NULL, NULL, 0, '2018-09-07 10:27:20', '2018-09-07 16:30:43'),
(35, 10, 2, 'مركز سماء النخبة', NULL, 'استبيان تقييم دورة تدريبية', 'نشكر تعاونكم', 'public/uploads/survey_form_logo/SamaNTC-Logo-7720180908190502.png', 1, '25px', '18px', '18px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-09-08 15:35:50', '2018-09-09 01:05:03'),
(36, 10, 2, 'فلا سرايا', NULL, 'تقييم تجربة العميل', 'نشكر تعاونكم', 'public/uploads/survey_form_logo/IMG-20180909-WA0014-6120180909190021.jpg', 1, '30px', '23px', '18px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-09-09 19:00:21', '2018-09-10 01:08:34'),
(37, 10, 1, 'clean is green', NULL, 'clean around your.', 'clean', 'public/uploads/survey_form_logo/daylight-forest-nature-589802-6920180918113514.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'public/uploads/survey_form_logo/download(1)-120180918113514.jpg', NULL, NULL, NULL, 1, '2018-09-18 11:35:14', '2018-09-18 18:52:38'),
(38, 10, 1, 'DV Test', NULL, 'Header', 'Footer', 'public/uploads/survey_form_logo/logo-2620180717170137-5520180918125428.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'public/uploads/survey_form_logo/logo-2620180717170137-8520180918125428.png', NULL, NULL, NULL, 0, '2018-09-18 12:54:29', '2018-09-18 18:54:29'),
(39, 10, 1, 'amit', NULL, 'amit', 'amit', 'public/uploads/survey_form_logo/blowballs-close-up-dandelion-132419-120180921140635.jpg', 1, '35px', '15px', '18px', '#3426cf', '#e02ea4', '#5bd92e', 'public/uploads/survey_form_logo/beautiful-blooming-blossom-992734-7120180921140635.jpg', NULL, NULL, NULL, 0, '2018-09-21 14:06:35', '2018-09-21 20:06:35'),
(40, 10, 1, 'Patel\'s survey', NULL, 'SH-1', 'SF-1', 'public/uploads/survey_form_logo/aoisos-6620180924102639.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'public/uploads/survey_form_logo/02-A-5520180924102639.jpg', NULL, NULL, NULL, 0, '2018-09-24 10:26:39', '2018-09-24 16:26:39'),
(41, 10, 1, 'Amit\'s latest survey', NULL, 'SH-1', 'SF-1', 'public/uploads/survey_form_logo/D9ITHub-Logo-01A-5520180924110719.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'public/uploads/survey_form_logo/B-06-420180924110719.jpg', NULL, NULL, NULL, 0, '2018-09-24 11:07:19', '2018-09-24 18:05:52'),
(42, 10, 1, 'test', NULL, 'test', 'test', 'public/uploads/survey_form_logo/adorable-baby-child-789786-1520190605152028.jpg', 1, NULL, '1px', '1px', NULL, '#000000', '#000000', 'public/uploads/survey_form_logo/adult-art-attractive-730054-120190605152028.jpg', NULL, NULL, NULL, 0, '2019-06-05 15:20:28', '2019-06-05 09:50:28'),
(43, 10, 1, 'test', NULL, 'test', 'test', 'public/uploads/survey_form_logo/adorable-baby-child-789786-9020190605152133.jpg', 1, NULL, '1px', '1px', NULL, '#000000', '#000000', 'public/uploads/survey_form_logo/adult-art-attractive-730054-520190605152133.jpg', NULL, NULL, NULL, 0, '2019-06-05 15:21:33', '2019-06-05 09:51:33'),
(44, 10, 1, 'test', NULL, 'test', 'test', 'public/uploads/survey_form_logo/adorable-baby-child-789786-7620190605152212.jpg', 1, NULL, '1px', '1px', NULL, '#000000', '#000000', 'public/uploads/survey_form_logo/adult-art-attractive-730054-3820190605152212.jpg', NULL, NULL, NULL, 0, '2019-06-05 15:22:12', '2019-06-05 09:52:12'),
(45, 10, 1, 'D9 ithube', NULL, 'Header', 'Footer', 'uploads/survey_form_logo/beautiful-beauty-child-1139613-7120190829035605.jpg', 1, '1px', '1px', '1px', '#992727', '#394b8c', '#b59454', 'uploads/survey_form_logo/1504085810-320190829035605.jpg', '#df1ba2', NULL, NULL, 0, '2019-06-05 17:43:57', '2019-08-29 08:58:44'),
(46, 10, 2, 'تقييم زيارة', '#cf0000', 'يسعدنا اخذ تقييم زيارتكم لتحسين الخدمة', 'نشكر تعاونكم و نعدكم بالأفضل', 'uploads/survey_form_logo/logo-320190828112257.png', 1, NULL, NULL, NULL, '#26b1ba', NULL, NULL, NULL, '#30743d', NULL, NULL, 0, '2019-06-08 16:45:21', '2019-09-02 11:21:10'),
(47, 10, 1, 'Test My Title', NULL, 'Form Header', 'Form Footer', 'uploads/survey_form_logo/kabir-singh-4820190709103622.jpg', 1, '10px', '10px', '9px', '#961212', '#2b7c74', '#3e6e32', 'uploads/survey_form_logo/bharat-6320190709103622.jpg', '#599387', NULL, NULL, 0, '2019-07-09 10:36:22', '2019-07-09 15:36:22'),
(48, 10, 1, 'Survay Title', NULL, 'Survey Heade', 'Survey Footer', 'uploads/survey_form_logo/kabir-singh-2720190710062108.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/survey_form_logo/bharat-6120190710062108.jpg', NULL, NULL, NULL, 1, '2019-07-10 06:21:08', '2019-07-12 09:08:12'),
(49, 10, 1, 'Test 123', NULL, 'test 456', 'test 789', 'uploads/survey_form_logo/kabir-singh-1820190712040636.jpg', 1, '12px', '12px', '15px', '#23611e', '#5d2121', '#3d4526', 'uploads/survey_form_logo/bharat-8020190712040636.jpg', '#08744a', NULL, NULL, 1, '2019-07-12 04:06:36', '2019-07-12 09:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_form_info`
--

CREATE TABLE `tbl_survey_form_info` (
  `id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `survey_question` text COLLATE utf8_unicode_ci NOT NULL,
  `option_value` varchar(155) CHARACTER SET latin1 NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `survey_answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_rating_answer` varchar(50) CHARACTER SET latin1 NOT NULL,
  `question_type` varchar(155) CHARACTER SET latin1 NOT NULL,
  `token` text CHARACTER SET latin1 NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: In-Active',
  `submitted_by` int(11) DEFAULT NULL COMMENT '0 = ''participant'',1 = ''customer''',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_survey_form_info`
--

INSERT INTO `tbl_survey_form_info` (`id`, `participant_id`, `form_id`, `question_id`, `survey_question`, `option_value`, `answer`, `survey_answer`, `start_rating_answer`, `question_type`, `token`, `status`, `submitted_by`, `created_at`, `updated_at`) VALUES
(1, 11, 12, 188, 'How as our service today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:9:\"Excellent\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Excellent', '', '1', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', 1, NULL, '2018-06-02 00:00:00', '2018-07-25 14:57:21'),
(2, 1, 2, 189, 'How is our staff today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:8:\"Friendly\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"4\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Friendly', '', '1', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:44:57'),
(3, 1, 2, 190, 'What is your language', '', 'a:4:{s:6:\"answer\";a:3:{i:0;s:3:\"Php\";i:1;s:10:\"Javascript\";i:2;s:7:\"Angular\";}s:12:\"option_point\";a:3:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}i:1;a:1:{s:12:\"option_point\";s:1:\"4\";}i:2;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '3', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', 1, NULL, '2018-06-02 00:00:00', '2018-07-30 09:37:36'),
(4, 1, 2, 191, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:44:57'),
(5, 1, 2, 192, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:44:57'),
(6, 3, 2, 188, 'How as our service today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Good\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Good', '', '1', '05b015cd646c40f7d972dbdbc12c1483', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:45:42'),
(7, 3, 2, 189, 'How is our staff today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:10:\"Aggressive\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Aggressive', '', '1', '05b015cd646c40f7d972dbdbc12c1483', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:45:42'),
(8, 3, 2, 190, 'What is your language', '', 'a:4:{s:6:\"answer\";a:4:{i:0;s:3:\"Php\";i:1;s:10:\"Javascript\";i:2;s:7:\"Angular\";i:3;s:3:\"ROR\";}s:12:\"option_point\";a:4:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}i:2;a:1:{s:12:\"option_point\";s:1:\"4\";}i:3;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '4', '05b015cd646c40f7d972dbdbc12c1483', 1, NULL, '2018-06-02 00:00:00', '2018-07-30 09:37:42'),
(9, 3, 2, 191, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '05b015cd646c40f7d972dbdbc12c1483', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:45:42'),
(10, 3, 2, 192, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '05b015cd646c40f7d972dbdbc12c1483', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:45:42'),
(11, 6, 2, 188, 'How as our service today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:3:\"Bad\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Bad', '', '1', '68cfb0d02f5029ed21c3951945e52d30', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:46:13'),
(12, 6, 2, 189, 'How is our staff today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:8:\"Ignorant\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Ignorant', '', '1', '68cfb0d02f5029ed21c3951945e52d30', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:46:13'),
(13, 6, 2, 190, 'What is your language', '', 'a:4:{s:6:\"answer\";a:4:{i:0;s:10:\"Javascript\";i:1;s:7:\"Angular\";i:2;s:3:\"ROR\";i:3;s:6:\"Others\";}s:12:\"option_point\";a:4:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}i:1;a:1:{s:12:\"option_point\";s:1:\"2\";}i:2;a:1:{s:12:\"option_point\";s:1:\"3\";}i:3;a:1:{s:12:\"option_point\";s:1:\"4\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '68cfb0d02f5029ed21c3951945e52d30', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:46:13'),
(14, 6, 2, 191, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '68cfb0d02f5029ed21c3951945e52d30', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:46:13'),
(15, 6, 2, 192, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '68cfb0d02f5029ed21c3951945e52d30', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:46:13'),
(16, 3, 2, 188, 'How as our service today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Poor\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Poor', '', '1', '4e97338dc2f5aa611ee4a3629f214ccd', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:57:42'),
(17, 3, 2, 189, 'How is our staff today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:7:\"Helpful\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Helpful', '', '1', '4e97338dc2f5aa611ee4a3629f214ccd', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:57:42'),
(18, 3, 2, 190, 'What is your language', '', 'a:4:{s:6:\"answer\";a:3:{i:0;s:3:\"Php\";i:1;s:7:\"Angular\";i:2;s:3:\"ROR\";}s:12:\"option_point\";a:3:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}i:2;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '4e97338dc2f5aa611ee4a3629f214ccd', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:57:42'),
(19, 3, 2, 191, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '4e97338dc2f5aa611ee4a3629f214ccd', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:57:42'),
(20, 3, 2, 192, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '4e97338dc2f5aa611ee4a3629f214ccd', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:57:42'),
(21, 6, 2, 188, 'How as our service today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:9:\"Excellent\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Excellent', '', '1', '76032055b3581c1ab1fb0c4e8f316881', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:14'),
(22, 6, 2, 189, 'How is our staff today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:10:\"Aggressive\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Aggressive', '', '1', '76032055b3581c1ab1fb0c4e8f316881', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:14'),
(23, 6, 2, 190, 'What is your language', '', 'a:4:{s:6:\"answer\";a:3:{i:0;s:3:\"Php\";i:1;s:7:\"Angular\";i:2;s:3:\"ROR\";}s:12:\"option_point\";a:3:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}i:2;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '76032055b3581c1ab1fb0c4e8f316881', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:14'),
(24, 6, 2, 191, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '76032055b3581c1ab1fb0c4e8f316881', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:14'),
(25, 6, 2, 192, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '76032055b3581c1ab1fb0c4e8f316881', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:14'),
(26, 1, 2, 188, 'How as our service today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Poor\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Poor', '', '1', '5b9190ec4970c85b7a3668800f3ae6c6', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:42'),
(27, 1, 2, 189, 'How is our staff today', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:7:\"Helpful\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Helpful', '', '1', '5b9190ec4970c85b7a3668800f3ae6c6', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:42'),
(28, 1, 2, 190, 'What is your language', '', 'a:4:{s:6:\"answer\";a:3:{i:0;s:10:\"Javascript\";i:1;s:3:\"ROR\";i:2;s:6:\"Others\";}s:12:\"option_point\";a:3:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}i:1;a:1:{s:12:\"option_point\";s:1:\"2\";}i:2;a:1:{s:12:\"option_point\";s:1:\"4\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '5b9190ec4970c85b7a3668800f3ae6c6', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:42'),
(29, 1, 2, 191, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '5b9190ec4970c85b7a3668800f3ae6c6', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:42'),
(30, 1, 2, 192, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '5b9190ec4970c85b7a3668800f3ae6c6', 1, NULL, '2018-06-02 00:00:00', '2018-06-02 05:58:42'),
(31, 6, 7, 90, 'how was the content', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:40:\"amazing teacher, with a lot of knowledge\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:19:\"how was the content\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '8460677a0132254b7db4327683ed31f6', 1, NULL, '2018-06-03 00:00:00', '2018-06-03 11:44:52'),
(32, 6, 7, 91, 'How was the teacher?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:20:\"How was the teacher?\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '8460677a0132254b7db4327683ed31f6', 1, NULL, '2018-06-03 00:00:00', '2018-06-03 11:44:52'),
(33, 6, 7, 92, 'how was the facilities?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:23:\"how was the facilities?\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '8460677a0132254b7db4327683ed31f6', 1, NULL, '2018-06-03 00:00:00', '2018-06-03 11:44:52'),
(34, 9, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '9f3d97fd7edd75653bd4261c98bed972', 1, NULL, '2018-07-14 00:00:00', '2018-07-14 05:56:40'),
(35, 9, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '9f3d97fd7edd75653bd4261c98bed972', 1, NULL, '2018-07-14 00:00:00', '2018-07-14 05:56:40'),
(36, 9, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '9f3d97fd7edd75653bd4261c98bed972', 1, NULL, '2018-07-14 00:00:00', '2018-07-14 05:56:40'),
(37, 9, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:25:\"الطلبات تتاخر\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', '9f3d97fd7edd75653bd4261c98bed972', 1, NULL, '2018-07-14 00:00:00', '2018-07-14 05:56:40'),
(38, 11, 5, 178, 'What is your language', '', 'a:4:{s:6:\"answer\";a:3:{i:0;s:7:\"Angular\";i:1;s:3:\"Php\";i:2;s:13:\"Others or All\";}s:12:\"option_point\";a:3:{i:0;a:1:{s:12:\"option_point\";s:1:\"4\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}i:2;a:1:{s:12:\"option_point\";s:1:\"2\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '177631fe55a0482a8c36248d2affa0cb', 1, NULL, '2018-07-27 00:00:00', '2018-07-27 09:17:26'),
(39, 11, 5, 179, 'What is software service', '', 'a:4:{s:6:\"answer\";a:2:{i:0;s:9:\"Usebility\";i:1;s:7:\"Utility\";}s:12:\"option_point\";a:2:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:24:\"What is software service\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '177631fe55a0482a8c36248d2affa0cb', 1, NULL, '2018-07-27 00:00:00', '2018-07-27 09:17:26'),
(40, 11, 2, 180, 'What is your location', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:21:\"Hi I am from indore..\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:21:\"What is your location\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '177631fe55a0482a8c36248d2affa0cb', 1, NULL, '2018-07-27 00:00:00', '2018-07-27 09:54:04'),
(41, 3, 5, 178, 'What is your language', '', 'a:4:{s:6:\"answer\";a:2:{i:0;s:4:\"Java\";i:1;s:7:\"Angular\";}s:12:\"option_point\";a:2:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}i:1;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', 'd75b01b0ce4a0a8b0018b7b5f1b0c86d', 1, NULL, '2018-07-27 00:00:00', '2018-07-27 09:17:44'),
(42, 3, 5, 179, 'What is software service', '', 'a:4:{s:6:\"answer\";a:2:{i:0;s:5:\"Price\";i:1;s:7:\"Support\";}s:12:\"option_point\";a:2:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}i:1;a:1:{s:12:\"option_point\";s:1:\"4\";}}s:15:\"survey_question\";s:24:\"What is software service\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', 'd75b01b0ce4a0a8b0018b7b5f1b0c86d', 1, NULL, '2018-07-27 00:00:00', '2018-07-27 09:17:44'),
(43, 3, 2, 180, 'What is your location', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:20:\"Hi I am from bhopal.\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:21:\"What is your location\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'd75b01b0ce4a0a8b0018b7b5f1b0c86d', 1, NULL, '2018-07-27 00:00:00', '2018-07-27 09:48:21'),
(44, 11, 21, 213, 'How many of you like this portal (with suggestions) ?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:53:\"How many of you like this portal (with suggestions) ?\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', 'c4307640318a20426e6cc61b173de83f', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:06:20'),
(45, 11, 21, 214, 'How many years old are you ?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:2:\"25\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:28:\"How many years old are you ?\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'c4307640318a20426e6cc61b173de83f', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:06:20'),
(46, 11, 21, 215, 'The Sangai Festival is celebrated in ?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:12:\"Diwali, Holi\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:38:\"The Sangai Festival is celebrated in ?\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', 'c4307640318a20426e6cc61b173de83f', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:06:20'),
(47, 11, 2, 216, 'How as our service today', '5', 'a:4:{s:6:\"answer\";a:1:{i:0;s:9:\"Excellent\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Excellent', '', '1', '4ddc4826af76002f88a3cfe260099bea', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:09:01'),
(48, 11, 2, 217, 'How is our staff today', '1', 'a:4:{s:6:\"answer\";a:1:{i:0;s:7:\"Helpful\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Helpful', '', '1', '4ddc4826af76002f88a3cfe260099bea', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:09:01'),
(49, 11, 2, 218, 'What is your language', '', 'a:4:{s:6:\"answer\";a:3:{i:0;s:10:\"Javascript\";i:1;s:3:\"ROR\";i:2;s:6:\"Others\";}s:12:\"option_point\";a:3:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}i:1;a:1:{s:12:\"option_point\";s:1:\"2\";}i:2;a:1:{s:12:\"option_point\";s:1:\"4\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '4ddc4826af76002f88a3cfe260099bea', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:09:01'),
(50, 11, 2, 219, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '4ddc4826af76002f88a3cfe260099bea', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:09:01'),
(51, 11, 2, 220, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '4ddc4826af76002f88a3cfe260099bea', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:09:01'),
(52, 11, 2, 221, 'How many of you like this portal (with suggestions) ?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:27:\"Hi I am here for Your Help.\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:53:\"How many of you like this portal (with suggestions) ?\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '4ddc4826af76002f88a3cfe260099bea', 1, NULL, '2018-07-30 00:00:00', '2018-07-30 10:09:01'),
(53, 15, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '3c91ba5440c2f58abe17fd23ae10d4f0', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:39:43'),
(54, 15, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '3c91ba5440c2f58abe17fd23ae10d4f0', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:39:43'),
(55, 15, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '3c91ba5440c2f58abe17fd23ae10d4f0', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:39:43'),
(56, 15, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', '3c91ba5440c2f58abe17fd23ae10d4f0', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:39:43'),
(57, 15, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9a9faa590137dba7568deb4c08e5201b', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:42:30'),
(58, 15, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9a9faa590137dba7568deb4c08e5201b', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:42:30'),
(59, 15, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9a9faa590137dba7568deb4c08e5201b', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:42:30'),
(60, 15, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"poor\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', '9a9faa590137dba7568deb4c08e5201b', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:42:30'),
(61, 14, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '2b1b8e801649709d6c771d34c9d351fc', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:49:44'),
(62, 14, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '2b1b8e801649709d6c771d34c9d351fc', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:49:44'),
(63, 14, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '2b1b8e801649709d6c771d34c9d351fc', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:49:44'),
(64, 14, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:8:\"nice one\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', '2b1b8e801649709d6c771d34c9d351fc', 1, NULL, '2018-08-29 00:00:00', '2018-08-29 08:49:44'),
(65, 13, 5, 178, 'What is your language', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:3:\"Php\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"4\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '4fcb5477a2e5228d6c99e12025851140', 1, NULL, '2018-09-06 00:00:00', '2018-09-06 05:23:21'),
(66, 13, 5, 179, 'What is software service', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:5:\"Price\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:24:\"What is software service\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '4fcb5477a2e5228d6c99e12025851140', 1, NULL, '2018-09-06 00:00:00', '2018-09-06 05:23:21'),
(67, 13, 5, 180, 'What is your location', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"modasa\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:21:\"What is your location\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '4fcb5477a2e5228d6c99e12025851140', 1, NULL, '2018-09-06 00:00:00', '2018-09-06 05:23:21'),
(68, 16, 5, 178, 'What is your language', '', 'a:4:{s:6:\"answer\";a:4:{i:0;s:4:\"Java\";i:1;s:7:\"Angular\";i:2;s:3:\"Php\";i:3;s:13:\"Others or All\";}s:12:\"option_point\";a:4:{i:0;a:1:{s:12:\"option_point\";s:1:\"4\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}i:2;a:1:{s:12:\"option_point\";s:1:\"2\";}i:3;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '4b1686a6a6691bb148799bcb5441b73c', 1, NULL, '2018-09-06 00:00:00', '2018-09-06 05:24:45'),
(69, 16, 5, 179, 'What is software service', '', 'a:4:{s:6:\"answer\";a:4:{i:0;s:5:\"Price\";i:1;s:9:\"Usebility\";i:2;s:7:\"Utility\";i:3;s:7:\"Support\";}s:12:\"option_point\";a:4:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}i:1;a:1:{s:12:\"option_point\";s:1:\"2\";}i:2;a:1:{s:12:\"option_point\";s:1:\"3\";}i:3;a:1:{s:12:\"option_point\";s:1:\"4\";}}s:15:\"survey_question\";s:24:\"What is software service\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '4b1686a6a6691bb148799bcb5441b73c', 1, NULL, '2018-09-06 00:00:00', '2018-09-06 05:24:45'),
(70, 16, 5, 180, 'What is your location', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:9:\"ahmedabad\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:21:\"What is your location\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '4b1686a6a6691bb148799bcb5441b73c', 1, NULL, '2018-09-06 00:00:00', '2018-09-06 05:24:45'),
(71, 13, 29, 279, 'one', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"test\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}}s:15:\"survey_question\";s:3:\"one\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '4affa5eb0055732f723556f0f261dd23', 1, NULL, '2018-09-08 00:00:00', '2018-09-08 12:57:30'),
(72, 13, 29, 280, 'two', '2', 'a:4:{s:6:\"answer\";a:1:{i:0;s:5:\"test2\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}}s:15:\"survey_question\";s:3:\"two\";s:13:\"question_type\";s:1:\"1\";}', 'test2', '', '1', '4affa5eb0055732f723556f0f261dd23', 1, NULL, '2018-09-08 00:00:00', '2018-09-08 12:57:30'),
(73, 13, 29, 281, 'three', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:5:\"test3\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}}s:15:\"survey_question\";s:5:\"three\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '4affa5eb0055732f723556f0f261dd23', 1, NULL, '2018-09-08 00:00:00', '2018-09-08 12:57:30'),
(74, 28, 35, 417, 'المستوى المعرفي للمدرب', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"المستوى المعرفي للمدرب\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '8d587883949b576857aa152f936c6d06', 1, NULL, '2018-09-09 00:00:00', '2018-09-09 13:43:14'),
(75, 28, 35, 418, 'المادة التعليمية', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:31:\"المادة التعليمية\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '8d587883949b576857aa152f936c6d06', 1, NULL, '2018-09-09 00:00:00', '2018-09-09 13:43:14'),
(76, 28, 35, 419, 'جاهزية القاعة التدريبية', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:44:\"جاهزية القاعة التدريبية\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '8d587883949b576857aa152f936c6d06', 1, NULL, '2018-09-09 00:00:00', '2018-09-09 13:43:14'),
(77, 28, 35, 420, 'مستوى الأستفادة من الدورة التدريبية', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:66:\"مستوى الأستفادة من الدورة التدريبية\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '8d587883949b576857aa152f936c6d06', 1, NULL, '2018-09-09 00:00:00', '2018-09-09 13:43:14'),
(78, 28, 35, 421, 'هل تنصح بالدورة التدريبية لصديق', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:58:\"هل تنصح بالدورة التدريبية لصديق\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '8d587883949b576857aa152f936c6d06', 1, NULL, '2018-09-09 00:00:00', '2018-09-09 13:43:14'),
(79, 28, 35, 422, 'هل انت مهتم بدورات اخرى من مركز سماء النخبة', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:78:\"هل انت مهتم بدورات اخرى من مركز سماء النخبة\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '8d587883949b576857aa152f936c6d06', 1, NULL, '2018-09-09 00:00:00', '2018-09-09 13:43:14'),
(80, 28, 35, 423, 'اقتراحاتكم تهمنا لتحسين جودة الدورات التدريبية', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:16:\"ماقصرتوا\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:87:\"اقتراحاتكم تهمنا لتحسين جودة الدورات التدريبية\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '8d587883949b576857aa152f936c6d06', 1, NULL, '2018-09-09 00:00:00', '2018-09-09 13:43:14'),
(81, 38, 2, 216, 'How as our service today', '5', 'a:4:{s:6:\"answer\";a:1:{i:0;s:9:\"Excellent\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Excellent', '', '1', '5f8bc670f14265b78e87478d3f0585f6', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:02:33'),
(82, 38, 2, 217, 'How is our staff today', '4', 'a:4:{s:6:\"answer\";a:1:{i:0;s:8:\"Friendly\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"4\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Friendly', '', '1', '5f8bc670f14265b78e87478d3f0585f6', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:02:33'),
(83, 38, 2, 218, 'What is your language', '', 'a:4:{s:6:\"answer\";a:4:{i:0;s:3:\"Php\";i:1;s:10:\"Javascript\";i:2;s:7:\"Angular\";i:3;s:3:\"ROR\";}s:12:\"option_point\";a:4:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}i:2;a:1:{s:12:\"option_point\";s:1:\"4\";}i:3;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '5f8bc670f14265b78e87478d3f0585f6', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:02:33'),
(84, 38, 2, 219, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '5f8bc670f14265b78e87478d3f0585f6', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:02:33'),
(85, 38, 2, 220, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '5f8bc670f14265b78e87478d3f0585f6', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:02:33'),
(86, 38, 2, 221, 'How many of you like this portal (with suggestions) ?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:17:\"this is for test.\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:53:\"How many of you like this portal (with suggestions) ?\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '5f8bc670f14265b78e87478d3f0585f6', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:02:33'),
(87, 13, 2, 216, 'How as our service today', '5', 'a:4:{s:6:\"answer\";a:1:{i:0;s:9:\"Excellent\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Excellent', '', '1', 'bbf2304298ceedde79b7d355a306478d', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:13:31'),
(88, 13, 2, 217, 'How is our staff today', '1', 'a:4:{s:6:\"answer\";a:1:{i:0;s:7:\"Helpful\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Helpful', '', '1', 'bbf2304298ceedde79b7d355a306478d', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:13:31'),
(89, 13, 2, 218, 'What is your language', '', 'a:4:{s:6:\"answer\";a:3:{i:0;s:3:\"Php\";i:1;s:10:\"Javascript\";i:2;s:7:\"Angular\";}s:12:\"option_point\";a:3:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}i:1;a:1:{s:12:\"option_point\";s:1:\"4\";}i:2;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', 'bbf2304298ceedde79b7d355a306478d', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:13:31'),
(90, 13, 2, 219, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'bbf2304298ceedde79b7d355a306478d', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:13:31'),
(91, 13, 2, 220, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', 'bbf2304298ceedde79b7d355a306478d', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:13:31'),
(92, 13, 2, 221, 'How many of you like this portal (with suggestions) ?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:44:\"testetststrdrtdrtrdtarrtertrtgdfghghjfgdrygr\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:53:\"How many of you like this portal (with suggestions) ?\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'bbf2304298ceedde79b7d355a306478d', 1, NULL, '2018-09-12 00:00:00', '2018-09-12 10:13:31'),
(93, 38, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'fc0f090e06ca8a982c975795aebb0ad9', 1, NULL, '2018-09-13 00:00:00', '2018-09-13 09:14:38'),
(94, 38, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'fc0f090e06ca8a982c975795aebb0ad9', 1, NULL, '2018-09-13 00:00:00', '2018-09-13 09:14:38'),
(95, 38, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'fc0f090e06ca8a982c975795aebb0ad9', 1, NULL, '2018-09-13 00:00:00', '2018-09-13 09:14:38'),
(96, 38, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:17:\"this is the test.\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', 'fc0f090e06ca8a982c975795aebb0ad9', 1, NULL, '2018-09-13 00:00:00', '2018-09-13 09:14:38'),
(97, 13, 5, 178, 'What is your language', '', 'a:4:{s:6:\"answer\";a:4:{i:0;s:4:\"Java\";i:1;s:7:\"Angular\";i:2;s:3:\"Php\";i:3;s:13:\"Others or All\";}s:12:\"option_point\";a:4:{i:0;a:1:{s:12:\"option_point\";s:1:\"4\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}i:2;a:1:{s:12:\"option_point\";s:1:\"2\";}i:3;a:1:{s:12:\"option_point\";s:1:\"1\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', 'c907cf6c031e04e65a7370579dda802e', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 10:37:06'),
(98, 13, 5, 179, 'What is software service', '', 'a:4:{s:6:\"answer\";a:2:{i:0;s:5:\"Price\";i:1;s:7:\"Utility\";}s:12:\"option_point\";a:2:{i:0;a:1:{s:12:\"option_point\";s:1:\"1\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:24:\"What is software service\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', 'c907cf6c031e04e65a7370579dda802e', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 10:37:06'),
(99, 13, 5, 180, 'What is your location', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:9:\"ahmedabad\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:21:\"What is your location\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'c907cf6c031e04e65a7370579dda802e', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 10:37:06'),
(100, 13, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'd1cb8db99a0d5fd30d8409cd39055dd9', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 12:39:26'),
(101, 13, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'd1cb8db99a0d5fd30d8409cd39055dd9', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 12:39:26'),
(102, 13, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'd1cb8db99a0d5fd30d8409cd39055dd9', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 12:39:26'),
(103, 13, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:14:\"kandarp pandya\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', 'd1cb8db99a0d5fd30d8409cd39055dd9', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 12:39:26'),
(104, 13, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c5418245a93d2b6f0c015a67981ac334', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 12:40:38'),
(105, 13, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c5418245a93d2b6f0c015a67981ac334', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 12:40:38'),
(106, 13, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c5418245a93d2b6f0c015a67981ac334', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 12:40:38'),
(107, 13, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:34:\"rdytdrtdrtfhgdhjhjkghgfgkfjkgffjuf\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', 'c5418245a93d2b6f0c015a67981ac334', 1, NULL, '2018-09-17 00:00:00', '2018-09-17 12:40:38'),
(140, 13, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'c58be1227de6912b76afb2969561d90d', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 07:14:33'),
(141, 13, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'c58be1227de6912b76afb2969561d90d', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 07:14:33'),
(142, 13, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'c58be1227de6912b76afb2969561d90d', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 07:14:33'),
(143, 13, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"لا\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'لا', '', '1', 'c58be1227de6912b76afb2969561d90d', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 07:14:33'),
(144, 13, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:10:\"gyjhghjhgj\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'c58be1227de6912b76afb2969561d90d', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 07:14:33'),
(145, 73, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '88b2fbe2ab0dc9e186a55ac046405761', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 08:41:56'),
(146, 73, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '88b2fbe2ab0dc9e186a55ac046405761', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 08:41:56'),
(147, 73, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '88b2fbe2ab0dc9e186a55ac046405761', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 08:41:56'),
(148, 73, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '88b2fbe2ab0dc9e186a55ac046405761', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 08:41:56'),
(149, 73, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:58:\"المعرض جميل ولاكن الانارة ضعيفة\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '88b2fbe2ab0dc9e186a55ac046405761', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 08:41:56'),
(150, 74, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9d0c88867a24d2a4c4719eba7ad45234', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:40:05'),
(151, 74, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '9d0c88867a24d2a4c4719eba7ad45234', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:40:05'),
(152, 74, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '9d0c88867a24d2a4c4719eba7ad45234', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:40:05'),
(153, 74, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '9d0c88867a24d2a4c4719eba7ad45234', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:40:05'),
(154, 74, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:75:\"التوصيل تاخر عند الموعد و الموظف ما كلمني\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '9d0c88867a24d2a4c4719eba7ad45234', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:40:05'),
(155, 75, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '6c4220590d12dd615dcd3aa5da178db4', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:43:17'),
(156, 75, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '6c4220590d12dd615dcd3aa5da178db4', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:43:17'),
(157, 75, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '6c4220590d12dd615dcd3aa5da178db4', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:43:17'),
(158, 75, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '6c4220590d12dd615dcd3aa5da178db4', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:43:17'),
(159, 75, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:54:\"رخام أرضيات محتاج تشكيلة اكبر\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '6c4220590d12dd615dcd3aa5da178db4', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:43:17'),
(160, 13, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '8c6d5f66c4aa7e73fb67cdaa4897ff59', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:51:35'),
(161, 13, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '8c6d5f66c4aa7e73fb67cdaa4897ff59', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:51:35'),
(162, 13, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '8c6d5f66c4aa7e73fb67cdaa4897ff59', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:51:35'),
(163, 13, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:70:\"kiuyivjgvjkhkjhjjhgvjhgjhgvjhgvbhgitfjvbmjjhgkutgmnbjhmhbjhgkjhuyfkjhg\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', '8c6d5f66c4aa7e73fb67cdaa4897ff59', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:51:35'),
(164, 76, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'ebc7d85d28a49e90028ce4917369ad84', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:59:10'),
(165, 76, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'ebc7d85d28a49e90028ce4917369ad84', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:59:10'),
(166, 76, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'ebc7d85d28a49e90028ce4917369ad84', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:59:10'),
(167, 76, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'ebc7d85d28a49e90028ce4917369ad84', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:59:10'),
(168, 76, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:29:\"يعطيكم العافيه .\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'ebc7d85d28a49e90028ce4917369ad84', 1, NULL, '2018-09-19 00:00:00', '2018-09-19 09:59:10'),
(169, 78, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'fbb23af374ec503b2d6b0bd75be21ba5', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 04:00:24'),
(170, 78, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'fbb23af374ec503b2d6b0bd75be21ba5', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 04:00:24'),
(171, 78, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'fbb23af374ec503b2d6b0bd75be21ba5', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 04:00:24');
INSERT INTO `tbl_survey_form_info` (`id`, `participant_id`, `form_id`, `question_id`, `survey_question`, `option_value`, `answer`, `survey_answer`, `start_rating_answer`, `question_type`, `token`, `status`, `submitted_by`, `created_at`, `updated_at`) VALUES
(172, 78, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'fbb23af374ec503b2d6b0bd75be21ba5', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 04:00:24'),
(173, 78, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:17:\"حلو شغلكم\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'fbb23af374ec503b2d6b0bd75be21ba5', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 04:00:24'),
(174, 72, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'ebb68580cf13e5f6fe4a2dc63f0f780f', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 06:37:25'),
(175, 72, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'ebb68580cf13e5f6fe4a2dc63f0f780f', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 06:37:25'),
(176, 72, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'ebb68580cf13e5f6fe4a2dc63f0f780f', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 06:37:25'),
(177, 72, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:17:\"this is the test.\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', 'ebb68580cf13e5f6fe4a2dc63f0f780f', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 06:37:25'),
(182, 72, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '2665a103e263b540952c0ec69e317adb', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 08:42:28'),
(183, 72, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '2665a103e263b540952c0ec69e317adb', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 08:42:28'),
(184, 72, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '2665a103e263b540952c0ec69e317adb', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 08:42:28'),
(185, 72, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', '2665a103e263b540952c0ec69e317adb', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 08:42:28'),
(187, 72, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'bf716a06891d80b7e6702196bea411ef', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 12:13:40'),
(188, 13, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '23442ada7076b67780e17c94c798115f', 1, NULL, '2018-09-20 00:00:00', '2018-09-20 12:22:36'),
(189, 71, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'e4b2fb24262db623aad4864284c87ecd', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 03:39:43'),
(190, 72, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '7b667d6494af4ffe1f1465869a3a1c79', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 03:46:27'),
(191, 82, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'af1923ac7f17900396ceffe0c2c25598', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:06:10'),
(192, 82, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'af1923ac7f17900396ceffe0c2c25598', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:06:10'),
(193, 82, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'af1923ac7f17900396ceffe0c2c25598', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:06:10'),
(194, 82, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'af1923ac7f17900396ceffe0c2c25598', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:06:10'),
(195, 82, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:72:\"ارضيات الحمامات ما وصلو مع باقي الطلبية\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'af1923ac7f17900396ceffe0c2c25598', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:06:10'),
(196, 72, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'a1ef401a7d095bc8e466d8966c310b98', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:08:46'),
(198, 85, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'a02dec83d623b72470e4b698fb512a1c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:47:47'),
(199, 85, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'a02dec83d623b72470e4b698fb512a1c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:47:47'),
(200, 85, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'a02dec83d623b72470e4b698fb512a1c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:47:47'),
(201, 85, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'a02dec83d623b72470e4b698fb512a1c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:47:47'),
(202, 85, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'a02dec83d623b72470e4b698fb512a1c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:47:47'),
(203, 86, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'f2e77d1f34aabe44ae42cf047af5aa9c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:48:46'),
(204, 86, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'f2e77d1f34aabe44ae42cf047af5aa9c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:48:46'),
(205, 86, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'f2e77d1f34aabe44ae42cf047af5aa9c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:48:46'),
(206, 86, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"لا\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'لا', '', '1', 'f2e77d1f34aabe44ae42cf047af5aa9c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:48:46'),
(207, 86, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:12:\"ممتازة\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'f2e77d1f34aabe44ae42cf047af5aa9c', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 06:48:46'),
(208, 84, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'f0f01346c79037d65fac469f401b0b22', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 08:53:25'),
(209, 84, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '4b45181e61dda58859d2efa1e6f3460e', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 08:55:34'),
(210, 80, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'd66505501b93b731240b17f5f5d67868', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 09:00:42'),
(211, 80, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'd66505501b93b731240b17f5f5d67868', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 09:00:42'),
(212, 80, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'd66505501b93b731240b17f5f5d67868', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 09:00:42'),
(213, 80, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'd66505501b93b731240b17f5f5d67868', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 09:00:42'),
(214, 80, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:8:\"تابي\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'd66505501b93b731240b17f5f5d67868', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 09:00:42'),
(216, 91, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '4f2873fd52c404ae713275dcbbdcb4dc', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 10:39:09'),
(217, 92, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '589228b73c656f1cafb14c9b817e9048', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 10:46:11'),
(218, 92, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'd7eb12fb0f9f150ec80aad8352ea4ebe', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 10:50:26'),
(219, 92, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '1934bc30eb2e70cedd0b016204ad55fe', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 10:53:38'),
(220, 92, 2, 216, 'How as our service today', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Good\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:24:\"How as our service today\";s:13:\"question_type\";s:1:\"1\";}', 'Good', '', '1', '1934bc30eb2e70cedd0b016204ad55fe', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:00:15'),
(221, 92, 2, 217, 'How is our staff today', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:10:\"Aggressive\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:22:\"How is our staff today\";s:13:\"question_type\";s:1:\"1\";}', 'Aggressive', '', '1', '1934bc30eb2e70cedd0b016204ad55fe', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:00:15'),
(222, 92, 2, 218, 'What is your language', '', 'a:4:{s:6:\"answer\";a:3:{i:0;s:3:\"Php\";i:1;s:7:\"Angular\";i:2;s:3:\"ROR\";}s:12:\"option_point\";a:3:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}i:1;a:1:{s:12:\"option_point\";s:1:\"3\";}i:2;a:1:{s:12:\"option_point\";s:1:\"5\";}}s:15:\"survey_question\";s:21:\"What is your language\";s:13:\"question_type\";s:1:\"2\";}', '', '', '2', '1934bc30eb2e70cedd0b016204ad55fe', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:00:15'),
(223, 92, 2, 219, 'Overall how as your experinance with us', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:39:\"Overall how as your experinance with us\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '1934bc30eb2e70cedd0b016204ad55fe', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:00:15'),
(224, 92, 2, 220, 'Overall how as your experinance with other', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:42:\"Overall how as your experinance with other\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '1934bc30eb2e70cedd0b016204ad55fe', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:00:15'),
(225, 92, 2, 221, 'How many of you like this portal (with suggestions) ?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:53:\"How many of you like this portal (with suggestions) ?\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '1934bc30eb2e70cedd0b016204ad55fe', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:00:15'),
(226, 92, 39, 450, 'how is your rate for save earth?', '2', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"test\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"2\";}}s:15:\"survey_question\";s:32:\"how is your rate for save earth?\";s:13:\"question_type\";s:1:\"1\";}', 'test', '', '1', 'dea735ae4fa6bc28f40d70d9762f1b46', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:08:14'),
(227, 92, 38, 444, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '1fc663f1952dd7220cdf6ed8c8198422', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:43:26'),
(228, 92, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '275d2e4b234d692f75c3fe923a0ac915', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:46:14'),
(229, 92, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '275d2e4b234d692f75c3fe923a0ac915', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:46:14'),
(230, 92, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '275d2e4b234d692f75c3fe923a0ac915', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:46:14'),
(231, 92, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:5:\"fgthf\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', '275d2e4b234d692f75c3fe923a0ac915', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:46:14'),
(232, 92, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '30e5de8651dc00ed9a489bd7ce9811ae', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:48:17'),
(233, 92, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '30e5de8651dc00ed9a489bd7ce9811ae', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:48:17'),
(234, 92, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '30e5de8651dc00ed9a489bd7ce9811ae', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:48:17'),
(235, 92, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:17:\"this is the test.\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', '30e5de8651dc00ed9a489bd7ce9811ae', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:48:17'),
(236, 92, 12, 197, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'd90d8751e5c9bbdbfe1c6a96a6e036f2', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:55:35'),
(237, 92, 12, 198, 'القائمة و الأطباق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:32:\"القائمة و الأطباق\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'd90d8751e5c9bbdbfe1c6a96a6e036f2', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:55:35'),
(238, 92, 12, 199, 'قاعة الطعام و الديكور العام', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:50:\"قاعة الطعام و الديكور العام\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'd90d8751e5c9bbdbfe1c6a96a6e036f2', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:55:35'),
(239, 92, 12, 200, 'لا تبخل علينا بمقترحاتك', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:17:\"this is the test.\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:43:\"لا تبخل علينا بمقترحاتك\";s:13:\"question_type\";s:1:\"3\";}', '', '', '3', 'd90d8751e5c9bbdbfe1c6a96a6e036f2', 1, NULL, '2018-09-21 00:00:00', '2018-09-21 11:55:35'),
(240, 94, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '788f46d30744ef28286ce2bcc3888a40', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:20:40'),
(241, 94, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '788f46d30744ef28286ce2bcc3888a40', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:20:40'),
(242, 94, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '788f46d30744ef28286ce2bcc3888a40', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:20:40'),
(243, 94, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '788f46d30744ef28286ce2bcc3888a40', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:20:40'),
(244, 94, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:25:\"ممتازه الموعد\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '788f46d30744ef28286ce2bcc3888a40', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:20:40'),
(245, 95, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'cb25faf84f06b182ec32a7e0da46786c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:22:32'),
(246, 95, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'cb25faf84f06b182ec32a7e0da46786c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:22:32'),
(247, 95, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'cb25faf84f06b182ec32a7e0da46786c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:22:32'),
(248, 95, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"لا\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'لا', '', '1', 'cb25faf84f06b182ec32a7e0da46786c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:22:32'),
(249, 95, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:2:\"ن\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'cb25faf84f06b182ec32a7e0da46786c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:22:32'),
(250, 96, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', 'a129e8f16ae72e3a2a072f647b99e0bc', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:26:48'),
(251, 96, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'a129e8f16ae72e3a2a072f647b99e0bc', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:59:57'),
(252, 96, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', 'a129e8f16ae72e3a2a072f647b99e0bc', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:26:48'),
(253, 96, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"لا\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'لا', '', '1', 'a129e8f16ae72e3a2a072f647b99e0bc', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:26:48'),
(254, 96, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:8:\"تعبت\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'a129e8f16ae72e3a2a072f647b99e0bc', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:26:48'),
(255, 97, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '02d837352294d2d7eb1415daa1f00896', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:55:29'),
(256, 97, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '02d837352294d2d7eb1415daa1f00896', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:54:15'),
(257, 97, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '02d837352294d2d7eb1415daa1f00896', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:30:24'),
(258, 97, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '02d837352294d2d7eb1415daa1f00896', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:30:24'),
(259, 97, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:10:\"كووول\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '02d837352294d2d7eb1415daa1f00896', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:30:24'),
(260, 98, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '1a90bd13c80aa1bcdada3b82f1ce04fe', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:31:44'),
(261, 98, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '1a90bd13c80aa1bcdada3b82f1ce04fe', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:55:26'),
(262, 98, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '1a90bd13c80aa1bcdada3b82f1ce04fe', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:31:44'),
(263, 98, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '4', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '1a90bd13c80aa1bcdada3b82f1ce04fe', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:57:44'),
(264, 98, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نبس\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '1a90bd13c80aa1bcdada3b82f1ce04fe', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 06:31:44'),
(265, 99, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '40ee52a5ede8466ade7d6061b5d09d7a', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 08:31:20'),
(266, 99, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '40ee52a5ede8466ade7d6061b5d09d7a', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 08:31:20'),
(267, 99, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '40ee52a5ede8466ade7d6061b5d09d7a', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 08:31:20'),
(268, 99, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '40ee52a5ede8466ade7d6061b5d09d7a', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 08:31:20'),
(269, 99, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:23:\"اسعارك غالية\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '40ee52a5ede8466ade7d6061b5d09d7a', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 08:31:20'),
(270, 101, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', 'b6e1b980e5ab9c336045e8ffc29a209d', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:08:52'),
(271, 101, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'b6e1b980e5ab9c336045e8ffc29a209d', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:08:52'),
(272, 101, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'b6e1b980e5ab9c336045e8ffc29a209d', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:08:52'),
(273, 101, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"لا\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'لا', '', '1', 'b6e1b980e5ab9c336045e8ffc29a209d', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:08:52'),
(274, 101, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'b6e1b980e5ab9c336045e8ffc29a209d', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:08:52'),
(275, 102, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '9671ced91e820492998fa4cea0c9e083', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:12:19'),
(276, 102, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '9671ced91e820492998fa4cea0c9e083', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:12:19'),
(277, 102, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '9671ced91e820492998fa4cea0c9e083', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:12:19'),
(278, 102, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '9671ced91e820492998fa4cea0c9e083', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:12:19'),
(279, 102, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '9671ced91e820492998fa4cea0c9e083', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:12:19'),
(280, 103, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'd0126aa8101d19bb969437e0b2d40127', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:14:02'),
(281, 103, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'd0126aa8101d19bb969437e0b2d40127', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:14:02'),
(282, 103, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'd0126aa8101d19bb969437e0b2d40127', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:14:02'),
(283, 103, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'd0126aa8101d19bb969437e0b2d40127', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:14:02'),
(284, 103, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:37:\"Dynejejwjwtjjyjywjwyneynsynsyneynymye\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'd0126aa8101d19bb969437e0b2d40127', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:14:02'),
(285, 104, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', 'a42f2db6c540fdefae2462d4b406e48f', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:18:17'),
(286, 104, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'a42f2db6c540fdefae2462d4b406e48f', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:18:17'),
(287, 104, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'a42f2db6c540fdefae2462d4b406e48f', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:18:17'),
(288, 104, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'a42f2db6c540fdefae2462d4b406e48f', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:18:17'),
(289, 104, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:13:\"Final testing\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'a42f2db6c540fdefae2462d4b406e48f', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 09:18:17'),
(290, 105, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '9dbe996e7ff7cf52a15e04f8eb867415', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:04:44'),
(291, 105, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '9dbe996e7ff7cf52a15e04f8eb867415', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:04:44'),
(292, 105, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9dbe996e7ff7cf52a15e04f8eb867415', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:04:44'),
(293, 105, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '9dbe996e7ff7cf52a15e04f8eb867415', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:04:44'),
(294, 105, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"حلو\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '9dbe996e7ff7cf52a15e04f8eb867415', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:04:44'),
(295, 106, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '5f78bcb4cc3fcdec1a9448285d5c07a0', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:06:07'),
(296, 106, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '5f78bcb4cc3fcdec1a9448285d5c07a0', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:06:07'),
(297, 106, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '5f78bcb4cc3fcdec1a9448285d5c07a0', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:06:07'),
(298, 106, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"لا\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'لا', '', '1', '5f78bcb4cc3fcdec1a9448285d5c07a0', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:06:07'),
(299, 106, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:2:\"ة\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '5f78bcb4cc3fcdec1a9448285d5c07a0', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:06:07'),
(300, 107, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '34b585ebe3727ec52b1a73db4002b47c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:11:47'),
(301, 107, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '34b585ebe3727ec52b1a73db4002b47c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:11:47'),
(302, 107, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '34b585ebe3727ec52b1a73db4002b47c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:11:47'),
(303, 107, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '34b585ebe3727ec52b1a73db4002b47c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:11:47'),
(304, 107, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"مم\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '34b585ebe3727ec52b1a73db4002b47c', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:11:47'),
(305, 108, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '9f8d670a00c871c5f66e50b15d5242eb', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:12:49'),
(306, 108, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '9f8d670a00c871c5f66e50b15d5242eb', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:12:49'),
(307, 108, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '9f8d670a00c871c5f66e50b15d5242eb', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:12:49'),
(308, 108, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '9f8d670a00c871c5f66e50b15d5242eb', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:12:49'),
(309, 108, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"ههه\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '9f8d670a00c871c5f66e50b15d5242eb', 1, NULL, '2018-09-22 00:00:00', '2018-09-22 15:12:49'),
(310, 110, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'e0e00229128770651cc6dcd23dd856b9', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 08:49:55'),
(311, 110, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'e0e00229128770651cc6dcd23dd856b9', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 08:49:55'),
(312, 110, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'e0e00229128770651cc6dcd23dd856b9', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 08:49:55'),
(313, 110, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'e0e00229128770651cc6dcd23dd856b9', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 08:49:55'),
(314, 110, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:60:\"شكرا يا حبيبي الانك طيب زدو i love you\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'e0e00229128770651cc6dcd23dd856b9', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 08:49:55'),
(315, 111, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c1e892e14452e257b8cdc5444673700f', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 09:04:40'),
(316, 111, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c1e892e14452e257b8cdc5444673700f', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 09:04:40'),
(317, 111, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'c1e892e14452e257b8cdc5444673700f', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 09:04:40'),
(318, 111, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'c1e892e14452e257b8cdc5444673700f', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 09:04:40'),
(319, 111, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:28:\"يرجى توفير موقع\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'c1e892e14452e257b8cdc5444673700f', 1, NULL, '2018-09-23 00:00:00', '2018-09-23 09:04:40'),
(320, 84, 41, 453, 'S-Q-1', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:11:\"S- Option 1\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:5:\"S-Q-1\";s:13:\"question_type\";s:1:\"1\";}', 'S- Option 1', '', '1', 'da3150f1c1b1a5a75d9b60781c82f7a8', 1, NULL, '2018-09-24 00:00:00', '2018-09-24 09:12:21'),
(321, 112, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '98b021adb6bdfb13b958df52d1aa36a6', 1, NULL, '2018-09-24 00:00:00', '2018-09-25 07:33:40'),
(322, 112, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '98b021adb6bdfb13b958df52d1aa36a6', 1, NULL, '2018-09-24 00:00:00', '2018-09-25 07:33:45'),
(323, 112, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '98b021adb6bdfb13b958df52d1aa36a6', 1, NULL, '2018-09-24 00:00:00', '2018-09-25 07:33:50'),
(324, 112, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '98b021adb6bdfb13b958df52d1aa36a6', 1, NULL, '2018-09-24 00:00:00', '2018-09-25 07:33:57'),
(325, 112, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:25:\"ممتازة الخدمة\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '98b021adb6bdfb13b958df52d1aa36a6', 1, NULL, '2018-09-24 00:00:00', '2018-09-25 07:34:03'),
(326, 92, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'f214622630377be55402f3f06754ca8c', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:26:34'),
(327, 92, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'f214622630377be55402f3f06754ca8c', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:26:34'),
(328, 92, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'f214622630377be55402f3f06754ca8c', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:26:34'),
(329, 92, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'f214622630377be55402f3f06754ca8c', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:26:34');
INSERT INTO `tbl_survey_form_info` (`id`, `participant_id`, `form_id`, `question_id`, `survey_question`, `option_value`, `answer`, `survey_answer`, `start_rating_answer`, `question_type`, `token`, `status`, `submitted_by`, `created_at`, `updated_at`) VALUES
(330, 92, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:17:\"this is the test.\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'f214622630377be55402f3f06754ca8c', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:26:34'),
(331, 71, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '639aa80f18b7ff5cf95ffbbb277403c9', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:45:39'),
(332, 71, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '639aa80f18b7ff5cf95ffbbb277403c9', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:45:39'),
(333, 71, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '639aa80f18b7ff5cf95ffbbb277403c9', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:45:39'),
(334, 71, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '639aa80f18b7ff5cf95ffbbb277403c9', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:45:39'),
(335, 71, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:51:\"htfgtgkjtgjngtkmgk,gvb  mgbmknvkgng.jug,kyhujykjgfj\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '639aa80f18b7ff5cf95ffbbb277403c9', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:45:39'),
(336, 104, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', 'b924611d52188fc58bc3fa06b9b1f770', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:48:36'),
(337, 104, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'b924611d52188fc58bc3fa06b9b1f770', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:48:36'),
(338, 104, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'b924611d52188fc58bc3fa06b9b1f770', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:48:36'),
(339, 104, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"لا\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'لا', '', '1', 'b924611d52188fc58bc3fa06b9b1f770', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:48:36'),
(340, 104, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:44:\"Checking for latest comments display first!!\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'b924611d52188fc58bc3fa06b9b1f770', 1, NULL, '2018-09-25 00:00:00', '2018-09-25 07:48:36'),
(341, 115, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9c1828a8ed40eee00675c07150fb7d39', 1, NULL, '2018-10-02 00:00:00', '2018-10-02 09:19:54'),
(342, 115, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', '9c1828a8ed40eee00675c07150fb7d39', 1, NULL, '2018-10-02 00:00:00', '2018-10-02 09:19:54'),
(343, 115, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', '9c1828a8ed40eee00675c07150fb7d39', 1, NULL, '2018-10-02 00:00:00', '2018-10-02 09:19:54'),
(344, 115, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '9c1828a8ed40eee00675c07150fb7d39', 1, NULL, '2018-10-02 00:00:00', '2018-10-02 09:19:54'),
(345, 115, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:34:\"Survey report Filter final testing\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '9c1828a8ed40eee00675c07150fb7d39', 1, NULL, '2018-10-02 00:00:00', '2018-10-02 09:19:54'),
(346, 118, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '97ab0f9237dd0f6c8e3e87aa78edfb5a', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:21:08'),
(347, 118, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '97ab0f9237dd0f6c8e3e87aa78edfb5a', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:21:08'),
(348, 118, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '97ab0f9237dd0f6c8e3e87aa78edfb5a', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:21:08'),
(349, 118, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '97ab0f9237dd0f6c8e3e87aa78edfb5a', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:21:08'),
(350, 118, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:29:\"Guage counting issue checking\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '97ab0f9237dd0f6c8e3e87aa78edfb5a', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:21:08'),
(351, 118, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'ec00f1a93dee8c1110782b9e52c2a2e8', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:23:52'),
(352, 118, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'ec00f1a93dee8c1110782b9e52c2a2e8', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:23:52'),
(353, 118, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'ec00f1a93dee8c1110782b9e52c2a2e8', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:23:52'),
(354, 118, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'ec00f1a93dee8c1110782b9e52c2a2e8', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:23:52'),
(355, 118, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:5:\"email\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'ec00f1a93dee8c1110782b9e52c2a2e8', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:23:52'),
(356, 102, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'ada9e4ff1b4af183af841ca538cb741d', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:28:53'),
(357, 102, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '2', '5', 'ada9e4ff1b4af183af841ca538cb741d', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:28:53'),
(358, 102, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'ada9e4ff1b4af183af841ca538cb741d', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:28:53'),
(359, 102, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'ada9e4ff1b4af183af841ca538cb741d', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:28:53'),
(360, 102, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'ada9e4ff1b4af183af841ca538cb741d', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:28:53'),
(361, 72, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9b33b0ffac6b775816df7dd1f580a824', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:32:10'),
(362, 72, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9b33b0ffac6b775816df7dd1f580a824', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:32:10'),
(363, 72, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '9b33b0ffac6b775816df7dd1f580a824', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:32:10'),
(364, 72, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '9b33b0ffac6b775816df7dd1f580a824', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:32:10'),
(365, 72, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '9b33b0ffac6b775816df7dd1f580a824', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:32:10'),
(366, 119, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '0232a3e5c06f2e75646b307ed20d2d03', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:38:31'),
(367, 119, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '0232a3e5c06f2e75646b307ed20d2d03', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:38:31'),
(368, 119, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '1', '5', '0232a3e5c06f2e75646b307ed20d2d03', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:38:31'),
(369, 119, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', '0232a3e5c06f2e75646b307ed20d2d03', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:38:31'),
(370, 119, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '0232a3e5c06f2e75646b307ed20d2d03', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:38:31'),
(371, 119, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'acfd0d1c4a074b0d94b86cfdafe863aa', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:40:59'),
(372, 119, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'acfd0d1c4a074b0d94b86cfdafe863aa', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:40:59'),
(373, 119, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'acfd0d1c4a074b0d94b86cfdafe863aa', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:40:59'),
(374, 119, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'acfd0d1c4a074b0d94b86cfdafe863aa', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:40:59'),
(375, 119, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"Test\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'acfd0d1c4a074b0d94b86cfdafe863aa', 1, NULL, '2018-10-06 00:00:00', '2018-10-06 07:40:59'),
(376, 60, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"0\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '0', '5', '52c68e583269ee964d467fb92114a690', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:26:07'),
(377, 60, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"0\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '0', '5', '52c68e583269ee964d467fb92114a690', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:26:07'),
(378, 60, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"0\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '0', '5', '52c68e583269ee964d467fb92114a690', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:26:07'),
(379, 60, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '', 'a:4:{s:6:\"answer\";a:0:{}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', '', '', '1', '52c68e583269ee964d467fb92114a690', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:26:07'),
(380, 60, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;N;}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', '52c68e583269ee964d467fb92114a690', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:26:07'),
(381, 72, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'dd2067d4f5a9d7b289dab3ae7549aaa9', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:27:55'),
(382, 72, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"0\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '0', '5', 'dd2067d4f5a9d7b289dab3ae7549aaa9', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:27:55'),
(383, 72, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'dd2067d4f5a9d7b289dab3ae7549aaa9', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:27:55'),
(384, 72, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:4:\"لا\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'لا', '', '1', 'dd2067d4f5a9d7b289dab3ae7549aaa9', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:27:55'),
(385, 72, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;N;}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'dd2067d4f5a9d7b289dab3ae7549aaa9', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:27:55'),
(391, 121, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c058e4b3712d338dc8866492db2b0382', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:42:32'),
(392, 121, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c058e4b3712d338dc8866492db2b0382', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:42:32'),
(393, 121, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c058e4b3712d338dc8866492db2b0382', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:42:32'),
(394, 121, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'c058e4b3712d338dc8866492db2b0382', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:42:32'),
(395, 121, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;N;}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'c058e4b3712d338dc8866492db2b0382', 1, NULL, '2018-10-08 00:00:00', '2018-10-08 09:42:32'),
(396, 123, 36, 445, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'c59f025d201d8e7ec1dad1f915414a14', 1, NULL, '2018-10-17 00:00:00', '2018-10-17 12:04:43'),
(397, 123, 36, 446, 'تنوع المنتجات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:25:\"تنوع المنتجات\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'c59f025d201d8e7ec1dad1f915414a14', 1, NULL, '2018-10-17 00:00:00', '2018-10-17 12:04:43'),
(398, 123, 36, 447, 'مواعيد التوصيل', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"مواعيد التوصيل\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', 'c59f025d201d8e7ec1dad1f915414a14', 1, NULL, '2018-10-17 00:00:00', '2018-10-17 12:04:43'),
(399, 123, 36, 448, 'هل تنصح الأقارب و الأصداق بتعامل معنا', '3', 'a:4:{s:6:\"answer\";a:1:{i:0;s:6:\"نعم\";}s:12:\"option_point\";a:1:{i:0;a:1:{s:12:\"option_point\";s:1:\"3\";}}s:15:\"survey_question\";s:68:\"هل تنصح الأقارب و الأصداق بتعامل معنا\";s:13:\"question_type\";s:1:\"1\";}', 'نعم', '', '1', 'c59f025d201d8e7ec1dad1f915414a14', 1, NULL, '2018-10-17 00:00:00', '2018-10-17 12:04:43'),
(400, 123, 36, 449, 'اقتراحاتكم تهمنا لتحسين الجودة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:10:\"تتتبي\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:57:\"اقتراحاتكم تهمنا لتحسين الجودة\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'c59f025d201d8e7ec1dad1f915414a14', 1, NULL, '2018-10-17 00:00:00', '2018-10-17 12:04:43'),
(401, 178, 46, 511, 'how is our staff?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:17:\"how is our staff?\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', 'fc223272c8f58a50e62c664975dee9d1', 1, NULL, '2019-07-16 00:00:00', '2019-07-16 10:05:02'),
(402, 178, 46, 512, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '3', '5', 'fc223272c8f58a50e62c664975dee9d1', 1, NULL, '2019-07-16 00:00:00', '2019-07-16 10:05:02'),
(403, 178, 46, 513, 'أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:81:\"أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', 'fc223272c8f58a50e62c664975dee9d1', 1, NULL, '2019-07-16 00:00:00', '2019-07-16 10:05:02'),
(404, 178, 46, 511, 'how is our staff?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"3\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:17:\"how is our staff?\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', '3a860ade9e97be6d489fad273c398150', 1, NULL, '2019-07-16 00:00:00', '2019-07-16 10:34:22'),
(405, 178, 46, 512, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '3a860ade9e97be6d489fad273c398150', 1, NULL, '2019-07-16 00:00:00', '2019-07-16 10:34:22'),
(406, 178, 46, 513, 'أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:81:\"أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', '3a860ade9e97be6d489fad273c398150', 1, NULL, '2019-07-16 00:00:00', '2019-07-16 10:34:22'),
(407, 70, 46, 514, 'how is our staff?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:17:\"how is our staff?\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', '66b779c4b10e6a04d6d5ca3979199f86', 1, NULL, '2019-08-09 00:00:00', '2019-08-09 06:08:52'),
(408, 70, 46, 515, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '5', '5', '66b779c4b10e6a04d6d5ca3979199f86', 1, NULL, '2019-08-09 00:00:00', '2019-08-09 06:08:52'),
(409, 70, 46, 516, 'أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:81:\"أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', '66b779c4b10e6a04d6d5ca3979199f86', 1, NULL, '2019-08-09 00:00:00', '2019-08-09 06:08:52'),
(410, 70, 46, 514, 'how is our staff?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:17:\"how is our staff?\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', '4d442aa585195cc2b6874574f882f2df', 1, NULL, '2019-08-18 00:00:00', '2019-08-18 05:41:14'),
(411, 70, 46, 515, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', '4d442aa585195cc2b6874574f882f2df', 1, NULL, '2019-08-18 00:00:00', '2019-08-18 05:41:14'),
(412, 70, 46, 516, 'أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"1\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:81:\"أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', '4d442aa585195cc2b6874574f882f2df', 1, NULL, '2019-08-18 00:00:00', '2019-08-18 05:41:14'),
(413, 70, 46, 514, 'how is our staff?', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:17:\"how is our staff?\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', 'e3dc983b0caaadc472817f58bcb9a277', 1, NULL, '2019-08-27 00:00:00', '2019-08-27 07:34:45'),
(414, 70, 46, 515, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"5\";}', '', '4', '5', 'e3dc983b0caaadc472817f58bcb9a277', 1, NULL, '2019-08-27 00:00:00', '2019-08-27 07:34:45'),
(415, 70, 46, 516, 'أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:81:\"أنا أؤمن برسالة المركز وأهدافه وأحب أن تتحقق\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', 'e3dc983b0caaadc472817f58bcb9a277', 1, NULL, '2019-08-27 00:00:00', '2019-08-27 07:34:45'),
(416, 70, 46, 541, 'وقت الأنتظار', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"2\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:23:\"وقت الأنتظار\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', 'f3bd5313a0a4df74515edcae7a58e741', 1, NULL, '2019-09-02 00:00:00', '2019-09-02 06:28:20'),
(417, 70, 46, 542, 'تعامل الموظفين', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"4\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:27:\"تعامل الموظفين\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', 'f3bd5313a0a4df74515edcae7a58e741', 1, NULL, '2019-09-02 00:00:00', '2019-09-02 06:28:20'),
(418, 70, 46, 543, 'جودة الخدمة', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:1:\"5\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:21:\"جودة الخدمة\";s:13:\"question_type\";s:1:\"6\";}', '', '', '6', 'f3bd5313a0a4df74515edcae7a58e741', 1, NULL, '2019-09-02 00:00:00', '2019-09-02 06:28:20'),
(419, 70, 46, 544, 'افتراحات تطويرية في المنتج و الخدمات', '', 'a:4:{s:6:\"answer\";a:1:{i:0;s:715:\"مرحبا يا حبايبي لية لتغلي و الزعل وما تصيرون زي خلق الله وبركاته مساء الخير يا قلبي انا تمام الحمد لله على كل حال وفي كل مكان في العالم العربي والإسلامي من خلال هذا العام في كل مكان في العالم العربي والإسلامي من خلال هذا العام في كل مكان في العالم العربي والإسلامي من خلال هذا العام في كل مكان في العالم العربي والإسلامي من خلال هذا العام في كل مكان في العالم العربي والإسلامي من خلال هذا العام في\";}s:12:\"option_point\";a:0:{}s:15:\"survey_question\";s:67:\"افتراحات تطويرية في المنتج و الخدمات\";s:13:\"question_type\";s:1:\"4\";}', '', '', '4', 'f3bd5313a0a4df74515edcae7a58e741', 1, NULL, '2019-09-02 00:00:00', '2019-09-02 06:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_form_info_checkbox_ans`
--

CREATE TABLE `tbl_survey_form_info_checkbox_ans` (
  `id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `check_box_ans` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `option_point` varchar(155) CHARACTER SET latin1 NOT NULL,
  `token` text CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_survey_form_info_checkbox_ans`
--

INSERT INTO `tbl_survey_form_info_checkbox_ans` (`id`, `participant_id`, `question_id`, `form_id`, `check_box_ans`, `option_point`, `token`, `created_at`, `updated_at`) VALUES
(1, 1, 190, 2, 'Php', '5', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', '2018-06-02 00:00:00', '2018-07-04 14:53:53'),
(2, 1, 190, 2, 'Javascript', '4', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', '2018-06-02 00:00:00', '2018-07-04 14:53:53'),
(3, 1, 190, 2, 'Angular', '3', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', '2018-06-02 00:00:00', '2018-07-04 14:53:53'),
(4, 3, 190, 2, 'Php', '5', '05b015cd646c40f7d972dbdbc12c1483', '2018-06-02 00:00:00', '2018-07-04 14:54:57'),
(5, 3, 190, 2, 'Javascript', '4', '05b015cd646c40f7d972dbdbc12c1483', '2018-06-02 00:00:00', '2018-07-04 14:55:00'),
(6, 3, 190, 2, 'Angular', '3', '05b015cd646c40f7d972dbdbc12c1483', '2018-06-02 00:00:00', '2018-07-04 14:55:05'),
(7, 3, 190, 2, 'ROR', '2', '05b015cd646c40f7d972dbdbc12c1483', '2018-06-02 00:00:00', '2018-07-04 14:55:25'),
(8, 6, 190, 2, 'Javascript', '4', '68cfb0d02f5029ed21c3951945e52d30', '2018-06-02 00:00:00', '2018-07-04 14:57:34'),
(9, 6, 190, 2, 'Angular', '3', '68cfb0d02f5029ed21c3951945e52d30', '2018-06-02 00:00:00', '2018-07-04 14:57:55'),
(10, 6, 190, 2, 'ROR', '2', '68cfb0d02f5029ed21c3951945e52d30', '2018-06-02 00:00:00', '2018-07-04 14:57:58'),
(11, 6, 190, 2, 'Others', '1', '76032055b3581c1ab1fb0c4e8f316881', '2018-06-02 00:00:00', '2018-07-04 14:58:06'),
(12, 3, 190, 2, 'Php', '5', '05b015cd646c40f7d972dbdbc12c1483', '2018-06-02 00:00:00', '2018-07-04 14:56:10'),
(13, 3, 190, 2, 'Angular', '3', '4e97338dc2f5aa611ee4a3629f214ccd', '2018-06-02 00:00:00', '2018-07-04 14:56:56'),
(14, 3, 190, 2, 'ROR', '2', '4e97338dc2f5aa611ee4a3629f214ccd', '2018-06-02 00:00:00', '2018-07-04 14:56:59'),
(15, 6, 190, 2, 'Php', '5', '76032055b3581c1ab1fb0c4e8f316881', '2018-06-02 00:00:00', '2018-07-04 14:59:04'),
(16, 6, 190, 2, 'Angular', '3', '76032055b3581c1ab1fb0c4e8f316881', '2018-06-02 00:00:00', '2018-07-04 14:59:55'),
(17, 6, 190, 2, 'ROR', '2', '76032055b3581c1ab1fb0c4e8f316881', '2018-06-02 00:00:00', '2018-07-04 14:59:58'),
(18, 1, 190, 2, 'Javascript', '4', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', '2018-06-02 00:00:00', '2018-07-04 14:53:53'),
(19, 1, 190, 2, 'ROR', '2', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', '2018-06-02 00:00:00', '2018-07-04 14:53:53'),
(20, 1, 190, 2, 'Others', '1', 'e3383bf5b6d4e3356a2d558b3d0ecbc7', '2018-06-02 00:00:00', '2018-07-04 14:53:53'),
(21, 11, 178, 5, 'Angular', '2', '177631fe55a0482a8c36248d2affa0cb', '2018-07-27 00:00:00', '2018-07-27 18:17:26'),
(22, 11, 178, 5, 'Php', '4', '177631fe55a0482a8c36248d2affa0cb', '2018-07-27 00:00:00', '2018-07-27 18:17:26'),
(23, 11, 178, 5, 'Others or All', '3', '177631fe55a0482a8c36248d2affa0cb', '2018-07-27 00:00:00', '2018-07-27 18:17:26'),
(24, 11, 179, 5, 'Usebility', '2', '177631fe55a0482a8c36248d2affa0cb', '2018-07-27 00:00:00', '2018-07-27 18:17:26'),
(25, 11, 179, 5, 'Utility', '3', '177631fe55a0482a8c36248d2affa0cb', '2018-07-27 00:00:00', '2018-07-27 18:17:26'),
(26, 3, 178, 5, 'Java', '1', 'd75b01b0ce4a0a8b0018b7b5f1b0c86d', '2018-07-27 00:00:00', '2018-07-27 18:17:44'),
(27, 3, 178, 5, 'Angular', '2', 'd75b01b0ce4a0a8b0018b7b5f1b0c86d', '2018-07-27 00:00:00', '2018-07-27 18:17:44'),
(28, 3, 179, 5, 'Price', '1', 'd75b01b0ce4a0a8b0018b7b5f1b0c86d', '2018-07-27 00:00:00', '2018-07-27 18:17:44'),
(29, 3, 179, 5, 'Support', '4', 'd75b01b0ce4a0a8b0018b7b5f1b0c86d', '2018-07-27 00:00:00', '2018-07-27 18:17:44'),
(30, 11, 218, 2, 'Javascript', '4', '4ddc4826af76002f88a3cfe260099bea', '2018-07-30 00:00:00', '2018-07-30 19:09:01'),
(31, 11, 218, 2, 'ROR', '2', '4ddc4826af76002f88a3cfe260099bea', '2018-07-30 00:00:00', '2018-07-30 19:09:01'),
(32, 11, 218, 2, 'Others', '1', '4ddc4826af76002f88a3cfe260099bea', '2018-07-30 00:00:00', '2018-07-30 19:09:01'),
(33, 16, 178, 5, 'Php', '4', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:22:35'),
(34, 16, 179, 5, 'Usebility', '2', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:22:35'),
(35, 13, 178, 5, 'Php', '4', '4fcb5477a2e5228d6c99e12025851140', '2018-09-06 00:00:00', '2018-09-06 14:23:21'),
(36, 13, 179, 5, 'Price', '1', '4fcb5477a2e5228d6c99e12025851140', '2018-09-06 00:00:00', '2018-09-06 14:23:21'),
(37, 16, 178, 5, 'Java', '1', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:24:44'),
(38, 16, 178, 5, 'Angular', '2', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:24:44'),
(39, 16, 178, 5, 'Php', '4', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:24:44'),
(40, 16, 178, 5, 'Others or All', '3', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:24:45'),
(41, 16, 179, 5, 'Price', '1', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:24:45'),
(42, 16, 179, 5, 'Usebility', '2', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:24:45'),
(43, 16, 179, 5, 'Utility', '3', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:24:45'),
(44, 16, 179, 5, 'Support', '4', '4b1686a6a6691bb148799bcb5441b73c', '2018-09-06 00:00:00', '2018-09-06 14:24:45'),
(45, 13, 279, 29, 'test', '2', '4affa5eb0055732f723556f0f261dd23', '2018-09-08 00:00:00', '2018-09-08 21:57:30'),
(46, 13, 281, 29, 'test3', '2', '4affa5eb0055732f723556f0f261dd23', '2018-09-08 00:00:00', '2018-09-08 21:57:30'),
(47, 38, 218, 2, 'Php', '5', '5f8bc670f14265b78e87478d3f0585f6', '2018-09-12 00:00:00', '2018-09-12 19:02:33'),
(48, 38, 218, 2, 'Javascript', '4', '5f8bc670f14265b78e87478d3f0585f6', '2018-09-12 00:00:00', '2018-09-12 19:02:33'),
(49, 38, 218, 2, 'Angular', '3', '5f8bc670f14265b78e87478d3f0585f6', '2018-09-12 00:00:00', '2018-09-12 19:02:33'),
(50, 38, 218, 2, 'ROR', '2', '5f8bc670f14265b78e87478d3f0585f6', '2018-09-12 00:00:00', '2018-09-12 19:02:33'),
(51, 13, 218, 2, 'Php', '5', 'bbf2304298ceedde79b7d355a306478d', '2018-09-12 00:00:00', '2018-09-12 19:13:30'),
(52, 13, 218, 2, 'Javascript', '4', 'bbf2304298ceedde79b7d355a306478d', '2018-09-12 00:00:00', '2018-09-12 19:13:30'),
(53, 13, 218, 2, 'Angular', '3', 'bbf2304298ceedde79b7d355a306478d', '2018-09-12 00:00:00', '2018-09-12 19:13:31'),
(54, 13, 178, 5, 'Java', '1', 'c907cf6c031e04e65a7370579dda802e', '2018-09-17 00:00:00', '2018-09-17 19:37:06'),
(55, 13, 178, 5, 'Angular', '2', 'c907cf6c031e04e65a7370579dda802e', '2018-09-17 00:00:00', '2018-09-17 19:37:06'),
(56, 13, 178, 5, 'Php', '4', 'c907cf6c031e04e65a7370579dda802e', '2018-09-17 00:00:00', '2018-09-17 19:37:06'),
(57, 13, 178, 5, 'Others or All', '3', 'c907cf6c031e04e65a7370579dda802e', '2018-09-17 00:00:00', '2018-09-17 19:37:06'),
(58, 13, 179, 5, 'Price', '1', 'c907cf6c031e04e65a7370579dda802e', '2018-09-17 00:00:00', '2018-09-17 19:37:06'),
(59, 13, 179, 5, 'Utility', '3', 'c907cf6c031e04e65a7370579dda802e', '2018-09-17 00:00:00', '2018-09-17 19:37:06'),
(75, 92, 218, 2, 'Php', '5', '1934bc30eb2e70cedd0b016204ad55fe', '2018-09-21 00:00:00', '2018-09-21 20:00:15'),
(76, 92, 218, 2, 'Angular', '3', '1934bc30eb2e70cedd0b016204ad55fe', '2018-09-21 00:00:00', '2018-09-21 20:00:15'),
(77, 92, 218, 2, 'ROR', '2', '1934bc30eb2e70cedd0b016204ad55fe', '2018-09-21 00:00:00', '2018-09-21 20:00:15'),
(78, 92, 218, 2, 'Javascript', '4', '1fc663f1952dd7220cdf6ed8c8198422', '2018-09-21 00:00:00', '2018-09-21 20:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_options`
--

CREATE TABLE `tbl_survey_options` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `survey_option_title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_point` varchar(50) CHARACTER SET latin1 NOT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: Not Deleted, 1: Deleted',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '0: In-Active, 1: Active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_survey_options`
--

INSERT INTO `tbl_survey_options` (`id`, `user_id`, `question_id`, `survey_option_title`, `option_point`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(80, 10, 44, 'Radio', '1', 0, 1, '2018-05-04 00:00:00', '2018-05-04 02:01:05'),
(79, 10, 43, 'Chekbox7', '7', 0, 1, '2018-05-04 00:00:00', '2018-05-04 02:01:05'),
(78, 10, 43, 'Chekbox5', '5', 0, 1, '2018-05-04 00:00:00', '2018-05-04 02:01:05'),
(77, 10, 43, 'Chekbox6', '6', 0, 1, '2018-05-04 00:00:00', '2018-05-04 02:01:05'),
(74, 10, 41, 'Checkbox4', '4', 0, 1, '2018-05-04 00:00:00', '2018-05-04 01:59:35'),
(73, 10, 41, 'Chekbox1', '3', 0, 1, '2018-05-04 00:00:00', '2018-05-04 01:59:35'),
(72, 10, 41, 'Chekbox2', '2', 0, 1, '2018-05-04 00:00:00', '2018-05-04 01:59:35'),
(71, 10, 41, 'Chekbox3', '5', 0, 1, '2018-05-04 00:00:00', '2018-05-04 01:59:35'),
(67, 10, 39, 'Yes', '2', 0, 1, '2018-05-04 00:00:00', '2018-05-04 01:55:49'),
(66, 10, 39, 'test', '3', 0, 1, '2018-05-04 00:00:00', '2018-05-04 01:55:49'),
(65, 10, 39, 'No', '32', 0, 1, '2018-05-04 00:00:00', '2018-05-04 01:55:49'),
(64, 10, 39, 'test2', '3', 0, 1, '2018-05-04 00:00:00', '2018-05-04 01:55:49'),
(81, 10, 44, 'Radio2', '2', 0, 1, '2018-05-04 00:00:00', '2018-05-04 02:01:05'),
(98, 10, 51, 'Chekbox6', '6', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:34:30'),
(97, 10, 51, 'Chekbox5', '5', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:34:30'),
(96, 10, 51, 'Chekbox7', '7', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:34:30'),
(91, 10, 48, 'Radio2', '2', 0, 1, '2018-05-04 00:00:00', '2018-05-04 02:10:39'),
(90, 10, 48, 'Radio', '1', 0, 1, '2018-05-04 00:00:00', '2018-05-04 02:10:39'),
(94, 10, 50, 'What is your first school', '3', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:34:30'),
(95, 10, 50, 'waht is your name', '4', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:34:30'),
(105, 10, 54, 'What is your first school', '3', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:42:20'),
(109, 10, 55, 'Chekbox6', '6', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:42:20'),
(108, 10, 55, 'Chekbox5', '5', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:42:20'),
(107, 10, 55, 'Chekbox7', '7', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:42:20'),
(106, 10, 54, 'waht is your name', '4', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:42:20'),
(110, 10, 56, 'What is your first school', '3', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:43:55'),
(111, 10, 56, 'waht is your name', '4', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:43:55'),
(112, 10, 57, 'Chekbox7', '7', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:43:55'),
(113, 10, 57, 'Chekbox5', '5', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:43:55'),
(114, 10, 57, 'Chekbox6', '6', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:43:55'),
(115, 10, 58, 'What is your first school', '3', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:44:03'),
(116, 10, 58, 'waht is your name', '4', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:44:03'),
(117, 10, 59, 'Chekbox7', '7', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:44:03'),
(118, 10, 59, 'Chekbox5', '5', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:44:03'),
(119, 10, 59, 'Chekbox6', '6', 0, 1, '2018-05-05 00:00:00', '2018-05-05 03:44:03'),
(123, 10, 72, 'New', '10', 0, 1, '2018-05-05 00:00:00', '2018-05-05 08:40:38'),
(201, 10, 142, 'Hello', '5', 0, 1, '2018-05-17 00:00:00', '2018-05-17 06:02:50'),
(253, 10, 178, 'Php', '4', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(255, 10, 179, 'Price', '1', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(136, 10, 81, 'option1', '2', 0, 1, '2018-05-07 00:00:00', '2018-05-07 02:12:11'),
(137, 10, 83, 'CB1', '1', 0, 1, '2018-05-07 00:00:00', '2018-05-07 02:12:11'),
(138, 10, 83, 'CB2', '2', 0, 1, '2018-05-07 00:00:00', '2018-05-07 02:12:11'),
(139, 10, 83, 'CB3', '3', 0, 1, '2018-05-07 00:00:00', '2018-05-07 02:12:11'),
(202, 10, 143, 'Hello', '6', 0, 1, '2018-05-17 00:00:00', '2018-05-17 06:02:50'),
(146, 10, 90, 'hello', '25', 0, 1, '2018-05-09 00:00:00', '2018-05-09 01:15:56'),
(181, 10, 122, 'Q2', '3', 0, 1, '2018-05-09 00:00:00', '2018-05-09 05:39:41'),
(180, 10, 122, 'Q1', '3', 0, 1, '2018-05-09 00:00:00', '2018-05-09 05:39:41'),
(179, 10, 121, 'N1', '1', 0, 1, '2018-05-09 00:00:00', '2018-05-09 05:39:41'),
(182, 10, 124, 'N1', '1', 0, 1, '2018-05-09 00:00:00', '2018-05-09 05:40:04'),
(190, 10, 135, 'Q1', '3', 0, 1, '2018-05-14 00:00:00', '2018-05-14 02:38:57'),
(189, 10, 135, 'Q2', '3', 0, 1, '2018-05-14 00:00:00', '2018-05-14 02:38:57'),
(191, 10, 135, '3', '5', 0, 1, '2018-05-14 00:00:00', '2018-05-14 02:38:57'),
(256, 10, 179, 'Usebility', '2', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(259, 10, 180, 'What is your location', '5', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(203, 10, 144, 'sdfsdfsdf', '45', 0, 1, '2018-05-17 00:00:00', '2018-05-17 06:02:50'),
(237, 10, 170, 'Good', '2', 0, 1, '2018-05-30 00:00:00', '2018-05-30 04:36:44'),
(243, 10, 171, 'Helpful', '2', 0, 1, '2018-05-30 00:00:00', '2018-05-30 04:36:44'),
(242, 10, 171, 'Ignorant', '1', 0, 1, '2018-05-30 00:00:00', '2018-05-30 04:36:44'),
(241, 10, 171, 'Aggressive', '2', 0, 1, '2018-05-30 00:00:00', '2018-05-30 04:36:44'),
(240, 10, 171, 'Friendly', '1', 0, 1, '2018-05-30 00:00:00', '2018-05-30 04:36:44'),
(238, 10, 170, 'Bad', '3', 0, 1, '2018-05-30 00:00:00', '2018-05-30 04:36:44'),
(236, 10, 170, 'Excellent', '1', 0, 1, '2018-05-30 00:00:00', '2018-05-30 04:36:44'),
(239, 10, 170, 'Poor', '4', 0, 1, '2018-05-30 00:00:00', '2018-05-30 04:36:44'),
(254, 10, 178, 'Others or All', '3', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(252, 10, 178, 'Angular', '2', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(251, 10, 178, 'Java', '1', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(257, 10, 179, 'Utility', '3', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(258, 10, 179, 'Support', '4', 0, 1, '2018-05-31 00:00:00', '2018-05-31 01:08:22'),
(313, 10, 216, 'Poor', '1', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(312, 10, 216, 'Bad', '2', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(311, 10, 216, 'Good', '3', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(317, 10, 217, 'Helpful', '1', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(316, 10, 217, 'Ignorant', '2', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(315, 10, 217, 'Aggressive', '3', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(314, 10, 217, 'Friendly', '4', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(322, 10, 218, 'Others', '1', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(321, 10, 218, 'ROR', '2', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(320, 10, 218, 'Angular', '3', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(319, 10, 218, 'Javascript', '4', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(310, 10, 216, 'Excellent', '5', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(318, 10, 218, 'Php', '5', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:08:14'),
(306, 10, 202, '80', '5', 0, 1, '2018-07-17 00:00:00', '2018-07-17 22:10:15'),
(305, 10, 202, '50', '4', 0, 1, '2018-07-17 00:00:00', '2018-07-17 22:10:15'),
(304, 10, 202, '10', '1', 0, 1, '2018-07-17 00:00:00', '2018-07-17 22:10:15'),
(303, 10, 202, '20', '2', 0, 1, '2018-07-17 00:00:00', '2018-07-17 22:10:15'),
(307, 10, 210, '0', '3', 0, 1, '2018-07-30 00:00:00', '2018-07-30 18:59:48'),
(308, 10, 211, '0', '3', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:03:09'),
(309, 10, 212, '0', '3', 0, 1, '2018-07-30 00:00:00', '2018-07-30 19:03:09'),
(324, 10, 231, 'test', '2', 0, 1, '2018-08-24 00:00:00', '2018-08-24 14:27:03'),
(326, 10, 235, 'dfdfsdf', '2', 0, 1, '2018-08-27 00:00:00', '2018-08-27 22:54:32'),
(327, 10, 236, 'dfdfsdf', '2', 0, 1, '2018-08-27 00:00:00', '2018-08-27 22:54:32'),
(491, 10, 434, 'test', '2', 0, 1, '2018-09-14 00:00:00', '2018-09-14 20:52:49'),
(492, 10, 435, 'test2', '2', 0, 1, '2018-09-14 00:00:00', '2018-09-14 20:52:49'),
(493, 10, 436, 'test3', '2', 0, 1, '2018-09-14 00:00:00', '2018-09-14 20:52:49'),
(364, 10, 296, 'S- Option 2', '1', 0, 1, '2018-09-06 00:00:00', '2018-09-06 23:20:09'),
(363, 10, 296, 'S- Option 1', '2', 0, 1, '2018-09-06 00:00:00', '2018-09-06 23:20:09'),
(365, 10, 298, 'Survey option-1', '1', 0, 1, '2018-09-07 00:00:00', '2018-09-07 15:54:36'),
(366, 10, 298, 'Survey option-2', '2', 0, 1, '2018-09-07 00:00:00', '2018-09-07 15:54:36'),
(484, 10, 421, 'لا', '3', 0, 1, '2018-09-09 00:00:00', '2018-09-09 20:06:31'),
(436, 10, 339, 'RTL- SURVEY OPTION-1', '1', 0, 1, '2018-09-07 00:00:00', '2018-09-07 16:32:46'),
(415, 10, 328, 'Survey option-1', '1', 0, 1, '2018-09-07 00:00:00', '2018-09-07 16:22:03'),
(483, 10, 421, 'نعم', '3', 0, 1, '2018-09-09 00:00:00', '2018-09-09 20:06:31'),
(486, 10, 422, 'لا', '3', 0, 1, '2018-09-09 00:00:00', '2018-09-09 20:06:31'),
(485, 10, 422, 'نعم', '3', 0, 1, '2018-09-09 00:00:00', '2018-09-09 20:06:31'),
(508, 10, 448, 'لا', '3', 0, 1, '2018-09-19 00:00:00', '2018-09-19 15:20:41'),
(507, 10, 448, 'نعم', '3', 0, 1, '2018-09-19 00:00:00', '2018-09-19 15:20:41'),
(512, 10, 453, 'S- Option 1', '3', 0, 1, '2018-09-24 00:00:00', '2018-09-24 18:05:52'),
(510, 10, 451, 'S- Option 1', '3', 0, 1, '2018-09-24 00:00:00', '2018-09-24 16:26:39'),
(509, 10, 450, 'test', '2', 0, 1, '2018-09-21 00:00:00', '2018-09-21 20:06:35'),
(514, 10, 492, '0', '3', 0, 1, '2019-06-05 00:00:00', '2019-06-05 09:52:56'),
(517, 10, 498, '0', '3', 0, 1, '2019-06-05 00:00:00', '2019-06-05 22:44:54'),
(527, 10, 520, '0', '3', 0, 1, '2019-08-28 00:00:00', '2019-08-28 16:29:15'),
(523, 10, 509, '0', '3', 0, 1, '2019-07-12 00:00:00', '2019-07-12 11:34:20'),
(520, 10, 505, NULL, '3', 0, 1, '2019-07-10 00:00:00', '2019-07-10 11:21:08'),
(521, 10, 506, 'Test Point', '12', 0, 1, '2019-07-12 00:00:00', '2019-07-12 09:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_survey_question`
--

CREATE TABLE `tbl_survey_question` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `survey_form_id` int(11) NOT NULL,
  `survey_question` text COLLATE utf8_unicode_ci NOT NULL,
  `question_type` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Radio, 2: Checkbox, 3: Textbox, 4: Textarea, 5: Star Rating',
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_rating_5` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_name_5` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_rating_4` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_name_4` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_rating_3` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_name_3` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_rating_2` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_name_2` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_rating_1` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emoji_name_1` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1: Deleted, 0: Not Deleted',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: In-Active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_survey_question`
--

INSERT INTO `tbl_survey_question` (`id`, `user_id`, `survey_form_id`, `survey_question`, `question_type`, `color`, `size`, `emoji_rating_5`, `emoji_name_5`, `emoji_rating_4`, `emoji_name_4`, `emoji_rating_3`, `emoji_name_3`, `emoji_rating_2`, `emoji_name_2`, `emoji_rating_1`, `emoji_name_1`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(144, 10, 4, 'Test Serve question', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-17 00:00:00', '2018-05-17 11:32:50'),
(73, 10, 3, 'New', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-05 00:00:00', '2018-05-05 14:10:38'),
(72, 10, 3, 'New gh', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-05 00:00:00', '2018-05-05 14:10:38'),
(180, 10, 5, 'What is your location', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-31 00:00:00', '2018-05-31 06:38:22'),
(81, 10, 6, 'how is our service?', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-07 00:00:00', '2018-05-07 07:42:11'),
(82, 10, 6, 'how is our staff?', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-07 00:00:00', '2018-05-07 07:42:11'),
(173, 10, 10, 'Question4', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-30 00:00:00', '2018-05-30 10:06:44'),
(143, 10, 4, 'New', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-17 00:00:00', '2018-05-17 11:32:50'),
(90, 10, 7, 'how was the content', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-09 00:00:00', '2018-05-09 06:45:56'),
(91, 10, 7, 'How was the teacher?', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-09 00:00:00', '2018-05-09 06:45:56'),
(92, 10, 7, 'how was the facilities?', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-09 00:00:00', '2018-05-09 06:45:56'),
(94, 10, 8, 'New', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-09 00:00:00', '2018-05-09 10:37:15'),
(135, 10, 9, 'New', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-14 00:00:00', '2018-05-14 08:08:57'),
(134, 10, 9, 'New', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-14 00:00:00', '2018-05-14 08:08:57'),
(133, 10, 9, 'Test', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-14 00:00:00', '2018-05-14 08:08:57'),
(179, 10, 5, 'What is software service', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-31 00:00:00', '2018-05-31 06:38:22'),
(178, 10, 5, 'What is your language', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-31 00:00:00', '2018-05-31 06:38:22'),
(142, 10, 4, 'Newhjh', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-17 00:00:00', '2018-05-17 11:32:50'),
(172, 10, 10, 'Question3', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-30 00:00:00', '2018-05-30 10:06:44'),
(171, 10, 10, 'How is our staff today', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-30 00:00:00', '2018-05-30 10:06:44'),
(170, 10, 10, 'How as our service today', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-30 00:00:00', '2018-05-30 10:06:44'),
(174, 10, 10, 'Question5', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-05-30 00:00:00', '2018-05-30 10:06:44'),
(219, 10, 2, 'Overall how as your experinance with us', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 13:08:14'),
(218, 10, 2, 'What is your language', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 13:08:14'),
(217, 10, 2, 'How is our staff today', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 13:08:14'),
(216, 10, 2, 'How as our service today', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 13:08:14'),
(193, 10, 11, '????? ????????', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-06 00:00:00', '2018-07-06 06:11:49'),
(194, 10, 11, '????? ??????', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-06 00:00:00', '2018-07-06 06:11:49'),
(195, 10, 11, '???? ????????', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-06 00:00:00', '2018-07-06 06:11:49'),
(196, 10, 11, '?? ???? ????? ?????????', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-06 00:00:00', '2018-07-06 06:11:49'),
(197, 10, 12, 'تعامل الموظفين', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-14 00:00:00', '2018-07-14 05:53:23'),
(198, 10, 12, 'القائمة و الأطباق', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-14 00:00:00', '2018-07-14 05:53:23'),
(199, 10, 12, 'قاعة الطعام و الديكور العام', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-14 00:00:00', '2018-07-14 05:53:23'),
(200, 10, 12, 'لا تبخل علينا بمقترحاتك', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-14 00:00:00', '2018-07-14 05:53:23'),
(202, 10, 13, 'How many years old are you ?', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-17 00:00:00', '2018-07-17 16:10:15'),
(205, 10, 14, 'How many of you like this portal (with suggestions) ?', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 12:48:23'),
(204, 10, 15, 'How many of you like this portal (with suggestions) ?', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 12:47:56'),
(206, 10, 14, 'How many years old are you ?', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 12:48:23'),
(207, 10, 16, 'How many of you like this portal (with suggestions) ?', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 12:51:04'),
(208, 10, 17, 'How many of you like this portal (with suggestions) ?', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 12:51:45'),
(209, 10, 18, 'How many of you like this portal (with suggestions) ?', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 12:55:47'),
(210, 10, 19, 'How many of you like this portal (with suggestions) ?', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 12:59:48'),
(211, 10, 20, 'How many of you like this portal (with suggestions) ?', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 13:03:09'),
(212, 10, 20, 'How many of you like this portal (with suggestions) ?', 2, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 13:03:09'),
(227, 10, 21, 'The Sangai Festival is celebrated in ?', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-16 00:00:00', '2018-08-16 10:04:14'),
(226, 10, 21, 'How many years old are you ?', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-16 00:00:00', '2018-08-16 10:04:14'),
(220, 10, 2, 'Overall how as your experinance with other', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 13:08:14'),
(221, 10, 2, 'How many of you like this portal (with suggestions) ?', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-07-30 00:00:00', '2018-07-30 13:08:14'),
(225, 10, 21, 'How many of you like this portal (with suggestions) ?', 3, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-16 00:00:00', '2018-08-16 10:04:14'),
(228, 10, 21, 'sd', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-16 00:00:00', '2018-08-16 10:04:14'),
(231, 10, 22, 'test', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-24 00:00:00', '2018-08-24 08:27:03'),
(232, 10, 23, 'تعامل الموظفين', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-24 00:00:00', '2018-08-24 10:22:45'),
(233, 10, 23, 'how is our service', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-24 00:00:00', '2018-08-24 10:22:45'),
(236, 10, 24, 'Are you php developer?', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-27 00:00:00', '2018-08-27 16:54:32'),
(249, 10, 26, 'تقييم الدعم الفني و المتابعة؟', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-01 00:00:00', '2018-09-01 09:14:31'),
(240, 10, 25, 'تعامل الموظفين', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-08-28 00:00:00', '2018-08-28 12:12:38'),
(247, 10, 26, 'تقييم القيمة المضافة من تطبيق الأرجان؟', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-01 00:00:00', '2018-09-01 09:14:31'),
(248, 10, 26, 'تقييم جودة الخدمة المقدمة من موظفين الأرجان؟', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-01 00:00:00', '2018-09-01 09:14:31'),
(274, 10, 27, 'تعامل الموظفين', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-06 00:00:00', '2018-09-06 13:02:53'),
(275, 10, 27, 'اقتراحات تطويرية', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-06 00:00:00', '2018-09-06 13:02:53'),
(347, 10, 28, 'Test 1', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-08 00:00:00', '2018-09-08 16:25:26'),
(434, 10, 29, 'one', 2, '#5ca612', '18px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-14 00:00:00', '2018-09-14 14:52:49'),
(435, 10, 29, 'two', 1, '#e00ea5', '18px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-14 00:00:00', '2018-09-14 14:52:49'),
(436, 10, 29, 'three', 2, '#1137bd', '37px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-14 00:00:00', '2018-09-14 14:52:49'),
(296, 10, 30, 'S- Question', 1, '#17d2de', '36px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-06 00:00:00', '2018-09-06 17:20:09'),
(297, 10, 31, 'Survey Question', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-07 00:00:00', '2018-09-07 09:50:07'),
(298, 10, 32, 'Survey Question', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-07 00:00:00', '2018-09-07 09:54:36'),
(328, 10, 33, 'Survey Question-12', 1, '#eb9f0d', '18px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-07 00:00:00', '2018-09-07 10:22:03'),
(339, 10, 34, 'RTL - SURVEY QUESTION-1', 1, '#0f0101', '30px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-07 00:00:00', '2018-09-07 10:32:46'),
(423, 10, 35, 'اقتراحاتكم تهمنا لتحسين جودة الدورات التدريبية', 4, NULL, '15px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-09 00:00:00', '2018-09-09 14:06:31'),
(417, 10, 35, 'المستوى المعرفي للمدرب', 5, NULL, '15px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-09 00:00:00', '2018-09-09 14:06:31'),
(418, 10, 35, 'المادة التعليمية', 5, NULL, '15px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-09 00:00:00', '2018-09-09 14:06:31'),
(419, 10, 35, 'جاهزية القاعة التدريبية', 5, NULL, '15px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-09 00:00:00', '2018-09-09 14:06:31'),
(420, 10, 35, 'مستوى الأستفادة من الدورة التدريبية', 5, NULL, '15px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-09 00:00:00', '2018-09-09 14:06:31'),
(421, 10, 35, 'هل تنصح بالدورة التدريبية لصديق', 1, NULL, '15px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-09 00:00:00', '2018-09-09 14:06:31'),
(422, 10, 35, 'هل انت مهتم بدورات اخرى من مركز سماء النخبة', 1, NULL, '15px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-09 00:00:00', '2018-09-09 14:06:31'),
(449, 10, 36, 'اقتراحاتكم تهمنا لتحسين الجودة', 4, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-19 00:00:00', '2018-09-19 09:20:41'),
(447, 10, 36, 'مواعيد التوصيل', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-19 00:00:00', '2018-09-19 09:20:41'),
(448, 10, 36, 'هل تنصح الأقارب و الأصداق بتعامل معنا', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-19 00:00:00', '2018-09-19 09:20:41'),
(446, 10, 36, 'تنوع المنتجات', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-19 00:00:00', '2018-09-19 09:20:41'),
(445, 10, 36, 'تعامل الموظفين', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-19 00:00:00', '2018-09-19 09:20:41'),
(453, 10, 41, 'S-Q-1', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-24 00:00:00', '2018-09-24 12:05:52'),
(451, 10, 40, 'S-Q-1', 1, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-24 00:00:00', '2018-09-24 10:26:39'),
(444, 10, 38, 'قاعة الطعام و الديكور العام', 5, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-18 00:00:00', '2018-09-18 12:55:13'),
(450, 10, 39, 'how is your rate for save earth?', 1, '#1e5cb8', '18px', '', '', '', '', '', '', '', '', '', '', 0, 1, '2018-09-21 00:00:00', '2018-09-21 14:06:35'),
(486, 10, 55, 'asdasd', 6, '#916e6e', '16px', 'public/emoji/img/1f60f.png', 'emoji 1', 'public/emoji/img/1f62e.png', 'emoji 2', 'public/emoji/img/1f325.png', 'emoji 3', 'public/emoji/img/1f62f.png', 'emoji 4', 'public/emoji/img/1f60e.png', 'emoji 5', 0, 1, '2019-06-05 00:00:00', '2019-06-05 10:54:14'),
(488, 10, 36, 'Rushi Test', 6, '#bf4444', '12px', 'public/emoji/img/1f620.png', 'emoji 6', 'public/emoji/img/1f621.png', 'emoji 7', 'public/emoji/img/1f628.png', 'emoji 8', 'public/emoji/img/1f496.png', 'emoji 9', 'public/emoji/img/1f608.png', 'emoji 10', 0, 1, '2019-06-05 00:00:00', '2019-06-05 12:23:23'),
(489, 10, 43, 'hi', 6, '#000000', NULL, 'public/emoji/img/1f325.png', 'hi', 'public/emoji/img/1f327.png', 'hello', 'public/emoji/img/1f60f.png', 'by', 'public/emoji/img/1f49e.png', 'dfv', 'public/emoji/img/1f60e.png', 'fv', 0, 1, '2019-06-05 00:00:00', '2019-06-05 15:21:33'),
(493, 10, 44, 'vdfv', 6, '#e31818', '17px', 'public/emoji/img/1f327.png', 'fgh', 'public/emoji/img/1f61f.png', 'fgh', 'public/emoji/img/1f49e.png', 'fgh', 'public/emoji/img/1f60b.png', 'fgh', 'public/emoji/img/1f61a.png', 'fgh', 0, 1, '2019-06-05 00:00:00', '2019-06-05 15:22:56'),
(492, 10, 44, 'hi', 6, '#000000', NULL, 'public/emoji/img/1f325.png', 'hi', 'public/emoji/img/1f327.png', 'hello', 'public/emoji/img/1f60f.png', 'by', 'public/emoji/img/1f49e.png', 'dfv', 'public/emoji/img/1f60e.png', 'fv', 0, 1, '2019-06-05 00:00:00', '2019-06-05 15:22:56'),
(528, 10, 45, 'hi', 3, '#d22222', '17px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2019-08-29 00:00:00', '2019-08-29 03:58:44'),
(544, 10, 46, 'افتراحات تطويرية في المنتج و الخدمات', 4, NULL, '17px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2019-09-02 00:00:00', '2019-09-02 06:21:52'),
(543, 10, 46, 'جودة الخدمة', 6, NULL, '17px', 'emoji/img/1f61a.png', NULL, 'emoji/img/1f49a.png', NULL, 'emoji/img/1f60a.png', NULL, 'emoji/img/1f47b.png', NULL, 'emoji/img/1f60f.png', NULL, 0, 1, '2019-09-02 00:00:00', '2019-09-02 06:21:52'),
(542, 10, 46, 'تعامل الموظفين', 6, NULL, '17px', 'emoji/img/1f61a.png', NULL, 'emoji/img/1f49a.png', NULL, 'emoji/img/1f60a.png', NULL, 'emoji/img/1f47b.png', NULL, 'emoji/img/1f60f.png', NULL, 0, 1, '2019-09-02 00:00:00', '2019-09-02 06:21:52'),
(541, 10, 46, 'وقت الأنتظار', 6, NULL, '17px', 'emoji/img/1f61a.png', NULL, 'emoji/img/1f49a.png', NULL, 'emoji/img/1f60a.png', NULL, 'emoji/img/1f47b.png', NULL, 'emoji/img/1f60f.png', NULL, 0, 1, '2019-09-02 00:00:00', '2019-09-02 06:21:52'),
(526, 10, 45, 'Survay Question 1', 6, '#226b4c', '1px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2019-08-29 00:00:00', '2019-08-29 03:58:44'),
(527, 10, 45, 'Survay Question 2', 6, '#392996', '1px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2019-08-29 00:00:00', '2019-08-29 03:58:44'),
(545, 10, 47, 'Survay Question 3', 6, NULL, NULL, 'emoji/img/1f62f.png', NULL, 'emoji/img/1f62f.png', NULL, 'emoji/img/1f49e.png', NULL, 'emoji/img/1f62f.png', NULL, 'emoji/img/1f49e.png', NULL, 0, 1, '2019-09-19 00:00:00', '2019-09-19 03:23:10'),
(505, 10, 48, 'Survay Question 3', 6, '#5618c8', '12px', 'emoji/img/1f62d.png', 'emoji 1', 'emoji/img/1f60f.png', 'emoji 2', 'emoji/img/1f62e.png', 'emoji 3', 'emoji/img/1f327.png', 'emoji 4', 'emoji/img/1f497.png', 'emoji 5', 0, 1, '2019-07-10 00:00:00', '2019-07-10 06:21:08'),
(506, 10, 49, 'Survay Question 3', 2, '#396a51', '10px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2019-07-12 00:00:00', '2019-07-12 04:06:36'),
(546, 10, 47, 'Survay Question 4', 3, '#176f52', '11px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2019-09-19 00:00:00', '2019-09-19 03:23:10'),
(547, 10, 47, 'Test', 1, '#4f9943', '10px', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2019-09-19 00:00:00', '2019-09-19 03:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_types`
--

CREATE TABLE `tbl_types` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: In-Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: Not Deleted, 1: Deleted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_types`
--

INSERT INTO `tbl_types` (`id`, `user_id`, `type_name`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 10, 'This is test gdfgfd', 1, 1, '2018-05-02 18:30:00', '2018-05-03 07:43:12'),
(2, 10, 'First Type', 1, 0, '2018-05-02 18:30:00', '2018-05-19 02:48:20'),
(3, 10, 'This is last Type', 1, 0, '2018-05-18 18:30:00', '2018-05-19 02:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_permission`
--

CREATE TABLE `tbl_user_permission` (
  `id` int(11) NOT NULL,
  `view_dashboard` tinyint(1) DEFAULT NULL,
  `view_setting` tinyint(1) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `view_common_setting` int(11) DEFAULT NULL,
  `view_manage_user` tinyint(1) DEFAULT NULL,
  `view_manage_category` tinyint(1) DEFAULT NULL,
  `view_manage_group` tinyint(1) DEFAULT NULL,
  `view_manage_type` tinyint(1) DEFAULT NULL,
  `view_manage_survey_form` tinyint(1) DEFAULT NULL,
  `view_manage_participant` tinyint(1) DEFAULT NULL,
  `add_participant` tinyint(1) DEFAULT NULL,
  `participant_list` tinyint(1) DEFAULT NULL,
  `view_manage_send_survey` tinyint(1) DEFAULT NULL,
  `view_email_campaign` tinyint(1) DEFAULT NULL,
  `view_sms_campaign` tinyint(1) DEFAULT NULL,
  `view_kpi_campaign` tinyint(1) DEFAULT NULL,
  `add_survey_form` tinyint(1) DEFAULT NULL,
  `survey_form_list` tinyint(1) DEFAULT NULL,
  `group_list` tinyint(1) DEFAULT NULL,
  `add_group` tinyint(1) DEFAULT NULL,
  `type_list` tinyint(1) DEFAULT NULL,
  `add_list` tinyint(1) DEFAULT NULL,
  `manual_send_survey` tinyint(1) DEFAULT NULL,
  `auto_send_survey` tinyint(1) DEFAULT NULL,
  `trigger_list_survey` tinyint(1) DEFAULT NULL,
  `add_trigger_survey` tinyint(1) DEFAULT NULL,
  `schedule_survey` tinyint(1) DEFAULT NULL,
  `schedule_list_survey` tinyint(1) DEFAULT NULL,
  `add_schedule_survey` tinyint(1) DEFAULT NULL,
  `manage_survey_report` tinyint(1) DEFAULT NULL,
  `manage_kpi_campaign` tinyint(1) DEFAULT NULL,
  `manage_create_kpi` tinyint(1) DEFAULT NULL,
  `manage_kpi_report` tinyint(1) DEFAULT NULL,
  `view_participant_setting` tinyint(1) DEFAULT NULL,
  `add_participant_category` tinyint(1) DEFAULT NULL,
  `view_category_list` tinyint(1) DEFAULT NULL,
  `view_manage_template` tinyint(1) DEFAULT NULL,
  `manage_email_list` tinyint(1) DEFAULT NULL,
  `manage_add_email` tinyint(1) DEFAULT NULL,
  `manage_sms_list` tinyint(1) DEFAULT NULL,
  `manage_add_sms` tinyint(1) DEFAULT NULL,
  `manage_user_list` tinyint(1) DEFAULT NULL,
  `manage_add_user` tinyint(1) DEFAULT NULL,
  `view_manage_report` tinyint(1) DEFAULT NULL,
  `quick_participant_setting` int(11) DEFAULT NULL,
  `feedback_survey` int(50) DEFAULT 0,
  `question_list` int(50) DEFAULT NULL,
  `feedback_setting` int(50) DEFAULT NULL,
  `show_question_answer` int(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_permission`
--

INSERT INTO `tbl_user_permission` (`id`, `view_dashboard`, `view_setting`, `user_id`, `view_common_setting`, `view_manage_user`, `view_manage_category`, `view_manage_group`, `view_manage_type`, `view_manage_survey_form`, `view_manage_participant`, `add_participant`, `participant_list`, `view_manage_send_survey`, `view_email_campaign`, `view_sms_campaign`, `view_kpi_campaign`, `add_survey_form`, `survey_form_list`, `group_list`, `add_group`, `type_list`, `add_list`, `manual_send_survey`, `auto_send_survey`, `trigger_list_survey`, `add_trigger_survey`, `schedule_survey`, `schedule_list_survey`, `add_schedule_survey`, `manage_survey_report`, `manage_kpi_campaign`, `manage_create_kpi`, `manage_kpi_report`, `view_participant_setting`, `add_participant_category`, `view_category_list`, `view_manage_template`, `manage_email_list`, `manage_add_email`, `manage_sms_list`, `manage_add_sms`, `manage_user_list`, `manage_add_user`, `view_manage_report`, `quick_participant_setting`, `feedback_survey`, `question_list`, `feedback_setting`, `show_question_answer`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 10, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2018-05-25 15:20:27', '2018-05-25 06:14:34'),
(2, NULL, 1, 17, 1, 0, 0, 0, 1, 0, 0, NULL, NULL, 1, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2018-05-25 15:20:27', '2018-05-25 06:14:34'),
(3, NULL, 1, 33, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2018-05-25 15:20:27', '2018-07-26 23:37:51'),
(4, NULL, 1, 34, 1, NULL, 1, NULL, 1, NULL, 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2018-05-25 15:20:27', '2018-09-01 05:08:46'),
(5, NULL, 1, 37, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '2020-04-05 00:00:00', '2018-09-04 21:32:30'),
(6, NULL, 1, 38, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2020-04-05 00:00:00', '2018-05-28 06:48:51'),
(7, NULL, NULL, 39, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2019-03-08 00:00:00', '2018-09-01 03:11:09'),
(8, 1, 1, 40, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 0, NULL, NULL, NULL, '2018-01-09 00:00:00', '2018-09-17 21:36:14'),
(9, NULL, 1, 40, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, 1, 1, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '2018-01-09 00:00:00', '2018-09-01 21:16:31'),
(10, NULL, NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2018-01-09 00:00:00', '2018-09-02 00:35:46'),
(11, 1, NULL, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '2018-05-09 00:00:00', '2018-09-05 12:45:18'),
(12, 1, NULL, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '2018-05-09 00:00:00', '2018-09-05 12:59:38'),
(13, 1, 1, 44, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '2019-03-09 00:00:00', '2018-09-18 19:09:14'),
(14, 1, 1, 45, 1, NULL, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '2019-05-09 00:00:00', '2018-09-19 18:50:19'),
(15, 1, NULL, 46, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2019-09-09 00:00:00', '2018-09-22 15:16:52'),
(16, 1, NULL, 47, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2019-09-09 00:00:00', '2018-09-22 15:16:30'),
(17, 1, NULL, 48, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2019-09-09 00:00:00', '2018-09-22 15:16:15'),
(18, 1, NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2019-09-09 00:00:00', '2018-09-22 15:16:02'),
(19, 1, 1, 50, 1, NULL, NULL, NULL, 1, NULL, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '2019-09-09 00:00:00', '2018-09-21 17:49:44'),
(20, 1, 1, 51, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '2019-09-09 00:00:00', '2018-09-21 17:56:15'),
(21, 1, 1, 52, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 0, NULL, NULL, NULL, '2018-08-10 00:00:00', '2018-10-08 17:31:48'),
(22, 1, NULL, 53, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, NULL, NULL, 1, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, 1, 1, 1, 1, '2019-02-05 00:00:00', '2019-05-02 07:16:51'),
(23, NULL, NULL, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-05 00:00:00', '2019-05-15 09:10:44'),
(24, NULL, NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-05 00:00:00', '2019-05-31 21:31:21'),
(25, NULL, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-06 00:00:00', '2019-06-05 09:57:39'),
(26, NULL, NULL, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-06 00:00:00', '2019-06-11 03:00:05'),
(27, NULL, NULL, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-06 00:00:00', '2019-06-17 11:36:37'),
(28, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-07 00:00:00', '2019-07-09 15:52:23'),
(29, NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-07 00:00:00', '2019-07-18 09:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id` int(11) NOT NULL COMMENT '0: For Admin, 1: For User',
  `role` varchar(155) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) DEFAULT NULL,
  `status` int(50) NOT NULL DEFAULT 0,
  `view_dashboard` int(11) DEFAULT NULL,
  `view_setting` tinyint(11) DEFAULT NULL,
  `view_common_setting` tinyint(11) DEFAULT NULL,
  `view_manage_user` tinyint(11) DEFAULT NULL,
  `view_manage_category` tinyint(11) DEFAULT NULL,
  `view_manage_group` tinyint(11) DEFAULT NULL,
  `view_manage_type` tinyint(11) DEFAULT NULL,
  `view_manage_survey_form` tinyint(11) DEFAULT NULL,
  `view_manage_participant` tinyint(11) DEFAULT NULL,
  `add_participant` tinyint(11) DEFAULT NULL,
  `participant_list` tinyint(11) DEFAULT NULL,
  `view_manage_send_survey` tinyint(11) DEFAULT NULL,
  `view_email_campaign` tinyint(11) DEFAULT NULL,
  `view_sms_campaign` tinyint(11) DEFAULT NULL,
  `view_kpi_campaign` tinyint(11) DEFAULT NULL,
  `add_survey_form` tinyint(11) DEFAULT NULL,
  `survey_form_list` tinyint(11) DEFAULT NULL,
  `group_list` tinyint(11) DEFAULT NULL,
  `add_group` tinyint(11) DEFAULT NULL,
  `type_list` tinyint(11) DEFAULT NULL,
  `add_list` tinyint(11) DEFAULT NULL,
  `manual_send_survey` tinyint(11) DEFAULT NULL,
  `auto_send_survey` tinyint(11) DEFAULT NULL,
  `trigger_list_survey` tinyint(11) DEFAULT NULL,
  `add_trigger_survey` tinyint(11) DEFAULT NULL,
  `schedule_survey` tinyint(11) DEFAULT NULL,
  `schedule_list_survey` tinyint(11) DEFAULT NULL,
  `add_schedule_survey` tinyint(11) DEFAULT NULL,
  `manage_survey_report` tinyint(11) DEFAULT NULL,
  `manage_kpi_campaign` tinyint(11) DEFAULT NULL,
  `manage_create_kpi` tinyint(11) DEFAULT NULL,
  `manage_kpi_report` tinyint(11) DEFAULT NULL,
  `view_participant_setting` tinyint(11) DEFAULT NULL,
  `add_participant_category` tinyint(11) DEFAULT NULL,
  `view_category_list` tinyint(11) DEFAULT NULL,
  `view_manage_template` tinyint(11) DEFAULT NULL,
  `manage_email_list` tinyint(11) DEFAULT NULL,
  `manage_add_email` tinyint(11) DEFAULT NULL,
  `manage_sms_list` tinyint(11) DEFAULT NULL,
  `manage_add_sms` tinyint(11) DEFAULT NULL,
  `manage_user_list` tinyint(11) DEFAULT NULL,
  `manage_add_user` tinyint(11) DEFAULT NULL,
  `view_manage_report` tinyint(11) DEFAULT NULL,
  `quick_participant_setting` tinyint(11) DEFAULT NULL,
  `user_role` tinyint(11) DEFAULT NULL,
  `feedback_terminals` tinyint(11) DEFAULT NULL,
  `question_list` tinyint(11) DEFAULT NULL,
  `feedback_setting` tinyint(11) DEFAULT NULL,
  `show_question_answer` tinyint(11) DEFAULT NULL,
  `auto_send_survey_survey` tinyint(11) DEFAULT NULL,
  `add_type` tinyint(11) DEFAULT NULL,
  `question_kpi_report` tinyint(11) DEFAULT NULL,
  `question_chart` tinyint(11) DEFAULT NULL,
  `live_link` tinyint(11) DEFAULT NULL,
  `report_kpi` tinyint(11) DEFAULT NULL,
  `report_kpi_sms_feedback` tinyint(11) DEFAULT NULL,
  `report_kpi_reasons_complains` tinyint(11) DEFAULT NULL,
  `complains_status` tinyint(11) DEFAULT NULL,
  `participants_list` tinyint(11) DEFAULT NULL,
  `quick_add_participants_button` tinyint(11) NOT NULL,
  `complaints` tinyint(11) DEFAULT NULL,
  `feedback_ratings` tinyint(11) DEFAULT NULL,
  `feedback_reply` tinyint(11) DEFAULT NULL,
  `sms` tinyint(11) DEFAULT NULL,
  `email` tinyint(11) DEFAULT NULL,
  `sms_balance` tinyint(11) DEFAULT NULL,
  `complaints_box` tinyint(11) DEFAULT NULL,
  `feedback_terminal_response` tinyint(11) DEFAULT NULL,
  `new_participant` tinyint(11) DEFAULT NULL,
  `updated_participant` tinyint(11) DEFAULT NULL,
  `reason_kpi` int(11) DEFAULT NULL,
  `reason_chart` int(11) DEFAULT NULL,
  `complain_kpi` int(11) DEFAULT NULL,
  `complain_chart` int(11) DEFAULT NULL,
  `complainMenu` int(50) DEFAULT NULL,
  `notification_template` int(11) DEFAULT NULL,
  `reset_setting` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `get_complain_setting` int(11) DEFAULT NULL,
  `get_reason_setting` int(11) DEFAULT NULL,
  `complain_pop_up` int(11) DEFAULT NULL,
  `feedback_terminals_2` tinyint(11) DEFAULT NULL,
  `feedback_setting_2` tinyint(11) DEFAULT NULL,
  `get_reason_setting_2` tinyint(11) DEFAULT NULL,
  `reason_chart_2` tinyint(11) DEFAULT NULL,
  `feedback_ratings_2` tinyint(11) DEFAULT NULL,
  `feedback_reply_2` tinyint(11) DEFAULT NULL,
  `question_chart_2` tinyint(11) DEFAULT NULL,
  `question_list_2` tinyint(11) DEFAULT NULL,
  `live_link_2` tinyint(11) DEFAULT NULL,
  `complainMenu_2` tinyint(11) DEFAULT NULL,
  `complaints_2` tinyint(11) DEFAULT NULL,
  `complain_chart_2` tinyint(11) DEFAULT NULL,
  `notification_template_2` tinyint(11) DEFAULT NULL,
  `get_complain_setting_2` tinyint(11) DEFAULT NULL,
  `complain_pop_up_2` tinyint(11) DEFAULT NULL,
  `feedback_terminals_4` tinyint(11) DEFAULT NULL,
  `question_list_4` tinyint(11) DEFAULT NULL,
  `feedback_setting_4` tinyint(11) DEFAULT NULL,
  `get_reason_setting_4` tinyint(11) DEFAULT NULL,
  `reason_chart_4` tinyint(11) DEFAULT NULL,
  `feedback_ratings_4` tinyint(11) DEFAULT NULL,
  `feedback_reply_4` tinyint(11) DEFAULT NULL,
  `question_chart_4` tinyint(11) DEFAULT NULL,
  `live_link_4` tinyint(11) DEFAULT NULL,
  `complainMenu_4` tinyint(11) DEFAULT NULL,
  `complaints_4` tinyint(11) DEFAULT NULL,
  `complain_chart_4` tinyint(11) DEFAULT NULL,
  `notification_template_4` tinyint(11) DEFAULT NULL,
  `get_complain_setting_4` tinyint(11) DEFAULT NULL,
  `complain_pop_up_4` tinyint(11) DEFAULT NULL,
  `feedback_terminals_3` tinyint(11) DEFAULT NULL,
  `feedback_setting_3` tinyint(11) DEFAULT NULL,
  `get_reason_setting_3` tinyint(11) DEFAULT NULL,
  `reason_chart_3` tinyint(11) DEFAULT NULL,
  `feedback_ratings_3` tinyint(11) DEFAULT NULL,
  `feedback_reply_3` tinyint(11) DEFAULT NULL,
  `question_chart_3` tinyint(11) DEFAULT NULL,
  `question_list_3` tinyint(11) DEFAULT NULL,
  `live_link_3` tinyint(11) DEFAULT NULL,
  `complainMenu_3` tinyint(11) DEFAULT NULL,
  `complaints_3` tinyint(11) DEFAULT NULL,
  `complain_chart_3` tinyint(11) DEFAULT NULL,
  `notification_template_3` tinyint(11) DEFAULT NULL,
  `get_complain_setting_3` tinyint(11) DEFAULT NULL,
  `complain_pop_up_3` tinyint(11) DEFAULT NULL,
  `feedback_terminals_5` tinyint(11) DEFAULT NULL,
  `question_list_5` tinyint(11) DEFAULT NULL,
  `feedback_setting_5` tinyint(11) DEFAULT NULL,
  `get_reason_setting_5` tinyint(11) DEFAULT NULL,
  `reason_chart_5` tinyint(11) DEFAULT NULL,
  `feedback_ratings_5` tinyint(11) DEFAULT NULL,
  `feedback_reply_5` tinyint(11) DEFAULT NULL,
  `question_chart_5` tinyint(11) DEFAULT NULL,
  `live_link_5` tinyint(11) DEFAULT NULL,
  `complainMenu_5` tinyint(11) DEFAULT NULL,
  `complaints_5` tinyint(11) DEFAULT NULL,
  `complain_chart_5` tinyint(11) DEFAULT NULL,
  `notification_template_5` tinyint(11) DEFAULT NULL,
  `get_complain_setting_5` tinyint(11) DEFAULT NULL,
  `complain_pop_up_5` tinyint(11) DEFAULT NULL,
  `dashboard_feedback_terminals_2` int(11) DEFAULT NULL,
  `dashboard_feedback_terminals_3` int(11) DEFAULT NULL,
  `dashboard_feedback_terminals_4` int(11) DEFAULT NULL,
  `dashboard_feedback_terminals_5` int(11) DEFAULT NULL,
  `dashboard_feedback_reason_2` int(11) DEFAULT NULL,
  `dashboard_feedback_reason_3` int(11) DEFAULT NULL,
  `dashboard_feedback_reason_4` int(11) DEFAULT NULL,
  `dashboard_feedback_reason_5` int(11) DEFAULT NULL,
  `feedback_response` int(11) DEFAULT NULL,
  `feedback_response_2` int(11) DEFAULT NULL,
  `feedback_response_3` int(11) DEFAULT NULL,
  `feedback_response_4` int(11) DEFAULT NULL,
  `feedback_response_5` int(11) DEFAULT NULL,
  `userReport` int(11) DEFAULT NULL,
  `userReport_2` int(11) DEFAULT NULL,
  `userReport_3` int(11) DEFAULT NULL,
  `userReport_4` int(11) DEFAULT NULL,
  `userReport_5` int(11) DEFAULT NULL,
  `get_user_report` int(11) DEFAULT NULL,
  `get_user_report_2` int(11) DEFAULT NULL,
  `get_user_report_3` int(11) DEFAULT NULL,
  `get_user_report_4` int(11) DEFAULT NULL,
  `get_user_report_5` int(11) DEFAULT NULL,
  `get_location_report` int(11) DEFAULT NULL,
  `get_location_report_2` int(11) DEFAULT NULL,
  `get_location_report_3` int(11) DEFAULT NULL,
  `get_location_report_4` int(11) DEFAULT NULL,
  `get_location_report_5` int(11) DEFAULT NULL,
  `report_sms_feedback` int(11) DEFAULT NULL,
  `kpi_sms_feedback` int(11) DEFAULT NULL,
  `dashboard_feedback_terminals_1` int(11) DEFAULT NULL,
  `dashboard_complain_kpi` int(11) DEFAULT NULL,
  `complain_status_chart` int(11) DEFAULT NULL,
  `dashboard_feedback_reason_1` int(11) DEFAULT NULL,
  `complain_list` int(11) DEFAULT NULL,
  `feedback_terminal_responses_1` int(11) DEFAULT NULL,
  `feedback_terminal_responses_2` int(11) DEFAULT NULL,
  `feedback_terminal_responses_3` int(11) DEFAULT NULL,
  `feedback_terminal_responses_4` int(11) DEFAULT NULL,
  `feedback_terminal_responses_5` int(11) DEFAULT NULL,
  `reason_kpi_dashboard` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id`, `role`, `level`, `status`, `view_dashboard`, `view_setting`, `view_common_setting`, `view_manage_user`, `view_manage_category`, `view_manage_group`, `view_manage_type`, `view_manage_survey_form`, `view_manage_participant`, `add_participant`, `participant_list`, `view_manage_send_survey`, `view_email_campaign`, `view_sms_campaign`, `view_kpi_campaign`, `add_survey_form`, `survey_form_list`, `group_list`, `add_group`, `type_list`, `add_list`, `manual_send_survey`, `auto_send_survey`, `trigger_list_survey`, `add_trigger_survey`, `schedule_survey`, `schedule_list_survey`, `add_schedule_survey`, `manage_survey_report`, `manage_kpi_campaign`, `manage_create_kpi`, `manage_kpi_report`, `view_participant_setting`, `add_participant_category`, `view_category_list`, `view_manage_template`, `manage_email_list`, `manage_add_email`, `manage_sms_list`, `manage_add_sms`, `manage_user_list`, `manage_add_user`, `view_manage_report`, `quick_participant_setting`, `user_role`, `feedback_terminals`, `question_list`, `feedback_setting`, `show_question_answer`, `auto_send_survey_survey`, `add_type`, `question_kpi_report`, `question_chart`, `live_link`, `report_kpi`, `report_kpi_sms_feedback`, `report_kpi_reasons_complains`, `complains_status`, `participants_list`, `quick_add_participants_button`, `complaints`, `feedback_ratings`, `feedback_reply`, `sms`, `email`, `sms_balance`, `complaints_box`, `feedback_terminal_response`, `new_participant`, `updated_participant`, `reason_kpi`, `reason_chart`, `complain_kpi`, `complain_chart`, `complainMenu`, `notification_template`, `reset_setting`, `city`, `get_complain_setting`, `get_reason_setting`, `complain_pop_up`, `feedback_terminals_2`, `feedback_setting_2`, `get_reason_setting_2`, `reason_chart_2`, `feedback_ratings_2`, `feedback_reply_2`, `question_chart_2`, `question_list_2`, `live_link_2`, `complainMenu_2`, `complaints_2`, `complain_chart_2`, `notification_template_2`, `get_complain_setting_2`, `complain_pop_up_2`, `feedback_terminals_4`, `question_list_4`, `feedback_setting_4`, `get_reason_setting_4`, `reason_chart_4`, `feedback_ratings_4`, `feedback_reply_4`, `question_chart_4`, `live_link_4`, `complainMenu_4`, `complaints_4`, `complain_chart_4`, `notification_template_4`, `get_complain_setting_4`, `complain_pop_up_4`, `feedback_terminals_3`, `feedback_setting_3`, `get_reason_setting_3`, `reason_chart_3`, `feedback_ratings_3`, `feedback_reply_3`, `question_chart_3`, `question_list_3`, `live_link_3`, `complainMenu_3`, `complaints_3`, `complain_chart_3`, `notification_template_3`, `get_complain_setting_3`, `complain_pop_up_3`, `feedback_terminals_5`, `question_list_5`, `feedback_setting_5`, `get_reason_setting_5`, `reason_chart_5`, `feedback_ratings_5`, `feedback_reply_5`, `question_chart_5`, `live_link_5`, `complainMenu_5`, `complaints_5`, `complain_chart_5`, `notification_template_5`, `get_complain_setting_5`, `complain_pop_up_5`, `dashboard_feedback_terminals_2`, `dashboard_feedback_terminals_3`, `dashboard_feedback_terminals_4`, `dashboard_feedback_terminals_5`, `dashboard_feedback_reason_2`, `dashboard_feedback_reason_3`, `dashboard_feedback_reason_4`, `dashboard_feedback_reason_5`, `feedback_response`, `feedback_response_2`, `feedback_response_3`, `feedback_response_4`, `feedback_response_5`, `userReport`, `userReport_2`, `userReport_3`, `userReport_4`, `userReport_5`, `get_user_report`, `get_user_report_2`, `get_user_report_3`, `get_user_report_4`, `get_user_report_5`, `get_location_report`, `get_location_report_2`, `get_location_report_3`, `get_location_report_4`, `get_location_report_5`, `report_sms_feedback`, `kpi_sms_feedback`, `dashboard_feedback_terminals_1`, `dashboard_complain_kpi`, `complain_status_chart`, `dashboard_feedback_reason_1`, `complain_list`, `feedback_terminal_responses_1`, `feedback_terminal_responses_2`, `feedback_terminal_responses_3`, `feedback_terminal_responses_4`, `feedback_terminal_responses_5`, `reason_kpi_dashboard`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-23 05:06:58', '2019-09-09 03:42:58'),
(2, 'User', 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-06 11:40:47', '2019-09-18 03:47:46'),
(3, 'Participant', 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1, NULL, 1, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-06 11:40:58', '2019-07-23 05:12:10'),
(4, 'Quality Manager', 4, 1, 1, 1, NULL, 1, NULL, NULL, NULL, 1, 1, 1, NULL, 1, NULL, NULL, NULL, 1, 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-06 11:44:18', '2019-08-25 16:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) UNSIGNED NOT NULL,
  `user_name` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Token for forget password',
  `address` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `terms_condition` int(10) NOT NULL,
  `user_role` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '''0'' => ''Admin'',''1'' => ''User''',
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(10) NOT NULL DEFAULT 1 COMMENT '0->InActive,1->Active,-2->Pending',
  `user_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_logo` text COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `name`, `email`, `email_token`, `address`, `mobile_number`, `business_name`, `city`, `country`, `terms_condition`, `user_role`, `password`, `created_at`, `updated_at`, `status`, `user_image`, `user_logo`, `remember_token`, `created_by`) VALUES
(1, '', 'Amit', 'amit.d9ithub@gmail.com', '', '', '78945613465', 'Employee', '0', '101', 0, 2, '$2y$10$ewV94bHix9H85WZjlB2Pk.5LkKNZUijp37uJKlIEWYytQDtNHLqQ2', '2019-07-11 03:54:26', '2019-09-18 08:42:59', 1, '', '', '', '0'),
(10, 'admin', 'admin', 'admin@mailinator.com', '', '', '8103172052', '', '0', '30', 0, 0, '$2y$10$Lu0byHcn17W3f3kNsikhPuctnUmhQBiLBrNCCsls9gQU/bZQ4Tucm', '2019-06-18 12:17:32', '2019-09-18 22:04:09', 1, 'uploads/Users/adorable-baby-beautiful-265987-1920190919033409.jpg', 'uploads/users_logo/adorable-baby-bed-1296145-9120190919033409.jpg', 'nP9PXKvzDHdCdIBtWVnoaQBoKL21j6Cz2BzJpwUxnVoFnjGy6Vlyo9nFQ6lO', '0'),
(13, '', 'mohammed', 'Mohammed.almajed.1987@gmail.com', '', '', '543644494', 'Ola', '4', '191', 0, 4, '$2y$10$l0sZN4NIVY7sg./X3gDD6.L54Ygcz7sHGYl2OfpmXrJzhukT8DCWq', '2019-07-18 04:45:31', '2019-07-18 09:45:31', 1, '', '', '', '10'),
(14, '', 'Dhruv Patel', 'd9ithub+1@gmail.com', '', '', '9374686975', 'Software Industry', '5', '101', 0, 4, '$2y$10$BNKrLHpZmZt5AaIJ0cyUdeWd9k3TPceaK3ekBcgMeVnCIpNijuijK', '2019-08-06 11:18:22', '2019-08-06 16:18:22', 1, 'uploads/Users/DSC_0715-7020190806111822.JPG', '', '', '10'),
(15, '', 'ali almajed', 'adminf@mailinator.com', '', '', '543644494', 'ali', '5', '191', 0, 4, '$2y$10$we.W5vRQLxW8T8hYz39z9eeRnuV3.J4MGRpNN0amSyAJGssgWXPJS', '2019-08-25 11:01:18', '2019-08-25 16:01:18', 1, '', '', '', '10'),
(16, '', 'Rushi Purohit', 'rushi.d9ithub@gmail.com', '', '', '4464646464', 'D9ithub', '3', '101', 0, 1, '$2y$10$yP93dhTebEdGst2t4sY/e.9CRy5Sbu0ohUgqzEmq./f.W.Xo7dM7W', '2019-09-09 09:24:06', '2019-09-09 14:24:06', 1, '', '', '', '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_notification`
--
ALTER TABLE `complain_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_complains`
--
ALTER TABLE `feedback_complains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_question`
--
ALTER TABLE `feedback_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_rating`
--
ALTER TABLE `feedback_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_reason`
--
ALTER TABLE `feedback_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_survey`
--
ALTER TABLE `feedback_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_sms_email`
--
ALTER TABLE `reset_sms_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selected_feedback_question`
--
ALTER TABLE `selected_feedback_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_auto_trigger_setting`
--
ALTER TABLE `tbl_auto_trigger_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kpi`
--
ALTER TABLE `tbl_kpi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_participants`
--
ALTER TABLE `tbl_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quick_add_setting`
--
ALTER TABLE `tbl_quick_add_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scheduled_participant`
--
ALTER TABLE `tbl_scheduled_participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule_count`
--
ALTER TABLE `tbl_schedule_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule_reminder`
--
ALTER TABLE `tbl_schedule_reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule_reminder_count`
--
ALTER TABLE `tbl_schedule_reminder_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sms_template`
--
ALTER TABLE `tbl_sms_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_count`
--
ALTER TABLE `tbl_survey_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_form`
--
ALTER TABLE `tbl_survey_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_form_info`
--
ALTER TABLE `tbl_survey_form_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_form_info_checkbox_ans`
--
ALTER TABLE `tbl_survey_form_info_checkbox_ans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_options`
--
ALTER TABLE `tbl_survey_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_survey_question`
--
ALTER TABLE `tbl_survey_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_types`
--
ALTER TABLE `tbl_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_permission`
--
ALTER TABLE `tbl_user_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emai--l` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complain_notification`
--
ALTER TABLE `complain_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `feedback_complains`
--
ALTER TABLE `feedback_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback_question`
--
ALTER TABLE `feedback_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback_rating`
--
ALTER TABLE `feedback_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `feedback_reason`
--
ALTER TABLE `feedback_reason`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `feedback_survey`
--
ALTER TABLE `feedback_survey`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `reset_sms_email`
--
ALTER TABLE `reset_sms_email`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `selected_feedback_question`
--
ALTER TABLE `selected_feedback_question`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_auto_trigger_setting`
--
ALTER TABLE `tbl_auto_trigger_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_kpi`
--
ALTER TABLE `tbl_kpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_participants`
--
ALTER TABLE `tbl_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `tbl_quick_add_setting`
--
ALTER TABLE `tbl_quick_add_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_scheduled_participant`
--
ALTER TABLE `tbl_scheduled_participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `tbl_schedule_count`
--
ALTER TABLE `tbl_schedule_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_schedule_reminder`
--
ALTER TABLE `tbl_schedule_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_schedule_reminder_count`
--
ALTER TABLE `tbl_schedule_reminder_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_sms_template`
--
ALTER TABLE `tbl_sms_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_survey_count`
--
ALTER TABLE `tbl_survey_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT for table `tbl_survey_form`
--
ALTER TABLE `tbl_survey_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_survey_form_info`
--
ALTER TABLE `tbl_survey_form_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `tbl_survey_form_info_checkbox_ans`
--
ALTER TABLE `tbl_survey_form_info_checkbox_ans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbl_survey_options`
--
ALTER TABLE `tbl_survey_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=528;

--
-- AUTO_INCREMENT for table `tbl_survey_question`
--
ALTER TABLE `tbl_survey_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

--
-- AUTO_INCREMENT for table `tbl_types`
--
ALTER TABLE `tbl_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_permission`
--
ALTER TABLE `tbl_user_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '0: For Admin, 1: For User', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
