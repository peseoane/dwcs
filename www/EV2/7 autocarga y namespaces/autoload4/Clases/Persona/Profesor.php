<?php

namespace Persona;

use Persona\Persona as person;
use AcademiaBaile\Baile as dance;


class Profesor extends person {

    private $nif;
    private $coleccionBailes = array();

    function __construct($nombre, $apellidos, $movil, $nif) {
        $this->nif = $nif;
        parent::__construct($nombre, $apellidos, $movil);
    }

    function anadeBaile($nombre, $edad = 8) {
        $b = new dance($nombre, $edad);

        if (!in_array($b, $this->coleccionBailes))
            array_push($this->coleccionBailes, $b);
    }

    function muestraBailes() {
        foreach ($this->coleccionBailes as $baile) {
            echo $baile->getNombre() . ' (edad minima: ' . $baile->getEdadMinima() . ' años)<br>';
        }
    }

}