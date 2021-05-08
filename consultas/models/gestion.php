<?php

class gestion {

    protected $db;

    public function __construct() {
        $this->db = database::connect();
    }

    public function buscarConsultas($id) {
        $query = "SELECT p.*, c.consulta_id, r.diagnostico, r.indicaciones, c.receta_id, c.fecha, e.*" .
                " FROM consultas c NATURAL JOIN pacientes p NATURAL JOIN recetas r NATURAL JOIN examenes e" .
                " WHERE c.med_id = $id GROUP BY c.consulta_id DESC";
        $consultas = $this->db->query($query);

        if ($consultas) {
            return $consultas;
        } else {
            return false;
        }
    }

    public function buscarMedicamentos($id) {
        $query = "SELECT * FROM prescripciones WHERE receta_id = $id";
        $medicamentos = $this->db->query($query);

        if ($medicamentos) {
            return $medicamentos;
        } else {
            return false;
        }
    }

    public function buscarSintomas($id) {
        $query = "SELECT * FROM sintomas WHERE exa_id = $id";
        $sintomas = $this->db->query($query);

        if ($sintomas) {
            return $sintomas;
        } else {
            return false;
        }
    }

    public function buscarPaciente($id) {
        $query = "SELECT * FROM pacientes WHERE paciente_id = $id";
        $paciente = $this->db->query($query);

        if ($paciente) {
            return $paciente;
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

    public function traerPacientes() {
        $query = "SELECT p.*, c.alergias FROM pacientes p NATURAL JOIN historialc c";
        $pacientes = $this->db->query($query);
        
        if($pacientes){
            return $pacientes;
        } else {
            return false;
        }
    }

    public function actualizarPacientes($id, $nombre, $apellidos, $nacimiento, $celular, $email, $alergias) {
        $query = "UPDATE pacientes SET nombre = '$nombre', apellidos = '$apellidos', nacimiento = '$nacimiento', celular = '$celular' WHERE paciente_id = $id";
        $resultado = $this->db->query($query);

        if ($resultado) {
            $query = "UPDATE historialc SET alergias = '$alergias' WHERE paciente_id = '$id'";
            $resultado = $this->db->query($query);

            if ($resultado) {               
                return $resultado;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

