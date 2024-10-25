<?php 

include '../models/Categoria.php';

$categoria = new Categoria();

if ($_POST['funcion'] == 'LlenarComboCategorias') {
    $categoria->get_Categoria();    
    $json = array();
    foreach ($categoria->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonString=json_encode($json);
    echo $jsonString;
}

if ($_POST['funcion'] == 'listarCategorias') {
    
    $datos = $categoria->get_Categoria();
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
    $nombreCategoria = $_POST['nombre'];    
    $estado = 1;

    $categoria->crearCategoria($nombreCategoria, $estado);
}

if ($_POST['funcion'] == 'eliminar') {
    $categoria_id = $_POST['categoria_id'];
    $estado = 0;

    $categoria->eliminarCategoria($categoria_id, $estado);
}

if ($_POST['funcion'] == 'obtenerCategoria_x_id') {
    $datos = $categoria->obtenerCategoriaxId($_POST['categoria_id']);
    
    foreach ($datos as $row) {
        $output["nombre"] = $row->nombre;
        $output["id"] = $row->id;
    }

    echo json_encode($output);
}

if ($_POST['funcion'] == 'editar') {
    $nombreCategoria = $_POST['nombre'];    
    $id = $_POST['id'];

    $categoria->editarCategoria($nombreCategoria, $id);
}



?>