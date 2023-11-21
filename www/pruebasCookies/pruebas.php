<?php
$cook1 = setcookie("dato","info...");
$cook2 = setcookie("dato2","info2...",time()+3600);
$cook3 = setcookie("rol1","admin",time()+3600,"/pruebasCookies");
if ($cook1 && $cook2) {
    echo "Cookies creadas correctamente";
} else {
    echo "Error en la creación de cookies";
}

var_dump($_COOKIE);
var_dump($_REQUEST);