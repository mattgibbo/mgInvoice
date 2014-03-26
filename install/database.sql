-- Create and use the database
CREATE DATABASE IF NOT EXISTS mgInvoice;
USE mgInvoice;

-- Create the settings table
CREATE TABLE IF NOT EXISTS `mgi_settings` (
  `settingName` varchar(16) NOT NULL,
  `settingValue` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`settingName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create billing methods table
CREATE TABLE IF NOT EXISTS `mgi_billing_methods` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(13) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Create billing types table
CREATE TABLE IF NOT EXISTS `mgi_billing_types` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Create the clients table
CREATE TABLE IF NOT EXISTS `mgi_clients` (
  `clientId` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `address1` varchar(48) DEFAULT NULL,
  `address2` varchar(48) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `county` varchar(32) DEFAULT NULL,
  `postCode` varchar(8) DEFAULT NULL,
  `country` char(3) DEFAULT NULL,
  `billRateAmount` float(6,2) NOT NULL,
  `billRateType` varchar(11) NOT NULL DEFAULT 'Hourly',
  `billCycle` char(2) NOT NULL DEFAULT '4',
  `billMethod` varchar(16) NOT NULL DEFAULT 'Cheque',
  `billCurrency` char(3) NOT NULL DEFAULT 'GBP',
  PRIMARY KEY (`clientId`),
  UNIQUE KEY `clientId` (`clientId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Create the clients contact table
CREATE TABLE IF NOT EXISTS `mgi_clients_contacts` (
  `clientId` smallint(5) unsigned NOT NULL,
  `contactName` varchar(32) DEFAULT NULL,
  `contactEmail` varchar(32) DEFAULT NULL,
  `contactType` char(7) NOT NULL DEFAULT 'main'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
