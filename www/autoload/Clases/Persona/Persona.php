<?php

namespace Persona;

use Traits\Mezcla as mix; //Incluimos el trait

class Persona {

    use mix; //Es imprescindible esta sentencia

    protected $nombre;
    protected $apellidos;
    protected $movil;

    function __construct($nombre, $apellidos, $movil) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->movil = $movil;
        echo $this->creacion("<br>El usuario $this->nombre $this->apellidos de tipo " . get_class($this) . " se creó a las ");
    }

    function verInformacion() {
        return $this->nombre . ' ' . $this->apellidos . ' con móvil ' . $this->movil;
    }

}
