<?php
require "connection.php";
$conn = conectarBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = 1; // Asumiendo el ID del cliente
    $fecha_pedido = date("Y-m-d H:i:s");
    $detalle_pedido = "";
    $total = 0;

    for($i = 1; $i <= 4; $i++) {
        $juegoID = $_POST["juego$i"];
        if (!empty($juegoID)) {
            $sql = "SELECT nombre, precio FROM juegos WHERE id = :juegoID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':juegoID', $juegoID);
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
        $mensaje = "Pedido realizado con éxito";
    } else {
        $mensaje = "Error al realizar el pedido";
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
<h1><?php echo $mensaje; ?></h1>
    
    <?php if ($mensaje === "Pedido realizado con éxito"): ?>
    <h2>Resumen del Pedido</h2>
    <p>Fecha del Pedido: <?php echo $fecha_pedido; ?></p>
    <p>Detalle del Pedido: <?php echo $detalle_pedido; ?></p>
    <p>Total: $<?php echo number_format($total, 2); ?></p>
    <?php endif; ?>
        
</body>
</html>