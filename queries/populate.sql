INSERT INTO user (username, email, password, admin) VALUES ('a', 'saa@gmail.com', '0cc175b9c0f1b6a831c399e269772661', true);
INSERT INTO user (username, email, password) VALUES ('b', 'b_b@de.de', '92eb5ffee6ae2fec3ad71c777531578f', true);
INSERT INTO user (username, email, password) VALUES ('luca96', 'email.email@email.email', 'ff377aff39a9345a9cca803fb5c5c081');
INSERT INTO user (username, email, password) VALUES ('utente', 'utente@mail.de', '1a1dc91c907325c69271ddf0c944bc72');

INSERT INTO category (name, creator) VALUES ('math', 'a');INSERT INTO category (name, creator) VALUES ('ita', 'b');
INSERT INTO category (name, creator) VALUES ('music', 'b');
INSERT INTO category (name, creator) VALUES ('cacca', 'a');
INSERT INTO category (name, creator) VALUES ('re', 'a');
INSERT INTO submission (user, category, test, result) VALUES ('a', 'ita', '', '0%') ;
INSERT INTO category (name, creator) VALUES ('cacca', 'a');
INSERT INTO category (name, creator) VALUES ('pollo', 'a');
INSERT INTO test (category, name, number, correct, mistake, questions) VALUES ('math', 'derivatives', 1, 1, 0, '[{\"question\":\"das\",\"answear\":0,\"options\":[\"dsad\",\"sdasdas\"]}]') ;
INSERT INTO submission (user, category, test, result) VALUES ('a', 'math', 'derivatives', '6%') ;
INSERT INTO submission (user, category, test, result) VALUES ('a', 'math', 'derivatives', '6%') ;
INSERT INTO submission (user, category, test, result) VALUES ('a', 'math', 'derivatives', '1%') ;
INSERT INTO submission (user, category, test, result) VALUES ('a', 'math', 'derivatives', '100%') ;
INSERT INTO submission (user, category, test, result) VALUES ('a', 'ita', 'cacca', '0%') ;
INSERT INTO submission (user, category, test, result) VALUES ('a', 'ita', 'sdf', '100%') ;
