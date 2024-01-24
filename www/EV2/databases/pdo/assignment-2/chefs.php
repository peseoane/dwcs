<?php
declare(strict_types=1);
require_once "dbUtils.php";

/*
 * We're going to use this function to get the chef by its ID because:
 * 1. We need to use it in the POST and GET methods, chefs can be accesed by both methods, remember the main page!
 * 2. We don't like to repeat code!
 */
function getChefByID(int $code)
{
    $sqlParam = ["chef_codigo" => $code];
    $sqlSentence = "SELECT chef.codigo,
                           chef.nombre,
                           chef.apellido1,
                           chef.apellido2,
                           chef.nombreartistico, 
                           chef.sexo, 
                           chef.fecha_nacimiento, 
                           chef.localidad,
                           chef.cod_provincia, 
                           provincia.nombre 
      FROM chef 
      JOIN provincia ON chef.cod_provincia = provincia.codigo
      WHERE chef.codigo = :chef_codigo";
    return dbUtils::getInstance()->runQueryAssoc($sqlSentence, $sqlParam)[0];
}

/*
 * Return can be false!
 * Also... as you see once implemented we can start enjoying the benefits of the singleton pattern and oneliners!
 * Because we moved all the logic and error handling flow to the dbUtils class.
 */
function getProvinces(): array|false
{
    return dbUtils::getInstance()->runQueryAssoc("SELECT * FROM provincia");
}

/*
 * If you ask why this is a function for just ONE call, let me tell you... CACHE!
 */
$provinces = getProvinces();

/*
 * Keep in mind that all the received data from a form is a String, so we need to cast it to the correct type.
 */
if (isset($_POST["chef_codigo"])) {
    $chef = getChefByID((int) $_POST["chef_codigo"]);
} elseif (isset($_GET["chef_codigo"])) {
    $chef = getChefByID((int) $_GET["chef_codigo"]);
}

/*
 * Due to the DB not having a cascade delete, we need to delete the recipes first and then the chef etc...
 * So, we need to create a transaction, but we're ussing a method from the dbUtils class, so we just pass an array
 * of SQL sentences and an array of params. On this particular case we're using the same param for all the sentences.
 * But we could use different params for each sentence of course.
 */
if (isset($_POST["delete"])) {
    $sqlSentences = [
        "DELETE FROM receta_ingrediente WHERE cod_receta IN (SELECT codigo FROM receta WHERE cod_chef = :chef_codigo)",
        "DELETE FROM receta WHERE cod_chef = :chef_codigo",
        "DELETE FROM libro WHERE cod_chef = :chef_codigo",
        "DELETE FROM chef WHERE codigo = :chef_codigo",
    ];
    $param = ["chef_codigo" => $_POST["chef"]["codigo"]];
    $res = dbUtils::getInstance()->runTransactions($sqlSentences, [
        $param,
        $param,
        $param,
        $param,
    ]);

    /*
     * Remember when the called method was implemented with an array | false return type?
     * Well, we can use it to check if the transaction was successful or not!
     */
    if ($res) {
        header("Location: assignment-2.php");
    } else {
        error_log(
            "Error deleting chef and its recipes, BAD TRANSACTION ROLLBACK..."
        );
    }
}

/*
 * Since our form uses an associative array, we can use the same array to update the chef.
 * You just need to keep a close track of the names of the inputs to be the same as the names of the columns in the DB.
 * This way, you can use the same array to update the chef, no manual mapping needed!
 */
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
    $param = $_POST["chef"];
    $res = dbUtils::getInstance()->runQueryAssoc($sqlSentence, $param);
    if (!$res) {
        error_log("Error updating chef...");
    }
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
          <input type="text" name="chef[codigo]" value="<?= $chef[
              "codigo"
          ] ?>" readonly>
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
          <input type="text" name="chef[apellido1]" value="<?= $chef[
              "apellido1"
          ] ?>">
        </label>
      </td>
    </tr>
    <tr>
      <td>
        <label for="chef[apellido2]">Segundo apellido
          <input type="text" name="chef[apellido2]" value="<?= $chef[
              "apellido2"
          ] ?>">
        </label>
      </td>
    </tr>
    <tr>
      <td>
        <label for="chef[nombreartistico]">Nombre artístico
          <input type="text" name="chef[nombreartistico]" value="<?= $chef[
              "nombreartistico"
          ] ?>">
        </label>
      </td>
    </tr>
    <tr>
      <td>
        <label for="chef[sexo]">Sexo
          <select name="chef[sexo]">
            <option value="H" <?= $chef["sexo"] === "H"
                ? "selected"
                : "" ?>>Hombre</option>
            <option value="M" <?= $chef["sexo"] === "M"
                ? "selected"
                : "" ?>>Mujer</option>
          </select>
        </label>
      </td>
    </tr>
    <tr>
      <td>
        <label for="chef[fecha_nacimiento]">Fecha de nacimiento
          <input type="date" name="chef[fecha_nacimiento]" value="<?= $chef[
              "fecha_nacimiento"
          ] ?>">
        </label>
      </td>
    </tr>
    <tr>
      <td>
        <label for="chef[localidad]">Localidad
          <input type="text" name="chef[localidad]" value="<?= $chef[
              "localidad"
          ] ?>">
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
                <option
                  value="<?= $province["codigo"] ?>" <?= $chef[
    "cod_provincia"
] === $province["codigo"]
    ? "selected"
    : "" ?>><?= $province["nombre"] ?></option>
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
    setTimeout(function() {
      document.body.removeChild(message);
    }, 4000);
  }
</script>

</body>
</html>