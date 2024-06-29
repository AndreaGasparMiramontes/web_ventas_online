<?php

    require "../conecta.php";
    $con = conecta();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id= $_POST["id"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $correo = $_POST["correo"];
        $pass = $_POST["pass"];
        $passEnc = md5($pass);
        $rol = $_POST["rol"];
        
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
    
        $query = "UPDATE empleados SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol'";

        if(!empty($pass)){ 
            $query .= ", pass = '$passEnc'";
        }
        if(!empty($_FILES['archivo']['name'])){ 
            $query .= ", archivo = '$archivo', archivo_n = '$archivo_n'";
        }
        $query .= " WHERE id = $id";

        $sql = $con->query($query);
        header ('Location: empleados_lista.php');
        exit;
    }

?>