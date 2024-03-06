<?php

namespace Traits;

/*
 * Este trait va a ser utilizado por dos clases distintas (Profesor y Alumno)
 */

trait Mezcla {

    function creacion($msg) {
        return $msg . date('d-m-Y h:i:s');
    }

    function count_apellidos() {
        $array = explode(" ", $this->apellidos);
        return count($array);
    }

}
