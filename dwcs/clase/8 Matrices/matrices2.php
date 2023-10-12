<HTML>
    <HEAD>
        <TITLE>Trabajando con Matrices</TITLE>
    </HEAD>
    <BODY>
    <CENTER>
        <H2>Arrays <I>simples</I></H2>
        <?php
        $matriz1[7] = "2.500";
        $matriz1[3] = "Q5";
        $matriz1[5] = "Audi";
        $matriz1[] = "TDI";
        $matriz1[] = 367;
        $matriz1[] = null;
        ?>
        <TABLE BORDER="1" CELLPADDING="2" CELLSPACING="2">
            <TR ALIGN="center" BGCOLOR="yellow">
                <TD>índice</TD>
<?php
for ($i = 0; $i <= 10; $i++)
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
echo "<TD> $matriz1[6] </TD>";
echo "<TD> $matriz1[7] </TD>";
echo "<TD> $matriz1[8] </TD>";
echo "<TD> $matriz1[9] </TD>";
echo "<TD> $matriz1[10] </TD>";
// raise a exception E
throw new Exception('Exception message')
?>
            </TR>
        </TABLE>
    </CENTER>
</BODY>
</HTML>
