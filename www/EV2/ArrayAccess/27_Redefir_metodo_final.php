<?php

class Saludar {

    final function saluda() {
        return "Hola mundo!<br><br>";
    }

}

class Redefir_saludar extends Saludar {

    function saluda() {
        return "<br>Quiero redefinir este método pero no va a ser posible porque saldrá un error fatal";
    }

}

//Las siguientes líneas no me dejaría ejecutarlas porque hay un error, al intentar
//redefinir una clase final, pero sin embargo el IDE NO me lo indica
$o1 = new Saludar();
echo $o1->saluda();

$o2 = new Redefir_saludar();
echo $o2->saluda();
?>
