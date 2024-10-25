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
    <title>Perfil de Usuarios</title>
    <link rel="stylesheet" href="../../public/css/style.css">
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
                                <h3>Perfil</h3>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="#">Home</a></li>
                                    <li class="active">Perfil</li>
                                </ol>
                            </div>
                        </div>
                    </div>
            </header>

            <section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-inline">
					<ul class="nav" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" href="#infoPerfil" role="tab" data-toggle="tab">
								Sobre mi
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#editPerfil" role="tab" data-toggle="tab">
								Editar Perfil
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#cambiarContrasena" role="tab" data-toggle="tab">
								Cambiar Contraseña
							</a>
						</li>
					
					</ul>
				</div><!--.tabs-section-nav-->

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="infoPerfil">
                        
                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3">Nombre Completo</label>
                            <div class="col-lg-8 col-md-8" id="nombrePerfil" ></div>
                        </div>
                        <div class="row" style="margin-bottom: 9px;">
                            <div class="col-lg-3 col-md-4">Correo</div>
                            <div class="col-lg-9 col-md-5" id="correoPerfil"></div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-lg-3 col-md-4">Edad</div>
                            <div class="col-lg-9 col-md-5" id="edadPerfil"></div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-lg-3 col-md-4">Telefono</div>
                            <div class="col-lg-9 col-md-5" id="telefonoPerfil"></div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-lg-3 col-md-4">Direccion</div>
                            <div class="col-lg-9 col-md-5" id="direccionPerfil"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4">Genero</div>
                            <div class="col-lg-9 col-md-5" id="generoPerfil"></div>
                        </div>
                    
                    </div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane fade" id="editPerfil">
                        <input type="hidden" id="id_usuario">
                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3" style="margin-top: 10px;">Nombre</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="nombre_usuario">
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3" style="margin-top: 10px;">Apellido</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="apellido_usuario">
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3" style="margin-top: 10px;">Correo</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="correo_usuario">
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3" style="margin-top: 10px;">Edad</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="edad_usuario">
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3" style="margin-top: 10px;">Telefono</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="telefono_usuario">
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3" style="margin-top: 10px;">Direccion</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="direccion_usuario">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3" style="margin-top: 10px;">Genero</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="genero_usuario">
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 17px; padding-left: 370px">
                            <button class="btn btn-primary" style="width: 200px;" id="guardarCambios">Guardar Cambios</button>
                        </div>
                    </div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane fade" id="cambiarContrasena">
                        
                        <div class="row" style="margin-bottom: 10px;">
                            <span id="spanPassword" class="text-danger">Contraseña incorrecta</span>
                            <label class="col-lg-3" style="margin-top: 10px;">Contraseña Actual</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control input-password" id="contrasenaActual" placeholder="Contraseña Actual" required>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <label class="col-lg-3" style="margin-top: 10px;">Nueva Contrseña</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control input-password" id="nuevaContrasena" placeholder="Nueva Contrseña" required>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 10px;">
                            <span id="spanPassword-repeatpass" class="text-danger">Contraseña diferente a la anterior</span>

                            <label class="col-lg-3" style="margin-top: 10px;">Repetir Nueva Contrseña</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control input-password" id="repetirNuevaContrasena" placeholder="Repetir Nueva Contrseña" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 30px; padding-left: 20px">
                            <button class="btn btn-primary" style="width: 200px;" id="btnCambiarContrasena">Guardar Cambios</button>
                        </div>

                    </div><!--.tab-pane-->
					
				</div><!--.tab-content-->
			</section><!--.tabs-section-->

		</div><!--.container-fluid-->
	</div><!--.page-content-->

    <?php  require_once("../GestionUsuarios/ModalNuevoUsuario.php"); ?>

    <?php  require_once("../MainJs/js.php"); ?>
    <script src="informacionperfil.js"></script>
    <script src="editarPerfil.js"></script>
    <script src="cambiarContrasena.js"></script>

</body>
</html>
<?php 
}else {
    header("Location:http://localhost/proyecto_residencias/index.php");
    
}

?>



