-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2017 at 10:07 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbschools`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_voucher`
--

CREATE TABLE `account_voucher` (
  `id_account_voucher` int(11) NOT NULL,
  `voucher_number` varchar(50) NOT NULL,
  `account_voucher_type_id` int(11) NOT NULL,
  `voucher_date` datetime NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `description` mediumtext,
  `voucher_status` varchar(50) NOT NULL,
  `cancellation_date` datetime DEFAULT NULL,
  `bp_id` int(11) NOT NULL,
  `bp_type` varchar(50) NOT NULL,
  `bp_name` varchar(50) NOT NULL,
  `verified` varchar(50) NOT NULL DEFAULT 'Unverified',
  `verified_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `account_voucher`
--

INSERT INTO `account_voucher` (`id_account_voucher`, `voucher_number`, `account_voucher_type_id`, `voucher_date`, `created_on`, `created_by`, `description`, `voucher_status`, `cancellation_date`, `bp_id`, `bp_type`, `bp_name`, `verified`, `verified_by`, `approved_by`) VALUES
(35, 'JV-17061', 5, '2017-06-04 12:00:00', '2017-06-04 19:51:45', 5, '', 'Unposted', NULL, 1, 'Employees', 'Habibullah Afridi ( Tax applied :  0% )', 'Unverified', 0, 0),
(36, 'JV-17062', 5, '2017-06-04 12:00:00', '2017-06-04 20:38:15', 5, '', 'Posted', NULL, 1, 'Employees', 'Habibullah Afridi ( Tax applied :  0% )', 'Unverified', 0, 5),
(37, 'RV-17081', 3, '2017-08-07 00:00:00', '2017-08-07 16:07:58', 5, 'test', 'Posted', NULL, 101, 'Vendors', 'ABC entrprise ( Tax applied :  0.00% )', 'Unverified', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `account_voucher_details`
--

CREATE TABLE `account_voucher_details` (
  `id_account_voucher_details` int(11) NOT NULL,
  `transaction_type` varchar(50) DEFAULT NULL,
  `transaction_account_id` int(11) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `account_voucher_id` int(11) NOT NULL,
  `remarks` mediumtext NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `payment_method` enum('Cash','Bank') NOT NULL,
  `instrument_no` varchar(50) NOT NULL,
  `voucher_detail_date` datetime NOT NULL,
  `debit` decimal(16,2) NOT NULL DEFAULT '0.00',
  `credit` decimal(16,2) NOT NULL DEFAULT '0.00',
  `cost_center_type` varchar(150) NOT NULL,
  `cost_center_name` varchar(150) NOT NULL,
  `cost_center_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `account_voucher_details`
--

INSERT INTO `account_voucher_details` (`id_account_voucher_details`, `transaction_type`, `transaction_account_id`, `amount`, `account_voucher_id`, `remarks`, `payment_mode`, `payment_method`, `instrument_no`, `voucher_detail_date`, `debit`, `credit`, `cost_center_type`, `cost_center_name`, `cost_center_id`) VALUES
(112, 'Debit', 105, NULL, 36, '4500 ', 'Cash', 'Cash', '544566', '2017-06-04 00:00:00', '600.00', '0.00', 'Departments', 'Administration', 2),
(113, 'Credit', 105, NULL, 36, '4500 ', 'Cash', 'Cash', '544566', '2017-06-04 00:00:00', '0.00', '600.00', 'Campus', 'Baldia Town-Rasheedabad', 1),
(114, 'Debit', 108, NULL, 36, 'test', 'Cash', 'Cash', '987', '2017-06-04 00:00:00', '500.00', '0.00', 'Departments', 'Administration', 2),
(115, 'Credit', 115, NULL, 36, 'test', 'Cash', 'Cash', '987', '2017-06-04 00:00:00', '0.00', '500.00', 'Departments', 'Administration', 2),
(116, 'Credit', 1, NULL, 37, 'test', 'Cheque', 'Bank', '44665', '2017-08-07 00:00:00', '0.00', '5000.00', 'Campus', 'Baldia Town-Rasheedabad', 1),
(117, 'Debit', 14, NULL, 37, 'test', 'Cheque', 'Bank', '44665', '2017-08-07 00:00:00', '5000.00', '0.00', 'Departments', 'Administration', 2);

-- --------------------------------------------------------

--
-- Table structure for table `account_voucher_type`
--

CREATE TABLE `account_voucher_type` (
  `id_account_voucher_type` int(11) NOT NULL,
  `account_voucher_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `account_voucher_type`
--

INSERT INTO `account_voucher_type` (`id_account_voucher_type`, `account_voucher_type`) VALUES
(3, 'Receipt Voucher'),
(4, 'Payment Voucher'),
(5, 'Journal Voucher');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id_notifications` int(11) NOT NULL,
  `on_user_login` int(11) DEFAULT '1',
  `on_concession` int(11) DEFAULT '1',
  `on_day_closing` int(11) DEFAULT '1',
  `on_delete_invoice` int(11) DEFAULT '1',
  `on_changes_dues` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id_notifications`, `on_user_login`, `on_concession`, `on_day_closing`, `on_delete_invoice`, `on_changes_dues`) VALUES
(1, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apps_countries`
--

CREATE TABLE `apps_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `apps_countries`
--

INSERT INTO `apps_countries` (`id`, `country_code`, `country_name`) VALUES
(2, 'BD', 'Bangladesh'),
(3, 'AF', 'Afghanistan'),
(4, 'AL', 'Albania'),
(5, 'DZ', 'Algeria'),
(6, 'DS', 'American Samoa'),
(7, 'AD', 'Andorra'),
(8, 'AO', 'Angola'),
(9, 'AI', 'Anguilla'),
(10, 'AQ', 'Antarctica'),
(11, 'AG', 'Antigua and Barbuda'),
(12, 'AR', 'Argentina'),
(13, 'AM', 'Armenia'),
(14, 'AW', 'Aruba'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British Indian Ocean Territory'),
(34, 'BN', 'Brunei Darussalam'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CA', 'Canada'),
(41, 'CV', 'Cape Verde'),
(42, 'KY', 'Cayman Islands'),
(43, 'CF', 'Central African Republic'),
(44, 'TD', 'Chad'),
(45, 'CL', 'Chile'),
(46, 'CN', 'China'),
(47, 'CX', 'Christmas Island'),
(48, 'CC', 'Cocos (Keeling) Islands'),
(49, 'CO', 'Colombia'),
(50, 'KM', 'Comoros'),
(51, 'CG', 'Congo'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'HR', 'Croatia (Hrvatska)'),
(55, 'CU', 'Cuba'),
(56, 'CY', 'Cyprus'),
(57, 'CZ', 'Czech Republic'),
(58, 'DK', 'Denmark'),
(59, 'DJ', 'Djibouti'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'TP', 'East Timor'),
(63, 'EC', 'Ecuador'),
(64, 'EG', 'Egypt'),
(65, 'SV', 'El Salvador'),
(66, 'GQ', 'Equatorial Guinea'),
(67, 'ER', 'Eritrea'),
(68, 'EE', 'Estonia'),
(69, 'ET', 'Ethiopia'),
(70, 'FK', 'Falkland Islands (Malvinas)'),
(71, 'FO', 'Faroe Islands'),
(72, 'FJ', 'Fiji'),
(73, 'FI', 'Finland'),
(74, 'FR', 'France'),
(75, 'FX', 'France, Metropolitan'),
(76, 'GF', 'French Guiana'),
(77, 'PF', 'French Polynesia'),
(78, 'TF', 'French Southern Territories'),
(79, 'GA', 'Gabon'),
(80, 'GM', 'Gambia'),
(81, 'GE', 'Georgia'),
(82, 'DE', 'Germany'),
(83, 'GH', 'Ghana'),
(84, 'GI', 'Gibraltar'),
(85, 'GK', 'Guernsey'),
(86, 'GR', 'Greece'),
(87, 'GL', 'Greenland'),
(88, 'GD', 'Grenada'),
(89, 'GP', 'Guadeloupe'),
(90, 'GU', 'Guam'),
(91, 'GT', 'Guatemala'),
(92, 'GN', 'Guinea'),
(93, 'GW', 'Guinea-Bissau'),
(94, 'GY', 'Guyana'),
(95, 'HT', 'Haiti'),
(96, 'HM', 'Heard and Mc Donald Islands'),
(97, 'HN', 'Honduras'),
(98, 'HK', 'Hong Kong'),
(99, 'HU', 'Hungary'),
(100, 'IS', 'Iceland'),
(101, 'IN', 'India'),
(102, 'IM', 'Isle of Man'),
(103, 'ID', 'Indonesia'),
(104, 'IR', 'Iran (Islamic Republic of)'),
(105, 'IQ', 'Iraq'),
(106, 'IE', 'Ireland'),
(107, 'IL', 'Israel'),
(108, 'IT', 'Italy'),
(109, 'CI', 'Ivory Coast'),
(110, 'JE', 'Jersey'),
(111, 'JM', 'Jamaica'),
(112, 'JP', 'Japan'),
(113, 'JO', 'Jordan'),
(114, 'KZ', 'Kazakhstan'),
(115, 'KE', 'Kenya'),
(116, 'KI', 'Kiribati'),
(117, 'KP', 'Korea, Democratic People\'s Republic of'),
(118, 'KR', 'Korea, Republic of'),
(119, 'XK', 'Kosovo'),
(120, 'KW', 'Kuwait'),
(121, 'KG', 'Kyrgyzstan'),
(122, 'LA', 'Lao People\'s Democratic Republic'),
(123, 'LV', 'Latvia'),
(124, 'LB', 'Lebanon'),
(125, 'LS', 'Lesotho'),
(126, 'LR', 'Liberia'),
(127, 'LY', 'Libyan Arab Jamahiriya'),
(128, 'LI', 'Liechtenstein'),
(129, 'LT', 'Lithuania'),
(130, 'LU', 'Luxembourg'),
(131, 'MO', 'Macau'),
(132, 'MK', 'Macedonia'),
(133, 'MG', 'Madagascar'),
(134, 'MW', 'Malawi'),
(135, 'MY', 'Malaysia'),
(136, 'MV', 'Maldives'),
(137, 'ML', 'Mali'),
(138, 'MT', 'Malta'),
(139, 'MH', 'Marshall Islands'),
(140, 'MQ', 'Martinique'),
(141, 'MR', 'Mauritania'),
(142, 'MU', 'Mauritius'),
(143, 'TY', 'Mayotte'),
(144, 'MX', 'Mexico'),
(145, 'FM', 'Micronesia, Federated States of'),
(146, 'MD', 'Moldova, Republic of'),
(147, 'MC', 'Monaco'),
(148, 'MN', 'Mongolia'),
(149, 'ME', 'Montenegro'),
(150, 'MS', 'Montserrat'),
(151, 'MA', 'Morocco'),
(152, 'MZ', 'Mozambique'),
(153, 'MM', 'Myanmar'),
(154, 'NA', 'Namibia'),
(155, 'NR', 'Nauru'),
(156, 'NP', 'Nepal'),
(157, 'NL', 'Netherlands'),
(158, 'AN', 'Netherlands Antilles'),
(159, 'NC', 'New Caledonia'),
(160, 'NZ', 'New Zealand'),
(161, 'NI', 'Nicaragua'),
(162, 'NE', 'Niger'),
(163, 'NG', 'Nigeria'),
(164, 'NU', 'Niue'),
(165, 'NF', 'Norfolk Island'),
(166, 'MP', 'Northern Mariana Islands'),
(167, 'NO', 'Norway'),
(168, 'OM', 'Oman'),
(169, 'PK', 'Pakistan'),
(170, 'PW', 'Palau'),
(171, 'PS', 'Palestine'),
(172, 'PA', 'Panama'),
(173, 'PG', 'Papua New Guinea'),
(174, 'PY', 'Paraguay'),
(175, 'PE', 'Peru'),
(176, 'PH', 'Philippines'),
(177, 'PN', 'Pitcairn'),
(178, 'PL', 'Poland'),
(179, 'PT', 'Portugal'),
(180, 'PR', 'Puerto Rico'),
(181, 'QA', 'Qatar'),
(182, 'RE', 'Reunion'),
(183, 'RO', 'Romania'),
(184, 'RU', 'Russian Federation'),
(185, 'RW', 'Rwanda'),
(186, 'KN', 'Saint Kitts and Nevis'),
(187, 'LC', 'Saint Lucia'),
(188, 'VC', 'Saint Vincent and the Grenadines'),
(189, 'WS', 'Samoa'),
(190, 'SM', 'San Marino'),
(191, 'ST', 'Sao Tome and Principe'),
(192, 'SA', 'Saudi Arabia'),
(193, 'SN', 'Senegal'),
(194, 'RS', 'Serbia'),
(195, 'SC', 'Seychelles'),
(196, 'SL', 'Sierra Leone'),
(197, 'SG', 'Singapore'),
(198, 'SK', 'Slovakia'),
(199, 'SI', 'Slovenia'),
(200, 'SB', 'Solomon Islands'),
(201, 'SO', 'Somalia'),
(202, 'ZA', 'South Africa'),
(203, 'GS', 'South Georgia South Sandwich Islands'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Swaziland'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZR', 'Zaire'),
(246, 'ZM', 'Zambia'),
(247, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `area_name` varchar(200) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id_bank` int(11) NOT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id_bank`, `bank_name`, `account_number`, `account_name`, `branch_name`, `active`) VALUES
(1, 'Bank Alfalah', '45666554-25623', 'allied School', 'Orangi Town', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `business_partners`
--

CREATE TABLE `business_partners` (
  `id_business_type` int(11) NOT NULL,
  `business_type` varchar(150) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `related_table` varchar(50) DEFAULT NULL,
  `related_table_id` varchar(50) DEFAULT NULL,
  `related_table_field` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `business_partners`
--

INSERT INTO `business_partners` (`id_business_type`, `business_type`, `created_on`, `created_by`, `related_table`, `related_table_id`, `related_table_field`) VALUES
(2, 'Vendors', '2017-02-07 10:22:39', NULL, 'suppliers', 'id_suppliers', 'supplier_name'),
(3, 'Employees', '2016-11-28 21:43:52', NULL, 'employees', 'employee_id', 'employee_name');

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `id_campus` int(11) NOT NULL,
  `campus_name` varchar(50) DEFAULT NULL,
  `campus_location` varchar(200) DEFAULT NULL,
  `campus_principle` varchar(50) DEFAULT NULL,
  `campus_contact` varchar(50) DEFAULT NULL,
  `campus_contact2` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id_campus`, `campus_name`, `campus_location`, `campus_principle`, `campus_contact`, `campus_contact2`, `created_by`, `created_on`) VALUES
(1, 'Baldia Town-Rasheedabad', 'PLot # 570,Saeedabad,karachi.', 'Syed Yaqoob Shah', '03453956174', '03452188682', 2, '2017-02-27 08:55:55'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-24 23:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `cash_register`
--

CREATE TABLE `cash_register` (
  `id_cash_register` int(11) NOT NULL,
  `till_amounts` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) DEFAULT NULL,
  `x5000` int(11) NOT NULL,
  `x1000` int(11) NOT NULL,
  `x500` int(11) NOT NULL,
  `x100` int(11) NOT NULL,
  `x50` int(11) NOT NULL,
  `x20` int(11) NOT NULL,
  `x10` int(11) NOT NULL,
  `difference` decimal(10,2) NOT NULL,
  `daily_expense` decimal(10,2) NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `cash_register_date` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes_sections`
--

CREATE TABLE `classes_sections` (
  `id_class` int(11) NOT NULL,
  `class_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `classes_sections`
--

INSERT INTO `classes_sections` (`id_class`, `class_name`, `created_on`, `created_by`) VALUES
(34, 'Starter :Pre-Primary', '2017-02-27 09:15:36', 3),
(35, 'Mover : Pre-Primary', '2017-02-27 14:15:50', 3),
(36, 'Flyer : Pre-Primary', '2017-02-27 14:16:09', 3),
(37, 'Class 1st : Primary', '2017-03-09 09:54:25', 3),
(38, 'Class 2nd : Primary', '2017-03-09 09:54:51', 3),
(39, 'Class 3rd : Primary', '2017-03-09 09:55:16', 3),
(40, 'Class 4th : Primary', '2017-03-09 09:55:35', 3),
(41, 'Class 5th : Primary', '2017-03-09 09:55:57', 3),
(42, 'Class 6th : Primary', '2017-03-09 09:56:15', 3),
(43, 'Class 7th : Primary', '2017-03-09 09:56:41', 3),
(44, 'Class 8th : Primary', '2017-03-09 09:57:08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id_complain` int(11) NOT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `complain` longtext,
  `comp_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Pending','Received') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id_complain`, `campus_id`, `department_id`, `registration_id`, `complain`, `comp_date`, `status`) VALUES
(20, 1, 1, 1, 'This is a testing message', '2017-08-08 00:52:30', 'Pending'),
(21, 1, 1, 2, 'hello pakistan', '2017-08-12 14:32:28', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `concession`
--

CREATE TABLE `concession` (
  `id_concession` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `fee_type_id` int(11) NOT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `fine` decimal(16,2) DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `remarks` text NOT NULL,
  `status` int(11) DEFAULT '1',
  `concession_type` int(11) NOT NULL,
  `concession_amount` int(11) NOT NULL,
  `concession_per` decimal(16,0) NOT NULL,
  `current_fee` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `concession`
--

INSERT INTO `concession` (`id_concession`, `registration_id`, `fee_type_id`, `amount`, `fine`, `from_date`, `to_date`, `remarks`, `status`, `concession_type`, `concession_amount`, `concession_per`, `current_fee`, `created_on`, `created_by`) VALUES
(86, 81, 1, NULL, '0.00', '2017-06-01 00:00:00', '2017-06-30 00:00:00', 'test', 1, 1, 100, '20', 0, '2017-06-10 08:08:26', 5),
(87, 3, 1, NULL, '0.00', '2017-06-01 00:00:00', '2017-06-30 00:00:00', 'fdhfdh', 1, 1, 100, '20', 0, '2017-06-10 08:11:13', 5),
(88, 81, 11, '480.00', '0.00', '2017-06-01 00:00:00', '2017-06-30 00:00:00', 'test', 1, 2, 20, '4', 500, '2017-06-10 08:33:19', 5);

-- --------------------------------------------------------

--
-- Table structure for table `control_account`
--

CREATE TABLE `control_account` (
  `id_control_account` int(11) NOT NULL,
  `main_account_id` int(11) NOT NULL,
  `control_account_number` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `control_account_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `control_account_createdon` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `control_account_createdby` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `control_account`
--

INSERT INTO `control_account` (`id_control_account`, `main_account_id`, `control_account_number`, `control_account_name`, `control_account_createdon`, `control_account_createdby`) VALUES
(1, 1, '001', 'Fixed Assets', '2016-11-24 12:54:39', '7'),
(2, 1, '002', 'Current Assets', '2016-11-24 12:54:57', '7'),
(3, 2, '003', 'Long Term', '2016-11-24 13:41:23', '7'),
(4, 2, '004', 'Short Term', '2016-11-24 13:42:38', '7'),
(5, 3, '005', 'Drawing', '2016-11-24 14:02:33', '7'),
(6, 4, '006', 'Cost of Goods', '2016-11-24 14:07:21', '7'),
(7, 4, '007', 'Admin. Expenses', '2016-11-24 14:08:30', '7'),
(8, 5, '008', 'Fees Income', '2016-11-24 14:29:50', '7'),
(9, 5, '009', 'Other Income', '2016-11-24 14:30:42', '7');

-- --------------------------------------------------------

--
-- Table structure for table `cost_center_type`
--

CREATE TABLE `cost_center_type` (
  `id_cost_center_type` int(11) NOT NULL,
  `cost_center_type` varchar(150) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `related_table` varchar(50) DEFAULT NULL,
  `related_table_id` varchar(50) DEFAULT NULL,
  `related_table_field` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cost_center_type`
--

INSERT INTO `cost_center_type` (`id_cost_center_type`, `cost_center_type`, `created_on`, `created_by`, `related_table`, `related_table_id`, `related_table_field`) VALUES
(1, 'Campus', '2017-06-04 16:57:14', 9, 'campuses', 'id_campus', 'campus_name'),
(2, 'Departments', '2016-11-25 20:43:11', 9, 'departments', 'department_id', 'department_name'),
(3, 'Employees', '2016-11-25 20:43:15', 9, 'employees', 'employee_id', 'employee_Name');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `code` varchar(3) DEFAULT NULL,
  `name` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `code`, `name`) VALUES
(1, 'AFN', 'AFN'),
(2, 'ALL', 'ALL'),
(3, 'DZD', 'DZD'),
(4, 'USD', 'USD'),
(5, 'EUR', 'EUR'),
(6, 'AOA', 'AOA'),
(7, 'XCD', 'XCD'),
(8, 'XCD', 'XCD'),
(9, 'ARP', 'ARP'),
(10, 'AMD', 'AMD'),
(11, 'AWG', 'AWG'),
(12, 'AUD', 'AUD'),
(13, 'EUR', 'EUR'),
(14, 'AZN', 'AZN'),
(15, 'BSD', 'BSD'),
(16, 'BHD', 'BHD'),
(17, 'BDT', 'BDT'),
(18, 'BBD', 'BBD'),
(19, 'BYR', 'BYR'),
(20, 'EUR', 'EUR'),
(21, 'BZD', 'BZD'),
(22, 'XOF', 'XOF'),
(23, 'BMD', 'BMD'),
(24, 'BTN', 'BTN'),
(25, 'BOV', 'BOV'),
(26, 'BAM', 'BAM'),
(27, 'BWP', 'BWP'),
(28, 'NOK', 'NOK'),
(29, 'BRL', 'BRL'),
(30, 'USD', 'USD'),
(31, 'BND', 'BND'),
(32, 'BGL', 'BGL'),
(33, 'XOF', 'XOF'),
(34, 'BIF', 'BIF'),
(35, 'KHR', 'KHR'),
(36, 'XAF', 'XAF'),
(37, 'CAD', 'CAD'),
(38, 'CVE', 'CVE'),
(39, 'KYD', 'KYD'),
(40, 'XAF', 'XAF'),
(41, 'XAF', 'XAF'),
(42, 'CLF', 'CLF'),
(43, 'CNY', 'CNY'),
(44, 'AUD', 'AUD'),
(45, 'AUD', 'AUD'),
(46, 'COU', 'COU'),
(47, 'KMF', 'KMF'),
(48, 'XAF', 'XAF'),
(49, 'CDF', 'CDF'),
(50, 'NZD', 'NZD'),
(51, 'CRC', 'CRC'),
(52, 'HRK', 'HRK'),
(53, 'CUP', 'CUP'),
(54, 'EUR', 'EUR'),
(55, 'CZK', 'CZK'),
(56, 'CSJ', 'CSJ'),
(57, 'XOF', 'XOF'),
(58, 'DKK', 'DKK'),
(59, 'DJF', 'DJF'),
(60, 'XCD', 'XCD'),
(61, 'DOP', 'DOP'),
(62, 'USD', 'USD'),
(63, 'EGP', 'EGP'),
(64, 'USD', 'USD'),
(65, 'EQE', 'EQE'),
(66, 'ERN', 'ERN'),
(67, 'EEK', 'EEK'),
(68, 'ETB', 'ETB'),
(69, 'FKP', 'FKP'),
(70, 'DKK', 'DKK'),
(71, 'FJD', 'FJD'),
(72, 'FIM', 'FIM'),
(73, 'XFO', 'XFO'),
(74, 'EUR', 'EUR'),
(75, 'XPF', 'XPF'),
(76, 'EUR', 'EUR'),
(77, 'XAF', 'XAF'),
(78, 'GMD', 'GMD'),
(79, 'GEL', 'GEL'),
(80, 'DDM', 'DDM'),
(81, 'EUR', 'EUR'),
(82, 'GHC', 'GHC'),
(83, 'GIP', 'GIP'),
(84, 'GRD', 'GRD'),
(85, 'DKK', 'DKK'),
(86, 'XCD', 'XCD'),
(87, 'EUR', 'EUR'),
(88, 'USD', 'USD'),
(89, 'GTQ', 'GTQ'),
(90, 'GNE', 'GNE'),
(91, 'GWP', 'GWP'),
(92, 'GYD', 'GYD'),
(93, 'USD', 'USD'),
(94, 'AUD', 'AUD'),
(95, 'EUR', 'EUR'),
(96, 'HNL', 'HNL'),
(97, 'HKD', 'HKD'),
(98, 'HUF', 'HUF'),
(99, 'ISJ', 'ISJ'),
(100, 'INR', 'INR'),
(101, 'IDR', 'IDR'),
(102, 'IRR', 'IRR'),
(103, 'IQD', 'IQD'),
(104, 'IEP', 'IEP'),
(105, 'ILS', 'ILS'),
(106, 'ITL', 'ITL'),
(107, 'JMD', 'JMD'),
(108, 'JPY', 'JPY'),
(109, 'JOD', 'JOD'),
(110, 'KZT', 'KZT'),
(111, 'KES', 'KES'),
(112, 'AUD', 'AUD'),
(113, 'KPW', 'KPW'),
(114, 'KRW', 'KRW'),
(115, 'KWD', 'KWD'),
(116, 'KGS', 'KGS'),
(117, 'LAJ', 'LAJ'),
(118, 'LVL', 'LVL'),
(119, 'LBP', 'LBP'),
(120, 'ZAR', 'ZAR'),
(121, 'LRD', 'LRD'),
(122, 'LYD', 'LYD'),
(123, 'CHF', 'CHF'),
(124, 'LTL', 'LTL'),
(125, 'LUF', 'LUF'),
(126, 'MOP', 'MOP'),
(127, 'MKN', 'MKN'),
(128, 'MGF', 'MGF'),
(129, 'MWK', 'MWK'),
(130, 'MYR', 'MYR'),
(131, 'MVR', 'MVR'),
(132, 'MAF', 'MAF'),
(133, 'MTL', 'MTL'),
(134, 'USD', 'USD'),
(135, 'EUR', 'EUR'),
(136, 'MRO', 'MRO'),
(137, 'MUR', 'MUR'),
(138, 'EUR', 'EUR'),
(139, 'MXV', 'MXV'),
(140, 'USD', 'USD'),
(141, 'MDL', 'MDL'),
(142, 'MCF', 'MCF'),
(143, 'MNT', 'MNT'),
(144, 'EUR', 'EUR'),
(145, 'XCD', 'XCD'),
(146, 'MAD', 'MAD'),
(147, 'MZM', 'MZM'),
(148, 'MMK', 'MMK'),
(149, 'ZAR', 'ZAR'),
(150, 'AUD', 'AUD'),
(151, 'NPR', 'NPR'),
(152, 'NLG', 'NLG'),
(153, 'ANG', 'ANG'),
(154, 'XPF', 'XPF'),
(155, 'NZD', 'NZD'),
(156, 'NIO', 'NIO'),
(157, 'XOF', 'XOF'),
(158, 'NGN', 'NGN'),
(159, 'NZD', 'NZD'),
(160, 'AUD', 'AUD'),
(161, 'USD', 'USD'),
(162, 'NOK', 'NOK'),
(163, 'OMR', 'OMR'),
(164, 'PKR', 'PKR'),
(165, 'USD', 'USD'),
(166, 'USD', 'USD'),
(167, 'PGK', 'PGK'),
(168, 'PYG', 'PYG'),
(169, 'YDD', 'YDD'),
(170, 'PEH', 'PEH'),
(171, 'PHP', 'PHP'),
(172, 'NZD', 'NZD'),
(173, 'PLN', 'PLN'),
(174, 'TPE', 'TPE'),
(175, 'USD', 'USD'),
(176, 'QAR', 'QAR'),
(177, 'ROK', 'ROK'),
(178, 'RUB', 'RUB'),
(179, 'RWF', 'RWF'),
(180, 'EUR', 'EUR'),
(181, 'SHP', 'SHP'),
(182, 'XCD', 'XCD'),
(183, 'XCD', 'XCD'),
(184, 'EUR', 'EUR'),
(185, 'XCD', 'XCD'),
(186, 'WST', 'WST'),
(187, 'EUR', 'EUR'),
(188, 'STD', 'STD'),
(189, 'SAR', 'SAR'),
(190, 'XOF', 'XOF'),
(191, 'CSD', 'CSD'),
(192, 'SCR', 'SCR'),
(193, 'SLL', 'SLL'),
(194, 'SGD', 'SGD'),
(195, 'SKK', 'SKK'),
(196, 'SIT', 'SIT'),
(197, 'SBD', 'SBD'),
(198, 'SOS', 'SOS'),
(199, 'ZAL', 'ZAL'),
(200, 'ESB', 'ESB'),
(201, 'LKR', 'LKR'),
(202, 'SDG', 'SDG'),
(203, 'SRG', 'SRG'),
(204, 'NOK', 'NOK'),
(205, 'SZL', 'SZL'),
(206, 'SEK', 'SEK'),
(207, 'CHW', 'CHW'),
(208, 'SYP', 'SYP'),
(209, 'TWD', 'TWD'),
(210, 'TJR', 'TJR'),
(211, 'TZS', 'TZS'),
(212, 'THB', 'THB'),
(213, 'USD', 'USD'),
(214, 'XOF', 'XOF'),
(215, 'NZD', 'NZD'),
(216, 'TOP', 'TOP'),
(217, 'TTD', 'TTD'),
(218, 'TND', 'TND'),
(219, 'TRL', 'TRL'),
(220, 'TMM', 'TMM'),
(221, 'USD', 'USD'),
(222, 'AUD', 'AUD'),
(223, 'SUR', 'SUR'),
(224, 'UGS', 'UGS'),
(225, 'UAK', 'UAK'),
(226, 'AED', 'AED'),
(227, 'GBP', 'GBP'),
(228, 'USS', 'USS'),
(229, 'USD', 'USD'),
(230, 'UYI', 'UYI'),
(231, 'UZS', 'UZS'),
(232, 'VUV', 'VUV'),
(233, 'VEB', 'VEB'),
(234, 'VNC', 'VNC'),
(235, 'USD', 'USD'),
(236, 'USD', 'USD'),
(237, 'XPF', 'XPF'),
(238, 'MAD', 'MAD'),
(239, 'YER', 'YER'),
(240, 'YUM', 'YUM'),
(241, 'ZRZ', 'ZRZ'),
(242, 'ZMK', 'ZMK'),
(243, 'ZWC', 'ZWC');

-- --------------------------------------------------------

--
-- Table structure for table `daily_diary`
--

CREATE TABLE `daily_diary` (
  `id_daily_diary` int(11) NOT NULL,
  `description` text,
  `addiotion` text,
  `class_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `priority` enum('Normal','High') NOT NULL DEFAULT 'Normal',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `daily_diary`
--

INSERT INTO `daily_diary` (`id_daily_diary`, `description`, `addiotion`, `class_id`, `shift_id`, `date`, `priority`, `created_by`, `created_on`) VALUES
(11, '<p>gadsgadsgasdg</p>\n\n<p>asdgasdgdasgdsag</p>\n\n<p>asdgsad</p>\n', 'Class Homework of the Sat-29-07-2017', 35, 1, '2017-07-29 00:00:00', 'Normal', 5, '2017-07-29 08:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) DEFAULT NULL,
  `department_manager` int(11) NOT NULL,
  `department_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `department_created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `department_manager`, `department_created_on`, `department_created_by`) VALUES
(2, 'Administration', 0, '2017-03-24 09:30:16', 3),
(3, 'Teaching Staff', 0, '2017-03-24 08:54:08', 3),
(4, 'Non Teaching Staff', 0, '2017-03-24 08:54:47', 3);

-- --------------------------------------------------------

--
-- Table structure for table `download_syllabus`
--

CREATE TABLE `download_syllabus` (
  `id_download_syllabus` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `download` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `download_syllabus`
--

INSERT INTO `download_syllabus` (`id_download_syllabus`, `registration_id`, `class_id`, `shift_id`, `description`, `download`, `date`, `created_by`, `created_on`) VALUES
(4, 1, 35, 1, 'This syllabus for vocations.', 'syllabus_for_vocations.zip', '2017-03-22 00:00:00', NULL, '2017-03-22 05:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `dues`
--

CREATE TABLE `dues` (
  `id_dues` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `fee_month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `fee_type_id` int(11) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `fine` decimal(16,2) DEFAULT NULL,
  `fee_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `dues`
--

INSERT INTO `dues` (`id_dues`, `registration_id`, `class_id`, `shift_id`, `session_id`, `campus_id`, `fee_month`, `year`, `fee_type_id`, `amount`, `fine`, `fee_date`, `due_date`, `created_on`, `created_by`) VALUES
(346, 1484, 34, 1, 1, 1, 3, 2017, 1, '900.00', '0.00', '2017-03-01', '2017-03-10', '2017-04-19 07:33:15', 3),
(348, 1483, 35, 1, 1, 1, 4, 2017, 1, '500.00', '0.00', '2017-04-10', '2017-04-10', '2017-02-28 18:34:09', 3),
(349, 1483, 35, 1, 1, 1, 3, 2017, 1, '500.00', '0.00', '2017-03-01', '2017-03-10', '2017-04-06 11:42:36', 3),
(443, 9, 34, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(444, 11, 34, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(445, 12, 34, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(446, 13, 34, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(447, 14, 34, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:56:27', 3),
(448, 15, 34, 1, 1, 1, 4, 2017, 1, '800.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(452, 19, 34, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(468, 35, 34, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(473, 82, 34, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(478, 7, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:52:15', 3),
(479, 9, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:57:27', 3),
(480, 11, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:56:15', 3),
(481, 12, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:57:46', 3),
(482, 13, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:59:46', 3),
(483, 14, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 11:59:58', 3),
(484, 15, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:00:46', 3),
(485, 16, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:03:53', 3),
(486, 17, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:06:08', 3),
(491, 22, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:10:10', 3),
(492, 23, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:13:33', 3),
(493, 24, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:18:43', 3),
(500, 31, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:49:26', 3),
(509, 82, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 13:02:59', 3),
(510, 83, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 13:06:30', 3),
(511, 84, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 13:07:08', 3),
(512, 85, 34, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 13:12:39', 3),
(515, 9, 34, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:57:02', 3),
(516, 11, 34, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:57:02', 3),
(517, 12, 34, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:57:02', 3),
(518, 13, 34, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:57:02', 3),
(519, 14, 34, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:57:02', 3),
(520, 15, 34, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:57:02', 3),
(524, 19, 34, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:57:02', 3),
(545, 82, 34, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:57:04', 3),
(552, 10, 35, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(558, 45, 35, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(563, 6, 35, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:51:20', 3),
(564, 10, 35, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:56:57', 3),
(566, 41, 35, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:09:33', 3),
(567, 42, 35, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:17:59', 3),
(568, 43, 35, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:53:26', 3),
(569, 44, 35, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:05:21', 3),
(571, 87, 35, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 13:14:03', 3),
(576, 10, 35, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:58:19', 3),
(580, 43, 35, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:58:20', 3),
(582, 45, 35, 1, 1, 1, 4, 2017, 19, '980.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:58:21', 3),
(586, 46, 36, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(587, 47, 36, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(588, 48, 36, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:58:52', 3),
(589, 49, 36, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(590, 50, 36, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-24 16:39:28', 3),
(593, 53, 36, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(595, 55, 36, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(597, 46, 36, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:58:52', 3),
(598, 47, 36, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 22:00:40', 3),
(599, 48, 36, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 11:59:17', 3),
(600, 49, 36, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:01:26', 3),
(601, 50, 36, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:16:51', 3),
(606, 55, 36, 1, 1, 1, 4, 2017, 5, '500.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:58:59', 3),
(608, 46, 36, 1, 1, 1, 4, 2017, 19, '1090.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:08', 3),
(609, 47, 36, 1, 1, 1, 4, 2017, 19, '1090.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:08', 3),
(610, 48, 36, 1, 1, 1, 4, 2017, 19, '1090.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:08', 3),
(611, 49, 36, 1, 1, 1, 4, 2017, 19, '1090.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:08', 3),
(615, 53, 36, 1, 1, 1, 4, 2017, 19, '1090.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:08', 3),
(617, 55, 36, 1, 1, 1, 4, 2017, 19, '1090.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:08', 3),
(619, 2, 37, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:22', 3),
(621, 57, 37, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(622, 58, 37, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:22', 3),
(623, 91, 37, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 18:59:22', 3),
(624, 92, 37, 1, 1, 1, 4, 2017, 1, '800.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(625, 2, 37, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:48:13', 3),
(626, 56, 37, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:20:49', 3),
(628, 58, 37, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 13:16:40', 3),
(629, 91, 37, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 13:14:54', 3),
(630, 92, 37, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:59:29', 3),
(633, 57, 37, 1, 1, 1, 4, 2017, 19, '1280.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:00', 3),
(634, 58, 37, 1, 1, 1, 4, 2017, 19, '1280.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:00', 3),
(635, 91, 37, 1, 1, 1, 4, 2017, 19, '1280.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:03', 3),
(636, 92, 37, 1, 1, 1, 4, 2017, 19, '1280.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:04', 3),
(637, 5, 38, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(638, 59, 38, 1, 1, 1, 4, 2017, 1, '750.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(639, 60, 38, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:15', 3),
(644, 65, 38, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(646, 5, 38, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:50:37', 3),
(647, 59, 38, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 11:55:07', 3),
(648, 60, 38, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:02:23', 3),
(649, 61, 38, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:03:16', 3),
(651, 63, 38, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:08:05', 3),
(652, 64, 38, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:50:40', 3),
(655, 5, 38, 1, 1, 1, 4, 2017, 19, '1280.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:32', 3),
(656, 59, 38, 1, 1, 1, 4, 2017, 19, '1280.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:32', 3),
(661, 64, 38, 1, 1, 1, 4, 2017, 19, '1280.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:33', 3),
(664, 1, 39, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:49', 3),
(665, 67, 39, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:49', 3),
(666, 68, 39, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:49', 3),
(668, 70, 39, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:00:49', 3),
(669, 71, 39, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(670, 1, 39, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:46:57', 3),
(671, 67, 39, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 11:58:05', 3),
(674, 70, 39, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:07:39', 3),
(677, 67, 39, 1, 1, 1, 4, 2017, 19, '1516.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:02', 3),
(681, 71, 39, 1, 1, 1, 4, 2017, 19, '1516.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:03', 3),
(682, 4, 40, 1, 1, 1, 4, 2017, 1, '900.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(683, 72, 40, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:15', 3),
(684, 73, 40, 1, 1, 1, 4, 2017, 1, '750.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-19 07:33:15', 3),
(687, 4, 40, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 21:49:47', 3),
(688, 72, 40, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 11:53:42', 3),
(689, 73, 40, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 11:54:29', 3),
(690, 74, 40, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 12:19:45', 3),
(692, 4, 40, 1, 1, 1, 4, 2017, 19, '1590.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:28', 3),
(693, 72, 40, 1, 1, 1, 4, 2017, 19, '1590.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:28', 3),
(694, 73, 40, 1, 1, 1, 4, 2017, 19, '1590.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:28', 3),
(697, 76, 41, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:38', 3),
(698, 77, 41, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:38', 3),
(699, 78, 41, 1, 1, 1, 4, 2017, 1, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:38', 3),
(702, 76, 41, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 22:01:38', 3),
(703, 77, 41, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 11:56:39', 3),
(704, 78, 41, 1, 1, 1, 4, 2017, 5, '0.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-17 11:57:12', 3),
(707, 76, 41, 1, 1, 1, 4, 2017, 19, '1590.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:56', 3),
(708, 77, 41, 1, 1, 1, 4, 2017, 19, '1590.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:57', 3),
(709, 78, 41, 1, 1, 1, 4, 2017, 19, '1590.00', '0.00', '2017-04-01', '2017-04-10', '2017-04-16 19:01:57', 3),
(712, 8, 42, 1, 1, 1, 4, 2017, 1, '2800.00', '100.00', '2017-04-01', '2017-04-10', '2017-06-17 10:36:57', 3),
(715, 8, 42, 1, 1, 1, 4, 2017, 5, '2800.00', '100.00', '2017-04-01', '2017-04-10', '2017-06-17 10:37:00', 3),
(718, 8, 42, 1, 1, 1, 4, 2017, 19, '2800.00', '100.00', '2017-04-01', '2017-04-10', '2017-06-17 10:37:03', 3),
(816, 64, 38, 1, 1, 1, 4, 2017, 1, '10.00', '0.00', '2017-04-01', '1970-01-01', '2017-04-17 19:48:43', 3),
(817, 43, 35, 1, 1, 1, 4, 2017, 1, '110.00', '0.00', '2017-04-01', '1970-01-01', '2017-04-17 19:49:22', 3),
(837, 68, 39, 1, 1, 1, 4, 2017, 19, '1272.00', '0.00', '2017-04-01', '2017-04-19', '2017-04-19 11:22:33', 3),
(839, 70, 39, 1, 1, 1, 4, 2017, 19, '195.00', '0.00', '2017-04-01', '2017-04-24', '2017-04-24 16:42:35', 3),
(855, 107, 37, 1, 1, 1, 4, 2017, 19, '680.00', '0.00', '2017-04-01', '1280-04-27', '2017-04-27 09:49:24', 3),
(856, 60, 38, 1, 1, 1, 4, 2017, 19, '753.00', '0.00', '2017-04-01', '1280-04-29', '2017-04-29 14:10:29', 3),
(857, 61, 38, 1, 1, 1, 4, 2017, 19, '102.00', '0.00', '2017-04-01', '1280-04-29', '2017-04-29 14:11:37', 3),
(858, 16, 34, 1, 1, 1, 4, 2017, 19, '84.00', '0.00', '2017-04-01', '1970-01-01', '2017-04-29 14:12:47', 3),
(859, 17, 34, 1, 1, 1, 4, 2017, 19, '84.00', '0.00', '2017-04-01', '1970-01-01', '2017-04-29 14:13:55', 3),
(860, 44, 35, 1, 1, 1, 4, 2017, 19, '84.00', '0.00', '2017-04-01', '1970-01-01', '2017-04-29 14:15:57', 3),
(865, 7, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:41', 3),
(866, 9, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:42', 3),
(867, 11, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:42', 3),
(868, 12, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:42', 3),
(869, 13, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:43', 3),
(870, 14, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:43', 3),
(871, 15, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:46', 3),
(873, 19, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:48', 3),
(889, 35, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:52', 3),
(894, 82, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:52', 3),
(895, 83, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:53', 3),
(903, 106, 34, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 14:25:54', 3),
(904, 7, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(905, 9, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(906, 11, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(907, 12, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(908, 13, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(909, 14, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(910, 15, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(911, 16, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(912, 17, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(914, 19, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:54', 3),
(917, 22, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:55', 3),
(918, 23, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:55', 3),
(919, 24, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:55', 3),
(925, 30, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:57', 3),
(929, 34, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:59', 3),
(930, 35, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:59', 3),
(934, 39, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:59', 3),
(935, 82, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:59', 3),
(936, 83, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:59', 3),
(937, 84, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:59', 3),
(938, 85, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:59', 3),
(939, 86, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:25:59', 3),
(940, 97, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:26:00', 3),
(941, 100, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:26:00', 3),
(942, 102, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:26:00', 3),
(944, 106, 34, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-04-30 14:26:00', 3),
(945, 3, 35, 1, 1, 1, 5, 2017, 1, NULL, '0.00', '2017-05-01', '2017-05-10', '2017-06-10 08:11:14', 5),
(946, 6, 35, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:15', 5),
(947, 10, 35, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:15', 5),
(951, 43, 35, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:16', 5),
(952, 45, 35, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:16', 5),
(958, 46, 36, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:21', 5),
(959, 47, 36, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:22', 5),
(960, 48, 36, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:22', 5),
(964, 53, 36, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:22', 5),
(968, 98, 36, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:23', 5),
(971, 56, 37, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:28', 5),
(972, 57, 37, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:28', 5),
(974, 91, 37, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:28', 5),
(975, 92, 37, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:28', 5),
(977, 107, 37, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:29', 5),
(978, 5, 38, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:34', 5),
(979, 49, 38, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:36', 5),
(980, 59, 38, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:46', 5),
(981, 60, 38, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:46', 5),
(984, 64, 38, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:46', 5),
(985, 65, 38, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:47', 5),
(988, 67, 39, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:52', 5),
(992, 71, 39, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:52', 5),
(993, 4, 40, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:58', 5),
(994, 72, 40, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:58', 5),
(995, 73, 40, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:58', 5),
(996, 74, 40, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:00:58', 5),
(998, 76, 41, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:01:02', 5),
(999, 77, 41, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:01:02', 5),
(1000, 78, 41, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:01:02', 5),
(1003, 94, 41, 1, 1, 1, 5, 2017, 1, '900.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:01:03', 5),
(1004, 8, 42, 1, 1, 1, 5, 2017, 1, '2800.00', '100.00', '2017-05-01', '2017-05-10', '2017-06-17 10:37:06', 5),
(1007, 108, 43, 1, 1, 1, 5, 2017, 1, '1000.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:01:11', 5),
(1008, 109, 43, 1, 1, 1, 5, 2017, 1, '1000.00', '10.00', '2017-05-01', '2017-05-10', '2017-04-30 18:01:12', 5),
(1009, 3, 35, 1, 1, 1, 7, 2017, 1, NULL, '0.00', '2017-07-01', '2017-07-10', '2017-06-10 08:11:14', 3),
(1010, 6, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:53', 3),
(1011, 10, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:53', 3),
(1013, 41, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:53', 3),
(1014, 42, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:53', 3),
(1015, 43, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:53', 3),
(1016, 44, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:53', 3),
(1017, 45, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:54', 3),
(1018, 87, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:54', 3),
(1019, 88, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:54', 3),
(1020, 89, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:55', 3),
(1021, 96, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:55', 3),
(1022, 104, 35, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:55:55', 3),
(1023, 46, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:07', 3),
(1024, 47, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:07', 3),
(1025, 48, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:07', 3),
(1028, 52, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:08', 3),
(1029, 53, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:08', 3),
(1031, 55, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:08', 3),
(1032, 90, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:08', 3),
(1033, 98, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:08', 3),
(1034, 101, 36, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 15:57:08', 3),
(1036, 56, 37, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:19', 3),
(1037, 57, 37, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:19', 3),
(1038, 58, 37, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:20', 3),
(1039, 91, 37, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:20', 3),
(1040, 92, 37, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:20', 3),
(1041, 95, 37, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:20', 3),
(1042, 107, 37, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:20', 3),
(1043, 5, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:28', 3),
(1044, 49, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:28', 3),
(1045, 59, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:28', 3),
(1046, 60, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:28', 3),
(1047, 61, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:28', 3),
(1049, 63, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:28', 3),
(1050, 64, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:28', 3),
(1051, 65, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:29', 3),
(1052, 66, 38, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:29', 3),
(1054, 67, 39, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:37', 3),
(1058, 71, 39, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:38', 3),
(1059, 4, 40, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:46', 3),
(1060, 72, 40, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:46', 3),
(1061, 73, 40, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:46', 3),
(1062, 74, 40, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:46', 3),
(1063, 75, 40, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:47', 3),
(1064, 76, 41, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:51', 3),
(1065, 77, 41, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:52', 3),
(1066, 78, 41, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:52', 3),
(1068, 93, 41, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:52', 3),
(1069, 94, 41, 1, 1, 1, 7, 2017, 1, '900.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:52', 3),
(1070, 8, 42, 1, 1, 1, 7, 2017, 1, '2800.00', '100.00', '2017-07-01', '2017-07-10', '2017-06-17 10:37:10', 3),
(1071, 80, 42, 1, 1, 1, 7, 2017, 1, '1000.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:59', 3),
(1073, 103, 42, 1, 1, 1, 7, 2017, 1, '1000.00', '10.00', '2017-07-01', '2017-07-10', '2017-05-02 16:01:59', 3),
(1086, 3, 35, 1, 1, 1, 4, 2017, 1, NULL, '0.00', '2017-04-10', '2017-04-10', '2017-06-10 08:11:14', 3),
(1087, 86, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-10 02:52:42', 3),
(1088, 101, 36, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-10 02:56:16', 3),
(1089, 100, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-10 02:57:56', 3),
(1090, 34, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-10 03:02:09', 3),
(1091, 89, 35, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-11 04:12:23', 3),
(1092, 88, 35, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-11 04:13:03', 3),
(1093, 93, 41, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-11 04:14:09', 3),
(1094, 105, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-11 04:56:52', 3),
(1098, 8, 42, 1, 1, 1, 6, 2017, 1, '2800.00', '100.00', '2017-06-01', '2017-06-10', '2017-06-17 10:37:13', 5),
(1099, 80, 42, 1, 1, 1, 6, 2017, 1, '1000.00', '10.00', '2017-06-01', '2017-06-10', '2017-05-11 06:22:08', 5),
(1101, 103, 42, 1, 1, 1, 6, 2017, 1, '900.00', '10.00', '2017-06-01', '2017-06-10', '2017-05-11 06:22:09', 5),
(1102, 81, 42, 1, 1, 1, 7, 2017, 1, NULL, '0.00', '2017-07-01', '2017-07-10', '2017-06-10 08:08:27', 5),
(1103, 81, 42, 1, 1, 1, 5, 2017, 1, NULL, '0.00', '2017-05-01', '1970-01-01', '2017-06-10 08:08:27', 3),
(1104, 36, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-13 03:57:21', 3),
(1105, 102, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-13 07:15:07', 3),
(1106, 58, 37, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-16 04:05:09', 3),
(1107, 85, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-16 04:05:43', 3),
(1113, 62, 38, 1, 1, 1, 7, 2017, 1, '800.00', '10.00', '2017-07-10', '2017-07-10', '2017-05-17 04:34:22', 3),
(1114, 68, 39, 1, 1, 1, 5, 2017, 1, '0.00', '0.00', '2017-05-10', '2017-05-10', '2017-05-17 04:36:54', 3),
(1115, 68, 39, 1, 1, 1, 7, 2017, 1, '0.00', '0.00', '2017-07-10', '2017-07-10', '2017-05-17 04:37:19', 3),
(1117, 18, 34, 1, 1, 1, 7, 2017, 1, '800.00', '10.00', '2017-07-10', '2017-07-10', '2017-05-17 04:39:10', 3),
(1119, 69, 39, 1, 1, 1, 7, 2017, 1, '800.00', '10.00', '2017-07-10', '2017-07-10', '2017-05-17 04:41:16', 3),
(1120, 40, 35, 1, 1, 1, 7, 2017, 1, '800.00', '10.00', '2017-07-10', '2017-07-10', '2017-05-17 04:41:34', 3),
(1122, 62, 38, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:42:25', 3),
(1123, 18, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:42:51', 3),
(1124, 69, 39, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:43:14', 3),
(1125, 40, 35, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:43:44', 3),
(1126, 32, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:45:21', 3),
(1127, 33, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:46:25', 3),
(1128, 104, 35, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:47:03', 3),
(1129, 70, 39, 1, 1, 1, 5, 2017, 1, '0.00', '0.00', '2017-05-10', '2017-05-10', '2017-05-17 04:51:16', 3),
(1130, 50, 36, 1, 1, 1, 5, 2017, 1, '0.00', '0.00', '2017-05-10', '2017-05-10', '2017-05-17 04:51:50', 3),
(1131, 63, 38, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:52:30', 3),
(1132, 41, 35, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:53:17', 3),
(1133, 22, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:53:51', 3),
(1134, 23, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 04:54:40', 3),
(1135, 42, 35, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 05:02:36', 3),
(1136, 24, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-17 05:03:44', 3),
(1137, 25, 34, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-19 04:52:05', 3),
(1139, 63, 38, 1, 1, 1, 5, 2017, 1, '410.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-19 08:24:49', 3),
(1140, 90, 36, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-20 03:22:18', 3),
(1141, 50, 36, 1, 1, 1, 7, 2017, 1, '0.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:18', 3),
(1142, 46, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:49', 3),
(1143, 47, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1144, 48, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1145, 50, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1146, 51, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1147, 52, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1148, 53, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1149, 54, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1150, 55, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1151, 90, 36, 1, 1, 1, 5, 2017, 19, '1090.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1153, 101, 36, 1, 1, 1, 5, 2017, 19, '720.00', '0.00', '2017-05-01', '2017-05-10', '2017-05-20 03:32:50', 3),
(1154, 46, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:51', 3),
(1155, 47, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:51', 3),
(1156, 48, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:51', 3),
(1157, 50, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:51', 3),
(1158, 51, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:51', 3),
(1159, 52, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:51', 3),
(1160, 53, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:51', 3),
(1161, 54, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:52', 3),
(1162, 55, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:52', 3),
(1163, 90, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:52', 3),
(1164, 98, 36, 1, 1, 1, 7, 2017, 19, '1090.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:52', 3),
(1165, 101, 36, 1, 1, 1, 7, 2017, 19, '720.00', '0.00', '2017-07-01', '2017-07-10', '2017-05-20 03:32:52', 3),
(1166, 1, 39, 1, 1, 1, 5, 2017, 1, '0.00', '0.00', '2017-05-10', '2017-05-10', '2017-05-23 06:55:53', 3),
(1167, 51, 36, 1, 1, 1, 5, 2017, 1, '10.00', '0.00', '2017-05-01', '1970-01-01', '2017-05-25 03:56:00', 3),
(1168, 65, 38, 1, 1, 1, 8, 2017, 1, '900.00', '10.00', '2017-08-15', '2017-08-15', '2017-08-13 08:13:47', 5);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `employee_address` varchar(200) DEFAULT NULL,
  `employee_no` varchar(15) DEFAULT NULL,
  `employee_email` varchar(50) DEFAULT NULL,
  `employee_phone1` varchar(20) DEFAULT NULL,
  `employee_phone2` varchar(20) DEFAULT NULL,
  `employee_pic` varchar(100) DEFAULT 'avatar-1.jpg',
  `scheduler_status` varchar(50) NOT NULL DEFAULT 'false',
  `employee_created_by` int(11) DEFAULT NULL,
  `employee_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `color_code` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `user_id`, `department_id`, `employee_name`, `employee_address`, `employee_no`, `employee_email`, `employee_phone1`, `employee_phone2`, `employee_pic`, `scheduler_status`, `employee_created_by`, `employee_created_on`, `color_code`, `order_id`) VALUES
(1, NULL, 2, 'Habibullah Afridi', 'Sarhad Muhallah, Rasheedabad Colony,Baldia Town, Karachi.', '03472004413', '', '', '', 'avatar-1.jpg', 'true', 3, '2017-06-04 16:02:22', 'green', 5),
(2, NULL, 2, 'Syed Yaqoob Shah', 'House #, 1725/3435, Sarhad Road, Madina Colony, Baldia Town, Karachi.', '923453956174', 'syaqoobshah@hotmail.com', '', '', 'avatar-1.jpg', 'true', 3, '2017-06-04 07:48:21', 'red', 2),
(3, NULL, 2, 'Muhammad Sajid Shah', 'Rasheedabad, Baldia Town, Karachi.', '923170215022', 'sajid_shah2000@outlook.com', '', '', 'avatar-1.jpg', 'true', 3, '2017-06-04 07:48:22', 'yellow', 3),
(4, NULL, 2, 'Syed Khadim Ali Shah', 'House #, 1725/3608, Sarhad Road, Madina Colony, Baldia Town, Karachi.', '923333243397', 'times2025@gmail.com', '', '', 'avatar-1.jpg', 'true', 3, '2017-06-04 07:48:23', 'blue', 4),
(5, NULL, 2, 'Syedah Asma.', 'House #, 1725/3435, Sarhad Road, Madina Colony, Baldia Town, Karachi.', '923112000984', '', '', '', 'avatar-1.jpg', 'true', 3, '2017-06-04 09:06:49', 'pink', 1),
(6, NULL, 4, 'Sultan', 'Habibabad,Rasheedabad, Baldia Town, Karachi.', '923419811601', '', '', '', 'avatar-1.jpg', 'false', 3, '2017-06-04 07:48:27', 'green', 6),
(7, NULL, 3, 'naureen', 'jhjfjg', 'fgj', 'qayyum@yahoo.com', 'gfj', 'gfjgj', 'naureenfgj.jpg', 'false', 5, '2017-06-05 01:36:03', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_marks_details`
--

CREATE TABLE `exam_marks_details` (
  `id_marks_detail` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `exam_type_id` int(11) DEFAULT NULL,
  `min_marks` int(11) DEFAULT '0',
  `max_marks` int(11) DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `exam_marks_details`
--

INSERT INTO `exam_marks_details` (`id_marks_detail`, `class_id`, `subject_id`, `exam_type_id`, `min_marks`, `max_marks`, `created_on`, `created_by`) VALUES
(45, 35, 2, 1, 100, 33, '2017-06-28 16:12:29', 5),
(46, 35, 3, 1, 100, 33, '2017-06-28 16:12:29', 5),
(47, 35, 4, 1, 33, 100, '2017-06-28 16:12:29', 5),
(57, 36, NULL, NULL, 0, 0, '2017-07-29 11:53:28', 5);

-- --------------------------------------------------------

--
-- Table structure for table `exam_types`
--

CREATE TABLE `exam_types` (
  `id_exam_types` int(11) NOT NULL,
  `exam_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `exam_types`
--

INSERT INTO `exam_types` (`id_exam_types`, `exam_type`) VALUES
(1, 'First Assessment'),
(2, 'Second Assessment');

-- --------------------------------------------------------

--
-- Table structure for table `expanses`
--

CREATE TABLE `expanses` (
  `id_expanses` int(11) NOT NULL,
  `voucher_number` int(11) DEFAULT NULL,
  `transaction_account_id` int(11) DEFAULT NULL,
  `expanse_desc` varchar(50) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `expanse_date` date DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `color_code` varchar(50) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `expanses`
--

INSERT INTO `expanses` (`id_expanses`, `voucher_number`, `transaction_account_id`, `expanse_desc`, `amount`, `expanse_date`, `status`, `color_code`, `created_on`, `created_by`) VALUES
(1, 11705, 108, 'milk + rickshaw rent+ ice', '133.00', '2017-04-11', 1, '', '2017-05-22 12:28:01', 3),
(2, 21705, 108, 'milk+ice', '70.00', '2017-04-12', 1, '', '2017-05-22 12:31:04', 3),
(3, 31705, 108, 'stamp+gohar books+ ice+milk+chalk', '11030.00', '2017-04-15', 1, '', '2017-05-22 12:34:51', 3),
(4, 41705, 108, 'Electricity equipment+ battery for generator.', '7000.00', '2017-04-16', 1, '', '2017-05-22 12:40:06', 3),
(5, 51705, 108, 'Milk+Ice+Acid', '110.00', '2017-04-17', 1, '', '2017-05-22 12:41:33', 3),
(6, 61705, 108, 'Milk+Ice+Stamp+Spray+Electricity', '4130.00', '2017-04-18', 1, '', '2017-05-22 12:43:02', 3),
(7, 71705, 108, 'Tables for Pre-primary class+welding+milk & ice+ju', '3850.00', '2017-04-18', 1, '', '2017-05-22 12:47:20', 3),
(8, 81705, 108, 'milk & ice', '70.00', '2017-04-19', 1, '', '2017-05-22 12:48:16', 3),
(10, 101705, 107, 'Sultan Bhai Advance', '1000.00', '2017-04-17', 1, '', '2017-05-22 12:53:00', 3),
(11, 111705, 108, 'milk & ice+Software charges', '2070.00', '2017-04-22', 1, '', '2017-05-22 12:54:06', 3),
(12, 121705, 108, 'Cold drink+board+table+burtan ke jali+scortch brig', '3605.00', '2017-04-23', 1, '', '2017-05-22 12:56:14', 3),
(13, 131705, 107, 'Habib Salary ', '6000.00', '2017-04-23', 1, '', '2017-05-22 12:56:51', 3),
(14, 141705, 108, 'milk & ice', '70.00', '2017-04-24', 1, '', '2017-05-22 12:57:23', 3),
(15, 151705, 108, 'Petrol+milk & ice', '470.00', '2017-04-25', 1, '', '2017-05-22 12:58:02', 3),
(16, 161705, 108, 'milk & ice', '70.00', '2017-04-26', 1, '', '2017-05-22 12:58:26', 3),
(17, 171705, 108, 'milk & ice+Sugar & Soap', '270.00', '2017-04-27', 1, '', '2017-05-22 12:59:26', 3),
(18, 181705, 117, 'Mineral ', '200.00', '2017-04-27', 1, '', '2017-05-22 13:00:10', 3),
(19, 191705, 108, 'milk & ice', '70.00', '2017-04-28', 1, '', '2017-05-22 13:00:36', 3),
(20, 201705, 107, 'Habib Advance', '1500.00', '2017-04-29', 1, '', '2017-05-22 13:01:35', 3),
(21, 211705, 107, 'Hussain driver advance', '1000.00', '2017-05-22', 1, '', '2017-05-22 13:02:07', 3),
(22, 221705, 108, 'milk & ice+Fanial+Stamp paid+cover sheet+Yaseen El', '11280.00', '2017-04-20', 1, '', '2017-05-22 13:07:06', 3),
(23, 231705, 108, 'wood equipment+Chair & table+Shoper', '9800.00', '2017-05-01', 1, '', '2017-05-22 13:15:07', 3),
(24, 241705, 108, 'Islamia book+milk & ice+Stamp wala+jharoo', '50920.00', '2017-05-02', 1, '', '2017-05-22 13:17:10', 3),
(25, 251705, 108, 'milk & ice+cold drink', '180.00', '2017-05-03', 1, '', '2017-05-22 13:17:38', 3),
(26, 261705, 108, 'milk & ice+Battery charge+petrol', '520.00', '2017-05-04', 1, '', '2017-05-22 13:18:52', 3),
(27, 271705, 108, 'Books+colour pencil+chalk+Nasir Carpenter+milk & i', '4120.00', '2017-05-05', 1, '', '2017-05-22 13:20:24', 3),
(28, 281705, 108, 'milk & ice+Nasir carpenter+petrol+Bell', '3120.00', '2017-05-06', 1, '', '2017-05-22 13:22:31', 3),
(29, 291705, 108, 'milk & ice+cold drink', '220.00', '2017-05-08', 1, '', '2017-05-22 13:23:29', 3),
(30, 301705, 114, 'USB Recharge', '1500.00', '2017-05-08', 1, '', '2017-05-22 13:24:22', 3),
(31, 311705, 108, 'milk & ice+surf', '80.00', '2017-05-09', 1, '', '2017-05-22 13:25:01', 3),
(32, 321705, 108, 'milk & ice+surf+rickshaw C/O sultan+Desk', '6580.00', '2017-05-10', 1, '', '2017-05-22 13:26:28', 3),
(33, 331705, 108, 'milk & ice+Tea patti', '340.00', '2017-05-11', 1, '', '2017-05-22 13:27:37', 3),
(34, 341705, 117, 'Mineral', '150.00', '2017-05-11', 1, '', '2017-05-22 13:28:17', 3),
(35, 351705, 108, 'milk & ice+Oil', '380.00', '2017-05-13', 1, '', '2017-05-22 13:29:00', 3),
(36, 361705, 107, 'Hussain Rickshaw driver', '2500.00', '2017-05-13', 1, '', '2017-05-22 13:29:41', 3),
(37, 371705, 108, 'milk & ice', '90.00', '2017-05-15', 1, '', '2017-05-22 13:30:16', 3),
(38, 381705, 108, 'milk & ice+agr bati+Software charges+sugar', '3060.00', '2017-05-16', 1, '', '2017-05-22 13:31:33', 3),
(39, 391705, 108, 'milk & ice+Rickshaw Rent both sides', '270.00', '2017-05-17', 1, '', '2017-05-22 13:32:21', 3),
(40, 401705, 108, 'milk & ice+surf+Rickshaw rent+Stapler+Stationary', '2750.00', '2017-05-18', 1, '', '2017-05-22 13:35:16', 3),
(41, 411705, 107, 'Habib salary', '8000.00', '2017-05-18', 1, '', '2017-05-22 13:35:51', 3),
(42, 421705, 108, 'milk & ice+Mother day Flower', '1100.00', '2017-05-19', 1, '', '2017-05-22 13:37:08', 3),
(43, 431705, 108, 'milk & ice+Water mineral+printing', '2200.00', '2017-05-20', 1, '', '2017-05-22 13:38:58', 3),
(44, 441705, 108, 'milk & ice', '100.00', '2017-05-22', 1, '', '2017-05-22 13:39:35', 3),
(45, 451705, 107, 'Hussain driver Advance', '900.00', '2017-05-22', 1, '', '2017-05-22 13:40:04', 3),
(46, 461705, 107, 'Miss Asma', '6000.00', '2017-05-10', 1, '', '2017-05-22 14:16:54', 3),
(47, 471705, 107, 'Miss Farhat', '1100.00', '2017-05-10', 1, '', '2017-05-22 14:17:38', 3),
(48, 481705, 107, 'Sir Islam', '3500.00', '2017-05-10', 1, '', '2017-05-22 14:18:05', 3),
(49, 491705, 107, 'Sir Kamal', '100.00', '2017-05-10', 1, '', '2017-05-22 14:18:26', 3),
(50, 501705, 107, 'Miss Sana', '1000.00', '2017-05-10', 1, '', '2017-05-22 14:18:50', 3),
(51, 511705, 107, 'Miss Sumaira', '2800.00', '2017-05-10', 1, '', '2017-05-22 14:19:29', 3),
(52, 521705, 107, 'Miss Noreen', '1470.00', '2017-05-10', 1, '', '2017-05-22 14:19:55', 3),
(53, 531705, 107, 'Miss Erum', '600.00', '2017-05-10', 1, '', '2017-05-22 14:20:17', 3),
(54, 541705, 107, 'Masi Came 28 March', '3400.00', '2017-05-10', 1, '', '2017-05-22 14:20:58', 3),
(55, 551705, 105, 'Sultan came 22 March', '6500.00', '2017-05-10', 1, '', '2017-05-22 14:21:31', 3),
(56, 561707, 24, 'qayyum', '3500.00', '2017-07-21', 1, '', '2017-07-21 17:40:28', 5),
(57, 561707, 58, 'qayyum', '250.00', '2017-07-21', 1, '', '2017-07-21 17:40:28', 5);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id_fees` int(11) NOT NULL,
  `inv_no` int(11) DEFAULT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `fee_month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `sub_total` decimal(16,2) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `retruned_amount` decimal(16,2) DEFAULT NULL,
  `fee_type_id` int(11) DEFAULT NULL,
  `fee_date` date DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id_fees`, `inv_no`, `registration_id`, `campus_id`, `session_id`, `class_id`, `shift_id`, `fee_month`, `year`, `sub_total`, `amount`, `retruned_amount`, `fee_type_id`, `fee_date`, `created_on`, `created_by`, `status`, `payment_mode`, `remarks`) VALUES
(1, 17041, 68, 1, 1, 38, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-17', '2017-04-17 18:46:09', 3, 1, 'Cash', NULL),
(2, 17042, 62, 1, 1, 38, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:03:56', 3, 1, 'Cash', NULL),
(3, 17043, 18, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:24:22', 3, 1, 'Cash', NULL),
(4, 17044, 69, 1, 1, 39, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:25:36', 3, 1, 'Cash', NULL),
(5, 17045, 40, 1, 1, 35, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:32:10', 3, 1, 'Cash', NULL),
(6, 17046, 39, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:33:21', 3, 1, 'Cash', NULL),
(7, 17046, 39, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:33:21', 3, 1, 'Cash', NULL),
(8, 17046, 39, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:33:21', 3, 1, 'Cash', NULL),
(9, 17049, 19, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:34:04', 3, 1, 'Cash', NULL),
(10, 170410, 20, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:35:15', 3, 1, 'Cash', NULL),
(11, 170410, 20, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:35:15', 3, 1, 'Cash', NULL),
(12, 170410, 20, 1, 1, 34, 1, 4, 2017, '980.00', '950.00', '0.00', 19, '2017-04-18', '2017-04-17 19:35:15', 3, 1, 'Cash', NULL),
(13, 170413, 25, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:36:12', 3, 1, 'Cash', NULL),
(14, 170413, 25, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:36:12', 3, 1, 'Cash', NULL),
(15, 170413, 25, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:36:12', 3, 1, 'Cash', NULL),
(16, 170416, 26, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:37:25', 3, 1, 'Cash', NULL),
(17, 170416, 26, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:37:25', 3, 1, 'Cash', NULL),
(18, 170416, 26, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:37:25', 3, 1, 'Cash', NULL),
(19, 170419, 27, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:38:09', 3, 1, 'Cash', NULL),
(20, 170419, 27, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:38:09', 3, 1, 'Cash', NULL),
(21, 170419, 27, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:38:09', 3, 1, 'Cash', NULL),
(22, 170422, 71, 1, 1, 39, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:38:45', 3, 1, 'Cash', NULL),
(23, 170423, 51, 1, 1, 36, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:39:34', 3, 1, 'Cash', NULL),
(24, 170423, 51, 1, 1, 36, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:39:34', 3, 1, 'Cash', NULL),
(25, 170423, 51, 1, 1, 36, 1, 4, 2017, '1090.00', '1090.00', '0.00', 19, '2017-04-18', '2017-04-17 19:39:34', 3, 1, 'Cash', NULL),
(26, 170426, 28, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:40:08', 3, 1, 'Cash', NULL),
(27, 170426, 28, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:40:08', 3, 1, 'Cash', NULL),
(28, 170426, 28, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:40:09', 3, 1, 'Cash', NULL),
(29, 170429, 29, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:40:46', 3, 1, 'Cash', NULL),
(30, 170429, 29, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:40:46', 3, 1, 'Cash', NULL),
(31, 170429, 29, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:40:46', 3, 1, 'Cash', NULL),
(32, 170432, 52, 1, 1, 36, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:41:16', 3, 1, 'Cash', NULL),
(33, 170433, 30, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:41:46', 3, 1, 'Cash', NULL),
(34, 170434, 74, 1, 1, 40, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:42:31', 3, 1, 'Cash', NULL),
(35, 170435, 56, 1, 1, 37, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:43:16', 3, 1, 'Cash', NULL),
(36, 170435, 56, 1, 1, 37, 1, 4, 2017, '1280.00', '1280.00', '0.00', 19, '2017-04-18', '2017-04-17 19:43:16', 3, 1, 'Cash', NULL),
(37, 170437, 31, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-17 19:44:04', 3, 1, 'Cash', NULL),
(38, 170437, 31, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:44:04', 3, 1, 'Cash', NULL),
(39, 170439, 57, 1, 1, 37, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:44:38', 3, 1, 'Cash', NULL),
(40, 170440, 32, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:45:41', 3, 1, 'Cash', NULL),
(41, 170440, 32, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:45:41', 3, 1, 'Cash', NULL),
(42, 170442, 33, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-17 19:46:24', 3, 1, 'Cash', NULL),
(43, 170442, 33, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-17 19:46:24', 3, 1, 'Cash', NULL),
(44, 170444, 34, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', NULL, 5, '2017-04-18', '2017-04-17 19:46:58', 3, 1, 'Cash', NULL),
(45, 170444, 34, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', NULL, 19, '2017-04-18', '2017-04-17 19:46:58', 3, 1, 'Cash', NULL),
(46, 170446, 64, 1, 1, 38, 1, 4, 2017, '810.00', '800.00', '0.00', 1, '2017-04-18', '2017-04-17 19:48:43', 3, 1, 'Cash', NULL),
(47, 170447, 43, 1, 1, 35, 1, 4, 2017, '810.00', '700.00', '0.00', 1, '2017-04-18', '2017-04-17 19:49:22', 3, 1, 'Cash', NULL),
(48, 170448, 35, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 04:02:00', 3, 1, 'Cash', NULL),
(49, 170449, 65, 1, 1, 38, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 04:05:53', 3, 1, 'Cash', NULL),
(50, 170449, 65, 1, 1, 38, 1, 4, 2017, '1280.00', '1280.00', '0.00', 19, '2017-04-18', '2017-04-18 04:05:53', 3, 1, 'Cash', NULL),
(51, 170451, 45, 1, 1, 35, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 04:08:56', 3, 1, 'Cash', NULL),
(52, 170452, 53, 1, 1, 36, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 04:09:26', 3, 1, 'Cash', NULL),
(53, 170453, 36, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:35:11', 3, 1, 'Cash', NULL),
(54, 170453, 36, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:35:11', 3, 1, 'Cash', NULL),
(55, 170453, 36, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:35:11', 3, 1, 'Cash', NULL),
(56, 170456, 54, 1, 1, 36, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:41:41', 3, 1, 'Cash', NULL),
(57, 170456, 54, 1, 1, 36, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:41:42', 3, 1, 'Cash', NULL),
(58, 170456, 54, 1, 1, 36, 1, 4, 2017, '1090.00', '1090.00', '0.00', 19, '2017-04-18', '2017-04-18 05:41:42', 3, 1, 'Cash', NULL),
(59, 170459, 37, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:44:01', 3, 1, 'Cash', NULL),
(60, 170459, 37, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:44:02', 3, 1, 'Cash', NULL),
(61, 170459, 37, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:44:02', 3, 1, 'Cash', NULL),
(62, 170462, 79, 1, 1, 41, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:45:19', 3, 1, 'Cash', NULL),
(63, 170462, 79, 1, 1, 41, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:45:19', 3, 1, 'Cash', NULL),
(64, 170462, 79, 1, 1, 41, 1, 4, 2017, '1590.00', '1590.00', '0.00', 19, '2017-04-18', '2017-04-18 05:45:19', 3, 1, 'Cash', NULL),
(65, 170465, 75, 1, 1, 40, 1, 4, 2017, '910.00', '910.00', '0.00', 1, '2017-04-18', '2017-04-18 05:46:09', 3, 1, 'Cash', NULL),
(66, 170465, 75, 1, 1, 40, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:46:09', 3, 1, 'Cash', NULL),
(67, 170465, 75, 1, 1, 40, 1, 4, 2017, '1590.00', '1590.00', '0.00', 19, '2017-04-18', '2017-04-18 05:46:09', 3, 1, 'Cash', NULL),
(68, 170468, 66, 1, 1, 38, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:47:41', 3, 1, 'Cash', NULL),
(69, 170468, 66, 1, 1, 38, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:47:42', 3, 1, 'Cash', NULL),
(70, 170468, 66, 1, 1, 38, 1, 4, 2017, '1280.00', '1280.00', '0.00', 19, '2017-04-18', '2017-04-18 05:47:42', 3, 1, 'Cash', NULL),
(71, 170471, 80, 1, 1, 42, 1, 4, 2017, '1010.00', '1000.00', '0.00', 1, '2017-04-18', '2017-04-18 05:49:40', 3, 1, 'Cash', NULL),
(72, 170471, 80, 1, 1, 42, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:49:41', 3, 1, 'Cash', NULL),
(73, 170471, 80, 1, 1, 42, 1, 4, 2017, '1680.00', '1680.00', '0.00', 19, '2017-04-18', '2017-04-18 05:49:41', 3, 1, 'Cash', NULL),
(74, 170474, 81, 1, 1, 42, 1, 4, 2017, '1680.00', '1500.00', '0.00', 19, '2017-04-18', '2017-04-18 05:50:23', 3, 1, 'Cash', NULL),
(75, 170475, 38, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:51:31', 3, 1, 'Cash', NULL),
(76, 170475, 38, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:51:31', 3, 1, 'Cash', NULL),
(77, 170477, 90, 1, 1, 36, 1, 4, 2017, '910.00', '900.00', NULL, 1, '2017-04-18', '2017-04-18 05:52:25', 3, 1, 'Cash', NULL),
(78, 170477, 90, 1, 1, 36, 1, 4, 2017, '500.00', '500.00', NULL, 5, '2017-04-18', '2017-04-18 05:52:25', 3, 1, 'Cash', NULL),
(79, 170477, 90, 1, 1, 36, 1, 4, 2017, '1090.00', '1090.00', NULL, 19, '2017-04-18', '2017-04-18 05:52:25', 3, 1, 'Cash', NULL),
(80, 170480, 86, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:53:41', 3, 1, 'Cash', NULL),
(81, 170480, 86, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:53:41', 3, 1, 'Cash', NULL),
(82, 170480, 86, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:53:41', 3, 1, 'Cash', NULL),
(83, 170483, 83, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:55:12', 3, 1, 'Cash', NULL),
(84, 170483, 83, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:55:12', 3, 1, 'Cash', NULL),
(85, 170485, 84, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:56:46', 3, 1, 'Cash', NULL),
(86, 170485, 84, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:56:46', 3, 1, 'Cash', NULL),
(87, 170487, 85, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:57:26', 3, 1, 'Cash', NULL),
(88, 170487, 85, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:57:27', 3, 1, 'Cash', NULL),
(89, 170489, 87, 1, 1, 35, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:58:01', 3, 1, 'Cash', NULL),
(90, 170489, 87, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:58:01', 3, 1, 'Cash', NULL),
(91, 170491, 88, 1, 1, 35, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:58:57', 3, 1, 'Cash', NULL),
(92, 170491, 88, 1, 1, 35, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:58:57', 3, 1, 'Cash', NULL),
(93, 170491, 88, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:58:57', 3, 1, 'Cash', NULL),
(94, 170494, 89, 1, 1, 35, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 05:59:26', 3, 1, 'Cash', NULL),
(95, 170494, 89, 1, 1, 35, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 05:59:26', 3, 1, 'Cash', NULL),
(96, 170494, 89, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-18', '2017-04-18 05:59:26', 3, 1, 'Cash', NULL),
(97, 170497, 1, 1, 1, 39, 1, 4, 2017, '1516.00', '20.00', '0.00', 19, '2017-04-18', '2017-04-18 11:50:56', 3, 0, 'Cash', 'testing..Cancelled By : Syed Yaqoob Shah'),
(98, 170498, 1, 1, 1, 39, 1, 4, 2017, '1496.00', '20.00', '0.00', 19, '2017-04-18', '2017-04-18 11:53:49', 3, 0, 'Cash', 'testing..Cancelled By : Syed Yaqoob Shah'),
(99, 170499, 95, 1, 1, 37, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 12:29:40', 3, 1, 'Cash', NULL),
(100, 170499, 95, 1, 1, 37, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 12:29:40', 3, 1, 'Cash', NULL),
(101, 1704101, 96, 1, 1, 35, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 12:30:24', 3, 1, 'Cash', NULL),
(102, 1704101, 96, 1, 1, 35, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 12:30:24', 3, 1, 'Cash', NULL),
(103, 1704103, 97, 1, 1, 34, 1, 4, 2017, '910.00', '900.00', '0.00', 1, '2017-04-18', '2017-04-18 12:30:53', 3, 1, 'Cash', NULL),
(104, 1704103, 97, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-18', '2017-04-18 12:30:53', 3, 1, 'Cash', NULL),
(105, 1704105, 62, 1, 1, 38, 1, 4, 2017, '810.00', '800.00', '0.00', 1, '2017-04-18', '2017-04-18 15:21:11', 3, 1, 'Cash', NULL),
(106, 1704106, 18, 1, 1, 34, 1, 4, 2017, '810.00', '800.00', '0.00', 1, '2017-04-18', '2017-04-18 15:21:51', 3, 1, 'Cash', NULL),
(107, 1704107, 69, 1, 1, 39, 1, 4, 2017, '810.00', '800.00', '0.00', 1, '2017-04-18', '2017-04-18 15:22:48', 3, 1, 'Cash', NULL),
(108, 1704108, 40, 1, 1, 35, 1, 4, 2017, '810.00', '800.00', '0.00', 1, '2017-04-18', '2017-04-18 15:23:25', 3, 1, 'Cash', NULL),
(109, 1704109, 7, 1, 1, 34, 1, 4, 2017, '910.00', '10.00', '0.00', 1, '2017-04-18', '2017-04-18 15:37:45', 3, 1, 'Cash', NULL),
(110, 1704110, 98, 1, 1, 36, 1, 4, 2017, '500.00', '500.00', NULL, 5, '2017-04-19', '2017-04-19 11:12:20', 3, 1, 'Cash', NULL),
(111, 1704110, 98, 1, 1, 36, 1, 4, 2017, '910.00', '910.00', NULL, 1, '2017-04-19', '2017-04-19 11:12:20', 3, 1, 'Cash', NULL),
(112, 1704110, 98, 1, 1, 36, 1, 4, 2017, '1090.00', '90.00', NULL, 19, '2017-04-19', '2017-04-19 11:12:20', 3, 1, 'Cash', NULL),
(113, 1704113, 62, 1, 1, 38, 1, 4, 2017, '1280.00', '1280.00', NULL, 19, '2017-04-19', '2017-04-19 11:16:55', 3, 1, 'Cash', NULL),
(114, 1704114, 40, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-19', '2017-04-19 11:18:36', 3, 1, 'Cash', NULL),
(115, 1704115, 69, 1, 1, 39, 1, 4, 2017, '1516.00', '1516.00', '0.00', 19, '2017-04-19', '2017-04-19 11:20:16', 3, 1, 'Cash', NULL),
(116, 1704116, 18, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-19', '2017-04-19 11:21:22', 3, 1, 'Cash', NULL),
(117, 1704117, 68, 1, 1, 39, 1, 4, 2017, '1516.00', '244.00', '0.00', 19, '2017-04-19', '2017-04-19 11:22:33', 3, 1, 'Cash', NULL),
(118, 1704118, 74, 1, 1, 40, 1, 4, 2017, '1590.00', '1590.00', '0.00', 19, '2017-04-21', '2017-04-21 03:35:20', 3, 1, 'Cash', NULL),
(119, 1704119, 93, 1, 1, 41, 1, 4, 2017, '700.00', '700.00', '0.00', 1, '2017-04-24', '2017-04-24 16:32:35', 3, 1, 'Cash', NULL),
(120, 1704119, 93, 1, 1, 41, 1, 4, 2017, '1590.00', '1500.00', '0.00', 19, '2017-04-24', '2017-04-24 16:32:36', 3, 1, 'Cash', NULL),
(121, 1704121, 70, 1, 1, 39, 1, 4, 2017, '1516.00', '1321.00', '0.00', 19, '2017-04-24', '2017-04-24 16:42:35', 3, 1, 'Cash', NULL),
(122, 1704122, 63, 1, 1, 38, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-24', '2017-04-24 16:47:29', 3, 1, 'Cash', NULL),
(123, 1704122, 63, 1, 1, 38, 1, 4, 2017, '1280.00', '1280.00', '0.00', 19, '2017-04-24', '2017-04-24 16:47:29', 3, 1, 'Cash', NULL),
(124, 1704124, 41, 1, 1, 35, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-24', '2017-04-24 16:49:14', 3, 1, 'Cash', NULL),
(125, 1704124, 41, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-24', '2017-04-24 16:49:14', 3, 1, 'Cash', NULL),
(126, 1704126, 22, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-24', '2017-04-24 16:49:51', 3, 1, 'Cash', NULL),
(127, 1704126, 22, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-24', '2017-04-24 16:49:52', 3, 1, 'Cash', NULL),
(128, 1704128, 23, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-24', '2017-04-24 16:50:32', 3, 1, 'Cash', NULL),
(129, 1704128, 23, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-24', '2017-04-24 16:50:41', 3, 1, 'Cash', NULL),
(130, 1704130, 50, 1, 1, 36, 1, 4, 2017, '1090.00', '1090.00', '0.00', 19, '2017-04-24', '2017-04-24 16:51:20', 3, 1, 'Cash', NULL),
(131, 1704131, 42, 1, 1, 35, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-24', '2017-04-24 16:52:25', 3, 1, 'Cash', NULL),
(132, 1704131, 42, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-24', '2017-04-24 16:52:25', 3, 1, 'Cash', NULL),
(133, 1704133, 24, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-24', '2017-04-24 16:53:00', 3, 1, 'Cash', NULL),
(134, 1704133, 24, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-24', '2017-04-24 16:53:00', 3, 1, 'Cash', NULL),
(135, 1704135, 100, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-24', '2017-04-24 17:10:08', 3, 1, 'Cash', NULL),
(136, 1704135, 100, 1, 1, 34, 1, 4, 2017, '660.00', '660.00', '0.00', 19, '2017-04-24', '2017-04-24 17:10:09', 3, 1, 'Cash', NULL),
(137, 1704137, 101, 1, 1, 36, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-24', '2017-04-24 17:10:42', 3, 1, 'Cash', NULL),
(138, 1704137, 101, 1, 1, 36, 1, 4, 2017, '720.00', '720.00', '0.00', 19, '2017-04-24', '2017-04-24 17:10:42', 3, 1, 'Cash', NULL),
(139, 1704139, 102, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-24', '2017-04-24 17:28:34', 3, 1, 'Cash', NULL),
(140, 1704139, 102, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-24', '2017-04-24 17:28:34', 3, 1, 'Cash', NULL),
(141, 1704141, 81, 1, 1, 42, 1, 4, 2017, '1000.00', '1000.00', '0.00', 1, '2017-04-24', '2017-04-24 17:35:05', 3, 1, 'Cash', NULL),
(142, 1704141, 81, 1, 1, 42, 1, 4, 2017, '180.00', '180.00', '0.00', 19, '2017-04-24', '2017-04-24 17:35:07', 3, 1, 'Cash', NULL),
(143, 1704143, 3, 1, 1, 35, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-25', '2017-04-25 05:05:03', 3, 0, 'Cash', 'dummy by qayyum sir..Cancelled By : Syed Yaqoob Shah'),
(144, 1704144, 103, 1, 1, 42, 1, 4, 2017, '1680.00', '1680.00', '0.00', 19, '2017-04-25', '2017-04-25 06:29:59', 3, 1, 'Cash', NULL),
(145, 1704144, 103, 1, 1, 42, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-04-25', '2017-04-25 06:29:59', 3, 1, 'Cash', NULL),
(146, 1704146, 104, 1, 1, 35, 1, 4, 2017, '910.00', '910.00', '0.00', 1, '2017-04-25', '2017-04-25 07:53:18', 3, 1, 'Cash', NULL),
(147, 1704146, 104, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-25', '2017-04-25 07:53:18', 3, 1, 'Cash', NULL),
(148, 1704146, 104, 1, 1, 35, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-25', '2017-04-25 07:53:19', 3, 1, 'Cash', NULL),
(149, 1704149, 105, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-27', '2017-04-27 03:31:13', 3, 1, 'Cash', NULL),
(150, 1704149, 105, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-27', '2017-04-27 03:31:13', 3, 1, 'Cash', NULL),
(151, 1704151, 106, 1, 1, 34, 1, 4, 2017, '910.00', '910.00', '0.00', 1, '2017-04-27', '2017-04-27 09:47:56', 3, 1, 'Cash', NULL),
(152, 1704151, 106, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-27', '2017-04-27 09:47:56', 3, 1, 'Cash', NULL),
(153, 1704151, 106, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-04-27', '2017-04-27 09:47:56', 3, 1, 'Cash', NULL),
(154, 1704154, 107, 1, 1, 37, 1, 4, 2017, '910.00', '910.00', '0.00', 1, '2017-04-27', '2017-04-27 09:49:23', 3, 1, 'Cash', NULL),
(155, 1704154, 107, 1, 1, 37, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-27', '2017-04-27 09:49:23', 3, 1, 'Cash', NULL),
(156, 1704154, 107, 1, 1, 37, 1, 4, 2017, '1280.00', '600.00', '0.00', 19, '2017-04-27', '2017-04-27 09:49:23', 3, 1, 'Cash', NULL),
(157, 1704157, 93, 1, 1, 41, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-04-29', '2017-04-29 03:08:39', 3, 1, 'Cash', NULL),
(158, 1704157, 93, 1, 1, 41, 1, 4, 2017, '90.00', '90.00', '0.00', 19, '2017-04-29', '2017-04-29 03:08:39', 3, 1, 'Cash', NULL),
(159, 1704159, 60, 1, 1, 38, 1, 4, 2017, '1280.00', '527.00', '0.00', 19, '2017-04-29', '2017-04-29 14:10:29', 3, 1, 'Cash', NULL),
(160, 1704160, 61, 1, 1, 38, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-29', '2017-04-29 14:11:37', 3, 1, 'Cash', NULL),
(161, 1704160, 61, 1, 1, 38, 1, 4, 2017, '1280.00', '1178.00', '0.00', 19, '2017-04-29', '2017-04-29 14:11:37', 3, 1, 'Cash', NULL),
(162, 1704162, 16, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-29', '2017-04-29 14:12:47', 3, 1, 'Cash', NULL),
(163, 1704162, 16, 1, 1, 34, 1, 4, 2017, '980.00', '896.00', '0.00', 19, '2017-04-29', '2017-04-29 14:12:47', 3, 1, 'Cash', NULL),
(164, 1704164, 17, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-29', '2017-04-29 14:13:55', 3, 1, 'Cash', NULL),
(165, 1704164, 17, 1, 1, 34, 1, 4, 2017, '980.00', '896.00', '0.00', 19, '2017-04-29', '2017-04-29 14:13:55', 3, 1, 'Cash', NULL),
(166, 1704166, 44, 1, 1, 35, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-04-29', '2017-04-29 14:15:57', 3, 1, 'Cash', NULL),
(167, 1704166, 44, 1, 1, 35, 1, 4, 2017, '980.00', '896.00', '0.00', 19, '2017-04-29', '2017-04-29 14:15:57', 3, 1, 'Cash', NULL),
(168, 1704168, 61, 1, 1, 38, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-04-29', '2017-04-29 14:19:34', 3, 1, 'Cash', NULL),
(169, 1704169, 16, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-04-29', '2017-04-29 14:20:26', 3, 1, 'Cash', NULL),
(170, 1704170, 17, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-04-29', '2017-04-29 14:20:55', 3, 1, 'Cash', NULL),
(171, 1704171, 44, 1, 1, 35, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-04-29', '2017-04-29 14:21:30', 3, 1, 'Cash', NULL),
(173, 1705172, 110, 1, 1, 34, 1, 5, 2017, '500.00', '500.00', '0.00', 5, '2017-05-03', '2017-05-03 07:22:52', 3, 1, 'Cash', NULL),
(174, 1705172, 110, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-03', '2017-05-03 07:22:52', 3, 1, 'Cash', NULL),
(175, 1705172, 110, 1, 1, 34, 1, 5, 2017, '980.00', '980.00', '0.00', 19, '2017-05-03', '2017-05-03 07:22:52', 3, 1, 'Cash', NULL),
(176, 1705176, 38, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-05-04', '2017-05-04 06:14:12', 3, 1, 'Cash', NULL),
(177, 1705176, 38, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-04', '2017-05-04 06:14:18', 3, 1, 'Cash', NULL),
(178, 1705178, 27, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-04', '2017-05-04 08:36:29', 3, 1, 'Cash', NULL),
(179, 1705179, 80, 1, 1, 42, 1, 5, 2017, '1000.00', '1000.00', '0.00', 1, '2017-05-06', '2017-05-06 04:44:02', 3, 1, 'Cash', NULL),
(180, 1705180, 75, 1, 1, 40, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-06', '2017-05-06 04:45:58', 3, 1, 'Cash', NULL),
(181, 1705181, 66, 1, 1, 38, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-06', '2017-05-06 04:48:23', 3, 1, 'Cash', NULL),
(182, 1705182, 39, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-06', '2017-05-06 06:52:13', 3, 1, 'Cash', NULL),
(183, 1705183, 96, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-05-06', '2017-05-06 14:07:01', 3, 1, 'Cash', NULL),
(184, 1705183, 96, 1, 1, 35, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-06', '2017-05-06 14:07:01', 3, 1, 'Cash', NULL),
(185, 1705185, 97, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-05-06', '2017-05-06 14:08:10', 3, 1, 'Cash', NULL),
(186, 1705185, 97, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-06', '2017-05-06 14:08:11', 3, 1, 'Cash', NULL),
(187, 1705187, 95, 1, 1, 37, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-06', '2017-05-06 14:15:50', 3, 1, 'Cash', NULL),
(188, 1705187, 95, 1, 1, 37, 1, 4, 2017, '1590.00', '1590.00', '0.00', 19, '2017-05-06', '2017-05-06 14:15:50', 3, 1, 'Cash', NULL),
(189, 1705189, 84, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-08', '2017-05-08 04:16:21', 3, 1, 'Cash', NULL),
(190, 1705190, 87, 1, 1, 35, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-08', '2017-05-08 04:19:16', 3, 1, 'Cash', NULL),
(191, 1705191, 79, 1, 1, 41, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-08 19:10:49', 3, 1, 'Cash', NULL),
(192, 1705191, 79, 1, 1, 41, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-08 19:10:50', 3, 1, 'Cash', NULL),
(193, 1705193, 54, 1, 1, 36, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-08 19:14:36', 3, 1, 'Cash', NULL),
(194, 1705193, 54, 1, 1, 36, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-08 19:14:36', 3, 1, 'Cash', NULL),
(195, 1705195, 37, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-08 19:15:31', 3, 1, 'Cash', NULL),
(196, 1705195, 37, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-08 19:15:32', 3, 1, 'Cash', NULL),
(197, 1705197, 29, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-09 04:09:33', 3, 1, 'Cash', NULL),
(198, 1705198, 28, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-09 04:10:11', 3, 1, 'Cash', NULL),
(199, 1705199, 20, 1, 1, 34, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-09 04:11:25', 3, 1, 'Cash', NULL),
(200, 1705200, 55, 1, 1, 36, 1, 5, 2017, '900.00', '900.00', '0.00', 1, '2017-05-09', '2017-05-09 07:09:40', 3, 1, 'Cash', NULL),
(201, 1705201, 86, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-10', '2017-05-10 02:52:42', 3, 1, 'Cash', NULL),
(202, 1705202, 101, 1, 1, 36, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-10', '2017-05-10 02:56:15', 3, 1, 'Cash', NULL),
(203, 1705203, 100, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-10', '2017-05-10 02:57:55', 3, 1, 'Cash', NULL),
(204, 1705204, 34, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-10', '2017-05-10 03:02:09', 3, 1, 'Cash', NULL),
(205, 1705205, 52, 1, 1, 36, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-05-10', '2017-05-10 07:19:30', 3, 1, 'Cash', NULL),
(206, 1705205, 52, 1, 1, 36, 1, 4, 2017, '1090.00', '1090.00', '0.00', 19, '2017-05-10', '2017-05-10 07:19:30', 3, 1, 'Cash', NULL),
(207, 1705205, 52, 1, 1, 36, 1, 5, 2017, '910.00', '910.00', '0.00', 1, '2017-05-10', '2017-05-10 07:19:31', 3, 1, 'Cash', NULL),
(208, 1705208, 30, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-05-10', '2017-05-10 07:20:31', 3, 1, 'Cash', NULL),
(209, 1705208, 30, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-05-10', '2017-05-10 07:20:31', 3, 1, 'Cash', NULL),
(210, 1705208, 30, 1, 1, 34, 1, 5, 2017, '910.00', '910.00', '0.00', 1, '2017-05-10', '2017-05-10 07:20:32', 3, 1, 'Cash', NULL),
(211, 1705211, 38, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-11', '2017-05-11 04:02:57', 3, 1, 'Cash', NULL),
(212, 1705212, 89, 1, 1, 35, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-11', '2017-05-11 04:12:23', 3, 1, 'Cash', NULL),
(213, 1705213, 88, 1, 1, 35, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-11', '2017-05-11 04:13:03', 3, 1, 'Cash', NULL),
(214, 1705214, 93, 1, 1, 41, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-11', '2017-05-11 04:14:09', 3, 1, 'Cash', NULL),
(215, 1705215, 105, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-11', '2017-05-11 04:56:52', 3, 1, 'Cash', NULL),
(216, 1705216, 81, 1, 1, 42, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-11', '2017-05-11 09:40:02', 3, 1, 'Cash', NULL),
(217, 1705217, 36, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-13', '2017-05-13 03:57:21', 3, 1, 'Cash', NULL),
(218, 1705217, 36, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-13', '2017-05-13 03:57:21', 3, 1, 'Cash', NULL),
(219, 1705219, 102, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-13', '2017-05-13 07:15:07', 3, 1, 'Cash', NULL),
(220, 1705220, 58, 1, 1, 37, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-16', '2017-05-16 04:05:06', 3, 1, 'Cash', NULL),
(221, 1705221, 85, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-16', '2017-05-16 04:05:42', 3, 1, 'Cash', NULL),
(222, 1705222, 62, 1, 1, 38, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:22:05', 3, 0, 'Cash', 'without concession..Cancelled By : Syed Yaqoob Shah'),
(223, 1705223, 18, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:23:10', 3, 0, 'Cash', 'without concession..Cancelled By : Syed Yaqoob Shah'),
(224, 1705224, 62, 1, 1, 38, 1, 5, 2017, '810.00', '800.00', '0.00', 1, '2017-05-17', '2017-05-17 04:42:25', 3, 1, 'Cash', NULL),
(225, 1705225, 18, 1, 1, 34, 1, 5, 2017, '810.00', '800.00', '0.00', 1, '2017-05-17', '2017-05-17 04:42:51', 3, 1, 'Cash', NULL),
(226, 1705226, 69, 1, 1, 39, 1, 5, 2017, '810.00', '800.00', '0.00', 1, '2017-05-17', '2017-05-17 04:43:13', 3, 1, 'Cash', NULL),
(227, 1705227, 40, 1, 1, 35, 1, 5, 2017, '810.00', '800.00', '0.00', 1, '2017-05-17', '2017-05-17 04:43:43', 3, 1, 'Cash', NULL),
(228, 1705228, 32, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:45:20', 3, 1, 'Cash', NULL),
(229, 1705228, 32, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:45:20', 3, 1, 'Cash', NULL),
(230, 1705230, 33, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:46:25', 3, 1, 'Cash', NULL),
(231, 1705230, 33, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:46:25', 3, 1, 'Cash', NULL),
(232, 1705232, 104, 1, 1, 35, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:47:03', 3, 1, 'Cash', NULL),
(233, 1705233, 63, 1, 1, 38, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:52:30', 3, 0, 'Cash', 'Due to Maximum fees..Cancelled By : Syed Yaqoob Shah'),
(234, 1705234, 41, 1, 1, 35, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:53:17', 3, 1, 'Cash', NULL),
(235, 1705235, 22, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:53:51', 3, 1, 'Cash', NULL),
(236, 1705236, 23, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 04:54:39', 3, 1, 'Cash', NULL),
(237, 1705237, 42, 1, 1, 35, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 05:02:35', 3, 1, 'Cash', NULL),
(238, 1705238, 24, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-17', '2017-05-17 05:03:44', 3, 1, 'Cash', NULL),
(239, 1705239, 25, 1, 1, 34, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-19', '2017-05-19 04:52:05', 3, 1, 'Cash', NULL),
(240, 1705239, 25, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-19', '2017-05-19 04:52:05', 3, 1, 'Cash', NULL),
(241, 1705241, 105, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-19', '2017-05-19 04:53:10', 3, 1, 'Cash', NULL),
(242, 1705242, 63, 1, 1, 38, 1, 5, 2017, '910.00', '500.00', '0.00', 1, '2017-05-19', '2017-05-19 08:24:49', 3, 1, 'Cash', NULL),
(243, 1705243, 90, 1, 1, 36, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-20', '2017-05-20 03:22:18', 3, 1, 'Cash', NULL),
(244, 1705244, 27, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-22', '2017-05-22 03:38:22', 3, 1, 'Cash', NULL),
(245, 1705245, 7, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-05-22', '2017-05-22 14:33:14', 3, 1, 'Cash', NULL),
(246, 1705245, 7, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-05-22', '2017-05-22 14:33:14', 3, 1, 'Cash', NULL),
(247, 1705247, 6, 1, 1, 35, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-05-22', '2017-05-22 14:35:22', 3, 1, 'Cash', NULL),
(248, 1705247, 6, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-05-22', '2017-05-22 14:35:22', 3, 1, 'Cash', NULL),
(249, 1705249, 34, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-05-23', '2017-05-23 03:18:13', 3, 1, 'Cash', NULL),
(250, 1705250, 29, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-24', '2017-05-24 04:10:18', 3, 1, 'Cash', NULL),
(251, 1705251, 20, 1, 1, 34, 1, 4, 2017, '30.00', '30.00', '0.00', 19, '2017-05-24', '2017-05-24 04:11:10', 3, 1, 'Cash', NULL),
(252, 1705251, 20, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-24', '2017-05-24 04:11:10', 3, 1, 'Cash', NULL),
(253, 1705253, 28, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-24', '2017-05-24 04:11:38', 3, 1, 'Cash', NULL),
(254, 1705254, 51, 1, 1, 36, 1, 5, 2017, '910.00', '900.00', '0.00', 1, '2017-05-25', '2017-05-25 03:56:00', 3, 1, 'Cash', NULL),
(255, 1705254, 51, 1, 1, 36, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-25', '2017-05-25 03:56:00', 3, 1, 'Cash', NULL),
(256, 1705256, 35, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-05-25', '2017-05-25 03:58:32', 3, 1, 'Cash', NULL),
(257, 1705257, 32, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-25', '2017-05-25 04:00:12', 3, 1, 'Cash', NULL),
(258, 1705258, 33, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-25', '2017-05-25 04:01:52', 3, 1, 'Cash', NULL),
(259, 1705259, 26, 1, 1, 34, 1, 4, 2017, '10.00', '10.00', '0.00', 19, '2017-05-25', '2017-05-25 04:20:41', 3, 1, 'Cash', NULL),
(260, 1705259, 26, 1, 1, 34, 1, 5, 2017, '910.00', '910.00', '0.00', 1, '2017-05-25', '2017-05-25 04:20:41', 3, 1, 'Cash', NULL),
(261, 1705259, 26, 1, 1, 34, 1, 7, 2017, '900.00', '900.00', '0.00', 1, '2017-05-25', '2017-05-25 04:20:41', 3, 1, 'Cash', NULL),
(262, 1707262, 21, 1, 1, 34, 1, 4, 2017, '900.00', '900.00', '0.00', 1, '2017-07-21', '2017-07-21 17:17:14', 5, 1, 'Cash', NULL),
(263, 1707262, 21, 1, 1, 34, 1, 4, 2017, '500.00', '500.00', '0.00', 5, '2017-07-21', '2017-07-21 17:17:14', 5, 1, 'Cash', NULL),
(264, 1707262, 21, 1, 1, 34, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-07-21', '2017-07-21 17:17:15', 5, 1, 'Cash', NULL),
(265, 1707262, 21, 1, 1, 34, 1, 5, 2017, '910.00', '910.00', '0.00', 1, '2017-07-21', '2017-07-21 17:17:15', 5, 1, 'Cash', NULL),
(266, 1707262, 21, 1, 1, 34, 1, 7, 2017, '910.00', '910.00', '0.00', 1, '2017-07-21', '2017-07-21 17:17:15', 5, 1, 'Cash', NULL),
(267, 1707267, 31, 1, 1, 34, 1, 5, 2017, '910.00', '910.00', '0.00', 1, '2017-07-27', '2017-07-26 19:44:36', 5, 1, 'Cash', NULL),
(268, 1707268, 31, 1, 1, 34, 1, 7, 2017, '910.00', '910.00', '0.00', 1, '2017-07-27', '2017-07-26 19:50:30', 5, 1, 'Cash', NULL),
(269, 1707269, 3, 1, 1, 35, 1, 4, 2017, '2000.00', '2000.00', '0.00', 5, '2017-07-27', '2017-07-26 19:57:52', 5, 1, 'Cash', NULL),
(270, 1707269, 3, 1, 1, 35, 1, 4, 2017, '980.00', '980.00', '0.00', 19, '2017-07-27', '2017-07-26 19:57:52', 5, 1, 'Cash', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fee_heads`
--

CREATE TABLE `fee_heads` (
  `id_fee_heads` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `fee_type_id` int(11) DEFAULT NULL,
  `class_fees` decimal(16,2) DEFAULT '0.00',
  `fine` decimal(16,2) DEFAULT '0.00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fee_heads`
--

INSERT INTO `fee_heads` (`id_fee_heads`, `class_id`, `campus_id`, `fee_type_id`, `class_fees`, `fine`, `created_on`, `created_by`) VALUES
(87, 43, 1, 5, '500.00', '0.00', '2017-03-27 09:49:44', 3),
(88, 43, 1, 13, '800.00', '0.00', '2017-03-27 09:49:44', 3),
(89, 43, 1, 1, '1000.00', '10.00', '2017-03-27 09:49:44', 3),
(95, 44, 1, 5, '500.00', '0.00', '2017-03-27 09:53:11', 3),
(96, 44, 1, 13, '800.00', '0.00', '2017-03-27 09:53:11', 3),
(97, 44, 1, 1, '1000.00', '10.00', '2017-03-27 09:53:11', 3),
(104, 35, 1, 5, '500.00', '0.00', '2017-04-16 14:17:09', 3),
(105, 35, 1, 1, '900.00', '10.00', '2017-04-16 14:17:09', 3),
(106, 35, 1, 25, '1000.00', '0.00', '2017-04-16 14:17:09', 3),
(107, 35, 1, 19, '980.00', '0.00', '2017-04-16 14:17:09', 3),
(109, 36, 1, 5, '500.00', '0.00', '2017-04-16 14:19:12', 3),
(110, 36, 1, 25, '1000.00', '0.00', '2017-04-16 14:19:12', 3),
(111, 36, 1, 1, '900.00', '10.00', '2017-04-16 14:19:12', 3),
(112, 36, 1, 19, '1090.00', '0.00', '2017-04-16 14:19:12', 3),
(114, 37, 1, 5, '500.00', '0.00', '2017-04-16 14:19:28', 3),
(115, 37, 1, 13, '800.00', '0.00', '2017-04-16 14:19:28', 3),
(116, 37, 1, 1, '900.00', '10.00', '2017-04-16 14:19:28', 3),
(117, 37, 1, 19, '1280.00', '0.00', '2017-04-16 14:19:29', 3),
(124, 39, 1, 5, '500.00', '0.00', '2017-04-16 14:20:09', 3),
(125, 39, 1, 13, '800.00', '0.00', '2017-04-16 14:20:09', 3),
(126, 39, 1, 1, '900.00', '10.00', '2017-04-16 14:20:09', 3),
(127, 39, 1, 19, '1516.00', '0.00', '2017-04-16 14:20:09', 3),
(129, 40, 1, 5, '500.00', '0.00', '2017-04-16 14:20:25', 3),
(130, 40, 1, 13, '800.00', '0.00', '2017-04-16 14:20:25', 3),
(131, 40, 1, 1, '900.00', '10.00', '2017-04-16 14:20:25', 3),
(132, 40, 1, 19, '1590.00', '0.00', '2017-04-16 14:20:25', 3),
(134, 41, 1, 5, '500.00', '0.00', '2017-04-16 14:20:44', 3),
(135, 41, 1, 13, '800.00', '0.00', '2017-04-16 14:20:44', 3),
(136, 41, 1, 1, '900.00', '10.00', '2017-04-16 14:20:44', 3),
(137, 41, 1, 19, '1590.00', '0.00', '2017-04-16 14:20:44', 3),
(139, 42, 1, 5, '500.00', '0.00', '2017-04-16 14:21:26', 3),
(140, 42, 1, 13, '800.00', '0.00', '2017-04-16 14:21:26', 3),
(141, 42, 1, 1, '1000.00', '10.00', '2017-04-16 14:21:26', 3),
(142, 42, 1, 19, '1680.00', '0.00', '2017-04-16 14:21:26', 3),
(143, 34, 1, 1, '900.00', '10.00', '2017-04-17 23:51:54', 3),
(144, 34, 1, 25, '1000.00', '0.00', '2017-04-17 23:51:54', 3),
(145, 34, 1, 5, '500.00', '0.00', '2017-04-17 23:51:54', 3),
(146, 34, 1, 19, '980.00', '0.00', '2017-04-17 23:51:54', 3),
(147, 34, 1, 11, '2000.00', '0.00', '2017-04-17 23:51:54', 3),
(148, 38, 1, 5, '500.00', '0.00', '2017-04-24 21:45:17', 3),
(149, 38, 1, 13, '800.00', '0.00', '2017-04-24 21:45:17', 3),
(150, 38, 1, 1, '900.00', '10.00', '2017-04-24 21:45:17', 3),
(151, 38, 1, 19, '1290.00', '0.00', '2017-04-24 21:45:17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id_fee_type` int(11) NOT NULL,
  `fee_type_name` varchar(50) DEFAULT NULL,
  `status_active` char(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id_fee_type`, `fee_type_name`, `status_active`) VALUES
(1, 'MONTHLY', 'Y'),
(2, 'EXAMINATION I', 'N'),
(3, 'EXAMINATION II', 'N'),
(4, 'EXAMINATION III', 'N'),
(5, 'REGISTRATION', 'Y'),
(6, 'PROVISIONAL', 'N'),
(7, 'COMPUTER', 'N'),
(8, 'PRACTICAL', 'N'),
(9, 'ARREARS', 'N'),
(10, 'IDENTITY CARD', 'N'),
(11, 'ADMISSION', 'Y'),
(12, 'OTHER', 'N'),
(13, 'ANUUAL FEE', 'N'),
(14, 'BOARD ENROLLMENT', 'N'),
(15, 'BOARD EXAMINATION', 'N'),
(16, 'LEAVING CERTIFICATE', 'N'),
(17, 'FEE CARD', 'N'),
(18, 'LIBRARY FEE', 'N'),
(19, 'COURSE FEE', 'Y'),
(20, 'EVENT FEE', 'N'),
(22, 'PENALTY CHARGES', 'N'),
(23, 'DAIRY', 'N'),
(24, 'SYLLABUS', 'N'),
(25, 'STATIONARY', 'N'),
(26, 'LAB CHARGES', 'N'),
(30, 'STATIONARY BAG', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `fmc`
--

CREATE TABLE `fmc` (
  `id_fmc` int(11) NOT NULL,
  `fmc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fmc`
--

INSERT INTO `fmc` (`id_fmc`, `fmc`) VALUES
(1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `foc`
--

CREATE TABLE `foc` (
  `id_foc` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `foc_for` int(11) DEFAULT NULL,
  `foc_for_qty` int(11) DEFAULT NULL,
  `foc_product` int(11) DEFAULT NULL,
  `foc_product_qty` int(11) DEFAULT NULL,
  `active` char(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `supplier_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foc`
--

INSERT INTO `foc` (`id_foc`, `supplier_id`, `foc_for`, `foc_for_qty`, `foc_product`, `foc_product_qty`, `active`, `created_by`, `created_on`, `supplier_product_id`) VALUES
(4, 100, 1236, 12, 1236, 2, 'y', NULL, '2017-05-30 03:11:59', 1049);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_details`
--

CREATE TABLE `gallery_details` (
  `id_gallery_details` int(11) NOT NULL,
  `master_gallery_id` int(11) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `gallery_details`
--

INSERT INTO `gallery_details` (`id_gallery_details`, `master_gallery_id`, `pic`) VALUES
(1, 1, '04.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

CREATE TABLE `general_setting` (
  `id_general_setting` int(11) NOT NULL,
  `Institution_Name` varchar(200) DEFAULT NULL,
  `Institution_Address` varchar(200) DEFAULT NULL,
  `Institution_Email` varchar(200) DEFAULT NULL,
  `Institution_Phone` varchar(12) DEFAULT NULL,
  `Institution_Mobile` varchar(12) DEFAULT NULL,
  `Institution_Fax` varchar(20) DEFAULT NULL,
  `Admin_Contact_Person` varchar(50) DEFAULT NULL,
  `Country` char(2) DEFAULT NULL,
  `Currency_Type` varchar(10) DEFAULT NULL,
  `Language` varchar(50) DEFAULT NULL,
  `Timezone` varchar(200) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`id_general_setting`, `Institution_Name`, `Institution_Address`, `Institution_Email`, `Institution_Phone`, `Institution_Mobile`, `Institution_Fax`, `Admin_Contact_Person`, `Country`, `Currency_Type`, `Language`, `Timezone`, `created_on`, `created_by`, `logo`) VALUES
(1, 'THE SKY FOUNDATION SCHOOLING SYSTEM', 'Add: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.Baldia Town,Karachi.', 'skyfoundation.edu@gmail.com', '03472078157', '0317-0215022', '123456', 'Syed Yaqoob Shah.', 'PK', 'PKR', 'English', 'Pakistan Islamabad Time(PLT) - GMT+05:00', '2017-07-21 18:06:36', NULL, 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `good_return_note`
--

CREATE TABLE `good_return_note` (
  `id_good_return_note` int(11) NOT NULL,
  `requisition_id` int(11) NOT NULL,
  `requisition_type_id` int(11) NOT NULL,
  `dispatch_note_id` int(11) NOT NULL,
  `good_return_date` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `remarks` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `good_return_note_detail`
--

CREATE TABLE `good_return_note_detail` (
  `id_good_return_note_detail` int(11) NOT NULL,
  `good_return_note_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `returned_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade_setting`
--

CREATE TABLE `grade_setting` (
  `id_grades` int(11) NOT NULL,
  `per` decimal(16,2) DEFAULT '0.00',
  `per_i` decimal(16,2) DEFAULT '0.00',
  `per_ii` decimal(16,2) DEFAULT '0.00',
  `per_iii` decimal(16,2) DEFAULT '0.00',
  `per_iv` decimal(16,2) DEFAULT '0.00',
  `per_v` decimal(16,2) DEFAULT '0.00',
  `per_vi` decimal(16,2) DEFAULT '0.00',
  `per_vii` decimal(16,2) DEFAULT '0.00',
  `grade` varchar(50) DEFAULT NULL,
  `grade_i` varchar(50) DEFAULT NULL,
  `grade_ii` varchar(50) DEFAULT NULL,
  `grade_iii` varchar(50) DEFAULT NULL,
  `grade_iv` varchar(50) DEFAULT NULL,
  `grade_v` varchar(50) DEFAULT NULL,
  `grade_vi` varchar(50) DEFAULT NULL,
  `grade_vii` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `grade_setting`
--

INSERT INTO `grade_setting` (`id_grades`, `per`, `per_i`, `per_ii`, `per_iii`, `per_iv`, `per_v`, `per_vi`, `per_vii`, `grade`, `grade_i`, `grade_ii`, `grade_iii`, `grade_iv`, `grade_v`, `grade_vi`, `grade_vii`) VALUES
(1, '33.00', '33.00', '40.00', '50.00', '60.00', '70.00', '80.00', '90.00', 'F', 'E', 'D', 'C', 'B', 'A', 'A-1', 'A-1+');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id_inquery` int(11) NOT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `for_class_id` int(11) DEFAULT NULL,
  `area_id` int(11) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `inquery_date` date DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id_inquery`, `f_name`, `l_name`, `for_class_id`, `area_id`, `contact`, `address`, `inquery_date`, `created_on`, `created_by`, `status`, `remarks`) VALUES
(4, 'SYED ZOHAIB', 'SHAH', 34, 0, '03158361693', 'HABIBABAD,RASHEEDABAD COLONY.', '2017-03-09', '2017-03-09 05:12:18', 3, 'Pending', ''),
(5, 'SYED JAHANZAIB', 'SHAH', 34, 0, '03158361693', 'HABIBABAD,RASHEEDABAD COLONY.', '2017-03-09', '2017-03-09 05:13:54', 3, 'Pending', ''),
(6, 'SYEDAH BISMA', 'SHAH', 34, 0, '03158361693', 'HABIBABAD, RASHEEDABAD COLONY.', '2017-03-09', '2017-03-09 05:14:32', 3, 'Pending', ''),
(7, 'SYEDAH ISMA', 'SHAH', 34, 0, '03158361693', 'HABIBABAD, RASHEEDABAD COLONY.', '2017-03-09', '2017-03-09 05:15:20', 3, 'Pending', ''),
(8, 'SYEDAH ASMA', 'SHAH', 34, 0, '03158361693', 'HABIBABAD, RASHEEDABAD COLONY.', '2017-03-09', '2017-03-09 05:16:03', 3, 'Pending', ''),
(9, 'Muhammad', 'Shah', 35, 0, '03312199285', 'House no 3426/A, Sarhad Muhallah, Rasheedabad Colony, Baldia Town.', '2017-03-24', '2017-03-24 04:51:09', 3, 'Pending', ''),
(10, 'Maliha', 'Ismail', 34, 0, '03332365496', 'Habibabad, Rasheedabad.', '2017-03-25', '2017-03-25 15:01:26', 3, 'Pending', ''),
(11, 'Zobia', 'Ismail', 34, 0, '03332365496', 'Sarhad Muhallah no 4, Rasheedabad.', '2017-03-25', '2017-03-25 15:03:39', 3, 'Pending', ''),
(12, 'Robina', 'Yaqoob', 34, 0, '03222292530', 'Sarhad Muhallah no 4, Rasheedabad.', '2017-03-25', '2017-03-25 15:06:11', 3, 'Pending', ''),
(13, 'Azan', 'Butt', 34, 0, '03112580985', 'Habibabad, Rasheedabad.', '2017-03-25', '2017-03-25 15:07:18', 3, 'Pending', ''),
(14, 'Syed Mehar', 'Ali Shah', 34, 0, '03451276947', 'Rasheedabad.', '2017-03-25', '2017-03-25 15:08:17', 3, 'Pending', ''),
(15, 'Talha', 'Abbasi', 34, 0, '03333036904', 'Sarhad Muhallah, Rasheedabad.', '2017-03-25', '2017-03-25 15:10:21', 3, 'Pending', ''),
(16, 'Abdul', 'Rehman', 34, 0, '03483686158', 'Rasheedabad.', '2017-03-25', '2017-03-25 15:11:15', 3, 'Pending', ''),
(17, 'Muhammad', 'Zaid', 34, 0, '03152686240', 'Rasheedabad.', '2017-03-25', '2017-03-25 15:12:08', 3, 'Pending', ''),
(18, 'Maryam', 'Abbasi', 34, 0, '03432003183', 'Sarhad Muhallah no 4. Rasheedabad.', '2017-03-25', '2017-03-25 15:13:11', 3, 'Pending', ''),
(19, 'Asim', 'Abbasi', 34, 0, '03432003183', 'Sarhad Muhallah no 4. Rasheedabad.', '2017-03-25', '2017-03-25 15:13:55', 3, 'Pending', ''),
(20, 'Aqsa', 'Abbasi', 34, 0, '03432003183', 'Sarhad Muhallah no 4. Rasheedabad.', '2017-03-25', '2017-03-25 15:14:39', 3, 'Pending', ''),
(21, 'Inam', 'ullah', 34, 0, '03482323839', 'Rasheedabad', '2017-03-27', '2017-03-27 03:52:41', 3, 'Pending', ''),
(22, 'Luqman', '1', 34, 0, '03120222387', 'Rasheedabad', '2017-03-27', '2017-03-27 03:53:39', 3, 'Pending', ''),
(23, 'Wahid', 'Gul', 34, 0, '03452962248', 'Rasheedabad', '2017-03-27', '2017-03-27 03:55:13', 3, 'Pending', ''),
(24, 'Abdul', 'Basit', 34, 0, '03322173085', 'Rasheedabad.', '2017-03-27', '2017-03-27 03:56:01', 3, 'Pending', ''),
(25, 'Nasir', '1', 34, 0, '03452771763', 'Rasheedabad.', '2017-03-27', '2017-03-27 03:57:31', 3, 'Pending', ''),
(26, 'Ubaid', 'Ullah', 34, 0, '03126044507', '6 no.', '2017-03-27', '2017-03-27 03:58:16', 3, 'Pending', ''),
(27, 'shad', 'husain', 34, 0, '03112374986', 'Rasheedabad.', '2017-03-27', '2017-03-27 03:59:37', 3, 'Pending', ''),
(28, 'Wali', '1', 34, 0, '03452955675', 'Rasheedabad.', '2017-03-27', '2017-03-27 04:01:16', 3, 'Pending', ''),
(29, 'Abdul', 'Samad', 34, 0, '03453359592', 'Rasheedabad.', '2017-03-27', '2017-03-27 04:02:20', 3, 'Pending', ''),
(30, 'M.', 'Babar', 34, 0, '034229014203', 'Rasheedabad', '2017-03-27', '2017-03-27 04:03:33', 3, 'Pending', ''),
(31, 'Owais', '1', 34, 0, '03363480046', 'Rasheedabad.', '2017-03-27', '2017-03-27 04:04:21', 3, 'Pending', ''),
(32, 'Bilal', '1', 34, 0, '03152106907', 'Rasheedabad', '2017-03-27', '2017-03-27 04:05:02', 3, 'Pending', ''),
(33, 'M.', 'Azam', 34, 0, '03491264915', 'Rasheedabad.', '2017-03-27', '2017-03-27 04:06:09', 3, 'Pending', ''),
(34, 'Jawad', '1', 34, 0, '03152063048', 'Rasheedabad.', '2017-03-27', '2017-03-27 04:07:06', 3, 'Pending', ''),
(35, 'Adam', 'Khan', 34, 0, '03058093090', 'Rasheedabad', '2017-03-27', '2017-03-27 04:07:54', 3, 'Pending', ''),
(37, 'Kamran', '1', 34, 0, '03353721250', 'Habibabad,Rasheedabad.', '2017-03-28', '2017-03-28 12:06:36', 3, 'Pending', ''),
(38, 'Muhammad', 'Aalam', 34, 0, '03012968106', 'Sarhad Muhallah, Habibabad Rasheedabad Colony.', '2017-03-28', '2017-03-28 12:11:15', 3, 'Pending', ''),
(39, 'Ali', 'Sher', 34, 0, '03043823703', 'Sarhad Muhallah, Habibabad Rasheedabad Colony.\n', '2017-03-28', '2017-03-28 12:13:03', 3, 'Pending', ''),
(40, 'Abdul', 'Qayyum', 34, 0, '03432247790', 'Sarhad Muhallah, Habib Masjid,Rasheedabad.\n', '2017-03-28', '2017-03-28 12:15:30', 3, 'Pending', ''),
(41, 'Abdul', 'Raheem', 34, 0, '03333021286', 'Sarhad Muhallah, Habib Masjid,Rasheedabad.', '2017-03-28', '2017-03-28 12:17:58', 3, 'Pending', ''),
(42, 'Ashfaq', 'Khan', 34, 0, '03022834618', 'Sarhad Muhallah, Habib Masjid,Rasheedabad.', '2017-03-28', '2017-03-28 12:21:14', 3, 'Pending', ''),
(43, 'Waheed', 'Gul', 34, 0, '03452962248', 'Habibabad Rasheedabad Colony.', '2017-03-28', '2017-03-28 12:22:45', 3, 'Pending', ''),
(44, 'Muhammad', 'Faheem', 34, 0, '03482072766', 'Habibabad Rasheedabad Colony.', '2017-03-28', '2017-03-28 12:24:21', 3, 'Pending', ''),
(45, 'Shah', 'Jahan', 34, 0, '03152686240', 'Rasheedabad Colony.', '2017-03-28', '2017-03-28 12:25:23', 3, 'Pending', ''),
(46, 'Allam', 'Uddin', 34, 0, '03473577479', 'Habibabad Rasheedabad Colony.', '2017-03-28', '2017-03-28 12:29:04', 3, 'Pending', ''),
(48, 'Muhammad', 'Ali', 39, 0, '03332362260', 'Habibabad Rasheedabad Colony.', '2017-03-29', '2017-03-29 07:59:05', 3, 'Pending', ''),
(49, 'sy', 'shah', 35, 0, '03453956174', '5 no.', '2017-03-29', '2017-03-29 13:09:02', 3, 'Pending', ''),
(50, 'Fazal', 'Azeem', 34, 0, '03022087457', 'Habibabad, Rasheedabad.', '2017-03-29', '2017-03-29 13:26:44', 3, 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `main_account`
--

CREATE TABLE `main_account` (
  `id_main_account` int(11) NOT NULL,
  `main_account_number` varchar(2) DEFAULT NULL,
  `main_account_name` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `main_account`
--

INSERT INTO `main_account` (`id_main_account`, `main_account_number`, `main_account_name`, `created_by`, `created_on`) VALUES
(1, '01', 'Assets', 7, '2016-11-24 12:54:21'),
(2, '02', 'Liabilities', 7, '2016-11-24 13:37:20'),
(3, '03', 'Capital', 7, '2016-11-24 14:02:13'),
(4, '04', 'Expenses', 7, '2016-11-24 14:07:04'),
(5, '05', 'Revenue', 7, '2016-11-24 14:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE `main_menu` (
  `id_main_menu` int(11) NOT NULL,
  `manu_name` varchar(50) DEFAULT NULL,
  `menu_status` enum('Yes','No') DEFAULT 'Yes',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id_main_menu`, `manu_name`, `menu_status`, `created_by`, `created_on`) VALUES
(1, 'General Setting', 'Yes', NULL, '2017-08-12 07:12:23'),
(2, 'Organization', 'Yes', NULL, '2017-08-12 07:12:38'),
(3, 'Student Management', 'Yes', NULL, '2017-08-12 07:12:52'),
(4, 'Fees Management', 'Yes', NULL, '2017-08-12 07:13:05'),
(5, 'Dues Management', 'Yes', NULL, '2017-08-12 07:13:14'),
(6, 'Examination Management', 'Yes', NULL, '2017-08-12 07:13:20'),
(7, 'Students Attendance', 'Yes', NULL, '2017-08-12 07:13:26'),
(8, 'Inventory Management', 'Yes', NULL, '2017-08-12 07:13:31'),
(9, 'Finance Management', 'Yes', NULL, '2017-08-12 07:13:38'),
(10, 'Reporting Area', 'Yes', NULL, '2017-08-12 07:13:44'),
(11, 'SMS', 'Yes', NULL, '2017-08-12 07:13:50'),
(12, 'Tools', 'Yes', NULL, '2017-08-12 07:13:56'),
(13, 'User Management', 'Yes', NULL, '2017-08-12 07:14:02'),
(14, 'Help', 'Yes', NULL, '2017-08-12 07:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `master_gallery`
--

CREATE TABLE `master_gallery` (
  `id_master_gallery` int(11) NOT NULL,
  `desc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_gallery`
--

INSERT INTO `master_gallery` (`id_master_gallery`, `desc`) VALUES
(1, 'Gallery 1'),
(2, 'Gallery 2'),
(3, 'Gallery 3'),
(4, 'Gallery 4'),
(5, 'Gallery 5');

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id_month` int(11) NOT NULL,
  `month_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id_month`, `month_name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April\r\n'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August\r\n'),
(9, 'September\r\n'),
(10, 'October\r\n'),
(11, 'November\r\n'),
(12, 'December\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `net_profit`
--

CREATE TABLE `net_profit` (
  `id_net_profit` int(11) NOT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `net_profit` decimal(16,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `packing_types`
--

CREATE TABLE `packing_types` (
  `packaging_id` int(11) NOT NULL,
  `packaging_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packing_types`
--

INSERT INTO `packing_types` (`packaging_id`, `packaging_desc`) VALUES
(6, 'Box'),
(7, 'Pics'),
(8, 'Unit');

-- --------------------------------------------------------

--
-- Table structure for table `payment_advice`
--

CREATE TABLE `payment_advice` (
  `id_payment_advice` int(11) NOT NULL,
  `grn_id` int(11) NOT NULL,
  `po_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `po_number` varchar(50) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `advice_date` datetime DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `payment_advice`
--

INSERT INTO `payment_advice` (`id_payment_advice`, `grn_id`, `po_id`, `supplier_id`, `po_number`, `invoice_number`, `advice_date`, `created_on`, `created_by`, `status`) VALUES
(14, 574, 2, 100, 'P-2 ', 'adsf', '2017-06-13 00:00:00', '2017-06-02 04:53:02', 5, 'Active'),
(15, 575, 1, 100, 'P-1 ', 'fdgdg', '2017-06-12 00:00:00', '2017-06-02 05:02:10', 5, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment_advice_details`
--

CREATE TABLE `payment_advice_details` (
  `id_payment_advice_details` int(11) NOT NULL,
  `payment_advice_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `po_qty` int(11) DEFAULT NULL,
  `delivered_qrty` int(11) DEFAULT '0',
  `invoice_qty` int(11) DEFAULT '0',
  `unit_price` decimal(16,2) DEFAULT '0.00',
  `sub_total` decimal(16,2) DEFAULT '0.00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `payment_advice_details`
--

INSERT INTO `payment_advice_details` (`id_payment_advice_details`, `payment_advice_id`, `product_id`, `product_name`, `po_qty`, `delivered_qrty`, `invoice_qty`, `unit_price`, `sub_total`, `created_on`, `created_by`) VALUES
(23, 14, 1236, 'Pen ', NULL, 0, 0, '0.00', '150.00', '2017-06-02 04:53:02', 5),
(24, 15, 1236, 'Pen ', NULL, 0, 0, '0.00', '150.00', '2017-06-02 05:02:10', 5);

-- --------------------------------------------------------

--
-- Table structure for table `po_condition`
--

CREATE TABLE `po_condition` (
  `id_po_condition` int(11) NOT NULL,
  `po_condition` varchar(105) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `po_condition`
--

INSERT INTO `po_condition` (`id_po_condition`, `po_condition`) VALUES
(1, 'Pending'),
(2, 'Cancelled'),
(3, 'On Hold'),
(4, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `po_details`
--

CREATE TABLE `po_details` (
  `id_po_details` int(11) NOT NULL,
  `po_id` int(11) DEFAULT NULL,
  `po_number` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `pack_qty` int(11) DEFAULT NULL,
  `units_per_pack` int(11) DEFAULT NULL,
  `total_units` int(11) DEFAULT NULL,
  `pack_price` decimal(10,2) DEFAULT NULL,
  `unit_price` decimal(16,2) DEFAULT NULL,
  `total` decimal(16,2) DEFAULT NULL,
  `tax` decimal(16,2) DEFAULT '0.00',
  `foc_status` char(1) COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `po_details`
--

INSERT INTO `po_details` (`id_po_details`, `po_id`, `po_number`, `product_id`, `product_name`, `pack_qty`, `units_per_pack`, `total_units`, `pack_price`, `unit_price`, `total`, `tax`, `foc_status`) VALUES
(1, 2, 'P-2 ', 1236, 'Pen', 1, 1, 1, '150.00', '150.00', '150.00', '0.00', 'N'),
(2, 1, 'P-1 ', 1236, 'Pen', 1, 1, 1, '150.00', '150.00', '150.00', '0.00', 'N'),
(3, 5, 'P-1 ', 1236, 'Pen', 12, 1, 12, '150.00', '12.50', '1800.00', '0.00', 'N'),
(4, 7, 'P-3 ', 1236, 'Pen', 12, 10, 120, '100.00', '0.83', '1200.00', '0.00', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `po_grn`
--

CREATE TABLE `po_grn` (
  `id_po_grn` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `po_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `grn_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `grn_created_by` int(11) NOT NULL,
  `suppliers_id` int(11) NOT NULL,
  `remarks` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dc_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `inv_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dc_date` datetime NOT NULL,
  `bill_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `po_grn`
--

INSERT INTO `po_grn` (`id_po_grn`, `po_id`, `po_number`, `grn_date`, `grn_created_by`, `suppliers_id`, `remarks`, `dc_no`, `inv_no`, `dc_date`, `bill_date`) VALUES
(575, 1, 'P-1 ', '2017-06-02 05:01:41', 0, 100, 'sdfgfsd', '34664', 'fdgdg', '2017-06-08 00:00:00', '2017-06-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `po_grn_detail`
--

CREATE TABLE `po_grn_detail` (
  `id_po_grn_detail` int(11) NOT NULL,
  `po_grn_id` int(11) DEFAULT NULL,
  `grn_product_id` int(11) DEFAULT NULL,
  `grn_product_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `received_pack_qty` int(11) DEFAULT NULL,
  `received_units_per_pack` int(11) DEFAULT NULL,
  `received_pack_price` double DEFAULT NULL,
  `received_unit_price` double DEFAULT NULL,
  `bonus` int(11) NOT NULL,
  `gst` decimal(16,2) NOT NULL,
  `disc` decimal(16,2) NOT NULL,
  `sub_total` decimal(16,2) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `grn_batch_no` varchar(45) COLLATE utf8_bin NOT NULL,
  `grn_item_expiry` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `po_grn_detail`
--

INSERT INTO `po_grn_detail` (`id_po_grn_detail`, `po_grn_id`, `grn_product_id`, `grn_product_name`, `received_pack_qty`, `received_units_per_pack`, `received_pack_price`, `received_unit_price`, `bonus`, `gst`, `disc`, `sub_total`, `created_on`, `created_by`, `grn_batch_no`, `grn_item_expiry`) VALUES
(3, 575, 1236, 'Pen ', 1, NULL, 150, 150, 0, '0.00', '0.00', '150.00', '2017-06-02 05:01:41', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `po_status`
--

CREATE TABLE `po_status` (
  `id_po_status` int(11) NOT NULL,
  `po_status` varchar(105) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `po_status`
--

INSERT INTO `po_status` (`id_po_status`, `po_status`) VALUES
(1, 'Not Sent to Supplier'),
(2, 'Waiting Deliveries'),
(3, 'Recieved Pending Payment'),
(4, 'Partial Payment'),
(5, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_products` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_desc` mediumtext,
  `product_type` int(11) DEFAULT NULL,
  `product_active` char(1) DEFAULT 'y',
  `expiry_months` int(11) DEFAULT '12',
  `sku` varchar(45) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `min_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_products`, `product_name`, `product_desc`, `product_type`, `product_active`, `expiry_months`, `sku`, `stock`, `min_stock`) VALUES
(1236, 'Pen', 'Pen ', 1, 'y', 12, NULL, 10, 10),
(1237, 'pen', 'sdf', 15, 'y', 12, '', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `producttypes`
--

CREATE TABLE `producttypes` (
  `type_id` int(11) NOT NULL,
  `type_desc` varchar(100) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `type_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producttypes`
--

INSERT INTO `producttypes` (`type_id`, `type_desc`, `created`, `type_name`) VALUES
(15, NULL, '2017-06-04 10:40:30', 'A4 Paper');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id_purchase_orders` int(11) NOT NULL,
  `purchase_order_number` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `supplier_name` varchar(155) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `purchase_order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `purchase_order_status` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `purchase_order_status_id` int(11) DEFAULT NULL,
  `purchase_order_condition` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `purchase_order_condition_id` int(11) DEFAULT NULL,
  `po_reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id_purchase_orders`, `purchase_order_number`, `supplier_id`, `supplier_name`, `purchase_order_date`, `purchase_order_status`, `purchase_order_status_id`, `purchase_order_condition`, `purchase_order_condition_id`, `po_reason`) VALUES
(5, 'P-1', 100, 'ABC entrprise2', '2017-06-04 05:37:18', 'Recieved Pending Payment', 3, 'Recieved Pending Payment', 3, 'Normal'),
(6, 'P-2', 100, 'ABC entrprise2', '2017-06-04 05:37:37', 'Recieved Pending Payment', 3, 'Recieved Pending Payment', 3, 'Normal'),
(7, 'P-3', 101, 'ABC entrprise', '2017-06-17 10:41:03', 'Recieved Pending Payment', 3, 'Recieved Pending Payment', 3, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_note`
--

CREATE TABLE `purchase_return_note` (
  `id_prn_note` int(11) NOT NULL,
  `grn_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `suppliers_id` int(11) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` mediumtext,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return_note`
--

INSERT INTO `purchase_return_note` (`id_prn_note`, `grn_id`, `po_id`, `suppliers_id`, `po_number`, `date`, `created_on`, `remarks`, `created_by`) VALUES
(18, 574, 2, 100, 'P-2 ', '2017-06-08 09:40:23', '2017-06-02 04:40:23', 'etses', 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_note_detail`
--

CREATE TABLE `purchase_return_note_detail` (
  `id_prn_note_detail` int(11) NOT NULL,
  `prn_note_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `qty_returned` int(11) NOT NULL,
  `remarks` mediumtext NOT NULL,
  `grn_batch_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return_note_detail`
--

INSERT INTO `purchase_return_note_detail` (`id_prn_note_detail`, `prn_note_id`, `product_id`, `product_name`, `qty_returned`, `remarks`, `grn_batch_no`) VALUES
(14, 18, 1236, 'Pen ', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id_reasons` int(11) NOT NULL,
  `reasons` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id_reasons`, `reasons`) VALUES
(5, 'Normal'),
(6, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id_registration` int(11) NOT NULL,
  `gr` varchar(50) DEFAULT '0',
  `fmc` varchar(50) DEFAULT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `guardian_name` varchar(50) DEFAULT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `contact1` varchar(50) DEFAULT NULL,
  `contact2` varchar(50) DEFAULT NULL,
  `contact3` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `doa` datetime DEFAULT NULL,
  `nic` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `active` char(1) DEFAULT 'Y',
  `image` varchar(200) DEFAULT 'avatar-1.jpg',
  `record` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `fee_status` char(1) DEFAULT 'P',
  `pin_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id_registration`, `gr`, `fmc`, `student_name`, `father_name`, `guardian_name`, `mother_name`, `contact1`, `contact2`, `contact3`, `phone`, `dob`, `doa`, `nic`, `address`, `sex`, `religion`, `active`, `image`, `email`, `created_by`, `created_on`, `fee_status`, `pin_code`) VALUES
(1, '', 'FMC-1', 'SYEDAH MANAHIL', 'SYED YAQOOB SHAH', '', '', '03453956174', '', '', '', '2009-10-21 00:00:00', '2017-04-09 00:00:00', '42401-3200731-5', 'House no, 1725/3435, Sarhad Road, Madina Colony, Baldia Town,Karachi.', 'Female', '1', 'Y', 'avatar-1.jpg', 'syaqoobshah@hotmail.com', 3, '2017-04-09 18:52:37', 'C', 4410),
(2, '', 'FMC-1', 'SYEDAH ZUNAIRA', 'SYED YAQOOB SHAH', '', '', '03453956174', '', '', '', '2011-09-30 00:00:00', '2017-04-09 00:00:00', '42401-3200731-5', 'House no, 1725/3435, Sarhad Road, Madina Colony, Baldia Town,Karachi.', 'Female', '1', 'Y', 'avatar-1.jpg', 'syaqoobshah@hotmail.com', 3, '2017-04-09 19:00:26', 'C', 0),
(3, '', 'FMC-1', 'SYED HASEEB SHAH', 'SYED YAQOOB SHAH', '', '', '03112000984', '', '', '', '2013-10-08 00:00:00', '2017-04-09 00:00:00', '42401-3200731-5', 'House no, 1725/3435, Sarhad Road, Madina Colony, Baldia Town,Karachi.', 'Male', '1', 'Y', 'avatar-1.jpg', 'syaqoobshah@hotmail.com', 3, '2017-04-09 19:03:29', 'C', 1243),
(4, '', 'FMC-2', 'SYEDAH SHAAMIA', 'SYED AZAM SHAH', 'SYED YAQOOB SHAH', '', '03332261654', '', '', '', '2005-01-01 00:00:00', '2017-04-09 00:00:00', '42401-3200731-6', 'House no, 1725/3435, Sarhad Road, Madina Colony, Baldia Town, Karachi.', 'Female', '1', 'Y', 'avatar-1.jpg', 'syaqoobshah@hotmail.com', 3, '2017-04-09 19:08:36', 'C', 0),
(5, '', 'FMC-2', 'SYEDAH EMAAN', 'SYED AZAM SHAH', 'SYED YAQOOB SHAH', '', '03332261654', '', '', '', '2012-01-01 00:00:00', '2017-04-09 00:00:00', '42401-3200731-6', 'House no, 1725/3435, Sarhad Road, Madina Colony, Baldia Town, Karachi.', 'Female', '1', 'Y', 'avatar-1.jpg', 'syaqoobshah@hotmail.com', 3, '2017-04-09 19:12:49', 'C', 0),
(6, '', 'FMC-3', 'SYEDAH ROMAISA', 'MUHAMMAD SAJID SHAH', '', '', '03170215022', '', '', '', '2011-10-22 00:00:00', '2017-04-09 00:00:00', '42401-7695220-3', 'House no, 1730/201, Street 8, Sarhad Muhallah, Rasheedabad, Karachi.', 'Female', '1', 'Y', 'avatar-1.jpg', 'Sajid.shah3732@gmail.com', 3, '2017-04-09 19:32:52', 'C', 0),
(7, '', 'FMC-3', 'SYED SUHAAM SHAH', 'MUHAMMAD SAJID SHAH', '', '', '03170215022', '', '', '', '2013-05-19 00:00:00', '2017-04-09 00:00:00', '42401-7695220-3', 'House no, 1730/201, Street 8, Sarhad Muhallah, Rasheedabad, Karachi.', 'Male', '1', 'Y', 'avatar-1.jpg', 'Sajid.shah3732@gmail.com', 3, '2017-04-09 19:35:35', 'C', 0),
(8, '0', 'FMC-6', 'Syedah Khadeeja', 'Muhammad Anwar Shah', NULL, NULL, '03422316390', NULL, NULL, NULL, '2005-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:42', 'C', 0),
(9, '0', 'FMC-5', 'Syedah Tayyaba', 'Syed Khadim Ali Shah', NULL, NULL, '03333243397', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Baldia Town,5 no.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:41', 'C', 0),
(10, '0', 'FMC-5', 'Syedah Noor E Adan', 'Syed Khadim Ali Shah', '', '', '03333243397', '', '', '', '2012-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Baldia Town,5 no.', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:48:35', 'C', 0),
(11, '0', 'FMC-6', 'Syedah Zunaira', 'Muhammad Anwar Shah', '', '', '03422316390', '', '', '', '2013-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:46:42', 'C', 0),
(12, '0', 'FMC-7', 'Syed Fahad Shah', 'Shehzad Shah', NULL, NULL, '03462413564', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:42', 'C', 0),
(13, '0', 'FMC-8', 'Syed Ayan Shah', 'Syed Ayaz Shah', NULL, NULL, '03471676157', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:42', 'C', 0),
(14, '0', 'FMC-9', 'Syed Saud Shah', 'Dawood Shah', NULL, NULL, '03422000351', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:42', 'C', 0),
(15, '0', 'FMC-10', 'Syedah Onaisa ', 'Ameen Shah', NULL, NULL, '03452170378', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:43', 'C', 0),
(16, '0', 'FMC-11', 'Aqsa Qasim', 'Muhammad Qasim ', NULL, NULL, '03432003183', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:43', 'C', 0),
(17, '0', 'FMC-12', 'Noor Fatima', 'Khwaj muhammad Abbas', NULL, NULL, '03432003183', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:43', 'C', 0),
(18, '0', 'FMC-13', 'Syedah Asma Shah', 'Syed Abid Shah', NULL, NULL, '03158361693', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:43', 'C', 0),
(19, '0', 'FMC-14', 'Muhammad Khizer ', 'Muhammad faheem', NULL, NULL, '03482072766', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:44', 'P', 0),
(20, '0', 'FMC-15', 'Sayyamullah', 'Waheed Gul', NULL, NULL, '03452962248', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:44', 'P', 0),
(21, '0', 'FMC-16', 'Muhammad Safeer Khan', 'Ashfaq Khan', NULL, NULL, '03022834618', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Sarhad Muhallah, Habib Masjid,Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:44', 'P', 0),
(22, '0', 'FMC-17', 'Marwah bibi', 'Abdul Raheem', '', '', '03333021286', '', '', '', '2013-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Sarhad Muhallah, Habib Masjid,Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:46:44', 'C', 0),
(23, '0', 'FMC-17', 'M Tayyab khan', 'Abdul Raheem', '', '', '03333021286', '', '', '', '2013-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Sarhad Muhallah, Habib Masjid,Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:46:44', 'C', 0),
(24, '0', 'FMC-18', 'Laiba bibi', 'Abdul Qayyum', '', '', '03432247790', '', '', '', '2013-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Sarhad Muhallah, Habib Masjid,Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:46:44', 'C', 0),
(25, '0', 'FMC-19', 'Gul Sher', 'Ali Sher', NULL, NULL, '03043823703', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Sarhad Muhallah, Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:44', 'P', 0),
(26, '0', 'FMC-20', 'Muhammad Aamir', 'Muhammad Aalam', NULL, NULL, '03012968106', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Sarhad Muhallah, Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:44', 'P', 0),
(27, '0', 'FMC-21', 'Abdul Wasay', 'Kamran', '', '', '03322752599', '', '', '', '2013-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:46:45', 'P', 0),
(28, '0', 'FMC-15', 'Manahil', 'Waheed Gul', NULL, NULL, '03452962248', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Sarhad Colony Abibabid', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:45', 'P', 0),
(29, '0', 'FMC-15', 'Hasnain Muawiya', 'Waheed Gul', NULL, NULL, '03452962248', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Sarhad Colony Abidabad', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:45', 'P', 0),
(30, '0', 'FMC-23', 'Fareeha', 'Abdul Majid', '', '', '03452421607', '', '', '', '2013-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Serhad Mohallah Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:46:45', 'P', 0),
(31, '0', 'FMC-24', 'Anas Azeem', 'Fazal Azeem', NULL, NULL, '03022087457', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:45', 'C', 0),
(32, '0', 'FMC-25', 'Shah Zain', 'Muhammad Mansoor', NULL, NULL, '03333325771', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:45', 'P', 0),
(33, '0', 'FMC-26', 'Wajeha', 'Muhammad Tariq', NULL, NULL, '03333325771', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:45', 'P', 0),
(34, '0', 'FMC-27', 'Subhan Khan', 'Tahir Khan', NULL, NULL, '03412218933', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:46', 'P', 0),
(35, '0', 'FMC-28', 'Mehar Ali', 'Syed Liaquat H.Shah', NULL, NULL, NULL, NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:46', 'P', 0),
(36, '0', 'FMC-29', 'Talha Abbasi', 'Manzoor Abbasi', NULL, NULL, '03333036904', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:46', 'P', 0),
(37, '0', 'FMC-30', 'Rizwan Shah', 'Raheem Shah', '', '', '03433220758', '', '', '', '2013-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:46:46', 'P', 0),
(38, '0', 'FMC-31', 'Manahil', 'Muhammad Imran', NULL, NULL, '03462895129', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:46:47', 'P', 0),
(39, '0', 'FMC-32', 'Muhammad Zaid', 'Shah Jahan', '', '', '03152686240', '', '', '', '2012-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Rasheedabad Colony', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:46:47', 'P', 0),
(40, '0', 'FMC-13', 'Syed JahanZaib Shah', 'Syed Abid Shah', NULL, NULL, '03158361693', NULL, NULL, NULL, '2012-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:48:36', 'C', 0),
(41, '0', 'FMC-17', 'M Shayan Khan', 'Abdul Raheem', '', '', '03333021286', '', '', '', '2012-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Sarhad Muhallah, Habib Masjid,Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:48:36', 'C', 0),
(42, '0', 'FMC-18', 'Saniya Bibi', 'Abdul Qayyum', '', '', '03432247790', '', '', '', '2012-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Sarhad Muhallah, Habib Masjid,Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:48:37', 'C', 0),
(43, '0', 'FMC-33', 'Syedah Khushnida', 'Umer Shah', NULL, NULL, NULL, NULL, NULL, NULL, '2012-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:48:37', 'C', 0),
(44, '0', 'FMC-12', 'Tamanna', 'Khuwaj Muhammad Abbas', '', '', '03432003183', '', '', '', '2012-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:48:37', 'C', 0),
(45, '0', 'FMC-35', 'Ahsan Ali', 'Muhammad Sajid', NULL, NULL, NULL, NULL, NULL, NULL, '2012-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:48:37', 'P', 0),
(46, '0', 'FMC-7', 'Syed Ammad Shah', 'Shehzad Shah', NULL, NULL, '03462413564', NULL, NULL, NULL, '2011-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:02', 'C', 0),
(47, '0', 'FMC-36', 'Syedah Adeeba', 'Syed Khalid Shah', NULL, NULL, '03471676157', NULL, NULL, NULL, '2011-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:02', 'C', 0),
(48, '0', 'FMC-9', 'Syedah Manahil', 'Dawood Shah', NULL, NULL, '03422000351', NULL, NULL, NULL, '2011-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:02', 'C', 0),
(49, '0', 'FMC-4', 'HASEENA KANWAL', 'LAL BAHADUR', '', '', '03472004413', '', '', '', '2009-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:49:03', 'C', 0),
(50, '0', 'FMC-18', 'Shoukat Ali', 'Abdul Qayyum', '', '', '03432247790', '', '', '', '2011-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Sarhad Muhallah, Habib Masjid,Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:49:03', 'C', 0),
(51, '0', 'FMC-37', 'Muhammad Shah', 'Shahjahan Khan', NULL, NULL, '03312199285', NULL, NULL, NULL, '2011-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:04', 'P', 0),
(52, '0', 'FMC-13', 'Bareera', 'Abdul Majid', '', '', '03452421607', '', '', '', '2011-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Serhad Muhallah Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:49:04', 'P', 0),
(53, '0', 'FMC-35', 'Areesha', 'Muhammad Sajid', NULL, NULL, NULL, NULL, NULL, NULL, '2011-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:05', 'P', 0),
(54, '0', 'FMC-38', 'Rehman shah', 'Kareem Shah', NULL, NULL, '03433220758', NULL, NULL, NULL, '2011-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:05', 'P', 0),
(55, '0', 'FMC-39', 'Muhammad Umair', 'Parvaiz', NULL, NULL, '03453950342', NULL, NULL, NULL, '2011-01-01 00:00:00', '2017-03-04 00:00:00', NULL, '', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:05', 'P', 0),
(56, '0', 'FMC-24', 'Zohra Azeem', 'Fazal Azeem', '', '', '03022087457', '', '', '', '2010-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:49:23', 'C', 0),
(57, '0', 'FMC-40', 'Syed Umair Shah', 'Syed Zubair Shah', NULL, NULL, '03482184630', NULL, NULL, NULL, '2010-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Sarhad Colony Abidabad', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:23', 'P', 0),
(58, '0', 'FMC-34', 'Ayesha ', 'Hussain Ali', '', '', '03442018081', '', '', '', '2010-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:49:24', 'C', 0),
(59, '0', 'FMC-41', 'Syedah Wajeha', 'Moosa Khan', NULL, NULL, '03452170378', NULL, NULL, NULL, '2009-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:36', 'C', 0),
(60, '0', 'FMC-11', 'Maryyam Qasim', 'Muhammad Qasim ', NULL, NULL, '03432003183', NULL, NULL, NULL, '2009-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:37', 'C', 0),
(61, '0', 'FMC-11', 'Asim Abbasi', 'Muhammad Qasim ', NULL, NULL, '03432003183', NULL, NULL, NULL, '2009-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:37', 'C', 0),
(62, '0', 'FMC-13', 'Syedah Isma Shah', 'Syed Abid Shah', NULL, NULL, '03158361693', NULL, NULL, NULL, '2009-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:37', 'C', 0),
(63, '0', 'FMC-17', 'Abdullah', 'Abdul Raheem', '', '', '03333021286', '', '', '', '2009-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Sarhad Muhallah, Habib Masjid,Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:49:38', 'C', 0),
(64, '0', 'FMC-33', 'Syedah Gul Lalie', 'Umer Shah', NULL, NULL, NULL, NULL, NULL, NULL, '2009-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:38', 'C', 0),
(65, '0', 'FMC-28', 'Ayesha Bibi', 'Syed Liaquat H.Shah', NULL, NULL, NULL, NULL, NULL, NULL, '2009-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:38', 'P', 0),
(66, '0', 'FMC-42', 'Muhammad Ismail', 'Muhammad Naeem', NULL, NULL, '03433351845', NULL, NULL, NULL, '2009-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:39', 'P', 0),
(67, '0', 'FMC-9', 'Syed Suleman Shah ', 'Dawood Shah', NULL, NULL, '03422000351', NULL, NULL, NULL, '2008-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:55', 'C', 0),
(68, '0', 'FMC-13', 'Syedah Bisma Shah', 'Syed Abid Shah', NULL, NULL, '03158361693', NULL, NULL, NULL, '2008-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:55', 'C', 0),
(69, '0', 'FMC-13', 'Syed Zohaib Shah', 'Syed Abid Shah', NULL, NULL, '03158361693', NULL, NULL, NULL, '2008-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:55', 'C', 0),
(70, '0', 'FMC-17', 'Muhammad nasir khan', 'Abdul Raheem', '', '', '03333021286', '', '', '', '2008-01-01 00:00:00', '2017-03-04 00:00:00', '', 'Sarhad Muhallah, Habib Masjid,Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-13 18:49:56', 'C', 0),
(71, '0', 'FMC-43', 'Shenella', 'Muhammad Ali', NULL, NULL, '03332362260', NULL, NULL, NULL, '2008-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:49:56', 'P', 0),
(72, '0', 'FMC-44', 'Syedah Arfa', 'Ajab Khan', NULL, NULL, '03422000351', NULL, NULL, NULL, '2007-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:10', 'C', 0),
(73, '0', 'FMC-41', 'Syedah Huma', 'Moosa Khan', NULL, NULL, '03452170378', NULL, NULL, NULL, '2007-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad.', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:11', 'C', 0),
(74, '0', 'FMC-24', 'Iqra Azeem', 'Fazal Azeem', NULL, NULL, '03022087457', NULL, NULL, NULL, '2007-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:11', 'C', 0),
(75, '0', 'FMC-42', 'Muhammad Ibraheem', 'Muhammad Naeem', NULL, NULL, '03433351845', NULL, NULL, NULL, '2007-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:12', 'P', 0),
(76, '0', 'FMC-44', 'Syed Abdul Wahid Shah', 'Ajab Khan', NULL, NULL, '03422000351', NULL, NULL, NULL, '2006-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:26', 'C', 0),
(77, '0', 'FMC-9', 'Syedah Ayesha ', 'Dawood Shah', NULL, NULL, '03422000351', NULL, NULL, NULL, '2006-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:26', 'C', 0),
(78, '0', 'FMC-9', 'Syeda Fatima', 'Dawood Shah', NULL, NULL, '03422000351', NULL, NULL, NULL, '2006-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:27', 'C', 0),
(79, '0', 'FMC-30', 'Farooq Shah', 'Raheem Shah', NULL, NULL, '03433220758', NULL, NULL, NULL, '2006-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:27', 'P', 0),
(80, '0', 'FMC-42', 'Kanwal Naeem', 'Muhammad Naeem', NULL, NULL, '03433351845', NULL, NULL, NULL, '2005-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:42', 'P', 0),
(81, '0', 'FMC-45', 'Syedah Nadia', 'Syed Naseem Shah', NULL, NULL, '03432003571', NULL, NULL, NULL, '2005-01-01 00:00:00', '2017-03-04 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-13 18:50:42', 'C', 0),
(82, '0', 'FMC-18', 'Abdul Samad', 'Abdul Qayyum', '', '', '03432247790', '', '', '', '2013-01-01 00:00:00', '2017-04-03 00:00:00', '', 'Rasheedabad Colony', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-16 18:04:48', 'P', 0),
(83, '0', 'FMC-34', 'Maaz', 'Hussain Ali', '', '', '03442018081', '', '', '', '2013-01-01 00:00:00', '2017-04-03 00:00:00', '', 'Rasheedabad Colony', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-16 18:04:48', 'C', 0),
(84, '0', 'FMC-34', 'Zobia', 'Muhammad Ismail', '', '', '03332365496', '', '', '', '2013-01-01 00:00:00', '2017-04-03 00:00:00', '', 'Rasheedabad Colony', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-16 18:04:49', 'C', 0),
(85, '0', 'FMC-34', 'Husna', 'Noor Saleem', '', '', '03458001102', '', '', '', '2013-01-01 00:00:00', '2017-04-03 00:00:00', '', 'Rasheedabad Colony', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-16 18:04:49', 'C', 0),
(86, '0', 'FMC-46', 'Muhammad Huzaifa', 'Muhammad Fayaz', NULL, NULL, '03102904250', NULL, NULL, NULL, '2013-01-01 00:00:00', '2017-04-03 00:00:00', NULL, 'Rasheedabad Colony', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-16 18:04:49', 'P', 0),
(87, '0', 'FMC-34', 'Maleeha', 'Muhammad Ismail', '', '', '03332365496', '', '', '', '2012-01-01 00:00:00', '2017-04-03 00:00:00', '', 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-16 18:05:11', 'C', 0),
(88, '0', 'FMC-47', 'Zainab', 'Shaad Ali', '', '', '03323159062', '', '', '', '2012-01-01 00:00:00', '2017-04-03 00:00:00', '', 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-16 18:05:11', 'P', 0),
(89, '0', 'FMC-47', 'Muhammad Ayan', 'Shaad Ali', '', '', '03323159062', '', '', '', '2012-01-01 00:00:00', '2017-04-03 00:00:00', '', 'Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-16 18:05:12', 'P', 0),
(90, '', 'FMC-48', 'Muhammad Raees Ameer', 'Ameer Sultan', NULL, NULL, '03353408405', NULL, NULL, NULL, '2011-01-01 00:00:00', '2017-04-03 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Male', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-16 18:05:43', 'P', 0),
(91, '0', 'FMC-18', 'Ayesha', 'Abdul Qayyum', '', '', '03432247790', '', '', '', '2010-01-01 00:00:00', '2017-04-03 00:00:00', '', 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-16 18:09:52', 'P', 0),
(92, '0', 'FMC-3', 'Syedah Raima ', 'Javaid Shah', NULL, NULL, '03422000351', NULL, NULL, NULL, '2010-01-01 00:00:00', '2017-04-03 00:00:00', NULL, 'Rasheedabad', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-16 18:09:52', 'P', 0),
(93, '0', 'FMC-50', 'Laiba', 'Ali Haider', NULL, NULL, '03453950443', NULL, NULL, NULL, '2006-01-01 00:00:00', '2017-04-03 00:00:00', NULL, 'Habibabad Rasheedabad Col', 'Female', '1', 'Y', 'avatar-1.jpg', NULL, 3, '2017-04-16 18:07:09', 'C', 0),
(94, '', 'FMC-5', 'Syed Asad Shah', 'Muhammad Anwar Shah', '', '', '03422316390', '', '', '', '2006-01-01 00:00:00', '2017-04-17 00:00:00', '', 'Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-17 02:41:58', 'C', 0),
(95, '', 'FMC-51', 'Zahoor Ahmad', 'Ghulam Khan', 'Mohsin Khan', '', '03440097626', '', '', '', '1970-01-01 05:00:00', '2017-04-18 00:00:00', '', 'Abidabad.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-18 17:13:33', 'P', 0),
(96, '', 'FMC-51', 'Mehmood Ahmad', 'Ghulam Khan', 'Mohsin Khan', '', '03440097626', '', '', '', '1970-01-01 05:00:00', '2017-04-18 00:00:00', '', 'Abidabad.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-18 17:22:05', 'P', 0),
(97, '', 'FMC-51', 'Maaz Ahmad', 'Mohsin Khan', '', '', '03440097626', '', '', '', '1970-01-01 05:00:00', '2017-04-18 00:00:00', '', 'Abidabad.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-18 17:24:09', 'P', 0),
(98, '', 'FMC-52', 'Zarnain Khan', 'Muhammad Hayyat Khan', '', '', '03151049622', '03333893123', '', '', '2010-04-05 00:00:00', '2017-04-19 00:00:00', '', 'Rasheedabad Habibabad Baldia Town', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-19 14:36:22', 'P', 0),
(99, '', 'FMC-7', 'Zarnain Khan', 'Hayyat Khan', '', '', '03222835753', '', '', '', '1970-01-01 05:00:00', '2017-04-19 00:00:00', '', '', 'Male', '1', 'N', 'avatar-1.jpg', '', 3, '2017-04-19 14:37:41', 'P', 0),
(100, '', 'FMC-53', 'Saniya BiBi', 'Iqbal Shah', '', '', '03456045732', '', '', '', '2011-04-14 00:00:00', '2017-04-24 00:00:00', '13504-6807249-1', 'Sarhad Muhallah No-3, Rasheedabad, Baldia Tow, Karachi.', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-24 22:00:24', 'C', 0),
(101, '', 'FMC-FMC-53', 'Syed Hassan Shah', 'Iqbal Shah', '', '', '03456045732', '', '', '', '2008-10-23 00:00:00', '2017-04-24 00:00:00', '13504-6807249-1', 'Sarhad Muhallah No-3, Rasheedabad, Baldia Tow, Karachi.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-24 22:04:42', 'C', 0),
(102, '', 'FMC-54', 'Salaar Khan', 'Adeel Khan', '', '', '03482321324', '', '', '', '2014-01-01 00:00:00', '2017-04-24 00:00:00', '', 'Rasheedabad,', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-24 22:25:13', 'P', 0),
(103, '', 'FMC-55', 'LAIBA AYOOB', 'MUHAMMAD AYOOB (LATE)', '', 'NASEEM AYOOB', '03452823753', '03150823497', '', '', '2002-10-31 00:00:00', '2017-04-25 00:00:00', '42401-0337119-8', 'Sarhad Muhallah, Rasheedabad, Baldia Town, Karachi.', 'Female', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-25 11:22:06', 'C', 0),
(104, '', 'FMC-56', 'Yasir', 'Muhammad Shahid', '', '', '03451245325', '', '', '', '2013-01-01 00:00:00', '2017-04-25 00:00:00', '', 'Rasheedabad.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-25 12:49:06', 'P', 0),
(105, '', 'FMC-57', 'Muhammad Hammad', 'Umer Gull', '', 'Naheed', '03333245567', '', '', '', '2012-08-15 00:00:00', '2017-04-27 00:00:00', '42401-8171644-9', 'House No C-155, Muhallah Habibabad, Rasheedabad Colony,Baldia Town, Karachi.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-27 08:27:39', 'P', 0),
(106, '', 'FMC-58', 'Shayan', 'Ahmad', '', '', '03242231369', '', '', '', '2013-01-01 00:00:00', '2017-04-27 00:00:00', '', 'Sarhad Muhallah, Rasheedabad, Baldia Town, Karachi.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-27 13:40:15', 'P', 0),
(107, '', 'FMC-58', 'Ayan', 'Ahmad', '', '', '03242231369', '', '', '', '2011-01-01 00:00:00', '2017-04-27 00:00:00', '', 'Sarhad Muhallah, Rasheedabad, Baldia Town, Karachi.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-27 13:55:23', 'P', 0),
(108, '', 'FMC-15', 'abc', 'xyz', '', '', '03453956174', '', '', '', '2009-01-01 00:00:00', '2017-04-28 00:00:00', '', 'address.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-28 17:44:05', 'P', 0),
(109, '', 'FMC-16', 'xyz', 'abc', '', '', '03112000984', '', '', '', '2009-01-01 00:00:00', '2017-04-28 00:00:00', '', 'address.', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-04-28 17:45:45', 'P', 0),
(110, '', 'FMC-17', 'Rayyan Khan', 'Behram Khan', 'Behram Khan', '', '03412469488', '', '', '', '2017-05-01 00:00:00', '2017-05-03 00:00:00', '42401-1808287-9', 'Habibabad Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-05-03 11:16:40', 'P', 0),
(111, '', 'FMC-18', 'nadeem', 'kareem', '', '', '923453956174', '', '', '', '2005-01-01 00:00:00', '2017-05-13 00:00:00', '42401-3200731-5', 'Rasheedabad', 'Male', '1', 'Y', 'avatar-1.jpg', '', 3, '2017-05-13 12:44:28', 'P', 0),
(112, '', 'FMC-19', 'qayyum shah', 'ahmed shah', '', '', '', '', '', '', '1970-01-01 05:00:00', '2017-07-30 00:00:00', '', '', 'Male', '1', 'Y', 'avatar-1.jpg', '', 5, '2017-07-30 12:23:42', 'P', 0);

-- --------------------------------------------------------

--
-- Table structure for table `remarks_for_students`
--

CREATE TABLE `remarks_for_students` (
  `id_remarks_for_students` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `Attitude` decimal(10,2) DEFAULT '0.00',
  `Communicationskills` decimal(10,2) DEFAULT '0.00',
  `interestsandtalents` decimal(10,2) DEFAULT '0.00',
  `participation` decimal(10,2) DEFAULT '0.00',
  `timemanagement` decimal(10,2) DEFAULT '0.00',
  `workhabits` decimal(10,2) DEFAULT '0.00',
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `remarks_for_students`
--

INSERT INTO `remarks_for_students` (`id_remarks_for_students`, `registration_id`, `class_id`, `shift_id`, `Attitude`, `Communicationskills`, `interestsandtalents`, `participation`, `timemanagement`, `workhabits`, `date`) VALUES
(338, 2, 39, 1, '10.00', '30.00', '51.00', '33.00', '85.00', '66.00', '2017-03-22 00:00:00'),
(341, 4, 37, 1, '60.00', '60.00', '60.00', '60.00', '50.00', '50.00', '2017-03-22 00:00:00'),
(342, 5, 34, 1, '60.00', '40.00', '30.00', '50.00', '80.00', '50.00', '2017-03-28 00:00:00'),
(343, 1, 35, 1, '55.00', '70.00', '40.00', '10.00', '80.00', '70.00', '2017-04-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_roles`, `role`, `created_date`) VALUES
(1, 'Administrator', '2016-11-20 02:33:46'),
(2, 'Super User', '2016-12-12 13:11:49'),
(3, 'Normal User', '2017-03-10 08:54:01'),
(4, 'Parent', '2017-03-10 08:54:01'),
(5, 'Student', '2017-03-10 08:54:01'),
(6, 'Teacher', '2017-03-10 08:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `scheduler`
--

CREATE TABLE `scheduler` (
  `id_scheduler` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `scheduler`
--

INSERT INTO `scheduler` (`id_scheduler`, `staff_id`, `subject_id`, `class_id`, `start_time`, `end_time`) VALUES
(1, 2, 1, 35, '2017-05-07 08:00:00', '2017-05-07 09:00:00'),
(2, 4, 2, 34, '2017-05-07 08:00:00', '2017-05-07 09:00:00'),
(3, 5, 3, 34, '2017-05-07 08:00:00', '2017-05-07 09:00:00'),
(4, 1, 1, 34, '2017-06-06 08:00:00', '2017-06-06 09:05:00'),
(5, 3, 2, 34, '2017-05-07 08:00:00', '2017-05-07 09:00:00'),
(6, 2, 3, 34, '2017-06-06 09:15:00', '2017-06-06 10:15:00'),
(7, 1, 1, 34, '2017-06-17 09:15:00', '2017-06-17 10:15:00'),
(8, 3, 1, 37, '2017-06-17 09:15:00', '2017-06-17 10:15:00'),
(9, 4, 1, 38, '2017-06-17 09:15:00', '2017-06-17 10:15:00'),
(10, 5, 2, 41, '2017-06-17 09:15:00', '2017-06-17 10:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id_session` int(11) NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  `session_start_date` datetime DEFAULT NULL,
  `session_end_date` datetime DEFAULT NULL,
  `session_status` char(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id_session`, `session`, `session_start_date`, `session_end_date`, `session_status`, `created_on`, `created_by`) VALUES
(1, '2017-2018', '2017-04-01 00:00:00', '2018-03-31 00:00:00', 'Y', '2017-02-27 08:56:53', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id_shift` int(11) NOT NULL,
  `shift_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id_shift`, `shift_name`) VALUES
(1, 'Morning'),
(2, 'Afternoon'),
(3, 'Evening');

-- --------------------------------------------------------

--
-- Table structure for table `sms_log`
--

CREATE TABLE `sms_log` (
  `id_sms_log` int(11) NOT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `message` varchar(600) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `no_of_sms` int(11) DEFAULT NULL,
  `sms_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_log`
--

INSERT INTO `sms_log` (`id_sms_log`, `campus_id`, `mobile_number`, `message`, `code`, `status`, `no_of_sms`, `sms_date`) VALUES
(1, 1, '03452188682', 'Attention: SYED HASEEB SHAH  is absent from Institute today, please submit the cause of absent at institute office. Academy of Excellence.', '1 : Invalid Username', NULL, NULL, '2017-03-09 19:57:39'),
(2, 1, '03452188682', 'Attention: SYED HASEEB SHAH  is absent from Institute today, please submit the cause of absent at institute office. Academy of Excellence.', '1 : Invalid Username', NULL, NULL, '2017-03-09 19:58:42'),
(3, 1, '03452188682', 'Attention: SYED HASEEB SHAH  is absent from Institute today, please submit the cause of absent at institute office. Academy of Excellence.', 'OK ID:7', NULL, NULL, '2017-03-09 20:03:14'),
(4, 1, '03453956174', 'Attention: SYED HASEEB SHAH  is absent from school today, please submit the cause of absent at school office. The Sky Foundation School.', 'OK ID:8', NULL, NULL, '2017-03-09 20:04:57'),
(5, 1, '03452188682', 'Attention: SYED HASEEB SHAH  is absent from Institute today, please submit the cause of absent at institute office.NEED INSTITUTE', '2 : Please Type User', NULL, NULL, '2017-03-09 20:37:35'),
(6, 1, '03452188682', 'Attention: SYED HASEEB SHAH  is absent from Institute today, please submit the cause of absent at institute office.The Sky Foundation School', 'OK ID:9', NULL, NULL, '2017-03-09 20:49:52'),
(7, 1, '03453956174', 'TSF GREETINGS.', 'OK ID:12', NULL, NULL, '2017-03-10 12:38:35'),
(8, 1, '03158361693', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171242', NULL, NULL, '2017-03-27 04:11:46'),
(9, 1, '03312199285', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171243', NULL, NULL, '2017-03-27 04:12:24'),
(10, 1, '03453956174', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171244', NULL, NULL, '2017-03-27 04:13:25'),
(11, 1, '03332365496', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171245', NULL, NULL, '2017-03-27 04:14:40'),
(12, 1, '03222292530', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171246', NULL, NULL, '2017-03-27 04:14:55'),
(13, 1, '03112580985', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171247', NULL, NULL, '2017-03-27 04:15:13'),
(14, 1, '03451276947', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171248', NULL, NULL, '2017-03-27 04:16:45'),
(15, 1, '03333036904', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171249', NULL, NULL, '2017-03-27 04:17:19'),
(16, 1, '03483686158', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171250', NULL, NULL, '2017-03-27 04:17:45'),
(17, 1, '03152686240', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171251', NULL, NULL, '2017-03-27 04:17:58'),
(18, 1, '03432003183', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171252', NULL, NULL, '2017-03-27 04:18:28'),
(19, 1, '03482323839', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171253', NULL, NULL, '2017-03-27 04:18:41'),
(20, 1, '03120222387', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171254', NULL, NULL, '2017-03-27 04:18:52'),
(21, 1, '03452962248', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171255', NULL, NULL, '2017-03-27 04:19:09'),
(22, 1, '03322173085', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171256', NULL, NULL, '2017-03-27 04:19:19'),
(23, 1, '03452771763', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171257', NULL, NULL, '2017-03-27 04:19:31'),
(24, 1, '03126044507', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171258', NULL, NULL, '2017-03-27 04:19:41'),
(25, 1, '03112374986', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171259', NULL, NULL, '2017-03-27 04:19:53'),
(26, 1, '03452955675', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171260', NULL, NULL, '2017-03-27 04:20:02'),
(27, 1, '03453359592', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171261', NULL, NULL, '2017-03-27 04:20:17'),
(28, 1, '034229014203', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', '7 : Invalid Recepien', NULL, NULL, '2017-03-27 04:20:26'),
(29, 1, '03363480046', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171262', NULL, NULL, '2017-03-27 04:20:39'),
(30, 1, '03152106907', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171263', NULL, NULL, '2017-03-27 04:20:52'),
(31, 1, '03491264915', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171264', NULL, NULL, '2017-03-27 04:21:04'),
(32, 1, '03152063048', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171265', NULL, NULL, '2017-03-27 04:21:23'),
(33, 1, '03058093090', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171266', NULL, NULL, '2017-03-27 04:21:32'),
(34, 1, '03353721250', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171358', NULL, NULL, '2017-03-28 12:08:51'),
(35, 1, '03012968106', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that your child Registration/Admission has been confirmed.\nRegistration Fee = 500\nMonthly Fee (April) = 900\nSum of Rs.1400 received.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171359', NULL, NULL, '2017-03-28 12:37:24'),
(36, 1, '03043823703', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that your child Registration/Admission has been confirmed.\nRegistration Fee = 500\nMonthly Fee (April) = 900\nSum of Rs.1400 received.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171360', NULL, NULL, '2017-03-28 12:43:30'),
(37, 1, '03422000351', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,(Dummy)\n\nThank you for visiting the school.\nThis is to inform you that your child Registration/Admission has been confirmed.\nRegistration Fee = 500\nMonthly Fee (April) = 900\nSum of Rs.1400 received.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171361', NULL, NULL, '2017-03-28 12:45:23'),
(38, 1, '03432247790', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171362', NULL, NULL, '2017-03-28 12:47:17'),
(39, 1, '03333021286', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171363', NULL, NULL, '2017-03-28 12:47:50'),
(40, 1, '03022834618', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171364', NULL, NULL, '2017-03-28 12:48:20'),
(41, 1, '03452962248', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that your child Registration/Admission has been confirmed.\nRegistration Fee = 500\nMonthly Fee (April) = 900\nSum of Rs.1400 received.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171365', NULL, NULL, '2017-03-28 12:49:27'),
(42, 1, '03482072766', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that your child Registration has been confirmed.\nRegistration Fee = 500\nSum of Rs.500 received.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171366', NULL, NULL, '2017-03-28 12:50:24'),
(43, 1, '03152686240', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that your child Registration has been confirmed.\nRegistration Fee = 500\nSum of Rs.500 received.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171367', NULL, NULL, '2017-03-28 12:51:00'),
(44, 1, '03473577479', 'The SKY Foundation Schooling System.\nTODAY A READER, TOMORROW A LEADER.\n\nDear Parents,\n\nThank you for visiting the school.\nThis is to inform you that New Education session will be started from 1st April,2017.\nKindly confirm the registration/admission of your child at your earliest.\nThanks for your interest in TSF School.\n\nAdd: Plot no 1730/2411,Habibabad,Rasheedabad,Near Zahir Shah Cloth House.\nPh: 0317-0215022, 0347-2004413.', 'OK ID:171368', NULL, NULL, '2017-03-28 12:52:04'),
(45, 1, '03453956174', 'Thank you  for fees submission.\r\nInvoice# :170327\r\nGrand Total :\r\nRecieved Amount :.00\r\nReturned Amount :\r\n', 'OK ID:171369', NULL, NULL, '2017-03-28 12:59:31'),
(46, 1, '03453956174', 'Thank you  for fees submission.\r\nInvoice# :170328\r\nGrand Total :2900.00\r\nRecieved Amount :2900.00\r\nReturned Amount :0\r\n', 'OK ID:171371', NULL, NULL, '2017-03-28 17:16:22'),
(47, 1, '03453956174', 'Thank you  for fees submission.\r\nInvoice# :170330\r\nGrand Total :800.00\r\nRecieved Amount :800.00\r\nReturned Amount :0\r\n', 'OK ID:171372', NULL, NULL, '2017-03-28 17:20:37'),
(48, 1, '03453956174', 'Thank you  for fees submission.\r\nInvoice# :170331\r\nGrand Total :200.00\r\nRecieved Amount :200.00\r\nReturned Amount :0\r\n', 'OK ID:171373', NULL, NULL, '2017-03-28 17:23:32'),
(49, 1, '03170215022', 'Thank You so much for visit The SKY Foundation Schooling System for Your Child Better Future.', 'OK ID:171377', NULL, NULL, '2017-03-29 07:57:33'),
(50, 1, '03332362260', 'Thank you so much to visit The SKY Foundation Schooling System for Your Child Better Future. ', 'OK ID:171378', NULL, NULL, '2017-03-29 08:01:31'),
(51, 1, '03222835753', 'Thank you  for fees submission.\r\nInvoice# :170332\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', 'OK ID:171453', NULL, NULL, '2017-03-29 12:10:07'),
(52, 1, '03453956174', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171460', NULL, NULL, '2017-03-29 13:09:40'),
(53, 1, '03158361693', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171461', NULL, NULL, '2017-03-29 13:10:44'),
(54, 1, '03332365496', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171462', NULL, NULL, '2017-03-29 13:11:07'),
(55, 1, '03222292530', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171463', NULL, NULL, '2017-03-29 13:11:21'),
(56, 1, '03112580985', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171464', NULL, NULL, '2017-03-29 13:11:30'),
(57, 1, '03451276947', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171465', NULL, NULL, '2017-03-29 13:11:42'),
(58, 1, '03333036904', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171466', NULL, NULL, '2017-03-29 13:11:50'),
(59, 1, '03483686158', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171467', NULL, NULL, '2017-03-29 13:18:34'),
(60, 1, '03152686240', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171468', NULL, NULL, '2017-03-29 13:18:45'),
(61, 1, '03432003183', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171469', NULL, NULL, '2017-03-29 13:18:58'),
(62, 1, '03482323839', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171470', NULL, NULL, '2017-03-29 13:19:06'),
(63, 1, '03120222387', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171471', NULL, NULL, '2017-03-29 13:19:25'),
(64, 1, '03452962248', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171472', NULL, NULL, '2017-03-29 13:19:31'),
(65, 1, '03322173085', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171473', NULL, NULL, '2017-03-29 13:19:39'),
(66, 1, '03452771763', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171474', NULL, NULL, '2017-03-29 13:19:51'),
(67, 1, '03126044507', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171475', NULL, NULL, '2017-03-29 13:19:59'),
(68, 1, '03112374986', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171476', NULL, NULL, '2017-03-29 13:20:08'),
(69, 1, '03453359592', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171477', NULL, NULL, '2017-03-29 13:20:21'),
(70, 1, '034229014203', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', '7 : Invalid Recepien', NULL, NULL, '2017-03-29 13:20:30'),
(71, 1, '03363480046', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171478', NULL, NULL, '2017-03-29 13:20:38'),
(72, 1, '03152106907', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171479', NULL, NULL, '2017-03-29 13:20:46'),
(73, 1, '03491264915', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171480', NULL, NULL, '2017-03-29 13:20:55'),
(74, 1, '03152063048', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171481', NULL, NULL, '2017-03-29 13:21:06'),
(75, 1, '03058093090', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171482', NULL, NULL, '2017-03-29 13:21:14'),
(76, 1, '03353721250', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171483', NULL, NULL, '2017-03-29 13:21:23'),
(77, 1, '03012968106', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171484', NULL, NULL, '2017-03-29 13:21:31'),
(78, 1, '03432247790', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171485', NULL, NULL, '2017-03-29 13:21:40'),
(79, 1, '03333021286', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171486', NULL, NULL, '2017-03-29 13:21:46'),
(80, 1, '03022834618', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171487', NULL, NULL, '2017-03-29 13:21:53'),
(81, 1, '03452962248', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171488', NULL, NULL, '2017-03-29 13:22:01'),
(82, 1, '03482072766', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171489', NULL, NULL, '2017-03-29 13:22:08'),
(83, 1, '03152686240', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171490', NULL, NULL, '2017-03-29 13:22:16'),
(84, 1, '03473577479', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171491', NULL, NULL, '2017-03-29 13:22:23'),
(85, 1, '03332362260', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.', 'OK ID:171492', NULL, NULL, '2017-03-29 13:22:33'),
(86, 1, '03022087457', 'The SKY Foundation Schooling System.\n(Today a Reader, Tomorrow a Leader)\n\nDear Parents,\n\nClasses will be started from Monday,3rd April,2017.\nPlease make sure your child\'s availability.\n\nAdd:Plot# 144/1730,Habibabad,Rasheedabad Colony.Kala Khan Chowk.\nPH:0317-0215022,0347-2004413.\n', 'OK ID:171495', NULL, NULL, '2017-03-29 13:27:15'),
(87, 1, '03453956174', 'Thank you  for fees submission.\r\nInvoice# :170433\r\nGrand Total :499.00\r\nRecieved Amount :499.00\r\nReturned Amount :0\r\n', 'OK ID:172809', NULL, NULL, '2017-04-03 12:56:29'),
(88, 1, '00315-8361693', 'Thank you  for fees submission.\r\nInvoice# :17041\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 18:46:10'),
(89, 1, '00315-8361693', 'Thank you  for fees submission.\r\nInvoice# :17042\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:03:57'),
(90, 1, '00315-8361693', 'Thank you  for fees submission.\r\nInvoice# :17043\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:24:23'),
(91, 1, '00315-8361693', 'Thank you  for fees submission.\r\nInvoice# :17044\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:25:37'),
(92, 1, '00315-8361693', 'Thank you  for fees submission.\r\nInvoice# :17045\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:32:10'),
(93, 1, '00315-2686240', 'Thank you  for fees submission.\r\nInvoice# :17046\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:33:22'),
(94, 1, '00348-2072766', 'Thank you  for fees submission.\r\nInvoice# :17049\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:34:04'),
(95, 1, '00345-2962248', 'Thank you  for fees submission.\r\nInvoice# :170410\r\nGrand Total :2360.00\r\nRecieved Amount :2360.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:35:16'),
(96, 1, '03043823703', 'Thank you  for fees submission.\r\nInvoice# :170413\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', 'OK ID:177298', NULL, NULL, '2017-04-17 19:36:13'),
(97, 1, '03012968106', 'Thank you  for fees submission.\r\nInvoice# :170416\r\nGrand Total :2380.00\r\nRecieved Amount :2380.00\r\nReturned Amount :0\r\n', 'OK ID:177299', NULL, NULL, '2017-04-17 19:37:26'),
(98, 1, '03353721250', 'Thank you  for fees submission.\r\nInvoice# :170419\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', 'OK ID:177300', NULL, NULL, '2017-04-17 19:38:10'),
(99, 1, '003332362260', 'Thank you  for fees submission.\r\nInvoice# :170422\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:38:46'),
(100, 1, '00331-2199285', 'Thank you  for fees submission.\r\nInvoice# :170423\r\nGrand Total :2500.00\r\nRecieved Amount :2500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:39:34'),
(101, 1, '00345-2962248', 'Thank you  for fees submission.\r\nInvoice# :170426\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:40:09'),
(102, 1, '00345-2962248', 'Thank you  for fees submission.\r\nInvoice# :170429\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:40:46'),
(103, 1, '00345-2477414', 'Thank you  for fees submission.\r\nInvoice# :170432\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:41:17'),
(104, 1, '00345-2477414', 'Thank you  for fees submission.\r\nInvoice# :170433\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:41:47'),
(105, 1, '00302-2087457', 'Thank you  for fees submission.\r\nInvoice# :170434\r\nGrand Total :910.00\r\nRecieved Amount :910.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:42:33'),
(106, 1, '00302-2087457', 'Thank you  for fees submission.\r\nInvoice# :170435\r\nGrand Total :2190.00\r\nRecieved Amount :2190.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:43:16'),
(107, 1, '00302-2087457', 'Thank you  for fees submission.\r\nInvoice# :170437\r\nGrand Total :1890.00\r\nRecieved Amount :1890.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:44:05'),
(108, 1, '00348-2184630', 'Thank you  for fees submission.\r\nInvoice# :170439\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:44:38'),
(109, 1, '00333-3325771', 'Thank you  for fees submission.\r\nInvoice# :170440\r\nGrand Total :1480.00\r\nRecieved Amount :1480.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:45:41'),
(110, 1, '00333-3325771', 'Thank you  for fees submission.\r\nInvoice# :170442\r\nGrand Total :1480.00\r\nRecieved Amount :1480.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:46:24'),
(111, 1, '00341-2218933', 'Thank you  for fees submission.\r\nInvoice# :170444\r\nGrand Total :1480.00\r\nRecieved Amount :.00\r\nReturned Amount :\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-17 19:46:59'),
(112, 1, '', 'Thank you  for fees submission.\r\nInvoice# :170446\r\nGrand Total :800.00\r\nRecieved Amount :800.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-04-17 19:48:44'),
(113, 1, '', 'Thank you  for fees submission.\r\nInvoice# :170447\r\nGrand Total :700.00\r\nRecieved Amount :700.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-04-17 19:49:23'),
(114, 1, '', 'Thank you  for fees submission.\r\nInvoice# :170448\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-04-18 04:02:01'),
(115, 1, '', 'Thank you  for fees submission.\r\nInvoice# :170449\r\nGrand Total :1780.00\r\nRecieved Amount :1780.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-04-18 04:05:53'),
(116, 1, '', 'Thank you  for fees submission.\r\nInvoice# :170451\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-04-18 04:08:56'),
(117, 1, '', 'Thank you  for fees submission.\r\nInvoice# :170452\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-04-18 04:09:26'),
(118, 1, '00333-3036904', 'Thank you  for fees submission.\r\nInvoice# :170453\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:35:12'),
(119, 1, '00343-3220758', 'Thank you  for fees submission.\r\nInvoice# :170456\r\nGrand Total :2500.00\r\nRecieved Amount :2500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:41:43'),
(120, 1, '00343-3220758', 'Thank you  for fees submission.\r\nInvoice# :170459\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:44:03'),
(121, 1, '00343-3220758', 'Thank you  for fees submission.\r\nInvoice# :170462\r\nGrand Total :3000.00\r\nRecieved Amount :3000.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:45:20'),
(122, 1, '00343-3351845', 'Thank you  for fees submission.\r\nInvoice# :170465\r\nGrand Total :3000.00\r\nRecieved Amount :3000.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:46:10'),
(123, 1, '00343-3351845', 'Thank you  for fees submission.\r\nInvoice# :170468\r\nGrand Total :2690.00\r\nRecieved Amount :2690.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:47:42'),
(124, 1, '00343-3351845', 'Thank you  for fees submission.\r\nInvoice# :170471\r\nGrand Total :3190.00\r\nRecieved Amount :3190.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:49:42'),
(125, 1, '00343-2003571', 'Thank you  for fees submission.\r\nInvoice# :170474\r\nGrand Total :1500.00\r\nRecieved Amount :1500.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:50:24'),
(126, 1, '00346-2895129', 'Thank you  for fees submission.\r\nInvoice# :170475\r\nGrand Total :1410.00\r\nRecieved Amount :1410.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:51:31'),
(127, 1, '00335-3408405', 'Thank you  for fees submission.\r\nInvoice# :170477\r\nGrand Total :2500.00\r\nRecieved Amount :.00\r\nReturned Amount :\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:52:26'),
(128, 1, '00310-2904250', 'Thank you  for fees submission.\r\nInvoice# :170480\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:53:42'),
(129, 1, '00340-8883742', 'Thank you  for fees submission.\r\nInvoice# :170483\r\nGrand Total :1890.00\r\nRecieved Amount :1890.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:55:12'),
(130, 1, '00340-8883742', 'Thank you  for fees submission.\r\nInvoice# :170485\r\nGrand Total :1890.00\r\nRecieved Amount :1890.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:56:47'),
(131, 1, '00340-8883742', 'Thank you  for fees submission.\r\nInvoice# :170487\r\nGrand Total :1890.00\r\nRecieved Amount :1890.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:57:27'),
(132, 1, '00340-8883742', 'Thank you  for fees submission.\r\nInvoice# :170489\r\nGrand Total :1890.00\r\nRecieved Amount :1890.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 05:58:01'),
(133, 1, '', 'Thank you  for fees submission.\r\nInvoice# :170491\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-04-18 05:58:58'),
(134, 1, '', 'Thank you  for fees submission.\r\nInvoice# :170494\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-04-18 05:59:26'),
(135, 1, '003453956174', 'Thank you  for fees submission.\r\nInvoice# :170497\r\nGrand Total :20.00\r\nRecieved Amount :20.00\r\nReturned Amount :0\r\n', '7 : Invalid Recepien', NULL, NULL, '2017-04-18 11:51:29'),
(136, 1, '03453956174', 'Thank you  for fees submission.\r\nInvoice# :170498\r\nGrand Total :20.00\r\nRecieved Amount :20.00\r\nReturned Amount :0\r\n', 'OK ID:177372', NULL, NULL, '2017-04-18 11:53:55'),
(137, 1, '03343488446', 'Thank you  for fees submission.\r\nInvoice# :170499\r\nGrand Total :1410.00\r\nRecieved Amount :1410.00\r\nReturned Amount :0\r\n', 'OK ID:177375', NULL, NULL, '2017-04-18 12:29:41'),
(138, 1, '03343488446', 'Thank you  for fees submission.\r\nInvoice# :1704101\r\nGrand Total :1410.00\r\nRecieved Amount :1410.00\r\nReturned Amount :0\r\n', 'OK ID:177376', NULL, NULL, '2017-04-18 12:30:25'),
(139, 1, '03343488446', 'Thank you  for fees submission.\r\nInvoice# :1704103\r\nGrand Total :1410.00\r\nRecieved Amount :1410.00\r\nReturned Amount :0\r\n', 'OK ID:177377', NULL, NULL, '2017-04-18 12:30:54'),
(140, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704105\r\nGrand Total :810.00\r\nRecieved Amount :810.00\r\nReturned Amount :0\r\n', 'OK ID:177382', NULL, NULL, '2017-04-18 15:21:13'),
(141, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704106\r\nGrand Total :810.00\r\nRecieved Amount :810.00\r\nReturned Amount :0\r\n', 'OK ID:177383', NULL, NULL, '2017-04-18 15:21:53'),
(142, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704107\r\nGrand Total :810.00\r\nRecieved Amount :810.00\r\nReturned Amount :0\r\n', 'OK ID:177384', NULL, NULL, '2017-04-18 15:22:50'),
(143, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704108\r\nGrand Total :810.00\r\nRecieved Amount :810.00\r\nReturned Amount :0\r\n', 'OK ID:177385', NULL, NULL, '2017-04-18 15:23:27'),
(144, 1, '03170215022', 'Thank you  for fees submission.\r\nInvoice# :1704109\r\nGrand Total :10.00\r\nRecieved Amount :10.00\r\nReturned Amount :0\r\n', 'OK ID:177386', NULL, NULL, '2017-04-18 15:37:47'),
(145, 1, '03151049622', 'Thank you  for fees submission.\r\nInvoice# :1704110\r\nGrand Total :1500.00\r\nRecieved Amount :.00\r\nReturned Amount :\r\n', 'OK ID:177398', NULL, NULL, '2017-04-19 11:12:23'),
(146, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704113\r\nGrand Total :1280.00\r\nRecieved Amount :.00\r\nReturned Amount :\r\n', 'OK ID:177399', NULL, NULL, '2017-04-19 11:16:57'),
(147, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704114\r\nGrand Total :980.00\r\nRecieved Amount :980.00\r\nReturned Amount :0\r\n', 'OK ID:177401', NULL, NULL, '2017-04-19 11:18:37'),
(148, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704115\r\nGrand Total :1516.00\r\nRecieved Amount :1516.00\r\nReturned Amount :0\r\n', 'OK ID:177402', NULL, NULL, '2017-04-19 11:20:17'),
(149, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704116\r\nGrand Total :980.00\r\nRecieved Amount :980.00\r\nReturned Amount :0\r\n', 'OK ID:177403', NULL, NULL, '2017-04-19 11:21:23'),
(150, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1704117\r\nGrand Total :244.00\r\nRecieved Amount :244.00\r\nReturned Amount :0\r\n', 'OK ID:177404', NULL, NULL, '2017-04-19 11:22:36'),
(151, 1, '03022087457', 'Thank you  for fees submission.\r\nInvoice# :1704118\r\nGrand Total :1590.00\r\nRecieved Amount :1590.00\r\nReturned Amount :0\r\n', 'OK ID:177446', NULL, NULL, '2017-04-21 03:35:20'),
(152, 1, '03453950443', 'Thank you  for fees submission.\r\nInvoice# :1704119\r\nGrand Total :2200.00\r\nRecieved Amount :2200.00\r\nReturned Amount :0\r\n', 'OK ID:183313', NULL, NULL, '2017-04-24 16:32:37'),
(153, 1, '0333 3021286', 'Thank you  for fees submission.\r\nInvoice# :1704121\r\nGrand Total :1321.00\r\nRecieved Amount :1321.00\r\nReturned Amount :0\r\n', '\n\n\n<!DOCTYPE html>\n<', NULL, NULL, '2017-04-24 16:42:35'),
(154, 1, '0333 3021286', 'Thank you  for fees submission.\r\nInvoice# :1704122\r\nGrand Total :2180.00\r\nRecieved Amount :2180.00\r\nReturned Amount :0\r\n', '\n\n\n<!DOCTYPE html>\n<', NULL, NULL, '2017-04-24 16:47:30'),
(155, 1, '0333 3021286', 'Thank you  for fees submission.\r\nInvoice# :1704124\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', '\n\n\n<!DOCTYPE html>\n<', NULL, NULL, '2017-04-24 16:49:15'),
(156, 1, '0333 3021286', 'Thank you  for fees submission.\r\nInvoice# :1704126\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', '\n\n\n<!DOCTYPE html>\n<', NULL, NULL, '2017-04-24 16:49:53'),
(157, 1, '0333 3021286', 'Thank you  for fees submission.\r\nInvoice# :1704128\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', '\n\n\n<!DOCTYPE html>\n<', NULL, NULL, '2017-04-24 16:50:44'),
(158, 1, '0343 2247790', 'Thank you  for fees submission.\r\nInvoice# :1704130\r\nGrand Total :1090.00\r\nRecieved Amount :1090.00\r\nReturned Amount :0\r\n', '\n\n\n<!DOCTYPE html>\n<', NULL, NULL, '2017-04-24 16:51:20'),
(159, 1, '0343 2247790', 'Thank you  for fees submission.\r\nInvoice# :1704131\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', '\n\n\n<!DOCTYPE html>\n<', NULL, NULL, '2017-04-24 16:52:26'),
(160, 1, '0343 2247790', 'Thank you  for fees submission.\r\nInvoice# :1704133\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', '\n\n\n<!DOCTYPE html>\n<', NULL, NULL, '2017-04-24 16:53:01'),
(161, 1, '03456045732', 'Thank you  for fees submission.\r\nInvoice# :1704135\r\nGrand Total :1160.00\r\nRecieved Amount :1160.00\r\nReturned Amount :0\r\n', 'OK ID:183314', NULL, NULL, '2017-04-24 17:10:10'),
(162, 1, '03456045732', 'Thank you  for fees submission.\r\nInvoice# :1704137\r\nGrand Total :1220.00\r\nRecieved Amount :1220.00\r\nReturned Amount :0\r\n', 'OK ID:183315', NULL, NULL, '2017-04-24 17:10:43');
INSERT INTO `sms_log` (`id_sms_log`, `campus_id`, `mobile_number`, `message`, `code`, `status`, `no_of_sms`, `sms_date`) VALUES
(163, 1, '03482321324', 'Thank you  for fees submission.\r\nInvoice# :1704139\r\nGrand Total :1480.00\r\nRecieved Amount :1480.00\r\nReturned Amount :0\r\n', 'OK ID:183319', NULL, NULL, '2017-04-24 17:28:35'),
(164, 1, '03432003571', 'Thank you  for fees submission.\r\nInvoice# :1704141\r\nGrand Total :1180.00\r\nRecieved Amount :1180.00\r\nReturned Amount :0\r\n', 'OK ID:183320', NULL, NULL, '2017-04-24 17:35:09'),
(165, 1, '03452823753', 'Thank you  for fees submission.\r\nInvoice# :1704144\r\nGrand Total :2580.00\r\nRecieved Amount :2580.00\r\nReturned Amount :0\r\n', 'OK ID:183331', NULL, NULL, '2017-04-25 06:30:01'),
(166, 1, '03333243397', 'Attention: Syedah Tayyaba  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183339', NULL, NULL, '2017-04-25 07:06:15'),
(167, 1, '03158361693', 'Attention: Syedah Asma Shah  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183340', NULL, NULL, '2017-04-25 07:06:17'),
(168, 1, '03022834618', 'Attention: Muhammad Safeer Khan  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183341', NULL, NULL, '2017-04-25 07:06:18'),
(169, 1, '03452962248', 'Attention: Hasnain Muawiya  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183342', NULL, NULL, '2017-04-25 07:06:19'),
(170, 1, '03433220758', 'Attention: Rizwan Shah  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183343', NULL, NULL, '2017-04-25 07:06:20'),
(171, 1, '03408883742', 'Attention: Maaz  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183344', NULL, NULL, '2017-04-25 07:06:20'),
(172, 1, '03408883742', 'Attention: Zobia  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183345', NULL, NULL, '2017-04-25 07:06:21'),
(173, 1, '03158361693', 'Attention: Syed JahanZaib Shah  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183346', NULL, NULL, '2017-04-25 07:06:28'),
(174, 1, '03433220758', 'Attention: Rehman shah  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183347', NULL, NULL, '2017-04-25 07:06:34'),
(175, 1, '03453950443', 'Attention: Laiba  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183348', NULL, NULL, '2017-04-25 07:06:44'),
(176, 1, '03158361693', 'Attention: Syedah Bisma Shah  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183349', NULL, NULL, '2017-04-25 07:06:54'),
(177, 1, '03158361693', 'Attention: Syed Zohaib Shah  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183350', NULL, NULL, '2017-04-25 07:06:56'),
(178, 1, '03453956174', 'Respected parents,SYEDAH ZUNAIRA is present today. Attendance has been marked.', 'OK ID:183351', NULL, NULL, '2017-04-25 07:07:48'),
(179, 1, '03022087457', 'Respected parents,Zohra Azeem is present today. Attendance has been marked.', 'OK ID:183352', NULL, NULL, '2017-04-25 07:07:49'),
(180, 1, '03482184630', 'Respected parents,Syed Umair Shah is present today. Attendance has been marked.', 'OK ID:183353', NULL, NULL, '2017-04-25 07:07:50'),
(181, 1, '03408883742', 'Respected parents,Ayesha  is present today. Attendance has been marked.', 'OK ID:183354', NULL, NULL, '2017-04-25 07:07:50'),
(182, 1, '03432247790', 'Respected parents,Ayesha is present today. Attendance has been marked.', 'OK ID:183355', NULL, NULL, '2017-04-25 07:07:51'),
(183, 1, '03422000351', 'Respected parents,Syedah Raima  is present today. Attendance has been marked.', 'OK ID:183356', NULL, NULL, '2017-04-25 07:07:52'),
(184, 1, '03440097626', 'Respected parents,Zahoor Ahmad is present today. Attendance has been marked.', 'OK ID:183357', NULL, NULL, '2017-04-25 07:07:52'),
(185, 1, '03332261654', 'Respected parents,SYEDAH EMAAN is present today. Attendance has been marked.', 'OK ID:183358', NULL, NULL, '2017-04-25 07:07:59'),
(186, 1, '03452170378', 'Respected parents,Syedah Wajeha is present today. Attendance has been marked.', 'OK ID:183359', NULL, NULL, '2017-04-25 07:08:00'),
(187, 1, '03432003183', 'Respected parents,Maryyam Qasim is present today. Attendance has been marked.', 'OK ID:183360', NULL, NULL, '2017-04-25 07:08:01'),
(188, 1, '03432003183', 'Respected parents,Asim Abbasi is present today. Attendance has been marked.', 'OK ID:183361', NULL, NULL, '2017-04-25 07:08:02'),
(189, 1, '03333021286', 'Respected parents,Abdullah is present today. Attendance has been marked.', 'OK ID:183362', NULL, NULL, '2017-04-25 07:08:03'),
(190, 1, '03433351845', 'Respected parents,Muhammad Ismail is present today. Attendance has been marked.', 'OK ID:183363', NULL, NULL, '2017-04-25 07:08:04'),
(191, 1, '03453956174', 'Respected parents,SYEDAH MANAHIL is present today. Attendance has been marked.', 'OK ID:183364', NULL, NULL, '2017-04-25 07:08:09'),
(192, 1, '03422000351', 'Respected parents,Syed Suleman Shah  is present today. Attendance has been marked.', 'OK ID:183365', NULL, NULL, '2017-04-25 07:08:10'),
(193, 1, '03333021286', 'Respected parents,Muhammad nasir khan is present today. Attendance has been marked.', 'OK ID:183366', NULL, NULL, '2017-04-25 07:08:10'),
(194, 1, '03332362260', 'Respected parents,Shenella is present today. Attendance has been marked.', 'OK ID:183367', NULL, NULL, '2017-04-25 07:08:12'),
(195, 1, '03422000351', 'Respected parents,Syed Abdul Wahid Shah is present today. Attendance has been marked.', 'OK ID:183368', NULL, NULL, '2017-04-25 07:08:17'),
(196, 1, '03422000351', 'Respected parents,Syedah Ayesha  is present today. Attendance has been marked.', 'OK ID:183369', NULL, NULL, '2017-04-25 07:08:17'),
(197, 1, '03422000351', 'Respected parents,Syeda Fatima is present today. Attendance has been marked.', 'OK ID:183370', NULL, NULL, '2017-04-25 07:08:18'),
(198, 1, '03433220758', 'Respected parents,Farooq Shah is present today. Attendance has been marked.', 'OK ID:183371', NULL, NULL, '2017-04-25 07:08:19'),
(199, 1, '03422316390', 'Respected parents,Syed Asad Shah is present today. Attendance has been marked.', 'OK ID:183372', NULL, NULL, '2017-04-25 07:08:19'),
(200, 1, '03422316390', 'Respected parents,Syedah Khadeeja is present today. Attendance has been marked.', 'OK ID:183373', NULL, NULL, '2017-04-25 07:08:27'),
(201, 1, '03433351845', 'Respected parents,Kanwal Naeem is present today. Attendance has been marked.', 'OK ID:183374', NULL, NULL, '2017-04-25 07:08:27'),
(202, 1, '03432003571', 'Respected parents,Syedah Nadia is present today. Attendance has been marked.', 'OK ID:183375', NULL, NULL, '2017-04-25 07:08:28'),
(203, 1, '03462413564', 'Respected parents,Syed Ammad Shah is present today. Attendance has been marked.', 'OK ID:183376', NULL, NULL, '2017-04-25 07:08:35'),
(204, 1, '03471676157', 'Respected parents,Syedah Adeeba is present today. Attendance has been marked.', 'OK ID:183377', NULL, NULL, '2017-04-25 07:08:35'),
(205, 1, '03422000351', 'Respected parents,Syedah Manahil is present today. Attendance has been marked.', 'OK ID:183378', NULL, NULL, '2017-04-25 07:08:36'),
(206, 1, '03432247790', 'Respected parents,Shoukat Ali is present today. Attendance has been marked.', 'OK ID:183379', NULL, NULL, '2017-04-25 07:08:37'),
(207, 1, '03312199285', 'Respected parents,Muhammad Shah is present today. Attendance has been marked.', 'OK ID:183380', NULL, NULL, '2017-04-25 07:08:38'),
(208, 1, '03452477414', 'Respected parents,Bareera is present today. Attendance has been marked.', 'OK ID:183381', NULL, NULL, '2017-04-25 07:08:39'),
(209, 1, '03453950342', 'Respected parents,Muhammad Umair is present today. Attendance has been marked.', 'OK ID:183382', NULL, NULL, '2017-04-25 07:08:39'),
(210, 1, '03353408405', 'Respected parents,Muhammad Raees Ameer is present today. Attendance has been marked.', 'OK ID:183383', NULL, NULL, '2017-04-25 07:08:40'),
(211, 1, '03151049622', 'Respected parents,Zarnain Khan is present today. Attendance has been marked.', 'OK ID:183384', NULL, NULL, '2017-04-25 07:08:42'),
(212, 1, '03456045732', 'Respected parents,Syed Hassan Shah is present today. Attendance has been marked.', 'OK ID:183385', NULL, NULL, '2017-04-25 07:08:43'),
(213, 1, '03170215022', 'Respected parents,SYED SUHAAM SHAH is present today. Attendance has been marked.', 'OK ID:183386', NULL, NULL, '2017-04-25 07:08:48'),
(214, 1, '03422316390', 'Respected parents,Syedah Zunaira is present today. Attendance has been marked.', 'OK ID:183387', NULL, NULL, '2017-04-25 07:08:49'),
(215, 1, '03462413564', 'Respected parents,Syed Fahad Shah is present today. Attendance has been marked.', 'OK ID:183388', NULL, NULL, '2017-04-25 07:08:50'),
(216, 1, '03471676157', 'Respected parents,Syed Ayan Shah is present today. Attendance has been marked.', 'OK ID:183389', NULL, NULL, '2017-04-25 07:08:51'),
(217, 1, '03422000351', 'Respected parents,Syed Saud Shah is present today. Attendance has been marked.', 'OK ID:183390', NULL, NULL, '2017-04-25 07:08:52'),
(218, 1, '03452170378', 'Respected parents,Syedah Onaisa  is present today. Attendance has been marked.', 'OK ID:183391', NULL, NULL, '2017-04-25 07:08:53'),
(219, 1, '03432003183', 'Respected parents,Aqsa Qasim is present today. Attendance has been marked.', 'OK ID:183392', NULL, NULL, '2017-04-25 07:08:54'),
(220, 1, '03432003183', 'Respected parents,Noor Fatima is present today. Attendance has been marked.', 'OK ID:183393', NULL, NULL, '2017-04-25 07:08:54'),
(221, 1, '03482072766', 'Respected parents,Muhammad Khizer  is present today. Attendance has been marked.', 'OK ID:183394', NULL, NULL, '2017-04-25 07:08:55'),
(222, 1, '03452962248', 'Respected parents,Sayyamullah is present today. Attendance has been marked.', 'OK ID:183395', NULL, NULL, '2017-04-25 07:08:56'),
(223, 1, '03333021286', 'Respected parents,Marwah bibi is present today. Attendance has been marked.', 'OK ID:183396', NULL, NULL, '2017-04-25 07:08:57'),
(224, 1, '03333021286', 'Respected parents,M Tayyab khan is present today. Attendance has been marked.', 'OK ID:183397', NULL, NULL, '2017-04-25 07:08:58'),
(225, 1, '03432247790', 'Respected parents,Laiba bibi is present today. Attendance has been marked.', 'OK ID:183398', NULL, NULL, '2017-04-25 07:08:59'),
(226, 1, '03043823703', 'Respected parents,Gul Sher is present today. Attendance has been marked.', 'OK ID:183399', NULL, NULL, '2017-04-25 07:09:00'),
(227, 1, '03012968106', 'Respected parents,Muhammad Aamir is present today. Attendance has been marked.', 'OK ID:183400', NULL, NULL, '2017-04-25 07:09:00'),
(228, 1, '03353721250', 'Respected parents,Abdul Wasay is present today. Attendance has been marked.', 'OK ID:183401', NULL, NULL, '2017-04-25 07:09:01'),
(229, 1, '03452962248', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183402', NULL, NULL, '2017-04-25 07:09:02'),
(230, 1, '03452477414', 'Respected parents,Fareeha is present today. Attendance has been marked.', 'OK ID:183403', NULL, NULL, '2017-04-25 07:09:03'),
(231, 1, '03022087457', 'Respected parents,Anas Azeem is present today. Attendance has been marked.', 'OK ID:183404', NULL, NULL, '2017-04-25 07:09:04'),
(232, 1, '03333325771', 'Respected parents,Shah Zain is present today. Attendance has been marked.', 'OK ID:183405', NULL, NULL, '2017-04-25 07:09:06'),
(233, 1, '03333325771', 'Respected parents,Wajeha is present today. Attendance has been marked.', 'OK ID:183406', NULL, NULL, '2017-04-25 07:09:07'),
(234, 1, '03412218933', 'Respected parents,Subhan Khan is present today. Attendance has been marked.', 'OK ID:183407', NULL, NULL, '2017-04-25 07:09:09'),
(235, 1, '03333036904', 'Respected parents,Talha Abbasi is present today. Attendance has been marked.', 'OK ID:183408', NULL, NULL, '2017-04-25 07:09:09'),
(236, 1, '03462895129', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183409', NULL, NULL, '2017-04-25 07:09:10'),
(237, 1, '03152686240', 'Respected parents,Muhammad Zaid is present today. Attendance has been marked.', 'OK ID:183410', NULL, NULL, '2017-04-25 07:09:11'),
(238, 1, '03432247790', 'Respected parents,Abdul Samad is present today. Attendance has been marked.', 'OK ID:183411', NULL, NULL, '2017-04-25 07:09:12'),
(239, 1, '03408883742', 'Respected parents,Husna is present today. Attendance has been marked.', 'OK ID:183412', NULL, NULL, '2017-04-25 07:09:13'),
(240, 1, '03102904250', 'Respected parents,Muhammad Huzaifa is present today. Attendance has been marked.', 'OK ID:183413', NULL, NULL, '2017-04-25 07:09:14'),
(241, 1, '03440097626', 'Respected parents,Maaz Ahmad is present today. Attendance has been marked.', 'OK ID:183414', NULL, NULL, '2017-04-25 07:09:14'),
(242, 1, '03456045732', 'Respected parents,Saniya BiBi is present today. Attendance has been marked.', 'OK ID:183415', NULL, NULL, '2017-04-25 07:09:15'),
(243, 1, '03482321324', 'Respected parents,Salaar Khan is present today. Attendance has been marked.', 'OK ID:183416', NULL, NULL, '2017-04-25 07:09:16'),
(244, 1, '03170215022', 'Respected parents,SYED SUHAAM SHAH is present today. Attendance has been marked.', 'OK ID:183417', NULL, NULL, '2017-04-25 07:09:22'),
(245, 1, '03422316390', 'Respected parents,Syedah Zunaira is present today. Attendance has been marked.', 'OK ID:183418', NULL, NULL, '2017-04-25 07:09:23'),
(246, 1, '03462413564', 'Respected parents,Syed Fahad Shah is present today. Attendance has been marked.', 'OK ID:183419', NULL, NULL, '2017-04-25 07:09:24'),
(247, 1, '03471676157', 'Respected parents,Syed Ayan Shah is present today. Attendance has been marked.', 'OK ID:183420', NULL, NULL, '2017-04-25 07:09:25'),
(248, 1, '03422000351', 'Respected parents,Syed Saud Shah is present today. Attendance has been marked.', 'OK ID:183421', NULL, NULL, '2017-04-25 07:09:25'),
(249, 1, '03452170378', 'Respected parents,Syedah Onaisa  is present today. Attendance has been marked.', 'OK ID:183422', NULL, NULL, '2017-04-25 07:09:26'),
(250, 1, '03432003183', 'Respected parents,Aqsa Qasim is present today. Attendance has been marked.', 'OK ID:183423', NULL, NULL, '2017-04-25 07:09:27'),
(251, 1, '03432003183', 'Respected parents,Noor Fatima is present today. Attendance has been marked.', 'OK ID:183424', NULL, NULL, '2017-04-25 07:09:28'),
(252, 1, '03482072766', 'Respected parents,Muhammad Khizer  is present today. Attendance has been marked.', 'OK ID:183425', NULL, NULL, '2017-04-25 07:09:28'),
(253, 1, '03452962248', 'Respected parents,Sayyamullah is present today. Attendance has been marked.', 'OK ID:183426', NULL, NULL, '2017-04-25 07:09:29'),
(254, 1, '03333021286', 'Respected parents,Marwah bibi is present today. Attendance has been marked.', 'OK ID:183427', NULL, NULL, '2017-04-25 07:09:30'),
(255, 1, '03333021286', 'Respected parents,M Tayyab khan is present today. Attendance has been marked.', 'OK ID:183428', NULL, NULL, '2017-04-25 07:09:31'),
(256, 1, '03432247790', 'Respected parents,Laiba bibi is present today. Attendance has been marked.', 'OK ID:183429', NULL, NULL, '2017-04-25 07:09:31'),
(257, 1, '03043823703', 'Respected parents,Gul Sher is present today. Attendance has been marked.', 'OK ID:183430', NULL, NULL, '2017-04-25 07:09:32'),
(258, 1, '03012968106', 'Respected parents,Muhammad Aamir is present today. Attendance has been marked.', 'OK ID:183431', NULL, NULL, '2017-04-25 07:09:33'),
(259, 1, '03353721250', 'Respected parents,Abdul Wasay is present today. Attendance has been marked.', 'OK ID:183432', NULL, NULL, '2017-04-25 07:09:34'),
(260, 1, '03452962248', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183433', NULL, NULL, '2017-04-25 07:09:34'),
(261, 1, '03452477414', 'Respected parents,Fareeha is present today. Attendance has been marked.', 'OK ID:183434', NULL, NULL, '2017-04-25 07:09:35'),
(262, 1, '03022087457', 'Respected parents,Anas Azeem is present today. Attendance has been marked.', 'OK ID:183435', NULL, NULL, '2017-04-25 07:09:36'),
(263, 1, '03333325771', 'Respected parents,Shah Zain is present today. Attendance has been marked.', 'OK ID:183436', NULL, NULL, '2017-04-25 07:09:37'),
(264, 1, '03333325771', 'Respected parents,Wajeha is present today. Attendance has been marked.', 'OK ID:183437', NULL, NULL, '2017-04-25 07:09:37'),
(265, 1, '03412218933', 'Respected parents,Subhan Khan is present today. Attendance has been marked.', 'OK ID:183438', NULL, NULL, '2017-04-25 07:09:38'),
(266, 1, '03333036904', 'Respected parents,Talha Abbasi is present today. Attendance has been marked.', 'OK ID:183439', NULL, NULL, '2017-04-25 07:09:39'),
(267, 1, '03462895129', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183440', NULL, NULL, '2017-04-25 07:09:39'),
(268, 1, '03152686240', 'Respected parents,Muhammad Zaid is present today. Attendance has been marked.', 'OK ID:183441', NULL, NULL, '2017-04-25 07:09:40'),
(269, 1, '03432247790', 'Respected parents,Abdul Samad is present today. Attendance has been marked.', 'OK ID:183442', NULL, NULL, '2017-04-25 07:09:41'),
(270, 1, '03408883742', 'Respected parents,Husna is present today. Attendance has been marked.', 'OK ID:183443', NULL, NULL, '2017-04-25 07:09:42'),
(271, 1, '03102904250', 'Respected parents,Muhammad Huzaifa is present today. Attendance has been marked.', 'OK ID:183444', NULL, NULL, '2017-04-25 07:09:43'),
(272, 1, '03440097626', 'Respected parents,Maaz Ahmad is present today. Attendance has been marked.', 'OK ID:183445', NULL, NULL, '2017-04-25 07:09:43'),
(273, 1, '03456045732', 'Respected parents,Saniya BiBi is present today. Attendance has been marked.', 'OK ID:183446', NULL, NULL, '2017-04-25 07:09:44'),
(274, 1, '03482321324', 'Respected parents,Salaar Khan is present today. Attendance has been marked.', 'OK ID:183447', NULL, NULL, '2017-04-25 07:09:45'),
(275, 1, '03451245325', 'Thank you  for fees submission.\r\nInvoice# :1704146\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', 'OK ID:183450', NULL, NULL, '2017-04-25 07:53:19'),
(276, 1, '03472004413', 'Attention: HASEENA KANWAL  is absent from School today, please submit the cause of absent at office.', '10: Error! SMS Sendi', NULL, NULL, '2017-04-25 08:08:16'),
(277, 1, '03158361693', 'Attention: Syedah Isma Shah  is absent from School today, please submit the cause of absent at office.', 'OK ID:183451', NULL, NULL, '2017-04-25 08:08:18'),
(278, 1, '03472004413', 'Attention: HASEENA KANWAL  is absent from School today, please submit the cause of absent at office.', '10: Error! SMS Sendi', NULL, NULL, '2017-04-25 08:10:50'),
(279, 1, '03158361693', 'Attention: Syedah Isma Shah  is absent from School today, please submit the cause of absent at office.', 'OK ID:183452', NULL, NULL, '2017-04-25 08:10:52'),
(280, 1, '03170215022', 'Respected parents,SYED SUHAAM SHAH is present today. Attendance has been marked.', 'OK ID:183502', NULL, NULL, '2017-04-26 04:20:39'),
(281, 1, '03333243397', 'Respected parents,Syedah Tayyaba is present today. Attendance has been marked.', 'OK ID:183503', NULL, NULL, '2017-04-26 04:20:39'),
(282, 1, '03422316390', 'Respected parents,Syedah Zunaira is present today. Attendance has been marked.', 'OK ID:183504', NULL, NULL, '2017-04-26 04:20:42'),
(283, 1, '03462413564', 'Respected parents,Syed Fahad Shah is present today. Attendance has been marked.', 'OK ID:183505', NULL, NULL, '2017-04-26 04:20:50'),
(284, 1, '03471676157', 'Respected parents,Syed Ayan Shah is present today. Attendance has been marked.', 'OK ID:183506', NULL, NULL, '2017-04-26 04:20:55'),
(285, 1, '03422000351', 'Respected parents,Syed Saud Shah is present today. Attendance has been marked.', 'OK ID:183507', NULL, NULL, '2017-04-26 04:20:57'),
(286, 1, '03452170378', 'Respected parents,Syedah Onaisa  is present today. Attendance has been marked.', 'OK ID:183508', NULL, NULL, '2017-04-26 04:21:07'),
(287, 1, '03432003183', 'Respected parents,Aqsa Qasim is present today. Attendance has been marked.', 'OK ID:183509', NULL, NULL, '2017-04-26 04:21:12'),
(288, 1, '03432003183', 'Respected parents,Noor Fatima is present today. Attendance has been marked.', 'OK ID:183510', NULL, NULL, '2017-04-26 04:21:14'),
(289, 1, '03158361693', 'Respected parents,Syedah Asma Shah is present today. Attendance has been marked.', 'OK ID:183511', NULL, NULL, '2017-04-26 04:21:15'),
(290, 1, '03482072766', 'Respected parents,Muhammad Khizer  is present today. Attendance has been marked.', 'OK ID:183512', NULL, NULL, '2017-04-26 04:21:20'),
(291, 1, '03452962248', 'Respected parents,Sayyamullah is present today. Attendance has been marked.', 'OK ID:183513', NULL, NULL, '2017-04-26 04:21:22'),
(292, 1, '03022834618', 'Respected parents,Muhammad Safeer Khan is present today. Attendance has been marked.', 'OK ID:183514', NULL, NULL, '2017-04-26 04:21:23'),
(293, 1, '03333021286', 'Respected parents,Marwah bibi is present today. Attendance has been marked.', 'OK ID:183515', NULL, NULL, '2017-04-26 04:21:23'),
(294, 1, '03333021286', 'Respected parents,M Tayyab khan is present today. Attendance has been marked.', 'OK ID:183516', NULL, NULL, '2017-04-26 04:21:24'),
(295, 1, '03432247790', 'Respected parents,Laiba bibi is present today. Attendance has been marked.', 'OK ID:183517', NULL, NULL, '2017-04-26 04:21:27'),
(296, 1, '03043823703', 'Respected parents,Gul Sher is present today. Attendance has been marked.', 'OK ID:183518', NULL, NULL, '2017-04-26 04:21:29'),
(297, 1, '03012968106', 'Respected parents,Muhammad Aamir is present today. Attendance has been marked.', 'OK ID:183519', NULL, NULL, '2017-04-26 04:21:29'),
(298, 1, '03322752599', 'Respected parents,Abdul Wasay is present today. Attendance has been marked.', 'OK ID:183520', NULL, NULL, '2017-04-26 04:21:30'),
(299, 1, '03452962248', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183521', NULL, NULL, '2017-04-26 04:21:39'),
(300, 1, '03452962248', 'Respected parents,Hasnain Muawiya is present today. Attendance has been marked.', 'OK ID:183523', NULL, NULL, '2017-04-26 04:21:41'),
(301, 1, '03452477414', 'Respected parents,Fareeha is present today. Attendance has been marked.', 'OK ID:183525', NULL, NULL, '2017-04-26 04:21:50'),
(302, 1, '03022087457', 'Respected parents,Anas Azeem is present today. Attendance has been marked.', 'OK ID:183526', NULL, NULL, '2017-04-26 04:21:51'),
(303, 1, '03333325771', 'Respected parents,Shah Zain is present today. Attendance has been marked.', 'OK ID:183527', NULL, NULL, '2017-04-26 04:21:51'),
(304, 1, '03333325771', 'Respected parents,Wajeha is present today. Attendance has been marked.', 'OK ID:183528', NULL, NULL, '2017-04-26 04:21:52'),
(305, 1, '03412218933', 'Respected parents,Subhan Khan is present today. Attendance has been marked.', 'OK ID:183529', NULL, NULL, '2017-04-26 04:21:55'),
(306, 1, '03333036904', 'Respected parents,Talha Abbasi is present today. Attendance has been marked.', 'OK ID:183531', NULL, NULL, '2017-04-26 04:21:56'),
(307, 1, '03433220758', 'Respected parents,Rizwan Shah is present today. Attendance has been marked.', 'OK ID:183533', NULL, NULL, '2017-04-26 04:21:58'),
(308, 1, '03462895129', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183535', NULL, NULL, '2017-04-26 04:22:07'),
(309, 1, '03152686240', 'Respected parents,Muhammad Zaid is present today. Attendance has been marked.', 'OK ID:183536', NULL, NULL, '2017-04-26 04:22:09'),
(310, 1, '03432247790', 'Respected parents,Abdul Samad is present today. Attendance has been marked.', 'OK ID:183537', NULL, NULL, '2017-04-26 04:22:12'),
(311, 1, '03408883742', 'Respected parents,Maaz is present today. Attendance has been marked.', 'OK ID:183539', NULL, NULL, '2017-04-26 04:22:14'),
(312, 1, '03408883742', 'Respected parents,Zobia is present today. Attendance has been marked.', 'OK ID:183541', NULL, NULL, '2017-04-26 04:22:19'),
(313, 1, '03408883742', 'Respected parents,Husna is present today. Attendance has been marked.', 'OK ID:183543', NULL, NULL, '2017-04-26 04:22:21'),
(314, 1, '03102904250', 'Respected parents,Muhammad Huzaifa is present today. Attendance has been marked.', 'OK ID:183545', NULL, NULL, '2017-04-26 04:22:22'),
(315, 1, '03440097626', 'Respected parents,Maaz Ahmad is present today. Attendance has been marked.', 'OK ID:183546', NULL, NULL, '2017-04-26 04:22:27'),
(316, 1, '03456045732', 'Respected parents,Saniya BiBi is present today. Attendance has been marked.', 'OK ID:183547', NULL, NULL, '2017-04-26 04:22:29'),
(317, 1, '03482321324', 'Respected parents,Salaar Khan is present today. Attendance has been marked.', 'OK ID:183551', NULL, NULL, '2017-04-26 04:22:38'),
(318, 1, '03453956174', 'Respected parents,SYED HASEEB SHAH is present today. Attendance has been marked.', 'OK ID:183609', NULL, NULL, '2017-04-26 04:27:40'),
(319, 1, '03170215022', 'Respected parents,SYEDAH ROMAISA is present today. Attendance has been marked.', 'OK ID:183610', NULL, NULL, '2017-04-26 04:27:41'),
(320, 1, '03333243397', 'Respected parents,Syedah Noor E Adan is present today. Attendance has been marked.', 'OK ID:183611', NULL, NULL, '2017-04-26 04:27:42'),
(321, 1, '03158361693', 'Respected parents,Syed JahanZaib Shah is present today. Attendance has been marked.', 'OK ID:183613', NULL, NULL, '2017-04-26 04:27:44'),
(322, 1, '03333021286', 'Respected parents,M Shayan Khan is present today. Attendance has been marked.', 'OK ID:183614', NULL, NULL, '2017-04-26 04:27:44'),
(323, 1, '03432247790', 'Respected parents,Saniya Bibi is present today. Attendance has been marked.', 'OK ID:183615', NULL, NULL, '2017-04-26 04:27:47'),
(324, 1, '03432003183', 'Respected parents,Tamanna is present today. Attendance has been marked.', 'OK ID:183617', NULL, NULL, '2017-04-26 04:27:49'),
(325, 1, '03323159062', 'Respected parents,Zainab is present today. Attendance has been marked.', 'OK ID:183619', NULL, NULL, '2017-04-26 04:27:50'),
(326, 1, '03323159062', 'Respected parents,Muhammad Ayan is present today. Attendance has been marked.', 'OK ID:183620', NULL, NULL, '2017-04-26 04:27:51'),
(327, 1, '03440097626', 'Respected parents,Mehmood Ahmad is present today. Attendance has been marked.', 'OK ID:183621', NULL, NULL, '2017-04-26 04:27:56'),
(328, 1, '03451245325', 'Respected parents,Yasir is present today. Attendance has been marked.', 'OK ID:183622', NULL, NULL, '2017-04-26 04:27:58'),
(329, 1, '03408883742', 'Attention: Maleeha  is absent from Institute today, please submit the cause of absent at institute office.', 'OK ID:183628', NULL, NULL, '2017-04-26 04:28:14'),
(330, 1, '03462413564', 'Respected parents,Syed Ammad Shah is present today. Attendance has been marked.', 'OK ID:183631', NULL, NULL, '2017-04-26 04:29:40'),
(331, 1, '03471676157', 'Respected parents,Syedah Adeeba is present today. Attendance has been marked.', 'OK ID:183632', NULL, NULL, '2017-04-26 04:29:42'),
(332, 1, '03422000351', 'Respected parents,Syedah Manahil is present today. Attendance has been marked.', 'OK ID:183633', NULL, NULL, '2017-04-26 04:29:51'),
(333, 1, '03432247790', 'Respected parents,Shoukat Ali is present today. Attendance has been marked.', 'OK ID:183634', NULL, NULL, '2017-04-26 04:29:55'),
(334, 1, '03312199285', 'Respected parents,Muhammad Shah is present today. Attendance has been marked.', 'OK ID:183635', NULL, NULL, '2017-04-26 04:29:56'),
(335, 1, '03452477414', 'Respected parents,Bareera is present today. Attendance has been marked.', 'OK ID:183636', NULL, NULL, '2017-04-26 04:29:58'),
(336, 1, '03433220758', 'Respected parents,Rehman shah is present today. Attendance has been marked.', 'OK ID:183637', NULL, NULL, '2017-04-26 04:30:03'),
(337, 1, '03453950342', 'Respected parents,Muhammad Umair is present today. Attendance has been marked.', 'OK ID:183638', NULL, NULL, '2017-04-26 04:30:15'),
(338, 1, '03353408405', 'Respected parents,Muhammad Raees Ameer is present today. Attendance has been marked.', 'OK ID:183639', NULL, NULL, '2017-04-26 04:30:15'),
(339, 1, '03151049622', 'Respected parents,Zarnain Khan is present today. Attendance has been marked.', 'OK ID:183640', NULL, NULL, '2017-04-26 04:30:16'),
(340, 1, '03456045732', 'Respected parents,Syed Hassan Shah is present today. Attendance has been marked.', 'OK ID:183641', NULL, NULL, '2017-04-26 04:30:19'),
(341, 1, '03422316390', 'Respected parents,Syedah Khadeeja is present today. Attendance has been marked.', 'OK ID:183643', NULL, NULL, '2017-04-26 04:31:51'),
(342, 1, '03433351845', 'Respected parents,Kanwal Naeem is present today. Attendance has been marked.', 'OK ID:183644', NULL, NULL, '2017-04-26 04:31:55'),
(343, 1, '03432003571', 'Respected parents,Syedah Nadia is present today. Attendance has been marked.', 'OK ID:183645', NULL, NULL, '2017-04-26 04:31:57'),
(344, 1, '03452823753', 'Respected parents,LAIBA AYOOB is present today. Attendance has been marked.', 'OK ID:183646', NULL, NULL, '2017-04-26 04:32:07'),
(345, 1, '03422316390', 'Respected parents,Syedah Khadeeja is present today. Attendance has been marked.', 'OK ID:183647', NULL, NULL, '2017-04-26 04:32:45'),
(346, 1, '03433351845', 'Respected parents,Kanwal Naeem is present today. Attendance has been marked.', 'OK ID:183648', NULL, NULL, '2017-04-26 04:32:54'),
(347, 1, '03432003571', 'Respected parents,Syedah Nadia is present today. Attendance has been marked.', 'OK ID:183649', NULL, NULL, '2017-04-26 04:32:59'),
(348, 1, '03452823753', 'Respected parents,LAIBA AYOOB is present today. Attendance has been marked.', 'OK ID:183650', NULL, NULL, '2017-04-26 04:33:01'),
(349, 1, '03422000351', 'Respected parents,Syed Abdul Wahid Shah is present today. Attendance has been marked.', 'OK ID:183651', NULL, NULL, '2017-04-26 04:33:26'),
(350, 1, '03422000351', 'Respected parents,Syedah Ayesha  is present today. Attendance has been marked.', 'OK ID:183652', NULL, NULL, '2017-04-26 04:33:35'),
(351, 1, '03422000351', 'Respected parents,Syeda Fatima is present today. Attendance has been marked.', 'OK ID:183653', NULL, NULL, '2017-04-26 04:33:40'),
(352, 1, '03433220758', 'Respected parents,Farooq Shah is present today. Attendance has been marked.', 'OK ID:183654', NULL, NULL, '2017-04-26 04:33:42'),
(353, 1, '03453950443', 'Respected parents,Laiba is present today. Attendance has been marked.', 'OK ID:183655', NULL, NULL, '2017-04-26 04:33:51'),
(354, 1, '03422316390', 'Respected parents,Syed Asad Shah is present today. Attendance has been marked.', 'OK ID:183656', NULL, NULL, '2017-04-26 04:33:56'),
(355, 1, '03332261654', 'Respected parents,SYEDAH SHAAMIA is present today. Attendance has been marked.', 'OK ID:183657', NULL, NULL, '2017-04-26 04:34:09'),
(356, 1, '03422000351', 'Respected parents,Syedah Arfa is present today. Attendance has been marked.', 'OK ID:183658', NULL, NULL, '2017-04-26 04:34:11'),
(357, 1, '03452170378', 'Respected parents,Syedah Huma is present today. Attendance has been marked.', 'OK ID:183659', NULL, NULL, '2017-04-26 04:34:13'),
(358, 1, '03022087457', 'Respected parents,Iqra Azeem is present today. Attendance has been marked.', 'OK ID:183660', NULL, NULL, '2017-04-26 04:34:14'),
(359, 1, '03433351845', 'Respected parents,Muhammad Ibraheem is present today. Attendance has been marked.', 'OK ID:183661', NULL, NULL, '2017-04-26 04:34:23'),
(360, 1, '03453956174', 'Respected parents,SYEDAH MANAHIL is present today. Attendance has been marked.', 'OK ID:183662', NULL, NULL, '2017-04-26 04:34:35'),
(361, 1, '03422000351', 'Respected parents,Syed Suleman Shah  is present today. Attendance has been marked.', 'OK ID:183663', NULL, NULL, '2017-04-26 04:34:40'),
(362, 1, '03158361693', 'Respected parents,Syedah Bisma Shah is present today. Attendance has been marked.', 'OK ID:183664', NULL, NULL, '2017-04-26 04:34:41'),
(363, 1, '03158361693', 'Respected parents,Syed Zohaib Shah is present today. Attendance has been marked.', 'OK ID:183665', NULL, NULL, '2017-04-26 04:34:43'),
(364, 1, '03333021286', 'Respected parents,Muhammad nasir khan is present today. Attendance has been marked.', 'OK ID:183666', NULL, NULL, '2017-04-26 04:34:43'),
(365, 1, '03332362260', 'Respected parents,Shenella is present today. Attendance has been marked.', 'OK ID:183667', NULL, NULL, '2017-04-26 04:34:44'),
(366, 1, '03332261654', 'Respected parents,SYEDAH EMAAN is present today. Attendance has been marked.', 'OK ID:183696', NULL, NULL, '2017-04-26 04:39:29'),
(367, 1, '03472004413', 'Respected parents,HASEENA KANWAL is present today. Attendance has been marked.', 'OK ID:183697', NULL, NULL, '2017-04-26 04:39:31'),
(368, 1, '03452170378', 'Respected parents,Syedah Wajeha is present today. Attendance has been marked.', 'OK ID:183698', NULL, NULL, '2017-04-26 04:39:33'),
(369, 1, '03432003183', 'Respected parents,Maryyam Qasim is present today. Attendance has been marked.', 'OK ID:183702', NULL, NULL, '2017-04-26 04:39:42'),
(370, 1, '03432003183', 'Respected parents,Asim Abbasi is present today. Attendance has been marked.', 'OK ID:183703', NULL, NULL, '2017-04-26 04:39:47'),
(371, 1, '03158361693', 'Respected parents,Syedah Isma Shah is present today. Attendance has been marked.', 'OK ID:183704', NULL, NULL, '2017-04-26 04:39:49'),
(372, 1, '03333021286', 'Respected parents,Abdullah is present today. Attendance has been marked.', 'OK ID:183705', NULL, NULL, '2017-04-26 04:39:49'),
(373, 1, '03433351845', 'Respected parents,Muhammad Ismail is present today. Attendance has been marked.', 'OK ID:183709', NULL, NULL, '2017-04-26 04:39:58'),
(374, 1, '03453956174', 'Respected parents,SYEDAH ZUNAIRA is present today. Attendance has been marked.', 'OK ID:183713', NULL, NULL, '2017-04-26 04:40:19'),
(375, 1, '03022087457', 'Respected parents,Zohra Azeem is present today. Attendance has been marked.', 'OK ID:183714', NULL, NULL, '2017-04-26 04:40:20'),
(376, 1, '03482184630', 'Respected parents,Syed Umair Shah is present today. Attendance has been marked.', 'OK ID:183715', NULL, NULL, '2017-04-26 04:40:22'),
(377, 1, '03408883742', 'Respected parents,Ayesha  is present today. Attendance has been marked.', 'OK ID:183717', NULL, NULL, '2017-04-26 04:40:27'),
(378, 1, '03432247790', 'Respected parents,Ayesha is present today. Attendance has been marked.', 'OK ID:183719', NULL, NULL, '2017-04-26 04:40:30'),
(379, 1, '03422000351', 'Respected parents,Syedah Raima  is present today. Attendance has been marked.', 'OK ID:183721', NULL, NULL, '2017-04-26 04:40:35'),
(380, 1, '03440097626', 'Respected parents,Zahoor Ahmad is present today. Attendance has been marked.', 'OK ID:183722', NULL, NULL, '2017-04-26 04:40:44'),
(381, 1, '03170215022', 'Respected parents,SYED SUHAAM SHAH is present today. Attendance has been marked.', 'OK ID:183723', NULL, NULL, '2017-04-26 04:41:01'),
(382, 1, '03333243397', 'Respected parents,Syedah Tayyaba is present today. Attendance has been marked.', 'OK ID:183724', NULL, NULL, '2017-04-26 04:41:02'),
(383, 1, '03422316390', 'Respected parents,Syedah Zunaira is present today. Attendance has been marked.', 'OK ID:183725', NULL, NULL, '2017-04-26 04:41:11'),
(384, 1, '03462413564', 'Respected parents,Syed Fahad Shah is present today. Attendance has been marked.', 'OK ID:183726', NULL, NULL, '2017-04-26 04:41:16'),
(385, 1, '03471676157', 'Respected parents,Syed Ayan Shah is present today. Attendance has been marked.', 'OK ID:183727', NULL, NULL, '2017-04-26 04:41:18'),
(386, 1, '03422000351', 'Respected parents,Syed Saud Shah is present today. Attendance has been marked.', 'OK ID:183728', NULL, NULL, '2017-04-26 04:41:23'),
(387, 1, '03452170378', 'Respected parents,Syedah Onaisa  is present today. Attendance has been marked.', 'OK ID:183729', NULL, NULL, '2017-04-26 04:41:25'),
(388, 1, '03432003183', 'Respected parents,Aqsa Qasim is present today. Attendance has been marked.', 'OK ID:183730', NULL, NULL, '2017-04-26 04:41:34'),
(389, 1, '03432003183', 'Respected parents,Noor Fatima is present today. Attendance has been marked.', 'OK ID:183731', NULL, NULL, '2017-04-26 04:41:39'),
(390, 1, '03158361693', 'Respected parents,Syedah Asma Shah is present today. Attendance has been marked.', 'OK ID:183732', NULL, NULL, '2017-04-26 04:41:40'),
(391, 1, '03482072766', 'Respected parents,Muhammad Khizer  is present today. Attendance has been marked.', 'OK ID:183733', NULL, NULL, '2017-04-26 04:41:42'),
(392, 1, '03452962248', 'Respected parents,Sayyamullah is present today. Attendance has been marked.', 'OK ID:183734', NULL, NULL, '2017-04-26 04:41:47'),
(393, 1, '03022834618', 'Respected parents,Muhammad Safeer Khan is present today. Attendance has been marked.', 'OK ID:183735', NULL, NULL, '2017-04-26 04:41:48'),
(394, 1, '03333021286', 'Respected parents,Marwah bibi is present today. Attendance has been marked.', 'OK ID:183736', NULL, NULL, '2017-04-26 04:41:49'),
(395, 1, '03333021286', 'Respected parents,M Tayyab khan is present today. Attendance has been marked.', 'OK ID:183737', NULL, NULL, '2017-04-26 04:41:49'),
(396, 1, '03432247790', 'Respected parents,Laiba bibi is present today. Attendance has been marked.', 'OK ID:183738', NULL, NULL, '2017-04-26 04:41:58'),
(397, 1, '03043823703', 'Respected parents,Gul Sher is present today. Attendance has been marked.', 'OK ID:183739', NULL, NULL, '2017-04-26 04:41:59'),
(398, 1, '03012968106', 'Respected parents,Muhammad Aamir is present today. Attendance has been marked.', 'OK ID:183740', NULL, NULL, '2017-04-26 04:42:00'),
(399, 1, '03322752599', 'Respected parents,Abdul Wasay is present today. Attendance has been marked.', 'OK ID:183741', NULL, NULL, '2017-04-26 04:42:00'),
(400, 1, '03452962248', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183742', NULL, NULL, '2017-04-26 04:42:04'),
(401, 1, '03452962248', 'Respected parents,Hasnain Muawiya is present today. Attendance has been marked.', 'OK ID:183743', NULL, NULL, '2017-04-26 04:42:06'),
(402, 1, '03452477414', 'Respected parents,Fareeha is present today. Attendance has been marked.', 'OK ID:183744', NULL, NULL, '2017-04-26 04:42:15'),
(403, 1, '03022087457', 'Respected parents,Anas Azeem is present today. Attendance has been marked.', 'OK ID:183745', NULL, NULL, '2017-04-26 04:42:16'),
(404, 1, '03333325771', 'Respected parents,Shah Zain is present today. Attendance has been marked.', 'OK ID:183746', NULL, NULL, '2017-04-26 04:42:16'),
(405, 1, '03333325771', 'Respected parents,Wajeha is present today. Attendance has been marked.', 'OK ID:183747', NULL, NULL, '2017-04-26 04:42:17'),
(406, 1, '03412218933', 'Respected parents,Subhan Khan is present today. Attendance has been marked.', 'OK ID:183748', NULL, NULL, '2017-04-26 04:42:19'),
(407, 1, '03333036904', 'Respected parents,Talha Abbasi is present today. Attendance has been marked.', 'OK ID:183749', NULL, NULL, '2017-04-26 04:42:20'),
(408, 1, '03433220758', 'Respected parents,Rizwan Shah is present today. Attendance has been marked.', 'OK ID:183750', NULL, NULL, '2017-04-26 04:42:22'),
(409, 1, '03462895129', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183751', NULL, NULL, '2017-04-26 04:42:31'),
(410, 1, '03152686240', 'Respected parents,Muhammad Zaid is present today. Attendance has been marked.', 'OK ID:183752', NULL, NULL, '2017-04-26 04:42:32'),
(411, 1, '03432247790', 'Respected parents,Abdul Samad is present today. Attendance has been marked.', 'OK ID:183753', NULL, NULL, '2017-04-26 04:42:37'),
(412, 1, '03408883742', 'Respected parents,Maaz is present today. Attendance has been marked.', 'OK ID:183754', NULL, NULL, '2017-04-26 04:42:43'),
(413, 1, '03408883742', 'Respected parents,Zobia is present today. Attendance has been marked.', 'OK ID:183755', NULL, NULL, '2017-04-26 04:42:45'),
(414, 1, '03408883742', 'Respected parents,Husna is present today. Attendance has been marked.', 'OK ID:183756', NULL, NULL, '2017-04-26 04:42:54'),
(415, 1, '03102904250', 'Respected parents,Muhammad Huzaifa is present today. Attendance has been marked.', 'OK ID:183757', NULL, NULL, '2017-04-26 04:42:55'),
(416, 1, '03440097626', 'Respected parents,Maaz Ahmad is present today. Attendance has been marked.', 'OK ID:183758', NULL, NULL, '2017-04-26 04:43:00'),
(417, 1, '03456045732', 'Respected parents,Saniya BiBi is present today. Attendance has been marked.', 'OK ID:183759', NULL, NULL, '2017-04-26 04:43:02'),
(418, 1, '03482321324', 'Respected parents,Salaar Khan is present today. Attendance has been marked.', 'OK ID:183760', NULL, NULL, '2017-04-26 04:43:07'),
(419, 1, '03453956174', 'Respected parents,SYEDAH ZUNAIRA is present today. Attendance has been marked.', 'OK ID:183901', NULL, NULL, '2017-04-26 06:42:59'),
(420, 1, '03022087457', 'Respected parents,Zohra Azeem is present today. Attendance has been marked.', 'OK ID:183902', NULL, NULL, '2017-04-26 06:43:00'),
(421, 1, '03482184630', 'Respected parents,Syed Umair Shah is present today. Attendance has been marked.', 'OK ID:183903', NULL, NULL, '2017-04-26 06:43:02'),
(422, 1, '03408883742', 'Respected parents,Ayesha  is present today. Attendance has been marked.', 'OK ID:183904', NULL, NULL, '2017-04-26 06:43:08'),
(423, 1, '03432247790', 'Respected parents,Ayesha is present today. Attendance has been marked.', 'OK ID:183905', NULL, NULL, '2017-04-26 06:43:11'),
(424, 1, '03422000351', 'Respected parents,Syedah Raima  is present today. Attendance has been marked.', 'OK ID:183906', NULL, NULL, '2017-04-26 06:43:16'),
(425, 1, '03440097626', 'Respected parents,Zahoor Ahmad is present today. Attendance has been marked.', 'OK ID:183907', NULL, NULL, '2017-04-26 06:43:18'),
(426, 1, '03332261654', 'Respected parents,SYEDAH EMAAN is present today. Attendance has been marked.', 'OK ID:183908', NULL, NULL, '2017-04-26 06:43:44'),
(427, 1, '03472004413', 'Respected parents,HASEENA KANWAL is present today. Attendance has been marked.', 'OK ID:183909', NULL, NULL, '2017-04-26 06:43:49'),
(428, 1, '03452170378', 'Respected parents,Syedah Wajeha is present today. Attendance has been marked.', 'OK ID:183910', NULL, NULL, '2017-04-26 06:43:58'),
(429, 1, '03453956174', 'Respected parents,SYEDAH MANAHIL is present today. Attendance has been marked.', 'OK ID:183912', NULL, NULL, '2017-04-26 06:44:42'),
(430, 1, '03422000351', 'Respected parents,Syed Suleman Shah  is present today. Attendance has been marked.', 'OK ID:183913', NULL, NULL, '2017-04-26 06:44:47'),
(431, 1, '03158361693', 'Respected parents,Syedah Bisma Shah is present today. Attendance has been marked.', 'OK ID:183914', NULL, NULL, '2017-04-26 06:44:49'),
(432, 1, '03158361693', 'Respected parents,Syed Zohaib Shah is present today. Attendance has been marked.', 'OK ID:183915', NULL, NULL, '2017-04-26 06:44:50'),
(433, 1, '03333021286', 'Respected parents,Muhammad nasir khan is present today. Attendance has been marked.', 'OK ID:183916', NULL, NULL, '2017-04-26 06:44:51'),
(434, 1, '03332362260', 'Respected parents,Shenella is present today. Attendance has been marked.', 'OK ID:183917', NULL, NULL, '2017-04-26 06:44:52'),
(435, 1, '03332261654', 'Respected parents,SYEDAH SHAAMIA is present today. Attendance has been marked.', 'OK ID:183918', NULL, NULL, '2017-04-26 06:45:01'),
(436, 1, '03422000351', 'Respected parents,Syedah Arfa is present today. Attendance has been marked.', 'OK ID:183919', NULL, NULL, '2017-04-26 06:45:04'),
(437, 1, '03452170378', 'Respected parents,Syedah Huma is present today. Attendance has been marked.', 'OK ID:183920', NULL, NULL, '2017-04-26 06:45:07'),
(438, 1, '03022087457', 'Respected parents,Iqra Azeem is present today. Attendance has been marked.', 'OK ID:183921', NULL, NULL, '2017-04-26 06:45:09'),
(439, 1, '03433351845', 'Respected parents,Muhammad Ibraheem is present today. Attendance has been marked.', 'OK ID:183922', NULL, NULL, '2017-04-26 06:45:12'),
(440, 1, '03422000351', 'Respected parents,Syed Abdul Wahid Shah is present today. Attendance has been marked.', 'OK ID:183923', NULL, NULL, '2017-04-26 06:45:35'),
(441, 1, '03422000351', 'Respected parents,Syedah Ayesha  is present today. Attendance has been marked.', 'OK ID:183924', NULL, NULL, '2017-04-26 06:45:39'),
(442, 1, '03422000351', 'Respected parents,Syeda Fatima is present today. Attendance has been marked.', 'OK ID:183925', NULL, NULL, '2017-04-26 06:45:44'),
(443, 1, '03433220758', 'Respected parents,Farooq Shah is present today. Attendance has been marked.', 'OK ID:183926', NULL, NULL, '2017-04-26 06:45:46'),
(444, 1, '03453950443', 'Respected parents,Laiba is present today. Attendance has been marked.', 'OK ID:183927', NULL, NULL, '2017-04-26 06:45:55'),
(445, 1, '03422316390', 'Respected parents,Syed Asad Shah is present today. Attendance has been marked.', 'OK ID:183928', NULL, NULL, '2017-04-26 06:46:00'),
(446, 1, '03422316390', 'Respected parents,Syedah Khadeeja is present today. Attendance has been marked.', 'OK ID:183930', NULL, NULL, '2017-04-26 06:46:27'),
(447, 1, '03433351845', 'Respected parents,Kanwal Naeem is present today. Attendance has been marked.', 'OK ID:183931', NULL, NULL, '2017-04-26 06:46:32'),
(448, 1, '03432003571', 'Respected parents,Syedah Nadia is present today. Attendance has been marked.', 'OK ID:183932', NULL, NULL, '2017-04-26 06:46:34'),
(449, 1, '03452823753', 'Respected parents,LAIBA AYOOB is present today. Attendance has been marked.', 'OK ID:183933', NULL, NULL, '2017-04-26 06:46:39'),
(450, 1, '03462413564', 'Respected parents,Syed Ammad Shah is present today. Attendance has been marked.', 'OK ID:183935', NULL, NULL, '2017-04-26 06:46:51'),
(451, 1, '03471676157', 'Respected parents,Syedah Adeeba is present today. Attendance has been marked.', 'OK ID:183936', NULL, NULL, '2017-04-26 06:46:56'),
(452, 1, '03422000351', 'Respected parents,Syedah Manahil is present today. Attendance has been marked.', 'OK ID:183937', NULL, NULL, '2017-04-26 06:46:58'),
(453, 1, '03432247790', 'Respected parents,Shoukat Ali is present today. Attendance has been marked.', 'OK ID:183938', NULL, NULL, '2017-04-26 06:47:03'),
(454, 1, '03312199285', 'Respected parents,Muhammad Shah is present today. Attendance has been marked.', 'OK ID:183939', NULL, NULL, '2017-04-26 06:47:04'),
(455, 1, '03452477414', 'Respected parents,Bareera is present today. Attendance has been marked.', 'OK ID:183940', NULL, NULL, '2017-04-26 06:47:06'),
(456, 1, '03433220758', 'Respected parents,Rehman shah is present today. Attendance has been marked.', 'OK ID:183941', NULL, NULL, '2017-04-26 06:47:15'),
(457, 1, '03453950342', 'Respected parents,Muhammad Umair is present today. Attendance has been marked.', 'OK ID:183942', NULL, NULL, '2017-04-26 06:47:20'),
(458, 1, '03353408405', 'Respected parents,Muhammad Raees Ameer is present today. Attendance has been marked.', 'OK ID:183943', NULL, NULL, '2017-04-26 06:47:21'),
(459, 1, '03151049622', 'Respected parents,Zarnain Khan is present today. Attendance has been marked.', 'OK ID:183944', NULL, NULL, '2017-04-26 06:47:22'),
(460, 1, '03456045732', 'Respected parents,Syed Hassan Shah is present today. Attendance has been marked.', 'OK ID:183945', NULL, NULL, '2017-04-26 06:47:27'),
(461, 1, '03170215022', 'Respected parents,SYED SUHAAM SHAH is present today. Attendance has been marked.', 'OK ID:183946', NULL, NULL, '2017-04-26 06:47:54'),
(462, 1, '03333243397', 'Respected parents,Syedah Tayyaba is present today. Attendance has been marked.', 'OK ID:183947', NULL, NULL, '2017-04-26 06:47:55'),
(463, 1, '03422316390', 'Respected parents,Syedah Zunaira is present today. Attendance has been marked.', 'OK ID:183948', NULL, NULL, '2017-04-26 06:48:00'),
(464, 1, '03462413564', 'Respected parents,Syed Fahad Shah is present today. Attendance has been marked.', 'OK ID:183949', NULL, NULL, '2017-04-26 06:48:02'),
(465, 1, '03471676157', 'Respected parents,Syed Ayan Shah is present today. Attendance has been marked.', 'OK ID:183950', NULL, NULL, '2017-04-26 06:48:08'),
(466, 1, '03422000351', 'Respected parents,Syed Saud Shah is present today. Attendance has been marked.', 'OK ID:183951', NULL, NULL, '2017-04-26 06:48:11'),
(467, 1, '03452170378', 'Respected parents,Syedah Onaisa  is present today. Attendance has been marked.', 'OK ID:183952', NULL, NULL, '2017-04-26 06:48:16'),
(468, 1, '03432003183', 'Respected parents,Aqsa Qasim is present today. Attendance has been marked.', 'OK ID:183953', NULL, NULL, '2017-04-26 06:48:18'),
(469, 1, '03432003183', 'Respected parents,Noor Fatima is present today. Attendance has been marked.', 'OK ID:183954', NULL, NULL, '2017-04-26 06:48:23'),
(470, 1, '03158361693', 'Respected parents,Syedah Asma Shah is present today. Attendance has been marked.', 'OK ID:183955', NULL, NULL, '2017-04-26 06:48:25'),
(471, 1, '03482072766', 'Respected parents,Muhammad Khizer  is present today. Attendance has been marked.', 'OK ID:183956', NULL, NULL, '2017-04-26 06:48:35'),
(472, 1, '03452962248', 'Respected parents,Sayyamullah is present today. Attendance has been marked.', 'OK ID:183957', NULL, NULL, '2017-04-26 06:48:40'),
(473, 1, '03022834618', 'Respected parents,Muhammad Safeer Khan is present today. Attendance has been marked.', 'OK ID:183958', NULL, NULL, '2017-04-26 06:48:40'),
(474, 1, '03333021286', 'Respected parents,Marwah bibi is present today. Attendance has been marked.', 'OK ID:183959', NULL, NULL, '2017-04-26 06:48:41'),
(475, 1, '03333021286', 'Respected parents,M Tayyab khan is present today. Attendance has been marked.', 'OK ID:183960', NULL, NULL, '2017-04-26 06:48:42'),
(476, 1, '03432247790', 'Respected parents,Laiba bibi is present today. Attendance has been marked.', 'OK ID:183961', NULL, NULL, '2017-04-26 06:48:51'),
(477, 1, '03043823703', 'Respected parents,Gul Sher is present today. Attendance has been marked.', 'OK ID:183962', NULL, NULL, '2017-04-26 06:48:52'),
(478, 1, '03012968106', 'Respected parents,Muhammad Aamir is present today. Attendance has been marked.', 'OK ID:183963', NULL, NULL, '2017-04-26 06:48:52'),
(479, 1, '03322752599', 'Respected parents,Abdul Wasay is present today. Attendance has been marked.', 'OK ID:183964', NULL, NULL, '2017-04-26 06:48:53'),
(480, 1, '03452962248', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183965', NULL, NULL, '2017-04-26 06:48:55');
INSERT INTO `sms_log` (`id_sms_log`, `campus_id`, `mobile_number`, `message`, `code`, `status`, `no_of_sms`, `sms_date`) VALUES
(481, 1, '03452962248', 'Respected parents,Hasnain Muawiya is present today. Attendance has been marked.', 'OK ID:183966', NULL, NULL, '2017-04-26 06:48:57'),
(482, 1, '03452477414', 'Respected parents,Fareeha is present today. Attendance has been marked.', 'OK ID:183967', NULL, NULL, '2017-04-26 06:49:07'),
(483, 1, '03022087457', 'Respected parents,Anas Azeem is present today. Attendance has been marked.', 'OK ID:183968', NULL, NULL, '2017-04-26 06:49:08'),
(484, 1, '03333325771', 'Respected parents,Shah Zain is present today. Attendance has been marked.', 'OK ID:183969', NULL, NULL, '2017-04-26 06:49:09'),
(485, 1, '03333325771', 'Respected parents,Wajeha is present today. Attendance has been marked.', 'OK ID:183970', NULL, NULL, '2017-04-26 06:49:10'),
(486, 1, '03412218933', 'Respected parents,Subhan Khan is present today. Attendance has been marked.', 'OK ID:183971', NULL, NULL, '2017-04-26 06:49:12'),
(487, 1, '03333036904', 'Respected parents,Talha Abbasi is present today. Attendance has been marked.', 'OK ID:183972', NULL, NULL, '2017-04-26 06:49:14'),
(488, 1, '03433220758', 'Respected parents,Rizwan Shah is present today. Attendance has been marked.', 'OK ID:183973', NULL, NULL, '2017-04-26 06:49:23'),
(489, 1, '03462895129', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:183974', NULL, NULL, '2017-04-26 06:49:28'),
(490, 1, '03152686240', 'Respected parents,Muhammad Zaid is present today. Attendance has been marked.', 'OK ID:183975', NULL, NULL, '2017-04-26 06:49:29'),
(491, 1, '03432247790', 'Respected parents,Abdul Samad is present today. Attendance has been marked.', 'OK ID:183976', NULL, NULL, '2017-04-26 06:49:38'),
(492, 1, '03408883742', 'Respected parents,Maaz is present today. Attendance has been marked.', 'OK ID:183977', NULL, NULL, '2017-04-26 06:49:44'),
(493, 1, '03408883742', 'Respected parents,Zobia is present today. Attendance has been marked.', 'OK ID:183978', NULL, NULL, '2017-04-26 06:49:46'),
(494, 1, '03408883742', 'Respected parents,Husna is present today. Attendance has been marked.', 'OK ID:183979', NULL, NULL, '2017-04-26 06:49:55'),
(495, 1, '03102904250', 'Respected parents,Muhammad Huzaifa is present today. Attendance has been marked.', 'OK ID:183980', NULL, NULL, '2017-04-26 06:49:57'),
(496, 1, '03440097626', 'Respected parents,Maaz Ahmad is present today. Attendance has been marked.', 'OK ID:183981', NULL, NULL, '2017-04-26 06:50:00'),
(497, 1, '03456045732', 'Respected parents,Saniya BiBi is present today. Attendance has been marked.', 'OK ID:183982', NULL, NULL, '2017-04-26 06:50:02'),
(498, 1, '03482321324', 'Respected parents,Salaar Khan is present today. Attendance has been marked.', 'OK ID:183983', NULL, NULL, '2017-04-26 06:50:07'),
(499, 1, '03453956174', 'Respected parents,SYED HASEEB SHAH is present today. Attendance has been marked.', 'OK ID:183984', NULL, NULL, '2017-04-26 06:50:49'),
(500, 1, '03170215022', 'Respected parents,SYEDAH ROMAISA is present today. Attendance has been marked.', 'OK ID:183985', NULL, NULL, '2017-04-26 06:50:50'),
(501, 1, '03333243397', 'Respected parents,Syedah Noor E Adan is present today. Attendance has been marked.', 'OK ID:183986', NULL, NULL, '2017-04-26 06:50:51'),
(502, 1, '03158361693', 'Respected parents,Syed JahanZaib Shah is present today. Attendance has been marked.', 'OK ID:183987', NULL, NULL, '2017-04-26 06:50:52'),
(503, 1, '03333021286', 'Respected parents,M Shayan Khan is present today. Attendance has been marked.', 'OK ID:183988', NULL, NULL, '2017-04-26 06:50:53'),
(504, 1, '03432247790', 'Respected parents,Saniya Bibi is present today. Attendance has been marked.', 'OK ID:183989', NULL, NULL, '2017-04-26 06:50:56'),
(505, 1, '03432003183', 'Respected parents,Tamanna is present today. Attendance has been marked.', 'OK ID:183990', NULL, NULL, '2017-04-26 06:50:58'),
(506, 1, '03323159062', 'Respected parents,Zainab is present today. Attendance has been marked.', 'OK ID:183991', NULL, NULL, '2017-04-26 06:50:59'),
(507, 1, '03323159062', 'Respected parents,Muhammad Ayan is present today. Attendance has been marked.', 'OK ID:183992', NULL, NULL, '2017-04-26 06:51:00'),
(508, 1, '03440097626', 'Respected parents,Mehmood Ahmad is present today. Attendance has been marked.', 'OK ID:183993', NULL, NULL, '2017-04-26 06:51:05'),
(509, 1, '03451245325', 'Respected parents,Yasir is present today. Attendance has been marked.', 'OK ID:183994', NULL, NULL, '2017-04-26 06:51:14'),
(510, 1, '03333245567', 'Thank you  for fees submission.\r\nInvoice# :1704149\r\nGrand Total :1480.00\r\nRecieved Amount :1480.00\r\nReturned Amount :0\r\n', 'OK ID:184470', NULL, NULL, '2017-04-27 03:31:14'),
(511, 1, '03170215022', 'Respected parents,SYED SUHAAM SHAH is present today. Attendance has been marked.', 'OK ID:184471', NULL, NULL, '2017-04-27 03:44:47'),
(512, 1, '03333243397', 'Respected parents,Syedah Tayyaba is present today. Attendance has been marked.', 'OK ID:184472', NULL, NULL, '2017-04-27 03:44:48'),
(513, 1, '03422316390', 'Respected parents,Syedah Zunaira is present today. Attendance has been marked.', 'OK ID:184473', NULL, NULL, '2017-04-27 03:44:53'),
(514, 1, '03462413564', 'Respected parents,Syed Fahad Shah is present today. Attendance has been marked.', 'OK ID:184474', NULL, NULL, '2017-04-27 03:44:55'),
(515, 1, '03471676157', 'Respected parents,Syed Ayan Shah is present today. Attendance has been marked.', 'OK ID:184475', NULL, NULL, '2017-04-27 03:45:00'),
(516, 1, '03422000351', 'Respected parents,Syed Saud Shah is present today. Attendance has been marked.', 'OK ID:184476', NULL, NULL, '2017-04-27 03:45:02'),
(517, 1, '03452170378', 'Respected parents,Syedah Onaisa  is present today. Attendance has been marked.', 'OK ID:184477', NULL, NULL, '2017-04-27 03:45:09'),
(518, 1, '03432003183', 'Respected parents,Aqsa Qasim is present today. Attendance has been marked.', 'OK ID:184478', NULL, NULL, '2017-04-27 03:45:12'),
(519, 1, '03432003183', 'Respected parents,Noor Fatima is present today. Attendance has been marked.', 'OK ID:184479', NULL, NULL, '2017-04-27 03:45:17'),
(520, 1, '03158361693', 'Respected parents,Syedah Asma Shah is present today. Attendance has been marked.', 'OK ID:184480', NULL, NULL, '2017-04-27 03:45:19'),
(521, 1, '03482072766', 'Respected parents,Muhammad Khizer  is present today. Attendance has been marked.', 'OK ID:184481', NULL, NULL, '2017-04-27 03:45:24'),
(522, 1, '03452962248', 'Respected parents,Sayyamullah is present today. Attendance has been marked.', 'OK ID:184482', NULL, NULL, '2017-04-27 03:45:26'),
(523, 1, '03333021286', 'Respected parents,M Tayyab khan is present today. Attendance has been marked.', 'OK ID:184483', NULL, NULL, '2017-04-27 03:45:26'),
(524, 1, '03432247790', 'Respected parents,Laiba bibi is present today. Attendance has been marked.', 'OK ID:184484', NULL, NULL, '2017-04-27 03:45:35'),
(525, 1, '03043823703', 'Respected parents,Gul Sher is present today. Attendance has been marked.', 'OK ID:184485', NULL, NULL, '2017-04-27 03:45:39'),
(526, 1, '03012968106', 'Respected parents,Muhammad Aamir is present today. Attendance has been marked.', 'OK ID:184486', NULL, NULL, '2017-04-27 03:45:40'),
(527, 1, '03322752599', 'Respected parents,Abdul Wasay is present today. Attendance has been marked.', 'OK ID:184487', NULL, NULL, '2017-04-27 03:45:41'),
(528, 1, '03452962248', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:184488', NULL, NULL, '2017-04-27 03:45:43'),
(529, 1, '03452962248', 'Respected parents,Hasnain Muawiya is present today. Attendance has been marked.', 'OK ID:184489', NULL, NULL, '2017-04-27 03:45:51'),
(530, 1, '03452477414', 'Respected parents,Fareeha is present today. Attendance has been marked.', 'OK ID:184490', NULL, NULL, '2017-04-27 03:45:56'),
(531, 1, '03022087457', 'Respected parents,Anas Azeem is present today. Attendance has been marked.', 'OK ID:184491', NULL, NULL, '2017-04-27 03:45:57'),
(532, 1, '03333325771', 'Respected parents,Shah Zain is present today. Attendance has been marked.', 'OK ID:184492', NULL, NULL, '2017-04-27 03:45:58'),
(533, 1, '03333325771', 'Respected parents,Wajeha is present today. Attendance has been marked.', 'OK ID:184493', NULL, NULL, '2017-04-27 03:45:58'),
(534, 1, '03453956174', 'Respected parents,SYEDAH ZUNAIRA is present today. Attendance has been marked.', 'OK ID:184495', NULL, NULL, '2017-04-27 03:48:57'),
(535, 1, '03022087457', 'Respected parents,Zohra Azeem is present today. Attendance has been marked.', 'OK ID:184496', NULL, NULL, '2017-04-27 03:48:58'),
(536, 1, '03482184630', 'Respected parents,Syed Umair Shah is present today. Attendance has been marked.', 'OK ID:184497', NULL, NULL, '2017-04-27 03:48:59'),
(537, 1, '03408883742', 'Respected parents,Ayesha  is present today. Attendance has been marked.', 'OK ID:184498', NULL, NULL, '2017-04-27 03:49:05'),
(538, 1, '03432247790', 'Respected parents,Ayesha is present today. Attendance has been marked.', 'OK ID:184499', NULL, NULL, '2017-04-27 03:49:08'),
(539, 1, '03422000351', 'Respected parents,Syedah Raima  is present today. Attendance has been marked.', 'OK ID:184500', NULL, NULL, '2017-04-27 03:49:13'),
(540, 1, '03440097626', 'Respected parents,Zahoor Ahmad is present today. Attendance has been marked.', 'OK ID:184501', NULL, NULL, '2017-04-27 03:49:15'),
(541, 1, '03332261654', 'Respected parents,SYEDAH EMAAN is present today. Attendance has been marked.', 'OK ID:184502', NULL, NULL, '2017-04-27 03:49:33'),
(542, 1, '03472004413', 'Respected parents,HASEENA KANWAL is present today. Attendance has been marked.', 'OK ID:184503', NULL, NULL, '2017-04-27 03:49:36'),
(543, 1, '03452170378', 'Respected parents,Syedah Wajeha is present today. Attendance has been marked.', 'OK ID:184504', NULL, NULL, '2017-04-27 03:49:38'),
(544, 1, '03432003183', 'Respected parents,Maryyam Qasim is present today. Attendance has been marked.', 'OK ID:184505', NULL, NULL, '2017-04-27 03:49:48'),
(545, 1, '03432003183', 'Respected parents,Asim Abbasi is present today. Attendance has been marked.', 'OK ID:184506', NULL, NULL, '2017-04-27 03:49:50'),
(546, 1, '03333021286', 'Respected parents,Abdullah is present today. Attendance has been marked.', 'OK ID:184507', NULL, NULL, '2017-04-27 03:49:50'),
(547, 1, '03433351845', 'Respected parents,Muhammad Ismail is present today. Attendance has been marked.', 'OK ID:184508', NULL, NULL, '2017-04-27 03:49:59'),
(548, 1, '03453956174', 'Respected parents,SYEDAH MANAHIL is present today. Attendance has been marked.', 'OK ID:184509', NULL, NULL, '2017-04-27 03:50:14'),
(549, 1, '03422000351', 'Respected parents,Syed Suleman Shah  is present today. Attendance has been marked.', 'OK ID:184510', NULL, NULL, '2017-04-27 03:50:23'),
(550, 1, '03158361693', 'Respected parents,Syedah Bisma Shah is present today. Attendance has been marked.', 'OK ID:184511', NULL, NULL, '2017-04-27 03:50:24'),
(551, 1, '03158361693', 'Respected parents,Syed Zohaib Shah is present today. Attendance has been marked.', 'OK ID:184512', NULL, NULL, '2017-04-27 03:50:25'),
(552, 1, '03333021286', 'Respected parents,Muhammad nasir khan is present today. Attendance has been marked.', 'OK ID:184513', NULL, NULL, '2017-04-27 03:50:26'),
(553, 1, '03332362260', 'Respected parents,Shenella is present today. Attendance has been marked.', 'OK ID:184514', NULL, NULL, '2017-04-27 03:50:26'),
(554, 1, '03158361693', 'Attention: Syedah Isma Shah  is absent from School today, please submit the reason of absence at office.', 'OK ID:184515', NULL, NULL, '2017-04-27 03:51:22'),
(555, 1, '03332261654', 'Respected parents,SYEDAH SHAAMIA is present today. Attendance has been marked.', 'OK ID:184516', NULL, NULL, '2017-04-27 03:51:36'),
(556, 1, '03422000351', 'Respected parents,Syedah Arfa is present today. Attendance has been marked.', 'OK ID:184517', NULL, NULL, '2017-04-27 03:51:41'),
(557, 1, '03452170378', 'Respected parents,Syedah Huma is present today. Attendance has been marked.', 'OK ID:184518', NULL, NULL, '2017-04-27 03:51:43'),
(558, 1, '03022087457', 'Respected parents,Iqra Azeem is present today. Attendance has been marked.', 'OK ID:184519', NULL, NULL, '2017-04-27 03:51:44'),
(559, 1, '03433351845', 'Respected parents,Muhammad Ibraheem is present today. Attendance has been marked.', 'OK ID:184520', NULL, NULL, '2017-04-27 03:51:49'),
(560, 1, '03422000351', 'Respected parents,Syed Abdul Wahid Shah is present today. Attendance has been marked.', 'OK ID:184521', NULL, NULL, '2017-04-27 03:52:04'),
(561, 1, '03422000351', 'Respected parents,Syedah Ayesha  is present today. Attendance has been marked.', 'OK ID:184522', NULL, NULL, '2017-04-27 03:52:06'),
(562, 1, '03422000351', 'Respected parents,Syeda Fatima is present today. Attendance has been marked.', 'OK ID:184523', NULL, NULL, '2017-04-27 03:52:15'),
(563, 1, '03433220758', 'Respected parents,Farooq Shah is present today. Attendance has been marked.', 'OK ID:184524', NULL, NULL, '2017-04-27 03:52:20'),
(564, 1, '03453950443', 'Respected parents,Laiba is present today. Attendance has been marked.', 'OK ID:184525', NULL, NULL, '2017-04-27 03:52:22'),
(565, 1, '03422316390', 'Respected parents,Syed Asad Shah is present today. Attendance has been marked.', 'OK ID:184526', NULL, NULL, '2017-04-27 03:52:31'),
(566, 1, '03422316390', 'Respected parents,Syedah Khadeeja is present today. Attendance has been marked.', 'OK ID:184527', NULL, NULL, '2017-04-27 03:52:44'),
(567, 1, '03433351845', 'Respected parents,Kanwal Naeem is present today. Attendance has been marked.', 'OK ID:184528', NULL, NULL, '2017-04-27 03:52:46'),
(568, 1, '03432003571', 'Respected parents,Syedah Nadia is present today. Attendance has been marked.', 'OK ID:184529', NULL, NULL, '2017-04-27 03:52:55'),
(569, 1, '03452823753', 'Respected parents,LAIBA AYOOB is present today. Attendance has been marked.', 'OK ID:184530', NULL, NULL, '2017-04-27 03:53:00'),
(570, 1, '03462413564', 'Respected parents,Syed Ammad Shah is present today. Attendance has been marked.', 'OK ID:184531', NULL, NULL, '2017-04-27 03:53:12'),
(571, 1, '03471676157', 'Respected parents,Syedah Adeeba is present today. Attendance has been marked.', 'OK ID:184532', NULL, NULL, '2017-04-27 03:53:16'),
(572, 1, '03422000351', 'Respected parents,Syedah Manahil is present today. Attendance has been marked.', 'OK ID:184533', NULL, NULL, '2017-04-27 03:53:18'),
(573, 1, '03432247790', 'Respected parents,Shoukat Ali is present today. Attendance has been marked.', 'OK ID:184534', NULL, NULL, '2017-04-27 03:53:27'),
(574, 1, '03312199285', 'Respected parents,Muhammad Shah is present today. Attendance has been marked.', 'OK ID:184535', NULL, NULL, '2017-04-27 03:53:28'),
(575, 1, '03452477414', 'Respected parents,Bareera is present today. Attendance has been marked.', 'OK ID:184536', NULL, NULL, '2017-04-27 03:53:33'),
(576, 1, '03433220758', 'Respected parents,Rehman shah is present today. Attendance has been marked.', 'OK ID:184537', NULL, NULL, '2017-04-27 03:53:35'),
(577, 1, '03353408405', 'Respected parents,Muhammad Raees Ameer is present today. Attendance has been marked.', 'OK ID:184538', NULL, NULL, '2017-04-27 03:53:35'),
(578, 1, '03151049622', 'Respected parents,Zarnain Khan is present today. Attendance has been marked.', 'OK ID:184539', NULL, NULL, '2017-04-27 03:53:37'),
(579, 1, '03456045732', 'Respected parents,Syed Hassan Shah is present today. Attendance has been marked.', 'OK ID:184540', NULL, NULL, '2017-04-27 03:53:40'),
(580, 1, '03453956174', 'Respected parents,SYED HASEEB SHAH is present today. Attendance has been marked.', 'OK ID:184541', NULL, NULL, '2017-04-27 03:53:59'),
(581, 1, '03170215022', 'Respected parents,SYEDAH ROMAISA is present today. Attendance has been marked.', 'OK ID:184542', NULL, NULL, '2017-04-27 03:54:01'),
(582, 1, '03333243397', 'Respected parents,Syedah Noor E Adan is present today. Attendance has been marked.', 'OK ID:184543', NULL, NULL, '2017-04-27 03:54:01'),
(583, 1, '03158361693', 'Respected parents,Syed JahanZaib Shah is present today. Attendance has been marked.', 'OK ID:184544', NULL, NULL, '2017-04-27 03:54:02'),
(584, 1, '03333021286', 'Respected parents,M Shayan Khan is present today. Attendance has been marked.', 'OK ID:184545', NULL, NULL, '2017-04-27 03:54:03'),
(585, 1, '03432247790', 'Respected parents,Saniya Bibi is present today. Attendance has been marked.', 'OK ID:184546', NULL, NULL, '2017-04-27 03:54:05'),
(586, 1, '03432003183', 'Respected parents,Tamanna is present today. Attendance has been marked.', 'OK ID:184547', NULL, NULL, '2017-04-27 03:54:07'),
(587, 1, '03323159062', 'Respected parents,Zainab is present today. Attendance has been marked.', 'OK ID:184548', NULL, NULL, '2017-04-27 03:54:07'),
(588, 1, '03323159062', 'Respected parents,Muhammad Ayan is present today. Attendance has been marked.', 'OK ID:184549', NULL, NULL, '2017-04-27 03:54:08'),
(589, 1, '03440097626', 'Respected parents,Mehmood Ahmad is present today. Attendance has been marked.', 'OK ID:184550', NULL, NULL, '2017-04-27 03:54:14'),
(590, 1, '03451245325', 'Respected parents,Yasir is present today. Attendance has been marked.', 'OK ID:184551', NULL, NULL, '2017-04-27 03:54:23'),
(591, 1, '03453956174', 'Respected parents,SYED HASEEB SHAH is present today. Attendance has been marked.', 'OK ID:184552', NULL, NULL, '2017-04-27 03:54:28'),
(592, 1, '03170215022', 'Respected parents,SYEDAH ROMAISA is present today. Attendance has been marked.', 'OK ID:184553', NULL, NULL, '2017-04-27 03:54:30'),
(593, 1, '03333243397', 'Respected parents,Syedah Noor E Adan is present today. Attendance has been marked.', 'OK ID:184554', NULL, NULL, '2017-04-27 03:54:30'),
(594, 1, '03158361693', 'Respected parents,Syed JahanZaib Shah is present today. Attendance has been marked.', 'OK ID:184555', NULL, NULL, '2017-04-27 03:54:31'),
(595, 1, '03333021286', 'Respected parents,M Shayan Khan is present today. Attendance has been marked.', 'OK ID:184556', NULL, NULL, '2017-04-27 03:54:32'),
(596, 1, '03432247790', 'Respected parents,Saniya Bibi is present today. Attendance has been marked.', 'OK ID:184557', NULL, NULL, '2017-04-27 03:54:37'),
(597, 1, '03432003183', 'Respected parents,Tamanna is present today. Attendance has been marked.', 'OK ID:184558', NULL, NULL, '2017-04-27 03:54:39'),
(598, 1, '03323159062', 'Respected parents,Zainab is present today. Attendance has been marked.', 'OK ID:184559', NULL, NULL, '2017-04-27 03:54:40'),
(599, 1, '03323159062', 'Respected parents,Muhammad Ayan is present today. Attendance has been marked.', 'OK ID:184560', NULL, NULL, '2017-04-27 03:54:40'),
(600, 1, '03440097626', 'Respected parents,Mehmood Ahmad is present today. Attendance has been marked.', 'OK ID:184561', NULL, NULL, '2017-04-27 03:54:45'),
(601, 1, '03451245325', 'Respected parents,Yasir is present today. Attendance has been marked.', 'OK ID:184562', NULL, NULL, '2017-04-27 03:54:47'),
(602, 1, '03408883742', 'Attention: Maleeha  is absent from School today, please submit the cause of absence at office.', 'OK ID:184563', NULL, NULL, '2017-04-27 03:55:33'),
(603, 1, '03453950342', 'Attention: Muhammad Umair  is absent from School today, please submit the cause of absence at office.', 'OK ID:184564', NULL, NULL, '2017-04-27 03:56:04'),
(604, 1, '03022834618', 'Attention: Muhammad Safeer Khan  is absent from School today, please submit the cause of absence at office.', 'OK ID:184565', NULL, NULL, '2017-04-27 03:56:12'),
(605, 1, '03333021286', 'Attention: Marwah bibi  is absent from School today, please submit the cause of absence at office.', 'OK ID:184566', NULL, NULL, '2017-04-27 03:56:13'),
(606, 1, '03408883742', 'Attention: Zobia  is absent from School today, please submit the cause of absence at office.', 'OK ID:184567', NULL, NULL, '2017-04-27 03:56:15'),
(607, 1, '03408883742', 'Attention: Husna  is absent from School today, please submit the cause of absence at office.', 'OK ID:184568', NULL, NULL, '2017-04-27 03:56:20'),
(608, 1, '03170215022', 'Respected parents,SYED SUHAAM SHAH is present today. Attendance has been marked.', 'OK ID:184569', NULL, NULL, '2017-04-27 03:56:31'),
(609, 1, '03333243397', 'Respected parents,Syedah Tayyaba is present today. Attendance has been marked.', 'OK ID:184570', NULL, NULL, '2017-04-27 03:56:32'),
(610, 1, '03422316390', 'Respected parents,Syedah Zunaira is present today. Attendance has been marked.', 'OK ID:184571', NULL, NULL, '2017-04-27 03:56:37'),
(611, 1, '03462413564', 'Respected parents,Syed Fahad Shah is present today. Attendance has been marked.', 'OK ID:184572', NULL, NULL, '2017-04-27 03:56:39'),
(612, 1, '03471676157', 'Respected parents,Syed Ayan Shah is present today. Attendance has been marked.', 'OK ID:184573', NULL, NULL, '2017-04-27 03:56:47'),
(613, 1, '03422000351', 'Respected parents,Syed Saud Shah is present today. Attendance has been marked.', 'OK ID:184574', NULL, NULL, '2017-04-27 03:56:52'),
(614, 1, '03452170378', 'Respected parents,Syedah Onaisa  is present today. Attendance has been marked.', 'OK ID:184575', NULL, NULL, '2017-04-27 03:56:54'),
(615, 1, '03432003183', 'Respected parents,Aqsa Qasim is present today. Attendance has been marked.', 'OK ID:184576', NULL, NULL, '2017-04-27 03:57:03'),
(616, 1, '03432003183', 'Respected parents,Noor Fatima is present today. Attendance has been marked.', 'OK ID:184577', NULL, NULL, '2017-04-27 03:57:08'),
(617, 1, '03158361693', 'Respected parents,Syedah Asma Shah is present today. Attendance has been marked.', 'OK ID:184578', NULL, NULL, '2017-04-27 03:57:11'),
(618, 1, '03482072766', 'Respected parents,Muhammad Khizer  is present today. Attendance has been marked.', 'OK ID:184579', NULL, NULL, '2017-04-27 03:57:16'),
(619, 1, '03452962248', 'Respected parents,Sayyamullah is present today. Attendance has been marked.', 'OK ID:184580', NULL, NULL, '2017-04-27 03:57:18'),
(620, 1, '03333021286', 'Respected parents,M Tayyab khan is present today. Attendance has been marked.', 'OK ID:184581', NULL, NULL, '2017-04-27 03:57:19'),
(621, 1, '03432247790', 'Respected parents,Laiba bibi is present today. Attendance has been marked.', 'OK ID:184582', NULL, NULL, '2017-04-27 03:57:24'),
(622, 1, '03043823703', 'Respected parents,Gul Sher is present today. Attendance has been marked.', 'OK ID:184583', NULL, NULL, '2017-04-27 03:57:25'),
(623, 1, '03012968106', 'Respected parents,Muhammad Aamir is present today. Attendance has been marked.', 'OK ID:184584', NULL, NULL, '2017-04-27 03:57:25'),
(624, 1, '03322752599', 'Respected parents,Abdul Wasay is present today. Attendance has been marked.', 'OK ID:184585', NULL, NULL, '2017-04-27 03:57:26'),
(625, 1, '03452962248', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:184586', NULL, NULL, '2017-04-27 03:57:35'),
(626, 1, '03452962248', 'Respected parents,Hasnain Muawiya is present today. Attendance has been marked.', 'OK ID:184587', NULL, NULL, '2017-04-27 03:57:40'),
(627, 1, '03452477414', 'Respected parents,Fareeha is present today. Attendance has been marked.', 'OK ID:184588', NULL, NULL, '2017-04-27 03:57:42'),
(628, 1, '03022087457', 'Respected parents,Anas Azeem is present today. Attendance has been marked.', 'OK ID:184589', NULL, NULL, '2017-04-27 03:57:43'),
(629, 1, '03333325771', 'Respected parents,Shah Zain is present today. Attendance has been marked.', 'OK ID:184590', NULL, NULL, '2017-04-27 03:57:43'),
(630, 1, '03333325771', 'Respected parents,Wajeha is present today. Attendance has been marked.', 'OK ID:184591', NULL, NULL, '2017-04-27 03:57:44'),
(631, 1, '03412218933', 'Respected parents,Subhan Khan is present today. Attendance has been marked.', 'OK ID:184592', NULL, NULL, '2017-04-27 03:57:49'),
(632, 1, '03333036904', 'Respected parents,Talha Abbasi is present today. Attendance has been marked.', 'OK ID:184593', NULL, NULL, '2017-04-27 03:57:49'),
(633, 1, '03433220758', 'Respected parents,Rizwan Shah is present today. Attendance has been marked.', 'OK ID:184594', NULL, NULL, '2017-04-27 03:57:51'),
(634, 1, '03462895129', 'Respected parents,Manahil is present today. Attendance has been marked.', 'OK ID:184595', NULL, NULL, '2017-04-27 03:57:56'),
(635, 1, '03152686240', 'Respected parents,Muhammad Zaid is present today. Attendance has been marked.', 'OK ID:184596', NULL, NULL, '2017-04-27 03:57:58'),
(636, 1, '03432247790', 'Respected parents,Abdul Samad is present today. Attendance has been marked.', 'OK ID:184597', NULL, NULL, '2017-04-27 03:58:07'),
(637, 1, '03408883742', 'Respected parents,Maaz is present today. Attendance has been marked.', 'OK ID:184598', NULL, NULL, '2017-04-27 03:58:12'),
(638, 1, '03102904250', 'Respected parents,Muhammad Huzaifa is present today. Attendance has been marked.', 'OK ID:184599', NULL, NULL, '2017-04-27 03:58:14'),
(639, 1, '03440097626', 'Respected parents,Maaz Ahmad is present today. Attendance has been marked.', 'OK ID:184600', NULL, NULL, '2017-04-27 03:58:15'),
(640, 1, '03456045732', 'Respected parents,Saniya BiBi is present today. Attendance has been marked.', 'OK ID:184601', NULL, NULL, '2017-04-27 03:58:20'),
(641, 1, '03482321324', 'Respected parents,Salaar Khan is present today. Attendance has been marked.', 'OK ID:184602', NULL, NULL, '2017-04-27 03:58:22'),
(642, 1, '03333245567', 'Respected parents,Muhammad Hammad is present today. Attendance has been marked.', 'OK ID:184603', NULL, NULL, '2017-04-27 03:58:23'),
(643, 1, '03242231369', 'Thank you  for fees submission.\r\nInvoice# :1704151\r\nGrand Total :2390.00\r\nRecieved Amount :2390.00\r\nReturned Amount :0\r\n', 'OK ID:184735', NULL, NULL, '2017-04-27 09:48:01'),
(644, 1, '03242231369', 'Thank you  for fees submission.\r\nInvoice# :1704154\r\nGrand Total :2010.00\r\nRecieved Amount :2010.00\r\nReturned Amount :0\r\n', 'OK ID:184736', NULL, NULL, '2017-04-27 09:49:26'),
(645, 1, '03453950443', 'Thank you  for fees submission.\r\nInvoice# :1704157\r\nGrand Total :590.00\r\nRecieved Amount :590.00\r\nReturned Amount :0\r\n', 'OK ID:185836', NULL, NULL, '2017-04-29 03:08:45'),
(646, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704159\r\nGrand Total :527.00\r\nRecieved Amount :527.00\r\nReturned Amount :0\r\n', 'OK ID:186555', NULL, NULL, '2017-04-29 14:10:31'),
(647, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704160\r\nGrand Total :2078.00\r\nRecieved Amount :2078.00\r\nReturned Amount :0\r\n', 'OK ID:186556', NULL, NULL, '2017-04-29 14:11:42'),
(648, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704162\r\nGrand Total :1796.00\r\nRecieved Amount :1796.00\r\nReturned Amount :0\r\n', 'OK ID:186557', NULL, NULL, '2017-04-29 14:12:56'),
(649, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704164\r\nGrand Total :1796.00\r\nRecieved Amount :1796.00\r\nReturned Amount :0\r\n', 'OK ID:186558', NULL, NULL, '2017-04-29 14:13:58'),
(650, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704166\r\nGrand Total :1796.00\r\nRecieved Amount :1796.00\r\nReturned Amount :0\r\n', 'OK ID:186559', NULL, NULL, '2017-04-29 14:15:59'),
(651, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704168\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:186560', NULL, NULL, '2017-04-29 14:19:36'),
(652, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704169\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:186561', NULL, NULL, '2017-04-29 14:20:29'),
(653, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704170\r\nGrand Total :900.00\r\nRecieved Amount :900.00.00\r\nReturned Amount :0\r\n', 'OK ID:186562', NULL, NULL, '2017-04-29 14:21:05'),
(654, 1, '03432003183', 'Thank you  for fees submission.\r\nInvoice# :1704171\r\nGrand Total :900.00\r\nRecieved Amount :900.00.00\r\nReturned Amount :0\r\n', 'OK ID:186563', NULL, NULL, '2017-04-29 14:21:35'),
(655, 1, '03412469488', 'Thank you  for fees submission.\r\nInvoice# :1705172\r\nGrand Total :2380.00\r\nRecieved Amount :2380.00\r\nReturned Amount :0\r\n', 'OK ID:190084', NULL, NULL, '2017-05-03 07:22:57'),
(656, 1, '03462895129', 'Thank you  for fees submission.\r\nInvoice# :1705176\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', 'OK ID:190192', NULL, NULL, '2017-05-04 06:14:34'),
(657, 1, '03322752599', 'Thank you  for fees submission.\r\nInvoice# :1705178\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:190210', NULL, NULL, '2017-05-04 08:36:31'),
(658, 1, '03433351845', 'Thank you  for fees submission.\r\nInvoice# :1705181\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:193674', NULL, NULL, '2017-05-06 04:48:27'),
(659, 1, '03152686240', 'Thank you  for fees submission.\r\nInvoice# :1705182\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:193677', NULL, NULL, '2017-05-06 06:52:18'),
(660, 1, '03440097626', 'Thank you  for fees submission.\r\nInvoice# :1705183\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', 'OK ID:193698', NULL, NULL, '2017-05-06 14:07:06'),
(661, 1, '03440097626', 'Thank you  for fees submission.\r\nInvoice# :1705185\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', 'OK ID:193699', NULL, NULL, '2017-05-06 14:08:13'),
(662, 1, '03440097626', 'Thank you  for fees submission.\r\nInvoice# :1705187\r\nGrand Total :2490.00\r\nRecieved Amount :2490.00\r\nReturned Amount :0\r\n', 'OK ID:193700', NULL, NULL, '2017-05-06 14:15:55'),
(663, 1, '03408883742', 'Thank you  for fees submission.\r\nInvoice# :1705189\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:193914', NULL, NULL, '2017-05-08 04:16:26'),
(664, 1, '03408883742', 'Thank you  for fees submission.\r\nInvoice# :1705190\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:193918', NULL, NULL, '2017-05-08 04:19:21'),
(665, 1, '03433220758', 'Thank you  for fees submission.\r\nInvoice# :1705191\r\nGrand Total :1800.00\r\nRecieved Amount :1800.00\r\nReturned Amount :0\r\n', 'OK ID:194062', NULL, NULL, '2017-05-08 19:10:53'),
(666, 1, '03433220758', 'Thank you  for fees submission.\r\nInvoice# :1705193\r\nGrand Total :1800.00\r\nRecieved Amount :1800.00\r\nReturned Amount :0\r\n', 'OK ID:194063', NULL, NULL, '2017-05-08 19:14:39'),
(667, 1, '03433220758', 'Thank you  for fees submission.\r\nInvoice# :1705195\r\nGrand Total :1800.00\r\nRecieved Amount :1800.00\r\nReturned Amount :0\r\n', 'OK ID:194064', NULL, NULL, '2017-05-08 19:15:35'),
(668, 1, '03452962248', 'Thank you  for fees submission.\r\nInvoice# :1705197\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:194124', NULL, NULL, '2017-05-09 04:09:39'),
(669, 1, '03452962248', 'Thank you  for fees submission.\r\nInvoice# :1705198\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:194125', NULL, NULL, '2017-05-09 04:10:20'),
(670, 1, '03452962248', 'Thank you  for fees submission.\r\nInvoice# :1705199\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:194126', NULL, NULL, '2017-05-09 04:11:30'),
(671, 1, '03453950342', 'Thank you  for fees submission.\r\nInvoice# :1705200\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:194226', NULL, NULL, '2017-05-09 07:09:42'),
(672, 1, '03102904250', 'Thank you  for fees submission.\r\nInvoice# :1705201\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', '10: Error! SMS Sendi', NULL, NULL, '2017-05-10 02:52:43'),
(673, 1, '03456045732', 'Thank you  for fees submission.\r\nInvoice# :1705202\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', '10: Error! SMS Sendi', NULL, NULL, '2017-05-10 02:56:16'),
(674, 1, '03456045732', 'Thank you  for fees submission.\r\nInvoice# :1705203\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', '10: Error! SMS Sendi', NULL, NULL, '2017-05-10 02:57:56'),
(675, 1, '03412218933', 'Thank you  for fees submission.\r\nInvoice# :1705204\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', '10: Error! SMS Sendi', NULL, NULL, '2017-05-10 03:02:10'),
(676, 1, '03452421607', 'Thank you  for fees submission.\r\nInvoice# :1705205\r\nGrand Total :2900.00\r\nRecieved Amount :2900.00\r\nReturned Amount :0\r\n', 'OK ID:195082', NULL, NULL, '2017-05-10 07:19:33'),
(677, 1, '03452421607', 'Thank you  for fees submission.\r\nInvoice# :1705208\r\nGrand Total :2790.00\r\nRecieved Amount :2790.00\r\nReturned Amount :0\r\n', 'OK ID:195083', NULL, NULL, '2017-05-10 07:20:35'),
(678, 1, '03462895129', 'Thank you  for fees submission.\r\nInvoice# :1705211\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:195213', NULL, NULL, '2017-05-11 04:03:02'),
(679, 1, '03323159062', 'Thank you  for fees submission.\r\nInvoice# :1705212\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:195214', NULL, NULL, '2017-05-11 04:12:25'),
(680, 1, '03323159062', 'Thank you  for fees submission.\r\nInvoice# :1705213\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:195215', NULL, NULL, '2017-05-11 04:13:06'),
(681, 1, '03453950443', 'Thank you  for fees submission.\r\nInvoice# :1705214\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:195216', NULL, NULL, '2017-05-11 04:14:14'),
(682, 1, '03333245567', 'Thank you  for fees submission.\r\nInvoice# :1705215\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:195219', NULL, NULL, '2017-05-11 04:56:55'),
(683, 1, '03432003571', 'Thank you  for fees submission.\r\nInvoice# :1705216\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:196554', NULL, NULL, '2017-05-11 09:40:06'),
(684, 1, '03333036904', 'Thank you  for fees submission.\r\nInvoice# :1705217\r\nGrand Total :1800.00\r\nRecieved Amount :1800.00\r\nReturned Amount :0\r\n', 'OK ID:197318', NULL, NULL, '2017-05-13 03:57:23'),
(685, 1, '03482321324', 'Thank you  for fees submission.\r\nInvoice# :1705219\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:197448', NULL, NULL, '2017-05-13 07:15:11'),
(686, 1, '03408883742', 'Thank you  for fees submission.\r\nInvoice# :1705220\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:199338', NULL, NULL, '2017-05-16 04:05:11'),
(687, 1, '03408883742', 'Thank you  for fees submission.\r\nInvoice# :1705221\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:199339', NULL, NULL, '2017-05-16 04:05:45'),
(688, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1705222\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201037', NULL, NULL, '2017-05-17 04:22:08'),
(689, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1705223\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201046', NULL, NULL, '2017-05-17 04:23:12'),
(690, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1705224\r\nGrand Total :800.00\r\nRecieved Amount :800.00\r\nReturned Amount :0\r\n', 'OK ID:201090', NULL, NULL, '2017-05-17 04:42:27'),
(691, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1705225\r\nGrand Total :800.00\r\nRecieved Amount :800.00\r\nReturned Amount :0\r\n', 'OK ID:201092', NULL, NULL, '2017-05-17 04:42:52'),
(692, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1705226\r\nGrand Total :800.00\r\nRecieved Amount :800.00\r\nReturned Amount :0\r\n', 'OK ID:201094', NULL, NULL, '2017-05-17 04:43:16'),
(693, 1, '03158361693', 'Thank you  for fees submission.\r\nInvoice# :1705227\r\nGrand Total :800.00\r\nRecieved Amount :800.00\r\nReturned Amount :0\r\n', 'OK ID:201096', NULL, NULL, '2017-05-17 04:43:46'),
(694, 1, '03333325771', 'Thank you  for fees submission.\r\nInvoice# :1705228\r\nGrand Total :1800.00\r\nRecieved Amount :1800.00\r\nReturned Amount :0\r\n', 'OK ID:201097', NULL, NULL, '2017-05-17 04:45:29'),
(695, 1, '03333325771', 'Thank you  for fees submission.\r\nInvoice# :1705230\r\nGrand Total :1800.00\r\nRecieved Amount :1800.00\r\nReturned Amount :0\r\n', 'OK ID:201099', NULL, NULL, '2017-05-17 04:46:34'),
(696, 1, '03451245325', 'Thank you  for fees submission.\r\nInvoice# :1705232\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201100', NULL, NULL, '2017-05-17 04:47:05'),
(697, 1, '03333021286', 'Thank you  for fees submission.\r\nInvoice# :1705233\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201105', NULL, NULL, '2017-05-17 04:52:32'),
(698, 1, '03333021286', 'Thank you  for fees submission.\r\nInvoice# :1705234\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201106', NULL, NULL, '2017-05-17 04:53:19'),
(699, 1, '03333021286', 'Thank you  for fees submission.\r\nInvoice# :1705235\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201107', NULL, NULL, '2017-05-17 04:53:54'),
(700, 1, '03333021286', 'Thank you  for fees submission.\r\nInvoice# :1705236\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201108', NULL, NULL, '2017-05-17 04:54:42'),
(701, 1, '03432247790', 'Thank you  for fees submission.\r\nInvoice# :1705237\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201109', NULL, NULL, '2017-05-17 05:02:38'),
(702, 1, '03432247790', 'Thank you  for fees submission.\r\nInvoice# :1705238\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:201110', NULL, NULL, '2017-05-17 05:03:47'),
(703, 1, '03043823703', 'Thank you  for fees submission.\r\nInvoice# :1705239\r\nGrand Total :1800.00\r\nRecieved Amount :1800.00\r\nReturned Amount :0\r\n', 'OK ID:202405', NULL, NULL, '2017-05-19 04:52:14'),
(704, 1, '03333245567', 'Thank you  for fees submission.\r\nInvoice# :1705241\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:202407', NULL, NULL, '2017-05-19 04:53:15'),
(705, 1, '03333021286', 'Thank you  for fees submission.\r\nInvoice# :1705242\r\nGrand Total :500.00\r\nRecieved Amount :500.00\r\nReturned Amount :0\r\n', 'OK ID:202576', NULL, NULL, '2017-05-19 08:24:52'),
(706, 1, '03353408405', 'Thank you  for fees submission.\r\nInvoice# :1705243\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:202685', NULL, NULL, '2017-05-20 03:22:20'),
(707, 1, '03322752599', 'Thank you  for fees submission.\r\nInvoice# :1705244\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:203047', NULL, NULL, '2017-05-22 03:38:25'),
(708, 1, '03170215022', 'Thank you  for fees submission.\r\nInvoice# :1705245\r\nGrand Total :1880.00\r\nRecieved Amount :1880.00\r\nReturned Amount :0\r\n', 'OK ID:203287', NULL, NULL, '2017-05-22 14:33:16'),
(709, 1, '03412218933', 'Thank you  for fees submission.\r\nInvoice# :1705249\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:203310', NULL, NULL, '2017-05-23 03:18:18'),
(710, 1, '03452962248', 'Thank you  for fees submission.\r\nInvoice# :1705250\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:203678', NULL, NULL, '2017-05-24 04:10:24'),
(711, 1, '03452962248', 'Thank you  for fees submission.\r\nInvoice# :1705251\r\nGrand Total :930.00\r\nRecieved Amount :930.00\r\nReturned Amount :0\r\n', 'OK ID:203679', NULL, NULL, '2017-05-24 04:11:12'),
(712, 1, '03452962248', 'Thank you  for fees submission.\r\nInvoice# :1705253\r\nGrand Total :900.00\r\nRecieved Amount :900.00.00\r\nReturned Amount :0\r\n', 'OK ID:203680', NULL, NULL, '2017-05-24 04:11:42'),
(713, 1, '03312199285', 'Thank you  for fees submission.\r\nInvoice# :1705254\r\nGrand Total :1800.00\r\nRecieved Amount :1800.00\r\nReturned Amount :0\r\n', 'OK ID:204024', NULL, NULL, '2017-05-25 03:56:05'),
(714, 1, '', 'Thank you  for fees submission.\r\nInvoice# :1705256\r\nGrand Total :980.00\r\nRecieved Amount :980.00\r\nReturned Amount :0\r\n', '5 : Please Type Rece', NULL, NULL, '2017-05-25 03:58:33'),
(715, 1, '03333325771', 'Thank you  for fees submission.\r\nInvoice# :1705257\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:204025', NULL, NULL, '2017-05-25 04:00:17'),
(716, 1, '03333325771', 'Thank you  for fees submission.\r\nInvoice# :1705258\r\nGrand Total :900.00\r\nRecieved Amount :900.00\r\nReturned Amount :0\r\n', 'OK ID:204027', NULL, NULL, '2017-05-25 04:01:54'),
(717, 1, '03012968106', 'Thank you  for fees submission.\r\nInvoice# :1705259\r\nGrand Total :1820.00\r\nRecieved Amount :1820.00\r\nReturned Amount :0\r\n', 'OK ID:204055', NULL, NULL, '2017-05-25 04:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `sms_setting`
--

CREATE TABLE `sms_setting` (
  `id_setting` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `school_name` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `admission` int(11) NOT NULL DEFAULT '2',
  `admission_msg` varchar(612) NOT NULL,
  `absent` int(11) NOT NULL DEFAULT '2',
  `absent_msg` varchar(612) NOT NULL,
  `examcreation` int(11) NOT NULL DEFAULT '2',
  `examcreation_msg` varchar(612) NOT NULL,
  `examresults` int(11) NOT NULL DEFAULT '2',
  `examresults_msg` varchar(612) NOT NULL,
  `feedates` int(11) NOT NULL DEFAULT '2',
  `feedates_msg` varchar(612) NOT NULL,
  `events` int(11) NOT NULL DEFAULT '2',
  `events_msg` varchar(612) NOT NULL,
  `onlineenquiry` int(11) NOT NULL DEFAULT '2',
  `feepayment` int(11) NOT NULL DEFAULT '2',
  `feepayment_msg` varchar(612) NOT NULL,
  `transportallocation` int(11) NOT NULL DEFAULT '2',
  `transportallocation_msg` varchar(612) NOT NULL,
  `assignment` int(11) NOT NULL DEFAULT '2',
  `assignment_msg` varchar(612) NOT NULL,
  `onlineenquiry_msg` varchar(612) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sms_setting`
--

INSERT INTO `sms_setting` (`id_setting`, `user_name`, `password`, `school_name`, `status`, `admission`, `admission_msg`, `absent`, `absent_msg`, `examcreation`, `examcreation_msg`, `examresults`, `examresults_msg`, `feedates`, `feedates_msg`, `events`, `events_msg`, `onlineenquiry`, `feepayment`, `feepayment_msg`, `transportallocation`, `transportallocation_msg`, `assignment`, `assignment_msg`, `onlineenquiry_msg`) VALUES
(2, '923453956174', 'sys', 'THE SKY FOUNDATION SCHOOLING SYSTEM', 1, 3, '', 3, 'Attention: #B# is absent from school today, please submit the reason of absence at school office.', 3, 'Respected parents #B# is present today. Attendance has been marked.', 0, '', 0, '', 3, '', 3, 3, '', 0, '', 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students_master_details`
--

CREATE TABLE `students_master_details` (
  `id_master_details` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `roll_no` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `class_start_time` time DEFAULT NULL,
  `class_end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `students_master_details`
--

INSERT INTO `students_master_details` (`id_master_details`, `registration_id`, `roll_no`, `class_id`, `shift_id`, `session_id`, `campus_id`, `class_start_time`, `class_end_time`) VALUES
(1, 1, 1, 39, 1, 1, 1, '07:45:00', '12:30:00'),
(2, 2, 1, 37, 1, 1, 1, '07:45:00', '12:30:00'),
(3, 3, 1, 35, 1, 1, 1, '07:45:00', '12:30:00'),
(4, 4, 1, 40, 1, 1, 1, '07:45:00', '12:30:00'),
(5, 5, 1, 38, 1, 1, 1, '07:45:00', '12:30:00'),
(6, 6, 2, 35, 1, 1, 1, '07:45:00', '12:30:00'),
(7, 7, 1, 34, 1, 1, 1, '07:45:00', '12:30:00'),
(9, 9, 2, 34, 1, 1, 1, NULL, NULL),
(10, 11, 3, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(11, 12, 4, 34, 1, 1, 1, NULL, NULL),
(12, 13, 5, 34, 1, 1, 1, NULL, NULL),
(13, 14, 6, 34, 1, 1, 1, NULL, NULL),
(14, 15, 7, 34, 1, 1, 1, NULL, NULL),
(15, 16, 8, 34, 1, 1, 1, NULL, NULL),
(16, 17, 9, 34, 1, 1, 1, NULL, NULL),
(17, 18, 10, 34, 1, 1, 1, NULL, NULL),
(18, 19, 11, 34, 1, 1, 1, NULL, NULL),
(19, 20, 12, 34, 1, 1, 1, NULL, NULL),
(20, 21, 13, 34, 1, 1, 1, NULL, NULL),
(21, 22, 14, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(22, 23, 15, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(23, 24, 16, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(24, 25, 17, 34, 1, 1, 1, NULL, NULL),
(25, 26, 18, 34, 1, 1, 1, NULL, NULL),
(26, 27, 19, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(27, 28, 20, 34, 1, 1, 1, NULL, NULL),
(28, 29, 21, 34, 1, 1, 1, NULL, NULL),
(29, 30, 22, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(30, 31, 23, 34, 1, 1, 1, NULL, NULL),
(31, 32, 24, 34, 1, 1, 1, NULL, NULL),
(32, 33, 25, 34, 1, 1, 1, NULL, NULL),
(33, 34, 26, 34, 1, 1, 1, NULL, NULL),
(34, 35, 27, 34, 1, 1, 1, NULL, NULL),
(35, 36, 28, 34, 1, 1, 1, NULL, NULL),
(36, 37, 29, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(37, 38, 30, 34, 1, 1, 1, NULL, NULL),
(38, 39, 31, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(39, 10, 3, 35, 1, 1, 1, '05:00:00', '05:00:00'),
(40, 40, 4, 35, 1, 1, 1, NULL, NULL),
(41, 41, 5, 35, 1, 1, 1, '05:00:00', '05:00:00'),
(42, 42, 6, 35, 1, 1, 1, '05:00:00', '05:00:00'),
(43, 43, 7, 35, 1, 1, 1, NULL, NULL),
(44, 44, 8, 35, 1, 1, 1, '07:45:00', '12:15:00'),
(45, 45, 9, 35, 1, 1, 1, NULL, NULL),
(46, 46, 1, 36, 1, 1, 1, NULL, NULL),
(47, 47, 2, 36, 1, 1, 1, NULL, NULL),
(48, 48, 3, 36, 1, 1, 1, NULL, NULL),
(49, 49, 1, 38, 1, 1, 1, '05:00:00', '05:00:00'),
(50, 50, 5, 36, 1, 1, 1, '05:00:00', '05:00:00'),
(51, 51, 6, 36, 1, 1, 1, NULL, NULL),
(52, 52, 7, 36, 1, 1, 1, '05:00:00', '05:00:00'),
(53, 53, 8, 36, 1, 1, 1, NULL, NULL),
(54, 54, 9, 36, 1, 1, 1, NULL, NULL),
(55, 55, 10, 36, 1, 1, 1, NULL, NULL),
(56, 56, 3, 37, 1, 1, 1, '05:00:00', '05:00:00'),
(57, 57, 4, 37, 1, 1, 1, NULL, NULL),
(58, 58, 5, 37, 1, 1, 1, '07:45:00', '12:15:00'),
(59, 59, 2, 38, 1, 1, 1, NULL, NULL),
(60, 60, 3, 38, 1, 1, 1, NULL, NULL),
(61, 61, 4, 38, 1, 1, 1, NULL, NULL),
(62, 62, 5, 38, 1, 1, 1, NULL, NULL),
(63, 63, 6, 38, 1, 1, 1, '05:00:00', '05:00:00'),
(64, 64, 7, 38, 1, 1, 1, NULL, NULL),
(65, 65, 8, 38, 1, 1, 1, NULL, NULL),
(66, 66, 9, 38, 1, 1, 1, NULL, NULL),
(67, 67, 2, 39, 1, 1, 1, NULL, NULL),
(68, 68, 3, 39, 1, 1, 1, NULL, NULL),
(69, 69, 4, 39, 1, 1, 1, NULL, NULL),
(70, 70, 5, 39, 1, 1, 1, '05:00:00', '05:00:00'),
(71, 71, 6, 39, 1, 1, 1, NULL, NULL),
(72, 72, 2, 40, 1, 1, 1, NULL, NULL),
(73, 73, 3, 40, 1, 1, 1, NULL, NULL),
(74, 74, 4, 40, 1, 1, 1, NULL, NULL),
(75, 75, 5, 40, 1, 1, 1, NULL, NULL),
(77, 76, 2, 41, 1, 1, 1, NULL, NULL),
(78, 77, 3, 41, 1, 1, 1, NULL, NULL),
(79, 78, 4, 41, 1, 1, 1, NULL, NULL),
(80, 79, 5, 41, 1, 1, 1, NULL, NULL),
(81, 8, 1, 42, 1, 1, 1, NULL, NULL),
(82, 80, 2, 42, 1, 1, 1, NULL, NULL),
(83, 81, 3, 42, 1, 1, 1, NULL, NULL),
(84, 82, 34, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(85, 83, 35, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(86, 84, 36, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(87, 85, 37, 34, 1, 1, 1, '05:00:00', '05:00:00'),
(88, 86, 38, 34, 1, 1, 1, NULL, NULL),
(89, 87, 10, 35, 1, 1, 1, '05:00:00', '05:00:00'),
(90, 88, 11, 35, 1, 1, 1, '05:00:00', '05:00:00'),
(91, 89, 12, 35, 1, 1, 1, '05:00:00', '05:00:00'),
(92, 90, 11, 36, 1, 1, 1, NULL, NULL),
(93, 93, 6, 41, 1, 1, 1, NULL, NULL),
(94, 91, 5, 37, 1, 1, 1, '05:00:00', '05:00:00'),
(95, 92, 6, 37, 1, 1, 1, NULL, NULL),
(96, 94, 7, 41, 1, 1, 1, '07:45:00', '12:15:00'),
(97, 95, 7, 40, 1, 1, 1, '07:45:00', '12:15:00'),
(98, 96, 13, 35, 1, 1, 1, '07:45:00', '12:15:00'),
(99, 97, 39, 34, 1, 1, 1, '07:45:00', '12:15:00'),
(100, 98, 12, 36, 1, 1, 1, '07:45:00', '12:15:00'),
(101, 99, 12, 36, 1, 1, 1, '02:30:00', '02:30:00'),
(102, 100, 40, 34, 1, 1, 1, '07:45:00', '12:15:00'),
(103, 101, 13, 36, 1, 1, 1, '07:45:00', '12:15:00'),
(104, 102, 41, 34, 1, 1, 1, '07:45:00', '12:15:00'),
(105, 103, 4, 42, 1, 1, 1, '07:45:00', '12:15:00'),
(106, 104, 14, 35, 1, 1, 1, '07:45:00', '12:15:00'),
(107, 105, 42, 34, 1, 1, 1, '07:45:00', '12:15:00'),
(108, 106, 43, 34, 1, 1, 1, '07:45:00', '12:15:00'),
(109, 107, 8, 37, 1, 1, 1, '07:45:00', '12:15:00'),
(110, 108, 1, 43, 1, 1, 1, '05:30:00', '05:30:00'),
(111, 109, 2, 43, 1, 1, 1, '05:30:00', '05:30:00'),
(112, 110, 44, 34, 1, 1, 1, '11:00:00', '11:00:00'),
(113, 111, 1, 43, 1, 1, 1, '07:45:00', '12:15:00'),
(114, 112, 1, 34, 1, 1, 1, '12:15:00', '12:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id_attendance` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `attendace_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id_attendance`, `registration_id`, `class_id`, `shift_id`, `campus_id`, `status`, `attendace_date`, `created_by`, `created_on`) VALUES
(1, 7, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:21'),
(2, 9, 34, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:34:21'),
(3, 11, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:21'),
(4, 12, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:21'),
(5, 13, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:21'),
(6, 14, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:21'),
(7, 15, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:22'),
(8, 16, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:22'),
(9, 17, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:22'),
(10, 18, 34, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:34:22'),
(11, 19, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:22'),
(12, 20, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:22'),
(13, 21, 34, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:34:22'),
(14, 22, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:23'),
(15, 23, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:23'),
(16, 24, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:23'),
(17, 25, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:23'),
(18, 26, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:23'),
(19, 27, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:23'),
(20, 28, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:23'),
(21, 29, 34, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:34:24'),
(22, 30, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:25'),
(23, 31, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:25'),
(24, 32, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:25'),
(25, 33, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:26'),
(26, 34, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:26'),
(27, 35, 34, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:34:26'),
(28, 36, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:26'),
(29, 37, 34, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:34:26'),
(30, 38, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:26'),
(31, 39, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:26'),
(32, 82, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:27'),
(33, 83, 34, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:34:27'),
(34, 84, 34, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:34:27'),
(35, 85, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:27'),
(36, 86, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:27'),
(37, 97, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:27'),
(38, 100, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:28'),
(39, 102, 34, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:34:28'),
(40, 3, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:08'),
(41, 6, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:08'),
(42, 10, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(43, 40, 35, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:36:09'),
(44, 41, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(45, 42, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(46, 43, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(47, 44, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(48, 45, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(49, 87, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(50, 88, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(51, 89, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(52, 96, 35, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:36:09'),
(53, 46, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:32'),
(54, 47, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:33'),
(55, 48, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:33'),
(56, 50, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:34'),
(57, 51, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:34'),
(58, 52, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:34'),
(59, 53, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:34'),
(60, 54, 36, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:37:34'),
(61, 55, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:34'),
(62, 90, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:34'),
(63, 98, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:34'),
(64, 101, 36, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:37:34'),
(65, 2, 37, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:38:32'),
(66, 56, 37, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:38:32'),
(67, 57, 37, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:38:33'),
(68, 58, 37, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:38:33'),
(69, 91, 37, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:38:33'),
(70, 92, 37, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:38:34'),
(71, 95, 37, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:38:34'),
(72, 5, 38, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:06'),
(73, 49, 38, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:39:06'),
(74, 59, 38, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:06'),
(75, 60, 38, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:06'),
(76, 61, 38, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:07'),
(77, 62, 38, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:39:07'),
(78, 63, 38, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:07'),
(79, 64, 38, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:07'),
(80, 65, 38, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:07'),
(81, 66, 38, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:08'),
(82, 1, 39, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:30'),
(83, 67, 39, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:30'),
(84, 68, 39, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:39:30'),
(85, 69, 39, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:39:30'),
(86, 70, 39, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:30'),
(87, 71, 39, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:31'),
(88, 4, 40, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:48'),
(89, 72, 40, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:48'),
(90, 73, 40, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:49'),
(91, 74, 40, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:49'),
(92, 75, 40, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:39:49'),
(93, 76, 41, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:40:15'),
(94, 77, 41, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:40:16'),
(95, 78, 41, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:40:16'),
(96, 79, 41, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:40:16'),
(97, 93, 41, 1, 1, 'A', '2017-04-25', 3, '2017-04-25 03:40:16'),
(98, 94, 41, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:40:16'),
(99, 8, 42, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:40:33'),
(100, 80, 42, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:40:37'),
(101, 81, 42, 1, 1, 'P', '2017-04-25', 3, '2017-04-25 03:40:39'),
(102, 2, 37, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 03:33:22'),
(103, 56, 37, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 03:33:22'),
(104, 57, 37, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 03:33:22'),
(105, 58, 37, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 03:33:22'),
(106, 91, 37, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 03:33:22'),
(107, 92, 37, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 03:33:22'),
(108, 95, 37, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 03:33:22'),
(109, 7, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:08'),
(110, 9, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:08'),
(111, 11, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:08'),
(112, 12, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:08'),
(113, 13, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(114, 14, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(115, 15, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(116, 16, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(117, 17, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(118, 18, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(119, 19, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(120, 20, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(121, 21, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:09'),
(122, 22, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:10'),
(123, 23, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:10'),
(124, 24, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:10'),
(125, 25, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:10'),
(126, 26, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:10'),
(127, 27, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:10'),
(128, 28, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(129, 29, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(130, 30, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(131, 31, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(132, 32, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(133, 33, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(134, 34, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(135, 35, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(136, 36, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(137, 37, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(138, 38, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:11'),
(139, 39, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(140, 82, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(141, 83, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(142, 84, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(143, 85, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(144, 86, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(145, 97, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(146, 100, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(147, 102, 34, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:14:12'),
(148, 3, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:23'),
(149, 6, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:23'),
(150, 10, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:23'),
(151, 40, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:23'),
(152, 41, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:23'),
(153, 42, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:23'),
(154, 43, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:23'),
(155, 44, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:23'),
(156, 45, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:24'),
(157, 87, 35, 1, 1, 'A', '2017-04-26', 3, '2017-04-26 04:15:24'),
(158, 88, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:24'),
(159, 89, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:24'),
(160, 96, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:24'),
(161, 104, 35, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:15:25'),
(162, 5, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:04'),
(163, 49, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:04'),
(164, 59, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:04'),
(165, 60, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:05'),
(166, 61, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:05'),
(167, 62, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:05'),
(168, 63, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:05'),
(169, 64, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:05'),
(170, 65, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:06'),
(171, 66, 38, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:06'),
(172, 46, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:57'),
(173, 47, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(174, 48, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(175, 50, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(176, 51, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(177, 52, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(178, 53, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(179, 54, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(180, 55, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(181, 90, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:58'),
(182, 98, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:59'),
(183, 101, 36, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:16:59'),
(184, 1, 39, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:17:38'),
(185, 67, 39, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:17:39'),
(186, 68, 39, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:17:39'),
(187, 69, 39, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:17:39'),
(188, 70, 39, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:17:39'),
(189, 71, 39, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:17:39'),
(190, 4, 40, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:18:21'),
(191, 72, 40, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:18:21'),
(192, 73, 40, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:18:21'),
(193, 74, 40, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:18:21'),
(194, 75, 40, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:18:22'),
(195, 76, 41, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:08'),
(196, 77, 41, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:08'),
(197, 78, 41, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:08'),
(198, 79, 41, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:08'),
(199, 93, 41, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:08'),
(200, 94, 41, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:08'),
(201, 8, 42, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:48'),
(202, 80, 42, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:48'),
(203, 81, 42, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:48'),
(204, 103, 42, 1, 1, 'P', '2017-04-26', 3, '2017-04-26 04:19:49'),
(205, 7, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:34'),
(206, 9, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(207, 11, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(208, 12, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(209, 13, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(210, 14, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(211, 15, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(212, 16, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(213, 17, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(214, 18, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(215, 19, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(216, 20, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:35'),
(217, 21, 34, 1, 1, 'A', '2017-04-27', 3, '2017-04-27 03:36:35'),
(218, 22, 34, 1, 1, 'A', '2017-04-27', 3, '2017-04-27 03:36:36'),
(219, 23, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:36'),
(220, 24, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:36'),
(221, 25, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:36'),
(222, 26, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:36'),
(223, 27, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:36'),
(224, 28, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:36'),
(225, 29, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:36'),
(226, 30, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:37'),
(227, 31, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:37'),
(228, 32, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:37'),
(229, 33, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:37'),
(230, 34, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:37'),
(231, 35, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:37'),
(232, 36, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:38'),
(233, 37, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:38'),
(234, 38, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:38'),
(235, 39, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:38'),
(236, 82, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:38'),
(237, 83, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:38'),
(238, 84, 34, 1, 1, 'A', '2017-04-27', 3, '2017-04-27 03:36:38'),
(239, 85, 34, 1, 1, 'A', '2017-04-27', 3, '2017-04-27 03:36:38'),
(240, 86, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:38'),
(241, 97, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:38'),
(242, 100, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:39'),
(243, 102, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:39'),
(244, 105, 34, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:36:39'),
(245, 3, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(246, 6, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(247, 10, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(248, 40, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(249, 41, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(250, 42, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(251, 43, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(252, 44, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(253, 45, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:58'),
(254, 87, 35, 1, 1, 'A', '2017-04-27', 3, '2017-04-27 03:38:58'),
(255, 88, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:59'),
(256, 89, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:59'),
(257, 96, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:59'),
(258, 104, 35, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:38:59'),
(259, 46, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:12'),
(260, 47, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:13'),
(261, 48, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:13'),
(262, 50, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:13'),
(263, 51, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:13'),
(264, 52, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:13'),
(265, 53, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:13'),
(266, 54, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:13'),
(267, 55, 36, 1, 1, 'A', '2017-04-27', 3, '2017-04-27 03:40:13'),
(268, 90, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:14'),
(269, 98, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:14'),
(270, 101, 36, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:40:14'),
(271, 2, 37, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:41:13'),
(272, 56, 37, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:41:13'),
(273, 57, 37, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:41:13'),
(274, 58, 37, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:41:13'),
(275, 91, 37, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:41:13'),
(276, 92, 37, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:41:13'),
(277, 95, 37, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:41:14'),
(278, 5, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:03'),
(279, 49, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:03'),
(280, 59, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:03'),
(281, 60, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:03'),
(282, 61, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:03'),
(283, 62, 38, 1, 1, 'A', '2017-04-27', 3, '2017-04-27 03:42:04'),
(284, 63, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:04'),
(285, 64, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:04'),
(286, 65, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:04'),
(287, 66, 38, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:04'),
(288, 1, 39, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:38'),
(289, 67, 39, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:38'),
(290, 68, 39, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:38'),
(291, 69, 39, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:38'),
(292, 70, 39, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:38'),
(293, 71, 39, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:42:39'),
(294, 4, 40, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:14'),
(295, 72, 40, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:14'),
(296, 73, 40, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:14'),
(297, 74, 40, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:14'),
(298, 75, 40, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:14'),
(299, 76, 41, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:51'),
(300, 77, 41, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:51'),
(301, 78, 41, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:51'),
(302, 79, 41, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:51'),
(303, 93, 41, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:52'),
(304, 94, 41, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:43:52'),
(305, 8, 42, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:44:26'),
(306, 80, 42, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:44:26'),
(307, 81, 42, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:44:27'),
(308, 103, 42, 1, 1, 'P', '2017-04-27', 3, '2017-04-27 03:44:27'),
(309, 7, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:26'),
(310, 9, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:26'),
(311, 11, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(312, 12, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(313, 13, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(314, 14, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(315, 15, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(316, 16, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(317, 17, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(318, 18, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(319, 19, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(320, 20, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:27'),
(321, 21, 34, 1, 1, 'A', '2017-04-28', 3, '2017-04-28 04:30:27'),
(322, 22, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(323, 23, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(324, 24, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(325, 25, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(326, 26, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(327, 27, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(328, 28, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(329, 29, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(330, 30, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(331, 31, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(332, 32, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(333, 33, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(334, 34, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(335, 35, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(336, 36, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(337, 37, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(338, 38, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(339, 39, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(340, 82, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(341, 83, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:28'),
(342, 84, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:29'),
(343, 85, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:29'),
(344, 86, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:29'),
(345, 97, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:29'),
(346, 100, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:29'),
(347, 102, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:29'),
(348, 105, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:29'),
(349, 106, 34, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:30:29'),
(350, 3, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(351, 6, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(352, 10, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(353, 40, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(354, 41, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(355, 42, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(356, 43, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(357, 44, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(358, 45, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:27'),
(359, 87, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:28'),
(360, 88, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:28'),
(361, 89, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:28'),
(362, 96, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:28'),
(363, 104, 35, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:31:28'),
(364, 46, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:03'),
(365, 47, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:03'),
(366, 48, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:04'),
(367, 50, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:04'),
(368, 51, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:04'),
(369, 52, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:04'),
(370, 53, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:05'),
(371, 54, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:05'),
(372, 55, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:05'),
(373, 90, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:05'),
(374, 98, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:05'),
(375, 101, 36, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:05'),
(376, 2, 37, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:45'),
(377, 56, 37, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:45'),
(378, 57, 37, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:45'),
(379, 58, 37, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:46'),
(380, 91, 37, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:46'),
(381, 92, 37, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:46'),
(382, 95, 37, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:46'),
(383, 107, 37, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:32:47'),
(384, 5, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:35'),
(385, 49, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:35'),
(386, 59, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:35'),
(387, 60, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:36'),
(388, 61, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:36'),
(389, 62, 38, 1, 1, 'A', '2017-04-28', 3, '2017-04-28 04:33:36'),
(390, 63, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:37'),
(391, 64, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:37'),
(392, 65, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:37'),
(393, 66, 38, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:33:37'),
(394, 1, 39, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:08'),
(395, 67, 39, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:09'),
(396, 68, 39, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:09'),
(397, 69, 39, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:09'),
(398, 70, 39, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:09'),
(399, 71, 39, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:09'),
(400, 4, 40, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:58'),
(401, 72, 40, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:58'),
(402, 73, 40, 1, 1, 'A', '2017-04-28', 3, '2017-04-28 04:34:58'),
(403, 74, 40, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:58'),
(404, 75, 40, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:34:58'),
(405, 76, 41, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:29'),
(406, 77, 41, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:29'),
(407, 78, 41, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:30'),
(408, 79, 41, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:30'),
(409, 93, 41, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:30'),
(410, 94, 41, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:30'),
(411, 8, 42, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:57'),
(412, 80, 42, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:57'),
(413, 81, 42, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:57'),
(414, 103, 42, 1, 1, 'P', '2017-04-28', 3, '2017-04-28 04:35:58'),
(417, 7, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:42'),
(418, 9, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:42'),
(419, 11, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:42'),
(420, 12, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:43'),
(421, 13, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:43'),
(422, 14, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:43'),
(423, 15, 34, 1, 1, 'A', '2017-04-29', 3, '2017-04-29 03:46:43'),
(424, 16, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:43'),
(425, 17, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:43'),
(426, 18, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:43'),
(427, 19, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:43'),
(428, 20, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:43'),
(429, 21, 34, 1, 1, 'A', '2017-04-29', 3, '2017-04-29 03:46:44'),
(430, 22, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:44'),
(431, 23, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:44'),
(432, 24, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:44'),
(433, 25, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:44'),
(434, 26, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:45'),
(435, 27, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:45'),
(436, 28, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:45'),
(437, 29, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:45'),
(438, 30, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:45'),
(439, 31, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(440, 32, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(441, 33, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(442, 34, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(443, 35, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(444, 36, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(445, 37, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(446, 38, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(447, 39, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(448, 82, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(449, 83, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(450, 84, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:46'),
(451, 85, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:47'),
(452, 86, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:47'),
(453, 97, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:47'),
(454, 100, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:47'),
(455, 102, 34, 1, 1, 'A', '2017-04-29', 3, '2017-04-29 03:46:47'),
(456, 105, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:47'),
(457, 106, 34, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:46:48'),
(458, 2, 37, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:48:20'),
(459, 56, 37, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:48:20'),
(460, 57, 37, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:48:20'),
(461, 58, 37, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:48:20'),
(462, 91, 37, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:48:20'),
(463, 92, 37, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:48:20'),
(464, 95, 37, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:48:21'),
(465, 107, 37, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:48:21'),
(466, 5, 38, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:49:19'),
(467, 49, 38, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:49:20'),
(468, 59, 38, 1, 1, 'A', '2017-04-29', 3, '2017-04-29 03:49:20'),
(469, 60, 38, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:49:20'),
(470, 61, 38, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:49:20'),
(471, 62, 38, 1, 1, 'A', '2017-04-29', 3, '2017-04-29 03:49:20'),
(472, 63, 38, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:49:20'),
(473, 64, 38, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:49:20'),
(474, 65, 38, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:49:20'),
(475, 66, 38, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:49:20'),
(476, 1, 39, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:14'),
(477, 67, 39, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:14'),
(478, 68, 39, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:15'),
(479, 69, 39, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:15'),
(480, 70, 39, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:15'),
(481, 71, 39, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:15'),
(482, 4, 40, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:53'),
(483, 72, 40, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:53'),
(484, 73, 40, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:54'),
(485, 74, 40, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:54'),
(486, 75, 40, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:50:54'),
(487, 76, 41, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:51:57'),
(488, 77, 41, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:51:57'),
(489, 78, 41, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:51:57'),
(490, 79, 41, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:51:57'),
(491, 93, 41, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:51:57'),
(492, 94, 41, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:51:58'),
(493, 8, 42, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:52:34'),
(494, 80, 42, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:52:34'),
(495, 81, 42, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:52:34'),
(496, 103, 42, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:52:34'),
(497, 46, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:41'),
(498, 47, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:41'),
(499, 48, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:41'),
(500, 50, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:41'),
(501, 51, 36, 1, 1, 'A', '2017-04-29', 3, '2017-04-29 03:53:41'),
(502, 52, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:41'),
(503, 53, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:41'),
(504, 54, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:41'),
(505, 55, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:41'),
(506, 90, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:42'),
(507, 98, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:42'),
(508, 101, 36, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:53:42'),
(509, 3, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:24'),
(510, 6, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:24'),
(511, 10, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:24'),
(512, 40, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:24'),
(513, 41, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:24'),
(514, 42, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:24'),
(515, 43, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:24'),
(516, 44, 35, 1, 1, 'A', '2017-04-29', 3, '2017-04-29 03:56:25'),
(517, 45, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:25'),
(518, 87, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:25'),
(519, 88, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:25'),
(520, 89, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:25'),
(521, 96, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:25'),
(522, 104, 35, 1, 1, 'P', '2017-04-29', 3, '2017-04-29 03:56:25'),
(523, 8, 42, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:26:24'),
(524, 80, 42, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:26:24'),
(525, 81, 42, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:26:24'),
(526, 103, 42, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:26:24'),
(527, 76, 41, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:27:10'),
(528, 77, 41, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:27:10'),
(529, 78, 41, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:27:10'),
(530, 79, 41, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:27:10'),
(531, 93, 41, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:27:10'),
(532, 94, 41, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:27:10'),
(533, 3, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:32:59'),
(534, 6, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:32:59'),
(535, 10, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:32:59'),
(536, 40, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:32:59'),
(537, 41, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:32:59'),
(538, 42, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(539, 43, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(540, 44, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(541, 45, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(542, 87, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(543, 88, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(544, 89, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(545, 96, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(546, 104, 35, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:33:00'),
(547, 7, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:07'),
(548, 9, 34, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:36:07'),
(549, 11, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:07'),
(550, 12, 34, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:36:08'),
(551, 13, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:08'),
(552, 14, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:08'),
(553, 15, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:08'),
(554, 16, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:08'),
(555, 17, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:08'),
(556, 18, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:08'),
(557, 19, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:09'),
(558, 20, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:09'),
(559, 21, 34, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:36:09'),
(560, 22, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:09'),
(561, 23, 34, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:36:09'),
(562, 24, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:09'),
(563, 25, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:09'),
(564, 26, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:09'),
(565, 27, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:10'),
(566, 28, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:10'),
(567, 29, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:10'),
(568, 30, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:10'),
(569, 31, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:10'),
(570, 32, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:11'),
(571, 33, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:12'),
(572, 34, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:12'),
(573, 35, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:12'),
(574, 36, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:12'),
(575, 37, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:12'),
(576, 38, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:13'),
(577, 39, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:13'),
(578, 82, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:13'),
(579, 83, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:13'),
(580, 84, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:14'),
(581, 85, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:14'),
(582, 86, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:14'),
(583, 97, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:14'),
(584, 100, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:14'),
(585, 102, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:14'),
(586, 105, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:14'),
(587, 106, 34, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:36:14'),
(588, 5, 38, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:38:50'),
(589, 49, 38, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:38:50'),
(590, 59, 38, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:38:51'),
(591, 60, 38, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:38:51'),
(592, 61, 38, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:38:51'),
(593, 62, 38, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:38:51'),
(594, 63, 38, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:38:51'),
(595, 64, 38, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:38:51'),
(596, 65, 38, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:38:51'),
(597, 66, 38, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:38:51'),
(598, 1, 39, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:39:52'),
(599, 67, 39, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:39:52'),
(600, 68, 39, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:39:53'),
(601, 69, 39, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:39:53'),
(602, 70, 39, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:39:53'),
(603, 71, 39, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:39:53'),
(604, 4, 40, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:42:09'),
(605, 72, 40, 1, 1, 'L', '2017-05-02', 3, '2017-05-02 03:42:09'),
(606, 73, 40, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:42:10'),
(607, 74, 40, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:42:10'),
(608, 75, 40, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:42:10'),
(609, 46, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:09'),
(610, 47, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:09'),
(611, 48, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:09'),
(612, 50, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:10'),
(613, 51, 36, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:45:10'),
(614, 52, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:10'),
(615, 53, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:10'),
(616, 54, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:10'),
(617, 55, 36, 1, 1, 'A', '2017-05-02', 3, '2017-05-02 03:45:10'),
(618, 90, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:11'),
(619, 98, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:11'),
(620, 101, 36, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:45:11'),
(621, 2, 37, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:47:26'),
(622, 56, 37, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:47:26'),
(623, 57, 37, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:47:26'),
(624, 58, 37, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:47:26'),
(625, 91, 37, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:47:26'),
(626, 92, 37, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:47:26'),
(627, 95, 37, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:47:26'),
(628, 107, 37, 1, 1, 'P', '2017-05-02', 3, '2017-05-02 03:47:26'),
(629, 7, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:40'),
(630, 9, 34, 1, 1, 'A', '2017-05-03', 3, '2017-05-03 03:40:41'),
(631, 11, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:41'),
(632, 12, 34, 1, 1, 'A', '2017-05-03', 3, '2017-05-03 03:40:41'),
(633, 13, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:41'),
(634, 14, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(635, 15, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(636, 16, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(637, 17, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(638, 18, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(639, 19, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(640, 20, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(641, 21, 34, 1, 1, 'A', '2017-05-03', 3, '2017-05-03 03:40:42'),
(642, 22, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(643, 23, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:42'),
(644, 24, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:43'),
(645, 25, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:43'),
(646, 26, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:43'),
(647, 27, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:43'),
(648, 28, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:43'),
(649, 29, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:43'),
(650, 30, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:43'),
(651, 31, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:43'),
(652, 32, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(653, 33, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(654, 34, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(655, 35, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(656, 36, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(657, 37, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(658, 38, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(659, 39, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(660, 82, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:44'),
(661, 83, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(662, 84, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(663, 85, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(664, 86, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(665, 97, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(666, 100, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(667, 102, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(668, 105, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(669, 106, 34, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:40:45'),
(670, 3, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:13'),
(671, 6, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(672, 10, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(673, 40, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(674, 41, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(675, 42, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(676, 43, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(677, 44, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(678, 45, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(679, 87, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(680, 88, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(681, 89, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(682, 96, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(683, 104, 35, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:44:14'),
(684, 46, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:04'),
(685, 47, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:05'),
(686, 48, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:05'),
(687, 50, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:06'),
(688, 51, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:06'),
(689, 52, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:06'),
(690, 53, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:06'),
(691, 54, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:07'),
(692, 55, 36, 1, 1, 'L', '2017-05-03', 3, '2017-05-03 03:45:08'),
(693, 90, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:08'),
(694, 98, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:08'),
(695, 101, 36, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:45:08'),
(696, 2, 37, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:46:19'),
(697, 56, 37, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:46:19'),
(698, 57, 37, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:46:19'),
(699, 58, 37, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:46:19'),
(700, 91, 37, 1, 1, 'A', '2017-05-03', 3, '2017-05-03 03:46:19'),
(701, 92, 37, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:46:19'),
(702, 95, 37, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:46:19'),
(703, 107, 37, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:46:19'),
(704, 5, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:47'),
(705, 49, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:47'),
(706, 59, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:47'),
(707, 60, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:47'),
(708, 61, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:47'),
(709, 62, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:47'),
(710, 63, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:47'),
(711, 64, 38, 1, 1, 'A', '2017-05-03', 3, '2017-05-03 03:48:48'),
(712, 65, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:48'),
(713, 66, 38, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:48:48'),
(714, 1, 39, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:49:35'),
(715, 67, 39, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:49:35'),
(716, 68, 39, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:49:35'),
(717, 69, 39, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:49:36'),
(718, 70, 39, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:49:36'),
(719, 71, 39, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:49:36'),
(720, 4, 40, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:50:36'),
(721, 72, 40, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:50:38'),
(722, 73, 40, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:50:39'),
(723, 74, 40, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:50:39'),
(724, 75, 40, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:50:39'),
(725, 76, 41, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:51:26'),
(726, 77, 41, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:51:26'),
(727, 78, 41, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:51:26'),
(728, 79, 41, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:51:26'),
(729, 93, 41, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:51:26'),
(730, 94, 41, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:51:26'),
(731, 8, 42, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:52:47'),
(732, 80, 42, 1, 1, 'P', '2017-05-03', 3, '2017-05-03 03:52:47'),
(733, 81, 42, 1, 1, 'A', '2017-05-03', 3, '2017-05-03 03:52:47'),
(734, 103, 42, 1, 1, 'A', '2017-05-03', 3, '2017-05-03 03:52:47'),
(735, 7, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:56'),
(736, 9, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:56'),
(737, 11, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:56'),
(738, 12, 34, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:45:56'),
(739, 13, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:57'),
(740, 14, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:57'),
(741, 15, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:57'),
(742, 16, 34, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:45:57'),
(743, 17, 34, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:45:57'),
(744, 18, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:57'),
(745, 19, 34, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:45:58'),
(746, 20, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:58'),
(747, 21, 34, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:45:58'),
(748, 22, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:58'),
(749, 23, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:58'),
(750, 24, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:58'),
(751, 25, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:58'),
(752, 26, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:58'),
(753, 27, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:58'),
(754, 28, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:59'),
(755, 29, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:59'),
(756, 30, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:59'),
(757, 31, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:59'),
(758, 32, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:59'),
(759, 33, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:59'),
(760, 34, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:45:59'),
(761, 35, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:00'),
(762, 36, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:00'),
(763, 37, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:00'),
(764, 38, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:00'),
(765, 39, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:00'),
(766, 82, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:00'),
(767, 83, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:01'),
(768, 84, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:01'),
(769, 85, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:01'),
(770, 86, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:01'),
(771, 97, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:01'),
(772, 100, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:01'),
(773, 102, 34, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:46:02'),
(774, 105, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:02'),
(775, 106, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:02'),
(776, 110, 34, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:46:02'),
(777, 3, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:03'),
(778, 6, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:04'),
(779, 10, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:04'),
(780, 40, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:04'),
(781, 41, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:05'),
(782, 42, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:05');
INSERT INTO `student_attendance` (`id_attendance`, `registration_id`, `class_id`, `shift_id`, `campus_id`, `status`, `attendace_date`, `created_by`, `created_on`) VALUES
(783, 43, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:06'),
(784, 44, 35, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:47:06'),
(785, 45, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:07'),
(786, 87, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:07'),
(787, 88, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:07'),
(788, 89, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:07'),
(789, 96, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:07'),
(790, 104, 35, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:08'),
(791, 46, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:58'),
(792, 47, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:58'),
(793, 48, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:59'),
(794, 50, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:59'),
(795, 51, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:59'),
(796, 52, 36, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:47:59'),
(797, 53, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:59'),
(798, 54, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:59'),
(799, 55, 36, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:47:59'),
(800, 90, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:59'),
(801, 98, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:59'),
(802, 101, 36, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:47:59'),
(803, 2, 37, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:52:50'),
(804, 56, 37, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:52:51'),
(805, 57, 37, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:52:51'),
(806, 58, 37, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:52:51'),
(807, 91, 37, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:52:51'),
(808, 92, 37, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:52:51'),
(809, 95, 37, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:52:52'),
(810, 107, 37, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:52:52'),
(811, 5, 38, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:54:55'),
(812, 49, 38, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:54:55'),
(813, 59, 38, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:54:55'),
(814, 60, 38, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:54:55'),
(815, 61, 38, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:54:55'),
(816, 62, 38, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:54:55'),
(817, 63, 38, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:54:55'),
(818, 64, 38, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:54:55'),
(819, 65, 38, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:54:55'),
(820, 66, 38, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:54:55'),
(821, 1, 39, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:55:31'),
(822, 67, 39, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:55:32'),
(823, 68, 39, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:55:32'),
(824, 69, 39, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:55:32'),
(825, 70, 39, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:55:32'),
(826, 71, 39, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:55:34'),
(827, 4, 40, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:02'),
(828, 72, 40, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:02'),
(829, 73, 40, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:03'),
(830, 74, 40, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:03'),
(831, 75, 40, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:03'),
(832, 76, 41, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:30'),
(833, 77, 41, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:31'),
(834, 78, 41, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:31'),
(835, 79, 41, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:31'),
(836, 93, 41, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:31'),
(837, 94, 41, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:56:31'),
(838, 8, 42, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:57:06'),
(839, 80, 42, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:57:06'),
(840, 81, 42, 1, 1, 'A', '2017-05-04', 3, '2017-05-04 05:57:06'),
(841, 103, 42, 1, 1, 'P', '2017-05-04', 3, '2017-05-04 05:57:07'),
(842, 7, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:51'),
(843, 9, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:51'),
(844, 11, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:51'),
(845, 12, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:51'),
(846, 13, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:51'),
(847, 14, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:51'),
(848, 15, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:51'),
(849, 16, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(850, 17, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(851, 18, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(852, 19, 34, 1, 1, 'A', '2017-05-05', 3, '2017-05-05 03:23:52'),
(853, 20, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(854, 21, 34, 1, 1, 'A', '2017-05-05', 3, '2017-05-05 03:23:52'),
(855, 22, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(856, 23, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(857, 24, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(858, 25, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(859, 26, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:52'),
(860, 27, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(861, 28, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(862, 29, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(863, 30, 34, 1, 1, 'L', '2017-05-05', 3, '2017-05-05 03:23:53'),
(864, 31, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(865, 32, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(866, 33, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(867, 34, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(868, 35, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(869, 36, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(870, 37, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(871, 38, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(872, 39, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(873, 82, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(874, 83, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(875, 84, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:53'),
(876, 85, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:54'),
(877, 86, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:54'),
(878, 97, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:54'),
(879, 100, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:54'),
(880, 102, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:54'),
(881, 105, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:54'),
(882, 106, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:54'),
(883, 110, 34, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:23:54'),
(884, 3, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:18'),
(885, 6, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:18'),
(886, 10, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:18'),
(887, 40, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:18'),
(888, 41, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:18'),
(889, 42, 35, 1, 1, 'A', '2017-05-05', 3, '2017-05-05 03:25:19'),
(890, 43, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:19'),
(891, 44, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:19'),
(892, 45, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:19'),
(893, 87, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:19'),
(894, 88, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:19'),
(895, 89, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:19'),
(896, 96, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:19'),
(897, 104, 35, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:25:19'),
(898, 46, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:56'),
(899, 47, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:56'),
(900, 48, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:56'),
(901, 50, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:57'),
(902, 51, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:57'),
(903, 52, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:57'),
(904, 53, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:57'),
(905, 54, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:57'),
(906, 55, 36, 1, 1, 'A', '2017-05-05', 3, '2017-05-05 03:26:57'),
(907, 90, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:57'),
(908, 98, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:57'),
(909, 101, 36, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:26:57'),
(910, 2, 37, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:26'),
(911, 56, 37, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:26'),
(912, 57, 37, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:26'),
(913, 58, 37, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:26'),
(914, 91, 37, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:26'),
(915, 92, 37, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:26'),
(916, 95, 37, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:26'),
(917, 107, 37, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:26'),
(918, 5, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:53'),
(919, 49, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:53'),
(920, 59, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:53'),
(921, 60, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:53'),
(922, 61, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:53'),
(923, 62, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:53'),
(924, 63, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:53'),
(925, 64, 38, 1, 1, 'A', '2017-05-05', 3, '2017-05-05 03:27:54'),
(926, 65, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:54'),
(927, 66, 38, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:27:54'),
(928, 1, 39, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:21'),
(929, 67, 39, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:21'),
(930, 68, 39, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:21'),
(931, 69, 39, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:21'),
(932, 70, 39, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:21'),
(933, 71, 39, 1, 1, 'A', '2017-05-05', 3, '2017-05-05 03:29:21'),
(934, 4, 40, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:48'),
(935, 72, 40, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:48'),
(936, 73, 40, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:48'),
(937, 74, 40, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:48'),
(938, 75, 40, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:29:48'),
(939, 76, 41, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:10'),
(940, 77, 41, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:10'),
(941, 78, 41, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:10'),
(942, 79, 41, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:11'),
(943, 93, 41, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:12'),
(944, 94, 41, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:13'),
(945, 8, 42, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:36'),
(946, 80, 42, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:40'),
(947, 81, 42, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:40'),
(948, 103, 42, 1, 1, 'P', '2017-05-05', 3, '2017-05-05 03:30:40'),
(949, 7, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(950, 9, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(951, 11, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(952, 12, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(953, 13, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(954, 14, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(955, 15, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(956, 16, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(957, 17, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(958, 18, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:39'),
(959, 19, 34, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:47:39'),
(960, 20, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(961, 21, 34, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:47:40'),
(962, 22, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(963, 23, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(964, 24, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(965, 25, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(966, 26, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(967, 27, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(968, 28, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(969, 29, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(970, 30, 34, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:47:40'),
(971, 31, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(972, 32, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(973, 33, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:40'),
(974, 34, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(975, 35, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(976, 36, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(977, 37, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(978, 38, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(979, 39, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(980, 82, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(981, 83, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(982, 84, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(983, 85, 34, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:47:41'),
(984, 86, 34, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:47:41'),
(985, 97, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(986, 100, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:41'),
(987, 102, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:42'),
(988, 105, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:42'),
(989, 106, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:42'),
(990, 110, 34, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:47:42'),
(991, 3, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(992, 6, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(993, 10, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(994, 40, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(995, 41, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(996, 42, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(997, 43, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(998, 44, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(999, 45, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:38'),
(1000, 87, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:39'),
(1001, 88, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:39'),
(1002, 89, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:39'),
(1003, 96, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:39'),
(1004, 104, 35, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:48:39'),
(1005, 46, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:01'),
(1006, 47, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:01'),
(1007, 48, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:06'),
(1008, 50, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:06'),
(1009, 51, 36, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:50:06'),
(1010, 52, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:06'),
(1011, 53, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:06'),
(1012, 54, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:07'),
(1013, 55, 36, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:50:07'),
(1014, 90, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:07'),
(1015, 98, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:09'),
(1016, 101, 36, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:50:09'),
(1017, 2, 37, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:51:51'),
(1018, 56, 37, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:51:51'),
(1019, 57, 37, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:51:51'),
(1020, 58, 37, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:51:51'),
(1021, 91, 37, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:51:51'),
(1022, 92, 37, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:51:51'),
(1023, 95, 37, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:51:51'),
(1024, 107, 37, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:51:51'),
(1025, 5, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:54'),
(1026, 49, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:54'),
(1027, 59, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:54'),
(1028, 60, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:54'),
(1029, 61, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:54'),
(1030, 62, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:54'),
(1031, 63, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:54'),
(1032, 64, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:55'),
(1033, 65, 38, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:52:55'),
(1034, 66, 38, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:52:55'),
(1035, 1, 39, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:53:42'),
(1036, 67, 39, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:53:42'),
(1037, 68, 39, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:53:42'),
(1038, 69, 39, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:53:42'),
(1039, 70, 39, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:53:42'),
(1040, 71, 39, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:53:42'),
(1041, 4, 40, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:54:29'),
(1042, 72, 40, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:54:29'),
(1043, 73, 40, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:54:29'),
(1044, 74, 40, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:54:29'),
(1045, 75, 40, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:54:29'),
(1046, 76, 41, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:55:26'),
(1047, 77, 41, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:55:26'),
(1048, 78, 41, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:55:26'),
(1049, 79, 41, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:55:26'),
(1050, 93, 41, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:55:26'),
(1051, 94, 41, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:55:26'),
(1052, 8, 42, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:56:25'),
(1053, 80, 42, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:56:25'),
(1054, 81, 42, 1, 1, 'A', '2017-05-06', 3, '2017-05-06 03:56:25'),
(1055, 103, 42, 1, 1, 'P', '2017-05-06', 3, '2017-05-06 03:56:25'),
(1056, 7, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1057, 9, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1058, 11, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1059, 12, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1060, 13, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1061, 14, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1062, 15, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1063, 16, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1064, 17, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1065, 18, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1066, 19, 34, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1067, 20, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1068, 21, 34, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1069, 22, 34, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 03:58:09'),
(1070, 23, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1071, 24, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1072, 25, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1073, 26, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1074, 27, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1075, 28, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1076, 29, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1077, 30, 34, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1078, 31, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1079, 32, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1080, 33, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1081, 34, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1082, 35, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1083, 36, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1084, 37, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1085, 38, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1086, 39, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:10'),
(1087, 82, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1088, 83, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1089, 84, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1090, 85, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1091, 86, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1092, 97, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1093, 100, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1094, 102, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1095, 105, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1096, 106, 34, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1097, 110, 34, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 03:58:11'),
(1098, 3, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1099, 6, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1100, 10, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1101, 40, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1102, 41, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1103, 42, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1104, 43, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1105, 44, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1106, 45, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1107, 87, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1108, 88, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1109, 89, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:42'),
(1110, 96, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:43'),
(1111, 104, 35, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 03:59:43'),
(1112, 46, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1113, 47, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1114, 48, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1115, 50, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1116, 51, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1117, 52, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1118, 53, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1119, 54, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1120, 55, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1121, 90, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1122, 98, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1123, 101, 36, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:02:10'),
(1124, 5, 38, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1125, 49, 38, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1126, 59, 38, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1127, 60, 38, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1128, 61, 38, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1129, 62, 38, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1130, 63, 38, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1131, 64, 38, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1132, 65, 38, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1133, 66, 38, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:07:25'),
(1134, 1, 39, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:08:43'),
(1135, 67, 39, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:08:43'),
(1136, 68, 39, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:08:43'),
(1137, 69, 39, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:08:43'),
(1138, 70, 39, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:08:43'),
(1139, 71, 39, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 04:08:43'),
(1140, 76, 41, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:11:34'),
(1141, 77, 41, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:11:34'),
(1142, 78, 41, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:11:34'),
(1143, 79, 41, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:11:34'),
(1144, 93, 41, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:11:34'),
(1145, 94, 41, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:11:34'),
(1146, 4, 40, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:12:16'),
(1147, 72, 40, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:12:16'),
(1148, 73, 40, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:12:16'),
(1149, 74, 40, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:12:16'),
(1150, 75, 40, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:12:16'),
(1151, 95, 40, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:12:16'),
(1152, 8, 42, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:13:04'),
(1153, 80, 42, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:13:04'),
(1154, 81, 42, 1, 1, 'A', '2017-05-08', 3, '2017-05-08 04:13:04'),
(1155, 103, 42, 1, 1, 'P', '2017-05-08', 3, '2017-05-08 04:13:04'),
(1156, 7, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1157, 9, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1158, 11, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1159, 12, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1160, 13, 34, 1, 1, 'A', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1161, 14, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1162, 15, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1163, 16, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1164, 17, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1165, 18, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1166, 19, 34, 1, 1, 'A', '2017-05-09', 3, '2017-05-09 03:52:36'),
(1167, 20, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1168, 21, 34, 1, 1, 'A', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1169, 22, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1170, 23, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1171, 24, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1172, 25, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1173, 26, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1174, 27, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1175, 28, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1176, 29, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1177, 30, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1178, 31, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1179, 32, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:37'),
(1180, 33, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1181, 34, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1182, 35, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1183, 36, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1184, 37, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1185, 38, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1186, 39, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1187, 82, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1188, 83, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:38'),
(1189, 84, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:39'),
(1190, 85, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:39'),
(1191, 86, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:39'),
(1192, 97, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:39'),
(1193, 100, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:39'),
(1194, 102, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:39'),
(1195, 105, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:39'),
(1196, 106, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:39'),
(1197, 110, 34, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:52:40'),
(1198, 3, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:08'),
(1199, 6, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:08'),
(1200, 10, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:09'),
(1201, 40, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:09'),
(1202, 41, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:09'),
(1203, 42, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:09'),
(1204, 43, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:09'),
(1205, 44, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:09'),
(1206, 45, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:09'),
(1207, 87, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:10'),
(1208, 88, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:10'),
(1209, 89, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:10'),
(1210, 96, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:10'),
(1211, 104, 35, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:54:10'),
(1212, 46, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:23'),
(1213, 47, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:23'),
(1214, 48, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:23'),
(1215, 50, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:24'),
(1216, 51, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:24'),
(1217, 52, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:24'),
(1218, 53, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:24'),
(1219, 54, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:24'),
(1220, 55, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:25'),
(1221, 90, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:25'),
(1222, 98, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:25'),
(1223, 101, 36, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:56:25'),
(1224, 2, 37, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:57:57'),
(1225, 56, 37, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:57:57'),
(1226, 57, 37, 1, 1, 'A', '2017-05-09', 3, '2017-05-09 03:57:57'),
(1227, 58, 37, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:57:57'),
(1228, 91, 37, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:57:57'),
(1229, 92, 37, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:57:57'),
(1230, 107, 37, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:57:57'),
(1231, 5, 38, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1232, 49, 38, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1233, 59, 38, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1234, 60, 38, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1235, 61, 38, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1236, 62, 38, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1237, 63, 38, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1238, 64, 38, 1, 1, 'A', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1239, 65, 38, 1, 1, 'A', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1240, 66, 38, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 03:59:19'),
(1241, 1, 39, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:00:36'),
(1242, 67, 39, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:00:42'),
(1243, 68, 39, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:00:43'),
(1244, 69, 39, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:00:44'),
(1245, 70, 39, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:00:44'),
(1246, 71, 39, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:00:44'),
(1247, 4, 40, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:01:35'),
(1248, 72, 40, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:01:36'),
(1249, 73, 40, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:01:36'),
(1250, 74, 40, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:01:36'),
(1251, 75, 40, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:01:36'),
(1252, 95, 40, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:01:36'),
(1253, 76, 41, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:02:30'),
(1254, 77, 41, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:02:30'),
(1255, 78, 41, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:02:30'),
(1256, 79, 41, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:02:30'),
(1257, 93, 41, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:02:30'),
(1258, 94, 41, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:02:30'),
(1259, 8, 42, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:05:20'),
(1260, 80, 42, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:05:20'),
(1261, 81, 42, 1, 1, 'A', '2017-05-09', 3, '2017-05-09 04:05:21'),
(1262, 103, 42, 1, 1, 'P', '2017-05-09', 3, '2017-05-09 04:05:21'),
(1263, 7, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:10'),
(1264, 9, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:10'),
(1265, 11, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:10'),
(1266, 12, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:10'),
(1267, 13, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:10'),
(1268, 14, 34, 1, 1, 'L', '2017-05-10', 3, '2017-05-10 03:31:10'),
(1269, 15, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1270, 16, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1271, 17, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1272, 18, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1273, 19, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1274, 20, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1275, 21, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1276, 22, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1277, 23, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1278, 24, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1279, 25, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1280, 26, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1281, 27, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1282, 28, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:11'),
(1283, 29, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1284, 30, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1285, 31, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1286, 32, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1287, 33, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1288, 34, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1289, 35, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1290, 36, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1291, 37, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:12'),
(1292, 38, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1293, 39, 34, 1, 1, 'L', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1294, 82, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1295, 83, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1296, 84, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1297, 85, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1298, 86, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1299, 97, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1300, 100, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1301, 102, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:13'),
(1302, 105, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:14'),
(1303, 106, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:14'),
(1304, 110, 34, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:31:14'),
(1305, 3, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1306, 6, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1307, 10, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1308, 40, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1309, 41, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1310, 42, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1311, 43, 35, 1, 1, 'A', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1312, 44, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1313, 45, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1314, 87, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1315, 88, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:49'),
(1316, 89, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:50'),
(1317, 96, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:50'),
(1318, 104, 35, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:32:50'),
(1319, 46, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:30'),
(1320, 47, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:30'),
(1321, 48, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:30'),
(1322, 50, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:30'),
(1323, 51, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:30'),
(1324, 52, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:30'),
(1325, 53, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:31'),
(1326, 54, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:31'),
(1327, 55, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:31'),
(1328, 90, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:31'),
(1329, 98, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:31'),
(1330, 101, 36, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:33:31'),
(1331, 2, 37, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:34:34'),
(1332, 56, 37, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:34:34'),
(1333, 57, 37, 1, 1, 'L', '2017-05-10', 3, '2017-05-10 03:34:34'),
(1334, 58, 37, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:34:34'),
(1335, 91, 37, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:34:34'),
(1336, 92, 37, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:34:35'),
(1337, 107, 37, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:34:35'),
(1338, 5, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1339, 49, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1340, 59, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1341, 60, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1342, 61, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1343, 62, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1344, 63, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1345, 64, 38, 1, 1, 'L', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1346, 65, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1347, 66, 38, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:35:10'),
(1348, 1, 39, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:36:29'),
(1349, 67, 39, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:36:30'),
(1350, 68, 39, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:36:30'),
(1351, 69, 39, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:36:30'),
(1352, 70, 39, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:36:30'),
(1353, 71, 39, 1, 1, 'A', '2017-05-10', 3, '2017-05-10 03:36:30'),
(1354, 4, 40, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:37:25'),
(1355, 72, 40, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:37:25'),
(1356, 73, 40, 1, 1, 'A', '2017-05-10', 3, '2017-05-10 03:37:25'),
(1357, 74, 40, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:37:25'),
(1358, 75, 40, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:37:25'),
(1359, 95, 40, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:37:25'),
(1360, 76, 41, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:36'),
(1361, 77, 41, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:36'),
(1362, 78, 41, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:36'),
(1363, 79, 41, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:36'),
(1364, 93, 41, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:36'),
(1365, 94, 41, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:36'),
(1366, 8, 42, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:58'),
(1367, 80, 42, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:58'),
(1368, 81, 42, 1, 1, 'A', '2017-05-10', 3, '2017-05-10 03:38:58'),
(1369, 103, 42, 1, 1, 'P', '2017-05-10', 3, '2017-05-10 03:38:58'),
(1370, 3, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:35'),
(1371, 6, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:35'),
(1372, 10, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:35'),
(1373, 40, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:35'),
(1374, 41, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:35'),
(1375, 42, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:35'),
(1376, 43, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:35'),
(1377, 44, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:35'),
(1378, 45, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:36'),
(1379, 87, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:36'),
(1380, 88, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:36'),
(1381, 89, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:36'),
(1382, 96, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:36'),
(1383, 104, 35, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:49:36'),
(1384, 46, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1385, 47, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1386, 48, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1387, 50, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1388, 51, 36, 1, 1, 'A', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1389, 52, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1390, 53, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1391, 54, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1392, 55, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1393, 90, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1394, 98, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1395, 101, 36, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:50:25'),
(1396, 8, 42, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:03'),
(1397, 80, 42, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:03'),
(1398, 81, 42, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:03'),
(1399, 103, 42, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:03'),
(1400, 76, 41, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:44'),
(1401, 77, 41, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:44'),
(1402, 78, 41, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:44'),
(1403, 79, 41, 1, 1, 'A', '2017-05-11', 3, '2017-05-11 03:51:44'),
(1404, 93, 41, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:44'),
(1405, 94, 41, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:51:44'),
(1406, 4, 40, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:52:31'),
(1407, 72, 40, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:52:31'),
(1408, 73, 40, 1, 1, 'A', '2017-05-11', 3, '2017-05-11 03:52:31'),
(1409, 74, 40, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:52:31'),
(1410, 75, 40, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:52:31'),
(1411, 95, 40, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:52:31'),
(1412, 1, 39, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:04'),
(1413, 67, 39, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:04'),
(1414, 68, 39, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:04'),
(1415, 69, 39, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:04'),
(1416, 70, 39, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:04'),
(1417, 71, 39, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:04'),
(1418, 2, 37, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:47'),
(1419, 56, 37, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:47'),
(1420, 57, 37, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:48'),
(1421, 58, 37, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:48'),
(1422, 91, 37, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:48'),
(1423, 92, 37, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:48'),
(1424, 107, 37, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:53:48'),
(1425, 5, 38, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1426, 49, 38, 1, 1, 'A', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1427, 59, 38, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1428, 60, 38, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1429, 61, 38, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1430, 62, 38, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1431, 63, 38, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1432, 64, 38, 1, 1, 'A', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1433, 65, 38, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1434, 66, 38, 1, 1, 'P', '2017-05-11', 3, '2017-05-11 03:54:48'),
(1435, 7, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:44'),
(1436, 9, 34, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:33:44'),
(1437, 11, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:44'),
(1438, 12, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1439, 13, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1440, 14, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1441, 15, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1442, 16, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1443, 17, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1444, 18, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1445, 19, 34, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1446, 20, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1447, 21, 34, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:33:45'),
(1448, 22, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1449, 23, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1450, 24, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1451, 25, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1452, 26, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1453, 27, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1454, 28, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1455, 29, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1456, 30, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1457, 31, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1458, 32, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1459, 33, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1460, 34, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1461, 35, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1462, 36, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1463, 37, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1464, 38, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1465, 39, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1466, 82, 34, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1467, 83, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:46'),
(1468, 84, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1469, 85, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1470, 86, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1471, 97, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1472, 100, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1473, 102, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1474, 105, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1475, 106, 34, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1476, 110, 34, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:33:47'),
(1477, 3, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1478, 6, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1479, 10, 35, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1480, 40, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1481, 41, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1482, 42, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1483, 43, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1484, 44, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1485, 45, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1486, 87, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:16'),
(1487, 88, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:17'),
(1488, 89, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:17'),
(1489, 96, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:17'),
(1490, 104, 35, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:40:17'),
(1491, 46, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:33'),
(1492, 47, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:33'),
(1493, 48, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:33'),
(1494, 50, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:33'),
(1495, 51, 36, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:41:33'),
(1496, 52, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:33'),
(1497, 53, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:33'),
(1498, 54, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:33'),
(1499, 55, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:34'),
(1500, 90, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:34'),
(1501, 98, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:34'),
(1502, 101, 36, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:41:34'),
(1503, 2, 37, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:44:49'),
(1504, 56, 37, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:44:49'),
(1505, 57, 37, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:44:49'),
(1506, 58, 37, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:44:49'),
(1507, 91, 37, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:44:49'),
(1508, 92, 37, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:44:50'),
(1509, 107, 37, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:44:50'),
(1510, 5, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1511, 49, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1512, 59, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1513, 60, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1514, 61, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1515, 62, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1516, 63, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1517, 64, 38, 1, 1, 'L', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1518, 65, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:45:59'),
(1519, 66, 38, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:46:00'),
(1526, 1, 39, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:47:42'),
(1527, 67, 39, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:47:42'),
(1528, 68, 39, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:47:42'),
(1529, 69, 39, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:47:42'),
(1530, 70, 39, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:47:42'),
(1531, 71, 39, 1, 1, 'A', '2017-05-13', 3, '2017-05-13 03:47:42'),
(1532, 4, 40, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:48:31'),
(1533, 72, 40, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:48:31'),
(1534, 73, 40, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:48:31'),
(1535, 74, 40, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:48:31'),
(1536, 75, 40, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:48:31'),
(1537, 95, 40, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:48:31'),
(1538, 76, 41, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:51:06'),
(1539, 77, 41, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:51:06'),
(1540, 78, 41, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:51:06'),
(1541, 79, 41, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:51:06'),
(1542, 93, 41, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:51:06'),
(1543, 94, 41, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:51:06'),
(1544, 8, 42, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:52:10'),
(1545, 80, 42, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:52:10'),
(1546, 81, 42, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:52:10'),
(1547, 103, 42, 1, 1, 'P', '2017-05-13', 3, '2017-05-13 03:52:10'),
(1548, 7, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:47'),
(1549, 9, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:47'),
(1550, 11, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:47'),
(1551, 12, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:47'),
(1552, 13, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:47'),
(1553, 14, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:47'),
(1554, 15, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:48'),
(1555, 16, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:48'),
(1556, 17, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:48'),
(1557, 18, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:49'),
(1558, 19, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:49');
INSERT INTO `student_attendance` (`id_attendance`, `registration_id`, `class_id`, `shift_id`, `campus_id`, `status`, `attendace_date`, `created_by`, `created_on`) VALUES
(1559, 20, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:49'),
(1560, 21, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:49'),
(1561, 22, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:49'),
(1562, 23, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:49'),
(1563, 24, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:49'),
(1564, 25, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:49'),
(1565, 26, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:49'),
(1566, 27, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1567, 28, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1568, 29, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1569, 30, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1570, 31, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1571, 32, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1572, 33, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1573, 34, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1574, 35, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1575, 36, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1576, 37, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1577, 38, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:50'),
(1578, 39, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1579, 82, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1580, 83, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1581, 84, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1582, 85, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1583, 86, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1584, 97, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1585, 100, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1586, 102, 34, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1587, 105, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1588, 106, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1589, 110, 34, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:39:51'),
(1590, 3, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1591, 6, 35, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1592, 10, 35, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1593, 40, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1594, 41, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1595, 42, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1596, 43, 35, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1597, 44, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1598, 45, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1599, 87, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1600, 88, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1601, 89, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:05'),
(1602, 96, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:06'),
(1603, 104, 35, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:43:06'),
(1604, 46, 36, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:46:01'),
(1605, 47, 36, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:46:01'),
(1606, 48, 36, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:46:01'),
(1607, 50, 36, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:46:01'),
(1608, 51, 36, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:46:01'),
(1609, 52, 36, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:46:01'),
(1610, 53, 36, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:46:01'),
(1611, 54, 36, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:46:01'),
(1612, 55, 36, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:46:02'),
(1613, 90, 36, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:46:02'),
(1614, 98, 36, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:46:02'),
(1615, 101, 36, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:46:02'),
(1616, 2, 37, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:07'),
(1617, 56, 37, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:07'),
(1618, 57, 37, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:07'),
(1619, 58, 37, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:07'),
(1620, 91, 37, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:47:07'),
(1621, 92, 37, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:47:07'),
(1622, 107, 37, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:07'),
(1623, 5, 38, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:53'),
(1624, 49, 38, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:53'),
(1625, 59, 38, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:47:53'),
(1626, 60, 38, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:54'),
(1627, 61, 38, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:54'),
(1628, 62, 38, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:54'),
(1629, 63, 38, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:54'),
(1630, 64, 38, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:47:54'),
(1631, 65, 38, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:54'),
(1632, 66, 38, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:47:54'),
(1633, 1, 39, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:48:32'),
(1634, 67, 39, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:48:33'),
(1635, 68, 39, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:48:33'),
(1636, 69, 39, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:48:33'),
(1637, 70, 39, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:48:33'),
(1638, 71, 39, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:48:34'),
(1639, 4, 40, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:49:31'),
(1640, 72, 40, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:49:31'),
(1641, 73, 40, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:49:31'),
(1642, 74, 40, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:49:31'),
(1643, 75, 40, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:49:31'),
(1644, 95, 40, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:49:31'),
(1645, 76, 41, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:51:21'),
(1646, 77, 41, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:51:22'),
(1647, 78, 41, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:51:22'),
(1648, 79, 41, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:51:22'),
(1649, 93, 41, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:51:22'),
(1650, 94, 41, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:51:22'),
(1651, 8, 42, 1, 1, 'A', '2017-05-15', 3, '2017-05-15 03:52:43'),
(1652, 80, 42, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:52:43'),
(1653, 81, 42, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:52:43'),
(1654, 103, 42, 1, 1, 'P', '2017-05-15', 3, '2017-05-15 03:52:43'),
(1655, 7, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:41'),
(1656, 9, 34, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:45:41'),
(1657, 11, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:41'),
(1658, 12, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1659, 13, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1660, 14, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1661, 15, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1662, 16, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1663, 17, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1664, 18, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1665, 19, 34, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1666, 20, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1667, 21, 34, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1668, 22, 34, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1669, 23, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1670, 24, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1671, 25, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1672, 26, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1673, 27, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1674, 28, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1675, 29, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1676, 30, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1677, 31, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:42'),
(1678, 32, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1679, 33, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1680, 34, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1681, 35, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1682, 36, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1683, 37, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1684, 38, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1685, 39, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1686, 82, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1687, 83, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1688, 84, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1689, 85, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1690, 86, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:43'),
(1691, 97, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:44'),
(1692, 100, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:44'),
(1693, 102, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:44'),
(1694, 105, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:44'),
(1695, 106, 34, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:45:44'),
(1696, 110, 34, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:45:44'),
(1697, 3, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1698, 6, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1699, 10, 35, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1700, 40, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1701, 41, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1702, 42, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1703, 43, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1704, 44, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1705, 45, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1706, 87, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1707, 88, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1708, 89, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:49'),
(1709, 96, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:50'),
(1710, 104, 35, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:46:50'),
(1711, 46, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1712, 47, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1713, 48, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1714, 50, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1715, 51, 36, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1716, 52, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1717, 53, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1718, 54, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1719, 55, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1720, 90, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1721, 98, 36, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1722, 101, 36, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:48:04'),
(1723, 2, 37, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:49:20'),
(1724, 56, 37, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:49:20'),
(1725, 57, 37, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:49:20'),
(1726, 58, 37, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:49:20'),
(1727, 91, 37, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:49:20'),
(1728, 92, 37, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:49:20'),
(1729, 107, 37, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:49:20'),
(1730, 5, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1731, 49, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1732, 59, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1733, 60, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1734, 61, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1735, 62, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1736, 63, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1737, 64, 38, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1738, 65, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1739, 66, 38, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:23'),
(1740, 1, 39, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:59'),
(1741, 67, 39, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:59'),
(1742, 68, 39, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:59'),
(1743, 69, 39, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:59'),
(1744, 70, 39, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:59'),
(1745, 71, 39, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:50:59'),
(1746, 4, 40, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:01'),
(1747, 72, 40, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:01'),
(1748, 73, 40, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:01'),
(1749, 74, 40, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:01'),
(1750, 75, 40, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:01'),
(1751, 95, 40, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:01'),
(1752, 76, 41, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:49'),
(1753, 77, 41, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:49'),
(1754, 78, 41, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:49'),
(1755, 79, 41, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:49'),
(1756, 93, 41, 1, 1, 'A', '2017-05-16', 3, '2017-05-16 03:52:49'),
(1757, 94, 41, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:52:49'),
(1758, 8, 42, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:53:46'),
(1759, 80, 42, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:53:46'),
(1760, 81, 42, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:53:46'),
(1761, 103, 42, 1, 1, 'P', '2017-05-16', 3, '2017-05-16 03:53:47'),
(1762, 7, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:06'),
(1763, 9, 34, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 03:59:06'),
(1764, 11, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:07'),
(1765, 12, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:07'),
(1766, 13, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:07'),
(1767, 14, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:07'),
(1768, 15, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:07'),
(1769, 16, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1770, 17, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1771, 18, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1772, 19, 34, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1773, 20, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1774, 21, 34, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1775, 22, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1776, 23, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1777, 24, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1778, 25, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1779, 26, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1780, 27, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1781, 28, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1782, 29, 34, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 03:59:08'),
(1783, 30, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1784, 31, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1785, 32, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1786, 33, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1787, 34, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1788, 35, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1789, 36, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1790, 37, 34, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1791, 38, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1792, 39, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1793, 82, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1794, 83, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1795, 84, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1796, 85, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1797, 86, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:09'),
(1798, 97, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:10'),
(1799, 100, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:10'),
(1800, 102, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:10'),
(1801, 105, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:10'),
(1802, 106, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:10'),
(1803, 110, 34, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 03:59:10'),
(1804, 3, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:39'),
(1805, 6, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:39'),
(1806, 10, 35, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1807, 40, 35, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1808, 41, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1809, 42, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1810, 43, 35, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1811, 44, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1812, 45, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1813, 87, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1814, 88, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:40'),
(1815, 89, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:41'),
(1816, 96, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:41'),
(1817, 104, 35, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:00:42'),
(1818, 46, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:37'),
(1819, 47, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:37'),
(1820, 48, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:37'),
(1821, 50, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:37'),
(1822, 51, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:37'),
(1823, 52, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:38'),
(1824, 53, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:38'),
(1825, 54, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:38'),
(1826, 55, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:38'),
(1827, 90, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:38'),
(1828, 98, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:38'),
(1829, 101, 36, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:01:39'),
(1830, 2, 37, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:02:49'),
(1831, 56, 37, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:02:49'),
(1832, 57, 37, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:02:49'),
(1833, 58, 37, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:02:49'),
(1834, 91, 37, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:02:49'),
(1835, 92, 37, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:02:49'),
(1836, 107, 37, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:02:49'),
(1837, 5, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1838, 49, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1839, 59, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1840, 60, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1841, 61, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1842, 62, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1843, 63, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1844, 64, 38, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1845, 65, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1846, 66, 38, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:26'),
(1847, 1, 39, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:52'),
(1848, 67, 39, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:53'),
(1849, 68, 39, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:53'),
(1850, 69, 39, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:54'),
(1851, 70, 39, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:54'),
(1852, 71, 39, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:03:54'),
(1853, 4, 40, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:04:29'),
(1854, 72, 40, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:04:29'),
(1855, 73, 40, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:04:29'),
(1856, 74, 40, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:04:29'),
(1857, 75, 40, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:04:29'),
(1858, 95, 40, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:04:29'),
(1859, 76, 41, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:05:20'),
(1860, 77, 41, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 04:05:20'),
(1861, 78, 41, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:05:20'),
(1862, 79, 41, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:05:20'),
(1863, 93, 41, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 04:05:20'),
(1864, 94, 41, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:05:20'),
(1865, 8, 42, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:06:00'),
(1866, 80, 42, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:06:00'),
(1867, 81, 42, 1, 1, 'P', '2017-05-17', 3, '2017-05-17 04:06:00'),
(1868, 103, 42, 1, 1, 'A', '2017-05-17', 3, '2017-05-17 04:06:00'),
(1911, 7, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1912, 9, 34, 1, 1, 'A', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1913, 11, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1914, 12, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1915, 13, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1916, 14, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1917, 15, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1918, 16, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1919, 17, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1920, 18, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1921, 19, 34, 1, 1, 'A', '2017-05-18', 3, '2017-05-18 04:06:11'),
(1922, 20, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:12'),
(1923, 21, 34, 1, 1, 'A', '2017-05-18', 3, '2017-05-18 04:06:12'),
(1924, 22, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:12'),
(1925, 23, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:12'),
(1926, 24, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:12'),
(1927, 25, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:12'),
(1928, 26, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1929, 27, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1930, 28, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1931, 29, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1932, 30, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1933, 31, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1934, 32, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1935, 33, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1936, 34, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1937, 35, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1938, 36, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1939, 37, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1940, 38, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1941, 39, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1942, 82, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1943, 83, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1944, 84, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:13'),
(1945, 85, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:14'),
(1946, 86, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:14'),
(1947, 97, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:14'),
(1948, 100, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:14'),
(1949, 102, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:14'),
(1950, 105, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:14'),
(1951, 106, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:14'),
(1952, 110, 34, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:06:14'),
(1953, 8, 42, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:06'),
(1954, 80, 42, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:06'),
(1955, 81, 42, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:07'),
(1956, 103, 42, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:07'),
(1957, 76, 41, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:39'),
(1958, 77, 41, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:39'),
(1959, 78, 41, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:39'),
(1960, 79, 41, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:39'),
(1961, 93, 41, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:39'),
(1962, 94, 41, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:07:39'),
(1963, 2, 37, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:11'),
(1964, 56, 37, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:12'),
(1965, 57, 37, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:12'),
(1966, 58, 37, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:12'),
(1967, 91, 37, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:12'),
(1968, 92, 37, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:12'),
(1969, 107, 37, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:12'),
(1970, 5, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:44'),
(1971, 49, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:44'),
(1972, 59, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:44'),
(1973, 60, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:45'),
(1974, 61, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:45'),
(1975, 62, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:45'),
(1976, 63, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:45'),
(1977, 64, 38, 1, 1, 'A', '2017-05-18', 3, '2017-05-18 04:08:45'),
(1978, 65, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:45'),
(1979, 66, 38, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:08:45'),
(1980, 4, 40, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:17'),
(1981, 72, 40, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:17'),
(1982, 73, 40, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:18'),
(1983, 74, 40, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:18'),
(1984, 75, 40, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:18'),
(1985, 95, 40, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:18'),
(1986, 1, 39, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:48'),
(1987, 67, 39, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:48'),
(1988, 68, 39, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:48'),
(1989, 69, 39, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:48'),
(1990, 70, 39, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:48'),
(1991, 71, 39, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:09:48'),
(1992, 46, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(1993, 47, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(1994, 48, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(1995, 50, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(1996, 51, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(1997, 52, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(1998, 53, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(1999, 54, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(2000, 55, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(2001, 90, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(2002, 98, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(2003, 101, 36, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:10:29'),
(2004, 3, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:23'),
(2005, 6, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:23'),
(2006, 10, 35, 1, 1, 'A', '2017-05-18', 3, '2017-05-18 04:11:23'),
(2007, 40, 35, 1, 1, 'A', '2017-05-18', 3, '2017-05-18 04:11:23'),
(2008, 41, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:23'),
(2009, 42, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2010, 43, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2011, 44, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2012, 45, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2013, 87, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2014, 88, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2015, 89, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2016, 96, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2017, 104, 35, 1, 1, 'P', '2017-05-18', 3, '2017-05-18 04:11:24'),
(2018, 5, 38, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:34:58'),
(2019, 49, 38, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:34:58'),
(2020, 59, 38, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:34:58'),
(2021, 60, 38, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:34:59'),
(2022, 61, 38, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:34:59'),
(2023, 62, 38, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:34:59'),
(2024, 63, 38, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:34:59'),
(2025, 64, 38, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:34:59'),
(2026, 65, 38, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:34:59'),
(2027, 66, 38, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:35:00'),
(2028, 2, 37, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:35:39'),
(2029, 56, 37, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:35:39'),
(2030, 57, 37, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:35:39'),
(2031, 58, 37, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:35:39'),
(2032, 91, 37, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:35:40'),
(2033, 92, 37, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:35:40'),
(2034, 107, 37, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:35:40'),
(2035, 8, 42, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:17'),
(2036, 80, 42, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:17'),
(2037, 81, 42, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:17'),
(2038, 103, 42, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:17'),
(2039, 76, 41, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:41'),
(2040, 77, 41, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:41'),
(2041, 78, 41, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:41'),
(2042, 79, 41, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:41'),
(2043, 93, 41, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:41'),
(2044, 94, 41, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:36:41'),
(2045, 46, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:16'),
(2046, 47, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:16'),
(2047, 48, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:16'),
(2048, 50, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:16'),
(2049, 51, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:16'),
(2050, 52, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:17'),
(2051, 53, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:17'),
(2052, 54, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:17'),
(2053, 55, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:17'),
(2054, 90, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:17'),
(2055, 98, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:17'),
(2056, 101, 36, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:37:17'),
(2057, 3, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:54'),
(2058, 6, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:54'),
(2059, 10, 35, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:38:54'),
(2060, 40, 35, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:38:54'),
(2061, 41, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:54'),
(2062, 42, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:54'),
(2063, 43, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:54'),
(2064, 44, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:55'),
(2065, 45, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:55'),
(2066, 87, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:55'),
(2067, 88, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:55'),
(2068, 89, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:55'),
(2069, 96, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:55'),
(2070, 104, 35, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:38:55'),
(2071, 4, 40, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:39:25'),
(2072, 72, 40, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:39:25'),
(2073, 73, 40, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:39:25'),
(2074, 74, 40, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:39:25'),
(2075, 75, 40, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:39:25'),
(2076, 95, 40, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:39:25'),
(2077, 1, 39, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:40:05'),
(2078, 67, 39, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:40:19'),
(2079, 68, 39, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:40:20'),
(2080, 69, 39, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:40:20'),
(2081, 70, 39, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:40:23'),
(2082, 71, 39, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:40:23'),
(2083, 7, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:20'),
(2084, 9, 34, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:43:20'),
(2085, 11, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:20'),
(2086, 12, 34, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2087, 13, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2088, 14, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2089, 15, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2090, 16, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2091, 17, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2092, 18, 34, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2093, 19, 34, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2094, 20, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2095, 21, 34, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2096, 22, 34, 1, 1, 'A', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2097, 23, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2098, 24, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2099, 25, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2100, 26, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2101, 27, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2102, 28, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2103, 29, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2104, 30, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:21'),
(2105, 31, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2106, 32, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2107, 33, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2108, 34, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2109, 35, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2110, 36, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2111, 37, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2112, 38, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2113, 39, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2114, 82, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2115, 83, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2116, 84, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2117, 85, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2118, 86, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2119, 97, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2120, 100, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:22'),
(2121, 102, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:23'),
(2122, 105, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:23'),
(2123, 106, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:23'),
(2124, 110, 34, 1, 1, 'P', '2017-05-19', 3, '2017-05-19 04:43:23'),
(2125, 7, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:18'),
(2126, 9, 34, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:44:18'),
(2127, 11, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:18'),
(2128, 12, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:18'),
(2129, 13, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:19'),
(2130, 14, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:19'),
(2131, 15, 34, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:44:19'),
(2132, 16, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:19'),
(2133, 17, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:19'),
(2134, 18, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:19'),
(2135, 19, 34, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:44:19'),
(2136, 20, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:19'),
(2137, 21, 34, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:44:20'),
(2138, 22, 34, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:44:20'),
(2139, 23, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:20'),
(2140, 24, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:20'),
(2141, 25, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:20'),
(2142, 26, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:20'),
(2143, 27, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:20'),
(2144, 28, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:20'),
(2145, 29, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2146, 30, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2147, 31, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2148, 32, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2149, 33, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2150, 34, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2151, 35, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2152, 36, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2153, 37, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2154, 38, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2155, 39, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2156, 82, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2157, 83, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:21'),
(2158, 84, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2159, 85, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2160, 86, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2161, 97, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2162, 100, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2163, 102, 34, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2164, 105, 34, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2165, 106, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2166, 110, 34, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:44:22'),
(2167, 3, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:01'),
(2168, 6, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:01'),
(2169, 10, 35, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:46:01'),
(2170, 40, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:01'),
(2171, 41, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:01'),
(2172, 42, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:01'),
(2173, 43, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:01'),
(2174, 44, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:02'),
(2175, 45, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:02'),
(2176, 87, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:02'),
(2177, 88, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:02'),
(2178, 89, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:02'),
(2179, 96, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:02'),
(2180, 104, 35, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:46:02'),
(2181, 46, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2182, 47, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2183, 48, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2184, 50, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2185, 51, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2186, 52, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2187, 53, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2188, 54, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2189, 55, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2190, 90, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2191, 98, 36, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2192, 101, 36, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:47:40'),
(2193, 2, 37, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:48:58'),
(2194, 56, 37, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:48:58'),
(2195, 57, 37, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:48:58'),
(2196, 58, 37, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:48:58'),
(2197, 91, 37, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:48:58'),
(2198, 92, 37, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:48:58'),
(2199, 107, 37, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:48:59'),
(2200, 5, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:33'),
(2201, 49, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:33'),
(2202, 59, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:33'),
(2203, 60, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:33'),
(2204, 61, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:33'),
(2205, 62, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:33'),
(2206, 63, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:33'),
(2207, 64, 38, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:49:34'),
(2208, 65, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:34'),
(2209, 66, 38, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:49:34'),
(2210, 4, 40, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:50:42'),
(2211, 72, 40, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:50:42'),
(2212, 73, 40, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:50:42'),
(2213, 74, 40, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:50:42'),
(2214, 75, 40, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:50:42'),
(2215, 95, 40, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:50:42'),
(2216, 1, 39, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:51:38'),
(2217, 67, 39, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:51:38'),
(2218, 68, 39, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:51:38'),
(2219, 69, 39, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:51:38'),
(2220, 70, 39, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:51:38'),
(2221, 71, 39, 1, 1, 'A', '2017-05-20', 3, '2017-05-20 03:51:38'),
(2222, 76, 41, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:52:38'),
(2223, 77, 41, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:52:38'),
(2224, 78, 41, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:52:38'),
(2225, 79, 41, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:52:38'),
(2226, 93, 41, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:52:39'),
(2227, 94, 41, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:52:39'),
(2228, 8, 42, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:53:38'),
(2229, 80, 42, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:53:38'),
(2230, 81, 42, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:53:38'),
(2231, 103, 42, 1, 1, 'P', '2017-05-20', 3, '2017-05-20 03:53:38'),
(2232, 7, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2233, 9, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2234, 11, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2235, 12, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2236, 13, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2237, 14, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2238, 15, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2239, 16, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2240, 17, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2241, 18, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2242, 19, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2243, 20, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2244, 21, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:55'),
(2245, 22, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2246, 23, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2247, 24, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2248, 25, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2249, 26, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2250, 27, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2251, 28, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2252, 29, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2253, 30, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2254, 31, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2255, 32, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2256, 33, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:56'),
(2257, 34, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2258, 35, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2259, 36, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2260, 37, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2261, 38, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2262, 39, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2263, 82, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2264, 83, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2265, 84, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2266, 85, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2267, 86, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2268, 97, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2269, 100, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:57'),
(2270, 102, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:58'),
(2271, 105, 34, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:25:58'),
(2272, 106, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:58'),
(2273, 110, 34, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:25:58'),
(2274, 3, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:12'),
(2275, 6, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:12'),
(2276, 10, 35, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:27:12'),
(2277, 40, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:12'),
(2278, 41, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:12'),
(2279, 42, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:12'),
(2280, 43, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:13'),
(2281, 44, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:13'),
(2282, 45, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:13'),
(2283, 87, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:13'),
(2284, 88, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:13'),
(2285, 89, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:13'),
(2286, 96, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:13'),
(2287, 104, 35, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:27:13'),
(2288, 46, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:28'),
(2289, 47, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:28'),
(2290, 48, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:28'),
(2291, 50, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:28'),
(2292, 51, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:28'),
(2293, 52, 36, 1, 1, 'L', '2017-05-22', 3, '2017-05-22 03:28:28'),
(2294, 53, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:29'),
(2295, 54, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:29'),
(2296, 55, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:29'),
(2297, 90, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:29'),
(2298, 98, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:29'),
(2299, 101, 36, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:28:29'),
(2300, 2, 37, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:30:01'),
(2301, 56, 37, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:30:04'),
(2302, 57, 37, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:30:04'),
(2303, 58, 37, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:30:04'),
(2304, 91, 37, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:30:04'),
(2305, 92, 37, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:30:04'),
(2306, 107, 37, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:30:04'),
(2307, 5, 38, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2308, 49, 38, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2309, 59, 38, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2310, 60, 38, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2311, 61, 38, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2312, 62, 38, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2313, 63, 38, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2314, 64, 38, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2315, 65, 38, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2316, 66, 38, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:32:57'),
(2317, 1, 39, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:33:51'),
(2318, 67, 39, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:33:51'),
(2319, 68, 39, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:33:51'),
(2320, 69, 39, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:33:52'),
(2321, 70, 39, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:33:52'),
(2322, 71, 39, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:33:52'),
(2323, 4, 40, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:34:38'),
(2324, 72, 40, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:34:38'),
(2325, 73, 40, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:34:39'),
(2326, 74, 40, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:34:39'),
(2327, 75, 40, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:34:39'),
(2328, 95, 40, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:34:39'),
(2329, 76, 41, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:35:24'),
(2330, 77, 41, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:35:24'),
(2331, 78, 41, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:35:24'),
(2332, 79, 41, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:35:24'),
(2333, 93, 41, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:35:24'),
(2334, 94, 41, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:35:24'),
(2335, 8, 42, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:36:17'),
(2336, 80, 42, 1, 1, 'A', '2017-05-22', 3, '2017-05-22 03:36:18'),
(2337, 81, 42, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:36:18'),
(2338, 103, 42, 1, 1, 'P', '2017-05-22', 3, '2017-05-22 03:36:18'),
(2339, 7, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:13'),
(2340, 9, 34, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:26:13'),
(2341, 11, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:13'),
(2342, 12, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:13'),
(2343, 13, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:13'),
(2344, 14, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:13'),
(2345, 15, 34, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:26:13'),
(2346, 16, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:14'),
(2347, 17, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:14'),
(2348, 18, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:14'),
(2349, 19, 34, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:26:14'),
(2350, 20, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:14'),
(2351, 21, 34, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:26:14'),
(2352, 22, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:14'),
(2353, 23, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:14'),
(2354, 24, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2355, 25, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2356, 26, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2357, 27, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2358, 28, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2359, 29, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2360, 30, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2361, 31, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2362, 32, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2363, 33, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2364, 34, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2365, 35, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2366, 36, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15');
INSERT INTO `student_attendance` (`id_attendance`, `registration_id`, `class_id`, `shift_id`, `campus_id`, `status`, `attendace_date`, `created_by`, `created_on`) VALUES
(2367, 37, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:15'),
(2368, 38, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2369, 39, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2370, 82, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2371, 83, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2372, 84, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2373, 85, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2374, 86, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2375, 97, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2376, 100, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2377, 102, 34, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2378, 105, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2379, 106, 34, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2380, 110, 34, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:26:16'),
(2381, 3, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:18'),
(2382, 6, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:18'),
(2383, 10, 35, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:27:18'),
(2384, 40, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:18'),
(2385, 41, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:18'),
(2386, 42, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:19'),
(2387, 43, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:19'),
(2388, 44, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:19'),
(2389, 45, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:19'),
(2390, 87, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:19'),
(2391, 88, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:19'),
(2392, 89, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:19'),
(2393, 96, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:20'),
(2394, 104, 35, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:27:20'),
(2395, 46, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:29'),
(2396, 47, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:29'),
(2397, 48, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:29'),
(2398, 50, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:29'),
(2399, 51, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:29'),
(2400, 52, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:30'),
(2401, 53, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:30'),
(2402, 54, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:30'),
(2403, 55, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:30'),
(2404, 90, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:30'),
(2405, 98, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:30'),
(2406, 101, 36, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:28:30'),
(2407, 2, 37, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:29:52'),
(2408, 56, 37, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:29:52'),
(2409, 57, 37, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:29:52'),
(2410, 58, 37, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:29:53'),
(2411, 91, 37, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:29:53'),
(2412, 92, 37, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:29:53'),
(2413, 107, 37, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:29:53'),
(2414, 1, 39, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:31:33'),
(2415, 67, 39, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:31:33'),
(2416, 68, 39, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:31:33'),
(2417, 69, 39, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:31:33'),
(2418, 70, 39, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:31:33'),
(2419, 71, 39, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:31:33'),
(2420, 4, 40, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:32:20'),
(2421, 72, 40, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:32:20'),
(2422, 73, 40, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:32:20'),
(2423, 74, 40, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:32:20'),
(2424, 75, 40, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:32:20'),
(2425, 95, 40, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:32:20'),
(2426, 76, 41, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:33:09'),
(2427, 77, 41, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:33:09'),
(2428, 78, 41, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:33:09'),
(2429, 79, 41, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:33:10'),
(2430, 93, 41, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:33:10'),
(2431, 94, 41, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:33:10'),
(2432, 8, 42, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:34:25'),
(2433, 80, 42, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:34:25'),
(2434, 81, 42, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:34:25'),
(2435, 103, 42, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:34:25'),
(2436, 5, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:12'),
(2437, 49, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:12'),
(2438, 59, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:12'),
(2439, 60, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:12'),
(2440, 61, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:12'),
(2441, 62, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:12'),
(2442, 63, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:12'),
(2443, 64, 38, 1, 1, 'A', '2017-05-23', 3, '2017-05-23 03:35:13'),
(2444, 65, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:13'),
(2445, 66, 38, 1, 1, 'P', '2017-05-23', 3, '2017-05-23 03:35:13'),
(2446, 7, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:57'),
(2447, 9, 34, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 03:58:57'),
(2448, 11, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:57'),
(2449, 12, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:57'),
(2450, 13, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:57'),
(2451, 14, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2452, 15, 34, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2453, 16, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2454, 17, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2455, 18, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2456, 19, 34, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2457, 20, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2458, 21, 34, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2459, 22, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:58'),
(2460, 23, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2461, 24, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2462, 25, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2463, 26, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2464, 27, 34, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2465, 28, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2466, 29, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2467, 30, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2468, 31, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2469, 32, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2470, 33, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2471, 34, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2472, 35, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2473, 36, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:58:59'),
(2474, 37, 34, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2475, 38, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2476, 39, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2477, 82, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2478, 83, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2479, 84, 34, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2480, 85, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2481, 86, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2482, 97, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:00'),
(2483, 100, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:01'),
(2484, 102, 34, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 03:59:01'),
(2485, 105, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:01'),
(2486, 106, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:01'),
(2487, 110, 34, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 03:59:01'),
(2488, 3, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:50'),
(2489, 6, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:50'),
(2490, 10, 35, 1, 1, 'L', '2017-05-24', 3, '2017-05-24 04:00:50'),
(2491, 40, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:50'),
(2492, 41, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2493, 42, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2494, 43, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2495, 44, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2496, 45, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2497, 87, 35, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2498, 88, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2499, 89, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2500, 96, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2501, 104, 35, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:00:51'),
(2502, 46, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:35'),
(2503, 47, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:35'),
(2504, 48, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:35'),
(2505, 50, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:35'),
(2506, 51, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:35'),
(2507, 52, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:36'),
(2508, 53, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:36'),
(2509, 54, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:36'),
(2510, 55, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:36'),
(2511, 90, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:36'),
(2512, 98, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:36'),
(2513, 101, 36, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:06:36'),
(2514, 2, 37, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:07:27'),
(2515, 56, 37, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:07:27'),
(2516, 57, 37, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:07:27'),
(2517, 58, 37, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:07:27'),
(2518, 91, 37, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:07:28'),
(2519, 92, 37, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:07:28'),
(2520, 107, 37, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:07:28'),
(2521, 5, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2522, 49, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2523, 59, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2524, 60, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2525, 61, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2526, 62, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2527, 63, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2528, 64, 38, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2529, 65, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2530, 66, 38, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:08:39'),
(2531, 1, 39, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:24:05'),
(2532, 67, 39, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:24:05'),
(2533, 68, 39, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:24:05'),
(2534, 69, 39, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:24:05'),
(2535, 70, 39, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:24:05'),
(2536, 71, 39, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 04:24:05'),
(2537, 4, 40, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:25:33'),
(2538, 72, 40, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:25:33'),
(2539, 73, 40, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:25:33'),
(2540, 74, 40, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:25:33'),
(2541, 75, 40, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:25:33'),
(2542, 95, 40, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:25:33'),
(2543, 76, 41, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:26:28'),
(2544, 77, 41, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:26:28'),
(2545, 78, 41, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:26:28'),
(2546, 79, 41, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:26:28'),
(2547, 93, 41, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:26:28'),
(2548, 94, 41, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:26:28'),
(2549, 8, 42, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:28:08'),
(2550, 80, 42, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:28:08'),
(2551, 81, 42, 1, 1, 'P', '2017-05-24', 3, '2017-05-24 04:28:08'),
(2552, 103, 42, 1, 1, 'A', '2017-05-24', 3, '2017-05-24 04:28:08'),
(2553, 2, 37, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 03:57:14'),
(2554, 56, 37, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 03:57:15'),
(2555, 57, 37, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 03:57:15'),
(2556, 58, 37, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 03:57:15'),
(2557, 91, 37, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 03:57:15'),
(2558, 92, 37, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 03:57:15'),
(2559, 107, 37, 1, 1, 'A', '2017-05-26', 3, '2017-05-26 03:57:15'),
(2560, 5, 38, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2561, 49, 38, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2562, 59, 38, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2563, 60, 38, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2564, 61, 38, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2565, 62, 38, 1, 1, 'A', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2566, 63, 38, 1, 1, 'A', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2567, 64, 38, 1, 1, 'A', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2568, 65, 38, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2569, 66, 38, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:00:46'),
(2570, 1, 39, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:04:25'),
(2571, 67, 39, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:04:25'),
(2572, 68, 39, 1, 1, 'A', '2017-05-26', 3, '2017-05-26 04:04:25'),
(2573, 69, 39, 1, 1, 'A', '2017-05-26', 3, '2017-05-26 04:04:25'),
(2574, 70, 39, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:04:25'),
(2575, 71, 39, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:04:25'),
(2576, 4, 40, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:06:12'),
(2577, 72, 40, 1, 1, 'A', '2017-05-26', 3, '2017-05-26 04:06:12'),
(2578, 73, 40, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:06:12'),
(2579, 74, 40, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:06:12'),
(2580, 75, 40, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:06:12'),
(2581, 95, 40, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:06:12'),
(2582, 76, 41, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:04'),
(2583, 77, 41, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:05'),
(2584, 78, 41, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:05'),
(2585, 79, 41, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:05'),
(2586, 93, 41, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:05'),
(2587, 94, 41, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:05'),
(2588, 8, 42, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:55'),
(2589, 80, 42, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:55'),
(2590, 81, 42, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:56'),
(2591, 103, 42, 1, 1, 'P', '2017-05-26', 3, '2017-05-26 04:10:56'),
(2592, 7, 34, 1, 1, 'A', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2593, 9, 34, 1, 1, 'A', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2594, 11, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2595, 12, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2596, 13, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2597, 14, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2598, 15, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2599, 16, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2600, 17, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2601, 18, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2602, 19, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2603, 20, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:56'),
(2604, 21, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2605, 22, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2606, 23, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2607, 24, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2608, 25, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2609, 26, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2610, 27, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2611, 28, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2612, 29, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2613, 30, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2614, 31, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2615, 32, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:57'),
(2616, 33, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2617, 34, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2618, 35, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2619, 36, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2620, 37, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2621, 38, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2622, 39, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2623, 82, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2624, 83, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2625, 84, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:58'),
(2626, 85, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:59'),
(2627, 86, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:59'),
(2628, 97, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:59'),
(2629, 100, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:59'),
(2630, 102, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:59'),
(2631, 105, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:59'),
(2632, 106, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:59'),
(2633, 110, 34, 1, 1, 'P', '2017-06-17', 5, '2017-06-17 10:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id_subjects` int(11) NOT NULL,
  `subject_name` varchar(50) DEFAULT NULL,
  `short_name` varchar(50) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `creatd_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id_subjects`, `subject_name`, `short_name`, `order_id`, `creatd_on`, `created_by`) VALUES
(1, 'English', 'Eng', 3, '2017-06-27 07:44:29', NULL),
(2, 'Urdu', 'Urdu', NULL, '2017-06-04 19:39:00', NULL),
(3, 'Pak Studies', 'PS', NULL, '2017-06-04 19:39:16', NULL),
(4, 'mathamatic', 'math', 5, '2017-06-27 07:41:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_control_account`
--

CREATE TABLE `sub_control_account` (
  `id_sub_control_account` int(11) NOT NULL,
  `sub_control_account_number` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `sub_control_account_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `control_account_id` int(11) NOT NULL,
  `sub_control_account_createdby` int(11) DEFAULT NULL,
  `sub_control_account_createdon` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pnl` varchar(50) COLLATE utf8_bin NOT NULL,
  `add_sub` varchar(50) COLLATE utf8_bin NOT NULL,
  `orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sub_control_account`
--

INSERT INTO `sub_control_account` (`id_sub_control_account`, `sub_control_account_number`, `sub_control_account_name`, `control_account_id`, `sub_control_account_createdby`, `sub_control_account_createdon`, `pnl`, `add_sub`, `orders`) VALUES
(1, '001', 'Property', 1, 7, '2016-11-24 19:55:15', 'CorporateRevenue', 'Add', 1),
(2, '002', 'Equipments', 1, 7, '2016-11-24 19:56:33', 'CorporateRevenue', 'Add', 2),
(3, '003', 'Furniture & Fixture', 1, 7, '2016-11-24 19:56:47', 'CorporateRevenue', 'Add', 3),
(4, '004', 'Vehicles', 1, 7, '2016-11-24 19:57:00', 'CorporateRevenue', 'Add', 4),
(5, '005', 'Inventory', 2, 7, '2016-11-24 20:07:17', 'CorporateRevenue', 'Add', 1),
(6, '006', 'Cash', 2, 7, '2016-11-24 20:08:02', 'CorporateRevenue', 'Add', 5),
(7, '007', 'Bank', 2, 7, '2016-11-24 20:09:11', 'CorporateRevenue', 'Add', 4),
(8, '008', 'Advances', 2, 7, '2016-11-24 20:11:16', 'CorporateRevenue', 'Add', 2),
(9, '009', 'Receivables', 2, 7, '2016-11-24 20:13:45', 'CorporateRevenue', 'Add', 3),
(10, '010', 'Long Term Direct', 3, 7, '2016-11-24 20:41:42', '', '', 0),
(11, '011', 'Loan', 4, 7, '2016-11-24 20:42:56', '', '', 0),
(12, '012', 'Advance Salary', 4, 7, '2016-11-24 20:43:52', '', '', 0),
(13, '013', 'Payables', 4, 7, '2016-11-24 20:44:52', '', '', 0),
(14, '014', 'Payable Sharing', 4, 7, '2016-11-24 20:48:50', '', '', 0),
(15, '015', 'W. H. Tax', 4, 7, '2016-11-24 20:51:47', '', '', 0),
(16, '016', 'Services Payable', 4, 7, '2016-11-24 20:52:39', '', '', 0),
(17, '017', 'Others', 4, 7, '2016-11-24 20:53:51', '', '', 0),
(18, '018', 'Entertainment', 5, 7, '2016-11-24 21:03:00', '', '', 0),
(19, '019', 'Askari', 5, 7, '2016-11-24 21:03:10', '', '', 0),
(20, '020', 'Pre Exp', 5, 7, '2016-11-24 21:03:25', '', '', 0),
(21, '021', 'Vendors', 6, 7, '2016-11-24 21:07:45', 'CorporateRevenue', 'Add', 0),
(22, '022', 'Salaries', 7, 7, '2016-11-24 21:08:48', '', '', 0),
(23, '023', 'Utility Bills', 7, 7, '2016-11-24 21:10:16', '', '', 0),
(24, '024', 'Sharing', 7, 7, '2016-11-24 21:12:27', '', '', 0),
(25, '025', 'Conveyance', 7, 7, '2016-11-24 21:12:53', '', '', 0),
(26, '026', 'Office Expenses', 7, 7, '2016-11-24 21:14:04', '', '', 0),
(27, '027', 'Repair & Maintenance', 7, 7, '2016-11-24 21:17:13', '', '', 0),
(28, '028', 'Doctor Service Charges', 7, 7, '2016-11-24 21:21:52', '', '', 0),
(29, '029', 'Rent Expense', 7, 7, '2016-11-24 21:23:02', '', '', 0),
(30, '030', 'Donation', 7, 7, '2016-11-24 21:23:40', '', '', 0),
(31, '031', 'Financial Charges', 7, 7, '2016-11-24 21:24:39', 'AdminExpenses', 'Add', 0),
(32, '032', 'Mark-Up', 7, 7, '2016-11-24 21:25:17', '', '', 0),
(33, '033', 'Federal Excise Duty', 7, 7, '2016-11-24 21:26:06', '', '', 0),
(34, '034', 'Bank Service Charges', 7, 7, '2016-11-24 21:26:42', '', '', 0),
(35, '035', 'Others', 7, 7, '2016-11-24 21:27:35', '', '', 0),
(41, '041', 'Shared Revenue', 9, 7, '2016-11-24 21:36:57', 'CorporateRevenue', 'Add', 0),
(47, '047', 'Personal Insurance', 5, 7, '2016-11-25 14:42:35', '', '', 0),
(48, '048', 'Other Income', 9, 18, '2017-01-02 17:38:47', 'Revenue', 'CorporateRevenue', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `main_menu_id` int(11) DEFAULT NULL,
  `sub_menu_name` varchar(50) DEFAULT NULL,
  `menu_status` enum('Yes','No') DEFAULT 'Yes',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id_sub_menu`, `main_menu_id`, `sub_menu_name`, `menu_status`, `created_by`, `created_on`) VALUES
(48, 1, 'Institution Details', 'Yes', NULL, '2017-08-12 07:17:44'),
(49, 1, 'Messages/SMS Setting', 'Yes', NULL, '2017-08-12 07:17:44'),
(50, 2, 'Inquiry', 'Yes', NULL, '2017-08-12 07:18:46'),
(51, 2, 'Inquiry Report', 'Yes', NULL, '2017-08-12 07:18:46'),
(52, 2, 'Classes and Sections', 'Yes', NULL, '2017-08-12 07:19:48'),
(53, 2, 'Expanse Voucher', 'Yes', NULL, '2017-08-12 07:19:48'),
(54, 2, 'Departments', 'Yes', NULL, '2017-08-12 07:20:33'),
(55, 2, 'Teacher Scheduler', 'Yes', NULL, '2017-08-12 07:20:33'),
(56, 3, 'Active Students List', 'Yes', NULL, '2017-08-12 07:21:20'),
(57, 3, 'Inactive Students List', 'Yes', NULL, '2017-08-12 07:21:20'),
(58, 3, 'Transfer Students', 'Yes', NULL, '2017-08-12 07:21:47'),
(59, 3, 'View Students', 'Yes', NULL, '2017-08-12 07:21:47'),
(60, 3, 'Assign Homework', 'Yes', NULL, '2017-08-12 07:22:22'),
(61, 3, 'Remarks For Students', 'Yes', NULL, '2017-08-12 07:22:22'),
(62, 4, 'Fees Collection', 'Yes', NULL, '2017-08-12 07:22:57'),
(63, 4, 'Fee Types', 'Yes', NULL, '2017-08-12 07:22:57'),
(64, 4, 'Fee Heads', 'Yes', NULL, '2017-08-12 07:23:31'),
(65, 4, 'Fee Concession', 'Yes', NULL, '2017-08-12 07:23:31'),
(66, 5, 'Fee Challan', 'Yes', NULL, '2017-08-12 07:24:09'),
(67, 5, 'Dues Slip', 'Yes', NULL, '2017-08-12 07:24:09'),
(68, 5, 'Defaulters Report', 'Yes', NULL, '2017-08-12 07:24:56'),
(69, 6, 'List of Subjects', 'Yes', NULL, '2017-08-12 07:24:56'),
(70, 6, 'Grade Setting', 'Yes', NULL, '2017-08-12 07:25:34'),
(71, 6, 'Examination Setup', 'Yes', NULL, '2017-08-12 07:25:34'),
(72, 7, 'Attendance', 'Yes', NULL, '2017-08-12 07:26:05'),
(73, 7, 'Attendance Report', 'Yes', NULL, '2017-08-12 07:26:05'),
(74, 8, 'Product Type', 'Yes', NULL, '2017-08-12 07:26:44'),
(75, 8, 'Suppliers List', 'Yes', NULL, '2017-08-12 07:26:44'),
(76, 8, 'Purchase Orders', 'Yes', NULL, '2017-08-12 07:27:19'),
(77, 9, 'Chart of Accounts', 'Yes', NULL, '2017-08-12 07:27:19'),
(78, 9, 'Vouchers', 'Yes', NULL, '2017-08-12 07:27:51'),
(79, 9, 'General Ledger', 'Yes', NULL, '2017-08-12 07:27:51'),
(80, 9, 'Financial Statements', 'Yes', NULL, '2017-08-12 07:28:25'),
(81, 9, 'Fee Collection', 'Yes', NULL, '2017-08-12 07:28:25'),
(82, 9, 'FCR Report', 'Yes', NULL, '2017-08-12 07:28:56'),
(83, 9, 'Expanse Report', 'Yes', NULL, '2017-08-12 07:28:56'),
(84, 10, 'View Statement', 'Yes', NULL, '2017-08-12 07:29:45'),
(85, 10, 'Collection Summery', 'Yes', NULL, '2017-08-12 07:29:45'),
(86, 11, 'SMS', 'Yes', NULL, '2017-08-12 07:30:38'),
(87, 12, 'Import From CSV File', 'Yes', NULL, '2017-08-12 07:30:38'),
(88, 12, 'Database Backup', 'Yes', NULL, '2017-08-12 07:31:09'),
(89, 13, 'View All', 'Yes', NULL, '2017-08-12 07:31:09'),
(90, 13, 'Create New User', 'Yes', NULL, '2017-08-12 07:31:43'),
(91, 14, 'Update', 'Yes', NULL, '2017-08-12 07:31:43'),
(92, 13, 'Role Permission', 'Yes', NULL, '2017-08-12 11:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `id_suggestion` int(11) NOT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `registration` int(11) DEFAULT NULL,
  `suggestion` longtext,
  `seg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Pending','Received') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`id_suggestion`, `campus_id`, `department_id`, `registration`, `suggestion`, `seg_date`, `status`) VALUES
(16, NULL, NULL, NULL, NULL, '2017-08-07 14:13:20', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id_suppliers` int(11) NOT NULL,
  `supplier_name` varchar(45) DEFAULT NULL,
  `supplier_address` varchar(255) DEFAULT NULL,
  `contact_person` varchar(145) DEFAULT NULL,
  `phone1` varchar(45) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `taxation` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id_suppliers`, `supplier_name`, `supplier_address`, `contact_person`, `phone1`, `phone2`, `email`, `website`, `taxation`) VALUES
(101, 'ABC entrprise', 'adsf', 'dsfdsa', '03062635039', '03062635039', 'qayyum@yahoo.com', '', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_category`
--

CREATE TABLE `supplier_category` (
  `id_supplier_category` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_category`
--

INSERT INTO `supplier_category` (`id_supplier_category`, `category_name`) VALUES
(8, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `id_supplier_products` int(11) NOT NULL,
  `id_suppliers` int(11) DEFAULT NULL,
  `id_products` int(11) DEFAULT NULL,
  `packaging_type` int(11) DEFAULT NULL,
  `units_per_pack` decimal(18,2) DEFAULT NULL,
  `pack_price` decimal(18,2) DEFAULT NULL,
  `unit_price` decimal(18,2) DEFAULT NULL,
  `tax_rate` double(4,2) DEFAULT '0.00',
  `foc_id` int(11) DEFAULT NULL,
  `active` char(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_products`
--

INSERT INTO `supplier_products` (`id_supplier_products`, `id_suppliers`, `id_products`, `packaging_type`, `units_per_pack`, `pack_price`, `unit_price`, `tax_rate`, `foc_id`, `active`, `created_by`, `created_on`) VALUES
(1049, 100, 1236, 6, '1.00', '150.00', '100.00', 0.00, NULL, 'y', 5, '2017-05-30 06:55:43'),
(1050, 101, 1236, 6, '10.00', '100.00', '100.00', 0.00, NULL, 'y', 5, '2017-06-04 10:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `temp_attendance`
--

CREATE TABLE `temp_attendance` (
  `id_attendance` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `grno` varchar(50) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  `shift_name` varchar(50) DEFAULT NULL,
  `d1` char(1) DEFAULT NULL,
  `d2` char(1) DEFAULT NULL,
  `d3` char(1) DEFAULT NULL,
  `d4` char(1) DEFAULT NULL,
  `d5` char(1) DEFAULT NULL,
  `d6` char(1) DEFAULT NULL,
  `d7` char(1) DEFAULT NULL,
  `d8` char(1) DEFAULT NULL,
  `d9` char(1) DEFAULT NULL,
  `d10` char(1) DEFAULT NULL,
  `d11` char(1) DEFAULT NULL,
  `d12` char(1) DEFAULT NULL,
  `d13` char(1) DEFAULT NULL,
  `d14` char(1) DEFAULT NULL,
  `d15` char(1) DEFAULT NULL,
  `d16` char(1) DEFAULT NULL,
  `d17` char(1) DEFAULT NULL,
  `d18` char(1) DEFAULT NULL,
  `d19` char(1) DEFAULT NULL,
  `d20` char(1) DEFAULT NULL,
  `d21` char(1) DEFAULT NULL,
  `d22` char(1) DEFAULT NULL,
  `d23` char(1) DEFAULT NULL,
  `d24` char(1) DEFAULT NULL,
  `d25` char(1) DEFAULT NULL,
  `d26` char(1) DEFAULT NULL,
  `d27` char(1) DEFAULT NULL,
  `d28` char(1) DEFAULT NULL,
  `d29` char(1) DEFAULT NULL,
  `d30` char(1) DEFAULT NULL,
  `d31` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `temp_dues_double_copy`
--

CREATE TABLE `temp_dues_double_copy` (
  `id_temp_dues` int(11) NOT NULL,
  `registration_id` int(11) DEFAULT NULL,
  `roll_no` int(11) DEFAULT NULL,
  `gr_no` varchar(10) DEFAULT NULL,
  `s_name` varchar(50) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  `shift_name` varchar(50) DEFAULT NULL,
  `session_name` varchar(50) DEFAULT NULL,
  `m1` varchar(50) DEFAULT NULL,
  `m2` varchar(50) DEFAULT NULL,
  `m3` varchar(50) DEFAULT NULL,
  `m4` varchar(50) DEFAULT NULL,
  `m5` varchar(50) DEFAULT NULL,
  `m6` varchar(50) DEFAULT NULL,
  `m7` varchar(50) DEFAULT NULL,
  `m8` varchar(50) DEFAULT NULL,
  `m9` varchar(50) DEFAULT NULL,
  `m10` varchar(50) DEFAULT NULL,
  `m11` varchar(50) DEFAULT NULL,
  `m12` varchar(50) DEFAULT NULL,
  `current_month` varchar(50) NOT NULL,
  `fine` varchar(50) DEFAULT NULL,
  `exam` varchar(50) DEFAULT NULL,
  `annual` varchar(50) DEFAULT NULL,
  `adv_jun` varchar(50) DEFAULT NULL,
  `adv_jul` varchar(50) DEFAULT NULL,
  `lyb` varchar(50) DEFAULT NULL,
  `arrears` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `timezone`
--

CREATE TABLE `timezone` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`id`, `code`, `name`) VALUES
(1, 'European Central Time(ECT) - GMT+01:00', 'European Central Time(ECT) - GMT+01:00'),
(2, 'Indiana Eastern Standard Time(IET) - GMT-05:00', 'Indiana Eastern Standard Time(IET) - GMT-05:00'),
(3, 'Indian Standard Time(IST) - GMT+05:30', 'Indian Standard Time(IST) - GMT+05:30'),
(4, 'Eastern European Time(EET) - GMT+02:00', 'Eastern European Time(EET) - GMT+02:00'),
(5, 'Arabic Standard Time(ART) - GMT+02:00', 'Arabic Standard Time(ART) - GMT+02:00'),
(6, 'Eastern African Time(EAT) - GMT+03:00', 'Eastern African Time(EAT) - GMT+03:00'),
(7, 'Middle East Time(MET) - GMT+03:30', 'Middle East Time(MET) - GMT+03:30'),
(8, 'Near East Time(NET) - GMT+04:00', 'Near East Time(NET) - GMT+04:00'),
(9, 'Pakistan Islamabad Time(PLT) - GMT+05:00', 'Pakistan Islamabad Time(PLT) - GMT+05:00'),
(10, 'Bangladesh Standard Time(BST) - GMT+06:00', 'Bangladesh Standard Time(BST) - GMT+06:00'),
(11, 'Vietnam Standard Time(VST) - GMT+07:00', 'Vietnam Standard Time(VST) - GMT+07:00'),
(12, 'China Taiwan Time(CTT) - GMT+08:00', 'China Taiwan Time(CTT) - GMT+08:00'),
(13, 'Japan Standard Time(JST) - GMT+09:00', 'Japan Standard Time(JST) - GMT+09:00'),
(14, 'Australia Central Time(ACT) - GMT+09:30', 'Australia Central Time(ACT) - GMT+09:30'),
(15, 'Australia Eastern Time(AET) - GMT+10:00', 'Australia Eastern Time(AET) - GMT+10:00'),
(16, 'Solomon Standard Time(SST) - GMT+11:00', 'Solomon Standard Time(SST) - GMT+11:00'),
(17, 'New Zealand Standard Time(NST) - GMT+12:00', 'New Zealand Standard Time(NST) - GMT+12:00'),
(18, 'Midway Islands Time(MIT) - GMT-11:00', 'Midway Islands Time(MIT) - GMT-11:00'),
(19, 'Hawaii Standard Time(HST) - GMT-10:00', 'Hawaii Standard Time(HST) - GMT-10:00'),
(20, 'Alaska Standard Time(AST) - GMT-09:00', 'Alaska Standard Time(AST) - GMT-09:00'),
(21, 'Pacific Standard Time(PST) - GMT-08:00', 'Pacific Standard Time(PST) - GMT-08:00'),
(22, 'Phoenix Standard Time(PNT) - GMT-07:00', 'Phoenix Standard Time(PNT) - GMT-07:00'),
(23, 'Mountain Standard Time(MST) - GMT-07:00', 'Mountain Standard Time(MST) - GMT-07:00'),
(24, 'Central Standard Time(CST) - GMT-06:00', 'Central Standard Time(CST) - GMT-06:00'),
(25, 'Eastern Standard Time(EST) - GMT-05:00', 'Eastern Standard Time(EST) - GMT-05:00'),
(26, 'Puerto Rico and US Virgin Islands Time(PRT) - GMT-04:00', 'Puerto Rico and US Virgin Islands Time(PRT) - GMT-04:00'),
(27, 'Canada Newfoundland Time(CNT) - GMT-03:30', 'Canada Newfoundland Time(CNT) - GMT-03:30'),
(28, 'Argentina Standard Time(AGT) - GMT-03:00', 'Argentina Standard Time(AGT) - GMT-03:00'),
(29, 'Brazil Eastern Time(BET) - GMT-03:00', 'Brazil Eastern Time(BET) - GMT-03:00'),
(30, 'Central African Time(CAT) - GMT-01:00', 'Central African Time(CAT) - GMT-01:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_account`
--

CREATE TABLE `transaction_account` (
  `id_transaction_account` int(11) NOT NULL,
  `transaction_account_number` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `sub_control_account_id` int(11) NOT NULL,
  `transaction_account_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `transaction_account_createdby` int(11) DEFAULT NULL,
  `transaction_account_createdon` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `transaction_account`
--

INSERT INTO `transaction_account` (`id_transaction_account`, `transaction_account_number`, `sub_control_account_id`, `transaction_account_name`, `transaction_account_createdby`, `transaction_account_createdon`) VALUES
(1, '0001', 1, 'Property', 7, '2016-11-24 12:55:35'),
(2, '0002', 2, 'Computer', 7, '2016-11-24 12:58:15'),
(3, '0003', 2, 'Lab Machinery', 7, '2016-11-24 12:58:31'),
(4, '0004', 2, 'Electrical Equipment', 7, '2016-11-24 12:58:44'),
(5, '0005', 2, 'Generators', 7, '2016-11-24 12:58:55'),
(6, '0006', 3, 'Office Furniture', 7, '2016-11-24 12:59:33'),
(7, '0007', 3, 'Lab Furniture', 7, '2016-11-24 12:59:48'),
(8, '0008', 4, 'School Van', 7, '2016-11-24 13:03:09'),
(9, '0009', 4, 'Cars', 7, '2016-11-24 13:03:17'),
(10, '0010', 5, 'Inventory', 7, '2016-11-24 13:07:33'),
(11, '0011', 6, 'Petty Cash', 7, '2016-11-24 13:08:17'),
(12, '0012', 6, 'Cash in Hand', 7, '2016-11-24 13:08:30'),
(13, '0013', 7, 'Allied Bank Limited', 7, '2016-11-24 13:10:00'),
(14, '0014', 7, 'Habib Metropolitan Bank', 7, '2016-11-24 13:10:33'),
(15, '0015', 7, 'Muslim Commercial Bank', 7, '2016-11-24 13:10:45'),
(16, '0016', 7, 'United Bank Limited', 7, '2016-11-24 13:10:57'),
(17, '0017', 8, 'Advance Tax', 7, '2016-11-24 13:11:37'),
(18, '0018', 8, 'W. Tax for Customers', 7, '2016-11-24 13:13:21'),
(19, '0019', 9, 'Receivable on Panels', 7, '2016-11-24 13:14:09'),
(20, '0020', 9, 'Receivable on Deals', 7, '2016-11-24 13:15:52'),
(21, '0021', 10, 'Loan From Directors', 7, '2016-11-24 13:42:05'),
(22, '0022', 11, 'Staff Loan', 7, '2016-11-24 13:43:12'),
(23, '0023', 11, 'Personal Employees Loan', 7, '2016-11-24 13:43:28'),
(24, '0024', 12, 'Advance Salaries', 7, '2016-11-24 13:44:12'),
(25, '0025', 13, 'Payable to Suppliers', 7, '2016-11-24 13:46:37'),
(26, '0026', 13, 'Payable Salaries', 7, '2016-11-24 13:47:37'),
(27, '0027', 13, 'Account Payable Services', 7, '2016-11-24 13:47:52'),
(28, '0028', 14, 'Payable to X-Rays (Sharing)', 7, '2016-11-24 13:49:15'),
(29, '0029', 14, 'Payable to Ultra Sound (Sharing)', 7, '2016-11-24 13:49:33'),
(30, '0030', 14, 'Payable to MRI (Sharing)', 7, '2016-11-24 13:49:54'),
(31, '0031', 14, 'Payable to Histo (Sharing)', 7, '2016-11-24 13:50:10'),
(32, '0032', 14, 'Payable to Dental (Sharing)', 7, '2016-11-24 13:50:27'),
(33, '0033', 14, 'Payable to Physio (Sharing)', 7, '2016-11-24 13:50:49'),
(34, '0034', 14, 'Payable to Vaccination (Sharing)', 7, '2016-11-24 13:51:09'),
(35, '0035', 14, 'Payable to Echo (Sharing)', 7, '2016-11-24 13:51:23'),
(36, '0036', 15, 'W. H. Tax - Salaries', 7, '2016-11-24 13:52:06'),
(37, '0037', 15, 'W. H. Tax - Suppliers', 7, '2016-11-24 13:52:21'),
(38, '0038', 16, 'Agha Khan', 7, '2016-11-24 13:53:25'),
(39, '0039', 16, 'Ziauddin', 7, '2016-11-24 13:53:35'),
(40, '0040', 17, 'Others Payable', 7, '2016-11-24 13:54:10'),
(41, '0041', 18, 'Karachi Gymkhana', 7, '2016-11-24 14:04:29'),
(42, '0042', 18, 'Marina Club', 7, '2016-11-24 14:04:40'),
(43, '0043', 18, 'Dream World Resort', 7, '2016-11-24 14:04:54'),
(46, '0046', 20, 'Credit Cards', 7, '2016-11-24 14:06:10'),
(47, '0047', 20, 'Utilities', 7, '2016-11-24 14:06:21'),
(48, '0048', 20, 'Other', 7, '2016-11-24 14:06:33'),
(49, '0049', 21, 'Lab Material Purchases', 7, '2016-11-24 14:08:02'),
(50, '0050', 22, 'Salaries Expenses', 7, '2016-11-24 14:09:08'),
(51, '0051', 22, 'Extras', 7, '2016-11-24 14:09:19'),
(52, '0052', 22, 'Bonus', 7, '2016-11-24 14:09:31'),
(53, '0053', 22, 'EOBI', 7, '2016-11-24 14:09:40'),
(54, '0054', 22, 'SESSI', 7, '2016-11-24 14:09:49'),
(55, '0055', 23, 'Electricity', 7, '2016-11-24 14:10:53'),
(56, '0056', 23, 'Sui Gas', 7, '2016-11-24 14:11:04'),
(57, '0057', 23, 'Telephone', 7, '2016-11-24 14:11:15'),
(58, '0058', 23, 'Mobiles', 7, '2016-11-24 14:11:28'),
(59, '0059', 23, 'KWSB', 7, '2016-11-24 14:11:40'),
(60, '0060', 23, 'Internet', 7, '2016-11-24 14:11:52'),
(61, '0061', 25, 'School Van & Cars Fuel', 7, '2016-11-24 14:13:21'),
(62, '0062', 25, 'Conveyance Charges', 7, '2016-11-24 14:13:33'),
(63, '0063', 25, 'Travelling Expenses', 7, '2016-11-24 14:13:45'),
(64, '0064', 26, 'Water Expense', 7, '2016-11-24 14:14:56'),
(65, '0065', 26, 'Stationary & Printing Expense', 7, '2016-11-24 14:15:15'),
(66, '0066', 26, 'Advertisement & Publicity Expense', 7, '2016-11-24 14:15:43'),
(67, '0067', 26, 'Generator Fuel Expenses', 7, '2016-11-24 14:16:02'),
(68, '0068', 26, 'Uniform Expense', 7, '2016-11-24 14:16:34'),
(69, '0069', 26, 'House Keeping Material Expense', 7, '2016-11-24 14:16:48'),
(70, '0070', 27, 'Repair & Maintenance - (Cars)', 7, '2016-11-24 14:19:35'),
(71, '0071', 27, 'Repair & Maintenance - (School Van)', 7, '2016-11-24 14:20:10'),
(72, '0072', 27, 'Repair & Maintenance - (Generators)', 7, '2016-11-24 14:20:24'),
(73, '0073', 27, 'Repair & Maintenance - (Office & Branches)', 7, '2016-11-24 14:20:44'),
(74, '0074', 27, 'Repair & Maintenance - (Electrical Equipment)', 7, '2016-11-24 14:21:02'),
(78, '0078', 29, 'Rent Expense', 7, '2016-11-24 14:23:19'),
(79, '0079', 30, 'Donation Expense', 7, '2016-11-24 14:23:56'),
(80, '0080', 31, 'Bank Charges', 7, '2016-11-24 14:24:56'),
(81, '0081', 32, 'Mark-Up', 7, '2016-11-24 14:25:37'),
(82, '0082', 33, 'Federal Excise Duty', 7, '2016-11-24 14:26:19'),
(83, '0083', 34, 'Bank Service Charges - UBL C.C', 7, '2016-11-24 14:27:07'),
(85, '0085', 35, 'Others', 7, '2016-11-24 14:27:47'),
(106, '0106', 48, 'Rent Income', 18, '2017-01-02 12:01:51'),
(107, '0107', 48, 'Bank Profit', 18, '2017-01-02 12:02:11'),
(108, '0108', 9, 'Receivable on credit card', 18, '2017-01-18 08:00:17'),
(110, '0110', 26, 'Computer Expense', 18, '2017-01-23 07:14:02'),
(111, '0111', 26, 'Refreshment Expenses', 18, '2017-01-28 08:14:41'),
(112, '0112', 26, 'TCS/Courier Charges', 18, '2017-01-28 08:21:53'),
(113, '0113', 26, 'Refund Cash', 18, '2017-01-28 08:22:14'),
(114, '0114', 26, 'Cable Fees', 18, '2017-01-28 08:22:58'),
(115, '0115', 26, 'Medical Expenses', 18, '2017-01-28 11:13:56'),
(116, '0116', 31, 'professional Charges ', 18, '2017-02-10 08:30:42'),
(117, '0117', 8, 'Security Deposit', 18, '2017-02-14 09:08:47'),
(118, '0118', 6, 'Float Cash', 18, '2017-02-14 14:06:06'),
(119, '0119', 26, 'Sponsorship Charges', 12, '2017-02-20 11:09:54'),
(121, '0121', 35, 'Gratification', 65, '2017-05-23 10:50:23'),
(122, '0122', 26, 'Insurance Expenses', 65, '2017-05-29 10:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` varchar(20) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'avatar-1.jpg',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `campus_id`, `full_name`, `address`, `phone1`, `phone2`, `image`, `created`, `modified`) VALUES
(3, 'admin@tsf.edu', '$2y$10$Q/m/gvaw3qpdjUrAxave0OqnQxwj0bzbbGyPc3KHlq1rurXU.OJKS', '1', 1, 'Syed Yaqoob Shah', 'abc', '03453956174', '54465465465', '3.jpg', '2017-02-13 11:10:03', '2017-03-24 09:05:21'),
(5, 'qayyum@yahoo.com', '$2y$10$fJk1NDAex87hugiryxrtC.IuokmNPjIqTvfs2N7TbTgt56.ZVvhMm', '1', 1, 'Abdul Qayyum Shah', 'abc', '03452188682', NULL, 'avatar-1.jpg', '2017-02-27 00:00:00', '2017-02-27 00:00:00'),
(6, 'parents@tsf.edu', '$2y$10$sM1VzKDGWcmK/MNrjZjptO6nru1EMF7GPEgD93Kug7GEAxOPxIC3G', '4', 1, 'Parents', 'Baldia town, Rasheedabad', '03422000351', '03422000351', 'avatar-1.jpg', '2017-03-22 09:41:34', '2017-03-22 10:32:09'),
(7, 'reception@tsf.edu', '$2y$10$CU.0d80NX5XRe5kWREls5uQTuLvXrWXRQ/mfoVmfjLPlM8LFsDVAK', '3', 1, 'Receptionist', 'Rasheedabad,Karachi.', '02132891802', '02132891802', 'avatar-1.jpg', '2017-04-27 14:59:05', '2017-06-10 13:37:12'),
(8, 'khan@yahoo.com', '$2y$10$pvRocyoObK4sIInfQdkk0OTFvrYT6.B24mx9MtsCAtQAvOViYvMFC', '2', 1, 'khan', 'fgfg', 'fdgdfg', 'fgd', 'avatar-1.jpg', '2017-08-16 00:47:54', '2017-08-16 00:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `users_role_management`
--

CREATE TABLE `users_role_management` (
  `id_menu_user_role` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `main_menu_id` int(11) DEFAULT NULL,
  `sub_menu_id` int(11) DEFAULT NULL,
  `persmissions` enum('Yes','No') DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users_role_management`
--

INSERT INTO `users_role_management` (`id_menu_user_role`, `role_id`, `main_menu_id`, `sub_menu_id`, `persmissions`) VALUES
(299, 1, 13, 89, 'Yes'),
(300, 1, 13, 90, 'Yes'),
(301, 1, 13, 92, 'Yes'),
(314, 1, 1, 48, 'Yes'),
(315, 1, 1, 49, 'Yes'),
(316, 1, 2, 50, 'Yes'),
(317, 1, 2, 51, 'Yes'),
(318, 1, 2, 52, 'Yes'),
(319, 1, 2, 53, 'Yes'),
(320, 1, 2, 54, 'Yes'),
(321, 1, 2, 55, 'Yes'),
(322, 1, 4, 62, 'Yes'),
(323, 1, 4, 63, 'Yes'),
(324, 1, 4, 64, 'Yes'),
(325, 1, 4, 65, 'Yes'),
(326, 1, 5, 66, 'Yes'),
(327, 1, 5, 67, 'Yes'),
(328, 1, 5, 68, 'Yes'),
(329, 1, 6, 69, 'Yes'),
(330, 1, 6, 70, 'Yes'),
(331, 1, 6, 71, 'Yes'),
(332, 1, 7, 72, 'Yes'),
(333, 1, 7, 73, 'Yes'),
(334, 1, 8, 74, 'Yes'),
(335, 1, 8, 75, 'Yes'),
(336, 1, 8, 76, 'Yes'),
(337, 1, 9, 77, 'Yes'),
(338, 1, 9, 78, 'Yes'),
(339, 1, 9, 79, 'Yes'),
(340, 1, 9, 80, 'Yes'),
(341, 1, 9, 81, 'Yes'),
(342, 1, 9, 82, 'Yes'),
(343, 1, 9, 83, 'Yes'),
(344, 1, 10, 84, 'Yes'),
(345, 1, 10, 85, 'Yes'),
(346, 1, 11, 86, 'Yes'),
(347, 1, 12, 87, 'Yes'),
(348, 1, 12, 88, 'Yes'),
(349, 1, 14, 91, 'Yes'),
(356, 1, 3, 56, 'Yes'),
(357, 1, 3, 57, 'Yes'),
(358, 1, 3, 58, 'Yes'),
(359, 1, 3, 59, 'Yes'),
(360, 1, 3, 60, 'Yes'),
(361, 1, 3, 61, 'Yes'),
(362, 2, 3, 56, 'Yes'),
(363, 2, 3, 57, 'No'),
(364, 2, 3, 58, 'No'),
(365, 2, 3, 59, 'Yes'),
(366, 2, 3, 60, 'No'),
(367, 2, 3, 61, 'No'),
(368, 2, 1, 48, 'No'),
(369, 2, 1, 49, 'No'),
(376, 2, 2, 50, 'Yes'),
(377, 2, 2, 51, 'No'),
(378, 2, 2, 52, 'No'),
(379, 2, 2, 53, 'No'),
(380, 2, 2, 54, 'No'),
(381, 2, 2, 55, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `video_gallery`
--

CREATE TABLE `video_gallery` (
  `id_video_gallery` int(11) NOT NULL,
  `video_titlte` varchar(50) DEFAULT NULL,
  `video_link` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `video_gallery`
--

INSERT INTO `video_gallery` (`id_video_gallery`, `video_titlte`, `video_link`) VALUES
(1, 'Speech', 'https://youtu.be/x9Ie1B6F1E0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_voucher`
--
ALTER TABLE `account_voucher`
  ADD PRIMARY KEY (`id_account_voucher`);

--
-- Indexes for table `account_voucher_details`
--
ALTER TABLE `account_voucher_details`
  ADD PRIMARY KEY (`id_account_voucher_details`);

--
-- Indexes for table `account_voucher_type`
--
ALTER TABLE `account_voucher_type`
  ADD PRIMARY KEY (`id_account_voucher_type`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id_notifications`);

--
-- Indexes for table `apps_countries`
--
ALTER TABLE `apps_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD UNIQUE KEY `id_bank` (`id_bank`);

--
-- Indexes for table `business_partners`
--
ALTER TABLE `business_partners`
  ADD PRIMARY KEY (`id_business_type`);

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`id_campus`);

--
-- Indexes for table `cash_register`
--
ALTER TABLE `cash_register`
  ADD PRIMARY KEY (`id_cash_register`);

--
-- Indexes for table `classes_sections`
--
ALTER TABLE `classes_sections`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id_complain`);

--
-- Indexes for table `concession`
--
ALTER TABLE `concession`
  ADD PRIMARY KEY (`id_concession`);

--
-- Indexes for table `control_account`
--
ALTER TABLE `control_account`
  ADD PRIMARY KEY (`id_control_account`);

--
-- Indexes for table `cost_center_type`
--
ALTER TABLE `cost_center_type`
  ADD PRIMARY KEY (`id_cost_center_type`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_diary`
--
ALTER TABLE `daily_diary`
  ADD PRIMARY KEY (`id_daily_diary`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `download_syllabus`
--
ALTER TABLE `download_syllabus`
  ADD PRIMARY KEY (`id_download_syllabus`);

--
-- Indexes for table `dues`
--
ALTER TABLE `dues`
  ADD PRIMARY KEY (`id_dues`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `exam_marks_details`
--
ALTER TABLE `exam_marks_details`
  ADD PRIMARY KEY (`id_marks_detail`);

--
-- Indexes for table `exam_types`
--
ALTER TABLE `exam_types`
  ADD PRIMARY KEY (`id_exam_types`);

--
-- Indexes for table `expanses`
--
ALTER TABLE `expanses`
  ADD PRIMARY KEY (`id_expanses`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id_fees`);

--
-- Indexes for table `fee_heads`
--
ALTER TABLE `fee_heads`
  ADD PRIMARY KEY (`id_fee_heads`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`id_fee_type`);

--
-- Indexes for table `fmc`
--
ALTER TABLE `fmc`
  ADD PRIMARY KEY (`id_fmc`);

--
-- Indexes for table `foc`
--
ALTER TABLE `foc`
  ADD PRIMARY KEY (`id_foc`);

--
-- Indexes for table `gallery_details`
--
ALTER TABLE `gallery_details`
  ADD PRIMARY KEY (`id_gallery_details`);

--
-- Indexes for table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id_general_setting`);

--
-- Indexes for table `good_return_note`
--
ALTER TABLE `good_return_note`
  ADD PRIMARY KEY (`id_good_return_note`);

--
-- Indexes for table `good_return_note_detail`
--
ALTER TABLE `good_return_note_detail`
  ADD PRIMARY KEY (`id_good_return_note_detail`);

--
-- Indexes for table `grade_setting`
--
ALTER TABLE `grade_setting`
  ADD PRIMARY KEY (`id_grades`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id_inquery`);

--
-- Indexes for table `main_account`
--
ALTER TABLE `main_account`
  ADD PRIMARY KEY (`id_main_account`);

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id_main_menu`);

--
-- Indexes for table `master_gallery`
--
ALTER TABLE `master_gallery`
  ADD PRIMARY KEY (`id_master_gallery`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id_month`);

--
-- Indexes for table `net_profit`
--
ALTER TABLE `net_profit`
  ADD PRIMARY KEY (`id_net_profit`);

--
-- Indexes for table `packing_types`
--
ALTER TABLE `packing_types`
  ADD PRIMARY KEY (`packaging_id`);

--
-- Indexes for table `payment_advice`
--
ALTER TABLE `payment_advice`
  ADD PRIMARY KEY (`id_payment_advice`);

--
-- Indexes for table `payment_advice_details`
--
ALTER TABLE `payment_advice_details`
  ADD PRIMARY KEY (`id_payment_advice_details`);

--
-- Indexes for table `po_condition`
--
ALTER TABLE `po_condition`
  ADD PRIMARY KEY (`id_po_condition`);

--
-- Indexes for table `po_details`
--
ALTER TABLE `po_details`
  ADD PRIMARY KEY (`id_po_details`);

--
-- Indexes for table `po_grn`
--
ALTER TABLE `po_grn`
  ADD PRIMARY KEY (`id_po_grn`);

--
-- Indexes for table `po_grn_detail`
--
ALTER TABLE `po_grn_detail`
  ADD PRIMARY KEY (`id_po_grn_detail`);

--
-- Indexes for table `po_status`
--
ALTER TABLE `po_status`
  ADD PRIMARY KEY (`id_po_status`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_products`);

--
-- Indexes for table `producttypes`
--
ALTER TABLE `producttypes`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id_purchase_orders`);

--
-- Indexes for table `purchase_return_note`
--
ALTER TABLE `purchase_return_note`
  ADD PRIMARY KEY (`id_prn_note`);

--
-- Indexes for table `purchase_return_note_detail`
--
ALTER TABLE `purchase_return_note_detail`
  ADD PRIMARY KEY (`id_prn_note_detail`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id_reasons`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id_registration`);

--
-- Indexes for table `remarks_for_students`
--
ALTER TABLE `remarks_for_students`
  ADD PRIMARY KEY (`id_remarks_for_students`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indexes for table `scheduler`
--
ALTER TABLE `scheduler`
  ADD PRIMARY KEY (`id_scheduler`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id_session`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `sms_log`
--
ALTER TABLE `sms_log`
  ADD PRIMARY KEY (`id_sms_log`);

--
-- Indexes for table `sms_setting`
--
ALTER TABLE `sms_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `students_master_details`
--
ALTER TABLE `students_master_details`
  ADD PRIMARY KEY (`id_master_details`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id_attendance`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id_subjects`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id_suggestion`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id_suppliers`);

--
-- Indexes for table `supplier_category`
--
ALTER TABLE `supplier_category`
  ADD PRIMARY KEY (`id_supplier_category`);

--
-- Indexes for table `supplier_products`
--
ALTER TABLE `supplier_products`
  ADD PRIMARY KEY (`id_supplier_products`);

--
-- Indexes for table `temp_attendance`
--
ALTER TABLE `temp_attendance`
  ADD PRIMARY KEY (`id_attendance`),
  ADD UNIQUE KEY `id_attendance` (`id_attendance`);

--
-- Indexes for table `temp_dues_double_copy`
--
ALTER TABLE `temp_dues_double_copy`
  ADD PRIMARY KEY (`id_temp_dues`);

--
-- Indexes for table `timezone`
--
ALTER TABLE `timezone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_account`
--
ALTER TABLE `transaction_account`
  ADD PRIMARY KEY (`id_transaction_account`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role_management`
--
ALTER TABLE `users_role_management`
  ADD PRIMARY KEY (`id_menu_user_role`);

--
-- Indexes for table `video_gallery`
--
ALTER TABLE `video_gallery`
  ADD PRIMARY KEY (`id_video_gallery`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_voucher`
--
ALTER TABLE `account_voucher`
  MODIFY `id_account_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `account_voucher_details`
--
ALTER TABLE `account_voucher_details`
  MODIFY `id_account_voucher_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `account_voucher_type`
--
ALTER TABLE `account_voucher_type`
  MODIFY `id_account_voucher_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id_notifications` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apps_countries`
--
ALTER TABLE `apps_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `business_partners`
--
ALTER TABLE `business_partners`
  MODIFY `id_business_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id_campus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cash_register`
--
ALTER TABLE `cash_register`
  MODIFY `id_cash_register` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classes_sections`
--
ALTER TABLE `classes_sections`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id_complain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `concession`
--
ALTER TABLE `concession`
  MODIFY `id_concession` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `control_account`
--
ALTER TABLE `control_account`
  MODIFY `id_control_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `cost_center_type`
--
ALTER TABLE `cost_center_type`
  MODIFY `id_cost_center_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT for table `daily_diary`
--
ALTER TABLE `daily_diary`
  MODIFY `id_daily_diary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `download_syllabus`
--
ALTER TABLE `download_syllabus`
  MODIFY `id_download_syllabus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dues`
--
ALTER TABLE `dues`
  MODIFY `id_dues` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1169;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `exam_marks_details`
--
ALTER TABLE `exam_marks_details`
  MODIFY `id_marks_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `exam_types`
--
ALTER TABLE `exam_types`
  MODIFY `id_exam_types` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expanses`
--
ALTER TABLE `expanses`
  MODIFY `id_expanses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id_fees` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;
--
-- AUTO_INCREMENT for table `fee_heads`
--
ALTER TABLE `fee_heads`
  MODIFY `id_fee_heads` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id_fee_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `fmc`
--
ALTER TABLE `fmc`
  MODIFY `id_fmc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `foc`
--
ALTER TABLE `foc`
  MODIFY `id_foc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gallery_details`
--
ALTER TABLE `gallery_details`
  MODIFY `id_gallery_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id_general_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `good_return_note`
--
ALTER TABLE `good_return_note`
  MODIFY `id_good_return_note` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `good_return_note_detail`
--
ALTER TABLE `good_return_note_detail`
  MODIFY `id_good_return_note_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade_setting`
--
ALTER TABLE `grade_setting`
  MODIFY `id_grades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id_inquery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `main_account`
--
ALTER TABLE `main_account`
  MODIFY `id_main_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `id_main_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `master_gallery`
--
ALTER TABLE `master_gallery`
  MODIFY `id_master_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id_month` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `net_profit`
--
ALTER TABLE `net_profit`
  MODIFY `id_net_profit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packing_types`
--
ALTER TABLE `packing_types`
  MODIFY `packaging_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment_advice`
--
ALTER TABLE `payment_advice`
  MODIFY `id_payment_advice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `payment_advice_details`
--
ALTER TABLE `payment_advice_details`
  MODIFY `id_payment_advice_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `po_condition`
--
ALTER TABLE `po_condition`
  MODIFY `id_po_condition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `po_details`
--
ALTER TABLE `po_details`
  MODIFY `id_po_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `po_grn`
--
ALTER TABLE `po_grn`
  MODIFY `id_po_grn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=576;
--
-- AUTO_INCREMENT for table `po_grn_detail`
--
ALTER TABLE `po_grn_detail`
  MODIFY `id_po_grn_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `po_status`
--
ALTER TABLE `po_status`
  MODIFY `id_po_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_products` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1238;
--
-- AUTO_INCREMENT for table `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id_purchase_orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `purchase_return_note`
--
ALTER TABLE `purchase_return_note`
  MODIFY `id_prn_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `purchase_return_note_detail`
--
ALTER TABLE `purchase_return_note_detail`
  MODIFY `id_prn_note_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id_reasons` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id_registration` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `remarks_for_students`
--
ALTER TABLE `remarks_for_students`
  MODIFY `id_remarks_for_students` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `scheduler`
--
ALTER TABLE `scheduler`
  MODIFY `id_scheduler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sms_log`
--
ALTER TABLE `sms_log`
  MODIFY `id_sms_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=718;
--
-- AUTO_INCREMENT for table `sms_setting`
--
ALTER TABLE `sms_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students_master_details`
--
ALTER TABLE `students_master_details`
  MODIFY `id_master_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id_attendance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2634;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id_subjects` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id_suggestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_suppliers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `supplier_category`
--
ALTER TABLE `supplier_category`
  MODIFY `id_supplier_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id_supplier_products` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1051;
--
-- AUTO_INCREMENT for table `temp_attendance`
--
ALTER TABLE `temp_attendance`
  MODIFY `id_attendance` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_dues_double_copy`
--
ALTER TABLE `temp_dues_double_copy`
  MODIFY `id_temp_dues` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timezone`
--
ALTER TABLE `timezone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `transaction_account`
--
ALTER TABLE `transaction_account`
  MODIFY `id_transaction_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users_role_management`
--
ALTER TABLE `users_role_management`
  MODIFY `id_menu_user_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;
--
-- AUTO_INCREMENT for table `video_gallery`
--
ALTER TABLE `video_gallery`
  MODIFY `id_video_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
