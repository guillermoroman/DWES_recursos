<?php
require "connection.php";
$pdo = conectarBD();


// Manejo de cookies
$selectedActivity = 'todas las actividades';
if (isset($_COOKIE['lastActivity'])) {
    $selectedActivity = $_COOKIE['lastActivity'];
}
if (isset($_POST['activity'])) {
    $selectedActivity = $_POST['activity'];
    // set cookie
}

// Consulta SQL

?>

<!DOCTYPE html>
<html>
<head>
    <title>Las actividades de nuestros clientes</title>
</head>
<body>

<h1>Las actividades de nuestros clientes</h1>

<form method="post">
    <select name="activity">
        <option value="todas las actividades">Todas las actividades</option>
        <option value="yoga" <?php echo $selectedActivity == 'yoga' ? 'selected' : ''; ?>>Yoga</option>
        <option value="spinning" <?php echo $selectedActivity == 'spinning' ? 'selected' : ''; ?>>Spinning</option>
        <option value="musculación" <?php echo $selectedActivity == 'musculación' ? 'selected' : ''; ?>>Musculación</option>
        <option value="crossfit" <?php echo $selectedActivity == 'crossfit' ? 'selected' : ''; ?>>Crossfit</option>
        <option value="aeróbic" <?php echo $selectedActivity == 'aeróbic' ? 'selected' : ''; ?>>Aeróbic</option>
    </select>
    <input type="submit" value="Buscar">
</form>

<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
    </tr>
    <?php
    // Imprimir tabla

    ?>
</table>


</body>
</html>
