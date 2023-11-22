<?php
require '../vendor/autoload.php';
use Philo\Blade\Blade;

if (file_exists('../src/configuracion.php')) {
    header('Location: acceso.php');
}

if(isset($_POST['configurar'])){
    header("Location: configurar.php");
}

$views = '../views';
$cache = '../cache';
$encabezado = "Instalador";
$titulo = "Instalador";

$blade = new Blade($views, $cache);
echo $blade->view()->make('vinstalador', compact('encabezado', 'titulo'))->render();