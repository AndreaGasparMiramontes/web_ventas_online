<?php
echo "<nav>";
echo "<ul>";
echo "<li><a href='../InicioSesion/bienvenido.php'>Inicio</a></li>";
echo "<li><a href='../Empleados/empleados_lista.php'>Empleados</a></li>";
echo "<li><a href='../Productos/productos_lista.php'>Productos</a></li>";
echo "<li><a href='../Promociones/promociones_lista.php'>Promociones</a></li>";
echo "<li><a href='../Pedidos/pedidos_lista.php'>Pedido</a></li>";
echo "<li style='float:right' class='dropdown'>";
echo "<a href='#' class='dropbtn'>$nombre</a>";
echo "<div class='dropdown-content'>";
echo "<a href='../InicioSesion/cerrarsesion.php'>Cerrar Sesion</a>";
echo "</div>";
echo "</li>";
echo "</ul>";
echo "</nav>";
?>