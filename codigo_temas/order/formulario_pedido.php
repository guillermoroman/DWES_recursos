<?php
require "connection.php";
$conn = conectarBD();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar pedido</title>
</head>
<body>
    <h1>Realizar pedido</h1>
    
<form action="procesar_pedido.php" method="post">
    <?php for ($i = 1; $i<=4; $i++): ?>
        <label for="juego<?=$i?>">Juego <?=$i?>:</label>
        <select name="juego<?=$i?>" id="juego<?=$i?>">
            <option value= "">Selecciona un juego</option>
            <?php
                $sql = "SELECT id, nombre FROM juegos";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                //echo "<option value = '3'>Juego</option>";
                foreach($stmt as $row){
                    echo "<option value ='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }
            ?>
        </select><br><br>

    <?php endfor; ?>
    <input type="submit" value="Hacer Pedido">
</form>


</body>
</html>