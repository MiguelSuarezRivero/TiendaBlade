<?php
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Usuario, Util};

Util::restablecePassword();
$nombre = (new Usuario)->verificaUsuarioCorreo($_GET['cert']);
$views = '../views';
$cache = '../cache';
$titulo = "Restablecer contraseña";
$blade = new Blade($views, $cache);
echo $blade->view()->make('vrestablecer', compact('titulo','nombre'))->render();