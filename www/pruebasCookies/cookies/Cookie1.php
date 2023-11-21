<?php

/*
 * setcookie() crea una cookie, la cual se envía junto con el resto de las cabeceras
 * HTTP. A igual que otras cabeceras, las cookies deben enviarse antes de producirse
 * una salida del script (esta es una restricción del protocolo). Esto significa
 * que la llamada a esta función debe ser antes de ninguna salida, incluyendo las
 * etiquetas <html> y <head> así como cualquier espacio en blanco.
 * 
 * Al crearse $cook1 no le ponemos tiempo de duración por lo que al cerrase el navegador
 * desaparece y por eso con el addon de cookies de Firefox aparece desactivada.
 * Sin embarog no ocurre lo mismo con $cook2 que se elimina pasado una hora
 */
$cook1 = setcookie('dato', 'cualquier información');
$cook2 = setcookie('email', 'patricia@cursoPHP.es', time() + 60 * 60);
if ($cook1 & $cook2)
    echo "La petición de la creación de la cookie se envió con éxito";
?>

