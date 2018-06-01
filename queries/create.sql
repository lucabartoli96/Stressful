DROP DATABASE IF EXISTS stressful;

CREATE DATABASE stressful;
USE stressful;

CREATE TABLE `users` (

    `username` VARCHAR(100) PRIMARY KEY,
    `email` VARCHAR(100) UNIQUE,
    `password` VARCHAR(100),
    `date` TIMESTAMP
);

