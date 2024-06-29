<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="../estilo.css">

    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>

        var disponible = 0;

        function validar() {
            var apellidos = document.Forma01.apellidos.value;
            var nombre = document.Forma01.nombre.value;
            var correo = document.Forma01.correo.value;
            var password = document.Forma01.pass.value;

            if (correo === "" || password === "" || nombre === "" || apellidos === "" ) { //|| disponible === 0
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                return false;
            } else {
                console.log("Todos los campos están completos");
                return true;
            }
        }

        // function CorreoRepetido() {
        //     var correo = document.Forma01.correo.value;
        //     $.ajax({
        //         type: "POST",
        //         url: "emplados_validar.php",
        //         data: { correo: correo },
        //         success: function (response) { console.log("success");
        //             if (response == "success") {
        //                 $('#mensajeCorreo').show();
        //                 $('#mensajeCorreo').html('El correo '+correo+' ya existe');
        //                 setTimeout("$('#mensajeCorreo').html(''); $('#mensajeCorreo').hide();", 5000);
        //                 disponible = 0;
        //             } else {
        //                 disponible = 1;
        //             }
        //         }
        //     });
        // }

    </script>
    
</head>

<body>

    <br><br><center><h2 class="titulo">Registro</h2></center>
    <div class="container">
    <p>Ingresa los siguientes datos: </p><br>
    <form action="usuarios_insertar.php" method="post" name="Forma01" id="Forma01" enctype = "multipart/form-data">
        <div class="row">
            <div class="col-25">
                <label for="nombre">Nombre:</label><br>
            </div>
            <div class="col-75">
                <input type="text" name="nombre" placeholder="Ingresa tu nombre"><br><br>
            </div>
        </div>
        
        <div class="row">
            <div class="col-25">   
                <label for="apellidos">Apellidos:</label><br>
            </div>
            <div class="col-75">
                <input type="text" name="apellidos" placeholder="Ingresa tus apellidos"><br><br>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="correo">Correo:</label><br>
            </div>
            <div class="col-75">
                <input type="email" name="correo" placeholder="Ingresa tu correo"><br> <!-- onblur="CorreoRepetido();" -->
            </div>
        </div>
        
        <div class="row">
            <div class="col-25">
            </div>
            <div class="col-75">
                <div id="mensajeCorreo"></div><br>
            </div>
        </div>
        

        <div class="row">
            <div class="col-25">
                <label for="pass">Contraseña:</label><br>
            </div>
            <div class="col-75">
                <input type="password" name="pass" placeholder="Ingresa tu contraseña"><br><br>
            </div>
        </div>
        
        <input type="submit" value="Enviar" onclick="return validar();" class="enviar">
        <a class="returnbtn" href="../InicioSesion/index.php">Regresar</a><br><br>
        <div id="mensaje"></div>

    </form>
    </div>
   
</body>
</html>