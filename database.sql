
CREATE DATABASE IF NOT EXISTS siagym CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE siagym;


CREATE TABLE IF NOT EXISTS rol (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    
CREATE TABLE IF NOT EXISTS usuarios (
  identificacion INT NOT NULL,
  peso INT DEFAULT NULL,
  estatura INT DEFAULT NULL,
  natalicio DATE DEFAULT NULL,
  nombre VARCHAR(100) DEFAULT NULL,
  apellido VARCHAR(100) DEFAULT NULL,
  genero VARCHAR(20) DEFAULT NULL,
  correo VARCHAR(150) DEFAULT NULL,
  rol INT DEFAULT NULL,
  PRIMARY KEY (identificacion),
  KEY idx_usuarios_rol (rol),
  CONSTRAINT fk_usuarios_rol FOREIGN KEY (rol) REFERENCES rol(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS carnet (
  id_aprendiz INT NOT NULL,
  ficha INT DEFAULT NULL,
  centro VARCHAR(50) DEFAULT NULL,
  fecha_vencimiento DATE DEFAULT NULL,
  PRIMARY KEY (id_aprendiz),
  CONSTRAINT fk_carnet_usuarios FOREIGN KEY (id_aprendiz) REFERENCES usuarios(identificacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS horario (
  id_aprendiz INT NOT NULL,
  schedule_time_id INT DEFAULT NULL,
  PRIMARY KEY (id_aprendiz),
  KEY idx_horario_sched_time (schedule_time_id),
  CONSTRAINT fk_horario_usuarios FOREIGN KEY (id_aprendiz) REFERENCES usuarios(identificacion),
  CONSTRAINT fk_horario_sched_time FOREIGN KEY (schedule_time_id) REFERENCES schedule_days_times(id) ON DELETE SET NULL
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
  CONSTRAINT fk_asistencia_usuarios FOREIGN KEY (id_aprendiz) REFERENCES usuarios(identificacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admin (
  username VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS schedules (
  id INT NOT NULL AUTO_INCREMENT,
  role INT DEFAULT NULL,
  estado TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  KEY idx_schedule_role (role),
  CONSTRAINT fk_schedule_rol FOREIGN KEY (role) REFERENCES rol(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS schedule_days (
  id INT NOT NULL AUTO_INCREMENT,
  schedule_id INT NOT NULL,
  day_of_week TINYINT NOT NULL COMMENT '0=Sun..6=Sat',
  PRIMARY KEY (id),
  KEY idx_schedule_day (schedule_id, day_of_week),
  CONSTRAINT fk_schedule_days_sched FOREIGN KEY (schedule_id) REFERENCES schedules(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS schedule_days_times (
  id INT NOT NULL AUTO_INCREMENT,
  schedule_days_id INT NOT NULL,
  start_time TIME NOT NULL,
  end_time TIME NOT NULL,
  start_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_schedule_times (schedule_days_id),
  CONSTRAINT fk_schedule_times_sched FOREIGN KEY (schedule_days_id) REFERENCES schedule_days(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin (username, password) VALUES ('admin', 'YWRtaW4=');
