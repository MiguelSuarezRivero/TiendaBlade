<?php
namespace MisClases;
require_once '../vendor/autoload.php';
use PDO;
use PDOException;

class Instalador{


    public function creaBBDD(){

        try {
            $conexion = new PDO("mysql:host=" . Configuracion::HOST_BBDD . ";", Configuracion::NOMBRE_USUARIO, Configuracion::PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS " . Configuracion::NOMBRE_BBDD;
            $conexion->exec($sql);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }

    }

    public function exportarDatos(){
        try {
            $conexion = new PDO("mysql:host=" . Configuracion::HOST_BBDD . ";dbname=" . Configuracion::NOMBRE_BBDD . "", Configuracion::NOMBRE_USUARIO, Configuracion::PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = file_get_contents('../src/datos.sql');
            $conexion->exec($sql);
        } catch (PDOException $e) {
            echo "Error al importar el archivo SQL: " . $e->getMessage();
        }
    }

    public function crearAdministrador(){
        
        (new Usuario)->crearUsuario(Configuracion::USUARIO_TIENDA, Configuracion::PASS_TIENDA, 0);
        (new Usuario)->crearUsuario('cliente', 'cliente', 1);

    }

}