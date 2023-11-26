<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Cesta, Pedidos, Util, UtilCesta};

Util::verificaConfiguracion();
Util::verificaSesion();

$views = '../views';
$cache = '../cache';
$encabezado = "Mis pedidos";
$usuario = $_SESSION['nombre'];
$titulo = "Mis pedidos";
$blade = new Blade($views, $cache);
$carrito = UtilCesta::$carrito;
$total = UtilCesta::$total;
$totalCesta = UtilCesta::contadorCesta();
$pedidos = Pedidos::mostrarPedidos($_SESSION['nombre']);
UtilCesta::totalesCesta();
$carrito = UtilCesta::$carrito;
$total = UtilCesta::$total;


echo $blade->view()->make('vpedidos', compact('encabezado', 'titulo', 'usuario','carrito', 'total', 'totalCesta', 'pedidos'))->render();