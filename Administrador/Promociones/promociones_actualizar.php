<?php

    require "../conecta.php";
    $con = conecta();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id= $_POST["id"];
        $nombre = $_POST["nombre"];
        $estado = $_POST["estado"];
        
        if(!empty($_FILES['archivo']['name'])){
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
        }
    
        $query = "UPDATE promociones SET nombre = '$nombre', status = '$estado'";

        if(!empty($_FILES['archivo']['name'])){ 
            $query .= ", archivo = '$archivo'";
        }
        $query .= " WHERE id = $id";

        $sql = $con->query($query);
        header ('Location: promociones_lista.php');
        exit;
    }

?>