<?php
// Llamamos al autoload de composer
require '../vendor/autoload.php';

// Instanciaomos la clase SoapServer pasando por parámetro el archivo WSDL.
try {
    $server = new SoapServer("http://localhost/proyectos/Curso%20DSW/TiendaBlade/servidorSoap/servidorSoap.wsdl");
    $server->setClass('MisClases\MetodosSoap');
    $server->handle();
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}