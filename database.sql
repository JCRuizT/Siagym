
CREATE DATABASE IF NOT EXISTS siagym CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE siagym;

CREATE TABLE IF NOT EXISTS usuarios (
  identificacion INT NOT NULL,
  peso INT DEFAULT NULL,
  estatura INT DEFAULT NULL,
  natalicio DATE DEFAULT NULL,
  nombre VARCHAR(100) DEFAULT NULL,
  apellido VARCHAR(100) DEFAULT NULL,
  genero VARCHAR(20) DEFAULT NULL,
  correo VARCHAR(150) DEFAULT NULL,
  rol TINYINT DEFAULT 1,
  PRIMARY KEY (identificacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS carnet (
  id_aprendiz INT NOT NULL,
  ficha INT DEFAULT NULL,
  centro VARCHAR(50) DEFAULT NULL,
  fecha_vencimiento DATE DEFAULT NULL,
  PRIMARY KEY (id_aprendiz),
  CONSTRAINT fk_carnet_usuarios FOREIGN KEY (id_aprendiz) REFERENCES usuarios(identificacion) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS horario (
  id_aprendiz INT NOT NULL,
  horas TINYINT DEFAULT NULL,
  dias TINYINT DEFAULT NULL,
  PRIMARY KEY (id_aprendiz),
  CONSTRAINT fk_horario_usuarios FOREIGN KEY (id_aprendiz) REFERENCES usuarios(identificacion) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS asistencia (
  id INT NOT NULL AUTO_INCREMENT,
  fecha DATE NOT NULL,
  year YEAR NOT NULL,
  hora TINYINT NOT NULL,
  id_aprendiz INT NOT NULL,
  PRIMARY KEY (id),
  KEY idx_asistencia_aprendiz (id_aprendiz),
  UNIQUE KEY uk_asistencia_aprendiz_fecha (id_aprendiz, fecha),
  CONSTRAINT fk_asistencia_usuarios FOREIGN KEY (id_aprendiz) REFERENCES usuarios(identificacion) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admin (
  username VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO admin (username, password) VALUES ('admin', 'YWRtaW4=');
