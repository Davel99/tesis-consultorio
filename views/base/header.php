
<html>
    <head>
        <title>App consultorio</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, use-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="<?= base_url ?>vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url ?>assets/css/constants.css">
        <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">
    </head>
    <body>

        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">Mi Consultorio</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php if ($cont == '') echo 'active'; ?>">
                            <a class="nav-link" href="<?= base_url ?>home/">Inicio</a>
                        </li>
                        <li class="nav-item <?php if ($cont == 'nosotros') echo 'active'; ?>">
                            <a class="nav-link" href="<?= base_url ?>home/nosotros/">Nosotros</a>
                        </li>
                        <li class="nav-item <?php if ($cont == 'servicios') echo 'active'; ?>">
                            <a class="nav-link" href="<?= base_url ?>home/servicios/">Servicios</a>
                        </li>

                        <?php if (isset($_SESSION['user'])): ?>

                            <li class="nav-item  <?php if ($cont == 'app') echo 'active'; ?>">
                                <a class="nav-link" href="<?= base_url ?>consultas/">Consultas</a>
                            </li>
                            
                            <li class="nav-item  <?php if ($cont == 'gestion') echo 'active'; ?>">
                                <a class="nav-link" href="#gestion" data-toggle="collapse">Gestionar datos</a>
                                <div class="collapse row bg-secondary encima w-100" id="gestion"> 
                                    <a class="nav-link sub-menu" style="width:100%" href="<?= base_url ?>consultas/gestion/pacientes" style="color:white; text-decoration:none">Pacientes</a>
                                    <a class="nav-link sub-menu" style="width:100%" href="<?= base_url ?>consultas/gestion/consultas" style="color:white; text-decoration:none">Consultas</a>                                                                                                                                        

                                </div>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url ?>home/login/unset_session"">Cerrar sesión</a>
                            </li>  

                        <?php else: ?>

                            <li class="nav-item <?php if ($cont == 'login') echo 'active'; ?>">
                                <a class="nav-link" href="<?= base_url ?>home/login/"">Consultas</a>
                            </li>                        

                        <?php endif; ?>


                    </ul>
                </div>
            </nav>


        </header>

        <!-- ============================= END OF THE HEADER ============================== -->
        <main>
