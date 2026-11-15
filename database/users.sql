-- Crear base de datos y tabla de usuarios
CREATE DATABASE IF NOT EXISTS yachay_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE yachay_db;
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('alumno','tutor','docente','director','municipio','minedu','mincul') DEFAULT 'alumno',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
