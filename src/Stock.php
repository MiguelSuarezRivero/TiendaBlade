<?php
namespace MisClases;
require_once '../vendor/autoload.php';
use PDO;
use PDOException;

class Stock{

    public static function getStock($id){

        $conexion = (new Conexion())->crearConexion();
        $sql = $conexion->prepare("SELECT SUM(unidades) FROM `stocks` WHERE producto =:id"); 
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        $conexion=null;
        return $resultado['SUM(unidades)'];

    }

    public static function getStockGeneral(){

        $conexion = (new Conexion())->crearConexion();
        $sql = $conexion->prepare("SELECT productos.nombre AS nombre, SUM(unidades) AS stock FROM stocks INNER JOIN productos ON stocks.producto=productos.id GROUP by productos.nombre"); 
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        $conexion=null;
        return $resultado;
    }
}