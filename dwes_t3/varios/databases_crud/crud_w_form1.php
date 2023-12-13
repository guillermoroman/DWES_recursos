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

$conn = conectarBD();

function listarPizzas($conn, $precioFiltro = null){
    $sql = "SELECT nombre, precio FROM pizzas";
    if ($precioFiltro !== null) {
        $sql .= " WHERE precio = :precio";
    }

    $consulta = $conn->prepare($sql);

    if ($precioFiltro !== null) {
        $consulta->bindParam(':precio', $precioFiltro);
    }

    $consulta->execute();

    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
        echo $row["nombre"] . ". " . $row["precio"]. "€.<br>";
    }
}

// Procesar el formulario
$precioFiltrado = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['precio'])) {
    $precioFiltrado = $_POST['precio'];
}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="precio">Filtrar por precio exacto:</label>
    <input type="number" id="precio" name="precio">
    <input type="submit" value="Filtrar">
</form>

<h1>Nuestras pizzas</h1>
<?php listarPizzas($conn, $precioFiltrado); ?>
