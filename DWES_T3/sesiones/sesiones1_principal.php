<?php
    session_start();
    if (!isset($_SESSION["usuario"])){
        header("Location:sesiones1_login.php?redirigido=true");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DWES Tema 3</title>
</head>

<body>
    <h1>Bienvenido!</h1>
</body>
</html>