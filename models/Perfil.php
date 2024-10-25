<?php 

require_once '../config/conexion.php';


class Perfil extends Conexion{

    var $objetos;
    var $acceso;

    public function __construct() {
        $db = new Conexion();

        $this->acceso = $db->pdo;
    }


    public function obtenerPerfilxId($usuario_id){
        $sql = "SELECT id, nombre, apellidos, correo, edad, telefono, direccion, genero 
                FROM usuarios 
                WHERE id = :usuario_id AND estado = 1";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id'=>$usuario_id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function editarPerfil($nombre_usuario, $apellido_usuario, $correo_usuario, $edad_usuario, $telefono_usuario, $direccion_usuario, $genero_usuario, $id_user){
        $sql = "UPDATE usuarios
                SET nombre = :usuario_nombre, 
                apellidos = :usuario_apellidos, 
                correo = :usuario_correo, 
                edad = :edad, 
                telefono = :telefono, 
                direccion = :direccion, 
                genero = :genero, 
                fecha_modificacion = :fecha_modificacion WHERE id = :usuario_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_nombre'=>$nombre_usuario, ':usuario_apellidos'=>$apellido_usuario, ':usuario_correo'=>$correo_usuario, ':edad'=>$edad_usuario, ':telefono'=>$telefono_usuario,':direccion'=>$direccion_usuario, ':genero'=>$genero_usuario, ':usuario_id'=>$id_user, ':fecha_modificacion'=>date('Y-m-d')));
        echo 'editado';
    }

    public function verficarContrasena($idUsuario, $contrasenaActual){

        $sql = "SELECT * FROM usuarios WHERE id = :usuario_id AND password = :contrasena";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id'=>$idUsuario, ':contrasena'=>$contrasenaActual));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }


    public function cambiarContrasena($nuevaContrasena, $id_usuario){
        $sql = "UPDATE usuarios SET password = :contrasena WHERE id = :usuario_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id'=>$id_usuario, ':contrasena'=>$nuevaContrasena));
        echo 'ContrasenaCambiada';
    }

}

?>

