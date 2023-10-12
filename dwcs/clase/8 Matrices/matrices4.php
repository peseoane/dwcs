<HTML>
 <HEAD>
   <TITLE>Trabajando con Matrices</TITLE>
 </HEAD>
 <BODY>
   <CENTER>
     <H2>Arrays <I>multidimensionales</I></H2>
     <?php
       $matriz1[0][0] = "franco";
       $matriz1[0][1] = 1.09;
       $matriz1[1][0] = "dolar";
       $matriz1[1][1] = 0.96;

       $matriz2[0] = array("franco",1.09);
       $matriz2[1] = array("dolar",0.96);

       $matriz3 = array(array("franco",1.09),
                        array("dolar",0.96)
                        );
     ?>
     <TABLE BORDER="1" CELLPADDING="2" CELLSPACING="2">
        <TR ALIGN="center" BGCOLOR="yellow">
           <TD></TD>
           <TD>Moneda</TD>
           <TD>Cambio €</TD>
       </TR>
       <?php
           for($i=0;$i<2;$i++){
               echo "<TR ALIGN='center'>";
               echo "<TD BGCOLOR='yellow'>\$matriz1[$i]</TD>";
               for($j=0;$j<2;$j++){
                   echo "<TD>".$matriz1[$i][$j]."</TD>";
               }
               echo "</TR>";
           }
           for($i=0;$i<2;$i++){
               echo "<TR ALIGN='center'>";
               echo "<TD BGCOLOR='yellow'>\$matriz2[$i]</TD>";
               for($j=0;$j<2;$j++){
                   echo "<TD>".$matriz2[$i][$j]."</TD>";
               }
               echo "</TR>";
           }
           for($i=0;$i<2;$i++){
               echo "<TR ALIGN='center'>";
               echo "<TD BGCOLOR='yellow'>\$matriz3[$i]</TD>";
               for($j=0;$j<2;$j++){
                   echo "<TD>".$matriz3[$i][$j]."</TD>";
               }
               echo "</TR>";
           }
       ?>
     </TABLE>
   </CENTER>
 </BODY>
</HTML>
