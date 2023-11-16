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
    <?php
    if ($_SESSION["rol"] == 1) {
        echo "OoOoh, un administrador!";
    } else if ($_SESSION["rol"] == 2) {
        echo "Bah, un usuario";
    }
    ?>
</body>
</html>