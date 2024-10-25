<?php

include '../models/Usuario.php';

session_start();

$usuario = new Usuario();

if (isset($_POST['enviar'])) {
    $correo = $_POST["usuario_correo"];
    $pass = $_POST["usuario_pass"];
     
    if (empty($correo) and empty($pass)) {
        header("Location:http://localhost/proyecto_residencias/index.php?m=2");
        exit();
    } else {
        $usuario->Loguearse($correo);
        $userPass = $pass;

        
        if (is_array($usuario->objetos) and count($usuario->objetos) > 0) {

            foreach ($usuario->objetos as $objeto) {
                $_SESSION['usuario_id'] = $objeto->id;
                $_SESSION['usuario_nombre'] = $objeto->nombre;
                $_SESSION['usuario_apellidos'] = $objeto->apellidos;
                $_SESSION['rol_usuario'] = $objeto->rol_id;
                $passwordHash = $objeto->password;
            }

            if (password_verify($userPass, $passwordHash)) {
                switch ($_SESSION['rol_usuario']) {
                    case 1:
                        header("Location:http://localhost/proyecto_residencias/views/Home/");
                        break;
    
                    case 2:
                        header("Location:http://localhost/proyecto_residencias/views/Home/");
                        break;
                }
            }else {

                header("Location:http://localhost/proyecto_residencias/index.php?m=1"); //usuario incorrecto
                exit();
            }

        } else {

            header("Location:http://localhost/proyecto_residencias/index.php?m=1"); //usuario incorrecto
            exit();
        }
    }
}


if ($_POST["funcion"] == "listarUsuario") {

    $datos = $usuario->Obtener_Usuarios();

    $data = array();
    foreach ($datos as $row) {
        $subArray = array();
        $subArray[] = $row->nombre;
        $subArray[] = $row->apellidos;
        $subArray[] = $row->correo;

        if ($row->rol_id == '1') {
            $subArray[] = '<span class="label label-pill label-success">Soporte</span>';
        } else {
            $subArray[] = '<span class="label label-pill label-info">Usuario</span>';
        }

        if ($row->rol_id == '1') {
            $subArray[] = '<span class="label label-pill label-success">Dept. TI</span>';
        } else if ($row->rol_id != '1') {
            $subArray[] = '<span class="label label-pill label-warning">'.$row->sucursal.'</span>';
        } 

        //  $subArray[] = $row->incidencia_estado;
        $subArray[] = '<button type="button" onClick="Editar(' . $row->id . ');" id="' . $row->id . '" class="btn btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';

        $subArray[] = '<button type="button" onClick="Eliminar(' . $row->id . ');" id="' . $row->id . '" class="btn btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
        $data[] = $subArray;
    }

    $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data
    );
    echo json_encode($results);
}

if ($_POST["funcion"] == "eliminar") {

    $usuario_id = $_POST['usuario_id'];
    $estado = 0;
    $fecha_eliminacion = date("Y-m-d");


    $usuario->Eliminar_Usuario($usuario_id, $estado, $fecha_eliminacion);
}

if ($_POST["funcion"] == "Obtener_Usuarios_x_id") {
            

    $datos = $usuario->Obtener_Usuarios_x_id($_POST['usuario_id']);
        // echo "<pre>";
        // var_dump($datos);
        // echo "</pre>";
        // exit;
    foreach ($datos as $row) {

        $output["usuario_id"] = $row->id;
        $output["usuario_nombre"] = $row->nombre;
        $output["usuario_apellido"] = $row->apellidos;
        $output["usuario_correo"] = $row->correo;
        $output["usuario_password"] = $row->password;
        $output["sucursal_id"] = $row->sucursal_id;
        $output["rol_id"] = $row->rol_id;
    }

    echo json_encode($output);
}

if ($_POST["funcion"] == "Total") {
    $datos = $usuario->Incidencias_x_Usuario($_POST['usuario_id']);
    foreach ($datos as $row) {
        $json[] = array(
            'total' => $row->total
        );
    }


    echo json_encode($json);
}

if ($_POST["funcion"] == "totalAbierto") {
    $datos = $usuario->Incidencias_x_UsuarioAbierto($_POST['usuario_id']);
    foreach ($datos as $row) {
        $json[] = array(
            'total' => $row->total
        );
    }


    echo json_encode($json);
}

if ($_POST["funcion"] == "totalCerrado") {
    $datos = $usuario->Incidencias_x_UsuarioCerrado($_POST['usuario_id']);
    foreach ($datos as $row) {
        $json[] = array(
            'total' => $row->total
        );
    }


    echo json_encode($json);
}


if ($_POST['funcion'] == 'LlenarRoles') {
    $datos = $usuario->LlenarRol();
    $json = array();
    foreach ($datos as $row) {
        $json[] = array(
            'id' => $row->id,
            'rol' => $row->nombre
        );
    }
    echo json_encode($json);
}

if ($_POST['funcion'] == 'LlenarSelectSucursal') {
    $datos = $usuario->LlenarSelectSucursal();
    $json = array();
    foreach ($datos as $row) {
        $json[] = array(
            'id' => $row->id,
            'nombre' => $row->nombre
        );
    }
    echo json_encode($json);
}

if ($_POST["funcion"] == "editar") {

    $usuario_id = $_POST["usuario_id"];
    $usuario_nombre = $_POST["usuario_nombre"];
    $usuario_apellidos = $_POST["usuario_apellidos"];
    $usuario_password = $_POST["usuario_password"];
    $usuario_correo = $_POST["usuario_correo"];
    $rol_id = $_POST["rol_id"];
    $sucursal_id = $_POST["sucursal"];
    $fecha_modificacion = date("Y-m-d");

    $usuario->Actualizar_Usuario($usuario_id, $usuario_nombre, $usuario_apellidos, $usuario_password, $usuario_correo, $rol_id, $sucursal_id, $fecha_modificacion);
}

if ($_POST["funcion"] == "crear") {
    $usuario_nombre = $_POST["usuario_nombre"];
    $usuario_apellidos = $_POST["usuario_apellidos"];
    $usuario_password = $_POST["usuario_password"];
    $usuario_correo = $_POST["usuario_correo"];
    $rol_id = $_POST["rol_id"];
    $sucursal = $_POST["sucursal"];

    $usuario->Crear_Usuario($usuario_nombre, $usuario_apellidos, $usuario_password, $usuario_correo, $rol_id, $sucursal);
}

if ($_POST["funcion"] == "LlenarSelectSoporte") {

    $datos = $usuario->ObtenerUsuariosPorRol();
    $json = array();
    foreach ($datos as $row) {
        $json[] = array(
            'usuario_id' => $row->id,
            'usuario_nombre' => $row->nombre . ' '. $row->apellidos
        );
    }
    echo json_encode($json);
}
