<?php
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Productos, Cesta, Util};

Util::verificaConfiguracion();
Util::verificaSesion();
Util::addProductoCesta();
Util::eliminaProductoCesta();

$views = '../views';
$cache = '../cache';
$encabezado = "Productos";
$titulo = "Listado de productos";
$usuario = $_SESSION['nombre'];
$productos = Util::ordenaProductos();
$cantidad = 0;
$totalCesta = 0;

if(isset($_SESSION['cesta'])) $totalCesta = Cesta::getTotalCesta($_SESSION['cesta']);

$blade = new Blade($views, $cache);
echo $blade->view()->make('vtienda', compact('encabezado', 'titulo', 'productos', 'usuario', 'totalCesta'))->render();