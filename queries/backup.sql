

/* USERS */
INSERT INTO user (username, email, password, admin) VALUES ('a', 'saa@gmail.com', '0cc175b9c0f1b6a831c399e269772661', true);
/* a */
INSERT INTO user (username, email, password) VALUES ('b', 'b_b@de.de', '92eb5ffee6ae2fec3ad71c777531578f');
/* b */
INSERT INTO user (username, email, password) VALUES ('luca96', 'luca@gmail.com', 'ff377aff39a9345a9cca803fb5c5c081');
/* luca */
INSERT INTO user (username, email, password, admin) VALUES ('admin', 'admin@admin.it', '21232f297a57a5a743894a0e4a801fc3', true);
/* admin */


/* CATEGORIES */
INSERT INTO category (name, creator) VALUES ('Math', 'a');
INSERT INTO category (name, creator) VALUES ('Ita', 'a');
INSERT INTO category (name, creator) VALUES ('Music', 'a');


/* TEST */
INSERT INTO test (category, name, number, correct, mistake, questions) VALUES ('Ita', 'Grammatica', 2, 1, 0, '[{\"question\":\"Se andassi a scuola...\",\"answear\":1,\"options\":[\"...sapessi coniugare i congiuntivi\",\"...saprei coniugare i congiuntivi\"]},{\"question\":\"Passato remoto del verbo \'cuocere\', prima persona singolare:\",\"answear\":1,\"options\":[\"cuocetti\",\"cossi\",\"cobbi\",\"cuocei\"]}]') ;
INSERT INTO test (category, name, number, correct, mistake, questions) VALUES ('Ita', 'Proverbi', 2, 1, 0, '[{\"question\":\"Mogli e buoi...\",\"answear\":0,\"options\":[\"...dei paesi tuoi\",\"...meglio non confonderli\"]},{\"question\":\"Can che abbaia...\",\"answear\":2,\"options\":[\"...non dorme\",\"...poco cotto\",\"...non morde\"]}]') ;
INSERT INTO test (category, name, number, correct, mistake, questions) VALUES ('Math', 'Relazioni', 2, 1, 0, '[{\"question\":\"Una relazione tra due insiemi:\",\"answear\":1,\"options\":[\"...\\u00e8 una funzione che fa corrispondere elementi del primo insieme ad elementi del secondo\",\"\\u00e8 un sottoinsieme del prodotto cartesiano\"]},{\"question\":\"Una relazione \\u00e8 antisimmetrica:\",\"answear\":0,\"options\":[\"Se non \\u00e8 simmetrica\",\"Se dati due elementi (a, b) nella relazione allora anche (b, a) sta nella relazione\",\"Nessuna delle precedenti\"]}]') ;
INSERT INTO test (category, name, number, correct, mistake, questions) VALUES ('Music', 'rock', 4, 1, 0, '[{\"question\":\"Jimmy Page era:\",\"answear\":1,\"options\":[\"violinista negli Afterhours\",\"chitarrista nei Led Zeppelin\",\"pianista nei Fleshgod Apocalypse\",\"violista nei Led Zeppelin\",\"violencellista nei Fall of Efrafa\"]},{\"question\":\"Chi \\u00e8 il cantante dei Korn?\",\"answear\":2,\"options\":[\"Tomas Lindberg\",\"Phil Anselmo\",\"Jonathan Davis\",\"Fabrizio De Andr\\u00e8\"]},{\"question\":\"I Days and Daze vengono da:\",\"answear\":1,\"options\":[\"Memphis\",\"Houston\",\"Toronto\"]},{\"question\":\"Jason Molina era il cantante/chitarrista di quale band\",\"answear\":2,\"options\":[\"...Who calls so loud\",\"Saetia\",\"Songs: Ohia\",\"Defiance, Ohio\"]}]') ;


/* SUBMISSION */
INSERT INTO submission (user, category, test, result) VALUES ('b', 'Ita', 'Proverbi', '100%') ;
INSERT INTO submission (user, category, test, result) VALUES ('b', 'Math', 'Relazioni', '50%') ;
INSERT INTO submission (user, category, test, result) VALUES ('b', 'Ita', 'Grammatica', '66%') ;
INSERT INTO submission (user, category, test, result) VALUES ('luca96', 'Music', 'rock', '75%') ;