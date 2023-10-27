<?php

//           http://localhost/validacionFormularios/15_ctype_digit.php?edad=10
//           http://localhost/validacionFormularios/15_ctype_digit.php?edad=10.5
//           http://localhost/validacionFormularios/15_ctype_digit.php?edad=10,5
// ctype_digit comprueba dígito a dígito que sea un número, por lo que no acepta
// el formato decimal al aparecer un punto o coma

$valido = array();
// comprueba si la edad es un número entero
if (ctype_digit($_GET['edad'])) {
    $valido['edad'] = trim($_GET['edad']);
    echo $valido['edad']. " contiene sólo números enteros";
} else
    die('ERROR: La edad no es un entero.');  
?> 

