<?php

require '../sesion.php';
require "../conecta.php";
echo "<link rel='stylesheet' href='../estilo2.css'>";
include '../header.php';
$con = conecta();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($con) {
        $query = "SELECT nombre, codigo, descripcion, costo, stock, status, archivo FROM productos WHERE id = $id;";
        $result = mysqli_query($con,$query);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            
            $codigo = $row['codigo'];
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $costo = $row['costo'];
            $stock = $row['stock'];
            $status = $row['status'];
            $archivo = $row['archivo'];

            
            if ($status == 1){
                $estado = 'Activo';
            } else{
                $estado = 'Inactivo';
            }

           
            echo "<center><h2>Detalles de empleado</h2></center>";
            echo "<div class='detalles'>";
            echo "<div class='row'>";
            echo "<div class='col-25'><img class='imagen'width='90%' src=archivos/$archivo></div>";
            echo "<div class='col-75'>";
            echo "<div class='row'>";
            echo "<div class='col-25'>Codigo:</div>";
            echo "<div class='col-75'>$codigo</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Nombre:</div>";
            echo "<div class='col-75'>$nombre</div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<div class='col-25'>Costo:</div>";
            echo "<div class='col-75'>$costo</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Stock:</div>";
            echo "<div class='col-75'>$stock</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Descripcion:</div>";
            echo "<div class='col-75'>$descripcion</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Estado:</div>";
            echo "<div class='col-75'>$estado</div>";
            echo "</div>";
            echo "</div>"; 
            echo "</div>";
            echo "<a class='returnbtn' href='productos_lista.php'>Regresar</a><br><br>";
            echo "</div>";
        } 
    }
  
} else {
    echo "Error de id";
}
?>