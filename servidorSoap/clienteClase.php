<?php
require_once '../vendor/autoload.php';
use MisClases\Configuracion;

// Establecemos los parámetros que necesita la clase SoapCliente
$url = Configuracion::URI . "../src/wsdl.xml";

try {
    $cliente = new SoapClient($url);
} catch (SoapFault $ex) {
    die("Error en el cliente: " . $ex->getMessage());
}

$producto = $cliente->getStock();

foreach ($producto as $item){
    echo $item['nombre'] . "    Stock: " . $item['stock'] . "<br>";
    }
    