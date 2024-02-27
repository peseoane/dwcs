<?php

namespace Persona;

use Persona\Persona as person;

class Alumno extends person {

    private $numClases;

    public function __construct($nombre, $apellidos, $movil, $numClases = null) {
        parent::__construct($nombre, $apellidos, $movil);
        $this->numClases = $numClases;
    }
}
