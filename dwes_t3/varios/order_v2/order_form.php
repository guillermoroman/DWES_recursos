<?php
require "connection.php";
$conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order form sample</title>

</head>
<body>
<form action="procesar_pedido.php" method="post">
    <?php for($i = 1; $i <= 4; $i++): ?>
        <label for="pizza<?php echo $i; ?>">Pizza <?php echo $i; ?>:</label>
        <select name="pizza<?php echo $i; ?>" id="pizza<?php echo $i; ?>">
            <option value="">Selecciona una pizza</option>
            <?php
                $sql = "SELECT id, nombre FROM pizzas";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
                }
            ?>
        </select><br><br>
    <?php endfor; ?>
    <input type="submit" value="Hacer Pedido">
</form>


    
</body>
</html>