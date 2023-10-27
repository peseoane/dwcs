<?php

/* si va bien redirige a principal.php 
  si va mal, mensaje de error */
if ($_POST['usuario'] === "pepe" and $_POST["clave"] === "1234") {
    header("Location:4_bienvenido.html");
} else {
    header("Location:4_error.html");
} 