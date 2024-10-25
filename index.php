<?php 
    if (isset($_POST["enviar"]) and $_POST["enviar"]=="si") {
        require_once("controllers/UsuarioController.php");
    }
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Soporte Tecnico</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/lib/bootstrap/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="public/css/main.css"> -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<main>
      <div class="container">

          <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                          <div class="card mb-3">

                              <div class="card-body">

                                  <div class="pt-4 pb-2">
                                      <h5 class="card-title text-center pb-0 fs-4">Inicia Sesion en tu Cuenta</h5>
                                      <p class="text-center small">ingresa tu correo y contraseña para iniciar sesion</p>
                                  </div>

                                  <form class="row g-3" action="controllers/UsuarioController.php"method="POST" id="login_form">
                                    <?php 
                                        if (isset($_GET["m"])) {
                                            switch ($_GET["m"]) {
                                                case "1":
                                                    ?> 
                                                        <div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">x</span>
                                                            </button>
                                                            <i class="font-icon font-icon-warning"></i>
                                                            El Usuario y/o Contraseña son incorrectos.
                                                        </div>
                                                    <?php 
                                                break;
                                                
                                                case "2":
                                                    ?>           
                                                        <div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">x</span>
                                                            </button>
                                                            <i class="font-icon font-icon-warning"></i>
                                                            Los campos estan vacios.
                                                        </div>
                                                    <?php 
                                                break;
                                                
                                            }
                                    
                                        }
                                    ?>

                                      <div class="col-12">
                                          <label class="form-label">Correo Electronico</label>
                                          <input type="email" id="usuario_correo" name="usuario_correo" class="form-control" placeholder="ingresa tu correo electronico">
                                      </div>

                                      <div class="col-12">
                                          <label class="form-label">Contraseña</label>
                                          <input type="password" id="usuario_pass" name="usuario_pass" class="form-control" placeholder="ingresa tu contraseña">
                                      </div>

                                      <div class="col-12">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" onclick="MostrarContrasena()">Mostrar Contraseña
                                              <label class="form-check-label"></label>
                                          </div>
                                      </div>
                                      <div class="col-12">
                                        <input type="hidden" name="enviar" class="form-control" value="si">
                                          <button class="btn btn-primary w-100" type="submit">Acceder</button>
                                      </div>
                                      
                                  </form>

                              </div>
                          </div>



                      </div>
                  </div>
              </div>

          </section>

      </div>
  </main><!-- End #main -->


<script src="public/js/lib/jquery/jquery.min.js"></script>
<script src="public/js/lib/tether/tether.min.js"></script>
<script src="public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="public/js/plugins.js"></script>

    <script type="text/javascript" src="public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>


<script src="public/js/bootstrap.min.js"></script>

<script src="public/js/app.js"></script>
<script src="index.js"></script>


</body>
</html>