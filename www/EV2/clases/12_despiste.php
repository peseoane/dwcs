<?php

class Despiste {

    public $identif_muy_largo;

}

$obj = new Despiste();
$obj->identi_muy_largo = 'hola'; //aquí está la errata;
/*
 * No nos va a mostrar nada porque esa propiedad no existe y es pública. 
 * Si fuera privada obtendríamos un fatal error
 */
echo $obj->identif_muy_largo;
?>
