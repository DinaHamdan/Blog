-- - Supprime la base de données si elle existe déjà
-- - Crée la base de données
-- - Mentionne le nom de la base de données à utiliser pour exécuter les commandes SQL qui suivent
DROP DATABASE IF EXISTS `520-php-blog-DHA`;
CREATE DATABASE IF NOT EXISTS `520-php-blog-DHA`;
USE `520-php-blog-DHA`;

-- -------------
-- TABLES
-- -------------

CREATE TABLE role (
   id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,code varchar(50) NOT NULL
 ,label varchar(50) NOT NULL
)
;

CREATE TABLE utilisateur(
   id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,email varchar(50) NOT NULL
  ,pass varchar(100) NOT NULL
  ,passClear varchar(100) NOT NULL
  ,description varchar(500) NOT NULL
  ,idRole bigint(20) NOT NULL
  ,avatar longblob NOT NULL
  ,avatar_filename varchar(255) NOT NULL
)
;
CREATE TABLE article(
   id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,title varchar(50) NOT NULL
  ,textContent varchar(2000) NOT NULL
  ,idUtilisateur bigint(20) NOT NULL
  ,illustration longblob NOT NULL
  ,illustration_filename varchar(255) NOT NULL
  ,date_time_column timestamp(6) NOT NULL
)
;

CREATE TABLE commentaire(
   id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,phrase varchar(100) NOT NULL
  ,idUtilisateur bigint(20) NOT NULL
  ,idArticle bigint(20) NOT NULL
  ,date_time_column timestamp(6)  NOT NULL
)
;
CREATE TABLE putLike(
   id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,idUtilisateur bigint(20) NOT NULL
  ,idArticle bigint(20) NOT NULL
  ,date_time_column timestamp(6)  NOT NULL
)
;
-- -------------
-- CONTRAINTES
-- -------------

ALTER TABLE utilisateur
   ADD CONSTRAINT `u_utilisateur_email` UNIQUE(email)
   ,ADD CONSTRAINT `fk_utilisateur_role` FOREIGN KEY(idRole) REFERENCES role(id)
;

ALTER TABLE role
   ADD CONSTRAINT `u_role_code` UNIQUE(code)
  
;
ALTER TABLE article
   ADD CONSTRAINT `fk_article_utilisateur` FOREIGN KEY(idUtilisateur) REFERENCES utilisateur(id)
;

ALTER TABLE commentaire
   ADD CONSTRAINT `fk_commentaire_utilisateur` FOREIGN KEY(idUtilisateur) REFERENCES utilisateur(id)
    ,ADD CONSTRAINT `fk_commentaire_article` FOREIGN KEY(idArticle) REFERENCES article(id)
;

ALTER TABLE putLike
   ADD CONSTRAINT `fk_putLike_utilisateur` FOREIGN KEY(idUtilisateur) REFERENCES utilisateur(id)
    ,ADD CONSTRAINT `fk_putLike_article` FOREIGN KEY(idArticle) REFERENCES article(id)
;