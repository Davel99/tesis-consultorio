<?php

class app {

    protected $db;

    public function __construct() {
        $this->db = database::connect();
    }

    public function insertarExamen($peso, $altura, $temperatura, $p_dia, $p_sis, $observaciones) {
        $query = "INSERT INTO examenes VALUES(null, $peso, $altura, $p_dia, $p_sis, $temperatura, '$observaciones')";
        if ($this->db->query($query)) {
            //$query = "SELECT MAX(exa_id) AS id FROM examenes";
            $maxID = $this->db->insert_id;
            return $maxID;
        } else {
            return false;
        }
    }

    public function insertarReceta($diagnostico, $indicaciones) {
        $query = "INSERT INTO recetas VALUES(null, '$diagnostico', '$indicaciones')";
        if ($this->db->query($query)) {
            $maxID = $this->db->insert_id;
            return $maxID;
        } else {
            return false;
        }
    }

    public function insertarMedicamentos($receta_id, $medicamentos, $via_admin, $cantidad, $frecuencia, $periodo) {
        $count = 0;
        for ($i = 0; $i < count($medicamentos); $i++) {
            $query = "INSERT INTO prescripciones VALUES(null, '$receta_id', '$medicamentos[$i]','$via_admin[$i]', '$cantidad[$i]', '$frecuencia[$i]','$periodo[$i]')";
            if ($this->db->query($query)) {
                $count++;
            }
        }

        if ($count == count($medicamentos)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertarSintomas($exa_id, $sintomas) {
        $count = 0;
        for ($i = 0; $i < count($sintomas); $i++) {
            $query = "INSERT INTO sintomas VALUES(null, '$exa_id', '$sintomas[$i]')";
            if ($this->db->query($query)) {
                $count++;
            }
        }

        if ($count == count($sintomas)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertarConsulta($receta_id, $exa_id, $paciente_id, $med_id, $consultorio_id) {

        date_default_timezone_set('America/Mexico_City');
        $hora_s = date('H:i:s');
        $hora_e = $_SESSION['paciente']['hora_e'];
        $query = "INSERT INTO consultas VALUES (null, $receta_id, $paciente_id, $med_id, $consultorio_id, $exa_id, CURDATE(), '$hora_e' , '$hora_s')";

        if ($this->db->query($query)) {
            $maxID = $this->db->insert_id;
            return $maxID;
        } else {
            return false;
        }
    }

    public function insertarAlertas($consulta_id, $temperatura, $imc) {
        if ($temperatura >= 37) {
            $query = "INSERT INTO alertas VALUES(null, $consulta_id, 'Fiebre', 'El paciente tuvo una temperatura de $temperatura')";
            $this->db->query($query);
        }

        if ($imc > 24.9 and $imc < 30) {
            $query = "INSERT INTO alertas VALUES(null, $consulta_id, 'Sobrepeso', 'El paciente tuvo un IMC de $imc')";
            $this->db->query($query);
        } else if ($imc >= 30) {
            $query = "INSERT INTO alertas VALUES(null, $consulta_id, 'Obesidad', 'El paciente tuvo un IMC de $imc')";
            $this->db->query($query);
        }

        return true;
    }

    //BUSCANDO INFORMACIÓN DE LAS CONSULTAS DEL PACIENTE

    public function buscarConsulta($id) {
        $query = "SELECT p.nombre, c.consulta_id, r.diagnostico, r.indicaciones, c.receta_id, c.fecha, e.*" .
                " FROM consultas c NATURAL JOIN pacientes p NATURAL JOIN recetas r NATURAL JOIN examenes e" .
                " WHERE c.paciente_id = $id GROUP BY c.consulta_id DESC LIMIT 5";
        $consultas = $this->db->query($query);

        if ($consultas) {
            return $consultas;
        } else {
            return false;
        }
    }

    public function buscarMedicamentos($id) {
        $query = "SELECT medicamento FROM prescripciones WHERE receta_id = $id";
        $medicamentos = $this->db->query($query);

        if ($medicamentos) {
            return $medicamentos;
        } else {
            return false;
        }
    }

    public function buscarSintomas($id) {
        $query = "SELECT descripcion FROM sintomas WHERE exa_id = $id";
        $sintomas = $this->db->query($query);
        
        if ($sintomas) {
            return $sintomas;
        } else {
            return false;
        }
    }

    public function buscarAlertas($id) {
        $query = "SELECT tipo, descripcion FROM alertas WHERE consulta_id = $id";
        $alertas = $this->db->query($query);

        if ($alertas) {
            return $alertas;
        } else {
            return false;
        }
    }

    public function buscarHistorial($id) {
        $query = "SELECT alergias FROM historialc WHERE paciente_id = $id";
        $historial = $this->db->query($query);

        if ($historial) {
            return $historial;
        } else {
            return false;
        }
    }    

    //BUSCANDO AL PACIENTE

    public function search($id, $email, $consulta) {

        if (!$id and!$email and!$consulta) {
            return false;
        }

        if (!empty($id)) {
            $query = "SELECT *, YEAR(CURDATE())-YEAR(nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(`nacimiento`,'%m-%d'), 0 , -1 ) AS `edad` FROM pacientes WHERE paciente_id = $id";
        } elseif (!empty($email)) {
            $query = "SELECT *, YEAR(CURDATE())-YEAR(nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(`nacimiento`,'%m-%d'), 0 , -1 ) AS `edad` FROM pacientes WHERE email = '$email'";
        } elseif (!empty($consulta)) {
            $query = "SELECT paciente_id FROM consultas WHERE consulta_id = $consulta";
            $paciente = $this->db->query($query);
            if (!$paciente or $paciente == null or $paciente->num_rows == 0){
                return false;                
            }
            $query = "SELECT *, YEAR(CURDATE())-YEAR(nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(`nacimiento`,'%m-%d'), 0 , -1 ) AS `edad` FROM pacientes WHERE paciente_id = $paciente";
        } else {
            return false;
        }
        $resultado = $this->db->query($query);



        if ($resultado and $resultado->num_rows == 1) {
            $paciente = $resultado->fetch_array();
            return $paciente;
        } else {
            return false;
        }
    }

    public function register($nombre, $apellidos, $nacimiento, $celular, $email, $alergias) {
        if (!$nombre or!$apellidos or!$celular or!$email) {
            return false;
        }

        $query = "INSERT INTO pacientes VALUES(null, '$nombre', '$apellidos', '$nacimiento', '$celular', '$email')";
        if ($this->db->query($query)) {
            $id = $this->db->insert_id;
            $query = "INSERT INTO historialc VALUES(null, $id, '$alergias')";

            if ($this->db->query($query)) {
                $query = "SELECT * FROM pacientes WHERE paciente_id='$id'";
                $resultado = $this->db->query($query);
                if ($resultado and $resultado->num_rows == 1) {
                    $usuario = $resultado->fetch_assoc();
                    return $usuario;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

}
