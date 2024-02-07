<?php

/*
 * PHP incorpora dos métodos mágicos __set() y __get() para "atrapar" todos los 
 * accesos de modificación de valor o de consulta respectivamente a propiedades
 * que no están declaradas en el objeto o innacesibles (protected o private).
 */

class Acceso_a_propiedades_innacesibles {

    private $privada = "valor privado";
    protected $protegida = "valor protegido";

    /*
     * Se dispara el método __set() cuando se intenta escribir información en propiedades
     * innacesibles (protegidas o privadas) o propiedades que no existen. Acepta 
     * dos parámetros con la siguiente estructura
     * public __set ( string $name , mixed $value ) : void
     */

    function __set($prop, $valor) {
        echo "Intentamos dar valor a la propiedad '$prop' con el siguiente dato $valor<br>";
    }

    /*
     * Se dispara el método __get() cuando se intenta leer información en propiedades
     * innacesibles (protegidas o privadas) o propiedades que no existen. Acepta 
     * un único parámetro con la siguiente estructura
     * public __get ( string $name ) : mixed
     */

    function __get($prop) {
        echo "Intentamos acceder a la propiedad '$prop' no accesible<br>";
    }

}

$obj = new Acceso_a_propiedades_innacesibles();
echo "<h3>Llamadas a __set()</h3>";
$obj->a = 'hola'; //No asigna valor porque al no existir la propiedad llama a __set()
$obj->privada = 'Nuevo valor privado'; //No asigna valor a una propiedad privada y al intentarlo llama a __set()
$obj->protegida = 'Nuevo valor protegido'; //No asigna valor a una propiedad protegida y al intentarlo llama a __set()

echo "<br><br><h3>Llamadas a __get()</h3>";
echo $obj->b; //No se ejecuta porque al intentar acceder a la propiedad que no existe llama a __get()
echo $obj->privada; //No se ejecuta porque al intentar acceder a la propiedad innacesible (private) llama a __get()
echo $obj->protegida; //No se ejecuta porque al intentar acceder a la propiedad innacesible (protegida) llama a __get()
?>
