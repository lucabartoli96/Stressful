DROP DATABASE IF EXISTS stressful;

CREATE DATABASE stressful;
USE stressful;

CREATE TABLE `user` (
    `username` VARCHAR(100) PRIMARY KEY,
    `email` VARCHAR(100) UNIQUE,
    `password` VARCHAR(100),
    `admin` BOOL DEFAULT false,
    `date` TIMESTAMP
);

CREATE TABLE `category` (
    `name` VARCHAR(100) PRIMARY KEY,
    `creator` VARCHAR(100) REFERENCES `users`(`username`),  
    `date` TIMESTAMP
);

CREATE TABLE `test` (
    `name` VARCHAR(100),
    `category` VARCHAR(100) REFERENCES `category`(`name`),
    `date` TIMESTAMP,
    PRIMARY KEY(`name`, `category`)
);

CREATE TABLE `submission` (
    `id` INTEGER AUTO_INCREMENT PRIMARY KEY,
    `user` VARCHAR(100) REFERENCES `users`(`username`),
    `test` VARCHAR(100),
    `category` VARCHAR(100) REFERENCES `category`(`name`),
    `date` TIMESTAMP,
    FOREIGN KEY(`test`, `category`) REFERENCES `test`(`name`, `category`)
    
);