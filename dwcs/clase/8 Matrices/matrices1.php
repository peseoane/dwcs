<HTML>
 <HEAD>
   <TITLE>Trabajando con Matrices</TITLE>
 </HEAD>
 <BODY>
   <CENTER>
     <H2>Arrays <I>simples</I></H2>     <?php

       $matriz1[0]="Q5";
       $matriz1[1]="Audi";
       $matriz1[3]="2.500";
       $matriz1[4]="TDI";
       $matriz1[5]=367;

       $matriz2[]="Q5";
       $matriz2[]="Audi";
       $matriz2[]="";
       $matriz2[]="2.500";
       $matriz2[]="TDI";
       $matriz2[]=367;

     ?>
     <TABLE BORDER="1" CELLPADDING="2" CELLSPACING="2">
        <TR ALIGN="center" BGCOLOR="yellow">
           <TD>índice</TD>
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
              echo "<TD> $matriz1[2] </TD>";//Este índice no lo tenemos
              echo "<TD> $matriz1[3] </TD>";
              echo "<TD> $matriz1[4] </TD>";
              echo "<TD> $matriz1[5] </TD>";
            ?>
        </TR>
        <TR ALIGN="center"> 
           <TD BGCOLOR="pink">$matriz2</TD>
            <?php //Activar los E_NOTICE en el php.ini
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
