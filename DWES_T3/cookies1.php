<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contador de visitas</title>
</head>

<body>

    <?php
    if(!isset($_COOKIE["visitas"])){
        $visitas = 1;
    } else {
        $visitas = $_COOKIE["visitas"];
        $visitas++;
    }

    setcookie("visitas",$visitas, time() + 3600 * 24);


    echo "Número de vistias: " . $_COOKIE["visitas"];
    echo "<br>";
    //print_r ($_COOKIE);
    ?>

</body>
</html>