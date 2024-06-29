<!DOCTYPE html>
<html>
<head>
    <title>Carrito</title>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="../estilo.css">

    <script>

        function cerrarProducto(idP) {
            var confirmar = confirm("Confirmar la compra?");
            if (confirmar) {
                $.ajax({
                    url      : 'confirmarCarrito.php',
                    type     : 'post',
                    dataType : 'text',
                    data     : 'id='+idP,
                    success  : function(res) {
                    if (res == 'success') {
                        alert("Compra completada!");
                        window.location.href = "../Main/index.php";
                    } 
                    },error: function() {
                        alert('Error archivo no encontrado...');
                    }
                });
            }
        }

    </script>

</head>
<body>

<?php
    require '../sesion.php';
    include '../header.php';
    require '../conecta.php';
    $con = conecta();
?>

<br><br>

<?php
    $id_cliente = $id_usuario;
    $query = "SELECT id FROM pedidos WHERE id_usuarios = $id_cliente AND status = 0";
    $resultado = mysqli_query($con,$query);
    $id_pedidos = mysqli_fetch_assoc($resultado);
    $id_pedido = $id_pedidos['id'];

    


    $query = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido;";
    $result = mysqli_query($con,$query);

    $totalPrecioFinal = 0;

    echo '<table class ="tab">
    <tr>
        <th>Nombre del Producto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Precio Total</th>
    </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $idproducto = $row['id_producto'];
        $cantidad = $row['cantidad'];
        $precio = $row['precio'];

        $query2 = "SELECT * FROM productos WHERE id = $idproducto;";
        $resultadoproducto = mysqli_query($con, $query2);
        $resultadoP = mysqli_fetch_assoc($resultadoproducto);
        
        $nombreP = $resultadoP['nombre'];

        $precioTotal = $cantidad * $precio;

        $totalPrecioFinal += $precioTotal;

        echo '<tr>
                <td>' . $nombreP . '</td>
                <td>' . $cantidad . '</td>
                <td> $' . $precio . '</td>
                <td> $' . $precioTotal . '</td>
            </tr>';
    }

    echo '<tr>
            <td colspan="3" class="total">Total:</td>
            <td> $' . $totalPrecioFinal . '</td>
        </tr>';

    echo '</table><br>';
    echo '<a class="returnbtn" href="#" onclick="cerrarProducto('.$id_pedido.');">Confirmar</a>';
    echo '<a class="returnbtn" href="carrito01.php">Regresar</a>';
    echo '<br><br>';
?>


<footer id="piePagina">
   <p>Todos los derechos reservados 2024 | 
   <a href="../terminos.php"> Terminos y Condiciones</a> |
   <a href="#">Redes sociales</a></p>
</footer>