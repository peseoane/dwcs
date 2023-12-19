<?php
declare(strict_types=1);
require "./Utils.php";

session_start();
$dummyData = generarDatosDummy(10);

if (isset($_POST["piezaSel"])) {
    // Solo implemento finalizar.
    $_SESSION["auth"] = true;
    $_SESSION["msg"] = "Ha añadido la pieza " . $_POST["piezaSel"];
    header("Location: msg.php");
} elseif (isset($_POST["cancelar"])) {
    header("Location: index.php");
} elseif (isset($_POST["finalizar"])) {
    $_SESSION["auth"] = true;
    $_SESSION["msg"] = "Ha finalizado de añadir piezas";
    header("Location: msg.php");
}
?>

<h2>REGISTRO DE PIEZAS</h2>
<p>Selecciona la pieza</p>
<form method="POST" action=piezas.php>
    <?php foreach ($dummyData as $pieza) {
        echo "<label for name='piezaSel'>" .
            $pieza->getNombrePieza() .
            "</label>";
        echo "<input type='radio' name='piezaSel'>";
    } ?>
    <br>
    <input name="registro" type="submit" value="REGISTRAR">
    <input name="finalizar" type="submit" value="finalizar">

    <input name="cancelar" type="submit" value="CANCELAR">
</form>