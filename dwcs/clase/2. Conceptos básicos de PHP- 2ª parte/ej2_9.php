<?php

// definición y uso de constantes
define('CURSO', 'Curso de PHP');
define('EDICION', 7);
// salida: 'Bienvenido al Curso de PHP (edición 4)'
echo 'Bienvenido al ' . CURSO . ' (edición ' . EDICION . ')';   // sin $ pq son ctes, no variables
?>
