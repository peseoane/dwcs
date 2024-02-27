<?php
namespace Persona;

class Persona {

    private $nombre;
    private $apellidos;
    private $movil;

    function __construct($nombre, $apellidos, $movil) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->movil = $movil;
    }

    function verInformacion() {
        return $this->nombre . ' ' . $this->apellidos . ' con móvil ' . $this->movil;
    }

}
