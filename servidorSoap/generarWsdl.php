<?php
// Llamamos al autoload de composer
require_once '../vendor/autoload.php';
use MisClases\Configuracion;
// Declaramos las variables que serán pasados por parámetros.
$class = "MisClases\\MetodosSoap";
$uri = Configuracion::URI . '../servidorSoap/servidorSoapWsdl.php';

// Instanciamos la clase PHPClass2WSDL generando el fichero en la ruta indicada.
$wsdlGenerator = new PHP2WSDL\PHPClass2WSDL($class, $uri);
$wsdlGenerator->generateWSDL(true);
$fichero = $wsdlGenerator->dump();
$fichero = $wsdlGenerator->save('../servidorSoap/servidorSoap.wsdl');