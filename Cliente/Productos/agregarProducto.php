<?php
session_start();
require "../conecta.php";
$con = conecta();

//Recibe variables
$idP  = $_POST['idP'];
$cant = $_POST['cant'];
$id_cliente = $_SESSION['idUserc'];

//Obtener id_pedido
$sql = "SELECT * FROM pedidos WHERE id_usuarios = $id_cliente AND status = 0";
$res = $con->query($sql);
$num = $res->num_rows;
if ($num == 0) {
	$sql   = "INSERT INTO pedidos (fecha, id_usuarios)
	          VALUES (NOW(), $id_cliente)";
	$res       = $con->query($sql);
	$id_pedido = $con->insert_id;
} else {
	$row = $res->fetch_assoc();
	$id_pedido = $row['id'];
}


$sql = "SELECT costo,stock FROM productos WHERE id = $idP";
$res = $con->query($sql);
$num = $res->num_rows;
if ($num) {
	$row = $res->fetch_assoc();
	$precio = $row['costo'];
    $stock = $row['stock'];
}


if ($cant <= $stock && $cant > 0) {
	//Verifica si ya se esta pidiendo ese productos
	$sql = "SELECT * FROM pedidos_productos
	        WHERE id_producto = $idP AND id_pedido = $id_pedido";
	$res = $con->query($sql);
	$num = $res->num_rows;
	if ($num == 0) {
		$sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio)
	            VALUES ($id_pedido, $idP, $cant, $precio);";
	} else {
        $sql = "UPDATE pedidos_productos SET cantidad = cantidad + $cant
                WHERE id_pedido = $id_pedido AND id_producto = $idP";
	}
	$con->query($sql);
    echo 1;	
} else {
    echo 0;	
}

?>