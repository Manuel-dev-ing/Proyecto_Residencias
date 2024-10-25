<?php 
require_once '../config/conexion.php';



class Documento extends Conexion 
{
    var $objetos;
    var $acceso;

    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;   
    }

    public function CrearDocumento($incidencia_id, $documento_nombre){
        $sql = "INSERT INTO documentos(incidencia_id, nombre, fecha_creacion, estado) VALUES (:incidencia_id, :documento_nombre, :fecha_creacion, :estado)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':incidencia_id'=>$incidencia_id, ':documento_nombre'=>$documento_nombre, ':fecha_creacion'=>date("Y-m-d"), ':estado'=>1));
        echo 'add';
    }

    public function obtener_documento_por_incidencia($incidencia_id){
        $sql = "SELECT * FROM documentos WHERE incidencia_id = :incidencia_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':incidencia_id'=>$incidencia_id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;

    }


}














?>