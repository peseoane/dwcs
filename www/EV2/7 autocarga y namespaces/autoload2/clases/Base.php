<?php

class Base {

    protected $nombre, $nif, $direccion;

    public function __construct($nom, $nif, $direc) {

        $this->nombre = $nom;
        $this->nif = $nif;
        $this->direccion = $direc;
    }

    public function show() {
        return "Clase de tipo Base y nombre " . $this->nombre . "  con nif " . $this->nif . " y dirección en " . $this->direccion . "<br>";
    }

}
