<?php

//Ejemplo de cómo evitar que se creen dinámicamente propiedades utilizando
// el método mágico __set

class Test {

    public $prop1;

    public function __set($name, $value) {
        throw new Exception('No se puede establecer la propiedad!');
    }

}

try {
    $obj = new Test;
    $obj->prop1 = 'Propiedad declarada <br>';
    $obj->prop2 = 'Propiedad no declarada';
    echo $obj->prop1;
    echo $obj->prop2;
} catch (\Exception $e) {
    echo $e->getMessage();
}
?>
