<?php

/*
 * Estamos llamando al constructor del lenguaje exit() justo antes de la 
 * salida de la cadena C. Este sirve como un desencadenante implícito para PHP
 * a que no hay más referencias hacia la variable $usuario y por lo tanto, 
 * se puede ejecutar el método __destruct() del objeto.
 */

class Usuario {

    public function __destruct() {
        echo 'Llamada a __destruct()<br>';
    }

}

echo "Creo un objeto de tipo Usuario";
$usuario = new Usuario();
echo '<br>La siguiente sentencia a ejecutar es un exit que llama al destructor porque'
 . 'se hace una recolección de basura<br>';
exit; 
echo 'Fin'; //Esta línea no se ejecuta porque ya finalizó el programa con el exit
