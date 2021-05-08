

<div class="row col-md-12 col-int divOf2">

        <div class="col-md-6 col-int first-div image-bg">


                <div class="form-min">

                        <div class="form form-min-in bg-light">

                                <form action="<?= base_url ?>consultas/app/reg_user" method="post">

                                        <div class="info">
                                                <h5>REGISTRAR A UN PACIENTE</h5>
                                                <hr>
                                                <p>
                                                        Para comenzar una consulta primero debe registrar
                                                        a su paciente. Por favor, relleno los dato que se le piden.

                                                </p>
                                        </div>


                                        <?php if (isset($_SESSION['register'])): ?>

                                                <?php foreach ($_SESSION['register'] as $key => $value): ?>

                                                        <div class="alert alert-warning" role="alert">
                                                                <?= $value ?>
                                                        </div>

                                                <?php endforeach; ?>

                                        <?php endif; ?>

                                        <div class="inputs">

                                                <input type="text" name="nombre" class="form-control" placeholder="NOMBRE">
                                                <input type="text" name="apellidos" class="form-control" placeholder="APELLIDOS">

                                                <label>Fecha de nacimiento:</label>
                                                <div class="d-flex">
                                                        <select name="dia" class="form-control" style="width:20%">
                                                                <?php for ($i = 1; $i <= 31; $i++): ?>

                                                                        <option value="<?= $i ?>"><?= $i ?></option>

                                                                <?php endfor; ?>
                                                        </select>
                                                        <select name="mes" class="form-control" style="width:40%">
                                                                <?php for ($i = 0; $i < 12; $i++): ?>

                                                                        <option value="<?= $i + 1 ?>"><?= meses[$i] ?></option>

                                                                <?php endfor; ?>                                                                

                                                        </select>     
                                                        <select name="year" class="form-control" style="width:40%">
                                                                <?php for ($i = 1950; $i <= date('Y'); $i++): ?>

                                                                        <option value="<?= $i ?>"><?= $i ?></option>

                                                                <?php endfor; ?>
                                                        </select>  
                                                </div>
                                                <input type="number" name="celular" class="form-control" placeholder="CELULAR">
                                                <input type="email" name="email" class="form-control" placeholder="EMAIL">
                                                <label>Enliste alergias (separadas por comas): </label>
                                                <input type="text" name="alergias" class="form-control" placeholder="ALERGIAS">


                                        </div>

                                        <div class="form-button">
                                                <input type="submit" class="btn btn-warning btn-block" value="REGISTRAR PACIENTE">                                                                
                                        </div>


                                </form>


                        </div>



                </div>

        </div>

        <div class="col-md-6 col-int second-div image-bg">


                <div class="form-min">

                        <div class="form form-min-in bg-light">

                                <form action="<?= base_url ?>consultas/app/buscar_paciente" method="post">

                                        <div class="info">
                                                <h5>INICIAR CONSULTA CON PACIENTE REGISTRADO</h5>
                                                <hr>
                                                <p>
                                                        Para poder encontrar el historial del paciente
                                                        debe introducir UNO de los siguientes datos.
                                                </p>
                                        </div>


                                        <?php if (isset($_SESSION['consulta'])): ?>


                                                <div class="alert alert-danger" role="alert">
                                                        <?= $_SESSION['consulta'] ?>
                                                </div>


                                        <?php endif; ?>

                                        <div class="inputs">

                                                <input type="text" name="user_id" class="form-control" placeholder="ID del usuario">
                                                <input type="text" name="consulta_id" class="form-control" placeholder="ID de la consulta">
                                                <input type="text" name="user_email" class="form-control" placeholder="EMAIL del usuario">
                                        </div>

                                        <div class="form-button">
                                                <input type="submit" class="btn btn-warning btn-block" value="INICIAR CONSULTA">                                                                
                                        </div>


                                </form>


                        </div>



                </div>

        </div>



</div>

<script type="text/javascript">

        window.onload = function () {
                cargarImagen('first-div', 'bg-register.jpg');
                console.log('Imagen cargada');
                cargarImagen('second-div', 'bg-consulta.jpg');
                console.log('Imagen cargada');
        }

</script>



<?php
unset($_SESSION['register']);
unset($_SESSION['consulta']);
?>