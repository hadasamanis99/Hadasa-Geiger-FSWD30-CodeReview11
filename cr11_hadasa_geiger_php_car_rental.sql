-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Feb 2018 um 15:32
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_hadasa_geiger_php_car_rental`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `car`
--

CREATE TABLE `car` (
  `pk_Car_id` int(11) NOT NULL,
  `fk_Car_Location` int(11) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Year_production` int(11) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `car`
--

INSERT INTO `car` (`pk_Car_id`, `fk_Car_Location`, `brand`, `Type`, `Year_production`, `mileage`, `color`) VALUES
(1, 1, 'VW', 'Golf', 1999, 30000, 'Rostfarben'),
(2, 2, 'Daihatsu', 'Charade', 2015, 10000, 'Blau'),
(3, 2, 'Toyota', 'Corolla', 2011, 17535, 'Grey'),
(4, 2, 'Nissan', 'Sunny', 2010, 25025, 'Yellow'),
(5, 3, 'Mitsubishi', 'Pajero', 2014, 12000, 'Weiss'),
(6, 4, 'KIA', 'Pregio', 2010, 13000, 'Schawrz'),
(7, 5, 'Opel', 'Vivaro', 2013, 25000, 'Grau'),
(8, 6, 'Opel', 'Corsa E', 2009, 30000, 'Weiss'),
(9, 7, 'KIA', 'Sportage', 2012, 12000, 'Grün'),
(10, 8, 'Mitsubishi', 'Eclipe Cross', 2017, 10000, 'Rot'),
(11, 9, 'BMW', '5 series', 2017, 5000, 'Blau'),
(12, 10, 'Fiat', '500X', 2016, 15000, 'Rot');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE `customer` (
  `pk_Customer_id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_german2_ci NOT NULL,
  `birthdate` date NOT NULL,
  `License_No` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`pk_Customer_id`, `name`, `birthdate`, `License_No`) VALUES
(1, 'Inge Lutz', '1968-11-11', '5020xxxx'),
(2, 'Josef Lutz', '1965-10-11', '5020yyyy'),
(3, 'Daniel Yudhisthira ', '1977-02-22', 'Pa1234');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `insurance`
--

CREATE TABLE `insurance` (
  `pk_Insurance_id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `Policy` varchar(500) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `insurance`
--

INSERT INTO `insurance` (`pk_Insurance_id`, `Name`, `Policy`) VALUES
(1, 'Autoversicherungen GmbH', 'Spezieller Tarif XYZ'),
(2, 'Superversicherungen GmbH', 'Super-Spezieller Tarif XYZ');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `fk_Management_id` int(11) NOT NULL,
  `car_rent_cents` int(11) NOT NULL,
  `insurancecost_total_cents` int(11) NOT NULL,
  `service_tax` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `payable_total_cents` int(11) NOT NULL,
  `discount_cents` int(11) NOT NULL,
  `net_total_cents` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `fk_Management_id`, `car_rent_cents`, `insurancecost_total_cents`, `service_tax`, `vat`, `payable_total_cents`, `discount_cents`, `net_total_cents`) VALUES
