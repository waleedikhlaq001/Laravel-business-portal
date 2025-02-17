-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 09, 2021 at 11:07 AM
-- Server version: 5.7.32
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `vicomma`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `proposal` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `influencer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min` double(8,2) NOT NULL,
  `max` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `name`, `min`, `max`, `created_at`, `updated_at`) VALUES
(1, 'Micro Project', 4800.00, 14400.00, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(2, 'Small Project', 14400.00, 120000.00, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(3, 'Medium Project', 120000.00, 360000.00, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(4, 'Large Project', 360000.00, 720000.00, '2021-06-09 10:05:34', '2021-06-09 10:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `residule_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `residule_id`) VALUES
(1, 'Cosmetics', '2021-06-09 10:05:34', '2021-06-09 10:05:34', 1),
(2, 'Clothes and Fashion', '2021-06-09 10:05:34', '2021-06-09 10:05:34', 2),
(3, 'Electronics', '2021-06-09 10:05:34', '2021-06-09 10:05:34', 2);

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE `contests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `sort` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `country_id`, `sort`, `phone_code`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 1, 'AF', 93, NULL, NULL),
(2, 'Albania', 2, 'AL', 355, NULL, NULL),
(3, 'Algeria', 3, 'DZ', 213, NULL, NULL),
(4, 'American Samoa', 4, 'AS', 1684, NULL, NULL),
(5, 'Andorra', 5, 'AD', 376, NULL, NULL),
(6, 'Angola', 6, 'AO', 244, NULL, NULL),
(7, 'Anguilla', 7, 'AI', 1264, NULL, NULL),
(8, 'Antarctica', 8, 'AQ', 0, NULL, NULL),
(9, 'Antigua And Barbuda', 9, 'AG', 1268, NULL, NULL),
(10, 'Argentina', 10, 'AR', 54, NULL, NULL),
(11, 'Armenia', 11, 'AM', 374, NULL, NULL),
(12, 'Aruba', 12, 'AW', 297, NULL, NULL),
(13, 'Australia', 13, 'AU', 61, NULL, NULL),
(14, 'Austria', 14, 'AT', 43, NULL, NULL),
(15, 'Azerbaijan', 15, 'AZ', 994, NULL, NULL),
(16, 'Bahamas The', 16, 'BS', 1242, NULL, NULL),
(17, 'Bahrain', 17, 'BH', 973, NULL, NULL),
(18, 'Bangladesh', 18, 'BD', 880, NULL, NULL),
(19, 'Barbados', 19, 'BB', 1246, NULL, NULL),
(20, 'Belarus', 20, 'BY', 375, NULL, NULL),
(21, 'Belgium', 21, 'BE', 32, NULL, NULL),
(22, 'Belize', 22, 'BZ', 501, NULL, NULL),
(23, 'Benin', 23, 'BJ', 229, NULL, NULL),
(24, 'Bermuda', 24, 'BM', 1441, NULL, NULL),
(25, 'Bhutan', 25, 'BT', 975, NULL, NULL),
(26, 'Bolivia', 26, 'BO', 591, NULL, NULL),
(27, 'Bosnia and Herzegovina', 27, 'BA', 387, NULL, NULL),
(28, 'Botswana', 28, 'BW', 267, NULL, NULL),
(29, 'Bouvet Island', 29, 'BV', 0, NULL, NULL),
(30, 'Brazil', 30, 'BR', 55, NULL, NULL),
(31, 'British Indian Ocean Territory', 31, 'IO', 246, NULL, NULL),
(32, 'Brunei', 32, 'BN', 673, NULL, NULL),
(33, 'Bulgaria', 33, 'BG', 359, NULL, NULL),
(34, 'Burkina Faso', 34, 'BF', 226, NULL, NULL),
(35, 'Burundi', 35, 'BI', 257, NULL, NULL),
(36, 'Cambodia', 36, 'KH', 855, NULL, NULL),
(37, 'Cameroon', 37, 'CM', 237, NULL, NULL),
(38, 'Canada', 38, 'CA', 1, NULL, NULL),
(39, 'Cape Verde', 39, 'CV', 238, NULL, NULL),
(40, 'Cayman Islands', 40, 'KY', 1345, NULL, NULL),
(41, 'Central African Republic', 41, 'CF', 236, NULL, NULL),
(42, 'Chad', 42, 'TD', 235, NULL, NULL),
(43, 'Chile', 43, 'CL', 56, NULL, NULL),
(44, 'China', 44, 'CN', 86, NULL, NULL),
(45, 'Christmas Island', 45, 'CX', 61, NULL, NULL),
(46, 'Cocos (Keeling) Islands', 46, 'CC', 672, NULL, NULL),
(47, 'Colombia', 47, 'CO', 57, NULL, NULL),
(48, 'Comoros', 48, 'KM', 269, NULL, NULL),
(49, 'Republic Of The Congo', 49, 'CG', 242, NULL, NULL),
(50, 'Democratic Republic Of The Congo', 50, 'CD', 242, NULL, NULL),
(51, 'Cook Islands', 51, 'CK', 682, NULL, NULL),
(52, 'Costa Rica', 52, 'CR', 506, NULL, NULL),
(53, 'Cote D Ivoire (Ivory Coast)', 53, 'CI', 225, NULL, NULL),
(54, 'Croatia (Hrvatska)', 54, 'HR', 385, NULL, NULL),
(55, 'Cuba', 55, 'CU', 53, NULL, NULL),
(56, 'Cyprus', 56, 'CY', 357, NULL, NULL),
(57, 'Czech Republic', 57, 'CZ', 420, NULL, NULL),
(58, 'Denmark', 58, 'DK', 45, NULL, NULL),
(59, 'Djibouti', 59, 'DJ', 253, NULL, NULL),
(60, 'Dominica', 60, 'DM', 1767, NULL, NULL),
(61, 'Dominican Republic', 61, 'DO', 1809, NULL, NULL),
(62, 'East Timor', 62, 'TP', 670, NULL, NULL),
(63, 'Ecuador', 63, 'EC', 593, NULL, NULL),
(64, 'Egypt', 64, 'EG', 20, NULL, NULL),
(65, 'El Salvador', 65, 'SV', 503, NULL, NULL),
(66, 'Equatorial Guinea', 66, 'GQ', 240, NULL, NULL),
(67, 'Eritrea', 67, 'ER', 291, NULL, NULL),
(68, 'Estonia', 68, 'EE', 372, NULL, NULL),
(69, 'Ethiopia', 69, 'ET', 251, NULL, NULL),
(70, 'External Territories of Australia', 70, 'XA', 61, NULL, NULL),
(71, 'Falkland Islands', 71, 'FK', 500, NULL, NULL),
(72, 'Faroe Islands', 72, 'FO', 298, NULL, NULL),
(73, 'Fiji Islands', 73, 'FJ', 679, NULL, NULL),
(74, 'Finland', 74, 'FI', 358, NULL, NULL),
(75, 'France', 75, 'FR', 33, NULL, NULL),
(76, 'French Guiana', 76, 'GF', 594, NULL, NULL),
(77, 'French Polynesia', 77, 'PF', 689, NULL, NULL),
(78, 'French Southern Territories', 78, 'TF', 0, NULL, NULL),
(79, 'Gabon', 79, 'GA', 241, NULL, NULL),
(80, 'Gambia The', 80, 'GM', 220, NULL, NULL),
(81, 'Georgia', 81, 'GE', 995, NULL, NULL),
(82, 'Germany', 82, 'DE', 49, NULL, NULL),
(83, 'Ghana', 83, 'GH', 233, NULL, NULL),
(84, 'Gibraltar', 84, 'GI', 350, NULL, NULL),
(85, 'Greece', 85, 'GR', 30, NULL, NULL),
(86, 'Greenland', 86, 'GL', 299, NULL, NULL),
(87, 'Grenada', 87, 'GD', 1473, NULL, NULL),
(88, 'Guadeloupe', 88, 'GP', 590, NULL, NULL),
(89, 'Guam', 89, 'GU', 1671, NULL, NULL),
(90, 'Guatemala', 90, 'GT', 502, NULL, NULL),
(91, 'Guernsey and Alderney', 91, 'XU', 44, NULL, NULL),
(92, 'Guinea', 92, 'GN', 224, NULL, NULL),
(93, 'Guinea-Bissau', 93, 'GW', 245, NULL, NULL),
(94, 'Guyana', 94, 'GY', 592, NULL, NULL),
(95, 'Haiti', 95, 'HT', 509, NULL, NULL),
(96, 'Heard and McDonald Islands', 96, 'HM', 0, NULL, NULL),
(97, 'Honduras', 97, 'HN', 504, NULL, NULL),
(98, 'Hong Kong S.A.R.', 98, 'HK', 852, NULL, NULL),
(99, 'Hungary', 99, 'HU', 36, NULL, NULL),
(100, 'Iceland', 100, 'IS', 354, NULL, NULL),
(101, 'India', 101, 'IN', 91, NULL, NULL),
(102, 'Indonesia', 102, 'country_id', 62, NULL, NULL),
(103, 'Iran', 103, 'IR', 98, NULL, NULL),
(104, 'Iraq', 104, 'IQ', 964, NULL, NULL),
(105, 'Ireland', 105, 'IE', 353, NULL, NULL),
(106, 'Israel', 106, 'IL', 972, NULL, NULL),
(107, 'Italy', 107, 'IT', 39, NULL, NULL),
(108, 'Jamaica', 108, 'JM', 1876, NULL, NULL),
(109, 'Japan', 109, 'JP', 81, NULL, NULL),
(110, 'Jersey', 110, 'XJ', 44, NULL, NULL),
(111, 'Jordan', 111, 'JO', 962, NULL, NULL),
(112, 'Kazakhstan', 112, 'KZ', 7, NULL, NULL),
(113, 'Kenya', 113, 'KE', 254, NULL, NULL),
(114, 'Kiribati', 114, 'KI', 686, NULL, NULL),
(115, 'Korea North', 115, 'KP', 850, NULL, NULL),
(116, 'Korea South', 116, 'KR', 82, NULL, NULL),
(117, 'Kuwait', 117, 'KW', 965, NULL, NULL),
(118, 'Kyrgyzstan', 118, 'KG', 996, NULL, NULL),
(119, 'Laos', 119, 'LA', 856, NULL, NULL),
(120, 'Latvia', 120, 'LV', 371, NULL, NULL),
(121, 'Lebanon', 121, 'LB', 961, NULL, NULL),
(122, 'Lesotho', 122, 'LS', 266, NULL, NULL),
(123, 'Liberia', 123, 'LR', 231, NULL, NULL),
(124, 'Libya', 124, 'LY', 218, NULL, NULL),
(125, 'Liechtenstein', 125, 'LI', 423, NULL, NULL),
(126, 'Lithuania', 126, 'LT', 370, NULL, NULL),
(127, 'Luxembourg', 127, 'LU', 352, NULL, NULL),
(128, 'Macau S.A.R.', 128, 'MO', 853, NULL, NULL),
(129, 'Macedonia', 129, 'MK', 389, NULL, NULL),
(130, 'Madagascar', 130, 'MG', 261, NULL, NULL),
(131, 'Malawi', 131, 'MW', 265, NULL, NULL),
(132, 'Malaysia', 132, 'MY', 60, NULL, NULL),
(133, 'Maldives', 133, 'MV', 960, NULL, NULL),
(134, 'Mali', 134, 'ML', 223, NULL, NULL),
(135, 'Malta', 135, 'MT', 356, NULL, NULL),
(136, 'Man (Isle of)', 136, 'XM', 44, NULL, NULL),
(137, 'Marshall Islands', 137, 'MH', 692, NULL, NULL),
(138, 'Martinique', 138, 'MQ', 596, NULL, NULL),
(139, 'Mauritania', 139, 'MR', 222, NULL, NULL),
(140, 'Mauritius', 140, 'MU', 230, NULL, NULL),
(141, 'Mayotte', 141, 'YT', 269, NULL, NULL),
(142, 'Mexico', 142, 'MX', 52, NULL, NULL),
(143, 'Micronesia', 143, 'FM', 691, NULL, NULL),
(144, 'Moldova', 144, 'MD', 373, NULL, NULL),
(145, 'Monaco', 145, 'MC', 377, NULL, NULL),
(146, 'Mongolia', 146, 'MN', 976, NULL, NULL),
(147, 'Montserrat', 147, 'MS', 1664, NULL, NULL),
(148, 'Morocco', 148, 'MA', 212, NULL, NULL),
(149, 'Mozambique', 149, 'MZ', 258, NULL, NULL),
(150, 'Myanmar', 150, 'MM', 95, NULL, NULL),
(151, 'Namibia', 151, 'NA', 264, NULL, NULL),
(152, 'Nauru', 152, 'NR', 674, NULL, NULL),
(153, 'Nepal', 153, 'NP', 977, NULL, NULL),
(154, 'Netherlands Antilles', 154, 'AN', 599, NULL, NULL),
(155, 'Netherlands The', 155, 'NL', 31, NULL, NULL),
(156, 'New Caledonia', 156, 'NC', 687, NULL, NULL),
(157, 'New Zealand', 157, 'NZ', 64, NULL, NULL),
(158, 'Nicaragua', 158, 'NI', 505, NULL, NULL),
(159, 'Niger', 159, 'NE', 227, NULL, NULL),
(160, 'Nigeria', 160, 'NG', 234, NULL, NULL),
(161, 'Niue', 161, 'NU', 683, NULL, NULL),
(162, 'Norfolk Island', 162, 'NF', 672, NULL, NULL),
(163, 'Northern Mariana Islands', 163, 'MP', 1670, NULL, NULL),
(164, 'Norway', 164, 'NO', 47, NULL, NULL),
(165, 'Oman', 165, 'OM', 968, NULL, NULL),
(166, 'Pakistan', 166, 'PK', 92, NULL, NULL),
(167, 'Palau', 167, 'PW', 680, NULL, NULL),
(168, 'Palestinian Territory Occupied', 168, 'PS', 970, NULL, NULL),
(169, 'Panama', 169, 'PA', 507, NULL, NULL),
(170, 'Papua new Guinea', 170, 'PG', 675, NULL, NULL),
(171, 'Paraguay', 171, 'PY', 595, NULL, NULL),
(172, 'Peru', 172, 'PE', 51, NULL, NULL),
(173, 'Philippines', 173, 'PH', 63, NULL, NULL),
(174, 'Pitcairn Island', 174, 'PN', 0, NULL, NULL),
(175, 'Poland', 175, 'PL', 48, NULL, NULL),
(176, 'Portugal', 176, 'PT', 351, NULL, NULL),
(177, 'Puerto Rico', 177, 'PR', 1787, NULL, NULL),
(178, 'Qatar', 178, 'QA', 974, NULL, NULL),
(179, 'Reunion', 179, 'RE', 262, NULL, NULL),
(180, 'Romania', 180, 'RO', 40, NULL, NULL),
(181, 'Russia', 181, 'RU', 70, NULL, NULL),
(182, 'Rwanda', 182, 'RW', 250, NULL, NULL),
(183, 'Saint Helena', 183, 'SH', 290, NULL, NULL),
(184, 'Saint Kitts And Nevis', 184, 'KN', 1869, NULL, NULL),
(185, 'Saint Lucia', 185, 'LC', 1758, NULL, NULL),
(186, 'Saint Pierre and Miquelon', 186, 'PM', 508, NULL, NULL),
(187, 'Saint Vincent And The Grenadines', 187, 'VC', 1784, NULL, NULL),
(188, 'Samoa', 188, 'WS', 684, NULL, NULL),
(189, 'San Marino', 189, 'SM', 378, NULL, NULL),
(190, 'Sao Tome and Principe', 190, 'ST', 239, NULL, NULL),
(191, 'Saudi Arabia', 191, 'SA', 966, NULL, NULL),
(192, 'Senegal', 192, 'SN', 221, NULL, NULL),
(193, 'Serbia', 193, 'RS', 381, NULL, NULL),
(194, 'Seychelles', 194, 'SC', 248, NULL, NULL),
(195, 'Sierra Leone', 195, 'SL', 232, NULL, NULL),
(196, 'Singapore', 196, 'SG', 65, NULL, NULL),
(197, 'Slovakia', 197, 'SK', 421, NULL, NULL),
(198, 'Slovenia', 198, 'SI', 386, NULL, NULL),
(199, 'Smaller Territories of the UK', 199, 'XG', 44, NULL, NULL),
(200, 'Solomon Islands', 200, 'SB', 677, NULL, NULL),
(201, 'Somalia', 201, 'SO', 252, NULL, NULL),
(202, 'South Africa', 202, 'ZA', 27, NULL, NULL),
(203, 'South Georgia', 203, 'GS', 0, NULL, NULL),
(204, 'South Sudan', 204, 'SS', 211, NULL, NULL),
(205, 'Spain', 205, 'ES', 34, NULL, NULL),
(206, 'Sri Lanka', 206, 'LK', 94, NULL, NULL),
(207, 'Sudan', 207, 'SD', 249, NULL, NULL),
(208, 'Suriname', 208, 'SR', 597, NULL, NULL),
(209, 'Svalbard And Jan Mayen Islands', 209, 'SJ', 47, NULL, NULL),
(210, 'Swaziland', 210, 'SZ', 268, NULL, NULL),
(211, 'Sweden', 211, 'SE', 46, NULL, NULL),
(212, 'Switzerland', 212, 'CH', 41, NULL, NULL),
(213, 'Syria', 213, 'SY', 963, NULL, NULL),
(214, 'Taiwan', 214, 'TW', 886, NULL, NULL),
(215, 'Tajikistan', 215, 'TJ', 992, NULL, NULL),
(216, 'Tanzania', 216, 'TZ', 255, NULL, NULL),
(217, 'Thailand', 217, 'TH', 66, NULL, NULL),
(218, 'Togo', 218, 'TG', 228, NULL, NULL),
(219, 'Tokelau', 219, 'TK', 690, NULL, NULL),
(220, 'Tonga', 220, 'TO', 676, NULL, NULL),
(221, 'Trincountry_idad And Tobago', 221, 'TT', 1868, NULL, NULL),
(222, 'Tunisia', 222, 'TN', 216, NULL, NULL),
(223, 'Turkey', 223, 'TR', 90, NULL, NULL),
(224, 'Turkmenistan', 224, 'TM', 7370, NULL, NULL),
(225, 'Turks And Caicos Islands', 225, 'TC', 1649, NULL, NULL),
(226, 'Tuvalu', 226, 'TV', 688, NULL, NULL),
(227, 'Uganda', 227, 'UG', 256, NULL, NULL),
(228, 'Ukraine', 228, 'UA', 380, NULL, NULL),
(229, 'United Arab Emirates', 229, 'AE', 971, NULL, NULL),
(230, 'United Kingdom', 230, 'GB', 44, NULL, NULL),
(231, 'United States', 231, 'US', 1, NULL, NULL),
(232, 'United States Minor Outlying Islands', 232, 'UM', 1, NULL, NULL),
(233, 'Uruguay', 233, 'UY', 598, NULL, NULL),
(234, 'Uzbekistan', 234, 'UZ', 998, NULL, NULL),
(235, 'Vanuatu', 235, 'VU', 678, NULL, NULL),
(236, 'Vatican City State (Holy See)', 236, 'VA', 39, NULL, NULL),
(237, 'Venezuela', 237, 'VE', 58, NULL, NULL),
(238, 'Vietnam', 238, 'VN', 84, NULL, NULL),
(239, 'Virgin Islands (British)', 239, 'VG', 1284, NULL, NULL),
(240, 'Virgin Islands (US)', 240, 'VI', 1340, NULL, NULL),
(241, 'Wallis And Futuna Islands', 241, 'WF', 681, NULL, NULL),
(242, 'Western Sahara', 242, 'EH', 212, NULL, NULL),
(243, 'Yemen', 243, 'YE', 967, NULL, NULL),
(244, 'Yugoslavia', 244, 'YU', 38, NULL, NULL),
(245, 'Zambia', 245, 'ZM', 260, NULL, NULL),
(246, 'Zimbabwe', 246, 'ZW', 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Inactive = 0, Active = 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `status`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 1, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(2, 'Naira', '₦', 1, '2021-06-09 10:05:34', '2021-06-09 10:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_payments`
--

CREATE TABLE `fixed_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hourly_payments`
--

CREATE TABLE `hourly_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `influencers`
--

CREATE TABLE `influencers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_followers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_followers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok_views` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `influencer_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `influencer_category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `influencer_categories`
--

CREATE TABLE `influencer_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `provided_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `influencer_categories`
--

INSERT INTO `influencer_categories` (`id`, `name`, `description`, `min`, `max`, `provided_for`, `created_at`, `updated_at`) VALUES
(1, 'Nano Influencers', 'Caters small to mid size business with a limited marketing budget', 1, 10000, 'If you want to test a product launch or test your products and services with a new niche', '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(2, 'Micro Influencers', 'If you are ready to start generating more focused leads', 10000, 100000, 'This is more specialized so that the audience we reach for you is primed to hear marketing messages within the niche you want to reach', '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(3, 'Macro Influencers', 'we are ty[ically more established bloggers,social celebrities, or podcasters. we typically have a large audience who we have developed over months or years of nurturing relationships while growing followers', 100000, 1000000, 'This is great for bringing awareness to your brand, products, and services. Use this to increase your own engagement rates and boost your exisiting brand\'s reach.,We can help you reach a larger audience and increase your brand\'s reputation.', '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(4, 'Mega Influencers', 'You\'ll have to have a healthy marketing budget to afford us. we are typically celebrities/internet stars.The audiences we attract for you are going to be very broad.', 1000000, 10000000, 'you\'re working on a brand awareness campaign and have a large budget, here we can get your products in front of as many eyes as possible which is great if your brand has appeal across segments.', '2021-06-09 10:05:34', '2021-06-09 10:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `influencer_types`
--

CREATE TABLE `influencer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `influencer_types`
--

INSERT INTO `influencer_types` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Free', 0.00, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(2, 'Pivotal', 2800.20, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(3, 'Moving Up', 4300.20, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(4, 'Premium', 6300.20, '2021-06-09 10:05:34', '2021-06-09 10:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Inactive = 0, Active = 1',
  `unique_id` int(11) NOT NULL,
  `influencer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `budget_id` bigint(20) UNSIGNED DEFAULT NULL,
  `video_content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(227, '2014_10_12_100000_create_password_resets_table', 1),
(228, '2019_08_19_000000_create_failed_jobs_table', 1),
(229, '2021_04_04_205006_create_roles_table', 1),
(230, '2021_04_04_211627_create_countries_table', 1),
(231, '2021_04_04_211629_create_users_table', 1),
(232, '2021_04_04_213056_create_vendor_types_table', 1),
(233, '2021_04_04_213117_create_influencer_types_table', 1),
(234, '2021_04_04_213118_create_influencer_categories', 1),
(235, '2021_04_04_213411_create_influencers_table', 1),
(236, '2021_04_04_213411_create_vendors_table', 1),
(237, '2021_04_04_225105_create_role_user_table', 1),
(238, '2021_04_14_210419_create_tokens_table', 1),
(239, '2021_04_17_230407_add_description_to_users_table', 1),
(240, '2021_04_17_230714_add_state_to_users_table', 1),
(241, '2021_04_20_221214_alter_table_vendors', 1),
(242, '2021_04_21_230202_create_currencies_table', 1),
(243, '2021_04_22_162729_clear', 1),
(244, '2021_04_22_163006_create_fixed_payments_table', 1),
(245, '2021_04_22_163058_create_hourly_payments_table', 1),
(246, '2021_04_23_065924_create_residule_payments_table', 1),
(247, '2021_04_23_074321_create_categories_table', 1),
(248, '2021_04_23_074350_create_attachments_table', 1),
(249, '2021_04_23_074439_create_video_contents_table', 1),
(250, '2021_04_23_084329_create_budgets_table', 1),
(251, '2021_04_23_085115_create_contests_table', 1),
(252, '2021_04_23_085120_create_products_table', 1),
(253, '2021_04_23_085135_create_jobs_table', 1),
(254, '2021_05_01_070649_add_column_to_jobs_table', 1),
(255, '2021_05_19_180656_create_bids_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Inactive = 0, Active = 1',
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `influencer_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residule_payments`
--

CREATE TABLE `residule_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `residule_payments`
--

INSERT INTO `residule_payments` (`id`, `name`, `percentage`, `created_at`, `updated_at`) VALUES
(1, 'cosmetics', 5, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(2, 'clothes', 2, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(3, 'Electronics', 10, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(4, 'cosmetics', 5, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(5, 'clothes', 2, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(6, 'Electronics', 10, '2021-06-09 10:05:34', '2021-06-09 10:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(2, 'Moderator', '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(3, 'Vendor', '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(4, 'Influencer', '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(5, 'General User', '2021-06-09 10:05:34', '2021-06-09 10:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Inactive = 0, Active = 1',
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snapchat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_station` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Inactive = 0, Active = 1',
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#000',
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#6f3c96',
  `button_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#6f3c96',
  `header` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_types`
--

CREATE TABLE `vendor_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_types`
--

INSERT INTO `vendor_types` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Free', 0.00, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(2, 'Pivotal', 2800.20, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(3, 'Moving Up', 4300.20, '2021-06-09 10:05:34', '2021-06-09 10:05:34'),
(4, 'Premium', 6300.20, '2021-06-09 10:05:34', '2021-06-09 10:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `video_contents`
--

CREATE TABLE `video_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `influencer_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_job_id_foreign` (`job_id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_residule_id_foreign` (`residule_id`);

--
-- Indexes for table `contests`
--
ALTER TABLE `contests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fixed_payments`
--
ALTER TABLE `fixed_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hourly_payments`
--
ALTER TABLE `hourly_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencers`
--
ALTER TABLE `influencers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `influencers_influencer_type_id_foreign` (`influencer_type_id`),
  ADD KEY `influencers_user_id_foreign` (`user_id`),
  ADD KEY `influencers_influencer_category_id_foreign` (`influencer_category_id`);

--
-- Indexes for table `influencer_categories`
--
ALTER TABLE `influencer_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencer_types`
--
ALTER TABLE `influencer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_currency_id_foreign` (`currency_id`),
  ADD KEY `jobs_budget_id_foreign` (`budget_id`),
  ADD KEY `jobs_video_content_id_foreign` (`video_content_id`),
  ADD KEY `jobs_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_vendor_id_foreign` (`vendor_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `residule_payments`
--
ALTER TABLE `residule_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendors_vendor_type_id_foreign` (`vendor_type_id`),
  ADD KEY `vendors_user_id_foreign` (`user_id`);

--
-- Indexes for table `vendor_types`
--
ALTER TABLE `vendor_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_contents`
--
ALTER TABLE `video_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_contents_influencer_id_foreign` (`influencer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contests`
--
ALTER TABLE `contests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fixed_payments`
--
ALTER TABLE `fixed_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hourly_payments`
--
ALTER TABLE `hourly_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `influencers`
--
ALTER TABLE `influencers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `influencer_categories`
--
ALTER TABLE `influencer_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `influencer_types`
--
ALTER TABLE `influencer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residule_payments`
--
ALTER TABLE `residule_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_types`
--
ALTER TABLE `vendor_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `video_contents`
--
ALTER TABLE `video_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_residule_id_foreign` FOREIGN KEY (`residule_id`) REFERENCES `residule_payments` (`id`);

--
-- Constraints for table `influencers`
--
ALTER TABLE `influencers`
  ADD CONSTRAINT `influencers_influencer_category_id_foreign` FOREIGN KEY (`influencer_category_id`) REFERENCES `influencer_categories` (`id`),
  ADD CONSTRAINT `influencers_influencer_type_id_foreign` FOREIGN KEY (`influencer_type_id`) REFERENCES `influencer_types` (`id`),
  ADD CONSTRAINT `influencers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`),
  ADD CONSTRAINT `jobs_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `jobs_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`),
  ADD CONSTRAINT `jobs_video_content_id_foreign` FOREIGN KEY (`video_content_id`) REFERENCES `video_contents` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vendors_vendor_type_id_foreign` FOREIGN KEY (`vendor_type_id`) REFERENCES `vendor_types` (`id`);

--
-- Constraints for table `video_contents`
--
ALTER TABLE `video_contents`
  ADD CONSTRAINT `video_contents_influencer_id_foreign` FOREIGN KEY (`influencer_id`) REFERENCES `influencers` (`id`);
