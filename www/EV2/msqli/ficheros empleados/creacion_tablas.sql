CREATE DATABASE IF NOT EXISTS musica;
USE musica;
CREATE TABLE IF NOT EXISTS `artistas`
(
    `id_artista`     int(11)     NOT NULL AUTO_INCREMENT,
    `nombre_artista` varchar(30) NOT NULL,
    `pais_artista`   varchar(20) NOT NULL,
    PRIMARY KEY (`id_artista`),
    KEY `id_artista` (`id_artista`)
);

INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('U2', 'Irlanda');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Beatles', 'Reino Unido');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Kylie Minogue', 'AU');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('ABBA', 'Suecia');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Aerosmith ', 'USA');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Eminem', 'Francia');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Mecano', 'España');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Michael Buble', 'Canada');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Lady Gaga', 'USA');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Mariah Carey', 'USA');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Take that', 'Reino Unido');
INSERT INTO `artistas` (`nombre_artista`, `pais_artista`)
VALUES ('Nat King Cole', 'USA');
;

CREATE TABLE IF NOT EXISTS `canciones`
(
    `id_cancion`         int(11)     NOT NULL AUTO_INCREMENT,
    `titulo_cancion`     varchar(30) NOT NULL,
    `fk_artista_cancion` int(11),
    PRIMARY KEY (`id_cancion`),
    FOREIGN KEY (fk_artista_cancion) REFERENCES artistas (id_artista) on update cascade on delete set null
);

INSERT INTO `canciones` (`id_cancion`, `titulo_cancion`, `fk_artista_cancion`)
VALUES (1, 'Chiquitita', 4),
       (2, 'Mamma mia', 4),
       (3, 'Shine', 12),
       (4, 'Hold On', 9),
       (5, 'All you need is love', 2),
       (6, '4 Versus', 6),
       (7, 'Bad Romance', 9),
       (8, 'Yellow Submarine', 2);