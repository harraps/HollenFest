SET FOREIGN_KEY_CHECKS=0;

INSERT INTO fr_stage (name) value ("Holen"),("Folter"),("Altar"),("Temple"),("Warzone");

SELECT * FROM fr_stage;


/* JOUR 1 */
INSERT INTO fr_rockband (name) value
("Nightmare"),("CrossFaith"),("Satan"),("Lynch Mob"),("Therapy"),("Sabaton"),
("Rob Zombie"),("Iron  Maiden"),("Angelus Apatrida"),("Doyle Airence"),
("Fueled By Fire"),("Toxic Holocaust"),("M.O.D"),("Death Angel"),("Sepultura"),
("Trivium"),("Weekend Nachos"),("Kronos"),("BlockHeads"),("Loudblast"),
("Hail Of Bullets"),("Nocturnus AD"),("Kataklysm"),("Death To All"),
("Necroblood"),("Order Of Apollypon"),("Impiety"),("Ghenna"),("Destroyer 666"),
("Impaled Nazarenne"),("Turisas"),("Watain"),("Enslaved"),("First Blood"),
("Brutality Will Prvail"),("Stick To Yours Guns"),("Rotting Out"),("Slapshot"),
("Downset"),("Pro Pain"),("Wallq  Of Jericho");

/* JOUR 2 */
INSERT INTO fr_rockband (name) value
("Du ferme"), ("Ultra Vomit"),("HollenWurst"),("lenovo"),("Death Boulanger"),
("Turand2Tess"),("Carotte of evil"),("Potager du mal"),("Red devil"),("Infamous Santan"),
("Belzebute président"),("NyphoDevil"),("Lucky Death"),("Dark spaghetti"),("Imagine Papy"),
("Papy Hardcore"),("Sabaillon");


SELECT * FROM fr_rockband;

/* GENRE */

INSERT INTO fr_genre (name) VALUES
("Heady metal"),("Metalcore"),("Hard rock"),("Metal Alternatif"),("Power Metal"),("Trash Metal"),("Post Hardcore"),("Revival Trash"),
("Death Metal"),("Casse des Bouches"),("Black Metal"),("Vicking Metal"),("Unblack Metal"),("Latin Metal");

SELECT * FROM fr_genre;

 /* JOUR 1 */
