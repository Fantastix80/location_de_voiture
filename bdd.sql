CREATE DATABASE location_de_voiture;

USE location_de_voiture;

CREATE TABLE clients(
    idClient SMALLINT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(40),
    prenom VARCHAR(40),
    codePostal VARCHAR(10),
    localite VARCHAR(50),
    rue VARCHAR(80),
    numero VARCHAR(10),
    telephone VARCHAR(40),
    email VARCHAR(50)
);

CREATE TABLE voitures(
    immatriculation VARCHAR(20) PRIMARY KEY,
    marque VARCHAR(20),
    modele VARCHAR(20),
    cylindre SMALLINT,
    dateachat DATE
);

CREATE TABLE locations(
    idLocation SMALLINT PRIMARY KEY AUTO_INCREMENT,
    idClient SMALLINT REFERENCES clients(idClient),
    immatriculation VARCHAR(20) REFERENCES voitures(immatriculation),
    dateDebut DATETIME,
    dateFin DATETIME,
    dateRentree DATETIME,
    assurance TINYINT
);

INSERT INTO voitures VALUES("FP8-AZX8-DF8", "Peugeot", "208", 80, STR_TO_DATE("2010-09-10", "%Y-%m-%d"));
INSERT INTO voitures VALUES("FP8-DR64-DF8", "Peugeot", "208 2ème génération", 105, STR_TO_DATE("2021-09-10", "%Y-%m-%d"));
INSERT INTO voitures VALUES("HGR-5837-DXD", "Citroën", "C4", 65, STR_TO_DATE("2015-10-25", "%Y-%m-%d"));
INSERT INTO voitures VALUES("JEO-M87Z-X2D", "Volswagen", "Petit oiseau", 59, STR_TO_DATE("2009-01-04", "%Y-%m-%d"));
INSERT INTO voitures VALUES("JO0-N17Z-KAA", "Renault", "Clio 2", 10, STR_TO_DATE("2012-11-14", "%Y-%m-%d"));
INSERT INTO voitures VALUES("P4E-8EZ3-NDJ", "Tesla", "Model 3", 180, STR_TO_DATE("2020-04-19", "%Y-%m-%d"));
INSERT INTO voitures VALUES("PRE-83J3-EJK", "Tesla", "Model S", 260, STR_TO_DATE("2022-12-31", "%Y-%m-%d"));

INSERT INTO clients(nom, prenom, codePostal, localite, rue, numero, telephone, email) VALUES("Van Wittenberge", "Jean", "92200", "Neuilly-Sur-Seine", "Avenue de Madrid", "11Bis", "0669743510", "jean@gmail.com");
INSERT INTO clients(nom, prenom, codePostal, localite, rue, numero, telephone, email) VALUES("Van Wittenberge", "Kevin", "92200", "Neuilly-Sur-Seine", "Avenue de Madrid", "11Bis", "0738472612", "kevin@gmail.com");
INSERT INTO clients(nom, prenom, codePostal, localite, rue, numero, telephone, email) VALUES("Van Wittenberge", "Nicolas", "92200", "Paris", "Rue de la Liberté", "13", "0764358498", "nicolas@gmail.com");
INSERT INTO clients(nom, prenom, codePostal, localite, rue, numero, telephone, email) VALUES("Mister", "Hugo", "92200", "Paris", "Avenue de Nord", "54Ter", "0764574900", "hugo@gmail.com");
INSERT INTO clients(nom, prenom, codePostal, localite, rue, numero, telephone, email) VALUES("Buet", "Quentin", "91000", "Sartrouville", "Rue du Sud", "01", "0654372323", "quentin@gmail.com");
INSERT INTO clients(nom, prenom, codePostal, localite, rue, numero, telephone, email) VALUES("Alves", "Helder", "93300", "Issy-Les-Moulineaux", "Avenue de France", "44", "0683746266", "helder@gmail.com");

INSERT INTO locations(idClient, immatriculation, dateDebut, dateFin, dateRentree, assurance) VALUES(1, "PRE-83J3-EJK", STR_TO_DATE("2023-11-15 10:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2023-11-16 10:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2023-11-16 09:53:00", "%Y-%m-%d %H:%i:%s"), 1);
INSERT INTO locations(idClient, immatriculation, dateDebut, dateFin, dateRentree, assurance) VALUES(5, "P4E-8EZ3-NDJ", STR_TO_DATE("2023-01-03 12:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2023-01-04 10:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2023-01-04 09:59:00", "%Y-%m-%d %H:%i:%s"), 1);
INSERT INTO locations(idClient, immatriculation, dateDebut, dateFin, dateRentree, assurance) VALUES(1, "PRE-83J3-EJK", STR_TO_DATE("2023-04-23 20:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2023-04-24 21:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2023-04-24 21:05:00", "%Y-%m-%d %H:%i:%s"), 1);
INSERT INTO locations(idClient, immatriculation, dateDebut, dateFin, dateRentree, assurance) VALUES(1, "FP8-DR64-DF8", STR_TO_DATE("2021-06-15 07:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2021-06-16 07:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2021-06-16 07:03:00", "%Y-%m-%d %H:%i:%s"), 1);
INSERT INTO locations(idClient, immatriculation, dateDebut, dateFin, dateRentree, assurance) VALUES(5, "FP8-AZX8-DF8", STR_TO_DATE("2020-11-09 10:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2020-11-16 10:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2020-11-16 09:30:00", "%Y-%m-%d %H:%i:%s"), 1);
INSERT INTO locations(idClient, immatriculation, dateDebut, dateFin, dateRentree, assurance) VALUES(6, "JO0-N17Z-KAA", STR_TO_DATE("2023-10-09 16:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2023-10-10 16:00:00", "%Y-%m-%d %H:%i:%s"), STR_TO_DATE("2023-10-09 16:01:00", "%Y-%m-%d %H:%i:%s"), 0);