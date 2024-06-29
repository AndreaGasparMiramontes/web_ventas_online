<?php

require "../conecta.php";
$con = conecta();

$id = $_REQUEST["id"];

$query = "DELETE FROM pedidos_productos WHERE id = $id";
$result = $con->query($query);

if ($result) {
    echo 'success';
} else {
    echo 'error';
}

?>