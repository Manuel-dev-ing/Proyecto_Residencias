<?php 

include '../models/Incidencia.php';
include_once('../models/Usuario.php');
include_once('../models/Documento.php');

$incidencia = new Incidencia();

$usuario = new Usuario();

$documento = new Documento();


// if ($_POST["funcion"] == $_POST["crear"]) {
    
//     $usuario_id = $_POST["usuario_id"];
//     $categoria_id = $_POST["categoria"];
//     $incidencia_titulo = $_POST["incidencia_titulo"];
//     $incidencia_descripcion = $_POST["incidencia_descripcion"];

//     $datos = $incidencia->CrearIncidencia($usuario_id, $categoria_id , $incidencia_titulo,  $incidencia_descripcion);

//     if (count($datos)>0) {
//         foreach ($datos as $row) {
//             $output["incidencia_id"] = $row->incidencia_id;

//             if ($_FILES["files"]["name"] == 0) {

//             } else {
//                 $countfiles = count($_FILES["files"]["name"]);
//                 $ruta = "../public/documents/". "Nro. Incidencia " . $output["incidencia_id"]."/";
//                 $files_arr = array();

//                 if (!file_exists($ruta)) {
//                     mkdir($ruta, 0777, true);
//                 }

//                 for ($index=0; $index < $countfiles ; $index++) { 
//                     $doc1 = $_FILES["files"]["tmp_name"][$index];
//                     $destino = $ruta.$_FILES["files"]["name"];

//                     $documento->CrearDocumento($output["incidencia_id"], $doc1);

//                     move_uploaded_file($doc1, $destino);
//                 } 

//             }
//         }
//     }

//     echo json_encode($datos);
// }

if ($_POST["funcion"] == "listar_incidencia_x_usuario") {
    

    $datos = $incidencia->Listar_incidencia_x_usuario($_POST['usu_id']);
   
    $data = array();
    foreach ($datos as $row) {
        
        $subArray = array();
        $subArray[] = $row->id;
        $subArray[] = $row->categoria;

        $subArray[] = $row->titulo;

        if ($row->prioridad_id == 1) {
            $subArray[] = '<span class="label label-pill label-danger">Alta</span>';
        
        }else if($row->prioridad_id == 2){
            $subArray[] = '<span class="label label-pill label-warning">Media</span>';
        
        }else if($row->prioridad_id == 3){
            $subArray[] = '<span class="label label-pill label-success">Baja</span>';
        
        }else if($row->prioridad_id >= 3){
            $subArray[] = '<span class="label label-pill label-secondary">Regular</span>';

        }

        if ($row->estado_incidencia == 'Abierto') {
            $subArray[] = '<span class="label label-pill label-success">Abierto</span>';

        } else {
            $subArray[] = '<span class="label label-pill label-danger">Cerrado</span>';

        }
        //$subArray[] = $row->incidencia_estado;

        $subArray[] = date("d/m/Y", strtotime($row->fecha_creacion));

        if ($row->fecha_asignacion == null) {
            $subArray[] = '<span class="label label-pill label-default">Sin Asignar</span>';

        } else {
            $subArray[] = date("d/m/Y", strtotime($row->fecha_asignacion));

        }
        
        if ($row->usuarios_asignado == null) {
            $subArray[] = '<span class="label label-pill label-warning">Sin Asignar</span>';

        } else {
            $datos1 = $usuario->Obtener_Usuarios_x_id($row->usuarios_asignado);
            foreach ($datos1 as $row2) {
                $subArray[] = '<span class="label label-pill label-warning">'.$row2->nombre.'</span>';

            }
        }
       
        $subArray[] = '<button type="button" onClick="ver('.$row->id.');" id="'.$row->id.'" class="btn btn-outline-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
        $data[] = $subArray;
    }

    $results = array(
        "sEcho"=>1,
        "iTotalRecords"=>count($data),
        "iTotalDisplayRecords"=>count($data),
        "aaData"=>$data);
    echo json_encode($results);    

}

