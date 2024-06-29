<!DOCTYPE html>
<html>
<head>
    <title>Carrito</title>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="../estilo.css">

    <script>
        function actualizarCantidad(idP,cantstock) {
            var cant = $('#cantidad'+idP).val();
            if (cant > 0) {
                console.log("cantidad");
                console.log(cant);
                console.log("stock");
                console.log(cantstock);
                console.log("id Pedido");
                console.log(idP);
                $.ajax({
                    url      : 'actualizarCantidad.php',
                    type     : 'post',
                    dataType : 'text',
                    data     : 'idP='+idP+'&cant='+cant+'&stock='+cantstock,
                    success  : function(res) {
                    if (res == 1) {
                        $('#mensaje').show();
                        $('#mensaje').html('Se ha agregado correctamente');
                        setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
                    } else {
                        $('#mensajeerror').show();
                        $('#mensajeerror').html('Ingrese un valor valido');
                        setTimeout('$("#mensajeerror").html(""); $("#mensajeerror").hide();', 5000);
                    }

                    },error: function() {
                        alert('Error archivo no encontrado...');
                    }
                });
            }
        }

        function eliminarProducto(idP) {
            var confirmar = confirm("Desea eliminar el producto de su carrito?");
            console.log(confirmar);
            console.log(idP);
            if (confirmar) {
                $.ajax({
                    url      : 'eliminaCarrito.php',
                    type     : 'post',
                    dataType : 'text',
                    data     : 'id='+idP,
                    success  : function(res) {
                    if (res == 'success') {
                        $("#fila"+idP).hide();
                    }}
                    ,error: function() {
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
    include '../conecta.php';
    $con = conecta();
?>

<?php
echo"<center></center><div id='mensaje'></div></center>";
echo "<center><div id='mensajeerror'></div></center>";

    if ($con) {
        $id_cliente = $id_usuario;
        $query2 = "SELECT id FROM pedidos WHERE id_usuarios = $id_cliente AND status = 0";
        $resultado = mysqli_query($con,$query2);
        $id_pedidos = mysqli_fetch_assoc($resultado);
        $num2 = $resultado->num_rows;
        if ($num2 > 0) {
        $id_pedido = $id_pedidos['id'];
      
        $query = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
        $result = mysqli_query($con,$query);
        $num = $result->num_rows;
        $totalPrecioFinal = 0;

        echo '<br><br><table class ="tab">
        <tr>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Eliminar</th>
        </tr>';
        if ($num > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $idpedidosdetalle = $row['id'];
            $idproducto = $row['id_producto'];
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];

            $query2 = "SELECT * FROM productos WHERE id = $idproducto";
            $resultadoproducto = mysqli_query($con, $query2);
            $resultadoP = mysqli_fetch_assoc($resultadoproducto);
            
            $cantidadstock = $resultadoP['stock'];

            $nombreP = $resultadoP['nombre'];

            $precioTotal = $cantidad * $precio;

            $totalPrecioFinal += $precioTotal;


            echo '<tr id="fila'.$idpedidosdetalle.'">
                    <td>' . $nombreP . '</td>
                    <td class="editarcarrito"><input type="text" class="editarproducto" placeholder="Agregar" value="' . $cantidad . '" id="cantidad' . $idpedidosdetalle . '" onblur="actualizarCantidad(' . $idpedidosdetalle. ', ' .$cantidadstock. ')"></td>
                    <td>$' . $precio . '</td>
                    <td>$' . $precioTotal . '</td>
                    <td class="botones"><button  class="eliminar" onclick="eliminarProducto(' . $idpedidosdetalle . ')">Eliminar</button></td>
                </tr>';    
              }

        echo '<tr>
                <td colspan="3" class="total">Total:</td>
                <td>$' . $totalPrecioFinal . '</td>
                <td><div class="continuar"><a href="carrito02.php">Continuar</a></div></td>
            </tr>';

          } else {
            echo '<tr>
                  <td colspan="5" class="total">Aun no has agregado ningun articulo al carrito</td>
              </tr>';
          }
        echo '</table><br>';

       } else{
        echo '<br><br><table class ="tab">
        <tr>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Eliminar</th>
        </tr>';
        echo '<tr>
        <td colspan="5" class="total">Aun no has agregado ningun articulo al carrito</td>
    </tr>';
        echo '</table><br>';
       }
        }

?>

<footer id="piePagina">
   <p>Todos los derechos reservados 2024 | 
   <a href="../terminos.php"> Terminos y Condiciones</a> |
   <a href="#">Redes sociales</a></p>
</footer>