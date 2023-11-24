<?php
require_once '../vendor/autoload.php';

try{
    $server = new SoapServer(null,['uri'=>'']);
    $server->setClass('MisClases\MetodosSoap');
    $server->handle();
}catch(SoapFault $f){
    die("error en server: " . $f->getMessage());
}
