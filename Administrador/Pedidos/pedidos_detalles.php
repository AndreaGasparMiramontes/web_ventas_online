<?php

require '../sesion.php';
require "../conecta.php";
echo "<link rel='stylesheet' href='../estilo2.css'>";
include '../header.php';
$con = conecta();

echo "<center><h2>Detalles de empleado</h2></center>";
echo "<div class='detalles'>";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT id FROM pedidos WHERE id = $id";
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
    echo "<a class='returnbtn' href='pedidos_lista.php'>Regresar</a><br><br>";
    echo "</div>";
}

?>