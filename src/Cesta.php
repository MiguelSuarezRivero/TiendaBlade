<?php
namespace MisClases;
require_once '../vendor/autoload.php';

class Cesta{

    public static function getCesta($sesionCesta){

        $carrito = array();

        if(isset($sesionCesta)){
            foreach($sesionCesta as $idProducto => $cantidad){
                if($cantidad !=0){
                  $producto = (new Productos())->getProducto($idProducto);
                  $carrito[$idProducto]['qr']= Productos::generarCodigoQR($idProducto);
                  $carrito[$idProducto]['nombre']= $producto[0]->nombre;
                  $carrito[$idProducto]['familia']= $producto[0]->familia;
                  $carrito[$idProducto]['cantidad']= $cantidad;
                  $carrito[$idProducto]['pvp']= $producto[0]->pvp;
                  $carrito[$idProducto]['total']= number_format($producto[0]->pvp * $cantidad, 2, ',', '.');
                }
              }    
              return $carrito;
        }else{
            return $carrito;
        }
          
    }

    public static function getImporteTotal($sesionCesta){
        
        $total = 0;        
        foreach($sesionCesta as $idProducto => $cantidad){
          if($cantidad !=0){
            $producto = (new Productos())->getProducto($idProducto);
            $total+= $producto[0]->pvp * $cantidad;
          }
        }

        return number_format($total, 2, ',', '.');
  }

  public static function getTotalCesta($sesionCesta){

    $totalCesta = 0;
    foreach($sesionCesta as $idProducto => $cantidad){     
        $totalCesta+= $cantidad;
      }         
    return $totalCesta;
  }
}