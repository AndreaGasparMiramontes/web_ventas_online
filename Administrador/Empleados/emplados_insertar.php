<?php

    require "../conecta.php";
    $con = conecta();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $correo = $_POST["correo"];
        $pass = $_POST["pass"];
        $passEnc = md5($pass);
        $rol = $_POST["rol"];

        $file_name = $_FILES['archivo'] ['name'];
        $file_tmp = $_FILES['archivo'] ['tmp_name'];
        $arreglo = explode(".", $file_name);
        $len = count($arreglo);
        $pos = $len-1;
        $ext = $arreglo[$pos];
        $dir = "archivos/";
        $file_enc = md5_file($file_tmp);


        if ($file_name != ''){
            $file_name1 = "$file_enc.$ext";
            copy($file_tmp, $dir.$file_name1);
        }

        $archivo_n = $file_name;
        $archivo = $file_name1;

        $query = "INSERT INTO empleados (nombre, apellidos, correo, pass, rol, archivo_n, archivo) 
        VALUES ('$nombre', '$apellidos', '$correo', '$passEnc', '$rol', '$archivo_n', '$archivo')";

        $sql = $con->query($query);

        header ('Location: empleados_lista.php');
        exit;
    }

?>