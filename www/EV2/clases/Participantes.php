<?php

namespace clases;

use interfaces\Modificar as modify;

class Participantes extends Base implements modify {

    protected $mail, $telefono, $grupo, $fechaIniGrupo;

    public function __construct($nom, $nif, $direc, $mail, $telf, $grupo, $fechaIniGrupo) {

        parent::__construct($nom, $nif, $direc);
        $this->mail = $mail;
        $this->telefono = $telf;
        $this->grupo = $grupo;
        $this->fechaIniGrupo = $fechaIniGrupo;
    }

    public function show() {
        return "Clase Participantes " . $this->nombre . "  " . $this->nif . "  " . $this->direccion . "  " . $this->mail . "<br>";
    }

    public function modificar($grupoNue) {

        $this->grupo = $grupoNue;
    }

}
