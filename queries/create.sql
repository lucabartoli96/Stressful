DROP DATABASE IF EXISTS stressful;

CREATE DATABASE stressful;
USE stressful;

CREATE TABLE user (
    username VARCHAR(100) PRIMARY KEY,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(100),
    admin BOOL DEFAULT false,
    since TIMESTAMP
);

CREATE TABLE category (
    name VARCHAR(100) PRIMARY KEY,
    creator VARCHAR(100),  
    since TIMESTAMP,
    FOREIGN KEY(creator) REFERENCES user(username) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE test (
    name VARCHAR(100),
    category VARCHAR(100),
    number INT,
    correct INT,
    mistake INT, 
    questions LONGTEXT,
    since TIMESTAMP,
    PRIMARY KEY(name, category),
    FOREIGN KEY(category) REFERENCES category(name) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE submission (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(100),
    test VARCHAR(100),
    category VARCHAR(100),
    result VARCHAR(5),
    date TIMESTAMP,
    FOREIGN KEY(user) REFERENCES user(username) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(test, category) REFERENCES test(name, category) ON DELETE CASCADE ON UPDATE CASCADE
    
);

