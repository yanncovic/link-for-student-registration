CREATE TABLE IF NOT EXISTS etudiant (
    id_etudiant INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,
    lieu_naissance VARCHAR(255) NOT NULL,
    sexe ENUM('masculin', 'féminin') NOT NULL,  -- Utilisation d'ENUM pour restreindre les valeurs possibles
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(255) NOT NULL,
    pays VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    parcours VARCHAR(255) NOT NULL,
    niveau_etudes VARCHAR(50) NOT NULL,
    id_filiere INT,
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
        ON DELETE SET NULL  -- Si la filière est supprimée, l'étudiant garde sa fiche
        ON UPDATE CASCADE    -- Si l'identifiant de filière change, il est mis à jour pour tous les étudiants
);

-- Création de la table utilisateur
CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    identifiant VARCHAR(255) NOT NULL UNIQUE,  -- Assure que l'identifiant est unique
    motdepasse VARCHAR(255) NOT NULL,
    profil ENUM('administrateur', 'invite') NOT NULL
);