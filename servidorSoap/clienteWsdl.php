<?php
require_once '../vendor/autoload.php';
use MisClases\Configuracion;
// Establecemos los parámetros que necesita la clase SoapCliente
$url = Configuracion::URI . "../servidorSoap/servidorSoap.wsdl";

try {
    $cliente = new SoapClient($url);
} catch (SoapFault $ex) {
    die("Error en el cliente: " . $ex->getMessage());
}

$productos = $cliente->getStock();

foreach ($productos as $item){
    echo $item['nombre'] . "   Stock: " . $item['stock'] . "<br>";
}