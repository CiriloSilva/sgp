
CREATE DATABASE IF NOT EXISTS controle_ponto;
USE controle_ponto;

CREATE TABLE IF NOT EXISTS registros (
  id INT AUTO_INCREMENT PRIMARY KEY,
  uid VARCHAR(32) NOT NULL,
  horario DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS funcionarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  uid VARCHAR(32) UNIQUE,
  nome VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(120) UNIQUE,
  senha VARCHAR(255) NOT NULL
);
