<?php

$email = "usuario@empresa.com"; 
//$email = "usuario@empresa";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //Devuelve los datos filtrados o FALSE si el filtrado falla
    echo "El email $email correcto " . '<br>';
} else {
    echo "El email $email no es correcto" . '<br>';
}
?> 