<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\Productos;
use MisClases\Cesta;
use MisClases\Util;

Util::verificaSesion();

$views = '../views';
$cache = '../cache';
$encabezado = "Detalle del producto";
$usuario = $_SESSION['nombre'];
$titulo = "Detalle producto";
$blade = new Blade($views, $cache);
$totalCesta = Util::contadorCesta();
$producto = (new Productos())->getProducto($_GET['id']);

echo $blade->view()->make('vdetalle', compact('encabezado', 'titulo', 'producto', 'usuario', "totalCesta"))->render();