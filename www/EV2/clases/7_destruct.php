<?php

/*
 * En new Usuario(), la expresión crea una instancia de la clase Usuario en "el
  aire", ya que no asigna el objeto recién creado a la variable. Este es un detonante de
  PHP para llamar explícitamente primero al método __construct() y después al método
 * __destruct() en la misma línea. Se ejecutan ambos en la misma línea
 */

class Usuario {

    public function __construct() {
        echo 'Primero he llamado al método __construct() en el momento de hacer un new';
    }

    public function __destruct() {
        echo '<br>Después llamado al método __destruct()';
    }

}

new Usuario();
echo "<br>Fin";
