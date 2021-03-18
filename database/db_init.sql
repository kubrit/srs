SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(1024) NOT NULL,
  `company_address` varchar(1024) NOT NULL,
  `company_tax_number` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `companies` (`company_id`, `company_name`, `company_address`, `company_tax_number`) VALUES
(0, 'Unknown', '', '8888888888'),
(1, 'GMBroker-Company', 'Poland', '9999999999');

CREATE TABLE `conversations` (
  `conversation_id` int(8) NOT NULL,
  `conversation_subject` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `conversations` (`conversation_id`, `conversation_subject`) VALUES
(1, 'Information');

CREATE TABLE `conversations_members` (
  `id` int(11) NOT NULL,
  `conversation_id` int(8) NOT NULL,
  `user_id` int(11) NOT NULL,
  `conversation_last_viewed` int(10) NOT NULL,
  `conversation_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `conversations_members` (`id`, `conversation_id`, `user_id`, `conversation_last_viewed`, `conversation_deleted`) VALUES
(1, 1, 1, 1494940943, 0),
(2, 1, 2, 1494942810, 0);

CREATE TABLE `conversations_messages` (
  `message_id` int(10) NOT NULL,
  `conversation_id` int(8) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_sent` int(10) NOT NULL,
  `message_body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `conversations_messages` (`message_id`, `conversation_id`, `user_id`, `date_sent`, `message_body`) VALUES
(1, 1, 1, 1494940943, 'I send you an example message to show everything works!'),
(2, 1, 2, 1494942810, 'Holly shit! It works! :D');

CREATE TABLE `shipments` (
  `shipment_id` int(11) NOT NULL,
  `sent` int(1) NOT NULL DEFAULT '0',
  `recipient` varchar(1024) NOT NULL,
  `recipient_address` varchar(1024) NOT NULL,
  `body_sent_correspondence` varchar(2048) NOT NULL DEFAULT '',
  `received` int(1) NOT NULL DEFAULT '0',
  `shipment_type_id` int(6) NOT NULL DEFAULT '1',
  `registered_by_id` int(11) NOT NULL DEFAULT '0',
  `date_received` date DEFAULT NULL,
  `date_sent` date DEFAULT NULL,
  `updated_by_id` int(11) NOT NULL DEFAULT '0',
  `date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `shipments_types` (
  `shipment_type_id` int(6) NOT NULL,
  `shipment_type_name` varchar(250) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `shipments_types` (`shipment_type_id`, `shipment_type_name`) VALUES
(0, 'Undefined'),
(1, 'Recommended Letter'),
(2, 'Priority Letter'),
(3, 'Pre-paid Package');

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `cellphone` varchar(25) NOT NULL DEFAULT '',
  `landline_phone` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL,
  `company_id` int(1) NOT NULL DEFAULT '0',
  `allow_email` int(1) NOT NULL DEFAULT '0',
  `permissions` int(1) NOT NULL DEFAULT '0',
  `last_logged_in` datetime DEFAULT NULL,
  `picture` varchar(150) DEFAULT NULL,
  `type` enum('Normal','Employee','Administrator','Super-Administrator') NOT NULL DEFAULT 'Normal',
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `login`, `password`, `first_name`, `last_name`, `job_title`, `cellphone`, `landline_phone`, `email`, `company_id`, `allow_email`, `permissions`, `last_logged_in`, `picture`, `type`, `active`) VALUES
(0, 'unknown', '$2y$10$QgNpa6JS23fdG.xE5h2nFOKI92uUpQ/iqmGvkuU4OfvzBC6xZQJ5W', 'Unknown', '', '', '', '', '', 0, 0, 0, NULL, NULL, '', 0),
(1, 'sadmin', '$2y$10$iEtBWM/mW5BT9/g0bKLBaOsNWLs2RBS7aZjFvsv0YWGdXhVGEm2Vu', 'Super', 'Administrator', 'Application Super-Admin', '+48 111 111 111', '', 'joe.doe@example.com', 1, 1, 99, '2017-05-23 10:16:45', 'images/profile/e3864b7a83.jpg', 'Super-Administrator', 1),
(2, 'admin', '$2y$10$ahovK.5EEHBGV16hW7mwA.oUMD3GnWo/f6xZkHNqwWKY3utyzRW.q', 'Administrator', '', '', '', '', 'joe.doe@example.com', 1, 1, 98, '2017-05-16 15:50:11', 'images/profile/129ee4f168.png', 'Administrator', 1);

ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

ALTER TABLE `conversations_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`conversation_id`,`user_id`),
  ADD KEY `FK_users_conversations_members` (`user_id`);

ALTER TABLE `conversations_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `shipments`
  ADD PRIMARY KEY (`shipment_id`),
  ADD KEY `shipment_type_id` (`shipment_type_id`);

ALTER TABLE `shipments_types`
  ADD PRIMARY KEY (`shipment_type_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `company_id` (`company_id`);

ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `conversations`
  MODIFY `conversation_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `conversations_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `conversations_messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `shipments`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `shipments_types`
  MODIFY `shipment_type_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `conversations_members`
  ADD CONSTRAINT `FK_users_conversations_members` 
  FOREIGN KEY (`user_id`) 
  REFERENCES `users` (`user_id`) 
  ON UPDATE CASCADE;

ALTER TABLE `conversations_messages`
  ADD CONSTRAINT `FK_users_conversations_messages` 
  FOREIGN KEY (`user_id`) 
  REFERENCES `users` (`user_id`) 
  ON UPDATE CASCADE;

ALTER TABLE `shipments`
  ADD CONSTRAINT `FK_shipments_types_shipments` 
  FOREIGN KEY (`shipment_type_id`) 
  REFERENCES `shipments_types` (`shipment_type_id`) 
  ON UPDATE CASCADE;

ALTER TABLE `users`
  ADD CONSTRAINT `FK_companies_users` 
  FOREIGN KEY (`company_id`) 
  REFERENCES `companies` (`company_id`) 
  ON UPDATE CASCADE;
