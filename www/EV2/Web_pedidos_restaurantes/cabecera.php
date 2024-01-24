<!--Cabecera de las páginas de mi web, con accesos directos a la página principal,
carrrito de la compra y salir de la sesión-->
<header>
    Usuario: <?php echo $_SESSION['usuario']['correo'] ?>
    <a href="categorias.php">Home</a>
    <a href="carrito.php">Ver carrito</a> 
    <a href="logout.php">Cerrar sesión</a>
</header>
<hr>