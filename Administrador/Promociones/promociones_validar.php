<?php
require "../conecta.php";
$con = conecta();

$codigo = $_POST['codigo'];
$id = isset($_POST['id']) ? $_POST['id'] : null;

if ($id !== null){
    $query = "SELECT * FROM productos WHERE codigo = '$codigo' AND id != '$id'";
} else {
    $query = "SELECT * FROM productos WHERE codigo = '$codigo'";
}

$result = $con->query($query);

if ($result->num_rows > 0) {
    echo 'success';
} else {
    echo 'error';
}

?>