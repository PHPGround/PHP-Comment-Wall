-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2014 at 05:44 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thewall`
--
CREATE DATABASE IF NOT EXISTS `thewall` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `thewall`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_user1_idx` (`user_id`),
  KEY `fk_comments_message1_idx` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `created_at`, `updated_at`, `user_id`, `message_id`) VALUES
(1, 'yo dude', '2014-04-22 15:55:55', '2014-04-22 15:55:55', 1, 2),
(2, 'yo cat', '2014-04-22 16:06:07', '2014-04-22 16:06:07', 1, 2),
(3, 'comment son', '2014-04-22 16:15:44', '2014-04-22 16:15:44', 2, 3),
(4, 'comment', '2014-04-22 16:25:46', '2014-04-22 16:25:46', 5, 3),
(5, 'this is my first comment! Mrow!', '2014-04-22 17:07:57', '2014-04-22 17:07:57', 6, 1),
(6, 'mewmewmew', '2014-04-22 17:08:09', '2014-04-22 17:08:09', 6, 2),
(7, 'Play with me! Yes! Hold the feather above my head while I leap for it!', '2014-04-22 17:08:36', '2014-04-22 17:08:36', 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'first message', '2014-04-22 15:14:26', '2014-04-22 15:14:26', 1),
(2, 'yo', '2014-04-22 15:49:23', '2014-04-22 15:49:23', 1),
(3, 'You wanna play rough? Okay. Say hello to my little friend!', '2014-04-22 16:15:30', '2014-04-22 16:15:30', 2),
(4, 'I hate having my nails cut. *sritch sccritch*', '2014-04-22 17:09:01', '2014-04-22 17:09:01', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Corey', 'Trevor', 'corey@trevor.com', 'password', '2014-04-22 15:14:13', '2014-04-22 15:14:13'),
(2, 'Tony', 'Montana', 'tony@montana.com', 'password', '2014-04-22 16:14:57', '2014-04-22 16:14:57'),
(5, 'Jack', 'Bauer', 'jack@bauer.com', 'password', '2014-04-22 16:25:36', '2014-04-22 16:25:36'),
(6, 'Biscuit', 'Kitty', 'biscuit@kitty.com', 'qqqqqq', '2014-04-22 17:05:48', '2014-04-22 17:05:48');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_message1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
