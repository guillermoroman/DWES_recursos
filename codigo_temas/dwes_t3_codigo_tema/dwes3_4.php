<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DWES Tema 3</title>
</head>

<body>
    <p>
        <?php
        echo $_SERVER['REQUEST_METHOD'];
        echo "<br>";
        print_r ($_GET);
        echo "<br>";

        
        if (is_null ($_GET ["nombre"])){
            echo "nombre es null<br>";
        } else {
            echo "nombre no es null<br>";
        }
        if (empty($_GET["nombre"])){
            echo "nombre es empty<br>";
        }

        echo "Hola ". $_GET ["nombre"];

        
        ?>

    </p>
</body>
</html>
