<?php
$var="https://www.curso™§℗PHP.co�®m";
echo "La url original $var original<br><br>";
echo "Tras validar la url ".filter_var($var, FILTER_SANITIZE_URL);
?> 