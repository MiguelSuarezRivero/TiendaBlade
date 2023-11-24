<?php
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\Usuario;
use MisClases\Util;

Util::verificaConfiguracion();

if(isset($_POST['registrar'])){
    $estado = (new Usuario())->crearUsuario($_POST["nombre"],$_POST["pass"],1);
    if($estado==0){
        $_SESSION['error'] = "Ya existe un usuario con el mismo nombre";
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