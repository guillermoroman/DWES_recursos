<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DWES Tema 3</title>
</head>

<body>
    <?php
        session_start(); //creamos la sesión o nos unimos a ella
        if(!isset($_SESSION["count"])){ //Podemos acceder a la reunión cuando la creamos
            $_SESSION["count"] = 0;
            $_SESSION["usuario"] = "Pedro";
            $_SESSION["rol"] = "admin";
        } else {
            $_SESSION["count"]++;
        }
        print_r($_SESSION);
        print_r($_COOKIE);//Vemos la cookie enviada por el servidor con el identificador único session_id
        echo "hola " . $_SESSION["count"];
        echo "<br><a href='sesiones_uso_basico2.php'>Siguiente</a>";
    ?>
</body>
</html>