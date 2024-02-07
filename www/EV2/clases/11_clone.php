<?php

class una_clase {

    public $un_contador = 0;
    public $una_propiedad = 'nada';

//Comentar y descomentar esta función para ver las diferencias y ejecutar paso a paso
    function __clone() {
        $this->un_contador++;
    }

}

$ob1 = new una_clase();
/*
 * Al clonar un objeto con clone se llama al método mágico __clone si este está 
 * definido. Se crean dos objetos diferentes que contienen los mismos datos. Las
 * modificaciones en uno no afectan al otro.
 * El método mágico se usa para cambiar aquellos aspectos que nos interesen del 
 * clonado, especialmente cuando contienen referencias a otros objetos
 */
$ob2 = clone $ob1;

echo "<pre>";
print_r($ob1);
print_r($ob2);
echo "</pre>";
?>
