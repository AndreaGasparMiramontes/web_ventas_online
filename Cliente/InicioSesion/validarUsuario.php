<?php
session_start();
require "..\conecta.php";
$con = conecta();

$correo = $_REQUEST['correo'];
$pass = md5 ($_REQUEST['password']);

$query = "SELECT * FROM usuarios
          WHERE eliminado = 0
          AND correo = '$correo' AND pass='$pass'";

$res = $con -> query($query);
$num = $res -> num_rows;

if($num == 1){
    $row = $res -> fetch_array();
    $id = $row["id"];
    $nombre = $row["nombre"]. ' '.$row["apellidos"];
    $correo = $row["correo"];

    $_SESSION['idUserc'] = $id;
    $_SESSION['nombreUserc'] = $nombre;
    $_SESSION['correoUserc'] = $correo;

}

echo $num;
?>