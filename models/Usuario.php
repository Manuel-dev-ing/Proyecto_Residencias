<?php
include_once '../config/conexion.php';

class Usuario
{

    var $objetos;
    var $acceso;

    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    public function Loguearse($correo){
        $sql = "SELECT * FROM usuarios WHERE correo = :correo";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':correo' => $correo));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function Crear_Usuario($usuario_nombre, $usuario_apellidos, $usuario_password, $usuario_correo, $rol_id, $sucursal)
    {
        $sql = "INSERT INTO usuarios (rol_id, sucursal_id, nombre, apellidos, password, correo, fecha_creacion, fecha_modificacion, fecha_eliminacion, estado) VALUES (:rol_id, :sucursal_id, :nombre, :apellidos, :pass, :correo, :fecha_creacion, :fecha_modificacion, :fecha_eliminacion, :estado)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $usuario_nombre, ':apellidos' => $usuario_apellidos, ':correo' => $usuario_correo, ':pass' => password_hash($usuario_password, PASSWORD_BCRYPT) , ':rol_id' => $rol_id, ':sucursal_id' => $sucursal, ':fecha_creacion' => date("Y-m-d"), ':fecha_modificacion' => NULL, ':fecha_eliminacion' => NULL, ':estado' => 1));
        echo 'creado';
    }

    public function Actualizar_Usuario($usuario_id, $usuario_nombre, $usuario_apellidos, $usuario_password, $usuario_correo, $rol_id, $sucursal_id, $fecha_modificacion)
    {
        $sql = "UPDATE usuarios
                SET rol_id = :rol_id, sucursal_id = :sucursal_id, nombre = :usuario_nombre, apellidos = :usuario_apellidos, password = :pass, correo = :usuario_correo, fecha_modificacion = :fecha_modificacion WHERE id = :usuario_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_nombre' => $usuario_nombre, ':usuario_apellidos' => $usuario_apellidos, ':usuario_correo' => $usuario_correo, ':pass' => $usuario_password, ':rol_id' => $rol_id, ':usuario_id' => $usuario_id, ':fecha_modificacion' => $fecha_modificacion, ':sucursal_id'=>$sucursal_id));
        echo 'editado';
    }

    public function Eliminar_Usuario($usuario_id, $estado, $fecha_eliminacion)
    {
        $sql = "UPDATE usuarios
                SET
                fecha_eliminacion = :fecha_eliminacion,
                estado = :estado
                WHERE id = :usuario_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id' => $usuario_id, ':estado'=>$estado, ':fecha_eliminacion'=>$fecha_eliminacion));
        echo 'delete';
    }

    public function Obtener_Usuarios()
    {
        $sql = "SELECT usuarios.id, usuarios.nombre, usuarios.apellidos, usuarios.correo, rol.id as rol_id, 
                sucursales.nombre as sucursal
                FROM usuarios 
                INNER JOIN rol ON rol.id = usuarios.rol_id
                INNER JOIN sucursales ON sucursales.id = usuarios.sucursal_id 
                WHERE usuarios.estado = 1";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function Obtener_Usuarios_x_id($usuario_id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :usuario_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id' => $usuario_id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function Incidencias_x_Usuario($usuario_id)
    {
        $sql = "SELECT count(*) as total FROM incidencias WHERE usuario_id = :usuario_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id' => $usuario_id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function Incidencias_x_UsuarioAbierto($usuario_id)
    {
        $sql = "SELECT count(*) as total FROM incidencias WHERE usuario_id = :usuario_id AND estado_incidencia = 'Abierto'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id' => $usuario_id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function Incidencias_x_UsuarioCerrado($usuario_id)
    {
        $sql = "SELECT count(*) as total FROM incidencias WHERE usuario_id = :usuario_id AND estado_incidencia = 'Cerrado'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usuario_id' => $usuario_id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function LlenarRol()
    {
        $sql = "SELECT * FROM rol";
        $query = $this->acceso->prepare($sql);
        $query->execute(array());
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function LlenarSelectSucursal()
    {
        $sql = "SELECT * FROM sucursales";
        $query = $this->acceso->prepare($sql);
        $query->execute(array());
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function ObtenerUsuariosPorRol()
    {
        $sql = "SELECT * FROM usuarios WHERE rol_id = 1";
        $query = $this->acceso->prepare($sql);
        $query->execute(array());
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
}
