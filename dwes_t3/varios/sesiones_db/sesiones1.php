<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador de visitas</title>
    
</head>
<body>

<?php
session_start();

if (!isset($_SESSION["count"])){
    $_SESSION["count"] = 0;
    $_SESSION["nombre"] = "Pedro";
    $_SESSION["rol"] = "admin";
} else {
    $_SESSION["count"]++;
}

//set

//print_r($_COOKIE);
//print_r($_SESSION);

echo "Hola " . $_SESSION["nombre"] . "<br>";
echo "Contador: " . $_SESSION["count"];

?>

</body>
</html>
