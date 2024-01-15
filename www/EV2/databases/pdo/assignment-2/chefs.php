<?php
declare(strict_types=1);
require_once "dbUtils.php";

$pdo = (new dbUtils(".db"))->getPdo();

function getChefs(PDO $pdo, int $codigo)
{
    try {
        $sqlSentence = "SELECT chef.codigo,
                           chef.nombre,
                           chef.apellido1,
                           chef.apellido2,
                           chef.nombreartistico,
                           chef.sexo,
                           chef.fecha_nacimiento,
                           chef.localidad,
                           chef.cod_provincia,
                           provincia.nombre as provincia
    FROM chef 
    JOIN provincia ON chef.cod_provincia = provincia.codigo
    WHERE chef.codigo = :chef_codigo";
        $stmt = $pdo->prepare($sqlSentence);
        $stmt->execute(["chef_codigo" => $codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("ERROR: " . $e->getMessage() . "\n");
        throw $e; // No tiene sentido continuar si no podemos obtener los datos del chef
    } finally {
        error_log("ALARM: shutdown due to DB trashing");
    }

}

function getProvinces(PDO $pdo)
{
    try {
        $sqlSentence = "SELECT * FROM provincia";
        $stmt = $pdo->prepare($sqlSentence);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("ERROR: " . $e->getMessage() . "\n");
        throw $e; // No tiene sentido continuar si no podemos obtener los datos del chef
    } finally {
        error_log("ALARM: shutdown due to DB trashing");
    }
}

$provinces = getProvinces($pdo);

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
        error_log("ERROR: " . $e->getMessage() . "\n");
        throw $e;
    } finally {
        error_log("WARN: Se ha ejecutado un DELETE");
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
                                    localidad = :localidad,
                                    cod_provincia = :cod_provincia
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
<table class="edicion">
    <form action="chefs.php" method="post" onsubmit="confirmDelete()">
        <tr>
            <td>
                <label for="chef[codigo]">Código
                    <input type="text" name="chef[codigo]" value="<?= $chef["codigo"] ?>" readonly>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="chef[nombre]">Nombre
                    <input type="text" name="chef[nombre]" value="<?= $chef["nombre"] ?>">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="chef[apellido1]">Primer apellido
                    <input type="text" name="chef[apellido1]" value="<?= $chef["apellido1"] ?>">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="chef[apellido2]">Segundo apellido
                    <input type="text" name="chef[apellido2]" value="<?= $chef["apellido2"] ?>">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="chef[nombreartistico]">Nombre artístico
                    <input type="text" name="chef[nombreartistico]" value="<?= $chef["nombreartistico"] ?>">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="chef[sexo]">Sexo
                    <select name="chef[sexo]">
                        <option value="H" <?= $chef["sexo"] === "H" ? "selected" : "" ?>>Hombre</option>
                        <option value="M" <?= $chef["sexo"] === "M" ? "selected" : "" ?>>Mujer</option>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="chef[fecha_nacimiento]">Fecha de nacimiento
                    <input type="date" name="chef[fecha_nacimiento]" value="<?= $chef["fecha_nacimiento"] ?>">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="chef[localidad]">Localidad
                    <input type="text" name="chef[localidad]" value="<?= $chef["localidad"] ?>">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Actualizar" name="update">
                <input type="submit" value="Eliminar" name="delete" onclick="showMessage();">
            </td>
        </tr>

        <tr>
            <td>
                <label for="chef[cod_provincia]">Provincia
                    <select name="chef[cod_provincia]">
                        <?php foreach ($provinces as $province): ?>
                            <option value="<?= $province["codigo"] ?>" <?= $chef["cod_provincia"] === $province["codigo"] ? "selected" : "" ?>><?= $province["nombre"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </td>
        </tr>

    </form>
</table>
<a href="assignment-2.php">Volver</a>

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

</body>
</html>