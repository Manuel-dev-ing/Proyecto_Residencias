<?php
session_start();


require_once("../../config/conexion.php");
if (isset($_SESSION['usuario_id'])) {

?>
    <!DOCTYPE html>
    <html>
    <?php
    require_once("../MainHead/head.php");
    ?>
    <link rel="stylesheet" href="../../public/css/styleDashboard.css">
    <title>Soporte Tecnico</title>
    </head>

    <body class="with-side-menu">

        <?php
        require_once("../MainHeader/header.php");
        ?>

        <div class="mobile-menu-left-overlay"></div>
        <?php
        require_once("../MainNav/nav.php");
        ?>

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <article class="statistic-box green">
                                    <div>
                                        <div class="number" id="lbltotal"></div>
                                        <div class="caption">
                                            <div>Total de Incidencias</div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-sm-4">
                                <article class="statistic-box yellow">
                                    <div>
                                        <div class="number" id="lbltotalAbierto"></div>
                                        <div class="caption">
                                            <div>Total de Incidencias Abiertas</div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-sm-4">
                                <article class="statistic-box red">
                                    <div>
                                        <div class="number" id="lbltotalCerrado"></div>
                                        <div class="caption">
                                            <div>Total de Incidencias Cerradas</div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <hr class="mt-1 border border-5">
                    </div>


                </div>

                <div class="row" id="divGrafica">
                    <section class="card col-sm-12">
                        <header class="card-header">
                            Incidencias en Sucursales
                        </header>
                        <div class="card-block ">
                            <div id="bar-chart"></div>
                        </div>
                    </section>
                </div>


                <div class="row">
                    <div class="col-xl-12 dahsboard-column">
                        <section class="box-typical box-typical-dashboard panel panel-default scrollable">

                            <div class="box-typical-body panel-body ">
                                <br>
                                <div class="col-sm-9" style="margin-left: 100px;">
                                    <div class="form-group">
                                        <label class="form-label semibold text-center">¿Como podemos ayudarte?</label>
                                        <div class="form-control-wrapper form-control-icon-left">
                                            <input id="buscar" type="text" class="form-control rounded-3" placeholder="Busca por el nombre de la incidencia" />
                                            <i class="glyphicon glyphicon-search"></i>
                                        </div>
                                        <ul class="list-group rounded-3" id="incidencias">

                                        </ul>
                                    </div>
                                </div>
                            </div><!--.box-typical-body-->
                        </section>
                    </div>
                </div>
            </div><!--.container-fluid-->
        </div><!--.page-content-->

        <?php require_once("../MainJs/js.php"); ?>
        <script src="home.js"></script>

    </body>

    </html>
<?php
} else {
    header("Location:http://localhost/proyecto_residencias/index.php");
}

?>