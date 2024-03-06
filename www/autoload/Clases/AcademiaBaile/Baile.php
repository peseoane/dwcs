<?php

namespace AcademiaBaile;

class Baile {

    private $nombre_baile;
    private $edadMinima; //Edad mínima que debe tener un alumno para matricularse

    function __construct($nombre, $edadMinima = 8) {
        $this->nombre_baile = $nombre;
        $this->edadMinima = $edadMinima;
    }

    function getnombreBaile() {
        return $this->nombre_baile;
    }

}
