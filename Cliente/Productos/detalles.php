<script src="../js/jquery-3.3.1.min.js"></script>

<script>
    function agregarProducto(idP) {
        var cant = document.getElementById("cantidad").value;
        console.log(idP);
        $.ajax({
            url      : 'agregarProducto.php',
            type     : 'post',
            data     : { idP: idP , cant:cant },
            //dataType : 'text',
            //data     : 'idP='+idP+'&cant='+cant,
            success  : function(res) {
            if (res == 1) {
                $('#mensaje').show();
                $('#mensaje').html('Su articulo ha sido agregado al carrito');
                setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
            } else {
                $('#mensaje').show();
                $('#mensaje').html('Operacion no concretada, intente de nuevo');
                setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
            }

            },error: function() {
                alert('Error archivo no encontrado...');
            }
        });
    }
</script>

<?php

require '../sesion.php';
require "../conecta.php";
echo "<title>Detalles</title>";
echo "<link rel='stylesheet' href='../estilo.css'>";
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

            echo '<div id="mensaje"></div>';
            echo "<div class='detalles'>";
            echo "<div class='row'>";
            echo "<div class='col-75'>";
            echo "<div class='row'>";
            echo "<div class='col-25'><img class='imagen'width='90%' src=../../Administrador/Productos/archivos/$archivo></div>";
            echo "<div class='col-75'>";
            echo "<div class='row'>";
            echo "<div class='col-25'>Nombre:</div>";
            echo "<div class='col-75'>$nombre</div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<div class='col-25'>Codigo:</div>";
            echo "<div class='col-75'>$codigo</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Costo:</div>";
            echo "<div class='col-75'>$costo</div>";
            echo "</div>"; 
            echo "<div class='row'>";
            echo "<div class='col-25'>Descripcion:</div>";
            echo "<div class='col-75'>$descripcion</div>";
            echo "</div>"; 
            echo "</div>";
            echo "</div>"; 
            echo "</div>";
            echo "<div class='col-25'><div class='detalles'>";
            echo "<center> \$ $costo</center><br>";
            echo "<div class='col-75'>Cantidad:</div>";
            echo "<div class='col-25'> <select name='cantidad' id='cantidad'>";
            for ($i = 1; $i <= $stock; $i++){
                echo "<option value='$i'>$i</option>";
            }
            echo "</select><br><br>";
            echo "</div>";
            echo "<button class='comprarbtn' onclick='agregarProducto(". $id .")'>Agregar al carrito</a>";
            echo "</div></div>";
            echo "</div>";
            echo "<a class='returnbtn' href='productos.php'>Regresar</a><br><br>";
        } 
    }
  
} else {
    echo "Error de id";
}
?>

<footer id="piePagina">
   <p>Todos los derechos reservados 2024 | 
   <a href="../terminos.php"> Terminos y Condiciones</a> |
   <a href="#">Redes sociales</a></p>
</footer>