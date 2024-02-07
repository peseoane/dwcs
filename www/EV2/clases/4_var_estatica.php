<?php

class unaEstatica {

    static $var_estatica = 'valor de la variable estática';
    public $var_estandar = 'valor de la variable estándar';

}

echo "Al escribir en PHP unaEstatica::\$var_estatica: nos muestra " . unaEstatica::$var_estatica . "<br />";
$o = new unaEstatica();

// No existe en el objeto y por tanto va a mostrar un Notice
//echo "\$o->var_estatica: " . $o->var_estatica . "<br />";

echo "\$o->var_estandar: " . $o->var_estandar . "<br />";

//Comentar y descomentar la siguiente línea para ver el error que se produce cuando
//se quiere acceder a una variable estándar de una forma estática (con ::)
//echo "unaEstatica::$var_estandar".unaEstatica::$var_estandar . "<br />";
?>
