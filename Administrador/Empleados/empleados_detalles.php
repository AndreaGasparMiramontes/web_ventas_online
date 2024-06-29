<?php

require '../sesion.php';
require "../conecta.php";
echo "<link rel='stylesheet' href='../estilo2.css'>";
include '../header.php';
$con = conecta();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($con) {
        $query = "SELECT id, nombre, apellidos, correo, rol, status, archivo FROM empleados WHERE id = $id;";
        $result = mysqli_query($con,$query);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            
            $idempleado = $row['id'];
            $nombre = $row['nombre'];
            $apellidos = $row['apellidos'];
            $correo = $row['correo'];
            $rol = $row['rol'];
            $status = $row['status'];
            $archivo = $row['archivo'];

            
            if ($status == 1){
                $estado = 'Activo';
            } else{
                $estado = 'Inactivo';
            }

            if ($rol == 1){
                $puesto = 'Gerente';
            } else if ($rol == 2){
                $puesto = 'Ejecutivo';
            }

           
            echo "<center><h2>Detalles de empleado</h2></center>";
            echo "<div class='detalles'>";
            echo "<div class='row'>";
            echo "<div class='col-25'><img class='imagen'width='90%' src=archivos/$archivo></div>";
            echo "<div class='col-75'>";
            echo "<div class='row'>";
            echo "<div class='col-25'>ID:</div>";
            echo "<div class='col-75'>$idempleado</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Nombre:</div>";
            echo "<div class='col-75'>$nombre $apellidos</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Correo:</div>";
            echo "<div class='col-75'>$correo</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Rol:</div>";
            echo "<div class='col-75'>$puesto</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Estado:</div>";
            echo "<div class='col-75'>$estado</div>";
            echo "</div>";
            echo "</div>"; 
            echo "</div>";
            echo "<a class='returnbtn' href='empleados_lista.php'>Regresar</a><br><br>";
            echo "</div>";
        } 
    }
  
} else {
    echo "Error de id";
}
?>