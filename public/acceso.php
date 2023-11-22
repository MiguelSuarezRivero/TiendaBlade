<?php
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\Usuario;

if(isset($_POST['login'])){
    switch ((new Usuario)->verificaUsuario($_POST['nombre'],$_POST['pass'])) {
        case 0:
            $_SESSION['nombre'] = $_POST['nombre'];
            header("Location: administrador.php");
            break;
        case 1:
            $_SESSION['nombre'] = $_POST['nombre'];
            header("Location: tienda.php");
            break;
        
        default:
            unset( $_SESSION['nombre']);
            $_SESSION['error'] = "Los datos introducidos no son correctos";
            break;
    }
}

$views = '../views';
$cache = '../cache';
$encabezado = "Panel de acceso a la tienda";
$titulo = "Panel de acceso a la tienda";
$blade = new Blade($views, $cache);
echo $blade->view()->make('vacceso', compact('encabezado', 'titulo'))->render();