<?php
declare(strict_types=1);
require_once "dbUtils.php";

$pdo = (new dbUtils(".db"))->getPdo();

function getChefs(PDO $pdo, int $codigo)
{
    $sqlSentence = "SELECT chef.codigo,
                           chef.nombre,
                           chef.apellido1,
                           chef.apellido2,
                           chef.nombreartistico,
                           chef.sexo,
                           chef.fecha_nacimiento,
                           chef.localidad
    FROM chef WHERE codigo = :chef_codigo";
    $stmt = $pdo->prepare($sqlSentence);
    $stmt->execute(["chef_codigo" => $codigo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST["chef_codigo"])) {
    $chef = getChefs($pdo, (int)$_POST["chef_codigo"]);
} elseif (isset($_GET["chef_codigo"])) {
    $chef = getChefs($pdo, (int)$_GET["chef_codigo"]);
}

if (isset ($_POST["delete"])) {
    $sqlSentence = "DELETE FROM chef WHERE codigo = :chef_codigo";
    $stmt = $pdo->prepare($sqlSentence);
    $stmt->execute(["chef_codigo" => $_POST["chef_codigo"]]);
    header("Location: assignment-2.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recetas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>EDITAR CHEF</h1>
<form action="chefs.php" method="post">
    <label for="chef_codigo">Código
        <input type="text" name="chef_codigo" value="<?= $chef["codigo"] ?>" readonly
    </label>
    <br>
    <label for="chef_nombre">Nombre
        <input type="text" name="chef_nombre" value="<?= $chef["nombre"] ?>">
    </label>
    <br>
    <label for="chef_apellido1">Primer apellido
        <input type="text" name="chef_apellido1" value="<?= $chef["apellido1"] ?>"></label>
    <label for="chef_apellido2">Segundo apellido
        <input type="text" name="chef_apellido2" value="<?= $chef["apellido2"] ?>"><br></label>
    <label for="chef_nombreartistico">Nombre artístico
        <input type="text" name="chef_nombreartistico" value="<?= $chef["nombreartistico"] ?>"><br></label>
    <label for="chef_sexo">Sexo
        <select name="chef_sexo">
            <option value="H" <?= $chef["sexo"] === "H" ? "selected" : "" ?>>Hombre</option>
            <option value="M" <?= $chef["sexo"] === "M" ? "selected" : "" ?>>Mujer</option>
        </select><br></label>
    <label for="chef_fecha_nacimiento">Fecha de nacimiento
        <input type="date" name="chef_fecha_nacimiento" value="<?= $chef["fecha_nacimiento"] ?>"><br></label>
    <label for="chef_localidad">Localidad
        <input type="text" name="chef_localidad" value="<?= $chef["localidad"] ?>"><br></label>
    <input type="submit" value="Actualizar" >
    <input type="submit" value="Eliminar" name="delete" >
</form>
<a href="assignment-2.php">Volver</a>
</body>
</html>