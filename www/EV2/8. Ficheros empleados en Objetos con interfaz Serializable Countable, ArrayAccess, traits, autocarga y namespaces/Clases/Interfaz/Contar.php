<?php

namespace Interfaz;

/*
 * Todos los métodos declarados en una interfaz deben ser públicos.
 * Se pueden crear subinterfaces  del mismo modo que las clases, utilizando el 
 * operador extends.
 */

interface Contar extends \Countable {

    //Contante de una interfaz, que va a representar la duración de cada uno de 
    //los elementos que queremos contar
    const duracion = 50;

    /*
     * Como mi interfaz hereda de la interfaz \Countable debo incluir los métodos
     * que tenga esta, en nuestro caso sólo uno, count()
     */

    public function count(): int;
}
