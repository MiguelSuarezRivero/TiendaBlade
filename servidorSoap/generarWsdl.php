<?php
// Llamamos al autoload de composer
require '../vendor/autoload.php';

// Declaramos las variables que serán pasados por parámetros.
$class = "MisClases\\MetodosSoap";
$uri = 'http://localhost/proyectos/Curso%20DSW/TiendaBlade/servidorSoap/servidorSoapWsdl.php';

// Instanciamos la clase PHPClass2WSDL generando el fichero en la ruta indicada.
$wsdlGenerator = new PHP2WSDL\PHPClass2WSDL($class, $uri);
$wsdlGenerator->generateWSDL(true);
$fichero = $wsdlGenerator->dump();
$fichero = $wsdlGenerator->save('../servidorSoap/servidorSoap.wsdl');