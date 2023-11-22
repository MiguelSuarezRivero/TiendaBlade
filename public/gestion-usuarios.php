<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\Util;

Util::verificaSesion();

$views = '../views';
$cache = '../cache';
$encabezado = "Gestión de usuarios";
$usuario = $_SESSION['nombre'];
$titulo = "Gestión de usuarios";
$blade = new Blade($views, $cache);


echo $blade->view()->make('vusuarios', compact('encabezado', 'titulo', 'usuario'))->render();