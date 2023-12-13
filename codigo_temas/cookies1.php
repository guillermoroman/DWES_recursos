<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador de visitas</title>
    
</head>
<body>

<?php
if(!isset($_COOKIE['visitas'])){
    $visitas = 1;
} else {
    $visitas = (int) $_COOKIE['visitas'];
    $visitas++;

}
setcookie('visitas', $visitas, time() + 3600 * 24);
?>

<?php
    if($visitas == 1) {
        echo "Bienvenido por primera vez";
    } else {
        // Imprimir el número de visitas en la pantalla
    echo "<p>Número de visitas: " . $visitas . "</p>";
    }
    
?>
</body>
</html>
