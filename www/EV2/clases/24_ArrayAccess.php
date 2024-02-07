<?php

/*
 * ArrayAccess es una interface de PHP que permite dictar cómo se comportará PHP 
 * cuando un objeto tenga una sintaxis de array (corchetes después del objeto)
 */

class Animal implements \ArrayAccess {

    public $lugar;
    protected $animales; //array de animales

    public function offsetExists($index): bool {
        return isset($this->animales[$index]);
    }

    public function offsetGet($index):bool {
        if ($this->offsetExists($index)) {
            return $this->animales[$index];
        }
        return false;
    }

    public function offsetSet($key, $value):void {
        if ($key) {
            $this->animales[$key] = $value;
        } else {
            $this->animales[] = $value;
        }
    }

    public function offsetUnset($index):void {
        unset($this->animales[$index]);
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