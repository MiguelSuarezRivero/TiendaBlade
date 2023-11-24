<?php

# CLIENTE A IMPLEMENTAR.

// Establecemos los parámetros que necesita la clase SoapCliente
$url = "http://localhost/proyectos/Curso%20DSW/TiendaBlade/servidorSoap/servidorSoap.php";
$uri = 'http://localhost/proyectos/Curso%20DSW/TiendaBlade/servidorSoap';

try {
    $cliente = new SoapClient(null, ['location' => $url, 'uri' => $uri, 'trace'=>true]);
} catch (SoapFault $ex) {
    echo "Error en el cliente: ".$ex->getMessage();
}


$precio = $cliente->getStock();

foreach ($precio as $item){
echo $item['nombre'] . "    Stock: " . $item['stock'] . "<br>";
}
