
<div class="jumbotron text-center col-md-12">
    <h3 >LA CONSULTA HA COMENZADO</h3>
    <p>Usted está atendiendo al paciente <b><?= $paciente['nombre'] ?> <?= $paciente['apellidos'] ?> </b>. ¡Sea amable! </p>
    <div id="reloj">
        <div id="h">0</div>:
        <div id="m">00</div>:
        <div id="s">00</div>
    </div>
</div>

<div class="flexer bg-dark">
    <div class="principal bg-light">
        <form id="consulta" action="<?= base_url ?>consultas/app/exito" method="POST">
            <div class="paciente col-md-12">
                <a href="#areaPaciente" data-toggle="collapse" class="btn btn-block btn-primary">INFORMACIÓN SOBRE EL PACIENTE</a>                        
                <div class="w-100 collapse show carta-int" id="areaPaciente">
                    <div class="row">                                                
                        <div class="col-md-4">
                            <div class="nombre">
                                <div class="titulo">
                                    <h4>Nombre del paciente: </h4>

                                    <div class="alert alert-info" role="alert">
                                        <?= $paciente['nombre'] ?> <?= $paciente['apellidos'] ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-8">
                            <div class="row alergias">
                                <div class="titulo">
                                    <h4>ALERGIAS</h4>
                                </div>

                                <div class="listaAlergias w-100">

                                    <?php if (!empty($hist['alergias'])): ?>

                                        <?php $todasAlergias = explode(",", $hist['alergias']); ?>
                                        <?php foreach ($todasAlergias as $alergia): ?>

                                            <div class="alert alert-danger text-center" role="alert">
                                                <?= $alergia ?>
                                            </div>

                                        <?php endforeach; ?>

                                    <?php else: ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            Las alergias no fueron especificadas en este paciente
                                        </div>


                                    <?php endif; ?> 

                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </div>

            <div class="pasado">
                <a href="#areaConsultasPas" data-toggle="collapse" class="btn btn-block btn-primary">INFORMACIÓN SOBRE CONSULTAS ANTERIORES</a> 
                <div class="w-100 collapse show carta-int" id="areaConsultasPas">

                    <?php if ($consultas->num_rows > 0): ?>                                   

                        <?php
                        $count = 0;
                        foreach ($consultas as $con):
                            ?>
                            <?php
                            $sint = $sintomas[$count];
                            $med = $medicamentos[$count];
                            $alert = $alertas[$count];
                            ?>

                            <div class="w-100">
                                <a href="#consulta<?= $count ?>" data-toggle="collapse" class="btn btn-block btn-secondary">Consulta #<?= $count + 1 ?></a>
                                <div class="collapse row" id="consulta<?= $count ?>">

                                    <!-- INFORMACIÓN DE LA CONSULTA -->
                                    <div class="col-md-4">

                                        <div class="row">

                                            <div class="titulo">
                                                <h4>Fecha de la consulta</h4>
                                                <div class="alert alert-info" role="alert">
                                                    <?= $con['fecha'] ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Aquí puede ir el nombre del médico, si fuera necesario-->

                                        <div class="row">

                                            <div class="titulo">
                                                <h4>Datos recopilados: </h4>
                                                <table class="table table-bordered table-hover table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Atributo</th>
                                                            <th scope="col">Unidad</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <tr>
                                                            <th scope="row">PESO</th>
                                                            <td><?= $con['peso'] ?> kg</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">TEMPERATURA</th>
                                                            <td><?= $con['temperatura'] ?>°C</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">ALTURA</th>
                                                            <td><?= $con['altura'] ?> cm</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">P. SISTÓLICA</th>
                                                            <td><?= $con['p_dia'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">P. DIASTÓLICA</th>
                                                            <td><?= $con['p_sis'] ?></td>
                                                        </tr>


                                                    </tbody>



                                                </table>

                                            </div>


                                        </div>

                                    </div>

                                    <!-- SÍNTOMAS REGISTRADOS -->
                                    <div class="col-md-4">

                                        <div class="titulo">
                                            <h4>Lista de síntomas:</h4>
                                            <?php while ($row = $sint->fetch_assoc()): ?>
                                                <div class="alert alert-warning" role="alert">
                                                    <?= $row['descripcion'] ?>
                                                </div>
                                            <?php endwhile; ?>

                                        </div>


                                        <div class="titulo">
                                            <h4>Alertas generadas:</h4>
                                            <?php while ($row = $alert->fetch_assoc()): ?>
                                                <div class="alert alert-danger" role="alert">
                                                    El paciente presentó: <b><?= $row['tipo'] ?></b> <?= $row['descripcion'] ?>
                                                </div>
                                            <?php endwhile; ?>

                                        </div>

                                        <div class="titulo">
                                            <h4>Observaciones hechas</h4>
                                            <span><?= $con['observaciones'] ?></span>

                                        </div>


                                    </div>

                                    <div class="col-md-4">
                                        <div class="titulo">
                                            <h4>Diagnóstico</h4>
                                            <span><?= $con['diagnostico'] ?></span>
                                        </div>

                                        <div class="titulo">
                                            <h4>Indicaciones del médico: </h4>
                                            <span><?= $con['indicaciones'] ?></span>

                                        </div>

                                        <div class="titulo">
                                            <h4>Receta:</h4>
                                            <?php while ($row = $med->fetch_assoc()): ?>
                                                <div class="alert alert-success" role="alert">
                                                    <?= $row['medicamento'] ?>
                                                </div>
                                            <?php endwhile; ?>

                                        </div>

                                    </div>



                                </div>
                            </div>
                            <?php $count++; ?>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="alert alert-danger text-center" role="alert">
                            EL PACIENTE NO TIENE CONSULTAS EN SU HISTORIAL
                        </div>

                    <?php endif; ?>
                </div>



            </div>

            <div class="examen">

                <div class="w-100">
                    <a href="#areaExamen" data-toggle="collapse" class="btn btn-block btn-primary">INFORMACIÓN SOBRE EL PACIENTE</a>                        
                    <div class="w-100 collapse show carta-int" id="areaExamen">
                        <div class="row">     

                            <div class="col-md-6">

                                <div class="titulo">
                                    <h4>EXAMEN MÉDICO</h4>
                                    <span>Proceda a hacer el examen médico correspondiente
                                        y rellene los datos que se le piden.</span>
                                </div>

                                <div class="w-100 bg-light">

                                    <div class="input">
                                        <label for="peso">Peso</label>
                                        <input required type="number" name="peso" id="peso" class="form-control" placeholder="KG">
                                    </div>

                                    <div class="input">
                                        <label for="temp">Temperatura</label>
                                        <input required type="number" name="temperatura" id="temperatura" class="form-control" placeholder="°C">
                                    </div>

                                    <div class="input">
                                        <label for="alt">Altura</label>
                                        <input required type="number" name="altura" id="altura" class="form-control" placeholder="CM">
                                    </div>

                                    <div class="input">
                                        <label for="p_sis">Presión sistólica</label>
                                        <input required type="number" name="p_sis" id="p_sis" class="form-control" placeholder="mmHg">
                                    </div>

                                    <div class="input">
                                        <label for="p_dia">Presión diastólica</label>
                                        <input required type="number" name="p_dia" id="p_dia" class="form-control" placeholder="mmHg">
                                    </div>

                                </div>

                            </div>


                            <div class="col-md-6">
                                <div class="alerta">
                                    <div class="titulo">
                                        <h4>ALERTAS</h4>
                                        <span>En ésta área le avisaremos si detectamos algún riesgo en el paciente</span>
                                    </div>

                                    <div class="alertas" id="alertas">

                                    </div>

                                </div>

                                <div class="obs">   
                                    <div class="titulo">
                                        <h4>OBSERVACIONES</h4>
                                        <span>¿Hay algo que a usted le parezca extraño sobre el paciente? Puede anotarlo aquí. Otros médicos
                                            podrán verlo y tenerlo en cuenta en futuras consultas.</span>
                                    </div>

                                    <div class="observaciones">
                                        <textarea name="observacion" id="observacion" class="textarea" value="[Campo opcional]" rows="auto" cols="auto"></textarea>
                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
                </div>


            </div>

            <div class="diagnóstico row ">
                <a href="#areaDiagnos" data-toggle="collapse" class="btn btn-block btn-primary">INFORMACIÓN SOBRE EL PACIENTE</a>                        
                <div class="w-100 collapse show carta-int row" id="areaDiagnos">


                    <div class="col-md-6">

                        <div class="row registroSíntomas">

                            <div class="titulo">
                                <h4>Síntomas</h4>
                                <span>Enliste aquí los síntomas del paciente</span>
                            </div>

                            <button type="button" class="btn btn-block btn-outline-info" id="addSintoma">AGREGAR SÍNTOMA</button>

                            <div id="sintomas" class="bg-ligth">
                                <input required type="text" name="sintoma[]" id="primerSintoma" class="form-control" placeholder="Sintoma #1">

                            </div>


                        </div>

                        <div class="row receta">

                            <div class="titulo">
                                <h4>Receta</h4>
                                <span>Escriba aquí la lista de medicamentos que usted recetará</span>
                            </div>

                            <button type="button" class="btn btn-block btn-outline-info" id="addMed">AGREGAR MEDICAMENTO</button>

                            <div id="medicamentos" class="bg-light">
                                <input required type="text" name="medicamento[]" id="primerMedicamento" class="form-control" placeholder="Nombre del medicamento #1">
                                <input required type="text" name="via[]" id="primerFrec" class="form-control" placeholder="Vía de administración | Ej. 'Oral'">
                                <input required type="text" name="cantidad[]" id="primerCantidad" class="form-control" placeholder="Cantidad | Ej. '1 tableta de 50gr'">
                                <input required type="text" name="frecuencia[]" id="primerFrec" class="form-control" placeholder="Frecuencia | Ej. 'c/8 horas'">
                                <input required type="text" name="periodo[]" id="primerFrec" class="form-control" placeholder="Duración | Ej. '5 DÍAS'">

                            </div>

                        </div>



                    </div>


                    <div class="col-md-6">

                        <div class="diagnos col-md-12">

                            <div class="titulo">
                                <h4>Diagnóstico</h4>
                                <span>Escriba aquí su diagnóstico</span>
                            </div>

                            <div class="diagnosticoMed">
                                <input required type="text" name="diagnostico" id="diagnostico" class="form-control síntoma" placeholder="Nombre de la enfermedad">


                                <textarea name="indic" id="indic" class="textarea" placeholder="Escriba las indicaciones para el paciente" rows="auto" cols="auto"></textarea>



                            </div>

                        </div>


                    </div>


                </div>



            </div>

            <button type="input" class="btn btn-block btn-danger"> ENVIAR CONSULTA </button>
        </form>

    </div>

</div>




