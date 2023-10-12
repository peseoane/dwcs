<HTML>
<HEAD>
    <TITLE>Funciones para Variables</TITLE>
</HEAD>
<BODY>
<CENTER>
    <H2>Usando isset(), unset() y empty()</H2>
    <?php
    $cadena; //definimos la variable pero no la inicializamos.
    echo '$cadena ';
    echo (isset($cadena))?'está ':'no está ';
    echo "inicializada<BR>";
    echo (empty($cadena))?'$cadena está vacía':$cadena;
    echo "<BR><BR>";
    $cadena="";
    echo '$cadena ';
    echo (isset($cadena))?'está ':'no está ';
    echo "inicializada<BR>";
    echo (empty($cadena))?'$cadena está vacía':$cadena;
    echo "<BR><BR>";
    $cadena="3.1416 es el valor de PI";
    echo '$cadena ';
    echo (isset($cadena))?'está ':'no está ';
    echo "inicializada<BR>";
    echo (empty($cadena))?'$cadena está vacía':$cadena;
    echo "<BR><BR>";
    unset($cadena);
    echo '$cadena ';
    $cadena = "pepe";
    echo (isset($cadena))?'está ':'no está ';
    echo "inicializada<BR>";
    echo (empty($cadena))?'$cadena está vacía':$cadena;
    ?>
</CENTER>
</BODY>
</HTML>