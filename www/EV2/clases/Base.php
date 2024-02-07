<?php

namespace clases;

class Base {

    protected $nombre, $nif, $direccion;

    public function __construct($nom, $nif, $direc) {

        $this->nombre = $nom;
        $this->nif = $nif;
        $this->direccion = $direc;
    }

    public function show() {
        return "Clase Base " . $this->nombre . "  " . $this->nif . "  " . $this->direccion . "<br>";
    }

}
