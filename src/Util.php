<?php
namespace MisClases;
require_once '../vendor/autoload.php';

class Util{

  public static function verificaConfiguracion(){
   
    if (!file_exists('../src/Configuracion.php')){
      header("Location: index.php");
    }
  }

  public static function verificaSesion(){

    if(!isset($_SESSION['nombre'])){
      header("Location: index.php");
    } 

    if(isset($_POST['cerrar_sesion'])){
      unset($_SESSION['cerrar_sesion']);
      unset($_SESSION['nombre']);
      header("Location: index.php");
    } 
  } 

  public static function addProductoCesta(){

    if(isset($_POST['add'])){
      $cantidad = $_SESSION['cesta'][$_POST['id']];
       $cantidad++;
       $_SESSION['cesta'][$_POST['id']]= $cantidad;    
   
   }
}

  public static function eliminaProductoCesta(){
   
   if(isset($_POST['remove'])){
       $cantidad = $_SESSION['cesta'][$_POST['id']];
       if($cantidad>0){
           $cantidad--;
           $_SESSION['cesta'][$_POST['id']]= $cantidad;  
       }
          
    }
  }

  public static function ordenaProductos(){
      if(isset($_GET['order'])){
        switch($_GET['order']){
            case 'nombre':
                $productos = (new Productos())->getProductos("nombre");
                break;
            case 'familia':
                $productos = (new Productos())->getProductos("familia");
                break;
            case 'pvp':
                $productos = (new Productos())->getProductos("pvp");
                break;
            case 'unidades':
                $productos = (new Productos())->getProductos("unidades");
                break;
            default:
                $productos = (new Productos())->getProductos("nombre");
        }
        return $productos;
    }else{
       return $productos = (new Productos())->getProductos("nombre");
    }
  }

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

  public static function contadorCesta(){
    if(isset($_SESSION['cesta'])){
      return Cesta::getTotalCesta($_SESSION['cesta']);
    }else{

    } return 0;
  }
}
