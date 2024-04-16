-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 11:19 AM
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
-- Table structure for table `genset_wartsila_01`
--

CREATE TABLE `genset_wartsila_01` (
  `tanggal` date NOT NULL,
  `nama` varchar(30) NOT NULL,
  `running_hrs_8_14` varchar(10) NOT NULL,
  `running_hrs_16_22` varchar(10) NOT NULL,
  `running_hrs_0_6` varchar(10) NOT NULL,
  `lube_oil_sump_lvl_8_14` decimal(5,2) NOT NULL,
  `lube_oil_sump_lvl_16_22` decimal(5,2) NOT NULL,
  `lube_oil_sump_lvl_0_6` decimal(5,2) NOT NULL,
  `anti_cond_heater_8_14` enum('ON','OFF') NOT NULL,
  `anti_cond_heater_16_22` enum('ON','OFF') NOT NULL,
  `anti_cond_heater_0_6` enum('ON','OFF') NOT NULL,
  `prelube_pump_8` enum('ON','OFF') NOT NULL,
  `prelube_pump_10` enum('ON','OFF') NOT NULL,
  `prelube_pump_12` enum('ON','OFF') NOT NULL,
  `prelube_pump_14` enum('ON','OFF') NOT NULL,
  `prelube_pump_16` enum('ON','OFF') NOT NULL,
  `prelube_pump_18` enum('ON','OFF') NOT NULL,
  `prelube_pump_20` enum('ON','OFF') NOT NULL,
  `prelube_pump_22` enum('ON','OFF') NOT NULL,
  `prelube_pump_0` enum('ON','OFF') NOT NULL,
  `prelube_pump_2` enum('ON','OFF') NOT NULL,
  `prelube_pump_4` enum('ON','OFF') NOT NULL,
  `prelube_pump_6` enum('ON','OFF') NOT NULL,
  `prelube_pump_press_8` decimal(5,2) NOT NULL,
  `prelube_pump_press_10` decimal(5,2) NOT NULL,
  `prelube_pump_press_12` decimal(5,2) NOT NULL,
  `prelube_pump_press_14` decimal(5,2) NOT NULL,
  `prelube_pump_press_16` decimal(5,2) NOT NULL,
  `prelube_pump_press_18` decimal(5,2) NOT NULL,
  `prelube_pump_press_20` decimal(5,2) NOT NULL,
  `prelube_pump_press_22` decimal(5,2) NOT NULL,
  `prelube_pump_press_0` decimal(5,2) NOT NULL,
  `prelube_pump_press_2` decimal(5,2) NOT NULL,
  `prelube_pump_press_4` decimal(5,2) NOT NULL,
  `prelube_pump_press_6` decimal(5,2) NOT NULL,
  `kebocoran_oil_8` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_10` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_12` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_14` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_16` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_18` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_20` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_22` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_0` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_2` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_4` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_6` enum('A','TA','RS') NOT NULL,
  `preheat_unit_8` enum('ON','OFF') NOT NULL,
  `preheat_unit_10` enum('ON','OFF') NOT NULL,
  `preheat_unit_12` enum('ON','OFF') NOT NULL,
  `preheat_unit_14` enum('ON','OFF') NOT NULL,
  `preheat_unit_16` enum('ON','OFF') NOT NULL,
  `preheat_unit_18` enum('ON','OFF') NOT NULL,
  `preheat_unit_20` enum('ON','OFF') NOT NULL,
  `preheat_unit_22` enum('ON','OFF') NOT NULL,
  `preheat_unit_0` enum('ON','OFF') NOT NULL,
  `preheat_unit_2` enum('ON','OFF') NOT NULL,
  `preheat_unit_4` enum('ON','OFF') NOT NULL,
  `preheat_unit_6` enum('ON','OFF') NOT NULL,
  `ht_water_outlet_temp_8` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_10` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_12` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_14` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_16` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_18` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_20` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_22` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_0` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_2` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_4` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_6` decimal(5,2) NOT NULL,
  `ht_expantion_tank_lvl_8_14` decimal(5,2) NOT NULL,
  `ht_expantion_tank_lvl_16_22` decimal(5,2) NOT NULL,
  `ht_expantion_tank_lvl_0_6` decimal(5,2) NOT NULL,
  `lt_expantion_tank_lvl_8_14` decimal(5,2) NOT NULL,
  `lt_expantion_tank_lvl_16_22` decimal(5,2) NOT NULL,
  `lt_expantion_tank_lvl_0_6` decimal(5,2) NOT NULL,
  `warming_up_8_14` smallint(6) NOT NULL,
  `warming_up_16_22` smallint(6) NOT NULL,
  `warming_up_0_6` smallint(6) NOT NULL,
  `fuel_oil_inlet_temp_8` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_10` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_12` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_14` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_16` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_18` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_20` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_22` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_0` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_2` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_4` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_6` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_8` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_10` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_12` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_14` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_16` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_18` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_20` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_22` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_0` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_2` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_4` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_6` decimal(5,2) NOT NULL,
  `kebocoran_fuel_8` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_10` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_12` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_14` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_16` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_18` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_20` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_22` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_0` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_2` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_4` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_6` enum('A','TA','RS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genset_wartsila_01`
--

INSERT INTO `genset_wartsila_01` (`tanggal`, `nama`, `running_hrs_8_14`, `running_hrs_16_22`, `running_hrs_0_6`, `lube_oil_sump_lvl_8_14`, `lube_oil_sump_lvl_16_22`, `lube_oil_sump_lvl_0_6`, `anti_cond_heater_8_14`, `anti_cond_heater_16_22`, `anti_cond_heater_0_6`, `prelube_pump_8`, `prelube_pump_10`, `prelube_pump_12`, `prelube_pump_14`, `prelube_pump_16`, `prelube_pump_18`, `prelube_pump_20`, `prelube_pump_22`, `prelube_pump_0`, `prelube_pump_2`, `prelube_pump_4`, `prelube_pump_6`, `prelube_pump_press_8`, `prelube_pump_press_10`, `prelube_pump_press_12`, `prelube_pump_press_14`, `prelube_pump_press_16`, `prelube_pump_press_18`, `prelube_pump_press_20`, `prelube_pump_press_22`, `prelube_pump_press_0`, `prelube_pump_press_2`, `prelube_pump_press_4`, `prelube_pump_press_6`, `kebocoran_oil_8`, `kebocoran_oil_10`, `kebocoran_oil_12`, `kebocoran_oil_14`, `kebocoran_oil_16`, `kebocoran_oil_18`, `kebocoran_oil_20`, `kebocoran_oil_22`, `kebocoran_oil_0`, `kebocoran_oil_2`, `kebocoran_oil_4`, `kebocoran_oil_6`, `preheat_unit_8`, `preheat_unit_10`, `preheat_unit_12`, `preheat_unit_14`, `preheat_unit_16`, `preheat_unit_18`, `preheat_unit_20`, `preheat_unit_22`, `preheat_unit_0`, `preheat_unit_2`, `preheat_unit_4`, `preheat_unit_6`, `ht_water_outlet_temp_8`, `ht_water_outlet_temp_10`, `ht_water_outlet_temp_12`, `ht_water_outlet_temp_14`, `ht_water_outlet_temp_16`, `ht_water_outlet_temp_18`, `ht_water_outlet_temp_20`, `ht_water_outlet_temp_22`, `ht_water_outlet_temp_0`, `ht_water_outlet_temp_2`, `ht_water_outlet_temp_4`, `ht_water_outlet_temp_6`, `ht_expantion_tank_lvl_8_14`, `ht_expantion_tank_lvl_16_22`, `ht_expantion_tank_lvl_0_6`, `lt_expantion_tank_lvl_8_14`, `lt_expantion_tank_lvl_16_22`, `lt_expantion_tank_lvl_0_6`, `warming_up_8_14`, `warming_up_16_22`, `warming_up_0_6`, `fuel_oil_inlet_temp_8`, `fuel_oil_inlet_temp_10`, `fuel_oil_inlet_temp_12`, `fuel_oil_inlet_temp_14`, `fuel_oil_inlet_temp_16`, `fuel_oil_inlet_temp_18`, `fuel_oil_inlet_temp_20`, `fuel_oil_inlet_temp_22`, `fuel_oil_inlet_temp_0`, `fuel_oil_inlet_temp_2`, `fuel_oil_inlet_temp_4`, `fuel_oil_inlet_temp_6`, `fuel_oil_inlet_pressure_8`, `fuel_oil_inlet_pressure_10`, `fuel_oil_inlet_pressure_12`, `fuel_oil_inlet_pressure_14`, `fuel_oil_inlet_pressure_16`, `fuel_oil_inlet_pressure_18`, `fuel_oil_inlet_pressure_20`, `fuel_oil_inlet_pressure_22`, `fuel_oil_inlet_pressure_0`, `fuel_oil_inlet_pressure_2`, `fuel_oil_inlet_pressure_4`, `fuel_oil_inlet_pressure_6`, `kebocoran_fuel_8`, `kebocoran_fuel_10`, `kebocoran_fuel_12`, `kebocoran_fuel_14`, `kebocoran_fuel_16`, `kebocoran_fuel_18`, `kebocoran_fuel_20`, `kebocoran_fuel_22`, `kebocoran_fuel_0`, `kebocoran_fuel_2`, `kebocoran_fuel_4`, `kebocoran_fuel_6`) VALUES
('2024-04-02', 'taufan', '2', '3', '4', 14.50, 16.40, 17.80, 'ON', 'OFF', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'OFF', 'OFF', 'ON', 5.00, 5.00, 5.50, 5.00, 5.50, 5.00, 5.00, 5.00, 5.50, 6.00, 6.00, 6.00, 'A', 'TA', 'RS', 'A', 'TA', 'A', 'TA', 'RS', 'TA', 'A', 'TA', 'A', 'ON', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'ON', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', ''),
('2024-04-05', 'ahadiat', '3', '2', '1', 99.00, 99.00, 99.00, 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'ON', 'ON', 'ON', 'OFF', 'OFF', 'ON', 5.00, 5.00, 5.50, 5.00, 5.50, 5.00, 5.00, 5.00, 5.50, 6.00, 6.00, 6.00, 'A', 'TA', 'RS', 'A', 'TA', 'A', 'TA', 'RS', 'TA', 'A', 'TA', 'A', 'ON', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'ON', 140.00, 134.00, 172.00, 193.00, 140.00, 150.00, 210.00, 190.00, 165.00, 154.00, 178.00, 132.00, 70.00, 60.00, 55.00, 67.00, 81.00, 70.00, 2, 1, 3, 210.00, 190.00, 185.00, 200.00, 170.00, 210.00, 197.00, 200.00, 210.00, 209.00, 254.00, 230.00, 4.00, 5.00, 6.00, 7.00, 4.00, 5.00, 6.00, 7.00, 4.00, 5.00, 6.00, 7.00, 'A', 'A', 'RS', 'TA', 'A', 'TA', 'TA', 'TA', 'RS', 'A', 'TA', 'A'),
('2024-04-15', '', '1', '2', '3', 15.00, 16.00, 14.00, 'OFF', 'OFF', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A'),
('2024-04-16', '', '1', '2', '3', 12.00, 12.00, 14.00, 'OFF', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 'ON', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `genset_wartsila_02`
--

CREATE TABLE `genset_wartsila_02` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(30) NOT NULL,
  `running_hrs_8:14` varchar(10) NOT NULL,
  `running_hrs_16:22` varchar(10) NOT NULL,
  `running_hrs_0:6` varchar(10) NOT NULL,
  `lube_oil_sump_lvl_8:14` decimal(5,2) NOT NULL,
  `lube_oil_sump_lvl_16:22` decimal(5,2) NOT NULL,
  `lube_oil_sump_lvl_0:6` decimal(5,2) NOT NULL,
  `anti_cond_heater_8:14` enum('ON','OFF') NOT NULL,
  `anti_cond_heater_16:22` enum('ON','OFF') NOT NULL,
  `anti_cond_heater_0:6` enum('ON','OFF') NOT NULL,
  `prelube_pump_8` enum('ON','OFF') NOT NULL,
  `prelube_pump_10` enum('ON','OFF') NOT NULL,
  `prelube_pump_12` enum('ON','OFF') NOT NULL,
  `prelube_pump_14` enum('ON','OFF') NOT NULL,
  `prelube_pump_16` enum('ON','OFF') NOT NULL,
  `prelube_pump_18` enum('ON','OFF') NOT NULL,
  `prelube_pump_20` enum('ON','OFF') NOT NULL,
  `prelube_pump_22` enum('ON','OFF') NOT NULL,
  `prelube_pump_0` enum('ON','OFF') NOT NULL,
  `prelube_pump_2` enum('ON','OFF') NOT NULL,
  `prelube_pump_4` enum('ON','OFF') NOT NULL,
  `prelube_pump_6` enum('ON','OFF') NOT NULL,
  `prelube_pump_press_8` decimal(5,2) NOT NULL,
  `prelube_pump_press_10` decimal(5,2) NOT NULL,
  `prelube_pump_press_12` decimal(5,2) NOT NULL,
  `prelube_pump_press_14` decimal(5,2) NOT NULL,
  `prelube_pump_press_16` decimal(5,2) NOT NULL,
  `prelube_pump_press_18` decimal(5,2) NOT NULL,
  `prelube_pump_press_20` decimal(5,2) NOT NULL,
  `prelube_pump_press_22` decimal(5,2) NOT NULL,
  `prelube_pump_press_0` decimal(5,2) NOT NULL,
  `prelube_pump_press_2` decimal(5,2) NOT NULL,
  `prelube_pump_press_4` decimal(5,2) NOT NULL,
  `prelube_pump_press_6` decimal(5,2) NOT NULL,
  `kebocoran_oil_8` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_10` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_12` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_14` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_16` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_18` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_20` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_22` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_0` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_2` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_4` enum('A','TA','RS') NOT NULL,
  `kebocoran_oil_6` enum('A','TA','RS') NOT NULL,
  `preheat_unit_8` enum('ON','OFF') NOT NULL,
  `preheat_unit_10` enum('ON','OFF') NOT NULL,
  `preheat_unit_12` enum('ON','OFF') NOT NULL,
  `preheat_unit_14` enum('ON','OFF') NOT NULL,
  `preheat_unit_16` enum('ON','OFF') NOT NULL,
  `preheat_unit_18` enum('ON','OFF') NOT NULL,
  `preheat_unit_20` enum('ON','OFF') NOT NULL,
  `preheat_unit_22` enum('ON','OFF') NOT NULL,
  `preheat_unit_0` enum('ON','OFF') NOT NULL,
  `preheat_unit_2` enum('ON','OFF') NOT NULL,
  `preheat_unit_4` enum('ON','OFF') NOT NULL,
  `preheat_unit_6` enum('ON','OFF') NOT NULL,
  `ht_water_outlet_temp_8` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_10` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_12` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_14` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_16` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_18` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_20` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_22` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_0` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_2` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_4` decimal(5,2) NOT NULL,
  `ht_water_outlet_temp_6` decimal(5,2) NOT NULL,
  `ht_expantion_tank_lvl_8:14` decimal(5,2) NOT NULL,
  `ht_expantion_tank_lvl_16:22` decimal(5,2) NOT NULL,
  `ht_expantion_tank_lvl_0:6` decimal(5,2) NOT NULL,
  `lt_expantion_tank_lvl_8:14` decimal(5,2) NOT NULL,
  `lt_expantion_tank_lvl_16:22` decimal(5,2) NOT NULL,
  `lt_expantion_tank_lvl_0:6` decimal(5,2) NOT NULL,
  `warming_up_8:14` smallint(6) NOT NULL,
  `warming_up_16:22` smallint(6) NOT NULL,
  `warming_up_0:6` smallint(6) NOT NULL,
  `fuel_oil_inlet_temp_8` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_10` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_12` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_14` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_16` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_18` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_20` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_22` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_0` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_2` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_4` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_temp_6` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_8` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_10` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_12` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_14` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_16` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_18` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_20` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_22` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_0` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_2` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_4` decimal(5,2) NOT NULL,
  `fuel_oil_inlet_pressure_6` decimal(5,2) NOT NULL,
  `kebocoran_fuel_8` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_10` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_12` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_14` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_16` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_18` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_20` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_22` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_0` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_2` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_4` enum('A','TA','RS') NOT NULL,
  `kebocoran_fuel_6` enum('A','TA','RS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genset_wartsila_02`
--

INSERT INTO `genset_wartsila_02` (`id`, `tanggal`, `nama`, `running_hrs_8:14`, `running_hrs_16:22`, `running_hrs_0:6`, `lube_oil_sump_lvl_8:14`, `lube_oil_sump_lvl_16:22`, `lube_oil_sump_lvl_0:6`, `anti_cond_heater_8:14`, `anti_cond_heater_16:22`, `anti_cond_heater_0:6`, `prelube_pump_8`, `prelube_pump_10`, `prelube_pump_12`, `prelube_pump_14`, `prelube_pump_16`, `prelube_pump_18`, `prelube_pump_20`, `prelube_pump_22`, `prelube_pump_0`, `prelube_pump_2`, `prelube_pump_4`, `prelube_pump_6`, `prelube_pump_press_8`, `prelube_pump_press_10`, `prelube_pump_press_12`, `prelube_pump_press_14`, `prelube_pump_press_16`, `prelube_pump_press_18`, `prelube_pump_press_20`, `prelube_pump_press_22`, `prelube_pump_press_0`, `prelube_pump_press_2`, `prelube_pump_press_4`, `prelube_pump_press_6`, `kebocoran_oil_8`, `kebocoran_oil_10`, `kebocoran_oil_12`, `kebocoran_oil_14`, `kebocoran_oil_16`, `kebocoran_oil_18`, `kebocoran_oil_20`, `kebocoran_oil_22`, `kebocoran_oil_0`, `kebocoran_oil_2`, `kebocoran_oil_4`, `kebocoran_oil_6`, `preheat_unit_8`, `preheat_unit_10`, `preheat_unit_12`, `preheat_unit_14`, `preheat_unit_16`, `preheat_unit_18`, `preheat_unit_20`, `preheat_unit_22`, `preheat_unit_0`, `preheat_unit_2`, `preheat_unit_4`, `preheat_unit_6`, `ht_water_outlet_temp_8`, `ht_water_outlet_temp_10`, `ht_water_outlet_temp_12`, `ht_water_outlet_temp_14`, `ht_water_outlet_temp_16`, `ht_water_outlet_temp_18`, `ht_water_outlet_temp_20`, `ht_water_outlet_temp_22`, `ht_water_outlet_temp_0`, `ht_water_outlet_temp_2`, `ht_water_outlet_temp_4`, `ht_water_outlet_temp_6`, `ht_expantion_tank_lvl_8:14`, `ht_expantion_tank_lvl_16:22`, `ht_expantion_tank_lvl_0:6`, `lt_expantion_tank_lvl_8:14`, `lt_expantion_tank_lvl_16:22`, `lt_expantion_tank_lvl_0:6`, `warming_up_8:14`, `warming_up_16:22`, `warming_up_0:6`, `fuel_oil_inlet_temp_8`, `fuel_oil_inlet_temp_10`, `fuel_oil_inlet_temp_12`, `fuel_oil_inlet_temp_14`, `fuel_oil_inlet_temp_16`, `fuel_oil_inlet_temp_18`, `fuel_oil_inlet_temp_20`, `fuel_oil_inlet_temp_22`, `fuel_oil_inlet_temp_0`, `fuel_oil_inlet_temp_2`, `fuel_oil_inlet_temp_4`, `fuel_oil_inlet_temp_6`, `fuel_oil_inlet_pressure_8`, `fuel_oil_inlet_pressure_10`, `fuel_oil_inlet_pressure_12`, `fuel_oil_inlet_pressure_14`, `fuel_oil_inlet_pressure_16`, `fuel_oil_inlet_pressure_18`, `fuel_oil_inlet_pressure_20`, `fuel_oil_inlet_pressure_22`, `fuel_oil_inlet_pressure_0`, `fuel_oil_inlet_pressure_2`, `fuel_oil_inlet_pressure_4`, `fuel_oil_inlet_pressure_6`, `kebocoran_fuel_8`, `kebocoran_fuel_10`, `kebocoran_fuel_12`, `kebocoran_fuel_14`, `kebocoran_fuel_16`, `kebocoran_fuel_18`, `kebocoran_fuel_20`, `kebocoran_fuel_22`, `kebocoran_fuel_0`, `kebocoran_fuel_2`, `kebocoran_fuel_4`, `kebocoran_fuel_6`) VALUES
(1, '2024-04-02', 'operator 1', '2', '3', '4', 14.50, 16.40, 17.80, 'ON', 'OFF', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'OFF', 'OFF', 'ON', 5.50, 5.50, 5.50, 5.00, 5.50, 5.00, 5.00, 5.00, 5.50, 6.00, 6.00, 6.00, 'A', 'TA', 'RS', 'A', 'TA', 'A', 'TA', 'RS', 'TA', 'A', 'TA', 'A', 'ON', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'OFF', 'ON', 'ON', 'ON', 'ON', 145.00, 179.00, 168.00, 210.00, 175.00, 145.00, 185.00, 156.00, 167.00, 185.00, 174.00, 172.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'TA', 'A', 'TA', 'TA', 'A', 'RS', 'TA', 'A', 'TA', 'RS', 'TA', 'A'),
(2, '2024-04-07', 'operator2', '3', '1', '3', 85.00, 90.00, 78.00, 'OFF', 'ON', 'ON', 'OFF', 'OFF', 'ON', 'OFF', 'OFF', 'OFF', 'ON', 'OFF', 'ON', 'OFF', 'OFF', 'ON', 5.00, 6.00, 6.00, 5.00, 5.50, 5.00, 6.00, 5.00, 5.50, 6.00, 6.00, 6.00, 'RS', 'TA', 'A', 'A', 'RS', 'RS', 'A', 'TA', 'TA', 'A', 'TA', 'A', 'ON', 'OFF', 'ON', 'OFF', 'ON', 'OFF', 'ON', 'OFF', 'ON', 'OFF', 'ON', 'ON', 189.00, 176.00, 220.00, 210.00, 200.00, 187.00, 178.00, 159.00, 193.00, 175.00, 198.00, 164.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'RS', 'TA', 'TA', 'A', 'RS', 'TA', 'RS', 'A', 'TA', 'RS', 'RS', 'TA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genset_wartsila_01`
--
ALTER TABLE `genset_wartsila_01`
  ADD PRIMARY KEY (`tanggal`) USING BTREE;

--
-- Indexes for table `genset_wartsila_02`
--
ALTER TABLE `genset_wartsila_02`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `set tanggal` (`tanggal`),
  ADD KEY `tanggal` (`tanggal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genset_wartsila_02`
--
ALTER TABLE `genset_wartsila_02`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
