<?php
require '../vendor/autoload.php';
use Philo\Blade\Blade;

if (file_exists('../src/configuracion.php')) {
    header('Location: acceso.php');
}

$views = '../views';
$cache = '../cache';
$encabezado = "Configurar instalación";
$titulo = "Configurar instalación";

$blade = new Blade($views, $cache);
echo $blade->view()->make('vconfigurar', compact('encabezado', 'titulo'))->render();