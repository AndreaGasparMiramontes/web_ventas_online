<?php

include '../conecta.php';
$con = conecta();

$idPedido = $_REQUEST['idP'];
$cantidad = $_REQUEST['cant'];
$cantidadstock = $_REQUEST['stock'];

if ($cantidad <= $cantidadstock) {
$sql = "UPDATE pedidos_productos SET cantidad = $cantidad WHERE id = $idPedido";
$result = $con->query($sql);

if ($result) {
    echo 1;
} 

} else {
    echo 0;
}

?>