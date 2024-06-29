<?php

require '../sesion.php';
require "../conecta.php";
echo "<link rel='stylesheet' href='../estilo2.css'>";
include '../header.php';
$con = conecta();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($con) {
        $query = "SELECT nombre, status, archivo FROM promociones WHERE id = $id;";
        $result = mysqli_query($con,$query);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            
            $nombre = $row['nombre'];
            $status = $row['status'];
            $archivo = $row['archivo'];

            
            if ($status == 1){
                $estado = 'Activo';
            } else{
                $estado = 'Inactivo';
            }

           
            echo "<center><h2>Detalles de Promocion</h2></center>";
            echo "<div class='detalles'>";
            echo "<div class='row'>";
            echo "<div class='col-25'>Nombre:</div>";
            echo "<div class='col-75'>$nombre</div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<div class='col-25'>Estado:</div>";
            echo "<div class='col-75'>$estado</div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<div class='col-25'>Imagen:</div>";
            echo "<div class='col-75'><img class='imagen'width='90%' src=archivos/$archivo></div>";
            echo "</div><br>";
            echo "<a class='returnbtn' href='promociones_lista.php'>Regresar</a><br><br>";
            echo "</div>";
        } 
    }
  
} else {
    echo "Error de id";
}
?>