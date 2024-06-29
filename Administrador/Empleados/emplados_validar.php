<?php
require "../conecta.php";
$con = conecta();

$correo = $_POST['correo'];
$id = isset($_POST['id']) ? $_POST['id'] : null;

if ($id !== null){
    $query = "SELECT * FROM empleados WHERE correo = '$correo' AND id != '$id'";
} else {
    $query = "SELECT * FROM empleados WHERE correo = '$correo'";
}

$result = $con->query($query);

if ($result->num_rows > 0) {
    echo 'success';
} else {
    echo 'error';
}

?>