<?php
    error_reporting(0);
    session_start();
    $id_usuario = $_SESSION['idUserc'];
    $nombre_usuario = $_SESSION['nombreUserc'];
    $correo_usuario = $_SESSION['correoUserc'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link rel="stylesheet" href="../estilo.css">
</head>

<body style="background-color:#E0F3DC">
    <?php 
    include '../header.php'; 
    include '../conecta.php';
    $con = conecta();
    ?>

    <br>

    <div class="main">
    <?php

    $sql = "SELECT * FROM productos WHERE eliminado = 0";
    $resultado = $con->query($sql);

    if ($resultado->num_rows > 0) {
        $productos = $resultado->fetch_all(MYSQLI_ASSOC);
        $totalProductos = count($productos);
    } else {
        echo "No hay productos disponibles.";
    }
    $diviciones = ceil($totalProductos / 4);
    $contador = 0;

    for($j = 0; $j < $diviciones; $j++){
        echo "<div class='row'>";
        $tope = $contador+4;
        for ($i = $contador; $i < $tope && $i < $totalProductos; $i++) {
            echo "<div class='col-25'>";
            echo "<img class='imagen' src=../../Administrador/Productos/archivos/{$productos[$i]['archivo']}>";
            echo "<div>{$productos[$i]['nombre']}</div>";
            echo "<div>\${$productos[$i]['costo']}</div>";
            echo "<a href='../Productos/detalles.php?id={$productos[$i]['id']}'>Comprar</a>";
            echo "</div>";
            $contador++;
        }
        echo "</div>";
    }
    ?>
    </div>

    <footer id="piePagina">
    <p>Todos los derechos reservados 2024 | 
    <a href="../terminos.php"> Terminos y Condiciones</a> |
    <a href="#">Redes sociales</a></p>
    </footer>

</body>
</html>