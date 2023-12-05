<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Pedido</title>
</head>
<body>
    <h1>Realizar Pedido</h1>
    <form method="post" action="procesar_pedido.php">
        <!-- Selección de juego -->
        <label for="juego">Selecciona un juego:</label>
        <select name="juego" id="juego" required>
            <option value="juego1">Juego 1</option>
            <option value="juego2">Juego 2</option>
            <option value="juego3">Juego 3</option>
            <!-- Agrega más opciones para tus juegos -->
        </select><br>

        <!-- Cantidad -->
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" required><br>

        <input type="submit" name="submit" value="Realizar Pedido">
    </form>
</body>
</html>
