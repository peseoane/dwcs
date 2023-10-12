<HTML>
 <HEAD>
   <TITLE>Trabajando con Matrices</TITLE>
 </HEAD>
 <BODY>
   <CENTER>
     <H2>Arrays <I>multidimensionales</I></H2>
     <?php
       $matriz1[0]['moneda'] = "franco";
       $matriz1[0]['cambio'] = 1.09;
       $matriz1[1]['moneda'] = "dolar";
       $matriz1[1]['cambio'] = 0.96;

       $matriz2[0]=array("moneda"=>"franco","cambio"=>1.09);
       $matriz2[1]=array("moneda"=>"dolar","cambio"=>0.96);

       $matriz3 = array(array("moneda"=>"franco","cambio"=>1.09),
                        array("moneda"=>"dolar","cambio"=>0.96));
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
               echo "<TD BGCOLOR='yellow'>\$matriz1</TD>";
               echo "<TD>".$matriz1[$i]['moneda']."</TD>";
               echo "<TD>".$matriz1[$i]['cambio']."</TD>";
               echo "</TR>";
           }
           for($i=0;$i<2;$i++){
               echo "<TR ALIGN='center'>";
               echo "<TD BGCOLOR='yellow'>\$matriz2</TD>";
               echo "<TD>".$matriz2[$i]['moneda']."</TD>";
               echo "<TD>".$matriz2[$i]['cambio']."</TD>";
               echo "</TR>";
           }
           for($i=0;$i<2;$i++){
               echo "<TR ALIGN='center'>";
               echo "<TD BGCOLOR='yellow'>\$matriz3</TD>";
               echo "<TD>".$matriz3[$i]['moneda']."</TD>";
               echo "<TD>".$matriz3[$i]['cambio']."</TD>";
               echo "</TR>";
           }
       ?>
     </TABLE>
   </CENTER>
 </BODY>
</HTML>
