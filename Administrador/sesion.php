<?php
session_start();
$id = $_SESSION['idUser'];
$nombre = $_SESSION['nombreUser'];
$correo = $_SESSION['correoUser'];

if (!isset($_SESSION['nombreUser'])) {
    header("Location: ../InicioSesion/index.php"); 
    exit();
}
?>