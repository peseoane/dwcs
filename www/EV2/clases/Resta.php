<?php

class Resta extends Calculo {

    function calcular() {
        if (isset($this->operando1) AND isset($this->operando2)) {
            $this->resultado = $this->operando1 - $this->operando2;
        }
    }

}
?>


