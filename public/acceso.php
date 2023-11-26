<?php
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Usuario, Util, UtilAcceso};

Util::verificaConfiguracion();
UtilAcceso::gestionaAcceso();

$views = '../views';
$cache = '../cache';
$encabezado = "Panel de acceso a la tienda";
$titulo = "Panel de acceso a la tienda";
$blade = new Blade($views, $cache);
echo $blade->view()->make('vacceso', compact('encabezado', 'titulo'))->render();