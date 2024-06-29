<?php
    require '../sesion.php';
?>

<html>
<head>
    <title>Agregar promociones</title>
    <link rel="stylesheet" href="../estilo20.css" <?php echo time(); ?>>

    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>

        var disponible = 0;

        function validar_promocion() {
            var nombre_promocion = document.Forma02.nombre.value;
            var imagen_promocion = document.Forma02.archivo.value;

            if (nombre_promocion === "" || imagen_promocion === "") {
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

    <center><h2 class="titulo">Alta de Promociones</h2></center>
    <div class="container">
    <p>Ingresa los siguientes datos: </p><br>
    <form action="promociones_insertar.php" method="post" name="Forma02" id="Forma02" enctype = "multipart/form-data">
        <div class="row">
            <div class="col-25">
                <label for="nombre">Nombre:</label><br>
            </div>
            <div class="col-75">
                <input type="text" name="nombre" placeholder="Ingresa nombre del producto"><br><br>
            </div>
        </div>
        
        <div class="row">
            <div class="col-25">
                <label for="imagen">Imagen:</label>
            </div>
            <div class="col-75">
                <input type = "file" id = "archivo" name = "archivo"><br><br>
            </div>
        </div>

        <input type="submit" value="Enviar" onclick="if(!validar_promocion()){return false;}" class="enviar">
        <a class="returnbtn" href="promociones_lista.php">Regresar</a><br><br>
        <div id="mensaje"></div>

    </form>
    </div>
   
</body>
</html>