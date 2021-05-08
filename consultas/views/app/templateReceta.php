<style type="text/css">

    *{
        box-sizing: border-box;
        margin: 0px;
        padding: 0px;
        font-family: Arial;
    }

    .header, .footer, .main{
        width: 100%; 
    }

    .main, .footer{
        margin-top: 20px;
    }

    .label{
        width: 30%;
        font-weight: bold;
    } 
    .content{
        width: 70%;
        text-align: center;
        font-family: Courier, monospace
    }

    .hr{
        width: 100%;
        border-top: 1px solid black;
    }

    .examen{
        width: 100px;
        padding: 20px;
    }

    .examen td{
        border: 1px solid black;
        width: 100%;
        padding: 5px;
    }

    .tab_receta{
        width: 525px;
    }

    .tab_receta td{
        border: 1px solid black;  
        padding: 5px;
    }



</style>


<div class="header">

    <table style="width:100%; border: 1px solid black; padding: 20px">
        <tr>
            <td style="width:30%; max-width:20%">
                <img src="<?= base_url ?>assets/images/icono_consultorio.jpg" width="125px">
            </td>
            <td style="width:70%">

                <table>
                    <tr>
                        <td style="padding: 10px">
                            <h1><?= $nombre_consultorio ?></h1>
                            <br>
                            <?= $dir_c ?>
                            <hr>
                            <?= $ubicacion ?>
                            <hr> 
                            Teléfono: <?= $telefono ?>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Fecha: </td>
                                    <td class="content"><?= date('d/m/Y') ?></td>
                                </tr>
                                <tr>
                                    <td class="hr"></td>
                                    <td class="hr"></td>

                                </tr>

                                <tr>
                                    <td class="label">Hora: </td>
                                    <td class="content"><?= date('H:i') ?></td>
                                </tr>
                                <tr>
                                    <td class="hr"></td>
                                    <td class="hr"></td>

                                </tr>

                                <tr>
                                    <td class="label">ID del paciente: </td>
                                    <td class="content"> <?= $paciente_id ?> </td>
                                </tr>
                                <tr>
                                    <td class="hr"></td>
                                    <td class="hr"></td>

                                </tr>

                                <tr>
                                    <td class="label">ID de la consulta:</td>
                                    <td class="content"><?= $consulta_id ?></td>
                                </tr>
                                <tr>
                                    <td class="hr"></td>
                                    <td class="hr"></td>
                                </tr>
                            </table>
                        </td>

                    </tr>

                    <tr>
                        <td class="label">Médico:</td>
                        <td class="content"><?= $nombre_med ?> <?= $apellido_med ?></td>
                    </tr>
                    <tr >
                        <td class="hr"></td>
                        <td class="hr"></td>

                    </tr>

                    <tr>
                        <td class="label">Título:</td>
                        <td class="content"><?= $titulo ?></td>
                    </tr>
                    <tr >
                        <td class="hr"></td>
                        <td class="hr"></td>

                    </tr>

                    <tr>
                        <td class="label">Cédula profesional:</td>
                        <td class="content"><?= $cedula_prof ?></td>
                    </tr>



                    <tr>
                        <td class="hr"></td>
                        <td class="hr"></td>

                    </tr>

                    <tr>
                        <td class="label">Institución:</td>
                        <td class="content"><?= $institucion ?></td>
                    </tr>
                    <tr >
                        <td class="hr"></td>
                        <td class="hr"></td>

                    </tr>


                    <tr>
                        <td class="label">Paciente:</td>
                        <td class="content"><?= $nombre_pac ?> <?= $apellidos_pac ?></td>
                    </tr>
                    <tr >
                        <td class="hr"></td>
                        <td class="hr"></td>

                    </tr>


                    <tr>
                        <td class="label">Email del paciente:</td>
                        <td class="content"><?= $email ?></td>
                    </tr>
                    <tr >
                        <td class="hr"></td>
                        <td class="hr"></td>

                    </tr>

                    <tr>
                        <td class="label">Edad del paciente:</td>
                        <td class="content"><?= $edad ?></td>
                    </tr>
                    <tr>
                        <td class="hr"></td>
                        <td class="hr"></td>

                    </tr>

                </table>



            </td>
        </tr>
    </table>

</div>

<div class="main">

    <table>
        <tr  style="width:100%">
            <td style="border: 1px solid black; width: 30%" class="examen">

                <h5>Examen realizado</h5>
                <hr>

                <table>
                    <tr>
                        <td>Peso</td>
                        <td><?= $peso ?> kg</td>
                    </tr>
                    <tr>
                        <td>Altura</td>
                        <td><?= $altura ?> cm </td>
                    </tr>
                    <tr>
                        <td>Temperatura</td>
                        <td><?= $temperatura ?> °C</td>
                    </tr>
                    <tr>
                        <td>Presión sistólica</td>
                        <td><?= $p_sis ?> mmHg </td>
                    </tr>
                    <tr>
                        <td>Presión diastólica</td>
                        <td><?= $p_dia ?> mmHg</td>
                    </tr>
                </table>

            </td>

            <td style="width: 100%; padding: 20px;">
                <div class="tab_receta">
                    <h5>Medicamentos recetados</h5>
                    <hr>

                    <table style="width: 100%">
                        <tr>
                            <td  style="width:20%">Nombre del medicamento</td>
                            <td  style="width:20%">Vía admin</td>
                            <td  style="width:20%">Cantidad a tomar</td>
                            <td  style="width:20%">Frecuencia</td>
                            <td  style="width:20%">Periodo</td>
                        </tr>

                        <?php for ($i = 0; $i < count($medicamentos); $i++): ?>
                            <tr>
                                <td><?= $medicamentos[$i] ?></td>
                                <td><?= $via_admin[$i] ?></td>
                                <td><?= $cantidad[$i] ?></td>
                                <td><?= $frecuencia[$i] ?></td>
                                <td><?= $periodo[$i] ?></td>

                            </tr>

                        <?php endfor; ?>

                    </table>
                </div>

            </td>

        </tr>

    </table>

</div>

<div class="footer">

    <table style="width:100%; border: 1px solid black; padding: 20px">
        <tr>
            <td style="width:70%">
                <div style="width:70%">
                    <h5>    Diagnóstico: </h5> <?= $diagnostico ?>
                    <hr>

                    <h5>    Indicaciones del médico: </h5>
                    <span>
                        <?= $indicaciones ?>
                    </span>

                </div>


            </td>

            <td style="width: 30%">

                <div style="margin-top: 35px; margin-right: 50px; text-align: center;">
                    <hr>
                    <h5>FIRMA DEL MÉDICO</h5>
                    <h5><?= $nombre_med ?> <?= $apellido_med ?></h5>
                </div>




            </td>




        </tr>



    </table>

</div>