<?php
require "connection.php";
$conn = conectarBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = 1; // Asumiendo el ID del cliente
    $fecha_pedido = date("Y-m-d H:i:s");
    $detalle_pedido = "";
    $total = 0;

    for($i = 1; $i <= 4; $i++) {
        $pizzaId = $_POST["pizza$i"];
        if (!empty($pizzaId)) {
            $sql = "SELECT nombre, precio FROM pizzas WHERE id = :pizzaId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pizzaId', $pizzaId);
            $stmt->execute();
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $detalle_pedido .= $row["nombre"] . ", ";
                $total += $row["precio"];
            }
        }
    }

    $detalle_pedido = rtrim($detalle_pedido, ", ");

    // Insertar en la tabla de pedidos
    $sql = "INSERT INTO pedidos (id_cliente, fecha_pedido, detalle_pedido, total)
            VALUES (:id_cliente, :fecha_pedido, :detalle_pedido, :total)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':fecha_pedido', $fecha_pedido);
    $stmt->bindParam(':detalle_pedido', $detalle_pedido);
    $stmt->bindParam(':total', $total);

    if ($stmt->execute()) {
        echo "Pedido realizado con éxito";
    } else {
        echo "Error al realizar el pedido";
    }
} else {
    header("Location:error.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Gracias por su pedido!<h1>
</body>
</html>