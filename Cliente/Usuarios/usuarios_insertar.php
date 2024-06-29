<?php

    require "../conecta.php";
    $con = conecta();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $correo = $_POST["correo"];
        $pass = $_POST["pass"];
        $passEnc = md5($pass);

        $query = "INSERT INTO usuarios (nombre, apellidos, correo, pass) 
        VALUES ('$nombre', '$apellidos', '$correo', '$passEnc')";

        $sql = $con->query($query);

        header ('Location: ../InicioSesion/index.php');
        exit;
    }

?>