/* INSTRUCIÓN EXITOSA PARA SACAR CONSULTAS DE UN ID DE PACIENTE */
SELECT p.nombre, c.consulta_id, r.diagnostico, r.indicaciones 
FROM consultas c 
INNER JOIN pacientes p ON c.paciente_id = p.paciente_id 
INNER JOIN recetas r ON c.receta_id = r.receta_id 
WHERE c.paciente_id = 1
GROUP BY c.consulta_id DESC
LIMIT 5;




/*MEJORANDO INSTURCCIÓN CON EL NATURAL JOIN  Y AÑADIENDO DATOS*/

SELECT p.nombre, c.consulta_id, r.diagnostico, r.indicaciones, c.receta_id, c.fecha, e.*
FROM consultas c 
NATURAL JOIN pacientes p 
NATURAL JOIN recetas r
NATURAL JOIN examenes e
WHERE c.paciente_id = 1
GROUP BY c.consulta_id DESC
LIMIT 5;


/* EXTRAYENDO TABLA DE MEDICAMENTOS ANOTADOS EN LA RECETA*/

SELECT medicamento 
FROM prescripciones 
WHERE receta_id = 4;

/* EXTRAYENDO TABLA DE INDICACIONES GENERALES ANOTADOS EN LA RECETA*/

SELECT diagnostico, indicaciones
FROM recetas 
WHERE receta_id = 4;



/* EXTRAYENDO DE LA TABLA DE EXAMENES */

SELECT * 
FROM examenes
WHERE exa_id = 4;

/* EXTRAYENDO TABLA DE SINTOMAS ANOTADOS EN LA RECETA*/

SELECT descripcion
FROM sintomas 
WHERE exa_id = 4;



/* EXTRAYENDO TODAS LAS ALERTAS DE LAS CONSULTAS */

SELECT tipo, descripcion
FROM alertas
WHERE consulta_id = 1;


/* EXTRAYENDO HISTORIAL CLINICO DEL PACIENTE */

SELECT tipo_sangre, alergias
FROM historialc
WHERE paciente_id = 1;

/* RESETEANDO VALORES SIN TOCAR TABLA DE MEDICOS NI CONSULTORIO */

DELETE FROM alertas;
ALTER TABLE alertas AUTO_INCREMENT = 1;
DELETE FROM sintomas;
ALTER TABLE sintomas AUTO_INCREMENT = 1;
DELETE FROM prescripciones;
ALTER TABLE prescripciones AUTO_INCREMENT = 1;
DELETE FROM consultas;
ALTER TABLE consultas AUTO_INCREMENT = 1;
DELETE FROM recetas;
ALTER TABLE recetas AUTO_INCREMENT = 1;
DELETE FROM examenes;
ALTER TABLE examenes AUTO_INCREMENT = 1;
DELETE FROM historialc;
ALTER TABLE historialc AUTO_INCREMENT = 1;
DELETE FROM pacientes;
ALTER TABLE pacientes AUTO_INCREMENT = 1;