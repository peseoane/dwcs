<?php
echo "<h1>Página de prueba</h1><p>Probando a generar algo de boilerplate sin MVC</p>"
?>

<form method="post">
    <input type="number" name="number"/>
    <input type="submit" value="Calculate factorial"/>
</form>

<?php
if (isset($_POST['number'])) {
    $result = 1;
    for ($i = 1; $i <= $_POST['number']; $i++) {
        $result *= $i;
    }
    echo "<p>Factorial = " . $_POST['number'] . " es " . $result . "</p>";
}
?>
