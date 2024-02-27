<?php

namespace Persona;

use Persona\Persona as person;
use Interfaz\Contar; //No olvidarse de incluir la interfaz

class Alumno extends person implements Contar {

    private $numClases;

    public function __construct($nombre, $apellidos, $movil, $numClases = null) {
        parent::__construct($nombre, $apellidos, $movil);
        $this->numClases = $numClases;
    }

    public function count(): int {
        //Se deja en blanco porque no se necesita
    }

}
