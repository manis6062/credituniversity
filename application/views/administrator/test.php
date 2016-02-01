CREATE TABLE `business` (
`user_id` int(11) NOT NULL DEFAULT '0',
`site` varchar(100) DEFAULT NULL,
`theme_id` int(11) DEFAULT NULL,
`name` varchar(10) DEFAULT NULL,
`dba` varchar(10) DEFAULT NULL,
`b_phone` varchar(10) DEFAULT NULL,
`b_fax` varchar(10) DEFAULT NULL,
`email` varchar(30) DEFAULT NULL,
`status` tinyint(1) DEFAULT NULL,
`client_commission` double DEFAULT NULL,
`owner_commission` double DEFAULT NULL,
`address_id` int(11) DEFAULT NULL,
PRIMARY KEY (`user_id`),
KEY `address_id` (`address_id`),
CONSTRAINT `business_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
CONSTRAINT `business_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addess` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `business` (
`user_id` int(11) NOT NULL DEFAULT '0',
`site` varchar(100) DEFAULT NULL,
`theme_id` int(11) DEFAULT NULL,
`name` varchar(10) DEFAULT NULL,
`dba` varchar(10) DEFAULT NULL,
`address_id` int(11) DEFAULT NULL,
`b_phone` varchar(20) DEFAULT NULL,
`b_fax` varchar(20) DEFAULT NULL,
`email` varchar(30) DEFAULT NULL,
`status` tinyint(1) DEFAULT NULL,
`client_commission` double DEFAULT NULL,
`owner_commission` double DEFAULT NULL,
PRIMARY KEY (`user_id`),
KEY `business_address_addressId` (`address_id`),
CONSTRAINT `business_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
CONSTRAINT `business_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
