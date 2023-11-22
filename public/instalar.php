<?php 
require '../vendor/autoload.php';
use MisClases\Instalador;

if(!isset($_POST['instalar'])) header("Location: index.php");

$bbdd= $_POST['bbdd'];
$nombre= $_POST['usuario'];
$pass= $_POST['pass'];
$host= $_POST['host'];
$usuario_tienda= $_POST['usuario_tienda'];
$pass_tienda= $_POST['pass_tienda'];
$nueva_configuracion = fopen('../src/Configuracion.php', "w+"); 
fwrite($nueva_configuracion,"<?php
namespace MisClases;

class Configuracion{

    const NOMBRE_BBDD = \"$bbdd\";
    const NOMBRE_USUARIO = \"$nombre\"; 
    const PASSWORD = \"$pass\";
    const HOST_BBDD = \"$host\";
    const USUARIO_TIENDA = \"$usuario_tienda\";
    const PASS_TIENDA = \"$pass_tienda\";
    
}"); 
fclose($nueva_configuracion);

$instalador = new Instalador();
$instalador->creaBBDD();
$instalador->exportarDatos();
$instalador->crearAdministrador();


header("Location: index.php");