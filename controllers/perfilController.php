<?php 

include_once('../models/Perfil.php');
session_start();


$perfil = new Perfil();


if ($_POST['funcion'] == 'obtenerDatosPerfil') {
    
    $datos = $perfil->obtenerPerfilxId($_POST['id_usuario']);

    foreach ($datos as $row) {
        $output['usuario_id'] = $row->id;
        $output['usuario_nombre'] = $row->nombre;
        $output['usuario_apellidos'] = $row->apellidos;
        $output['usuario_correo'] = $row->correo;
        $output['edad'] = $row->edad;
        $output['telefono'] = $row->telefono;
        $output['direccion'] = $row->direccion;
        $output['genero'] = $row->genero;
    }

    echo json_encode($output);
}

if ($_POST['funcion'] == 'guardarCambios') {
    $id_user = $_POST['id_user'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $apellido_usuario = $_POST['apellido_usuario'];
    $correo_usuario = $_POST['correo_usuario'];
    $edad_usuario = $_POST['edad_usuario'];
    $telefono_usuario = $_POST['telefono_usuario'];
    $direccion_usuario = $_POST['direccion_usuario'];
    $genero_usuario = $_POST['genero_usuario'];

    $perfil->editarPerfil($nombre_usuario, $apellido_usuario, $correo_usuario, $edad_usuario, $telefono_usuario, $direccion_usuario, $genero_usuario, $id_user);

}

if ($_POST['funcion'] == 'existeContrasena') {
    
    $idUsuario = $_POST['id_usuario'];
    $contrasenaActual = $_POST['contrasenaActual'];


    $datos = $perfil->verficarContrasena($idUsuario, $contrasenaActual);

    if (count($datos) <= 0) {
    
        //contrasena Incorrecta
        $resultado = "NotFound";
        echo json_encode($resultado);
    
    }else{
        foreach ($datos as $row) {
            $output['usuario_passwordD'] = $row->password;
        
        }
        echo json_encode($output);
        
    }

   

}

if ($_POST['funcion'] == 'cambiarContrasena') {
    
    
    $nuevaContrasena = $_POST['repetirNuevaContrasena'];
    $id_usuario = $_POST['id_usuario'];

    $perfil->cambiarContrasena($nuevaContrasena, $id_usuario);

}  
















?>