-- CREATE DATABASE IF NOT EXISTS thhe16;
USE thhe16;

-- GRANT ALL ON thhe16.* TO user@localhost IDENTIFIED BY "pass";

-- Ensure its UTF8 on the database connection
SET NAMES utf8;

--
-- Create table for my own users database
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`
(
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `presentation` TEXT DEFAULT NULL,
    `fav_color` VARCHAR(100) DEFAULT NULL,
    `fav_movie` VARCHAR(100) DEFAULT NULL,

    PRIMARY KEY(`id`)
)
