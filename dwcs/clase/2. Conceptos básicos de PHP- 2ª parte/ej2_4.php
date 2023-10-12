<?php

$coche = 'Ferrari';
echo "Antes de unset(), mi coche es un $coche<br>";
// Elimina la variable. Ya no cuenta como inicializada
unset($coche);
echo "Tras unset(), mi coche es un $coche";
?>
