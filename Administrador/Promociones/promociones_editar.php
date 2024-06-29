<?php
    require '../sesion.php';
?>

<html>
<head>
    <title>Editar promociones</title>
    <link rel="stylesheet" href="../estilo2.css">

    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>

        var disponible = 0;

        function validar() {
            var nombre_promocion = document.Forma02.nombre.value;

            if (nombre_promocion === "") {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                return false;
            } else {
                console.log("Todos los campos están completos");
                return true;
            }
        }

    </script>
    
</head>

<body>
    <?php include '../header.php'; ?>

    <center><h2 class="titulo">Edicion de promocion</h2></center>

    <div class="container">
    <p>Ingresa los siguientes datos: </p><br>
    <form action="promociones_actualizar.php" method="post" name="Forma02" id="Forma02" enctype = "multipart/form-data">

    <?php

    require "../conecta.php";
    $con = conecta();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($con) {
            $query = "SELECT nombre, status FROM promociones WHERE id = $id;";
            $result = mysqli_query($con,$query);
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                
                $nombre_promociones = $row['nombre'];
                $status_promociones = $row['status'];

                echo "<input type='hidden' name='id' value='" . $id . "'>"; 

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='nombre'>Nombre:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='text' name='nombre' placeholder='Ingresa nombre del producto' value=$nombre_promociones><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='estado'>Estado:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<select name='estado'>";
                if ($status_promociones == 1){
                    echo "<option value='1'>Activo</option>";
                    echo "<option value='0'>Inactivo</option>";
                } else{
                    echo "<option value='1'>Activo</option>";
                    echo "<option value='0' selected>Inactivo</option>";
                }
                echo "</select><br><br> </div> </div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='imagen'>Imagen:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type = 'file' id = 'archivo' name = 'archivo' id = 'archivo' accept='image/*'><br><br>";
                echo "</div></div>";
            } 
        }
    
    } else {
        echo "Error de id";
    }
    ?>

    <input type="submit" value="Enviar" onclick="return validar();" class="enviar">
    <a class="returnbtn" href="promociones_lista.php">Regresar</a><br><br>
    <div id="mensaje"></div>

    </form>
    </div>
   
</body>
</html>