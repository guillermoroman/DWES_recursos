<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DWES Tema 3</title>

    <?php
    if ($_POST['usuario'] == 'usuario' and $_POST['clave'] == '1234') {
        header ("Location:bienvenido.html");
    } else {
        header ("Location: error.html");
    }
    ?>
</head>

<body>
    <?php
    echo "Usuario introducido: " . $_POST['usuario'] . "<br>";
    echo "Clave introducida: " . $_POST['clave'] . "<br>";
    ?>
</body>
</html>