<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\{Util, Usuario};

Util::verificaConfiguracion();
Util::verificaSesion();

if(isset($_POST['guardar'])){
    $activo=(isset($_POST['activo']))?1:0;
    $modificar = (new Usuario)->actualizarUsuario($_POST['nombre'],$_POST['email'], $_POST['rol'], $activo);
    header("Location: usuarios.php");
}

if(isset($_POST['crear'])){
    $crear = (new Usuario)->crearUsuario($_POST['nombre'],$_POST['pass'],$_POST['rol'],$_POST['email']);
}

if(isset($_GET['eliminar'])){
    $eliminar = (new Usuario)->eliminarUsuario($_GET['eliminar']);
    if($eliminar==0){
        $_SESSION['error'] = true;
    }
}

$views = '../views';
$cache = '../cache';
$encabezado = "Gestión de usuarios";
$usuario = $_SESSION['nombre'];
$titulo = "Gestión de usuarios";
$blade = new Blade($views, $cache);
$usuarios = (new Usuario)->mostrarUsuarios();
$html= Util::usuariosActivos();

echo $blade->view()->make('vusuarios', compact('encabezado', 'titulo', 'usuario', 'html'))->render();