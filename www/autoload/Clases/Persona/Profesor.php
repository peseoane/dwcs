<?php

namespace Persona;

use Persona\Persona as person;
use AcademiaBaile\Baile as dance;
use Interfaz\Contar; //No olvidarse de incluir la interfaz
use Interfaz\Comparar; //No olvidarse de incluir la interfaz

/*
 * Al usar una interfaz con la palabra reservada implements, debemos desarrollar
 * todos los métodos de la interfaz, aunque no escribamos nada en su interior.
 * Una clase hereda de un único padre pero puede implementar varias interfaces.
 */

class Profesor extends person implements \ArrayAccess, Contar, Comparar {

    private $nif;
    //Array con los bailes que imparte un profesor, que son objetos de tipo Baile
    private $coleccionBailes = array();

    function __construct($nombre, $apellidos, $movil, $nif) {
        $this->nif = $nif;
        parent::__construct($nombre, $apellidos, $movil);
    }

    function anhadeBaile($nombre_baile, $edad = 8) {
        /* Antes de añadir un baile a un profesor veo si ya está en la lista de bailes 
         * que imparte. Si es así, no lo introduce aunque la edad mínima sea distinta
         * de la ya guardada
         */
        if (!$this->compare($nombre_baile)) {
            //Si la edad es por defecto llamo al método offsetSet de ArrayAccess
            if ($edad == 8)
                $this[] = $nombre_baile;
            //Si incluyo la edad creo el objeto baile y lo introduzco de la forma tradicional
            else
                array_push($this->coleccionBailes, new dance($nombre_baile, $edad));
        }
    }

    // Funciones de la interfaz Serializable
    public function __serialize() {

        /*
         * Con la función get_object_vars obtenemos en forma de array las propiedades 
         * no estáticas accesibles de un objeto. Como lo llamamos desde dentro del
         * objetos podemos acceder a todas las propiedades. En nuestro caso nif, 
         * nombre, apellidos, movil y un array de objetos de tipo Baile
         */

        return get_object_vars($this);
    }

    public function __unserialize($data) {

        /*
         * Ahora tenemos que convertir cada elemento de ese array a las propiedades de ese
         * objeto: índice y valor.
         * Poner un punto de interrupción para ver exactamente este valor
         */
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    // Funciones de la interfaz Comparar
    public function compare($nombre_baile) {
        /*
         * Ve si el nombre del baile existe en el array de bailes del profesor
         */
        $existe = false;
        $offset = 0;
        //Recorro el array del objeto usando la interfaz ArrayAccess en $this[$offset]
        while (($existe == false) && (isset($this[$offset]))) {
            /*
             * Utiliza la función strcmp para comparar el nombre del baile, con 
             * los elementos del array de bailes, concretamente con la propiedad
             * nombre_baile y como esa propiedad es privada tenemos que usar un 
             * método público para acceder a ella. 
             */
            if (strcmp($this->coleccionBailes[$offset]->getnombreBaile(), $nombre_baile) == 0) {
                $existe = true;
            }
            $offset++; //Avanzo el índice
        }
        return $existe;
    }

    // Funciones de la interfaz Countable
    public function count(): int {
        //Método para contar el número de bailes asociados a un profesor
        return count($this->coleccionBailes);
    }

    // Funciones de la interfaz ArrayAccess
    public function offsetExists($offset): bool {
        return isset($this->coleccionBailes[$offset]);
    }

    public function offsetGet($offset): mixed {
        return $this->offsetExists($offset) ? $this->coleccionBailes[$offset] : false;
    }

    public function offsetSet($offset, $nombre_baile): void {
        if (!$this->compare($nombre_baile)) {
            $baile = new dance($nombre_baile);
            ($offset == "") ? $this->coleccionBailes[] = $baile : $this->coleccionBailes[$offset] = $baile;
        }
    }

    public function offsetUnset($offset): void {
        unset($this->coleccionBailes[$offset]);
    }

}
