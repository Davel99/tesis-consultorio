<?php

class login {

    protected $db;

    public function __construct() {
        $this->db = database::connect();
    }

    public function log($username, $password) {
        $query = "SELECT * FROM medicos WHERE email = '$username'";
        $user = $this->db->query($query);

        if ($user and $user->num_rows == 1) {
            $usuario = $user->fetch_array();

            if (password_verify($password, $usuario['PASSWORD'])) {
                return $usuario;
            } else {
                $_SESSION['login']['error'] = '¡Contraseña incorrecta!';
            }
        } else {
            $_SESSION['login']['error'] = '¡Usuario incorrecto!';
        }
        return false;
    }

    //Almacenando consultorio
    public function getConsultorio() {
        $query = "SELECT * FROM consultorio WHERE consultorio_id = '1'";
        $consultorio = $this->db->query($query);

        if ($consultorio) {
            return $consultorio->fetch_array();
        } else {
            return false;
        }
    }

}
