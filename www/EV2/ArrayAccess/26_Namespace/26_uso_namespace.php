<?php

namespace Foo\Bar;

include '26_def_namespace.php';

const Ejemplo26 = "Constante del espacio";

function foo() {
    return "Llamada a la función foo del espacio principal";
}

class foo {

    static function método_estático(int $var) {
        return 2*$var;
    }

}

echo "<b>Nombre NO cualificado</b><br>";
$aux=3;
echo foo()."<br>"; // se resuelve con la función Foo\Bar\foo de este fichero
echo "Tras calcular el doble de $aux obtengo ".foo::método_estático($aux)."<br>"; // se resuelve con la clase Foo\Bar\foo, método método_estático de este fichero
echo Ejemplo26."<br>"; // se resuelve con la constante Foo\Bar\FOO de este fichero

/* Nombre cualificado */
echo "<br><b>Nombre  cualificado</b><br>";
echo subespacio_de_nombres\foo()."<br>"; // se resuelve con la función Foo\Bar\subespacio_de_nombres\foo
echo "Tras calcular la potencia de $aux obtengo ".subespacio_de_nombres\foo::método_estático($aux)."<br>"; // se resuelve con la clase Foo\Bar\subespacio_de_nombres\foo,
// método método_estático
echo subespacio_de_nombres\Ejemplo26."<br>"; // se resuelve con la constante Foo\Bar\subespacio_de_nombres\FOO

/* Nombre completamente cualificado */
echo "<br><b>Nombre completamente cualificado</b><br>";
echo \Foo\Bar\foo()."<br>"; // se resuelve con la función Foo\Bar\foo
echo "Tras calcular el doble de $aux obtengo ".\Foo\Bar\foo::método_estático($aux)."<br>"; // se resuelve con la clase Foo\Bar\foo, método método_estático
echo \Foo\Bar\Ejemplo26; // se resuelve con la constante Foo\Bar\FOO
?>
