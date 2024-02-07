<?php

//Ejecutarlo paso a paso

/*
 * eval ( string $code ) : mixed
 * La cadena de caracteres que se le pasa a la función eval se evalúa como código
 * PHP. Es un constructor de lenguaje muy peligroso especialmente si recibimos datos
 * de terceros no confiables. La string que se le pasa debe estar bien definida pero
 * no lleva las etiquetas de inicio y cierre de PHP. En general se desaconseja su uso.
 * eval() devuelve NULL a menos que se llame a return en el código evaluado, en cuyo 
 * caso el valor pasado a return es devuelto. A partir de PHP 7, si hay un error 
 * de análisis en el código evaluado, eval() lanzará una excepción ParseError. 
 */

//Esta clase no tiene propiedades

class Clase_Creacion_Prop_No_Declaradas {

    function __set($nombre_var, $valor) {
        eval('$this->' . "$nombre_var='$valor';");
    }

    function __get($nombre_var) {
// Este eval ejecutara el __set() pasándole una cadena vacía en el 2º parámetro
        eval('$this->' . "$nombre_var='';");
    }

}

try {
    $o = new Clase_Creacion_Prop_No_Declaradas();
//Intento dar valor a una propiedad que no existe y por tanto se ejecuta __set()
    $o->prop_inexistente = 'valor1';
    echo "Tras crear la variable la puedo visualizar con el siguiente valor " . $o->prop_inexistente;
// La siguiente sentencia no es atrapada por __set() porque ya existe y por tanto se 
// le puede dar valor directamente al ser pública
    $o->prop_inexistente = 'valor2';
//Puedo visualizar sin problema
    echo "<br>He cambiado el valor: $o->prop_inexistente<br />";
    /*
     * Como hay un echo() llama a __get() para intentar visualizar la nueva propiedad 
     * (otra_inexistente). 
     * Dentro del __get() se llama a su vez a __set() pues queremos acceder una 
     * variable que no existe y darle un valor (de ahí que llame al __set()), 
     * que en este caso es una cadena vacía.
     */
    echo "Ahora voy intentar mostrar otra variable inexistente $o->otra_inexistente<br />";
    // La siguiente sentencia ya no es atrapada por __set()  porque ya se creó
    $o->otra_inexistente = 'Valor de la propiedad otra_inexistente';
    // tampoco pasa por __set()
    echo "Visualización sin problemas del contenido de la nueva propiedad otra_inexistente ($o->otra_inexistente)<br />";
} catch (ParseError $e) {
    echo "<br>Hubo un error en la creación de la sentencia " . $e->getMessage();
}
?>
