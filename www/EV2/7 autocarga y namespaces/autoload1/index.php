<?php

function mi_funcion_autocarga($clase) {
    //Esta primera línea hay que incluirla porque el namespace puede ser compuesto
    //y por tanto llevar \ o / y así lo indipendizamos del Sistema operativo
    $clase = str_replace('\\', DIRECTORY_SEPARATOR, $clase);
    require_once 'clases' . DIRECTORY_SEPARATOR . $clase . '.php';
}

spl_autoload_register("mi_funcion_autocarga");

$op = new Suma();
$op->setOperando1(10);
$op->setOperando2(10);
$op->calcular();
echo 'El resultado de la suma es ' . $op->getResultado();
$opr = new Resta();
$opr->setOperando1(50);
$opr->setOperando2(10);
$opr->calcular();
echo '<br />El resultado de la resta es ' . $opr->getResultado();
?>


