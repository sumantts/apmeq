-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 07:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apmeq`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_details`
--

CREATE TABLE `asset_details` (
  `asset_detail_id` int(11) NOT NULL,
  `name_of_asset` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL COMMENT 'PK of department_list',
  `hospital_id` int(11) NOT NULL COMMENT 'PK of hospital_list',
  `asset_code` varchar(10) NOT NULL,
  `manufacturer_id` int(11) NOT NULL COMMENT 'PK of manufacturer_list',
  `model_name` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL COMMENT 'PK of supplier_list',
  `asset_slno` varchar(255) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `installation_date` date NOT NULL,
  `total_year_in_service` int(2) NOT NULL,
  `calibration_last_date` date NOT NULL,
  `calibration_frequency` tinyint(1) NOT NULL,
  `preventive_maintain_last_date` date NOT NULL,
  `preventive_maintenance_frequency` tinyint(1) NOT NULL,
  `warenty` varchar(10) NOT NULL,
  `amc` varchar(10) NOT NULL,
  `amc_last_date` date NOT NULL,
  `cmc` varchar(10) NOT NULL,
  `cmc_last_date` date NOT NULL,
  `service_providers_id` int(11) NOT NULL COMMENT 'PK of service_providers_list',
  `files_attached` text NOT NULL,
  `reallocate_id` int(11) NOT NULL COMMENT 'PK of asset_reallocate',
  `qa_certificate` text NOT NULL,
  `qa_certificate_last_date` date NOT NULL,
  `asset_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_details`
--

INSERT INTO `asset_details` (`asset_detail_id`, `name_of_asset`, `department_id`, `hospital_id`, `asset_code`, `manufacturer_id`, `model_name`, `supplier_id`, `asset_slno`, `equipment_name`, `installation_date`, `total_year_in_service`, `calibration_last_date`, `calibration_frequency`, `preventive_maintain_last_date`, `preventive_maintenance_frequency`, `warenty`, `amc`, `amc_last_date`, `cmc`, `cmc_last_date`, `service_providers_id`, `files_attached`, `reallocate_id`, `qa_certificate`, `qa_certificate_last_date`, `asset_status`) VALUES
(1, '1', 3, 2, '2', 1, '4', 2, '3', '5', '2024-08-16', 6, '2024-08-16', 7, '2024-08-16', 8, '9', '10', '2024-08-16', '11', '2024-08-16', 1, '', 0, '12', '2024-08-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_reallocate`
--

CREATE TABLE `asset_reallocate` (
  `reallocate_id` int(11) NOT NULL,
  `department_from` int(11) NOT NULL,
  `department_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_type_list`
--

CREATE TABLE `asset_type_list` (
  `asset_type_id` int(11) NOT NULL,
  `asset_type_name` varchar(255) NOT NULL,
  `asset_type_code` varchar(255) NOT NULL,
  `asset_type_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_type_list`
--

INSERT INTO `asset_type_list` (`asset_type_id`, `asset_type_name`, `asset_type_code`, `asset_type_status`) VALUES
(1, 'Tangible Assets', 'Tangible_Assets', 1),
(2, 'Nontangible Assets', 'Nontangible_Assets', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `activity_status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`category_id`, `category_name`, `category_slug`, `activity_status`) VALUES
(17, 'Doctor of Theology (D.Th.)', 'doctor_of_theology_(d.th.)', 'active'),
(18, 'DOCTOR OF MINISTRY (D.Min.)', 'doctor_of_ministry_(d.min.)', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_code` varchar(255) NOT NULL,
  `department_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`department_id`, `department_name`, `department_code`, `department_status`) VALUES
(1, 'Information Technology', 'IT', 1),
(3, 'Electrical', 'Electrical', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_list`
--

CREATE TABLE `hospital_list` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `hospital_code` varchar(255) NOT NULL,
  `hospital_address` text NOT NULL,
  `hospital_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_list`
--

INSERT INTO `hospital_list` (`hospital_id`, `hospital_name`, `hospital_code`, `hospital_address`, `hospital_status`) VALUES
(2, 'Bagnan Hospital', 'BAG001', 'P.S - Bagnan ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_list`
--

CREATE TABLE `manufacturer_list` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(255) NOT NULL,
  `manufacturer_code` varchar(255) NOT NULL,
  `primary_contact_number` varchar(10) NOT NULL,
  `secondary_contact_number` varchar(10) NOT NULL,
  `manufacturer_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturer_list`
--

INSERT INTO `manufacturer_list` (`manufacturer_id`, `manufacturer_name`, `manufacturer_code`, `primary_contact_number`, `secondary_contact_number`, `manufacturer_status`) VALUES
(1, 'iBall', 'IBALL', '9874563210', '9852012547', 1),
(2, 'Logitech', 'Logitech', '8521459874', '589632012', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_providers_list`
--

CREATE TABLE `service_providers_list` (
  `service_providers_id` int(11) NOT NULL,
  `service_providers_name` varchar(255) NOT NULL,
  `service_providers_code` varchar(255) NOT NULL,
  `primary_contact_number` varchar(10) NOT NULL,
  `secondary_contact_number` varchar(10) NOT NULL,
  `service_providers_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_providers_list`
--

INSERT INTO `service_providers_list` (`service_providers_id`, `service_providers_name`, `service_providers_code`, `primary_contact_number`, `secondary_contact_number`, `service_providers_status`) VALUES
(1, 'Bablu Expert Services', 'BAB_EXP', '9874563210', '9852012547', 1),
(2, 'Hubba Telecom', 'Hubba_Telecom', '8527414102', '9369025801', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_code` varchar(255) NOT NULL,
  `primary_contact_number` varchar(10) NOT NULL,
  `secondary_contact_number` varchar(10) NOT NULL,
  `supplier_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`supplier_id`, `supplier_name`, `supplier_code`, `primary_contact_number`, `secondary_contact_number`, `supplier_status`) VALUES
(1, 'Viewcom Telecom', 'VCOM', '9874563210', '9852012547', 1),
(2, 'RupanjanDa', 'RupanjanDa', '9856320120', '5852474103', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_type_id` int(11) NOT NULL COMMENT 'PK of user_type',
  `hospital_id` int(11) NOT NULL COMMENT 'PK of hospital_list',
  `user_mobile` varchar(10) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_dob` date NOT NULL,
  `user_address` text NOT NULL,
  `user_user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `user_type_id`, `hospital_id`, `user_mobile`, `user_phone`, `user_email`, `user_dob`, `user_address`, `user_user_name`, `user_password`, `user_status`) VALUES
(1, 'Suman Jana', 3, 2, '9733935161', '256789', 'sumanjana.6@gmail.com', '1987-10-01', 'Bagnan', 'sumanjana.6@gmail.com', '12345678', 1),
(7, 'Mr. Developer', 3, 2, '9874563210', '', 'developer@apmeq.com', '2024-08-13', 'kolkata', 'developer@apmeq.com', '12345678', 1),
(8, 'Mr. Super Admin', 1, 2, '9856320125', '', 'superadmin@apmeq.com', '2024-08-13', 'Kolkata', 'superadmin@apmeq.com', '12345678', 1),
(9, 'Mr. Hospital Admin', 2, 2, '9874521542', '', 'hadmin@apmeq.com', '2024-08-13', 'kolkata', 'hadmin@apmeq.com', '12345678', 1),
(10, 'Mr. Hospital Doctor', 4, 2, '9785421258', '', 'hdoctor@apmeq.com', '2024-08-13', 'kolkata', 'hdoctor@apmeq.com', '12345678', 1),
(11, 'Mr. Hospital Incharge', 5, 2, '9758965230', '', 'hincharge@apmeq.com', '2024-08-13', 'kolkata', 'hincharge@apmeq.com', '12345678', 1),
(12, 'Mr. Hospital Engineer', 6, 2, '9852125487', '', 'hengineer@apmeq.com', '2024-08-13', 'Kolkata', 'hengineer@apmeq.com', '12345678', 1),
(13, 'Mr. AMC', 7, 2, '9632584512', '256789', 'amc@apmeq.com', '2024-08-13', 'kolkata', 'amc@apmeq.com', '12345678', 1),
(14, 'Mr. Local', 8, 2, '9685215478', '', 'local@apmeq.com', '2024-08-13', 'kolkata', 'local@apmeq.com', '12345678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(255) NOT NULL,
  `user_type_code` varchar(255) NOT NULL,
  `user_type_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`, `user_type_code`, `user_type_status`) VALUES
(1, 'Super Admin', 'super', 1),
(2, 'Hospital Admin', 'h_admin', 1),
(3, 'Developer', 'dev', 1),
(4, 'Hospital Doctor', 'h_doc', 1),
(5, 'Hospital Incharge', 'h_inch', 1),
(6, 'Hospital Engineer', 'h_eng', 1),
(7, 'Existing Service provider (amc/warenty)', 'sp_amc', 0),
(8, 'Registered service provider (Local Service Provider)', 'sp_local', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_details`
--
ALTER TABLE `asset_details`
  ADD PRIMARY KEY (`asset_detail_id`);

--
-- Indexes for table `asset_type_list`
--
ALTER TABLE `asset_type_list`
  ADD PRIMARY KEY (`asset_type_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `hospital_list`
--
ALTER TABLE `hospital_list`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `manufacturer_list`
--
ALTER TABLE `manufacturer_list`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `service_providers_list`
--
ALTER TABLE `service_providers_list`
  ADD PRIMARY KEY (`service_providers_id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_details`
--
ALTER TABLE `asset_details`
  MODIFY `asset_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asset_type_list`
--
ALTER TABLE `asset_type_list`
  MODIFY `asset_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospital_list`
--
ALTER TABLE `hospital_list`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacturer_list`
--
ALTER TABLE `manufacturer_list`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_providers_list`
--
ALTER TABLE `service_providers_list`
  MODIFY `service_providers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
