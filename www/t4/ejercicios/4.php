<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['matricula'])) {
        echo 'Te has matriculado en: ' . htmlspecialchars(implode(', ', $_POST['matricula']), ENT_QUOTES, 'UTF-8');
    } else {
        echo 'No has seleccionado ninguna materia.';
    }
}
?>
<form method="post" action="">
    <label><input type="checkbox" name="matricula[]" value="Matemáticas"> Matemáticas</label>
    <label><input type="checkbox" name="matricula[]" value="Física"> Física</label>
    <label><input type="checkbox" name="matricula[]" value="Química"> Química</label>
    <input type="submit" value="Enviar">
</form>