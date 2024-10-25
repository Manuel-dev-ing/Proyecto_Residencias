<?php 
require_once("../../config/conexion.php");
session_destroy();
header("Location:http://localhost/proyecto_residencias/index.php");


?>