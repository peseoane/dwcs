<HTML>
 <HEAD>
   <TITLE>Trabajando con Matrices</TITLE>
 </HEAD>
 <BODY>
   <CENTER>
     <H2>Arrays función <I>sizeof</I></H2>
     <?php
       $matriz1=array(array("franco",1.09),
                      array("moneda1",0.96),
                      array("marco",1.85));
     ?>
     <TABLE BORDER="1" CELLPADDING="2" CELLSPACING="2">
        <TR ALIGN="center" BGCOLOR="yellow">
           <TD></TD>
           <TD>Moneda</TD>
           <TD>Cambio 1€</TD>
       </TR>
       <?php
           for($i=0;$i<sizeof($matriz1);$i++){
               echo "<TR ALIGN='center'>";
               echo "<TD BGCOLOR='yellow'>\$matriz1[$i]</TD>";
               for($j=0;$j<sizeof($matriz1[$i]);$j++){
                   echo "<TD>".$matriz1[$i][$j]."</TD>";
               }
               echo "</TR>";
           }
       ?>
     </TABLE>
   </CENTER>
 </BODY>
</HTML>
