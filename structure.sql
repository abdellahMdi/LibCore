CREATE DATABASE libCore ;
USE LibCore ;



CREATE TABLE `librarians` (
  `id_lib` INT AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id_lib`)
);

CREATE TABLE `books` (
  `isbn` INT UNIQUE,
  `titre` VARCHAR(50),
  `auteur` VARCHAR(50),
  `etat` VARCHAR(20),
  PRIMARY KEY (`isbn`)
);

CREATE TABLE `members` (
  `id_mem` INT AUTO_INCREMENT,
  `role` VARCHAR(20),
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id_mem`)
);

CREATE TABLE `emprunts` (
  `id` INT AUTO_INCREMENT,
  `return_date` Date,
  `member_id` INT,
  `book_isbn` INT,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`book_isbn`)
      REFERENCES `books`(`isbn`),
  FOREIGN KEY (`member_id`)
      REFERENCES `members`(`id_mem`)
);

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT,
  `nom` VARCHAR(50),
  `email` VARCHAR(100),
  `` <type>,
  PRIMARY KEY (`id`)
);
