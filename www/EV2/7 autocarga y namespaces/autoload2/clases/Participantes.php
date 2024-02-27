<?php

class Participantes extends Base implements Modificar {

    protected $mail, $telefono, $grupo, $fechaIniGrupo;

    public function __construct($nom, $nif, $direc, $mail, $telf, $grupo, $fechaIniGrupo) {

        parent::__construct($nom, $nif, $direc);
        $this->mail = $mail;
        $this->telefono = $telf;
        $this->grupo = $grupo;
        $this->fechaIniGrupo = $fechaIniGrupo;
    }

    public function show() {
        return "Clase de tipo Participantes y nombre " . $this->nombre . " con nif " . $this->nif . ", dirección en " . $this->direccion . " e email " . $this->mail . "<br>";
    }

    public function modificar($grupoNue) {

        $this->grupo = $grupoNue;
    }

}
