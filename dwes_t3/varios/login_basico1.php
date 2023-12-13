<?php
if ($_POST ["usuario"] == "pepe" and $_POST["clave"] == "1234"){
    header ("Location:bienvenido.html");
} else {
    header ("Location:error.html");
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>DWES Tema 3</title>
</head>

<body>
    <?php
        echo "Usuario introducido: " . $_POST["usuario"] . "<br>";
        echo "Clave introducida: " . $_POST["clave"] . "<br>";
    
        echo $_POST;
        print_r($_POST);
        echo "<br>";
        var_dump($_POST);
        //print_r ($_SERVER["REQUEST_METHOD"]);
        
        //print_r ($_GET);
    ?>
</body>
</html>