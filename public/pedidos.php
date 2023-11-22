<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\Cesta;
use MisClases\Pedidos;
use MisClases\Util;

Util::verificaSesion();

$views = '../views';
$cache = '../cache';
$encabezado = "Mis pedidos";
$usuario = $_SESSION['nombre'];
$titulo = "Mis pedidos";
$blade = new Blade($views, $cache);
$carrito = array();
$total = 0;
$totalCesta = Util::contadorCesta();
$pedidos = Pedidos::mostrarPedidos($_SESSION['nombre']);

if(isset($_SESSION['cesta'])){
  $carrito = Cesta::getCesta($_SESSION['cesta']);
  $total = Cesta::getImporteTotal($_SESSION['cesta']);
}


echo $blade->view()->make('vpedidos', compact('encabezado', 'titulo', 'usuario','carrito', 'total', 'totalCesta', 'pedidos'))->render();