INSERT INTO fr_concert (rockband_id, stage_id, beginTime, endTime) values 
(1,1,"2015-06-19T11:05:00.000","2015-06-19T11:35:00.000" ),(2,1,"2015-06-19T12:15:00.000","2015-06-19T12:45:00.000"),(3,1,"2015-06-19T13:35:00.000","2015-06-19T14:15:00.000"),(4,1,"2015-06-19T15:10:00.000","2015-06-19T15:55:00.000"),(5,1,"2015-06-19T16:55:00.000","2015-06-19T17:45:00.000"),(6,1,"2015-06-19T18:45:00.000","2015-06-19T19:40:00.000"),(7,1,"2015-06-19T20:40:00.000","2015-06-19T21:45:00.000"),(8,1,"2015-06-19T22:55:00.000","2015-06-20T00:55:00.000"),
(9,2,"2015-06-19T10:30:00.000","2015-06-19T11:00:00.000"),(10,2,"2015-06-19T11:40:00.000","2015-06-19T12:10:00.000"),(11,2,"2015-06-19T12:50:00.000","2015-06-19T13:30:00.000"),(12,2,"2015-06-19T14:20:00.000","2015-06-19T15:05:00.000"),(13,2,"2015-06-19T16:00:00.000","2015-06-19T16:50:00.000"),(14,2,"2015-06-19T17:50:00.000","2015-06-19T18:40:00.000"),(15,2,"2015-06-19T19:45:00.000","15-06-19T20:35:00.000"),(16,2,"2015-06-19T21:50:00.000","2015-06-19T22:50:00.000"),(17,2,"2015-06-20T01:00:00.000","2015-06-20T02:05:00.000"),
(18,3,"2015-06-19T11:05:00.000","2015-06-19T11:35:00.000"),(19,3,"2015-06-19T12:15:00.000","2015-06-19T12:45:00.000"),(20,3,"2015-06-19T13:35:00.000","2015-06-19T14:15:00.000"),(21,3,"2015-06-19T15:10:00.000","2015-06-19T15:55:00.000"),(22,3,"2015-06-19T16:55:00.000","2015-06-19T17:45:00.000"),(23,3,"2015-06-19T18:45:00.000","2015-06-19T19:40:00.000"),(24,3,"2015-06-19T20:45:00.000","2015-06-19T21:45:00.000"),(25,3,"2015-06-19T22:55:00.000","2015-06-19T23:55:00.000"),(26,3,"2015-06-20T01:05:00.000","2015-06-20T02:05:00.000"),
(27,4,"2015-06-19T10:30:00.000","2015-06-19T11:40:00.000"),(28,4,"2015-06-19T12:50:00.000","2015-06-19T13:30:00.000"),(29,4,"2015-06-19T14:20:00.000","2015-06-19T15:05:00.000"),(30,4,"2015-06-19T16:00:00.000","2015-06-19T16:50:00.000"),(31,4,"2015-06-19T17:50:00.000","2015-06-19T18:40:00.000"),(32,4,"2015-06-19T19:45:00.000","2015-06-19T20:40:00.000"),(33,4,"2015-06-19T21:50:00.000","2015-06-19T22:50:00.000"),(34,4,"2015-06-20T00:00:00.000","2015-06-20T01:00:00.000"),
(35,5,"2015-06-19T11:05:00.000","2015-06-19T11:35:00.000"),(36,5,"2015-06-19T12:15:00.000","2015-06-19T12:45:00.000"),(37,5,"2015-06-19T13:35:00.000","2015-06-19T14:15:00.000"),(38,5,"2015-06-19T15:10:00.000","2015-06-19T15:55:00.000"),(39,5,"2015-06-19T16:55:00.000","2015-06-19T17:45:00.000"),(40,5,"2015-06-19T18:45:00.000","2015-06-19T19:40:00.000"),(41,5,"2015-06-19T20:45:00.000","2015-06-19T21:45:00.000"),(42,5,"2015-06-19T22:55:00.000","2015-06-19T23:55:00.000"),(43,5,"2015-06-20T01:05:00.000","2015-06-20T02:05:00.000");

 /* JOUR 2 */
