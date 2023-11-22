<?php
namespace MisClases;
require_once '../vendor/autoload.php';
use PDO;
use PDOException;

class Pedidos{

    public static function crearPedido($nom, $cesta){
        $conexion = (new Conexion())->crearConexion();
        $sql = $conexion->prepare("INSERT INTO pedidos(cliente, fecha) VALUES (:usuario, NOW())"); 
        $sql->bindParam(':usuario', $nom, PDO::PARAM_STR);
        $sql->execute();

        $sql = $conexion->prepare("SELECT MAX(id_pedido) AS id_pedido FROM pedidos"); 
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        $id_pedido = $resultado['id_pedido'];

        foreach($cesta as $id_producto => $cantidad){
            if($cantidad !=0){
                $sql = $conexion->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)"); 
                $sql->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $sql->bindParam(':id_producto',  $id_producto, PDO::PARAM_INT);
                $sql->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $sql->execute();
            }
        }
    
        if(isset($_SESSION['nombre'])){
            if($_SESSION['nombre'] != 'cliente'){
                Pedidos::actualizaStock($cesta);
            }
        }
        

        $conexion=null;

    }

    public static function actualizaStock($cesta){
        $conexion = (new Conexion())->crearConexion();
        foreach($cesta as $id_producto => $cantidad){
            for ($i = 0; $i < $cantidad; $i++) {
                $sql = $conexion->prepare("SELECT tienda, unidades FROM `stocks` WHERE unidades>0 AND producto = :id_producto");
                $sql->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $sql->execute();
                $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                $tienda = $resultado['tienda'];
                $unidades= $resultado['unidades'] -1;
                $sql = $conexion->prepare("UPDATE stocks SET unidades=:unidades WHERE tienda=:id_tienda and producto=:id_producto");
                $sql->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $sql->bindParam(':id_tienda', $tienda, PDO::PARAM_INT);
                $sql->bindParam(':unidades', $unidades, PDO::PARAM_INT);
                $sql->execute();
            }
        }

        $conexion=null;
    }

    public static function mostrarPedidos($usuario){
        $conexion = (new Conexion())->crearConexion();
        $sql = $conexion->prepare("SELECT pedidos.id_pedido AS pedido, pedidos.fecha AS fecha, productos.nombre AS producto, productos.pvp AS precio, detalle_pedido.cantidad AS cantidad 
                                   FROM usuarios 
                                   INNER JOIN pedidos ON usuarios.nombre= pedidos.cliente 
                                   INNER JOIN detalle_pedido ON pedidos.id_pedido = detalle_pedido.id_pedido 
                                   INNER JOIN productos ON detalle_pedido.id_producto = productos.id
                                   WHERE usuarios.nombre = :usuario"); 
        $sql->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);  
        $conexion=null;
    }
    // 

}