if ($_POST["funcion"] == "listar") {

    $datos = $incidencia->Listar_incidencia();
    
    $data = array();
    foreach ($datos as $row) {
        $subArray = array();
        $subArray[] = $row->id;
        $subArray[] = $row->usuario;
        $subArray[] = $row->sucursal;
        $subArray[] = $row->categoria;

        $subArray[] = $row->titulo;

        if ($row->prioridad_id == 1) {
            $subArray[] = '<span class="label label-pill label-danger">Alta</span>';
        
        }else if($row->prioridad_id == 2){
            $subArray[] = '<span class="label label-pill label-warning">Media</span>';
        
        }else if($row->prioridad_id == 3){
            $subArray[] = '<span class="label label-pill label-success">Baja</span>';
        
        }else if($row->prioridad_id >= 3){
            $subArray[] = '<span class="label label-pill label-secondary">Regular</span>';

        }

        if ($row->estado_incidencia == 'Abierto') {
            $subArray[] = '<span class="label label-pill label-success">Abierto</span>';

        } else {
            $subArray[] = '<span class="label label-pill label-danger">Cerrado</span>';

        }
        //$subArray[] = $row->incidencia_estado;

        $subArray[] = date("d/m/Y", strtotime($row->fecha_creacion));

        if ($row->fecha_asignacion == null) {
            $subArray[] = '<span class="label label-pill label-default">Sin Asignar</span>';

        } else {
            $subArray[] = date("d/m/Y", strtotime($row->fecha_asignacion));

        }


        if ($row->usuarios_asignado == null) {
            $subArray[] = '<a onClick="Asignar('.$row->id.');" ><span class="label label-pill label-warning">Sin Asignar</span></a>';

        } else {
            $datos1 = $usuario->Obtener_Usuarios_x_id($row->usuarios_asignado);
            foreach ($datos1 as $row1) {
                $subArray[] = '<span class="label label-pill label-success">'.$row1->nombre.'</span>';

            }
        }

        $subArray[] = '<button type="button" onClick="ver('.$row->id.');" id="'.$row->id.'" class="btn btn-outline-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
        $data[] = $subArray;
    }

    $results = array(
        "sEcho"=>1,
        "iTotalRecords"=>count($data),
        "iTotalDisplayRecords"=>count($data),
        "aaData"=>$data);
    echo json_encode($results);    

}


if ($_POST["funcion"] == "Listar_incidenciaDetalle") {

    $datos = $incidencia->Listar_incidenciaDetalle_x_incidencia($_POST['incidencia_id']);
    ?>
    <?php 
        foreach ($datos as $row) {
           ?>     
				<article class="activity-line-item box-typical">
					<div class="activity-line-date">
						<?php echo date("d/m/Y H:i:s", strtotime($row->fecha_creacion)) ?>
					</div>
					<header class="activity-line-item-header">
						<div class="activity-line-item-user">
							<div class="activity-line-item-user-photo">
								<a href="#">
									<img src="img/photo-64-2.jpg" alt="">
								</a>
							</div>
							<div class="activity-line-item-user-name"><?php echo $row->nombre.' '.$row->apellidos ?></div>
							<div class="activity-line-item-user-status">
                                <?php 
                                if ($row->rol_id == 1) {
                                    echo "Soporte";
                                } else {
                                    echo "Usuario";
                                }?>
                            
                            </div>
						</div>
					</header>
					<div class="activity-line-action-list">
						<section class="activity-line-action">
							<div class="time">
                                <?php echo date("H:i:s", strtotime($row->fecha_creacion)) ?>
                            </div>
							<div class="cont">
								<div class="cont-in">
									<p><?php echo $row->descripcion ?></p>
									<ul class="meta">
										<li><a href="#">5 Comments</a></li>
										<li><a href="#">1 Likes</a></li>
									</ul>
								</div>
							</div>
						</section><!--.activity-line-action-->
					</div><!--.activity-line-action-list-->
				</article> 

           <?php 
        }    
    ?>
<?php 
}


