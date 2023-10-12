<HTML>
 <HEAD>
   <TITLE>Trabajando con Matrices</TITLE>
 </HEAD>
 <BODY>
   <CENTER>
     <H2>El constructor <I>array</I></H2>
     <?php
       $matriz1 = array("Q5","Audi",null,"2.500","TDI",367);
       $matriz2 = array(2=>"Q5","Audi",1=>null,0=>"2.500","TDI",367);
     ?>
     <TABLE BORDER="1" CELLPADDING="2" CELLSPACING="2">
        <TR ALIGN="center" BGCOLOR="yellow">
           <TD>Indice</TD>
            <?php
              for($i=0;$i<=5;$i++)
                  echo "<TD>$i</TD>";
            ?>
        </TR>
        <TR ALIGN="center">
           <TD BGCOLOR="yellow">$matriz1</TD>
            <?php
              echo "<TD> $matriz1[0] </TD>";
              echo "<TD> $matriz1[1] </TD>";
              echo "<TD> $matriz1[2] </TD>";
              echo "<TD> $matriz1[3] </TD>";
              echo "<TD> $matriz1[4] </TD>";
              echo "<TD> $matriz1[5] </TD>";
            ?>
        </TR>
        <TR ALIGN="center">
           <TD BGCOLOR="yellow">$matriz2</TD>
            <?php
              echo "<TD> $matriz2[0] </TD>";
              echo "<TD> $matriz2[1] </TD>";
              echo "<TD> $matriz2[2] </TD>";
              echo "<TD> $matriz2[3] </TD>";
              echo "<TD> $matriz2[4] </TD>";
              echo "<TD> $matriz2[5] </TD>";
            ?>
        </TR>
     </TABLE>
   </CENTER>
 </BODY>
</HTML>
