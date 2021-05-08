CREATE DATABASE IF NOT EXISTS tesisConsultorioApp
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE tesisConsultorioApp;

-- CRENADO LA TABLA DEL CONSULTORIO
CREATE TABLE IF NOT EXISTS consultorio(
consultorio_id  int(255)     auto_increment     not null,
nombre          varchar(255)                    not null, 
tipo_vivienda   varchar(255)                    not null,
calle           varchar(255)                    not null,
num_ext         varchar(255)                    not null,
num_int         varchar(255)                    not null,
estado          varchar(255)                    not null,
municipio       varchar(255)                    not null,
localidad       varchar(255)                    not null,
colonia         varchar(255)                    not null,
codigo_postal   varchar(255)                    not null,
telefono        varchar(255)                    not null,
CONSTRAINT pk_consultorio        PRIMARY KEY(consultorio_id)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;


-- CREANDO LA TABLA DEL PACIENTE
CREATE TABLE IF NOT EXISTS pacientes(
paciente_id     int(255) auto_increment not null,
nombre          varchar(255)            not null,
apellidos       varchar(255)            not null,
nacimiento      date                    not null,
celular         varchar(255)            not null,
email           varchar(255)            not null,
CONSTRAINT pk_pacientes       PRIMARY KEY(paciente_id),
CONSTRAINT uq_pacientes       UNIQUE(email)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- CREANDO LA TABLA DEL HISTORIAL CLÍNICO
CREATE TABLE IF NOT EXISTS historialc(
clinic_id     int(255) auto_increment   not null,
paciente_id   int(255)                  not null,
alergias      varchar(255)              not null,
CONSTRAINT pk_historialc                PRIMARY KEY(clinic_id),
CONSTRAINT fk_historialc_pacientes      FOREIGN KEY(paciente_id) REFERENCES pacientes(paciente_id)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- CREANDO TABLA DEL MÉDICO
CREATE TABLE IF NOT EXISTS medicos(
med_id          int(255) auto_increment not null,
nombre          varchar(255)            not null,
apellido        varchar(255)            not null,
titulo          varchar(255)            not null,
institucion     varchar(255)            not null,
cedula_prof     varchar(255)            not null,
celular         varchar(255)            not null,
email           varchar(255)            not null,
PASSWORD        varchar(255)            not null,
CONSTRAINT pk_medicos   PRIMARY KEY(med_id),
CONSTRAINT uq_medicos       UNIQUE(email)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;



-- CREANDO LA TABLA DE RECETAS
CREATE TABLE IF NOT EXISTS recetas(
receta_id       int(255)     auto_increment     not null,
diagnostico     varchar(255)                    not null,
indicaciones    varchar(255)                    not null,
CONSTRAINT pk_recetas        PRIMARY KEY(receta_id)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;


-- CREANDO LA TABLA DE PRESCRIPCIONES 
CREATE TABLE IF NOT EXISTS prescripciones(
pres_id         int(255) auto_increment not null,
receta_id       int(255)                not null,
medicamento     varchar(255)            not null,
via_admin       varchar(255)            not null,
cantidad        varchar(255)            not null,
frecuencia      varchar(255)            not null,  
periodo         varchar(255)            not null,       
CONSTRAINT pk_prescripciones            PRIMARY KEY(pres_id),
CONSTRAINT fk_prescripciones_recetas    FOREIGN KEY(receta_id) REFERENCES recetas(receta_id)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;


-- CREANDO TABLA DE EXÁMENES
CREATE TABLE IF NOT EXISTS examenes(
exa_id          int(255) auto_increment not null,
peso            float(10)               not null,
altura          int(255)                not null,
p_dia           int(255)                not null,
p_sis           int(255)                not null,
temperatura     float(10)               not null,
observaciones   varchar(255)            not null,
CONSTRAINT pk_examenes            PRIMARY KEY(exa_id)
)ENGINE=InnoDb;


-- CREANDO TABLA DE SÍNTOMAS
CREATE TABLE IF NOT EXISTS sintomas(
sin_id          int(255)        auto_increment  not null,
exa_id          int(255)                        not null,
descripcion     varchar(255)                    not null,
CONSTRAINT pk_sintomas                  PRIMARY KEY(sin_id),
CONSTRAINT fk_sintomas_examenes         FOREIGN KEY(exa_id)     REFERENCES examenes(exa_id)
)ENGINE=InnoDb;

-- CREANDO TABLA DE OBSERVACIONES
CREATE TABLE IF NOT EXISTS sintomas(
sin_id          int(255)        auto_increment  not null,
exa_id          int(255)                        not null,
descripcion     varchar(255)                    not null,
CONSTRAINT pk_sintomas                  PRIMARY KEY(sin_id),
CONSTRAINT fk_sintomas_examenes         FOREIGN KEY(exa_id)     REFERENCES examenes(exa_id)
)ENGINE=InnoDb;


-- CREANDO TABLA DE CONSULTAS
CREATE TABLE IF NOT EXISTS consultas(
consulta_id     int(255) auto_increment not null,
receta_id       int(255)                not null,
paciente_id     int(255)                not null,
med_id          int(255)                not null,
consultorio_id  int(255)                not null,
exa_id          int(255)                not null,
fecha           date                    not null,
hora_e          time                    not null,
hora_s          time                    not null,  
CONSTRAINT pk_consultas             PRIMARY KEY(consulta_id),
CONSTRAINT fk_cosultas_recetas      FOREIGN KEY(receta_id)      REFERENCES recetas(receta_id),
CONSTRAINT fk_cosultas_pacientes    FOREIGN KEY(paciente_id)    REFERENCES pacientes(paciente_id),
CONSTRAINT fk_cosultas_medicos      FOREIGN KEY(med_id)         REFERENCES medicos(med_id),
CONSTRAINT fk_cosultas_consultorio  FOREIGN KEY(consultorio_id) REFERENCES consultorio(consultorio_id),
CONSTRAINT fk_cosultas_examenes     FOREIGN KEY(exa_id)         REFERENCES examenes(exa_id)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;


-- CREANDO TIPOS DE ALERTAS
CREATE TABLE IF NOT EXISTS alertas(
alert_id        int(255) auto_increment not null,
consulta_id     int(255)                not null,
tipo            varchar(255)            not null,
descripcion     varchar(255)            not null,
CONSTRAINT pk_alertas           PRIMARY KEY(alert_id),
CONSTRAINT fk_alertas_consultas FOREIGN KEY(consulta_id) REFERENCES consultas(consulta_id)
)ENGINE=InnoDb
DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

/*INSERTANDO UN USUARIO*/
INSERT INTO medicos VALUES(NULL, 'Jorge','Perez Hernandez','Licenciado en Medicina', 'UNAM', '2549341', '833-123-1233','medico@admin.com', '$2y$04$m0US6DV1cchVkTBeTDJc6OQocSZxCAK12yyd0wJEHhaKa9mn2.ADu');
/*CONTRASEÑA: DU_tamp_2511 */

/*INSERTANDO UN CONSULTORIO*/
INSERT INTO consultorio VALUES(NULL, 'MiConsultorio','Edificio','Altamira', '315', '', 'Tamaulipas','Tampico', 'Tampico', 'Zona Centro', '89000', '833-124-2245');S


/**
 * Author:  joelm
 * Created: 18/04/2020
 */