<?php
require_once '../vendor/autoload.php';
use MisClases\Configuracion;
# CLIENTE A IMPLEMENTAR.

// Establecemos los parámetros que necesita la clase SoapCliente
$url = Configuracion::URI . "../servidorSoap/servidorSoap.php";
$uri = Configuracion::URI . '../servidorSoap';

try {
    $cliente = new SoapClient(null, ['location' => $url, 'uri' => $uri, 'trace'=>true]);
} catch (SoapFault $ex) {
    echo "Error en el cliente: ".$ex->getMessage();
}


$precio = $cliente->getStock();

foreach ($precio as $item){
echo $item['nombre'] . "    Stock: " . $item['stock'] . "<br>";
}
