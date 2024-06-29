<?php
    require '../sesion.php';
?>

<html>
<head>
    <title>Editar productos</title>
    <link rel="stylesheet" href="../estilo2.css">

    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>

        var disponible = 0;

        function validar() {
            var nombre_producto = document.Forma02.nombre.value;
            var codigo_producto = document.Forma02.codigo.value;
            var costo_producto = document.Forma02.costo.value;
            var stock_producto = document.Forma02.stock.value;
            var descripcion_producto = document.Forma02.descripcion.value;

            if (codigo_producto === "" || nombre_producto === "" || costo_producto === "" || stock_producto === "" || descripcion_producto === "" || disponible === 0) {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                return false;
            } else {
                console.log("Todos los campos están completos");
                return true;
            }
        }

        function CorreoRepetido() {
            var codigo = document.Forma01.correo.value;
            var codigo_o = document.Forma01.correo_o.value;
            $.ajax({
                type: "POST",
                url: "productos_validar.php",
                data: { codigo: codigo },
                success: function (response) { console.log("success");
                    if (response == "success" && codigo != codigo_o) {
                        $('#mensajeCorreo').show();
                        $('#mensajeCorreo').html('El codigo '+codigo+' ya existe');
                        setTimeout("$('#mensajeCorreo').html(''); $('#mensajeCorreo').hide();", 5000);
                        disponible = 0;
                    } else {
                        disponible = 1;
                    }
                }
            });
        }

    </script>
    
</head>

<body>
    <?php include '../header.php'; ?>

    <center><h2 class="titulo">Edicion de productos</h2></center>

    <div class="container">
    <p>Ingresa los siguientes datos: </p><br>
    <form action="productos_actualizar.php" method="post" name="Forma01" id="Forma01" enctype = "multipart/form-data">

    <?php

    require "../conecta.php";
    $con = conecta();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($con) {
            $query = "SELECT nombre, codigo, costo, stock, descripcion, status FROM productos WHERE id = $id;";
            $result = mysqli_query($con,$query);
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                
                $codigo = $row['codigo'];
                $nombre = $row['nombre'];
                $costo = $row['costo'];
                $stock = $row['stock'];
                $descripcion = $row['descripcion'];
                $status = $row['status'];

                echo "<input type='hidden' name='id' value='" . $id . "'>"; 
                echo "<input type='hidden' name='codigo_o' value='" . $codigo . "'>"; 

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='nombre'>Nombre:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='text' name='nombre' placeholder='Ingresa nombre del producto' value=$nombre><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='apellidos'>Codigo:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='text' name='codigo' placeholder='Ingresa codigo del producto' value=$codigo><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<div id='mensajeCorreo'></div><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='correo'>Costo:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='number' step='.01' name='costo' placeholder='Ingresa costo del producto' value=$costo><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='pass'>Stock:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='number' step='1' name='stock' placeholder='Ingresa stock del producto' value=$stock><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='apellidos'>Descripcion:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='text' name='descripcion' placeholder='Ingresa descripcion del producto' value=$descripcion><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='estado'>Estado:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<select name='estado'>";
                if ($status == 1){
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
    <a class="returnbtn" href="productos_lista.php">Regresar</a><br><br>
    <div id="mensaje"></div>

    </form>
    </div>
   
</body>
</html>