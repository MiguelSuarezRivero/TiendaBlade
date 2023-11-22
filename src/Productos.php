<?php
namespace MisClases;
require_once '../vendor/autoload.php';
use PDO;
use PDOException;
use chillerlan\QRCode\QRCode;

class Productos extends Conexion{

    private $id;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $descripcion;
    private $familia;
    private $codeQR;

    public function __construct(){
        parent::__construct();
    }

    public function crearProducto($nom, $pass){

        $this->crearConexion();
        $sql = $this->conexion->prepare("INSERT INTO usuarios(usuario, pass) VALUES (:nombre, :pass)"); 
        $sql->bindParam(':nombre', $nom, PDO::PARAM_STR);
        $sql->bindParam(':pass', $hash_pass, PDO::PARAM_STR);
        $sql->execute();
        $this->conexion=null;

    }

    public function getProductos($campo){

        $this->crearConexion();
        $sql = $this->conexion->prepare("SELECT id, nombre, pvp, familia, SUM(stocks.unidades) AS unidades FROM productos INNER JOIN stocks ON id = producto GROUP BY id ORDER BY " . $campo); 
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);       
        $this->conexion=null;

    }

    public function getProducto($id){

        $this->crearConexion();
        $sql = $this->conexion->prepare("SELECT * FROM productos WHERE id = :id"); 
        $sql->bindParam(':id', $id, PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);       
        $this->conexion=null;

    }

    public static function generarCodigoQR($id) {
      $data = "http://localhost/proyectos/Curso%20DSW/TiendaBlade/public/tienda.php?id=$id";
      return '<img style="width:54px" src="'.(new QRCode)->render($data).'" alt="QR Code" />';

    }

}