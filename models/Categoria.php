<?php
require_once '../config/conexion.php';

class Categoria extends Conexion {

    var $objetos;
    var $acceso;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    public function get_Categoria(){
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;

    }

    public function crearCategoria($nombreCategoria, $estado){
        $sql = "INSERT INTO categorias(nombre, estado) VALUES (:nombre, :estado)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombreCategoria, ':estado'=>$estado));
        echo 'add';
    }

    public function eliminarCategoria($categoria_id, $estado){
        $sql = "UPDATE categorias SET estado = :estado WHERE id = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$categoria_id, ':estado'=>$estado));
        echo 'delete';
    }

    public function obtenerCategoriaxId($categoria_id){
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$categoria_id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
   
    public function editarCategoria($nombreCategoria, $categoria_id){
        $sql = "UPDATE categorias SET nombre = :nombre  WHERE id = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombreCategoria, ':id'=>$categoria_id));
        echo 'editado';
    }
    








}