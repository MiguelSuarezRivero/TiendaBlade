<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Util, Usuario};

Util::verificaConfiguracion();
Util::verificaSesion();


$usuario = $_SESSION['nombre'];
$views = '../views';
$cache = '../cache';
$encabezado = "Administrar pedidos";
$blade = new Blade($views, $cache);

echo $blade->view()->make('vadministrarpedidos', compact('encabezado', 'usuario'))->render();