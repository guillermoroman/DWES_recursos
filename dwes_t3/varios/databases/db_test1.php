<?php
$cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
$usuario = "root";
$clave = "";

try {
    $bd = new PDO($cadena_conexion, $usuario, $clave);
    echo "Conexión realizada con éxito";

    $sq1 = "SELECT * FROM usuarios";

    echo "<br>";

    $usuarios = $bd->query($sq1);
    
    //$resultados = $usuarios->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    //print_r($resultados);
    echo "</pre>";

    foreach ($usuarios as $row){
        print "Usuario: " . $row["usuario"];
        print ". ID: " . $row["id"] ;
        print ". Rol: " . $row["rol"] ;
        print ". Correo: " . $row["correo"] . "<br>";
        //print_r($row);

    }
    echo "<br>";


} catch (PDOException $e) {
    echo "Error conectando a la base de datos: " . $e->getMessage();
}

// $usuarios no es un array, sino un objeto del tipo PDOStatement
// https://www.php.net/manual/en/class.pdostatement.php
// se puede recorrer directamente con un foreach, como hemos hecho, o volcar sus contenidos a un array con fetchAll

// Ver versión alternativa en db_test2.php



/*
public PDO::__construct(
    string $dsn,
    ?string $username = null,
    ?string $password = null,
    ?array $options = null
)
*/