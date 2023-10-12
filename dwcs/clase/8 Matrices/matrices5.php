<HTML>
 <HEAD>
   <TITLE>Trabajando con Matrices</TITLE>
 </HEAD>
 <BODY>
   <CENTER>
     <H2>Arrays <I>multidimensionales</I></H2>
     <?php
       $matriz1['franco']['moneda'] = "franco";
       $matriz1['franco']['cambio'] = 1.09;
       $matriz1['dolar']['moneda'] = "dolar";
       $matriz1['dolar']['cambio'] = 0.96;

       $matriz2['franco']=array("moneda"=>"franco","cambio"=>1.09);
       $matriz2['dolar']=array("moneda"=>"dolar","cambio"=>0.96);

       $matriz3 = array("franco"=>array("moneda"=>"franco","cambio"=>1.09),
                        "dolar"=>array("moneda"=>"dolar","cambio"=>0.96));
     ?>
     <TABLE BORDER="1" CELLPADDING="2" CELLSPACING="2">
        <TR ALIGN="center" BGCOLOR="yellow">
           <TD></TD>
           <TD>Moneda</TD>
           <TD>Cambio €</TD>
       </TR>
       <?php
           echo "<TR ALIGN='center'>";
           echo "<TD BGCOLOR='yellow'>\$matriz1</TD>";
           echo "<TD>".$matriz1['franco']['moneda']."</TD>";
           echo "<TD>".$matriz1['franco']['cambio']."</TD>";
           echo "</TR>";
           echo "<TR ALIGN='center'>";
           echo "<TD BGCOLOR='yellow'>\$matriz1</TD>";
           echo "<TD>".$matriz1['dolar']['moneda']."</TD>";
           echo "<TD>".$matriz1['dolar']['cambio']."</TD>";
           echo "</TR>";
           echo "<TR ALIGN='center'>";
           echo "<TD BGCOLOR='yellow'>\$matriz2</TD>";
           echo "<TD>".$matriz2['franco']['moneda']."</TD>";
           echo "<TD>".$matriz2['franco']['cambio']."</TD>";
           echo "</TR>";
           echo "<TR ALIGN='center'>";
           echo "<TD BGCOLOR='yellow'>\$matriz2</TD>";
           echo "<TD>".$matriz2['dolar']['moneda']."</TD>";
           echo "<TD>".$matriz2['dolar']['cambio']."</TD>";
           echo "</TR>";
           echo "<TR ALIGN='center'>";
           echo "<TD BGCOLOR='yellow'>\$matriz3</TD>";
           echo "<TD>".$matriz3['franco']['moneda']."</TD>";
           echo "<TD>".$matriz3['franco']['cambio']."</TD>";
           echo "</TR>";
           echo "<TR ALIGN='center'>";
           echo "<TD BGCOLOR='yellow'>\$matriz3</TD>";
           echo "<TD>".$matriz3['dolar']['moneda']."</TD>";
           echo "<TD>".$matriz3['dolar']['cambio']."</TD>";
           echo "</TR>";
       ?>
     </TABLE>
   </CENTER>
 </BODY>
</HTML>
