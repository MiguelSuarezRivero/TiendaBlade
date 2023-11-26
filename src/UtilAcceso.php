<?php
namespace MisClases;
require_once '../vendor/autoload.php';

class UtilAcceso{

    public static function gestionaAcceso(){
        
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
    }
}