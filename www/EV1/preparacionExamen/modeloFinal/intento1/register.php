<?php
declare(strict_types=1);

require "utils.php";
function addToSession(string $key, $value): void
{
    $_SESSION[$key][] = $value;
}


session_start();
if (isset($_POST['regEmail']) && isset($_POST['regPassword'])) {

    /*
          if (existsUser($localUser->getEmail(), $localUser->getHashedPassword())) {
          $status = false;
        } else {

     */

    try {
        $localUser = new User(normaliceFormField($_POST['regEmail']), normaliceFormField($_POST['regPassword']));

        $status = true;
        addToSession("registerUsers", $localUser);
        setcookie("user",serialize($localUser), time() + 3600);
        unset($_POST['regEmail']);
        unset($_POST['regPassword']);

    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        var_dump($e->getMessage());
    }
} if (isset($_POST['submitPhoto'])) {
    $target_dir = "uploads/";
    $uploadOk = 1;
    $status = true;

    // Check if directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Obtenemos el índice del usuario
    $index = getUserIndex(unserialize($_COOKIE['user']));

    // Iteramos sobre cada imagen
    foreach ($_FILES["fileToUpload"]["tmp_name"] as $key => $tmp_name) {
        $target_file = $target_dir . uniqid() . '.' . strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"][$key]), PATHINFO_EXTENSION));
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Resto del código para verificar y mover el archivo

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $status = false;
        } else {
            if (move_uploaded_file($tmp_name, $target_file) && $status) {
                // Guardamos la ruta de la imagen en la estructura de datos del usuario
                $_SESSION['registerUsers'][$index]->setPath($target_file);
                $status = true;
            } else {
                $status = false;
            }
        }
    }

    // Actualizamos el usuario en la sesión
    updateUser($_SESSION['registerUsers'][$index]);

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examen</title>
    <meta author="Pedro Seoane">
</head>
<body>

<?php if ($status) {
    echo "<h1>Usuario registrado correctamente</h1>";
    echo "<p>Añada la foto de perfil</p>";
    echo "<form action=" . normaliceFormField($_SERVER['PHP_SELF']) . " method='post' enctype='multipart/form-data'>";
    echo "<label for='fileToUpload'>Seleccione la foto de perfil</label>";
    echo "<input type='file' name='fileToUpload[]' id='fileToUpload' multiple>";
    echo "<br>";
    echo "<input type='submit' value='Upload Image' name='submitPhoto'>";
    echo "</form>";
} else {
    echo "<h1>El usuario ya existe</h1>";
    var_dump($_SESSION['registerUsers']);
} ?>
}