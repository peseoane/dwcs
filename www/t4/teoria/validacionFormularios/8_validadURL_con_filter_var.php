<?php

$dirweb="https://www.edu.xunta.gal/centros/iesteis/";

echo "La dirección web $dirweb es ";
echo filter_var($dirweb, FILTER_VALIDATE_URL)? "válida" : "inválida";

$dirweb="Ejemplo.com";
echo ".<br> La dirección web $dirweb es ";
echo filter_var($dirweb, FILTER_VALIDATE_URL)? "válida" : "inválida";

$dirweb="www.Ejemplo.com";
echo ".<br> La dirección web $dirweb es ";
echo filter_var($dirweb, FILTER_VALIDATE_URL)? "válida" : "inválida";

$dirweb="ftp://directorio_a_subir.com";
echo ".<br> La dirección web $dirweb es ";
echo filter_var($dirweb, FILTER_VALIDATE_URL)? "válida" : "inválida";

?> 

