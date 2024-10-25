<?php
require_once '../config/conexion.php';

class Prioridad extends Conexion{
    
    var $objetos;
    var $acceso;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    public function obtenerPrioridad(){
        $sql = "SELECT * FROM prioridad WHERE estado = 1";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function crearPrioridad($nombre, $estado){
        $sql = "INSERT INTO prioridad (nombre, estado) VALUES (:nombre, :estado);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre, ':estado'=>$estado));
        echo 'add';
    }

    public function eliminarPrioridad($prioridad_id, $estado){
        $sql = "UPDATE prioridad SET estado = :estado WHERE id = :prioridad_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':prioridad_id'=>$prioridad_id, ':estado'=>$estado));
        echo 'delete';
    }

    public function obtenerPrioridadxId($id){

        $sql = "SELECT * FROM prioridad WHERE id = :prioridad_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':prioridad_id'=>$id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;

    }


    public function editarPrioridad($prioridad_nombre, $Proridad_id){
        $sql = "UPDATE prioridad SET nombre = :nombre WHERE id = :id;";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$prioridad_nombre, ':id'=>$Proridad_id));
        echo 'editado';  
    }


}




?>