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
    <title>Soporte Tecnico::Nueva Incidencia</title>
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
							<h3>Nueva Incidencia</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Nueva incidencia</li>
							</ol>
						</div>
					</div>
				</div>
		</header>
        <div class="box-typical box-typical-padding">
            <p>
                Desde esta ventana podras generara nuevas Incidencias.
            </p>

            <h5 class="m-t-lg with-border">Ingresar Informacion</h5>

				<div class="row">
					<form id="Form_CrearIncidencia" method="post" enctype="multipart/form-data">
						<input type="hidden" id="usuario_id"  name="usuario_id" value="<?php echo $_SESSION['usuario_id']?>">

						<!-- <input type="hidden" name="funcion" value="crear"> -->

						<div class="col-lg-7">
							<fieldset class="form-group">
								<label class="form-label semibold" for="incidencia_titulo">Titulo</label>
								<input type="text" name="incidencia_titulo" class="form-control" id="incidencia_titulo" maxlength="50" placeholder="Ingrese el titulo" required>
							</fieldset>
						</div>
						<div class="col-lg-5">
							<fieldset class="form-group">
								<label class="form-label semibold" for="prioridad">Prioridad</label>
								<select id="prioridad" name="prioridad" class="form-control" required>
								</select>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="categoria">Categoria</label>
								<select id="categoria" name="categoria" class="form-control" required>
								</select>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Archivos</label>
								<input type="file" name="archivo" id="archivo" class="form-control" multiple>
							</fieldset>
						</div>
						<div class="col-lg-12">
							<fieldset class="form-group">
								<label class="form-label semibold" for="incidencia_descripcion">Descripcion</label>
								<div class="summernote-theme-1" >
									<textarea class="summernote" id="incidencia_descripcion" name="incidencia_descripcion" required></textarea>
								</div>
							</fieldset>
						</div>
						<div class="col-lg-12">
							<button type="submit" class="btn btn-rounded btn-inline btn-primary">Guardar</button>
						</div>
					</form>
				</div><!--.row--> 
            

        </div>        
        


		</div><!--.container-fluid-->
	</div><!--.page-content-->

    <?php  require_once("../MainJs/js.php"); ?>
    <script src="./NuevaIncidencia.js"></script>

</body>
</html>
<?php 
}else {
    header("Location:http://localhost/proyecto_residencias/index.php");
    
}

?>