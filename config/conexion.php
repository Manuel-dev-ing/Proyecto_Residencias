<?php

class Conexion {
    
    private $servidor = "localhost";
    private $db = "proyectoresidencias";
    private $puerto = 3306;
    private $charset = "utf8";
    private $usuario = "root";
    private $contrasena = "admin";

    public $pdo = null;
    private $atributos = [PDO::ATTR_CASE=>PDO::CASE_LOWER, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];


    public function __construct() {
        $this->pdo = new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}", $this->usuario, $this->contrasena, $this->atributos);
           
    }


    // protected function ConexionBD(){
    //     try {

    //         $this->pdo = new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}", $this->usuario, $this->contrasena, $this->atributos);
    //         return $this->pdo;

    //     } catch (Exception $e) {
    //         print "!Error al Conectar" . $e->getMessage() . "</br>";
    //         die();
    //     }
    // }


    // function __construct(){
    //     $this->pdo = new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}", $this->usuario, $this->contrasena, $this->atributos);
        
    // }



}



?>