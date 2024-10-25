<?php 
require_once '../config/conexion.php';

class Sucursal extends Conexion{
    var $objetos;
    var $acceso;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }


    public function obtenerSucursal(){
        $sql = "SELECT * FROM sucursales WHERE estado=1";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function crearSucursal($nombre, $direccion, $ciudad, $telefono, $estado){
        $sql = "INSERT INTO sucursales(nombre, direccion, ciudad, telefono, fecha_creacion, estado) VALUES (:nombre, :direccion, :ciudad, :telefono, :fecha_creacion, :estado)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':direccion'=>$direccion,':ciudad'=>$ciudad,':telefono'=>$telefono,':fecha_creacion'=>date("Y-m-d"), ':estado'=>$estado));
        echo 'creado';
    }

    public function eliminarSucursal($id_sucursal){
        $sql = "UPDATE sucursales
                SET estado = 0
                WHERE id = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_sucursal));
        echo 'delete';
    }

    public function obtenerSucursalxId($id){
        $sql = "SELECT * FROM sucursales WHERE id=:id;";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;

    }

    public function editarSucursal($nombre, $direccion, $ciudad, $telefono, $id, $estado){
        $sql = "UPDATE sucursales
                SET nombre = :nombre, direccion = :direccion, ciudad = :ciudad, telefono = :telefono, fecha_creacion = :fecha_creacion, estado = :estado
                WHERE id = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre, ':direccion'=>$direccion, ':ciudad'=>$ciudad, ':telefono'=>$telefono, ':id'=>$id, ':fecha_creacion'=>date("Y-m-d"), ':estado'=>$estado));
        echo 'editado';  
    }

}














?>