<?php

namespace AcademiaBaile;

/*
  La clase Baile con dos atributos: nombre y edadMinima.
  La edad mínima será de 8 años salvo que se indique lo contrario.
 */

class Baile {

    private $nombre;
    private $edadMinima;

    function __construct(string $nombre, int $edadMinima = 8) {
        $this->nombre = $nombre;
        $this->edadMinima = $edadMinima;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEdadMinima() {
        return $this->edadMinima;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEdadMinima($edadMinima) {
        $this->edadMinima = $edadMinima;
    }

}