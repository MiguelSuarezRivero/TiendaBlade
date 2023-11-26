<?php
namespace MisClases;
require_once '../vendor/autoload.php';
use PDO;
use PDOException;

class Usuario extends Conexion{

    private $nombre;
    private $password;

    public function __construct(){
        parent::__construct();
    }

    public function crearUsuario($nom, $pass, $rol, $email){

        //$hash_pass = hash('sha256', $pass);   # MÉTODO SHA256 

        $opciones = ['cost' => 10,];
        $hash_pass = password_hash($pass, PASSWORD_BCRYPT, $opciones);
        try {
            $this->crearConexion();
            $sql = $this->conexion->prepare("INSERT INTO usuarios(nombre, pass, rol, activo, email) VALUES (:nombre, :pass, :rol, 1, :email)"); 
            $sql->bindParam(':nombre', $nom, PDO::PARAM_STR);
            $sql->bindParam(':pass', $hash_pass, PDO::PARAM_STR);
            $sql->bindParam(':rol', $rol, PDO::PARAM_INT);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->execute();
            $this->conexion=null;
            return  $sql->rowCount();
        } catch (PDOException $ex) {
            if($ex->getCode() == 23000){
                return 0;
            }
            die("Error en la conexión: mensaje: " . $ex->getMessage());
            $this->conexion=null;
            return 0;
        }      
    }

    public function restablecerPass($nom, $pass){

        $opciones = ['cost' => 10,];
        $hash_pass = password_hash($pass, PASSWORD_BCRYPT, $opciones);
        try {
            $this->crearConexion();
            $sql = $this->conexion->prepare("UPDATE usuarios SET pass=:pass WHERE nombre=:nombre"); 
            $sql->bindParam(':nombre', $nom, PDO::PARAM_STR);
            $sql->bindParam(':pass', $hash_pass, PDO::PARAM_STR);
            $sql->execute();
            $this->conexion=null;
            return  $sql->rowCount();
        } catch (PDOException $ex) {
            if($ex->getCode() == 23000){
                return 0;
            }
            die("Error en la conexión: mensaje: " . $ex->getMessage());
            $this->conexion=null;
            return 0;
        }      
    }

    public function eliminarUsuario($nom){

        try {
            $this->crearConexion();
            $sql = $this->conexion->prepare("DELETE FROM usuarios WHERE nombre=:nombre"); 
            $sql->bindParam(':nombre', $nom, PDO::PARAM_STR);
            $sql->execute();
            $this->conexion=null;
            return  $sql->rowCount();
        } catch (PDOException $ex) {
            $this->conexion=null;
            return 0;
        } 
    }

    public function verificaUsuarioCorreo($certificado){
        $this->crearConexion();
        $sql = $this->conexion->prepare("SELECT nombre FROM usuarios"); 
        $sql->execute();
        $resultado = $sql->fetchall(PDO::FETCH_ASSOC);
        foreach ($resultado as $item){
            if (password_verify($item['nombre'], $certificado)) {
                return $item['nombre'];
            }
        }
        return 0;
    }

    public function verificaUsuario($nom, $pass){

        $this->crearConexion();
        $sql = $this->conexion->prepare("SELECT pass, rol, activo FROM usuarios WHERE nombre=:nombre"); 
        $sql->bindParam(':nombre', $nom, PDO::PARAM_STR);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

       
        if($resultado){
             // Existe el usuario.
            if (password_verify($pass, $resultado['pass'])) {
                if($resultado['activo']==0){
                    return -1;
                }
                if($resultado['rol']==0){
                    return 0;
                }else{
                    return 1;
                }
                
            } else {
                // La contraseña es incorrecta.
                return -1;
            }
        }else{
             // No existe el usuario.
            return -1;
        }
        
        $this->conexion=null;

    }

    public function mostrarUsuarios(){
        $this->crearConexion();
        $sql = $this->conexion->prepare("SELECT nombre, rol, activo, email FROM usuarios ORDER BY rol"); 
        $sql->execute();
        $this->conexion = null;
        return $resultado = $sql->fetchall(PDO::FETCH_OBJ);
        
    }

    public function getEmail($nombre){
        $this->crearConexion();
        $sql = $this->conexion->prepare("SELECT email FROM usuarios WHERE nombre=:nombre"); 
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->execute();
        if($sql->rowCount() != 0){
            $this->conexion = null;
            return $resultado = $sql->fetchall(PDO::FETCH_OBJ);    
        }else{
            return 0;
        }       
            
    }

    public function actualizarUsuario($nombre, $email, $rol, $activo ){
        try {
            $this->crearConexion();
            $sql = $this->conexion->prepare("UPDATE usuarios SET nombre=:nombre, rol=:rol, activo=:activo, email=:email WHERE nombre=:nombre"); 
            $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':rol', $rol, PDO::PARAM_INT);
            $sql->bindParam(':activo', $activo, PDO::PARAM_INT);
            $sql->execute();
            $this->conexion=null;
            return  $sql->rowCount();
        } catch (PDOException $ex) {
            if($ex->getCode() == 23000){
                return 0;
            }
            die("Error en la conexión: mensaje: " . $ex->getMessage());
            $this->conexion=null;
            return 0;
        }      
    }

}