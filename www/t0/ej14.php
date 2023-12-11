<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dar Vuelta a un String Recursivamente</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Dar Vuelta a un String Recursivamente</h1>

<form method="post" action="">
    <label for="input_string">Ingrese un texto:</label>
    <input type="text" id="input_string" name="input_string" required><br>

    <input type="submit" value="Invertir">
</form>

<?php
function reverse_string_recursive($str)
{
    if (mb_strlen($str, "UTF-8") <= 1) {
        return $str;
    } else {
        return reverse_string_recursive(mb_substr($str, 1, null, "UTF-8")) .
            mb_substr($str, 0, 1, "UTF-8");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_string = $_POST["input_string"];
    $reversed_string = reverse_string_recursive($input_string);

    echo "<p>Texto original: " .
        htmlspecialchars($input_string, ENT_QUOTES, "UTF-8") .
        "</p>";
    echo "<p>Texto invertido: " .
        htmlspecialchars($reversed_string, ENT_QUOTES, "UTF-8") .
        "</p>";
}
?>
</body>
</html>