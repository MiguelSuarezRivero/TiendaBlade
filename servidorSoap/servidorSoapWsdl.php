<?php
// Llamamos al autoload de composer
require_once '../vendor/autoload.php';
use MisClases\Configuracion;
// Instanciaomos la clase SoapServer pasando por parámetro el archivo WSDL.
try {
    $server = new SoapServer(Configuracion::URI . "../servidorSoap/servidorSoap.wsdl");
    $server->setClass('MisClases\MetodosSoap');
    $server->handle();
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}