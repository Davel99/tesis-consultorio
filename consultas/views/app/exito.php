
<?php if ($exito): ?>

        <div class="titulo separador">

                <h1 class="text-center">La consulta del paciente <b><?= $nombre_pac ?> <?= $apellidos_pac?> </b> ha resultado exitosa</h1>
                <span>
                        Abajo puede ver el archivo pdf resultante. Las opciones 
                        de imprimir y descargar se encuentran en la barra de 
                        herramientas del visor de archivos.
                </span>

        </div>

        <div class="separador">
                <a class="btn btn-block btn-success" href="<?= base_url ?>consultas/">
                        Regresar a página principal de la aplicación
                </a>
        </div>

        <div class="viewer">]


                <object class="pdf-view" type="application/pdf" data="<?= base_url ?>assets/uploads/recetas/<?= $paciente_id ?>/<?= $nombre_pdf ?>.pdf?#zoom=auto">


                        <a class="btn btn-block btn-warning" href="<?= base_url ?>assets/uploads/recetas/<?= $paciente_id ?>/<?= $nombre_pdf ?>.pdf">
                                Oprima aquí si no puede ver el archivo
                        </a>
                </object>


        </div>

<?php else: ?>
        <div class="titulo">
                <h4 class="text-center">Usted ha accedido a una página incorrecta</h4>
        </div>

        <div class="separador">
                <a class="btn btn-block btn-success" href="<?= base_url ?>consultas/">
                        Regresar a página principal de la aplicación
                </a>
        </div>


<?php endif; ?>


