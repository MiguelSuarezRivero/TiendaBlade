<?php
namespace MisClases;
require_once '../vendor/autoload.php';

class UtilCesta{

   static $carrito = array();
   static $total = 0;
   
  public static function vaciarCesta(){
    if(isset($_POST['vaciar'])){
      unset($_SESSION['cesta']);
    } 
  }

  public static function realizarCompra(){
    if(isset($_POST['comprar'])){
      Pedidos::crearPedido($_SESSION['nombre'], $_SESSION['cesta']);
      unset($_SESSION['cesta']);
      header("Location: tienda.php");
    } 
  }

  public static function totalesCesta(){

    if(isset($_SESSION['cesta'])){
        self::$carrito = Cesta::getCesta($_SESSION['cesta']);
        self::$total = Cesta::getImporteTotal($_SESSION['cesta']);
      }      
  }

  public static function contadorCesta(){
    if(isset($_SESSION['cesta'])){
      return Cesta::getTotalCesta($_SESSION['cesta']);
    }else{

    } return 0;
  }

}