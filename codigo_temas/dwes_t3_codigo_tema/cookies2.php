<?php
    // Comprobar si la cookie con el nombre 'visitas' ya existe
    if(isset($_COOKIE['visitas'])){
        // La cookie existe, obtener su valor y aumentarlo en 1
        $visitas = $_COOKIE['visitas'] + 1;
    } else {
        // La cookie no existe, establecer el número de visitas a 1
        $visitas = 1;
    }

    // Establecer la cookie 'visitas' con el número actualizado de visitas y un tiempo de expiración (time()+3600 = 1 hora)
    setcookie('visitas', $visitas, time()+3600); // La cookie expira en 1 hora
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador de visitas</title>
</head>
<body>
    <?php

    // Imprimir el número de visitas en la pantalla
    echo "<p>Número de visitas: " . $visitas . "</p>";
    ?>
</body>
</html>
