<?php

echo "Muestro el contenido de una variable booleana cuyo valor es true por medio de un echo y obtengo ";
echo true;
echo "<br><br>";
echo "Muestro el contenido de una variable booleana cuyo valor es false por medio de un echo y obtengo cadena vacía";
echo false;
echo "<br><br>";
echo "Al hacer un casting de una booleana con valor false a un entero me muestra ";
echo (int) FALSE;
echo "<br><br>";
$bool = (boolean) 1; // mismo valor pero
$int = (integer) 1; // distinto tipo  (tb vale cast (int))
echo "Compara (==) el contenido de un booleano con un entero y devuelve " . ($bool == $int) . "<br><br>";  // devuelve 1
echo "Compara (===) el contenido de dos variables y ve si coinciden sus tipos. "
. "Como no coinciden devuelve cadena vacía " . ($bool === $int) . "<br><br>";  // devuelve cadena vacía
echo "La comparación con === del ejemplo anterior (resultado False) al convertirla"
. " en entero muestra " . (int) ($bool === $int);  // devuelve 0; sin cast devuelve la cadena vacía, el ejemplo anterior
?>

