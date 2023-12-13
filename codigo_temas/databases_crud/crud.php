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

function listarPizzas($conn) {
    // Preparar consulta
    $consulta = $conn->prepare("SELECT nombre, precio FROM pizzas");
    // Ejecutar consulta
    $consulta->execute();

    // Listar las pizzas
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo $row["nombre"] . ". " . $row["precio"]. "€.<br>";
    }
}

// Conectar a la base de datos
$conn = conectarBD();

// Listar las pizzas existentes
echo "<h1>Nuestras pizzas</h1>";
listarPizzas($conn);

///////////////////////////////////
//Insertar nueva pizza

// Datos de la nueva pizza
$nombrePizza = "Pizza prueba";
$costePizza = 5.00; // Coste de producción
$precioPizza = 10.00; // Precio de venta
$ingredientesPizza = "Tomate, Mozzarella, Albahaca, Jamón, Parmesano";

// Preparar sentencia de inserción
$insertar = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES (:nombre, :coste, :precio, :ingredientes)");

// Vincular parámetros
$insertar->bindParam(':nombre', $nombrePizza);
$insertar->bindParam(':coste', $costePizza);
$insertar->bindParam(':precio', $precioPizza);
$insertar->bindParam(':ingredientes', $ingredientesPizza);

$insertar->execute();

// Volver a listar las pizzas después de la inserción
echo "<h1>Pizzas después de agregar la 'Pizza Nueva'</h1>";
listarPizzas($conn);


///////////////////////////////////
// Modificar la última pizza
// Obtener el ID de la última pizza insertada
$nombreOriginal = "Pizza prueba";

// Modificar una pizza

$nombrePizzaModificado = "Pizza Modificada";
$costePizzaModificado = 6.00;
$precioPizzaModificado = 11.00;
$ingredientesPizzaModificados = "Tomate, Mozzarella, Albahaca, Champiñones";

$modificar = $conn->prepare("UPDATE pizzas SET nombre=:nombre, coste=:coste, precio=:precio, ingredientes=:ingredientes WHERE nombre=:nombreOriginal");

$modificar->bindParam(':nombre', $nombrePizzaModificado);
$modificar->bindParam(':coste', $costePizzaModificado);
$modificar->bindParam(':precio', $precioPizzaModificado);
$modificar->bindParam(':ingredientes', $ingredientesPizzaModificados);
$modificar->bindParam(':nombreOriginal', $nombreOriginal);

$modificar->execute();


echo "<h1>Pizzas después de modificar la 'Pizza Prueba'</h1>";
listarPizzas($conn);

///////////////////////////////////
//Borrar una pizza

$nombrePizzaABorrar = "Pizza Modificada";

$eliminar = $conn->prepare("DELETE FROM pizzas WHERE nombre=:nombre");
$eliminar->bindParam(':nombre', $nombrePizzaABorrar);
$eliminar->execute();

echo "<h1>Pizzas después de eliminar la 'Pizza Modificada'</h1>";
listarPizzas($conn);

?>

