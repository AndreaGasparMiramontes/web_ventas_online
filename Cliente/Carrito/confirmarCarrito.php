<?php

require "../conecta.php";
$con = conecta();

    $id = $_REQUEST["id"];

    $query = "UPDATE pedidos SET status = 1 WHERE id = $id";

    $query2 = "SELECT id_producto, cantidad FROM pedidos_productos WHERE id_pedido = $id";
    $resultado = mysqli_query($con,$query2);
    while ($row = mysqli_fetch_assoc($resultado)) {

        $idproducto = $row['id_producto'];
        $cantidad = $row['cantidad'];

        $query3 = "UPDATE productos SET stock = stock - $cantidad WHERE id = $idproducto";
        $resultado2 = $con->query($query3);

    }

    

    $result = $con->query($query);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }


?>