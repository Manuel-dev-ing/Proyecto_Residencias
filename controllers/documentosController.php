<?php
include_once('../models/Documento.php');

$documento = new Documento();

if ($_POST["funcionn"] == "listarDocumentos") {
    
    $datos = $documento->obtener_documento_por_incidencia($_POST["incidencia_id"]);
    $data = Array();
    // echo json_encode($datos);
    foreach ($datos as $row) {
        $sub_array = array();
        $sub_array[] = '<a href="../../public/documents/Nro.Incidencia-'.$_POST["incidencia_id"].'/'.$row->nombre.'" target="_blank" >'. $row->nombre .'</a>';   
        $sub_array[] = '<a type="button" href="../../public/documents/Nro.Incidencia-'.$_POST["incidencia_id"].'/'.$row->nombre.'" target="_blank" class="btn btn-inline btn-primary btn-sm ladda-button">
         <i class="fa fa-eye"></i></a>';
        $data[]=$sub_array;
    }

    $results = array(
        "sEcho"=>1,
        "iTotalRecords"=>count($data),
        "iTotalDisplayRecords"=>count($data),
        "aaData"=>$data);
    echo json_encode($results);    
}









?>