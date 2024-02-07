<?php

class Cuenta_objs {
    /*
     * Las propiedades estáticas se pueden acceder usando ::, de dos formas
     * nombre_clase::propiedad
     * self::propiedad
     */

    static private $contador = 0;

    static function cuantosObjetos() {
        return Cuenta_objs::$contador;
    }

    function __construct() {
        self::$contador++;
    }

    function __destruct() {
        Cuenta_objs::$contador--;
    }

}

$o1 = new Cuenta_objs();
$o2 = new Cuenta_objs();
$o3 = new Cuenta_objs();
echo "Objetos 'vivos': " . Cuenta_objs::cuantosObjetos() . "<br />";
unset($o2); //llama al destructor
echo "Objetos 'vivos': " . Cuenta_objs::cuantosObjetos() . "<br />"
?>