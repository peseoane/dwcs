<?php

try {
// Comprobamos si existe el elemento en el array $_FILES 
    if (!isset($_FILES['imagen']['error'])) {
        throw new RuntimeException('Se produjo un error en el envío del fichero.');
    }
// Comprobamos que el código del error sea UPLOAD_ERR_OK 
    switch ($_FILES['imagen']['error']) {
        case UPLOAD_ERR_OK: break; // Todo correcto 
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No se recibió el archivo.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Tamaño del archivo demasiado grande.');
        default: throw new RuntimeException('Error desconocido.');
    }
// Comprobamos el tamaño de la imagen
    if ($_FILES['imagen']['size'] > 5000000) {
        throw new RuntimeException('Tamaño del archivo demasiado grande.');
    }

    /* Las funcioness del módulo Fileinfo tratan de averiguar el tipo de contenido y 
     * la codificación de un archivo buscando ciertas secuencias de bytes mágicas en
     * una posición específica del mismo. Es necesario descomentar en php.ini la linea 
     * extension=fileinfo
     * Empleamos la extensión Fileinfo para comprobar que el tipo MIME sea correcto.
     * La constante predefinida FILEINFO_MIME_TYPE (entero) devuelve el tipo mime.
     * finfo_open Crea un nuevo recurso fileinfo
     */

    $finfo = finfo_open(FILEINFO_MIME_TYPE);

//finfo_file Devuelve información sobre un archivo
    $ext = array_search(finfo_file($finfo, $_FILES['imagen']['tmp_name']), array('jpg' => 'image/jpeg',
        'png' => 'image/png', 'gif' => 'image/gif')
    );
    finfo_close($finfo);
// Si no es una imagen, terminamos 
    if ($ext === false) {
        throw new RuntimeException('Imagen non reconocida.');
    }
// Renombramos y movemos la imagen recibida a su localización definitiva
    $res = move_uploaded_file($_FILES['imagen']['tmp_name'], './upload/foto.' . $ext);
    if (!$res) {
        throw new RuntimeException('La imagen no pudo ser cambiada de directorio.');
    }
    echo 'Imagen subida correctamente.';
} catch (RuntimeException $e) {
    echo $e->getMessage();
}
?>