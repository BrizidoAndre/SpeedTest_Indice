DROP
DATABASE IF EXISTS `song_player_3000`;
CREATE
DATABASE `song_player_3000`;
USE
`song_player_3000`;

CREATE TABLE `artist`
(
    id   int primary key auto_increment,
    name varchar(1000) not null
);

CREATE TABLE `song`
(
    id        int primary key auto_increment,
    title     varchar(1000) not null,
    artist_id int           not null,
    foreign key (artist_id) references artist (id)
);

INSERT INTO `artist` (name)
VALUES ('Charlie xcx'),
       ('Billie Eilish'),
       ('Angra'),
       ('Tyler, The Creator'),
       ('Taylor Swift');

INSERT INTO `song` (title, artist_id)
VALUES ('360', 1),
       ('Club classics', 1),
       ('Talk talk', 1),
       ('BIRDS OF A FEATHER', 2),
       ('CHIHIRO', 2),
       ('WILDFLOWER', 2),
       ('heroes of Sand', 3),
       ('Rebirth', 3),
       ('Unholy Wars', 3),
       ('Boredom (feat. Rex Orange County & Anna of the North)', 4),
       ('Garden Shed (feat. Estelle)', 4),
       ('See You Again (feat. Kali Uchis)', 4),
       ('exile (feat. Bon Iver)', 5),
       ('seven', 5),
       ('peace', 5);
