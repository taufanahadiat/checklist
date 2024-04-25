-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 04:14 AM
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
-- Database: `checklistnew_24`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuel_transfer_pump_unit`
--

CREATE TABLE `fuel_transfer_pump_unit` (
  `tanggal` date NOT NULL,
  `operating_pump1_8_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_16_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_0_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_fuel1_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_6` enum('A','TA','RS') DEFAULT NULL,
  `operating_pump2_8_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_16_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_0_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_fuel2_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_transfer_pump_unit`
--

INSERT INTO `fuel_transfer_pump_unit` (`tanggal`, `operating_pump1_8_14`, `operating_pump1_16_22`, `operating_pump1_0_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8_14`, `operating_pump2_16_22`, `operating_pump2_0_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`) VALUES
('2024-04-24', 'OFF', 'OFF', 'ON', 'TA', 'TA', 'A', 'A', 'RS', 'A', 'TA', 'A', 'TA', 'A', 'RS', 'A', 'ON', 'ON', 'ON', 'A', 'A', 'TA', 'A', 'RS', 'A', 'TA', 'A', 'TA', 'A', 'A', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `genset_wartsila_01`
--

CREATE TABLE `genset_wartsila_01` (
  `tanggal` date NOT NULL,
  `nama` varchar(30) NOT NULL,
  `running_hrs_8_14` varchar(10) DEFAULT NULL,
  `running_hrs_16_22` varchar(10) DEFAULT NULL,
  `running_hrs_0_6` varchar(10) DEFAULT NULL,
  `lube_oil_sump_lvl_8_14` decimal(5,2) DEFAULT NULL,
  `lube_oil_sump_lvl_16_22` decimal(5,2) DEFAULT NULL,
  `lube_oil_sump_lvl_0_6` decimal(5,2) DEFAULT NULL,
  `anti_cond_heater_8_14` enum('ON','OFF') DEFAULT NULL,
  `anti_cond_heater_16_22` enum('ON','OFF') DEFAULT NULL,
  `anti_cond_heater_0_6` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_8` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_10` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_12` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_14` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_16` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_18` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_20` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_22` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_0` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_2` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_4` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_6` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_press_8` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_10` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_12` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_14` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_16` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_18` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_20` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_22` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_0` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_2` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_4` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_oil_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_6` enum('A','TA','RS') DEFAULT NULL,
  `preheat_unit_8` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_10` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_12` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_14` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_16` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_18` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_20` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_22` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_0` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_2` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_4` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_6` enum('ON','OFF') DEFAULT NULL,
  `ht_water_outlet_temp_8` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_10` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_12` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_14` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_16` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_18` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_20` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_22` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_0` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_2` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_4` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_6` decimal(5,2) DEFAULT NULL,
  `ht_expantion_tank_lvl_8_14` decimal(5,2) DEFAULT NULL,
  `ht_expantion_tank_lvl_16_22` decimal(5,2) DEFAULT NULL,
  `ht_expantion_tank_lvl_0_6` decimal(5,2) DEFAULT NULL,
  `lt_expantion_tank_lvl_8_14` decimal(5,2) DEFAULT NULL,
  `lt_expantion_tank_lvl_16_22` decimal(5,2) DEFAULT NULL,
  `lt_expantion_tank_lvl_0_6` decimal(5,2) DEFAULT NULL,
  `warming_up_8_14` decimal(5,2) DEFAULT NULL,
  `warming_up_16_22` decimal(5,2) DEFAULT NULL,
  `warming_up_0_6` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_8` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_10` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_12` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_14` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_16` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_18` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_20` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_22` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_0` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_2` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_4` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_6` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_8` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_10` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_12` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_14` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_16` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_18` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_20` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_22` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_0` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_2` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_4` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_fuel_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_6` enum('A','TA','RS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genset_wartsila_01`
--

