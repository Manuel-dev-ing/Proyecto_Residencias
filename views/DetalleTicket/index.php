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
    <title>Help desk::Detalle Ticket</title>
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
								<h3 id="lbldetalleIncidencia">Detalle de la Incidencia</h3>
								<div id="lblestado"></div>
								<span class="label label-pill label-primary" id="lblsucursal"></span>
								<span class="label label-pill label-primary" id="lblnombreusuario">Nombre del usuario</span>
								<span class="label label-pill label-default" id="lblfecha">09/99/9999</span>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Detalle de la Incidencia</li>
								</ol>
							</div>
						</div>
					</div>
			</header>

			<div class="box-typical box-typical-padding">
				<div class="row">
					<form id="Form_CrearIncidencia">
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="categoria_nombre">Categoria</label>
								<input type="text" class="form-control" id="categoria_nombre" readonly>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="incidencia_titulo">Titulo</label>
								<input type="text" class="form-control" id="incidencia_titulo" readonly>
							</fieldset>
						</div>

						<div class="col-lg-12">
						<fieldset class="form-group">
						<label class="form-label semibold" for="tick-titulo">Documentos Adicionales</label>	
							<table id="documentos-data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
							<thead>
								<tr>
									<th style="width: 90%;">Nombre</th>
									<th class="text-center" style="width: 10%"></th>
								</tr>
							</thead>
							</table>
							
						</fieldset>
						</div>

						<div class="col-lg-12">
							<fieldset class="form-group">
								<label class="form-label semibold" for="incidencia_descripcion">Descripcion</label>
								<div class="summernote" >
									<textarea class="summernote" id="Usudescripcion" name="name"></textarea>
								</div>
							</fieldset>
						</div>
					</form>
				</div><!--.row--> 
        	</div> 

            <section class="activity-line" id="lbldetalle">


				
			</section><!--.activity-line-->
			
			<div class="box-typical box-typical-padding" id="panelDetalle">

				<h5 class="m-t-lg with-border">Ingresar Informacion</h5>

					<div class="row">
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInputPassword1">Descripcion</label>
									<div class="summernote" >
										<textarea class="summernote" id="Detalleincidencia_descripcion" name="name"></textarea>
									</div>
								</fieldset>
							</div>
							<div class="col-lg-12">
								<button type="button" id="btnEnviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
								<button type="button" id="btnCerrar" class="btn btn-rounded btn-inline btn-warning">Cerrar</button>
								
							</div>
					</div><!--.row--> 
	        </div>     


		</div><!--.container-fluid-->
	</div><!--.page-content-->

    <?php  require_once("../MainJs/js.php"); ?>
    <script src="DetalleTicket.js"></script>

</body>
</html>
<?php 
}else {
    header("Location:http://localhost/proyecto_residencias/index.php");
    
}

?>