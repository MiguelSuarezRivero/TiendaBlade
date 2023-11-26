<?php
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Productos, Util};

Util::verificaConfiguracion();
Util::verificaSesion();

$views = '../views';
$cache = '../cache';
$encabezado = "Administrador";
$titulo = "Administrador";
$usuario = $_SESSION['nombre'];

$blade = new Blade($views, $cache);
echo $blade->view()->make('vadministrador', compact('encabezado', 'titulo',  'usuario'))->render();