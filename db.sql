-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2018 at 02:16 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `accpted_file_contents`
--

CREATE TABLE `accpted_file_contents` (
  `content_id` int(11) NOT NULL,
  `content_type` varchar(100) NOT NULL,
  `max_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accpted_file_contents`
--

INSERT INTO `accpted_file_contents` (`content_id`, `content_type`, `max_size`) VALUES
(1, 'jpeg', 5),
(2, 'jpg', 5),
(3, 'pdf', 5),
(4, 'png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `addmission`
--

CREATE TABLE `addmission` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `is_inpatient` int(11) NOT NULL DEFAULT '0',
  `consultant_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `block_id` int(11) NOT NULL,
  `block_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `num_floors` int(11) NOT NULL,
  `incharge` int(11) NOT NULL,
  `date_installed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`block_id`, `block_name`, `description`, `num_floors`, `incharge`, `date_installed`) VALUES
(2, 'The Head Block', 'Main Block', 12, 3, '2017-12-02 06:59:06'),
(3, 'Second Block', '2nd Block', 5, 4, '2017-12-02 07:07:32'),
(4, 'OT Block', 'Theatre', 2, 4, '2017-12-02 07:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `canteen`
--

CREATE TABLE `canteen` (
  `food_id` int(11) NOT NULL,
  `food_type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `canteen`
--

INSERT INTO `canteen` (`food_id`, `food_type`, `name`, `price`) VALUES
(1, '', 'Itly', 20),
(2, '', 'Dosa', 25),
(3, '', 'Veg Sandwich', 30),
(4, '', 'Egg Sandwich', 40);

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `charge_id` int(11) NOT NULL,
  `charger_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`charge_id`, `charger_type`) VALUES
(3, 'Consultant Charge'),
(4, 'Room Charge'),
(5, 'Pharmacy'),
(6, 'Pathology & Imaging'),
(7, 'Discounts'),
(8, 'Operation Theatre'),
(9, 'Operation Doctor Charge'),
(10, 'Operation Charge'),
(13, 'Canteen');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `manager_id`) VALUES
(1, 'Acute medical unit', 0),
(2, 'Burn center', 0),
(3, 'Central sterile services department', 0),
(4, 'Coronary care unit', 0),
(5, 'Emergency department', 0),
(6, 'Endoscopy unit', 0),
(7, 'Geriatric intensive-care unit', 0),
(8, 'Intensive care unit', 0),
(9, 'Medical records department', 0),
(10, 'Mental health Emergency Rooms', 0),
(11, 'Neonatal intensive care unit', 0),
(12, 'On-call room', 0),
(13, 'Canteen', 0),
(14, 'Pediatric intensive care unit', 0),
(15, 'Hospital pharmacy', 0),
(16, 'Physical therapy', 0),
(17, 'Post-anesthesia care unit', 0),
(18, 'Margaret and Charles Juravinski Centre', 0),
(19, 'Psychiatric hospital', 0),
(20, 'Release of information department', 0),
(21, 'Hospital warehouse', 0),
(50, 'Administration', 3);

-- --------------------------------------------------------

--
-- Table structure for table `doc_schedule`
--

CREATE TABLE `doc_schedule` (
  `slot_id` int(11) NOT NULL,
  `phy_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `frm_time` varchar(50) NOT NULL,
  `to_time` varchar(50) NOT NULL,
  `reg_id` int(11) DEFAULT NULL,
  `scheduled_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_schedule`
--

INSERT INTO `doc_schedule` (`slot_id`, `phy_id`, `date`, `frm_time`, `to_time`, `reg_id`, `scheduled_at`) VALUES
(23, 4, '05-06-2018', '09:09:00', '', 86, '2018-06-05 07:59:52'),
(24, 4, '07-06-2018', '19:00:00', '', 88, '2018-06-07 14:59:30'),
(7, 4, '13-02-2018', '11:58:00', '', 66, '2018-02-13 17:16:44'),
(6, 4, '13-02-2018', '12:30:00', '', 65, '2018-02-13 17:11:34'),
(5, 4, '13-02-2018', '13:00:00', '', 64, '2018-02-13 16:04:02'),
(8, 4, '13-02-2018', '14:00:00', '', 67, '2018-02-13 17:42:20'),
(10, 4, '18-03-2018', '13:00:00', '', 71, '2018-03-18 18:10:55'),
(1, 7, '01-01-1970', '01:00:00', '', 60, '2018-02-07 18:52:01'),
(3, 7, '07-02-2018', '12:22:00', '', 62, '2018-02-07 18:59:05'),
(2, 7, '07-02-2018', '13:02:00', '', 61, '2018-02-07 18:54:48'),
(4, 7, '07-02-2018', '14:02:00', '', 63, '2018-02-07 19:04:38'),
(9, 7, '13-02-2018', '10:30:00', '', 68, '2018-02-13 17:57:41'),
(13, 7, '19-03-2018', '10:14:00', '', 74, '2018-03-19 05:33:09'),
(12, 7, '19-03-2018', '10:29:00', '', 73, '2018-03-19 05:23:51'),
(14, 7, '19-03-2018', '12:05:00', '', 75, '2018-03-19 05:42:06'),
(11, 7, '19-03-2018', '12:59:00', '', 72, '2018-03-18 19:25:23'),
(17, 7, '19-03-2018', '13:00:00', '', 78, '2018-03-19 15:39:54'),
(16, 7, '19-03-2018', '14:03:00', '', 77, '2018-03-19 05:43:15'),
(27, 7, '30-07-2018', '10:00:00', '', 92, '2018-07-30 14:19:25'),
(18, 7, '31-03-2018', '02:01:00', '', 79, '2018-03-31 11:14:12'),
(19, 7, '31-03-2018', '12:01:00', '', 80, '2018-03-31 13:25:10'),
(20, 7, '31-03-2018', '13:00:00', '', 81, '2018-03-31 13:26:05'),
(22, 7, '31-03-2018', '20:00:00', '', 83, '2018-03-31 13:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `eq_code` int(11) NOT NULL,
  `eq_type` varchar(100) NOT NULL,
  `do_manu` varchar(100) NOT NULL,
  `warrenty_expiry_date` varchar(100) NOT NULL,
  `insurance_expiry_date` varchar(100) NOT NULL,
  `manufact_det` varchar(100) NOT NULL,
  `manu_sup_details` varchar(400) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hosp_details`
--

CREATE TABLE `hosp_details` (
  `hosp_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address_1stline` varchar(100) NOT NULL,
  `address_zip` varchar(10) NOT NULL,
  `address_state` varchar(50) NOT NULL,
  `address_country` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hosp_details`
--

INSERT INTO `hosp_details` (`hosp_id`, `name`, `address_1stline`, `address_zip`, `address_state`, `address_country`, `logo`) VALUES
(1, 'xhms solutions', 'No 6 Vevekanandha street, Dubai Main Road, Dubai cross street', '582685', 'Dubai', 'United Arab Emirites', 'assets/imgs/logo.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `inp_doc_visits`
--

CREATE TABLE `inp_doc_visits` (
  `visit_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `comments` varchar(500) NOT NULL,
  `visited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inp_doc_visits`
--

INSERT INTO `inp_doc_visits` (`visit_id`, `reg_id`, `doc_id`, `comments`, `visited_on`) VALUES
(1, 1, 2, '1', '2017-11-24 20:29:30'),
(2, 1, 2, '1', '2017-11-24 20:30:49'),
(3, 1, 3, '1', '2017-11-25 16:46:54'),
(4, 1, 3, '1', '2017-11-27 14:34:00'),
(5, 1, 3, '1', '2017-12-02 23:18:15'),
(6, 0, 7, '0', '2017-12-02 23:21:51'),
(7, 1, 7, '1', '2017-12-02 23:22:17'),
(8, 1, 7, '1', '2017-12-02 23:22:48'),
(9, 1, 7, '1', '2017-12-05 15:44:03'),
(10, 1, 7, '1', '2017-12-05 15:44:40'),
(11, 1, 7, '1', '2017-12-05 15:45:47'),
(12, 1, 7, '1', '2017-12-05 15:46:09'),
(13, 1, 7, '212', '2017-12-05 15:58:45'),
(14, 1, 7, '212', '2017-12-05 15:59:30'),
(15, 1, 7, '212', '2017-12-05 16:00:23'),
(16, 1, 7, '212', '2017-12-05 16:02:50'),
(17, 1, 7, 'Testing', '2017-12-05 16:16:01'),
(18, 1, 7, 'Testing', '2017-12-05 16:16:03'),
(19, 1, 7, 'Test', '2017-12-09 10:00:53'),
(20, 1, 7, '', '2017-12-27 15:43:14'),
(21, 34, 18, 'knkjhkjh', '2018-01-06 11:09:34'),
(22, 34, 18, 'knkjhkjh', '2018-01-06 11:09:37'),
(23, 34, 18, 'knkjhkjh', '2018-01-06 11:10:02'),
(24, 34, 18, 'knkjhkjh', '2018-01-06 11:10:03'),
(25, 34, 18, 'knkjhkjh', '2018-01-06 11:10:05'),
(26, 34, 18, 'knkjhkjh', '2018-01-06 11:10:05'),
(27, 34, 18, 'knkjhkjh', '2018-01-06 11:10:06'),
(28, 34, 18, 'knkjhkjh', '2018-01-06 11:10:06'),
(29, 34, 18, 'knkjhkjh', '2018-01-06 11:10:12'),
(30, 34, 18, 'knkjhkjh', '2018-01-06 11:10:13'),
(31, 34, 18, 'knkjhkjh', '2018-01-06 11:10:28'),
(32, 34, 18, 'knkjhkjh', '2018-01-06 11:10:29'),
(33, 34, 18, 'knkjhkjh', '2018-01-06 11:10:29'),
(34, 34, 18, 'knkjhkjh', '2018-01-06 11:10:30'),
(35, 34, 18, 'knkjhkjh', '2018-01-06 11:10:30'),
(36, 34, 18, 'knkjhkjh', '2018-01-06 11:10:31'),
(37, 34, 18, 'knkjhkjh', '2018-01-06 11:10:32'),
(38, 34, 18, 'knkjhkjh', '2018-01-06 11:10:32'),
(39, 34, 18, 'knkjhkjh', '2018-01-06 11:10:32'),
(40, 34, 18, 'knkjhkjh', '2018-01-06 11:10:33'),
(41, 34, 18, 'knkjhkjh', '2018-01-06 11:10:33'),
(42, 34, 18, 'knkjhkjh', '2018-01-06 11:10:34'),
(43, 34, 18, 'knkjhkjh', '2018-01-06 11:10:35'),
(44, 34, 18, 'knkjhkjh', '2018-01-06 11:10:35'),
(45, 34, 18, 'knkjhkjh', '2018-01-06 11:10:35'),
(46, 34, 18, 'knkjhkjhlll', '2018-01-06 11:11:15'),
(47, 34, 18, 'knkjhkjhlllhkjhjk', '2018-01-06 11:13:42'),
(48, 34, 18, 'knkjhkjhlllhkjhjk', '2018-01-06 11:13:43'),
(49, 34, 18, 'knkjhkjhlllhkjhjk', '2018-01-06 11:13:44'),
(50, 34, 18, 'knkjhkjhlllhkjhjk', '2018-01-06 11:13:44'),
(51, 34, 18, 'knkjhkjhlllhkjhjk', '2018-01-06 11:13:44'),
(52, 34, 18, 'knkjhkjhlllhkjhjk', '2018-01-06 11:13:44'),
(53, 34, 18, 'knkjhkjhlllhkjhjk', '2018-01-06 11:13:44'),
(54, 34, 18, '', '2018-01-06 11:40:38'),
(55, 34, 18, '', '2018-01-06 11:41:52'),
(56, 52, 18, 'visited', '2018-01-25 09:59:58'),
(57, 52, 18, 'visited', '2018-01-25 09:59:59'),
(58, 52, 18, 'visited', '2018-01-25 10:00:00'),
(59, 52, 18, 'visited', '2018-01-25 10:00:00'),
(60, 52, 18, 'visited', '2018-01-25 10:00:01'),
(61, 0, 4, 'Commentitng', '2018-04-01 20:23:19'),
(62, 0, 18, 'sdfsf', '2018-06-05 09:10:24'),
(63, 0, 18, '2342342', '2018-06-05 09:12:23'),
(64, 0, 18, 'sakljfls;dkf', '2018-06-07 15:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `lab_procedures`
--

CREATE TABLE `lab_procedures` (
  `procedure_id` int(11) NOT NULL,
  `procedure_type` varchar(100) NOT NULL,
  `procedure_name` varchar(100) NOT NULL,
  `procedure_cost` int(100) NOT NULL,
  `result_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_procedures`
--

INSERT INTO `lab_procedures` (`procedure_id`, `procedure_type`, `procedure_name`, `procedure_cost`, `result_days`) VALUES
(1, '', 'ACTH Suppression', 450, 0),
(2, '', 'Adrenocorticotropic Hormone (ACTH)', 450, 0),
(3, '', 'Alanine Aminotransferase (ALT)', 450, 0),
(4, '', 'Albumin', 450, 0),
(5, '', 'Alkaline Phosphatase', 450, 0),
(6, '', 'Allergy Tests', 450, 0),
(7, '', 'Alpha-Fetoprotein (AFP)', 450, 0),
(8, '', 'Amylase', 450, 0),
(9, '', 'Antibody Tests (Coombs Test)', 450, 0),
(10, '', 'Antinuclear Antibodies (ANA)', 450, 0),
(11, '', 'Aspartate Aminotransferase (AST)', 450, 0),
(12, '', 'Bicarbonate (Carbon Dioxide)', 450, 0),
(13, '', 'Bilirubin', 450, 0),
(14, '', 'Blood Culture', 450, 0),
(15, '', 'Blood Glucose', 450, 0),
(16, '', 'Blood Type', 450, 0),
(17, '', 'Blood Urea Nitrogen (BUN)', 450, 0),
(18, '', 'Breast Cancer (BRCA) Gene', 450, 0),
(19, '', 'C-Reactive Protein (CRP)', 450, 0),
(20, '', 'Calcium (Ca)', 450, 0),
(21, '', 'Cardiac Enzyme Studies', 450, 0),
(22, '', 'CD4+ Count', 450, 0),
(23, '', 'Chemistry Screen', 450, 0),
(24, '', 'Chlamydia Tests', 450, 0),
(25, '', 'Chloride (Cl)', 450, 0),
(26, '', 'Cholesterol and Triglycerides', 450, 0),
(27, '', 'Cobalamin', 450, 0),
(28, '', 'Complete Blood Count (CBC)', 450, 0),
(29, '', 'Coombs Test', 450, 0),
(30, '', 'Creatinine and Creatinine Clearance', 450, 0),
(31, '', 'Dexamethasone Suppression Test', 450, 0),
(32, '', 'Electrolyte Panel ', 450, 0),
(33, '', 'Estrogens', 450, 0),
(34, '', 'Folic Acid', 450, 0),
(35, '', 'Follicle-Stimulating Hormone', 450, 0),
(36, '', 'Globulin', 450, 0),
(37, '', 'Glucose', 450, 0),
(38, '', 'Glycohemoglobin (HbA1c, A1c)', 450, 0),
(39, '', 'Gonorrhea', 450, 0),
(40, '', 'Growth Hormone', 450, 0),
(41, '', 'HDL Cholesterol', 450, 0),
(42, '', 'Helicobacter pylori', 450, 0),
(43, '', 'Hepatitis Panel', 450, 0),
(44, '', 'Homocysteine', 450, 0),
(45, '', 'Human Chorionic Gonadotropin (hCG)', 450, 0),
(46, '', 'Human Immunodeficiency Virus (HIV)', 450, 0),
(47, '', 'Iron (Fe)', 450, 0),
(48, '', 'Ketones', 450, 0),
(49, '', 'Lactic Acid Dehydrogenase (LDH)', 450, 0),
(50, '', 'LDL Cholesterol', 450, 0),
(51, '', 'Lead (Pb)', 450, 0),
(52, '', 'Liver Function Panel', 450, 0),
(53, '', 'Magnesium (Mg)', 450, 0),
(54, '', 'Microalbumin Urine Test', 450, 0),
(55, '', 'Mononucleosis  ', 450, 0),
(56, '', 'Oral Glucose Tolerance Test', 450, 0),
(57, '', 'Parathyroid Hormone (PTH)', 450, 0),
(58, '', 'Partial Thromboplastin Time', 450, 0),
(59, '', 'Phosphate (Phosphorus)', 450, 0),
(60, '', 'Potassium (K) in Blood', 450, 0),
(61, '', 'Potassium (K) in Urine', 450, 0),
(62, '', 'Pregnancy Test', 450, 0),
(63, '', 'Progesterone', 450, 0),
(64, '', 'Prolactin', 450, 0),
(65, '', 'Prostate-Specific Antigen (PSA)', 450, 0),
(66, '', 'Prothrombin Time', 450, 0),
(67, '', 'Reticulocyte Count', 450, 0),
(68, '', 'Rheumatoid Factor (RF)', 450, 0),
(69, '', 'Rubella', 450, 0),
(70, '', 'Sedimentation Rate', 450, 0),
(71, '', 'Sickle Cell Test', 450, 0),
(72, '', 'Sodium (Na)', 450, 0),
(73, '', 'Stool Analysis', 450, 0),
(74, '', 'Stool Analysis for Giardiasis (Ova and Parasite Test)', 450, 0),
(75, '', 'Stool Antigen Test', 450, 0),
(76, '', 'Stool Culture', 450, 0),
(77, '', 'Syphilis', 450, 0),
(78, '', 'Testosterone', 450, 0),
(79, '', 'Thyroid Hormone', 450, 0),
(80, '', 'Thyroid-Stimulating Hormone (TSH)', 450, 0),
(81, '', 'Total Serum Protein', 450, 0),
(82, '', 'Uric Acid', 450, 0),
(83, '', 'Urine Test', 450, 0),
(84, '', 'Viral Tests', 450, 0),
(85, '', 'Vitamin B12', 450, 0),
(89, '', '', 0, 0),
(90, '', 'Nname', 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lab_requests`
--

CREATE TABLE `lab_requests` (
  `req_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0->prescriped , 1->testDone , 2->rejected',
  `result` varchar(100) DEFAULT NULL,
  `result_value` int(11) DEFAULT NULL,
  `result_desc` varchar(200) NOT NULL,
  `min_value` int(11) NOT NULL,
  `max_value` int(11) NOT NULL,
  `sample_used` int(11) DEFAULT NULL,
  `sample_used_qty` int(11) DEFAULT NULL,
  `at_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_requests`
--

INSERT INTO `lab_requests` (`req_id`, `test_id`, `reg_id`, `doc_id`, `status`, `result`, `result_value`, `result_desc`, `min_value`, `max_value`, `sample_used`, `sample_used_qty`, `at_time`, `updated_at`) VALUES
(1, 8, 2, 3, 1, 'Normal', 22, '', 0, 0, 0, 0, '2017-11-24 16:14:37', '2017-11-24 13:06:37'),
(2, 9, 2, 3, 1, 'Normal', 24, '', 0, 0, 8, 10, '2017-11-24 18:40:02', '2017-12-25 09:48:47'),
(3, 12, 2, 3, 1, 'Normal', 12, '', 0, 0, 0, 0, '2017-11-25 10:28:14', '2017-11-25 04:58:35'),
(4, 6, 11, 3, 0, NULL, NULL, '', 0, 0, 0, 0, '2017-11-25 21:45:43', NULL),
(5, 7, 11, 3, 0, NULL, NULL, '', 0, 0, 0, 0, '2017-11-25 21:45:43', NULL),
(6, 9, 2, 3, 1, 'Normal', 24, '', 0, 0, 8, 10, '2017-11-27 19:34:17', '2017-12-25 09:48:47'),
(7, 2, 1, 3, 1, 'Normal', 22, '', 0, 0, 0, 0, '2017-12-03 04:08:14', '2017-12-05 07:34:03'),
(8, 7, 1, 3, 1, 'Normal', 24, '', 0, 0, 2, 5, '2017-12-03 04:08:14', '2017-12-20 19:55:05'),
(9, 3, 1, 3, 1, 'Normal', 25, '', 0, 0, 5, 12, '2017-12-05 21:53:46', '2017-12-23 06:32:30'),
(10, 3, 2, 3, 1, 'Normal', 22, '', 0, 0, 9, 2, '2017-12-25 15:15:53', '2017-12-25 10:12:23'),
(11, 3, 7, 3, 1, 'Normal', 22, '', 0, 0, 10, 10, '2017-12-25 16:44:31', '2017-12-25 11:16:02'),
(12, 6, 1, 3, 1, 'Normal', 24, '', 0, 0, 1, 10, '2017-12-25 17:01:15', '2017-12-25 11:31:57'),
(13, 1, 1, 18, 1, 'Normal', 34, '', 0, 0, 4, 5, '2018-01-02 11:23:23', '2018-01-08 16:02:39'),
(14, 5, 33, 18, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-01-06 11:02:33', NULL),
(15, 14, 35, 18, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-01-08 14:55:06', NULL),
(16, 14, 35, 18, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-01-08 14:55:12', NULL),
(17, 12, 42, 18, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-01-16 15:57:10', NULL),
(18, 15, 43, 18, 1, 'Normal', 90, '', 30, 140, 15, 0, '2018-01-17 06:44:01', '2018-01-17 06:47:00'),
(19, 16, 47, 18, 1, 'Normal', 30, '', 30, 120, 16, 5, '2018-01-19 08:59:31', '2018-01-19 09:01:57'),
(20, 31, 47, 18, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-01-19 08:59:31', NULL),
(21, 14, 48, 18, 1, 'Normal', 115, '', 110, 120, 17, 10, '2018-01-22 11:25:00', '2018-01-22 11:35:58'),
(22, 16, 50, 18, 1, 'Normal', 150, '', 100, 200, 18, 5, '2018-01-25 09:50:55', '2018-01-25 09:52:28'),
(23, 12, 54, 18, 1, 'Normal', 150, '', 100, 200, 19, 100, '2018-01-31 16:33:55', '2018-01-31 16:40:08'),
(24, 2, 6, 18, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-02-03 15:57:24', NULL),
(25, 10, 55, 18, 1, 'Normal', 450, '', 100, 1000, 20, 10, '2018-02-04 14:27:04', '2018-02-04 14:30:40'),
(26, 10, 59, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-02-12 16:58:42', NULL),
(27, 86, 59, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-02-12 18:43:18', NULL),
(28, 86, 59, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-02-12 18:45:09', NULL),
(29, 86, 59, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-02-12 18:45:55', NULL),
(30, 89, 59, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-02-12 18:46:50', NULL),
(31, 90, 59, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-02-12 18:47:15', NULL),
(32, 24, 63, 3, 1, 'Normal', 23, '', 21, 40, 21, 12, '2018-03-17 16:32:34', '2018-03-17 16:35:07'),
(33, 31, 63, 3, 1, 'Normal', 12, 'Testing', 2, 22, 21, 2, '2018-03-17 16:45:48', '2018-03-18 17:29:29'),
(34, 24, 71, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-03-18 19:01:01', NULL),
(35, 5, 79, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-03-31 12:44:09', NULL),
(36, 2, 79, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-03-31 13:01:18', NULL),
(37, 7, 83, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-03-31 13:43:10', NULL),
(38, 9, 79, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-04-01 20:45:34', NULL),
(39, 4, 31, 3, 0, NULL, NULL, '', 0, 0, NULL, NULL, '2018-04-02 07:54:31', NULL),
(40, 15, 86, 18, 1, 'Normal', 28, 'resture is normal', 20, 120, 22, 0, '2018-06-05 08:04:45', '2018-06-05 08:07:00'),
(41, 17, 90, 18, 1, 'Normal', 30, 'nodslkafjl;fkdjsfl;a', 20, 120, 23, 10, '2018-06-07 15:01:29', '2018-06-07 15:04:21'),
(42, 25, 92, 18, 1, 'Normal', 140, 'sfsdf', 120, 240, 24, 10, '2018-07-30 14:20:31', '2018-07-30 14:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `med_type` varchar(100) NOT NULL,
  `med_brand` varchar(110) NOT NULL,
  `medicine_name` varchar(300) NOT NULL,
  `rack_num` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_available` int(11) NOT NULL,
  `expiry_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `med_type`, `med_brand`, `medicine_name`, `rack_num`, `price`, `total_available`, `expiry_date`) VALUES
(1, '', '', 'Acetaminophen', 0, 11, 434, ''),
(2, '', '', 'Adderall', 0, 12, 55, ''),
(3, '', '', 'Alprazolam', 0, 13, 55, ''),
(4, '', '', 'Amitriptyline', 0, 5, 30, ''),
(5, '', '', 'Amlodipine', 0, 2, 1, ''),
(6, '', '', 'Amoxicillin', 0, 7, 98, ''),
(7, '', '', 'Ativan', 0, 11, 78, ''),
(8, '', '', 'Atorvastatin', 0, 50, 73, ''),
(9, '', '', 'Azithromycin', 0, 1, 991, ''),
(10, '', '', 'Ciprofloxacin', 0, 3, 98, ''),
(11, '', '', 'Citalopram', 0, 2, 86, ''),
(12, '', '', 'Clindamycin', 0, 0, 100, ''),
(13, '', '', 'Clonazepam', 0, 0, 100, ''),
(14, '', '', 'Codeine', 0, 0, 88, ''),
(15, '', '', 'Cyclobenzaprine', 0, 0, 100, ''),
(16, '', '', 'Cymbalta', 0, 0, 100, ''),
(17, '', '', 'Doxycycline', 0, 0, 100, ''),
(18, '', '', 'Gabapentin', 0, 0, 58, ''),
(19, '', '', 'Hydrochlorothiazide', 0, 0, 100, ''),
(20, '', '', 'Ibuprofen', 0, 0, 55, ''),
(21, '', '', 'Lexapro', 0, 0, 100, ''),
(22, '', '', 'Lisinopril', 0, 0, 100, ''),
(23, '', '', 'Loratadine', 0, 0, 100, ''),
(24, '', '', 'Lorazepam', 0, 0, 94, ''),
(25, '', '', 'Losartan', 0, 0, 100, ''),
(26, '', '', 'Lyrica', 0, 0, 88, ''),
(27, '', '', 'Meloxicam', 0, 0, 100, ''),
(28, '', '', 'Metformin', 0, 0, 100, ''),
(29, '', '', 'Metoprolol', 0, 0, 75, ''),
(30, '', '', 'Naproxen', 0, 0, 100, ''),
(31, '', '', 'Omeprazole', 0, 0, 100, ''),
(32, '', '', 'Oxycodone', 0, 0, 100, ''),
(33, '', '', 'Pantoprazole', 0, 0, 100, ''),
(34, '', '', 'Prednisone', 0, 0, 100, ''),
(35, '', '', 'Tramadol', 0, 0, 100, ''),
(36, '', '', 'Trazodone', 0, 0, 100, ''),
(37, '', '', 'Viagra', 0, 0, 100, ''),
(38, '', '', 'Wellbutrin', 0, 0, 100, ''),
(39, '', '', 'Xanax', 0, 0, 100, ''),
(40, '', '', 'Zoloft', 0, 0, 100, ''),
(41, 'Type', 'Brand', 'Name', 0, 0, 36, '29-05-20'),
(42, 'Type', 'Brand', 'Name', 0, 0, 65899, '29-05-23'),
(43, 'Ggh', 'Bhhj', 'Bggg', 0, 0, 764, '30-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_used`
--

CREATE TABLE `medicine_used` (
  `log_med_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `is_op` int(11) DEFAULT '0' COMMENT '0> not operation request , 1 > operation Request',
  `qty` int(11) NOT NULL,
  `morning` varchar(11) NOT NULL,
  `afternoon` varchar(11) NOT NULL,
  `night` varchar(11) NOT NULL,
  `days` int(11) NOT NULL,
  `bef_aft` int(11) NOT NULL,
  `tot_req` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 -> not taken off Inventory, 1-> Taken from inventory',
  `on_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_used`
--

INSERT INTO `medicine_used` (`log_med_id`, `medicine_id`, `reg_id`, `is_op`, `qty`, `morning`, `afternoon`, `night`, `days`, `bef_aft`, `tot_req`, `status`, `on_date`) VALUES
(1, 1, 1, 0, 12, '0', '0', '0', 0, 0, 10, 0, '2017-11-18 16:30:03'),
(2, 1, 35, 0, -1, '0', '0', '0', 0, 0, 0, 0, '2017-11-22 20:34:06'),
(3, 2, 1, 1, 22, '0', '0', '0', 0, 0, 0, 3, '2017-12-14 21:24:06'),
(4, 2, 1, 0, 21, '0', '0', '0', 0, 0, 0, 3, '2017-11-23 12:44:12'),
(5, 2, 29, 0, 12, '0', '0', '0', 0, 0, 0, 0, '2017-11-21 21:52:44'),
(6, 2, 32, 0, 11, '0', '0', '0', 0, 0, 0, 0, '2017-11-21 22:12:24'),
(7, 2, 34, 0, 12, '0', '0', '0', 0, 0, 0, 0, '2017-11-22 00:16:44'),
(8, 2, 35, 0, 2, '0', '0', '0', 0, 0, 0, 0, '2017-11-22 20:34:06'),
(9, 3, 1, 1, 22, '0', '0', '0', 0, 0, 0, 3, '2017-12-14 21:22:41'),
(10, 3, 1, 0, 1, '0', '0', '0', 0, 0, 0, 3, '2017-11-18 16:31:53'),
(11, 3, 2, 0, 2, '0', '0', '0', 0, 0, 0, 1, '2017-11-23 21:34:03'),
(12, 3, 29, 0, 11, '0', '0', '0', 0, 0, 0, 0, '2017-11-21 21:52:44'),
(13, 4, 1, 1, 22, '0', '0', '0', 0, 0, 0, 3, '2017-12-14 21:07:55'),
(14, 4, 1, 0, 11, '0', '0', '0', 0, 0, 0, 3, '2017-12-05 22:12:26'),
(15, 4, 11, 0, 12, '0', '0', '0', 0, 0, 0, 1, '2017-11-25 21:49:10'),
(16, 4, 34, 0, 1, '0', '0', '0', 0, 0, 0, 0, '2017-11-22 00:16:44'),
(17, 6, 1, 1, 2, '0', '0', '0', 0, 0, 0, 3, '2017-12-14 21:44:49'),
(18, 8, 1, 0, 22, '0', '0', '0', 0, 0, 0, 3, '2017-12-09 15:54:37'),
(19, 10, 2, 0, 2, '0', '0', '0', 0, 0, 0, 1, '2017-11-27 19:25:50'),
(20, 18, 1, 0, 22, '0', '0', '0', 0, 0, 0, 3, '2017-12-05 22:20:42'),
(21, 1, 1, 1, 12, '0', '0', '0', 0, 0, 10, 0, '2017-12-19 12:33:44'),
(22, 5, 1, 1, 1, '0', '0', '0', 0, 0, 2, 0, '2017-12-20 10:31:38'),
(23, 10, 1, 1, 12, '0', '0', '0', 0, 0, 0, 3, '2017-12-20 10:57:07'),
(24, 12, 1, 1, 22, '0', '0', '0', 0, 0, 0, 3, '2017-12-27 15:45:34'),
(25, 6, 1, 1, 5, '0', '0', '0', 0, 0, 0, 3, '2017-12-27 18:53:34'),
(26, 3, 32, 0, 20, '0', '0', '0', 0, 0, 0, 0, '2018-01-06 11:00:59'),
(27, 7, 33, 0, 20, '0', '0', '0', 0, 0, 0, 0, '2018-01-06 11:07:01'),
(28, 21, 34, 1, 20, '0', '0', '0', 0, 0, 0, 0, '2018-01-06 11:38:07'),
(29, 3, 35, 0, 2, '0', '0', '0', 0, 0, 0, 0, '2018-01-08 16:40:07'),
(30, 1, 42, 0, 6, '1', '1', '1', 2, 0, 0, 0, '2018-01-16 17:05:07'),
(31, 18, 43, 0, 39, '1', '11', '1', 3, 0, 20, 0, '2018-01-17 06:43:37'),
(32, 26, 47, 0, 18, '2', '2', '2', 3, 0, 12, 0, '2018-01-19 08:59:06'),
(33, 29, 48, 0, 10, '1', '1', '1', 5, 0, 10, 1, '2018-01-22 11:21:35'),
(34, 4, 50, 0, 20, '1', '0', '1', 10, 0, 20, 1, '2018-01-25 09:50:12'),
(35, 2, 52, 1, 1, '0', '0', '0', 0, 0, 0, 0, '2018-01-25 10:01:02'),
(36, 20, 54, 0, 15, '1', '1', '1', 5, 0, 15, 1, '2018-01-31 16:33:02'),
(37, 20, 54, 0, 15, '1', '1', '1', 5, 0, 15, 1, '2018-01-31 16:37:18'),
(38, 26, 54, 0, 0, '1', '1', '1', 5, 0, 0, 1, '2018-01-31 16:37:18'),
(39, 20, 54, 0, 15, '1', '1', '1', 5, 0, 15, 1, '2018-01-31 16:37:51'),
(40, 26, 54, 0, 0, '1', '1', '1', 5, 0, 0, 1, '2018-01-31 16:37:51'),
(41, 36, 54, 0, 15, '1', '1', '1', 5, 0, 0, 0, '2018-01-31 16:37:51'),
(42, 3, 6, 0, 0, '1', '1', '1', 2, 1, 0, 0, '2018-02-03 15:57:53'),
(43, 5, 55, 0, 9, '1', '1', '1', 3, 0, 0, 0, '2018-02-04 14:26:36'),
(44, 5, 55, 0, 9, '1', '1', '1', 3, 0, 0, 0, '2018-02-04 14:27:31'),
(45, 14, 55, 0, 6, '1', '0', '1', 3, 0, 0, 0, '2018-02-04 14:27:31'),
(46, 5, 55, 0, 9, '1', '1', '1', 3, 0, 0, 0, '2018-02-04 14:27:52'),
(47, 14, 55, 0, 6, '1', '0', '1', 3, 0, 0, 0, '2018-02-04 14:27:52'),
(48, 24, 55, 0, 6, '1', '0', '1', 3, 0, 0, 0, '2018-02-04 14:27:52'),
(54, 3, 59, 0, 4, '1', '0.5', '0.25', 2, 1, 0, 3, '2018-02-09 18:05:32'),
(55, 3, 59, 0, 35, '1', '0.5', '0.25', 20, 1, 0, 3, '2018-02-09 18:07:28'),
(56, 1, 79, 0, 8, '1', '2', '1', 2, 0, 5, 1, '2018-03-31 12:35:44'),
(57, 1, 79, 0, 4, '1', '0', '1', 2, 1, 5, 1, '2018-03-31 12:43:39'),
(58, 5, 79, 0, 50, '2', '1', '2', 10, 1, 1, 3, '2018-04-01 19:20:55'),
(59, 2, 79, 0, 12, '1', '2', '1', 3, 0, 0, 3, '2018-04-01 20:45:51'),
(60, 1, 79, 0, 5, '2', '1', '2', 1, 1, 5, 1, '2018-04-01 20:47:29'),
(61, 5, 31, 0, 3, '1', '1', '1', 1, 1, 0, 0, '2018-04-02 08:04:28'),
(62, 8, 31, 0, 6, '1', '1', '1', 2, 0, 0, 0, '2018-04-02 08:04:51'),
(63, 11, 86, 0, 12, '1', '1', '1', 4, 0, 12, 1, '2018-06-05 08:01:45'),
(64, 8, 87, 1, 5, '', '', '', 0, 0, 5, 1, '2018-06-05 09:00:35'),
(65, 5, 90, 0, 18, '1', '1', '1', 6, 0, 0, 0, '2018-06-07 15:01:01'),
(66, 16, 91, 1, 2, '', '', '', 0, 0, 0, 0, '2018-06-07 15:08:26'),
(67, 9, 92, 0, 9, '1', '1', '1', 3, 0, 9, 1, '2018-07-30 14:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `dob` varchar(100) NOT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `phone_number` varchar(200) NOT NULL DEFAULT '',
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `referer` varchar(100) DEFAULT NULL,
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `l_name`, `dob`, `sex`, `phone_number`, `address`, `email`, `referer`, `added_at`) VALUES
(14, '', '', '', '', '', '', '', '', '2018-01-06 10:56:14'),
(1, 'Abu Bakkar Siddique', '', '1993-05-29', 'Male', '8056208210', 'no 9 , selvaganapathy koil street, ullagaram chennai, 600091', 'abu@headrun.net', 'Self', '2017-11-22 18:20:40'),
(41, 'ABU BAKKER SIDDIQUE', NULL, '1993-05-29', 'Male', '91 8056208210', 'No 9 Selvaganapathy Koil Street', 'siddique.abu42@gmail.com', 'tets', '2018-05-18 07:26:13'),
(38, 'Chandru', '', '1983-06-24', 'Male', '+91 998273889823', 'sldfkjlsdkjfsla;j', 'chand@xyz.com', 'salfkj', '2018-02-05 10:39:20'),
(10, 'December ', '', '2001-02-08', 'Male', '555555', 'test', 'jdjdj@jjs.com', 'nizam', '2017-12-27 17:29:38'),
(25, 'Guru', '', '1981-01-27', '', '+91 9886277713', 'Shaw boleuvard', 'rajesh@abc.com', 'Doctor', '2018-01-16 15:43:25'),
(26, 'Gurukanth', '', '1982-01-23', 'Male', '+91 9886277714', 'Mantri Mall, Malleshwaram', 'rajesh.td888@gmail.com', 'Friend', '2018-01-16 15:44:38'),
(42, 'Jack', NULL, '1985-01-29', 'Male', '+91 9886676207', '346, 4th street, 5th block', 'rajesh.td@gmail.com', 'doctor', '2018-06-05 07:59:13'),
(23, 'jhjh', '', '', '', '', '', '', '', '2018-01-08 16:45:50'),
(20, 'klsdjflkj', '', '1981-01-22', '', 'lkjlk', 'lksdjaflkj', 'nlkjl', ' lkjlk', '2018-01-08 15:23:30'),
(37, 'Krish 4', '', '1982-01-12', 'Male', '+91 8777488990', 'Shaw', 'krish@gmail.com', 'doctor', '2018-02-04 14:22:57'),
(27, 'Lexus', '', '1984-01-23', 'Male', '+91 9886277712', 'sldjkfskfdskjl', 'rajesh.td777@gmail.com', 'sdjfldksjfl', '2018-01-17 06:41:58'),
(19, 'lksjdflkfjds', '', '1981-01-22', 'Male', 'kjdsl;kj', 'lksjlkfj', ' lkj', 'lkjlk', '2018-01-08 15:21:49'),
(34, 'Lucy kat', '', '1987-04-22', 'Male', '+966 23489798293', 'sdfksjlf', 'rajesh.td@gmail.com', 'ksjfl', '2018-01-25 09:58:24'),
(11, 'Manish', '', '2014-01-02', 'Male', '89798797979878979', '#56/2*3, testing', 'hgfhgf', 'jhgjg', '2017-12-28 06:02:13'),
(15, 'Manish Chopra', '', '', 'Male', '+919886277713', '18, 3rd Cross, Vinayaka Nagar, BSK 1st Stage', 'rajesh.td777@gmail.com', 'jfskldjfl', '2018-01-08 14:32:55'),
(12, 'nizam', '', '1999-01-01', 'Male', '7777', 'jjjdj', 'mmm@hh.com', '', '2018-01-02 11:32:07'),
(29, 'Preetham', '', '1984-01-29', 'Female', '+91 9886277713', '#8, 4th cross, 6th street, jayanagar, bangalore', 'preetham@gmail.com', 'Dr. Anubhav', '2018-01-19 08:55:58'),
(17, 'Prem', '', '1981-02-27', 'Male', '+919886277713', '#19, 203/5-90, chandra layout, vijayanagar, bangalore', 'rajesh.td777@gmail.com', 'Doctor', '2018-01-08 14:48:26'),
(18, 'Raghuram', '', '1982-02-22', 'Male', 'ljkflksjf', 'dslkfjflskdjflksdjfkl;', 'slkdjfslkd', 'skljfksd', '2018-01-08 15:18:06'),
(31, 'Rahul Sharma', '', '1983-01-30', 'Female', '+91 9445002987', 'slakfj;laewrw;oij', 'rajesh.td@gmail.com', 'test', '2018-01-22 11:20:05'),
(35, 'Rajath ', '', '1982-01-23', 'Male', '+91 9887777645', 'sldkjfldksjfl', 'rajesh.td@gmail.com', 'sjdfjkljfs', '2018-01-31 16:24:00'),
(13, 'Rajesh TD', '', '1981-01-27', 'Male', 'lsdkjflksjf', 'sa;lkdfjslkjflkfdjsl;sf', 'sdfljsalfj', 'dslkfjsdlkfjs', '2018-01-06 10:54:58'),
(44, 'rakljklkjl', NULL, '1981-01-27', 'Male', '+91 9886277713', 'ksdjflk', 'rajesh.td@gmail.com', 'doc', '2018-07-30 14:19:06'),
(36, 'Ramanlal', '', '1981-01-25', 'Male', '+91 9845099988', '23, 5th cross, chandra layout, bangal', 'rajesh.td@gmail.com', 'friend', '2018-01-31 16:27:11'),
(33, 'Ramesh Kumar', '', '1985-01-20', 'Male', '+916 9886277713', '86, 7th street', 'rajesh.td@gmail.com', 'skdjflsdkj', '2018-01-25 09:48:07'),
(2, 'Rehan', '', '1992-05-29', 'Male', '8939017575', '#9 selvaganapathy koil street, ullagaram chennai 600091', '', 'Test', '2017-11-23 16:15:00'),
(30, 'Robin Sharma', '', '1987-01-25', 'Male', '+91 9886377712', 'sdfjkll;lskdf;ljksal;dfjkl;sj', 'rajesh@te.com', 'ksdjflksa;f', '2018-01-22 11:15:55'),
(32, 'Roger', '', '1981-01-17', 'Male', '+91 9773699876', 'Federer', 'rajesh.td@gmail.com', 'test', '2018-01-24 06:23:14'),
(43, 'Rose mary', NULL, '2018-06-08', 'Female', '+91 9886277713', 'skfjslfjk;', 'rajesh.td@gmail.com', 'doctor', '2018-06-07 14:58:41'),
(7, 'rtrr', '', '1966-06-06', 'Male', '', 'Not acailable', '', 'no one', '2017-12-05 18:02:49'),
(6, 'rtrr', '', '1966-06-06', 'Male', '8056208210', 'Not acailable', '', 'no one', '2017-12-05 17:58:09'),
(8, 'Rttrrea', '', '', 'Male', '8056208210', 'Adkfnakndvklas', 'abu@headrun.net', 'no one', '2017-12-05 18:03:51'),
(3, 'Sameena Begum', '', '2000-08-30', 'Female', '51651421212', 'No oooaepkfnasnfjlsnfjknfjkdsn', '', 'asffasf', '2017-11-23 18:05:44'),
(4, 'Sasisia', '', '1993-01-29', 'Male', '8056208211', 'Nidia 122 asda', '', 'nothing', '2017-11-24 17:18:52'),
(16, 'Sherlin ', '', '', 'Male', '9348982998', 'Chandra layout, 3rd cross, 5th main (*#&#*&(', 'rajesht.d@gmail.com', 'doctor', '2018-01-08 14:44:34'),
(5, 'Siddique', '', '1992-08-08', 'Male', '928321425', 'No 2 392oos stereet ', '', 'self', '2017-11-25 16:10:07'),
(28, 'Trial basis', '', '1981-01-23', 'Male', '+91 9886277718', 'skldfjslkjfl', 'rajesh.td777@gmail.com', 'sdafsdf', '2018-01-17 06:55:36'),
(21, 'tttt', '', '', '', '', 'kjhkj', '', '', '2018-01-08 16:40:34'),
(9, 'venkat', '', '2001-03-30', 'Male', '08015664525', 'nungambakkam', 'tejavenkat7@gmail.com', 'abu bakkar', '2017-12-26 12:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `patient_charges`
--

CREATE TABLE `patient_charges` (
  `charge_id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `charged_by` int(11) NOT NULL,
  `amt` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-> UnPaid, 1-> Paid',
  `charger_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `charged_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_charges`
--

INSERT INTO `patient_charges` (`charge_id`, `registration_id`, `charged_by`, `amt`, `status`, `charger_at`, `charged_at`) VALUES
(1, 1, 10, 20000, 1, '2017-12-10 23:15:38', '2017-12-10'),
(2, 1, 8, 1000, 1, '2017-12-10 23:15:39', '2017-12-10'),
(3, 1, 9, 1000, 1, '2017-12-10 23:15:39', '2017-12-10'),
(4, 1, 9, 2000, 1, '2017-12-10 23:15:39', '2017-12-10'),
(5, 1, 6, 450, 1, '2017-12-21 01:26:32', '2017-12-20'),
(6, 1, 6, 450, 1, '2017-12-23 12:02:30', '2017-12-23'),
(7, 2, 6, 450, 0, '2017-12-25 15:18:47', '2017-12-25'),
(8, 2, 6, 450, 0, '2017-12-25 15:42:23', '2017-12-25'),
(9, 7, 6, 450, 0, '2017-12-25 16:46:02', '2017-12-25'),
(10, 1, 6, 450, 1, '2017-12-25 17:01:57', '2017-12-25'),
(11, 16, 4, 380, 0, '2017-12-25 18:34:19', '2017-12-25'),
(12, 17, 4, 380, 0, '2017-12-25 18:36:22', '2017-12-25'),
(13, 18, 4, 380, 0, '2017-12-25 18:37:40', '2017-12-25'),
(14, 19, 4, 380, 0, '2017-12-25 18:39:20', '2017-12-25'),
(15, 20, 4, 380, 0, '2017-12-25 18:41:27', '2017-12-25'),
(16, 21, 4, 380, 0, '2017-12-25 18:42:14', '2017-12-25'),
(17, 22, 4, 380, 0, '2017-12-25 18:42:51', '2017-12-25'),
(18, 23, 4, 380, 0, '2017-12-25 18:43:43', '2017-12-25'),
(19, 24, 4, 380, 0, '2017-12-25 18:45:56', '2017-12-25'),
(20, 25, 4, 380, 0, '2017-12-26 12:33:30', '2017-12-26'),
(21, 1, 3, 444, 1, '2017-12-27 15:43:14', '2017-12-27'),
(22, 1, 4, 380, 1, '2017-12-27 15:43:47', '2017-12-27'),
(23, 1, 10, 15000, 1, '2017-12-27 15:45:17', '2017-12-27'),
(24, 1, 8, 1000, 1, '2017-12-27 15:45:17', '2017-12-27'),
(25, 1, 9, 1000, 1, '2017-12-27 15:45:17', '2017-12-27'),
(26, 1, 9, 2000, 1, '2017-12-27 15:45:17', '2017-12-27'),
(27, 1, 10, 15000, 1, '2017-12-27 15:46:23', '2017-12-27'),
(28, 1, 8, 1000, 1, '2017-12-27 15:46:23', '2017-12-27'),
(29, 1, 9, 1000, 1, '2017-12-27 15:46:23', '2017-12-27'),
(30, 1, 9, 2000, 1, '2017-12-27 15:46:23', '2017-12-27'),
(31, 27, 4, 250, 0, '2017-12-27 17:32:11', '2017-12-27'),
(32, 29, 4, 250, 0, '2018-01-02 11:32:33', '2018-01-02'),
(33, 31, 4, 380, 0, '2018-01-06 10:57:03', '2018-01-06'),
(34, 34, 4, 250, 1, '2018-01-06 11:08:12', '2018-01-06'),
(35, 34, 10, 20000, 1, '2018-01-06 11:14:42', '2018-01-06'),
(36, 34, 8, 1000, 1, '2018-01-06 11:14:42', '2018-01-06'),
(37, 34, 9, 2000, 1, '2018-01-06 11:14:42', '2018-01-06'),
(38, 34, 9, 1000, 1, '2018-01-06 11:14:42', '2018-01-06'),
(39, 34, 10, 15000, 1, '2018-01-06 11:15:59', '2018-01-06'),
(40, 34, 8, 1000, 1, '2018-01-06 11:15:59', '2018-01-06'),
(41, 34, 9, 2000, 1, '2018-01-06 11:15:59', '2018-01-06'),
(42, 34, 10, 15000, 0, '2018-01-06 11:37:41', '2018-01-06'),
(43, 34, 8, 1000, 0, '2018-01-06 11:37:41', '2018-01-06'),
(44, 34, 9, 1000, 0, '2018-01-06 11:37:41', '2018-01-06'),
(45, 1, 6, 450, 1, '2018-01-08 16:02:39', '2018-01-08'),
(46, 34, 10, 20000, 0, '2018-01-08 16:28:59', '2018-01-08'),
(47, 34, 8, 1000, 0, '2018-01-08 16:28:59', '2018-01-08'),
(48, 34, 9, 2000, 0, '2018-01-08 16:28:59', '2018-01-08'),
(49, 34, 10, 20000, 0, '2018-01-08 16:30:02', '2018-01-08'),
(50, 34, 8, 1000, 0, '2018-01-08 16:30:02', '2018-01-08'),
(51, 34, 9, 2000, 0, '2018-01-08 16:30:02', '2018-01-08'),
(52, 40, 4, 380, 0, '2018-01-11 14:51:12', '2018-01-11'),
(53, 2, 10, 20000, 0, '2018-01-11 14:51:55', '2018-01-11'),
(54, 2, 8, 1000, 0, '2018-01-11 14:51:55', '2018-01-11'),
(55, 2, 9, 1000, 0, '2018-01-11 14:51:55', '2018-01-11'),
(56, 43, 6, 450, 0, '2018-01-17 06:47:00', '2018-01-17'),
(57, 47, 6, 450, 0, '2018-01-19 09:01:57', '2018-01-19'),
(58, 48, 6, 450, 1, '2018-01-22 11:35:58', '2018-01-22'),
(59, 50, 6, 450, 0, '2018-01-25 09:52:28', '2018-01-25'),
(60, 51, 4, 380, 0, '2018-01-25 09:56:54', '2018-01-25'),
(61, 52, 4, 380, 0, '2018-01-25 09:58:40', '2018-01-25'),
(62, 52, 10, 15000, 0, '2018-01-25 10:00:48', '2018-01-25'),
(63, 52, 8, 1000, 0, '2018-01-25 10:00:48', '2018-01-25'),
(64, 52, 9, 2000, 0, '2018-01-25 10:00:48', '2018-01-25'),
(65, 52, 9, 1000, 0, '2018-01-25 10:00:48', '2018-01-25'),
(66, 54, 6, 450, 0, '2018-01-31 16:40:08', '2018-01-31'),
(67, 6, 6, 450, 0, '2018-02-03 15:57:24', '2018-02-03'),
(68, 55, 6, 450, 0, '2018-02-04 14:27:04', '2018-02-04'),
(69, 59, 6, 450, 0, '2018-02-12 16:58:42', '2018-02-12'),
(70, 59, 6, 0, 0, '2018-02-12 18:43:18', '2018-02-12'),
(71, 59, 6, 0, 0, '2018-02-12 18:45:09', '2018-02-12'),
(72, 59, 6, 0, 0, '2018-02-12 18:45:55', '2018-02-12'),
(73, 59, 6, 0, 0, '2018-02-12 18:46:50', '2018-02-12'),
(74, 59, 6, 22, 0, '2018-02-12 18:47:15', '2018-02-12'),
(75, 63, 6, 450, 1, '2018-03-17 16:32:34', '2018-03-17'),
(76, 63, 6, 450, 1, '2018-03-17 16:45:48', '2018-03-17'),
(77, 71, 3, 1000, 1, '2018-03-18 18:10:55', '2018-03-18'),
(78, 71, 6, 450, 0, '2018-03-18 19:01:01', '2018-03-19'),
(79, 72, 3, 444, 1, '2018-03-18 19:25:23', '2018-03-19'),
(80, 73, 3, 444, 0, '2018-03-19 05:23:51', '2018-03-19'),
(81, 74, 3, 444, 0, '2018-03-19 05:33:09', '2018-03-19'),
(82, 75, 3, 444, 0, '2018-03-19 05:42:06', '2018-03-19'),
(83, 76, 3, 444, 0, '2018-03-19 05:42:44', '2018-03-19'),
(84, 77, 3, 444, 0, '2018-03-19 05:43:15', '2018-03-19'),
(85, 78, 3, 444, 1, '2018-03-19 15:39:54', '2018-03-19'),
(86, 79, 3, 444, 1, '2018-03-31 11:14:12', '2018-03-31'),
(87, 79, 6, 450, 1, '2018-03-31 12:44:09', '2018-03-31'),
(88, 79, 6, 450, 1, '2018-03-31 13:01:18', '2018-03-31'),
(89, 80, 3, 444, 0, '2018-03-31 13:25:10', '2018-03-31'),
(90, 81, 3, 444, 1, '2018-03-31 13:26:05', '2018-03-31'),
(91, 82, 3, 444, 1, '2018-03-31 13:26:39', '2018-03-31'),
(92, 83, 3, 444, 1, '2018-03-31 13:34:27', '2018-03-31'),
(93, 83, 6, 450, 1, '2018-03-31 13:43:10', '2018-03-31'),
(94, 1, 5, 22, 1, '2018-04-01 18:57:30', '2018-04-02'),
(95, 1, 5, 44, 1, '2018-04-01 18:57:30', '2018-04-02'),
(96, 1, 5, 11, 1, '2018-04-01 19:05:00', '2018-04-02'),
(97, 1, 5, 132, 0, '2018-04-01 19:16:19', '2018-04-02'),
(98, 1, 5, 4, 0, '2018-04-01 19:23:30', '2018-04-02'),
(99, 79, 5, 4, 1, '2018-04-01 19:34:39', '2018-04-02'),
(100, 79, 5, 242, 1, '2018-04-01 19:36:22', '2018-04-02'),
(101, 79, 5, 253, 1, '2018-04-01 19:36:22', '2018-04-02'),
(102, 79, 5, 110, 1, '2018-04-01 19:37:33', '2018-04-02'),
(103, 79, 5, 130, 1, '2018-04-01 19:38:27', '2018-04-02'),
(104, 79, 5, 39, 1, '2018-04-01 19:53:14', '2018-04-02'),
(105, 79, 5, 35, 1, '2018-04-01 19:54:14', '2018-04-02'),
(106, 0, 4, 380, 0, '2018-04-01 20:17:56', '2018-04-02'),
(107, 0, 4, 250, 0, '2018-04-01 20:18:10', '2018-04-02'),
(108, 0, 3, 1000, 0, '2018-04-01 20:23:19', '2018-04-02'),
(109, 0, 4, 250, 0, '2018-04-01 20:38:03', '2018-04-02'),
(110, 1, 4, 250, 0, '2018-04-01 20:40:39', '2018-04-02'),
(111, 79, 6, 450, 0, '2018-04-01 20:45:34', '2018-04-02'),
(112, 31, 6, 450, 0, '2018-04-02 07:54:31', '2018-04-02'),
(113, 79, 5, 55, 0, '2018-04-02 16:00:00', '2018-04-02'),
(114, 84, 3, 1000, 0, '2018-05-18 09:05:00', '2018-05-18'),
(115, 84, 4, 380, 0, '2018-05-18 09:05:00', '2018-05-18'),
(116, 85, 3, 444, 0, '2018-05-18 09:07:13', '2018-05-18'),
(117, 85, 4, 250, 0, '2018-05-18 09:07:13', '2018-05-18'),
(118, 86, 3, 1000, 1, '2018-06-05 07:59:52', '2018-06-05'),
(119, 86, 6, 450, 0, '2018-06-05 08:04:45', '2018-06-05'),
(120, 86, 5, 24, 0, '2018-06-05 08:06:02', '2018-06-05'),
(121, 87, 3, 1000, 0, '2018-06-05 08:59:22', '2018-06-05'),
(122, 87, 4, 250, 0, '2018-06-05 08:59:22', '2018-06-05'),
(123, 87, 10, 20000, 0, '2018-06-05 09:00:12', '2018-06-05'),
(124, 87, 8, 1000, 0, '2018-06-05 09:00:12', '2018-06-05'),
(125, 87, 9, 1000, 0, '2018-06-05 09:00:12', '2018-06-05'),
(126, 87, 5, 250, 0, '2018-06-05 09:01:10', '2018-06-05'),
(127, 88, 3, 1000, 0, '2018-06-07 14:59:30', '2018-06-07'),
(128, 89, 3, 1000, 0, '2018-06-07 14:59:31', '2018-06-07'),
(129, 90, 3, 1000, 1, '2018-06-07 14:59:32', '2018-06-07'),
(130, 90, 6, 450, 1, '2018-06-07 15:01:29', '2018-06-07'),
(131, 90, 5, 0, 1, '2018-06-07 15:03:17', '2018-06-07'),
(132, 91, 3, 444, 0, '2018-06-07 15:06:59', '2018-06-07'),
(133, 91, 4, 250, 0, '2018-06-07 15:06:59', '2018-06-07'),
(134, 91, 10, 20000, 0, '2018-06-07 15:08:03', '2018-06-07'),
(135, 91, 8, 1000, 0, '2018-06-07 15:08:03', '2018-06-07'),
(136, 91, 9, 1000, 0, '2018-06-07 15:08:03', '2018-06-07'),
(137, 91, 9, 2000, 0, '2018-06-07 15:08:03', '2018-06-07'),
(138, 92, 3, 444, 1, '2018-07-30 14:19:25', '2018-07-30'),
(139, 92, 6, 450, 0, '2018-07-30 14:20:31', '2018-07-30'),
(140, 92, 5, 9, 0, '2018-07-30 14:21:23', '2018-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_inventory`
--

CREATE TABLE `pharmacy_inventory` (
  `logged_id` int(11) NOT NULL,
  `grn` varchar(50) NOT NULL,
  `medicine_type` varchar(50) NOT NULL,
  `medicine_brand` varchar(50) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `expiry_date` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy_inventory`
--

INSERT INTO `pharmacy_inventory` (`logged_id`, `grn`, `medicine_type`, `medicine_brand`, `medicine_name`, `qty`, `expiry_date`, `created_at`) VALUES
(1, '6586', 'Type', 'Brand', 'Name', 65899, '29-05-23', '2017-12-27 15:41:25'),
(2, 'Hhhv', 'Ggh', 'Bhhj', 'Bggg', 764, '30-12-17', '2017-12-27 18:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_transaction`
--

CREATE TABLE `pharmacy_transaction` (
  `trans_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy_transaction`
--

INSERT INTO `pharmacy_transaction` (`trans_id`, `med_id`, `qty`, `time`) VALUES
(1, 9, 22, '2017-11-23 18:51:51'),
(2, 4, 2, '2017-11-23 18:53:24'),
(3, 4, 3, '2017-11-23 18:54:06'),
(4, 3, 2, '2017-11-23 18:56:41'),
(5, 11, 2, '2017-11-23 18:58:19'),
(6, 3, 2, '2017-11-23 20:08:25'),
(7, 3, 2, '2017-11-23 20:08:58'),
(8, 3, 2, '2017-11-23 20:24:36'),
(9, 3, 2, '2017-11-23 20:25:25'),
(10, 3, 2, '2017-11-23 20:26:16'),
(11, 3, 2, '2017-11-23 20:26:46'),
(12, 3, 2, '2017-11-23 20:27:26'),
(13, 3, 2, '2017-11-23 20:27:58'),
(14, 3, 2, '2017-11-23 20:28:46'),
(15, 3, 2, '2017-11-23 20:29:47'),
(16, 9, 45, '2017-11-23 20:30:25'),
(17, 2, 2, '2017-11-23 20:30:25'),
(18, 7, 22, '2017-11-23 20:30:51'),
(19, 5, 22, '2017-11-24 04:11:48'),
(20, 1, 12, '2017-11-24 04:12:22'),
(21, 2, 21, '2017-11-24 04:12:22'),
(22, 3, 1, '2017-11-24 04:12:22'),
(23, 9, 34, '2017-11-25 12:18:25'),
(24, 9, 11, '2017-11-25 12:19:29'),
(25, 5, 12, '2017-11-25 12:22:14'),
(26, 4, 12, '2017-11-25 16:26:00'),
(27, 1, 50, '2017-11-25 16:26:58'),
(28, 10, 2, '2017-11-27 13:58:51'),
(29, 4, 11, '2017-12-05 16:51:08'),
(30, 18, 22, '2017-12-05 16:51:08'),
(31, 2, 22, '2017-12-19 07:01:48'),
(32, 3, 22, '2017-12-19 07:01:48'),
(33, 4, 22, '2017-12-19 07:01:48'),
(34, 6, 2, '2017-12-19 07:01:48'),
(35, 8, 22, '2017-12-19 07:01:48'),
(36, 1, 12, '2017-12-19 07:04:10'),
(37, 5, 1, '2017-12-20 06:06:21'),
(38, 10, 12, '2017-12-20 06:07:43'),
(39, 12, 22, '2017-12-27 15:46:11'),
(40, 6, 5, '2017-12-27 18:54:16'),
(41, 18, 20, '2018-01-17 06:48:12'),
(42, 26, 12, '2018-01-19 09:00:30'),
(43, 29, 15, '2018-01-22 11:30:56'),
(44, 4, 20, '2018-01-25 09:51:39'),
(45, 20, 10, '2018-01-31 16:38:46'),
(46, 20, 10, '2018-01-31 16:38:46'),
(47, 26, 0, '2018-01-31 16:38:46'),
(48, 20, 10, '2018-01-31 16:38:46'),
(49, 20, 15, '2018-01-31 16:45:59'),
(50, 29, 10, '2018-01-31 16:46:31'),
(51, 5, 9, '2018-02-04 14:29:20'),
(52, 5, 9, '2018-02-04 14:29:20'),
(53, 14, 6, '2018-02-04 14:29:20'),
(54, 5, 9, '2018-02-04 14:29:20'),
(55, 14, 6, '2018-02-04 14:29:20'),
(56, 24, 6, '2018-02-04 14:29:20'),
(57, 5, 9, '2018-02-05 10:36:31'),
(58, 5, 9, '2018-02-05 10:36:31'),
(59, 1, 8, '2018-04-01 17:18:01'),
(60, 1, 4, '2018-04-01 17:18:01'),
(61, 1, 2, '2018-04-01 18:38:04'),
(62, 1, 2, '2018-04-01 18:38:04'),
(63, 1, 2, '2018-04-01 18:57:30'),
(64, 1, 2, '2018-04-01 18:57:30'),
(65, 1, 2, '2018-04-01 19:04:36'),
(66, 1, 1, '2018-04-01 19:05:00'),
(67, 1, 2, '2018-04-01 19:16:19'),
(68, 1, 10, '2018-04-01 19:16:19'),
(69, 5, 2, '2018-04-01 19:23:30'),
(70, 5, 2, '2018-04-01 19:33:48'),
(71, 5, 2, '2018-04-01 19:34:39'),
(72, 1, 22, '2018-04-01 19:36:22'),
(73, 1, 1, '2018-04-01 19:36:22'),
(74, 1, 10, '2018-04-01 19:37:33'),
(75, 1, 10, '2018-04-01 19:38:27'),
(76, 5, 10, '2018-04-01 19:38:27'),
(77, 1, 1, '2018-04-01 19:53:13'),
(78, 1, 2, '2018-04-01 19:53:13'),
(79, 5, 3, '2018-04-01 19:53:13'),
(80, 1, 1, '2018-04-01 19:54:14'),
(81, 1, 2, '2018-04-01 19:54:14'),
(82, 5, 1, '2018-04-01 19:54:14'),
(83, 1, 5, '2018-04-02 16:00:00'),
(84, 11, 12, '2018-06-05 08:06:02'),
(85, 8, 5, '2018-06-05 09:01:10'),
(86, 9, 9, '2018-07-30 14:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `physician`
--

CREATE TABLE `physician` (
  `id` int(11) NOT NULL,
  `qualification` varchar(30) NOT NULL,
  `speciality` varchar(30) NOT NULL,
  `consulting_hrs_frm` varchar(200) NOT NULL,
  `consulting_hrs_to` varchar(200) NOT NULL,
  `ot_fee` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `fee_share` int(11) NOT NULL,
  `share_type` int(11) NOT NULL COMMENT '0-> amt, 1-> percentage',
  `num_of_days_visited` int(11) NOT NULL,
  `available_days` varchar(300) NOT NULL,
  `current_status` int(11) NOT NULL COMMENT '0-> not_available , 1-> available , 2->attending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physician`
--

INSERT INTO `physician` (`id`, `qualification`, `speciality`, `consulting_hrs_frm`, `consulting_hrs_to`, `ot_fee`, `fee`, `fee_share`, `share_type`, `num_of_days_visited`, `available_days`, `current_status`) VALUES
(4, 'MBBS', 'Cardiologist', '10:15:00', '19:15:00', 1000, 1000, 1, 0, 0, '', 0),
(7, 'MBBS', 'Cardiologist', '11:15:00', '20:30:00', 2000, 444, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `physician_clinic_details`
--

CREATE TABLE `physician_clinic_details` (
  `staff_id` int(11) NOT NULL,
  `first_line_add` varchar(300) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physician_clinic_details`
--

INSERT INTO `physician_clinic_details` (`staff_id`, `first_line_add`, `state`, `city`, `zip`, `contact`) VALUES
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, '', '', '', 0, ''),
(115, '', '', '', 0, ''),
(115, '', '', '', 0, ''),
(4, 'sjdnvjkbskjfv', 'jvsjkdvjksnvkj', 'svjkdvkjsvk', 0, 'sjdvkjskjvns'),
(7, 'afadsf', 'sdffsdf', 'Sdsd', 0, 'sdsdfsf'),
(7, 'afadsf', 'sdffsdf', 'Sdsd', 0, 'sdsdfsf'),
(4, 'sjdnvjkbskjfv', 'jvsjkdvjksnvkj', 'svjkdvkjsvk', 0, 'sjdvkjskjvns'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, '', '', '', 0, ''),
(115, '', '', '', 0, ''),
(115, '', '', '', 0, ''),
(4, 'sjdnvjkbskjfv', 'jvsjkdvjksnvkj', 'svjkdvkjsvk', 0, 'sjdvkjskjvns'),
(7, 'afadsf', 'sdffsdf', 'Sdsd', 0, 'sdsdfsf'),
(7, 'afadsf', 'sdffsdf', 'Sdsd', 0, 'sdsdfsf'),
(4, 'sjdnvjkbskjfv', 'jvsjkdvjksnvkj', 'svjkdvkjsvk', 0, 'sjdvkjskjvns'),
(3, 'No 9 Selvaga', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, 'test', 'Tamil Nadu', 'Chennai', 600091, '8056208210'),
(115, '', '', '', 0, ''),
(115, '', '', '', 0, ''),
(115, '', '', '', 0, ''),
(4, 'sjdnvjkbskjfv', 'jvsjkdvjksnvkj', 'svjkdvkjsvk', 0, 'sjdvkjskjvns'),
(7, 'afadsf', 'sdffsdf', 'Sdsd', 0, 'sdsdfsf'),
(7, 'afadsf', 'sdffsdf', 'Sdsd', 0, 'sdsdfsf'),
(4, 'sjdnvjkbskjfv', 'jvsjkdvjksnvkj', 'svjkdvkjsvk', 0, 'sjdvkjskjvns'),
(3, 'No 9 Selvaga', 'Tamil Nadu', 'Chennai', 600091, '8056208210');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `product_sub_type` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_description` text NOT NULL,
  `total_available` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `expiry_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type`, `product_sub_type`, `product_name`, `product_code`, `product_description`, `total_available`, `price`, `expiry_date`) VALUES
(24, 'Abu', 'Bakkar', 'Siddique', 'R215', 'No Desc', 50, 50, ''),
(28, 'Pen', 'Pen', 'Pen', '', '', 0, 0, ''),
(27, 'Stationary', 'Writables', 'Pen', '', '', 0, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_request`
--

CREATE TABLE `product_request` (
  `request_id` int(11) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `requested_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag` int(11) NOT NULL DEFAULT '0' COMMENT '0-> Open, 1-> Closed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_request`
--

INSERT INTO `product_request` (`request_id`, `requested_by`, `product_id`, `qty`, `requested_at`, `flag`) VALUES
(1, 2, 3, 1, '2017-11-08 18:00:48', 0),
(2, 2, 16, 1, '2017-11-08 18:00:48', 0),
(3, 2, 4, 10, '2017-11-08 18:38:09', 0),
(4, 2, 4, 4, '2017-11-08 18:38:25', 0),
(5, 2, 5, 1, '2017-11-08 18:43:23', 0),
(6, 2, 4, 3, '2017-11-08 18:45:22', 0),
(7, 2, 5, 1, '2017-11-08 18:56:23', 0),
(8, 2, 4, 5, '2017-11-08 18:56:32', 0),
(9, 2, 3, 5, '2017-11-08 19:07:48', 0),
(10, 2, 13, 4, '2017-11-08 19:09:01', 0),
(11, 3, 4, 2, '2017-11-09 01:36:01', 0),
(12, 3, 3, 10, '2017-11-09 02:28:07', 1),
(13, 3, 7, 3, '2017-11-09 03:05:12', 0),
(14, 3, 12, 3, '2017-11-09 03:05:12', 1),
(15, 3, 5, 2, '2017-11-13 16:34:26', 0),
(16, 3, 8, 2, '2017-11-13 16:34:26', 0),
(17, 3, 2, 2, '2017-11-23 07:15:28', 1),
(18, 3, 2, 12, '2017-11-23 11:16:25', 1),
(19, 3, 4, 1, '2017-11-23 12:54:29', 0),
(20, 3, 7, 12, '2017-12-02 23:34:21', 0),
(21, 18, 7, 25, '2017-12-27 15:50:42', 0),
(22, 18, 2, 10, '2018-01-06 11:45:26', 1),
(23, 18, 35, 59, '2018-01-08 18:02:18', 0),
(24, 18, 9, 10, '2018-01-29 11:31:22', 0),
(25, 3, 0, 20, '2018-04-02 15:48:01', 0),
(26, 3, 12, 10, '2018-04-02 15:48:52', 1),
(27, 3, 12, 1000, '2018-04-02 15:49:39', 0),
(28, 3, 24, 25, '2018-04-11 18:03:09', 1),
(29, 3, 24, 25, '2018-04-11 18:04:04', 1),
(30, 18, 27, 10, '2018-06-05 08:12:29', 0),
(31, 18, 28, 10, '2018-06-07 15:10:00', 0),
(32, 18, 28, 10, '2018-06-07 15:10:01', 0),
(33, 18, 28, 10, '2018-08-11 10:39:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `order_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `mrn` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`order_id`, `supplier_id`, `product_id`, `Quantity`, `mrn`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 12, 20, '5823', 'Open', '2018-01-21 17:43:03', '2018-01-29 17:53:11'),
(3, 1, 12, 20, '65885', 'Open', '2018-01-21 17:43:57', '2018-01-29 18:27:02'),
(4, 1, 3, 50, NULL, 'Open', '2018-01-21 17:55:16', NULL),
(5, 1, 3, 560, '500', 'Open', '2018-01-29 16:36:13', '2018-01-29 18:20:20'),
(6, 12, 1, 50, '1056862', 'Open', '2018-01-29 18:32:00', '2018-04-10 09:21:15'),
(7, 1, 1, 4, '665865', 'Open', '2018-01-29 18:39:18', '2018-01-29 18:41:15'),
(8, 1, 16, 600, '1254689547', 'Open', '2018-01-29 18:53:22', '2018-01-29 18:53:38'),
(9, 1, 17, 600, '136589745', 'Open', '2018-01-29 19:40:15', '2018-01-29 19:40:42'),
(10, 1, 17, 500, '562847', 'Open', '2018-01-29 19:43:19', '2018-01-29 20:48:41'),
(11, 1, 20, 650, '456985', 'Open', '2018-01-29 20:51:02', '2018-01-29 20:51:19'),
(12, 1, 21, 60, '25635887', 'Open', '2018-01-31 16:53:23', '2018-01-31 16:54:31'),
(13, 1, 12, 993, NULL, 'Open', '2018-04-02 15:50:42', NULL),
(14, 1, 12, 993, NULL, 'Open', '2018-04-02 15:51:08', '2018-04-08 10:54:47'),
(15, 1, 12, 993, NULL, 'Open', '2018-04-02 15:52:13', '2018-04-08 10:54:51'),
(16, 1, 22, 12, NULL, 'Open', '2018-04-08 17:47:02', NULL),
(17, 1, 12, 25, NULL, 'Open', '2018-04-08 17:51:37', NULL),
(18, 1, 12, 2, NULL, 'Open', '2018-04-08 17:52:24', NULL),
(19, 1, 12, 1, NULL, 'Open', '2018-04-08 17:53:36', NULL),
(20, 1, 12, 2, NULL, 'Open', '2018-04-08 17:57:15', NULL),
(21, 1, 12, 20, NULL, 'Open', '2018-04-08 18:31:47', NULL),
(22, 1, 12, 26, '4321', 'Open', '2018-04-10 11:25:34', '2018-04-11 06:10:56'),
(23, 1, 12, 22, NULL, 'Open', '2018-04-10 11:32:13', NULL),
(24, 1, 24, 100, 'CQR543', 'Open', '2018-04-11 18:04:57', '2018-04-11 18:07:10'),
(25, 1, 27, 60, 'MR25', 'Open', '2018-04-11 18:26:32', '2018-04-11 18:46:48'),
(26, 1, 28, 10, NULL, 'Open', '2018-06-05 08:52:53', NULL),
(27, 0, 28, 10, NULL, 'Open', '2018-06-05 08:53:01', NULL),
(28, 1, 28, 10, NULL, 'Open', '2018-06-07 15:10:38', NULL),
(29, 1, 28, 10, NULL, 'Open', '2018-08-11 10:39:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `patient_id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `consultant_id` int(11) NOT NULL,
  `at_time` varchar(100) NOT NULL,
  `at_date` varchar(50) NOT NULL,
  `is_inp` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `required_treatment` varchar(200) NOT NULL,
  `ins_num` varchar(200) NOT NULL,
  `in_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `out_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`patient_id`, `registration_id`, `dept_id`, `consultant_id`, `at_time`, `at_date`, `is_inp`, `room_id`, `required_treatment`, `ins_num`, `in_at`, `out_at`) VALUES
(1, 1, 0, 0, '', '', 1, 9, '', 'aasf', '2017-11-22 18:20:59', '0000-00-00 00:00:00'),
(1, 2, 0, 3, '10:15:00', '', 0, 0, '', '', '2017-11-23 11:11:26', '0000-00-00 00:00:00'),
(1, 3, 0, 1, '', '', 0, 0, '', '', '2017-11-23 12:24:55', '0000-00-00 00:00:00'),
(2, 4, 0, 8, '', '', 0, 0, '', '', '2017-11-23 16:15:14', '0000-00-00 00:00:00'),
(2, 5, 0, 2, '', '', 0, 0, '', '', '2017-11-23 16:16:42', '0000-00-00 00:00:00'),
(2, 6, 0, 2, '', '', 0, 0, '', '', '2017-11-23 16:19:08', '0000-00-00 00:00:00'),
(3, 7, 0, 4, '', '', 0, 0, '', '', '2017-11-23 18:05:57', '0000-00-00 00:00:00'),
(4, 8, 0, 1, '', '', 0, 0, '', '', '2017-11-24 17:19:04', '0000-00-00 00:00:00'),
(1, 9, 0, 2, '', '', 0, 0, '', '', '2017-11-24 17:47:21', '0000-00-00 00:00:00'),
(5, 10, 0, 1, '', '', 0, 0, '', '', '2017-11-25 16:11:53', '0000-00-00 00:00:00'),
(1, 11, 0, 2, '', '', 0, 0, '', '', '2017-11-25 16:13:26', '0000-00-00 00:00:00'),
(5, 12, 0, 0, '', '', 1, 5, '', '566826', '2017-11-25 16:47:37', '0000-00-00 00:00:00'),
(1, 13, 0, 1, '', '', 0, 1, '', '', '2017-11-27 13:41:53', '0000-00-00 00:00:00'),
(8, 14, 0, 0, '', '', 0, 0, '', '', '2017-12-05 18:04:20', '0000-00-00 00:00:00'),
(1, 15, 0, 4, '', '', 0, 0, '', '', '2017-12-25 13:00:39', '0000-00-00 00:00:00'),
(1, 16, 0, 0, '', '', 1, 2, '', 'test', '2017-12-25 13:04:19', '0000-00-00 00:00:00'),
(1, 17, 0, 0, '', '', 1, 3, '', 'test', '2017-12-25 13:06:22', '0000-00-00 00:00:00'),
(1, 18, 0, 0, '', '', 1, 4, '', 'test', '2017-12-25 13:07:40', '0000-00-00 00:00:00'),
(1, 19, 0, 0, '', '', 1, 4, '', 'test', '2017-12-25 13:09:19', '0000-00-00 00:00:00'),
(1, 20, 0, 0, '', '', 1, 4, '', 'test', '2017-12-25 13:11:26', '0000-00-00 00:00:00'),
(1, 21, 0, 0, '', '', 1, 4, '', 'test', '2017-12-25 13:12:14', '0000-00-00 00:00:00'),
(1, 22, 0, 0, '', '', 1, 4, '', 'test', '2017-12-25 13:12:51', '0000-00-00 00:00:00'),
(1, 23, 0, 0, '', '', 1, 4, '', 'test', '2017-12-25 13:13:42', '0000-00-00 00:00:00'),
(1, 24, 0, 0, '', '', 1, 4, '', 'test', '2017-12-25 13:15:56', '0000-00-00 00:00:00'),
(9, 25, 0, 0, '', '', 1, 1, '', '', '2017-12-26 12:33:30', '0000-00-00 00:00:00'),
(10, 26, 0, 7, '', '', 0, 0, '', '', '2017-12-27 17:30:05', '0000-00-00 00:00:00'),
(10, 27, 0, 7, '', '', 1, 7, '', '', '2017-12-27 17:32:11', '0000-00-00 00:00:00'),
(11, 28, 0, 0, '', '', 1, 0, '', '', '2017-12-28 06:02:28', '0000-00-00 00:00:00'),
(12, 29, 0, 7, '', '', 1, 8, '', '', '2018-01-02 11:32:33', '0000-00-00 00:00:00'),
(13, 30, 0, 7, '', '', 0, 0, '', '', '2018-01-06 10:55:41', '0000-00-00 00:00:00'),
(13, 31, 0, 7, '', '', 1, 6, '', '213123123', '2018-01-06 10:57:03', '0000-00-00 00:00:00'),
(13, 32, 0, 7, '', '', 0, 0, '', '', '2018-01-06 10:59:48', '0000-00-00 00:00:00'),
(13, 33, 0, 7, '', '', 0, 0, '', '', '2018-01-06 11:01:46', '0000-00-00 00:00:00'),
(13, 34, 0, 7, '', '', 1, 0, '', '678686', '2018-01-06 11:08:12', '0000-00-00 00:00:00'),
(17, 35, 0, 7, '', '', 0, 0, '', '', '2018-01-08 14:50:40', '0000-00-00 00:00:00'),
(18, 36, 0, 7, '', '', 0, 0, '', '', '2018-01-08 15:18:24', '0000-00-00 00:00:00'),
(19, 37, 0, 0, '', '', 0, 0, '', '', '2018-01-08 15:22:47', '0000-00-00 00:00:00'),
(20, 38, 0, 4, '', '', 0, 0, '', '', '2018-01-08 15:23:57', '0000-00-00 00:00:00'),
(21, 39, 0, 0, '', '', 0, 0, '', '', '2018-01-08 16:40:44', '0000-00-00 00:00:00'),
(14, 40, 0, 7, '', '', 1, 2, '', '', '2018-01-11 14:51:12', '0000-00-00 00:00:00'),
(26, 41, 0, 7, '00:00:00', '', 0, 0, '', '', '2018-01-16 15:44:58', '0000-00-00 00:00:00'),
(26, 42, 0, 7, '00:00:00', '', 0, 0, '', '', '2018-01-16 15:49:48', '0000-00-00 00:00:00'),
(27, 43, 0, 7, '00:00:00', '', 0, 0, '', '', '2018-01-17 06:42:08', '0000-00-00 00:00:00'),
(27, 44, 0, 7, '00:00:00', '', 0, 0, '', '', '2018-01-17 06:44:37', '0000-00-00 00:00:00'),
(28, 45, 0, 4, '10:45:00', '', 0, 0, '', '', '2018-01-17 06:56:16', '0000-00-00 00:00:00'),
(28, 46, 0, 4, '11:45:00', '18-01-2018', 0, 0, '', '', '2018-01-18 05:39:12', '0000-00-00 00:00:00'),
(29, 47, 0, 7, '12:45:00', '20-01-2018', 0, 0, '', '', '2018-01-19 08:56:40', '0000-00-00 00:00:00'),
(30, 48, 0, 7, '17:15:00', '22-01-2018', 0, 0, '', '', '2018-01-22 11:18:40', '0000-00-00 00:00:00'),
(31, 49, 0, 7, '17:45:00', '22-01-2018', 0, 0, '', '', '2018-01-22 11:20:23', '0000-00-00 00:00:00'),
(33, 50, 0, 7, '05:30:00', '01-01-1970', 0, 0, '', '', '2018-01-25 09:48:24', '0000-00-00 00:00:00'),
(33, 51, 0, 7, '', '', 1, 4, '', '567557y', '2018-01-25 09:56:54', '0000-00-00 00:00:00'),
(34, 52, 0, 7, '', '', 1, 1, '', '234', '2018-01-25 09:58:40', '0000-00-00 00:00:00'),
(35, 53, 0, 7, '05:30:00', '01-01-1970', 0, 0, '', '', '2018-01-31 16:24:08', '0000-00-00 00:00:00'),
(36, 54, 0, 7, '05:30:00', '01-01-1970', 0, 0, '', '', '2018-01-31 16:27:56', '0000-00-00 00:00:00'),
(37, 55, 0, 4, '12:45:00', '06-02-2018', 0, 0, '', '', '2018-02-04 14:23:56', '0000-00-00 00:00:00'),
(37, 56, 0, 7, '19:45:00', '09-02-2018', 0, 0, '', '', '2018-02-05 10:43:05', '0000-00-00 00:00:00'),
(1, 57, 0, 7, '01:00:00', '01-01-1970', 0, 0, '', '', '2018-02-06 20:33:43', '0000-00-00 00:00:00'),
(1, 58, 0, 4, '01:00:00', '01-01-1970', 0, 0, '', '', '2018-02-07 18:20:30', '0000-00-00 00:00:00'),
(1, 59, 0, 7, '01:00:00', '01-01-1970', 0, 0, '', '', '2018-02-07 18:27:35', '0000-00-00 00:00:00'),
(2, 60, 0, 7, '01:00:00', '01-01-1970', 0, 0, '', '', '2018-02-07 18:52:01', '0000-00-00 00:00:00'),
(2, 61, 0, 7, '13:02:00', '15-02-2018', 0, 0, '', '', '2018-02-07 18:54:48', '0000-00-00 00:00:00'),
(2, 62, 0, 7, '12:22:00', '09-02-2018', 0, 0, '', '', '2018-02-07 18:59:05', '0000-00-00 00:00:00'),
(2, 63, 0, 7, '14:02:00', '07-02-2018', 0, 0, '', '', '2018-02-07 19:04:38', '0000-00-00 00:00:00'),
(1, 64, 0, 4, '13:00:00', '13-02-2018', 0, 0, '', '', '2018-02-13 16:04:01', '0000-00-00 00:00:00'),
(1, 65, 0, 4, '12:30:00', '13-02-2018', 0, 0, '', '', '2018-02-13 17:11:34', '0000-00-00 00:00:00'),
(1, 66, 0, 4, '11:58:00', '15-02-2018', 0, 0, '', '', '2018-02-13 17:16:44', '0000-00-00 00:00:00'),
(1, 67, 0, 4, '14:00:00', '13-02-2018', 0, 0, '', '', '2018-02-13 17:42:20', '0000-00-00 00:00:00'),
(1, 68, 0, 7, '10:30:00', '13-02-2018', 0, 0, '', '', '2018-02-13 17:57:41', '0000-00-00 00:00:00'),
(1, 69, 0, 4, '', '', 0, 0, '', '', '2018-03-18 18:07:18', '0000-00-00 00:00:00'),
(1, 70, 0, 4, '', '', 0, 0, '', '', '2018-03-18 18:09:50', '0000-00-00 00:00:00'),
(1, 71, 0, 4, '13:00:00', '22-03-2018', 0, 0, '', '', '2018-03-18 18:10:55', '0000-00-00 00:00:00'),
(1, 72, 0, 7, '12:59:00', '29-06-2018', 0, 0, '', '', '2018-03-18 19:25:23', '0000-00-00 00:00:00'),
(4, 73, 0, 7, '10:29:00', '19-03-2018', 0, 0, '', '', '2018-03-19 05:23:51', '0000-00-00 00:00:00'),
(4, 74, 0, 7, '10:14:00', '19-03-2018', 0, 0, '', '', '2018-03-19 05:33:09', '0000-00-00 00:00:00'),
(4, 75, 0, 7, '12:05:00', '19-03-2018', 0, 0, '', '', '2018-03-19 05:42:06', '0000-00-00 00:00:00'),
(4, 76, 0, 7, '12:05:00', '19-03-2018', 0, 0, '', '', '2018-03-19 05:42:44', '0000-00-00 00:00:00'),
(4, 77, 0, 7, '14:03:00', '19-03-2018', 0, 0, '', '', '2018-03-19 05:43:15', '0000-00-00 00:00:00'),
(4, 78, 0, 7, '13:00:00', '20-03-2018', 0, 0, '', '', '2018-03-19 15:39:54', '0000-00-00 00:00:00'),
(1, 79, 0, 7, '02:01:00', '12-04-2018', 0, 0, '', '', '2018-03-31 11:14:12', '0000-00-00 00:00:00'),
(2, 80, 0, 7, '12:01:00', '01-04-2018', 0, 0, '', '', '2018-03-31 13:25:10', '0000-00-00 00:00:00'),
(2, 81, 0, 7, '13:00:00', '01-04-2018', 0, 0, '', '', '2018-03-31 13:26:05', '0000-00-00 00:00:00'),
(2, 82, 0, 7, '13:00:00', '01-04-2018', 0, 0, '', '', '2018-03-31 13:26:39', '0000-00-00 00:00:00'),
(2, 83, 0, 7, '20:00:00', '31-03-2018', 0, 0, '', '', '2018-03-31 13:34:27', '0000-00-00 00:00:00'),
(41, 84, 0, 4, '', '', 1, 5, '', '123123123', '2018-05-18 09:05:00', '0000-00-00 00:00:00'),
(41, 85, 0, 7, '', '', 1, 11, '', '123123', '2018-05-18 09:07:13', '0000-00-00 00:00:00'),
(42, 86, 0, 4, '09:09:00', '06-06-2018', 0, 0, '', '', '2018-06-05 07:59:52', '0000-00-00 00:00:00'),
(42, 87, 0, 4, '', '', 1, 12, '', '23132313', '2018-06-05 08:59:22', '0000-00-00 00:00:00'),
(43, 88, 0, 4, '19:00:00', '08-12-2018', 0, 0, '', '', '2018-06-07 14:59:30', '0000-00-00 00:00:00'),
(43, 89, 0, 4, '19:00:00', '08-12-2018', 0, 0, '', '', '2018-06-07 14:59:31', '0000-00-00 00:00:00'),
(43, 90, 0, 4, '19:00:00', '08-12-2018', 0, 0, '', '', '2018-06-07 14:59:32', '0000-00-00 00:00:00'),
(43, 91, 0, 7, '', '', 1, 13, '', '23423424', '2018-06-07 15:06:59', '0000-00-00 00:00:00'),
(44, 92, 0, 7, '10:00:00', '02-08-2018', 0, 0, '', '', '2018-07-30 14:19:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `registration_flow`
--

CREATE TABLE `registration_flow` (
  `id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `attented_by` int(11) NOT NULL,
  `complaint` varchar(200) DEFAULT NULL,
  `diagnosis` varchar(500) NOT NULL,
  `investigation` varchar(300) NOT NULL,
  `advice` varchar(300) NOT NULL,
  `next_visit` date DEFAULT NULL,
  `on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration_flow`
--

INSERT INTO `registration_flow` (`id`, `registration_id`, `patient_id`, `attented_by`, `complaint`, `diagnosis`, `investigation`, `advice`, `next_visit`, `on_date`) VALUES
(1, 1, 1, 3, 'asd', '', '', '', '0000-00-00', '2017-11-22 18:20:59'),
(2, 2, 1, 3, 'Test', '', '', '', '0000-00-00', '2017-11-23 11:11:27'),
(3, 3, 1, 0, '121', '', '', '', NULL, '2017-11-23 12:24:55'),
(4, 4, 2, 0, 'Test', '', '', '', NULL, '2017-11-23 16:15:14'),
(5, 5, 2, 0, 'ASasd', '', '', '', NULL, '2017-11-23 16:16:42'),
(6, 6, 2, 18, '222222222222', 'Diagnized', 'Investigation', 'Adviceing', '2018-03-01', '2017-11-23 16:19:08'),
(7, 7, 3, 0, 'jkafjkakjfjasf', '', '', '', NULL, '2017-11-23 18:05:57'),
(8, 8, 4, 0, 'Nothing', '', '', '', NULL, '2017-11-24 17:19:04'),
(9, 9, 1, 0, '2222', '', '', '', NULL, '2017-11-24 17:47:22'),
(10, 10, 5, 0, 'Cold', '', '', '', NULL, '2017-11-25 16:11:53'),
(11, 11, 1, 0, 'Fever', '', '', '', NULL, '2017-11-25 16:13:26'),
(12, 12, 5, 0, 'trea', '', '', '', NULL, '2017-11-25 16:47:37'),
(13, 13, 1, 0, 'Test', '', '', '', NULL, '2017-11-27 13:41:53'),
(14, 14, 8, 0, 'Nothing', '', '', '', NULL, '2017-12-05 18:04:20'),
(15, 15, 1, 0, 'Tets', '', '', '', NULL, '2017-12-25 13:00:39'),
(16, 16, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:04:19'),
(17, 17, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:06:22'),
(18, 18, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:07:40'),
(19, 19, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:09:19'),
(20, 20, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:11:27'),
(21, 21, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:12:14'),
(22, 22, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:12:51'),
(23, 23, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:13:42'),
(24, 24, 1, 0, 'test', '', '', '', NULL, '2017-12-25 13:15:56'),
(25, 25, 9, 0, '', '', '', '', NULL, '2017-12-26 12:33:30'),
(26, 26, 10, 0, 'high fever ', '', '', '', NULL, '2017-12-27 17:30:05'),
(27, 27, 10, 0, 'fever 1', '', '', '', NULL, '2017-12-27 17:32:11'),
(28, 28, 11, 0, '', '', '', '', NULL, '2017-12-28 06:02:28'),
(29, 29, 12, 0, 'fever', '', '', '', NULL, '2018-01-02 11:32:33'),
(30, 30, 13, 0, 'High Fever and Vomiting', '', '', '', NULL, '2018-01-06 10:55:41'),
(31, 31, 13, 0, 'surgery', '', '', '', NULL, '2018-01-06 10:57:03'),
(32, 32, 13, 0, 'llllllllllllllll', '', '', '', NULL, '2018-01-06 10:59:48'),
(33, 33, 13, 0, 'jkhkjhjkhjhkll', '', '', '', NULL, '2018-01-06 11:01:46'),
(34, 34, 13, 0, 'kjjljl', '', '', '', NULL, '2018-01-06 11:08:12'),
(35, 35, 17, 18, 'frver', 'jghjhgj', 'jjkhk', 'jhjk', '0000-00-00', '2018-01-08 14:50:40'),
(36, 36, 18, 0, 'cold', '', '', '', NULL, '2018-01-08 15:18:24'),
(37, 37, 19, 0, '', '', '', '', NULL, '2018-01-08 15:22:47'),
(38, 38, 20, 0, 'kjhkjh', '', '', '', NULL, '2018-01-08 15:23:57'),
(39, 39, 21, 0, '', '', '', '', NULL, '2018-01-08 16:40:44'),
(40, 40, 14, 0, '', '', '', '', NULL, '2018-01-11 14:51:12'),
(41, 41, 26, 18, 'Ear Pain', 'dskl;l.m,.m\nsdklf;', 'laser', 'come back after 10 days', '2018-01-26', '2018-01-16 15:44:58'),
(42, 42, 26, 18, 'Throat infection', 'sdlkfjs;lfjalsfs', 'throat check up', 'salt water', '2018-01-23', '2018-01-16 15:49:48'),
(43, 43, 27, 18, 'sick', 'HEART BEAT CHECKED', 'TEMPERATURE CHECKED', 'TAKE REST', '2018-01-24', '2018-01-17 06:42:08'),
(44, 44, 27, 0, 'STILL SICK', '', '', '', NULL, '2018-01-17 06:44:37'),
(45, 45, 28, 0, 'fever', '', '', '', NULL, '2018-01-17 06:56:16'),
(46, 46, 28, 0, 'Testing date', '', '', '', NULL, '2018-01-18 05:39:12'),
(47, 47, 29, 0, 'Headache', '', '', '', NULL, '2018-01-19 08:56:40'),
(48, 48, 30, 18, 'Fever and cold', 'test', 'testing', 'sfsfafssdf', '2018-01-10', '2018-01-22 11:18:40'),
(49, 49, 31, 0, 'back pain', '', '', '', NULL, '2018-01-22 11:20:23'),
(50, 50, 33, 18, 'fever', 'sdfsafd', 'sdff', 'efsffsf', '2018-02-20', '2018-01-25 09:48:24'),
(51, 51, 33, 0, 'surgery', '', '', '', NULL, '2018-01-25 09:56:54'),
(52, 52, 34, 0, 'spinal surgery', '', '', '', NULL, '2018-01-25 09:58:40'),
(53, 53, 35, 0, 'fever', '', '', '', NULL, '2018-01-31 16:24:08'),
(54, 54, 36, 18, 'fever', 'test', 'est', '', '0000-00-00', '2018-01-31 16:27:56'),
(55, 55, 37, 18, 'fever', 'teselkajdslk;fjas;lfkdjsdlf;js;lfkjsal;fjsl;fsjkad\ndsf;kjdsl;fkjaslfk;jasklfjskl;fjalksfdj;salkfjs;klfjsafldsa\nsdkfjaslkfdja;sdlkfja;oeijrwokclkncsldkjfdflkfjls;kvmxcnclskdjf;lsd\nasdfkjasd;lfkjas;ldfjsalk;dfjls;kajfls;kfjklsdfjkjdshgkjhsadlkfjasl;kfjdsaf\nsdfka;sdfjklsajd;fkljaslkfjsa;kldfjklsdajklfjlksajflskdafjwoeiriowruewoiruweoirwe\nwerweioruewioruoiweureiworuoiuewoiruweioruwoeiruoiweuriodjfkslklcmloeijfaoiwejoweiruwoeiurow oeijroweiuroewuriouweoriuweoriuweoiruwoeruowei rewioruowe rewir weoiru', 'teselkajdslk;fjas;lfkdjsdlf;js;lfkjsal;fjsl;fsjkad\ndsf;kjdsl;fkjaslfk;jasklfjskl;fjalksfdj;salkfjs;klfjsafldsa\nsdkfjaslkfdja;sdlkfja;oeijrwokclkncsldkjfdflkfjls;kvmxcnclskdjf;lsd\nasdfkjasd;lfkjas;ldfjsalk;dfjls;kajfls;kfjklsdfjkjdshgkjhsadlkfjasl;kfjdsaf\nsdfka;sdfjklsajd;fkljaslkfjsa;kldfjklsdajklfj', 'teselkajdslk;fjas;lfkdjsdlf;js;lfkjsal;fjsl;fsjkad\ndsf;kjdsl;fkjaslfk;jasklfjskl;fjalksfdj;salkfjs;klfjsafldsa\nsdkfjaslkfdja;sdlkfja;oeijrwokclkncsldkjfdflkfjls;kvmxcnclskdjf;lsd\nasdfkjasd;lfkjas;ldfjsalk;dfjls;kajfls;kfjklsdfjkjdshgkjhsadlkfjasl;kfjdsaf\nsdfka;sdfjklsajd;fkljaslkfjsa;kldfjklsdajklfj', '2018-02-25', '2018-02-04 14:23:56'),
(56, 56, 37, 0, 'Sick', '', '', '', NULL, '2018-02-05 10:43:05'),
(57, 57, 1, 0, '12', '', '', '', NULL, '2018-02-06 20:33:43'),
(58, 58, 1, 0, '', '', '', '', NULL, '2018-02-07 18:20:30'),
(59, 59, 1, 0, 'Complaining', '', '', '', NULL, '2018-02-07 18:27:35'),
(60, 60, 2, 0, 'This Is a Stuck', '', '', '', NULL, '2018-02-07 18:52:01'),
(61, 61, 2, 0, 'This Is a Stuck', '', '', '', NULL, '2018-02-07 18:54:48'),
(62, 62, 2, 0, 'Tetssacs', '', '', '', NULL, '2018-02-07 18:59:05'),
(63, 63, 2, 3, 'Testing', '', '', '', '0000-00-00', '2018-02-07 19:04:38'),
(64, 64, 1, 0, 'avadv', '', '', '', NULL, '2018-02-13 16:04:01'),
(65, 65, 1, 0, '', '', '', '', NULL, '2018-02-13 17:11:34'),
(66, 66, 1, 0, 'av', '', '', '', NULL, '2018-02-13 17:16:44'),
(67, 67, 1, 0, '', '', '', '', NULL, '2018-02-13 17:42:20'),
(68, 68, 1, 0, 'complaint', '', '', '', NULL, '2018-02-13 17:57:41'),
(69, 71, 1, 0, 'test', '', '', '', NULL, '2018-03-18 18:10:55'),
(70, 72, 1, 0, 'test', '', '', '', NULL, '2018-03-18 19:25:23'),
(71, 73, 4, 0, 'Testing', '', '', '', NULL, '2018-03-19 05:23:51'),
(72, 74, 4, 0, 'testing', '', '', '', NULL, '2018-03-19 05:33:09'),
(73, 75, 4, 0, 'testing', '', '', '', NULL, '2018-03-19 05:42:06'),
(74, 76, 4, 0, 'testing', '', '', '', NULL, '2018-03-19 05:42:44'),
(75, 77, 4, 0, 'test', '', '', '', NULL, '2018-03-19 05:43:15'),
(76, 78, 4, 0, 'Testing', '', '', '', NULL, '2018-03-19 15:39:54'),
(77, 79, 1, 3, 'cold', 'anvsnnbs', 'investiga', 'advising', '2018-03-31', '2018-03-31 11:14:12'),
(78, 80, 2, 0, 'complaint', '', '', '', NULL, '2018-03-31 13:25:10'),
(79, 81, 2, 0, 'vksnv', '', '', '', NULL, '2018-03-31 13:26:05'),
(80, 82, 2, 0, 'vksnv', '', '', '', NULL, '2018-03-31 13:26:39'),
(81, 83, 2, 0, 'complaint', '', '', '', NULL, '2018-03-31 13:34:27'),
(82, 84, 41, 0, 'something', '', '', '', NULL, '2018-05-18 09:05:00'),
(83, 85, 41, 0, 'something', '', '', '', NULL, '2018-05-18 09:07:13'),
(84, 86, 42, 18, 'head ache', 'slkjflkjsldfj', 'testing', 'take rest', '2018-06-23', '2018-06-05 07:59:52'),
(85, 87, 42, 0, 'scanning and surgery', '', '', '', NULL, '2018-06-05 08:59:22'),
(86, 88, 43, 0, 'High Fever and Vomiting', '', '', '', NULL, '2018-06-07 14:59:30'),
(87, 89, 43, 0, 'High Fever and Vomiting', '', '', '', NULL, '2018-06-07 14:59:31'),
(88, 90, 43, 18, 'High Fever and Vomiting', 'dsfsfddf', 'fdsfsffs', 'sdfsf', '2018-06-18', '2018-06-07 14:59:32'),
(89, 91, 43, 0, 'scanning and surgery', '', '', '', NULL, '2018-06-07 15:06:59'),
(90, 92, 44, 18, 'fever', 'sdfsdf', 'sdfsdf', 'sfdsdf', '0000-00-00', '2018-07-30 14:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_map`
--

CREATE TABLE `role_map` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_desctiption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 is used, 0 is available',
  `dept_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `ward_id`, `room_type`, `floor`, `status`, `dept_id`) VALUES
(1, 3, 1, 3, 1, NULL),
(2, 3, 1, 3, 1, NULL),
(3, 4, 1, 3, 1, NULL),
(4, 3, 1, 3, 1, NULL),
(5, 3, 1, 3, 1, NULL),
(6, 3, 1, 3, 1, NULL),
(7, 3, 2, 2, 1, NULL),
(8, 3, 2, 2, 1, NULL),
(9, 3, 2, 2, 1, NULL),
(10, 3, 2, 2, 1, NULL),
(11, 3, 2, 2, 1, NULL),
(12, 3, 2, 2, 1, NULL),
(13, 3, 2, 2, 1, NULL),
(14, 3, 7, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_type_map`
--

CREATE TABLE `room_type_map` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `min_admission` int(11) NOT NULL,
  `max_admission` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_type_map`
--

INSERT INTO `room_type_map` (`type_id`, `type_name`, `min_admission`, `max_admission`, `charge`, `created_at`) VALUES
(1, 'VIP Suite', 0, 0, 380, '2017-11-06 18:49:18'),
(2, 'Single Deluxe Room', 0, 0, 250, '2017-11-06 18:49:18'),
(3, 'Two-Bedded Room', 0, 0, 150, '2017-11-06 18:49:18'),
(4, 'Four-Bedded Room', 0, 0, 100, '2017-11-06 18:49:18'),
(5, 'Intensive Care Unit', 0, 0, 280, '2017-11-06 18:49:18'),
(6, 'Isolation Room', 0, 0, 140, '2017-11-06 18:49:18'),
(7, 'Operation Theatre', 0, 0, 1000, '2017-12-07 04:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `sample_inventory`
--

CREATE TABLE `sample_inventory` (
  `sample_log_id` int(11) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `collected_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample_inventory`
--

INSERT INTO `sample_inventory` (`sample_log_id`, `sample_id`, `reg_id`, `qty`, `collected_on`) VALUES
(1, 1, 1, 0, '2017-12-20 17:39:18'),
(2, 1, 1, 1, '2017-12-20 17:43:29'),
(3, 2, 1, 0, '2017-12-20 17:45:16'),
(4, 1, 1, 7, '2017-12-20 17:45:49'),
(5, 3, 1, 100, '2017-12-20 17:47:06'),
(6, 1, 1, 22, '2017-12-20 17:47:51'),
(7, 1, 1, 22, '2017-12-22 16:20:51'),
(8, 1, 2, 0, '2017-12-25 09:48:25'),
(9, 2, 2, 0, '2017-12-25 10:12:02'),
(10, 1, 7, 2, '2017-12-25 11:15:36'),
(11, 1, 33, 5, '2018-01-06 11:04:16'),
(12, 2, 33, 10, '2018-01-06 11:05:04'),
(13, 1, 1, 25, '2018-01-08 16:06:20'),
(14, 1, 42, 10, '2018-01-16 15:59:11'),
(15, 1, 43, 10, '2018-01-17 06:46:20'),
(16, 1, 47, 5, '2018-01-19 09:01:11'),
(17, 1, 48, 10, '2018-01-22 11:31:58'),
(18, 1, 50, 5, '2018-01-25 09:52:04'),
(19, 1, 54, -90, '2018-01-31 16:39:31'),
(20, 1, 55, 10, '2018-02-04 14:30:10'),
(21, 1, 63, 6, '2018-03-17 16:33:02'),
(22, 1, 86, 5, '2018-06-05 08:06:26'),
(23, 1, 90, 0, '2018-06-07 15:03:54'),
(24, 1, 92, 0, '2018-07-30 14:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `sample_log`
--

CREATE TABLE `sample_log` (
  `sample_id` int(11) NOT NULL,
  `sample_name` varchar(100) NOT NULL,
  `sample_type` varchar(100) NOT NULL,
  `units` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample_log`
--

INSERT INTO `sample_log` (`sample_id`, `sample_name`, `sample_type`, `units`) VALUES
(1, 'Blood', '', 'ml'),
(2, 'Sample 2', '', 'ml'),
(3, 'Sample 3', '', 'ml');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `screen_id` int(11) NOT NULL,
  `screen_name` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`screen_id`, `screen_name`, `link`, `created_at`) VALUES
(1, 'Reception', '/reception/reception.php', '2017-12-08 11:09:13'),
(2, 'Billing', '/billing/opdbilling.php', '2017-12-10 07:27:31'),
(3, 'Patient Registration', '/View/patient_reg.php', '2017-12-08 11:10:24'),
(4, 'Out Patient Management', '/patient/op.php', '2017-12-08 11:10:24'),
(5, 'In Patient Management', '/patient/inpatient.php', '2017-12-08 11:10:53'),
(6, 'Pharmacy', '/pharmacy/pharmacy.php', '2017-12-08 11:10:53'),
(7, 'Pathology & Imaging', '/Pathology_and_imaging/reporting.php', '2017-12-08 11:12:40'),
(8, 'Requisition', '/centralStore/request_item.php', '2017-12-08 11:12:40'),
(9, 'Inventory', '/View/store.php', '2017-12-08 11:13:12'),
(10, 'Canteen', '/canteen/billing.php', '2017-12-08 11:13:12'),
(11, 'Pay Roll', '', '2017-12-08 11:13:28'),
(12, 'Accounts', '', '2017-12-08 11:13:28'),
(13, 'MRD', '', '2017-12-08 11:13:41'),
(14, 'Nursing Station', '/View/nursing_station.php', '2017-12-08 11:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `screen_staff_map`
--

CREATE TABLE `screen_staff_map` (
  `screen_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screen_staff_map`
--

INSERT INTO `screen_staff_map` (`screen_id`, `staff_id`, `created_at`) VALUES
(1, 0, '2018-01-04 05:05:11'),
(1, 3, '2017-12-10 13:16:12'),
(1, 18, '2017-12-13 06:16:08'),
(2, 0, '2018-01-04 05:05:11'),
(2, 3, '2017-12-10 13:16:12'),
(2, 18, '2017-12-13 06:16:08'),
(3, 0, '2018-01-04 05:05:11'),
(3, 3, '2017-12-10 07:22:42'),
(3, 18, '2017-12-13 06:16:08'),
(4, 0, '2018-01-04 05:05:11'),
(4, 3, '2017-12-10 07:22:42'),
(4, 4, '2017-12-11 04:32:44'),
(4, 18, '2017-12-13 06:16:08'),
(5, 0, '2018-01-04 05:05:11'),
(5, 3, '2017-12-10 13:17:14'),
(5, 4, '2017-12-11 04:32:44'),
(5, 18, '2017-12-13 06:16:08'),
(6, 0, '2018-01-04 05:05:11'),
(6, 3, '2017-12-10 13:17:14'),
(6, 18, '2017-12-13 06:16:08'),
(7, 0, '2018-01-04 05:05:11'),
(7, 3, '2017-12-10 13:17:14'),
(7, 18, '2017-12-13 06:16:08'),
(8, 0, '2018-01-04 05:05:11'),
(8, 3, '2017-12-10 13:17:14'),
(8, 18, '2017-12-13 06:16:08'),
(9, 0, '2018-01-04 05:05:11'),
(9, 3, '2017-12-10 13:17:14'),
(9, 18, '2017-12-13 06:16:08'),
(10, 0, '2018-01-04 05:05:11'),
(10, 3, '2017-12-10 13:17:14'),
(10, 18, '2017-12-13 06:16:08'),
(11, 0, '2018-01-04 05:05:11'),
(11, 3, '2017-12-10 13:17:14'),
(11, 18, '2017-12-13 06:16:08'),
(12, 0, '2018-01-04 05:05:11'),
(12, 18, '2017-12-13 06:16:08'),
(13, 0, '2018-01-04 05:05:11'),
(13, 18, '2017-12-13 06:16:08'),
(14, 3, '2018-01-04 05:05:11'),
(14, 18, '2017-12-13 06:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_type` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `m_name` varchar(200) NOT NULL,
  `l_name` varchar(200) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `joining_date` date DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `emp_type` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_type`, `role`, `title`, `f_name`, `m_name`, `l_name`, `dob`, `email`, `joining_date`, `dept_id`, `emp_type`, `created_at`) VALUES
(7, 10, 0, '', 'Siddique', 'as', 'as', '1993-05-29', 'abu@headrun.net', NULL, 0, '1', '2017-12-02 23:20:14'),
(4, 10, 0, '', 'Rehan', '', 'Khan', '1993-05-29', 'siddique.abu421@gmail.com', NULL, 8, '1', '2017-12-02 05:17:29'),
(16, 1, 0, '', 'Sarene', '', 'Smith', '1993-12-28', 'siddique.abu422@gmail.com', NULL, 2, '1', '2017-12-13 06:17:54'),
(3, 1, 0, 'Mr.', 'Sarene', '', 'Smith', '1993-12-28', 'siddique.abu42@gmail.com', NULL, 2, '1', '2017-12-02 05:12:03'),
(6, 1, 0, '', 'Teja', '', 'Venkar', '1993-05-29', 'tejavenkat7@gmail.com', NULL, 50, '1', '2017-12-02 14:37:39'),
(18, 1, 0, '', 'FNAME', 'MNAME', 'LNAME', '1912-12-12', 'test@test.com', NULL, 50, '1', '2017-12-27 14:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `staff_personal_info`
--

CREATE TABLE `staff_personal_info` (
  `staff_id` int(11) NOT NULL,
  `first_line_add` varchar(200) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` int(11) NOT NULL,
  `contact_num` varchar(100) NOT NULL,
  `add_contact_num` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_personal_info`
--

INSERT INTO `staff_personal_info` (`staff_id`, `first_line_add`, `state`, `city`, `zip`, `contact_num`, `add_contact_num`) VALUES
(103, 'No 9, Selvaganapathy Koil Street, Ullagaram, ', 'Tamil Nadu', 'Chennai', 600091, '8056208210', '9283303310'),
(103, 'No 9, Selvaganapathy Koil Street, Ullagaram, ', 'Tamil Nadu', 'Chennai', 600091, '8056208210', '9283303310'),
(103, 'No 9, Selvaganapathy Koil Street, Ullagaram, ', 'Tamil Nadu', 'Chennai', 600091, '8056208210', '9283303310'),
(103, 'No 9, Selvaganapathy Koil Street, Ullagaram, ', 'Tamil Nadu', 'Chennai', 600091, '8056208210', '9283303310'),
(115, '9 Selvaganapathy Koi street', 'Tamil Nadu', 'Chennai', 600091, '8056208210', '8056208210'),
(115, '9 Selvaganapathy Koi street', 'Tamil Nadu', 'Chennai', 600091, '8056208210', '8056208210'),
(115, '9 Selvaganapathy Koi street', 'Tamil Nadu', 'Chennai', 600091, '8056208210', '8056208210'),
(4, 'Test', 'bsvsjdbvids', 'sdvjbisv', 0, 'svjsdvjks', 'vjsdvjsvs'),
(4, 'Test', 'bsvsjdbvids', 'sdvjbisv', 0, 'svjsdvjks', 'vjsdvjsvs'),
(6, 'rbvnsfb', ' bjlnbln', 'bklsnlfns', 0, 'bkslnblnds', 'bljdsnfbjldnl'),
(7, 'asasf', 'Tamil Nadi', 'Chennai', 600091, '8056208210', '8056208210'),
(7, 'asasf', 'Tamil Nadi', 'Chennai', 600091, '8056208210', '8056208210'),
(7, 'asasf', 'Tamil Nadi', 'Chennai', 600091, '8056208210', '8056208210'),
(16, 'Testing', 'svs ld vls ', 'svdl vls vd', 0, ' slv ls ', 'nsvldnvlsdlv'),
(4, 'Test', 'bsvsjdbvids', 'sdvjbisv', 0, 'svjsdvjks', 'vjsdvjsvs'),
(6, 'rbvnsfb', ' bjlnbln', 'bklsnlfns', 0, 'bkslnblnds', 'bljdsnfbjldnl'),
(18, 'First Line Of Address', 'State', 'City', 0, 'Contact Number', 'Additional Contact Number'),
(6, 'rbvnsfb', ' bjlnbln', 'bklsnlfns', 0, 'bkslnblnds', 'bljdsnfbjldnl');

-- --------------------------------------------------------

--
-- Table structure for table `staff_type_map`
--

CREATE TABLE `staff_type_map` (
  `type_id` int(11) NOT NULL,
  `staff_type_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_type_map`
--

INSERT INTO `staff_type_map` (`type_id`, `staff_type_name`, `created_at`) VALUES
(1, 'Admin', '2017-11-08 16:49:27'),
(10, 'Doctor', '2017-11-06 17:35:30'),
(12, 'Nurse', '2017-11-30 15:52:00'),
(13, 'Ward-Boy', '2017-11-30 15:52:28'),
(35, 'testing', '2017-12-13 05:03:10'),
(36, 'test', '2017-12-13 05:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `staff_type_screen_map`
--

CREATE TABLE `staff_type_screen_map` (
  `staff_type_id` int(11) NOT NULL,
  `screen_access_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_type_screen_map`
--

INSERT INTO `staff_type_screen_map` (`staff_type_id`, `screen_access_id`, `created_at`) VALUES
(1, 1, '2017-12-13 05:26:54'),
(1, 2, '2017-12-13 05:26:54'),
(1, 4, '2017-12-13 05:26:54'),
(1, 5, '2017-12-13 05:26:54'),
(1, 6, '2017-12-13 05:26:54'),
(1, 7, '2017-12-13 05:26:54'),
(1, 8, '2017-12-13 05:26:54'),
(1, 9, '2017-12-13 05:26:54'),
(1, 10, '2017-12-13 05:26:54'),
(1, 11, '2017-12-13 05:26:54'),
(1, 12, '2017-12-13 05:26:54'),
(1, 13, '2017-12-13 05:26:54'),
(1, 14, '2017-12-13 05:26:55'),
(10, 4, '2017-12-13 08:05:38'),
(10, 5, '2017-12-13 08:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `vendor_type` enum('COMPANY','INDIVIDUAL') DEFAULT NULL,
  `tax_id` varchar(50) NOT NULL,
  `GST_number` varchar(50) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `vendor_type`, `tax_id`, `GST_number`, `contact_name`, `phone_number`, `email_id`) VALUES
(1, 'The Deck Store', 'COMPANY', '456', '96854245755', 'Siddique', '8056208210', 'abu@notemonk.com');

-- --------------------------------------------------------

--
-- Table structure for table `surgery`
--

CREATE TABLE `surgery` (
  `surg_id` int(11) NOT NULL,
  `surg_type` varchar(100) NOT NULL,
  `surg_name` varchar(100) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surgery`
--

INSERT INTO `surgery` (`surg_id`, `surg_type`, `surg_name`, `cost`) VALUES
(1, 'Orthopedic', 'Achilles Tear Surgery', 20000),
(2, 'Orthopedic', 'Meniscus Repair Surgery', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `surgery_log`
--

CREATE TABLE `surgery_log` (
  `log_id` int(11) NOT NULL,
  `surg_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `doctors` varchar(300) NOT NULL,
  `medicine_used` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surgery_log`
--

INSERT INTO `surgery_log` (`log_id`, `surg_id`, `reg_id`, `room_id`, `doctors`, `medicine_used`, `status`, `comments`) VALUES
(1, 1, 1, 14, 'Array', 0, 1, '<br>ksjfl;sf<br><br>sdjfsljf;<br><br>djksa;klfsf<br><br>sdflkjaslfdjdsf<br><br>sfjlaakdjaflsf<br>'),
(2, 2, 1, 0, 'Array', 0, 0, ''),
(3, 2, 1, 0, 'Array', 0, 1, '<br>is it working<br><br>Siddique<br><br>Test<br>'),
(4, 1, 34, 0, 'Array', 0, 1, '<br>nknkj<br>'),
(5, 2, 34, 0, 'Array', 0, 0, ''),
(6, 2, 34, 0, 'Array', 0, 0, ''),
(7, 1, 34, 0, 'Array', 0, 0, ''),
(8, 1, 34, 0, 'Array', 0, 0, ''),
(9, 1, 2, 0, 'Array', 0, 0, '<br>4545454<br><br><br>'),
(10, 2, 52, 0, 'Array', 0, 0, ''),
(11, 1, 87, 0, 'Array', 0, 0, ''),
(12, 1, 91, 0, 'Array', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `surg_docs`
--

CREATE TABLE `surg_docs` (
  `log_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surg_docs`
--

INSERT INTO `surg_docs` (`log_id`, `doc_id`, `added_at`) VALUES
(1, 4, '2017-12-10 17:45:39'),
(1, 7, '2017-12-10 17:45:39'),
(2, 4, '2017-12-27 15:45:17'),
(2, 7, '2017-12-27 15:45:17'),
(3, 4, '2017-12-27 15:46:23'),
(3, 7, '2017-12-27 15:46:23'),
(4, 7, '2018-01-06 11:14:42'),
(4, 4, '2018-01-06 11:14:42'),
(5, 7, '2018-01-06 11:16:00'),
(6, 4, '2018-01-06 11:37:41'),
(7, 7, '2018-01-08 16:28:59'),
(8, 7, '2018-01-08 16:30:02'),
(9, 4, '2018-01-11 14:51:55'),
(10, 7, '2018-01-25 10:00:48'),
(10, 4, '2018-01-25 10:00:48'),
(11, 4, '2018-06-05 09:00:12'),
(12, 4, '2018-06-07 15:08:03'),
(12, 7, '2018-06-07 15:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `surg_treat`
--

CREATE TABLE `surg_treat` (
  `treat_id` int(11) NOT NULL,
  `treat_type` varchar(100) NOT NULL,
  `treat_name` varchar(100) NOT NULL,
  `min_admit` int(11) NOT NULL,
  `max_admit` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `transaction_type_tid` int(11) NOT NULL,
  `transaction_in` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_type`, `transaction_type_tid`, `transaction_in`, `amount`) VALUES
(1, 'patient_charges', 92, 1, '444'),
(2, 'patient_charges', 93, 1, '450'),
(3, 'patient_charges', 94, 1, '22'),
(4, 'patient_charges', 95, 1, '44'),
(5, 'patient_charges', 96, 1, '11'),
(6, 'patient_charges', 99, 1, '4'),
(7, 'patient_charges', 100, 1, '242'),
(8, 'patient_charges', 101, 1, '253'),
(9, 'patient_charges', 102, 1, '110'),
(10, 'patient_charges', 103, 1, '130'),
(11, 'patient_charges', 104, 1, '39'),
(12, 'patient_charges', 105, 1, '35'),
(13, 'patient_charges', 118, 1, '1000'),
(14, 'patient_charges', 129, 1, '1000'),
(15, 'patient_charges', 130, 1, '450'),
(16, 'patient_charges', 131, 1, '0'),
(17, 'patient_charges', 138, 1, '444');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `id` int(11) NOT NULL,
  `hosp_id` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `email`, `role`, `token`, `id`, `hosp_id`, `created_at`) VALUES
('sid421', 'Administrator', 'siddique.abu42@gmail.com', '1', '', 3, 1, '2017-10-30 12:26:46'),
('rehan4221', 'Rehan  Khan', 'siddique.abu421@gmail.com', '10', '', 4, 1, '2017-12-13 13:38:20'),
('', 'Teja  Venkar', 'tejavenkat7@gmail.com', '1', '54656a61202056656e6b6172', 6, 1, '2018-01-04 05:05:24'),
('abu421', 'The  Doctor', 'abu@headrun.net', '10', '', 7, 1, '2017-12-03 04:50:47'),
('', 'Sarene  Smith', 'siddique.abu422@gmail.com', '1', '536172656e652020536d697468', 16, 1, '2017-12-13 11:48:16'),
('testing', 'FNAME MNAME LNAME', 'test@test.com', '1', '', 18, 1, '2017-12-27 14:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`user_id`, `username`, `password`, `email`, `created_at`) VALUES
(7, 'abu421', '$2y$10$u08E8l.hG7q5Q0fXy8dfneKz7TQYuBZRH1uTeL7Ttw3KXIf2jWJ9q', 'abu@headrun.net', '2017-12-02 23:21:17'),
(4, 'rehan4221', '$2y$10$tSFTzeIDUSWBy4VcSaFoCOh.Zzq.ibiS7wj.Epo4O7SyHePHj1M8u', 'siddique.abu421@gmail.com', '2017-12-13 08:09:02'),
(3, 'sid421', '$2y$10$C4CQQ6fJCUGwKVQRPT2yb.YU2vtshCQXvrSWYAM4tx2GRqTfE6f36', 'siddique.abu42@gmail.com', '2017-10-30 06:57:50'),
(18, 'testing', '$2y$10$UB0yUBO4sWeJOY4PKInBsedNdjntAUMGsew62C8ebIW/YASE5glO6', 'test@test.com', '2017-12-27 14:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

CREATE TABLE `vitals` (
  `vit_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `height` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `bp` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vitals`
--

INSERT INTO `vitals` (`vit_id`, `reg_id`, `height`, `weight`, `bp`, `created_at`) VALUES
(1, 41, '', '78.5', '120/70', '2018-01-16 15:46:16'),
(2, 43, '', '78', '130/90', '2018-01-17 06:42:30'),
(3, 45, '5\'7"', '98', '130/90', '2018-01-17 06:56:51'),
(4, 45, '5\'7"', '98', '130/90', '2018-01-17 06:56:53'),
(5, 45, '5\'7"', '98', '130/90', '2018-01-17 06:56:54'),
(6, 45, '', '', '', '2018-01-17 06:56:54'),
(7, 45, '', '', '', '2018-01-17 06:56:54'),
(8, 45, '5\'7"', '98', '130/90', '2018-01-17 06:56:55'),
(9, 39, '5\'2"', '20', '56.5', '2018-01-17 06:57:15'),
(10, 47, '6\'0"', '54', '120/70', '2018-01-19 08:57:41'),
(11, 48, '7\'4"', '102', '111/30', '2018-01-22 11:19:02'),
(12, 50, '5\'6"', '73', '110/30', '2018-01-25 09:48:41'),
(13, 50, '6\'0"', '77', '120/70', '2018-01-25 09:55:33'),
(14, 54, '6\'0"', '59', '110/30', '2018-01-31 16:28:22'),
(15, 54, '', '', '', '2018-01-31 16:29:00'),
(16, 54, '', '', '', '2018-01-31 16:30:03'),
(17, 54, '', '', '', '2018-01-31 16:30:26'),
(18, 54, '6\'0"', '59', '110/30', '2018-01-31 16:30:47'),
(19, 55, '5\'6"', '78', '110/30', '2018-02-04 14:24:11'),
(20, 56, '5\'6"', '26', '120/70', '2018-02-05 10:43:11'),
(21, 63, '', '', '', '2018-02-13 17:16:06'),
(25, 68, '6\'11""', '450 lbs', '110/90 mg', '2018-02-13 17:58:42'),
(26, 1, '', '', '', '2018-03-17 16:53:55'),
(27, 63, '6\'00"', '170 lb', '110/90 mg', '2018-03-18 17:13:05'),
(28, 86, '6\'0"', '78', '120/70', '2018-06-05 08:00:08'),
(29, 90, '6\'0"', '78', '120/70', '2018-06-07 14:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `ward_id` int(11) NOT NULL,
  `ward_name` varchar(100) NOT NULL,
  `block_id` int(11) NOT NULL,
  `floor_num` int(11) NOT NULL,
  `ward_incharge` int(11) NOT NULL,
  `installed_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`ward_id`, `ward_name`, `block_id`, `floor_num`, `ward_incharge`, `installed_date`) VALUES
(1, 'Meternity', 2, 2, 0, '2017-12-02 07:50:35'),
(2, 'Meternity', 2, 2, 0, '2017-12-02 07:53:45'),
(3, 'Patient', 4, 1, 4, '2017-12-02 07:54:19'),
(4, 'Admission', 2, 1, 4, '2017-12-02 08:56:14'),
(5, 'Admission 2', 2, 1, 4, '2017-12-02 08:58:07'),
(6, 'Admission 3', 2, 1, 4, '2017-12-02 08:58:27'),
(7, 'Teja Ward', 3, 2, 6, '2017-12-02 15:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `ward_task`
--

CREATE TABLE `ward_task` (
  `task_id` int(11) NOT NULL,
  `original_task_id` int(11) DEFAULT NULL,
  `reg_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `task_description` varchar(200) NOT NULL,
  `task_type` int(11) NOT NULL,
  `total_days` int(11) NOT NULL,
  `done_days` int(11) NOT NULL,
  `at_date` varchar(50) DEFAULT NULL,
  `time` varchar(50) NOT NULL,
  `scheduled_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL COMMENT '0-> Open, 1->Scheduled,2->Completed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_task`
--

INSERT INTO `ward_task` (`task_id`, `original_task_id`, `reg_id`, `ward_id`, `task_description`, `task_type`, `total_days`, `done_days`, `at_date`, `time`, `scheduled_at`, `status`) VALUES
(1, NULL, 31, 3, 'Describing the task', 1, 2, 0, '', '2:29 ', '2018-03-31 21:33:51', 1),
(2, NULL, 31, 3, 'Describing the task2', 1, 2, 0, '', '11:10 PM', '2018-03-31 21:33:58', 1),
(3, NULL, 31, 3, 'Describing the task3', 2, 0, 0, '2018-04-03', '2:29 AM', '2018-03-31 21:34:19', 1),
(4, NULL, 27, 3, 'testing', 1, 10, 0, '', '4:00', '2018-04-01 10:20:26', 1),
(7, NULL, 12, 3, 'testing instant task creation', 2, 0, 0, '2018-04-02', '1:10 PM', '2018-04-02 07:29:50', 1),
(8, NULL, 31, 3, 'Instant task Creation', 1, 5, 0, '', '2:00 ', '2018-04-02 07:30:40', 1),
(9, NULL, 12, 3, 'Instant create now', 2, 0, 0, '2018-04-02', '1:05 PM', '2018-04-02 07:34:00', 1),
(10, NULL, 27, 3, 'test the test itself', 2, 0, 0, '2018-04-02', '1:10 PM', '2018-04-02 07:35:08', 1),
(11, NULL, 12, 3, 'Change drips', 1, 5, 0, '', '1:00 ', '2018-04-02 15:39:30', 1),
(12, NULL, 1, 3, 'testing', 1, 2, 0, '', '1:00 ', '2018-04-11 08:52:18', 1),
(13, NULL, 1, 3, 'give injection', 1, 2, 0, '', '2:00 AM', '2018-06-07 15:11:53', 1),
(14, NULL, 1, 3, 'give injection', 1, 2, 0, '', '2:00 AM', '2018-06-07 15:12:03', 1),
(15, NULL, 1, 3, 'give injection', 1, 2, 0, '', '2:00 AM', '2018-06-07 15:12:04', 1),
(16, NULL, 1, 3, 'give injection', 1, 2, 0, '', '2:00 AM', '2018-06-07 15:12:04', 1),
(17, NULL, 1, 3, 'give injection', 1, 2, 0, '', '2:00 AM', '2018-06-07 15:12:04', 1),
(18, NULL, 1, 3, 'give injection', 1, 2, 0, '', '2:00 AM', '2018-06-07 15:12:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ward_task_log`
--

CREATE TABLE `ward_task_log` (
  `task_id` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `task_desc` text NOT NULL,
  `on_date` varchar(50) NOT NULL,
  `on_time` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `result` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward_task_log`
--

INSERT INTO `ward_task_log` (`task_id`, `ward_id`, `task_desc`, `on_date`, `on_time`, `parent_id`, `parent_type`, `status`, `result`) VALUES
(266, 3, 'Describing the task2', '2018-04-01', '23:10:00', 2, 'wardTask', 1, NULL),
(267, 3, 'Describing the task2', '2018-04-02', '23:10:00', 2, 'wardTask', 1, NULL),
(268, 3, 'Describing the task', '2018-04-02', '01:07:10', 1, 'wardTask', 1, NULL),
(269, 3, 'Describing the task', '2018-04-02', '03:36:10', 1, 'wardTask', 1, NULL),
(270, 3, 'Describing the task', '2018-04-02', '06:05:10', 1, 'wardTask', 1, NULL),
(271, 3, 'Describing the task', '2018-04-02', '08:34:10', 1, 'wardTask', 1, NULL),
(272, 3, 'Describing the task', '2018-04-02', '11:03:10', 1, 'wardTask', 1, NULL),
(273, 3, 'Describing the task', '2018-04-02', '13:32:10', 1, 'wardTask', 7, 'Failing for no reason'),
(274, 3, 'Describing the task', '2018-04-02', '16:01:10', 1, 'wardTask', 7, 'Failing for no reason'),
(275, 3, 'Describing the task', '2018-04-02', '18:30:10', 1, 'wardTask', 7, 'Failing for no reason'),
(276, 3, 'Describing the task', '2018-04-02', '20:59:10', 1, 'wardTask', 7, 'Failing for no reason'),
(277, 3, 'Describing the task', '2018-04-02', '23:28:10', 1, 'wardTask', 7, 'Failing for no reason'),
(278, 3, 'Describing the task', '2018-04-03', '01:57:10', 1, 'wardTask', 7, 'Failing for no reason'),
(279, 3, 'Describing the task', '2018-04-03', '04:26:10', 1, 'wardTask', 7, 'Failing for no reason'),
(280, 3, 'Describing the task', '2018-04-03', '06:55:10', 1, 'wardTask', 7, 'Failing for no reason'),
(281, 3, 'Describing the task', '2018-04-03', '09:24:10', 1, 'wardTask', 7, 'Failing for no reason'),
(282, 3, 'Describing the task', '2018-04-03', '11:53:10', 1, 'wardTask', 7, 'Failing for no reason'),
(283, 3, 'Describing the task', '2018-04-03', '14:22:10', 1, 'wardTask', 7, 'Failing for no reason'),
(284, 3, 'Describing the task', '2018-04-03', '16:51:10', 1, 'wardTask', 7, 'Failing for no reason'),
(285, 3, 'Describing the task', '2018-04-03', '19:20:10', 1, 'wardTask', 7, 'Failing for no reason'),
(286, 3, 'Describing the task', '2018-04-03', '21:49:10', 1, 'wardTask', 7, 'Failing for no reason'),
(287, 3, 'Describing the task', '2018-04-04', '00:18:10', 1, 'wardTask', 7, 'Failing for no reason'),
(288, 3, 'Describing the task3', '2018-04-03', '02:29:00', 3, 'wardTask', 7, ''),
(289, 3, 'testing', '2018-04-02', '02:38:10', 4, 'wardTask', 1, NULL),
(290, 3, 'testing', '2018-04-02', '06:38:10', 4, 'wardTask', 1, NULL),
(291, 3, 'testing', '2018-04-02', '10:38:10', 4, 'wardTask', 1, NULL),
(292, 3, 'testing', '2018-04-02', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(293, 3, 'testing', '2018-04-02', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(294, 3, 'testing', '2018-04-02', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(295, 3, 'testing', '2018-04-03', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(296, 3, 'testing', '2018-04-03', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(297, 3, 'testing', '2018-04-03', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(298, 3, 'testing', '2018-04-03', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(299, 3, 'testing', '2018-04-03', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(300, 3, 'testing', '2018-04-03', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(301, 3, 'testing', '2018-04-04', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(302, 3, 'testing', '2018-04-04', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(303, 3, 'testing', '2018-04-04', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(304, 3, 'testing', '2018-04-04', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(305, 3, 'testing', '2018-04-04', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(306, 3, 'testing', '2018-04-04', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(307, 3, 'testing', '2018-04-05', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(308, 3, 'testing', '2018-04-05', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(309, 3, 'testing', '2018-04-05', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(310, 3, 'testing', '2018-04-05', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(311, 3, 'testing', '2018-04-05', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(312, 3, 'testing', '2018-04-05', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(313, 3, 'testing', '2018-04-06', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(314, 3, 'testing', '2018-04-06', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(315, 3, 'testing', '2018-04-06', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(316, 3, 'testing', '2018-04-06', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(317, 3, 'testing', '2018-04-06', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(318, 3, 'testing', '2018-04-06', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(319, 3, 'testing', '2018-04-07', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(320, 3, 'testing', '2018-04-07', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(321, 3, 'testing', '2018-04-07', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(322, 3, 'testing', '2018-04-07', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(323, 3, 'testing', '2018-04-07', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(324, 3, 'testing', '2018-04-07', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(325, 3, 'testing', '2018-04-08', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(326, 3, 'testing', '2018-04-08', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(327, 3, 'testing', '2018-04-08', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(328, 3, 'testing', '2018-04-08', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(329, 3, 'testing', '2018-04-08', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(330, 3, 'testing', '2018-04-08', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(331, 3, 'testing', '2018-04-09', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(332, 3, 'testing', '2018-04-09', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(333, 3, 'testing', '2018-04-09', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(334, 3, 'testing', '2018-04-09', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(335, 3, 'testing', '2018-04-09', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(336, 3, 'testing', '2018-04-09', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(337, 3, 'testing', '2018-04-10', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(338, 3, 'testing', '2018-04-10', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(339, 3, 'testing', '2018-04-10', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(340, 3, 'testing', '2018-04-10', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(341, 3, 'testing', '2018-04-10', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(342, 3, 'testing', '2018-04-10', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(343, 3, 'testing', '2018-04-11', '02:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(344, 3, 'testing', '2018-04-11', '06:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(345, 3, 'testing', '2018-04-11', '10:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(346, 3, 'testing', '2018-04-11', '14:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(347, 3, 'testing', '2018-04-11', '18:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(348, 3, 'testing', '2018-04-11', '22:38:10', 4, 'wardTask', 7, 'Failing for no reason'),
(349, 3, 'testing instant task creation', '2018-04-02', '13:10:00', 7, 'wardTask', 7, 'Failing for no reason'),
(350, 3, 'Instant task Creation', '2018-04-02', '15:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(351, 3, 'Instant task Creation', '2018-04-02', '17:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(352, 3, 'Instant task Creation', '2018-04-02', '19:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(353, 3, 'Instant task Creation', '2018-04-02', '21:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(354, 3, 'Instant task Creation', '2018-04-02', '23:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(355, 3, 'Instant task Creation', '2018-04-03', '01:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(356, 3, 'Instant task Creation', '2018-04-03', '03:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(357, 3, 'Instant task Creation', '2018-04-03', '05:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(358, 3, 'Instant task Creation', '2018-04-03', '07:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(359, 3, 'Instant task Creation', '2018-04-03', '09:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(360, 3, 'Instant task Creation', '2018-04-03', '11:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(361, 3, 'Instant task Creation', '2018-04-03', '13:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(362, 3, 'Instant task Creation', '2018-04-03', '15:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(363, 3, 'Instant task Creation', '2018-04-03', '17:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(364, 3, 'Instant task Creation', '2018-04-03', '19:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(365, 3, 'Instant task Creation', '2018-04-03', '21:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(366, 3, 'Instant task Creation', '2018-04-03', '23:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(367, 3, 'Instant task Creation', '2018-04-04', '01:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(368, 3, 'Instant task Creation', '2018-04-04', '03:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(369, 3, 'Instant task Creation', '2018-04-04', '05:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(370, 3, 'Instant task Creation', '2018-04-04', '07:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(371, 3, 'Instant task Creation', '2018-04-04', '09:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(372, 3, 'Instant task Creation', '2018-04-04', '11:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(373, 3, 'Instant task Creation', '2018-04-04', '13:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(374, 3, 'Instant task Creation', '2018-04-04', '15:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(375, 3, 'Instant task Creation', '2018-04-04', '17:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(376, 3, 'Instant task Creation', '2018-04-04', '19:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(377, 3, 'Instant task Creation', '2018-04-04', '21:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(378, 3, 'Instant task Creation', '2018-04-04', '23:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(379, 3, 'Instant task Creation', '2018-04-05', '01:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(380, 3, 'Instant task Creation', '2018-04-05', '03:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(381, 3, 'Instant task Creation', '2018-04-05', '05:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(382, 3, 'Instant task Creation', '2018-04-05', '07:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(383, 3, 'Instant task Creation', '2018-04-05', '09:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(384, 3, 'Instant task Creation', '2018-04-05', '11:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(385, 3, 'Instant task Creation', '2018-04-05', '13:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(386, 3, 'Instant task Creation', '2018-04-05', '15:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(387, 3, 'Instant task Creation', '2018-04-05', '17:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(388, 3, 'Instant task Creation', '2018-04-05', '19:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(389, 3, 'Instant task Creation', '2018-04-05', '21:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(390, 3, 'Instant task Creation', '2018-04-05', '23:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(391, 3, 'Instant task Creation', '2018-04-06', '01:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(392, 3, 'Instant task Creation', '2018-04-06', '03:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(393, 3, 'Instant task Creation', '2018-04-06', '05:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(394, 3, 'Instant task Creation', '2018-04-06', '07:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(395, 3, 'Instant task Creation', '2018-04-06', '09:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(396, 3, 'Instant task Creation', '2018-04-06', '11:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(397, 3, 'Instant task Creation', '2018-04-06', '13:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(398, 3, 'Instant task Creation', '2018-04-06', '15:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(399, 3, 'Instant task Creation', '2018-04-06', '17:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(400, 3, 'Instant task Creation', '2018-04-06', '19:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(401, 3, 'Instant task Creation', '2018-04-06', '21:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(402, 3, 'Instant task Creation', '2018-04-06', '23:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(403, 3, 'Instant task Creation', '2018-04-07', '01:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(404, 3, 'Instant task Creation', '2018-04-07', '03:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(405, 3, 'Instant task Creation', '2018-04-07', '05:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(406, 3, 'Instant task Creation', '2018-04-07', '07:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(407, 3, 'Instant task Creation', '2018-04-07', '09:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(408, 3, 'Instant task Creation', '2018-04-07', '11:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(409, 3, 'Instant task Creation', '2018-04-07', '13:00:40', 8, 'wardTask', 7, 'Failing for no reason'),
(410, 3, 'Instant create now', '2018-04-02', '13:05:00', 9, 'wardTask', 1, NULL),
(411, 3, 'test the test itself', '2018-04-02', '13:10:00', 10, 'wardTask', 7, 'Failing for no reason'),
(412, 3, 'Change drips', '2018-04-02', '21:20:30', 11, 'wardTask', 1, NULL),
(413, 3, 'Change drips', '2018-04-02', '21:13:30', 11, 'wardTask', 1, NULL),
(414, 3, 'Change drips', '2018-04-03', '00:09:30', 11, 'wardTask', 7, ''),
(415, 3, 'Change drips', '2018-04-03', '01:09:30', 11, 'wardTask', 7, ''),
(416, 3, 'Change drips', '2018-04-03', '02:09:30', 11, 'wardTask', 7, ''),
(417, 3, 'Change drips', '2018-04-03', '03:09:30', 11, 'wardTask', 7, ''),
(418, 3, 'Change drips', '2018-04-03', '04:09:30', 11, 'wardTask', 7, ''),
(419, 3, 'Change drips', '2018-04-03', '05:09:30', 11, 'wardTask', 7, ''),
(420, 3, 'Change drips', '2018-04-03', '06:09:30', 11, 'wardTask', 7, ''),
(421, 3, 'Change drips', '2018-04-03', '07:09:30', 11, 'wardTask', 7, ''),
(422, 3, 'Change drips', '2018-04-03', '08:09:30', 11, 'wardTask', 7, ''),
(423, 3, 'Change drips', '2018-04-03', '09:09:30', 11, 'wardTask', 7, ''),
(424, 3, 'Change drips', '2018-04-03', '10:09:30', 11, 'wardTask', 7, ''),
(425, 3, 'Change drips', '2018-04-03', '11:09:30', 11, 'wardTask', 7, ''),
(426, 3, 'Change drips', '2018-04-03', '12:09:30', 11, 'wardTask', 7, ''),
(427, 3, 'Change drips', '2018-04-03', '13:09:30', 11, 'wardTask', 7, ''),
(428, 3, 'Change drips', '2018-04-03', '14:09:30', 11, 'wardTask', 7, ''),
(429, 3, 'Change drips', '2018-04-03', '15:09:30', 11, 'wardTask', 7, ''),
(430, 3, 'Change drips', '2018-04-03', '16:09:30', 11, 'wardTask', 7, ''),
(431, 3, 'Change drips', '2018-04-03', '17:09:30', 11, 'wardTask', 7, ''),
(432, 3, 'Change drips', '2018-04-03', '18:09:30', 11, 'wardTask', 7, ''),
(433, 3, 'Change drips', '2018-04-03', '19:09:30', 11, 'wardTask', 7, ''),
(434, 3, 'Change drips', '2018-04-03', '20:09:30', 11, 'wardTask', 7, ''),
(435, 3, 'Change drips', '2018-04-03', '21:09:30', 11, 'wardTask', 7, ''),
(436, 3, 'Change drips', '2018-04-03', '22:09:30', 11, 'wardTask', 7, ''),
(437, 3, 'Change drips', '2018-04-03', '23:09:30', 11, 'wardTask', 7, ''),
(438, 3, 'Change drips', '2018-04-04', '00:09:30', 11, 'wardTask', 7, ''),
(439, 3, 'Change drips', '2018-04-04', '01:09:30', 11, 'wardTask', 7, ''),
(440, 3, 'Change drips', '2018-04-04', '02:09:30', 11, 'wardTask', 7, ''),
(441, 3, 'Change drips', '2018-04-04', '03:09:30', 11, 'wardTask', 7, ''),
(442, 3, 'Change drips', '2018-04-04', '04:09:30', 11, 'wardTask', 7, ''),
(443, 3, 'Change drips', '2018-04-04', '05:09:30', 11, 'wardTask', 7, ''),
(444, 3, 'Change drips', '2018-04-04', '06:09:30', 11, 'wardTask', 7, ''),
(445, 3, 'Change drips', '2018-04-04', '07:09:30', 11, 'wardTask', 7, ''),
(446, 3, 'Change drips', '2018-04-04', '08:09:30', 11, 'wardTask', 7, ''),
(447, 3, 'Change drips', '2018-04-04', '09:09:30', 11, 'wardTask', 7, ''),
(448, 3, 'Change drips', '2018-04-04', '10:09:30', 11, 'wardTask', 7, ''),
(449, 3, 'Change drips', '2018-04-04', '11:09:30', 11, 'wardTask', 7, ''),
(450, 3, 'Change drips', '2018-04-04', '12:09:30', 11, 'wardTask', 7, ''),
(451, 3, 'Change drips', '2018-04-04', '13:09:30', 11, 'wardTask', 7, ''),
(452, 3, 'Change drips', '2018-04-04', '14:09:30', 11, 'wardTask', 7, ''),
(453, 3, 'Change drips', '2018-04-04', '15:09:30', 11, 'wardTask', 7, ''),
(454, 3, 'Change drips', '2018-04-04', '16:09:30', 11, 'wardTask', 7, ''),
(455, 3, 'Change drips', '2018-04-04', '17:09:30', 11, 'wardTask', 7, ''),
(456, 3, 'Change drips', '2018-04-04', '18:09:30', 11, 'wardTask', 7, ''),
(457, 3, 'Change drips', '2018-04-04', '19:09:30', 11, 'wardTask', 7, ''),
(458, 3, 'Change drips', '2018-04-04', '20:09:30', 11, 'wardTask', 7, ''),
(459, 3, 'Change drips', '2018-04-04', '21:09:30', 11, 'wardTask', 7, ''),
(460, 3, 'Change drips', '2018-04-04', '22:09:30', 11, 'wardTask', 7, ''),
(461, 3, 'Change drips', '2018-04-04', '23:09:30', 11, 'wardTask', 7, ''),
(462, 3, 'Change drips', '2018-04-05', '00:09:30', 11, 'wardTask', 7, ''),
(463, 3, 'Change drips', '2018-04-05', '01:09:30', 11, 'wardTask', 7, ''),
(464, 3, 'Change drips', '2018-04-05', '02:09:30', 11, 'wardTask', 7, ''),
(465, 3, 'Change drips', '2018-04-05', '03:09:30', 11, 'wardTask', 7, ''),
(466, 3, 'Change drips', '2018-04-05', '04:09:30', 11, 'wardTask', 7, ''),
(467, 3, 'Change drips', '2018-04-05', '05:09:30', 11, 'wardTask', 7, ''),
(468, 3, 'Change drips', '2018-04-05', '06:09:30', 11, 'wardTask', 7, ''),
(469, 3, 'Change drips', '2018-04-05', '07:09:30', 11, 'wardTask', 7, ''),
(470, 3, 'Change drips', '2018-04-05', '08:09:30', 11, 'wardTask', 7, ''),
(471, 3, 'Change drips', '2018-04-05', '09:09:30', 11, 'wardTask', 7, ''),
(472, 3, 'Change drips', '2018-04-05', '10:09:30', 11, 'wardTask', 7, ''),
(473, 3, 'Change drips', '2018-04-05', '11:09:30', 11, 'wardTask', 7, ''),
(474, 3, 'Change drips', '2018-04-05', '12:09:30', 11, 'wardTask', 7, ''),
(475, 3, 'Change drips', '2018-04-05', '13:09:30', 11, 'wardTask', 7, ''),
(476, 3, 'Change drips', '2018-04-05', '14:09:30', 11, 'wardTask', 7, ''),
(477, 3, 'Change drips', '2018-04-05', '15:09:30', 11, 'wardTask', 7, ''),
(478, 3, 'Change drips', '2018-04-05', '16:09:30', 11, 'wardTask', 7, ''),
(479, 3, 'Change drips', '2018-04-05', '17:09:30', 11, 'wardTask', 7, ''),
(480, 3, 'Change drips', '2018-04-05', '18:09:30', 11, 'wardTask', 7, ''),
(481, 3, 'Change drips', '2018-04-05', '19:09:30', 11, 'wardTask', 7, ''),
(482, 3, 'Change drips', '2018-04-05', '20:09:30', 11, 'wardTask', 7, ''),
(483, 3, 'Change drips', '2018-04-05', '21:09:30', 11, 'wardTask', 7, ''),
(484, 3, 'Change drips', '2018-04-05', '22:09:30', 11, 'wardTask', 7, ''),
(485, 3, 'Change drips', '2018-04-05', '23:09:30', 11, 'wardTask', 7, ''),
(486, 3, 'Change drips', '2018-04-06', '00:09:30', 11, 'wardTask', 7, ''),
(487, 3, 'Change drips', '2018-04-06', '01:09:30', 11, 'wardTask', 7, ''),
(488, 3, 'Change drips', '2018-04-06', '02:09:30', 11, 'wardTask', 7, ''),
(489, 3, 'Change drips', '2018-04-06', '03:09:30', 11, 'wardTask', 7, ''),
(490, 3, 'Change drips', '2018-04-06', '04:09:30', 11, 'wardTask', 7, ''),
(491, 3, 'Change drips', '2018-04-06', '05:09:30', 11, 'wardTask', 7, ''),
(492, 3, 'Change drips', '2018-04-06', '06:09:30', 11, 'wardTask', 7, ''),
(493, 3, 'Change drips', '2018-04-06', '07:09:30', 11, 'wardTask', 7, ''),
(494, 3, 'Change drips', '2018-04-06', '08:09:30', 11, 'wardTask', 7, ''),
(495, 3, 'Change drips', '2018-04-06', '09:09:30', 11, 'wardTask', 7, ''),
(496, 3, 'Change drips', '2018-04-06', '10:09:30', 11, 'wardTask', 7, ''),
(497, 3, 'Change drips', '2018-04-06', '11:09:30', 11, 'wardTask', 7, ''),
(498, 3, 'Change drips', '2018-04-06', '12:09:30', 11, 'wardTask', 7, ''),
(499, 3, 'Change drips', '2018-04-06', '13:09:30', 11, 'wardTask', 7, ''),
(500, 3, 'Change drips', '2018-04-06', '14:09:30', 11, 'wardTask', 7, ''),
(501, 3, 'Change drips', '2018-04-06', '15:09:30', 11, 'wardTask', 7, ''),
(502, 3, 'Change drips', '2018-04-06', '16:09:30', 11, 'wardTask', 7, ''),
(503, 3, 'Change drips', '2018-04-06', '17:09:30', 11, 'wardTask', 7, ''),
(504, 3, 'Change drips', '2018-04-06', '18:09:30', 11, 'wardTask', 7, ''),
(505, 3, 'Change drips', '2018-04-06', '19:09:30', 11, 'wardTask', 7, ''),
(506, 3, 'Change drips', '2018-04-06', '20:09:30', 11, 'wardTask', 7, ''),
(507, 3, 'Change drips', '2018-04-06', '21:09:30', 11, 'wardTask', 7, ''),
(508, 3, 'Change drips', '2018-04-06', '22:09:30', 11, 'wardTask', 7, ''),
(509, 3, 'Change drips', '2018-04-06', '23:09:30', 11, 'wardTask', 7, ''),
(510, 3, 'Change drips', '2018-04-07', '00:09:30', 11, 'wardTask', 7, ''),
(511, 3, 'Change drips', '2018-04-07', '01:09:30', 11, 'wardTask', 7, ''),
(512, 3, 'Change drips', '2018-04-07', '02:09:30', 11, 'wardTask', 7, ''),
(513, 3, 'Change drips', '2018-04-07', '03:09:30', 11, 'wardTask', 7, ''),
(514, 3, 'Change drips', '2018-04-07', '04:09:30', 11, 'wardTask', 7, ''),
(515, 3, 'Change drips', '2018-04-07', '05:09:30', 11, 'wardTask', 7, ''),
(516, 3, 'Change drips', '2018-04-07', '06:09:30', 11, 'wardTask', 7, ''),
(517, 3, 'Change drips', '2018-04-07', '07:09:30', 11, 'wardTask', 7, ''),
(518, 3, 'Change drips', '2018-04-07', '08:09:30', 11, 'wardTask', 7, ''),
(519, 3, 'Change drips', '2018-04-07', '09:09:30', 11, 'wardTask', 7, ''),
(520, 3, 'Change drips', '2018-04-07', '10:09:30', 11, 'wardTask', 7, ''),
(521, 3, 'Change drips', '2018-04-07', '11:09:30', 11, 'wardTask', 7, ''),
(522, 3, 'Change drips', '2018-04-07', '12:09:30', 11, 'wardTask', 7, ''),
(523, 3, 'Change drips', '2018-04-07', '13:09:30', 11, 'wardTask', 7, ''),
(524, 3, 'Change drips', '2018-04-07', '14:09:30', 11, 'wardTask', 7, ''),
(525, 3, 'Change drips', '2018-04-07', '15:09:30', 11, 'wardTask', 7, ''),
(526, 3, 'Change drips', '2018-04-07', '16:09:30', 11, 'wardTask', 7, ''),
(527, 3, 'Change drips', '2018-04-07', '17:09:30', 11, 'wardTask', 7, ''),
(528, 3, 'Change drips', '2018-04-07', '18:09:30', 11, 'wardTask', 7, ''),
(529, 3, 'Change drips', '2018-04-07', '19:09:30', 11, 'wardTask', 7, ''),
(530, 3, 'Change drips', '2018-04-07', '20:09:30', 11, 'wardTask', 7, ''),
(531, 3, 'Change drips', '2018-04-07', '21:09:30', 11, 'wardTask', 7, ''),
(532, 3, 'testing', '2018-04-11', '15:22:18', 12, 'wardTask', 1, NULL),
(533, 3, 'testing', '2018-04-11', '16:22:18', 12, 'wardTask', 1, NULL),
(534, 3, 'testing', '2018-04-11', '17:22:18', 12, 'wardTask', 7, 'cancel'),
(535, 3, 'testing', '2018-04-11', '18:22:18', 12, 'wardTask', 1, NULL),
(536, 3, 'testing', '2018-04-11', '19:22:18', 12, 'wardTask', 1, NULL),
(537, 3, 'testing', '2018-04-11', '20:22:18', 12, 'wardTask', 7, 'cancel'),
(538, 3, 'testing', '2018-04-11', '21:22:18', 12, 'wardTask', 7, 'cancel'),
(539, 3, 'testing', '2018-04-11', '22:22:18', 12, 'wardTask', 7, 'cancel'),
(540, 3, 'testing', '2018-04-11', '23:22:18', 12, 'wardTask', 7, 'cancel'),
(541, 3, 'testing', '2018-04-12', '00:22:18', 12, 'wardTask', 7, 'cancel'),
(542, 3, 'testing', '2018-04-12', '01:22:18', 12, 'wardTask', 7, 'cancel'),
(543, 3, 'testing', '2018-04-12', '02:22:18', 12, 'wardTask', 7, 'cancel'),
(544, 3, 'testing', '2018-04-12', '03:22:18', 12, 'wardTask', 7, 'cancel'),
(545, 3, 'testing', '2018-04-12', '04:22:18', 12, 'wardTask', 7, 'cancel'),
(546, 3, 'testing', '2018-04-12', '05:22:18', 12, 'wardTask', 7, 'cancel'),
(547, 3, 'testing', '2018-04-12', '06:22:18', 12, 'wardTask', 7, 'cancel'),
(548, 3, 'testing', '2018-04-12', '07:22:18', 12, 'wardTask', 7, 'cancel'),
(549, 3, 'testing', '2018-04-12', '08:22:18', 12, 'wardTask', 7, 'cancel'),
(550, 3, 'testing', '2018-04-12', '09:22:18', 12, 'wardTask', 7, 'cancel'),
(551, 3, 'testing', '2018-04-12', '10:22:18', 12, 'wardTask', 7, 'cancel'),
(552, 3, 'testing', '2018-04-12', '11:22:18', 12, 'wardTask', 7, 'cancel'),
(553, 3, 'testing', '2018-04-12', '12:22:18', 12, 'wardTask', 7, 'cancel'),
(554, 3, 'testing', '2018-04-12', '13:22:18', 12, 'wardTask', 7, 'cancel'),
(555, 3, 'testing', '2018-04-12', '14:22:18', 12, 'wardTask', 7, 'cancel'),
(556, 3, 'testing', '2018-04-12', '15:22:18', 12, 'wardTask', 7, 'cancel'),
(557, 3, 'testing', '2018-04-12', '16:22:18', 12, 'wardTask', 7, 'cancel'),
(558, 3, 'testing', '2018-04-12', '17:22:18', 12, 'wardTask', 7, 'cancel'),
(559, 3, 'testing', '2018-04-12', '18:22:18', 12, 'wardTask', 7, 'cancel'),
(560, 3, 'testing', '2018-04-12', '19:22:18', 12, 'wardTask', 7, 'cancel'),
(561, 3, 'testing', '2018-04-12', '20:22:18', 12, 'wardTask', 7, 'cancel'),
(562, 3, 'testing', '2018-04-12', '21:22:18', 12, 'wardTask', 7, 'cancel'),
(563, 3, 'testing', '2018-04-12', '22:22:18', 12, 'wardTask', 7, 'cancel'),
(564, 3, 'testing', '2018-04-12', '23:22:18', 12, 'wardTask', 7, 'cancel'),
(565, 3, 'testing', '2018-04-13', '00:22:18', 12, 'wardTask', 7, 'cancel'),
(566, 3, 'testing', '2018-04-13', '01:22:18', 12, 'wardTask', 7, 'cancel'),
(567, 3, 'testing', '2018-04-13', '02:22:18', 12, 'wardTask', 7, 'cancel'),
(568, 3, 'testing', '2018-04-13', '03:22:18', 12, 'wardTask', 7, 'cancel'),
(569, 3, 'testing', '2018-04-13', '04:22:18', 12, 'wardTask', 7, 'cancel'),
(570, 3, 'testing', '2018-04-13', '05:22:18', 12, 'wardTask', 7, 'cancel'),
(571, 3, 'testing', '2018-04-13', '06:22:18', 12, 'wardTask', 7, 'cancel'),
(572, 3, 'testing', '2018-04-13', '07:22:18', 12, 'wardTask', 7, 'cancel'),
(573, 3, 'testing', '2018-04-13', '08:22:18', 12, 'wardTask', 7, 'cancel'),
(574, 3, 'testing', '2018-04-13', '09:22:18', 12, 'wardTask', 7, 'cancel'),
(575, 3, 'testing', '2018-04-13', '10:22:18', 12, 'wardTask', 7, 'cancel'),
(576, 3, 'testing', '2018-04-13', '11:22:18', 12, 'wardTask', 7, 'cancel'),
(577, 3, 'testing', '2018-04-13', '12:22:18', 12, 'wardTask', 7, 'cancel'),
(578, 3, 'testing', '2018-04-13', '13:22:18', 12, 'wardTask', 7, 'cancel'),
(579, 3, 'testing', '2018-04-13', '14:22:18', 12, 'wardTask', 7, 'cancel'),
(580, 3, 'give injection', '2018-06-08', '02:00:00', 13, 'wardTask', 0, NULL),
(581, 3, 'give injection', '2018-06-09', '02:00:00', 13, 'wardTask', 0, NULL),
(582, 3, 'give injection', '2018-06-08', '02:00:00', 14, 'wardTask', 0, NULL),
(583, 3, 'give injection', '2018-06-09', '02:00:00', 14, 'wardTask', 0, NULL),
(584, 3, 'give injection', '2018-06-08', '02:00:00', 15, 'wardTask', 0, NULL),
(585, 3, 'give injection', '2018-06-09', '02:00:00', 15, 'wardTask', 0, NULL),
(586, 3, 'give injection', '2018-06-08', '02:00:00', 16, 'wardTask', 0, NULL),
(587, 3, 'give injection', '2018-06-09', '02:00:00', 16, 'wardTask', 0, NULL),
(588, 3, 'give injection', '2018-06-08', '02:00:00', 17, 'wardTask', 0, NULL),
(589, 3, 'give injection', '2018-06-09', '02:00:00', 17, 'wardTask', 0, NULL),
(590, 3, 'give injection', '2018-06-08', '02:00:00', 18, 'wardTask', 0, NULL),
(591, 3, 'give injection', '2018-06-09', '02:00:00', 18, 'wardTask', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accpted_file_contents`
--
ALTER TABLE `accpted_file_contents`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `addmission`
--
ALTER TABLE `addmission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`block_id`);

--
-- Indexes for table `canteen`
--
ALTER TABLE `canteen`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`charge_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `doc_schedule`
--
ALTER TABLE `doc_schedule`
  ADD PRIMARY KEY (`phy_id`,`date`,`frm_time`),
  ADD UNIQUE KEY `slot_id` (`slot_id`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`eq_code`);

--
-- Indexes for table `hosp_details`
--
ALTER TABLE `hosp_details`
  ADD PRIMARY KEY (`hosp_id`);

--
-- Indexes for table `inp_doc_visits`
--
ALTER TABLE `inp_doc_visits`
  ADD PRIMARY KEY (`visit_id`);

--
-- Indexes for table `lab_procedures`
--
ALTER TABLE `lab_procedures`
  ADD PRIMARY KEY (`procedure_id`);

--
-- Indexes for table `lab_requests`
--
ALTER TABLE `lab_requests`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_used`
--
ALTER TABLE `medicine_used`
  ADD PRIMARY KEY (`log_med_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`name`,`dob`,`phone_number`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `patient_charges`
--
ALTER TABLE `patient_charges`
  ADD PRIMARY KEY (`charge_id`);

--
-- Indexes for table `pharmacy_inventory`
--
ALTER TABLE `pharmacy_inventory`
  ADD PRIMARY KEY (`logged_id`);

--
-- Indexes for table `pharmacy_transaction`
--
ALTER TABLE `pharmacy_transaction`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `med_id` (`med_id`);

--
-- Indexes for table `physician`
--
ALTER TABLE `physician`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_type`,`product_sub_type`,`product_name`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product_request`
--
ALTER TABLE `product_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `requested_by` (`requested_by`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `registration_flow`
--
ALTER TABLE `registration_flow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attented_by` (`attented_by`);

--
-- Indexes for table `role_map`
--
ALTER TABLE `role_map`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_type_map`
--
ALTER TABLE `room_type_map`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `sample_inventory`
--
ALTER TABLE `sample_inventory`
  ADD PRIMARY KEY (`sample_log_id`);

--
-- Indexes for table `sample_log`
--
ALTER TABLE `sample_log`
  ADD PRIMARY KEY (`sample_id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`screen_id`);

--
-- Indexes for table `screen_staff_map`
--
ALTER TABLE `screen_staff_map`
  ADD PRIMARY KEY (`screen_id`,`staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff_type_map`
--
ALTER TABLE `staff_type_map`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `staff_type_screen_map`
--
ALTER TABLE `staff_type_screen_map`
  ADD PRIMARY KEY (`staff_type_id`,`screen_access_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`GST_number`);

--
-- Indexes for table `surgery`
--
ALTER TABLE `surgery`
  ADD PRIMARY KEY (`surg_id`);

--
-- Indexes for table `surgery_log`
--
ALTER TABLE `surgery_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `surg_treat`
--
ALTER TABLE `surg_treat`
  ADD PRIMARY KEY (`treat_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `vitals`
--
ALTER TABLE `vitals`
  ADD PRIMARY KEY (`vit_id`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`ward_id`);

--
-- Indexes for table `ward_task`
--
ALTER TABLE `ward_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `ward_task_log`
--
ALTER TABLE `ward_task_log`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accpted_file_contents`
--
ALTER TABLE `accpted_file_contents`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `addmission`
--
ALTER TABLE `addmission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `canteen`
--
ALTER TABLE `canteen`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `doc_schedule`
--
ALTER TABLE `doc_schedule`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `eq_code` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hosp_details`
--
ALTER TABLE `hosp_details`
  MODIFY `hosp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inp_doc_visits`
--
ALTER TABLE `inp_doc_visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `lab_procedures`
--
ALTER TABLE `lab_procedures`
  MODIFY `procedure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `lab_requests`
--
ALTER TABLE `lab_requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `medicine_used`
--
ALTER TABLE `medicine_used`
  MODIFY `log_med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `patient_charges`
--
ALTER TABLE `patient_charges`
  MODIFY `charge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `pharmacy_inventory`
--
ALTER TABLE `pharmacy_inventory`
  MODIFY `logged_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pharmacy_transaction`
--
ALTER TABLE `pharmacy_transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `physician`
--
ALTER TABLE `physician`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `product_request`
--
ALTER TABLE `product_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `registration_flow`
--
ALTER TABLE `registration_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `role_map`
--
ALTER TABLE `role_map`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `room_type_map`
--
ALTER TABLE `room_type_map`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sample_inventory`
--
ALTER TABLE `sample_inventory`
  MODIFY `sample_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `sample_log`
--
ALTER TABLE `sample_log`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `screen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `staff_type_map`
--
ALTER TABLE `staff_type_map`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `surg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `surgery_log`
--
ALTER TABLE `surgery_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `surg_treat`
--
ALTER TABLE `surg_treat`
  MODIFY `treat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `vitals`
--
ALTER TABLE `vitals`
  MODIFY `vit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `ward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ward_task`
--
ALTER TABLE `ward_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ward_task_log`
--
ALTER TABLE `ward_task_log`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=592;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pharmacy_transaction`
--
ALTER TABLE `pharmacy_transaction`
  ADD CONSTRAINT `pharmacy_transaction_ibfk_1` FOREIGN KEY (`med_id`) REFERENCES `medicines` (`id`);

--
-- Constraints for table `physician`
--
ALTER TABLE `physician`
  ADD CONSTRAINT `physician_ibfk_1` FOREIGN KEY (`id`) REFERENCES `staff` (`staff_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
