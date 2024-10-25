<?php 

include '../models/Incidencia.php';
include_once('../models/Usuario.php');
include_once('../models/Documento.php');

$incidencia = new Incidencia();

$usuario = new Usuario();

$documento = new Documento();


if (empty($_FILES["files"])) {
    $mensaje = "No hay archivos";
    echo json_encode($mensaje);

}else{
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        // exit;
    $usuario_id = $_POST["usuario_id"];
    $incidencia_titulo = $_POST["incidencia_titulo"];
    $prioridad_id = $_POST["prioridad"];
    $categoria_id = $_POST["categoria"];
    $incidencia_descripcion = $_POST["incidencia_descripcion"];



    $datos = $incidencia->CrearIncidencia($usuario_id, $categoria_id, $prioridad_id, $incidencia_titulo,  $incidencia_descripcion);

    if (count($datos)>0) {
        foreach ($datos as $row) {
            $output["incidencia_id"] = $row->incidencia_id;

            if (empty($_FILES["files"]["name"])) {
                return $datos;
            } else {
                $countfiles = count($_FILES["files"]["name"]);
                $ruta = "../public/documents/". "Nro.Incidencia-" . $output["incidencia_id"]."/";
                $files_arr = array();

                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }

                for ($index=0; $index < $countfiles; $index++) { 
                    $doc1 = $_FILES["files"]["tmp_name"][$index];
                    $destino = $ruta.$_FILES["files"]["name"][$index];

                    $documento->CrearDocumento($output["incidencia_id"], $_FILES["files"]["name"][$index]);

                    move_uploaded_file($doc1, $destino);
                } 

            }
        }
    }
    
    echo json_encode($countfiles);

}
















?>