<?php
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Usuario, Util};

Util::verificaConfiguracion();

if(isset($_POST['registrar'])){
    $estado = (new Usuario())->crearUsuario($_POST["nombre"],$_POST["pass"],1,$_POST['email']);
    if($estado==0){
        $_SESSION['error'] = "El usuario ya existe.";
    }else{
        header("Location: index.php");
    }
}

$views = '../views';
$cache = '../cache';
$encabezado = "Registro";
$titulo = "Registro";
$blade = new Blade($views, $cache);
echo $blade->view()->make('vregistro', compact('encabezado', 'titulo'))->render();