<?php 
if (file_exists('../src/Configuracion.php')) {
    header('Location: acceso.php');
} else {
    header('Location: instalador.php');  
}