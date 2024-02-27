<?php

namespace clases;

class Grupos extends Base {

    protected $web;

    public function __construct($nom, $nif, $direc, $web) {

        parent::__construct($nom, $nif, $direc);
        $this->web = $web;
    }

    public function show() {
        return "Clase Grupos " . $this->nombre . "  " . $this->nif . "  " . $this->direccion . "  " . $this->web . "<br>";
    }

}
