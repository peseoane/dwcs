<?php

class Saludos {

    function __call($nombre_metodo, $argumentos) {
        $metodos_aceptados = array("Buenas");
        if (!in_array($nombre_metodo, $metodos_aceptados)) {
            //Genera un mensaje de error/advertencia/aviso a nivel de usuario
            trigger_error("Metodo <b>$nombre_metodo</b> no existe", E_USER_ERROR);
        }

        if (count($argumentos) == 0) {
            $this->Buenas1();
        } elseif (count($argumentos) == 1) {
            $this->Buenas2($argumentos[0]);
        } elseif (count($argumentos) == 2) {
            $this->Buenas3($argumentos[0], $argumentos[1]);
        } else {
            return false;
        }
    }

    private function Buenas1() {
        echo "Buenos días!<br />";
    }

    private function Buenas2($nombre) {
        echo "Buenos días $nombre<br />";
    }

    private function Buenas3($nombre, $apellidos) {
        echo "Buenos días $nombre $apellidos<br />";
    }

}

$s = new Saludos();
$s->Buenas();
$s->Buenas("Rafa");
$s->Buenas("Mar", "Gómez");
//Se llama al método __call, que a su vez dispara la función trigger_error 
$s->Tardes();
