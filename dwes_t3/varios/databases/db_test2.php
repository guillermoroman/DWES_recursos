<?php
$cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
$usuario = "root";
$clave = "";

try {
    $bd = new PDO($cadena_conexion, $usuario, $clave);
    echo "Conexión realizada con éxito";

    $sq1 = "SELECT usuario FROM usuarios";

    echo "<br>";

    $pdo_statement = $bd->query($sq1);

    $usuarios = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

    print_r($usuarios);


} catch (PDOException $e) {
    echo "Error conectando a la base de datos: " . $e->getMessage();
}

// $usuarios no es un array, sino un objeto del tipo PDOStatement
// https://www.php.net/manual/en/class.pdostatement.php
// Se puede iterar porque implementa la clase IteratorAggregate

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