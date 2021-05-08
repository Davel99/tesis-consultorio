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
                margin-right: 20px;
        }

        .examen td{
                border: 1px solid black;
                width: 100%;
                padding: 5px;
        }

        .tab_receta{
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
                                <img src="<?= base_url ?>assets/images/icono_consultorio.jpg" width="150px">
                        </td>
                        <td style="width:70%">

                                <table>
                                        <tr>
                                                <td style="padding: 20px">
                                                        <h1>CONSULTORIO</h1>
                                                </td>
                                                <td>
                                                        <table>
                                                                <tr>
                                                                        <td class="label">FECHA: </td>
                                                                        <td class="content"> 25/05/2020</td>
                                                                </tr>
                                                                <tr >
                                                                        <td class="hr"></td>
                                                                        <td class="hr"></td>

                                                                </tr>
                                                                <tr>
                                                                        <td class="label">ID del paciente: </td>
                                                                        <td class="content"> </td>
                                                                </tr>
                                                                <tr>
                                                                        <td class="hr"></td>
                                                                        <td class="hr"></td>

                                                                </tr>

                                                                <tr>
                                                                        <td class="label">ID de la consulta:</td>
                                                                        <td class="content"></td>
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
                                                <td class="content"></td>
                                        </tr>
                                        <tr >
                                                <td class="hr"></td>
                                                <td class="hr"></td>

                                        </tr>

                                        <tr>
                                                <td class="label">Paciente:</td>
                                                <td class="content"><?= $nombre ?></td>
                                        </tr>
                                        <tr >
                                                <td class="hr"></td>
                                                <td class="hr"></td>

                                        </tr>

                                        <tr>
                                                <td class="label">Email del paciente:</td>
                                                <td class="content"></td>
                                        </tr>
                                        <tr >
                                                <td class="hr"></td>
                                                <td class="hr"></td>

                                        </tr>

                                        <tr>
                                                <td class="label">Edad del paciente:</td>
                                                <td class="content"></td>
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
                                                <td>60kg</td>
                                        </tr>
                                        <tr>
                                                <td>Altura</td>
                                                <td></td>
                                        </tr>
                                        <tr>
                                                <td>Temperatura</td>
                                                <td></td>
                                        </tr>
                                        <tr>
                                                <td>Presión sistólica</td>
                                                <td></td>
                                        </tr>
                                        <tr>
                                                <td>Presión diastólica</td>
                                                <td></td>
                                        </tr>
                                </table>

                        </td>

                        <td style="border: 1px solid black; width: 100%; padding: 20px;">
                                <div class="tab_receta">
                                        <h5>Medicamentos recetados</h5>
                                        <hr>

                                        <table style="width: 100%">
                                                <tr>
                                                        <td  style="width:50%">Nombre del medicamento</td>
                                                        <td  style="width:25%">Cantidad a tomar</td>
                                                        <td  style="width:25%">Periodo</td>
                                                </tr>
                                                <tr>
                                                </tr>

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
                                        <h5>Indicaciones del médico</h5>
                                        <hr>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                                laboris nisi ut aliquip ex ea commodo consequat.
                                        </span>

                                </div>


                        </td>

                        <td style="width: 30%">

                                <div style="margin-top: 35px; margin-right: 50px; text-align: center;">
                                        <hr>
                                        <h5>FIRMA DEL MÉDICO</h5>
                                </div>




                        </td>




                </tr>



        </table>

</div>