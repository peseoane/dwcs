<?php

/*
 * ArrayAccess es una interface de PHP que permite dictar cómo se comportará PHP 
 * cuando un objeto tenga una sintaxis de array (corchetes después del objeto)
 */

class Animal implements \ArrayAccess {

    public $lugar;
    protected $animales;    //array de animales

    public function offsetExists($offset): bool {
        return isset($this->animales[$offset]);
    }

    public function offsetGet($offset):bool {
        if ($this->offsetExists($offset)) {
            return $this->animales[$offset];
        }
        return false;
    }

    public function offsetSet($offset, $value):void {
        if ($offset) {
            $this->animales[$offset] = $value;
        } else {
            $this->animales[] = $value;
        }
    }

    public function offsetUnset($offset):void {
        unset($this->animales[$offset]);
    }

    public function getAnimales() {
        return $this->animales;
    }

}

$animal = new Animal;
$animal->lugar = "Asia y Oceania";
//Llama a la función offsetSet ya que el objeto tiene una sintaxis de array
$animal[] = "Oso panda";
$animal[] = "Koala";
$animal->offsetSet("", "Pangolin");
$animales = $animal->getAnimales();
foreach ($animales as $anim) {
    echo $anim . "<br>";
}
/*
Devuelve:
Oso panda
Koala
Pangolin
*/