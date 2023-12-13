<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DWES Tema 3</title>
</head>

<body>
    <?php
        session_start();
        if(!isset($_SESSION["count"])){
            $_SESSION["count"] = 0;
        } else {
            $_SESSION["count"]++;
        }
        
        echo "La variable count vale: " . $_SESSION["count"];

        /*
        echo "hola " . $_SESSION["count"];
        echo "<br><a href='sesiones_uso_basico2.php'>Siguiente</a>";
        */
        echo "<br><a href='sesiones_uso_basico.php'>Volver</a>";
    ?>
</body>
</html>