INSERT INTO `genset_wartsila_01` (`tanggal`, `nama`, `running_hrs_8_14`, `running_hrs_16_22`, `running_hrs_0_6`, `lube_oil_sump_lvl_8_14`, `lube_oil_sump_lvl_16_22`, `lube_oil_sump_lvl_0_6`, `anti_cond_heater_8_14`, `anti_cond_heater_16_22`, `anti_cond_heater_0_6`, `prelube_pump_8`, `prelube_pump_10`, `prelube_pump_12`, `prelube_pump_14`, `prelube_pump_16`, `prelube_pump_18`, `prelube_pump_20`, `prelube_pump_22`, `prelube_pump_0`, `prelube_pump_2`, `prelube_pump_4`, `prelube_pump_6`, `prelube_pump_press_8`, `prelube_pump_press_10`, `prelube_pump_press_12`, `prelube_pump_press_14`, `prelube_pump_press_16`, `prelube_pump_press_18`, `prelube_pump_press_20`, `prelube_pump_press_22`, `prelube_pump_press_0`, `prelube_pump_press_2`, `prelube_pump_press_4`, `prelube_pump_press_6`, `kebocoran_oil_8`, `kebocoran_oil_10`, `kebocoran_oil_12`, `kebocoran_oil_14`, `kebocoran_oil_16`, `kebocoran_oil_18`, `kebocoran_oil_20`, `kebocoran_oil_22`, `kebocoran_oil_0`, `kebocoran_oil_2`, `kebocoran_oil_4`, `kebocoran_oil_6`, `preheat_unit_8`, `preheat_unit_10`, `preheat_unit_12`, `preheat_unit_14`, `preheat_unit_16`, `preheat_unit_18`, `preheat_unit_20`, `preheat_unit_22`, `preheat_unit_0`, `preheat_unit_2`, `preheat_unit_4`, `preheat_unit_6`, `ht_water_outlet_temp_8`, `ht_water_outlet_temp_10`, `ht_water_outlet_temp_12`, `ht_water_outlet_temp_14`, `ht_water_outlet_temp_16`, `ht_water_outlet_temp_18`, `ht_water_outlet_temp_20`, `ht_water_outlet_temp_22`, `ht_water_outlet_temp_0`, `ht_water_outlet_temp_2`, `ht_water_outlet_temp_4`, `ht_water_outlet_temp_6`, `ht_expantion_tank_lvl_8_14`, `ht_expantion_tank_lvl_16_22`, `ht_expantion_tank_lvl_0_6`, `lt_expantion_tank_lvl_8_14`, `lt_expantion_tank_lvl_16_22`, `lt_expantion_tank_lvl_0_6`, `warming_up_8_14`, `warming_up_16_22`, `warming_up_0_6`, `fuel_oil_inlet_temp_8`, `fuel_oil_inlet_temp_10`, `fuel_oil_inlet_temp_12`, `fuel_oil_inlet_temp_14`, `fuel_oil_inlet_temp_16`, `fuel_oil_inlet_temp_18`, `fuel_oil_inlet_temp_20`, `fuel_oil_inlet_temp_22`, `fuel_oil_inlet_temp_0`, `fuel_oil_inlet_temp_2`, `fuel_oil_inlet_temp_4`, `fuel_oil_inlet_temp_6`, `fuel_oil_inlet_pressure_8`, `fuel_oil_inlet_pressure_10`, `fuel_oil_inlet_pressure_12`, `fuel_oil_inlet_pressure_14`, `fuel_oil_inlet_pressure_16`, `fuel_oil_inlet_pressure_18`, `fuel_oil_inlet_pressure_20`, `fuel_oil_inlet_pressure_22`, `fuel_oil_inlet_pressure_0`, `fuel_oil_inlet_pressure_2`, `fuel_oil_inlet_pressure_4`, `fuel_oil_inlet_pressure_6`, `kebocoran_fuel_8`, `kebocoran_fuel_10`, `kebocoran_fuel_12`, `kebocoran_fuel_14`, `kebocoran_fuel_16`, `kebocoran_fuel_18`, `kebocoran_fuel_20`, `kebocoran_fuel_22`, `kebocoran_fuel_0`, `kebocoran_fuel_2`, `kebocoran_fuel_4`, `kebocoran_fuel_6`) VALUES
('2024-04-24', '', '2', '', '', 4.00, 0.00, 0.00, 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-04-25', '', '2', '2', '', 13.00, 14.00, 0.00, 'ON', 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genset_wartsila_02`
--

CREATE TABLE `genset_wartsila_02` (
  `tanggal` date NOT NULL,
  `nama` varchar(30) NOT NULL,
  `running_hrs_8_14` varchar(10) DEFAULT NULL,
  `running_hrs_16_22` varchar(10) DEFAULT NULL,
  `running_hrs_0_6` varchar(10) DEFAULT NULL,
  `lube_oil_sump_lvl_8_14` decimal(5,2) DEFAULT NULL,
  `lube_oil_sump_lvl_16_22` decimal(5,2) DEFAULT NULL,
  `lube_oil_sump_lvl_0_6` decimal(5,2) DEFAULT NULL,
  `anti_cond_heater_8_14` enum('ON','OFF') DEFAULT NULL,
  `anti_cond_heater_16_22` enum('ON','OFF') DEFAULT NULL,
  `anti_cond_heater_0_6` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_8` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_10` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_12` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_14` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_16` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_18` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_20` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_22` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_0` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_2` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_4` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_6` enum('ON','OFF') DEFAULT NULL,
  `prelube_pump_press_8` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_10` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_12` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_14` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_16` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_18` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_20` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_22` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_0` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_2` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_4` decimal(5,2) DEFAULT NULL,
  `prelube_pump_press_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_oil_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_6` enum('A','TA','RS') DEFAULT NULL,
  `preheat_unit_8` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_10` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_12` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_14` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_16` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_18` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_20` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_22` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_0` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_2` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_4` enum('ON','OFF') DEFAULT NULL,
  `preheat_unit_6` enum('ON','OFF') DEFAULT NULL,
  `ht_water_outlet_temp_8` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_10` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_12` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_14` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_16` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_18` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_20` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_22` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_0` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_2` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_4` decimal(5,2) DEFAULT NULL,
  `ht_water_outlet_temp_6` decimal(5,2) DEFAULT NULL,
  `ht_expantion_tank_lvl_8_14` decimal(5,2) DEFAULT NULL,
  `ht_expantion_tank_lvl_16_22` decimal(5,2) DEFAULT NULL,
  `ht_expantion_tank_lvl_0_6` decimal(5,2) DEFAULT NULL,
  `lt_expantion_tank_lvl_8_14` decimal(5,2) DEFAULT NULL,
  `lt_expantion_tank_lvl_16_22` decimal(5,2) DEFAULT NULL,
  `lt_expantion_tank_lvl_0_6` decimal(5,2) DEFAULT NULL,
  `warming_up_8_14` decimal(5,2) DEFAULT NULL,
  `warming_up_16_22` decimal(5,2) DEFAULT NULL,
  `warming_up_0_6` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_8` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_10` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_12` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_14` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_16` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_18` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_20` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_22` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_0` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_2` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_4` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_temp_6` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_8` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_10` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_12` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_14` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_16` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_18` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_20` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_22` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_0` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_2` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_4` decimal(5,2) DEFAULT NULL,
  `fuel_oil_inlet_pressure_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_fuel_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel_6` enum('A','TA','RS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genset_wartsila_02`
--

INSERT INTO `genset_wartsila_02` (`tanggal`, `nama`, `running_hrs_8_14`, `running_hrs_16_22`, `running_hrs_0_6`, `lube_oil_sump_lvl_8_14`, `lube_oil_sump_lvl_16_22`, `lube_oil_sump_lvl_0_6`, `anti_cond_heater_8_14`, `anti_cond_heater_16_22`, `anti_cond_heater_0_6`, `prelube_pump_8`, `prelube_pump_10`, `prelube_pump_12`, `prelube_pump_14`, `prelube_pump_16`, `prelube_pump_18`, `prelube_pump_20`, `prelube_pump_22`, `prelube_pump_0`, `prelube_pump_2`, `prelube_pump_4`, `prelube_pump_6`, `prelube_pump_press_8`, `prelube_pump_press_10`, `prelube_pump_press_12`, `prelube_pump_press_14`, `prelube_pump_press_16`, `prelube_pump_press_18`, `prelube_pump_press_20`, `prelube_pump_press_22`, `prelube_pump_press_0`, `prelube_pump_press_2`, `prelube_pump_press_4`, `prelube_pump_press_6`, `kebocoran_oil_8`, `kebocoran_oil_10`, `kebocoran_oil_12`, `kebocoran_oil_14`, `kebocoran_oil_16`, `kebocoran_oil_18`, `kebocoran_oil_20`, `kebocoran_oil_22`, `kebocoran_oil_0`, `kebocoran_oil_2`, `kebocoran_oil_4`, `kebocoran_oil_6`, `preheat_unit_8`, `preheat_unit_10`, `preheat_unit_12`, `preheat_unit_14`, `preheat_unit_16`, `preheat_unit_18`, `preheat_unit_20`, `preheat_unit_22`, `preheat_unit_0`, `preheat_unit_2`, `preheat_unit_4`, `preheat_unit_6`, `ht_water_outlet_temp_8`, `ht_water_outlet_temp_10`, `ht_water_outlet_temp_12`, `ht_water_outlet_temp_14`, `ht_water_outlet_temp_16`, `ht_water_outlet_temp_18`, `ht_water_outlet_temp_20`, `ht_water_outlet_temp_22`, `ht_water_outlet_temp_0`, `ht_water_outlet_temp_2`, `ht_water_outlet_temp_4`, `ht_water_outlet_temp_6`, `ht_expantion_tank_lvl_8_14`, `ht_expantion_tank_lvl_16_22`, `ht_expantion_tank_lvl_0_6`, `lt_expantion_tank_lvl_8_14`, `lt_expantion_tank_lvl_16_22`, `lt_expantion_tank_lvl_0_6`, `warming_up_8_14`, `warming_up_16_22`, `warming_up_0_6`, `fuel_oil_inlet_temp_8`, `fuel_oil_inlet_temp_10`, `fuel_oil_inlet_temp_12`, `fuel_oil_inlet_temp_14`, `fuel_oil_inlet_temp_16`, `fuel_oil_inlet_temp_18`, `fuel_oil_inlet_temp_20`, `fuel_oil_inlet_temp_22`, `fuel_oil_inlet_temp_0`, `fuel_oil_inlet_temp_2`, `fuel_oil_inlet_temp_4`, `fuel_oil_inlet_temp_6`, `fuel_oil_inlet_pressure_8`, `fuel_oil_inlet_pressure_10`, `fuel_oil_inlet_pressure_12`, `fuel_oil_inlet_pressure_14`, `fuel_oil_inlet_pressure_16`, `fuel_oil_inlet_pressure_18`, `fuel_oil_inlet_pressure_20`, `fuel_oil_inlet_pressure_22`, `fuel_oil_inlet_pressure_0`, `fuel_oil_inlet_pressure_2`, `fuel_oil_inlet_pressure_4`, `fuel_oil_inlet_pressure_6`, `kebocoran_fuel_8`, `kebocoran_fuel_10`, `kebocoran_fuel_12`, `kebocoran_fuel_14`, `kebocoran_fuel_16`, `kebocoran_fuel_18`, `kebocoran_fuel_20`, `kebocoran_fuel_22`, `kebocoran_fuel_0`, `kebocoran_fuel_2`, `kebocoran_fuel_4`, `kebocoran_fuel_6`) VALUES
('2024-04-24', '', '1', '2', '3', 0.00, 0.00, 0.00, 'OFF', 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hfo_separator_pump_unit`
--

CREATE TABLE `hfo_separator_pump_unit` (
  `tanggal` date NOT NULL,
  `operating_pump1_8_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_16_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_0_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_fuel1_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_6` enum('A','TA','RS') DEFAULT NULL,
  `operating_pump2_8_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_16_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_0_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_fuel2_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hfo_separator_pump_unit`
--

INSERT INTO `hfo_separator_pump_unit` (`tanggal`, `operating_pump1_8_14`, `operating_pump1_16_22`, `operating_pump1_0_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8_14`, `operating_pump2_16_22`, `operating_pump2_0_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`) VALUES
('2024-04-24', 'ON', 'OFF', NULL, 'TA', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hfo_unloading_pump_unit`
--

CREATE TABLE `hfo_unloading_pump_unit` (
  `tanggal` date NOT NULL,
  `operating_pump1_8_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_16_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_0_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_fuel1_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_6` enum('A','TA','RS') DEFAULT NULL,
  `operating_pump2_8_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_16_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_0_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_fuel2_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hfo_unloading_pump_unit`
--

INSERT INTO `hfo_unloading_pump_unit` (`tanggal`, `operating_pump1_8_14`, `operating_pump1_16_22`, `operating_pump1_0_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8_14`, `operating_pump2_16_22`, `operating_pump2_0_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`) VALUES
('2024-04-24', 'OFF', 'OFF', 'ON', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'ON', 'ON', 'ON', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `lfo_unloading_pump_unit`
--

CREATE TABLE `lfo_unloading_pump_unit` (
  `tanggal` date NOT NULL,
  `operating_pump1_8_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_16_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_0_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_fuel1_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel1_6` enum('A','TA','RS') DEFAULT NULL,
  `operating_pump2_8_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_16_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_0_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_fuel2_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lfo_unloading_pump_unit`
--

INSERT INTO `lfo_unloading_pump_unit` (`tanggal`, `operating_pump1_8_14`, `operating_pump1_16_22`, `operating_pump1_0_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8_14`, `operating_pump2_16_22`, `operating_pump2_0_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`) VALUES
('2024-04-24', 'OFF', NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, 'TA', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuel_transfer_pump_unit`
--
ALTER TABLE `fuel_transfer_pump_unit`
  ADD PRIMARY KEY (`tanggal`);

--
-- Indexes for table `genset_wartsila_01`
--
ALTER TABLE `genset_wartsila_01`
  ADD PRIMARY KEY (`tanggal`) USING BTREE;

--
-- Indexes for table `genset_wartsila_02`
--
ALTER TABLE `genset_wartsila_02`
  ADD PRIMARY KEY (`tanggal`) USING BTREE;

--
-- Indexes for table `hfo_separator_pump_unit`
--
ALTER TABLE `hfo_separator_pump_unit`
  ADD PRIMARY KEY (`tanggal`);

--
-- Indexes for table `hfo_unloading_pump_unit`
--
ALTER TABLE `hfo_unloading_pump_unit`
  ADD PRIMARY KEY (`tanggal`);

--
-- Indexes for table `lfo_unloading_pump_unit`
--
ALTER TABLE `lfo_unloading_pump_unit`
  ADD PRIMARY KEY (`tanggal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
