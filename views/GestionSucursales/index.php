<?php 
session_start();
require_once("../../config/conexion.php");
if (isset($_SESSION['usuario_id'])) {
  
?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <?php 
                require_once("../MainHead/head.php"); 
            ?>
            <title>Soporte Tecnico::Gestion Sucursales</title>
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
                    <header class="section-header">
                        <div class="tbl">
                            <div class="tbl-row">
                                <div class="tbl-cell">
                                    <h3>Gestion de Sucursales</h3>
                                    <ol class="breadcrumb breadcrumb-simple">
                                        <li><a href="#">Home</a></li>
                                        <li class="active">Gestion Sucursales</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="box-typical box-typical-padding">
                        <div type="button" id="btnNuevaSucursal" class="btn btn-inline btn-primary">Nueva Sucursal</div>
                            <table id="Sucursal_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>

                                        <th class="d-none d-sm-table-cell" style="width: 5%;">Nombre</th>
                                        <th class="d-none d-sm-table-cell" style="width: 5%;">Domicilio</th>
                                        <th class="d-none d-sm-table-cell" style="width: 5%;">Ciudad</th>
                                        <th class="d-none d-sm-table-cell" style="width: 5%;">Telefono</th>
                                        <th class="d-none d-sm-table-cell" style="width: 5%;">Fecha Creacion</th>
                                        <th class="text-center" style="width: 1%;"></th>
                                        <th class="text-center" style="width: 1%;"></th>
                                    
                                    </tr>
                                </thead>
                            </table>
                        </div>
                </div>
            </div>     
            <!-- Modal -->
            <div id="ModalbtnNuevaSucursal" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                <i class="font-icon-close-2"></i>
                            </button>
                            <h4 class="modal-title" id="labelTitulo"></h4>
                        </div>
                        <form action="post" id="sucursal-form">
                            <div class="modal-body">
                                
                                <input type="hidden" id="id">

                                <div class="form-group">
                                    <label class="form-label" for="sucursal_nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre" maxlength="50" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="direccion">Direccion</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese la Direccion" maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="ciudad">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ingrese la Ciudad" maxlength="50" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el Telefono" maxlength="13" required>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" name="action" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>



            <?php  require_once("../MainJs/js.php"); ?>
            <script src="index.js"></script>

        </body>
    </html>


<?php 
    }else{
        header("Location:http://localhost/proyecto_residencias/index.php");

    }
?>
