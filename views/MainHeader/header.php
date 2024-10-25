<header class="site-header">
	    <div class="container-fluid">
	
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="../../public/img/logo-2.png" alt="">
	            <img class="hidden-lg-up" src="../../public/img/logo-2-mob.png" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                
	
	                    
	
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="font-icon font-icon-user"></span>
								<span class="lblcontacto text-primary"> <?php echo $_SESSION['usuario_nombre']?> <?php echo $_SESSION['usuario_apellidos'] ?> </span>
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="../Perfil/index.php"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-cog"></span>Configuraciones</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>
	                            <div class="dropdown-divider"></div>
	                            <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
	                        </div>
	                    </div>
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>

					<input type="hidden" id="user_idx" value="<?php echo $_SESSION['usuario_id'] ?>"> <!--.id de usuario-->

					<input type="hidden" id="rol_id" value="<?php echo $_SESSION['rol_usuario'] ?>">	
<!-- 
					<div class="dropdown dropdown-typical">
						<a href="../Perfil/index.php" class="dropdown-toggle no-arr">
							<span class="font-icon font-icon-user"></span>
							<span class="lblcontacto"> <?//php echo $_SESSION['usuario_nombre']?> <?//php echo $_SESSION['usuario_apellidos'] ?> </span>
							<span class="lblcontacto rol-id">  </span>
						</a>
					</div>	 -->


	                <div class="site-header-collapsed">
	                    <div class="site-header-collapsed-in">
	                        
	                       
	                        
	                        
	
	                        
	                      
	                    </div><!--.site-header-collapsed-in-->
	                </div><!--.site-header-collapsed-->
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->