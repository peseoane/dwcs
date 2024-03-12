<?php

class Clase {
    /*
     * A igual que __set() y __get() sirven para atrapar accesos a propiedades no 
     * declaradas, el método mágico __call hace lo mismo con llamadas a métodos no 
     * declarados. Su firma consiste en dos parámetros donde el primero será una string
     * que representará el nombre del método y el segundo un array de atributos qe se
     * le pasa al método.
     */

    public function __call($metodo, $parametros) {
        $str = "Intentamos ejecutar un método inaccesible llamado <b>" . $metodo .
                "</b><br /> con los siguientes parámetros: <br /> ";
        // Mostramos los parámetros pasados al método
        foreach ($parametros as $parametro) {
            $str .= " " . $parametro . ", ";
        }
        echo $str;
    }

}

$a = new Cursos();
$a->metodoQueNoExiste(TRUE, 'dato', 23);