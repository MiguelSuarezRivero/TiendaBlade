<?php

// Establecemos los parámetros que necesita la clase SoapCliente
$url = "http://localhost/proyectos/Curso%20DSW/TiendaBlade/src/wsdl.xml";

try {
    $cliente = new SoapClient($url);
} catch (SoapFault $ex) {
    die("Error en el cliente: " . $ex->getMessage());
}

$producto = $cliente->getStock();

foreach ($producto as $item){
    echo $item['nombre'] . "    Stock: " . $item['stock'] . "<br>";
    }
    