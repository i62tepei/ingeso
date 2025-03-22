-- Active: 1706206659395@@127.0.0.1@3308@ingeso_db
CREATE DATABASE IF NOT EXISTS ingeso_db;
USE ingeso_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(9) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    birthday DATE NOT NULL,
    phone VARCHAR(15),
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `users` (`dni`, `full_name`, `birthday`, `phone`, `email`)
VALUES ('30111222P', 'Pedro Gómez Pérez', '1995-06-25', '611111111', 'emaileteset@test.ese');
