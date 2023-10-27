<!DOCTYPE HTML>
<html>
<head>
    <title>Formulario con campos obligatorios</title>
</head>
<body>
<?php
include "3_funciones.php";
/*
 * nombre 	Obligatorio.
 * email 	Obligatorio. Debe contener una dirección email
 * website 	Opcional. Si se proporciona, debe contener una URL
 * comentario 	Opcional. Campo de tipo textarea (multilínea)
 * genero 	Obligatorio. Se debe seleccionar uno
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Campos obligatorios
    $oblig = array('nombre', 'email', 'genero');
    // Comprobamos que ninguno de los campos obligatorios recibidos esté vacío
    $error = false;
    foreach ($oblig as $campo) {
        if (empty($_POST[$campo]))
            $error = true;
    }
    if ($error) {
        // No existe alguno de los campos obligatorios
        echo "Falta alguno de los campos obligatorios";
    } else {
        $nombre = test_input($_POST["nombre"]);
        $email = test_input($_POST["email"]);
        $genero = test_input($_POST["genero"]);
        if (empty($_POST["comentario"])) {
            $comentario = "";
        } else {
            $comentario = test_input($_POST["comentario"]);
        }
        if (empty($_POST["website"])) {
            $website = "";
        } else {
            $website = test_input($_POST["website"]);
        }
        echo ($genero == "mujer") ? "Bienvendia Sra. " : "Bienvenido Sr. ";
        echo "$nombre, su email es $email";
        if (!empty($comentario)) {
            echo "<br>Su comentarios $comentario";
        }
        if (!empty($website)) {
            echo "<br>Su sitio web es $website";
        }
    }
} else {
    ?>
    <h2>Ejemplo de PHP de validación de formulario</h2>
    <p>* campo obligatorio</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        Nombre: <input type="text" name="nombre" value="<?php if (isset($nombre))
            echo $nombre; ?>">
        <br><br>
        E-mail:
        <input type="text" name="email" value="<?php if (isset($email))
            echo $email; ?>">
        <br><br>
        Website:
        <input type="text" name="website" value="<?php if (isset($website))
            echo $website; ?>">
        <br><br>
        Comentarios: <textarea name="comentario" rows="5" cols="40" value="<?php if (isset($comentario))
            echo $comentario; ?>"></textarea>
        <br><br>
        Género:
        <input type="radio" name="genero" <?php if (isset($genero) && $genero == "mujer")
            echo "checked"; ?>
               value="mujer">Mujer
        <input type="radio" name="genero" <?php if (isset($genero) && $genero == "hombre")
            echo "checked"; ?>
               value="hombre">Hombre
        <br><br>
        <input type="submit" name="submit" value="Enviar">

    </form>
    <?php
}
?>
</body>
</html>