<HTML>
    <HEAD>
        <TITLE>Trabajando con Matrices</TITLE>
    </HEAD>
    <BODY>
    <CENTER>
        <H2>Arrays función <I>array_merge</I></H2>


        <?php
        /*
          Combina los elementos de uno o más arrays juntándolos de modo que los valores
         * de uno se anexan al final del anterior. Retorna el array resultante.
          Si los arrays de entrada tienen las mismas claves de tipo string, el 
         * último valor para esa clave sobrescribirá al anterior. Sin embargo, 
         * los arrays que contengan claves numéricas, el último valor no 
         * sobrescribirá el valor original, sino que será añadido al final.
         */
        $matriz1 = array("altura" => "10", "anchura" => "15", "unidad" => "cm");
        $matriz2 = array("1", "2", "3");
        $matriz3 = array("100", "300", "unidad" => "px", "moneda" => "euro", 500);
        $matrizM = array_merge($matriz1, $matriz2, $matriz3);

        echo "<TABLE BORDER='0' CELLPADDING='2' CELLSPACING='2'>\n";
        echo " <TR ALIGN='center'>\n";
        for ($j = 1; $j < 4; $j++) {
            $matriz = "matriz" . $j;
            echo "    <TD>$matriz\n";
            echo "      <TABLE BORDER='1' CELLPADDING='2' CELLSPACING='2'>\n";
            echo "        <TR ALIGN='center' BGCOLOR='yellow'>\n";
            reset($$matriz);
            do {
                echo "<TD>" . key($$matriz) . "</TD>";
            } while (next($$matriz));
            echo "        </TR>\n";
            echo "        <TR ALIGN='center'>\n";
            reset($$matriz);
            do {
                echo "<TD>" . current($$matriz) . "</TD>";
            } while (next($$matriz));
            echo "        </TR>\n";
            echo "      </TABLE>\n";
            echo "    </TD>\n";
        }
        echo "  </TR>\n";
        echo " <TR><TD COLSPAN='3'><BR></TD></TR>";
        echo " <TR ALIGN='center'>\n";
        echo "    <TD COLSPAN='3'>array_merge(matriz1,matriz2,matriz3)\n";
        echo "      <TABLE BORDER='1' CELLPADDING='2' CELLSPACING='2'>\n";
        echo "        <TR ALIGN='center' BGCOLOR='yellow'>\n";
        do {
            echo "<TD>" . key($matrizM) . "</TD>";
        } while (next($matrizM));
        echo "        </TR>\n";
        echo "        <TR ALIGN='center'>\n";
        reset($matrizM);
        do {
            echo "<TD>" . current($matrizM) . "</TD>";
        } while (next($matrizM));
        echo "        </TR>\n";
        echo "      </TABLE>\n";
        echo "    </TD>\n";
        echo "  </TR>\n";
        echo "</TABLE>\n";
        ?>
    </CENTER>
</BODY>
</HTML>
