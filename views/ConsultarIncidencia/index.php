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
    <title>Help desk::Consultar Ticket</title>
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
							<h3>Consultar Incidencia</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Consultar incidencia</li>
							</ol>
						</div>
					</div>
				</div>
		</header>

        <div class="box-typical box-typical-padding">

            <table id="incidencia_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th style="width: 1%;">Nro.</th>
                        <th id="th-usuario" style="width: 15%;">Usuario</th>
                        <th id="th-sucursal" style="width: 10%;">Sucursal</th>
                        <th style="width: 10%;">Categoria</th>
                        <th class="d-none d-sm-table-cell" style="width: 28%;">Titulo</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Prioridad</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Estado</th>
                        <th class="d-none d-sm-table-cell" style="width: 13%;">Fecha Creacion</th>
                        <th class="d-none d-sm-table-cell" style="width: 13%;">Fecha Asignacion</th>
                        <th class="d-none d-sm-table-cell" style="width: 13%;">Soporte</th>
                        <th class="text-center" style="width: 8%;"></th>
                    </tr>
                </thead>
            </table>


        </div>    




		</div><!--.container-fluid-->
	</div><!--.page-content-->
    <?php  require_once("ModalAsignar.php"); ?>

    <?php  require_once("../MainJs/js.php"); ?>
    <script src="ConsultarIncidencia.js"></script>

</body>
</html>
<?php 
}else {
    header("Location:http://localhost/proyecto_residencias/index.php");
    
}

?>