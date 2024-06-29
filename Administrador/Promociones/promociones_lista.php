<?php
    require '../sesion.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de promociones</title>
    <link rel="stylesheet" href="../estilo2.css">

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script>
        function eliminar(id_empleado) {
                var confirma = confirm('¿Deseas eliminar el producto?');
                if (confirma) {
                    var id=id_empleado;
                    $.ajax({
                    url: 'promociones_elimina.php?id='+id,
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
        $sql = "SELECT * FROM promociones WHERE status=1 and eliminado=0";
        $res = $con->query($sql);
        $num = $res->num_rows;
        echo "<center><h2>Lista de Promociones ( ",$num," )</h2></center>";
    ?>
    <a class="agregarbtn" href="promociones_agregar.php">Agregar promocion</a>
    <table class="tab">
    <!--Atributos-->
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Detalles</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php
            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    
                    $id = $row['id'];
                    $nombre = $row['nombre'];

                    echo "<tr id='row$id'>";
        
                        echo"<td>".$id."</td>";
                        echo"<td>".$nombre."</td>";
                        echo"<td> <a href='promociones_detalles.php?id=$id' button>Detalles</a> </td> ";
                        echo"<td> <a href='promociones_editar.php?id=$id' button>Editar</a> </td> ";
                        echo"<td> <button class='eliminar' onclick='eliminar(" .$id. ")'>Eliminar</button> </td> ";

                    echo "</tr>";
                }
            }
        ?>       
    </table>
</body>
</html>