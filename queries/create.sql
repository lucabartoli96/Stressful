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
    FOREIGN KEY(category) REFERENCES category(name) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(test, category) REFERENCES test(name, category) ON DELETE CASCADE ON UPDATE CASCADE
    
);

UPDATE user SET admin=true WHERE username='a';

INSERT INTO category (name, creator) VALUES ('math', 'a');
INSERT INTO category (name, creator) VALUES ('ita', 'a');
INSERT INTO category (name, creator) VALUES ('science', 'a');
INSERT INTO category (name, creator) VALUES ('geo', 'a');

INSERT INTO test (category, name, number, correct, mistake, questions) VALUES ('ita', 'verbi', 2, 1, 0, '[{\"question\":\"Prima persona singolare del passato remoto del verbo cuocere\",\"answear\":1,\"options\":[\"cuocei\",\"cossi\"]},{\"question\":\"Se avessi studiato i verbi...\",\"answear\":1,\"options\":[\"...sapessi rispondere a questa domanda\",\"...saprei rispondere a questa domanda\"]}]');