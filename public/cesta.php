<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Productos, Cesta, Pedidos, Util, UtilCesta};

Util::verificaConfiguracion();
Util::verificaSesion();
UtilCesta::vaciarCesta();
UtilCesta::realizarCompra();
$views = '../views';
$cache = '../cache';
$encabezado = "Cesta";
$usuario = $_SESSION['nombre'];
$titulo = "Cesta";
$blade = new Blade($views, $cache);
$carrito = UtilCesta::$carrito;
$total = UtilCesta::$total;
$productos = (new Productos())->getProductos("nombre");
$totalCesta = UtilCesta::contadorCesta();
UtilCesta::totalesCesta();
$carrito = UtilCesta::$carrito;
$total = UtilCesta::$total;

echo $blade->view()->make('vcesta', compact('encabezado', 'titulo', 'productos', 'usuario','carrito', 'total', 'totalCesta'))->render();