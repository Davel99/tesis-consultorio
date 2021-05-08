<?php

require './models/gestion.php';

class gestionController {

    public function index() {
        header('Location: ' . base_url . 'consultas/');
    }

    public function pacientes() {
        $gestion = new gestion();
        $pacientes = $gestion->traerPacientes();

        require './views/gestion/pacientes.php';
    }

    public function consultas() {
        $gestion = new gestion();
        $consultas = $gestion->buscarConsultas($_SESSION['user']['med_id']);
        $datos = [];

        foreach ($consultas as $con) {
            $medicamentos[] = $gestion->buscarMedicamentos($con['receta_id']);
            $sintomas[] = $gestion->buscarSintomas($con['exa_id']);
            $alertas[] = $gestion->buscarAlertas($con['consulta_id']);
            $datos[] = false;
        }

        require './views/gestion/consultas.php';
    }

    public function act_paciente() {
        $id = $_POST['id'] ? trim($_POST['id']) : false;

        $nombre = $_POST['nombre'] ? trim($_POST['nombre']) : false;
        $nombre = strtoupper($nombre);

        $apellidos = $_POST['apellidos'] ? trim($_POST['apellidos']) : false;
        $apellidos = strtoupper($apellidos);
        //Nacimiento del paciente
        $DIA = $_POST['dia'] ? trim($_POST['dia']) : false;
        $MES = $_POST['mes'] ? trim($_POST['mes']) : false;
        $YEAR = $_POST['year'] ? trim($_POST['year']) : false;
        if ($MES < 10) {
            $nacimiento = "$YEAR-0$MES-$DIA";
        } else {
            $nacimiento = "$YEAR-$MES-$DIA";
        }


        $celular = $_POST['celular'] ? trim($_POST['celular']) : false;
        $email = $_POST['email'] ? trim($_POST['email']) : false;
        $email = strtoupper($email);

        $alergias = $_POST['alergias'] ? trim($_POST['alergias']) : false;
        $alergias = strtoupper($alergias);

        $app = new gestion();
        $resultado = $app->actualizarPacientes($id, $nombre, $apellidos, $nacimiento, $celular, $email, $alergias);


        if ($resultado) {
            $_SESSION['register']['alert'] = 'Cambios realizados correctamente';
        } else {
            $_SESSION['register']['alert'] = 'Algo ha fallado al cambiar los registros';
        }



        require '../views/back.php';
    }

}
