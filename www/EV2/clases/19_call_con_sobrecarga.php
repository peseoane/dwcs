<?php

/*
 * Utilizamos __call() para implementar la sobrecarga de métodos.
 * Es decir, hacer llamadas a un método y en función de los parámetros pasados a
 * éste ejecutar una acción u otra.
 * Tradicionamente la sobrecarga proporciona la posibilidad de que tengamos múltiples
 * métodos con el mismo nombre pero argumentos diferentes.
 * En PHP la sobrecarga significa crear métodos y propiedades dinámicamente
 */

class Sobrecargada {

    function __call($metodo, $atributos) {
        if ($metodo == 'operador_mas') {
            if (is_integer($atributos[0]) && is_integer($atributos[1]))
                return $atributos[0] + $atributos[1];
            else {
                for ($str = "", $i = 0; $i < count($atributos); $i++)
                    $str .= $atributos[$i];
                return $str;
            }
        } else
            echo "Cuidado: metodo no declarado: '$metodo'<br />";
    }

}

$primero = 100;
$segundo = 300;
$obj = new Sobrecargada();
echo "La suma de los números $primero y $segundo es " . $obj->operador_mas($primero, $segundo) . "<br>";
$res = $obj->operador_mas("hola", " que", " tal");
echo "El resultado de sumar cadenas es $res<br>";
$res = $obj->operador_menos($primero, $segundo);
?>
