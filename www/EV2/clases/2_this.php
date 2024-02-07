<?php

class unaClase {

    //Para acceder a propiedades dentro del objeto  $this->propiedad
    public $a = 'Soy una propiedad';

    function pp() {
        $a = 'Soy una variable local';
        $aux = $a . "<br />" . $this->a . "<br />";
        return $aux;
    }

}

$o = new unaClase();
echo $o->pp();
?>
