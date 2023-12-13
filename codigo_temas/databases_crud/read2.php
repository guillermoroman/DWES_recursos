
<?php

function conectarBD(){
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";

    try {
        $bd = new PDO($cadena_conexion, $usuario, $clave);
        return $bd;
    } catch (PDOException $e) {
        echo "Error conectando a la bd: " . $e->getMessage();
    }
}

// Consultar menu
$conn = conectarBD();

//Preparar consulta:
$insertar = $conn->prepare("SELECT nombre, precio FROM pizzas WHERE precio BETWEEN 10 AND 11");
//Ejecutar consulta
$insertar->execute();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pizzería Mamma Mía</title>
</head>


<body>
    <h1>Nuestras pizzas entre 10 y 11€</h1>
    <?php
    foreach ($insertar->fetchAll(PDO::FETCH_ASSOC) as $row){
        echo $row["nombre"] . ". " . $row["precio"]. "€.<br>";
    }
    ?>
</body>
</html>