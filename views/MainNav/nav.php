<?php 
// session_start();


if ($_SESSION['rol_usuario'] == 2) {
?>	

	<nav class="side-menu">
	    <ul class="side-menu-list">
	      
            <li class="blue-dirty">
	            <a href="../Home/">
	                <span class="glyphicon glyphicon-home"></span>
	                <span class="lbl">Inicio</span>
	            </a>
	        </li>
	        <li class="blue-dirty">
	            <a href="../NuevaIncidencia/">
	                <span class="glyphicon glyphicon-th"></span>
	                <span class="lbl">Nueva Incidencia</span>
	            </a>
	        </li>
	        <li class="blue-dirty">
	            <a href="../ConsultarIncidencia/">
	                <span class="glyphicon glyphicon-th"></span>
	                <span class="lbl">Consultar Incidencia</span>
	            </a>
	        </li>
	     
	    </ul>
	</nav><!--.side-menu-->
<?php 
} else {
?>	

<nav class="side-menu">
	    <ul class="side-menu-list">
	      
            <li class="blue-dirty">
	            <a href="../Home/">
	                <span class="glyphicon glyphicon-home"></span>
	                <span class="lbl">Inicio</span>
	            </a>
	        </li>
	        <li class="magenta">
	            <a href="../ConsultarIncidencia/">
	                <span class="glyphicon glyphicon-list-alt"></span>
	                <span class="lbl">Consultar Incidencia</span>
	            </a>
	        </li>
			<li class="blue-dirty">
	            <a href="../GestionUsuarios/">
	                <span class="font-icon font-icon-users"></span>
	                <span class="lbl">Gestion Usuarios</span>
	            </a>
	        </li>
			<li class="blue-dirty">
	            <a href="../GestionCategorias/">
	                <span class="glyphicon glyphicon-th"></span>
	                <span class="lbl">Gestion Categoria</span>
	            </a>
	        </li>
			<li class="blue-dirty">
	            <a href="../GestionPrioridad/">
	                <span class="glyphicon glyphicon-th"></span>
	                <span class="lbl">Gestion Prioridad</span>
	            </a>
	        </li>
			<li class="blue-dirty">
	            <a href="../GestionSucursales/">
	                <span class="glyphicon glyphicon-th"></span>
	                <span class="lbl">Gestion Sucursales</span>
	            </a>
	        </li>
	    </ul>
	</nav><!--.side-menu-->


<?php
}
?>






