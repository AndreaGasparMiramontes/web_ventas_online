<?php

require "../conecta.php";
$con = conecta();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "UPDATE promociones SET eliminado = 1 WHERE id = $id";
    $result = $con->query($query);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}

?>