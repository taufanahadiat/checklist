-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2024 at 01:10 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `checklistnew_24`
--

-- --------------------------------------------------------

--
-- Table structure for table `air_dryer`
--

CREATE TABLE IF NOT EXISTS `air_dryer` (
  `tanggal` date NOT NULL,
  `shift` enum('Shift 1','Shift 2','Shift 3') NOT NULL,
  `time_period` enum('1','2','3') NOT NULL,
  `line` enum('4&5','6&7') NOT NULL,
  `adsullair23_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adsullair23_reflow_press` decimal(5,2) DEFAULT NULL,
  `adsullair23_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adsullair23_after_filter` enum('HJ','M') DEFAULT NULL,
  `adsullair23_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adsullair23_vibration` enum('H','S','T') DEFAULT NULL,
  `adsullair24_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adsullair24_reflow_press` decimal(5,2) DEFAULT NULL,
  `adsullair24_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adsullair24_after_filter` enum('HJ','M') DEFAULT NULL,
  `adsullair24_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adsullair24_vibration` enum('H','S','T') DEFAULT NULL,
  `adsullair27_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adsullair27_reflow_press` decimal(5,2) DEFAULT NULL,
  `adsullair27_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adsullair27_after_filter` enum('HJ','M') DEFAULT NULL,
  `adsullair27_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adsullair27_vibration` enum('H','S','T') DEFAULT NULL,
  `adsullair33_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adsullair33_reflow_press` decimal(5,2) DEFAULT NULL,
  `adsullair33_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adsullair33_after_filter` enum('HJ','M') DEFAULT NULL,
  `adsullair33_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adsullair33_vibration` enum('H','S','T') DEFAULT NULL,
  `adaugust28_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adaugust28_reflow_press` decimal(5,2) DEFAULT NULL,
  `adaugust28_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust28_after_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust28_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adaugust28_vibration` enum('H','S','T') DEFAULT NULL,
  `adaugust29_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adaugust29_reflow_press` decimal(5,2) DEFAULT NULL,
  `adaugust29_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust29_after_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust29_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adaugust29_vibration` enum('H','S','T') DEFAULT NULL,
  `adaugust30_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adaugust30_reflow_press` decimal(5,2) DEFAULT NULL,
  `adaugust30_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust30_after_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust30_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adaugust30_vibration` enum('H','S','T') DEFAULT NULL,
  `adaugust31_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adaugust31_reflow_press` decimal(5,2) DEFAULT NULL,
  `adaugust31_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust31_after_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust31_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adaugust31_vibration` enum('H','S','T') DEFAULT NULL,
  `sullair22_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `sullair22_reflow_press` decimal(5,2) DEFAULT NULL,
  `sullair22_pre_filter` enum('HJ','M') DEFAULT NULL,
  `sullair22_after_filter` enum('HJ','M') DEFAULT NULL,
  `sullair22_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `sullair22_vibration` enum('H','S','T') DEFAULT NULL,
  `boge01_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `boge01_reflow_press` decimal(5,2) DEFAULT NULL,
  `boge01_pre_filter` enum('HJ','M') DEFAULT NULL,
  `boge01_after_filter` enum('HJ','M') DEFAULT NULL,
  `boge01_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `boge01_vibration` enum('H','S','T') DEFAULT NULL,
  `boge02_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `boge02_reflow_press` decimal(5,2) DEFAULT NULL,
  `boge02_pre_filter` enum('HJ','M') DEFAULT NULL,
  `boge02_after_filter` enum('HJ','M') DEFAULT NULL,
  `boge02_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `boge02_vibration` enum('H','S','T') DEFAULT NULL,
  `adaugust32_dewpoint_temp` decimal(5,2) DEFAULT NULL,
  `adaugust32_reflow_press` decimal(5,2) DEFAULT NULL,
  `adaugust32_pre_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust32_after_filter` enum('HJ','M') DEFAULT NULL,
  `adaugust32_autodrain_solenoid` enum('B','R') DEFAULT NULL,
  `adaugust32_vibration` enum('H','S','T') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `air_dryer`
--

INSERT INTO `air_dryer` (`tanggal`, `shift`, `time_period`, `line`, `adsullair23_dewpoint_temp`, `adsullair23_reflow_press`, `adsullair23_pre_filter`, `adsullair23_after_filter`, `adsullair23_autodrain_solenoid`, `adsullair23_vibration`, `adsullair24_dewpoint_temp`, `adsullair24_reflow_press`, `adsullair24_pre_filter`, `adsullair24_after_filter`, `adsullair24_autodrain_solenoid`, `adsullair24_vibration`, `adsullair27_dewpoint_temp`, `adsullair27_reflow_press`, `adsullair27_pre_filter`, `adsullair27_after_filter`, `adsullair27_autodrain_solenoid`, `adsullair27_vibration`, `adsullair33_dewpoint_temp`, `adsullair33_reflow_press`, `adsullair33_pre_filter`, `adsullair33_after_filter`, `adsullair33_autodrain_solenoid`, `adsullair33_vibration`, `adaugust28_dewpoint_temp`, `adaugust28_reflow_press`, `adaugust28_pre_filter`, `adaugust28_after_filter`, `adaugust28_autodrain_solenoid`, `adaugust28_vibration`, `adaugust29_dewpoint_temp`, `adaugust29_reflow_press`, `adaugust29_pre_filter`, `adaugust29_after_filter`, `adaugust29_autodrain_solenoid`, `adaugust29_vibration`, `adaugust30_dewpoint_temp`, `adaugust30_reflow_press`, `adaugust30_pre_filter`, `adaugust30_after_filter`, `adaugust30_autodrain_solenoid`, `adaugust30_vibration`, `adaugust31_dewpoint_temp`, `adaugust31_reflow_press`, `adaugust31_pre_filter`, `adaugust31_after_filter`, `adaugust31_autodrain_solenoid`, `adaugust31_vibration`, `sullair22_dewpoint_temp`, `sullair22_reflow_press`, `sullair22_pre_filter`, `sullair22_after_filter`, `sullair22_autodrain_solenoid`, `sullair22_vibration`, `boge01_dewpoint_temp`, `boge01_reflow_press`, `boge01_pre_filter`, `boge01_after_filter`, `boge01_autodrain_solenoid`, `boge01_vibration`, `boge02_dewpoint_temp`, `boge02_reflow_press`, `boge02_pre_filter`, `boge02_after_filter`, `boge02_autodrain_solenoid`, `boge02_vibration`, `adaugust32_dewpoint_temp`, `adaugust32_reflow_press`, `adaugust32_pre_filter`, `adaugust32_after_filter`, `adaugust32_autodrain_solenoid`, `adaugust32_vibration`) VALUES
('2024-05-22', 'Shift 1', '1', '4&5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.00', NULL, 'HJ', NULL, NULL, NULL, NULL, '2.00', NULL, 'M', NULL, NULL, NULL, NULL, NULL, NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `air_receiver_tank`
--

CREATE TABLE IF NOT EXISTS `air_receiver_tank` (
  `tanggal` date NOT NULL,
  `shift` enum('Shift 1','Shift 2','Shift 3') NOT NULL,
  `time_period` enum('1','2','3') NOT NULL,
  `line` enum('Line 4','Line 5','Line 6','Line 7','Met 1','Met 2','Met 3','Met 4','BOPET') NOT NULL,
  `tank1_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank1_auto_drain` enum('B','R') DEFAULT NULL,
  `tank1_kondensat` enum('A','TA') DEFAULT NULL,
  `tank1_kandungan_oli` enum('A','TA') DEFAULT NULL,
  `tank2_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank2_auto_drain` enum('B','R') DEFAULT NULL,
  `tank2_kondensat` enum('A','TA') DEFAULT NULL,
  `tank2_kandungan_oli` enum('A','TA') DEFAULT NULL,
  `tank3_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank3_auto_drain` enum('B','R') DEFAULT NULL,
  `tank3_kondensat` enum('A','TA') DEFAULT NULL,
  `tank3_kandungan_oli` enum('A','TA') DEFAULT NULL,
  `tank5_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank5_auto_drain` enum('B','R') DEFAULT NULL,
  `tank5_kondensat` enum('A','TA') DEFAULT NULL,
  `tank5_kandungan_oli` enum('A','TA') DEFAULT NULL,
  `tank6_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank6_auto_drain` enum('B','R') DEFAULT NULL,
  `tank6_kondensat` enum('A','TA') DEFAULT NULL,
  `tank6_kandungan_oli` enum('A','TA') DEFAULT NULL,
  `tank7_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank7_auto_drain` enum('B','R') DEFAULT NULL,
  `tank7_kondensat` enum('A','TA') DEFAULT NULL,
  `tank7_kandungan_oli` enum('A','TA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `air_receiver_tank`
--

INSERT INTO `air_receiver_tank` (`tanggal`, `shift`, `time_period`, `line`, `tank1_air_pressure`, `tank1_auto_drain`, `tank1_kondensat`, `tank1_kandungan_oli`, `tank2_air_pressure`, `tank2_auto_drain`, `tank2_kondensat`, `tank2_kandungan_oli`, `tank3_air_pressure`, `tank3_auto_drain`, `tank3_kondensat`, `tank3_kandungan_oli`, `tank5_air_pressure`, `tank5_auto_drain`, `tank5_kondensat`, `tank5_kandungan_oli`, `tank6_air_pressure`, `tank6_auto_drain`, `tank6_kondensat`, `tank6_kandungan_oli`, `tank7_air_pressure`, `tank7_auto_drain`, `tank7_kondensat`, `tank7_kandungan_oli`) VALUES
('2024-05-22', 'Shift 1', '1', 'Line 4', '1.00', 'B', NULL, NULL, '2.00', 'B', NULL, NULL, '3.00', NULL, 'A', NULL, NULL, NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-24', 'Shift 1', '1', 'Line 4', '1.00', 'B', NULL, NULL, '2.00', 'B', 'TA', 'A', '3.00', NULL, NULL, NULL, '4.00', NULL, NULL, NULL, '5.00', NULL, NULL, NULL, '6.00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chiller_hitachi_45met34`
--

CREATE TABLE IF NOT EXISTS `chiller_hitachi_45met34` (
  `tanggal` date NOT NULL,
  `shift` enum('shift1','shift2','shift3') NOT NULL,
  `time_period` enum('1','2','3') NOT NULL,
  `hitachi37c1_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi37_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi37_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi37_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi37_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi37_temp_set` decimal(5,2) DEFAULT NULL,
  `hitachi37_onoff_diff` decimal(5,2) DEFAULT NULL,
  `hitachi37_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi37_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi37_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi37_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi37c2_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi38c1_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi38_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi38_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi38_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi38_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi38_temp_set` decimal(5,2) DEFAULT NULL,
  `hitachi38_onoff_diff` decimal(5,2) DEFAULT NULL,
  `hitachi38_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi38_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi38_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi38_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi38c2_disc_press` decimal(5,2) DEFAULT NULL,
  UNIQUE KEY `tanggal` (`tanggal`,`shift`,`time_period`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chiller_hitachi_45met34`
--

INSERT INTO `chiller_hitachi_45met34` (`tanggal`, `shift`, `time_period`, `hitachi37c1_disc_press`, `hitachi37_evap_tempcel`, `hitachi37_evap_tempcol`, `hitachi37_cond_tempin`, `hitachi37_cond_tempout`, `hitachi37_temp_set`, `hitachi37_onoff_diff`, `hitachi37_evap_pressin`, `hitachi37_evap_pressout`, `hitachi37_cond_pressin`, `hitachi37_cond_pressout`, `hitachi37c2_disc_press`, `hitachi38c1_disc_press`, `hitachi38_evap_tempcel`, `hitachi38_evap_tempcol`, `hitachi38_cond_tempin`, `hitachi38_cond_tempout`, `hitachi38_temp_set`, `hitachi38_onoff_diff`, `hitachi38_evap_pressin`, `hitachi38_evap_pressout`, `hitachi38_cond_pressin`, `hitachi38_cond_pressout`, `hitachi38c2_disc_press`) VALUES
('2024-05-17', 'shift1', '1', '1.00', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00', '9.00', '10.00', '11.00', '12.00', '13.00', '14.00', '15.00', '16.00', '17.00', '18.00', '19.00', '20.00', '21.00', '22.00', '23.00', '24.00'),
('2024-05-19', 'shift1', '1', '2.00', '3.00', '4.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.00', '11.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chiller_hitachi_67bopet`
--

CREATE TABLE IF NOT EXISTS `chiller_hitachi_67bopet` (
  `tanggal` date NOT NULL,
  `shift` enum('shift1','shift2','shift3') DEFAULT NULL,
  `time_period` enum('1','2','3') DEFAULT NULL,
  `hitachi33c1_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi33c1_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi33c1_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi33c1_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi33c1_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi33_temp_set` decimal(5,2) DEFAULT NULL,
  `hitachi33_onoff_diff` decimal(5,2) DEFAULT NULL,
  `hitachi33c1_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi33c1_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi33c1_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi33c1_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi33c2_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi34_temp_set` decimal(5,2) DEFAULT NULL,
  `hitachi34_onoff_diff` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi34c1_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi34c2_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi35_temp_set` decimal(5,2) DEFAULT NULL,
  `hitachi35_onoff_diff` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi35c1_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi35c2_cond_pressout` decimal(5,2) DEFAULT NULL,
  UNIQUE KEY `tanggal` (`tanggal`,`shift`,`time_period`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chiller_hitachi_67bopet`
--

INSERT INTO `chiller_hitachi_67bopet` (`tanggal`, `shift`, `time_period`, `hitachi33c1_disc_press`, `hitachi33c1_evap_tempcel`, `hitachi33c1_evap_tempcol`, `hitachi33c1_cond_tempin`, `hitachi33c1_cond_tempout`, `hitachi33_temp_set`, `hitachi33_onoff_diff`, `hitachi33c1_evap_pressin`, `hitachi33c1_evap_pressout`, `hitachi33c1_cond_pressin`, `hitachi33c1_cond_pressout`, `hitachi33c2_disc_press`, `hitachi33c2_evap_tempcel`, `hitachi33c2_evap_tempcol`, `hitachi33c2_cond_tempin`, `hitachi33c2_cond_tempout`, `hitachi33c2_evap_pressin`, `hitachi33c2_evap_pressout`, `hitachi33c2_cond_pressin`, `hitachi33c2_cond_pressout`, `hitachi34c1_disc_press`, `hitachi34c1_evap_tempcel`, `hitachi34c1_evap_tempcol`, `hitachi34c1_cond_tempin`, `hitachi34c1_cond_tempout`, `hitachi34_temp_set`, `hitachi34_onoff_diff`, `hitachi34c1_evap_pressin`, `hitachi34c1_evap_pressout`, `hitachi34c1_cond_pressin`, `hitachi34c1_cond_pressout`, `hitachi34c2_disc_press`, `hitachi34c2_evap_tempcel`, `hitachi34c2_evap_tempcol`, `hitachi34c2_cond_tempin`, `hitachi34c2_cond_tempout`, `hitachi34c2_evap_pressin`, `hitachi34c2_evap_pressout`, `hitachi34c2_cond_pressin`, `hitachi34c2_cond_pressout`, `hitachi35c1_disc_press`, `hitachi35c1_evap_tempcel`, `hitachi35c1_evap_tempcol`, `hitachi35c1_cond_tempin`, `hitachi35c1_cond_tempout`, `hitachi35_temp_set`, `hitachi35_onoff_diff`, `hitachi35c1_evap_pressin`, `hitachi35c1_evap_pressout`, `hitachi35c1_cond_pressin`, `hitachi35c1_cond_pressout`, `hitachi35c2_disc_press`, `hitachi35c2_evap_tempcel`, `hitachi35c2_evap_tempcol`, `hitachi35c2_cond_tempin`, `hitachi35c2_cond_tempout`, `hitachi35c2_evap_pressin`, `hitachi35c2_evap_pressout`, `hitachi35c2_cond_pressin`, `hitachi35c2_cond_pressout`) VALUES
('2024-05-15', NULL, NULL, '1.00', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00', '9.00', '10.00', '11.00', '12.00', '13.00', '14.00', '15.00', '16.00', '17.00', '18.00', '19.00', '20.00', '21.00', '22.00', '23.00', '24.00', '25.00', '26.00', '27.00', '28.00', '29.00', '30.00', '31.00', '32.00', '33.00', '34.00', '35.00', '36.00', '37.00', '38.00', '39.00', '40.00', '41.00', '42.00', '43.00', '44.00', '45.00', '46.00', '47.00', '48.00', '49.00', '50.00', '51.00', '52.00', '53.00', '54.00', '55.00', '56.00', '57.00', '58.00', '59.00', '60.00');

-- --------------------------------------------------------

--
-- Table structure for table `chiller_hitachi_coat14met12`
--

CREATE TABLE IF NOT EXISTS `chiller_hitachi_coat14met12` (
  `tanggal` date NOT NULL,
  `shift` enum('Shift 1','Shift 2','Shift 3') NOT NULL,
  `time_period` enum('1','2','3') NOT NULL,
  `bitzer31c1_disc_press` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_cond_tempin` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_cond_tempout` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_temp_set` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_onoff_diff` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_evap_pressin` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_evap_pressout` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_cond_pressin` decimal(5,2) DEFAULT NULL,
  `bitzer31c1_cond_pressout` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_disc_press` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_cond_tempin` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_cond_tempout` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_temp_set` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_onoff_diff` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_evap_pressin` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_evap_pressout` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_cond_pressin` decimal(5,2) DEFAULT NULL,
  `bitzer31c2_cond_pressout` decimal(5,2) DEFAULT NULL,
  `clima48_disc_press` decimal(5,2) DEFAULT NULL,
  `clima48_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `clima48_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `clima48_cond_tempin` decimal(5,2) DEFAULT NULL,
  `clima48_cond_tempout` decimal(5,2) DEFAULT NULL,
  `clima48_temp_set` decimal(5,2) DEFAULT NULL,
  `clima48_onoff_diff` decimal(5,2) DEFAULT NULL,
  `clima48_evap_pressin` decimal(5,2) DEFAULT NULL,
  `clima48_evap_pressout` decimal(5,2) DEFAULT NULL,
  `clima48_cond_pressin` decimal(5,2) DEFAULT NULL,
  `clima48_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi30c1_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi30_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi30_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi30_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi30_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi30_temp_set` decimal(5,2) DEFAULT NULL,
  `hitachi30_onoff_diff` decimal(5,2) DEFAULT NULL,
  `hitachi30_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi30_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi30_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi30_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi30c2_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi36c1_disc_press` decimal(5,2) DEFAULT NULL,
  `hitachi36_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `hitachi36_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `hitachi36_cond_tempin` decimal(5,2) DEFAULT NULL,
  `hitachi36_cond_tempout` decimal(5,2) DEFAULT NULL,
  `hitachi36_temp_set` decimal(5,2) DEFAULT NULL,
  `hitachi36_onoff_diff` decimal(5,2) DEFAULT NULL,
  `hitachi36_evap_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi36_evap_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi36_cond_pressin` decimal(5,2) DEFAULT NULL,
  `hitachi36_cond_pressout` decimal(5,2) DEFAULT NULL,
  `hitachi36c2_disc_press` decimal(5,2) DEFAULT NULL,
  UNIQUE KEY `tanggal` (`tanggal`,`shift`,`time_period`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chiller_hitachi_coat14met12`
--

INSERT INTO `chiller_hitachi_coat14met12` (`tanggal`, `shift`, `time_period`, `bitzer31c1_disc_press`, `bitzer31c1_evap_tempcel`, `bitzer31c1_evap_tempcol`, `bitzer31c1_cond_tempin`, `bitzer31c1_cond_tempout`, `bitzer31c1_temp_set`, `bitzer31c1_onoff_diff`, `bitzer31c1_evap_pressin`, `bitzer31c1_evap_pressout`, `bitzer31c1_cond_pressin`, `bitzer31c1_cond_pressout`, `bitzer31c2_disc_press`, `bitzer31c2_evap_tempcel`, `bitzer31c2_evap_tempcol`, `bitzer31c2_cond_tempin`, `bitzer31c2_cond_tempout`, `bitzer31c2_temp_set`, `bitzer31c2_onoff_diff`, `bitzer31c2_evap_pressin`, `bitzer31c2_evap_pressout`, `bitzer31c2_cond_pressin`, `bitzer31c2_cond_pressout`, `clima48_disc_press`, `clima48_evap_tempcel`, `clima48_evap_tempcol`, `clima48_cond_tempin`, `clima48_cond_tempout`, `clima48_temp_set`, `clima48_onoff_diff`, `clima48_evap_pressin`, `clima48_evap_pressout`, `clima48_cond_pressin`, `clima48_cond_pressout`, `hitachi30c1_disc_press`, `hitachi30_evap_tempcel`, `hitachi30_evap_tempcol`, `hitachi30_cond_tempin`, `hitachi30_cond_tempout`, `hitachi30_temp_set`, `hitachi30_onoff_diff`, `hitachi30_evap_pressin`, `hitachi30_evap_pressout`, `hitachi30_cond_pressin`, `hitachi30_cond_pressout`, `hitachi30c2_disc_press`, `hitachi36c1_disc_press`, `hitachi36_evap_tempcel`, `hitachi36_evap_tempcol`, `hitachi36_cond_tempin`, `hitachi36_cond_tempout`, `hitachi36_temp_set`, `hitachi36_onoff_diff`, `hitachi36_evap_pressin`, `hitachi36_evap_pressout`, `hitachi36_cond_pressin`, `hitachi36_cond_pressout`, `hitachi36c2_disc_press`) VALUES
('2024-05-16', 'Shift 1', '1', '1.00', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00', '9.00', '10.00', '11.00', '12.00', '13.00', '14.00', '15.00', '16.00', '17.00', '18.00', '19.00', '20.00', '21.00', '22.00', '23.00', '24.00', '25.00', '26.00', '27.00', '28.00', '29.00', '30.00', '31.00', '32.00', '33.00', '34.00', '35.00', '36.00', '37.00', '38.00', '39.00', '40.00', '41.00', '42.00', '43.00', '44.00', '45.00', '46.00', '47.00', '48.00', '49.00', '50.00', '51.00', '52.00', '53.00', '54.00', '55.00', '56.00', '57.00'),
('2024-05-17', 'Shift 1', '1', '1.00', '2.00', '3.00', '4.00', '5.00', '6.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11.00', '12.00', '45.00', '5.00', NULL, NULL, '50.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chiller_trane_45met34`
--

CREATE TABLE IF NOT EXISTS `chiller_trane_45met34` (
  `tanggal` date NOT NULL,
  `shift` enum('shift1','shift2','shift3') NOT NULL,
  `time_period` enum('1','2','3') NOT NULL,
  `trane40_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane40_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane40_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane40_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane40_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane40_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane40_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane40_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane40_temp_set` decimal(5,2) DEFAULT NULL,
  `trane40_rla` decimal(5,2) DEFAULT NULL,
  `trane40_approach_temp` decimal(5,2) DEFAULT NULL,
  `trane41_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane41_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane41_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane41_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane41_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane41_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane41_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane41_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane41_temp_set` decimal(5,2) DEFAULT NULL,
  `trane41_rla` decimal(5,2) DEFAULT NULL,
  `trane41_approach_temp` decimal(5,2) DEFAULT NULL,
  `clivet47_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `clivet47_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `clivet47_cond_tempin` decimal(5,2) DEFAULT NULL,
  `clivet47_cond_tempout` decimal(5,2) DEFAULT NULL,
  `clivet47_evap_pressin` decimal(5,2) DEFAULT NULL,
  `clivet47_evap_pressout` decimal(5,2) DEFAULT NULL,
  `clivet47_cond_pressin` decimal(5,2) DEFAULT NULL,
  `clivet47_cond_pressout` decimal(5,2) DEFAULT NULL,
  `clivet47_temp_set` decimal(5,2) DEFAULT NULL,
  `clivet47_rla` decimal(5,2) DEFAULT NULL,
  `clivet47_approach_temp` decimal(5,2) DEFAULT NULL,
  `clivet49_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `clivet49_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `clivet49_cond_tempin` decimal(5,2) DEFAULT NULL,
  `clivet49_cond_tempout` decimal(5,2) DEFAULT NULL,
  `clivet49_evap_pressin` decimal(5,2) DEFAULT NULL,
  `clivet49_evap_pressout` decimal(5,2) DEFAULT NULL,
  `clivet49_cond_pressin` decimal(5,2) DEFAULT NULL,
  `clivet49_cond_pressout` decimal(5,2) DEFAULT NULL,
  `clivet49_temp_set` decimal(5,2) DEFAULT NULL,
  `clivet49_rla` decimal(5,2) DEFAULT NULL,
  `clivet49_approach_temp` decimal(5,2) DEFAULT NULL,
  `clivet50_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `clivet50_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `clivet50_cond_tempin` decimal(5,2) DEFAULT NULL,
  `clivet50_cond_tempout` decimal(5,2) DEFAULT NULL,
  `clivet50_evap_pressin` decimal(5,2) DEFAULT NULL,
  `clivet50_evap_pressout` decimal(5,2) DEFAULT NULL,
  `clivet50_cond_pressin` decimal(5,2) DEFAULT NULL,
  `clivet50_cond_pressout` decimal(5,2) DEFAULT NULL,
  `clivet50_temp_set` decimal(5,2) DEFAULT NULL,
  `clivet50_rla` decimal(5,2) DEFAULT NULL,
  `clivet50_approach_temp` decimal(5,2) DEFAULT NULL,
  UNIQUE KEY `tanggal` (`tanggal`,`shift`,`time_period`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chiller_trane_45met34`
--

INSERT INTO `chiller_trane_45met34` (`tanggal`, `shift`, `time_period`, `trane40_evap_tempcel`, `trane40_evap_tempcol`, `trane40_cond_tempin`, `trane40_cond_tempout`, `trane40_evap_pressin`, `trane40_evap_pressout`, `trane40_cond_pressin`, `trane40_cond_pressout`, `trane40_temp_set`, `trane40_rla`, `trane40_approach_temp`, `trane41_evap_tempcel`, `trane41_evap_tempcol`, `trane41_cond_tempin`, `trane41_cond_tempout`, `trane41_evap_pressin`, `trane41_evap_pressout`, `trane41_cond_pressin`, `trane41_cond_pressout`, `trane41_temp_set`, `trane41_rla`, `trane41_approach_temp`, `clivet47_evap_tempcel`, `clivet47_evap_tempcol`, `clivet47_cond_tempin`, `clivet47_cond_tempout`, `clivet47_evap_pressin`, `clivet47_evap_pressout`, `clivet47_cond_pressin`, `clivet47_cond_pressout`, `clivet47_temp_set`, `clivet47_rla`, `clivet47_approach_temp`, `clivet49_evap_tempcel`, `clivet49_evap_tempcol`, `clivet49_cond_tempin`, `clivet49_cond_tempout`, `clivet49_evap_pressin`, `clivet49_evap_pressout`, `clivet49_cond_pressin`, `clivet49_cond_pressout`, `clivet49_temp_set`, `clivet49_rla`, `clivet49_approach_temp`, `clivet50_evap_tempcel`, `clivet50_evap_tempcol`, `clivet50_cond_tempin`, `clivet50_cond_tempout`, `clivet50_evap_pressin`, `clivet50_evap_pressout`, `clivet50_cond_pressin`, `clivet50_cond_pressout`, `clivet50_temp_set`, `clivet50_rla`, `clivet50_approach_temp`) VALUES
('2024-05-17', 'shift1', '1', '1.00', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00', '9.00', '10.00', '11.00', '12.00', '13.00', '14.00', '15.00', '16.00', '17.00', '18.00', '19.00', '20.00', '21.00', '22.00', '23.00', '24.00', '25.00', '26.00', '27.00', '28.00', '29.00', '30.00', '31.00', '32.00', '33.00', '34.00', '35.00', '36.00', '37.00', '38.00', '39.00', '40.00', '41.00', '42.00', '43.00', '44.00', '45.00', '46.00', '47.00', '48.00', '49.00', '50.00', '51.00', '52.00', '53.00', '54.00', '55.00'),
('2024-05-19', 'shift1', '1', '2.00', '2.00', '1.00', '3.00', '2.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chiller_trane_67bopet`
--

CREATE TABLE IF NOT EXISTS `chiller_trane_67bopet` (
  `tanggal` date NOT NULL,
  `shift` enum('Shift 1','Shift 2','Shift 3') DEFAULT NULL,
  `time_period` enum('1','2','3') DEFAULT NULL,
  `trane31_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane31_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane31_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane31_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane31_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane31_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane31_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane31_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane31_temp_set` decimal(5,2) DEFAULT NULL,
  `trane31_rla` decimal(5,2) DEFAULT NULL,
  `trane31_approach_temp` decimal(5,2) DEFAULT NULL,
  `trane32_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane32_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane32_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane32_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane32_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane32_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane32_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane32_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane32_temp_set` decimal(5,2) DEFAULT NULL,
  `trane32_rla` decimal(5,2) DEFAULT NULL,
  `trane32_approach_temp` decimal(5,2) DEFAULT NULL,
  `trane39_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane39_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane39_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane39_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane39_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane39_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane39_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane39_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane39_temp_set` decimal(5,2) DEFAULT NULL,
  `trane39_rla` decimal(5,2) DEFAULT NULL,
  `trane39_approach_temp` decimal(5,2) DEFAULT NULL,
  `trane42_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane42_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane42_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane42_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane42_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane42_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane42_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane42_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane42_temp_set` decimal(5,2) DEFAULT NULL,
  `trane42_rla` decimal(5,2) DEFAULT NULL,
  `trane42_approach_temp` decimal(5,2) DEFAULT NULL,
  `trane43_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane43_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane43_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane43_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane43_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane43_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane43_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane43_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane43_temp_set` decimal(5,2) DEFAULT NULL,
  `trane43_rla` decimal(5,2) DEFAULT NULL,
  `trane43_approach_temp` decimal(5,2) DEFAULT NULL,
  `trane44_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane44_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane44_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane44_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane44_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane44_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane44_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane44_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane44_temp_set` decimal(5,2) DEFAULT NULL,
  `trane44_rla` decimal(5,2) DEFAULT NULL,
  `trane44_approach_temp` decimal(5,2) DEFAULT NULL,
  `trane45_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane45_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane45_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane45_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane45_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane45_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane45_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane45_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane45_temp_set` decimal(5,2) DEFAULT NULL,
  `trane45_rla` decimal(5,2) DEFAULT NULL,
  `trane45_approach_temp` decimal(5,2) DEFAULT NULL,
  UNIQUE KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chiller_trane_67bopet`
--

INSERT INTO `chiller_trane_67bopet` (`tanggal`, `shift`, `time_period`, `trane31_evap_tempcel`, `trane31_evap_tempcol`, `trane31_cond_tempin`, `trane31_cond_tempout`, `trane31_evap_pressin`, `trane31_evap_pressout`, `trane31_cond_pressin`, `trane31_cond_pressout`, `trane31_temp_set`, `trane31_rla`, `trane31_approach_temp`, `trane32_evap_tempcel`, `trane32_evap_tempcol`, `trane32_cond_tempin`, `trane32_cond_tempout`, `trane32_evap_pressin`, `trane32_evap_pressout`, `trane32_cond_pressin`, `trane32_cond_pressout`, `trane32_temp_set`, `trane32_rla`, `trane32_approach_temp`, `trane39_evap_tempcel`, `trane39_evap_tempcol`, `trane39_cond_tempin`, `trane39_cond_tempout`, `trane39_evap_pressin`, `trane39_evap_pressout`, `trane39_cond_pressin`, `trane39_cond_pressout`, `trane39_temp_set`, `trane39_rla`, `trane39_approach_temp`, `trane42_evap_tempcel`, `trane42_evap_tempcol`, `trane42_cond_tempin`, `trane42_cond_tempout`, `trane42_evap_pressin`, `trane42_evap_pressout`, `trane42_cond_pressin`, `trane42_cond_pressout`, `trane42_temp_set`, `trane42_rla`, `trane42_approach_temp`, `trane43_evap_tempcel`, `trane43_evap_tempcol`, `trane43_cond_tempin`, `trane43_cond_tempout`, `trane43_evap_pressin`, `trane43_evap_pressout`, `trane43_cond_pressin`, `trane43_cond_pressout`, `trane43_temp_set`, `trane43_rla`, `trane43_approach_temp`, `trane44_evap_tempcel`, `trane44_evap_tempcol`, `trane44_cond_tempin`, `trane44_cond_tempout`, `trane44_evap_pressin`, `trane44_evap_pressout`, `trane44_cond_pressin`, `trane44_cond_pressout`, `trane44_temp_set`, `trane44_rla`, `trane44_approach_temp`, `trane45_evap_tempcel`, `trane45_evap_tempcol`, `trane45_cond_tempin`, `trane45_cond_tempout`, `trane45_evap_pressin`, `trane45_evap_pressout`, `trane45_cond_pressin`, `trane45_cond_pressout`, `trane45_temp_set`, `trane45_rla`, `trane45_approach_temp`) VALUES
('0000-00-00', 'Shift 1', '1', '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-10', 'Shift 1', '1', '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-12', 'Shift 1', '1', '2.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-13', NULL, NULL, '111.00', '222.00', '444.00', '222.00', '444.00', NULL, NULL, NULL, NULL, NULL, NULL, '121.00', NULL, NULL, NULL, '55.00', '55.00', NULL, '77.00', '777.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '111.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '211.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22.00', '893.00'),
('2024-05-15', NULL, NULL, '1.00', '2.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-16', NULL, NULL, NULL, '5.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-27', NULL, NULL, '1.00', '2.00', '3.00', '4.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chiller_trane_coat14met12`
--

CREATE TABLE IF NOT EXISTS `chiller_trane_coat14met12` (
  `tanggal` date NOT NULL,
  `shift` enum('shift1','shift2','shift3') NOT NULL,
  `time_period` enum('1','2','3') NOT NULL,
  `trane46_evap_tempcel` decimal(5,2) DEFAULT NULL,
  `trane46_evap_tempcol` decimal(5,2) DEFAULT NULL,
  `trane46_cond_tempin` decimal(5,2) DEFAULT NULL,
  `trane46_cond_tempout` decimal(5,2) DEFAULT NULL,
  `trane46_evap_pressin` decimal(5,2) DEFAULT NULL,
  `trane46_evap_pressout` decimal(5,2) DEFAULT NULL,
  `trane46_cond_pressin` decimal(5,2) DEFAULT NULL,
  `trane46_cond_pressout` decimal(5,2) DEFAULT NULL,
  `trane46_temp_set` decimal(5,2) DEFAULT NULL,
  `trane46_rla` decimal(5,2) DEFAULT NULL,
  `trane46_approach_temp` decimal(5,2) DEFAULT NULL,
  UNIQUE KEY `tanggal` (`tanggal`,`shift`,`time_period`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chiller_trane_coat14met12`
--

INSERT INTO `chiller_trane_coat14met12` (`tanggal`, `shift`, `time_period`, `trane46_evap_tempcel`, `trane46_evap_tempcol`, `trane46_cond_tempin`, `trane46_cond_tempout`, `trane46_evap_pressin`, `trane46_evap_pressout`, `trane46_cond_pressin`, `trane46_cond_pressout`, `trane46_temp_set`, `trane46_rla`, `trane46_approach_temp`) VALUES
('2024-05-17', 'shift1', '1', '1.00', '2.00', '3.00', '4.00', '5.00', '6.00', '7.00', '8.00', '9.00', '10.00', '11.00');

-- --------------------------------------------------------

--
-- Table structure for table `common_unit`
--

CREATE TABLE IF NOT EXISTS `common_unit` (
  `tanggal` date NOT NULL,
  `dc_system_volt_8` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_10` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_12` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_14` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_16` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_18` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_20` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_22` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_0` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_2` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_4` decimal(5,2) DEFAULT NULL,
  `dc_system_volt_6` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_8` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_10` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_12` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_14` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_16` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_18` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_20` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_22` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_0` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_2` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_4` decimal(5,2) DEFAULT NULL,
  `lv_switchgear_6` decimal(5,2) DEFAULT NULL,
  `start_air_press1_8` decimal(5,2) DEFAULT NULL,
  `start_air_press1_10` decimal(5,2) DEFAULT NULL,
  `start_air_press1_12` decimal(5,2) DEFAULT NULL,
  `start_air_press1_14` decimal(5,2) DEFAULT NULL,
  `start_air_press1_16` decimal(5,2) DEFAULT NULL,
  `start_air_press1_18` decimal(5,2) DEFAULT NULL,
  `start_air_press1_20` decimal(5,2) DEFAULT NULL,
  `start_air_press1_22` decimal(5,2) DEFAULT NULL,
  `start_air_press1_0` decimal(5,2) DEFAULT NULL,
  `start_air_press1_2` decimal(5,2) DEFAULT NULL,
  `start_air_press1_4` decimal(5,2) DEFAULT NULL,
  `start_air_press1_6` decimal(5,2) DEFAULT NULL,
  `start_air_press2_8` decimal(5,2) DEFAULT NULL,
  `start_air_press2_10` decimal(5,2) DEFAULT NULL,
  `start_air_press2_12` decimal(5,2) DEFAULT NULL,
  `start_air_press2_14` decimal(5,2) DEFAULT NULL,
  `start_air_press2_16` decimal(5,2) DEFAULT NULL,
  `start_air_press2_18` decimal(5,2) DEFAULT NULL,
  `start_air_press2_20` decimal(5,2) DEFAULT NULL,
  `start_air_press2_22` decimal(5,2) DEFAULT NULL,
  `start_air_press2_0` decimal(5,2) DEFAULT NULL,
  `start_air_press2_2` decimal(5,2) DEFAULT NULL,
  `start_air_press2_4` decimal(5,2) DEFAULT NULL,
  `start_air_press2_6` decimal(5,2) DEFAULT NULL,
  `drain_start_8` decimal(5,2) DEFAULT NULL,
  `drain_start_10` decimal(5,2) DEFAULT NULL,
  `drain_start_12` decimal(5,2) DEFAULT NULL,
  `drain_start_14` decimal(5,2) DEFAULT NULL,
  `drain_start_16` decimal(5,2) DEFAULT NULL,
  `drain_start_18` decimal(5,2) DEFAULT NULL,
  `drain_start_20` decimal(5,2) DEFAULT NULL,
  `drain_start_22` decimal(5,2) DEFAULT NULL,
  `drain_start_0` decimal(5,2) DEFAULT NULL,
  `drain_start_2` decimal(5,2) DEFAULT NULL,
  `drain_start_4` decimal(5,2) DEFAULT NULL,
  `drain_start_6` decimal(5,2) DEFAULT NULL,
  `compressor1_8` decimal(5,2) DEFAULT NULL,
  `compressor1_10` decimal(5,2) DEFAULT NULL,
  `compressor1_12` decimal(5,2) DEFAULT NULL,
  `compressor1_14` decimal(5,2) DEFAULT NULL,
  `compressor1_16` decimal(5,2) DEFAULT NULL,
  `compressor1_18` decimal(5,2) DEFAULT NULL,
  `compressor1_20` decimal(5,2) DEFAULT NULL,
  `compressor1_22` decimal(5,2) DEFAULT NULL,
  `compressor1_0` decimal(5,2) DEFAULT NULL,
  `compressor1_2` decimal(5,2) DEFAULT NULL,
  `compressor1_4` decimal(5,2) DEFAULT NULL,
  `compressor1_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_oil1_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_6` enum('A','TA','RS') DEFAULT NULL,
  `compressor2_8` decimal(5,2) DEFAULT NULL,
  `compressor2_10` decimal(5,2) DEFAULT NULL,
  `compressor2_12` decimal(5,2) DEFAULT NULL,
  `compressor2_14` decimal(5,2) DEFAULT NULL,
  `compressor2_16` decimal(5,2) DEFAULT NULL,
  `compressor2_18` decimal(5,2) DEFAULT NULL,
  `compressor2_20` decimal(5,2) DEFAULT NULL,
  `compressor2_22` decimal(5,2) DEFAULT NULL,
  `compressor2_0` decimal(5,2) DEFAULT NULL,
  `compressor2_2` decimal(5,2) DEFAULT NULL,
  `compressor2_4` decimal(5,2) DEFAULT NULL,
  `compressor2_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_oil2_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_6` enum('A','TA','RS') DEFAULT NULL,
  `compressor3_8` decimal(5,2) DEFAULT NULL,
  `compressor3_10` decimal(5,2) DEFAULT NULL,
  `compressor3_12` decimal(5,2) DEFAULT NULL,
  `compressor3_14` decimal(5,2) DEFAULT NULL,
  `compressor3_16` decimal(5,2) DEFAULT NULL,
  `compressor3_18` decimal(5,2) DEFAULT NULL,
  `compressor3_20` decimal(5,2) DEFAULT NULL,
  `compressor3_22` decimal(5,2) DEFAULT NULL,
  `compressor3_0` decimal(5,2) DEFAULT NULL,
  `compressor3_2` decimal(5,2) DEFAULT NULL,
  `compressor3_4` decimal(5,2) DEFAULT NULL,
  `compressor3_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_oil3_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil3_6` enum('A','TA','RS') DEFAULT NULL,
  `outdoor_temp_8` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_10` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_12` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_14` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_16` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_18` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_20` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_22` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_0` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_2` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_4` decimal(5,2) DEFAULT NULL,
  `outdoor_temp_6` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `common_unit`
--

INSERT INTO `common_unit` (`tanggal`, `dc_system_volt_8`, `dc_system_volt_10`, `dc_system_volt_12`, `dc_system_volt_14`, `dc_system_volt_16`, `dc_system_volt_18`, `dc_system_volt_20`, `dc_system_volt_22`, `dc_system_volt_0`, `dc_system_volt_2`, `dc_system_volt_4`, `dc_system_volt_6`, `lv_switchgear_8`, `lv_switchgear_10`, `lv_switchgear_12`, `lv_switchgear_14`, `lv_switchgear_16`, `lv_switchgear_18`, `lv_switchgear_20`, `lv_switchgear_22`, `lv_switchgear_0`, `lv_switchgear_2`, `lv_switchgear_4`, `lv_switchgear_6`, `start_air_press1_8`, `start_air_press1_10`, `start_air_press1_12`, `start_air_press1_14`, `start_air_press1_16`, `start_air_press1_18`, `start_air_press1_20`, `start_air_press1_22`, `start_air_press1_0`, `start_air_press1_2`, `start_air_press1_4`, `start_air_press1_6`, `start_air_press2_8`, `start_air_press2_10`, `start_air_press2_12`, `start_air_press2_14`, `start_air_press2_16`, `start_air_press2_18`, `start_air_press2_20`, `start_air_press2_22`, `start_air_press2_0`, `start_air_press2_2`, `start_air_press2_4`, `start_air_press2_6`, `drain_start_8`, `drain_start_10`, `drain_start_12`, `drain_start_14`, `drain_start_16`, `drain_start_18`, `drain_start_20`, `drain_start_22`, `drain_start_0`, `drain_start_2`, `drain_start_4`, `drain_start_6`, `compressor1_8`, `compressor1_10`, `compressor1_12`, `compressor1_14`, `compressor1_16`, `compressor1_18`, `compressor1_20`, `compressor1_22`, `compressor1_0`, `compressor1_2`, `compressor1_4`, `compressor1_6`, `kebocoran_oil1_8`, `kebocoran_oil1_10`, `kebocoran_oil1_12`, `kebocoran_oil1_14`, `kebocoran_oil1_16`, `kebocoran_oil1_18`, `kebocoran_oil1_20`, `kebocoran_oil1_22`, `kebocoran_oil1_0`, `kebocoran_oil1_2`, `kebocoran_oil1_4`, `kebocoran_oil1_6`, `compressor2_8`, `compressor2_10`, `compressor2_12`, `compressor2_14`, `compressor2_16`, `compressor2_18`, `compressor2_20`, `compressor2_22`, `compressor2_0`, `compressor2_2`, `compressor2_4`, `compressor2_6`, `kebocoran_oil2_8`, `kebocoran_oil2_10`, `kebocoran_oil2_12`, `kebocoran_oil2_14`, `kebocoran_oil2_16`, `kebocoran_oil2_18`, `kebocoran_oil2_20`, `kebocoran_oil2_22`, `kebocoran_oil2_0`, `kebocoran_oil2_2`, `kebocoran_oil2_4`, `kebocoran_oil2_6`, `compressor3_8`, `compressor3_10`, `compressor3_12`, `compressor3_14`, `compressor3_16`, `compressor3_18`, `compressor3_20`, `compressor3_22`, `compressor3_0`, `compressor3_2`, `compressor3_4`, `compressor3_6`, `kebocoran_oil3_8`, `kebocoran_oil3_10`, `kebocoran_oil3_12`, `kebocoran_oil3_14`, `kebocoran_oil3_16`, `kebocoran_oil3_18`, `kebocoran_oil3_20`, `kebocoran_oil3_22`, `kebocoran_oil3_0`, `kebocoran_oil3_2`, `kebocoran_oil3_4`, `kebocoran_oil3_6`, `outdoor_temp_8`, `outdoor_temp_10`, `outdoor_temp_12`, `outdoor_temp_14`, `outdoor_temp_16`, `outdoor_temp_18`, `outdoor_temp_20`, `outdoor_temp_22`, `outdoor_temp_0`, `outdoor_temp_2`, `outdoor_temp_4`, `outdoor_temp_6`) VALUES
('2024-05-07', '100.00', '111.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-12', NULL, NULL, '222.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-19', '1.00', '2.00', '3.00', '4.00', '3.00', '2.00', '2.00', '21.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-28', '1.00', '2.00', '3.00', NULL, '5.00', '6.00', '7.00', '8.00', '9.00', '20.00', '21.00', '22.00', NULL, '3.00', '5.00', '1.00', '9.00', '10.00', '1.00', '12.00', '27.70', '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RS', NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-06-04', NULL, NULL, NULL, '2.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compressor`
--

CREATE TABLE IF NOT EXISTS `compressor` (
  `tanggal` date NOT NULL,
  `shift` enum('Shift 1','Shift 2','Shift 3') NOT NULL,
  `time_period` enum('1','2','3') NOT NULL,
  `line` enum('4&5','6&7') NOT NULL,
  `compkaeser19_disc_press` decimal(5,2) DEFAULT NULL,
  `compkaeser19_disc_temp` decimal(5,2) DEFAULT NULL,
  `compkaeser19_separator_press` decimal(5,2) DEFAULT NULL,
  `compkaeser19_oil_level` decimal(5,2) DEFAULT NULL,
  `compkaeser19_vibration` enum('H','S','T') DEFAULT NULL,
  `compkaeser19_noise` enum('H','S','T') DEFAULT NULL,
  `compkaeser19_run_hours` decimal(5,2) DEFAULT NULL,
  `compkaeser19_load_hours` decimal(5,2) DEFAULT NULL,
  `compboge01_disc_press` decimal(5,2) DEFAULT NULL,
  `compboge01_disc_temp` decimal(5,2) DEFAULT NULL,
  `compboge01_separator_press` decimal(5,2) DEFAULT NULL,
  `compboge01_oil_level` decimal(5,2) DEFAULT NULL,
  `compboge01_vibration` enum('H','S','T') DEFAULT NULL,
  `compboge01_noise` enum('H','S','T') DEFAULT NULL,
  `compboge01_run_hours` decimal(5,2) DEFAULT NULL,
  `compboge01_load_hours` decimal(5,2) DEFAULT NULL,
  `boge02_disc_press` decimal(5,2) DEFAULT NULL,
  `boge02_disc_temp` decimal(5,2) DEFAULT NULL,
  `boge02_separator_press` decimal(5,2) DEFAULT NULL,
  `boge02_oil_level` decimal(5,2) DEFAULT NULL,
  `boge02_vibration` enum('H','S','T') DEFAULT NULL,
  `boge02_noise` enum('H','S','T') DEFAULT NULL,
  `boge02_run_hours` decimal(5,2) DEFAULT NULL,
  `boge02_load_hours` decimal(5,2) DEFAULT NULL,
  `kaeser22_disc_press` decimal(5,2) DEFAULT NULL,
  `kaeser22_disc_temp` decimal(5,2) DEFAULT NULL,
  `kaeser22_separator_press` decimal(5,2) DEFAULT NULL,
  `kaeser22_oil_level` decimal(5,2) DEFAULT NULL,
  `kaeser22_vibration` enum('H','S','T') DEFAULT NULL,
  `kaeser22_noise` enum('H','S','T') DEFAULT NULL,
  `kaeser22_run_hours` decimal(5,2) DEFAULT NULL,
  `kaeser22_load_hours` decimal(5,2) DEFAULT NULL,
  `compsullair18_disc_press` decimal(5,2) DEFAULT NULL,
  `compsullair18_disc_temp` decimal(5,2) DEFAULT NULL,
  `compsullair18_separator_press` decimal(5,2) DEFAULT NULL,
  `compsullair18_oil_level` decimal(5,2) DEFAULT NULL,
  `compsullair18_vibration` enum('H','S','T') DEFAULT NULL,
  `compsullair18_noise` enum('H','S','T') DEFAULT NULL,
  `compsullair18_run_hours` decimal(5,2) DEFAULT NULL,
  `compsullair18_load_hours` decimal(5,2) DEFAULT NULL,
  `compsullair18_voltage` decimal(5,2) DEFAULT NULL,
  `compsullair18_current` decimal(5,2) DEFAULT NULL,
  `compsullair18_alarm` enum('A','TA') DEFAULT NULL,
  `compsullair20_disc_press` decimal(5,2) DEFAULT NULL,
  `compsullair20_disc_temp` decimal(5,2) DEFAULT NULL,
  `compsullair20_separator_press` decimal(5,2) DEFAULT NULL,
  `compsullair20_oil_level` decimal(5,2) DEFAULT NULL,
  `compsullair20_vibration` enum('H','S','T') DEFAULT NULL,
  `compsullair20_noise` enum('H','S','T') DEFAULT NULL,
  `compsullair20_run_hours` decimal(5,2) DEFAULT NULL,
  `compsullair20_load_hours` decimal(5,2) DEFAULT NULL,
  `compsullair20_voltage` decimal(5,2) DEFAULT NULL,
  `compsullair20_current` decimal(5,2) DEFAULT NULL,
  `compsullair21_disc_press` decimal(5,2) DEFAULT NULL,
  `compsullair21_disc_temp` decimal(5,2) DEFAULT NULL,
  `compsullair21_separator_press` decimal(5,2) DEFAULT NULL,
  `compsullair21_oil_level` decimal(5,2) DEFAULT NULL,
  `compsullair21_vibration` enum('H','S','T') DEFAULT NULL,
  `compsullair21_noise` enum('H','S','T') DEFAULT NULL,
  `compsullair21_run_hours` decimal(5,2) DEFAULT NULL,
  `compsullair21_load_hours` decimal(5,2) DEFAULT NULL,
  `compsullair21_voltage` decimal(5,2) DEFAULT NULL,
  `compsullair21_current` decimal(5,2) DEFAULT NULL,
  `compsullair23_disc_press` decimal(5,2) DEFAULT NULL,
  `compsullair23_disc_temp` decimal(5,2) DEFAULT NULL,
  `compsullair23_separator_press` decimal(5,2) DEFAULT NULL,
  `compsullair23_oil_level` decimal(5,2) DEFAULT NULL,
  `compsullair23_vibration` enum('H','S','T') DEFAULT NULL,
  `compsullair23_noise` enum('H','S','T') DEFAULT NULL,
  `compsullair23_run_hours` decimal(5,2) DEFAULT NULL,
  `compsullair23_load_hours` decimal(5,2) DEFAULT NULL,
  `compsullair23_voltage` decimal(5,2) DEFAULT NULL,
  `compsullair23_current` decimal(5,2) DEFAULT NULL,
  `compsullair24_disc_press` decimal(5,2) DEFAULT NULL,
  `compsullair24_disc_temp` decimal(5,2) DEFAULT NULL,
  `compsullair24_separator_press` decimal(5,2) DEFAULT NULL,
  `compsullair24_oil_level` decimal(5,2) DEFAULT NULL,
  `compsullair24_vibration` enum('H','S','T') DEFAULT NULL,
  `compsullair24_noise` enum('H','S','T') DEFAULT NULL,
  `compsullair24_run_hours` decimal(5,2) DEFAULT NULL,
  `compsullair24_load_hours` decimal(5,2) DEFAULT NULL,
  `compsullair24_voltage` decimal(5,2) DEFAULT NULL,
  `compsullair24_current` decimal(5,2) DEFAULT NULL,
  `compsullair24_alarm` enum('A','TA') DEFAULT NULL,
  `compsullair25_disc_press` decimal(5,2) DEFAULT NULL,
  `compsullair25_disc_temp` decimal(5,2) DEFAULT NULL,
  `compsullair25_separator_press` decimal(5,2) DEFAULT NULL,
  `compsullair25_oil_level` decimal(5,2) DEFAULT NULL,
  `compsullair25_vibration` enum('H','S','T') DEFAULT NULL,
  `compsullair25_noise` enum('H','S','T') DEFAULT NULL,
  `compsullair25_run_hours` decimal(5,2) DEFAULT NULL,
  `compsullair25_load_hours` decimal(5,2) DEFAULT NULL,
  `compsullair25_voltage` decimal(5,2) DEFAULT NULL,
  `compsullair25_current` decimal(5,2) DEFAULT NULL,
  `compsullair25_alarm` enum('A','TA') DEFAULT NULL,
  `compaugust28_disc_press` decimal(5,2) DEFAULT NULL,
  `compaugust28_disc_temp` decimal(5,2) DEFAULT NULL,
  `compaugust28_separator_press` decimal(5,2) DEFAULT NULL,
  `compaugust28_oil_level` decimal(5,2) DEFAULT NULL,
  `compaugust28_vibration` decimal(5,2) DEFAULT NULL,
  `compaugust28_noise` decimal(5,2) DEFAULT NULL,
  `compaugust28_run_hours` decimal(5,2) DEFAULT NULL,
  `compaugust28_load_hours` decimal(5,2) DEFAULT NULL,
  `compaugust28_voltage` decimal(5,2) DEFAULT NULL,
  `compaugust28_current` decimal(5,2) DEFAULT NULL,
  `compaugust29_disc_press` decimal(5,2) DEFAULT NULL,
  `compaugust29_disc_temp` decimal(5,2) DEFAULT NULL,
  `compaugust29_separator_press` decimal(5,2) DEFAULT NULL,
  `compaugust29_oil_level` decimal(5,2) DEFAULT NULL,
  `compaugust29_vibration` enum('H','S','T') DEFAULT NULL,
  `compaugust29_noise` enum('H','S','T') DEFAULT NULL,
  `compaugust29_run_hours` decimal(5,2) DEFAULT NULL,
  `compaugust29_load_hours` decimal(5,2) DEFAULT NULL,
  `compaugust29_voltage` decimal(5,2) DEFAULT NULL,
  `compaugust29_current` decimal(5,2) DEFAULT NULL,
  `compaugust30_disc_press` decimal(5,2) DEFAULT NULL,
  `compaugust30_disc_temp` decimal(5,2) DEFAULT NULL,
  `compaugust30_separator_press` decimal(5,2) DEFAULT NULL,
  `compaugust30_oil_level` decimal(5,2) DEFAULT NULL,
  `compaugust30_vibration` enum('H','S','T') DEFAULT NULL,
  `compaugust30_noise` enum('H','S','T') DEFAULT NULL,
  `compaugust30_run_hours` decimal(5,2) DEFAULT NULL,
  `compaugust30_load_hours` decimal(5,2) DEFAULT NULL,
  `compaugust30_voltage` decimal(5,2) DEFAULT NULL,
  `compaugust30_current` decimal(5,2) DEFAULT NULL,
  `adsullair34_disc_press` decimal(5,2) DEFAULT NULL,
  `adsullair34_disc_temp` decimal(5,2) DEFAULT NULL,
  `adsullair34_separator_press` decimal(5,2) DEFAULT NULL,
  `adsullair34_oil_level` decimal(5,2) DEFAULT NULL,
  `adsullair34_vibration` enum('H','S','T') DEFAULT NULL,
  `adsullair34_noise` enum('H','S','T') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compressor`
--

INSERT INTO `compressor` (`tanggal`, `shift`, `time_period`, `line`, `compkaeser19_disc_press`, `compkaeser19_disc_temp`, `compkaeser19_separator_press`, `compkaeser19_oil_level`, `compkaeser19_vibration`, `compkaeser19_noise`, `compkaeser19_run_hours`, `compkaeser19_load_hours`, `compboge01_disc_press`, `compboge01_disc_temp`, `compboge01_separator_press`, `compboge01_oil_level`, `compboge01_vibration`, `compboge01_noise`, `compboge01_run_hours`, `compboge01_load_hours`, `boge02_disc_press`, `boge02_disc_temp`, `boge02_separator_press`, `boge02_oil_level`, `boge02_vibration`, `boge02_noise`, `boge02_run_hours`, `boge02_load_hours`, `kaeser22_disc_press`, `kaeser22_disc_temp`, `kaeser22_separator_press`, `kaeser22_oil_level`, `kaeser22_vibration`, `kaeser22_noise`, `kaeser22_run_hours`, `kaeser22_load_hours`, `compsullair18_disc_press`, `compsullair18_disc_temp`, `compsullair18_separator_press`, `compsullair18_oil_level`, `compsullair18_vibration`, `compsullair18_noise`, `compsullair18_run_hours`, `compsullair18_load_hours`, `compsullair18_voltage`, `compsullair18_current`, `compsullair18_alarm`, `compsullair20_disc_press`, `compsullair20_disc_temp`, `compsullair20_separator_press`, `compsullair20_oil_level`, `compsullair20_vibration`, `compsullair20_noise`, `compsullair20_run_hours`, `compsullair20_load_hours`, `compsullair20_voltage`, `compsullair20_current`, `compsullair21_disc_press`, `compsullair21_disc_temp`, `compsullair21_separator_press`, `compsullair21_oil_level`, `compsullair21_vibration`, `compsullair21_noise`, `compsullair21_run_hours`, `compsullair21_load_hours`, `compsullair21_voltage`, `compsullair21_current`, `compsullair23_disc_press`, `compsullair23_disc_temp`, `compsullair23_separator_press`, `compsullair23_oil_level`, `compsullair23_vibration`, `compsullair23_noise`, `compsullair23_run_hours`, `compsullair23_load_hours`, `compsullair23_voltage`, `compsullair23_current`, `compsullair24_disc_press`, `compsullair24_disc_temp`, `compsullair24_separator_press`, `compsullair24_oil_level`, `compsullair24_vibration`, `compsullair24_noise`, `compsullair24_run_hours`, `compsullair24_load_hours`, `compsullair24_voltage`, `compsullair24_current`, `compsullair24_alarm`, `compsullair25_disc_press`, `compsullair25_disc_temp`, `compsullair25_separator_press`, `compsullair25_oil_level`, `compsullair25_vibration`, `compsullair25_noise`, `compsullair25_run_hours`, `compsullair25_load_hours`, `compsullair25_voltage`, `compsullair25_current`, `compsullair25_alarm`, `compaugust28_disc_press`, `compaugust28_disc_temp`, `compaugust28_separator_press`, `compaugust28_oil_level`, `compaugust28_vibration`, `compaugust28_noise`, `compaugust28_run_hours`, `compaugust28_load_hours`, `compaugust28_voltage`, `compaugust28_current`, `compaugust29_disc_press`, `compaugust29_disc_temp`, `compaugust29_separator_press`, `compaugust29_oil_level`, `compaugust29_vibration`, `compaugust29_noise`, `compaugust29_run_hours`, `compaugust29_load_hours`, `compaugust29_voltage`, `compaugust29_current`, `compaugust30_disc_press`, `compaugust30_disc_temp`, `compaugust30_separator_press`, `compaugust30_oil_level`, `compaugust30_vibration`, `compaugust30_noise`, `compaugust30_run_hours`, `compaugust30_load_hours`, `compaugust30_voltage`, `compaugust30_current`, `adsullair34_disc_press`, `adsullair34_disc_temp`, `adsullair34_separator_press`, `adsullair34_oil_level`, `adsullair34_vibration`, `adsullair34_noise`) VALUES
('2024-05-21', 'Shift 1', '1', '4&5', '1.00', NULL, NULL, NULL, 'H', NULL, NULL, NULL, '2.00', '2.00', NULL, NULL, NULL, 'T', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-27', 'Shift 1', '1', '4&5', '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_booster`
--

CREATE TABLE IF NOT EXISTS `fuel_booster` (
  `tanggal` date NOT NULL,
  `operating_pump1_8` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_10` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_12` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_16` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_18` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_20` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_0` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_2` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_4` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_6` enum('ON','OFF') DEFAULT NULL,
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
  `operating_pump2_8` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_10` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_12` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_16` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_18` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_20` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_0` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_2` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_4` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_6` enum('ON','OFF') DEFAULT NULL,
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
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL,
  `flowrate_booster_8_14` decimal(5,2) DEFAULT NULL,
  `flowrate_booster_16_22` decimal(5,2) DEFAULT NULL,
  `flowrate_booster_0_6` decimal(5,2) DEFAULT NULL,
  `flowrate_monitor_8_14` decimal(5,2) DEFAULT NULL,
  `flowrate_monitor_16_22` decimal(5,2) DEFAULT NULL,
  `flowrate_monitor_0_6` decimal(5,2) DEFAULT NULL,
  `hfo_lfo_8_14` enum('HFO','LFO') DEFAULT NULL,
  `hfo_lfo_16_22` enum('HFO','LFO') DEFAULT NULL,
  `hfo_lfo_0_6` enum('HFO','LFO') DEFAULT NULL,
  `feed_pressure_8` decimal(5,2) DEFAULT NULL,
  `feed_pressure_10` decimal(5,2) DEFAULT NULL,
  `feed_pressure_12` decimal(5,2) DEFAULT NULL,
  `feed_pressure_14` decimal(5,2) DEFAULT NULL,
  `feed_pressure_16` decimal(5,2) DEFAULT NULL,
  `feed_pressure_18` decimal(5,2) DEFAULT NULL,
  `feed_pressure_20` decimal(5,2) DEFAULT NULL,
  `feed_pressure_22` decimal(5,2) DEFAULT NULL,
  `feed_pressure_0` decimal(5,2) DEFAULT NULL,
  `feed_pressure_2` decimal(5,2) DEFAULT NULL,
  `feed_pressure_4` decimal(5,2) DEFAULT NULL,
  `feed_pressure_6` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_8` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_10` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_12` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_14` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_16` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_18` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_20` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_22` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_0` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_2` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_4` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_6` decimal(5,2) DEFAULT NULL,
  `fuel_temp_8` decimal(5,2) DEFAULT NULL,
  `fuel_temp_10` decimal(5,2) DEFAULT NULL,
  `fuel_temp_12` decimal(5,2) DEFAULT NULL,
  `fuel_temp_14` decimal(5,2) DEFAULT NULL,
  `fuel_temp_16` decimal(5,2) DEFAULT NULL,
  `fuel_temp_18` decimal(5,2) DEFAULT NULL,
  `fuel_temp_20` decimal(5,2) DEFAULT NULL,
  `fuel_temp_22` decimal(5,2) DEFAULT NULL,
  `fuel_temp_0` decimal(5,2) DEFAULT NULL,
  `fuel_temp_2` decimal(5,2) DEFAULT NULL,
  `fuel_temp_4` decimal(5,2) DEFAULT NULL,
  `fuel_temp_6` decimal(5,2) DEFAULT NULL,
  `fuel_visc_8` decimal(5,2) DEFAULT NULL,
  `fuel_visc_10` decimal(5,2) DEFAULT NULL,
  `fuel_visc_12` decimal(5,2) DEFAULT NULL,
  `fuel_visc_14` decimal(5,2) DEFAULT NULL,
  `fuel_visc_16` decimal(5,2) DEFAULT NULL,
  `fuel_visc_18` decimal(5,2) DEFAULT NULL,
  `fuel_visc_20` decimal(5,2) DEFAULT NULL,
  `fuel_visc_22` decimal(5,2) DEFAULT NULL,
  `fuel_visc_0` decimal(5,2) DEFAULT NULL,
  `fuel_visc_2` decimal(5,2) DEFAULT NULL,
  `fuel_visc_4` decimal(5,2) DEFAULT NULL,
  `fuel_visc_6` decimal(5,2) DEFAULT NULL,
  `flushing_count_8_14` int(10) DEFAULT NULL,
  `flushing_count_16_22` int(10) DEFAULT NULL,
  `flushing_count_0_6` int(10) DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_booster`
--

INSERT INTO `fuel_booster` (`tanggal`, `operating_pump1_8`, `operating_pump1_10`, `operating_pump1_12`, `operating_pump1_14`, `operating_pump1_16`, `operating_pump1_18`, `operating_pump1_20`, `operating_pump1_22`, `operating_pump1_0`, `operating_pump1_2`, `operating_pump1_4`, `operating_pump1_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8`, `operating_pump2_10`, `operating_pump2_12`, `operating_pump2_14`, `operating_pump2_16`, `operating_pump2_18`, `operating_pump2_20`, `operating_pump2_22`, `operating_pump2_0`, `operating_pump2_2`, `operating_pump2_4`, `operating_pump2_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`, `flowrate_booster_8_14`, `flowrate_booster_16_22`, `flowrate_booster_0_6`, `flowrate_monitor_8_14`, `flowrate_monitor_16_22`, `flowrate_monitor_0_6`, `hfo_lfo_8_14`, `hfo_lfo_16_22`, `hfo_lfo_0_6`, `feed_pressure_8`, `feed_pressure_10`, `feed_pressure_12`, `feed_pressure_14`, `feed_pressure_16`, `feed_pressure_18`, `feed_pressure_20`, `feed_pressure_22`, `feed_pressure_0`, `feed_pressure_2`, `feed_pressure_4`, `feed_pressure_6`, `outlet_pressure_8`, `outlet_pressure_10`, `outlet_pressure_12`, `outlet_pressure_14`, `outlet_pressure_16`, `outlet_pressure_18`, `outlet_pressure_20`, `outlet_pressure_22`, `outlet_pressure_0`, `outlet_pressure_2`, `outlet_pressure_4`, `outlet_pressure_6`, `fuel_temp_8`, `fuel_temp_10`, `fuel_temp_12`, `fuel_temp_14`, `fuel_temp_16`, `fuel_temp_18`, `fuel_temp_20`, `fuel_temp_22`, `fuel_temp_0`, `fuel_temp_2`, `fuel_temp_4`, `fuel_temp_6`, `fuel_visc_8`, `fuel_visc_10`, `fuel_visc_12`, `fuel_visc_14`, `fuel_visc_16`, `fuel_visc_18`, `fuel_visc_20`, `fuel_visc_22`, `fuel_visc_0`, `fuel_visc_2`, `fuel_visc_4`, `fuel_visc_6`, `flushing_count_8_14`, `flushing_count_16_22`, `flushing_count_0_6`) VALUES
('2024-06-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 'HFO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_oil_feeder`
--

CREATE TABLE IF NOT EXISTS `fuel_oil_feeder` (
  `tanggal` date NOT NULL,
  `operating_pump1_8` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_10` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_12` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_16` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_18` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_20` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_0` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_2` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_4` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_6` enum('ON','OFF') DEFAULT NULL,
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
  `operating_pump2_8` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_10` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_12` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_16` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_18` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_20` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_0` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_2` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_4` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_6` enum('ON','OFF') DEFAULT NULL,
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
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL,
  `outlet_pressure_8` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_10` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_12` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_14` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_16` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_18` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_20` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_22` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_0` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_2` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_4` decimal(5,2) DEFAULT NULL,
  `outlet_pressure_6` decimal(5,2) DEFAULT NULL,
  `outlet_temp_8` decimal(5,2) DEFAULT NULL,
  `outlet_temp_10` decimal(5,2) DEFAULT NULL,
  `outlet_temp_12` decimal(5,2) DEFAULT NULL,
  `outlet_temp_14` decimal(5,2) DEFAULT NULL,
  `outlet_temp_16` decimal(5,2) DEFAULT NULL,
  `outlet_temp_18` decimal(5,2) DEFAULT NULL,
  `outlet_temp_20` decimal(5,2) DEFAULT NULL,
  `outlet_temp_22` decimal(5,2) DEFAULT NULL,
  `outlet_temp_0` decimal(5,2) DEFAULT NULL,
  `outlet_temp_2` decimal(5,2) DEFAULT NULL,
  `outlet_temp_4` decimal(5,2) DEFAULT NULL,
  `outlet_temp_6` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_oil_feeder`
--

INSERT INTO `fuel_oil_feeder` (`tanggal`, `operating_pump1_8`, `operating_pump1_10`, `operating_pump1_12`, `operating_pump1_14`, `operating_pump1_16`, `operating_pump1_18`, `operating_pump1_20`, `operating_pump1_22`, `operating_pump1_0`, `operating_pump1_2`, `operating_pump1_4`, `operating_pump1_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8`, `operating_pump2_10`, `operating_pump2_12`, `operating_pump2_14`, `operating_pump2_16`, `operating_pump2_18`, `operating_pump2_20`, `operating_pump2_22`, `operating_pump2_0`, `operating_pump2_2`, `operating_pump2_4`, `operating_pump2_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`, `outlet_pressure_8`, `outlet_pressure_10`, `outlet_pressure_12`, `outlet_pressure_14`, `outlet_pressure_16`, `outlet_pressure_18`, `outlet_pressure_20`, `outlet_pressure_22`, `outlet_pressure_0`, `outlet_pressure_2`, `outlet_pressure_4`, `outlet_pressure_6`, `outlet_temp_8`, `outlet_temp_10`, `outlet_temp_12`, `outlet_temp_14`, `outlet_temp_16`, `outlet_temp_18`, `outlet_temp_20`, `outlet_temp_22`, `outlet_temp_0`, `outlet_temp_2`, `outlet_temp_4`, `outlet_temp_6`) VALUES
('2024-06-05', 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_transfer_pump_unit`
--

CREATE TABLE IF NOT EXISTS `fuel_transfer_pump_unit` (
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
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuel_transfer_pump_unit`
--

INSERT INTO `fuel_transfer_pump_unit` (`tanggal`, `operating_pump1_8_14`, `operating_pump1_16_22`, `operating_pump1_0_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8_14`, `operating_pump2_16_22`, `operating_pump2_0_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`) VALUES
('2024-04-24', 'OFF', 'OFF', 'ON', 'TA', 'TA', 'A', 'A', 'RS', 'A', 'TA', 'A', 'TA', 'A', 'RS', 'A', 'ON', 'ON', 'ON', 'A', 'A', 'TA', 'A', 'RS', 'A', 'TA', 'A', 'TA', 'A', 'A', 'A'),
('2024-04-30', 'ON', 'OFF', 'ON', 'RS', NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-02', 'ON', 'OFF', 'ON', NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-03', 'ON', NULL, NULL, NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-27', 'ON', 'OFF', NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genset_man`
--

CREATE TABLE IF NOT EXISTS `genset_man` (
  `tanggal` date NOT NULL,
  `running_hours_8_14` decimal(5,2) DEFAULT NULL,
  `running_hours_16_22` decimal(5,2) DEFAULT NULL,
  `running_hours_0_6` decimal(5,2) DEFAULT NULL,
  `breaker_position_8_14` enum('ON','OFF') DEFAULT NULL,
  `breaker_position_16_22` enum('ON','OFF') DEFAULT NULL,
  `breaker_position_0_6` enum('ON','OFF') DEFAULT NULL,
  `energy_switch_8_14` enum('ON','OFF') DEFAULT NULL,
  `energy_switch_16_22` enum('ON','OFF') DEFAULT NULL,
  `energy_switch_0_6` enum('ON','OFF') DEFAULT NULL,
  `switch_mode_8_14` enum('auto','manual') DEFAULT NULL,
  `switch_mode_16_22` enum('auto','manual') DEFAULT NULL,
  `switch_mode_0_6` enum('auto','manual') DEFAULT NULL,
  `warming_up_8_14` enum('yes','no') DEFAULT NULL,
  `warming_up_16_22` enum('yes','no') DEFAULT NULL,
  `warming_up_0_6` enum('yes','no') DEFAULT NULL,
  `voltage_battery_8` decimal(5,2) DEFAULT NULL,
  `voltage_battery_10` decimal(5,2) DEFAULT NULL,
  `voltage_battery_12` decimal(5,2) DEFAULT NULL,
  `voltage_battery_14` decimal(5,2) DEFAULT NULL,
  `voltage_battery_16` decimal(5,2) DEFAULT NULL,
  `voltage_battery_18` decimal(5,2) DEFAULT NULL,
  `voltage_battery_20` decimal(5,2) DEFAULT NULL,
  `voltage_battery_22` decimal(5,2) DEFAULT NULL,
  `voltage_battery_0` decimal(5,2) DEFAULT NULL,
  `voltage_battery_2` decimal(5,2) DEFAULT NULL,
  `voltage_battery_4` decimal(5,2) DEFAULT NULL,
  `voltage_battery_6` decimal(5,2) DEFAULT NULL,
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
  `kebocoran_fuel_6` enum('A','TA','RS') DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genset_man`
--

INSERT INTO `genset_man` (`tanggal`, `running_hours_8_14`, `running_hours_16_22`, `running_hours_0_6`, `breaker_position_8_14`, `breaker_position_16_22`, `breaker_position_0_6`, `energy_switch_8_14`, `energy_switch_16_22`, `energy_switch_0_6`, `switch_mode_8_14`, `switch_mode_16_22`, `switch_mode_0_6`, `warming_up_8_14`, `warming_up_16_22`, `warming_up_0_6`, `voltage_battery_8`, `voltage_battery_10`, `voltage_battery_12`, `voltage_battery_14`, `voltage_battery_16`, `voltage_battery_18`, `voltage_battery_20`, `voltage_battery_22`, `voltage_battery_0`, `voltage_battery_2`, `voltage_battery_4`, `voltage_battery_6`, `kebocoran_fuel_8`, `kebocoran_fuel_10`, `kebocoran_fuel_12`, `kebocoran_fuel_14`, `kebocoran_fuel_16`, `kebocoran_fuel_18`, `kebocoran_fuel_20`, `kebocoran_fuel_22`, `kebocoran_fuel_0`, `kebocoran_fuel_2`, `kebocoran_fuel_4`, `kebocoran_fuel_6`) VALUES
('2024-06-05', '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genset_wartsila_01`
--

CREATE TABLE IF NOT EXISTS `genset_wartsila_01` (
  `tanggal` date NOT NULL,
  `running_hrs_8_14` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `running_hrs_16_22` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `running_hrs_0_6` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lube_oil_sump_lvl_8_14` decimal(5,2) DEFAULT NULL,
  `lube_oil_sump_lvl_16_22` decimal(5,2) DEFAULT NULL,
  `lube_oil_sump_lvl_0_6` decimal(5,2) DEFAULT NULL,
  `anti_cond_heater_8_14` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anti_cond_heater_16_22` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anti_cond_heater_0_6` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_8` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_10` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_12` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_14` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_16` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_18` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_20` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_22` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_0` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_2` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_4` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_6` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `kebocoran_oil_8` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_10` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_12` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_14` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_16` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_18` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_20` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_22` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_0` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_2` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_4` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_6` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_8` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_10` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_12` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_14` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_16` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_18` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_20` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_22` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_0` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_2` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_4` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_6` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `kebocoran_fuel_8` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_10` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_12` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_14` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_16` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_18` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_20` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_22` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_0` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_2` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_4` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_6` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`tanggal`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genset_wartsila_01`
--

INSERT INTO `genset_wartsila_01` (`tanggal`, `running_hrs_8_14`, `running_hrs_16_22`, `running_hrs_0_6`, `lube_oil_sump_lvl_8_14`, `lube_oil_sump_lvl_16_22`, `lube_oil_sump_lvl_0_6`, `anti_cond_heater_8_14`, `anti_cond_heater_16_22`, `anti_cond_heater_0_6`, `prelube_pump_8`, `prelube_pump_10`, `prelube_pump_12`, `prelube_pump_14`, `prelube_pump_16`, `prelube_pump_18`, `prelube_pump_20`, `prelube_pump_22`, `prelube_pump_0`, `prelube_pump_2`, `prelube_pump_4`, `prelube_pump_6`, `prelube_pump_press_8`, `prelube_pump_press_10`, `prelube_pump_press_12`, `prelube_pump_press_14`, `prelube_pump_press_16`, `prelube_pump_press_18`, `prelube_pump_press_20`, `prelube_pump_press_22`, `prelube_pump_press_0`, `prelube_pump_press_2`, `prelube_pump_press_4`, `prelube_pump_press_6`, `kebocoran_oil_8`, `kebocoran_oil_10`, `kebocoran_oil_12`, `kebocoran_oil_14`, `kebocoran_oil_16`, `kebocoran_oil_18`, `kebocoran_oil_20`, `kebocoran_oil_22`, `kebocoran_oil_0`, `kebocoran_oil_2`, `kebocoran_oil_4`, `kebocoran_oil_6`, `preheat_unit_8`, `preheat_unit_10`, `preheat_unit_12`, `preheat_unit_14`, `preheat_unit_16`, `preheat_unit_18`, `preheat_unit_20`, `preheat_unit_22`, `preheat_unit_0`, `preheat_unit_2`, `preheat_unit_4`, `preheat_unit_6`, `ht_water_outlet_temp_8`, `ht_water_outlet_temp_10`, `ht_water_outlet_temp_12`, `ht_water_outlet_temp_14`, `ht_water_outlet_temp_16`, `ht_water_outlet_temp_18`, `ht_water_outlet_temp_20`, `ht_water_outlet_temp_22`, `ht_water_outlet_temp_0`, `ht_water_outlet_temp_2`, `ht_water_outlet_temp_4`, `ht_water_outlet_temp_6`, `ht_expantion_tank_lvl_8_14`, `ht_expantion_tank_lvl_16_22`, `ht_expantion_tank_lvl_0_6`, `lt_expantion_tank_lvl_8_14`, `lt_expantion_tank_lvl_16_22`, `lt_expantion_tank_lvl_0_6`, `warming_up_8_14`, `warming_up_16_22`, `warming_up_0_6`, `fuel_oil_inlet_temp_8`, `fuel_oil_inlet_temp_10`, `fuel_oil_inlet_temp_12`, `fuel_oil_inlet_temp_14`, `fuel_oil_inlet_temp_16`, `fuel_oil_inlet_temp_18`, `fuel_oil_inlet_temp_20`, `fuel_oil_inlet_temp_22`, `fuel_oil_inlet_temp_0`, `fuel_oil_inlet_temp_2`, `fuel_oil_inlet_temp_4`, `fuel_oil_inlet_temp_6`, `fuel_oil_inlet_pressure_8`, `fuel_oil_inlet_pressure_10`, `fuel_oil_inlet_pressure_12`, `fuel_oil_inlet_pressure_14`, `fuel_oil_inlet_pressure_16`, `fuel_oil_inlet_pressure_18`, `fuel_oil_inlet_pressure_20`, `fuel_oil_inlet_pressure_22`, `fuel_oil_inlet_pressure_0`, `fuel_oil_inlet_pressure_2`, `fuel_oil_inlet_pressure_4`, `fuel_oil_inlet_pressure_6`, `kebocoran_fuel_8`, `kebocoran_fuel_10`, `kebocoran_fuel_12`, `kebocoran_fuel_14`, `kebocoran_fuel_16`, `kebocoran_fuel_18`, `kebocoran_fuel_20`, `kebocoran_fuel_22`, `kebocoran_fuel_0`, `kebocoran_fuel_2`, `kebocoran_fuel_4`, `kebocoran_fuel_6`) VALUES
('2024-04-24', '2', '', '', '4.00', '0.00', '0.00', 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-04-25', '2', '2', '', '13.00', '14.00', '0.00', 'ON', 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-04-29', '1', '2', '3', '14.00', '15.00', '0.00', 'OFF', NULL, NULL, 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RS'),
('2024-04-30', '1', NULL, '3', NULL, NULL, NULL, NULL, 'ON', NULL, 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-02', '1', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-03', '1', NULL, NULL, '14.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-12', NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-13', '1', '2', '3', '55.00', '22.00', '11.00', 'OFF', 'ON', 'OFF', NULL, NULL, NULL, 'ON', 'OFF', 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22.00', '11.00', '11.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TA', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22.00', NULL, NULL, NULL, NULL, NULL, NULL, '55.00', '22.00', NULL, NULL, NULL, '11.00', NULL, '0.06', NULL, NULL, NULL, NULL, NULL, '3.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TA', NULL, NULL, 'A', NULL, 'RS', NULL, NULL, NULL),
('2024-05-24', '1', '1', NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-27', '1', '2', NULL, '2.00', '1.00', NULL, 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-28', '1', '2', '3', '2.50', '5.00', '6.00', 'ON', 'ON', NULL, 'ON', NULL, 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.00', '4.00', '5.00', '5.00', '7.50', '2.00', NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.00', '5.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genset_wartsila_02`
--

CREATE TABLE IF NOT EXISTS `genset_wartsila_02` (
  `tanggal` date NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `running_hrs_8_14` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `running_hrs_16_22` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `running_hrs_0_6` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lube_oil_sump_lvl_8_14` decimal(5,2) DEFAULT NULL,
  `lube_oil_sump_lvl_16_22` decimal(5,2) DEFAULT NULL,
  `lube_oil_sump_lvl_0_6` decimal(5,2) DEFAULT NULL,
  `anti_cond_heater_8_14` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anti_cond_heater_16_22` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anti_cond_heater_0_6` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_8` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_10` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_12` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_14` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_16` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_18` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_20` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_22` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_0` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_2` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_4` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prelube_pump_6` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `kebocoran_oil_8` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_10` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_12` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_14` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_16` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_18` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_20` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_22` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_0` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_2` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_4` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_oil_6` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_8` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_10` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_12` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_14` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_16` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_18` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_20` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_22` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_0` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_2` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_4` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preheat_unit_6` enum('ON','OFF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `kebocoran_fuel_8` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_10` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_12` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_14` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_16` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_18` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_20` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_22` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_0` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_2` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_4` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebocoran_fuel_6` enum('A','TA','RS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`tanggal`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genset_wartsila_02`
--

INSERT INTO `genset_wartsila_02` (`tanggal`, `nama`, `running_hrs_8_14`, `running_hrs_16_22`, `running_hrs_0_6`, `lube_oil_sump_lvl_8_14`, `lube_oil_sump_lvl_16_22`, `lube_oil_sump_lvl_0_6`, `anti_cond_heater_8_14`, `anti_cond_heater_16_22`, `anti_cond_heater_0_6`, `prelube_pump_8`, `prelube_pump_10`, `prelube_pump_12`, `prelube_pump_14`, `prelube_pump_16`, `prelube_pump_18`, `prelube_pump_20`, `prelube_pump_22`, `prelube_pump_0`, `prelube_pump_2`, `prelube_pump_4`, `prelube_pump_6`, `prelube_pump_press_8`, `prelube_pump_press_10`, `prelube_pump_press_12`, `prelube_pump_press_14`, `prelube_pump_press_16`, `prelube_pump_press_18`, `prelube_pump_press_20`, `prelube_pump_press_22`, `prelube_pump_press_0`, `prelube_pump_press_2`, `prelube_pump_press_4`, `prelube_pump_press_6`, `kebocoran_oil_8`, `kebocoran_oil_10`, `kebocoran_oil_12`, `kebocoran_oil_14`, `kebocoran_oil_16`, `kebocoran_oil_18`, `kebocoran_oil_20`, `kebocoran_oil_22`, `kebocoran_oil_0`, `kebocoran_oil_2`, `kebocoran_oil_4`, `kebocoran_oil_6`, `preheat_unit_8`, `preheat_unit_10`, `preheat_unit_12`, `preheat_unit_14`, `preheat_unit_16`, `preheat_unit_18`, `preheat_unit_20`, `preheat_unit_22`, `preheat_unit_0`, `preheat_unit_2`, `preheat_unit_4`, `preheat_unit_6`, `ht_water_outlet_temp_8`, `ht_water_outlet_temp_10`, `ht_water_outlet_temp_12`, `ht_water_outlet_temp_14`, `ht_water_outlet_temp_16`, `ht_water_outlet_temp_18`, `ht_water_outlet_temp_20`, `ht_water_outlet_temp_22`, `ht_water_outlet_temp_0`, `ht_water_outlet_temp_2`, `ht_water_outlet_temp_4`, `ht_water_outlet_temp_6`, `ht_expantion_tank_lvl_8_14`, `ht_expantion_tank_lvl_16_22`, `ht_expantion_tank_lvl_0_6`, `lt_expantion_tank_lvl_8_14`, `lt_expantion_tank_lvl_16_22`, `lt_expantion_tank_lvl_0_6`, `warming_up_8_14`, `warming_up_16_22`, `warming_up_0_6`, `fuel_oil_inlet_temp_8`, `fuel_oil_inlet_temp_10`, `fuel_oil_inlet_temp_12`, `fuel_oil_inlet_temp_14`, `fuel_oil_inlet_temp_16`, `fuel_oil_inlet_temp_18`, `fuel_oil_inlet_temp_20`, `fuel_oil_inlet_temp_22`, `fuel_oil_inlet_temp_0`, `fuel_oil_inlet_temp_2`, `fuel_oil_inlet_temp_4`, `fuel_oil_inlet_temp_6`, `fuel_oil_inlet_pressure_8`, `fuel_oil_inlet_pressure_10`, `fuel_oil_inlet_pressure_12`, `fuel_oil_inlet_pressure_14`, `fuel_oil_inlet_pressure_16`, `fuel_oil_inlet_pressure_18`, `fuel_oil_inlet_pressure_20`, `fuel_oil_inlet_pressure_22`, `fuel_oil_inlet_pressure_0`, `fuel_oil_inlet_pressure_2`, `fuel_oil_inlet_pressure_4`, `fuel_oil_inlet_pressure_6`, `kebocoran_fuel_8`, `kebocoran_fuel_10`, `kebocoran_fuel_12`, `kebocoran_fuel_14`, `kebocoran_fuel_16`, `kebocoran_fuel_18`, `kebocoran_fuel_20`, `kebocoran_fuel_22`, `kebocoran_fuel_0`, `kebocoran_fuel_2`, `kebocoran_fuel_4`, `kebocoran_fuel_6`) VALUES
('2024-04-24', '', '1', '2', '3', '0.00', '0.00', '0.00', 'OFF', 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-12', '', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `heater_oil`
--

CREATE TABLE IF NOT EXISTS `heater_oil` (
  `tanggal` date NOT NULL,
  `operating_pump1_8` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_10` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_12` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_16` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_18` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_20` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_0` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_2` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_4` enum('ON','OFF') DEFAULT NULL,
  `operating_pump1_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_oil1_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil1_6` enum('A','TA','RS') DEFAULT NULL,
  `operating_pump2_8` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_10` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_12` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_14` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_16` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_18` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_20` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_22` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_0` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_2` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_4` enum('ON','OFF') DEFAULT NULL,
  `operating_pump2_6` enum('ON','OFF') DEFAULT NULL,
  `kebocoran_oil2_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil2_6` enum('A','TA','RS') DEFAULT NULL,
  `inlet_pressure_8` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_10` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_12` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_14` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_16` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_18` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_20` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_22` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_0` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_2` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_4` decimal(5,2) DEFAULT NULL,
  `inlet_pressure_6` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_8` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_10` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_12` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_14` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_16` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_18` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_20` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_22` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_0` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_2` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_4` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank1_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_oil_tank1_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank1_6` enum('A','TA','RS') DEFAULT NULL,
  `heater_temp_tank2_8` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_10` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_12` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_14` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_16` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_18` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_20` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_22` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_0` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_2` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_4` decimal(5,2) DEFAULT NULL,
  `heater_temp_tank2_6` decimal(5,2) DEFAULT NULL,
  `kebocoran_oil_tank2_8` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_10` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_12` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_14` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_16` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_18` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_20` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_22` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_0` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_2` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_4` enum('A','TA','RS') DEFAULT NULL,
  `kebocoran_oil_tank2_6` enum('A','TA','RS') DEFAULT NULL,
  `oil_temp_supply_8` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_10` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_12` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_14` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_16` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_18` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_20` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_22` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_0` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_2` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_4` decimal(5,2) DEFAULT NULL,
  `oil_temp_supply_6` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_8` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_10` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_12` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_14` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_16` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_18` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_20` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_22` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_0` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_2` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_4` decimal(5,2) DEFAULT NULL,
  `oil_temp_return_6` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_8` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_10` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_12` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_14` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_16` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_18` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_20` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_22` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_0` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_2` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_4` decimal(5,2) DEFAULT NULL,
  `hfo_outlet_temp_6` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_8` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_10` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_12` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_14` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_16` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_18` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_20` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_22` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_0` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_2` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_4` decimal(5,2) DEFAULT NULL,
  `hfo_tank_temp_6` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heater_oil`
--

INSERT INTO `heater_oil` (`tanggal`, `operating_pump1_8`, `operating_pump1_10`, `operating_pump1_12`, `operating_pump1_14`, `operating_pump1_16`, `operating_pump1_18`, `operating_pump1_20`, `operating_pump1_22`, `operating_pump1_0`, `operating_pump1_2`, `operating_pump1_4`, `operating_pump1_6`, `kebocoran_oil1_8`, `kebocoran_oil1_10`, `kebocoran_oil1_12`, `kebocoran_oil1_14`, `kebocoran_oil1_16`, `kebocoran_oil1_18`, `kebocoran_oil1_20`, `kebocoran_oil1_22`, `kebocoran_oil1_0`, `kebocoran_oil1_2`, `kebocoran_oil1_4`, `kebocoran_oil1_6`, `operating_pump2_8`, `operating_pump2_10`, `operating_pump2_12`, `operating_pump2_14`, `operating_pump2_16`, `operating_pump2_18`, `operating_pump2_20`, `operating_pump2_22`, `operating_pump2_0`, `operating_pump2_2`, `operating_pump2_4`, `operating_pump2_6`, `kebocoran_oil2_8`, `kebocoran_oil2_10`, `kebocoran_oil2_12`, `kebocoran_oil2_14`, `kebocoran_oil2_16`, `kebocoran_oil2_18`, `kebocoran_oil2_20`, `kebocoran_oil2_22`, `kebocoran_oil2_0`, `kebocoran_oil2_2`, `kebocoran_oil2_4`, `kebocoran_oil2_6`, `inlet_pressure_8`, `inlet_pressure_10`, `inlet_pressure_12`, `inlet_pressure_14`, `inlet_pressure_16`, `inlet_pressure_18`, `inlet_pressure_20`, `inlet_pressure_22`, `inlet_pressure_0`, `inlet_pressure_2`, `inlet_pressure_4`, `inlet_pressure_6`, `heater_temp_tank1_8`, `heater_temp_tank1_10`, `heater_temp_tank1_12`, `heater_temp_tank1_14`, `heater_temp_tank1_16`, `heater_temp_tank1_18`, `heater_temp_tank1_20`, `heater_temp_tank1_22`, `heater_temp_tank1_0`, `heater_temp_tank1_2`, `heater_temp_tank1_4`, `heater_temp_tank1_6`, `kebocoran_oil_tank1_8`, `kebocoran_oil_tank1_10`, `kebocoran_oil_tank1_12`, `kebocoran_oil_tank1_14`, `kebocoran_oil_tank1_16`, `kebocoran_oil_tank1_18`, `kebocoran_oil_tank1_20`, `kebocoran_oil_tank1_22`, `kebocoran_oil_tank1_0`, `kebocoran_oil_tank1_2`, `kebocoran_oil_tank1_4`, `kebocoran_oil_tank1_6`, `heater_temp_tank2_8`, `heater_temp_tank2_10`, `heater_temp_tank2_12`, `heater_temp_tank2_14`, `heater_temp_tank2_16`, `heater_temp_tank2_18`, `heater_temp_tank2_20`, `heater_temp_tank2_22`, `heater_temp_tank2_0`, `heater_temp_tank2_2`, `heater_temp_tank2_4`, `heater_temp_tank2_6`, `kebocoran_oil_tank2_8`, `kebocoran_oil_tank2_10`, `kebocoran_oil_tank2_12`, `kebocoran_oil_tank2_14`, `kebocoran_oil_tank2_16`, `kebocoran_oil_tank2_18`, `kebocoran_oil_tank2_20`, `kebocoran_oil_tank2_22`, `kebocoran_oil_tank2_0`, `kebocoran_oil_tank2_2`, `kebocoran_oil_tank2_4`, `kebocoran_oil_tank2_6`, `oil_temp_supply_8`, `oil_temp_supply_10`, `oil_temp_supply_12`, `oil_temp_supply_14`, `oil_temp_supply_16`, `oil_temp_supply_18`, `oil_temp_supply_20`, `oil_temp_supply_22`, `oil_temp_supply_0`, `oil_temp_supply_2`, `oil_temp_supply_4`, `oil_temp_supply_6`, `oil_temp_return_8`, `oil_temp_return_10`, `oil_temp_return_12`, `oil_temp_return_14`, `oil_temp_return_16`, `oil_temp_return_18`, `oil_temp_return_20`, `oil_temp_return_22`, `oil_temp_return_0`, `oil_temp_return_2`, `oil_temp_return_4`, `oil_temp_return_6`, `hfo_outlet_temp_8`, `hfo_outlet_temp_10`, `hfo_outlet_temp_12`, `hfo_outlet_temp_14`, `hfo_outlet_temp_16`, `hfo_outlet_temp_18`, `hfo_outlet_temp_20`, `hfo_outlet_temp_22`, `hfo_outlet_temp_0`, `hfo_outlet_temp_2`, `hfo_outlet_temp_4`, `hfo_outlet_temp_6`, `hfo_tank_temp_8`, `hfo_tank_temp_10`, `hfo_tank_temp_12`, `hfo_tank_temp_14`, `hfo_tank_temp_16`, `hfo_tank_temp_18`, `hfo_tank_temp_20`, `hfo_tank_temp_22`, `hfo_tank_temp_0`, `hfo_tank_temp_2`, `hfo_tank_temp_4`, `hfo_tank_temp_6`) VALUES
('2024-06-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.00', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-06-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hfo_separator_pump_unit`
--

CREATE TABLE IF NOT EXISTS `hfo_separator_pump_unit` (
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
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hfo_separator_pump_unit`
--

INSERT INTO `hfo_separator_pump_unit` (`tanggal`, `operating_pump1_8_14`, `operating_pump1_16_22`, `operating_pump1_0_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8_14`, `operating_pump2_16_22`, `operating_pump2_0_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`) VALUES
('2024-04-24', 'ON', 'OFF', NULL, 'TA', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-12', 'ON', 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-13', 'ON', 'OFF', NULL, NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, NULL, 'RS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hfo_unloading_pump_unit`
--

CREATE TABLE IF NOT EXISTS `hfo_unloading_pump_unit` (
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
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hfo_unloading_pump_unit`
--

INSERT INTO `hfo_unloading_pump_unit` (`tanggal`, `operating_pump1_8_14`, `operating_pump1_16_22`, `operating_pump1_0_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8_14`, `operating_pump2_16_22`, `operating_pump2_0_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`) VALUES
('2024-04-24', 'OFF', 'OFF', 'ON', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'ON', 'ON', 'ON', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A'),
('2024-05-22', 'OFF', 'ON', NULL, NULL, NULL, 'A', 'A', 'RS', 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', 'OFF', NULL, NULL, 'TA', NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL),
('2024-05-23', NULL, NULL, NULL, NULL, 'TA', NULL, 'A', 'TA', 'A', NULL, NULL, NULL, NULL, NULL, NULL, 'OFF', 'OFF', NULL, NULL, 'A', NULL, NULL, 'A', 'TA', 'A', 'RS', NULL, NULL, NULL, NULL),
('2024-05-24', 'ON', NULL, NULL, NULL, NULL, 'A', NULL, NULL, 'TA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, NULL, 'TA', 'A', NULL, 'RS', NULL, NULL, NULL, NULL, NULL),
('2024-05-27', 'ON', NULL, 'OFF', NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, 'OFF', NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-06-04', 'ON', 'OFF', NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2024-06-05', 'ON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kebocoran_fuel_tank`
--

CREATE TABLE IF NOT EXISTS `kebocoran_fuel_tank` (
  `tanggal` date NOT NULL,
  `hfo_day_tank_8` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_10` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_12` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_14` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_16` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_18` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_20` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_22` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_0` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_2` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_4` enum('A','TA','RS') DEFAULT NULL,
  `hfo_day_tank_6` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_8` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_10` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_12` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_14` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_16` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_18` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_20` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_22` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_0` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_2` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_4` enum('A','TA','RS') DEFAULT NULL,
  `lfo_day_tank_6` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_8` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_10` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_12` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_14` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_16` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_18` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_20` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_22` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_0` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_2` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_4` enum('A','TA','RS') DEFAULT NULL,
  `hfo_storage_tank_6` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_8` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_10` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_12` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_14` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_16` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_18` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_20` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_22` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_0` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_2` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_4` enum('A','TA','RS') DEFAULT NULL,
  `lfo_storage_tank_6` enum('A','TA','RS') DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lfo_unloading_pump_unit`
--

CREATE TABLE IF NOT EXISTS `lfo_unloading_pump_unit` (
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
  `kebocoran_fuel2_6` enum('A','TA','RS') DEFAULT NULL,
  PRIMARY KEY (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lfo_unloading_pump_unit`
--

INSERT INTO `lfo_unloading_pump_unit` (`tanggal`, `operating_pump1_8_14`, `operating_pump1_16_22`, `operating_pump1_0_6`, `kebocoran_fuel1_8`, `kebocoran_fuel1_10`, `kebocoran_fuel1_12`, `kebocoran_fuel1_14`, `kebocoran_fuel1_16`, `kebocoran_fuel1_18`, `kebocoran_fuel1_20`, `kebocoran_fuel1_22`, `kebocoran_fuel1_0`, `kebocoran_fuel1_2`, `kebocoran_fuel1_4`, `kebocoran_fuel1_6`, `operating_pump2_8_14`, `operating_pump2_16_22`, `operating_pump2_0_6`, `kebocoran_fuel2_8`, `kebocoran_fuel2_10`, `kebocoran_fuel2_12`, `kebocoran_fuel2_14`, `kebocoran_fuel2_16`, `kebocoran_fuel2_18`, `kebocoran_fuel2_20`, `kebocoran_fuel2_22`, `kebocoran_fuel2_0`, `kebocoran_fuel2_2`, `kebocoran_fuel2_4`, `kebocoran_fuel2_6`) VALUES
('2024-04-24', 'OFF', NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ON', NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, 'TA', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `received_tank`
--

CREATE TABLE IF NOT EXISTS `received_tank` (
  `tanggal` date NOT NULL,
  `shift` enum('Shift 1','Shift 2','Shift 3') NOT NULL,
  `time_period` enum('1','2','3') NOT NULL,
  `line` enum('Line 4','Line 5','Line 6','Line 7','Met 1','Met 2','Met 3','Met 4','BOPET') NOT NULL,
  `tank1_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank1_auto_drain` enum('B','R') DEFAULT NULL,
  `tank1_kondensat` enum('A','TA') DEFAULT NULL,
  `tank1_kandungan_oli` enum('A','TA') DEFAULT NULL,
  `tank2_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank2_auto_drain` enum('B','R') DEFAULT NULL,
  `tank2_kondensat` enum('A','TA') DEFAULT NULL,
  `tank2_kandungan_oli` enum('A','TA') DEFAULT NULL,
  `tank3_air_pressure` decimal(5,2) DEFAULT NULL,
  `tank3_auto_drain` enum('B','R') DEFAULT NULL,
  `tank3_kondensat` enum('A','TA') DEFAULT NULL,
  `tank3_kandungan_oli` enum('A','TA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `received_tank`
--

INSERT INTO `received_tank` (`tanggal`, `shift`, `time_period`, `line`, `tank1_air_pressure`, `tank1_auto_drain`, `tank1_kondensat`, `tank1_kandungan_oli`, `tank2_air_pressure`, `tank2_auto_drain`, `tank2_kondensat`, `tank2_kandungan_oli`, `tank3_air_pressure`, `tank3_auto_drain`, `tank3_kondensat`, `tank3_kandungan_oli`) VALUES
('2024-05-22', 'Shift 1', '1', 'Line 4', '1.00', NULL, NULL, NULL, NULL, 'B', 'TA', NULL, NULL, NULL, NULL, 'TA'),
('2024-05-27', 'Shift 1', '1', 'Line 4', NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
