<?php

//get_class_methods sólo muestra los métodos accesibles (públicos)

class MiClase {

    // método 1
    private function mifunc1() {
        return(true);
    }

    // método 2
    protected function mifunc2() {
        return(true);
    }

    // método 3
    function mifunc3() {
        return(true);
    }

}

class MiClaseHeredada extends MiClase {

    // método 1
    private function mifuncHeredada1() {
        return(true);
    }

    // método 2
    function mifuncHeredado2() {
        return(true);
    }

}

//Son válidas las dos opciones de las siguientes líneas.
//$métodos_clase = get_class_methods('Miclase');
$métodos_clase = get_class_methods(new Miclase());
echo "<b>Los métodos de mi clase base son: <br></b>";

foreach ($métodos_clase as $nombre_método) {
    echo "$nombre_método<br>";
}

$métodos_claseheredada = get_class_methods(new MiClaseHeredada());
echo "<br><b>Los métodos de mi clase heredada son:</b> <br>";

foreach ($métodos_claseheredada as $nombre_método) {
    echo "$nombre_método<br>";
}
?>

