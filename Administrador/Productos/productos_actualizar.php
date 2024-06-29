<?php

    require "../conecta.php";
    $con = conecta();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id= $_POST["id"];
        $nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $costo = $_POST["costo"];
        $stock = $_POST["stock"];
        $descripcion = $_POST["descripcion"];
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
    
        $query = "UPDATE productos SET nombre = '$nombre', codigo = '$codigo', costo = '$costo', stock = '$stock', descripcion = '$descripcion', status = '$estado'";

        if(!empty($_FILES['archivo']['name'])){ 
            $query .= ", archivo = '$archivo', archivo_n = '$archivo_n'";
        }
        $query .= " WHERE id = $id";

        $sql = $con->query($query);
        header ('Location: productos_lista.php');
        exit;
    }

?>