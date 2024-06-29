<?php
    require '../sesion.php';
?>

<html>
<head>
    <title>Agregar productos</title>
    <link rel="stylesheet" href="../estilo20.css" <?php echo time(); ?>>

    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>

        var disponible = 0;

        function validar_producto() {
            var nombre_producto = document.Forma02.nombre.value;
            var codigo_producto = document.Forma02.codigo.value;
            var costo_producto = document.Forma02.costo.value;
            var stock_producto = document.Forma02.stock.value;
            var descripcion_producto = document.Forma02.descripcion.value;
            var imagen_producto = document.Forma02.archivo.value;

            if (codigo_producto === "" || nombre_producto === "" || costo_producto === "" || stock_producto === "" || descripcion_producto === 0 || imagen_producto === "" || disponible === 0) {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                return false;
            } else {
                console.log("Todos los campos están completos");
                return true;
            }
        }

        function CodigoRepetido() {
            var codigo = document.Forma02.codigo.value;
            $.ajax({
                type: "POST",
                url: "productos_validar.php",
                data: { codigo: codigo },
                success: function (response) { console.log("success");
                    if (response == "success") {
                        $('#mensajeCodigo').show();
                        $('#mensajeCodigo').html('El codigo '+codigo+' ya existe');
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

    <center><h2 class="titulo">Alta de Productos</h2></center>
    <div class="container">
    <p>Ingresa los siguientes datos: </p><br>
    <form action="productos_insertar.php" method="post" name="Forma02" id="Forma02" enctype = "multipart/form-data">
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
                <label for="codigo">Codigo:</label><br>
            </div>
            <div class="col-75">
                <input type="text" name="codigo" placeholder="Ingresa codigo del producto" onblur="CodigoRepetido();"><br>
            </div>
        </div>
        
        <div class="row">
            <div class="col-25">
            </div>
            <div class="col-75">
                <div id="mensajeCodigo"></div><br>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="costo">Costo:</label><br>
            </div>
            <div class="col-75">
                <input type="number" step=".01" name="costo" placeholder="Ingresa costo del producto"><br><br>
            </div>
        </div>
        
        <div class="row">
            <div class="col-25">
                <label for="stock">Stock:</label><br>
            </div>
            <div class="col-75">
                <input type="number" step="1" name="stock" placeholder="Ingresa stock del producto"><br><br>
            </div>
        </div>
       
        <div class="row">
            <div class="col-25">   
                <label for="descripcion">Descripcion:</label><br>
            </div>
            <div class="col-75">
                <input type="text" name="descripcion" placeholder="Ingresa descripcion del producto"><br><br>
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

        <input type="submit" value="Enviar" onclick="if(!validar_producto()){return false;}" class="enviar">
        <a class="returnbtn" href="productos_lista.php">Regresar</a><br><br>
        <div id="mensaje"></div>

    </form>
    </div>
   
</body>
</html>