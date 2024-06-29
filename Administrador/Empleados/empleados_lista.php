<?php
    require '../sesion.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de empleados</title>
    <link rel="stylesheet" href="../estilo2.css">

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script>
        function eliminar(id_empleado) {
                var confirma = confirm('¿Deseas eliminar empleado?');
                if (confirma) {
                    var id=id_empleado;
                    $.ajax({
                    url: 'empleados_elimina.php?id='+id,
                    type: 'get',
                    data: { id: id_empleado },
                    success: function(response) {
                        if (response === 'success') {
                            console.log('Se ha eliminado el empleado.');
                            $("#row"+id_empleado).hide();
                        } else {
                        console.log('Error al eliminar ' + response);
                        }
                    }
                    });
                }
            }
    </script>
</head>

<body>
    <?php include '../header.php'; ?>
    <?php
        require "../conecta.php";
        $con = conecta();
        $sql = "SELECT * FROM empleados WHERE status=1 and eliminado=0";
        $res = $con->query($sql);
        $num = $res->num_rows;
        echo "<center><h2>Lista de empleados ( ",$num," )</h2></center>";
    ?>
    <a class="agregarbtn" href="empleados_agregar.php">Agregar empleado</a>
    <table class="tab">
    <!--Atributos-->
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Detalles</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php
            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    
                    $id = $row['id'];
                    $nombre = $row['nombre'];
                    $apellidos = $row['apellidos'];
                    $correo = $row['correo'];
                    $rol = $row['rol'];

                    if ($rol == 1) {
                        $puesto = "Gerente";
                    } else if ($rol == 2){
                        $puesto = "Ejecutivo";
                    } else if ($rol == 0){
                        $puesto = "Nulo";
                    }
                    

                    echo "<tr id='row$id'>";
        
                        echo"<td>".$id."</td>";
                        echo"<td>".$nombre. " " .$apellidos."</td>";
                        echo"<td>".$correo."</td>";
                        echo"<td>".$puesto."</td>";
                        echo"<td> <a href='empleados_detalles.php?id=$id' button>Detalles</a> </td> ";
                        echo"<td> <a href='empleados_editar.php?id=$id' button>Editar</a> </td> ";
                        echo"<td> <button class='eliminar' onclick='eliminar(" .$id. ")'>Eliminar</button> </td> ";

                    echo "</tr>";
                }
            }
        ?>       
    </table>
</body>
</html>