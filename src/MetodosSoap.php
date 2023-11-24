<?php
namespace MisClases;

class MetodosSoap{

/**
     * Obtiene el Stock de todos los productos.
     * @soap
     * @return array Array con todos los productos y su stock.
     */
    function getStock(){
        return Stock::getStockGeneral();
    }
}