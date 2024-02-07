<?php

class Clase_Celda
{

    public $celda_alin_vertical;
    var $celda_alin_horizontal;
    var $celda_color_fondo;
    var $letra_tipo;
    var $letra_tamano;
    var $letra_color;

    function pinta_celda($contenido)
    {
        $aux = "<td
        align='$this->celda_alin_horizontal'
        valign='$this->celda_alin_vertical'
        bgcolor='$this->celda_color_fondo'>"
        . "<font  face='$this->letra_tipo' 
        size='$this->letra_tamano' 
        color='$this->letra_color'>$contenido</font></td>";
    return $aux;
    }

}

$fila1 = new Clase_Celda();
$fila1->celda_alin_vertical = 'middle';
$fila1->celda_alin_horizontal = 'center';
$fila1->celda_color_fondo = 'orange';

$fila1->letra_tipo = 'Arial';
$fila1->letra_tamano = '10';
$fila1->letra_color = 'white';

echo "<table border='0'><tr>" . $fila1->pinta_celda('PHP') . $fila1->pinta_celda('8') . "</tr></table>";
?>