drop database if exists gestionstagiaire_v1;
CREATE DATABASE gestionstagiaire_v1;
USE gestionstagiaire_v1;
CREATE TABLE compteAdministrateur (
    loginAdmin VARCHAR(255),
    motPasse VARCHAR(10),
    nom VARCHAR(20),
    prenom VARCHAR(20)
);

INSERT INTO compteAdministrateur (loginAdmin, motPasse, nom, prenom)
VALUES
    ('Boujenoui48@gmail.com', '123456', 'BOUJENOUI', 'ZAKARIA'),
    ('abdu.boujenoui@gmail.com', '123456', 'BOUJENOUI', 'ABDELLATIF');

-- Créer la table filiere
CREATE TABLE filiere (
    idFiliere VARCHAR(5),
    intitule VARCHAR(20),
    nombreGroupe INT(11)
);

-- Insérer des données dans la table filiere
INSERT INTO filiere (idFiliere, intitule, nombreGroupe)
VALUES
    ('F1', 'Dev digital', 2),
    ('F2', 'Math', 4),
    ('F3', 'infrastructure digital', 7);

-- Créer la table stagiaire
CREATE TABLE stagiaire (
    idStagiaire INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(20),
    prenom VARCHAR(20),
    dateNaissance DATE,
    photoProfil TEXT,
    idFiliere VARCHAR(5)
);

-- Insérer des données dans la table stagiaire
INSERT INTO stagiaire (idStagiaire, nom, prenom, dateNaissance, photoProfil, idFiliere)
VALUES
    (1, 'Boujenoui', 'zakaria', '2000-01-01', 'photo1.jpg', 'F1'),
    (2, 'almou', 'oualid', '2000-02-02', 'photo2.jpg', 'F1'),
    (3, 'zouine', 'med', '2000-03-03', 'photo3.jpg', 'F2');

