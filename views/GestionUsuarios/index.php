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
    <title>Help desk::Gestion Usuarios</title>
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
							<h3>Gestion de Usuarios</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Gestion Usuarios</li>
							</ol>
						</div>
					</div>
				</div>
		</header>

        <div class="box-typical box-typical-padding">
            <div type="button" id="btnNuevoUsuario" class="btn btn-inline btn-primary">Nuevo Usuario</div>
            <table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>

                        <th class="d-none d-sm-table-cell" style="width: 5%;">Nombre</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Apellidos</th>
                        <th class="d-none d-sm-table-cell" style="width: 35%;">Correo</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Rol</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Sucursal</th>
                        <th class="text-center" style="width: 5%;"></th>
                        <th class="text-center" style="width: 5%;"></th>
                    
                    </tr>
                </thead>
            </table>


        </div>    




		</div><!--.container-fluid-->
	</div><!--.page-content-->

    <?php  require_once("../GestionUsuarios/ModalNuevoUsuario.php"); ?>

    <?php  require_once("../MainJs/js.php"); ?>
    <script src="GestionUsuarios.js"></script>

</body>
</html>
<?php 
}else {
    header("Location:http://localhost/proyecto_residencias/index.php");
    
}

?>