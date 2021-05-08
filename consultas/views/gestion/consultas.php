<div class="">
    <br>
    <a href="#areaConsultasPas" data-toggle="collapse" class="btn btn-block btn-primary">INFORMACIÓN SOBRE CONSULTAS ANTERIORES</a> 
    <div class="w-100 collapse show carta-int" id="areaConsultasPas">

        <?php if ($consultas->field_count > 0 and $consultas->num_rows > 0): ?>                                   

            <?php
            $count = 0;
            $years = [];
            foreach ($consultas as $con) {
                $separador = explode('-', $con['fecha']);
                $years[] = $separador[0];
            }


            $minYear = min($years);
            ?>

            <?php for ($year = $minYear; $year <= date('Y'); $year++): ?>

                <a href="#y<?= $year ?>" data-toggle="collapse" class="noHover-icon icon-container list-group-item list-group-item-action bg-secondary" aria-expanded="false" class="dropdown-toggle">
                    <img src="<?= base_url ?>vendor/bootstrap/icons/inboxes.svg">
                    <h6><?= $year ?></h6>
                </a>

                <ul class="collapse list-unstyled" id="y<?= $year ?>">
                    
                    <?php $primera = true;  $contados = 0; ?>

                    <?php foreach ($consultas as $con): ?>

                        
                        <?php                       
                        $mesImpreso = false;
                        $sint = $sintomas[$count];
                        $med = $medicamentos[$count];
                        $alert = $alertas[$count];

                        $fecha = $con['nacimiento'];
                        $fecha = strtotime($fecha);
                        $fecha = date('d-m-Y', $fecha);

                        $meses = explode('-', $con['fecha']);
                        $mes = $meses[1];
                        $datos[$contados] = $mes;
                        
                        if($primera){
                            $primera = false;
                            
                        } else {
                            if ($datos[$contados] == $datos[$contados -1]){
                                $mesImpreso = true;                                
                            }                            
                        }                   
                        

                        
                        $mesArray = $mes - 1;
                        ?>



                        <?php for ($m = 0; $m < 12; $m++): ?>   

                <?php if ($m + 1 == $mes): ?>

                                <li>
                    <?php if ($mesImpreso == false): ?>
                                        <a href="#m<?= $year . $mes ?>" data-toggle="collapse" class="noHover-icon list-group-item list-group-item-action bg-primary sub-list icon-container" aria-expanded="false" class="dropdown-toggle">
                                            <img src="<?= base_url ?>vendor/bootstrap/icons/three-dots.svg">
                                            <h6><?= meses[$m] ?></h6>
                                        </a>

                                        <?php $mesImpreso = true; ?>

                    <?php endif; ?>

                                    <div class="collapse row" id="m<?= $year . $mes ?>">
                                        <a href="#consulta<?= $count ?>" data-toggle="collapse" class="btn btn-block btn-secondary"> <?= $con['nombre'] ?> <?= $con['apellidos'] ?> Fecha de la consulta: <?= $con['fecha'] ?></a>
                                        <div class="collapse row" id="consulta<?= $count ?>">

                                            <!-- INFORMACIÓN DE LA CONSULTA -->
                                            <div class="col-md-4">

                                                <div class="row">

                                                    <div class="titulo">
                                                        <h4>Paciente</h4>
                                                        <div class="alert alert-info" role="alert">
                    <?= $con['nombre'] ?> <?= $con['apellidos'] ?>
                                                        </div>
                                                    </div>

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

                                                <div class="titulo">
                                                    <h4>Oprima el botón de abajo para ver el archivo pdf de la consulta</h4>
                                                    <a class="btn btn-block btn-danger"  target="_blank" href="<?= base_url ?>assets/uploads/recetas/<?= $con['paciente_id'] ?>/<?= $con['consulta_id'] ?>.pdf">
                                                        Link del archivo generado
                                                    </a>    



                                                </div>

                                            </div>



                                        </div>
                                    </div>





                <?php endif; ?>

                            </li>

                        <?php endfor; ?>

                        <?php $count++; ?>

                        <?php $contados++; ?>
                <?php endforeach; ?>
                </ul>  
            <?php endfor; ?>

<?php else: ?>

            <h2 class="text-center">USTED NO TIENE CONSULTAS EN SU HISTORIAL</h2>

<?php endif; ?>
    </div>



</div>
