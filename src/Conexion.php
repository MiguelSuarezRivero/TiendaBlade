<?php 
namespace MisClases;
require_once '../vendor/autoload.php';
use PDO;
use PDOException;

// Creamos la clase Conexión que será la encargada de realizar la conexión con la BBDD.
class Conexion{
     private $host;
     private $db;
     private $user;
     private $pass;
     private $dsn;
     protected $conexion;
 
     // Llamamos al método constructor con los datos de nuestra BBDD
     public function __construct(){
         $this->host = Configuracion::HOST_BBDD;   
         $this->db = Configuracion::NOMBRE_BBDD;
         $this->user = Configuracion::NOMBRE_USUARIO;
         $this->pass = Configuracion::PASSWORD;
         $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
     }
 
     // Método que crea la conexión.
     public function crearConexion(){
         try {
             $this->conexion = new PDO($this->dsn, $this->user, $this->pass);
             $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch (PDOException $ex) {
             die("Error en la conexión: mensaje: " . $ex->getMessage());
         }
         return $this->conexion;
     }
 }