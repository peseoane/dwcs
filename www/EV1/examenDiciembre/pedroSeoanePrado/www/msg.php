<?php
declare(strict_types=1);

require './Utils.php';

session_start();

if (!$_SESSION['auth']){
    echo "Error al iniciar, motivo :" . $_SESSION['msg'];
    echo "Usados...  " . $_SESSION['intentos'] .  " de 3 intentos";
} else {
    echo "ESTADO: " . $_SESSION['msg'];
}