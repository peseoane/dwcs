<?php

/*
 * Usamos el constructor del lenguaje unset() para forzar la destrucción de 
 * la variable $usuario entre expresiones. La llamada a unset() es básicamente 
 * un disparador implícito para que PHP ejecute el método __destruct() del objeto 
 */

class Usuario
{

    public function __destruct()
    {
        echo 'He llamado al método __destruct()';
    }

}

echo "Creo un objeto de tipo Usuario";
$usuario = new Usuario();
echo '<br>Elimino un objeto de tipo usuario al utilizar la función unset()<br>';
unset($usuario);