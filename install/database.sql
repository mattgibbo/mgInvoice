CREATE DATABASE IF NOT EXISTS mgInvoice;
USE mgInvoice;

CREATE TABLE IF NOT EXISTS `mgi_settings` (
  `settingName` varchar(16) NOT NULL,
  `settingValue` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`settingName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;