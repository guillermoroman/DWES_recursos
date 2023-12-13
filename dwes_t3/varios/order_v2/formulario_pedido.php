<?php
require "connection.php";
$conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Pedido</title>
</head>
<body>
    <h1>Realizar Pedido</h1>
    <form action="procesar_pedido.php" method="post">
    <?php for ($i = 1; $i <= 4; $i++): ?>
        <label for="juego<?php echo $i; ?>">Juego <?php echo $i; ?>:</label>
        <select name="juego<?php echo $i; ?>" id="juego<?php echo $i; ?>">
            <option value="">Selecciona un juego</option>
            <?php
                $sql = "SELECT id, nombre FROM juegos";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                foreach($stmt as $row){
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                    //<option value='2'>Ejemplo</option>
                }

            ?>
        </select><br><br>
    <?php endfor; ?>
    <input type="submit" value="Hacer Pedido">
</form>

</body>
</html>
