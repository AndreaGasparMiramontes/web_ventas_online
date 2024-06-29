<?php
    require '../sesion.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de productos</title>
    <link rel="stylesheet" href="../estilo2.css">

    <script src="../js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <?php include '../header.php'; ?>
    <?php
        require "../conecta.php";
        $con = conecta();
        $sql = "SELECT * FROM pedidos WHERE status=1";
        $res = $con->query($sql);
        $num = $res->num_rows;
        echo "<center><h2>Lista de Pedidos ( ",$num," )</h2></center>";
    ?>
    <table class="tab">
    <!--Atributos-->
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Detalles</th>
        </tr>
        <?php
            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    
                    $id = $row['id'];
                    $fecha = $row['fecha'];
                    $idusuario = $row['id_usuarios'];

                    echo "<tr id='row$id'>";
        
                        echo"<td>".$id."</td>";
                        echo"<td>".$fecha."</td>";
                        echo"<td>".$idusuario."</td>";
                        echo"<td> <a href='pedidos_detalles.php?id=$id' button>Detalles</a> </td> ";

                    echo "</tr>";
                }
            }
        ?>       
    </table>
</body>
</html>