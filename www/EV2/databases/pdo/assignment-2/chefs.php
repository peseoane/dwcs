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
    try {
        $pdo->beginTransaction();

        $sqlSentence = "DELETE FROM receta_ingrediente WHERE cod_receta IN (SELECT codigo FROM receta WHERE cod_chef = :chef_codigo)";
        $stmt = $pdo->prepare($sqlSentence);
        $stmt->execute(["chef_codigo" => $_POST["chef"]["codigo"]]);

        $sqlSentence = "DELETE FROM receta WHERE cod_chef = :chef_codigo";
        $stmt = $pdo->prepare($sqlSentence);
        $stmt->execute(["chef_codigo" => $_POST["chef"]["codigo"]]);

        $sqlSentence = "DELETE FROM libro WHERE cod_chef = :chef_codigo";
        $stmt = $pdo->prepare($sqlSentence);
        $stmt->execute(["chef_codigo" => $_POST["chef"]["codigo"]]);

        $sqlSentence = "DELETE FROM chef WHERE codigo = :chef_codigo";
        $stmt = $pdo->prepare($sqlSentence);
        $stmt->execute(["chef_codigo" => $_POST["chef"]["codigo"]]);

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
    header("Location: assignment-2.php");
}

if (isset($_POST["update"])) {
    $sqlSentence = "UPDATE chef SET nombre = :nombre,
                                    apellido1 = :apellido1,
                                    apellido2 = :apellido2,
                                    nombreartistico = :nombreartistico,
                                    sexo = :sexo,
                                    fecha_nacimiento = :fecha_nacimiento,
                                    localidad = :localidad
                    WHERE codigo = :codigo";
    $stmt = $pdo->prepare($sqlSentence);
    $stmt->execute($_POST["chef"]);
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
<form action="chefs.php" method="post" onsubmit="confirmDelete()">
    <label for="chef[codigo]">Código
        <input type="text" name="chef[codigo]" value="<?= $chef["codigo"] ?>" readonly
    </label>
    <br>
    <label for="chef[nombre]">Nombre
        <input type="text" name="chef[nombre]" value="<?= $chef["nombre"] ?>">
    </label>
    <br>
    <label for="chef[apellido1]">Primer apellido
        <input type="text" name="chef[apellido1]" value="<?= $chef["apellido1"] ?>"></label>
    <label for="chef[apellido2]">Segundo apellido
        <input type="text" name="chef[apellido2]" value="<?= $chef["apellido2"] ?>"><br></label>
    <label for="chef[nombreartistico]">Nombre artístico
        <input type="text" name="chef[nombreartistico]" value="<?= $chef["nombreartistico"] ?>"><br></label>
    <label for="chef[sexo]">Sexo
        <select name="chef[sexo]">
            <option value="H" <?= $chef["sexo"] === "H" ? "selected" : "" ?>>Hombre</option>
            <option value="M" <?= $chef["sexo"] === "M" ? "selected" : "" ?>>Mujer</option>
        </select><br></label>
    <label for="chef[fecha_nacimiento]">Fecha de nacimiento
        <input type="date" name="chef[fecha_nacimiento]" value="<?= $chef["fecha_nacimiento"] ?>"><br></label>
    <label for="chef[localidad]">Localidad
        <input type="text" name="chef[localidad]" value="<?= $chef["localidad"] ?>"><br></label>
    <input type="submit" value="Actualizar" name="update">
    <input type="submit" value="Eliminar" name="delete" onclick="showMessage();">
</form>
<a href="assignment-2.php">Volver</a>
</body>

<script>
    function confirmDelete() {
        return confirm("¿Estás seguro de que quieres eliminar este chef y todas sus recetas?");
    }

    function showMessage() {
        let message = document.createElement("div");
        message.textContent = "El chef y todas sus recetas han sido eliminados.";
        document.body.appendChild(message);
        setTimeout(function () {
            document.body.removeChild(message);
        }, 4000);
    }
</script>

</html>