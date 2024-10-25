<?php

include '../models/Prioridad.php';

$prioridad = new Prioridad();

if ($_POST['funcion'] == 'listarprioridad') {
    
    $datos = $prioridad->obtenerPrioridad();
    $data = array();

    foreach ($datos as $row) {
        
        $subArray = array();
        $subArray[] = $row->nombre;

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
    // var_dump($_POST);
    $nombre = $_POST['nombre'];
    $estado = 1;

    $prioridad->crearPrioridad($nombre, $estado);

}

if ($_POST['funcion'] == 'eliminar') {
    
    $prioridad_id = $_POST['id'];
    $estado = 0;

    $prioridad->eliminarPrioridad($prioridad_id, $estado);

}

if ($_POST['funcion'] == 'obtenerPioridad_x_id') {
    
    $datos = $prioridad->obtenerPrioridadxId($_POST['id']);

    foreach ($datos as $row) {
        $output["nombre"] = $row->nombre;
        $output["id"] = $row->id;
    }

    echo json_encode($output);


}

if ($_POST['funcion'] == 'editar') {
    
    $prioridad_nombre = $_POST['nombre'];    
    $Proridad_id = $_POST['id'];

    $prioridad->editarPrioridad($prioridad_nombre, $Proridad_id);

}


if ($_POST['funcion'] == 'LlenarComboPrioridad') {
    $prioridad->obtenerPrioridad();    
    $json = array();
    foreach ($prioridad->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonString=json_encode($json);
    echo $jsonString;


}



?>