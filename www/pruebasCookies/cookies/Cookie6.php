<?php

//Cookies con matrices
setcookie("lista[a]", "uno");
setcookie("lista[b]", "dos");
setcookie("lista[c]", "tres");

// tras la recarga de la página, mostrarlas: 
if (isset($_COOKIE['lista'])) {
    foreach ($_COOKIE['lista'] as $nombre => $valor) {
        echo "$nombre : $valor <br />";
    }
}
?>

