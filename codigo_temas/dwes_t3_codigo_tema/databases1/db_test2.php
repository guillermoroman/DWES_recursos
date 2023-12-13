<?php
$cadena_conexion = 'mysql:dbname=classicmodels;host=127.0.0.1';
$usuario = 'root';
$clave = '';
try{
    $bd = new PDO($cadena_conexion, $usuario, $clave);
    echo "Conexión realizada con éxito" . "<br>";

    $sq1 = 'SELECT customerName, country FROM customers';

    $usuarios = $bd->query($sq1);

    echo "Registros encontrados: " . $usuarios->rowCount() . "<br><br>";

    foreach ($usuarios as $row){
        print $row["customerName"]. "  ";
        print $row["country"]. "<br>";
    }
}
catch(PDOException $e) {
    echo 'Error conectando a la base de datos: '. $e->getMessage();
    
}
