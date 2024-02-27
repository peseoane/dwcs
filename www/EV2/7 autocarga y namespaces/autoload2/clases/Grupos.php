<?php

class Grupos extends Base {

    protected $web;

    public function __construct($nom, $nif, $direc, $web) {

        parent::__construct($nom, $nif, $direc);
        $this->web = $web;
    }

    public function show() {
        return "Clase de tipo Grupos y nombre " . $this->nombre . " con nif " . $this->nif . " , dirección en " . $this->direccion . " y web  " . $this->web . "<br>";
    }

}
