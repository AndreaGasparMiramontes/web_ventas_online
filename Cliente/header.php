<?php
echo "<nav>";
echo "<ul>";
echo "<li><a href='../Main/index.php'>Inicio</a></li>";
echo "<li><a href='../Productos/productos.php'>Productos</a></li>";
echo "<li><a href='../Correo/index.php'>Contacto</a></li>";
if ($nombre_usuario) {
    echo "<li style='float:right' class='dropdown'>";
    echo "<a href='#' class='dropbtn'>$nombre_usuario</a>";
    echo "<div class='dropdown-content'>";
    echo "<a href='../Carrito/carrito01.php'>Carrito</a>";
    echo "<a href='../InicioSesion/cerrarsesion.php'>Cerrar Sesion</a>";
    echo "</div>";
    echo "</li>";
}else {
    echo "<li style='float:right'><a href='../InicioSesion/index.php'>Inicia sesion</a></li>";
}
echo "</ul>";
echo "</nav>";
?>