INSERT INTO fr_concert (rockband_id, stage_id, beginTime, endTime) values 
(10,1,"2015-06-20T11:05:00.000","2015-06-20T11:35:00.000" ),(44,1,"2015-06-20T12:15:00.000","2015-06-20T12:45:00.000"),(45,1,"2015-06-20T13:35:00.000","2015-06-20T14:15:00.000"),(46,1,"2015-06-20T15:10:00.000","2015-06-20T15:55:00.000"),(47,1,"2015-06-20T16:55:00.000","2015-06-20T17:45:00.000"),(48,1,"2015-06-20T18:45:00.000","2015-06-20T19:40:00.000"),(49,1,"2015-06-20T20:40:00.000","2015-06-20T21:45:00.000"),(49,1,"2015-06-20T22:55:00.000","2015-06-21T00:55:00.000"),
(50,2,"2015-06-20T10:30:00.000","2015-06-20T11:00:00.000"),(51,2,"2015-06-20T11:40:00.000","2015-06-20T12:10:00.000"),(52,2,"2015-06-20T12:50:00.000","2015-06-20T13:30:00.000"),(53,2,"2015-06-20T14:20:00.000","2015-06-20T15:05:00.000"),(54,2,"2015-06-20T16:55:00.000","2015-06-20T16:50:00.000"),(55,2,"2015-06-20T17:50:00.000","2015-06-20T18:40:00.000"),(56,2,"2015-06-20T19:45:00.000","15-06-19T20:35:00.000"),(57,2,"2015-06-20T21:50:00.000","2015-06-20T22:50:00.000"),(58,2,"2015-06-21T01:00:00.000","2015-06-21T02:05:00.000"),
(20,3,"2015-06-20T11:05:00.000","2015-06-20T11:35:00.000"),(21,3,"2015-06-20T12:15:00.000","2015-06-20T12:45:00.000"),(22,3,"2015-06-20T13:35:00.000","2015-06-20T14:15:00.000"),(23,3,"2015-06-20T15:10:00.000","2015-06-20T15:55:00.000"),(24,3,"2015-06-20T16:55:00.000","2015-06-20T17:45:00.000"),(25,3,"2015-06-20T18:45:00.000","2015-06-20T19:40:00.000"),(26,3,"2015-06-20T20:45:00.000","2015-06-20T21:45:00.000"),(27,3,"2015-06-20T22:55:00.000","2015-06-20T23:55:00.000"),(28,3,"2015-06-21T01:05:00.000","2015-06-21T02:05:00.000"),
(30,4,"2015-06-20T10:30:00.000","2015-06-20T11:40:00.000"),(31,4,"2015-06-20T12:50:00.000","2015-06-20T13:30:00.000"),(32,4,"2015-06-20T14:20:00.000","2015-06-20T15:05:00.000"),(33,4,"2015-06-20T16:00:00.000","2015-06-20T16:50:00.000"),(34,4,"2015-06-20T17:50:00.000","2015-06-20T18:40:00.000"),(35,4,"2015-06-20T19:45:00.000","2015-06-20T20:40:00.000"),(36,4,"2015-06-20T21:50:00.000","2015-06-20T22:50:00.000"),(37,4,"2015-06-21T00:00:00.000","2015-06-21T01:00:00.000"),
(1,5,"2015-06-20T11:05:00.000","2015-06-20T11:35:00.000"),(2,5,"2015-06-20T12:15:00.000","2015-06-20T12:45:00.000"),(3,5,"2015-06-20T13:35:00.000","2015-06-20T14:15:00.000"),(4,5,"2015-06-20T15:10:00.000","2015-06-20T15:55:00.000"),(5,5,"2015-06-20T16:55:00.000","2015-06-20T17:45:00.000"),(6,5,"2015-06-20T18:45:00.000","2015-06-20T19:40:00.000"),(7,5,"2015-06-20T20:45:00.000","2015-06-20T21:45:00.000"),(8,5,"2015-06-20T22:55:00.000","2015-06-20T23:55:00.000"),(9,5,"2015-06-21T01:05:00.000","2015-06-21T02:05:00.000");

