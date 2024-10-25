<?php 

include '../models/Sucursal.php';

$sucursal = new Sucursal();


if($_POST['funcion'] == 'listarSucursal'){

    $datos = $sucursal->obtenerSucursal();
        // echo "<pre>";
        // var_dump($datos);
        // echo "</pre>";
        // exit;
    $data = array();

    foreach ($datos as $row) {
        
        $subArray = array();
        $subArray[] = $row->nombre;
        $subArray[] = $row->direccion;
        $subArray[] = $row->ciudad;
        $subArray[] = $row->telefono;
        $subArray[] = $row->fecha_creacion;

        //  $subArray[] = $row->incidencia_estado;
        $subArray[] = '<button type="button" onClick="Editar('.$row->id.');" id="'.$row->id.'" class="btn btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';

        $subArray[] = '<button type="button" onClick="Eliminar('.$row->id.');" id="'.$row->id.'" class="btn btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
        $data[] = $subArray;
    }

    $results = array(
        "sEcho"=>1,
        "iTotalRecords"=>count($data),
        "iTotalDisplayRecords"=>count($data),
        "aaData"=>$data);
    echo json_encode($results);     


}


if ($_POST['funcion'] == 'crear') {
      
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];
    $estado = 1;
  
    $sucursal->crearSucursal($nombre, $direccion, $ciudad, $telefono, $estado);
       
}

if ($_POST['funcion'] == 'eliminar') {
    
    $id = $_POST['id'];

    $sucursal->eliminarSucursal($id);
}

if ($_POST['funcion'] == 'obtenerSucursal_x_id') {

    $datos = $sucursal->obtenerSucursalxId($_POST['id']);

    foreach ($datos as $row) {

        $output["nombre"] = $row->nombre;
        $output["id"] = $row->id;
        $output["direccion"] = $row->direccion;
        $output["ciudad"] = $row->ciudad;
        $output["telefono"] = $row->telefono;
    
    }

    echo json_encode($output);
}

if ($_POST['funcion'] == 'editar') {
    
    $nombre = $_POST['nombre'];    
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];
    $id = $_POST['id'];
    $estado = 1;

    $sucursal->editarSucursal($nombre, $direccion, $ciudad, $telefono, $id, $estado);

}





?>