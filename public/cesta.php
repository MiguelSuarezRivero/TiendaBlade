<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\Productos;
use MisClases\Cesta;
use MisClases\Pedidos;
use MisClases\Util;

Util::verificaConfiguracion();
Util::verificaSesion();
Util::vaciarCesta();
Util::realizarCompra();

$views = '../views';
$cache = '../cache';
$encabezado = "Cesta";
$usuario = $_SESSION['nombre'];
$titulo = "Cesta";
$blade = new Blade($views, $cache);
$carrito = array();
$total = 0;
$productos = (new Productos())->getProductos("nombre");
$totalCesta = Util::contadorCesta();

if(isset($_SESSION['cesta'])){
  $carrito = Cesta::getCesta($_SESSION['cesta']);
  $total = Cesta::getImporteTotal($_SESSION['cesta']);
}


echo $blade->view()->make('vcesta', compact('encabezado', 'titulo', 'productos', 'usuario','carrito', 'total', 'totalCesta'))->render();