 -- Create Database
Create Database gestion_photospher;
use gestion_photospher;

 -- Create table user et 6 instantion dyalo (3 user basic et 1 user pro et 1 moderateur et 1 admin)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50)  NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('Basic','Pro','Moderator','Admin') NOT NULL,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  lastLogin DATETIME NULL,
  bio TEXT,
  photoProfil VARCHAR(255),
  uploadCountMensuel INT DEFAULT 0,
  abonnementStart DATE NULL,
  abonnementEnd DATE NULL,
  niveau ENUM('junior','senior','lead') NULL,
  isSuperAdmin BOOLEAN DEFAULT null
);
INSERT INTO users
(username, email, password, role, bio, photoProfil,uploadCountMensuel, abonnementStart, abonnementEnd, niveau, isSuperAdmin)
VALUES
('salma','salma@gmail.com','salma123','Basic','Utilisateur basic amateur de photographie','salma.png',3,NULL,NULL,NULL,NULL),
('sara','sara@gmail.com','sara123','Basic','Partage des photos de voyage','sara.jpg',5,NULL,NULL,NULL,NULL),
('salim','salim@gmail.com','salim123','Basic','Débutant en photographie','salim.jpg',1,NULL,NULL,NULL,NULL),
('zahra','zahra@gmail.com','zahra123','Pro','Photographe professionnelle','zahra.png',40,'2025-01-01','2026-01-01',NULL,NULL),
('zahira','zahira@gmail.com','zahira123','Moderator','Responsable de la modération du contenu',NULL,0,NULL,NULL,'senior',NULL),
('salouma','salouma@gmail.com','salouma123','Admin','Administratrice principale du système',NULL,0,NULL,NULL,'lead',TRUE);




-- Create table photo et 6 instantion dyalo
CREATE TABLE photo (
  id_photo INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(200) NOT NULL,
  description TEXT,
  filename VARCHAR(255) NOT NULL,
  taille BIGINT NOT NULL,
  mimeType VARCHAR(50) NOT NULL,
  dimensions VARCHAR(20),
  status ENUM('brouillon','publie','archive') DEFAULT 'brouillon',
  viewsCount INT DEFAULT 0,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  updatedAt DATETIME NULL,
  publishedAt DATETIME NULL,
  id_user INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);
INSERT INTO photo
(titre, description, filename, taille, mimeType, dimensions,
 status, viewsCount, publishedAt, id_user)
VALUES
('Coucher de soleil','Photo prise à la plage au coucher du soleil','sunset.jpg',2456789,'image/jpeg','1920x1080','publie',120,'2025-01-10 18:30:00',1),
('Voyage à Paris','Souvenir de voyage à Paris','paris.jpg',1987654,'image/jpeg','2048x1365','publie',95,'2025-01-12 14:00:00',2),
('Nature calme','Photo de nature au lever du jour','nature.png',1765432,'image/png','1600x900','brouillon',0,NULL,3),
('Portrait artistique','Portrait professionnel en noir et blanc','portrait_bw.jpg',3124567,'image/jpeg','1080x1350','publie',210,'2025-01-15 20:45:00',4),
('Macro fleur','Détail macro d’une fleur','flower_macro.png',1456780,'image/png','1200x1200','publie',67,'2025-01-18 11:20:00',4),
('Ancienne photo','Photo archivée du portfolio','old_photo.jpg',987654,'image/jpeg','1024x768','archive',18,'2024-12-01 10:00:00',4);




-- Create table album et 6 instantion dyalo
CREATE TABLE album (
  id_album INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  description TEXT,
  privacy ENUM('public','prive') DEFAULT 'public',
  nbPhotos INT DEFAULT 0,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  updatedAt DATETIME NULL,
  id_user INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);
INSERT INTO album
(nom, description, privacy, nbPhotos, updatedAt, id_user)
VALUES
('Nature','Album de photos de nature','public',2,NULL,1),
('Voyages','Photos de voyages et découvertes','public',1,NULL,2),
('Moments simples','Quelques photos personnelles','public',1,NULL,3),
('Portfolio Pro','Portfolio professionnel pour les clients','prive',3,NULL,4),
('Portraits','Collection de portraits artistiques','public',2,NULL,4),
('Archives','Anciennes photos archivées','prive',1,NULL,4);



-- Create table photo_album et 6 instantion dyalo car chaque photo t9dar tkon fi bzaaf dyal album ou album fih bzaaf dyal les photos
CREATE TABLE photo_album (
  id_photo INT,
  id_album INT,
  PRIMARY KEY (id_photo, id_album),
  FOREIGN KEY (id_photo) REFERENCES photo(id_photo) ON DELETE CASCADE,
  FOREIGN KEY (id_album) REFERENCES album(id_album) ON DELETE CASCADE
);
INSERT INTO photo_album (id_photo, id_album)
VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 3),
(4, 4),
(4, 5),
(5, 1),
(5, 4),
(6, 6);



-- Create table tag et 6 instantion dyalo 
CREATE TABLE tag (
  id_tag INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(50) UNIQUE NOT NULL,
  slug VARCHAR(60) NOT NULL,
  usageCount INT DEFAULT 0
);
INSERT INTO tag (nom, slug, usageCount)
VALUES
('Nature', 'nature', 2),
('Voyage', 'voyage', 2),
('Portrait', 'portrait', 1),
('Macro', 'macro', 1),
('Noir et blanc', 'noir-et-blanc', 1),
('Archive', 'archive', 1);




-- Create table photo_tag et 6 instantion dyalo 
CREATE TABLE photo_tag (
  id_photo INT,
  id_tag INT,
  PRIMARY KEY (id_photo, id_tag),
  FOREIGN KEY (id_photo) REFERENCES photo(id_photo) ON DELETE CASCADE,
  FOREIGN KEY (id_tag) REFERENCES tag(id_tag) ON DELETE CASCADE
);
INSERT INTO photo_tag (id_photo, id_tag)
VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1),
(4, 3),
(4, 5),
(5, 4),
(5, 1),
(6, 6);




-- Create table  commentaire et 6 instantion dyalo 
CREATE TABLE commentaire (
  id_com INT AUTO_INCREMENT PRIMARY KEY,
  contenu TEXT(500) NOT NULL,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  updatedAt DATETIME NULL,
  isEdited BOOLEAN DEFAULT FALSE,
  id_user INT NOT NULL,
  id_photo INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (id_photo) REFERENCES photo(id_photo) ON DELETE CASCADE
);
INSERT INTO commentaire (contenu, id_user, id_photo)
VALUES
('Magnifique coucher de soleil !', 2, 1),
('J’adore cette photo de Paris !', 3, 2),
('Superbe capture de la nature', 1, 3),
('Portrait très artistique', 4, 4),
('Détail incroyable sur la fleur !', 4, 5),
('Photo ancienne pleine de souvenirs', 2, 6);




-- Create table like et 6 instantion dyalo 
CREATE TABLE likes (
  id_like INT AUTO_INCREMENT PRIMARY KEY,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  id_user INT NOT NULL,
  id_photo INT NOT NULL,
  UNIQUE (id_user, id_photo),
  FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (id_photo) REFERENCES photo(id_photo) ON DELETE CASCADE
);
INSERT INTO likes (id_user, id_photo)
VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 4),
(4, 5),
(2, 6);

