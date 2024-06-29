<?php
session_start();
$id_usuario = $_SESSION['idUserc'];
$nombre_usuario = $_SESSION['nombreUserc'];
$correo_usuario = $_SESSION['correoUserc'];

if (!isset($_SESSION['nombreUserc'])) {
    header("Location: ../InicioSesion/index.php"); 
    exit();
}
?>