<?php

$p = 10;
$q = 11;
$r = 11.3;
$s = 11;
echo "$q>$p es " . ($q > $p) . "<br>";  // cierto: muestra 1
echo "$q<$p es " . ($q < $p) . "<br>";  // falso: Como convierte a string la condición, muestra cadena vacía
echo "$q>=$s es " . ($q >= $s) . "<br>";  // cierto: muestra 1
echo "$r<=$s es " . ($r <= $s) . "<br>";   // falso: Como convierte a string la condición, muestra cadena vacía
echo "$q==$s es " . ($q == $s) . "<br>";  // cierto: muestra 1
echo "$q==$r es " . ($q == $r) . "<br>";   // falso: Como convierte a string la condición, muestra cadena vacía
echo '$q' . "=$r es " . ($q = $r) . "<br>";   // muestra el valor asignado: 11.3
echo "La variable \$a no está definida y queremos saber si vale cero con el doble igual. "
 . "La condición evaluada la considera cierta y muestra por tanto el valor de " . ($a == 0) . "<br><br>";  // muestra 1 ($a no está definida)
echo "La variable \$a no está definida y queremos saber si es idéntica a cero con el triple igual. "
. "Muestra por lo tanto que no es cierto (cadena vacía)" . ($a === 0);  // error ($a no está definida)
?>

