<?php if (isset($_SESSION['register']['alert'])): ?>

    <div class="alert alert-warning" role="alert">
        <?= $_SESSION['register']['alert'] ?>
    </div>

<?php endif; ?>


<div class="pasado">
    <a href="#areaConsultasPas" data-toggle="collapse" class="btn btn-block btn-primary">INFORMACIÓN SOBRE LOS PACIENTES</a> 
    <div class="w-100 collapse show carta-int" id="areaConsultasPas">

        <?php if ($pacientes->field_count > 0 and $pacientes->num_rows > 0): ?>                                   

            <?php foreach ($pacientes as $pac): ?>

                <?php
                $formateo = explode('-', $pac['nacimiento']);
                $year = $formateo[0];
                $mes = $formateo[1] - 1;
                $dia = $formateo[2];
                ?>

                <div class="w-100 bg-light">

                    <form action="<?= base_url ?>consultas/gestion/act_paciente" method="POST">


                        <a href="#pac<?= $pac['paciente_id'] ?>" data-toggle="collapse" class="btn btn-block btn-secondary"><?= $pac['nombre'] ?> <?= $pac['apellidos'] ?> </a>
                        <div class="collapse row" id="pac<?= $pac['paciente_id'] ?>">

                            <!-- INFORMACIÓN DE LA CONSULTA -->
                            <div class="col-md-4">

                                <div class="titulo">
                                    <h4>Nombre del paciente</h4>
                                    <input required type="text" name="nombre" id="nombre" class="form-control" value="<?= $pac['nombre'] ?>">

                                </div>

                                <div class="titulo">
                                    <h4>Apellidos del paciente</h4>
                                    <input required type="text" name="apellidos" id="apellidos" class="form-control" value="<?= $pac['apellidos'] ?>">
                                </div>


                            </div>


                            <div class="col-md-4">

                                <div class="titulo">

                                    <label>Fecha de nacimiento:</label>
                                    <div class="d-flex">
                                        <select name="dia" class="form-control" style="width:20%">
                                            <?php for ($i = 1; $i <= 31; $i++): ?>

                                                <?php if ($i == $dia): ?>
                                                    <option selected value="<?= $i ?>"><?= $i ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endif; ?>

                                            <?php endfor; ?>
                                        </select>
                                        <select name="mes" class="form-control" style="width:40%">
                                            <?php for ($i = 0; $i < 12; $i++): ?>

                                                <?php if ($i == $mes): ?>
                                                    <option selected value="<?= $i+1 ?>"> <?= meses[$i] ?></option>
                                                <?php else: ?>
                                                    
                                                    <option value="<?= $i+1 ?>"> <?= meses[$i] ?></option>
                                                <?php endif; ?>
                                                

                                            <?php endfor; ?>                                                              

                                        </select>     
                                        <select name="year" class="form-control" style="width:40%">
                                            <?php for ($i = 1950; $i <= date('Y'); $i++): ?>

                                                <?php if ($i == $year): ?>
                                                    <option selected value="<?= $i ?>"><?= $i ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endif; ?>

                                            <?php endfor; ?>
                                        </select>  
                                    </div>

                                </div>

                                <div class="titulo">
                                    <h4>Email</h4>
                                    <input required type="text" name="email" id="nombre" class="form-control" value="<?= $pac['email'] ?>">
                                </div>

                                <div class="titulo">
                                    <h4>ID del paciente
                                        <div class="alert alert-info" role="alert">
                                            <?= $pac['paciente_id'] ?>
                                        </div>
                                </div>


                            </div>

                            <div class="col-md-4">

                                <div class="titulo">
                                    <h4>Número de celular</h4>
                                    <input required type="text" name="celular" id="celular" class="form-control" value="<?= $pac['celular'] ?>">

                                </div>

                                <div class="titulo">
                                    <h4>Alergias</h4>(separadas por coma)
                                    <input type="text" name="alergias" id="alergias" class="form-control" value="<?= $pac['alergias'] ?>">

                                </div>


                            </div>

                            <div class="col-md-12">
                                <hr>

                                <input type="hidden" name="id" id="id" value="<?= $pac['paciente_id'] ?>">
                                <div class="titulo">
                                    <h4>Oprima el botón de abajo para actualizar los datos del paciente</h4>
                                    <button type="submit" class="form-control btn btn-block btn-danger">
                                        Actualizar datos
                                    </button>      
                                </div>

                            </div>



                        </div>

                    </form>
                </div>
        <hr>
            <?php endforeach; ?>

        <?php else: ?>

            <h2 class="text-center">No existen pacientes registrados</h2>

        <?php endif; ?>
    </div>



</div>


<?php
unset($_SESSION['register']);
?>

