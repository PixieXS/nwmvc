CREATE TABLE peliculas (
  id_pelicula INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(100) NOT NULL,
  director VARCHAR(50),
  ano_estreno INT,
  genero VARCHAR(50),
  duracion_min INT
);