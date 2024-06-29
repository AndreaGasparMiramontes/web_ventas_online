<?php
session_start();
require "..\conecta.php";
$con = conecta();

$correo = $_REQUEST['correo'];
$pass = md5 ($_REQUEST['password']);

$query = "SELECT * FROM empleados
          WHERE status = 1 AND eliminado = 0
          AND correo = '$correo' AND pass='$pass'";

$res = $con -> query($query);
$num = $res -> num_rows;

if($num == 1){
    $row = $res -> fetch_array();
    $id = $row["id"];
    $nombre = $row["nombre"]. ' '.$row["apellidos"];
    $correo = $row["correo"];

    $_SESSION['idUser'] = $id;
    $_SESSION['nombreUser'] = $nombre;
    $_SESSION['correoUser'] = $correo;

}

echo $num;
?>