(1, 1, 5000, 200, 0, 20, 6240, 0, 0),
(2, 2, 7000, 500, 0, 20, 9000, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `location`
--

CREATE TABLE `location` (
  `pk_Location_id` int(11) NOT NULL,
  `street_name` varchar(500) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Zip` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `location`
--

INSERT INTO `location` (`pk_Location_id`, `street_name`, `City`, `Zip`) VALUES
(1, 'Anichstrasse 1', 'Wien', '1020'),
(2, 'Karlsplatz 10', 'Wien', '1040'),
(3, 'Josestatterstrasse 85', 'Wien', '1090'),
(4, 'Hitzing 1', 'Wien', '1140'),
(5, 'Geibelgasse 1', 'Wien', '1150'),
(6, 'Doblingerstrasse 18', 'Wien', '1190'),
(7, 'Haubegasse 191', 'Wien', '1200'),
(8, 'Willhemninagasse', 'Wien', '1210'),
(9, 'Mariahiferstrasse 25', 'Wien', '1220'),
(10, 'Liesing  34', 'Wien', '1230');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `management`
--

CREATE TABLE `management` (
  `pk_Management_id` int(11) NOT NULL,
  `fk_Customer_id` int(11) NOT NULL,
  `fk_car_id` int(11) NOT NULL,
  `fk_pickup_location_id` int(11) NOT NULL,
  `fk_dropoff_location_id` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `management`
--

INSERT INTO `management` (`pk_Management_id`, `fk_Customer_id`, `fk_car_id`, `fk_pickup_location_id`, `fk_dropoff_location_id`, `startdate`, `enddate`) VALUES
(1, 1, 1, 2, 1, '2018-01-01', NULL),
(2, 2, 2, 2, 1, '2018-01-01', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `member`
--

CREATE TABLE `member` (
  `pk_Member_id` int(11) NOT NULL,
  `First_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) DEFAULT NULL,
  `Email_address` varchar(100) DEFAULT NULL,
  `Hand_phone_no` varchar(50) DEFAULT NULL,
  `cust_pass` varchar(500) DEFAULT NULL,
  `Birth_date` date DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `member`
--

INSERT INTO `member` (`pk_Member_id`, `First_Name`, `Last_Name`, `Email_address`, `Hand_phone_no`, `cust_pass`, `Birth_date`, `Address`) VALUES
(0, 'hadasa', NULL, 'hadasa@gmx.at', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(1, 'Daniel', 'Geiger', 'DanielG@gmx.at', '06643679499', '789', '2013-10-18', 'Kettenbruckengasse 57A'),
(100, 'Daniel Yudhisthira', NULL, 'Yudhisthira@geiger.com', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(103, 'dddx', NULL, 'abcx@fg.com', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(104, 'fffkk', NULL, 'ss@xy.af', NULL, '534a4a8eafcd8489af32356d5a7a25f88c70cfe0448539a7c42964c1b897a359', NULL, NULL),
(105, 'Otto', NULL, 'otto@geiger.com', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(106, 'Theodora', NULL, 'theodora@gmail.com', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(107, 'Pinling', NULL, 'simanis@geiger.com', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(108, 'Irene', NULL, 'theiss@geiger.com', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rental_insurance`
--

CREATE TABLE `rental_insurance` (
  `pk_Rental_Insurance_id` int(11) NOT NULL,
  `fk_Rental_Insurance_id` int(11) NOT NULL,
  `fk_Insurance_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `rental_insurance`
--

INSERT INTO `rental_insurance` (`pk_Rental_Insurance_id`, `fk_Rental_Insurance_id`, `fk_Insurance_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reservation`
--

CREATE TABLE `reservation` (
  `pk_Reservation_id` int(11) NOT NULL,
  `fk_Customer_id` int(11) NOT NULL,
  `fk_Pickup_location_id` int(11) NOT NULL,
  `fk_Dropoff_location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`pk_Car_id`);

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`pk_Customer_id`);

--
-- Indizes für die Tabelle `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`pk_Insurance_id`);

--
-- Indizes für die Tabelle `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `fk_Management_id` (`fk_Management_id`);

--
-- Indizes für die Tabelle `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`pk_Location_id`);

--
-- Indizes für die Tabelle `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`pk_Management_id`),
  ADD KEY `fk_Customer_id` (`fk_Customer_id`),
  ADD KEY `fk_car_id` (`fk_car_id`),
  ADD KEY `fk_pickup_location_id` (`fk_pickup_location_id`),
  ADD KEY `fk_dropoff_location_id` (`fk_dropoff_location_id`);

--
-- Indizes für die Tabelle `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`pk_Member_id`);

--
-- Indizes für die Tabelle `rental_insurance`
--
ALTER TABLE `rental_insurance`
  ADD PRIMARY KEY (`pk_Rental_Insurance_id`),
  ADD KEY `fk_Rental_Insurance_id` (`fk_Rental_Insurance_id`),
  ADD KEY `fk_Insurance_id` (`fk_Insurance_id`);

--
-- Indizes für die Tabelle `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`pk_Reservation_id`),
  ADD KEY `fk_Customer_id` (`fk_Customer_id`),
  ADD KEY `fk_Pickup_location_id` (`fk_Pickup_location_id`),
  ADD KEY `fk_Dropoff_location_id` (`fk_Dropoff_location_id`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`fk_Management_id`) REFERENCES `management` (`pk_Management_id`);

--
-- Constraints der Tabelle `management`
--
ALTER TABLE `management`
  ADD CONSTRAINT `management_ibfk_1` FOREIGN KEY (`fk_Customer_id`) REFERENCES `customer` (`pk_Customer_id`),
  ADD CONSTRAINT `management_ibfk_2` FOREIGN KEY (`fk_car_id`) REFERENCES `car` (`pk_Car_id`),
  ADD CONSTRAINT `management_ibfk_3` FOREIGN KEY (`fk_pickup_location_id`) REFERENCES `location` (`pk_Location_id`),
  ADD CONSTRAINT `management_ibfk_4` FOREIGN KEY (`fk_dropoff_location_id`) REFERENCES `location` (`pk_Location_id`);

--
-- Constraints der Tabelle `rental_insurance`
--
ALTER TABLE `rental_insurance`
  ADD CONSTRAINT `rental_insurance_ibfk_1` FOREIGN KEY (`fk_Rental_Insurance_id`) REFERENCES `management` (`pk_Management_id`),
  ADD CONSTRAINT `rental_insurance_ibfk_2` FOREIGN KEY (`fk_Insurance_id`) REFERENCES `insurance` (`pk_Insurance_id`);

--
-- Constraints der Tabelle `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`fk_Customer_id`) REFERENCES `customer` (`pk_Customer_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`fk_Pickup_location_id`) REFERENCES `location` (`pk_Location_id`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`fk_Dropoff_location_id`) REFERENCES `location` (`pk_Location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
