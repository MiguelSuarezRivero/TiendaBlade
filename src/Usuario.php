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

    public function crearUsuario($nom, $pass, $rol){

        //$hash_pass = hash('sha256', $pass);   # MÉTODO SHA256 

        # METODO PHP
        $opciones = ['cost' => 10,];
        $hash_pass = password_hash($pass, PASSWORD_BCRYPT, $opciones);
        try {
            $this->crearConexion();
            $sql = $this->conexion->prepare("INSERT INTO usuarios(nombre, pass, rol) VALUES (:nombre, :pass, :rol)"); 
            $sql->bindParam(':nombre', $nom, PDO::PARAM_STR);
            $sql->bindParam(':pass', $hash_pass, PDO::PARAM_STR);
            $sql->bindParam(':rol', $rol, PDO::PARAM_INT);
            $sql->execute();
            return  $sql->rowCount();
        } catch (PDOException $ex) {
            return 0;
        }
       
        $this->conexion=null;

    }

    public function verificaUsuario($nom, $pass){

        $this->crearConexion();
        $sql = $this->conexion->prepare("SELECT pass, rol FROM usuarios WHERE nombre=:nombre"); 
        $sql->bindParam(':nombre', $nom, PDO::PARAM_STR);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

       
        if($resultado){
             // Existe el usuario.
            if (password_verify($pass, $resultado['pass'])) {
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

}