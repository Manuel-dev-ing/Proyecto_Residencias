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
    <title>Help desk::Gestion Prioridad</title>
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
                                <h3>Gestion Prioridad De Incidencias</h3>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="#">Home</a></li>
                                    <li class="active">Gestion Prioridad De Incidencias</li>
                                </ol>
                            </div>
                        </div>
                    </div>
            </header>

            <div class="box-typical box-typical-padding">
                <div type="button" id="btnNuevaPrioridad" class="btn btn-inline btn-primary">Nueva Prioridad</div>
                <table id="Prioridad_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>

                            <th class="d-none d-sm-table-cell" style="width: 5%;">Nombre</th>
                            
                            <th class="text-center" style="width: 1%;"></th>
                            <th class="text-center" style="width: 1%;"></th>
                        
                        </tr>
                    </thead>
                </table>


            </div>    
            <!-- modal prioridad -->
            <div id="ModalbtnNuevaPrioridad" class="modal fade bd-example-modal" tabindex="-1" role="dialog"       aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                <i class="font-icon-close-2"></i>
                            </button>
                            <h4 class="modal-title" id="labelTitulo"></h4>
                        </div>
                        <form action="post" id="Proridad-form">
                            <div class="modal-body">
                                
                                <input type="hidden" id="id">

                                <div class="form-group">
                                    <label class="form-label" for="nombre">Nombre</label>
                                    <input type="text" maxlength="20" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre" required>
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


		</div><!--.container-fluid-->
	</div><!--.page-content-->

    <?php  require_once("../GestionUsuarios/ModalNuevoUsuario.php"); ?>

    <?php  require_once("../MainJs/js.php"); ?>
    <script src="gestionPrioridad.js"></script>

</body>
</html>
<?php 
}else {
    header("Location:http://localhost/proyecto_residencias/index.php");
    
}

?>