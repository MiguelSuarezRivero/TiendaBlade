<?php
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Util, Correos};

Util::verificaConfiguracion();
Correos::enviaCorreoRecuperacion();

$views = '../views';
$cache = '../cache';
$encabezado = "Recuperar acceso";
$titulo = "Recuperar acceso";
$blade = new Blade($views, $cache);
echo $blade->view()->make('vrecuperar', compact('encabezado', 'titulo'))->render();