if ($_POST["funcion"] == "mostrar") {
    
    $datos = $incidencia->Listar_incidencia_x_id($_POST['incidencia_id']);
    // echo "<pre>";
    // var_dump($datos);
    // echo "</pre>";
    // exit;
    foreach ($datos as $row) {

        $output["incidencia_id"] = $row->id;
        // $output["usuario_id"] = $row->nombreUsuario;
        // $output["categoria_id"] = $row->categoria;

        $output["incidencia_titulo"] = $row->titulo;
        $output["incidencia_descripcion"] = $row->descripcion;

        if ($row->estado_incidencia == "Abierto") {

            $output["incidencia_estado"] = '<span class="label label-pill label-success">Abierto</span>';

        } else {
            
            $output["incidencia_estado"] = '<span class="label label-pill label-danger">Cerrado</span>';

        }
        
        $output["incidencia_estado_texto"] = $row->estado_incidencia; 

        $output["fecha_creacion"] = date("d/m/Y", strtotime($row->fecha_creacion));
        $output["usuario_nombre"] = $row->nombreusuario;
        $output["usuario_apellido"] = $row->nombreapellidos;

        // if ($row->sucursal == null || $row->sucursal == "" || $row->sucursal == 0) {
        //     $output["sucursal"] = "Sin Asignar"; 

        // } else {
        //     $output["sucursal"] = $row->sucursal;

        // }

        $output["categoria_nombre"] = $row->categoria;
    }
        
    echo json_encode($output);

}


if ($_POST['funcion'] == 'enviarIncidencia') {
        
    $incidencia_id = $_POST['incidencia_id'];
    $usuario_id = $_POST['usuario_id'];
    $incidencia_descripcion = $_POST['incidencia_descripcion'];

    $incidencia->Insertar_ticketDetalle($incidencia_id, $usuario_id, $incidencia_descripcion);
        
}

if ($_POST["funcion"] == "ActualizarEstadoIncidencia") {
    $incidencia_id = $_POST['incidencia_id'];
    $usuario_id = $_POST['usuario_id'];
    
    $incidencia->Actualizar_Estado_Incidencia($incidencia_id);
    $incidencia->Insertar_ticketDetalleCerrado($incidencia_id, $usuario_id);
}

if ($_POST["funcion"] == "TotalIncidencias") {
    $datos = $incidencia->TotalIncidencias();
    foreach ($datos as $row) {
        $json[] = array(
           'total'=>$row->total
        );    
    }
    echo json_encode($json);
}

if ($_POST["funcion"] == "totalAbiertoIncidencias") {
    $datos = $incidencia->TotalIncidenciasAbierto();
    foreach ($datos as $row) {
        $json[] = array(
           'total'=>$row->total
        );    
    }
    echo json_encode($json);
}

if ($_POST["funcion"] == "totalCerradoIncidencias") {
    $datos = $incidencia->TotalIncidenciasCerrado();
    foreach ($datos as $row) {
        $json[] = array(
           'total'=>$row->total
        );    
    }
    echo json_encode($json);
}


if ($_POST["funcion"] == "AsignarUsuarioTicket") {
       
    $incidencia_id = $_POST["incidencia_id"];
    $usuario_asignar = $_POST["usuario_asignar"];

    $datos = $incidencia->AsignarUsuarioTicket($incidencia_id, $usuario_asignar);
    foreach ($datos as $row) {
        $json[] = array(
           'estaEditado'=>$row->estaEditado,
           'ok'=>$row->ok
        );    
    }
  
    echo json_encode($datos);
   
}


if ($_POST["funcion"] == "buscar") {
    
    $incidencia->buscar();
    $json = array();
    foreach ($incidencia->objetos as $objeto) {

        $json[] = array(
            'id'=>$objeto->id,
            'nombre_incidencia'=>$objeto->titulo
        );

    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

}


if ($_POST["funcion"] == "grafica") {
    

    $datos = $incidencia->graficaIncidenciasPorSucursales();
    $data = array();
    foreach ($datos as $row) {
        $subArray = array();
        $subArray[] = $row->total_incidencias;
        $subArray[] = $row->sucursales;
        $data[] = $subArray;
    }

    echo json_encode($data);

}



?>
































