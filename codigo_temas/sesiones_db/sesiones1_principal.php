
<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location:sesiones1_login.php?redirigido=true");
    }
    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario de login</title>
</head>
<body>
    <?= "Bienvenido ". $_SESSION['usuario'];?>
    <br>
    <a href = "sesiones1_logout.php"> Salir <a>
    
</body>
</html>