<?php
// Llamamos al autoload de composer
require '../vendor/autoload.php';

// Instanciamos la clase Generator de Wsdl2PhpGenerator
$generator = new Wsdl2PhpGenerator\Generator();

// Usamos el método generate para crear la clase y WSDL.
$generator->generate(
new Wsdl2PhpGenerator\Config([
    'inputFile' => "http://localhost/proyectos/Curso%20DSW/TiendaBlade/servidorSoap/servidorSoap.wsdl", 
    'outputDir' => '../src', //directorio donde vamos a generar las clases
    'namespaceName' => 'MisClases' //namespace que vamos a usar con ellas 
    ])
);

