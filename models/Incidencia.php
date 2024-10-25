<?php 
require_once '../config/conexion.php';

class Incidencia extends Conexion {

    var $objetos;
    var $acceso;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }


    public function buscar(){
            
        if (!empty($_POST['valor'])) {
            
            $consulta = $_POST['valor'];
            
            $sql = "SELECT id, titulo FROM incidencias WHERE titulo LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(":consulta"=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            return;
        }
    }

    function CrearIncidencia($usuario_id, $categoria_id, $prioridad_id, $incidencia_titulo, $incidencia_descripcion){
        $sql = "INSERT INTO incidencias
                (usuario_id, categoria_id, prioridad_id, titulo, descripcion, estado_incidencia, fecha_creacion, estado) 
                VALUES (:usuario_id, :categoria_id, :prioridad_id, :titulo, :descripcion, :estado_incidencia, :fecha_creacion, :estado)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id'=>$usuario_id, ':categoria_id'=>$categoria_id, ':prioridad_id'=> $prioridad_id, ':titulo'=>$incidencia_titulo, ':descripcion'=>$incidencia_descripcion, ':estado_incidencia'=>'Abierto', ':fecha_creacion'=>date("Y-m-d"), ':estado'=>1)); 
        
        // echo "<pre>";
        // var_dump($query);
        // echo "</pre>";
        // exit;

        $sql1 = "SELECT last_insert_id() AS 'incidencia_id';";
        $sql1= $this->acceso->prepare($sql1);
        $sql1->execute(); 
        $this->objetos=$sql1->fetchAll();
        return $this->objetos;
        echo 'add';   

    }


    public function Listar_incidencia_x_usuario($usuario_id){
        $sql = "SELECT incidencias.id, categorias.nombre as categoria, incidencias.titulo, incidencias.prioridad_id,
        incidencias.estado_incidencia,
        fecha_creacion, fecha_asignacion, usuarios_asignado 
        FROM incidencias
        INNER JOIN categorias ON incidencias.categoria_id = categorias.id
        WHERE incidencias.estado = 1 AND incidencias.usuario_id = :usuario_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id'=>$usuario_id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;

    }
    
    public function Listar_incidencia(){
        $sql = "SELECT incidencias.id, 
                CONCAT(usuarios.nombre,' ', usuarios.apellidos) as usuario, 
                sucursales.nombre as sucursal, 
                categorias.nombre as categoria, 
                incidencias.titulo, 
                incidencias.prioridad_id,
                incidencias.estado_incidencia,
                incidencias.fecha_creacion, 
                incidencias.fecha_asignacion, 
                incidencias.usuarios_asignado 
        FROM incidencias
        INNER JOIN categorias ON incidencias.categoria_id = categorias.id
        INNER JOIN usuarios ON usuarios.id = incidencias.usuario_id
        INNER JOIN sucursales ON usuarios.sucursal_id = sucursales.id
        WHERE incidencias.estado = 1";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;

    }

    public function Listar_incidenciaDetalle_x_incidencia($incidencia_id){
        $sql = "SELECT detalle_incidencia.id, detalle_incidencia.incidencia_id,
                detalle_incidencia.usuario_id, detalle_incidencia.descripcion, 
                detalle_incidencia.fecha_creacion, detalle_incidencia.estado,
                usuarios.rol_id, usuarios.nombre, usuarios.apellidos
                FROM detalle_incidencia
                INNER JOIN usuarios ON usuarios.id = detalle_incidencia.usuario_id
                WHERE detalle_incidencia.incidencia_id = :incidencia_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':incidencia_id'=>$incidencia_id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }

    public function Listar_incidencia_x_id($incidencia_id){
      
        $sql = "SELECT
                incidencias.id,
                usuarios.nombre as nombreUsuario,
                usuarios.apellidos as nombreApellidos,
                categorias.nombre as categoria,
                prioridad.nombre as prioridad,
                incidencias.titulo,
                incidencias.descripcion,
                incidencias.estado_incidencia,
                incidencias.fecha_creacion
                FROM incidencias
                INNER JOIN categorias ON categorias.id = incidencias.categoria_id
                INNER JOIN usuarios ON usuarios.id = incidencias.usuario_id
                INNER JOIN prioridad ON prioridad.id = incidencias.prioridad_id
                WHERE incidencias.estado = 1 AND incidencias.id = :incidencia_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':incidencia_id'=>$incidencia_id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }

    function Insertar_ticketDetalle($incidencia_id, $usuario_id, $incidencia_descripcion){
        $sql = "INSERT INTO detalle_incidencia (incidencia_id, usuario_id, descripcion, fecha_creacion, estado) VALUES (:incidencia_id, :usuario_id, :descripcion, :fecha_creacion, :estado)";
        $query = $this->acceso->prepare($sql);
     
        $query->execute(array(':incidencia_id'=>$incidencia_id, ':usuario_id'=>$usuario_id, ':descripcion'=>$incidencia_descripcion, ':fecha_creacion'=>date("Y-m-d H:i:s"), ':estado'=>1));
       
        echo 'add';   
    }

    function Insertar_ticketDetalleCerrado($incidencia_id, $usuario_id){
        $sql = "INSERT INTO detalle_incidencia (incidencia_id, usuario_id, descripcion, fecha_creacion, estado) VALUES (:incidencia_id, :usuario_id, :descripcion, :fecha_creacion, :estado)";;
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':incidencia_id'=>$incidencia_id, ':usuario_id'=>$usuario_id, ':descripcion'=>'Incidencia Cerrada', ':fecha_creacion'=>date("Y-m-d H:i:s"), ':estado'=>1));
        echo 'Cerrado';   
    }

    function Actualizar_Estado_Incidencia($incidencia_id){
        $sql = "UPDATE incidencias SET estado_incidencia = 'Cerrado' WHERE id = :incidencia_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':incidencia_id'=>$incidencia_id));
        echo 'Editado';   
    }

    public function TotalIncidencias(){
        $sql = "SELECT count(*) as total FROM incidencias;";
        $query = $this->acceso->prepare($sql);
        $query->execute(array());
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function TotalIncidenciasAbierto(){
        $sql = "SELECT count(*) as total FROM incidencias WHERE estado_incidencia = 'Abierto'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array());
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function TotalIncidenciasCerrado(){
        $sql = "SELECT count(*) as total FROM incidencias WHERE estado_incidencia = 'Cerrado'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array());
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function AsignarUsuarioTicket($incidencia_id, $usuario_asignado){
        $sql = "UPDATE incidencias SET fecha_asignacion=:fecha_asignacion, usuarios_asignado=:usuario_asignado WHERE id = :incidencia_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_asignado'=>$usuario_asignado, ':incidencia_id'=>$incidencia_id, ':fecha_asignacion'=>date("Y-m-d")));
        $ok = array('estaEditado'=>true, 'ok'=>"ok");
        $this->objetos = $ok;
        return $this->objetos;
        
    }

    public function graficaIncidenciasPorSucursales(){
        $sql = "SELECT sucursales.nombre as sucursales, COUNT(incidencias.id) as total_incidencias
                FROM incidencias
                INNER JOIN usuarios ON incidencias.usuario_id = usuarios.id
                INNER JOIN sucursales ON usuarios.sucursal_id = sucursales.id
                GROUP BY sucursales";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }


}


?>