<?php

$precio = 100;
$tam = 18;
echo "Precio y tamaño cumplen las dos condiciones y por tanto se muestra ".
        ($precio > 50 && $tam < 25)."<br><br>";  // muestra 1 porque se cumplen las dos condiciones

echo  "Precio y tamaño NO cumplen ninguna de las dos condiciones y por tanto "
. "su condición es es falsa, que al convertirla en una string produce una cadena vacía ".($precio > 150 || $tam > 75)."<br><br>";  // no muestra nada porque la condición no se cumple

echo "Utilizamos el operador de no igualdad ! y lo que hacemos es comprobar si la variable \$tam es menor que 10."
. " Al no cumplirse la condición no se muestra nada".!($tam > 10);   // falso: no muestra nada
?> 