/* JOUR 3 */
INSERT INTO fr_concert (rockband_id, stage_id, beginTime, endTime) values 
(24,1,"2015-06-21T11:05:00.000","2015-06-21T11:35:00.000" ),(10,1,"2015-06-21T12:15:00.000","2015-06-21T12:45:00.000"),(11,1,"2015-06-21T13:35:00.000","2015-06-21T14:15:00.000"),(12,1,"2015-06-21T15:10:00.000","2015-06-21T15:55:00.000"),(13,1,"2015-06-21T16:55:00.000","2015-06-21T17:45:00.000"),(20,1,"2015-06-21T18:45:00.000","2015-06-21T19:40:00.000"),(21,1,"2015-06-21T20:40:00.000","2015-06-21T21:45:00.000"),(22,1,"2015-06-21T22:55:00.000","2015-06-22T00:55:00.000"),
(1,2,"2015-06-21T10:30:00.000","2015-06-21T11:00:00.000"),(2,2,"2015-06-21T11:40:00.000","2015-06-21T12:10:00.000"),(3,2,"2015-06-21T12:50:00.000","2015-06-21T13:30:00.000"),(14,2,"2015-06-21T14:20:00.000","2015-06-21T15:05:00.000"),(15,2,"2015-06-21T16:55:00.000","2015-06-21T16:50:00.000"),(16,2,"2015-06-21T17:50:00.000","2015-06-21T18:40:00.000"),(17,2,"2015-06-21T19:45:00.000","15-06-21T20:35:00.000"),(18,2,"2015-06-21T21:50:00.000","2015-06-21T22:50:00.000"),(19,2,"2015-06-22T01:00:00.000","2015-06-22T02:05:00.000"),
(30,3,"2015-06-21T11:05:00.000","2015-06-21T11:35:00.000"),(41,3,"2015-06-21T12:15:00.000","2015-06-21T12:45:00.000"),(32,3,"2015-06-21T13:35:00.000","2015-06-21T14:15:00.000"),(43,3,"2015-06-21T15:10:00.000","2015-06-21T15:55:00.000"),(34,3,"2015-06-21T16:55:00.000","2015-06-21T17:45:00.000"),(45,3,"2015-06-21T18:45:00.000","2015-06-21T19:40:00.000"),(36,3,"2015-06-21T20:45:00.000","2015-06-21T21:45:00.000"),(47,3,"2015-06-21T22:55:00.000","2015-06-21T23:55:00.000"),(38,3,"2015-06-22T01:05:00.000","2015-06-22T02:05:00.000"),
(40,4,"2015-06-21T10:30:00.000","2015-06-21T11:40:00.000"),(31,4,"2015-06-21T12:50:00.000","2015-06-21T13:30:00.000"),(42,4,"2015-06-21T14:20:00.000","2015-06-21T15:05:00.000"),(33,4,"2015-06-21T16:00:00.000","2015-06-21T16:50:00.000"),(44,4,"2015-06-21T17:50:00.000","2015-06-21T18:40:00.000"),(35,4,"2015-06-21T19:45:00.000","2015-06-21T20:40:00.000"),(46,4,"2015-06-21T21:50:00.000","2015-06-21T22:50:00.000"),(37,4,"2015-06-22T00:00:00.000","2015-06-22T01:00:00.000"),
(50,5,"2015-06-21T11:05:00.000","2015-06-21T11:35:00.000"),(52,5,"2015-06-21T12:15:00.000","2015-06-21T12:45:00.000"),(53,5,"2015-06-21T13:35:00.000","2015-06-21T14:15:00.000"),(54,5,"2015-06-21T15:10:00.000","2015-06-21T15:55:00.000"),(55,5,"2015-06-21T16:55:00.000","2015-06-21T17:45:00.000"),(56,5,"2015-06-21T18:45:00.000","2015-06-21T19:40:00.000"),(57,5,"2015-06-21T20:45:00.000","2015-06-21T21:45:00.000"),(58,5,"2015-06-21T22:55:00.000","2015-06-21T23:55:00.000"),(9,5,"2015-06-22T01:05:00.000","2015-06-22T02:05:00.000");

select * from fr_concert;

INSERT INTO fr_genres_rockbands (rockband_id, genre_id) values
(1,1),
(2,2),
(3,3),
(4,4),
(5,5),
(6,6),
(7,7),
(8,8),
(9,9),
(10,10),
(11,12),
(12,13),
(13,14),
(14,15),
(15,1),
(16,4),
(17,6),
(18,7),
(19,9),
(20,8),
(21,5),
(22,5),
(23,6),
(24,7),
(25,12),
(26,14),
(27,15),
(28,7),
(29,5),
(30,6),
(31,8),
(32,2),
(34,3),
(35,1),
(36,10),
(37,2),
(38,2),
(39,3),
(40,5),
(41,8),
(42,9),
(43,11),
(44,2),
(45,1),
(46,6),
(47,11),
(48,12),
(49,14),
(50,14),
(51,16),
(52,13),
(53,15),
(54,1),
(55,11),
(56,6),
(57,9),
(58,8);

SELECT * FROM fr_genres_rockbands;

SET FOREIGN_KEY_CHECKS=1;