<?php 
session_start();
require '../vendor/autoload.php';
use Philo\Blade\Blade;
use MisClases\Util;
use MisClases\Usuario;

Util::verificaConfiguracion();
Util::verificaSesion();

if(isset($_POST['crear'])){
    $crear = (new Usuario)->crearUsuario($_POST['nombre'],$_POST['pass'],$_POST['rol']);
}

if(isset($_GET['eliminar'])){
    $eliminar = (new Usuario)->eliminarUsuario($_GET['eliminar']);
}

$views = '../views';
$cache = '../cache';
$encabezado = "Gestión de usuarios";
$usuario = $_SESSION['nombre'];
$titulo = "Gestión de usuarios";
$blade = new Blade($views, $cache);
$usuarios = (new Usuario)->mostrarUsuarios();
$html= "";

foreach($usuarios as $user){
    $rol = ($user->rol == 0)?'Administrador':'Cliente';
    $html .= "<tr><td>";
    $html .= $user->nombre;
    $html .= "</td><td>";
    $html .= $rol;
    $html .= "</td><td><a class='btn btn-primary' href='gestion-usuarios.php?eliminar=$user->nombre";
    $html .= "'>Eliminar</a></td></tr>";
}


echo $blade->view()->make('vusuarios', compact('encabezado', 'titulo', 'usuario', 'html'))->render();