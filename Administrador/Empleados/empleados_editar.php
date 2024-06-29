<?php
    require '../sesion.php';
?>

<html>
<head>
    <title>Editar empleados</title>
    <link rel="stylesheet" href="../estilo2.css">

    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>

        var disponible = 0;

        function validar() {
            var apellidos = document.Forma01.apellidos.value;
            var rol = document.Forma01.rol.selectedIndex;
            var nombre = document.Forma01.nombre.value;
            var correo = document.Forma01.correo.value;
            var password = document.Forma01.pass.value;
            var imagen = document.Forma01.archivo;

            if (correo === "" || nombre === "" || apellidos === "" || rol === 0 || disponible === 0) {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                return false;
            } else {
                console.log("Todos los campos están completos");
                return true;
            }
        }

        function CorreoRepetido() {
            var correo = document.Forma01.correo.value;
            var correo_o = document.Forma01.correo_o.value;
            $.ajax({
                type: "POST",
                url: "emplados_validar.php",
                data: { correo: correo },
                success: function (response) { console.log("success");
                    if (response == "success" && correo != correo_o) {
                        $('#mensajeCorreo').show();
                        $('#mensajeCorreo').html('El correo '+correo+' ya existe');
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

    <center><h2 class="titulo">Edicion de empleados</h2></center>

    <div class="container">
    <p>Ingresa los siguientes datos: </p><br>
    <form action="empleados_actualizar.php" method="post" name="Forma01" id="Forma01" enctype = "multipart/form-data">

    <?php

    require "../conecta.php";
    $con = conecta();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($con) {
            $query = "SELECT id, nombre, apellidos, correo, rol, pass, status FROM empleados WHERE id = $id;";
            $result = mysqli_query($con,$query);
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                
                $idempleado = $row['id'];
                $nombre = $row['nombre'];
                $apellidos = $row['apellidos'];
                $correo = $row['correo'];
                $rol = $row['rol'];
                $password = $row['pass'];
                $status = $row['status'];

                echo "<input type='hidden' name='id' value='" . $id . "'>"; 
                echo "<input type='hidden' name='correo_o' value='" . $correo . "'>"; 

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='nombre'>Nombre:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='text' name='nombre' placeholder='Ingresa tu nombre' value=$nombre><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='apellidos'>Apellidos:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='text' name='apellidos' placeholder='Ingresa tus apellidos' value=$apellidos><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='correo'>Correo:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='email' name='correo' placeholder='Ingresa tu correo' onblur='CorreoRepetido();' value=$correo><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<div id='mensajeCorreo'></div><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='pass'>Contraseña:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<input type='password' name='pass' placeholder='Cambiar contraseña'><br><br>";
                echo "</div></div>";

                echo "<div class='row'>";
                echo "<div class='col-25'>";
                echo "<label for='rol'>Rol:</label><br>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<select name='rol'>";
                echo "<option value='0'>Selecciona un rol</option>";
                if ($rol == 1){
                    echo "<option value='1' selected>Gerente</option>";
                    echo "<option value='2'>Ejecutivo</option>";
                } else{
                    echo "<option value='1'>Gerente</option>";
                    echo "<option value='2' selected>Ejecutivo</option>";
                }
                echo "</select><br><br> </div> </div>";

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
    <a class="returnbtn" href="empleados_lista.php">Regresar</a><br><br>
    <div id="mensaje"></div>

    </form>
    </div>
   
</body>
</html>