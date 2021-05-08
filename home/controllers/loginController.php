<?php

require './models/login.php';

class loginController {

    public function index() {
        require './views/login.php';
        unset($_SESSION['login']);
    }

    public function log_user() {
        $username = $_POST['usuario'] ? trim($_POST['usuario']) : false;
        $password = $_POST['password'] ? $_POST['password'] : false;

        if (!$username or!$password) {
            $_SESSION['login']['fatal'] = 'Ha habido un error al recibir los datos';
            require '../views/back.php';
        }

        $login = new login();
        $usuario = $login->log($username, $password);
        $consultorio = $login->getConsultorio();

        if ($usuario and $consultorio) {
            //ALMACENANDO TODO EN SESION USER
            $_SESSION['user'] = $usuario;
            /* med_id
             * nombre
             * apellido
             * titulo
             * institucion
             * cedula_prof
             * celular
             * email
             * password                         * 
             */
            
            //ALMACENANDO INFORMACIÓN DEL CONSULTORIO
            $_SESSION['consultorio'] = $consultorio;
            /*
             * consultorio_id
             * nombre
             * tipo_vivienda
             * calle
             * num_ext
             * num_int
             * estado
             * municipio
             * localidad
             * colonia
             * codigo_postal
             * telefono
             */

            header('Location: ' . base_url . 'consultas/');
        } else {
            require '../views/back.php';
        }
    }

    public function unset_session() {
        unset($_SESSION['user']);
        header('Location: ' . base_url . 'home/login/');
    }

}
