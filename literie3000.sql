CREATE DATABASE literie3000;

USE literie3000;

CREATE TABLE matelas (
  id INT PRIMARY KEY AUTO_INCREMENT,
  marque VARCHAR(50) NOT NULL,
  nom VARCHAR(100) NOT NULL,
  taille VARCHAR(20) NOT NULL,
  prix_normale DECIMAL(10, 2) NOT NULL,
  prix_solde DECIMAL(10, 2) NOT NULL,
  image_url VARCHAR(255) NOT NULL
);


INSERT INTO matelas (marque, nom, taille, prix_normale, prix_solde, image_url)
VALUES
  ('Epeda', 'Matelas Pas Touché', '90x190', 759.00, 529.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTepNTYuZs4pIpgaQ8_sd2_1pnlOSLpmC8ytg&usqp=CAU'),
  ('Bultex', 'Matelas Alejandrinho', '140x190', 759.00, 529.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBYcW40i2RbcEIYbhQ4D6q3iSph5bJMG2cgQ&usqp=CAU'),
  ('Epeda', 'Matelas Lapin', '90x190', 809.00, 709.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqAgOuxUjzu1jwNb-xT5Ez8exhOAA0iSax2g&usqp=CAU'),
  ('Epada', 'Matelas Papy', '160x200', 1019.00, 509.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEzC8G-3zp31aKCkUqttbKxIaZFKN2WN94_h1ttKImLpkzZj29314b0GXBPpvfaIFGZVE&usqp=CAU');