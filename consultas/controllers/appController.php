<?php

require './models/app.php';

class appController {

    public function procesar() {

        if (!isset($_SESSION['paciente'])) {
            require '../views/redirect.php';
        }

        date_default_timezone_set('America/Mexico_City');
        $hora = date('H:i:s');
        $_SESSION['paciente']['hora_e'] = $hora;

        $paciente = $_SESSION['paciente']['usuario'];

        $app = new app();

        $id = $paciente['paciente_id'];
        $consultas = $app->buscarConsulta($id);
        $historial = $app->buscarHistorial($id);

        $medicamentos = array();
        $sintomas = array();
        $alertas = array();



        foreach ($consultas as $con) {
            $medicamentos[] = $app->buscarMedicamentos($con['receta_id']);
            $sintomas[] = $app->buscarSintomas($con['exa_id']);
            $alertas[] = $app->buscarAlertas($con['consulta_id']);
        }

        $hist = $historial->fetch_assoc();
        //Se pasa el historial a un FETCH ASSOC para convertirlo en ARRAY


        require './views/app/consulta.php';


        //unset($_SESSION['paciente']);
    }

    public function exito() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $peso = $_POST['peso'];
            $altura = $_POST['altura'];
            $alt = $altura / 100;
            $imc = $peso / ($alt * $alt);
            $imc = round($imc,2);

            $temperatura = $_POST['temperatura'];

            $p_sis = $_POST['p_sis'];
            $p_dia = $_POST['p_dia'];

            $observaciones = $_POST['observacion'];
            $sintomas = $_POST['sintoma'];
            $via_admin = $_POST['via'];
            $medicamentos = $_POST['medicamento'];
            $cantidad = $_POST['cantidad'];
            $frecuencia = $_POST['frecuencia'];
            $periodo = $_POST['periodo'];

            $diagnostico = $_POST['diagnostico'];
            $indicaciones = $_POST['indic'];

            $app = new app();

            //INSERTANDO EXAMEN
            $exa_id = $app->insertarExamen($peso, $altura, $temperatura, $p_dia, $p_sis, $observaciones);
            if (!$exa_id) {
                echo 'Algo salió mal al insertar el examen';
                die();
            }

            //INSERTANDO RECETA
            $receta_id = $app->insertarReceta($diagnostico, $indicaciones);
            if (!$receta_id) {
                echo 'Algo salió mal al insertar la receta';
                die();
            }

            //INSERTANDO SINTOMAS
            $respuesta = $app->insertarSintomas($exa_id, $sintomas);
            if (!$respuesta) {
                echo 'Algo salió mal al insertar los síntomas';
                die();
            }

            //INSERTANDO MEDICAMENTOS
            $respuesta = $app->insertarMedicamentos($receta_id, $medicamentos, $via_admin, $cantidad, $frecuencia, $periodo);
            if (!$respuesta) {
                echo 'Algo salió mal al insertar los medicamentos';
                die();
            }

            //PREPARANDO VARIABLES QUE SE USARÁN AL IMPRIMIR EL PDF
            $paciente_id = $_SESSION['paciente']['usuario']['paciente_id'];
            $med_id = $_SESSION['user']['med_id'];
            $nombre_med = $_SESSION['user']['nombre'];
            $apellido_med = $_SESSION['user']['apellido'];
            $titulo = $_SESSION['user']['titulo'];
            $cedula_prof = $_SESSION['user']['cedula_prof'];
            $institucion = $_SESSION['user']['institucion'];

            $nombre_pac = $_SESSION['paciente']['usuario']['nombre'];
            $apellidos_pac = $_SESSION['paciente']['usuario']['apellidos'];
            $email = $_SESSION['paciente']['usuario']['email'];
            $nacimiento = $_SESSION['paciente']['usuario']['nacimiento'];
            $edad = $_SESSION['paciente']['usuario']['edad'];

            $nacimiento = strtotime($nacimiento);
            $nacimiento = date('d-m-Y', $nacimiento);

            // ADQUIRIENDO INFORMACIÓN DEL CONSULTORIO                        
            $nombre_consultorio = $_SESSION['consultorio']['nombre'];
            $calle_c = $_SESSION['consultorio']['calle'];
            $num_ext = $_SESSION['consultorio']['num_ext'];
            $num_int = $_SESSION['consultorio']['num_int'];
            $estado = $_SESSION['consultorio']['estado'];
            $municipio = $_SESSION['consultorio']['municipio'];
            $localidad = $_SESSION['consultorio']['localidad'];
            $colonia = $_SESSION['consultorio']['colonia'];
            $codigo_postal = $_SESSION['consultorio']['codigo_postal'];
            $telefono = $_SESSION['consultorio']['telefono'];
            $consultorio_id = $_SESSION['consultorio']['consultorio_id'];

            //CONSTRUYENDO DIRECCIÓN DEL CONSULTORIO
            $dir_c = "";
            if (!empty($num_int)) {
                $dir_c = "$calle_c, $num_ext, interior $num_int,<br>$colonia, $codigo_postal";
            } else {
                $dir_c = "$calle_c, $num_ext,<br>$colonia, $codigo_postal";
            }

            $ubicacion = "";
            if ($localidad != $municipio) {
                $ubicacion = "$localidad, $municipio, $estado";
            } else {
                $ubicacion = "$municipio, $estado";
            }


            //INSERTANDO CONSULTA
            $consulta_id = $app->insertarConsulta($receta_id, $exa_id, $paciente_id, $med_id, $consultorio_id);
            if (!$consulta_id) {
                echo 'Algo salió mal al insertar la consulta';
                die();
            }

            //INSERTANDO ALERTAS
            $app->insertarAlertas($consulta_id, $temperatura, $imc);


            require '../vendor/vendor/autoload.php';
            ob_start();
            require './views/app/templateReceta.php';
            $html = ob_get_clean();

            $pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'LETTER', 'es');
            $pdf->writeHTML($html);
            
            $car = trim('\ '); //CARACTER ESCAPABLE
            $ruta = '\assets\uploads\recetas'.$car;
            $rutaCarpeta = base_dir.$ruta.$paciente_id;

            if (!file_exists($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true);
            }           
            $nombre_pdf = $consulta_id;
            $pdf->output($rutaCarpeta.$car.$nombre_pdf.'.pdf', 'F');
            $comprobacion = true;
        }

        $exito = false;
        if (isset($comprobacion) and $comprobacion) {
            $exito = true;
        }



        require './views/app/exito.php';
    }

    // FUNCIONES QUE NO IMPLICAN WEB
    public function buscar_paciente() {
        $id = $_POST['user_id'] ? $_POST['user_id'] : false;
        $email = $_POST['user_email'] ? $_POST['user_email'] : false;
        $consulta = $_POST['consulta_id'] ? $_POST['consulta_id'] : false;
        $app = new app();
        $paciente = $app->search($id, $email, $consulta);

        if ($paciente) {
            $_SESSION['paciente']['usuario'] = $paciente;
            header('Location: ' . base_url . 'consultas/app/procesar');
        } else {
            $_SESSION['consulta'] = 'El paciente no ha sido encontrado. Llene al menos un dato correctamente.';
            require '../views/back.php';
        }
    }

    public function reg_user() {
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
        $app = new app();
        $resultado = $app->register($nombre, $apellidos, $nacimiento, $celular, $email, $alergias);


        if ($resultado) {
            $_SESSION['register']['alert'] = 'Registro exitoso, el id del paciente registrado es: ' . $resultado['paciente_id'];
        } else {
            $_SESSION['register']['alert'] = 'Algo ha fallado';
        }



        require '../views/back.php';
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

