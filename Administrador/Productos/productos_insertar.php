<?php

    require "../conecta.php";
    $con = conecta();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $costo = $_POST["costo"];
        $stock = $_POST["stock"];
        $descripcion = $_POST["descripcion"];

        $file_name = $_FILES["archivo"] ["name"];
        $file_tmp = $_FILES["archivo"] ["tmp_name"];
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

        $query = "INSERT INTO productos (nombre, codigo, descripcion, costo, stock, archivo_n, archivo) 
        VALUES ('$nombre', '$codigo', '$descripcion', '$costo', '$stock', '$archivo_n', '$archivo')";

        $sql = $con->query($query);

        header ('Location: productos_lista.php');
        exit;
    }

?>